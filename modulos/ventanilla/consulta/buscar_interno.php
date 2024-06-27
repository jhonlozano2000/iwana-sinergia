<?php
if (! empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    set_time_limit(0);
    include "../../../config/class.Conexion.php";
    include "../../../config/funciones.php";
    include "../../clases/radicar/class.RadicaInternoResponsable.php";
    include "../../clases/radicar/class.RadicaInternoDestinatario.php";
    include "../../clases/radicar/class.RadicaInternoProyectores.php";
    
    $Condicional = "";
    if($_POST['id_radica'] != ""){
        if($_POST['id_radica'] != ""){
            $Condicional.="`radi`.id_radica like '%".$_POST['id_radica']."%'";
        }
    }else{

        if($_REQUEST['desde'] != "" and $_REQUEST['hasta'] != ""){
            if($Condicional == ""){
                $Condicional.="DATE(`radi`.`fechor_radica`) BETWEEN '".Convertir_Fecha_A_Mysql($_POST['desde'])."' AND '".Convertir_Fecha_A_Mysql($_POST['hasta'])."'";
            }else{
                $Condicional.=" AND DATE(`radi`.`fechor_radica`) BETWEEN '".Convertir_Fecha_A_Mysql($_POST['desde'])."' AND '".Convertir_Fecha_A_Mysql($_POST['hasta'])."'";
            }
        }elseif($_REQUEST['desde'] != "" and $_REQUEST['hasta'] == ""){
            if($Condicional == ""){
                $Condicional.="DATE(`radi`.fechor_radica) >= '".Convertir_Fecha_A_Mysql($_POST['hasta'])."'";
            }else{
                $Condicional.=" AND DATE(`radi`.fechor_radica) >= '".Convertir_Fecha_A_Mysql($_POST['hasta'])."'";
            }
        }elseif($_REQUEST['desde'] == "" and $_REQUEST['hasta'] != ""){
            if($Condicional == ""){
                $Condicional.="DATE(`radi`.fechor_radica) >= '".Convertir_Fecha_A_Mysql($_POST['hasta'])."'";
            }else{
                $Condicional.=" AND DATE(`radi`.fechor_radica) >= '".Convertir_Fecha_A_Mysql($_POST['hasta'])."'";
            }
        }

        if($_POST['asunto'] != ""){
            if($Condicional == ""){
                $Condicional.="`radi`.`asunto` like '%".$_POST['asunto']."%'";
            }else{
                $Condicional.=" AND `radi`.`asunto` like '%".$_POST['asunto']."%'";
            }
        }

        if($_POST['id_destinatario'] != ""){
            if($Condicional == ""){
                $Condicional.="`radi_respon`.`id_funcio`` = ".$_POST['id_destinatario'];
            }else{
                $Condicional.=" AND `radi_respon`.`id_funcio` = ".$_POST['id_destinatario'];
            }
        }

        if($_POST['id_depen'] != "0"){
            if($Condicional == ""){
                $Condicional.="`radi_respon_depen`.`id_depen` = ".$_POST['id_depen'];
            }else{
                $Condicional.=" AND `radi_respon_depen`.`id_depen` = ".$_POST['id_depen'];
            }
        }

        if($_POST['id_serie'] != "0"){
            if($Condicional == ""){
                $Condicional.="`serie`.`id_serie` = ".$_POST['id_serie'];
            }else{
                $Condicional.=" AND `serie`.`id_serie` = ".$_POST['id_serie'];
            }
        }

        if($_POST['id_subserie'] != "0"){
            if($Condicional == ""){
                $Condicional.="`subserie`.`id_subserie` = ".$_POST['id_subserie'];
            }else{
                $Condicional.=" AND `subserie`.`id_subserie` = ".$_POST['id_subserie'];
            }
        }

        if($_POST['id_tipodoc'] != "0"){
            if($Condicional == ""){
                $Condicional.="`tip_docu`.`id_tipodoc` = ".$_POST['id_tipodoc'];
            }else{
                $Condicional.=" AND `tip_docu`.`id_tipodoc` = ".$_POST['id_tipodoc'];
            }
        }
    }

    $Sql = "SELECT `radi`.`id_radica`, `radi`.`adjunto`, `radi`.`fechor_radica`, `radi`.`fec_venci`, `radi`.`requie_respuesta`, `radi`.`radica_respuesta`, 
                `radi`.`asunto`, `radi`.`texto`, `radi`.`impri_rotu`, `funcio_regis`.`nom_funcio` AS `nom_funcio_radi`, 
                `funcio_regis`.`ape_funcio` AS `ape_funcio_radi`, `funcio_depen`.`nom_depen` AS `nom_depen_radi`, `funcio_ofi`.`nom_oficina` AS `nom_oficina_radi`, 
                `radi`.`transferido`, `serie`.`nom_serie`, `subserie`.`nom_subserie`, `tip_docu`.`nom_tipodoc`, `radi_respon`.`id_funcio`, 
                `radi_desti`.`id_funcio_deta`, `radi_respon_funcio`.`id_funcio_deta`, `radi_respon_depen`.`id_depen`, `serie`.`id_serie`, `subserie`.`id_subserie`, 
                `tip_docu`.`id_tipodoc`, `fun_respon`.`nom_funcio` AS `nom_funcio_respon`, `fun_respon`.`ape_funcio` AS `ape_funcio_respon`
            FROM `archivo_radica_interna` AS `radi`
                INNER JOIN `gene_funcionarios_deta` AS `fun_regis` ON (`radi`.`id_funcio_regis` = `fun_regis`.`id_funcio_deta`)
                INNER JOIN `gene_funcionarios` AS `funcio_regis` ON (`fun_regis`.`id_funcio` = `funcio_regis`.`id_funcio`)
                LEFT JOIN `areas_oficinas` AS `funcio_ofi` ON (`fun_regis`.`id_oficina` = `funcio_ofi`.`id_oficina`)
                LEFT JOIN `areas_dependencias` AS `funcio_depen` ON (`funcio_ofi`.`id_depen` = `funcio_depen`.`id_depen`)
                INNER JOIN `archivo_radica_interna_responsa` AS `radi_respon` ON (`radi_respon`.`id_radica` = `radi`.`id_radica`)
                LEFT JOIN `archivo_trd_series` AS `serie` ON (`radi`.`id_serie` = `serie`.`id_serie`)
                LEFT JOIN `archivo_trd_subserie` AS `subserie` ON (`radi`.`id_subserie` = `subserie`.`id_subserie`)
                LEFT JOIN `archivo_trd_tipo_docu` AS `tip_docu` ON (`radi`.`id_tipodoc` = `tip_docu`.`id_tipodoc`)
                INNER JOIN `gene_funcionarios_deta` AS `radi_respon_funcio` ON (`radi_respon`.`id_funcio` = `radi_respon_funcio`.`id_funcio_deta`)
                INNER JOIN `archivo_radica_interna_destinata` AS `radi_desti` ON (`radi_desti`.`id_radica` = `radi`.`id_radica`)
                LEFT JOIN `archivo_radica_interna_proyectores` AS `radi_proyec` ON (`radi_proyec`.`id_radica` = `radi`.`id_radica`)
                INNER JOIN `areas_oficinas` AS `radi_respon_ofi` ON (`radi_respon_funcio`.`id_oficina` = `radi_respon_ofi`.`id_oficina`)
                INNER JOIN `gene_funcionarios` AS `fun_respon` ON (`radi_respon_funcio`.`id_funcio` = `fun_respon`.`id_funcio`)
                INNER JOIN `areas_dependencias` AS `radi_respon_depen` ON (`radi_respon_ofi`.`id_depen` = `radi_respon_depen`.`id_depen`)
            WHERE `radi_respon`.`respon` = 1 AND ".$Condicional."
            ORDER BY `radi`.id_radica DESC";

    $conexion = new Conexion();
    $Instruc = $conexion->prepare($Sql);
    $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
    $Result = $Instruc->fetchAll();
    $conexion = null;

    ?>
    <table class="table table-hover" id="emails"> 
        <thead>
            <div class="row form-row">
                <div class="col-md-4"><strong>INFO. DEL RADICADO</strong></div>
                <div class="col-md-4"><strong>RESPONSABLE</strong></div>
                <div class="col-md-1"><strong>DESTINATARIO</strong></div>
            </div>
        </thead>
        <tbody>
            <?php
            foreach($Result as $item){

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

                if($item['fec_venci'] != ""){

                    $DiasTrascurridos  = DiasTrascurridos($item['fechor_radica']);
                    $DiasParaRespuesta = DiasParaRespuesta($item['fechor_radica'], $item['fec_venci']);
                    $TotalDias = $DiasParaRespuesta-$DiasTrascurridos;

                    $TiempoTrascurrido = "";
                    if($TotalDias < 0){
                        $Clase = "danger";
                        $ClaseTexto = "Vencido";
                        $ClaseColorTexto = "text-dark";
                        $TiempoTrascurrido = "<strong>Retraso de ".$TotalDias." días</strong>";
                        $FechaRadicado = "<strong>".$item['fechor_radica']."</strong>";
                        $RequieRespues = "<strong>Si</strong>";
                        $BagroundColor = "#FA5858";
                        $ColorTextoTitulo = "text-white";
                    }elseif($TotalDias >= 0 and $TotalDias <= 3){
                        $Clase = "warning";
                        $ClaseTexto = "Por Vencer";
                        $ClaseColorTexto = "text-dark";
                        $TiempoTrascurrido = "<strong>Faltan ".$TotalDias." días de ".$DiasParaRespuesta."</strong>";
                        $FechaRadicado = "<strong>".$item['fechor_radica']."</strong>";
                        $RequieRespues = "<strong>Si</strong>";
                        $BagroundColor = "#FACC2E";
                        $ColorTextoTitulo = "text-light";
                    }elseif($TotalDias >= 4 and $TotalDias <= 5){
                        $Clase = "warning";
                        $ClaseTexto = "Pro Vencer";
                        $ClaseColorTexto = "text-dark";
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

                $Responsable = $item['nom_funcio_respon']." ".$item['ape_funcio_respon'];

                $RadicadoPor = $item['nom_funcio_radi']." ".$item['ape_funcio_radi'];

                $Destinatarios = "";
                $Destinatario = RadicadoInternoDestinatario::Listar(1, $item['id_radica'], "");
                foreach ($Destinatario as $Item):
                    $Destinatarios.= $Item['nom_funcio']." ".$Item['ape_funcio'].", ";
                endforeach;
                ?>
                <tr id="TRRadicado" data-id_radicado="<?php echo $item['id_radica']; ?>">
                    <td class="small-cell v-align-middle">
                        <div class="row">
                            <div class="col-md-12 text-dark bg-info" style="background: <?php echo $BagroundColor; ?>">
                                <span class="btn btn-info btn-xs btn-mini" style="margin-right:20px;font-size: 15px">
                                    <strong><?php echo $item['id_radica']; ?></strong>
                                </span>
                                <strong class="<?php echo $ColorTextoTitulo; ?>">
                                    <?php echo $Responsable; ?>
                                </strong>
                                <i class="fa fa-sign-in text-success" style="margin-right:10px; margin-left:10px;"></i>
                                <strong class="<?php echo $ColorTextoTitulo; ?>">
                                    <?php echo $Destinatarios; ?>
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

                            <div class="col-md-4">
                                <?php
                                $Responsable = RadicadoInternoResponsable::Listar(1, $item['id_radica'], "");
                                foreach ($Responsable as $ItemRespon):
                                    $NomDestinatario = substr(trim($ItemRespon['nom_funcio'])." ".trim($ItemRespon['ape_funcio']), 0, 20);
                                    ?>
                                    <dl class="row">
                                        <dt class="col-sm-2">Respon:</dt>
                                        <dd class="col-sm-7"><?php echo $NomDestinatario; ?></dd>
                                        <br>

                                        <dt class="col-sm-2">Depen:</dt>
                                        <dd class="col-sm-7"><?php echo $ItemRespon['nom_depen']; ?></dd>
                                        <br>

                                        <dt class="col-sm-2">Ofi:</dt>
                                        <dd class="col-sm-7"><?php echo $ItemRespon['nom_oficina']; ?></dd>
                                    </dl>
                                    <?php
                                endforeach
                                ?>
                            </div>

                            <div class="col-md-4">
                                <?php
                                $Destinatarios = "";
                                $Destinatario = RadicadoInternoDestinatario::Listar(1, $item['id_radica'], "");
                                foreach ($Destinatario as $ItemDestina):
                                    $NomDestinatario = substr(trim($ItemDestina['nom_funcio'])." ".trim($ItemDestina['ape_funcio']), 0, 20);
                                    ?>
                                    <dl class="row">
                                        <dt class="col-sm-2">Respon:</dt>
                                        <dd class="col-sm-7"><?php echo $NomDestinatario; ?></dd>
                                        <br>

                                        <dt class="col-sm-2">Depen:</dt>
                                        <dd class="col-sm-7"><?php echo $ItemDestina['nom_depen']; ?></dd>
                                        <br>

                                        <dt class="col-sm-2">Ofi:</dt>
                                        <dd class="col-sm-7"><?php echo $ItemDestina['nom_oficina']; ?></dd>
                                    </dl>
                                    <?php
                                endforeach;
                                ?>
                            </div>

                            <div class="col-md-1">
                                <dl class="row">
                                    <?php
                                    if($item['impri_rotu'] == 1){
                                        $ClaseImpimirRotulo = "white";
                                    }elseif($item['impri_rotu'] == 0){
                                        $ClaseImpimirRotulo = "warning";
                                    }

                                    ?>
                                    
                                    <button type="button" class="ImprimirRotuloInterno btn btn-<?php echo $ClaseImpimirRotulo; ?> btn-xs btn-mini" data-toggle="modal" data-target="#myModalImprimirRotulo" data-id_radicado="<?php echo $item['id_radica']; ?>" id="BtnImprimirRotulo<?php echo $item['id_radica']; ?>">
                                        <i class="fa fa-credit-card"></i>
                                    </button>
                                    
                                    <button type="button" class="btn btn-success btn-xs btn-mini" data-toggle="modal" data-target="#myModalMostrarInfoRadicadoInterno" id="BtnMostarInfoRadicadoInterno" data-id_radicado="<?php echo $item['id_radica']; ?>">
                                        <i class="fa fa-info"></i>
                                    </button>
                                    <?php
                                    if($item['fec_venci'] != ""){
                                        ?>
                                        
                                        <button type="button" class="btn btn-success btn-xs btn-mini">
                                            <i class="fa fa-envelope-o"></i>
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
                                    <dd class="col-sm-11"><?php echo $item['asunto']; ?></dd>
                                </dl>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <?php
}
?>