<?php
session_start();
require_once '../../../config/variable.php';
require_once '../../../config/funciones.php';
require_once '../../../config/funciones_seguridad.php';
require_once '../../../config/class.Conexion.php';
require_once '../../clases/seguridad/class.SeguridadUsuario.php';
require_once '../../clases/general/class.GeneralFuncionario.php';
require_once "../../clases/configuracion/class.ConfigDepartamento.php";
require_once "../../clases/configuracion/class.ConfigMunicipio.php";

$Funcionario = Funcionario::Buscar(15, $_SESSION['SesionFuncioId'], "", "", "", 0, 0, 0);

$Departamento = Departamento::Listar();
$Combo_Departamentos = "";
foreach($Departamento as $Item):
    if($Item['id_depar'] == $Funcionario->getId_Depar()){
        $Combo_Departamentos.= "<option value='".$Item['id_depar']."' selected>".$Item['nom_depar']."</option>";
    }else{
        $Combo_Departamentos.= "<option value='".$Item['id_depar']."'>".$Item['nom_depar']."</option>";
    }
endforeach;

$Municipios = Municipio::Listar(1, $Funcionario->getId_Depar());
$Combo_Municipios = "";
foreach($Municipios as $Item):
    if($Item['id_muni'] == $Funcionario->getId_Muni()){

        $Combo_Municipios.= "<option value='".$Item['id_muni']."' selected>".$Item['nom_muni']."</option>";
    }else{
        $Combo_Municipios.= "<option value='".$Item['id_muni']."'>".$Item['nom_muni']."</option>";
    }
