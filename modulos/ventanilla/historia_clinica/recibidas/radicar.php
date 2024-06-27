<?php
session_start();
include "../../../../config/class.Conexion.php";
include "../../../../config/variable.php";
include "../../../../config/funciones_seguridad.php";
require_once '../../../clases/configuracion/class.ConfigFormaEnvio.php';
require_once '../../../clases/configuracion/class.ConfigParentesco.php';
require_once "../../../clases/configuracion/class.ConfigOtras_Respon_HC.php";
require_once "../../../clases/configuracion/class.ConfigDepartamento.php";

$FormaLlegada = FormaEnvio::Listar(1, 0);

//CARGO LOS COMBOS DE LA LA FORMA DE LLGADA DE LA CORRESPONDENCIA
$Combo_FormaLlegada = "";
foreach($FormaLlegada as $Item):
    $Combo_FormaLlegada.= "<option value='".$Item['id_formaenvio']."'>".$Item['nom_formaenvi']."</option>";
endforeach;

$ResponsableHC = ConfigOtrasResponsableHC::Listar(1, "");
$Combo_ResponsableHC = "";

foreach($ResponsableHC as $Item):
    $Combo_ResponsableHC.= "<option value='".$Item['id_funcio_deta']."'>".$Item['nom_depen']." - ".$Item['nom_funcio']." ".$Item['ape_funcio']."</option>";
endforeach;

$Parenesco = Parentesco::Listar(1, "", "");
$Combo_Parentesco = "";
foreach($Parenesco as $Item):
    $Combo_Parentesco.= "<option value='".$Item['id_paren']."'>".$Item['nom_paren']."</option>";
endforeach;

$Departamento = Departamento::Listar();
$Combo_Departamentos = "";
foreach($Departamento as $Item):
    $Combo_Departamentos.= "<option value='".$Item['id_depar']."'>".$Item['nom_depar']."</option>";
endforeach;
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- BEGIN PLUGIN CSS -->
    <link href="../../../../public/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="../../../../public/assets/plugins/boostrap-checkbox/css/bootstrap-checkbox.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="../../../../public/assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css"/>
    <!-- END PLUGIN CSS -->

    <!-- BEGIN CORE CSS FRAMEWORK -->
    <link href="../../../../public/assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="../../../../public/assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
    <link href="../../../../public/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
    <link href="../../../../public/assets/css/animate.min.css" rel="stylesheet" type="text/css"/>
    <link href="../../../../public/assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css"/>
    <link href="../../../../public/assets/plugins/ios-switch/ios7-switch.css" rel="stylesheet" type="text/css" media="screen">
    <!-- END CORE CSS FRAMEWORK -->

    <!-- BEGIN CSS TEMPLATE -->
    <link href="../../../../public/assets/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="../../../../public/assets/css/responsive.css" rel="stylesheet" type="text/css"/>
    <link href="../../../../public/assets/css/custom-icon-set.css" rel="stylesheet" type="text/css"/>
    <!-- END CSS TEMPLATE -->

