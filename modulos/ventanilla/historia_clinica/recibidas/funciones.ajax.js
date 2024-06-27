$(document).ready(function(){

	$('#BtnRadicar').click(function(){
		if ($('#id_paciente').val() === ""){
			sweetAlert("Oops...", "Te hizo falta el paciente de la solicitud de la la Historia Clínica!", "warning");
		}else if ($('#id_responsable').val() == 0){
			sweetAlert("Oops...", "Te hizo falta el responsable de la solicitud de la la Historia Clínica!", "warning");
		}else if ($('#asunto').val() == ""){
			sweetAlert("Oops...", "Te hizo falta el asunto de la correspondencia!", "warning");
			$('#asunto').focus();
		}else if ($('#id_forma_llegada').val() == 0){
			sweetAlert("Oops...", "Te hizo falta la forma de llegada de la correspondencia!", "warning");
			$('#id_forma_llegada').focus();
		}else if($('#id_tercero').val() != "" && $('#id_paren').val() == 'NULL'){
			sweetAlert("Oops...", "Te hizo falta la el parentesco del tercero falcultado!", "warning");
			$('#id_forma_llegada').focus();
		}else{

			var formData = new FormData($("#FrmDatos")[0]);
			
			$.ajax({
				url: 'acciones.ajax.php',
				type: "POST",
				data: formData,
				contentType: false,
				processData: false,
				beforeSend: function(){
					$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Info.</a><br><img src="../../../../public/assets/img/loading.gif" width="30" height="30"> Enviando información, Por favor espere.... </div>');
				},
				success:function(msj){
					if (msj == 1){
						$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Ok.</a> <br>El registro se almaceno correctamente. </div>');
						
						setTimeout(function () {
							window.location.href = "index.php";
						}, 200);
						
					}else{
						$("#DivAlertas").html(msj)
						sweetAlert("Oops...", msj, "warning");
					}
				},
				error:function(msj){
					sweetAlert("Oops...", "Ha ocurrido un error durante la ejecución: "+msj, "error");
				}
			});
		}
		return false;
	});
	
	$('#BtnGuardarPaciente').click(function(){
		if ($('#nom_contac').val() == ""){
			$("#DivAlertaNuevoPaciente").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el nombre del contacto.</div>')
			$('#nom_contac').focus();
		}else if ($('#id_depar_natural').val() == 0){
			$("#DivAlertaNuevoPaciente").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el departamento de recidencia del contacto.</div>')
			$('#id_depar_natural').focus();
		}else if ($('#id_muni_natural').val() == 0){
			$("#DivAlertaNuevoPaciente").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el municipio de recidencia del contacto.</div>')
			$('#id_muni_natural').focus();
		}else{

			var formData = new FormData($("#FrmDatosPacienteNatural")[0]); 

			$.ajax({
				url: '../../varios/admin_tercero_natural.ajax.php',
				type: 'POST',
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function(){
					$("#DivAlertaNuevoPaciente").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Info.</a><br><img src="../../../../public/assets/img/loading.gif" width="30" height="30"> Enviando información, Por favor espere.... </div>');
				},
				success:function(msj){
					
					if (msj.substring(0, 8) == 'IdRemite'){
						$("#DivAlertaNuevoPaciente").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Ok.</a> <br>El registro se almaceno correctamente. </div>');
						$('#id_paciente').val(msj.substring(8, msj.length))
						$('#num_docu_paciente').val($('#num_docu_natural').val());
						$('#nombre_paciente').val($('#nom_contac_natural').val());
						$('#asunto').val('Solicitud de historia clínica del paciente '+$('#nom_contac_natural').val())
						
						$("#FrmDatosPacienteNatural")[0].reset();

						$('#BtnCancelarNuevoPaciente').click();
						$("#DivAlertaNuevoPaciente").empty();
					}else{
						$("#DivAlertaNuevoPaciente").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> '+msj+'.</div>')
					}
				},
				error:function(msj){
					$("#DivAlertaNuevoPaciente").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
				}
			});
		}
	});

	$('#BtnGuardarTerceroNatural').click(function(){
		if ($('#nom_contac').val() == ""){
			$("#DivAlertaTerceroNatural").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el nombre del contacto.</div>')
			$('#nom_contac').focus();
		}else if ($('#id_depar_natural').val() == 0){
			$("#DivAlertaTerceroNatural").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el departamento de recidencia del contacto.</div>')
			$('#id_depar_natural').focus();
		}else if ($('#id_muni_natural').val() == 0){
			$("#DivAlertaTerceroNatural").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el municipio de recidencia del contacto.</div>')
			$('#id_muni_natural').focus();
		}else{

			var formData = new FormData($("#FrmDatosTerceroNatural")[0]); 

			$.ajax({
				url: 'tercero_natural_acciones.ajax.php',
				type: 'POST',
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function(){
					$("#DivAlertaTerceroNatural").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Info.</a><br><img src="../../../../public/assets/img/loading.gif" width="30" height="30"> Enviando información, Por favor espere.... </div>');
				},
				success:function(msj){
					
					if (msj.substring(0, 8) == 'IdRemite'){
						$("#DivAlertaTerceroNatural").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Ok.</a> <br>El registro se almaceno correctamente. </div>');
						$('#id_tercero').val(msj.substring(8, msj.length))
						$('#cc_nit').val($('#num_docu_natural').val());
						$('#remite_contacto').val($('#nom_contac_natural').val());
						$('#DivReriteRazoSoci').hide();
						$('#remite_dir').val($('#dir_natural').val());
						$('#remite_tel').val($('#tel_natural').val());
						$('#remite_cel').val($('#cel_natural').val());

						$("#FrmDatosTerceroNatural")[0].reset();

						$('#BtnCancelarTerceroNatural').click();
						$("#DivAlertaTerceroNatural").empty();
					}else{
						$("#DivAlertaTerceroNatural").load("../../../config/mensajes.php",{alerta:3,mensaje:msj},function(){});
					}
				},
				error:function(){
					$("#DivAlertaTerceroNatural").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
				}
			});
		}
	});

	$('#BtnBuscarPaciente').click(function(e){
		$("#TxtBusPacientes").focus();
	});

	//FUNCION PARA BUSCAR EL PACIENTE
	$("#TxtBusPacientes").keyup(function (e) {
		if (e.which == 13) {
			if($("#TxtBusPaciente").val() === ""){
				$("#DivAlertasPacientes").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Advertencia!!!</a><br> Te hizo falta ingresar el criterio de busqueda. </div>');
				$("#TxtBusPacientes").focus();
			}else{
				$.ajax({
					url: '../../varios/listar_tercero_natural.php',
					type: 'POST',
					data: 'criterio='+$("#TxtBusPacientes").val(),
					beforeSend: function(){
						$("#DivAlertasPacientes").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Info.</a><br><img src="../../../../public/assets/img/loading.gif" width="30" height="30"> Enviando información, por favor espere...</div>');
					},
					success:function(msj){
						$("#DivAlertasPacientes").empty();
						if(msj != 1){
							$("#DivPacientes").html(msj);
						}else{
							$("#DivAlertasPacientes").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Advertencia!!!</a><br>'+msj+'. </div>');
						}
					},
					error:function(){
						$("#DivAlertasPacientes").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
					}
				});
			}
		}
	});

	//FUNCIONES PARA ESTABLCER EL ID DEL RADICADO PARA AGREGAR
	//EL ARCHIVO DIGITAL E IMPRIMIR EL ROTULO
	$(document).on('click', '.idradicado', function (event) {
		$('#IdRadicado').val($(this).data('id_radicado'));
		$('#id_radicado').val($(this).data('id_radicado'));
	});

	$(document).on('click', '.ImprimirRotulo', function (event) {
		$('#IdRadicado').val($(this).data('id_radicado'));
		$('#id_radicado').val($(this).data('id_radicado'));
	});

	//FUNCION PARA IMPRIMIR ROTULO
	$('.ImprimirRotulo').click(function(e){
		
		$("#ifrImprimirRotulo").attr("src","../../../reportes/ventanilla/formato_historia_clinica/formato_hc_recibido.php?id_radica_recibido="+$(this).data('id_radicado'));
		$.ajax({
			url: 'acciones.ajax.php',
			type: 'POST',
			data: 'accion=IMPRIMIR_ROTULO&id_radica='+$(this).data('id_radicado'),
			success:function(data){
				if(data == 1){
					
					$('i[id=BtnImprimirRotulo'+$('#IdRadicado').val()+']').removeClass('text-warning');
					$('i[id=BtnImprimirRotulo'+$('#IdRadicado').val()+']').addClass('text-success');
				}else{
					$('i[id=BtnImprimirRotulo'+$('#IdRadicado').val()+']').removeClass('text-warning');
					$('i[id=BtnImprimirRotulo'+$('#IdRadicado').val()+']').addClass('text-danger');
				}
			},
			error:function(data){
				sweetAlert("Oops...", data, "warning");
			}
		});
	});

	$('#BtnSubirDigital').click(function(){
		var formData = new FormData($(".formulario")[0]);

        $.ajax({
			url: '../../../varios/ftp.acciones.php',
			type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
			beforeSend: function(){
				$("#DivAlertarAdjuntoDigital").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
			},
			success:function(msj){
				var Elementos = msj.split('-');
				if (Elementos[0] == 1){
					$('i[id=BtnAdjunarDigital'+$('#id_radica').val()+']').removeClass('text-warning');
					$('i[id=BtnAdjunarDigital'+$('#id_radica').val()+']').removeClass('fa-warning');
					$('i[id=BtnAdjunarDigital'+$('#id_radica').val()+']').addClass('fa-file-o');
					$('i[id=BtnAdjunarDigital'+$('#id_radica').val()+']').addClass('text-primary');
					//SI EL ARCHIVO DIGITAL SE SUBIO AL SERVIDOR MARCO QUE SE AGREGO EL DIGITAL AL RADICADO
					
					$.ajax({
						url: 'acciones.ajax.php',
						type: 'POST',
						data: 'accion=RADICADO_CARGAR_DIGITAL&id_radica='+$('#id_radicado').val()+'&num_folio='+Elementos[1]+'&id_ruta='+Elementos[2],
						success:function(msj){
							alert(msj)
							if(msj == 1){
								$('#BtnCancelarSubirDigital').click();
								$("#DivAlertarAdjuntoDigital").empty();
								$('#ifrVisualizaArchivo').attr('src', '')
							}else{
								sweetAlert("Oops...", msj, "warning");	
							}
						},
						error:function(error){
							sweetAlert("Oops...", error, "warning");
						}
					});
					//FIN DE MARCAR EL RADICADO
				}else{
					sweetAlert("Oops...", msj, "error");
				}
			},
			warning:function(){
				sweetAlert("Oops...", msj, "error");
			}
		});	
	});

	//FUNCION PARA LLEVAR EL PACIENTE
	$(document).on('click', '#BtnLlevarTerceroNatural', function(event){
		$('#id_paciente').val($(this).data('id_tercero_natural'));
		$('#num_docu_paciente').val($(this).data('num_docu_tercero_natural'));
		$('#nombre_paciente').val($(this).data('nombre_tercero_natural'));
		$('#asunto').val('Solicitud de historia clínica del paciente '+$(this).data('nombre_tercero_natural'))
	});

	$('#BtnBuscarTerceroNatural').click(function(e){
		$("#TxtBusTerceroNaturales").focus();
	});

	//FUNCION PARA BUSCAR EL TERCERO NATURAL
	$("#TxtBusTerceroNaturales").keyup(function (e) {
		if(e.which == 13){
			if($("#TxtBusTerceroNaturales").val() === ""){
				$("#DivAlertasTerceroNaturales").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Advertencia!!!</a><br> Te hizo falta ingresar el criterio de busqueda. </div>');
				$("#TxtBusTerceroNaturales").focus();
			}else{
				$.ajax({
					url: '../../varios/listar_tercero_natural_dos.php',
					type: 'POST',
					data: 'criterio='+$("#TxtBusTerceroNaturales").val(),
					beforeSend: function(){
						$("#DivAlertasTerceroNaturales").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Info.</a><br><img src="../../../../public/assets/img/loading.gif" width="30" height="30"> Enviando información, por favor espere...</div>');
					},
					success:function(msj){
						$("#DivAlertasTerceroNaturales").empty();
						if(msj != 1){
							$("#DivTerceroNaturales").html(msj);
						}else{
							$("#DivTerceroNaturales").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Advertencia!!!</a><br>'+msj+'. </div>');
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
	$(document).on('click', '#BtnLlevarTerceroNaturalDos', function(event){
		$('#id_tercero').val($(this).data('id_tercero_natural'));
		$('#cc_nit_tercero').val($(this).data('num_docu_tercero_natural'));
		$('#tercero_contacto').val($(this).data('nombre_tercero_natural'));
		$('#DivRemiteRazoSoci').hide();
	});

	$('#BtnBuscarTerceroJuridico').click(function(e){
		$("#TxtBusTerceroJuridicos").focus();
	});

	//FUNCION PARA BUSCAR EL TERCERO NATURAL
	$("#TxtBusTerceroJuridicos").keyup(function(e){
		if(e.which == 13) {
			if($("#TxtBusTerceroJuridicos").val() === ""){
				$("#DivAlertasTerceroJuridicos").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Advertencia!!!</a><br> Te hizo falta ingresar el criterio de busqueda. </div>');
				$("#TxtBusTerceroJuridicos").focus();
			}else{
				$.ajax({
					url: '../../varios/listar_tercero_juridico.php',
					type: 'POST',
					data: 'criterio='+$("#TxtBusTerceroJuridicos").val(),
					beforeSend: function(){
						$("#DivAlertasTerceroJuridicos").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Info.</a><br><img src="../../../../public/assets/img/loading.gif" width="30" height="30"> Enviando información, por favor espere...</div>');
					},
					success:function(msj){
						$("#DivAlertasTerceroJuridicos").empty();
						if(msj != 1){
							$("#DivTerceroJuridico").html(msj);
						}else{
							$("#DivAlertasTerceroJuridicos").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Advertencia!!!</a><br>'+msj+'. </div>');
						}
					},
					error:function(){
						$("#DivAlertasTerceroJuridicos").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
					}
				});
			}
		}
	});

	//FUNCION PARA LLEVAR EL TERCERO JURIDICO
	$(document).on('click', '#BtnLlevarTerceroJuridico', function(event){
		$('#id_tercero').val($(this).data('id_tercero_juridico'));
		$('#cc_nit_tercero').val($(this).data('nit_tercero_juridoc'));
		$('#tercero_contacto').val($(this).data('contacto_tercero_juridico'));
		$('#tercero_razo_soci').val($(this).data('entidad_tercero_juridoc'));
		$('#DivRemiteRazoSoci').show();
	});

	$("#id_serie").change(function () {
		var Destinatarios = new Array();
		var HayResponsable = false;

		$("input[name='ChkDestinatarios[]']:checked").each(function () {
			Destinatarios.push($(this).val());
		});

		if(!$('input[name="ChkFuncioRespon"]').is(':checked')){
			HayResponsable = true;
		}else{
			HayResponsable = false;
		}

		if (Destinatarios == ""){
			sweetAlert("Oops...", "Te hizo falta el o los destinatarios de la correspondencia!", "warning");
			$('#BtnBuscarDestinatario').click();
		}else if (!$('input[name="ChkFuncioRespon"]').is(':checked')) {
			sweetAlert("Oops...", "Debe establecer el responsable de la correspondencia!", "warning");
		}else{	
			$("#id_serie option:selected").each(function () {
				$.post("../../varios/combo_sub_series.php", {
					id_serie: $(this).val(),
					id_depen: $('#id_depen').val()
				}, function (data) {
					$("#id_subserie").html(data);
				});
			});
		}
	});

	$("#id_subserie").change(function () {
		$("#id_subserie option:selected").each(function () {
			var id_serie = $("#id_serie").val();
			var id_sub_serie = $(this).val();

			$.post("../../varios/combo_tipos_documentos.php", {
				accion: $('#accion').val(),
				id_depen: $('#id_depen').val(),
				id_serie: id_serie,
				id_sub_serie: id_sub_serie
			}, function (data) {
				$("#id_tipodoc").html(data);
			});
		});
	});

	$("#id_depar_natural").change(function(){
		$("#id_depar_natural option:selected").each(function(){
			var idDepar = $(this).val();
			$.post("../../../varios/combo_Municipios.php",{
				idDepar: idDepar
			}, function(data){
				$("#id_muni_natural").html(data);
			});
		});
	});

	$("#id_depar_juridico_empresa").change(function(){
		$("#id_depar_juridico_empresa option:selected").each(function(){
			var idDepar = $(this).val();
			$.post("../../../varios/combo_Municipios.php",{
				idDepar: idDepar
			}, function(data){
				$("#id_muni_juridico_empresa").html(data);
			});
		});
	});

	$('#BtnEliminarTercero').click(function(){
		$('#id_tercero').val('');
		$('#cc_nit_tercero').val('');
		$('#tercero_contacto').val('');
		$('#tercero_razo_soci').val('');
		$('#autorizo_envio_email_terce').prop("checked", false);
		$("#id_paren option[value=NULL]").attr("selected", true);
	});
});