<?php
include "../../config/class.Conexion.php";
require_once '../clases/areas/class.AreasDependencia.php';

$Combo_Dependencias = "";
$Combo_Dependencias .= "<option value='0'>...::: Elije la dependencia :::...</option>";

$Dependencia = Dependencia::Listar(6, "", "", "", "");;
foreach ($Dependencia as $Item):
	$Combo_Dependencias .= "<option value='" . $Item['id_depen'] . "'>" . $Item['cod_corres'] . "." . $Item['nom_depen'] . "</option>";
endforeach;

echo $Combo_Dependencias;
exit();
