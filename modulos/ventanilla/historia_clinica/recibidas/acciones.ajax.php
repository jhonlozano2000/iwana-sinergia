<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){

	session_start();
	require_once "../../../../config/class.Conexion.php";
	require_once "../../../../config/funciones.php";
	require_once "../../../../config/variable.php";

	$Accion         = isset($_POST['accion']) ? $_POST['accion'] : null;
	$IdRadicado     = isset($_POST['id_radica']) ? $_POST['id_radica'] : null;
	$IdFormaLlegada = isset($_POST['id_forma_llegada']) ? $_POST['id_forma_llegada'] : null;
	$IdRemite       = isset($_POST['id_paciente']) ? $_POST['id_paciente'] : null;
	$FecHorRadica   = isset($_POST['fechor_radica']) ? $_POST['fechor_radica'] : null;
	$FecDocu        = isset($_POST['fec_docu']) ? $_POST['fec_docu'] : null;
	$FecVenci       = isset($_POST['fec_venci']) ? $_POST['fec_venci'] : null;
	$Asunto         = isset($_POST['asunto']) ? $_POST['asunto'] : null;
	$IdResponsable  = isset($_POST['id_responsable']) ? $_POST['id_responsable'] : null;
	$TerceFacultado = isset($_POST['id_tercero']) ? $_POST['id_tercero'] : null;
	$IdParentesco   = isset($_POST['id_paren']) ? $_POST['id_paren'] : null;
	$NumAnexos      = isset($_POST['num_anexos']) ? $_POST['num_anexos'] : null;
	$NumFolios      = isset($_POST['num_folio']) ? $_POST['num_folio'] : null;
	$IdRuta         = isset($_POST['id_ruta']) ? $_POST['id_ruta'] : null;
	$ObservaAnexos  = isset($_POST['observa_anexo']) ? $_POST['observa_anexo'] : null;

	if(isset($_POST['autorizo_envio_email_pacien'])){
		$EnviaEmailPacien = 1;
	}else{
		$EnviaEmailPacien = 0;
	}

	if(isset($_POST['autorizo_envio_email_terce'])){
		$EnviaEmailTerce  = 1;
	}else{
		$EnviaEmailTerce  = 0;
	}

	$PeriodoDesde     = isset($_POST['desde']) ? $_POST['desde'] : null;
	$PeriodoHast      = isset($_POST['hasta']) ? $_POST['hasta'] : null;
	$Servicio         = isset($_POST['servicio']) ? $_POST['servicio'] : null;

	switch ($Accion){
		case 'GUARDAR_SOLIC_HC':

			require_once "../../../clases/radicar/class.RadicaRecibido.php";
			require_once "../../../clases/radicar/class.RadicaRecibidoHC.php";
			require_once "../../../clases/radicar/class.RadicaRecibidoResponsable.php";
			require_once "../../../clases/configuracion/class.ConfigOtras_Respon_HC.php";
			require_once "../../../clases/configuracion/class.ConfigOtras.php";

			/******************************************************************************************/
            /*  GERAR EL RADICADO
            /******************************************************************************************/
            $ConfiguracionOtras = ConfigOtras::Buscar();
			if(!$ConfiguracionOtras->get_TipoRadicadRecibida()){
				echo "Iwana no tiene configurado el tipo de radicado, por favor consulte con el administrador del sistema.";
			}

			if($ConfiguracionOtras->get_TipoRadicadRecibida() == 1){
				
				$NuevoRadicado = RadicadoRecibido::Listar_Vario(2, "", "", "", 0, 0, 0, "", "", "");
				foreach($NuevoRadicado as $Item):
					$IdRadicado = $Item['IdRadicado'];
				endforeach;

			}elseif($ConfiguracionOtras->get_TipoRadicadRecibida() == 2){
				
				$IdDepenFincionario = "";

				$DepenFincionario = Funcionario::Listar(18, $IdResponsable, "", "", "", "", "", "");
				foreach($DepenFincionario as $Item) {
					$IdDepenFincionario = $Item['id_depen'];
				}

				$NuevoRadicado = RadicadoRecibido::Listar_Vario(3, "", "", "", $IdDepenFincionario, 0, 0, "", "", "");
				foreach($NuevoRadicado as $Item):
					$IdRadicado = $Item['IdRadicado'];
				endforeach;
			}elseif($ConfiguracionOtras->get_TipoRadicadRecibida() == 3){
				
				$IdDepenFincionario = "";

				$DepenFincionario = Funcionario::Listar(18, $IdResponsable, "", "", "", "", "", "");
				foreach($DepenFincionario as $Item) {
					$IdDepenFincionario = $Item['id_depen'];
				}

				$NuevoRadicado = RadicadoRecibido::Listar_Vario(4, "", "", "", $IdDepenFincionario, 0, 0, "", "", "");
				foreach($NuevoRadicado as $Item):
					$IdRadicado = $Item['IdRadicado'];
				endforeach;
			}

			$Clasificacion = ConfigOtrasResponsableHC::Buscar(1, $IdResponsable);
			$ConfiguracionOtras = ConfigOtras::Buscar();

			$NumeroDias = $ConfiguracionOtras->get_HC_NumDias();
			$FechaVencimiento = SumarDiasHabiles(Fecha_Hora_Actual(), $NumeroDias);
			
			$Radicado = new RadicadoRecibido();
			$Radicado -> set_Accion('GUARDAR_RADICADO');
			$Radicado -> set_IdRadica($IdRadicado);
			$Radicado -> set_IdSerie($Clasificacion->get_IdSerie());
			$Radicado -> set_IdSubserie($Clasificacion->get_IdSubSerie());
			$Radicado -> set_IdTipoDoc($Clasificacion->get_TipoDocumen());
			$Radicado -> set_IdUsuaRegis($_SESSION['SesionUsuaId']);
			$Radicado -> set_FormaLlegada($IdFormaLlegada);
			$Radicado -> set_IdRemite($IdRemite);
			$Radicado -> set_FecRadica(Fecha_Hora_Actual());
			$Radicado -> set_FecDocu(Fecha_Hora_Actual());
			$Radicado -> set_FecVenciDocu($FechaVencimiento);
			$Radicado -> set_Asunto($Asunto);
			$Radicado -> set_NumAnexos($NumAnexos);
			$Radicado -> set_ObservaAneos($ObservaAnexos);
			$Radicado -> set_RequieRespues(1);
			$Radicado -> set_Estado('Tramite');
			
			if($Radicado -> Gestionar() === true){

				$RadicaHC = new RadicadoRecibidoHC();
				$RadicaHC -> set_Accion('GUARDAR');
				$RadicaHC -> set_IdRadica($IdRadicado);
				$RadicaHC -> set_IdTercero($TerceFacultado);
				$RadicaHC -> set_IdParenTercero($IdParentesco);
				$RadicaHC -> set_EnvioEmailTercer($EnviaEmailTerce);
				$RadicaHC -> set_EnvioEmailPacien($EnviaEmailPacien);
				$RadicaHC -> set_PeriodoDesde(Convertir_Fecha_A_Mysql($PeriodoDesde));
				$RadicaHC -> set_PeriodoHasta(Convertir_Fecha_A_Mysql($PeriodoHast));
				$RadicaHC -> set_Servicio($Servicio);
				if($RadicaHC -> Gestionar() === true){

					$Responsable = new RadicadoRecibidoResponsable();
					$Responsable -> set_Accion(5);
					$Responsable -> set_IdRadica($IdRadicado);
					$Responsable -> set_IdFuncio($IdResponsable);
					$Responsable -> Gestionar();
					echo 1;
					exit();
				}
			}else{
				echo "No pudo guardar el radicado.";
			}
		break;
		case 'RADICADO_CARGAR_DIGITAL':
		
			require_once "../../../clases/radicar/class.RadicaRecibido.php";
			$Radicado = new RadicadoRecibido();
			$Radicado -> set_Accion(4);
			$Radicado -> set_IdRadica($IdRadicado);
			$Radicado -> set_NumFolios($NumFolios);
			$Radicado -> set_IdRuta($IdRuta);

			if($Radicado -> Gestionar() === true){
				echo 1;
				exit();
			} 
		break;
		case 'IMPRIMIR_ROTULO':

			require_once "../../../clases/radicar/class.RadicaRecibido.php";

			$Radicado = new RadicadoRecibido();
			$Radicado -> set_Accion(2);
			$Radicado -> set_IdRadica($IdRadicado);
			$Radicado -> set_FecHorImpriRoru(Fecha_Hora_Actual());
			$Radicado -> set_UsuaImpriRotu($_SESSION['SesionUsuaId']);
			if($Radicado -> Gestionar() == true){
				echo 1;
				exit();
			}
		break;
		default:
			echo 'No hay accion para realizar.'.$Accion;
		break;
	}
}
?>