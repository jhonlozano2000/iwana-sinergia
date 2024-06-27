<?php
require_once "../../config/class.Conexion.php";
require_once '../clases/general/class.GeneralTercero.php';

$IdEmpresa = isset($_POST['id_empre']) ? $_POST['id_empre'] : null;

$Empresa = Tercero::Listar(10, 0, 0, "", "", "", ""); 
$Combo_Empresa = "";
$Combo_Empresa.= "<option value='0'>...::: Elije la Empresa del contacto :::...</option>";

if($IdEmpresa == ""){
	foreach($Empresa as $Item):
	    $Combo_Empresa.= "<option value='".$Item['id_empre']."'>".($Item['razo_soci'])."</option>";
	endforeach;
}else{
	foreach($Empresa as $Item):
		if($Item['id_empre'] == $IdEmpresa){
			$Combo_Empresa.= "<option value='".$Item['id_empre']."' selected>".($Item['razo_soci'])."</option>";
		}else{
		    $Combo_Empresa.= "<option value='".$Item['id_empre']."'>".($Item['razo_soci'])."</option>";
		}
	endforeach;
}

echo $Combo_Empresa;
?>