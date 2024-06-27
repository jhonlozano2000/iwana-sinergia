<!-- BEGIN PLUGIN CSS -->
<?php 
require_once '../../config/variable.php';
?>
<link href="<?php echo MI_ROOT; ?>/public/assets/css/botones_redondos.css" rel="stylesheet" type="text/css"/>
<!-- END PLUGIN CSS -->
<?php
if (! empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
    include "../../config/class.Conexion.php";
    require_once '../clases/general/class.GeneralTercero.php';

    $Tercero = Tercero::Listar(12, 0, 0, "", "", "", $_POST['criterio']);
    if(count($Tercero) == 0){
        echo 1;
        exit();
    }else{
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
                foreach($Tercero as $Item):
                    if($Item['id_empre'] != ""){
                    ?>
                    <tr>
                        <td><span class="btn btn-info btn-circle">J</span></td>
                        <td><?php echo $Item['razo_soci']."<br>Dirección: ".$Item['nom_depar_empre']." - ".$Item['nom_muni_empre'].", ".$Item['dir_empre']."<br>Teléfono: ".$Item['tel_empre']." Cel: ".$Item['cel_empre']; ?></td>
                        <td><?php echo "# Documento: ".$Item['num_docu']."<br>".$Item['nom_contac']."<br>Cargo: ".$Item['cargo']."<br>Dirección: ".$Item['nom_depar_contac']." - ".$Item['nom_muni_contac'].", ".$Item['dir_contac']."<br>Teléfono: ".$Item['tel_contac']; ?></td>
                        <td><?php echo ""; ?></td>
                        <td><?php echo ""; ?></td>
                        <td>
                            <button type="button" id="BtnLlevarTercero" class="btn btn-info btn-sm btn-small"
                            data-id_tercero="<?php echo $Item['id_tercero']; ?>"
                            data-id_empre="<?php echo $Item['id_empre']; ?>"
                            data-num_docu="<?php echo $Item['num_docu']; ?>"
                            data-razo_soci="<?php echo $Item['razo_soci']; ?>"
                            data-nom_contac="<?php echo $Item['nom_contac']; ?>"
                            data-dir="<?php echo $Item['dir_empre']; ?>"
                            data-tel="<?php echo $Item['tel_empre']; ?>"
                            data-cel="<?php echo $Item['cel_empre']; ?>"
                            data-email="<?php echo $Item['email_empre']; ?>">
                                <i class="fa fa-check"></i>
                            </button>
                        </td>
                    </tr>
                    <?php
                }else{
                    ?>
                    <tr>
                        <td><span class="btn btn-primary btn-circle">N</span></td>
                        <td></td>
                        <td><?php echo "# Documento: ".$Item['num_docu']."<br>".$Item['nom_contac'] ?></td>
                        <td><?php echo $Item['nom_depar_contac']." - ".$Item['nom_muni_contac'].", ".$Item['dir_contac']; ?></td>
                        <td><?php echo "Teléfono: ".$Item['tel_contac']."<br>Celular: ".$Item['cel_contac']; ?></td>
                        <td>
                            <button type="button" id="BtnLlevarTercero" class="btn btn-success btn-sm btn-small"
                            data-id_tercero="<?php echo $Item['id_tercero']; ?>"
                            data-id_empre="<?php echo $Item['num_docu']; ?>"
                            data-num_docu="<?php echo $Item['num_docu']; ?>"
                            data-nom_contac="<?php echo $Item['nom_contac']; ?>"
                            data-dir="<?php echo $Item['dir_contac']; ?>"
                            data-tel="<?php echo $Item['tel_contac']; ?>"
                            data-cel="<?php echo $Item['cel_contac']; ?>"
                            data-email="<?php echo $Item['email_contac']; ?>">
                                <i class="fa fa-check"></i>
                            </button>
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