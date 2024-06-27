<?php
include "../../../config/class.Conexion.php";
require_once '../../clases/radicar/class.RadicaRecibido.php';

$RadicadoEntradaConRespuesta = RadicadoRecibido::Listar_Vario(5, "","", "", 0, 0, $_POST['criterio'], "", "");
?>
<table class="table table-hover table-condensed" id="Tbl4">
    <thead>
        <tr>
            <th style="width:1%"></th>
            <th style="width:20%">Radicado</th>
            <th style="width:20%">Asunto</th>
            <th style="width:20%">Remitente</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($RadicadoEntradaConRespuesta as $Item):
            $Remitente = "";
            if($Item['razo_soci'] != ""){
                $Remitente = "Empre.: ".$Item['razo_soci']."<br>Contacto: ".$Item['nom_contac']."<br>Contacto: ".$Item['cargo'];
            }else{
                $Remitente = $Item['nom_contac'];
            }
            ?>
            <tr>
                <td class="v-align-middle">
                    <button type="button" id="BtnLlevarRadicadoParaRespuesta" name="BtnLlevarRadicadoParaRespuesta" class="btn btn-block btn-success btn-xs btn-mini" 
                    data-id_radica="<?php echo $Item['id_radica']; ?>"
                    data-asunto="<?php echo substr($Item['asunto'], 0, 40); ?>"
                    data-remitente="<?php echo $Item['razo_soci']; ?>">
                    <i class="fa fa-check"></i>
                </button>
            </td>
            <td class="v-align-middle"><?php echo $Item['id_radica']; ?></td>
            <td class="v-align-middle"><?php echo trim($Item['asunto']); ?></td>
            <td class="v-align-middle"><?php echo trim($Remitente); ?></td>
        </tr>
        <?php
    endforeach;
    ?>
</tbody>
</table>