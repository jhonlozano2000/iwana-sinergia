$(document).ready(function(){

	$('#id_radica').focus();

	$('#BtnBuscar').click(function(e){
		e.preventDefault();

		$("#DivAlertas").empty();
		
		if($('#id_radica').val() == "" && $('#desde').val() == "" && $('#hasta').val() == "" && $('#asunto').val() == "" && $('#tercero').val() == "" && $('#destinatario').val() == "" && $('#id_depen').val() === "0" && $('#id_serie').val() === "0" && $('#id_subserie').val() === "0" && $('#id_tipodoc').val() === "0"){
			$("#DivAlertas").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Debe establecer al menos un criterio de búsqueda.</div>');
			$('#id_radica').focus();
		}else if($('#origen').val() === "0"){
			$("#DivAlertas").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta elegir el origen de la correspondencia.</div>');
			$('#origen').focus();
		}else{
			
			var formData = new FormData($("#FrmDatos")[0]);

			if($('#origen').val() === "Recibido"){
				$.ajax({
					url: 'buscar_recibido.php',
					type: "POST",
					data: formData,
					contentType: false,
					processData: false,
					beforeSend: function(){
						$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
					},
					success:function(msj){
						$("#DivAlertas").empty();
						$("#DivResultados").empty();
						$("#DivResultados").append(msj);
					},
					error:function(msj){
						$("#DivAlertas").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
					}
				});
			}else if($('#origen').val() === "Enviado"){
				$.ajax({
					url: 'buscar_enviado.php',
					type: "POST",
					data: formData,
					contentType: false,
					processData: false,
					beforeSend: function(){
						$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
					},
					success:function(msj){
						$("#DivAlertas").empty();
						$("#DivResultados").empty();
						$("#DivResultados").append(msj);
					},
					error:function(msj){
						$("#DivAlertas").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
					}
				});
			}
		}
	});

	//FUNCION PARA CARGAR LA INFORMACION DEL FILTRO DE BUSQUEDA DE LOS RADICADO
	$(document).on('click', '#TRRadicado', function(event){
		if($('#origen').val() === "Recibido"){
			$.ajax({
				url: '../varios/mostrar_radicado_recibido.php',
				type: 'POST',
				data: 'id_radica='+$(this).data('id_radicado'),
				beforeSend: function(){
					$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
				},
				success:function(msj){
					$("#DivAlertas").empty();
					$("#DivRadicadosInfo").empty();
					$("#DivRadicadosInfo").append(msj);
				},
				error:function(msj){
					$("#DivAlertas").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
				}
			});
		}else if($('#origen').val() === "Enviado"){
			$.ajax({
				url: '../varios/mostrar_radicado_enviado.php',
				type: 'POST',
				data: 'id_radica='+$(this).data('id_radicado'),
				beforeSend: function(){
					$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
				},
				success:function(msj){
					$("#DivAlertas").empty();
					$("#DivRadicadosInfo").empty();
					$("#DivRadicadosInfo").append(msj);
				},
				error:function(msj){
					$("#DivAlertas").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
				}
			});
		}
	});

	$(document).on('click', '#BtnDescargarPdfRecibido', function (event) {

		var IdRadicado = $(this).data('id_radicado')
		var IdRuta = $(this).data('id_ruta')
		
		if($(this).data('id_ruta') === ""){
			sweetAlert("Oops...", "El radicado no tiene el documento digital, por favor adjunte el documento digitalizado!", "warning");
		}else{
			$.ajax({
				url: '../../varios/ftp.acciones.php',
				type: 'POST',
				data: 'accion=RECIBIDOS_DESCARGAR&id_radica='+IdRadicado+'&id_ruta='+IdRuta,
				beforeSend: function(){
					$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
				},
				success:function(msj){
					$("#DivAlertas").empty();
					if(msj == 1){
						window.open("../../../archivos/temp/recibidos/"+IdRadicado+".pdf", '_blank');
						$("#DivAlertas").empty();
					}else{
						sweetAlert("Oops...", msj, "error");
					}
				},
				error:function(msj){
					$("#DivAlertas").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
				}
			});
		}
	});

	$(document).on('click', '#BtnDescargarPdfEnviado', function (event) {
		
		var IdRadicado = $(this).data('id_radicado')
		var IdRuta = $(this).data('id_ruta')
		
		if($(this).data('id_ruta') === ""){
			sweetAlert("Oops...", "El radicado no tiene el documento digital, por favor adjunte el documento digitalizado!", "warning");
		}else{
			$.ajax({
				url: '../../varios/ftp.acciones.php',
				type: 'POST',
				data: 'accion=ENVIADOS_DESCARGAR&id_radica='+IdRadicado+'&id_ruta='+IdRuta,
				beforeSend: function(){
					$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>')
				},
				success:function(msj){
					$("#DivAlertas").empty();
					if(msj == 1){
						url = "../../../archivos/temp/enviados/"+IdRadicado+".pdf";
						window.open(url, 'Download');
						$("#DivAlertas").empty();
					}else{
						sweetAlert("Oops...", msj, "error");
					}
				},
				error:function(msj){
					$("#DivAlertas").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
				}
			});
		}
	});

	$('#id_radica').blur(function(){
		if($(this).val() != ""){
			$('#desde').attr('disabled', 'disabled');
			$('#desde').val("");
			$('#hasta').attr('disabled', 'disabled');
			$('#hasta').val("");
			$('#asunto').attr('disabled', 'disabled');
			$('#asunto').val("");
			$('#tercero').attr('disabled', 'disabled');
			$('#tercero').val("");
			$('#destinatario').attr('disabled', 'disabled');
			$('#destinatario').val("");
			$('#id_depen').attr('disabled', 'disabled');
			$('#id_serie').attr('disabled', 'disabled');
			$('#id_subserie').attr('disabled', 'disabled');
			$('#id_tipodoc').attr('disabled', 'disabled');
			$('#id_depen > option[value="0"]').attr('selected', 'selected');
			$('#id_serie > option[value="0"]').attr('selected', 'selected');
			$('#id_subserie > option[value="0"]').attr('selected', 'selected');
			$('#id_tipodoc > option[value="0"]').attr('selected', 'selected');
		}else{
			$('#desde').removeAttr('disabled');
			$('#hasta').removeAttr('disabled');
			$('#asunto').removeAttr('disabled');
			$('#tercero').removeAttr('disabled');
			$('#destinatario').removeAttr('disabled');
			$('#id_depen').removeAttr('disabled');
			$('#id_serie').removeAttr('disabled');
			$('#id_subserie').removeAttr('disabled');
			$('#id_tipodoc').removeAttr('disabled');
		}
	});

	$("#id_depen").change(function () {
		if($("#id_depen").val() != 0){
			$.post("../../varios/combo_series.php", {
				id_depen: $('#id_depen').val()
			}, function (data) {
				$("#id_serie").html(data);
			});
		}		
	});

	$("#id_serie").change(function () {
		if($("#id_serie").val() != 0){
			$.post("../../varios/combo_sub_series.php", {
				id_serie: $("#id_serie").val(),
				id_depen: $('#id_depen').val()
			}, function (data) {
				$("#id_subserie").html(data);
			});
		}
	});

	$("#origen").change(function () {
		if($(this).val() == "Recibido"){
			$('#tercero').attr('placeholder','Remitente');
			$('#destinatario').attr('placeholder','Destinatario');

		}else if($(this).val() == "Enviado"){
			$('#tercero').attr('placeholder','Destinatario');
			$('#destinatario').attr('placeholder','Remitente');
		}
	});

	$("#id_subserie").change(function () {
		if($("#id_subserie").val() != 0){
			var id_serie = $("#id_serie").val();
			var id_sub_serie = $("#id_subserie").val();

			$.post("../../varios/combo_tipos_documentos.php", {
				accion: "",
				id_depen: $('#id_depen').val(),
				id_serie: id_serie,
				id_sub_serie: id_sub_serie
			}, function (data) {
				$("#id_tipodoc").html(data);
			});
		}
	});

	$('#BtnBuscarTerceroNatural').click(function(e){
		$("#TxtBusTerceroNaturales").focus();
	});

	//FUNCION PARA BUSCAR EL TERCERO NATURAL
	$("#TxtBusTerceroNaturales").keyup(function (e) {
		if (e.which == 13) {
			if($("#TxtBusTerceroNaturales").val() === ""){
				$("#DivAlertasTerceroNaturales").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta ingresar el criterio de busqueda.</div>');
				$("#TxtBusTerceroNaturales").focus();
			}else{
				$.ajax({
					url: '../varios/listar_tercero_natural.php',
					type: 'POST',
					data: 'criterio='+$("#TxtBusTerceroNaturales").val(),
					beforeSend: function(){
						$("#DivAlertasTerceroNaturales").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
					},
					success:function(msj){
						$("#DivAlertasTerceroNaturales").empty();
						if(msj != 1){
							$("#DivTerceroNaturales").html(msj);
						}else{
							$("#DivTerceroNaturales").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> '+msj+'.</div>');
						}
					},
					error:function(msj){
						$("#DivAlertasTerceroNaturales").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
					}
				});
			}
		}
	});

	//FUNCION PARA LLEVAR EL DESTINATARIO NATURAL
	$(document).on('click', '#BtnLlevarTerceroNatural', function(event){
		$('#id_tercero').val($(this).data('id_tercero_natural'));
		$('#tercero').val($(this).data('nombre_tercero_natural'));
		$('#tipo_tercero').val('NATURAL');
	});

	$('#BtnBuscarTerceroJuridico').click(function(e){
		$("#TxtBusTerceroJuridicos").focus();
	});

	//FUNCION PARA BUSCAR EL TERCERO NATURAL
	$("#TxtBusTerceroJuridicos").keyup(function(e){
		if(e.which == 13) {
			if($("#TxtBusTerceroJuridicos").val() === ""){
				$("#DivAlertasTerceroJuridicos").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta ingresar el criterio de busqueda.</div>');
				$("#TxtBusTerceroJuridicos").focus();
			}else{
				$.ajax({
					url: '../varios/listar_tercero_juridico.php',
					type: 'POST',
					data: 'criterio='+$("#TxtBusTerceroJuridicos").val(),
					beforeSend: function(){
						$("#DivAlertasTerceroJuridicos").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
					},
					success:function(msj){
						$("#DivAlertasTerceroJuridicos").empty();
						if(msj != 1){
							$("#DivTerceroJuridico").html(msj);
						}else{
							$("#DivAlertasTerceroJuridicos").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> '+msj+'.</div>');
						}
					},
					error:function(msj){
						$("#DivAlertasTerceroJuridicos").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
					}
				});
			}
		}
	});

	//FUNCION PARA LLEVAR EL TERCERO JURIDICO
	$(document).on('click', '#BtnLlevarTerceroJuridico', function(event){
		$('#id_tercero').val($(this).data('id_empre'));
		$('#tercero').val($(this).data('entidad_tercero_juridoc'));
		$('#tipo_tercero').val('JURIDICO');
	});

	$('#BtnBuscarDestinatarioNatural').click(function(e){
		$("#TxtBusDestinaNaturales").focus();
	});

	//FUNCION PARA BUSCAR EL TERCERO NATURAL
	$("#TxtBusDestinaNaturales").keyup(function (e) {
		if (e.which == 13) {
			if($("#TxtBusDestinaNaturales").val() === ""){
				$("#DivAlertasDestinaNaturales").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta ingresar el criterio de busqueda.</div>');
				$("#TxtBusDestinaNaturales").focus();
			}else{
				$.ajax({
					url: 'listar_destinatario_natural.php',
					type: 'POST',
					data: 'criterio='+$("#TxtBusDestinaNaturales").val(),
					beforeSend: function(){
						$("#DivAlertasDestinaNaturales").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
					},
					success:function(msj){
						if(msj != 1){
							$("#DivDestinatarioNaturales").html(msj);
						}else{
							$("#DivDestinatarioNaturales").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> '+msj+'.</div>');
						}
					},
					error:function(msj){
						$("#DivAlertasDestinaNaturales").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
					}
				});
			}
		}
	});

	//FUNCION PARA LLEVAR EL DESTINATARIO NATURAL
	$(document).on('click', '#BtnLlevarDestinatarioNatural', function(event){
		$('#id_destinatario').val($(this).data('id_destinatario_natural'));
		$('#destinatario').val($(this).data('nombre_destinatario_natural'));
	});


	$('#BtnBuscarDestinatarioJuridico').click(function(e){
		$("#TxtBusDestinaJuridicos").focus();
	});

	//FUNCION PARA BUSCAR EL TERCERO NATURAL
	$("#TxtBusDestinaJuridicos").keyup(function(e){
		if (e.which == 13) {
			if($("#TxtBusDestinaJuridicos").val() === ""){
				$("#DivAlertasDestinaJuridicos").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta ingresar el criterio de busqueda.</div>');
				$("#TxtBusDestinaJuridicos").focus();
			}else{
				$.ajax({
					url: 'listar_destinatario_juridico.php',
					type: 'POST',
					data: 'criterio='+$("#TxtBusDestinaJuridicos").val(),
					beforeSend: function(){
						$("#DivAlertasDestinaJuridicos").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
					},
					success:function(msj){
						if(msj != 1){
							$("#DivDestinatarioJuridico").html(msj);
						}else{
							$("#DivAlertasDestinaJuridicos").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> '+msj+'.</div>');
						}
					},
					error:function(msj){
						$("#DivAlertasDestinaJuridicos").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
					}
				});
			}
		}
	});

	//FUNCION PARA LLEVAR EL DESTINATARIO JURIDICO
	$(document).on('click', '#BtnLlevarDestinatarioJuridico', function(event){
		$('#id_destinatario').val($(this).data('id_destinatario_natural'));
		$('#destinatario').val($(this).data('nombre_destinatario_natural'));
	});
});