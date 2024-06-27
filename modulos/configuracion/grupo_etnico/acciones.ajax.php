<?php
require_once '../../../config/class.Conexion.php';
require_once '../../clases/configuracion/class.ConfigGrupoEtnico.php';

$Accion           = isset($_POST['accion']) ? $_POST['accion'] : null;
$id_grupo_etnico  = isset($_POST['id_grupo_etnico']) ? $_POST['id_grupo_etnico'] : null;
$nom_grupo_etnico = isset($_POST['nom_grupo_etnico']) ? $_POST['nom_grupo_etnico'] : null;
$acti             = isset($_POST['acti']) ? $_POST['acti'] : null;

if($Accion == 'INSERTAR'){
	$Buscar = GrupoEtnico::Buscar(3, "", $nom_grupo_etnico);
	if($Buscar){
		echo "Ya existe un registro con el nombre ".$nom_grupo_etnico;
		exit();
	}
}

$FormaEnvio = new GrupoEtnico();
$FormaEnvio -> set_Accion($Accion);
$FormaEnvio -> set_Id($id_grupo_etnico);
$FormaEnvio -> set_Nombre($nom_grupo_etnico);
$FormaEnvio -> set_Acti($acti);
if($FormaEnvio -> Gestionar() == true){
	echo 1;
	exit();
}
?>