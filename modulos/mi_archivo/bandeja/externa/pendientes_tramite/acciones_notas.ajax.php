<?php
session_start();
require_once "../../../../../config/class.Conexion.php";
require_once "../../../../clases/radicar/class.RadicaEnviadoTempNota.php";
require_once "../../../../../config/funciones.php";

$Accion          = isset($_POST['accion']) ? $_POST['accion'] : null;
$IdTemp          = isset($_POST['IdTemp']) ? $_POST['IdTemp'] : null;
$IdFuncioDestino = isset($_POST['IdFuncioDestino']) ? $_POST['IdFuncioDestino'] : null;
$Nota            = isset($_POST['nota']) ? $_POST['nota'] : null;

switch($Accion){
	case 'GUARDAR_NOTA':

		$date = date(Fecha_Hora_Actual());
		$newDate = strtotime('-2 hour', strtotime($date)); 
		$newDate = date('Y-m-j H:i:s', $newDate);

		$Nota = new RadicadoEnviadoTempNota();
		$Nota -> set_Accion('GUARDAR_NOTA');
		$Nota -> set_IdTemp($IdTemp);
		$Nota -> set_IdFuncioOrigen($_SESSION['SesionFuncioDetaId']);
		$Nota -> set_IdFuncioDestino($IdFuncioDestino);
		$Nota -> set_FecHorNota($newDate);
		$Nota -> set_Nota($Nota);
		if($Nota->Gestionar() === true){
			echo 1;
			exit();
		}
		
	break;
	
	default:
		echo 'No hay accion para realizar.';
}
?>