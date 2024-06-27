<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){

    include "../../../../config/class.Conexion.php";
    require_once '../../../clases/retencion/calss.TRD.php';
    require_once '../../../clases/oficina_archivo/class.OficinaArchivoDigitalizacion.php';
    require_once '../../../clases/oficina_archivo/class.OficinaArchivoDigitalizacionArchivos.php';

    $id_depen     = $_REQUEST["id_depen"];
    $id_serie     = $_REQUEST["id_serie"];
    $id_sub_serie = $_REQUEST["id_sub_serie"];

    $IdDigital  = isset($_POST['id_digital']) ? $_POST['id_digital'] : null;
echo $id_depen, $id_serie, $id_sub_serie;
exit();
    $TRD = TRD::Listar(7, 0, $id_depen, $id_serie, $id_sub_serie, "");
    ?>
    <div class="tab-pane" id="tabComoUnTodoVerExpediente">
        <div class="row">
            <div class="col-md-4">
                <table width="100%" class="table table-bordered no-more-tables">
                    <thead>
                        <tr>
                            <th class="text-center" style="width:20%">Tipos Documentales</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($TRD as $Item):
                            ?>
                            <tr>
                                <td>
                                    <?php echo $Item['nom_tipodoc']; ?>
                                </td>
                            </tr>
                            <?php
                        endforeach;
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-center">Tipos Documentales</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="col-md-8">
                <div id="DivListarArchivos"></div>
            </div>
        </div>
    </div>
    <?php
}
?>