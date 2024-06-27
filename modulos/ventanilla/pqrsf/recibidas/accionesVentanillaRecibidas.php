<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

	session_start();
	require_once "../../../../config/class.Conexion.php";
	require_once "../../../../config/funciones.php";
	require_once "../../../../config/variable.php";
	require_once "../../../clases/configuracion/class.ConfigOtras.php";
	require_once "../../../clases/general/class.GeneralFuncionario.php";
	require_once "../../../clases/seguridad/class.SeguridadLog.php";

	$Accion     = isset($_POST['accion']) ? $_POST['accion'] : null;
	$IdRadicado = isset($_POST['id_radica']) ? $_POST['id_radica'] : null;

	$ConfiguracionOtras = ConfigOtras::Buscar();
	if ($ConfiguracionOtras->get_Incluir_TRD() == 1) {
		$IdSerie        = isset($_POST['id_serie']) ? $_POST['id_serie'] : null;
		$IdSubSerie     = isset($_POST['id_subserie']) ? $_POST['id_subserie'] : null;
	} else {
		$IdSerie = "NULL";
		$IdSubSerie = "NULL";
	}

	$IdTipoDocu      = isset($_POST['id_tipodoc']) ? $_POST['id_tipodoc'] : null;
	$IdFormaLlegada  = isset($_POST['id_forma_llegada']) ? $_POST['id_forma_llegada'] : null;
	$IdRemite        = isset($_POST['id_tercero']) ? $_POST['id_tercero'] : null;
	$FecHorRadica    = isset($_POST['fechor_radica']) ? $_POST['fechor_radica'] : null;
	$FecDocu         = isset($_POST['fec_docu']) ? $_POST['fec_docu'] : null;
	$FecVenci        = isset($_POST['fec_venci']) ? $_POST['fec_venci'] : null;
	$Asunto          = isset($_POST['asunto']) ? $_POST['asunto'] : null;
	$NumAnexos       = isset($_POST['num_anexos']) ? $_POST['num_anexos'] : 0;
	$ObservaAnexos   = isset($_POST['observa_anexo']) ? $_POST['observa_anexo'] : null;
	$NumFolios       = isset($_POST['num_folio']) ? $_POST['num_folio'] : null;
	$RequieRespues   = isset($_POST['requie_respues']) ? $_POST['requie_respues'] : 0;
	$IdResponsable   = isset($_POST['Responsable']) ? $_POST['Responsable'] : null;
	$IdRuta          = isset($_POST['id_ruta']) ? $_POST['id_ruta'] : null;
	$OpcionRelacion  = isset($_POST['opcion_relacion']) ? $_POST['opcion_relacion'] : null;
	$OpcionTitulo    = isset($_POST['opcion_titulo']) ? $_POST['opcion_titulo'] : null;
	$OpcionSubTitulo = isset($_POST['opcion_sub_titulo']) ? $_POST['opcion_sub_titulo'] : null;
	$OpcionDetalle1  = isset($_POST['opcion_detalle1']) ? $_POST['opcion_detalle1'] : null;
	$OpcionDetalle2  = isset($_POST['opcion_detalle2']) ? $_POST['opcion_detalle2'] : null;
	$OpcionDetalle3  = isset($_POST['opcion_detalle3']) ? $_POST['opcion_detalle3'] : null;

	if (isset($_POST['Destinatarios'])) $Destinatarios = explode(",", $_POST['Destinatarios']);

	switch ($Accion) {
		case 'GUARDAR_RADICADO':

			require_once "../../../clases/radicar/class.RadicaRecibido.php";
			require_once "../../../clases/radicar/class.RadicaRecibidoResponsable.php";

			$IdRadicado = "";

			/******************************************************************************************/
			/*  GERAR EL RADICADO
            /******************************************************************************************/
			if (!$ConfiguracionOtras->get_TipoRadicadRecibida()) {
				echo "Iwana no tiene configurado el tipo de radicado, por favor consulte con el administrador del sistema.";
			}

			if ($ConfiguracionOtras->get_TipoRadicadRecibida() == 1) {

				$NuevoRadicado = RadicadoRecibido::Listar_Vario(2, "", "", "", 0, 0, 0, "", "", "");
				foreach ($NuevoRadicado as $Item) :
					$IdRadicado = $Item['IdRadicado'];
				endforeach;
			} elseif ($ConfiguracionOtras->get_TipoRadicadRecibida() == 2) {

				$IdDepenFincionario = "";

				$DepenFincionario = Funcionario::Listar(18, $IdResponsable, "", "", "", "", "", "");
				foreach ($DepenFincionario as $Item) {
					$IdDepenFincionario = $Item['id_depen'];
				}

				$NuevoRadicado = RadicadoRecibido::Listar_Vario(3, "", "", "", $IdDepenFincionario, 0, 0, "", "", "");
				foreach ($NuevoRadicado as $Item) :
					$IdRadicado = $Item['IdRadicado'];
				endforeach;
			} elseif ($ConfiguracionOtras->get_TipoRadicadRecibida() == 3) {

				$IdDepenFincionario = "";

				$DepenFincionario = Funcionario::Listar(18, $IdResponsable, "", "", "", "", "", "");
				foreach ($DepenFincionario as $Item) {
					$IdDepenFincionario = $Item['id_depen'];
				}

				$NuevoRadicado = RadicadoRecibido::Listar_Vario(4, "", "", "", $IdDepenFincionario, 0, 0, "", "", "");
				foreach ($NuevoRadicado as $Item) :
					$IdRadicado = $Item['IdRadicado'];
				endforeach;
			}

			$EstadoCorres = "";
			if ($RequieRespues == 'true') {
				$EstadoCorres = "Tramite";
			} elseif ($EstadoCorres == 0) {
				$EstadoCorres = "Ninguno";
			}

			$Autoriza = 1;
			//SI EXISTE UN PROPIETARIO PRINCIPAL DE LA INSTITUCION MARCO COMO NO AUTORIZADO CON EL VALOR '0'
			//DE LO CONTRARIO ENVIO AUTIRZADO CON EL VALOR DE '1'
			$FuncioPrincipal = Funcionario::Buscar(13, "", "", "", "", "", "", "", "");
			if ($FuncioPrincipal) {
				$Autoriza = 0;
			}

			$date    = date(Fecha_Hora_Actual());
			$newDate = strtotime('-0 hour', strtotime($date));
			$newDate = date('Y-m-j H:i:s', $newDate);

			$Radicado = new RadicadoRecibido();
			$Radicado->set_Accion($Accion);
			$Radicado->set_IdRadica($IdRadicado);
			$Radicado->set_IdSerie($IdSerie);
			$Radicado->set_IdSubserie($IdSubSerie);
			$Radicado->set_IdTipoDoc($IdTipoDocu);
			$Radicado->set_IdUsuaRegis($_SESSION['SesionUsuaId']);
			$Radicado->set_FormaLlegada($IdFormaLlegada);
			$Radicado->set_IdRemite($IdRemite);
			$Radicado->set_IdRuta(0);
			$Radicado->set_FecRadica($newDate);
			$Radicado->set_FecDocu(Convertir_Fecha_A_Mysql($FecDocu));
			$Radicado->set_FecVenciDocu(Convertir_Fecha_A_Mysql($FecVenci));
			$Radicado->set_Asunto($Asunto);
			$Radicado->set_NumFolios($NumFolios);
			$Radicado->set_NumAnexos($NumAnexos);
			$Radicado->set_ObservaAneos($ObservaAnexos);
			$Radicado->set_RequieRespues($RequieRespues);
			$Radicado->set_ImpriRotu(0);
			$Radicado->set_Digital(0);
			$Radicado->set_FecHorImpriRoru("");
			$Radicado->set_UsuaImpriRotu(0);
			$Radicado->set_Respondido(0);
			$Radicado->set_Transferido(0);
			$Radicado->set_Estado($EstadoCorres);
			$Radicado->set_ObservaRadica("");
			$Radicado->set_Autoriza($Autoriza);
			$Radicado->set_OpcionRelecion($OpcionRelacion);
			$Radicado->set_OpcionTitulo($OpcionTitulo);
			$Radicado->set_OpcionSubTitulo($OpcionSubTitulo);
			$Radicado->set_OpcionDetalle1($OpcionDetalle1);
			$Radicado->set_OpcionDetalle2($OpcionDetalle2);
			$Radicado->set_OpcionDetalle3($OpcionDetalle3);

			if ($Radicado->Gestionar() == true) {

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
				$RegistroLog = "El usuario genero el  radicado " . $IdRadicado;
				$Log = new Log();
				$Log->set_Accion('INSERTAR_REGISTRO');
				$Log->set_IdUsuario($_SESSION['SesionUsuaId']);
				$Log->set_Modulo('Ventanilla->Correspondencia recibida');
				$Log->set_FecHorRegistro(Fecha_Hora_Actual());
				$Log->set_Equipo(EQUIPO_REMOTO);
				$Log->set_IP(getRealIP());
				$Log->set_AccionUsuario('Agregar');
				$Log->set_Detalle($RegistroLog);
				$Log->Gestionar();

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
		case 'PQR_ONLINE':

			break;
		default:
			echo 'No hay accion para realizar.' . $Accion;
			break;
	}
}
ob_end_flush();
