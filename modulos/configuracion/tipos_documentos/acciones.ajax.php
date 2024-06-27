<?php
require_once '../../../config/class.Conexion.php';
require_once '../../clases/configuracion/class.ConfigTipoCocumento.php';

$Accion    = isset($_POST['accion']) ? $_POST['accion'] : null;
$id_tipo = isset($_POST['id_tipo']) ? $_POST['id_tipo'] : null;
$cod_tipo    = isset($_POST['cod_tipo']) ? $_POST['cod_tipo'] : null;
$nom_tipo    = isset($_POST['nom_tipo']) ? $_POST['nom_tipo'] : null;
$acti      = isset($_POST['acti']) ? $_POST['acti'] : null;

$TipoDocu = new TipoDocumento();
$TipoDocu->set_Accion($Accion);
$TipoDocu->set_Id($id_tipo);
$TipoDocu->set_CodTipo($nom_tipo);
$TipoDocu->set_NomTipo($nom_tipo);
$TipoDocu->set_Acti($acti);
if ($TipoDocu->Gestionar() == true) {
	echo 1;
	exit();
}
