<?php
	include '../include.php';
	include '../mail_config.php';

	require '../../comunidade/vendor/phpmailer/phpmailer/PHPMailerAutoload.php';

	header('Content-Type: application/json');

	function on_error($msg, $error_code = 400) {
		http_response_code($error_code);
		$ret = array('success' => false, 'message' => $msg);
		echo json_encode($ret);
		die();
	}

	function on_success($reg_site, $reg_community) {
		$ret = array(
			'success' => true,
			'registered_site' => $reg_site,
			'registered_community' => $reg_community);
		echo json_encode($ret);
		die();
	}

	$data = json_decode(file_get_contents("php://input"));

	// Email
	if(!property_exists($data, 'email'))
		on_error('Nenhum email especificado.');
	$email = $data->email;

	if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		on_error('O email introduzido não é válido.');

	// Register on site
	$register_site = false;
	$name = false;
	$associate_nr = false;
	if(property_exists($data, 'register_site')) {
		$register_site = true;

		if(property_exists($data, 'name'))
			$name = trim($data->name);

		if(preg_match("/^[\p{L}0-9 ]*$/ui", $name) == 0)
			on_error('O nome contém caracteres inválidos.');

		if(property_exists($data, 'associate_nr'))
			$associate_nr = trim($data->associate_nr);

		if(preg_match("/^[0-9]*$/", $associate_nr) == 0)
			on_error('O número de associado só pode conter números.');
	}

	if(!property_exists($data, 'password'))
		on_error('Nenhuma password especificada.');
	$password = $data->password;

	if(strlen($password) < 6)
		on_error('A password deve ter no mínimo 6 caracteres.');

	// Register on community
	$register_community = false;
	$birthday = false;
	if(property_exists($data, 'register_community')) {
		$register_community = true;

		// Nickname
		if(!property_exists($data, 'nickname'))
			on_error('Nenhum nickname especificado.');
		$nickname = trim($data->nickname);
		if($nickname == '')
			on_error("Nickname inválido");
		if(preg_match("/^[\p{L}0-9 ]*$/ui", $nickname) == 0)
			on_error('O Nickname contém caracteres inválidos.');

		// Birthday
		if(!property_exists($data, 'birthday'))
			on_error('Data de nascimento não especificada.');

		$birthday = $data->birthday;

		if(!property_exists($birthday, 'y'))
			on_error('Ano não especificado.');
		if(!property_exists($birthday, 'm'))
			on_error('Mês não especificado.');
		if(!property_exists($birthday, 'd'))
			on_error('Dia não especificado.');

		$bday_y = $birthday->y;
		$bday_m = $birthday->m;
		$bday_d = $birthday->d;

		if(!is_numeric($bday_y) || $bday_y < 1900 || $bday_y > date("Y"))
			on_error("Ano inválido");

		if(!is_numeric($bday_m) || $bday_m < 1 || $bday_m > 12)
			on_error("Mês inválido");

		if(!is_numeric($bday_d) || $bday_d < 1 || $bday_d > 31)
			on_error("Dia inválido");
	}

	try {
		$dbh = get_dbh();

		$dbh->beginTransaction();

		$user = get_user($dbh, $email);

		$account_status = 0;

		if($user) {
			if($user['activate_token'] !== NULL)
				$account_status =  1;
			
			// Check if user is not registering if already registered
			// Also, validate the provided password

			if($user['id_site'] && $register_site)
				on_error('Já se encontra registado no site');
			else if($user['id_site']) {
				$id_site = $user['id_site'];
				if(!check_password_site($dbh, $user['id_site'], $password))
					on_error("A password introduzida é inválida.");
			}

			if($user['id_community'] && $register_community)
				on_error('Já se encontra registado na comunidade.');
			else if($user['id_community']) {
				$id_community = $user['id_community'];
				if(!check_password_community($dbh, $user['id_community'], $password))
					on_error("A password introduzida é inválida.");
			}
		}

		if($register_site) {
			$id_site = create_user_drupal($dbh, $email, $email, $password, $account_status);
		} else {
			$id_site = false;
		}

		if($register_community) {
			// Check if nickname doesn't exist
			if(nickname_exists($dbh, $nickname))
				on_error("O nickname já está em uso.");

			$bday = date("md", date("U", mktime(0, 0, 0, $bday_m, $bday_d, $bday_y)));
			$age = $bday > date("md") ? (date("Y") - $bday_y - 1) : (date("Y") - $bday_y);

			$id_community = create_user_flarum($dbh, $nickname, $email, $password, $account_status);
			set_flarum_user_group($dbh, $id_community, get_flarum_group($age));
		} else {
			$id_community = false;
		}

		$token = false;

		if($user) {
			update_user($dbh, $email, $id_site, $id_community, $birthday, $name, $associate_nr);
		} else {
			$token = bin2hex(openssl_random_pseudo_bytes(32));
			create_user($dbh, $email, $id_site, $id_community, $birthday, $name, $associate_nr, $token);
		}

		if($token) {
			$mail = get_mail();
			$mail->addAddress($email, 'Receiver');

			$mail->isHTML(true);
			
			$mail->Subject = 'Activar conta';
			$mail->Body    = "<a href=\"" . $smtp_config['site_addr'] . "/register/activate.php?email=" . $email . "&token=" . $token . "\">Activar conta</a>";

			if(!$mail->send())
				on_error('A criação da conta falhou.');
		}

		$dbh->commit();
	} catch (Exception $e) {
		on_error('Ocorreu um erro ao criar a conta. Por favor tente novamente mais tarde.');
	}

	on_success($id_site, $id_community);
?>