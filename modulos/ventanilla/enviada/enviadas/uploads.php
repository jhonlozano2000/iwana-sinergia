<?php
include("../../../../config/variable.php");
include("../../../../config/funciones.php");
include("../../../../config/funciones_seguridad.php");
session_start();

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){

	$IdFuncio = $_SESSION['SesionUsuaId'];
	$Ruta = MI_ROOT_TEMP_RELATIVA."/temp_ventanilla/enviados/";

	if(!is_dir($Ruta))
		mkdir($Ruta, 0777);

	if(!is_dir($Ruta.$IdFuncio))
		mkdir($Ruta.$IdFuncio, 0777);

	if(isset($_GET["delete"]) && $_GET["delete"] == true){
		$name = $_POST["filename"];
		
		if(file_exists($Ruta.$IdFuncio."/".$name)){
			
			unlink($Ruta.$IdFuncio."/".$name);
			
			$Archivo -> set_Accion('ELIMINAR_ARCHIVO');
			$Archivo -> set_IdFuncio($IdFuncio);
			$Archivo -> set_Archivo($name);
			$Archivo -> Gestionar();

			echo json_encode(array("res" => true));
		}else{
			echo json_encode(array("res" => false));
		}
	}else{
		$file     = $_FILES["file"]["name"];
		$filetype = $_FILES["file"]["type"];
		$filesize = $_FILES["file"]["size"];

		if($file && move_uploaded_file($_FILES["file"]["tmp_name"], $Ruta.$IdFuncio."/".$file)){
			$Archivo = new GestionAdjunto();
			$Archivo -> set_Accion('INSERTAR');
			$Archivo -> set_IdFuncio($_GET["IdFuncio"]);
			$Archivo -> set_Archivo($file);
			$Archivo -> Gestionar();
		}
	}
}
?>