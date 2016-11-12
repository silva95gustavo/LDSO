<?php
	include '../include.php';

	header('Content-Type: application/json');

	function on_error($msg, $error_code = 503) {
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

	if(!isset($_POST['email']))
		on_error("Nenhum email especificado.", 400);

	$dbh = get_dbh();
	if(!$dbh)
		on_error("Ligação à base de dados falhou.");

	$user = get_user($dbh, $_POST['email']);

	if(!$user) 
		on_success(false, false);
	else
		on_success($user['id_site'] != NULL, $user['id_community'] != NULL);
?>