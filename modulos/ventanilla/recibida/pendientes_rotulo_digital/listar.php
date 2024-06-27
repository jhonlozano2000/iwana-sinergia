<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){

    session_start();
    include "../../../../config/class.Conexion.php";
    include( "../../../../config/variable.php");
    include( "../../../../config/funciones.php");
    include( "../../../../config/funciones_seguridad.php");
    require_once '../../../clases/radicar/class.RadicaRecibidoListarPendientesRotuloDigital.php';

    $estado = session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
    if(!$estado){
        session_start();
    }

    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
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

        $Registro = new RadicadoRecibidoListarPendientes();
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
        //echo "Accion: ".$Accion."<br>Total: ".$numrows."<br>Respon Princi: ".$_SESSION['SesionFuncioResponPrinci']." , Jefe Depen: ".$_SESSION['SesionFuncioJefeDependencia'].", Funcio deta: ".$_SESSION['SesionFuncioDetaId'];
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
                        <div class="col-md-4"><strong>INFO. DEL RADICADO</strong></div>
                        <div class="col-md-3"><strong>INFO. BASICA</strong></div>
                        <div class="col-md-4"><strong>DETALLE DEL DESTINATARIO</strong></div>
                        <div class="col-md-1"><strong>ACCIONES</strong></div>
                    </div>
                </thead>
                <tbody>
                    <?php

                    if($numrows>0){

                        foreach($query_services as $item){

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

                            if($item['fec_venci'] != "" or $item['requie_respues'] == 1){

                                $DiasTrascurridos  = DiasTrascurridos($item['fechor_radica']);
                                $DiasParaRespuesta = DiasParaRespuesta($item['fechor_radica'], $item['fec_venci']);
                                $TotalDias         = $DiasParaRespuesta-$DiasTrascurridos;

                                $TiempoTrascurrido = "";
                                if($item['radica_respuesta'] != ""){
                                    $Clase = "info";
                                    $ClaseTexto = "Con Respuesta";
                                    $ClaseColorTexto = "text-white";
                                    $TiempoTrascurrido = "<strong>Retraso de ".$TotalDias." días</strong>";
                                    $FechaRadicado = "<strong>".$item['fechor_radica']."</strong>";
                                    $RequieRespues = "<strong>Si</strong>";
                                    $BagroundColor = "";
                                    $ColorTextoTitulo = "text-black";
                                }elseif($TotalDias < 0){
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
                                    $ClaseTexto = "Pro Vencer";
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
                            ?>
                            <tr id="TRRadicado" data-id_radicado="<?php echo $item['id_radica']; ?>">
                                <td class="small-cell v-align-middle">
                                    <div class="row">
                                        <div class="col-md-12 text-dark bg-info" style="background: <?php echo $BagroundColor; ?>">
                                            <span class="btn btn-info btn-xs btn-mini" style="margin-right:20px;font-size: 15px">
                                                <strong><?php echo $item['id_radica']; ?></strong>
                                            </span>
                                            <strong class="<?php echo $ColorTextoTitulo; ?>">
                                                <?php echo utf8_encode($Remitente); ?>
                                            </strong>
                                            <i class="fa fa-sign-in text-success" style="margin-right:10px; margin-left:10px;"></i>
                                            <strong class="<?php echo $ColorTextoTitulo; ?>">
                                                <?php echo utf8_encode($Destinatario); ?>
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
                                                <dd class="col-sm-7"><?php echo utf8_encode($RadicadoPor); ?></dd>
                                            </dl>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <dl class="row">
                                                <dt class="col-sm-3">Remitente:</dt>
                                                <dd class="col-sm-7"><?php echo utf8_encode($Remitente); ?></dd>

                                                <?php
                                                if($item['radica_respuesta'] != ""){
                                                    ?>
                                                    <dt class="col-sm-3">Respuesta:</dt>
                                                    <dd class="col-sm-7"><?php echo utf8_encode($item['radica_respuesta']); ?></dd>
                                                    <?php
                                                }
                                                ?>

                                                <dt class="col-sm-3">Tip. Llega:</dt>
                                                <dd class="col-sm-7"><?php echo utf8_encode($item['nom_forma_llega']); ?></dd>
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
                                                <dd class="col-sm-7"><?php echo utf8_encode($item['nom_funcio']." ".$item['ape_funcio']); ?></dd>
                                                <?php echo $Saltos; ?>

                                                <dt class="col-sm-2">Depen:</dt>
                                                <dd class="col-sm-7"><?php echo utf8_encode($item['nom_depen']); ?></dd>
                                                <br>

                                                <dt class="col-sm-2">Ofi:</dt>
                                                <dd class="col-sm-7"><?php echo utf8_encode($item['nom_oficina']); ?></dd>
                                            </dl>
                                        </div>

                                        <div class="col-md-2">
                                            <dl class="row">
                                                <?php
                                                if($item['digital'] == 0 and $item['requie_digital'] == 1){ 
                                                    ?>
                                                    <button type="button" class="idradicado btn btn-warning btn-xs btn-mini btn-circle idradicado" data-toggle="modal" data-target="#myModalAdjuntarDocumento" data-id_radicado="<?php echo $item['id_radica']; ?>" id="BtnAdjunarDigital<?php echo $item['id_radica']; ?>" title="Subir archivo digital">
                                                        <i class="fa fa-cloud-upload text-white"></i>
                                                    </button>
                                                    <?php 
                                                }

                                                if($item['impri_rotu'] == 1){
                                                    $ClaseImpimirRotulo = "primary";
                                                }elseif($item['impri_rotu'] == 0){
                                                    $ClaseImpimirRotulo = "warning";
                                                }
                                                ?>
                                                
                                                <button type="button" class="ImprimirRotulo btn btn-<?php echo $ClaseImpimirRotulo; ?> btn-xs btn-mini btn-circle" data-toggle="modal" data-target="#myModalImprimirRotulo" data-id_radicado="<?php echo $item['id_radica']; ?>" id="BtnImprimirRotulo<?php echo $item['id_radica']; ?>" title="Imprimir rotulo">
                                                    <i class="fa fa-credit-card text-white"></i> 
                                                </button>
                                                
                                                <button type="button" class="btn btn-success btn-xs btn-mini btn-circle" data-toggle="modal" data-target="#myModalMostrarInfoRadicadoRecibido" id="BtnMostarInfoRadicadoRecibido" data-id_radicado="<?php echo $item['id_radica']; ?>" title="Mostrar Info. radicado">
                                                    <i class="fa fa-info text-white"></i>
                                                </button>
                                                <?php
                                                if($item['fec_venci'] != ""){
                                                    ?>
                                                    
                                                    <button type="button" class="btn btn-success btn-xs btn-mini btn-circle" title="Notificar via correo electronico">
                                                        <i class="fa fa-envelope-o text-white"></i>
                                                    </button>
                                                    <?php
                                                }
                                                ?>
                                            </dl>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <dl class="row">
                                                <dt class="col-sm-1">Asunto:</dt>
                                                <dd class="col-sm-11"><?php echo utf8_encode($item['asunto']); ?></dd>
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
        <?php
    }
}
?>
