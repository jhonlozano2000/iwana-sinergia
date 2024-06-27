$(document).ready(function() {
	$('#cod_subserie').focus();

	$('#BtnGuardar').click(function() {

		var TiposDocumentos = new Array();

		$("input[name='ChkTipoDoc[]']:checked").each(function() {
			TiposDocumentos.push($(this).val());
		});
		/*
		if ($('#cod_subserie').val() == 0){
			$("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el cóodigo de la Subserie.</div>')
			$('#cod_subserie').focus();
		}else 
		*/
		if ($('#nom_subserie').val() == 0){
			$("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el nombre de la Subserie.</div>')
			$('#nom_subserie').focus();
		}else if(TiposDocumentos == ""){
			$("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta los tipos documentales.</div>')
			$('#nom_subserie').focus();
		}else{
			
			var acti = $("#acti").prop("checked") ? 1 : 0;

			$.ajax({
				url: 'acciones.ajax.php',
				type: 'POST',
				data: 'accion=INSERTAR&cod_subserie='+$('#cod_subserie').val()+'&nom_subserie='+$('#nom_subserie').val()+'&acti='+acti+'&TiposDocumentos='+TiposDocumentos,
				beforeSend: function(){
					$("#DivAlerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
				},
				success:function(msj){
					if ( msj == 1 ){
						$("#DivAlerta").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El registro se actualizo correctamente. </div>');
						$('#cod_subserie').val("");
						$('#cod_subserie').focus();
						$('#nom_subserie').val("");
						$('#observa').val("");
						$('#acti').prop("checked", true);
						$('#Tbl1 tbody tr').not(':first').remove();
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
		setTimeout(function(){
			window.location.href = "index.php";
		});
	});
	
	/**=============================================================================
	*
	*	función para editar
	*
	*===========================================================================**/
	$('#BtnEditar').click(function(){
		swal({ 
			title: "¿Desea editar el registro con el nombre "+ $('#nom_subserie').val()+"?",
			type: "info",
			showCancelButton: true,
			closeOnConfirm: false,
			showLoaderOnConfirm: false,
		},

		function(){
			if ($('#cod_subserie').val() == 0){
				$("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el cóodigo de la Subserie.</div>')
				$('#cod_subserie').focus();
			}else if ($('#nom_subserie').val() == 0){
				$("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el nombre de la Subserie.</div>')
				$('#nom_subserie').focus();
			}else{

				var TiposDocumentos = new Array();

				$("input[name='ChkTipoDoc[]']:checked").each(function() {
					TiposDocumentos.push($(this).val());
				});
				
				var acti = $("#acti").prop("checked") ? 1 : 0;

				$.ajax({
					url: 'acciones.ajax.php',
					type: 'POST',
					data: 'accion=EDITAR&id_subserie='+$('#id_subserie').val()+'&cod_subserie='+$('#cod_subserie').val()+'&nom_subserie='+$('#nom_subserie').val()+'&acti='+acti+'&TiposDocumentos='+TiposDocumentos,
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
				data: 'accion=ELIMINAR&id_subserie='+Id,
				beforeSend: function(){
					$("#DivAlerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
				},
				success:function(msj){
					$("#DivAlerta").empty();
					if(msj == 1){
						$("#TrDatos" + Id).remove();   
						swal("¡Eliminado!",
							"El registro "+$(this).data("nom")+" se elimino correctamente!.",
							"success");
					}else{
						swal("Error", msj, "error");
					}
				},
				error:function(msj){
					$("#DivAlerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
				}
			});
		});
	});

	$(document).on('click', '.levar_tipo_documento', function (event) {
		event.preventDefault();
		var IdTipo = $(this).data('id_tipo_documento');
		$('#TiposDocumentales tr:last').after('<tr id="TrTipoDocumento'+$(this).val()+'"><td><div class="checkbox check-success"><input name="ChkTipoDoc[]" id="ChkTipoDoc'+$(this).data('id_tipo_documento')+'" type="checkbox" value="'+$(this).data('id_tipo_documento')+'" checked><label for="ChkTipoDoc'+$(this).data('id_tipo_documento')+'"></label></div></td><td>'+$(this).data('nom_tipo_documento')+'</td><td><button class="borrar_documento btn btn-danger btn-xs btn-mini" data-id="'+$(this).val()+'" ><i class="fa fa-trash-o"></i></button></td></tr>');
	});

	//FUNCION PARA BORRAR UN TIPO DOCUMENTAL
	$(document).on('click', '.borrar_documento', function (event) {
		event.preventDefault();
		$(this).closest('tr').remove();
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