<?php
session_start();
include "../../../../config/class.Conexion.php";
include "../../../../config/variable.php";
include "../../../../config/funciones.php";
include "../../../../config/funciones_seguridad.php";
require_once '../../../clases/retencion/calss.TRD.php';
require_once '../../../clases/general/class.GeneralFuncionario.php';
require_once '../../../clases/configuracion/class.ConfigFormaEnvio.php';
require_once "../../../clases/configuracion/class.ConfigDepartamento.php";
require_once '../../../clases/radicar/class.RadicaRecibido.php';
require_once "../../../clases/configuracion/class.ConfigOtras.php";
require_once "../../../clases/configuracion/class.ConfigTipoRespuesta.php";
require_once '../../../clases/seguridad/class.SeguridadPermiso.php';

$Funcionario          = Funcionario::Listar(6, 0, "", "", "", 0, 0, 0);
$FuncionarioQueFirman = Funcionario::Listar(12, 0, "", "", "", 0, 0, 0);
$FormaLlegada         = FormaEnvio::Listar(1, 0);

//CARGO LOS COMBOS DE LA LA FORMA DE LLGADA DE LA CORRESPONDENCIA
$Combo_FormaLlegada = "";
foreach ($FormaLlegada as $Item) :
    $Combo_FormaLlegada .= "<option value='" . $Item['id_formaenvio'] . "'>" . html_entity_decode($Item['nom_formaenvi'], ENT_QUOTES | ENT_HTML401, "UTF-8") . "</option>";
endforeach;

$Departamento = Departamento::Listar();
$Combo_Departamentos = "";
foreach ($Departamento as $Item) :
    $Combo_Departamentos .= "<option value='" . $Item['id_depar'] . "'>" . ($Item['nom_depar']) . "</option>";
endforeach;

$TiposRespuestas = TipoRespuesta::Listar(3, "", "");
$Combo_TiposRespuestas = "";
foreach ($TiposRespuestas as $Item) :
    $Combo_TiposRespuestas .= "<option value='" . $Item['id_respue'] . "'>" . ($Item['nom_respues']) . "</option>";
endforeach;

