<?php
session_start();
include "../../../config/class.Conexion.php";
include( "../../../config/variable.php");
include( "../../../config/funciones.php");
include( "../../../config/funciones_seguridad.php");
require_once '../../clases/radicar/class.RadicaRecibido.php';
require_once '../../clases/general/class.GeneralFuncionario.php';
require_once '../../clases/configuracion/class.ConfigOtras.php';
require_once '../../clases/areas/class.AreasDependencia.php';
require_once '../../clases/retencion/class.TRDSerie.php';
require_once '../../clases/retencion/class.TRDSubSerie.php';
require_once '../../clases/retencion/class.TRDTipoDocumento.php';

$Funcionario = Funcionario::Listar(6, 0, "", "", "", 0, 0, 0);
$ConfigOtas  = ConfigOtras::Buscar();

$Dependencia = Dependencia::Listar(6, "", "", "", "");
$Combo_Dependencias = "";
foreach($Dependencia as $Item):
    $Combo_Dependencias.= "<option value='".$Item['id_depen']."'>".$Item['cod_corres'].".".$Item['nom_depen']."</option>";
endforeach;

$Series = Serie::Listar(4, "", "", "");
$Combo_Series = "";
foreach($Series as $Item):
    $Combo_Series.= "<option value='".$Item['id_serie']."'>".$Item['cod_serie'].".".$Item['nom_serie']."</option>";
endforeach;

$SubSeries = SubSerie::Listar(4, "", "", "", "");
$Combo_SubSeries = "";
foreach($SubSeries as $Item):
    $Combo_SubSeries.= "<option value='".$Item['id_subserie']."'>".$Item['cod_subserie'].".".$Item['nom_subserie']."</option>";
endforeach;

$TipoDocumento = TipoDocumento::Listar(2, "", "");
$Combo_TipoDocumentos = "";
foreach($TipoDocumento as $Item):
    $Combo_TipoDocumentos.= "<option value='".$Item['id_tipodoc']."'>".$Item['nom_tipodoc']."</option>";
endforeach;

