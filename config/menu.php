<?php
$permisos = Usuario::Listar(8, $_SESSION['SesionUsuaId'], "", "", "", "", "", "");
?>

<p class="menu-title">NAVEGAR
    <span class="pull-right">
        <a href="javascript:;"><i class="fa fa-refresh"></i></a>
    </span>
</p>
<ul>
    <li class="start ">
        <a href="<?php echo MI_ROOT; ?>/panel.php">
            <i class="icon-custom-home"></i>
            <span class="title">Dashboard</span>
        </a>
    </li>
    <?php
    if (in_array('Men_Gene_Funcionarios', $permisos) || in_array('Men_Gene_Remite_Natural', $permisos) || in_array('Men_Gene_Remite_Juridi', $permisos)) {
    ?>
        <li class="start" id="Men_Gene">
            <a href="#">
                <i class="icon-custom-home"></i>
                <span class="title">General</span>
                <span class="selected"></span>
                <span class="arrow open"></span>
            </a>
            <ul class="sub-menu">
                <?php if (in_array('Men_Gene_Funcionarios', $permisos)) { ?>
                    <li id="Men_Gene_Funcionarios">
                        <a href="<?php echo MI_ROOT; ?>/modulos/general/funcionarios/"><i class="fa fa-users"></i> Funcionarios </a>
                    </li>
                <?php } ?>
                <noscript>
                    <li id="">
                        <a href="#">
                            <span class="title"></span> Remitentes<span class="arrow "></span>
                        </a>
                        <ul class="sub-menu">
                            <li id="Men_Gene_Remite_Natural">
                                <a href="#"> Persona Natural </a>
                            </li>
                            <li id="Men_Gene_Remite_Juridi">
                                <a href="index.html"> Presona Juridica</a>
                            </li>
                        </ul>
                    </li>
                </noscript>
            </ul>
        </li>
    <?php
    }

    if (in_array('Men_Mi_Archivo_Digitalizados', $permisos) || in_array('Men_Mi_Archivo_Bandeja', $permisos) || in_array('Men_Mi_Disco', $permisos)) {
    ?>
        <li class="" id="Men_Mi_Archivo">
            <a href="index.html">
                <i class="fa fa-envelope"></i>
                <span class="title">Mi Archivo</span>
                <span class="selected"></span>
                <span class="arrow open"></span>
            </a>
            <ul class="sub-menu">
                <?php if (in_array('Men_Mi_Archivo_Bandeja', $permisos)) { ?>
                    <li id="Men_Mi_Archivo_Bandeja">
                        <a href="<?php echo MI_ROOT; ?>/modulos/mi_archivo/bandeja/externa/recibidas/"> Bandeja De Correo </a>
                    </li>
                <?php }
                if (in_array('Men_Mi_Archivo_Digitalizados', $permisos)) {
                ?>
                    <li id="Men_Mi_Archivo_Digitalizados">
                        <a href="<?php echo MI_ROOT; ?>/modulos/mi_archivo/archivo_digitalizado/"> Archivo Digitalizado</a>
                    </li>
                <?php }

                if (in_array('Men_Mi_Disco', $permisos)) {
                ?>
                    <li id="Men_Mi_Disco">
                        <a href="#"> Mi Disco</a>
                    </li>
                <?php } ?>
            </ul>
        </li>

    <?php
    }

    if (in_array('Men_Venta_Unica_Radica', $permisos)) {
    ?>
        <li class="" id="Men_Venta_Unica">
            <a href="#">
                <i class="fa fa-file-text"></i>
                <span class="title">Ventanilla Única</span>
                <span class="selected"></span>
                <span class="arrow open"></span>
            </a>
            <ul class="sub-menu">
                <li id="Men_Venta_Unica_Radica">
                    <a href="<?php echo MI_ROOT; ?>/modulos/ventanilla/"> Radicar Correspondencia </a>
                </li>
            </ul>
        </li>
    <?php }

    if (
        in_array('Men_OfiArchi_Digitalizacion', $permisos) || in_array('Men_OfiArchi_Digitalizar', $permisos) || in_array('Men_OfiArchi_Reten_Series', $permisos)
        || in_array('Men_OfiArchi_Reten_SubSeries', $permisos) || in_array('Men_OfiArchi_Reten_TipoDocumento', $permisos) || in_array('Men_OfiArchi_Reten_TipoSeries', $permisos)
        || in_array('Men_OfiArchi_TRD', $permisos) || in_array('Men_OfiArchi_TRD_TRD', $permisos)
    ) {
    ?>
        <li class="" id="Men_OfiArchi">
            <a href="#">
                <i class="fa fa-flag"></i>
                <span class="title">Ofi. Archivo</span>
                <span class="selected"></span>
                <span class="arrow open"></span>
            </a>

            <ul class="sub-menu">
                <?php
                if (
                    in_array('Men_OfiArchi_Reten_Series', $permisos) || in_array('Men_OfiArchi_Reten_SubSeries', $permisos) || in_array('Men_OfiArchi_Reten_TipoDocumento', $permisos) ||
                    in_array('Men_OfiArchi_TRD_TRD', $permisos)
                ) {
                ?>
                    <li id="Men_OfiArchi_TRD">
                        <a href="#">
                            <span class="title"> Retención Documental </span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu">
                            <?php if (in_array('Men_OfiArchi_TRD_TRD', $permisos)) { ?>
                                <li id="Men_OfiArchi_TRD_TRD">
                                    <a href="<?php echo MI_ROOT; ?>/modulos/oficina_archivo/reten_documental/trd/"> TRD </a>
                                </li>
                            <?php }

                            if (in_array('Men_OfiArchi_Reten_Series', $permisos)) {
                            ?>
                                <li id="Men_OfiArchi_Reten_Series">
                                    <a href="<?php echo MI_ROOT; ?>/modulos/oficina_archivo/reten_documental/serie/"> Series</a>
                                </li>
                            <?php }

                            if (in_array('Men_OfiArchi_Reten_SubSeries', $permisos)) {
                            ?>
                                <li id="Men_OfiArchi_Reten_SubSeries">
                                    <a href="<?php echo MI_ROOT; ?>/modulos/oficina_archivo/reten_documental/sub_serie/"> Subserie</a>
                                </li>
                            <?php }

                            if (in_array('Men_OfiArchi_Reten_TipoDocumento', $permisos)) {
                            ?>
                                <li id="Men_OfiArchi_Reten_TipoDocumento">
                                    <a href="<?php echo MI_ROOT; ?>/modulos/oficina_archivo/reten_documental/tipo_documentos/"> Tipos de Documentos</a>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php }

                if (in_array('Men_OfiArchi_Digitalizacion', $permisos) || in_array('Men_OfiArchi_Digitalizacion_TVD', $permisos)) {
                ?>
                    <li id="Men_OfiArchi_Digitalizacion">
                        <a href="#">
                            <span class="title"> Digitalización </span>
                            <span class="arrow "></span>
                        </a>

                        <ul class="sub-menu">
                            <?php if (in_array('Men_OfiArchi_Digitalizacion', $permisos)) { ?>
                                <li id="Men_OfiArchi_Digitalizacion">
                                    <a href="<?php echo MI_ROOT; ?>/modulos/oficina_archivo/digitalizacion/digitalizar_trd/"> Digitalizar con TRD</a>
                                </li>
                            <?php }

                            if (in_array('Men_OfiArchi_Digitalizacion_TVD', $permisos)) {
                            ?>
                                <li id="Men_OfiArchi_Digitalizacion_TVD">
                                    <a href="<?php echo MI_ROOT; ?>/modulos/oficina_archivo/digitalizacion/digitalizar_tvd/"> Digitalizar con TVD</a>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php }

                if (in_array('Men_OfiArchi_Configuracion_TVD', $permisos) || in_array('Men_OfiArchi_Configuracion_Organigrama_TVD', $permisos)) {
                ?>
                    <li id="Men_OfiArchi_Configuracion_TVD">
                        <a href="#">
                            <span class="title"> Configuración de TVD </span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu">
                            <li id="Men_OfiArchi_Configuracion_Organigrama_TVD">
                                <a href="#">
                                    <span class="title"> Configuración Organigrama </span>
                                    <span class="arrow "></span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="<?php echo MI_ROOT; ?>/modulos/oficina_archivo/tvd/dependencias/"> Dependencias</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo MI_ROOT; ?>/modulos/oficina_archivo/tvd/oficinas/"> Oficinas</a>
                                    </li>
                                </ul>
                            </li>
                            <li id="Men_OfiArchi_Configuracion_TVD">
                                <a href="#">
                                    <span class="title"> Configuración TVD </span>
                                    <span class="arrow "></span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="<?php echo MI_ROOT; ?>/modulos/oficina_archivo/tvd/tvd/"> TVD</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo MI_ROOT; ?>/modulos/oficina_archivo/tvd/serie/"> Series</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo MI_ROOT; ?>/modulos/oficina_archivo/tvd/sub_serie/"> Subseries</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo MI_ROOT; ?>/modulos/oficina_archivo/tvd/tipo_documentos/"> Tipos Documentales</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </li>
    <?php }
    if (
        in_array('Men_Calidad_Procesos', $permisos) || in_array('Men_Calidad_Procedimientos', $permisos) || in_array('Men_Caldiad_Repositorio', $permisos)
        || in_array('Men_Calidad_Tipos_Documentos', $permisos) || in_array('Men_Calidad_Consulta_Repositorio', $permisos)
    ) {
    ?>
        <li class="" id="Men_Calidad">
            <a href="#">
                <i class="fa fa-check-circle"></i>
                <span class="title">Calidad</span>
                <span class="selected"></span>
                <span class="arrow open"></span>
            </a>
            <ul class="sub-menu">
                <?php if (in_array('Men_Calidad_Procesos', $permisos)) { ?>
                    <li id="Men_Calidad_Procesos">
                        <a href="<?php echo MI_ROOT; ?>/modulos/calidad/procesos/"> Procesos </a>
                    </li>
                <?php }

                if (in_array('Men_Calidad_Procedimientos', $permisos)) {  ?>
                    <li id="Men_Calidad_Procedimientos">
                        <a href="<?php echo MI_ROOT; ?>/modulos/calidad/procedimientos/"> Procedimientos </a>
                    </li>
                <?php }

                if (in_array('Men_Calidad_Tipos_Documentos', $permisos)) {  ?>
                    <li id="Men_Calidad_Tipos_Documentos">
                        <a href="<?php echo MI_ROOT; ?>/modulos/calidad/tipos_documentos/"> Tipos de documentos </a>
                    </li>
                <?php }

                if (in_array('Men_Caldiad_Gestionar_Repositorio', $permisos)) {  ?>
                    <li id="Men_Caldiad_Gestionar_Repositorio">
                        <a href="<?php echo MI_ROOT; ?>/modulos/calidad/repositorio/"> Gestión de Repositorio </a>
                    </li>
                <?php }

                if (in_array('Men_Calidad_Consulta_Repositorio', $permisos)) {  ?>
                    <li id="Men_Calidad_Consulta_Repositorio">
                        <a href="<?php echo MI_ROOT; ?>/modulos/calidad/consulta_repositorio/"> Consultar Repositorio </a>
                    </li>
                <?php } ?>
            </ul>
        </li>

    <?php }

    if (in_array('Men_Areas_Dependen', $permisos) || in_array('Men_Areas_Oficinas', $permisos) || in_array('Men_Areas_Cargos', $permisos)) {
    ?>
        <li class="" id="Men_Areas">
            <a href="#">
                <i class="fa fa-th"></i>
                <span class="title">Áreas</span>
                <span class="selected"></span>
                <span class="arrow open"></span>
            </a>
            <ul class="sub-menu">
                <?php if (in_array('Men_Areas_Dependen', $permisos)) { ?>
                    <li id="Men_Areas_Dependen">
                        <a href="<?php echo MI_ROOT; ?>/modulos/areas/dependencias/index.php"> Dependencias </a>
                    </li>
                <?php }

                if (in_array('Men_Areas_Oficinas', $permisos)) {
                ?>
                    <li id="Men_Areas_Oficinas">
                        <a href="<?php echo MI_ROOT; ?>/modulos/areas/oficinas/index.php"> Oficinas </a>
                    </li>
                <?php }

                if (in_array('Men_Areas_Cargos', $permisos)) {
                ?>
                    <li id="Men_Areas_Cargos">
                        <a href="<?php echo MI_ROOT; ?>/modulos/areas/cargos/index.php"> Cargos </a>
                    </li>
                <?php } ?>
            </ul>
        </li>
    <?php }

    if (
        in_array('Men_Config_FormaEnvio', $permisos) || in_array('Men_Config_Saludo', $permisos) || in_array('Men_Config_Depedida', $permisos)
        || in_array('Men_Config_Estatus', $permisos) || in_array('Men_Config_tipos_correspondencia', $permisos) || in_array('Men_Config_tipos_documentos', $permisos)
        || in_array('Men_Config_tipos_respuestas', $permisos) || in_array('Men_Config_RutasGestion', $permisos) || in_array('Men_Config_RutasTemp', $permisos)
        || in_array('Men_Config_Calidad', $permisos) || in_array('Men_Config_RutasDigitalizacion', $permisos) || in_array('Men_Config_Otras', $permisos)
    ) {
    ?>
        <li class="" id="Men_Config">
            <a href="#">
                <i class="fa fa-cogs"></i>
                <span class="title">Configuración</span>
                <span class="selected"></span>
                <span class="arrow open"></span>
            </a>
            <ul class="sub-menu">
                <?php if (in_array('Men_Config_FormaEnvio', $permisos)) { ?>
                    <li id="Men_Config_FormaEnvio">
                        <a href="<?php echo MI_ROOT; ?>/modulos/configuracion/forma_envio/"> Formas de Envio </a>
                    </li>
                <?php }
                if (in_array('Men_Config_FormaEnvio', $permisos)) { ?>
                    <li id="Men_Config_Saludo">
                        <a href="<?php echo MI_ROOT; ?>/modulos/configuracion/saludo/"> Saludo </a>
                    </li>
                <?php }
                if (in_array('Men_Config_Depedida', $permisos)) { ?>
                    <li id="Men_Config_Depedida">
                        <a href="<?php echo MI_ROOT; ?>/modulos/configuracion/despedida/"> Despedida </a>
                    </li>
                <?php }
                if (in_array('Men_Config_Estatus', $permisos)) { ?>
                    <li id="Men_Config_Estatus">
                        <a href="<?php echo MI_ROOT; ?>/modulos/configuracion/status/"> Status </a>
                    </li>
                <?php }
                if (in_array('Men_Config_tipos_correspondencia', $permisos)) { ?>
                    <li id="Men_Config_tipos_correspondencia">
                        <a href="<?php echo MI_ROOT; ?>/modulos/configuracion/tipo_correspondencia/"> Tipos de Correspondencia </a>
                    </li>
                <?php }
                if (in_array('Men_Config_tipos_documentos', $permisos)) { ?>
                    <li id="Men_Config_tipos_documentos">
                        <a href="<?php echo MI_ROOT; ?>/modulos/configuracion/tipos_documentos/"> Tipos de documentos </a>
                    </li>
                <?php }
                if (in_array('Men_Config_tipos_respuestas', $permisos)) { ?>
                    <li id="Men_Config_tipos_respuestas">
                        <a href="<?php echo MI_ROOT; ?>/modulos/configuracion/tipos_respuesta/"> Tipos de respuestas </a>
                    </li>
                <?php }
                if (in_array('Men_Config_RutasGestion', $permisos)) { ?>
                    <li id="Men_Config_RutasGestion">
                        <a href="<?php echo MI_ROOT; ?>/modulos/configuracion/ruta_gestion/"> Rutas de Archivo de Gestión </a>
                    </li>
                <?php }
                if (in_array('Men_Config_RutasTemp', $permisos)) { ?>
                    <li id="Men_Config_RutasTemp">
                        <a href="<?php echo MI_ROOT; ?>/modulos/configuracion/ruta_temp/"> Rutas para archivos Temp </a>
                    </li>
                <?php }
                if (in_array('Men_Config_Calidad', $permisos)) { ?>
                    <li id="Men_Config_Calidad">
                        <a href="<?php echo MI_ROOT; ?>/modulos/configuracion/ruta_calidad/"> Rutas para archivo de caldiad </a>
                    </li>
                <?php }
                if (in_array('Men_Config_RutasDigitalizacion', $permisos)) { ?>
                    <li id="Men_Config_RutasDigitalizacion">
                        <a href="<?php echo MI_ROOT; ?>/modulos/configuracion/ruta_digitalizacion/"> Rutas para digitalización </a>
                    </li>
                <?php }
                if (in_array('Men_Config_Otras', $permisos)) { ?>
                    <li id="Men_Config_Otras">
                        <a href="<?php echo MI_ROOT; ?>/modulos/configuracion/otras/"> Otras configuraciones </a>
                    </li>
                <?php } ?>
            </ul>
        </li>
    <?php }

    if (in_array('Men_Seguri_Explora', $permisos) || in_array('Men_Seguri_Perfiles', $permisos)) {
    ?>
        <li class="" id="Men_Seguri">
            <a href="#">
                <i class="fa fa-unlock"></i>
                <span class="title">Seguridad</span>
                <span class="selected"></span>
                <span class="arrow open"></span>
            </a>
            <ul class="sub-menu">
                <?php if (in_array('Men_Seguri_Explora', $permisos)) { ?>
                    <li id="Men_Seguri_Explora">
                        <a href="<?php echo MI_ROOT; ?>/modulos/seguridad/usuarios/"><i class="fa fa-users"></i> Usuarios </a>
                    </li>
                <?php }
                if (in_array('Men_Seguri_Perfiles', $permisos)) { ?>
                    <li id="Men_Seguri_Perfiles">
                        <a href="<?php echo MI_ROOT; ?>/modulos/seguridad/perfiles/"> Explorador de Perfiles </a>
                    </li>
                <?php } ?>
            </ul>
        </li>
    <?php }

    if (in_array('Men_Reportes_Ventanilla', $permisos) || in_array('Men_Reportes_Ofi_Archivo', $permisos)) {
    ?>
        <li class="" id="Men_Reportes">
            <a href="#">
                <i class="fa fa-folder"></i>
                <span class="title">Reportes</span>
                <span class="selected"></span>
                <span class="arrow open"></span>
            </a>
            <ul class="sub-menu">
                <?php if (in_array('Men_Reportes_Ventanilla', $permisos)) { ?>
                    <li>
                        <a href="javascript:;">
                            <span class="title">Ventanilla Unica</span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="<?php echo MI_ROOT; ?>/modulos/reportes/ventanilla/detallado/"> Detallados</a></li>
                            <li><a href="<?php echo MI_ROOT; ?>/modulos/reportes/ventanilla/indicador/"> Indicador</a></li>
                            <li><a href="#"> Pendientes</a></li>
                            <li><a href="<?php echo MI_ROOT; ?>/modulos/reportes/ventanilla/pqrsf/"> PQRSF</a></li>
                        </ul>
                    </li>
                <?php }
                if (in_array('Men_Reportes_Ofi_Archivo', $permisos)) { ?>
                    <li>
                        <a href="javascript:;">
                            <span class="title">Ofi. Archivo</span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="<?php echo MI_ROOT; ?>/modulos/reportes/oficina_archivo/trd/"> TRD</a></li>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </li>
    <?php } ?>
</ul>

<div class="clearfix"></div>
<!-- 
<?php


foreach ($Menu as $Item) :
?>
    <script type="text/javascript">
        $("#<?php echo $Item['menu']; ?>").removeAttr("style");
    </script>
<?php

endforeach;
?> -->