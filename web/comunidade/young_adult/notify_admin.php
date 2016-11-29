<?php
	include 'include.php';
	require '../vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
	$dbh = get_dbh();

	$users = getAdultsNotNotifiedAdmin($dbh);
	if(count($users) > 0) {
		$mail = new PHPMailer;

		//$mail->SMTPDebug = 3;

		$mail->isSMTP();
		$mail->Host = 'in-v3.mailjet.com';

		$mail->SMTPAuth = true;
		$mail->Username = 'a00c9901438900afd3b8da4e4b9a65b8';
		$mail->Password = 'e2219843d1d58bc13f3a663c5ad46662';
		$mail->SMTPSecure = 'tls';
		$mail->Port = 587;
		
		// TODO fix when mail server is available
		$mail->setFrom('soaresrebelo@gmail.com', 'Mailer');
		$mail->addAddress('soaresrebelo@gmail.com', 'Receiver');

		$mail->isHTML(true);
		
		$mail->Subject = 'Novos utilizadores adultos';
		$mail->Body    = "<h1>Cuidadores - Novos utilizadores adultos</h1>"
			. "Existem novos utilizadores adultos.";

		if(!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			markUsersNotified($dbh);
		}
	}
?>