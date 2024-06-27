<?php
include "../../../config/class.Conexion.php";
include "../../../config/funciones.php";
require_once '../../clases/radicar/class.RadicaEnviado.php';
require_once '../../clases/radicar/class.RadicaEnviadoQuienFirma.php';
require_once '../../clases/radicar/class.RadicaEnviadoResponsable.php';
require_once '../../clases/radicar/class.RadicaEnviadoProyectores.php';
include("../../../config/variable.php");

$RadicadoEnviado = RadicadoEnviado::Listar_Varios(1, $_POST['id_radica'], "", "", 0, 0, 0, "", "", "");
foreach($RadicadoEnviado as $ItemRadicado):

	$QuienFirma    = "";
	$Responsable   = "";
	$Destinatarios = "";
	$IdRuta        = "";
	$IdRuta        = $ItemRadicado['id_ruta'];

	$RegisQuienFirma = RadicadoEnviadoQuienFirma::Listar(1, $ItemRadicado['id_radica'], "", "", "");
	foreach($RegisQuienFirma as $ItemQuienFirma) {
		$QuienFirma.= utf8_encode("[".$ItemQuienFirma['nom_depen']."] ".$ItemQuienFirma['nom_funcio']." ".$ItemQuienFirma['ape_funcio'])."<br><br>";
	}

	$RegisResponsable = RadicadoEnviadoResponsable::Listar(1, $ItemRadicado['id_radica'], "", "", 0, 0, 0, "", "", "");
	foreach($RegisResponsable as $ItemRessponsa) {
		if($ItemRessponsa['respon'] == 1){
			$Responsable.= utf8_encode("[".$ItemRessponsa['nom_depen']."] ".$ItemRessponsa['nom_funcio']." ".$ItemRessponsa['ape_funcio']);
		}

		$Destinatarios.= utf8_encode("[".$ItemRessponsa['nom_depen']."] ".$ItemRessponsa['nom_funcio']." ".$ItemRessponsa['ape_funcio'])."<br><br>";
	}
	?>
	<div class="col-md-3">
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
									<tr>
											<td>Tipo De Salida </td>
											<td><?php echo $ItemRadicado['nom_formaenvi']; ?></td>
										</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="row">
			<div class="col-md-12 sortable">
				<div class="grid simple ">
					<div class="grid-title no-border">
						<h4><i class='fa fa-users text-info'></i> <span class="semi-bold">Quien Firma.</span></h4>
					</div>
					<div class="grid-body no-border">
						<div class="row-fluid">
							<div class="scroller scrollbar-dynamic" data-height="245px">
								<table width="251" class="table table-hover table-condensed" id="example">
									<tr>
										<td><?php echo "<p class='text-success'>Responsable</p>".$QuienFirma; ?></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<div class="col-md-2">
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
										<td><?php echo "<p class='text-success'>Responsable</p>".$Responsable; ?></td>
									</tr>
									<tr>
										<td><?php echo "<p class='text-success'>Destinaratios</p>".$Destinatarios; ?></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<div class="col-md-2">
		<div class="row">
			<div class="col-md-12 sortable">
				<div class="grid simple ">
					<div class="grid-title no-border">
						<h4><i class='fa fa-users text-info'></i> <span class="semi-bold">Proyectores.</span></h4>
					</div>
					<div class="grid-body no-border">
						<div class="row-fluid">
							<div class="scroller scrollbar-dynamic" data-height="245px">
								<table width="251" class="table table-hover table-condensed" id="example">
									<?php
									$Proyectores = RadicadoEnviadoProyector::Listar(1, $ItemRadicado['id_radica'], "", "", "", "", "", "");
									foreach($Proyectores as $Item){
										?>
										<tr>
											<td>
												<?php echo "[".$Item['nom_depen']."] ".$Item['nom_funcio']." ".$Item['ape_funcio']; ?>
											</td>
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
	<div class="col-md-3">
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
											<td><?php echo utf8_encode($ItemRadicado['nom_contac']); ?></td>
										</tr>
										<tr>
											<td>Dirección </td>
											<td>
												<?php 
												if($ItemRadicado['razo_soci'] != ""){
													echo utf8_encode($ItemRadicado['nom_depar_empre']." - ".$ItemRadicado['nom_muni_empre'].", ".$ItemRadicado['dir_destina']);
												}else{
													echo utf8_encode($ItemRadicado['nom_depar_remite']." - ".$ItemRadicado['nom_muni_remite'].", ".$ItemRadicado['dir_destina']);

												}
												?>
											</td>
										</tr>
										<tr>
											<td>Teléfono </td>
											<td>
												<?php 
												if($ItemRadicado['razo_soci'] != ""){
													echo $ItemRadicado['tel_destina']; 
												}else{
													echo $ItemRadicado['tel_destina']; 
												}
												?>
											</td>
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
											<td><?php echo utf8_encode($ItemRadicado['nom_formaenvi']); ?></td>
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
											<td><?php echo utf8_encode($ItemRadicado['razo_soci']); ?></td>
										</tr>
										<tr>
											<td>Dirección </td>
											<td><?php echo utf8_encode($ItemRadicado['nom_depar_empre']." - ".$ItemRadicado['nom_muni_empre'].", ".$ItemRadicado['dir_destina']); ?></td>
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
											<td>Cargo </td>
											<td><?php echo utf8_encode($ItemRadicado['cargo']); ?></td>
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
	<?php
endforeach;
?>