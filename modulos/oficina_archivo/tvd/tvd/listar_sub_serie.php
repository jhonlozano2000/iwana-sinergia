<?php
require_once '../../../../config/class.Conexion.php';
require_once '../../../clases/oficina_archivo/tvd/class.TVDSubSerie.php';

$SubSerie = SubSerieTVD::Buscar(1, $_REQUEST['id'], "", "", "");
?>
<table class="table table-bordered no-more-tables" id="TiposDocumentales">
    <thead>
        <tr>
            <th style="width:1%">Acti.</th>
            <th class="text-center" style="width:90%">Tipo Documental</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $Documentos = SubSerieTVD::Listar(6, $_REQUEST['id'], "", "", "", "");
        foreach ($Documentos as $Item):

            if($Item['acti'] == 1){
                $checkedDocumento = "checked";
            }else{
                $checkedDocumento = "";
            }

            ?>
            <tr id="TrTipoDocumento<?php echo $Item['id_tipodoc']; ?>">
                <td>
                    <div class="checkbox check-default">
                        <input name="ChkTipoDoc[]" id="ChkTipoDoc<?php echo $Item['id_tipodoc']; ?>" type="checkbox" value="<?php echo $Item['id_tipodoc']; ?>" <?php echo $checkedDocumento; ?>>
                        <label for="ChkTipoDoc<?php echo $Item['id_tipodoc']; ?>"></label>
                    </div>
                </td>
                <td><?php echo $Item['nom_tipodoc']; ?></td>
                <td></td>
            </tr>
            <?php
        endforeach;
        ?>
    </tbody>
</table>
