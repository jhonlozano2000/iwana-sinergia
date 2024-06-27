<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
    session_start();
    include "../../../../../config/class.Conexion.php";
    require_once '../../../../clases/radicar/class.RadicaRecibido.php';
    require_once '../../../../clases/configuracion/class.ConfigOtras_Respon_HC.php';
    include( "../../../../../config/variable.php");
    include( "../../../../../config/funciones.php");

    $estado = session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
    if(!$estado){
        session_start();
    }

    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
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
    //Cuenta el número total de filas de la tabla*/

    $Responsable = ConfigOtrasResponsableHC::Buscar(1, $_SESSION['SesionFuncioDetaId']);

    if(!$Responsable){
        ?>
        <div class="alert">
            <button class="close" data-dismiss="alert"></button>
            <a href="#" class="link">Advertencia:&nbsp;</a>Usted no tiene permisos para realizar el trámite de solicitudes de historias clínicas. </div>
            <?php
            exit();
        }

        $numrows = RadicadoRecibido::TotalRegistros_HC(1, "", $_SESSION['SesionFuncioDetaId'], "", "", "", "", $_REQUEST['criterio']);
    echo $numrows;
        $total_pages = ceil($numrows/$per_page);
        $reload      = 'index.php';
        ?>
        <div class="row-fluid dataTables_wrapper">
            <div class="pull-right margin-top-20">
                <div class="dataTables_paginate paging_bootstrap pagination">
                    <?php echo paginate($reload, $page, $total_pages, $adjacents); ?>
                </div>
                <div class="dataTables_info hidden-xs" id="example_info">
                    Mostrando <b><?php echo $Mostrar; ?> </b> de <?php echo $numrows; ?></div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div id="email-list">                  
            <table class="table table-hover" id="emails" > 
                <thead>
                    <tr>
                        <th style="width:20%">Radica</th>
                        <?php
                        if($_SESSION['SesionFuncioResponPrinci'] == true){
                            ?>
                            <th style="width:5%"></th>
                            <?php
                        }
                        ?>
                        <th style="width:5%">D</th>
                        <th style="width:5%">D/D</th>
                        <th style="width:10%">Fec Venci</th>
                        <th style="width:16%">Tercero</th>
                        <th style="width:40%">Asunto</th>
                        <th class="small-cell"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($numrows>0){
                        $query_services = RadicadoRecibido::Listar_HC(1, "", $_SESSION['SesionFuncioDetaId'], "", "", $offset, $per_page, $_REQUEST['criterio']);
                        $Clase = "";

                        foreach($query_services as $item):

                            $Clase = "";
                            $DiasTrascurridos = "";
                            $DiasParaRespuesta = ""; 
                            $TotalDias = 0;

                            if($item['fec_venci'] != ""){

                                $DiasTrascurridos  = DiasTrascurridos($item['fechor_radica']);
                                $DiasParaRespuesta = DiasParaRespuesta($item['fechor_radica'], $item['fec_venci']);
                                $TotalDias = $DiasParaRespuesta-$DiasTrascurridos;

                                if($TotalDias <= 3){
                                    $Clase = "danger";
                                }elseif($TotalDias >= 4 and $TotalDias <= 5){
                                    $Clase = "warning";
                                }
                            }else{
                                $Clase = "";
                            }
                            ?>
                            <tr id="TRRadicado" data-id_radicado="<?php echo $item['id_radica']; ?>" class="<?php echo $Clase; ?>">
                                <td class="clickable">
                                    <?php 
                                    if($item['leido'] == 0){
                                        echo '<strong>'.$item['id_radica'].'</strong>';
                                    }else{
                                        echo $item['id_radica'];
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if($item['digital']==1){
                                        ?>
                                        <i class="fa fa-file-o text-success"></i>
                                        <?php
                                    }else{
                                        ?>
                                        <i class="fa fa-warning text-warning"></i>
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td class="clickable">
                                    <?php
                                    if($item['leido'] == "" and $item['fec_venci'] != ""){
                                        if($DiasTrascurridos>$DiasParaRespuesta){
                                            echo "<strong>Vencido</strong>";
                                        }else{
                                            echo "<strong>".$DiasTrascurridos."/".$DiasParaRespuesta."</strong>";
                                        }
                                    }elseif($item['fec_venci'] != ""){
                                        if($DiasTrascurridos>$DiasParaRespuesta){
                                            echo "Vencido";
                                        }else{
                                            echo $DiasTrascurridos."/".$DiasParaRespuesta;
                                        }
                                    }
                                    ?>
                                </td>
                                <td class="clickable">
                                    <?php
                                    if($item['leido'] == 0 and $item['fec_venci'] != ""){
                                        ?>
                                        <strong><?php echo Fecha_Corta_Español($item['fec_venci']); ?></strong>
                                        <?php
                                    }elseif($item['fec_venci'] != ""){
                                        echo $item['fec_docu'];
                                    }
                                    ?>
                                </td>
                                <?php
                                if($_SESSION['SesionFuncioResponPrinci'] == 1){
                                    ?>
                                    <td class="clickable">
                                        <?php
                                        if($item['leido'] == 0){
                                            echo "<strong>".$item['nom_funcio']." ".$item['ape_funcio']."<br>Depen.: ".$item['nom_depen']."<br>Ori.: ".$item['nom_oficina']."</strong>";
                                        }elseif($item['fec_venci'] != ""){
                                            echo $item['nom_funcio']." ".$item['ape_funcio']."<br>Depen.: ".$item['nom_depen']."<br>Ori.: ".$item['nom_oficina'];
                                        }
                                        ?>
                                    </td>
                                    <?php
                                }
                                ?>
                                <td class="clickable">
                                    <?php
                                    $Tercero = "";
                                    if($item['razo_soci'] != "" and $item['leido'] == 0){
                                        $Tercero = $item['razo_soci'];
                                    }else{
                                        $Tercero = $item['nom_contac'];
                                    }

                                    if($item['radica_respuesta'] == ""){
                                        echo $Tercero;
                                    }else{
                                        echo "<strike>".$Tercero."</strike>"; 
                                    }
                                    ?>
                                </td>
                                <td class="clickable">
                                    <?php 
                                    if($item['radica_respuesta'] == ""){
                                        echo $item['asunto'];
                                    }else{
                                        echo "<strike>".$item['asunto']."</strike>"; 
                                    }
                                    ?>
                                </td>
                                <td class="small-cell v-align-middle">
                                    <button type="button" class="btn btn-primary btn-sm btn-small" id="BtnAceptar" data-toggle="modal" data-target="#myModalFinalizaTramite" data-paciente="Tú vas aprobar la solicitud de historia clínica del señor <?php echo $Tercero; ?>" data-asunto="<?php echo "Se autoriza ".$item['asunto']; ?>" data-id_radicado="<?php echo $item['id_radica']; ?>" data-id_serie="<?php echo $item['id_serie']; ?>" data-id_subserie="<?php echo $item['id_subserie']; ?>" data-id_tipodoc="<?php echo $item['id_tipodoc']; ?>" data-id_tercero="<?php echo $item['id_tercero']; ?>">
                                        <i class="fa fa-thumbs-up"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm btn-small" id="BtnRechazar" data-toggle="modal" data-target="#myModalFinalizaTramite" data-paciente="Tú vas a rechazar la solicitud de historia clínica del señor <?php echo $Tercero; ?>" data-asunto="<?php echo "Se rechaza ".$item['asunto']; ?>" data-id_radicado="<?php $item['id_radica']; ?>"><i class="fa fa-thumbs-down"></i>
                                    </button>
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