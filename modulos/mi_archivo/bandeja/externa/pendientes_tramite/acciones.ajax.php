<?php
session_start();
require_once "../../../../../config/class.Conexion.php";
require_once "../../../../../config/variable.php";
require_once "../../../../clases/radicar/class.RadicaRecibidoGrupoColaborativo.php";
require_once "../../../../clases/radicar/class.RadicaEnviadoTemp.php";
require_once "../../../../clases/radicar/class.RadicaEnviadoTempResponsables.php";
require_once "../../../../clases/radicar/class.RadicaEnviadoTempProyectores.php";
require_once "../../../../clases/configuracion/class.ConfigOtras.php";
require_once "../../../../clases/configuracion/class.ConfigMiEmpresa.php";
require_once "../../../../clases/general/class.GeneralFuncionario.php";
require_once "../../../../clases/seguridad/class.SeguridadLog.php";
require_once "../../../../../config/funciones.php";
include '../../../../varios/generar_plantilla.php';

$Accion               = isset($_POST['accion']) ? $_POST['accion'] : null;
$IdRadica             = isset($_POST['id_radica']) ? $_POST['id_radica'] : null;
$IdTemp               = isset($_POST['IdTemp']) ? $_POST['IdTemp'] : null;
$IdFuncioDeta         = isset($_POST['IdFuncioDeta']) ? $_POST['IdFuncioDeta'] : null;
$IdDepen              = isset($_POST['IdDepen']) ? $_POST['IdDepen'] : null;
$IdRuta               = isset($_POST['id_ruta']) ? $_POST['id_ruta'] : null;
$Responsable          = isset($_POST['Responsable']) ? $_POST['Responsable'] : null;
$PlantillaNombre      = isset($_POST['PlantillaNombre']) ? basename($_POST['PlantillaNombre']) : null;
$PlantillaGenerada    = isset($_POST['PlantillaGenerada']) ? $_POST['PlantillaGenerada'] : null;
$ObservaGrupoColabora = isset($_POST['observa_grupo_colaborativo']) ? $_POST['observa_grupo_colaborativo'] : null;

