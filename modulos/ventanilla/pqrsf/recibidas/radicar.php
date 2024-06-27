<?php
session_start();
include("../../../../config/variable.php");
include("../../../../config/funciones.php");
include("../../../../config/funciones_seguridad.php");
require_once '../../../../config/class.Conexion.php';
require_once '../../../clases/retencion/calss.TRD.php';
require_once '../../../clases/radicar/class.RadicaRecibido.php';
require_once '../../../clases/general/class.GeneralFuncionario.php';
require_once '../../../clases/varias/class.GestionAdjunto.php';
require_once "../../../clases/configuracion/class.ConfigOtras.php";
require_once "../../../clases/configuracion/class.ConfigTipoCorrespondencia.php";

$TRD = TRD::Listar(6, 0, $_SESSION['SesionFuncioDepenId'], 0, 0, "");

//CARGO LOS COMBOS DE LA SERIE, SUB SERIE Y TIPO DOCUMENTAL
$Combo_Series = "";
$Combo_Sub_Serie = "";
$Combo_Tipo_Documento = "";
foreach($TRD as $Item):
    $Combo_Series.= "<option value='".$Item['id_serie']."'>".$Item['cod_serie'].".".$Item['nom_serie']."</option>";
endforeach;

$Funcionario = Funcionario::Listar(6, 0, "", "", "", 0, 0, 0);
$Combo_Funcionarios = "";
foreach($Funcionario as $Item):
    $Combo_Funcionarios.= "<option value='".$Item['id_funcio_deta']."'>".$Item['nom_oficina']." - ".$Item['nom_funcio']." ".$Item['ape_funcio']."</option>";
endforeach;

//ELIMINO LOS TEMPORALES DEL ADJUNTO DEL USUARIO ACTUAL
$Archivo = new GestionAdjunto();
$Archivo -> set_Accion('ELIMINAR');
$Archivo -> set_IdFuncio($_SESSION['SesionFuncioDetaId']);
$Archivo -> Gestionar();

//ELIMINO LOS ARCHIVOS TEMPORALES DEL ADJUNTO DEL USUARIO ACTUAL            
deleteDirectory(MI_ROOT_TEMP_RELATIVA."/interna/".$_SESSION['SesionFuncioDetaId']."/");

$ConfiguracionOtras = ConfigOtras::Buscar();
if($ConfiguracionOtras->get_Incluir_TRD() == 0){

    $Combo_TipoDocumentos = "";

    require_once '../../../clases/retencion/class.TRDTipoDocumento.php';

    $Documentos = TipoDocumento::Listar(1, "", "");
    foreach($Documentos as $Item):
        $Combo_TipoDocumentos.= "<option value='".$Item['id_tipodoc']."'>".$Item['nom_tipodoc']."</option>";
    endforeach;
}

$TipoCorrespondencia = TipoCorrespondencia::Listar(1, "", 5, "");
$Combo_TipoCorrespondencia = "";
foreach($TipoCorrespondencia as $Item):
    $Combo_TipoCorrespondencia.= "<option value='".$Item['id_tipo']."'>".$Item['nom_tipo']."</option>";
