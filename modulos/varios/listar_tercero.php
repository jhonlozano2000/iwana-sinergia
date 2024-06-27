<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

    include "../../config/class.Conexion.php";
    require_once '../clases/general/class.GeneralTercero.php';

    $Tercero = Tercero::Listar(12, 0, 0, "", "", "", $_POST['criterio']);
    if (count($Tercero) == 0) {
        echo 1;
        exit();
    } else {
?>

        <table class="table table-striped" id="example1">
            <thead>
                <tr>
                    <th></th>
                    <th style="width: 30%">Entidad</th>
                    <th style="width: 30%">Contacto</th>
                    <th style="width: 20%">Direccion</th>
                    <th style="width: 20%">Telefonos</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($Tercero as $Item) :
                    if ($Item['id_empre'] != "") {
                ?>
                        <tr>
                            <td><span class="btn btn-info btn-circle">J</span></td>
                            <td><?php echo $Item['razo_soci'] . "<br>Dirección: " . $Item['nom_depar_empre'] . " - " . $Item['nom_muni_empre'] . ", " . $Item['dir_empre'] . "<br>Teléfono: " . $Item['tel_empre'] . " Cel: " . $Item['cel_empre']; ?></td>
                            <td><?php echo "# Documento: " . $Item['num_docu'] . "<br>" . $Item['nom_contac'] . "<br>Cargo: " . $Item['cargo'] . "<br>Dirección: " . $Item['nom_depar_contac'] . " - " . $Item['nom_muni_contac'] . ", " . $Item['dir_contac'] . "<br>Teléfono: " . $Item['tel_contac']; ?></td>
                            <td><?php echo ""; ?></td>
                            <td><?php echo ""; ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $Item['id_tercero']; ?>" class="btn btn-warning btn-circle">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </a>
                            </td>
                        </tr>
                    <?php
                    } else {
                    ?>
                        <tr>
                            <td><span class="btn btn-success btn-circle">N</span></td>
                            <td></td>
                            <td><?php echo "# Documento: " . $Item['num_docu'] . "<br>" . $Item['nom_contac'] ?></td>
                            <td><?php echo $Item['nom_depar_contac'] . " - " . $Item['nom_muni_contac'] . ", " . $Item['dir_contac']; ?></td>
                            <td><?php echo "Teléfono: " . $Item['tel_contac'] . "<br>Celular: " . $Item['cel_contac']; ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $Item['id_tercero']; ?>" class="btn btn-warning btn-circle">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </a>
                            </td>
                        </tr>
                <?php
                    }
                endforeach;
                ?>
            </tbody>
        </table>
<?php
    }
}
?>

<!-- BEGIN CORE JS FRAMEWORK-->
<script src="../../public/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="../../public/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
<script src="../../public/assets/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../../public/assets/plugins/breakpoints.js" type="text/javascript"></script>
<script src="../../public/assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
<!-- END CORE JS FRAMEWORK -->
<!-- BEGIN PAGE LEVEL JS -->
<script src="../../public/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
<script src="../../public/assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script>
<script src="../../public/assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
<script src="../../public/assets/plugins/bootstrap-select2/select2.min.js" type="text/javascript"></script>
<script src="../../public/assets/plugins/jquery-datatable/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="../../public/assets/plugins/jquery-datatable/extra/js/dataTables.tableTools.min.js" type="text/javascript"></script>
<script type="text/javascript" src="../../public/assets/plugins/datatables-responsive/js/datatables.responsive.js"></script>
<script type="text/javascript" src="../../public/assets/plugins/datatables-responsive/js/lodash.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="../../public/assets/js/datatables.js" type="text/javascript"></script>
<!-- END JAVASCRIPTS -->