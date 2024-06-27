<?php
require_once "../../config/class.Conexion.php";
require_once "../clases/configuracion/class.ConfigDepartamento.php";

$Departamentos = Departamento::Listar();

$Combo_Departamentos = "";
$Combo_Departamentos.= "<option value='0'>...::: Elije el Departamento :::...</option>";
foreach($Departamentos as $Item):
	$Combo_Departamentos.= "<option value='".$Item['id_depar']."'>".$Item['nom_depar']."</option>";
endforeach;

echo $Combo_Departamentos;
?>