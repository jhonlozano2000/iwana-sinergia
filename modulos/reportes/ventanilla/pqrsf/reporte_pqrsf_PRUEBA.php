<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require '../../../../config/lib/phpspreadsheet/vendor/autoload.php';

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

/* require_once "../../../../config/class.Conexion.php";
require_once '../../../../config/variable.php';
require_once "../../../../config/funciones.php";
include_once "../../../clases/reportes/radica/class.ReportRadicacionRecibido.php";
require_once '../../../clases/configuracion/class.ConfigMiEmpresa.php'; */

$documento = new Spreadsheet();
$documento->getProperties()
    ->setCreator('ssss')
    ->setLastModifiedBy('MI_NOMBRE')
    ->setTitle('Pendientes por vencer')
    ->setSubject('Reportes');

/* $hoja = $documento->getActiveSheet();
$hoja->setTitle("Pendientes de vencer");

$MiEmpresa = MiEmpresa::Buscar();
$RazonSocial = $MiEmpresa->get_RazonSocial();
$LogoEmpresa = $MiEmpresa->get_Logo();


// Combino las celdas desde A1 hasta E1
$hoja->mergeCells('B1:H1');
$hoja->setCellValue('B1', $RazonSocial);
$hoja->getStyle('B1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$hoja->getStyle("B1")->getFont()->setBold(true);

$hoja->mergeCells('B2:H2');
$hoja->setCellValue('B2', 'Ventanilla -> Detallado de las comunicaciones prontas a vencer.');
$hoja->getStyle('B2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$hoja->getStyle("B2")->getFont()->setBold(true); */

/* $Fila = 7;
$hoja->setCellValue('B' . $Fila, 'RADICADO')
	->setCellValue('C' . $Fila, 'FECHA DE ENTRADA')
	->setCellValue('D' . $Fila, 'ENTIDAD')
	->setCellValue('E' . $Fila, 'NIT')
	->setCellValue('F' . $Fila, 'TELEFONO')
	->setCellValue('G' . $Fila, 'DEPARTAMENTO')
	->setCellValue('H' . $Fila, 'MUNICIPIO')
	->setCellValue('I' . $Fila, 'CC CIUDADANO')
	->setCellValue('J' . $Fila, 'CIUDADANO')
	->setCellValue('K' . $Fila, 'TELEFONO')
	->setCellValue('L' . $Fila, 'DEPARTAMENTO')
	->setCellValue('M' . $Fila, 'MUNICIPIO')
	->setCellValue('N' . $Fila, 'CC FUNCIONARIO')
	->setCellValue('O' . $Fila, 'FUNCIONARIO')
	->setCellValue('P' . $Fila, 'FECHA DOCUMENTO')
	->setCellValue('Q' . $Fila, 'FECHA DE VENCIMIENTO')
	->setCellValue('R' . $Fila, 'ASUNTO')
	->setCellValue('S' . $Fila, 'TIPO DE PQRSF(SUBSERIE)')
	->setCellValue('T' . $Fila, 'TIPO DOCUMENTAL')
	->setCellValue('U' . $Fila, 'CANAL DE COMUNICACIÓN')
	->setCellValue('V' . $Fila, 'RADICADO DE RESPUESTA')
	->setCellValue('W' . $Fila, 'FECHA DE RESPUESTA')
	->setCellValue('X' . $Fila, 'ESTADO(AROBADO-NEGADO-TRASLADO)');

// Fuente de la primera fila en negrita
$boldArray = array('font' => array('bold' => true,), 'alignment' => array('horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER));
$hoja->getStyle('B' . $Fila . ':Y' . $Fila)->applyFromArray($boldArray);

//Ancho de las columnas
$hoja->getColumnDimension('B')->setWidth(17);
$hoja->getColumnDimension('C')->setWidth(8);
$hoja->getColumnDimension('D')->setWidth(8);
$hoja->getColumnDimension('E')->setWidth(12);
$hoja->getColumnDimension('F')->setWidth(12);
$hoja->getColumnDimension('G')->setWidth(80);
$hoja->getColumnDimension('H')->setWidth(40);
$hoja->getColumnDimension('I')->setWidth(60);

$FecDesde             = isset($_REQUEST['desde']) ? Convertir_Fecha_A_Mysql($_REQUEST['desde']) : null;
$FecHasta             = isset($_REQUEST['hasta']) ? Convertir_Fecha_A_Mysql($_REQUEST['hasta']) : null;

$Regis = ReportRadicacionRecibido::Listar(4, "", "", "", "", $FecDesde, $FecHasta, "");
foreach ($Regis as $Item) :
	$Fila++; */

/* $hoja->setCellValue('B' . $Fila, $Item['RADICADO DE ENTRADA']);
	$hoja->setCellValue('C' . $Fila, $Item['FECHA DE ENTRADA']);
	$hoja->setCellValue('D' . $Fila, $Item['ENTIDAD']);
	$hoja->setCellValue('E' . $Fila, $Item['NIT']);
	$hoja->setCellValue('F' . $Fila, $Item['TELEFONO']);
	$hoja->setCellValue('G' . $Fila, $Item['nom_depar']);
	$hoja->setCellValue('H' . $Fila, $Item['nom_muni']);
	$hoja->setCellValue('I' . $Fila, $Item['CÉDULA']);
	$hoja->setCellValue('J' . $Fila, $Item['CIUDADANO']);
	$hoja->setCellValue('K' . $Fila, $Item['TELEFONO']);
	$hoja->setCellValue('L' . $Fila, $Item['DEPARTAMENTO']);
	$hoja->setCellValue('M' . $Fila, $Item['MUNICIPIO']);
	$hoja->setCellValue('N' . $Fila, $Item['CC FUNCIONARIO']);
	$hoja->setCellValue('O' . $Fila, $Item['NOM. FUNCIONARIO'] . " " . $Item['APE. FUNCIONARIO']);
	$hoja->setCellValue('P' . $Fila, $Item['FECHA DE DOCUMENTO']);
	$hoja->setCellValue('Q' . $Fila, $Item['FECHA DE VENCIMIENTO']);
	$hoja->setCellValue('R' . $Fila, $Item['ASUNTO']);
	$hoja->setCellValue('S' . $Fila, $Item['TIPO DE PQRSF(SUBSERIE)']);
	$hoja->setCellValue('T' . $Fila, $Item['TIPO DOCUMENTAL']);
	$hoja->setCellValue('U' . $Fila, $Item['CANAL DE COMUNICACIÓN']);
	$hoja->setCellValue('V' . $Fila, $Item['RADICADO DE RESPUESTA']);
	$hoja->setCellValue('W' . $Fila, $Item['FECHA DE RESPUESTA']);
	$hoja->setCellValue('X' . $Fila, $Item['ESTADO(AROBADO-NEGADO-TRASLADO)']); */

/* $hoja->getStyle('G' . $Fila)->getAlignment()->setWrapText(true);
	$hoja->getStyle('H' . $Fila)->getAlignment()->setWrapText(true);
	$hoja->getStyle('I' . $Fila)->getAlignment()->setWrapText(true);
endforeach; */

/* $rango = "B7:I" . $Fila;
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
$objDrawing->setWorksheet($documento->getActiveSheet()); */

$writer = new Xlsx($documento);

$nombreDelDocumento = "Reportes PQRSF.xlsx";
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

exit();
