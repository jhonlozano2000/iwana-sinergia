<?php
require '../../../../config/lib/phpspreadsheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require_once "../../../../config/class.Conexion.php";
require_once '../../../../config/variable.php';
require_once "../../../../config/funciones.php";
include_once "../../../clases/reportes/radica/class.ReportRadicacionEnviado.php";
require_once '../../../clases/radicar/class.RadicaEnviadoResponsable.php';
require_once '../../../clases/configuracion/class.ConfigMiEmpresa.php';

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

$VerRadicado          = isset($_REQUEST['ChkRadicado']) ? $_REQUEST['ChkRadicado'] : null;
$VerTercero           = isset($_REQUEST['ChkTercero']) ? $_REQUEST['ChkTercero'] : null;
$VerFuncionario       = isset($_REQUEST['ChkFuncionario']) ? $_REQUEST['ChkFuncionario'] : null;
$VerFechaHoraRadica   = isset($_REQUEST['ChkFechaHoraRadica']) ? $_REQUEST['ChkFechaHoraRadica'] : null;
$VerFechaDocumento    = isset($_REQUEST['ChkFechaDocumento']) ? $_REQUEST['ChkFechaDocumento'] : null;
$VerFechaVencimiento  = isset($_REQUEST['ChkFechaVencimiento']) ? $_REQUEST['ChkFechaVencimiento'] : null;
$VerAsunto            = isset($_REQUEST['ChkAsunto']) ? $_REQUEST['ChkAsunto'] : null;
$VerDependencia       = isset($_REQUEST['ChkDependencia']) ? $_REQUEST['ChkDependencia'] : null;
$VerOficina           = isset($_REQUEST['ChkOficina']) ? $_REQUEST['ChkOficina'] : null;
$VerSerie             = isset($_REQUEST['ChkSerie']) ? $_REQUEST['ChkSerie'] : null;
$VerSubSerie          = isset($_REQUEST['ChkSubSerie']) ? $_REQUEST['ChkSubSerie'] : null;
$VerTipoDocumento     = isset($_REQUEST['ChkTipoDocumento']) ? $_REQUEST['ChkTipoDocumento'] : null;
$VerRadicadoRespuesta = isset($_REQUEST['ChkRadicadoRespuesta']) ? $_REQUEST['ChkRadicadoRespuesta'] : null;
$VerAsuntoRespuesta   = isset($_REQUEST['ChkAsuntoRespuesta']) ? $_REQUEST['ChkAsuntoRespuesta'] : null;
$VerFecHorRespuesta   = isset($_REQUEST['ChkFecHorRespuesta']) ? $_REQUEST['ChkFecHorRespuesta'] : null;
$VerQuienRadico       = isset($_REQUEST['ChkQuienRadico']) ? $_REQUEST['ChkQuienRadico'] : null;
$VerRequiereDigital   = isset($_REQUEST['ChkRequiereDigital']) ? $_REQUEST['ChkRequiereDigital'] : null;
$VerFormaRecepcion   = isset($_REQUEST['ChkFormaRecepcion']) ? $_REQUEST['ChkFormaRecepcion'] : null;

$NombreColumna = "";

$documento = new Spreadsheet();
$documento
    ->getProperties()
    ->setCreator(MI_NOMBRE)
    ->setLastModifiedBy(MI_NOMBRE) // última vez modificado por
    ->setTitle('Comunicaciones Enviadas')
    ->setSubject('Reportes');


$hoja = $documento->getActiveSheet();
$hoja->setTitle("Comunicaciones Enviadas");

$MiEmpresa = MiEmpresa::Buscar();
$RazonSocial = $MiEmpresa->get_RazonSocial();
$LogoEmpresa = $MiEmpresa->get_Logo();

//Combino las celdas desde A1 hasta E1
$hoja->mergeCells('A1:G1');
$hoja->setCellValue('A1', $RazonSocial);
$hoja->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$hoja->getStyle("A1")->getFont()->setBold(true);

$hoja->mergeCells('A2:G2');
$hoja->setCellValue('A2', 'Ventanilla -> Correspondencia Enviadas.');
$hoja->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$hoja->getStyle("A2")->getFont()->setBold(true);

$hoja->mergeCells('A4:G4');
$hoja->setCellValue('A7', ">> Reporte generado desde la fecha " . Fecha_Larga_Español($FecDesde) . " hasta el día " . Fecha_Larga_Español($FecDesde));
$hoja->getStyle("A4")->getFont()->setBold(true);

$Fila   = 9;
$Letras = 65;

