<?php
require_once "config/class.Conexion.php";
require_once "config/funciones.php";
require_once "modulos/clases/seguridad/class.SeguridadUsuario.php";

$Usuarios = Usuario::Listar(4, "", "", "", "", "", "", "");
$Combo_Usuarios = "";
foreach ($Usuarios as $Item) :
	$Combo_Usuarios .= "<option value='" . $Item['login'] . "'>" . ($Item['login']) . "</option>";
endforeach;
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
	<link href="public/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="public/assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="public/assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
	<link href="public/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
	<link href="public/assets/css/animate.min.css" rel="stylesheet" type="text/css" />
	<!-- END CORE CSS FRAMEWORK -->
	<!-- BEGIN CSS TEMPLATE -->
	<link href="public/assets/css/style_form.css" rel="stylesheet" type="text/css" />
	<link href="public/assets/css/responsive.css" rel="stylesheet" type="text/css" />
	<link href="public/assets/css/custom-icon-set.css" rel="stylesheet" type="text/css" />
	<!-- END CSS TEMPLATE -->

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->

<body class="error-body no-top lazy" data-original="public/assets/img/work.jpg" style="background-image: url('public/assets/img/work.jpg')">
	<div class="container">
		<div class="row login-container animated fadeInUp">
			<div class="col-md-7 col-md-offset-2 tiles white no-padding">
				<div id="alerta" class="p-t-30 p-l-40 p-b-20 xs-p-t-10 xs-p-l-10 xs-p-b-10"></div>
				<div class="p-t-30 p-l-40 p-b-20 xs-p-t-10 xs-p-l-10 xs-p-b-10">
					<h2 class="normal">Iniciar sesión en Iwana.</h2>
					<p>Gestiona tus documentos.<br></p>
					<p class="p-b-20">Sistema integrado para el apoyo del proceso Gestión Documental.</p>
				</div>
				<div class="tiles grey p-t-20 p-b-20 text-black">
					<form id="frm_login" class="animated fadeIn">
						<div class="row form-row m-l-20 m-r-20 xs-m-l-10 xs-m-r-10">
							<div class="col-md-6 col-sm-6 ">
								<select name="login" id="login" style="width:100%">
									<?php echo $Combo_Usuarios; ?>
								</select>
							</div>
							<div class="col-md-6 col-sm-6">
								<input name="contra" type="password" class="form-control" id="contra" placeholder="Contraseña" value="Jhon1javer2">
							</div>
						</div>
						<div class="row p-t-10 m-l-20 m-r-20 xs-m-l-10 xs-m-r-10">
							<div class="control-group  col-md-10">
								<button type="button" class="btn btn-primary btn-cons" id="BtnEntrar">Entrar</button> or&nbsp;&nbsp;
								<div class="checkbox checkbox check-success">
									<a href="#">¿Has olvidado tu contraseña?</a>&nbsp;&nbsp;
									<input type="checkbox" id="checkbox1" value="1">
									<label for="checkbox1">Recordarme </label>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- END CONTAINER -->
	<!-- BEGIN CORE JS FRAMEWORK-->
	<script src="public/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
	<script src="redirec.ajax.js"></script>
	<script src="public/assets/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="public/assets/plugins/pace/pace.min.js" type="text/javascript"></script>
	<script src="public/assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
	<script src="public/assets/plugins/jquery-lazyload/jquery.lazyload.min.js" type="text/javascript"></script>
	<script src="public/assets/js/login_v2.js" type="text/javascript"></script>
	<!-- BEGIN CORE TEMPLATE JS -->
	<!-- END CORE TEMPLATE JS -->
</body>

</html>