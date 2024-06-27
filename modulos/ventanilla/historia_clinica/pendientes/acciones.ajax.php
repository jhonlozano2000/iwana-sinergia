<?php
session_start();
require_once "../../../../config/class.Conexion.php";
require_once "../../../../config/variable.php";
require_once "../../../../config/funciones.php";
require_once "../../../../config/funciones_seguridad.php";
require_once "../../../clases/radicar/class.RadicaEnviadoTemp.php";
require_once "../../../clases/radicar/class.RadicaEnviadoTempResponsables.php";
require_once "../../../clases/radicar/class.RadicaEnviadoTempRespuestas.php";
require_once "../../../clases/radicar/class.RadicaEnviado Final.php";
require_once "../../../clases/radicar/class.RadicaEnviadoResponsable.php";
require_once "../../../clases/radicar/class.RadicaRecibido.php";

$Accion        = isset($_POST['accion']) ? $_POST['accion'] : null;
$IdTemp        = isset($_POST['id_temp']) ? $_POST['id_temp'] : null;
$FormaEnvia    = isset($_POST['id_forma_enviados']) ? $_POST['id_forma_enviados'] : null;
$Asunto        = isset($_POST['asunto']) ? $_POST['asunto'] : null;
$NumAnexos     = isset($_POST['num_anexos']) ? $_POST['num_anexos'] : null;
$ObservaAnexos = isset($_POST['observa_anexo']) ? $_POST['observa_anexo'] : null;
$NumGuia       = isset($_POST['num_guia']) ? $_POST['num_guia'] : null;

switch ($Accion){
	case 'GUARDAR_RADICADO':
		
		$Radicado = RadicadoEnviado::Listar(8, "", "", "", 0, 0, 0, "", "", "");
		
		foreach($Radicado as $Item):
			$IdRadicado = $Item['IdRadicado'];
		endforeach;

		$RadicaTemp = RadicadoEnviadoTemp::Buscar(1, $IdTemp, "");
		
		$Radicado = new RadicadoEnviado();
		$Radicado -> set_Accion($Accion);
		$Radicado -> set_IdRadica($IdRadicado);
		$Radicado -> set_IdDestinatario($RadicaTemp->get_IdDestinatario());
		$Radicado -> set_IdSerie($RadicaTemp->get_IdSerie());
		$Radicado -> set_IdSubserie($RadicaTemp->get_IdSubserie());
		$Radicado -> set_IdTipoDoc($RadicaTemp->get_IdTipoDoc());
		$Radicado -> set_IdUsuaRegis($_SESSION['SesionUsuaId']);
		$Radicado -> set_FormaEnvio($FormaEnvia);
		$Radicado -> set_FecRadica(Fecha_Hora_Actual());
		$Radicado -> set_FecDocu(Fecha_Hora_Actual());
		$Radicado -> set_Asunto($Asunto);
		$Radicado -> set_NumAnexos($NumAnexos);
		$Radicado -> setNum_Guia($NumGuia);
		$Radicado -> set_ObservaAneos($ObservaAnexos);
		if($Radicado -> Gestionar() === true){

			$RadicaTempResponsable = RadicadoEnviadoTempResponsable::Buscar(1, $IdTemp, "");
			
			$Responsable = new RadicadoEnviadoResponsable();
			$Responsable -> set_Accion(1);
			$Responsable -> set_IdRadica($IdRadicado);
			$Responsable -> set_IdFuncio($RadicaTempResponsable->get_IdFuncio());
			$Responsable -> set_Respon(1);
			$Responsable -> Gestionar();
			
			$RadicadoTempRespuesta = RadicaEnviadoTempRespuestas::Buscar(1, $IdTemp, "");
			
			$RadicadoRespuesta = new RadicadoRecibido();
			$RadicadoRespuesta -> set_Accion(8);
			$RadicadoRespuesta -> set_IdRadica($RadicadoTempRespuesta->get_IdRadica());
			$RadicadoRespuesta -> set_IdRadicaRespues($IdRadicado);
			$RadicadoRespuesta -> Gestionar();

			#ELIMINO EL REDICADO TEMPORAL
			$ElimiTempRespon = new RadicadoEnviadoTempResponsable();
			$ElimiTempRespon -> set_Accion(3);
			$ElimiTempRespon -> set_IdTemp($IdTemp);
			$ElimiTempRespon -> Gestionar();

			$ElimiTempRespon = new RadicaEnviadoTempRespuestas();
			$ElimiTempRespon -> set_Accion(2);
			$ElimiTempRespon -> set_IdTemp($IdTemp);
			$ElimiTempRespon -> Gestionar();

			$ElimiTemp = new RadicadoEnviadoTemp();
			$ElimiTemp -> set_Accion('ELIMINA_TEMP');
			$ElimiTemp -> set_IdTemp($IdTemp);
			$ElimiTemp -> Gestionar();

			echo 1;
			exit();
		}
	break;
	default:
		echo 'No hay accion para realizar.'.$Accion;
	break;
}
?>
