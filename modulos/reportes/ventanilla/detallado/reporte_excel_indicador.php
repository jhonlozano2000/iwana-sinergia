<?php
ob_start();
include "../../../../config/class.Conexion.php";
include "../../../../config/funciones.php";
include_once "../../../clases/reportes/radica/class.ReportRadicacionRecibido.php";
require_once '../../../clases/configuracion/class.ConfigMiEmpresa.php';
require_once '../../../../config/lib/PHPExcel-1.8/Classes/PHPExcel.php';

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

$NombreColumna       = "";

$MiEmpresa = MiEmpresa::Buscar();

// Crear nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();

	// Propiedades del documento
$objPHPExcel->getProperties()->setCreator("Iwana")
->setLastModifiedBy("Iwana")
->setTitle("'Ventanilla -> Flujo Documental por Dependencia.")
->setSubject("'Ventanilla -> Flujo Documental por Dependencia.")
->setDescription("Total de las comunicaciones enviadas por dependencia.")
->setKeywords("office 2010 openxml php")
->setCategory("Backups");

$Fila   = 9;
$Letras = 65;

if($VerRadicado === 'true'){
	$LetraColumna = chr($Letras++);
	$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue($LetraColumna.$Fila, 'ID. RADICADO');
	$objPHPExcel->getActiveSheet()->getColumnDimension($LetraColumna)->setWidth(15);
}

if($VerTercero === 'true'){
	$LetraColumna = chr($Letras++);
	$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue($LetraColumna.$Fila, 'TERCERO');
	$objPHPExcel->getActiveSheet()->getColumnDimension($LetraColumna)->setWidth(50);
}

if($VerFuncionario === 'true'){
	$LetraColumna = chr($Letras++);
	$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue($LetraColumna.$Fila, 'FUNCIONARIO');
	$objPHPExcel->getActiveSheet()->getColumnDimension($LetraColumna)->setWidth(40);
}

if($VerFechaHoraRadica === 'true'){
	$LetraColumna = chr($Letras++);
	$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue($LetraColumna.$Fila, 'FEC. RADICADO');
	$objPHPExcel->getActiveSheet()->getColumnDimension($LetraColumna)->setWidth(19);
}

if($VerFechaDocumento === 'true'){
	$LetraColumna = chr($Letras++);
	$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue($LetraColumna.$Fila, 'FEC. DOCUMENTO');
	$objPHPExcel->getActiveSheet()->getColumnDimension($LetraColumna)->setWidth(17);
}

if($VerFechaVencimiento === 'true'){
	$LetraColumna = chr($Letras++);
	$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue($LetraColumna.$Fila, 'FEC. VENCIMIENTO');
	$objPHPExcel->getActiveSheet()->getColumnDimension($LetraColumna)->setWidth(18);
}

if($VerAsunto === 'true'){
	$LetraColumna = chr($Letras++);
	$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue($LetraColumna.$Fila, 'ASUNTO');
	$objPHPExcel->getActiveSheet()->getColumnDimension($LetraColumna)->setWidth(60);
}

if($VerDependencia === 'true'){
	$LetraColumna = chr($Letras++);
	$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue($LetraColumna.$Fila, 'DEPENDENCIA');
	$objPHPExcel->getActiveSheet()->getColumnDimension($LetraColumna)->setWidth(30);
}

if($VerOficina === 'true'){
	$LetraColumna = chr($Letras++);
	$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue($LetraColumna.$Fila, 'OFICINA');
	$objPHPExcel->getActiveSheet()->getColumnDimension($LetraColumna)->setWidth(40);
}

if($VerSerie === 'true'){
	$LetraColumna = chr($Letras++);
	$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue($LetraColumna.$Fila, 'SERIE');
	$objPHPExcel->getActiveSheet()->getColumnDimension($LetraColumna)->setWidth(60);
}

if($VerSubSerie === 'true'){
	$LetraColumna = chr($Letras++);
	$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue($LetraColumna.$Fila, 'SUBSERIE');
	$objPHPExcel->getActiveSheet()->getColumnDimension($LetraColumna)->setWidth(60);
}

