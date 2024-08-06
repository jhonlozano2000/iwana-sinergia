<?php
require_once '../../../config/class.Conexion.php';
require_once '../../../config/funciones.php';
require_once '../../clases/calidad/class.CalidadRepositorio.php';

$Accion = isset($_POST['accion']) ? $_POST['accion'] : null;
$procesoId = isset($_POST['procesos_id']) ? $_POST['procesos_id'] : null;
$tipoDocoId = isset($_POST['tipo_docu_id']) ? $_POST['tipo_docu_id'] : null;
$nomArchiOriginal = isset($_POST['nomArchiOriginal']) ? $_POST['nomArchiOriginal'] : null;
$Acti = isset($_POST['acti']) ? $_POST['acti'] : null;

switch ($Accion) {
	case 'INSERTAR':

		$repositorio = new CalidadRepositorio();
		$repositorio->setAccion($Accion);
		$repositorio->setProcesoId($procesoId);
		$repositorio->seTtipoDocuId($tipoDocoId);
		//$repositorio->setRutaId($rutaId);
		//$repositorio->setNomArchivoOriginal($_FILES['archivo']['name']);
		//$repositorio->setNomArchivoUnico(nombreAleatorioArchivo($_FILES['archivo']['name']));
		$repositorio->setEstado($Acti);
		if ($repositorio->Gestionar() == true) {

			echo '1###' . $repositorio->getArchivoId();
			exit();
		} else {
			echo "No fue posible almecenar el repositorio";
			exit();
		}
		break;
	case 'Editar':
		$repositorio = CalidadRepositorio::Buscar(2, $procesoId, 0, "", "", "");
		$repositorio->setProcesoId($procesoId);
		$repositorio->seTtipoDocuId($tipoDocoId);
		$repositorio->setRutaId($rutaId);
		$repositorio->setNomArchivoOriginal($nomArchiOriginal);
		$repositorio->setNomArchivoUnico($Observa);
		$repositorio->setEstado($Acti);
		$repositorio->Modificar();
		break;
	case 'ELIMINAR':
		if ($procesoId) {
			$repositorio = CalidadRepositorio::Buscar(2, $procesoId, 0, "", "", "");
			$repositorio->Eliminar();
		} else {
			echo "No hay registro para eliminar.";
		}
		break;
	case 'ACTIVAR':
		if ($procesoId) {
			$repositorio = CalidadRepositorio::Buscar(2, $procesoId, 0, "", "", "");
			$repositorio->setEstado($Acti);
			$repositorio->ActivaInactiva();
		} else {
			echo "No hay registro para eliminar.";
		}
		break;
	default:
		echo 'No hay accion para realizar.';
}
