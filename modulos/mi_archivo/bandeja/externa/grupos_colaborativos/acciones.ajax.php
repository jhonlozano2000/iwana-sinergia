<?php
session_start();
require_once "../../../../../config/class.Conexion.php";
require_once "../../../../../config/variable.php";
require_once "../../../../clases/radicar/class.RadicaEnviadoTemp.php";
require_once "../../../../clases/radicar/class.RadicaEnviadoTempQuienFirma.php";
require_once "../../../../clases/radicar/class.RadicaEnviadoTempResponsables.php";
require_once "../../../../clases/radicar/class.RadicaEnviadoTempProyectores.php";
require_once "../../../../clases/configuracion/class.ConfigOtras.php";
require_once "../../../../clases/configuracion/class.ConfigMiEmpresa.php";
require_once "../../../../clases/general/class.GeneralFuncionario.php";
require_once "../../../../../config/funciones.php";
include '../../../../varios/generar_plantilla.php';

$Accion            = isset($_POST['accion']) ? $_POST['accion'] : null;
$IdTemp            = isset($_POST['IdTemp']) ? $_POST['IdTemp'] : null;
$id_temp            = isset($_POST['id_temp']) ? $_POST['id_temp'] : null;
$IdFuncioDeta      = isset($_POST['IdFuncioDeta']) ? $_POST['IdFuncioDeta'] : null;
$IdDepen           = isset($_POST['IdDepen']) ? $_POST['IdDepen'] : null;
$IdRuta            = isset($_POST['id_ruta']) ? $_POST['id_ruta'] : null;
$Responsable       = isset($_POST['Responsable']) ? $_POST['Responsable'] : null;
$TipoFuncionario   = isset($_POST['tipo_funcionario']) ? $_POST['tipo_funcionario'] : null;
$PlantillaNombre   = isset($_POST['PlantillaNombre']) ? basename($_POST['PlantillaNombre']) : null;
$PlantillaGenerada = isset($_POST['PlantillaGenerada']) ? $_POST['PlantillaGenerada'] : null;
$PlantillaCargada  = isset($_POST['PlantillaCargada']) ? $_POST['PlantillaCargada'] : null;

