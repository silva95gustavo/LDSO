<?php
	include '../include.php';

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

	// Register on site
	$register_site = false;
	if(property_exists($data, 'register_site')) {
		$register_site = true;
	}

	if(!property_exists($data, 'password'))
		on_error('Nenhuma password especificada.');
	$password = $data->password;

	// Register on community
	$register_community = false;
	if(property_exists($data, 'register_community')) {
		$register_community = true;

		// Nickname
		if(!property_exists($data, 'nickname'))
			on_error('Nenhum nickname especificado.');
		$nickname = trim($data->nickname);
		if($nickname == '')
			on_error("Nickname inválido");

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

	$dbh = get_dbh();

	$dbh->beginTransaction();

	$user = get_user($dbh, $email);

	if($user) {
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
		$id_site = create_user_drupal($dbh, gen_uuid(), $email, $password);
	} else {
		$id_site = false;
	}

	if($register_community) {
		// Check if nickname doesn't exist
		if(nickname_exists($dbh, $nickname))
			on_error("O nickname já está em uso.");

		$bday = date("md", date("U", mktime(0, 0, 0, $bday_m, $bday_d, $bday_y)));
		$age = $bday > date("md") ? (date("Y") - $bday_y - 1) : (date("Y") - $bday_y);

		$id_community = create_user_flarum($dbh, $nickname, $email, $password);
		set_flarum_user_group($dbh, $id_community, get_flarum_group($age));
	} else {
		$id_community = false;
	}

	if($user) {
		update_user($dbh, $email, $id_site, $id_community);
	} else {
		create_user($dbh, $email, $id_site, $id_community);
	}

	$dbh->commit();

	on_success($id_site, $id_community);
?>