<?php
include "../../config/class.Conexion.php";
require_once '../clases/retencion/class.TRDTipoDocumento.php';

$Combo_Tipo_Documento = "";

$TipoDocumento = TipoDocumento::Listar(1, "", "");

$Combo_Tipo_Documento.= "<option value='0'>...::: Tipos Documentales :::...</option>";

foreach($TipoDocumento as $Item):
	$Combo_Tipo_Documento.= "<option value='".$Item['id_tipodoc']."'>".$Item['nom_tipodoc']."</option>";
endforeach;

echo $Combo_Tipo_Documento;
?>