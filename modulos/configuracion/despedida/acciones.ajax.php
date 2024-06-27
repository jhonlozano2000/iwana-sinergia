<?php
require_once '../../../config/class.Conexion.php';
require_once '../../clases/configuracion/class.Configdespedida.php';

$Accion    = isset($_POST['accion']) ? $_POST['accion'] : null;
$id_despedida = isset($_POST['id_despedida']) ? $_POST['id_despedida'] : null;
$despedida    = isset($_POST['despedida']) ? $_POST['despedida'] : null;
$acti      = isset($_POST['acti']) ? $_POST['acti'] : null;

$FormaEnvio = new Despedida();
$FormaEnvio -> set_Accion($Accion);
$FormaEnvio -> set_Id($id_despedida);
$FormaEnvio -> set_Nombre($despedida);
$FormaEnvio -> set_Acti($acti);
if($FormaEnvio -> Gestionar() == true){
	echo 1;
	exit();
}
?>