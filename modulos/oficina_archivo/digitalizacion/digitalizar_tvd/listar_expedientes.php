<?php
include "../../../../config/class.Conexion.php";
require_once '../../../clases/oficina_archivo/class.OficinaArchivoDigitalizacionTVD.php';

$IncluirOficna = $_POST['incluir_oficina_trd'];

$Expediente = DigitalizacionTVD::Listar(1, 0, 0, 0, 0, $_POST['criterio'], $_POST['criterio'], $_POST['criterio'], $_POST['criterio'], $_POST['criterio']);
?>
<table class="table table-hover table-condensed" id="Tbl2">
    <thead>
        <tr>
            <th style="width:1%"></th>
            <th style="width:20%">Dependencia</th>
            <?php
            if($IncluirOficna == 2){
                ?>
                <th style="width:20%">Oficina</th>
                <?php
            }
            ?>
            <th style="width:20%">Serie</th>
            <th style="width:20%">SubSerie</th>
            <th style="width:10%">Codígo</th>
            <th style="width:20%">Titulo</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($Expediente as $Item):
            ?>
            <tr>
                <td class="v-align-middle">
                    <button type="button" id="BtnLlevarExpediente" class="btn btn-block btn-success btn-xs btn-mini" data-dismiss="modal"
                    data-id_digital="<?php echo $Item['id_digital']; ?>"
                    data-id_depen="<?php echo $Item['id_depen']; ?>"
                    data-id_oficina="<?php echo $Item['id_oficina']; ?>"
                    data-id_serie="<?php echo $Item['id_serie']; ?>"
                    data-id_subserie="<?php echo $Item['id_subserie']; ?>"
                    data-codigo="<?php echo $Item['codigo']; ?>"
                    data-titulo="<?php echo $Item['titulo']; ?>"
                    data-fec_ini="<?php echo $Item['fec_ini']; ?>"
                    data-fec_fin="<?php echo $Item['fec_fin']; ?>"
                    data-criterio1="<?php echo $Item['criterio1']; ?>"
                    data-criterio2="<?php echo $Item['criterio2']; ?>"
                    data-criterio3="<?php echo $Item['criterio3']; ?>"
                    data-deposito="<?php echo $Item['deposito']; ?>"
                    data-caja="<?php echo $Item['caja']; ?>"
                    data-carpeta="<?php echo $Item['carpeta']; ?>"
                    data-folios="<?php echo $Item['folios']; ?>"
                    data-acti="<?php echo $Item['acti']; ?>" >
                    <i class="fa fa-check"></i>
                </button>
            </td>
            <td class="v-align-middle"><?php echo $Item['nom_depen']; ?></td>
            <?php
            if($IncluirOficna == 2){
                ?>
                <td class="v-align-middle"><?php echo $Item['nom_oficina']; ?></td>
                <?php
            }
            ?>
            <td class="v-align-middle"><?php echo $Item['nom_serie']; ?></td>
            <td class="v-align-middle"><?php echo $Item['nom_subserie']; ?></td>
            <td class="v-align-middle"><?php echo $Item['codigo']; ?></td>
            <td class="v-align-middle"><?php echo $Item['titulo']; ?></td>
        </tr>
        <?php
    endforeach;
    ?>
</tbody>
</table>