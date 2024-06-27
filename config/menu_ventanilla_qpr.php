<div id="inner-menu">
    <div class="inner-wrapper">
        <a href="<?php echo MI_ROOT; ?>/modulos/ventanilla/recibida/recibidas/radicar.php" class="btn btn-block btn-primary">
            <span class="bold">RADICAR</span>
        </a>
    </div>
    <div class="inner-wrapper">
        <p class="menu-title">VISTA RÁPIDA</p>
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
    <ul class="small-items">
        <li class="">
            <a href="<?php echo MI_ROOT; ?>/modulos/ventanilla/pqrsf/pendientes/index.php">
                <span class="btn btn-danger btn-sm btn-small label label-important">
                    <i class="fa fa-bell-o"></i> Pendientes por <br>Gestionar
                </span>
            </a>
        </li>
    </ul>
    <div class="inner-wrapper">
        <p class="menu-title">Reportes</p>
    </div>
    <ul class="small-items">
        <li class=""><a href="#" id="BtnReportCorrespondenRecibidaPorVencer"> Pendientes por vencer</a></li>
        <li class=""><a href="#" id="BtnReportCorresRecibidaPorDigital"> Pendientes por adjuntar digital</a></li>
    </ul>
</div>