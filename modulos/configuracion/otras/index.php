<?php
session_start();
require_once '../../../config/variable.php';
require_once '../../../config/funciones.php';
require_once '../../../config/funciones_seguridad.php';
require_once '../../../config/class.Conexion.php';
require_once("../../clases/seguridad/class.SeguridadUsuario.php");
require_once("../../clases/seguridad/class.SeguridadModulo.php");
require_once("../../clases/seguridad/class.SeguridadMostrarBuscar.php");
require_once "../../clases/configuracion/class.ConfigOtras.php";
require_once "../../clases/configuracion/class.ConfigDepartamento.php";
require_once "../../clases/configuracion/class.ConfigMunicipio.php";
require_once "../../clases/configuracion/class.ConfigMiEmpresa.php";
require_once '../../clases/retencion/calss.TRD.php';
require_once "../../clases/configuracion/class.ConfigOtras_Respon_HC.php";
require_once "../../clases/configuracion/class.ConfigOtras_Respon_PQRSF.php";
require_once "../../clases/general/class.GeneralFuncionario.php";

$AccionOtras = "";
$ConfiguracionOtras = ConfigOtras::Buscar(1, "");
if ($ConfiguracionOtras) {
    $AccionOtras = 1;
}

$DatosMiEmpresa = MiEmpresa::Buscar();
if ($DatosMiEmpresa) {

    $AccionEmpresa = 1;

    $Departamento = Departamento::Listar();
    $Combo_Departamentos = "";
    foreach ($Departamento as $Item) :
        if ($Item['id_depar'] == $DatosMiEmpresa->getId_Depar()) {
            $Combo_Departamentos .= "<option value='" . $Item['id_depar'] . "' selected>" . $Item['nom_depar'] . "</option>";
        } else {
            $Combo_Departamentos .= "<option value='" . $Item['id_depar'] . "'>" . $Item['nom_depar'] . "</option>";
        }
    endforeach;

    $Municipios = Municipio::Listar(1, $DatosMiEmpresa->getId_Depar());
    $Combo_Municipios = "";
    foreach ($Municipios as $Item) :
        if ($Item['id_muni'] == $DatosMiEmpresa->getId_Muni()) {
            $Combo_Municipios .= "<option value='" . $Item['id_muni'] . "' selected>" . $Item['nom_muni'] . "</option>";
        } else {
            $Combo_Municipios .= "<option value='" . $Item['id_muni'] . "'>" . $Item['nom_muni'] . "</option>";
        }
    endforeach;

    $EmpreNit      = $DatosMiEmpresa->get_Nit();
    $EmpreRazoSoci = $DatosMiEmpresa->get_RazonSocial();
    $EmpreSlogan   = $DatosMiEmpresa->get_Slogan();
    $EmpreDir      = $DatosMiEmpresa->get_Dir();
    $EmpreTel      = $DatosMiEmpresa->get_Tel();
    $EmpreCel      = $DatosMiEmpresa->get_Cel();
    $EmpreEmail    = $DatosMiEmpresa->get_Email();
    $EmpreWeb      = $DatosMiEmpresa->get_Web();
    $EmpreLogo     = $DatosMiEmpresa->get_Logo();
} else {
    $AccionEmpresa = 0;
    $Departamento = Departamento::Listar();
    $Combo_Departamentos = "";
    foreach ($Departamento as $Item) :
        $Combo_Departamentos .= "<option value='" . $Item['id_depar'] . "'>" . $Item['nom_depar'] . "</option>";
    endforeach;

    $Municipios = Municipio::Listar(1, $DatosMiEmpresa->getId_Depar());
    $Combo_Municipios = "";
    foreach ($Municipios as $Item) :
        if ($Item['id_muni'] == $DatosMiEmpresa->getId_Muni()) {
            $Combo_Municipios .= "<option value='" . $Item['id_muni'] . "' selected>" . $Item['nom_muni'] . "</option>";
        } else {
            $Combo_Municipios .= "<option value='" . $Item['id_muni'] . "'>" . $Item['nom_muni'] . "</option>";
        }
    endforeach;

    $EmpreNit      = "";
    $EmpreRazoSoci = "";
    $EmpreSlogan   = "";
    $EmpreDir      = "";
    $EmpreTel      = "";
    $EmpreCel      = "";
    $EmpreEmail    = "";
    $EmpreWeb      = "";
    $EmpreLogo     = "";

    foreach ($Dependencias as $Item) :
        $Combo_Dependencias .= "<option value='" . $Item['id_depen'] . "'>" . $Item['nom_depen'] . "</option>";
    endforeach;
}

require_once '../../clases/areas/class.AreasDependencia.php';
$Dependencias = Dependencia::Listar(6, "", "", "", "");;
$Combo_Dependencias = "";
$Combo_Series = "";
$Combo_Sub_Serie = "";
$Combo_Tipo_Documento = "";

foreach ($Dependencias as $Item) :
    $Combo_Dependencias .= "<option value='" . $Item['id_depen'] . "'>" . $Item['nom_depen'] . "</option>";
