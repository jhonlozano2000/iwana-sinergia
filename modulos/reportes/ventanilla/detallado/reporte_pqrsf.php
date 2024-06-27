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

$documento = new Spreadsheet();
$documento->getProperties()
	->setCreator('ssss')
	->setLastModifiedBy('MI_NOMBRE')
	->setTitle('Reporte de PQRSF')
	->setSubject('Reportes');

$hoja = $documento->getActiveSheet();
$hoja->setTitle("Pendientes de vencer");

$MiEmpresa = MiEmpresa::Buscar();
$RazonSocial = $MiEmpresa->get_RazonSocial();
$LogoEmpresa = $MiEmpresa->get_Logo();


// Combino las celdas desde A1 hasta E1
$hoja->mergeCells('B1:Q1');
$hoja->setCellValue('B1', $RazonSocial);
$hoja->getStyle('B1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$hoja->getStyle("B1")->getFont()->setBold(true);

$hoja->mergeCells('B2:R2');
$hoja->setCellValue('B2', 'Ventanilla -> Reporte de PQRSF.');
$hoja->getStyle('B2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$hoja->getStyle("B2")->getFont()->setBold(true);

$Fila = 7;
$hoja->setCellValue('B' . $Fila, 'RADICADO')
	->setCellValue('C' . $Fila, 'FECHA DE ENTRADA')
	->setCellValue('D' . $Fila, 'ENTIDAD / CIUDADANO')
	->setCellValue('E' . $Fila, 'NIT / CC CIUDADANO')
	->setCellValue('F' . $Fila, 'TELEFONO')
	->setCellValue('G' . $Fila, 'MUNICIPIO')
	->setCellValue('H' . $Fila, 'FUNCIONARIO')
	->setCellValue('I' . $Fila, 'FECHA DE VENCIMIENTO')
	->setCellValue('J' . $Fila, 'ASUNTO')
	->setCellValue('K' . $Fila, 'TIPO DE PQRSF(SUBSERIE)')
	->setCellValue('L' . $Fila, 'TIPO DOCUMENTAL')
	->setCellValue('M' . $Fila, 'CANAL DE COMUNICACIÓN')
	->setCellValue('N' . $Fila, 'RADICADO DE RESPUESTA')
	->setCellValue('O' . $Fila, 'FECHA DE RESPUESTA')
	->setCellValue('P' . $Fila, 'ESTADO(AROBADO-NEGADO-TRASLADO)')
	->setCellValue('Q' . $Fila, 'ASUNTO')
	->setCellValue('R' . $Fila, 'FORMA DE ENVIO');

// Fuente de la primera fila en negrita
$boldArray = array('font' => array('bold' => true,), 'alignment' => array('horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER));
$hoja->getStyle('B' . $Fila . ':Q' . $Fila)->applyFromArray($boldArray);

//Ancho de las columnas
$hoja->getColumnDimension('B')->setWidth(17);
$hoja->getColumnDimension('C')->setWidth(18);
$hoja->getColumnDimension('D')->setWidth(40);
$hoja->getColumnDimension('E')->setWidth(20);
$hoja->getColumnDimension('F')->setWidth(12);
$hoja->getColumnDimension('G')->setWidth(18);
$hoja->getColumnDimension('H')->setWidth(25);
$hoja->getColumnDimension('I')->setWidth(22);
$hoja->getColumnDimension('J')->setWidth(80);
$hoja->getColumnDimension('K')->setWidth(25);
$hoja->getColumnDimension('L')->setWidth(25);
$hoja->getColumnDimension('M')->setWidth(25);
$hoja->getColumnDimension('N')->setWidth(23);
$hoja->getColumnDimension('O')->setWidth(19);
$hoja->getColumnDimension('P')->setWidth(30);
$hoja->getColumnDimension('Q')->setWidth(30);
$hoja->getColumnDimension('R')->setWidth(30);

$FecDesde             = isset($_REQUEST['desde']) ? Convertir_Fecha_A_Mysql($_REQUEST['desde']) : null;
$FecHasta             = isset($_REQUEST['hasta']) ? Convertir_Fecha_A_Mysql($_REQUEST['hasta']) : null;

$Regis = ReportRadicacionRecibido::Listar(4, "", "", "", "", $FecDesde, $FecHasta, "");
foreach ($Regis as $Item) :
	$Fila++;

	$hoja->setCellValue('B' . $Fila, $Item['RADICADO DE ENTRADA']);
	$hoja->setCellValue('C' . $Fila, $Item['FECHA DE ENTRADA']);

	if ($Item['ENTIDAD'] != "") {
		$hoja->setCellValue('D' . $Fila, $Item['ENTIDAD']);
		$hoja->setCellValue('E' . $Fila, $Item['NIT']);
		$hoja->setCellValue('F' . $Fila, $Item['TELEFONO']);
		$hoja->setCellValue('G' . $Fila, $Item['nom_muni']);
	} else {
		$hoja->setCellValue('D' . $Fila, $Item['CIUDADANO']);
		$hoja->setCellValue('E' . $Fila, $Item['CEDULA']);
		$hoja->setCellValue('F' . $Fila, $Item['TELEFONO']);
		$hoja->setCellValue('G' . $Fila, $Item['MUNICIPIO']);
	}

	$hoja->setCellValue('H' . $Fila, $Item['NOM. FUNCIONARIO'] . " " . $Item['APE. FUNCIONARIO']);
	$hoja->setCellValue('I' . $Fila, $Item['FECHA DE VENCIMIENTO']);
	$hoja->setCellValue('J' . $Fila, $Item['ASUNTO']);
	$hoja->setCellValue('K' . $Fila, $Item['TIPO DE PQRSF(SUBSERIE)']);
	$hoja->setCellValue('L' . $Fila, $Item['TIPO DOCUMENTAL']);
	$hoja->setCellValue('M' . $Fila, $Item['CANAL DE COMUNICACIÓN']);
	$hoja->setCellValue('N' . $Fila, $Item['RADICADO DE RESPUESTA']);
	$hoja->setCellValue('O' . $Fila, $Item['FECHA DE RESPUESTA']);
	$hoja->setCellValue('P' . $Fila, $Item['ESTADO(AROBADO-NEGADO-TRASLADO)']);
	$hoja->setCellValue('Q' . $Fila, $Item['asunto']);
	$hoja->setCellValue('R' . $Fila, $Item['nom_formaenvi']);

	$hoja->getStyle('G' . $Fila)->getAlignment()->setWrapText(true);
	$hoja->getStyle('H' . $Fila)->getAlignment()->setWrapText(true);
	$hoja->getStyle('I' . $Fila)->getAlignment()->setWrapText(true);
endforeach;

$rango = "B7:R" . $Fila;
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
