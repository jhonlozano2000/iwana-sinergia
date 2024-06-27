<?php
require_once '../../../config/class.Conexion.php';
require_once '../../clases/general/class.GeneralFuncionario.php';
require_once '../../clases/general/class.GeneralFuncionarioDetalle.php';
require_once '../../clases/general/class.GeneralFuncionarioAccesoDigitalizados.php';
require_once '../../clases/radicar/class.RadicaRecibidoResponsable.php';
require_once '../../clases/radicar/class.RadicaEnviadoResponsable.php';
require_once '../../clases/radicar/class.RadicaEnviadoProyectores.php';
require_once '../../clases/radicar/class.RadicaInternoResponsable.php';
require_once '../../clases/radicar/class.RadicaInternoDestinatario.php';
require_once '../../clases/radicar/class.RadicaInternoProyectores.php';
require_once '../../clases/radicar/class.RadicaEnviadoTemp.php';
require_once '../../clases/radicar/class.RadicaEnviadoTempResponsables.php';
require_once '../../clases/radicar/class.RadicaEnviadoTempProyectores.php';
require_once '../../clases/radicar/class.RadicaEnviadoTempNota.php';

$Accion           = isset($_POST['accion']) ? $_POST['accion'] : null;
$id_funcio        = isset($_POST['id_funcio']) ? $_POST['id_funcio'] : null;
$id_funcio_deta   = isset($_POST['id_funcio_deta']) ? $_POST['id_funcio_deta'] : null;
$id_muni          = isset($_POST['id_muni']) ? $_POST['id_muni'] : null;
$id_depar         = isset($_POST['id_depar']) ? $_POST['id_depar'] : null;
$Id_Dependencia   = isset($_POST['id_depen']) ? $_POST['id_depen'] : null;
$id_oficina       = isset($_POST['id_oficina']) ? $_POST['id_oficina'] : null;
$id_cargo         = isset($_POST['id_cargo']) ? $_POST['id_cargo'] : null;
$propie_princi    = isset($_POST['propie_princi']) ? $_POST['propie_princi'] : null;
$jefe_dependencia = isset($_POST['jefe_dependencia']) ? $_POST['jefe_dependencia'] : null;
$jefe_oficina     = isset($_POST['jefe_oficina']) ? $_POST['jefe_oficina'] : null;
$puede_firmar     = isset($_POST['puede_firmar']) ? $_POST['puede_firmar'] : null;
$crea_expedien    = isset($_POST['crea_expedien']) ? $_POST['crea_expedien'] : null;
$cod_funcio       = isset($_POST['cod_funcio']) ? $_POST['cod_funcio'] : null;
$nom_funcio       = isset($_POST['nom_funcio']) ? $_POST['nom_funcio'] : null;
$ape_funcio       = isset($_POST['ape_funcio']) ? $_POST['ape_funcio'] : null;
$genero           = isset($_POST['genero']) ? $_POST['genero'] : null;
$dir              = isset($_POST['dir']) ? $_POST['dir'] : null;
$tel              = isset($_POST['tel']) ? $_POST['tel'] : null;
$cel              = isset($_POST['cel']) ? $_POST['cel'] : null;
$email            = isset($_POST['email']) ? $_POST['email'] : null;
$observa          = isset($_POST['observa']) ? $_POST['observa'] : null;
$firma            = isset($_POST['firma']) ? $_POST['firma'] : null;
$foto             = isset($_POST['foto']) ? $_POST['foto'] : null;
$acti             = isset($_POST['acti']) ? $_POST['acti'] : null;
if (isset($_POST['ChkTRD'])) $ChkTRD = explode(",", $_POST['ChkTRD']);