endforeach;

/**
 * Carlo los funcionarios
 */
$Funcionarios = Funcionario::Listar(6, 0, "", "", "", 0, 0, 0);
$Combo_Funcionarios = "";
foreach ($Funcionarios as $Item) :
    $Combo_Funcionarios .= "<option value='" . $Item['id_funcio_deta'] . "'>" . $Item['nom_depen'] . " - " . $Item['nom_funcio'] . " " . $Item['ape_funcio']  . "</option>";
endforeach;
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>...::: Iwana - Configuración, Otras configuraciones :::...</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link href="../../../public/assets/plugins/jquery-metrojs/MetroJs.min.js" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="../../../public/assets/plugins/shape-hover/css/demo.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/assets/plugins/shape-hover/css/component.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/assets/plugins/owl-carousel/owl.carousel.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/assets/plugins/owl-carousel/owl.theme.css" />
    <link href="../../../public/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="../../../public/assets/plugins/jquery-slider/css/jquery.sidr.light.css" rel="stylesheet" type="text/css" media="screen" />
    <link rel="stylesheet" href="../../../public/assets/plugins/jquery-ricksaw-chart/css/rickshaw.css" type="text/css" media="screen">
    <link rel="stylesheet" href="../../../public/assets/plugins/Mapplic/mapplic/mapplic.css" type="text/css" media="screen">
    <!-- BEGIN CORE CSS FRAMEWORK -->
    <link href="../../../public/assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../../../public/assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="../../../public/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="../../../public/assets/css/animate.min.css" rel="stylesheet" type="text/css" />
    <link href="../../../public/assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" />
    <!-- END CORE CSS FRAMEWORK -->

    <!-- BEGIN CSS TEMPLATE -->
    <link href="../../../public/assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="../../../public/assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="../../../public/assets/css/custom-icon-set.css" rel="stylesheet" type="text/css" />
    <link href="../../../public/assets/css/magic_space.css" rel="stylesheet" type="text/css" />
    <!-- END CSS TEMPLATE -->
    <script src="../../../public/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
    <link href="../../mi_archivo/archivo_digitalizado/menuarbolaccesible.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../../mi_archivo/archivo_digitalizado/menuarbolaccesible.js"></script>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->

