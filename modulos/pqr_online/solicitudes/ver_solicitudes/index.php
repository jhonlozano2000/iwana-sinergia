<?php
session_start();
require_once '../../../../config/class.Conexion.php';
require_once '../../../../config/variable.php';
require_once '../../../clases/configuracion/class.ConfigMiEmpresa.php';
require_once '../../../clases/radicar/class.RadicaRecibidoPQRSF.php';

$misRadicados = RadicadoRecibidoPQRSF::Listar(['Accion' => 2, 'id_contacto' => $_SESSION['SesionContactoIdPQR']]);
$datosEmpresa = MiEmpresa::Buscar();
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Registro a PQRS - <?php echo $datosEmpresa->get_RazonSocial(); ?></title>
    <link rel="apple-touch-icon" href="../../../public/admin_wrap/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../public/admin_wrap/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../public/admin_wrap/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../public/admin_wrap/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../../../public/admin_wrap/app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../../../public/admin_wrap/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../../../public/admin_wrap/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../../../public/admin_wrap/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="../../../public/admin_wrap/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../../public/admin_wrap/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../../../public/admin_wrap/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="../../../public/admin_wrap/app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="../../../public/admin_wrap/app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="../../../public/admin_wrap/app-assets/css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="../../../public/admin_wrap/app-assets/css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="../../../public/admin_wrap/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../public/admin_wrap/assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Header-->
    <?php
    include '../../../comunes_admin_wrap/header-navbar.php';
    ?>
    <!-- END: Header-->
    <!-- BEGIN: Main Menu-->
    <?php
    include '../../../comunes_admin_wrap/main-menu.php';
    ?>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">PQR</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Mis Solicitudes</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">

                <!-- Basic table -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="datatables-basic table">
                                    <thead>
                                        <tr>
                                            <th>Radicado</th>
                                            <th>Fecha y Hora solicitud</th>
                                            <th>Fecha y Hora asignación</th>
                                            <th>Radicado respuesta</th>
                                            <th>Fecha y Hora respuesta</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($misRadicados as $item) {
                                        ?>
                                            <tr>
                                                <td><?php echo $item['id_radica_recibido']; ?></td>
                                                <td><?php echo $item['fechor_radica_recibido']; ?></td>
                                                <td><?php echo $item['fechor_tramite']; ?></td>
                                                <td><?php echo $item['id_radica_enviado']; ?></td>
                                                <td><?php echo $item['fechor_radica_enviado']; ?></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--/ Basic table -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2021<a class="ml-25" href="https://1.envato.market/pixinvent_portfolio" target="_blank">Pixinvent</a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span><span class="float-md-right d-none d-md-block">Hand-crafted & Made with<i data-feather="heart"></i></span></p>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->


    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../public/admin_wrap/app-assets/vendors/js/vendors.min.js"></script>
    <script src="../../../public/admin_wrap/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
    <script src="../../../public/admin_wrap/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
    <script src="../../../public/admin_wrap/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="../../../public/admin_wrap/app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js"></script>
    <script src="../../../public/admin_wrap/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
    <script src="../../../public/admin_wrap/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="../../../public/admin_wrap/app-assets/vendors/js/tables/datatable/jszip.min.js"></script>
    <script src="../../../public/admin_wrap/app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="../../../public/admin_wrap/app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <script src="../../../public/admin_wrap/app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="../../../public/admin_wrap/app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="../../../public/admin_wrap/app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js"></script>
    <script src="../../../public/admin_wrap/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
    <!-- END: Page Vendor JS-->


    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../public/admin_wrap/app-assets/js/core/app-menu.js"></script>
    <script src="../../../public/admin_wrap/app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
</body>
<!-- END: Body-->

</html>