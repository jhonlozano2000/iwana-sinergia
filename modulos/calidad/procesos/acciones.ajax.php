<?php
require_once '../../../config/class.Conexion.php';
require_once '../../clases/calidad/class.CalidadProceso.php';

$Accion = isset($_POST['accion']) ? $_POST['accion'] : null;
$idProceso = isset($_POST['procesos_id']) ? $_POST['procesos_id'] : null;
$idDepen = isset($_POST['id_depen']) ? $_POST['id_depen'] : null;
$codProce = isset($_POST['cod_proce']) ? $_POST['cod_proce'] : null;
$nomProce = isset($_POST['nom_proce']) ? $_POST['nom_proce'] : null;
$Acti = isset($_POST['acti']) ? $_POST['acti'] : null;

switch ($Accion) {
	case 'INSERTAR':

		//Busco el proceso para saber si ya se registró
		$busProceso = Proceso::Buscar(1, '', $codProce, '');
		if ($busProceso) {
			echo "El código del proceso ya se encuentra registrado.";
			exit();
		}

		$busProceso = Proceso::Buscar(2, '', '', $nomProce);
		if ($busProceso) {
			echo "El nombre del proceso ya se encuentra registrado.";
			exit();
		}

		$proceso = new Proceso();
		$proceso->setAccion($Accion);
		$proceso->setidProceso($idProceso);
		$proceso->setidDepen($idDepen);
		$proceso->setcodProceso($codProce);
		$proceso->setnomProceso($nomProce);
		$proceso->setActi($Acti);
		if ($proceso->Gestionar() == true) {
			echo 1;
			exit();
		} else {
			echo "No fue posible almecenar el proces";
			exit();
		}

		break;
	case 'EDITAR':
		//$proceso = Proceso::Buscar(2, $idProceso, 0, "", "", "");
		$proceso = new Proceso();
		$proceso->setAccion($Accion);
		$proceso->setidProceso($idProceso);
		$proceso->setidDepen($idDepen);
		$proceso->setcodProceso($codProce);
		$proceso->setnomProceso($nomProce);
		$proceso->setActi($Acti);
		if ($proceso->Gestionar() == true) {
			echo 1;
			exit();
		} else {
			echo "No fue posible actualizar el proces";
			exit();
		}
		break;
	case 'ELIMINAR':
		if ($idProceso) {
			$proceso = Proceso::Buscar(2, $idProceso, 0, "", "", "");
			//$proceso->Eliminar();
		} else {
			echo "No hay registro para eliminar.";
		}
		break;
	case 'ACTIVAR_INACTIVAR':
		if ($idProceso) {
			$proceso = Proceso::Buscar(2, $idProceso, 0, "", "", "");
			$proceso->setidProceso($idProceso);
			$proceso->setActi($Acti);
			//$proceso->ActivarInactivar();
		} else {
			echo "No hay registro para eliminar.";
		}
		break;
	default:
		echo 'No hay accion para realizar.';
}
