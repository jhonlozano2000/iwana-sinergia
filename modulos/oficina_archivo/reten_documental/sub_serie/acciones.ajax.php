<?php
require_once '../../../../config/class.Conexion.php';
require_once '../../../clases/retencion/class.TRDSubSerie.php';
require_once '../../../clases/retencion/class.TRDSubSerie_Detalle.php';

$Accion          = isset($_POST['accion']) ? $_POST['accion'] : null;
$IdSubSerie      = isset($_POST['id_subserie']) ? $_POST['id_subserie'] : null;
$CodSubSerie     = isset($_POST['cod_subserie']) ? $_POST['cod_subserie'] : null;
$NomSubSerie     = isset($_POST['nom_subserie']) ? $_POST['nom_subserie'] : null;
$Acti            = isset($_POST['acti']) ? 1 : 0;
$TiposDocumentos =  isset($_POST['TiposDocumentos']) ? explode(",", $_POST['TiposDocumentos']) : null;

switch ($Accion){
	case 'INSERTAR':

		$BuscarSubSerie = SubSerie::Buscar(2, "", $CodSubSerie, $NomSubSerie);
		if($BuscarSubSerie){
			echo "La Subserie ".$NomSubSerie." ya se encuentra registrada en el sistema.";
			exit();
		}

		$SubSerie = new SubSerie();
		$SubSerie -> setAccion($Accion);
		$SubSerie -> setId_SubSerie($IdSubSerie);
		$SubSerie -> setCod_SubSerie($CodSubSerie);
		$SubSerie -> setSubSerie($NomSubSerie);
		
		if($SubSerie -> Gestionar() == true){
			
			for($i=0;$i<count($TiposDocumentos); $i++){
				//SI EL TIPO DOCUMENTA EXISTE EN LA SUBSERIE LO ACTIVO 
				//DE LO CONTRARIO LO INSERTO
				$BuscarTipoDocumento = SubSerieDetalle::Buscar(1, $SubSerie->getId_SubSerie(), $TiposDocumentos[$i]);
				if($BuscarTipoDocumento){
					$SubserieDetalle = new SubSerieDetalle();
					$SubserieDetalle->setAccion(3);
					$SubserieDetalle->setId_SubSerie($SubSerie->getId_SubSerie());
					$SubserieDetalle->setId_TipoDocument($TiposDocumentos[$i]);
					$SubserieDetalle->setActi(1);
					$SubserieDetalle->Gestionar();
				}else{
					$SubserieDetalle = new SubSerieDetalle();
					$SubserieDetalle->setAccion(1);
					$SubserieDetalle->setId_SubSerie($SubSerie->getId_SubSerie());
					$SubserieDetalle->setId_TipoDocument($TiposDocumentos[$i]);
					$SubserieDetalle->setActi(1);
					$SubserieDetalle->Gestionar();
				}
			}
		
			echo 1;
			exit();
		}else{
			echo 'No fue posible ejecutar la consulta, por favor consulte con el administrdor del sistema.';
		}
	case 'EDITAR':
	
		$SubSerie = new SubSerie();
		$SubSerie -> setAccion($Accion);
		$SubSerie -> setId_SubSerie($IdSubSerie);
		$SubSerie -> setCod_SubSerie($CodSubSerie);
		$SubSerie -> setSubSerie($NomSubSerie);
		$SubSerie -> set_Acti($Acti);
		if($SubSerie -> Gestionar() == true){

			//ELIMINO LOS TIPOS DOCUMENTALES DE LA SERIE Q NO SE ALLAN UTILIZADO EN VCCENTANILLA PARA LA
			//RECEPCION DE CORRESPONDENCIA
			$SubserieDetalle = new SubSerieDetalle();
			$SubserieDetalle->setAccion(3);
			$SubserieDetalle->setId_SubSerie($IdSubSerie);
			$SubserieDetalle->Gestionar();

			for($i=0;$i<count($TiposDocumentos); $i++){

				//SI EL TIPO DOCUMENTA EXISTE EN LA SUBSERIE LO ACTIVO 
				//DE LO CONTRARIO LO INSERTO
				$BuscarTipoDocumento = SubSerieDetalle::Buscar(1, $IdSubSerie, $TiposDocumentos[$i]);
				if($BuscarTipoDocumento){
					$SubserieDetalle = new SubSerieDetalle();
					$SubserieDetalle->setAccion(2);
					$SubserieDetalle->setId_SubSerie($IdSubSerie);
					$SubserieDetalle->setId_TipoDocument($TiposDocumentos[$i]);
					$SubserieDetalle->setActi(1);
					$SubserieDetalle->Gestionar();
				}else{
					$SubserieDetalle = new SubSerieDetalle();
					$SubserieDetalle->setAccion(1);
					$SubserieDetalle->setId_SubSerie($IdSubSerie);
					$SubserieDetalle->setId_TipoDocument($TiposDocumentos[$i]);
					$SubserieDetalle->setActi(1);
					$SubserieDetalle->Gestionar();
				}
			}
			

			echo 1;
			exit();
		}else{
			echo 'No fue posible ejecutar la consulta, por favor consulte con el administrdor del sistema.';
		}
	break;
	case 'ELIMINAR':
		$SubserieDetalle = new SubSerieDetalle();
		$SubserieDetalle->setAccion(3);
		$SubserieDetalle->setId_SubSerie($IdSubSerie);
		$SubserieDetalle->Gestionar();
		if($SubserieDetalle -> Gestionar() == true){

			$SubSerie = new SubSerie();
			$SubSerie -> setAccion($Accion);
			$SubSerie -> setId_SubSerie($IdSubSerie);
			$SubSerie -> Gestionar();

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