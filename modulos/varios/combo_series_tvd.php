<?php
include "../../config/class.Conexion.php";
require_once '../clases/oficina_archivo/tvd/calss.TVD.php';

$id_dependencia    = $_REQUEST["id_depen"];
$id_oficina        = $_REQUEST["id_oficina"];
$IncluirOficinaTRD = isset($_REQUEST["IncluirOficinaTRD"]) ? $_REQUEST["IncluirOficinaTRD"] : NULL;
$Combo_Series      = "";

//echo "Id. Depen: ".$id_dependencia." --- Incluir Oficina: ".$IncluirOficinaTRD." --- Id. Oficina: ".$id_oficina;
//exit();
if($IncluirOficinaTRD == 1){
	$TVD = TVD::Listar(6, 0, $id_dependencia, 0, 0);
}elseif($IncluirOficinaTRD == 2){
	$TVD = TVD::Listar(13, 0, $id_dependencia, $id_oficina, 0);
}

$Combo_Series.= "<option value='0'>...::: Serie :::...</option>";

foreach($TVD as $Item):
	$Combo_Series.= "<option value='".$Item['id_serie']."'>".$Item['cod_serie'].".".$Item['nom_serie']."</option>";
endforeach;

echo $Combo_Series;
exit();
?>