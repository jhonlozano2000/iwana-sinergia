<?php
session_start();
include "../../../../../config/class.Conexion.php";
require_once '../../../../clases/radicar/class.RadicaEnviadoTempNota.php';

$TempNotas = RadicadoEnviadoTempNota::Listar(1, $_REQUEST['IdTemp'], "");

?>
<div id="notification-list">
    <?php
    foreach($TempNotas as $Item):
        if($Item['id_funcio_deta'] == $_SESSION['SesionFuncioDetaId']){
            ?>
            <div class="notification-messages danger">
                <div class="iconholder">
                    <i class="icon-warning-sign"></i>
                </div>
                <div class="message-wrapper">
                    <div class="heading"> Yo </div>
                    <div style="width: 100%"> <?php echo $Item['nota']; ?> </div>
                    <div class="date pull-left"> <?php echo $Item['fechor_nota']; ?> </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <?php
        }else{
            ?>
            <div class="notification-messages success">
                <div class="user-profile">
                    <img src="assets/img/profiles/h.jpg"  alt="" data-src="assets/img/profiles/h.jpg" data-src-retina="assets/img/profiles/h2x.jpg" width="35" height="35">
                </div>
                <div class="message-wrapper">
                    <div class="heading"> <?php echo $Item['nom_funcio']." ".$Item['ape_funcio']; ?> </div>
                    <div> <?php echo $Item['nota']; ?> </div>
                    <div class="date pull-left"> <?php echo $Item['fechor_nota']; ?> </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <?php
        }
    endforeach;
    ?>
</div>