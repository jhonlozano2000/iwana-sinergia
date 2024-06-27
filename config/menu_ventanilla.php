<p class="menu-title">BROWSE
	<span class="pull-right">
		<a href="javascript:;">
			<i class="fa fa-refresh"></i>
		</a>
	</span>
</p>
<ul>
	<li class="start">
		<a href="">
			<i class="icon-custom-home"></i>
			<span class="title">Radicación</span>
			<span class="selected"></span>
			<span class="arrow open"></span>
		</a>
		<ul class="sub-menu">
			<?php
			$permiso = Permiso::Buscar(2, $_SESSION['SesionUsuaId'], "", "", "", "Men_Venta_Unica_Radica");
			if ($permiso) {
			?>
				<li>
					<a href="<?php echo MI_ROOT; ?>/modulos/ventanilla/recibida/recibidas/index.php"> Correspondencia recibida</a>
				</li>
				<li>
					<a href="<?php echo MI_ROOT; ?>/modulos/ventanilla/enviada/enviadas/index.php"> Correspondencias enviada </a>
				</li>
				<li>
					<a href="<?php echo MI_ROOT; ?>/modulos/ventanilla/interna/interna/index.php"> Correspondencias interna </a>
				</li>
			<?php
			}

			$permiso = Permiso::Buscar(2, $_SESSION['SesionUsuaId'], "", "", "", "Men_Venta_Unica_Radica_PQRSF");
			if ($permiso) {
			?>
				<li>
					<a href="<?php echo MI_ROOT; ?>/modulos/ventanilla/interna/interna/index.php"> PQRSF </a>
				</li>
			<?php
			}

			if (TIPO_EMPRESA == 1) {
			?>
				<li class="">
					<a href="javascript:;">
						<i class="fa fa-folder-open"></i>
						<span class="title">Solicitudes de historias clínicas</span>
						<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li> <a href="<?php echo MI_ROOT; ?>/modulos/ventanilla/historia_clinica/recibidas/index.php"> HC Recibidas </a> </li>
						<li> <a href="<?php echo MI_ROOT; ?>/modulos/ventanilla/historia_clinica/enviadas/index.php"> HC Enviadas </a> </li>
					</ul>
				</li>
			<?php
			}
			?>
		</ul>
	</li>
	<li>
		<a href="">
			<i class="fa fa-user"></i>
			<span class="title">Gestion de terceros</span>
			<span class="selected"></span>
			<span class="arrow open"></span>
		</a>
		<ul class="sub-menu">
			<li>
				<a href="<?php echo MI_ROOT; ?>/modulos/ventanilla/terceros/index.php"> Gestionar terceros</a>
			</li>

		</ul>
	</li>
	<li>
		<a href="">
			<i class="fa fa-search"></i>
			<span class="title">Consultar correspondencia</span>
			<span class="selected"></span>
			<span class="arrow open"></span>
		</a>
		<ul class="sub-menu">
			<li>
				<a href="<?php echo MI_ROOT; ?>/modulos/ventanilla/consulta/index.php"> Consultar </a>
			</li>
		</ul>
	</li>
	<li class="">
		<a href="javascript:;">
			<i class="fa fa-file-text"></i>
			<span class="title">Planillas</span>
			<span class="arrow "></span>
		</a>
		<ul class="sub-menu">
			<?php
			$permiso = Permiso::Buscar(2, $_SESSION['SesionUsuaId'], "", "", "", "Men_Venta_Unica_Radica");
			if ($permiso) {
			?>
				<li> <a href="<?php echo MI_ROOT; ?>/modulos/ventanilla/planilla/recibidas/index.php">Planilla comunicaciones recibidas </a> </li>
				<li> <a href="<?php echo MI_ROOT; ?>/modulos/ventanilla/planilla/enviada/index.php">Planilla comunicaciones envidas </a> </li>
				<li> <a href="<?php echo MI_ROOT; ?>/modulos/ventanilla/planilla/interna/index.php">Planilla comunicaciones internas </a> </li>
			<?php
			}

			$permiso = Permiso::Buscar(2, $_SESSION['SesionUsuaId'], "", "", "", "Men_Venta_Unica_Radica_PQRSF");
			if ($permiso) {
			?>
				<li>
					<a href="<?php echo MI_ROOT; ?>/modulos/ventanilla/interna/interna/index.php"> PQRSF </a>
				</li>
			<?php
			}
			?>
		</ul>
	</li>
</ul>
<div class="clearfix"></div>