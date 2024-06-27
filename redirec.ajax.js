$(document).ready(function(){
	$('#BtnEntrar').click(function(){
		setTimeout(function(){			
			if ($('#login').val() == ""){
				$("#alerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el nombre de usuario.</div>');
				$('#login').focus();
			}else if($('#contra').val() == ""){
				$("#alerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta la contraseña.</div>');
				$('#contra').focus();
			}else{
				$.ajax({
					type: 'POST',
					url: 'redirect.php',
					data: 'accion=LOGGIN&login=' + $('#login').val()+'&contra='+$('#contra').val(), 
					beforeSend: function(){
						$("#alerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
					},
					success:function(msj){
						if(msj == 1){
							$("#alerta").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> Espera un momento, estamos cargando tu entorno.</div>');
							
							setTimeout(function(){
								window.location.href = "panel.php";
							}, 500);
						}else if(msj == 2){
							$("#alerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Espera un momento, te estamos redireccionando para que actualices tu contraseña. </div>');
							
							setTimeout(function(){
								window.location.href = "modulos/seguridad/actualiza_conta/index.php";
							}, 500);
						}else{
							$("#alerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> '+msj+'.</div>');
						}
					},
					error:function(msj){
						$("#alerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
					}
				});
			}
		}, 300);
		return false;
	});

	$('#BtnCanelar').click(function(){
		setTimeout(function(){
			window.location.href = "index.php";
		});
	});
});