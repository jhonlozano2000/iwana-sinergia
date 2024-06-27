<?php
include "../../../config/class.Conexion.php";
require_once '../../clases/radicar/class.RadicaEnviado Final.php';
require_once '../../clases/radicar/class.RadicaEnviadoResponsable.php';
include("../../../config/variable.php");

$RadicadoEnviado = RadicadoEnviado::Listar(3, $_POST['id_radica'], "", "", 0, 0, 0, "", "", "");
foreach($RadicadoEnviado as $ItemRadicado):

	$Responsable = "";
	$Destinatarios = "";
	$IdRuta = "";
	$IdRuta = $ItemRadicado['id_ruta'];

	$RegisResponsable = RadicadoEnviadoResponsable::Listar(1, $ItemRadicado['id_radica'], "", "", 0, 0, 0, "", "", "");
	foreach ($RegisResponsable as $ItemRessponsa) {

		if($ItemRessponsa['respon'] == 1){
			$Responsable.= "[".$ItemRessponsa['cod_depen']." - ".$ItemRessponsa['cod_corres_depen']." - ".$ItemRessponsa['nom_depen']."] ".$ItemRessponsa['nom_funcio']." - ".$ItemRessponsa['ape_funcio'];
		}
	}
	?>

	<div class="row">
		<div class="form-group col-md-9">
			<h3 id="emailheading">Radicado: <?php echo $ItemRadicado['id_radica']; ?></h3>
		</div>
		<div class="form-group col-md-2">
			<div class="pull-right">
				<span class="muted small-text">
					<a href="../../../reportes/ventanilla/formato_historia_clinica/formato_hc.php?id_radica_enviado=<?php echo $_POST['id_radica']; ?>&id_radica_recibido=<?php echo $ItemRadicado['radica_respuesta']; ?>" target="_blank">
						<img src="<?php echo MI_ROOT; ?>/public/assets/img/impresora.png" width="40" height="36">
					</a>
				</span>
				<span class="muted small-text">
					<a href="#" id="BtnDescargar" class="descargar_pdf" 
					data-id_radicado="<?php echo $_POST['id_radica']; ?>" 
					data-id_ruta="<?php echo $IdRuta; ?>">
					<img src="<?php echo MI_ROOT; ?>/public/assets/img/pdf.png" width="30" height="36">
				</a>
			</span>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<div class="email-body">
	<div class="row">
		<div class="col-md-4">
			<div class="row">
				<div class="col-md-12 sortable">
					<div class="grid simple ">
						<div class="grid-title no-border">
							<h4><i class='glyphicon glyphicon-info-sign text-info'></i> <span class="semi-bold">Info.</span></h4>
							<input type="hidden" id="id_ruta" value="<?php echo $ItemRadicado['id_ruta']; ?>" />
							<input name="RutaUpload" id="RutaUpload" type="hidden" value="<?php echo MI_ROOT_TEMP_DOCUMENTOS_SALIDA; ?>">
							<input type="hidden" id="id_radica" value="<?php echo $_POST['id_radica']; ?>" />
						</div>
						<div class="grid-body no-border">
							<div class="row-fluid">
								<div class="scroller scrollbar-dynamic" data-height="245px">
									<table width="251" class="table table-hover table-condensed" id="example">
										<tr>
											<td width="87">Radicado  </td>
											<td width="152"><?php echo $ItemRadicado['id_radica']; ?></td>
										</tr>
										<tr>
											<td>Asunto </td>
											<td><?php echo $ItemRadicado['asunto']; ?></td>
										</tr>
										<tr>
											<td>Fec. Doc. </td>
											<td><?php echo $ItemRadicado['fec_docu']; ?></td>
										</tr>
										<tr>
											<td>Fec. Rad. </td>
											<td><?php echo $ItemRadicado['id_radica']; ?></td>
										</tr>
										<tr>
											<td># Anexos </td>
											<td><?php echo $ItemRadicado['num_anexos']; ?></td>
										</tr>
										<tr>
											<td># De Guía </td>
											<td><?php echo $ItemRadicado['num_guia']; ?></td>
										</tr>
										<tr>
											<td># Folios </td>
											<td><?php echo $ItemRadicado['num_folio']; ?></td>
										</tr>
										<tr>
											<td>Radicado Por </td>
											<td><?php echo $ItemRadicado['nom_funcio_regis']." ".$ItemRadicado['ape_funcio_regis']; ?></td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="row">
				<div class="col-md-12 sortable">
					<div class="grid simple ">
						<div class="grid-title no-border">
							<h4><i class='fa fa-users text-info'></i> <span class="semi-bold">Responsables.</span></h4>
						</div>
						<div class="grid-body no-border">
							<div class="row-fluid">
								<div class="scroller scrollbar-dynamic" data-height="245px">
									<table width="251" class="table table-hover table-condensed" id="example">
										<tr>
											<td>Responsable </td>
											<td><?php echo $Responsable; ?></td>
										</tr>
										<tr>
											<td>Serie </td>
											<td><?php echo $ItemRadicado['cod_serie']." - ".$ItemRadicado['nom_serie']; ?></td>
										</tr>
										<tr>
											<td>Sub Serie </td>
											<td><?php echo $ItemRadicado['cod_subserie']." - ".$ItemRadicado['nom_subserie']; ?></td>
										</tr>
										<tr>
											<td>Tipo Documento </td>
											<td><?php echo $ItemRadicado['nom_tipodoc']; ?></td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
		<div class="col-md-4">
			<div class="row">
				<div class="col-md-12 sortable">
					<div class="grid simple ">
						<div class="grid-title no-border">
							<h4><i class='fa fa-user text-info'></i> <span class="semi-bold">Destinatario.</span></h4>
						</div>
						<div class="grid-body no-border">
							<div class="row-fluid">
								<div class="scroller scrollbar-dynamic" data-height="245px">
									<table width="251" class="table table-hover table-condensed" id="example">
										<?php
										if($ItemRadicado['razo_soci'] == ""){
											?>

											<tr>
												<td width="85">C.c. </td>
												<td width="154"><?php echo $ItemRadicado['num_docu']; ?></td>
											</tr>
											<tr>
												<td>Nombres Del Contacto </td>
												<td><?php echo $ItemRadicado['nom_contac']; ?></td>
											</tr>
											<tr>
												<td>Dirección </td>
												<td><?php echo $ItemRadicado['nom_depar_remite']." - ".$ItemRadicado['nom_muni_remite'].", ".$ItemRadicado['dir_destina']; ?></td>
											</tr>
											<tr>
												<td>Teléfono </td>
												<td><?php echo $ItemRadicado['tel_destina']; ?></td>
											</tr>
											<tr>
												<td>Fax </td>
												<td><?php echo $ItemRadicado['fax_destina']; ?></td>
											</tr>
											<tr>
												<td>E - Mail </td>
												<td><?php echo $ItemRadicado['email_destina']; ?></td>
											</tr>
											<tr>
												<td>Tipo De Salida </td>
												<td><?php echo $ItemRadicado['nom_formaenvi']; ?></td>
											</tr>
											<?php
										}else{
											?>
											<tr>
												<td width="85">Nit. </td>
												<td width="154"><?php echo $ItemRadicado['nit_empre']; ?></td>
											</tr>
											<tr>
												<td>Razón Social </td>
												<td><?php echo $ItemRadicado['razo_soci']; ?></td>
											</tr>
											<tr>
												<td>Dirección </td>
												<td><?php echo $ItemRadicado['nom_depar_empre']." - ".$ItemRadicado['nom_muni_empre'].", ".$ItemRadicado['dir_destina']; ?></td>
											</tr>
											<tr>
												<td>Teléfono </td>
												<td><?php echo $ItemRadicado['tel_destina']; ?></td>
											</tr>
											<tr>
												<td>Fax </td>
												<td><?php echo $ItemRadicado['fax_destina']; ?></td>
											</tr>
											<tr>
												<td>E - Mail </td>
												<td><?php echo $ItemRadicado['email_destina']; ?></td>
											</tr>
											<tr>
												<td>Tipo De Salida </td>
												<td><?php echo $ItemRadicado['nom_formaenvi']; ?></td>
											</tr>
											<?php
										}
										?>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
		
	</div>
</div>
<?php
endforeach;
?>