if ($VerRadicado === 'true') {
    $LetraColumna = chr($Letras++);
    $hoja->setCellValue($LetraColumna . $Fila, 'ID. RADICADO');
    $hoja->getColumnDimension('A')->setWidth(15);
    $hoja->getColumnDimension($LetraColumna)->setWidth(15);
    $hoja->getStyle($LetraColumna . $Fila)->getFont()->setBold(true);
}

if ($VerTercero === 'true') {
    $LetraColumna = chr($Letras++);
    $hoja->setCellValue($LetraColumna . $Fila, 'TERCERO');
    $hoja->getColumnDimension($LetraColumna)->setWidth(50);
    $hoja->getStyle($LetraColumna . $Fila)->getFont()->setBold(true);
}

if ($VerFuncionario === 'true') {
    $LetraColumna = chr($Letras++);
    $hoja->setCellValue($LetraColumna . $Fila, 'FUNCIONARIO');
    $hoja->getColumnDimension($LetraColumna)->setWidth(40);
    $hoja->getStyle($LetraColumna . $Fila)->getFont()->setBold(true);
}

if ($VerFechaHoraRadica === 'true') {
    $LetraColumna = chr($Letras++);
    $hoja->setCellValue($LetraColumna . $Fila, 'FEC. RADICADO');
    $hoja->getColumnDimension($LetraColumna)->setWidth(19);
    $hoja->getStyle($LetraColumna . $Fila)->getFont()->setBold(true);
}

if ($VerFechaDocumento === 'true') {
    $LetraColumna = chr($Letras++);
    $hoja->setCellValue($LetraColumna . $Fila, 'FEC. DOCUMENTO');
    $hoja->getColumnDimension($LetraColumna)->setWidth(17);
    $hoja->getStyle($LetraColumna . $Fila)->getFont()->setBold(true);
}

if ($VerAsunto === 'true') {
    $LetraColumna = chr($Letras++);
    $hoja->setCellValue($LetraColumna . $Fila, 'ASUNTO');
    $hoja->getColumnDimension($LetraColumna)->setWidth(60);
    $hoja->getStyle($LetraColumna . $Fila)->getFont()->setBold(true);
}

if ($VerDependencia === 'true') {
    $LetraColumna = chr($Letras++);
    $hoja->setCellValue($LetraColumna . $Fila, 'DEPENDENCIA');
    $hoja->getColumnDimension($LetraColumna)->setWidth(30);
    $hoja->getStyle($LetraColumna . $Fila)->getFont()->setBold(true);
}

if ($VerOficina === 'true') {
    $LetraColumna = chr($Letras++);
    $hoja->setCellValue($LetraColumna . $Fila, 'OFICINA');
    $hoja->getColumnDimension($LetraColumna)->setWidth(40);
    $hoja->getStyle($LetraColumna . $Fila)->getFont()->setBold(true);
}

if ($VerSerie === 'true') {
    $LetraColumna = chr($Letras++);
    $hoja->setCellValue($LetraColumna . $Fila, 'SERIE');
    $hoja->getColumnDimension($LetraColumna)->setWidth(60);
    $hoja->getStyle($LetraColumna . $Fila)->getFont()->setBold(true);
}

if ($VerSubSerie === 'true') {
    $LetraColumna = chr($Letras++);
    $hoja->setCellValue($LetraColumna . $Fila, 'SUBSERIE');
    $hoja->getColumnDimension($LetraColumna)->setWidth(60);
    $hoja->getStyle($LetraColumna . $Fila)->getFont()->setBold(true);
}

if ($VerTipoDocumento === 'true') {
    $LetraColumna = chr($Letras++);
    $hoja->setCellValue($LetraColumna . $Fila, 'TIPO DOCUMENTAL');
    $hoja->getColumnDimension($LetraColumna)->setWidth(60);
    $hoja->getStyle($LetraColumna . $Fila)->getFont()->setBold(true);
}

if ($VerRadicadoRespuesta === 'true') {
    $LetraColumna = chr($Letras++);
    $hoja->setCellValue($LetraColumna . $Fila, 'RESPUESTA');
    $hoja->getColumnDimension($LetraColumna)->setWidth(18);
    $hoja->getStyle($LetraColumna . $Fila)->getFont()->setBold(true);
}

if ($VerAsuntoRespuesta === 'true') {
    $LetraColumna = chr($Letras++);
    $hoja->setCellValue($LetraColumna . $Fila, 'FEC. HORA');
    $hoja->getColumnDimension($LetraColumna)->setWidth(18);
    $hoja->getStyle($LetraColumna . $Fila)->getFont()->setBold(true);
}

