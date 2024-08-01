<?php
require '../../../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require_once "../../../../config/class.Conexion.php";
require_once '../../../../config/variable.php';
require_once "../../../../config/funciones.php";
include_once "../../../clases/reportes/radica/class.ReportRadicacionRecibido.php";
require_once '../../../clases/radicar/class.RadicaRecibidoResponsable.php';
require_once '../../../clases/configuracion/class.ConfigMiEmpresa.php';
require_once '../../../clases/configuracion/class.ConfigServidor_Temp.php';
require_once '../../../clases/varias/class.ftp.php';

$OrigenCorrespon      = isset($_REQUEST['origen_correspon']) ? $_REQUEST['origen_correspon'] : null;
$FecDesde             = isset($_REQUEST['desde']) ? Convertir_Fecha_A_Mysql($_REQUEST['desde']) : null;
$FecHasta             = isset($_REQUEST['hasta']) ? Convertir_Fecha_A_Mysql($_REQUEST['hasta']) : null;
$IdTercero            = isset($_REQUEST['id_tercero']) ? $_REQUEST['id_tercero'] : null;
$TipoTercer           = isset($_REQUEST['tipo_tercero']) ? $_REQUEST['tipo_tercero'] : null;
$IdFuncionario        = isset($_REQUEST['id_funcionario']) ? $_REQUEST['id_funcionario'] : null;
$IdDestina            = isset($_REQUEST['id_destinatario']) ? $_REQUEST['id_destinatario'] : null;
$IdDepen              = isset($_REQUEST['id_depen']) ? $_REQUEST['id_depen'] : null;
$IdSerie              = isset($_REQUEST['id_serie']) ? $_REQUEST['id_serie'] : null;
$IdSubSerie           = isset($_REQUEST['id_subserie']) ? $_REQUEST['id_subserie'] : null;
$IdTipoDoc            = isset($_REQUEST['id_tipodoc']) ? $_REQUEST['id_tipodoc'] : null;

$VerRadicado          = isset($_REQUEST['ChkRadicado']) ? true : null;
$VerTercero           = isset($_REQUEST['ChkTercero']) ? true : null;
$VerFuncionario       = isset($_REQUEST['ChkFuncionario']) ? true : null;
$VerFechaHoraRadica   = isset($_REQUEST['ChkFechaHoraRadica']) ? true : null;
$VerFechaDocumento    = isset($_REQUEST['ChkFechaDocumento']) ? true : null;
$VerFechaVencimiento  = isset($_REQUEST['ChkFechaVencimiento']) ? true : null;
$VerAsunto            = isset($_REQUEST['ChkAsunto']) ? true : null;
$VerDependencia       = isset($_REQUEST['ChkDependencia']) ? true : null;
$VerOficina           = isset($_REQUEST['ChkOficina']) ? true : null;
$VerSerie             = isset($_REQUEST['ChkSerie']) ? true : null;
$VerSubSerie          = isset($_REQUEST['ChkSubSerie']) ? true : null;
$VerTipoDocumento     = isset($_REQUEST['ChkTipoDocumento']) ? true : null;
$VerRadicadoRespuesta = isset($_REQUEST['ChkRadicadoRespuesta']) ? true : null;
$VerAsuntoRespuesta   = isset($_REQUEST['ChkAsuntoRespuesta']) ? true : null;
$VerFecHorRespuesta   = isset($_REQUEST['ChkFecHorRespuesta']) ? true : null;
$VerQuienRadico       = isset($_REQUEST['ChkQuienRadico']) ? true : null;
$VerRequiereDigital   = isset($_REQUEST['ChkRequiereDigital']) ? true : null;
$VerFormaRecepcion   = isset($_REQUEST['ChkFormaRecepcion']) ? true : null;

$NombreColumna = "";

$documento = new Spreadsheet();
$documento
    ->getProperties()
    ->setCreator(MI_NOMBRE)
    ->setLastModifiedBy(MI_NOMBRE) // última vez modificado por
    ->setTitle('Comunicaciones Recibidas')
    ->setSubject('Reportes');

$hoja = $documento->getActiveSheet();
$hoja->setTitle("Comunicaciones Recibidas");

