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
$MiEmpresa->set_Accion($AccionEmpresa);
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

$accion_otras              = isset($_POST['accion_otras']) ? $_POST['accion_otras'] : null;
$corres_recibida_titulo    = isset($_POST['corres_recibida_titulo']) ? $_POST['corres_recibida_titulo'] : null;
$corres_recibida_subtitulo = isset($_POST['corres_recibida_subtitulo']) ? $_POST['corres_recibida_subtitulo'] : null;
$corres_recibida_codigo    = isset($_POST['corres_recibida_codigo']) ? $_POST['corres_recibida_codigo'] : null;
$corres_recibida_version   = isset($_POST['corres_recibida_version']) ? $_POST['corres_recibida_version'] : null;

$corres_enviada_titulo     = isset($_POST['corres_enviada_titulo']) ? $_POST['corres_enviada_titulo'] : null;
$corres_enviada_subtitulo  = isset($_POST['corres_enviada_subtitulo']) ? $_POST['corres_enviada_subtitulo'] : null;
$corres_enviada_codigo     = isset($_POST['corres_enviada_codigo']) ? $_POST['corres_enviada_codigo'] : null;
$corres_enviada_version    = isset($_POST['corres_enviada_version']) ? $_POST['corres_enviada_version'] : null;

$corres_interna_titulo     = isset($_POST['corres_interna_titulo']) ? $_POST['corres_interna_titulo'] : null;
$corres_interna_subtitulo  = isset($_POST['corres_interna_subtitulo']) ? $_POST['corres_interna_subtitulo'] : null;
$corres_interna_codigo     = isset($_POST['corres_interna_codigo']) ? $_POST['corres_interna_codigo'] : null;
$corres_interna_version    = isset($_POST['corres_interna_version']) ? $_POST['corres_interna_version'] : null;

$planti_correspondencia    = isset($_FILES['plantilla_comunicaciones']['name']) ? $_FILES['plantilla_comunicaciones']['name'] : null;
$hc_titulo                 = isset($_POST['hc_titulo']) ? $_POST['hc_titulo'] : null;
$hc_subtitulo              = isset($_POST['hc_subtitulo']) ? $_POST['hc_subtitulo'] : null;
$hc_codigo                 = isset($_POST['hc_codigo']) ? $_POST['hc_codigo'] : null;
$hc_version                = isset($_POST['hc_version']) ? $_POST['hc_version'] : null;
$hc_num_dias               = isset($_POST['hc_num_dias']) ? $_POST['hc_num_dias'] : null;
$hc_depen                  = isset($_POST['id_depen']) ? $_POST['id_depen'] : null;
$hc_serie                  = isset($_POST['id_serie']) ? $_POST['id_serie'] : null;
$hc_subserie               = isset($_POST['id_subserie']) ? $_POST['id_subserie'] : null;
$hc_tipodoc                = isset($_POST['id_tipodoc']) ? $_POST['id_tipodoc'] : null;
$incluir_trd               = isset($_POST['incluir_trd']) ? $_POST['incluir_trd'] : null;
$incluir_oficina_trd       = isset($_POST['incluir_oficina_trd']) ? $_POST['incluir_oficina_trd'] : null;
$tipo_radica_recibi        = isset($_POST['tipo_radica_recibi']) ? $_POST['tipo_radica_recibi'] : null;
$tipo_radica_enviada       = isset($_POST['tipo_radica_enviada']) ? $_POST['tipo_radica_enviada'] : null;
$tipo_radica_interna       = isset($_POST['tipo_radica_interna']) ? $_POST['tipo_radica_interna'] : null;
$tipo_impre_torulo         = isset($_POST['tipo_impre_torulo']) ? $_POST['tipo_impre_torulo'] : null;

$email_ventanilla_usuario = isset($_POST['email_ventanilla_usuario']) ? $_POST['email_ventanilla_usuario'] : null;
$email_ventanilla_contra   = isset($_POST['email_ventanilla_contra']) ? $_POST['email_ventanilla_contra'] : null;
$mail_ventanilla_servidor = isset($_POST['mail_ventanilla_servidor']) ? $_POST['mail_ventanilla_servidor'] : null;
$email_ventanilla_puerto   = isset($_POST['email_ventanilla_puerto']) ? $_POST['email_ventanilla_puerto'] : null;
$email_ventanilla_autenti   = isset($_POST['email_ventanilla_autenti']) ? $_POST['email_ventanilla_autenti'] : null;

