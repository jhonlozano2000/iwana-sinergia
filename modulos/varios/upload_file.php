<?php
ob_start();
session_start();
include("../../config/funciones.php");
include("../../config/variable.php");
include "../../config/class.Conexion.php";
require_once '../clases/radicar/class.RadicaRecibido.php';
require_once '../clases/radicar/class.RadicaEnviado.php';
require_once '../clases/radicar/class.RadicaEnviadoArchivoAdicional.php';
require_once '../clases/radicar/class.RadicaInterno.php';
require_once "../clases/radicar/class.RadicaInternoAdjuntos.php";
require_once '../clases/radicar/class.RadicaEnviadoTemp.php';
require_once '../clases/radicar/class.RadicaRecibidoPQRSFAdjunto.php';
require_once '../clases/varias/class.GestionAdjunto.php';
require_once '../clases/configuracion/class.ConfigServidor_Temp.php';
require_once '../clases/configuracion/class.ConfigServidor_Calidad.php';
require_once '../clases/calidad/class.CalidadRepositorio.php';
require_once '../clases/varias/class.ftp.php';

$Accion              = isset($_POST['accion']) ? $_POST['accion'] : null;
$archivoId           = isset($_POST['archivo_id']) ? $_POST['archivo_id'] : null;
$IdDepen             = isset($_POST['id_depen']) ? $_POST['id_depen'] : null;
$IdRadica            = isset($_POST['id_radicado']) ? $_POST['id_radicado'] : null;
$IdTemp              = isset($_POST['id_temp']) ? $_POST['id_temp'] : null;
$IdPqr               = isset($_POST['id_pqr']) ? $_POST['id_pqr'] : null;
$IdRuta              = isset($_POST['id_ruta']) ? $_POST['id_ruta'] : null;
$ArchivoSubirTMP     = isset($_FILES['archivo']['tmp_name']) ? $_FILES['archivo']['tmp_name'] : null;
$ArchivoSubirNOMBRE  = isset($_FILES['archivo']['name']) ? $_FILES['archivo']['name'] : null;
$NombrePlantilla     = isset($_POST['NombrePlantilla']) ? $_POST['NombrePlantilla'] : null;
$TipoCorrespondencia = isset($_POST['tipo_correspon']) ? $_POST['tipo_correspon'] : null;

//VARIABLES PARA DESCARGAR ARCHIVOS DIGITALES
$IdDigital          = isset($_POST['id_digital']) ? $_POST['id_digital'] : null;
$IdTomo             = isset($_POST['id_tomo']) ? $_POST['id_tomo'] : null;
$IdArchivoDigital   = isset($_POST['id_archivo']) ? $_POST['id_archivo'] : null;
$ArchivoDigital     = isset($_POST['archivo']) ? $_POST['archivo'] : null;
$TipoArchivoDigital = isset($_POST['tipo_archivo']) ? $_POST['tipo_archivo'] : null;

$ArchivoInterno = isset($_POST['archiv_interno']) ? $_POST['archiv_interno'] : null;