if($VerTipoDocumento === 'true'){
	$LetraColumna = chr($Letras++);
	$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue($LetraColumna.$Fila, 'TIPO DOCUMENTAL');
	$objPHPExcel->getActiveSheet()->getColumnDimension($LetraColumna)->setWidth(60);
}

if($VerRadicadoRespuesta === 'true'){
	$LetraColumna = chr($Letras++);
	$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue($LetraColumna.$Fila, 'RESPUESTA');
	$objPHPExcel->getActiveSheet()->getColumnDimension($LetraColumna)->setWidth(18);
}

if($VerAsuntoRespuesta === 'true'){
	$LetraColumna = chr($Letras++);
	$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue($LetraColumna.$Fila, 'FEC. HORA');
	$objPHPExcel->getActiveSheet()->getColumnDimension($LetraColumna)->setWidth(18);
}

if($VerFecHorRespuesta === 'true'){
	$LetraColumna = chr($Letras++);
	$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue($LetraColumna.$Fila, 'ASUNTO');
	$objPHPExcel->getActiveSheet()->getColumnDimension($LetraColumna)->setWidth(60);
}

// Combino las celdas desde A1 hasta E1
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:G1');	
$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A1', $MiEmpresa->get_RazonSocial());
$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("A1")->getFont()->setBold(true); 

$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:G2');
$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A2', 'Ventanilla -> Flujo Documental por Dependencia.');
$objPHPExcel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("A2")->getFont()->setBold(true); 

$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A4:G4');
$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A7', ">> Reporte generado desde la fecha ".Fecha_Larga_Español($FecDesde)." hasta el día ".Fecha_Larga_Español($FecDesde));
$objPHPExcel->getActiveSheet()->getStyle("A4")->getFont()->setBold(true); 

// Fuente de la primera fila en negrita
$boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

$objPHPExcel->getActiveSheet()->getStyle('A'.$Fila.':'.$LetraColumna.$Fila)->applyFromArray($boldArray);		


$Fila = 9;
$Celda = "";

$Regis = ReportRadicacionRecibido::Listar_Detallado($FecDesde, $FecHasta, $IdTercero, $TipoTercer, $IdFuncionario, $IdDepen, $IdSerie, $IdSubSerie, $IdTipoDoc);
foreach($Regis as $Item):

	$Fila++;
	$Letra = 65;
	
	if($VerRadicado === 'true'){
		$Celda = chr($Letra++).$Fila;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($Celda, $Item['id_radica']);
	}

	if($VerTercero === 'true'){
		$Celda = chr($Letra++).$Fila;
		$Tercero = "";
		if($Item['razo_soci'] === ""){
			$Tercero = $Item['nom_contac'];
		}else{
			$Tercero = $Item['razo_soci']."\nContac: ".$Item['nom_contac'];
		}

		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($Celda , $Tercero);
		$objPHPExcel->getActiveSheet()->getStyle($Celda)->getAlignment()->setWrapText(true);
	}

	if($VerFuncionario === 'true'){
		$Celda = chr($Letra++).$Fila;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($Celda, $Item['nom_funcio']." ".$Item['ape_funcio']);
		$objPHPExcel->getActiveSheet()->getStyle($Celda)->getAlignment()->setWrapText(true);
	}

	if($VerFechaHoraRadica === 'true'){
		$Celda = chr($Letra++).$Fila;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($Celda, $Item['fechor_radica']);
	}

	if($VerFechaDocumento === 'true'){
		$Celda = chr($Letra++).$Fila;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($Celda, $Item['fec_docu']);
	}

	if($VerFechaVencimiento === 'true'){
		$Celda = chr($Letra++).$Fila;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($Celda, $Item['fec_venci']);
	}

	if($VerAsunto === 'true'){
		$Celda = chr($Letra++).$Fila;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($Celda, $Item['asunto']);
		$objPHPExcel->getActiveSheet()->getStyle($Celda)->getAlignment()->setWrapText(true);
	}

	if($VerDependencia === 'true'){
		$Celda = chr($Letra++).$Fila;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($Celda, $Item['nom_depen']);
		$objPHPExcel->getActiveSheet()->getStyle($Celda)->getAlignment()->setWrapText(true);
	}

	if($VerOficina === 'true'){
		$Celda = chr($Letra++).$Fila;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($Celda, $Item['nom_oficina']);
		$objPHPExcel->getActiveSheet()->getStyle($Celda)->getAlignment()->setWrapText(true);
	}

	if($VerSerie === 'true'){
		$Celda = chr($Letra++).$Fila;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($Celda, $Item['cod_serie'].".".$Item['nom_serie']);
		$objPHPExcel->getActiveSheet()->getStyle($Celda)->getAlignment()->setWrapText(true);
	}

	if($VerSubSerie === 'true'){
		$Celda = chr($Letra++).$Fila;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($Celda, $Item['cod_subserie'].".".$Item['nom_subserie']);
		$objPHPExcel->getActiveSheet()->getStyle($Celda)->getAlignment()->setWrapText(true);
	}

	if($VerTipoDocumento === 'true'){
		$Celda = chr($Letra++).$Fila;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($Celda, $Item['nom_tipodoc']);
		$objPHPExcel->getActiveSheet()->getStyle($Celda)->getAlignment()->setWrapText(true);
	}

	if($VerRadicadoRespuesta === 'true'){
		$Celda = chr($Letra++).$Fila;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($Celda, $Item['radica_respuesta']);
	}

	if($VerFecHorRespuesta === 'true'){
		$Celda = chr($Letra++).$Fila;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($Celda, $Item['fechor_radica_respuesta']);
	}

	if($VerAsuntoRespuesta === 'true'){
		$Celda = chr($Letra++).$Fila;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($Celda, $Item['asunto_respuesta']);
		$objPHPExcel->getActiveSheet()->getStyle($Celda)->getAlignment()->setWrapText(true);
	}
