<?php
ob_start();
session_start();
set_time_limit(0);
include "../../../../config/class.Conexion.php";
include "../../../../config/funciones.php";
include "../../../../config/variable.php";
require('../../../../config/lib/fpdf/fpdf.php');
include "../../../../config/funciones_seguridad.php";
include_once "../../../clases/reportes/radica/class.ReportRadicacionRecibido.php";
require_once '../../../clases/configuracion/class.ConfigMiEmpresa.php';
require('mc_table_enviada.php');

$pdf=new PDF_MC_Table('L', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial','',8);
$pdf->AliasNbPages();

//set document properties
$pdf->SetAuthor('...::: Iwana :::...');
$pdf->SetTitle('Ventanilla -> Reporte detallado correspondencia enviada.');

//Establecemos los márgenes izquierda, arriba y derecha: 
//$pdf->SetMargins(10, 7 , 5); 
//Establecemos el margen inferior: 
///$pdf->SetAutoPageBreak(true, 15); 

$OrigenCorrespon      = isset($_REQUEST['origen_correspon']) ? $_REQUEST['origen_correspon'] : null;
$FecDesde             = isset($_REQUEST['desde']) ? Convertir_Fecha_A_Mysql($_REQUEST['desde']) : null;
$FecHasta             = isset($_REQUEST['hasta']) ? Convertir_Fecha_A_Mysql($_REQUEST['hasta']) : null;
$IdTercero            = isset($_REQUEST['id_tercero']) ? $_REQUEST['id_tercero'] : null;
$TipoTercer           = isset($_REQUEST['tipo_tercero']) ? $_REQUEST['tipo_tercero'] : null;
$IdFuncionario        = isset($_REQUEST['id_funcionario']) ? $_REQUEST['id_funcionario'] : null;
$IdDestina            = isset($_REQUEST['id_destinatario']) ? $_REQUEST['id_destinatario'] : null;
$IdDepen              = isset($_REQUEST['id_depen']) ? $_REQUEST['id_depen'] : null;
$IdSerie              = isset($_REQUEST['id_serie']) ? $_REQUEST['id_serie'] : null;
$IdSubSerie           = isset($_REQUEST['id_subserie']) ? $_REQUEST['id_subserie'] : null;
$IdTipoDoc            = isset($_REQUEST['id_tipodoc']) ? $_REQUEST['id_tipodoc'] : null;

$VerRadicado          = isset($_REQUEST['ChkRadicado']) ? $_REQUEST['ChkRadicado'] : null;
$VerTercero           = isset($_REQUEST['ChkTercero']) ? $_REQUEST['ChkTercero'] : null;
$VerFuncionario       = isset($_REQUEST['ChkFuncionario']) ? $_REQUEST['ChkFuncionario'] : null;
$VerFechaHoraRadica   = isset($_REQUEST['ChkFechaHoraRadica']) ? $_REQUEST['ChkFechaHoraRadica'] : null;
$VerFechaDocumento    = isset($_REQUEST['ChkFechaDocumento']) ? $_REQUEST['ChkFechaDocumento'] : null;
$VerFechaVencimiento  = isset($_REQUEST['ChkFechaVencimiento']) ? $_REQUEST['ChkFechaVencimiento'] : null;
$VerAsunto            = isset($_REQUEST['ChkAsunto']) ? $_REQUEST['ChkAsunto'] : null;
$VerDependencia       = isset($_REQUEST['ChkDependencia']) ? $_REQUEST['ChkDependencia'] : null;
$VerOficina           = isset($_REQUEST['ChkOficina']) ? $_REQUEST['ChkOficina'] : null;
$VerSerie             = isset($_REQUEST['ChkSerie']) ? $_REQUEST['ChkSerie'] : null;
$VerSubSerie          = isset($_REQUEST['ChkSubSerie']) ? $_REQUEST['ChkSubSerie'] : null;
$VerTipoDocumento     = isset($_REQUEST['ChkTipoDocumento']) ? $_REQUEST['ChkTipoDocumento'] : null;
$VerRadicadoRespuesta = isset($_REQUEST['ChkRadicadoRespuesta']) ? $_REQUEST['ChkRadicadoRespuesta'] : null;
$VerAsuntoRespuesta   = isset($_REQUEST['ChkAsuntoRespuesta']) ? $_REQUEST['ChkAsuntoRespuesta'] : null;
$VerFecHorRespuesta   = isset($_REQUEST['ChkFecHorRespuesta']) ? $_REQUEST['ChkFecHorRespuesta'] : null;

	$DatosTamanoColumna = array();
	$i                  =0;

	if($VerRadicado === 'true'){
		$DatosTamanoColumna[$i++] = 30;
	}

	if($VerTercero === 'true'){
		$DatosTamanoColumna[$i++] = 40;
	}

	if($VerFuncionario === 'true'){
		$DatosTamanoColumna[$i++] = 40;
	}

	if($VerFechaHoraRadica === 'true'){
		$DatosTamanoColumna[$i++] = 30;
	}

	if($VerFechaDocumento === 'true'){
		$DatosTamanoColumna[$i++] = 20;
	}

	if($VerFechaVencimiento === 'true'){
		$DatosTamanoColumna[$i++] = 20;
	}

	if($VerAsunto === 'true'){
		$DatosTamanoColumna[$i++] = 40;
	}

	if($VerDependencia === 'true'){
		$DatosTamanoColumna[$i++] = 30;
	}

	if($VerOficina === 'true'){
		$DatosTamanoColumna[$i++] = 30;
	}

	if($VerSerie === 'true'){
		$DatosTamanoColumna[$i++] = 30;
	}

	if($VerSubSerie === 'true'){
		$DatosTamanoColumna[$i++] = 30;
	}

	if($VerTipoDocumento === 'true'){
		$DatosTamanoColumna[$i++] = 30;
	}

	if($VerRadicadoRespuesta === 'true'){
		$DatosTamanoColumna[$i++] = 40;
	}

	if($VerFecHorRespuesta === 'true'){
		$DatosTamanoColumna[$i++] = 30;
	}

	if($VerAsuntoRespuesta === 'true'){
		$DatosTamanoColumna[$i++] = 40;
	}

	$pdf->SetWidths($DatosTamanoColumna);


	$Condicional = "";

	if($FecDesde != "" and $FecHasta != ""){
		if($Condicional == ""){
			$Condicional.="DATE(`radi`.fechor_radica) BETWEEN '".$FecDesde."' AND '".$FecHasta."'";
		}else{
			$Condicional.=" AND DATE(`radi`.fechor_radica) BETWEEN '".$FecDesde."' AND '".$FecHasta."'";
		}
	}elseif($FecDesde != "" and $FecHasta == ""){
		if($Condicional == ""){
			$Condicional.="DATE(`radi`.fechor_radica) >= '".Convertir_Fecha_A_Mysql($FecHasta)."'";
		}else{
			$Condicional.=" AND DATE(`radi`.fechor_radica) >= '".Convertir_Fecha_A_Mysql($FecHasta)."'";
		}
	}elseif($FecDesde == "" and $FecHasta != ""){
		if($Condicional == ""){
			$Condicional.="DATE(`radi`.fechor_radica) >= '".Convertir_Fecha_A_Mysql($FecHasta)."'";
		}else{
			$Condicional.=" AND DATE(`radi`.fechor_radica) >= '".Convertir_Fecha_A_Mysql($FecHasta)."'";
		}
	}
    /*
    if($_POST['asunto'] != ""){
        if($Condicional == ""){
            $Condicional.="`radi`.asunto like '%".$_POST['asunto']."%'";
        }else{
            $Condicional.=" AND `radi`.asunto like '%".$_POST['asunto']."%'";
        }
    }
    */

    if($TipoTercer === 'NATURAL' AND $IdTercero != ""){
    	if($Condicional == ""){
    		$Condicional.="terce_contac.id_tercero = ".$IdTercero;
    	}else{
    		$Condicional.=" AND terce_contac.id_tercero = ".$IdTercero;
    	}
    }elseif($TipoTercer === 'JURIDICO' AND $IdTercero != ""){
    	if($Condicional == ""){
    		$Condicional.="terce_contac_empre.id_empre = ".$IdTercero;
    	}else{
    		$Condicional.=" AND desti_empre.id_empre = ".$IdTercero;
    	}
    }

    if($IdDestina != ""){
    	if($Condicional == ""){
    		$Condicional.="`ra_respon`.`id_funcio_deta` = ".$IdDestina;
    	}else{
    		$Condicional.=" AND `ra_respon`.`id_funcio_deta` = ".$IdDestina;
    	}
    }

    if($IdDepen != "0"){
    	if($Condicional == ""){
    		$Condicional.="depen.id_depen = ".$IdDepen;
    	}else{
    		$Condicional.=" AND depen.id_depen = ".$IdDepen;
    	}
    }

    if($IdDepen != "0" and $IdSerie != "0"){
    	if($Condicional == ""){
    		$Condicional.="serie.id_serie = ".$IdSerie;
    	}else{
    		$Condicional.=" AND serie.id_serie = ".$IdSerie;
    	}
    }

    if($IdDepen != "0" and $IdSerie != "0" and $IdSubSerie != "0"){
    	if($Condicional == ""){
    		$Condicional.="subserie.id_subserie = ".$IdSubSerie;
    	}else{
    		$Condicional.=" AND subserie = ".$IdSubSerie;
    	}
    }

    if($IdDepen != "0" and $IdSerie != "0" and $IdSubSerie != "0" and $IdTipoDoc != "0"){
    	if($Condicional == ""){
    		$Condicional.="subserie.id_tipodoc = ".$IdTipoDoc;
    	}else{
    		$Condicional.=" AND subserie.id_tipodoc = ".$IdTipoDoc;
    	}
    }

    $Sql = "SELECT `radi`.`id_radica`, `radi`.`asunto`, `radi`.`fec_docu`, `radi`.`fechor_radica`, `radi`.`digital`, `radi`.`impri_rotu`, `fun`.`nom_funcio`, 
			    `fun`.`ape_funcio`, `areas_dependencias`.`id_depen`, `areas_dependencias`.`nom_depen`, `areas_oficinas`.`nom_oficina`, `terce_contac`.`nom_contac`,
			    `terce_empre`.`razo_soci`, `funcio_radi`.`nom_funcio` AS `nom_funcio_radi`, `funcio_radi`.`ape_funcio` AS `ape_funcio_radi`, 
			    `config_formaenvio`.`id_formaenvio`, `config_formaenvio`.`nom_formaenvi`, `config_formaenvio`.`requie_digital`, `radi`.`impri_rotu`
		    FROM `archivo_radica_enviados_responsa` AS `ra_respon`
			    INNER JOIN `archivo_radica_enviados` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
			    INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_destina` = `terce_contac`.`id_tercero`)
			    INNER JOIN `segu_usua` AS `usua_radi` ON (`radi`.`id_usua_regis` = `usua_radi`.`id_usua`)
			    INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio_deta` = `funcio_deta`.`id_funcio_deta`)
			    INNER JOIN `gene_funcionarios` AS `fun` ON (`funcio_deta`.`id_funcio` = `fun`.`id_funcio`)
			    LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
			    INNER JOIN `gene_funcionarios` AS `funcio_radi` ON (`usua_radi`.`id_funcio` = `funcio_radi`.`id_funcio`)
			    INNER JOIN `areas_oficinas` ON (`funcio_deta`.`id_oficina` = `areas_oficinas`.`id_oficina`)
			    INNER JOIN `areas_dependencias` ON (`areas_oficinas`.`id_depen` = `areas_dependencias`.`id_depen`)
			    INNER JOIN `config_formaenvio` ON (`radi`.`id_formaenvio` = `config_formaenvio`.`id_formaenvio`)
		    WHERE (`ra_respon`.`respon` = 1) AND  ".$Condicional."
		    ORDER BY `radi`.id_radica DESC";
    
    $conexion = new conexion();
    $Senten = $conexion->prepare($Sql);
    $Senten->execute() or die(print_r($Senten->errorInfo()." - ".$Sql, true));
    $Result = $Senten->fetchAll(PDO::FETCH_ASSOC);

    foreach($Result as $Item){
    	$i=0;
    	$DatosRadicado      = array();

    	if($VerRadicado === 'true'){
    		$DatosRadicado[$i++] = $Item['id_radica'];
    	}

    	if($VerTercero === 'true'){
    		$Tercero = "";
    		if($Item['razo_soci'] === ""){
    			$Tercero = $Item['nom_contac'];
    		}else{
    			$Tercero = $Item['razo_soci']."\nContac: ".$Item['nom_contac'];
    		}

    		$DatosRadicado[$i++] = $Tercero;
    	}

    	if($VerFuncionario === 'true'){
    		$DatosRadicado[$i++] = utf8_decode($Item['nom_funcio']." ".$Item['ape_funcio']);
    	}

    	if($VerFechaHoraRadica === 'true'){
    		$DatosRadicado[$i++] = $Item['fechor_radica'];
    	}

    	if($VerFechaDocumento === 'true'){
    		$DatosRadicado[$i++] = $Item['fec_docu'];
    	}

    	if($VerFechaVencimiento === 'true'){
    		$DatosRadicado[$i++] = $Item['fec_venci'];
    	}

    	if($VerAsunto === 'true'){
    		$DatosRadicado[$i++] = utf8_decode($Item['asunto']);
    	}

    	if($VerDependencia === 'true'){
    		$DatosRadicado[$i++] = utf8_decode($Item['nom_depen']);
    	}

    	if($VerOficina === 'true'){
    		$DatosRadicado[$i++] = utf8_decode($Item['nom_oficina']);
    	}

    	if($VerSerie === 'true'){
    		$DatosRadicado[$i++] = utf8_decode($Item['cod_serie'].".".$Item['nom_serie']);
    	}

    	if($VerSubSerie === 'true'){
    		$DatosRadicado[$i++] = utf8_decode($Item['cod_subserie'].".".$Item['nom_subserie']);
    	}

    	if($VerTipoDocumento === 'true'){
    		$DatosRadicado[$i++] = utf8_decode($Item['nom_tipodoc']);
    	}

    	if($VerRadicadoRespuesta === 'true'){
    		$DatosRadicado[$i++] = $Item['radica_respuesta'];
    	}

    	if($VerFecHorRespuesta === 'true'){
    		$DatosRadicado[$i++] = $Item['fechor_radica_respuesta'];
    	}

    	if($VerAsuntoRespuesta === 'true'){
    		$DatosRadicado[$i++] = utf8_decode($Item['asunto_respuesta']);
    	}

    	$pdf->Row($DatosRadicado);
    }
   


$pdf->Output();
ob_end_flush();
?>