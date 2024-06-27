<?php
session_start();
include "../../../../config/class.Conexion.php";
include "../../../../config/variable.php";
include "../../../../config/funciones.php";
include "../../../../config/funciones_seguridad.php";
require_once '../../../clases/retencion/calss.TRD.php';
require_once '../../../clases/general/class.GeneralFuncionario.php';
require_once '../../../clases/general/class.GeneralTercero.php';
require_once '../../../clases/general/class.GeneralTerceroEmpresa.php';
require_once '../../../clases/configuracion/class.ConfigFormaEnvio.php';
require_once "../../../clases/configuracion/class.ConfigDepartamento.php";
require_once '../../../clases/radicar/class.RadicaEnviadoTemp.php';
require_once '../../../clases/radicar/class.RadicaEnviadoTempQuienFirma.php';
require_once '../../../clases/radicar/class.RadicaEnviadoTempResponsables.php';
require_once '../../../clases/radicar/class.RadicaEnviadoTempProyectores.php';
require_once '../../../clases/radicar/class.RadicaEnviadoTempRespuestas.php';
require_once "../../../clases/configuracion/class.ConfigOtras.php";
require_once "../../../clases/configuracion/class.ConfigTipoRespuesta.php";
require_once '../../../clases/seguridad/class.SeguridadPermiso.php';

$RadicaTemp  = RadicadoEnviadoTemp::Buscar(1, $_GET['IdTemp'], "", "", "", "", "", "");
$Responsable = RadicadoEnviadoTempResponsable::Listar(3, $_GET['IdTemp'], "");

$DepenResponsable = "";
foreach ($Responsable as $ItemRespon) {
    $DepenResponsable = $ItemRespon['id_depen'];
}

$Tercero          = Tercero::Listar(2, $RadicaTemp->get_IdDestinatario(), "", "", "", "", "");

$FuncionarioResponsables = Funcionario::Listar(6, 0, "", "", "", 0, 0, 0);
$FuncionarioQueFirman    = Funcionario::Listar(12, 0, "", "", "", 0, 0, 0);
$FuncionarioProyectores  = Funcionario::Listar(6, 0, "", "", "", 0, 0, 0);

$ConfiguracionOtras = ConfigOtras::Buscar();
if ($ConfiguracionOtras->get_Incluir_TRD() == 1) {

    //CARGO LAS SERIE
    $TRD = TRD::Listar(6, 0, $DepenResponsable, 0, 0, "");
    $Combo_Series = "";
    foreach ($TRD as $Item) :
        if ($Item['id_serie'] == $RadicaTemp->get_IdSerie()) {
            $Combo_Series .= "<option value='" . $Item['id_serie'] . "' selected>" . html_entity_decode($Item['cod_serie'] . "." . $Item['nom_serie']) . "</option>";
        } else {
            $Combo_Series .= "<option value='" . $Item['id_serie'] . "'>" . html_entity_decode($Item['cod_serie'] . "." . $Item['nom_serie']) . "</option>";
        }
    endforeach;

    //CARGO LAS SUB SERIES
    $TRD = TRD::Listar(9, 0, $DepenResponsable,  $RadicaTemp->get_IdSerie(), 0, "");
    $Combo_Sub_Serie = "";
    foreach ($TRD as $Item) :
        if ($Item['id_subserie'] == $RadicaTemp->get_IdSubserie()) {
            $Combo_Sub_Serie .= "<option value='" . $Item['id_subserie'] . "' selected>" . html_entity_decode($Item['cod_subserie'] . "." . $Item['nom_subserie']) . "</option>";
        } else {
            $Combo_Sub_Serie .= "<option value='" . $Item['id_subserie'] . "'>" . html_entity_decode($Item['cod_subserie'] . "." . $Item['nom_subserie']) . "</option>";
        }
    endforeach;

    //CARGO LOS TIPOS DOCUMENTALES
    $TRD = TRD::Listar(7, 0, $DepenResponsable,  $RadicaTemp->get_IdSerie(), $RadicaTemp->get_IdSubserie(), "");
    $Combo_Tipo_Documento = "";
    foreach ($TRD as $Item) :
        if ($Item['id_tipodoc'] == $RadicaTemp->get_IdTipoDoc()) {
            $Combo_Tipo_Documento .= "<option value='" . $Item['id_tipodoc'] . "' selected>" . html_entity_decode($Item['nom_tipodoc']) . "</option>";
        } else {
            $Combo_Tipo_Documento .= "<option value='" . $Item['id_tipodoc'] . "'>" . html_entity_decode($Item['nom_tipodoc']) . "</option>";
        }
    endforeach;
} else {
    $Combo_TipoDocumentos = "";
    require_once '../../../clases/retencion/class.TRDTipoDocumento.php';
    $Documentos = TipoDocumento::Listar(1, "", "");
    foreach ($Documentos as $Item) :
        $Combo_TipoDocumentos .= "<option value='" . $Item['id_tipodoc'] . "'>" . $Item['nom_tipodoc'] . "</option>";
    endforeach;
}

