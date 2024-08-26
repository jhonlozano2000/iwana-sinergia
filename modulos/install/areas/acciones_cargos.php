<?php
require_once '../../../config/class.Conexion.php';
require_once '../../clases/areas/class.AreasCargo.php';

$Accion         = isset($_POST['accion']) ? $_POST['accion'] : null;
$Id_Cargo       = isset($_POST['id_cargo']) ? $_POST['id_cargo'] : null;
$Id_Dependencia = isset($_POST['id_depen_cargos']) ? $_POST['id_depen_cargos'] : null;
$Nom_Cargo      = isset($_POST['nom_cargo']) ? $_POST['nom_cargo'] : null;
$Observa        = isset($_POST['observa']) ? $_POST['observa'] : null;

switch ($Accion) {
    case 'Insertar':
        $Cargo = new Cargo();
        $Cargo->setId_Cargo($Id_Cargo);
        $Cargo->setId_Dependencia($Id_Dependencia);
        $Cargo->setNom_Cargo($Nom_Cargo);
        $Cargo->setObserva($Observa);
        $Cargo->guardar();
        break;

    default:
        echo 'No hay accion para realizar.';
}