switch($Accion){
	case 'DESCARGAR_PLANTILLA':

		$PlantillaTemp = RadicadoEnviadoTemp::Buscar(1, $IdTemp, "", "", "", "", "", "");
		if($PlantillaTemp){

			//COLOCO QUE YA SE GENERO LA PLANTILLA
			$GeneraPlantilla = new RadicadoEnviadoTemp();
			$GeneraPlantilla -> set_Accion('GENERAR_PLANTILLA');
			$GeneraPlantilla -> set_IdTemp($IdTemp);
			$GeneraPlantilla -> Gestionar();

			if($Responsable == 1){
				//MARCO COMO EDITOR AL RESPONSABLE
				$Responsable = new RadicadoEnviadoTempResponsable();
				$Responsable -> set_Accion('MARCO_EDITOR');
				$Responsable -> set_IdTemp($IdTemp);
				$Responsable -> set_IdFuncio($_SESSION['SesionFuncioDetaId']);
				$Responsable -> set_Editando(1);
				$Responsable -> Gestionar();

				//QUITO LOS PROYECTORES COMO EDITOR
				$Proyector = new RadicadoEnviadoTempProyector();
				$Proyector -> set_Accion('QUITO_TODOS_LOS_EDITORES');
				$Proyector -> set_IdTemp($IdTemp);
				$Proyector -> Gestionar();
			}else{
				//MARCO EL PROYECTOR QUE ESTA EDITANDO LA PLANTILLA
				$Proyector = new RadicadoEnviadoTempProyector();
				$Proyector -> set_Accion(2);
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
			
			/****************************************************************************************
			/* INSERTO EL LOG DE LA TRANSACCION
			/****************************************************************************************/
			$RegistroLog = "El usuario descargo la plantilla del radicado temporal ".$IdTemp;
			$Log = new Log();
			$Log->set_Accion('INSERTAR_REGISTRO');
			$Log->set_IdUsuario($_SESSION['SesionUsuaId']);
			$Log->set_Modulo('Bandeja->Correspondencia recibida');
			$Log->set_FecHorRegistro(Fecha_Hora_Actual());
			$Log->set_Equipo(EQUIPO_REMOTO);
			$Log->set_IP(getRealIP());
			$Log->set_AccionUsuario('Descargar');
			$Log->set_Detalle($RegistroLog);
			$Log->Gestionar();

			if($PlantillaGenerada == 1){
				echo 2;
				exit();
			}else{
				Descargar_Plantilla($IdTemp);
				echo 1;
			}
			
		}else{
			echo "No se encontro la plantilla";
			exit();
		}
	break;
	case 'SUBIR_PLANTILLA':
		if(isset($IdTemp)){
			
			if($Responsable == 1){
				//MARCO QUE NADIE ESTA EDITANDO LA PLANTILLA
				$Responsable = new RadicadoEnviadoTempResponsable();
				$Responsable -> set_Accion('MARCO_EDITOR');
				$Responsable -> set_IdTemp($IdTemp);
				$Responsable -> set_IdFuncio($_SESSION['SesionFuncioDetaId']);
				$Responsable -> set_Editando(0);
				$Responsable -> Gestionar();
			}else{
				//MARCO QUE NADIE ESTA EDITANDO LA PLANTILLA
				$Proyector = new RadicadoEnviadoTempProyector();
				$Proyector -> set_Accion('QUITAR_EDITANDO');
				$Proyector -> set_IdTemp($IdTemp);
				$Proyector -> set_IdFuncio($_SESSION['SesionFuncioDetaId']);
				$Proyector -> set_FecHorTermina(Fecha_Hora_Actual());
				$Proyector -> Gestionar();
			}

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
			
			/****************************************************************************************
			/* INSERTO EL LOG DE LA TRANSACCION
			/****************************************************************************************/
			$RegistroLog = "El usuario subio la plantilla del radicado temporal ".$IdTemp;
			$Log = new Log();
			$Log->set_Accion('INSERTAR_REGISTRO');
			$Log->set_IdUsuario($_SESSION['SesionUsuaId']);
			$Log->set_Modulo('Bandeja->Correspondencia recibida');
			$Log->set_FecHorRegistro(Fecha_Hora_Actual());
			$Log->set_Equipo(EQUIPO_REMOTO);
			$Log->set_IP(getRealIP());
			$Log->set_AccionUsuario('Subir');
			$Log->set_Detalle($RegistroLog);
			$Log->Gestionar();

			echo 1;
			exit();
		}else{
			echo "No se establecion la plantilla para subir";
			exit();
		}
	break;
	case 'APROBAR_DOCUMENTO':

		$date = date(Fecha_Hora_Actual());
		$newDate = strtotime ('-2 hour' , strtotime ($date) ) ; 
		$newDate = date('Y-m-j H:i:s' , $newDate); 

		$Responsable = new RadicadoEnviadoTempResponsable();
		$Responsable -> set_Accion('APROBAR_DOCUMENTO');
		$Responsable -> set_IdTemp($IdTemp);
		$Responsable -> set_IdFuncio($_SESSION['SesionFuncioDetaId']);
		$Responsable -> set_FecHorAprueba($newDate);
		if($Responsable -> Gestionar() == true){

			/****************************************************************************************
			/* INSERTO EL LOG DE LA TRANSACCION
			/****************************************************************************************/
			$RegistroLog = "El usuario aprobo la plantilla del radicado temporal ".$IdTemp;
			$Log = new Log();
			$Log->set_Accion('INSERTAR_REGISTRO');
			$Log->set_IdUsuario($_SESSION['SesionUsuaId']);
			$Log->set_Modulo('Bandeja->Correspondencia recibida');
			$Log->set_FecHorRegistro(Fecha_Hora_Actual());
			$Log->set_Equipo(EQUIPO_REMOTO);
			$Log->set_IP(getRealIP());
			$Log->set_AccionUsuario('Aprobar');
			$Log->set_Detalle($RegistroLog);
			$Log->Gestionar();

			echo 1;
			exit();
		}else{
			echo "No fue posible aprobar el documento, por favor consulte con el administrador del sistema.";
			exit();
		}
	break;
	case 'ASIGNAR_FUNCIONARIO_PARA_CREAR_GRUPO_COLABORATIVO':

		$BuscarPorRadicado = RadicadoRecibidoGrupoColaborativo::Buscar(1, $IdRadica, "", "");
		if($BuscarPorRadicado){
			echo "Ya se asigno la creación del grupo colaborativo del radicado ".$IdRadica;
			exit();
		}

		$Asignar = new RadicadoRecibidoGrupoColaborativo();
		$Asignar->set_Accion($Accion);
		$Asignar->set_IdRadica($IdRadica);
		$Asignar->set_IdFuncioAsigno($_SESSION['SesionFuncioDetaId']);
		$Asignar->set_IdFuncioAsignado($IdFuncioDeta);
		$Asignar->set_FecHorAsignado(Fecha_Hora_Actual());
		$Asignar->set_Observacion($ObservaGrupoColabora);
		if($Asignar->Gestionar() == true){
			echo 1;
			exit();
		}
	break;
	default:
		echo 'No hay accion para realizar.';
}
?>