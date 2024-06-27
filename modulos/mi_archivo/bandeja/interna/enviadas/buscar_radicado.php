<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
    session_start();
    include "../../../../../config/class.Conexion.php";
    require_once '../../../../clases/radicar/class.RadicaInterno.php';
    require_once '../../../../clases/radicar/class.RadicaInternoAdjuntos.php';
    include( "../../../../../config/variable.php");
    include( "../../../../../config/funciones.php");
    $IdRadicadoInterno = $_POST['id_radica'];

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
                                echo "De: ".$ItemRadicado['nom_funcio_regis']." ".$ItemRadicado['ape_funcio_regis'];
                                ?>
                            </strong>
                            <br>
                            para
                            <?php //echo $ItemRadicado['destina_nom_funcio']." ".$ItemRadicado['destina_ape_funcio']; ?>
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
                                <?php echo $ItemRadicado['funregis_nom_funcio']." ".$ItemRadicado['funregis_ape_funcio']; ?>
                                <br>
                                <strong>para: </strong>
                                <?php echo $ItemRadicado['desti_nom_funcio']." ".$ItemRadicado['desti_ape_funcio']; ?>
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
        <br>
        <hr>
        <section class="wrapper cl">
            <?php
            if($ItemRadicado['adjunto'] = 1){
                $RutaAdjuntos = '../../archivos/server_archivos/interno/'.$_POST['id_radica'];
                if(is_dir($RutaAdjuntos)){
                    if($dir = opendir($RutaAdjuntos)){
                        while(($archivo = readdir($dir)) !== false){
                            if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess'){
                                ?>
                                <div class="pic">
                                    <?php
                                    $Extencion = end(explode(".", $archivo));
                                    if($Extencion == 'docx' or $Extencion == 'doc'){
                                        $Imagen = "../../public/assets/img/documentos/word.png";
                                    }elseif($Extencion == 'jpg' or $Extencion == 'jpeg' or $Extencion == 'gif' or $Extencion == 'bmp'){
                                        $Imagen = "../../public/assets/img/documentos/imagen.png";
                                    }
                                    ?>
                                    <img src="<?php echo $Imagen; ?>" class="pic-image" alt="Pic"/>
                                    <span class="pic-caption bottom-to-top">
                                        <h5><?php echo utf8_decode($archivo); ?></h5>
                                        <p>
                                            <a href="<?php echo $RutaAdjuntos.'file:///C|/xampp/htdocs/htdocs'.utf8_decode($archivo); ?>" class="btn btn-success btn-small" role="button"><i class="fa fa-cloud-download" ></i></a>
                                        </p>
                                    </span>
                                </div>
                                <?php
                            }
                        }
                        closedir($dir);
                    }
                }
            }
            ?>
        </section>
        <?php
    //DESPUES DE QUE CARGUE EL MENSsAJE LO MARCO COMO LEIDO
        $Radicado = new RadicadoInterno();
        $Radicado -> set_IdRadica($ItemRadicado['id_radica']);
    endforeach;

    $ArchivosAdjuntos = RadicadoInternoAdjuntos::Listar(1, $IdRadicadoInterno, "");
    foreach($ArchivosAdjuntos as $Item){
        $exp = explode(".", $Item['archivo']);
        $extension = end($exp);

        if($extension === "pdf"){
            $imagen = "../../../../public/assets/img/documentos/Pdf_icono.jpg";
        }elseif($extension === "doc" or $extension === 'docx'){
            $imagen = "../../../../public/assets/img/documentos/word.png";
        }elseif($extension === "xls" or $extension === 'xlsx'){
            $imagen = "../../../../public/assets/img/documentos/excel.png";
        }elseif($extension === "pptx" or $extension === 'ppt'){
            $imagen = "../../../../public/assets/img/documentos/power_point.png";
        }elseif($extension === "txt" or $extension === 'ppt'){
            $imagen = "../../../../public/assets/img/documentos/txt.png";
        }elseif($extension === "png" or $extension === 'gif' or $extension === 'jpeg' or $extension === 'jpg'){
            $imagen = "../../../../public/assets/img/documentos/imagen.png";
        }
        ?>
        <div class="element">
            <a href="">
                <div class="img">
                    <img src="<?php echo $imagen; ?>" />
                </div>
                <div class="description">
                    <p><?php echo $Item['archivo']; ?></p>
                    <a href="#" id="BtnDescargarAdjunto" class="descargar_pdf" data-id_radicado="<?php echo $ItemRadicado['id_radica']; ?>" data-id_ruta="<?php echo $ItemRadicado['id_ruta']; ?>"  data-archivo="<?php echo $Item['archivo']; ?>" data-id_funcio="<?php echo $_SESSION['SesionFuncioDepenId']; ?>">
                        <img src="../../../../../public/assets/img/pdf.png" width="30" height="36" title="Descargar archivo">
                    </a>
                </div>
                <p><?php echo $Item['archivo']; ?></p>
            </a>
        </div>
        <?php
    }
}
?>