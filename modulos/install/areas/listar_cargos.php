<?php
require_once '../../../config/class.Conexion.php';
require_once '../../clases/areas/class.AreasCargo.php';
?>

<table class="table table-striped" id="tblCargos">
    <thead>
        <tr>
            <th>Dependencia</th>
            <th>Cargo</th>
            <th>Observaciones</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $Cargos = Cargo::Listar(1, 0, 0, "");
        foreach ($Cargos as $item):
        ?>
            <tr id="TrDatosCargos<?php echo $item['id_cargo']; ?>">
                <td><?php echo $item['nom_depen']; ?></td>
                <td><?php echo $item['nom_cargo']; ?></td>
                <td><?php echo $item['observa']; ?></td>
                <td>
                    <button type="button" class="btn btn-danger btn-circle btn-mini" id="BtnEliminarCargo" data-id_cargo="<?php echo $item['id_cargo']; ?>" data-nom_cargo="<?php echo $item['nom_cargo']; ?>">
                        <i class="glyphicon glyphicon-trash"></i>
                    </button>
                </td>
            </tr>
        <?php
        endforeach;
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Dependencia</th>
            <th>Cargo</th>
            <th>Observaciones</th>
            <th></th>
        </tr>
    </tfoot>
</table>