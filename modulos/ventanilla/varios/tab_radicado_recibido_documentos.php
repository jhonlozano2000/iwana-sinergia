<?php
include "../../../config/class.Conexion.php";
include "../../../config/funciones.php";
require_once '../../clases/radicar/class.RadicaRecibido.php';
require_once '../../clases/radicar/class.RadicaRecibidoResponsable.php';
include("../../../config/variable.php");

$RegisRadicado = RadicadoRecibido::Listar_Vario(1, $_POST['id_radica'], "", "", 0, 0, 0, "", "", "");
foreach ($RegisRadicado as $ItemRadicado):
?>
	<div class="col-md-12">
		<div class="grid simple">
			<div class="grid-body no-border">
				<div class="row column-seperation">
					<div class="col-md-6">
						<span class="semi-bold">Documentos Recibidos.</span>
						<div class="row form-row">
							<div class="col-md-12">
								<?php
								if ($ItemRadicado['digital'] == 1) {
								?>
									<span class="muted small-text">
										<a href="#" id="BtnDescargarArchivoRecibido" class="descargar_pdf_recibido"
											data-id_radicado="<?php echo $ItemRadicado['id_radica']; ?>"
											data-id_ruta="<?php echo $ItemRadicado['id_ruta']; ?>"
											data-archivo="<?php echo $ItemRadicado['archivo']; ?>">
											<img src=" <?php echo MI_ROOT; ?>/public/assets/img/pdf.png" width="50" height="56"></a>
									</span>
								<?php
								}
								?>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<span class="semi-bold">Documentos Enviados.</span>
						<div class="row form-row">
							<div class="col-md-12">
								<?php
								$RequieRespues = "";
								if ($ItemRadicado['requie_respues'] == 1) {
								?>
									<table width="251">
										<?php if ($ItemRadicado['radica_respuesta'] != "") { ?>
											<tr>
												<td>Digital de enviado: <?php echo $ItemRadicado['radica_respuesta']; ?> </td>
												<td>
													<a href="#" id="BtnDescargarPdfEnviado"
														data-id_radicado="<?php echo $ItemRadicado['radica_respuesta']; ?>"
														data-id_ruta="<?php echo $ItemRadicado['id_ruta_respues']; ?>">
														<img src="<?php echo MI_ROOT; ?>/public/assets/img/pdf.png" width="30" height="36"></a>
												</td>
											</tr>
										<?php
										} else {
											echo '<p class="text-error"><strong>Sin Respuesta.</strong></p>';
										}
										?>
									</table>
								<?php
								}

								?>
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