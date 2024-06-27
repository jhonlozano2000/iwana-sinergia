$(document).ready(function () {

	$('#BtnFlujoPorFuncioEXCEL').click(function () {
		if ($('#tipo_reporte').val() == 0) {
			$('#DivAlertas').html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo falta el tipo de reporte.</div>');
			$('#tipo_reporte').focus();
		} else if ($('#desde').val() == "") {
			$('#DivAlertas').html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo falta la fecha de inicio.</div>');
			$('#desde').focud();
		} else if ($('#hasta').val() == "") {
			$('#DivAlertas').html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo falta la fecha de inicio.</div>');
			$('#hasta').focus();
		} else if ($('#origen_correspon').val() == 0) {
			$('#DivAlertas').html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo falta el origen de la correspondencia.</div>');
			$('#origen_correspon').focus();
		} else {

			var ChkRadicado = false;
			var ChkTercero = false;
			var ChkFuncionario = false;
			var ChkFechaHoraRadica = false;
			var ChkFechaDocumento = false;
			var ChkFechaVencimiento = false;
			var ChkAsunto = false;
			var ChkDependencia = false;
			var ChkOficina = false;
			var ChkSerie = false;
			var ChkSubSerie = false;
			var ChkTipoDocumento = false;
			var ChkRadicadoRespuesta = false;
			var ChkAsuntoRespuesta = false;
			var ChkFecHorRespuesta = false;
			var ChkQuienRadico = false;
			var ChkRequiereDigital = false;
			var ChkFormaRecepcion = false;

			if ($('#ChkRadicado').is(':checked')) {
				ChkRadicado = true;
			}

			if ($('#ChkTercero').is(':checked')) {
				ChkTercero = true;
			}

			if ($('#ChkFuncionario').is(':checked')) {
				ChkFuncionario = true;
			}

			if ($('#ChkFechaHoraRadica').is(':checked')) {
				ChkFechaHoraRadica = true;
			}

			if ($('#ChkFechaDocumento').is(':checked')) {
				ChkFechaDocumento = true;
			}

			if ($('#ChkFechaVencimiento').is(':checked')) {
				ChkFechaVencimiento = true;
			}

			if ($('#ChkAsunto').is(':checked')) {
				ChkAsunto = true;
			}

			if ($('#ChkDependencia').is(':checked')) {
				ChkDependencia = true;
			}

			if ($('#ChkOficina').is(':checked')) {
				ChkOficina = true;
			}

			if ($('#ChkSerie').is(':checked')) {
				ChkSerie = true;
			}

			if ($('#ChkSubSerie').is(':checked')) {
				ChkSubSerie = true;
			}

			if ($('#ChkTipoDocumento').is(':checked')) {
				ChkTipoDocumento = true;
			}

			if ($('#ChkRadicadoRespuesta').is(':checked')) {
				ChkRadicadoRespuesta = true;
			}

			if ($('#ChkAsuntoRespuesta').is(':checked')) {
				ChkAsuntoRespuesta = true;
			}

			if ($('#ChkFecHorRespuesta').is(':checked')) {
				ChkFecHorRespuesta = true;
			}

			if ($('#ChkQuienRadico').is(':checked')) {
				ChkQuienRadico = true;
			}

			if ($('#ChkRequiereDigital').is(':checked')) {
				ChkRequiereDigital = true;
			}

			if ($('#ChkFormaRecepcion').is(':checked')) {
				ChkFormaRecepcion = true;
			}

			if ($('#origen_correspon').val() === 'CORRES_RECIBIDA') {

				$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');

				setTimeout(function () {
					url = "reporte_excel_detallado_recibida.php?origen_correspon=" + $('#origen_correspon').val() + "&desde=" + $('#desde').val() + '&hasta=' + $('#hasta').val() + '&id_tercero=' + $('#id_tercero').val() + '&tipo_tercero=' + $('#tipo_tercero').val() + '&id_funcionario=' + $('#id_funcionario').val() + '&id_depen=' + $('#id_depen').val() + '&id_serie=' + $('#id_serie').val() + '&id_subserie=' + $('#id_subserie').val() + '&id_tipodoc=' + $('#id_tipodoc').val() + '&ChkRadicado=' + ChkRadicado + '&ChkTercero=' + ChkTercero + '&ChkFuncionario=' + ChkFuncionario + '&ChkFechaHoraRadica=' + ChkFechaHoraRadica + '&ChkTipoDocumento=' + ChkTipoDocumento + '&ChkFechaVencimiento=' + ChkFechaVencimiento + '&ChkAsunto=' + ChkAsunto + '&ChkDependencia=' + ChkDependencia + '&ChkOficina=' + ChkOficina + '&ChkSerie=' + ChkSerie + '&ChkSubSerie=' + ChkSubSerie + '&ChkTipoDocumento=' + ChkTipoDocumento + '&ChkRadicadoRespuesta=' + ChkRadicadoRespuesta + '&ChkAsuntoRespuesta=' + ChkAsuntoRespuesta + '&ChkFecHorRespuesta=' + ChkFecHorRespuesta + '&ChkQuienRadico=' + ChkQuienRadico + '&ChkRequiereDigital=' + ChkRequiereDigital + '&ChkFormaRecepcion=' + ChkFormaRecepcion;

					window.open(url, 'Download');

					$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El reporte se genero correctamente. </div>');
				}, 200);

			}

			if ($('#origen_correspon').val() === 'CORRES_ENVIADA') {

				$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');

				setTimeout(function () {
					url = "reporte_excel_detallado_enviada.php?origen_correspon=" + $('#origen_correspon').val() + "&desde=" + $('#desde').val() + '&hasta=' + $('#hasta').val() + '&id_tercero=' + $('#id_tercero').val() + '&tipo_tercero=' + $('#tipo_tercero').val() + '&id_funcionario=' + $('#id_funcionario').val() + '&id_depen=' + $('#id_depen').val() + '&id_serie=' + $('#id_serie').val() + '&id_subserie=' + $('#id_subserie').val() + '&id_tipodoc=' + $('#id_tipodoc').val() + '&ChkRadicado=' + ChkRadicado + '&ChkTercero=' + ChkTercero + '&ChkFuncionario=' + ChkFuncionario + '&ChkFechaHoraRadica=' + ChkFechaHoraRadica + '&ChkTipoDocumento=' + ChkTipoDocumento + '&ChkFechaVencimiento=' + ChkFechaVencimiento + '&ChkAsunto=' + ChkAsunto + '&ChkDependencia=' + ChkDependencia + '&ChkOficina=' + ChkOficina + '&ChkSerie=' + ChkSerie + '&ChkSubSerie=' + ChkSubSerie + '&ChkTipoDocumento=' + ChkTipoDocumento + '&ChkRadicadoRespuesta=' + ChkRadicadoRespuesta + '&ChkAsuntoRespuesta=' + ChkAsuntoRespuesta + '&ChkFecHorRespuesta=' + ChkFecHorRespuesta + '&ChkQuienRadico=' + ChkQuienRadico + '&ChkRequiereDigital=' + ChkRequiereDigital + '&ChkFormaRecepcion=' + ChkFormaRecepcion;

					window.open(url, 'Download');

					$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El reporte se genero correctamente. </div>');
				}, 200);
			}

			if ($('#origen_correspon').val() === 'CORRES_INTERNA') {

				$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');

				setTimeout(function () {
					url = "reporte_excel_detallado_interna.php?origen_correspon=" + $('#origen_correspon').val() + "&desde=" + $('#desde').val() + '&hasta=' + $('#hasta').val() + '&id_tercero=' + $('#id_tercero').val() + '&tipo_tercero=' + $('#tipo_tercero').val() + '&id_funcionario=' + $('#id_funcionario').val() + '&id_depen=' + $('#id_depen').val() + '&id_serie=' + $('#id_serie').val() + '&id_subserie=' + $('#id_subserie').val() + '&id_tipodoc=' + $('#id_tipodoc').val() + '&ChkRadicado=' + ChkRadicado + '&ChkTercero=' + ChkTercero + '&ChkFuncionario=' + ChkFuncionario + '&ChkFechaHoraRadica=' + ChkFechaHoraRadica + '&ChkTipoDocumento=' + ChkTipoDocumento + '&ChkFechaVencimiento=' + ChkFechaVencimiento + '&ChkAsunto=' + ChkAsunto + '&ChkDependencia=' + ChkDependencia + '&ChkOficina=' + ChkOficina + '&ChkSerie=' + ChkSerie + '&ChkSubSerie=' + ChkSubSerie + '&ChkTipoDocumento=' + ChkTipoDocumento + '&ChkRadicadoRespuesta=' + ChkRadicadoRespuesta + '&ChkAsuntoRespuesta=' + ChkAsuntoRespuesta + '&ChkFecHorRespuesta=' + ChkFecHorRespuesta;

					window.open(url, 'Download');

					$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El reporte se genero correctamente. </div>');
				}, 200);
			}
		}
	});

	$('#BtnFlujoPorFuncioPDF').click(function () {
		if ($('#tipo_reporte').val() == 0) {
			$('#DivAlertas').html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo falta el tipo de reporte.</div>');
			$('#tipo_reporte').focus();
		} else if ($('#desde').val() == "") {
			$('#DivAlertas').html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo falta la fecha de inicio.</div>');
			$('#desde').focud();
		} else if ($('#hasta').val() == "") {
			$('#DivAlertas').html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo falta la fecha de inicio.</div>');
			$('#hasta').focus();
		} else if ($('#origen_correspon').val() == 0) {
			$('#DivAlertas').html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo falta el origen de la correspondencia.</div>');
			$('#origen_correspon').focus();
		} else {

			var ChkRadicado = false;
			var ChkTercero = false;
			var ChkFuncionario = false;
			var ChkFechaHoraRadica = false;
			var ChkFechaDocumento = false;
			var ChkFechaVencimiento = false;
			var ChkAsunto = false;
			var ChkDependencia = false;
			var ChkOficina = false;
			var ChkSerie = false;
			var ChkSubSerie = false;
			var ChkTipoDocumento = false;
			var ChkRadicadoRespuesta = false;
			var ChkAsuntoRespuesta = false;
			var ChkFecHorRespuesta = false;
			var ChkFormaRecepcion = false;

			if ($('#ChkRadicado').is(':checked')) {
				ChkRadicado = true;
			}

			if ($('#ChkTercero').is(':checked')) {
				ChkTercero = true;
			}

			if ($('#ChkFuncionario').is(':checked')) {
				ChkFuncionario = true;
			}

			if ($('#ChkFechaHoraRadica').is(':checked')) {
				ChkFechaHoraRadica = true;
			}

			if ($('#ChkFechaDocumento').is(':checked')) {
				ChkFechaDocumento = true;
			}

			if ($('#ChkFechaVencimiento').is(':checked')) {
				ChkFechaVencimiento = true;
			}

			if ($('#ChkAsunto').is(':checked')) {
				ChkAsunto = true;
			}

			if ($('#ChkDependencia').is(':checked')) {
				ChkDependencia = true;
			}

			if ($('#ChkOficina').is(':checked')) {
				ChkOficina = true;
			}

			if ($('#ChkSerie').is(':checked')) {
				ChkSerie = true;
			}

			if ($('#ChkSubSerie').is(':checked')) {
				ChkSubSerie = true;
			}

			if ($('#ChkTipoDocumento').is(':checked')) {
				ChkTipoDocumento = true;
			}

			if ($('#ChkRadicadoRespuesta').is(':checked')) {
				ChkRadicadoRespuesta = true;
			}

			if ($('#ChkAsuntoRespuesta').is(':checked')) {
				ChkAsuntoRespuesta = true;
			}

			if ($('#ChkFecHorRespuesta').is(':checked')) {
				ChkFecHorRespuesta = true;
			}

			if ($('#ChkFormaRecepcion').is(':checked')) {
				ChkFormaRecepcion = true;
			}

			if ($('#origen_correspon').val() === 'CORRES_RECIBIDA') {

				$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');

				setTimeout(function () {
					url = "reporte_pdf_detallado_recibida.php?origen_correspon=" + $('#origen_correspon').val() + "&desde=" + $('#desde').val() + '&hasta=' + $('#hasta').val() + '&id_tercero=' + $('#id_tercero').val() + '&tipo_tercero=' + $('#tipo_tercero').val() + '&id_funcionario=' + $('#id_funcionario').val() + '&id_depen=' + $('#id_depen').val() + '&id_serie=' + $('#id_serie').val() + '&id_subserie=' + $('#id_subserie').val() + '&id_tipodoc=' + $('#id_tipodoc').val() + '&ChkRadicado=' + ChkRadicado + '&ChkTercero=' + ChkTercero + '&ChkFuncionario=' + ChkFuncionario + '&ChkFechaHoraRadica=' + ChkFechaHoraRadica + '&ChkFechaDocumento=' + ChkFechaDocumento + '&ChkFechaVencimiento=' + ChkFechaVencimiento + '&ChkAsunto=' + ChkAsunto + '&ChkDependencia=' + ChkDependencia + '&ChkOficina=' + ChkOficina + '&ChkSerie=' + ChkSerie + '&ChkSubSerie=' + ChkSubSerie + '&ChkTipoDocumento=' + ChkTipoDocumento + '&ChkRadicadoRespuesta=' + ChkRadicadoRespuesta + '&ChkAsuntoRespuesta=' + ChkAsuntoRespuesta + '&ChkFecHorRespuesta=' + ChkFecHorRespuesta + '&ChkFormaRecepcion=' + ChkFormaRecepcion;
					window.open(url, 'Download');

					$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El reporte se genero correctamente. </div>');
				}, 200);
			}

			if ($('#origen_correspon').val() === 'CORRES_ENVIADA') {

				$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');

				setTimeout(function () {
					url = "reporte_pdf_detallado_enviada.php?origen_correspon=" + $('#origen_correspon').val() + "&desde=" + $('#desde').val() + '&hasta=' + $('#hasta').val() + '&id_tercero=' + $('#id_tercero').val() + '&tipo_tercero=' + $('#tipo_tercero').val() + '&id_funcionario=' + $('#id_funcionario').val() + '&id_depen=' + $('#id_depen').val() + '&id_serie=' + $('#id_serie').val() + '&id_subserie=' + $('#id_subserie').val() + '&id_tipodoc=' + $('#id_tipodoc').val() + '&ChkRadicado=' + ChkRadicado + '&ChkTercero=' + ChkTercero + '&ChkFuncionario=' + ChkFuncionario + '&ChkFechaHoraRadica=' + ChkFechaHoraRadica + '&ChkFechaDocumento=' + ChkFechaDocumento + '&ChkFechaVencimiento=' + ChkFechaVencimiento + '&ChkAsunto=' + ChkAsunto + '&ChkDependencia=' + ChkDependencia + '&ChkOficina=' + ChkOficina + '&ChkSerie=' + ChkSerie + '&ChkSubSerie=' + ChkSubSerie + '&ChkTipoDocumento=' + ChkTipoDocumento + '&ChkRadicadoRespuesta=' + ChkRadicadoRespuesta + '&ChkAsuntoRespuesta=' + ChkAsuntoRespuesta + '&ChkFecHorRespuesta=' + ChkFecHorRespuesta + '&ChkFormaRecepcion=' + ChkFormaRecepcion;
					window.open(url, 'Download');

					$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El reporte se genero correctamente. </div>');
				}, 200);
			}

			if ($('#origen_correspon').val() === 'CORRES_INTERNA') {

				$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');

				setTimeout(function () {
					url = "reporte_pdf_detallado_interna.php?origen_correspon=" + $('#origen_correspon').val() + "&desde=" + $('#desde').val() + '&hasta=' + $('#hasta').val() + '&id_tercero=' + $('#id_tercero').val() + '&tipo_tercero=' + $('#tipo_tercero').val() + '&id_funcionario=' + $('#id_funcionario').val() + '&id_depen=' + $('#id_depen').val() + '&id_serie=' + $('#id_serie').val() + '&id_subserie=' + $('#id_subserie').val() + '&id_tipodoc=' + $('#id_tipodoc').val() + '&ChkRadicado=' + ChkRadicado + '&ChkTercero=' + ChkTercero + '&ChkFuncionario=' + ChkFuncionario + '&ChkFechaHoraRadica=' + ChkFechaHoraRadica + '&ChkFechaDocumento=' + ChkFechaDocumento + '&ChkFechaVencimiento=' + ChkFechaVencimiento + '&ChkAsunto=' + ChkAsunto + '&ChkDependencia=' + ChkDependencia + '&ChkOficina=' + ChkOficina + '&ChkSerie=' + ChkSerie + '&ChkSubSerie=' + ChkSubSerie + '&ChkTipoDocumento=' + ChkTipoDocumento + '&ChkRadicadoRespuesta=' + ChkRadicadoRespuesta + '&ChkAsuntoRespuesta=' + ChkAsuntoRespuesta + '&ChkFecHorRespuesta=' + ChkFecHorRespuesta;
					window.open(url, 'Download');

					$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El reporte se genero correctamente. </div>');
				}, 200);
			}
		}
	});

	$('#BtnReportePQRSF').click(function () {
		console.log($("#id_subserie").val())
		if ($('#desde').val() == "") {
			$('#DivAlertas').html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo falta la fecha de inicio.</div>');
			$('#desde').focud();
		} else if ($('#hasta').val() == "") {
			$('#DivAlertas').html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo falta la fecha de inicio.</div>');
			$('#hasta').focus();
		} else {

			$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');

			setTimeout(function () {
				url = "reporte_pqrsf.php?id_depen=" + $("#id_depen").val() + "&id_oficina=" + $("#id_oficina").val() + "&id_serie=" + $("#id_serie").val() + "&id_subserie=" + $("#id_subserie").val() + "&id_tipodoc=" + $("#id_tipodoc").val() + "&desde=" + $('#desde').val() + '&hasta=' + $('#hasta').val();

				window.open(url, 'Download');

				$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El reporte se genero correctamente. </div>');
			}, 200);
		}
	});

	$("#id_depen").change(function () {
		/* if ($("#id_depen").val() != 0) {
			$.post("../../../varios/combo_series.php", {
				id_depen: $('#id_depen').val()
			}, function (data) {
				console.log(data);
				$("#id_serie").html(data);
			});
		} */
		var IdDepen = $("#id_depen").val();
		var IdOficina = $("#id_oficina").val();
		var IncluirOficinaTRD = $('#incluir_oficina_trd').val();

		if ($("#incluir_oficina_trd").val() == 1) {

			$.post("../../../varios/combo_series.php", {
				id_depen: IdDepen,
				id_oficina: '',
				IncluirOficinaTRD: IncluirOficinaTRD
			}, function (data) {
				$("#id_serie").html(data);
			});
		} else if ($("#incluir_oficina_trd").val() == 2) {

			$.post("../../varios/combo_oficinas.php", {
				idDepen: idDepen
			}, function (data) {
				$("#id_oficina").html(data);
			});
		}
	});

	$("#id_oficina").change(function () {
		var IdDepen = $("#id_depen").val();
		var IdOficina = $("#id_oficina").val();
		var IncluirOficinaTRD = $('#incluir_oficina_trd').val();

		$('#id_depen').val(IdDepen);
		$('#id_oficina').val(IdOficina);

		$.post("../../../varios/combo_series.php", {
			id_depen: IdDepen,
			id_oficina: IdOficina,
			IncluirOficinaTRD: IncluirOficinaTRD
		}, function (data) {
			$("#id_serie").html(data);
		});
	});

	$("#id_serie").change(function () {
		if ($("#id_serie").val() != 0) {
			$.post("../../../varios/combo_sub_series.php", {
				id_serie: $("#id_serie").val(),
				id_depen: $('#id_depen').val()
			}, function (data) {
				$("#id_subserie").html(data);
			});
		}
	});

	$("#id_subserie").change(function () {
		if ($("#id_subserie").val() != 0) {
			var id_serie = $("#id_serie").val();
			var id_sub_serie = $("#id_subserie").val();

			$.post("../../../varios/combo_tipos_documentos.php", {
				accion: "",
				id_depen: $('#id_depen').val(),
				id_serie: id_serie,
				id_sub_serie: id_sub_serie
			}, function (data) {
				$("#id_tipodoc").html(data);
			});
		}
	});

	$("#origen").change(function () {
		if ($(this).val() == "Recibido") {
			$('#tercero').attr('placeholder', 'Remitente');
			$('#destinatario').attr('placeholder', 'Destinatario');

		} else if ($(this).val() == "Enviado") {
			$('#tercero').attr('placeholder', 'Destinatario');
			$('#destinatario').attr('placeholder', 'Remitente');
		}
	});

	//FUNCION PARA LLEVAR EL DESTINATARIO NATURAL
	$(document).on('click', '#BtnLlevarTerceroNatural', function (event) {
		$('#id_tercero').val($(this).data('id_tercero_natural'));
		$('#tercero').val($(this).data('nombre_tercero_natural'));
		$('#tipo_tercero').val('NATURAL');
	});

	$('#BtnBuscarTerceroJuridico').click(function (e) {
		$("#TxtBusTerceroJuridicos").focus();
	});

	//FUNCION PARA BUSCAR EL TERCERO NATURAL
	$("#TxtBusTerceroJuridicos").keyup(function (e) {
		if (e.which == 13) {
			if ($("#TxtBusTerceroJuridicos").val() === "") {
				$("#DivAlertasTerceroJuridicos").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta ingresar el criterio de busqueda.</div>');
				$("#TxtBusTerceroJuridicos").focus();
			} else {
				$.ajax({
					url: '../../../ventanilla/varios/listar_tercero_juridico_empresa.php',
					type: 'POST',
					data: 'criterio=' + $("#TxtBusTerceroJuridicos").val(),
					beforeSend: function () {
						$("#DivAlertasTerceroJuridicos").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
					},
					success: function (msj) {
						$("#DivAlertasTerceroJuridicos").empty();
						if (msj != 1) {
							$("#DivTerceroJuridico").html(msj);
						} else {
							$("#DivAlertasTerceroJuridicos").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> ' + msj + '.</div>');
						}
					},
					error: function (msj) {
						$("#DivAlertasTerceroJuridicos").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + '</div>');
					}
				});
			}
		}
	});

	//FUNCION PARA LLEVAR EL TERCERO JURIDICO
	$(document).on('click', '#BtnLlevarTerceroJuridico', function (event) {
		$('#id_tercero').val($(this).data('id_empre'));
		$('#tercero').val($(this).data('entidad_tercero_juridoc'));
		$('#tipo_tercero').val('JURIDICO');
	});

	$('#TxtBusTerceroNaturales').click(function (e) {
		$("#TxtBusDestinaNaturales").focus();
	});

	$('#BtnEliminarTercero').click(function (e) {
		$("#id_tercero").val('');
		$("#tipo_tercero").val('');
		$("#tercero").val('');
	});

	//FUNCION PARA BUSCAR EL TERCERO NATURAL
	$("#TxtBusTerceroNaturales").keyup(function (e) {
		if (e.which == 13) {
			if ($("#TxtBusDestinaNaturales").val() === "") {
				$("#DivAlertasTerceroNaturales").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta ingresar el criterio de busqueda.</div>');
				$("#TxtBusDestinaNaturales").focus();
			} else {
				$.ajax({
					url: '../../../ventanilla/varios/listar_tercero_natural.php',
					type: 'POST',
					data: 'criterio=' + $("#TxtBusTerceroNaturales").val(),
					beforeSend: function () {
						$("#DivAlertasTerceroNaturales").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
					},
					success: function (msj) {
						if (msj != 1) {
							$("#DivTerceroNaturales").html(msj);
							$("#DivAlertasTerceroNaturales").empty();
						} else {
							$("#DivAlertasTerceroNaturales").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> ' + msj + '.</div>');
						}
					},
					error: function (msj) {
						$("#DivAlertasTerceroNaturales").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + '</div>');
					}
				});
			}
		}
	});

	//FUNCION PARA LLEVAR EL DESTINATARIO NATURAL
	$(document).on('click', '#BtnLlevarDestinatarioNatural', function (event) {
		$('#id_destinatario').val($(this).data('id_destinatario_natural'));
		$('#destinatario').val($(this).data('nombre_destinatario_natural'));
	});

	$('#BtnBuscarDestinatarioJuridico').click(function (e) {
		$("#TxtBusDestinaJuridicos").focus();
	});

	//FUNCION PARA BUSCAR EL TERCERO NATURAL
	$("#TxtBusDestinaJuridicos").keyup(function (e) {
		if (e.which == 13) {
			if ($("#DivAlertasTerceroJuridicos").val() === "") {
				$("#DivAlertasTerceroJuridicos").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta ingresar el criterio de busqueda.</div>');
				$("#TxtBusDestinaJuridicos").focus();
			} else {
				$.ajax({
					url: '../../../ventanilla/varios/listar_tercero_juridico.php',
					type: 'POST',
					data: 'criterio=' + $("#TxtBusDestinaJuridicos").val(),
					beforeSend: function () {
						$("#DivAlertasTerceroJuridicos").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
					},
					success: function (msj) {
						if (msj != 1) {
							$("#DivTerceroJuridico").html(msj);
							$("#DivTerceroJuridico").empty();
						} else {
							$("#DivAlertasTerceroJuridicos").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> ' + msj + '.</div>');
						}
					},
					error: function (msj) {
						$("#DivAlertasTerceroJuridicos").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + '</div>');
					}
				});
			}
		}
	});

	//FUNCION PARA LLEVAR EL DESTINATARIO JURIDICO
	$(document).on('click', '#BtnLlevarDestinatarioJuridico', function (event) {
		$('#id_destinatario').val($(this).data('id_destinatario_natural'));
		$('#destinatario').val($(this).data('nombre_destinatario_natural'));
	});

	$(document).on('click', '.llevar_funiconario', function (event) {
		event.preventDefault();
		$('#id_funcionario').val($(this).data('id_funcio'));
		$('#funcionario').val($(this).data('nombres') + ' ' + $(this).data('apellidos'));
	});

	$('#BtnEliminarFuncionario').click(function (e) {
		$("#id_funcionario").val('');
		$("#funcionario").val('');
	});
});
