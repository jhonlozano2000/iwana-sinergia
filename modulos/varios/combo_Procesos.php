<?php
require_once "../../config/class.Conexion.php";
require_once "../clases/calidad/class.CalidadProceso.php";

$procesos = Proceso::Listar(2, $_POST['idDepen'], "", "");

$Combo_Procesos = "";
$Combo_Procesos .= "<option value='0'>...::: Elije el Proceso :::...</option>";
foreach ($procesos as $Item) :
	$Combo_Procesos .= "<option value='" . $Item['proceso_id'] . "'>" . $Item['cod_proce'] . " - " . $Item['nom_proce'] . "</option>";
endforeach;

echo $Combo_Procesos;
