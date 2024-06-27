<?php
require_once '../../../config/class.Conexion.php';
require_once "../../clases/retencion/calss.TRD.php";
require_once "../../clases/areas/class.AreasDependencia.php";
$Dependencia = Dependencia::Listar(6, "", "", "", "");
?>
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <?php
    foreach($Dependencia as $ItemDepen):
        ?>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseDepen<?php echo $ItemDepen['id_depen']; ?>" aria-expanded="true" aria-controls="collapseDepen<?php echo $ItemDepen['id_depen']; ?>">
                        <?php
                        echo "Depen: ".$ItemDepen['nom_depen'];
                        ?>
                    </a>
                </h4>
            </div>
            <div id="collapseDepen<?php echo $ItemDepen['id_depen']; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                    <div class="panel-group" id="sub-accordion" role="tablist" aria-multiselectable="true">
                        <?php
                        $Serie = TRD::Listar(6, "", $ItemDepen['id_depen'], "", "","");
                        foreach($Serie as $ItemSerie):
                            ?>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="subHeadingOne">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#sub-accordion" href="#collapseSerie<?php echo $ItemDepen['id_depen'].$ItemSerie['id_serie']; ?>" aria-expanded="true" aria-controls="collapseSerie<?php echo $ItemDepen['id_depen'].$ItemSerie['id_serie']; ?>">
                                            <?php
                                            echo $ItemSerie['cod_serie'].".".$ItemSerie['nom_serie'];
                                            ?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseSerie<?php echo $ItemDepen['id_depen'].$ItemSerie['id_serie']; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="subHeadingOne">
                                    <div class="panel-body">
                                        <?php
                                        $SubSerie = TRD::Listar(9, "", $ItemDepen['id_depen'], $ItemSerie['id_serie'] , "","");
                                        foreach($SubSerie as $ItemSubSerie):
                                            ?>
                                            <div class="row-fluid">
                                                <div class="checkbox check-success">
                                                    <input id="checkbox<?php echo $ItemSubSerie['id_subserie']; ?>" name="ChkTRD[]" type="checkbox" value="<?php echo $ItemDepen['id_depen']."-".$ItemSerie['id_serie']."-".$ItemSubSerie['id_subserie']; ?>">
                                                    <label for="checkbox<?php echo $ItemSubSerie['id_subserie']; ?>">
                                                        <?php
                                                        echo $ItemSubSerie['cod_subserie'].".".$ItemSubSerie['nom_subserie'];
                                                        ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php
                                        endforeach;
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                        endforeach;
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    endforeach;
    ?>
</div>