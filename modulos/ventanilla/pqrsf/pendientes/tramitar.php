<?php
session_start();
include("../../../../config/variable.php");
include("../../../../config/funciones.php");
include("../../../../config/funciones_seguridad.php");
require_once '../../../../config/class.Conexion.php';
require_once '../../../clases/retencion/calss.TRD.php';
require_once '../../../clases/radicar/class.RadicaRecibido.php';
require_once '../../../clases/radicar/class.RadicaRecibidoPQRSF.php';
require_once '../../../clases/general/class.GeneralFuncionario.php';
require_once '../../../clases/general/class.GeneralTercero.php';
require_once "../../../clases/configuracion/class.ConfigOtras.php";
require_once "../../../clases/configuracion/class.ConfigTipoCorrespondencia.php";
require_once "../../../clases/configuracion/class.ConfigDepartamento.php";
require_once "../../../clases/configuracion/class.ConfigMunicipio.php";
require_once "../../../clases/configuracion/class.ConfigRegimen.php";

$TRD = TRD::Listar(6, 0, $_SESSION['SesionFuncioDepenId'], 0, 0, "");

//CARGO LOS COMBOS DE LA SERIE, SUB SERIE Y TIPO DOCUMENTAL
$Combo_Series = "";
$Combo_Sub_Serie = "";
$Combo_Tipo_Documento = "";
foreach ($TRD as $Item) :
    $Combo_Series .= "<option value='" . $Item['id_serie'] . "'>" . $Item['cod_serie'] . "." . $Item['nom_serie'] . "</option>";
endforeach;

$Funcionario = Funcionario::Listar(6, 0, "", "", "", 0, 0, 0);
$Combo_Funcionarios = "";
foreach ($Funcionario as $Item) :
    $Combo_Funcionarios .= "<option value='" . $Item['id_funcio_deta'] . "'>" . $Item['nom_oficina'] . " - " . $Item['nom_funcio'] . " " . $Item['ape_funcio'] . "</option>";
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

$TipoCorrespondencia = TipoCorrespondencia::Listar(1, "", 5, "");
$Combo_TipoCorrespondencia = "";
foreach ($TipoCorrespondencia as $Item) :
    $Combo_TipoCorrespondencia .= "<option value='" . $Item['id_tipo'] . "'>" . $Item['nom_tipo'] . "</option>";
endforeach;

/**
 * LISTO LA INFO DE LA SOLICITUD
 */
$pqr = RadicadoRecibidoPQRSF::BuscarPQRSF(['Accion' => 1, 'idPqr' => $_REQUEST['id']]);
$idRadicado = $pqr->get_IdRadica();
$radicaRecibido = RadicadoRecibido::Buscar(1, $idRadicado, "", "", "", "");
if ($radicaRecibido->get_IdSerie() and $radicaRecibido->get_IdSubserie()) {
    echo "Pailas";
}

$tipoCorrespondencia = TipoCorrespondencia::Buscar(2, $pqr->get_idTipoDocumental(), "", "");

$solicitante = Tercero::Buscar(2, $pqr->get_idContacto(), "", "", "", "", "");
$departamentoSolicitante = Departamento::Buscar(1, $solicitante->getId_Depar());
$municipioSolicitante = Municipio::Buscar(2, $solicitante->getId_Muni());

$departamentoAfectado = Departamento::Buscar(1, $pqr->get_idDeparAfectado());
$municipioAfectado = Municipio::Buscar(2, $pqr->get_idMuniAfectado());

$regimen = Regimen::Buscar(2, $pqr->get_idRegimen(), "");

