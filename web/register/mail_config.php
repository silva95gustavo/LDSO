<?php
	$smtp_config = array();

	$smtp_config['host'] = 'in-v3.mailjet.com';
	$smtp_config['username'] = 'smtp_username';
	$smtp_config['password'] = 'smtp_password';
	$smtp_config['port'] = 587;
	$smtp_config['from_addr'] = 'noreply@cuidadores.tk';
	$smtp_config['admin_addr'] = 'admin@cuidadores.tk';
	$smtp_config['site_addr'] = 'http://staging.cuidadores.tk';

	if (file_exists(__DIR__ . '/settings.local.php')) {
		include __DIR__ . '/settings.local.php';
	}

	function get_mail() {
		global $smtp_config;

		$mail = new PHPMailer;

		//$mail->SMTPDebug = 3;

		$mail->isSMTP();
		$mail->Host = $smtp_config['host'];

		$mail->SMTPAuth = true;
		$mail->Username = $smtp_config['username'];
		$mail->Password = $smtp_config['password'];
		$mail->SMTPSecure = 'tls';
		$mail->Port = $smtp_config['port'];
		
		$mail->setFrom($smtp_config['from_addr'], 'Mailer');

		return $mail;
	}