endforeach;

if($Celda === ""){
	echo 'Iwana no encontró registros con los criterios de búsqueda especificados';
    exit();
}
$rango="A9:".$Celda;

$styleArray = array('font' => array( 'name' => 'Arial','size' => 10),
	'borders'=>array('allborders'=>array('style'=> PHPExcel_Style_Border::BORDER_THIN,'color'=>array('argb' => 'FFF')))
);
$objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($styleArray);

		// Cambiar el nombre de hoja de cálculo
$objPHPExcel->getActiveSheet()->setTitle('Total de comunicaciones');

		// Establecer índice de hoja activa a la primera hoja , por lo que Excel abre esto como la primera hoja
$objPHPExcel->setActiveSheetIndex(0);

$objDrawing = new PHPExcel_Worksheet_Drawing();
                    $objDrawing->setName('imgNotice');
                    $objDrawing->setDescription('Noticia');
                    $img = '../../../../archivos/otros/'.$MiEmpresa->get_Logo(); // Provide path to your logo file
                    $objDrawing->setPath($img);
                    $objDrawing->setOffsetX(28);    // setOffsetX works properly
                    $objDrawing->setOffsetY(50);  //setOffsetY has no effect
                    $objDrawing->setCoordinates('A1');
                    $objDrawing->setHeight(80); // logo height
                    $objDrawing->setWorksheet($objPHPExcel->setActiveSheetIndex(0));


$objDrawing = new PHPExcel_Worksheet_Drawing();
                    $objDrawing->setName('imgNotice');
                    $objDrawing->setDescription('Logo Iwana.');
                    $img = '../../../../public/assets/img/logoFirma.png'; // Provide path to your logo file
                    $objDrawing->setPath($img);
                    $objDrawing->setOffsetX(28); // setOffsetX works properly
                    $objDrawing->setOffsetY(300);  //setOffsetY has no effect
                    $objDrawing->setCoordinates('A5');
                    $objDrawing->setHeight(30); // logo height
                    $objDrawing->setWorksheet($objPHPExcel->setActiveSheetIndex(0));

/*
// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Flujo Documental por Dependencia.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0
*/
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
ob_start();
$objWriter->save("php://output");
$xlsData = ob_get_contents();
ob_end_clean();

$response =  array(
        'op' => 'ok',
        'file' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData)
    );

die(json_encode($response));
?>