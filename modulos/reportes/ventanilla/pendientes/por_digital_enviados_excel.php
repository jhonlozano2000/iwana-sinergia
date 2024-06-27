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
require_once '../../../clases/configuracion/class.ConfigMiEmpresa.php';

$documento = new Spreadsheet();
$documento->getProperties()
		->setCreator(MI_NOMBRE)
		->setLastModifiedBy(MI_NOMBRE)
		->setTitle('Pendientes de adjuntar digital')
		->setSubject('Reportes');

$hoja = $documento->getActiveSheet();
$hoja->setTitle("Pendientes de adjuntar digital");

$MiEmpresa = MiEmpresa::Buscar();
$RazonSocial = $MiEmpresa->get_RazonSocial();
$LogoEmpresa = $MiEmpresa->get_Logo();

// Combino las celdas desde A1 hasta E1
$hoja->mergeCells('B1:F1');
$hoja->setCellValue('B1', $RazonSocial);
$hoja->getStyle('B1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$hoja->getStyle("B1")->getFont()->setBold(true); 

$hoja->mergeCells('B2:F2');
$hoja->setCellValue('B2', 'Ventanilla -> Detallado de las comunicaciones enviadas pendientes de adjuntar digital.');
$hoja->getStyle('B2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$hoja->getStyle("B2")->getFont()->setBold(true); 

$Fila = 7;
$hoja->setCellValue('B'.$Fila, 'RADICADO');
$hoja->setCellValue('C'.$Fila, 'ASUNTO');
$hoja->setCellValue('D'.$Fila, 'FORMA RECIBIDO');
$hoja->setCellValue('E'.$Fila, 'TERCERO');
$hoja->setCellValue('F'.$Fila, 'LOGIN QUIEN REGISTRA');
$hoja->setCellValue('G'.$Fila, 'FUNCIONARIO QUIEN REGISTRA');

	// Fuente de la primera fila en negrita
$boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER));
$hoja->getStyle('B'.$Fila.':G'.$Fila)->applyFromArray($boldArray);		

	//Ancho de las columnas
$hoja->getColumnDimension('B')->setWidth(17);
$hoja->getColumnDimension('C')->setWidth(80);
$hoja->getColumnDimension('D')->setWidth(19);
$hoja->getColumnDimension('E')->setWidth(40);
$hoja->getColumnDimension('F')->setWidth(31);
$hoja->getColumnDimension('G')->setWidth(40);

//11
$Regis = ReportRadicacionEnviado::Listar(1, "", "", "", "", "", "", "", "");
foreach($Regis as $Item):
	$Fila++;

	$Tercero = "";
	if($Item['razo_soci'] != ""){
        $Tercero = 'Enti.: '.$Item['razo_soci'].".\rContac.: ".$Item['nom_contac'].".";
    }else{
        $Tercero = $Item['nom_contac'];
    }

	$hoja->setCellValue('B'.$Fila, $Item['id_radica']);
	$hoja->setCellValue('C'.$Fila, $Item['asunto']);
	$hoja->setCellValue('D'.$Fila, $Item['nom_formaenvi']);
	$hoja->setCellValue('E'.$Fila, $Tercero);
	$hoja->setCellValue('F'.$Fila, $Item['login']);
	$hoja->setCellValue('G'.$Fila, $Item['nom_funcio']." ".$Item['ape_funcio']);

	$hoja->getStyle('C'.$Fila)->getAlignment()->setWrapText(true);
	$hoja->getStyle('E'.$Fila)->getAlignment()->setWrapText(true);
endforeach;

$rango="B7:G".$Fila;
$hoja->getStyle($rango)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

$objDrawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
$objDrawing->setName('imgNotice');
$objDrawing->setDescription('Noticia');
$img = '../../../../archivos/otros/'.$LogoEmpresa; // Provide path to your logo file
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

$nombreDelDocumento = "Reportes Comunicaciones Enviadas Pendientes por Adjuntar Digital.xlsx";
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
?>