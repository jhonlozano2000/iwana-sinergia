<?php
session_start();
include "../../../../config/class.Conexion.php";
include "../../../../config/variable.php";
include "../../../../config/funciones.php";
include "../../../../config/funciones_seguridad.php";
require_once '../../../clases/radicar/class.RadicaEnviadoTemp.php';

$IdTemp     = isset($_POST['IdTemp']) ? $_POST['IdTemp'] : null;

$Temp = new RadicadoEnviadoTemp();
$Temp->set_Accion('RADICAR_TEMP');
$Temp->set_IdTemp($IdTemp);
if($Temp->Gestionar() === true){
	echo 1;
	exit();
}
?>