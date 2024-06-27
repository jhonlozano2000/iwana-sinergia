<?php
session_start();
include "../../../../config/class.Conexion.php";
include "../../../../config/variable.php";
include "../../../../config/funciones.php";
include "../../../../config/funciones_seguridad.php";
require_once '../../../clases/configuracion/class.ConfigFormaEnvio.php';
require_once '../../../clases/radicar/class.RadicaEnviadoTemp.php';
require_once '../../../clases/radicar/class.RadicaEnviadoTempResponsables.php';
require_once '../../../clases/configuracion/class.ConfigOtras_Respon_HC.php';
require_once "../../../clases/general/class.GeneralTercero.php";

$FormaLlegada = FormaEnvio::Listar(1, 0);
$RadicaTemp = RadicadoEnviadoTemp::Buscar(1, $_GET['id_temp'], "");

if(!$RadicaTemp){
    header("Locatrion: ".MI_ROOT);
}

$RadicaTempResponsable = RadicadoEnviadoTempResponsable::Buscar(1, $_GET['id_temp'], "");

//CARGO LOS COMBOS DE LA LA FORMA DE LLGADA DE LA CORRESPONDENCIA
$Combo_FormaLlegada = "";
foreach($FormaLlegada as $Item):
    $Combo_FormaLlegada.= "<option value='".$Item['id_formaenvio']."'>".html_entity_decode($Item['nom_formaenvi'], ENT_QUOTES | ENT_HTML401, "UTF-8")."</option>";
endforeach;
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>...::: Iwana - Ventanilla :::...</title>
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
    <link href="../../../../public/assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen"/>
    <!-- END CORE CSS FRAMEWORK -->
    <!-- BEGIN CSS TEMPLATE -->
    <link href="../../../../public/assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="../../../../public/assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="../../../../public/assets/css/custom-icon-set.css" rel="stylesheet" type="text/css" />
</head>

