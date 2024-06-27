<?php
session_start();
require_once "../../../../../config/class.Conexion.php";
require_once "../../../../../config/funciones.php";
require_once "../../../../../config/variable.php";
require_once "../../../../../config/funciones_seguridad.php";
require_once "../../../../clases/radicar/class.RadicaRecibido.php";
require_once "../../../../clases/radicar/class.RadicaRecibidoResponsable.php";

$Accion        = isset($_POST['accion']) ? $_POST['accion'] : null;
$IdRadica      = isset($_POST['id_radica']) ? $_POST['id_radica'] : null;

switch ($Accion){
	case 'Desbloquear':
		
		$Radicado = new RadicadoRecibido();
		$Radicado -> set_Accion($Accion);
		$Radicado -> set_IdRadica($IdRadica);

		if($Radicado -> Gestionar() === true){
			echo 1;
			exit();
		}else{
			echo "Error";
			exit();
		}
	break;
	case 'MARCAR_LEIDO':
		$Radicado = new RadicadoRecibidoResponsable();
		$Radicado -> set_Accion('MARCAR_LEIDO');
		$Radicado -> set_IdRadica($IdRadica);
		$Radicado -> set_Leido(1);
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