<?php
session_start();
include "../../../../config/class.Conexion.php";
include "../../../../config/variable.php";
include "../../../../config/funciones.php";
include "../../../../config/funciones_seguridad.php";
require_once '../../../clases/retencion/calss.TRD.php';
require_once '../../../clases/configuracion/class.ConfigFormaEnvio.php';
require_once "../../../clases/configuracion/class.ConfigDepartamento.php";
require_once "../../../clases/configuracion/class.ConfigOtras.php";
require_once '../../../clases/general/class.GeneralFuncionario.php';
require_once '../../../clases/seguridad/class.SeguridadPermiso.php';

$Funcionario = Funcionario::Listar(6, 0, "", "", "", 0, 0, 0);
$FormaLlegada = FormaEnvio::Listar(1, 0);

//CARGO LOS COMBOS DE LA LA FORMA DE LLGADA DE LA CORRESPONDENCIA
$Combo_FormaLlegada = "";
foreach ($FormaLlegada as $Item) :
    $Combo_FormaLlegada .= "<option value='" . $Item['id_formaenvio'] . "'>" . $Item['nom_formaenvi'] . "</option>";
endforeach;

$Departamento = Departamento::Listar();
$Combo_Departamentos = "";
foreach ($Departamento as $Item) :
    $Combo_Departamentos .= "<option value='" . $Item['id_depar'] . "'>" . $Item['nom_depar'] . "</option>";
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
                <div id="inner-menu">
                    <div class="inner-wrapper">
                        <a href="radicar.php" class="btn btn-block btn-primary">
                            <span class="bold">RADICAR</span>
                        </a>
                    </div>
                    <div class="inner-menu-content">
                        <p class="menu-title">VISTA RAPIDA <span class="pull-right"><i class="icon-refresh"></i></span></p>
                    </div>
                    <ul class="small-items">
                        <li class="active">
                            <a href="../../recibida/recibidas/index.php"> Ir a la correspondencia recibida</a>
                        </li>
                        <li class="active">
                            <a href="../../enviada/enviadas/index.php"> Ir a la correspondencia enviada</a>
                        </li>
                        <li class="active">
                            <a href="../../interna/interna/index.php"> Ir a la correspondencia interna</a>
                        </li>
                    </ul>
                    <ul class="big-items">
                        <li class="">
                            <a href="../../../mi_archivo/bandeja/externa/pendientes_tramite/index.php">
                                <span class="btn btn-success btn-sm btn-small label label-important">
                                    <i class="fa fa-bullhorn"></i> Mis Pendientes
                                </span>
                            </a>
                        </li>
                        <li class="">
                            <a href="../../../mi_archivo/bandeja/externa/alertas/index.php">
                                <span class="btn btn-danger btn-sm btn-small label label-important">
                                    <i class="fa fa-bell-o"></i> Alertas
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
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
                        <a href="#" class="active">Radicar - Correspondencia interna.</a>
                    </li>
                </ul>
                <div id="DivAlertas"></div>
                <form name="Frm-Data" enctype="multipart/form-data" id="Frm-Data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">

                                <input name="accion" id="accion" type="hidden" value="RADICAR_COMUNCACION">
                                <input name="id_depen" type="hidden" id="id_depen">
                                <input name="id_oficina" type="hidden" id="id_oficina">
                                <input name="id_responsable" type="hidden" id="id_responsable">
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
                                                <div class="form-group col-md-2">
                                                    <div class="input-append success date slide-success slide-primary">
                                                        <input name="switch" type="text" class="form-control iosblue ios" id="fec_docu" placeholder="Fecha De Doc.">
                                                        <span class="add-on">
                                                            <span class="arrow"></span>
                                                            <i class="fa fa-th"></i>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <div class="checkbox checkbox check-success ">
                                                        <input name="requie_respues" type="checkbox" id="chkTerms" value="1">
                                                        <label for="chkTerms">Requiere respuesta.</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <div class="input-append success date">
                                                        <input name="fec_venci" type="text" class="form-control" id="fec_venci" placeholder="Fecha Vencimiento.">
                                                        <span class="add-on">
                                                            <span class="arrow"></span>
                                                            <i class="fa fa-th"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-1">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModalRadicadosInternosParaRespuesta" id="BtnBuscarRadicadosInternosParaRespuesta">
                                                        <i class="fa fa-search"></i> Asociar radicados para dar respuesta
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-2">
                                                    <input name="num_folio" type="text" class="form-control" id="num_folio" placeholder="# De Folios">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <input name="num_anexos" type="text" class="form-control" id="num_anexos" placeholder="# De Anexos">
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
                                                <a href="#tabResponsables">
                                                    <i class="fa fa-users text-info"></i>
                                                    <span class="semi-bold text-info" style="margin-right:20px;">Dirigido a:</span>
                                                    <div class="pull-right">
                                                        <button type="button" class="btn btn-success btn-mini" data-toggle="modal" data-target="#myModalDestinatarios" id="BtnBuscarDestinatarios">
                                                            <i class="fa fa-search"></i>
                                                        </button>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#tabDestinatarios">
                                                    <i class="fa fa-users text-info"></i>
                                                    <span class="semi-bold text-info" style="margin-right:20px;">Enviado por:</span>
                                                    <div class="pull-right">
                                                        <button type="button" class="btn btn-success btn-mini" data-toggle="modal" data-target="#myModalResponsables" id="BtnBuscarResponsables">
                                                            <i class="fa fa-search"></i>
                                                        </button>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#tabProyectores">
                                                    <i class="fa fa-users text-info"></i>
                                                    <span class="semi-bold text-info" style="margin-right:20px;">Proyectores</span>
                                                    <div class="pull-right">
                                                        <button type="button" class="btn btn-success btn-mini" data-toggle="modal" data-target="#myModalProyectores" id="BtnBuscarProyectores">
                                                            <i class="fa fa-search"></i>
                                                        </button>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#tabConCopia">
                                                    <i class="fa fa-users text-info"></i>
                                                    <span class="semi-bold text-info" style="margin-right:20px;">Con Copia</span>
                                                    <div class="pull-right">
                                                        <button type="button" class="btn btn-success btn-mini" data-toggle="modal" data-target="#myModalConCopia" id="BtnBuscarConCopia">
                                                            <i class="fa fa-search"></i>
                                                        </button>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" style="height: 250px; overflow-y: scroll;">
                                            <div class="tab-pane active" id="tabResponsables">
                                                <div class="col-md-12">
                                                    <div class="grid-body no-border">
                                                        <table width="100%" class="table table-striped table-flip-scroll cf" id="TblDestinatarios">
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
                                            <div class="tab-pane" id="tabDestinatarios">
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
                                            <div class="tab-pane" id="tabProyectores">
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
                                            <div class="tab-pane" id="tabConCopia">
                                                <div class="col-md-12">
                                                    <div class="grid-body no-border">
                                                        <table width="100%" class="table table-striped table-flip-scroll cf" id="TblConCopia">
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
                                </div>
                                <div class="col-md-4">
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
                                </div>
                            </div>
                        </div>
                    </div>

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

                    <!-- BEGIN MODAL PARA LOS DESTINATARIOS-->
                    <div class="modal fade" id="myModalDestinatarios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <br>
                                    <i class="fa fa-users fa-2x"></i>
                                    <h4 id="myModalLabel" class="semi-bold">Funcionarios destinatarios.</h4>
                                    <p class="no-margin">Elige los funcionarios a los cuales les vas a enviar la correspondencia</p>
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
                                                                            <input type="checkbox" value="<?php echo $Item['id_funcio_deta']; ?>" name="ChkDestinatarios[]" id="ChkDestinatarios<?php echo $Item['id_funcio_deta']; ?>" data-nombre_destinatario="<?php echo $Item['nom_funcio'] . " " . $Item['ape_funcio']; ?>" data-oficina_destinatario="<?php echo $Item['nom_oficina']; ?>" data-dependencia_destinatario="<?php echo $Item['id_depen']; ?>">
                                                                            <label for="ChkDestinatarios<?php echo $Item['id_funcio_deta']; ?>"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td class="v-align-middle">
                                                                        <?php
                                                                        if ($Item['jefe_dependencia'] == 1) {
                                                                        ?>
                                                                            <span class="text-info">
                                                                                <strong>
                                                                                    <i class="fa fa-check text-success"></i>
                                                                                </strong>
                                                                            </span>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td class="v-align-middle">
                                                                        <?php
                                                                        if ($Item['puede_firmar'] == 1) {
                                                                        ?>
                                                                            <span class="text-info"><strong><i class="fa fa-check text-success"></i></strong></span>
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
                                                                    <td class="v-align-middle"><?php echo $Item['nom_depen'] . " - " . $Item['nom_oficina']; ?></td>
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

                    <!-- BEGIN MODAL PARA LOS PROYECTORES-->
                    <div class="modal fade" id="myModalProyectores" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <br>
                                    <i class="fa fa-users fa-2x"></i>
                                    <h4 id="myModalLabel" class="semi-bold">Funcionarios proyectores.</h4>
                                    <p class="no-margin">Elige los funcionarios proyectores de la correspondencia</p>
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
                                                                                <strong>
                                                                                    <i class="fa fa-check text-success"></i>
                                                                                </strong>
                                                                            </span>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td class="v-align-middle">
                                                                        <?php
                                                                        if ($Item['puede_firmar'] == 1) {
                                                                        ?>
                                                                            <span class="text-info"><strong><i class="fa fa-check text-success"></i></strong></span>
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
                                                                    <td class="v-align-middle"><?php echo $Item['nom_depen'] . " - " . $Item['nom_oficina']; ?></td>
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
                                    <button type="button" class="btn btn-success" data-dismiss="modal" id="BtnLlevarProyectores">Llevar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END MODAL PARA PROYECTORES-->

                    <!-- BEGIN MODAL PARA LOS CON_COPIA-->
                    <div class="modal fade" id="myModalConCopia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <br>
                                    <i class="fa fa-users fa-2x"></i>
                                    <h4 id="myModalLabel" class="semi-bold">Funcionarios con copia.</h4>
                                    <p class="no-margin">Elige los funcionarios a los cuales les vas a enviar copia la correspondencia</p>
                                    <br>
                                </div>
                                <div class="modal-body">
                                    <div class="row-fluid">
                                        <div class="span12">
                                            <div class="grid simple ">
                                                <div class="grid-body ">
                                                    <table class="table table-hover table-condensed" id="Tbl4">
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
                                                                            <input type="checkbox" value="<?php echo $Item['id_funcio_deta']; ?>" name="ChkConCopia[]" id="ChkConCopia<?php echo $Item['id_funcio_deta']; ?>" data-nombre_destinatario="<?php echo $Item['nom_funcio'] . " " . $Item['ape_funcio']; ?>" data-oficina_destinatario="<?php echo $Item['nom_oficina']; ?>" data-dependencia_destinatario="<?php echo $Item['id_depen']; ?>">
                                                                            <label for="ChkConCopia<?php echo $Item['id_funcio_deta']; ?>"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td class="v-align-middle">
                                                                        <?php
                                                                        if ($Item['jefe_dependencia'] == 1) {
                                                                        ?>
                                                                            <span class="text-info">
                                                                                <strong>
                                                                                    <i class="fa fa-check text-success"></i>
                                                                                </strong>
                                                                            </span>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td class="v-align-middle">
                                                                        <?php
                                                                        if ($Item['puede_firmar'] == 1) {
                                                                        ?>
                                                                            <span class="text-info"><strong><i class="fa fa-check text-success"></i></strong></span>
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
                                                                    <td class="v-align-middle"><?php echo $Item['nom_depen'] . " - " . $Item['nom_oficina']; ?></td>
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
                                    <button type="button" class="btn btn-success" data-dismiss="modal" id="BtnLlevarConCopia">Llevar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END MODAL PARA CON_COPIA-->
                </form>
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

        <?php
        include '../../../varios/ayudas.php';
        ?>

        <!-- BEGIN MODAL PARA LOS RADICADOS QUE REQUIEREN RESPUESTAS-->
        <div class="modal fade" id="myModalRadicadosInternosParaRespuesta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                            <div id="DivAlertasRadicadosInternosParaRespuesta"></div>
                                            <div class="col-md-12">
                                                <input name="TxtBusRadicadosInternosParaRespuesta" type="text" class="form-control" id="TxtBusRadicadosInternosParaRespuesta" placeholder="Ingrese aqui el criterio de búsqueda para el radicado que requieres la respuesta.">
                                            </div>
                                        </div>
                                        <div class="row form-row">
                                            <div class="col-md-12">
                                                <div id="DivRadicadosInternosParaRespuesta"></div>
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

        <script src="../../../../public/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
        <script src="funcionesVentanillInterna.ajax.js"></script>
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

        <!-- END PAGE LEVEL PLUGINS -->
        <script src="../../../../public/assets/js/tabs_accordian.js" type="text/javascript"></script>
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