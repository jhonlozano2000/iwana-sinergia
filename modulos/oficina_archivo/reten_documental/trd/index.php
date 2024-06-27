<?php
session_start();
require_once '../../../../config/variable.php';
require_once '../../../../config/funciones.php';
require_once '../../../../config/funciones_seguridad.php';
require_once '../../../../config/class.Conexion.php';
require_once("../../../clases/seguridad/class.SeguridadUsuario.php");
require_once("../../../clases/seguridad/class.SeguridadModulo.php");
require_once '../../../clases/retencion/calss.TRD.php';
require_once '../../../clases/retencion/class.TRDSerie.php';
require_once '../../../clases/retencion/class.TRDSubSerie.php';
require_once '../../../clases/areas/class.AreasDependencia.php';
require_once '../../../clases/retencion/class.TRDTipoDocumento.php';
require_once '../../../clases/configuracion/class.ConfigOtras.php';

$ConfiguracionOtras = ConfigOtras::Buscar(1);

$Dependencias = Dependencia::Listar(6, "", "", "", "");;
$Combo_Dependencias = "";
foreach($Dependencias as $Item):
    $Combo_Dependencias.= "<option value='".$Item['id_depen']."'>".$Item['cod_depen'].".".$Item['nom_depen']."</option>";
endforeach;

$Series = Serie::Listar(4, "", "", "");
$Combo_Serie = "";
foreach($Series as $Item):
    $Combo_Serie.= "<option value='".$Item['id_serie']."'>".$Item['cod_serie'].".".$Item['nom_serie']."</option>";
endforeach;

$SubSeries = SubSerie::Listar(4, "", "", "", "");
$Combo_SubSerie = "";
foreach($SubSeries as $Item):
    $Combo_SubSerie.= "<option value='".$Item['id_subserie']."'>".$Item['cod_subserie'].".".$Item['nom_subserie']."</option>";
