<?php
session_start();
require_once "../../../config/class.Conexion.php";
require_once "../../../config/funciones.php";
require_once "../../../config/variable.php";
require_once "../../clases/general/class.GeneralTercero.php";
require_once "../../clases/general/class.GeneralTerceroEmpresa.php";
require_once "../../clases/seguridad/class.SeguridadLog.php";

$Accion        = isset($_POST['accion_tercero']) ? $_POST['accion_tercero'] : null;
$IdContac      = isset($_POST['id_contac']) ? $_POST['id_contac'] : null;
$Nom_Contacto   = isset($_POST['nom_contac']) ? $_POST['nom_contac'] : null;
$Cargo_Contac         = isset($_POST['cargo_tercero']) ? $_POST['cargo_tercero'] : null;
$Dir_Contac    = isset($_POST['dir_contac']) ? $_POST['dir_contac'] : null;
$Telr_Contac   = isset($_POST['tel_contac']) ? $_POST['tel_contac'] : null;
$Celr_Contac   = isset($_POST['cel_contac']) ? $_POST['cel_contac'] : null;
$Email_Contac = isset($_POST['email_contac']) ? $_POST['email_contac'] : null;


$IdEmpresa     = isset($_POST['multi']) ? $_POST['multi'] : $_POST['id_empre'];
$Nit           = isset($_POST['nit']) ? $_POST['nit'] : null;
$RazonSocial   = isset($_POST['razo_soci']) ? $_POST['razo_soci'] : null;
$IdDepar_Empre = isset($_POST['id_depar_empresa']) ? $_POST['id_depar_empresa'] : null;
$IdMuni_Empre  = isset($_POST['id_muni_empresa']) ? $_POST['id_muni_empresa'] : null;
$Dir_Empre     = isset($_POST['dir_empresa']) ? $_POST['dir_empresa'] : null;
$Tel_Empre     = isset($_POST['tel_empresa']) ? $_POST['tel_empresa'] : null;
$Cel_Empre     = isset($_POST['cel_empresa']) ? $_POST['cel_empresa'] : null;
$Fax_Empre     = isset($_POST['fax_empresa']) ? $_POST['fax_empresa'] : null;
$Email_Empre   = isset($_POST['email_empresa']) ? $_POST['email_empresa'] : null;
$Web_Empre     = isset($_POST['web_empresa']) ? $_POST['web_empresa'] : null;
echo "OK ".$Dir_Contac;
exit();
switch($Accion){
	case 'NUEVO_TERCERO':
		$TerceroBuscarContacto = Tercero::Buscar(6, 0, $IdEmpresa , "", "", "", $NomContacto);
		if($TerceroBuscarContacto){
			echo "Ya se encuentra registrado en el sistema un contacto con el nombre ".$NomContacto. " para esta empresa";
			exit();
		}

		$Tercero = new Tercero();
		$Tercero -> set_Accion('NUEVO_TERCERO_NATURAL');
		$Tercero -> setId_Empresa($IdEmpresa);
		$Tercero -> setNom_Contacto($Nom_Contacto);
		$Tercero -> set_Cargo($Cargo_Contac);
		$Tercero -> set_Tel($Telr_Contac);
		$Tercero -> set_Cel($Celr_Contac);
		$Tercero -> set_Email($Email_Contac);
		if($Tercero -> Gestionar() == "true"){
			
			$Empresa = TerceroEmpresa::Buscar(2, $IdEmpresa, "", "", "", "");
			
			/****************************************************************************************
			/* INSERTO EL LOG DE LA TRANSACCION
			/****************************************************************************************/
			$RegistroLog = "El usuario inserto el tercero juridico ".$NomContacto.", Con el cargo ".$Cargo.", de la empresa ".$Empresa->get_RazonSocial();
			$Log = new Log();
			$Log->set_Accion('INSERTAR_REGISTRO');
			$Log->set_IdUsuario($_SESSION['SesionUsuaId']);
			$Log->set_Modulo('Ventanilla->Tercero Juridico');
			$Log->set_FecHorRegistro(Fecha_Hora_Actual());
			$Log->set_Equipo(EQUIPO_REMOTO);
			$Log->set_IP(getRealIP());
			$Log->set_AccionUsuario('Agregar');
			$Log->set_Detalle($RegistroLog);
			$Log->Gestionar();

			echo "1-".$Tercero->getId_Remite()."-".$Empresa->get_Nit()."-". $NomContacto."-".$Empresa->get_RazonSocial()."-".$Empresa->get_Dir()."-".$Empresa->get_Tel()."-".$Empresa->get_Cel();
				exit();	
		}
	break;
	case 'EDITAR_TERCERO':

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
		if($Empresa -> Gestionar() == "true"){

			$Tercero = new Tercero();
			$Tercero -> set_Accion('NUEVO_TERCERO_NATURAL');
			$Tercero -> setId_Empresa($IdEmpresa);
			$Tercero -> setNom_Contacto($Nom_Contacto);
			$Tercero -> set_Cargo($Cargo);
			$Tercero -> set_Tel($Telr_Contac);
			$Tercero -> set_Cel($Celr_Contac);
			$Tercero -> set_Email($Email_Contac);
			$Tercero -> Gestionar();

			/****************************************************************************************
			/* INSERTO EL LOG DE LA TRANSACCION
			/****************************************************************************************/
			$RegistroLog = "El usuario edito el tercero juridico ".$NomContacto.", Con el cargo ".$Cargo.", de la empresa ".$RazonSocial;
			$Log = new Log();
			$Log->set_Accion('INSERTAR_REGISTRO');
			$Log->set_IdUsuario($_SESSION['SesionUsuaId']);
			$Log->set_Modulo('Ventanilla->Tercero Juridico');
			$Log->set_FecHorRegistro(Fecha_Hora_Actual());
			$Log->set_Equipo(EQUIPO_REMOTO);
			$Log->set_IP(getRealIP());
			$Log->set_AccionUsuario('Agregar');
			$Log->set_Detalle($RegistroLog);
			$Log->Gestionar();

			echo 1;
			exit();
		}
	break;
	default:
		echo 'No hay accion para realizar.'.$Accion;
	break;
}
?>