</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body class="inner-menu-always-open">
    <!-- BEGIN HEADER -->
    <div class="header navbar navbar-inverse "> 
        <!-- BEGIN TOP NAVIGATION BAR -->
        <div class="navbar-inner">
            <?php include_once '../../../../config/cabeza_ventanilla_form.php'; ?>
        </div>
        <!-- END TOP NAVIGATION BAR --> 
    </div>
    <!-- END HEADER --> 
    <!-- BEGIN CONTAINER -->
    <div class="page-container row-fluid"> 
        <!-- BEGIN SIDEBAR -->
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
                    <div class="inner-wrapper" >    
                        <a href="radicar.php" class="btn btn-block btn-primary" >
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
                    <ul class="small-items">
                        <li class="">
                            <a href="../pendientes/index.php"> 
                                <span class="btn btn-success btn-sm btn-small label label-important">
                                    <i class="fa fa-bullhorn"></i> <span>Solicitudes de HC<br> pendientes por entregar</span>
                                </span>
                            </a>
                        </li>
                        <li class="">
                            <a href="../../recibida/prontos_a_vencer/index.php">
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
            <div id="portlet-config" class="modal hide">
                <div class="modal-header">
                    <button data-dismiss="modal" class="close" type="button"></button>
                    <h3>Widget Settings</h3>
                </div>
                <div class="modal-body"> Widget settings form goes here </div>
            </div>
            <div class="clearfix"></div>
            <div class="content">
                <ul class="breadcrumb">
                    <li>
                        <p>Tú estas</p>
                    </li>
                    <li>
                        <a href="#" class="active">Radicar - Solicitud de historia clínica.</a>
                    </li>
                </ul>
                <div id="DivAlertas"></div>
                <form role="form" name="FrmDatos" id="FrmDatos">                      
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <input name="accion" type="hidden" id="accion" value="GUARDAR_SOLIC_HC">
                                        <input name="PropiePrincipla" type="hidden" id="PropiePrincipla" value="<?php echo $PropiePrincipla; ?>">
                                        <input name="id_depen" type="hidden" id="id_depen">
                                        <div class="col-md-8">
                                            <div class="grid simple">
                                                <div class="grid-title no-border">
                                                    <h4><i class="fa fa-male text-info"></i><span class="semi-bold text-info">Paciente</span></h4>
                                                </div>
                                                <div class="grid-body no-border">
                                                    <div class="row">
                                                        <div class="form-group col-md-3">
                                                            <input name="id_paciente" id="id_paciente" type="hidden">
                                                            <input name="num_docu_paciente" type="text" class="form-control" id="num_docu_paciente" placeholder="# Documento">
                                                        </div>
                                                        <div class="form-group col-md-7">
                                                            <input name="nombre_paciente" type="text" class="form-control" id="nombre_paciente" placeholder="Paciente">
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
                                                                        <a href="#" data-toggle="modal" data-target="#myModalPacientes" id="BtnBuscarPaciente">Buscar paciente</a>
                                                                    </li>
                                                                    <li class="divider"></li>
                                                                    <li>
                                                                        <a href="#" data-toggle="modal" data-target="#myModalNuevoPaciente" id="BtnNuevoPaciente">Nuevo paciente</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="grid simple">
                                                <div class="grid-title no-border">
                                                    <h4>
                                                        <i class="fa fa-list text-info"></i>
                                                        <span class="semi-bold text-info">Datos de la solicitud</span>
                                                    </h4>
                                                </div>
                                                <div class="grid-body no-border">
                                                    <div class="row-fluid" style="display:none">
                                                        <div class="slide-primary">
                                                            <input type="checkbox" name="switch" class="ios" checked="checked"/>
                                                        </div>
                                                        <div class="slide-success">
                                                            <input type="checkbox" name="switch" class="iosblue" checked="checked"/>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <div class="input-append success date col-md-10 col-lg-6">
                                                                <input type="text" class="form-control" id="desde" name="desde" placeholder="Desde">
                                                                <span class="add-on">
                                                                    <span class="arrow"></span>
                                                                    <i class="fa fa-th"></i>
                                                                </span>
                                                            </div>

                                                            <div class="input-append success date col-md-10 col-lg-6">
                                                                <input type="text" class="form-control" id="hasta" name="hasta" placeholder="Hasta">
                                                                <span class="add-on">
                                                                    <span class="arrow"></span>
                                                                    <i class="fa fa-th"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <input name="servicio" type="text" class="form-control" id="servicio" placeholder="Servicio">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-2">
                                                            <input name="num_anexos" type="text" class="form-control auto" id="num_anexos" placeholder="# De Anexos" data-v-max="999" data-v-min="0">
                                                        </div>
                                                        <div class="form-group col-md-10">
                                                            <input name="observa_anexo" type="text" class="form-control" id="observa_anexo" placeholder="Ingrese aquí las observaciones de los anexos">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <textarea name="asunto" rows="2" class="form-control" id="asunto" placeholder="Ingrese aquí el asunto del documento..."></textarea>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <div class="checkbox checkbox check-success ">
                                                                <input name="autorizo_envio_email_pacien" type="checkbox" id="autorizo_envio_email_pacien">
                                                                <label for="autorizo_envio_email_pacien">Autorizo enviar a mi correo electrónico.</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="grid simple" style="min-height: 300px;" >
                                                <div class="grid-title no-border">
                                                    <h4><i class="fa fa-male text-info"></i>
                                                        <span class="semi-bold text-info">Tercero facultado</span>
                                                    </h4>
                                                    <div class="pull-right">
                                                       <button class="btn btn-danger btn-xs btn-mini" type="button" id="BtnEliminarTercero" name="BtnEliminarTercero">
                                                        <i class="fa fa-trash-o"></i> 
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="grid-body no-border">
                                                <div class="row">
                                                    <div class="form-group col-md-3">
                                                        <input name="id_tercero" id="id_tercero" type="hidden">
                                                        <input name="cc_nit_tercero" type="text" class="form-control" id="cc_nit_tercero" placeholder="C.c / NIt">
                                                    </div>
                                                    <div class="form-group col-md-5">
                                                        <input name="tercero_contacto" type="text" class="form-control" id="tercero_contacto" placeholder="Contacto">
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <select name="id_paren" id="id_paren" class="select2 form-control">
                                                            <option value="NULL">...::: Parentesco :::...</option>
                                                            <?php echo $Combo_Parentesco; ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <div class="btn-group">
                                                            <button class="btn btn-success btn-demo-space btn-sm btn-small"><i class="fa fa-ellipsis-v"></i></button>
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
                                                                    <a href="#" data-toggle="modal" data-target="#myModalNuevoTerceroJuridicoConEmpresa" id="BtnNuevoTerceroJuridicoConEmpresa">Nuevo tercero con empresa nueva</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row" id="DivRemiteRazoSoci">
                                                    <div class="form-group col-md-12">
                                                        <input name="tercero_razo_soci" type="text" class="form-control" id="tercero_razo_soci" placeholder="Razón Social">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <div class="checkbox checkbox check-success ">
                                                            <input name="autorizo_envio_email_terce" type="checkbox" id="autorizo_envio_email_terce">
                                                            <label for="autorizo_envio_email_terce">Autorizo enviar a mi correo electrónico.</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="grid simple">
                                            <div class="grid-title no-border">
                                                <h4><i class="fa fa-truck text-info"></i><span class="semi-bold text-info">Tipo de Llegada</span></h4>
                                            </div>
                                            <div class="grid-body no-border">
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <select name="id_forma_llegada" id="id_forma_llegada" class="select2 form-control">
                                                            <option value="0">...::: Como llego la correspondencia :::...</option>
                                                            <?php echo $Combo_FormaLlegada; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="grid simple">
                                            <div class="grid-title no-border">
                                                <h4>
                                                    <i class="fa fa-folder text-info"></i>
                                                    <span class="semi-bold text-info">Responsable</span>
                                                </h4>
                                            </div>
                                            <div class="grid-body no-border">
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <div class="controls">
                                                            <select name="id_responsable" id="id_responsable" class="select2 form-control">
                                                                <option value="0">...::: Responsable :::...</option>
                                                                <?php echo $Combo_ResponsableHC; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
    <!-- END PAGE --> 
    <!-- BEGIN CHAT --> 
    <div class="chat-window-wrapper">
        <?php include_once '../../../chat/chat.php'; ?>
    </div>
    <!-- END CHAT -->