$MiEmpresa = MiEmpresa::Buscar();
$RazonSocial = $MiEmpresa->get_RazonSocial();
$LogoEmpresa = $MiEmpresa->get_Logo();

//Combino las celdas desde A1 hasta E1
$hoja->mergeCells('A1:G1');
$hoja->setCellValue('A1', $RazonSocial);
$hoja->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$hoja->getStyle("A1")->getFont()->setBold(true);

$hoja->mergeCells('A2:G2');
$hoja->setCellValue('A2', 'Ventanilla -> Correspondencia Recibida.');
$hoja->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$hoja->getStyle("A2")->getFont()->setBold(true);

$hoja->mergeCells('A4:G4');
$hoja->setCellValue('A7', ">> Reporte generado desde la fecha " . Fecha_Larga_Español($FecDesde) . " hasta el día " . Fecha_Larga_Español($FecDesde));
$hoja->getStyle("A4")->getFont()->setBold(true);

$Fila   = 9;
$Letras = 65;

if ($VerRadicado == true) {
    $LetraColumna = chr($Letras++);
    $hoja->setCellValue($LetraColumna . $Fila, 'ID. RADICADO');
    $hoja->getColumnDimension('A')->setWidth(15);
    $hoja->getColumnDimension($LetraColumna)->setWidth(15);
    $hoja->getStyle($LetraColumna . $Fila)->getFont()->setBold(true);
}

if ($VerTercero === true) {
    $LetraColumna = chr($Letras++);
    $hoja->setCellValue($LetraColumna . $Fila, 'TERCERO');
    $hoja->getColumnDimension($LetraColumna)->setWidth(50);
    $hoja->getStyle($LetraColumna . $Fila)->getFont()->setBold(true);
}

if ($VerFuncionario === true) {
    $LetraColumna = chr($Letras++);
    $hoja->setCellValue($LetraColumna . $Fila, 'FUNCIONARIO');
    $hoja->getColumnDimension($LetraColumna)->setWidth(40);
    $hoja->getStyle($LetraColumna . $Fila)->getFont()->setBold(true);
}

if ($VerFechaHoraRadica === true) {
    $LetraColumna = chr($Letras++);
    $hoja->setCellValue($LetraColumna . $Fila, 'FEC. RADICADO');
    $hoja->getColumnDimension($LetraColumna)->setWidth(19);
    $hoja->getStyle($LetraColumna . $Fila)->getFont()->setBold(true);
}

if ($VerFechaDocumento === true) {
    $LetraColumna = chr($Letras++);
    $hoja->setCellValue($LetraColumna . $Fila, 'FEC. DOCUMENTO');
    $hoja->getColumnDimension($LetraColumna)->setWidth(17);
    $hoja->getStyle($LetraColumna . $Fila)->getFont()->setBold(true);
}

if ($VerFechaVencimiento === true) {
    $LetraColumna = chr($Letras++);
    $hoja->setCellValue($LetraColumna . $Fila, 'FEC. VENCIMIENTO');
    $hoja->getColumnDimension($LetraColumna)->setWidth(18);
    $hoja->getStyle($LetraColumna . $Fila)->getFont()->setBold(true);
}

if ($VerAsunto === true) {
    $LetraColumna = chr($Letras++);
    $hoja->setCellValue($LetraColumna . $Fila, 'ASUNTO');
    $hoja->getColumnDimension($LetraColumna)->setWidth(60);
    $hoja->getStyle($LetraColumna . $Fila)->getFont()->setBold(true);
}

if ($VerDependencia === true) {
    $LetraColumna = chr($Letras++);
    $hoja->setCellValue($LetraColumna . $Fila, 'DEPENDENCIA');
    $hoja->getColumnDimension($LetraColumna)->setWidth(30);
    $hoja->getStyle($LetraColumna . $Fila)->getFont()->setBold(true);
}

if ($VerOficina === true) {
    $LetraColumna = chr($Letras++);
    $hoja->setCellValue($LetraColumna . $Fila, 'OFICINA');
    $hoja->getColumnDimension($LetraColumna)->setWidth(40);
    $hoja->getStyle($LetraColumna . $Fila)->getFont()->setBold(true);
}

