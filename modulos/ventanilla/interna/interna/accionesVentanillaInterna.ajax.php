<?php
if (! empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

	include "../../../../config/class.Conexion.php";
	require_once "../../../clases/radicar/class.RadicaInterno.php";
	require_once "../../../clases/radicar/class.RadicaInternoResponsable.php";
	require_once "../../../clases/radicar/class.RadicaInternoDestinatario.php";
	require_once "../../../clases/radicar/class.RadicaInternoProyectores.php";
	require_once "../../../../config/funciones.php";
	require_once '../../../clases/varias/class.GestionAdjunto.php';
	require_once '../../../clases/configuracion/class.ConfigOtras.php';
	require_once "../../../clases/general/class.GeneralFuncionario.php";
	session_start();

	$Accion        = isset($_POST['accion']) ? $_POST['accion'] : null;
	$IdRadica      = isset($_POST['id_radica']) ? $_POST['id_radica'] : null;
	$FecDocu       = isset($_POST['switch']) ? $_POST['switch'] : null;
	$RequiRespues  = isset($_POST['requie_respues']) ? $_POST['requie_respues'] : null;
	$FecVenci      = isset($_POST['fec_venci']) ? $_POST['fec_venci'] : null;
	$NumFolios     = isset($_POST['num_folio']) ? $_POST['num_folio'] : null;
	$NumAnexos     = isset($_POST['num_anexos']) ? $_POST['num_anexos'] : null;
	$ObservaAnexos = isset($_POST['observa_anexo']) ? $_POST['observa_anexo'] : null;
	$Asunto        = isset($_POST['asunto']) ? $_POST['asunto'] : null;
	$Texto         = 'Documento radicado en ventanilla';

	$ConfiguracionOtras = ConfigOtras::Buscar();
	if ($ConfiguracionOtras->get_Incluir_TRD() == 1) {
		$IdSerie        = isset($_POST['id_serie']) ? $_POST['id_serie'] : null;
		$IdSubSerie     = isset($_POST['id_subserie']) ? $_POST['id_subserie'] : null;
	} else {
		$IdSerie = "NULL";
		$IdSubSerie = "NULL";
	}

	$IdTipoDoc = isset($_POST['id_tipodoc']) ? $_POST['id_tipodoc'] : null;
	$IdRuta    = isset($_POST['id_ruta']) ? $_POST['id_ruta'] : null;

	$IdResponsable = isset($_POST['id_responsable']) ? $_POST['id_responsable'] : null;
	$Responsables  = isset($_POST['ChkResponsables']) ? $_POST['ChkResponsables'] : null;
	$Destinatarios = isset($_POST['ChkDestinatarios']) ? $_POST['ChkDestinatarios'] : null;
	$Proyectores   = isset($_POST['ChkProyectores']) ? $_POST['ChkProyectores'] : null;
	$ConCopia      = isset($_POST['ChkConCopia']) ? $_POST['ChkConCopia'] : null;

	switch ($Accion) {
		case 'RADICAR_COMUNCACION':

			$IdRadicado = "";

			/******************************************************************************************/
			/*  GERAR EL RADICADO
            /******************************************************************************************/
			if (!$ConfiguracionOtras->get_TipoRadicadInterna()) {
				echo "Iwana no tiene configurado el tipo de radicado, por favor consulte con el administrador del sistema.";
			}

			if ($ConfiguracionOtras->get_TipoRadicadInterna() == 1) {

				$NuevoRadicado = RadicadoInterno::Listar_Varios(2, "", "", "", 0, 0, 0, "", "", "");
				foreach ($NuevoRadicado as $Item):
					$IdRadicado = $Item['IdRadicado'];
				endforeach;
			} elseif ($ConfiguracionOtras->get_TipoRadicadInterna() == 2) {

				$IdDepenFincionario = "";

				$DepenFincionario = Funcionario::Listar(18, $IdResponsable, "", "", "", "", "", "");
				foreach ($DepenFincionario as $Item) {
					$IdDepenFincionario = $Item['id_depen'];
				}

				$NuevoRadicado = RadicadoInterno::Listar_Varios(3, "", "", "", $IdDepenFincionario, 0, 0, "", "", "");
				foreach ($NuevoRadicado as $Item):
					$IdRadicado = $Item['IdRadicado'];
				endforeach;
			} elseif ($ConfiguracionOtras->get_TipoRadicadInterna() == 3) {

				$IdDepenFincionario = "";

				$DepenFincionario = Funcionario::Listar(18, $IdResponsable, "", "", "", "", "", "");
				foreach ($DepenFincionario as $Item) {
					$IdDepenFincionario = $Item['id_depen'];
				}

				$NuevoRadicado = RadicadoInterno::Listar_Varios(4, "", "", "", $IdDepenFincionario, 0, 0, "", "", "");
				foreach ($NuevoRadicado as $Item):
					$IdRadicado = $Item['IdRadicado'];
				endforeach;
			}

			$Radicado = new RadicadoInterno();
			$Radicado->set_Accion('RADICAR_COMUNCACION');
			$Radicado->set_IdRadica($IdRadicado);
			$Radicado->set_IdSerie($IdSerie);
			$Radicado->set_IdSubSerie($IdSubSerie);
			$Radicado->set_IdTipoDoc($IdTipoDoc);
			$Radicado->set_IdFuncioRegis($_SESSION['SesionFuncioDetaId']);
			$Radicado->set_FecRadica(Fecha_Hora_Actual());
			$Radicado->set_FecDocu(Convertir_Fecha_A_Mysql($FecDocu));
			$Radicado->set_FecVenci(Convertir_Fecha_A_Mysql($FecVenci));
			$Radicado->set_Asunto($Asunto);
			$Radicado->set_NumFolios($NumFolios);
			$Radicado->set_NumAnexos($NumAnexos);
			$Radicado->set_Texto($Texto);
			$Radicado->set_RequiRespuesta($RequiRespues);
			if ($Radicado->Gestionar() === true) {

				//INSERTO LOS RESPONSABLES
				for ($i = 0; $i < count($Responsables); $i++) {
					$Responsable = new RadicadoInternoResponsable();
					$Responsable->set_Accion(1);
					$Responsable->set_IdRadica($IdRadicado);
					$Responsable->set_IdFuncio($Responsables[$i]);
					$Responsable->set_Respon(0);
					$Responsable->Gestionar();
				}

				//ESTABLEZCON EL PROPIETARIO DE LA CORRESPONDENCIA
				$Responsable = new RadicadoInternoResponsable();
				$Responsable->set_Accion('ESTABLECER_RESPONSALE');
				$Responsable->set_IdRadica($IdRadicado);
				$Responsable->set_IdFuncio($IdResponsable);
				$Responsable->Gestionar();

				//INSERTO LOS DESTINATARIOS
				for ($i = 0; $i < count($Destinatarios); $i++) {
					$Responsable = new RadicadoInternoDestinatario();
					$Responsable->set_Accion(1);
					$Responsable->set_IdRadica($IdRadicado);
					$Responsable->set_IdFuncio($Destinatarios[$i]);
					$Responsable->Gestionar();
				}

				//INSERTO LOS PROYECTORES
				if (isset($_POST['ChkProyectores'])) {
					for ($i = 0; $i < count($Proyectores); $i++) {
						$Responsable = new RadicadoInternoProyector();
						$Responsable->set_Accion('NUEVO_PROYECTOR');
						$Responsable->set_IdRadica($IdRadicado);
						$Responsable->set_IdFuncio($Proyectores[$i]);
						$Responsable->Gestionar();
					}
				}

				//INSERTO LOS CON COPIA
				if (isset($_POST['ChkConCopia'])) {
					for ($i = 0; $i < count($ConCopia); $i++) {
						$Responsable = new RadicadoInternoDestinatario();
						$Responsable->set_Accion(1);
						$Responsable->set_IdRadica($IdRadicado);
						$Responsable->set_IdFuncio($ConCopia[$i]);
						$Responsable->set_cc(1);
						$Responsable->Gestionar();
					}
				}

				echo "1";
				exit();
			}
			break;
		case 'RADICADO_CARGAR_DIGITAL':
			$Radicado = new RadicadoInterno();
			$Radicado->set_Accion('EDITAR_RUTA_ADJUNTO');
			$Radicado->set_IdRadica($IdRadica);
			$Radicado->set_IdRuta($IdRuta);
			$Radicado->set_Adjunto(1);
			if ($Radicado->Gestionar() === true) {
				echo 1;
				exit();
			}
			break;
		case 'IMPRIMIR_ROTULO':
			$Radicado = new RadicadoInterno();
			$Radicado->set_Accion('IMPRIMIR_ROTULO');
			$Radicado->set_IdRadica($IdRadica);
			if ($Radicado->Gestionar() === true) {
				echo 1;
				exit();
			}
			break;
		default:
			echo 'No hay accion para realizar.' . $Accion;
	}
}
