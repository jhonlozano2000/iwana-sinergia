<?php
$PrimeraParte = explode("/", $_SERVER['REQUEST_URI']);
$raiz = 'iwana-sinergia';
if (isset($_SERVER['HTTPS'])) {
    $RutaMiServidor = 'https://' . $_SERVER['HTTP_HOST'];
} else {
    $RutaMiServidor = 'http://' . $_SERVER['HTTP_HOST'];
}


define("MI_NOMBRE", 'Iwana');
define("MI_ROOT", $RutaMiServidor);
define("MI_ROOT_ARCHIVOS_RELATIVA", $_SERVER['DOCUMENT_ROOT'] .  "/archivos");
define("MI_ROOT_TEMP_RELATIVA", $_SERVER['DOCUMENT_ROOT'] .  "/archivos/temp");
define("MI_ROOT_RELATIVA", $_SERVER['DOCUMENT_ROOT']);
define("LOG_OUT", $RutaMiServidor . "/logout.php");
define("MI_PANEL", $RutaMiServidor . "/panel.php");
define("MI_LOGO", $RutaMiServidor  . "/public/assets/img/logo.png");
define("MI_LOGO_2X", $RutaMiServidor . "/public/assets/img/logo2x.png");

define("AVATAR_M", $RutaMiServidor . "/public/assets/img/profiles/avatar5.png");
define("AVATAR_SMALL_M", $RutaMiServidor . "/public/assets/img/profiles/avatar5_small.PNG");
define("AVATAR_SMALL_2X_M", $RutaMiServidor  . "/public/assets/img/profiles/avatar5_small2x.png");
define("AVATAR_F", $RutaMiServidor . "/public/assets/img/profiles/avatar2.png");
define("AVATAR_SMALL_F", $RutaMiServidor . "/public/assets/img/profiles/avatar2_small.PNG");
define("AVATAR_SMALL_2X_F", $RutaMiServidor . "/public/assets/img/profiles/avatar2_small2x.png");

define("EQUIPO_REMOTO", gethostname());
define("IP_REMOTO", $_SERVER['REMOTE_ADDR']);

/********************************************************************************************/
/* PARA DE FINIR EL TIPO DE EMPRESA PARA PODER MOSTRAR OPCIONES DE LA APLICACION
/* OPCIONES COMO EL MODULO DE HISTORIA CLINICA, EN EL MODULO DE CONFIGURACION
/* OTRA LAS OPCIONES DE CONFIGURACION PARA HOSPITALES
/* OPCION 1 ES PARA HOSPITALES
/* OPCION 2 ES PARA OTRAS EMPRESAS
/********************************************************************************************/
define("TIPO_EMPRESA", 2);

/*
define("SERVER_FTP", 'c0910045.ferozo.com');
define("USUA_FTP", 'diplomado1@innovaj2la.com');
define("CONTRA_FTP", 'Diplomado1');
define("RUTA_FTP", 'diplomado1');
*/

$key = 'a3f89b12c4d56e7f90a1b234c56d78e9a1b2c34d5e67f8a9b0c1234d5e67f890';
