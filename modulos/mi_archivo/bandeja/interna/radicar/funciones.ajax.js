$(document).ready(function () {

	$('#DivCopia').toggle();

	$('#BtnRadicar').click(function(){

		$('#BtnRadicar').attr('disabled', true);

		if($('#multi').val() == null) {
			sweetAlert("Oops...", "Te hizo falta al menos un destinatario!", "warning");
			$('#multi').focus();
			$('#BtnRadicar').attr('disabled', false);
		}else if($('#text-editor').val() == '') {
			sweetAlert("Oops...", "Te hizo falta la redacción de la comunicación!", "warning");
			$('#id_tipodoc').focus();
			$('#BtnRadicar').attr('disabled', false);
		}else if($('#id_serie').val() == 0) {
			sweetAlert("Oops...", "Te hizo falta la serie!", "warning");
			$('#id_serie').focus();
			$('#BtnRadicar').attr('disabled', false);
		}else if($('#id_subserie').val() == 0) {
			sweetAlert("Oops...", "Te hizo falta la subserie!", "warning");
			$('#id_subserie').focus();
			$('#BtnRadicar').attr('disabled', false);
		}else if($('#id_tipodoc').val() == 0) {
			sweetAlert("Oops...", "Te hizo falta el tipo de documento!", "warning");
			$('#id_tipodoc').focus();
			$('#BtnRadicar').attr('disabled', false);
		}else{

			var TextoCorrespondencia = $('#text-editor').val();
			var editorData = editor.getData();
			var postBody=editorData.replace(/&nbsp;/gi,' ');
			var dataString = 'accion='+$('#accion').val()+'&destinatarios='+$('#multi').val()+'&copia='+$('#multi1').val()+'&asunto='+$('#asunto').val()+'&texto='+postBody+'&fec_venci='+$('#fec_venci').val()+'&id_serie='+$('#id_serie').val()+'&id_subserie='+$('#id_subserie').val()+'&id_tipodoc='+$('#id_tipodoc').val();

			$.ajax({
				type: 'POST',
				url: 'acciones.ajax.php',
				data: dataString,
				cache: true,
				beforeSend: function(){
					$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
				},
				success:function(msj){

					var Elementos = msj.split('#');

					if(Elementos[0] == 1) {
						$('#BtnRadicar').attr('disabled', false);
						$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El registro se almaceno correctamente. </div>');

						if(Elementos[2] == 1) {
							$.ajax({
								url: '../../../../varios/ftp.acciones.php',
								type: 'POST',
								data: 'accion=INTERNO_UPLOAD&id_radicado='+Elementos[1]+'&id_depen='+$('#id_depen').val(),
								beforeSend: function(){
									$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando archivos al servidor, por favor espere. </div>');
								},
								success:function(msj){

									if(msj == 1){
										$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a>Los archivos se almacenaron correctamente. </div>');
										//SI EL ARCHIVO DIGITAL SE SUBIO AL SERVIDOR MARCO QUE SE AGREGO EL DIGITAL AL RADICADO
									}else{
										sweetAlert("Oops...", msj, "error");
									}
								},
								error:function(error){
									sweetAlert("Error...", msj, "error");
								}
							});
						}

						setTimeout(function (){
							window.location.href = "../recibidas/index.php";
						}, 100);

					}else{
						$("#DivAlertas").html(msj);
						sweetAlert("Oops...", msj, "warning");
						$('#BtnRadicar').attr('disabled', false);
					}
				},
				error:function(msj){
					$("#DivAlertas").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
					$('#BtnRadicar').attr('disabled', false);
				}
			});
		}

		return false;
	});

	/*
	$("#multi").change(function(){
		var IdDepen           = $('#id_depen').val();
		var IdOficina         = $('#id_oficina').val();
		var IncluirOficinaTRD = $('#incluir_oficina_trd').val();

		$.post("../../../../varios/combo_series.php", {
			id_depen: IdDepen,
			id_oficina: IdOficina,
			IncluirOficinaTRD: IncluirOficinaTRD
		}, function(data){
			$("#id_serie").html(data);
		});
	});
	*/

	$("#id_serie").change(function(){
		if($("#id_serie").val() != 0){
			$.post("../../../../varios/combo_sub_series.php", {
				id_serie: $("#id_serie").val(),
				id_depen: $('#id_depen').val(),
				id_oficina: $('#id_oficina').val(),
				IncluirOficinaTRD: $('#incluir_oficina_trd').val(),
			},function(data){
				$("#id_subserie").html(data);
			});
		}
	});

	$("#id_subserie").change(function(){
		if($("#id_subserie").val() != 0){
			var id_serie = $("#id_serie").val();
			var id_sub_serie = $("#id_subserie").val();

			$.post("../../../../varios/combo_tipos_documentos.php", {
				accion: "",
				id_depen: $('#id_depen').val(),
				id_serie: id_serie,
				id_sub_serie: id_sub_serie
			}, function (data) {
				$("#id_tipodoc").html(data);
			});
		}
	});

	/*FUNCION PARA MOSTRAR Y CULTAR LOS DESTINATARIOS CON COPIA*/
	$('#DivCc').toggle(
	/*
	Primer click.
	Función que descubre un panel oculto
	y cambia el texto del botón.
	*/
	function(e){
		//e.preventDefault();
		$('#DivCopia').slideDown();
		//$(this).text('Cerrar el panel');

	}, // Separamos las dos funciones con una coma

	/*
	Segundo click.
	Función que oculta el panel
	y vuelve a cambiar el texto del botón.
	*/
	function(e){
		//e.preventDefault();
		$('#DivCopia').slideUp();
		//$(this).text('Mostrar el panel oculto');

	});
});