?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>...::: Iwana - Bandeja, Interna :::...</title>
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
    <script src="../../../../public/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
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
                <?php include_once '../../../../config/menu_bandeja.php'; ?>
                <!-- END SIDEBAR MENU -->
            </div>
            <div class="inner-menu nav-collapse">
                <div id="inner-menu">
                    <div class="inner-wrapper">

                    </div>
                    <div class="inner-wrapper">
                        <p class="menu-title">VISTA RÁPIDA</p>
                    </div>
                    <div class="inner-menu-content">
                        <p class="menu-title">MIS COMUNICACIONES INTERNAS
                            <span class="pull-right"><i class="icon-refresh"></i></span>
                        </p>
                    </div>
                    <div class="inner-menu-content">
                        <p class="menu-title">
                            <span class="pull-right">
                                <i class="icon-refresh"></i></span>
                        </p>
                    </div>
                    <ul class="small-items">
                        <li class="active">
                            <a href="../../../mi_archivo/bandeja/interna/recibidas/index.php"> Ir a la correspondencia interna recibida</a>
                        </li>
                        <li class="active">
                            <a href="../../../mi_archivo/bandeja/interna/enviadas/index.php"> Ir a la correspondencia interna enviada</a>
                        </li>
                    </ul>

                    <ul class="big-items">
                        <li class="">
                            <a href="../../../mi_archivo/bandeja/externa/pendientes/index.php">
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
                        <a href="#" class="active">Bandeja, Comunicaciones internas, redactar comunicación</a>
                    </li>
                </ul>

                <div id="DivAlertas"></div>
                <div class="row">

                    <input name="accion" type="hidden" id="accion" value="ASIGNAR_PQR">
                    <input name="id_responsable" type="hidden" id="id_responsable" value="Nuevo">
                    <input name="id_pqr" type="hidden" id="id_pqr" value="<?php echo $_REQUEST['id']; ?>">
                    <input name="id_radica" type="hidden" id="id_radica" value="<?php echo $pqr->get_IdRadica(); ?>">
                    <input name="id_remite" type="hidden" id="id_remite" value="<?php echo $pqr->get_idContacto(); ?>">
                    <input name="id_tipo_correspon" type="hidden" id="id_tipo_correspon" value="<?php echo $pqr->get_idTipoDocumental(); ?>">
                    <input name="asunto" type="hidden" id="asunto" value="<?php echo $pqr->get_detalleSolicitud(); ?>">
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
                                    <span class="semi-bold text-info">Datos de la solicitud</span>
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
                                        <div>
                                            <h3 class="semi-bold text-info">Radicado: <?php echo $radicaRecibido->get_IdRadica(); ?></h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <div>
                                            <label class="text-info">Tipo de solicitud:</label><?php echo $tipoCorrespondencia->get_NombreTipo(); ?>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <div>
                                            <label class="text-info">Fecha y hora de la solicitud:</label><?php echo $radicaRecibido->get_FecRadica(); ?>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <div>
                                            <label class="text-info">¿Existe fallo judicial?</label><?php echo $pqr->get_falloJuducial(); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="text-info">Aspectos o tema principal que motivó la queja</label>
                                        <?php echo $pqr->get_detalleSolicitud(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grid simple">
                            <div class="grid-title no-border">
                                <h4>
                                    <span class="semi-bold text-info">Datos del solicitante y afectado</span>
                                </h4>
                            </div>
                            <div class="grid-body no-border">
                                <div class="row">
                                    <div class="col-6 col-md-6">

                                        <h5>
                                            <i class="fa fa-user text-info"></i>
                                            <span class="semi-bold text-info">Datos de solicitante</span>
                                        </h5>

                                        <div>
                                            <label class="text-info"> Documento:</label>
                                            <?php echo $solicitante->getNum_Documetno(); ?>
                                        </div>
                                        <div>
                                            <label class="text-info"> Nombres:</label>
                                            <?php echo $solicitante->getNom_Contacto(); ?>
                                        </div>
                                        <div>
                                            <label class="text-info"> Dirección:</label>
                                            <?php echo $solicitante->get_Dir() . ", " . $departamentoSolicitante->get_NomDepar() . " - " . $municipioSolicitante->get_NomMuni(); ?>
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <h5>
                                            <i class="fa fa-user text-info"></i>
                                            <span class="semi-bold text-info">Datos de afectado</span>
                                        </h5>

                                        <div>
                                            <label class="text-info"> Documento:</label>
                                            <?php echo $pqr->get_numDocuAfectado(); ?>
                                        </div>
                                        <div>
                                            <label class="text-info"> Nombres:</label>
                                            <?php echo $pqr->get_nomAfectado(); ?>
                                        </div>
                                        <div>
                                            <label class="text-info"> Dirección:</label>
                                            <?php echo $pqr->get_dirAfectado(), $departamentoAfectado->get_NomDepar() . " - " . $municipioAfectado->get_NomMuni(); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div>
                                            <label class="text-info"> Regimen:</label>
                                            <?php echo $regimen->get_Nombre(); ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="grid simple">
                            <div class="grid-title no-border">
                                <div class="col-md-8">
                                    <h4>
                                        <i class="fa fa-users text-info"></i>
                                        <span class="semi-bold text-info"> Responsable de la solicitud</span>
                                    </h4>
                                </div>
                                <div class="col-md-4">
                                    <div align="right">
                                        <button type="button" class="btn btn-success btn-sm btn-small" data-toggle="modal" data-target="#myModalDestinatarios" id="BtnBuscarDestinatario">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="grid-body no-border">
                                <table width="90%" class="table table-striped table-flip-scroll cf" id="TblDestinatarios">
                                    <thead class="cf">
                                        <tr>
                                            <th width="2%">Respon.</th>
                                            <th width="55%">Funcionario</th>
                                            <th width="40%">Oficina</th>
                                            <th width="5%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="fila-base" style="display: none;">
                                            <td class="FuncioRespon"><input type="radio" name="edad" id="ChkFuncioRespon"></td>
                                            <td class="FuncioNum"></td>
                                            <td class="FuncioOficina"></td>
                                            <td class="FuncioEliminar">Eliminar</td>
                                        </tr>
                                    </tbody>
                                </table>
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
            <div class="admin-bar" id="quick-access" style="display:">
                <div class="admin-bar-inner">
                    <div class="form-horizontal">
                    </div>
                    <button class="btn btn-default btn-cons" type="button" id="BtnCancelar"><i class="fa fa-times-circle"></i> Cancelar</button>
                    <button class="btn btn-primary btn-cons" type="button" id="BtnEnviarParaTramite"><span class="semi-bold"><i class="fa fa-share"></i> Enviar para tramite</span></button>
                </div>
            </div>
            <div class="clearfix">
            </div>
        </div>

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
                                                <th>J</th>
                                                <th>F</th>
                                                <th>Funcionario</th>
                                                <th>Oficina</th>
                                                <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($Funcionario as $Item) :
                                                ?>
                                                    <tr>
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
                                                        <td>
                                                            <a class="btn btn-success btn-mini BtnLlevarDestinatarios" data-id_funcio_deta="<?php echo $Item['id_funcio_deta']; ?>" data-nombre_destinatario="<?php echo $Item['nom_funcio'] . " " . $Item['ape_funcio']; ?>" data-oficina_destinatario="<?php echo $Item['nom_oficina']; ?>" data-id_dependencia_destinatario="<?php echo $Item['id_depen']; ?>" data-id_oficina_destinatario="<?php echo $Item['id_oficina']; ?>">
                                                                <i class="fa fa-check"></i>
                                                            </a>
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
        <!-- END MODAL PARA DESTINATARIOS-->

        <!-- BEGIN CORE JS FRAMEWORK-->
        <script src="../../../../modulos/ventanilla/pqrsf/pendientes/funcionesVentanillaRecibidasQprPendientes.ajax.js"></script>
        <script src="../../../../public/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
        <script src="../../../../public/assets/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../../../../public/assets/plugins/breakpoints.js" type="text/javascript"></script>
        <script src="../../../../public/assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
        <!-- END CORE JS FRAMEWORK -->
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
        <!-- END PAGE LEVEL PLUGINS -->
        <script src="../../../../public/assets/js/form_elements.js" type="text/javascript"></script>
        <script src="../../../../public/assets/js/tabs_accordian.js" type="text/javascript"></script>
        <script src="../../../../public/assets/js/email_comman.js" type="text/javascript"></script>
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
        <script src="../../../../public/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
        <script src="../../../../public/assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script>
        <script src="../../../../public/assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>

        <script src="../../../../public/assets/plugins/jquery-datatable/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="../../../../public/assets/plugins/jquery-datatable/extra/js/dataTables.tableTools.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="../../../../public/assets/plugins/datatables-responsive/js/datatables.responsive.js"></script>
        <script type="text/javascript" src="../../../../public/assets/plugins/datatables-responsive/js/lodash.min.js"></script>
        <script src="../../../../public/assets/js/datatables.js" type="text/javascript"></script>
        <!-- BEGIN CORE TEMPLATE JS -->
        <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js" type="text/javascript"></script>
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
        <script src="../../../../public/assets/plugins/dropzone/dropzone.min.js"></script>

        <link rel="stylesheet" type="text/css" href="../../../../public/assets/plugins/dropzone/css/dropzone.css">
        <script src="../../../../public/assets/sweetalert2/sweetalert-dev.js"></script>
        <link href="../../../../public/assets/sweetalert2/sweetalert.css" rel="stylesheet" type="text/css">

</body>

</html>