if ($VerFecHorRespuesta === 'true') {
    $LetraColumna = chr($Letras++);
    $hoja->setCellValue($LetraColumna . $Fila, 'ASUNTO');
    $hoja->getColumnDimension($LetraColumna)->setWidth(60);
    $hoja->getStyle($LetraColumna . $Fila)->getFont()->setBold(true);
}

if ($VerQuienRadico === 'true') {
    $LetraColumna = chr($Letras++);
    $hoja->setCellValue($LetraColumna . $Fila, 'QUIEN RADICO');
    $hoja->getColumnDimension($LetraColumna)->setWidth(60);
    $hoja->getStyle($LetraColumna . $Fila)->getFont()->setBold(true);
}

if ($VerRequiereDigital === 'true') {
    $LetraColumna = chr($Letras++);
    $hoja->setCellValue($LetraColumna . $Fila, 'Digital');
    $hoja->getColumnDimension($LetraColumna)->setWidth(5);
    $hoja->getStyle($LetraColumna . $Fila)->getFont()->setBold(true);
}

if ($VerFormaRecepcion === 'true') {
    $LetraColumna = chr($Letras++);
    $hoja->setCellValue($LetraColumna . $Fila, 'Forma Recepción');
    $hoja->getColumnDimension($LetraColumna)->setWidth(30);
    $hoja->getStyle($LetraColumna . $Fila)->getFont()->setBold(true);
}

$LetraColumna = chr($Letras++);
$hoja->setCellValue($LetraColumna . $Fila, 'Tipo de Respuesta');
$hoja->getColumnDimension($LetraColumna)->setWidth(30);
$hoja->getStyle($LetraColumna . $Fila)->getFont()->setBold(true);

$LetraColumna = chr($Letras++);
$hoja->setCellValue($LetraColumna . $Fila, 'Proyector');
$hoja->getColumnDimension($LetraColumna)->setWidth(30);
$hoja->getStyle($LetraColumna . $Fila)->getFont()->setBold(true);

