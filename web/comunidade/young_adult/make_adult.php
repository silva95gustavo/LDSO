<?php
	include 'include.php';
	$dbh = get_dbh();

	$flarum_remember = $_COOKIE['flarum_remember'];

	if(!isAdmin($dbh, $flarum_remember)) {
		http_status_code(403);
		die();
	}

	if(!isset($_POST['user_id']))
		die();

	$user_id = $_POST['user_id'];

	make_adult($dbh, $user_id);
?>