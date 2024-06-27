<?php
session_start();
include "../../../config/class.Conexion.php";
include("../../../config/variable.php");
include("../../../config/funciones.php");
include("../../../config/funciones_seguridad.php");
require_once "../../clases/general/class.GeneralTercero.php";
require_once "../../clases/general/class.GeneralTerceroEmpresa.php";
require_once "../../clases/configuracion/class.ConfigDepartamento.php";
require_once "../../clases/configuracion/class.ConfigMunicipio.php";
require_once '../../clases/seguridad/class.SeguridadPermiso.php';

$TerceroContacto = Tercero::Buscar(2, $_REQUEST['id'], "", "", "", "", "");
$TerceroEmpresa = TerceroEmpresa::Buscar(2, $TerceroContacto->getId_Empresa(), "", "", "", "", "");

$Departamento = Departamento::Listar();
$Combo_Depar_Contac = "";

if ($TerceroContacto->getId_Depar()) {
    $Municipio = Municipio::Listar(1, $TerceroContacto->getId_Depar());
    $Combo_Muni_Contac = "";


    if ($TerceroContacto->getId_Depar() != "") {
        foreach ($Departamento as $Item) :
            if ($Item['id_depar'] == $TerceroContacto->getId_Depar()) {
                $Combo_Depar_Contac .= "<option value='" . $Item['id_depar'] . "' selected>" . $Item['nom_depar'] . "</option>";
            } else {
                $Combo_Depar_Contac .= "<option value='" . $Item['id_depar'] . "'>" . $Item['nom_depar'] . "</option>";
            }
        endforeach;

        foreach ($Municipio as $Item) :
            if ($Item['id_muni'] == $TerceroContacto->getId_Muni()) {
                $Combo_Muni_Contac .= "<option value='" . $Item['id_muni'] . "' selected>" . $Item['nom_muni'] . "</option>";
            } else {
                $Combo_Muni_Contac .= "<option value='" . $Item['id_muni'] . "'>" . $Item['nom_muni'] . "</option>";
            }
        endforeach;
    } else {
        foreach ($Departamento as $Item) :
            $Combo_Depar_Contac .= "<option value='" . $Item['id_depar'] . "'>" . $Item['nom_depar'] . "</option>";
        endforeach;
    }
}

