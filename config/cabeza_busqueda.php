<?php
$BusquedaFuncionario = Funcionario::Listar(6, 0, "", "", "", 0, 0, 0);
//echo $_SERVER["REQUEST_URI"];
$RutaActual = explode('/', $_SERVER["REQUEST_URI"]);
$RutaModulo = $RutaActual[3];

$RutaLlamarListarEmpresas = "";
if ($RutaModulo == 'mi_archivo') {
    $RutaLlamarListarEmpresas = '../../../../varios/listar_tercero_juridico_empresa.php';
} elseif ($RutaModulo == 'ventanilla') {
    $RutaLlamarListarEmpresas = '../../varios/listar_tercero_juridico_empresa.php';
}
?>
<!-- BEGIN PLUGIN CSS -->
<div class="header navbar navbar-inverse">
    <!-- BEGIN TOP NAVIGATION BAR -->
    <div class="navbar-inner">
        <div class="header-seperation">
            <ul class="nav pull-left notifcation-center" id="main-menu-toggle-wrapper" style="display:none">
                <li class="dropdown">
                    <a id="main-menu-toggle" href="#main-menu" class="">
                        <div class="iconset top-menu-toggle-white"></div>
                    </a>
                </li>
            </ul>
            <!-- BEGIN LOGO -->
            <a href="<?php echo MI_ROOT . '/panel.php'; ?>">
                <img src="<?php echo MI_LOGO; ?>" class="logo" alt="" data-src="<?php echo MI_LOGO; ?>" data-src-retina="<?php echo MI_LOGO_2X; ?>" width="106" height="21" />
            </a>
            <!-- END LOGO -->
            <ul class="nav pull-right notifcation-center">
                <li class="dropdown" id="header_task_bar">
                    <a href="<?php echo MI_ROOT . '/panel.php'; ?>" class="dropdown-toggle active" data-toggle="">
                        <div class="iconset top-home"></div>
                    </a>
                </li>
                <li class="dropdown" id="header_inbox_bar">
                    <a href="" class="dropdown-toggle">
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
        <div class="header-quick-nav">
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="pull-left">
                <ul class="nav quick-section">
                    <li class="quicklinks">
                        <a href="#" class="" id="layout-condensed-toggle">
                            <div class="iconset top-menu-toggle-dark"></div>
                        </a>
                    </li>
                </ul>
                <ul class="nav quick-section">

                    <li class="quicklinks" id="BtnRecargar">
                        <a href="#" class="">
                            <div class="iconset top-reload"></div>
                        </a>
                    </li>
                    <li class="quicklinks">
                        <span class="h-seperate"></span>
                    </li>
                    <li class="m-r-10 input-prepend inside search-form no-boarder">
                        <span class="add-on">
                            <span class="iconset top-search"></span>
                        </span>

                        <input name="TxtBuscarCorrespondencia" id="TxtBuscarCorrespondencia" type="text" class="no-boarder" placeholder="Búsqueda de correspondencia" style="width:250px;">

                        <div class="chat-toggler">
                            <button type="button" class="btn btn-success dropdown-toggle" id="my-task-list-1" data-placement="bottom" data-content='' data-toggle="dropdown" id="BtnFiltro">
                                <i class="fa fa-filter text-info"></i>
                                <span class="caret text-info"></span>
                            </button>
                            <div id="notification-list-1" style="display:none">
                                <div style="width:300px;">
                                    <div>

                                        <div class="message-wrapper">
                                            <div class="input-group">
                                                <input name="busqueda_id_radicado" type="text" class="form-control" id="busqueda_id_radicado" placeholder="Id. Radicado">
                                            </div>
                                        </div>

                                        <div class="message-wrapper">
                                            <div class="input-group" id="InputGroupTercero">
                                                <input name="busqueda_id_tercero" id="busqueda_id_tercero" type="hidden">
                                                <input name="busqueda_tipo_tercero" id="busqueda_tipo_tercero" type="hidden">
                                                <input name="busqueda_tercero" type="text" class="form-control" id="busqueda_tercero" placeholder="Tercero">
                                                <div class="input-group-btn">
                                                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                                        <i class="fa fa-ellipsis-v text-info"></i>
                                                        <span class="caret text-info"></span>
                                                    </button>
                                                    <ul class="dropdown-menu pull-right" role="menu">
                                                        <li>
                                                            <a href="#" data-toggle="modal" data-target="#myModalBusquedaFiltroTerceroNatural" id="BtnBuscarTerceroNatural">Buscar tercero natural</a>
                                                        </li>
                                                        <li>
                                                            <a href="#" data-toggle="modal" data-target="#myModalBusquedaFiltroTerceroJuridico" id="BtnBuscarTerceroJuridico">Buscar tercero juridico</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="message-wrapper">
                                            <div class="input-group">

                                                <input name="busqueda_id_funcionario" type="hidden" id="busqueda_id_funcionario">
                                                <input name="busqueda_nom_funcionario" type="text" class="form-control" id="busqueda_nom_funcionario" placeholder="Funcionario">

                                                <div class="input-group-btn">
                                                    <button type="button" class="btn btn-success btn-sm btn-small" data-toggle="modal" data-target="#myModalBusquedaFiltroFuncionarios">
                                                        <i class="fa fa-search text-info"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="message-wrapper">
                                            <input name="TxtBuscarAsunto" id="TxtBuscarAsunto" type="text" class="no-boarder" placeholder="Asunto">
                                        </div>

                                        <div class="message-wrapper">
                                            <input name="TxtBuscarQueContenga" id="TxtBuscarQueContenga" type="text" class="no-boarder TxtBuscarCorrespondencia" placeholder="Que contenga">
                                        </div>
                                        <noscript>
                                            <div class="message-wrapper">
                                                <div class="input-group">

                                                    <input name="busqueda_id_dependencia" type="hidden" id="busqueda_id_dependencia">
                                                    <input name="busqueda_nom_dependencia" type="text" class="form-control" id="busqueda_nom_dependencia" placeholder="Dependencia">

                                                    <div class="input-group-btn">
                                                        <button type="button" class="btn btn-success btn-sm btn-small" data-toggle="modal" data-target="#myModalBusquedaFuncionarios">
                                                            <i class="fa fa-search text-info"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="message-wrapper">
                                                <div class="input-group">

                                                    <input name="busqueda_id_oficina" type="hidden" id="busqueda_id_oficina">
                                                    <input name="busqueda_nom_oficina" type="text" class="form-control" id="busqueda_nom_oficina" placeholder="Oficina">

                                                    <div class="input-group-btn">
                                                        <button type="button" class="btn btn-success btn-sm btn-small" data-toggle="modal" data-target="#myModalBusquedaFuncionarios">
                                                            <i class="fa fa-search text-info"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </noscript>
                                    </div>

                                    <div class="form-actions">
                                        <div class="pull-right">
                                            <button class="btn btn-default btn-small" type="button" id="BtnLimiarFiltro" name="BtnGuardar">
                                                <span class="fa fa-cl"></span> Limpiar filtro
                                            </button>
                                            <button class="btn btn-success btn-small" type="button" id="BtnBuscarFiltro" name="BtnRegresar">
                                                <span class="fa fa-search"></span> Buscar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- END TOP NAVIGATION MENU -->

            <!-- BEGIN CHAT TOGGLER -->
            <div class="pull-right">
                <div class="chat-toggler">
                    <a href="#">
                        <div class="user-details">
                            <div class="username">
                                <?php echo htmlspecialchars($_SESSION['SesionFuncioNom'], ENT_QUOTES); ?>
                                <!-- <?php echo htmlspecialchars($SesionNomUsua, ENT_QUOTES); ?> -->
                            </div>
                        </div>
                        <div class="iconset top-down-arrow"></div>
                    </a>
                    <div class="profile-pic">
                        <?php
                        if ($_SESSION['SesionFuncioImagenPerfil'] != "") {
                            $ImagenDePerfil = $RutaMiServidor . "/archivos/fotos_perfil/" . $_SESSION['SesionFuncioImagenPerfil'];
                        ?>
                            <img src="<?php echo $ImagenDePerfil; ?>" alt="" data-src="<?php echo $ImagenDePerfil; ?>" data-src-retina="<?php echo $ImagenDePerfil; ?>" width="35" height="35" />
                            <?php
                        } else {
                            if ($_SESSION['SesionFuncioSexo'] == 'M') {
                            ?>
                                <img src="<?php echo AVATAR_M; ?>" alt="" data-src="<?php echo AVATAR_M; ?>" data-src-retina="<?php echo AVATAR_SMALL_2X_M; ?>" width="35" height="35" />

                            <?php
                            } else {
                            ?>
                                <img src="<?php echo AVATAR_F; ?>" alt="" data-src="<?php echo AVATAR_F; ?>" data-src-retina="<?php echo AVATAR_SMALL_2X_F; ?>" width="35" height="35" />
                        <?php
                            }
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
                            <li>
                                <a href="<?php echo MI_ROOT; ?>/modulos/seguridad/mi_cuenta/index.php">
                                    <i class="fa fa-user"></i>
                                    Mi Cuenta
                                </a>
                            </li>
                            <li><a href="<?php echo MI_ROOT; ?>/modulos/mi_archivo/bandeja/externa/recibidas/index.php"> Mi bandeja de entrada&nbsp;&nbsp;<span class="badge badge-important animated bounceIn">2</span></a> </li>
                            <li class="divider"></li>
                            <li><a href="<?php echo LOG_OUT; ?>"><i class="fa fa-power-off"></i>&nbsp;&nbsp;Salir</a></li>
                            <li class="divider"></li>
                            <li>
                                <a href="" data-toggle="modal" data-target="#myModalAyuda">
                                    <i class="fa fa-help"></i>&nbsp;&nbsp;Ayuda
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="quicklinks">
                        <span class="h-seperate"></span>
                    </li>
                    <li class="quicklinks">
                        <a id="chat-menu-toggle" href="#sidr" class="chat-menu-toggle">
                            <div class="iconset top-chat-dark ">
                                <span class="badge badge-important hide" id="chat-message-count">1</span>
                            </div>
                        </a>
                        <div class="simple-chat-popup chat-menu-toggle hide">
                            <div class="simple-chat-popup-arrow"></div>
                            <div class="simple-chat-popup-inner">
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

            <div class="pull-right">
                <div class="chat-toggler">
                    <a href="#" class="dropdown-toggle" id="my-task-list-interna" data-placement="bottom" data-content='' data-toggle="dropdown" data-original-title="Notificaciones externas">
                        <div class="user-details">
                            <div class="username">
                                <span class="badge badge-important">
                                    <div id="DivTotalNotificacionesInternas"></div>
                                </span>
                                <span class="bold">Notifica. Internas</span>
                            </div>
                        </div>
                        <div class="iconset top-down-arrow"></div>
                    </a>
                    <div id="notification-list-interna" style="display:none">
                        <div style="width:300px">
                            <div id="DivMostrarNotificaInternas"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pull-right">
                <div class="chat-toggler">
                    <a href="#" class="dropdown-toggle" id="my-task-list-externa" data-placement="bottom" data-content='' data-toggle="dropdown" data-original-title="Notificaciones externas">
                        <div class="user-details">
                            <div class="username">
                                <span class="badge badge-important">
                                    <div id="DivTotalNotificacionesExternas"></div>
                                </span>
                                <span class="bold" id="DivTituloMostrarNotificaExternas">Notifica. Externas</span>
                            </div>
                        </div>
                        <div class="iconset top-down-arrow"></div>
                    </a>
                    <div id="notification-list-externa" style="display:none">
                        <div style="width:300px">
                            <div id="DivMostrarNotificaExternas"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END TOP NAVIGATION BAR -->
</div>



<!-- BEGIN MODAL PARA LOS TERCEROS NATURALES-->
<div class="modal fade" id="myModalBusquedaFiltroTerceroNatural" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                        <input name="TxtBuscarFiltroTerceroNaturales" type="text" class="form-control" id="TxtBuscarFiltroTerceroNaturales" placeholder="Ingrese aqui el criterio de búsqueda para el tercero natural.">
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
<div class="modal fade" id="myModalBusquedaFiltroTerceroJuridico" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                        <input name="TxtBuscarFiltroTerceroJuridicos" type="text" class="form-control" id="TxtBuscarFiltroTerceroJuridicos" placeholder="Ingrese aqui el criterio de búsqueda para el tercero juridico.">
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

<!-- BEGIN MODAL PARA LOS FUNCIONARIOS-->
<div class="modal fade" id="myModalBusquedaFiltroFuncionarios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <br>
                <i class="fa fa-users fa-2x text-info"></i>
                <h4 id="myModalLabel" class="semi-bold text-info">Buscar funcionario.</h4>
                <br>
            </div>
            <div class="modal-body">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="grid simple ">
                            <div class="grid-body ">
                                <table class="table table-hover table-condensed" id="Tbl10">
                                    <thead>
                                        <tr>
                                            <th style="width:1%"></th>
                                            <th style="width:30%">Funcionario</th>
                                            <th style="width:30%">Oficina</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($BusquedaFuncionario as $Item) :
                                        ?>
                                            <tr>
                                                <td class="v-align-middle">
                                                    <button type="button" id="BtnLlevarBusquedaFiltroFuncionario" class="btn btn-block btn-success btn-xs btn-mini" name="BtnLlevarBusquedaFiltroFuncionario[]" data-busqueda_id_funcionario_deta="<?php echo $Item['id_funcio_deta']; ?>" data-busqueda_nom_funcionario="<?php echo $Item['nom_funcio'] . " " . $Item['ape_funcio']; ?>">
                                                        <i class="fa fa-check"></i></button>
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
<!-- END MODAL PARA FUNCIONARIOS-->

<div class="modal fade" id="myModalAyuda" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <br>
                <i class="fa fa-credit-card fa-2x text-info"></i>
                <h4 id="myModalLabel" class="semi-bold text-info">Ayuda.</h4>
                <div id="ojo"></div>
            </div>
            <div class="modal-body">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="grid simple ">
                            <div class="grid-body ">
                                <table class="table table-hover table-condensed">
                                    <thead>
                                        <th width="95%">Manual</th>
                                        <th width="5%"></th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="v-align-middle">
                                                Ventanilla Unica
                                            </td>
                                            <td class="v-align-middle">
                                                <a href="<?php echo MI_ROOT; ?>/archivos/ayuda/Maual de usuario modulo Ventanilla Unica-convertido.pdf" target="_blank">
                                                    <i class="fa fa-cloud-download text-info"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="v-align-middle">
                                                Oficina de Archivo
                                            </td>
                                            <td class="v-align-middle">
                                                <a href="<?php echo MI_ROOT; ?>/archivos/ayuda/Maual de usuario modulo Ofic archivo-convertido.pdf" target="_blank">
                                                    <i class="fa fa-cloud-download text-info"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="v-align-middle">
                                                Configuracion
                                            </td>
                                            <td class="v-align-middle">
                                                <a href="<?php echo MI_ROOT; ?>/archivos/ayuda/Maual de usuario modulo Configuracion-convertido.pdf" target="_blank">
                                                    <i class="fa fa-cloud-download text-info"></i>
                                                </a>
                                            </td>
                                        </tr>
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

<script type="text/javascript">
    $(document).ready(function() {

        $.ajax({
            url: '<?php echo MI_ROOT; ?>/modulos/notificaciones/accionesNotificaciones.php',
            type: 'POST',
            data: 'accion=LISTAR_NOTIFICACIONES_EXTERNAS',
            success: function(msj) {
                var Elementos = msj.split("######")
                $('#DivMostrarNotificaExternas').html(Elementos[0])
                $('#DivTotalNotificacionesExternas').html(Elementos[1])
            },
        });

        $.ajax({
            url: '<?php echo MI_ROOT; ?>/modulos/notificaciones/accionesNotificaciones.php',
            type: 'POST',
            data: 'accion=LISTAR_NOTIFICACIONES_INTERNAS',
            success: function(msj) {
                var Elementos = msj.split("######")
                $('#DivMostrarNotificaInternas').html(Elementos[0])
                $('#DivTotalNotificacionesInternas').html(Elementos[1])
            },
        });

        setInterval(function() {
            Mostrar_Notificaciones();
        }, 5000);

        function Mostrar_Notificaciones() {
            $.ajax({
                url: '<?php echo MI_ROOT; ?>/modulos/notificaciones/accionesNotificaciones.php',
                type: 'POST',
                data: 'accion=LISTAR_NOTIFICACIONES_EXTERNAS',
                success: function(msj) {
                    var Elementos = msj.split("######")
                    $('#DivMostrarNotificaExternas').html(Elementos[0])
                    $('#DivTotalNotificacionesExternas').html(Elementos[1])
                },
            });

            $.ajax({
                url: '<?php echo MI_ROOT; ?>/modulos/notificaciones/accionesNotificaciones.php',
                type: 'POST',
                data: 'accion=LISTAR_NOTIFICACIONES_INTERNAS',
                success: function(msj) {
                    var Elementos = msj.split("######")
                    $('#DivMostrarNotificaInternas').html(Elementos[0])
                    $('#DivTotalNotificacionesInternas').html(Elementos[1])
                },
            });
        }

        $('#DivTituloMostrarNotificaExternas').click(function(event) {
            $.ajax({
                url: '<?php echo MI_ROOT; ?>/modulos/notificaciones/accionesNotificaciones.php',
                type: 'POST',
                data: 'accion=VER_NOTIFICACIONES_EXTERNAS',
                success: function(msj) {
                    if (msj == 1) {
                        $('#DivTotalNotificacionesExternas').html("0")
                    }
                },
            });
        });

        $("#TxtBuscarCorrespondencia").keyup(function(e) {
            if (e.which == 13) {

                if ($("#busqueda_id_radicado").val() != "" || $("#busqueda_id_tercero").val() != "" || $("#busqueda_id_tercero").val() != "" || $("#busqueda_id_funcionario").val() != "" || $("#TxtBuscarCorrespondencia").val() != "" || $("#TxtBuscarAsunto").val() != "" || $("#TxtBuscarQueContenga").val() != "" || $("#busqueda_id_dependencia").val() != "" || $("#busqueda_id_oficina").val() != "") {

                    var parametros = {
                        "action": "ajax",
                        "page": 1,
                        "tipo_listar": "buscar",
                        "IdRadicado": $("#busqueda_id_radicado").val(),
                        "IdTercero": $("#busqueda_id_tercero").val(),
                        "IdFuncionario": $("#busqueda_id_funcionario").val(),
                        "Buscar": $("#TxtBuscarCorrespondencia").val(),
                        "Asunto": $("#TxtBuscarAsunto").val(),
                        "QueContenga": $("#TxtBuscarQueContenga").val(),
                        "IdDependencia": $("#busqueda_id_dependencia").val(),
                        "IdOficina": $("#busqueda_id_oficina").val()
                    };

                    $.ajax({
                        url: 'listar.php',
                        type: 'POST',
                        data: parametros,
                        beforeSend: function(objeto) {
                            $("#loader").html("<img src='../../../../public/assets/img/loading.gif'>");
                        },
                        success: function(data) {
                            $("#outer_div").empty();
                            $(".outer_div").html(data).fadeIn('slow');
                            $("#loader").html("");
                        }
                    });
                }
            }
        });

        $(document).on('click', '#BtnLlevarBusquedaFuncionario', function(event) {
            $('#busqueda_id_funcionario').val($(this).data('busqueda_id_funcionario'));
            $('#busqueda_nom_funcionario').val($(this).data('busqueda_nom_funcionario'));
        });

        $(document).on('click', '#BtnLimiarFiltro', function(event) {
            $('#TxtBuscarCorrespondencia').val('');
            $('#busqueda_id_radicado').val('');
            $('#busqueda_id_tercero').val('');
            $('#busqueda_tipo_tercero').val('');
            $('#busqueda_tercero').val('');
            $('#busqueda_id_funcionario').val('');
            $('#busqueda_nom_funcionario').val('');
            $('#TxtBuscarAsunto').val('');
            $('#TxtBuscarQueContenga').val('');
            $('#busqueda_id_dependencia').val('');
            $('#busqueda_nom_dependencia').val('');
            $('#busqueda_id_oficina').val('');
            $('#busqueda_nom_oficina').val('');
        });

        $(document).on('click', '#BtnBuscarFiltro', function(event) {

            if ($("#busqueda_id_tercero").val() != "" || $("#busqueda_id_tercero").val() != "" || $("#busqueda_id_funcionario").val() != "" || $("#TxtBuscarCorrespondencia").val() != "" || $("#TxtBuscarAsunto").val() != "" || $("#TxtBuscarQueContenga").val() != "" || $("#busqueda_id_dependencia").val() != "" || $("#busqueda_id_oficina").val() != "") {

                var parametros = {
                    "action": "ajax",
                    "page": 1,
                    "tipo_listar": "buscar",
                    "IdRadicado": $("#busqueda_id_radicado").val(),
                    "IdTercero": $("#busqueda_id_tercero").val(),
                    "IdFuncionario": $("#busqueda_id_funcionario").val(),
                    "Buscar": $("#TxtBuscarCorrespondencia").val(),
                    "Asunto": $("#TxtBuscarAsunto").val(),
                    "QueContenga": $("#TxtBuscarQueContenga").val(),
                    "IdDependencia": $("#busqueda_id_dependencia").val(),
                    "IdOficina": $("#busqueda_id_oficina").val()
                };

                $.ajax({
                    url: 'listar.php',
                    type: 'POST',
                    data: parametros,
                    beforeSend: function(objeto) {
                        $("#loader").html("<img src='../../../../public/assets/img/loading.gif'>");
                    },
                    success: function(data) {
                        $("#outer_div").empty();
                        $(".outer_div").html(data).fadeIn('slow');
                        $("#loader").html("");
                    }
                });
            }
        });

        //FUNCION PARA BUSCAR EL TERCERO NATURAL
        $("#TxtBuscarFiltroTerceroNaturales").keyup(function(e) {
            if (e.which == 13) {
                if ($("#TxtBuscarFiltroTerceroNaturales").val() === "") {
                    $("#DivAlertasTerceroNaturales").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta ingresar el criterio de busqueda</div>')
                    $("#DivAlertaTerceroJutidico").load("../../../../config/mensajes.php", {
                        alerta: 3,
                        mensaje: 'Te hizo falta al empresa del contacto.'
                    }, function() {});
                    $("#TxtBuscarFiltroTerceroNaturales").focus();
                } else {
                    var Ruta = '<?php echo $RutaLlamarListarEmpresas; ?>';
                    alert('<?php echo $RutaLlamarListarEmpresas; ?>')
                    $.ajax({
                        url: '',
                        type: 'POST',
                        data: 'criterio=' + $("#TxtBuscarFiltroTerceroNaturales").val(),
                        beforeSend: function() {
                            $("#DivAlertasTerceroNaturales").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
                        },
                        success: function(msj) {
                            $("#DivAlertasTerceroNaturales").empty();
                            if (msj != 1) {
                                $("#DivTerceroNaturales").html(msj);
                            } else {
                                $("#DivTerceroNaturales").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> ' + msj + '.</div>');
                            }
                        },
                        error: function(msj) {
                            $("#DivAlertasTerceroNaturales").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + '</div>');
                        }
                    });
                }
            }
        });

        //FUNCION PARA LLEVAR EL DESTINATARIO NATURAL
        $(document).on('click', '#BtnLlevarTerceroNatural', function(event) {
            $('#busqueda_id_tercero').val($(this).data('id_tercero_natural'));
            $('#busqueda_tercero').val($(this).data('nombre_tercero_natural'));
        });

        //FUNCION PARA BUSCAR EL TERCERO JURIDICO
        $("#TxtBuscarFiltroTerceroJuridicos").keyup(function(e) {
            if (e.which == 13) {
                if ($("#TxtBuscarFiltroTerceroJuridicos").val() === "") {
                    $("#DivAlertasTerceroJuridicos").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> Te hizo falta ingresar el criterio de busqueda.</div>');
                    $("#DivAlertaTerceroJutidico").load("../../../../config/mensajes.php", {
                        alerta: 3,
                        mensaje: 'Te hizo falta al empresa del contacto.'
                    }, function() {});
                    $("#TxtBuscarFiltroTerceroJuridicos").focus();
                } else {
                    $.ajax({
                        url: '../../../../ventanilla/varios/listar_tercero_juridico_empresa.php',
                        type: 'POST',
                        data: 'criterio=' + $("#TxtBuscarFiltroTerceroJuridicos").val(),
                        beforeSend: function() {
                            $("#DivAlertasTerceroJuridicos").html('<div class="alert alert-info"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><img src="../../../../../public/assets/img/loading.gif" width="20" height="20"> Info.:</a> Enviando informacóm, por favor espere. </div>');
                        },
                        success: function(msj) {
                            $("#DivAlertasTerceroJuridicos").empty();
                            if (msj != 1) {
                                $("#DivTerceroJuridico").html(msj);
                            } else {
                                $("#DivAlertasTerceroJuridicos").html('<div class="alert"><button class="close" data-dismiss="alert"></button><a href="#" class="link"><i class="fa fa-exclamation-circle"></i> Upsss.</a> ' + msj + '.</div>');
                            }
                        },
                        error: function(msj) {
                            $("#DivAlertasTerceroJuridicos").html('<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><a href="#" class="link">Error: </a> Ha ocurrido un error durante la ejecución ' + msj + '</div>');
                        }
                    });
                }
            }
        });

        //FUNCION PARA LLEVAR EL TERCERO JURIDICO
        $(document).on('click', '#BtnLlevarTerceroJuridico', function(event) {
            $('#busqueda_id_tercero').val($(this).data('id_tercero_juridico'));
            $('#busqueda_tercero').val($(this).data('entidad_tercero_juridoc'));
        });


        //FUNCION PARA LLEVAR EL FUNCIONARIO
        $(document).on('click', '#BtnLlevarBusquedaFiltroFuncionario', function(event) {
            $('#busqueda_id_funcionario').val($(this).data('busqueda_id_funcionario_deta'));
            $('#busqueda_nom_funcionario').val($(this).data('busqueda_nom_funcionario'));
        });
    });
</script>