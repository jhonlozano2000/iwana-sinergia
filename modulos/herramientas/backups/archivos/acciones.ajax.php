<?php
require_once "../../../../config/class.Conexion.php";
require_once "../../../../config/funciones.php";
require_once "../../../../config/variable.php";
include "../../../../codigos/tutoriales-php-master/06EnvioCorreo/class.phpmailer.php";
include "../../../../codigos/tutoriales-php-master/06EnvioCorreo/class.smtp.php";
session_start();
set_time_limit(0);

$RepositorioTemp      = isset($_POST['ChkTemp']) ? 1 : 0;
$RepositorioDigitales = isset($_POST['ChkDigita']) ? 1 : 0;
$FechaIni             = isset($_POST['desde']) ? $_POST['desde'] : null;
$FechaFin             = isset($_POST['hasta']) ? $_POST['hasta'] : null;

if($RepositorioTemp == 1){
	Repositorio_Temporales($FechaIni, $FechaFin);
}

if($RepositorioDigitales == 1){
	Repositorio_Digitales($FechaIni, $FechaFin);
}

if(count($_POST['ChkGestion']) > 0){
	Repositorio_Archivo_Gestion($FechaIni, $FechaFin);
}

echo "El Backup's se genero correctamente.";

Enviar_Email();


function Repositorio_Temporales($FechaIni, $FechaFin){
	
	require_once "../../../clases/radicar/class.RadicaRecibido.php";

	if(!is_dir(MI_ROOT_TEMP_RELATIVA."/backups/"))
		mkdir(MI_ROOT_TEMP_RELATIVA."/backups/", 0777);

	if(!is_dir(MI_ROOT_TEMP_RELATIVA."/backups/correspondencia_recibida"))
		mkdir(MI_ROOT_TEMP_RELATIVA."/backups/correspondencia_recibida", 0777);
	
	require_once '../../../../config/lib/PHPExcel-1.8/Classes/PHPExcel.php';

	#########################################################################################################
	// Crear nuevo objeto PHPExcel
	$objPHPExcel = new PHPExcel();
	 
	// Propiedades del documento
	$objPHPExcel->getProperties()->setCreator("Obed Alvarado")
								 ->setLastModifiedBy("Obed Alvarado")
								 ->setTitle("Office 2010 XLSX Documento de prueba")
								 ->setSubject("Office 2010 XLSX Documento de prueba")
								 ->setDescription("Documento de prueba para Office 2010 XLSX, generado usando clases de PHP.")
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

		// Creamos un instancia de la clase ZipArchive
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
                
                $Fila++;
				$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$Fila, $Item['id_radica'])
				->setCellValue('B'.$Fila, $Item['fec_docu'])
				->setCellValue('C'.$Fila, $Item['fec_venci'])
				->setCellValue('D'.$Fila, $Item['asunto'])
				->setCellValue('E'.$Fila, $Item['nom_funcio']." ".$Item['ape_funcio'])
				->setCellValue('F'.$Fila, $Tercero);

				
			}

		endforeach;
		 // Una vez añadido los archivos deseados cerramos el zip.
		$zip->close();

		/*Fin extracion de datos MYSQL*/
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
		
	}
}

