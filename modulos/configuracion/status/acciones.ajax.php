<?php
require_once '../../../config/class.Conexion.php';
require_once '../../clases/configuracion/class.Configstatus.php';

$Accion    = isset($_POST['accion']) ? $_POST['accion'] : null;
$id_status = isset($_POST['id_status']) ? $_POST['id_status'] : null;
$status    = isset($_POST['status']) ? $_POST['status'] : null;
$acti      = isset($_POST['acti']) ? $_POST['acti'] : null;

$FormaEnvio = new status();
$FormaEnvio -> set_Accion($Accion);
$FormaEnvio -> set_Id($id_status);
$FormaEnvio -> set_Nombre($status);
$FormaEnvio -> set_Acti($acti);
if($FormaEnvio -> Gestionar() == true){
	echo 1;
	exit();
}
?>