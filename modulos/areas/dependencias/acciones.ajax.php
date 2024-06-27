<?php
    require_once '../../../config/class.Conexion.php';
    require_once '../../clases/areas/class.AreasDependencia.php';
 	
	$Accion              = isset($_POST['accion']) ? $_POST['accion'] : null;
	$Id                  = isset($_POST['id_depen']) ? $_POST['id_depen'] : null;
	$Cod_Dependencia     = isset($_POST['cod_depen']) ? $_POST['cod_depen'] : null;
	$Cod_Correspondencia = isset($_POST['cod_corres']) ? $_POST['cod_corres'] :null;
	$Nom_Dependencia     = isset($_POST['nom_depen']) ? $_POST['nom_depen'] : null;
	$Observa             = isset($_POST['observa']) ? $_POST['observa'] : null;
	$Acti                = isset($_POST['acti']) ? $_POST['acti'] : null;

	switch ($Accion){
		case 'Insertar':
			$Dependencia = new Dependencia();
			$Dependencia -> setAccion('INSERTAR');
			$Dependencia -> setCod_Dependencia($Cod_Dependencia);
			$Dependencia -> setCod_Correspondencia($Cod_Correspondencia);
			$Dependencia -> setNom_Dependencia($Nom_Dependencia);
			$Dependencia -> setObserva($Observa);
			$Dependencia -> setActi($Acti);
			if($Dependencia -> Gestionar() == true){
				echo 1;
				exit();
			}
		break;
		case 'EDITAR':
			$Dependencia = new Dependencia();
			$Dependencia -> setAccion('EDITAR');
			$Dependencia -> set_Id($Id);
			$Dependencia -> setCod_Dependencia($Cod_Dependencia);
			$Dependencia -> setCod_Correspondencia($Cod_Correspondencia);
			$Dependencia -> setNom_Dependencia($Nom_Dependencia);
			$Dependencia -> setObserva($Observa);
			$Dependencia -> setActi($Acti);
			if($Dependencia -> Gestionar() == true){
				echo 1;
				exit();
			}
		break;
		case 'ELIMINAR':
			$Dependencia = new Dependencia();
			$Dependencia -> setAccion($Accion);
			$Dependencia -> set_Id($Id);
			if($Dependencia -> Gestionar() == true){
				echo 1;
				exit();
			}
		break;
		case 'ACTIVAR_INACTIVAR':
			$Dependencia = new Dependencia();
			$Dependencia -> setAccion($Accion);
			$Dependencia -> set_Id($Id);
			$Dependencia -> setActi($Acti);
			if($Dependencia -> Gestionar() == true){
				echo 1;
				exit();
			}
		break;
		default:
			echo 'No hay accion para realizar.';
	}

?>