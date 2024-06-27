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
    <li class="start" id="Men_Gene" style='display:none;'>
        <a href="#">
            <i class="icon-custom-home"></i>
            <span class="title">General</span>
            <span class="selected"></span>
            <span class="arrow open"></span>
        </a>
        <ul class="sub-menu">
            <li id="Men_Gene_Funcionarios" style="display:none">
                <a href="<?php echo MI_ROOT; ?>/modulos/general/funcionarios/index.php"><i class="fa fa-users"></i> Funcionarios </a>
            </li>
            <noscript>
                <li id="">
                    <a href="#">
                        <span class="title"></span> Remitentes<span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li id="Men_Gene_Remite_Natural" style="display:none">
                            <a href="#"> Persona Natural </a>
                        </li>
                        <li id="Men_Gene_Remite_Juridi" style="display:none">
                            <a href="index.html"> Presona Juridica</a>
                        </li>
                    </ul>
                </li>
            </noscript>
        </ul>
    </li>
    <li class="" id="Men_Mi_Archivo" style="display:none">
        <a href="index.html">
            <i class="fa fa-envelope"></i>
            <span class="title">Mi Archivo</span>
            <span class="selected"></span>
            <span class="arrow open"></span>
        </a>
        <ul class="sub-menu">
            <li id="Men_Mi_Archivo_Bandeja" style="display:none">
                <a href="<?php echo MI_ROOT; ?>/modulos/mi_archivo/bandeja/externa/recibidas/index.php"> Bandeja De Correo </a>
            </li>
            <li id="Men_Mi_Archivo_Digitalizados">
                <a href="<?php echo MI_ROOT; ?>/modulos/mi_archivo/archivo_digitalizado/index.php"> Archivo Digitalizado</a>
            </li>
            <li id="Men_Mi_Disco">
                <a href="#"> Mi Disco</a>
            </li>
        </ul>
    </li>
    <li class="" id="Men_Venta_Unica" style="display:none">
        <a href="#">
            <i class="fa fa-file-text"></i>
            <span class="title">Ventanilla Única</span>
            <span class="selected"></span>
            <span class="arrow open"></span>
        </a>
        <ul class="sub-menu">
            <li id="Men_Venta_Unica_Radica" style="display:none">
                <a href="<?php echo MI_ROOT; ?>/modulos/ventanilla/index.php"> Radicar Correspondencia </a>
            </li>
        </ul>
    </li>

    <li class="" id="Men_OfiArchi" style="display:none">
        <a href="#">
            <i class="fa fa-flag"></i>
            <span class="title">Ofi. Archivo</span>
            <span class="selected"></span>
            <span class="arrow open"></span>
        </a>

        <ul class="sub-menu">
            <li id="Men_OfiArchi_TRD" style="display:none">
                <a href="#">
                    <span class="title"> Retención Documental </span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li id="Men_OfiArchi_TRD_TRD" style="display:none">
                        <a href="<?php echo MI_ROOT; ?>/modulos/oficina_archivo/reten_documental/trd/index.php"> TRD </a>
                    </li>
                    <li id="Men_OfiArchi_Reten_Series" style="display:none">
                        <a href="<?php echo MI_ROOT; ?>/modulos/oficina_archivo/reten_documental/serie/index.php"> Series</a>
                    </li>
                    <li id="Men_OfiArchi_Reten_SubSeries" style="display:none">
                        <a href="<?php echo MI_ROOT; ?>/modulos/oficina_archivo/reten_documental/sub_serie/index.php"> Subserie</a>
                    </li>
                    <li id="Men_OfiArchi_Reten_TipoDocumento" style="display:none">
                        <a href="<?php echo MI_ROOT; ?>/modulos/oficina_archivo/reten_documental/tipo_documentos/index.php"> Tipos de Documentos</a>
                    </li>
                </ul>
            </li>
            <li id="Men_OfiArchi_Digitalizacion" style="display:none">
                <a href="#">
                    <span class="title"> Digitalización </span>
                    <span class="arrow "></span>
                </a>

                <ul class="sub-menu">
                    <li id="Men_OfiArchi_Digitalizacion">
                        <a href="<?php echo MI_ROOT; ?>/modulos/oficina_archivo/digitalizacion/digitalizar_trd/index.php"> Digitalizar con TRD</a>
                    </li>
                    <li id="Men_OfiArchi_Digitalizacion_TVD">
                        <a href="<?php echo MI_ROOT; ?>/modulos/oficina_archivo/digitalizacion/digitalizar_tvd/index.php"> Digitalizar con TVD</a>
                    </li>
                </ul>
            </li>
            <li id="Men_OfiArchi_Configuracion_TVD" style="display:none">
                <a href="#">
                    <span class="title"> Configuración de TVD </span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li id="Men_OfiArchi_Configuracion_TVD">
                        <a href="#">
                            <span class="title"> Configuración Organigrama </span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo MI_ROOT; ?>/modulos/oficina_archivo/tvd/dependencias/index.php"> Dependencias</a>
                            </li>
                            <li>
                                <a href="<?php echo MI_ROOT; ?>/modulos/oficina_archivo/tvd/oficinas/index.php"> Oficinas</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <span class="title"> Configuración TVD </span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo MI_ROOT; ?>/modulos/oficina_archivo/tvd/tvd/index.php"> TVD</a>
                            </li>
                            <li>
                                <a href="<?php echo MI_ROOT; ?>/modulos/oficina_archivo/tvd/serie/index.php"> Series</a>
                            </li>
                            <li>
                                <a href="<?php echo MI_ROOT; ?>/modulos/oficina_archivo/tvd/sub_serie/index.php"> Subseries</a>
                            </li>
                            <li>
                                <a href="<?php echo MI_ROOT; ?>/modulos/oficina_archivo/tvd/tipo_documentos/index.php"> Tipos Documentales</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </li>

    <li class="" id="Men_Calidad" style="display:none">
        <a href="#">
            <i class="fa fa-check-circle"></i>
            <span class="title">Calidad</span>
            <span class="selected"></span>
            <span class="arrow open"></span>
        </a>
        <ul class="sub-menu">
            <li id="Men_Calidad_Procesos" style="display:none">
                <a href="<?php echo MI_ROOT; ?>/modulos/calidad/procesos/"> Procesos </a>
            </li>
            <li id="Men_Calidad_Procedimientos" style="display:none">
                <a href="<?php echo MI_ROOT; ?>/modulos/calidad/procedimientos/"> Procedimientos </a>
            </li>
            <li id="Men_Caldiad_Repositorio" style="display:none">
                <a href="<?php echo MI_ROOT; ?>/modulos/calidad/repositorio/"> Repositorio </a>
            </li>
            <li id="Men_Calidad_Tipos_Documentos" style="display:none">
                <a href="<?php echo MI_ROOT; ?>/modulos/calidad/tipos_documentos/"> Tipos de documentos </a>
            </li>
        </ul>
    </li>

    <li class="" id="Men_Areas" style="display:none">
        <a href="#">
            <i class="fa fa-th"></i>
            <span class="title">Áreas</span>
            <span class="selected"></span>
            <span class="arrow open"></span>
        </a>
        <ul class="sub-menu">
            <li id="Men_Areas_Dependen" style="display:none">
                <a href="<?php echo MI_ROOT; ?>/modulos/areas/dependencias/index.php"> Dependencias </a>
            </li>
            <li id="Men_Areas_Oficinas" style="display:none">
                <a href="<?php echo MI_ROOT; ?>/modulos/areas/oficinas/index.php"> Oficinas </a>
            </li>
            <li id="Men_Areas_Cargos" style="display:none">
                <a href="<?php echo MI_ROOT; ?>/modulos/areas/cargos/index.php"> Cargos </a>
            </li>
        </ul>
    </li>
    <li class="" id="Men_Config" style="display:none">
        <a href="#">
            <i class="fa fa-cogs"></i>
            <span class="title">Configuración</span>
            <span class="selected"></span>
            <span class="arrow open"></span>
        </a>
        <ul class="sub-menu">
            <li id="Men_Config_FormaEnvio" style="display:none">
                <a href="<?php echo MI_ROOT; ?>/modulos/configuracion/forma_envio/index.php"> Formas de Envio </a>
            </li>
            <li id="Men_Config_Saludo" style="display:none">
                <a href="<?php echo MI_ROOT; ?>/modulos/configuracion/saludo/index.php"> Saludo </a>
            </li>
            <li id="Men_Config_Depedida" style="display:none">
                <a href="<?php echo MI_ROOT; ?>/modulos/configuracion/despedida/index.php"> Despedida </a>
            </li>
            <li id="Men_Config_Estatus" style="display:none">
                <a href="<?php echo MI_ROOT; ?>/modulos/configuracion/status/index.php"> Status </a>
            </li>
            <li id="Men_Config_tipos_correspondencia" style="display:none">
                <a href="<?php echo MI_ROOT; ?>/modulos/configuracion/tipo_correspondencia/index.php"> Tipo de Correspondencia </a>
            </li>
            <li id="Men_Config_tipos_documentos" style="display:none">
                <a href="<?php echo MI_ROOT; ?>/modulos/configuracion/tipos_documentos/index.php"> Tipo de documentos </a>
            </li>
            <li id="Men_Config_tipos_respuestas" style="display:none">
                <a href="<?php echo MI_ROOT; ?>/modulos/configuracion/tipos_respuesta/index.php"> Tipo de respuestas </a>
            </li>
            <li id="Men_Config_RutasGestion" style="display:none">
                <a href="<?php echo MI_ROOT; ?>/modulos/configuracion/ruta_gestion/index.php"> Rutas de Archivo de Gestión </a>
            </li>
            <li id="Men_Config_RutasTemp" style="display:none">
                <a href="<?php echo MI_ROOT; ?>/modulos/configuracion/ruta_temp/index.php"> Rutas para archivos Temp </a>
            </li>
            <li id="Men_Config_RutasDigitalizacion" style="display:none">
                <a href="<?php echo MI_ROOT; ?>/modulos/configuracion/ruta_digitalizacion/index.php"> Rutas para digitalización </a>
            </li>
            <li id="Men_Config_Otras" style="display:none">
                <a href="<?php echo MI_ROOT; ?>/modulos/configuracion/otras/index.php"> Otras configuraciones </a>
            </li>
        </ul>
    </li>
    <li class="" id="Men_Seguri" style="display:none">
        <a href="#">
            <i class="fa fa-unlock"></i>
            <span class="title">Seguridad</span>
            <span class="selected"></span>
            <span class="arrow open"></span>
        </a>
        <ul class="sub-menu">
            <li id="Men_Seguri_Explora" style="display:none">
                <a href="<?php echo MI_ROOT; ?>/modulos/seguridad/usuarios/index.php"><i class="fa fa-users"></i> Usuarios </a>
            </li>
            <li id="Men_Seguri_Perfiles" style="display:none">
                <a href="<?php echo MI_ROOT; ?>/modulos/seguridad/perfiles/index.php"> Explorador de Perfiles </a>
            </li>
        </ul>
    </li>
    <li class="" id="Men_Reportes" style="display:none">
        <a href="#">
            <i class="fa fa-folder"></i>
            <span class="title">Reportes</span>
            <span class="selected"></span>
            <span class="arrow open"></span>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="javascript:;">
                    <span class="title">Ventanilla Unica</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li><a href="<?php echo MI_ROOT; ?>/modulos/reportes/ventanilla/detallado/index.php"> Detallados</a></li>
                    <li><a href="<?php echo MI_ROOT; ?>/modulos/reportes/ventanilla/indicador/index.php"> Indicador</a></li>
                    <li><a href="#"> Pendientes</a></li>
                    <li><a href="<?php echo MI_ROOT; ?>/modulos/reportes/ventanilla/pqrsf/index.php"> PQRSF</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <span class="title">Ofi. Archivo</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li><a href="<?php echo MI_ROOT; ?>/modulos/reportes/oficina_archivo/trd/index.php"> TRD</a></li>
                </ul>
            </li>
        </ul>
    </li>
</ul>

<div class="clearfix"></div>

<?php
MenuPadre(0, "");

function MenuPadre($IndicePadre, $NodoPadre)
{

    $Menu = Usuario::Listar(8, $_SESSION['SesionUsuaId'], "", "", "", "", $IndicePadre, 0);

    $ModuloViejo = $IndicePadre;
    foreach ($Menu as $Item) :
        if ($Item['id_modu'] == 48) {
?>
            <script type="text/javascript">
                $("#Men_Config_RutasDigitalizacion").removeAttr("style");
            </script>
        <?php
        }
        if ($Item['modu_padre'] == 0) {
            //echo $Item['nom_modu']."<br>";
        ?>
            <script type="text/javascript">
                $("#<?php echo $Item['menu']; ?>").removeAttr("style");
            </script>
        <?php
        } else {
            //echo "P - ".$Item['id_modu']." - ".$Item['nom_modu']."<br>";
        ?>
            <script type="text/javascript">
                $("#<?php echo $Item['menu']; ?>").removeAttr("style");
            </script>
<?php
        }

        MenuPadre($Item['id_modu'], $Item['id_modu']);
    endforeach;
}
?>