$(document).ready(function(){
	$('#cod_funcio').focus();

	$('#BtnGuardarUsuario').click(function(){
		swal({ 
			title: "¿Desea actualizar tus datos",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#f0ad4e",
			confirmButtonText: "Si, Editar!",
			closeOnConfirm: false
		},

		function(){
			if ($('#cod_funcio').val() == ""){
				$("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el número de documento del funcionario.</div>');
				$('#cod_funcio').focus();
			}else if ($('#nom_funcio').val() == ""){
				$("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el nombre del funcionario.</div>');
				$('#nom_funcio').focus();
			}else if ($('#ape_funcio').val() == ""){
				$("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta los apellidos del funcionario.</div>');
				$('#ape_funcio').focus();
			}else if ($('#genero').val() == 0){
				$("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta la contraseña.</div>');
				$('#genero').focus();
			}else if ($('#id_depar').val() == 0){
				$("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta elegir el departamento de recidencia del funcionario.</div>');
				$('#id_depar').focus();
			}else if ($('#id_muni').val() == 0){
				$("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta elegir el municipio de recidencia del funcionario.</div>');
				$('#id_muni').focus();
			}else{
				$.ajax({
					url: 'acciones.ajax.php',
					type: 'POST',
					data: 'accion=EDITAR&id_funcio='+$('#id_funcio').val()+'&id_muni='+$('#id_muni').val()+'&id_depar='+$('#id_depar').val()+'&cod_funcio='+$('#cod_funcio').val()+'&nom_funcio='+$('#nom_funcio').val()+'&ape_funcio='+$('#ape_funcio').val()+'&genero='+$('#genero').val()+'&dir='+$('#dir').val()+'&tel='+$('#tel').val()+'&cel='+$('#cel').val()+'&email='+$('#email').val()+'&firma='+$('#firma').val(),
					beforeSend: function(){
						$("#DivAlerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
					},
					success:function(msj){
						if ( msj == 1 ){
							$("#DivAlerta").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El registro se actualizo correctamente. </div>');
						}else{
							$("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> '+msj+'.</div>');
						}
					},
					error:function(msj){
						$("#DivAlerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
					}
				});
			}
		});
	});

	$('#BtnCambiaContra').click(function(){
		setTimeout(function(){
		
			if ($('#contra_actual').val() == ""){
				$("#DivAlerta").load("../../../config/mensajes.php",{alerta:3,mensaje:'Te hizo falta la contraseña actual.'},function(){});
				$('#contra_actual').focus();
			}else if($('#nueva_contra').val() == ""){
				$("#DivAlerta").load("../../../config/mensajes.php",{alerta:3,mensaje:'Te hizo falta la nueva contraseña.'},function(){});
				$('#nueva_contra').focus();
			}else if($('#confirma_contra').val() == ""){
				$("#DivAlerta").load("../../../config/mensajes.php",{alerta:3,mensaje:'Te hizo falta la confirmar contraseña.'},function(){});
				$('#confirma_contra').focus();
			}else if($.trim($('#nueva_contra').val().trim()) != $.trim($('#confirma_contra').val())){
				$("#DivAlerta").load("../../../config/mensajes.php",{alerta:3,mensaje:'La contraseña no coninside.'},function(){});
				$('#confirma_contra').focus();
			}else if($('#contra_actual').val() == $('#nueva_contra').val()){
				$("#DivAlerta").load("../../../config/mensajes.php",{alerta:3,mensaje:'la nueva contraseña debe ser diferente a la contraseña actual.'},function(){});
				$('#confirma_contra').focus();
			}else{
				$.ajax({
					type: 'POST',
					url: 'acciones.ajax.php',
					data: 'accion=CAMBIO_CONTRA&contra='+$('#contra_actual').val()+'&nueva_contra='+$('#nueva_contra').val(), 
					beforeSend: function(){
						$("#DivAlerta").load("../../../config/mensajes.php",{alerta:5,mensaje:'Enviando información, por favor espere...',Imagen:'../../public/assets/img/loading.gif'},function(){});
					},
					success:function(msj){
						if( msj == 1 ){
							$("#DivAlerta").load("../../../config/mensajes.php",{alerta:4,mensaje:'Tu contraseña se actualizo correctamente.'},function(){});
						}else{
							$("#DivAlerta").load("../../../config/mensajes.php",{alerta:3,mensaje: msj },function(){});
						}
					},
					error:function(){
						$("#DivAlerta").load("../../../config/mensajes.php",{alerta:1,mensaje:'Ha ocurrido un error durante la ejecución.'},function(){});
					}
				});
			}
		}, 300);
		return false;
	});

	$('#FileImagenPerfil').change(function(e){

		const $FileImagenPerfil = document.querySelector("#FileImagenPerfil"),
		$ImgImagenPerfil = document.querySelector("#ImgImagenPerfil");

		const archivos = $FileImagenPerfil.files;

		// Ahora tomamos el primer archivo, el cual vamos a previsualizar
		const primerArchivo = archivos[0];
		// Lo convertimos a un objeto de tipo objectURL
		const objectURL = URL.createObjectURL(primerArchivo);
		// Y a la fuente de la imagen le ponemos el objectURL
		$ImgImagenPerfil.src = objectURL;
		$ImgImagenPerfil.width = 154;
		$ImgImagenPerfil.height = 152;

		var formData = new FormData($("#Frm-ImagenPerfil")[0]);

		$.ajax({
			url: 'acciones.ajax.php',
			type: 'POST',
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function(){
				$("#DivAlerta").load("../../../config/mensajes.php",{alerta:5,mensaje:'Enviando información, por favor espere...',Imagen:'../../public/assets/img/loading.gif'},function(){});
			},
			success:function(msj){
				if( msj == 1 ){
					$("#DivAlerta").load("../../../config/mensajes.php",{alerta:4,mensaje:'Tu imagen de perfil se actualizo correctamente.'},function(){});
				}else{
					$("#DivAlerta").load("../../../config/mensajes.php",{alerta:3,mensaje: msj },function(){});
				}
			},
			warning:function(){
				$("#DivAlerta").load("../../../config/mensajes.php",{alerta:1,mensaje:'Ha ocurrido un error durante la ejecución.'},function(){});
			}
		});
	});

	$('#FileImagenFirma').change(function(){

		const $FileImagenFirma = document.querySelector("#FileImagenFirma"),
		$ImgFirma = document.querySelector("#ImgImagenFirma");

		const archivos = $FileImagenFirma.files;

		// Ahora tomamos el primer archivo, el cual vamos a previsualizar
		const primerArchivo = archivos[0];
		// Lo convertimos a un objeto de tipo objectURL
		const objectURL = URL.createObjectURL(primerArchivo);
		// Y a la fuente de la imagen le ponemos el objectURL
		$ImgFirma.src = objectURL;
		$ImgFirma.width = 154;
		$ImgFirma.height = 152;

		var formData = new FormData($("#Frm-ImagenFirma")[0]);

		$.ajax({
			url: 'acciones.ajax.php',
			type: 'POST',
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function(){
				$("#DivAlerta").load("../../../config/mensajes.php",{alerta:5,mensaje:'Enviando información, por favor espere...',Imagen:'../../public/assets/img/loading.gif'},function(){});
			},
			success:function(msj){
				if( msj == 1 ){
					$("#DivAlerta").load("../../../config/mensajes.php",{alerta:4,mensaje:'Tu firma se actualizo correctamente.'},function(){});
				}else{
					$("#DivAlerta").load("../../../config/mensajes.php",{alerta:3,mensaje: msj },function(){});
				}
			},
			warning:function(){
				$("#DivAlerta").load("../../../config/mensajes.php",{alerta:1,mensaje:'Ha ocurrido un error durante la ejecución.'},function(){});
			}
		});
	});

	$("#id_depen").change(function () {

		$("#id_depen option:selected").each(function () {
			var idDepen = $(this).val();
			$.post("../../varios/combo_oficinas.php", {
				idDepen: idDepen
			}, function(data){
				$("#id_oficina").html(data);
			});
		});
	});

	$("#id_depar").change(function(){
		$("#id_depar option:selected").each(function(){
			var idDepar = $(this).val();
			$.post("../../varios/combo_Municipios.php",{
				idDepar: idDepar
			}, function(data){
				$("#id_muni").html(data);
			});
		});
	});
});