$(document).ready(function () {

	$('#num_docu').focus();

	$('#btnGuardar').click(function () {

		if ($('#id_tipo_documental').val() == 0) {
			$("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: 'Te hizo falta el Tipo de solicitud.' }, function () { });
			$('#id_tipo_documental').focus();
		} else if ($('#id_tipo_docu_afectado').val() == 0) {
			$("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: 'Te hizo falta el Tipo de documento del afectado.' }, function () { });
			$('#id_tipo_docu_afectado').focus();
		} else if ($('#num_docu_afectado').val() === "") {
			$("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: 'Te hizo falta el # de documento del afectado.' }, function () { });
			$('#num_docu_afectado').focus();
		} else if ($('#nom_afectado').val() === "") {
			$("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: 'Te hizo falta el Nombres del afectado.' }, function () { });
			$('#nom_afectado').focus();
		} else if ($('#id_depar_afectado').val() == 0) {
			$("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: 'Te hizo falta el Departamento del afectado.' }, function () { });
			$('#id_depar_afectado').focus();
		} else if ($('#id_muni_afectado').val() == 0) {
			$("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: 'Te hizo falta el Municipio del afectado.' }, function () { });
			$('#id_muni_afectado').focus();
		} else if ($('#dir').val() === "") {
			$("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: 'Te hizo falta el Dirección del afectado.' }, function () { });
			$('#dir').focus();
			/* } else if ($('#tel').val() == "" || $('#movil').val() == "") {
				$("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: 'Te hizo falta almenos un número de teléfono.' }, function () { });
				$('#tel').focus(); */
		} else if ($('#detalle_solicitud').val() === "") {
			$("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: 'Te hizo falta el Aspecto o tema principal que motivó la queja.' }, function () { });
			$('#detalle_solicitud').focus();
		} else if ($('#id_regimen').val() == 0) {
			$("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: 'Te hizo falta el regimen del afectado.' }, function () { });
			$('#id_regimen').focus();
		} else {

			$.ajax({
				url: '../../../modulos/pqr_online/solicitudes/nueva_solicitud/acciones.ajax.php',
				type: 'POST',
				data: 'accion=NUEVA_SOLICITUD&id_tipo_docu_afectado=' + $('#id_tipo_docu_afectado').val() + '&id_depar_afectado=' + $('#id_depar_afectado').val() + '&id_muni_afectado=' + $('#id_muni_afectado').val() + '&id_tipo_documental=' + $('#id_tipo_documental').val() + '&id_regimen=' + $('#id_regimen').val() + '&num_docu_afectado=' + $('#num_docu_afectado').val() + '&nom_afectado=' + $('#nom_afectado').val() + '&dir_afectado=' + $('#dir_afectado').val() + '&tel_afectado=' + $('#tel_afectado').val() + '&movil_afectado=' + $('#movil_afectado').val() + '&detalle_solicitud=' + $('#detalle_solicitud').val() + '&fallo_judicial=' + $('#fallo_judicial').val(),
				beforeSend: function () {
					$("#DivAlerta").load("../../../config/mensajes.php", { alerta: 5, mensaje: 'Enviando solicitud...', Imagen: '../../../public/assets/img/loading.gif' }, function () { });
				},
				success: function (msj) {
					let Elementos = msj.split('###');
					if (Elementos[0] == 1) {

						sweetAlert("Radicado: " + Elementos[1], "Tu solicitud se realizó con éxito.", "success");

						/**
						 * CARGO LOS DOCUMENTOS ADJUNTOS
						 */

						$('#id_radicado').val(Elementos[1]);
						$('#id_pqr').val(Elementos[2])

						var formData = new FormData($("#miFormAdjuntos")[0]);

						$.ajax({
							url: '../../../modulos/varios/ftp.acciones.php',
							type: 'POST',
							data: formData,
							cache: false,
							contentType: false,
							processData: false,
							beforeSend: function () {
								$("#DivAlerta").load("../../../config/mensajes.php", { alerta: 5, mensaje: 'Enviando archivos...', Imagen: '../../../public/assets/img/loading.gif' }, function () { });
							},
							success: function (msj) {
								if (msj == 1) {
									$("#DivAlerta").empty();
								} else {
									$("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: msj }, function () { });
								}
							},
							error: function () {
								$("#DivAlerta").load("../config/mensajes.php", { alerta: 1, mensaje: 'Ha ocurrido un error durante la ejecución' }, function () { });
							}
						});

						window.location = "/pqr_mis_solicitudes";
					} else {
						$("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: msj }, function () { });
					}
				},
				error: function () {
					$("#DivAlerta").load("../config/mensajes.php", { alerta: 1, mensaje: 'Ha ocurrido un error durante la ejecución' }, function () { });
				}
			});
		}
		return false;
	});

	$("#id_depar_afectado").change(function () {
		$("#id_depar_afectado option:selected").each(function () {
			var idDepar = $(this).val();
			$.post("./../../modulos/varios/combo_Municipios.php", {
				idDepar: idDepar
			}, function (data) {
				$("#id_muni_afectado").html(data);
			});
		});
	});
});