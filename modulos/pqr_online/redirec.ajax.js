$(document).ready(function () {

	$('#BtnEntrar').click(function () {
		setTimeout(function () {
			if ($('#login').val() == "") {
				$("#divAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el nombre de usuario.</div>');
				$('#login').focus();
			} else if ($('#contra').val() == "") {
				$("#divAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta la contraseña.</div>');
				$('#password').focus();
			} else {
				$.ajax({
					type: 'POST',
					url: '../../modulos/pqr_online/redirect.php',
					data: 'accion=LOGGIN&login=' + $('#login').val() + '&password=' + $('#password').val(),
					beforeSend: function () {
						$("#divAlerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
					},
					success: function (msj) {
						console.log(msj);
						if (msj == 1) {
							$("#divAlerta").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> Espera un momento, estamos cargando tu entorno.</div>');

							setTimeout(function () {
								window.location.href = "pqr_panel";
							}, 500);
						} else {
							$("#divAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> ' + msj + '.</div>');
						}
					},
					error: function (msj) {
						$("#divAlerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + '</div>');
					}
				});
			}
		}, 300);
		return false;
	});

	$('#BtnCanelar').click(function () {
		setTimeout(function () {
			window.location.href = "index.php";
		});
	});
});