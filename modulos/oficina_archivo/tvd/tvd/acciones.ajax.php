<?php
require_once '../../../../config/class.Conexion.php';
require_once '../../../clases/oficina_archivo/tvd/calss.TVD.php';
require_once '../../../clases/oficina_archivo/tvd/class.TVDSubSerie_Detalle.php';

$Accion              = isset($_POST['accion']) ? $_POST['accion'] : null;
$IdTVD               = isset($_POST['id_tvr']) ? $_POST['id_tvr'] : null;
$IdDepen             = isset($_POST['id_depen']) ? $_POST['id_depen'] : null;
$IdOfi               = isset($_POST['id_oficina']) ? $_POST['id_oficina'] : null;
$IdSerie             = isset($_POST['id_serie']) ? $_POST['id_serie'] : null;
$IdSubSerie          = isset($_POST['id_subserie']) ? $_POST['id_subserie'] : null;
$AG                  = isset($_POST['agForm']) ? $_POST['agForm'] : 0;
$AC                  = isset($_POST['acForm']) ? $_POST['acForm'] : 0;
$CT                  = isset($_POST['ChkFormCT']) ? 1 : 0;
$E                   = isset($_POST['ChkFormE']) ? 1 : 0;
$DM                  = isset($_POST['ChkFormDM']) ? 1 : 0;
$S                   = isset($_POST['ChkFormS']) ? 1 : 0;
$Observa             = isset($_POST['observa']) ? $_POST['observa'] : 0;
$Acti                = isset($_POST['acti']) ? $_POST['acti'] : 0;
$TiposDocumentos     =  isset($_POST['TiposDocumentos']) ? explode(",", $_POST['TiposDocumentos']) : null;
$incluir_oficina_TVD = isset($_POST['incluir_oficina_TVD']) ? $_POST['incluir_oficina_TVD'] : null;

