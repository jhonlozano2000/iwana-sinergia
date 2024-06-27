<?php
session_start();
require_once '../../config/class.Conexion.php';
require_once '../../config/variable.php';
require_once '../clases/configuracion/class.ConfigMiEmpresa.php';

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
    <title>PQRS - <?php echo $datosEmpresa->get_RazonSocial(); ?></title>
    <link rel="apple-touch-icon" href="../../public/admin_wrap/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../public/admin_wrap/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../public/admin_wrap/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../public/admin_wrap/app-assets/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="../../public/admin_wrap/app-assets/vendors/css/extensions/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="../../public/admin_wrap/app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="../../public/admin_wrap/app-assets/vendors/css/tables/datatable/responsive.bootstrap.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="../../public/admin_wrap/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../public/admin_wrap/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../../public/admin_wrap/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="../../public/admin_wrap/app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="../../public/admin_wrap/app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="../../public/admin_wrap/app-assets/css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="../../public/admin_wrap/app-assets/css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="../../public/admin_wrap/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="../../public/admin_wrap/app-assets/css/plugins/charts/chart-apex.css">
    <link rel="stylesheet" type="text/css" href="../../public/admin_wrap/app-assets/css/plugins/extensions/ext-component-toastr.css">
    <link rel="stylesheet" type="text/css" href="../../public/admin_wrap/app-assets/css/pages/app-invoice-list.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../public/admin_wrap/assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Header-->
    <?php
    include '../comunes_admin_wrap/header-navbar.php';
    ?>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    <?php
    include '../comunes_admin_wrap/main-menu.php';
    ?>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Dashboard Analytics Start -->
                <section id="dashboard-analytics">
                    <div class="row match-height">
                        <!-- Subscribers Chart Card starts -->
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header flex-column align-items-start pb-0">
                                    <div class="avatar bg-light-primary p-50 m-0">
                                        <div class="avatar-content">
                                            <i data-feather="users" class="font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="font-weight-bolder mt-1">92.6k</h2>
                                    <p class="card-text">Subscribers Gained</p>
                                </div>
                                <div id="gained-chart"></div>
                            </div>
                        </div>
                        <!-- Subscribers Chart Card ends -->

                        <!-- Orders Chart Card starts -->
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header flex-column align-items-start pb-0">
                                    <div class="avatar bg-light-warning p-50 m-0">
                                        <div class="avatar-content">
                                            <i data-feather="package" class="font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="font-weight-bolder mt-1">38.4K</h2>
                                    <p class="card-text">Orders Received</p>
                                </div>
                                <div id="order-chart"></div>
                            </div>
                        </div>
                        <!-- Orders Chart Card ends -->
                    </div>
                </section>
                <!-- Dashboard Analytics end -->

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


    <!-- BEGIN: Vendor JS-->
    <script src="../../public/admin_wrap/app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../../public/admin_wrap/app-assets/vendors/js/charts/apexcharts.min.js"></script>
    <script src="../../public/admin_wrap/app-assets/vendors/js/extensions/toastr.min.js"></script>
    <script src="../../public/admin_wrap/app-assets/vendors/js/extensions/moment.min.js"></script>
    <script src="../../public/admin_wrap/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="../../public/admin_wrap/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="../../public/admin_wrap/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
    <script src="../../public/admin_wrap/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="../../public/admin_wrap/app-assets/vendors/js/tables/datatable/responsive.bootstrap.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../public/admin_wrap/app-assets/js/core/app-menu.js"></script>
    <script src="../../public/admin_wrap/app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../public/admin_wrap/app-assets/js/scripts/pages/dashboard-analytics.js"></script>
    <script src="../../public/admin_wrap/app-assets/js/scripts/pages/app-invoice-list.js"></script>
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