<?php
include "../../config/class.Conexion.php";
require_once "../clases/areas/class.AreasCargo.php";
$Cargos = Cargo::Listar(4, 0, $_POST['idDepen'], "", "", ""); 

$Combo_Cargos = "";
$Combo_Cargos.= "<option value='0'>...::: Elije la Cargo :::...</option>";
foreach($Cargos as $Item):
	$Combo_Cargos.= "<option value='".$Item['id_cargo']."'>".$Item['nom_cargo']."</option>";
endforeach;

echo $Combo_Cargos;
?>