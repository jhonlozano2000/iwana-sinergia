$(document).ready(function() {
	
	$(document).on('click', '#BtnTerminarSolicitud', function(event){
		$.ajax({
			url: 'acciones.ajax.php',
			type: 'POST',
			data: 'accion=TERMINAR_TRAMITE&id_radica='+$('#id_radica').val()+'&id_serie='+$('#id_serie').val()+'&id_subserie='+$('#id_subserie').val()+'&id_tipodoc='+$('#id_tipodoc').val()+'&id_destina='+$('#id_tercero').val()+'&asunto='+$('#observaciones').val(),
			beforeSend: function(){
				$("#DivAlertasHerminarSolicitud").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Por favor espera!!!...</a><br><img src="../../../../../public/assets/img/loading.gif" width="50" height="50" />Enviando información...</div>');
			},
			success: function(msj){
				if(msj == 1){
					$("#DivAlertasHerminarSolicitud").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="icon fa fa-check"></i> Muy bien!!!...</a> El registro se almaceno correctamente. </div>');
					$('#BtnCancelarSolicitud').click();
					load(1);
				}else{
					$("#DivAlertasHerminarSolicitud").html('<div class="alert"><button class="close" data-dismiss="alert"></button> Upsss!!!...</h4><br>'+msj+'.</div>');
				}
			},
			error: function(msj){
				$("#DivAlertas").html('<div class="alert alert-danger alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Ha ocurrido un error durante la ejecución, '+msj+'.</div>');
			}
		});
	});

	$(document).on('click', '#TRRadicado', function(event){
		
		var IdRadicado = $(this).data('id_radicado');
		
		$.ajax({
			url: '../../../../ventanilla/varios/mostrar_radicado_hc_recibido.php',
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

	$(document).on('click', '#BtnAceptar', function(event){
		$("#DivAlertasHerminarSolicitud").empty();
		$("#DivTituloTramite").addClass("text-danger");
		$("#IconoTitulo").removeClass("fa-thumbs-down");
		$("#IconoTitulo").removeClass("text-danger");

		$("#DivTituloTramite").html($(this).data('paciente'));
		$("#DivTituloTramite").addClass("text-success");
		$("#observaciones").val($(this).data('asunto'));
		$("#IconoTitulo").addClass("fa-thumbs-up text-success");
		$("#id_radica").val($(this).data('id_radicado'));
		$("#id_serie").val($(this).data('id_serie'));
		$("#id_subserie").val($(this).data('id_subserie'));
		$("#id_tipodoc").val($(this).data('id_tipodoc'));
		$("#id_tercero").val($(this).data('id_tercero'));
	});

	$(document).on('click', '#BtnRechazar', function (event) {
		$("#DivAlertasHerminarSolicitud").empty();
		$("#DivTituloTramite").removeClass("text-success");
		$("#IconoTitulo").removeClass("fa-thumbs-up");
		$("#IconoTitulo").removeClass("text-success");

		$("#DivTituloTramite").html($(this).data('paciente'));
		$("#DivTituloTramite").addClass("text-danger");
		$("#observaciones").val($(this).data('asunto'));
		$("#IconoTitulo").addClass("fa-thumbs-down text-danger");

		$("#id_radica").val($(this).data('id_radicado'));
		$("#id_serie").val($(this).data('id_serie'));
		$("#id_subserie").val($(this).data('id_subserie'));
		$("#id_tipodoc").val($(this).data('id_tipodoc'));
		$("#id_tercero").val($(this).data('id_tercero'));
	});

	$(document).on('click', '#BtnDescargarPdfRecibido', function (event){
		
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
});

function load(page){
	var parametros = {"action":"ajax","page":page};
	$(".outer_div").fadeIn('slow');
	$.ajax({
		url:'listar.php',
		data: parametros,
		beforeSend: function(objeto){
			$("#loader").html("<img src='../../../../../public/assets/img/loading.gif'>");
		},
		success:function(data){
			$(".outer_div").html(data).fadeIn('slow');
			$("#loader").html("");
		}
	})
}