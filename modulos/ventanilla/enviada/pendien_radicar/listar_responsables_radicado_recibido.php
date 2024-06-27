<?php
include "../../../../config/class.Conexion.php";
require_once '../../../clases/radicar/class.RadicaRecibidoResponsable.php';

$DatosRadicado = array();
$RegisRadicado = RadicadoRecibidoResponsable::Listar(2, $_REQUEST['id_radica'], "", "", 0, 0, 0, "", "", "");
foreach($RegisRadicado as $ItemRadicado):
	$DatosRadicado[0] = $ItemRadicado['id_funcio_deta'];
	$DatosRadicado[1] = $ItemRadicado['id_funcio'];
	$DatosRadicado[2] = $ItemRadicado['cod_funcio'];
	$DatosRadicado[3] = $ItemRadicado['nom_funcio'];
	$DatosRadicado[4] = $ItemRadicado['ape_funcio'];
	$DatosRadicado[5] = $ItemRadicado['id_depen'];
	$DatosRadicado[6] = $ItemRadicado['cod_depen'];
	$DatosRadicado[7] = $ItemRadicado['cod_corres_depen'];
	$DatosRadicado[8] = $ItemRadicado['nom_depen'];
	$DatosRadicado[9] = $ItemRadicado['id_oficina'];
	$DatosRadicado[10] = $ItemRadicado['nom_oficina'];
	$DatosRadicado[11] = $ItemRadicado['id_cargo'];
	$DatosRadicado[12] = $ItemRadicado['nom_cargo'];
	$DatosRadicado[13] = $ItemRadicado['respon'];
endforeach;

echo json_encode($DatosRadicado);
?>