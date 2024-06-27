<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	require_once "../../../config/class.Conexion.php";
	require_once "../../../config/funciones.php";
	require_once "../../../config/variable.php";
	require_once "../../clases/general/class.GeneralTercero.php";
	require_once "../../clases/general/class.GeneralTerceroEmpresa.php";

	$Accion          = isset($_POST['accion']) ? $_POST['accion'] : null;
	$IdContac        = isset($_POST['id_contac']) ? $_POST['id_contac'] : null;
	$IdDeparContacto = isset($_POST['id_depar_contac']) ? $_POST['id_depar_contac'] : null;
	$IdMuniContacto  = isset($_POST['id_muni_contac']) ? $_POST['id_muni_contac'] : null;
	$NumDocumento    = isset($_POST['num_docu_contac']) ? $_POST['num_docu_contac'] : null;
	$NomContacto     = isset($_POST['nom_contac']) ? $_POST['nom_contac'] : null;
	$CargoContacto   = isset($_POST['cargo_contac']) ? $_POST['cargo_contac'] : null;
	$DirContacto     = isset($_POST['dir_contac']) ? $_POST['dir_contac'] : null;
	$TelContacto     = isset($_POST['tel_contac']) ? $_POST['tel_contac'] : null;
	$CelContacto     = isset($_POST['cel_contac']) ? $_POST['cel_contac'] : null;
	$FaxContacto     = isset($_POST['fax_contac']) ? $_POST['fax_contac'] : null;
	$EmailContacto   = isset($_POST['email_contac']) ? $_POST['email_contac'] : null;

	$IdEmpresa    = isset($_POST['id_empre']) ? $_POST['id_empre'] : null;
	$IdDeparEmpre = isset($_POST['id_depar_empre']) ? $_POST['id_depar_empre'] : null;
	$IdMuniEmpre  = isset($_POST['id_muni_empre']) ? $_POST['id_muni_empre'] : null;
	$Nit          = isset($_POST['nit']) ? $_POST['nit'] : null;
	$RazonSocial  = isset($_POST['razo_soci']) ? $_POST['razo_soci'] : null;
	$DirEmpre     = isset($_POST['dir_empresa']) ? $_POST['dir_empresa'] : null;
	$TelEmpre     = isset($_POST['tel_empresa']) ? $_POST['tel_empresa'] : null;
	$CelEmpre     = isset($_POST['cel_empresa']) ? $_POST['cel_empresa'] : null;
	$FaxEmpre     = isset($_POST['fax_empresa']) ? $_POST['fax_empresa'] : null;
	$EmailEmpre   = isset($_POST['email_empre']) ? $_POST['email_empre'] : null;
	$WebEmpre     = isset($_POST['web_empresa']) ? $_POST['web_empresa'] : null;

	if ($Accion == 'INSERTAR_EMPRESA') {
		$IdDeparEmpre = isset($_POST['id_depar_nueva_empre']) ? $_POST['id_depar_nueva_empre'] : null;
		$IdMuniEmpre  = isset($_POST['id_muni_nueva_empre']) ? $_POST['id_muni_nueva_empre'] : null;
		$Nit          = isset($_POST['nit_nueva_empre']) ? $_POST['nit_nueva_empre'] : null;
		$RazonSocial  = isset($_POST['razo_soci_nueva_empre']) ? $_POST['razo_soci_nueva_empre'] : null;
		$DirEmpre     = isset($_POST['dir_nueva_empre']) ? $_POST['dir_nueva_empre'] : null;
		$TelEmpre     = isset($_POST['tel_nueva_empre']) ? $_POST['tel_nueva_empre'] : null;
		$CelEmpre     = isset($_POST['cel_nueva_empre']) ? $_POST['cel_nueva_empre'] : null;
		$FaxEmpre     = isset($_POST['fax_nueva_empre']) ? $_POST['fax_nueva_empre'] : null;
		$EmailEmpre   = isset($_POST['email_nueva_empre']) ? $_POST['email_nueva_empre'] : null;
		$WebEmpre     = isset($_POST['web_nueva_empre']) ? $_POST['web_nueva_empre'] : null;
	}

	if ($Accion == 'NUEVO_TERCERO_JURIDICO') {
		$IdEmpresa    = isset($_POST['multi']) ? $_POST['multi'] : null;
		$NomContacto     = isset($_POST['nom_contac_juridico']) ? $_POST['nom_contac_juridico'] : null;
		$CargoContacto   = isset($_POST['cargo_juridico']) ? $_POST['cargo_juridico'] : null;
		$DirContacto     = isset($_POST['dir_contac_juridico']) ? $_POST['dir_contac_juridico'] : null;
		$TelContacto     = isset($_POST['tel_contac_juridico']) ? $_POST['tel_contac_juridico'] : null;
		$CelContacto     = isset($_POST['cel_contac_juridico']) ? $_POST['cel_contac_juridico'] : null;
		$FaxContacto     = isset($_POST['fax_contac_juridico']) ? $_POST['fax_contac_juridico'] : null;
		$EmailContacto   = isset($_POST['email_contac_juridico']) ? $_POST['email_contac_juridico'] : null;
	}

	if (isset($_POST['accion_remite_juridico']) and $_POST['accion_remite_juridico'] == 'NUEVO_TERCERO_JURIDICO_CON_EMPRESA') {
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
	}

	switch ($Accion) {
		case 'NUEVO_TERCERO':
			/*
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

			if($IdEmpresa != null){
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
			}
			*/

			$Tercero = new Tercero();
			$Tercero->set_Accion($Accion);
			$Tercero->setId_Reite($IdContac);
			$Tercero->setId_Depar($IdDeparContacto);
			$Tercero->setId_Muni($IdMuniContacto);
			$Tercero->setNum_Documetno($NumDocumento);
			$Tercero->setNom_Contacto($NomContacto);
			if ($IdEmpresa != null) {
				$Tercero->setId_Empresa($IdEmpresa);
			}
			$Tercero->set_Cargo($CargoContacto);
			$Tercero->set_Dir(str_replace("#", "No.", $DirContacto));
			$Tercero->set_Tel($TelContacto);
			$Tercero->set_Cel($CelContacto);
			$Tercero->set_Fax($FaxContacto);
			$Tercero->set_Email($EmailContacto);

			if ($Tercero->Gestionar() == true) {

				if ($IdEmpresa != null) {
					$Empresa = new TerceroEmpresa();
					$Empresa->set_Accion('NUEVO_TERCERO');
					$Empresa->setId_Depar($IdDeparEmpre);
					$Empresa->setId_Muni($IdMuniEmpre);
					$Empresa->set_Nit($Nit);
					$Empresa->set_RazonSocial($RazonSocial);
					$Empresa->set_Dir($DirEmpre);
					$Empresa->set_Tel(str_replace("#", "No.", $TelEmpre));
					$Empresa->set_Cel($CelEmpre);
					$Empresa->set_Fax($FaxEmpre);
					$Empresa->set_Email($EmailEmpre);
					$Empresa->set_Web($WebEmpre);
				}

				echo "1####" . $Tercero->getId_Remite() . "####" . $Nit;
				exit();
			}

			break;
		case 'EDITAR_TERCERO':

			$Tercero = new Tercero();
			$Tercero->set_Accion($Accion);
			$Tercero->setId_Reite($IdContac);
			$Tercero->setId_Depar($IdDeparContacto);
			$Tercero->setId_Muni($IdMuniContacto);

			if ($IdEmpresa != null) {
				$Tercero->setId_Empresa($IdEmpresa);
			}
			$Tercero->setNum_Documetno($NumDocumento);
			$Tercero->setNom_Contacto($NomContacto);
			$Tercero->set_Cargo($CargoContacto);
			$Tercero->set_Dir($DirContacto);
			$Tercero->set_Tel($TelContacto);
			$Tercero->set_Cel($CelContacto);
			$Tercero->set_Fax($FaxContacto);
			$Tercero->set_Email($EmailContacto);
			if ($Tercero->Gestionar() == true) {

				if ($IdEmpresa != null) {
					$Empresa = new TerceroEmpresa();
					$Empresa->set_Accion('EDITAR');
					$Empresa->setId_Empresa($IdEmpresa);
					$Empresa->setId_Depar($IdDeparEmpre);
					$Empresa->setId_Muni($IdMuniEmpre);
					$Empresa->set_Nit($Nit);
					$Empresa->set_RazonSocial($RazonSocial);
					$Empresa->set_Dir($DirEmpre);
					$Empresa->set_Tel(str_replace("#", "No.", $TelEmpre));
					$Empresa->set_Cel($CelEmpre);
					$Empresa->set_Fax($FaxEmpre);
					$Empresa->set_Email($EmailEmpre);
					$Empresa->set_Web($WebEmpre);
					$Empresa->Gestionar();
				}

				echo 1;
				exit();
			}
			break;
		case 'NUEVO_TERCERO_JURIDICO':

			$Tercero = new Tercero();
			$Tercero->set_Accion('NUEVO_TERCERO');
			$Tercero->setNom_Contacto($NomContacto);
			$Tercero->setId_Empresa($IdEmpresa);
			$Tercero->set_Cargo($CargoContacto);
			$Tercero->set_Dir(str_replace("#", "No.", $DirContacto));
			$Tercero->set_Tel($TelContacto);
			$Tercero->set_Cel($CelContacto);
			$Tercero->set_Fax($FaxContacto);
			$Tercero->set_Email($EmailContacto);
			if ($Tercero->Gestionar() == true) {

				$Empresa = TerceroEmpresa::Buscar(2, $IdEmpresa, "", "", "", "");
				echo "1####" . $Tercero->getId_Remite() . "####" . $Empresa->get_Nit();
				exit();
			}

			break;
		case 'NUEVO_TERCERO_JURIDICO_CON_EMPRESA':

			$EmpresaBuscarNit = TerceroEmpresa::Buscar(3, 0, $Nit, "", "", "");
			if ($EmpresaBuscarNit) {
				echo "Ya se encuentra registrado en el sistema el Nit  " . $RazonSocial;
				exit();
			}

			$EmpresaBuscarRazonSocial = TerceroEmpresa::Buscar(1, 0, "", $RazonSocial, "", "");
			if ($EmpresaBuscarRazonSocial) {
				echo "Ya se encuentra registrado en el sistema una empresa de contacto con la Razón Social " . $RazonSocial;
				exit();
			}

			$Empresa = new TerceroEmpresa();
			$Empresa->set_Accion('NUEVO');
			$Empresa->setId_Depar($IdDepartamento);
			$Empresa->setId_Muni($IdMuncipio);
			$Empresa->set_Nit($Nit);
			$Empresa->set_RazonSocial($RazonSocial);
			$Empresa->set_Dir($Dir);
			$Empresa->set_Tel(str_replace("#", "No.", $Tel));
			$Empresa->set_Cel($Cel);
			$Empresa->set_Fax($Fax);
			$Empresa->set_Email($Email);
			$Empresa->set_Web($Web);
			if ($Empresa->Gestionar() == true) {

				$Tercero = new Tercero();
				$Tercero->set_Accion('NUEVO_TERCERO');
				$Tercero->setId_Empresa($Empresa->getId_Empresa());
				$Tercero->setNom_Contacto($NomContacto);
				$Tercero->set_Cargo($Cargo);
				$Tercero->set_Tel($Telr_Contac);
				$Tercero->set_Cel($Celr_Contac);
				$Tercero->set_Email($Emailr_Contac);
				$Tercero->Gestionar();

				echo "1####" . $Tercero->getId_Remite();
				exit();;
			}
			exit();
			break;
		case 'INSERTAR_EMPRESA':

			$EmpresaBuscarNit = TerceroEmpresa::Buscar(3, 0, $Nit, "", "", "");
			if ($EmpresaBuscarNit) {
				echo "Ya se encuentra registrado en el sistema el Nit  " . $RazonSocial;
				exit();
			}

			$EmpresaBuscarRazonSocial = TerceroEmpresa::Buscar(1, 0, "", $RazonSocial, "", "");
			if ($EmpresaBuscarRazonSocial) {
				echo "Ya se encuentra registrado en el sistema una empresa de contacto con la Razón Social " . $RazonSocial;
				exit();
			}

			$Empresa = new TerceroEmpresa();
			$Empresa->set_Accion('NUEVO');
			$Empresa->setId_Depar($IdDeparEmpre);
			$Empresa->setId_Muni($IdMuniEmpre);
			$Empresa->set_Nit($Nit);
			$Empresa->set_RazonSocial($RazonSocial);
			$Empresa->set_Dir($DirEmpre);
			$Empresa->set_Tel(str_replace("#", "No.", $TelEmpre));
			$Empresa->set_Cel($CelEmpre);
			$Empresa->set_Fax($FaxEmpre);
			$Empresa->set_Email($EmailEmpre);
			$Empresa->set_Web($WebEmpre);
			if ($Empresa->Gestionar() == true) {


				echo "1###" . $Empresa->getId_Empresa();
				exit();
			}
			exit();
			break;
		default:
			echo 'No hay accion para realizar.' . $Accion;
			break;
	}
}
