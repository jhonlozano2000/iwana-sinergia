<?php
require_once "../../../../../config/class.Conexion.php";
require_once '../../../../clases/radicar/class.RadicaRecibido.php';
require_once '../../../../clases/configuracion/class.ConfigOtras_Respon_HC.php';
require_once "../../../../clases/radicar/class.RadicaEnviadoTemp.php";
require_once "../../../../clases/radicar/class.RadicaEnviadoTempResponsables.php";
require_once "../../../../clases/radicar/class.RadicaEnviadoTempRespuestas.php";
require_once "../../../../../config/funciones.php";
session_start();

$Accion        = isset($_POST['accion']) ? $_POST['accion'] : null;
$IdRadica      = isset($_POST['id_radica']) ? $_POST['id_radica'] : null;
$IdSerie       = isset($_POST['id_serie']) ? $_POST['id_serie'] : null;
$IdSubSerie    = isset($_POST['id_subserie']) ? $_POST['id_subserie'] : null;
$IdTipoDoc     = isset($_POST['id_tipodoc']) ? $_POST['id_tipodoc'] : null;
$IdDetinatario = isset($_POST['id_destina']) ? $_POST['id_destina'] : null;
$Asunto        = isset($_POST['asunto']) ? $_POST['asunto'] : null;

switch ($Accion){
	case 'TERMINAR_TRAMITE':

		/*******************************************************************
		/* SABER SI EL RADICADO YA TEIEN UN TEMPORAL
		/*******************************************************************/
		$BuscarRespuestra = RadicaEnviadoTempRespuestas::Buscar(2, "", $IdRadica);
		if($BuscarRespuestra){
			echo "La solicitud de historia clínica con el radicado ".$IdRadica." ya fue respondia. Se encuentra en espera de entrega";
			exit();
		}

		$Temp = new RadicadoEnviadoTemp();
		$Temp -> set_Accion('GUARDAR_SOLICITUD_HISTORIA_CLINICA');
		$Temp -> set_IdSerie($IdSerie);
		$Temp -> set_IdSubSerie($IdSubSerie);
		$Temp -> set_IdTipoDoc($IdTipoDoc);
		$Temp -> set_IdDestinatario($IdDetinatario);
		$Temp -> set_IdUsuaRegis($_SESSION['SesionFuncioDetaId']);
		$Temp -> set_Asunto($Asunto);
		$Temp -> set_Adjunto(0);
		$Temp -> set_Terminado(1);
		$Temp -> set_Existe_Proyectores(0);
		$Temp -> set_Genera_Plantilla(1);

		if($Temp -> Gestionar() === true){
			
			$Responsable = new RadicadoEnviadoTempResponsable();
			$Responsable -> set_Accion(1);
			$Responsable -> set_IdTemp($Temp->get_IdTemp());
			$Responsable -> set_IdFuncio($_SESSION['SesionFuncioDetaId']);
			$Responsable -> set_FecHorAsigna(Fecha_Hora_Actual());
			$Responsable -> set_Responsable(1);
			$Responsable -> set_Aprobado(1);
			$Responsable -> set_FecHorAprueba(Fecha_Hora_Actual());
			$Responsable -> Gestionar();

			$Responsable = new RadicaEnviadoTempRespuestas();
			$Responsable -> set_Accion(1);
			$Responsable -> set_IdTemp($Temp->get_IdTemp());
			$Responsable -> set_IdRadica($IdRadica);
			$Responsable -> Gestionar();

			echo 1;
			exit();
		}

		break;
	default:
		echo 'No hay accion para realizar.';
}
?>