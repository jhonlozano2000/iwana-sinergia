﻿<?php
include "../../../config/class.Conexion.php";
include "../../../config/funciones.php";
require_once '../../clases/radicar/class.RadicaRecibido.php';
require_once '../../clases/radicar/class.RadicaRecibidoResponsable.php';
include("../../../config/variable.php");

$RegisRadicado = RadicadoRecibido::Listar_Vario(1, $_POST['id_radica'], "", "", 0, 0, 0, "", "", "");
foreach ($RegisRadicado as $ItemRadicado):

	$Responsable = "";
	$Destinatarios = "";

	$RegisResponsable = RadicadoRecibidoResponsable::Listar(1, $ItemRadicado['id_radica'], "");
	foreach ($RegisResponsable as $ItemResponsa) {
		if ($ItemResponsa['respon'] == 1) {
			$Responsable .= "Funcio.: " . $ItemResponsa['nom_funcio'] . " " . $ItemResponsa['ape_funcio'] . "<br>Depen.: " . $ItemResponsa['nom_depen'];
		}

		$Destinatarios .= "[" . $ItemResponsa['nom_funcio'] . " " . $ItemResponsa['ape_funcio'] . " - " . $ItemResponsa['nom_depen'] . "]";
	}
?>
	<div class="col-md-4">
		<h4>
			<i class='glyphicon glyphicon-info-sign text-info'></i>
			<span class="semi-bold">Info.</span>
		</h4>
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
				<td>Fec. Veni.</td>
				<td><?php echo $ItemRadicado['fec_venci']; ?></td>
			</tr>
			<tr>
				<td>Fec. Rad. </td>
				<td><?php echo $ItemRadicado['fechor_radica']; ?></td>
			</tr>
			<tr>
				<td># Anexos </td>
				<td><?php echo $ItemRadicado['num_anexos']; ?></td>
			</tr>
			<tr>
				<td>Observa. Anexos </td>
				<td><?php echo $ItemRadicado['observa_anexo']; ?></td>
			</tr>
			<tr>
				<td># Folios </td>
				<td><?php echo $ItemRadicado['num_folio']; ?></td>
			</tr>
			<tr>
				<td>Radicado Por </td>
				<td><?php echo utf8_encode($ItemRadicado['nom_funcio_regis'] . " " . $ItemRadicado['ape_funcio_regis']); ?></td>
			</tr>
			<tr>
				<td>Tipo Llegada </td>
				<td><?php echo $ItemRadicado['nom_forma_llega']; ?></td>
			</tr>
		</table>
	</div>
	<div class="col-md-3">
		<h4>
			<i class='fa fa-user text-info'></i>
			<span class="semi-bold">Remitente.</span>
		</h4>
		<table width="251" class="table table-hover table-condensed" id="example">
			<tr>
				<td width="85">Nit. </td>
				<td width="154"><?php echo $ItemRadicado['num_docu_remite']; ?></td>
			</tr>
			<tr>
				<td>Tercero </td>
				<td><?php echo utf8_encode($ItemRadicado['nom_remite']); ?></td>
			</tr>
			<tr>
				<td>Dirección </td>
				<td><?php echo utf8_encode($ItemRadicado['dir_remite']); ?></td>
			</tr>
			<tr>
				<td>Teléfono </td>
				<td><?php echo $ItemRadicado['tel_remite']; ?></td>
			</tr>
			<tr>
				<td>Fax </td>
				<td><?php echo $ItemRadicado['fax_remite']; ?></td>
			</tr>
			<tr>
				<td>E - Mail </td>
				<td><?php echo $ItemRadicado['email_remite']; ?></td>
			</tr>
			<tr>
				<td>Cargo </td>
				<td><?php echo $ItemRadicado['cargo']; ?></td>
			</tr>
		</table>
	</div>
	<div class="col-md-5">
		<h4>
			<i class='fa fa-users text-info'></i>
			<span class="semi-bold">Destinatarios.</span>
		</h4>
		<table class="table table-hover table-condensed" id="example">
			<tr>
				<td><?php echo utf8_encode("<p class='text-success'>Responsable</p>" . $Responsable); ?></td>
			</tr>
		</table>
		<table class="table table-hover table-condensed" id="example">
			<tr>
				<td><?php echo utf8_encode("<p class='text-success'>Destinaratios</p>" . $Destinatarios); ?></td>
			</tr>

		</table>
	</div>
<?php
endforeach;
?>