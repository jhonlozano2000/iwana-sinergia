<?php
session_start();
require_once '../../../config/variable.php';
require_once '../../../config/funciones.php';
require_once '../../../config/funciones_seguridad.php';
require_once '../../../config/class.Conexion.php';
require_once '../../clases/seguridad/class.SeguridadUsuario.php';
require_once "../../clases/areas/class.AreasDependencia.php";
require_once "../../clases/areas/class.AreasOficina.php";
require_once "../../clases/areas/class.AreasCargo.php";
require_once "../../clases/configuracion/class.ConfigDepartamento.php";
require_once "../../clases/configuracion/class.ConfigMunicipio.php";
require_once "../../clases/retencion/calss.TRD.php"; 

$Dependencia = Dependencia::Listar(6, "", "", "", "");

$Combo_Dependencias = "";
foreach($Dependencia as $Item):
    $Combo_Dependencias.= "<option value='".$Item['id_depen']."'>".$Item['cod_corres'].".".$Item['nom_depen']."</option>";
endforeach;

$Departamento = Departamento::Listar();
$Combo_Departamentos = "";
foreach($Departamento as $Item):
    $Combo_Departamentos.= "<option value='".$Item['id_depar']."'>".$Item['nom_depar']."</option>";
endforeach;
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

    <!-- BEGIN CSS TEMPLATE -->
    <link href="../../../public/assets/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="../../../public/assets/css/responsive.css" rel="stylesheet" type="text/css"/>
    <link href="../../../public/assets/css/custom-icon-set.css" rel="stylesheet" type="text/css"/>
    <link href="../../../public/assets/css/magic_space.css" rel="stylesheet" type="text/css"/>
    <!-- END CSS TEMPLATE -->
    <script src="../../../public/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
    <link href="../../mi_archivo/archivo_digitalizado/menuarbolaccesible.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../../mi_archivo/archivo_digitalizado/menuarbolaccesible.js"></script>
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
                        <a href="#" class="active">General, Funcionarios.</a>
                    </li>
                </ul>
                <div id="DivAlerta"></div>
                <!-- BEGIN DASHBOARD TILES -->
                <form role="form" name="FrmDatos" id="FrmDatos">

                    <input name="accion" id="accion" type="hidden" value="INSERTAR">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="grid simple">
                                <div class="grid-title no-border">

                                </div>
                                <div class="grid-body no-border">
                                    <div class="row column-seperation">
                                        <div class="col-md-5">
                                            <h4><span class="text-success">Nueva, </span>Información básica del funcionario</h4>
                                            <div class="row form-row">
                                                <div class="col-md-6">
                                                    <input name="cod_funcio" type="text" class="form-control" id="cod_funcio" placeholder="# De Documento">
                                                </div>
                                                <div class="col-md-4">
                                                    <select name="genero" id="genero" class="select2 form-control"  >
                                                        <option value="0">...::: Elije el Sexo :::...</option>
                                                        <option value="M" selected="">M</option>
                                                        <option value="F">F</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-6">
                                                    <input name="nom_funcio" type="text" class="form-control" id="nom_funcio" placeholder="Nombre del funcionario">
                                                </div>
                                                <div class="col-md-6">
                                                    <input name="ape_funcio" type="text" class="form-control" id="ape_funcio" placeholder="Apellidos del funcionario">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-6">
                                                    <select name="id_depar" id="id_depar" class="select2 form-control">
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
                                                    <input name="dir" type="text" class="form-control" id="dir" placeholder="Dirección del funcionario">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-6">
                                                    <input name="tel" type="text" class="form-control" id="tel" placeholder="Teléfono del funcionario">
                                                </div>
                                                <div class="col-md-6">
                                                    <input name="cel" type="text" class="form-control" id="cel" placeholder="Celular del funcionario">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <input name="email" type="text" class="form-control" id="email" placeholder="E-Mail del uncionario">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-8">
                                                    <div class="checkbox check-success">
                                                        <input id="acti" type="checkbox" checked="">
                                                        <label for="acti">Activo</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <h4><span class="text-success">Ubicación</span> Dentro De La Institución</h4>
                                            <div class="col-md-12">
                                                <select name="id_depen" id="id_depen" class="select2 form-control"  >
                                                    <option value="0">...::: Elije la Dependencia :::...</option>
                                                    <?php  echo $Combo_Dependencias; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-12">
                                                <select name="id_oficina" id="id_oficina" class="select2 form-control"  >
                                                    <option value="0">...::: Elije la Oficina :::...</option>
                                                    <?php  echo $Combo_Oficinas; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-12">
                                                <select name="id_cargo" id="id_cargo" class="select2 form-control"  >
                                                    <option value="0">...::: Elije la Cargo :::...</option>
                                                    <?php  echo $Combo_Cargos; ?>
                                                </select>
                                            </div>
                                            <h4><span class="text-success">Permisos</span></h4>
                                            <div class="col-md-12">
                                                <div class="checkbox check-success  ">
                                                    <input name="jefe_dependencia" type="checkbox" id="jefe_dependencia">
                                                    <label for="jefe_dependencia">Jefe de Dependencia</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="checkbox check-success  ">
                                                    <input name="propie_princi" type="checkbox" id="propie_princi">
                                                    <label for="propie_princi">Propietario principal</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="checkbox check-success  ">
                                                    <input name="crea_expedien" type="checkbox" id="crea_expedien">
                                                    <label for="crea_expedien">Crear Expediente</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="checkbox check-success  ">
                                                    <input name="jefe_oficina" type="checkbox" id="jefe_oficina">
                                                    <label for="jefe_oficina">Jefe de Oficina</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="checkbox check-success  ">
                                                    <input name="puede_firmar" type="checkbox" id="puede_firmar">
                                                    <label for="puede_firmar">Puede Firmar</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="grid simple">
                                                <div class="grid-body no-border">
                                                    <h4><span class="text-success">Acceso a,</span> Documentación digitalizada</h4>
                                                    <div class="col-md-12" style="height: 350px; overflow-y: scroll;">
                                                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                                            <?php
                                                            foreach($Dependencia as $ItemDepen):
                                                                ?>
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading" role="tab" id="headingOne">
                                                                        <h4 class="panel-title">
                                                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseDepen<?php echo $ItemDepen['id_depen']; ?>" aria-expanded="true" aria-controls="collapseDepen<?php echo $ItemDepen['id_depen']; ?>">
                                                                                <?php
                                                                                echo "Depen: ".$ItemDepen['nom_depen'];
                                                                                ?>
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                                    <div id="collapseDepen<?php echo $ItemDepen['id_depen']; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                                                        <div class="panel-body">
                                                                            <div class="panel-group" id="sub-accordion" role="tablist" aria-multiselectable="true">
                                                                                <?php
                                                                                $Serie = TRD::Listar(6, "", $ItemDepen['id_depen'], "", "", "");
                                                                                foreach($Serie as $ItemSerie):
                                                                                    ?>
                                                                                    <div class="panel panel-default">
                                                                                        <div class="panel-heading" role="tab" id="subHeadingOne">
                                                                                            <h4 class="panel-title">
                                                                                                <a role="button" data-toggle="collapse" data-parent="#sub-accordion" href="#collapseSerie<?php echo $ItemDepen['id_depen'].$ItemSerie['id_serie']; ?>" aria-expanded="true" aria-controls="collapseSerie<?php echo $ItemDepen['id_depen'].$ItemSerie['id_serie']; ?>">
                                                                                                    <?php echo $ItemSerie['cod_serie'].".".$ItemSerie['nom_serie']; ?>
                                                                                                </a>
                                                                                            </h4>
                                                                                        </div>
                                                                                        <div id="collapseSerie<?php echo $ItemDepen['id_depen'].$ItemSerie['id_serie']; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="subHeadingOne">
                                                                                            <div class="panel-body">
                                                                                                <?php
                                                                                                $SubSerie = TRD::Listar(9, "", $ItemDepen['id_depen'], $ItemSerie['id_serie'] , "","");
                                                                                                foreach($SubSerie as $ItemSubSerie):
                                                                                                    ?>
                                                                                                    <div class="row-fluid">
                                                                                                        <div class="checkbox check-success">
                                                                                                            <input id="checkbox<?php echo $ItemSubSerie['id_subserie']; ?>" name="ChkTRD[]" type="checkbox" value="<?php echo $ItemDepen['id_depen']."-".$ItemSerie['id_serie']."-".$ItemSubSerie['id_subserie']; ?>">
                                                                                                            <label for="checkbox<?php echo $ItemSubSerie['id_subserie']; ?>">
                                                                                                                <?php echo $ItemSubSerie['cod_subserie'].".".$ItemSubSerie['nom_subserie']; ?>
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <?php
                                                                                                endforeach;
                                                                                                ?>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <?php
                                                                                endforeach;
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                            endforeach;
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">

                                        <div class="pull-left">
                                            <button class="btn btn-primary btn-cons" type="button" id="BtnGuardar" name="BtnGuardar">
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


    <!-- END CORE TEMPLATE JS -->
</body>
</html>
