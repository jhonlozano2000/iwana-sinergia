<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
require_once 'config/variable.php';
require_once 'config/funciones.php';
require_once 'config/funciones_seguridad.php';
require_once 'config/class.Conexion.php';
require_once("modulos/clases/seguridad/class.SeguridadUsuario.php");
require_once("modulos/clases/seguridad/class.SeguridadModulo.php");
require_once("modulos/clases/seguridad/class.SeguridadMostrarBuscar.php");
require_once 'modulos/clases/radicar/class.RadicaRecibido.php';
require_once 'modulos/clases/radicar/class.RadicaEnviadoTemp.php';
require_once "modulos/clases/notificaciones/class.NotificacionesExternas.php";
require_once "modulos/clases/notificaciones/class.NotificacionesInternas.php";
/*
$PendientesRecibidosPorResponder      = RadicadoRecibido::Listar(29, "", "", "", "", "", "", "", "");
$TotalPendientesRecibidosPorResponder = RadicadoRecibido::TotalRegistros(29, "", "", "", "", "", "", "", "");
$PendientesRecibidos                  = RadicadoRecibido::Listar(28, "", "", "", "", "", "", "", "");
$TotalPendientesRecibidos             = RadicadoRecibido::TotalRegistros(28, "", "", "", "", "", "", "", "");

$PendientesEnviados                   = RadicadoEnviado::Listar(28, "", "", "", "", "", "", "", "");
$TotalPendientesEnviados              = RadicadoEnviado::TotalRegistros_Correspondencia(28, "", "", "", "", "", "", "", "");

$PendientesEnviadosPorRadicar         = RadicadoEnviadoTemp::Listar(12, "", "", "", "", "", "", "", "");
$TotalPendientesEnviadosPorRadicar    = RadicadoEnviadoTemp::TotalRegistros(12, "", "", "", "", "", "", "", "");

$MostrarAlertasAdministrador          = Usuario::Buscar(9, $_SESSION['SesionUsuaId'], "", "", "", "", "", 2);
$MostrarAlertasBandeja                = Usuario::Buscar(9, $_SESSION['SesionUsuaId'], "", "", "", "", "", 3);
$MostrarAlertasRadicador              = Usuario::Buscar(9, $_SESSION['SesionUsuaId'], "", "", "", "", "", 1);
*/

