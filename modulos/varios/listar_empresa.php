<?php
include "../../config/class.Conexion.php";
require_once '../clases/general/class.GeneralTerceroEmpresa.php';

$Empresas = TerceroEmpresa::Listar(3, 0, $_POST['criterio'], $_POST['criterio'], "", "", "");
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
        foreach($Empresas as $Item):
            ?>
            <tr>
                <td class="v-align-middle">
                    <button type="button" id="BtnLlevarEmpresa" name="BtnLlevarEmpresa" class="btn btn-block btn-success btn-xs btn-mini"
                        data-id_empre="<?php echo $Item['id_empre']; ?>"
                        data-nit="<?php echo $Item['nit_empre']; ?>"
                        data-razo_soci="<?php echo $Item['razo_soci']; ?>"
                        data-id_depar="<?php echo $Item['id_depar']; ?>"
                        data-id_muni="<?php echo $Item['id_muni']; ?>"
                        data-dir="<?php echo $Item['dir']; ?>"
                        data-tel="<?php echo $Item['tel']; ?>"
                        data-cel="<?php echo $Item['cel']; ?>"
                        data-fax="<?php echo $Item['fax']; ?>"
                        data-email="<?php echo $Item['email']; ?>"
                        data-web="<?php echo $Item['web']; ?>">
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