switch ($Accion){
	case 'INSERTAR':

		if($incluir_oficina_TVD == 1){
			$BuscarTVD = TVD::Buscar(1, "", $IdDepen, $IdSerie, $IdSubSerie);
			if($BuscarTVD){
				echo "Ya existe una TVD configurada con estos parametros.";
				exit();
			}
		}elseif($incluir_oficina_TVD == 2){
			$BuscarTVD = TVD::Buscar(2, $IdOfi, $IdDepen, $IdSerie, $IdSubSerie);
			if($BuscarTVD){
				echo "Ya existe una TVD configurada con estos parametros.";
				exit();
			}
		}
		
		$TVD = new TVD();
		$TVD -> setAccion($Accion);
		$TVD -> set_IdDependencia($IdDepen);
		$TVD -> set_IdOficina($IdOfi);
		$TVD -> set_IdSerie($IdSerie);
		$TVD -> set_IdSubSerie($IdSubSerie);
		$TVD -> set_ag($AG);
		$TVD -> set_ac($AC);
		$TVD -> set_ct($CT);
		$TVD -> set_e($E);
		$TVD -> set_dm($DM);
		$TVD -> set_s($S);
		$TVD -> set_Observa($Observa);
		$TVD -> set_Acti($Acti);
		if($TVD -> Gestionar() == true){
			echo 1;
			exit();
		}else{
			echo 'No fue posible ejecutar la consulta, por favor consulte con el adminisTVDor del sistema.';
		}
	break;
	case 'ACTIVAR_TVD':
		$TVD = new TVD();
		$TVD -> setAccion($Accion);
		$TVD -> set_IdTVD($IdTVD);
		$TVD -> set_Acti($Acti);
		if($TVD -> Gestionar() == true){
			echo 1;
			exit();
		}
	break;
	case 'GESTIONAR_RETENCION_AG':
		$TVD = new TVD();
		$TVD -> setAccion($Accion);
		$TVD -> set_IdTVD($IdTVD);
		$TVD -> set_ag($AG);
		if($TVD -> Gestionar() == true){
			echo 1;
			exit();
		}
	break;
	case 'GESTIONAR_RETENCION_AC':
		$TVD = new TVD();
		$TVD -> setAccion($Accion);
		$TVD -> set_IdTVD($IdTVD);
		$TVD -> set_ac($AC);
		if($TVD -> Gestionar() == true){
			echo 1;
			exit();
		}
	break;
	case 'GESTIONAR_DISPO_FINAL_CT':
		$TVD = new TVD();
		$TVD -> setAccion($Accion);
		$TVD -> set_IdTVD($IdTVD);
		$TVD -> set_ct($CT);
		if($TVD -> Gestionar() == true){
			echo 1;
			exit();
		}
	break;
	case 'GESTIONAR_DISPO_FINAL_E':
		$TVD = new TVD();
		$TVD -> setAccion($Accion);
		$TVD -> set_IdTVD($IdTVD);
		$TVD -> set_e($E);
		if($TVD -> Gestionar() == true){
			echo 1;
			exit();
		}
	break;
	case 'GESTIONAR_DISPO_FINAL_DM':
		$TVD = new TVD();
		$TVD -> setAccion($Accion);
		$TVD -> set_IdTVD($IdTVD);
		$TVD -> set_dm($DM);
		if($TVD -> Gestionar() == true){
			echo 1;
			exit();
		}
	break;
	case 'GESTIONAR_DISPO_FINAL_S':
		$TVD = new TVD();
		$TVD -> setAccion($Accion);
		$TVD -> set_IdTVD($IdTVD);
		$TVD -> set_s($S);
		if($TVD -> Gestionar() == true){
			echo 1;
			exit();
		}
	break;
	case 'EDITAR_SUBSERIE':
		//DESACTIVO TODOS LOA TIPOS DOCUMENTALES ASOCIADOS A LA SUB SERIE

		$SubserieDetalle = new SubSerieDetalleTVD();
		$SubserieDetalle->setAccion(4);
		$SubserieDetalle->setId_SubSerie($IdSubSerie);
		$SubserieDetalle->setActi(0);
		if($SubserieDetalle->Gestionar() === true){
			
			//ELIMINO LOS TIPOS DOCUMENTALES DE LA SERIE Q NO SE ALLAN UTILIZADO EN VCCENTANILLA PARA LA
			//RECEPCION DE CORRESPONDENCIA
			$SubserieDetalle = new SubSerieDetalleTVD();
			$SubserieDetalle->setAccion(3);
			$SubserieDetalle->setId_SubSerie($IdSubSerie);
			$SubserieDetalle->Gestionar();

			for($i=0;$i<count($TiposDocumentos); $i++){

				//SI EL TIPO DOCUMENTA EXISTE EN LA SUBSERIE LO ACTIVO 
				//DE LO CONTRARIO LO INSERTO
				$BuscarTipoDocumento = SubSerieDetalleTVD::Buscar(1, $IdSubSerie, $TiposDocumentos[$i]);
				if($BuscarTipoDocumento){
					$SubserieDetalle = new SubSerieDetalleTVD();
					$SubserieDetalle->setAccion(2);
					$SubserieDetalle->setId_SubSerie($IdSubSerie);
					$SubserieDetalle->setId_TipoDocument($TiposDocumentos[$i]);
					$SubserieDetalle->setActi(1);
					$SubserieDetalle->Gestionar();
				}else{
					$SubserieDetalle = new SubSerieDetalleTVD();
					$SubserieDetalle->setAccion(1);
					$SubserieDetalle->setId_SubSerie($IdSubSerie);
					$SubserieDetalle->setId_TipoDocument($TiposDocumentos[$i]);
					$SubserieDetalle->setActi(1);
					$SubserieDetalle->Gestionar();
				}
			}
		}
		echo 1;
		exit();
	break;
	default:
		echo 'No hay accion para realizar.';
}
?>