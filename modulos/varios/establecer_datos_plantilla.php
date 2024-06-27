<?php
function Establecer_Datos_Plantilla($IdTemp)
{

	$ConfiguraOtras = ConfigOtras::Buscar();

	if ($ConfiguraOtras->get_PlantiCorrespon() == "") {
		echo "Iwana no encontró configuración alguna de la plantilla para descargar, por favor consulte con el administrador del sistema.";
	} elseif ($ConfiguraOtras->get_PlantiCorrespon() != "") {

		$MiEmpresa = MiEmpresa::Listar();

		$Ciudad = "";
		foreach ($MiEmpresa as $Item) {
			$Ciudad = $Item['nom_muni'];
		}

		//INICIO EL PROCESO DE GENERAR LA PLANTILLA
		$Status                    = "";
		$DestinaContacto           = "";
		$DestinaCargo              = "";
		$DestinaRazonSocial        = "";
		$DestinaDireccion          = "";
		$DestinaDomicilio          = "";
		$Asunto                    = "";
		$Saludo                    = "";
		$ConCopia                  = "";
		$Anexos                    = "";
		$Despedida                 = "";
		$FuncionariosQuienesFirman = "";
		$Aprobaron                 = "";
		$Proyector                 = "";
		$ClasificacionDocumental   = "";

		//EXTABLEZCO LOS FUNCIONARIOS QUE FIRMAN EL DOCUMENTO
		$FuncionariorFirman = RadicadoEnviadoTempQuienFirma::Listar(1, $IdTemp, "");
		foreach ($FuncionariorFirman as $Item) :
			$FuncionariosQuienesFirman .= $Item['nom_funcio'] . " " . $Item['ape_funcio'] . "<w:br />" . $Item['nom_cargo'] . "<w:br /><w:br />";
		endforeach;

		//EXTABLEZCO LOS FUNCIONARIOS RESPONSBLES DEL DOCUMENTO
		$FuncionariorQueAprueban = RadicadoEnviadoTempResponsable::Listar(2, $IdTemp, "");
		foreach ($FuncionariorQueAprueban as $Item) :
			$Aprobaron .= trim($Item['nom_funcio'] . " " . $Item['ape_funcio']) . " / ";
		endforeach;

		//EXTABLEZCO LOS DATOS DE LA PLANTILLA
		$Plantilla = RadicadoEnviadoTemp::Listar_Varios(1, $IdTemp, "", "", "", "", "", "", "");
		foreach ($Plantilla as $Item) :

			$Status           = $Item['status'];
			$DestinaContacto  = $Item['nom_contac'];
			$DestinaDireccion = $Item['dir_contac'];
			$DestinaDomicilio = $Item['nom_muni_contac'] . " - " . $Item['nom_depar_contac'];

			if ($Item['razo_soci'] != "") {
				$DestinaCargo       = $Item['cargo'];
				$DestinaRazonSocial = $Item['razo_soci'];
				$DestinaDireccion   = $Item['dir_empre'];
				$DestinaDomicilio   = $Item['nom_muni_empre'] . " " . $Item['nom_depar_empre'];
			}

			$Asunto    = $Item['asunto'];
			$ConCopia  = $Item['con_copia'];
			$Anexos    = $Item['anexos'];
			$Saludo    = $Item['saludo'];
			$Despedida = $Item['despedida'];
			$ClasificacionDocumental = $Item['cod_oficina_respon'] . "." . $Item['cod_serie'] . "." . $Item['cod_subserie'] . " " . $Item['nom_serie'] . "/" . $Item['nom_subserie'];
		endforeach;

		if ($Anexos == "") {
			$Anexos = "Ninguno";
		}

		if ($ConCopia == "") {
			$ConCopia = "Ninguno";
		}

		//ESTABLEZCO LOS PROYECTORES
		$FuncioProyector = "";
		$Proyectores = RadicadoEnviadoTempProyector::Listar(1, $IdTemp, "", "", "", "", "", "");
		if ($Proyectores) {
			foreach ($Proyectores as $Item) :
				$FuncioProyector .= trim($Item['nom_funcio']) . " " . trim($Item['ape_funcio']) . "";
			endforeach;
		} else {
			$FuncioProyector = "Ninguno";
		}

		//ACTUALIZO EL NOMBRE DEL ARCHIVO
		$Ojo = "";
		$NombrePlantilla = str_replace(",", "", str_replace("|", " ", str_replace(">", " ", str_replace("<", " ", str_replace('"', " ", str_replace("?", " ", str_replace("*", " ", str_replace(":", " ", str_replace("\\", " ", substr($Asunto, 0, 70))))))))));

		$Extencion = Extencion_Archivo($ConfiguraOtras->get_PlantiCorrespon());
		$Temp = new RadicadoEnviadoTemp();
		$Temp->set_Accion('ACTUALIZA_NOM_ARCHIVO');
		$Temp->set_IdTemp($IdTemp);
		$Temp->set_NomArchivo($IdTemp . ' - ' . $NombrePlantilla . "." . $Extencion);
		$Temp->Gestionar();

		echo "1******" . $IdTemp . "******" . $Ciudad . "******" . $Status . "******" . $DestinaContacto . "******" . $DestinaCargo . "******" . $DestinaRazonSocial . "******" . utf8_encode($DestinaDireccion) . "******" . utf8_encode($DestinaDomicilio) . "******" . $Asunto . "******" . $Saludo . "******" . $Despedida . "******" . $FuncionariosQuienesFirman . "******" . $Anexos . "******" . $ConCopia . "******" . $Aprobaron . "******" . $FuncioProyector . "******" . $ClasificacionDocumental;
		exit();
	}
}
