<?php
include "../../../config/class.Conexion.php";
include "../../../config/funciones.php";
require_once '../../clases/radicar/class.RadicaInterno.php';
include("../../../config/variable.php");

$RadicadoInterno = RadicadoInterno::Listar_Varios(1, $_POST['id_radica'], "", "", 0, 0, 0, "", "", "");
foreach($RadicadoInterno as $ItemRadicado):
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