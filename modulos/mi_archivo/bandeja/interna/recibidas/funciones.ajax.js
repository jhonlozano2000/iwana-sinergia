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
				$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
			},
			success:function(msj){
				if(msj == 1){
					window.open("../../../../../archivos/temp/interna/"+Archivo, '_blank');
					$("#DivAlertas").empty();
				}else{
					sweetAlert("Oops...", msj, "warning");
				}
			},
			error:function(msj){
				sweetAlert("Error...", msj, "error");
			}
		});
	});

	$(document).on('click', '#TipoVer', function (event){
		$('#tipo_ver').val($(this).data('tipo_ver'));
		load(1)
	});

	$(document).on('click', '#BtnMostarInfoRadicadoInterno', function (event){
		
		var IdRadicado = $(this).data('id_radicado');
		
		$.ajax({
			url: '../../../../ventanilla/varios/mostrar_radicado_interno_bandeja_ver.php',
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
					url: 'acciones.ajax.php',
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

	$(document).on('click', '#BtnResponderCorrespondencia', function (event){
		
		var IdRadicado = $(this).data('id_radicado');
		window.location.href = '../responder/responder.php?id_radica='+IdRadicado;
		/*
		$.ajax({
			url: '../../../../ventanilla/varios/mostrar_radicado_interno_bandeja_responder.php',
			type: 'POST',
			data: 'id_radica='+$(this).data('id_radicado'),
			beforeSend: function(){
				$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Por favor espera!!!...</a><br><img src="../../../../../public/assets/img/loading.gif" width="50" height="50" />Enviando información...</div>');
			},
			success:function(msj){

				$("#DivAlertas").empty();
				$("#DivRadicadosInfo").html(msj);
			
				$.ajax({
					url: 'acciones.ajax.php',
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
		*/
	});

	$('#BtnBuscarRadicadosInternos').click(function(e){
		$("#TxtBusRadicadosInternosParaRespuesta").focus();
	});
	
	//FUNCION PARA BUSCAR RADICADOS PARA DAR RESPUESTA
	$("#TxtBusRadicadosInternosParaRespuesta").keyup(function(e){
		if(e.which == 13){
			if($("#TxtBusRadicadosInternosParaRespuesta").val() === ""){
				$("#DivAlertasRadicadosInternosParaRespuesta").load("../../../config/funciones.php",{
					alerta:3,
					mensaje:'Te hizo falta ingresar el criterio de busqueda'},function(){});
				$("#TxtBusRadicadosInternosParaRespuesta").focus();
			}else{
				$.ajax({
					url: 'listar_radicados_internos_para_respuesta.php',
					type: 'POST',
					data: 'criterio='+$("#TxtBusRadicadosInternosParaRespuesta").val(),
					beforeSend: function(){
						$("#DivAlertasRadicadosInternosParaRespuesta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
					},
					success:function(msj){
						$("#DivAlertasRadicadosInternosParaRespuesta").empty();
						if(msj != 1){
							$("#DivRadicadosInternosParaRespuesta").html(msj);
						}else{
							$("#DivRadicadosInternosParaRespuesta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> '+msj+'.</div>');
						}
					},
					error:function(msj){
						$("#DivAlertasRadicadosInternosParaRespuesta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
					}
				});
			}
		}
	});
});