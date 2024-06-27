$(document).ready(function () {

	$("#BtnEnviarParaTramite").click(function () {

		let idResponsable = $('#id_responsable').val();

		let Destinatarios = new Array();
		$("input[name='ChkFuncionariosResponsables[]']").each(function () {
			Destinatarios.push($(this).val());
		});

		if (Destinatarios.length == 0) {
			sweetAlert("Oops...", "Te hizo falta el o los destinatarios de la solicitud!", "warning");
			$('#BtnBuscarDestinatario').click();
		} else if ($('#incluir_trd').val() == 1 && $('#id_serie').val() == 0) {
			sweetAlert("Oops...", "Te hizo falta la Serie de la clasificación documental de la solicitud!", "warning");
			$('#id_serie').focus();
		} else if ($('#incluir_trd').val() == 1 && $('#id_subserie').val() == 0) {
			sweetAlert("Oops...", "Te hizo falta la Subserie de la clasificación documental de la solicitud!", "warning");
			$('#id_subserie').focus();
		} else if ($('#id_tipodoc').val() == 0) {
			sweetAlert("Oops...", "Te hizo falta el tipo documental de la clasificación documental de la solicitud!", "warning");
			$('#id_tipodoc').focus();
		} else {

			$.ajax({
				url: '../../../../modulos/ventanilla/pqrsf/pendientes/accionesVentanillaRecibidasPqr.php',
				type: 'POST',
				data: 'accion=ASIGNAR_PQR&id_pqr=' + $('#id_pqr').val() + '&id_radica=' + $('#id_radica').val() + '&id_serie=' + $('#id_serie').val() + '&id_subserie=' + $('#id_subserie').val() + '&id_tipodoc=' + $('#id_tipodoc').val() + '&id_tipo_correspon=' + $('#id_tipo_correspon').val() + '&asunto=' + $('#asunto').val() + '&responsable=' + idResponsable + '&Destinatarios=' + Destinatarios + "&incluir_trd=" + $('#incluir_trd').val() + "&id_remite=" + $('#id_remite').val(),
				beforeSend: function () {
					$("#DivAlertas").load("../../../../config/mensajes.php", {
						alerta: 5,
						mensaje: 'Enviando información, por favor espere...'
					}, function () { });
				},
				success: function (msj) {
					if (msj == 1) {
						$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El registro se almaceno correctamente. </div>');
						setTimeout(function () {
							window.location.href = "../../../../modulos/ventanilla/pqrsf/pendientes/index.php";
						}, 200);
					} else {
						sweetAlert("Oops...", msj + "!", "warning");
					}
				},
				error: function () {
					sweetAlert("Oops...", "Ha ocurrido un error durante la ejecución", "error");
				}
			});
		}
	});

	//FUNCION PARA LLEVAR LOS RESPONSABLES
	$('.BtnLlevarDestinatarios').click(function (event) {
		event.preventDefault();

		let idFuncioDeta = $(this).data('id_funcio_deta');
		let nombreDestinatario = $(this).data('nombre_destinatario');
		let idDependenciaDestinatario = $(this).data('id_dependencia_destinatario');
		let idOficinaDestinatario = $(this).data('id_oficina_destinatario');
		let oficinaDestinatario = $(this).data('oficina_destinatario');

		$('#TblDestinatarios tr:last').after('<tr id="TrDestinatarios' + idFuncioDeta + '"><td><div class="radio radio-success"><input type="radio" class="seleccionarResponsable" name="ChkFuncionariosResponsables[]" id="ChkFuncionariosResponsables' + idFuncioDeta + '" value="' + idFuncioDeta + '" data-id_responsable_dependencia="' + idDependenciaDestinatario + '" data-id_responsable_oficina="' + idOficinaDestinatario + '"><label for="ChkFuncionariosResponsables' + idFuncioDeta + '">R</label></div></td><td>' + nombreDestinatario + '</td><td>' + oficinaDestinatario + '</td><td><button class="borrar_destinatario btn btn-danger btn-sm btn-small" data-id="' + idFuncioDeta + '" ><i class="fa fa-trash-o"></i></button></td></tr>');
	});

	//FUNCION PARA CARGAR LA TRD DE LA DEPENDEICA DEL FUNCIONARIO ELEJIDO
	$("body").on("change", ".seleccionarResponsable", function (event) {
		event.preventDefault();

		//let idResponsable = $(this).data('id_responsable_dependencia');
		let idResponsable = $(this).val();
		let IdDepen = $(this).data('id_responsable_dependencia');
		let IdOficina = $(this).data('id_responsable_oficina');
		let IncluirOficinaTRD = $('#incluir_oficina_trd').val();

		$('#id_responsable').val(idResponsable)
		$('#id_depen').val(IdDepen);
		$('#id_oficina').val(IdOficina);

		$.post("../../../../modulos/varios/combo_series.php", {
			id_depen: IdDepen,
			id_oficina: IdOficina,
			IncluirOficinaTRD: IncluirOficinaTRD
		}, function (data) {
			$("#id_serie").html(data);
		});
	});

	$("#id_serie").change(function () {

		let idResponsable = $('#id_responsable').val();
		let totalDestinatarios = $("input[name='ChkFuncionariosResponsables[]']").length

		if (totalDestinatarios === 0) {
			sweetAlert("Oops...", "Te hizo falta el o los destinatarios de la correspondencia!", "warning");
			$('#BtnBuscarDestinatario').click();
		} else if (idResponsable == "") {
			sweetAlert("Oops...", "Debe establecer el responsable de la correspondencia!", "warning");
		} else {
			$("#id_serie option:selected").each(function () {
				$.post("../../../../modulos/varios/combo_sub_series.php", {
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

			$.post("../../../../modulos/varios/combo_tipos_documentos.php", {
				accion: $('#accion').val(),
				id_depen: $('#id_depen').val(),
				id_serie: id_serie,
				id_sub_serie: id_sub_serie
			}, function (data) {
				$("#id_tipodoc").html(data);
			});
		});
	});

	//FUNCION PARA BORRAR UN RESPONSABLES
	$(document).on('click', '.borrar_destinatario', function (event) {
		event.preventDefault();
		$(this).closest('tr').remove();
		$("#ChkDestinatarios" + $(this).data('id')).prop('checked', false);
	});


});