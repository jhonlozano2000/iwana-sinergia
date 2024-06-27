<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){

    include "../../../../config/class.Conexion.php";
    require_once '../../../clases/oficina_archivo/class.OficinaArchivoDigitalizacionTRDArchivos.php';

    $IdDigital        = isset($_POST['id_digital']) ? $_POST['id_digital'] : null;
    $IdTomoComoUnTodo = isset($_POST['id_tomo_ver_archivos_ComoUnTodo']) ? $_POST['id_tomo_ver_archivos_ComoUnTodo'] : null;

    $Artchivos = DigitalizacionTRDArchivos::Listar(4, 0, $IdDigital, $IdTomoComoUnTodo, "", "");
    
    ?>
    <table width="100%" class="table table-bordered no-more-tables">
        <thead>
            <tr>
                <th class="text-center" style="width:95%">Archivos</th>
                <th class="text-center" style="width:5%"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($Artchivos as $Item):
                ?>
                <tr>
                    <td><?php echo $Item['archivo']; ?></td>
                    <td>
                        <button type="button" class="btn btn-success btn-mini" id="BtnDescargaArchivo" title="Descargar archivo" data-id_digital="<?php echo $IdDigital; ?>" data-id_archivo="<?php echo $Item['id_archivo']; ?>" data-id_ruta="<?php echo $Item['id_ruta']; ?>" data-archivo="<?php echo $Item['archivo']; ?>" data-id_tomo="<?php echo $Item['id_tomo']; ?>">
                            <i class="fa fa-cloud-download"></i>
                        </button>
                    </td>
                </tr>
                <?php
            endforeach;
            ?>
        </tbody>
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
