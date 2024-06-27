<?php
session_start();
require_once '../../../../config/variable.php';
require_once '../../../../config/funciones.php';
require_once '../../../../config/funciones_seguridad.php';
require_once '../../../../config/class.Conexion.php';
require_once '../../../clases/seguridad/class.SeguridadUsuario.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>...::: Iwana - Reportes, Ofi. Archivo :::...</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link href="../../../../public/assets/plugins/jquery-metrojs/MetroJs.min.js" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="../../../../public/assets/plugins/shape-hover/css/demo.css" />
    <link rel="stylesheet" type="text/css" href="../../../../public/assets/plugins/shape-hover/css/component.css" />
    <link rel="stylesheet" type="text/css" href="../../../../public/assets/plugins/owl-carousel/owl.carousel.css" />
    <link rel="stylesheet" type="text/css" href="../../../../public/assets/plugins/owl-carousel/owl.theme.css" />
    <link href="../../../../public/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="../../../../public/assets/plugins/jquery-slider/css/jquery.sidr.light.css" rel="stylesheet" type="text/css" media="screen"/>
    <link rel="stylesheet" href="../../../../public/assets/plugins/jquery-ricksaw-chart/css/rickshaw.css" type="text/css" media="screen" >
    <link rel="stylesheet" href="../../../../public/assets/plugins/Mapplic/mapplic/mapplic.css" type="text/css" media="screen" >
    <!-- BEGIN CORE CSS FRAMEWORK -->
    <link href="../../../../public/assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="../../../../public/assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
    <link href="../../../../public/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
    <link href="../../../../public/assets/css/animate.min.css" rel="stylesheet" type="text/css"/>
    <link href="../../../../public/assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css"/>
    <!-- END CORE CSS FRAMEWORK -->

    <!-- BEGIN CSS TEMPLATE -->
    <link href="../../../../public/assets/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="../../../../public/assets/css/responsive.css" rel="stylesheet" type="text/css"/>
    <link href="../../../../public/assets/css/custom-icon-set.css" rel="stylesheet" type="text/css"/>
    <link href="../../../../public/assets/css/magic_space.css" rel="stylesheet" type="text/css"/>
    <!-- END CSS TEMPLATE -->
    <script src="../../../../public/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
    <link href="../../../mi_archivo/archivo_digitalizado/menuarbolaccesible.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../../../mi_archivo/archivo_digitalizado/menuarbolaccesible.js"></script>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="">
    <!-- BEGIN HEADER -->
    <?php require_once '../../../../config/cabeza.php'; ?>
    <!-- END HEADER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container row-fluid">
        <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar" id="main-menu">
            <!-- BEGIN MINI-PROFILE -->
            <div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrapper">
                <?php require_once '../../../../config/mini_profile.php'; ?>
                <!-- END MINI-PROFILE -->
                <!-- BEGIN SIDEBAR MENU -->
                <?php require_once '../../../../config/menu.php'; ?>
                <!-- END SIDEBAR MENU -->
            </div>
        </div>
        <div class="footer-widget">
            <?php require_once '../../../../config/footer-widget.php'; ?>
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
                        <a href="#" class="active">Reportes, Ofi. Archivo.</a>
                    </li>
                </ul>
                <div id="DivAlerta"></div>
                <!-- BEGIN DASHBOARD TILES -->
                <form role="form" name="FrmDatos" id="FrmDatos">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="grid simple">
                                <div class="grid-title no-border">
                                    <h4>TRD</h4>
                                </div>
                                <div class="grid-body no-border">
                                    <div class="row-fluid">
                                        <div class="btn-group">
                                            <button class="btn btn-small btn-white btn-demo-space">TRD</button>
                                            <button class="btn btn-small btn-white dropdown-toggle btn-demo-space" data-toggle="dropdown"> 
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="trd/index.php" target="_blank">
                                                        <p class="text-error">
                                                            <i class="fa fa-file-pdf-o fa-lg" aria-hidden="true"></i> Pdf
                                                        </p>
                                                    </a>
                                                </li>
                                                <li class="divider"></li>
                                                <li>
                                                    <a href="trd/trd_excel.php" target="_blank">
                                                        <p class="text-success">
                                                            <i class="fa fa-file-excel-o fa-lg" aria-hidden="true"></i> Excel
                                                        </p>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <br>
                                        <div class="btn-group">
                                            <button class="btn btn-small btn-white btn-demo-space">Series y Subseries</button>
                                            <button class="btn btn-small btn-white dropdown-toggle btn-demo-space" data-toggle="dropdown"> 
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="series_subserie/index.php" target="_blank">
                                                        <p class="text-error">
                                                            <i class="fa fa-file-pdf-o fa-lg" aria-hidden="true"></i> Pdf
                                                        </p>
                                                    </a>
                                                </li>
                                                <li class="divider"></li>
                                                <li>
                                                    <a href="subserie/subserie_excel.php" target="_blank">
                                                        <p class="text-success">
                                                            <i class="fa fa-file-excel-o fa-lg" aria-hidden="true"></i> Excel
                                                        </p>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <br>
                                        <div class="btn-group">
                                            <button class="btn btn-small btn-white btn-demo-space">Series</button>
                                            <button class="btn btn-small btn-white dropdown-toggle btn-demo-space" data-toggle="dropdown"> 
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="serie/index.php" target="_blank">
                                                        <p class="text-error">
                                                            <i class="fa fa-file-pdf-o fa-lg" aria-hidden="true"></i> Pdf
                                                        </p>
                                                    </a>
                                                </li>
                                                <li class="divider"></li>
                                                <li>
                                                    <a href="serie/serie_excel.php" target="_blank">
                                                        <p class="text-success">
                                                            <i class="fa fa-file-excel-o fa-lg" aria-hidden="true"></i> Excel
                                                        </p>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <br>
                                        <div class="btn-group">
                                            <button class="btn btn-small btn-white btn-demo-space">Subseries</button>
                                            <button class="btn btn-small btn-white dropdown-toggle btn-demo-space" data-toggle="dropdown"> 
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="subserie/index.php" target="_blank">
                                                        <p class="text-error">
                                                            <i class="fa fa-file-pdf-o fa-lg" aria-hidden="true"></i> Pdf
                                                        </p>
                                                    </a>
                                                </li>
                                                <li class="divider"></li>
                                                <li>
                                                    <a href="subserie/subserie_excel.php" target="_blank">
                                                        <p class="text-success">
                                                            <i class="fa fa-file-excel-o fa-lg" aria-hidden="true"></i> Excel
                                                        </p>
                                                    </a>
                                                </li>
                                            </ul>
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
            <?php require_once '../../../chat/chat.php'; ?>
        </div>
        <!-- END CHAT -->		  
    </div>
    <!-- END CONTAINER -->

    <!-- BEGIN CORE JS FRAMEWORK-->
    <script src="../../../../public/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/breakpoints.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/jquery-lazyload/jquery.lazyload.min.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
    <!-- END CORE JS FRAMEWORK -->
    <!-- BEGIN PAGE LEVEL JS -->
    <script src="../../../../public/assets/plugins/jquery-slider/jquery.sidr.min.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/pace/pace.min.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/jquery-ricksaw-chart/js/raphael-min.js"></script>
    <script src="../../../../public/assets/plugins/jquery-ricksaw-chart/js/d3.v2.js"></script>
    <script src="../../../../public/assets/plugins/jquery-ricksaw-chart/js/rickshaw.min.js"></script>
    <script src="../../../../public/assets/plugins/jquery-sparkline/jquery-sparkline.js"></script>
    <script src="../../../../public/assets/plugins/skycons/skycons.js"></script>
    <script src="../../../../public/assets/plugins/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>

    <script src="../../../../public/assets/plugins/jquery-flot/jquery.flot.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/jquery-flot/jquery.flot.resize.min.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/jquery-metrojs/MetroJs.min.js" type="text/javascript" ></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN CORE TEMPLATE JS -->
    <script src="../../../../public/assets/js/core.js" type="text/javascript"></script>
    <script src="../../../../public/assets/js/chat.js" type="text/javascript"></script>
    <script src="../../../../public/assets/js/demo.js" type="text/javascript"></script>
    <script src="../../../../public/assets/js/dashboard_v2.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".live-tile,.flip-list").liveTile();
        });
    </script>


    <!-- END CORE TEMPLATE JS -->
</body>
</html>
