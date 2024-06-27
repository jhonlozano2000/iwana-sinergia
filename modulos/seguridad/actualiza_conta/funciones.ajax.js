$(document).ready(function(){
	
	$('#BtnCambiaContra').click(function(){
		setTimeout(function(){
		
			if ($('#contra_actual').val() == ""){
				$("#alerta").load("../../../config/mensajes.php",{alerta:3,mensaje:'Te hizo falta la contraseña actual.'},function(){});
				$('#contra_actual').focus();
			}else if($('#nueva_contra').val() == ""){
				$("#alerta").load("../../../config/mensajes.php",{alerta:3,mensaje:'Te hizo falta la nueva contraseña.'},function(){});
				$('#nueva_contra').focus();
			}else if($('#confirma_contra').val() == ""){
				$("#alerta").load("../../../config/mensajes.php",{alerta:3,mensaje:'Te hizo falta la confirmar contraseña.'},function(){});
				$('#confirma_contra').focus();
			}else if($.trim($('#nueva_contra').val().trim()) != $.trim($('#confirma_contra').val())){
				$("#alerta").load("../../../config/mensajes.php",{alerta:3,mensaje:'La contraseña no coninside.'},function(){});
				$('#confirma_contra').focus();
			}else if($('#contra_actual').val() == $('#nueva_contra').val()){
				$("#alerta").load("../../../config/mensajes.php",{alerta:3,mensaje:'la nueva contraseña debe ser diferente a la contraseña actual.'},function(){});
				$('#confirma_contra').focus();
			}else{
				$.ajax({
					type: 'POST',
					url: 'acciones.ajax.php',
					data: 'accion=CAMBIO_CONTRA&contra='+$('#contra_actual').val()+'&nueva_contra='+$('#nueva_contra').val(), 
					beforeSend: function(){
						$("#alerta").load("../../../config/mensajes.php",{alerta:5,mensaje:'Enviando información, por favor espere...',Imagen:'../../public/assets/img/loading.gif'},function(){});
					},
					success:function(msj){
						if ( msj == 1 ){
							$("#alerta").load("../../../config/mensajes.php",{alerta:4,mensaje:'Espera un momento, estamos cargando tu entorno.'},function(){});
							setTimeout(function(){
								window.location.href = "../../../index.php";
							}, 500);
						}else{
							$("#alerta").load("../../../config/mensajes.php",{alerta:3,mensaje: msj },function(){});
						}
					},
					error:function(){
						$("#alerta").load("../../../config/mensajes.php",{alerta:1,mensaje:'Ha ocurrido un error durante la ejecución.'},function(){});
					}
				});
			}
		}, 300);
		return false;
	});

	$('#BtnCanelar').click(function(){
		setTimeout(function(){
			window.location.href = "../../../../index.php";
		});
	});
});