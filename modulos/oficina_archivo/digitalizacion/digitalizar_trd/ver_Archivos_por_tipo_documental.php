<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){

    include "../../../../config/class.Conexion.php";
    require_once '../../../clases/oficina_archivo/class.OficinaArchivoDigitalizacionTRDArchivos.php';
    require_once '../../../clases/oficina_archivo/class.OficinaArchivoDigitalizacionTRDTomo.php';

    $IdDigital       = isset($_POST['id_digital']) ? $_POST['id_digital'] : null;
    $IdTipoDocumento = isset($_POST['id_tipodoc']) ? $_POST['id_tipodoc'] : null;
    $IdTomo          = isset($_POST['id_tomo_ver_tipo_documento']) ? $_POST['id_tomo_ver_tipo_documento'] : null;
    $VerTipo         = isset($_POST['ver_tipo']) ? $_POST['ver_tipo'] : null;
    
    if($VerTipo == 0){
        $Artchivos = DigitalizacionTRDArchivos::Listar(5, 0, $IdDigital, $IdTomo, "", "");
    }else{
        $Artchivos = DigitalizacionTRDArchivos::Listar(3, 0, $IdDigital, $IdTomo, "", $IdTipoDocumento);
    }
    ?>
    <div class="row form-row" style="height:450px; overflow-y: scroll;">
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
    </div>
    <?php
}
?>