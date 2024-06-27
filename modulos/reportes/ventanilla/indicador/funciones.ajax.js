$(document).ready(function(){

	$('#DivMostrarDerinatarioInterno').hide();

	$('#BtnFlujoPorFuncioEXCEL').click(function(){
		if($('#desde').val() == ""){
			$('#DivAlertas').html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo falta la fecha de inicio.</div>');
			$('#desde').focud();
		}else if($('#hasta').val() == ""){
			$('#DivAlertas').html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo falta la fecha de inicio.</div>');
			$('#hasta').focus();
		}else if($('#origen_correspon').val() == 0){
			$('#DivAlertas').html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo falta el origen de la correspondencia.</div>');
			$('#origen_correspon').focus();
		}else{

			$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');

			setTimeout(function(){
				url = "reporte_excel_detallado_recibida.php?origen_correspon="+$('#origen_correspon').val()+"&desde="+$('#desde').val()+'&hasta='+$('#hasta').val()+'&id_depen='+$('#id_depen').val()+'&id_serie='+$('#id_serie').val()+'&id_subserie='+$('#id_subserie').val()+'&id_tipodoc='+$('#id_tipodoc').val()+'&ChkTercero='+ChkTercero+'&ChkFuncionario='+ChkFuncionario+'&ChkDependencia='+ChkDependencia+'&ChkOficina='+ChkOficina+'&ChkSerie='+ChkSerie+'&ChkSubSerie='+ChkSubSerie+'&ChkTipoDocumento='+ChkTipoDocumento;

				window.open(url, 'Download');

				$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El reporte se genero correctamente. </div>');
			}, 200);
		}
	});

	$('#BtnFlujoPorFuncioPDF').click(function(){
		if($('#desde').val() == ""){
			$('#DivAlertas').html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo falta la fecha de inicio.</div>');
			$('#desde').focus();
		}else if($('#hasta').val() == ""){
			$('#DivAlertas').html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo falta la fecha de inicio.</div>');
			$('#hasta').focus();
		}else if($('#origen_correspon').val() == 0){
			$('#DivAlertas').html('<div class="alert alert-warning alert-dismissable""><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Alerta!</b> Te hizo falta el origen de la correspondencia.</div>');
			$('#origen_correspon').focus();
		}else{

			if($('#origen_correspon').val() == "CORRES_RECIBIDA"){

				$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');

				if($('#ChkTercero').is(':checked')){
					setTimeout(function(){
						url = "pdf_recibodo/reporte_pdf_indicador_recibido_terceros.php?origen_correspon="+$('#origen_correspon').val()+"&desde="+$('#desde').val()+'&hasta='+$('#hasta').val()+'&id_depen='+$('#id_depen').val()+'&id_serie='+$('#id_serie').val()+'&id_subserie='+$('#id_subserie').val()+'&id_tipodoc='+$('#id_tipodoc').val();

						window.open(url, '_blank');
						return false;

						$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El reporte se genero correctamente. </div>');
					}, 200);
				}

				if($('#ChkFuncionario').is(':checked')){
					setTimeout(function(){
						url = "pdf_recibodo/reporte_pdf_indicador_recibido_responsable.php?origen_correspon="+$('#origen_correspon').val()+"&desde="+$('#desde').val()+'&hasta='+$('#hasta').val()+'&id_depen='+$('#id_depen').val()+'&id_serie='+$('#id_serie').val()+'&id_subserie='+$('#id_subserie').val()+'&id_tipodoc='+$('#id_tipodoc').val();

						window.open(url, '_blank');
						return false;

						$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El reporte se genero correctamente. </div>');
					}, 200);
				}

				if($('#ChkDependencia_ChkOficina').is(':checked')){
					setTimeout(function(){
						url = "pdf_recibodo/reporte_pdf_indicador_recibido_dependencia_oficina.php?origen_correspon="+$('#origen_correspon').val()+"&desde="+$('#desde').val()+'&hasta='+$('#hasta').val()+'&id_depen='+$('#id_depen').val()+'&id_serie='+$('#id_serie').val()+'&id_subserie='+$('#id_subserie').val()+'&id_tipodoc='+$('#id_tipodoc').val();

						window.open(url, '_blank');
						return false;

						$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El reporte se genero correctamente. </div>');
					}, 200);
				}

				if($('#ChkSerie').is(':checked')){
					setTimeout(function(){
						url = "pdf_recibodo/reporte_pdf_indicador_recibido_serie.php?origen_correspon="+$('#origen_correspon').val()+"&desde="+$('#desde').val()+'&hasta='+$('#hasta').val()+'&id_depen='+$('#id_depen').val()+'&id_serie='+$('#id_serie').val()+'&id_subserie='+$('#id_subserie').val()+'&id_tipodoc='+$('#id_tipodoc').val();

						window.open(url, '_blank');
						return false;

						$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El reporte se genero correctamente. </div>');
					}, 200);				
				}

				if($('#ChkSubSerie').is(':checked')){
					setTimeout(function(){
						url = "pdf_recibodo/reporte_pdf_indicador_recibido_subserie.php?origen_correspon="+$('#origen_correspon').val()+"&desde="+$('#desde').val()+'&hasta='+$('#hasta').val()+'&id_depen='+$('#id_depen').val()+'&id_serie='+$('#id_serie').val()+'&id_subserie='+$('#id_subserie').val()+'&id_tipodoc='+$('#id_tipodoc').val();

						window.open(url, '_blank');
						return false;

						$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El reporte se genero correctamente. </div>');
					}, 200);
				}

				if($('#ChkTipoDocumento').is(':checked')){
					setTimeout(function(){
						url = "pdf_recibodo/reporte_pdf_indicador_recibido_tipo_documento.php?origen_correspon="+$('#origen_correspon').val()+"&desde="+$('#desde').val()+'&hasta='+$('#hasta').val()+'&id_depen='+$('#id_depen').val()+'&id_serie='+$('#id_serie').val()+'&id_subserie='+$('#id_subserie').val()+'&id_tipodoc='+$('#id_tipodoc').val();

						window.open(url, '_blank');
						return false;

						$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El reporte se genero correctamente. </div>');
					}, 200);
				}

				$("#DivAlertas").empty();
			}

			if($('#origen_correspon').val() == "CORRES_ENVIADA"){

				$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');

				if($('#ChkTercero').is(':checked')){
					setTimeout(function(){
						url = "pdf_enviado/reporte_pdf_indicador_enviado_terceros.php?origen_correspon="+$('#origen_correspon').val()+"&desde="+$('#desde').val()+'&hasta='+$('#hasta').val()+'&id_depen='+$('#id_depen').val()+'&id_serie='+$('#id_serie').val()+'&id_subserie='+$('#id_subserie').val()+'&id_tipodoc='+$('#id_tipodoc').val();

						window.open(url, '_blank');
						return false;

						$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El reporte se genero correctamente. </div>');
					}, 200);
				}

				if($('#ChkFuncionario').is(':checked')){
					setTimeout(function(){
						url = "pdf_enviado/reporte_pdf_indicador_enviado_responsable.php?origen_correspon="+$('#origen_correspon').val()+"&desde="+$('#desde').val()+'&hasta='+$('#hasta').val()+'&id_depen='+$('#id_depen').val()+'&id_serie='+$('#id_serie').val()+'&id_subserie='+$('#id_subserie').val()+'&id_tipodoc='+$('#id_tipodoc').val();

						window.open(url, '_blank');
						return false;

						$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El reporte se genero correctamente. </div>');
					}, 200);
				}

				if($('#ChkDependencia_ChkOficina').is(':checked')){
					setTimeout(function(){
						url = "pdf_enviado/reporte_pdf_indicador_enviado_dependencia_oficina.php?origen_correspon="+$('#origen_correspon').val()+"&desde="+$('#desde').val()+'&hasta='+$('#hasta').val()+'&id_depen='+$('#id_depen').val()+'&id_serie='+$('#id_serie').val()+'&id_subserie='+$('#id_subserie').val()+'&id_tipodoc='+$('#id_tipodoc').val();

						window.open(url, '_blank');
						return false;

						$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El reporte se genero correctamente. </div>');
					}, 200);
				}

				if($('#ChkSerie').is(':checked')){
					setTimeout(function(){
						url = "pdf_enviado/reporte_pdf_indicador_enviado_serie.php?origen_correspon="+$('#origen_correspon').val()+"&desde="+$('#desde').val()+'&hasta='+$('#hasta').val()+'&id_depen='+$('#id_depen').val()+'&id_serie='+$('#id_serie').val()+'&id_subserie='+$('#id_subserie').val()+'&id_tipodoc='+$('#id_tipodoc').val();

						window.open(url, '_blank');
						return false;

						$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El reporte se genero correctamente. </div>');
					}, 200);				
				}

				if($('#ChkSubSerie').is(':checked')){
					setTimeout(function(){
						url = "pdf_enviado/reporte_pdf_indicador_enviado_subserie.php?origen_correspon="+$('#origen_correspon').val()+"&desde="+$('#desde').val()+'&hasta='+$('#hasta').val()+'&id_depen='+$('#id_depen').val()+'&id_serie='+$('#id_serie').val()+'&id_subserie='+$('#id_subserie').val()+'&id_tipodoc='+$('#id_tipodoc').val();

						window.open(url, '_blank');
						return false;

						$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El reporte se genero correctamente. </div>');
					}, 200);
				}

				if($('#ChkTipoDocumento').is(':checked')){
					setTimeout(function(){
						url = "pdf_enviado/reporte_pdf_indicador_enviado_tipo_documento.php?origen_correspon="+$('#origen_correspon').val()+"&desde="+$('#desde').val()+'&hasta='+$('#hasta').val()+'&id_depen='+$('#id_depen').val()+'&id_serie='+$('#id_serie').val()+'&id_subserie='+$('#id_subserie').val()+'&id_tipodoc='+$('#id_tipodoc').val();

						window.open(url, '_blank');
						return false;

						$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El reporte se genero correctamente. </div>');
					}, 200);
				}

				$("#DivAlertas").empty();
			}

			if($('#origen_correspon').val() == "CORRES_INTERNA"){

				$("#DivAlertas").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');

				if($('#ChkFuncionario').is(':checked')){
					setTimeout(function(){
						url = "pdf_interno/reporte_pdf_indicador_interno_responsable.php?origen_correspon="+$('#origen_correspon').val()+"&desde="+$('#desde').val()+'&hasta='+$('#hasta').val()+'&id_depen='+$('#id_depen').val()+'&id_serie='+$('#id_serie').val()+'&id_subserie='+$('#id_subserie').val()+'&id_tipodoc='+$('#id_tipodoc').val();

						window.open(url, '_blank');
						return false;

						$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El reporte se genero correctamente. </div>');
					}, 200);
				}

				if($('#ChkDetinatarioInterno').is(':checked')){
					setTimeout(function(){
						url = "pdf_interno/reporte_pdf_indicador_interno_destinatario.php?origen_correspon="+$('#origen_correspon').val()+"&desde="+$('#desde').val()+'&hasta='+$('#hasta').val()+'&id_depen='+$('#id_depen').val()+'&id_serie='+$('#id_serie').val()+'&id_subserie='+$('#id_subserie').val()+'&id_tipodoc='+$('#id_tipodoc').val();

						window.open(url, '_blank');
						return false;

						$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El reporte se genero correctamente. </div>');
					}, 200);
				}

				if($('#ChkDependencia_ChkOficina').is(':checked')){
					setTimeout(function(){
						url = "pdf_interno/reporte_pdf_indicador_interno_dependencia_oficina.php?origen_correspon="+$('#origen_correspon').val()+"&desde="+$('#desde').val()+'&hasta='+$('#hasta').val()+'&id_depen='+$('#id_depen').val()+'&id_serie='+$('#id_serie').val()+'&id_subserie='+$('#id_subserie').val()+'&id_tipodoc='+$('#id_tipodoc').val();

						window.open(url, '_blank');
						return false;

						$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El reporte se genero correctamente. </div>');
					}, 200);
				}

				if($('#ChkSerie').is(':checked')){
					setTimeout(function(){
						url = "pdf_interno/reporte_pdf_indicador_interno_serie.php?origen_correspon="+$('#origen_correspon').val()+"&desde="+$('#desde').val()+'&hasta='+$('#hasta').val()+'&id_depen='+$('#id_depen').val()+'&id_serie='+$('#id_serie').val()+'&id_subserie='+$('#id_subserie').val()+'&id_tipodoc='+$('#id_tipodoc').val();

						window.open(url, '_blank');
						return false;

						$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El reporte se genero correctamente. </div>');
					}, 200);				
				}

				if($('#ChkSubSerie').is(':checked')){
					setTimeout(function(){
						url = "pdf_interno/reporte_pdf_indicador_interno_subserie.php?origen_correspon="+$('#origen_correspon').val()+"&desde="+$('#desde').val()+'&hasta='+$('#hasta').val()+'&id_depen='+$('#id_depen').val()+'&id_serie='+$('#id_serie').val()+'&id_subserie='+$('#id_subserie').val()+'&id_tipodoc='+$('#id_tipodoc').val();

						window.open(url, '_blank');
						return false;

						$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El reporte se genero correctamente. </div>');
					}, 200);
				}

				if($('#ChkTipoDocumento').is(':checked')){
					setTimeout(function(){
						url = "pdf_interno/reporte_pdf_indicador_interno_tipo_documento.php?origen_correspon="+$('#origen_correspon').val()+"&desde="+$('#desde').val()+'&hasta='+$('#hasta').val()+'&id_depen='+$('#id_depen').val()+'&id_serie='+$('#id_serie').val()+'&id_subserie='+$('#id_subserie').val()+'&id_tipodoc='+$('#id_tipodoc').val();

						window.open(url, '_blank');
						return false;

						$("#DivAlertas").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-check"></i> Ok.</a> El reporte se genero correctamente. </div>');
					}, 200);
				}

				$("#DivAlertas").empty();
			}
		}
	});

	$("#origen_correspon").change(function(){
		if($("#origen_correspon").val() == 'CORRES_INTERNA'){
			$('#DivMostrarTercero').hide();
			$('#DivMostrarDerinatarioInterno').show();
		}else{
			$('#DivMostrarTercero').show();
			$('#DivMostrarDerinatarioInterno').hide();
		}
	});
});
