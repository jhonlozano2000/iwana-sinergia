<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    session_start();
    require_once "../../../../config/class.Conexion.php";
    require_once "../../../../config/funciones.php";
    require_once "../../../../config/variable.php";
    require_once "../../../clases/configuracion/class.ConfigOtras.php";
    require_once "../../../clases/radicar/class.RadicaRecibido.php";
    require_once "../../../clases/radicar/class.RadicaRecibidoPQRSF.php";

    $Accion = isset($_POST['accion']) ? $_POST['accion'] : null;
    $IdContac = isset($_POST['id_contac']) ? $_POST['id_contac'] : null;
    $idTipoDocumental = isset($_POST['id_tipo_documental']) ? $_POST['id_tipo_documental'] : null;
    $IdTipoDocuAfectado = isset($_POST['id_tipo_docu_afectado']) ? $_POST['id_tipo_docu_afectado'] : null;
    $numDocuAfectado = isset($_POST['num_docu_afectado']) ? $_POST['num_docu_afectado'] : null;
    $nomAfectado = isset($_POST['nom_afectado']) ? $_POST['nom_afectado'] : null;
    $idDeparAfectado = isset($_POST['id_depar_afectado']) ? $_POST['id_depar_afectado'] : null;
    $idMuniAfectado = isset($_POST['id_muni_afectado']) ? $_POST['id_muni_afectado'] : null;
    $dirAfectado = isset($_POST['dir_afectado']) ? $_POST['dir_afectado'] : null;
    $TelAfectado = isset($_POST['tel_afectado']) ? $_POST['tel_afectado'] : null;
    $movilAfectado = isset($_POST['movil_afectado']) ? $_POST['movil_afectado'] : null;
    $detalleAfectado = isset($_POST['detalle_solicitud']) ? $_POST['detalle_solicitud'] : null;
    $falloJudicial = isset($_POST['fallo_judicial']) ? $_POST['fallo_judicial'] : null;
    $idRegimen = isset($_POST['id_regimen']) ? $_POST['id_regimen'] : null;

    $ConfiguracionOtras = ConfigOtras::Buscar();
    if ($ConfiguracionOtras->get_Incluir_TRD() == 1) {
        $IdSerie        = isset($_POST['id_serie']) ? $_POST['id_serie'] : null;
        $IdSubSerie     = isset($_POST['id_subserie']) ? $_POST['id_subserie'] : null;
    } else {
        $IdSerie = "NULL";
        $IdSubSerie = "NULL";
    }

    switch ($Accion) {
        case 'NUEVA_SOLICITUD':

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

            $date    = date(Fecha_Hora_Actual());
            $newDate = strtotime('-2 hour', strtotime($date));
            $newDate = date('Y-m-j H:i:s', $newDate);

            $Radicado = new RadicadoRecibido();
            $Radicado->set_Accion('GUARDAR_RADICADO');
            $Radicado->set_IdRadica($IdRadicado);
            $Radicado->set_FormaLlegada(8);
            $Radicado->set_IdRemite($_SESSION['SesionContactoIdPQR']);
            $Radicado->set_IdRuta(0);
            $Radicado->set_FecRadica($newDate);
            $Radicado->set_FecDocu($newDate);
            $Radicado->set_RequieRespues(1);
            $Radicado->set_Asunto($detalleAfectado);
            if ($Radicado->Gestionar() == true) {

                $solicitud = new RadicadoRecibidoPQRSF();
                $solicitud->set_Accion($Accion);
                $solicitud->set_idContacto($_SESSION['SesionContactoIdPQR']);
                $solicitud->set_IdRadica($IdRadicado);
                $solicitud->set_idTipoDocuAfectado($IdTipoDocuAfectado);
                $solicitud->set_idDeparAfectado($idDeparAfectado);
                $solicitud->set_idMuniAfectado($idMuniAfectado);
                $solicitud->set_idTipoDocumental($idTipoDocumental);
                $solicitud->set_idRegimen($idRegimen);
                $solicitud->set_numDocuAfectado($numDocuAfectado);
                $solicitud->set_nomAfectado($nomAfectado);
                $solicitud->set_dirAfectado($dirAfectado);
                $solicitud->set_telAfectado($TelAfectado);
                $solicitud->set_movilAfectado($movilAfectado);
                $solicitud->set_detalleSolicitud($detalleAfectado);
                $solicitud->set_falloJuducial($falloJudicial);
                if ($solicitud->Gestionar() == true) {
                    echo '1###' . $IdRadicado . "###" . $solicitud->get_idPqr();
                    exit();
                }
            }

            break;

        default:
            echo "No hay acción para ejecutar";
            break;
    }
}
