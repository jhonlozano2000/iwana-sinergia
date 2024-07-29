<?php
require_once '../../../config/class.Conexion.php';
require_once '../../clases/calidad/class.CalidadProcedimientos.php';

$Accion = isset($_POST['accion']) ? $_POST['accion'] : null;
$idProceso = isset($_POST['procesos_id']) ? $_POST['procesos_id'] : null;
$idProcedimiento = isset($_POST['procedimiento_id']) ? $_POST['procedimiento_id'] : null;
$codProcedimiento = isset($_POST['cod_procedimiento']) ? $_POST['cod_procedimiento'] : null;
$nomProcedimientos = isset($_POST['nom_procedimiento']) ? $_POST['nom_procedimiento'] : null;
$Acti = isset($_POST['acti']) ? $_POST['acti'] : null;

switch ($Accion) {
	case 'INSERTAR':

		//Busco el proceso para saber si ya se registró
		$busProcedimiento = Procedimientos::Buscar(1, '', $codProcedimiento, '');
		if ($busProcedimiento) {
			echo "El código del proceso ya se encuentra registrado.";
			exit();
		}

		$busProcedimiento = Procedimientos::Buscar(2, '', '', $nomProcedimientos);
		if ($busProcedimiento) {
			echo "El nombre del proceso ya se encuentra registrado.";
			exit();
		}

		$procedimiento = new Procedimientos();
		$procedimiento->setAccion($Accion);
		$procedimiento->setidProceso($idProceso);
		$procedimiento->setidProcedimiento($idProcedimiento);
		$procedimiento->setcodProcedimiento($codProcedimiento);
		$procedimiento->setnomProcedimiento($nomProcedimientos);
		$procedimiento->setActi($Acti);
		if ($procedimiento->Gestionar() == true) {
			echo 1;
			exit();
		} else {
			echo "No fue posible almecenar el proces";
			exit();
		}

		break;
	case 'EDITAR':

		$procedimiento = new Procedimientos();
		$procedimiento->setAccion($Accion);
		$procedimiento->setidProceso($idProceso);
		$procedimiento->setidProcedimiento($idProcedimiento);
		$procedimiento->setcodProcedimiento($codProcedimiento);
		$procedimiento->setnomProcedimiento($nomProcedimientos);
		$procedimiento->setActi($Acti);
		if ($procedimiento->Gestionar() == true) {
			echo 1;
			exit();
		} else {
			echo "No fue posible actualizar el proces";
			exit();
		}
		break;
	case 'ELIMINAR':
		if ($idProceso) {
			$procedimiento = Proceso::Buscar(2, $idProceso, 0, "", "", "");
			//$procedimiento->Eliminar();
		} else {
			echo "No hay registro para eliminar.";
		}
		break;
	case 'ACTIVAR_INACTIVAR':
		if ($idProceso) {
			$procedimiento = Procedimientos::Buscar(2, $idProceso, 0, "", "", "");
			$procedimiento->setidProceso($idProceso);
			$procedimiento->setActi($Acti);
			//$procedimiento->ActivarInactivar();
		} else {
			echo "No hay registro para eliminar.";
		}
		break;
	default:
		echo 'No hay accion para realizar.';
}
