$(document).ready(function() {
	$('#cod_serie').focus();

	$('#BtnGuardar').click(function() {
		/*
		if ($('#cod_serie').val() == ""){
			$("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el Código de la Serie.</div>')
			$('#cod_serie').focus();
		}else 
		*/
		if ($('#nom_serie').val() == ""){
			$("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el nombre de la Serie.</div>')
			$('#nom_serie').focus();
		}else{

			var acti = $("#acti").prop("checked") ? 1 : 0;

			$.ajax({
				url: 'acciones.ajax.php',
				type: 'POST',
				data: 'accion=Insertar&cod_serie='+$('#cod_serie').val()+'&nom_serie='+$('#nom_serie').val()+'&observa='+$('#observa').val()+'&acti='+acti,
				beforeSend: function(){
					$("#DivAlerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
				},
				success:function(msj){
					if ( msj == 1 ){
						$("#DivAlerta").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El registro se actualizo correctamente. </div>');
						$('#cod_serie').val("");
						$('#nom_serie').focus();
						$('#observa').val("");
						$('#acti').prop("checked", true);
					}else{
						$("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> '+msj+'.</div>')
					}
				},
				error:function(msj){
					$("#DivAlerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
				}
			});
		}
		return false;
	});
	
	$('#BtnRegresar').click(function(){
		window.location.href = "index.php";
	});
	
	/**=============================================================================
	*
	*	función para editar
	*
	*===========================================================================**/
	$('#BtnEditar').click(function(){
		swal({ 
			title: "¿Desea editar el registro con el nombre "+ $('#nom_serie').val()+"?",
			type: "info",
			showCancelButton: true,
			closeOnConfirm: false,
			showLoaderOnConfirm: true,
		},

		function(){
			if ($('#cod_serie').val() == ""){
				$("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el Código de la Serie.</div>')
				$('#cod_serie').focus();
			}else if ($('#nom_serie').val() == ""){
				$("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el nombre de la Serie.</div>')
				$('#nom_serie').focus();
			}else{

				var acti = $("#acti").prop("checked") ? 1 : 0;

				$.ajax({
					url: 'acciones.ajax.php',
					type: 'POST',
					data: 'accion=EDITAR&id_serie='+$('#id_serie').val()+'&cod_serie='+$('#cod_serie').val()+'&nom_serie='+$('#nom_serie').val()+'&observa='+$('#observa').val()+'&acti='+acti,
					beforeSend: function(){
						$("#DivAlerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
					},
					success:function(msj){
						if ( msj == 1 ){
							$("#DivAlerta").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El registro se actualizo correctamente. </div>');
							setTimeout(function(){
								window.location.href = "index.php";
							}, 300);
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

	/**=============================================================================
	*
	*	función para eliminar
	*
	*===========================================================================**/
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
				data: 'accion=ELIMINAR&id_serie='+Id,
				success:function(msj){
					if (msj == 1){
						$("#TRD" + Id).remove();   
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
			data: 'accion=ACTIVAR&id_serie='+Id+'&acti='+Acti,
			beforeSend: function(){
				$("#DivAlerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
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