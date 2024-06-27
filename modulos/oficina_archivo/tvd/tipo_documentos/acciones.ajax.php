<?php
require_once '../../../../config/class.Conexion.php';
require_once '../../../clases/oficina_archivo/tvd/class.TVDTipoDocumento.php';

$Accion          = isset($_POST['accion']) ? $_POST['accion'] : null;
$IdTipoDocumento = isset($_POST['id_tipodoc']) ? $_POST['id_tipodoc'] : null;
$NomipoDocumento = isset($_POST['nom_tipodoc']) ? $_POST['nom_tipodoc'] : null;
$Observa         = isset($_POST['observa']) ? $_POST['observa'] : null;
$Acti            = isset($_POST['acti']) ? 1 : 0;

switch ($Accion){
	case 'INSERTAR':

		$BuscarTipoDocumental = TipoDocumentoTVD::Buscar(2, "", $NomipoDocumento);
		if($BuscarTipoDocumental){
			echo "Ya existe un Tipo de Documento con el nombre ".$NomipoDocumento;
			exit();
		}

		$TipoDocumental = new TipoDocumentoTVD();
		$TipoDocumental -> set_Accion($Accion);
		$TipoDocumental -> set_Id($IdTipoDocumento);
		$TipoDocumental -> setNom_TipoDocumento($NomipoDocumento);
		$TipoDocumental -> set_Observa($Observa);
		$TipoDocumental -> set_Acti($Acti);
		if($TipoDocumental -> Gestionar() == true){
			echo 1;
			exit();
		}else{
			echo 'No fue posible ejecutar la consulta, por favor consulte con el administrdor del sistema.';
		}
	case 'EDITAR':

		$TipoDocumental = new TipoDocumentoTVD();
		$TipoDocumental -> set_Accion($Accion);
		$TipoDocumental -> set_Id($IdTipoDocumento);
		$TipoDocumental -> setNom_TipoDocumento($NomipoDocumento);
		$TipoDocumental -> set_Observa($Observa);
		$TipoDocumental -> set_Acti($Acti);
		if($TipoDocumental -> Gestionar() == true){
			echo 1;
			exit();
		}else{
			echo 'No fue posible ejecutar la consulta, por favor consulte con el administrdor del sistema.';
		}
	case 'ELIMINAR':
		$TipoDocumental = new TipoDocumentoTVD();
		$TipoDocumental -> set_Accion($Accion);
		$TipoDocumental -> set_Id($IdTipoDocumento);
		if($TipoDocumental -> Gestionar() == true){
			echo 1;
			exit();
		}else{
			echo 'No fue posible ejecutar la consulta, por favor consulte con el administrdor del sistema.';
		}
	break;
	case 'ACTIVAR':
		$TipoDocumental = new TipoDocumentoTVD	();
		$TipoDocumental -> set_Accion($Accion);
		$TipoDocumental -> set_Id($IdTipoDocumento);
		$TipoDocumental -> set_Acti($Acti);
		if($TipoDocumental -> Gestionar() == true){
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