<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
    session_start();
    include "../../../../../config/class.Conexion.php";
    include( "../../../../../config/variable.php");
    include( "../../../../../config/funciones.php");
    include( "../../../../../config/funciones_seguridad.php");
    require_once '../../../../clases/radicar/class.RadicaEnviadoTempListarBandeja.php';
    require_once '../../../../clases/radicar/class.RadicaEnviadoTempQuienFirma.php';
    require_once "../../../../clases/radicar/class.RadicaEnviadoTempProyectores.php";
    require_once "../../../../clases/radicar/class.RadicaEnviadoTempResponsables.php";
    require_once "../../../../clases/general/class.GeneralFuncionario.php";

    $estado = session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
    if(!$estado){
        session_start();
    }

    $Accion     = 0 ;
    $TipoListar = $_REQUEST['tipo_listar'];
    $TipoVer    = $_REQUEST['tipo_ver'];

    ?>
    <div class="row-fluid dataTables_wrapper">
        <?php
        if($_SESSION['SesionFuncioResponPrinci'] == 1 or $_SESSION['SesionFuncioJefeDependencia'] == 1 or $_SESSION['SesionFuncioJefeOficina'] == 1){

            if($TipoListar == 'buscar'){
                if($_SESSION['SesionFuncioResponPrinci'] == 1 and $TipoVer == 'VerTodo'){
                    $Accion = 5;
                }elseif($TipoVer == 'VerMiCorrespondencia'){
                    $Accion = 6;
                }elseif($_SESSION['SesionFuncioJefeDependencia'] == 1 and $TipoVer == 'VerTodo'){
                    $Accion = 7;
                }elseif($_SESSION['SesionFuncioJefeOficina'] == 1 and $TipoVer === 'VerTodo'){
                    $Accion = 8;
                }
            }elseif($TipoListar == 'listar'){
                if($_SESSION['SesionFuncioResponPrinci'] == 1 and $TipoVer == 'VerTodo'){
                    $Accion = 1;
                }elseif($TipoVer == 'VerMiCorrespondencia'){
                    $Accion = 2;
                }elseif($_SESSION['SesionFuncioJefeDependencia'] == 1 and $TipoVer == 'VerTodo'){
                    $Accion = 3;
                }elseif($_SESSION['SesionFuncioJefeOficina'] == 1 and $TipoVer === 'VerTodo'){
                    $Accion = 4;
                }
            }
            ?>
            <h4 class=" inline">Ver </h4>
            <div class="btn-group m-l-10 m-b-10">
                <a href="#" data-toggle="dropdown" class="btn btn-white btn-mini dropdown-toggle">
                    <span class="caret single"></span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a id="TipoVer" data-tipo_ver="VerMiCorrespondencia" href="#">Mi correspondencia</a>
                    </li>
                    <li>
                        <a id="TipoVer" data-tipo_ver="VerTodo" href="#">Todo</a>
                    </li>
                </ul>
            </div>
            <?php
        }else{
            if($TipoListar == 'buscar'){
                $Accion = 26;
            }elseif($TipoListar == 'listar'){
                $Accion = 2;
            }
        }

        $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';

        if($action == 'ajax'){
            include 'pagination.php';
            //las variables de paginación
            $page          = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
            //la cantidad de registros que desea mostrar
            $per_page      = 50;
            //brecha entre páginas después de varios adyacentes
            $adjacents     = 4;
            $TotalPrimeros = 0;
            $TotalUltimos  = 0;
            $TotalPrimeros = ($page*$per_page)-$per_page;
            $TotalUltimos  = ($page*$per_page);
            $Mostrar       = $TotalPrimeros.' a '.$TotalUltimos;
            $offset        = ($page - 1) * $per_page;

            $Registro = new RadicadoEnviadoTempListarBandeja();
            $Registro->set_Accion($Accion);
            $Registro->set_IdFuncioDeta($_SESSION['SesionFuncioDetaId']);
            $Registro->set_IdDepen($_SESSION['SesionFuncioDepenId']);
            $Registro->set_IdOfi($_SESSION['SesionFuncioOfiId']);
            $Registro->set_Criterio1($offset);
            $Registro->set_Criterio2($per_page);
            $Registro->set_Criterio3($_REQUEST['criterio']);

            if($TipoListar == 'buscar'){
                $query_services = $Registro->Filtro();
                $NumrRows = $Registro->TotalRegistros_Filtro();
            }elseif($TipoListar == 'listar'){
                $query_services = $Registro->Listar();
                $NumrRows = $Registro->TotalRegistros_Listar();
            }

//echo "Accion: ".$Accion."<br>Total: ".$NumrRows."<br>Respon Princi: ".$_SESSION['SesionFuncioResponPrinci']." , Jefe Depen: ".$_SESSION['SesionFuncioJefeDependencia'].", Funcio deta: ".$_SESSION['SesionFuncioDetaId'];

            $total_pages = ceil($NumrRows/$per_page);
            $reload      = 'index.php';
            ?>
            <div class="row-fluid dataTables_wrapper">
                <div class="pull-right margin-top-20">
                    <div class="dataTables_paginate paging_bootstrap pagination">
                        <?php echo paginate($reload, $page, $total_pages, $adjacents); ?>
                    </div>
                    <div class="dataTables_info hidden-xs" id="example_info">
                        Mostrando <b><?php echo $Mostrar; ?> </b> de <?php echo $NumrRows; ?>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div id="email-list">
                <table class="table table-hover" id="emails">
                    <thead>
                        <div class="row form-row">
                            <div class="col-md-3"><strong>INFO. DEL RADICADO</strong></div>
                            <div class="col-md-3"><strong>QUIENES FIRMAN</strong></div>
                            <div class="col-md-3"><strong>RESPONSABLES</strong></div>
                            <div class="col-md-2"><strong>PROYECTORES</strong></div>
                            <div class="col-md-1"><strong></strong></div>
                        </div>
                    </thead>
                    <tbody>
                        <?php

                        if($NumrRows>0){

                            foreach($query_services as $item){

                                $Remitente = "";
                                if($item['razo_soci'] != ""){
                                    $Remitente = $item['razo_soci'];
                                }else{
                                    $Remitente = $item['nom_contac'];
                                }

                                ?>
                                <tr id="TRRadicado" data-id_radicado="<?php echo $item['id_temp']; ?>">
                                    <td class="small-cell v-align-middle">
                                        <div class="row">
                                            <div class="col-md-12 text-dark bg-info" style="background: <?php echo $BagroundColor; ?>">

                                                <span class="btn btn-info btn-xs btn-mini" style="margin-right:20px;font-size: 15px">
                                                    <strong><?php echo $item['id_temp']; ?></strong>
                                                </span>

                                                <?php
                                                if($item['radicado'] == 1){
                                                    ?>
                                                    <span class="btn btn-info btn-xs btn-mini" style="margin-right:20px;font-size: 15px">
                                                        <strong>Radicado</strong>
                                                    </span>
                                                    <?php
                                                }else{
                                                    ?>
                                                    <span class="btn btn-warning btn-xs btn-mini" style="margin-right:20px;font-size: 15px">
                                                        <strong>Pendiente por radicar</strong>
                                                    </span>
                                                    <?php
                                                }

                                                if($item['terminado'] == 0){
                                                    ?>
                                                    <span class="btn btn-warning btn-xs btn-mini" style="margin-right:20px;font-size: 15px">
                                                        <strong>Gestionando</strong>
                                                    </span>
                                                    <?php
                                                }
                                                ?>

                                                <strong class="<?php echo $ColorTextoTitulo; ?>">
                                                    <?php echo $Remitente; ?>
                                                </strong>
                                                <i class="fa fa-sign-in text-success" style="margin-right:10px; margin-left:10px;"></i>
                                                <strong>
                                                    <?php echo $item['nom_funcio']." ".$item['ape_funcio'].", Depen:.".$item['nom_depen']."->Ofi.:".$item['nom_oficina']; ?>
                                                </strong>
                                            </div>

                                            <hr style="border-width: 2px; height: 0px; border-style: dashed; border-color: default;"/>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <dl class="row">
                                                    <dt class="col-sm-2">Estado:</dt>
                                                    <br>
                                                    <dd class="col-sm-10">
                                                        <?php
                                                        $YoTengoElDocumento = false;
                                                        $PlantillaEnEdicionQuienFirma  = RadicadoEnviadoTempQuienFirma::Buscar(6, $item['id_temp'], "");
                                                        $PlantillaEnEdicionResponsable = RadicadoEnviadoTempResponsable::Buscar(6, $item['id_temp'], "");
                                                        $PlantillaEnEdicionProyector   = RadicadoEnviadoTempProyector::Buscar(6, $item['id_temp'], "");

                                                        if($PlantillaEnEdicionQuienFirma){

                                                            if($PlantillaEnEdicionQuienFirma->get_IdFuncio() == $_SESSION['SesionFuncioDetaId']){
                                                                echo "<p class='text-info semi-bold'>Tu tienes la plantilla en proceso de firma.</p>";
                                                                $YoTengoElDocumento = true;
                                                            }else{

                                                                $FuncionariosEditando = Funcionario::Buscar(2, $PlantillaEnEdicionQuienFirma->get_IdFuncio(), "", "", "", "", "", "");
                                                                if($FuncionariosEditando){
                                                                    echo "<p class='text-info semi-bold'>En proceso de firma por: <br>".$FuncionariosEditando->getNom_Funcio()."<br> ".$FuncionariosEditando->getApe_Funcio().".</p>";
                                                                }
                                                            }
                                                        }elseif($PlantillaEnEdicionResponsable){

                                                            if($PlantillaEnEdicionResponsable->get_IdFuncio() == $_SESSION['SesionFuncioDetaId']){
                                                                echo "<p class='text-info semi-bold'>Tu tienes la plantilla en proceso aprobación.</p>";
                                                                $YoTengoElDocumento = true;
                                                            }else{

                                                                $FuncionariosEditando = Funcionario::Buscar(2, $PlantillaEnEdicionResponsable->get_IdFuncio(), "", "", "", "", "", "");
                                                                if($FuncionariosEditando){
                                                                    echo "<p class='text-info semi-bold'>En aprobación por <br>".$FuncionariosEditando->getNom_Funcio()."<br> ".$FuncionariosEditando->getApe_Funcio().".</p>";
                                                                }
                                                            }
                                                        }elseif($PlantillaEnEdicionProyector){

                                                            if($PlantillaEnEdicionProyector->get_IdFuncio() == $_SESSION['SesionFuncioDetaId']){
                                                                echo "<p class='text-info semi-bold'>Tu tienes la plantilla en proceso proyección.</p>";
                                                                $YoTengoElDocumento = true;
                                                            }else{
                                                                $FuncionariosEditando = Funcionario::Buscar(2, $PlantillaEnEdicionProyector->get_IdFuncio(), "", "", "", "", "", "");
                                                                if($FuncionariosEditando){
                                                                    echo "<p class='text-info semi-bold'>En edición por <br>".$FuncionariosEditando->getNom_Funcio()."<br> ".$FuncionariosEditando->getApe_Funcio().".</p>";
                                                                }
                                                            }
                                                        }else{
                                                            echo "<p class='text-success semi-bold'>Disponible para gestionar.</p>";
                                                        }
                                                        ?>
                                                    </dd>

                                                    <dt class="col-sm-5">Fec. Hor. Creación:</dt>
                                                    <br>
                                                    <dd class="col-sm-7"><?php echo $item['fechor_registro']; ?></dd>

                                                    <br>

                                                    <dt class="col-sm-5">Usua. que   Crea:</dt>
                                                    <br>
                                                    <dd class="col-sm-9"><?php echo $item['nom_funcio']." ".$item['ape_funcio']; ?></dd>

                                                </dl>
                                            </div>

                                            <div class="col-md-3">
                                                <dl class="row">
                                                    <?php
                                                    $QuienesFirman = RadicadoEnviadoTempQuienFirma::Listar(1, $item['id_temp'], "");
                                                    foreach($QuienesFirman as $ItemQuienesFirman):
                                                        $Class = "";
                                                        $array = explode(" ", $ItemQuienesFirman['ape_funcio']);
                                                        $NomQuienesFirman = $ItemQuienesFirman['nom_funcio']." ".$array[0]."<br>".$ItemQuienesFirman['nom_depen']."<br>".$ItemQuienesFirman['nom_oficina'];

                                                        if($ItemQuienesFirman['firmado'] == 0){
                                                            $Class = "text-error semi-bold";
                                                        }
                                                        ?>

                                                        <dd class="col-sm-12">
                                                            <p class='<?php echo $Class; ?>'>
                                                                <?php
                                                                if($ItemQuienesFirman['firma_principal'] == 1){
                                                                    ?>
                                                                    <i class="fa fa-dot-circle-o text-primary"></i>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <?php echo $NomQuienesFirman; ?>
                                                            </p>
                                                        </dd>
                                                        <?php
                                                    endforeach;
                                                    ?>
                                                </dl>
                                            </div>

                                            <div class="col-md-3">
                                                <dl class="row">
                                                    <?php
                                                    $Responsables = RadicadoEnviadoTempResponsable::Listar(2, $item['id_temp'], "");
                                                    foreach($Responsables as $ItemResponsables):
                                                        $Class = "";
                                                        $array = explode(" ", $ItemResponsables['ape_funcio']);
                                                        $NomResponsable = $ItemResponsables['nom_funcio']." ".$array[0]."<br>".$ItemResponsables['nom_depen']."<br>".$ItemResponsables['nom_oficina'];

                                                        if($ItemResponsables['aprobado'] == 0){
                                                            $Class = "text-error semi-bold";
                                                        }
                                                        ?>
                                                        <dd class="col-sm-12">
                                                            <p class='<?php echo $Class; ?>'>
                                                                <?php
                                                                if($ItemResponsables['respon'] == 1){
                                                                    ?>
                                                                    <i class="fa fa-dot-circle-o text-primary"></i>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <?php echo $NomResponsable; ?>
                                                            </p>
                                                        </dd>
                                                        <?php
                                                    endforeach;
                                                    ?>
                                                </dl>
                                            </div>

                                            <div class="col-md-2">
                                                <dl class="row">
                                                    <?php
                                                    $Proyectores = RadicadoEnviadoTempProyector::Listar(1, $item['id_temp'], "", "", "", "", "", "");
                                                    foreach($Proyectores as $ItemProyectores):
                                                        $Class = "";
                                                        $array = explode(" ", $ItemProyectores['ape_funcio']);
                                                        $NomProyectores = $ItemProyectores['nom_funcio']." ".$array[0]."<br>".$ItemProyectores['nom_depen']."<br>".$ItemProyectores['nom_oficina'];

                                                        if($ItemProyectores['editando'] == 1){
                                                            $Class = "text-info semi-bold";
                                                        }elseif($ItemProyectores['terminado'] == 0){
                                                            $Class = "text-error semi-bold";
                                                        }
                                                        ?>
                                                        <dd class="col-sm-12">
                                                            <p class='<?php echo $Class; ?>'>
                                                                <?php echo $NomProyectores; ?>
                                                            </p>
                                                        </dd>
                                                        <?php
                                                    endforeach;
                                                    ?>
                                                </dl>
                                            </div>

                                            <div class="col-md-1">
                                                <dl class="row">
                                                    <!--
                                                    <button type="button" class="btn btn-success btn-xs btn-mini btn-circle" data-toggle="modal" data-target="#myModalMostrarInfoRadicadoRecibido" id="BtnMostarInfoRadicadoRecibido" data-id_radicado="<?php echo $item['id_radica']; ?>" title="Mostrar Info. radicado">
                                                        <i class="fa fa-info text-white"></i>
                                                    </button>
                                                    -->
                                                    <button type="button" class="btn btn-warning btn-xs btn-mini btn-circle" id="BtnListarNotas" data-id_temp='<?php echo $item['id_temp']; ?>'  data-toggle="modal" data-target="#myModalNotas" title="Notas">
                                                        <i class="fa fa-comments text-white"></i>
                                                    </button>

                                                    <?php

                                                    $PuedeDescargar = false;

                                                    $QuienFirma = RadicadoEnviadoTempQuienFirma::Buscar(7, $item['id_temp'], $_SESSION['SesionFuncioDetaId'], "", "", "", "", "");
                                                    $Responsable = RadicadoEnviadoTempResponsable::Buscar(7, $item['id_temp'], $_SESSION['SesionFuncioDetaId'], "", "", "", "", "");
                                                    $Proyector = RadicadoEnviadoTempProyector::Buscar(7, $item['id_temp'], $_SESSION['SesionFuncioDetaId'], "", "", "", "", "");

                                                    if($item['Pendiente'] == 'Por Firmar'){
                                                        $PuedeDescargar = true;
                                                        ?>
                                                        <button type="button" class="btn btn-info btn-xs btn-mini btn-circle" id="BtnDescargaPlantilla" data-id_temp='<?php echo $item['id_temp']; ?>' data-id_funcio_deta='<?php echo $item['id_funcio_deta']; ?>' data-id_depen='<?php echo $item['id_depen']; ?>' data-tipo_funcionario='QUIEN_FIRMA' data-plantillta_generada='<?php echo $item['genera_plantilla']; ?>' data-plantillta_cargada='<?php echo $item['plantilla_cargada']; ?>' data-plantillta_nombre='<?php echo $item['nom_archivo']; ?>' data-id_ruta='<?php echo $item['id_ruta']; ?>' title="Descargar plantilla">
                                                            <i class="fa fa-cloud-download text-white"></i>
                                                        </button>
                                                        <?php

                                                        if($YoTengoElDocumento === true){

                                                            ?>
                                                            <button type="button" class="btn btn-info btn-xs btn-mini btn-circle" id="BtnCargarPlantillaQuienFirma" data-id_temp='<?php echo $item['id_temp']; ?>' data-id_funcio_deta='<?php echo $item['id_funcio_deta']; ?>' data-id_depen='<?php echo $item['id_depen']; ?>' data-tipo_funcionario='QUIEN_FIRMA'data-estado_gestion="<?php echo $item['estado_gestion']; ?>" data-plantillta_generada='<?php echo $item['genera_plantilla']; ?>' data-plantillta_cargada='<?php echo $item['plantilla_cargada']; ?>' data-plantillta_nombre='<?php echo $item['nom_archivo']; ?>' data-id_ruta='<?php echo $item['id_ruta']; ?>' data-toggle="modal" data-target="#myModalSubirPlantilla" title="Subir plantilla">
                                                                <i class="fa fa-cloud-upload text-white"></i>
                                                            </button>
                                                            <?php
                                                        }

                                                        //$AprobadoTotal = RadicadoEnviadoTempResponsable::Buscar(8, $item['id_temp'], $_SESSION['SesionFuncioDetaId'], "", "", "", "", "");
                                                        ////if($QuienFirma->get_Firmado() == 0 and !$AprobadoTotal){
                                                        if($QuienFirma->get_Firmado() == 0){
                                                            ?>
                                                            <button type="button" class="btn btn-white btn-xs btn-mini btn-circle" id="BtnFirmar" data-id_temp='<?php echo $item['id_temp']; ?>' data-id_depen='<?php echo $item['id_depen']; ?>' data-id_funcio_deta='<?php echo $item['id_funcio_deta']; ?>' data-descargo_plantilla="<?php echo $item['descargo_plantilla']; ?>" data-subio_plantilla="<?php echo $item['subio_plantilla']; ?>" data-tipo_funcionario='QUIEN_FIRMA' data-plantillta_generada='<?php echo $item['genera_plantilla']; ?>' data-plantillta_cargada='<?php echo $item['plantilla_cargada']; ?>' data-plantillta_nombre='<?php echo $item['nom_archivo']; ?>' data-id_ruta='<?php echo $item['id_ruta']; ?>' title="Firmar el docuemto">
                                                                <i class="fa fa-pencil"></i>
                                                            </button>
                                                            <?php
                                                        }elseif($QuienFirma->get_Firmado() == 1){
                                                            ?>
                                                            <button type="button" class="btn btn-white btn-xs btn-mini btn-circle" id="BtnQuitarFirmar" data-id_temp='<?php echo $item['id_temp']; ?>' data-id_funcio_deta='<?php echo $item['id_funcio_deta']; ?>' title="Quitar firmar del docuemto">
                                                                <i class="fa fa-pencil text-primary"></i>
                                                            </button>
                                                            <?php
                                                        }

                                                    }elseif($item['Pendiente'] == 'Por Aprobar' and $PuedeDescargar == false){

                                                        ?>
                                                        <button type="button" class="btn btn-info btn-xs btn-mini btn-circle" id="BtnDescargaPlantilla" data-id_temp='<?php echo $item['id_temp']; ?>' data-id_funcio_deta='<?php echo $item['id_funcio_deta']; ?>' data-id_depen='<?php echo $item['id_depen']; ?>' data-plantillta_generada='<?php echo $item['genera_plantilla']; ?>' data-plantillta_cargada='<?php echo $item['plantilla_cargada']; ?>' data-plantillta_nombre='<?php echo $item['nom_archivo']; ?>' data-id_ruta='<?php echo $item['id_ruta']; ?>' data-tipo_funcionario="RESPONSABLE" title="Descargar plantilla">
                                                            <i class="fa fa-cloud-download text-white"></i>
                                                        </button>
                                                        <?php

                                                        if($YoTengoElDocumento === true){
                                                            ?>
                                                            <button type="button" class="btn btn-info btn-xs btn-mini btn-circle" id="BtnCargarPlantillaResponsable" data-id_temp='<?php echo $item['id_temp']; ?>' data-id_funcio_deta='<?php echo $item['id_funcio_deta']; ?>' data-id_depen='<?php echo $item['id_depen']; ?>' data-plantillta_generada='<?php echo $item['genera_plantilla']; ?>' data-plantillta_nombre='<?php echo $item['nom_archivo']; ?>' data-id_ruta='<?php echo $item['id_ruta']; ?>' data-toggle="modal" data-target="#myModalSubirPlantilla" data-tipo_funcionario="RESPONSABLE" data-estado_gestion="<?php echo $item['estado_gestion']; ?>" title="Subir plantilla">
                                                                <i class="fa fa-cloud-upload text-white"></i>
                                                            </button>
                                                            <?php
                                                        }
                                                        //$ResponsableAprobadoCompleto = RadicadoEnviadoTempResponsable::Buscar(8, $item['id_temp'], $_SESSION['SesionFuncioDetaId'], "", "", "", "", "");
                                                        ////if($Responsable->get_Aprobado() == 0 AND $ResponsableAprobadoCompleto){
                                                        if($Responsable->get_Aprobado() == 0){
                                                            ?>
                                                            <button type="button" class="btn btn-white btn-xs btn-mini btn-circle" id="BtnAprobar" data-id_temp='<?php echo $item['id_temp']; ?>' data-id_funcio_deta='<?php echo $item['id_funcio_deta']; ?>' data-descargo_plantilla="<?php echo $item['descargo_plantilla']; ?>" data-subio_plantilla="<?php echo $item['subio_plantilla']; ?>" title="Aprobar documento">
                                                                <i class="fa fa-thumbs-o-up"></i>
                                                            </button>
                                                            <?php
                                                        }elseif($Responsable->get_Aprobado() == 1){
                                                            ?>
                                                            <button type="button" class="btn btn-white btn-xs btn-mini btn-circle" id="BtnQuitarAprobar" data-id_temp='<?php echo $item['id_temp']; ?>' data-id_funcio_deta='<?php echo $item['id_funcio_deta']; ?>' title="Quitar aprobación">
                                                                <i class="fa fa-thumbs-o-down text-primary"></i>
                                                            </button>
                                                            <?php
                                                        }

                                                    }elseif($item['Pendiente'] == 'Por Proyectar' and $PuedeDescargar == false){
                                                        ?>
                                                        <button type="button" class="btn btn-info btn-xs btn-mini btn-circle" id="BtnDescargaPlantilla" data-id_temp='<?php echo $item['id_temp']; ?>' data-id_funcio_deta='<?php echo $item['id_funcio_deta']; ?>' data-id_depen='<?php echo $item['id_depen']; ?>' data-plantillta_generada='<?php echo $item['genera_plantilla']; ?>' data-plantillta_cargada='<?php echo $item['plantilla_cargada']; ?>' data-plantillta_nombre='<?php echo $item['nom_archivo']; ?>' data-id_ruta='<?php echo $item['id_ruta']; ?>' data-tipo_funcionario="PROYECTOR" title="Descargar plantilla">
                                                            <i class="fa fa-cloud-download text-white"></i>
                                                        </button>
                                                        <?php

                                                        if($YoTengoElDocumento === true){
                                                            ?>
                                                            <button type="button" class="btn btn-info btn-xs btn-mini btn-circle" id="BtnCargarPlantillaProyector" data-id_temp='<?php echo $item['id_temp']; ?>' data-id_funcio_deta='<?php echo $item['id_funcio_deta']; ?>' data-id_depen='<?php echo $item['id_depen']; ?>' data-plantillta_generada='<?php echo $item['genera_plantilla']; ?>' data-plantillta_nombre='<?php echo $item['nom_archivo']; ?>' data-id_ruta='<?php echo $item['id_ruta']; ?>' data-toggle="modal" data-target="#myModalSubirPlantilla" data-tipo_funcionario="PROYECTOR" data-estado_gestion="<?php echo $item['estado_gestion']; ?>" title="Subir plantilla">
                                                                <i class="fa fa-cloud-upload text-white"></i>
                                                            </button>
                                                            <?php
                                                        }

                                                        if($Proyector->get_Terminado() == 0){
                                                            ?>
                                                            <button type="button" class="btn btn-primary btn-xs btn-mini btn-circle" id="BtnProyectar" data-id_temp='<?php echo $item['id_temp']; ?>' data-id_funcio_deta='<?php echo $item['id_funcio_deta']; ?>' data-descargo_plantilla="<?php echo $item['descargo_plantilla']; ?>" data-subio_plantilla="<?php echo $item['subio_plantilla']; ?>" title="Terminar de proyectar">
                                                                <i class="fa fa-thumb-tack text-white"></i>
                                                            </button>
                                                            <?php
                                                        }else{
                                                            ?>
                                                            <button type="button" class="btn btn-primary btn-xs btn-mini btn-circle" id="BtnProyectar" data-id_temp='<?php echo $item['id_temp']; ?>' data-id_funcio_deta='<?php echo $item['id_funcio_deta']; ?>' title="Terminar de proyectar">
                                                                <i class="fa fa-thumb-tack text-white"></i>
                                                            </button>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                    <?php
                                                    //if($item['radicado'] == 0 and $item['terminado'] == 0){
                                                    if($item['radicado'] == 0){
                                                        ?>
                                                        <p role="presentation" class="divider"></p>
                                                        <button type="button" class="btn btn-danger btn-xs btn-mini btn-circle" id="BtnAnularTemp" data-id_temp='<?php echo $item['id_temp']; ?>' data-id_funcio_deta='<?php echo $item['id_funcio_deta']; ?>' title="Anular radicado temporal">
                                                            <i class="fa fa-times text-white"></i>
                                                        </button>
                                                        <?php
                                                    }
                                                    ?>
                                                </dl>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <dl class="row">
                                                    <dt class="col-sm-1">Asunto:</dt>
                                                    <dd class="col-sm-11"><?php echo $item['asunto']; ?></dd>
                                                </dl>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                        }else{
                            ?>
                            <div class="alert alert-warning alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h4>Aviso!!!</h4> No hay datos para mostrar
                            </div>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php
        }
        ?>
    </div>
    <?php
}
?>
