<?php
require_once '../../../config/class.Conexion.php';
require_once '../../clases/seguridad/class.SeguridadUsuario.php';
require_once '../../clases/configuracion/class.ConfigTipoRespuesta.php';

$Accion    = isset($_POST['accion']) ? $_POST['accion'] : null;
$id_respue = isset($_POST['id_respue']) ? $_POST['id_respue'] : null;
$nom_respues    = isset($_POST['nom_respues']) ? $_POST['nom_respues'] : null;
$acti      = isset($_POST['acti']) ? $_POST['acti'] : null;

$TipoRespues = new TipoRespuesta();
$TipoRespues->set_Accion($Accion);
$TipoRespues->set_Id($id_respue);
$TipoRespues->set_Nombre($nom_respues);
$TipoRespues->set_Acti($acti);
if ($TipoRespues->Gestionar() == true) {
	echo 1;
	exit();
}