$boldArray = array('font' => array('bold' => true,), 'alignment' => array('horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER));

$hoja->getStyle('A' . $Fila . ':' . $LetraColumna . $Fila)->applyFromArray($boldArray);

$Celda = "";
$Condicional = "";

if ($FecDesde != "" and $FecHasta != "") {
    if ($Condicional == "") {
        $Condicional .= "DATE(`radi`.fechor_radica) BETWEEN '" . $FecDesde . "' AND '" . $FecHasta . "'";
    } else {
        $Condicional .= " AND DATE(`radi`.fechor_radica) BETWEEN '" . $FecDesde . "' AND '" . $FecHasta . "'";
    }
} elseif ($FecDesde != "" and $FecHasta == "") {
    if ($Condicional == "") {
        $Condicional .= "DATE(`radi`.fechor_radica) >= '" . Convertir_Fecha_A_Mysql($FecHasta) . "'";
    } else {
        $Condicional .= " AND DATE(`radi`.fechor_radica) >= '" . Convertir_Fecha_A_Mysql($FecHasta) . "'";
    }
} elseif ($FecDesde == "" and $FecHasta != "") {
    if ($Condicional == "") {
        $Condicional .= "DATE(`radi`.fechor_radica) >= '" . Convertir_Fecha_A_Mysql($FecHasta) . "'";
    } else {
        $Condicional .= " AND DATE(`radi`.fechor_radica) >= '" . Convertir_Fecha_A_Mysql($FecHasta) . "'";
    }
}
/*
    if($_POST['asunto'] != ""){
        if($Condicional == ""){
            $Condicional.="`radi`.asunto like '%".$_POST['asunto']."%'";
        }else{
            $Condicional.=" AND `radi`.asunto like '%".$_POST['asunto']."%'";
        }
    }
    */

if ($TipoTercer === 'NATURAL' and $IdTercero != "") {
    if ($Condicional == "") {
        $Condicional .= "terce_contac.id_tercero = " . $IdTercero;
    } else {
        $Condicional .= " AND terce_contac.id_tercero = " . $IdTercero;
    }
} elseif ($TipoTercer === 'JURIDICO' and $IdTercero != "") {
    if ($Condicional == "") {
        $Condicional .= "terce_empre.id_empre = " . $IdTercero;
    } else {
        $Condicional .= " AND terce_empre.id_empre = " . $IdTercero;
    }
}

if ($IdDestina != "") {
    if ($Condicional == "") {
        $Condicional .= "`ra_respon`.`id_funcio_deta` = " . $IdDestina;
    } else {
        $Condicional .= " AND `ra_respon`.`id_funcio_deta` = " . $IdDestina;
    }
}

if ($IdDepen != "0") {
    if ($Condicional == "") {
        $Condicional .= "depen.id_depen = " . $IdDepen;
    } else {
        $Condicional .= " AND depen.id_depen = " . $IdDepen;
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
        $Condicional .= " AND subserie = " . $IdSubSerie;
    }
}

if ($IdDepen != "0" and $IdSerie != "0" and $IdSubSerie != "0" and $IdTipoDoc != "0") {
    if ($Condicional == "") {
        $Condicional .= "subserie.id_tipodoc = " . $IdTipoDoc;
    } else {
        $Condicional .= " AND subserie.id_tipodoc = " . $IdTipoDoc;
    }
}

$Sql = "SELECT `radi`.`id_radica`, `radi`.`asunto`, `radi`.`fec_docu`, `radi`.`fechor_radica`, `radi`.`digital`, `radi`.`impri_rotu`,
                `fun`.`nom_funcio`, `fun`.`ape_funcio`, `areas_dependencias`.`id_depen`, `areas_dependencias`.`nom_depen`, `areas_oficinas`.`nom_oficina`,
                `terce_contac`.`nom_contac`, `terce_empre`.`razo_soci`, `funcio_radi`.`nom_funcio` AS `nom_funcio_radi`,
                `funcio_radi`.`ape_funcio` AS `ape_funcio_radi`, `config_formaenvio`.`id_formaenvio`, `config_formaenvio`.`nom_formaenvi`,
                `config_formaenvio`.`requie_digital`, `radi`.`impri_rotu`, `serie`.`cod_serie`, `serie`.`nom_serie`, `sub_serie`.`cod_subserie`,
                `sub_serie`.`nom_subserie`, `tipo_doc`.`nom_tipodoc`,
                CONCAT(`funcio_radi`.`nom_funcio`, ' ', `funcio_radi`.`ape_funcio`) as 'funcio_radi', CASE WHEN `radi`.`digital` = 0 THEN 'No' ELSE 'Si' END AS 'digital', `config_tipos_respuestas`.`nom_respues`,
                `proyec`.`nom_funcio` AS `nom_proyec`, `proyec`.`ape_funcio` AS `ape_proyec`
            FROM `archivo_radica_enviados_responsa` AS `ra_respon`
                INNER JOIN `archivo_radica_enviados` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_destina` = `terce_contac`.`id_tercero`)
                INNER JOIN `segu_usua` AS `usua_radi` ON (`radi`.`id_usua_regis` = `usua_radi`.`id_usua`)
                INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio_deta` = `funcio_deta`.`id_funcio_deta`)
                INNER JOIN `gene_funcionarios` AS `fun` ON (`funcio_deta`.`id_funcio` = `fun`.`id_funcio`)
                LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                INNER JOIN `gene_funcionarios` AS `funcio_radi` ON (`usua_radi`.`id_funcio` = `funcio_radi`.`id_funcio`)
                INNER JOIN `areas_oficinas` ON (`funcio_deta`.`id_oficina` = `areas_oficinas`.`id_oficina`)
                INNER JOIN `areas_dependencias` ON (`areas_oficinas`.`id_depen` = `areas_dependencias`.`id_depen`)
                INNER JOIN `config_formaenvio` ON (`radi`.`id_formaenvio` = `config_formaenvio`.`id_formaenvio`)
                LEFT JOIN `archivo_trd_series` AS `serie` ON (`radi`.`id_serie` = `serie`.`id_serie`)
                LEFT JOIN `archivo_trd_subserie` AS `sub_serie` ON (`radi`.`id_subserie` = `sub_serie`.`id_subserie`)
                LEFT JOIN `archivo_trd_tipo_docu` AS `tipo_doc` ON (`radi`.`id_tipodoc` = `tipo_doc`.`id_tipodoc`)
                INNER JOIN `config_tipos_respuestas` ON (`radi`.`id_tipo_respue` = `config_tipos_respuestas`.`id_respue`)
                INNER JOIN `archivo_radica_enviados_proyector` ON (`archivo_radica_enviados_proyector`.`id_radica` = `radi`.`id_radica`)
                INNER JOIN `gene_funcionarios_deta` AS `proyec_deta`ON (`archivo_radica_enviados_proyector`.`id_funcio_deta` = `proyec_deta`.`id_funcio_deta`)
                INNER JOIN `gene_funcionarios` AS `proyec` ON (`proyec`.`id_funcio` = `proyec_deta`.`id_funcio`)
            WHERE (`ra_respon`.`respon` = 1) AND  " . $Condicional . "
            ORDER BY `radi`.id_radica ASC";

$conexion = new conexion();
$Senten = $conexion->prepare($Sql);
$Senten->execute() or die(print_r($Senten->errorInfo() . " - " . $Sql, true));
$Result = $Senten->fetchAll(PDO::FETCH_ASSOC);

foreach ($Result as $Item) :
    $Fila++;
    $Letra = 65;

    if ($VerRadicado === 'true') {
        $Celda = chr($Letra++) . $Fila;
        $hoja->setCellValue($Celda, $Item['id_radica']);
    }

    if ($VerTercero === 'true') {
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

    if ($VerFuncionario === 'true') {
        $Celda = chr($Letra++) . $Fila;
        $hoja->setCellValue($Celda, $Item['nom_funcio'] . " " . $Item['ape_funcio']);
        $hoja->getStyle($Celda)->getAlignment()->setWrapText(true);
    }

    if ($VerFechaHoraRadica === 'true') {
        $Celda = chr($Letra++) . $Fila;
        $hoja->setCellValue($Celda, $Item['fechor_radica']);
    }

    if ($VerFechaDocumento === 'true') {
        $Celda = chr($Letra++) . $Fila;
        $hoja->setCellValue($Celda, $Item['fec_docu']);
    }

    if ($VerAsunto === 'true') {
        $Celda = chr($Letra++) . $Fila;
        $hoja->setCellValue($Celda, $Item['asunto']);
        $hoja->getStyle($Celda)->getAlignment()->setWrapText(true);
    }

    if ($VerDependencia === 'true') {
        $Celda = chr($Letra++) . $Fila;
        $hoja->setCellValue($Celda, $Item['nom_depen']);
        $hoja->getStyle($Celda)->getAlignment()->setWrapText(true);
    }

    if ($VerOficina === 'true') {
        $Celda = chr($Letra++) . $Fila;
        $hoja->setCellValue($Celda, $Item['nom_oficina']);
        $hoja->getStyle($Celda)->getAlignment()->setWrapText(true);
    }

    if ($VerSerie === 'true') {
        $Celda = chr($Letra++) . $Fila;
        $hoja->setCellValue($Celda, $Item['cod_serie'] . "." . $Item['nom_serie']);
        $hoja->getStyle($Celda)->getAlignment()->setWrapText(true);
    }

    if ($VerSubSerie === 'true') {
        $Celda = chr($Letra++) . $Fila;
        $hoja->setCellValue($Celda, $Item['cod_subserie'] . "." . $Item['nom_subserie']);
        $hoja->getStyle($Celda)->getAlignment()->setWrapText(true);
    }

    if ($VerTipoDocumento === 'true') {
        $Celda = chr($Letra++) . $Fila;
        $hoja->setCellValue($Celda, $Item['nom_tipodoc']);
        $hoja->getStyle($Celda)->getAlignment()->setWrapText(true);
    }

    if ($VerQuienRadico === 'true') {
        $Celda = chr($Letra++) . $Fila;
        $hoja->setCellValue($Celda, $Item['funcio_radi']);
        $hoja->getStyle($Celda)->getAlignment()->setWrapText(true);
    }

    if ($VerRequiereDigital === 'true') {
        $Celda = chr($Letra++) . $Fila;
        $hoja->setCellValue($Celda, $Item['digital']);
        $hoja->getStyle($Celda)->getAlignment()->setWrapText(true);
    }

    if ($VerFormaRecepcion === 'true') {
        $Celda = chr($Letra++) . $Fila;
        $hoja->setCellValue($Celda, $Item['nom_formaenvi']);
        $hoja->getStyle($Celda)->getAlignment()->setWrapText(true);
    }

    $Celda = chr($Letra++) . $Fila;
    $hoja->setCellValue($Celda, $Item['nom_respues']);
    $hoja->getStyle($Celda)->getAlignment()->setWrapText(true);

    $Celda = chr($Letra++) . $Fila;
    $hoja->setCellValue($Celda, $Item['nom_proyec'] . " " . $Item['ape_proyec']);
    $hoja->getStyle($Celda)->getAlignment()->setWrapText(true);
endforeach;

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

$nombreDelDocumento = "Reportes Comunicaciones Enviadas.xlsx";
/**
 * Los siguientes encabezados son necesarios para que
 * el navegador entienda que no le estamos mandando
 * simple HTML
 * Por cierto: no hagas ningún echo ni cosas de esas; es decir, no imprimas nada
 */

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $nombreDelDocumento . '"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($documento, 'Xlsx');
$writer->save('php://output');
exit;