$ConfiguracionOtras = ConfigOtras::Buscar();
if($ConfiguracionOtras->get_Incluir_TRD() == 0){
    $Combo_TipoDocumentos = "";

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
    <title>...::: Iwana - Ventanilla :::...</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN PLUGIN CSS -->
    <!-- BEGIN PLUGIN CSS -->
    <link href="../../../public/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="../../../public/assets/plugins/jquery-datatable/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <link href="../../../public/assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="../../../public/assets/plugins/datatables-responsive/css/datatables.responsive.css" rel="stylesheet" type="text/css" media="screen" />
    <!-- END PLUGIN CSS -->
    <!-- BEGIN CORE CSS FRAMEWORK -->
    <link href="../../../public/assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../../../public/assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="../../../public/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="../../../public/assets/css/animate.min.css" rel="stylesheet" type="text/css" />
    <link href="../../../public/assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" />
    <!-- END CORE CSS FRAMEWORK -->
    <!-- BEGIN CSS TEMPLATE -->
    <link href="../../../public/assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="../../../public/assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="../../../public/assets/css/custom-icon-set.css" rel="stylesheet" type="text/css" />
    <!-- END CSS TEMPLATE -->

    <link href="../../../public/assets/css/botones_redondos.css" rel="stylesheet" type="text/css" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="inner-menu-always-open">
    <!-- BEGIN HEADER -->
    <?php require_once '../../../config/cabeza.php'; ?>
    <!-- END HEADER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container row-fluid">
        <div class="page-sidebar mini mini-mobile" id="main-menu" data-inner-menu="1">
            <div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrappers">
                <div class="user-info-wrapper">
                    <!-- BEGIN MINI-PROFILE -->
                    <?php require_once '../../../config/mini_profile.php'; ?>
                    <!-- END MINI-PROFILE -->
                </div>
                <!-- BEGIN SIDEBAR MENU -->
                <?php require_once '../../../config/menu_ventanilla.php'; ?>
                <!-- END SIDEBAR MENU -->
            </div>
            <div class="inner-menu nav-collapse">
                <div id="inner-menu">
                    <div class="inner-wrapper">

                    </div>
                    <div class="inner-wrapper">
                        <p class="menu-title">VISTA RÁPIDA</p>
                    </div>
                    <ul class="small-items">

                    </ul>
                </div>
            </div>
        </div>
        <a href="#" class="scrollup">Scroll</a>
        <!-- BEGIN PAGE -->
        <div class="page-content">
            <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
            <div id="portlet-config" class="modal hide">
                <div class="modal-header">
                    <button data-dismiss="modal" class="close" type="button"></button>
                    <h3>Widget Settings</h3>
                </div>
                <div class="modal-body">
                    Widget settings form goes here
                </div>
            </div>
            <div class="clearfix">
            </div>
            <div class="content">
                <ul class="breadcrumb">
                    <li>
                        <p>Tú estas</p>
                    </li>
                    <li>
                        <a href="#" class="active">Radicar - Consulta de Correspondencia.</a>
                    </li>
                </ul>
                <div class="page-title" style="display:none">
                    <a href="#" id="btn-back">
                        <i class="icon-custom-left"></i>
                    </a>
                    <h3>Regresar - <span class="semi-bold">Consulta de Correspondencia</span></h3>
                </div>
                <div class="row" id="inbox-wrapper">
                    <div class="col-md-12">
                        <div id="DivAlertas"></div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <form role="form" name="FrmDatos" id="FrmDatos">

                                <input name="tipo_impre_torulo" id="tipo_impre_torulo" type="hidden" value="<?php echo $ConfigOtas->get_TipoImpresionRotulo(); ?>">
                                <input name="incluir_trd" type="hidden" id="incluir_trd" value="<?php echo $ConfiguracionOtras->get_Incluir_TRD(); ?>">
                                <input name="incluir_oficina_trd" id="incluir_oficina_trd" type="hidden" value="<?php echo $ConfiguracionOtras->get_Incluir_Oficina_TRD(); ?>">

                                <div class="col-md-12">
                                    <div class="grid simple">
                                        <div class="grid-title no-border">
                                            <h4 class=" inline">
                                                <span class="text-success">
                                                    <i class="fa fa-search"></i> Consulta,
                                                </span> de Correspondencia
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
                                                    <input name="id_radica" type="text" class="form-control" id="id_radica" placeholder="# De Radicado">
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
                                                    <select name="origen" id="origen" class="select2 form-control">
                                                        <option value="0">...::: Elije el origen de la correspondencia :::...</option>
                                                        <option value="Recibido">Correspondencia Recibida</option>
                                                        <option value="Enviado">Correspondencia Enviada</option>
                                                        <option value="Interna">Correspondencia Interna</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-4">
                                                    <input name="asunto" type="text" class="form-control" id="asunto" placeholder="Asunto">
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="input-group" id="InputGroupTercero">
                                                        <input name="id_tercero" id="id_tercero" type="hidden">
                                                        <input name="tipo_tercero" id="tipo_tercero" type="hidden">
                                                        <input name="tercero" type="text" class="form-control" id="tercero" placeholder="Tercero">
                                                        <div class="input-group-btn">
                                                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                                                <i class="fa fa-ellipsis-v"></i>
                                                                <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu pull-right" role="menu">
                                                                <li>
                                                                    <a href="#" data-toggle="modal" data-target="#myModalTerceroNatural" id="BtnBuscarTerceroNatural">Buscar tercero natural</a>
                                                                </li>
                                                                <li>
                                                                    <a href="#" data-toggle="modal" data-target="#myModalTerceroJuridico" id="BtnBuscarTerceroJuridico">Buscar tercero juridico</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <input name="id_destinatario" id="id_destinatario" type="hidden" value="">
                                                    <input name="destinatario" type="text" class="form-control" id="destinatario" placeholder="Destinatario">
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button" class="btn btn-success btn-sm btn-small" data-toggle="modal" data-target="#myModalDestinatarios" id="BtnBuscarDestinatario">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-2">
                                                    <select name="id_depen" id="id_depen" class="select2 form-control"  >
                                                        <option value="0">...::: Todas Las Dependencias :::...</option>
                                                        <?php echo $Combo_Dependencias; ?>
                                                    </select>
                                                </div>
                                                <?php
                                                if($ConfiguracionOtras->get_Incluir_Oficina_TRD() == 2){
                                                    ?>
                                                    <div class="col-md-2">
                                                        <select name="id_oficina" id="id_oficina" class="select2 form-control"  >
                                                            <option value="0">...::: Elije la Oficina :::...</option>
                                                            <?php  echo $Combo_Oficinas; ?>
                                                        </select>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                                <div class="col-md-2">
                                                    <select name="id_serie" id="id_serie" class="select2 form-control"  >
                                                        <option value="0">...::: Todas Las Series :::...</option>
                                                        <?php  echo $Combo_Series; ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <select name="id_subserie" id="id_subserie" class="select2 form-control"  >
                                                        <option value="0">...::: Todas Las Subseries :::...</option>
                                                        <?php  echo $Combo_SubSeries; ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <select name="id_tipodoc" id="id_tipodoc" class="select2 form-control"  >
                                                        <option value="0">...::: Todos los Tipo de Documento :::...</option>
                                                        <?php //echo $Combo_TipoDocumentos; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <div class="pull-left">
                                                    <button class="btn btn-white btn-cons" type="button" id="BtnLimpiar" name="BtnLimpiar">
                                                        <span class="fa fa-search"></span> Limpiar
                                                    </button>
                                                    <button class="btn btn-primary btn-cons" type="submit" id="BtnBuscar" name="BtnBuscar">
                                                        <span class="fa fa-search"></span> Buscar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="col-md-12">
                                <div class="grid simple">
                                    <div class="grid-body no-border email-body">
                                        <br>
                                        <div class="row-fluid">
                                            <div id="email-list">
                                                <div id="DivResultados"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" id="preview-email-wrapper" style="display:none">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="grid simple">
                                    <div class="grid-title no-border">
                                        <h4></h4>
                                        <div class="tools">
                                            <a href="javascript:;" class="remove"></a>
                                        </div>
                                    </div>
                                    <div class="grid-body no-border" style="min-height: 850px;">
                                        <div class="">
                                            <div class="" id="DivRadicadosInfo">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE -->
        </div>
        <!-- BEGIN CHAT -->
        <div class="chat-window-wrapper">
            <div id="main-chat-wrapper" class="inner-content">
            </div>
        </div>
    </div>

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

    <!-- BEGIN MODAL PARA LOS DESTINATARIOS-->
    <div class="modal fade" id="myModalDestinatarios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <br>
                    <i class="fa fa-users fa-2x"></i>
                    <h4 id="myModalLabel" class="semi-bold">Funcionarios disponibles.</h4>
                    <p class="no-margin">Elige los funcionarios a los cuales les vas a enviar la correspondencia</p>
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
                                                <th style="width:1%">

                                                </th>
                                                <th style="width:30%">Funcionario</th>
                                                <th style="width:30%">Oficina</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach($Funcionario as $Item):
                                                ?>
                                                <tr>
                                                    <td class="v-align-middle">
                                                        <button type="button" id="BtnLlevarFuncionario" class="btn btn-block btn-success btn-xs btn-mini"
                                                        name="BtnLlevarFuncionario[]"
                                                        data-id_funcio="<?php echo $Item['id_funcio_deta']; ?>"
                                                        data-nombre_destinatario="<?php echo $Item['nom_funcio']." ".$Item['ape_funcio']; ?>">
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
                <button type="button" class="btn btn-success" data-dismiss="modal" id="BtnLlevarDestinatarios">Llevar</button>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL PARA DESTINATARIOS-->

<!-- BEGIN MODAL PARA LOS ADJUNTAR DOCUMENTO-->
<div class="modal fade" id="myModalAdjuntarDocumento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <br>
                <i class="fa fa-file-o fa-2x"></i>
                <h4 id="myModalLabel" class="semi-bold">Adjuntar documento.</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-11">
                        <form enctype="multipart/form-data" class="formulario">
                            <input type="file" class="filestyle" data-buttonBefore="true" data-buttonName="btn-success" name="archivo" id="AdjuntoDigital">
                            <input name="IdRadicado" id="IdRadicado" type="hidden" value="">
                            <input name="Origen" id="Origen" type="hidden" value="Entrada">
                        </form>
                    </div>
                    <div class="form-group col-md-1">
                        <div id="DivAlertarAdjuntoDigital"></div>
                    </div>
                </div>
                <!-- LISTAR LOS FUNCIONARIOS PARA QUIEVES VA DIRIGIDA LA CORREPONDENCIA-->

                <!-- FIN DE LISTAR LOS FUNCIONARIOS PARA QUIEVES VA DIRIGIDA LA CORREPONDENCIA-->
                <div class="row-fluid">
                    <div class="span12">
                        <div class="grid simple ">
                            <div class="grid-body ">
                                <iframe width="100%" height="300px" id="ifrVisualizaArchivo"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="BtnCancelarSubirDigital">Cancelar</button>
                <button type="button" class="btn btn-success" id="BtnSubirDigital">
                    <i class="fa fa-cloud-upload"></i> Subir
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- END MODAL PARA ADJUNTAR DOCUMETNO -->
<!-- BEGIN MODAL PARA IMPRIMIR ROTULO-->
<div class="modal fade" id="myModalImprimirRotulo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <br>
                <i class="fa fa-credit-card fa-2x"></i>
                <h4 id="myModalLabel" class="semi-bold">Imprimir Rotulo.</h4>
                <div id="ojo"></div>
            </div>
            <div class="modal-body">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="grid simple ">
                            <div class="grid-body ">
                                <iframe width="100%" height="300px" id="ifrImprimirRotulo"></iframe>
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

<?php
require_once "../../varios/modales_ventanilla.php";
include '../../varios/ayudas.php';
?>
<!-- END MODAL PARA IMPRIMIR ROTULO-->
<script src="../../../public/assets/plugins/jquery-1.8.3.min.js"></script>
<script src="funciones.ajax.js"></script>
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
<script src="../../../public/assets/plugins/jquery-datatable/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="../../../public/assets/plugins/jquery-datatable/extra/js/dataTables.tableTools.min.js" type="text/javascript"></script>
<script type="text/javascript" src="../../../public/assets/plugins/datatables-responsive/js/datatables.responsive.js"></script>
<script type="text/javascript" src="../../../public/assets/plugins/datatables-responsive/js/lodash.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="../../../public/assets/js/tabs_accordian.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="../../../public/assets/js/datatables.js" type="text/javascript"></script>
<script src="../../../public/assets/js/email_comman.js" type="text/javascript"></script>
<!-- BEGIN CORE TEMPLATE JS -->
<script src="../../../public/assets/js/core.js" type="text/javascript"></script>
<script src="../../../public/assets/js/chat.js" type="text/javascript"></script>
<script src="../../../public/assets/js/demo.js" type="text/javascript"></script>
<!-- END CORE TEMPLATE JS -->
<!-- END JAVASCRIPTS -->
<script src="../../../public/assets/sweetalert2/sweetalert-dev.js"></script>
<link href="../../../public/assets/sweetalert2/sweetalert.css" rel="stylesheet" type="text/css">
<script src="../../../public/assets/css/bootstrap-filestyle.min.js"></script>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="../../../public/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="../../../public/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
<script src="../../../public/assets/plugins/jquery-inputmask/jquery.inputmask.min.js" type="text/javascript"></script>
<script src="../../../public/assets/plugins/ios-switch/ios7-switch.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="../../../public/assets/plugins/boostrap-form-wizard/js/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
<script src="../../../public/assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="../../../public/assets/js/form_validations.js" type="text/javascript"></script>
<script src="../../../public/assets/js/form_elements.js" type="text/javascript"></script>
</body>
</html>