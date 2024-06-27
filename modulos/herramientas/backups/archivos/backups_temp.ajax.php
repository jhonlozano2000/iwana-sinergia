<?php
require_once "../../../../config/class.Conexion.php";
require_once "../../../../config/funciones.php";
require_once "../../../../config/variable.php";
require_once "../../../clases/radicar/class.RadicaRecibido.php";
session_start();
set_time_limit(0);

$FechaIni = isset($_POST['desde']) ? $_POST['desde'] : null;
$FechaFin = isset($_POST['hasta']) ? $_POST['hasta'] : null;

$Radicados = RadicadoRecibido::Listar_Vario(9, "", "", "", "", "", Convertir_Fecha_A_Mysql($FechaIni), Convertir_Fecha_A_Mysql($FechaFin), "");

if($Radicados = 0){
	echo "No se encontraron archivo disponibles para la generación de backup's.";
	exit();
}else{

	if(!is_dir(MI_ROOT_TEMP_RELATIVA."/backups/"))
		mkdir(MI_ROOT_TEMP_RELATIVA."/backups/", 0777);

	if(!is_dir(MI_ROOT_TEMP_RELATIVA."/backups/correspondencia_recibida"))
		mkdir(MI_ROOT_TEMP_RELATIVA."/backups/correspondencia_recibida", 0777);

	require_once '../../../../config/lib/PHPExcel-1.8/Classes/PHPExcel.php';
	/*
	#########################################################################################################
	## Crear nuevo objeto PHPExcel
	##########################################################################################################
	$objPHPExcel = new PHPExcel();

	// Propiedades del documento
	$objPHPExcel->getProperties()->setCreator("Iwana")
	->setLastModifiedBy("Iwana")
	->setTitle("Office 2010 XLSX Documento de Backups Iwana")
	->setSubject("Office 2010 XLSX Documento de Backups Iwana")
	->setDescription("Documento de Backups para Office 2010 XLSX, generado usando Iwana.")
	->setKeywords("office 2010 openxml php")
	->setCategory("Backups");

	// Combino las celdas desde A1 hasta E1
	$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:F1');
	$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A1', 'RELACIÓN DE CORRESPONDENCIA RECIBIDA');
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle("A1")->getFont()->setBold(true); 

	$Fila = 5;
	$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A'.$Fila, 'RADICADO')
	->setCellValue('B'.$Fila, 'FEC. FOCUMENTO')
	->setCellValue('C'.$Fila, 'FEC. VENCIMIENTO')
	->setCellValue('D'.$Fila, 'ASUNTO')
	->setCellValue('E'.$Fila, 'RESPONSABLE')
	->setCellValue('F'.$Fila, 'TERCERO');

	// Fuente de la primera fila en negrita
	$boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

	$objPHPExcel->getActiveSheet()->getStyle('A'.$Fila.':F'.$Fila)->applyFromArray($boldArray);

	//Ancho de las columnas
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(16);	
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(16);	
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(70);	
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(36);
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(50);
*/
	//CARGO LOS ARCHIVOS DIGITALES AL SERVIDOR DE ARCHIVO TEMPORAL
	require_once '../../../clases/configuracion/class.ConfigServidor_Temp.php';

	$Servidor = ServidorTemp::Buscar(3, "", "");
	$Ip       = $Servidor->get_Ip();
	$Usuario  = $Servidor->get_Usua();
	$Contra   = $Servidor->get_Contra();
	$RutaFtp  = $Servidor->get_Ruta();

	require_once '../../../clases/varias/class.ftp.php';
	$ftpObj = new FTPClient(); 

	$ftpObj->connect($Ip, $Usuario, $Contra); 

	if($ftpObj->pr($ftpObj->getMessages()[0]) == true){

		#########################################################################################################
		### Creamos un instancia de la clase ZipArchive
		##########################################################################################################
		$zip = new ZipArchive();
		// Creamos y abrimos un archivo zip temporal
		$zip->open(MI_ROOT_TEMP_RELATIVA."/backups/correspondencia_recibida.zip", ZipArchive::CREATE);
		// Añadimos un directorio
		$dir = "correspondencia_recibida";
		$zip->addEmptyDir($dir);

		$Radicados = RadicadoRecibido::Listar_Vario(9, "", "", "", "", "", Convertir_Fecha_A_Mysql($FechaIni), Convertir_Fecha_A_Mysql($FechaFin), "");
		foreach($Radicados as $Item):

			$Archivo = "";
			if($RutaFtp != ""){
				$Archivo = $RutaFtp."/".$Item['id_radica'].".pdf";
			}else{
				$Archivo = $Item['id_radica'].".pdf";
			}

			$ftpObj->downloadFile(MI_ROOT_TEMP_RELATIVA."/backups/correspondencia_recibida/".$Item['id_radica'].".pdf", $Archivo); 

			if($ftpObj->pr($ftpObj->getMessages()[0]) == true){

				//Añadimos un archivo dentro del directorio que hemos creado
				$zip->addFile(MI_ROOT_TEMP_RELATIVA."/backups/correspondencia_recibida/".$Item['id_radica'].".pdf", $dir."/".$Item['id_radica'].".pdf");

				//AÑADOMOS EL REGISTRO AL ARCHIVO DE EXCEL
				$Tercero = "";
				if($Item['razo_soci'] != ""){
					$Tercero = 'Enti.: '.$Item['razo_soci']."<w:br />Contac.: ".$Item['nom_contac'];
				}else{
					$Tercero = $Item['nom_contac'];
				}
/*
				$Fila++;
				
				$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$Fila, $Item['id_radica'])
				->setCellValue('B'.$Fila, $Item['fec_docu'])
				->setCellValue('C'.$Fila, $Item['fec_venci'])
				->setCellValue('D'.$Fila, $Item['asunto'])
				->setCellValue('E'.$Fila, $Item['nom_funcio']." ".$Item['ape_funcio'])
				->setCellValue('F'.$Fila, $Tercero);
				*/
			}

		endforeach;

		// Una vez añadido los archivos deseados cerramos el zip.
		$zip->close();

		/*Fin extracion de datos MYSQL*/
		/*
		$rango="A5:F".$Fila;
		$styleArray = array('font' => array( 'name' => 'Arial','size' => 10),
			'borders'=>array('allborders'=>array('style'=> PHPExcel_Style_Border::BORDER_THIN,'color'=>array('argb' => 'FFF')))
		);
		$objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($styleArray);

		// Cambiar el nombre de hoja de cálculo
		$objPHPExcel->getActiveSheet()->setTitle('Correspondencia Recibida');

		// Establecer índice de hoja activa a la primera hoja , por lo que Excel abre esto como la primera hoja
		$objPHPExcel->setActiveSheetIndex(0);

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save(MI_ROOT_TEMP_RELATIVA."/backups/Correspondencia Recibida.xls");
		*/
	}

	echo 1;
	exit();
}
?>