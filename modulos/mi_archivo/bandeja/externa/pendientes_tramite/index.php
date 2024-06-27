<?php
session_start();
include "../../../../../config/class.Conexion.php";
include( "../../../../../config/variable.php");
include( "../../../../../config/funciones.php");
include( "../../../../../config/funciones_seguridad.php");
require_once '../../../../clases/radicar/class.RadicaRecibido.php';
require_once '../../../../clases/general/class.GeneralFuncionario.php';

$Funcionario = Funcionario::Listar(6, 0, "", "", "", 0, 0, 0);
$FuncionarioFirman = Funcionario::Listar(12, 0, "", "", "", 0, 0, 0);

$Combo_Funcionarios = "<option value='0>...::: Todos :::...</option>";
foreach($FuncionarioFirman as $Item):
    $Combo_Funcionarios.= "<option value='".$Item['id_funcio_deta']."'>".$Item['nom_oficina']." - ".$Item['nom_funcio']." ".$Item['ape_funcio']."</option>";
endforeach;
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
    <link href="../../../../../public/assets/plugins/jquery-datatable/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <link href="../../../../../public/assets/plugins/datatables-responsive/css/datatables.responsive.css" rel="stylesheet" type="text/css" media="screen" />
    
    <!-- END CORE CSS FRAMEWORK -->

    <!-- BEGIN CSS TEMPLATE -->
    <link href="../../../../../public/assets/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="../../../../../public/assets/css/responsive.css" rel="stylesheet" type="text/css"/>
    <link href="../../../../../public/assets/css/custom-icon-set.css" rel="stylesheet" type="text/css"/>

    <link href="../../../../../public/assets/css/botones_redondos.css" rel="stylesheet" type="text/css"/>
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
                    <li><a href="#" class="active">Bandeja, Correspondencia enviada, pendientes por tramitar</a> </li>
                </ul>
                <div id="DivAlertas"> </div>
                <div class="row"  id="inbox-wrapper">

                    <input name="tipo_ver" type="hidden" id="tipo_ver" value="VerMiCorrespondencia">
                    <input name="id_radica" type="hidden" id="id_radica">
                    <input name="id_funcio_deta" type="hidden" id="id_funcio_deta">
                    
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
                    <input name="plantillta_generada" id="plantillta_generada" type="hidden">
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

    <!-- BEGIN MODAL PARA LOS ADJUNTAR DOCUMENTO-->
    <div class="modal fade" id="myModalSubirPlantilla" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <br>
                    <i class="fa fa-file-o fa-2x"></i>
                    <h4 id="myModalLabel" class="semi-bold">Subir plantilla.</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <form enctype="multipart/form-data" class="formulario">
                                <input type="file" class="filestyle" data-buttonBefore="true" data-buttonName="btn-success" name="archivo" id="archivo">
                                <input name="id_temp" id="id_temp" type="hidden">
                                <input name="reponsable" id="reponsable" type="hidden">
                                <input name="reponsable" id="reponsable" type="hidden">
                                <input name="accion" id="accion" type="hidden" value="PLANTILLA_SUBIR">
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
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="BtnCancelarCargarDigital">Cancelar</button>
                    <button type="button" class="btn btn-success" id="BtnSubirPlantilla">
                        <i class="fa fa-cloud-upload"></i> Subir
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- END MODAL PARA ADJUNTAR DOCUMETNO -->

    <!-- INICIO MODAL PARA NOTAS-->
    <div class="modal fade" id="myModalNotas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <br>
                    <i class="fa fa-comments fa-2x"></i>
                </div>
                <div class="modal-body">
                    <div class="row-fluid">
                        <div class="grid simple ">
                            <div class="grid-body ">
                                <div class="row">
                                    <div id="DivAlertasNotas"></div>
                                    <div class="row form-row">
                                        <div class="col-md-12">
                                            <select class="select2 form-control" id="id_destina">

                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <textarea id="nota" placeholder="Ingrese la nota..." class="form-control" rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="row form-row" style="overflow:auto; height: 200px">
                                        <div class="col-md-12">
                                            <div id="main-chat-wrapper" class="inner-content">
                                                <div class="user-details-wrapper" data-chat-status="busy" data-chat-user-pic="assets/img/profiles/d.jpg" data-chat-user-pic-retina="assets/img/profiles/d2x.jpg" data-user-name="David Nester">
                                                    <div class="user-profile">
                                                        <img src="../../enviadas/pendientes/assets/img/profiles/h.jpg"  alt="" data-src="assets/img/profiles/h.jpg" data-src-retina="assets/img/profiles/h2x.jpg" width="35" height="35">
                                                    </div>
                                                    <div class="user-details">
                                                        <div class="user-name">
                                                            David Nester
                                                        </div>
                                                        <div class="user-more">
                                                            Busy, Do not disturb
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-small" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success btn-small" id="BtnGuardarNota">
                        <i class="fa fa-check"></i> Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN MODAL PARA NOTAS-->

    <!-- BEGIN MODAL PARA LOS FUNCIONARIOS PARA ASIGNAR GRUPO COLABORATIVO-->
    <div class="modal fade" id="myModalTodosLosFuncionarios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <br>
                    <i class="fa fa-users fa-2x"></i>
                    <h4 id="myModalLabel" class="semi-bold">Funcionarios disponibles.</h4>
                    <p class="no-margin">Elige el funcionario a asignar la creación del grupo colaborativo</p>
                    <br>
                </div>
                <div class="modal-body">
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="grid simple ">
                                <div class="grid-body ">
                                    <table class="table table-hover table-condensed" id="Tbl3">
                                        <thead>
                                            <tr>
                                                <th style="width:30%">Funcionario</th>
                                                <th style="width:30%">Oficina</th>
                                                <th style="width:1%"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach($Funcionario as $Item):
                                                ?>
                                                <tr>
                                                    <td class="v-align-middle">
                                                        <span class="muted">
                                                            <?php 
                                                            echo $Item['nom_funcio']." ".$Item['ape_funcio']; 
                                                            ?>
                                                        </span>
                                                    </td>
                                                    <td class="v-align-middle">
                                                        <?php echo $Item['nom_depen']." - ".$Item['nom_oficina']; ?>
                                                    </td>
                                                    <td class="v-align-middle">
                                                        <button type="button" id="BtnAsignarFuncionarioParCrearGrupoColaborativo" class="btn btn-block btn-success btn-xs btn-mini" data-toggle="modal" data-target="#myModalGrupoColaborativo" data-id_funcio_deta="<?php echo $Item['id_funcio_deta']; ?>" data-funcion="<?php 
                                                        echo $Item['nom_funcio']." ".$Item['ape_funcio']; 
                                                        ?>">
                                                        <i class="fa fa-check"></i></button>
                                                    </td>
                                                </tr>
                                                <?php
                                            endforeach;
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="BtnCerrarModalFuncionarios">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END MODAL PARA LOS FUNCIONARIOS PARA ASIGNAR GRUPO COLABORATIVO-->

    <!-- INICIO MODAL PARA GRUPOS COLABORATIVOS-->
    <div class="modal fade" id="myModalGrupoColaborativo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <br>
                    <i class="fa fa-users fa-2x"></i>
                    <h4 id="myModalLabel" class="semi-bold">Asignar la creación del grupo colaborativo.</h4>
                </div>
                <div class="modal-body">
                    <div class="row-fluid">
                        <div class="grid simple ">
                            <div class="grid-body ">
                                <div class="row">
                                    <div id="DivAlertasGrupoColaborativo"></div>
                                    <div class="row form-row">
                                        <div class="col-md-12">
                                            ¿Desea asignar la creación del grupo colaborativo a:<div id="DivTituloGrupoColaborativo"></div>?
                                        </div>
                                    </div>
                                    <div class="row form-row">
                                        <div class="col-md-12">
                                            <textarea id="observa_grupo_colaborativo" placeholder="Ingrese la nota..." class="form-control" rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-small" data-dismiss="modal" id="BtnCerrarGrupoColaborativo">Cancelar</button>
                    <button type="button" class="btn btn-success btn-small" id="BtnGuardarGrupoColaborativo">
                        <i class="fa fa-check"></i> Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN MODAL PARA GRUPOS COLABORATIVOS-->

    <!-- BEGIN MODAL PARA LOS FUNCIONARIOS PARA EL PASE-->
    <div class="modal fade" id="myModalfuncionariosPase" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <br>
                    <i class="fa fa-users fa-2x"></i>
                    <h4 id="myModalLabel" class="semi-bold">Funcionarios disponibles.</h4>
                    <p class="no-margin">Elige el funcionario para realizar el pase del radicado</p>
                    <br>
                </div>
                <div class="modal-body">
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="grid simple ">
                                <div class="grid-body ">
                                    <table class="table table-hover table-condensed" id="Tbl4">
                                        <thead>
                                            <tr>
                                                <th style="width:30%">Funcionario</th>
                                                <th style="width:30%">Oficina</th>
                                                <th style="width:1%"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach($Funcionario as $Item):
                                                ?>
                                                <tr>
                                                    <td class="v-align-middle">
                                                        <span class="muted">
                                                            <?php 
                                                            echo $Item['nom_funcio']." ".$Item['ape_funcio']; 
                                                            ?>
                                                        </span>
                                                    </td>
                                                    <td class="v-align-middle">
                                                        <?php echo $Item['nom_depen']." - ".$Item['nom_oficina']; ?>
                                                    </td>
                                                    <td class="v-align-middle">
                                                        <button type="button" id="BtnRealizarPase" class="btn btn-block btn-success btn-xs btn-mini" data-id_funcio_deta="<?php echo $Item['id_funcio_deta']; ?>" data-funcionario="<?php echo $Item['nom_funcio']." ".$Item['ape_funcio']; 
                                                        ?>">
                                                        <i class="fa fa-check"></i></button>
                                                    </td>
                                                </tr>
                                                <?php
                                            endforeach;
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="BtnCerrarModalFuncionarios">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END MODAL PARA LOS FUNCIONARIOS PARA EL PASE-->
    
    <!-- BEGIN MODAL LISTAR HISTORIAL DE PASE -->
    <div class="modal fade" id="myModalHistoriaPase" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <br>
                    <i class="fa fa-tag fa-2x"></i>
                    <h4 id="myModalLabel" class="semi-bold">Historia de pases.</h4>
                    <br>
                </div>
                <div class="modal-body">
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="grid simple ">
                                <div class="grid-body no-border">
                                    <div id="DivListarHistoriaPase"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="BtnCerrarClasificacionDocumental">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END MODAL LISTAR HISTORIAL DE PASE -->
    <?php
    include '../../../../varios/modales_ventanilla.php';
    ?>
    <!-- END CONTAINER --> 
    <script src="../../../../../public/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            load(1);

            $("#TxtBuscarCorrespondencia").keyup(function(e){
                if(e.which == 13){
                    var parametros = {"action":"ajax","page":1,"tipo_listar":"buscar", "criterio":$("#TxtBuscarCorrespondencia").val(), "tipo_ver":$("#tipo_ver").val()};
                    $(".outer_div").fadeIn('slow');
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
            });

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


    <script src="../../../../../public/assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script>
    <script src="../../../../../public/assets/plugins/bootstrap-select2/select2.min.js" type="text/javascript"></script>
    <script src="../../../../../public/assets/plugins/jquery-datatable/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="../../../../../public/assets/plugins/jquery-datatable/extra/js/dataTables.tableTools.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="../../../../../public/assets/plugins/datatables-responsive/js/datatables.responsive.js"></script>
    <script type="text/javascript" src="../../../../../public/assets/plugins/datatables-responsive/js/lodash.min.js"></script>
    <script src="../../../../../public/assets/js/datatables.js" type="text/javascript"></script>
    <script src="../../../../../public/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="../../../../../public/assets/plugins/ios-switch/ios7-switch.js" type="text/javascript"></script>
    <script src="../../../../../public/assets/js/form_elements.js" type="text/javascript"></script>

</body>
</html>