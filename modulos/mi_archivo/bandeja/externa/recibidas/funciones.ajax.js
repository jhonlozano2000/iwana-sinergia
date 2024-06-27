$(document).ready(function() {

	$(document).on('click', '#btnAutorizar', function (event){

		var IdRadicado = $(this).data("id_radicado");

		swal({
			title: "¿Desea desbloquear el radicado "+IdRadicado+"?",
			text: "Si lo desbloquea el responsable vera el documento.",
			type: "success",
			showCancelButton: true,
			cancelButtonText: "No",
			confirmButtonColor: "#468847",
			confirmButtonText: "¡si, desbloquear!",
			closeOnConfirm: false
		},
		function(){
			$.ajax({
				url: 'acciones.ajax.php',
				type: 'POST',
				data: 'accion=Desbloquear&id_radica='+IdRadicado,
				success:function(msj){
					if (msj == 1){
						swal("¡Desbloqueado!",
							"La correspondencia ha sido desbloqueada!.",
							"success");
						$('i[id=BtnCandado'+IdRadicado+']').removeClass('fa-lock');
					}else{
						$('#DivAlertas').html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> '+msj+'.</div>');
					}
				},
				error:function(msj){
					$("#DivAlertas").html('<div class="alert alert-danger alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Ha ocurrido un error durante la ejecución, '+msj+'.</div>');
				}
			});
		});
	});

	$(document).on('click', '#TipoVer', function (event){
		$('#tipo_ver').val($(this).data('tipo_ver'));
		load(1)
	});

	$(document).on('click', '#BtnMostarInfoRadicadoRecibido', function(event){

		var IdRadicado = $(this).data('id_radicado');

		$('#DivRadicadoRecibido').html(IdRadicado);

		$.ajax({
			url: '../../../../ventanilla/varios/tab_radicado_recibido_info.php',
			type: 'POST',
			data: 'id_radica='+IdRadicado,
			beforeSend: function(){
				$("#alerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
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
			url: '../../../../ventanilla/varios/tab_radicado_recibido_clasificacion.php',
			type: 'POST',
			data: 'id_radica='+IdRadicado,
			beforeSend: function(){
				$("#alerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
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
			url: '../../../../ventanilla/varios/tab_radicado_recibido_documentos.php',
			type: 'POST',
			data: 'id_radica='+IdRadicado,
			beforeSend: function(){
				$("#alerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
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
			url: '../../../../ventanilla/varios/tab_radicado_recibido_otra_info.php',
			type: 'POST',
			data: 'id_radica='+IdRadicado,
			beforeSend: function(){
				$("#alerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
			},
			success:function(msj){
				$("#alerta").empty();
				$("#DivOtraInfoRadicadoRecibido").html(msj);
			},
			error:function(msj){
				$("#alerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
			}
		});

		$.ajax({
			url: 'acciones.ajax.php',
			type: 'POST',
			data: 'accion=MARCAR_LEIDO&id_radica'+IdRadicado,
			beforeSend: function(){
			},
			success:function(msj){
			},
			error:function(msj){
			}
		});
	});

	$(document).on('click', '#BtnResponderCorrespondencia', function (event){

		var IdRadicado = $(this).data('id_radicado');

		window.location="../responder/index.php?id_radica="+IdRadicado;
	});

	$(document).on('click', '#BtnPasarParaCompartir', function (event){

		var IdFuncioDeta = $(this).data('id_funcio');
		var NomFuncio    = $(this).data('nom_funcio');
		var DepenFuncio  = $(this).data('depen_funcio');

		if(!$('#TrFuncioDestino'+$(this).val()).length){
			$('#TblFuncioDestino tr:last').after('<tr id="TrFuncioDestino'+IdFuncioDeta+'"><td><input type="hidden" name="FuncionariosDestino[]" id="FuncionariosDestino'+IdFuncioDeta+'" value="'+IdFuncioDeta+'">'+NomFuncio+'</td><td>'+DepenFuncio+'</td><td><button class="borrar_funcionario_destino btn btn-danger btn-sm btn-small" data-id="'+IdFuncioDeta+'" ><i class="fa fa-trash-o"></i></button></td></tr>');
		}
	});

	$(document).on('click', '#BtnCompartirRadicado', function (event){
		$('#DivRadicadoParaCompartir').html($(this).data('id_radicado'));
		$('#id_radica').val($(this).data('id_radicado'));
	});

	$(document).on('click', '.borrar_funcionario_destino', function(event){
		event.preventDefault();
		$(this).closest('tr').remove();
	});

	$(document).on('click', '#BtnTerminarCompartir', function (event){

		var FuncionariosDestino  = new Array();

		$("input[name='FuncionariosDestino[]']").each(function(indice, elemento) {
			FuncionariosDestino.push($(this).val());
		});

		$.ajax({
			url: 'acciones.ajax.php',
			type: 'POST',
			data: 'accion=COMPARTIR&id_radica='+$("#id_radica").val()+'&funcio_para_compartir='+FuncionariosDestino,
			beforeSend: function(){
				$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
			},
			success:function(msj){
				if(msj == 1){
					$("#DivAlertas").load("../../../../../config/mensajes.php", {alerta:4,mensaje:'El radicado '+$("#id_radica").val()+' se compartió correctamente.'} ,function(){});
				}else{
					$("#DivAlertas").load("../../../../../config/mensajes.php", {alerta:3,mensaje:msj} ,function(){});
				}
			},
			error:function(error){
				sweetAlert("Oops...", error, "error");
			}
		});
	});

	$(document).on('click', '#BtnDescargarPdfRecibido', function(event){
		if($("#id_ruta").val() == 0){
			sweetAlert("Oops...", "El radicado no tiene el documento digital, por favor adjunte el documento digitalizado!", "warning");
		}else{
			$.ajax({
				url: '../../../../varios/ftp.acciones.php',
				type: 'POST',
				data: 'accion=RECIBIDOS_DESCARGAR&id_radicado='+$("#id_radica").val()+'&id_ruta='+$("#id_ruta").val()+'&RutaDonwload='+$("#RutaDonwload").val(),
				beforeSend: function(){
					$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
				},
				success:function(msj){
					$("#DivAlertas").empty();
					if(msj == 1){
						window.open("../../../../../archivos/temp/recibidos/"+$("#id_radica").val()+".pdf", '_blank');
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

	$(document).on('click', '#BtnDescargarArchivoRecibido', function(event){

		var IdRadicado = $(this).data("id_radicado");
		var Archivo = $(this).data("archivo");
		var IdRuta = $(this).data("id_ruta");

		if(IdRuta == 0){
			sweetAlert("Oops...", "El radicado no tiene el documento digital, por favor adjunte el documento digitalizado!", "warning");
		}else{
			$.ajax({
				url: '../../../../varios/ftp.acciones.php',
				type: 'POST',
				data: 'accion=RECIBIDOS_DESCARGAR&id_radicado='+IdRadicado+'&id_ruta='+IdRuta,
				beforeSend: function(){
					$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
				},
				success:function(msj){
					$("#DivAlertas").empty();
					if(msj == 1){
						window.open("../../../../../archivos/temp/recibidos/"+Archivo, '_blank');
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

	$(document).on('click', '#BtnDelegarGrupoColaborativo', function (e){
		$('#id_radica').val($(this).data('id_radicado'))
	});

	$(document).on('click', '#BtnAsignarFuncionarioParCrearGrupoColaborativo', function(event){

		var Funcionario =$(this).data("funcionario")

		$('#DivTituloGrupoColaborativo').val(Funcionario)
		$('#id_funcio_deta').val($(this).data("id_funcio_deta"))
	});

	$(document).on('click', '#BtnGuardarGrupoColaborativo', function(event){

		var IdRadica             = $('#id_radica').val();
		var Funcionario          = $(this).data("funcionario");
		var IdFuncioDeta         = $('#id_funcio_deta').val();

		$('#DivTituloGrupoColaborativo').val(Funcionario)

		$.ajax({
			url: '../pendientes_tramite/acciones.ajax.php',
			type: 'POST',
			data: 'accion=ASIGNAR_FUNCIONARIO_PARA_CREAR_GRUPO_COLABORATIVO&id_radica='+IdRadica+'&IdFuncioDeta='+IdFuncioDeta+'&observa_grupo_colaborativo='+$('#observa_grupo_colaborativo').val(),
			beforeSend: function(){
				$("#DivAlerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
			},
			success:function(msj){
				if(msj == 1){
					$("#DivAlerta").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El registro se actualizo correctamente. </div>');
					swal("¡Asingnación de la creacion de grupo colaborativo!.",
						"La asingnación de la creacion del grupo colaborativo a el funcionario "+Funcionario+" ha sido exítosa");
				}else{
					$("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> '+msj+'.</div>');
					swal("¡Asingnación de la creacion de grupo colaborativo!.",
						msj);
				}

				$('#BtnCerrarGrupoColaborativo').click();
				$('#BtnCerrarModalFuncionarios').click();
			},
			error:function(msj){
				$("#DivAlerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
			}
		});
	});

	$(document).on('click', '#BtnPase', function (event){
		$('#id_radica').val($(this).data('id_radicado'))
	});

	$(document).on('click', '#BtnRealizarPase', function(event){

		var IdFuncioDestino = $(this).data("id_funcio_deta");
		var IdRadica        = $('#id_radica').val();
		Funcionario = $(this).data("funcionario");

		swal({
			title: "Realizar pase",
			text: "¿Desea pasar el radicado al funcionario: "+Funcionario+"?",
			type: "success",
			showCancelButton: true,
			cancelButtonText: "No",
			confirmButtonColor: "#468847",
			confirmButtonText: "¡si, pasar!",
			closeOnConfirm: false
		},

		function(){
			$.ajax({
				url: 'acciones.ajax.php',
				type: 'POST',
				data: 'accion=PASAR&id_radica='+IdRadica+'&id_funcio='+IdFuncioDestino,
				beforeSend: function(){
					$("#DivAlerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
				},
				success:function(msj){
					if(msj == 1){
						$("#DivAlerta").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El registro se actualizo correctamente. </div>');
						swal("¡Pase!.",
							"Le pase al funcionario "+Funcionario+" ha sido exítosa");

						$("#TRRadicado"+IdRadica).remove();
					}else{
						$("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> '+msj+'.</div>');
						swal("¡Asingnación de la creacion de grupo colaborativo!.",
							msj);
					}

					$('#BtnCerrarModalFuncionarios').click();
				},
				error:function(msj){
					$("#DivAlerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
				}
			});
		});
	});

	$(document).on('click', '#BtnHispotialPase', function (event){

		var IdRadicado = $(this).data('id_radicado');

		$.ajax({
			url: 'listar_historial_pase.php',
			type: 'POST',
			data: 'id_radicado='+IdRadicado,
			beforeSend: function(){
				$("#DivListarHistoriaPase").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
			},
			success:function(msj){
				$("#DivListarHistoriaPase").html(msj);
			},
			error:function(msj){
				$("#DivListarHistoriaPase").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
			}
		});
	});

	$(document).on('click', '#BtnClasificacionDocumental', function(event){
		$('#id_radica').val($(this).data('id_radicado'))
	});

	$(document).on('click', '#BtnEstablecerClasificacion', function(event){

		var IdFuncioDetaAsignado = $(this).data("id_funcio_deta");
		var IdRadica             = $('#id_radica').val();
		var Funcionario =$(this).data("funcion")
		swal({
			title: "Clasificación documental",
			text: "¿Desea establecer la clasificación documental al radicado: "+IdRadica+"?",
			type: "success",
			showCancelButton: true,
			cancelButtonText: "No",
			confirmButtonColor: "#468847",
			confirmButtonText: "¡si, asignar!",
			closeOnConfirm: false
		},

		function(){

			$.ajax({
				url: 'acciones.ajax.php',
				type: 'POST',
				data: 'accion=ESTABLECER_CLASIFICACION&id_radica='+IdRadica+'&id_serie='+$('#id_serie').val()+'&id_subserie='+$('#id_subserie').val()+'&id_tipodoc='+$('#id_tipodoc').val(),
				beforeSend: function(){
					$("#DivAlerta").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
				},
				success:function(msj){
					if(msj == 1){
						$("#DivAlerta").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El registro se actualizo correctamente. </div>');
						swal("¡Clasificación documental!.",
							"La clasificación documental al radicado "+IdRadica+" ha sido exítosa");
					}else{
						$("#DivAlerta").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> '+msj+'.</div>');
						swal("¡Clasificación documental!.",
							msj);
					}

					$('#BtnCerrarClasificacionDocumental').click();
				},
				error:function(msj){
					$("#DivAlerta").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución '+msj+'</div>');
				}
			});
		});
	});

	$("#id_serie").change(function () {
		$("#id_serie option:selected").each(function () {
			$.post("../../../../varios/combo_sub_series.php", {
				id_serie: $(this).val(),
				id_depen: $('#id_depen').val(),
				id_oficina: $('#id_oficina').val(),
				IncluirOficinaTRD: $('#incluir_oficina_trd').val()
			}, function(data){
				$("#id_subserie").html(data);
			});
		});
	});

	$("#id_subserie").change(function () {
		$("#id_subserie option:selected").each(function () {
			var id_serie = $("#id_serie").val();
			var id_sub_serie = $(this).val();

			$.post("../../../../varios/combo_tipos_documentos.php", {
				accion: $('#accion').val(),
				id_depen: $('#id_depen').val(),
				id_serie: id_serie,
				id_sub_serie: id_sub_serie
			}, function (data) {
				$("#id_tipodoc").html(data);
			});
		});
	});

	$(document).on('click', '#btnAutorizar', function (event){
		$('#tipo_ver').val($(this).data('tipo_ver'))
	});
});