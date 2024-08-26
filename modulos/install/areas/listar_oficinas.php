<?php
require_once '../../../config/class.Conexion.php';
require_once '../../clases/areas/class.AreasOficina.php';
?>

<table class="table table-striped" id="tblOficinas">
    <thead>
        <tr>
            <th>Dependencia.</th>
            <th>Cod. Oficina.</th>
            <th>Cod. Corres.</th>
            <th>Oficina</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $Oficinas = Oficina::Listar(1, 0, 0, "", "", "");
        foreach ($Oficinas as $item):
        ?>
            <tr id="TrDatosOficina<?php echo $item['id_oficina']; ?>">
                <td><?php echo $item['nom_depen']; ?></td>
                <td><?php echo $item['cod_oficina']; ?></td>
                <td><?php echo $item['cod_corres']; ?></td>
                <td><?php echo $item['nom_oficina']; ?></td>
                <td>
                    <button type="button" class="btn btn-danger btn-circle btn-mini" id="BtnEliminarOficina" data-id_oficina="<?php echo $item['id_oficina']; ?>" data-nom_oficina="<?php echo $item['nom_oficina']; ?>">
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
            <th>Dependencia.</th>
            <th>Cod. Oficina.</th>
            <th>Cod. Corres.</th>
            <th>Oficina</th>
            <th></th>
        </tr>
    </tfoot>
</table>