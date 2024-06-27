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
					<span class="semi-bold">Documentos Recibidos.</span>   
					<div class="row form-row">
						<div class="col-md-12">
							<?php
							$RadicadoInternoArchivos = RadicadoInternoAdjuntos::Listar(1, $_REQUEST['id_radica'], "");
							foreach($RadicadoInternoArchivos as $ItemRadicado):
								?>
								<span class="muted small-text">
									<a href="#" id="BtnDescargarArchivoInterno" class="descargar_pdf_interno" 
									data-id_radicado="<?php echo $ItemRadicado['id_radica']; ?>" 
									data-id_ruta="<?php echo $ItemRadicado['id_ruta']; ?>" 
									data-archivo="<?php echo $ItemRadicado['nom_archivo']; ?>">
									<img src="<?php echo MI_ROOT; ?>/public/assets/img/pdf.png" width="30" height="36"></a>
								</span>
								<?php
							endforeach;
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>