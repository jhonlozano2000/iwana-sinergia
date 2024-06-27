<?php
session_start();
include "../../../../config/variable.php";
include "../../../../config/funciones.php";
include "../../../../config/funciones_seguridad.php";
include "../../../../config/class.Conexion.php";
require_once '../../../clases/radicar/class.RadicaRecibido.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>...::: Iwana - Bandeja :::...</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- BEGIN PLUGIN CSS -->
    <link href="../../../../public/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="../../../../public/assets/plugins/jquery-datatable/css/jquery.dataTables.css" rel="stylesheet" type="text/css"/>
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
    
</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body class="inner-menu-always-open extended-layout">
    <!-- BEGIN HEADER -->
    <div class="header navbar navbar-inverse "> 
        <!-- BEGIN TOP NAVIGATION BAR -->
        <div class="navbar-inner">
            <div class="header-seperation"> 
                <ul class="nav pull-left notifcation-center" id="main-menu-toggle-wrapper" style="display:none">	
                    <li class="dropdown"> 
                        <a id="main-menu-toggle" href="#main-menu"  class="" > 
                            <div class="iconset top-menu-toggle-white"></div> 
                        </a> 
                    </li>		 
                </ul>
                <!-- BEGIN LOGO -->	
                <a href="../../../../panel.php">
                    <img src="../../../../public/assets/img/logo.png" class="logo" alt=""  data-src="../../../../../public/assets/img/logo.png" data-src-retina="../../../../../public/assets/img/logo2x.png" width="106" height="21"/>
                </a>
                <!-- END LOGO --> 
                <ul class="nav pull-right notifcation-center">	
                    <li class="dropdown" id="header_task_bar"> 
                        <a href="../../../../panel.php" class="dropdown-toggle active" data-toggle=""> 
                            <div class="iconset top-home"></div> 
                        </a> 
                    </li>
                    <li class="dropdown" id="header_inbox_bar" > 
                        <a href="../../../../../public/assets/img/loading.gif" class="dropdown-toggle" > 
                            <div class="iconset top-messages"></div>  
                            <span class="badge" id="msgs-badge">2</span> 
                        </a>
                    </li>
                    <li class="dropdown" id="portrait-chat-toggler" style="display:none"> 
                        <a href="#sidr" class="chat-menu-toggle"> 
                            <div class="iconset top-chat-white "></div> 
                        </a> 
                    </li>        
                </ul>
            </div>
            <!-- END RESPONSIVE MENU TOGGLER --> 
            <div class="header-quick-nav" > 
                <!-- BEGIN TOP NAVIGATION MENU -->
                <div class="pull-left"> 
                    <ul class="nav quick-section">
                        <li class="quicklinks"> 
                            <a href="#" class="" id="layout-condensed-toggle" >
                                <div class="iconset top-menu-toggle-dark"></div>
                            </a> 
                        </li>
                    </ul>
                    <ul class="nav quick-section">
                        <li class="m-r-10 input-prepend inside search-form no-boarder">
                            <span class="add-on"> 
                                <span class="iconset top-search"></span>
                            </span>
                            <input name="" type="text"  class="no-boarder " placeholder="Buscar" style="width:250px;">
                        </li>
                    </ul>
                </div>
                <!-- END TOP NAVIGATION MENU -->
                <!-- BEGIN CHAT TOGGLER -->
                <div class="pull-right"> 
                    <div class="chat-toggler">	
                        <a href="#" class="dropdown-toggle" id="my-task-list" data-placement="bottom"  data-content='' data-toggle="dropdown" data-original-title="Notifications">
                            <div class="user-details"> 
                                <div class="username">
                                    <span class="badge badge-important">3</span> 
                                    <?php echo $_SESSION[ 'SesionFuncioNom']; ?>
                                    <span class="bold"><?php echo $_SESSION['SesionFuncioApe']; ?></span>									
                                </div>						
                            </div> 
                            <div class="iconset top-down-arrow"></div>
                        </a>	
                        <div id="notification-list" style="display:none">
                            <div style="width:300px">
                                <div class="notification-messages info">
                                    <div class="user-profile">
                                        <img src="../../../../public/assets/img/profiles/d.jpg"  alt="" data-src="../../../../../public/assets/img/profiles/d.jpg" data-src-retina="../../../../../public/assets/img/profiles/d2x.jpg" width="35" height="35">
                                    </div>
                                    <div class="message-wrapper">
                                        <div class="heading">
                                            David Nester - Commented on your wall
                                        </div>
                                        <div class="description">
                                            Meeting postponed to tomorrow
                                        </div>
                                        <div class="date pull-left">
                                            A min ago
                                        </div>										
                                    </div>
                                    <div class="clearfix"></div>									
                                </div>	
                                <div class="notification-messages danger">
                                    <div class="iconholder">
                                        <i class="icon-warning-sign"></i>
                                    </div>
                                    <div class="message-wrapper">
                                        <div class="heading">
                                            Server load limited
                                        </div>
                                        <div class="description">
                                            Database server has reached its daily capicity
                                        </div>
                                        <div class="date pull-left">
                                            2 mins ago
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>	
                                <div class="notification-messages success">
                                    <div class="user-profile">
                                        <img src="../../../../public/assets/img/profiles/h.jpg"  alt="" data-src="../../../../../public/assets/img/profiles/h.jpg" data-src-retina="../../../../../public/assets/img/profiles/h2x.jpg" width="35" height="35">
                                    </div>
                                    <div class="message-wrapper">
                                        <div class="heading">
                                            You haveve got 150 messages
                                        </div>
                                        <div class="description">
                                            150 newly unread messages in your inbox
                                        </div>
                                        <div class="date pull-left">
                                            An hour ago
                                        </div>									
                                    </div>
                                    <div class="clearfix"></div>
                                </div>							
                            </div>				
                        </div>
                        <div class="profile-pic">
                         <?php
                         if($_SESSION[ 'SesionFuncioSexo']=='M'){
                            ?>
                            <img src="../../../../public/assets/img/profiles/avatar5.png" alt="" data-src="../../../../../public/assets/img/profiles/avatar5.png" data-src-retina="../../../../../public/assets/img/profiles/avatar5_small2x.png" width="35" height="35" />
                            <?php
                        }else{
                            ?>
                            <img src="../../../../public/assets/img/profiles/avatar2.png" alt="" data-src="../../../../../public/assets/img/profiles/avatar2.png" data-src-retina="../../../../../public/assets/img/profiles/avatar2_small2x.png" idth="35" height="35" />
                            <?php
                        }
                        ?>
                    </div>       			
                </div>
                <ul class="nav quick-section ">
                    <li class="quicklinks"> 
                        <a data-toggle="dropdown" class="dropdown-toggle  pull-right " href="#" id="user-options">						
                            <div class="iconset top-settings-dark "></div> 	
                        </a>
                        <ul class="dropdown-menu  pull-right" role="menu" aria-labelledby="user-options">
                            <li><a href="../../../../public/user-profile.html"> My Account</a>
                            </li>
                            <li><a href="../../../../public/calender.html"> My Calendar</a>
                            </li>
                            <li><a href="../../../../public/email.html"> My Inbox&nbsp;&nbsp;<span class="badge badge-important animated bounceIn">2</span></a>
                            </li>
                            <li class="divider"></li>                
                            <li><a href="../../../../logout.php"><i class="fa fa-power-off"></i>&nbsp;&nbsp;Log Out</a></li>
                        </ul>
                    </li> 
                    <li class="quicklinks"> 
                        <span class="h-seperate"></span>
                    </li> 
                    <li class="quicklinks"> 	
                        <a id="chat-menu-toggle" href="#sidr" class="chat-menu-toggle" >
                            <div class="iconset top-chat-dark ">
                                <span class="badge badge-important hide" id="chat-message-count">1</span>
                            </div>
                        </a> 
                        <div class="simple-chat-popup chat-menu-toggle hide" >
                            <div class="simple-chat-popup-arrow"></div><div class="simple-chat-popup-inner">
                                <div style="width:100px">
                                    <div class="semi-bold">David Nester</div>
                                    <div class="message">Hey you there </div>
                                </div>
                            </div>
                        </div>
                    </li> 
                </ul>
            </div>
            <!-- END CHAT TOGGLER -->
        </div> 
        <!-- END TOP NAVIGATION MENU --> 

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
                <div class="profile-wrapper">
                    <?php
                    if($_SESSION[ 'SesionFuncioSexo']=='M'){
                        ?>
                        <img src="../../../../public/assets/img/profiles/avatar5.png" alt="" data-src="../../../../../public/assets/img/profiles/avatar5.png" data-src-retina="../../../../../public/assets/img/profiles/avatar5_small2x.png" width="35" height="35" />
                        <?php
                    }else{
                        ?>
                        <img src="../../../../public/assets/img/profiles/avatar2.png" alt="" data-src="../../../../../public/assets/img/profiles/avatar2.png" data-src-retina="../../../../../public/assets/img/profiles/avatar2_small2x.png" idth="35" height="35" />
                        <?php
                    }
                    ?>
                </div>
                <div class="user-info">
                    <?php
                    if($_SESSION[ 'SesionFuncioSexo']=='M' ){
                        ?>
                        <div class="greeting">
                            Bienvenido
                        </div>
                        <?php
                    }else{
                        ?>
                        <div class="greeting">
                            Bienvenida
                        </div>
                        <?php
                    }
                    ?>
                    <div class="username">
                        <span class="semi-bold">
                            <?php echo $_SESSION['SesionFuncioNom']; ?>
                        </span>
                    </div>
                    <div class="status">
                        Estado
                        <a href="#">
                            <div class="status-icon green">
                            </div>
                        En linea </a>
                    </div>
                </div>
            </div>
            <!-- END MINI-PROFILE -->
            <!-- BEGIN SIDEBAR MENU -->	
            <p class="menu-title">BROWSE 
                <span class="pull-right">
                    <a href="javascript:;"><i class="fa fa-refresh"></i></a>
                </span>
            </p>
            <ul>
                <li class="start "> 
                    <a href="../../../../public/index.html"> <i class="icon-custom-home"></i> 
                        <span class="title">Dashboard</span> 
                        <span class="selected"></span> 
                        <span class="arrow "></span> 
                    </a> 
                    <ul class="sub-menu">
                        <li > 
                            <a href="../externa/recibidas/index.php"> Correspondencia recibida</a> 
                        </li>
                        <li class=""> 
                            <a href="../externa/enviadas/index.php"> Correspondencia enviada<span class=" label label-info pull-right m-r-30">NEW</span></a>
                        </li>
                        <li class=""> 
                            <a href="../interna/recibidas/index.php"> Correspondencia interna<span class=" label label-info pull-right m-r-30">NEW</span></a>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="side-bar-widgets">
                <p class="menu-title">FOLDER <span class="pull-right"><a href="#" class="create-folder"> 
                    <i class="fa fa-plus"></i></a></span>
                </p>
                <ul class="folders">
                    <li><a href="#"><div class="status-icon green"></div> My quick tasks </a></li>
                    <li><a href="#"><div class="status-icon red"></div> To do list </a></li>
                    <li><a href="#"><div class="status-icon blue"></div> Projects </a></li>
                    <li class="folder-input" style="display:none">
                        <input type="text" placeholder="Name of folder" class="no-boarder folder-name" name="" >
                    </li>
                </ul>
                <p class="menu-title">PROJECTS </p>
                <div class="status-widget">
                    <div class="status-widget-wrapper">
                        <div class="title">Freelancer<a href="#" class="remove-widget">
                            <i class="icon-custom-cross"></i></a>
                        </div>
                        <p>Redesign home page</p>
                    </div>
                </div>
                <div class="status-widget">
                    <div class="status-widget-wrapper">
                        <div class="title">envato<a href="#" class="remove-widget">
                            <i class="icon-custom-cross"></i></a>
                        </div>
                        <p>Statistical report</p>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>
            <!-- END SIDEBAR MENU --> 
        </div>

        <div class="inner-menu nav-collapse">   
            <div id="inner-menu">
                <div class="inner-wrapper" >    
                    <a href="../../../../public/send_email.html" class="btn btn-block btn-primary" >
                        <span class="bold">REDACTAR</span>
                    </a>
                </div>
                <div class="inner-menu-content">
                    <p class="menu-title">MIS COMUNICACIONES RECIBIDAS <span class="pull-right"><i class="icon-refresh"></i></span></p>
                </div>
                <ul class="big-items">
                    <li class="active">
                        <span class="badge badge-important">2</span>
                        <a href="../externa/recibidas/index.php"> Bandeja de entrada</a>
                    </li>
                    <li class="">
                        <a href="../externa/pendientes_tramite/index.php"> 
                            <span class="btn btn-success btn-sm btn-small label label-important">
                                <i class="fa fa-bullhorn"></i> Mis Pendientes
                            </span>
                        </a>
                    </li>
                    <li class="">
                        <a href="../externa/alertas/index.php">
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
    <!-- END SIDEBAR --> 
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
                  <p>ESTÁS AQUÍ</p>
              </li>
              <li><a href="#" class="active">Bandeja, Correspondencia recibida, Solicitudes de historias clinicas</a> </li>
          </ul>   
          <div class="page-title" style="display:none"> 
            <a href="#" id="btn-back"><i class="icon-custom-left"></i></a>
            <h3>Regresar- <span class="semi-bold">Correspondencia recibida</span></h3>
        </div>		
        <div class="row"  id="inbox-wrapper">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="grid simple" >
                            <div class="grid-body no-border email-body" >
                               <br>
                               <div class="row-fluid" >
                                <div id="loader" class="text-center"> 
                                    <img src="../../../../public/assets/img/loading.gif">
                                </div>
                                <div class="outer_div"></div>								
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
                            <div class="" >
                                <div class="" id="DivRadicadosInfo">
                                </div>				
                            </div>							
                        </div>
                    </div>	
                </div>
            </div>
        </div>		
    </div>
    <div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<div class="admin-bar" id="quick-access" style="display:">
    <div class="admin-bar-inner">
        <button class="btn btn-danger  btn-add" type="button"><i class="icon-trash"></i> Tranferir al archivo de gestión</button>
        <button class="btn btn-white  btn-cancel" type="button">Cancel</button>
    </div>
