<?php
include "../../../../../config/class.Conexion.php";
require_once '../../../../../public/assets/img/loading.gif';
require_once '../../../../clases/radicar/class.RadicaRecibido.php';

$RegisRadicado = RadicadoRecibido::Listar_Vario(3, $_POST['id_radica'], "", "", 0, 0, 0, 0, "", "", "");
foreach($RegisRadicado as $ItemRadicado):
	$Responsable = "";
	$Destinatarios = "";
	$RegisResponsable = RadicadoRecibido::Listar_Vario(3, $ItemRadicado['id_radica'], "", "", 0, 0, 0, 0, "", "", "");
	foreach ($RegisResponsable as $ItemRessponsa) {
		if($ItemRessponsa['respon'] == 1){
			$Responsable.= "[".$ItemRessponsa['cod_depen_respon']." - ".$ItemRessponsa['cod_corres_depen_respon']." - ".$ItemRessponsa['nom_depen_respon']."] ".$ItemRessponsa['nom_funcio_respon']." - ".$ItemRessponsa['ape_funcio_respon'];
		}
		$Destinatarios.= "[".$ItemRessponsa['cod_depen_respon']." - ".$ItemRessponsa['cod_corres_depen_respon']." - ".$ItemRessponsa['nom_depen_respon']."] ".$ItemRessponsa['nom_funcio_respon']." - ".$ItemRessponsa['ape_funcio_respon'];
	}
	?>
	<div class="row">
		<div class="form-group col-md-9">
			<h3 id="emailheading">Radicado: <?php echo $ItemRadicado['id_radica']; ?></h3>
		</div>
		<div class="form-group col-md-2">
			<div class="pull-right">
				<?php
				if($ItemRadicado['requie_respues'] == 1){
					?>
					<a href="../responder/index.php?id_radica=<?php echo $ItemRadicado['id_radica']; ?>" id="BtnResponder">
						<img src="../../../../../public/assets/img/responder.png" title = "Responder correspondencia" width="40" height="40"/>
					</a>
					<?php
				}
				?>
				<span class="muted small-text">
					<a href="#" id="BtnDescargar" class="descargar_pdf" data-id_Radicado="<?php echo $ItemRadicado['id_radica']; ?>">
						<img src="../../../../../public/assets/img/pdf.png" width="30" height="36" title="Descargar documento digital">
					</a>
				</span>
			</div>
		</div>
	</div>
	<br>
	<div class="control">
		<div class="pull-left">
			<div class="checkbox checkbox check-success 	">
				<?php
				$RequieRespues = "";
				if($ItemRadicado['requie_respues'] == 1){
					$RequieRespues = "checked";
				}
				?>
				<input type="checkbox" value="1" id="chkTerms"<?php echo $RequieRespues; ?>>
				<label for="chkTerms">Requiere respuesta. </label>
			</div>
		</div>
		<div class="pull-left">
			<?php
			if($ItemRadicado['requie_respues'] == 1){
				?>
				<label for="chkTerms"># Días para vencimiento del documento
					<strong><?php echo $ItemRadicado['DiasRespuesFalta']; ?> </strong>
				</label>
				<?php } ?>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="email-body">
			<div class="row">
				<div class="col-md-4">
					<div class="row">
						<div class="col-md-12 sortable" style="height::500px">
							<div class="grid simple" >
								<div class="grid-title no-border">
									<h4><i class='glyphicon glyphicon-info-sign text-info'></i> <span class="semi-bold">Info.</span></h4>
								</div>
								<div class="grid-body no-border">
									<div class="row-fluid">
										<div class="scroller scrollbar-dynamic" data-height="245px">
											<input type="hidden" id="id_ruta" value="<?php echo $ItemRadicado['id_ruta']; ?>" />
                                            <input type="hidden" id="id_radica" value="<?php echo $ItemRadicado['id_radica']; ?>" />
											<input name="RutaDonwload" id="RutaDonwload" type="hidden" value="<?php echo MI_ROOT_TEMP_DONWLOAD_ENTRADA; ?>">
											<table width="251" class="table table-hover table-condensed" id="example">
												<tr>
													<td width="87">Radicado </td>
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
													<td>Fec. Veni.</td>
													<td><?php echo $ItemRadicado['fec_venci']; ?></td>
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
									<h4><i class='fa fa-user text-info'></i> <span class="semi-bold">Tercero.</span></h4>
								</div>
								<div class="grid-body no-border">
									<div class="row-fluid">
										<div class="scroller scrollbar-dynamic" data-height="245px">
											<table width="251" class="table table-hover table-condensed" id="example">
												<tr>
													<td width="85">Nit. </td>
													<td width="154"><?php echo $ItemRadicado['num_docu_remite']; ?></td>
												</tr>
												<tr>
													<td>Tercero </td>
													<td><?php echo $ItemRadicado['nom_remite']; ?></td>
												</tr>
												<tr>
													<td>Dirección </td>
													<td><?php echo $ItemRadicado['dir_remite']; ?></td>
												</tr>
												<tr>
													<td>Teléfono </td>
													<td><?php echo $ItemRadicado['tel_remite']; ?></td>
												</tr>
												<tr>
													<td>Fax </td>
													<td><?php echo $ItemRadicado['fax_remite']; ?></td>
												</tr>
												<tr>
													<td>E - Mail </td>
													<td><?php echo $ItemRadicado['email_remite']; ?></td>
												</tr>
												<tr>
													<td>Tipo Llegada </td>
													<td><?php echo $ItemRadicado['nom_forma_llega']; ?></td>
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
									<h4><i class='fa fa-users text-info'></i> <span class="semi-bold">Destinatarios.</span></h4>
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
													<td>Destinatarios </td>
													<td><?php echo $Destinatarios; ?></td>
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
			</div>
		</div>
		<?php
	endforeach;
	?>