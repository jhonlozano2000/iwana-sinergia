<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

    session_start();
    include "../../../../config/class.Conexion.php";
    include("../../../../config/variable.php");
    include("../../../../config/funciones.php");
    include("../../../../config/funciones_seguridad.php");
    require_once '../../../clases/radicar/class.RadicaInternoListarBandeja.php';
    require_once '../../../clases/radicar/class.RadicaInternoDestinatario.php';
    require_once '../../../clases/radicar/class.RadicaInternoResponsable.php';

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

    $Accion = "";
    if ($TipoListar == 'buscar') {
        $Accion = 5;
    } elseif ($TipoListar == 'listar') {
        $Accion = 1;
    }

    if ($action == 'ajax') {
        include 'pagination.php'; //incluir el archivo de paginación
        //las variables de paginación
        $page          = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
        $per_page      = 50; //la cantidad de registros que desea mostrar
        $adjacents     = 4; //brecha entre páginas después de varios adyacentes
        $TotalPrimeros = 0;
        $TotalUltimos  = 0;
        $TotalPrimeros = ($page * $per_page) - $per_page;
        $TotalUltimos  = ($page * $per_page);
        $Mostrar       = $TotalPrimeros . ' a ' . $TotalUltimos;
        $offset        = ($page - 1) * $per_page;

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

        //echo "Accion: ".$Accion;
        $total_pages = ceil($NumrRows / $per_page);
        $reload      = 'index.php';
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
                <tbody>
                    <?php

                    if ($NumrRows > 0) {

                        foreach ($query_services as $item):
                            $i = 0;

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

                            if ($item['fec_venci'] != "" and $item['requie_respuesta'] == 1) {

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

                            $Remitente  = $item['nom_funcio_respon'] . " " . $item['ape_funcio_respon'];
                            $RadicadoPor = $item['nom_funcio_radi'] . " " . $item['ape_funcio_radi'];
                    ?>
                            <tr id="TRRadicado" data-id_radicado="<?php echo $item['id_radica']; ?>">
                                <td class="small-cell v-align-middle">
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

                                            <button type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target="#myModalMostrarInfoRadicadoInterno" id="BtnMostarInfoRadicadoInterno" data-id_radicado="<?php echo $item['id_radica']; ?>" data-nombre_archivo="<?php echo $item['nombre_archivo']; ?>" title="Info. del radicado">
                                                <i class="fa fa-info"></i>
                                            </button>
                                            <?php

                                            if ($item['adjunto'] == 0) {
                                            ?>
                                                <button type="button" class="btn btn-warning btn-xs btn-mini idradicado btn-circle" data-toggle="modal" data-target="#myModalAdjuntarDocumento" data-id_radicado="<?php echo $item['id_radica']; ?>" title="Subir archivo">
                                                    <i class="fa fa-cloud-upload"></i>
                                                </button>
                                            <?php
                                            }

                                            if ($item['impri_rotu'] == 1) {
                                                $ClaseImpimirRotulo = "primary";
                                            } elseif ($item['impri_rotu'] == 0) {
                                                $ClaseImpimirRotulo = "warning";
                                            }
                                            ?>

                                            <button type="button" class="ImprimirRotulo btn btn-<?php echo $ClaseImpimirRotulo; ?> btn-xs btn-mini btn-circle" data-toggle="modal" data-target="#myModalImprimirRotulo" data-id_radicado="<?php echo $item['id_radica']; ?>" id="BtnImprimirRotulo<?php echo $item['id_radica']; ?>" title="Imprimir rotulo">
                                                <i class="fa fa-credit-card"></i>
                                            </button>

                                            <?php
                                            if ($item['fec_venci'] != "") {
                                            ?>
                                                <button type="button" class="btn btn-success btn-xs btn-mini btn-circle">
                                                    <i class="fa fa-envelope-o"></i>
                                                </button>
                                            <?php
                                            }
                                            ?>
                                            <noscript>
                                                <?php
                                                if ($item['requie_respuesta'] == 1) {
                                                ?>
                                                    <button type="button" class="btn btn-primary btn-circle" id="BtnResponderCorrespondencia" title="Responder correspondencia" data-id_radicado="<?php echo $item['id_radica']; ?>">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                <?php
                                                }
                                                ?>

                                                <button type="button" class="btn btn-info btn-circle" data-toggle="modal" data-target="#myModalMostrarFuncionariosCompartir" id="BtnCompartirRadicado" data-id_radicado="<?php echo $item['id_radica']; ?>" title="Copartir radicado">
                                                    <i class="fa fa-users"></i>
                                                </button>
                                            </noscript>

                                            <button type="button" class="btn btn-default btn-xs btn-mini btn-circle" data-toggle="modal" data-target="#myModalSubirDocumentosAdicionales" data-id_radicado="<?php echo $item['id_radica']; ?>" id="BtnSubirDocumentosAdicionales" title="Cargar documentos adicionales">
                                                <i class="fa fa-paperclip"></i>
                                            </button>

                                            <button type="button" class="btn btn-info btn-xs btn-mini btn-circle" id="BtnEliminarDocumentoDigital" data-id_radicado="<?php echo $item['id_radica']; ?>" title="Eliminar documento digital">
                                                <i class="fa fa-file text-white"></i>
                                            </button>
                                            <?php
                                            $i++;
                                            if ($i == 1) {
                                            ?>
                                                <button type="button" class="btn btn-info btn-xs btn-mini btn-circle" id="BtnEliminarRadicado" data-id_radicado="<?php echo $item['id_radica']; ?>" title="Eliminar radicado">
                                                    <i class="fa fa-eraser text-white"></i>
                                                </button>
                                            <?php
                                            }
                                            ?>
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