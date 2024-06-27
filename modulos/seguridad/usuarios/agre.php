<?php
session_start();
require_once '../../../config/variable.php';
require_once '../../../config/funciones.php';
require_once '../../../config/funciones_seguridad.php';
require_once '../../../config/class.Conexion.php';
require_once '../../clases/seguridad/class.SeguridadUsuario.php';
require_once '../../clases/general/class.GeneralFuncionario.php';
require_once "../../clases/seguridad/class.SeguridadPerfiles.php";

$Funcionario = Funcionario::Listar(6, 0, "", "", "", 0, 0, 0);
$Perfiles = Perfiles::Listar(2, "", "", "");
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>...::: Iwana - Seguridad - Usuarios :::...</title>
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
    <link href="../../../public/assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="../../../public/assets/plugins/jquery-datatable/css/jquery.dataTables.css" rel="stylesheet" type="text/css"/>
    <link href="../../../public/assets/plugins/datatables-responsive/css/datatables.responsive.css" rel="stylesheet" type="text/css" media="screen"/>
    <!-- BEGIN CSS TEMPLATE -->
    <link href="../../../public/assets/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="../../../public/assets/css/responsive.css" rel="stylesheet" type="text/css"/>
    <link href="../../../public/assets/css/custom-icon-set.css" rel="stylesheet" type="text/css"/>
    <link href="../../../public/assets/css/magic_space.css" rel="stylesheet" type="text/css"/>
    <!-- END CSS TEMPLATE -->
    <script src="../../../public/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
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
                        <a href="#" class="active">Seguridad - Usuarios.</a>
                    </li>
                </ul>
                <div id="DivAlerta"></div>
                <!-- BEGIN DASHBOARD TILES -->
                <form role="form" name="FrmDatos" id="FrmDatos">

                    <input name="accion" id="accion" type="hidden" value="INSERTAR">
                    <input name="id_funcio" type="hidden" id="id_funcio">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="grid simple">
                                <div class="grid-body no-border">
                                    <div class="row column-seperation">
                                        <div class="col-md-6">
                                            <h4>
                                                <span class="text-success">
                                                    <i class="glyphicon glyphicon-check"></i>Nueva, 
                                                </span>Información básica del usuario
                                            </h4>   
                                            <div class="row form-row">
                                                <div class="col-md-6">
                                                    <input name="cod_funcio" type="text" class="form-control" id="cod_funcio"
                                                    placeholder="# De Documento">
                                                </div>
                                                <div class="col-md-4">
                                                    <button type="button" class="btn btn-success btn-sm btn-small" data-toggle="modal" data-target="#myModalFuncionarios" id="BtnBuscarFuncionario">
                                                        <i class="fa fa-search"></i> Buscar Funcionario
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-6">
                                                    <input name="nom_funcio" type="text" class="form-control" id="nom_funcio"
                                                    placeholder="Nombre del funcionario">
                                                </div>
                                                <div class="col-md-6">
                                                    <input name="ape_funcio" type="text" class="form-control" id="ape_funcio"
                                                    placeholder="Apellidos del funcionario">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-6">
                                                    <input name="login" type="text" class="form-control" id="login"
                                                    placeholder="Login">
                                                </div>
                                                <div class="col-md-6">
                                                    <input name="contra" type="text" class="form-control" id="contra"
                                                    placeholder="Contraseña">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-5">
                                                    <div class="checkbox check-success  ">
                                                        <input id="acti" type="checkbox" value="1" checked="checked">
                                                        <label for="acti">Activo</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="checkbox check-success ">
                                                        <input id="cambio_contra" type="checkbox" name="cambio_contra">
                                                        <label for="cambio_contra">Obligar a cambiar contraseña</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="grid-body no-border">
                                                <h4><span class="text-success">Perfiles</span> Para acceso del usuario</h4>
                                                <div class="row form-row">
                                                    <div class="col-md-12">
                                                        <?php
                                                        foreach ($Perfiles as $Item):
                                                            ?>
                                                            <div class="checkbox check-success">
                                                                <input type="checkbox" value="<?php echo $Item['id_perfil']; ?>" name="ChkPerfiles[]" id="ChkPerfiles<?php echo $Item['id_perfil']; ?>">
                                                                <label for="ChkPerfiles<?php echo $Item['id_perfil']; ?>">
                                                                    <?php echo $Item['nom_perfil']; ?>
                                                                </label>
                                                            </div>
                                                            <?php
                                                        endforeach;
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="pull-left">
                                            <button class="btn btn-primary btn-cons" type="button" id="BtnGuardarUsuario" name="BtnGuardarUsuario">
                                                <span class="glyphicon glyphicon-check"></span> Guardar
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

    <!-- BEGIN MODAL PARA LOS FUNCIONARIOS-->
    <div class="modal fade" id="myModalFuncionarios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <br>
                    <i class="fa fa-users fa-2x"></i>
                    <h4 id="myModalLabel" class="semi-bold">Funcionarios disponibles.</h4>
                    <p class="no-margin">Elige el funcionarios para configurarle el acceso a Iwana</p>
                    <br>
                </div>
                <div class="modal-body">
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="grid simple ">
                                <div class="grid-body ">
                                    <table class="table table-hover table-condensed" id="Tbl1">
                                        <thead>
                                            <tr>
                                                <th style="width:1%"></th>
                                                <th style="width:40%">Funcionario</th>
                                                <th style="width:59%">Oficina</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach($Funcionario as $Item):
                                                ?>
                                                <tr>
                                                    <td class="v-align-middle">
                                                        <button type="button" class="btn btn-success btn-xs btn-mini llevar_funiconario" id="BtnLlevarFuncionario" 
                                                            data-id_funcio="<?php echo $Item['id_funcio']; ?>" 
                                                            data-num_documento="<?php echo $Item['cod_funcio']; ?>" 
                                                            data-nombres="<?php echo $Item['nom_funcio']; ?>" 
                                                            data-apellidos="<?php echo $Item['ape_funcio']; ?>" 
                                                            data-dismiss="modal">
                                                            <i class="fa fa-check"></i>
                                                        </button>
                                                    </td>
                                                    <td class="v-align-middle">
                                                        <span class="muted">
                                                            <?php 
                                                            echo $Item['nom_funcio']." ".$Item['ape_funcio']; 
                                                            ?>
                                                        </span>
                                                    </td>
                                                    <td class="v-align-middle"><?php echo $Item['nom_depen']." - ".$Item['nom_oficina']; ?></td>
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END MODAL PARA DESTINATARIOS-->
    <!-- BEGIN CORE JS FRAMEWORK-->
    <script src="funcionesUsuarios.ajax.js"></script>
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

    <script src="../../../public/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
    <script src="../../../public/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="../../../public/assets/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../../../public/assets/plugins/breakpoints.js" type="text/javascript"></script>
    <script src="../../../public/assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
    <!-- END CORE JS FRAMEWORK -->
    <!-- BEGIN PAGE LEVEL JS -->
    <script src="../../../public/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>    
    <script src="../../../public/assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script>
    <script src="../../../public/assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
    <script src="../../../public/assets/plugins/bootstrap-select2/select2.min.js" type="text/javascript"></script>
    <script src="../../../public/assets/plugins/jquery-datatable/js/jquery.dataTables.min.js" type="text/javascript" ></script>
    <script src="../../../public/assets/plugins/jquery-datatable/extra/js/dataTables.tableTools.min.js" type="text/javascript" ></script>
    <script type="text/javascript" src="../../../public/assets/plugins/datatables-responsive/js/datatables.responsive.js"></script>
    <script type="text/javascript" src="../../../public/assets/plugins/datatables-responsive/js/lodash.min.js"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="../../../public/assets/js/datatables.js" type="text/javascript"></script>
    <!-- END CORE TEMPLATE JS -->
</body>
</html>
