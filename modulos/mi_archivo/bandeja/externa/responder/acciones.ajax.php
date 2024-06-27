<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	session_start();
	require_once "../../../../../config/class.Conexion.php";
	require_once "../../../../../config/funciones.php";
	require_once "../../../../../config/funciones_seguridad.php";
	require_once "../../../../../config/variable.php";
	require_once "../../../../clases/radicar/class.RadicaEnviadoTemp.php";
	require_once "../../../../clases/radicar/class.RadicaEnviadoTempQuienFirma.php";
	require_once "../../../../clases/radicar/class.RadicaEnviadoTempResponsables.php";
	require_once "../../../../clases/radicar/class.RadicaEnviadoTempProyectores.php";
	require_once "../../../../clases/radicar/class.RadicaEnviadoTempRespuestas.php";
	require_once "../../../../clases/configuracion/class.ConfigOtras.php";
	require_once "../../../../clases/configuracion/class.ConfigMiEmpresa.php";
	require_once "../../../../clases/general/class.GeneralFuncionario.php";
	require_once "../../../../clases/general/class.GeneralFuncionarioDetalle.php";
	require_once "../../../../clases/seguridad/class.SeguridadLog.php";
	include '../../../../varios/establecer_datos_plantilla.php';

	$Accion          = isset($_POST['accion']) ? $_POST['accion'] : null;
	$IdTemp          = isset($_POST['id_temp']) ? $_POST['id_temp'] : null;
	$IdRadica        = isset($_POST['id_radica']) ? $_POST['id_radica'] : null;

	if (isset($_POST['incluir_trd']) and $_POST['incluir_trd'] == 1) {
		$IdSerie    = isset($_POST['id_serie']) ? $_POST['id_serie'] : null;
		$IdSubSerie = isset($_POST['id_subserie']) ? $_POST['id_subserie'] : null;
	} else {
		$IdSerie    = "NULL";
		$IdSubSerie = "NULL";
	}

	$IdTipoDoc     = isset($_POST['id_tipodoc']) ? $_POST['id_tipodoc'] : null;
	$IdDetinatario = isset($_POST['id_destina']) ? $_POST['id_destina'] : null;
	$IdQuienFirma  = isset($_POST['QuienFirmaPrincipal']) ? $_POST['QuienFirmaPrincipal'] : null;
	$IdStatus      = isset($_POST['id_status']) ? $_POST['id_status'] : null;
	$IdSaludo      = isset($_POST['id_saludo']) ? $_POST['id_saludo'] : null;
	$IdDespedida   = isset($_POST['id_despedida']) ? $_POST['id_despedida'] : null;
	$Asunto        = isset($_POST['asunto']) ? $_POST['asunto'] : null;
	$ConCopia      = isset($_POST['con_copia']) ? $_POST['con_copia'] : null;
	$Anexos        = isset($_POST['anexos']) ? $_POST['anexos'] : null;
	$Adjunto       = isset($_POST['adjunto']) ? $_POST['adjunto'] : null;
	$Terminado     = isset($_POST['Terminado']) ? $_POST['Terminado'] : null;
	$IdResponsable = isset($_POST['Responsable']) ? $_POST['Responsable'] : null;

	if (isset($_POST['QuienesFirman'])) $QuienesFirman = explode(",", $_POST['QuienesFirman']);
	if (isset($_POST['Responsables'])) $Responsables   = explode(",", $_POST['Responsables']);
	if (isset($_POST['Proyectores'])) $Proyectores     = explode(",", $_POST['Proyectores']);
	if (isset($_POST['RadicadoParaResponder'])) $RadicadoParaResponder = explode(",", $_POST['RadicadoParaResponder']);

	$ExistenProyectores = 0;
	if (isset($_POST['Proyectores']) and $_POST['Proyectores'] != "") {
		$ExistenProyectores = 1;
	}

	$date    = date(Fecha_Hora_Actual());
	$newDate = strtotime('-2 hour', strtotime($date));
	$newDate = date('Y-m-j H:i:s', $newDate);

	switch ($Accion) {
		case 'ENVIAR_PARA_TRAMITE':
			$Temp = new RadicadoEnviadoTemp();
			$Temp->set_Accion('GUARDAR');
			$Temp->set_IdSerie($IdSerie);
			$Temp->set_IdSubSerie($IdSubSerie);
			$Temp->set_IdTipoDoc($IdTipoDoc);
			$Temp->set_IdDestinatario($IdDetinatario);
			$Temp->set_IdUsuaRegis($_SESSION['SesionFuncioDetaId']);
			$Temp->set_IdStatus($IdStatus);
			$Temp->set_IdSaludo($IdSaludo);
			$Temp->set_IdDespedida($IdDespedida);
			$Temp->set_FecHorRegistro($newDate);
			$Temp->set_Asunto($Asunto);
			$Temp->set_ConCopia($ConCopia);
			$Temp->set_Anexos($Anexos);
			$Temp->set_Adjunto($Adjunto);
			$Temp->set_Terminado(0);
			$Temp->set_Existe_Proyectores($ExistenProyectores);
			if ($Temp->Gestionar() === true) {

				$IdTemp = $Temp->get_IdTemp();

				Gestionar_Responsable_Proyectores($Temp->get_IdTemp(), $IdResponsable);

				//INSERTO LAS RESPUESTAS
				if (isset($_POST['RadicadoParaResponder']) and count($RadicadoParaResponder) > 0) {
					for ($i = 0; $i < count($RadicadoParaResponder); $i++) {
						$Responsable = new RadicaEnviadoTempRespuestas();
						$Responsable->set_Accion(1);
						$Responsable->set_IdTemp($Temp->get_IdTemp());
						$Responsable->set_IdRadica($RadicadoParaResponder[$i]);
						$Responsable->Gestionar();
					}
				}

				/****************************************************************************************
				/* INSERTO EL LOG DE LA TRANSACCION
				/****************************************************************************************/
				$RegistroLog = "El usuario genero el radicado temporal " . $IdTemp;
				$Log = new Log();
				$Log->set_Accion('INSERTAR_REGISTRO');
				$Log->set_IdUsuario($_SESSION['SesionUsuaId']);
				$Log->set_Modulo('Bandeja->Correspondencia recibida');
				$Log->set_FecHorRegistro(Fecha_Hora_Actual());
				$Log->set_Equipo(EQUIPO_REMOTO);
				$Log->set_IP(getRealIP());
				$Log->set_AccionUsuario('Agregar');
				$Log->set_Detalle($RegistroLog);
				$Log->Gestionar();

				echo 1;
				exit();
			}
			break;
		case 'DESCARGAR_PLANTILLA':

			$Accion = "";
			if (empty($IdTemp)) {
				$Accion = "GUARDAR";
			} else {
				$Accion = "EDITAR";
			}

			$Temp = new RadicadoEnviadoTemp();
			$Temp->set_Accion($Accion);
			$Temp->set_IdTemp($IdTemp);
			$Temp->set_IdSerie($IdSerie);
			$Temp->set_IdSubSerie($IdSubSerie);
			$Temp->set_IdTipoDoc($IdTipoDoc);
			$Temp->set_IdUsuaRegis($_SESSION['SesionFuncioDetaId']);
			$Temp->set_IdDestinatario($IdDetinatario);
			$Temp->set_IdStatus($IdStatus);
			$Temp->set_IdSaludo($IdSaludo);
			$Temp->set_IdDespedida($IdDespedida);
			$Temp->set_FecHorRegistro($newDate);
			$Temp->set_Asunto($Asunto);
			$Temp->set_ConCopia($ConCopia);
			$Temp->set_Anexos($Anexos);
			$Temp->set_Adjunto($Adjunto);
			$Temp->set_Terminado(0);
			$Temp->set_Existe_Proyectores($ExistenProyectores);
			$Temp->set_Genera_Plantilla(0);
			if ($Temp->Gestionar() === true) {

				if (empty($IdTemp)) {

					$IdTemp = $Temp->get_IdTemp();

					//GESTIONO LOS RESPONSABLES Y PROYECTORES
					Gestionar_Responsable_Proyectores($IdTemp, $IdResponsable);

					//INSERTO LAS RESPUESTAS
					if (isset($_POST['RadicadoParaResponder']) and count($RadicadoParaResponder) > 0) {
						for ($i = 0; $i < count($RadicadoParaResponder); $i++) {
							$Responsable = new RadicaEnviadoTempRespuestas();
							$Responsable->set_Accion(1);
							$Responsable->set_IdTemp($Temp->get_IdTemp());
							$Responsable->set_IdRadica($RadicadoParaResponder[$i]);
							$Responsable->Gestionar();
						}
					}

					/****************************************************************************************
					/* INSERTO EL LOG DE LA TRANSACCION
					/****************************************************************************************/
					$RegistroLog = "El usuario genero el descargo la plantilla del radicado temporal " . $IdTemp;
					$Log = new Log();
					$Log->set_Accion('INSERTAR_REGISTRO');
					$Log->set_IdUsuario($_SESSION['SesionUsuaId']);
					$Log->set_Modulo('Bandeja->Correspondencia recibida');
					$Log->set_FecHorRegistro(Fecha_Hora_Actual());
					$Log->set_Equipo(EQUIPO_REMOTO);
					$Log->set_IP(getRealIP());
					$Log->set_AccionUsuario('Agregar');
					$Log->set_Detalle($RegistroLog);
					$Log->Gestionar();

					Descargar_Plantilla($IdTemp);
				} else {

					/****************************************************************************************
					/* INSERTO EL LOG DE LA TRANSACCION
					/****************************************************************************************/
					$RegistroLog = "El usuario genero el descargo la plantilla del radicado temporal " . $IdTemp;
					$Log = new Log();
					$Log->set_Accion('INSERTAR_REGISTRO');
					$Log->set_IdUsuario($_SESSION['SesionUsuaId']);
					$Log->set_Modulo('Bandeja->Correspondencia recibida');
					$Log->set_FecHorRegistro(Fecha_Hora_Actual());
					$Log->set_Equipo(EQUIPO_REMOTO);
					$Log->set_IP(getRealIP());
					$Log->set_AccionUsuario('Agregar');
					$Log->set_Detalle($RegistroLog);
					$Log->Gestionar();

					Descargar_Plantilla($IdTemp);
				}
			}
			break;
		default:
			echo 'No hay accion para realizar.' . $Accion;
	}
}

