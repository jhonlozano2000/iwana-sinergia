<div class="user-info-wrapper">
    <div class="profile-wrapper">
        <?php
        if ($_SESSION['SesionFuncioImagenPerfil'] != "") {
            $ImagenDePerfil = $RutaMiServidor . "/archivos/fotos_perfil/" . $_SESSION['SesionFuncioImagenPerfil'];
        ?>
            <img src="<?php echo $ImagenDePerfil; ?>" alt="" data-src="<?php echo $ImagenDePerfil; ?>" data-src-retina="<?php echo $ImagenDePerfil; ?>" width="69" height="69" />
            <?php
        } else {
            if ($_SESSION['SesionFuncioSexo'] == 'M') {
            ?>
                <img src="<?php echo AVATAR_M; ?>" alt="" data-src="<?php echo AVATAR_M; ?>" data-src-retina="<?php echo AVATAR_SMALL_2X_M; ?>" width="69" height="69" />

            <?php
            } else {
            ?>
                <img src="<?php echo AVATAR_F; ?>" alt="" data-src="<?php echo AVATAR_F; ?>" data-src-retina="<?php echo AVATAR_SMALL_2X_F; ?>" width="69" height="69" />
        <?php
            }
        }
        ?>
    </div>
    <div class="user-info">
        <?php
        if ($_SESSION['SesionFuncioSexo'] == 'M') {
        ?>
            <div class="greeting">Bienvenido</div>
        <?php
        } else {
        ?>
            <div class="greeting">Bienvenida</div>
        <?php
        }
        ?>
        <div class="username"><span class="semi-bold"><?php echo htmlspecialchars($_SESSION['SesionFuncioNom'], ENT_QUOTES); ?></span></div>
        <div class="status">Estado
            <a href="#">
                <div class="status-icon green"></div>
                En Línea
            </a>
        </div>
    </div>
</div>