<?php
session_start();
require_once "../../../config/class.Conexion.php";
require_once "../../clases/general/class.GeneralTerceroEmpresa.php";
require_once "../../clases/general/class.GeneralTercero.php";
require_once "../../../config/funciones.php";
require_once "../../../config/variable.php";

$Accion         = isset($_POST['accion_remite_juridico']) ? $_POST['accion_remite_juridico'] : null;
$IdDepartamento = isset($_POST['id_depar_juridico_empresa']) ? $_POST['id_depar_juridico_empresa'] : null;
$IdMuncipio     = isset($_POST['id_muni_juridico_empresa']) ? $_POST['id_muni_juridico_empresa'] : null;
$Nit            = isset($_POST['nit']) ? $_POST['nit'] : null;
$RazonSocial    = isset($_POST['razo_soci']) ? $_POST['razo_soci'] : null;
$Dir            = isset($_POST['dir_juridico_empresa']) ? $_POST['dir_juridico_empresa'] : null;
$Tel            = isset($_POST['tel_juridico_empresa']) ? $_POST['tel_juridico_empresa'] : null;
$Cel            = isset($_POST['cel_juridico_empresa']) ? $_POST['cel_juridico_empresa'] : null;
$Fax            = isset($_POST['fax_juridico_empresa']) ? $_POST['fax_juridico_empresa'] : null;
$Email          = isset($_POST['email_juridico_empresa']) ? $_POST['email_juridico_empresa'] : null;
$Web            = isset($_POST['web_juridico_empresa']) ? $_POST['web_juridico_empresa'] : null;
$NomContacto    = isset($_POST['nom_contac_juridico_empresa']) ? $_POST['nom_contac_juridico_empresa'] : null;
$Cargo          = isset($_POST['cargo_juridico_empresa']) ? $_POST['cargo_juridico_empresa'] : null;
$Dir_Contac     = isset($_POST['dir_contac_juridico_empresa']) ? $_POST['dir_contac_juridico_empresa'] : null;
$Telr_Contac    = isset($_POST['tel_contac_juridico_empresa']) ? $_POST['tel_contac_juridico_empresa'] : null;
$Celr_Contac    = isset($_POST['cel_contac_juridico_empresa']) ? $_POST['cel_contac_juridico_empresa'] : null;
$Emailr_Contac  = isset($_POST['email_contac_juridico_empresa']) ? $_POST['email_contac_juridico_empresa'] : null;

switch ($Accion){
	case 'NUEVO_TERCERO_JURIDICO_CON_EMPRESA':
		
		$EmpresaBuscarNit = TerceroEmpresa::Buscar(3, 0, $Nit, "", "", "");
		if($EmpresaBuscarNit){
			echo "Ya se encuentra registrado en el sistema el Nit  ".$RazonSocial;
			exit();
		}

		$EmpresaBuscarRazonSocial = TerceroEmpresa::Buscar(1, 0, "", $RazonSocial, "", "");
		if($EmpresaBuscarRazonSocial){
			echo "Ya se encuentra registrado en el sistema una empresa de contacto con la Razón Social ".$RazonSocial;
			exit();
		}

		$Empresa = new TerceroEmpresa();
		$Empresa -> set_Accion('NUEVO');
		$Empresa -> setId_Depar($IdDepartamento);
		$Empresa -> setId_Muni($IdMuncipio);
		$Empresa -> set_Nit($Nit);
		$Empresa -> set_RazonSocial($RazonSocial);
		$Empresa -> set_Dir($Dir);
		$Empresa -> set_Tel(str_replace("#", "No.", $Tel));
		$Empresa -> set_Cel($Cel);
		$Empresa -> set_Fax($Fax);
		$Empresa -> set_Email($Email);
		$Empresa -> set_Web($Web);
		if($Empresa -> Gestionar() == true){

			$Tercero = new Tercero();
			$Tercero -> set_Accion('NUEVO_TERCERO_NATURAL');
			$Tercero -> setId_Empresa($Empresa -> getId_Empresa());
			$Tercero -> setNom_Contacto($NomContacto);
			$Tercero -> set_Cargo($Cargo);
			$Tercero -> set_Tel($Telr_Contac);
			$Tercero -> set_Cel($Celr_Contac);
			$Tercero -> set_Email($Emailr_Contac);
			$Tercero -> Gestionar();
			
			echo "IdRemite".$Tercero -> getId_Remite();
			echo 1;
		}
		exit();
	break;
	default:
		echo 'No hay accion para realizar.'.$Accion;
	break;
}
?>