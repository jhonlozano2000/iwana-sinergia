<?php
session_start();
require_once '../../../config/variable.php';
require_once '../../../config/funciones.php';
require_once '../../../config/funciones_seguridad.php';
require_once '../../../config/class.Conexion.php';
require_once("../../clases/seguridad/class.SeguridadUsuario.php");
require_once("../../clases/seguridad/class.SeguridadModulo.php");
require_once "../../clases/areas/class.AreasDependencia.php";
require_once "../../clases/general/class.GeneralFuncionarioAccesoDigitalizados.php";

$Dependencia = new Dependencia();
$Dependencia = Dependencia::Listar(6, "", "", "", "");;
$Combo_Dependencias = "";

foreach($Dependencia as $Item):
    $Combo_Dependencias.= "<option value='".$Item['id_depen']."'>".$Item['cod_corres'].".".$Item['nom_depen']."</option>";
endforeach;
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>...::: Iwana - Oficina de Archivo, Digitalización :::...</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <link href="../../../public/assets/plugins/jquery-metrojs/MetroJs.min.js" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="../../../public/assets/plugins/shape-hover/css/demo.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/assets/plugins/shape-hover/css/component.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/assets/plugins/owl-carousel/owl.carousel.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/assets/plugins/owl-carousel/owl.theme.css" />
    <link href="../../../public/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="../../../public/assets/plugins/jquery-slider/css/jquery.sidr.light.css" rel="stylesheet" type="text/css" media="screen"/>
    <link rel="stylesheet" href="../../../public/assets/plugins/jquery-ricksaw-chart/css/rickshaw.css" type="text/css" media="screen" >
    <link rel="stylesheet" href="../../../public/assets/plugins/Mapplic/mapplic/mapplic.css" type="text/css" media="screen" >
    <!-- BEGIN CORE CSS FRAMEWORK -->
    <link href="../../../public/assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="../../../public/assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
    <link href="../../../public/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
    <link href="../../../public/assets/css/animate.min.css" rel="stylesheet" type="text/css"/>
    <link href="../../../public/assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css"/>
    <!-- END CORE CSS FRAMEWORK -->

    <!-- BEGIN CSS TEMPLATE -->
    <link href="../../../public/assets/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="../../../public/assets/css/responsive.css" rel="stylesheet" type="text/css"/>
    <link href="../../../public/assets/css/custom-icon-set.css" rel="stylesheet" type="text/css"/>
    <link href="../../../public/assets/css/magic_space.css" rel="stylesheet" type="text/css"/>
    <!-- END CSS TEMPLATE -->
    <script src="../../../public/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
    <link href="menuarbolaccesible.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="menuarbolaccesible.js"></script>
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
                        <a href="#" class="active">Oficina de Archivo - Digitalización.</a>
                    </li>
                </ul>
                <!-- BEGIN DASHBOARD TILES -->
                <form role="form" name="FrmDatos" id="FrmDatos">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="grid simple" >
                                <div class="grid-title no-border">
                                    <h4>Condensed <span class="semi-bold">Layout</span></h4>
                                </div>
                                <div class="grid-body no-border" style="min-height: 850px;">
                                    <ul id="menu1">
                                        <li>HTML 
                                            <ul>
                                                <li>HTML3 
                                                    <ul>
                                                        <li><a href="#">Especificaci&oacute;n</a></li>
                                                        <li><a href="#">Referencia</a></li>
                                                    </ul>
                                                </li>
                                                <li>HTML4 
                                                    <ul>
                                                        <li>Especificaci&oacute;n
                                                            <ul>
                                                                <li><a href="#">Todo bien qqqqqqqqqqqqqqqqqqqqqq</a></li>
                                                            </ul>
                                                        </li>
                                                        <li><a href="#">Referencia</a></li>
                                                        <li><a href="#">Especificaci&oacute;n</a></li>
                                                        <li><a href="#">Referencia</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>XHTML 
                                            <ul>
                                                <li><a href="#">Modularizaci&oacute;n</a></li>
                                                <li>XHTML1.0 
                                                    <ul>
                                                        <li><a href="#">Transitional</a></li>
                                                        <li><a href="#">Frameset</a></li>
                                                        <li><a href="#">Strict</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="#">XHTML1.1</a></li>
                                                <li><a href="#">XHTML2</a></li>
                                            </ul>
                                        </li>
                                        <li>Javascript 
                                            <ul>
                                                <li><a href="#">Javascript CORE</a></li>
                                                <li><a href="#">Javascript DOM</a></li>
                                                <li>&Uacute;ltimas versiones 
                                                    <ul>
                                                        <li><a href="#">Javascript 1.5</a></li>
                                                        <li><a href="#">Javascript 1.6</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="#">Jscript</a></li>
                                            </ul>
                                        </li>
                                        <li>XML 
                                            <ul>
                                                <li><a href="#">Historia</a></li>
                                                <li><a href="#">Especificaci&oacute;n</a></li>
                                                <li><a href="#">Esquemas XML</a></li>
                                                <li><a href="#">XML DOM</a></li>
                                            </ul>
                                        </li>
                                    </ul>

                                    <?php
                                    $AccesoSeriesDigitales = FuncionarioAccesoDigital::Listar(2, $_SESSION['SesionFuncioDetaId'], "", "");
                                    foreach ($AccesoSeriesDigitales as $ItemSeries) {

                                       ?>
                                       <ul id="menu1">
                                        <li>
                                            <?php 
                                            echo $ItemSeries['cod_serie'].".".$ItemSeries['nom_serie']; 
                                            $AccesoSubSeriesDigitales = FuncionarioAccesoDigital::Listar(2, $_SESSION['SesionFuncioDetaId'], $ItemSeries['id_serie'], "");
                                            foreach ($AccesoSubSeriesDigitales as $ItemSubSeries) {
                                                ?>
                                                <ul>
                                                    <li><?php echo $ItemSeries['cod_subserie'].".".$ItemSeries['nom_subserie']; ?> 
                                                        <ul>
                                                            <li><a href="#">Especificaci&oacute;n</a></li>
                                                            <li><a href="#">Referencia</a></li>
                                                        </ul>
                                                    </li>
                                                    <li>HTML4 
                                                        <ul>
                                                            <li>Especificaci&oacute;n
                                                                <ul>
                                                                    <li><a href="#">Todo bien qqqqqqqqqqqqqqqqqqqqqq</a></li>
                                                                </ul>
                                                            </li>
                                                            <li><a href="#">Referencia</a></li>
                                                            <li><a href="#">Especificaci&oacute;n</a></li>
                                                            <li><a href="#">Referencia</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                        <?php
                                    }
                                    ?>
                                    <script type="text/javascript">
                                        iniciaMenu('menu1');

                                    </script>

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
    <script src="../../../public/assets/plugins/jquery-metrojs/MetroJs.min.js" type="text/javascript" ></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN CORE TEMPLATE JS -->
    <script src="../../../public/assets/js/core.js" type="text/javascript"></script>
    <script src="../../../public/assets/js/chat.js" type="text/javascript"></script>
    <script src="../../../public/assets/js/demo.js" type="text/javascript"></script>
    <script src="../../../public/assets/js/dashboard_v2.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".live-tile,.flip-list").liveTile();
        });
    </script>


    <!-- END CORE TEMPLATE JS -->
</body>
</html>
