<?php
if (! empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

    include "../../../config/class.Conexion.php";
    include "../../../config/funciones.php";
    require_once '../../clases/radicar/class.RadicaRecibidoResponsable.php';

    $Condicional = "";

    if($_POST['id_radica'] != ""){
        $Condicional.="`ra`.id_radica like '%".$_POST['id_radica']."%'";
    }else{

        if($_REQUEST['desde'] != ""){
            if($Condicional == ""){
                $Condicional.="DATE(`ra`.fechor_radica) >= '".Convertir_Fecha_A_Mysql($_POST['desde'])."'";
            }else{
                $Condicional.=" AND DATE(`ra`.fechor_radica) >= '".Convertir_Fecha_A_Mysql($_POST['desde'])."'";
            }
        }

        if($_REQUEST['hasta'] != ""){
            if($Condicional == ""){
                $Condicional.="DATE(`ra`.fechor_radica) <= '".Convertir_Fecha_A_Mysql($_POST['hasta'])."'";
            }else{
                $Condicional.=" AND DATE(`ra`.fechor_radica) <= '".Convertir_Fecha_A_Mysql($_POST['hasta'])."'";
            }
        }

        if($_REQUEST['asunto'] != ""){
            if($Condicional == ""){
                $Condicional.="`ra`.asunto like '%".$_POST['asunto']."%'";
            }else{
                $Condicional.=" AND `ra`.asunto like '%".$_POST['asunto']."%'";
            }
        }

        if($_POST['tipo_tercero'] === 'NATURAL' AND $_POST['id_tercero'] != ""){
            if($Condicional == ""){
                $Condicional.="RemiteContac.id_tercero = ".$_POST['id_tercero'];
            }else{
                $Condicional.=" AND RemiteContac.id_tercero = ".$_POST['id_tercero'];
            }
        }elseif($_POST['tipo_tercero'] === 'JURIDICO' AND $_POST['id_tercero'] != ""){
            if($Condicional == ""){
                $Condicional.="RemiteContac.id_empre = ".$_POST['id_tercero'];
            }else{
                $Condicional.=" AND RemiteContac.id_empre = ".$_POST['id_tercero'];
            }
        }

        if($_POST['destinatario'] != ""){
            if($Condicional == ""){
                $Condicional.="ResponFuncio.id_funcio = ".$_POST['destinatario'];
            }else{
                $Condicional.=" AND ResponFuncio.id_funcio = ".$_POST['destinatario'];
            }
        }

        if($_POST['id_depen'] != "0"){
            if($Condicional == ""){
                $Condicional.="depen.id_depen = ".$_POST['id_depen'];
            }else{
                $Condicional.=" AND depen.id_depen = ".$_POST['id_depen'];
            }
        }

        if($_POST['id_depen'] != "0" and $_POST['id_serie'] != "0"){
            if($Condicional == ""){
                $Condicional.="serie.id_serie = ".$_POST['id_serie'];
            }else{
                $Condicional.=" AND serie.id_serie = ".$_POST['id_serie'];
            }
        }

        if($_POST['id_depen'] != "0" and $_POST['id_serie'] != "0" and $_POST['id_subserie'] != "0"){
            if($Condicional == ""){
                $Condicional.="subserie.id_subserie = ".$_POST['id_subserie'];
            }else{
                $Condicional.=" AND subserie.id_subserie = ".$_POST['id_subserie'];
            }
        }

        if($_POST['id_depen'] != "0" and $_POST['id_serie'] != "0" and $_POST['id_subserie'] != "0" and $_POST['id_tipodoc'] != "0"){
            if($Condicional == ""){
                $Condicional.="tipodocu.id_tipodoc = ".$_POST['id_tipodoc'];
            }else{
                $Condicional.=" AND tipodocu.id_tipodoc = ".$_POST['id_tipodoc'];
            }
        }
    }

    $Sql = "SELECT `ra`.`id_radica`, `ra`.`requie_respues`, `ra`.`fechor_radica`, `ra`.`fec_docu`, `ra`.`fec_venci`, `ra`.`asunto`, `ra`.`digital`,
                `funcio`.`nom_funcio`, `funcio`.`ape_funcio`, `depen`.`nom_depen`, `ofi`.`nom_oficina`, `RemiteContac`.`nom_contac`,
                `RemiteEmpre`.`nit_empre`, `RemiteEmpre`.`razo_soci`, `funcio_deta`.`id_oficina`, `ra_respon`.`respon`, `ra_respon`.`id_funcio`,
                `forma_recibi`.`requie_digital`, `forma_recibi`.`nom_formaenvi` as 'nom_forma_llega', `funcio_radi`.`nom_funcio` AS `nom_funcio_radi`,
                `funcio_radi`.`ape_funcio` AS `ape_funcio_radi`, `ra`.`impri_rotu`, `ra`.`respondido`, `ra`.`radica_respuesta`
            FROM `archivo_radica_recibidos` AS `ra`
                INNER JOIN `gene_terceros_contac` AS `RemiteContac` ON (`ra`.`id_remite` = `RemiteContac`.`id_tercero`)
                LEFT JOIN `gene_terceros_empresas` AS `RemiteEmpre` ON (`RemiteContac`.`id_empre` = `RemiteEmpre`.`id_empre`)
                INNER JOIN `archivo_radica_recibidos_responsa` AS `ra_respon` ON (`ra_respon`.`id_radica` = `ra`.`id_radica`)
                INNER JOIN `config_formaenvio` AS `forma_recibi` ON (`ra`.`id_forma_llegada` = `forma_recibi`.`id_formaenvio`)
                INNER JOIN `segu_usua` AS `usua_radi` ON (`ra`.`id_usua_regis` = `usua_radi`.`id_usua`)
                INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio` = `funcio_deta`.`id_funcio_deta`)
                INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`)
                INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                INNER JOIN `gene_funcionarios` AS `funcio_radi` ON (`usua_radi`.`id_funcio` = `funcio_radi`.`id_funcio`)
            WHERE (ra_respon.respon = 1) AND  ".$Condicional."
            ORDER BY `ra`.id_radica DESC";

    $conexion = new Conexion();
    $Instruc = $conexion->prepare($Sql);
    $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
    $Result = $Instruc->fetchAll();
    $conexion = null;

    ?>
    <div  style="width: 100%; height: 500px; overflow-y: scroll;">
        <table class="table table-hover" id="Tbl1">
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

                    if($item['fec_venci'] != "" and $item['requie_respues'] == 1 and $item['respondido'] == 0){

                        $DiasTrascurridos  = DiasTrascurridos($item['fechor_radica']);
                        $DiasParaRespuesta = DiasParaRespuesta($item['fechor_radica'], $item['fec_venci']);
                        $TotalDias         = $DiasParaRespuesta-$DiasTrascurridos;

                        $TiempoTrascurrido = "";
                        if($item['radica_respuesta'] != ""){
                            $Clase             = "info";
                            $ClaseTexto        = "Con Respuesta";
                            $ClaseColorTexto   = "text-white";
                            $TiempoTrascurrido = "<strong>Retraso de ".$TotalDias." días</strong>";
                            $FechaRadicado     = "<strong>".$item['fechor_radica']."</strong>";
                            $RequieRespues     = "<strong>Si</strong>";
                            $BagroundColor     = "";
                            $ColorTextoTitulo  = "text-black";
                        }elseif($TotalDias < 0){
                            $Clase             = "danger";
                            $ClaseTexto        = "Vencido";
                            $ClaseColorTexto   = "text-error";
                            $TiempoTrascurrido = "<strong>Retraso de ".$TotalDias." días</strong>";
                            $FechaRadicado     = "<strong>".$item['fechor_radica']."</strong>";
                            $RequieRespues     = "<strong>Si</strong>";
                            $BagroundColor     = "#FA5858";
                            $ColorTextoTitulo  = "text-white";
                        }elseif($TotalDias >= 0 and $TotalDias <= 3){
                            $Clase             = "warning";
                            $ClaseTexto        = "Por Vencer";
                            $ClaseColorTexto   = "text-warning";
                            $TiempoTrascurrido = "<strong>Faltan ".$TotalDias." días de ".$DiasParaRespuesta."</strong>";
                            $FechaRadicado     = "<strong>".$item['fechor_radica']."</strong>";
                            $RequieRespues     = "<strong>Si</strong>";
                            $BagroundColor     = "#FACC2E";
                            $ColorTextoTitulo  = "text-light";
                        }elseif($TotalDias >= 4 and $TotalDias <= 5){
                            $Clase             = "warning";
                            $ClaseTexto        = "Pro Vencer";
                            $ClaseColorTexto   = "text-warning";
                            $TiempoTrascurrido = "<strong>Faltan ".$TotalDias." días de ".$DiasParaRespuesta."</strong>";
                            $FechaRadicado     = "<strong>".$item['fechor_radica']."</strong>";
                            $RequieRespues     = "<strong>Si</strong>";
                            $BagroundColor     = "#FACC2E";
                            $ColorTextoTitulo  = "text-light";
                        }elseif($TotalDias > 5){
                            $Clase             = "";
                            $ClaseTexto        = "";
                            $ClaseColorTexto   = "";
                            $TiempoTrascurrido = "<strong>Faltan ".$TotalDias." días de ".$DiasParaRespuesta."</strong>";
                            $FechaRadicado     = "<strong>".$item['fechor_radica']."</strong>";
                            $RequieRespues     = "<strong>Si</strong>";
                            $ColorTextoTitulo  = "";
                        }
                    }else{
                        $Clase             = "";
                        $ClaseTexto        = "";
                        $ClaseColorTexto   = "";
                        $TiempoTrascurrido = "---";
                    }

                    $Remitente = "";
                    if($item['razo_soci'] != ""){
                        $Remitente = $item['razo_soci'];
                    }else{
                        $Remitente = $item['nom_contac'];
                    }

                    $Destinatario = $item['nom_funcio']." ".$item['ape_funcio'].", Depen.: ".$item['nom_depen'].", Ofi.: ".$item['nom_oficina'];
                    $RadicadoPor  = $item['nom_funcio_radi']." ".$item['ape_funcio_radi'];

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
                                    <?php
                                    $Responsable = RadicadoRecibidoResponsable::Listar(1, $item['id_radica'], "");
                                    foreach ($Responsable as $ItemRespon):

                                        $array = explode(" ", $ItemRespon['ape_funcio']);
                                        $NomResponsable = $ItemRespon['nom_funcio']." ".$array[0];
                                        ?>
                                        <dl class="row">
                                            <dt class="col-sm-2">Respon:</dt>
                                            <dd class="col-sm-7"><?php echo $NomResponsable; ?></dd>
                                            <br>

                                            <dt class="col-sm-2">Depen:</dt>
                                            <dd class="col-sm-7"><?php echo $ItemRespon['nom_depen']; ?></dd>
                                            <br>

                                            <dt class="col-sm-2">Ofi:</dt>
                                            <dd class="col-sm-7"><?php echo $ItemRespon['nom_oficina']; ?></dd>
                                        </dl>
                                        <?php
                                    endforeach;
                                    ?>
                                </div>

                                <div class="col-md-2">
                                    <dl class="row">
                                        <?php
                                        if($item['digital'] == 0 and $item['requie_digital'] == 1){
                                            ?>
                                            <button type="button" class="idradicado btn btn-warning btn-xs btn-mini btn-circle idradicado" data-toggle="modal" data-target="#myModalAdjuntarDocumento" data-id_radicado="<?php echo $item['id_radica']; ?>" id="BtnAdjunarDigital<?php echo $item['id_radica']; ?>" title="Subir archivo digital">
                                                <i class="fa fa-cloud-upload"></i>
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
    </div>
    <?php
}
?>