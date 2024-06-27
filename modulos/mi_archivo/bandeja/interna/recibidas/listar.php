<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

    include "../../../../../config/class.Conexion.php";
    require_once '../../../../clases/radicar/class.RadicaInternoListarBandeja.php';
    require_once '../../../../clases/radicar/class.RadicaInternoResponsable.php';
    require_once '../../../../clases/radicar/class.RadicaInternoDestinatario.php';
    include("../../../../../config/variable.php");
    include("../../../../../config/funciones.php");

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

    $action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';
    if ($action == 'ajax') {

        if ($_SESSION['SesionFuncioResponPrinci'] == 1 or $_SESSION['SesionFuncioJefeDependencia'] == 1 or $_SESSION['SesionFuncioJefeOficina'] == 1) {

            if ($TipoListar == 'buscar') {
                if ($_SESSION['SesionFuncioResponPrinci'] == 1 and $TipoVer === 'VerTodo') {
                    $Accion = 5;
                } elseif ($TipoVer === 'VerMiCorrespondencia') {
                    $Accion = 6;
                } elseif ($_SESSION['SesionFuncioJefeDependencia'] == 1 and $TipoVer === 'VerTodo') {
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
                } elseif ($_SESSION['SesionFuncioJefeOficina'] == 1 and $TipoVer == 'VerTodo') {
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

        include 'pagination.php';

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
        //Cuenta el número total de filas de la tabla*/

        $Registro = new RadicadoInternoListarBandeja();
        $Registro->set_Accion($Accion);
        $Registro->set_IdFuncioSesion($_SESSION['SesionFuncioDetaId']);
        $Registro->set_Buscar($Buscar);
        $Registro->set_IdRadica($IdRadicado);
        $Registro->set_Asunto($Asunto);
        $Registro->set_QueContenga($QueContenga);
        $Registro->set_Buscar($Buscar);
        $Registro->set_IdDepen($_SESSION['SesionFuncioDepenId']);
        $Registro->set_IdOfi($_SESSION['SesionFuncioOfiId']);
        $Registro->set_Limite1($offset);
        $Registro->set_Limite2($per_page);
        $Registro->set_OrigenCorrespondencia('RECIBIDA');

        if ($TipoListar == 'buscar') {
            $query_services = $Registro->Filtro();
            $NumrRows = $Registro->TotalRegistros_Filtro();
        } elseif ($TipoListar == 'listar') {
            $query_services = $Registro->Listar();
            $NumrRows = $Registro->TotalRegistros_Listar();
        }

        $total_pages = ceil($NumrRows / $per_page);
        $reload      = 'index.php';

        //echo "Accion: ".$Accion."<br>Total: ".$NumrRows."<br>Respon Princi: ".$_SESSION['SesionFuncioResponPrinci']." , Jefe Depen: ".$_SESSION['SesionFuncioJefeDependencia'].", Funcio deta: ".$_SESSION['SesionFuncioDetaId']." , Total: ".$NumrRows;
        ?>
        <div class="row-fluid dataTables_wrapper">
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
                                <div class="col-md-5">Informacón del Radicado</div>
                                <div class="col-md-3">Detalle del Responsable</div>
                                <div class="col-md-3">Detalle del Destino</div>
                                <div class="col-md-1">Acciones</div>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody id="TblRadicados">
                    <?php
                    if ($NumrRows > 0) {

                        foreach ($query_services as $item) :

                            $Clase = "";
                            $ClaseTexto = "";
                            $ClaseColorTexto = "";
                            $DiasTrascurridos = "";
                            $DiasParaRespuesta = "";
                            $TotalDias = 0;
                            $FechaRadicado = $item['fechor_radica'];
                            $RequieRespues = "No";
                            $BagroundColor = "";
                            $ColorTextoTitulo = "";

                            if ($item['requie_respuesta'] == 1 and $item['radica_respuesta'] == '') {

                                $DiasTrascurridos  = DiasTrascurridos($item['fechor_radica']);
                                $DiasParaRespuesta = DiasParaRespuesta($item['fechor_radica'], $item['fec_venci']);
                                $TotalDias = $DiasParaRespuesta - $DiasTrascurridos;

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
                                    $ClaseTexto = "Pro Vencer";
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

                            $Remitente   = $item['nom_funcio_respon'] . " " . $item['ape_funcio_respon'];
                            $RadicadoPor = $item['nom_funcio_regis'] . " " . $item['ape_funcio_regis'];
                    ?>
                            <tr id="TRRadicado" data-id_radicado="<?php echo $item['id_radica']; ?>" class="<?php echo $Clase; ?>">
                                <td class="clickable">
                                    <div class="row">
                                        <div class="col-md-12 text-dark bg-info" style="background: <?php echo $BagroundColor; ?>">
                                            <span class="btn btn-info btn-xs btn-mini" style="margin-right:20px;font-size: 15px">
                                                <strong><?php echo $item['id_radica']; ?></strong>
                                            </span>
                                            <strong class="<?php echo $ColorTextoTitulo; ?>">
                                                <?php echo $Remitente; ?>
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
                                        <div class="col-md-5">
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
                                                <?php
                                                $Responsable = RadicadoInternoResponsable::Listar(1, $item['id_radica'], "");
                                                foreach ($Responsable as $ItemRespon) {
                                                ?>
                                                    <dd class="col-sm-12">
                                                        <i class="fa fa-user" style="margin-right:10px; margin-left:10px;"></i>
                                                        <?php echo $ItemRespon['nom_funcio'] . " " . $ItemRespon['ape_funcio'] . "<br>Depen.: " . $ItemRespon['nom_depen'] . "<br>Ofi.: " . $ItemRespon['nom_oficina']; ?>
                                                    </dd>
                                                <?php
                                                }
                                                ?>
                                            </dl>
                                        </div>

                                        <div class="col-md-3">
                                            <dl class="row">
                                                <?php
                                                $Destinatarios = RadicadoInternoDestinatario::Listar(1, $item['id_radica'], "");
                                                foreach ($Destinatarios as $ItemDestina) {
                                                ?>
                                                    <dd class="col-sm-12">
                                                        <i class="fa fa-user" style="margin-right:10px; margin-left:10px;"></i>
                                                        <?php echo $ItemDestina['nom_funcio'] . " " . $ItemDestina['ape_funcio'] . "<br>Depen.: " . $ItemDestina['nom_depen'] . "<br>Ofi.: " . $ItemDestina['nom_oficina']; ?>
                                                    </dd>
                                                <?php
                                                }
                                                ?>
                                            </dl>
                                        </div>

                                        <div class="col-md-1">
                                            <dl class="row">

                                                <button type="button" class="btn btn-success btn-circle" id="BtnMostarInfoRadicadoInterno" data-id_radicado="<?php echo $item['id_radica']; ?>" title="Info. del radicado">
                                                    <i class="fa fa-info"></i>
                                                </button>

                                                <?php
                                                if ($item['requie_respuesta'] == 1 and $item['radica_respuesta'] == '') {
                                                ?>
                                                    <button type="button" class="btn btn-primary btn-circle" id="BtnResponderCorrespondencia" title="Responder correspondencia" data-id_radicado="<?php echo $item['id_radica']; ?>">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                <?php
                                                }
                                                ?>
                                                <noscript>
                                                    <button type="button" class="btn btn-info btn-circle" data-toggle="modal" data-target="#myModalMostrarFuncionariosCompartir" id="BtnCompartirRadicado" data-id_radicado="<?php echo $item['id_radica']; ?>" title="Copartir radicado">
                                                        <i class="fa fa-users"></i>
                                                    </button>
                                                </noscript>

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
                </tbody>
            </table>
        </div>
<?php
    }
}
?>