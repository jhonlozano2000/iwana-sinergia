$(document).ready(function () {

	$('#BtnFlujoPorFuncioEXCEL').click(function () {
		if ($('#desde').val() == "") {
			$('#DivAlertas').html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo falta la fecha de inicio.</div>');
			$('#desde').focud();
		} else if ($('#hasta').val() == "") {
			$('#DivAlertas').html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo falta la fecha de inicio.</div>');
			$('#hasta').focus();
		} else {

			$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');

			setTimeout(function () {
				url = "reporte_pqrsf.php?desde=" + $('#desde').val() + '&hasta=' + $('#hasta').val();

				window.open(url, 'Download');

				$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El reporte se genero correctamente. </div>');
			}, 200);
		}
	});
});
