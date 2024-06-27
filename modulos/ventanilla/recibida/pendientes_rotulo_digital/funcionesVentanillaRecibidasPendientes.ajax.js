$(document).ready(function(){

	$('#BtnSubirDigitalRecibido').click(function(){

		var formData = new FormData($(".formulario")[0]);

		$.ajax({
			url: '../../../varios/ftp.acciones.php',
			type: 'POST',
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function(){
				$("#DivAlertarAdjuntoDigital").load("../../../../config/mensajes.php", {
					alerta:5,
					mensaje:'Enviando información, por favor espere...'} ,function(){});
			},
			success:function(msj){
				if(msj == 1){
					$('#BtnCancelarSubirDigitalRecibido').click();
					$("#DivAlertarAdjuntoDigital").empty();
					$('#ifrVisualizaArchivo').attr('src', '')
					load(1);
				}else{
					sweetAlert("Oops...", msj, "error");
				}
			},
			warning:function(){
				sweetAlert("Oops...", msj, "error");
			}
		});
	})

	$(document).on('click', '#BtnDescargarPdfRecibido', function(event){

		var IdRadicado = $(this).data("id_radicado");
		var IdRuta = $(this).data("id_ruta");

		if(IdRuta == 0){
			sweetAlert("Oops...", "El radicado no tiene el documento digital, por favor adjunte el documento digitalizado!", "warning");
		}else{
			$.ajax({
				url: '../../../varios/ftp.acciones.php',
				type: 'POST',
				data: 'accion=RECIBIDOS_DESCARGAR&id_radicado='+IdRadicado+'&id_ruta='+IdRuta,
				beforeSend: function(){
					$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
				},
				success:function(msj){
					$("#DivAlertas").empty();
					if(msj == 1){
						window.open("../../../../archivos/temp/recibidos/"+IdRadicado+".pdf", '_blank');
					}else{
						sweetAlert("Oops...", msj, "warning");
					}		
				},
				error:function(error){
					sweetAlert("Oops...", error, "error");
				}
			});
		}
	});

	//FUNCION PARA CARGAR LA INFORMACION DEL RADICADO
	$(document).on('click', '#BtnMostarInfoRadicadoRecibido', function(event){
		var IdRadicado = $(this).data('id_radicado');

		$('#DivRadicadoRecibido').html(IdRadicado)

		$.ajax({
			url: '../../varios/tab_radicado_recibido_info.php',
			type: 'POST',
			data: 'id_radica='+IdRadicado,
			beforeSend: function(){
				$("#alerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
			},
			success:function(msj){
				$("#alerta").empty();
				$("#DivMostarInfoRadicadoRecibidoInfo").html(msj);
			},
			error:function(msj){
				$("#alerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
			}
		});

		$.ajax({
			url: '../../varios/tab_radicado_recibido_clasificacion.php',
			type: 'POST',
			data: 'id_radica='+IdRadicado,
			beforeSend: function(){
				$("#alerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
			},
			success:function(msj){
				$("#alerta").empty();
				$("#DivMostarInfoRadicadoRecibidoClasificacion").html(msj);
			},
			error:function(msj){
				$("#alerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
			}
		});

		$.ajax({
			url: '../../varios/tab_radicado_recibido_documentos.php',
			type: 'POST',
			data: 'id_radica='+IdRadicado,
			beforeSend: function(){
				$("#alerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
			},
			success:function(msj){
				$("#alerta").empty();
				$("#DivMostarDocumentosRecibido").html(msj);
			},
			error:function(msj){
				$("#alerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
			}
		});

		$.ajax({
			url: '../../varios/tab_radicado_recibido_otra_info.php',
			type: 'POST',
			data: 'id_radica='+IdRadicado,
			beforeSend: function(){
				$("#alerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
			},
			success:function(msj){
				$("#alerta").empty();
				$("#DivOtraInfoRadicadoRecibido").html(msj);
			},
			error:function(msj){
				$("#alerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
			}
		});
	});

	//FUNCION PARA IMPRIMIR ROTULO
	$(document).on('click', '.ImprimirRotulo', function(event){

		if($('#tipo_impre_torulo').val() == 1){
			$("#ifrImprimirRotulo").attr("src","../../../reportes/ventanilla/rotulos/imprimir_rotulo_recibidas_tickect.php?id_radica="+$(this).data('id_radicado'));
		}else if($('#tipo_impre_torulo').val() == 2){
			$("#ifrImprimirRotulo").attr("src","../../../reportes/ventanilla/rotulos/imprimir_rotulo_recibidas_documento.php?id_radica="+$(this).data('id_radicado'));
		}

		$.ajax({
			url: '../recibidas/accionesVentanillaRecibidas.php',
			type: 'POST',
			data: 'accion=IMPRIMIR_ROTULO&id_radica='+$(this).data('id_radicado'),
			success:function(data){
				if(data == 1){
					$('i[id=BtnImprimirRotulo'+$('#id_radicado').val()+']').removeClass('text-warning');
					$('i[id=BtnImprimirRotulo'+$('#id_radicado').val()+']').addClass('text-success');
				}else{
					$('i[id=BtnImprimirRotulo'+$('#id_radicado').val()+']').removeClass('text-warning');
					$('i[id=BtnImprimirRotulo'+$('#id_radicado').val()+']').addClass('text-danger');
				}
			},
			error:function(data){
				sweetAlert("Oops...", data, "warning");
			}
		});
	});

	//FUNCIONES PARA ESTABLCER EL ID DEL RADICADO PARA AGREGAR
	//EL ARCHIVO DIGITAL E IMPRIMIR EL ROTULO
	$(document).on('click', '.idradicado', function(event){
		$('#id_radicado').val($(this).data('id_radicado'));
	});

	$(document).on('click', '.ImprimirRotulo', function(event){
		$('#id_radicado').val($(this).data('id_radicado'));
	});

	$('#BtnReportCorrespondenRecibidaPorVencer').click(function(){
		var url = '../../../reportes/ventanilla/pendientes/por_vencer_recibidos_excel.php';
		window.open(url);
	});

	$('#BtnReportCorresRecibidaPorDigital').click(function(){
		var url = '../../../reportes/ventanilla/pendientes/por_digital_recibidos_excel.php';
		window.open(url);
	});
});