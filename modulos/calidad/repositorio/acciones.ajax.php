<?php
require_once '../../../config/class.Conexion.php';
require_once '../../../config/funciones.php';
require_once '../../clases/calidad/class.CalidadRepositorio.php';
require_once '../../clases/calidad/class.TipoDocumenCalidad.php';

$Accion = isset($_POST['accion']) ? $_POST['accion'] : null;
$archivoId = isset($_POST['archivo_id']) ? $_POST['archivo_id'] : null;
$procedimientoId = isset($_POST['procedimiento_id']) ? $_POST['procedimiento_id'] : null;
$tipoDocoId = isset($_POST['tipo_docu_id']) ? $_POST['tipo_docu_id'] : null;
$nomArchiOriginal = isset($_POST['nomArchiOriginal']) ? $_POST['nomArchiOriginal'] : null;
$Acti = isset($_POST['acti']) ? $_POST['acti'] : null;

switch ($Accion) {
	case 'INSERTAR':

		$repositorio = new CalidadRepositorio();
		$repositorio->setAccion($Accion);
		$repositorio->setProcesoId($procedimientoId);
		$repositorio->seTtipoDocuId($tipoDocoId);
		$repositorio->setEstado($Acti);
		if ($repositorio->Gestionar() == true) {
			echo '1###' . $repositorio->getArchivoId();
			exit();
		} else {
			echo "No fue posible almecenar el repositorio";
			exit();
		}
		break;
	case 'ELIMINAR':
		if ($archivoId) {
			$repositorio = new CalidadRepositorio();
			$repositorio->setAccion($Accion);
			$repositorio->setArchivoId($archivoId);
			if ($repositorio->Gestionar() == true) {
				echo 1;
				exit();
			} else {
				echo "No fue posible almecenar el repositorio";
				exit();
			}
		} else {
			echo "No hay registro para eliminar.";
		}
		break;
	case 'LISTAR_ARCHIVOS':
		$tiposArchivos = TipoDocumentoCalidad::Listar(3, "");
		$archivosProcesos = array();

		// Recorre cada tipo de archivo
		foreach ($tiposArchivos as $archivo) {
			// Obtén los archivos para el tipo de documento actual
			$archivos = CalidadRepositorio::Listar(2, "", $procedimientoId, $archivo['tipo_docu_id']);

			// Agrega los archivos al arreglo de archivos procesos
			// Usa array_merge para combinar arreglos en lugar de sobrescribir
			$archivosProcesos = array_merge($archivosProcesos, $archivos);
		}

		// Devuelve los resultados en formato JSON
		echo json_encode($archivosProcesos);
		break;
	default:
		echo 'No hay accion para realizar.';
}
