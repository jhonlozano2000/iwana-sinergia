<?php
require_once '../../../../config/class.Conexion.php';
require_once '../../../clases/oficina_archivo/tvd/class.TVDSerie.php';

$Accion   = isset($_POST['accion']) ? $_POST['accion'] : null;
$IdSerie  = isset($_POST['id_serie']) ? $_POST['id_serie'] : null;
$CodSerie = isset($_POST['cod_serie']) ? $_POST['cod_serie'] : null;
$NomSerie = isset($_POST['nom_serie']) ? $_POST['nom_serie'] : null;
$Observa  = isset($_POST['observa']) ? $_POST['observa'] : null;
$Acti     = isset($_POST['acti']) ? $_POST['acti'] : null;

switch ($Accion){
	case 'Insertar':

		$BuscarSerie = SerieTVD::Buscar(2, "", $CodSerie, $NomSerie);
		if($BuscarSerie){
			echo "Ya existe una Serie con el nombre ".$NomSerie;
			exit();
		}

		$Serie = new SerieTVD();
		$Serie -> setAccion($Accion);
		$Serie -> setId_Serie($IdSerie);
		$Serie -> setCod_Serie($CodSerie);
		$Serie -> setNom_Serie($NomSerie);
		$Serie -> setObserva($Observa);
		$Serie -> setActi($Acti);
		if($Serie -> Gestionar() == 'true'){
			echo 1;
			exit();
		}else{
			echo 'No fue posible ejecutar la consulta, por favor consulte con el administrdor del sistema.';
		}
	break;
	case 'EDITAR':
		$Serie = new SerieTVD();
		$Serie -> setAccion($Accion);
		$Serie -> setId_Serie($IdSerie);
		$Serie -> setCod_Serie($CodSerie);
		$Serie -> setNom_Serie($NomSerie);
		$Serie -> setObserva($Observa);
		$Serie -> setActi($Acti);
		if($Serie -> Gestionar() == 'true'){
			echo 1;
			exit();
		}else{
			echo 'No fue posible ejecutar la consulta, por favor consulte con el administrdor del sistema.';
		}
	break;
	case 'ELIMINAR':

		$Serie = new SerieTVD();
		$Serie -> setAccion($Accion);
		$Serie -> setId_Serie($IdSerie);
		if($Serie -> Gestionar() == true){
			echo 1;
			exit();
		}else{
			echo 'No fue posible ejecutar la consulta, por favor consulte con el administrdor del sistema.';
		}
	break;
	case 'ACTIVAR':
		$Serie = new SerieTVD();
		$Serie -> setAccion($Accion);
		$Serie -> setId_Serie($IdSerie);
		$Serie -> setActi($Acti);
		if($Serie -> Gestionar() == true){
			echo 1;
			exit();
		}else{
			echo 'No fue posible ejecutar la consulta, por favor consulte con el administrdor del sistema.';
		}
	break;
	default:
	echo 'No hay accion para realizar.';
}
?>