switch($Accion){
	case 'DESCARGAR_PLANTILLA':

		$PlantillaTemp = RadicadoEnviadoTemp::Buscar(1, $IdTemp, "", "", "", "", "", "");
		if($PlantillaTemp){
			
			//COLOCO QUE YA SE GENERO LA PLANTILLA
			$GeneraPlantilla = new RadicadoEnviadoTemp();
			$GeneraPlantilla -> set_Accion('GENERAR_PLANTILLA');
			$GeneraPlantilla -> set_IdTemp($IdTemp);
			$GeneraPlantilla -> Gestionar();
			
			if($TipoFuncionario == "QUIEN_FIRMA"){
				$QuienFirma = new RadicadoEnviadoTempQuienFirma();
				$QuienFirma -> set_Accion('ESTABLECER_QUIEN_ESTA_FIRMANDO');
				$QuienFirma -> set_IdTemp($IdTemp);
				$QuienFirma -> set_IdFuncio($_SESSION['SesionFuncioDetaId']);
				$QuienFirma -> Gestionar();

				$DecargoPlantilla = new RadicadoEnviadoTempQuienFirma();
				$DecargoPlantilla -> set_Accion('DESCARGO_PLANTILLA');
				$DecargoPlantilla -> set_IdTemp($IdTemp);
				$DecargoPlantilla -> set_IdFuncio($_SESSION['SesionFuncioDetaId']);
				$DecargoPlantilla -> Gestionar();

			}elseif($TipoFuncionario == "RESPONSABLE"){
				//MARCO COMO EDITOR AL RESPONSABLE
				$Responsable = new RadicadoEnviadoTempResponsable();
				$Responsable -> set_Accion('MARCO_EDITOR');
				$Responsable -> set_IdTemp($IdTemp);
				$Responsable -> set_IdFuncio($_SESSION['SesionFuncioDetaId']);
				$Responsable -> set_Editando(1);
				$Responsable -> Gestionar();

				$Responsable -> set_Accion('DESCARGO_PLANTILLA');
				$Responsable -> set_IdTemp($IdTemp);
				$Responsable -> set_IdFuncio($_SESSION['SesionFuncioDetaId']);
				$Responsable -> Gestionar();

			}elseif($TipoFuncionario == "PROYECTOR"){
				//MARCO EL PROYECTOR QUE ESTA EDITANDO LA PLANTILLA
				$Proyector = new RadicadoEnviadoTempProyector();
				$Proyector -> set_Accion(2);
				$Proyector -> set_IdTemp($IdTemp);
				$Proyector -> set_IdFuncio($_SESSION['SesionFuncioDetaId']);
				$Proyector -> Gestionar();

				$Proyector -> set_Accion('DESCARGO_PLANTILLA');
				$Proyector -> set_IdTemp($IdTemp);
				$Proyector -> set_IdFuncio($_SESSION['SesionFuncioDetaId']);
				$Proyector -> Gestionar();
			}

			//ACTUALIZO EL CARGUE DE LA PLANTILLA
			$Temp = new RadicadoEnviadoTemp();
			$Temp -> set_Accion('CARGUE_PLANTILLA');
			$Temp -> set_IdTemp($IdTemp);
			$Temp -> set_Plantilla_Cargada(0);
			$Temp -> Gestionar();
			
			if($PlantillaGenerada == 0 AND $PlantillaCargada == 0){
				Descargar_Plantilla($IdTemp);
				echo 1;
			}else{
				echo 2;
				exit();
			}
			
		}else{
			echo "No se encontro la plantilla";
			exit();
		}
	break;
	case 'PLANTILLA_SUBIR':
		$IdTemp = $id_temp;

		if(isset($IdTemp)){
			
			if($TipoFuncionario == "QUIEN_FIRMA"){
				$QuienFirma = new RadicadoEnviadoTempQuienFirma();
				$QuienFirma -> set_Accion('QUITAR_QUIEN_ESTA_FIRMANDO');
				$QuienFirma -> set_IdTemp($IdTemp);
				$QuienFirma -> set_IdFuncio($_SESSION['SesionFuncioDetaId']);
				$QuienFirma -> Gestionar();

				$QuienFirma -> set_Accion('SUBIO_PLANTILLA');
				$QuienFirma -> set_IdTemp($IdTemp);
				$QuienFirma -> set_IdFuncio($_SESSION['SesionFuncioDetaId']);
				$QuienFirma -> Gestionar();
			}elseif($TipoFuncionario == "RESPONSABLE"){
				//MARCO QUE NADIE ESTA EDITANDO LA PLANTILLA
				$Responsable = new RadicadoEnviadoTempResponsable();
				$Responsable -> set_Accion('MARCO_EDITOR');
				$Responsable -> set_IdTemp($IdTemp);
				$Responsable -> set_IdFuncio($_SESSION['SesionFuncioDetaId']);
				$Responsable -> set_Editando(0);
				$Responsable -> Gestionar();

				$Responsable -> set_Accion('SUBIO_PLANTILLA');
				$Responsable -> set_IdTemp($IdTemp);
				$Responsable -> set_IdFuncio($_SESSION['SesionFuncioDetaId']);
				$Responsable -> Gestionar();
			}elseif($TipoFuncionario == "PROYECTOR"){
				//MARCO QUE NADIE ESTA EDITANDO LA PLANTILLA
				$Proyector = new RadicadoEnviadoTempProyector();
				$Proyector -> set_Accion('QUITAR_EDITANDO');
				$Proyector -> set_IdTemp($IdTemp);
				$Proyector -> set_IdFuncio($_SESSION['SesionFuncioDetaId']);
				$Proyector -> set_FecHorTermina(Fecha_Hora_Actual());
				$Proyector -> Gestionar();

				$Proyector -> set_Accion('SUBIO_PLANTILLA');
				$Proyector -> set_IdTemp($IdTemp);
				$Proyector -> set_IdFuncio($_SESSION['SesionFuncioDetaId']);
				$Proyector -> Gestionar();
			}

			$PlantillaNombre = $_FILES['archivo']['name'];
			
			//ACTUALIZO EL NOMBRE DEL ARCHIVO
			$Temp = new RadicadoEnviadoTemp();
			$Temp -> set_Accion('ACTUALIZA_NOM_ARCHIVO');
			$Temp -> set_IdTemp($IdTemp);
			$Temp -> set_NomArchivo($PlantillaNombre);
			$Temp -> set_IdRuta($IdRuta);
			$Temp -> Gestionar();

			//ACTUALIZO EL CARGUE DE LA PLANTILLA
			$Temp = new RadicadoEnviadoTemp();
			$Temp -> set_Accion('CARGUE_PLANTILLA');
			$Temp -> set_IdTemp($IdTemp);
			$Temp -> set_Plantilla_Cargada(1);
			$Temp -> Gestionar();

			echo 1;
			exit();
		}else{
			echo "No se establecion la plantilla para subir";
			exit();
		}
	break;
	case 'FIRMAR_DOCUMENTO':
		/*
		$YaSeAprobo  = RadicadoEnviadoTempResponsable::Buscar(8, $IdTemp, $_SESSION['SesionFuncioDetaId']);
		if($YaSeAprobo){
			echo "El documento no se ha aprobado por completo, consulta con los responsables del documento.";
			exit();
		}
		*/

		$Responsable = new RadicadoEnviadoTempQuienFirma();
		$Responsable -> set_Accion('FIRMAR_DOCUMENTO');
		$Responsable -> set_IdTemp($IdTemp);
		$Responsable -> set_IdFuncio($_SESSION['SesionFuncioDetaId']);
		$Responsable -> set_FecHorFirma(Fecha_Hora_Actual());
		if($Responsable -> Gestionar() == true){
			
			$FuncionarioResponsable = RadicadoEnviadoTempResponsable::Buscar(3, $IdTemp, $_SESSION['SesionFuncioDetaId']);
			if($FuncionarioResponsable){
				$Responsable = new RadicadoEnviadoTempResponsable();
				$Responsable -> set_Accion('APROBAR_DOCUMENTO');
				$Responsable -> set_IdTemp($IdTemp);
				$Responsable -> set_IdFuncio($_SESSION['SesionFuncioDetaId']);
				$Responsable -> set_FecHorAprueba(Fecha_Hora_Actual());
				$Responsable -> Gestionar();
			}

			$TempRadicaTerminado = RadicadoEnviadoTemp::Buscar(11, $IdTemp, "");
			if(!$TempRadicaTerminado){
				$TempRadica = new RadicadoEnviadoTemp();
				$TempRadica->set_Accion('TERMINAR_TEMP');
				$TempRadica->set_IdTemp($IdTemp);
				$TempRadica->Gestionar();
			}

			echo 1;
			exit();
		}else{
			echo "No fue posible aprobar el documento, por favor consulte con el administrador del sistema.";
			exit();
		}
	break;
	case 'QUITAR_FIRMA':
		$Firma = new RadicadoEnviadoTempQuienFirma();
		$Firma -> set_Accion('QUITAR_FIRMA');
		$Firma -> set_IdTemp($IdTemp);
		$Firma -> set_IdFuncio($_SESSION['SesionFuncioDetaId']);
		$Firma -> set_FecHorFirma(Fecha_Hora_Actual());
		if($Firma -> Gestionar() == true){
			echo 1;
			exit();
		}else{
			echo "No fue posible aprobar el documento, por favor consulte con el administrador del sistema.";
			exit();
		}
	break;
	case 'APROBAR_DOCUMENTO':

		$Responsable = new RadicadoEnviadoTempResponsable();
		$Responsable -> set_Accion('APROBAR_DOCUMENTO');
		$Responsable -> set_IdTemp($IdTemp);
		$Responsable -> set_IdFuncio($_SESSION['SesionFuncioDetaId']);
		$Responsable -> set_FecHorAprueba(Fecha_Hora_Actual());
		if($Responsable -> Gestionar() == true){

			$FuncionarioProyector = RadicadoEnviadoTempProyector::Buscar(7, $IdTemp, $_SESSION['SesionFuncioDetaId']);
			if($FuncionarioProyector){
				$Responsable = new RadicadoEnviadoTempProyector();
				$Responsable -> set_Accion('PROYECTAR_DOCUMENTO');
				$Responsable -> set_IdTemp($IdTemp);
				$Responsable -> set_IdFuncio($_SESSION['SesionFuncioDetaId']);
				$Responsable -> set_FecHorTermina(Fecha_Hora_Actual());
			}

			echo 1;
			exit();
		}else{
			echo "No fue posible aprobar el documento, por favor consulte con el administrador del sistema.";
			exit();
		}
	break;
	case 'QUITAR_APROBACION':
	
		$Responsable = new RadicadoEnviadoTempResponsable();
		$Responsable -> set_Accion('QUITAR_APROBACION');
		$Responsable -> set_IdTemp($IdTemp);
		$Responsable -> set_IdFuncio($_SESSION['SesionFuncioDetaId']);
		$Responsable -> set_FecHorAprueba(Fecha_Hora_Actual());
		if($Responsable -> Gestionar() == true){
			echo 1;
			exit();
		}else{
			echo "No fue posible aprobar el documento, por favor consulte con el administrador del sistema.";
			exit();
		}
	break;
	case 'PROYECTAR_DOCUMENTO':

		$Responsable = new RadicadoEnviadoTempProyector();
		$Responsable -> set_Accion('PROYECTAR_DOCUMENTO');
		$Responsable -> set_IdTemp($IdTemp);
		$Responsable -> set_IdFuncio($_SESSION['SesionFuncioDetaId']);
		$Responsable -> set_FecHorTermina(Fecha_Hora_Actual());
		if($Responsable -> Gestionar() == true){
			echo 1;
			exit();
		}else{
			echo "No fue posible aprobar el documento, por favor consulte con el administrador del sistema.";
			exit();
		}
	break;
	case 'ANULAR_TEMP':
		//ANULO EL TEMPORAL
		$Temp = new RadicadoEnviadoTemp();
		$Temp -> set_Accion('ANULAR_TEMP');
		$Temp -> set_IdTemp($IdTemp);
		$Temp -> set_IdUsuaRegis($_SESSION['SesionFuncioDetaId']);
		$Temp -> set_FecHorRegistro(Fecha_Hora_Actual());
		if($Temp -> Gestionar() == true){
			echo 1,
			exit();
		}
	break;
	default:
		echo 'No hay accion para realizar.';
	}
?>