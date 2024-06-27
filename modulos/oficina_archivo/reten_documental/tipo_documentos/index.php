<?php
session_start();
require_once '../../../../config/variable.php';
require_once '../../../../config/funciones.php';
require_once '../../../../config/funciones_seguridad.php';
require_once '../../../../config/class.Conexion.php';
require_once '../../../clases/seguridad/class.SeguridadUsuario.php';
require_once '../../../clases/retencion/class.TRDTipoDocumento.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>...::: Iwana - Oficina de Archivo, Tipos documentales :::...</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link href="../../../../public/assets/plugins/jquery-metrojs/MetroJs.min.js" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="../../../../public/assets/plugins/shape-hover/css/demo.css" />
    <link rel="stylesheet" type="text/css" href="../../../../public/assets/plugins/shape-hover/css/component.css" />
    <link rel="stylesheet" type="text/css" href="../../../../public/assets/plugins/owl-carousel/owl.carousel.css" />
    <link rel="stylesheet" type="text/css" href="../../../../public/assets/plugins/owl-carousel/owl.theme.css" />
    <link href="../../../../public/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="../../../../public/assets/plugins/jquery-slider/css/jquery.sidr.light.css" rel="stylesheet" type="text/css" media="screen"/>
    <link rel="stylesheet" href="../../../../public/assets/plugins/jquery-ricksaw-chart/css/rickshaw.css" type="text/css" media="screen" >
    <link rel="stylesheet" href="../../../../public/assets/plugins/Mapplic/mapplic/mapplic.css" type="text/css" media="screen" >
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
    <link href="../../../../public/assets/css/magic_space.css" rel="stylesheet" type="text/css"/>
    <!-- END CSS TEMPLATE -->
    <script src="../../../../public/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
    <link href="../../../mi_archivo/archivo_digitalizado/menuarbolaccesible.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../../../mi_archivo/archivo_digitalizado/menuarbolaccesible.js"></script>
    <link href="../../../../public/assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="../../../../public/assets/plugins/jquery-datatable/css/jquery.dataTables.css" rel="stylesheet" type="text/css"/>
    <link href="../../../../public/assets/plugins/datatables-responsive/css/datatables.responsive.css" rel="stylesheet" type="text/css" media="screen"/>
    <style>

    .btn-circle {
        width: 23px;
        height: 23px;
        text-align: center;
        padding: 4px 0;
        font-size: 8px;
        line-height: 1.33;
        border-radius:15px;
    }
    .btn-circle.btn-lg {
        width: 20px;
        height: 20px;
        padding: 10px 16px;
        font-size: 18px;
        line-height: 1.33;
        border-radius: 15px;
    }
    .btn-circle.btn-xl {
        width: 50px;
        height: 50px;
        padding: 10px 16px;
        font-size: 24px;
        line-height: 1.33;
        border-radius: 35px;
    }
</style>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="">
    <!-- BEGIN HEADER -->
    <?php require_once '../../../../config/cabeza.php'; ?>
    <!-- END HEADER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container row-fluid">
        <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar" id="main-menu">
            <!-- BEGIN MINI-PROFILE -->
            <div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrapper">
                <?php require_once '../../../../config/mini_profile.php'; ?>
                <!-- END MINI-PROFILE -->
                <!-- BEGIN SIDEBAR MENU -->
                <?php require_once '../../../../config/menu.php'; ?>
                <!-- END SIDEBAR MENU -->
            </div>
        </div>
        <div class="footer-widget">
            <?php require_once '../../../../config/footer-widget.php'; ?>
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
                        <a href="#" class="active">Oficina de Archivo, Tipos documentales.</a>
                    </li>
                </ul>
                <div id="DivAlerta"></div>
                <!-- BEGIN DASHBOARD TILES -->
                <form role="form" name="FrmDatos" id="FrmDatos">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="grid simple">
                                <div class="grid-body no-border">
                                    <div class="row column-seperation">
                                        <div class="col-md-12">
                                            <a href="agre.php" class="btn btn-primary btn-circle">
                                                <i class="glyphicon glyphicon-plus"></i>
                                            </a>
                                            <table class="table table-striped" id="example1" >
                                                <thead>
                                                    <tr>
                                                        <th style="width: 4%">Acti</th>
                                                        <th style="width: 40%">Tipo Documental</th>
                                                        <th style="width: 40%">Observaciones</th>
                                                        <th style="width: 15%"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                 <?php
                                                 $Datos = TipoDocumento::Listar(1 , "", "");
                                                 foreach ($Datos as $item):
                                                    ?>
                                                    <tr id="TBLDatos<?php echo $item['id_tipodoc']; ?>">
                                                        <td>
                                                            <div class="checkbox check-success">
                                                                <?php
                                                                if($item['acti'] == 1){
                                                                    $checked = "checked";
                                                                }else{
                                                                    $checked = "";
                                                                }
                                                                ?>
                                                                <input id="acti<?php echo $item['id_tipodoc']; ?>" class="acti" type="checkbox" <?php echo $checked; ?> data-id="<?php echo $item['id_tipodoc']; ?>">
                                                                <label for="acti<?php echo $item['id_tipodoc']; ?>"></label>
                                                            </div>
                                                        </td>
                                                        <td><?php echo $item['nom_tipodoc']; ?></td>
                                                        <td><?php echo $item['observa']; ?></td>
                                                        <td>
                                                            <div class="pull-left">
                                                                <a href="edit.php?id=<?php echo $item['id_tipodoc']; ?>" class="btn btn-warning btn-circle">
                                                                    <i class="glyphicon glyphicon-pencil"></i>
                                                                </a>
                                                                <button type="button" class="btn btn-danger btn-circle" id="BtnEliminar" data-id="<?php echo $item['id_tipodoc']; ?>" data-nom="<?php echo $item['nom_tipodoc']; ?>">
                                                                    <i class="glyphicon glyphicon-trash"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                endforeach;
                                                ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Acti</th>
                                                    <th>Código</th>
                                                    <th>Subserie</th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                        </table>
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
        <?php require_once '../../../chat/chat.php'; ?>
    </div>
    <!-- END CHAT -->		  
