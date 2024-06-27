<?php
require_once '../../../config/class.Conexion.php';
require_once '../../clases/configuracion/class.ConfigFormaEnvio.php';

$Accion        = isset($_POST['accion']) ? $_POST['accion'] : null;
$id_formaenvio = isset($_POST['id_formaenvio']) ? $_POST['id_formaenvio'] : null;
$nom_formaenvi = isset($_POST['nom_formaenvi']) ? $_POST['nom_formaenvi'] : null;
$observa       = isset($_POST['observa']) ? $_POST['observa'] : null;
$acti          = isset($_POST['acti']) ? $_POST['acti'] : null;

$FormaEnvio = new FormaEnvio();
$FormaEnvio -> set_Accion($Accion);
$FormaEnvio -> set_IdForma($id_formaenvio);
$FormaEnvio -> set_NomForma($nom_formaenvi);
$FormaEnvio -> set_Observa($observa);
$FormaEnvio -> set_Acti($acti);
if($FormaEnvio -> Gestionar() == true){
	echo 1;
	exit();
}
?>