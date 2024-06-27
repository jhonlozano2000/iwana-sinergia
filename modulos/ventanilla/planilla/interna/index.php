<?php
session_start();
include "../../../../config/class.Conexion.php";
include "../../../../config/variable.php";
include "../../../../config/funciones.php";
include "../../../../config/funciones_seguridad.php";
include "../../../clases/radicar/class.RadicaRecibido.php";

$RadicadoMin = "";
$RadicadoMax = "";
$Radicados = RadicadoRecibido::Listar_Vario(8, "", "", "", "", "", "", "", "", Fecha_Actual());
foreach ($Radicados as $Item) {
    $RadicadoMin = $Item['RadicadoMin'];
    $RadicadoMax = $Item['RadicadoMax'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- BEGIN PLUGIN CSS -->
    <link href="../../../../public/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="../../../../public/assets/plugins/boostrap-checkbox/css/bootstrap-checkbox.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="../../../../public/assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css"/>
    <!-- END PLUGIN CSS -->

    <!-- BEGIN PLUGIN CSS -->


    <link href="../../../../public/assets/plugins/boostrap-clockpicker/bootstrap-clockpicker.min.css" rel="stylesheet" type="text/css" media="screen"/>
    <!-- END PLUGIN CSS -->


    <!-- BEGIN CORE CSS FRAMEWORK -->
    <link href="../../../../public/assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="../../../../public/assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
    <link href="../../../../public/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
    <link href="../../../../public/assets/css/animate.min.css" rel="stylesheet" type="text/css"/>
    <link href="../../../../public/assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css"/>
    <link href="../../../../public/assets/plugins/ios-switch/ios7-switch.css" rel="stylesheet" type="text/css" media="screen">
    <!-- END CORE CSS FRAMEWORK -->

    <!-- BEGIN CSS TEMPLATE -->
    <link href="../../../../public/assets/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="../../../../public/assets/css/responsive.css" rel="stylesheet" type="text/css"/>
    <link href="../../../../public/assets/css/custom-icon-set.css" rel="stylesheet" type="text/css"/>
    <!-- END CSS TEMPLATE -->

</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body class="inner-menu-always-open">
    <!-- BEGIN HEADER -->
    <div class="header navbar navbar-inverse "> 
        <!-- BEGIN TOP NAVIGATION BAR -->
        <div class="navbar-inner">
            <?php include_once '../../../../config/cabeza_ventanilla_form.php'; ?>
        </div>
        <!-- END TOP NAVIGATION BAR --> 
    </div>
    <!-- END HEADER --> 
    <!-- BEGIN CONTAINER -->
    <div class="page-container row-fluid"> 
        <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar mini mini-mobile" id="main-menu" data-inner-menu="1">
            <div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrappers">
                <!-- BEGIN MINI-PROFILE -->
                <div class="user-info-wrapper">	
                    <?php include_once '../../../../config/mini_profile.php'; ?>
                </div>
                <!-- END MINI-PROFILE -->
                <!-- BEGIN SIDEBAR MENU -->	
                <?php include_once '../../../../config/menu_ventanilla.php'; ?>
                <!-- END SIDEBAR MENU --> 
            </div>

            <div class="inner-menu nav-collapse">   
                <div id="inner-menu">
                    <div class="inner-wrapper" >            
                        <p class="menu-title">Accesos rápidos</p>    
                    </div>
                    <ul class="small-items">
                        <li id="Ultimos3Dias" class=""><a href="#"> Últimos 3 días</a></li>
                        <li id="Ultimos5Dias" class=""><a href="#"> Últimos 5 días</a></li>
                        <li id="Ultimos7Dias" class=""><a href="#"> Última semana</a></li>
                        <li id="Ultimos14Dias" class=""><a href="#"> Últimas 2 semanas</a></li>
                        <li id="Ultimos30Dias" class=""><a href="#"> Último mes</a></li>
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
                <div class="modal-body"> Widget settings form goes here </div>
            </div>
            <div class="clearfix"></div>
            <div class="content">
                <ul class="breadcrumb">
                    <li>
                        <p>Tú estas</p>
                    </li>
                    <li>
                        <a href="#" class="active">Radicar - Planilla de correpondencia interna.</a>
                    </li>
                </ul>
                <div id="DivAlertasPlanillaInternas"></div>                        
                <div class="row">
                    <div class="col-md-6">
                        <div class="grid simple">
                            <div class="grid-title no-border">
                                <h4><span class="text-success">Planilla,</span> por rango de fechas</h4>
                            </div>
                            <div class="grid-body no-border">
                                <form id="form_traditional_validation" action="#">
                                    <div class="row form-row">
                                        <div class="row-fluid" style="display:none;" id="DivOtrosElementos">
                                            <div class="slide-success">
                                                <input type="checkbox" name="switch" class="iosblue" checked="checked"/>
                                            </div>
                                            <div class="slide-primary">
                                                <input type="checkbox" name="switch" class="ios" checked="checked"/>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <div class="input-append success date slide-success slide-primary">
                                                <input name="switch" type="text" class="form-control iosblue ios" id="desde_fec" placeholder="Desde">
                                                <span class="add-on"><span class="arrow"></span><i class="fa fa-th"></i></span>
                                            </div>
                                        </div>
                                        <div class="input-group transparent clockpicker col-md-6">
                                            <input type="text" class="form-control" placeholder="Desde la hora" id="desde_hora">
                                            <span class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row form-row">
                                        <div class="form-group col-md-6">
                                            <div class="input-append success date slide-success slide-primary">
                                                <input name="switch" type="text" class="form-control iosblue ios" id="hasta_fec" placeholder="Hasta">
                                                <span class="add-on"><span class="arrow"></span><i class="fa fa-th"></i></span>
                                            </div>
                                        </div>

                                        <div class="input-group transparent clockpicker col-md-6">
                                            <input type="text" class="form-control" placeholder="Hasta la hora" id="hasta_hora">
                                            <span class="input-group-addon ">
                                                <i class="fa fa-clock-o"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-actions">  
                                        <div class="pull-right">
                                            <button class="btn btn-white btn-cons" type="button" id="BtnLimpiarPlanillaEnviadas" name="BtnLimpiarPlanillaEnviadas">
                                                <span class="fa fa-search"></span> Limpiar
                                            </button>
                                            <button class="btn btn-primary btn-cons" type="submit" id="BtnBuscarPorFecha" name="BtnBuscarPorFecha">
                                                <span class="fa fa-search"></span> Buscar
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="grid simple">
                            <div class="grid-title no-border">
                                <h4><span class="text-success">Planilla,</span> por rango de radicados</h4>
                            </div>
                            <div class="grid-body no-border">
                                <form id="form_traditional_validation" action="#">
                                    <div class="row form-row">
                                        <div class="col-md-12">
                                            <input name="radicado_desde" type="text" class="form-control" id="radicado_desde" placeholder="Desde el # de radicado"  value="<?php echo $RadicadoMin; ?>">
                                        </div>
                                        <div class="col-md-12">
                                            <input name="radicado_hasta" type="text" class="form-control" id="radicado_hasta" placeholder="Hasta el # de radicado"  value="<?php echo $RadicadoMax; ?>">
                                        </div>
                                    </div>
                                    <div class="form-actions">  
                                        <div class="pull-right">
                                            <button class="btn btn-white btn-cons" type="button" id="BtnLimpiarPlanillaEnviadas" name="BtnLimpiarPlanillaEnviadas">
                                                <span class="fa fa-search"></span> Limpiar
                                            </button>
                                            <button class="btn btn-primary btn-cons" type="submit" id="BtnBuscarPorRadicados" name="BtnBuscarPorRadicados">
                                                <span class="fa fa-search"></span> Buscar
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>	
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
        <!-- END PAGE --> 
        <!-- BEGIN CHAT --> 
        <div class="chat-window-wrapper">
            <?php include_once '../../../chat/chat.php'; ?>
        </div>
        <!-- END CHAT -->
    </div>
    <!-- END CONTAINER --> 
    <script src="../../../../public/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script> 
    <script src="funciones.ajax.js"></script>
    <script src="../../../../public/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script> 
    <script src="../../../../public/assets/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script> 
    <script src="../../../../public/assets/plugins/breakpoints.js" type="text/javascript"></script> 
    <script src="../../../../public/assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
    <!-- END CORE JS FRAMEWORK --> 
    <!-- BEGIN PAGE LEVEL JS --> 	
    <script src="../../../../public/assets/plugins/pace/pace.min.js" type="text/javascript"></script>  
    <script src="../../../../public/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script> 
    <script src="../../../../public/assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script> 
    <script src="../../../../public/assets/sweetalert2/sweetalert-dev.js"></script>
    <link rel="stylesheet" type="text/css" href="../../../../public/assets/sweetalert2/sweetalert.css">
    <!-- END PAGE LEVEL PLUGINS --> 	
    <!-- BEGIN CORE TEMPLATE JS --> 
    <script src="../../../../public/assets/js/core.js" type="text/javascript"></script> 
    <script src="../../../../public/assets/js/chat.js" type="text/javascript"></script> 
    <script src="../../../../public/assets/js/demo.js" type="text/javascript"></script> 
    <!-- BEGIN PAGE LEVEL JS -->
    <script src="../../../../public/assets/plugins/bootstrap-select2/select2.min.js" type="text/javascript"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="../../../../public/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/jquery-inputmask/jquery.inputmask.min.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/ios-switch/ios7-switch.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- END CORE JS FRAMEWORK -->
    <script src="../../../../public/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="../../../../public/assets/plugins/boostrap-clockpicker/bootstrap-clockpicker.min.js" type="text/javascript"></script>
    <script src="../../../../public/assets/js/form_elements.js" type="text/javascript"></script>
</body>
</html>