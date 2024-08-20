<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<meta charset="utf-8" />
	<title>Install Iwana</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta content="" name="description" />
	<meta content="" name="author" />

	<!-- BEGIN PLUGIN CSS -->
	<link href="../../../public/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css"
		media="screen" />
	<link href="../../../public/assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css"
		media="screen" />
	<link href="../../../public/assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" type="text/css" />
	<link href="../../../public/assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.css" rel="stylesheet"
		type="text/css" />
	<link href="../../../public/assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet"
		type="text/css" />
	<link href="../../../public/assets/plugins/boostrap-checkbox/css/bootstrap-checkbox.css" rel="stylesheet"
		type="text/css" media="screen" />
	<link rel="stylesheet" href="../../../public/assets/plugins/ios-switch/ios7-switch.css" type="text/css" media="screen">
	<!-- END PLUGIN CSS -->
	<!-- BEGIN CORE CSS FRAMEWORK -->
	<link href="../../../public/assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="../../../public/assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
	<link href="../../../public/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
	<link href="../../../public/assets/css/animate.min.css" rel="stylesheet" type="text/css" />
	<link href="../../../public/assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" />
	<!-- END CORE CSS FRAMEWORK -->
	<!-- BEGIN CSS TEMPLATE -->
	<link href="../../../public/assets/css/style.css" rel="stylesheet" type="text/css" />
	<link href="../../../public/assets/css/responsive.css" rel="stylesheet" type="text/css" />
	<link href="../../../public/assets/css/custom-icon-set.css" rel="stylesheet" type="text/css" />
	<!-- END CSS TEMPLATE -->
</head>
<!-- BEGIN BODY -->

<body class="error-body no-top">

	<!-- BEGIN CONTAINER -->
	<div class="container">

		<!-- BEGIN PAGE CONTAINER-->
		<div class="row login-container column-seperation">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div id="portlet-config" class="modal hide">
				<div class="modal-header">
					<button data-dismiss="modal" class="close" type="button"></button>
					<h3>Widget Settings</h3>
				</div>
				<div class="modal-body"> Widget settings form goes here </div>
			</div>
			<div class="clearfix"></div>
			<div class="content">
				<div class="row">
					<div class="col-md-12">
						<div class="grid simple transparent">
							<div class="grid-body ">
								<div class="row">
									<form id="commentForm">
										<div id="rootwizard" class="col-md-12">
											<div class="form-wizard-steps">
												<ul class="wizard-steps">
													<li class="" data-target="#step1">
														<a href="#tab1" data-toggle="tab">
															<span class="step">1</span>
															<span class="title">Dependencias</span>
														</a>
													</li>
													<li data-target="#step2" class="">
														<a href="#tab2" data-toggle="tab">
															<span class="step">2</span>
															<span class="title">Oficinas</span>
														</a>
													</li>
													<li data-target="#step3" class="">
														<a href="#tab3" data-toggle="tab">
															<span class="step">3</span>
															<span class="title">Cargos</span>
														</a>
													</li>
													<li data-target="#step4" class="">
														<a href="#tab4" data-toggle="tab">
															<span class="step">4</span>
															<span class="title">Funcionarios
															</span>
														</a>
													</li>
												</ul>
												<div class="clearfix"></div>
											</div>
											<div class="tab-content transparent">
												<div class="tab-pane" id="tab1"> <br>
													<h4 class="semi-bold">Paso 1 -
														<span class="light">Configuración basica de dependencias</span>
													</h4>
													<br>
													<?php require_once 'config_areas_dependencias.php'; ?>
												</div>
												<div class="tab-pane" id="tab2"> <br>
													<h4 class="semi-bold">Paso 2 -
														<span class="light">Configuración basica de oficinas</span>
													</h4>
													<br>
													<?php require_once 'config_areas_oficinas.php'; ?>
												</div>
												<div class="tab-pane" id="tab3"> <br>
													<h4 class="semi-bold">Paso 3 -
														<span class="light">Configuración basica de cargos</span>
													</h4>
													<br>
													<?php require_once 'config_areas_cargos.php'; ?>
												</div>
												<div class="tab-pane" id="tab4"> <br>
													<h4 class="semi-bold">Paso 4 -
														<span class="light">Configuración basica de funcionarios</span>
													</h4>
													<br>
													<?php require_once 'config_areas_funcionarios.php'; ?>
												</div>
												<br />
												<br />
												<ul class=" wizard wizard-actions">
													<li class="previous first" style="display:none;"><a
															href="javascript:;"
															class="btn">&nbsp;&nbsp;First&nbsp;&nbsp;</a></li>
													<li class="previous"><a href="javascript:;"
															class="btn">&nbsp;&nbsp;Previous&nbsp;&nbsp;</a></li>
													<li class="next last" style="display:none;"><a href="javascript:;"
															class="btn btn-primary">&nbsp;&nbsp;Last&nbsp;&nbsp;</a>
													</li>
													<li class="next"><a href="javascript:;"
															class="btn btn-primary">&nbsp;&nbsp;Next&nbsp;&nbsp;</a>
													</li>
												</ul>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	<!-- END PAGE -->
	<!-- END CONTAINER -->
	<!-- BEGIN CORE JS FRAMEWORK-->
	<script src="../../../public/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
	<script src="../../../public/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="../../../public/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="../../../public/assets/plugins/breakpoints.js" type="text/javascript"></script>
	<script src="../../../public/assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
	<!-- END CORE JS FRAMEWORK -->
	<!-- BEGIN PAGE LEVEL JS -->
	<script src="../../../public/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
	<script src="../../../public/assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script>
	<script src="../../../public/assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js"
		type="text/javascript"></script>
	<script src="../../../public/assets/plugins/pace/pace.min.js" type="text/javascript"></script>
	<script src="../../../public/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"
		type="text/javascript"></script>
	<script src="../../../public/assets/plugins/bootstrap-select2/select2.min.js" type="text/javascript"></script>
	<script src="../../../public/assets/plugins/boostrap-form-wizard/js/jquery.bootstrap.wizard.min.js"
		type="text/javascript"></script>
	<script src="../../../public/assets/plugins/jquery-validation/js/jquery.validate.min.js"
		type="text/javascript"></script>
	<!-- END PAGE LEVEL PLUGINS -->
	<script src="../../../public/assets/js/form_validations.js" type="text/javascript"></script>
	<!-- BEGIN CORE TEMPLATE JS -->
	<script src="../../../public/assets/js/core.js" type="text/javascript"></script>
	<script src="../../../public/assets/js/demo.js" type="text/javascript"></script>
	<!-- END CORE TEMPLATE JS -->
	<!-- END JAVASCRIPTS -->
</body>

</html>