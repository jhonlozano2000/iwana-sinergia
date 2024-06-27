$(document).ready(function() {
	
	$('#nom_tipodoc').focus();

	$('#BtnGuardar').click(function() {
		
		if ($('#nom_tipodoc').val() == ""){
			$("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el nombre del Tipo de Documento.</div>')
			$('#nom_tipodoc').focus();
		}else{

			var acti = $("#acti").prop("checked") ? true : false;

			$.ajax({
				url: 'acciones.ajax.php',
				type: 'POST',
				// Form data
				//datos del formulario
				data: 'accion=INSERTAR&nom_tipodoc='+$('#nom_tipodoc').val()+'&observa='+$('#observa').val()+'&acti='+acti,
				beforeSend: function(){
					$("#DivAlerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
				},
				success:function(msj){
					if ( msj == 1 ){
						$("#DivAlerta").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El registro se actualizo correctamente. </div>');
						$('#nom_tipodoc').val("");
						$('#nom_tipodoc').focus();
						$('#observa').val("");
						$('#acti').prop("checked", true);
					}else{
						$("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> '+msj+'.</div>')
						$('#nom_tipodoc').focus();
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
			closeOnConfirm: true,
			showLoaderOnConfirm: true,
		},

		function(){
			if ($('#nom_tipodoc').val() == ""){
				$("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el nombre del Tipo de Documento.</div>')
				$('#nom_tipodoc').focus();
			}else{

				var acti = $("#acti").prop("checked") ? true : false;

				$.ajax({
					url: 'acciones.ajax.php',
					type: 'POST',
					// Form data
					//datos del formulario
					data: 'accion=EDITAR&id_tipodoc='+$('#id_tipodoc').val()+'&nom_tipodoc='+$('#nom_tipodoc').val()+'&observa='+$('#observa').val()+'&acti='+acti,
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
					error:function(){
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
				data: 'accion=ELIMINAR&id_tipodoc='+Id,
				success:function(msj){
					if (msj == 1){
						$("#TBLDatos"+Id).remove();   
						swal("¡Eliminado!",
							"El registro "+$(this).data("nom")+" se elimino correctamente!.",
							"success");
					}else{
						//$('#DivAlertas').html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> '+msj+'.</div>');
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