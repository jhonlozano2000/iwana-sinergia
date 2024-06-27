<?php
	require_once '../../../config/class.Conexion.php';
    require_once '../../clases/areas/class.AreasCargo.php';
 	
	$Accion         = isset($_POST['accion']) ? $_POST['accion'] : null;
	$Id_Cargo       = isset($_POST['id_cargo']) ? $_POST['id_cargo'] : null;
	$Id_Dependencia = isset($_POST['id_depen']) ? $_POST['id_depen'] : null;
	$Nom_Cargo      = isset($_POST['nom_cargo']) ? $_POST['nom_cargo'] : null;
	$Observa        = isset($_POST['observa']) ? $_POST['observa'] : null;
	$Acti           = isset($_POST['acti']) ? $_POST['acti'] : null;

	switch ($Accion){
		case 'Insertar':
			$Cargo = new Cargo();
			$Cargo -> setId_Cargo($Id_Cargo);
			$Cargo -> setId_Dependencia($Id_Dependencia);
			$Cargo -> setNom_Cargo($Nom_Cargo);
			$Cargo -> setObserva($Observa);
			$Cargo -> setActi($Acti);
			$Cargo -> guardar();
		break; 
		case 'EDITAR':
			$Cargo = Cargo::Buscar(2, $Id_Cargo, 0, "", "", "");
			$Cargo -> setId_Cargo($Id_Cargo);
			$Cargo -> setId_Dependencia($Id_Dependencia);
			$Cargo -> setNom_Cargo($Nom_Cargo);
			$Cargo -> setObserva($Observa);
			$Cargo -> setActi($Acti);
			$Cargo -> Modificar();
		break;
		case 'ELIMINAR':
			if($Id_Cargo){
				$Cargo = Cargo::Buscar(2, $Id_Cargo, 0, "", "", "");
				$Cargo -> Eliminar();
			}else{
				echo "No hay registro para eliminar.";
			}
		break;
		case 'ACTIVAR_INACTIVAR':
			if($Id_Cargo){
				$Cargo = Cargo::Buscar(2, $Id_Cargo, 0, "", "", "");
				$Cargo -> setId_Cargo($Id_Cargo);
				$Cargo -> setActi($Acti);
				$Cargo -> ActivarInactivar();
			}else{
				echo "No hay registro para eliminar.";
			}
		break;
		default:
			echo 'No hay accion para realizar.';
	}
?>