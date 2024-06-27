<?php
include "../../config/class.Conexion.php";
include "../clases/general/class.GeneralTerceroEmpresa.php";

$IdEmpresa = $_POST['IdEmpresa'];

$Empresa = TerceroEmpresa::Buscar(2, $IdEmpresa, "", "", "", "");
if($Empresa){
	echo "1***".$Empresa->getId_Empresa()."***".$Empresa->getId_Depar()."***".$Empresa->getId_Muni()."***".$Empresa->get_Nit()."***".$Empresa->get_RazonSocial()."***".$Empresa->get_Dir()."***".$Empresa->get_Tel()."***".$Empresa->get_Cel()."***".$Empresa->get_Fax()."***".$Empresa->get_Email()."***".$Empresa->get_Web();
	exit();
}else{
	echo "No hay registros";
	exit();
}


?>