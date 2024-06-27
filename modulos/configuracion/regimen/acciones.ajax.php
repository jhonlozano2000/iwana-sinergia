<?php
require_once '../../../config/class.Conexion.php';
require_once '../../clases/configuracion/class.ConfigRegimen.php';

$Accion      = isset($_POST['accion']) ? $_POST['accion'] : null;
$id_regimen  = isset($_POST['id_regimen']) ? $_POST['id_regimen'] : null;
$nom_regimen = isset($_POST['nom_regimen']) ? $_POST['nom_regimen'] : null;
$acti        = isset($_POST['acti']) ? $_POST['acti'] : null;

$FormaEnvio = new Regimen();
$FormaEnvio -> set_Accion($Accion);
$FormaEnvio -> set_Id($id_regimen);
$FormaEnvio -> set_Nombre($nom_regimen);
$FormaEnvio -> set_Acti($acti);
if($FormaEnvio -> Gestionar() == true){
	echo 1;
	exit();
}
?>