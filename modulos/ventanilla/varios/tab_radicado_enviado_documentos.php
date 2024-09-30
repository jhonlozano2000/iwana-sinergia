<?php
include "../../../config/class.Conexion.php";
include "../../../config/funciones.php";
require_once '../../clases/radicar/class.RadicaEnviado.php';
require_once '../../clases/radicar/class.RadicaEnviadoArchivoAdicional.php';
include("../../../config/variable.php");
?>
<div class="col-md-12">
	<div class="row">
		<div class="row column-seperation">
			<div class="col-md-6">
				<span class="semi-bold">Documentos Recibidos.</span>
				<div class="row form-row">
					<div class="col-md-12">
						<?php
						$RadicadoEnviado = RadicadoEnviado::Listar_Varios(1, $_POST['id_radica'], "", "", 0, 0, 0, "", "", "");
						foreach ($RadicadoEnviado as $ItemRadicado):
							if ($ItemRadicado['digital'] == 1) {
						?>
								<span class="muted small-text">
									<a href="#" id="BtnDescargarArchivoEnviado" class="descargar_pdf_enviado"
										data-id_radicado="<?php echo $ItemRadicado['id_radica']; ?>"
										data-id_ruta="<?php echo $ItemRadicado['id_ruta']; ?>"
										data-archivo="<?php echo $ItemRadicado['archivo']; ?>"
										data-tipo_cargue_archivos="<?php echo $ItemRadicado['tipo_cargue_archivos']; ?>">
										<img src="<?php echo MI_ROOT; ?>/public/assets/img/pdf.png" width="30" height="36">
									</a>
								</span>
						<?php
							}
						endforeach;
						?>
					</div>
				</div>
			</div>
			<div class="col-md-6">

			</div>
		</div>
	</div>
	<br />
	<hr />
	<br />
	<div class="row">
		<span class="semi-bold">Documentos adjuntos.</span>
		<div class="row form-row">
			<div class="col-md-12">
				<?php
				$ArchivoAdciones = RadicadoEnviadoArchivoAdicional::Listar(1, $_POST['id_radica'], "", "");
				foreach ($ArchivoAdciones as $ItemArchivo):
				?>
					<span class="muted small-text">
						<a href="#" id="BtnDescargarArchivoEnviadoAdjunto"
							data-id_radica="<?php echo $ItemArchivo['id_radica']; ?>"
							data-id_ruta="<?php echo $ItemRadicado['id_ruta']; ?>"
							data-id_archivo="<?php echo $ItemArchivo['id_archivo']; ?>"
							data-nom_archivo="<?php echo $ItemArchivo['nom_archivo']; ?>"
							data-tipo_cargue_archivos="<?php echo $ItemArchivo['tipo_cargue_archivos']; ?>">
							<img src="<?php echo MI_ROOT; ?>/public/assets/img/pdf.png" width="30" height="36">
							<?php echo $ItemArchivo['nom_archivo']; ?>
						</a>
					</span>
				<?php
				endforeach;
				?>
			</div>
		</div>
	</div>
</div>