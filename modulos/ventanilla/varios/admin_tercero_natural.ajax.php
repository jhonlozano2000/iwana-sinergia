<?php
session_start();
require_once "../../../config/class.Conexion.php";
require_once "../../clases/general/class.GeneralTercero.php";
require_once "../../../config/funciones.php";
require_once "../../../config/variable.php";

$Accion         = isset($_POST['accion_remite']) ? $_POST['accion_remite'] : null;
$IdTercero      = isset($_POST['id_tercero_natural']) ? $_POST['id_tercero_natural'] : null;
$IdEmpresa      = isset($_POST['id_empre_juridico']) ? $_POST['id_empre_juridico'] : null;
$IdDepartamento = isset($_POST['id_depar_natural']) ? $_POST['id_depar_natural'] : null;
$IdMuncipio     = isset($_POST['id_muni_natural']) ? $_POST['id_muni_natural'] : null;
$NumDocumento   = isset($_POST['num_docu_natural']) ? $_POST['num_docu_natural'] : null;
$NomContacto    = isset($_POST['nom_contac_natural']) ? $_POST['nom_contac_natural'] : null;
$Cargo          = isset($_POST['cargo_natural']) ? $_POST['cargo_natural'] : null;
$Dir            = isset($_POST['dir_natural']) ? $_POST['dir_natural'] : null;
$Tel            = isset($_POST['tel_natural']) ? $_POST['tel_natural'] : null;
$Cel            = isset($_POST['cel_natural']) ? $_POST['cel_natural'] : null;
$Fax            = isset($_POST['fax_natural']) ? $_POST['fax_natural'] : null;
$Email          = isset($_POST['email_natural']) ? $_POST['email_natural'] : null;

switch ($Accion){
	case 'NUEVO_TERCERO_NATURAL':

		$TerceroBusNumDocumento = Tercero::Buscar(4, 0, 0, "", "", $NumDocumento, "");
		if($TerceroBusNumDocumento){
			echo "Ya se encuentra registrado en el sistema un Tercero con la Cedula ó Nit.: ".$NumDocumento;
			exit();
		}

		$TerceroBusNombre = Tercero::Buscar(3, 0, 0, "", "", "", $NomContacto);
		if($TerceroBusNombre){
			echo "Ya se encuentra registrado en el sistema un Tercero con el nombre: ".$NomContacto;
			exit();
		}

		$Tercero = new Tercero();
		$Tercero -> set_Accion($Accion);
		$Tercero -> setId_Reite($IdTercero);
		$Tercero -> setId_Depar($IdDepartamento);
		$Tercero -> setId_Muni($IdMuncipio);
		$Tercero -> setNum_Documetno($NumDocumento);
		$Tercero -> setNom_Contacto($NomContacto);
		$Tercero -> set_Cargo($Cargo);
		$Tercero -> set_Dir(str_replace("#", "No.", $Dir));
		$Tercero -> set_Tel($Tel);
		$Tercero -> set_Cel($Cel);
		$Tercero -> set_Fax($Fax);
		$Tercero -> set_Email($Email);
		$Tercero -> Gestionar();
		echo "IdRemite".$Tercero->getId_Remite();
		exit();
	break;
	case 'EDITAR_TERCERO_NATURAL':
		$Tercero = new Tercero();
		$Tercero -> set_Accion($Accion);
		$Tercero -> setId_Reite($IdTercero);
		$Tercero -> setId_Depar($IdDepartamento);
		$Tercero -> setId_Muni($IdMuncipio);
		$Tercero -> setNum_Documetno($NumDocumento);
		$Tercero -> setNom_Contacto($NomContacto);
		$Tercero -> set_Cargo($Cargo);
		$Tercero -> set_Dir($Dir);
		$Tercero -> set_Tel($Tel);
		$Tercero -> set_Cel($Cel);
		$Tercero -> set_Fax($Fax);
		$Tercero -> set_Email($Email);
		if($Tercero -> Gestionar() == true){
			echo 1;
			exit();
		}
	break;
	default:
		echo 'No hay accion para realizar.'.$Accion;
	break;
}
?>