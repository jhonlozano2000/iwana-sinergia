<?php
include "../../config/class.Conexion.php";
require_once "../clases/general/class.GeneralTercero.php";

$Empresa = Tercero::Listar(10, 0, 0, "", "", "", ""); 

$Combo_Empresa = "";
$Combo_Empresa.= "<option value='0'>...::: Elije la Empresa :::...</option>";
foreach($Empresa as $Item):
	$Combo_Empresa.= "<option value='".$Item['id_empre']."'>".$Item['razo_soci']."</option>";
endforeach;

echo $Combo_Empresa;
?>