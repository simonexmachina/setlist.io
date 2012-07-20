$(function() {
	$('#theme-select')
		.val($('#theme').attr('class'))
		.on('change', function() {
			$('#theme').attr('class', $(this).val());
		});

});