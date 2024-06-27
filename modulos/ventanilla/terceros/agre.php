<?php
session_start();
include "../../../config/class.Conexion.php";
include("../../../config/variable.php");
include("../../../config/funciones.php");
include("../../../config/funciones_seguridad.php");
require_once "../../clases/configuracion/class.ConfigDepartamento.php";
require_once '../../clases/seguridad/class.SeguridadPermiso.php';

$Departamento = Departamento::Listar();
$Combo_Departamentos = "";
foreach ($Departamento as $Item) :
    $Combo_Departamentos .= "<option value='" . $Item['id_depar'] . "'>" . $Item['nom_depar'] . "</option>";
endforeach;


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
    <link href="../../../public/assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="../../../public/assets/plugins/jquery-datatable/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <link href="../../../public/assets/plugins/datatables-responsive/css/datatables.responsive.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="../../../public/assets/plugins/bootstrap-tag/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />
    <link href="../../../public/assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet" type="text/css" />
    <link href="../../../public/assets/plugins/ios-switch/ios7-switch.css" rel="stylesheet" type="text/css" media="screen">
    <link href="../../../public/assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen" />
    <!-- END CORE CSS FRAMEWORK -->

    <!-- BEGIN CSS TEMPLATE -->
    <link href="../../../public/assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="../../../public/assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="../../../public/assets/css/custom-icon-set.css" rel="stylesheet" type="text/css" />
    <!-- END CSS TEMPLATE -->

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
                    <li><a href="#" class="active">Ventanilla, Gestión de Terceros</a></li>
                </ul>
                <div id="DivAlertas"></div>
                <form role="form" name="FrmDatosTerceroJuridico" id="FrmDatosTerceroJuridico">

                    <input name="accion" id="accion" type="hidden" value="INSERTAR_TERCERO">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="grid simple">
                                <div class="grid-title no-border">

                                </div>
                                <div class="grid-body no-border">
                                    <div class="row column-seperation">
                                        <div class="col-md-6">

                                            <h4><span class="text-success">Nueva, </span>Información básica del tercero juridico</h4>

                                            <div class="row form-row">
                                                <div class="col-md-3">
                                                    <input name="num_docu_contac" type="text" class="form-control input-sm" id="num_docu_contac" placeholder="# De Documento">
                                                </div>
                                                <div class="col-md-9">
                                                    <input name="nom_contac" type="text" class="form-control input-sm" id="nom_contac" placeholder="Contacto">
                                                </div>
                                            </div>

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

                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <input name="dir_contac" type="text" class="form-control input-sm" id="dir_contac" placeholder="Dirección">
                                                </div>
                                            </div>

                                            <div class="row form-row">
                                                <div class="col-md-6">
                                                    <input name="tel_contac" type="text" class="form-control input-sm" id="tel_contac" placeholder="Teléfono">
                                                </div>
                                                <div class="col-md-6">
                                                    <input name="cel_contac" type="text" class="form-control input-sm" id="cel_contac" placeholder="Celular">
                                                </div>
                                            </div>

                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <input name="email_contac" type="email" class="form-control input-sm" id="email_contac" placeholder="E - Mail">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h4><span class="text-success">Empresa, </span> del Tercero</h4>
                                            <div class="row form-row">
                                                <div class="col-md-4">
                                                    <input name="nit" type="text" class="form-control input-sm" id="nit" placeholder="Nit">
                                                </div>
                                                <div class="col-md-8">
                                                    <input name="razo_soci" type="text" class="form-control input-sm" id="razo_soci" placeholder="Razón social">
                                                </div>
                                                <div class="col-md-12">
                                                    <input name="dir_empresa" type="text" class="form-control input-sm" id="dir_empresa" placeholder="Dirección">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-6">
                                                    <select name="id_depar_empresa" id="id_depar_empresa" class="select2 form-control input-sm">
                                                        <option value="0">...::: Elije el Departamento :::...</option>
                                                        <?php echo $Combo_Departamentos; ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <select name="id_muni_empresa" id="id_muni_empresa" class="select2 form-control input-sm">
                                                        <option value="0">...::: Elije el Municipio :::...</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row form-row">
                                                <div class="col-md-4">
                                                    <input name="tel_empresa" type="text" class="form-control input-sm" id="tel_empresa" placeholder="Teléfono">
                                                </div>
                                                <div class="col-md-4">
                                                    <input name="cel_empresa" type="text" class="form-control input-sm" id="cel_empresa" placeholder="Celular">
                                                </div>
                                                <div class="col-md-4">
                                                    <input name="fax_empresa" type="text" class="form-control input-sm" id="fax_empresa" placeholder="Fax">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <input name="email_empresa" type="email" class="form-control input-sm" id="email_empresa" placeholder="E - Mail">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <input name="web_empresa" type="email" class="form-control input-sm" id="web_empresa" placeholder="Web">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">

                                        <div class="pull-left">
                                            <button class="btn btn-primary btn-cons" type="button" id="BtnGuardarTerceroJutidico" name="BtnGuardarTerceroJutidico">
                                                <span class="glyphicon glyphicon-check"></span> Guardar
                                            </button>
                                            <button class="btn btn-white btn-cons" type="button" id="BtnRegresar" name="BtnRegresar">
                                                <span class="fa fa-mail-reply-all"></span> Regresar
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
    </div>
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

                            <div id="DivAlertasEmpresa"></div>

                            <div class="grid simple ">
                                <div class="grid-body">
                                    <form role="form" name="FrmDatosEmpresa" id="FrmDatosEmpresa">

                                        <input name="accion" id="accion" type="hidden" value="INSERTAR_EMPRESA">

                                        <div class="col-md-12">

                                            <div class="row form-row">
                                                <div class="col-md-4">
                                                    <input name="nit_nueva_empre" type="text" class="form-control input-sm" id="nit_nueva_empre" placeholder="Nit">
                                                </div>
                                                <div class="col-md-8">
                                                    <input name="razo_soci_nueva_empre" type="text" class="form-control input-sm" id="razo_soci_nueva_empre" placeholder="Razón social">
                                                </div>
                                                <div class="col-md-12">
                                                    <input name="dir_nueva_empre" type="text" class="form-control input-sm" id="dir_nueva_empre" placeholder="Dirección">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-6">
                                                    <select name="id_depar_nueva_empre" id="id_depar_nueva_empre" class="select2 form-control input-sm">
                                                        <option value="0">...::: Elije el Departamento :::...</option>
                                                        <?php echo $Combo_Departamentos; ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <select name="id_muni_nueva_empre" id="id_muni_nueva_empre" class="select2 form-control input-sm">
                                                        <option value="0">...::: Elije el Municipio :::...</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-4">
                                                    <input name="tel_nueva_empre" type="text" class="form-control input-sm" id="tel_nueva_empre" placeholder="Teléfono">
                                                </div>
                                                <div class="col-md-4">
                                                    <input name="cel_nueva_empre" type="text" class="form-control input-sm" id="cel_nueva_empre" placeholder="Celular">
                                                </div>
                                                <div class="col-md-4">
                                                    <input name="fax_nueva_empre" type="text" class="form-control input-sm" id="fax_nueva_empre" placeholder="Fax">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <input name="email_nueva_empre" type="email" class="form-control input-sm" id="email_nueva_empre" placeholder="E - Mail">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <input name="web_nueva_empre" type="web" class="form-control input-sm" id="web_nueva_empre" placeholder="Web">
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
                    <button type="button" class="btn btn-success" id="BtnGuardarNuevaEmpresa" data-toggle="modal">
                        <i class="fa fa-save"></i> Guardar
                    </button>
                </div>

            </div>
        </div>
    </div>
    <!-- FIN MODAL PARA NUEVA EMPRESA -->

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
    <script src="../../../public/assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script>
    <script src="../../../public/assets/plugins/bootstrap-select2/select2.min.js" type="text/javascript"></script>
    <script src="../../../public/assets/plugins/jquery-datatable/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="../../../public/assets/plugins/jquery-datatable/extra/js/dataTables.tableTools.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="../../../public/assets/plugins/datatables-responsive/js/datatables.responsive.js"></script>
    <script type="text/javascript" src="../../../public/assets/plugins/datatables-responsive/js/lodash.min.js"></script>
    <script src="../../../public/assets/js/datatables.js" type="text/javascript"></script>
    <script src="../../../public/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="../../../public/assets/plugins/ios-switch/ios7-switch.js" type="text/javascript"></script>
    <script src="../../../public/assets/js/form_elements.js" type="text/javascript"></script>

</body>

</html>                          