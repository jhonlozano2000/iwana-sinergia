<?php
require_once "../../config/class.Conexion.php";
require_once "../clases/calidad/class.CalidadProcedimientos.php";

$procesos = Procedimiento::Listar(2, $_POST['idProceso'], "", "");

$Combo_Procedimientos = "";
$Combo_Procedimientos .= "<option value='0'>...::: Elije el Procedimiento :::...</option>";
foreach ($procesos as $Item) :
	$Combo_Procedimientos .= "<option value='" . $Item['procedimiento_id'] . "'>" . $Item['cod_procedimiento'] . " - " . $Item['nom_procedimiento'] . "</option>";
endforeach;

echo $Combo_Procedimientos;
