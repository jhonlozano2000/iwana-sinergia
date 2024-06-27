<?php
include "../../../config/class.Conexion.php";
include "../../../config/funciones.php";
require_once '../../clases/radicar/class.RadicaRecibido.php';
require_once '../../clases/radicar/class.RadicaRecibidoResponsable.php';
include("../../../config/variable.php");

$RegisRadicado = RadicadoRecibido::Listar_Vario(1, $_POST['id_radica'], "", "", 0, 0, 0, "", "", "");
foreach($RegisRadicado as $ItemRadicado):

	$Responsable = "";
	$Destinatarios = "";

	$RegisResponsable = RadicadoRecibidoResponsable::Listar(1, $ItemRadicado['id_radica'], "");
	foreach ($RegisResponsable as $ItemResponsa) {
		if($ItemResponsa['respon'] == 1){
			$Responsable.= "[".$ItemResponsa['nom_depen']."] ".$ItemResponsa['nom_funcio']." - ".$ItemResponsa['ape_funcio'];
		}

		$Destinatarios.= "["." - ".$ItemResponsa['nom_depen']."] ".$ItemResponsa['nom_funcio']." - ".$ItemResponsa['ape_funcio'];
	}
	?>
	
	<div class="col-md-4">
		<h4>
			<i class='fa fa-users text-info'></i> 
			<span class="semi-bold">Clasificación Documental.</span>
		</h4>
		<table width="251" class="table table-hover table-condensed" id="example">
			<tr>
				<td>Serie </td>
				<td><?php echo utf8_encode($ItemRadicado['cod_serie']." - ".$ItemRadicado['nom_serie']); ?></td>
			</tr>
			<tr>
				<td>Sub Serie </td>
				<td><?php echo utf8_encode($ItemRadicado['cod_subserie']." - ".$ItemRadicado['nom_subserie']); ?></td>
			</tr>
			<tr>
				<td>Tipo Documento </td>
				<td><?php echo utf8_encode($ItemRadicado['nom_tipodoc']); ?></td>
			</tr>
		</table>
	</div>
	<?php
endforeach;
?>