if ($VerSerie === true) {
    $LetraColumna = chr($Letras++);
    $hoja->setCellValue($LetraColumna . $Fila, 'SERIE');
    $hoja->getColumnDimension($LetraColumna)->setWidth(60);
    $hoja->getStyle($LetraColumna . $Fila)->getFont()->setBold(true);
}

if ($VerSubSerie === true) {
    $LetraColumna = chr($Letras++);
    $hoja->setCellValue($LetraColumna . $Fila, 'SUBSERIE');
    $hoja->getColumnDimension($LetraColumna)->setWidth(60);
    $hoja->getStyle($LetraColumna . $Fila)->getFont()->setBold(true);
}

if ($VerTipoDocumento === true) {
    $LetraColumna = chr($Letras++);
    $hoja->setCellValue($LetraColumna . $Fila, 'TIPO DOCUMENTAL');
    $hoja->getColumnDimension($LetraColumna)->setWidth(60);
    $hoja->getStyle($LetraColumna . $Fila)->getFont()->setBold(true);
}

if ($VerRadicadoRespuesta === true) {
    $LetraColumna = chr($Letras++);
    $hoja->setCellValue($LetraColumna . $Fila, 'RESPUESTA');
    $hoja->getColumnDimension($LetraColumna)->setWidth(18);
    $hoja->getStyle($LetraColumna . $Fila)->getFont()->setBold(true);
}

if ($VerAsuntoRespuesta === true) {
    $LetraColumna = chr($Letras++);
    $hoja->setCellValue($LetraColumna . $Fila, 'FEC. HORA');
    $hoja->getColumnDimension($LetraColumna)->setWidth(18);
    $hoja->getStyle($LetraColumna . $Fila)->getFont()->setBold(true);
}

if ($VerFecHorRespuesta === true) {
    $LetraColumna = chr($Letras++);
    $hoja->setCellValue($LetraColumna . $Fila, 'ASUNTO');
    $hoja->getColumnDimension($LetraColumna)->setWidth(60);
    $hoja->getStyle($LetraColumna . $Fila)->getFont()->setBold(true);
}

if ($VerQuienRadico === true) {
    $LetraColumna = chr($Letras++);
    $hoja->setCellValue($LetraColumna . $Fila, 'QUIEN RADICO');
    $hoja->getColumnDimension($LetraColumna)->setWidth(60);
    $hoja->getStyle($LetraColumna . $Fila)->getFont()->setBold(true);
}

if ($VerRequiereDigital === true) {
    $LetraColumna = chr($Letras++);
    $hoja->setCellValue($LetraColumna . $Fila, 'Digital');
    $hoja->getColumnDimension($LetraColumna)->setWidth(5);
    $hoja->getStyle($LetraColumna . $Fila)->getFont()->setBold(true);
}

if ($VerFormaRecepcion === true) {
    $LetraColumna = chr($Letras++);
    $hoja->setCellValue($LetraColumna . $Fila, 'Forma Recepción');
    $hoja->getColumnDimension($LetraColumna)->setWidth(30);
    $hoja->getStyle($LetraColumna . $Fila)->getFont()->setBold(true);
}

