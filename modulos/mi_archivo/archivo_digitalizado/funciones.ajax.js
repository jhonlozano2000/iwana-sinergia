$(document).ready(function () {

	$(document).on('click', '#BtnExpediente', function (event) {


		var IdDigital = $(this).data("id_expediente");

		$.ajax({
			url: 'listar_archivos.php',
			type: 'POST',
			data: 'id_expediente=' + IdDigital,
			beforeSend: function () {
				$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
			},
			success: function (msj) {
				$("#DivAlertas").empty();
				$("#DivDetalleExpediente").html(msj);
			},
			error: function () {
				sweetAlert("Oops...", "Ha ocurrido un error durante la ejecución", "error");
			}
		});

		$.ajax({
			url: 'listar_titulo.php',
			type: 'POST',
			data: 'id_expediente=' + IdDigital,
			beforeSend: function () {
				$("#DivTitulo").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
			},
			success: function (msj) {
				$("#DivTitulo").html(msj);
			},

		});
	});

	$(document).on('click', '#BtnDescargarArchivo', function (event) {
		event.preventDefault();
		var IdDigital = $(this).data("id_digital");
		var IdArchivo = $(this).data("id_archivo");
		var IdRuta = $(this).data("id_ruta");
		var Archivo = $(this).data("archivo");
		var TipoArchivo = $(this).data("tipo_archivo");

		$.ajax({
			url: '../../varios/ftp.acciones.php',
			type: 'POST',
			data: 'accion=DESCARGAR_ARCHIVO_EXPEDIENTE_DIGITAL_TRD&id_digital=' + IdDigital + '&id_archivo=' + IdArchivo + '&id_ruta=' + IdRuta + '&archivo=' + Archivo + '&tipo_archivo=' + TipoArchivo,
			beforeSend: function () {
				$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
			},
			success: function (msj) {
				$("#DivAlertas").empty();

				let Elementos = msj.split("-");

				if (Elementos[0] == 1) {
					window.open("../../../archivos/temp/expedientes/" + IdDigital + "/" + Elementos[1] + "/" + Archivo, '_blank');
				} else {
					$("#DivAlertas").html(msj);
				}
			},
			error: function (error) {
				sweetAlert("Oops...", error, "error");
			}
		});
	});
});