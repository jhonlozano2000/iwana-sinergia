<?php
if (! empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	session_start();
	require_once '../../config/class.Conexion.php';
	require_once '../../config/funciones.php';
	require_once '../clases/chat/class.chat.php';

	$Accion       = isset($_POST['accion']) ? $_POST['accion'] : null;
	$IdUsuaRecibe = isset($_POST['id_usua_recive']) ? $_POST['id_usua_recive'] : null;
	$Mensaje = isset($_POST['mensaje']) ? $_POST['mensaje'] : null;

	switch ($Accion) {
		case 'INSERTAR_MENSAJE':
			$Chat = new Chat();
			$Chat->setAccion($Accion);
			$Chat->set_IdUsuaEnvia($_SESSION['SesionUsuaId']);
			$Chat->set_IdUsuaRecive($IdUsuaRecibe);
			$Chat->setTexto($Mensaje);
			if($Chat->Gestionar() == true){
				echo 1;
				exit();
			}
			break;
		
		default:
			echo "No hay accion para realizar.";
			break;
	}
}
?>