<?php
require '../../../../../config/lib/phpspreadsheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require_once "../../../../../config/class.Conexion.php";
require_once '../../../../../config/variable.php';
require_once "../../../../../config/funciones.php";
require_once '../../../../clases/reportes/retencion/class.ReportRetencion.php';
require_once '../../../../clases/configuracion/class.ConfigMiEmpresa.php';

$documento = new Spreadsheet();
$documento->getProperties()
		->setCreator(MI_NOMBRE)
		->setLastModifiedBy(MI_NOMBRE)
		->setTitle('Ofi. Archivo -> Detallado de Series')
		->setSubject('Reportes');

$hoja = $documento->getActiveSheet();
$hoja->setTitle("Detallado de Series");

$MiEmpresa = MiEmpresa::Buscar();

// Combino las celdas desde A1 hasta E1
$hoja->mergeCells('B1:F1');
$hoja->setCellValue('B1', $MiEmpresa->get_RazonSocial());
$hoja->getStyle('B1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$hoja->getStyle("B1")->getFont()->setBold(true); 

$hoja->mergeCells('B2:F2');
$hoja->setCellValue('B2', 'Ofi. Archivo -> Detallado de Series.');
$hoja->getStyle('B2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$hoja->getStyle("B2")->getFont()->setBold(true); 

$Fila = 7;
$hoja->setCellValue('B'.$Fila, 'Acti');
$hoja->setCellValue('C'.$Fila, 'SERIE');
$hoja->setCellValue('D'.$Fila, 'OBSERVACIONES');

	// Fuente de la primera fila en negrita
$boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER));
$hoja->getStyle('B'.$Fila.':G'.$Fila)->applyFromArray($boldArray);		

	//Ancho de las columnas
$hoja->getColumnDimension('B')->setWidth(5);
$hoja->getColumnDimension('C')->setWidth(30);
$hoja->getColumnDimension('D')->setWidth(80);

$Regis = ReportRretencion::Listar(1, "", "", "");
foreach ($Regis as $Item):
	$Fila++;

	$ActiSerie = "No";
	if($fila['acti'] = 1){
		$ActiSerie = "Si";
	}

	$hoja->setCellValue('B'.$Fila, $ActiSerie);
	$hoja->setCellValue('C'.$Fila, $Item['cod_serie'].".".$Item['nom_serie']);
	$hoja->setCellValue('D'.$Fila, $Item['observa']);
	
	$hoja->getStyle('C'.$Fila)->getAlignment()->setWrapText(true);
	$hoja->getStyle('D'.$Fila)->getAlignment()->setWrapText(true);
endforeach;

$rango="B7:D".$Fila;
$hoja->getStyle($rango)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

$objDrawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
$objDrawing->setName('imgNotice');
$objDrawing->setDescription('Noticia');
$img = '../../../../../archivos/otros/'.$MiEmpresa->get_Logo(); // Provide path to your logo file
$objDrawing->setPath($img);
$objDrawing->setOffsetX(28);    // setOffsetX works properly
$objDrawing->setOffsetY(50);  //setOffsetY has no effect
$objDrawing->setCoordinates('A1');
$objDrawing->setHeight(80); // logo height
$objDrawing->setWorksheet($documento->getActiveSheet());


$objDrawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
$objDrawing->setName('imgNotice');
$objDrawing->setDescription('Logo Iwana.');
$img = '../../../../../public/assets/img/logoFirma.png'; // Provide path to your logo file
$objDrawing->setPath($img);
$objDrawing->setOffsetX(28); // setOffsetX works properly
$objDrawing->setOffsetY(300);  //setOffsetY has no effect
$objDrawing->setCoordinates('A5');
$objDrawing->setHeight(30); // logo height
$objDrawing->setWorksheet($documento->getActiveSheet());

$writer = new Xlsx($documento);

$nombreDelDocumento = "Reportes Detallado de Series.xlsx";
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