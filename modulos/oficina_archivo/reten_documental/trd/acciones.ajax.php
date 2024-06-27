<?php
require_once '../../../../config/class.Conexion.php';
require_once '../../../clases/retencion/calss.TRD.php';
require_once '../../../clases/retencion/class.TRDSubSerie_Detalle.php';

$Accion              = isset($_POST['accion']) ? $_POST['accion'] : null;
$IdTRD               = isset($_POST['id_TRD']) ? $_POST['id_TRD'] : null;
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
$incluir_oficina_trd = isset($_POST['incluir_oficina_trd']) ? $_POST['incluir_oficina_trd'] : null;

switch ($Accion){
	case 'INSERTAR':

		if($incluir_oficina_trd == 1){
			$BuscarTRD = TRD::Buscar(1, "", $IdDepen, $IdSerie, $IdSubSerie);
			if($BuscarTRD){
				echo "Ya existe una TRD configurada con estos parametros.";
				exit();
			}
		}elseif($incluir_oficina_trd == 2){
			$BuscarTRD = TRD::Buscar(2, $IdOfi, $IdDepen, $IdSerie, $IdSubSerie);
			if($BuscarTRD){
				echo "Ya existe una TRD configurada con estos parametros.";
				exit();
			}
		}

		$TRD = new TRD();
		$TRD -> setAccion($Accion);
		$TRD -> set_IdDependencia($IdDepen);
		$TRD -> set_IdOficina($IdOfi);
		$TRD -> set_IdSerie($IdSerie);
		$TRD -> set_IdSubSerie($IdSubSerie);
		$TRD -> set_ag($AG);
		$TRD -> set_ac($AC);
		$TRD -> set_ct($CT);
		$TRD -> set_e($E);
		$TRD -> set_dm($DM);
		$TRD -> set_s($S);
		$TRD -> set_Observa($Observa);
		$TRD -> set_Acti($Acti);
		if($TRD -> Gestionar() == true){
			echo 1;
			exit();
		}else{
			echo 'No fue posible ejecutar la consulta, por favor consulte con el administrdor del sistema.';
		}
	break;
	case 'ACTIVAR_TRD':
		$TRD = new TRD();
		$TRD -> setAccion($Accion);
		$TRD -> set_IdTRD($IdTRD);
		$TRD -> set_Acti($Acti);
		if($TRD -> Gestionar() == true){
			echo 1;
			exit();
		}
	break;
	case 'GESTIONAR_RETENCION_AG':
		$TRD = new TRD();
		$TRD -> setAccion($Accion);
		$TRD -> set_IdTRD($IdTRD);
		$TRD -> set_ag($AG);
		if($TRD -> Gestionar() == true){
			echo 1;
			exit();
		}
	break;
	case 'GESTIONAR_RETENCION_AC':
		$TRD = new TRD();
		$TRD -> setAccion($Accion);
		$TRD -> set_IdTRD($IdTRD);
		$TRD -> set_ac($AC);
		if($TRD -> Gestionar() == true){
			echo 1;
			exit();
		}
	break;
	case 'GESTIONAR_DISPO_FINAL_CT':
		$TRD = new TRD();
		$TRD -> setAccion($Accion);
		$TRD -> set_IdTRD($IdTRD);
		$TRD -> set_ct($CT);
		if($TRD -> Gestionar() == true){
			echo 1;
			exit();
		}
	break;
	case 'GESTIONAR_DISPO_FINAL_E':
		$TRD = new TRD();
		$TRD -> setAccion($Accion);
		$TRD -> set_IdTRD($IdTRD);
		$TRD -> set_e($E);
		if($TRD -> Gestionar() == true){
			echo 1;
			exit();
		}
	break;
	case 'GESTIONAR_DISPO_FINAL_DM':
		$TRD = new TRD();
		$TRD -> setAccion($Accion);
		$TRD -> set_IdTRD($IdTRD);
		$TRD -> set_dm($DM);
		if($TRD -> Gestionar() == true){
			echo 1;
			exit();
		}
	break;
	case 'GESTIONAR_DISPO_FINAL_S':
		$TRD = new TRD();
		$TRD -> setAccion($Accion);
		$TRD -> set_IdTRD($IdTRD);
		$TRD -> set_s($S);
		if($TRD -> Gestionar() == true){
			echo 1;
			exit();
		}
	break;
	case 'EDITAR_SUBSERIE':
		//DESACTIVO TODOS LOA TIPOS DOCUMENTALES ASOCIADOS A LA SUB SERIE

		$SubserieDetalle = new SubSerieDetalle();
		$SubserieDetalle->setAccion(4);
		$SubserieDetalle->setId_SubSerie($IdSubSerie);
		$SubserieDetalle->setActi(0);
		if($SubserieDetalle->Gestionar() === true){
			
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
		}
		echo 1;
		exit();
	break;
	default:
		echo 'No hay accion para realizar.';
}