function Gestionar_Responsable_Proyectores($IdTemp, $IdResponsable)
{
	$RadicadosParaCompartir = explode(",", $_POST['RadicadoParaResponder']);

	//INSERTO QUIENES FIRMAN
	if (isset($_POST['QuienesFirman']) and $_POST['QuienesFirman'] != 'null') {

		$ResponsablesQuienesFirman = explode(",", $_POST['QuienesFirman']);

		for ($i = 0; $i < count($ResponsablesQuienesFirman); $i++) {
			$QuienesFirman = new RadicadoEnviadoTempQuienFirma();
			$QuienesFirman->set_Accion('ESTABLECER_QUIEN_FIRMA');
			$QuienesFirman->set_IdTemp($IdTemp);
			$QuienesFirman->set_IdFuncio($ResponsablesQuienesFirman[$i]);
			$QuienesFirman->set_FecHorAsignado(Fecha_Hora_Actual());
			$QuienesFirman->Gestionar();
			/*
			//COMPARTO EL RADICADO
			for($j=0; $j<count($RadicadosParaCompartir); $j++){
				$Compartir = new RadicadoRecibidoCompartir();
				$Compartir -> set_Accion('COMPARTIR_RADICADO');
				$Compartir -> set_IdRadica($RadicadosParaCompartir[$j]);
				$Compartir -> set_IdFuncioOrigen($_SESSION['SesionFuncioDetaId']);
				$Compartir -> set_IdFuncioDestino($ResponsablesQuienesFirman[$i]);
				$Compartir -> set_FecHorCompartido(Fecha_Hora_Actual());
				$Compartir -> Gestionar();
			}
			*/
		}

		//ESTABLEZCO EL RESPONSABLE DEL DOCUMENTO
		$QuieneFirmaPrincipal = new RadicadoEnviadoTempQuienFirma();
		$QuieneFirmaPrincipal->set_Accion('ESTABLECER_FIRMA_PRINCIPAL');
		$QuieneFirmaPrincipal->set_IdTemp($IdTemp);
		$QuieneFirmaPrincipal->set_IdFuncio($_POST['QuienFirmaPrincipal']);
		$QuieneFirmaPrincipal->Gestionar();
	}

	//INSERTO LOS RESPONSABLES
	if (isset($_POST['Responsables']) and $_POST['Responsables'] != 'null') {

		$ResponsablesArreglo = explode(",", $_POST['Responsables']);

		for ($i = 0; $i <= (count($ResponsablesArreglo) - 1); $i++) {
			$Responsable = new RadicadoEnviadoTempResponsable();
			$Responsable->set_Accion(1);
			$Responsable->set_IdTemp($IdTemp);
			$Responsable->set_IdFuncio($ResponsablesArreglo[$i]);
			$Responsable->set_FecHorAsigna(Fecha_Hora_Actual());
			$Responsable->set_Responsable(0);
			$Responsable->set_Aprobado(0);
			$Responsable->Gestionar();
			/*
			//COMPARTO EL RADICADO
			for($j=0; $j<count($RadicadosParaCompartir); $j++){
				$Compartir = new RadicadoRecibidoCompartir();
				$Compartir -> set_Accion('COMPARTIR_RADICADO');
				$Compartir -> set_IdRadica($RadicadosParaCompartir[$j]);
				$Compartir -> set_IdFuncioOrigen($_SESSION['SesionFuncioDetaId']);
				$Compartir -> set_IdFuncioDestino($ResponsablesArreglo[$i]);
				$Compartir -> set_FecHorCompartido(Fecha_Hora_Actual());
				$Compartir -> Gestionar();
			}
			*/
		}

		//ESTABLEZCO EL RESPONSABLE DEL DOCUMENTO
		$Responsable = new RadicadoEnviadoTempResponsable();
		$Responsable->set_Accion('ESTABLECER_RESPONSABLE');
		$Responsable->set_IdTemp($IdTemp);
		$Responsable->set_IdFuncio($IdResponsable);
		$Responsable->Gestionar();
	}

	// INSERTO LOS PROYECTORES
	if (isset($_POST['Proyectores']) and $_POST['Proyectores'] != "") {

		$ProyectoresArreglo = explode(",", $_POST['Proyectores']);

		for ($i = 0; $i <= (count($ProyectoresArreglo) - 1); $i++) {
			$Proyector = new RadicadoEnviadoTempProyector();
			$Proyector->set_Accion(1);
			$Proyector->set_IdTemp($IdTemp);
			$Proyector->set_IdFuncio($ProyectoresArreglo[$i]);
			$Proyector->set_FecHorAsigna(Fecha_Hora_Actual());
			$Proyector->Gestionar();
			/*
			//COMPARTO EL RADICADO
			for($j=0; $j<count($RadicadosParaCompartir); $j++){
				$Compartir = new RadicadoRecibidoCompartir();
				$Compartir -> set_Accion('COMPARTIR_RADICADO');
				$Compartir -> set_IdRadica($RadicadosParaCompartir[$j]);
				$Compartir -> set_IdFuncioOrigen($_SESSION['SesionFuncioDetaId']);
				$Compartir -> set_IdFuncioDestino($ProyectoresArreglo[$i]);
				$Compartir -> set_FecHorCompartido(Fecha_Hora_Actual());
				$Compartir -> Gestionar();
			}
			*/
		}
	}
}
