<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

    session_start();
    include "../../config/class.Conexion.php";
    include "../../config/funciones.php";
    include "../clases/notificaciones/class.NotificacionesExternas.php";
    include "../clases/notificaciones/class.NotificacionesInternas.php";

    $Accion = isset($_REQUEST['accion']) ? $_REQUEST['accion'] : null;


    switch ($Accion) {
        case 'LISTAR_NOTIFICACIONES_EXTERNAS':

            $Notificaicones = NotificacionExterna::Listar(1, "", $_SESSION['SesionFuncioDetaId'], "");

            $Estilo = "";

            $ListarNotificaciones = "";
            foreach ($Notificaicones as $Item) {

                if ($Item['prioridad'] == 1) {
                    $Estilo = "info";
                } elseif ($Item['prioridad'] == 2) {
                    $Estilo = "prioridad_media";
                } elseif ($Item['prioridad'] == 3) {
                    $Estilo = "prioridad_alta";
                }

                $ListarNotificaciones .= '<div class="notification-messages ' . $Estilo . '">
                    <div class="message-wrapper">
                        <div class="heading">' . $Item['titulo'] . '</div>
                        <div class="description">' . $Item['notificacion'] . '</div>
                        <div class="date pull-left">' . Fecha_Corta_Español($Item['fechor_notifica']) . '</div>
                    </div>
                    <div class="clearfix"></div>
                </div>';
            }

            $TotalNotificaicones = count($Notificaicones);

            echo $ListarNotificaciones . "######" . $TotalNotificaicones;
            exit();
            break;
        case 'VER_NOTIFICACIONES_EXTERNAS':
            $Notificaicones = new NotificacionExterna();
            $Notificaicones->setAccion('VER_NOTIFICACION');
            $Notificaicones->setId_FuncioDeta($_SESSION['SesionFuncioDetaId']);
            $Notificaicones->set_FecHorVisto(Fecha_Hora_Actual());
            $Notificaicones->Gestionar();
            exit();
            break;
        case 'LISTAR_NOTIFICACIONES_INTERNAS':
            $Notificaicones = NotificacionInterna::Listar(1, "", $_SESSION['SesionFuncioDetaId'], "");

            $Estilo = "";

            $ListarNotificaciones = "";
            foreach ($Notificaicones as $Item) {

                if ($Item['prioridad'] == 1) {
                    $Estilo = "info";
                } elseif ($Item['prioridad'] == 2) {
                    $Estilo = "prioridad_media";
                } elseif ($Item['prioridad'] == 3) {
                    $Estilo = "prioridad_alta";
                }

                $ListarNotificaciones .= '<div class="notification-messages ' . $Estilo . '">
                    <div class="message-wrapper">
                        <div class="heading">' . $Item['titulo'] . '</div>
                        <div class="description">' . $Item['notificacion'] . '</div>
                        <div class="date pull-left">' . Fecha_Corta_Español($Item['fechor_notifica']) . '</div>
                    </div>
                    <div class="clearfix"></div>
                </div>';
            }

            $TotalNotificaicones = count($Notificaicones);

            echo $ListarNotificaciones . "######" . $TotalNotificaicones;
            exit();
            break;
        default:
            # code...
            break;
    }
}
