<?php
require_once '../../../config/class.Conexion.php';
require_once '../../clases/configuracion/class.ConfigTipoCorrespondencia.php';

$Accion    = isset($_POST['accion']) ? $_POST['accion'] : null;
$id_tipo   = isset($_POST['id_tipo']) ? $_POST['id_tipo'] : null;
$id_origen = isset($_POST['id_origen']) ? $_POST['id_origen'] : null;
$nom_tipo  = isset($_POST['nom_tipo']) ? $_POST['nom_tipo'] : null;
$acti      = isset($_POST['acti']) ? $_POST['acti'] : null;

if($Accion == 'Insertar'){
	$Buscar = TipoCorrespondencia::Buscar(1, "", $id_origen, $nom_tipo);
	if($Buscar){
		echo "Ya se encuentra registrado un tipo de correspondencia.";
		exit();
	}
}

$FormaEnvio = new TipoCorrespondencia();
$FormaEnvio -> set_Accion($Accion);
$FormaEnvio -> set_Id($id_tipo);
$FormaEnvio -> set_IdOrigen($id_origen);
$FormaEnvio -> set_NombreTipo($nom_tipo);
$FormaEnvio -> set_Acti($acti);
if($FormaEnvio -> Gestionar() == true){
	echo 1;
	exit();
}
?>