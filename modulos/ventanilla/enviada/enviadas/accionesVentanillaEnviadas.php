<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    session_start();
    include "../../../../config/class.Conexion.php";
    require_once "../../../../config/variable.php";
    require_once "../../../../config/funciones.php";
    require_once "../../../../config/funciones_seguridad.php";
    require_once "../../../clases/radicar/class.RadicaEnviado.php";
    require_once "../../../clases/radicar/class.RadicaEnviadoQuienFirma.php";
    require_once "../../../clases/radicar/class.RadicaEnviadoResponsable.php";
    require_once "../../../clases/radicar/class.RadicaEnviadoProyectores.php";
    require_once "../../../clases/radicar/class.RadicaRecibido.php";
    require_once "../../../clases/configuracion/class.ConfigOtras.php";
    require_once "../../../clases/general/class.GeneralFuncionario.php";
    require_once "../../../clases/seguridad/class.SeguridadLog.php";

    $Accion     = isset($_POST['accion']) ? $_POST['accion'] : null;
    $IdRadicado = isset($_POST['id_radica']) ? $_POST['id_radica'] : null;
    $IdDestina  = isset($_POST['id_destina']) ? $_POST['id_destina'] : null;
    if (isset($_POST['incluir_trd']) and $_POST['incluir_trd'] == 1) {
        $IdSerie    = isset($_POST['id_serie']) ? $_POST['id_serie'] : null;
        $IdSubSerie = isset($_POST['id_subserie']) ? $_POST['id_subserie'] : null;
    } else {
        $IdSerie    = "NULL";
        $IdSubSerie = "NULL";
    }

    $IdTipoDocu            = isset($_POST['id_tipodoc']) ? $_POST['id_tipodoc'] : null;
    $IdFormaSalida         = isset($_POST['id_forma_salida']) ? $_POST['id_forma_salida'] : null;
    $FecDocu               = isset($_POST['fec_docu']) ? $_POST['fec_docu'] : null;
    $Asunto                = isset($_POST['asunto']) ? $_POST['asunto'] : null;
    $NumAnexos             = isset($_POST['num_anexos']) ? $_POST['num_anexos'] : 0;
    $ObservaAnexos         = isset($_POST['observa_anexo']) ? $_POST['observa_anexo'] : null;
    $RequieRespues         = isset($_POST['requie_respues']) ? $_POST['requie_respues'] : null;
    $TipoRespuesta         = isset($_POST['id_tipo_respue']) ? $_POST['id_tipo_respue'] : null;
    $IdQuienFirmaPrincipal = isset($_POST['QuienFirmaPrincipal']) ? $_POST['QuienFirmaPrincipal'] : null;
    $IdResponsable         = isset($_POST['Responsable']) ? $_POST['Responsable'] : null;
    $IdRuta                = isset($_POST['id_ruta']) ? $_POST['id_ruta'] : null;
    $NumFolios             = isset($_POST['num_folio']) ? $_POST['num_folio'] : null;
    $NumGuia               = isset($_POST['num_guia']) ? $_POST['num_guia'] : null;
    $OpcionRelacion        = isset($_POST['opcion_relacion']) ? $_POST['opcion_relacion'] : null;
    $OpcionTitulo          = isset($_POST['opcion_titulo']) ? $_POST['opcion_titulo'] : null;
    $OpcionSubTitulo       = isset($_POST['opcion_sub_titulo']) ? $_POST['opcion_sub_titulo'] : null;
    $OpcionDetalle1        = isset($_POST['opcion_detalle1']) ? $_POST['opcion_detalle1'] : null;
    $OpcionDetalle2        = isset($_POST['opcion_detalle2']) ? $_POST['opcion_detalle2'] : null;
    $OpcionDetalle3        = isset($_POST['opcion_detalle3']) ? $_POST['opcion_detalle3'] : null;

    if (isset($_POST['QuienesFirman'])) $FuncioQuienesFirman           = explode(",", $_POST['QuienesFirman']);
    if (isset($_POST['Responsables'])) $Responsables                   = explode(",", $_POST['Responsables']);
    if (isset($_POST['Proyectores'])) $Proyectores                     = explode(",", $_POST['Proyectores']);
    if (isset($_POST['RadicadoParaResponder'])) $RadicadoParaResponder = explode(",", $_POST['RadicadoParaResponder']);

    switch ($Accion) {
        case 'GUARDAR_RADICADO':
            $IdRadicado = "";

            $TipoRadicado = ConfigOtras::Buscar();

            if (!$TipoRadicado) {
                echo "Iwana no tiene configurado el tipo de radicado, por favor consulte con el administrador del sistema.";
            }

            /******************************************************************************************/
            /* GENRO EL RADICADO EPENDIENDO DEL TIPO DE RADICADO CONFIGURADO EN EL MODULO CONFIGURACION
            /* 1. GERAR RADICADO YYYYMMDD-#####
            /* 2. GERAR RADICADO 'COD DEPEN.COD CORRES.YYYYMMMDD-#####'
            /* 3. GERAR RADICADO 'COD DEPEN.COD CORRES-#####'
            /******************************************************************************************/
            if ($TipoRadicado->get_TipoRadicadEnviada() == 1) {

                $NuevoRadicado = RadicadoEnviado::Listar_Varios(2, "", "", "", 0, 0, 0, "", "", "");
                foreach ($NuevoRadicado as $Item) :
                    $IdRadicado = $Item['IdRadicado'];
                endforeach;
            } elseif ($TipoRadicado->get_TipoRadicadEnviada() == 2) {

                $IdDepenFincionario = "";

                $DepenFincionario = Funcionario::Listar(18, $IdResponsable, "", "", "", "", "", "");
                foreach ($DepenFincionario as $Item) {
                    $IdDepenFincionario = $Item['id_depen'];
                }

                $NuevoRadicado = RadicadoEnviado::Listar_Varios(3, "", "", "", $IdDepenFincionario, 0, 0, "", "", "");
                foreach ($NuevoRadicado as $Item) :
                    $IdRadicado = $Item['IdRadicado'];
                endforeach;
            } elseif ($TipoRadicado->get_TipoRadicadEnviada() == 3) {
                $IdDepenFincionario = "";

                $DepenFincionario = Funcionario::Listar(18, $IdResponsable, "", "", "", "", "", "");
                foreach ($DepenFincionario as $Item) {
                    $IdDepenFincionario = $Item['id_depen'];
                }

                $NuevoRadicado = RadicadoEnviado::Listar_Varios(4, "", "", "", $IdDepenFincionario, 0, 0, "", "", "");
                foreach ($NuevoRadicado as $Item) :
                    $IdRadicado = $Item['IdRadicado'];
                endforeach;
            }

            $date    = date(Fecha_Hora_Actual());
            $newDate = strtotime('-0 hour', strtotime($date));
            $newDate = date('Y-m-j H:i:s', $newDate);

            $Radicado = new RadicadoEnviado();
            $Radicado->set_Accion($Accion);
            $Radicado->set_IdRadica($IdRadicado);
            $Radicado->set_IdDestinatario($IdDestina);
            $Radicado->set_IdSerie($IdSerie);
            $Radicado->set_IdSubserie($IdSubSerie);
            $Radicado->set_IdTipoDoc($IdTipoDocu);
            $Radicado->set_IdUsuaRegis($_SESSION['SesionUsuaId']);
            $Radicado->set_FormaEnvio($IdFormaSalida);
            $Radicado->set_TipoRespuesta($TipoRespuesta);
            $Radicado->set_FecRadica($newDate);
            $Radicado->set_FecDocu($newDate);
            $Radicado->set_Asunto($Asunto);
            $Radicado->set_NumFolios($NumFolios);
            $Radicado->set_NumAnexos($NumAnexos);
            $Radicado->setNum_Guia($NumGuia);
            $Radicado->set_ObservaAneos($ObservaAnexos);
            $Radicado->set_OpcionRelecion($OpcionRelacion);
            $Radicado->set_OpcionTitulo($OpcionTitulo);
            $Radicado->set_OpcionSubTitulo($OpcionSubTitulo);
            $Radicado->set_OpcionDetalle1($OpcionDetalle1);
            $Radicado->set_OpcionDetalle2($OpcionDetalle2);
            $Radicado->set_OpcionDetalle3($OpcionDetalle3);
            if ($Radicado->Gestionar() == true) {

                //QUIENES FIRMAN
                for ($i = 0; $i < count($FuncioQuienesFirman); $i++) {
                    $QuienesFirman = new RadicadoEnviadoQuienFirma();
                    $QuienesFirman->set_Accion('INSERTAR_QUIEN_FIRMA');
                    $QuienesFirman->set_IdRadica($IdRadicado);
                    $QuienesFirman->set_IdFuncio($FuncioQuienesFirman[$i]);
                    $QuienesFirman->Gestionar();
                }

                //ESTABLEZCO EL FUNCIONARIO PRINCIPAL QUE FIRMA
                $QuienFirma = new RadicadoEnviadoQuienFirma();
                $QuienFirma->set_Accion('ESTABLECER_FIRMA_PRINCIPAL');
                $QuienFirma->set_IdRadica($IdRadicado);
                $QuienFirma->set_IdFuncio($IdQuienFirmaPrincipal);
                $QuienFirma->Gestionar();

                //RESPONSABLES
                for ($i = 0; $i < count($Responsables); $i++) {
                    $Responsable = new RadicadoEnviadoResponsable();
                    $Responsable->set_Accion(1);
                    $Responsable->set_IdRadica($IdRadicado);
                    $Responsable->set_IdFuncio($Responsables[$i]);
                    $Responsable->set_Respon(0);
                    $Responsable->Gestionar();
                }

                //PROYECTORES
                for ($i = 0; $i < count($Proyectores); $i++) {
                    if ($Proyectores[$i] != "") {
                        $Proyector = new RadicadoEnviadoProyector();
                        $Proyector->set_Accion('NUEVO_PROYECTOR');
                        $Proyector->set_IdRadica($IdRadicado);
                        $Proyector->set_IdFuncio($Proyectores[$i]);
                        $Proyector->set_FecHorAsigna($newDate);
                        $Proyector->Gestionar();
                    }
                }

                //ESTABLEZCO EL RESPONSABLE DEL DOCUMENTO
                $Responsable = new RadicadoEnviadoResponsable();
                $Responsable->set_Accion(3);
                $Responsable->set_IdRadica($IdRadicado);
                $Responsable->set_IdFuncio($IdResponsable);
                $Responsable->Gestionar();

                //RESPUESTAS DE RADICADOS
                $RadicadoRespuesta = new RadicadoRecibido();
                for ($i = 0; $i < count($RadicadoParaResponder); $i++) {
                    $RadicadoRespuesta->set_Accion(8);
                    $RadicadoRespuesta->set_IdRadica($RadicadoParaResponder[$i]);
                    $RadicadoRespuesta->set_IdRadicaRespues($IdRadicado);
                    $RadicadoRespuesta->Gestionar();
                }

                /****************************************************************************************
				/* INSERTO EL LOG DE LA TRANSACCION
				/****************************************************************************************/
                $RegistroLog = "El usuario inserto el del radicado " . $IdRadicado;
                $Log = new Log();
                $Log->set_Accion('INSERTAR_REGISTRO');
                $Log->set_IdUsuario($_SESSION['SesionUsuaId']);
                $Log->set_Modulo('Ventanilla->Correspondencia enviada');
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
        case 'IMPRIMIR_ROTULO':
            $Radicado = new RadicadoEnviado();
            $Radicado->set_Accion(2);
            $Radicado->set_IdRadica($IdRadicado);
            $Radicado->set_FecHorImpriRoru(Fecha_Hora_Actual());
            $Radicado->set_UsuaImpriRotu($_SESSION['SesionUsuaId']);
            if ($Radicado->Gestionar() == 'true') {

                /****************************************************************************************
				/* INSERTO EL LOG DE LA TRANSACCION
				/****************************************************************************************/
                $RegistroLog = "El usuario imprimio el rotulo del radicado " . $IdRadicado;
                $Log = new Log();
                $Log->set_Accion('INSERTAR_REGISTRO');
                $Log->set_IdUsuario($_SESSION['SesionUsuaId']);
                $Log->set_Modulo('Ventanilla->Correspondencia enviana');
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
        case 'ELIMINAR_RADICADO':

            require_once "../../../clases/radicar/class.RadicaRecibido.php";
            require_once "../../../clases/radicar/class.RadicaRecibidoResponsable.php";
            require_once "../../../clases/radicar/class.RadicaRecibidoCompartido.php";
            require_once "../../../clases/radicar/class.RadicaEnviadoArchivoAdicional.php";

            $RadicadoQuienFirma = new RadicadoEnviadoQuienFirma();
            $RadicadoQuienFirma->set_Accion(2);
            $RadicadoQuienFirma->set_IdRadica($IdRadicado);
            if ($RadicadoQuienFirma->Gestionar() == true) {

                $RadicadoRespon = new RadicadoEnviadoResponsable();
                $RadicadoRespon->set_Accion(2);
                $RadicadoRespon->set_IdRadica($IdRadicado);
                $RadicadoRespon->Gestionar();

                $RadicadoProyec = new RadicadoEnviadoProyector();
                $RadicadoProyec->set_Accion('ELIMINAR_PROYECTORES');
                $RadicadoProyec->set_IdRadica($IdRadicado);
                $RadicadoProyec->Gestionar();

                $RadicadoArchi = new RadicadoEnviadoArchivoAdicional();
                $RadicadoArchi->set_Accion('ELIMINAR_ARCHIVOS');
                $RadicadoArchi->set_IdRadica($IdRadicado);
                $RadicadoArchi->Gestionar();

                $RadicadoArchi = new RadicadoEnviado();
                $RadicadoArchi->set_Accion('ELIMINAR_RADICADO');
                $RadicadoArchi->set_IdRadica($IdRadicado);
                $RadicadoArchi->Gestionar();

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
        case 'RESPONDER_RADICADOS':
            //RESPUESTAS DE RADICADOS
            for ($i = 0; $i < count($RadicadoParaResponder); $i++) {
                $RadicadoRespuesta = new RadicadoRecibido();
                $RadicadoRespuesta->set_Accion(8);
                $RadicadoRespuesta->set_IdRadica($RadicadoParaResponder[$i]);
                $RadicadoRespuesta->set_IdRadicaRespues($IdRadicado);
                $RadicadoRespuesta->Gestionar();
            }

            echo 1;
            exit();
            break;
        default:
            echo 'No hay accion para realizar.' . $Accion;
            break;
    }
}