endforeach;

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
    <link href="../../../../public/assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen"/>
    <!-- END CORE CSS FRAMEWORK -->
    <!-- BEGIN CSS TEMPLATE -->
    <link href="../../../../public/assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="../../../../public/assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="../../../../public/assets/css/custom-icon-set.css" rel="stylesheet" type="text/css" />
    <script src="../../../../public/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script> 
    <script type="text/javascript">
        $(document).ready(function()
        {
            Dropzone.autoDiscover = false;
            $("#dropzone").dropzone({
                url: "uploads.php?IdFuncio="+<?php echo $_SESSION['SesionFuncioDetaId']; ?>,
                addRemoveLinks: true,
                maxFileSize: 1000,
                dictResponseError: "Ha ocurrido un error en el server",
                acceptedFiles: 'image/*,.doc,.docx,.jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF,.rar,application/pdf,.psd',
                complete: function(file)
                {
                    if(file.status == "success"){
                        //alert("El siguiente archivo ha subido correctamente: " + file.name);
                    }
                },
                error: function(file)
                {
                    alert("Error subiendo el archivo " + file.name);
                },
                removedfile: function(file, serverFileName)
                {
                    var name = file.name;
                    $.ajax({
                        type: "POST",
                        url: "uploads.php?delete=true",
                        data: "filename="+name,
                        success: function(data){
                            var json = JSON.parse(data);
                            alert(json.res)
                            if(json.res == true)
                            {
                                var element;
                                (element = file.previewElement) != null ? 
                                element.parentNode.removeChild(file.previewElement) : 
                                false;
                                alert("El elemento fué eliminado: " + name); 
                            }
                        }
                    });
                }
            });
        });
    </script>
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
                    <div class="inner-wrapper" >            
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
                        <div class="col-md-12">
                            <div class="row">

                                <input name="accion" type="hidden" id="accion" value="RADICAR_COMUNCACION">
                                <input name="PropiePrincipla" type="hidden" id="PropiePrincipla" value="<?php echo $PropiePrincipla; ?>">
                                <input name="id_depen" type="hidden" id="id_depen" value="<?php echo $_SESSION['SesionFuncioDepenId']; ?>">
                                <input name="id_oficina" type="hidden" id="id_oficina" value="<?php echo $_SESSION['SesionFuncioOfiId']; ?>">
                                <input name="incluir_trd" type="hidden" id="incluir_trd" value="<?php echo $ConfiguracionOtras->get_Incluir_TRD(); ?>">
                                <input name="incluir_oficina_trd" type="hidden" id="incluir_oficina_trd" value="<?php echo $ConfiguracionOtras->get_Incluir_Oficina_TRD(); ?>">

                                <div class="col-md-8">

                                    <div class="grid simple">
                                        <div class="grid-title no-border">
                                            <div class="col-md-8">
                                                <h4>
                                                    <i class="fa fa-users text-info"></i>
                                                    <span class="semi-bold text-info"> Destino Del Documento</span>
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
                                        <div class="grid-body no-border page-sidebar-wrapper">
                                            <table width="90%" class="table table-striped table-flip-scroll cf" id="TblDestinatarios">
                                                <thead class="cf">
                                                    <tr>
                                                        <th width="2%">R</th>
                                                        <th width="55%">Funcionario</th>
                                                        <th width="40%">Oficina</th>
                                                        <th width="5%"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="fila-base" style="display: none;">
                                                        <td class="FuncioRespon"><input type="radio" name="edad" id="ChkFuncioRespon" value=""></td>
                                                        <td class="FuncioNum"></td>
                                                        <td class="FuncioOficina"></td>
                                                        <td class="FuncioEliminar">Eliminar</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="grid simple" style="min-height: 900px;">
                                        <div class="grid-body no-border">
                                            <div class="row-fluid" style="display:none;">
                                                <div class="slide-primary">
                                                    <input type="checkbox" name="switch" class="ios" checked="checked"/>
                                                </div>
                                                <div class="slide-success">
                                                    <input type="checkbox" name="switch" class="iosblue" checked="checked"/>
                                                </div>
                                            </div>

                                            <div class="grid-title no-border">
                                                <div class="col-md-8">
                                                    <h4>
                                                        <i class="fa fa-pencil text-info"></i>
                                                        <span class="semi-bold text-info"> Redaccion del PQRSF</span>
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

                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <textarea id="text-editor" placeholder="Ingrese aqui el texto del mensaje..." class="form-control" rows="19">
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">

                                    <div class="grid simple">
                                        <div class="grid-title no-border">
                                            <h4><i class="fa fa-folder text-info"></i><span class="semi-bold text-info">Clasificación Documental</span></h4>
                                        </div>

                                        <div class="grid-body no-border">
                                            <div class="row">
                                                <div class="row form-row">
                                                    <div class="col-md-12">
                                                        <select name="id_tipo_correspon" id="id_tipo_correspon" class="select2 form-control">
                                                            <option value="0">...::: Elije el Origen :::...</option>
                                                            <?php echo $Combo_TipoCorrespondencia; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form-row">
                                                    <div class="col-md-12">
                                                        <input name="entidad_funcio" type="text" class="form-control" id="entidad_funcio" placeholder="Persona o intitucion a quien va dirigida la queja">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="grid simple">
                                        <div class="grid-title no-border">
                                            <h4>
                                                <i class="fa fa-male text-info"></i>
                                                <span class="semi-bold text-info">Tercero</span>
                                            </h4>
                                        </div>
                                        <div class="grid-body no-border">
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <input name="id_tercero" id="id_tercero" type="hidden">
                                                    <input name="cc_nit" type="text" class="form-control" id="cc_nit" placeholder="C.c / NIt">
                                                </div>
                                                <div class="form-group col-md-7">
                                                    <input name="remite_contacto" type="text" class="form-control" id="remite_contacto" placeholder="Contacto">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <div class="btn-group">
                                                        <button class="btn btn-success btn-demo-space btn-sm btn-small">
                                                            <i class="fa fa-ellipsis-v"></i>
                                                        </button>
                                                        <button class="btn btn-success dropdown-toggle btn-demo-space btn-sm btn-small" data-toggle="dropdown">
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a href="#" data-toggle="modal" data-target="#myModalTerceroNatural" id="BtnBuscarTerceroNatural">Buscar tercero natural</a>
                                                            </li>
                                                            <li>
                                                                <a href="#" data-toggle="modal" data-target="#myModalTerceroJuridico" id="BtnBuscarTerceroJuridico">Buscar tercero juridico</a>
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
                                            <div class="row" id="DivRemiteRazoSoci">
                                                <div class="form-group col-md-12">
                                                    <input name="remite_razo_soci" type="text" class="form-control" id="remite_razo_soci" placeholder="Razón Social">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <input name="remite_dir" type="text" class="form-control" id="remite_dir" placeholder="Dirección">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <input name="remite_tel" type="text" class="form-control" id="remite_tel" placeholder="Teléfono">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <input name="remite_cel" type="text" class="form-control" id="remite_cel" placeholder="Móvil / Pbx">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="grid simple">
                                        <div class="grid-title no-border">
                                            <h4><i class="fa fa-paperclip"></i>
                                                <span class="semi-bold">Adjunto</span>
                                            </h4>
                                        </div>
                                        <div class="grid-body no-border">
                                            <br>
                                            <div class="row-fluid">
                                                <div class="row">
                                                    <div id="dropzone" class="dropzone"></div>
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
            <!-- BEGIN CORE JS FRAMEWORK-->
            <script src="../../../mi_archivo/bandeja/interna/radicar/funciones.ajax.js"></script>
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