$boldArray = array('font' => array('bold' => true,), 'alignment' => array('horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER));

$hoja->getStyle('A' . $Fila . ':' . $LetraColumna . $Fila)->applyFromArray($boldArray);

$Celda = "";
$Condicional = "";

if ($FecDesde != "") {
    if ($Condicional == "") {
        $Condicional .= "DATE(`ra`.fechor_radica) >= '" . $FecDesde . "'";
    } else {
        $Condicional .= " AND DATE(`ra`.fechor_radica) >= '" . $FecDesde . "'";
    }
}

if ($FecHasta != "") {
    if ($Condicional == "") {
        $Condicional .= "DATE(`ra`.fechor_radica) <= '" . $FecHasta . "'";
    } else {
        $Condicional .= " AND DATE(`ra`.fechor_radica) <= '" . $FecHasta . "'";
    }
}

/*
    if($_REQUEST['asunto'] != ""){
        if($Condicional == ""){
            $Condicional.="`ra`.asunto like '%".$_POST['asunto']."%'";
        }else{
            $Condicional.=" AND `ra`.asunto like '%".$_POST['asunto']."%'";
        }
    }
    */

if ($TipoTercer === 'NATURAL' and $IdTercero != "") {
    if ($Condicional == "") {
        $Condicional .= "RemiteContac.id_tercero = " . $IdTercero;
    } else {
        $Condicional .= " AND RemiteContac.id_tercero = " . $IdTercero;
    }
} elseif ($TipoTercer === 'JURIDICO' and $IdTercero != "") {
    if ($Condicional == "") {
        $Condicional .= "RemiteContac.id_empre = " . $IdTercero;
    } else {
        $Condicional .= " AND RemiteContac.id_empre = " . $IdTercero;
    }
}

if ($IdDestina != "") {
    if ($Condicional == "") {
        $Condicional .= "ResponFuncio.id_funcio = " . $IdDestina;
    } else {
        $Condicional .= " AND ResponFuncio.id_funcio = " . $IdDestina;
    }
}

if ($IdDepen != "0") {
    if ($Condicional == "") {
        $Condicional .= "depen_respon.id_depen = " . $IdDepen;
    } else {
        $Condicional .= " AND depen_respon.id_depen = " . $IdDepen;
    }
}

if ($IdDepen != "0" and $IdSerie != "0") {
    if ($Condicional == "") {
        $Condicional .= "serie.id_serie = " . $IdSerie;
    } else {
        $Condicional .= " AND serie.id_serie = " . $IdSerie;
    }
}

if ($IdDepen != "0" and $IdSerie != "0" and $IdSubSerie != "0") {
    if ($Condicional == "") {
        $Condicional .= "subserie.id_subserie = " . $IdSubSerie;
    } else {
        $Condicional .= " AND subserie.id_subserie = " . $IdSubSerie;
    }
}

if ($IdDepen != "0" and $IdSerie != "0" and $IdSubSerie != "0" and $IdTipoDoc != "0") {
    if ($Condicional == "") {
        $Condicional .= "tipodocu.id_tipodoc = " . $IdTipoDoc;
    } else {
        $Condicional .= " AND tipodocu.id_tipodoc = " . $IdTipoDoc;
    }
}

$Sql = "SELECT `ra`.`id_radica`, `ra`.`fechor_radica`, `ra`.`fec_docu`, `ra`.`fec_venci`, `ra`.`requie_respues`, `ra`.`asunto`, `ra`.`digital`,
                `forma_recibi`.`nom_formaenvi` AS `nom_forma_llega`, `funcio_respon`.`nom_funcio` AS `nom_funcio_respon`,
                `funcio_respon`.`ape_funcio` AS `ape_funcio_respon`, `depen_respon`.`nom_depen` AS `nom_depen_respon`,
                `ofi_respon`.`nom_oficina` AS `nom_oficina_respon`, `terce_contac`.`nom_contac`, `terce_empre`.`nit_empre`, `terce_empre`.`razo_soci`,
                `usua_regis`.`login`, `funcio_regis`.`nom_funcio` AS `nom_funcio_radi`, `funcio_regis`.`ape_funcio` AS `ape_funcio_radi`,
                `ra`.`impri_rotu`, `serie`.`cod_serie`, `serie`.`nom_serie`, `sub_serie`.`cod_subserie`, `sub_serie`.`nom_subserie`,
                `tipo_doc`.`nom_tipodoc`, `ra`.`radica_respuesta`, `ra_envia`.`fechor_radica` AS `fechor_radica_respuesta`, `ra_envia`.`asunto` AS `asunto_respuesta`,  `ra`. `id_ruta`, `ra`. `archivo`
            FROM `archivo_radica_recibidos` AS `ra`
                INNER JOIN `archivo_trd_series` AS `serie` ON (`ra`.`id_serie` = `serie`.`id_serie`)
                INNER JOIN `archivo_trd_subserie` AS `sub_serie` ON (`ra`.`id_subserie` = `sub_serie`.`id_subserie`)
                INNER JOIN `config_formaenvio` AS `forma_recibi` ON (`ra`.`id_forma_llegada` = `forma_recibi`.`id_formaenvio`)
                INNER JOIN `archivo_radica_recibidos_responsa` AS `ra_respon` ON (`ra_respon`.`id_radica` = `ra`.`id_radica`)
                INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`ra`.`id_remite` = `terce_contac`.`id_tercero`)
                INNER JOIN `segu_usua` AS `usua_regis` ON (`ra`.`id_usua_regis` = `usua_regis`.`id_usua`)
                INNER JOIN `archivo_trd_tipo_docu` AS `tipo_doc` ON (`ra`.`id_tipodoc` = `tipo_doc`.`id_tipodoc`)
                INNER JOIN `gene_funcionarios_deta` AS `funcio_deta_respon` ON (`ra_respon`.`id_funcio` = `funcio_deta_respon`.`id_funcio_deta`)
                INNER JOIN `gene_funcionarios` AS `funcio_respon` ON (`funcio_deta_respon`.`id_funcio` = `funcio_respon`.`id_funcio`)
                INNER JOIN `areas_oficinas` AS `ofi_respon` ON (`funcio_deta_respon`.`id_oficina` = `ofi_respon`.`id_oficina`)
                INNER JOIN `areas_dependencias` AS `depen_respon` ON (`ofi_respon`.`id_depen` = `depen_respon`.`id_depen`)
                LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                INNER JOIN `gene_funcionarios` AS `funcio_regis` ON (`usua_regis`.`id_funcio` = `funcio_regis`.`id_funcio`)
                LEFT JOIN `archivo_radica_enviados` AS `ra_envia` ON (`ra_envia`.`id_radica` = `ra`.`radica_respuesta`)
            WHERE (ra_respon.respon = 1) AND  " . $Condicional . "
            ORDER BY `ra`.id_radica ASC";

$conexion = new conexion();
$Senten = $conexion->prepare($Sql);
$Senten->execute() or die(print_r($Senten->errorInfo() . " - " . $Sql, true));
$Result = $Senten->fetchAll(PDO::FETCH_ASSOC);

$logFile = fopen("log.txt", 'a') or die("Error creando archivo");

foreach ($Result as $Item) :
    $Fila++;
    $Letra = 65;

    if ($VerRadicado === true) {
        $Celda = chr($Letra++) . $Fila;
        $hoja->setCellValue($Celda, $Item['id_radica']);
        if ($Item['archivo'] != "") {
            $hoja->getCell($Celda)->getHyperlink()->setUrl($Item['archivo']);
        }
    }

    if ($VerTercero === true) {
        $Celda = chr($Letra++) . $Fila;
        $Tercero = "";

        if ($Item['razo_soci'] === "") {
            $Tercero = $Item['nom_contac'];
        } else {
            $Tercero = $Item['razo_soci'] . "\nContac: " . $Item['nom_contac'];
        }

        $hoja->setCellValue($Celda, $Tercero);
        $hoja->getStyle($Celda)->getAlignment()->setWrapText(true);
    }

    if ($VerFuncionario === true) {
        $Celda = chr($Letra++) . $Fila;
        $hoja->setCellValue($Celda, $Item['nom_funcio_respon'] . " " . $Item['ape_funcio_respon']);
        $hoja->getStyle($Celda)->getAlignment()->setWrapText(true);
    }

    if ($VerFechaHoraRadica === true) {
        $Celda = chr($Letra++) . $Fila;
        $hoja->setCellValue($Celda, $Item['fechor_radica']);
    }

    if ($VerFechaDocumento === true) {
        $Celda = chr($Letra++) . $Fila;
        $hoja->setCellValue($Celda, $Item['fec_docu']);
    }

    if ($VerFechaVencimiento === true) {
        $Celda = chr($Letra++) . $Fila;
        $hoja->setCellValue($Celda, $Item['fec_venci']);
    }

    if ($VerAsunto === true) {
        $Celda = chr($Letra++) . $Fila;
        $hoja->setCellValue($Celda, $Item['asunto']);
        $hoja->getStyle($Celda)->getAlignment()->setWrapText(true);
    }

    if ($VerDependencia === true) {
        $Celda = chr($Letra++) . $Fila;
        $hoja->setCellValue($Celda, $Item['nom_depen_respon']);
        $hoja->getStyle($Celda)->getAlignment()->setWrapText(true);
    }

    if ($VerOficina === true) {
        $Celda = chr($Letra++) . $Fila;
        $hoja->setCellValue($Celda, $Item['nom_oficina_respon']);
        $hoja->getStyle($Celda)->getAlignment()->setWrapText(true);
    }

    if ($VerSerie === true) {
        $Celda = chr($Letra++) . $Fila;
        $hoja->setCellValue($Celda, $Item['cod_serie'] . "." . $Item['nom_serie']);
        $hoja->getStyle($Celda)->getAlignment()->setWrapText(true);
    }

    if ($VerSubSerie === true) {
        $Celda = chr($Letra++) . $Fila;
        $hoja->setCellValue($Celda, $Item['cod_subserie'] . "." . $Item['nom_subserie']);
        $hoja->getStyle($Celda)->getAlignment()->setWrapText(true);
    }

    if ($VerTipoDocumento === true) {
        $Celda = chr($Letra++) . $Fila;
        $hoja->setCellValue($Celda, $Item['nom_tipodoc']);
        $hoja->getStyle($Celda)->getAlignment()->setWrapText(true);
    }

    if ($VerRadicadoRespuesta === true) {
        $Celda = chr($Letra++) . $Fila;
        $hoja->setCellValue($Celda, $Item['radica_respuesta']);
    }

    if ($VerFecHorRespuesta === true) {
        $Celda = chr($Letra++) . $Fila;
        $hoja->setCellValue($Celda, $Item['fechor_radica_respuesta']);
    }

    if ($VerAsuntoRespuesta === true) {
        $Celda = chr($Letra++) . $Fila;
        $hoja->setCellValue($Celda, $Item['asunto_respuesta']);
        $hoja->getStyle($Celda)->getAlignment()->setWrapText(true);
    }

    if ($VerQuienRadico === true) {
        $Celda = chr($Letra++) . $Fila;
        $hoja->setCellValue($Celda, $Item['nom_funcio_radi'] . " " . $Item['ape_funcio_radi']);
        $hoja->getStyle($Celda)->getAlignment()->setWrapText(true);
    }

    if ($VerRequiereDigital === true) {
        $Celda = chr($Letra++) . $Fila;
        $hoja->setCellValue($Celda, $Item['digital']);
        $hoja->getStyle($Celda)->getAlignment()->setWrapText(true);
    }

    if ($VerFormaRecepcion === true) {
        $Celda = chr($Letra++) . $Fila;
        $hoja->setCellValue($Celda, $Item['nom_forma_llega']);
        $hoja->getStyle($Celda)->getAlignment()->setWrapText(true);
    }

    fwrite($logFile, "\n" . $Item['id_radica'] . " - Ruta " . $Item['id_ruta'] . " Mensaje que se quiera grabar") or die("Error escribiendo en el archivo");

    /**
     * Inicio la descarga de los archivos
     */
    if ($Item['id_ruta'] != "" and $Item['id_ruta'] > 0) {
        $Servidor      = ServidorTemp::Buscar(2, $Item['id_ruta'], "", 1);
        $Ip            = $Servidor->get_Ip();
        $Usuario       = $Servidor->get_Usua();
        $Contra        = $Servidor->get_Contra();
        $RutaFtp       = $Servidor->get_Ruta();
        /*     $Radicado      = RadicadoRecibido::Buscar(1, $Item['id_radica'], "", "", "", ""); */
        $FechaRadicado = new DateTime($Item['fechor_radica']);
        $Ano           = $FechaRadicado->format('Y');

        if (!is_dir(MI_ROOT_TEMP_RELATIVA . "/recibidos/"))
            mkdir(MI_ROOT_TEMP_RELATIVA . "/recibidos/", 0777);

        if (!is_dir(MI_ROOT_TEMP_RELATIVA . "/recibidos/backups"))
            mkdir(MI_ROOT_TEMP_RELATIVA . "/recibidos/backups", 0777);

        $ftpObj = new FTPClient();
        //Connect
        $ftpObj->connect($Ip, $Usuario, $Contra);
        if ($ftpObj->pr($ftpObj->getMessages()[0]) == 'true') {

            $NomArchivo = $Item['archivo'];
            $RutaArchivo = "";

            if ($RutaFtp != "") {
                $RutaArchivo = $Ano . "/" . $RutaFtp . "/" . $Item['id_radica'] . "/" . $Item['archivo'];
            } else {
                $RutaArchivo = $Ano . "/" . $Item['id_radica'] . "/" . $Item['archivo'];
            }

            if (file_exists(MI_ROOT_TEMP_RELATIVA . "/recibidos/backups/" . $Item['archivo'])) {
                unlink(MI_ROOT_TEMP_RELATIVA . "/recibidos/backups/" . $Item['archivo']);
            }

            $ftpObj->downloadFile(MI_ROOT_TEMP_RELATIVA . "/recibidos/backups/" . $Item['archivo'], $RutaArchivo);
            if (!$ftpObj->pr($ftpObj->getMessages()[0]) == 'true') {
                echo "No fue posible descargar el archivo o el arhivo non existe";
                exit();
            }
        } else {
            echo "No fue posible conectarme con el servidor de archivo….\nPor favor consulte con el administrador del sistema.";
            exit();
        }
    }
endforeach;

fclose($logFile);

if ($Celda == "") {
    echo "No hay datos para mostrar.";
    exit();
}

$rango = "A9:" . $Celda;
$hoja->getStyle($rango)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

$objDrawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
$objDrawing->setName('imgNotice');
$objDrawing->setDescription('Noticia');
$img = '../../../../archivos/otros/' . $LogoEmpresa; // Provide path to your logo file
$objDrawing->setPath($img);
$objDrawing->setOffsetX(28);    // setOffsetX works properly
$objDrawing->setOffsetY(50);  //setOffsetY has no effect
$objDrawing->setCoordinates('A1');
$objDrawing->setHeight(80); // logo height
$objDrawing->setWorksheet($documento->getActiveSheet());


$objDrawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
$objDrawing->setName('imgNotice');
$objDrawing->setDescription('Logo Iwana.');
$img = '../../../../public/assets/img/logoFirma.png'; // Provide path to your logo file
$objDrawing->setPath($img);
$objDrawing->setOffsetX(28); // setOffsetX works properly
$objDrawing->setOffsetY(300);  //setOffsetY has no effect
$objDrawing->setCoordinates('A5');
$objDrawing->setHeight(30); // logo height
$objDrawing->setWorksheet($documento->getActiveSheet());

$writer = new Xlsx($documento);

$nombreDelDocumento = "Reportes_Comunicaciones_Recibidas.xlsx";

$writer->save(MI_ROOT_TEMP_RELATIVA . "/recibidos/backups/" . $nombreDelDocumento);

$zip = new ZipArchive();
$zip->open(MI_ROOT_TEMP_RELATIVA . '/recibidos/Reportes_Comunicaciones_Recibidas.zip', \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

//indicamos cual es la carpeta que se quiere comprimir
$origen = realpath(MI_ROOT_TEMP_RELATIVA . "/recibidos/backups/");

//Ahora usando funciones de recursividad vamos a explorar todo el directorio y a enlistar todos los archivos contenidos en la carpeta
$files = new \RecursiveIteratorIterator(
    new \RecursiveDirectoryIterator($origen),
    \RecursiveIteratorIterator::LEAVES_ONLY
);

//Ahora recorremos el arreglo con los nombres los archivos y carpetas y se adjuntan en el zip
foreach ($files as $name => $file) {
    if (!$file->isDir()) {
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($origen) + 1);

        $zip->addFile($filePath, $relativePath);
    }
}

$zip->addFile(MI_ROOT_TEMP_RELATIVA . "/recibidos/backups/" . $nombreDelDocumento, $nombreDelDocumento);
$zip->close();

$files = glob(MI_ROOT_TEMP_RELATIVA . "/recibidos/backups/*"); //obtenemos todos los nombres de los ficheros
foreach ($files as $file) {
    if (is_file($file))
        unlink($file); //elimino el fichero
}

rmdir(MI_ROOT_TEMP_RELATIVA . "/recibidos/backups/");

echo '1###' . '../../../../archivos/temp/recibidos/Reportes_Comunicaciones_Recibidas.zip';
exit;
