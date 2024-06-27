<?php
require_once '../../../config/class.Conexion.php';
require_once '../../clases/configuracion/class.ConfigServidor_Temp.php';

$Accion         = isset($_POST['accion']) ? $_POST['accion'] : null;
$id_ruta        = isset($_POST['id_ruta']) ? $_POST['id_ruta'] : null;
$servidor       = isset($_POST['ip']) ? $_POST['ip'] : null;
$usua           = isset($_POST['usua']) ? $_POST['usua'] : null;
$contra         = isset($_POST['contra']) ? $_POST['contra'] : null;
$ruta           = isset($_POST['ruta']) ? $_POST['ruta'] : null;
$acti           = isset($_POST['acti']) ? $_POST['acti'] : null;
$tipo_correspon = isset($_POST['tipo_correspon']) ? $_POST['tipo_correspon'] : null;
$observa        = isset($_POST['observa']) ? $_POST['observa'] : null;

switch ($Accion){
	case 'INSERTAR':

		$BuscarRuta = ServidorTemp::Buscar(4, "", $ruta, "");
		if($BuscarRuta){
			echo "Ya existe una ruta con el nombre ".$ruta.", configurada en el sistema.";
			exit();
		}

		$BuscarRutaActiva = ServidorTemp::Buscar(5, "", "", $tipo_correspon);
		if($BuscarRutaActiva){
			echo "Ya existe una ruta activa para este tipo de correspondencia.";
			exit();
		}

		$Ruta = new ServidorTemp();
		$Ruta -> set_Accion($Accion);
		$Ruta -> set_IdRuta($id_ruta);
		$Ruta -> set_Ip($servidor);
		$Ruta -> set_Usua($usua);
		$Ruta -> set_Contra($contra);
		$Ruta -> set_Ruta($ruta);
		$Ruta -> set_TipoCorrespon($tipo_correspon);
		$Ruta -> set_Observa($observa);
		$Ruta -> set_Acti($acti);
		if($Ruta -> Gestionar() == true){
			echo 1;
			exit();
		}
	break;
	case 'EDITAR':
		$Ruta = new ServidorTemp();
		$Ruta -> set_Accion($Accion);
		$Ruta -> set_IdRuta($id_ruta);
		$Ruta -> set_Ip($servidor);
		$Ruta -> set_Usua($usua);
		$Ruta -> set_Contra($contra);
		$Ruta -> set_Ruta($ruta);
		$Ruta -> set_TipoCorrespon($tipo_correspon);
		$Ruta -> set_Observa($observa);
		$Ruta -> set_Acti($acti);
		if($Ruta -> Gestionar() == true){
			echo 1;
			exit();
		}
	break;
	case 'ELIMINAR':
		$Ruta = new ServidorTemp();
		$Ruta -> set_Accion($Accion);
		$Ruta -> set_IdRuta($id_ruta);
		if($Ruta -> Gestionar() == true){
			echo 1;
			exit();
		}
	break;
	case 'ACTIVAR':
		$Ruta = new ServidorTemp();
		$Ruta -> set_Accion($Accion);
		$Ruta -> set_IdRuta($id_ruta);
		$Ruta -> set_Acti($acti);
		if($Ruta -> Gestionar() == true){
			echo 1;
			exit();
		}
	break;
	default:
		echo 'No hay accion para realizar.';
}
?>