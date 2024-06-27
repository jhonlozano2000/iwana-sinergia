<?php
if (! empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

    include "../../../config/class.Conexion.php";
    include "../../../config/funciones.php";
    
    $Condicional = "";
    if($_POST['id_radica'] != ""){
        if($_POST['id_radica'] != ""){
            $Condicional.="ra.id_radica like '%".$_POST['id_radica']."%'";
        }
    }else{

        if($_REQUEST['desde'] != ""){
            if($Condicional == ""){
                $Condicional.="DATE(ra.fechor_radica) >= '".Convertir_Fecha_A_Mysql($_POST['desde'])."'";
            }else{
                $Condicional.=" AND DATE(ra.fechor_radica) >= '".Convertir_Fecha_A_Mysql($_POST['desde'])."'";
            }
        }

        if($_POST['asunto'] != ""){
            if($Condicional == ""){
                $Condicional.="ra.asunto like '%".$_POST['asunto']."%'";
            }else{
                $Condicional.=" AND ra.asunto like '%".$_POST['asunto']."%'";
            }
        }

        if($_POST['tipo_tercero'] === 'NATURAL' AND $_POST['id_tercero'] != ""){
            if($Condicional == ""){
                $Condicional.="desti.id_tercero = ".$_POST['id_tercero'];
            }else{
                $Condicional.=" AND desti.id_tercero = ".$_POST['id_tercero'];
            }
        }elseif($_POST['tipo_tercero'] === 'JURIDICO' AND $_POST['id_tercero'] != ""){
            if($Condicional == ""){
                $Condicional.="desti_empre.id_empre = ".$_POST['id_tercero'];
            }else{
                $Condicional.=" AND desti_empre.id_empre = ".$_POST['id_tercero'];
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

    $Sql = "SELECT `ra`.`id_radica`, `ra`.`fechor_radica`, `ra`.`fec_docu`, `ra`.`digital`, `ra`.`asunto`, `desti`.`nom_contac`, `desti_empre`.`razo_soci`, 
                `fun`.`nom_funcio`, `fun`.`ape_funcio`, `depen`.`cod_corres`, `depen`.`nom_depen`, `ra_respon`.`respon`
            FROM `archivo_radica_enviados_responsa` AS `ra_respon`
                INNER JOIN `archivo_radica_enviados` AS `ra` ON (`ra_respon`.`id_radica` = `ra`.`id_radica`)
                INNER JOIN `gene_terceros_contac` AS `desti` ON (`ra`.`id_destina` = `desti`.`id_tercero`)
                INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio_deta` = `funcio_deta`.`id_funcio_deta`)
                INNER JOIN `gene_funcionarios` AS `fun` ON (`funcio_deta`.`id_funcio` = `fun`.`id_funcio`)
                INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                LEFT JOIN `gene_terceros_empresas` AS `desti_empre` ON (`desti`.`id_empre` = `desti_empre`.`id_empre`)
                INNER JOIN `archivo_trd_series` AS `serie` ON (`ra`.`id_serie` = `serie`.`id_serie`)
                INNER JOIN `archivo_trd_subserie` AS `subserie` ON (`ra`.`id_subserie` = `subserie`.`id_subserie`)
                WHERE (`ra_respon`.`respon` = 1) AND  ".$Condicional."
                ORDER BY ra.id_radica DESC";

    $conexion = new Conexion();
    $conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $Instruc = $conexion->prepare($Sql);
    $Instruc->execute() or die(print_r($InstrucBuscar->errorInfo()." - ".$Sql, true));
    $Result = $Instruc->fetchAll();
    $conexion = null;

    ?>
    <table class="table table-hover" id="Tbl1">
        <thead>
            <tr>
                <th width="130">Radicado</th>
                <th width="130">D</th>
                <th width="100" class="medium-cell">Fec. Docu.</th>
                <th width="250" class="">Asunto</th>
                <th width="250" class="">Responsable</th>
                <th width="250" class="">Tercero</th>
            </tr>
        </thead>
        <tbody>
          <?php
          foreach($Result as $item){
           ?>
           <tr data-id="<?php echo $item['id_radica']; ?>" class="radicado_filtrar">
            <td class="clickable tablefull v-align-middle">
                <strong>
                    <?php 
                    echo $item['id_radica']; 
                    ?>
                </strong>
            </td>
            <td class="clickable tablefull v-align-middle">
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
                        <i class="idradicado fa fa-warning text-warning"></i>
                    </span>
                    <?php 
                } 
                ?>
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
                   echo "Funcio.: ".$item['nom_funcio']." ".$item['ape_funcio']."<br>Depen.:".$item['nom_depen'];
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
    </tr>
    <?php
}
?>
</tbody>
</table>
<?php
}
?>