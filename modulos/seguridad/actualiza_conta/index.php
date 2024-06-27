<?php
session_start();
if (!isset($_SESSION['SesionUsuaId'])){
    header("Location: ../../../index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
		<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
		<meta charset="utf-8" />
		<title>...::: Iwana :::...</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<meta content="" name="description" />
		<meta content="" name="author" />
		<!-- BEGIN CORE CSS FRAMEWORK -->
		<link href="../../../public/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
		<link href="../../../public/assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
		<link href="../../../public/assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
		<link href="../../../public/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
		<link href="../../../public/assets/css/animate.min.css" rel="stylesheet" type="text/css"/>
		<!-- END CORE CSS FRAMEWORK -->
		<!-- BEGIN CSS TEMPLATE -->
		<link href="../../../public/assets/css/style_form.css" rel="stylesheet" type="text/css"/>
		<link href="../../../public/assets/css/responsive.css" rel="stylesheet" type="text/css"/>
		<link href="../../../public/assets/css/custom-icon-set.css" rel="stylesheet" type="text/css"/>
		<!-- END CSS TEMPLATE -->
	</head>
	<!-- END HEAD -->
	<!-- BEGIN BODY -->
	<body class="error-body no-top lazy"  data-original="../../../../public/assets/img/work.jpg"  style="background-image: url('../../../public/assets/img/work.jpg')">
		<div class="container">
			<div class="row login-container animated fadeInUp">
				<div class="col-md-4 col-md-offset-4 tiles white no-padding">
					<div id="alerta"></div>
					<div class="p-t-20 p-l-30 p-b-10 xs-p-t-5 xs-p-l-5 xs-p-b-5">
						<h2 class="normal">Cambias tu contraseña de Iwana</h2>
					</div>
					<div class="tiles grey p-t-20 p-b-20 text-black">
						<form id="frm_login" class="animated fadeIn">
							<div class="row form-row m-l-20 m-r-20 xs-m-l-10 xs-m-r-10">
								<div class="col-md-12 col-sm-12">
									<input name="contra_actual" type="password"  class="form-control" id="contra_actual" 
										placeholder="Contraseña actual">
								</div>
							</div>
							<div class="row form-row m-l-20 m-r-20 xs-m-l-10 xs-m-r-10">
								<div class="col-md-12 col-sm-12">
									<input name="nueva_contra" type="password"  class="form-control" id="nueva_contra" 
										placeholder="Nueva Contraseña">
								</div>
							</div>
							<div class="row form-row m-l-20 m-r-20 xs-m-l-10 xs-m-r-10">
								<div class="col-md-12 col-sm-12">
									<input name="confirma_contra" type="password"  class="form-control" id="confirma_contra" 
										placeholder="Confirma Contraseña">
								</div>
							</div>
							<div class="row p-t-10 m-l-20 m-r-20 xs-m-l-10 xs-m-r-10">
								<div class="control-group  col-md-12">
									<button type="button" class="btn btn-primary btn-cons" id="BtnCambiaContra">Cambiar</button> or&nbsp;&nbsp;
									<button type="button" class="btn btn-info btn-cons" id="BtnCanelar"> Cancelar</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- END CONTAINER -->
		<!-- BEGIN CORE JS FRAMEWORK-->
		<script src="../../../public/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
		<script src="funciones.ajax.js"></script>
		<script src="../../../public/assets/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="../../../public/assets/plugins/pace/pace.min.js" type="text/javascript"></script>
		<script src="../../../public/assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
		<script src="../../../public/assets/plugins/jquery-lazyload/jquery.lazyload.min.js" type="text/javascript"></script>
		<script src="../../../public/assets/js/login_v2.js" type="text/javascript"></script>
		<!-- BEGIN CORE TEMPLATE JS -->
		<!-- END CORE TEMPLATE JS -->
	</body>
</html>