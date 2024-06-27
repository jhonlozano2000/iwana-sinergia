$(document).ready(function () {

	$('#nit').focus();
	//Listar_Responsables();

	$('#BtnGuardar').click(function (e) {
		e.preventDefault();
		if ($('#nit').val() == "") {
			$('#DivAlerta').html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo falta el Nit.</div>');
			$('#nit').focus();
		} else if ($('#razo_soci').val() == "") {
			$('#DivAlerta').html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo falta ela Razón Social.</div>');
			$('#razo_soci').focus();
		} else if ($('#id_depar').val() == 0) {
			$('#DivAlerta').html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo falta elegir el departamento de recidencia del funcionario.</div>');
			$('#id_depar').focus();
		} else if ($('#id_muni').val() == 0) {
			$('#DivAlerta').html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo falta elegir el municipio de recidencia del funcionario.</div>');
			$('#id_muni').focus();
		} else {

			var formData = new FormData($("#FrmDatos")[0]);

			$.ajax({
				url: 'acciones.ajax.php',
				type: "POST",
				data: formData,
				contentType: false,
				processData: false,
				beforeSend: function () {
					$("#DivAlerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Por favor espera!!!...</a><br><img src="../../../public/assets/img/loading.gif" width="50" height="50" />Enviando información...</div>');
				},
				success: function (msj) {
					if (msj == 1) {
						$("#DivAlerta").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="icon fa fa-check"></i> Muy bien!!!...</a> El registro se almaceno correctamente. </div>');
					} else {
						$("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button> Upsss!!!...</h4><br>' + msj + '.</div>');
					}
				},
				error: function () {
					$("#DivAlerta").html('<div class="alert alert-danger alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Ha ocurrido un error durante la ejecución.</div>');
				}
			});
		}
	});

	$('#BtnGuardarResponsableHC').click(function () {
		if ($('#id_depen_hc').val() == 0) {
			$('#DivAlertasHC').html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo falta elegir la dependencia del formato de la historia clínica.</div>');
			$('#id_depen_hc').focus();
		} else if ($('#id_serie_hc').val() == 0) {
			$('#DivAlertasHC').html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo falta elegir la serie del formato de la historia clínica.</div>');
			$('#id_serie_hc').focus();
		} else if ($('#id_subserie_hc').val() == 0) {
			$('#DivAlertasHC').html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo falta elegir la subserie del formato de la historia clínica.</div>');
			$('#id_subserie_hc').focus();
		} else if ($('#id_tipodoc_hc').val() == 0) {
			$('#DivAlertasHC').html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo falta elegir el tipo documetal del formato de la historia clínica.</div>');
			$('#id_tipodoc_hc').focus();
		} else {

			$.ajax({
				url: 'acciones_responsables_hc.ajax.php',
				type: "POST",
				data: 'accion=INSERTAR_RESPONSABLE&id_depen=' + $('#id_depen_hc').val() + '&id_funcio_deta=' + $('#id_funcio_deta_hc').val() + '&id_serie=' + $('#id_serie_hc').val() + '&id_subserie=' + $('#id_subserie_hc').val() + '&id_tipodoc=' + $('#id_tipodoc_hc').val(),
				beforeSend: function () {
					$("#DivAlertasHC").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Por favor espera!!!...</a><br><img src="../../../public/assets/img/loading.gif" width="50" height="50" />Enviando información...</div>');
				},
				success: function (msj) {
					if (msj == 1) {
						$("#DivAlertasHC").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="icon fa fa-check"></i> Muy bien!!!...</a> El registro se almaceno correctamente. </div>');

						$.ajax({
							url: 'acciones_responsables_hc.ajax.php',
							type: "POST",
							data: 'accion=ELIMINAR_RESPONSABLE&id_funcio_deta=' + $(this).data('id_funcio_deta'),
							beforeSend: function () {
								$("#DivAlertasHC").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Por favor espera!!!...</a><br><img src="../../../public/assets/img/loading.gif" width="50" height="50" />Enviando información...</div>');
							},
							success: function (msj) {
								if (msj == 1) {
									$("#DivAlertasHC").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="icon fa fa-check"></i> Muy bien!!!...</a> El registro se almaceno correctamente. </div>');
								} else {
									$("#DivResponsablesHC").html('<div class="alert"><button class="close" data-dismiss="alert"></button> Upsss!!!...</h4><br>' + msj + '.</div>');
								}
							},
							error: function () {
								$("#DivAlertasHC").html('<div class="alert alert-danger alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Ha ocurrido un error durante la ejecución.</div>');
							}
						});


					} else {
						$("#DivAlertasHC").html('<div class="alert"><button class="close" data-dismiss="alert"></button> Upsss!!!...</h4><br>' + msj + '.</div>');
					}
				},
				error: function () {
					$("#DivAlertasHC").html('<div class="alert alert-danger alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Ha ocurrido un error durante la ejecución.</div>');
				}
			});
		}
	});

	$("#id_depen_hc").change(function () {

		var IdDepen = $("#id_depen_hc").val();
		var IdOficina = $("#id_oficina_hc").val();
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

			$.post("../../../varios/combo_oficinas.php", {
				idDepen: idDepen
			}, function (data) {
				$("#id_oficina").html(data);
			});
		}
	});

	$("#id_oficina_hc").change(function () {
		var IdDepen = $("#id_depen_hc").val();
		var IdOficina = $("#id_oficina_hc").val();
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

	$("#id_depen_pqrsf").change(function () {

		var IdDepen = $("#id_depen_pqrsf").val();
		var IdOficina = $("#id_oficina_pqrsf").val();
		var IncluirOficinaTRD = $('#incluir_oficina_trd').val();

		if ($("#incluir_oficina_trd").val() == 1) {

			$.post("../../varios/combo_series.php", {
				id_depen: IdDepen,
				id_oficina: '',
				IncluirOficinaTRD: IncluirOficinaTRD
			}, function (data) {
				$("#id_serie_pqrsf").html(data);
			});
		} else if ($("#incluir_oficina_trd").val() == 2) {

			$.post("../../varios/combo_oficinas.php", {
				idDepen: idDepen
			}, function (data) {
				$("#id_oficina_pqrsf").html(data);
			});
		}
	});

	$("#id_oficina_pqrsf").change(function () {
		var IdDepen = $("#id_depen_pqrsf").val();
		var IdOficina = $("#id_oficina_pqrsf").val();
		var IncluirOficinaTRD = $('#incluir_oficina_trd').val();

		$('#id_depen_pqrsf').val(IdDepen);
		$('#id_oficina_pqrsf').val(IdOficina);

		$.post("../../varios/combo_series.php", {
			id_depen: IdDepen,
			id_oficina: IdOficina,
			IncluirOficinaTRD: IncluirOficinaTRD
		}, function (data) {
			$("#id_serie_pqrsf").html(data);
		});
	});

	$('#BtnGuardarResponsablePQRSF').click(function () {

		if ($('#id_depen_pqrsf').val() == 0) {
			$('#DivAlerta').html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo falta elegir la dependencia del formato de la historia clínica.</div>');
			$('#id_depen_pqrsf').focus();
		} else if ($('#id_serie_pqrsf').val() == 0) {
			$('#DivAlerta').html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo falta elegir la serie del formato de la historia clínica.</div>');
			$('#id_serie_pqrsf').focus();
		} else if ($('#id_subserie_pqrsf').val() == 0) {
			$('#DivAlerta').html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo falta elegir la subserie del formato de la historia clínica.</div>');
			$('#id_subserie_pqrsf').focus();
		} else if ($('#id_tipodoc_pqrsf').val() == 0) {
			$('#DivAlerta').html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo falta elegir el tipo documetal del formato de la historia clínica.</div>');
			$('#id_tipodoc_pqrsf').focus();
		} else {

			$.ajax({
				url: 'acciones_responsables_pqrsf.ajax.php',
				type: "POST",
				data: 'accion=INSERTAR_RESPONSABLE&id_depen=' + $('#id_depen_pqrsf').val() + '&id_funcio_deta=' + $('#id_funcio_deta_pqrsf').val() + '&id_serie=' + $('#id_serie_pqrsf').val() + '&id_subserie=' + $('#id_subserie_pqrsf').val() + '&id_tipodoc=' + $('#id_tipodoc_pqrsf').val(),
				beforeSend: function () {
					$("#DivAlerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Por favor espera!!!...</a><br><img src="../../../public/assets/img/loading.gif" width="50" height="50" />Enviando información...</div>');
				},
				success: function (msj) {
					if (msj == 1) {
						$("#DivAlerta").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="icon fa fa-check"></i> Muy bien!!!...</a> El registro se almaceno correctamente. </div>');

					} else {
						$("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button> Upsss!!!...</h4><br>' + msj + '.</div>');
					}
				},
				error: function () {
					$("#DivAlerta").html('<div class="alert alert-danger alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Ha ocurrido un error durante la ejecución.</div>');
				}
			});
		}
	});

	$(document).on('click', '#BtnEliminarResponsablePQRSF', function (event) {
		$.ajax({
			url: 'acciones_responsables_pqrsf.ajax.php',
			type: "POST",
			data: 'accion=ELIMINAR_RESPONSABLE&id_funcio_deta=' + $(this).data('id_funcio_deta'),
			beforeSend: function () {
				$("#DivAlertasHC").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Por favor espera!!!...</a><br><img src="../../../public/assets/img/loading.gif" width="50" height="50" />Enviando información...</div>');
			},
			success: function (msj) {
				if (msj == 1) {
					$("#DivAlertasHC").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="icon fa fa-check"></i> Muy bien!!!...</a> El registro se almaceno correctamente. </div>');
				} else {
					$("#DivResponsablesHC").html('<div class="alert"><button class="close" data-dismiss="alert"></button> Upsss!!!...</h4><br>' + msj + '.</div>');
				}
			},
			error: function () {
				$("#DivAlertasHC").html('<div class="alert alert-danger alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Ha ocurrido un error durante la ejecución.</div>');
			}
		});
	});

	$("#id_depar").change(function () {
		$("#id_depar option:selected").each(function () {
			var idDepar = $(this).val();
			$.post("../../varios/combo_Municipios.php", {
				idDepar: idDepar
			}, function (data) {
				$("#id_muni").html(data);
			});
		});
	});

	$("#id_serie").change(function () {
		if ($("#id_serie").val() != 0) {
			$.post("../../varios/combo_sub_series.php", {
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

			$.post("../../varios/combo_tipos_documentos.php", {
				accion: "",
				id_depen: $('#id_depen').val(),
				id_serie: id_serie,
				id_sub_serie: id_sub_serie
			}, function (data) {
				$("#id_tipodoc").html(data);
			});
		}
	});

	$("#id_serie_pqrsf").change(function () {
		if ($("#id_serie").val() != 0) {
			$.post("../../varios/combo_sub_series.php", {
				id_serie: $("#id_serie_pqrsf").val(),
				id_depen: $('#id_depen_pqrsf').val(),
				id_oficina: '',
				IncluirOficinaTRD: $('#incluir_oficina_trd').val()
			}, function (data) {
				$("#id_subserie_pqrsf").html(data);
			});
		}
	});

	$("#id_subserie_pqrsf").change(function () {
		if ($("#id_subserie_pqrsf").val() != 0) {
			var id_serie = $("#id_serie_pqrsf").val();
			var id_sub_serie = $("#id_subserie_pqrsf").val();

			$.post("../../varios/combo_tipos_documentos.php", {
				accion: "",
				id_depen: $('#id_depen_pqrsf').val(),
				id_serie: id_serie,
				id_sub_serie: id_sub_serie
			}, function (data) {
				$("#id_tipodoc_pqrsf").html(data);
			});
		}
	});
});
