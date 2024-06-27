<?php
session_start();
include "../../../../../config/class.Conexion.php";
include "../../../../../config/variable.php";
include "../../../../../config/funciones.php";
include "../../../../../config/funciones_seguridad.php";
include "../../../../clases/oficina_archivo/configuracion/class.ArchivoProducDocumenTipo.php";
include "../../../../clases/oficina_archivo/configuracion/class.ArchivoProducDocumenTipoComponen.php";

$ComponentesTipoDocumento = ArchivoProducDocumenTipoComponen::Listar(2, "", 1);
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>...::: Iwana :::...</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN PLUGIN CSS -->
    <link href="../../../../../public/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="../../../../../public/assets/plugins/bootstrap-tag/bootstrap-tagsinput.css" rel="stylesheet" type="text/css"/>
    <link href="../../../../../public/assets/plugins/dropzone/css/dropzone.css" rel="stylesheet" type="text/css"/>
    <link href="../../../../../public/assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css"/>
    
    <link href="../../../../../public/assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" type="text/css" />
    <link href="../../../../../public/assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.css" rel="stylesheet" type="text/css" />
    <link href="../../../../../public/assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet" type="text/css" />
    <link href="../../../../../public/assets/plugins/ios-switch/ios7-switch.css" rel="stylesheet" type="text/css" media="screen">
    <link href="../../../../../public/assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="../../../../../public/assets/plugins/boostrap-clockpicker/bootstrap-clockpicker.min.css" rel="stylesheet" type="text/css" media="screen"/>
    <!-- END PLUGIN CSS -->

    <!-- BEGIN CORE CSS FRAMEWORK -->
    <link href="../../../../../public/assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="../../../../../public/assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
    <link href="../../../../../public/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
    <link href="../../../../../public/assets/css/animate.min.css" rel="stylesheet" type="text/css"/>
    <link href="../../../../../public/assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css"/>
    <!-- END CORE CSS FRAMEWORK -->

    <!-- BEGIN CSS TEMPLATE -->
    <link href="../../../../../public/assets/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="../../../../../public/assets/css/responsive.css" rel="stylesheet" type="text/css"/>
    <link href="../../../../../public/assets/css/custom-icon-set.css" rel="stylesheet" type="text/css"/>
    <!-- END CSS TEMPLATE -->
    <link href="../../../../../public/assets/plugins/boostrap-slider/css/slider.css" rel="stylesheet" type="text/css"/>

    <script src="../../../../../public/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>

    <script src="../../../../../public/assets/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>
    <script src="../../../../../public/assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>
    <link href="../../../../../public/assets/plugins/bootstrap-wysihtml5/wysiwyg-color.css" rel="stylesheet" type="text/css"/>
    
    <link rel="stylesheet" href="./minified/themes/default.min.css" id="theme-style" />
          
    <script src="./minified/sceditor.min.js"></script>
    <script src="./minified/icons/monocons.js"></script>
    <script src="./minified/formats/bbcode.js"></script>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="inner-menu-always-open">
    <!-- BEGIN HEADER -->
    <div class="header navbar navbar-inverse">
        <!-- BEGIN TOP NAVIGATION BAR -->
        <div class="navbar-inner">
            <?php include_once '../../../../../config/cabeza.php'; ?>
        </div>
        <!-- END TOP NAVIGATION BAR --> 
    </div>
    <!-- END HEADER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container row-fluid">
        <div class="page-sidebar mini mini-mobile" id="main-menu" data-inner-menu="1">
            <div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrappers">
                <!-- BEGIN MINI-PROFILE -->
                <div class="user-info-wrapper"> 
                    <?php include_once '../../../../../config/mini_profile.php'; ?>
                </div>
                <!-- END MINI-PROFILE -->
                <!-- BEGIN SIDEBAR MENU --> 
                <?php include_once '../../../../../config/menu_bandeja.php'; ?>
                <!-- END SIDEBAR MENU --> 
            </div>
            <div class="inner-menu nav-collapse">   
                <div id="inner-menu">
                    <div class="inner-wrapper" >    
                        <a href="../redactar/index.php" class="btn btn-block btn-primary" >
                            <span class="bold">REDACTAR</span>
                        </a>
                    </div>
                    <div class="inner-menu-content">
                        <p class="menu-title">MIS COMUNICACIONES EXTERNAS <span class="pull-right"><i class="icon-refresh"></i></span></p>
                    </div>
                    <div class="inner-menu-content">
                        <p class="menu-title"> <span class="pull-right"><i class="icon-refresh"></i></span></p>
                    </div>
                    <ul class="small-items">
                        <li class="active">
                            <a href="../recibidas/index.php"> Ir a la correspondencia externa recibida</a>
                        </li>
                        <li class="active">
                            <a href="../enviadas/index.php"> Ir a la correspondencia externa enviada</a>
                        </li>
                    </ul>
                    <ul class="big-items">
                        <li class="">
                            <a href="../pendientes_tramite/index.php"> 
                                <span class="btn btn-danger btn-sm btn-small label label-important">
                                    <i class="fa fa-bullhorn"></i> Mis Pendientes por <br>tramitar
                                </span>
                            </a>
                        </li>
                        <li class="">
                            <a href="../pendientes_gestionar/index.php"> 
                                <span class="btn btn-success btn-sm btn-small label label-important">
                                    <i class="fa fa-bullhorn"></i> Mis Pendientes por <br>gestionar
                                </span>
                            </a>
                        </li>
                        <li class="">
                            <a href="../grupos_colaborativos/index.php"> 
                                <span class="btn btn-success btn-sm btn-small label label-important">
                                    <i class="fa fa-crosshairs"></i> Mis grupos <br>colaborativos por crear
                                </span>
                            </a>
                        </li>
                    </ul>
                    <ul class="small-items">
                        <li class="">
                            <a href="../compartidos/index.php"> 
                                <span class="btn btn-info btn-sm btn-small label label-important">
                                    <i class="fa fa-users"></i> Documentos <br>compartidos conmigo
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <a href="#" class="scrollup">Scroll</a>
        <!-- BEGIN PAGE -->
        <div class="page-content">
            <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
            <div class="clearfix"></div>
            <div class="content">
                <ul class="breadcrumb">
                    <li>
                        <p>ESTÁS AQUÍ</p>
                    </li>
                    <li><a href="#" class="active">Bandeja, Correspondencia externa, redactar</a> </li>
                    <button type="button" class="bt btn-success" id="BtnEnviar">Enviar</button>
                </ul>
                <div id="DivAlertas"></div>
                <div class="row">
                    <form role="form" name="FrmDatosPlantilla" id="FrmDatosPlantilla">

                        <input name="accion" type="hidden" id="accion">

                        <div class="col-md-12">
                            <textarea id="example" style="height:300px;width:600px;">[center][size=3][b]BBCode SCEditor[/b][/size][/center]

