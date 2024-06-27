<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	session_start();
	include "../../../../../config/class.Conexion.php";
    include( "../../../../../config/variable.php");
    include( "../../../../../config/funciones.php");
    include( "../../../../../config/funciones_seguridad.php");
    require_once '../../../../clases/radicar/class.RadicaRecibidoListarBandeja.php';
    require_once "../../../../clases/general/class.GeneralFuncionario.php";

    $estado = session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
    if(!$estado){
        session_start();
    }

    $Accion     = 0 ;

    ?>
    <div class="row-fluid dataTables_wrapper">
        <?php
        $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';

        if($action == 'ajax'){
            include 'pagination.php';
            //las variables de paginación
            $page          = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
            //la cantidad de registros que desea mostrar
            $per_page      = 50;
            //brecha entre páginas después de varios adyacentes 
            $adjacents     = 4; 
            $TotalPrimeros = 0;
            $TotalUltimos  = 0;
            $TotalPrimeros = ($page*$per_page)-$per_page;
            $TotalUltimos  = ($page*$per_page);
            $Mostrar       = $TotalPrimeros.' a '.$TotalUltimos;
            $offset        = ($page - 1) * $per_page;

            $Registro = new RadicadoRecibidoListarBandeja();
            $Registro->set_Accion(12);
            $Registro->set_IdFuncioSesion($_SESSION['SesionFuncioDetaId']);
            $Registro->set_Limite1($offset);
            $Registro->set_Limite2($per_page);

            $query_services = $Registro->Listar();
            $NumrRows       = $Registro->TotalRegistros_Listar();
            
            //echo "Accion: ".$Accion."<br>Total: ".$NumrRows."<br>Respon Princi: ".$_SESSION['SesionFuncioResponPrinci']." , Jefe Depen: ".$_SESSION['SesionFuncioJefeDependencia'].", Funcio deta: ".$_SESSION['SesionFuncioDetaId'];
            
            $total_pages = ceil($NumrRows/$per_page);
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
                <table class="table table-hover" id="emails" > 
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

                        if($NumrRows>0){

                            foreach($query_services as $item):

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

                                if($item['requie_respues'] == 1 and $item['respondido'] == 0){

                                    $DiasTrascurridos  = DiasTrascurridos($item['fechor_radica']);
                                    $DiasParaRespuesta = DiasParaRespuesta($item['fechor_radica'], $item['fec_venci']);
                                    $TotalDias         = $DiasParaRespuesta-$DiasTrascurridos;

                                    $TiempoTrascurrido = "";
                                    if($TotalDias < 0){
                                        $Clase = "danger";
                                        $ClaseTexto = "Vencido";
                                        $ClaseColorTexto = "text-error";
                                        $TiempoTrascurrido = "<strong>Retraso de ".$TotalDias." días</strong>";
                                        $FechaRadicado = "<strong>".$item['fechor_radica']."</strong>";
                                        $RequieRespues = "<strong>Si</strong>";
                                        $BagroundColor = "#FA5858";
                                        $ColorTextoTitulo = "text-white";
                                    }elseif($TotalDias >= 0 and $TotalDias <= 3){
                                        $Clase = "warning";
                                        $ClaseTexto = "Por Vencer";
                                        $ClaseColorTexto = "text-warning";
                                        $TiempoTrascurrido = "<strong>Faltan ".$TotalDias." días de ".$DiasParaRespuesta."</strong>";
                                        $FechaRadicado = "<strong>".$item['fechor_radica']."</strong>";
                                        $RequieRespues = "<strong>Si</strong>";
                                        $BagroundColor = "#FACC2E";
                                        $ColorTextoTitulo = "text-light";
                                    }elseif($TotalDias >= 4 and $TotalDias <= 5){
                                        $Clase = "warning";
                                        $ClaseTexto = "Por Vencer";
                                        $ClaseColorTexto = "text-warning";
                                        $TiempoTrascurrido = "<strong>Faltan ".$TotalDias." días de ".$DiasParaRespuesta."</strong>";
                                        $FechaRadicado = "<strong>".$item['fechor_radica']."</strong>";
                                        $RequieRespues = "<strong>Si</strong>";
                                        $BagroundColor = "#FACC2E";
                                        $ColorTextoTitulo = "text-light";
                                    }elseif($TotalDias > 5){
                                        $Clase = "";
                                        $ClaseTexto = "";
                                        $ClaseColorTexto = "";
                                        $TiempoTrascurrido = "<strong>Faltan ".$TotalDias." días de ".$DiasParaRespuesta."</strong>";
                                        $FechaRadicado = "<strong>".$item['fechor_radica']."</strong>";
                                        $RequieRespues = "<strong>Si</strong>";
                                        $ColorTextoTitulo = "";
                                    }
                                }else{
                                    $Clase = "";
                                    $ClaseTexto = "";
                                    $ClaseColorTexto = "";
                                    $TiempoTrascurrido = "---";
                                }

                                $Remitente = "";
                                if($item['razo_soci'] != ""){
                                    $Remitente = $item['razo_soci'];
                                }else{
                                    $Remitente = $item['nom_contac'];
                                }

                                $Destinatario = $item['nom_funcio']." ".$item['ape_funcio'].", Depen.: ".$item['nom_depen'].", Ofi.: ".$item['nom_oficina'];
                                $RadicadoPor = $item['nom_funcio_radi']." ".$item['ape_funcio_radi'];

                                if($item['requie_respues'] == 1){
                                    $RequieRespues = "Si";
                                }
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
                                                <i class="fa fa-sign-in text-success" style="margin-right:10px; margin-left:10px;"></i>
                                                <strong class="<?php echo $ColorTextoTitulo; ?>">
                                                    <?php echo $Destinatario; ?>
                                                </strong>
                                                <?php
                                                if($Clase != ""){
                                                    ?>
                                                    <span class="label label-<?php echo $Clase; ?> pull-right text-dark"><?php echo $ClaseTexto; ?></span>
                                                    <?php
                                                }
                                                ?>
                                            </div>

                                            <hr style="border-width: 2px; height: 0px; border-style: dashed; border-color: default;"/>
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
                                                    if($item['radica_respuesta'] != ""){
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
                                                    $TotalCadena = explode(" ", $item['nom_funcio']." ".$item['ape_funcio']);
                                                    $Saltos = "";
                                                    if(count($TotalCadena) == 4){
                                                        $Saltos = "<br><br>";
                                                    }else{
                                                        $Saltos = "<br>";
                                                    }
                                                    ?>
                                                    <dt class="col-sm-2">Respon:</dt>
                                                    <dd class="col-sm-7"><?php echo $item['nom_funcio']." ".$item['ape_funcio']; ?></dd>
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

                                                    <button type="button" class="btn btn-primary btn-circle" id="BtnResponderCorrespondencia" title="Responder correspondencia" data-id_radicado="<?php echo $item['id_radica']; ?>">
                                                        <i class="fa fa-edit"></i>
                                                    </button>

                                                </dl>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <dl class="row">
                                                    <dt class="col-sm-1">Asunto:</dt>
                                                    <dd class="col-sm-11"><?php echo $item['asunto']; ?></dd>

                                                    <dt class="col-sm-1">Observaciones:</dt>
                                                    <dd class="col-sm-11"><?php echo $item['observacion']; ?></dd>
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
                    }else {
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
