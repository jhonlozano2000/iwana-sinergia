<?php
session_start();
require_once "../../../../config/class.Conexion.php";
require_once "../../../../config/variable.php";
require_once "../../../../config/funciones.php";
require_once "../../../../config/funciones_seguridad.php";
require_once "../../../clases/radicar/class.RadicaEnviado Final.php";

$Accion     = isset($_POST['accion']) ? $_POST['accion'] : null;
$IdRadicado = isset($_POST['id_radica']) ? $_POST['id_radica'] : null;
$NumFolios  = isset($_POST['num_folio']) ? $_POST['num_folio'] : null;
$IdRuta     = isset($_POST['id_ruta']) ? $_POST['id_ruta'] : null;

switch ($Accion){
	case 'IMPRIMIR_ROTULO':
		$Radicado = new RadicadoEnviado();
		$Radicado -> set_Accion(2);
		$Radicado -> set_IdRadica($IdRadicado);
		$Radicado -> set_FecHorImpriRoru(Fecha_Hora_Actual());
		$Radicado -> set_UsuaImpriRotu($_SESSION['SesionUsuaId']);
		if($Radicado -> Gestionar() == 'true'){
			echo 1;
			exit();
		}
	break;
	case 'RADICADO_CARGAR_DIGITAL':
		$Radicado = new RadicadoEnviado();
		$Radicado -> set_Accion(4);
		$Radicado -> set_IdRadica($IdRadicado);
		$Radicado -> set_NumFolios($NumFolios);
		$Radicado -> set_IdRuta($IdRuta);
		if($Radicado -> Gestionar() == 'true'){
			echo 1;
			exit();
		}
	break;
	default:
		echo 'No hay accion para realizar.'.$Accion;
	break;
}
?>
