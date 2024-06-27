<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

	require_once "../../../config/class.Conexion.php";
	require_once "../../../config/funciones.php";
	require_once '../../clases/seguridad/class.SeguridadUsuario.php';

	$Accion        = isset($_POST['accion']) ? $_POST['accion'] : null;
	$id_usua       = isset($_POST['id_usua']) ? $_POST['id_usua'] : null;
	$id_funcio     = isset($_POST['id_funcio']) ? $_POST['id_funcio'] : null;
	$login         = isset($_POST['login']) ? $_POST['login'] : null;
	$contra        = isset($_POST['contra']) ? $_POST['contra'] : null;
	$cambio_contra = isset($_POST['cambio_contra']) ? 1 : 0;
	if ($Accion == "INSERTAR" or $Accion == "EDITAR") {
		$Acti      = isset($_POST['acti']) ? 1 : 0;
	} else {
		$Acti = $_POST['acti'];
	}
	$Perfiles = isset($_POST['ChkPerfiles']) ? $_POST['ChkPerfiles'] : 0;

	switch ($Accion) {
		case 'INSERTAR':

			validar_clave($contra);

			$BuscarPorLogin = Usuario::Buscar(3, "", $login, "", "", "", "", "");
			if ($BuscarPorLogin) {
				echo "El nombre de usuario ya se encuentra registrado Login: " . $BuscarPorLogin->getLogin();
				exit();
			}

			$BuscarIdFuncio = Usuario::Buscar(2, $id_funcio, "", "", "", "", "", "");
			if ($BuscarIdFuncio) {
				echo "El funcionario ya se encuentra registrado en el sistema.";
				exit();
			}

			$Usuario = new Usuario();
			$Usuario->setAccion($Accion);
			$Usuario->setId_Usua($id_usua);
			$Usuario->setId_Funcio($id_funcio);
			$Usuario->setLogin($login);
			$Usuario->setContra(Encriptar($contra));
			if ($Usuario->Gestionar() == 'true') {

				$id_usua = $Usuario->getId_Usua();

				for ($i = 0; $i < count($Perfiles); $i++) {
					Usuario::Gestionar_Perfiles(2, $id_usua, $Perfiles[$i]);
				}

				echo "1";
				exit();
			} else {
				echo "No fue posible crear el usuario, por favor consulte con el administrador del sistema";
				exit();
			}

			break;
		case 'EDITAR':
			if ($contra != "") {
				echo	validar_clave($contra);
			}

			$Usuario = new Usuario();
			$Usuario->setAccion($Accion);
			$Usuario->setId_Usua($id_usua);
			$Usuario->setContra(Encriptar($contra));
			$Usuario->setCambioContra($cambio_contra ? 0 : 1);
			$Usuario->setActi($Acti);
			if ($Usuario->Gestionar() == 'true') {

				Usuario::Gestionar_Perfiles(1, $id_usua, "");

				for ($i = 0; $i < count($Perfiles); $i++) {
					Usuario::Gestionar_Perfiles(2, $id_usua, $Perfiles[$i]);
				}

				echo 1;
				exit();
			} else {
				echo "No fue posible editar el usuario, por favor consulte con el administrador del sistema.";
			}

			break;
		case 'ELIMINAR':

			if (Usuario::Gestionar_Perfiles(1, $id_usua, "") == "true") {

				$Usuario = new Usuario();
				$Usuario->setAccion($Accion);
				$Usuario->setId_Usua($id_usua);
				if ($Usuario->Gestionar() == 'true') {
					echo "1";
				} else {
					echo "No fue posible eliminar el usuario, por favor consulte con el administrador del sistema.";
				}
			}
			break;
		case 'ACTIVAR':
			$Usuario = new Usuario();
			$Usuario->setAccion($Accion);
			$Usuario->setId_Usua($id_usua);
			$Usuario->setActi($Acti);
			if ($Usuario->Gestionar() == true) {
				echo 1;
				exit();
			}
			break;
		default:
			echo 'No hay accion para realizar.';
	}
}
