<?php
require_once "../../../../config/class.Conexion.php";
require_once "../../../clases/oficina_archivo/class.OficinaArchivoDigitalizacionTRDTomo.php";

$IdDigital  = isset($_POST['id_digital']) ? $_POST['id_digital'] : null;

$TotalTomos = DigitalizacioTRDTomo::Listar(1, "", $IdDigital, "");
$Tomos      = DigitalizacioTRDTomo::Listar(2, "", $IdDigital, "");

$Combo_Tomos = "";
foreach ($Tomos as $Item) {
    $Combo_Tomos.= "<option value='".$Item['id_tomo']."'>".$Item['nom_tomo']." de ".$TotalTomos['TotalTomos']."</option>";  
}

echo $Combo_Tomos;
?>