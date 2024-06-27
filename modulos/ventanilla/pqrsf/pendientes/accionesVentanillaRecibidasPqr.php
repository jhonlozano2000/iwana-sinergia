<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

	session_start();
	require_once "../../../../config/class.Conexion.php";
	require_once "../../../../config/funciones.php";
	require_once "../../../../config/variable.php";
	require_once "../../../clases/configuracion/class.ConfigOtras.php";
	require_once "../../../clases/configuracion/class.ConfigTipoCorrespondencia.php";
	require_once "../../../clases/general/class.GeneralFuncionario.php";
	require_once "../../../clases/seguridad/class.SeguridadLog.php";
	require_once "../../../clases/notificaciones/class.NotificacionesExternas.php";
	require_once "../../../clases/radicar/class.RadicaRecibidoPQRSF.php";

	$Accion     = isset($_POST['accion']) ? $_POST['accion'] : null;
	$IdPqr = isset($_POST['id_pqr']) ? $_POST['id_pqr'] : null;
	$IdRadicado = isset($_POST['id_radica']) ? $_POST['id_radica'] : null;
	$IdRemite = isset($_POST['id_remite']) ? $_POST['id_remite'] : null;

	$ConfiguracionOtras = ConfigOtras::Buscar();
	if ($ConfiguracionOtras->get_Incluir_TRD() == 1) {
		$IdSerie        = isset($_POST['id_serie']) ? $_POST['id_serie'] : null;
		$IdSubSerie     = isset($_POST['id_subserie']) ? $_POST['id_subserie'] : null;
	} else {
		$IdSerie = "NULL";
		$IdSubSerie = "NULL";
	}

	$IdTipoDocu      = isset($_POST['id_tipodoc']) ? $_POST['id_tipodoc'] : null;
	$Asunto          = isset($_POST['asunto']) ? $_POST['asunto'] : null;
	$IdResponsable   = isset($_POST['responsable']) ? $_POST['responsable'] : null;
	$IdTipoCorrespon   = isset($_POST['id_tipo_correspon']) ? $_POST['id_tipo_correspon'] : null;

	if (isset($_POST['Destinatarios'])) $Destinatarios = explode(",", $_POST['Destinatarios']);

	switch ($Accion) {
		case 'ASIGNAR_PQR':

			require_once "../../../clases/radicar/class.RadicaRecibido.php";
			require_once "../../../clases/radicar/class.RadicaRecibidoResponsable.php";

			/******************************************************************************************/
			/*  GERAR EL RADICADO
            /******************************************************************************************/

			$Autoriza = 1;
			//SI EXISTE UN PROPIETARIO PRINCIPAL DE LA INSTITUCION MARCO COMO NO AUTORIZADO CON EL VALOR '0'
			//DE LO CONTRARIO ENVIO AUTOIZADO CON EL VALOR DE '1'
			$FuncioPrincipal = Funcionario::Buscar(13, "", "", "", "", "", "", "", "");
			if ($FuncioPrincipal) {
				$Autoriza = 0;
			}

			$date    = date(Fecha_Hora_Actual());
			$newDate = strtotime('-2 hour', strtotime($date));
			$newDate = date('Y-m-j H:i:s', $newDate);

			$Radicado = new RadicadoRecibido();
			$Radicado->set_Accion($Accion);
			$Radicado->set_IdRadica($IdRadicado);
			$Radicado->set_IdSerie($IdSerie);
			$Radicado->set_IdSubserie($IdSubSerie);
			$Radicado->set_IdTipoDoc($IdTipoDocu);
			$Radicado->set_IdTipoCorrespon($IdTipoCorrespon);
			$Radicado->set_IdUsuaRegis($_SESSION['SesionUsuaId']);
			$Radicado->set_IdRemite($IdRemite);
			$Radicado->set_IdRuta(0);
			$Radicado->set_RequieRespues(1);
			$Radicado->set_Estado('Tramite');
			$Radicado->set_Asunto($Asunto);
			$Radicado->set_Autoriza($Autoriza);
			if ($Radicado->Gestionar() == true) {

				/**
				 * ACTUALIZO LA FECHA Y HORA EN LA QUE LA SOLICITUS SE ENVIA PARA TRAMITE
				 */
				$pqr = new RadicadoRecibidoPQRSF();
				$pqr->set_Accion('ESTABLECER_FECHA_TRAMITE');
				$pqr->set_idPqr($IdPqr);
				$pqr->set_fecHorTramite($newDate);
				$pqr->Gestionar();

				if ($_POST['Destinatarios'] != '') {

					for ($i = 0; $i < count($Destinatarios); $i++) {
						$Responsable = new RadicadoRecibidoResponsable();
						$Responsable->set_Accion(1);
						$Responsable->set_IdRadica($IdRadicado);
						$Responsable->set_IdFuncio($Destinatarios[$i]);
						$Responsable->Gestionar();
					}
				}

				//ESTABLEZCO EL RESPONSABLE DEL DOCUMENTO
				$Responsable = new RadicadoRecibidoResponsable();
				$Responsable->set_Accion(4);
				$Responsable->set_IdRadica($IdRadicado);
				$Responsable->set_IdFuncio($IdResponsable);
				$Responsable->Gestionar();

				/****************************************************************************************
				/* INSERTO EL LOG DE LA TRANSACCION
				/****************************************************************************************/
				$RegistroLog = "El usuario envio para tramite la solicitud de PQRSF " . $IdRadicado;
				$Log = new Log();
				$Log->set_Accion('INSERTAR_REGISTRO');
				$Log->set_IdUsuario($_SESSION['SesionUsuaId']);
				$Log->set_Modulo('Ventanilla->Correspondencia recibida->PQRSF');
				$Log->set_FecHorRegistro(Fecha_Hora_Actual());
				$Log->set_Equipo(EQUIPO_REMOTO);
				$Log->set_IP(getRealIP());
				$Log->set_AccionUsuario('Agregar');
				$Log->set_Detalle($RegistroLog);
				$Log->Gestionar();

				/****************************************************************************************
				/* GENERO LA NOTIFICACION EN CALIENTE
				/****************************************************************************************/
				$TipoCorrespondencia = TipoCorrespondencia::Buscar(2, $IdTipoCorrespon, "", "");

				if ($Autoriza == 1) {
					$Notificacion = new NotificacionExterna();
					$Notificacion->setAccion('INSERTAR_NOTIFICACION');
					$Notificacion->setId_FuncioDeta($IdResponsable);
					$Notificacion->set_Titulo('Eres responsable de una comunicación');
					$Notificacion->set_Notificacion('La oficina de ventanilla unica te hizo responsable del radicado ' . $IdRadicado . " y de tipo de correspondencia " . $TipoCorrespondencia->get_NombreTipo());
					$Notificacion->set_IdRadica($IdRadicado);
					$Notificacion->set_Priorida(1);
					$Notificacion->Gestionar();
				}
				echo 1;
				exit();
			} else {
				echo "No pudo guardar el radicado.";
			}

			break;
		case 'IMPRIMIR_ROTULO':

			require_once "../../../clases/radicar/class.RadicaRecibido.php";

			$Radicado = new RadicadoRecibido();
			$Radicado->set_Accion(2);
			$Radicado->set_IdRadica($IdRadicado);
			$Radicado->set_FecHorImpriRoru(Fecha_Hora_Actual());
			$Radicado->set_UsuaImpriRotu($_SESSION['SesionUsuaId']);
			if ($Radicado->Gestionar() == true) {

				/****************************************************************************************
				/* INSERTO EL LOG DE LA TRANSACCION
				/****************************************************************************************/
				$RegistroLog = "El usuario imprimio el rotulo del radicado " . $IdRadicado;
				$Log = new Log();
				$Log->set_Accion('INSERTAR_REGISTRO');
				$Log->set_IdUsuario($_SESSION['SesionUsuaId']);
				$Log->set_Modulo('Ventanilla->Correspondencia recibida');
				$Log->set_FecHorRegistro(Fecha_Hora_Actual());
				$Log->set_Equipo(EQUIPO_REMOTO);
				$Log->set_IP(getRealIP());
				$Log->set_AccionUsuario('Imprimir');
				$Log->set_Detalle($RegistroLog);
				$Log->Gestionar();

				echo 1;
				exit();
			}
			break;
		case 'EDITAR_ASUNTO':

			require_once "../../../clases/radicar/class.RadicaRecibido.php";

			$Radicado = new RadicadoRecibido();
			$Radicado->set_Accion('EDITAR_ASUNTO');
			$Radicado->set_IdRadica($IdRadicado);
			$Radicado->set_Asunto($Asunto);
			if ($Radicado->Gestionar() == true) {

				$Radicado = RadicadoRecibido::Buscar(1, $IdRadicado, "", "", "", "");

				/****************************************************************************************
				/* INSERTO EL LOG DE LA TRANSACCION
				/****************************************************************************************/
				$RegistroLog = "El usuario edito el asunto del radicado " . $IdRadicado . " de " . $Radicado->get_Asunto() . " a " . $Asunto;
				$Log = new Log();
				$Log->set_Accion('INSERTAR_REGISTRO');
				$Log->set_IdUsuario($_SESSION['SesionUsuaId']);
				$Log->set_Modulo('Ventanilla->Correspondencia recibida');
				$Log->set_FecHorRegistro(Fecha_Hora_Actual());
				$Log->set_Equipo(EQUIPO_REMOTO);
				$Log->set_IP(getRealIP());
				$Log->set_AccionUsuario('Editar');
				$Log->set_Detalle($RegistroLog);
				$Log->Gestionar();

				echo 1;
				exit();
			}
			break;
		case 'ELIMINAR_RADICADO':

			require_once "../../../clases/radicar/class.RadicaRecibido.php";
			require_once "../../../clases/radicar/class.RadicaRecibidoResponsable.php";
			require_once "../../../clases/radicar/class.RadicaRecibidoCompartido.php";

			$RadicadoRespon = new RadicadoRecibidoResponsable();
			$RadicadoRespon->set_Accion('ELIMINAR_RADICADO');
			$RadicadoRespon->set_IdRadica($IdRadicado);
			$RadicadoRespon->Gestionar();
			if ($RadicadoRespon->Gestionar() == true) {

				$Radicado = new RadicadoRecibidoCompartir();
				$Radicado->set_Accion('ELIMINAR_RADICADO');
				$Radicado->set_IdRadica($IdRadicado);
				$Radicado->Gestionar();

				$Radicado = new RadicadoRecibido();
				$Radicado->set_Accion('ELIMINAR_RADICADO');
				$Radicado->set_IdRadica($IdRadicado);
				$Radicado->Gestionar();

				/****************************************************************************************
				/* INSERTO EL LOG DE LA TRANSACCION
				/****************************************************************************************/
				$RegistroLog = "El usuario elimino el radicado " . $IdRadicado;
				$Log = new Log();
				$Log->set_Accion('INSERTAR_REGISTRO');
				$Log->set_IdUsuario($_SESSION['SesionUsuaId']);
				$Log->set_Modulo('Ventanilla->Correspondencia recibida');
				$Log->set_FecHorRegistro(Fecha_Hora_Actual());
				$Log->set_Equipo(EQUIPO_REMOTO);
				$Log->set_IP(getRealIP());
				$Log->set_AccionUsuario('Eliminar');
				$Log->set_Detalle($RegistroLog);
				$Log->Gestionar();

				echo 1;
				exit();
			} else {
				echo "No fué posible eliminar el radicado";
				exit();
			}

			break;
		case 'ELIMINAR_DIGITAL':

			require_once "../../../clases/radicar/class.RadicaRecibido.php";

			$Radicado = new RadicadoRecibido();
			$Radicado->set_Accion('ELIMINAR_DIGITAL');
			$Radicado->set_IdRadica($IdRadicado);
			if ($Radicado->Gestionar() == true) {

				/****************************************************************************************
				/* INSERTO EL LOG DE LA TRANSACCION
				/****************************************************************************************/
				$RegistroLog = "El usuario elimino el documento digital del radicado " . $IdRadicado;
				$Log = new Log();
				$Log->set_Accion('INSERTAR_REGISTRO');
				$Log->set_IdUsuario($_SESSION['SesionUsuaId']);
				$Log->set_Modulo('Ventanilla->Correspondencia recibida');
				$Log->set_FecHorRegistro(Fecha_Hora_Actual());
				$Log->set_Equipo(EQUIPO_REMOTO);
				$Log->set_IP(getRealIP());
				$Log->set_AccionUsuario('Eliminar');
				$Log->set_Detalle($RegistroLog);
				$Log->Gestionar();

				echo 1;
				exit();
			}
			break;
		case 'REQUIERE_RESPUESTA':

			require_once "../../../clases/radicar/class.RadicaRecibido.php";

			$Radicado = new RadicadoRecibido();
			$Radicado->set_Accion('REQUIERE_RESPUESTA');
			$Radicado->set_IdRadica($IdRadicado);
			$Radicado->set_FecVenciDocu($FecVenci);
			if ($Radicado->Gestionar() == true) {

				/****************************************************************************************
				/* INSERTO EL LOG DE LA TRANSACCION
				/****************************************************************************************/
				$RegistroLog = "El usuario marco el radicado " . $IdRadicado . " con fecha de vencimiento para establecer que requiere respuesta";
				$Log = new Log();
				$Log->set_Accion('INSERTAR_REGISTRO');
				$Log->set_IdUsuario($_SESSION['SesionUsuaId']);
				$Log->set_Modulo('Ventanilla->Correspondencia recibida');
				$Log->set_FecHorRegistro(Fecha_Hora_Actual());
				$Log->set_Equipo(EQUIPO_REMOTO);
				$Log->set_IP(getRealIP());
				$Log->set_AccionUsuario('Actualizar');
				$Log->set_Detalle($RegistroLog);
				$Log->Gestionar();

				echo 1;
				exit();
			}
			break;
		case 'QUITAR_REQUIERE_RESPUESTA':

			require_once "../../../clases/radicar/class.RadicaRecibido.php";

			$Radicado = new RadicadoRecibido();
			$Radicado->set_Accion('QUITAR_REQUIERE_RESPUESTA');
			$Radicado->set_IdRadica($IdRadicado);
			if ($Radicado->Gestionar() == true) {

				/****************************************************************************************
				/* INSERTO EL LOG DE LA TRANSACCION
				/****************************************************************************************/
				$RegistroLog = "El usuario elimino la fecha de vencimiento del radicado " . $IdRadicado;
				$Log = new Log();
				$Log->set_Accion('INSERTAR_REGISTRO');
				$Log->set_IdUsuario($_SESSION['SesionUsuaId']);
				$Log->set_Modulo('Ventanilla->Correspondencia recibida');
				$Log->set_FecHorRegistro(Fecha_Hora_Actual());
				$Log->set_Equipo(EQUIPO_REMOTO);
				$Log->set_IP(getRealIP());
				$Log->set_AccionUsuario('Eliminar');
				$Log->set_Detalle($RegistroLog);
				$Log->Gestionar();

				echo 1;
				exit();
			}
			break;
		default:
			echo 'No hay accion para realizar.' . $Accion;
			break;
	}
}
ob_end_flush();
