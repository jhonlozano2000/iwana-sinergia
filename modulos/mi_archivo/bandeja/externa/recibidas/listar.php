<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    include "../../../../../config/class.Conexion.php";
    require_once '../../../../clases/radicar/class.RadicaRecibidoListarBandeja.php';
    require_once '../../../../clases/general/class.GeneralFuncionario.php';
    include("../../../../../config/variable.php");
    include("../../../../../config/funciones.php");

    $FuncionPrincipal = Funcionario::Buscar(13, "", "", "", "", "", "", "");

    $estado = session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
    if (!$estado) {
        session_start();
    }

    $Accion        = 0;
    $Buscar        = isset($_POST['Buscar']) ? $_POST['Buscar'] : null;
    $IdRadicado    = isset($_POST['IdRadicado']) ? $_POST['IdRadicado'] : null;
    $IdTercero     = isset($_POST['IdTercero']) ? $_POST['IdTercero'] : null;
    $IdFuncionario = isset($_POST['IdFuncionario']) ? $_POST['IdFuncionario'] : null;
    $Asunto        = isset($_POST['Asunto']) ? $_POST['Asunto'] : null;
    $QueContenga   = isset($_POST['QueContenga']) ? $_POST['QueContenga'] : null;
    $IdDependencia = isset($_POST['IdDependencia']) ? $_POST['IdDependencia'] : null;
    $IdOficina     = isset($_POST['IdOficina']) ? $_POST['IdOficina'] : null;

    $TipoListar = $_REQUEST['tipo_listar'];
    $TipoVer     = isset($_REQUEST['tipo_ver']) ? $_REQUEST['tipo_ver'] : 'VerMiCorrespondencia';
