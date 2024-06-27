<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

    session_start();
    include "../../../../config/class.Conexion.php";
    include("../../../../config/variable.php");
    include("../../../../config/funciones.php");
    include("../../../../config/funciones_seguridad.php");
    require_once '../../../clases/radicar/class.RadicaRecibidoPQRSF.php';

    $estado = session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
    if (!$estado) {
        session_start();
    }

    $action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';
    $TipoListar = $_REQUEST['tipo_listar'];

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

        if ($TipoListar == 'buscar') {
            $query_services = $Registro->Filtro();
            $numrows = $Registro->TotalRegistros_Filtro();
        } elseif ($TipoListar == 'listar') {
            $query_services = $Registro = RadicadoRecibidoPQRSF::Listar(['Accion' => $Accion, 'offset' => $offset, 'per_page' => $per_page, 'criterio' => $_REQUEST['criterio']]);
            $numrows = count($query_services);
        }
        echo "Accion: " . $Accion . "<br>Total: " . $numrows . "<br>Respon Princi: " . $_SESSION['SesionFuncioResponPrinci'] . " , Jefe Depen: " . $_SESSION['SesionFuncioJefeDependencia'] . ", Funcio deta: " . $_SESSION['SesionFuncioDetaId'];
        $total_pages = ceil($numrows / $per_page);
        $reload      = 'index.php';
?>
        <div class="row-fluid dataTables_wrapper">
            <div class="pull-right margin-top-20">
                <div class="dataTables_paginate paging_bootstrap pagination">
                    <?php echo paginate($reload, $page, $total_pages, $adjacents); ?>
                </div>
                <div class="dataTables_info hidden-xs" id="example_info">
                    Mostrando <b><?php echo $Mostrar; ?> </b> de <?php echo $numrows; ?>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div id="email-list">
            <table class="table table-hover" id="emails">
                <thead>
                    <div class="row form-row">
                        <div class="col-md-4"><strong>INFO. DE LA SOLICITUD</strong></div>
                        <div class="col-md-3"><strong>INFO. PETICIONARIO</strong></div>
                        <div class="col-md-4"><strong>INFO. AFECTADO</strong></div>
                        <div class="col-md-1"><strong>ACCIONES</strong></div>
                    </div>
                </thead>
                <tbody>
                    <?php

                    if ($numrows > 0) {
                        foreach ($query_services as $item) {
                    ?>
                            <tr id="TRRadicado" data-id_radicado="<?php echo $item['id_radica']; ?>">
                                <td class="small-cell v-align-middle">
                                    <div class="row">
                                        <div class="col-md-12 text-dark bg-info" style="background: <?php echo $BagroundColor; ?>">
                                            <span class="btn btn-info btn-xs btn-mini" style="margin-right:20px;font-size: 15px">
                                                <strong><?php echo $item['id_radica']; ?></strong>
                                            </span>
                                            <strong class="<?php echo $ColorTextoTitulo; ?>">
                                                <?php echo mb_convert_encoding($item['nom_contac'], 'UTF-8'); ?>
                                            </strong>
                                        </div>

                                        <hr style="border-width: 2px; height: 0px; border-style: dashed; border-color: default;" />
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <dl class="row">
                                                <dt class="col-sm-3">Fec. Radi:</dt>
                                                <dd class="col-sm-7"><?php echo $item['fechor_radica']; ?></dd>
                                                <br>

                                                <dt class="col-sm-3">Tip. solicitud:</dt>
                                                <dd class="col-sm-7"><?php echo $item['tipo_solicitud']; ?></dd>
                                                <br>

                                                <dt class="col-sm-3">Tip. Llega:</dt>
                                                <dd class="col-sm-7"><?php echo $item['nom_formaenvi']; ?></dd>
                                                <br>

                                                <dt class="col-sm-3">Fallo Judicial</dt>
                                                <dd class="col-sm-7"><?php echo $item['fallo_judicial']; ?></dd>
                                                <br>
                                            </dl>
                                        </div>

                                        <div class="col-md-3">
                                            <dl class="row">
                                                <dt class="col-sm-3">Peticionario:</dt>
                                                <dd class="col-sm-7"><?php echo $item['num_docu'] . "<br>" . $item['nom_contac']; ?></dd>
                                                <br>

                                                <dt class="col-sm-3">Dirección:</dt>
                                                <dd class="col-sm-7"><?php echo $item['depar_peticio'] . " - " . $item['muni_peticio'] . "<br>" . $item['dir_peticio']; ?></dd>
                                                <br>

                                                <dt class="col-sm-3">Teléfonos:</dt>
                                                <dd class="col-sm-7"><?php echo "Tel: " . $item['tel_peticio'] . " Cel: " . $item['cel_peticio']; ?></dd>
                                                <br>
                                            </dl>
                                        </div>

                                        <div class="col-md-3">
                                            <dl class="row">
                                                <dt class="col-sm-3">Afectado:</dt>
                                                <dd class="col-sm-7"><?php echo $item['num_docu_afectado'] . "<br>" . $item['nom_afectado']; ?></dd>
                                                <br>

                                                <dt class="col-sm-3">Dirección:</dt>
                                                <dd class="col-sm-7"><?php echo $item['depar_afectado'] . " - " . $item['muni_afectado'] . "<br>" . $item['dir_afectado']; ?></dd>
                                                <br>

                                                <dt class="col-sm-3">Teléfonos:</dt>
                                                <dd class="col-sm-7"><?php echo "Tel: " . $item['tel_afectado'] . " Cel: " . $item['movil_afectado']; ?></dd>
                                                <br>

                                                <dt class="col-sm-3">Regimen:</dt>
                                                <dd class="col-sm-7"><?php echo $item['nom_regimen']; ?></dd>
                                                <br>
                                            </dl>
                                        </div>

                                        <div class="col-md-2">
                                            <dl class="row">
                                                <!-- <button type="button" class="btn btn-warning btn-xs btn-mini btn-circle" data-toggle="modal" data-id_pqr="<?php echo $item['id_pqr']; ?>" id="BtnTramitarPQR" title="Tramitar PQRSF">
                                                    <i class="fa fa-pencil text-white"></i>
                                                </button> -->

                                                <a class="btn btn-warning btn-xs btn-mini btn-circle" href="/pqr_tramitar/<?php echo $item['id_pqr']; ?> " title="Tramitar PQRSF">
                                                    <i class="fa fa-pencil text-white"></i>
                                                </a>
                                            </dl>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <dl class="row">
                                                <dt class="col-sm-1">Asunto:</dt>
                                                <dd class="col-sm-11"><?php echo $item['detalle_solicitud']; ?></dd>
                                            </dl>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        }
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