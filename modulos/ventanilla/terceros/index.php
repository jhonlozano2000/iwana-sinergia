<?php
session_start();
include "../../../config/class.Conexion.php";
include("../../../config/variable.php");
include("../../../config/funciones.php");
include("../../../config/funciones_seguridad.php");
require_once '../../clases/seguridad/class.SeguridadPermiso.php';
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

                <div class="row" id="inbox-wrapper">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="grid simple">
                                    <div class="grid-body no-border email-body">
                                        <a href="agre.php" class="btn btn-primary btn-circle">
                                            <i class="glyphicon glyphicon-plus"></i>
                                        </a>
                                        <br>
                                        <div class="row-fluid">
                                            <div class="row form-row">
                                                <div class="col-md-10">
                                                    <input name="TxtBusTerceroJuridicos" type="text" class="form-control" id="TxtBusTerceroJuridicos" placeholder="Ingrese los criterios del tercero natural a consultar">
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <div class="pull-left">
                                                    <button class="btn btn-success btn-cons" type="button" id="BtnBuscar" name="BtnBuscar">
                                                        <span class="fa fa-search"></span> Buscar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="grid simple">
                                    <div class="grid-body no-border email-body">
                                        <br>
                                        <div id="DivListardoTerceros">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
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

    <?php
    include '../../varios/ayudas.php';
    ?>

    <script src="../../../public/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
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

</html>         