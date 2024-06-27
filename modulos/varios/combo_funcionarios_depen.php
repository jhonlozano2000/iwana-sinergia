<?php
include "../../config/class.Conexion.php";
require_once "../clases/general/class.GeneralFuncionario.php";

$Funcionario = Funcionario::Listar(17, 0, 0, "", "", $_POST['id_depen'], "", ""); 

$Combo_Funcionarios = "";
$Combo_Funcionarios.= "<option value='0'>...::: Elije el Funcionario :::...</option>";
foreach($Funcionario as $Item):
	$Combo_Funcionarios.= "<option value='".$Item['id_funcio_deta']."'>".$Item['nom_oficina']." - ".$Item['nom_funcio']." ".$Item['ape_funcio']."</option>";
endforeach;

echo $Combo_Funcionarios;
?>