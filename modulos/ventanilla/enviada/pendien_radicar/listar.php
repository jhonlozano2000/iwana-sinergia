<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){

    session_start();
    include "../../../../config/class.Conexion.php";
    include( "../../../../config/variable.php");
    include( "../../../../config/funciones.php");
    include( "../../../../config/funciones_seguridad.php");
    require_once '../../../clases/radicar/class.RadicaEnviadoTemp.php';
    require_once '../../../clases/radicar/class.RadicaEnviadoTempQuienFirma.php';
    require_once "../../../clases/radicar/class.RadicaEnviadoTempProyectores.php";
    require_once "../../../clases/radicar/class.RadicaEnviadoTempResponsables.php";
    require_once "../../../clases/general/class.GeneralFuncionario.php";

    $estado = session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
    if(!$estado){
        session_start();
    }

    $Accion     = 0 ;
    $TipoListar = $_REQUEST['tipo_listar'];

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

            //Cuenta el número total de filas de la tabla*/
            $query_services = RadicadoEnviadoTemp::Listar_Varios(2, "", "", "", "", "", $offset, $per_page, $_REQUEST['criterio']);
            $numrows     = count($query_services);

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

                            foreach($query_services as $item){

                                $Remitente = "";
                                if($item['razo_soci'] != ""){
                                    $Remitente = $item['razo_soci'];
                                }else{
                                    $Remitente = $item['nom_contac'];
                                }
                                ?>
                                <tr>
                                    <td class="small-cell v-align-middle">
                                        <div class="row">
                                            <div class="col-md-12 text-dark bg-info" style="background: <?php echo $BagroundColor; ?>">

                                                <span class="btn btn-info btn-xs btn-mini" style="margin-right:20px;font-size: 15px">
                                                    <strong><?php echo $item['id_temp']; ?></strong>
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

                                                    </dd>

                                                    <dt class="col-sm-5">Fec. Hor. Creación:</dt>
                                                    <br>
                                                    <dd class="col-sm-7"><?php echo $item['fechor_registro']; ?></dd>

                                                    <br>

                                                    <dt class="col-sm-5">Usua. que   Crea:</dt>
                                                    <br>
                                                    <dd class="col-sm-9"><?php echo $item['nom_funcio']." ".$item['ape_funcio']; ?></dd>

                                                </dl>
                                            </div>

                                            <div class="col-md-3">
                                                <dl class="row">
                                                    <?php
                                                    $QuienesFirman = RadicadoEnviadoTempQuienFirma::Listar(1, $item['id_temp'], "");
                                                    foreach($QuienesFirman as $ItemQuienesFirman):
                                                        $Class = "";
                                                        $array = explode(" ", $ItemQuienesFirman['ape_funcio']);
                                                        $NomQuienesFirman = $ItemQuienesFirman['nom_funcio']." ".$array[0]."<br>".$ItemQuienesFirman['nom_depen']."<br>".$ItemQuienesFirman['nom_oficina'];

                                                        if($ItemQuienesFirman['firmado'] == 0){
                                                            $Class = "text-error semi-bold";
                                                        }
                                                        ?>

                                                        <dd class="col-sm-12">
                                                            <p class='<?php echo $Class; ?>'>
                                                                <?php
                                                                if($ItemQuienesFirman['firma_principal'] == 1){
                                                                    ?>
                                                                    <i class="fa fa-dot-circle-o text-primary"></i>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <?php echo $NomQuienesFirman."<br><strong>Firmado: ".$ItemQuienesFirman['fechor_firmado']."</strong>"; ?>
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
                                                    $Responsables = RadicadoEnviadoTempResponsable::Listar(2, $item['id_temp'], "");
                                                    foreach($Responsables as $ItemResponsables):
                                                        $Class = "";
                                                        $array = explode(" ", $ItemResponsables['ape_funcio']);
                                                        $NomResponsable = $ItemResponsables['nom_funcio']." ".$array[0]."<br>".$ItemResponsables['nom_depen']."<br>".$ItemResponsables['nom_oficina'];

                                                        if($ItemResponsables['aprobado'] == 0){
                                                            $Class = "text-error semi-bold";
                                                        }
                                                        ?>
                                                        <dd class="col-sm-12">
                                                            <p class='<?php echo $Class; ?>'>
                                                                <?php
                                                                if($ItemResponsables['respon'] == 1){
                                                                    ?>
                                                                    <i class="fa fa-dot-circle-o text-primary"></i>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <?php echo $NomResponsable."<br><strong>Aprobado: ".$ItemResponsables['fechor_aprueba']."</strong>"; ?>
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
                                                    $Proyectores = RadicadoEnviadoTempProyector::Listar(1, $item['id_temp'], "", "", "", "", "", "");
                                                    foreach($Proyectores as $ItemProyectores):
                                                        $Class = "";
                                                        $array = explode(" ", $ItemProyectores['ape_funcio']);
                                                        $NomProyectores = $ItemProyectores['nom_funcio']." ".$array[0]."<br>".$ItemProyectores['nom_depen']."<br>".$ItemProyectores['nom_oficina'];

                                                        if($ItemProyectores['editando'] == 1){
                                                            $Class = "text-info semi-bold";
                                                        }elseif($ItemProyectores['terminado'] == 0){
                                                            $Class = "text-error semi-bold";
                                                        }
                                                        ?>
                                                        <dd class="col-sm-12">
                                                            <p class='<?php echo $Class; ?>'>
                                                                <?php echo $NomProyectores."<br><strong>Proyectado: ".$ItemResponsables['fechor_termina']."</strong>"; ?>
                                                            </p>
                                                        </dd>
                                                        <?php
                                                    endforeach;
                                                    ?>
                                                </dl>
                                            </div>

                                            <div class="col-md-1">
                                                <dl class="row">
                                                    <button type="button" class="btn btn-success btn-xs btn-mini btn-circle" data-id_temp="<?php echo $item['id_temp']; ?>" id="BtnRadicarTemp" title="Radicar correspondencia">
                                                        <i class="fa fa-check text-white"></i>
                                                    </button>

                                                    <button type="button" class="btn btn-info btn-xs btn-mini btn-circle" id="BtnDescargaPlantilla" data-id_temp='<?php echo $item['id_temp']; ?>' data-plantillta_nombre='<?php echo $item['nom_archivo']; ?>' data-id_ruta='<?php echo $item['id_ruta']; ?>' title="Descargar plantilla">
                                                        <i class="fa fa-cloud-download text-white"></i>
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
            <?php
        }
    }
    ?>