if ($TerceroEmpresa) {
    $IdEmpre     = $TerceroEmpresa->getId_Empresa();
    $Nit         = $TerceroEmpresa->get_Nit();
    $RazonSocial = $TerceroEmpresa->get_RazonSocial();
    $DirEmpre    = $TerceroEmpresa->get_Dir();
    $TelEmpre    = $TerceroEmpresa->get_Tel();
    $CelEmpre    = $TerceroEmpresa->get_Cel();
    $FaxEmpre    = $TerceroEmpresa->get_Fax();
    $EmailEmpre  = $TerceroEmpresa->get_Email();
    $WebEmpre    = $TerceroEmpresa->get_Web();

    $Combo_Depar_Empre = "";
    foreach ($Departamento as $Item) :
        if ($Item['id_depar'] == $TerceroEmpresa->getId_Depar()) {
            $Combo_Depar_Empre .= "<option value='" . $Item['id_depar'] . "' selected>" . $Item['nom_depar'] . "</option>";
        } else {
            $Combo_Depar_Empre .= "<option value='" . $Item['id_depar'] . "'>" . $Item['nom_depar'] . "</option>";
        }
    endforeach;

    $Combo_Muni_Empre = "";
    $Municipio = Municipio::Listar(1, $TerceroEmpresa->getId_Depar());
    foreach ($Municipio as $Item) :
        if ($Item['id_muni'] == $TerceroEmpresa->getId_Muni()) {
            $Combo_Muni_Empre .= "<option value='" . $Item['id_muni'] . "' selected>" . $Item['nom_muni'] . "</option>";
        } else {
            $Combo_Muni_Empre .= "<option value='" . $Item['id_muni'] . "'>" . $Item['nom_muni'] . "</option>";
        }
    endforeach;
} else {
    $IdEmpre     = "";
    $Nit         = "";
    $RazonSocial = "";
    $DirEmpre    = "";
    $TelEmpre    = "";
    $CelEmpre    = "";
    $FaxEmpre    = "";
    $EmailEmpre  = "";
    $WebEmpre    = "";

    $Combo_Depar_Empre = "";
    foreach ($Departamento as $Item) :
        $Combo_Depar_Empre .= "<option value='" . $Item['id_depar'] . "'>" . $Item['nom_depar'] . "</option>";
    endforeach;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>...::: Iwana - Ventanilla, Gestión de Terceros :::...</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- BEGIN PLUGIN CSS -->
    <link href="../../../public/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="../../../public/assets/plugins/jquery-datatable/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <!-- END PLUGIN CSS -->

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
    <!-- END CSS TEMPLATE -->

    <link href="../../../public/assets/css/botones_redondos.css" rel="stylesheet" type="text/css" />
    <script src="../../../public/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>

</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->

<body class="inner-menu-always-open extended-layout">
    <!-- BEGIN HEADER -->
    <?php require_once '../../../config/cabeza.php'; ?>
    <!-- END HEADER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container row-fluid">
        <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar mini mini-mobile" id="main-menu" data-inner-menu="1">
            <div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrappers">
                <div class="user-info-wrapper">
                    <!-- BEGIN MINI-PROFILE -->
                    <?php require_once '../../../config/mini_profile.php'; ?>
                    <!-- END MINI-PROFILE -->
                </div>
                <!-- BEGIN SIDEBAR MENU -->
                <?php require_once '../../../config/menu_ventanilla.php'; ?>
                <!-- END SIDEBAR MENU -->
            </div>

            <div class="inner-menu nav-collapse">
                <div id="inner-menu">
                    <div class="inner-wrapper">
                        <a href="" class="btn btn-block btn-primary">
                            <span class="bold">RADICAR</span>
                        </a>
                    </div>
                    <div class="inner-menu-content">
                        <p class="menu-title">VISTA RAPIDA <span class="pull-right"><i class="icon-refresh"></i></span></p>
                    </div>
                    <ul class="small-items">
                        <li class="active">
                            <a href="../recibida/recibidas/index.php"> Ir a la correspondencia recibida</a>
                        </li>
                        <li class="active">
                            <a href="../enviada/enviadas/index.php"> Ir a la correspondencia enviada</a>
                        </li>
                        <li class="active">
                            <a href="../interna/interna/index.php"> Ir a la correspondencia interna</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <a href="#" class="scrollup">Scroll</a>
        <!-- END SIDEBAR -->
        <!-- BEGIN PAGE -->
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

            <div class="content">
                <ul class="breadcrumb">
                    <li>
                        <p>ESTÁS AQUÍ</p>
                    </li>
                    <li><a href="#" class="active">Ventanilla, Gestión de Terceros Juridicos</a></li>
                </ul>
                <div id="DivAlertas"></div>
                <form role="form" name="FrmDatos" id="FrmDatos">

                    <input name="id_contac" id="id_contac" type="hidden" value="<?php echo $TerceroContacto->getId_Remite(); ?>">
                    <input name="id_empre" id="id_empre" type="hidden" value="<?php echo $IdEmpre; ?>">
                    <input name="accion" id="accion" type="hidden" value="EDITAR_TERCERO">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="grid simple">
                                <div class="grid-body no-border">

                                </div>

                                <div class="grid-body no-border">
                                    <div class="row column-seperation">
                                        <div class="col-md-6">
                                            <h4><span class="text-warning">Editar, </span>Información básica del contacto</h4>

                                            <div class="row form-row">
                                                <div class="col-md-3">
                                                    <input name="num_docu_contac" type="text" class="form-control input-sm" id="num_docu_contac" placeholder="# De Documento" value="<?php echo $TerceroContacto->getNum_Documetno(); ?>">
                                                </div>

                                                <?php
                                                if ($TerceroContacto->getId_Empresa() == "") {
                                                ?>
                                                    <div class="col-md-9">
                                                        <input name="nom_contac" type="text" class="form-control input-sm" id="nom_contac" placeholder="Contacto" value="<?php echo $TerceroContacto->getNom_Contacto(); ?>">
                                                    </div>
                                                <?php } else { ?>

                                                    <div class="col-md-6">
                                                        <input name="nom_contac" type="text" class="form-control input-sm" id="nom_contac" placeholder="Contacto" value="<?php echo $TerceroContacto->getNom_Contacto(); ?>">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input name="cargo_contac" type="text" class="form-control input-sm" id="cargo_contac" placeholder="Cargo" value="<?php echo $TerceroContacto->get_Cargo(); ?>">
                                                    </div>

                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <?php
                                            if (!$TerceroContacto->getId_Empresa()) {
                                            ?>
                                                <div class="row form-row">
                                                    <div class="col-md-6">
                                                        <select name="id_depar_contac" id="id_depar_contac" class="select2 form-control input-sm">
                                                            <option value="0">...::: Elije el Departamento :::...</option>
                                                            <?php echo $Combo_Depar_Contac; ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select name="id_muni_contac" id="id_muni_contac" class="select2 form-control input-sm">
                                                            <option value="0">...::: Elije el Municipio :::...</option>
                                                            <?php echo $Combo_Muni_Contac; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>

                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <input name="dir_contac" type="text" class="form-control input-sm" id="dir_contac" placeholder="Dirección" value="<?php echo $TerceroContacto->get_Dir(); ?>">
                                                </div>
                                            </div>

                                            <div class="row form-row">
                                                <div class="col-md-6">
                                                    <input name="tel_contac" type="text" class="form-control input-sm" id="tel_contac" placeholder="Teléfono" value="<?php echo $TerceroContacto->get_Tel(); ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <input name="cel_contac" type="text" class="form-control input-sm" id="cel_contac" placeholder="Celular" value="<?php echo $TerceroContacto->get_Cel(); ?>">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <input name="email_contac" type="email" class="form-control input-sm" id="email_contac" placeholder="E - Mail" value="<?php echo $TerceroContacto->get_Email(); ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <h4><span class="text-warning">Editar, </span>Información básica del Tercero</h4>
                                            <div class="row form-row">
                                                <div class="col-md-4">
                                                    <input name="nit" type="text" class="form-control input-sm" id="nit" placeholder="Nit" value="<?php echo $Nit; ?>">
                                                </div>
                                                <div class="col-md-8">
                                                    <input name="razo_soci" type="text" class="form-control input-sm" id="razo_soci" placeholder="Razón social" value="<?php echo $RazonSocial; ?>">
                                                </div>
                                                <div class="col-md-12">
                                                    <input name="dir_empresa" type="text" class="form-control input-sm" id="dir_empresa" placeholder="Dirección" value="<?php echo $DirEmpre; ?>">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-6">
                                                    <select name="id_depar_empresa" id="id_depar_empresa" class="select2 form-control input-sm">
                                                        <option value="0">...::: Elije el Departamento :::...</option>
                                                        <?php echo $Combo_Depar_Empre; ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <select name="id_muni_empresa" id="id_muni_empresa" class="select2 form-control input-sm">
                                                        <option value="0">...::: Elije el Municipio :::...</option>
                                                        <?php echo $Combo_Muni_Empre; ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row form-row">
                                                <div class="col-md-4">
                                                    <input name="tel_empresa" type="text" class="form-control input-sm" id="tel_empresa" placeholder="Teléfono" value="<?php echo $TelEmpre; ?>">
                                                </div>
                                                <div class="col-md-4">
                                                    <input name="cel_empresa" type="text" class="form-control input-sm" id="cel_empresa" placeholder="Celular" value="<?php echo $CelEmpre; ?>">
                                                </div>
                                                <div class="col-md-4">
                                                    <input name="fax_empresa" type="text" class="form-control input-sm" id="fax_empresa" placeholder="Fax" value="<?php echo $FaxEmpre; ?>">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <input name="email_empresa" type="email" class="form-control input-sm" id="email_empresa" placeholder="E - Mail" value="<?php echo $EmailEmpre; ?>">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <input name="web_empresa" type="email" class="form-control input-sm" id="web_empresa" placeholder="Web" value="<?php echo $WebEmpre; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <div class="pull-left">
                                            <button class="btn btn-warning btn-cons" type="button" id="BtnEditar" name="BtnEditar">
                                                <i class="glyphicon glyphicon-pencil"></i> Editar
                                            </button>
                                            <button class="btn btn-white btn-cons" type="button" id="BtnRegresar" name="BtnRegresar">
                                                <i class="fa fa-mail-reply-all"></i> Regresar
                                            </button>
                                        </div>

                                        <div class="pull-right">
                                            <button class="btn btn-primary btn-cons" type="button" data-toggle="modal" data-target="#myModalNuevaEmpresa" id="BtnEditarEmpresa" name="BtnEditarEmpresa">
                                                <span class="fa fa-home"></span> Nueva Empresa
                                            </button>
                                            <button class="btn btn-success btn-cons" type="button" data-toggle="modal" data-target="#myModalBuscarEmpresa" id="BtnBuscarEmpresa" name="BtnBuscarEmpresa">
                                                <span class="fa fa-search"></span> Buscar Empresa
                                            </button>
                                            <button class="btn btn-danger btn-cons" type="button" id="BtnDesvincularEmpresa" name="BtnDesvincularEmpresa">
                                                <i class="fa fa-trash"></i> Desvincular Empresa
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>

    <!-- BEGIN CHAT -->
    <div class="chat-window-wrapper">
        <div id="main-chat-wrapper" class="inner-content">
            <div class="chat-window-wrapper scroller scrollbar-dynamic" id="chat-users">
                <div class="chat-header">
                    <div class="pull-left">
                        <input type="text" placeholder="Buscar">
                    </div>
                    <div class="pull-right">
                        <a href="#" class="">
                            <div class="iconset top-settings-dark"></div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END CHAT -->

    <!-- END CONTAINER -->

    <!-- INICIO MODAL PARA NUEVA EMPRESA -->
    <div class="modal fade" id="myModalNuevaEmpresa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <br>
                    <i class="fa fa-home fa-2x text-info"></i>
                    <h4 id="myModalLabel" class="semi-bold text-info">Nueva Empresa</h4>
                </div>
                <div class="modal-body">
                    <div class="row-fluid">
                        <div class="span12">

                            <div id="DivAlertasEmpresaTercero"></div>

                            <div class="grid simple ">
                                <div class="grid-body">
                                    <form role="form" name="FrmDatosEmpresa" id="FrmDatosEmpresa">

                                        <input name="accion" id="accion" type="hidden" value="INSERTAR_EMPRESA">

                                        <div class="col-md-12">

                                            <div class="row form-row">
                                                <div class="col-md-4">
                                                    <input name="nit" type="text" class="form-control input-sm" id="nit" placeholder="Nit">
                                                </div>
                                                <div class="col-md-8">
                                                    <input name="razo_soci" type="text" class="form-control input-sm" id="razo_soci" placeholder="Razón social">
                                                </div>
                                                <div class="col-md-12">
                                                    <input name="dir" type="text" class="form-control input-sm" id="dir" placeholder="Dirección">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-6">
                                                    <select name="id_depar" id="id_depar" class="select2 form-control input-sm">
                                                        <option value="0">...::: Elije el Departamento :::...</option>
                                                        <?php echo $Combo_Depar_Contac; ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <select name="id_muni" id="id_muni" class="select2 form-control input-sm">
                                                        <option value="0">...::: Elije el Municipio :::...</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row form-row">
                                                <div class="col-md-4">
                                                    <input name="tel" type="text" class="form-control input-sm" id="tel" placeholder="Teléfono">
                                                </div>
                                                <div class="col-md-4">
                                                    <input name="cel" type="text" class="form-control input-sm" id="cel" placeholder="Celular">
                                                </div>
                                                <div class="col-md-4">
                                                    <input name="fax" type="text" class="form-control input-sm" id="fax" placeholder="Fax">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <input name="email" type="email" class="form-control input-sm" id="email" placeholder="E - Mail">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <input name="web_juridico" type="email" class="form-control input-sm" id="web_juridico" placeholder="Web">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="BtnCancelarEmpresaTercero">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN MODAL PARA NUEVA EMPRESA -->

    <!-- INICIO MODAL PARA BUSCAR EMPRESA -->
    <div class="modal fade" id="myModalBuscarEmpresa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width: 50%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <br>
                    <i class="fa fa-home fa-2x text-info"></i>
                    <h4 id="myModalLabel" class="semi-bold text-info">Nueva Empresa</h4>
                </div>
                <div class="modal-body">
                    <div class="row-fluid">
                        <div class="span12">

                            <div id="DivAlertasEmpresa"></div>

                            <div class="grid simple">
                                <div class="grid-body ">
                                    <div class="row form-row">
                                        <div id="DivAlertasEmpresa"></div>
                                        <div class="col-md-12">
                                            <input name="TxtBusEmpresa" type="text" class="form-control" id="TxtBusEmpresa" placeholder="Ingrese aqui el criterio de búsqueda para la empresa.">
                                        </div>
                                    </div>
                                    <div class="row form-row">
                                        <div class="col-md-12">
                                            <div id="DivListarEmpresa"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="BtnCancelarEmpresaTercero">Cancelar</button>
                    <button type="button" class="btn btn-success" id="BtnGuardarEmpresa">
                        <i class="fa fa-save"></i> Guardar
                    </button>
                </div>

            </div>
        </div>
    </div>
    <!-- FIN MODAL PARA BUSCAR EMPRESA -->
    <script src="funcionesTercero.ajax.js"></script>
    <script src="../../../public/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="../../../public/assets/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../../../public/assets/plugins/breakpoints.js" type="text/javascript"></script>
    <script src="../../../public/assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
    <!-- END CORE JS FRAMEWORK -->
    <!-- BEGIN PAGE LEVEL JS -->
    <script src="../../../public/assets/plugins/pace/pace.min.js" type="text/javascript"></script>
    <script src="../../../public/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
    <script src="../../../public/assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="../../../public/assets/js/tabs_accordian.js" type="text/javascript"></script>
    <!-- BEGIN CORE TEMPLATE JS -->
    <script src="../../../public/assets/js/core.js" type="text/javascript"></script>
    <script src="../../../public/assets/js/chat.js" type="text/javascript"></script>
    <script src="../../../public/assets/js/demo.js" type="text/javascript"></script>
    <!-- END CORE TEMPLATE JS -->
    <!-- END JAVASCRIPTS -->
    <script src="../../../public/assets/sweetalert2/sweetalert-dev.js"></script>
    <link href="../../../public/assets/sweetalert2/sweetalert.css" rel="stylesheet" type="text/css">
</body>

</html>