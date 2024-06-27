<?php
if (! empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

    include "../../../config/class.Conexion.php";
    include "../../../config/funciones.php";

    $Condicional = "";

    if($_POST['id_radica'] != ""){
        $Condicional.="ra.id_radica like '%".$_POST['id_radica']."%'";
    }else{

        if($_REQUEST['desde'] != ""){
            if($Condicional == ""){
                $Condicional.="DATE(ra.fechor_Radica) >= '".Convertir_Fecha_A_Mysql($_POST['desde'])."'";
            }else{
                $Condicional.=" AND DATE(ra.fechor_Radica) >= '".Convertir_Fecha_A_Mysql($_POST['desde'])."'";
            }
        }

        if($_REQUEST['hasta'] != ""){
            if($Condicional == ""){
                $Condicional.="DATE(ra.fechor_Radica) <= '".Convertir_Fecha_A_Mysql($_POST['hasta'])."'";
            }else{
                $Condicional.=" AND DATE(ra.fechor_Radica) <= '".Convertir_Fecha_A_Mysql($_POST['hasta'])."'";
            }
        }

        if($_REQUEST['asunto'] != ""){
            if($Condicional == ""){
                $Condicional.="ra.asunto like '%".$_POST['asunto']."%'";
            }else{
                $Condicional.=" AND ra.asunto like '%".$_POST['asunto']."%'";
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


    $Sql = "SELECT `ra`.`id_radica`, `ra`.`digital`, `ra`.`transferido`, `ra`.`requie_respues`, `ra`.`fec_docu`, `ra`.`fec_venci`, `ra`.`asunto`, 
    `remi`.`nom_contac`, `remi_empre`.`razo_soci`, `ra`.`autoriza`, `ra_respon`.`respon`, `funcio`.`nom_funcio`, `funcio`.`ape_funcio`, 
    `depen`.`nom_depen`, `ofi`.`nom_oficina`, `cargo`.`nom_cargo`, `ra_respon`.`respon`, `ra`.`digital`
    FROM `archivo_radica_recibidos` AS `ra`
    INNER JOIN `gene_terceros_contac` AS `remi` ON (`ra`.`id_remite` = `remi`.`id_tercero`)
    LEFT JOIN `gene_terceros_empresas` AS `remi_empre` ON (`remi`.`id_empre` = `remi_empre`.`id_empre`)
    INNER JOIN `archivo_radica_recibidos_responsa` AS `ra_respon` ON (`ra_respon`.`id_radica` = `ra`.`id_radica`)
    INNER JOIN `gene_funcionarios_deta` AS `fun_deta` ON (`ra_respon`.`id_funcio` = `fun_deta`.`id_funcio_deta`)
    INNER JOIN `gene_funcionarios` AS `funcio` ON (`fun_deta`.`id_funcio` = `funcio`.`id_funcio`)
    INNER JOIN `areas_oficinas` AS `ofi` ON (`fun_deta`.`id_oficina` = `ofi`.`id_oficina`)
    INNER JOIN `areas_cargos` AS `cargo` ON (`fun_deta`.`id_cargo` = `cargo`.`id_cargo`)
    INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
    INNER JOIN `archivo_trd_series` AS `serie` ON (`ra`.`id_serie` = `serie`.`id_serie`)
    INNER JOIN `archivo_trd_subserie` AS `subserie` ON (`ra`.`id_subserie` = `subserie`.`id_subserie`)
    INNER JOIN `archivo_trd_tipo_docu` AS `tipodocu` ON (`ra`.`id_tipodoc` = `tipodocu`.`id_tipodoc`)
    WHERE (ra_respon.respon = 1) AND  ".$Condicional."
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
                <th width="100" class="medium-cell">Fec. Venci.</th>
                <th width="250" class="">Asunto</th>
                <th width="250" class="">Responsable</th>
                <th width="250" class="">Tercero</th>
                <th width="200" class=""></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($Result as $item){
                ?>
                <tr id="TRRadicado" data-id_radicado="<?php echo $item['id_radica']; ?>">
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
                            if($item['fec_venci'] != ""){
                                echo Fecha_Corta_Español($item['fec_venci']);
                            }
                            ?>
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
                            if($item['razo_soci'] != ""){
                                echo 'Enti.: '.$item['razo_soci']."<br>Contac.: ".$item['nom_contac'];
                            }else{
                                echo $item['nom_contac'];
                            }
                            ?>
                        </span>
                    </td>
                    <td>
                        <div class="btn-group">
                            <button class="btn btn-small btn-white btn-demo-space">Acción</button>
                            <button class="btn btn-small btn-white dropdown-toggle btn-demo-space" data-toggle="dropdown"> <span class="caret"></span> </button>
                            <ul class="dropdown-menu">
                                <li><a href="#" data-toggle="modal" data-target="#myModalVencimiento" id="BtnVencimiento" data-id_radicado="<?php echo $item['id_radica']; ?>">Vencimiento</a></li>
                                <li><a href="#">Asunto</a></li>
                                <li><a href="#">Eliminar Digital</a></li>
                            </ul>
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

<!-- BEGIN MODAL PARA VENCIMIENTO ROTULO-->
<div class="modal fade" id="myModalVencimiento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <br>
                <i class="fa fa-calendar fa-2x"></i>
                <h4 id="myModalLabel" class="semi-bold">Establecer fecha de vencimiento.</h4>
                <div id="ojo"></div>
            </div>
            <div class="modal-body">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="grid simple ">
                            <div class="grid-body ">
                                <div class="row-fluid" style="display:none;" id="DivOtrosElementos">
                                    <div class="slide-success">
                                        <input type="checkbox" name="switch" class="iosblue" checked="checked"/>
                                    </div>
                                    <div class="slide-primary">
                                        <input type="checkbox" name="switch" class="ios" checked="checked" placeholder="Requiere respuesta" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div id="dp5" data-date="12-02-2013" data-date-format="dd-mm-yyyy"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-ban"></i> Cancelar</button>
                <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-check"></i> Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="../../../public/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="../../../public/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
<script src="../../../public/assets/plugins/jquery-inputmask/jquery.inputmask.min.js" type="text/javascript"></script>
<script src="../../../public/assets/plugins/ios-switch/ios7-switch.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="../../../public/assets/plugins/boostrap-form-wizard/js/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
<script src="../../../public/assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="../../../public/assets/js/form_validations.js" type="text/javascript"></script>
<script src="../../../public/assets/js/form_elements.js" type="text/javascript"></script>