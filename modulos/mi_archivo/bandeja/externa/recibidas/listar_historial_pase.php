 <?php
 session_start();
 include "../../../../../config/class.Conexion.php";
 require_once '../../../../clases/radicar/class.RadicaRecibidoPase.php';
 ?>
 <table class="table table-hover table-condensed" id="Tbl1">
    <thead>
        <tr>
            <th>Fec. Hor Registro</th>
            <th style="width: 20%">Funcionario Origen</th>
            <th style="width: 20%">Depdendencia Origen</th>
            <th>Fec. Hor Registro</th>
            <th style="width: 20%">Funcionario Destino</th>
            <th style="width: 20%">Depdendencia Destino</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $RadicadoTemp = RadicadoRecibidoPase::Listar(1, "", $_REQUEST['id_radicado'], "", "");
        foreach($RadicadoTemp as $Item):
            ?>
            <tr>
                <td class="v-align-middle success"><span class="muted"><?php echo $Item['fechor_pase']; ?></span></td>
                <td class="success"><?php echo $Item['nom_funcio_origen']." ".$Item['ape_funcio_origen']; ?></td>
                <td class="success"><?php echo $Item['nom_depen_origen']." / ".$Item['nom_oficina_origen']; ?></td>
                <td class="v-align-middle info"><span class="muted"><?php echo $Item['fehor_acepta']; ?></span></td>
                <td class="info"><?php echo $Item['nom_funcio_desti']." ".$Item['ape_funcio_desti']; ?></td>
                <td class="info"><?php echo $Item['nom_depen_desti']." / ".$Item['nom_oficina_desti']; ?></td>
            </tr>
            <?php
        endforeach;
        ?>
    </tbody>
</table>