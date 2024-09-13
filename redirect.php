<?PHP
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	require('config/class.Conexion.php');
	require('config/funciones.php');
	require('config/variable.php');
	require_once("modulos/clases/seguridad/class.SeguridadUsuario.php");

	$estado = session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
	if (!$estado) {
		session_start();
	}

	$Accion = isset($_POST['accion']) ? $_POST['accion'] : null;
	$Login  = isset($_POST['login']) ? $_POST['login'] : null;
	$Contra = isset($_POST['contra']) ? $_POST['contra'] : null;

	//Limpiar_Cadena($Login);
	validar_clave($Contra);

	switch ($Accion) {
		case 'LOGGIN':
			$Usuario = Usuario::Buscar(3, 0, $Login, $Contra, "", "", 0, 0);

			if ($Usuario) {
				$isValid = validate_pass($Usuario->getContra(), $Contra);
			}

			if (!$Usuario) {
				echo "No se encontró el usuario.";
				session_destroy();
				exit();
			} elseif ($Usuario->getCambioContra() == 0) {
				$_SESSION['SesionUsuaId'] = $Usuario->getId_Usua();
				echo 2;
				exit();
			} elseif (!$isValid) {
				echo "Contraseña incorrecta. Vuelva a intentarlo o haz clic en Contraseña olvida para cambiarla.";
				exit();
			} else {

				$RegisUsuario = Usuario::Listar(6, 0, $Login, $Contra, "", "", 0, 0);
				foreach ($RegisUsuario as $ItemUsuario) :

					/* $cookie_name = $ItemUsuario['id_usua'];
					$encryptedUserId = encrypt($ItemUsuario['id_usua'], $key); */

					// Configurar la cookie con el ID cifrado
					/* $cookie_expiration = time() + (86400 * 1); // La cookie durará 30 días
					setcookie($cookie_name, $encryptedUserId, $cookie_expiration, "/", "", false, true); // `HttpOnly` bandera habilitada */

					$_SESSION['SesionUsuaId']                = $ItemUsuario['id_usua'];
					$_SESSION['SesionFuncioDetaId']          = $ItemUsuario['id_funcio_deta'];
					$_SESSION['SesionFuncioId']              = $ItemUsuario['id_funcio'];
					$_SESSION['SesionFuncioCod']             = $ItemUsuario['cod_funcio'];
					$_SESSION['SesionFuncioNom']             = $ItemUsuario['nom_funcio'];
					$_SESSION['SesionFuncioApe']             = $ItemUsuario['ape_funcio'];
					$_SESSION['SesionFuncioSexo']            = $ItemUsuario['genero'];

					$_SESSION['SesionFuncioResponPrinci']    = $ItemUsuario['propie_princi'];
					$_SESSION['SesionFuncioJefeDependencia'] = $ItemUsuario['jefe_dependencia'];
					$_SESSION['SesionFuncioJefeOficina']     = $ItemUsuario['jefe_oficina'];
					$_SESSION['SesionFuncioFirma']           = $ItemUsuario['puede_firmar'];
					$_SESSION['SesionFuncioImagenPerfil']    = $ItemUsuario['foto'];
					$_SESSION['SesionFuncioImagenFirma']     = $ItemUsuario['firma'];

					$_SESSION['SesionFuncioDepenId']         = $ItemUsuario['id_depen'];
					$_SESSION['SesionFuncioDepenCod']        = $ItemUsuario['cod_depen'];
					$_SESSION['SesionFuncioDepenNom']        = $ItemUsuario['nom_depen'];
					$_SESSION['SesionFuncioCargoId']         = $ItemUsuario['id_cargo'];
					$_SESSION['SesionFuncioCargoNom']        = $ItemUsuario['nom_cargo'];
					$_SESSION['SesionFuncioOfiId']           = $ItemUsuario['id_oficina'];
					$_SESSION['SesionFuncioOfiCod']          = $ItemUsuario['cod_oficina'];
					$_SESSION['SesionFuncioOfiCod']          = $ItemUsuario['cod_oficina'];
					$_SESSION['SesionFuncioOfiNom']          = $ItemUsuario['nom_oficina'];

					echo 1;
					exit(0);
				endforeach;

				echo "No se encontró el usuario.";
				exit();
			}
			break;
		default:
			echo 'No hay acción para realizar.';
	}
}
