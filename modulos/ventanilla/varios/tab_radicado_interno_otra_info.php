﻿<?php
include "../../../config/class.Conexion.php";
include "../../../config/funciones.php";
require_once '../../clases/radicar/class.RadicaInterno.php';
include("../../../config/variable.php");

$RadicadoInterno = RadicadoInterno::Listar_Varios(1, $_POST['id_radica'], "", "", 0, 0, 0, "", "", "");
foreach($RadicadoInterno as $item):

	if($item['fec_venci'] != "" or $item['requie_respuesta'] == 1){

		$DiasTrascurridos  = DiasTrascurridos($item['fechor_radica']);
		$DiasParaRespuesta = DiasParaRespuesta($item['fechor_radica'], $item['fec_venci']);
		$TotalDias = $DiasParaRespuesta-$DiasTrascurridos;

		$TiempoTrascurrido = "";
		if($TotalDias < 0){
			$Clase             = "danger";
			$ClaseTexto        = "Vencido";
			$ClaseColorTexto   = "text-error";
			$TiempoTrascurrido = "<strong>Retraso de ".$TotalDias." días</strong>";
			$FechaRadicado     = "<strong>".$item['fechor_radica']."</strong>";
			$RequieRespues     = "<strong>Si</strong>";
			$BagroundColor     = "#FA5858";
			$ColorTextoTitulo  = "text-white";
		}elseif($TotalDias >= 0 and $TotalDias <= 3){
			$Clase             = "warning";
			$ClaseTexto        = "Por Vencer";
			$ClaseColorTexto   = "text-warning";
			$TiempoTrascurrido = "<strong>Faltan ".$TotalDias." días de ".$DiasParaRespuesta."</strong>";
			$FechaRadicado     = "<strong>".$item['fechor_radica']."</strong>";
			$RequieRespues     = "<strong>Si</strong>";
			$BagroundColor     = "#FACC2E";
			$ColorTextoTitulo  = "text-light";
		}elseif($TotalDias >= 4 and $TotalDias <= 5){
			$Clase             = "warning";
			$ClaseTexto        = "Pro Vencer";
			$ClaseColorTexto   = "text-warning";
			$TiempoTrascurrido = "<strong>Faltan ".$TotalDias." días de ".$DiasParaRespuesta."</strong>";
			$FechaRadicado     = "<strong>".$item['fechor_radica']."</strong>";
			$RequieRespues     = "<strong>Si</strong>";
			$BagroundColor     = "#FACC2E";
			$ColorTextoTitulo  = "text-light";
		}elseif($TotalDias > 5){
			$Clase             = "";
			$ClaseTexto        = "";
			$ClaseColorTexto   = "";
			$TiempoTrascurrido = "<strong>Faltan ".$TotalDias." días de ".$DiasParaRespuesta."</strong>";
			$FechaRadicado     = "<strong>".$item['fechor_radica']."</strong>";
			$RequieRespues     = "<strong>Si</strong>";
			$ColorTextoTitulo  = "";

		}
	}else{
		$Clase = "";
		$ClaseTexto = "";
		$ClaseColorTexto = "";
		$TiempoTrascurrido = "---";
	}
	?>
	<div class="control">
		<div class="pull-left">
			<div class="checkbox checkbox check-success <?php echo $ColorTextoTitulo; ?>">
				<?php
				$RequieRespues = "Requiere respuesta: No";
				if($item['requie_respuesta'] == 1){
					$RequieRespues = "Requiere respuesta: Si";
				}

				echo $RequieRespues;
				?>
			</div>
		</div>
		<div class="pull-left">
			<?php
			if($item['fec_venci'] != "" or $item['requie_respuesta'] == 1){
				?>
				<label for="chkTerms"># Días para vencimiento del documento 
					<strong><?php echo $DiasTrascurridos."/".$TotalDias; ?></strong>
				</label>

				<?php 
				if($item['radica_respuesta'] == ""){
					echo '<p class="text-error"><strong>Sin Respuesta.</strong></p>';
				}
			}elseif($item['radica_respuesta'] == 1){
				echo '<p class="text-info"><strong>Con Respuesta.</strong></p>';
			} 
			?>
		</div>
		<div class="clearfix"></div>
	</div>
	
	<?php
endforeach;
?>