$(document).ready(function() {
	$('#BtnRadicar').click(function(event){
		event.preventDefault();

		if ($('#num_anexos').val() != ""  && $('#observa_anexo').val() === '') {
			sweetAlert("Oops...", "Te hizo falta la observación de los anexos!", "warning");
			$('#observa_anexo').focus();
		}else if ($('#asunto').val() == ""){
			sweetAlert("Oops...", "Te hizo falta el asunto de la correspondencia!", "warning");
			$('#asunto').focus();
		}else if ($('#id_forma_enviados').val() == 0){
			sweetAlert("Oops...", "Te hizo falta la tipo de envio de la correspondencia!", "warning");
			$('#id_forma_enviados').focus();
		}else{
			$.ajax({
				url: 'acciones.ajax.php',
				type: 'POST',
				// Form data
				//datos del formulario
				data: 'accion=GUARDAR_RADICADO&id_temp='+$('#id_temp').val()+'&id_forma_enviados='+$('#id_forma_enviados').val()+'&asunto='+$('#asunto').val()+'&num_anexos='+$('#num_anexos').val()+'&observa_anexo='+$('#observa_anexo').val()+'&num_guia='+$('#num_guia').val(),
				beforeSend: function(){
					$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Por favor espera!!!...</a><br><img src="../../../../public/assets/img/loading.gif" width="30" height="30" /> Enviando información...</div>');
				},
				success:function(msj){
					if ( msj == 1 ){
						$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="icon fa fa-check"></i> Muy bien!!!...</a> El registro se almaceno correctamente. </div>');
						setTimeout(function () {
							window.location.href = "../recibidas/index.php";
						}, (200));
					}else{
						sweetAlert("Oops...", msj, "warning");
					}
				},
				error:function(){
					sweetAlert("Oops...", "Ha ocurrido un error durante la ejecución", "error");
				}
			});
		}
		return false;
	});

});