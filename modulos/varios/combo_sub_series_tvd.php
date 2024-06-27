<?php
include "../../config/class.Conexion.php";
require_once '../clases/oficina_archivo/tvd/calss.TVD.php';

$id_serie          = $_REQUEST["id_serie"];
$id_dependencia    = $_REQUEST["id_depen"];
$id_oficina        = $_REQUEST["id_oficina"];
$IncluirOficinaTRD = isset($_REQUEST["IncluirOficinaTRD"]) ? $_REQUEST["IncluirOficinaTRD"] : NULL;
$Combo_Sub_Serie   = "";

//echo "Id. Depen: ".$id_dependencia." --- Incluir Oficina: ".$IncluirOficinaTRD." --- Id. Serie: ".$id_serie." --- Id. Oficina: ".$id_oficina;
//exit();
if($IncluirOficinaTRD == 1){
	$TVD = TVD::Listar(9, 0, $id_dependencia, $id_serie, 0);
}elseif($IncluirOficinaTRD == 2){
	$TVD = TVD::Listar(14, 0, $id_dependencia, $id_serie, $id_oficina);
}

$Combo_Sub_Serie.= "<option value='0'>...::: SubSerie :::...</option>";
if(isset($_REQUEST["id_subserie"])){
	foreach($TVD as $Item):
		if($Item['id_subserie'] == $_REQUEST["id_subserie"]){
			$Combo_Sub_Serie.= "<option value='".$Item['id_subserie']."' selected>".$Item['cod_subserie'].".".$Item['nom_subserie']."</option>";
		}else{
			$Combo_Sub_Serie.= "<option value='".$Item['id_subserie']."'>".$Item['cod_subserie'].".".$Item['nom_subserie']."</option>";
		}
	endforeach;
}else{
	foreach($TVD as $Item):
		$Combo_Sub_Serie.= "<option value='".$Item['id_subserie']."'>".$Item['cod_subserie'].".".$Item['nom_subserie']."</option>";
	endforeach;

}
echo $Combo_Sub_Serie;
?>