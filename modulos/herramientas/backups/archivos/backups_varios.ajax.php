<?php
require_once "../../../../config/class.Conexion.php";
require_once "../../../../config/funciones.php";
require_once "../../../../config/variable.php";


//$segundos = 5;
//header("Refresh:".$segundos);
session_start();
set_time_limit(0);

$FechaIni = '06/01/2018';
$FechaFin = '06/30/2018';

echo "Inicia Backups de la correspondencia enviada<br>";
/******************************************************************************************/
/*  BACKUSP CORRESPONDENCIA ENVIADA
/******************************************************************************************/
$MesBackups = "correspondencia_enviada_06";

if(!is_dir(MI_ROOT_TEMP_RELATIVA."/backups/"))
	mkdir(MI_ROOT_TEMP_RELATIVA."/backups/", 0777);

if(!is_dir(MI_ROOT_TEMP_RELATIVA."/backups/".$MesBackups))
	mkdir(MI_ROOT_TEMP_RELATIVA."/backups/".$MesBackups, 0777);

// Creamos un instancia de la clase ZipArchive
$zip = new ZipArchive();
// Creamos y abrimos un archivo zip temporal
$zip->open(MI_ROOT_TEMP_RELATIVA."/backups/".$MesBackups.".zip", ZipArchive::CREATE);
// Añadimos un directorio
$dir = $MesBackups;
$zip->addEmptyDir($dir);

//CARGO LOS ARCHIVOS DIGITALES AL SERVIDOR DE ARCHIVO TEMPORAL
require_once '../../../clases/configuracion/class.ConfigServidor_Gestion.php';

require_once '../../../clases/varias/class.ftp.php';
$ftpObj = new FTPClient(); 

require_once "../../../clases/radicar/class.RadicaEnviado.php";
$Radicados = RadicadoEnviado::Listar_Varios(6, "", "", "", "", "", Convertir_Fecha_A_Mysql($FechaIni)." 00:00:38", Convertir_Fecha_A_Mysql($FechaFin)." 23:08:38", "");

foreach ($Radicados as $Item){

	if($Item['id_ruta'] != ""){
		$Servidor = ServidorGestion::Buscar(2, $Item['id_ruta'], "", "");

		$Ip       = $Servidor->get_Ip();
		$Usuario  = $Servidor->get_Usua();
		$Contra   = $Servidor->get_Contra();
		$RutaFtp  = $Servidor->get_Ruta();
		$IdDepen  = $Servidor->get_IdDepen();

		$NombreDependencia = $Item['nom_depen'];

		//AGREGO LA CARPETA DE LA DEPENDENCIA EL ARCHIVO COMPRIMIDO
		if(!is_dir(MI_ROOT_TEMP_RELATIVA."/backups/".$MesBackups."/".$NombreDependencia))
			mkdir(MI_ROOT_TEMP_RELATIVA."/backups/".$MesBackups."/".$NombreDependencia, 0777);

		// Añadimos un directorio
		$dir = $MesBackups;
		$zip->addEmptyDir($dir."/".$NombreDependencia);

		$ftpObj->connect($Ip, $Usuario, $Contra); 

		if($ftpObj->pr($ftpObj->getMessages()[0]) == true){

			$Archivo = "";
			if($RutaFtp != ""){
				$Archivo = $RutaFtp."/".$Item['id_radica'].".pdf";
			}else{
				$Archivo = $Item['id_radica'].".pdf";
			}

			$ftpObj->downloadFile(MI_ROOT_TEMP_RELATIVA."/backups/".$MesBackups."/".$NombreDependencia."/".$Item['id_radica'].".pdf", $Archivo); 

			if($ftpObj->pr($ftpObj->getMessages()[0]) == true){

				//Añadimos un archivo dentro del directorio que hemos creado
				$zip->addFile(MI_ROOT_TEMP_RELATIVA."/backups/".$MesBackups."/".$NombreDependencia."/".$Item['id_radica'].".pdf", $dir."/".$NombreDependencia."/".$Item['id_radica'].".pdf");
				
			}
		}
	}
}

echo "Inicia Backups de la correspondencia rebida<br>";

/******************************************************************************************/
/*  BACKUSP CORRESPONDENCIA RECIBIDA
/******************************************************************************************/
$MesBackups = "correspondencia_recibida_06";

if(!is_dir(MI_ROOT_TEMP_RELATIVA."/backups/"))
	mkdir(MI_ROOT_TEMP_RELATIVA."/backups/", 0777);

if(!is_dir(MI_ROOT_TEMP_RELATIVA."/backups/".$MesBackups))
	mkdir(MI_ROOT_TEMP_RELATIVA."/backups/".$MesBackups, 0777);

// Creamos un instancia de la clase ZipArchive
$zip = new ZipArchive();
// Creamos y abrimos un archivo zip temporal
$zip->open(MI_ROOT_TEMP_RELATIVA."/backups/".$MesBackups.".zip", ZipArchive::CREATE);
// Añadimos un directorio
$dir = $MesBackups;
$zip->addEmptyDir($dir);

//CARGO LOS ARCHIVOS DIGITALES AL SERVIDOR DE ARCHIVO TEMPORAL
require_once '../../../clases/configuracion/class.ConfigServidor_Temp.php';

require_once '../../../clases/varias/class.ftp.php';
$ftpObj = new FTPClient(); 

require_once "../../../clases/radicar/class.RadicaRecibido.php";
$Radicados = RadicadoRecibido::Listar_Vario(6, "", "", "", "", "", Convertir_Fecha_A_Mysql($FechaIni)." 00:00:38", Convertir_Fecha_A_Mysql($FechaFin)." 23:08:38", "");
foreach ($Radicados as $Item){

	if($Item['id_ruta'] == 1){
		$Servidor = ServidorTemp::Buscar(2, $Item['id_ruta'], "", "");

		$Ip       = $Servidor->get_Ip();
		$Usuario  = $Servidor->get_Usua();
		$Contra   = $Servidor->get_Contra();
		$RutaFtp  = $Servidor->get_Ruta();
		
		//AGREGO LA CARPETA DE LA DEPENDENCIA EL ARCHIVO COMPRIMIDO
		if(!is_dir(MI_ROOT_TEMP_RELATIVA."/backups/".$MesBackups))
			mkdir(MI_ROOT_TEMP_RELATIVA."/backups/".$MesBackups, 0777);

		// Añadimos un directorio
		$dir = $MesBackups;
		$zip->addEmptyDir($dir);

		$ftpObj->connect($Ip, $Usuario, $Contra); 

		if($ftpObj->pr($ftpObj->getMessages()[0]) == true){

			$Archivo = "";
			if($RutaFtp != ""){
				$Archivo = $RutaFtp."/".$Item['id_radica'].".pdf";
			}else{
				$Archivo = $Item['id_radica'].".pdf";
			}

			$ftpObj->downloadFile(MI_ROOT_TEMP_RELATIVA."/backups/".$MesBackups."/".$Item['id_radica'].".pdf", $Archivo); 

			if($ftpObj->pr($ftpObj->getMessages()[0]) == true){

				//Añadimos un archivo dentro del directorio que hemos creado
				$zip->addFile(MI_ROOT_TEMP_RELATIVA."/backups/".$MesBackups."/".$Item['id_radica'].".pdf", $dir."/".$Item['id_radica'].".pdf");
			}
		}
	}
}

echo 1;
exit();

?>