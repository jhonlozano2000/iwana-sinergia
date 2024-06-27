<p class="menu-title">BROWSE
	<span class="pull-right">
		<a href="javascript:;"><i class="fa fa-refresh"></i></a>
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
			<li>
				<a href="<?php echo MI_ROOT; ?>/modulos/mi_archivo/bandeja/externa/recibidas/index.php"> Correspondencia Externa</a>
			</li>
			<li>
				<a href="<?php echo MI_ROOT; ?>/modulos/mi_archivo/bandeja/interna/recibidas/index.php"> Correspondencia Interna </a>
			</li>
			<?php
			if (TIPO_EMPRESA == 1) {
			?>
				<li class="">
					<a href="javascript:;">
						<i class="fa fa-folder-open"></i>
						<span class="title">Solicitudes de Historias Clínicas</span>
						<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li> <a href="<?php echo MI_ROOT; ?>/modulos/mi_archivo/bandeja/historia_clinica/recibidas/index.php"> HC Recibidas </a> </li>
						<li> <a href="<?php echo MI_ROOT; ?>/modulos/mi_archivo/bandeja/historia_clinica/enviadas/index.php"> HC Enviadas </a> </li>

					</ul>
				</li>
			<?php
			}
			?>
		</ul>
	</li>
	<noscript>
		<li>
			<a href="">
				<i class="fa fa-user"></i>
				<span class="title">Gestion de terceros</span>
				<span class="selected"></span>
				<span class="arrow open"></span>
			</a>
			<ul class="sub-menu">
				<li>
					<a href="../../../public/dashboard_v1.html"> Gestionar terceros naturales </a>
				</li>
				<li>
					<a href="../../../public/index.html "> Gestionar terceros juridicos </a>
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
	</noscript>
</ul>
<div class="clearfix"></div>