</div>
<!-- END CONTAINER -->

<!-- BEGIN CORE JS FRAMEWORK-->
<script src="funciones.ajax.js"></script>
<script src="../../../../public/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
<script src="../../../../public/assets/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../../../../public/assets/plugins/breakpoints.js" type="text/javascript"></script>
<script src="../../../../public/assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
<script src="../../../../public/assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script>
<script src="../../../../public/assets/plugins/jquery-lazyload/jquery.lazyload.min.js" type="text/javascript"></script>
<script src="../../../../public/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
<!-- END CORE JS FRAMEWORK -->
<!-- BEGIN PAGE LEVEL JS -->
<script src="../../../../public/assets/plugins/jquery-slider/jquery.sidr.min.js" type="text/javascript"></script>
<script src="../../../../public/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="../../../../public/assets/plugins/pace/pace.min.js" type="text/javascript"></script>
<script src="../../../../public/assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
<script src="../../../../public/assets/plugins/jquery-ricksaw-chart/js/raphael-min.js"></script>
<script src="../../../../public/assets/plugins/jquery-ricksaw-chart/js/d3.v2.js"></script>
<script src="../../../../public/assets/plugins/jquery-ricksaw-chart/js/rickshaw.min.js"></script>
<script src="../../../../public/assets/plugins/jquery-sparkline/jquery-sparkline.js"></script>
<script src="../../../../public/assets/plugins/skycons/skycons.js"></script>
<script src="../../../../public/assets/plugins/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>

<script src="../../../../public/assets/plugins/jquery-flot/jquery.flot.js" type="text/javascript"></script>
<script src="../../../../public/assets/plugins/jquery-flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="../../../../public/assets/plugins/jquery-metrojs/MetroJs.min.js" type="text/javascript" ></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN CORE TEMPLATE JS -->
<script src="../../../../public/assets/js/core.js" type="text/javascript"></script>
<script src="../../../../public/assets/js/chat.js" type="text/javascript"></script>
<script src="../../../../public/assets/js/demo.js" type="text/javascript"></script>
<script src="../../../../public/assets/js/dashboard_v2.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".live-tile,.flip-list").liveTile();
    });
</script>

<script src="../../../../public/assets/sweetalert2/sweetalert-dev.js"></script>
<link href="../../../../public/assets/sweetalert2/sweetalert.css" rel="stylesheet" type="text/css">
<!-- END CORE TEMPLATE JS -->
<!-- BEGIN CORE JS FRAMEWORK-->
<script src="../../../../public/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
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
<script src="../../../../public/assets/plugins/jquery-datatable/js/jquery.dataTables.min.js" type="text/javascript" ></script>
<script src="../../../../public/assets/plugins/jquery-datatable/extra/js/dataTables.tableTools.min.js" type="text/javascript" ></script>
<script type="text/javascript" src="../../../../public/assets/plugins/datatables-responsive/js/datatables.responsive.js"></script>
<script type="text/javascript" src="../../../../public/assets/plugins/datatables-responsive/js/lodash.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="../../../../public/assets/js/datatables.js" type="text/javascript"></script>
<!-- END JAVASCRIPTS -->
<script src="../../../../public/assets/sweetalert2/sweetalert-dev.js"></script>
<link href="../../../../public/assets/sweetalert2/sweetalert.css" rel="stylesheet" type="text/css">
</body>
</html>
