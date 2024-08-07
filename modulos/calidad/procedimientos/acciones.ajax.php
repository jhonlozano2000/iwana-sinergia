<?php
require_once '../../../config/class.Conexion.php';
require_once '../../clases/calidad/class.CalidadProcedimientos.php';

$Accion = isset($_POST['accion']) ? $_POST['accion'] : null;
$idProceso = isset($_POST['proceso_id']) ? $_POST['proceso_id'] : null;
$idProcedimiento = isset($_POST['procedimiento_id']) ? $_POST['procedimiento_id'] : null;
$codProcedimiento = isset($_POST['cod_procedimiento']) ? $_POST['cod_procedimiento'] : null;
$nomProcedimientos = isset($_POST['nom_procedimiento']) ? $_POST['nom_procedimiento'] : null;
$Acti = isset($_POST['acti']) ? $_POST['acti'] : null;

switch ($Accion) {
	case 'INSERTAR':

		//Busco el procedimiento para saber si ya se registró
		$busProcedimiento = Procedimiento::Buscar(1, $idProceso, '', $codProcedimiento, '');
		if ($busProcedimiento) {
			echo "El código del procedimiento ya se encuentra registrado.";
			exit();
		}

		$busProcedimiento = Procedimiento::Buscar(2, $idProceso, '', '', $nomProcedimientos);
		if ($busProcedimiento) {
			echo "El nombre del procedimiento ya se encuentra registrado.";
			exit();
		}

		$procedimiento = new Procedimiento();
		$procedimiento->setAccion($Accion);
		$procedimiento->setidProceso($idProceso);
		$procedimiento->setidProcedimiento($idProcedimiento);
		$procedimiento->setcodProcedimiento($codProcedimiento);
		$procedimiento->setnomProcedimiento($nomProcedimientos);
		$procedimiento->setEstado($Acti);
		if ($procedimiento->Gestionar() == true) {
			echo 1;
			exit();
		} else {
			echo "No fue posible almecenar el proces";
			exit();
		}

		break;
	case 'EDITAR':

		$procedimiento = new Procedimiento();
		$procedimiento->setAccion($Accion);
		$procedimiento->setidProceso($idProceso);
		$procedimiento->setidProcedimiento($idProcedimiento);
		$procedimiento->setcodProcedimiento($codProcedimiento);
		$procedimiento->setnomProcedimiento($nomProcedimientos);
		$procedimiento->setEstado($Acti);
		if ($procedimiento->Gestionar() == true) {
			echo 1;
			exit();
		} else {
			echo "No fue posible actualizar el proces";
			exit();
		}
		break;
	case 'ELIMINAR':

		if ($idProcedimiento) {
			$procedimiento = new Procedimiento();
			$procedimiento->setAccion($Accion);
			$procedimiento->setidProcedimiento($idProcedimiento);
			if ($procedimiento->Gestionar() == true) {
				echo 1;
				exit();
			} else {
				echo "No fue posible actualizar el proces";
				exit();
			}
		} else {
			echo "No hay registro para eliminar.";
		}
		break;
	case 'ACTIVAR_INACTIVAR':
		if ($idProcedimiento) {
			$procedimiento = new Procedimiento();
			$procedimiento->setAccion($Accion);
			$procedimiento->setidProcedimiento($idProcedimiento);
			$procedimiento->setEstado($Acti);
			if ($procedimiento->Gestionar() == true) {
				echo 1;
				exit();
			} else {
				echo "No fue posible actualizar el proces";
				exit();
			}
		} else {
			echo "No hay registro para procesar.";
		}
		break;
	default:
		echo 'No hay accion para realizar.';
}
