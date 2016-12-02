$('a.make_adult').on('click', function(e) {
	e.stopPropagation();
	e.preventDefault();

	var user_id = $(this).attr('href').replace('#', '');

	$.ajax({
		type: "POST",
		url: "make_adult.php",
		data: { 'user_id': user_id },
		success: function(res) {
			location.reload();
		},
		error: function(xhr, textStatus, errorThrown) {
			window.alert("A alteração do tipo de utilizador falhou.");
		}
	});
});