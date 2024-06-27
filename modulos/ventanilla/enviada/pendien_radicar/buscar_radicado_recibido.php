<?php
include "../../../../config/class.Conexion.php";
require_once '../../../clases/radicar/class.RadicaRecibido.php';
require_once '../../../clases/radicar/class.RadicaRecibidoResponsable.php';
require_once '../../../clases/general/class.GeneralTercero.php';

$DatosRadicado = array();

$RegisRadicado = RadicadoRecibido::Listar_Vario(1, $_REQUEST['id_radica'], "", "", 0, 0, 0, "", "", "");
foreach($RegisRadicado as $ItemRadicado):

	$DatosRadicado[0]  = $ItemRadicado['asunto'];
	$DatosRadicado[1]  = $ItemRadicado['id_serie'];
	$DatosRadicado[2]  = $ItemRadicado['id_subserie'];
	$DatosRadicado[3]  = $ItemRadicado['id_tipodoc'];

	$Tercerto = Tercero::Listar(2, $ItemRadicado['id_tercero'], "", "", "", "", "");
	foreach($Tercerto as $ItemTercero):
		$DatosRadicado[17] = $ItemTercero['id_tercero'];
		$DatosRadicado[18] = $ItemTercero['num_docu'];
		$DatosRadicado[19] = $ItemTercero['nom_contac'];
		$DatosRadicado[20] = $ItemTercero['cargo'];
		$DatosRadicado[21] = $ItemTercero['dir_remite'];
		$DatosRadicado[22] = $ItemTercero['tel_remite'];
		$DatosRadicado[23] = $ItemTercero['cel_remite'];
		$DatosRadicado[24] = $ItemTercero['nit_empre'];
		$DatosRadicado[25] = $ItemTercero['razo_soci'];
	endforeach;

	$RegisResponsable = RadicadoRecibidoResponsable::Listar(2, $_REQUEST['id_radica'], "", "", 0, 0, 0, "", "", "");
	foreach($RegisResponsable as $ItemResponsable):
		$DatosRadicado[4]  = $ItemResponsable['id_funcio_deta'];
		$DatosRadicado[5]  = $ItemResponsable['id_funcio'];
		$DatosRadicado[6]  = $ItemResponsable['cod_funcio'];
		$DatosRadicado[7]  = $ItemResponsable['nom_funcio'];
		$DatosRadicado[8]  = $ItemResponsable['ape_funcio'];
		$DatosRadicado[9]  = $ItemResponsable['id_depen'];
		$DatosRadicado[10] = $ItemResponsable['cod_depen'];
		$DatosRadicado[11] = $ItemResponsable['cod_corres_depen'];
		$DatosRadicado[12] = $ItemResponsable['nom_depen'];
		$DatosRadicado[13] = $ItemResponsable['id_oficina'];
		$DatosRadicado[14] = $ItemResponsable['nom_oficina'];
		$DatosRadicado[15] = $ItemResponsable['id_cargo'];
		$DatosRadicado[16] = $ItemResponsable['nom_cargo'];
	endforeach;
endforeach;

echo json_encode($DatosRadicado);
?>