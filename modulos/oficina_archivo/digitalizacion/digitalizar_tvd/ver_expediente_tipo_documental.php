<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){

    include "../../../../config/class.Conexion.php";
    require_once '../../../clases/retencion/calss.TRD.php';
    require_once '../../../clases/oficina_archivo/tvd/calss.TVD.php';

    $id_depen     = $_REQUEST["id_depen"];
    $id_serie     = $_REQUEST["id_serie"];
    $id_sub_serie = $_REQUEST["id_sub_serie"];

    $TRD = TVD::Listar(7, 0, $id_depen, $id_serie, $id_sub_serie, "");
    ?>
    <table width="100%" class="table table-bordered no-more-tables">
        <thead>
            <tr>
                <th class="text-center" style="width:20%">Tipos Documentales</th>
            </tr>
        </thead>
        <tbody>
            <tr id="BtnVerArchivos" data-ver_tipo="0">
                <td class="text-info">Ver todos los archivos digitales</td>
            </tr>
            <?php
            foreach($TRD as $Item):
                ?>
                <tr id="BtnVerArchivos" data-ver_tipo="1" data-id_tipodoc="<?php echo $Item['id_tipodoc']; ?>">
                    <td><?php echo $Item['nom_tipodoc']; ?></td>
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
    <?php
}
?>
<script src="../../../../public/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script> 
<script src="../../../../public/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script> 
<script src="../../../../public/assets/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script> 
<script src="../../../../public/assets/plugins/breakpoints.js" type="text/javascript"></script> 
<script src="../../../../public/assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script> 
<script src="../../../../public/assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script> 
<!-- END CORE JS FRAMEWORK --> 
<!-- BEGIN PAGE LEVEL JS --> 
<script src="../../../../public/assets/plugins/pace/pace.min.js" type="text/javascript"></script> 
<script src="../../../../public/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script> 
<script src="../../../../public/assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script> 
<!-- END PAGE LEVEL PLUGINS --> 
<!-- PAGE JS --> 
<script src="../../../../public/assets/js/tabs_accordian.js" type="text/javascript"></script>
