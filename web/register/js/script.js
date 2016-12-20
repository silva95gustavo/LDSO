function emailLoading(enabled) {
	if(enabled) {
		$('#frm_email input').css('opacity', 0.1);
		$('#frm_email .loading').css('opacity', 1);
	} else {
		$('#frm_email input').css('opacity', 1);
		$('#frm_email .loading').css('opacity', 0);
	}
}

function lockEmailInput(enabled) {
	if(enabled)
		$('#frm_email input').attr('disabled', 'disabled');
	else
		$('#frm_email input').removeAttr('disabled');
}

function emailError(show, msg) {
	if(show) {
		$("#frm_email .error").html(msg);
		$("#frm_email .error").slideDown();
	} else {
		$("#frm_email .error").slideUp();
	}
}

function updateCheckbox(path, checked, disabled) {
	$(path).prop("checked", checked);

	if(typeof disabled !== 'undefined') {
		if(disabled)
			$(path).attr('disabled', 'disabled');
		else
			$(path).removeAttr('disabled');
	}
}

function onCheckboxChange() {
	var chkbox1 = $("#chk_register_site");
	if(chkbox1.prop('checked') && chkbox1.attr('disabled') != 'disabled')
		$("#register_website .data").slideDown();
	else
		$("#register_website .data").slideUp();

	var chkbox2 = $("#chk_register_community");
	if(chkbox2.prop('checked') && chkbox2.attr('disabled') != 'disabled')
		$("#register_community .data").slideDown();
	else
		$("#register_community .data").slideUp();
}

$("#chk_register_site").change(onCheckboxChange);
$("#chk_register_community").change(onCheckboxChange);

function updateControls(registered_site, registered_community, activated) {
	if(!activated)
		$('#not_activated').slideDown();
	else {
		updateCheckbox('#chk_register_site', registered_site, registered_site);
		updateCheckbox('#chk_register_community', registered_community, registered_community);

		if(reg_community && !registered_community) {
			if(!registered_site)
				$('#chk_register_site').prop("checked", false);
			$('#chk_register_community').prop("checked", true);
		}

		$('#register_btn').show();

		if(registered_site && registered_community) {
			lockEmailInput(false);
			$('#already_registered_msg').html("O email já se encontra registado no site e na comunidade.");
			$('#not_registered').hide();
			$('#register_website .data').hide();
			$('#register_community .data').hide();
			$('#existing_password').hide();
			$('#register_btn').hide();
		} else if(registered_site || registered_community) {
			$('#not_registered').hide();
			if(registered_site)
				$('#already_registered_msg').html("O email já se encontra registado no site. Por favor, introduza a sua password.");
			else
				$('#already_registered_msg').html("O email já se encontra registado na comunidade. Por favor, introduza a sua password.");
			
			if(reg_community)
				$("#chk_register_site").prop('checked', true);

			$('#existing_password').show();
		} else {
			if(!reg_community)
				$("#chk_register_site").prop('checked', true);
			else
				$('#chk_register_community').prop("checked", true);

			$('#already_registered').hide();
			$('#not_registered').show();
		}

		onCheckboxChange();

		$('#frm_register').slideDown();
	}
}

var registered_site = false;
var registered_community = false;
var activated = false;

$('#frm_email').on('submit', function(e) {
	e.stopPropagation();
	e.preventDefault();

	emailLoading(true);
	lockEmailInput(true);
	emailError(false);

	$.ajax({
		type: "POST",
		url: "ajax/email_check.php",
		dataType: 'json',
		data: { 'email': $('#email').val() },
		success: function(res) {
			console.log(res);
			emailLoading(false);
			if(res.success) {
				registered_site = res.registered_site;
				registered_community = res.registered_community;
				activated = res.activated;
				console.log(res);
				updateControls(registered_site, registered_community, activated);
			} else {
				emailError(true, res.message);
				lockEmailInput(false);
			}
		},
		error: function(xhr, textStatus, errorThrown) {
			console.log(xhr);
			emailLoading(false);
			lockEmailInput(false);

			if(xhr.responseJSON)
				emailError(true, xhr.responseJSON.message);
			else
				emailError(true, "Registo falhou. Tente novamente mais tarde.");
		}
	});
});

