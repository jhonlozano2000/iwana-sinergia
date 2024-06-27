<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	require_once '../../../config/class.Conexion.php';
	require_once '../../../config/variable.php';
	require_once '../../clases/general/class.GeneralFuncionario.php';
	

	$Accion           = isset($_POST['accion']) ? $_POST['accion'] : null;
	$id_funcio        = isset($_POST['id_funcio']) ? $_POST['id_funcio'] : null;
	$id_funcio_deta   = isset($_POST['id_funcio_deta']) ? $_POST['id_funcio_deta'] : null;
	$id_muni          = isset($_POST['id_muni']) ? $_POST['id_muni'] : null;
	$id_depar         = isset($_POST['id_depar']) ? $_POST['id_depar'] : null;
	$cod_funcio       = isset($_POST['cod_funcio']) ? $_POST['cod_funcio'] : null;
	$nom_funcio       = isset($_POST['nom_funcio']) ? $_POST['nom_funcio'] : null;
	$ape_funcio       = isset($_POST['ape_funcio']) ? $_POST['ape_funcio'] : null;
	$genero           = isset($_POST['genero']) ? $_POST['genero'] : null;
	$dir              = isset($_POST['dir']) ? $_POST['dir'] : null;
	$tel              = isset($_POST['tel']) ? $_POST['tel'] : null;
	$cel              = isset($_POST['cel']) ? $_POST['cel'] : null;
	$email            = isset($_POST['email']) ? $_POST['email'] : null;
	$observa          = isset($_POST['observa']) ? $_POST['observa'] : null;
	$firma            = isset($_POST['firma']) ? $_POST['firma'] : null;
	$foto             = isset($_POST['foto']) ? $_POST['foto'] : null;

	$Login       = isset($_POST['login']) ? $_POST['login'] : null;
	$Contra      = isset($_POST['contra']) ? $_POST['contra'] : null;
	$NuevaContra = isset($_POST['nueva_contra']) ? $_POST['nueva_contra'] : null;
	
	switch ($Accion){

		case 'EDITAR':
			$Funcionario = new Funcionario();
			$Funcionario -> setAccion('ACTUALIZAR_PERFIL');
			$Funcionario -> setId_Funcio($id_funcio);
			$Funcionario -> setCod_Funcio($cod_funcio);
			$Funcionario -> setNom_Funcio($nom_funcio);
			$Funcionario -> setApe_Funcio($ape_funcio);
			$Funcionario -> setGenero($genero);
			$Funcionario -> setId_Depar($id_depar);
			$Funcionario -> setId_Muni($id_muni);
			$Funcionario -> setDir($dir);
			$Funcionario -> setTel($tel);
			$Funcionario -> setCel($cel);
			$Funcionario -> setEmail($email);
			$Funcionario -> setFirma($firma);
			if($Funcionario -> Gestionar() == true){
				echo 1;
			}else{
				echo "No se pudo actializar la información del funconario.";
			}
		break;
		case 'CAMBIO_CONTRA':
			$Usuario = Usuario::Buscar(1, $_SESSION['SesionUsuaId'], '', '', "", "", 0, 0);

			$error_encontrado="";
			if($Usuario->getContra() != $Contra){
				echo "La contraseña actual no coincide.";
				exit();
			}elseif (validar_clave($NuevaContra, $error_encontrado)){
			
				$Usuario = new Usuario();
				$Usuario -> setAccion('ACTUALIZA_CONTRA');
				$Usuario -> setId_Usua($_SESSION['SesionUsuaId']);
				$Usuario -> setContra(Encriptar($NuevaContra));
				$Usuario -> setCambioContra(1);
				$Usuario -> Gestionar();
				session_destroy();
			}else{
				echo $error_encontrado;
				exit();
			}
			echo 1;
			exit();
		break;
		case 'SUBIR_IMAGEN_PERFIL':
			// get details of the uploaded file
			$fileTmpPath   = $_FILES['FileImagenPerfil']['tmp_name'];
			$fileName      = $_FILES['FileImagenPerfil']['name'];
			$fileSize      = $_FILES['FileImagenPerfil']['size'];
			$fileType      = $_FILES['FileImagenPerfil']['type'];
			$fileNameCmps  = explode(".", $fileName);
			$fileExtension = strtolower(end($fileNameCmps));

			// directory in which the uploaded file will be moved
			if(!file_exists(MI_ROOT_ARCHIVOS_RELATIVA."/fotos_perfil")) {
				mkdir(MI_ROOT_ARCHIVOS_RELATIVA."/fotos_perfil", 0777);
			}

			$uploadFileDir = MI_ROOT_ARCHIVOS_RELATIVA."/fotos_perfil";
			$newFileName = $id_funcio.".".$fileExtension;
			$dest_path = $uploadFileDir."/".$newFileName;
			 
			if(move_uploaded_file($fileTmpPath, $dest_path)){

				$Funcionario = new Funcionario();
				$Funcionario -> setAccion('ACTUALIZAR_IMAGEN_PERFIL');
				$Funcionario -> setId_Funcio($id_funcio);
				$Funcionario -> setFoto($newFileName);
				$Funcionario -> Gestionar();

				echo 1;
			}else{
				echo "No fue posible subir la imagen de perfil";
			}
		break;
		case 'SUBIR_IMAGEN_FIRMA':
			// get details of the uploaded file
			$fileTmpPath   = $_FILES['FileImagenFirma']['tmp_name'];
			$fileName      = $_FILES['FileImagenFirma']['name'];
			$fileSize      = $_FILES['FileImagenFirma']['size'];
			$fileType      = $_FILES['FileImagenFirma']['type'];
			$fileNameCmps  = explode(".", $fileName);
			$fileExtension = strtolower(end($fileNameCmps));

			// directory in which the uploaded file will be moved
			if(!file_exists(MI_ROOT_ARCHIVOS_RELATIVA."/fotos_firmas")) {
				mkdir(MI_ROOT_ARCHIVOS_RELATIVA."/fotos_firmas", 0777);
			}

			$uploadFileDir = MI_ROOT_ARCHIVOS_RELATIVA."/fotos_firmas";
			$newFileName = $id_funcio.".".$fileExtension;
			$dest_path = $uploadFileDir."/".$newFileName;
			 
			if(move_uploaded_file($fileTmpPath, $dest_path)){

				$Funcionario = new Funcionario();
				$Funcionario -> setAccion('ACTUALIZAR_IMAGEN_FIRMA');
				$Funcionario -> setId_Funcio($id_funcio);
				$Funcionario -> setFirma($newFileName);
				$Funcionario -> Gestionar();

				echo 1;
			}else{
				echo "No fue posible subir la imagen de perfil";
			}
		break;
		default:
			echo 'No hay accion para realizar.';
	}
}
?>