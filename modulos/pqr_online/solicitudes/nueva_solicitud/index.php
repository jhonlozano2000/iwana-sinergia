<?php
session_start();
require_once '../../../../config/class.Conexion.php';
require_once '../../../../config/variable.php';
require_once '../../../clases/configuracion/class.ConfigMiEmpresa.php';
require_once "../../../clases/configuracion/class.ConfigDepartamento.php";
require_once "../../../clases/configuracion/class.ConfigTipoCocumento.php";
require_once "../../../clases/configuracion/class.ConfigRegimen.php";
require_once "../../../clases/configuracion/class.ConfigTipoCorrespondencia.php";

$datosEmpresa = MiEmpresa::Buscar();

$Departamento = Departamento::Listar();
$Combo_Departamentos = "";
foreach ($Departamento as $Item) :
    $Combo_Departamentos .= "<option value='" . $Item['id_depar'] . "'>" . $Item['nom_depar'] . "</option>";
endforeach;

$tipoDocumento = TipoDocumento::Listar(1, "", "", "");
$Combo_TipoDocumentos = "";
foreach ($tipoDocumento as $Item) :
    $Combo_TipoDocumentos .= "<option value='" . $Item['id_tipo'] . "'>" . $Item['nom_tipo'] . "</option>";
endforeach;

$regimenes = Regimen::Listar(1, "", "");
$Combo_Regimenes = "";
foreach ($regimenes as $Item) :
    $Combo_Regimenes .= "<option value='" . $Item['id_regimen'] . "'>" . $Item['nom_regimen'] . "</option>";
endforeach;

/**
 * Listo los tipos de correspondencia
 */

$tiposCorrespondencia = TipoCorrespondencia::Listar(3, "", "", 5);
$Combo_TipoCorrespondencia = "";
foreach ($tiposCorrespondencia as $Item) :
    $Combo_TipoCorrespondencia .= "<option value='" . $Item['id_tipo'] . "'>" . $Item['nom_tipo'] . "</option>";
endforeach;

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
                                    <li class="breadcrumb-item"><a href="index.html">Nueva Solicitud</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic Vertical form layout section start -->
                <section id="basic-vertical-layouts">
                    <div id="DivAlerta"></div>
                    <div class="row">
                        <div class="col-1 borde"></div>
                        <div class="col-md-6 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Ingrese los datos de la solicitud</h4>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical" id="miForm">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label for=" id_tipo_documental">Tipo de solicitud</label>
                                                        <select class="form-control" id="id_tipo_documental">
                                                            <option value="0">...::: Elije el tipo de solicitud :::...</option>
                                                            <option><?php echo $Combo_TipoCorrespondencia; ?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <label for=" id_tipo_docu_afectado">Tipo de documento del afectado</label>
                                                    <select class="form-control" id="id_tipo_docu_afectado">
                                                        <option value="0">...::: Elije el Tipo de Documetno :::...</option>
                                                        <option><?php echo $Combo_TipoDocumentos; ?></option>
                                                    </select>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="num_docu_afectado"># de documento del afectado</label>
                                                        <input type="text" id="num_docu_afectado" class="form-control" name="num_docu_afectado" placeholder="Ingrese aquí el # de documento del afectado" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="form-group">
                                                    <label for="nom_afectado">Nombres del afectado</label>
                                                    <input type="text" id="nom_afectado" class="form-control" name="nom_afectado" placeholder="Ingrese aquí los nombres del afectado" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label for="c">Departamento del afectado</label>
                                                    <select class="form-control" id="id_depar_afectado">
                                                        <option value="0">...::: Elije el Tipo de Documetno :::...</option>
                                                        <option><?php echo $Combo_Departamentos; ?></option>
                                                    </select>
                                                </div>
                                                <div class="col-6">
                                                    <label for=" id_muni_afectado">Municipio del afectado</label>
                                                    <select class="form-control" id="id_muni_afectado">

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="dir">Dirección del afectado</label>
                                                    <input type="dir_afectado" id="dir_afectado" class="form-control" name="dir_afectado" placeholder="Ingrese aquí el la rirección del afectado" />
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="tel_afectado">Teléfono del afectado</label>
                                                    <input type="number" id="tel_afectado" class="form-control" name="tel_afectado" placeholder="Ingrese aquí el teléfono del afectad" />
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="movil_afectado">Móvil del afectado</label>
                                                    <input type="number" id="movil_afectado" class="form-control" name="movil_afectado" placeholder="Ingrese aquí el móvil del afectado" />
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="detalle_solicitud">Aspectos o tema principal que motivó la queja</label>
                                                    <textarea class="form-control" id="detalle_solicitud" rows="3" placeholder="Ingrese aquí los aspectos o tema principal que motivó la queja"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for=" fallo_judicial">¿Existe fallo judicial?</label>
                                                    <select class="form-control" id="fallo_judicial">
                                                        <option value="No">No</option>
                                                        <option value="Si">Si</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for=" id_regimen">Regimen del afectado</label>
                                                    <select class="form-control" id="id_regimen">
                                                        <option value="0">...::: Elije el regimen :::...</option>
                                                        <option><?php echo $Combo_Regimenes; ?></option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <button type="button" id="btnGuardar" class="btn btn-primary mr-1">
                                                    Registrar
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 borde">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Anexos de documentos</h4>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical" id="miFormAdjuntos" enctype="multipart/form-data">

                                        <input type="hidden" id="accion" name="accion" value="RECIBIDOS_PQR_UPLOAD">
                                        <input type="hidden" id="id_radicado" name="id_radicado">
                                        <input type="hidden" id="id_pqr" name="id_pqr">

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label for="archivo1">Documento 1</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="archivo1" name="archivo[]">
                                                        <label class="custom-file-label" for="archivo1"></label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <label for="archivo2">Documento 2</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="archivo2" name="archivo[]">
                                                        <label class="custom-file-label" for="archivo2"></label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <label for="archivo3">Documento 3</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="archivo3" name="archivo[]">
                                                        <label class="custom-file-label" for="archivo3"></label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <label for="archivo4">Documento 4</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="archivo4" name="archivo[]">
                                                        <label class="custom-file-label" for="archivo4"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-1 borde"></div>
                    </div>
                </section>
                <!-- Basic Vertical form layout section end -->
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
    <script src="../../../public/admin_wrap/app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../public/admin_wrap/app-assets/js/core/app-menu.js"></script>
    <script src="../../../public/admin_wrap/app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->
    <script src="../../../modulos/pqr_online/solicitudes/nueva_solicitud/funciones.ajax.js"></script>
    <script src="../../../public/assets/sweetalert2/sweetalert-dev.js"></script>
    <link rel="stylesheet" type="text/css" href="../../../public/assets/sweetalert2/sweetalert.css">
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