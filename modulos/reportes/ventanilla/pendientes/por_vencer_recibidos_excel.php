<?php
require '../../../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

// Asegúrate de que no hay ninguna salida antes de este punto
ob_start();

require_once "../../../../config/class.Conexion.php";
require_once '../../../../config/variable.php';
require_once "../../../../config/funcionesConversion.php";
include_once "../../../clases/reportes/radica/class.ReportRadicacionRecibido.php";
require_once '../../../clases/configuracion/class.ConfigMiEmpresa.php';
require_once '../../../clases/notificaciones/class.NotificacionesEmailExterna.php';

$documento = new Spreadsheet();
$documento->getProperties()
	->setCreator(MI_NOMBRE)
	->setLastModifiedBy(MI_NOMBRE)
	->setTitle('Pendientes por vencer')
	->setSubject('Reportes');

$hoja = $documento->getActiveSheet();
$hoja->setTitle("Pendientes de vencer");

$MiEmpresa = MiEmpresa::Buscar();
$RazonSocial = $MiEmpresa->get_RazonSocial();
$LogoEmpresa = $MiEmpresa->get_Logo();

$hoja->mergeCells('B1:H1');
$hoja->setCellValue('B1', $RazonSocial);
$hoja->getStyle('B1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$hoja->getStyle("B1")->getFont()->setBold(true);

$hoja->mergeCells('B2:H2');
$hoja->setCellValue('B2', 'Ventanilla -> Detallado de las comunicaciones prontas a vencer.');
$hoja->getStyle('B2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$hoja->getStyle("B2")->getFont()->setBold(true);

$Fila = 7;
$hoja->setCellValue('B' . $Fila, 'RADICADO')
	->setCellValue('C' . $Fila, 'ESTADO')
	->setCellValue('D' . $Fila, 'DIAS')
	->setCellValue('E' . $Fila, 'FEC. DOCU')
	->setCellValue('F' . $Fila, 'FEC. VENCI')
	->setCellValue('G' . $Fila, 'ASUNTO')
	->setCellValue('H' . $Fila, 'RESPONSABLE')
	->setCellValue('I' . $Fila, 'TERCERO')
	->setCellValue('J' . $Fila, 'NOTIFICACIONES');

// Fuente de la primera fila en negrita
$boldArray = array('font' => array('bold' => true,), 'alignment' => array('horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER));
$hoja->getStyle('B' . $Fila . ':J' . $Fila)->applyFromArray($boldArray);

// Ancho de las columnas
$hoja->getColumnDimension('B')->setWidth(17);
$hoja->getColumnDimension('C')->setWidth(8);
$hoja->getColumnDimension('D')->setWidth(8);
$hoja->getColumnDimension('E')->setWidth(12);
$hoja->getColumnDimension('F')->setWidth(12);
$hoja->getColumnDimension('G')->setWidth(80);
$hoja->getColumnDimension('H')->setWidth(40);
$hoja->getColumnDimension('I')->setWidth(60);
$hoja->getColumnDimension('J')->setWidth(150);

$Regis = ReportRadicacionRecibido::Listar(3, "", "", "", "", "", "", "", "");
foreach ($Regis as $Item):
	$Fila++;

	$Estado = "";
	$DiasTrascurridos = "";
	$DiasParaRespuesta = "";
	$TotalDias = 0;

	$DiasTrascurridos  = DiasTrascurridos($Item['fechor_radica']);
	if (!empty($Item['fec_venci'])) {
		$DiasParaRespuesta = DiasParaRespuesta($Item['fechor_radica'], $Item['fec_venci']);
		$TotalDias = ($DiasParaRespuesta - $DiasTrascurridos);
	} else {
		$TotalDias = '';
	}

	if ($Item['fec_venci'] != "") {
		if ($DiasTrascurridos > $DiasParaRespuesta) {
			$Estado = "Vencido";
		} else {
			$Estado = $DiasTrascurridos . "/" . $DiasParaRespuesta;
		}
	}

	$Tercero = "";
	if ($Item['razo_soci'] != "") {
		$Tercero = 'Enti.: ' . $Item['razo_soci'] . "\nContac.: " . $Item['nom_contac'];
	} else {
		$Tercero = $Item['nom_contac'];
	}

	$Notificaciones = NotificacionEmailExterna::Listar(1, $Item['id_radica'], '', '');
	$NotificacionesEnviadas = "";
	foreach ($Notificaciones as $ItemNotifica) {
		$NotificacionesEnviadas .= '* Notificacion enviada el dia ' . $ItemNotifica['fechor_notifica'] . " - " . $ItemNotifica['titulo'] . "\n";
	}

	$hoja->setCellValue('B' . $Fila, $Item['id_radica']);
	$hoja->setCellValue('C' . $Fila, $Estado);
	$hoja->setCellValue('D' . $Fila, $TotalDias);
	$hoja->setCellValue('E' . $Fila, $Item['fec_docu']);
	$hoja->setCellValue('F' . $Fila, $Item['fec_venci']);
	$hoja->setCellValue('G' . $Fila, $Item['asunto']);
	$hoja->setCellValue('H' . $Fila, $Item['nom_funcio'] . " " . $Item['ape_funcio']);
	$hoja->setCellValue('I' . $Fila, $Tercero);
	$hoja->setCellValue('J' . $Fila, trim($NotificacionesEnviadas));

	$hoja->getStyle('G' . $Fila)->getAlignment()->setWrapText(true);
	$hoja->getStyle('H' . $Fila)->getAlignment()->setWrapText(true);
	$hoja->getStyle('I' . $Fila)->getAlignment()->setWrapText(true);
	$hoja->getStyle('J' . $Fila)->getAlignment()->setWrapText(true);
endforeach;

$rango = "B7:J" . $Fila;
$hoja->getStyle($rango)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

$objDrawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
$objDrawing->setName('imgNotice');
$objDrawing->setDescription('Noticia');
$img = '../../../../archivos/otros/' . $LogoEmpresa;
$objDrawing->setPath($img);
$objDrawing->setOffsetX(28);
$objDrawing->setOffsetY(50);
$objDrawing->setCoordinates('A1');
$objDrawing->setHeight(80);
$objDrawing->setWorksheet($documento->getActiveSheet());

$objDrawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
$objDrawing->setName('imgNotice');
$objDrawing->setDescription('Logo Iwana.');
$img = '../../../../public/assets/img/logoFirma.png';
$objDrawing->setPath($img);
$objDrawing->setOffsetX(28);
$objDrawing->setOffsetY(300);
$objDrawing->setCoordinates('A5');
$objDrawing->setHeight(30);
$objDrawing->setWorksheet($documento->getActiveSheet());

$nombreDelDocumento = "Reportes Comunicaciones Recibidas Pendientes por Vencer.xlsx";

// Limpia el búfer de salida antes de enviar el archivo
ob_clean();

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $nombreDelDocumento . '"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($documento, 'Xlsx');
$writer->save('php://output');

// Cierra el script para evitar cualquier salida posterior
exit();
