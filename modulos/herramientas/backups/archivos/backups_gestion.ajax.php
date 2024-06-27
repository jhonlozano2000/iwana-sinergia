<?php
require_once "../../../../config/class.Conexion.php";
require_once "../../../../config/funciones.php";
require_once "../../../../config/variable.php";
require_once "../../../clases/radicar/class.RadicaEnviado.php";
session_start();
set_time_limit(0);

$FechaIni = isset($_POST['desde']) ? $_POST['desde'] : null;
$FechaFin = isset($_POST['hasta']) ? $_POST['hasta'] : null;

require_once "../../../clases/radicar/class.RadicaEnviado.php";
$Radicados = RadicadoEnviado::Listar_Varios(9, "", "", "", "", "", Convertir_Fecha_A_Mysql($FechaIni), Convertir_Fecha_A_Mysql($FechaFin), "");
if($Radicados = 0){
	echo "No se encontraron archivo disponibles para la generación de backup's.";
	exit();
}else{
	
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

		$NombreDependencia = $Dependencia->getNom_Dependencia();

		//AGREGO LA CARPETA DE LA DEPENDENCIA EL ARCHIVO COMPRIMIDO
		if(!is_dir(MI_ROOT_TEMP_RELATIVA."/backups/correspondencia_enviada/".$NombreDependencia))
			mkdir(MI_ROOT_TEMP_RELATIVA."/backups/correspondencia_enviada/".$NombreDependencia, 0777);

		// Añadimos un directorio
		$dir = "correspondencia_enviada";
		$zip->addEmptyDir($dir."/".$NombreDependencia);

		$ftpObj->connect($Ip, $Usuario, $Contra); 

		if($ftpObj->pr($ftpObj->getMessages()[0]) == true){
			
			$Radicados = RadicadoEnviado::Listar_Varios(9, "", "", "", "", "", Convertir_Fecha_A_Mysql($FechaIni), Convertir_Fecha_A_Mysql($FechaFin), $RespositorioGestion[$i]);

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

	echo 1;
	exit();
}
?>