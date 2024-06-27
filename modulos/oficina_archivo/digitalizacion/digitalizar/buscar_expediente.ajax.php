<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){

	require_once '../../../../config/class.Conexion.php';
	require_once '../../../../config/funciones.php';
	require_once '../../../clases/oficina_archivo/class.OficinaArchivoDigitalizacion.php';
	
	$IdDepen    = isset($_POST['id_depen']) ? $_POST['id_depen'] : null;
	$IdSerie    = isset($_POST['id_serie']) ? $_POST['id_serie'] : null;
	$IdSubSerie = isset($_POST['id_subserie']) ? $_POST['id_subserie'] : null;
	$Codigo     = isset($_POST['codigo']) ? $_POST['codigo'] : null;
	$Titulo     = isset($_POST['titulo']) ? $_POST['titulo'] : null;
	$FecIni     = isset($_POST['fec_ini']) ? $_POST['fec_ini'] : null;
	$FecFin     = isset($_POST['fec_fin']) ? $_POST['fec_fin'] : null;
	$Criterio1  = isset($_POST['criterio1']) ? $_POST['criterio1'] : null;
	$Criterio2  = isset($_POST['criterio2']) ? $_POST['criterio2'] : null;
	$Criterio3  = isset($_POST['criterio3']) ? $_POST['criterio3'] : null;
	
	$Expediente = Digitalizacion::Listar(5, 0, $IdDepen, $IdSerie, $IdSubSerie, $Codigo, $Titulo, $Criterio1, $Criterio2, $Criterio3);
	?>
	<table class="table table-hover table-condensed" id="Tbl2">
		<thead>
			<tr>
				<th style="width:12%">Dependencia</th>
				<th style="width:12%">Serie</th>
				<th style="width:16%">SubSerie</th>
				<th style="width:12%">Código</th>
				<th style="width:12%">Titulo</th>
				<th style="width:12%">Detalle 1</th>
				<th style="width:12%">Detalle 2</th>
				<th style="width:12%">Detalle 3</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach($Expediente as $Item):
				?>
				<td class="v-align-middle"><?php echo $Item['nom_depen']; ?></td>
				<td class="v-align-middle"><?php echo $Item['cod_serie'].".".$Item['nom_serie']; ?></td>
				<td class="v-align-middle"><?php echo $Item['cod_subserie'].".".$Item['nom_subserie']; ?></td>
				<td class="v-align-middle"><?php echo $Item['codigo']; ?></td>
				<td class="v-align-middle"><?php echo $Item['titulo']; ?></td>
				<td class="v-align-middle"><?php echo $Item['criterio1']; ?></td>
				<td class="v-align-middle"><?php echo $Item['criterio2']; ?></td>
				<td class="v-align-middle"><?php echo $Item['criterio3']; ?></td>
			</tr>
			<?php
		endforeach;
		?>
	</tbody>
</table>
<?php
}
?>