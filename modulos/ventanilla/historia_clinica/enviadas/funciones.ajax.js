$(document).ready(function(){
	//FUNCION PARA IMPRIMIR ROTULO
	$('.ImprimirFormato').click(function(e){
		
		$("#ifrImprimirRotulo").attr("src","../../../reportes/ventanilla/formato_historia_clinica/formato_hc_enviado.php?id_radica_enviado="+$(this).data('id_radica_enviado')+"&id_radica_recibido="+$(this).data('id_radica_recibido'));
		
		$.ajax({
			url: 'acciones.ajax.php',
			type: 'POST',
			data: 'accion=IMPRIMIR_ROTULO&id_radica='+$(this).data('id_radica_enviado'),
			success:function(data){
			
				if(data == 1){
					
					$('i[id=BtnImprimirFormato'+$(this).data('id_radica_enviado')+']').removeClass('text-warning');
					$('i[id=BtnImprimirFormato'+$(this).data('id_radica_enviado')+']').addClass('text-success');
				}else{
					sweetAlert("Oops...", data, "warning");
				}
			},
			error:function(data){
				sweetAlert("Oops...", data, "warning");
			}
		});
	});

	//FUNCIONES PARA ESTABLCER EL ID DEL RADICADO PARA AGREGAR
	//EL ARCHIVO DIGITAL E IMPRIMIR EL ROTULO
	$(document).on('click', '.idradicado', function (event) {
		$('#IdRadicado').val($(this).data('id_radica_enviado'));
		$('#IdDependencia').val($(this).data('id_dependencia'));
	});

	$(document).on('click', '.ImprimirRotulo', function (event) {
		$('#IdRadicado').val($(this).data('id_radica_enviado'));
		$('#IdDependencia').val($(this).data('id_dependencia'));
	});

	//FUNCION PARA CARGAR EL ARCHIVO DIGITAL
	$("#AdjuntoDigital").change(function(){
		//obtenemos un array con los datos del archivo
		var file = $("#AdjuntoDigital")[0].files[0];
        //obtenemos el nombre del archivo
        var fileName = file.name;
        //obtenemos la extensión del archivo
        fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
        //obtenemos el tamaño del archivo
        var fileSize = file.size;
        //obtenemos el tipo de archivo image/png ejemplo
        var fileType = file.type;
        
		//información del formulario
		var formData = new FormData($(".formulario")[0]);
		$.ajax({
			url: '../../../varios/subir_archivo.php',  
			type: 'POST',
            // Form data
            //datos del formulario
            data: formData,
            //necesario para subir archivos via ajax
            cache: false,
            contentType: false,
            processData: false,
            //mientras enviamos el archivo
            beforeSend: function(){
            	$("#DivAlertarAdjuntoDigital").html('<div class="alert alert-info"><img src="../../../../public/assets/img/loading.gif" width="18" height="18"></div>');
            },
            success: function(data){
            	if(data == 1){
            		$("#DivAlertarAdjuntoDigital").html('<div class="alert alert-success"><i class="icon fa fa-check"></i></div>');
            		$('#ifrVisualizaArchivo').attr({src:'../../../../archivos/temp/enviados/'+$('#IdRadicado').val()+'.pdf'});
            	}else{
            		$("#DivAlertarAdjuntoDigital").html('<div class="alert alert-danger"><i class="icon fa fa-check"></i>'+data+'</div>');
            	}
            },
            error: function(){
            	message = $("<span class='error'>Ha ocurrido un error.</span>");
            	alert(message);
            }
        });
	});

	$('#BtnSubirDigital').click(function() {
		//ESTABLEZCO EL NUMERO DE PAGINAS DEL ARCHIVO DIGITALIZADO

		$.ajax({
			url: '../../../varios/ftp.acciones.php',
			type: 'POST',
			data: 'accion=ENVIADOS_UPLOAD&id_radica='+$('#IdRadicado').val()+'&id_depen='+$('#IdDependencia').val(),
			beforeSend: function(){
				$("#DivAlertarAdjuntoDigital").html('<div class="alert alert-info"><img src="../../../../public/assets/img/loading.gif" width="18" height="18"></div>');
			},
			success:function(msj){
		
				var Elementos = msj.split('-');

				if (Elementos[0] == 1){
					$('i[id=BtnAdjunarDigital'+$('#IdRadicado').val()+']').removeClass('text-warning');
					$('i[id=BtnAdjunarDigital'+$('#IdRadicado').val()+']').removeClass('fa-warning');
					$('i[id=BtnAdjunarDigital'+$('#IdRadicado').val()+']').addClass('fa-file-o');
					$('i[id=BtnAdjunarDigital'+$('#IdRadicado').val()+']').addClass('text-primary');
					
					//SI EL ARCHIVO DIGITAL SE SUBIO AL SERVIDOR MARCO QUE SE AGREGO EL DIGITAL AL RADICADO
					$.ajax({
						url: 'acciones.ajax.php',
						type: 'POST',
						data: 'accion=RADICADO_CARGAR_DIGITAL&id_radica='+$('#IdRadicado').val()+'&num_folio='+Elementos[1]+'&id_ruta='+Elementos[2],
						success:function(data){
							$('#BtnCancelarSubirDigital').click();
							$("#DivAlertarAdjuntoDigital").empty();
							$('#ifrVisualizaArchivo').attr('src', '')
						},
						error:function(){
							sweetAlert("Oops...", data, "warning");
						}
					});
					//FIN DE MARCAR EL RADICADO
				}else{
					sweetAlert("Oops...", msj, "error");
				}
			},
			warning:function(){
				sweetAlert("Oops...", msj, "error");
			}
		});		
	});

	//FUNCION PARA CARGAR LA INFORMACION DEL RADICADO
	$(".table-hover").find('tr[data-id]').on('click', function () {
		$.ajax({
        	url: '../../varios/mostrar_radicado_hc_enviado.php',
        	type: 'POST',
        	data: 'id_radica='+$(this).data('id'),
        	beforeSend: function(){
        		$("#alerta").html('<div class="alert alert-info"><img src="../../../../public/assets/img/loading.gif" width="18" height="18"> Enviando información</div>');
        	},
        	success:function(msj){
        		$("#DivRadicadosInfo").html(msj);
        	},
        	error:function(msj){
        		$("#alerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
        	}
        });
    });

    $(document).on('click', '#BtnDescargar', function (event) {
		if($("#id_ruta").val() == 0){
			sweetAlert("Oops...", "El radicado no tiene el documento digital, por favor adjunte el documento digitalizado!", "warning");
		}else{
			$.ajax({
				url: '../../../varios/ftp.acciones.php',
				type: 'POST',
				data: 'accion=ENVIADOS_DESCARGAR&id_radica='+$("#id_radica").val()+'&id_ruta='+$("#id_ruta").val(),
				beforeSend: function(){
					$("#DivAlertas").html('<div class="alert alert-info"><img src="../../../../public/assets/img/loading.gif" width="18" height="18"> Enviando información</div>');
				},
				success:function(msj){
					
					$("#DivAlertas").empty();

					if(msj == 1){
						url = "../../../../archivos/temp/enviados/"+$("#id_radica").val()+".pdf";
						window.open(url, 'Download');
					}else{
						sweetAlert("Oops...", msj, "error");
					}
				},
				error:function(msj){
					$("#DivAlertas").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
				}
			});
		}
	});

});