//CARGO LOS COMBOS DE LA LA FORMA DEENVIO DE LA CORRESPONDENCIA
$FormaLlegada = FormaEnvio::Listar(1, 0);
$Combo_FormaLlegada = "";
foreach ($FormaLlegada as $Item) :
    $Combo_FormaLlegada .= "<option value='" . $Item['id_formaenvio'] . "'>" . $Item['nom_formaenvi'] . "</option>";
endforeach;

$Combo_RadicadosRespuesta = "";
$RadicadosRespuesta = RadicaEnviadoTempRespuestas::Listar(1, $_GET['IdTemp'], "");
foreach ($RadicadosRespuesta as $Item) :
    $Combo_RadicadosRespuesta .= "<option value='" . $Item['id_radica'] . "' selected>" . $Item['id_radica'] . "</option>";
endforeach;

$TiposRespuestas = TipoRespuesta::Listar(3, "", "");
$Combo_TiposRespuestas = "";
foreach ($TiposRespuestas as $Item) :
    $Combo_TiposRespuestas .= "<option value='" . $Item['id_respue'] . "'>" . ($Item['nom_respues']) . "</option>";
endforeach;
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
                    <li><a href="#" class="">Radicar</a></li>
                    <li><a href="#" class="">Correspondencia enviada</a></li>
                    <li><a href="#" class="active">Radicar pendiente.</a></li>
                </ul>
                <div id="DivAlertas"></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <form role="form" name="FrmDatos-Radicar" id="FrmDatos-Radicar">

                                <input name="IdTemp" type="hidden" id="IdTemp" value="<?php echo $_REQUEST['IdTemp'] ?>">
                                <input name="PropiePrincipla" type="hidden" id="PropiePrincipla" value="<?php echo $PropiePrincipla; ?>">
                                <input name="id_depen" type="hidden" id="id_depen">
                                <input name="id_oficina" type="hidden" id="id_oficina">
                                <input name="incluir_trd" type="hidden" id="incluir_trd" value="<?php echo $ConfiguracionOtras->get_Incluir_TRD(); ?>">
                                <input name="incluir_oficina_trd" type="hidden" id="incluir_oficina_trd" value="<?php echo $ConfiguracionOtras->get_Incluir_Oficina_TRD(); ?>">

                                <div class="col-md-8">
                                    <div class="grid simple">
                                        <div class="grid-title no-border">
                                            <h4>
                                                <i class="fa fa-list text-info"></i>
                                                <span class="semi-bold text-info">Datos del radicado</span>
                                            </h4>
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
                                                        <?php echo $Combo_RadicadosRespuesta; ?>
                                                    </select>
                                                </div>
                                                -->
                                                <div class="form-group col-md-2">
                                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModalRadicadosRecibidosParaRespuesta" id="BtnBuscarRadicadosRecibidosParaRespuesta">
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
                                                    <input name="observa_anexo" type="text" class="form-control" id="observa_anexo" value="<?php echo trim($RadicaTemp->get_Anexos()); ?>" placeholder="Ingrese aquí las observaciones de los anexos">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <textarea name="asunto" rows="2" class="form-control" id="asunto" placeholder="Ingrese aquí el asunto del documento...">
                                                        <?php echo trim($RadicaTemp->get_Asunto()); ?>
                                                    </textarea>
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
                                                                <?php
                                                                $ListarQuienesFirman = RadicadoEnviadoTempQuienFirma::Listar(1, $_GET['IdTemp'], "", "", "", "", "", "");
                                                                foreach ($ListarQuienesFirman as $ItemQuienesFirman) :
                                                                    $FuncioFrima = "";
                                                                    if ($ItemQuienesFirman['firma_principal'] == 1) {
                                                                        $FuncioFrima = "checked";
                                                                    }
                                                                ?>
                                                                    <tr id="TblQuienFirma<?php echo $ListarQuienesFirman['id_funcio_deta']; ?>">
                                                                        <td>
                                                                            <div class="radio radio-success">
                                                                                <input type="radio" class="dependencia_quien_firma" name="ChkFuncioQuienFirma" id="ChkFuncioQuienFirma<?php echo $ItemQuienesFirman['id_funcio_deta']; ?>" value="<?php echo $ItemQuienesFirman['id_funcio_deta']; ?>" data-id_quien_firma_dependencia="<?php echo $ItemQuienesFirman['id_depen']; ?>" data-id_quien_firma_oficina="<?php echo $ItemQuienesFirman['id_oficina']; ?>" <?php echo $FuncioFrima; ?>>
                                                                                <label for="ChkFuncioQuienFirma<?php echo $ItemQuienesFirman['id_funcio_deta']; ?>">
                                                                                    <?php echo $ItemQuienesFirman['nom_funcio'] . " " . $ItemQuienesFirman['ape_funcio']; ?>
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                        <td><?php echo $ItemQuienesFirman['nom_oficina']; ?></td>
                                                                        <td>
                                                                            <button class="borrar_quien_firma btn btn-danger btn-sm btn-small" data-id="'+$(this).val()+'">
                                                                                <i class="fa fa-trash-o"></i>
                                                                            </button>
                                                                        </td>

                                                                    <?php
                                                                endforeach;
                                                                    ?>
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
                                                                <?php
                                                                $ListarResponsables = RadicadoEnviadoTempResponsable::Listar(2, $_GET['IdTemp'], "", "", "", "", "", "");
                                                                foreach ($ListarResponsables as $ItemResponsables) :
                                                                    $FuncioRespon = "";
                                                                    if ($ItemResponsables['respon'] == 1) {
                                                                        $FuncioRespon = "checked";
                                                                    }
                                                                ?>

                                                                    <tr id="TblResponsales<?php echo $ItemResponsables['id_funcio_deta']; ?>">
                                                                        <td>
                                                                            <div class="radio radio-success">
                                                                                <input type="radio" class="dependencia_del_responsable" name="ChkFuncioRespon" id="ChkFuncioRespon<?php echo $ItemResponsables['id_funcio_deta']; ?>" value="<?php echo $ItemResponsables['id_funcio_deta']; ?>" data-responsable_dependencia="<?php echo $ItemResponsables['id_depen']; ?>" <?php echo $FuncioRespon; ?>>
                                                                                <label for="ChkFuncioRespon<?php echo $ItemResponsables['id_funcio_deta']; ?>">
                                                                                    <?php echo $ItemResponsables['nom_funcio'] . " " . $ItemResponsables['ape_funcio']; ?>
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                        <td><?php echo $ItemResponsables['nom_oficina']; ?></td>
                                                                        <td>
                                                                            <button class="borrar_responsables btn btn-danger btn-sm btn-small" data-id="<?php echo $ItemResponsables['id_funcio_deta']; ?>">
                                                                                <i class="fa fa-trash-o"></i>
                                                                            </button>
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
                                                                <?php
                                                                $ListProyectores = RadicadoEnviadoTempProyector::Listar(1, $_GET['IdTemp'], "", "", "", "", "", "");
                                                                foreach ($ListProyectores as $ItemProyect) :
                                                                ?>
                                                                    <tr id="TblProyectores<?php echo $ItemProyect['id_funcio_deta']; ?>">
                                                                        <td>
                                                                            <div class="radio radio-success">
                                                                                <input type="radio" class="dependencia_del_proyector" name="ChkProyectores" id="ChkProyectores<?php echo $ItemProyect['id_funcio_deta']; ?>" value="<?php echo $ItemProyect['id_funcio_deta']; ?>" data-proyector_dependencia="<?php echo $ItemProyect['id_depen']; ?>">
                                                                                <label for="ChkProyectores<?php echo $ItemProyect['id_funcio_deta']; ?>"><?php echo $ItemProyect['nom_funcio'] . " " . $ItemProyect['ape_funcio']; ?></label>
                                                                            </div>
                                                                        </td>
                                                                        <td><?php echo $ItemProyect['nom_oficina']; ?></td>
                                                                        <td>
                                                                            <button class="borrar_proyector btn btn-danger btn-sm btn-small" data-id="<?php echo $ItemProyect['id_funcio_deta']; ?>">
                                                                                <i class="fa fa-trash-o"></i>
                                                                            </button>
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
                                    <div class="grid simple" style="min-height:360px;">
                                        <div class="grid-title no-border">
                                            <h4>
                                                <i class="fa fa-male text-info"></i>
                                                <span class="semi-bold text-info">Destinatario</span>
                                            </h4>
                                        </div>
                                        <div class="grid-body no-border">
                                            <?php

                                            foreach ($Tercero as $Item) :

                                                $NumDocumento = "";
                                                $NomContac    = "";
                                                $RazoSoci     = "";
                                                $Dir          = "";
                                                $Tel          = "";
                                                $Cel          = "";

                                                if ($Item['id_empre'] != "") {
                                                    $NumDocumento = $Item['nit_empre'];
                                                    $NomContac    = $Item['nom_contac'];
                                                    $RazoSoci     = $Item['razo_soci'];
                                                    $Dir          = $Item['nom_muni_empre'] . ", " . $Item['nom_depar_empre'] . " - " . $Item['dir_empre'];
                                                    $Tel          = $Item['tel_empre'];
                                                    $Cel          = $Item['cel_empre'];
                                                } else {
                                                    $NumDocumento = $Item['num_docu'];
                                                    $NomContac    = $Item['nom_contac'];
                                                    $RazoSoci     = "";
                                                    $Dir          = $Item['nom_muni_remite'] . ", " . $Item['nom_depar_remite'] . " - " . $Item['dir_remite'];
                                                    $Tel          = $Item['tel_remite'];
                                                    $Cel          = $Item['cel_remite'];
                                                }

                                            ?>
                                                <div class="row">
                                                    <div class="form-group col-md-3">
                                                        <input name="id_destina" id="id_destina" type="hidden" value="<?php echo $Item['id_tercero']; ?>">
                                                        <input name="cc_nit" type="text" class="form-control" id="cc_nit" placeholder="C.c / NIt" value="<?php echo $NumDocumento; ?>">
                                                    </div>
                                                    <div class="form-group col-md-7">
                                                        <input name="destina_contacto" type="text" class="form-control" id="destina_contacto" placeholder="Contacto" value="<?php echo $NomContac; ?>">
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <div class="btn-group">
                                                            <button class="btn btn-success btn-demo-space btn-sm">
                                                                <i class="fa fa-ellipsis-v"></i>
                                                            </button>
                                                            <button class="btn btn-success dropdown-toggle btn-demo-space btn-sm" data-toggle="dropdown">
                                                                <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    <a href="#" data-toggle="modal" data-target="#myModalDestinatarioNatural" id="BtnBuscarDestinatarioNatural">Buscar destinatario natural</a>
                                                                </li>
                                                                <li>
                                                                    <a href="#" data-toggle="modal" data-target="#myModalDestinatarioJuridico" id="BtnBuscarDestinatarioJuridico">Buscar destinatario juridico</a>
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
                                                <?php
                                                if ($Item['id_empre'] != "") {
                                                ?>
                                                    <div class="row" id="DivRemiteRazoSoci">
                                                        <div class="form-group col-md-12">
                                                            <input name="destina_razo_soci" type="text" class="form-control" id="destina_razo_soci" placeholder="Razón Social" value="<?php echo $RazoSoci; ?>">
                                                        </div>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <input name="destina_dir" type="text" class="form-control" id="destina_dir" placeholder="Dirección" value="<?php echo $Dir; ?>">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-4">
                                                        <input name="destina_tel" type="text" class="form-control" id="destina_tel" placeholder="Teléfono" value="<?php echo $Tel; ?>">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <input name="destina_cel" type="text" class="form-control" id="destina_cel" placeholder="Móvil / Pbx" value="<?php echo $Cel; ?>">
                                                    </div>
                                                </div>
                                            <?php
                                            endforeach;
                                            ?>
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
                                </div>
                            </form>
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
                                                                echo utf8_encode($Item['nom_funcio'] . " " . $Item['ape_funcio']);
                                                                ?>
                                                            </span>
                                                        </td>
                                                        <td class="v-align-middle">
                                                            <?php echo utf8_encode($Item['nom_depen'] . " - " . $Item['nom_oficina']); ?>
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
                                                foreach ($FuncionarioResponsables as $Item) :
                                                ?>
                                                    <tr>
                                                        <td class="v-align-middle">
                                                            <div class="checkbox check-default">
                                                                <input type="checkbox" value="<?php echo $Item['id_funcio_deta']; ?>" name="ChkResponsables[]" id="ChkResponsables<?php echo $Item['id_funcio_deta']; ?>" data-nombre_responsables="<?php echo $Item['nom_funcio'] . " " . $Item['ape_funcio']; ?>" data-oficina_responsables="<?php echo $Item['nom_oficina']; ?>" data-dependencia_responsables="<?php echo $Item['id_depen']; ?>">
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
                                                            <?php echo $Item['nom_depen'] . " <br> " . $Item['nom_oficina']; ?>
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
                                                foreach ($FuncionarioProyectores as $Item) :
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
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MODAL PARA LOS DETINATARIOS NATURALES-->

        <!-- BEGIN MODAL PARA LOS DETINATARIOS JURIDICO-->
        <div class="modal fade" id="myModalDestinatarioJuridico" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <br>
                        <i class="fa fa-users fa-2x"></i>
                        <h4 id="myModalLabel" class="semi-bold">Destinatario Juridico.</h4>
                        <p class="no-margin">Elige el destinatario de la correspondencia</p>
                        <br>
                    </div>
                    <div class="modal-body">
                        <div class="row-fluid">
                            <div class="span12">
                                <div class="grid simple ">
                                    <div class="grid-body ">
                                        <div class="row form-row">
                                            <div id="DivAlertasDestinaJuridicos"></div>
                                            <div class="col-md-12">
                                                <input name="TxtBusDestinaJuridicos" type="text" class="form-control" id="TxtBusDestinaJuridicos" placeholder="Ingrese aqui el criterio de búsqueda para el detinatario juridico.">
                                            </div>
                                        </div>
                                        <div class="row form-row">
                                            <div class="col-md-12">
                                                <div id="DivDestinatarioJuridico"></div>
                                            </div>
                                        </div>
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
        <!-- END MODAL PARA LOS DETINATARIOS JURIDICO-->

        <!-- INICIO MODAL PARA NUEVO TERCERO NATURAL -->
        <div class="modal fade" id="myModalNuevoTerceroNatural" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <br>
                        <i class="fa fa-credit-card fa-2x"></i>
                        <h4 id="myModalLabel" class="semi-bold">Nuevo Remiente Natural</h4>
                    </div>
                    <form role="form" name="FrmDatosTerceroNatural" id="FrmDatosTerceroNatural">
                        <div class="modal-body">
                            <div id="DivAlertaTerceroNatural"></div>
                            <input type="hidden" name="accion_remite" id="accion_remite" value="NUEVO_TERCERO_NATURAL">
                            <div class="grid-body no-border">
                                <div class="row form-row">
                                    <div class="col-md-4">
                                        <input name="num_docu_natural" type="text" class="form-control input-sm" id="num_docu_natural" placeholder="# De Documento">
                                    </div>
                                    <div class="col-md-8">
                                        <input name="nom_contac_natural" type="text" class="form-control input-sm" id="nom_contac_natural" placeholder="Nombres Del Contacto">
                                    </div>
                                    <div class="col-md-12">
                                        <input name="dir_natural" type="text" class="form-control input-sm" id="dir_natural" placeholder="Dirección">
                                    </div>
                                </div>
                                <div class="row form-row">
                                    <div class="col-md-6">
                                        <select name="id_depar_natural" id="id_depar_natural" class="select2 form-control input-sm">
                                            <option value="0">...::: Elije el Departamento :::...</option>
                                            <?php echo $Combo_Departamentos; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <select name="id_muni_natural" id="id_muni_natural" class="select2 form-control input-sm">
                                            <option value="0">...::: Elije el Municipio :::...</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-row">
                                    <div class="col-md-6">
                                        <input name="tel_natural" type="text" class="form-control input-sm" id="tel_natural" placeholder="Teléfono">
                                    </div>
                                    <div class="col-md-6">
                                        <input name="cel_natural" type="text" class="form-control input-sm" id="cel_natural" placeholder="Celular">
                                    </div>
                                </div>
                                <div class="row form-row">
                                    <div class="col-md-12">
                                        <input name="email_natural" type="email" class="form-control input-sm" id="email_natural" placeholder="E - Mail">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal" id="BtnCancelarTerceroNatural">Cancelar</button>
                            <button type="button" class="btn btn-success" id="BtnGuardarTerceroNatural">
                                <i class="fa fa-save"></i> Guardar
                            </button>
                        </div>
                    </form>
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
                        <i class="fa fa-credit-card fa-2x"></i>
                        <h4 id="myModalLabel" class="semi-bold">Nuevo Remiente Juridico</h4>
                    </div>
                    <form role="form" name="FrmDatosTerceroJuridico" id="FrmDatosTerceroJuridico">
                        <div class="modal-body">
                            <div id="DivAlertaTerceroJutidico"></div>
                            <input type="hidden" name="accion_remite" id="accion_remite" value="NUEVO_TERCERO_JURIDICO">
                            <div class="grid-body no-border">
                                <div class="row form-row">
                                    <div class="col-md-12">
                                        <select id="id_empre_juridico" name="id_empre_juridico" style="width:100%">
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
                                    <div class="col-md-6">
                                        <input name="tel_contac_juridico" type="text" class="form-control input-sm" id="tel_contac_juridico" placeholder="Teléfono">
                                    </div>
                                    <div class="col-md-6">
                                        <input name="cel_contac_juridico" type="text" class="form-control input-sm" id="cel_contac_juridico" placeholder="Celular">
                                    </div>
                                </div>
                                <div class="row form-row">
                                    <div class="col-md-12">
                                        <input name="email_contac_juridico" type="email" class="form-control input-sm" id="email_contac_juridico" placeholder="E - Mail">
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
                    </form>
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
                                <li class="active"><a href="#tab1hellowWorld">Empresa del contacto</a></li>
                                <li><a href="#tab1FollowUs">Datos del contacto</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab1hellowWorld">
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
                                <div class="tab-pane" id="tab1FollowUs">
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
                        <p class="no-margin">Elige el radicado al caul se le va a dar respuesta</p>
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

        <!-- BEGIN MODAL PARA LISTAR LOS RADICADOS QUE REQUIEREN RESPUESTAS-->
        <div class="modal fade" id="myModalListarRadicadosRecibidosParaRespuesta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <br>
                        <i class="fa fa-users fa-2x"></i>
                        <h4 id="myModalLabel" class="semi-bold">Radicado para dar respuesta.</h4>
                        <br>
                    </div>
                    <div class="modal-body">
                        <div class="row-fluid">
                            <div class="span12">
                                <div class="grid simple ">
                                    <div class="grid-body">

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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MODAL PARA LISTAR LOS RADICADOS QUE REQUIEREN RESPUESTAS-->

        <?php
        include '../../../varios/ayudas.php';
        ?>
        <script src="../../../../public/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
        <script src="funcionesVentanillaEnviadasPendientesPorRadicar.ajax.js"></script>
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