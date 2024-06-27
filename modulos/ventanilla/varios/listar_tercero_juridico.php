<?php
include "../../../config/class.Conexion.php";
require_once '../../clases/general/class.GeneralTercero.php';

$Tercero = Tercero::Listar(12, 0, 0, "", "", "", $_POST['criterio']);
?>
<table class="table table-hover table-condensed" id="Tbl3">
    <thead>
        <tr>
            <th style="width:1%"></th>
            <th style="width:20%">Entidad</th>
            <th style="width:20%">Contacto</th>
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
                        data-id_tercero_juridico="<?php echo $Item['id_tercero']; ?>"
                        data-id_empre="<?php echo $Item['id_empre']; ?>"
                        data-nit_tercero_juridoc="<?php echo $Item['nit_empre']; ?>"
                        data-entidad_tercero_juridoc="<?php echo $Item['razo_soci']; ?>"
                        data-contacto_tercero_juridico="<?php echo $Item['nom_contac']; ?>"
                        data-direccion_tercero_juridico="<?php echo $Item['nom_depar_empre']." - ".$Item['nom_muni_empre'].", ".$Item['dir_empre']; ?>"
                        data-telefono_tercero_juridico="<?php echo $Item['tel_empre']; ?>"
                        data-celular_tercero_juridico="<?php echo $Item['cel_empre']; ?>">
                        <i class="fa fa-check"></i>
                    </button>
                </td>
                <td class="v-align-middle"><?php echo $Item['razo_soci']; ?></td>
                <td class="v-align-middle"><?php echo $Item['nom_contac']."<br>Cargo: ".$Item['cargo']; ?></td>
                <td class="v-align-middle"><?php echo $Item['nom_depar_empre']." - ".$Item['nom_muni_empre'].", ".$Item['dir_empre']; ?></td>
                <td class="v-align-middle"><?php echo "Tel: ".$Item['tel_empre']." Cel: ".$Item['cel_empre']; ?></td>
            </tr>
            <?php
        endforeach;
        ?>
    </tbody>
</table>