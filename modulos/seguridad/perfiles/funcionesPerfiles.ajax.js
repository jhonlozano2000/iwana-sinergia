$(document).ready(function () {

	$('#nom_perfil').focus();

	$('#BtnGuardarPerfil').click(function () {
		if ($('#nom_perfil').val() == "") {
			$("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: 'Te hizo falta el nombre del perfil.' }, function () { });
			$('#nom_perfil').focus();
		} else {

			var formData = new FormData($("#FrmDatos")[0]);

			$.ajax({
				url: 'accionesPerfiles.ajax.php',
				type: 'POST',
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function () {
					$("#DivAlerta").load("../../../config/mensajes.php", { alerta: 5, mensaje: 'Enviando información, por favor espere...' }, function () { });
				},
				success: function (msj) {
					if (msj == 1) {
						$("#DivAlerta").load("../../../config/mensajes.php", { alerta: 4, mensaje: 'El registro se almaceno correctamente' }, function () { });
						setTimeout(function () {
							window.location.href = "index.php";
						}, 100);
					} else {
						$("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: msj }, function () { });
					}
				},
				error: function (msj) {
					$("#DivAlerta").load("../../../config/mensajes.php", { alerta: 1, mensaje: 'Ha ocurrido un error durante la ejecución, ' + msj }, function () { });
				}
			});
		}
		return false;
	});

	$('#BtnRegresar').click(function () {
		setTimeout(function () {
			window.location.href = "index.php";
		});
	});

	$('#BtnEditarPerfil').click(function () {
		swal({
			title: "¿Estás seguro que desea editar el registro: " + $('#nom_perfil').val() + "?",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#f0ad4e",
			confirmButtonText: "Si, Editar!",
			closeOnConfirm: false
		},

			function () {

				if ($('#nom_perfil').val() == "") {
					$("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: 'Te hizo falta el nombre del perfil.' }, function () { });
					$('#nom_perfil').focus();
				} else {

					var formData = new FormData($("#FrmDatos")[0]);

					$.ajax({
						url: 'accionesPerfiles.ajax.php',
						type: 'POST',
						data: formData,
						cache: false,
						contentType: false,
						processData: false,
						beforeSend: function () {
							$("#DivAlerta").load("../../../config/mensajes.php", { alerta: 5, mensaje: 'Enviando información, por favor espere...' }, function () { });
						},
						success: function (msj) {
							if (msj == 1) {
								$("#DivAlerta").load("../../../config/mensajes.php", { alerta: 4, mensaje: 'El registro se edito correctamente' }, function () { });
								setTimeout(function () {
									window.location.href = "index.php";
								});
							} else {
								$("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: msj }, function () { });
							}
						},
						error: function (msj) {
							$("#DivAlerta").load("../../../config/mensajes.php", { alerta: 1, mensaje: 'Ha ocurrido un error durante la ejecución, ' + msj }, function () { });
						}
					});
				}

			});
	});

	$(document).on('click', '#BtnEliminar', function (event) {

		var Id = $(this).data("id");
		var Nom = $(this).data("nom");

		swal({
			title: "¿Estás seguro que desea eliminar el perfil: " + Nom + "?",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Si, Eliminar!",
			closeOnConfirm: false
		},

			function () {

				$.ajax({
					url: 'accionesPerfiles.ajax.php',
					type: 'POST',
					data: 'accion=ELIMINAR&id_perfil=' + Id,
					beforeSend: function () {
						$("#DivAlerta").load("../../../config/mensajes.php", { alerta: 5, mensaje: 'Enviando información, por favor espere...' }, function () { });
					},
					success: function (msj) {
						if (msj == 1) {
							$("#DivAlerta").load("../../../config/mensajes.php", { alerta: 4, mensaje: 'El registro se elimino correctamente' }, function () { });
							$("#TrDatos" + Id).remove();
							swal("¡Eliminado!",
								"El registro " + Nom + " se elimino correctamente!.",
								"success");
						} else {
							$("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: msj }, function () { });
						}
					},
					error: function (msj) {
						$("#DivAlerta").load("../../../config/mensajes.php", { alerta: 1, mensaje: 'Ha ocurrido un error durante la ejecución, ' + msj }, function () { });
					}
				});

			});
	});

	$(document).on('click', '.acti', function (event) {

		var Id = $(this).data("id");
		var Nom = $(this).data("nom");
		var Accion = "";
		var Boton = "";
		var Tipo = "";

		if ($(this).is(':checked')) {
			var Acti = 1;
			Accion = "activar";
			Boton = "#468847";
			Tipo = "success";
		} else {
			var Acti = 0;
			Accion = "inactivar";
			Boton = "#f0ad4e";
			Tipo = "warning";
		}

		swal({
			title: "¿Desea " + Accion + " el perfil " + Nom + "?",
			type: Tipo,
			showCancelButton: true,
			cancelButtonText: "No",
			confirmButtonColor: Boton,
			confirmButtonText: "¡si, " + Accion + "!",
			closeOnConfirm: false
		},

			function () {
				$.ajax({
					url: 'accionesPerfiles.ajax.php',
					type: 'POST',
					data: 'accion=ACTIVAR&id_perfil=' + Id + '&acti=' + Acti,
					beforeSend: function () {
						$("#DivAlerta").load("../../../config/mensajes.php", { alerta: 5, mensaje: 'Enviando información, por favor espere...' }, function () { });
					},
					success: function (msj) {
						if (msj == 1) {
							$("#DivAlerta").load("../../../config/mensajes.php", { alerta: 4, mensaje: 'El registro se actualizo correctamente' }, function () { });
							swal("¡" + Accion + "!",
								"El perfil " + Nom + " ha sido " + Accion + "!.",
								"success");
						} else {
							$("#DivAlerta").load("../../../config/mensajes.php", { alerta: 3, mensaje: msj }, function () { });
						}
					},
					error: function (msj) {
						$("#DivAlerta").load("../../../config/mensajes.php", { alerta: 1, mensaje: 'Ha ocurrido un error durante la ejecución, ' + msj }, function () { });
					}
				});
			});
	});
});