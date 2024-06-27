<?php
session_start();
include "../../../config/class.Conexion.php";
require_once '../../clases/radicar/class.RadicaInterno.php';
require_once '../../clases/radicar/class.RadicaInternoDestinatario.php';
require_once '../../clases/radicar/class.RadicaInternoAdjuntos.php';
include( "../../../config/variable.php");
include( "../../../config/funciones.php");
$IdRadicadoInterno = $_POST['id_radica'];
?>
<div class="row">
    <?php
    $Radicado = RadicadoInterno::Listar_Varios(1, $IdRadicadoInterno, "", "", "", "", "", "");
    foreach($Radicado as $ItemRadicado):
        ?>
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#collapse1">
                            <strong>
                                <?php
                                echo "De: ".$ItemRadicado['nom_funcio_respon']." ".$ItemRadicado['ape_funcio_respon'];
                                ?>
                            </strong>
                            <br>
                            Para: 
                            <?php
                            $Destinatarios = "";
                            $Destinatario = RadicadoInternoDestinatario::Listar(1, $IdRadicadoInterno, "");
                            foreach($Destinatario as $Item){
                                $Destinatarios.=$Item['nom_funcio']." ".$Item['ape_funcio'].", ";
                            }

                            echo $Destinatarios;
                            ?>
                        </a>
                    </h4>
                </div>
                <div class="col-md-12 panel-collapse collapse" id="collapse1">
                    <div class="grid simple vertical green">
                        <div class="grid-title no-border">
                        </div>
                        <div class="column-seperation grid-body no-border">
                            <div class="col-md-6">
                                <h4><span class="semi-bold text-info"><i class="fa fa-info"></i> General</span></h4>
                                <h4><span class="semi-bold">Radicado: <?php echo $ItemRadicado['id_radica']; ?></span></h4>
                                <strong>de: </strong>
                                <?php echo $ItemRadicado['nom_funcio_respon']." ".$ItemRadicado['ape_funcio_respon']; ?>
                                <br>
                                <strong>para: </strong>
                                <?php echo $Destinatarios; ?>
                                <br>
                                <strong>asunto: </strong>
                                <?php echo $ItemRadicado['asunto']; ?>
                                <br>
                                <strong>requiere respuesta: </strong>
                                <?php if($ItemRadicado['fec_venci'] == ""){ echo "No"; }else{ echo "Si"; }; ?>
                            </div>
                            <div class="col-md-3">
                                <h4 class="semi-bold text-info"><i class="fa fa-folder-open-o"></i> Clasificación</h4>
                                <strong>serie: </strong>
                                <?php echo $ItemRadicado['nom_serie']; ?>
                                <br>
                                <strong>sub serie: </strong>
                                <?php echo $ItemRadicado['nom_subserie']; ?>
                                <br>
                                <strong>sub serie: </strong>
                                <?php echo $ItemRadicado['nom_tipodoc']; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid-body no-border">
            <div class="row-fluid ">
                <?php echo nl2br($ItemRadicado['texto']); ?>
            </div>
        </div>
        <hr>
        <?php
        //DESPUES DE QUE CARGUE EL MENSsAJE LO MARCO COMO LEIDO
        $Radicado = new RadicadoInterno();
        $Radicado -> set_IdRadica($ItemRadicado['id_radica']);
    endforeach;
    ?>
</div>
<div class="row">
    <?php
    $ArchivosAdjuntos = RadicadoInternoAdjuntos::Listar(1, $IdRadicadoInterno, "");
    foreach($ArchivosAdjuntos as $Item){
        ?>
        <button type="button" class="btn btn-success btn-sm btn-small" id="BtnDescargarArchivoInterno"
        data-id_radicado="<?php echo $Item['id_radica']; ?>"
        data-id_ruta="<?php echo $Item['id_ruta']; ?>"
        data-archivo="<?php echo $Item['nom_archivo']; ?>"
        data-id_funcio="<?php echo $_SESSION['SesionFuncioDetaId']; ?>">
        <i class="fa fa-cloud-download"></i> <?php echo $Item['nom_archivo']; ?>
    </button>
    <?php
}
?>
</div>