if ($incluir_trd == 'true') {
	$incluir_trd = 1;
} else {
	$incluir_trd = 0;
}

if ($incluir_oficina_trd == 'true') {
	$incluir_oficina_trd = 1;
} else {
	$incluir_oficina_trd = 2;
}

$ConfigOtras = new ConfigOtras();
$ConfigOtras->set_Accion($accion_otras);
$ConfigOtras->set_CoresReciTitulo($corres_recibida_titulo);
$ConfigOtras->set_CoresReciSubTitulo($corres_recibida_subtitulo);
$ConfigOtras->set_CoresReciCodigo($corres_recibida_codigo);
$ConfigOtras->set_CoresReciVersion($corres_recibida_version);
$ConfigOtras->set_CoresEnviaTitulo($corres_enviada_titulo);
$ConfigOtras->set_CoresEnviaSubTitulo($corres_enviada_subtitulo);
$ConfigOtras->set_CoresEnviaCodigo($corres_enviada_codigo);
$ConfigOtras->set_CoresEnviaVersion($corres_enviada_version);
$ConfigOtras->set_CoresInternaTitulo($corres_interna_titulo);
$ConfigOtras->set_CoresInternaSubTitulo($corres_interna_subtitulo);
$ConfigOtras->set_CoresInternaCodigo($corres_interna_codigo);
$ConfigOtras->set_CoresInternaVersion($corres_interna_version);
$ConfigOtras->set_HC_Titulo($hc_titulo);
$ConfigOtras->set_HC_SubTitulo($hc_subtitulo);
$ConfigOtras->set_Incluir_TRD($incluir_trd);
$ConfigOtras->set_Incluir_Oficina_TRD($incluir_oficina_trd);
$ConfigOtras->set_TipoRadicadRecibida($tipo_radica_recibi);
$ConfigOtras->set_TipoRadicadEnviada($tipo_radica_enviada);
$ConfigOtras->set_TipoRadicadInterna($tipo_radica_interna);
$ConfigOtras->set_TipoImpresionRotulo($tipo_impre_torulo);
$ConfigOtras->set_EmailVentanillaUsuario($email_ventanilla_usuario);
$ConfigOtras->set_EmailVentanillaContra($email_ventanilla_contra);
$ConfigOtras->set_EmailVentanillaServidor($mail_ventanilla_servidor);
$ConfigOtras->set_EmailVentanillaPuerto($email_ventanilla_puerto);
$ConfigOtras->set_EmailVentanillaAutenti($email_ventanilla_autenti);

$ConfigOtras->Gestionar();

if (!is_dir("../../../archivos/otros/"))
	mkdir("../../../archivos/otros/", 0777);

//SUBIR LOGO
if ($_FILES["logo_empresa"]['name'] != "") {
	$extension = end(explode(".", $_FILES['logo_empresa']['name']));
	if (move_uploaded_file($_FILES['logo_empresa']['tmp_name'], '../../../archivos/otros/logo_empresa.' . $extension)) {
		$MiEmpresa->set_Accion(2);
		$MiEmpresa->set_Logo('logo_empresa.' . $extension);
		$MiEmpresa->Gestionar();
	}
}

//SUBIR PLANTILLA PARA RESPUESTA A COMUNICACIONES
if ($_FILES["plantilla_comunicaciones"]['name'] != "") {

	$Ruta = MI_ROOT_RELATIVA . "/archivos/otros";
	if (!is_dir($Ruta))
		mkdir($Ruta, 0777);

	$extension = end(explode(".", $_FILES['plantilla_comunicaciones']['name']));
	if (move_uploaded_file($_FILES['plantilla_comunicaciones']['tmp_name'], $Ruta . "/" . $_FILES['plantilla_comunicaciones']['name'])) {
		$ConfigOtras->set_Accion(2);
		$ConfigOtras->set_PlantiCorrespon($_FILES['plantilla_comunicaciones']['name']);
		$ConfigOtras->Gestionar();
	}
}

echo 1;
