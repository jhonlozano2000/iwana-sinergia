<?php
session_start();
require_once '../../../config/variable.php';
require_once '../../../config/funciones_seguridad.php';
require_once '../../../config/class.Conexion.php';
require_once "../../clases/configuracion/class.ConfigOtras_Respon_HC.php";
?>
<table class="table table-hover table-condensed" id="Tbl1">
    <thead>
        <tr>
            <th style="width:60%">Clasificación</th>
            <th style="width:39%">Funcionario</th>
            <th style="width:1%"></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $Responsables = ConfigOtrasResponsablePQRSF::Listar(1, "");
        foreach ($Responsables as $Item) :
        ?>
            <tr>
                <td class="v-align-middle">
                    <span class="muted">
                        <?php
                        echo "Depen.:" . $Item['nom_depen'] . "<br>Serie:" . $Item['nom_serie'] . "<br>SubSerie:" . $Item['nom_subserie'] . "<br>Documento:" . $Item['nom_tipodoc'];
                        ?>
                    </span>
                </td>
                <td class="v-align-middle">
                    <span class="muted">
                        <?php
                        echo $Item['nom_funcio'] . " " . $Item['ape_funcio'];
                        ?>
                    </span>
                </td>
                <td>
                    <button class="borrar btn btn-danger btn-xs btn-mini" data-id_funcio_deta="<?php echo $Item['id_funcio_deta']; ?>" id="BtnEliminarResponsablePQRSF"><i class="fa fa-trash-o"></i>
                    </button>
                </td>
            </tr>
        <?php
        endforeach;
        ?>
    </tbody>
</table>