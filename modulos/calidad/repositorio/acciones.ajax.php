<?php
require_once '../../../config/class.Conexion.php';
require_once '../../clases/areas/class.AreasOficina.php';

$Accion              = isset($_POST['accion']) ? $_POST['accion'] : null;
$Id_Oficina          = isset($_POST['id_oficina']) ? $_POST['id_oficina'] : null;
$Id_Dependencia      = isset($_POST['id_depen']) ? $_POST['id_depen'] : null;
$Cod_Oficina         = isset($_POST['cod_oficina']) ? $_POST['cod_oficina'] : null;
$Cod_Correspondencia = isset($_POST['cod_corres']) ? $_POST['cod_corres'] : null;
$Nom_Oficina         = isset($_POST['nom_oficina']) ? $_POST['nom_oficina'] : null;
$Observa             = isset($_POST['observa']) ? $_POST['observa'] : null;
$Acti                = isset($_POST['acti']) ? $_POST['acti'] : null;

switch ($Accion) {
	case 'Insertar':
		$Oficina = new Oficina();
		$Oficina->setId_Oficina($Id_Oficina);
		$Oficina->setId_Dependencia($Id_Dependencia);
		$Oficina->setCod_Correspondencia($Cod_Correspondencia);
		$Oficina->setCod_Oficina($Cod_Oficina);
		$Oficina->setNom_Oficina($Nom_Oficina);
		$Oficina->setObserva($Observa);
		$Oficina->setActi($Acti);
		$Oficina->guardar();
		break;
	case 'Editar':
		$Oficina = Oficina::Buscar(2, $Id_Oficina, 0, "", "", "");
		$Oficina->setId_Oficina($Id_Oficina);
		$Oficina->setId_Dependencia($Id_Dependencia);
		$Oficina->setCod_Correspondencia($Cod_Correspondencia);
		$Oficina->setCod_Oficina($Cod_Oficina);
		$Oficina->setNom_Oficina($Nom_Oficina);
		$Oficina->setObserva($Observa);
		$Oficina->setActi($Acti);
		$Oficina->Modificar();
		break;
	case 'ELIMINAR':
		if ($Id_Oficina) {
			$Oficina = Oficina::Buscar(2, $Id_Oficina, 0, "", "", "");
			$Oficina->Eliminar();
		} else {
			echo "No hay registro para eliminar.";
		}
		break;
	case 'ACTIVAR':
		if ($Id_Oficina) {
			$Oficina = Oficina::Buscar(2, $Id_Oficina, 0, "", "", "");
			$Oficina->setActi($Acti);
			$Oficina->ActivaInactiva();
		} else {
			echo "No hay registro para eliminar.";
		}
		break;
	default:
		echo 'No hay accion para realizar.';
}
