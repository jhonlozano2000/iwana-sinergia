<?php
include "../../../config/class.Conexion.php";
include "../../../config/funciones.php";
include "../../../config/variable.php";
require_once '../../clases/radicar/class.RadicaInterno.php';
require_once '../../clases/radicar/class.RadicaInternoAdjuntos.php';
?>
<div class="col-md-12">
	<div class="grid simple">
		<div class="grid-body no-border">
			<div class="row column-seperation">
				<div class="col-md-6">
					<span class="semi-bold">Documentos Disponible.</span>
					<div class="row form-row">
						<div class="col-md-12">
							<span class="muted small-text">
								<a href="#" id="BtnDescargarArchivoInterno" class="descargar_pdf_interno"
									data-id_radicado="<?php echo $_REQUEST['id_radica']; ?>"
									data-id_ruta="<?php echo $_REQUEST['id_ruta']; ?>"
									data-tipo_cargue_archivos="<?php echo $_REQUEST['tipo_cargue_archivos']; ?>"
									data-nombre_archivo="<?php echo $_REQUEST['nombre_archivo']; ?>">
									<img src="<?php echo MI_ROOT; ?>/public/assets/img/pdf.png" width="30" height="36"></a>
							</span>
						</div>
					</div>
					<hr />
					<span class="semi-bold">Documentos Adjuntos.</span>
					<div class="row form-row">
						<div class="col-md-12" style="overflow-y: scroll; height: 300px;">
							<?php
							$RadicadoInternoArchivos = RadicadoInternoAdjuntos::Listar(1, $_REQUEST['id_radica'], "");
							foreach ($RadicadoInternoArchivos as $ItemRadicado):
							?>
								<span class="muted small-text">
									<a href="#" id="BtnDescargarArchivoInternoAdjuntos" class="descargar_pdf_interno"
										data-id_archivo="<?php echo $ItemRadicado['id_archivo']; ?>"
										data-id_radica="<?php echo $ItemRadicado['id_radica']; ?>"
										data-id_ruta="<?php echo $ItemRadicado['id_ruta']; ?>"
										data-id_archivo="<?php echo $ItemRadicado['id_archivo']; ?>"
										data-nom_archivo="<?php echo $ItemRadicado['nombre_archivo_adjunto']; ?>"
										data-tipo_cargue_archivos="<?php echo $ItemRadicado['tipo_cargue_archivos']; ?>">
										<img src="<?php echo MI_ROOT; ?>/public/assets/img/pdf.png" width="30" height="36"> <?php echo $ItemRadicado['nombre_archivo_adjunto']; ?></a>
									<br />
								</span>
							<?php
							endforeach;
							?>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<span class="semi-bold">Documentos De Respuesta.</span>
					<div class="row form-row">
						<div class="col-md-12">
							<!-- <?php
									$RadicadoInternoArchivos = RadicadoInternoAdjuntos::Listar(1, $_REQUEST['id_radica'], "");
									foreach ($RadicadoInternoArchivos as $ItemRadicado):
									?>
								<span class="muted small-text">
									<a href="#" id="BtnDescargarArchivoInternoAdjuntos" class="descargar_pdf_interno"
										data-id_archivo="<?php echo $ItemRadicado['id_archivo']; ?>">
										<img src="<?php echo MI_ROOT; ?>/public/assets/img/pdf.png" width="30" height="36"><?php echo $ItemRadicado['nombre_archivo']; ?></a>
								</span>
							<?php
									endforeach;
							?> -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>