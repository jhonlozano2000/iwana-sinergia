<?php
require_once "../../../../../config/class.Conexion.php";
require_once "../../../../clases/radicar/class.RadicaEnviadoTempNota.php";
require_once "../../../../../config/funciones.php";
session_start();

$Accion          = isset($_POST['accion']) ? $_POST['accion'] : null;
$IdTemp          = isset($_POST['IdTemp']) ? $_POST['IdTemp'] : null;
$IdFuncioDestino = isset($_POST['IdFuncioDestino']) ? $_POST['IdFuncioDestino'] : null;
$Mensaje         = isset($_POST['nota']) ? $_POST['nota'] : null;

switch($Accion){
	case 'GUARDAR_NOTA':

		$Nota = new RadicadoEnviadoTempNota();
		$Nota -> set_Accion('GUARDAR_NOTA');
		$Nota -> set_IdTemp($IdTemp);
		$Nota -> set_IdFuncio($_SESSION['SesionFuncioDetaId']);
		$Nota -> set_FecHorNota(Fecha_Hora_Actual());
		$Nota -> set_Nota($Mensaje);
		if($Nota->Gestionar() === true){
			echo 1;
			exit();
		}
		
	break;
	
	default:
		echo 'No hay accion para realizar.';
}
?>