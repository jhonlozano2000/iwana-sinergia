<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

	require_once '../../../../config/class.Conexion.php';
	require_once '../../../../config/funciones.php';
	require_once '../../../clases/oficina_archivo/class.OficinaArchivoDigitalizacionTRD.php';
	require_once '../../../clases/oficina_archivo/class.OficinaArchivoDigitalizacionTRDArchivos.php';
	require_once '../../../clases/oficina_archivo/class.OficinaArchivoDigitalizacionTRDTomo.php';
	require_once '../../../clases/configuracion/class.ConfigServidor_Digitalizacion.php';
	require_once '../../../clases/varias/class.ftp.php';

	$Accion        = isset($_POST['accion']) ? $_POST['accion'] : null;
	$IdDigital     = isset($_POST['id_digital']) ? $_POST['id_digital'] : null;
	$IdDependencia = isset($_POST['id_depen']) ? $_POST['id_depen'] : null;
	$IdTomo        = isset($_POST['id_tomo']) ? $_POST['id_tomo'] : 0;
	$IdOficina     = isset($_POST['id_oficina']) ? $_POST['id_oficina'] : null;
	$IdSerie       = isset($_POST['id_serie']) ? $_POST['id_serie'] : null;
	$IdSubSerie    = isset($_POST['id_subserie']) ? $_POST['id_subserie'] : null;
	$Codigo        = isset($_POST['codigo']) ? $_POST['codigo'] : null;
	$Titulo        = isset($_POST['titulo']) ? $_POST['titulo'] : null;
	$FechaInicio   = isset($_POST['fec_ini']) ? $_POST['fec_ini'] : null;
	$FechaFin      = isset($_POST['fec_fin']) ? $_POST['fec_fin'] : null;
	$Criterio1     = isset($_POST['criterio1']) ? $_POST['criterio1'] : null;
	$Criterio2     = isset($_POST['criterio2']) ? $_POST['criterio2'] : null;
	$Criterio3     = isset($_POST['criterio3']) ? $_POST['criterio3'] : null;
	$Deposito      = isset($_POST['deposito']) ? $_POST['deposito'] : null;
	$Caja          = isset($_POST['caja']) ? $_POST['caja'] : null;
	$Carpeta       = isset($_POST['carpeta']) ? $_POST['carpeta'] : null;
	$FoliosExpediente = isset($_POST['folios_expedientes']) ? $_POST['folios_expedientes'] : 0;
	if ($FoliosExpediente === "") {
		$FoliosExpediente = 0;
	}
	$Acti             = isset($_POST['acti']) ? $_POST['acti'] : null;
	//VARIABLES PARA DESCRGAR ARCHIVOS DIGITALES
	$IdRuta             = isset($_POST['id_ruta']) ? $_POST['id_ruta'] : null;
	$IdDigital          = isset($_POST['id_digital']) ? $_POST['id_digital'] : null;
	$IdArchivoDigital   = isset($_POST['id_archivo']) ? $_POST['id_archivo'] : null;
	$ArchivoDigital     = isset($_POST['archivo']) ? $_POST['archivo'] : null;
	$TipoArchivoDigital = isset($_POST['tipo_archivo']) ? $_POST['tipo_archivo'] : null;

	switch ($Accion) {
		case 'NUEVO_EXPEDIENTE':
			/*
			$BuscarExpediente = Digitalizacion::Buscar(2, $IdDigital, $IdDependencia, $IdSerie, $IdSubSerie, $Codigo, "", "", "", "");
			if($BuscarExpediente){
				echo "2-El código '".$Codigo."' ya se registró para esta serie.";
				exit();
			}
			*/
			$Digitalizado = new DigitalizacionTRD();
			$Digitalizado->set_Accion($Accion);
			$Digitalizado->set_IdDigital($IdDigital);
			$Digitalizado->set_IdDependencia($IdDependencia);
			$Digitalizado->set_IdOficina($IdOficina);
			$Digitalizado->set_IdSerie($IdSerie);
			$Digitalizado->set_IdSubSerie($IdSubSerie);
			$Digitalizado->set_Codigo($Codigo);
			$Digitalizado->set_Titulo($Titulo);
			$Digitalizado->set_FechaInicio($FechaInicio);
			$Digitalizado->set_FechaFin($FechaFin);
			$Digitalizado->set_Criterio1($Criterio1);
			$Digitalizado->set_Criterio2($Criterio2);
			$Digitalizado->set_Criterio3($Criterio3);
			$Digitalizado->set_Deposito($Deposito);
			$Digitalizado->set_Caja($Caja);
			$Digitalizado->set_Carpeta($Carpeta);
			$Digitalizado->set_Folios($FoliosExpediente);
			$Digitalizado->set_Acti($Acti);
			if ($Digitalizado->Gestionar() == true) {

				$IdDigital = $Digitalizado->get_IdDigital();

				/********************************************************************************
				/* CREO EL PRIMER TOMO
				/********************************************************************************/
				$TotalTomo = DigitalizacioTRDTomo::Listar(1, "", $Digitalizado->get_IdDigital(), "");
				$NomTomo = $TotalTomo['TotalTomos'] + 1;
				$Tomo = new DigitalizacioTRDTomo();
				$Tomo->set_Accion('INSERTAR_TOMO');
				$Tomo->set_IdDigital($IdDigital);
				$Tomo->set_NomTomo($NomTomo);
				$Tomo->Gestionar();
				$IdTomo = $Tomo->get_IdTomo();

				$Servidor = ServidorDigitalizacion::Buscar(3, 0, "", "");
				if (!$Servidor) {
					echo "No se encontro ruta del repositorio documental para los expendientes, por favor consulte con el administrador del sistema.";
					exit();
				}
				$IdRuta   = $Servidor->get_IdRuta();
				$Ip       = $Servidor->get_Servidor();
				$Usuario  = $Servidor->get_Usua();
				$Contra   = $Servidor->get_Contra();
				$RutaFtp  = $Servidor->get_Ruta();

				require_once '../../../clases/varias/class.ftp.php';
				$ftpObj = new FTPClient();

				$ftpObj->connect($Ip, $Usuario, $Contra);
				if ($ftpObj->pr($ftpObj->getMessages()[0]) == 'true') {

					/********************************************************************************
					/* SUBO LOS ARCHIVOS POR TIPO DOCUMENTAL
					/********************************************************************************/
					if (count($_FILES["file"]["name"]) > 0) {

						//CREO LA CARPETA EN DONDE SE ALMACENARAN LOS ARCHIVOS DIGITALIZADOS
						$RutaDigitales = $RutaFtp . "/" . $Digitalizado->get_IdDigital();
						$ftpObj->makeDir($RutaFtp);
						$ftpObj->makeDir($RutaDigitales);
						$ftpObj->makeDir($RutaDigitales . "/" . $NomTomo);

						$DigitalArchivos = new DigitalizacionTRDArchivos();

						for ($x = 0; $x <= count($_FILES["file"]["name"]) - 1; $x++) {

							$file             = $_FILES["file"];
							$nombre           = $file["name"][$x];
							$tipo             = $file["type"][$x];
							$ruta_provisional = $file["tmp_name"][$x];
							$size             = $file["size"][$x];
							$extension        = Extencion_Archivo($nombre);

							if ($nombre != "") {

								if ($_POST["folios_archi"][$x] === "") {
									$FolioArchi = 0;
								} else {
									$FolioArchi = $_POST["folios_archi"][$x];
								}

								$DetalleArchi = $_POST["detalle_archi"][$x];
								$FechaArchi   = $_POST["fecha_archi"][$x];
								$IdTipoDocu   = $_POST["id_tipodoc"][$x];

								$DigitalArchivos->set_Accion("INSERTAR_ARCHIVO");
								$DigitalArchivos->set_IdDigital($Digitalizado->get_IdDigital());
								$DigitalArchivos->set_IdTomo($IdTomo);
								$DigitalArchivos->set_IdRuta($IdRuta);
								$DigitalArchivos->set_IdTipoDocu($IdTipoDocu);
								if ($DigitalArchivos->Gestionar() == true) {

									$ftpObj->uploadFile($ruta_provisional, $RutaDigitales . "/" . $NomTomo . "/" . $DigitalArchivos->get_IdArchivo() . "." . $extension);
									if ($ftpObj->pr($ftpObj->getMessages()[1]) == true) {

										$DigitalArchivos->set_Accion("ACTUALIZAR_ARCHIVO");
										$DigitalArchivos->set_IdArchivo($DigitalArchivos->get_IdArchivo());
										$DigitalArchivos->set_IdTipoDocu($IdTipoDocu);
										$DigitalArchivos->set_Archivo($nombre);
										$DigitalArchivos->set_Folios($FolioArchi);
										$DigitalArchivos->set_Detalle($DetalleArchi);
										$DigitalArchivos->set_Fecha($FechaArchi);
										$DigitalArchivos->set_Tipo('Lista de Checkeo');
										$DigitalArchivos->Gestionar();
									}
								}
							}
						}
					}

					/********************************************************************************
					/* SUBO LOS ARCHIVOS COMO UN TODO
					/********************************************************************************/
					if ($_FILES["file_como_un_todo"]["name"] != "") {

						$RutaDigitales = $RutaFtp . "/" . $Digitalizado->get_IdDigital();
						$ftpObj->makeDir($RutaDigitales);
						$ftpObj->makeDir($RutaDigitales . "/" . $NomTomo);

						$file             = $_FILES["file_como_un_todo"];
						$nombre           = $file["name"];
						$tipo             = $file["type"];
						$ruta_provisional = $file["tmp_name"];
						$size             = $file["size"];
						$extension        = Extencion_Archivo($nombre);

						if ($_POST["folios_archi_como_un_todo"] === "") {
							$FolioArchi = 0;
						} else {
							$FolioArchi   = $_POST["folios_archi_como_un_todo"];
						}

						$DetalleArchi = $_POST["detalle_archi_como_un_todo"];
						$FechaArchi   = $_POST["fecha_archi_como_un_todo"];

						$DigitalArchivos = new DigitalizacionTRDArchivos();
						$DigitalArchivos->set_Accion("INSERTAR_ARCHIVO");
						$DigitalArchivos->set_IdDigital($Digitalizado->get_IdDigital());
						$DigitalArchivos->set_IdTomo($IdTomo);
						$DigitalArchivos->set_IdRuta($IdRuta);
						if ($DigitalArchivos->Gestionar() == true) {

							$ftpObj->uploadFile($ruta_provisional, $RutaDigitales . "/" . $NomTomo . "/" . $DigitalArchivos->get_IdArchivo() . "." . $extension);
							if ($ftpObj->pr($ftpObj->getMessages()[1]) == true) {
								$DigitalArchivos->set_Accion("ACTUALIZAR_ARCHIVO");
								$DigitalArchivos->set_IdArchivo($DigitalArchivos->get_IdArchivo());
								$DigitalArchivos->set_Archivo($nombre);
								$DigitalArchivos->set_Folios($FolioArchi);
								$DigitalArchivos->set_Detalle($DetalleArchi);
								$DigitalArchivos->set_Fecha($FechaArchi);
								$DigitalArchivos->set_Tipo('Como un todo');
								$DigitalArchivos->Gestionar();
							}
						}
					}

					echo "1-" . $Digitalizado->get_IdDigital() . "-" . $IdTomo;
					exit();
				} else {
					echo "Iwana no se pudo conectar con el servidor de archivos digitalizados, por favor consulte con el administrador del sistema";
					exit();
				}
			}
			break;
		case 'SUBIR_ARCHIVOS':

			$Digitalizado = new DigitalizacionTRD();
			$Digitalizado->set_Accion('EDITAR_EXPEDIENTE');
			$Digitalizado->set_IdDigital($IdDigital);
			$Digitalizado->set_Codigo($Codigo);
			$Digitalizado->set_Titulo($Titulo);
			$Digitalizado->set_FechaInicio($FechaInicio);
			$Digitalizado->set_FechaFin($FechaFin);
			$Digitalizado->set_Criterio1($Criterio1);
			$Digitalizado->set_Criterio2($Criterio2);
			$Digitalizado->set_Criterio3($Criterio3);
			$Digitalizado->set_Acti($Acti);
			if ($Digitalizado->Gestionar() == true) {

				$Servidor = ServidorDigitalizacion::Buscar(3, 0, "", "");
				$IdRuta   = $Servidor->get_IdRuta();
				$RutaFtp  = $Servidor->get_Ruta();

				require_once '../../../clases/varias/class.ftp.php';
				$ftpObj = new FTPClient();

				//Connect
				$ftpObj->connect($Servidor->get_Servidor(), $Servidor->get_Usua(), $Servidor->get_Contra());

				if ($ftpObj->pr($ftpObj->getMessages()[0]) == "true") {

					/********************************************************************************
					/* SUBO LOS ARCHIVOS POR TIPO DOCUMENTAL
					/********************************************************************************/
					if (count($_FILES["file"]["name"]) > 0) {

						$DigitalArchivos = new DigitalizacionTRDArchivos();
						$Tomo = DigitalizacioTRDTomo::Buscar(1, $IdTomo, "", "");

						$RutaDigitales = $RutaFtp . "/" . $IdDigital . "/" . $Tomo->get_NomTomo();
						$ftpObj->makeDir($RutaDigitales);

						for ($x = 0; $x <= count($_FILES["file"]["name"]) - 1; $x++) {

							$file             = $_FILES["file"];
							$nombre           = $file["name"][$x];
							$tipo             = $file["type"][$x];
							$ruta_provisional = $file["tmp_name"][$x];
							$size             = $file["size"][$x];
							$extension        = Extencion_Archivo($nombre);

							if ($nombre != "") {

								if ($_POST["folios_archi"][$x] === "") {
									$FolioArchi = 0;
								} else {
									$FolioArchi   = $_POST["folios_archi"][$x];
								}

								$DetalleArchi = $_POST["detalle_archi"][$x];
								$FechaArchi   = $_POST["fecha_archi"][$x];
								$IdTipoDocu   = $_POST["id_tipodoc"][$x];

								$DigitalArchivos->set_Accion("INSERTAR_ARCHIVO");
								$DigitalArchivos->set_IdDigital($IdDigital);
								$DigitalArchivos->set_IdTomo($IdTomo);
								$DigitalArchivos->set_IdRuta($IdRuta);
								$DigitalArchivos->set_IdTipoDocu($IdTipoDocu);
								if ($DigitalArchivos->Gestionar() == true) {

									$ftpObj->uploadFile($ruta_provisional, $RutaDigitales . "/" . $DigitalArchivos->get_IdArchivo() . "." . $extension);
									if ($ftpObj->pr($ftpObj->getMessages()[1]) == true) {

										$DigitalArchivos->set_Accion("ACTUALIZAR_ARCHIVO");
										$DigitalArchivos->set_IdArchivo($IdDigital);
										$DigitalArchivos->set_IdTipoDocu($IdTipoDocu);
										$DigitalArchivos->set_Archivo($nombre);
										$DigitalArchivos->set_Folios($FolioArchi);
										$DigitalArchivos->set_Detalle($DetalleArchi);
										$DigitalArchivos->set_Fecha($FechaArchi);
										$DigitalArchivos->set_Tipo('Lista de Checkeo');
										$DigitalArchivos->Gestionar();
									}
								}
							}
						}
					}


					/********************************************************************************
					/* SUBO LOS ARCHIVOS COMO UN TODO
					/********************************************************************************/
					if ($_FILES["file_como_un_todo"]["name"] != "") {

						$RutaDigitales = $RutaFtp . "/" . $IdDigital;
						$ftpObj->makeDir($RutaDigitales);
						$ftpObj->makeDir($RutaDigitales . "/" . $Tomo->get_NomTomo());

						$file             = $_FILES["file_como_un_todo"];
						$nombre           = $file["name"];
						$tipo             = $file["type"];
						$ruta_provisional = $file["tmp_name"];
						$size             = $file["size"];
						$extension        = Extencion_Archivo($nombre);

						if ($_POST["folios_archi_como_un_todo"] === "") {
							$FolioArchi = 0;
						} else {
							$FolioArchi   = $_POST["folios_archi_como_un_todo"];
						}

						$DetalleArchi = $_POST["detalle_archi_como_un_todo"];
						$FechaArchi   = $_POST["fecha_archi_como_un_todo"];

						$DigitalArchivos = new DigitalizacionTRDArchivos();
						$DigitalArchivos->set_Accion("INSERTAR_ARCHIVO");
						$DigitalArchivos->set_IdDigital($IdDigital);
						$DigitalArchivos->set_IdTomo($IdTomo);
						$DigitalArchivos->set_IdRuta($IdRuta);
						if ($DigitalArchivos->Gestionar() == true) {

							$ftpObj->uploadFile($ruta_provisional, $RutaDigitales . "/" . $Tomo->get_NomTomo() . "/" . $DigitalArchivos->get_IdArchivo() . "." . $extension);
							if ($ftpObj->pr($ftpObj->getMessages()[1]) == true) {
								$DigitalArchivos->set_Accion("ACTUALIZAR_ARCHIVO");
								$DigitalArchivos->set_IdArchivo($DigitalArchivos->get_IdArchivo());
								$DigitalArchivos->set_Archivo($nombre);
								$DigitalArchivos->set_Folios($FolioArchi);
								$DigitalArchivos->set_Detalle($DetalleArchi);
								$DigitalArchivos->set_Fecha($FechaArchi);
								$DigitalArchivos->set_Tipo('Como un todo');
								$DigitalArchivos->Gestionar();
							}
						}
					}

					echo "1";
				} else {
					echo "Iwana no pudo crear el repositorio de archivos, por favor consulte con el administrador del sistema.";
				}
			}
			break;
		case 'ELIMINAR_DIGITAL':

			$Servidor = ServidorDigitalizacion::Buscar(2, $IdRuta, "");
			$Ip       = $Servidor->get_Servidor();
			$Usuario  = $Servidor->get_Usua();
			$Contra   = $Servidor->get_Contra();
			$RutaFtp  = $Servidor->get_Ruta();

			$ArchivParaEliminar = "";
			if ($TipoArchivoDigital == 'Lista de Checkeo') {
				$ArchivParaEliminar = $RutaFtp . "/" . $IdDigital . "/" . $ArchivoDigital;
			} else {
				$ArchivParaEliminar = $RutaFtp . "/" . $IdDigital . "/como_un_todo/" . $ArchivoDigital;
			}

			$ftpObj = new FTPClient();
			$ftpObj->connect($Ip, $Usuario, $Contra);
			if ($ftpObj->pr($ftpObj->getMessages()[0]) == 'true') {
				$ftpObj->deleteFile($ArchivParaEliminar);
				if ($ftpObj->pr($ftpObj->getMessages()[0]) == 'true') {

					DigitalizacionTRD::Gestionar_Archivos(2, $IdArchivoDigital, "", "", "", "", "", "", "", "", "");

					echo 1;
					exit();
				} else {
					echo "No fue posible descargar el archivo o el arhivo non existe";
					exit();
				}
			}
			break;
		case 'NUEVO_TOMO':
			$TotalTomo = DigitalizacioTRDTomo::Listar(1, "", $IdDigital, "");

			$Tomo = new DigitalizacioTRDTomo();
			$Tomo->set_Accion('INSERTAR_TOMO');
			$Tomo->set_IdDigital($IdDigital);
			$Tomo->set_NomTomo($TotalTomo['TotalTomos'] + 1);
			if ($Tomo->Gestionar() == true) {
				echo "1-" . $Tomo->get_IdTomo();
			}
			break;
		default:
			echo 'No hay accion para realizar.' . $Accion;
			break;
	}
}
