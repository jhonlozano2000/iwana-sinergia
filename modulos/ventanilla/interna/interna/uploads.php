<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	session_start();
	include("../../../../config/variable.php");
	include("../../../../config/funciones.php");
	include("../../../../config/funciones_seguridad.php");

	$IdFuncio = $_SESSION['SesionUsuaId'];
	$Ruta = MI_ROOT_TEMP_RELATIVA . "/temp_ventanilla/";

	if (!is_dir($Ruta))
		mkdir($Ruta, 0777);

	if (!is_dir($Ruta . '/internos'))
		mkdir($Ruta . '/internos', 0777);

	if (!is_dir($Ruta . '/internos/' . $IdFuncio))
		mkdir($Ruta . '/internos/' . $IdFuncio, 0777);

	$Ruta = $Ruta . '/internos/' . $IdFuncio;

	if (isset($_GET["delete"]) && $_GET["delete"] == true) {
		$name = $_POST["filename"];

		if (file_exists($Ruta . "/" . $name)) {

			unlink($Ruta . "/" . $name);

			/* $Archiv = new RadicadoInternoAdjuntos();
			$Archivo->set_Accion('ELIMINAR_ARCHIVO');
			$Archivo->set_IdFuncio($IdFuncio);
			$Archivo->set_Archivo($name);
			$Archivo->Gestionar(); */

			echo json_encode(array("res" => true));
		} else {
			echo json_encode(array("res" => false));
		}
	} else {
		$file     = $_FILES["file"]["name"];
		$filetype = $_FILES["file"]["type"];
		$filesize = $_FILES["file"]["size"];

		if ($file && move_uploaded_file($_FILES["file"]["tmp_name"], $Ruta . "/" . $file)) {
			/* $Archivo = new GestionAdjunto();
			$Archivo->set_Accion('INSERTAR');
			$Archivo->set_IdFuncio($_GET["IdFuncio"]);
			$Archivo->set_Archivo($file);
			$Archivo->Gestionar(); */
		}
	}
}
