<?php
session_start();
include "../../../../config/class.Conexion.php";
include "../../../../config/variable.php";
include "../../../../config/funciones.php";
include "../../../../config/funciones_seguridad.php";
include "../../../clases/radicar/class.RadicaEnviado.php";

$RadicadoMin = "";
$RadicadoMax = "";
$Radicados = RadicadoEnviado::Listar_Varios(8, "", "", "", "", "", "", "", "", Fecha_Actual());
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
    <link href="../../../../public/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="../../../../public/assets/plugins/bootstrap-tag/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />
    <link href="../../../../public/assets/plugins/dropzone/css/dropzone.css" rel="stylesheet" type="text/css" />
    <link href="../../../../public/assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css" />
    <link href="../../../../public/assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" type="text/css" />
    <link href="../../../../public/assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.css" rel="stylesheet" type="text/css" />
    <link href="../../../../public/assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet" type="text/css" />
    <link href="../../../../public/assets/plugins/ios-switch/ios7-switch.css" rel="stylesheet" type="text/css" media="screen">
    <link href="../../../../public/assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="../../../../public/assets/plugins/boostrap-clockpicker/bootstrap-clockpicker.min.css" rel="stylesheet" type="text/css" media="screen" />
    <!-- END PLUGIN CSS -->

    <!-- BEGIN CORE CSS FRAMEWORK -->
    <link href="../../../../public/assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../../../../public/assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="../../../../public/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="../../../../public/assets/css/animate.min.css" rel="stylesheet" type="text/css" />
    <link href="../../../../public/assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" />
    <!-- END CORE CSS FRAMEWORK -->

    <!-- BEGIN CSS TEMPLATE -->
    <link href="../../../../public/assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="../../../../public/assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="../../../../public/assets/css/custom-icon-set.css" rel="stylesheet" type="text/css" />
    <!-- END CSS TEMPLATE -->
    <link href="../../../../public/assets/plugins/boostrap-slider/css/slider.css" rel="stylesheet" type="text/css" />
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
                    <div class="inner-wrapper">
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
                        <a href="#" class="active">Radicar - Planilla de correpondencia recibida.</a>
                    </li>
                </ul>
                <div id="DivAlertas"></div>
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
                                                <input type="checkbox" name="switch" class="iosblue" checked="checked" />
                                            </div>
                                            <div class="slide-primary">
                                                <input type="checkbox" name="switch" class="ios" checked="checked" />
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
                                            <input name="radicado_desde" type="text" class="form-control" id="radicado_desde" placeholder="Desde el # de radicado" value="<?php echo $RadicadoMin; ?>">
                                        </div>
                                        <div class="col-md-12">
                                            <input name="radicado_hasta" type="text" class="form-control" id="radicado_hasta" placeholder="Hasta el # de radicado" value="<?php echo $RadicadoMax; ?>">
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



                <!-- BEGIN RADIO/TOGGLE CONTROLS-->
                <div class="row" style="display:none;">
                    <div class="col-md-12">
                        <div class="grid simple">
                            <div class="grid-title no-border">
                                <h4>Toggle <span class="semi-bold">Controls</span></h4>
                                <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
                            </div>
                            <div class="grid-body no-border">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h3>Color <span class="semi-bold">Options</span></h3>
                                        <p>Pure CSS radio button with a cool animation. These are available in all primary colors in bootstrap</p>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="radio">
                                                    <input id="male" type="radio" name="gender" value="male" checked="checked">
                                                    <label for="male">Male</label>
                                                    <input id="female" type="radio" name="gender" value="female">
                                                    <label for="female">Female</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="radio radio-success">
                                                    <input id="yes" type="radio" name="optionyes" value="yes">
                                                    <label for="yes">Agree</label>
                                                    <input id="no" type="radio" name="optionyes" value="no" checked="checked">
                                                    <label for="no">Disagree</label>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="col-md-4">
                                        <h3>State <span class="semi-bold">Options</span></h3>
                                        <p>Use of different color opacity helps to destigues between different states such as disable</p>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="radio radio-primary">
                                                    <input id="Disabled" type="radio" name="Disabled" value="Disabled" disabled="disabled">
                                                    <label for="Disabled">Disabled</label>
                                                    <input id="ADisabled" type="radio" name="ADisabled" value="ADisabled" checked="checked" disabled="disabled">
                                                    <label for="ADisabled">Disabled</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h3>Slide <span class="semi-bold">Toggle</span></h3>
                                        <p>A cool iOS7 slide toggle. These are cutomize for all boostrap colors</p>
                                        <br>
                                        <div class="row-fluid">
                                            <div class="slide-primary">
                                                <input type="checkbox" name="switch" class="ios" checked="checked" />
                                            </div>
                                            <div class="slide-success">
                                                <input type="checkbox" name="switch" class="iosblue" checked="checked" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END RADIO/TOGGLE CONTROLS-->



                <!-- BEGIN DATEPICKER CONTROLS-->
                <div class="row" style="display:none;">
                    <div class="col-md-12">
                        <div class="grid simple">
                            <div class="grid-title no-border">
                                <h4>Date <span class="semi-bold">Controls</span></h4>
                                <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
                            </div>
                            <div class="grid-body no-border">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h3>Simple Date<span class="semi-bold"> Picker</span></h3>
                                        <p>Date picker is powered by boostrap date picker, this is customized in way that it suites our theme and design, Have a look!</p>
                                        <br>
                                        <div class="input-append success date col-md-10 col-lg-6 no-padding">
                                            <input type="text" class="form-control">
                                            <span class="add-on"><span class="arrow"></span><i class="fa fa-th"></i></span>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="col-md-4">
                                        <h3>Over<span class="semi-bold">view</span></h3>
                                        <p>Here is an attached calender in case you want to see how it looks like, this is only used for a demo purpose</p>
                                        <br>
                                        <div id="dp5" data-date="12-02-2013" data-date-format="dd-mm-yyyy"></div>
                                    </div>
                                    <div class="col-md-4">
                                        <h3>Advance <span class="semi-bold">Settings</span></h3>
                                        <p>Some advance setting that you can do with this calender, like to start from years an disable sections of dates</p>
                                        <br>
                                        <div class="input-append success date col-md-10 col-lg-6">
                                            <input type="text" class="form-control" id="sandbox-advance">
                                            <span class="add-on"><span class="arrow"></span><i class="fa fa-th"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>

        <!-- BEGIN CHAT -->
        <!-- END CHAT -->
    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN CORE JS FRAMEWORK-->
    <script src="../../../../public/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
    <script src="funciones.ajax.js"></script>
    <script src="../../../../public/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/breakpoints.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>

    <!-- END CORE JS FRAMEWORK -->
    <script src="../../../../public/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="../../../../public/assets/plugins/pace/pace.min.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/jquery-inputmask/jquery.inputmask.min.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/jquery-autonumeric/autoNumeric.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/ios-switch/ios7-switch.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/bootstrap-select2/select2.min.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/bootstrap-tag/bootstrap-tagsinput.min.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/boostrap-clockpicker/bootstrap-clockpicker.min.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/dropzone/dropzone.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="../../../../public/assets/js/form_elements.js" type="text/javascript"></script>
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="../../../../public/assets/js/core.js" type="text/javascript"></script>
    <script src="../../../../public/assets/js/chat.js" type="text/javascript"></script>
    <script src="../../../../public/assets/js/demo.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- END JAVASCRIPTS -->
</body>

</html>