</div>
<!-- END CONTAINER --> 

<!-- INICIO MODALES --> 
<!-- BEGIN MODAL PARA LOS PACIENTES-->
<div class="modal fade" id="myModalPacientes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <br>
                <i class="fa fa-users fa-2x"></i>
                <h4 id="myModalLabel" class="semi-bold">Pacientes.</h4>
                <p class="no-margin">Elige el paciente de la solicitud de la HC</p>
                <br>
            </div>
            <div class="modal-body">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="grid simple ">
                            <div class="grid-body ">
                                <div class="row form-row">
                                    <div id="DivAlertasPacientes"></div>
                                    <div class="col-md-12">
                                        <input name="TxtBusPacientes" type="text" class="form-control" id="TxtBusPacientes"
                                        placeholder="Ingrese aqui el criterio de búsqueda para el paciente.">
                                    </div>
                                </div>
                                <div class="row form-row">
                                    <div class="col-md-12">
                                        <div id="DivPacientes"></div>
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
<!-- END MODAL PARA PACIENTES -->
<!-- INICIO MODAL PARA NUEVO PACIENTE -->
<div class="modal fade" id="myModalNuevoPaciente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <br>
                <i class="fa fa-credit-card fa-2x"></i>
                <h4 id="myModalLabel" class="semi-bold">Nuevo Paciente</h4>
            </div>
            <form role="form" name="FrmDatosPacienteNatural" id="FrmDatosPacienteNatural">
                <div class="modal-body">
                    <div id="DivAlertaNuevoPaciente"></div>
                    <input type="hidden" name="accion_remite" id="accion_remite" value="NUEVO_TERCERO_NATURAL">
                    <div class="grid-body no-border">
                        <div class="row form-row">
                            <div class="col-md-3">
                                <input name="num_docu_natural" type="text" class="form-control input-sm" id="num_docu_natural"
                                placeholder="# De Documento">
                            </div>
                            <div class="col-md-7">
                                <input name="nom_contac_natural" type="text" class="form-control input-sm" id="nom_contac_natural"
                                placeholder="Nombres Del Contacto">
                            </div>
                        </div>
                        <div class="row form-row">
                            <div class="col-md-12">
                                <input name="dir_natural" type="text" class="form-control input-sm" id="dir_natural"
                                placeholder="Dirección">
                            </div>
                        </div>
                        <div class="row form-row">
                            <div class="col-md-6">
                                <select name="id_depar_natural" id="id_depar_natural" class="select2 form-control input-sm"  >
                                    <option value="0">...::: Elije el Departamento :::...</option>
                                    <?php echo $Combo_Departamentos;?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select name="id_muni_natural" id="id_muni_natural" class="select2 form-control input-sm"  >
                                    <option value="0">...::: Elije el Municipio :::...</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-row">
                            <div class="col-md-6">
                                <input name="tel_natural" type="text" class="form-control input-sm" id="tel_natural"
                                placeholder="Teléfono">
                            </div>
                            <div class="col-md-6">
                                <input name="cel_natural" type="text" class="form-control input-sm" id="cel_natural"
                                placeholder="Celular">
                            </div>
                        </div>
                        <div class="row form-row">
                            <div class="col-md-12">
                                <input name="email_natural" type="email" class="form-control input-sm" id="email_natural"
                                placeholder="E - Mail">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="BtnCancelarNuevoPaciente">Cancelar</button>
                    <button type="button" class="btn btn-success" id="BtnGuardarPaciente">
                        <i class="fa fa-save"></i> Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- FIN MODAL PARA NUEVO PACIENTE -->

