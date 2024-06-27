<?php
if (! empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')  {
	require_once '../../../config/class.Conexion.php';
	require_once "../../clases/configuracion/class.ConfigOtras_Respon_HC.php";

	$Accion     = isset($_POST['accion']) ? $_POST['accion'] : null;
	$IdDepen    = isset($_POST['id_depen']) ? $_POST['id_depen'] : null;
	$IdFuncio   = isset($_POST['id_funcio_deta']) ? $_POST['id_funcio_deta'] : null;
	$IdSerie    = isset($_POST['id_serie']) ? $_POST['id_serie'] : null;
	$IdSubSerie = isset($_POST['id_subserie']) ? $_POST['id_subserie'] : null;
	$IdTipoDoc  = isset($_POST['id_tipodoc']) ? $_POST['id_tipodoc'] : null;

	switch ($Accion) {
		case 'INSERTAR_RESPONSABLE':

			$BuscarResponsables = ConfigOtrasResponsableHC::Buscar(1, $IdFuncio);
			if($BuscarResponsables){
				echo "Este funcionario ya se encuentra como funcionario responsable de las solicitudes de historias clínicas.";
				exit();
			}
			
			$Resposable = new ConfigOtrasResponsableHC();
			$Resposable -> set_Accion('INSERTAR_RESPONSABLE');
			$Resposable -> set_IdDepen($IdDepen);
			$Resposable -> set_IdFuncioDeta($IdFuncio);
			$Resposable -> set_IdSerie($IdSerie);
			$Resposable -> set_IdSubSerie($IdSubSerie);
			$Resposable -> set_TipoDocumen($IdTipoDoc);
			if($Resposable -> Gestionar() == true){
				echo 1;
			}
			break;
		case 'ELIMINAR_RESPONSABLE':
			$Resposable = new ConfigOtrasResponsableHC();
			$Resposable -> set_Accion('ELIMINAR_RESPONSABLE');
			$Resposable -> set_IdFuncioDeta($IdFuncio);
			if($Resposable -> Gestionar() == true){
				echo 1;
			}
			break;
		default:
			echo "NO hay accion para ejecutar.";
			break;
	}
	
}
?>