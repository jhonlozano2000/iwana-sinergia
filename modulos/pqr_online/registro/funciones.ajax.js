$(document).ready(function () {

	$('#num_docu').focus();

	$('#BtnGuardar').click(function () {
		if ($('#num_docu').val() == "") {
			$("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: 'Te hizo falta el número de documento.' }, function () { });
			$('#num_docu').focus();
		} else {

			$.ajax({
				url: '../../../modulos/pqr_online/registro/acciones.ajax.php',
				type: 'POST',
				data: 'accion=NUEVO_TERCERO&id_tipo_docu=' + $('#id_tipo_docu').val() + '&num_docu_contac=' + $('#num_docu').val() + '&nom_contac=' + $('#nom_contac').val() + '&id_depar_contac=' + $('#id_depar').val() + '&id_muni_contac=' + $('#id_muni').val() + '&dir_contac=' + $('#dir').val() + '&cel_contac=' + $('#cel').val() + '&tel_contac=' + $('#tel').val() + '&email_contac=' + $('#email').val() + '&password=' + $('#password').val(),
				beforeSend: function () {
					$("#DivAlerta").load("../../../config/mensajes.php", { alerta: 5, mensaje: 'Enviando información...', Imagen: '../../../public/assets/img/loading.gif' }, function () { });
				},
				success: function (msj) {

					let Elemento = msj.split("####");

					if (Elemento[0] == 1) {
						$("#DivAlerta").load("../../../config/mensajes.php", { alerta: 4, mensaje: 'El registro se almaceno correctamente' }, function () { });
						setTimeout(function () {
							window.location.href = "pqr_online";
						}, 100);
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

	$("#id_depar").change(function () {
		$("#id_depar option:selected").each(function () {
			var idDepar = $(this).val();
			$.post("./../../modulos/varios/combo_Municipios.php", {
				idDepar: idDepar
			}, function (data) {
				$("#id_muni").html(data);
			});
		});
	});
});