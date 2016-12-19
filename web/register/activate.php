<?php
	include 'include.php';

	function on_error($msg) {
		http_response_code($error_code);
		$ret = array('success' => false, 'message' => $msg);
		echo json_encode($ret);
		die();
	}

	function on_success() {
		$ret = array(
			'success' => true,
			'registered_site' => $reg_site,
			'registered_community' => $reg_community);
		echo json_encode($ret);
		die();
	}

	$data = json_decode(file_get_contents("php://input"));

	// Token
	if(!property_exists($data, 'token'))
		on_error('Token de activação inválido.');
	$token = $data->token;

	// Email
	if(!property_exists($data, 'email'))
		on_error('Email inválido.');
	$email = $data->email;

	$dbh = get_dbh();

	$dbh->beginTransaction();

	$res = activate_user($dbh, $email, $token);

	if($res !== true) {
		$dbh->rollBack();
		on_error($res);
	} else {
		$dbh->commit();
		on_success();
	}
?>