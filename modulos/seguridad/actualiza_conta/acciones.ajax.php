<?PHP
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	session_start();
	require('../../../config/class.Conexion.php');
	require('../../../config/funciones.php');
	require_once("../../clases/seguridad/class.SeguridadUsuario.php");

	$Accion      = isset($_POST['accion']) ? $_POST['accion'] : null;
	$Login       = isset($_POST['login']) ? $_POST['login'] : null;
	$Contra      = isset($_POST['contra']) ? $_POST['contra'] : null;
	$NuevaContra = isset($_POST['nueva_contra']) ? $_POST['nueva_contra'] : null;

	switch ($Accion) {
		case 'CAMBIO_CONTRA':
			$Usuario = Usuario::Buscar(1, $_SESSION['SesionUsuaId'], '', '', "", "", 0, 0);

			$error_encontrado = "";
			if ($Usuario->getContra() != $Contra) {
				echo "La contraseña actual no coincide.";
				exit();
			} elseif (validar_clave($NuevaContra, $error_encontrado)) {

				$Usuario = new Usuario();
				$Usuario->setAccion('ACTUALIZA_CONTRA');
				$Usuario->setId_Usua($_SESSION['SesionUsuaId']);
				$Usuario->setContra(Encriptar($NuevaContra));
				$Usuario->setCambioContra(1);
				$Usuario->Gestionar();
				session_destroy();
			} else {
				echo $error_encontrado;
				exit();
			}
			echo 1;
			exit();
			break;
		default:
			echo 'No hay accion para realizar.';
	}
}
