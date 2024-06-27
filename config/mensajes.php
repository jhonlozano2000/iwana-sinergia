<?php
require_once 'variable.php';

$Alerta = $_POST['alerta'];
$Msj = $_POST['mensaje'];
if(isset($_POST['Imagen'])){
	$Imagen = $_POST['Imagen'];
}

switch ($Alerta){
	case 1: /* Alerta de peligro*/
		echo '
			<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-ban"></i> Upsss!!!...</h4>
				'.$Msj.'.</div>';
	break;
	case 2: /* Alerta de informacion*/
		echo'
			<div class="alert alert-info alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-info"></i> Oye!!!...</h4>
				'.$Msj.'.</div>';
	break;
	case 3: /* Alerta de advertencia*/
		echo '
			<div class="alert alert-warning alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-warning"></i> Vaya, Vaya, Vaya!!!...</h4>
				'.$Msj.'.</div>';
	break;
	case 4: /* Alerta de exito*/
		echo '
			<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4>	<i class="icon fa fa-check"></i> Muy bien!!!...</h4>
				'.$Msj.'.</div>';
	break;
	case 5: /* Alerta de envio y carga de informacion*/
		echo '
			<div class="alert alert-info alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-info"></i> Espere por favor!!!...</h4>
				<img src="'.MI_ROOT.'/public/assets/img/loading.gif" width="20" height="20" />'. $Msj.'.</div>';
	break;
}
?>