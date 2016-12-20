<?php
	$smtp_config = array();

	// FIXME
	$smtp_config['host'] = 'in-v3.mailjet.com';
	$smtp_config['username'] = 'a00c9901438900afd3b8da4e4b9a65b8';
	$smtp_config['password'] = 'e2219843d1d58bc13f3a663c5ad46662';
	$smtp_config['port'] = 587;
	$smtp_config['from_addr'] = 'soaresrebelo@gmail.com';
	$smtp_config['admin_addr'] = 'soaresrebelo@gmail.com';
	$smtp_config['site_addr'] = 'http://staging.cuidadores.tk';

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