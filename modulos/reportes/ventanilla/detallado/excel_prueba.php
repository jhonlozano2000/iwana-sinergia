<?php
require '../../../../config/lib/phpspreadsheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require_once "../../../../config/class.Conexion.php";
require_once '../../../../config/variable.php';
require_once "../../../../config/funciones.php";
include_once "../../../clases/reportes/radica/class.ReportRadicacionRecibido.php";
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
$hoja->setCellValue('A7', ">> Reporte generado desde la fecha ".Fecha_Larga_Español($FecDesde)." hasta el día ".Fecha_Larga_Español($FecDesde));
$hoja->getStyle("A4")->getFont()->setBold(true); 

$Fila   = 9;
$Letras = 65;

if($VerRadicado === 'true'){
	$LetraColumna = chr($Letras++);
	$hoja->setCellValue($LetraColumna.$Fila, 'ID. RADICADO');
	$hoja->getColumnDimension('A')->setWidth(15);
	$hoja->getColumnDimension($LetraColumna)->setWidth(15);
	$hoja->getStyle($LetraColumna.$Fila)->getFont()->setBold(true); 
}

if($VerTercero === 'true'){
	$LetraColumna = chr($Letras++);
	$hoja->setCellValue($LetraColumna.$Fila, 'TERCERO');
	$hoja->getColumnDimension($LetraColumna)->setWidth(50);
	$hoja->getStyle($LetraColumna.$Fila)->getFont()->setBold(true); 
}

if($VerFuncionario === 'true'){
	$LetraColumna = chr($Letras++);
	$hoja->setCellValue($LetraColumna.$Fila, 'FUNCIONARIO');
	$hoja->getColumnDimension($LetraColumna)->setWidth(40);
	$hoja->getStyle($LetraColumna.$Fila)->getFont()->setBold(true); 
}

if($VerFechaHoraRadica === 'true'){
	$LetraColumna = chr($Letras++);
	$hoja->setCellValue($LetraColumna.$Fila, 'FEC. RADICADO');
	$hoja->getColumnDimension($LetraColumna)->setWidth(19);
	$hoja->getStyle($LetraColumna.$Fila)->getFont()->setBold(true); 
}

if($VerFechaDocumento === 'true'){
	$LetraColumna = chr($Letras++);
	$hoja->setCellValue($LetraColumna.$Fila, 'FEC. DOCUMENTO');
	$hoja->getColumnDimension($LetraColumna)->setWidth(17);
	$hoja->getStyle($LetraColumna.$Fila)->getFont()->setBold(true); 
}

if($VerFechaVencimiento === 'true'){
	$LetraColumna = chr($Letras++);
	$hoja->setCellValue($LetraColumna.$Fila, 'FEC. VENCIMIENTO');
	$hoja->getColumnDimension($LetraColumna)->setWidth(18);
	$hoja->getStyle($LetraColumna.$Fila)->getFont()->setBold(true); 
}

if($VerAsunto === 'true'){
	$LetraColumna = chr($Letras++);
	$hoja->setCellValue($LetraColumna.$Fila, 'ASUNTO');
	$hoja->getColumnDimension($LetraColumna)->setWidth(60);
	$hoja->getStyle($LetraColumna.$Fila)->getFont()->setBold(true); 
}

if($VerDependencia === 'true'){
	$LetraColumna = chr($Letras++);
	$hoja->setCellValue($LetraColumna.$Fila, 'DEPENDENCIA');
	$hoja->getColumnDimension($LetraColumna)->setWidth(30);
	$hoja->getStyle($LetraColumna.$Fila)->getFont()->setBold(true); 
}

if($VerOficina === 'true'){
	$LetraColumna = chr($Letras++);
	$hoja->setCellValue($LetraColumna.$Fila, 'OFICINA');
	$hoja->getColumnDimension($LetraColumna)->setWidth(40);
	$hoja->getStyle($LetraColumna.$Fila)->getFont()->setBold(true); 
}

if($VerSerie === 'true'){
	$LetraColumna = chr($Letras++);
	$hoja->setCellValue($LetraColumna.$Fila, 'SERIE');
	$hoja->getColumnDimension($LetraColumna)->setWidth(60);
	$hoja->getStyle($LetraColumna.$Fila)->getFont()->setBold(true); 
}

if($VerSubSerie === 'true'){
	$LetraColumna = chr($Letras++);
	$hoja->setCellValue($LetraColumna.$Fila, 'SUBSERIE');
	$hoja->getColumnDimension($LetraColumna)->setWidth(60);
	$hoja->getStyle($LetraColumna.$Fila)->getFont()->setBold(true); 
}

if($VerTipoDocumento === 'true'){
	$LetraColumna = chr($Letras++);
	$hoja->setCellValue($LetraColumna.$Fila, 'TIPO DOCUMENTAL');
	$hoja->getColumnDimension($LetraColumna)->setWidth(60);
	$hoja->getStyle($LetraColumna.$Fila)->getFont()->setBold(true); 
}

if($VerRadicadoRespuesta === 'true'){
	$LetraColumna = chr($Letras++);
	$hoja->setCellValue($LetraColumna.$Fila, 'RESPUESTA');
	$hoja->getColumnDimension($LetraColumna)->setWidth(18);
	$hoja->getStyle($LetraColumna.$Fila)->getFont()->setBold(true); 
}

