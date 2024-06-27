<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	require_once '../../../config/class.Conexion.php';
	require_once '../../clases/seguridad/class.SeguridadPerfiles.php';
 	
 	$Accion    = isset($_POST['accion']) ? $_POST['accion'] : null;
	$IdPerfil  = isset($_POST['id_perfil']) ? $_POST['id_perfil'] : null;
	$NomPerfil = isset($_POST['nom_perfil']) ? $_POST['nom_perfil'] : null;
	$Observa   = isset($_POST['observa']) ? $_POST['observa'] : null;
	if($Accion == "INSERTAR" or $Accion == "EDITAR"){
		$Acti      = isset($_POST['acti']) ? 1 : 0;
	}else{
		$Acti = isset($_POST['acti']) ? 1 : 0;
	}
	$Modulos   = isset($_POST['Modulos']) ? $_POST['Modulos'] : 0;

	switch ($Accion){
		case 'INSERTAR':

			$BuscarPerfil = Perfiles::Buscar(2, "", $NomPerfil, "");
			if($BuscarPerfil){
				echo "Ya se encuentra registrado en perfil con el nombre ".$NomPerfil;
				exit();
			}

			$Perfil = new Perfiles();
			$Perfil->setAccion($Accion);
			$Perfil->setId_Perfil($IdPerfil);
			$Perfil->setNom_Perfil($NomPerfil);
			$Perfil->setObserva($Observa);
			$Perfil->setActi($Acti);
			if($Perfil->Gestionar() == true){

				$IdPerfil = $Perfil->getId_Perfil();

				//INSERTO EL DETALLE DEL PERFIL
				for($i=0;$i<count($Modulos); $i++){
					$PerfilDetalle = Perfiles::Gestionar_Detalle(1, $Modulos[$i], $IdPerfil, 1);
				}

				echo 1;
				exit();
			}
		break;
		case 'EDITAR':
			$Perfil = new Perfiles();
			$Perfil->setAccion($Accion);
			$Perfil->setId_Perfil($IdPerfil);
			$Perfil->setNom_Perfil($NomPerfil);
			$Perfil->setObserva($Observa);
			$Perfil->setActi($Acti);
			if($Perfil->Gestionar() == true){
				//ELIMINO EL DETALLE ACTUAL
				$Perfil = Perfiles::Gestionar_Detalle(4, "", $IdPerfil, "");

				//ACTUALIZO EL DETALLE DEL PERFIL
				for($i=0;$i<count($Modulos); $i++){
					$PerfilDetalle = Perfiles::Gestionar_Detalle(1, $Modulos[$i], $IdPerfil, 1);
				}

				echo 1;
				exit();
			}
		break;
		case 'ELIMINAR':
			if($IdPerfil){
				$Perfil = Perfiles::Gestionar_Detalle(4, "", $IdPerfil, "");

				$Perfil = new Perfiles();
				$Perfil->setAccion($Accion);
				$Perfil->setId_Perfil($IdPerfil);
				if($Perfil->Gestionar() == true){
					echo 1;
					exit();
				}
			}else{
				echo "No hay registro para eliminar.";
			}
		break;
		case 'ACTIVAR':
			$Perfil = new Perfiles();
			$Perfil->setAccion($Accion);
			$Perfil->setId_Perfil($IdPerfil);
			$Perfil->setActi($Acti);
			if($Perfil->Gestionar() == true){
				echo 1;
				exit();
			}
		break;
		default:
			echo 'No hay accion para realizar.';
	}
}
