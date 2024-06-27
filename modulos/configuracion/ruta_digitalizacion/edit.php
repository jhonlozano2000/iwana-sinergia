<?php
session_start();
require_once '../../../config/variable.php';
require_once '../../../config/funciones.php';
require_once '../../../config/funciones_seguridad.php';
require_once '../../../config/class.Conexion.php';
require_once '../../clases/seguridad/class.SeguridadUsuario.php';
require_once '../../clases/configuracion/class.ConfigServidor_Digitalizacion.php';

$Ruta = ServidorDigitalizacion::Buscar(2, $_REQUEST['id'], "");

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>...::: Iwana - Configuración, Rutas Digitalización :::...</title>
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
                        <a href="#" class="active">Configuración, Rutas Digitalización.</a>
                    </li>
                </ul>
                <div id="DivAlerta"></div>
                <!-- BEGIN DASHBOARD TILES -->
                <form role="form" name="FrmDatos" id="FrmDatos">

                    <input name="accion" id="accion" type="hidden" value="EDITAR">
                    <input name="id_ruta" type="hidden" id="id_ruta" value="<?php echo $Ruta->get_IdRuta(); ?>">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="grid simple">
                                <div class="grid-body no-border">
                                    <div class="row column-seperation">
                                        <div class="col-md-6">
                                            <h4><span class="text-warning">Editar</span>, Información básica de la ruta para digitalización</h4>   
                                            <div class="row form-row">
                                                <div class="col-md-6">
                                                    <input name="servidor" type="text" class="form-control" id="servidor" placeholder="Servidor" value="<?php echo $Ruta->get_Servidor(); ?>">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <input name="ruta" type="text" class="form-control" id="ruta" placeholder="Ruta" value="<?php echo $Ruta->get_Ruta(); ?>">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-6">
                                                    <input name="usua" type="text" class="form-control" id="usua" placeholder="Usuario" value="<?php echo $Ruta->get_Usua(); ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <input name="contra" type="text" class="form-control" id="contra" placeholder="Contraseña" value="<?php echo $Ruta->get_Contra(); ?>">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <textarea name="observa" id="observa" class="form-control" placeholder="Ingrese las observaciones si las hay..." cols="" rows=""><?php echo $Ruta->get_Observa(); ?></textarea>
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-8">
                                                    <div class="checkbox check-success">
                                                        <?php
                                                        if($Ruta->get_Acti() == 1){
                                                            $checked = "checked";
                                                        }else{
                                                            $checked = "";
                                                        }
                                                        ?>
                                                        <input id="acti" type="checkbox" name="checkbox2" id="checkbox2" <?php echo $checked; ?>>
                                                        <label for="checkbox2">Activo</label>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-6">

                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="pull-left">
                                            <button class="btn btn-warning btn-cons" type="button" id="BtnEditar" name="BtnEditar">
                                                <i class="glyphicon glyphicon-pencil"></i></span> Editar
                                            </button>
                                            <button class="btn btn-white btn-cons" type="button" id="BtnRegresar" name="BtnRegresar">
                                                <span class="fa fa-mail-reply-all"></span> Regresar
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
    <script src="../../../public/assets/sweetalert2/sweetalert-dev.js"></script>
    <link href="../../../public/assets/sweetalert2/sweetalert.css" rel="stylesheet" type="text/css">

    <!-- END CORE TEMPLATE JS -->
</body>
</html>
