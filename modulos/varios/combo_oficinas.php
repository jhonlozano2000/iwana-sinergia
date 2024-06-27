<?php
include "../../config/class.Conexion.php";
require_once "../clases/areas/class.AreasOficina.php";

$Oficinas = Oficina::Listar(8, 0, $_POST['idDepen'], "", "", "");

$id_dependencia = $_REQUEST["idDepen"];

$Combo_Oficinas = "";
$Combo_Oficinas .= "<option value='0'>...::: Elije la Oficina :::...</option>";
foreach ($Oficinas as $Item) :

	$Combo_Oficinas .= "<option value='" . $Item['id_oficina'] . "'>" . $Item['cod_oficina'] . "." . $Item['nom_oficina'] . "</option>";
endforeach;

echo $Combo_Oficinas;
exit();