<body class="inner-menu-always-open">
    <!-- BEGIN HEADER -->
    <?php require_once '../../../../config/cabeza_busqueda.php'; ?>
    <!-- END HEADER --> 
    <!-- BEGIN CONTAINER -->
    <div class="page-container row-fluid"> 
        <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar mini mini-mobile" id="main-menu" data-inner-menu="1">
            <div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrappers">
                <div class="user-info-wrapper"> 
                    <!-- BEGIN MINI-PROFILE -->
                    <?php require_once '../../../../config/mini_profile.php'; ?>
                    <!-- END MINI-PROFILE -->
                </div>
                <!-- BEGIN SIDEBAR MENU -->
                <?php require_once '../../../../config/menu_ventanilla.php'; ?>
                <!-- END SIDEBAR MENU -->
            </div>

            <div class="inner-menu nav-collapse">   
                <div id="inner-menu">
                    <div class="inner-wrapper" >    
                        <a href="../../enviada/enviadas/radicar.php" class="btn btn-block btn-primary" >
                            <span class="bold">RADICAR</span>
                        </a>
                    </div>
                    <div class="inner-menu-content">
                        <p class="menu-title">VISTA RAPIDA <span class="pull-right"><i class="icon-refresh"></i></span></p>
                    </div>
                    <ul class="small-items">
                        <li class="">
                            <a href="../../recibida/recibidas/index.php"> Ir a la correspondencia recibida</a>
                        </li>
                        <li class="">
                            <a href="../../enviada/enviadas/index.php"> Ir a la correspondencia enviada</a>
                        </li>
                        <li class="">
                            <a href="../../interna/interna/index.php"> Ir a la correspondencia interna</a>
                        </li>
                    </ul>
                    <ul class="big-items">
                        <li class="">
                            <a href="../../enviada/pendien_radicar/index.php"> 
                                <span class="btn btn-success btn-sm btn-small label label-important">
                                    <i class="fa fa-bullhorn"></i> <span>Solicitudes de HC<br> pendientes por entregar</span>
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
            <div class="clearfix">
            </div>
            <div class="content">
                <ul class="breadcrumb">
                    <li>
                        <p>Tú estas</p>
                    </li>
                    <li>
                        <a href="#" class="active">Radicar - Correspondencia enviada, Solicitud de historia clínica.</a>
                    </li>
                </ul>
                <div class="page-title">
                    <div id="DivAlertas">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <input name="id_temp" type="hidden" id="id_temp" value="<?php echo $_GET['id_temp']; ?>">
                            <div class="col-md-8">
                                <div class="grid simple">
                                    <div class="grid-title no-border">
                                        <h4><i class="fa fa-list text-info"></i>
                                            <span class="semi-bold text-info">Datos del radicado</span>
                                        </h4>
                                    </div>
                                    <div class="grid-body no-border">
                                        <div class="row">
                                            <div class="form-group col-md-3">
                                                <input name="num_anexos" type="text" class="form-control" id="num_anexos" placeholder="# De Anexos">
                                            </div>
                                            <div class="form-group col-md-9">
                                                <input name="observa_anexo" type="text" class="form-control" id="observa_anexo" placeholder="Ingrese aquí las observaciones de los anexos">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <textarea name="asunto" rows="2" class="form-control" id="asunto" placeholder="Ingrese aquí el asunto del documento..."><?php echo $RadicaTemp->get_Asunto(); ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="grid simple">
                                    <div class="grid-title no-border">
                                        <div class="col-md-8">
                                            <h4><i class="fa fa-users text-info"></i><span class="semi-bold text-info">Responsables</span>
                                            </h4>
                                        </div>

                                    </div>
                                    <div class="grid-body no-border">
                                        <table width="90%" class="table table-striped table-flip-scroll cf" id="TblResponsales">
                                            <thead class="cf">
                                                <tr>
                                                    <th width="55%">Funcionario</th>
                                                    <th width="40%">Ubicación</th>
                                                    <th width="5%"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $Responsables = RadicadoEnviadoTempResponsable::Listar(2, $_GET['id_temp'], "");
                                                foreach ($Responsables as $Item):
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $Item['nom_funcio']." ". $Item['ape_funcio']; ?></td>
                                                        <td><?php echo "Depen.: ".$Item['nom_depen']."<br>Ofi.:". $Item['nom_oficina']."<br>Cargo:". $Item['nom_cargo']; ?></td>
                                                    </tr>
                                                    <?php
                                                endforeach;
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="grid simple" style="min-height: 300px;">
                                    <div class="grid-title no-border">
                                        <h4><i class="fa fa-male text-info"></i><span class="semi-bold text-info">Destinatario</span></h4>
                                    </div>
                                    <div class="grid-body no-border">
                                        <?php
                                        $Destinatario = Tercero::Listar(2, $RadicaTemp->get_IdDestinatario(), "", "", "", "", "");
                                        foreach($Destinatario as $Item):
                                            ?>
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <input name="id_destina" id="id_destina" type="hidden">
                                                    <input name="cc_nit" type="text" class="form-control" id="cc_nit" placeholder="C.c / NIt" value="<?php echo $Item['num_docu']; ?>">
                                                </div>
                                                <div class="form-group col-md-9">
                                                    <input name="destina_contacto" type="text" class="form-control" id="destina_contacto" placeholder="Contacto"  value="<?php echo $Item['nom_contac']; ?>">
                                                </div>

                                            </div>
                                            <?php if($Item['razo_soci'] != ""){ ?>
                                                <div class="row" id="DivRemiteRazoSoci">
                                                    <div class="form-group col-md-12">
                                                        <input name="destina_razo_soci" type="text" class="form-control" id="destina_razo_soci" placeholder="Razón Social"  value="<?php echo $Item['razo_soci']; ?>">
                                                    </div>
                                                </div>
                                            <?php } 
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
                                                    <select name="id_forma_enviados" id="id_forma_enviados" style="width:100%">
                                                        <option value="0">...::: Como despacha la correspondencia :::...</option>
                                                        <?php echo $Combo_FormaLlegada; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <input name="num_guia" type="text" class="form-control" id="num_guia" placeholder="# De Guía">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="grid simple">
                                    <div class="grid-title no-border">
                                        <h4>
                                            <i class="fa fa-folder text-info"></i>
                                            <span class="semi-bold text-info">Clasificación Documental</span>
                                        </h4>
                                    </div>
                                    <div class="grid-body no-border">
                                        <?php
                                        $ClasificaDocumen = ConfigOtrasResponsableHC::Listar(2, $RadicaTempResponsable->get_IdFuncio());
                                        foreach($ClasificaDocumen as $Item):
                                            ?>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <div class="controls">
                                                        <?php echo "Serie: ".$Item['nom_serie']; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <div class="controls">
                                                        <?php echo "Subserie: ".$Item['nom_subserie']; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <div class="controls">
                                                        <?php echo "Tipo Documental: ".$Item['nom_tipodoc']; ?>
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
        <script src="../../../../public/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
        <script src="funciones.ajax.js"></script>
        <script src="../../../../public/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
        <script src="../../../../public/assets/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../../../../public/assets/plugins/breakpoints.js" type="text/javascript"></script>
        <script src="../../../../public/assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
        <!-- END CORE JS FRAMEWORK -->
        <!-- BEGIN PAGE LEVEL JS -->
        <script src="../../../../public/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
        <script src="../../../../public/assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <script src="../../../../public/assets/js/tabs_accordian.js" type="text/javascript"></script>
        <script>
            $(document).ready(function() {
                $('#text-editor').wysihtml5();
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
        <script src="../../../../public/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
        <script src="../../../../public/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js" type="text/javascript"></script>
        <script src="../../../../public/assets/plugins/jquery-inputmask/jquery.inputmask.min.js" type="text/javascript"></script>
        <script src="../../../../public/assets/plugins/jquery-autonumeric/autoNumeric.js" type="text/javascript"></script>
        <script src="../../../../public/assets/plugins/ios-switch/ios7-switch.js" type="text/javascript"></script>
        <script src="../../../../public/assets/sweetalert2/sweetalert-dev.js"></script>
        <script src="../../../../public/assets/plugins/boostrap-form-wizard/js/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
        <script src="../../../../public/assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="../../../../public/assets/js/form_validations.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="../../../../public/assets/sweetalert2/sweetalert.css">
        <script src="../../../../public/assets/js/form_elements.js" type="text/javascript"></script>
    </body>
    </html>