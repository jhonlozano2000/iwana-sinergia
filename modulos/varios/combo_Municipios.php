<?php
require_once "../../config/class.Conexion.php";
require_once "../clases/configuracion/class.ConfigMunicipio.php";

$Municipios = Municipio::Listar(1, $_POST['idDepar']);

$Combo_Municipios = "";
$Combo_Municipios.= "<option value='0'>...::: Elije el Municipio :::...</option>";
foreach($Municipios as $Item):
	$Combo_Municipios.= "<option value='".$Item['id_muni']."'>".$Item['nom_muni']."</option>";
endforeach;

echo $Combo_Municipios;
?>