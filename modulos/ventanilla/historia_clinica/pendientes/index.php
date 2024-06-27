<?php
session_start();
include "../../../../config/class.Conexion.php";
include( "../../../../config/variable.php");
include( "../../../../config/funciones.php");
include( "../../../../config/funciones_seguridad.php");
require_once("../../../clases/seguridad/class.SeguridadMostrarBuscar.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>...::: Iwana - Ventanilla :::...</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- BEGIN PLUGIN CSS -->
    <link href="../../../../public/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="../../../../public/assets/plugins/jquery-datatable/css/jquery.dataTables.css" rel="stylesheet" type="text/css"/>
    <!-- END PLUGIN CSS -->

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
    <!-- END CSS TEMPLATE -->

</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body class="inner-menu-always-open extended-layout">
    <!-- BEGIN HEADER -->
    <?php require_once '../../../../config/cabeza_busqueda.php'; ?>
    <!-- END HEADER --> 
    <!-- BEGIN CONTAINER -->
    <div class="page-container row-fluid"> 
        <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar mini mini-mobile" id="main-menu" data-inner-menu="1">
            <div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrappers">
                <div class="user-info-wrapper">	
                    <!-- BEGIN MINI-PROFILE -->
                    <?php require_once '../../../../config/mini_profile.php'; ?>
                    <!-- END MINI-PROFILE -->
                </div>
                <!-- BEGIN SIDEBAR MENU -->
                <?php require_once '../../../../config/menu_ventanilla.php'; ?>
                <!-- END SIDEBAR MENU -->
            </div>

            <div class="inner-menu nav-collapse">   
                <div id="inner-menu">
                    <div class="inner-wrapper" >    
                        <a href="../../enviada/enviadas/radicar.php" class="btn btn-block btn-primary" >
                            <span class="bold">RADICAR</span>
                        </a>
                    </div>
                    <div class="inner-menu-content">
                        <p class="menu-title">VISTA RAPIDA <span class="pull-right"><i class="icon-refresh"></i></span></p>
                    </div>
                    <ul class="small-items">
                        <li class="">
                            <a href="../../recibida/recibidas/index.php"> Ir a la correspondencia recibida</a>
                        </li>
                        <li class="">
                            <a href="../../enviada/enviadas/index.php"> Ir a la correspondencia enviada</a>
                        </li>
                        <li class="">
                            <a href="../../interna/interna/index.php"> Ir a la correspondencia interna</a>
                        </li>
                    </ul>
                    <ul class="big-items">
                        <li class="">
                            <a href="../../enviada/pendien_radicar/index.php"> 
                                <span class="btn btn-success btn-sm btn-small label label-important">
                                    <i class="fa fa-bullhorn"></i> <span>Solicitudes de HC<br> pendientes por entregar</span>
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
                    <li>
                        <a href="#" class="active">Radicar - Correspondencia enviada, Solicitud de historia clínica pendientes por entregar.</a>
                    </li>
                </ul>
                <div id="DivAlertas"> </div>
                <div class="page-title" style="display:none"> 
                    <a href="#" id="btn-back">
                        <i class="icon-custom-left"></i>
                    </a>
                    <h3>Regresar- <span class="semi-bold">Correspondencia enviada</span></h3>
                </div>		
                <div class="row"  id="inbox-wrapper">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="grid simple" >
                                    <div class="grid-body no-border email-body" >
                                        <br>
                                        <div class="row-fluid" >
                                            <div id="loader" class="text-center"> 
                                                <img src="../../../../public/assets/img/loading.gif">
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
    <!-- END CONTAINER --> 
    <!-- BEGIN MODAL PARA LOS ADJUNTAR DOCUMENTO-->
    <div class="modal fade" id="myModalAdjuntarDocumento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <br>
                    <i class="fa fa-file-o fa-2x"></i>
                    <h4 id="myModalLabel" class="semi-bold">Adjuntar documento.</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <form enctype="multipart/form-data" class="formulario">
                                <input type="file" class="filestyle" data-buttonBefore="true" data-buttonName="btn-success" name="archivo" id="archivo">
                                <input name="id_radicado" id="id_radicado" type="hidden">
                                <input name="id_depen" id="id_depen" type="hidden">
                                <input name="accion" id="accion" type="hidden" value="RECIBIDOS_UPLOAD">
                            </form>
                        </div>
                    </div>
                    <!-- LISTAR LOS FUNCIONARIOS PARA QUIEVES VA DIRIGIDA LA CORREPONDENCIA-->

                    <!-- FIN DE LISTAR LOS FUNCIONARIOS PARA QUIEVES VA DIRIGIDA LA CORREPONDENCIA-->
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="grid simple ">
                                <div class="grid-body ">
                                    <div id="DivAlertarAdjuntoDigital"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="BtnCancelarSubirDigital">Cancelar</button>
                    <button type="button" class="btn btn-success" id="BtnSubirDigital">
                        <i class="fa fa-cloud-upload"></i> Subir
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- END MODAL PARA ADJUNTAR DOCUMETNO -->
    <!-- BEGIN MODAL PARA IMPRIMIR ROTULO-->
    <div class="modal fade" id="myModalImprimirRotulo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <br>
                    <i class="fa fa-credit-card fa-2x"></i>
                    <h4 id="myModalLabel" class="semi-bold">Imprimir Rotulo.</h4>
                    <div id="ojo"></div>
                </div>
                <div class="modal-body">
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="grid simple ">
                                <div class="grid-body ">
                                    <iframe width="100%" height="300px" id="ifrImprimirRotulo"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END MODAL PARA IMPRIMIR ROTULO-->
    
    <?php
    include '../../../varios/ayudas.php';
    ?>
    <script src="../../../../public/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            load(1);

            $("#TxtBuscarCorrespondencia").keyup(function(e){
                if(e.which == 13){
                    var parametros = {"action":"ajax","page":1,"tipo_listar":"buscar", "criterio":$("#TxtBuscarCorrespondencia").val()};
                    $(".outer_div").fadeIn('slow');
                    $.ajax({
                        url:'listar.php',
                        data: parametros,
                        beforeSend: function(objeto){
                            $("#loader").html("<img src='../../../../public/assets/img/loading.gif'>");
                        },
                        success:function(data){
                            $(".outer_div").html(data).fadeIn('slow');
                            $("#loader").html("");
                        }
                    })
                }
            });

            $('#BtnRecargar').click(function(){
                load(1);
            });
        });

        function load(page){
            var parametros = {"action":"ajax","page":page,"tipo_listar":"listar", "criterio":""};
            $(".outer_div").fadeIn('slow');
            $.ajax({
                url:'listar.php',
                data: parametros,
                beforeSend: function(objeto){
                    $("#loader").html("<img src='../../../../public/assets/img/loading.gif'>");
                },
                success:function(data){
                    $(".outer_div").html(data).fadeIn('slow');
                    $("#loader").html("");
                }
            })
        }
    </script>
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
    <!-- END PAGE LEVEL PLUGINS --> 	
    <script src="../../../../public/assets/js/email_comman.js" type="text/javascript"></script> 
    <!-- BEGIN CORE TEMPLATE JS --> 
    <script src="../../../../public/assets/js/core.js" type="text/javascript"></script> 
    <script src="../../../../public/assets/js/chat.js" type="text/javascript"></script> 
    <script src="../../../../public/assets/js/demo.js" type="text/javascript"></script> 
    <!-- END CORE TEMPLATE JS --> 
    <!-- END JAVASCRIPTS -->
    <script src="../../../../public/assets/sweetalert2/sweetalert-dev.js"></script>
    <link href="../../../../public/assets/sweetalert2/sweetalert.css" rel="stylesheet" type="text/css">
</body>
</html>