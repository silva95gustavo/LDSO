<?php
	include 'include.php';

	$dbh = get_dbh();
	if(!$dbh) die();

	$style = get_style($dbh);
	$css = $style[1]['value'];
	$body = $style[0]['value'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Cuidadores - Registo</title>
	<meta charset="utf-8" /> 
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div id="wrapper">
		<form id="frm_email">
			<input type="email" id="email" required="required" placeholder="email@example.com">
			<br>
			<div class="error">Ocorreu um erro.</div>
			<input class="blue" type="submit" value="Continuar"><br>
			<img class="loading" src="loading.gif">
		</form>

		<form id="frm_register" class="hidden">
			<!-- for when already registered -->
			<div id="already_registered">
				<div id="already_registered_msg"></div>
				<input type="password" id="existing_password">
			</div>

			<!-- for when not registered anywhere -->
			<div id="not_registered">
				<label for="password">Password</label><br>
				<input type="password" id="new_password" placeholder="Password"><br>
				<input type="password" id="new_password2" placeholder="Repita a password">
			</div>

			<!-- register website -->
			<div id="register_website">
				<input type="checkbox" id="chk_register_site"/>
				<label class="checkbox_label" for="chk_register_site">Registar no WebSite</label>
				<div class="data">
					<label for="name">Nome</label>
					<input type="text" id="name">
					<br><br>
					<label for="associate_nr">Número de associado</label>
					<input type="text" id="associate_nr" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
				</div>
				<br>
			</div>

			<!-- register community -->
			<div id="register_community">
				<input type="checkbox" id="chk_register_community"/>
				<label class="checkbox_label" for="chk_register_community">Registar na Comunidade</label>
				<div class="data">
					<label for="nickname">Nickname público</label>
					<input type="text" id="nickname"><img src="help.png">
					<br><br>
					<label>Data de nascimento</label>
					<select id="day">
						<option value="0" selected="selected" disabled="disabled">Dia</option>
						<?php for($i = 1; $i <= 31; $i++) { ?>
							<option value="<?=$i?>"><?=$i?></option>
						<?php } ?>
					</select>
					<select id="month">
						<option value="0" selected="selected" disabled="disabled">Mês</option>
						<option value="1">Janeiro</option>
						<option value="2">Fevereiro</option>
						<option value="3">Março</option>
						<option value="4">Abril</option>
						<option value="5">Maio</option>
						<option value="6">Junho</option>
						<option value="7">Julho</option>
						<option value="8">Agosto</option>
						<option value="9">Setembro</option>
						<option value="10">Outubro</option>
						<option value="11">Novembro</option>
						<option value="12">Dezembro</option>
					</select>
					<select id="year">
						<option value="0" selected="selected" disabled="disabled">Ano</option>
						<?php for($i = date("Y"); $i > 1900; $i--) { ?>
							<option value="<?=$i?>"><?=$i?></option>
						<?php } ?>
					</select>
					<img src="help.png">
				</div>
			</div>
			<div id="reg_error" class="error">Ocorreu um erro.</div>
			<input id="register_btn" class="green" type="submit" value="Registar">
		</form>
		<div id="register_success">
			O registo foi efetuado com sucesso.
			<span id="email_activation">
				<br>Irá receber um email com um link para activar a conta.
			</span>
		</div>
	</div>
	<script src="js/jquery.js"></script>
	<!--<script src="js/materialize.js"></script>-->
	<script src="js/script.js"></script>
</body>
</html>
