<?php
session_start();
include "../../../../config/class.Conexion.php";
include( "../../../../config/variable.php");
include( "../../../../config/funciones.php");
include( "../../../../config/funciones_seguridad.php");
require_once '../../../clases/radicar/class.RadicaEnviado Final.php';

$estado = session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
if(!$estado){
    session_start();
}

$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
$TipoListar = $_REQUEST['tipo_listar'];

$Accion = "";
if($TipoListar == 'buscar'){
    $Accion = 34;
}elseif($TipoListar == 'listar'){
    $Accion = 13;
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

//Cuenta el número total de filas de la tabla*/
$numrows     = RadicadoEnviado::TotalRegistros($Accion, "", "", "", "", "", "", "", $_REQUEST['criterio']);

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
    <table class="table table-hover" id="emails" > 
        <thead>
            <tr>
                <th width="130">Radicado</th>
                <th width="2" class="small-cell">D</th>
                <th width="2" class="small-cell">R</th>
                <th width="100" class="medium-cell">Fec. Docu.</th>
                <th width="250" class="">Asunto</th>
                <th width="250" class="">Responsable</th>
                <th width="250" class="">Paciente</th>
                <th width="250" class="">Tercero</th>
            </tr>
        </thead>
        <tbody>
            <?php

            if($numrows>0){

                $query_services = RadicadoEnviado::Listar($Accion, "", "", "", "", "", $offset, $per_page, $_REQUEST['criterio']);

                foreach($query_services as $item):
                    ?>
                    <tr id="TRRadicado" data-id_radicado="<?php echo $item['id_radica']; ?>">
                        <td class="clickable v-align-middle">
                            <strong>
                                <?php 
                                echo $item['id_radica']; 
                                ?>
                            </strong>
                        </td>
                        <td class="small-cell v-align-middle">
                            <?php 
                            if($item['digital']==1 ){ 
                                ?>
                                <span class="text-info">
                                    <i class="fa fa-file-o text-primary"></i>
                                </span>
                                <?php 
                            }else{ 
                                ?>
                                <span class="text-info">
                                    <i class="idradicado fa fa-warning text-warning"
                                    data-toggle="modal"
                                    data-target="#myModalAdjuntarDocumento"
                                    data-id_radicado="<?php echo $item['id_radica']; ?>"
                                    id="BtnAdjunarDigital<?php echo $item['id_radica']; ?>"></i>
                                </span>
                                <?php 
                            } 
                            ?>
                        </td>
                        <td class="small-cell">
                            <?php
                            $ColorTexto = "";
                            if($item['impri_rotu']==1){ 
                                $ColorTexto  = 'text-success';
                            }else{
                                $ColorTexto  = 'text-warning';
                            }
                            ?>
                            <i class="ImprimirRotulo fa fa-credit-card <?php echo $ColorTexto; ?>" 
                                data-toggle="modal"
                                data-target="#myModalImprimirRotulo"
                                data-id_radicado="<?php echo $item['id_radica']; ?>"
                                id="BtnImprimirRotulo<?php echo $item['id_radica']; ?>"></i>
                            </td>
                            <td class="clickable tablefull v-align-middle">
                                <span class="muted">
                                    <?php echo Fecha_Corta_Español($item['fec_docu']); ?>
                                </span>
                            </td>
                            <td class="clickable tablefull v-align-middle">
                                <span class="muted">
                                    <?php
                                    echo $item['asunto'];
                                    ?>
                                </span>
                            </td>
                            <td class="clickable">
                                <span class="muted">
                                    <?php
                                    echo $item['nom_funcio']." ".$item['ape_funcio'];
                                    ?>
                                </span>
                            </td>
                            <td class="clickable">
                                <span class="muted">
                                    <?php
                                    
                                        echo '# Docu.: '.$item['num_docu_pacien']."<br>Paciente.: ".$item['nom_pacien'];
                                   
                                    ?>
                                </span>
                            </td>
                            <td class="clickable">
                                <span class="muted">
                                    <?php
                                    if($item['razo_soci_terce'] != ""){
                                        echo 'Enti.: '.$item['razo_soci_terce']."<br>Contac.: ".$item['nom_contac_terce'];
                                    }else{
                                        echo $item['nom_contac_terce'];
                                    }
                                    ?>
                                </span>
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
?>
