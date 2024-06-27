<?php
session_start();
include "../../../../config/class.Conexion.php";
include( "../../../../config/variable.php");
include( "../../../../config/funciones.php");
include( "../../../../config/funciones_seguridad.php");
require_once '../../../clases/radicar/class.RadicaEnviadoTemp.php';

$estado = session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
if(!$estado){
    session_start();
}

$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
$TipoListar = $_REQUEST['tipo_listar'];

$Accion = "";
if($TipoListar == 'buscar'){
    $Accion = 31;
}elseif($TipoListar == 'listar'){
    $Accion = 11;
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
    $numrows     = RadicadoEnviadoTemp::TotalRegistros($Accion, "", "", "", "", "", "", "", $_REQUEST['criterio']);

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
                    <th style="width:5%">Temp.</th>
                    <th style="width:30%">Asunto</th>
                    <th style="width:30%">Responsable</th>
                    <th style="width:20%">Paciente</th>
                    <th style="width:20%">Tercero</th>
                    <th style="width:5%"></th>
                </tr>
            </thead>
            <tbody>
                <?php

                if ($numrows>0){

                    $query_services = RadicadoEnviadoTemp::Listar($Accion, "", "", "", "", "", $offset, $per_page, $_REQUEST['criterio']);

                    foreach($query_services as $item):

                        ?>
                        <tr id="TRRadicado" data-id_radicado="<?php echo $item['id_radica']; ?>">
                            <td class="clickable v-align-middle">
                                <strong>
                                    <?php 
                                    echo $item['id_temp']; 
                                    ?>
                                </strong>
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
                                    echo "Funcio.: ".$item['nom_funcio']." ".$item['ape_funcio']."<br>Depen.:".$item['nom_depen']."<br>Ofi.:".$item['nom_oficina'];
                                    ?>
                                </span>
                            </td>
                            <td class="clickable">
                                <span class="muted">
                                    <?php
                                    echo '# Doc.: '.$item['num_docu_pacuen']."<br>Paciente.: ".$item['nom_pacien'];
                                    ?>
                                </span>
                            </td>
                             <td class="clickable">
                                <span class="muted">
                                    <?php
                                    if($item['razo_soci'] != ""){
                                        echo 'Enti.: '.$item['razo_soci']."<br>Contac.: ".$item['nom_contac'];
                                    }else{
                                        echo $item['nom_contac'];
                                    }
                                    ?>
                                </span>
                            </td>
                            <td class="small-cell v-align-middle">
                                <a href="radicar.php?id_temp=<?php echo $item['id_temp']; ?>" class="btn btn-primary btn-sm btn-small">
                                    <i class="fa fa-thumbs-up"></i>
                                </a>
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
