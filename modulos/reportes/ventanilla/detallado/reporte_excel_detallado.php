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
$VerTipoDocumento     = isset($_REQUEST['ChkTipoDocumento']) ? $_POST['ChkTipoDocumento'] : null;
$VerRadicadoRespuesta = isset($_REQUEST['ChkRadicadoRespuesta']) ? $_REQUEST['ChkRadicadoRespuesta'] : null;
$VerAsuntoRespuesta   = isset($_REQUEST['ChkAsuntoRespuesta']) ? $_REQUEST['ChkAsuntoRespuesta'] : null;
$VerFecHorRespuesta   = isset($_REQUEST['ChkFecHorRespuesta']) ? $_REQUEST['ChkFecHorRespuesta'] : null;

$MiEmpresa = MiEmpresa::Buscar();

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

$Fila          = 9;
$Letras        = 65;
$NombreColumna = "";
$Celda         = "";

if($VerRadicado === 'true'){
	$LetraColumna = chr($Letras++);
	$hoja->setCellValue($LetraColumna.$Fila, 'ID. RADICADO');
	$hoja->getColumnDimension($LetraColumna)->setWidth(15);
}

if($VerTercero === 'true'){
	$LetraColumna = chr($Letras++);
	$hoja->setCellValue($LetraColumna.$Fila, 'TERCERO');
	$hoja->getColumnDimension($LetraColumna)->setWidth(50);
}

if($VerFuncionario === 'true'){
	$LetraColumna = chr($Letras++);
	$hoja->setCellValue($LetraColumna.$Fila, 'FUNCIONARIO');
	$hoja->getColumnDimension($LetraColumna)->setWidth(40);
}

if($VerFechaHoraRadica === 'true'){
	$LetraColumna = chr($Letras++);
	$hoja->setCellValue($LetraColumna.$Fila, 'FEC. RADICADO');
	$hoja->getColumnDimension($LetraColumna)->setWidth(19);
}

if($VerFechaDocumento === 'true'){
	$LetraColumna = chr($Letras++);
	$hoja->setCellValue($LetraColumna.$Fila, 'FEC. DOCUMENTO');
	$hoja->getColumnDimension($LetraColumna)->setWidth(17);
}

if($VerFechaVencimiento === 'true'){
	$LetraColumna = chr($Letras++);
	$hoja->setCellValue($LetraColumna.$Fila, 'FEC. VENCIMIENTO');
	$hoja->getColumnDimension($LetraColumna)->setWidth(18);
}

if($VerAsunto === 'true'){
	$LetraColumna = chr($Letras++);
	$hoja->setCellValue($LetraColumna.$Fila, 'ASUNTO');
	$hoja->getColumnDimension($LetraColumna)->setWidth(60);
}

if($VerDependencia === 'true'){
	$LetraColumna = chr($Letras++);
	$hoja->setCellValue($LetraColumna.$Fila, 'DEPENDENCIA');
	$hoja->getColumnDimension($LetraColumna)->setWidth(30);
}

if($VerOficina === 'true'){
	$LetraColumna = chr($Letras++);
	$hoja->setCellValue($LetraColumna.$Fila, 'OFICINA');
	$hoja->getColumnDimension($LetraColumna)->setWidth(40);
}

if($VerSerie === 'true'){
	$LetraColumna = chr($Letras++);
	$hoja->setCellValue($LetraColumna.$Fila, 'SERIE');
	$hoja->getColumnDimension($LetraColumna)->setWidth(60);
}

if($VerSubSerie === 'true'){
	$LetraColumna = chr($Letras++);
	$hoja->setCellValue($LetraColumna.$Fila, 'SUBSERIE');
	$hoja->getColumnDimension($LetraColumna)->setWidth(60);
}

if($VerTipoDocumento === 'true'){
	$LetraColumna = chr($Letras++);
	$hoja->setCellValue($LetraColumna.$Fila, 'TIPO DOCUMENTAL');
	$hoja->getColumnDimension($LetraColumna)->setWidth(60);
}

if($VerRadicadoRespuesta === 'true'){
	$LetraColumna = chr($Letras++);
	$hoja->setCellValue($LetraColumna.$Fila, 'RESPUESTA');
	$hoja->getColumnDimension($LetraColumna)->setWidth(18);
}

if($VerAsuntoRespuesta === 'true'){
	$LetraColumna = chr($Letras++);
	$hoja->setCellValue($LetraColumna.$Fila, 'FEC. HORA');
	$hoja->getColumnDimension($LetraColumna)->setWidth(18);
}

if($VerFecHorRespuesta === 'true'){
	$LetraColumna = chr($Letras++);
	$hoja->setCellValue($LetraColumna.$Fila, 'ASUNTO');
	$hoja->getColumnDimension($LetraColumna)->setWidth(60);
}

// Fuente de la primera fila en negrita
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

if($Celda === ""){
	echo 'Iwana no encontró registros con los criterios de búsqueda especificados';
	exit();
}
$rango="A9:".$Celda;

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