<?php
include "../../config/class.Conexion.php";
require_once '../clases/retencion/calss.TRD.php';

$id_depen             = $_REQUEST["id_depen"];
$id_serie             = $_REQUEST["id_serie"];
$id_sub_serie         = $_REQUEST["id_sub_serie"];
$Combo_Tipo_Documento = "";

$TRD = TRD::Listar(7, 0, $id_depen, $id_serie, $id_sub_serie);

$Combo_Tipo_Documento.= "<option value='0'>...::: Tipos Documentales :::...</option>";

if($_REQUEST["accion"] == 'Editar'){
	foreach($TRD as $Item):
		if($Item['id_tipodoc'] == $_REQUEST["id_tipo_doc"]){
			$Combo_Tipo_Documento.= "<option value='".$Item['id_tipodoc']."' selected>".$Item['nom_tipodoc']."</option>";
		}else{
			$Combo_Tipo_Documento.= "<option value='".$Item['id_tipodoc']."'>".$Item['nom_tipodoc']."</option>";
		}
	endforeach;
}else{
	foreach($TRD as $Item):
		$Combo_Tipo_Documento.= "<option value='".$Item['id_tipodoc']."'>".$Item['nom_tipodoc']."</option>";
	endforeach;
}
echo $Combo_Tipo_Documento;
?>