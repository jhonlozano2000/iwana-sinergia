$(document).ready(function(){

	$('#BtnEnviar').click(function(){

		$.ajax({
			url: 'acciones.ajax.php',
			type: 'POST',
			data: 'texto='+$('#example').val(),
			beforeSend: function(){

			},
			success: function(msj){
				alert(msj)
			},
			error: function(){

			}
		});
	});
});