<body class="">
    <!-- BEGIN HEADER -->
    <?php require_once '../../../config/cabeza.php'; ?>
    <!-- END HEADER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container row-fluid">
        <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar" id="main-menu">
            <!-- BEGIN MINI-PROFILE -->
            <div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrapper">
                <?php require_once '../../../config/mini_profile.php'; ?>
                <!-- END MINI-PROFILE -->
                <!-- BEGIN SIDEBAR MENU -->
                <?php require_once '../../../config/menu.php'; ?>
                <!-- END SIDEBAR MENU -->
            </div>
        </div>
        <div class="footer-widget">
            <?php require_once '../../../config/footer-widget.php'; ?>
        </div>
        <!-- END SIDEBAR -->
        <!-- BEGIN PAGE CONTAINER-->
        <div class="page-content">
            <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
            <div id="portlet-config" class="modal hide">
                <div class="modal-header">
                    <button data-dismiss="modal" class="close" type="button"></button>
                    <h3>Widget Settings</h3>
                </div>
                <div class="modal-body"> Widget settings form goes here </div>
            </div>
            <div class="clearfix"></div>
            <div class="content sm-gutter">
                <ul class="breadcrumb">
                    <li>
                        <p>Tú estas</p>
                    </li>
                    <li>
                        <a href="#" class="active">Configuración - Otras configuraciones.</a>
                    </li>
                </ul>
                <div id="DivAlerta"></div>
                <!-- BEGIN DASHBOARD TILES -->
                <form role="form" name="FrmDatos" id="FrmDatos">

                    <input name="accion_otras" id="accion_otras" type="hidden" value="<?php echo $AccionOtras; ?>">
                    <input name="accion_empresa" id="accion_empresa" type="hidden" value="<?php echo $AccionEmpresa; ?>">
                    <input name="incluir_trd" type="hidden" id="incluir_trd" value="<?php echo $ConfiguracionOtras->get_Incluir_TRD(); ?>">
                    <input name="incluir_oficina_trd" type="hidden" id="incluir_oficina_trd" value="<?php echo $ConfiguracionOtras->get_Incluir_Oficina_TRD(); ?>">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="grid simple">
                                <div class="grid-body no-border">
                                    <div class="row column-seperation">
                                        <div class="col-md-6">
                                            <h4>
                                                <span class="text-success">
                                                    <i class="glyphicon glyphicon-check"></i>Actualización,
                                                </span>Datos de Mi Empresa
                                            </h4>
                                            <div class="row form-row">
                                                <div class="col-md-6">
                                                    <input name="nit" type="text" class="form-control input-sm" id="nit" placeholder="Nit" value="<?php echo $EmpreNit; ?>">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <span class="col-md-12">
                                                    <input name="razo_soci" type="text" class="form-control input-sm" id="razo_soci" placeholder="Razón Social" value="<?php echo $EmpreRazoSoci; ?>">
                                                </span>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <input name="slogan" type="text" class="form-control input-sm" id="slogan" placeholder="Slogan" value="<?php echo $EmpreSlogan; ?>">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-6">
                                                    <select name="id_depar" id="id_depar" class="select2 form-control input-sm">
                                                        <option value="0">...::: Elije el Departamento :::...</option>
                                                        <?php echo $Combo_Departamentos; ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <select name="id_muni" id="id_muni" class="select2 form-control input-sm">
                                                        <option value="0">...::: Elije el Municipio :::...</option>
                                                        <?php echo $Combo_Municipios; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <input name="dir" type="text" class="form-control input-sm" id="dir" placeholder="Dirección" value="<?php echo $EmpreDir; ?>">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-6">
                                                    <input name="tel" type="text" class="form-control input-sm" id="tel" placeholder="Teléfonos" value="<?php echo $EmpreTel; ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <input name="cel" type="text" class="form-control input-sm" id="cel" placeholder="Celular" value="<?php echo $EmpreCel; ?>">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <input name="email" type="text" class="form-control input-sm" id="email" placeholder="E-Mail" value="<?php echo $EmpreEmail; ?>">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <input name="web" type="text" class="form-control input-sm" id="web" placeholder="Web" value="<?php echo $EmpreWeb; ?>">
                                                </div>
                                            </div>
                                            <h4>
                                                <span class="text-success">
                                                    <i class="glyphicon glyphicon-check"></i> Logo
                                                </span> Mi Empresa
                                            </h4>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="file" id="logo_empresa" name="logo_empresa" class="form-control input-sm">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <?php if ($EmpreLogo != "") { ?>
                                                    <div class="col-md-4">
                                                        <img src="../../../archivos/otros/<?php echo $EmpreLogo; ?>" width="200" height="81">
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <h4>
                                                <span class="text-success">
                                                    <i class="glyphicon glyphicon-check"></i> Tipos,
                                                </span>de radicados:
                                            </h4>
                                            <h5>
                                                <span class="text-success">
                                                    Correspondencia recibida
                                                </span>
                                            </h5>
                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <?php
                                                    $checkedTipoRadicaRecibi1 = "";
                                                    $checkedTipoRadicaRecibi2 = "";
                                                    $checkedTipoRadicaRecibi3 = "";
                                                    if ($ConfiguracionOtras->get_TipoRadicadRecibida() == 1) {
                                                        $checkedTipoRadicaRecibi1 = "checked";
                                                    } else if ($ConfiguracionOtras->get_TipoRadicadRecibida() == 2) {
                                                        $checkedTipoRadicaRecibi2 = "checked";
                                                    } else if ($ConfiguracionOtras->get_TipoRadicadRecibida() == 3) {
                                                        $checkedTipoRadicaRecibi3 = "checked";
                                                    }
                                                    ?>
                                                    <div class="radio radio-success">
                                                        <input id="ChkTipoRadicarRecibi1" type="radio" name="tipo_radica_recibi" value="1" <?php echo $checkedTipoRadicaRecibi1; ?>>
                                                        <label for="ChkTipoRadicarRecibi1"> YYYYMMDD-#####</label>
                                                        <input id="ChkTipoRadicarRecibi2" type="radio" name="tipo_radica_recibi" value="2" <?php echo $checkedTipoRadicaRecibi2; ?>>
                                                        <label for="ChkTipoRadicarRecibi2"> COD DEPEN-YYYYMMDD-#####</label>
                                                        <input id="ChkTipoRadicarRecibi3" type="radio" name="tipo_radica_recibi" value="3" <?php echo $checkedTipoRadicaRecibi3; ?>>
                                                        <label for="ChkTipoRadicarRecibi3"> COD DEPEN-#####</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <h5>
                                                <span class="text-success">
                                                    Correspondencia enviada
                                                </span>
                                            </h5>
                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <?php
                                                    $checkedTipoRadicaEnvia1 = "";
                                                    $checkedTipoRadicaEnvia2 = "";
                                                    $checkedTipoRadicaEnvia3 = "";
                                                    if ($ConfiguracionOtras->get_TipoRadicadEnviada() == 1) {
                                                        $checkedTipoRadicaEnvia1 = "checked";
                                                    } else if ($ConfiguracionOtras->get_TipoRadicadEnviada() == 2) {
                                                        $checkedTipoRadicaEnvia2 = "checked";
                                                    } else if ($ConfiguracionOtras->get_TipoRadicadEnviada() == 3) {
                                                        $checkedTipoRadicaEnvia3 = "checked";
                                                    }
                                                    ?>
                                                    <div class="radio radio-success">
                                                        <input id="ChkTipoRadicarEnvia1" type="radio" name="tipo_radica_enviada" value="1" <?php echo $checkedTipoRadicaEnvia1; ?>>
                                                        <label for="ChkTipoRadicarEnvia1"> YYYYMMDD-#####</label>
                                                        <input id="ChkTipoRadicarEnvia2" type="radio" name="tipo_radica_enviada" value="2" <?php echo $checkedTipoRadicaEnvia2; ?>>
                                                        <label for="ChkTipoRadicarEnvia2"> COD DEPEN-YYYYMMDD-#####</label>
                                                        <input id="ChkTipoRadicarEnvia3" type="radio" name="tipo_radica_enviada" value="3" <?php echo $checkedTipoRadicaEnvia3; ?>>
                                                        <label for="ChkTipoRadicarEnvia3"> COD DEPEN-#####</label>
                                                    </div>
                                                </div>
                                                <h5>
                                                    <span class="text-success">
                                                        Correspondencia interna
                                                    </span>
                                                </h5>
                                                <div class="row form-row">
                                                    <div class="col-md-12">
                                                        <?php
                                                        $checkedTipoRadicaInterna1 = "";
                                                        $checkedTipoRadicaInterna2 = "";
                                                        $checkedTipoRadicaInterna3 = "";
                                                        if ($ConfiguracionOtras->get_TipoRadicadEnviada() == 1) {
                                                            $checkedTipoRadicaInterna1 = "checked";
                                                        } else if ($ConfiguracionOtras->get_TipoRadicadEnviada() == 2) {
                                                            $checkedTipoRadicaInterna2 = "checked";
                                                        } else if ($ConfiguracionOtras->get_TipoRadicadEnviada() == 3) {
                                                            $checkedTipoRadicaInterna3 = "checked";
                                                        }
                                                        ?>
                                                        <div class="radio radio-success">
                                                            <input id="ChkTipoRadicarInter1" type="radio" name="tipo_radica_interna" value="1" <?php echo $checkedTipoRadicaInterna1; ?>>
                                                            <label for="ChkTipoRadicarInter1"> YYYYMMDD-#####</label>
                                                            <input id="ChkTipoRadicarInter2" type="radio" name="tipo_radica_interna" value="2" <?php echo $checkedTipoRadicaInterna2; ?>>
                                                            <label for="ChkTipoRadicarInter2"> COD DEPEN-YYYYMMDD-#####</label>
                                                            <input id="ChkTipoRadicarInter3" type="radio" name="tipo_radica_interna" value="3" <?php echo $checkedTipoRadicaInterna3; ?>>
                                                            <label for="ChkTipoRadicarInter3"> COD DEPEN-#####</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <h4>
                                                    <span class="text-success">
                                                        <i class="glyphicon glyphicon-check"></i> Permitir el cargue,
                                                    </span>de archivos:
                                                </h4>
                                                <div class="row form-row">

                                                    <?php
                                                    $checkedTipoCargueArchivos1 = "";
                                                    $checkedTipoCargueArchivo2 = "";

                                                    if ($ConfiguracionOtras->get_TipoCargueArchivos() == 0) {
                                                        $checkedTipoCargueArchivos1 = "checked";
                                                    } else if ($ConfiguracionOtras->get_TipoRadicadEnviada() == 1) {
                                                        $checkedTipoCargueArchivo2 = "checked";
                                                    }
                                                    ?>

                                                    <div class="radio radio-success">
                                                        <input id="ChkCargueArchivos1" type="radio" name="tipo_cargue_archivos" value="0" <?php echo $checkedTipoCargueArchivos1; ?>>
                                                        <label for="ChkCargueArchivos1"> Por Ftp</label>
                                                        <input id="ChkCargueArchivos2" type="radio" name="tipo_cargue_archivos" value="1" <?php echo $checkedTipoCargueArchivo2; ?>>
                                                        <label for="ChkCargueArchivos2"> Cargar archivos a la BD de Iwana</label>
                                                    </div>
                                                </div>

                                                <h4>
                                                    <span class="text-success">
                                                        <i class="glyphicon glyphicon-check"></i> E -Mail,
                                                    </span>de ventanilla:
                                                </h4>

                                                <div class="row form-row">
                                                    <div class="col-md-5">
                                                        <input name="email_ventanilla_usuario" type="text" class="form-control input-sm" id="email_ventanilla_usuario" placeholder="E-Mail de Ventanilla" value="<?php echo $ConfiguracionOtras->get_EmailVentanillaUsuario(); ?>">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input name="email_ventanilla_contra" type="text" class="form-control input-sm" id="email_ventanilla_contra" placeholder="Contraseña E-Mail de Ventanilla" value="<?php echo $ConfiguracionOtras->get_EmailVentanillaContra(); ?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input name="mail_ventanilla_servidor" type="text" class="form-control input-sm" id="mail_ventanilla_servidor" placeholder="Servidor" value="<?php echo $ConfiguracionOtras->get_EmailVentanillaServidor(); ?>">
                                                    </div>
                                                </div>
                                                <div class="row form-row">
                                                    <div class="col-md-3">
                                                        <input name="email_ventanilla_puerto" type="text" class="form-control input-sm" id="email_ventanilla_puerto" placeholder="Puerto" value="<?php echo $ConfiguracionOtras->get_EmailVentanillaPuerto(); ?>">
                                                    </div>

                                                    <div class="col-md-4">
                                                        <input name="email_ventanilla_autenti" type="text" class="form-control input-sm" id="email_ventanilla_autenti" placeholder="Seguridad" value="<?php echo $ConfiguracionOtras->get_EmailVentanillaAutenti(); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if (TIPO_EMPRESA == 1) {
                                            ?>
                                                <h4>
                                                    <span class="text-success">
                                                        <i class="glyphicon glyphicon-check"></i> Formato solicitud,
                                                    </span>
                                                    Historia Clínica
                                                </h4>
                                                <div class="row form-row">
                                                    <div class="col-md-12">
                                                        <input name="hc_titulo" type="text" class="form-control input-sm" id="hc_titulo" placeholder="Titulo del formato" value="<?php echo $ConfiguracionOtras->get_HC_Titulo(); ?>">
                                                    </div>
                                                </div>
                                                <div class="row form-row">
                                                    <div class="col-md-12">
                                                        <input name="hc_subtitulo" type="text" class="form-control input-sm" id="hc_subtitulo" placeholder="Subtitulo del formato" value="<?php echo $ConfiguracionOtras->get_HC_SubTitulo(); ?>">
                                                    </div>
                                                </div>
                                                <div class="row form-row">
                                                    <div class="col-md-12">
                                                        <input name="hc_codigo" type="text" class="form-control input-sm" id="hc_codigo" placeholder="Código de calidad del formato" value="<?php echo $ConfiguracionOtras->get_HC_Codigo(); ?>">
                                                    </div>
                                                </div>
                                                <div class="row form-row">
                                                    <div class="col-md-6">
                                                        <input name="hc_version" type="text" class="form-control input-sm" id="hc_version" placeholder="Versión" value="<?php echo $ConfiguracionOtras->get_HC_Version(); ?>">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="hc_num_dias" type="text" class="form-control input-sm" id="hc_num_dias" placeholder="Numero de dias" value="<?php echo $ConfiguracionOtras->get_HC_NumDias(); ?>">
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            if (TIPO_EMPRESA == 1) {
                                            ?>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <h4>
                                                            <span class="text-success">
                                                                <i class="glyphicon glyphicon-check"></i> Responsables de la solicitud,
                                                            </span>
                                                            de Historia Clínica
                                                        </h4>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="button" id="BtnGuardarResponsableHC" class="btn btn-block btn-primary btn-xs btn-mini">
                                                            <span class="glyphicon glyphicon-check"></span> Guardar
                                                        </button>
                                                    </div>
                                                </div>
                                                <div id="DivAlertasHC"></div>
                                                <div class="row form-row">
                                                    <div class="col-md-6">
                                                        <select name="id_depen_hc" id="id_depen_hc" class="select2 form-control">
                                                            <option value="0">...::: Dependencia :::...</option>
                                                            <?php echo $Combo_Dependencias; ?>
                                                        </select>
                                                    </div>
                                                    <?php
                                                    if ($ConfiguracionOtras->get_Incluir_Oficina_TRD() == 2) {
                                                    ?>
                                                        <div class="col-md-6">
                                                            <select name="id_oficina_hc" id="id_oficina_hc" class="select2 form-control">
                                                                <option value="0">...::: Elije la Oficina :::...</option>
                                                                <?php echo $Combo_Oficinas; ?>
                                                            </select>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                    <div class="col-md-6">
                                                        <select name="id_funcio_deta_hc" id="id_funcio_deta_hc" class="select2 form-control">
                                                            <option value="0">...::: Elije el Funcionario :::...</option>
                                                            <?php echo $Combo_Funcionarios; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form-row">
                                                    <div class="col-md-4">
                                                        <select name="id_serie_hc" id="id_serie_hc" class="select2 form-control">
                                                            <option value="0">...::: Series :::...</option>
                                                            <?php echo $Combo_Series; ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <select name="id_subserie_hc" id="id_subserie_hc" class="select2 form-control">
                                                            <option value="0">...::: Subseries :::...</option>
                                                            <?php echo $Combo_Sub_Serie; ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <select name="id_tipodoc_hc" id="id_tipodoc_hc" class="select2 form-control">
                                                            <option value="0">...::: Tipo de Documento :::...</option>
                                                            <?php echo $Combo_Tipo_Documento; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form-row">
                                                    <div class="col-md-12" id="DivResponsablesHC">
                                                        <table class="table table-hover table-condensed" id="Tbl1">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width:60%">Clasificación</th>
                                                                    <th style="width:39%">Funcionario</th>
                                                                    <th style="width:1%"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $Responsables = ConfigOtrasResponsableHC::Listar(1, "");
                                                                foreach ($Responsables as $Item) :
                                                                ?>
                                                                    <tr>
                                                                        <td class="v-align-middle">
                                                                            <span class="muted">
                                                                                <?php
                                                                                echo "Depen.:" . $Item['nom_depen'] . "<br>Serie:" . $Item['nom_serie'] . "<br>SubSerie:" . $Item['nom_subserie'] . "<br>Documento:" . $Item['nom_tipodoc'];
                                                                                ?>
                                                                            </span>
                                                                        </td>
                                                                        <td class="v-align-middle">
                                                                            <span class="muted">
                                                                                <?php
                                                                                echo $Item['nom_funcio'] . " " . $Item['ape_funcio'];
                                                                                ?>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <button class="borrar btn btn-danger btn-xs btn-mini" data-id_funcio_deta="<?php echo $Item['id_funcio_deta']; ?>" id="BtnEliminarResponsableHC"><i class="fa fa-trash-o"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                <?php
                                                                endforeach;
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <h4>
                                                        <span class="text-success">
                                                            <i class="glyphicon glyphicon-check"></i> Responsables de la solicitud,
                                                        </span>
                                                        de PQRSF
                                                    </h4>
                                                </div>
                                                <div class="col-md-2">
                                                    <div align="right">
                                                        <button type="button" id="BtnGuardarResponsablePQRSF" class="btn btn-block btn-primary btn-xs btn-mini">
                                                            <span class="glyphicon glyphicon-check"></span> Guardar
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="DivAlertasPQRSF"></div>
                                            <div class="row form-row">
                                                <div class="col-md-6">
                                                    <select name="id_depen_pqrsf" id="id_depen_pqrsf" class="select2 form-control">
                                                        <option value="0">...::: Dependencia :::...</option>
                                                        <?php echo $Combo_Dependencias; ?>
                                                    </select>
                                                </div>
                                                <?php
                                                if ($ConfiguracionOtras->get_Incluir_Oficina_TRD() == 2) {
                                                ?>
                                                    <div class="col-md-6">
                                                        <select name="id_oficina_pqrsf" id="id_oficina_pqrsf" class="select2 form-control">
                                                            <option value="0">...::: Elije la Oficina :::...</option>
                                                            <?php echo $Combo_Oficinas; ?>
                                                        </select>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                                <div class="col-md-6">
                                                    <select name="id_funcio_deta_pqrsf" id="id_funcio_deta_pqrsf" class="select2 form-control">
                                                        <option value="0">...::: Elije el Funcionario :::...</option>
                                                        <?php echo $Combo_Funcionarios; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-4">
                                                    <select name="id_serie_pqrsf" id="id_serie_pqrsf" class="select2 form-control">
                                                        <option value="0">...::: Series :::...</option>
                                                        <?php echo $Combo_Series; ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <select name="id_subserie_pqrsf" id="id_subserie_pqrsf" class="select2 form-control">
                                                        <option value="0">...::: Subseries :::...</option>
                                                        <?php echo $Combo_Sub_Serie; ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <select name="id_tipodoc_pqrsf" id="id_tipodoc_pqrsf" class="select2 form-control">
                                                        <option value="0">...::: Tipo de Documento :::...</option>
                                                        <?php echo $Combo_Tipo_Documento; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-12" id="DivResponsablesPQRSF">
                                                    <table class="table table-hover table-condensed" id="Tbl1">
                                                        <thead>
                                                            <tr>
                                                                <th style="width:60%">Dependencia</th>
                                                                <th style="width:39%">Funcionario</th>
                                                                <th style="width:1%"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $ResponsablesPQRSF = ConfigOtrasResponsablePQRSF::Listar(1, "");
                                                            foreach ($ResponsablesPQRSF as $Item) :
                                                            ?>
                                                                <tr>
                                                                    <td class="v-align-middle">
                                                                        <span class="muted">
                                                                            <?php
                                                                            echo "Depen.:" . $Item['nom_depen'] . "<br>Serie:" . $Item['nom_serie'] . "<br>SubSerie:" . $Item['nom_subserie'] . "<br>Documento:" . $Item['nom_tipodoc'];
                                                                            ?>
                                                                        </span>
                                                                    </td>
                                                                    <td class="v-align-middle">
                                                                        <span class="muted">
                                                                            <?php
                                                                            echo $Item['nom_funcio'] . " " . $Item['ape_funcio'];
                                                                            ?>
                                                                        </span>
                                                                    </td>
                                                                    <td>
                                                                        <button class="borrar_funcionario_pqrsf btn btn-danger btn-xs btn-mini" data-id_funcio_deta="<?php echo $Item['id_funcio_deta']; ?>" id="BtnEliminarResponsablePQRSF"><i class="fa fa-trash-o"></i></button>
                                                                    </td>
                                                                </tr>
                                                            <?php
                                                            endforeach;
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <h4>
                                                <span class="text-success">
                                                    <i class="glyphicon glyphicon-check"></i> Pantilla,
                                                </span> para responder comunicaciones
                                            </h4>
                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <input type="file" id="plantilla_comunicaciones" name="plantilla_comunicaciones" class="form-control input-sm">
                                                </div>
                                                <?php if ($ConfiguracionOtras->get_PlantiCorrespon() != "") { ?>
                                                    <div class="col-md-12">
                                                        <a href="../../../archivos/otros/<?php echo $ConfiguracionOtras->get_PlantiCorrespon(); ?>">ver plantilla</a>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <h4>
                                                <span class="text-success">
                                                    <i class="glyphicon glyphicon-check"></i> Radicar,
                                                </span>Con:
                                            </h4>
                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <?php
                                                    $checkedTRD = "";
                                                    $checkedTipoDocumen = "";
                                                    if ($ConfiguracionOtras->get_Incluir_TRD() == 1) {
                                                        $checkedTRD = "checked";
                                                    } else {
                                                        $checkedTipoDocumen = "checked";
                                                    }
                                                    ?>
                                                    <div class="radio radio-success">
                                                        <input id="ChkRadicarCon1" type="radio" name="incluir_trd" value="true" <?php echo $checkedTRD; ?>>
                                                        <label for="ChkRadicarCon1"> Tabla de retención documental</label>
                                                        <input id="ChkRadicarCon0" type="radio" name="incluir_trd" value="false" <?php echo $checkedTipoDocumen; ?>>
                                                        <label for="ChkRadicarCon0"> Tipos documentales</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <h4>
                                                <span class="text-success">
                                                    <i class="glyphicon glyphicon-check"></i> TRD,
                                                </span>Con:
                                            </h4>
                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <?php
                                                    $checkedTRDConDepen = "";
                                                    $checkedTRDConDepenOfici = "";
                                                    if ($ConfiguracionOtras->get_Incluir_Oficina_TRD() == 1) {
                                                        $checkedTRDConDepen = "checked";
                                                    } else {
                                                        $checkedTRDConDepenOfici = "checked";
                                                    }
                                                    ?>
                                                    <div class="radio radio-success">
                                                        <input id="ChkTRDCon1" type="radio" name="incluir_oficina_trd" value="true" <?php echo $checkedTRDConDepen; ?>>
                                                        <label for="ChkTRDCon1"> Dependencias</label>
                                                        <input id="ChkTRDCon0" type="radio" name="incluir_oficina_trd" value="false" <?php echo $checkedTRDConDepenOfici; ?>>
                                                        <label for="ChkTRDCon0"> Dependencias y oficinas</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <h4>
                                                <span class="text-success">
                                                    <i class="glyphicon glyphicon-check"></i> Imprimir rotulo,
                                                </span>en:
                                            </h4>
                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <?php
                                                    $checkedTipoImpreTickect = "";
                                                    $checkedTipoImpreDocumen = "";
                                                    if ($ConfiguracionOtras->get_TipoImpresionRotulo() == 1) {
                                                        $checkedTRD = "checked";
                                                    } else {
                                                        $checkedTipoImpreDocumen = "checked";
                                                    }
                                                    ?>
                                                    <div class="radio radio-success">
                                                        <input id="ChkImprimeRotulo1" type="radio" name="tipo_impre_torulo" value="1" <?php echo $checkedTipoImpreTickect; ?>>
                                                        <label for="ChkImprimeRotulo1">Ticket</label>
                                                        <input id="ChkImprimeRotulo0" type="radio" name="tipo_impre_torulo" value="2" <?php echo $checkedTipoImpreDocumen; ?>>
                                                        <label for="ChkImprimeRotulo0">Documento</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <h4>
                                                <span class="text-success">
                                                    <i class="glyphicon glyphicon-check"></i> Planilla correspondencia,
                                                </span> recibida
                                            </h4>
                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <input name="corres_recibida_titulo" type="text" class="form-control input-sm" id="corres_recibida_titulo" placeholder="Titulo de la planilla" value="<?php echo $ConfiguracionOtras->get_CoresReciTitulo(); ?>">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <input name="corres_recibida_subtitulo" type="text" class="form-control input-sm" id="corres_recibida_subtitulo" placeholder="Subtitulo de la planilla" value="<?php echo $ConfiguracionOtras->get_CoresReciSubTitulo(); ?>">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-6">
                                                    <input name="corres_recibida_codigo" type="text" class="form-control input-sm" id="corres_recibida_codigo" placeholder="Código de calidad de la planilla" value="<?php echo $ConfiguracionOtras->get_CoresReciCodigo(); ?>">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-6">
                                                    <input name="corres_recibida_version" type="text" class="form-control input-sm" id="corres_recibida_version" placeholder="Versión" value="<?php echo $ConfiguracionOtras->get_CoresReciVersion(); ?>">
                                                </div>
                                            </div>
                                            <h4>
                                                <span class="text-success">
                                                    <i class="glyphicon glyphicon-check"></i> Planilla correspondencia,
                                                </span>enviada
                                            </h4>
                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <input name="corres_enviada_titulo" type="text" class="form-control input-sm" id="corres_enviada_titulo" placeholder="Titulo de la planilla" value="<?php echo $ConfiguracionOtras->get_CoresEnviaTitulo(); ?>">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <input name="corres_enviada_subtitulo" type="text" class="form-control input-sm" id="corres_enviada_subtitulo" placeholder="Subtitulo de la planilla" value="<?php echo $ConfiguracionOtras->get_CoresEnviaSubTitulo(); ?>">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-6">
                                                    <input name="corres_enviada_codigo" type="text" class="form-control input-sm" id="corres_enviada_codigo" placeholder="Código de calidad de la planilla" value="<?php echo $ConfiguracionOtras->get_CoresEnviaCodigo(); ?>">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-6">
                                                    <input name="corres_enviada_version" type="text" class="form-control input-sm" id="corres_enviada_version" placeholder="Versión" value="<?php echo $ConfiguracionOtras->get_CoresEnviaVersion(); ?>">
                                                </div>
                                            </div>
                                            <h4>
                                                <span class="text-success">
                                                    <i class="glyphicon glyphicon-check"></i> Planilla correspondencia,
                                                </span>interna
                                            </h4>
                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <input name="corres_interna_titulo" type="text" class="form-control input-sm" id="corres_interna_titulo" placeholder="Titulo de la planilla" value="<?php echo $ConfiguracionOtras->get_CoresInternaTitulo(); ?>">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <input name="corres_interna_subtitulo" type="text" class="form-control input-sm" id="corres_interna_subtitulo" placeholder="Subtitulo de la planilla" value="<?php echo $ConfiguracionOtras->get_CoresInternaSubTitulo(); ?>">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-6">
                                                    <input name="corres_interna_codigo" type="text" class="form-control input-sm" id="corres_interna_codigo" placeholder="Código de calidad de la planilla" value="<?php echo $ConfiguracionOtras->get_CoresInternaCodigo(); ?>">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-6">
                                                    <input name="corres_interna_version" type="text" class="form-control input-sm" id="corres_interna_version" placeholder="Versión" value="<?php echo $ConfiguracionOtras->get_CoresInternaVersion(); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="pull-left">
                                            <button class="btn btn-primary btn-cons" type="submit" id="BtnGuardar" name="BtnGuardar">
                                                <span class="glyphicon glyphicon-check"></span> Guardar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- END DASHBOARD TILES -->
            </div>
        </div>
        <!-- BEGIN CHAT -->
        <div class="chat-window-wrapper">
            <?php require_once '../../chat/chat.php'; ?>
        </div>
        <!-- END CHAT -->
    </div>
    <!-- END CONTAINER -->

    <!-- BEGIN CORE JS FRAMEWORK-->
    <script src="funciones.ajax.js"></script>
    <script src="../../../public/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="../../../public/assets/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../../../public/assets/plugins/breakpoints.js" type="text/javascript"></script>
    <script src="../../../public/assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
    <script src="../../../public/assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script>
    <script src="../../../public/assets/plugins/jquery-lazyload/jquery.lazyload.min.js" type="text/javascript"></script>
    <script src="../../../public/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
    <!-- END CORE JS FRAMEWORK -->
    <!-- BEGIN PAGE LEVEL JS -->
    <script src="../../../public/assets/plugins/jquery-slider/jquery.sidr.min.js" type="text/javascript"></script>
    <script src="../../../public/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="../../../public/assets/plugins/pace/pace.min.js" type="text/javascript"></script>
    <script src="../../../public/assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
    <script src="../../../public/assets/plugins/jquery-ricksaw-chart/js/raphael-min.js"></script>
    <script src="../../../public/assets/plugins/jquery-ricksaw-chart/js/d3.v2.js"></script>
    <script src="../../../public/assets/plugins/jquery-ricksaw-chart/js/rickshaw.min.js"></script>
    <script src="../../../public/assets/plugins/jquery-sparkline/jquery-sparkline.js"></script>
    <script src="../../../public/assets/plugins/skycons/skycons.js"></script>
    <script src="../../../public/assets/plugins/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>

    <script src="../../../public/assets/plugins/jquery-flot/jquery.flot.js" type="text/javascript"></script>
    <script src="../../../public/assets/plugins/jquery-flot/jquery.flot.resize.min.js" type="text/javascript"></script>
    <script src="../../../public/assets/plugins/jquery-metrojs/MetroJs.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN CORE TEMPLATE JS -->
    <script src="../../../public/assets/js/core.js" type="text/javascript"></script>
    <script src="../../../public/assets/js/chat.js" type="text/javascript"></script>
    <script src="../../../public/assets/js/demo.js" type="text/javascript"></script>
    <script src="../../../public/assets/js/dashboard_v2.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".live-tile,.flip-list").liveTile();
        });
    </script>
    <!-- END CORE TEMPLATE JS -->
</body>

</html>