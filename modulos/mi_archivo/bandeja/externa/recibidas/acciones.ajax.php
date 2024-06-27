<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	session_start();
	require_once "../../../../../config/class.Conexion.php";
	require_once "../../../../../config/funciones.php";
	require_once "../../../../../config/funciones_seguridad.php";
	require_once "../../../../../config/variable.php";
	require_once "../../../../clases/radicar/class.RadicaRecibido.php";
	require_once "../../../../clases/radicar/class.RadicaRecibidoResponsable.php";
	require_once "../../../../clases/radicar/class.RadicaRecibidoPase.php";
	require_once "../../../../clases/radicar/class.RadicaRecibidoCompartido.php";
	require_once "../../../../clases/seguridad/class.SeguridadLog.php";

	$Accion           = isset($_POST['accion']) ? $_POST['accion'] : null;
	$IdRadica         = isset($_POST['id_radica']) ? $_POST['id_radica'] : null;
	$IdFuincio        = isset($_POST['id_funcio']) ? $_POST['id_funcio'] : null;
	$IdSerie          = isset($_POST['id_serie']) ? $_POST['id_serie'] : null;
	$IdSubSerie       = isset($_POST['id_subserie']) ? $_POST['id_subserie'] : null;
	$IdTipoDocumental = isset($_POST['id_tipodoc']) ? $_POST['id_tipodoc'] : null;

	switch ($Accion){
		case 'Desbloquear':

			$Radicado = new RadicadoRecibido();
			$Radicado -> set_Accion($Accion);
			$Radicado -> set_IdRadica($IdRadica);
			if($Radicado -> Gestionar() === true){

				/****************************************************************************************
				/* INSERTO EL LOG DE LA TRANSACCION
				/****************************************************************************************/
				$RegistroLog = "El usuario desbloqueo el radicado ".$IdRadica;
				$Log = new Log();
				$Log->set_Accion('INSERTAR_REGISTRO');
				$Log->set_IdUsuario($_SESSION['SesionUsuaId']);
				$Log->set_Modulo('Bandeja->Correspondencia recibida');
				$Log->set_FecHorRegistro(Fecha_Hora_Actual());
				$Log->set_Equipo(EQUIPO_REMOTO);
				$Log->set_IP(getRealIP());
				$Log->set_AccionUsuario('Desbloquear');
				$Log->set_Detalle($RegistroLog);
				$Log->Gestionar();

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

				/****************************************************************************************
				/* INSERTO EL LOG DE LA TRANSACCION
				/****************************************************************************************/
				$RegistroLog = "El usuario visualizo el radicado ".$IdRadica;
				$Log = new Log();
				$Log->set_Accion('INSERTAR_REGISTRO');
				$Log->set_IdUsuario($_SESSION['SesionUsuaId']);
				$Log->set_Modulo('Bandeja->Correspondencia recibida');
				$Log->set_FecHorRegistro(Fecha_Hora_Actual());
				$Log->set_Equipo(EQUIPO_REMOTO);
				$Log->set_IP(getRealIP());
				$Log->set_AccionUsuario('Visualizar');
				$Log->set_Detalle($RegistroLog);
				$Log->Gestionar();

				echo 1;
				exit();
			}
		break;
		case 'PASAR':
			$Pase = new RadicadoRecibidoPase();
			$Pase->set_Accion('PASAR');
			$Pase->set_IdRadica($IdRadica);
			$Pase->set_IdFuncioOrigen($_SESSION['SesionFuncioDetaId']);
			$Pase->set_FecHorPase(Fecha_Hora_Actual());
			$Pase->set_IdFuncioDestino($IdFuincio);
			if($Pase->Gestionar() === true){

				$TodoBien = false;

				$Recibido = new RadicadoRecibido();
				$Recibido->set_Accion('PASAR');
				$Recibido->set_IdRadica($IdRadica);
				if($Recibido->Gestionar() === true){
					$TodoBien = true;
				}

				$Responsable = new RadicadoRecibidoResponsable();
				$Responsable->set_Accion('PASAR');
				$Responsable->set_IdRadica($IdRadica);
				$Responsable->set_IdFuncio($IdFuincio);
				if($Responsable->Gestionar() === true){
					$TodoBien = true;
				}

				if($TodoBien === true){
					echo 1,
					exit();
				}else{
					echo "Surgio un problema, por favor consulta con el administrador del sistema.";
					exit();
				}
			}
		break;
		case 'ESTABLECER_CLASIFICACION':
			$Radicado = new RadicadoRecibido();
			$Radicado->set_Accion($Accion);
			$Radicado->set_IdRadica($IdRadica);
			$Radicado->set_IdSerie($IdSerie);
			$Radicado->set_IdSubserie($IdSubSerie);
			$Radicado->set_IdTipoDoc($IdTipoDocumental);
			if($Radicado->Gestionar() === true){

				$Recibido = new RadicadoRecibido();
				$Recibido->set_Accion('TERMINAR_PASE');
				$Recibido->set_IdRadica($IdRadica);
				if($Recibido->Gestionar() === true){
					$TodoBien = true;
				}

				echo 1;
				exit();
			}
		break;
		case 'COMPARTIR':

			$RadicadosParaCompartir = explode(",", $_POST['funcio_para_compartir']);

			if($RadicadosParaCompartir == 0){
				echo "Debe elegir al menos un funcionario.";
				exit();
			}

			for($i=0; $i<count($RadicadosParaCompartir); $i++){
				$Compartir = new RadicadoRecibidoCompartir();
				$Compartir -> set_Accion('COMPARTIR_RADICADO');
				$Compartir -> set_IdRadica($IdRadica);
				$Compartir -> set_IdFuncioOrigen($_SESSION['SesionFuncioDetaId']);
				$Compartir -> set_IdFuncioDestino($RadicadosParaCompartir[$i]);
				$Compartir -> set_FecHorCompartido(Fecha_Hora_Actual());
				$Compartir -> Gestionar();
			}

			echo 1;
			exit();
		break;
		default:
			echo 'No hay accion para realizar.'.$Accion;
	}
}
?>