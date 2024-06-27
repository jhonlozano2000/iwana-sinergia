<?php
if (! empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    set_time_limit(0);
    include "../../../config/class.Conexion.php";
    include "../../../config/funciones.php";
    include "../../clases/radicar/class.RadicaEnviadoResponsable.php";

    $Condicional = "";
    if($_POST['id_radica'] != ""){
        if($_POST['id_radica'] != ""){
            $Condicional.="`radi`.id_radica like '%".$_POST['id_radica']."%'";
        }
    }else{

        if($_REQUEST['desde'] != "" and $_REQUEST['hasta'] != ""){
            if($Condicional == ""){
                $Condicional.="DATE(`radi`.fechor_radica) BETWEEN '".Convertir_Fecha_A_Mysql($_POST['desde'])."' AND '".Convertir_Fecha_A_Mysql($_POST['hasta'])."'";
            }else{
                $Condicional.=" AND DATE(`radi`.fechor_radica) BETWEEN '".Convertir_Fecha_A_Mysql($_POST['desde'])."' AND '".Convertir_Fecha_A_Mysql($_POST['hasta'])."'";
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
                $Condicional.="`radi`.asunto like '%".$_POST['asunto']."%'";
            }else{
                $Condicional.=" AND `radi`.asunto like '%".$_POST['asunto']."%'";
            }
        }

        if($_POST['tipo_tercero'] === 'NATURAL' AND $_POST['id_tercero'] != ""){
            if($Condicional == ""){
                $Condicional.="`terce_contac`.`id_empre` = ".$_POST['id_tercero'];
            }else{
                $Condicional.=" AND `terce_contac`.`id_empre` = ".$_POST['id_tercero'];
            }
        }elseif($_POST['tipo_tercero'] === 'JURIDICO' AND $_POST['id_tercero'] != ""){
            if($Condicional == ""){
                $Condicional.="`terce_empre`.`id_empre` = ".$_POST['id_tercero'];
            }else{
                $Condicional.=" AND `terce_empre`.`id_empre` = ".$_POST['id_tercero'];
            }
        }

        if($_POST['id_destinatario'] != ""){
            if($Condicional == ""){
                $Condicional.="`ra_respon`.`id_funcio_deta` = ".$_POST['id_destinatario'];
            }else{
                $Condicional.=" AND `ra_respon`.`id_funcio_deta` = ".$_POST['id_destinatario'];
            }
        }

        if($_POST['id_depen'] != "0"){
            if($Condicional == ""){
                $Condicional.="`areas_oficinas`.`id_depen` = ".$_POST['id_depen'];
            }else{
                $Condicional.=" AND `areas_oficinas`.`id_depen` = ".$_POST['id_depen'];
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
                $Condicional.=" AND subserie = ".$_POST['id_subserie'];
            }
        }

        if($_POST['id_depen'] != "0" and $_POST['id_serie'] != "0" and $_POST['id_subserie'] != "0" and $_POST['id_tipodoc'] != "0"){
            if($Condicional == ""){
                $Condicional.="subserie.id_tipodoc = ".$_POST['id_tipodoc'];
            }else{
                $Condicional.=" AND subserie.id_tipodoc = ".$_POST['id_tipodoc'];
            }
        }
    }

    $Sql = "SELECT DISTINCT `radi`.`id_radica`, `radi`.`asunto`, `radi`.`fec_docu`, `radi`.`fechor_radica`, `radi`.`digital`, `radi`.`impri_rotu`,
                `fun`.`nom_funcio`, `fun`.`ape_funcio`, `areas_dependencias`.`id_depen`, `areas_dependencias`.`nom_depen`, `areas_oficinas`.`nom_oficina`,
                `terce_contac`.`nom_contac`, `terce_empre`.`razo_soci`, `funcio_radi`.`nom_funcio` AS `nom_funcio_radi`,
                `funcio_radi`.`ape_funcio` AS `ape_funcio_radi`, `config_formaenvio`.`id_formaenvio`, `config_formaenvio`.`nom_formaenvi`,
                `config_formaenvio`.`requie_digital`, `radi`.`impri_rotu`
            FROM `archivo_radica_enviados_responsa` AS `ra_respon`
                INNER JOIN `archivo_radica_enviados` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_destina` = `terce_contac`.`id_tercero`)
                INNER JOIN `segu_usua` AS `usua_radi` ON (`radi`.`id_usua_regis` = `usua_radi`.`id_usua`)
                INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio_deta` = `funcio_deta`.`id_funcio_deta`)
                INNER JOIN `gene_funcionarios` AS `fun` ON (`funcio_deta`.`id_funcio` = `fun`.`id_funcio`)
                LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                INNER JOIN `gene_funcionarios` AS `funcio_radi` ON (`usua_radi`.`id_funcio` = `funcio_radi`.`id_funcio`)
                INNER JOIN `areas_oficinas` ON (`funcio_deta`.`id_oficina` = `areas_oficinas`.`id_oficina`)
                INNER JOIN `areas_dependencias` ON (`areas_oficinas`.`id_depen` = `areas_dependencias`.`id_depen`)
                INNER JOIN `config_formaenvio` ON (`radi`.`id_formaenvio` = `config_formaenvio`.`id_formaenvio`)
            WHERE (`ra_respon`.`respon` = 1) AND  ".$Condicional."
            ORDER BY `radi`.id_radica DESC";

    $conexion = new Conexion();
    $Instruc = $conexion->prepare($Sql);
    $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
    $Result = $Instruc->fetchAll();
    $conexion = null;
    ?>
    <table class="table table-hover" id="Tbl1">
        <thead>
            <div class="row form-row">
                <div class="col-md-4">Información del Radicado</div>
                <div class="col-md-3">Informacón Basica</div>
                <div class="col-md-4">Detalle del Destino</div>
                <div class="col-md-1">Acciones</div>
            </div>
        </thead>
        <tbody>
          <?php
          foreach($Result as $item){

            $Remitente = "";
            if($item['razo_soci'] != ""){
                $Remitente = $item['razo_soci'];
            }else{
                $Remitente = $item['nom_contac'];
            }

            $Destinatario = trim($item['nom_funcio']." ".$item['ape_funcio'].", Depen.: ".$item['nom_depen'].", Ofi.: ".$item['nom_oficina']);
            $RadicadoPor = trim($item['nom_funcio_radi']." ".$item['ape_funcio_radi']);
            ?>
            <tr id="TRRadicado" data-id_radicado="<?php echo $item['id_radica']; ?>">
                <td class="small-cell v-align-middle">
                    <div class="row">
                        <div class="col-md-12 bg-info text-dark">
                            <span class="btn btn-info btn-xs btn-mini" style="margin-right:20px;font-size: 15px">
                                <strong><?php echo $item['id_radica']; ?></strong>
                            </span>
                            <strong>
                                <?php echo utf8_encode($Remitente); ?>
                            </strong>
                            <i class="fa fa-sign-in text-success" style="margin-right:10px; margin-left:10px;"></i>
                            <strong>
                                <?php echo utf8_encode($Destinatario); ?>
                            </strong>

                        </div>
                        <hr style="border-width: 2px; height: 0px; border-style: dashed; border-color: default;"/>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <dl class="row">
                                <dt class="col-sm-4">Fecha Radicado:</dt>
                                <dd class="col-sm-7 <?php echo $ClaseColorTexto; ?>"><?php echo $item['fechor_radica']; ?></dd>
                                <br>
                                <br>
                                <dt class="col-sm-4">Usuario que Radico:</dt>
                                <dd class="col-sm-7"><?php echo utf8_encode($RadicadoPor); ?></dd>
                            </dl>
                        </div>

                        <div class="col-md-3">
                            <dl class="row">
                                <dt class="col-sm-3">Remitente:</dt>
                                <dd class="col-sm-7"><?php echo utf8_encode(trim($Remitente)); ?></dd>

                                <dt class="col-sm-3">Tip. Envio:</dt>
                                <dd class="col-sm-7"><?php echo utf8_encode(trim($item['nom_formaenvi'])); ?></dd>
                            </dl>
                        </div>

                        <div class="col-md-4">
                            <?php
                            $Responsable = RadicadoEnviadoResponsable::Listar(1, $item['id_radica'], "", "", "");
                            foreach ($Responsable as $ItemRespon):

                                $TotalCadena = explode(" ", $item['ape_funcio']);
                                $Responsable = trim($item['nom_funcio'])." ".trim($TotalCadena[0]);
                                ?>
                                <dl class="row">
                                    <dt class="col-sm-2">Respon:</dt>
                                    <dd class="col-sm-7"><?php echo utf8_encode($Responsable); ?></dd>
                                    <br>

                                    <dt class="col-sm-2">Depen:</dt>
                                    <dd class="col-sm-7"><?php echo utf8_encode(trim($item['nom_depen'])); ?></dd>
                                    <br>

                                    <dt class="col-sm-2">Ofi:</dt>
                                    <dd class="col-sm-7"><?php echo utf8_encode(trim($item['nom_oficina'])); ?></dd>
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
                                    <button type="button" class="btn btn-warning btn-xs btn-mini" data-toggle="modal" data-target="#myModalAdjuntarDocumento" data-id_radicado="<?php echo $item['id_radica']; ?>" data-id_dependencia="<?php echo $item['id_depen']; ?>" id="BtnAdjunarDigital">
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

                                <button type="button" class="ImprimirRotuloEnviado btn btn-<?php echo $ClaseImpimirRotulo; ?> btn-xs btn-mini" data-toggle="modal" data-target="#myModalImprimirRotulo" data-id_radicado="<?php echo $item['id_radica']; ?>" id="BtnImprimirRotulo<?php echo $item['id_radica']; ?>">
                                    <i class="fa fa-credit-card"></i>
                                </button>

                                <button type="button" class="btn btn-success btn-xs btn-mini" data-toggle="modal" data-target="#myModalMostrarInfoRadicadoEnviado" data-id_radicado="<?php echo $item['id_radica']; ?>" id="BtnMostarInfoRadicadoEnviado">
                                    <i class="fa fa-info"></i>
                                </button>
                            </dl>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <dl class="row">
                                <dt class="col-sm-1">Asunto:</dt>
                                <dd class="col-sm-11"><?php echo trim($item['asunto']); ?></dd>
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