?>
    <div class="row-fluid dataTables_wrapper">
        <?php

        if ($_SESSION['SesionFuncioResponPrinci'] == 1 or $_SESSION['SesionFuncioJefeDependencia'] == 1 or $_SESSION['SesionFuncioJefeOficina'] == 1) {

            if ($TipoListar == 'buscar') {
                if ($_SESSION['SesionFuncioResponPrinci'] == 1 and $TipoVer == 'VerTodo') {
                    $Accion = 5;
                } elseif ($TipoVer == 'VerMiCorrespondencia') {
                    $Accion = 6;
                } elseif ($_SESSION['SesionFuncioJefeDependencia'] == 1 and $TipoVer == 'VerTodo') {
                    $Accion = 7;
                } elseif ($_SESSION['SesionFuncioJefeOficina'] == 1 and $TipoVer === 'VerTodo') {
                    $Accion = 8;
                }
            } elseif ($TipoListar == 'listar') {
                if ($_SESSION['SesionFuncioResponPrinci'] == 1 and $TipoVer == 'VerTodo') {
                    $Accion = 1;
                } elseif ($TipoVer == 'VerMiCorrespondencia') {
                    $Accion = 2;
                } elseif ($_SESSION['SesionFuncioJefeDependencia'] == 1 and $TipoVer == 'VerTodo') {
                    $Accion = 3;
                } elseif ($_SESSION['SesionFuncioJefeOficina'] == 1 and $TipoVer === 'VerTodo') {
                    $Accion = 4;
                }
            }
        ?>
            <h4 class=" inline">Ver </h4>
            <div class="btn-group m-l-10 m-b-10">
                <a href="#" data-toggle="dropdown" class="btn btn-white btn-mini dropdown-toggle">
                    <span class="caret single"></span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a id="TipoVer" data-tipo_ver="VerMiCorrespondencia" href="#">Mi correspondencia</a>
                    </li>
                    <li>
                        <a id="TipoVer" data-tipo_ver="VerTodo" href="#">Todo</a>
                    </li>
                </ul>
            </div>
        <?php
        } else {
            if ($TipoListar == 'buscar') {
                $Accion = 6;
            } elseif ($TipoListar == 'listar') {
                $Accion = 2;
            }
        }

        $action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';
        if ($action == 'ajax') {
            //incluir el archivo de paginación
            include 'pagination.php';
            //las variables de paginación
            $page          = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
            //la cantidad de registros que desea mostrar
            $per_page      = 50;
            //brecha entre páginas después de varios adyacentes
            $adjacents     = 4;
            $TotalPrimeros = 0;
            $TotalUltimos  = 0;
            $TotalPrimeros = ($page * $per_page) - $per_page;
            $TotalUltimos  = ($page * $per_page);
            $Mostrar       = $TotalPrimeros . ' a ' . $TotalUltimos;
            $offset        = ($page - 1) * $per_page;

            $Registro = new RadicadoRecibidoListarBandeja();
            $Registro->set_Accion($Accion);
            $Registro->set_IdFuncioSesion($_SESSION['SesionFuncioDetaId']);
            $Registro->set_Buscar($Buscar);
            $Registro->set_IdRadica($IdRadicado);
            $Registro->set_IdTercero($IdTercero);
            $Registro->set_IdFuncioDeta($IdFuncionario);
            $Registro->set_Asunto($Asunto);
            $Registro->set_QueContenga($QueContenga);
            $Registro->set_IdDepen($_SESSION['SesionFuncioDepenId']);
            $Registro->set_IdOfi($_SESSION['SesionFuncioOfiId']);
            $Registro->set_Limite1($offset);
            $Registro->set_Limite2($per_page);

            if ($TipoListar == 'buscar') {
                $query_services = $Registro->Filtro();
                $NumrRows = $Registro->TotalRegistros_Filtro();
            } elseif ($TipoListar == 'listar') {
                $query_services = $Registro->Listar();
                $NumrRows = $Registro->TotalRegistros_Listar();
            }

            // echo "Accion: " . $Accion . "<br>Total: " . $NumrRows . "<br>Respon Princi: " . $_SESSION['SesionFuncioResponPrinci'] . " , Jefe Depen: " . $_SESSION['SesionFuncioJefeDependencia'] . ", Funcio deta: " . $_SESSION['SesionFuncioDetaId'] . " ---- Tipo listar: " . $TipoListar . " --- Limites " . $offset . " " . $per_page . " --- Tipo ver " . $TipoVer;

            $total_pages = ceil($NumrRows / $per_page);
            $reload      = 'index.php';
        ?>
            <div class="pull-right margin-top-20">
                <div class="dataTables_paginate paging_bootstrap pagination">
                    <?php echo paginate($reload, $page, $total_pages, $adjacents); ?>
                </div>
                <div class="dataTables_info hidden-xs" id="example_info">
                    Mostrando <b><?php echo $Mostrar; ?> </b> de <?php echo $NumrRows; ?>
                </div>
            </div>
    </div>
    <div class="clearfix"></div>
    <div id="email-list">
        <table class="table table-hover" id="emails">
            <thead>
                <tr>
                    <th>
                        <div class="row form-row">
                            <div class="col-md-4">Informacón del Radicado</div>
                            <div class="col-md-3">Informacón Basica</div>
                            <div class="col-md-4">Detalle del Destino</div>
                            <div class="col-md-1">Acciones</div>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php

                if ($NumrRows > 0) {

                    foreach ($query_services as $item) :

                        $Clase             = "";
                        $ClaseTexto        = "";
                        $ClaseColorTexto   = "";
                        $DiasTrascurridos  = "";
                        $DiasParaRespuesta = "";
                        $TotalDias         = 0;
                        $FechaRadicado     = $item['fechor_radica'];
                        $RequieRespues     = "No";
                        $BagroundColor     = "";
                        $ColorTextoTitulo  = "";

                        if ($item['requie_respues'] == 1 and $item['respondido'] == 0) {

                            $DiasTrascurridos  = DiasTrascurridos($item['fechor_radica']);
                            $DiasParaRespuesta = DiasParaRespuesta($item['fechor_radica'], $item['fec_venci']);
                            $TotalDias         = $DiasParaRespuesta - $DiasTrascurridos;

                            $TiempoTrascurrido = "";
                            if ($TotalDias < 0) {
                                $Clase = "danger";
                                $ClaseTexto = "Vencido";
                                $ClaseColorTexto = "text-error";
                                $TiempoTrascurrido = "<strong>Retraso de " . $TotalDias . " días</strong>";
                                $FechaRadicado = "<strong>" . $item['fechor_radica'] . "</strong>";
                                $RequieRespues = "<strong>Si</strong>";
                                $BagroundColor = "#FA5858";
                                $ColorTextoTitulo = "text-white";
                            } elseif ($TotalDias >= 0 and $TotalDias <= 3) {
                                $Clase = "warning";
                                $ClaseTexto = "Por Vencer";
                                $ClaseColorTexto = "text-warning";
                                $TiempoTrascurrido = "<strong>Faltan " . $TotalDias . " días de " . $DiasParaRespuesta . "</strong>";
                                $FechaRadicado = "<strong>" . $item['fechor_radica'] . "</strong>";
                                $RequieRespues = "<strong>Si</strong>";
                                $BagroundColor = "#FACC2E";
                                $ColorTextoTitulo = "text-light";
                            } elseif ($TotalDias >= 4 and $TotalDias <= 5) {
                                $Clase = "warning";
                                $ClaseTexto = "Por Vencer";
                                $ClaseColorTexto = "text-warning";
                                $TiempoTrascurrido = "<strong>Faltan " . $TotalDias . " días de " . $DiasParaRespuesta . "</strong>";
                                $FechaRadicado = "<strong>" . $item['fechor_radica'] . "</strong>";
                                $RequieRespues = "<strong>Si</strong>";
                                $BagroundColor = "#FACC2E";
                                $ColorTextoTitulo = "text-light";
                            } elseif ($TotalDias > 5) {
                                $Clase = "";
                                $ClaseTexto = "";
                                $ClaseColorTexto = "";
                                $TiempoTrascurrido = "<strong>Faltan " . $TotalDias . " días de " . $DiasParaRespuesta . "</strong>";
                                $FechaRadicado = "<strong>" . $item['fechor_radica'] . "</strong>";
                                $RequieRespues = "<strong>Si</strong>";
                                $ColorTextoTitulo = "";
                            }
                        } else {
                            $Clase = "";
                            $ClaseTexto = "";
                            $ClaseColorTexto = "";
                            $TiempoTrascurrido = "---";
                        }

                        $Remitente = "";
                        if ($item['razo_soci'] != "") {
                            $Remitente = $item['razo_soci'];
                        } else {
                            $Remitente = $item['nom_contac'];
                        }

                        $Destinatario = $item['nom_funcio'] . " " . $item['ape_funcio'] . ", Depen.: " . $item['nom_depen'] . ", Ofi.: " . $item['nom_oficina'];
                        $RadicadoPor = $item['nom_funcio_radi'] . " " . $item['ape_funcio_radi'];

                        if ($item['requie_respues'] == 1) {
                            $RequieRespues = "Si";
                        }

                ?>
                        <tr id="TRRadicado<?php echo $item['id_radica']; ?>" data-id_radicado="<?php echo $item['id_radica']; ?>">
                            <td class="small-cell v-align-middle">
                                <div class="row">
                                    <div class="col-md-12 text-dark bg-info" style="background: <?php echo $BagroundColor; ?>">

                                        <span class="btn btn-info btn-xs btn-mini" style="margin-right:20px;font-size: 15px">
                                            <strong><?php echo $item['id_radica']; ?></strong>
                                        </span>
                                        <?php
                                        if ($item['pase'] == 1) {
                                        ?>
                                            <span class="btn btn-warning btn-xs btn-mini" style="margin-right:20px;font-size: 15px">
                                                <strong style="margin-right:20px;font-size: 15px">Pase <i class="fa fa-search text-info" id="BtnHispotialPase" data-toggle="modal" data-target="#myModalHistoriaPase" data-id_radicado="<?php echo $item['id_radica']; ?>" title="Ver historial de pase"></i></strong>
                                            </span>
                                        <?php
                                        }
                                        ?>
                                        <strong class="<?php echo $ColorTextoTitulo; ?>">
                                            <?php echo $Remitente; ?>
                                        </strong>
                                        <i class="fa fa-sign-in text-success" style="margin-right:10px; margin-left:10px;"></i>
                                        <strong class="<?php echo $ColorTextoTitulo; ?>">
                                            <?php echo $Destinatario; ?>
                                        </strong>
                                        <?php
                                        if ($Clase != "") {
                                        ?>
                                            <span class="label label-<?php echo $Clase; ?> pull-right text-dark"><?php echo $ClaseTexto; ?></span>
                                        <?php
                                        }
                                        ?>
                                    </div>

                                    <hr style="border-width: 2px; height: 0px; border-style: dashed; border-color: default;" />
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <dl class="row">
                                            <dt class="col-sm-4">Requi. Respues:</dt>
                                            <dd class="col-sm-7 <?php echo $ClaseColorTexto; ?>"><?php echo $RequieRespues; ?></dd>
                                            <br>
                                            <br>

                                            <dt class="col-sm-4">Tiempo:</dt>
                                            <dd class="col-sm-7 <?php echo $ClaseColorTexto; ?>"><?php echo $TiempoTrascurrido; ?></dd>
                                            <br>

                                            <dt class="col-sm-4">Fec. Radi:</dt>
                                            <dd class="col-sm-7 <?php echo $ClaseColorTexto; ?>"><?php echo $FechaRadicado; ?></dd>
                                            <br>

                                            <dt class="col-sm-4">Usua. que Radico:</dt>
                                            <dd class="col-sm-7"><?php echo $RadicadoPor; ?></dd>
                                        </dl>
                                    </div>

                                    <div class="col-md-3">
                                        <dl class="row">
                                            <dt class="col-sm-3">Remitente:</dt>
                                            <dd class="col-sm-7"><?php echo $Remitente; ?></dd>

                                            <?php
                                            if ($item['radica_respuesta'] != "") {
                                            ?>
                                                <dt class="col-sm-3">Respuesta:</dt>
                                                <dd class="col-sm-7"><?php echo $item['radica_respuesta']; ?></dd>
                                            <?php
                                            }
                                            ?>

                                            <dt class="col-sm-3">Tip. Llega:</dt>
                                            <dd class="col-sm-7"><?php echo $item['nom_forma_llega']; ?></dd>
                                        </dl>
                                    </div>

                                    <div class="col-md-4">
                                        <dl class="row">
                                            <?php
                                            $TotalCadena = explode(" ", $item['nom_funcio'] . " " . $item['ape_funcio']);
                                            $Saltos = "";
                                            if (count($TotalCadena) == 4) {
                                                $Saltos = "<br><br>";
                                            } else {
                                                $Saltos = "<br>";
                                            }
                                            ?>
                                            <dt class="col-sm-2">Respon:</dt>
                                            <dd class="col-sm-7"><?php echo $item['nom_funcio'] . " " . $item['ape_funcio']; ?></dd>
                                            <?php echo $Saltos; ?>

                                            <dt class="col-sm-2">Depen:</dt>
                                            <dd class="col-sm-7"><?php echo $item['nom_depen']; ?></dd>
                                            <br>

                                            <dt class="col-sm-2">Ofi:</dt>
                                            <dd class="col-sm-7"><?php echo $item['nom_oficina']; ?></dd>
                                        </dl>
                                    </div>

                                    <div class="col-md-2">
                                        <dl class="row">
                                            <button type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target="#myModalMostrarInfoRadicadoRecibido" id="BtnMostarInfoRadicadoRecibido" data-id_radicado="<?php echo $item['id_radica']; ?>" title="Info. del radicado">
                                                <i class="fa fa-info"></i>
                                            </button>

                                            <?php

                                            if ($item['autoriza'] == 0) {
                                            ?>
                                                <button type="button" class="btn btn-success btn-circle" id="btnAutorizar" data-id_radicado="<?php echo $item['id_radica']; ?>" title="Autorizar radiado">
                                                    <i class="fa fa-lock"></i>
                                                </button>
                                            <?php
                                            }

                                            if ($item['requie_respues'] == 1) {
                                            ?>
                                                <button type="button" class="btn btn-primary btn-circle" id="BtnResponderCorrespondencia" title="Responder correspondencia" data-id_radicado="<?php echo $item['id_radica']; ?>">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                            <?php
                                            }
                                            ?>

                                            <button type="button" class="btn btn-info btn-circle" data-toggle="modal" data-target="#myModalMostrarFuncionariosCompartir" id="BtnCompartirRadicado" data-id_radicado="<?php echo $item['id_radica']; ?>" title="Compartir radicado">
                                                <i class="fa fa-users"></i>
                                            </button>

                                            <p role="presentation" class="divider"></p>
                                            <button type="button" class="btn btn-white btn-circle" id="BtnPase" data-toggle="modal" data-target="#myModalfuncionariosPase" data-id_radicado="<?php echo $item['id_radica']; ?>" title="Pasar radicado">
                                                <i class="fa fa-hand-o-right text-info"></i>
                                            </button>

                                            <?php
                                            if ($item['pase'] == 1) {
                                            ?>
                                                <button type="button" class="btn btn-white btn-circle" id="BtnClasificacionDocumental" data-toggle="modal" data-target="#myModalClasificacionDocumental" data-id_radicado="<?php echo $item['id_radica']; ?>" title="Establecer clasificacón documental">
                                                    <i class="fa fa-tag text-warning"></i>
                                                </button>
                                            <?php
                                            }
                                            ?>

                                            <button type="button" class="btn btn-white btn-circle" id="BtnDelegarGrupoColaborativo" data-toggle="modal" data-target="#myModalTodosLosFuncionarios" data-id_radicado="<?php echo $item['id_radica']; ?>" title="Delegar la creación del grupo colaborativo">
                                                <i class="fa fa-crosshairs text-info"></i>
                                            </button>
                                        </dl>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <dl class="row">
                                            <dt class="col-sm-1">Asunto:</dt>
                                            <dd class="col-sm-11"><?php echo $item['asunto']; ?></dd>
                                        </dl>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
            </tbody>
        <?php
                } else {
        ?>
            <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4>Aviso!!!</h4> No hay datos para mostrar
            </div>
        <?php
                }
        ?>
        </table>
    </div>
<?php
        }
    }
?>