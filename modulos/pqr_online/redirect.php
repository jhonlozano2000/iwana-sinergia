<?PHP
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

	require('../../config/class.Conexion.php');
	require('../../config/funciones.php');
	require_once("../clases/general/class.GeneralLogin.php");

	$estado = session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
	if (!$estado) {
		session_start();
	}

	$Login  = isset($_POST['login']) ? $_POST['login'] : null;
	$Contra = isset($_POST['password']) ? $_POST['password'] : null;

	//Limpiar_Cadena($Login);
	validar_clave($Contra);

	$Usuario = GeneralLogin::Buscar(1, 0, $Login, $Contra);

	if ($Usuario) {
		$isValid = validate_pass($Usuario->get_Password(), $Contra);
	}

	if (!$Usuario) {
		echo "No se encontro el usuario.";
		session_destroy();
		exit();
	} elseif (!$isValid) {
		echo "Contraseña incorrecta. Vuelva a intentarlo o haz clic en Contraseña olvida para cambiarla.";
		exit();
	} else {

		$_SESSION['SesionContactoIdPQR'] = $Usuario->getId_Remite();
		$_SESSION['SesionContactoNumDocuPQR'] = $Usuario->getNum_Documetno();
		$_SESSION['SesionContactoNomPQR'] = $Usuario->getNom_Contacto();

		echo 1;
		exit(0);
	}
}
