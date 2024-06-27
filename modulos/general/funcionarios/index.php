<?php
session_start();
require_once '../../../config/variable.php';
require_once '../../../config/funciones.php';
require_once '../../../config/funciones_seguridad.php';
require_once '../../../config/class.Conexion.php';
require_once '../../clases/seguridad/class.SeguridadUsuario.php';
require_once '../../clases/general/class.GeneralFuncionario.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>...::: Iwana - General, Funcionarios :::...</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN PLUGIN CSS -->
    <link href="../../../public/assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="../../../public/assets/plugins/jquery-datatable/css/jquery.dataTables.css" rel="stylesheet" type="text/css"/>
    <link href="../../../public/assets/plugins/datatables-responsive/css/datatables.responsive.css" rel="stylesheet" type="text/css" media="screen"/>
    <!-- END PLUGIN CSS -->
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
    <!-- END CSS TEMPLATE -->

    <script src="../../../public/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
    
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
                        <p>General</p>
                    </li>
                    <li><a href="#" class="active">Funionarios</a></li>
                </ul>
                <div id="DivAlerta"></div>
                <!-- BEGIN DASHBOARD TILES -->
                <form role="form" name="FrmDatos" id="FrmDatos">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="grid simple">
                                <div class="grid-body no-border">
                                    <div class="row column-seperation">
                                        <a href="agre.php" class="btn btn-primary btn-circle">
                                            <i class="glyphicon glyphicon-plus"></i>
                                        </a>
                                        <div class="col-md-12">
                                            <table class="table table-striped" id="example1" >
                                                <thead>
                                                    <tr>
                                                        <th>Acti</th>
                                                        <th>J</th>
                                                        <th>F</th>
                                                        <th>P</th>
                                                        <th># Documento</th>
                                                        <th>Funcionario</th>
                                                        <th>Dependencia</th>
                                                        <th>Oficina</th>
                                                        <th>Cargo</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $Oficinas = Funcionario::Listar(1, 0, "", "", "", 0, 0, 0);
                                                    foreach ($Oficinas as $item):
                                                        ?>
                                                        <tr id="TrDatos<?php echo $item['id_funcio_deta']; ?>">
                                                            <td>
                                                                <div class="checkbox check-success">
                                                                    <?php
                                                                    if($item['acti_cargo'] == 1){
                                                                        $checked = "checked";
                                                                    }else{
                                                                        $checked = "";
                                                                    }
                                                                    ?>
                                                                    <input id="acti<?php echo $item['id_funcio_deta']; ?>" class="acti" type="checkbox" <?php echo $checked; ?> data-id_funcio_deta="<?php echo $item['id_funcio_deta']; ?>" data-id_funcio="<?php echo $item['id_funcio']; ?>" data-funcion="<?php echo $item['nom_funcio']." ".$item['ape_funcio']."\nOfi.: ".$item['nom_oficina']; ?>">
                                                                    <label for="acti<?php echo $item['id_funcio_deta']; ?>"></label>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                if($item['jefe_dependencia'] == 1){
                                                                    echo "<span class='badge bg-blue'>A</span>";
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                if($item['puede_firmar'] == 1){
                                                                    echo "<span class='badge bg-blue'>A</span>";
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                if($item['propie_princi'] == 1){
                                                                    echo "<span class='badge bg-blue'>A</span>";
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $item['id_funcio_deta']." - ".$item['id_funcio']."<br>"; ?>
                                                                <?php echo $item['cod_funcio']; ?>
                                                            </td>
                                                            <td><?php echo $item['nom_funcio']." ".$item['ape_funcio']; ?></td>
                                                            <td><?php echo $item['nom_depen']; ?></td>
                                                            <td><?php echo $item['nom_oficina']; ?></td>
                                                            <td><?php echo $item['nom_cargo']; ?></td>
                                                            <td>
                                                                <a href="edit.php?id_funcio_deta=<?php echo $item['id_funcio_deta']; ?>&id_funcio=<?php echo $item['id_funcio']; ?>" class="btn btn-warning btn-circle">
                                                                    <i class="glyphicon glyphicon-pencil"></i></a>
                                                                    <button type="button" class="btn btn-danger btn-circle" id="BtnEliminar" data-id_funcio_deta="<?php echo $item['id_funcio_deta']; ?>" data-id_funcio="<?php echo $item['id_funcio']; ?>" data-nom="<?php echo $item['nom_funcio']." ".$item['ape_funcio']; ?>">
                                                                        <i class="glyphicon glyphicon-trash"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        endforeach;
                                                        ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Acti</th>
                                                            <th>J</th>
                                                            <th>F</th>
                                                            <th>P</th>
                                                            <th>Funcionario</th>
                                                            <th>Dependencia</th>
                                                            <th>Oficina</th>
                                                            <th>Cargo</th>
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
                <?php require_once '../../chat/chat.php'; ?>
            </div>
            <!-- END CHAT -->		  
        </div>
        <!-- END CONTAINER -->

        
        <script src="funciones.ajax.js"></script>

        <!-- BEGIN CORE JS FRAMEWORK-->
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
        <!-- BEGIN CORE TEMPLATE JS -->
        <script src="../../../public/assets/js/core.js" type="text/javascript"></script>
        <script src="../../../public/assets/js/chat.js" type="text/javascript"></script>
        <script src="../../../public/assets/js/demo.js" type="text/javascript"></script>
        <!-- END CORE TEMPLATE JS -->
        <!-- END JAVASCRIPTS -->
        <script src="../../../public/assets/sweetalert2/sweetalert-dev.js"></script>
        <link href="../../../public/assets/sweetalert2/sweetalert.css" rel="stylesheet" type="text/css">
        
        
    </body>
    </html>
