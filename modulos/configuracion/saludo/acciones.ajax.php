<?php
require_once '../../../config/class.Conexion.php';
require_once '../../clases/configuracion/class.ConfigSaludo.php';

$Accion    = isset($_POST['accion']) ? $_POST['accion'] : null;
$id_saludo = isset($_POST['id_saludo']) ? $_POST['id_saludo'] : null;
$saludo    = isset($_POST['saludo']) ? $_POST['saludo'] : null;
$acti      = isset($_POST['acti']) ? $_POST['acti'] : null;

$FormaEnvio = new Saludo();
$FormaEnvio -> set_Accion($Accion);
$FormaEnvio -> set_Id($id_saludo);
$FormaEnvio -> set_Nombre($saludo);
$FormaEnvio -> set_Acti($acti);
if($FormaEnvio -> Gestionar() == true){
	echo 1;
	exit();
}
?>