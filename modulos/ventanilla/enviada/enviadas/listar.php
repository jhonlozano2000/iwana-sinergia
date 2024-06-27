<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){

    session_start();
    include "../../../../config/class.Conexion.php";
    include( "../../../../config/variable.php");
    include( "../../../../config/funciones.php");
    include( "../../../../config/funciones_seguridad.php");
    require_once '../../../clases/radicar/class.RadicaEnviado.php';
    require_once '../../../clases/radicar/class.RadicaEnviadoQuienFirma.php';
    require_once '../../../clases/radicar/class.RadicaEnviadoResponsable.php';
    require_once '../../../clases/radicar/class.RadicaEnviadoProyectores.php';
    require_once '../../../clases/radicar/class.RadicaEnviadoListarBandeja.php';

    $estado = session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
    if(!$estado){
        session_start();
    }

    $action        = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    $Buscar        = isset($_POST['Buscar']) ? $_POST['Buscar'] : null;
    $IdRadicado    = isset($_POST['IdRadicado']) ? $_POST['IdRadicado'] : null;
    $IdTercero     = isset($_POST['IdTercero']) ? $_POST['IdTercero'] : null;
    $IdFuncionario = isset($_POST['IdFuncionario']) ? $_POST['IdFuncionario'] : null;
    $Asunto        = isset($_POST['Asunto']) ? $_POST['Asunto'] : null;
    $QueContenga   = isset($_POST['QueContenga']) ? $_POST['QueContenga'] : null;
    $IdDependencia = isset($_POST['IdDependencia']) ? $_POST['IdDependencia'] : null;
    $IdOficina     = isset($_POST['IdOficina']) ? $_POST['IdOficina'] : null;

    $TipoListar = $_REQUEST['tipo_listar'];

    $Accion = "";
    if($TipoListar == 'buscar'){
        $Accion = 5;
    }elseif($TipoListar == 'listar'){
        $Accion = 1;
    }

    if($action == 'ajax'){
        include 'pagination.php'; //incluir el archivo de paginación
        //las variables de paginación
        $page          = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
        $per_page      = 50; //la cantidad de registros que desea mostrar
        $adjacents     = 4; //brecha entre páginas después de varios adyacentes
        $TotalPrimeros = 0;
        $TotalUltimos  = 0;
        $TotalPrimeros = ($page*$per_page)-$per_page;
        $TotalUltimos  = ($page*$per_page);
        $Mostrar       = $TotalPrimeros.' a '.$TotalUltimos;
        $offset        = ($page - 1) * $per_page;

        $Registro = new RadicadoEnviadoListarBandeja();
        $Registro->set_Accion($Accion);
        $Registro->set_Buscar($Buscar);
        $Registro->set_IdRadica($IdRadicado);
        $Registro->set_IdTercero($IdTercero);
        $Registro->set_IdFuncioDeta($IdFuncionario);
        $Registro->set_Asunto($Asunto);
        $Registro->set_QueContenga($QueContenga);
        $Registro->set_IdDepen($IdDependencia);
        $Registro->set_IdOfi($IdOficina);
        $Registro->set_Limite1($offset);
        $Registro->set_Limite2($per_page);

        if($TipoListar == 'buscar'){
            $query_services = $Registro->Filtro();
            $numrows = $Registro->TotalRegistros_Filtro();
        }elseif($TipoListar == 'listar'){
            $query_services = $Registro->Listar();
            $numrows = $Registro->TotalRegistros_Listar();
        }

        $total_pages = ceil($numrows/$per_page);
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
                        <div class="col-md-3"><strong>INFO. DEL RADICADO</strong></div>
                        <div class="col-md-3"><strong>QUIENES FIRMAN</strong></div>
                        <div class="col-md-3"><strong>RESPONSABLES</strong></div>
                        <div class="col-md-2"><strong>PROYECTORES</strong></div>
                        <div class="col-md-1"><strong></strong></div>
                    </div>
                </thead>
                <tbody>
                    <?php

                    if($numrows>0){
                        $i = 0;

                        foreach($query_services as $item){
                            $Remitente = "";
                            if($item['razo_soci'] != ""){
                                $Remitente = $item['razo_soci'];
                            }else{
                                $Remitente = $item['nom_contac'];
                            }
                            ?>
                            <tr id="TRRadicado<?php echo $item['id_radica']; ?>" data-id_radicado="<?php echo $item['id_radica']; ?>">
                                <td class="small-cell v-align-middle">
                                    <div class="row">
                                        <div class="col-md-12 text-dark bg-info" style="background: <?php echo $BagroundColor; ?>">

                                            <span class="btn btn-info btn-xs btn-mini" style="margin-right:20px;font-size: 15px">
                                                <strong><?php echo $item['id_radica']; ?></strong>
                                            </span>

                                            <strong class="<?php echo $ColorTextoTitulo; ?>">
                                                <?php echo $Remitente; ?>
                                            </strong>
                                            <i class="fa fa-sign-in text-success" style="margin-right:10px; margin-left:10px;"></i>
                                            <strong>
                                                <?php echo $item['nom_funcio']." ".$item['ape_funcio'].", Depen:.".$item['nom_depen']."->Ofi.:".$item['nom_oficina']; ?>
                                            </strong>
                                        </div>

                                        <hr style="border-width: 2px; height: 0px; border-style: dashed; border-color: default;"/>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <dl class="row">
                                                <dt class="col-sm-2">Estado:</dt>
                                                <br>
                                                <dd class="col-sm-10">
                                                    <?php

                                                    ?>
                                                </dd>

                                                <dt class="col-sm-5">Fec. Hor. Creación:</dt>
                                                <br>
                                                <dd class="col-sm-7"><?php echo $item['fechor_radica']; ?></dd>

                                                <br>

                                                <dt class="col-sm-5">Usua. que   Crea:</dt>
                                                <br>
                                                <dd class="col-sm-9"><?php echo $item['nom_funcio_radi']." ".$item['ape_funcio_radi']; ?></dd>

                                            </dl>
                                        </div>

                                        <div class="col-md-3">
                                            <dl class="row">
                                                <?php
                                                $QuienesFirman = RadicadoEnviadoQuienFirma::Listar(1, $item['id_radica'], "");
                                                foreach($QuienesFirman as $ItemQuienesFirman):
                                                    $Class = "";
                                                    $array = explode(" ", $ItemQuienesFirman['ape_funcio']);
                                                    $NomQuienesFirman = $ItemQuienesFirman['nom_funcio']." ".$array[0]."<br>".$ItemQuienesFirman['nom_depen']."<br>".$ItemQuienesFirman['nom_oficina'];
                                                    ?>
                                                    <dd class="col-sm-12">
                                                        <p>
                                                            <?php
                                                            if($ItemQuienesFirman['firma_principal'] == 1){
                                                                ?>
                                                                <i class="fa fa-dot-circle-o text-primary"></i>
                                                                <?php
                                                            }
                                                            ?>
                                                            <?php echo $NomQuienesFirman; ?>
                                                        </p>
                                                    </dd>
                                                    <?php
                                                endforeach;
                                                ?>
                                            </dl>
                                        </div>

                                        <div class="col-md-3">
                                            <dl class="row">
                                                <?php
                                                $Responsables = RadicadoEnviadoResponsable::Listar(1, $item['id_radica'], "", "", "", "");
                                                foreach($Responsables as $ItemResponsables):
                                                    $Class = "";
                                                    $array = explode(" ", $ItemResponsables['ape_funcio']);
                                                    $NomResponsable = $ItemResponsables['nom_funcio']." ".$array[0]."<br>".$ItemResponsables['nom_depen']."<br>".$ItemResponsables['nom_oficina'];
                                                    ?>
                                                    <dd class="col-sm-12">
                                                        <p>
                                                            <?php
                                                            if($ItemResponsables['respon'] == 1){
                                                                ?>
                                                                <i class="fa fa-dot-circle-o text-primary"></i>
                                                                <?php
                                                            }
                                                            ?>
                                                            <?php echo $NomResponsable; ?>
                                                        </p>
                                                    </dd>
                                                    <?php
                                                endforeach;
                                                ?>
                                            </dl>
                                        </div>

                                        <div class="col-md-2">
                                            <dl class="row">
                                                <?php
                                                $Proyectores = RadicadoEnviadoProyector::Listar(1, $item['id_radica'], "", "", "", "", "", "");
                                                foreach($Proyectores as $ItemProyectores):
                                                    $Class = "";
                                                    $array = explode(" ", $ItemProyectores['ape_funcio']);
                                                    $NomProyectores = $ItemProyectores['nom_funcio']." ".$array[0]."<br>".$ItemProyectores['nom_depen']."<br>".$ItemProyectores['nom_oficina'];

                                                    ?>
                                                    <dd class="col-sm-12">
                                                        <p>
                                                            <?php echo $NomProyectores; ?>
                                                        </p>
                                                    </dd>
                                                    <?php
                                                endforeach;
                                                ?>
                                            </dl>
                                        </div>

                                        <div class="col-md-1">
                                            <dl class="row">
                                                <?php
                                                if($item['digital'] == 0 and $item['requie_digital'] == 1){
                                                    ?>
                                                    <button type="button" class="btn btn-warning btn-xs btn-mini btn-circle" data-toggle="modal" data-target="#myModalAdjuntarDocumento" data-id_radicado="<?php echo $item['id_radica']; ?>" data-id_dependencia="<?php echo $item['id_depen']; ?>" id="BtnAdjunarDigital" title="Subir documento digital">
                                                        <i class="fa fa-cloud-upload"></i>
                                                    </button>
                                                    <?php
                                                }

                                                if($item['impri_rotu'] == 1){
                                                    $ClaseImpimirRotulo = "white";
                                                }elseif($item['impri_rotu'] == 0){
                                                    $ClaseImpimirRotulo = "warning";
                                                }
                                                ?>

                                                <button type="button" class="ImprimirRotulo btn btn-<?php echo $ClaseImpimirRotulo; ?> btn-xs btn-mini btn-circle" data-toggle="modal" data-target="#myModalImprimirRotulo" data-id_radicado="<?php echo $item['id_radica']; ?>" id="BtnImprimirRotulo<?php echo $item['id_radica']; ?>" title="Imprimir rotulo">
                                                    <i class="fa fa-credit-card"></i>
                                                </button>

                                                <button type="button" class="btn btn-success btn-xs btn-mini btn-circle" data-toggle="modal" data-target="#myModalMostrarInfoRadicadoEnviado" data-id_radicado="<?php echo $item['id_radica']; ?>" id="BtnMostarInfoRadicadoEnviado" title="Mostrar información del radicado">
                                                    <i class="fa fa-info"></i>
                                                </button>

                                                <button type="button" class="btn btn-default btn-xs btn-mini btn-circle" data-toggle="modal" data-target="#myModalSubirDocumentosAdicionales" data-id_radicado="<?php echo $item['id_radica']; ?>" data-id_depen="<?php echo $item['id_depen']; ?>" id="BtnSubirDocumentosAdicionales" title="Cargar documentos adicionales">
                                                    <i class="fa fa-paperclip"></i>
                                                </button>

                                                <p role="presentation" class="divider"></p>

                                                <button type="button" class="btn btn-info btn-xs btn-mini btn-circle" id="BtnEliminarDocumentoDigital" data-id_radicado="<?php echo $item['id_radica']; ?>" data-id_ruta="<?php echo $item['id_ruta']; ?>" title="Eliminar documento digital">
                                                    <i class="fa fa-file text-white"></i>
                                                </button>
                                                <?php
                                                $i++;
                                                if($i == 1){
                                                    ?>
                                                    <button type="button" class="btn btn-info btn-xs btn-mini btn-circle" id="BtnEliminarRadicado" data-id_radicado="<?php echo $item['id_radica']; ?>" data-id_ruta="<?php echo $item['id_ruta']; ?>" title="Eliminar radicado">
                                                        <i class="fa fa-eraser text-white"></i>
                                                    </button>
                                                    <?php
                                                }
                                                ?>

                                                <p role="presentation" class="divider"></p>

                                                <button type="button" class="btn btn-success btn-mini btn-circle" data-toggle="modal" data-target="#myModalRadicadosRecibidosParaRespuesta" id="BtnBuscarRadicadosRecibidosParaRespuesta" data-id_radicado="<?php echo $item['id_radica']; ?>" title="Relacionar radicados para responder">
                                                <i class="fa fa-random text-white"></i>
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
                        }
                    }else{
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
        <div class="clearfix"></div>
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
        
        <?php
    }
}
?>