<!-- BEGIN MODAL PARA LOS TERCERO NATURALES-->
<div class="modal fade" id="myModalTerceroNatural" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <br>
                <i class="fa fa-users fa-2x"></i>
                <h4 id="myModalLabel" class="semi-bold">Tercero Natural.</h4>
                <p class="no-margin">Elige el tercero natural que hace la solicitud de la historia clínica</p>
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
<!-- END MODAL PARA RESPONSABLES -->
<!-- BEGIN MODAL PARA LOS TERCERO JURIDICO-->
<div class="modal fade" id="myModalTerceroJuridico" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <br>
                <i class="fa fa-users fa-2x"></i>
                <h4 id="myModalLabel" class="semi-bold">Tercero Juridico.</h4>
                <p class="no-margin">Elige el tercero jurídico que hace la solicitud de la historia clínica</p>
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
<!-- END MODAL PARA LOS TERCERO JURIDICO-->
<!-- INICIO MODAL PARA NUEVO TERCERO NATURAL -->
<div class="modal fade" id="myModalNuevoTerceroNatural" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <br>
                <i class="fa fa-credit-card fa-2x"></i>
                <h4 id="myModalLabel" class="semi-bold">Nuevo Tercero Natural</h4>
            </div>
            <form role="form" name="FrmDatosTerceroNatural" id="FrmDatosTerceroNatural">
                <div class="modal-body">
                    <div id="DivAlertaTerceroNatural"></div>
                    <input type="hidden" name="accion_remite" id="accion_remite" value="NUEVO_Tercero_NATURAL">
                    <div class="grid-body no-border">
                        <div class="row form-row">
                            <div class="col-md-4">
                                <input name="num_docu_natural" type="text" class="form-control input-sm" id="num_docu_natural"
                                placeholder="# De Documento">
                            </div>
                            <div class="col-md-8">
                                <input name="nom_contac_natural" type="text" class="form-control input-sm" id="nom_contac_natural"
                                placeholder="Nombres Del Contacto">
                            </div>
                            <div class="col-md-12">
                                <input name="dir_natural" type="text" class="form-control input-sm" id="dir_natural"
                                placeholder="Dirección">
                            </div>
                        </div>
                        <div class="row form-row">
                            <div class="col-md-6">
                                <select name="id_depar_natural" id="id_depar_natural" class="select2 form-control input-sm"  >
                                    <?php echo $Combo_Departamentos;?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select name="id_muni_natural" id="id_muni_natural" class="select2 form-control input-sm"  >
                                </select>
                            </div>
                        </div>
                        <div class="row form-row">
                            <div class="col-md-6">
                                <input name="tel_natural" type="text" class="form-control input-sm" id="tel_natural"
                                placeholder="Teléfono">
                            </div>
                            <div class="col-md-6">
                                <input name="cel_natural" type="text" class="form-control input-sm" id="cel_natural"
                                placeholder="Celular">
                            </div>
                        </div>
                        <div class="row form-row">
                            <div class="col-md-12">
                                <input name="email_natural" type="email" class="form-control input-sm" id="email_natural"
                                placeholder="E - Mail">
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
                <h4 id="myModalLabel" class="semi-bold">Nuevo Tercero Juridico</h4>
            </div>
            <form role="form" name="FrmDatosTerceroJuridico" id="FrmDatosTerceroJuridico">
                <div class="modal-body">
                    <div id="DivAlertaTerceroJutidico"></div>
                    <input type="hidden" name="accion_remite" id="accion_remite" value="NUEVO_TERCERO_JURIDICO">
                    <div class="grid-body no-border">
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
                                <input name="nom_contac_juridico" type="text" class="form-control input-sm" id="nom_contac_juridico"
                                placeholder="Contacto">
                            </div>
                            <div class="col-md-4">
                                <input name="cargo_juridico" type="text" class="form-control input-sm" id="cargo_juridico"
                                placeholder="Cargo">
                            </div>
                            <div class="col-md-12">
                                <input name="dir_contac_juridico" type="text" class="form-control input-sm" id="dir_contac_juridico"
                                placeholder="Dirección">
                            </div>
                        </div>
                        <div class="row form-row">
                            <div class="col-md-6">
                                <input name="tel_contac_juridico" type="text" class="form-control input-sm" id="tel_contac_juridico"
                                placeholder="Teléfono">
                            </div>
                            <div class="col-md-6">
                                <input name="cel_contac_juridico" type="text" class="form-control input-sm" id="cel_contac_juridico"
                                placeholder="Celular">
                            </div>
                        </div>
                        <div class="row form-row">
                            <div class="col-md-12">
                                <input name="email_contac_juridico" type="email" class="form-control input-sm" id="email_contac_juridico"
                                placeholder="E - Mail">
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
                <h4 id="myModalLabel" class="semi-bold">Nuevo Tercero Juridico</h4>
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
                                            <input name="nit" type="text" class="form-control input-sm" id="nit"
                                            placeholder="Nit">
                                        </div>
                                        <div class="col-md-8">
                                            <input name="razo_soci" type="text" class="form-control input-sm" id="razo_soci"
                                            placeholder="Razón social">
                                        </div>
                                        <div class="col-md-12">
                                            <input name="dir_juridico_empresa" type="text" class="form-control input-sm" id="dir_juridico_empresa"
                                            placeholder="Dirección">
                                        </div>
                                    </div>
                                    <div class="row form-row">
                                        <div class="col-md-6">
                                            <select name="id_depar_juridico_empresa" id="id_depar_juridico_empresa" class="select2 form-control input-sm"  >
                                                <option value="0">...::: Elije el Departamento :::...</option>
                                                <?php echo $Combo_Departamentos;?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <select name="id_muni_juridico_empresa" id="id_muni_juridico_empresa" class="select2 form-control input-sm"  >
                                                <option value="0">...::: Elije el Municipio :::...</option>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row form-row">
                                        <div class="col-md-4">
                                            <input name="tel_juridico_empresa" type="text" class="form-control input-sm" id="tel_juridico_empresa"
                                            placeholder="Teléfono">
                                        </div>
                                        <div class="col-md-4">
                                            <input name="cel_juridico_empresa" type="text" class="form-control input-sm" id="cel_juridico_empresa"
                                            placeholder="Celular">
                                        </div>
                                        <div class="col-md-4">
                                            <input name="fax_juridico_empresa" type="text" class="form-control input-sm" id="fax_juridico_empresa"
                                            placeholder="Fax">
                                        </div>
                                    </div>
                                    <div class="row form-row">
                                        <div class="col-md-12">
                                            <input name="email_juridico_empresa" type="email" class="form-control input-sm" id="email_juridico_empresa"
                                            placeholder="E - Mail">
                                        </div>
                                    </div>
                                    <div class="row form-row">
                                        <div class="col-md-12">
                                            <input name="web_juridico" type="email" class="form-control input-sm" id="web_juridico"
                                            placeholder="Web">
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
                                            <input name="nom_contac_juridico_empresa" type="text" class="form-control input-sm" id="nom_contac_juridico_empresa"
                                            placeholder="Contacto">
                                        </div>
                                        <div class="col-md-4">
                                            <input name="cargo_juridico_empresa" type="text" class="form-control input-sm" id="cargo_juridico_empresa"
                                            placeholder="Cargo">
                                        </div>
                                        <div class="col-md-12">
                                            <input name="dir_contac_juridico_empresa" type="text" class="form-control input-sm" id="dir_contac_juridico_empresa"
                                            placeholder="Dirección">
                                        </div>
                                    </div>
                                    <div class="row form-row">
                                        <div class="col-md-6">
                                            <input name="tel_contac_juridico_empresa" type="text" class="form-control input-sm" id="tel_contac_juridico_empresa"
                                            placeholder="Teléfono">
                                        </div>
                                        <div class="col-md-6">
                                            <input name="cel_contac_juridico_empresa" type="text" class="form-control input-sm" id="cel_contac_juridico_empresa"
                                            placeholder="Celular">
                                        </div>
                                    </div>
                                    <div class="row form-row">
                                        <div class="col-md-12">
                                            <input name="email_contac_juridico_empresa" type="email" class="form-control input-sm" id="email_contac_juridico_empresa"
                                            placeholder="E - Mail">
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

<!-- END MODALES --> 

<script src="../../../../public/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script> 
<script src="funciones.ajax.js"></script>
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

<!-- BEGIN CORE TEMPLATE JS --> 
<script src="../../../../public/assets/js/core.js" type="text/javascript"></script> 
<script src="../../../../public/assets/js/chat.js" type="text/javascript"></script> 
<script src="../../../../public/assets/js/demo.js" type="text/javascript"></script> 
<!-- END CORE TEMPLATE JS --> 
<script>
    $(document).ready(function() {
        $("#quick-access").css("bottom","0px");				
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