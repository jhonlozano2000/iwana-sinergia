$(document).ready(function(){

	$('#BtnGenerarBackup').click(function(e){
		e.preventDefault();

		var formData                        = new FormData($("#FrmDatos")[0]);
		var ChkGestion                      = new Array();
		var RepositorioTemp                 = false;
		var RepositorioTempEnviado          = false;
		var RepositorioGestion              = false;
		var RepositorioGestionEnviado       = false;
		var RepositorioDigitalizados        = false;
		var RepositorioDigitalizadosEnviado = false;

		$("input[name='ChkGestion[]']:checked").each(function(){
			ChkGestion.push($(this).val());
		});

		if($('#ChkTemp').prop('checked')){
			setTimeout(function(){
				$.ajax({
					url: 'backups_temp.ajax.php',
					type: "POST",
					data: formData,
					contentType: false,
					processData: false,
					beforeSend: function(){
						$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Generando backup’s del repositorio de archivo de la correspondencia recibida, por favor espere. </div>');
					},
					success:function(msj){
						if(msj == 1){
							$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El backup’s de la correspondencia recibida se genero correctamente.</div>');
							RepositorioTemp = true;
						}else{
							$("#DivAlertas").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> '+msj+'.</div>');
						}
					},
					error:function(msj){
						$("#DivAlertas").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
					}
				});
			},3000);
			RepositorioTempEnviado = true;
		}else{
			RepositorioTempEnviado = true;
		}

		if(ChkGestion != ""){
			setTimeout(function(){
				$.ajax({
					url: 'backups_gestion.ajax.php',
					type: "POST",
					data: formData,
					contentType: false,
					processData: false,
					beforeSend: function(){
						$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Generando backup’s del repositorio de archivo de la correspondencia enviada, por favor espere. </div>');
					},
					success:function(msj){
						if(msj == 1){
							$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El backup’s de la correspondencia enviada se genero correctamente.</div>');
							RepositorioGestion = true;
						}else{
							$("#DivAlertas").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> '+msj+'.</div>');
						}
					},
					error:function(msj){
						$("#DivAlertas").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
					}
				});
			}, 3000);
			RepositorioGestionEnviado = true;
		}else{
			RepositorioGestionEnviado = true;
		}

		setTimeout(function(){
			$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El proceso de Backup’s se generó correctamente.</div>');
		}, 1000);

		if(!confirm("Desea enviar el E-Mail")) { 
			$.ajax({
			url: '../../../../codigos/tutoriales-php-master/06EnvioCorreo/enviar-mail_final.php',
			type: "POST",
			data: 'FechaDesde='+$('#desde').val()+'&RepositorioTemp='+RepositorioTemp+'&RepositorioGestion='+RepositorioGestion+'&RepositorioDigitalizados='+RepositorioDigitalizados,
			beforeSend: function(){
				$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando E - Mail, por favor espere. </div>');
			},
			success:function(msj){
				if(msj == 1){
					$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El backup’s de la correspondencia enviada se genero correctamente.</div>');
					RepositorioGestion = true;
				}else{
					$("#DivAlertas").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> '+msj+'.</div>');
					return false;
				}
			},
			error:function(msj){
				$("#DivAlertas").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
			}
		});
		}	
	});
});