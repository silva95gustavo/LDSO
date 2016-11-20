<?php
	include 'include.php';
	$dbh = get_dbh();

	$style = get_style($dbh);

	$style_html = $style[0]["value"];
	$style_css = $style[1]["value"];

	$flarum_remember = $_COOKIE['flarum_remember'];

	if(!isAdmin($dbh, $flarum_remember)) {
		http_status_code(403);
		die();
	}

	$users = getAdultsToNotify($dbh);
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style>
		<?=$style_css?>
	</style>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<?=$style_html?>
	<center><h2>Gerir utilizadores jovens/adultos</h1></center>
	<div id="wrapper">
		<?php if(count($users) == 0) { ?>
			<center>Não existem utilizadores.</center>
		<?php } else { ?>
			<div class="header">
				<div class="col name">Nome</div>
				<div class="col email">Email</div>
				<div class="col birthday">Data de Nasc.</div>
				<div class="col last_col"></div>
			</div>
		<?php     foreach($users as $user) { ?>
			<div class="row">
				<div class="col name"><?=$user['username']?></div>
				<div class="col email"><?=$user['email']?></div>
				<div class="col birthday"><?=$user['birthday']?></div>
				<div class="col last_col">
					<a class="button make_adult" href="#<?=$user['id_community']?>">
						Tornar Adulto
					</a>
				</div>
			</div>
		<?php     }  ?>
		<?php }  ?>
	</div>
	<script src="../../register/js/jquery.js"></script>
	<script src="script.js"></script>
</body>
</html>