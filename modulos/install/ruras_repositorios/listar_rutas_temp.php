<?php
require_once '../../../config/class.Conexion.php';
require_once '../../clases/areas/class.AreasDependencia.php';
?>

<table class="table table-striped" id="tblDependencias">
    <thead>
        <tr>
            <th>Cod. Depen.</th>
            <th>Cod. Corres.</th>
            <th>Dependencia</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $Dependencias = Dependencia::Listar(1, "", "", "", "");;
        foreach ($Dependencias as $item):
        ?>
            <tr id="TrDatosDependencia<?php echo $item['id_depen']; ?>">
                <td><?php echo substr($item['cod_depen'], 0, 200); ?></td>
                <td><?php echo substr($item['cod_corres'], 0, 200); ?></td>
                <td><?php echo $item['nom_depen']; ?></td>
                <td>
                    <button type="button" class="btn btn-danger btn-circle btn-mini" id="BtnEliminarDependencia" data-id_dependencia="<?php echo $item['id_depen']; ?>" data-nom_dependencia="<?php echo $item['nom_depen']; ?>">
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
            <th>Cod. Depen.</th>
            <th>Cod. Corres.</th>
            <th>Dependencia</th>
            <th></th>
        </tr>
    </tfoot>
</table>