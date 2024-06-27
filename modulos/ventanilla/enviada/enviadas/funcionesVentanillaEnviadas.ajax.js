+$(document).ready(function () {

	$('#BtnRadicar').click(function (event) {
		event.preventDefault();

		var QuienesFirman = new Array();
		var Responsables = new Array();
		var Proyectores = new Array();
		var RadicadosParaDarRespuesta = new Array();
		var HayQuienFirma = false;
		var HayResponsable = false;

		if ($('input[name="ChkFuncioQuienFirma"]').is(':checked')) {
			HayQuienFirma = true;
		} else {
			HayQuienFirma = false;
		}

		if ($('input[name="ChkFuncioRespon"]').is(':checked')) {
			HayResponsable = true;
		} else {
			HayResponsable = false;
		}

		$("input[name=ChkFuncioQuienFirma]").each(function (index) {
			QuienesFirman.push($(this).val());
		});

		$("input[name=ChkFuncioRespon]").each(function (index) {
			Responsables.push($(this).val());
		});

		$("input[name=ChkProyectores]").each(function (index) {
			Proyectores.push($(this).val());
		});

		$("input[name=RadicadosParaResponder]").each(function (index) {
			RadicadosParaDarRespuesta.push($(this).val());
		});

		if ($('#fec_docu').val() == "") {
			sweetAlert("Oops...", "Te hizo falta la fecha del documento!", "warning");
			$('#fec_docu').focus();
		} else if ($('#num_folio').val() === '') {
			sweetAlert("Oops...", "Te hizo falta el numéro de folios del documento!", "warning");
			$('#num_folio').focus();
		} else if ($('#num_anexos').val() === "") {
			sweetAlert("Oops...", "Te hizo falta el # de los anexos!", "warning");
			$('#num_anexos').focus();
		} else if ($('#observa_anexo').val() === '') {
			sweetAlert("Oops...", "Te hizo falta la observación de los anexos!", "warning");
			$('#observa_anexo').focus();
		} else if ($('#asunto').val() == "") {
			sweetAlert("Oops...", "Te hizo falta el asunto de la correspondencia!", "warning");
			$('#asunto').focus();
		} else if (HayQuienFirma === false) {
			sweetAlert("Oops...", "Debe establecer quien o quienes firman la correspondencia!", "warning");
		} else if (HayResponsable === false) {
			sweetAlert("Oops...", "Debe establecer el responsable de la correspondencia!", "warning");
		} else if ($('#id_destina').val() == "") {
			sweetAlert("Oops...", "Te hizo falta el destinatario de la correspondencia!", "warning");
		} else if ($('#id_forma_salida').val() == 0) {
			sweetAlert("Oops...", "Te hizo falta la tipo de enviados de la correspondencia!", "warning");
			$('#id_forma_salida').focus();
		} else if ($('#id_tipo_respue').val() == 0) {
			sweetAlert("Oops...", "Te hizo falta el tipo de respuesta!", "warning");
			$('#id_tipo_respue').focus();
		} else if ($('#incluir_trd').val() == 1 && $('#id_serie').val() == 0) {
			sweetAlert("Oops...", "Te hizo falta la Serie de la clasificación documental de la correspondencia!", "warning");
			$('#id_serie').focus();
		} else if ($('#incluir_trd').val() == 1 && $('#id_subserie').val() == 0) {
			sweetAlert("Oops...", "Te hizo falta la Subserie de la clasificación documental de la correspondencia!", "warning");
			$($('#incluir_trd').val() == 1 && '#id_subserie').focus();
		} else if ($('#id_tipodoc').val() == 0) {
			sweetAlert("Oops...", "Te hizo falta el tipo documental de la clasificación documental de la correspondencia!", "warning");
			$('#id_tipodoc').focus();
		} else {

			$("#multi").each(function () {
				$("#multi option").attr("selected", "selected");
			});

			$.ajax({
				url: 'accionesVentanillaEnviadas.php',
				type: 'POST',
				data: 'accion=GUARDAR_RADICADO&id_serie=' + $('#id_serie').val() + '&id_subserie=' + $('#id_subserie').val() + '&id_tipodoc=' + $('#id_tipodoc').val() + '&id_forma_salida=' + $('#id_forma_salida').val() + '&id_destina=' + $('#id_destina').val() + '&fec_docu=' + $('#fec_docu').val() + '&asunto=' + $('#asunto').val() + '&num_folio=' + $('#num_folio').val() + '&num_anexos=' + $('#num_anexos').val() + '&observa_anexo=' + $('#observa_anexo').val() + '&QuienesFirman=' + QuienesFirman + '&QuienFirmaPrincipal=' + $('input:radio[name=ChkFuncioQuienFirma]:checked').val() + '&Responsables=' + Responsables + '&Responsable=' + $('input:radio[name=ChkFuncioRespon]:checked').val() + '&RadicadoParaResponder=' + RadicadosParaDarRespuesta + '&num_guia=' + $('#num_guia').val() + "&incluir_trd=" + $('#incluir_trd').val() + '&Proyectores=' + Proyectores + '&opcion_relacion=' + $('#opcion_relacion').val() + '&opcion_titulo=' + $('#opcion_titulo').val() + '&opcion_sub_titulo=' + $('#opcion_sub_titulo').val() + '&opcion_detalle1=' + $('#opcion_detalle1').val() + '&opcion_detalle2=' + $('#opcion_detalle2').val() + '&opcion_detalle3=' + $('#opcion_detalle3').val() + '&id_tipo_respue=' + $('#id_tipo_respue').val(),
				beforeSend: function () {
					$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
				},
				success: function (msj) {
					if (msj == 1) {
						$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El registro se almaceno correctamente. </div>');

						setTimeout(function () {
							window.location.href = "index.php";
						}, (200));

					} else {
						sweetAlert("Oops...", msj, "warning");
					}
				},
				error: function () {
					sweetAlert("Oops...", "Ha ocurrido un error durante la ejecución", "error");
				}
			});
		}
		return false;
	});

	//FUNCION PARA BORRAR QUIEN FIRMA
	$(document).on('click', '.borrar_quien_firma', function (event) {
		event.preventDefault();
		$(this).closest('tr').remove();
		$("#ChkQuienFirma" + $(this).data('id')).attr('checked', false);
	});

	//FUNCION PARA LLEVAR QUIEN FIRMA
	$('#BtnLlevarQuienFirma').click(function (e) {
		$("input[name='ChkQuienFirma[]']:checked").each(function () {
			if (!$('#TblQuienFirma' + $(this).val()).length) {
				$('#TblQuienFirma tr:last').after('<tr id="TblQuienFirma' + $(this).val() + '"><td><div class="radio radio-success"><input type="radio" class="dependencia_quien_firma" name="ChkFuncioQuienFirma" id="ChkFuncioQuienFirma' + $(this).val() + '" value="' + $(this).val() + '" data-id_quien_firma_dependencia="' + $(this).data('id_dependencia_quien_firma') + '" data-id_quien_firma_oficina="' + $(this).data('id_oficina_quien_firma') + '"><label for="ChkFuncioQuienFirma' + $(this).val() + '">' + $(this).data('nombre_quien_firma') + '</label></div></td><td>' + $(this).data('oficina_quien_firma') + '</td><td><button class="borrar_quien_firma btn btn-danger btn-sm btn-small" data-id="' + $(this).val() + '" ><i class="fa fa-trash-o"></i></button></td></tr>');
			}
		});
	});

	//FUNCION PARA BORRAR UN RESPONSABLES
	$(document).on('click', '.borrar_responsables', function (event) {
		event.preventDefault();
		$(this).closest('tr').remove();
		$("#ChkResponsables" + $(this).data('id')).attr('checked', false);
	});

	//FUNCION PARA LLEVAR LOS RESPONSABLES
	$('#BtnLlevarResponsables').click(function (e) {
		$("input[name='ChkResponsables[]']:checked").each(function () {
			if (!$('#TblResponsales' + $(this).val()).length) {
				$('#TblResponsales tr:last').after('<tr id="TblResponsales' + $(this).val() + '"><td><div class="radio radio-success"><input type="radio" class="dependencia_del_responsable" name="ChkFuncioRespon" id="ChkFuncioRespon' + $(this).val() + '" value="' + $(this).val() + '" data-id_responsable_dependencia="' + $(this).data('id_dependencia_responsables') + '" data-id_responsable_oficina="' + $(this).data('id_oficina_responsables') + '"><label for="ChkFuncioRespon' + $(this).val() + '">' + $(this).data('nombre_responsables') + '</label></div></td><td>' + $(this).data('oficina_responsables') + '</td><td><button class="borrar_responsables btn btn-danger btn-sm btn-small" data-id="' + $(this).val() + '" ><i class="fa fa-trash-o"></i></button></td></tr>');
			}
		});
	});

	//FUNCION PARA BORRAR UN PROYECTOR
	$(document).on('click', '.borrar_proyector', function (event) {
		event.preventDefault();
		$(this).closest('tr').remove();
		$("#ChkResponsables" + $(this).data('id')).attr('checked', false);
	});

	//FUNCION PARA LLEVAR LOS PROYECTORES
	$('#BtnLlevarProyector').click(function (e) {
		$("input[name='ChkProyectores[]']:checked").each(function () {
			if (!$('#TblProyectores' + $(this).val()).length) {
				$('#TblProyectores tr:last').after('<tr id="TblProyectores' + $(this).val() + '"><td><div class="radio radio-success"><input type="radio" class="dependencia_del_proyector" name="ChkProyectores" id="ChkProyectores' + $(this).val() + '" value="' + $(this).val() + '" data-proyector_dependencia="' + $(this).data('dependencia_proyector') + '"><label for="ChkProyectores' + $(this).val() + '">' + $(this).data('nombre_proyector') + '</label></div></td><td>' + $(this).data('oficina_proyector') + '</td><td><button class="borrar_proyector btn btn-danger btn-sm btn-small" data-id="' + $(this).val() + '" ><i class="fa fa-trash-o"></i></button></td></tr>');
			}
		});
	});

	//FUNCION PARA CARGAR LA TRD DE LA DEPENDEICA DEL FUNCIONARIO ELEJIDO
	$("body").on("change", ".dependencia_del_responsable", function (event) {
		event.preventDefault();

		var IdDepen = $(this).data('id_responsable_dependencia');
		var IdOficina = $(this).data('id_responsable_oficina');
		var IncluirOficinaTRD = $('#incluir_oficina_trd').val();

		$('#id_depen').val(IdDepen);
		$('#id_oficina').val(IdOficina)

		$.post("../../../varios/combo_series.php", {
			id_depen: IdDepen,
			id_oficina: IdOficina,
			IncluirOficinaTRD: IncluirOficinaTRD
		}, function (data) {
			$("#id_serie").html(data);
		});
	});

	//FUNCIONES PARA ESTABLCER EL ID DEL RADICADO PARA AGREGAR
	//EL ARCHIVO DIGITAL E IMPRIMIR EL ROTULO
	$(document).on('click', '#BtnAdjunarDigital', function (event) {
		$('#IdRadicado').val($(this).data('id_radicado'));
		$('#id_depen').val($(this).data('id_dependencia'));
		$('#id_radicado').val($(this).data('id_radicado'));
	});

	$(document).on('click', '.ImprimirRotulo', function (event) {
		$('#IdRadicado').val($(this).data('id_radicado'));
		$('#id_depen').val($(this).data('id_dependencia'));
		$('#id_radicado').val($(this).data('id_radicado'));
	});

	//FUNCION PARA IMPRIMIR ROTULO
	$(document).on('click', '.ImprimirRotulo', function (event) {

		if ($('#tipo_impre_torulo').val() == 1) {
			$("#ifrImprimirRotulo").attr("src", "../../../reportes/ventanilla/rotulos/imprimir_rotulo_enviada_tickect.php?id_radica=" + $(this).data('id_radicado'));
		} else {
			$("#ifrImprimirRotulo").attr("src", "../../../reportes/ventanilla/rotulos/imprimir_rotulo_enviada_documento.php?id_radica=" + $(this).data('id_radicado'));
		}

		$.ajax({
			url: 'accionesVentanillaEnviadas.php',
			type: 'POST',
			data: 'accion=IMPRIMIR_ROTULO&id_radica=' + $(this).data('id_radicado'),
			success: function (data) {
				if (data == 1) {
					$('i[id=BtnImprimirRotulo' + $('#id_radicado').val() + ']').removeClass('text-warning');
					$('i[id=BtnImprimirRotulo' + $('#id_radicado').val() + ']').addClass('text-success');
				} else {
					$('i[id=BtnImprimirRotulo' + $('#id_radicado').val() + ']').removeClass('text-warning');
					$('i[id=BtnImprimirRotulo' + $('#id_radicado').val() + ']').addClass('text-danger');
				}
			},
			error: function () {
				sweetAlert("Oops...", data, "warning");
			}
		});
	});

	$(document).on('click', '#BtnSubirDocumentosAdicionales', function (event) {
		$('#id_radicado').val($(this).data('id_radicado'));
		$('#id_depen').val($(this).data('id_depen'));
	});

	$(document).on('click', '#BtnSubirArchivosAdicionales', function (event) {

		$.ajax({
			url: '../../../varios/ftp.acciones.php',
			type: 'POST',
			data: 'accion=ENVIADOS_UPLOAD_ADICIONALES&id_radicado=' + $('#id_radicado').val() + '&id_depen=' + $('#id_depen').val(),
			beforeSend: function () {
				$("#DivAlertarAdjuntoDigital").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
			},
			success: function (msj) {
				if (msj == 1) {
					$('#BtnCancelarSubirArchivosAdicionales').click();
				} else {
					sweetAlert("Oops...", msj, "error");
				}
			},
			warning: function (msj) {
				sweetAlert("Oops...", msj, "error");
			}
		});
	});

	$('#BtnSubirDigital').click(function () {
		var formData = new FormData($(".formulario")[0]);

		$.ajax({
			url: '../../../varios/ftp.acciones.php',
			type: 'POST',
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function () {
				$("#DivAlertarAdjuntoDigital").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
			},
			success: function (msj) {
				if (msj == 1) {
					$('#BtnCancelarSubirDigital').click();
					$("#DivAlertarAdjuntoDigital").empty();
					$('#ifrVisualizaArchivo').attr('src', '')
				} else {
					sweetAlert("Oops...", msj, "error");
				}
			},
			warning: function (msj) {
				sweetAlert("Oops...", msj, "error");
			}
		});
	});

	//FUNCION PARA CARGAR LA INFORMACION DEL RADICADO
	$(document).on('click', '#BtnMostarInfoRadicadoEnviado', function (event) {

		var IdRadicado = $(this).data('id_radicado');

		$('#DivRadicadoEnviado').html(IdRadicado)

		$.ajax({
			url: '../../varios/tab_radicado_enviado_info.php',
			type: 'POST',
			data: 'id_radica=' + IdRadicado,
			beforeSend: function () {
				$("#alerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
			},
			success: function (msj) {
				$("#alerta").empty();
				$("#DivMostarInfoRadicadoEnviado").html(msj);
			},
			error: function (msj) {
				$("#alerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + '</div>');
			}
		});

		$.ajax({
			url: '../../varios/tab_radicado_enviado_clasificacion.php',
			type: 'POST',
			data: 'id_radica=' + IdRadicado,
			beforeSend: function () {
				$("#alerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
			},
			success: function (msj) {
				$("#alerta").empty();
				$("#DivMostarInfoRadicadoEnviadoClasificacion").html(msj);
			},
			error: function (msj) {
				$("#alerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + '</div>');
			}
		});

		$.ajax({
			url: '../../varios/tab_radicado_enviado_documentos.php',
			type: 'POST',
			data: 'id_radica=' + IdRadicado,
			beforeSend: function () {
				$("#alerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
			},
			success: function (msj) {
				$("#alerta").empty();
				$("#DivMostarDocumentosEnviado").html(msj);
			},
			error: function (msj) {
				$("#alerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + '</div>');
			}
		});
	});

	$(document).on('click', '#BtnDescargarArchivoEnviado', function (event) {

		var Archivo = $(this).data('archivo');
		var IdRadicado = $(this).data('id_radicado');
		var IdRuta = $(this).data('id_ruta');

		if ($("#id_ruta").val() == 0) {
			sweetAlert("Oops...", "El radicado no tiene el documento digital, por favor adjunte el documento digitalizado!", "warning");
		} else {
			$.ajax({
				url: '../../../varios/ftp.acciones.php',
				type: 'POST',
				data: 'accion=ENVIADOS_DESCARGAR&id_radicado=' + IdRadicado + '&id_ruta=' + IdRuta + '&archivo=' + Archivo,
				beforeSend: function () {
					$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
				},
				success: function (msj) {
					$("#DivAlertas").empty();
					if (msj == 1) {
						url = "../../../../archivos/temp/enviados/" + Archivo;
						window.open(url, 'Download');
					} else {
						sweetAlert("Oops...", msj, "error");
					}
				},
				error: function (error) {
					sweetAlert("Oops...", error, "error");
				}
			});
		}
	});

	$('#BtnBuscarDestinatarioNatural').click(function (e) {
		$("#TxtBusDestinaNaturales").focus();
	});

	$("#TxtBusDestinaNaturales").keyup(function (e) {
		if (e.which == 13) {
			if ($("#TxtBusDestinaNaturales").val() === "") {
				$("#DivAlertasDestinaNaturales").load("../../../../config/mensajes.php", { alerta: 3, mensaje: 'Te hizo falta ingresar el criterio de busqueda' }, function () { });
				$("#TxtBusDestinaNaturales").focus();
			} else {
				$.ajax({
					url: '../../../varios/listar_tercero_correspondencia.php',
					type: 'POST',
					data: 'criterio=' + $("#TxtBusDestinaNaturales").val(),
					beforeSend: function () {
						$("#DivAlertasDestinaNaturales").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
					},
					success: function (msj) {
						if (msj != 1) {
							$("#DivAlertasDestinaNaturales").empty();
							$("#DivDestinatarioNaturales").html(msj);
						} else {
							$("#DivAlertasDestinaNaturales").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> NO se encontraron resultados.</div>');
						}
					},
					error: function (msj) {
						$("#DivAlertasDestinaNaturales").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + '</div>');
					}
				});
			}
		}
	});

	//FUNCION PARA LLEVAR EL DESTINATARIO NATURAL
	$(document).on('click', '#BtnLlevarTercero', function (event) {
		var IdEmpre = $(this).data("id_empre")

		$('#id_destina').val($(this).data("id_tercero"));

		$('#cc_nit').val($(this).data("num_docu"));
		$('#remite_contacto').val($(this).data("nom_contac"));
		$('#remite_dir').val($(this).data("dir"));
		$('#remite_tel').val($(this).data("tel"));
		$('#remite_cel').val($(this).data("cel"));
		$('#remite_email').val($(this).data("email"));

		if (IdEmpre != "") {
			$('#remite_razo_soci').val($(this).data("razo_soci"));
			$('#DivOcultarTerceroRazoSoci').show();
			$('#BtnCancelarTerceroNatural').click();
			$("#DivAlertasDestinaNaturales").empty();
		} else {
			$('#DivOcultarTerceroRazoSoci').hide();
		}

		$('#BtnCancelarBusTercero').click();
	});

	$('#BtnNuevoTerceroJuridico').click(function (e) {
		$.post("../../../varios/combo_Empresas.php", {
		}, function (data) {
			$("#multi").html(data);
		});
	});

	$("#id_serie").change(function () {

		var Responsables = new Array();
		var HayResponsable = false;

		$("input[name='ChkResponsables[]']:checked").each(function () {
			Responsables.push($(this).val());
		});

		if (!$('input[name="ChkFuncioRespon"]').is(':checked')) {
			HayResponsable = true;
		} else {
			HayResponsable = false;
		}

		if (Responsables === "") {
			sweetAlert("Oops...", "Te hizo falta el o los responsables de la correspondencia!", "warning");
			$('#BtnBuscarDestinatario').click();
		} else if (!$('input[name="ChkFuncioRespon"]').is(':checked')) {
			sweetAlert("Oops...", "Debe establecer el responsable de la correspondencia!", "warning");
		} else {
			$("#id_serie option:selected").each(function () {
				$.post("../../../varios/combo_sub_series.php", {
					id_serie: $(this).val(),
					id_depen: $('#id_depen').val(),
					id_oficina: $('#id_oficina').val(),
					IncluirOficinaTRD: $('#incluir_oficina_trd').val()
				}, function (data) {
					$("#id_subserie").html(data);
				});
			});
		}
	});

	$("#id_subserie").change(function () {
		$("#id_subserie option:selected").each(function () {
			var id_serie = $("#id_serie").val();
			var id_sub_serie = $(this).val();

			$.post("../../../varios/combo_tipos_documentos.php", {
				accion: $('#accion').val(),
				id_depen: $('#id_depen').val(),
				id_serie: id_serie,
				id_sub_serie: id_sub_serie
			}, function (data) {
				$("#id_tipodoc").html(data);
			});
		});
	});

	$('#BtnGuardarTerceroNatural').click(function () {

		if ($('#nom_contac').val() == "") {
			$("#DivAlertaTerceroNatural").load("../../../../config/mensajes.php", { alerta: 3, mensaje: 'Te hizo falta el nombre del contacto.' }, function () { });
			$('#nom_contac').focus();
		} else if ($('#id_depar_natural').val() == 0) {
			$("#DivAlertaTerceroNatural").load("../../../../config/mensajes.php", { alerta: 3, mensaje: 'Te hizo falta el departamento de recidencia del contacto.' }, function () { });
			$('#id_depar_natural').focus();
		} else if ($('#id_muni_natural').val() == 0) {
			$("#DivAlertaTerceroNatural").load("../../../../config/mensajes.php", { alerta: 3, mensaje: 'Te hizo falta el municipio de recidencia del contacto.' }, function () { });
			$('#id_muni_natural').focus();
		} else {

			var formData = new FormData($("#FrmDatosTerceroNatural")[0]);

			$.ajax({
				url: '../../../general/terceros/acciones_tercero.ajax.php',
				type: 'POST',
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function () {
					$("#DivAlertaTerceroNatural").load("../../../../config/mensajes.php", { alerta: 5, mensaje: 'Enviando información, por favor espere...' }, function () { });
				},
				success: function (msj) {

					var Elementos = msj.split('####');
					if (Elementos[0] == 1) {
						$("#DivAlertaTerceroNatural").load("../../../../config/mensajes.php", { alerta: 4, mensaje: 'El registro se almaceno correctamente' }, function () { });
						$('#id_destina').val(Elementos[1])
						$('#cc_nit').val($('#num_docu_contac').val());
						$('#remite_contacto').val($('#nom_contac').val());
						$('#DivReriteRazoSoci').hide();
						$('#remite_dir').val($('#dir_contac').val());
						$('#remite_tel').val($('#tel_contac').val());
						$('#remite_cel').val($('#cel_contac').val());
						$('#remite_email').val($('#email_contac').val());

						$("#FrmDatosTerceroNatural")[0].reset();
						$('#DivOcultarRemiteRazoSoci').hide();
						$('#BtnCancelarTerceroNatural').click();
						$("#DivAlertaTerceroNatural").empty();
					} else {
						$("#DivAlertaTerceroNatural").load("../../../../config/mensajes.php", { alerta: 3, mensaje: msj }, function () { });
					}
				},
				error: function (msj) {
					$("#DivAlertaTerceroNatural").load("../../../../config/mensajes.php", { alerta: 1, mensaje: 'Ha ocurrido un error durante la ejecución, ' + msj }, function () { });
				}
			});
		}
	});

	$('#BtnGuardarTerceroJutidico').click(function () {
		if ($('#nom_contac_juridico').val() == "") {
			$("#DivAlertaTerceroJutidico").load("../../../../config/mensajes.php", { alerta: 3, mensaje: 'Te hizo falta el nombre del contacto.' }, function () { });
			$('#nom_contac_juridico').focus();
		} else if ($('#multi').val() == 0) {
			$("#DivAlertaTerceroJutidico").load("../../../../config/mensajes.php", { alerta: 3, mensaje: 'Te hizo falta al empresa del contacto.' }, function () { });
			$('#id_empre_juridico').focus();
		} else {

			var formData = new FormData($("#FrmDatosTerceroJuridico")[0]);

			$.ajax({
				url: '../../../general/terceros/acciones_tercero.ajax.php',
				type: 'POST',
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function () {
					$("#DivAlertaTerceroJutidico").load("../../../../config/mensajes.php", {
						alerta: 5,
						mensaje: 'Enviando información, por favor espere...'
					}, function () { });
				},
				success: function (msj) {

					var Elementos = msj.split('####');
					if (Elementos[0] == 1) {

						$('#id_destina').val(Elementos[1]);
						$('#cc_nit').val(Elementos[2]);
						$('#remite_contacto').val($('#nom_contac_juridico').val());
						$('#remite_razo_soci').val($('select[name="multi"] option:selected').text());
						$('#remite_dir').val($('#dir_contac_juridico').val());
						$('#remite_tel').val($('#tel_contac_juridico').val());
						$('#remite_cel').val($('#cel_contac_juridico').val());
						$('#remite_email').val($('#email_contac_juridico').val());

						$("#FrmDatosTerceroJuridico")[0].reset();
						$('#BtnCancelarTerceroJutidico').click();
						$('#DivOcultarRemiteRazoSoci').show();
						$("#DivAlertaTerceroJutidico").empty();
					} else {
						$("#DivAlertaTerceroJutidico").load("../../../../config/mensajes.php", { alerta: 3, mensaje: msj }, function () { });
					}
				},
				error: function (msj) {
					$("#DivAlertaTerceroJutidico").load("../../../../config/mensajes.php", { alerta: 1, mensaje: 'Ha ocurrido un error durante la ejecución, ' + msj }, function () { });
				}
			});
		}
	});

	$('#BtnGuardarTerceroJutidicoConEmpresa').click(function () {
		if ($('#nit').val() == "") {
			$("#DivAlertaTerceroJutidicoConEmpresa").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el Nit. de la empresa del contacto.</div>');
			$("#DivAlertaTerceroJutidico").load("../../../../config/mensajes.php", { alerta: 3, mensaje: 'Te hizo falta al empresa del contacto.' }, function () { });
			$('#nit').focus();
		} else if ($('#razo_soci').val() == "") {
			$("#DivAlertaTerceroJutidicoConEmpresa").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta la Razon Social de la empresa del contacto.</div>');
			$("#DivAlertaTerceroJutidico").load("../../../../config/mensajes.php", { alerta: 3, mensaje: 'Te hizo falta al empresa del contacto.' }, function () { });
			$('#razo_soci').focus();
		} else if ($('#id_depar_juridico_empresa').val() == 0) {
			$("#DivAlertaTerceroJutidicoConEmpresa").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el departamento de la empresa del contacto.</div>');
			$("#DivAlertaTerceroJutidico").load("../../../../config/mensajes.php", { alerta: 3, mensaje: 'Te hizo falta al empresa del contacto.' }, function () { });
			$('#id_depar_juridico_empresa').focus();
		} else if ($('#id_muni_juridico_empresa').val() == 0) {
			$("#DivAlertaTerceroJutidicoConEmpresa").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el municipio de la empresa del contacto.</div>');
			$("#DivAlertaTerceroJutidico").load("../../../../config/mensajes.php", { alerta: 3, mensaje: 'Te hizo falta al empresa del contacto.' }, function () { });
			$('#id_muni_juridico_empresa').focus();
		} else if ($('#nom_contac_juridico_empresa').val() == "") {
			$("#DivAlertaTerceroJutidicoConEmpresa").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el nombre del contacto.</div>');
			$("#DivAlertaTerceroJutidico").load("../../../../config/mensajes.php", { alerta: 3, mensaje: 'Te hizo falta al empresa del contacto.' }, function () { });
			$('#nom_contac_juridico_empresa').focus();
		} else {

			var formData = new FormData($("#FrmDatosTerceroJuridicoConEmpresa")[0]);

			$.ajax({
				url: '../../../general/terceros/acciones_tercero.ajax.php',
				type: 'POST',
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function () {
					$("#DivAlertaTerceroJutidico").load("../../../../config/mensajes.php", {
						alerta: 5,
						mensaje: 'Enviando información, por favor espere...'
					}, function () { });
				},
				success: function (msj) {

					var Elementos = msj.split('####');
					if (Elementos[0] == 1) {
						$("#DivAlertaTerceroJutidicoConEmpresa").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El registro se almaceno correctamente. </div>');
						$('#id_destina').val(Elementos[1]);
						$('#cc_nit').val($('#nit').val());
						$('#remite_contacto').val($('#nom_contac_juridico_empresa').val());
						$('#DivReriteRazoSoci').show();
						$('#remite_razo_soci').val($('#razo_soci').val());
						$('#remite_dir').val($('#dir_juridico_empresa').val());
						$('#remite_tel').val($('#tel_juridico_empresa').val());
						$('#remite_cel').val($('#cel_juridico_empresa').val());

						$("#FrmDatosTerceroJuridicoConEmpresa")[0].reset();
						$('#BtnCancelarTerceroJutidicoConEmpresa').click();
						$("#DivAlertaTerceroJutidicoConEmpresa").empty();
					} else {
						$("#DivAlertaTerceroJutidicoConEmpresa").load("../../../../config/mensajes.php", { alerta: 3, mensaje: msj }, function () { });
					}
				},
				error: function (msj) {
					$("#DivAlertaTerceroJutidicoConEmpresa").load("../../../../config/mensajes.php", { alerta: 1, mensaje: 'Ha ocurrido un error durante la ejecución, ' + msj }, function () { });
				}
			});
		}
	});

	//LIMPIAR FORMULARIO DE TERCEROS NATURALES
	$('#BtnCancelarTerceroNatural').click(function () {
		$("#FrmDatosTerceroNatural")[0].reset();
	});

	$("#id_depar_contac").change(function () {
		$("#id_depar_contac option:selected").each(function () {
			var idDepar = $(this).val();
			$.post("../../../varios/combo_Municipios.php", {
				idDepar: idDepar
			}, function (data) {
				$("#id_muni_contac").html(data);
			});
		});
	});

	$("#id_depar_juridico_empresa").change(function () {
		$("#id_depar_juridico_empresa option:selected").each(function () {
			var idDepar = $(this).val();
			$.post("../../../varios/combo_Municipios.php", {
				idDepar: idDepar
			}, function (data) {
				$("#id_muni_juridico_empresa").html(data);
			});
		});
	});

	$('#BtnBuscarRadicadosRecibidos').click(function (e) {
		$("#TxtBusRadicadosRecibidosParaRespuesta").focus();
	});

	//FUNCION PARA BUSCAR EL TERCERO NATURAL
	$("#TxtBusRadicadosRecibidosParaRespuesta").keyup(function (e) {
		if (e.which == 13) {
			if ($("#TxtBusRadicadosRecibidosParaRespuesta").val() === "") {
				$("#DivAlertasRadicadosRecibidosParaRespuesta").load("../../../config/funciones.php", { alerta: 3, mensaje: 'Te hizo falta ingresar el criterio de busqueda' }, function () { });
				$("#TxtBusRadicadosRecibidosParaRespuesta").focus();
			} else {
				$.ajax({
					url: '../../varios/listar_radicados_recibidos_para_respuesta.php',
					type: 'POST',
					data: 'criterio=' + $("#TxtBusRadicadosRecibidosParaRespuesta").val(),
					beforeSend: function () {
						$("#DivAlertasRadicadosRecibidosParaRespuesta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
					},
					success: function (msj) {
						$("#DivAlertasRadicadosRecibidosParaRespuesta").empty();
						if (msj != 1) {
							$("#DivRadicadosRecibidosParaRespuesta").html(msj);
						} else {
							$("#DivRadicadosRecibidosParaRespuesta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> ' + msj + '.</div>');
						}
					},
					error: function (msj) {
						$("#DivAlertasRadicadosRecibidosParaRespuesta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + '</div>');
					}
				});
			}
		}
	});

	//FUNCION PARA LLEVAR EL RADICADO DE RESPUESTA
	$(document).on('click', '#BtnLlevarRadicadoParaRespuesta', function (event) {

		var Radicados = $(this).val();
		var IdRadicado = $(this).data('id_radica');
		var Asunto = $(this).data('asunto');
		var Remitente = $(this).data('remitente');
		var IncluirOficinaTRD = $('#incluir_oficina_trd').val();

		/**************************************************************************************************/
		/* VERIFICAR SI EL RADICADO YA SE SELECCIONO
		/**************************************************************************************************/
		//obtenemos el valor insertado a buscar
		let buscarIdRadicado = '<input type="hidden" name="RadicadosParaResponder" id="RadicadosParaResponder' + IdRadicado + '" value="' + IdRadicado + '">' + IdRadicado;

		//utilizamos esta variable solo de ayuda y mostrar que se encontro
		let encontradoResultadoIdRadicado = false;

		//realizamos el recorrido solo por las celdas que contienen el código, que es la primera
		$("#TblRadicadosParaResponder tr").find('td:eq(0)').each(function () {

			//obtenemos el codigo de la celda
			let codigoIdRadicado = $(this).html();
			//comparamos para ver si el código es igual a la busqueda
			if (codigoIdRadicado == buscarIdRadicado) {
				encontradoResultadoIdRadicado = true;
			}
		})

		if (!encontradoResultadoIdRadicado) {
			$(this).closest('tr').remove();
			$('#TblRadicadosParaResponder tr:last').after('<tr id="TrRadicadosParaResponder' + IdRadicado + '"><td><input type="hidden" name="RadicadosParaResponder" id="RadicadosParaResponder' + IdRadicado + '" value="' + IdRadicado + '">' + IdRadicado + '</td><td>' + Asunto + '</td><td>' + Remitente + '</td><td><button class="borrar_radicado_para_responder btn btn-danger btn-sm btn-small" data-id="' + IdRadicado + '" ><i class="fa fa-trash-o"></i></button></td></tr>');
		}

		$.ajax({
			url: 'buscar_radicado_recibido.php',
			type: 'POST',
			dataType: "JSON",
			data: 'id_radica=' + IdRadicado,
			success: function (msj) {

				var RadicadosParaDarRespuesta = new Array();
				$("input[name=RadicadosParaResponder").each(function (index) {
					RadicadosParaDarRespuesta.push($(this).val());
				});

				//DATOS DEL RADICADO
				$('#asunto').val(msj[0]);
				$('#asunto').val('En respuesta al radicado ' + RadicadosParaDarRespuesta + " - " + $('#asunto').val());
				$('#id_depen').val(msj[9]);
				$('#id_oficina').val(msj[13]);
				console.log(`${msj[17]} - ${msj[18]} - ${msj[19]} - ${msj[21]}`);
				//DESTINATARIO
				$('#id_destina').val(msj[17]);
				$('#cc_nit').val(msj[18]);
				$('#tercero_nom').val(msj[19]);
				$('#tercero_razo_soci').val(msj[25]);
				$('#tercero_dir').val(msj[21]);
				$('#tercero_tel').val(msj[22]);
				$('#tercero_cel').val(msj[23]);
				$('#tercero_email').val(msj[26]);

				if (msj[25] == null) {
					$('#DivOcultarRemiteRazoSoci').hide();
					$('#cc_nit').val(msj[18]);
				} else {
					$('#DivOcultarRemiteRazoSoci').show();
					$('#cc_nit').val(msj[24]);
				}

				if (msj[1] === 'null') {

					//INICIO CARGUE LA SERIE Y SUBSERIE DEL DOCUMENTO DE ENTRADA
					$.post("../../../varios/combo_series.php", {
						id_depen: msj[9],
						id_oficina: msj[13],
						IncluirOficinaTRD: IncluirOficinaTRD
					}, function (data) {
						$("#id_serie").html(data);
						$("#id_serie> option[value=" + msj[1] + "]").attr('selected', 'selected');

						$("#id_subserie").empty()
						$("#id_tipodoc").empty()
					});
				} else {

					//INICIO CARGUE LA SERIE Y SUBSERIE DEL DOCUMENTO DE ENTRADA
					$.post("../../../varios/combo_series.php", {
						id_depen: msj[9],
						id_oficina: msj[13],
						IncluirOficinaTRD: IncluirOficinaTRD
					}, function (data) {
						$("#id_serie").html(data);
						$("#id_serie> option[value=" + msj[1] + "]").attr('selected', 'selected');
					});

					$.post("../../../varios/combo_sub_series.php", {
						id_serie: msj[1],
						id_depen: msj[9],
						id_oficina: msj[13],
						IncluirOficinaTRD: IncluirOficinaTRD
					}, function (data) {
						$("#id_subserie").html(data);
						$("#id_subserie> option[value=" + msj[2] + "]").attr("selected", "selected");
					});

					$.post("../../../varios/combo_tipos_documentos.php", {
						accion: '',
						id_depen: msj[9],
						id_serie: msj[1],
						id_sub_serie: msj[2],
						id_oficina: msj[13],
						IncluirOficinaTRD: IncluirOficinaTRD
					}, function (data) {
						$("#id_tipodoc").html(data);
					});
				}
				//FIN CARGUE LA SERIE Y SUBSERIE DEL DOCUMENTO DE ENTRADA

				//INICIO DE CARGUE DE LOS RESPONSABLES DE LA CORRESPONDENCIA
				$.ajax({
					url: 'listar_responsables_radicado_recibido.php',
					type: 'POST',
					dataType: 'JSON',
					data: 'id_radica=' + IdRadicado,
					success: function (msj) {

						//obtenemos el valor insertado a buscar
						let buscarResponsable = '<div class="radio radio-success"><input type="radio" class="dependencia_del_responsable" name="ChkFuncioRespon" id="ChkFuncioRespon' + msj[0] + '" value="' + msj[0] + '"  data-responsable_dependencia="' + msj[5] + '"><label for="ChkFuncioRespon' + msj[0] + '">' + msj[3] + ' ' + msj[4] + '</label></div>';

						//utilizamos esta variable solo de ayuda y mostrar que se encontro
						let encontradoResultadoResponsable = false;

						//realizamos el recorrido solo por las celdas que contienen el código, que es la primera
						$("#TblResponsales tr").find('td:eq(0)').each(function () {

							//obtenemos el codigo de la celda
							let codigoResponsable = $(this).html();

							//comparamos para ver si el código es igual a la busqueda
							if (codigoResponsable == buscarResponsable) {
								encontradoResultadoResponsable = true;
							}
						})

						if (!encontradoResultadoResponsable) {
							$('#TblResponsales tr:last').after('<tr id="TblResponsales' + msj[0] + '"><td><div class="radio radio-success"><input type="radio" class="dependencia_del_responsable" name="ChkFuncioRespon" id="ChkFuncioRespon' + msj[0] + '" value="' + msj[0] + '"  data-responsable_dependencia="' + msj[5] + '"><label for="ChkFuncioRespon' + msj[0] + '">' + msj[3] + ' ' + msj[4] + '</label></div></td><td>' + msj[10] + '</td><td><button class="borrar_responsables btn btn-danger btn-sm btn-small" data-id="' + msj[0] + '" ><i class="fa fa-trash-o"></i></button></td></tr>');
						}

						if (!$('input[name="ChkFuncioRespon"]').is(':checked')) {
							$("#ChkFuncioRespon" + msj[0]).prop("checked", true);
						}
					},
					error: function (error) {
						sweetAlert("Oops...", "Ha ocurrido un error durante el cargue de los responsables." + error, "error");
					}
				});

				//FUN DE CARGU DE LOS RESPONSABLES DE LA CORRESPONDENCIA
				$("#DivAlertas").empty();
			},
			error: function (error) {
				console.log(error);
				sweetAlert("Oops...", "Ha ocurrido un error durante la ejecución" + error, "error");
			}
		});
	});

	$('#BtnReportCorresEnviadaPorDigital').click(function () {
		var url = '../../../reportes/ventanilla/pendientes/por_digital_enviados_excel.php';
		window.open(url)
	});

	$(document).on('click', '#BtnEliminarDocumentoDigital', function (event) {

		var IdRadicado = $(this).data('id_radicado');
		var IdRuta = $(this).data('id_ruta');
		var Archivo = $(this).data('archivo');

		swal({
			title: "Eliminar digital?",
			text: "¿Desea eliminar el documento digital del radicado " + IdRadicado + "?",
			type: "warning",
			showCancelButton: true,
			cancelButtonText: "No",
			confirmButtonColor: '#DD6B55',
			confirmButtonText: "¡Si, Eliminar!",
			closeOnConfirm: false
		},

			function () {
				$.ajax({
					url: 'accionesVentanillaEnviadas.php',
					type: 'POST',
					data: 'accion=ELIMINAR_DIGITAL&id_radica=' + IdRadicado,
					beforeSend: function () {
						$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
					},
					success: function (msj) {
						if (msj == 1) {
							$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El archivo se elimino correctamente. </div>');

							$.ajax({
								url: '../../../varios/ftp.acciones.php',
								type: 'POST',
								data: 'accion=ELIMINAR_DIGITAL_RECIBIDO&id_radica=' + IdRadicado + '&id_ruta=' + IdRuta,
								beforeSend: function () {
									$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Eliminando archivo digital, por favor espere. </div>');
								},
								success: function (msj) {
									if (msj == 1) {
										$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El archivo se elimino correctamente. </div>');
										swal("Deleted!", "El archivo se elimino correctamente.", "success");
									} else {
										$("#DivAlertas").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> ' + msj + '.</div>');
									}
								},
								error: function (msj) {
									$("#DivAlertas").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + '</div>');
								}
							});
						} else {
							$("#DivAlertas").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> ' + msj + '.</div>');
						}
					},
					error: function (msj) {
						$("#DivAlertas").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + '</div>');
					}
				});
			});
	});

	$(document).on('click', '#BtnEliminarRadicado', function (event) {

		var IdRadicado = $(this).data('id_radicado');
		var IdRuta = $(this).data('id_ruta');
		var Archivo = $(this).data('archivo');

		swal({
			title: "Eliminar radicado?",
			text: "¿Desea eliminar el radicado " + IdRadicado + "?",
			type: "warning",
			showCancelButton: true,
			cancelButtonText: "No",
			confirmButtonColor: '#DD6B55',
			confirmButtonText: "¡Si, Eliminar!",
			closeOnConfirm: false
		},

			function () {
				$.ajax({
					url: 'accionesVentanillaEnviadas.php',
					type: 'POST',
					data: 'accion=ELIMINAR_RADICADO&id_radica=' + IdRadicado,
					beforeSend: function () {
						$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
					},
					success: function (msj) {
						if (msj == 1) {
							$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El radicado se elimino correctamente. </div>');
							swal("Deleted!", "El radicado se elimino correctamente.", "success");
							$(this).closest('tr').remove();
							$("#TRRadicado" + IdRadicado).remove();
						} else {
							$("#DivAlertas").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> ' + msj + '.</div>');
						}
					},
					error: function (msj) {
						$("#DivAlertas").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + '</div>');
					}
				});
			});
	});

	$(document).on('click', '#BtnBuscarRadicadosRecibidosParaRespuesta', function (event) {
		var IdRadicado = $(this).data('id_radicado')

		$('#id_radica').val(IdRadicado)
	});

	$('#BtnDarRespuestaRadicados').click(function (event) {
		event.preventDefault();

		var RadicadosParaDarRespuesta = new Array();

		$("input[name=RadicadosParaResponder]").each(function (index) {
			RadicadosParaDarRespuesta.push($(this).val());
		});

		if (RadicadosParaDarRespuesta == "") {
			sweetAlert("Oops...", "Debes elegir al menos un radicado para responder!", "warning");
		} else {

			$.ajax({
				url: 'accionesVentanillaEnviadas.php',
				type: 'POST',
				data: 'accion=RESPONDER_RADICADOS&id_radica=' + $('#id_radica').val() + '&RadicadoParaResponder=' + RadicadosParaDarRespuesta,
				beforeSend: function () {
					$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
				},
				success: function (msj) {
					if (msj == 1) {
						$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El registro se almaceno correctamente. </div>');
						sweetAlert("Ok...", 'Las respuesta se asociaron correctamente.', "success");
						$('#BtnSalirDarRespuestaRadicados').click();
					} else {
						sweetAlert("Oops...", msj, "warning");
					}
				},
				error: function () {
					sweetAlert("Oops...", "Ha ocurrido un error durante la ejecución", "error");
				}
			});
		}
		return false;
	});
});