</div> 
<!-- END PAGE --> 
</div>
<!-- BEGIN CHAT --> 
<div class="chat-window-wrapper">
    <div id="main-chat-wrapper" class="inner-content">
        <div class="chat-window-wrapper scroller scrollbar-dynamic" id="chat-users" >
            <div class="chat-header">	
                <div class="pull-left">
                    <input type="text" placeholder="Buscar">
                </div>		
                <div class="pull-right">
                    <a href="#" class="" ><div class="iconset top-settings-dark "></div> </a>
                </div>			
            </div>	
        </div>
    </div>
</div>
<!-- END CHAT -->
</div>
<!-- END CONTAINER --> 
<!-- BEGIN MODAL PARA TRAMITAR LA SOLICITUD DE HC-->
<div class="modal fade" id="myModalFinalizaTramite" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <br>
                <i class="fa fa-folder-o fa-2x" id="IconoTitulo"></i>
                <h4 id="myModalLabel" class="semi-bold"><div id="DivTituloTramite"></div></h4>
                <input name="id_radica" id="id_radica" type="hidden"/>
                <input name="id_serie" id="id_serie" type="hidden"/>
                <input name="id_subserie" id="id_subserie" type="hidden"/>
                <input name="id_tipodoc" id="id_tipodoc" type="hidden"/>
                <input name="id_tercero" id="id_tercero" type="hidden"/>
                <br>
            </div>
            <div class="modal-body">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="grid simple ">
                            <div class="grid-body ">
                                <div class="row form-row">
                                    <div id="DivAlertasHerminarSolicitud"></div>
                                    <div class="col-md-12">
                                        <textarea name="observaciones" rows="2" class="form-control" id="observaciones" placeholder="Ingrese aquí las observaciones si las hay..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="BtnCancelarSolicitud">Cancelar</button>
                <button type="button" class="btn btn-success" id="BtnTerminarSolicitud">Terminar solicitud</button>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL PARA TRAMITAR LA SOLICITUD DE HC -->
<script src="../../../../public/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function(){
        load(1);
    });

    function load(page){
        var parametros = {"action":"ajax","page":page};
        $(".outer_div").fadeIn('slow');
        $.ajax({
            url:'listar.php',
            data: parametros,
            beforeSend: function(objeto){
                $("#loader").html("<img src='../../../../public/assets/img/loading.gif'>");
            },
            success:function(data){
                $(".outer_div").html(data).fadeIn('slow');
                $("#loader").html("");
            }
        })
    }
</script>
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
<!-- END PAGE LEVEL PLUGINS --> 	
<script src="../../../../public/assets/js/email_comman.js" type="text/javascript"></script> 
<!-- BEGIN CORE TEMPLATE JS --> 
<script src="../../../../public/assets/js/core.js" type="text/javascript"></script> 
<script src="../../../../public/assets/js/chat.js" type="text/javascript"></script> 
<script src="../../../../public/assets/js/demo.js" type="text/javascript"></script> 
<!-- END CORE TEMPLATE JS --> 
<!-- END JAVASCRIPTS -->
<script src="../../../../public/assets/sweetalert2/sweetalert-dev.js"></script>
<link href="../../../../public/assets/sweetalert2/sweetalert.css" rel="stylesheet" type="text/css">
</body>
</html>