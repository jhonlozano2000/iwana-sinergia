<div id="inner-menu">
    <div class="inner-wrapper">
        <a href="radicar.php" class="btn btn-block btn-primary">
            <span class="bold">RADICAR</span>
        </a>
    </div>
    <div class="inner-menu-content">
        <p class="menu-title">VISTA RAPIDA <span class="pull-right"><i class="icon-refresh"></i></span></p>
    </div>
    <ul class="small-items">
        <?php
        $permiso = Permiso::Buscar(2, $_SESSION['SesionUsuaId'], "", "", "", "Men_Venta_Unica_Radica");
        if ($permiso) {
        ?>
            <li class="active">
                <a href="<?php echo MI_ROOT; ?>/modulos/ventanilla/recibida/recibidas/index.php"> Ir a la correspondencia recibida</a>
            </li>
            <li class="active">
                <a href="<?php echo MI_ROOT; ?>/modulos/ventanilla/enviada/enviadas/index.php"> Ir a la correspondencia enviada</a>
            </li>
            <li class="active">
                <a href="<?php echo MI_ROOT; ?>/modulos/ventanilla/interna/interna/index.php"> Ir a la correspondencia interna</a>
            </li>
        <?php
        }

        $permiso = Permiso::Buscar(2, $_SESSION['SesionUsuaId'], "", "", "", "Men_Venta_Unica_Radica_PQRSF");
        if ($permiso) {
        ?>

            <li class="active">
                <a href="<?php echo MI_ROOT; ?>/modulos/ventanilla/pqrsf/recibidas/index.php"> Ir a PQRSF</a>
            </li>
        <?php
        }
        ?>
    </ul>
    <ul class="big-items">
        <li class="">
            <a href="<?php echo MI_ROOT; ?>/modulos/ventanilla/enviada/pendientes_rotulo_digital/index.php">
                <span class="btn btn-danger btn-sm btn-small label label-important">
                    <i class="fa fa-bullhorn"></i> Pendientes por <br>Rotulo/Archivo Digital
                </span>
            </a>
        </li>
        <li class="">
            <a href="<?php echo MI_ROOT; ?>/modulos/ventanilla/enviada/pendien_radicar/index.php">
                <span class="btn btn-warning btn-sm btn-small label label-important">
                    <i class="fa fa-bullhorn"></i> Pendientes <br>por radicar
                </span>
            </a>
        </li>
    </ul>
    <div class="inner-wrapper">
        <p class="menu-title">Reportes</p>
    </div>
    <ul class="small-items">
        <li class="">
            <a href="#" id="BtnReportCorresEnviadaPorDigital"> Pendientes por adjuntar digital</a>
        </li>
    </ul>
</div>