?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<meta charset="utf-8" />
	<title>...::: Iwana - Panel :::...</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta name="language" content="es">
	<meta name="content-language" content="es">
	<meta content="" name="description" />
	<meta content="" name="author" />
	<link href="public/assets/plugins/jquery-metrojs/MetroJs.min.js" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="public/assets/plugins/shape-hover/css/demo.css" />
	<link rel="stylesheet" type="text/css" href="public/assets/plugins/shape-hover/css/component.css" />
	<link rel="stylesheet" type="text/css" href="public/assets/plugins/owl-carousel/owl.carousel.css" />
	<link rel="stylesheet" type="text/css" href="public/assets/plugins/owl-carousel/owl.theme.css" />
	<link href="public/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
	<link href="public/assets/plugins/jquery-slider/css/jquery.sidr.light.css" rel="stylesheet" type="text/css" media="screen"/>
	<link rel="stylesheet" href="public/assets/plugins/jquery-ricksaw-chart/css/rickshaw.css" type="text/css" media="screen" >
	<link rel="stylesheet" href="public/assets/plugins/Mapplic/mapplic/mapplic.css" type="text/css" media="screen" >
	<!-- BEGIN CORE CSS FRAMEWORK -->
	<link href="public/assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="public/assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
	<link href="public/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
	<link href="public/assets/css/animate.min.css" rel="stylesheet" type="text/css"/>
	<link href="public/assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css"/>
	<!-- END CORE CSS FRAMEWORK -->

	<!-- BEGIN CSS TEMPLATE -->
	<link href="public/assets/css/style.css" rel="stylesheet" type="text/css"/>
	<link href="public/assets/css/responsive.css" rel="stylesheet" type="text/css"/>
	<link href="public/assets/css/custom-icon-set.css" rel="stylesheet" type="text/css"/>
	<link href="public/assets/css/magic_space.css" rel="stylesheet" type="text/css"/>
	<!-- END CSS TEMPLATE -->
	<script src="public/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="">
	<!-- BEGIN HEADER -->
	<?php require_once 'config/cabeza.php'; ?>
	<!-- END HEADER -->
	<!-- BEGIN CONTAINER -->
	<div class="page-container row-fluid">
		<!-- BEGIN SIDEBAR -->
		<div class="page-sidebar" id="main-menu">
			<!-- BEGIN MINI-PROFILE -->
			<div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrapper">
				<?php require_once 'config/mini_profile.php'; ?>
				<!-- END MINI-PROFILE -->
				<!-- BEGIN SIDEBAR MENU -->
				<?php require_once 'config/menu.php'; ?>
				<!-- END SIDEBAR MENU -->
			</div>
		</div>
		<div class="footer-widget">
			<?php require_once 'config/footer-widget.php'; ?>
		</div>
		<!-- END SIDEBAR -->
		<!-- BEGIN PAGE CONTAINER-->
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div id="portlet-config" class="modal hide">
				<div class="modal-header">
					<button data-dismiss="modal" class="close" type="button"></button>
					<h3>Widget Settings</h3>
				</div>
				<div class="modal-body"> Widget settings form goes here </div>
			</div>
			<div class="clearfix"></div>

			<div class="content ">
				<div class="page-title">
					<h3>Dashboard </h3>
				</div>
				<div id="container">
					<div class="row 2col">
						<div class="col-md-3 col-sm-6 spacing-bottom-sm spacing-bottom">
							<div class="tiles blue added-margin">
								<div class="tiles-body">
									<div class="controller"> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
									<div class="tiles-title"> CORRESPONDENCIA RECIBIDA POR RESPONDER </div>
									<div class="heading"> <span class="animate-number" data-value="26.8" data-animation-duration="1200">0</span>% </div>
									<div class="progress transparent progress-small no-radius">
										<div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="26.8%"></div>
									</div>
									<div class="description"><i class="icon-custom-up"></i><span class="text-white mini-description ">&nbsp; 4% higher <span class="blend">than last month</span></span></div>
								</div>
							</div>
						</div>
						<div class="col-md-3 col-sm-6 spacing-bottom-sm spacing-bottom">
							<div class="tiles green added-margin">
								<div class="tiles-body">
									<div class="controller"> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
									<div class="tiles-title"> TOTAL DE MI CORRESPONDENCIA RECIBIDA EN LA ULTIMA SEMANA</div>
									<div class="heading"> <span class="animate-number" data-value="2545665" data-animation-duration="1000">0</span> </div>
									<div class="progress transparent progress-small no-radius">
										<div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="79%" ></div>
									</div>
									<div class="description"><i class="icon-custom-up"></i><span class="text-white mini-description ">&nbsp; 2% higher <span class="blend">than last month</span></span></div>
								</div>
							</div>
						</div>
						<div class="col-md-3 col-sm-6 spacing-bottom">
							<div class="tiles red added-margin">
								<div class="tiles-body">
									<div class="controller"> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
									<div class="tiles-title"> CORRESPONDENCIA RECIBIDA POR RESPONDER </div>
									<div class="heading"> $ <span class="animate-number" data-value="14500" data-animation-duration="1200">0</span> </div>
									<div class="progress transparent progress-white progress-small no-radius">
										<div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="45%" ></div>
									</div>
									<div class="description"><i class="icon-custom-up"></i><span class="text-white mini-description ">&nbsp; 5% higher <span class="blend">than last month</span></span></div>
								</div>
							</div>
						</div>
						<div class="col-md-3 col-sm-6">
							<div class="tiles purple added-margin">
								<div class="tiles-body">
									<div class="controller"> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
									<div class="tiles-title"> MI PARTICIPACIÓN EN GRUPOS COLABORATIVOS </div>
									<div class="row-fluid">
										<div class="heading"> <span class="animate-number" data-value="1600" data-animation-duration="700">0</span> </div>
										<div class="progress transparent progress-white progress-small no-radius">
											<div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="12%"></div>
										</div>
									</div>
									<div class="description"><i class="icon-custom-up"></i><span class="text-white mini-description ">&nbsp; 3% higher <span class="blend">than last month</span></span></div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8 spacing-bottom">
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="tiles white">
										<div class="tiles-body">
											<div class="controller">
												<a href="javascript:;" class="reload"></a>
												<a href="javascript:;" class="remove"></a>
											</div>
											<div class="tiles-title"> NOTIFICACIONES CORRESPONDENCIA RECIBIDA </div>
											<br>

											<?php
											$Notificaicones = NotificacionExterna::Listar(1, "", $_SESSION['SesionUsuaId'], "");

											$Estilo = "";

											$ListarNotificaciones = "";
											foreach($Notificaicones as $Item){		

												if($Item['prioridad'] == 1){
													$Estilo = "info";
												}elseif($Item['prioridad'] == 2){
													$Estilo = "prioridad_media";
												}elseif($Item['prioridad'] == 3){
													$Estilo = "prioridad_alta";
												}
												?>
												<div class="notification-messages <?php echo $Estilo; ?>">
													<div class="message-wrapper">
														<div class="heading"><?php echo $Item['titulo']; ?></div>
														<div class="description"><?php echo $Item['notificacion']; ?></div>
													</div>
													<div class="date pull-right"><?php Fecha_Corta_Español($Item['fechor_notifica']); ?></div>
													<div class="clearfix"></div>
												</div>
												<?php
											}
											?>
										</div>
									</div>
								</div>

								<div class="col-md-6 col-sm-6">
									<div class="tiles white">
										<div class="tiles-body">
											<div class="controller">
												<a href="javascript:;" class="reload"></a>
												<a href="javascript:;" class="remove"></a>
											</div>
											<div class="tiles-title"> NOTIFICACIONES CORRESPONDENCIA INTERNA </div>
											<br>
											
											<?php
											$Notificaicones = NotificacioniNTERNA::Listar(1, "", $_SESSION['SesionUsuaId'], "");

											$Estilo = "";

											$ListarNotificaciones = "";
											foreach($Notificaicones as $Item){		

												if($Item['prioridad'] == 1){
													$Estilo = "info";
												}elseif($Item['prioridad'] == 2){
													$Estilo = "prioridad_media";
												}elseif($Item['prioridad'] == 3){
													$Estilo = "prioridad_alta";
												}
												?>
												<div class="notification-messages <?php echo $Estilo; ?>">
													<div class="message-wrapper">
														<div class="heading"><?php echo $Item['titulo']; ?></div>
														<div class="description"><?php echo $Item['notificacion']; ?></div>
													</div>
													<div class="date pull-right"><?php Fecha_Corta_Español($Item['fechor_notifica']); ?></div>
													<div class="clearfix"></div>
												</div>
												<?php
											}
											?>
										</div>
									</div>
								</div>

							</div>
						</div>
						<div class="col-md-4">
							<div class="row">
								<div class="col-md-12 white col-sm-6">
									<div class="tiles purple added-margin" style="max-height:345px">
										<div class="tiles-body">
											<div class="controller"> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
											<h3 class="text-white "> <br>
												<br>
												<br>
												<span class="semi-bold">Steve Jobs</span> Time Capsule` is 
												Finally Unearthed on <span class="semi-bold">Skyace News</span> </h3>
												<div class="blog-post-controls-wrapper">
													<div class="blog-post-control"> <a class="text-white" href="#"><i class="icon-heart"></i> 47k</a> </div>
													<div class="blog-post-control"> <a class="text-white" href="#"><i class="icon-comment"></i> 1584</a> </div>
												</div>
												<br>
											</div>
										</div>
										<div class="tiles white added-margin">
											<div class="tiles-body">
												<div class="row">
													<div class="user-comment-wrapper col-mid-12">
														<div class="profile-wrapper"> <img src="assets/img/profiles/d.jpg"  alt="" data-src="assets/img/profiles/d.jpg" data-src-retina="assets/img/profiles/d2x.jpg" width="35" height="35"> </div>
														<div class="comment">
															<div class="user-name"> David <span class="semi-bold">Cooper</span> </div>
															<div class="preview-wrapper"> What's the progress on the new project? </div>
															<div class="more-details-wrapper">
																<div class="more-details"> <i class="icon-time"></i> 12 mins ago </div>
																<div class="more-details"> <i class="icon-map-marker"></i> Near Florida </div>
															</div>
														</div>
														<div class="clearfix"></div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- END PAGE -->
				</div>
			</div>
			<!-- BEGIN CHAT --> 
			<div class="chat-window-wrapper">
				<?php include 'modulos/chat/chat.php'; ?>
			</div>
			<!-- END CHAT --> 
			<!-- END CONTAINER -->		  
		</div>
		<!-- END CONTAINER -->

		<!-- BEGIN CORE JS FRAMEWORK-->
		<script src="modulos/configuracion/otras/funciones.ajax.js"></script>
		<script src="public/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
		<script src="public/assets/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="public/assets/plugins/breakpoints.js" type="text/javascript"></script>
		<script src="public/assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
		<script src="public/assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script>
		<script src="public/assets/plugins/jquery-lazyload/jquery.lazyload.min.js" type="text/javascript"></script>
		<script src="public/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
		<!-- END CORE JS FRAMEWORK -->
		<!-- BEGIN PAGE LEVEL JS -->
		<script src="public/assets/plugins/jquery-slider/jquery.sidr.min.js" type="text/javascript"></script>
		<script src="public/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
		<script src="public/assets/plugins/pace/pace.min.js" type="text/javascript"></script>
		<script src="public/assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
		<script src="public/assets/plugins/jquery-ricksaw-chart/js/raphael-min.js"></script>
		<script src="public/assets/plugins/jquery-ricksaw-chart/js/d3.v2.js"></script>
		<script src="public/assets/plugins/jquery-ricksaw-chart/js/rickshaw.min.js"></script>
		<script src="public/assets/plugins/jquery-sparkline/jquery-sparkline.js"></script>
		<script src="public/assets/plugins/skycons/skycons.js"></script>
		<script src="public/assets/plugins/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>

		<script src="public/assets/plugins/jquery-flot/jquery.flot.js" type="text/javascript"></script>
		<script src="public/assets/plugins/jquery-flot/jquery.flot.resize.min.js" type="text/javascript"></script>
		<script src="public/assets/plugins/jquery-metrojs/MetroJs.min.js" type="text/javascript" ></script>
		<!-- END PAGE LEVEL PLUGINS -->
		<!-- BEGIN CORE TEMPLATE JS -->
		<script src="public/assets/js/core.js" type="text/javascript"></script>
		<script src="public/assets/js/chat.js" type="text/javascript"></script>
		<script src="public/assets/js/demo.js" type="text/javascript"></script>
		<script src="public/assets/js/dashboard_v2.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(document).ready(function () {
				$(".live-tile,.flip-list").liveTile();
			});
		</script>


		<!-- END CORE TEMPLATE JS -->
	</body>
	</html>
