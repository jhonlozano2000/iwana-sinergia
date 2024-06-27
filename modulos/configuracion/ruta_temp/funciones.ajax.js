$(document).ready(function(){

	$('#tipo_correspon').focus();

	$('#BtnGuardar').click(function() {
		if ($('#ip').val() == ""){
			$("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el Servidor.</div>');
			$('#ip').focus();
		}else if ($('#usua').val() == ""){
			$("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el usuario.</div>');
			$('#usua').focus();
		}else if ($('#contra').val() == ""){
			$("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta la contraseña.</div>');
			$('#contra').focus();
		}else if ($('#ruta').val() == ""){
			$("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta la ruta donde se almaceneral los archivos.</div>');
			$('#ruta').focus();
		}else{

			var acti = $("#acti").prop("checked") ? 1 : 0;

			$.ajax({
				url: 'acciones.ajax.php',
				type: 'POST',
				data: 'accion=INSERTAR&tipo_correspon='+$('#tipo_correspon').val()+'&ip='+$('#ip').val()+'&ruta='+$('#ruta').val()+'&usua='+$('#usua').val()+'&contra='+$('#contra').val()+'&acti='+acti,
				beforeSend: function(){
					$("#DivAlerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
				},
				success:function(msj){
					if ( msj == 1 ){
						$("#DivAlerta").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El registro se actualizo correctamente. </div>');
						$('#ip').val("");
						$('#ruta').focus();
						$('#usua').val("");
						$('#contra').val("");
						$('#observa').val("");
						$('#acti').prop("checked", true);
					}else{
						$("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> '+msj+'.</div>')
					}
				},
				error:function(){
					$("#DivAlerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
				}
			});
		}
		return false;
	});

	$('#BtnRegresar').click(function(){
		setTimeout(function(){
			window.location.href = "index.php";
		});
	});


	$('#BtnEditar').click(function(){
		swal({ 
			title: "¿Desea editar el registro con Servidor: "+$('#ip').val()+" y Ruta: "+$('#ruta').val()+"?",
			type: "info",
			showCancelButton: true,
			closeOnConfirm: false,
			showLoaderOnConfirm: false,
		},

		function(){
			if ($('#ip').val() == ""){
				$("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el Servidor.</div>');
				$('#ip').focus();
			}else if ($('#usua').val() == ""){
				$("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el usuario.</div>');
				$('#usua').focus();
			}else if ($('#contra').val() == ""){
				$("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta la contraseña.</div>');
				$('#contra').focus();
			}else if($('#ruta').val() == ""){
				$("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta la ruta donde se almaceneral los archivos.</div>');
				$('#ruta').focus();
			}else{

				var acti = $("#acti").prop("checked") ? 1 : 0;

				$.ajax({
					url: 'acciones.ajax.php',
					type: 'POST',
					data: 'accion=EDITAR&tipo_correspon='+$('#tipo_correspon').val()+'&id_ruta='+$('#id_ruta').val()+'&ip='+$('#ip').val()+'&ruta='+$('#ruta').val()+'&usua='+$('#usua').val()+'&contra='+$('#contra').val()+'&acti='+acti,
					beforeSend: function(){
						$("#DivAlerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
					},
					success:function(msj){
						if ( msj == 1 ){
							$("#DivAlerta").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El registro se actualizo correctamente. </div>');
							setTimeout(function(){
								window.location.href = "index.php";
							}, 100);
						}else{
							$("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> '+msj+'.</div>')
						}
					},
					error:function(msj){
						$("#DivAlerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
					}
				});
			}
		});
	});


	$(document).on('click', '#BtnEliminar', function (event){
		var Id = $(this).data("id")
		swal({ 
			title: "¿Desea eliminar el registro con el nombre "+ $(this).data("nom")+"?",
			type: "error",
			showCancelButton: true,
			cancelButtonText: "No",
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "¡si, eliminar!",
			closeOnConfirm: false 
		},

		function(){
			$.ajax({
				url: 'acciones.ajax.php',
				type: 'POST',
				data: 'accion=ELIMINAR&id_ruta='+Id,
				success:function(msj){
					if (msj == 1){
						$("#TrDatos" + Id).remove();   
						swal("¡Eliminado!",
							"El registro "+$(this).data("nom")+" se elimino correctamente!.",
							"success");
					}else{
						swal("Error", msj, "error");
					}
				},
				error:function(msj){
					$("#DivAlertas").html('<div class="alert alert-danger alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Ha ocurrido un error durante la ejecución, '+msj+'.</div>');
				}
			});
		});
	});

	$(document).on('click', '.acti', function(event){
		
		var Id = $(this).data("id");
		var Acti = 0;
		if($(this).is(':checked')){
			Acti = 1;
		}

		$.ajax({
			url: 'acciones.ajax.php',
			type: 'POST',
			data: 'accion=ACTIVAR&id_ruta='+Id+'&acti='+Acti,
			beforeSend: function(){
				$("#DivAlerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
			},
			success:function(msj){
				if (msj == 1){
					$("#DivAlerta").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El registro se actualizo correctamente. </div>');
				}else{
					$("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> '+msj+'.</div>');
				}
			},
			error:function(msj){
				$("#DivAlerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
			}
		});
	});
});