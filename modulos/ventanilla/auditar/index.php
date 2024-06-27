<?php
session_start();
include "../../../config/class.Conexion.php";
include( "../../../config/variable.php");
include( "../../../config/funciones.php");
include( "../../../config/funciones_seguridad.php");
require_once '../../clases/radicar/class.RadicaRecibido.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>...::: Iwana - Ventanilla, Auditoria :::...</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN PLUGIN CSS -->
    <!-- BEGIN PLUGIN CSS -->
    <link href="../../../public/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="../../../public/assets/plugins/jquery-datatable/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <link href="../../../public/assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="../../../public/assets/plugins/datatables-responsive/css/datatables.responsive.css" rel="stylesheet" type="text/css" media="screen" />
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

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="inner-menu-always-open">
    <!-- BEGIN HEADER -->
    <?php require_once '../../../config/cabeza.php'; ?>
    <!-- END HEADER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container row-fluid">
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
                       
                    </div>
                    <div class="inner-wrapper">
                        <p class="menu-title">VISTA RÁPIDA</p>
                    </div>
                    <ul class="small-items">
                        
                    </ul>
                </div>
            </div>
        </div>
        <a href="#" class="scrollup">Scroll</a>
        <!-- BEGIN PAGE -->
        <div class="page-content">
            <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
            <div id="portlet-config" class="modal hide">
                <div class="modal-header">
                    <button data-dismiss="modal" class="close" type="button"></button>
                    <h3>Widget Settings</h3>
                </div>
                <div class="modal-body">
                    Widget settings form goes here
                </div>
            </div>
            <div class="clearfix">
            </div>
            <div class="content">
                <ul class="breadcrumb">
                    <li>
                        <p>Tú estas</p>
                    </li>
                    <li>
                        <a href="#" class="active">Ventanilla - Auditoria de correspondencia.</a>
                    </li>
                </ul>
                <div class="page-title" style="display:none">
                    <a href="#" id="btn-back">
                        <i class="icon-custom-left"></i>
                    </a>
                    <h3>Regresar - <span class="semi-bold">Consulta de Correspondencia</span></h3>
                    <div id="DivAlertas"></div>
                </div>
                <div class="row" id="inbox-wrapper">
                    <div class="col-md-12">
                        <div class="row">
                            <form role="form" name="FrmDatos" id="FrmDatos">
                            <div class="col-md-12">
                                <div class="grid simple">
                                    <div class="grid-title no-border">
                                        <h4 class=" inline">
                                            <span class="text-success">
                                                <i class="fa fa-search"></i> Auditoria,
                                            </span> de Correspondencia
                                        </h4>
                                    </div>
                                    <div class="grid-body no-border">
                                        <div class="row form-row">
                                            <div class="row-fluid" style="display:none;" id="DivOtrosElementos">
                                                <div class="slide-success">
                                                    <input type="checkbox" name="switch" class="iosblue" checked="checked"/>
                                                </div>
                                                <div class="slide-primary">
                                                    <input type="checkbox" name="switch" class="ios" checked="checked" placeholder="Requiere respuesta" />
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <input name="id_radica" type="text" class="form-control" id="id_radica" placeholder="# De Radicado" value="20180504-02050">
                                            </div>
                                            
                                            <div class="col-md-2">
                                                <div class="input-append success date">
                                                    <input name="desde" type="text" class="form-control" id="desde" placeholder="Desde la fecha">
                                                    <span class="add-on">
                                                        <span class="arrow"></span>
                                                        <i class="fa fa-th"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="input-append success date">
                                                    <input name="hasta" type="text" class="form-control" id="hasta" placeholder="Hasta la fecha">
                                                    <span class="add-on">
                                                        <span class="arrow"></span>
                                                        <i class="fa fa-th"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <select name="origen" id="origen" class="select2 form-control">
                                                    <option value="0">...::: Elije el origen de la correspondencia :::...</option>
                                                    <option value="Recibido">Correspondencia Recibida</option>
                                                    <option value="Enviado">Correspondencia Enviada</option>
                                                    <option value="Interna">Correspondencia Interna</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row form-row">
                                            <div class="col-md-4"> 
                                                <input name="asunto" type="text" class="form-control" id="asunto" placeholder="Asunto">
                                            </div>
                                            <div class="col-md-3">
                                                <div class="input-group" id="InputGroupTercero">
                                                    <input name="id_tercero" id="id_tercero" type="hidden">
                                                    <input name="tipo_tercero" id="tipo_tercero" type="hidden">
                                                    <input name="tercero" type="text" class="form-control" id="tercero" placeholder="Tercero">
                                                    <div class="input-group-btn">
                                                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                                            <i class="fa fa-ellipsis-v"></i>
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu pull-right" role="menu">
                                                            <li>
                                                                <a href="#" data-toggle="modal" data-target="#myModalTerceroNatural" id="BtnBuscarTerceroNatural">Buscar tercero natural</a>
                                                            </li>
                                                            <li>
                                                                <a href="#" data-toggle="modal" data-target="#myModalTerceroJuridico" id="BtnBuscarTerceroJuridico">Buscar tercero juridico</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <input name="id_destinatario" id="id_destinatario" type="hidden" value="">
                                                <input name="destinatario" type="text" class="form-control" id="destinatario" placeholder="Destinatario">
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-success btn-sm btn-small" data-toggle="modal" data-target="#myModalDestinatarios" id="BtnBuscarDestinatario">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="row form-row">
                                            <div class="col-md-3">
                                                <select name="id_depen" id="id_depen" class="select2 form-control"  >
                                                    <option value="0">...::: Todas Las Dependencias :::...</option>
                                                    <?php echo $Combo_Dependencias; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <select name="id_serie" id="id_serie" class="select2 form-control"  >
                                                    <option value="0">...::: Todas Las Series :::...</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <select name="id_subserie" id="id_subserie" class="select2 form-control"  >
                                                    <option value="0">...::: Todas Las Subseries :::...</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <select name="id_tipodoc" id="id_tipodoc" class="select2 form-control"  >
                                                    <option value="0">...::: Elije el Tipo de Documento :::...</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-actions">  
                                            <div class="pull-left">
                                                <button class="btn btn-white btn-cons" type="button" id="BtnLimpiar" name="BtnLimpiar"><span class="fa fa-search"></span> Limpiar</button>
                                                <button class="btn btn-primary btn-cons" type="submit" id="BtnBuscar" name="BtnBuscar"><span class="fa fa-search"></span> Buscar</button>
                                            </div>
                                        </div>    
                                    </div>
                                </div>
                            </div>
                        </form>
                            <div class="col-md-12">
                                <div class="grid simple">
                                    <div class="grid-body no-border email-body">
                                        <br>
                                        <div class="row-fluid">
                                            <div id="email-list">
                                                <div id="DivResultados"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" id="preview-email-wrapper" style="display:none">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="grid simple">
                                    <div class="grid-title no-border">
                                        <h4></h4>
                                        <div class="tools">
                                            <a href="javascript:;" class="remove"></a>
                                        </div>
                                    </div>
                                    <div class="grid-body no-border" style="min-height: 850px;">
                                        <div class="">
                                            <div class="" id="DivRadicadosInfo">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE -->
        </div>
        <!-- BEGIN CHAT -->
        <div class="chat-window-wrapper">
            <div id="main-chat-wrapper" class="inner-content">
            </div>
        </div>
    </div>
   
    <script src="../../../public/assets/plugins/jquery-1.8.3.min.js"></script>
    <script src="funciones.ajax.js"></script>
    <script src="../../../public/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="../../../public/assets/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../../../public/assets/plugins/breakpoints.js" type="text/javascript"></script>
    <script src="../../../public/assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
    <!-- END CORE JS FRAMEWORK -->
    <!-- BEGIN PAGE LEVEL JS -->
    <script src="../../../public/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
    <script src="../../../public/assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script>
    <script src="../../../public/assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
    <script src="../../../public/assets/plugins/bootstrap-select2/select2.min.js" type="text/javascript"></script>
    <script src="../../../public/assets/plugins/jquery-datatable/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="../../../public/assets/plugins/jquery-datatable/extra/js/dataTables.tableTools.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="../../../public/assets/plugins/datatables-responsive/js/datatables.responsive.js"></script>
    <script type="text/javascript" src="../../../public/assets/plugins/datatables-responsive/js/lodash.min.js"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="../../../public/assets/js/datatables.js" type="text/javascript"></script>
    <script src="../../../public/assets/js/email_comman.js" type="text/javascript"></script>
    <!-- BEGIN CORE TEMPLATE JS -->
    <script src="../../../public/assets/js/core.js" type="text/javascript"></script>
    <script src="../../../public/assets/js/chat.js" type="text/javascript"></script>
    <script src="../../../public/assets/js/demo.js" type="text/javascript"></script>
    <!-- END CORE TEMPLATE JS -->
    <!-- END JAVASCRIPTS -->
    <script src="../../../public/assets/sweetalert2/sweetalert-dev.js"></script>
    <link href="../../../public/assets/sweetalert2/sweetalert.css" rel="stylesheet" type="text/css">
    <script src="../../../public/assets/css/bootstrap-filestyle.min.js"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="../../../public/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="../../../public/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <script src="../../../public/assets/plugins/jquery-inputmask/jquery.inputmask.min.js" type="text/javascript"></script>
    <script src="../../../public/assets/plugins/ios-switch/ios7-switch.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="../../../public/assets/plugins/boostrap-form-wizard/js/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
    <script src="../../../public/assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
    <script src="../../../public/assets/js/form_validations.js" type="text/javascript"></script>
    <script src="../../../public/assets/js/form_elements.js" type="text/javascript"></script>
</body>
</html>