<?php
require_once '../../../config/class.Conexion.php';
require_once '../../clases/general/class.GeneralFuncionario.php';
require_once '../../clases/general/class.GeneralFuncionarioDetalle.php';

$Accion           = isset($_POST['accion']) ? $_POST['accion'] : null;
$id_funcio        = isset($_POST['id_funcio']) ? $_POST['id_funcio'] : null;
$id_funcio_deta   = isset($_POST['id_funcio_deta']) ? $_POST['id_funcio_deta'] : null;
$id_muni          = isset($_POST['id_muni']) ? $_POST['id_muni'] : null;
$id_depar         = isset($_POST['id_depar']) ? $_POST['id_depar'] : null;
$Id_Dependencia   = isset($_POST['id_depen_funcio']) ? $_POST['id_depen_funcio'] : null;
$id_oficina       = isset($_POST['id_oficina_funcio']) ? $_POST['id_oficina_funcio'] : null;
$id_cargo         = isset($_POST['id_cargo_funcio']) ? $_POST['id_cargo_funcio'] : null;
$propie_princi    = isset($_POST['propie_princi']) ? 1 : 0;
$jefe_dependencia = isset($_POST['jefe_dependencia']) ? 1 : 0;
$jefe_oficina     = isset($_POST['jefe_oficina']) ? 1 : 0;
$puede_firmar     = isset($_POST['puede_firmar']) ? 1 : 0;
$crea_expedien    = isset($_POST['crea_expedien']) ? 1 : 0;
$cod_funcio       = isset($_POST['cod_funcio']) ? $_POST['cod_funcio'] : null;
$nom_funcio       = isset($_POST['nom_funcio']) ? $_POST['nom_funcio'] : null;
$ape_funcio       = isset($_POST['ape_funcio']) ? $_POST['ape_funcio'] : null;
$genero           = isset($_POST['genero']) ? $_POST['genero'] : null;
$dir              = isset($_POST['dir']) ? $_POST['dir'] : null;
$tel              = isset($_POST['tel']) ? $_POST['tel'] : null;
$cel              = isset($_POST['cel']) ? $_POST['cel'] : null;
$email            = isset($_POST['email']) ? $_POST['email'] : null;

switch ($Accion) {
    case 'INSERTAR':

        if ($jefe_dependencia === 1) {
            $BuscarFuncionarioJefe = Funcionario::Buscar(7, 0, "", "", "", $Id_Dependencia, 0, 0);
            if ($BuscarFuncionarioJefe) {
                echo "Ya se encuentra registrado el Jefe de Área para esta dependencia";
                exit();
            }
        }

        $BuscarFuncionarioCod    = Funcionario::Buscar(4, 0, $cod_funcio, $nom_funcio, $ape_funcio, 0, 0, 0);
        $BuscarFuncionarioNombre = Funcionario::Buscar(3, 0, $cod_funcio, $nom_funcio, $ape_funcio, 0, 0, 0);

        if ($BuscarFuncionarioCod) {
            echo "Ya se encuentra registrado en el sistema un Funcionario con el Código ó C.c.: " . $cod_funcio;
            exit();
        } elseif ($BuscarFuncionarioNombre) {
            echo "Ya se encuentra registrado en el sistema un Funcionario con los nombres " . $nom_funcio . " " . $ape_funcio;
            exit();
        } else {
            $Funcionario = new Funcionario();
            $Funcionario->setAccion($Accion);
            $Funcionario->setId_Funcio($id_funcio);
            $Funcionario->setCod_Funcio($cod_funcio);
            $Funcionario->setNom_Funcio($nom_funcio);
            $Funcionario->setApe_Funcio($ape_funcio);
            $Funcionario->setGenero($genero);
            $Funcionario->setPropiePrinci($propie_princi);
            $Funcionario->setJefeDependenci($jefe_dependencia);
            $Funcionario->setJefeOficina($jefe_oficina);
            $Funcionario->setCreaExpediente($crea_expedien);
            $Funcionario->setPuedeFirmar($puede_firmar);
            $Funcionario->setId_Depar($id_depar);
            $Funcionario->setId_Muni($id_muni);
            $Funcionario->setDir($dir);
            $Funcionario->setTel($tel);
            $Funcionario->setCel($cel);
            $Funcionario->setEmail($email);
            if ($Funcionario->Gestionar() === true) {

                //ACTUALIZO EL DETALLE DEL FUNCIONARIO, PRIMERO DESACTIVO LOS DETALLES ACTUALES
                //SI EL NUEVO DETALLE NO EXISTE LO INSERTO DE LO CONTRARIO LO ACTIVO
                $BuscarDetalle = FuncionarioDetalle::Buscar(3, $Funcionario->getId_Funcio(), "", $id_oficina, $id_cargo);
                if (!$BuscarDetalle) {

                    $FuncionarioDetalle = new FuncionarioDetalle();
                    $FuncionarioDetalle->setAccion("INSERTAR");
                    $FuncionarioDetalle->setId_Funcio($Funcionario->getId_Funcio());
                    $FuncionarioDetalle->setId_Ofi($id_oficina);
                    $FuncionarioDetalle->setId_Cargo($id_cargo);
                    $FuncionarioDetalle->setActi(1);
                    $FuncionarioDetalle->Gestionar();
                } else {
                    $FuncionarioDetalle = new FuncionarioDetalle();
                    $FuncionarioDetalle->setAccion("INACTIVAR");
                    $FuncionarioDetalle->setId_Funcio($Funcionario->getId_Funcio());
                    $FuncionarioDetalle->Gestionar();

                    $FuncionarioDetalle->setAccion("ACTIVAR");
                    $FuncionarioDetalle->setId_Ofi($id_oficina);
                    $FuncionarioDetalle->setId_Cargo($id_cargo);
                    $FuncionarioDetalle->setActi(1);
                    $FuncionarioDetalle->Gestionar();
                }

                echo 1;
            }
        }
        break;
    default:
        echo 'No hay accion para realizar.';
}