function registerError(show, msg) {
	if(show) {
		$("#reg_error").html(msg);
		$("#reg_error").slideDown();
	} else {
		$("#reg_error").hide('fast');
	}
}

$('#frm_register').on('submit', function(e) {
	e.stopPropagation();
	e.preventDefault();

	registerError(false);

	$('input.error').removeClass('error');

	var obj = new Object();
	obj.email = $('#email').val();

	if(registered_site || registered_community) {
		// Get the already existing password
		obj.password = $('#existing_password').val();

		if(obj.password == "") {
			registerError(true, "Por favor introduza uma password.");
			$('#existing_password').addClass('error');
			return;
		}
	} else {
		var password1 = $('#new_password').val();
		var password2 = $('#new_password2').val();

		if(password1 == "") {
			registerError(true, "Por favor introduza uma password.");
			$('#new_password').addClass('error');
			$('#new_password2').addClass('error');
			return;
		} else if(password1 != password2) {
			$('#new_password').addClass('error');
			$('#new_password2').addClass('error');
			registerError(true, "As passwords são diferentes.");
			return;
		}

		obj.password = $('#new_password').val();
	}

	var chk_reg_site = $("#chk_register_site");
	var chk_reg_community = $("#chk_register_community");
	var reg_site = chk_reg_site.prop('checked') && !registered_site;
	var reg_community = chk_reg_community.prop('checked') && !registered_community;

	if(!reg_site && !reg_community) {
		// Not registering anywhere
		registerError(true, "Por favor seleccione o registo pretendido.");
		return;
	}

	if(reg_site) {
		obj.register_site = true;

		var name = $("#name").val();
		if(name != "")
			obj.name = name;

		var associate_nr = $("#associate_nr").val();
		if(associate_nr != "")
			obj.associate_nr = associate_nr;
	}

	if(reg_community) {
		obj.register_community = true;

		var nickname = $("#nickname").val();

		if(nickname == "") {
			// TODO No nickname
			registerError(true, "Por favor introduza um nickname para a comunidade.");
			$('#nickname').addClass('error');
			return;
		}

		obj.nickname = nickname;

		var bday_d = $("#day option:selected").val();
		var bday_m = $("#month option:selected").val();
		var bday_y = $("#year option:selected").val();

		if(bday_d == 0 || bday_m == 0 || bday_y == 0) {
			registerError(true, "Por favor seleccione uma data de nascimento válida.");
			return;
		}

		obj.birthday = { y: bday_y, m: bday_m, d: bday_d };
	}

	// Register

	$('#register_btn').attr('disabled', 'disabled');

	$.ajax({
		url: "ajax/register.php",
		type: "POST",
		//dataType: 'json',
		contentType: 'application/json',
		data: JSON.stringify(obj),
		success: function(res) {
			console.log(res);
			$('#register_btn').removeAttr('disabled');
			$("#register_success").slideDown();
			$("#frm_register").slideUp();
			if(registered_site || registered_community) {
				$("#email_activation").hide();
			}
		},
		error: function(xhr, textStatus, errorThrown) {
			console.log(xhr);
			$('#register_btn').removeAttr('disabled');
			if(xhr.responseJSON)
				registerError(true, xhr.responseJSON.message);
			else
				registerError(true, "Registo falhou. Tente novamente mais tarde.");
		}
	});
});

$('#activate_btn').on('click', function(e) {
	e.preventDefault();
	e.stopPropagation();

	$('#activate_btn').attr('disabled', 'disabled');

	$.ajax({
		url: "ajax/resend.php",
		type: "POST",
		data: {email: $('#email').val() },
		success: function(res) {
			console.log(res);
			$('#not_activated').slideUp();
			$('#email_resent').slideDown();
		},
		error: function(xhr, textStatus, errorThrown) {
			console.log(xhr);
			$('#not_activated').slideUp();
			if(xhr.responseJSON)
				$("#resend_error").html(xhr.responseJSON.message);
			else
				$("#resend_error").html("Envio falhou. Tente novamente mais tarde.");
			$("#resend_error").slideDown();
		}
	});
});