$(document).ready(function(){
	
	$('.user-details-wrapper').click(function() {

		$('#id_usua_recive').val($(this).data('id_usua_recive'));
		
		$.ajax({
			url: $(this).data('ruta_root')+"listar_chat.php",
			type: "POST",
			data: 'id_usua_recive='+$(this).data('id_usua_recive'),
			beforeSend: function(){
				//$("#DivAlerta").load("../../../config/mensajes.php",{alerta:5,mensaje:'Enviando información...',Imagen:'../../../public/assets/img/loading.gif'},function(){});
			},
			success:function(msj){
				$('#DivMostrearChar').html(msj);
			},
			error:function(){
				//$("#DivAlerta").load("../config/mensajes.php",{alerta:1,mensaje:'Ha ocurrido un error durante la ejecución'},function(){});
			}
		});
	});

	$(document).on('keyup', '#chat-message-input', function(event){

		if(event.which == 13 && $("#chat-message-input").val() != "") {
			
			$.ajax({
				url: $(this).data('ruta_root')+"acciones_chat.ajax.php",
				type: 'POST',
				data: 'accion=INSERTAR_MENSAJE&mensaje='+$("#chat-message-input").val()+'&id_usua_recive='+$('#id_usua_recive').val(),
				beforeSend: function(){
					
				},
				success:function(msj){
					if(msj == 1){
						//$('.user-details-wrapper').click();
					}
				},
				error:function(msj){
				}
			});
		}
	});
});