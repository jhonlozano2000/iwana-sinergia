<?php
include "../../../config/class.Conexion.php";
require_once '../../clases/general/class.GeneralTercero.php';

$Tercero = Tercero::Listar(14, 0, 0, "", "", "", $_POST['criterio']);
?>
<table class="table table-hover table-condensed" id="Tbl4">
    <thead>
        <tr>
            <th style="width:1%"></th>
            <th style="width:20%">Entidad</th>
            <th style="width:20%">Direccion</th>
            <th style="width:10%">Telefonos</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($Tercero as $Item):
            ?>
            <tr>
                <td class="v-align-middle">
                    <button type="button" id="BtnLlevarTerceroJuridico" name="BtnLlevarTerceroJuridico" class="btn btn-block btn-success btn-xs btn-mini" data-dismiss="modal"
                        data-id_tercero_juridico="<?php echo $Item['id_empre']; ?>"
                        data-id_empre="<?php echo $Item['id_empre']; ?>"
                        data-nit_tercero_juridoc="<?php echo $Item['nit_empre']; ?>"
                        data-entidad_tercero_juridoc="<?php echo $Item['razo_soci']; ?>"
                        data-direccion_tercero_juridico="<?php echo $Item['nom_depar_empre']." - ".$Item['nom_muni_empre'].", ".$Item['dir_empre']; ?>"
                        data-telefono_tercero_juridico="<?php echo $Item['tel_empre']; ?>"
                        data-celular_tercero_juridico="<?php echo $Item['cel_empre']; ?>">
                        <i class="fa fa-check"></i>
                    </button>
                </td>
                <td class="v-align-middle"><?php echo $Item['razo_soci']; ?></td>
                <td class="v-align-middle"><?php echo $Item['nom_depar']." - ".$Item['nom_muni'].", ".$Item['dir']; ?></td>
                <td class="v-align-middle"><?php echo "Tel: ".$Item['tel']." Cel: ".$Item['cel']; ?></td>
            </tr>
            <?php
        endforeach;
        ?>
    </tbody>
</table>