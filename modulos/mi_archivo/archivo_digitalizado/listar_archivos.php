<?php
session_start();
require_once '../../../config/variable.php';
require_once '../../../config/funciones.php';
require_once '../../../config/funciones_seguridad.php';
require_once '../../../config/class.Conexion.php';
require_once '../../clases/oficina_archivo/class.OficinaArchivoDigitalizacion.php';

$Archivos = Digitalizacion::Listar(3, $_REQUEST['id_expediente'], "", "", "", "", "", "", "", "");
?>
<div class="grid-body no-border" style="min-height: 850px;">
	<div class="row">
		<?php

		foreach ($Archivos as $Item) {
			$exp = explode(".", $Item['archivo']);
			$extension = end($exp);

			if ($extension === "pdf" or $extension === "PDF") {
				$imagen = "../../../public/assets/img/documentos/Pdf_icono.jpg";
			} elseif ($extension === "doc" or $extension === 'docx') {
				$imagen = "../../../public/assets/img/documentos/word.png";
			} elseif ($extension === "xls" or $extension === 'xlsx') {
				$imagen = "../../../public/assets/img/documentos/excel.png";
			} elseif ($extension === "pptx" or $extension === 'ppt') {
				$imagen = "../../../public/assets/img/documentos/power_point.png";
			} elseif ($extension === "txt" or $extension === 'ppt') {
				$imagen = "../../../public/assets/img/documentos/txt.png";
			} elseif ($extension === "png" or $extension === 'gif' or $extension === 'jpeg' or $extension === 'jpg') {
				$imagen = "../../../public/assets/img/documentos/imagen.png";
			}
		?>
			<div class="col-md-2">
				<div class="thumbnail" data-toggle="tooltip" title="<?php echo $Item['archivo']; ?>">
					<img data-src="<?php echo $imagen; ?>" alt="<?php echo $Item['archivo']; ?>" src="<?php echo $imagen; ?>" title="<?php echo $Item['archivo']; ?>">
					<div class="caption">

						<p><?php echo substr($Item['archivo'], 0, 10); ?></p>
						<p>
							<a href="#" id="BtnDescargarArchivo" class="btn btn-success btn-xs btn-small" role="button" data-id_archivo="<?php echo $Item['id_archivo']; ?>" data-id_digital="<?php echo $Item['id_digital']; ?>" data-archivo="<?php echo $Item['archivo']; ?>" data-id_ruta="<?php echo $Item['id_ruta']; ?>" data-tipo_archivo="<?php echo $Item['tipo']; ?>">
								<i class="fa fa-cloud-download"></i>
							</a>
						</p>
					</div>
				</div>
			</div>
		<?php
		}
		?>
	</div>
</div>