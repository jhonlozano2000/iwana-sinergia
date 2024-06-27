<?php
include "../../../../../config/class.Conexion.php";
require_once "../../../../clases/radicar/class.RadicaInterno.php";
require_once "../../../../clases/radicar/class.RadicaInternoDestinatario.php";
require_once "../../../../clases/radicar/class.RadicaInternoResponsable.php";
require_once "../../../../clases/radicar/class.RadicaInternoAdjuntos.php";
require_once "../../../../../config/funciones.php";
require_once '../../../../clases/varias/class.GestionAdjunto.php';
require_once '../../../../clases/configuracion/class.ConfigOtras.php';
require_once "../../../../clases/general/class.GeneralFuncionario.php";
session_start();

$Accion             = isset($_POST['accion']) ? $_POST['accion'] : null;
$IdRadica           = isset($_POST['id_radica']) ? $_POST['id_radica'] : null;
$ConfiguracionOtras = ConfigOtras::Buscar();

if ($ConfiguracionOtras->get_Incluir_TRD() == 1) {
	$IdSerie        = isset($_POST['id_serie']) ? $_POST['id_serie'] : null;
	$IdSubSerie     = isset($_POST['id_subserie']) ? $_POST['id_subserie'] : null;
} else {
	$IdSerie = "NULL";
	$IdSubSerie = "NULL";
}
$IdRadicaRespues = isset($_POST['id_radica_respuesta']) ? $_POST['id_radica_respuesta'] : null;
$IdTipoDoc = isset($_POST['id_tipodoc']) ? $_POST['id_tipodoc'] : null;
$IdRuta    = isset($_POST['id_ruta']) ? $_POST['id_ruta'] : null;
$FecVenci  = isset($_POST['fec_venci']) ? $_POST['fec_venci'] : null;
$Asunto    = isset($_POST['asunto']) ? $_POST['asunto'] : null;
$Texto     = isset($_POST['texto']) ? $_POST['texto'] : null;
$Adjunto   = isset($_POST['adjunto']) ? $_POST['adjunto'] : null;
$RutaTemp  = isset($_POST['RutaTemp']) ? $_POST['RutaTemp'] : null;

switch ($Accion) {
	case 'RADICAR_COMUNCACION':

		$Adjunto = 0;
		if ($_POST['destinatarios'] != '') {

			$DestinatariosArreglo = explode(",", $_POST['destinatarios']);
			for ($i = 0; $i < count($DestinatariosArreglo); $i++) {

				$TipoRadicado = ConfigOtras::Buscar();

				if (!$TipoRadicado) {
					echo "Iwana no tiene configurado el tipo de radicado, por favor consulte con el administrador del sistema.";
				}

				if ($TipoRadicado->get_TipoRadicadEnviada() == 1) {

					$NuevoRadicado = RadicadoInterno::Listar_Varios(2, "", "", "", 0, 0, 0, "", "", "");
					foreach ($NuevoRadicado as $Item) :
						$IdRadicado = $Item['IdRadicado'];
					endforeach;
				} elseif ($TipoRadicado->get_TipoRadicadEnviada() == 2) {

					$NuevoRadicado = RadicadoInterno::Listar_Varios(3, "", "", "", $_SESSION['SesionFuncioDepenId'], 0, 0, "", "", "");
					foreach ($NuevoRadicado as $Item) :
						$IdRadicado = $Item['IdRadicado'];
					endforeach;
				} elseif ($TipoRadicado->get_TipoRadicadEnviada() == 3) {

					$NuevoRadicado = RadicadoInterno::Listar_Varios(4, "", "", "", $_SESSION['SesionFuncioDepenId'], 0, 0, "", "", "");
					foreach ($NuevoRadicado as $Item) :
						$IdRadicado = $Item['IdRadicado'];
					endforeach;
				}

				$RequiereRespuesta = 0;
				if ($FecVenci != "") {
					$RequiereRespuesta = 1;
				}

				$Radicado = new RadicadoInterno();
				$Radicado->set_Accion('RADICAR_COMUNCACION');
				$Radicado->set_IdRadica($IdRadicado);
				$Radicado->set_IdFuncioRegis($_SESSION['SesionFuncioDetaId']);
				$Radicado->set_IdSerie($IdSerie);
				$Radicado->set_IdSubSerie($IdSubSerie);
				$Radicado->set_IdTipoDoc($IdTipoDoc);
				$Radicado->set_IdRuta(0);
				$Radicado->set_FecRadica(Fecha_Hora_Actual());
				$Radicado->set_FecVenci(Convertir_Fecha_A_Mysql($FecVenci));
				$Radicado->set_Asunto($Asunto);
				$Radicado->set_RequiRespuesta($RequiereRespuesta);
				$Radicado->set_Texto($Texto);
				$Radicado->set_Adjunto($Adjunto);
				if ($Radicado->Gestionar() === true) {

					//INSERTO EL RESPONSABLE
					$Responsable = new RadicadoInternoResponsable();
					$Responsable->set_Accion(1);
					$Responsable->set_IdRadica($IdRadicado);
					$Responsable->set_IdFuncio($_SESSION['SesionFuncioDetaId']);
					$Responsable->set_Respon(1);
					$Responsable->Gestionar();

					//INSERTO LOS DESTINATARIOS
					$Destinatario = new RadicadoInternoDestinatario();
					$Destinatario->set_Accion(1);
					$Destinatario->set_IdRadica($IdRadicado);
					$Destinatario->set_IdFuncio($DestinatariosArreglo[$i]);
					$Destinatario->set_cc(0);
					$Destinatario->Gestionar();

					//INSERTO LOS ADJUNTOS
					$HayAdjunto = 0;
					$ArchivosAdjuntos = GestionAdjunto::Listar(1, $_SESSION['SesionFuncioDetaId'], "");
					foreach ($ArchivosAdjuntos as $Item) {
						$HayAdjunto = 1;
					}

					if ($IdRadicaRespues != "") {
						//GENERO LA RESPUESTA
						$Responder = new RadicadoInterno();
						$Responder->set_Accion('RESPONDER');
						$Responder->set_IdRadica($IdRadicaRespues);
						$Responder->set_RadicaRespuesta($IdRadicado);
						$Responder->Gestionar();
					}

					echo "1#" . $IdRadicado . "#" . $HayAdjunto;
					exit();
				}
			}
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
	default:
		echo 'No hay accion para realizar.' . $Accion;
}