if($VerAsuntoRespuesta === 'true'){
	$LetraColumna = chr($Letras++);
	$hoja->setCellValue($LetraColumna.$Fila, 'FEC. HORA');
	$hoja->getColumnDimension($LetraColumna)->setWidth(18);
	$hoja->getStyle($LetraColumna.$Fila)->getFont()->setBold(true); 
}

if($VerFecHorRespuesta === 'true'){
	$LetraColumna = chr($Letras++);
	$hoja->setCellValue($LetraColumna.$Fila, 'ASUNTO');
	$hoja->getColumnDimension($LetraColumna)->setWidth(60);
	$hoja->getStyle($LetraColumna.$Fila)->getFont()->setBold(true); 
}

$boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER));

$hoja->getStyle('A'.$Fila.':'.$LetraColumna.$Fila)->applyFromArray($boldArray);

$Regis = ReportRadicacionRecibido::Listar_Detallado($FecDesde, $FecHasta, $IdTercero, $TipoTercer, $IdFuncionario, $IdDepen, $IdSerie, $IdSubSerie, $IdTipoDoc);
foreach($Regis as $Item):
	$Fila++;
	$Letra = 65;
	
	if($VerRadicado === 'true'){
		$Celda = chr($Letra++).$Fila;
		$hoja->setCellValue($Celda, $Item['id_radica']);
	}

	if($VerTercero === 'true'){
		$Celda = chr($Letra++).$Fila;
		$Tercero = "";

		if($Item['razo_soci'] === ""){
			$Tercero = $Item['nom_contac'];
		}else{
			$Tercero = $Item['razo_soci']."\nContac: ".$Item['nom_contac'];
		}

		$hoja->setCellValue($Celda , $Tercero);
		$hoja->getStyle($Celda)->getAlignment()->setWrapText(true);
	}

	if($VerFuncionario === 'true'){
		$Celda = chr($Letra++).$Fila;
		$hoja->setCellValue($Celda, $Item['nom_funcio']." ".$Item['ape_funcio']);
		$hoja->getStyle($Celda)->getAlignment()->setWrapText(true);
	}

	if($VerFechaHoraRadica === 'true'){
		$Celda = chr($Letra++).$Fila;
		$hoja->setCellValue($Celda, $Item['fechor_radica']);
	}

	if($VerFechaDocumento === 'true'){
		$Celda = chr($Letra++).$Fila;
		$hoja->setCellValue($Celda, $Item['fec_docu']);
	}

	if($VerFechaVencimiento === 'true'){
		$Celda = chr($Letra++).$Fila;
		$hoja->setCellValue($Celda, $Item['fec_venci']);
	}

	if($VerAsunto === 'true'){
		$Celda = chr($Letra++).$Fila;
		$hoja->setCellValue($Celda, $Item['asunto']);
		$hoja->getStyle($Celda)->getAlignment()->setWrapText(true);
	}

	if($VerDependencia === 'true'){
		$Celda = chr($Letra++).$Fila;
		$hoja->setCellValue($Celda, $Item['nom_depen']);
		$hoja->getStyle($Celda)->getAlignment()->setWrapText(true);
	}

	if($VerOficina === 'true'){
		$Celda = chr($Letra++).$Fila;
		$hoja->setCellValue($Celda, $Item['nom_oficina']);
		$hoja->getStyle($Celda)->getAlignment()->setWrapText(true);
	}

	if($VerSerie === 'true'){
		$Celda = chr($Letra++).$Fila;
		$hoja->setCellValue($Celda, $Item['cod_serie'].".".$Item['nom_serie']);
		$hoja->getStyle($Celda)->getAlignment()->setWrapText(true);
	}

	if($VerSubSerie === 'true'){
		$Celda = chr($Letra++).$Fila;
		$hoja->setCellValue($Celda, $Item['cod_subserie'].".".$Item['nom_subserie']);
		$hoja->getStyle($Celda)->getAlignment()->setWrapText(true);
	}

	if($VerTipoDocumento === 'true'){
		$Celda = chr($Letra++).$Fila;
		$hoja->setCellValue($Celda, $Item['nom_tipodoc']);
		$hoja->getStyle($Celda)->getAlignment()->setWrapText(true);
	}

	if($VerRadicadoRespuesta === 'true'){
		$Celda = chr($Letra++).$Fila;
		$hoja->setCellValue($Celda, $Item['radica_respuesta']);
	}

	if($VerFecHorRespuesta === 'true'){
		$Celda = chr($Letra++).$Fila;
		$hoja->setCellValue($Celda, $Item['fechor_radica_respuesta']);
	}

	if($VerAsuntoRespuesta === 'true'){
		$Celda = chr($Letra++).$Fila;
		$hoja->setCellValue($Celda, $Item['asunto_respuesta']);
		$hoja->getStyle($Celda)->getAlignment()->setWrapText(true);
	}
endforeach;

$rango="A9:".$Celda;

$styleArray = array( 'borders' => array( 'outline' => array( 'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK, 'color' => array('argb' => 'FFF'), ), ), );
$hoja->getStyle($rango)->applyFromArray($styleArray);

$writer = new Xlsx($documento);

$nombreDelDocumento = "Reportes Comunicaciones Recibidas.xlsx";
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
?>