Give it a try! :)

[color=#ff00]Red text! [/color][color=#3399ff]Blue?[/color]

[ul][li]A simple list[/li][li]list item 2[/li][/ul]

If you are using IE9+ or any non-IE browser just type [b]:[/b]) and it should be converted into :) as you type.</textarea>
                            <div class="row">
                                <?php
                                foreach($ComponentesTipoDocumento as $Item):
                                ?>
                                <div class="col-md-8">
                                    <div class="grid simple">
                                        <div class="grid-title no-border">
                                            <h4><i class="fa fa-list text-info"></i>
                                                <span class="semi-bold text-info"><?php echo $Item['nom_compo']; ?></span>
                                            </h4>
                                        </div>
                                        <div class="grid-body no-border">
                                            <p><?php echo $Item['descripcion']; ?></p>
                                            <br>
                                            <textarea id="<?php echo $Item['id_compo']; ?>" placeholder="Enter text ..." class="form-control" rows="<?php echo $Item['num_filas']; ?>"></textarea>
                                            
                                        </div>
                                    </div>
                                </div>
                                <?php
                            endforeach;
                            ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="clearfix">
            </div>
        </div>

        <div class="clearfix">
        </div>
    </div>

    <!-- BEGIN CORE JS FRAMEWORK-->
    <script type="text/javascript" src="funciones.ajax.js"></script>
    <script src="../../../../../public/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="../../../../../public/assets/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../../../../../public/assets/plugins/breakpoints.js" type="text/javascript"></script>
    <script src="../../../../../public/assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>

    <!-- END CORE JS FRAMEWORK -->
    <script src="../../../../../public/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
    <script src="../../../../../public/assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="../../../../../public/assets/plugins/pace/pace.min.js" type="text/javascript"></script>
    <script src="../../../../../public/assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script> 
    <script src="../../../../../public/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="../../../../../public/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <script src="../../../../../public/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js" type="text/javascript"></script>
    <script src="../../../../../public/assets/plugins/jquery-inputmask/jquery.inputmask.min.js" type="text/javascript"></script>
    <script src="../../../../../public/assets/plugins/jquery-autonumeric/autoNumeric.js" type="text/javascript"></script>
    <script src="../../../../../public/assets/plugins/ios-switch/ios7-switch.js" type="text/javascript"></script>
    <script src="../../../../../public/assets/plugins/bootstrap-select2/select2.min.js" type="text/javascript"></script>
    
    <script src="../../../../../public/assets/plugins/bootstrap-tag/bootstrap-tagsinput.min.js" type="text/javascript"></script>
    <script src="../../../../../public/assets/plugins/boostrap-clockpicker/bootstrap-clockpicker.min.js" type="text/javascript"></script>
    <script src="../../../../../public/assets/plugins/dropzone/dropzone.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="../../../../../public/assets/js/form_elements.js" type="text/javascript"></script>
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="../../../../../public/assets/js/core.js" type="text/javascript"></script>
    <script src="../../../../../public/assets/js/chat.js" type="text/javascript"></script> 
    <script src="../../../../../public/assets/js/demo.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- END JAVASCRIPTS -->
    <script>
        var textarea = document.getElementById('example');
        sceditor.create(textarea, {
            format: 'bbcode',
            icons: 'monocons',
            style: './minified/themes/content/default.min.css'
        });

        var theme = './minified/themes/square.min.css';
        document.getElementById('theme-style').href = theme;
    </script>
</body>
</html>