function Repositorio_Archivo_Gestion($FechaIni, $FechaFin){

	require_once "../../../clases/radicar/class.RadicaEnviado.php";

	if(!is_dir(MI_ROOT_TEMP_RELATIVA."/backups/"))
		mkdir(MI_ROOT_TEMP_RELATIVA."/backups/", 0777);

	if(!is_dir(MI_ROOT_TEMP_RELATIVA."/backups/correspondencia_enviada"))
		mkdir(MI_ROOT_TEMP_RELATIVA."/backups/correspondencia_enviada", 0777);

	// Creamos un instancia de la clase ZipArchive
	$zip = new ZipArchive();
	// Creamos y abrimos un archivo zip temporal
	$zip->open(MI_ROOT_TEMP_RELATIVA."/backups/correspondencia_enviada.zip", ZipArchive::CREATE);
	// Añadimos un directorio
	$dir = "correspondencia_enviada";
	$zip->addEmptyDir($dir);

	require_once '../../../clases/areas/class.AreasDependencia.php';

	//CARGO LOS ARCHIVOS DIGITALES AL SERVIDOR DE ARCHIVO TEMPORAL
	require_once '../../../clases/configuracion/class.ConfigServidor_Gestion.php';

	require_once '../../../clases/varias/class.ftp.php';
	$ftpObj = new FTPClient(); 

	$RespositorioGestion = $_POST['ChkGestion'];
	for($i=0;$i<count($RespositorioGestion); $i++){
		
		$Servidor = ServidorGestion::Buscar(2, $RespositorioGestion[$i], "", "");
		$Ip       = $Servidor->get_Ip();
		$Usuario  = $Servidor->get_Usua();
		$Contra   = $Servidor->get_Contra();
		$RutaFtp  = $Servidor->get_Ruta();
		$IdDepen  = $Servidor->get_IdDepen();
		
		$Dependencia = Dependencia::Buscar(2, $IdDepen, "", "", "");
		
		$NombreDependencia = utf8_decode($Dependencia->getNom_Dependencia());

		//AGREGO LA CARPETA DE LA DEPENDENCIA EL ARCHIVO COMPRIMIDO
		if(!is_dir(MI_ROOT_TEMP_RELATIVA."/backups/correspondencia_enviada/".$NombreDependencia))
			mkdir(MI_ROOT_TEMP_RELATIVA."/backups/correspondencia_enviada/".$NombreDependencia, 0777);

		// Añadimos un directorio
		$dir = "correspondencia_enviada";
		$zip->addEmptyDir($dir."/".$NombreDependencia);

		$ftpObj->connect($Ip, $Usuario, $Contra); 

		if($ftpObj->pr($ftpObj->getMessages()[0]) == true){
			$Radicados = RadicadoEnviado::Listar(9, "", "", "", "", "", Convertir_Fecha_A_Mysql($FechaIni), Convertir_Fecha_A_Mysql($FechaFin), $RespositorioGestion[$i]);
			
			foreach($Radicados as $Item):
			
				$Archivo = "";
				if($RutaFtp != ""){
					$Archivo = $RutaFtp."/".$Item['id_radica'].".pdf";
				}else{
					$Archivo = $Item['id_radica'].".pdf";
				}

				$ftpObj->downloadFile(MI_ROOT_TEMP_RELATIVA."/backups/correspondencia_enviada/".$NombreDependencia."/".$Item['id_radica'].".pdf", $Archivo); 
				
				if($ftpObj->pr($ftpObj->getMessages()[0]) == true){

					//Añadimos un archivo dentro del directorio que hemos creado
					$zip->addFile(MI_ROOT_TEMP_RELATIVA."/backups/correspondencia_enviada/".$NombreDependencia."/".$Item['id_radica'].".pdf", $dir."/".$NombreDependencia."/".$Item['id_radica'].".pdf");
				}

			endforeach;
		}
	}
	
}

