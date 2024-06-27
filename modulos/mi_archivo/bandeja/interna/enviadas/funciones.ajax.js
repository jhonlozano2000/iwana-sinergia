$(document).ready(function () {

	$(document).on('click', '#BtnDescargarArchivoInterno', function (event) {

		var IdRadicado    = $(this).data('id_radicado');
		var IdFuncionario = $(this).data('id_funcio');
		var Archivo       = $(this).data('archivo');
		var IdRuta        = $(this).data('id_ruta');
		var Archivo       = $(this).data('archivo');

		$.ajax({
			url: '../../../../varios/ftp.acciones.php',
			type: 'POST',
			data: 'accion=INTERNO_DOWNLOAD&id_radicado='+IdRadicado+'&id_ruta='+IdRuta+'&archiv_interno='+Archivo,
			beforeSend: function(){
				$("#DivAlertas").load("../../../../../config/mensajes.php", {
					alerta: 5,
					mensaje: 'Enviando archivos adjuntos al servidor...',
					Imagen: '../../public/assets/img/loading.gif'
				}, function(){});
			},
			success:function(msj){
				$("#DivAlertas").empty();
				if(msj == 1){
					window.open("../../../../../archivos/temp/interna/"+Archivo, '_blank');
				}else{
					sweetAlert("Oops...", msj, "warning");
				}	
			},
			error:function(error){
				sweetAlert("Error...", error, "error");
			}
		});
	});

	$(document).on('click', '#TRRadicado', function (event){
		
		var IdRadicado = $(this).data('id_radicado');
		
		$.ajax({
			url: '../../../../ventanilla/varios/mostrar_radicado_interno_bandeja.php',
			type: 'POST',
			data: 'id_radica='+$(this).data('id_radicado'),
			beforeSend: function(){
				$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Por favor espera!!!...</a><br><img src="../../../../../public/assets/img/loading.gif" width="50" height="50" />Enviando información...</div>');
			},
			success:function(msj){
				
				$("#DivAlertas").empty();
				$("#DivRadicadosInfo").html(msj);
				
				//MARCO COMO LEIDO
				$.ajax({
					url: '../recibidas/acciones.ajax.php',
					type: 'POST',
					data: 'accion=MARCAR_LEIDO&id_radica='+IdRadicado,
					beforeSend: function(){
						$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Por favor espera!!!...</a><br><img src="../../../../../public/assets/img/loading.gif" width="50" height="50" />Enviando información...</div>');
					},
					success:function(msj){
						$("#DivAlertas").empty();
					},
					error:function(msj){
						$("#DivAlertas").html('<div class="alert alert-danger alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Ha ocurrido un error durante la ejecución, '+msj+'.</div>');
					}
				});
			},
			error:function(msj){
				$("#DivAlertas").html('<div class="alert alert-danger alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Ha ocurrido un error durante la ejecución, '+msj+'.</div>');
			}
		});
	});
});