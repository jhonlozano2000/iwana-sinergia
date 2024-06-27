$(document).ready(function(){
	
	$('#BtnRadicar').click(function(event){
		event.preventDefault();

		var QuienesFirma   = new Array();
		var Responsables   = new Array();
		var Proyectores    = new Array();
		var HayQuienFirma  = false;
		var HayResponsable = false;

		if($('input[name="ChkFuncioQuienFirma"]').is(':checked')){
			HayQuienFirma = true;
		}else{
			HayQuienFirma = false;
		}
		
		if($('input[name="ChkFuncioRespon"]').is(':checked')){
			HayResponsable = true;
		}else{
			HayResponsable = false;
		}

		$("input[name=ChkFuncioQuienFirma]").each(function (index){  
			QuienesFirma.push($(this).val());
		});

		$("input[name=ChkFuncioRespon]").each(function (index){  
			Responsables.push($(this).val());
		});

		$("input[name=ChkProyectores]").each(function (index){  
			Proyectores.push($(this).val());
		});

		if ($('#fec_docu').val() == ""){
			sweetAlert("Oops...", "Te hizo falta la fecha del documento!", "warning");
			$('#fec_docu').focus();
		}else if ($('#num_folio').val() == '') {
			sweetAlert("Oops...", "Te hizo falta el numéro de folios del documento!", "warning");
			$('#num_folio').focus();
		}else if ($('#num_anexos').val() != ""  && $('#observa_anexo').val() === '') {
			sweetAlert("Oops...", "Te hizo falta la observación de los anexos!", "warning");
			$('#num_anexos').focus();
		}else if ($('#asunto').val() == ""){
			sweetAlert("Oops...", "Te hizo falta el asunto de la correspondencia!", "warning");
			$('#asunto').focus();
		}else if (HayQuienFirma === false) {
			sweetAlert("Oops...", "Debe establecer quien o quienes firman la correspondencia!", "warning");
		}else if (HayResponsable === false) {
			sweetAlert("Oops...", "Debe establecer el responsable de la correspondencia!", "warning");
		}else if ($('#id_destina').val() == ""){
			sweetAlert("Oops...", "Te hizo falta el destinatario de la correspondencia!", "warning");
		}else if ($('#id_forma_salida').val() == 0){
			sweetAlert("Oops...", "Te hizo falta la tipo de enviados de la correspondencia!", "warning");
			$('#id_forma_salida').focus();
		}else if ($('#id_tipo_respue').val() == 0){
			sweetAlert("Oops...", "Te hizo falta el tipo de respuesta!", "warning");
			$('#id_tipo_respue').focus();
		}else if ($('#incluir_trd').val() == 1 && $('#id_serie').val() == 0){
			sweetAlert("Oops...", "Te hizo falta la Serie de la clasificación documental de la correspondencia!", "warning");
			$('#id_serie').focus();
		}else if ($('#incluir_trd').val() == 1 && $('#id_subserie').val() == 0){
			sweetAlert("Oops...", "Te hizo falta la Subserie de la clasificación documental de la correspondencia!", "warning");
			$($('#incluir_trd').val() == 1 && '#id_subserie').focus();
		}else if ($('#id_tipodoc').val() == 0){
			sweetAlert("Oops...", "Te hizo falta el tipo documental de la clasificación documental de la correspondencia!", "warning");
			$('#id_tipodoc').focus();
		}else{
			
			$("#multi").each(function(){
				$("#multi option").attr("selected", "selected"); 
			});

			$.ajax({
				url: 'acciones.ajax.php',
				type: 'POST',
				data: 'accion=GUARDAR_RADICADO&id_serie='+$('#id_serie').val()+'&id_subserie='+$('#id_subserie').val()+'&id_tipodoc='+$('#id_tipodoc').val()+'&id_forma_salida='+$('#id_forma_salida').val()+'&id_destina='+$('#id_destina').val()+'&fec_docu='+$('#fec_docu').val()+'&asunto='+$('#asunto').val()+'&num_folio='+$('#num_folio').val()+'&num_anexos='+$('#num_anexos').val()+'&observa_anexo='+$('#observa_anexo').val()+'&QuienesFirma='+QuienesFirma+'&QuienFirmaPrincipal='+$('input:radio[name=ChkFuncioQuienFirma]:checked').val()+'&Responsables='+Responsables+'&Responsable='+$('input:radio[name=ChkFuncioRespon]:checked').val()+'&RadicadoParaResponder='+$('#multi').val()+'&num_guia='+$('#num_guia').val()+"&incluir_trd="+$('#incluir_trd').val()+'&Proyectores='+Proyectores+'&opcion_relacion='+$('#opcion_relacion').val()+'&opcion_titulo='+$('#opcion_titulo').val()+'&opcion_sub_titulo='+$('#opcion_sub_titulo').val()+'&opcion_detalle1='+$('#opcion_detalle1').val()+'&opcion_detalle2='+$('#opcion_detalle2').val()+'&opcion_detalle3='+$('#opcion_detalle3').val()+'&id_tipo_respue='+$('#id_tipo_respue').val(),
				beforeSend: function(){
					$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
				},
				success:function(msj){
					if ( msj == 1 ){
						$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El registro se almaceno correctamente. </div>');
						
						setTimeout(function () {
							window.location.href = "index.php";
						}, (200));
						
					}else{
						sweetAlert("Oops...", msj, "warning");
					}
				},
				error:function(){
					sweetAlert("Oops...", "Ha ocurrido un error durante la ejecución", "error");
				}
			});
		}
		return false;
	});

	//FUNCION PARA BORRAR QUIEN FIRMA
	$(document).on('click', '.borrar_quien_firma', function(event){
		event.preventDefault();
		$(this).closest('tr').remove();
		$("#ChkQuienFirma"+$(this).data('id')).attr('checked', false);
	});

	//FUNCION PARA LLEVAR QUIEN FIRMA
	$('#BtnLlevarQuienFirma').click(function(e){
		$("input[name='ChkQuienFirma[]']:checked").each(function (){
			if(!$('#TblQuienFirma'+$(this).val()).length){
				$('#TblQuienFirma tr:last').after('<tr id="TblQuienFirma'+$(this).val()+'"><td><div class="radio radio-success"><input type="radio" class="dependencia_quien_firma" name="ChkFuncioQuienFirma" id="ChkFuncioQuienFirma'+$(this).val()+'" value="'+$(this).val()+'" data-id_quien_firma_dependencia="'+$(this).data('id_dependencia_quien_firma')+'" data-id_quien_firma_oficina="'+$(this).data('id_oficina_quien_firma')+'"><label for="ChkFuncioQuienFirma'+$(this).val()+'">'+$(this).data('nombre_quien_firma')+'</label></div></td><td>'+$(this).data('oficina_quien_firma')+'</td><td><button class="borrar_quien_firma btn btn-danger btn-sm btn-small" data-id="'+$(this).val()+'" ><i class="fa fa-trash-o"></i></button></td></tr>');
			}
		});
	});

	//FUNCION PARA BORRAR UN RESPONSABLES
	$(document).on('click', '.borrar_responsables', function(event){
		event.preventDefault();
		$(this).closest('tr').remove();
		$("#ChkResponsables"+$(this).data('id')).attr('checked', false);
	});

	//FUNCION PARA LLEVAR LOS RESPONSABLES
	$('#BtnLlevarResponsables').click(function(e){
		$("input[name='ChkResponsables[]']:checked").each(function (){
			if(!$('#TblResponsales'+$(this).val()).length){
				$('#TblResponsales tr:last').after('<tr id="TblResponsales'+$(this).val()+'"><td><div class="radio radio-success"><input type="radio" class="dependencia_del_responsable" name="ChkFuncioRespon" id="ChkFuncioRespon'+$(this).val()+'" value="'+$(this).val()+'" data-id_responsable_dependencia="'+$(this).data('id_dependencia_responsables')+'" data-id_responsable_oficina="'+$(this).data('id_oficina_responsables')+'"><label for="ChkFuncioRespon'+$(this).val()+'">'+$(this).data('nombre_responsables')+'</label></div></td><td>'+$(this).data('oficina_responsables')+'</td><td><button class="borrar_responsables btn btn-danger btn-sm btn-small" data-id="'+$(this).val()+'" ><i class="fa fa-trash-o"></i></button></td></tr>');
			}
		});
	});

	//FUNCION PARA BORRAR UN PROYECTOR
	$(document).on('click', '.borrar_proyector', function(event){
		event.preventDefault();
		$(this).closest('tr').remove();
		$("#ChkResponsables"+$(this).data('id')).attr('checked', false);
	});

	//FUNCION PARA LLEVAR LOS PROYECTORES
	$('#BtnLlevarProyector').click(function(e){
		$("input[name='ChkProyectores[]']:checked").each(function (){
			if(!$('#TblProyectores'+$(this).val()).length){
				$('#TblProyectores tr:last').after('<tr id="TblProyectores'+$(this).val()+'"><td><div class="radio radio-success"><input type="radio" class="dependencia_del_proyector" name="ChkProyectores" id="ChkProyectores'+$(this).val()+'" value="'+$(this).val()+'" data-proyector_dependencia="'+$(this).data('dependencia_proyector')+'"><label for="ChkProyectores'+$(this).val()+'">'+$(this).data('nombre_proyector')+'</label></div></td><td>'+$(this).data('oficina_proyector')+'</td><td><button class="borrar_proyector btn btn-danger btn-sm btn-small" data-id="'+$(this).val()+'" ><i class="fa fa-trash-o"></i></button></td></tr>');
			}
		});
	});

	//FUNCION PARA CARGAR LA TRD DE LA DEPENDEICA DEL FUNCIONARIO ELEJIDO	
	$("body").on("change",".dependencia_del_responsable",function(event){
		event.preventDefault();

		var IdDepen           = $(this).data('id_responsable_dependencia');
		var IdOficina         = $(this).data('id_responsable_oficina');
		var IncluirOficinaTRD = $('#incluir_oficina_trd').val();

		$('#id_depen').val(IdDepen);
		$.post("../../../varios/combo_series.php", {
			id_depen: IdDepen,
			id_oficina: IdOficina,
			IncluirOficinaTRD: IncluirOficinaTRD
		}, function(data){
			$("#id_serie").html(data);
		});
	});

	//FUNCIONES PARA ESTABLCER EL ID DEL RADICADO PARA AGREGAR
	//EL ARCHIVO DIGITAL E IMPRIMIR EL ROTULO
	$(document).on('click', '#BtnAdjunarDigital', function(event){
		$('#IdRadicado').val($(this).data('id_radicado'));
		$('#id_depen').val($(this).data('id_dependencia'));
		$('#id_radicado').val($(this).data('id_radicado'));
	});

	$(document).on('click', '.ImprimirRotulo', function(event){
		$('#IdRadicado').val($(this).data('id_radicado'));
		$('#id_depen').val($(this).data('id_dependencia'));
		$('#id_radicado').val($(this).data('id_radicado'));
	});

	//FUNCION PARA IMPRIMIR ROTULO
	$(document).on('click', '.ImprimirRotulo', function(event){

		if($('#tipo_impre_torulo').val() == 1){
			$("#ifrImprimirRotulo").attr("src","../../../reportes/ventanilla/rotulos/imprimir_rotulo_enviada_tickect.php?id_radica="+$(this).data('id_radicado'));
		}else{
			$("#ifrImprimirRotulo").attr("src","../../../reportes/ventanilla/rotulos/imprimir_rotulo_enviada_documento.php?id_radica="+$(this).data('id_radicado'));
		}

		$.ajax({
			url: 'acciones.ajax.php',
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
			error:function(){
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
				if(msj == 1){
					$('#BtnCancelarSubirDigital').click();
					$("#DivAlertarAdjuntoDigital").empty();
					$('#ifrVisualizaArchivo').attr('src', '')
				}else{
					sweetAlert("Oops...", msj, "error");
				}
			},
			warning:function(msj){
				sweetAlert("Oops...", msj, "error");
			}
		});		
	});

	//FUNCION PARA CARGAR LA INFORMACION DEL RADICADO
	$(document).on('click', '#BtnMostarInfoRadicadoEnviado', function(event){
		
		var IdRadicado = $(this).data('id_radicado');

		$('#DivRadicadoEnviado').html(IdRadicado)

		$.ajax({
			url: '../../varios/tab_radicado_enviado_info.php',
			type: 'POST',
			data: 'id_radica='+IdRadicado,
			beforeSend: function(){
				$("#alerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
			},
			success:function(msj){
				$("#alerta").empty();
				$("#DivMostarInfoRadicadoEnviado").html(msj);
			},
			error:function(msj){
				$("#alerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
			}
		});

		$.ajax({
			url: '../../varios/tab_radicado_enviado_clasificacion.php',
			type: 'POST',
			data: 'id_radica='+IdRadicado,
			beforeSend: function(){
				$("#alerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
			},
			success:function(msj){
				$("#alerta").empty();
				$("#DivMostarInfoRadicadoEnviadoClasificacion").html(msj);
			},
			error:function(msj){
				$("#alerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
			}
		});

		$.ajax({
			url: '../../varios/tab_radicado_enviado_documentos.php',
			type: 'POST',
			data: 'id_radica='+IdRadicado,
			beforeSend: function(){
				$("#alerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
			},
			success:function(msj){
				$("#alerta").empty();
				$("#DivMostarDocumentosEnviado").html(msj);
			},
			error:function(msj){
				$("#alerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
			}
		});
	});

	$(document).on('click', '#BtnDescargarArchivoEnviado', function(event){

		var Archivo = $(this).data('archivo');

		if($("#id_ruta").val() == 0){
			sweetAlert("Oops...", "El radicado no tiene el documento digital, por favor adjunte el documento digitalizado!", "warning");
		}else{
			$.ajax({
				url: '../../../varios/ftp.acciones.php',
				type: 'POST',
				data: 'accion=ENVIADOS_DESCARGAR&id_radicado='+$("#id_radica").val()+'&id_ruta='+$("#id_ruta").val(),
				beforeSend: function(){
					$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
				},
				success:function(msj){
					$("#DivAlertas").empty();
					if(msj == 1){
						url = "../../../../archivos/temp/enviados/"+Archivo;
						window.open(url, 'Download');
					}else{
						sweetAlert("Oops...", msj, "error");
					}
				},
				error:function(error){
					sweetAlert("Oops...", error, "error");
				}
			});
		}
	});

	$('#BtnBuscarDestinatarioNatural').click(function(e){
		$("#TxtBusDestinaNaturales").focus();
	});

	//FUNCION PARA BUSCAR EL TERCERO NATURAL
	$("#TxtBusDestinaNaturales").keyup(function (e) {
		if (e.which == 13) {
			if($("#TxtBusDestinaNaturales").val() === ""){
				$("#DivAlertasDestinaNaturales").load("../../../config/funciones.php",{alerta:3,mensaje:'Te hizo falta ingresar el criterio de busqueda'},function(){});
				$("#TxtBusDestinaNaturales").focus();
			}else{
				$.ajax({
					url: '../../varios/listar_tercero_natural.php',
					type: 'POST',
					data: 'criterio='+$("#TxtBusDestinaNaturales").val(),
					beforeSend: function(){
						$("#DivAlertasDestinaNaturales").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
					},
					success:function(msj){
						$("#DivAlertasDestinaNaturales").empty();
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
	$(document).on('click', '#BtnLlevarTerceroNatural', function(event){
		$('#id_destina').val($(this).data('id_tercero_natural'));
		$('#cc_nit').val($(this).data('num_docu_tercero_natural'));
		$('#destina_contacto').val($(this).data('nombre_tercero_natural'));
		$('#DivRemiteRazoSoci').hide();
		$('#destina_dir').val($(this).data('direccion_tercero_natural'));
		$('#destina_tel').val($(this).data('telefono_tercero_natural'));
		$('#destina_cel').val($(this).data('celular_tercero_natural'));
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
					url: '../../varios/listar_tercero_juridico.php',
					type: 'POST',
					data: 'criterio='+$("#TxtBusDestinaJuridicos").val(),
					beforeSend: function(){
						$("#DivAlertasDestinaJuridicos").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
					},
					success:function(msj){
						$("#DivAlertasDestinaJuridicos").empty();
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
	$(document).on('click', '#BtnLlevarTerceroJuridico', function(event){
		$('#id_destina').val($(this).data('id_tercero_juridico'));
		$('#cc_nit').val($(this).data('nit_tercero_juridoc'));
		$('#destina_contacto').val($(this).data('contacto_tercero_juridico'));
		$('#DivRemiteRazoSoci').show();
		$('#destina_razo_soci').val($(this).data('entidad_tercero_juridoc'));
		$('#destina_dir').val($(this).data('direccion_tercero_juridico'));
		$('#destina_tel').val($(this).data('telefono_tercero_juridico'));
		$('#destina_cel').val($(this).data('celular_tercero_juridico'));
	});

	$('#BtnNuevoTerceroJuridico').click(function(e){
		$.post("../../../varios/combo_Empresas.php", {
		}, function(data){
			$("#id_empre_juridico").html(data);
		});
	});

	$("#id_serie").change(function () {
		
		var Responsables = new Array();
		var HayResponsable = false;

		$("input[name='ChkResponsables[]']:checked").each(function () {
			Responsables.push($(this).val());
		});

		if(!$('input[name="ChkFuncioRespon"]').is(':checked')){
			HayResponsable = true;
		}else{
			HayResponsable = false;
		}
		
		if(Responsables === ""){
			sweetAlert("Oops...", "Te hizo falta el o los responsables de la correspondencia!", "warning");
			$('#BtnBuscarDestinatario').click();
		}else if (!$('input[name="ChkFuncioRespon"]').is(':checked')) {
			sweetAlert("Oops...", "Debe establecer el responsable de la correspondencia!", "warning");
		}else{
			$("#id_serie option:selected").each(function () {
				$.post("../../../varios/combo_sub_series.php", {
					id_serie: $(this).val(),
					id_depen: $('#id_depen').val()
				}, function (data) {
					$("#id_subserie").html(data);
				});
			});
		}
	});

	$("#id_subserie").change(function () {
		$("#id_subserie option:selected").each(function(){
			var id_serie = $("#id_serie").val();
			var id_sub_serie = $(this).val();

			$.post("../../../varios/combo_tipos_documentos.php",{
				accion: $('#accion').val(),
				id_depen: $('#id_depen').val(),
				id_serie: id_serie,
				id_sub_serie: id_sub_serie
			}, function(data){
				$("#id_tipodoc").html(data);
			});
		});
	});

	$('#BtnGuardarTerceroNatural').click(function(){
		if($('#nom_contac').val() == ""){
			$("#DivAlertaTerceroNatural").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a>. Te hizo falta el nombre del contacto</div>');
			$('#nom_contac').focus();
		}else if($('#id_depar_natural').val() == 0){
			$("#DivAlertaTerceroNatural").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a>. Te hizo falta el departamento de recidencia del contacto</div>');
			$('#id_depar_natural').focus();
		}else if($('#id_muni_natural').val() == 0){
			$("#DivAlertaTerceroNatural").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a>. Te hizo falta el municipio de recidencia del contacto</div>');
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
					$("#DivAlertaTerceroNatural").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
				},
				success:function(msj){
					if (msj.substring(0, 8) === 'IdRemite'){
						$("#DivAlertaTerceroNatural").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El registro se almaceno correctamente. </div>');
						$('#id_tercero').val(msj.substring(8, msj.length))
						$('#cc_nit').val($('#num_docu_natural').val());
						$('#destina_contacto').val($('#nom_contac_natural').val());
						$('#DivRemiteRazoSoci').hide();
						$('#destina_dir').val($('#dir_natural').val());
						$('#destina_tel').val($('#tel_natural').val());
						$('#destina_cel').val($('#cel_natural').val());

						$("#FrmDatosTerceroNatural")[0].reset();

						$('#BtnCancelarTerceroNatural').click();
						$("#DivAlertaTerceroNatural").empty();
					}else{
						$("#DivAlertaTerceroNatural").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> '+msj+'</div>');
					}
				},
				error:function(msj){
					$("#DivAlertaTerceroNatural").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
				}
			});
		}
	});

	$('#BtnGuardarTerceroJutidico').click(function(){
		if ($('#nom_contac_juridico').val() == ""){
			$("#DivAlertaTerceroJutidico").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el nombre del contacto</div>')
			$('#nom_contac_juridico').focus();
		}else if ($('#multi').val() == 0){
			$("#DivAlertaTerceroJutidico").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta al empresa del contacto</div>')
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
					$("#DivAlertaTerceroJutidico").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
				},
				success:function(msj){
					var Elementos = msj.split('-');
					if (Elementos[0]  == 1){
						$('#id_tercero').val(Elementos[1]);
						$('#cc_nit').val(Elementos[2]);
						$('#destina_contacto').val(Elementos[3]);
						$('#destina_razo_soci').val(Elementos[4]);
						$('#DivRemiteRazoSoci').show();
						$('#destina_dir').val(Elementos[5]);
						$('#destina_tel').val(Elementos[6]);
						$('#destina_cel').val(Elementos[7]);

						$("#FrmDatosTerceroJuridico")[0].reset();
						$('#BtnCancelarTerceroJutidico').click();
						$("#DivAlertaTerceroJutidico").empty();
					}else{
						$("#DivAlertaTerceroJutidico").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> '+msj+'</div>');
					}
				},
				error:function(){
					$("#DivAlertaTerceroJutidico").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
				}
			});
		}
	});

	//FUNCION PARA GUARDAR TERCERO JURIDICO CON NUEVA EMPRESA
	$('#BtnGuardarTerceroJutidicoConEmpresa').click(function(){
		if($('#nit').val() == ""){
			$("#DivAlertaTerceroJutidicoConEmpresa").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el Nit. de la empresa del contacto.</div>');
			$('#nit').focus();
		}else if($('#razo_soci').val() == ""){
			$("#DivAlertaTerceroJutidicoConEmpresa").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta la Razon Social de la empresa del contacto.</div>');
			$('#razo_soci').focus();
		}else if($('#id_depar_juridico_empresa').val() == 0){
			$("#DivAlertaTerceroJutidicoConEmpresa").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el departamento de la empresa del contacto.</div>');
			$('#id_depar_juridico_empresa').focus();
		}else if($('#id_muni_juridico_empresa').val() == 0){
			$("#DivAlertaTerceroJutidicoConEmpresa").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el municipio de la empresa del contacto.</div>');
			$('#id_muni_juridico_empresa').focus();
		}else if($('#nom_contac_juridico_empresa').val() == ""){
			$("#DivAlertaTerceroJutidicoConEmpresa").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta el nombre del contacto.</div>');
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
					$("#DivAlertaTerceroNatural").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
				},
				success:function(msj){
					alert(msj)
					if (msj.substring(0, 8) == 'IdRemite'){
						$("#DivAlertaTerceroJutidicoConEmpresa").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El registro se almaceno correctamente. </div>');
						$('#id_destina').val(msj.substring(8, msj.length-1));
						$('#cc_nit').val($('#nit').val());
						$('#destina_contacto').val($('#nom_contac_juridico_empresa').val());
						$('#DivRemiteRazoSoci').show();
						$('#destina_razo_soci').val($('#razo_soci').val());
						$('#destina_dir').val($('#dir_juridico_empresa').val());
						$('#destina_tel').val($('#tel_juridico_empresa').val());
						$('#destina_cel').val($('#cel_juridico_empresa').val());


						$("#FrmDatosTerceroJuridicoConEmpresa")[0].reset();

						$('#BtnCancelarTerceroJutidicoConEmpresa').click();
						$("#DivAlertaTerceroJutidicoConEmpresa").empty();
					}else{
						$("#DivAlertaTerceroJutidicoConEmpresa").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> '+msj+'</div>');
					}
				},
				error:function(){
					$("#DivAlertaTerceroJutidicoConEmpresa").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
				}
			});
		}
	});

	//LIMPIAR FORMULARIO DE TERCEROS NATURALES
	$('#BtnCancelarTerceroNatural').click(function(){
		$("#FrmDatosTerceroNatural")[0].reset();
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

	$('#BtnBuscarRadicadosRecibidos').click(function(e){
		$("#TxtBusRadicadosRecibidosParaRespuesta").focus();
	});

	//FUNCION PARA BUSCAR EL TERCERO NATURAL
	$("#TxtBusRadicadosRecibidosParaRespuesta").keyup(function (e) {
		if (e.which == 13) {
			if($("#TxtBusRadicadosRecibidosParaRespuesta").val() === ""){
				$("#DivAlertasRadicadosRecibidosParaRespuesta").load("../../../config/funciones.php",{alerta:3,mensaje:'Te hizo falta ingresar el criterio de busqueda'},function(){});
				$("#TxtBusRadicadosRecibidosParaRespuesta").focus();
			}else{
				$.ajax({
					url: '../../varios/listar_radicados_recibidos_para_respuesta.php',
					type: 'POST',
					data: 'criterio='+$("#TxtBusRadicadosRecibidosParaRespuesta").val(),
					beforeSend: function(){
						$("#DivAlertasRadicadosRecibidosParaRespuesta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
					},
					success:function(msj){
						$("#DivAlertasRadicadosRecibidosParaRespuesta").empty();
						if(msj != 1){
							$("#DivRadicadosRecibidosParaRespuesta").html(msj);
						}else{
							$("#DivRadicadosRecibidosParaRespuesta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> '+msj+'.</div>');
						}
					},
					error:function(msj){
						$("#DivAlertasRadicadosRecibidosParaRespuesta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
					}
				});
			}
		}
	});

	//FUNCION PARA LLEVAR EL DESTINATARIO NATURAL
	$(document).on('click', '#BtnLlevarRadicadoParaRespuesta', function(event){
		
		var Radicados = $(this).val()
		var IdRadicado = $(this).data('id_radica')

		$('#multi').append('<option value="'+$(this).data('id_radica')+'">'+$(this).data('id_radica')+' '+$(this).data('asunto')+'</option>');
		
		$.ajax({
			url: 'buscar_radicado_recibido.php',
			type: 'POST',
			dataType: "JSON",
			data: 'id_radica='+IdRadicado,
			success:function(msj){
				//DATOS DEL RADICADO
				var AsuntoFinal = ""
				if($('#multi').length === 1 ){
					AsuntoFinal = ' - En respuesta al radicado '+Radicados;
				}else{
					AsuntoFinal = ' - En respuesta a los radicados '+Radicados;
				}

				$('#asunto').val(msj[0]);
				$('#asunto').val($('#asunto').val()+AsuntoFinal);
				
				//DESTINATARIO
				$('#id_destina').val(msj[17]);			
				$('#destina_contacto').val(msj[19]);
				$('#destina_razo_soci').val(msj[25]);
				$('#destina_dir').val(msj[21]);
				$('#destina_tel').val(msj[22]);
				$('#destina_cel').val(msj[23]);
				
				if(msj[25] === ''){
					$('#DivRemiteRazoSoci').hide();
					$('#cc_nit').val(msj[18]);
				}else{
					$('#DivRemiteRazoSoci').show();
					$('#cc_nit').val(msj[24]);
				}

				//INICIO CARGUE LA SERIE Y SUBSERIE DEL DOCUMENTO DE ENTRADA
				if($("#incluir_trd").val() == 1){
					$.post("../../../varios/combo_series.php", {
						id_depen: msj[9]
					}, function (data) {
						$("#id_serie").html(data);
						$("#id_serie> option[value="+ msj[1] +"]").attr('selected', 'selected');
					});			
					
					$.post("../../../varios/combo_sub_series.php", {
						id_serie: msj[1],
						id_depen: msj[9]
					}, function (data) {
						$("#id_subserie").html(data);
						$("#id_subserie> option[value="+ msj[2] +"]").attr("selected","selected");
					});
					
					$.post("../../../varios/combo_tipos_documentos.php", {
						accion: '',
						id_depen: msj[9],
						id_serie: msj[1],
						id_sub_serie: msj[2]
					}, function (data) {
						$("#id_tipodoc").html(data);
					});
				}else{
					
					$.post("../../../varios/combo_tipos_documentos_sin_trd.php", {
						
					}, function (data) {
						$("#id_tipodoc").html(data);
					});
				}
				//FIN CARGUE LA SERIE Y SUBSERIE DEL DOCUMENTO DE ENTRADA

				//INICIO DE CARGUE DE LOS RESPONSABLES DE LA CORRESPONDENCIA
				if($('#multi').length === 1){
					
					$.ajax({
						url: 'listar_responsables_radicado_recibido.php',
						type: 'POST',
						dataType: 'JSON',
						data: 'id_radica='+IdRadicado,
						success:function(msj){

							var Chekeado = ""
							if(msj[0] === 1){
								Chekeado = 'checked';
							}else{
								Chekeado = "";
							}

							var EncontoResponsable = false;
							$('input[name=ChkFuncioRespon]:radio').each(function(){
								if($(this).val() == msj[0]){
									EncontoResponsable = true;
								}
							});

							if(EncontoResponsable === false){
								$('#TblResponsales tr:last').after('<tr id="TblResponsales'+msj[0]+'"><td><div class="radio radio-success"><input type="radio" class="dependencia_del_responsable" name="ChkFuncioRespon" id="ChkFuncioRespon'+msj[0]+'" value="'+msj[0]+'" data-id_responsable_dependencia="'+msj[5]+'" data-id_responsable_oficina="'+msj[9]+'" '+Chekeado+'><label for="ChkFuncioRespon'+msj[0]+'">'+msj[3]+' '+msj[4]+'</label></div></td><td>'+msj[10]+'</td><td><button class="borrar_responsables btn btn-danger btn-sm btn-small" data-id="'+msj[0]+'" ><i class="fa fa-trash-o"></i></button></td></tr>');
							}
							
						},
						error:function(error){
							sweetAlert("Oops...", "Ha ocurrido un error durante el cargue de los responsables." +error , "error");
						}
					});
				}
				//FUN DE CARGU DE LOS RESPONSABLES DE LA CORRESPONDENCIA
				$("#DivAlertas").empty();
			},
			error:function(error){
				sweetAlert("Oops...", "Ha ocurrido un error durante la ejecución" +error , "error");
			}
		});
	});

	$('#BtnReportCorresEnviadaPorDigital').click(function(){
		var url = '../../../reportes/ventanilla/pendientes/por_digital_enviados_excel.php';
		window.open(url)
	});
});