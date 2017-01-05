<?php
	include 'include.php';
	include 'mail_config.php';

	function on_error($msg) {
		global $smtp_config;
		
		// Error page
		header('Location: ' . $smtp_config['site_addr'] . "/activacao_falhou");
		die();
	}

	function on_success() {
		global $smtp_config;
		
		// Success page
		header('Location: ' . $smtp_config['site_addr'] . "/activacao_successo");
		die();
	}

	// Token
	if(!isset($_GET['token']) || $_GET['token'] === "")
		on_error('Token de activação inválido.');
	$token = $_GET['token'];

	// Email
	if(!isset($_GET['email']))
		on_error('Email inválido.');
	$email = $_GET['email'];

	try {
		$dbh = get_dbh();

		$dbh->beginTransaction();

		$res = activate_user($dbh, $email, $token);

		if($res !== false) {
			$dbh->rollBack();
			on_error($res);
		} else {
			$dbh->commit();
			on_success();
		}
	} catch (Exception $e) {
		on_error("");
	}
?>
