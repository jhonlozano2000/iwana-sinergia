$(document).ready(function(){

	$('#BtnRadicarRecibidas').click(function(){

		var RequiRespues   = $("#chkTerms").prop("checked") ? 1 : 0;
		var Destinatarios  = new Array();
		var NumAnexos      = $('#num_anexos').val()
		var HayResponsable = false;

		$("input[name='ChkDestinatarios[]']:checked").each(function () {
			Destinatarios.push($(this).val());
		});

		if(NumAnexos == ""){
			NumAnexos = '0';
		}

		if($('input[name="ChkFuncioRespon"]').is(':checked')){
			HayResponsable = true;
		}else{
			HayResponsable = false;
		}

		if ($('#fec_docu').val() == ""){
			sweetAlert("Oops...", "Te hizo falta la fecha del documento!", "warning");
			$('#fec_docu').focus();
		}else if (RequiRespues === true && $('#fec_venci').val() === '') {
			sweetAlert("Oops...", "Te hizo falta la fecha de vencimiento del documento!", "warning");
			$('#fec_venci').focus();
		}else if ($('#num_folio').val() == '') {
			sweetAlert("Oops...", "Te hizo falta el numéro de folios del documento!", "warning");
			$('#num_folio').focus();
		}else if ($('#num_anexos').val() != ""  && $('#observa_anexo').val() === '') {
			sweetAlert("Oops...", "Te hizo falta la observación de los anexos!", "warning");
			$('#observa_anexo').focus();
		}else if ($('#asunto').val() == ""){
			sweetAlert("Oops...", "Te hizo falta el asunto de la correspondencia!", "warning");
			$('#asunto').focus();
		}else if (Destinatarios == ""){
			sweetAlert("Oops...", "Te hizo falta el o los destinatarios de la correspondencia!", "warning");
			$('#BtnBuscarDestinatario').click();
		}else if (HayResponsable === false) {
			sweetAlert("Oops...", "Debe establecer el responsable de la correspondencia!", "warning");
		}else if ($('#id_tercero').val() == ""){
			sweetAlert("Oops...", "Te hizo falta el tercero de la correspondencia!", "warning");
		}else if ($('#id_forma_llegada').val() == 0){
			sweetAlert("Oops...", "Te hizo falta la forma de llegada de la correspondencia!", "warning");
			$('#id_forma_llegada').focus();
		}else if ($('#incluir_trd').val() == 1 && $('#id_serie').val() == 0){
			sweetAlert("Oops...", "Te hizo falta la Serie de la clasificación documental de la correspondencia!", "warning");
			$('#id_serie').focus();
		}else if ($('#incluir_trd').val() == 1 && $('#id_subserie').val() == 0){
			sweetAlert("Oops...", "Te hizo falta la Subserie de la clasificación documental de la correspondencia!", "warning");
			$('#id_subserie').focus();
		}else if ($('#id_tipodoc').val() == 0){
			sweetAlert("Oops...", "Te hizo falta el tipo documental de la clasificación documental de la correspondencia!", "warning");
			$('#id_tipodoc').focus();
		}else{

			$.ajax({
				url: 'accionesVentanillaRecibidas.php',
				type: 'POST',
				data: 'accion=GUARDAR_RADICADO&id_serie='+$('#id_serie').val()+'&id_subserie='+$('#id_subserie').val()+'&id_tipodoc='+$('#id_tipodoc').val()+'&id_forma_llegada='+$('#id_forma_llegada').val()+'&id_tercero='+$('#id_tercero').val()+'&fechor_radica='+$('#fechor_radica').val()+'&fec_docu='+$('#fec_docu').val()+'&requie_respues='+RequiRespues+'&fec_venci='+$('#fec_venci').val()+'&asunto='+$('#asunto').val()+'&num_folio='+$('#num_folio').val()+'&num_anexos='+NumAnexos+'&observa_anexo='+$('#observa_anexo').val()+'&Destinatarios='+Destinatarios+'&Responsable='+$('input:radio[name=ChkFuncioRespon]:checked').val()+"&incluir_trd="+$('#incluir_trd').val()+'&opcion_relacion='+$('#opcion_relacion').val()+'&opcion_titulo='+$('#opcion_titulo').val()+'&opcion_sub_titulo='+$('#opcion_sub_titulo').val()+'&opcion_detalle1='+$('#opcion_detalle1').val()+'&opcion_detalle2='+$('#opcion_detalle2').val()+'&opcion_detalle3='+$('#opcion_detalle3').val(),
				beforeSend: function(){
					$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
				},
				success:function(msj){
					if (msj == 1){
						$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El registro se almaceno correctamente. </div>');
						setTimeout(function () {
							window.location.href = "index.php";
						}, 200);
					}else{
						sweetAlert("Oops...", msj+"!", "warning");
					}
				},
				error:function(){
					sweetAlert("Oops...", "Ha ocurrido un error durante la ejecución", "error");
				}
			});
		}
		return false;
	});

	$('#BtnSubirDigitalRecibido').click(function(){
		var formData = new FormData($(".formulario")[0]);
		$.ajax({
			url: '../../../varios/ftp.acciones.php',
			type: 'POST',
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function(){
				$("#DivAlertarAdjuntoDigital").load("../../../../config/mensajes.php", {alerta:5,mensaje:'Enviando información, por favor espere...'} ,function(){});
			},
			success:function(msj){

				if(msj == 1){
					$('#BtnCancelarSubirDigitalRecibido').click();
					$("#DivAlertarAdjuntoDigital").empty();
					$('#ifrVisualizaArchivo').attr('src', '')
				}else{
					sweetAlert("Oops...", msj, "error");
				}
			},
			warning:function(){
				sweetAlert("Oops...", msj, "error");
			}
		});	
	});

	$('#BtnGuardarTerceroNatural').click(function(){
		if($('#nom_contac').val() == ""){
			$("#DivAlertaTerceroNatural").load("../../../../config/mensajes.php", {alerta:3,mensaje:'Te hizo falta el nombre del contacto.'} ,function(){});
			$('#nom_contac').focus();
		}else if ($('#id_depar_natural').val() == 0){
			$("#DivAlertaTerceroNatural").load("../../../../config/mensajes.php", {alerta:3,mensaje:'Te hizo falta el departamento de recidencia del contacto.'} ,function(){});
			$('#id_depar_natural').focus();
		}else if ($('#id_muni_natural').val() == 0){
			$("#DivAlertaTerceroNatural").load("../../../../config/mensajes.php", {alerta:3,mensaje:'Te hizo falta el municipio de recidencia del contacto.'} ,function(){});
			$('#id_muni_natural').focus();
		}else{

			var formData = new FormData($("#FrmDatosTerceroNatural")[0]); 

			$.ajax({
				url: '../../varios/admin_tercero_natural.ajax.php',
				type: 'POST',
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function(){
					$("#DivAlertaTerceroNatural").load("../../../../config/mensajes.php", {alerta:5,mensaje:'Enviando información, por favor espere...'} ,function(){});
				},
				success:function(msj){
					if (msj.substring(0, 8) == 'IdRemite'){
						$("#DivAlertaTerceroNatural").load("../../../../config/mensajes.php", {alerta:4,mensaje:'El registro se almaceno correctamente'} ,function(){});
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
						$("#DivAlertaTerceroNatural").load("../../../../config/mensajes.php", {alerta:3,mensaje:msj} ,function(){});
					}
				},
				error:function(msj){
					$("#DivAlertaTerceroNatural").load("../../../../config/mensajes.php", {alerta:1,mensaje:'Ha ocurrido un error durante la ejecución, '+msj} ,function(){});
				}
			});
		}
	});

	$('#BtnGuardarTerceroJutidico').click(function(){
		if ($('#nom_contac_juridico').val() == ""){
			$("#DivAlertaTerceroJutidico").load("../../../../config/mensajes.php", {alerta:3,mensaje:'Te hizo falta el nombre del contacto.'} ,function(){});
			$('#nom_contac_juridico').focus();
		}else if ($('#multi').val() == 0){
			$("#DivAlertaTerceroJutidico").load("../../../../config/mensajes.php", {alerta:3,mensaje:'Te hizo falta al empresa del contacto.'} ,function(){});
			$('#id_empre_juridico').focus();
		}else{

			var formData = new FormData($("#FrmDatosTerceroJuridico")[0]); 

			$.ajax({
				url: '../../varios/admin_tercero_juridico_contacto.ajax.php',
				type: 'POST',
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function(){
					$("#DivAlertaTerceroJutidico").load("../../../../config/mensajes.php", {alerta:5,mensaje:'Enviando información, por favor espere...'} ,function(){});
				},
				success:function(msj){
					var Elementos = msj.split('-');
					if (Elementos[0]  == 1){
						$('#id_tercero').val(Elementos[1]);
						$('#cc_nit').val(Elementos[2]);
						$('#remite_contacto').val(Elementos[3]);
						$('#remite_razo_soci').val(Elementos[4]);
						$('#DivRemiteRazoSoci').show();
						$('#remite_dir').val(Elementos[5]);
						$('#remite_tel').val(Elementos[6]);
						$('#remite_cel').val(Elementos[7]);

						$("#FrmDatosTerceroJuridico")[0].reset();
						$('#BtnCancelarTerceroJutidico').click();
						$("#DivAlertaTerceroJutidico").empty();
					}else{
						$("#DivAlertaTerceroJutidico").load("../../../../config/mensajes.php", {alerta:3,mensaje:msj} ,function(){});
					}
				},
				error:function(msj){
					$("#DivAlertaTerceroJutidico").load("../../../../config/mensajes.php", {alerta:1,mensaje:'Ha ocurrido un error durante la ejecución, '+msj} ,function(){});
				}
			});
		}
	});

	//FUNCION PARA GUARDAR TERCERO JURIDICO CON NUEVA EMPRESA
	$('#BtnGuardarTerceroJutidicoConEmpresa').click(function(){
		if($('#nit').val() == ""){
			$("#DivAlertaTerceroJutidicoConEmpresa").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el Nit. de la empresa del contacto.</div>');
			$("#DivAlertaTerceroJutidico").load("../../../../config/mensajes.php", {alerta:3,mensaje:'Te hizo falta al empresa del contacto.'} ,function(){});
			$('#nit').focus();
		}else if($('#razo_soci').val() == ""){
			$("#DivAlertaTerceroJutidicoConEmpresa").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta la Razon Social de la empresa del contacto.</div>');
			$("#DivAlertaTerceroJutidico").load("../../../../config/mensajes.php", {alerta:3,mensaje:'Te hizo falta al empresa del contacto.'} ,function(){});
			$('#razo_soci').focus();
		}else if($('#id_depar_juridico_empresa').val() == 0){
			$("#DivAlertaTerceroJutidicoConEmpresa").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el departamento de la empresa del contacto.</div>');
			$("#DivAlertaTerceroJutidico").load("../../../../config/mensajes.php", {alerta:3,mensaje:'Te hizo falta al empresa del contacto.'} ,function(){});
			$('#id_depar_juridico_empresa').focus();
		}else if($('#id_muni_juridico_empresa').val() == 0){
			$("#DivAlertaTerceroJutidicoConEmpresa").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el municipio de la empresa del contacto.</div>');
			$("#DivAlertaTerceroJutidico").load("../../../../config/mensajes.php", {alerta:3,mensaje:'Te hizo falta al empresa del contacto.'} ,function(){});
			$('#id_muni_juridico_empresa').focus();
		}else if($('#nom_contac_juridico_empresa').val() == ""){
			$("#DivAlertaTerceroJutidicoConEmpresa").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el nombre del contacto.</div>');
			$("#DivAlertaTerceroJutidico").load("../../../../config/mensajes.php", {alerta:3,mensaje:'Te hizo falta al empresa del contacto.'} ,function(){});
			$('#nom_contac_juridico_empresa').focus();
		}else{

			var formData = new FormData($("#FrmDatosTerceroJuridicoConEmpresa")[0]); 

			$.ajax({
				url: '../../varios/admin_tercero_juridico_empresa.ajax.php',
				type: 'POST',
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function(){
					$("#DivAlertaTerceroJutidico").load("../../../../config/mensajes.php", {alerta:5,mensaje:'Enviando información, por favor espere...'} ,function(){});
				},
				success:function(msj){
					if (msj.substring(0, 8) == 'IdRemite'){
						$("#DivAlertaTerceroJutidicoConEmpresa").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El registro se almaceno correctamente. </div>');
						$('#id_tercero').val(msj.substring(8, msj.length-1));
						$('#cc_nit').val($('#nit').val());
						$('#nom_contac_juridico').val($('#nom_contac_juridico_empresa').val());
						$('#DivReriteRazoSoci').show();
						$('#remite_razo_soci').val($('#razo_soci').val());
						$('#remite_dir').val($('#dir_juridico_empresa').val());
						$('#remite_tel').val($('#tel_juridico_empresa').val());
						$('#remite_cel').val($('#cel_juridico_empresa').val());

						$("#FrmDatosTerceroJuridicoConEmpresa")[0].reset();

						$('#BtnCancelarTerceroJutidicoConEmpresa').click();
						$("#DivAlertaTerceroJutidicoConEmpresa").empty();
					}else{
						$("#DivAlertaTerceroJutidicoConEmpresa").load("../../../../config/mensajes.php", {alerta:3,mensaje:msj} ,function(){});
					}
				},
				error:function(msj){
					$("#DivAlertaTerceroJutidicoConEmpresa").load("../../../../config/mensajes.php", {alerta:1,mensaje:'Ha ocurrido un error durante la ejecución, '+msj} ,function(){});
				}
			});
		}
	});

	//LIMPIAR FORMULARIO DE TERCEROS NATURALES
	$('#BtnCancelarTerceroNatural').click(function(){
		$("#FrmDatosTerceroNatural")[0].reset();
	});

	$(document).on('click', '#BtnDescargarArchivoRecibido', function(event){

		var IdRadicado = $(this).data("id_radicado");
		var Archivo = $(this).data("archivo");
		var IdRuta = $(this).data("id_ruta");

		if(IdRuta == 0){
			sweetAlert("Oops...", "El radicado no tiene el documento digital, por favor adjunte el documento digitalizado!", "warning");
		}else{
			$.ajax({
				url: '../../../varios/ftp.acciones.php',
				type: 'POST',
				data: 'accion=RECIBIDOS_DESCARGAR&id_radicado='+IdRadicado+'&id_ruta='+IdRuta,
				beforeSend: function(){
					$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
				},
				success:function(msj){
					$("#DivAlertas").empty();
					if(msj == 1){
						window.open("../../../../archivos/temp/recibidos/"+Archivo, '_blank');
					}else{
						sweetAlert("Oops...", msj, "warning");
					}		
				},
				error:function(error){
					sweetAlert("Oops...", error, "error");
				}
			});
		}
	});

	$(document).on('click', '#BtnLlevarEditarAsunto', function(event){

		var IdRadicado = $(this).data('id_radicado');
		var Asunto = $(this).data('asunto');

		$('#id_radica_editar_asunto').val(IdRadicado);
		$('#asunto_editar_asunto').val(Asunto);

	});

	$(document).on('click', '#BtnEditarAsunto', function(event){
		$.ajax({
			url: 'accionesVentanillaRecibidas.php',
			type: 'POST',
			data: 'accion=EDITAR_ASUNTO&id_radica='+$('#id_radica_editar_asunto').val()+'&asunto='+$('#asunto_editar_asunto').val(),
			beforeSend: function(){
				$("#DivAlertasEditarAsunto").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
			},
			success:function(msj){
				if (msj == 1){
					$("#DivAlertasEditarAsunto").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El registro se almaceno correctamente. </div>');
				}else{
					$("#DivAlertasEditarAsunto").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> '+msj+'.</div>');
				}
			},
			error:function(msj){
				$("#DivAlertas").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
			}
		});
	});

	$(document).on('click', '#BtnEliminarRadicado', function(event){

		var IdRadicado = $(this).data('id_radicado');
		var IdRuta     = $(this).data('id_ruta');
		var Archivo    = $(this).data('archivo');
		
		swal({
			title: "Eliminar radicado?",
			text: "¿Desea eliminar el radicado "+IdRadicado+"?",
			type: "warning",
			showCancelButton: true,
			cancelButtonText: "No",
			confirmButtonColor: '#DD6B55',
			confirmButtonText: "¡Si, Eliminar!",
			closeOnConfirm: false 
		},

		function(){
			$.ajax({
				url: 'accionesVentanillaRecibidas.php',
				type: 'POST',
				data: 'accion=ELIMINAR_RADICADO&id_radica='+IdRadicado,
				beforeSend: function(){
					$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
				},
				success:function(msj){
					if (msj == 1){
						$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El radicado se elimino correctamente. </div>');
						swal("Deleted!", "El radicado se elimino correctamente.", "success");
					}else{
						$("#DivAlertas").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> '+msj+'.</div>');
					}
				},
				error:function(msj){
					$("#DivAlertas").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
				}
			});
		});
	});

	$(document).on('click', '#BtnEliminarDocumentoDigital', function(event){

		var IdRadicado = $(this).data('id_radicado');
		var IdRuta     = $(this).data('id_ruta');
		var Archivo    = $(this).data('archivo');
		
		swal({ 
			title: "Eliminar digital?",
			text: "¿Desea eliminar el documento digital del radicado "+IdRadicado+"?",
			type: "warning",
			showCancelButton: true,
			cancelButtonText: "No",
			confirmButtonColor: '#DD6B55',
			confirmButtonText: "¡Si, Eliminar!",
			closeOnConfirm: false 
		},

		function(){
			$.ajax({
				url: 'accionesVentanillaRecibidas.php',
				type: 'POST',
				data: 'accion=ELIMINAR_DIGITAL&id_radica='+IdRadicado,
				beforeSend: function(){
					$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
				},
				success:function(msj){
					if (msj == 1){
						$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El archivo se elimino correctamente. </div>');

						$.ajax({
							url: '../../../varios/ftp.acciones.php',
							type: 'POST',
							data: 'accion=ELIMINAR_DIGITAL_RECIBIDO&id_radica='+IdRadicado+'&id_ruta='+IdRuta,
							beforeSend: function(){
								$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Eliminando archivo digital, por favor espere. </div>');
							},
							success:function(msj){
								if (msj == 1){
									$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El archivo se elimino correctamente. </div>');
									swal("Deleted!", "El archivo se elimino correctamente.", "success");
								}else{
									$("#DivAlertas").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> '+msj+'.</div>');
								}
							},
							error:function(msj){
								$("#DivAlertas").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
							}
						});
					}else{
						$("#DivAlertas").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> '+msj+'.</div>');
					}
				},
				error:function(msj){
					$("#DivAlertas").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
				}
			});
		});
	});

	//FUNCION PARA BORRAR UN RESPONSABLES
	$(document).on('click', '.borrar_destinatario', function(event){
		event.preventDefault();
		$(this).closest('tr').remove();
		$("#ChkDestinatarios" + $(this).data('id')).prop('checked', false);
	});

	//FUNCION PARA CARGAR LA INFORMACION DEL RADICADO
	$(document).on('click', '#BtnMostarInfoRadicadoRecibido', function(event){
		var IdRadicado = $(this).data('id_radicado');

		$('#DivRadicadoRecibido').html(IdRadicado)

		$.ajax({
			url: '../../varios/tab_radicado_recibido_info.php',
			type: 'POST',
			data: 'id_radica='+IdRadicado,
			beforeSend: function(){
				$("#alerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
			},
			success:function(msj){
				$("#alerta").empty();
				$("#DivMostarInfoRadicadoRecibidoInfo").html(msj);
			},
			error:function(msj){
				$("#alerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
			}
		});

		$.ajax({
			url: '../../varios/tab_radicado_recibido_clasificacion.php',
			type: 'POST',
			data: 'id_radica='+IdRadicado,
			beforeSend: function(){
				$("#alerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
			},
			success:function(msj){
				$("#alerta").empty();
				$("#DivMostarInfoRadicadoRecibidoClasificacion").html(msj);
			},
			error:function(msj){
				$("#alerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
			}
		});

		$.ajax({
			url: '../../varios/tab_radicado_recibido_documentos.php',
			type: 'POST',
			data: 'id_radica='+IdRadicado,
			beforeSend: function(){
				$("#alerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
			},
			success:function(msj){
				$("#alerta").empty();
				$("#DivMostarDocumentosRecibido").html(msj);
			},
			error:function(msj){
				$("#alerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
			}
		});

		$.ajax({
			url: '../../varios/tab_radicado_recibido_otra_info.php',
			type: 'POST',
			data: 'id_radica='+IdRadicado,
			beforeSend: function(){
				$("#alerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
			},
			success:function(msj){
				$("#alerta").empty();
				$("#DivOtraInfoRadicadoRecibido").html(msj);
			},
			error:function(msj){
				$("#alerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
			}
		});
	});

	//FUNCION PARA LLEVAR LOS RESPONSABLES
	$('#BtnLlevarDestinatarios').click(function (e){
		$("input[name='ChkDestinatarios[]']:checked").each(function (){
			if(!$('#TrDestinatarios'+$(this).val()).length){
				$('#TblDestinatarios tr:last').after('<tr id="TrDestinatarios'+$(this).val()+'"><td><div class="radio radio-success"><input type="radio" class="ojo" name="ChkFuncioRespon" id="ChkFuncioRespon'+$(this).val()+'" value="'+$(this).val()+'" data-id_responsable_dependencia="'+$(this).data('id_dependencia_destinatario')+'" data-id_responsable_oficina="'+$(this).data('id_oficina_destinatario')+'"><label for="ChkFuncioRespon'+$(this).val()+'">R</label></div></td><td>'+$(this).data('nombre_destinatario')+'</td><td>'+$(this).data('oficina_destinatario')+'</td><td><button class="borrar_destinatario btn btn-danger btn-sm btn-small" data-id="'+$(this).val()+'" ><i class="fa fa-trash-o"></i></button></td></tr>');
			}
		});
	});

	//FUNCION PARA CARGAR LA TRD DE LA DEPENDEICA DEL FUNCIONARIO ELEJIDO	
	$("body").on("change",".ojo",function(event){
		event.preventDefault();

		var IdDepen           = $(this).data('id_responsable_dependencia');
		var IdOficina         = $(this).data('id_responsable_oficina');
		var IncluirOficinaTRD = $('#incluir_oficina_trd').val();

		$('#id_depen').val(IdDepen);
		$('#id_oficina').val(IdOficina);

		$.post("../../../varios/combo_series.php", {
			id_depen: IdDepen,
			id_oficina: IdOficina,
			IncluirOficinaTRD: IncluirOficinaTRD
		}, function(data){
			$("#id_serie").html(data);
		});
	});

	//FUNCION PARA IMPRIMIR ROTULO
	$(document).on('click', '.ImprimirRotulo', function(event){

		if($('#tipo_impre_torulo').val() == 1){
			$("#ifrImprimirRotulo").attr("src","../../../reportes/ventanilla/rotulos/imprimir_rotulo_recibidas_tickect.php?id_radica="+$(this).data('id_radicado'));
		}else if($('#tipo_impre_torulo').val() == 2){
			$("#ifrImprimirRotulo").attr("src","../../../reportes/ventanilla/rotulos/imprimir_rotulo_recibidas_documento.php?id_radica="+$(this).data('id_radicado'));
		}

		$.ajax({
			url: 'accionesVentanillaRecibidas.php',
			type: 'POST',
			data: 'accion=IMPRIMIR_ROTULO&id_radica='+$(this).data('id_radicado'),
			success:function(data){
				if(data == 1){
					$('i[id=BtnImprimirRotulo'+$('#id_radicado').val()+']').removeClass('text-warning');
					$('i[id=BtnImprimirRotulo'+$('#id_radicado').val()+']').addClass('text-success');
				}else{
					$('i[id=BtnImprimirRotulo'+$('#id_radicado').val()+']').removeClass('text-warning');
					$('i[id=BtnImprimirRotulo'+$('#id_radicado').val()+']').addClass('text-danger');
				}
			},
			error:function(data){
				sweetAlert("Oops...", data, "warning");
			}
		});
	});

	$('#BtnNuevoTerceroJuridico').click(function(e){
		$.post("../../../varios/combo_Empresas.php",{
		}, function(data){
			$("#multi").html(data);
		});
	});

	//LIMPIAR LA FECHA DE VENCIEMIENTO CUANDO NO REQUIERE RESPUESTA
	$("#chkTerms").change(function(){
		var Respues = $("#chkTerms").prop("checked") ? true : false
		if(Respues == false){
			$('#fec_venci').val('');
		}
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
				$.post("../../../varios/combo_sub_series.php", {
					id_serie: $(this).val(),
					id_depen: $('#id_depen').val(),
					id_oficina: $('#id_oficina').val(),
					IncluirOficinaTRD: $('#incluir_oficina_trd').val()
				}, function(data){
					$("#id_subserie").html(data);
				});
			});
		}
	});

	$("#id_subserie").change(function () {
		$("#id_subserie option:selected").each(function () {
			var id_serie = $("#id_serie").val();
			var id_sub_serie = $(this).val();

			$.post("../../../varios/combo_tipos_documentos.php", {
				accion: $('#accion').val(),
				id_depen: $('#id_depen').val(),
				id_serie: id_serie,
				id_sub_serie: id_sub_serie
			}, function (data) {
				$("#id_tipodoc").html(data);
			});
		});
	});

	//FUNCIONES PARA ESTABLCER EL ID DEL RADICADO PARA AGREGAR
	//EL ARCHIVO DIGITAL E IMPRIMIR EL ROTULO
	$(document).on('click', '.idradicado', function(event){
		$('#id_radicado').val($(this).data('id_radicado'));
	});

	$(document).on('click', '.ImprimirRotulo', function(event){
		$('#id_radicado').val($(this).data('id_radicado'));
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

	$('#BtnBuscarTerceroNatural').click(function(e){
		$("#TxtBusTerceroNaturales").focus();
	});

	//FUNCION PARA BUSCAR EL TERCERO NATURAL
	$("#TxtBusTerceroNaturales").keyup(function(e){
		if (e.which == 13) {
			if($("#TxtBusTerceroNaturales").val() === ""){
				$("#DivAlertasTerceroNaturales").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta ingresar el criterio de busqueda</div>')
				$("#DivAlertaTerceroJutidico").load("../../../../config/mensajes.php", {alerta:3,mensaje:'Te hizo falta al empresa del contacto.'} ,function(){});
				$("#TxtBusTerceroNaturales").focus();
			}else{
				$.ajax({
					url: '../../varios/listar_tercero_natural.php',
					type: 'POST',
					data: 'criterio='+$("#TxtBusTerceroNaturales").val(),
					beforeSend: function(){
						$("#DivAlertasTerceroNaturales").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
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
		$('#cc_nit').val($(this).data('num_docu_tercero_natural'));
		$('#remite_contacto').val($(this).data('nombre_tercero_natural'));
		$('#DivRemiteRazoSoci').hide();
		$('#remite_dir').val($(this).data('direccion_tercero_natural'));
		$('#remite_tel').val($(this).data('telefono_tercero_natural'));
		$('#remite_cel').val($(this).data('celular_tercero_natural'));
	});

	$('#BtnBuscarTerceroJuridico').click(function(e){
		$("#TxtBusTerceroJuridicos").focus();
	});

	//FUNCION PARA BUSCAR EL TERCERO JURIDICO
	$("#TxtBusTerceroJuridicos").keyup(function(e){
		if(e.which == 13) {
			if($("#TxtBusTerceroJuridicos").val() === ""){
				$("#DivAlertasTerceroJuridicos").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta ingresar el criterio de busqueda.</div>');
				$("#DivAlertaTerceroJutidico").load("../../../../config/mensajes.php", {alerta:3,mensaje:'Te hizo falta al empresa del contacto.'} ,function(){});
				$("#TxtBusTerceroJuridicos").focus();
			}else{
				$.ajax({
					url: '../../varios/listar_tercero_juridico.php',
					type: 'POST',
					data: 'criterio='+$("#TxtBusTerceroJuridicos").val(),
					beforeSend: function(){
						$("#DivAlertasTerceroJuridicos").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
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
		$('#id_tercero').val($(this).data('id_tercero_juridico'));
		$('#cc_nit').val($(this).data('nit_tercero_juridoc'));
		$('#remite_contacto').val($(this).data('contacto_tercero_juridico'));
		$('#DivRemiteRazoSoci').show();
		$('#remite_razo_soci').val($(this).data('entidad_tercero_juridoc'));
		$('#remite_dir').val($(this).data('direccion_tercero_juridico'));
		$('#remite_tel').val($(this).data('telefono_tercero_juridico'));
		$('#remite_cel').val($(this).data('celular_tercero_juridico'));
	});

	$('#BtnReportCorrespondenPorVencer').click(function(){
		var url = '../../../reportes/ventanilla/pendientes/por_vencer_recibidos_excel.php';
		window.open(url);
	});

	$('#BtnReportCorresPorDigital').click(function(){
		var url = '../../../reportes/ventanilla/pendientes/por_digital_recibidos_excel.php';
		window.open(url);
	});
});