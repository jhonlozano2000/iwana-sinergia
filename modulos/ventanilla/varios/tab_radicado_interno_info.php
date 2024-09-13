<?php
include "../../../config/class.Conexion.php";
include "../../../config/funciones.php";
require_once '../../clases/radicar/class.RadicaInterno.php';
require_once '../../clases/radicar/class.RadicaInternoResponsable.php';
require_once '../../clases/radicar/class.RadicaInternoDestinatario.php';
require_once '../../clases/radicar/class.RadicaInternoProyectores.php';
include("../../../config/variable.php");

$RadicadoInterno = RadicadoInterno::Listar_Varios(1, $_POST['id_radica'], "", "", 0, 0, 0, "", "", "");
foreach ($RadicadoInterno as $ItemRadicado):

	$Responsable = "";
	$Responsables = "";

	$RegisResponsable = RadicadoInternoResponsable::Listar(1, $ItemRadicado['id_radica'], "", "", 0, 0, 0, "", "", "");
	foreach ($RegisResponsable as $ItemRessponsa) {
		if ($ItemRessponsa['respon'] == 1) {
			$Responsable .= utf8_encode($ItemRessponsa['nom_funcio'] . " " . $ItemRessponsa['ape_funcio'] . " [" . $ItemRessponsa['nom_depen'] . "]");
		}

		$Responsables .= utf8_encode($ItemRessponsa['nom_funcio'] . " " . $ItemRessponsa['ape_funcio'] . " [" . $ItemRessponsa['nom_depen'] . "]<br><br>");
	}
?>
	<div class="col-md-3">
		<div class="row">
			<div class="col-md-12 sortable">
				<div class="grid simple ">
					<div class="grid-title no-border">
						<h4><i class='glyphicon glyphicon-info-sign text-info'></i> <span class="semi-bold">Info.</span></h4>
						<input type="hidden" id="id_ruta" value="<?php echo $ItemRadicado['id_ruta']; ?>" />
						<input type="hidden" id="id_radica" value="<?php echo $_POST['id_radica']; ?>" />
					</div>
					<div class="grid-body no-border">
						<div class="row-fluid">
							<div class="scroller scrollbar-dynamic" data-height="245px">
								<table width="251" class="table table-hover table-condensed" id="example">
									<tr>
										<td width="87">Radicado </td>
										<td width="152"><?php echo $ItemRadicado['id_radica']; ?></td>
									</tr>
									<tr>
										<td>Asunto </td>
										<td><?php echo utf8_encode($ItemRadicado['asunto']); ?></td>
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
										<td># Folios </td>
										<td><?php echo $ItemRadicado['num_folio']; ?></td>
									</tr>
									<tr>
										<td>Radicado Por </td>
										<td><?php echo utf8_encode($ItemRadicado['nom_funcio_radi'] . " " . $ItemRadicado['ape_funcio_radi']); ?></td>
									</tr>
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
						<h4><i class='fa fa-users text-info'></i> <span class="semi-bold">Responsables.</span></h4>
					</div>
					<div class="grid-body no-border">
						<div class="row-fluid">
							<div class="scroller scrollbar-dynamic" data-height="245px">
								<table width="251" class="table table-hover table-condensed" id="example">
									<tr>
										<td><?php echo "<p class='text-success'>Responsable</p>" . $Responsable; ?></td>
									</tr>
									<tr>
										<td><?php echo "<p class='text-success'>Remitentes</p>" . $Responsables; ?></td>
									</tr>
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
						<h4>
							<i class='fa fa-user text-info'></i>
							<span class="semi-bold">Destinatarios.</span>
						</h4>
					</div>
					<div class="grid-body no-border">
						<div class="row-fluid">
							<div class="scroller scrollbar-dynamic" data-height="245px">
								<table width="251" class="table table-hover table-condensed" id="example">
									<?php
									$Destinatarios = RadicadoInternoDestinatario::Listar(1, $ItemRadicado['id_radica'], "");
									foreach ($Destinatarios as $ItemDestinatarios) {
									?>
										<tr>
											<td>
												<?php echo utf8_encode($ItemDestinatarios['nom_funcio'] . " " . $ItemDestinatarios['ape_funcio'] . "<br>[" . $ItemDestinatarios['nom_depen']) . "]<br><br>"; ?>
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
						<h4><i class='fa fa-users text-info'></i> <span class="semi-bold">Proyectores.</span></h4>
					</div>
					<div class="grid-body no-border">
						<div class="row-fluid">
							<div class="scroller scrollbar-dynamic" data-height="245px">
								<table width="251" class="table table-hover table-condensed" id="example">
									<?php
									$Proyectores = RadicadoInternoProyector::Listar(1, $ItemRadicado['id_radica'], "", "", "", "", "", "");
									foreach ($Proyectores as $ItemProyectores) {
									?>
										<tr>
											<td>
												<?php echo utf8_encode($ItemProyectores['nom_funcio'] . " " . $ItemProyectores['ape_funcio'] . " [" . $ItemProyectores['nom_depen'] . "]"); ?>
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

<?php
endforeach;
?>