$ConfiguracionOtras = ConfigOtras::Buscar();
if ($ConfiguracionOtras->get_Incluir_TRD() == 0) {
    $Combo_TipoDocumentos = "";
    require_once '../../../clases/retencion/class.TRDTipoDocumento.php';
    $Documentos = TipoDocumento::Listar(1, "", "");
    foreach ($Documentos as $Item) :
        $Combo_TipoDocumentos .= "<option value='" . $Item['id_tipodoc'] . "'>" . $Item['nom_tipodoc'] . "</option>";
    endforeach;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>...::: Iwana :::...</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN PLUGIN CSS -->
    <link href="../../../../public/assets/plugins/dropzone/css/dropzone.css" rel="stylesheet" type="text/css" />
    <link href="../../../../public/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="../../../../public/assets/plugins/boostrap-checkbox/css/bootstrap-checkbox.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="../../../../public/assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css" />
    <!-- END PLUGIN CSS -->
    <!-- BEGIN CORE CSS FRAMEWORK -->
    <link href="../../../../public/assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../../../../public/assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="../../../../public/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="../../../../public/assets/css/animate.min.css" rel="stylesheet" type="text/css" />
    <link href="../../../../public/assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" />
    <link href="../../../../public/assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="../../../../public/assets/plugins/jquery-datatable/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <link href="../../../../public/assets/plugins/datatables-responsive/css/datatables.responsive.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="../../../../public/assets/plugins/bootstrap-tag/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />
    <link href="../../../../public/assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet" type="text/css" />
    <link href="../../../../public/assets/plugins/ios-switch/ios7-switch.css" rel="stylesheet" type="text/css" media="screen">
    <link href="../../../../public/assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen" />
    <!-- END CORE CSS FRAMEWORK -->
    <!-- BEGIN CSS TEMPLATE -->
    <link href="../../../../public/assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="../../../../public/assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="../../../../public/assets/css/custom-icon-set.css" rel="stylesheet" type="text/css" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->

<body class="inner-menu-always-open">
    <!-- BEGIN HEADER -->
    <div class="header navbar navbar-inverse">
        <!-- BEGIN TOP NAVIGATION BAR -->
        <div class="navbar-inner">
            <?php include_once '../../../../config/cabeza_ventanilla_form.php'; ?>
        </div>
        <!-- END TOP NAVIGATION BAR -->
    </div>
    <!-- END HEADER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container row-fluid">
        <div class="page-sidebar mini mini-mobile" id="main-menu" data-inner-menu="1">
            <div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrappers">
                <!-- BEGIN MINI-PROFILE -->
                <div class="user-info-wrapper">
                    <?php include_once '../../../../config/mini_profile.php'; ?>
                </div>
                <!-- END MINI-PROFILE -->
                <!-- BEGIN SIDEBAR MENU -->
                <?php include_once '../../../../config/menu_ventanilla.php'; ?>
                <!-- END SIDEBAR MENU -->
            </div>
            <div class="inner-menu nav-collapse">
                <?php require_once '../../../../config/menu_ventanilla_enviada.php'; ?>
            </div>
        </div>
        <a href="#" class="scrollup">Scroll</a>
        <!-- BEGIN PAGE -->
        <div class="page-content">
            <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
            <div class="clearfix"></div>
            <div class="content">
                <ul class="breadcrumb">
                    <li>
                        <p>Tú estas</p>
                    </li>
                    <li>
                        <a href="#" class="">Ventanilla </a>
                    </li>
                    <li>
                        <a href="#" class="">Correspondencia enviada</a>
                    </li>
                    <li>
                        <a href="#" class="active">Radicar correspondencia.</a>
                    </li>
                </ul>
                <div id="DivAlertas"></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">

                            <input name="accion" type="hidden" id="accion" value="Nuevo">
                            <input name="PropiePrincipla" type="hidden" id="PropiePrincipla" value="<?php echo $PropiePrincipla; ?>">
                            <input name="id_depen" type="hidden" id="id_depen">
                            <input name="id_oficina" type="hidden" id="id_oficina">
                            <input name="incluir_trd" type="hidden" id="incluir_trd" value="<?php echo $ConfiguracionOtras->get_Incluir_TRD(); ?>">
                            <input name="incluir_oficina_trd" id="incluir_oficina_trd" type="hidden" value="<?php echo $ConfiguracionOtras->get_Incluir_Oficina_TRD(); ?>">

                            <div class="col-md-8">
                                <div class="grid simple">
                                    <div class="grid-title no-border">
                                        <h4><i class="fa fa-list text-info"></i><span class="semi-bold text-info">Datos del radicado</span></h4>
                                    </div>
                                    <div class="grid-body no-border">
                                        <div class="row-fluid" style="display:none;" id="DivOtrosElementos">
                                            <div class="slide-success">
                                                <input type="checkbox" name="switch" class="iosblue" checked="checked" />
                                            </div>
                                            <div class="slide-primary">
                                                <input type="checkbox" name="switch" class="ios" checked="checked" placeholder="Requiere respuesta" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <div class="input-append success date slide-success slide-primary">
                                                    <input name="switch" type="text" class="form-control iosblue ios" id="fec_docu" placeholder="Fecha De Doc.">
                                                    <span class="add-on">
                                                        <span class="arrow"></span>
                                                        <i class="fa fa-th"></i>
                                                    </span>
                                                </div>
                                            </div>

                                            <!--
                                            <div class="form-group col-md-7">
                                                <select id="multi" style="width:100%" multiple>

                                                </select>
                                            </div>-->

                                            <div class="form-group col-md-2">
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModalRadicadosRecibidosParaRespuesta" id="BtnBuscarRadicadosRecibidosParaRespuesta">
                                                    <i class="fa fa-search"></i> Asociar radicados para dar respuesta
                                                </button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-2">
                                                <input name="num_folio" type="number" class="form-control" id="num_folio" placeholder="# De Folios">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <input name="num_anexos" type="number" class="form-control" id="num_anexos" placeholder="# De Anexos">
                                            </div>
                                            <div class="form-group col-md-8">
                                                <input name="observa_anexo" type="text" class="form-control" id="observa_anexo" placeholder="Ingrese aquí las observaciones de los anexos">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <textarea name="asunto" rows="2" class="form-control" id="asunto" placeholder="Ingrese aquí el asunto del documento..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="grid simple">
                                    <ul class="nav nav-tabs" id="tab-01">
                                        <li class="active">
                                            <a href="#tabQuienFirma">
                                                <i class="fa fa-users text-info"></i>
                                                <span class="semi-bold text-info">Quien Firma</span>
                                                <div class="pull-right">
                                                    <button type="button" class="btn btn-success btn-mini" data-toggle="modal" data-target="#myModalQuienFirma" id="BtnBuscarQuienFirma">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#tab1hellowWorld">
                                                <i class="fa fa-users text-info"></i>
                                                <span class="semi-bold text-info">Responsables</span>
                                                <div class="pull-right">
                                                    <button type="button" class="btn btn-success btn-mini" data-toggle="modal" data-target="#myModalResponsables" id="BtnBuscarResponsables">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#tab1FollowUs">
                                                <i class="fa fa-users text-info"></i>
                                                <span class="semi-bold text-info">Proyectores</span>
                                                <div class="pull-right">
                                                    <button type="button" class="btn btn-success btn-mini" data-toggle="modal" data-target="#myModalProyectores" id="BtnBuscarProyectores">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" style="height: 250px; overflow-y: scroll;">
                                        <div class="tab-pane active" id="tabQuienFirma">
                                            <div class="col-md-12">
                                                <div class="grid-body no-border">
                                                    <table width="100%" class="table table-striped table-flip-scroll cf" id="TblQuienFirma">
                                                        <thead class="cf">
                                                            <tr>
                                                                <th width="57%">Funcionario</th>
                                                                <th width="40%">Oficina</th>
                                                                <th width="5%"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab1hellowWorld">
                                            <div class="col-md-12">
                                                <div class="grid-body no-border">
                                                    <table width="100%" class="table table-striped table-flip-scroll cf" id="TblResponsales">
                                                        <thead class="cf">
                                                            <tr>
                                                                <th width="57%">Funcionario</th>
                                                                <th width="40%">Oficina</th>
                                                                <th width="5%"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab1FollowUs">
                                            <div class="col-md-12">
                                                <div class="grid-body no-border">
                                                    <table width="100%" class="table table-striped table-flip-scroll cf" id="TblProyectores">
                                                        <thead class="cf">
                                                            <tr>
                                                                <th width="57%">Funcionario</th>
                                                                <th width="40%">Oficina</th>
                                                                <th width="5%"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="grid simple">
                                    <div class="grid-title no-border">
                                        <h4>
                                            <i class="fa fa-male text-info"></i>
                                            <span class="semi-bold text-info">Destinatario</span>
                                        </h4>
                                    </div>
                                    <div class="grid-body no-border" style="min-height: 290px;">
                                        <div class="row">
                                            <div class="form-group col-md-3">
                                                <input name="id_destina" id="id_destina" type="hidden">
                                                <input name="cc_nit" type="text" class="form-control" id="cc_nit" placeholder="C.c / NIt">
                                            </div>
                                            <div class="form-group col-md-7">
                                                <input name="tercero_nom" type="text" class="form-control" id="tercero_nom" placeholder="Contacto">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <div class="btn-group">
                                                    <button class="btn btn-success btn-demo-space btn-sm"><i class="fa fa-ellipsis-v"></i></button>
                                                    <button class="btn btn-success dropdown-toggle btn-demo-space btn-sm" data-toggle="dropdown">
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="#" data-toggle="modal" data-target="#myModalDestinatarioNatural" id="BtnBuscarDestinatarioNatural">Buscar destinatario natural</a>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li>
                                                            <a href="#" data-toggle="modal" data-target="#myModalNuevoTerceroNatural" id="BtnNuevoTerceroNatural">Nuevo tercero natural</a>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li>
                                                            <a href="#" data-toggle="modal" data-target="#myModalNuevoTerceroJuridico" id="BtnNuevoTerceroJuridico">Nuevo tercero juridico</a>
                                                        </li>
                                                        <li>
                                                            <a href="#" data-toggle="modal" data-target="#myModalNuevoTerceroJuridicoConEmpresa" id="BtnNuevoTerceroJuridicoConEmpresa">Nuevo tercero juridico con empresa nueva</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="DivOcultarRemiteRazoSoci">
                                            <div class="form-group col-md-12">
                                                <input name="tercero_razo_soci" type="text" class="form-control" id="tercero_razo_soci" placeholder="Razón Social">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <input name="tercero_dir" type="text" class="form-control" id="tercero_dir" placeholder="Dirección">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-3">
                                                <input name="tercero_tel" type="text" class="form-control" id="tercero_tel" placeholder="Teléfono">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <input name="tercero_cel" type="text" class="form-control" id="tercero_cel" placeholder="Móvil / Pbx">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <input name="tercero_email" type="text" class="form-control" id="tercero_email" placeholder="Email">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="grid simple">
                                    <div class="grid-title no-border">
                                        <h4><i class="fa fa-truck text-info"></i><span class="semi-bold text-info">Tipo de Salida</span></h4>
                                    </div>
                                    <div class="grid-body no-border">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <div class="controls">
                                                    <select name="id_forma_salida" id="id_forma_salida" style="width:100%">
                                                        <option value="0">...::: Como despacha la correspondencia :::...</option>
                                                        <?php echo $Combo_FormaLlegada; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <input name="num_guia" type="text" class="form-control" id="num_guia" placeholder="# De Guía">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <div class="controls">
                                                    <select name="id_tipo_respue" id="id_tipo_respue" style="width:100%">
                                                        <option value="0">...::: Tipo de respuesta :::...</option>
                                                        <?php echo $Combo_TiposRespuestas; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                if ($ConfiguracionOtras->get_Incluir_TRD() == 1) {
                                ?>
                                    <div class="grid simple">
                                        <div class="grid-title no-border">
                                            <h4><i class="fa fa-folder text-info"></i><span class="semi-bold text-info">Clasificación Documental</span></h4>
                                        </div>
                                        <div class="grid-body no-border">
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <div class="controls">
                                                        <select name="id_serie" id="id_serie" style="width:100%">
                                                            <option value="0">...::: Serie :::...</option>
                                                            <?php echo $Combo_Series; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <div class="controls">
                                                        <select name="id_subserie" id="id_subserie" style="width:100%">
                                                            <option value="NULL">...::: SubSerie :::...</option>
                                                            <?php echo $Combo_Sub_Serie; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <div class="controls">
                                                        <select name="id_tipodoc" id="id_tipodoc" style="width:100%">
                                                            <option value="NULL">...::: Tipo Documental :::...</option>
                                                            <?php echo $Combo_Tipo_Documento; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="grid simple">
                                        <div class="grid-title no-border">
                                            <h4><i class="fa fa-file text-info"></i><span class="semi-bold text-info">Tipo Documental</span></h4>
                                        </div>
                                        <div class="grid-body no-border">
                                            <div class="row">
                                                <select name="id_tipodoc" id="id_tipodoc" class="select2 form-control input-sm">
                                                    <option value="0">...::: Elije el Documento :::...</option>
                                                    <?php echo $Combo_TipoDocumentos; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                                <div class="grid simple" style="min-height: 450px;">
                                    <div class="grid-title no-border">
                                        <h4>
                                            <i class="fa fa-folder text-info"></i>
                                            <span class="semi-bold text-info">Otros Datos</span>
                                        </h4>
                                    </div>
                                    <div class="grid-body no-border">
                                        <div class="row">
                                            <div class="form-group input-sm col-md-12">
                                                <input name="opcion_relacion" type="text" class="form-control" id="opcion_relacion" placeholder="Relación">
                                            </div>
                                            <div class="form-group input-sm col-md-12">
                                                <input name="opcion_titulo" type="text" class="form-control" id="opcion_titulo" placeholder="Titulo">
                                            </div>
                                            <div class="form-group input-sm col-md-12">
                                                <input name="opcion_sub_titulo" type="text" class="form-control" id="opcion_sub_titulo" placeholder="Sub Titulo">
                                            </div>
                                            <div class="form-group input-sm col-md-12">
                                                <input name="opcion_detalle1" type="text" class="form-control" id="opcion_detalle1" placeholder="Detalle 1">
                                            </div>
                                            <div class="form-group input-sm col-md-12">
                                                <input name="opcion_detalle2" type="text" class="form-control" id="opcion_detalle2" placeholder="Detalle 2">
                                            </div>
                                            <div class="form-group input-sm col-md-12">
                                                <input name="opcion_detalle3" type="text" class="form-control" id="opcion_detalle3" placeholder="Detalle 3">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="admin-bar" id="quick-access" style="display:">
                <div class="admin-bar-inner">
                    <div class="form-horizontal">
                    </div>
                    <button class="btn btn-default btn-cons" type="button" id="BtnCancelar"><i class="fa fa-times-circle"></i> Cancelar</button>
                    <button class="btn btn-primary btn-cons" type="button" id="BtnRadicar"><span class="semi-bold"><i class="fa fa-share"></i> Radicar</span></button>
                </div>
            </div>
            <div class="clearfix">
            </div>
        </div>
        <div class="clearfix">
        </div>

        <!-- BEGIN MODAL PARA LOS FUNCIONARIOS QUE FIRMA-->
        <div class="modal fade" id="myModalQuienFirma" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <br>
                        <i class="fa fa-users fa-2x"></i>
                        <h4 id="myModalLabel" class="semi-bold">Funcionarios disponibles para Firmar.</h4>
                        <p class="no-margin">Elige los funcionarios que firman la correspondencia</p>
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
                                                        <div class="checkbox check-default" style="margin-right:auto;margin-left:auto;">
                                                            <input type="checkbox" value="1" id="checkbox0">
                                                            <label for="checkbox0"></label>
                                                        </div>
                                                    </th>
                                                    <th style="width:1%">J</th>
                                                    <th style="width:2%">F</th>
                                                    <th style="width:30%">Funcionario</th>
                                                    <th style="width:30%">Oficina</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($FuncionarioQueFirman as $Item) :
                                                ?>
                                                    <tr>
                                                        <td class="v-align-middle">
                                                            <div class="checkbox check-default">
                                                                <input type="checkbox" value="<?php echo $Item['id_funcio_deta']; ?>" name="ChkQuienFirma[]" id="ChkQuienFirma<?php echo $Item['id_funcio_deta']; ?>" data-nombre_quien_firma="<?php echo $Item['nom_funcio'] . " " . $Item['ape_funcio']; ?>" data-id_oficina_quien_firma="<?php echo $Item['id_oficina']; ?>" data-oficina_quien_firma="<?php echo $Item['nom_oficina']; ?>" data-id_dependencia_quien_firma="<?php echo $Item['id_depen']; ?>">
                                                                <label for="ChkQuienFirma<?php echo $Item['id_funcio_deta']; ?>"></label>
                                                            </div>
                                                        </td>
                                                        <td class="v-align-middle">
                                                            <?php
                                                            if ($Item['jefe_dependencia'] == 1) {
                                                            ?>
                                                                <span class="text-info">
                                                                    <strong><i class="fa fa-check text-success"></i></strong>
                                                                </span>
                                                            <?php
                                                            }
                                                            ?>
                                                        </td>
                                                        <td class="v-align-middle">
                                                            <?php
                                                            if ($Item['puede_firmar'] == 1) {
                                                            ?>
                                                                <span class="text-info">
                                                                    <strong><i class="fa fa-check text-success"></i></strong>
                                                                </span>
                                                            <?php
                                                            }
                                                            ?>
                                                        </td>
                                                        <td class="v-align-middle">
                                                            <span class="muted">
                                                                <?php
                                                                echo $Item['nom_funcio'] . " " . $Item['ape_funcio'];
                                                                ?>
                                                            </span>
                                                        </td>
                                                        <td class="v-align-middle">
                                                            <?php echo $Item['nom_depen'] . " - " . $Item['nom_oficina']; ?>
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
                        <button type="button" class="btn btn-success" data-dismiss="modal" id="BtnLlevarQuienFirma">Llevar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MODAL PARA LOS FUNCIONARIOS QUE FIRMAN-->

        <!-- BEGIN MODAL PARA LOS RESPONSABLES-->
        <div class="modal fade" id="myModalResponsables" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <br>
                        <i class="fa fa-users fa-2x"></i>
                        <h4 id="myModalLabel" class="semi-bold">Funcionarios disponibles.</h4>
                        <p class="no-margin">Elige los funcionarios responsables de la correspondencia</p>
                        <br>
                    </div>
                    <div class="modal-body">
                        <div class="row-fluid">
                            <div class="span12">
                                <div class="grid simple ">
                                    <div class="grid-body ">
                                        <table class="table table-hover table-condensed" id="Tbl2">
                                            <thead>
                                                <tr>
                                                    <th style="width:1%">
                                                        <div class="checkbox check-default" style="margin-right:auto;margin-left:auto;">
                                                            <input type="checkbox" value="1" id="checkbox0">
                                                            <label for="checkbox0"></label>
                                                        </div>
                                                    </th>
                                                    <th style="width:1%">J</th>
                                                    <th style="width:2%">F</th>
                                                    <th style="width:30%">Funcionario</th>
                                                    <th style="width:30%">Oficina</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($Funcionario as $Item) :
                                                ?>
                                                    <tr>
                                                        <td class="v-align-middle">
                                                            <div class="checkbox check-default">
                                                                <input type="checkbox" value="<?php echo $Item['id_funcio_deta']; ?>" name="ChkResponsables[]" id="ChkResponsables<?php echo $Item['id_funcio_deta']; ?>" data-nombre_responsables="<?php echo $Item['nom_funcio'] . " " . $Item['ape_funcio']; ?>" data-id_oficina_responsables="<?php echo $Item['id_oficina']; ?>" data-oficina_responsables="<?php echo $Item['nom_oficina']; ?>" data-id_dependencia_responsables="<?php echo $Item['id_depen']; ?>">
                                                                <label for="ChkResponsables<?php echo $Item['id_funcio_deta']; ?>"></label>
                                                            </div>
                                                        </td>
                                                        <td class="v-align-middle">
                                                            <?php
                                                            if ($Item['jefe_dependencia'] == 1) {
                                                            ?>
                                                                <span class="text-info">
                                                                    <strong><i class="fa fa-check text-success"></i></strong>
                                                                </span>
                                                            <?php
                                                            }
                                                            ?>
                                                        </td>
                                                        <td class="v-align-middle">
                                                            <?php
                                                            if ($Item['puede_firmar'] == 1) {
                                                            ?>
                                                                <span class="text-info">
                                                                    <strong><i class="fa fa-check text-success"></i></strong>
                                                                </span>
                                                            <?php
                                                            }
                                                            ?>
                                                        </td>
                                                        <td class="v-align-middle">
                                                            <span class="muted">
                                                                <?php
                                                                echo $Item['nom_funcio'] . " " . $Item['ape_funcio'];
                                                                ?>
                                                            </span>
                                                        </td>
                                                        <td class="v-align-middle">
                                                            <?php echo $Item['nom_depen'] . " - " . $Item['nom_oficina']; ?>
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
                        <button type="button" class="btn btn-success" data-dismiss="modal" id="BtnLlevarResponsables">Llevar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MODAL PARA RESPONSABLES-->

        <!-- BEGIN MODAL PARA LOS PROYECTORES-->
        <div class="modal fade" id="myModalProyectores" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <br>
                        <i class="fa fa-users fa-2x"></i>
                        <h4 id="myModalLabel" class="semi-bold">Funcionarios disponibles.</h4>
                        <p class="no-margin">Elige los funcionarios proyector de la correspondencia</p>
                        <br>
                    </div>
                    <div class="modal-body">
                        <div class="row-fluid">
                            <div class="span12">
                                <div class="grid simple ">
                                    <div class="grid-body ">
                                        <table class="table table-hover table-condensed" id="Tbl3">
                                            <thead>
                                                <tr>
                                                    <th style="width:1%">
                                                        <div class="checkbox check-default" style="margin-right:auto;margin-left:auto;">
                                                            <input type="checkbox" value="1" id="checkbox0">
                                                            <label for="checkbox0"></label>
                                                        </div>
                                                    </th>
                                                    <th style="width:1%">J</th>
                                                    <th style="width:2%">F</th>
                                                    <th style="width:30%">Funcionario</th>
                                                    <th style="width:30%">Oficina</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($Funcionario as $Item) :
                                                ?>
                                                    <tr>
                                                        <td class="v-align-middle">
                                                            <div class="checkbox check-default">
                                                                <input type="checkbox" value="<?php echo $Item['id_funcio_deta']; ?>" name="ChkProyectores[]" id="ChkProyectores<?php echo $Item['id_funcio_deta']; ?>" data-nombre_proyector="<?php echo $Item['nom_funcio'] . " " . $Item['ape_funcio']; ?>" data-oficina_proyector="<?php echo $Item['nom_oficina']; ?>" data-dependencia_proyector="<?php echo $Item['id_depen']; ?>">
                                                                <label for="ChkProyectores<?php echo $Item['id_funcio_deta']; ?>"></label>
                                                            </div>
                                                        </td>
                                                        <td class="v-align-middle">
                                                            <?php
                                                            if ($Item['jefe_dependencia'] == 1) {
                                                            ?>
                                                                <span class="text-info">
                                                                    <strong><i class="fa fa-check text-success"></i></strong>
                                                                </span>
                                                            <?php
                                                            }
                                                            ?>
                                                        </td>
                                                        <td class="v-align-middle">
                                                            <?php
                                                            if ($Item['puede_firmar'] == 1) {
                                                            ?>
                                                                <span class="text-info">
                                                                    <strong><i class="fa fa-check text-success"></i></strong>
                                                                </span>
                                                            <?php
                                                            }
                                                            ?>
                                                        </td>
                                                        <td class="v-align-middle">
                                                            <span class="muted">
                                                                <?php
                                                                echo $Item['nom_funcio'] . " " . $Item['ape_funcio'];
                                                                ?>
                                                            </span>
                                                        </td>
                                                        <td class="v-align-middle">
                                                            <?php echo $Item['nom_depen'] . " - " . $Item['nom_oficina']; ?>
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
                        <button type="button" class="btn btn-success" data-dismiss="modal" id="BtnLlevarProyector">Llevar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MODAL PARA PROYECTORES-->

        <!-- BEGIN MODAL PARA LOS DETINATARIOS NATURALES-->
        <div class="modal fade" id="myModalDestinatarioNatural" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <br>
                        <i class="fa fa-users fa-2x"></i>
                        <h4 id="myModalLabel" class="semi-bold">Destinatario Natural.</h4>
                        <p class="no-margin">Elige el destinatario de la correspondencia</p>
                        <br>
                    </div>
                    <div class="modal-body">
                        <div class="row-fluid">
                            <div class="span12">
                                <div class="grid simple ">
                                    <div class="grid-body ">
                                        <div class="row form-row">
                                            <div id="DivAlertasDestinaNaturales"></div>
                                            <div class="col-md-12">
                                                <input name="TxtBusDestinaNaturales" type="text" class="form-control" id="TxtBusDestinaNaturales" placeholder="Ingrese aqui el criterio de búsqueda para el tercero natural.">
                                            </div>
                                        </div>
                                        <div class="row form-row">
                                            <div class="col-md-12">
                                                <div id="DivDestinatarioNaturales"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="BtnCancelarBusTercero">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MODAL PARA LOS DETINATARIOS NATURALES-->

        <!-- INICIO MODAL PARA NUEVO TERCERO NATURAL -->
        <div class="modal fade" id="myModalNuevoTerceroNatural" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <br>
                        <i class="fa fa-home fa-2x text-info"></i>
                        <h4 id="myModalLabel" class="semi-bold">Nuevo Remitente Natural</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row-fluid">
                            <div class="span12">

                                <div id="DivAlertaTerceroNatural"></div>

                                <div class="grid simple ">
                                    <div class="grid-body">
                                        <form role="form" name="FrmDatosEmpresa" id="FrmDatosTerceroNatural">

                                            <input name="accion" id="accion" type="hidden" value="NUEVO_TERCERO">

                                            <div class="row form-row">
                                                <div class="col-md-3">
                                                    <input name="num_docu_contac" type="text" class="form-control input-sm" id="num_docu_contac" placeholder="# De Documento">
                                                </div>
                                                <div class="col-md-9">
                                                    <input name="nom_contac" type="text" class="form-control input-sm" id="nom_contac" placeholder="Contacto">
                                                </div>
                                            </div>

                                            <div class="row form-row">
                                                <div class="col-md-6">
                                                    <select name="id_depar_contac" id="id_depar_contac" class="select2 form-control input-sm">
                                                        <option value="0">...::: Elije el Departamento :::...</option>
                                                        <?php echo $Combo_Departamentos; ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <select name="id_muni_contac" id="id_muni_contac" class="select2 form-control input-sm">
                                                        <option value="0">...::: Elije el Municipio :::...</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <input name="dir_contac" type="text" class="form-control input-sm" id="dir_contac" placeholder="Dirección">
                                                </div>
                                            </div>

                                            <div class="row form-row">
                                                <div class="col-md-6">
                                                    <input name="tel_contac" type="text" class="form-control input-sm" id="tel_contac" placeholder="Teléfono">
                                                </div>
                                                <div class="col-md-6">
                                                    <input name="cel_contac" type="text" class="form-control input-sm" id="cel_contac" placeholder="Celular">
                                                </div>
                                            </div>

                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <input name="email_contac" type="email" class="form-control input-sm" id="email_contac" placeholder="E - Mail">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="BtnCancelarTerceroNatural">Cancelar</button>
                        <button type="button" class="btn btn-success" id="BtnGuardarTerceroNatural" data-toggle="modal">
                            <i class="fa fa-save"></i> Guardar
                        </button>
                    </div>

                </div>
            </div>
        </div>
        <!-- FIN MODAL PARA NUEVO TERCERO NATURAL -->

        <!-- INICIO MODAL PARA NUEVO TERCERO JURIDICO -->
        <div class="modal fade" id="myModalNuevoTerceroJuridico" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <br>
                        <i class="fa fa-home fa-2x text-info"></i>
                        <h4 id="myModalLabel" class="semi-bold">Nuevo Remitente Juridico</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row-fluid">
                            <div class="span12">

                                <div id="DivAlertaTerceroJutidico"></div>

                                <div class="grid simple ">
                                    <div class="grid-body">
                                        <form role="form" name="FrmDatosTerceroJuridico" id="FrmDatosTerceroJuridico">

                                            <input name="accion" id="accion" type="hidden" value="NUEVO_TERCERO_JURIDICO">

                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <select id="multi" name="multi" style="width:100%">
                                                        <?php echo $Combo_Empresa; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row form-row">
                                                <div class="col-md-8">
                                                    <input name="nom_contac_juridico" type="text" class="form-control input-sm" id="nom_contac_juridico" placeholder="Contacto">
                                                </div>
                                                <div class="col-md-4">
                                                    <input name="cargo_juridico" type="text" class="form-control input-sm" id="cargo_juridico" placeholder="Cargo">
                                                </div>
                                                <div class="col-md-12">
                                                    <input name="dir_contac_juridico" type="text" class="form-control input-sm" id="dir_contac_juridico" placeholder="Dirección">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-4">
                                                    <input name="tel_contac_juridico" type="text" class="form-control input-sm" id="tel_contac_juridico" placeholder="Teléfono">
                                                </div>
                                                <div class="col-md-4">
                                                    <input name="cel_contac_juridico" type="text" class="form-control input-sm" id="cel_contac_juridico" placeholder="Celular">
                                                </div>
                                                <div class="col-md-4">
                                                    <input name="fax_contac_juridico" type="text" class="form-control input-sm" id="fax_contac_juridico" placeholder="Fax">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <input name="email_contac_juridico" type="email" class="form-control input-sm" id="email_contac_juridico" placeholder="E - Mail">
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="BtnCancelarTerceroJutidico">Cancelar</button>
                        <button type="button" class="btn btn-success" id="BtnGuardarTerceroJutidico">
                            <i class="fa fa-save"></i> Guardar
                        </button>
                    </div>

                </div>
            </div>
        </div>
        <!-- FIN MODAL PARA NUEVO TERCERO JURIDICO -->

        <!-- INICIO MODAL PARA NUEVO TERCERO JURIDICO CON EMPRESA NUEVA -->
        <div class="modal fade" id="myModalNuevoTerceroJuridicoConEmpresa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <br>
                        <i class="fa fa-credit-card fa-2x"></i>
                        <h4 id="myModalLabel" class="semi-bold">Nuevo Remiente Juridico</h4>
                    </div>
                    <div id="DivAlertaTerceroJutidicoConEmpresa"></div>
                    <form role="form" name="FrmDatosTerceroJuridicoConEmpresa" id="FrmDatosTerceroJuridicoConEmpresa">
                        <input type="hidden" name="accion_remite_juridico" id="accion_remite_juridico" value="NUEVO_TERCERO_JURIDICO_CON_EMPRESA">
                        <div class="modal-body">
                            <ul class="nav nav-tabs" id="tab-01">
                                <li class="active"><a href="#TabTerceroJuridicoConEmpresaEmpresa">Empresa del contacto</a></li>
                                <li><a href="#TabTerceroJuridicoConEmpresaContacto">Datos del contacto</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="TabTerceroJuridicoConEmpresaEmpresa">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row form-row">
                                                <div class="col-md-4">
                                                    <input name="nit" type="text" class="form-control input-sm" id="nit" placeholder="Nit">
                                                </div>
                                                <div class="col-md-8">
                                                    <input name="razo_soci" type="text" class="form-control input-sm" id="razo_soci" placeholder="Razón social">
                                                </div>
                                                <div class="col-md-12">
                                                    <input name="dir_juridico_empresa" type="text" class="form-control input-sm" id="dir_juridico_empresa" placeholder="Dirección">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-6">
                                                    <select name="id_depar_juridico_empresa" id="id_depar_juridico_empresa" class="select2 form-control input-sm">
                                                        <option value="0">...::: Elije el Departamento :::...</option>
                                                        <?php echo $Combo_Departamentos; ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <select name="id_muni_juridico_empresa" id="id_muni_juridico_empresa" class="select2 form-control input-sm">
                                                        <option value="0">...::: Elije el Municipio :::...</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row form-row">
                                                <div class="col-md-4">
                                                    <input name="tel_juridico_empresa" type="text" class="form-control input-sm" id="tel_juridico_empresa" placeholder="Teléfono">
                                                </div>
                                                <div class="col-md-4">
                                                    <input name="cel_juridico_empresa" type="text" class="form-control input-sm" id="cel_juridico_empresa" placeholder="Celular">
                                                </div>
                                                <div class="col-md-4">
                                                    <input name="fax_juridico_empresa" type="text" class="form-control input-sm" id="fax_juridico_empresa" placeholder="Fax">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <input name="email_juridico_empresa" type="email" class="form-control input-sm" id="email_juridico_empresa" placeholder="E - Mail">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <input name="web_juridico" type="email" class="form-control input-sm" id="web_juridico" placeholder="Web">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="TabTerceroJuridicoConEmpresaContacto">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row form-row">
                                                <div class="col-md-8">
                                                    <input name="nom_contac_juridico_empresa" type="text" class="form-control input-sm" id="nom_contac_juridico_empresa" placeholder="Contacto">
                                                </div>
                                                <div class="col-md-4">
                                                    <input name="cargo_juridico_empresa" type="text" class="form-control input-sm" id="cargo_juridico_empresa" placeholder="Cargo">
                                                </div>
                                                <div class="col-md-12">
                                                    <input name="dir_contac_juridico_empresa" type="text" class="form-control input-sm" id="dir_contac_juridico_empresa" placeholder="Dirección">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-6">
                                                    <input name="tel_contac_juridico_empresa" type="text" class="form-control input-sm" id="tel_contac_juridico_empresa" placeholder="Teléfono">
                                                </div>
                                                <div class="col-md-6">
                                                    <input name="cel_contac_juridico_empresa" type="text" class="form-control input-sm" id="cel_contac_juridico_empresa" placeholder="Celular">
                                                </div>
                                            </div>
                                            <div class="row form-row">
                                                <div class="col-md-12">
                                                    <input name="email_contac_juridico_empresa" type="email" class="form-control input-sm" id="email_contac_juridico_empresa" placeholder="E - Mail">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="BtnCancelarTerceroJutidicoConEmpresa">Cancelar</button>
                        <button type="button" class="btn btn-success" id="BtnGuardarTerceroJutidicoConEmpresa">
                            <i class="fa fa-save"></i> Guardar
                        </button>
                    </div>

                </div>
            </div>
        </div>
        <!-- FIN MODAL PARA NUEVO TERCERO JURIDICO CON EMPRESA NUEVA-->

        <!-- BEGIN MODAL PARA LOS RADICADOS QUE REQUIEREN RESPUESTAS-->
        <div class="modal fade" id="myModalRadicadosRecibidosParaRespuesta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width: 80%">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <br>
                        <i class="fa fa-users fa-2x"></i>
                        <h4 id="myModalLabel" class="semi-bold">Radicado para dar respuesta.</h4>
                        <p class="no-margin">Elige el radicado al caul se va a dar respuesta</p>
                        <br>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="grid simple ">
                                    <div class="grid-body ">
                                        <div class="row form-row">
                                            <div id="DivAlertasRadicadosRecibidosParaRespuesta"></div>
                                            <div class="col-md-12">
                                                <input name="TxtBusRadicadosRecibidosParaRespuesta" type="text" class="form-control" id="TxtBusRadicadosRecibidosParaRespuesta" placeholder="Ingrese aqui el criterio de búsqueda para el radicado que requieres la respuesta.">
                                            </div>
                                        </div>
                                        <div class="row form-row">
                                            <div class="col-md-12">
                                                <div id="DivRadicadosRecibidosParaRespuesta"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="grid simple ">
                                    <div class="grid-body ">
                                        <table class="table table-hover table-condensed" id="TblRadicadosParaResponder">
                                            <thead>
                                                <tr>
                                                    <th style="width:30%">Funcionario</th>
                                                    <th style="width:30%">Oficina</th>
                                                    <th style="width:1%"></th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MODAL PARA LOS RADICADOS QUE REQUIEREN RESPUESTAS-->

        <?php
        include '../../../varios/ayudas.php';
        ?>
        <script src="../../../../public/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
        <script src="funcionesVentanillaEnviadas.ajax.js"></script>
        <script src="../../../../public/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
        <script src="../../../../public/assets/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../../../../public/assets/plugins/breakpoints.js" type="text/javascript"></script>
        <script src="../../../../public/assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
        <!-- END CORE JS FRAMEWORK -->
        <!-- BEGIN PAGE LEVEL JS -->
        <script src="../../../../public/assets/plugins/pace/pace.min.js" type="text/javascript"></script>
        <script src="../../../../public/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
        <script src="../../../../public/assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
        <script src="../../../../public/assets/sweetalert2/sweetalert-dev.js"></script>
        <link rel="stylesheet" type="text/css" href="../../../../public/assets/sweetalert2/sweetalert.css">
        <script src="../../../../public/assets/js/tabs_accordian.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->

        <!-- BEGIN CORE TEMPLATE JS -->
        <script src="../../../../public/assets/js/core.js" type="text/javascript"></script>
        <script src="../../../../public/assets/js/chat.js" type="text/javascript"></script>
        <script src="../../../../public/assets/js/demo.js" type="text/javascript"></script>
        <!-- END CORE TEMPLATE JS -->
        <script>
            $(document).ready(function() {
                $("#quick-access").css("bottom", "0px");
            });
        </script>
        <!-- END JAVASCRIPTS -->

        <script src="../../../../public/assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script>
        <script src="../../../../public/assets/plugins/bootstrap-select2/select2.min.js" type="text/javascript"></script>
        <script src="../../../../public/assets/plugins/jquery-datatable/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="../../../../public/assets/plugins/jquery-datatable/extra/js/dataTables.tableTools.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="../../../../public/assets/plugins/datatables-responsive/js/datatables.responsive.js"></script>
        <script type="text/javascript" src="../../../../public/assets/plugins/datatables-responsive/js/lodash.min.js"></script>
        <script src="../../../../public/assets/js/datatables.js" type="text/javascript"></script>
        <script src="../../../../public/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
        <script src="../../../../public/assets/plugins/ios-switch/ios7-switch.js" type="text/javascript"></script>
        <script src="../../../../public/assets/js/form_elements.js" type="text/javascript"></script>
        <script src="../../../../public/assets/sweetalert2/sweetalert-dev.js"></script>
</body>

</html>