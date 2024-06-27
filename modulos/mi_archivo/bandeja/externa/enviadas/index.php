<?php
session_start();
include "../../../../../config/class.Conexion.php";
include( "../../../../../config/variable.php");
include( "../../../../../config/funciones.php");
include( "../../../../../config/funciones_seguridad.php");
require_once '../../../../clases/radicar/class.RadicaRecibido.php';
require_once '../../../../clases/general/class.GeneralFuncionario.php';


?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>...::: Iwana - Bandeja :::...</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- BEGIN PLUGIN CSS -->
    <link href="../../../../../public/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="../../../../../public/assets/plugins/jquery-datatable/css/jquery.dataTables.css" rel="stylesheet" type="text/css"/>
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

    <link href="../../../../../public/assets/css/botones_redondos.css" rel="stylesheet" type="text/css"/>

    <script src="../../../../../public/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>

</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body class="inner-menu-always-open extended-layout">
    <!-- BEGIN HEADER -->
    <?php require_once '../../../../../config/cabeza_busqueda.php'; ?>
    <!-- END HEADER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container row-fluid">
        <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar mini mini-mobile" id="main-menu" data-inner-menu="1">
            <div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrappers">
                <div class="user-info-wrapper">
                    <!-- BEGIN MINI-PROFILE -->
                    <?php require_once '../../../../../config/mini_profile.php'; ?>
                    <!-- END MINI-PROFILE -->
                </div>
                <!-- BEGIN SIDEBAR MENU -->
                <?php require_once '../../../../../config/menu_bandeja.php'; ?>
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
                    <li><a href="#" class="active">Bandeja, Correspondencia enviada, enviadas</a> </li>
                </ul>
                <div id="DivAlertas"> </div>
                <div class="row" id="inbox-wrapper">
                    <input name="tipo_ver" type="hidden" id="tipo_ver" value="VerMiCorrespondencia">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="grid simple" >
                                    <div class="grid-body no-border email-body" >
                                        <br>
                                        <div class="row-fluid" >
                                            <div id="loader" class="text-center">
                                                <img src="../../../../../public/assets/img/loading.gif">
                                            </div>
                                            <div class="outer_div"></div>
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
                                        <div class="" >
                                            <div class="" id="DivRadicadosInfo">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
            <div class="admin-bar" id="quick-access" style="display:">
                <div class="admin-bar-inner">
                    <button class="btn btn-danger  btn-add" type="button"><i class="icon-trash"></i> Tranferir al archivo de gestión</button>
                    <button class="btn btn-white  btn-cancel" type="button">Cancel</button>
                </div>
            </div>
            <!-- END PAGE -->
        </div>
        <!-- BEGIN CHAT -->
        <div class="chat-window-wrapper">
            <div id="main-chat-wrapper" class="inner-content">
                <div class="chat-window-wrapper scroller scrollbar-dynamic" id="chat-users" >
                    <div class="chat-header">
                        <div class="pull-left">
                            <input type="text" placeholder="Buscar">
                        </div>
                        <div class="pull-right">
                            <a href="#" class="" ><div class="iconset top-settings-dark "></div> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END CHAT -->
    </div>

    <?php
    include '../../../../varios/modales_ventanilla.php';
    ?>
    <!-- END CONTAINER -->

    <script>
        $(document).ready(function(){
            load(1);

            $('#BtnRecargar').click(function(){
                load(1);
            });
        });

        function load(page){
            var parametros = {"action":"ajax","page":page,"tipo_listar":"listar", "criterio":"", "tipo_ver":$("#tipo_ver").val()};
            $(".outer_div").fadeIn('slow');
            $("#loader").empty();
            $(".outer_div").empty();
            $.ajax({
                url:'listar.php',
                data: parametros,
                beforeSend: function(objeto){
                    $("#loader").html("<img src='../../../../../public/assets/img/loading.gif'>");
                },
                success:function(data){
                    $(".outer_div").html(data).fadeIn('slow');
                    $("#loader").html("");
                }
            })
        }
    </script>
    <script src="funciones.ajax.js"></script>
    <script src="../../../../../public/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="../../../../../public/assets/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../../../../../public/assets/plugins/breakpoints.js" type="text/javascript"></script>
    <script src="../../../../../public/assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
    <!-- END CORE JS FRAMEWORK -->
    <!-- BEGIN PAGE LEVEL JS -->
    <script src="../../../../../public/assets/plugins/pace/pace.min.js" type="text/javascript"></script>
    <script src="../../../../../public/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
    <script src="../../../../../public/assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="../../../../../public/assets/js/tabs_accordian.js" type="text/javascript"></script>
    <!-- BEGIN CORE TEMPLATE JS -->
    <script src="../../../../../public/assets/js/core.js" type="text/javascript"></script>
    <script src="../../../../../public/assets/js/chat.js" type="text/javascript"></script>
    <script src="../../../../../public/assets/js/demo.js" type="text/javascript"></script>
    <!-- END CORE TEMPLATE JS -->
    <!-- END JAVASCRIPTS -->
    <script src="../../../../../public/assets/sweetalert2/sweetalert-dev.js"></script>
    <link href="../../../../../public/assets/sweetalert2/sweetalert.css" rel="stylesheet" type="text/css">
</body>
</html>