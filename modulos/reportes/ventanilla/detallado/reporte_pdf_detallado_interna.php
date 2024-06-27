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
require('mc_table_interna.php');

$pdf=new PDF_MC_Table('L', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial','',8);
$pdf->AliasNbPages();

//set document properties
$pdf->SetAuthor('...::: Iwana :::...');
$pdf->SetTitle('Ventanilla -> Reporte detallado correspondencia interna.');

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
            $Condicional.="DATE(`radi`.`fechor_radica`) BETWEEN '".$FecDesde."' AND '".$FecHasta."'";
        }else{
            $Condicional.=" AND DATE(`radi`.`fechor_radica`) BETWEEN '".$FecDesde."' AND '".$FecHasta."'";
        }
    }elseif($_REQUEST['desde'] != "" and $_REQUEST['hasta'] == ""){
        if($Condicional == ""){
            $Condicional.="DATE(`radi`.fechor_radica) >= '".$FecHasta."'";
        }else{
            $Condicional.=" AND DATE(`radi`.fechor_radica) >= '".$FecHasta."'";
        }
    }elseif($_REQUEST['desde'] == "" and $_REQUEST['hasta'] != ""){
        if($Condicional == ""){
            $Condicional.="DATE(`radi`.fechor_radica) >= '".$FecHasta."'";
        }else{
            $Condicional.=" AND DATE(`radi`.fechor_radica) >= '".$FecHasta."'";
        }
    }
    /*
    if($_POST['asunto'] != ""){
        if($Condicional == ""){
            $Condicional.="`radi`.`asunto` like '%".$_POST['asunto']."%'";
        }else{
            $Condicional.=" AND `radi`.`asunto` like '%".$_POST['asunto']."%'";
        }
    }
    */
    if($IdDestina != ""){
        if($Condicional == ""){
            $Condicional.="`radi_respon`.`id_funcio`` = ".$IdDestina;
        }else{
            $Condicional.=" AND `radi_respon`.`id_funcio` = ".$IdDestina;
        }
    }

    if($IdDepen != "0"){
        if($Condicional == ""){
            $Condicional.="`radi_respon_depen`.`id_depen` = ".$IdDepen;
        }else{
            $Condicional.=" AND `radi_respon_depen`.`id_depen` = ".$IdDepen;
        }
    }

    if($IdSerie != "0"){
        if($Condicional == ""){
            $Condicional.="`serie`.`id_serie` = ".$IdSerie;
        }else{
            $Condicional.=" AND `serie`.`id_serie` = ".$IdSerie;
        }
    }

    if($IdSubSerie != "0"){
        if($Condicional == ""){
            $Condicional.="`subserie`.`id_subserie` = ".$IdSubSerie;
        }else{
            $Condicional.=" AND `subserie`.`id_subserie` = ".$IdSubSerie;
        }
    }

    if($IdTipoDoc != "0"){
        if($Condicional == ""){
            $Condicional.="`tip_docu`.`id_tipodoc` = ".$IdTipoDoc;
        }else{
            $Condicional.=" AND `tip_docu`.`id_tipodoc` = ".$IdTipoDoc;
        }
    }
    
    $Sql = "SELECT `radi`.`id_radica`, `radi`.`adjunto`, `radi`.`fechor_radica`, `radi`.`fec_venci`, `radi`.`requie_respuesta`, `radi`.`radica_respuesta`, 
                `radi`.`asunto`, `radi`.`texto`, `radi`.`impri_rotu`, `funcio_regis`.`nom_funcio` AS `nom_funcio_radi`, 
                `funcio_regis`.`ape_funcio` AS `ape_funcio_radi`, `funcio_depen`.`nom_depen` AS `nom_depen_radi`, `funcio_ofi`.`nom_oficina` AS `nom_oficina_radi`, 
                `radi`.`transferido`, `serie`.`nom_serie`, `subserie`.`nom_subserie`, `tip_docu`.`nom_tipodoc`, `radi_respon`.`id_funcio`, 
                `radi_desti`.`id_funcio_deta`, `radi_respon_funcio`.`id_funcio_deta`, `radi_respon_depen`.`id_depen`, `serie`.`id_serie`, `subserie`.`id_subserie`, 
                `tip_docu`.`id_tipodoc`, `fun_respon`.`nom_funcio` AS `nom_funcio_respon`, `fun_respon`.`ape_funcio` AS `ape_funcio_respon`
            FROM `archivo_radica_interna` AS `radi`
                INNER JOIN `gene_funcionarios_deta` AS `fun_regis` ON (`radi`.`id_funcio_regis` = `fun_regis`.`id_funcio_deta`)
                INNER JOIN `gene_funcionarios` AS `funcio_regis` ON (`fun_regis`.`id_funcio` = `funcio_regis`.`id_funcio`)
                LEFT JOIN `areas_oficinas` AS `funcio_ofi` ON (`fun_regis`.`id_oficina` = `funcio_ofi`.`id_oficina`)
                LEFT JOIN `areas_dependencias` AS `funcio_depen` ON (`funcio_ofi`.`id_depen` = `funcio_depen`.`id_depen`)
                INNER JOIN `archivo_radica_interna_responsa` AS `radi_respon` ON (`radi_respon`.`id_radica` = `radi`.`id_radica`)
                LEFT JOIN `archivo_trd_series` AS `serie` ON (`radi`.`id_serie` = `serie`.`id_serie`)
                LEFT JOIN `archivo_trd_subserie` AS `subserie` ON (`radi`.`id_subserie` = `subserie`.`id_subserie`)
                LEFT JOIN `archivo_trd_tipo_docu` AS `tip_docu` ON (`radi`.`id_tipodoc` = `tip_docu`.`id_tipodoc`)
                INNER JOIN `gene_funcionarios_deta` AS `radi_respon_funcio` ON (`radi_respon`.`id_funcio` = `radi_respon_funcio`.`id_funcio_deta`)
                INNER JOIN `archivo_radica_interna_destinata` AS `radi_desti` ON (`radi_desti`.`id_radica` = `radi`.`id_radica`)
                LEFT JOIN `archivo_radica_interna_proyectores` AS `radi_proyec` ON (`radi_proyec`.`id_radica` = `radi`.`id_radica`)
                INNER JOIN `areas_oficinas` AS `radi_respon_ofi` ON (`radi_respon_funcio`.`id_oficina` = `radi_respon_ofi`.`id_oficina`)
                INNER JOIN `gene_funcionarios` AS `fun_respon` ON (`radi_respon_funcio`.`id_funcio` = `fun_respon`.`id_funcio`)
                INNER JOIN `areas_dependencias` AS `radi_respon_depen` ON (`radi_respon_ofi`.`id_depen` = `radi_respon_depen`.`id_depen`)
            WHERE `radi_respon`.`respon` = 1 AND ".$Condicional."
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