switch ($Accion) {
	case 'INSERTAR':

		if ($jefe_oficina == 1) {
			$BuscarFuncionarioJefe = Funcionario::Buscar(7, 0, "", "", "", $Id_Dependencia, 0, 0);
			if ($BuscarFuncionarioJefe) {
				echo "Ya se encuentra registrado el Jefe de Área para esta dependencia";
				exit();
			}
		}

		$BuscarFuncionarioCod    = Funcionario::Buscar(4, 0, $cod_funcio, $nom_funcio, $ape_funcio, 0, 0, 0);
		$BuscarFuncionarioNombre = Funcionario::Buscar(3, 0, $cod_funcio, $nom_funcio, $ape_funcio, 0, 0, 0);

		if ($BuscarFuncionarioCod) {
			echo "Ya se encuentra registrado en el sistema un Funcionario con el Código ó C.c.: " . $cod_funcio;
			exit();
		} elseif ($BuscarFuncionarioNombre) {
			echo "Ya se encuentra registrado en el sistema un Funcionario con los nombres " . $nom_funcio . " " . $ape_funcio;
			exit();
		} else {
			$Funcionario = new Funcionario();
			$Funcionario->setAccion($Accion);
			$Funcionario->setId_Funcio($id_funcio);
			$Funcionario->setCod_Funcio($cod_funcio);
			$Funcionario->setNom_Funcio($nom_funcio);
			$Funcionario->setApe_Funcio($ape_funcio);
			$Funcionario->setGenero($genero);
			$Funcionario->setPropiePrinci($propie_princi);
			$Funcionario->setJefeDependenci($jefe_dependencia);
			$Funcionario->setJefeOficina($jefe_oficina);
			$Funcionario->setCreaExpediente($crea_expedien);
			$Funcionario->setPuedeFirmar($puede_firmar);
			$Funcionario->setId_Depar($id_depar);
			$Funcionario->setId_Muni($id_muni);
			$Funcionario->setDir($dir);
			$Funcionario->setTel($tel);
			$Funcionario->setCel($cel);
			$Funcionario->setEmail($email);
			$Funcionario->setObserva($observa);
			$Funcionario->setFirma($firma);
			$Funcionario->setActi($acti);
			if ($Funcionario->Gestionar() === true) {

				//ACTUALIZO EL DETALLE DEL FUNCIONARIO, PRIMERO DESACTIVO LOS DETALLES ACTUALES
				//SI EL NUEVO DETALLE NO EXISTE LO INSERTO DE LO CONTRARIO LO ACTIVO
				$BuscarDetalle = FuncionarioDetalle::Buscar(3, $Funcionario->getId_Funcio(), "", $id_oficina, $id_cargo);
				if (!$BuscarDetalle) {

					$FuncionarioDetalle = new FuncionarioDetalle();
					$FuncionarioDetalle->setAccion("INSERTAR");
					$FuncionarioDetalle->setId_Funcio($Funcionario->getId_Funcio());
					$FuncionarioDetalle->setId_Ofi($id_oficina);
					$FuncionarioDetalle->setId_Cargo($id_cargo);
					$FuncionarioDetalle->setActi($acti);
					$FuncionarioDetalle->Gestionar();
				} else {
					$FuncionarioDetalle = new FuncionarioDetalle();
					$FuncionarioDetalle->setAccion("INACTIVAR");
					$FuncionarioDetalle->setId_Funcio($Funcionario->getId_Funcio());
					$FuncionarioDetalle->Gestionar();

					$FuncionarioDetalle->setAccion("ACTIVAR");
					$FuncionarioDetalle->setId_Ofi($id_oficina);
					$FuncionarioDetalle->setId_Cargo($id_cargo);
					$FuncionarioDetalle->setActi($acti);
					$FuncionarioDetalle->Gestionar();
				}

				$AccesoDigital = new FuncionarioAccesoDigital();
				$AccesoDigital->setAccion('ELIMINAR');
				$AccesoDigital->setId_FuncioDeta($id_funcio_deta);
				$AccesoDigital->Gestionar();

				if (count($ChkTRD) >= 1) {
					for ($i = 0; $i < count($ChkTRD); $i++) {

						$Valores     = explode("-", $ChkTRD[$i]);
						$Dependencia = $Valores[0];
						$Serie       = $Valores[1];
						$SubSerie    = $Valores[2];

						$AccesoDigital = new FuncionarioAccesoDigital();
						$AccesoDigital->setAccion('INSERTAR');
						$AccesoDigital->setId_FuncioDeta($id_funcio_deta);
						$AccesoDigital->setId_Dependencia($Dependencia);
						$AccesoDigital->setId_Serie($Serie);
						$AccesoDigital->setId_SubSerie($SubSerie);
						$AccesoDigital->Gestionar();
					}
				}

				echo 1;
			}
		}
		break;
	case 'EDITAR':

		if ($jefe_oficina == 1) {
			$BuscarFuncionarioJefe = Funcionario::Buscar(5, $id_funcio, "", "", "", $Id_Dependencia, 0, 0);
			if (!$BuscarFuncionarioJefe) {
				echo "Ya se encuentra registrado el Jefe de Área para esta dependencia";
				exit();
			}
		}

		$Funcionario = new Funcionario();
		$Funcionario->setAccion($Accion);
		$Funcionario->setId_Funcio($id_funcio);
		$Funcionario->setCod_Funcio($cod_funcio);
		$Funcionario->setNom_Funcio($nom_funcio);
		$Funcionario->setApe_Funcio($ape_funcio);
		$Funcionario->setGenero($genero);
		$Funcionario->setPropiePrinci($propie_princi);
		$Funcionario->setJefeDependenci($jefe_dependencia);
		$Funcionario->setJefeOficina($jefe_oficina);
		$Funcionario->setCreaExpediente($crea_expedien);
		$Funcionario->setPuedeFirmar($puede_firmar);
		$Funcionario->setId_Depar($id_depar);
		$Funcionario->setId_Muni($id_muni);
		$Funcionario->setDir($dir);
		$Funcionario->setTel($tel);
		$Funcionario->setCel($cel);
		$Funcionario->setEmail($email);
		$Funcionario->setObserva($observa);
		$Funcionario->setFirma($firma);
		$Funcionario->setActi($acti);
		if ($Funcionario->Gestionar() == true) {

			/**
			 * Limpio los temporales que tenga un funcionario 
			 */
			$HayCorrespondencia = 0;

			$FuncionarioDetalle = FuncionarioDetalle::Listar(5, $id_funcio, "", "", "");
			foreach ($FuncionarioDetalle as $ItemDeta) {

				//BUSCO SI EL FUCIONARIO TIENE CORRESPONDENCIA RECIBIDA
				$CorresRecibida = RadicadoRecibidoResponsable::Buscar(1, "", $ItemDeta['id_funcio_deta']);
				if ($CorresRecibida) {
					$HayCorrespondencia = 1;
				}

				//BUSCO SI EL FUCIONARIO TIENE CORRESPONDENCIA ENVIADA
				$CorresEnviadaRespon = RadicadoEnviadoResponsable::Buscar(2, "", $ItemDeta['id_funcio_deta']);
				if ($CorresEnviadaRespon) {
					$HayCorrespondencia = 1;
				}

				$CorresEnviadaProyec = RadicadoEnviadoProyector::Buscar(2, "", $ItemDeta['id_funcio_deta']);
				if ($CorresEnviadaProyec) {
					$HayCorrespondencia = 1;
				}

				//BUSCO SI EL FUCIONARIO TIENE CORRESPONDENCIA INTERNA
				$CorresInternaRespon = RadicadoInternoResponsable::Buscar(1, "", $ItemDeta['id_funcio_deta']);
				if ($CorresInternaRespon) {
					$HayCorrespondencia = 1;
				}

				$CorresInternaDestina = RadicadoInternoDestinatario::Buscar(1, "", $ItemDeta['id_funcio_deta']);
				if ($CorresInternaDestina) {
					$HayCorrespondencia = 1;
				}

				$CorresInternaProyec = RadicadoInternoProyector::Buscar(1, "", $ItemDeta['id_funcio_deta']);
				if ($CorresInternaProyec) {
					$HayCorrespondencia = 1;
				}


				if ($HayCorrespondencia = 0) {
					$EliminarDetalle = new FuncionarioDetalle();
					$EliminarDetalle->setAccion('ELIMINAR_BASURA');
					$EliminarDetalle->setId_FuncioDeta($ItemDeta['id_funcio_deta']);
					$EliminarDetalle->Gestionar();
				}

				$HayCorrespondencia = false;
			}

			//INACTIVO LAS OFICINAS QUE TENGA EL USUARIO//
			$FuncionarioDetalle = new FuncionarioDetalle();
			$FuncionarioDetalle->setAccion("INACTIVAR");
			$FuncionarioDetalle->setId_FuncioDeta($id_funcio_deta);
			if ($FuncionarioDetalle->Gestionar() != true) {
				echo "No se pudo inactivar el funcionario.";
				exit();
			}

			$FuncionarioDetalle = FuncionarioDetalle::Buscar(3, $id_funcio, "", $id_oficina, $id_cargo);

			if (!$FuncionarioDetalle) {

				$FuncionarioDetalle = new FuncionarioDetalle();
				$FuncionarioDetalle->setAccion("INSERTAR");
				$FuncionarioDetalle->setId_Funcio($id_funcio);
				$FuncionarioDetalle->setId_Ofi($id_oficina);
				$FuncionarioDetalle->setId_Cargo($id_cargo);
				$FuncionarioDetalle->setActi(1);
				$FuncionarioDetalle->Gestionar();
			} else {

				$FuncionarioDetalle->setAccion("ACTIVAR");
				$FuncionarioDetalle->setId_Funcio($id_funcio);
				$FuncionarioDetalle->setId_Ofi($id_oficina);
				$FuncionarioDetalle->setId_Cargo($id_cargo);
				$FuncionarioDetalle->Gestionar();
			}

			$AccesoDigital = new FuncionarioAccesoDigital();
			$AccesoDigital->setAccion('ELIMINAR');
			$AccesoDigital->setId_FuncioDeta($id_funcio_deta);
			$AccesoDigital->Gestionar();

			if (count($ChkTRD) >= 1) {
				for ($i = 0; $i < count($ChkTRD) - 1; $i++) {
					$Valores     = explode("-", $ChkTRD[$i]);
					$Dependencia = $Valores[0];
					$Serie       = $Valores[1];
					$SubSerie    = $Valores[2];

					$AccesoDigital = new FuncionarioAccesoDigital();
					$AccesoDigital->setAccion('INSERTAR');
					$AccesoDigital->setId_FuncioDeta($id_funcio_deta);
					$AccesoDigital->setId_Dependencia($Dependencia);
					$AccesoDigital->setId_Serie($Serie);
					$AccesoDigital->setId_SubSerie($SubSerie);
					$AccesoDigital->Gestionar();
				}
			}

			echo 1;
		} else {
			echo "No se pudo actializar la información del funconario.";
		}
		break;
	case 'ELIMINAR':

		$FuncionarioDetalle = new FuncionarioDetalle();
		$FuncionarioDetalle->setAccion("ELIMINAR");
		$FuncionarioDetalle->setId_FuncioDeta($id_funcio_deta);
		if ($FuncionarioDetalle->Gestionar() === true) {

			$Funcionario = new Funcionario();
			$Funcionario->setAccion($Accion);
			$Funcionario->setId_Funcio($id_funcio);
			if ($Funcionario->Gestionar() === true) {
				echo 1;
				exit();
			}
		}

		break;
	case 'ACTIVAR':

		$FuncionarioDetalle = new FuncionarioDetalle();
		$FuncionarioDetalle->setAccion("ACTIVAR_INACTIVAR");
		$FuncionarioDetalle->setId_FuncioDeta($id_funcio_deta);
		$FuncionarioDetalle->setActi($acti);
		if ($FuncionarioDetalle->Gestionar() === true) {

			$Funcionario = new Funcionario();
			$Funcionario->setAccion("ACTIVAR_INACTIVAR");
			$Funcionario->setId_Funcio($id_funcio);
			$Funcionario->setActi($acti);
			if ($Funcionario->Gestionar() === true) {
				echo 1;
				exit();
			}
		}
		break;
	default:
		echo 'No hay accion para realizar.';
}
