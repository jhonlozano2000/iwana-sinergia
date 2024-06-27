<?php
include "../../../config/class.Conexion.php";
require_once '../../clases/general/class.GeneralTercero.php';

$Tercero = Tercero::Listar(5, 0, 0, "", "", "", $_POST['criterio']);
?>
<table class="table table-hover table-condensed" id="Tbl2">
    <thead>
        <tr>
            <th style="width:1%"></th>
            <th style="width:2%"># Documento</th>
            <th style="width:40%">Nombres</th>
            <th style="width:30%">Direccion</th>
            <th style="width:20%">Telefonos</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($Tercero as $Item):
            ?>
            <tr>
                <td class="v-align-middle">
                    <button type="button" id="BtnLlevarTerceroNaturalDos" class="btn btn-block btn-success btn-xs btn-mini" data-dismiss="modal" 
                        data-id_tercero_natural="<?php echo $Item['id_tercero']; ?>"
                        data-num_docu_tercero_natural="<?php echo $Item['num_docu']; ?>"
                        data-nombre_tercero_natural="<?php echo $Item['nom_contac']; ?>"
                        data-direccion_tercero_natural="<?php echo $Item['nom_depar_remite']." - ".$Item['nom_muni_remite'].", ".$Item['dir_remite']; ?>"
                        data-telefono_tercero_natural="<?php echo $Item['tel_remite']; ?>"
                        data-celular_tercero_natural="<?php echo $Item['cel_remite']; ?>">
                        <i class="fa fa-check"></i>
                    </button>
                </td>
                <td class="v-align-middle"><?php echo $Item['num_docu']; ?></td>
                <td class="v-align-middle"><?php echo $Item['nom_contac']; ?></td>
                <td class="v-align-middle"><?php echo $Item['nom_depar_remite']." - ".$Item['nom_muni_remite'].", ".$Item['dir_remite']; ?></td>
                <td class="v-align-middle"><?php echo "Tel: ".$Item['tel_remite']." Cel: ".$Item['cel_remite']; ?></td>
            </tr>
            <?php
        endforeach;
        ?>
    </tbody>
</table>