function Repositorio_Digitales($FechaIni, $FechaFin){
	
	require_once "../../../clases/oficina_archivo/class.OficinaArchivoDigitalizacion.php";

	if(!is_dir(MI_ROOT_TEMP_RELATIVA."/backups/"))
		mkdir(MI_ROOT_TEMP_RELATIVA."/backups/", 0777);

	if(!is_dir(MI_ROOT_TEMP_RELATIVA."/backups/digitales"))
		mkdir(MI_ROOT_TEMP_RELATIVA."/backups/digitales", 0777);


	//CARGO LOS ARCHIVOS DIGITALES AL SERVIDOR DE ARCHIVO TEMPORAL
	require_once '../../../clases/configuracion/class.ConfigServidor_Digitalizacion.php';

	require_once '../../../clases/varias/class.ftp.php';
	$ftpObj = new FTPClient(); 

	// Creamos un instancia de la clase ZipArchive
	$zip = new ZipArchive();
	// Creamos y abrimos un archivo zip temporal
	$zip->open(MI_ROOT_TEMP_RELATIVA."/backups/digitales.zip", ZipArchive::CREATE);
	// Añadimos un directorio
	$dir = "digitales";
	$zip->addEmptyDir($dir);

	$Digitales = Digitalizacion::Listar(4, "", "", "", "", "",  "", Convertir_Fecha_A_Mysql($FechaIni), Convertir_Fecha_A_Mysql($FechaFin), "");
	foreach($Digitales as $Item):

		$Servidor = ServidorDigitalizacion::Buscar(2, $Item['id_ruta'], "");
		$Ip       = $Servidor->get_Ip();
		$Usuario  = $Servidor->get_Usua();
		$Contra   = $Servidor->get_Contra();
		$RutaFtp  = $Servidor->get_Ruta();

		$ftpObj->connect($Ip, $Usuario, $Contra); 

		if($ftpObj->pr($ftpObj->getMessages()[0]) == true){

			$info = new SplFileInfo($Item['archivo']);
			$Extencion = $info->getExtension();

			$Expediente = $Item['id_digital']." - ".$Item['codigo']." - ".$Item['titulo'];
			$zip->addEmptyDir($dir."/".$Expediente);

			if(!is_dir(MI_ROOT_TEMP_RELATIVA."/backups/digitales/".$Expediente))
				mkdir(MI_ROOT_TEMP_RELATIVA."/backups/digitales/".$Expediente, 0777);

			$ftpObj->downloadFile(MI_ROOT_TEMP_RELATIVA."/backups/digitales/".$Expediente."/".$Item['archivo'], $RutaFtp."/".$Item['id_digital']."/".$Item['archivo']); 
			
			if($ftpObj->pr($ftpObj->getMessages()[0]) == true){

				//Añadimos un archivo dentro del directorio que hemos creado
				$zip->addFile(MI_ROOT_TEMP_RELATIVA."/backups/digitales/".$Expediente."/".$Item['archivo'], $dir."/".$Expediente."/".$Item['id_radica'].".pdf");
			}
		}

		endforeach;
		 // Una vez añadido los archivos deseados cerramos el zip.
		$zip->close();
	
}

function Enviar_Email(){
	$email_user = "soporte@innovaj2la.com";
$email_password = "f38/mlk1pD";
$the_subject = "Backups Iwana";
$address_to = "jhonlozano2000@gmail.com";
$from_name = "Backup's Iwana Fec. ".$_POST['FechaDesde'];
$phpmailer = new PHPMailer();
// ---------- datos de la cuenta de Gmail -------------------------------
$phpmailer->Username = $email_user;
$phpmailer->Password = $email_password; 
//-----------------------------------------------------------------------
$phpmailer->SMTPDebug = 1;
$phpmailer->SMTPSecure = 'STARTTLS';
$phpmailer->Host = "mail.c0910045.ferozo.com"; // GMail
// En la dirección de responder ponemos la misma del From
$phpmailer->Port = 25;
$phpmailer->IsSMTP(); // use SMTP
$phpmailer->SMTPAuth = true;
$phpmailer->setFrom($phpmailer->Username,$from_name);
$phpmailer->AddReplyTo("soporte@innovaj2la.com","Prueba Backups Iwana");
$phpmailer->AddCC("soporte@innovaj2la.com","Prueba Backups Iwana");
$phpmailer->AddAddress($address_to); // recipients email
$phpmailer->Subject = $the_subject;	
$phpmailer->Body .="<h1 style='color:#3498db;'>Backup's Iwana.</h1>";
$phpmailer->Body .= "<p>Se genero un Backup's de la fecha ".$_POST['FechaDesde']." con los archivos digitales y la relación de los radicados generados</p>";
//$phpmailer->Body .= "<p>Fecha y Hora: ".date("d-m-Y h:i:s")."</p>";

//asigno un archivo adjunto al mensaje
if(isset($_POST['RepositorioTemp'])){
	$phpmailer->AddAttachment("../../../archivos/temp/backups/Correspondencia Recibida.xls");
	$phpmailer->AddAttachment("../../../archivos/temp/backups/correspondencia_recibida.zip");
}

if(isset($_POST['RepositorioGestion'])){
	$phpmailer->AddAttachment("../../../archivos/temp/backups/correspondencia_enviada.zip");
}

$phpmailer->IsHTML(true);
//$phpmailer->Send();
if(!$phpmailer->Send()) {
	echo "Error: " . $phpmailer->ErrorInfo;
}else{
	echo 1;
	exit();
}
}
?>