endforeach;
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>...::: Iwana - Mi Cuenta :::...</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- BEGIN PLUGIN CSS -->
    <link href="../../../public/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="../../../public/assets/plugins/bootstrap-tag/bootstrap-tagsinput.css" rel="stylesheet" type="text/css"/>
    <link href="../../../public/assets/plugins/dropzone/css/dropzone.css" rel="stylesheet" type="text/css"/>
    <link href="../../../public/assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css"/>
    <link href="../../../public/assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" type="text/css" />
    <link href="../../../public/assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.css" rel="stylesheet" type="text/css" />
    <link href="../../../public/assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet" type="text/css" />
    <link href="../../../public/assets/plugins/ios-switch/ios7-switch.css" rel="stylesheet" type="text/css" media="screen">
    <link href="../../../public/assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="../../../public/assets/plugins/boostrap-clockpicker/bootstrap-clockpicker.min.css" rel="stylesheet" type="text/css" media="screen"/>
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
    <link href="../../../public/assets/plugins/boostrap-slider/css/slider.css" rel="stylesheet" type="text/css"/>
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
                        <a href="#" class="active">Mi Cuenta.</a>
                    </li>
                </ul>
                <div id="DivAlerta"></div>
                <!-- BEGIN DASHBOARD TILES -->


                <div class="row">
                    <div class="col-md-12">
                        <div class="grid simple">
                            <div class="grid-body no-border">
                                <div class="row column-seperation">
                                    <div class="col-md-6">
                                        <h4>
                                            <span class="text-success">
                                                <i class="glyphicon glyphicon-check"></i>Información, 
                                            </span>Personal
                                        </h4>   

                                        <form role="form" name="FrmDatos" id="FrmDatos">

                                            <input name="accion" id="accion" type="hidden" value="EDITAR">
                                            <input name="id_funcio" type="hidden" id="id_funcio" value="<?php echo $Funcionario->getId_Funcio(); ?>">
                                            <div class="row form-row">
                                                <div class="col-md-6">
                                                    <input name="cod_funcio" type="text" class="form-control" id="cod_funcio"
                                                    placeholder="# De Documento"
                                                    value="<?php echo $Funcionario->getCod_Funcio(); ?>">
                                                </div>
                                                <div class="col-md-4">
                                                    <select name="genero" id="genero" class="select2 form-control"  >
                                                        <option value="0">...::: Elije el Sexo :::...</option>
                                                        <?php
                                                        if($Funcionario->getGenero() == "M"){
                                                            ?>
                                                            <option value="M" selected="">M</option>
                                                            <option value="F">F</option>
                                                        <?php }else{ ?>
                                                            <option value="M">M</option>
                                                            <option value="F" selected="">F</option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-6">
                                                    <input name="nom_funcio" type="text" class="form-control" id="nom_funcio"
                                                    placeholder="Nombre del funcionario"
                                                    value="<?php echo $Funcionario->getNom_Funcio(); ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <input name="ape_funcio" type="text" class="form-control" id="ape_funcio"
                                                    placeholder="Apellidos del funcionario"
                                                    value="<?php echo $Funcionario->getApe_Funcio(); ?>">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-6">
                                                    <select name="id_depar" id="id_depar" class="select2 form-control"  >
                                                        <option value="0">...::: Elije el Departamento :::...</option>
                                                        <?php echo $Combo_Departamentos;?>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <select name="id_muni" id="id_muni" class="select2 form-control"  >
                                                        <option value="0">...::: Elije el Municipio :::...</option>
                                                        <?php echo $Combo_Municipios; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <input name="dir" type="text" class="form-control" id="dir"
                                                    placeholder="Dirección del funcionario"
                                                    value="<?php echo $Funcionario->getDir(); ?>">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-6">
                                                    <input name="tel" type="text" class="form-control" id="tel"
                                                    placeholder="Teléfono del funcionario"
                                                    value="<?php echo $Funcionario->getTel(); ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <input name="cel" type="text" class="form-control" id="cel"
                                                    placeholder="Celular del funcionario"
                                                    value="<?php echo $Funcionario->getCel(); ?>">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <input name="email" type="text" class="form-control" id="email"
                                                    placeholder="E-Mail del funcionario"
                                                    value="<?php echo $Funcionario->getEmail(); ?>">
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="grid-body no-border">
                                            <h4><span class="text-success">Contraseña</span> Cambiar contraseña</h4>
                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <div class="row form-row">
                                                        <input name="contra_actual" type="text" class="form-control" id="contra_actual" placeholder="Contraseña actual">
                                                        <input name="nueva_contra" type="text" class="form-control" id="nueva_contra" placeholder="Nueva contraseña">
                                                        <input name="confirma_contra" type="text" class="form-control" id="confirma_contra" placeholder="Confirmar contraseña">
                                                        <button class="btn btn-primary btn-cons" type="button" id="BtnCambiaContra" name="BtnCambiaContra">
                                                            <span class="fa fa-key"></span> Cambiar contraseña
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="grid-body no-border">
                                            <h4><span class="text-success">Foto</span> de perfil</h4>
                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <div class="row form-row">
                                                        <?php
                                                        if($_SESSION['SesionFuncioImagenPerfil'] != ""){
                                                            ?>
                                                            <img src="<?php echo $ImagenDePerfil; ?>" class="img-thumbnai" alt="Eniun" id="ImgImagenPerfil" width="154" height="152">
                                                            <?php
                                                        }else{
                                                            ?>
                                                            <img src="../../../public/assets/img/foto_perfil.jpg" class="img-thumbnai" alt="Eniun" id="ImgImagenPerfil" width="154" height="152">
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <form enctype="multipart/form-data" id="Frm-ImagenPerfil">

                                                    <input name="accion" id="accion" type="hidden" value="SUBIR_IMAGEN_PERFIL">
                                                    <input name="id_funcio" id="id_funcio" type="hidden" value="<?php echo  $_SESSION['SesionFuncioId']; ?>">

                                                    <label for="FileImagenPerfil" class="btn btn-primary">
                                                        <i class="fa fa-cloud-upload"></i> 
                                                    </label>
                                                    <input name="FileImagenPerfil" id="FileImagenPerfil" type="file" style='display: none;' accept="image/*"/>

                                                    <button class="btn btn-danger" type="button" id="BtnEliminarFotoPerfil" name="BtnEliminarFotoPerfil">
                                                        <span class="fa fa-trash"></span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="grid-body no-border">
                                            <h4><span class="text-success">Firma</span> </h4>
                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <div class="row form-row">
                                                        <?php
                                                        if($_SESSION['SesionFuncioImagenFirma'] != ""){
                                                            $ImagenParaFirmar = $RutaMiServidor."/archivos/fotos_firmas/".$_SESSION['SesionFuncioImagenFirma'];
                                                            ?>
                                                            <img src="<?php echo $ImagenParaFirmar; ?>" class="img-thumbnai md-2" alt="Eniun" id="ImgImagenFirma" width="154" height="152">
                                                            <?php
                                                        }else{
                                                            ?>
                                                            <img src="../../../public/assets/img/icono_firma.jpg" class="img-thumbnai md-2" alt="Eniun" id="ImgImagenFirma" width="154" height="152">
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row form-row">

                                                <form enctype="multipart/form-data" id="Frm-ImagenFirma">

                                                    <input name="accion" id="accion" type="hidden" value="SUBIR_IMAGEN_FIRMA">
                                                    <input name="id_funcio" id="id_funcio" type="hidden" value="<?php echo $_SESSION['SesionFuncioId']; ?>">

                                                    <label for="FileImagenFirma" class="btn btn-primary">
                                                        <i class="fa fa-cloud-upload"></i> 
                                                    </label>
                                                    <input name="FileImagenFirma" id="FileImagenFirma" type="file" style='display: none;' accept="image/*"/>

                                                    <button class="btn btn-danger" type="button" id="BtnEliminarFotoFirma" name="BtnGuardarUsuario">
                                                        <span class="fa fa-trash"></span>
                                                    </button>
                                                </form>
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
            </div>
        </div>
        <!-- BEGIN CHAT --> 
        <div class="chat-window-wrapper">
            <?php require_once '../../chat/chat.php'; ?>
        </div>
        <!-- END CHAT -->		  
    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN CORE JS FRAMEWORK-->
    <script src="funciones.ajax.js"></script>
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

    <script src="../../../public/assets/sweetalert2/sweetalert-dev.js"></script>
    <link href="../../../public/assets/sweetalert2/sweetalert.css" rel="stylesheet" type="text/css">
</body>
</html>
