<?php
require_once '../../../config/class.Conexion.php';
require_once '../../clases/calidad/class.TipoDocumenCalidad.php';

$Accion = isset($_POST['accion']) ? $_POST['accion'] : null;
$idTipoDocumento = isset($_POST['tipo_docu_id']) ? $_POST['tipo_docu_id'] : null;
$nomTipoDocumento = isset($_POST['nom_tipo_documento']) ? $_POST['nom_tipo_documento'] : null;
$Acti = isset($_POST['acti']) ? $_POST['acti'] : null;

switch ($Accion) {
	case 'INSERTAR':

		//Busco el tipo de documento para saber si ya se registró
		$busProceso = TipoDocumentoCalidad::Buscar(2, '', $nomTipoDocumento);
		if ($busProceso) {
			echo "El nombre del tipo de documento ya se encuentra registrado.";
			exit();
		}

		$tipoDocumento = new TipoDocumentoCalidad();
		$tipoDocumento->setAccion($Accion);
		$tipoDocumento->setNomTipoDocu($nomTipoDocumento);
		$tipoDocumento->setEstado($Acti);
		if ($tipoDocumento->Gestionar() == true) {
			echo 1;
			exit();
		} else {
			echo "No fue posible almecenar el proces";
			exit();
		}

		break;
	case 'EDITAR':
		$tipoDocumento = new TipoDocumentoCalidad();
		$tipoDocumento->setAccion($Accion);
		$tipoDocumento->setTipoDocuId($idTipoDocumento);
		$tipoDocumento->setNomTipoDocu($nomTipoDocumento);
		$tipoDocumento->setEstado($Acti);
		if ($tipoDocumento->Gestionar() == true) {
			echo 1;
			exit();
		} else {
			echo "No fue posible actualizar el proces";
			exit();
		}
		break;
	case 'ELIMINAR':
		if ($idTipoDocumento) {
			$tipoDocumento = new TipoDocumentoCalidad();
			$tipoDocumento->setAccion($Accion);
			$tipoDocumento->setTipoDocuId($idTipoDocumento);
			if ($tipoDocumento->Gestionar() == true) {
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
		if ($idTipoDocumento) {
			$tipoDocumento = new TipoDocumentoCalidad();
			$tipoDocumento->setAccion($Accion);
			$tipoDocumento->setTipoDocuId($idTipoDocumento);
			$tipoDocumento->setEstado($Acti);
			if ($tipoDocumento->Gestionar() == true) {
				echo 1;
				exit();
			} else {
				echo "No fue posible actualizar el proces";
				exit();
			}
		} else {
			echo "No hay registro para procesas.";
		}
		break;
	default:
		echo 'No hay accion para realizar.';
}
