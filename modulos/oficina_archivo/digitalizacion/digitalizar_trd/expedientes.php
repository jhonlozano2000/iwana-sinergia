<?php
session_start();
require_once '../../../../config/variable.php';
require_once '../../../../config/funciones.php';
require_once '../../../../config/funciones_seguridad.php';
require_once '../../../../config/class.Conexion.php';
require_once("../../../clases/seguridad/class.SeguridadUsuario.php");
require_once("../../../clases/seguridad/class.SeguridadModulo.php");
require_once "../../../clases/areas/class.AreasDependencia.php";
require_once "../../../clases/configuracion/class.ConfigOtras.php";

$Dependencia = new Dependencia();
$Dependencia = Dependencia::Listar(6, "", "", "", "");
$Combo_Dependencias = "";

foreach($Dependencia as $Item):
    $Combo_Dependencias.= "<option value='".$Item['id_depen']."'>".$Item['cod_corres'].".".$Item['nom_depen']."</option>";
endforeach;

$ConfiguracionOtras = ConfigOtras::Buscar();
if($ConfiguracionOtras->get_Incluir_TRD() == 0){
    $Combo_TipoDocumentos = "";
    require_once '../../../clases/retencion/class.TRDTipoDocumento.php';
    $Documentos = TipoDocumento::Listar(1, "", "");
    foreach($Documentos as $Item):
        $Combo_TipoDocumentos.= "<option value='".$Item['id_tipodoc']."'>".$Item['nom_tipodoc']."</option>";
    endforeach;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>...::: Iwana - Oficina de Archivo, Digitalización con TRD :::...</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- BEGIN PLUGIN CSS -->
    <link href="../../../../public/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="../../../../public/assets/plugins/bootstrap-tag/bootstrap-tagsinput.css" rel="stylesheet" type="text/css"/>
    <link href="../../../../public/assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" type="text/css" />
    <link href="../../../../public/assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="../../../../public/assets/plugins/boostrap-clockpicker/bootstrap-clockpicker.min.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="../../../../public/assets/plugins/boostrap-checkbox/css/bootstrap-checkbox.css" rel="stylesheet" type="text/css" media="screen"/>
    <link rel="stylesheet" href="../../../../public/assets/plugins/ios-switch/ios7-switch.css" type="text/css" media="screen">
    <!-- END PLUGIN CSS -->

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
    <!-- END CSS TEMPLATE -->
    <link href="../../../../public/assets/plugins/boostrap-slider/css/slider.css" rel="stylesheet" type="text/css"/>

    <script src="../../../../public/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
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
                        <a href="#" class="active">Oficina de Archivo - Digitalización con TRD.</a>
                    </li>
                </ul>
                <!-- BEGIN DASHBOARD TILES -->
                <form role="form" name="FrmDatos" id="FrmDatos">

                    <input name="accion" type="hidden" id="accion" value="NUEVO_EXPEDIENTE">
                    <input name="id_digital" type="hidden" id="id_digital">
                    <input name="id_tipo_docu" type="hidden" id="id_tipo_docu">
                    <input name="incluir_trd" type="hidden" id="incluir_trd" value="<?php echo $ConfiguracionOtras->get_Incluir_TRD(); ?>">
                    <input name="incluir_oficina_trd" type="hidden" id="incluir_oficina_trd" value="<?php echo $ConfiguracionOtras->get_Incluir_Oficina_TRD(); ?>">

                    <div class="row">
                        <div class="col-md-12">
                            <div id="DivAlertas"></div>
                            <div class="grid simple">
                                <div class="grid-body no-border">
                                    <div class="row column-seperation">
                                        <div class="col-md-6">
                                            <h4><span class="text-success">Clasificación, </span> y pertenencia de documentos</h4>

                                            <div id="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <select name="id_depen" id="id_depen"  class="select2 form-control">
                                                            <option value="0">...::: Elije la Dependencia :::...</option>
                                                            <?php echo $Combo_Dependencias; ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <?php
                                                if($ConfiguracionOtras->get_Incluir_Oficina_TRD() == 2){
                                                    ?>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="input-with-icon  right">                                       
                                                                <i class=""></i>
                                                                <select name="id_oficina" id="id_oficina" class="select2 form-control"  >
                                                                    <option value="0">...::: Elije la Oficina :::...</option>
                                                                    <?php  echo $Combo_Oficinas; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <div id="row">
                                                <div class="form-group">
                                                    <div class="col-md-6">
                                                        <div class="input-with-icon  right">                                       
                                                            <i class=""></i>
                                                            <select name="id_serie" id="id_serie" class="select2 form-control">
                                                                <option value="0">...::: Elije la Serie :::...</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-6">
                                                        <div class="input-with-icon  right">                                       
                                                            <i class=""></i>
                                                            <select name="id_subserie" id="id_subserie" class="select2 form-control"  >
                                                                <option value="0">...::: Elije la SubSerie :::...</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h4><span class="text-success">Detalles, </span> del Expediente</h4>

                                            <div class="row form-row">
                                                <div class="col-md-6">
                                                    <input name="codigo" type="text" class="form-control" id="codigo" placeholder="Código">
                                                </div>

                                                <div class="col-md-3">
                                                    <select name="id_tomo" id="id_tomo" class="select2 form-control ">
                                                    </select>
                                                </div>

                                                <div class="col-m3">
                                                    <button type="button" class="btn btn-success btn-cons" id="BtnNuevoTomo" disabled>
                                                        <i class="fa fa-plus-circle"></i> Nuevo Tomo
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <input name="titulo" type="text" class="form-control" id="titulo" placeholder="Titulo">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-5">
                                                    <div class="input-append success date col-md-10 col-lg-6 no-padding">
                                                        <input type="text" name="fec_ini" class="form-control" id="fec_ini" placeholder="Fec. Inicial">
                                                        <span class="add-on">
                                                            <span class="arrow"></span>
                                                            <i class="fa fa-th"></i>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="col-md-5">
                                                    <div class="input-append success date col-md-10 col-lg-6 no-padding">
                                                        <input type="text" name="fec_fin" class="form-control" id="fec_fin" placeholder="Fec. Final">
                                                        <span class="add-on">
                                                            <span class="arrow"></span>
                                                            <i class="fa fa-th"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <input name="criterio1" type="text" class="form-control" id="criterio1" placeholder="Detalle 1">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <input name="criterio2" type="text" class="form-control" id="criterio2" placeholder="Detalle 2">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <input name="criterio3" type="text" class="form-control" id="criterio3" placeholder="Detalle 3">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-3">
                                                    <input name="deposito" type="text" class="form-control" id="deposito" placeholder="Deposito">
                                                </div>
                                                <div class="col-md-3">
                                                    <input name="caja" type="text" class="form-control" id="caja" placeholder="Caja">
                                                </div>
                                                <div class="col-md-3">
                                                    <input name="carpeta" type="text" class="form-control" id="carpeta" placeholder="Carpeta">
                                                </div>
                                                <div class="col-md-3">
                                                    <input name="folios_expedientes" type="number" class="form-control" id="folios_expedientes" placeholder="Folios">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-8">
                                                    <div class="checkbox check-success  ">
                                                        <input name="acti" type="checkbox" id="acti" checked="checked">
                                                        <label for="acti">Activo</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pull-left">
                                        <button class="btn btn-success btn-cons" type="submit" id="BtnNuevoExpediente" name="BtnNuevoExpediente">
                                            <span class="glyphicon glyphicon-check"></span> Nuevo
                                        </button>
                                        <button class="btn btn-primary btn-cons" type="submit" id="BtnGuardar" name="BtnGuardar">
                                            <span class="glyphicon glyphicon-check"></span> Guardar
                                        </button>
                                        <button class="btn btn-primary btn-cons" type="submit" id="BtnSubirArchivo" name="BtnSubirArchivo">
                                            <span class="fa fa-cloud-upload"></span> Subir Archivos
                                        </button>
                                    </div>

                                    <div class="pull-right">
                                        <button class="btn btn-success btn-cons" type="button" id="BtnNuevoExpediente" id="BtnBuscarExpediente" name="BtnBuscarExpediente" data-toggle="modal" data-target="#myModalExpedientes">
                                            <i class="fa fa-search"></i> Buscar Expediente
                                        </button>
                                        <button type="button" class="btn btn-success btn-cons" id="BtnVerExpediente" data-toggle="modal" data-target="#myModalDigitalizados">
                                            <i class="fa fa-eye"></i> Ver Expediente
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4>
                                <span class="text-success">Documentos, </span>
                                disponibles para el cargue de archivos digitales
                            </h4>
                            <ul class="nav nav-tabs" id="tab-01">
                                <li class="active">
                                    <a href="#tab2hellowWorld">Lista de Chekeo</a>
                                </li>
                                <li><a href="#tab2FollowUs">Como un todo</a></li>
                            </ul>
                            <div id="DivTiposDocumentales"></div>
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

    <!-- BEGIN MODAL PARA BUSCAR EXPEDIENTES-->
    <div class="modal fade" id="myModalExpedientes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <br>
                    <i class="fa fa-folder-o fa-2x"></i>
                    <h4 id="myModalLabel" class="semi-bold">Expedientes.</h4>
                    <p class="no-margin">Elige el expediente para actualizar.</p>
                    <br>
                </div>
                <div class="modal-body">
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="grid simple ">
                                <div class="grid-body ">
                                    <div class="row form-row">
                                        <div id="DivAlertasExpedientes"></div>
                                        <div class="col-md-12">
                                            <input name="TxtBusExpediente" type="text" class="form-control" id="TxtBusExpediente"
                                            placeholder="Ingrese aqui el criterio de búsqueda para el expediente.">
                                        </div>
                                    </div>
                                    <div class="row form-row">
                                        <div class="col-md-12">
                                            <div id="DivListarExpedientes"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success" data-dismiss="modal" id="BtnLlevarTerceroNatural">Llevar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END MODAL PARA BUSCAR EXPEDIENTES -->

    <!-- BEGIN MODAL PARA LOS DIGITALES-->
    <div class="modal fade" id="myModalDigitalizados" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width: 90%; height: 90%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <br>
                    <i class="fa fa-file-o fa-2x"></i>
                    <h4 id="myModalLabel" class="semi-bold">Digitales.</h4>
                    <p class="no-margin" id="LabelExpedientes"></p>
                    <br>
                </div>
                <div class="modal-body">

                    <div class="row-fluid">

                        <div id="DivAlertasVerExpediente"></div>

                        <div class="span12">
                            <div class="grid simple">
                                <ul class="nav nav-tabs" id="tab-01">
                                    <li class="active">
                                        <a href="#tabListaChekeoVerExpediente">Lista de Chekeo</a>
                                    </li>
                                    <li>
                                        <a href="#tabComoUnTodoVerExpediente">Como un todo</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tabListaChekeoVerExpediente">
                                        <div class="row column-seperation">
                                            <div class="col-md-12">
                                                <div class="col-md-4">
                                                    <div id="DivVerTiposDocumentales"></div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="row form-row">
                                                        <div class="col-md-2">
                                                            <select name="id_tomo_ver_tipo_documento" id="id_tomo_ver_tipo_documento" class="select2 form-control ">
                                                                <?php echo $Combo_Tomos; ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-10">
                                                            <input name="busca_ver_archivo" type="text" class="form-control" id="busca_ver_archivo" placeholder="Buscar archivo">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div id="DivListarArchivosDigitales_Expediente"></div>    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tabComoUnTodoVerExpediente">
                                        <div class="row">
                                            <div class="col-md-12">

                                                <div class="row form-row">
                                                    <div class="col-md-2">
                                                        <select name="id_tomo_ver_archivos_ComoUnTodo" id="id_tomo_ver_archivos_ComoUnTodo" class="select2 form-control ">
                                                            <?php echo $Combo_Tomos; ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input name="busca_ver_archivo" type="text" class="form-control" id="busca_ver_archivo" placeholder="Buscar archivo">
                                                    </div>
                                                </div>
                                                <div id="DivListarArchivosDigitales_Como_Un_Todo"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success" data-dismiss="modal" id="BtnLlevarTerceroNatural">Llevar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END MODAL PARA DIGITALES -->

    <!-- BEGIN CORE JS FRAMEWORK-->

    <script src="funciones.ajax.js"></script>

    <script src="../../../../public/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/breakpoints.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>

    <!-- END CORE JS FRAMEWORK -->
    <script src="../../../../public/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="../../../../public/assets/plugins/pace/pace.min.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script> 
    <script src="../../../../public/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/ios-switch/ios7-switch.js" type="text/javascript"></script>
    <script srrc="../../../../public/assets/plugins/bootstrap-tag/bootstrap-tagsinput.min.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/bootstrap-select2/select2.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="../../../../public/assets/js/form_elements.js" type="text/javascript"></script>

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="../../../../public/assets/js/core.js" type="text/javascript"></script>
    <script src="../../../../public/assets/js/chat.js" type="text/javascript"></script> 
    <script src="../../../../public/assets/js/demo.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- END JAVASCRIPTS -->


    <script src="../../../../public/assets/sweetalert2/sweetalert-dev.js"></script>
    <link href="../../../../public/assets/sweetalert2/sweetalert.css" rel="stylesheet" type="text/css">
    <script type="text/javascript">
       $('.input-append.date').datepicker({
        autoclose: true,
        todayHighlight: true
    });

       $(".select2").select2();
   </script>


   <!-- END CORE TEMPLATE JS -->
</body>
</html>
