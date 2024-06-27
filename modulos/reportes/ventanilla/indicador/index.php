<?php
session_start();
require_once '../../../../config/variable.php';
require_once '../../../../config/funciones.php';
require_once '../../../../config/funciones_seguridad.php';
require_once '../../../../config/class.Conexion.php';
require_once '../../../clases/seguridad/class.SeguridadUsuario.php';
require_once '../../../clases/general/class.GeneralFuncionario.php';
require_once '../../../clases/configuracion/class.ConfigServidor_Digitalizacion.php';
require_once '../../../clases/areas/class.AreasDependencia.php';

$Dependencia = Dependencia::Listar(6, "", "", "", "");
$Combo_Dependencias = "";
foreach($Dependencia as $Item):
    $Combo_Dependencias.= "<option value='".$Item['id_depen']."'>".$Item['cod_corres'].".".$Item['nom_depen']."</option>";
endforeach;
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>...::: Iwana - Reportes, Ventanilla :::...</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN PLUGIN CSS -->
    <link href="../../../../public/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="../../../../public/assets/plugins/bootstrap-tag/bootstrap-tagsinput.css" rel="stylesheet" type="text/css"/>
    <link href="../../../../public/assets/plugins/dropzone/css/dropzone.css" rel="stylesheet" type="text/css"/>
    <link href="../../../../public/assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css"/>
    <link href="../../../../public/assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" type="text/css" />
    <link href="../../../../public/assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.css" rel="stylesheet" type="text/css" />
    <link href="../../../../public/assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet" type="text/css" />
    <link href="../../../../public/assets/plugins/ios-switch/ios7-switch.css" rel="stylesheet" type="text/css" media="screen">
    <link href="../../../../public/assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="../../../../public/assets/plugins/boostrap-clockpicker/bootstrap-clockpicker.min.css" rel="stylesheet" type="text/css" media="screen"/>
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
    <script src="funciones.ajax.js"></script>
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
                        <a href="#" class="active">Reportes, Ventanilla - Indicadores.</a>
                    </li>
                </ul>
                <div id="DivAlertas"></div>
                <!-- BEGIN DASHBOARD TILES -->
                <div class="row">
                    <form role="form" name="frm-datos" id="frm-datos">
                        <div class="col-md-12">
                            <div class="grid simple">
                                <div class="grid-title no-border">
                                    <h4 class=" inline">
                                        <span class="text-success">
                                            <i class="fa fa-search"></i> Consulta,
                                        </span> de Correspondencia - Indicadores
                                    </h4>
                                </div>
                                <div class="grid-body no-border">
                                    <div class="row form-row">
                                        <div class="row-fluid" style="display:none;" id="DivOtrosElementos">
                                            <div class="slide-success">
                                                <input type="checkbox" name="switch" class="iosblue" checked="checked"/>
                                            </div>
                                            <div class="slide-primary">
                                                <input type="checkbox" name="switch" class="ios" checked="checked" placeholder="Requiere respuesta" />
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <select name="origen_correspon" id="origen_correspon" class="select2 form-control"  >
                                                <option value="0">...:::Elije el origen :::...</option>
                                                <option value="CORRES_RECIBIDA">Correspondencia recibida</option>
                                                <option value="CORRES_ENVIADA">Correspondencia enviada</option>
                                                <option value="CORRES_INTERNA">Correspondencia interna</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="input-append success date">
                                                <input name="desde" type="text" class="form-control" id="desde" placeholder="Desde la fecha">
                                                <span class="add-on">
                                                    <span class="arrow"></span>
                                                    <i class="fa fa-th"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-append success date">
                                                <input name="hasta" type="text" class="form-control" id="hasta" placeholder="Hasta la fecha">
                                                <span class="add-on">
                                                    <span class="arrow"></span>
                                                    <i class="fa fa-th"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <select name="id_depen" id="id_depen" class="select2 form-control"  >
                                                <option value="0">...::: Todas Las Dependencias :::...</option>
                                                <?php echo $Combo_Dependencias; ?>
                                            </select>
                                        </div>
                                    </div>
                                   
                                    <div class="grid-title no-border">
                                        <h4 class=" inline">
                                            <span class="text-success">
                                                <i class="glyphicon glyphicon-check"></i> Mostrar 
                                            </span> las columnas
                                        </h4>
                                    </div>
                                    <div class="row form-row">
                                        <div class="col-md-1">
                                            <div class="checkbox check-success" id="DivMostrarTercero">
                                                <input id="ChkTercero" type="checkbox">
                                                <label for="ChkTercero">Tercero</label>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="checkbox check-success">
                                                <input id="ChkFuncionario" type="checkbox">
                                                <label for="ChkFuncionario">Responsable</label>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="checkbox check-success" id="DivMostrarDerinatarioInterno">
                                                <input id="ChkDetinatarioInterno" type="checkbox">
                                                <label for="ChkDetinatarioInterno">Destinatario</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="checkbox check-success">
                                                <input id="ChkDependencia_ChkOficina" type="checkbox">
                                                <label for="ChkDependencia_ChkOficina">Dependencia y Oficina</label>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="checkbox check-success">
                                                <input id="ChkSerie" type="checkbox">
                                                <label for="ChkSerie">Serie</label>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="checkbox check-success">
                                                <input id="ChkSubSerie" type="checkbox">
                                                <label for="ChkSubSerie">Subserie</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="checkbox check-success">
                                                <input id="ChkTipoDocumento" type="checkbox">
                                                <label for="ChkTipoDocumento">Tipo de Documento</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-actions">  
                                        <div class="pull-left">
                                            <button class="btn btn-white btn-cons" type="button" id="BtnLimpiar" name="BtnLimpiar"><span class="fa fa-search"></span> Limpiar</button>
                                            <div class="btn-group">
                                                <button class="btn btn-primary btn-demo-space">Generar</button>
                                                <button class="btn btn-primary dropdown-toggle btn-demo-space" data-toggle="dropdown">
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a href="#" id="BtnFlujoPorFuncioPDF">
                                                            <p class="text-error">
                                                                <i class="fa fa-file-pdf-o fa-lg" aria-hidden="true"></i> Pdf
                                                            </p>
                                                        </a>
                                                    </li>
                                                    <li class="divider"></li>
                                                    <li>
                                                        <a href="#" id="BtnFlujoPorFuncioEXCEL">
                                                            <p class="text-success">
                                                                <i class="fa fa-file-excel-o fa-lg" aria-hidden="true"></i> Excel
                                                            </p>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- BEGIN CHAT --> 
        <div class="chat-window-wrapper">
            <?php require_once '../../../chat/chat.php'; ?>
        </div>
        <!-- END CHAT -->		  
    </div>
    <!-- END CONTAINER -->

    <!-- BEGIN MODAL PARA LOS TERCEROS NATURALES-->
    <div class="modal fade" id="myModalTerceroNatural" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <br>
                    <i class="fa fa-users fa-2x"></i>
                    <h4 id="myModalLabel" class="semi-bold">Tercero Natural.</h4>
                    <p class="no-margin">Elige el tercero de la correspondencia</p>
                    <br>
                </div>
                <div class="modal-body">
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="grid simple ">
                                <div class="grid-body ">
                                    <div class="row form-row">
                                        <div id="DivAlertasTerceroNaturales"></div>
                                        <div class="col-md-12">
                                            <input name="TxtBusTerceroNaturales" type="text" class="form-control" id="TxtBusTerceroNaturales"
                                            placeholder="Ingrese aqui el criterio de búsqueda para el tercero natural.">
                                        </div>
                                    </div>
                                    <div class="row form-row">
                                        <div class="col-md-12">
                                            <div id="DivTerceroNaturales"></div>
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
    <!-- END MODAL PARA LOS TERCEROS NATURALES-->
    <!-- BEGIN MODAL PARA LOS TERCEROS JURIDICO-->
    <div class="modal fade" id="myModalTerceroJuridico" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <br>
                    <i class="fa fa-users fa-2x"></i>
                    <h4 id="myModalLabel" class="semi-bold">Tercero Juridico.</h4>
                    <p class="no-margin">Elige el tercero de la correspondencia</p>
                    <br>
                </div>
                <div class="modal-body">
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="grid simple ">
                                <div class="grid-body ">
                                    <div class="row form-row">
                                        <div id="DivAlertasTerceroJuridicos"></div>
                                        <div class="col-md-12">
                                            <input name="TxtBusTerceroJuridicos" type="text" class="form-control" id="TxtBusTerceroJuridicos"
                                            placeholder="Ingrese aqui el criterio de búsqueda para el tercero juridico.">
                                        </div>
                                    </div>
                                    <div class="row form-row">
                                        <div class="col-md-12">
                                            <div id="DivTerceroJuridico"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success" data-dismiss="modal" id="BtnLlevarTerceroJuridico">Llevar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END MODAL PARA JURIDICO -->
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
                                                            data-id_funcio="<?php echo $Item['id_funcio_deta']; ?>" 
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
    <script src="../../../../public/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/jquery-inputmask/jquery.inputmask.min.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/jquery-autonumeric/autoNumeric.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/ios-switch/ios7-switch.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/bootstrap-select2/select2.min.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/bootstrap-tag/bootstrap-tagsinput.min.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/boostrap-clockpicker/bootstrap-clockpicker.min.js" type="text/javascript"></script>
    <script src="../../../../public/assets/plugins/dropzone/dropzone.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="../../../../public/assets/js/form_elements.js" type="text/javascript"></script>
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="../../../../public/assets/js/core.js" type="text/javascript"></script>
    <script src="../../../../public/assets/js/chat.js" type="text/javascript"></script> 
    <script src="../../../../public/assets/js/demo.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- END JAVASCRIPTS -->


    <!-- END JAVASCRIPTS -->
</body>
</html>
