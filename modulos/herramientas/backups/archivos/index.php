<?php
session_start();
include "../../../../config/class.Conexion.php";
require_once '../../../clases/areas/class.AreasDependencia.php';
include( "../../../../config/variable.php");
include( "../../../../config/funciones.php");
include( "../../../../config/funciones_seguridad.php");
require_once '../../../clases/general/class.GeneralFuncionario.php';
require_once("../../../clases/configuracion/class.ConfigServidor_Gestion.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>...::: Iwana - Herramientas :::...</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN PLUGIN CSS -->
    <!-- BEGIN PLUGIN CSS -->
    <link href="../../../../public/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="../../../../public/assets/plugins/jquery-datatable/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <link href="../../../../public/assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="../../../../public/assets/plugins/datatables-responsive/css/datatables.responsive.css" rel="stylesheet" type="text/css" media="screen" />
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
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="inner-menu-always-open">
    <!-- BEGIN HEADER -->
    <?php require_once '../../../../config/cabeza.php'; ?>
    <!-- END HEADER -->

    <!-- BEGIN CONTAINER -->
    <div class="page-container row-fluid">
        <div class="page-sidebar mini mini-mobile" id="main-menu" data-inner-menu="1">
            <div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrappers">
                <!-- BEGIN MINI-PROFILE -->
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
                    <div class="inner-wrapper">
                        <p class="menu-title">Accesos RÁPIDA</p>
                    </div>
                    <ul class="small-items">
                        <li class="">
                            <a href="../../../ventanilla/enviada/pendien_radicar/index.php"><span class="btn btn-success btn-sm btn-small label label-important"><i class="fa fa-bell-o"></i> Pendientes por radicar</span></a>
                        </li>
                        <li class="">
                            <a href="../../../ventanilla/enviada/recibida/alertas/index.php"><span class="btn btn-danger btn-sm btn-small label label-important"><i class="fa fa-bell-o"></i> Alertas</span></a>
                        </li>
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
                <div class="modal-body">
                    Widget settings form goes here
                </div>
            </div>
            <div class="clearfix">
            </div>
            <div class="content">
                <ul class="breadcrumb">
                    <li>
                        <p>Tú estas</p>
                    </li>
                    <li>
                        <a href="#" class="active">Radicar - Consulta de Correspondencia.</a>
                    </li>
                </ul>
                <div id="DivAlertas"></div>
                <form role="form" name="FrmDatos" id="FrmDatos">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="grid simple">
                                <div class="grid-body no-border">
                                    <div class="row column-seperation">
                                        <div class="col-md-6">
                                            <h4>
                                                <span class="text-success">
                                                    <i class="glyphicon glyphicon-check"></i> Rango de fechas, 
                                                </span>para el Backup.
                                            </h4>         
                                            <div class="row form-row">
                                                <div class="row-fluid" style="display:none;" id="DivOtrosElementos">
                                                    <div class="slide-success">
                                                        <input type="checkbox" name="switch" class="iosblue" checked="checked"/>
                                                    </div>
                                                    <div class="slide-primary">
                                                        <input type="checkbox" name="switch" class="ios" checked="checked" placeholder="Requiere respuesta" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-append success date">
                                                        <input name="desde" type="text" class="form-control" id="desde" placeholder="Desde la fecha" value="04/19/2018">
                                                        <span class="add-on">
                                                            <span class="arrow"></span>
                                                            <i class="fa fa-th"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-append success date">
                                                        <input name="hasta" type="text" class="form-control" id="hasta" placeholder="Hasta la fecha" value="04/19/2018">
                                                        <span class="add-on">
                                                            <span class="arrow"></span>
                                                            <i class="fa fa-th"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h4>
                                                <span class="text-success">
                                                    <i class="glyphicon glyphicon-check"></i> Dependencia, 
                                                </span> para generar Backup.
                                            </h4>
                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <div class="checkbox check-success">
                                                        <input id="ChkTemp" type="checkbox" name="ChkTemp">
                                                        <label for="ChkTemp"> Repositorio de archivos temporales,</label>
                                                        <span class="text-success"> archivos digitales de la correspondencia recibida.</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <div class="checkbox check-success">
                                                        <input id="ChkDigita" type="checkbox" name="ChkDigita">
                                                        <label for="ChkDigita"> Repositorio de archivos digitalizados</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <span class="text-success"> Repositorio de archivos del archivo de gestión.</span>
                                                    <table class="table table-hover table-condensed" id="Tbl1">
                                                        <thead>
                                                            <tr>
                                                                <th style="width:10%"></th>
                                                                <th style="width:5%">Acti</th>
                                                                <th style="width:35%">Dependencia</th>
                                                                <th style="width:40%">Ruta</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $ServidorGestion = ServidorGestion::Listar(1, "", "", "", "");
                                                            foreach($ServidorGestion as $Item):
                                                                ?>
                                                                <tr>
                                                                    <td class="v-align-middle">
                                                                        <div class="checkbox check-success  ">
                                                                            <input id="ChkGestion<?php echo $Item['id_ruta'];?>" type="checkbox" checked name="ChkGestion[]" value="<?php echo $Item['id_ruta'];?>">
                                                                            <label for="ChkGestion<?php echo $Item['id_ruta'];?>"> </label>
                                                                        </div>
                                                                    </td>
                                                                    <td class="v-align-middle">
                                                                        <?php
                                                                        if($Item['acti'] == 1){
                                                                            echo "<span class='badge bg-green'>.</span>";
                                                                        }else{
                                                                            echo "<span class='badge bg-red'>.</span>";
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td class="v-align-middle">
                                                                        <span class="muted">
                                                                            <?php echo $Item['nom_depen']; ?>
                                                                        </span>
                                                                    </td>
                                                                    <td class="v-align-middle">
                                                                        <span class="muted">
                                                                            <?php echo $Item['ruta']; ?>
                                                                        </span>
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
                                    <div class="form-actions">
                                        <div class="pull-left">
                                            <button class="btn btn-primary btn-cons" type="button" id="BtnGenerarBackup" name="BtnGenerarBackup">
                                                <span class="glyphicon glyphicon-check"></span> Guardar
                                            </button>
                                            <button class="btn btn-success btn-cons" type="button" id="BtnEnviarEmail" name="BtnEnviarEmail">
                                                <span class="fa fa-envelope"></span> Enviar E - Mail
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- END PAGE -->
        </div>
        <!-- BEGIN CHAT -->
        <div class="chat-window-wrapper">
            <div id="main-chat-wrapper" class="inner-content">
            </div>
        </div>

        <script src="../../../../public/assets/plugins/jquery-1.8.3.min.js"></script>
        <script src="funciones.ajax.js"></script>
        <script src="../../../../public/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
        <script src="../../../../public/assets/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../../../../public/assets/plugins/breakpoints.js" type="text/javascript"></script>
        <script src="../../../../public/assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
        <!-- END CORE JS FRAMEWORK -->
        <!-- BEGIN PAGE LEVEL JS -->
        <script src="../../../../public/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
        <script src="../../../../public/assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script>
        <script src="../../../../public/assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
        <script src="../../../../public/assets/plugins/bootstrap-select2/select2.min.js" type="text/javascript"></script>
        <script src="../../../../public/assets/plugins/jquery-datatable/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="../../../../public/assets/plugins/jquery-datatable/extra/js/dataTables.tableTools.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="../../../../public/assets/plugins/datatables-responsive/js/datatables.responsive.js"></script>
        <script type="text/javascript" src="../../../../public/assets/plugins/datatables-responsive/js/lodash.min.js"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="../../../../public/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
        <script src="../../../../public/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
        <script src="../../../../public/assets/plugins/jquery-inputmask/jquery.inputmask.min.js" type="text/javascript"></script>
        <script src="../../../../public/assets/plugins/ios-switch/ios7-switch.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <script src="../../../../public/assets/plugins/boostrap-form-wizard/js/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
        <script src="../../../../public/assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="../../../../public/assets/js/form_validations.js" type="text/javascript"></script>
        <script src="../../../../public/assets/js/form_elements.js" type="text/javascript"></script>
        <script src="../../../../public/assets/js/datatables.js" type="text/javascript"></script>
        <script src="../../../../public/assets/js/email_comman.js" type="text/javascript"></script>
        <!-- BEGIN CORE TEMPLATE JS -->
        <script src="../../../../public/assets/js/core.js" type="text/javascript"></script>
        <script src="../../../../public/assets/js/chat.js" type="text/javascript"></script>
        <script src="../../../../public/assets/js/demo.js" type="text/javascript"></script>
        <!-- END CORE TEMPLATE JS -->
        <!-- END JAVASCRIPTS -->
        <script src="../../../../public/assets/sweetalert2/sweetalert-dev.js"></script>
        <link href="../../../../public/assets/sweetalert2/sweetalert.css" rel="stylesheet" type="text/css">
        <script src="../../../../public/assets/css/bootstrap-filestyle.min.js"></script>
    </body>
    </html>