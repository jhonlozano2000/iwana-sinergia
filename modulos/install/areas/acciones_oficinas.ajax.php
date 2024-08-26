<?php
require_once '../../../config/class.Conexion.php';
require_once '../../clases/areas/class.AreasOficina.php';

$Accion              = isset($_POST['accion']) ? $_POST['accion'] : null;
$Id_Oficina          = isset($_POST['id_oficina']) ? $_POST['id_oficina'] : null;
$Id_Dependencia      = isset($_POST['id_depen_oficina']) ? $_POST['id_depen_oficina'] : null;
$Cod_Oficina         = isset($_POST['cod_oficina']) ? $_POST['cod_oficina'] : null;
$Cod_Correspondencia = isset($_POST['cod_corres_oficina']) ? $_POST['cod_corres_oficina'] : null;
$Nom_Oficina         = isset($_POST['nom_oficina']) ? $_POST['nom_oficina'] : null;
$Observa             = isset($_POST['observa_oficina']) ? $_POST['observa_oficina'] : null;

switch ($Accion) {
    case 'Insertar':
        $Oficina = new Oficina();
        $Oficina->setId_Oficina($Id_Oficina);
        $Oficina->setId_Dependencia($Id_Dependencia);
        $Oficina->setCod_Correspondencia($Cod_Correspondencia);
        $Oficina->setCod_Oficina($Cod_Oficina);
        $Oficina->setNom_Oficina($Nom_Oficina);
        $Oficina->setObserva($Observa);
        $Oficina->guardar();
        break;
    default:
        echo 'No hay accion para realizar.';
}
