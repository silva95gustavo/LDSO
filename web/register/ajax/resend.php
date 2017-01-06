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

	function on_success() {
		$ret = array(
			'success' => true);
		echo json_encode($ret);
		die();
	}

	// Email
	if(!isset($_POST['email']))
		on_error('Nenhum email especificado.');
	$email = $_POST['email'];

	try {
		$dbh = get_dbh();

		$user = get_user($dbh, $email);

		$token = false;
		if($user)
			$token = $user['activate_token'];

		if($token) {
			$mail = get_mail();
			$mail->addAddress($email, 'Receiver');

			$mail->isHTML(true);
			
			$act_url = $smtp_config['site_addr'] . "/register/activate.php?email=" . $email . "&token=" . $token;

			$mail->Subject = 'Cuidadores - Activar conta';
			$mail->Body    = "Para proceder à activação da sua conta, aceda ao endereço <a href=\"" . $act_url . "\">" . $act_url . "</a>".;

			if(!$mail->send())
				on_error('A criação da conta falhou.');
		}
	} catch (Exception $e) {
		//on_error($e->getMessage());
		on_error('Ocorreu um erro. Por favor tente novamente mais tarde.');
	}

	on_success();
?>