switch ($Accion) {
	case 'RECIBIDOS_UPLOAD':

		/**
		 * Codifico el archivo a subir
		 */
		$archivoCodificado = decodeBase64($ArchivoSubirTMP);

		/**
		 * Actualizo el archivo en la tabla archivo_radica_recibidos
		 */
		$Radicado = new RadicadoRecibido();
		$Radicado->set_Accion(4);
		$Radicado->set_IdRadica($IdRadica);
		$Radicado->set_IdRuta($IdRuta);
		$Radicado->set_Archivo($archivoCodificado);
		if ($Radicado->Gestionar() == "true") {
			echo 1;
			exit();
		}

		break;
	case 'RECIBIDOS_DESCARGAR':

		/**
		 * Busco los datos del radicado
		 */
		$Radicado      = RadicadoRecibido::Buscar(1, $IdRadica, "", "", "", "");

		/**
		 * Decodifico el archivo a subir
		 */
		//$archivoDecodificado = encodeBase64($Radicado->get_Archivo());
		// Decodifica el contenido Base64
		$decoded_content = base64_decode($Radicado->get_Archivo());

		// Guarda el contenido decodificado en un nuevo archivo
		file_put_contents('../../archivos/temp/', $decoded_content);

		// Establece el nombre del archivo decodificado
		$file_name = 'archivo_decodificado.pdf';

		// Establecer cabeceras para la descarga
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="' . $file_name . '"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . strlen($decoded_content));

		// Enviar el archivo decodificado al navegador para su descarga
		echo $decoded_content;
		exit;


		if (!is_dir(MI_ROOT_TEMP_RELATIVA . "/recibidos/"))
			mkdir(MI_ROOT_TEMP_RELATIVA . "/recibidos/", 0777);

		$ftpObj = new FTPClient();

		//Connect
		$ftpObj->connect($Ip, $Usuario, $Contra);
		if ($ftpObj->pr($ftpObj->getMessages()[0]) == 'true') {

			$NomArchivo = $Radicado->get_Archivo();
			$RutaArchivo = "";

			if ($RutaFtp != "") {
				$RutaArchivo = $Ano . "/" . $RutaFtp . "/" . $IdRadica . "/" . $NomArchivo;
			} else {
				$RutaArchivo = $Ano . "/" . $IdRadica . "/" . $NomArchivo;
			}

			$ftpObj->downloadFile(MI_ROOT_TEMP_RELATIVA . "/recibidos/" . $NomArchivo, $RutaArchivo);
			if ($ftpObj->pr($ftpObj->getMessages()[0]) == 'true') {
				echo 1;
				exit();
			} else {
				echo "No fue posible descargar el archivo o el arhivo non existe";
				exit();
			}
		} else {
			echo "No fue posible conectarme con el servidor de archivo….\nPor favor consulte con el administrador del sistema.";
			exit();
		}
		break;
	case 'RECIBIDOS_ELIMINAR_DIGITAL':

		$Servidor      = ServidorTemp::Buscar(2, $IdRuta, "", 1);
		$Ip            = $Servidor->get_Ip();
		$Usuario       = $Servidor->get_Usua();
		$Contra        = $Servidor->get_Contra();
		$RutaFtp       = $Servidor->get_Ruta();
		$Radicado      = RadicadoRecibido::Buscar(1, $IdRadica, "", "", "", "");
		$FechaRadicado = new DateTime($Radicado->get_FecRadica());
		$Ano           = $FechaRadicado->format('Y');

		if (!is_dir(MI_ROOT_TEMP_RELATIVA . "/recibidos/"))
			mkdir(MI_ROOT_TEMP_RELATIVA . "/recibidos/", 0777);

		$ftpObj = new FTPClient();

		//Connect
		$ftpObj->connect($Ip, $Usuario, $Contra);
		if ($ftpObj->pr($ftpObj->getMessages()[0]) == 'true') {

			$NomArchivo = $Radicado->get_Archivo();
			$RutaArchivo = "";

			if ($RutaFtp != "") {
				$RutaArchivo = $Ano . "/" . $RutaFtp . "/" . $IdRadica . "/" . $NomArchivo;
			} else {
				$RutaArchivo = $Ano . "/" . $IdRadica . "/" . $NomArchivo;
			}

			$ftpObj->deleteFile($RutaArchivo);
			if ($ftpObj->pr($ftpObj->getMessages()[0]) == 'true') {
				echo 1;
				exit();
			} else {
				echo "No fue posible eliminar el archivo o el arhivo non existe";
				exit();
			}
		} else {
			echo "No fue posible conectarme con el servidor de archivo….\nPor favor consulte con el administrador del sistema.";
			exit();
		}
		break;
	case 'ENVIADOS_UPLOAD':

		$Servidor = ServidorTemp::Buscar(5, 0, "", 2);

		if (!$Servidor) {
			echo "No se encontro el servidor de archivo para esta dependencia, por favor consulte con el administador del sistema.";
			exit();
		}

		$IdRuta        = $Servidor->get_IdRuta();
		$Ip            = $Servidor->get_Ip();
		$Usuario       = $Servidor->get_Usua();
		$Contra        = $Servidor->get_Contra();
		$RutaFtp       = $Servidor->get_Ruta();
		$Radicado      = RadicadoEnviado::Buscar(1, $IdRadica);
		$FechaRadicado = new DateTime($Radicado->get_FecRadica());
		$Ano           = $FechaRadicado->format('Y');

		$ftpObj = new FTPClient();
		//Connect

		$ftpObj->connect($Ip, $Usuario, $Contra);
		if ($ftpObj->pr($ftpObj->getMessages()[0]) == 'true') {

			$Ruta = "";
			if ($RutaFtp != "") {
				$Ruta = $Ano . "/" . $RutaFtp . "/" . $IdRadica;
				$ftpObj->makeDir($Ano);
				$ftpObj->makeDir($Ano . "/" . $RutaFtp);
				$ftpObj->makeDir($Ano . "/" . $RutaFtp . "/" . $IdRadica);
			} else {
				$Ruta = $Ano . "/" . $IdRadica;
				$ftpObj->makeDir($Ano);
				$ftpObj->makeDir($Ano . "/" . $RutaFtp . "/" . $IdRadica);
			}

			$Extencion = Extencion_Archivo($ArchivoSubirNOMBRE);
			$Archivo = $Ruta . "/" . $IdRadica . "." . $Extencion;

			$ftpObj->uploadFile($ArchivoSubirTMP, $Archivo);
			if ($ftpObj->pr($ftpObj->getMessages()[1]) == 'true') {

				//ESTABLEZCO EL NUMERO DE PAGINAS DEL ARCHIVO DIGITAL
				$Radicado = new RadicadoEnviado();
				$Radicado->set_Accion(4);
				$Radicado->set_IdRadica($IdRadica);
				$Radicado->set_IdRuta($IdRuta);
				$Radicado->set_Archivo($IdRadica . "." . $Extencion);
				if ($Radicado->Gestionar() == true) {
					echo 1;
					exit();
				}
			} else {
				echo "No fue posible enviar el archivo al servidor, por favor consulte con el administrador del sistema";
				exit();
			}
		} else {
			echo "No fue posible conectarme con el servidor de archivo...\nPor favor consulte con el administrador del sistema.";
			exit();
		}
		break;
	case 'ENVIADOS_DESCARGAR':

		$Servidor      = ServidorTemp::Buscar(2, $IdRuta, "", 2);
		$Ip            = $Servidor->get_Ip();
		$Usuario       = $Servidor->get_Usua();
		$Contra        = $Servidor->get_Contra();
		$RutaFtp       = $Servidor->get_Ruta();
		$Radicado      = RadicadoEnviado::Buscar(1, $IdRadica);
		$FechaRadicado = new DateTime($Radicado->get_FecRadica());
		$Ano           = $FechaRadicado->format('Y');

		if (!is_dir(MI_ROOT_TEMP_RELATIVA . "/enviados/"))
			mkdir(MI_ROOT_TEMP_RELATIVA . "/enviados/", 0777);

		$ftpObj = new FTPClient();

		//Connect
		$ftpObj->connect($Ip, $Usuario, $Contra);
		if ($ftpObj->pr($ftpObj->getMessages()[0]) == 'true') {

			$NomArchivo = $Radicado->get_Archivo();
			$RutaArchivo = "";

			if ($RutaFtp != "") {
				$RutaArchivo = $Ano . "/" . $RutaFtp . "/" . $IdRadica . "/" . $ArchivoDigital;
			} else {
				$RutaArchivo = $Ano . "/" . $IdRadica . "/" . $ArchivoDigital;
			}

			$ftpObj->downloadFile(MI_ROOT_TEMP_RELATIVA . "/enviados/" . $ArchivoDigital, $RutaArchivo);
			if ($ftpObj->pr($ftpObj->getMessages()[0]) == 'true') {
				echo 1;
				exit();
			} else {
				echo "No fue posible descargar el archivo o el arhivo non existe";
				exit();
			}
		} else {
			echo "No fue posible conectarme con el servidor de archivo….\nPor favor consulte con el administrador del sistema.";
			exit();
		}
		break;
	case 'ENVIADOS_UPLOAD_ADICIONALES':

		$Servidor = ServidorTemp::Buscar(5, 0, "", 2);

		if (!$Servidor) {
			echo "No se encontro el servidor de archivo para esta dependencia, por favor consulte con el administador del sistema.";
			exit();
		}

		$IdRuta        = $Servidor->get_IdRuta();
		$Ip            = $Servidor->get_Ip();
		$Usuario       = $Servidor->get_Usua();
		$Contra        = $Servidor->get_Contra();
		$RutaFtp       = $Servidor->get_Ruta();
		$Radicado      = RadicadoEnviado::Buscar(1, $IdRadica);
		$FechaRadicado = new DateTime($Radicado->get_FecRadica());
		$Ano           = $FechaRadicado->format('Y');

		$ftpObj = new FTPClient();

		// Abrimos la carpeta que nos pasan como parámetro
		$path =  MI_ROOT_TEMP_RELATIVA . "/temp_ventanilla/enviados/" . $_SESSION['SesionUsuaId'];
		$dir = opendir($path);
		// Leo todos los ficheros de la carpeta
		while ($elemento = readdir($dir)) {
			if ($elemento != "." && $elemento != "..") {
				if (!is_dir($path . $elemento)) {

					$ArchivoAdicional = new RadicadoEnviadoArchivoAdicional();
					$ArchivoAdicional->set_Accion('INSERTAR_ARCHIVO');
					$ArchivoAdicional->set_IdRadica($IdRadica);
					$ArchivoAdicional->set_NomArchivo($elemento);
					if ($ArchivoAdicional->Gestionar() == true) {

						$IdArchivoAdicional = $ArchivoAdicional->get_IdArchivo();

						$ftpObj = new FTPClient();
						//Connect

						$ftpObj->connect($Ip, $Usuario, $Contra);
						if ($ftpObj->pr($ftpObj->getMessages()[0]) == 'true') {

							$Ruta = "";
							if ($RutaFtp != "") {
								$Ruta = $Ano . "/" . $RutaFtp . "/" . $IdRadica;
								$ftpObj->makeDir($Ano);
								$ftpObj->makeDir($Ano . "/" . $RutaFtp);
								$ftpObj->makeDir($Ano . "/" . $RutaFtp . "/" . $IdRadica);
							} else {
								$Ruta = $Ano . "/" . $IdRadica;
								$ftpObj->makeDir($Ano);
								$ftpObj->makeDir($Ano . "/" . $RutaFtp . "/" . $IdRadica);
							}

							$Extencion = Extencion_Archivo($elemento);
							$Archivo = $Ruta . "/" . $elemento;

							$ftpObj->uploadFile($path . '/' . $elemento, $Archivo);
							if ($ftpObj->pr($ftpObj->getMessages()[1]) == 'true') {
								unlink($path . '/' . $elemento);
							} else {
								echo "No fue posible enviar el archivo al servidor, por favor consulte con el administrador del sistema";
								exit();
							}
						} else {
							echo "No fue posible conectarme con el servidor de archivo...\nPor favor consulte con el administrador del sistema.";
							exit();
						}
					}
				}
			}
		}

		echo 1;
		exit();
		break;
	case 'INTERNO_UPLOAD':

		$path =  MI_ROOT_TEMP_RELATIVA . "/temp_ventanilla/internos/" . $_SESSION['SesionUsuaId'];
		if (is_dir($path)) {
			$Servidor = ServidorTemp::Buscar(5, 0, "", 3);

			if (!$Servidor) {
				echo "No se encontro el servidor de archivo para esta dependencia, por favor consulte con el administador del sistema.";
				exit();
			}

			$IdRuta        = $Servidor->get_IdRuta();
			$Ip            = $Servidor->get_Ip();
			$Usuario       = $Servidor->get_Usua();
			$Contra        = $Servidor->get_Contra();
			$RutaFtp       = $Servidor->get_Ruta();
			$Radicado      = RadicadoInterno::Buscar(1, $IdRadica, "", "", "");
			$FechaRadicado = new DateTime($Radicado->get_FecRadica());
			$Ano           = $FechaRadicado->format('Y');

			$ftpObj = new FTPClient();

			// Abrimos la carpeta que nos pasan como parámetro
			$dir = opendir($path);

			// Leo todos los ficheros de la carpeta
			while ($elemento = readdir($dir)) {
				if ($elemento != "." && $elemento != "..") {
					if (!is_dir($path . $elemento)) {

						$ArchivoAdicional = new RadicadoInternoAdjuntos();
						$ArchivoAdicional->set_Accion('INSERTAR_ARCHIVO');
						$ArchivoAdicional->set_IdRadica($IdRadica);
						$ArchivoAdicional->set_NomArchivo($elemento);
						if ($ArchivoAdicional->Gestionar() == true) {

							$IdArchivoAdicional = $ArchivoAdicional->get_IdArchivo();

							$ftpObj = new FTPClient();
							//Connect

							$ftpObj->connect($Ip, $Usuario, $Contra);
							if ($ftpObj->pr($ftpObj->getMessages()[0]) == 'true') {

								$Ruta = "";
								if ($RutaFtp != "") {
									$Ruta = $Ano . "/" . $RutaFtp . "/" . $IdRadica;
									$ftpObj->makeDir($Ano);
									$ftpObj->makeDir($Ano . "/" . $RutaFtp);
									$ftpObj->makeDir($Ano . "/" . $RutaFtp . "/" . $IdRadica);
								} else {
									$Ruta = $Ano . "/" . $IdRadica;
									$ftpObj->makeDir($Ano);
									$ftpObj->makeDir($Ano . "/" . $RutaFtp . "/" . $IdRadica);
								}

								$Extencion = Extencion_Archivo($elemento);
								$Archivo = $Ruta . "/" . $elemento;

								$ftpObj->uploadFile($path . '/' . $elemento, $Archivo);
								if ($ftpObj->pr($ftpObj->getMessages()[1]) == 'true') {
									unlink($path . '/' . $elemento);
								} else {
									echo "No fue posible enviar el archivo al servidor, por favor consulte con el administrador del sistema";
									exit();
								}
							} else {
								echo "No fue posible conectarme con el servidor de archivo...\nPor favor consulte con el administrador del sistema.";
								exit();
							}
						}
					}
				}
			}
		}

		echo 1;
		exit();
		break;
	case 'INTERNO_UPLOAD_VENTANILLA':

		$Servidor = ServidorTemp::Buscar(5, 0, "", 3);

		if (!$Servidor) {
			echo "No se encontro el servidor de archivo para esta dependencia, por favor consulte con el administador del sistema.";
			exit();
		}

		$IdRuta        = $Servidor->get_IdRuta();
		$Ip            = $Servidor->get_Ip();
		$Usuario       = $Servidor->get_Usua();
		$Contra        = $Servidor->get_Contra();
		$RutaFtp       = $Servidor->get_Ruta();
		$Radicado      = RadicadoInterno::Buscar(1, $IdRadica, "", "", "");
		$FechaRadicado = new DateTime($Radicado->get_FecRadica());
		$Ano           = $FechaRadicado->format('Y');

		$ftpObj = new FTPClient();
		//Connect
		$ftpObj->connect($Ip, $Usuario, $Contra);
		if ($ftpObj->pr($ftpObj->getMessages()[0]) == 'true') {

			$Extencion = Extencion_Archivo($ArchivoSubirNOMBRE);
			$Archivo   = "";

			$Ruta = "";
			if ($RutaFtp != "") {
				$Ruta = $Ano . "/" . $RutaFtp . "/" . $IdRadica;
				$ftpObj->makeDir($Ano . "/" . $RutaFtp);
				$ftpObj->makeDir($Ano . "/" . $RutaFtp . "/" . $IdRadica);
			} else {
				$Ruta = $Ano . "/" . $IdRadica;
				$ftpObj->makeDir($Ano);
				$ftpObj->makeDir($Ano . "/" . $RutaFtp . "/" . $IdRadica);
			}

			$Extencion = Extencion_Archivo($Archivo);
			$Archivo = $Ruta . "/" . $ArchivoSubirNOMBRE;

			$ftpObj->uploadFile($ArchivoSubirTMP, $Archivo);
			if ($ftpObj->pr($ftpObj->getMessages()[1]) == 'true') {
				$Radicado = new RadicadoInterno();
				$Radicado->set_Accion('EDITAR_RUTA');
				$Radicado->set_IdRadica($IdRadica);
				$Radicado->set_IdRuta($Servidor->get_IdRuta());
				$Radicado->set_Adjunto(1);
				$Radicado->Gestionar();

				$Archivo = new RadicadoInternoAdjuntos();
				$Archivo->set_Accion('INSERTAR_ARCHIVO');
				$Archivo->set_IdRadica($IdRadica);
				$Archivo->set_NomArchivo($ArchivoSubirNOMBRE);
				$Archivo->Gestionar();
				echo 1;
				exit();
			} else {
				echo "No fue posible enviar el archivo al servidor, por favor consulte con el administrador del sistema";
				exit();
			}
		} else {
			echo "No fue posible conectarme con el servidor de archivo….\nPor favor consulte con el administrador del sistema.";
			exit();
		}
		break;
	case 'INTERNO_DOWNLOAD':

		$Servidor = ServidorTemp::Buscar(5, 0, "", 3);

		if (!$Servidor) {
			echo "No se encontro el servidor de archivo para esta dependencia, por favor consulte con el administador del sistema.";
			exit();
		}

		$Ip            = $Servidor->get_Ip();
		$Usuario       = $Servidor->get_Usua();
		$Contra        = $Servidor->get_Contra();
		$RutaFtp       = $Servidor->get_Ruta();
		$Radicado      = RadicadoInterno::Buscar(1, $IdRadica, "", "", "");
		$FechaRadicado = new DateTime($Radicado->get_FecRadica());
		$Ano           = $FechaRadicado->format('Y');

		if (!is_dir(MI_ROOT_TEMP_RELATIVA . "/interna/"))
			mkdir(MI_ROOT_TEMP_RELATIVA . "/interna/", 0777);

		$ftpObj = new FTPClient();

		$ftpObj->connect($Ip, $Usuario, $Contra);
		if ($ftpObj->pr($ftpObj->getMessages()[0]) == 'true') {

			$Ruta = "";
			if ($RutaFtp != "") {
				$Ruta = $Ano . "/" . $RutaFtp . "/" . $IdRadica;
			} else {
				$Ruta = $Ano . "/" . $IdRadica;
			}

			$Archivo = $Ruta . "/" . $ArchivoInterno;

			$ftpObj->downloadFile(MI_ROOT_TEMP_RELATIVA . "/interna/" . $ArchivoInterno, $Archivo);
			if ($ftpObj->pr($ftpObj->getMessages()[0]) == "true") {
				echo 1;
				exit();
			}
		} else {
			echo "No fue posible conectarme con el servidor de archivo….\nPor favor consulte con el administrador del sistema.";
			exit();
		}
		break;
	case 'PLANTILLA_DESCARGAR':

		$Servidor = ServidorTemp::Buscar(5, 0, "", 4);

		if (!$Servidor) {
			echo "No se encontro el servidor de archivo para esta dependencia, por favor consulte con el administador del sistema.";
			exit();
		}

		$Ip            = $Servidor->get_Ip();
		$Usuario       = $Servidor->get_Usua();
		$Contra        = $Servidor->get_Contra();
		$RutaFtp       = $Servidor->get_Ruta();
		$Radicado      = RadicadoEnviadoTemp::Buscar(1, $IdRadica, "");
		$FechaRadicado = new DateTime($Radicado->get_FecHorRegistro());
		$Ano           = $FechaRadicado->format('Y');

		if (!is_dir(MI_ROOT_TEMP_RELATIVA . "/planillas_temporales/"))
			mkdir(MI_ROOT_TEMP_RELATIVA . "/planillas_temporales/", 0777);

		$ftpObj = new FTPClient();
		//Connect

		$ftpObj->connect($Ip, $Usuario, $Contra);
		if ($ftpObj->pr($ftpObj->getMessages()[0]) == 'true') {

			$Ruta = "";
			if ($RutaFtp != "") {
				$Ruta = $Ano . "/" . $RutaFtp;
				$ftpObj->makeDir($Ano . "/" . $RutaFtp);
			} else {
				$Ruta = $Ano;
				$ftpObj->makeDir($Ano);
			}

			$Archivo = $Ruta . "/" . $NombrePlantilla;

			$ftpObj->downloadFile(MI_ROOT_TEMP_RELATIVA . "/planillas_temporales/" . utf8_decode($NombrePlantilla), $Archivo);
			if ($ftpObj->pr($ftpObj->getMessages()[0]) == 'true') {
				echo 1;
				exit();
			} else {
				echo "No fue posible descargar el archivo o el arhivo non existe";
				exit();
			}
		} else {
			echo "No fue posible conectarme con el servidor de archivo….\nPor favor consulte con el administrador del sistema.";
			exit();
		}
		break;
	case 'PLANTILLA_SUBIR':

		$Servidor = ServidorTemp::Buscar(5, 0, "", 4);

		if (!$Servidor) {
			echo "No se encontro el servidor de archivo para esta dependencia, por favor consulte con el administador del sistema.";
			exit();
		}

		$Ip            = $Servidor->get_Ip();
		$Usuario       = $Servidor->get_Usua();
		$Contra        = $Servidor->get_Contra();
		$RutaFtp       = $Servidor->get_Ruta();
		$Radicado      = RadicadoEnviadoTemp::Buscar(1, $IdTemp, "");
		$FechaRadicado = new DateTime($Radicado->get_FecHorRegistro());
		$Ano           = $FechaRadicado->format('Y');

		$ftpObj = new FTPClient();
		//Connect

		$ftpObj->connect($Ip, $Usuario, $Contra);
		if ($ftpObj->pr($ftpObj->getMessages()[0]) == 'true') {

			$Ruta = "";
			if ($RutaFtp != "") {
				$Ruta = $Ano . "/" . $RutaFtp;
				$ftpObj->makeDir($Ano . "/" . $RutaFtp);
			} else {
				$Ruta = $Ano;
				$ftpObj->makeDir($Ano);
			}

			$Archivo = $Ruta . "/" . $ArchivoSubirNOMBRE;

			$ftpObj->uploadFile($ArchivoSubirTMP, $Archivo);
			if ($ftpObj->pr($ftpObj->getMessages()[1]) == 'true') {
				//ESTABLEZCO EL NUMERO DE PAGINAS DEL ARCHIVO DIGITAL
				//$NumPaginas = NumeroPaginasPdf($ArchivoSubirTMP);
				echo "1-" . $Servidor->get_IdRuta();
				exit();
			} else {
				echo "No fue posible enviar el archivo al servidor, por favor consulte con el administrador del sistema";
				exit();
			}
		} else {
			echo "No fue posible conectarme con el servidor de archivo...\nPor favor consulte con el administrador del sistema.";
			exit();
		}
		break;
	case 'DESCARGAR_ARCHIVO_EXPEDIENTE_DIGITAL_TRD':

		include "../clases/configuracion/class.ConfigServidor_Digitalizacion.php";
		include "../clases/oficina_archivo/class.OficinaArchivoDigitalizacionTRDArchivos.php";
		include "../clases/oficina_archivo/class.OficinaArchivoDigitalizacionTRDTomo.php";

		$ArchivoDigital = DigitalizacionTRDArchivos::Buscar(1, $IdArchivoDigital, "", "", "", "");
		$Tomo           = DigitalizacioTRDTomo::Buscar(1, $ArchivoDigital->get_IdTomo(), "", "");
		$Archivo        = $IdArchivoDigital . "." . Extencion_Archivo($ArchivoDigital->get_Archivo());

		$Servidor = ServidorDigitalizacion::Buscar(2, $IdRuta, "");
		$IdRuta        = $Servidor->get_IdRuta();
		$Ip            = $Servidor->get_Servidor();
		$Usuario       = $Servidor->get_Usua();
		$Contra        = $Servidor->get_Contra();
		$RutaFtp       = $Servidor->get_Ruta();

		if (!is_dir(MI_ROOT_TEMP_RELATIVA . "/expedientes/"))
			mkdir(MI_ROOT_TEMP_RELATIVA . "/expedientes/", 0777);

		if (!is_dir(MI_ROOT_TEMP_RELATIVA . "/expedientes/" . $IdDigital))
			mkdir(MI_ROOT_TEMP_RELATIVA . "/expedientes/" . $IdDigital, 0777);

		if (!is_dir(MI_ROOT_TEMP_RELATIVA . "/expedientes/" . $IdDigital . "/" . $Tomo->get_NomTomo()))
			mkdir(MI_ROOT_TEMP_RELATIVA . "/expedientes/" . $IdDigital . "/" . $Tomo->get_NomTomo(), 0777);

		$ftpObj = new FTPClient();

		//Connect
		$ftpObj->connect($Ip, $Usuario, $Contra);
		if ($ftpObj->pr($ftpObj->getMessages()[0]) == 'true') {

			$RutaArchivo = $Servidor->get_Ruta() . "/" . $IdDigital . "/" . $Tomo->get_NomTomo() . "/" . $Archivo;

			$ftpObj->downloadFile(MI_ROOT_TEMP_RELATIVA . "/expedientes/" . $IdDigital . "/" . $Tomo->get_NomTomo() . "/" . $ArchivoDigital->get_Archivo(), $RutaArchivo);
			if ($ftpObj->pr($ftpObj->getMessages()[0]) == 'true') {
				echo "1-" . $Tomo->get_NomTomo();
				exit();
			} else {
				echo "No fue posible descargar el archivo o el arhivo non existe";
				exit();
			}
		} else {
			echo "No fue posible conectarme con el servidor de archivo….\nPor favor consulte con el administrador del sistema.";
			exit();
		}
		break;
	case 'DESCARGAR_ARCHIVO_EXPEDIENTE_DIGITAL_TVD':

		include "../clases/configuracion/class.ConfigServidor_Digitalizacion.php";
		include "../clases/oficina_archivo/class.OficinaArchivoDigitalizacionTVDArchivos.php";
		include "../clases/oficina_archivo/class.OficinaArchivoDigitalizacionTVDTomo.php";

		$ArchivoDigital = DigitalizacionTVDArchivos::Buscar(1, $IdArchivoDigital, "", "", "", "");
		$Tomo           = DigitalizacioTVDTomo::Buscar(1, $IdTomo, "", "");
		$Archivo        = $IdArchivoDigital . "." . Extencion_Archivo($ArchivoDigital->get_Archivo());

		$Servidor = ServidorDigitalizacion::Buscar(4, $IdRuta, "");
		$IdRuta        = $Servidor->get_IdRuta();
		$Ip            = $Servidor->get_Servidor();
		$Usuario       = $Servidor->get_Usua();
		$Contra        = $Servidor->get_Contra();
		$RutaFtp       = $Servidor->get_Ruta();

		if (!is_dir(MI_ROOT_TEMP_RELATIVA . "/expedientes/"))
			mkdir(MI_ROOT_TEMP_RELATIVA . "/expedientes/", 0777);

		if (!is_dir(MI_ROOT_TEMP_RELATIVA . "/expedientes/" . $IdDigital))
			mkdir(MI_ROOT_TEMP_RELATIVA . "/expedientes/" . $IdDigital, 0777);

		if (!is_dir(MI_ROOT_TEMP_RELATIVA . "/expedientes/" . $IdDigital . "/" . $Tomo->get_NomTomo()))
			mkdir(MI_ROOT_TEMP_RELATIVA . "/expedientes/" . $IdDigital . "/" . $Tomo->get_NomTomo(), 0777);

		$ftpObj = new FTPClient();

		//Connect
		$ftpObj->connect($Ip, $Usuario, $Contra);
		if ($ftpObj->pr($ftpObj->getMessages()[0]) == 'true') {

			$RutaArchivo = $Servidor->get_Ruta() . "/" . $IdDigital . "/" . $Tomo->get_NomTomo() . "/" . $Archivo;

			$ftpObj->downloadFile(MI_ROOT_TEMP_RELATIVA . "/expedientes/" . $IdDigital . "/" . $Tomo->get_NomTomo() . "/" . $ArchivoDigital->get_Archivo(), $RutaArchivo);
			if ($ftpObj->pr($ftpObj->getMessages()[0]) == 'true') {
				echo "1-" . $Tomo->get_NomTomo();
				exit();
			} else {
				echo "No fue posible descargar el archivo o el arhivo non existe";
				exit();
			}
		} else {
			echo "No fue posible conectarme con el servidor de archivo….\nPor favor consulte con el administrador del sistema.";
			exit();
		}
		break;
	case 'RECIBIDOS_PQR_UPLOAD':

		$Servidor = ServidorTemp::Buscar(5, 0, "", 1);

		if (!$Servidor) {
			echo "No se encontro el servidor de archivo para esta dependencia, por favor consulte con el administador del sistema.";
			exit();
		}

		$IdRuta        = $Servidor->get_IdRuta();
		$Ip            = $Servidor->get_Ip();
		$Usuario       = $Servidor->get_Usua();
		$Contra        = $Servidor->get_Contra();
		$RutaFtp       = $Servidor->get_Ruta();
		$Radicado      = RadicadoRecibido::Buscar(1, $IdRadica, "", "", "", "");
		$FechaRadicado = new DateTime($Radicado->get_FecRadica());
		$Ano           = $FechaRadicado->format('Y');

		$ftpObj = new FTPClient();
		//Connect
		/* echo $Ip . " - " . $Usuario . " - " . $Contra;
		exit(); */
		$ftpObj->connect($Ip, $Usuario, $Contra);
		if ($ftpObj->pr($ftpObj->getMessages()[0]) == 'true') {

			$Ruta = "";
			if ($RutaFtp != "") {
				$Ruta = $Ano . "/prq_adjuntos/"  . $IdRadica;
				$ftpObj->makeDir($Ano);
				$ftpObj->makeDir($Ano . "/prq_adjuntos");
				$ftpObj->makeDir($Ano . "/prq_adjuntos/" . $IdRadica);
			} else {
				$Ruta = $Ano . "/prq_adjuntos/" . $IdRadica;
				$ftpObj->makeDir($Ano);
				$ftpObj->makeDir($Ano . "/prq_adjuntos/" . $IdRadica);
			}

			foreach ($_FILES["archivo"]['tmp_name'] as $key => $tmp_name) {
				//Validamos que el archivo exista
				if ($_FILES["archivo"]["name"][$key]) {
					$filename = $_FILES["archivo"]["name"][$key]; //Obtenemos el nombre original del archivo
					$ArchivoSubirTMP = $_FILES["archivo"]["tmp_name"][$key];

					$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					$nomArchivoAleatorio = substr(str_shuffle($permitted_chars), 0, 45);

					$Extencion = Extencion_Archivo($filename);
					$Archivo = $Ruta . "/" . $nomArchivoAleatorio . " ." . $Extencion;

					$ftpObj->uploadFile($ArchivoSubirTMP, $Archivo);
					if ($ftpObj->pr($ftpObj->getMessages()[1]) == 'true') {

						//ESTABLEZCO EL NUMERO DE PAGINAS DEL ARCHIVO DIGITAL
						//$NumPaginas = NumeroPaginasPdf($ArchivoSubirTMP);
						//ESTABLEZCO QUE EL RADICADO YA FUE CARGADO
						$archivoPQR = new RadicadoRecibidoPQRSFAdjunto();
						$archivoPQR->set_Accion('INSERTAR');
						$archivoPQR->set_idPqr($IdPqr);
						$archivoPQR->set_nomArchivo($filename);
						$archivoPQR->set_nomTempArchivo($nomArchivoAleatorio . "." . $Extencion);
						if ($archivoPQR->Gestionar() == "true") {
							echo 1;
							exit();
						}
					} else {
						echo "No fue posible enviar el archivo al servidor, por favor consulte con el administrador del sistema";
						exit();
					}
				}
			}
		} else {
			echo "No fue posible conectarme con el servidor de archivo...\nPor favor consulte con el administrador del sistema.";
			exit();
		}
		break;
	case 'CALIDAD_UPLOAD':

		$Servidor = ServidorCalidad::Buscar(3, 0, "");

		if (!$Servidor) {
			echo "No se encontro el servidor de archivo para el proceso de calidad, por favor consulte con el administador del sistema.";
			exit();
		}

		$IdRuta        = $Servidor->get_IdRuta();
		$Ip            = $Servidor->get_Ip();
		$Usuario       = $Servidor->get_Usua();
		$Contra        = $Servidor->get_Contra();
		$RutaFtp       = $Servidor->get_Ruta();

		if (!$RutaFtp) {
			echo "No se encontro la ruta para almacenar los archivos el servidor para el proceso de calidad, por favor consulte con el administador del sistema.";
			exit();
		}

		$ftpObj = new FTPClient();
		$ftpObj->connect($Ip, $Usuario, $Contra);
		if ($ftpObj->pr($ftpObj->getMessages()[0]) == 'true') {

			$ftpObj->makeDir($RutaFtp);

			//Validamos que el archivo exista
			if ($_FILES["archivo"]["name"]) {
				$filename = $_FILES["archivo"]["name"]; //Obtenemos el nombre original del archivo
				$ArchivoSubirTMP = $_FILES["archivo"]["tmp_name"];

				$nomArchivo = nombreAleatorioArchivo($filename);
				$Archivo = $RutaFtp . "/" . $nomArchivo;

				$ftpObj->uploadFile($ArchivoSubirTMP, $Archivo);
				if ($ftpObj->pr($ftpObj->getMessages()[1]) == 'true') {

					//Actualizo el nombre origianl del archivo y el nombre unico
					$repositorio = new CalidadRepositorio();
					$repositorio->setAccion('ACTUALIZAR_NOMBRES_ARCHIVOS');
					$repositorio->setRutaId($IdRuta);
					$repositorio->setArchivoId($archivoId);
					$repositorio->setNomArchivoOriginal($_FILES["archivo"]["name"]);
					$repositorio->setNomArchivoUnico($nomArchivo);
					$repositorio->Gestionar();

					echo 1;
					exit();
				} else {
					echo "No fue posible enviar el archivo al servidor, por favor consulte con el administrador del sistema";
					exit();
				}
			}
		} else {
			echo "No fue posible conectarme con el servidor de archivo...\nPor favor consulte con el administrador del sistema.";
			exit();
		}
		break;
	case 'CALIDAD_DESCARGAR':

		$Servidor = ServidorCalidad::Buscar(2, $IdRuta, "");
		$Ip            = $Servidor->get_Ip();
		$Usuario       = $Servidor->get_Usua();
		$Contra        = $Servidor->get_Contra();
		$RutaFtp       = $Servidor->get_Ruta();

		if (!is_dir(MI_ROOT_TEMP_RELATIVA . "/calidad/"))
			mkdir(MI_ROOT_TEMP_RELATIVA . "/calidad/", 0777);

		$ftpObj = new FTPClient();

		//Connect
		$ftpObj->connect($Ip, $Usuario, $Contra);
		if ($ftpObj->pr($ftpObj->getMessages()[0]) == 'true') {
			$archivoParaDescargar = MI_ROOT_TEMP_RELATIVA . "/calidad/" . $_POST['nomArchivoOrigina'];
			$ftpObj->downloadFile($archivoParaDescargar,  $RutaFtp . "/" . $_POST['nomArchivoUnico']);
			if ($ftpObj->pr($ftpObj->getMessages()[0]) == 'true') {

				echo '1###' . $_POST['nomArchivoOrigina'];
				exit();
			} else {
				echo "No fue posible descargar el archivo o el arhivo no existe";
				exit();
			}
		} else {
			echo "No fue posible conectarme con el servidor de archivo….\nPor favor consulte con el administrador del sistema.";
			exit();
		}
		break;
	default:
		echo 'No hay accion para realizar por FTP';
}
ob_end_flush();
