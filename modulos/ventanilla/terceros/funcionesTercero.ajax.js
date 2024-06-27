$(document).ready(function () {

	$("#TxtBusTerceroJuridicos").focus();

	$("#BtnBuscar").click(function (e) {
		if ($("#TxtBusTerceroJuridicos").val() === "") {
			$("#DivAlertas").load("../../../config/mensajes.php", { alerta: 3, mensaje: 'Te hizo falta el criterio a buscar.' }, function () { });
			$("#TxtBusTerceroJuridicos").focus();
		} else {
			$.ajax({
				url: '../../varios/listar_tercero.php',
				type: 'POST',
				data: 'criterio=' + $("#TxtBusTerceroJuridicos").val(),
				beforeSend: function () {
					$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
				},
				success: function (msj) {
					$("#DivAlertas").empty();
					if (msj != 1) {
						$("#DivListardoTerceros").html(msj);
					} else {
						$("#DivAlertas").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> No se encontraron resultados .</div>');
					}
				},
				error: function (msj) {
					$("#DivAlertas").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + '</div>');
				}
			});
		}
	});

	$("#TxtBusTerceroJuridicos").keyup(function (e) {
		if (e.which == 13) {
			$("#BtnBuscar").click();
		}
	});

	$('#BtnGuardarNuevaEmpresa').click(function () {

		if ($('#nit_nueva_empre').val() == "") {
			$("#DivAlertasEmpresa").load("../../../config/mensajes.php", { alerta: 3, mensaje: 'Te hizo falta el Nit. de la empresa.' }, function () { });
			$('#nit_nueva_empre').focus();
		} else if ($('#razo_soci_nueva_empre').val() == "") {
			$("#DivAlertasEmpresa").load("../../../config/mensajes.php", { alerta: 3, mensaje: 'Te hizo falta la Razón Social de la empresa.' }, function () { });
			$('#razo_soci_nueva_empre').focus();
		} else if ($('#id_depar_nueva_empre').val() == 0) {
			$("#DivAlertasEmpresa").load("../../../config/mensajes.php", { alerta: 3, mensaje: 'Te hizo falta el departamento de la empresa.' }, function () { });
			$('#id_depar_nueva_empre').focus();
		} else if ($('#id_muni_nueva_empre').val() == 0) {
			$("#DivAlertasEmpresa").load("../../../config/mensajes.php", { alerta: 3, mensaje: 'Te hizo falta al municipio de la empresa.' }, function () { });
			$('#id_muni_nueva_empre').focus();
		} else {

			var formData = new FormData($("#FrmDatosEmpresa")[0]);

			$.ajax({
				url: '../../general/terceros/acciones_tercero.ajax.php',
				type: 'POST',
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function () {
					$("#DivAlertasEmpresa").load("../../../config/mensajes.php", { alerta: 5, mensaje: 'Enviando información, por favor espere...' }, function () { });
				},
				success: function (msj) {

					var Elemento = msj.split('###');

					if (Elemento[0] == 1) {
						$("#DivAlertasEmpresa").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El registro se almaceno correctamente. </div>');

						$('#id_empre').val(Elemento[1]);
						$('#nit').val($('#nit_nueva_empre').val());
						$('#razo_soci').val($('#razo_soci_nueva_empre').val());
						$('#dir_empresa').val($('#dir_nueva_empre').val());
						$('#tel_empresa').val($('#tel_nueva_empre').val());
						$('#cel_empresa').val($('#cel_nueva_empre').val());
						$('#fax_empresa').val($('#fax_nueva_empre').val());
						$('#email_empresa').val($('#email_nueva_empre').val());
						$('#web_empresa').val($('#web_nueva_empre').val());

						var IdDepar = $('#id_depar_nueva_empre').val();
						$.post("../../varios/combo_Departamentos.php", {
						}, function (data) {
							$("#id_depar_empresa").html(data);
							$('#id_depar_empresa > option[value="' + IdDepar + '"]').attr('selected', true);
						});

						var IdMuni = $('#id_muni_nueva_empre').val();
						$.post("../../varios/combo_Municipios.php", {
							idDepar: IdDepar
						}, function (data) {
							$("#id_muni_empresa").html(data);
							$('#id_muni_empresa > option[value="' + IdMuni + '"]').attr('selected', true);
						});

					} else {
						$("#DivAlertasEmpresa").load("../../../config/mensajes.php", { alerta: 3, mensaje: msj }, function () { });
					}
				},
				error: function (msj) {
					$("#DivAlertasEmpresa").load("../../../config/mensajes.php", { alerta: 1, mensaje: 'Ha ocurrido un error durante la ejecución, ' + msj }, function () { });
				}
			});
		}
	});

	$('#BtnEditar').click(function () {
		let nomTercero = "";
		if ($('#razo_soci').val() === '') {
			nomTercero = $('#razo_soci').val();
		} else {
			nomTercero = $('#nom_contac').val();
		}
		swal({
			title: "¿Desea editar el registro: " + nomTercero + "?",
			type: "info",
			showCancelButton: true,
			closeOnConfirm: false,
			showLoaderOnConfirm: false,
		},

			function () {
				if ($('#nom_contac').val() == "" && $('#id_empre').val() != "") {
					$("#DivAlertas").load("../../../config/mensajes.php", { alerta: 3, mensaje: 'Te hizo falta el Nit. de la empresa.' }, function () { });
					$('#nom_contac').focus();
				} else if ($('#nit').val() == "" && $('#id_empre').val() != "") {
					$("#DivAlertas").load("../../../config/mensajes.php", { alerta: 3, mensaje: 'Te hizo falta el Nit. de la empresa.' }, function () { });
					$('#nit').focus();
				} else if ($('#razo_soci').val() == "" && $('#id_empre').val() != "") {
					$("#DivAlertas").load("../../../config/mensajes.php", { alerta: 3, mensaje: 'Te hizo falta la Razón Social de la empresa.' }, function () { });
					$('#razo_soci').focus();
				} else if ($('#id_depar_empresa').val() == 0 && $('#id_empre').val() != "") {
					$("#DivAlertas").load("../../../config/mensajes.php", { alerta: 3, mensaje: 'Te hizo falta el departamento de la empresa.' }, function () { });
					$('#id_depar_empresa').focus();
				} else if ($('#id_muni_empresa').val() == 0 && $('#id_empre').val() != "") {
					$("#DivAlertas").load("../../../config/mensajes.php", { alerta: 3, mensaje: 'Te hizo falta al municipio de la empresa.' }, function () { });
					$('#id_muni_empresa').focus();
				} else {

					var formData = new FormData($("#FrmDatos")[0]);

					$.ajax({
						url: '../../general/terceros/acciones_tercero.ajax.php',
						type: 'POST',
						data: formData,
						cache: false,
						contentType: false,
						processData: false,
						beforeSend: function () {
							$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
						},
						success: function (msj) {
							if (msj == 1) {
								$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El registro se actualizo correctamente. </div>');
								setTimeout(function () {
									window.location.href = "index.php";
								}, 100);
							} else {
								$("#DivAlertas").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> ' + msj + '.</div>');
							}
						},
						error: function (msj) {
							$("#DivAlertas").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + '</div>');
						}
					});
				}
			});
	});

	//FUNCION PARA BUSCAR EL TERCERO NATURAL
	$("#TxtBusEmpresa").keyup(function (e) {
		if (e.which == 13) {
			if ($("#TxtBusEmpresa").val() === "") {
				$("#DivAlertasEmpresa").load("../../../config/mensajes.php", { alerta: 3, mensaje: 'Te hizo falta al empresa del contacto.' }, function () { });
				$("#TxtBusEmpresa").focus();
			} else {
				$.ajax({
					url: '../../varios/listar_empresa.php',
					type: 'POST',
					data: 'criterio=' + $("#TxtBusEmpresa").val(),
					beforeSend: function () {
						$("#DivAlertasEmpresa").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
					},
					success: function (msj) {
						$("#DivAlertasEmpresa").empty();
						if (msj != 1) {
							$("#DivListarEmpresa").html(msj);
						} else {
							$("#DivAlertasEmpresa").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> ' + msj + '.</div>');
						}
					},
					error: function (msj) {
						$("#DivAlertasEmpresa").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + '</div>');
					}
				});
			}
		}
	});

	$(document).on('click', '#BtnLlevarEmpresa', function (event) {
		$('#id_empre').val($(this).data("id_empre"));
		$('#nit').val($(this).data("nit"));
		$('#razo_soci').val($(this).data("razo_soci"));
		$('#dir_empresa').val($(this).data("dir"));
		$('#tel_empresa').val($(this).data("tel"));
		$('#cel_empresa').val($(this).data("cel"));
		$('#fax_empresa').val($(this).data("fax"));
		$('#email_empresa').val($(this).data("email"));
		$('#web_empresa').val($(this).data("web"));

		var IdDepar = $(this).data("id_depar");
		$.post("../../varios/combo_Departamentos.php", {
		}, function (data) {
			$("#id_depar_empresa").html(data);
			$('#id_depar_empresa > option[value="' + IdDepar + '"]').attr('selected', true);
		});

		var IdMuni = $(this).data("id_muni");
		$.post("../../varios/combo_Municipios.php", {
			idDepar: IdDepar
		}, function (data) {
			$("#id_muni_empresa").html(data);
			$('#id_muni_empresa > option[value="' + IdMuni + '"]').attr('selected', true);
		});
	});

	$(document).on('click', '#BtnDesvincularEmpresa', function (event) {
		$('#id_empre').val("");
		$('#nit').val("");
		$('#razo_soci').val($(this).data(""));
		$('#dir_empresa').val($(this).data(""));
		$('#tel_empresa').val($(this).data(""));
		$('#cel_empresa').val($(this).data(""));
		$('#fax_empresa').val($(this).data(""));
		$('#email_empresa').val($(this).data(""));
		$('#web_empresa').val($(this).data(""));

		$.post("../../varios/combo_Departamentos.php", {
		}, function (data) {
			$("#id_depar_empresa").html(data);
		});

		$("#id_muni_empresa").html('<option value="0">...::: Elije el Municipio :::...</option>');
	});


	$("#id_depar_contac").change(function () {
		$("#id_depar_contac option:selected").each(function () {
			var idDepar = $(this).val();
			$.post("../../varios/combo_Municipios.php", {
				idDepar: idDepar
			}, function (data) {
				$("#id_muni_contac").html(data);
			});
		});
	});

	$("#id_depar_empresa").change(function () {
		$("#id_depar_empresa option:selected").each(function () {
			var idDepar = $(this).val();
			$.post("../../varios/combo_Municipios.php", {
				idDepar: idDepar
			}, function (data) {
				$("#id_muni_empresa").html(data);
			});
		});
	});

	$("#id_depar_nueva_empre").change(function () {
		$("#id_depar_nueva_empre option:selected").each(function () {
			var idDepar = $(this).val();
			$.post("../../varios/combo_Municipios.php", {
				idDepar: idDepar
			}, function (data) {
				$("#id_muni_nueva_empre").html(data);
			});
		});
	});

	$('#BtnRegresar').click(function () {
		setTimeout(function () {
			window.location.href = "index.php";
		});
	});
});