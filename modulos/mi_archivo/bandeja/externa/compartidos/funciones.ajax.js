$(document).ready(function() {
	
	$(document).on('click', '#btnAutorizar', function (event){
		var IdRadicado = $(this).data("id");
		swal({ 
			title: "¿Desea desbloquear el radicado "+IdRadicado+"?",
			text: "Si lo desbloquea el responsable ver el documento.",
			type: "success",
			showCancelButton: true,
			cancelButtonText: "No",
			confirmButtonColor: "#468847",
			confirmButtonText: "¡si, desbloquear!",
			closeOnConfirm: false },

			function(){ 
				$.ajax({
					url: 'acciones.ajax.php',
					type: 'POST',
					data: 'accion=Desbloquear&id_radica='+IdRadicado,
					success:function(msj){
						if (msj == 1){
							swal("¡Desbloqueado!",
								"La correspondencia ha sido desbloqueada!.",
								"success");
							$('i[id=BtnCandado'+IdRadicado+']').removeClass('fa-lock');
						}else{
							$('#DivAlertas').html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> '+msj+'.</div>');
						}
					},
					error:function(msj){
						$("#DivAlertas").html('<div class="alert alert-danger alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Ha ocurrido un error durante la ejecución, '+msj+'.</div>');
					}
				});
			});
	});
	
	$(document).on('click', '#TipoVer', function (event){
		$('#tipo_ver').val($(this).data('tipo_ver'));
		load(1)
	});
	
	//FUNCION PARA CARGAR LA INFORMACION DEL RADICADO
	$(document).on('click', '#BtnMostarInfoRadicadoRecibido', function(event){
		var IdRadicado = $(this).data('id_radicado');

		$('#DivRadicadoRecibido').html(IdRadicado)

		$.ajax({
			url: '../../../../ventanilla/varios/tab_radicado_recibido_info.php',
			type: 'POST',
			data: 'id_radica='+IdRadicado,
			beforeSend: function(){
				$("#alerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
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
			url: '../../../../ventanilla/varios/tab_radicado_recibido_clasificacion.php',
			type: 'POST',
			data: 'id_radica='+IdRadicado,
			beforeSend: function(){
				$("#alerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
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
			url: '../../../../ventanilla/varios/tab_radicado_recibido_documentos.php',
			type: 'POST',
			data: 'id_radica='+IdRadicado,
			beforeSend: function(){
				$("#alerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
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
			url: '../../../../ventanilla/varios/tab_radicado_recibido_otra_info.php',
			type: 'POST',
			data: 'id_radica='+IdRadicado,
			beforeSend: function(){
				$("#alerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
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

	$(document).on('click', '#BtnResponderCorrespondencia', function (event){
		
		var IdRadicado = $(this).data('id_radicado');

		window.location="../responder/index.php?id_radica="+IdRadicado;
	});
	
	$(document).on('click', '#BtnCompartirRadicado', function (event){
		$('#DivRadicadoParaCompartir').html($(this).data('id_radicado'))
	});

	//FUNCION PARA LLEVAR LOS FUNCIONARIOS PARA COMPARTIR
	$(document).on('click', '#BtnPasarParaCompartir', function (event){
		
		var IdFuncioDeta = $(this).data('id_funcio');
		var NomFuncio = $(this).data('nom_funcio');
		var DepenFuncio = $(this).data('depen_funcio');
		
		if(!$('#TrFuncioDestino'+$(this).val()).length){
			$('#TblFuncioDestino tr:last').after('<tr id="TrFuncioDestino'+IdFuncioDeta+'"><td><input type="hidden" class="funionarios_destino" name="FuncionariosDestino" id="FuncionariosDestino'+IdFuncioDeta+'" value="'+IdFuncioDeta+'" data-id_funcio_destino="'+IdFuncioDeta+'" data-nom_funcio_destino="'+NomFuncio+'" data-depen_funcio_destino="'+DepenFuncio+'">'+NomFuncio+'</td><td>'+DepenFuncio+'</td><td><button class="borrar_funcionario_destino btn btn-danger btn-sm btn-small" data-id="'+IdFuncioDeta+'" ><i class="fa fa-trash-o"></i></button></td></tr>');
		}
	});

	$(document).on('click', '#BtnDescargarPdfRecibido', function(event){
		if($("#id_ruta").val() == 0){
			sweetAlert("Oops...", "El radicado no tiene el documento digital, por favor adjunte el documento digitalizado!", "warning");
		}else{
			$.ajax({
				url: '../../../../varios/ftp.acciones.php',
				type: 'POST',
				data: 'accion=RECIBIDOS_DESCARGAR&id_radicado='+$("#id_radica").val()+'&id_ruta='+$("#id_ruta").val()+'&RutaDonwload='+$("#RutaDonwload").val(),
				beforeSend: function(){
					$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
				},
				success:function(msj){
					$("#DivAlertas").empty();
					if(msj == 1){
						window.open("../../../../../archivos/temp/recibidos/"+$("#id_radica").val()+".pdf", '_blank');
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

	$(document).on('click', '#BtnDescargarArchivoRecibido', function(event){

		var IdRadicado = $(this).data("id_radicado");
		var Archivo = $(this).data("archivo");
		var IdRuta = $(this).data("id_ruta");

		if(IdRuta == 0){
			sweetAlert("Oops...", "El radicado no tiene el documento digital, por favor adjunte el documento digitalizado!", "warning");
		}else{
			$.ajax({
				url: '../../../../varios/ftp.acciones.php',
				type: 'POST',
				data: 'accion=RECIBIDOS_DESCARGAR&id_radicado='+IdRadicado+'&id_ruta='+IdRuta,
				beforeSend: function(){
					$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
				},
				success:function(msj){
					$("#DivAlertas").empty();
					if(msj == 1){
						window.open("../../../../../archivos/temp/recibidos/"+Archivo, '_blank');
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
});