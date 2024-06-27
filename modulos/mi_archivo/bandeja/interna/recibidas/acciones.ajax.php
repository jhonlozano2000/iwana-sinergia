<?php
include "../../../../../config/class.Conexion.php";
require_once "../../../../clases/radicar/class.RadicaInternoDestinatario.php";
session_start();

$Accion   = isset($_POST['accion']) ? $_POST['accion'] : null;
$IdRadica = isset($_POST['id_radica']) ? $_POST['id_radica'] : null;

switch ($Accion){
	case 'MARCAR_LEIDO':
		$Radicado = new RadicadoInternoDestinatario();
		$Radicado -> set_Accion('MARCAR_LEIDO');
		$Radicado -> set_IdRadica($IdRadica);
		$Radicado -> set_IdFuncio($_SESSION['SesionFuncioDetaId']);
		if($Radicado -> Gestionar() === true){
			echo 1;
			exit();
		}
	break;
	default:
		echo 'No hay accion para realizar.'.$Accion;
}
?>