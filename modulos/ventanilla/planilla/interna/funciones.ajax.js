$(document).ready(function(){
	$('#BtnBuscarPorFecha').click(function(e){
		e.preventDefault();

		$("#DivAlertasPlanillaInternas").empty();
		
		if($('#desde_fec').val() == "" ){
			$('#DivAlertasPlanillaInternas').html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo falta la fecha de inicio.</div>');
			$('#desde_fec').focus();
		}else if($('#desde_hora').val() == "" ){
			$('#DivAlertasPlanillaInternas').html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo falta la hora de inicio.</div>');
			$('#desde_hora').focus();
		}else if($('#hasta_fec').val() == "" ){
			$('#DivAlertasPlanillaInternas').html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo falta la fecha de finalizacion.</div>');
			$('#hasta_fec').focus();
		}else if($('#hasta_hora').val() == "" ){
			$('#DivAlertasPlanillaInternas').html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo falta la hora de finalizacion.</div>');
			$('#hasta_hora').focus();
		}else{
			url = "../../../reportes/ventanilla/planilla_internas/index.php?accion=Fecha&FechaInicio="+$('#desde_fec').val()+"&HoraInicio="+$('#desde_hora').val()+"&FechaFin="+$('#hasta_fec').val()+"&HoraFin="+$('#hasta_hora').val();
			window.open(url, 'Download');		
		}
	});

	$('#BtnBuscarPorRadicados').click(function(e){
		e.preventDefault();

		$("#DivAlertasPlanillaInternas").empty();
		
		if($('#radicado_desde').val() == "" ){
			$('#DivAlertasPlanillaInternas').html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo falta el redicado de inicio.</div>');
			$('#radicado_desde').focus();
		}else if($('#radicado_hasta').val() == "" ){
			$('#DivAlertasPlanillaInternas').html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo falta el redicado de finalización.</div>');
			$('#radicado_hasta').focus();
		}else{
			url = "../../../reportes/ventanilla/planilla_internas/planilla_recibidas.php?accion=Radicado&radicado_desde="+$('#radicado_desde').val()+"&radicado_hasta="+$('#radicado_hasta').val();
			window.open(url, 'Download');		
		}
	});

	$('#Ultimos3Dias').click(function(e){
		e.preventDefault();

		var FechaActual = new Date();
		var d = new Date();
		var Fecha = sumarDias(d, -3);

		FechaIni = (Fecha.getMonth() + 1) + '/' +  Fecha.getDate() + '/' + Fecha.getFullYear();
		FechaFin = (FechaActual.getMonth() + 1) + '/' +  FechaActual.getDate() + '/' + FechaActual.getFullYear();
		
		url = "../../../reportes/ventanilla/planilla_internas/index.php?accion=Fecha&FechaInicio="+FechaIni+"&HoraInicio=23:55&FechaFin="+FechaFin+"&HoraFin=00:00";
		window.open(url, 'Download');
	});

	$('#Ultimos5Dias').click(function(e){
		e.preventDefault();

		var FechaActual = new Date();
		var d = new Date();
		var Fecha = sumarDias(d, -5);

		FechaIni = (Fecha.getMonth() + 1) + '/' +  Fecha.getDate() + '/' + Fecha.getFullYear();
		FechaFin = (FechaActual.getMonth() + 1) + '/' +  FechaActual.getDate() + '/' + FechaActual.getFullYear();
		
		url = "../../../reportes/ventanilla/planilla_internas/index.php?accion=Fecha&FechaInicio="+FechaIni+"&HoraInicio=23:55&FechaFin="+FechaFin+"&HoraFin=00:00";
		window.open(url, 'Download');
	});

	$('#Ultimos7Dias').click(function(e){
		e.preventDefault();

		var FechaActual = new Date();
		var d = new Date();
		var Fecha = sumarDias(d, -7);

		FechaIni = (Fecha.getMonth() + 1) + '/' +  Fecha.getDate() + '/' + Fecha.getFullYear();
		FechaFin = (FechaActual.getMonth() + 1) + '/' +  FechaActual.getDate() + '/' + FechaActual.getFullYear();
		
		url = "../../../reportes/ventanilla/planilla_internas/index.php?accion=Fecha&FechaInicio="+FechaIni+"&HoraInicio=23:55&FechaFin="+FechaFin+"&HoraFin=00:00";
		window.open(url, 'Download');
	});

	$('#Ultimos14Dias').click(function(e){
		e.preventDefault();

		var FechaActual = new Date();
		var d = new Date();
		var Fecha = sumarDias(d, -14);

		FechaIni = (Fecha.getMonth() + 1) + '/' +  Fecha.getDate() + '/' + Fecha.getFullYear();
		FechaFin = (FechaActual.getMonth() + 1) + '/' +  FechaActual.getDate() + '/' + FechaActual.getFullYear();
		
		url = "../../../reportes/ventanilla/planilla_internas/index.php?accion=Fecha&FechaInicio="+FechaIni+"&HoraInicio=23:55&FechaFin="+FechaFin+"&HoraFin=00:00";
		window.open(url, 'Download');
	});

	$('#Ultimos30Dias').click(function(e){
		e.preventDefault();

		var FechaActual = new Date();
		var d = new Date();
		var Fecha = sumarDias(d, -30);

		FechaIni = (Fecha.getMonth() + 1) + '/' +  Fecha.getDate() + '/' + Fecha.getFullYear();
		FechaFin = (FechaActual.getMonth() + 1) + '/' +  FechaActual.getDate() + '/' + FechaActual.getFullYear();
		
		url = "../../../reportes/ventanilla/planilla_internas/index.php?accion=Fecha&FechaInicio="+FechaIni+"&HoraInicio=23:55&FechaFin="+FechaFin+"&HoraFin=00:00";
		window.open(url, 'Download');
	});

	function sumarDias(fecha, dias){
		fecha.setDate(fecha.getDate() + dias);
		return fecha;
	}
});