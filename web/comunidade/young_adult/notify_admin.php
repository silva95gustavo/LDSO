<?php
	include 'include.php';
	include '../../register/mail_config.php';
	require '../vendor/phpmailer/phpmailer/PHPMailerAutoload.php';

	$dbh = get_dbh();

	$users = getAdultsNotNotifiedAdmin($dbh);
	if(count($users) > 0) {
		$mail = get_mail();
		$mail->addAddress($smtp_config['admin_addr'], 'Receiver');

		$mail->isHTML(true);
		
		$mail->Subject = 'Novos utilizadores adultos';
		$mail->Body    = "<h1>Cuidadores - Novos utilizadores adultos</h1>"
			. "Existem novos utilizadores adultos.";

		if(!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			markUsersNotified($dbh);
			echo '1';
		}
	}
?>