endforeach;
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>...::: Iwana - Oficina de Archivo, TRD :::...</title>
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

    <link href="../../../../public/assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="../../../../public/assets/plugins/jquery-datatable/css/jquery.dataTables.css" rel="stylesheet" type="text/css"/>
    <link href="../../../../public/assets/plugins/datatables-responsive/css/datatables.responsive.css" rel="stylesheet" type="text/css" media="screen"/>
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
                        <a href="#" class="active">Oficina de Archivo - TRD.</a>
                    </li>
                </ul>
                <div id="DivAlerta"></div>
                <!-- BEGIN DASHBOARD TILES -->
                <form role="form" name="FrmDatos" id="FrmDatos">
                    <input name="accion" id="accion" type="hidden" value="INSERTAR">
                    <input name="edit_id_subserie" id="edit_id_subserie" type="hidden">
                    <input name="nombre_subserie" id="nombre_subserie" type="hidden">
                    <input name="incluir_oficina_trd" id="incluir_oficina_trd" type="hidden" value="<?php echo $ConfiguracionOtras->get_Incluir_Oficina_TRD(); ?>">

                    <div class="col-md-12">
                        <div class="grid simple">
                            <div class="grid-body no-border">
                                <div class="row column-seperation">
                                    <div class="col-md-3">
                                        <div class="grid-title no-border">
                                            <h4>
                                                <span class="text-success">Nueva</span>, 
                                                Información básica de la TRD
                                            </h4>    
                                        </div>
                                        <div class="row form-row">
                                            <select name="id_depen" id="id_depen" class="select2 form-control"  >
                                                <option value="0">...::: Elije La Dependencias :::...</option>
                                                <?php echo $Combo_Dependencias; ?>
                                            </select>
                                        </div>
                                        <?php
                                        if($ConfiguracionOtras->get_Incluir_Oficina_TRD() == 2){
                                            ?>
                                            <div class="row form-row">
                                                <select name="id_oficina" id="id_oficina" class="select2 form-control"  >
                                                    <option value="0">...::: Elije la Oficina :::...</option>
                                                    <?php  echo $Combo_Oficinas; ?>
                                                </select>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <div class="row form-row">
                                            <select name="id_serie" id="id_serie" class="select2 form-control"  >
                                                <option value="0">...::: Elije La Series :::...</option>
                                                <?php echo $Combo_Serie; ?>
                                            </select>
                                        </div>
                                        <div class="row form-row">
                                            <select name="id_subserie" id="id_subserie" class="select2 form-control"  >
                                                <option value="0">...::: Elije La Subseries :::...</option>
                                                <?php echo $Combo_SubSerie; ?>
                                            </select>
                                        </div>
                                        <div class="row form-row">
                                            <h4>
                                                <span class="text-success">Retención</span>
                                            </h4>
                                            <div class="col-md-6">
                                                <input name="agForm" type="text" class="form-control" id="agForm"
                                                placeholder="A.G" value="0">
                                            </div>
                                            <div class="col-md-6">
                                                <input name="acForm" type="text" class="form-control" id="acForm"
                                                placeholder="A.C" value="0">
                                            </div>
                                        </div>
                                        <div class="row form-row">
                                            <h4><span class="text-success">Disposición Final</span></h4>
                                            <div class="col-md-3">
                                                <div class="checkbox check-success">
                                                    <input name="ChkFormCT" type="checkbox" id="ChkFormCT">
                                                    <label for="ChkFormCT">CT</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="checkbox check-success">
                                                    <input name="ChkFormE" type="checkbox" id="ChkFormE">
                                                    <label for="ChkFormE">E</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="checkbox check-success">
                                                    <input name="ChkFormDM" type="checkbox" id="ChkFormDM">
                                                    <label for="ChkFormDM">DM</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="checkbox check-success">
                                                    <input name="ChkFormS" type="checkbox" id="ChkFormS">
                                                    <label for="ChkFormS">S</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-row">
                                            <div class="col-md-12">
                                                <textarea name="observa" rows="3" class="form-control" id="observa" placeholder="Ingrese las observaciones si las hay..."></textarea>
                                            </div>
                                        </div>
                                        <div class="row form-row">
                                            <div class="col-md-12">
                                                <div class="checkbox check-success">
                                                    <input id="acti" type="checkbox" checked="checked">
                                                    <label for="acti">Activo</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="grid-title no-border">
                                            <div class="pull-left">
                                                <h4><span class="text-success">Subserie, </span>Asociadas a la TRD</h4>
                                            </div>
                                            <div class="pull-right">
                                                <div id="DivAlertaSubseries"></div>
                                            </div>
                                        </div>
                                        <div class="row form-row">
                                            <div class="col-md-12" style="height:70%; overflow-y: scroll;">
                                                <table class="table table-bordered no-more-tables" id="TblTRD">
                                                    <thead>
                                                        <tr>
                                                            <th style="width:1%">Acti.</th>
                                                            <th style="width:1%">Cod.</th>
                                                            <th class="text-center" style="width:30%">Serie</th>
                                                            <th class="text-center" style="width:40%">Subserie</th>
                                                            <th style="width:12%">A.G</th>
                                                            <th style="width:12%">A.C</th>
                                                            <th style="width:1%">CT</th>
                                                            <th style="width:1%">E</th>
                                                            <th style="width:1%">DM</th>
                                                            <th style="width:1%">S</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="pull-left">
                                        <button class="btn btn-primary btn-cons" type="button" id="BtnGuarda" name="BtnGuarda">
                                            <span class="glyphicon glyphicon-check"></span> Guardar
                                        </button>
                                        <button class="btn btn-white btn-cons" type="button">Cancel</button>
                                        <!--
                                        <button class="btn btn-info btn-cons" type="button" data-toggle="modal" data-target="#myModalSubseries" id="BtnBuscarSubserie">
                                            <i class="fa fa-search"></i> Buscar Subseries
                                        </button>
                                    -->
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
        <?php require_once '../../../../config/chat.php'; ?>
    </div>
    <!-- END CHAT -->		  
</div>
<!-- END CONTAINER -->


<!-- BEGIN MODAL PARA LS SUBSERIES-->
<div class="modal fade" id="myModalSubseries" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="myModalLabel" class="semi-bold">Subseries -  
                    <p class="no-margin">Gestion de la Subserie: 
                        <div id="DivNomSubserie"></div> 
                    </p>
                </h4>
            </div>
            <div class="modal-body">
                <div class="row-fluid">
                 <div class="grid simple ">
                    <div class="grid-body ">
                        <div class="row form-row">
                            <div class="col-md-12">
                                <div id="DivAlertasGestionSubseries"></div>
                                <div id="DivGestionSubseries"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <div class="pull-left">
                <button class="btn btn-primary btn-cons" type="button" id="BtnEditarSubserie" name="BtnEditarSubserie">
                    <span class="glyphicon glyphicon-check"></span> Guardar
                </button>
                <button class="btn btn-success btn-cons" type="button" id="BtnBuscarTipoDocumental" name="BtnBuscarTipoDocumental" data-toggle="modal" data-target="#myModalTipoDocumental">
                    <i class="fa fa-search"></i> Buscar Tipo Documental
                </button>
            </div>
            <button type="button" class="btn btn-default" data-dismiss="modal"> Cancelar</button>
        </div>
    </div>
</div>
</div>
<!-- END MODAL PARA LAS SUBSERIES -->

<!-- BEGIN MODAL PARA LOS TIPOS DOCUMENTALES-->
<div class="modal fade" id="myModalTipoDocumental" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="myModalLabel" class="semi-bold">Tipos documentales disponibles.</h4>
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
                                            <th style="width:96%">Tipo Documental</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $TiposDocumentos = TipoDocumento::Listar(2, "", "", "");
                                        foreach($TiposDocumentos as $Item):
                                            ?>
                                            <tr>
                                                <td class="v-align-middle">
                                                    <button type="button" class="btn btn-block btn-success levar_tipo_documento btn-mini" data-id_tipo_documento="<?php echo $Item['id_tipodoc']; ?>" data-nom_tipo_documento="<?php echo $Item['nom_tipodoc']; ?>">
                                                        <i class="fa fa-check"></i>
                                                    </button>
                                                </td>
                                                <td class="v-align-middle">
                                                    <span class="muted">
                                                        <?php 
                                                        echo $Item['nom_tipodoc']; 
                                                        ?>
                                                    </span>
                                                </td>
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
<!-- END MODAL PARA RESPONSABLES-->

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
<!-- END CORE TEMPLATE JS -->
<script src="../../../../public/assets/sweetalert2/sweetalert-dev.js"></script>
<link href="../../../../public/assets/sweetalert2/sweetalert.css" rel="stylesheet" type="text/css">
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
</body>
</html>

