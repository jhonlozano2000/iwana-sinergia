<?php
require_once "../../../config/class.Conexion.php";
require_once "../../../config/variable.php";
require_once "../../clases/configuracion/class.ConfigMiEmpresa.php";
require_once "../../clases/configuracion/class.ConfigOtras.php";

$AccionEmpresa = isset($_POST['accion_empresa']) ? $_POST['accion_empresa'] : null;
$nit           = isset($_POST['nit']) ? $_POST['nit'] : null;
$id_depar      = isset($_POST['id_depar']) ? $_POST['id_depar'] : null;
$id_muni       = isset($_POST['id_muni']) ? $_POST['id_muni'] : null;
$razo_soci     = isset($_POST['razo_soci']) ? $_POST['razo_soci'] : null;
$slogan        = isset($_POST['slogan']) ? $_POST['slogan'] : null;
$dir           = isset($_POST['dir']) ? $_POST['dir'] : null;
$tel           = isset($_POST['tel']) ? $_POST['tel'] : null;
$cel           = isset($_POST['cel']) ? $_POST['cel'] : null;
$email         = isset($_POST['email']) ? $_POST['email'] : null;
$web           = isset($_POST['web']) ? $_POST['web'] : null;
$logo          = isset($_FILES["logo_empresa"]['name']) ? $_FILES["logo_empresa"]['name'] : null;


$MiEmpresa = new MiEmpresa();
$buscarEmpresa = MiEmpresa::Buscar();
if ($buscarEmpresa) {
    $MiEmpresa->set_Accion(1);
} else {
    $MiEmpresa->set_Accion(0);
}
$MiEmpresa->setId_Depar($id_depar);
$MiEmpresa->setId_Muni($id_muni);
$MiEmpresa->set_Nit($nit);
$MiEmpresa->set_RazonSocial($razo_soci);
$MiEmpresa->set_Slogan($slogan);
$MiEmpresa->set_Dir($dir);
$MiEmpresa->set_Tel($tel);
$MiEmpresa->set_Cel($cel);
$MiEmpresa->set_Email($email);
$MiEmpresa->set_Web($web);
$MiEmpresa->Gestionar();


$tipo_radica_recibi        = isset($_POST['tipo_radica_recibi']) ? $_POST['tipo_radica_recibi'] : null;
$tipo_radica_enviada       = isset($_POST['tipo_radica_enviada']) ? $_POST['tipo_radica_enviada'] : null;
$tipo_radica_interna       = isset($_POST['tipo_radica_interna']) ? $_POST['tipo_radica_interna'] : null;
$tipo_impre_torulo         = isset($_POST['tipo_impre_torulo']) ? $_POST['tipo_impre_torulo'] : null;

$ConfigOtras = new ConfigOtras();
$ConfigOtras->set_Accion(1);
$ConfigOtras->set_TipoRadicadRecibida($tipo_radica_recibi);
$ConfigOtras->set_TipoRadicadEnviada($tipo_radica_enviada);
$ConfigOtras->set_TipoRadicadInterna($tipo_radica_interna);
$ConfigOtras->set_TipoImpresionRotulo($tipo_impre_torulo);
$ConfigOtras->Gestionar();

echo 1;
