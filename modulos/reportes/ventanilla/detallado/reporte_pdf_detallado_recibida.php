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
require('mc_table_recibida.php');

$pdf=new PDF_MC_Table('L', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial','',8);
$pdf->AliasNbPages();

//set document properties
$pdf->SetAuthor('...::: Iwana :::...');
$pdf->SetTitle('Ventanilla -> Reporte detallado correspondencia recibida.');

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

switch($OrigenCorrespon){
	case 'CORRES_RECIBIDA':
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

    if($FecDesde != ""){
        if($Condicional == ""){
            $Condicional.="DATE(`ra`.fechor_radica) >= '".$FecDesde."'";
        }else{
            $Condicional.=" AND DATE(`ra`.fechor_radica) >= '".$FecDesde."'";
        }
    }

    if($FecHasta != ""){
        if($Condicional == ""){
            $Condicional.="DATE(`ra`.fechor_radica) <= '".$FecHasta."'";
        }else{
            $Condicional.=" AND DATE(`ra`.fechor_radica) <= '".$FecHasta."'";
        }
    }

    /*
    if($_REQUEST['asunto'] != ""){
        if($Condicional == ""){
            $Condicional.="`ra`.asunto like '%".$_POST['asunto']."%'";
        }else{
            $Condicional.=" AND `ra`.asunto like '%".$_POST['asunto']."%'";
        }
    }
    */

    if($TipoTercer === 'NATURAL' AND $IdTercero != ""){
        if($Condicional == ""){
            $Condicional.="RemiteContac.id_tercero = ".$IdTercero;
        }else{
            $Condicional.=" AND RemiteContac.id_tercero = ".$IdTercero;
        }
    }elseif($TipoTercer === 'JURIDICO' AND $IdTercero != ""){
        if($Condicional == ""){
            $Condicional.="RemiteContac.id_empre = ".$IdTercero;
        }else{
            $Condicional.=" AND RemiteContac.id_empre = ".$IdTercero;
        }
    }

    if($IdDestina != ""){
        if($Condicional == ""){
            $Condicional.="ResponFuncio.id_funcio = ".$IdDestina;
        }else{
            $Condicional.=" AND ResponFuncio.id_funcio = ".$IdDestina;
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
            $Condicional.=" AND subserie.id_subserie = ".$IdSubSerie;
        }
    }

    if($IdDepen != "0" and $IdSerie != "0" and $IdSubSerie != "0" and $IdTipoDoc != "0"){
        if($Condicional == ""){
            $Condicional.="tipodocu.id_tipodoc = ".$IdTipoDoc;
        }else{
            $Condicional.=" AND tipodocu.id_tipodoc = ".$IdTipoDoc;
        }
    }

    $Sql = "SELECT `ra`.`id_radica`, `ra`.`requie_respues`, `ra`.`fechor_radica`, `ra`.`fec_docu`, `ra`.`fec_venci`, `ra`.`asunto`, `ra`.`digital`, `funcio`.`nom_funcio`, `funcio`.`ape_funcio`, `depen`.`nom_depen`, `ofi`.`nom_oficina`, `RemiteContac`.`nom_contac`, `RemiteEmpre`.`nit_empre`, `RemiteEmpre`.`razo_soci`, `funcio_deta`.`id_oficina`, `ra_respon`.`respon`, `ra_respon`.`id_funcio`, `forma_recibi`.`requie_digital`, `forma_recibi`.`nom_formaenvi` as 'nom_forma_llega', `funcio_radi`.`nom_funcio` AS `nom_funcio_radi`, `funcio_radi`.`ape_funcio` AS `ape_funcio_radi`, `ra`.`impri_rotu`
            FROM `archivo_radica_recibidos` AS `ra`
                INNER JOIN `gene_terceros_contac` AS `RemiteContac` ON (`ra`.`id_remite` = `RemiteContac`.`id_tercero`)
                LEFT JOIN `gene_terceros_empresas` AS `RemiteEmpre` ON (`RemiteContac`.`id_empre` = `RemiteEmpre`.`id_empre`)
                INNER JOIN `archivo_radica_recibidos_responsa` AS `ra_respon` ON (`ra_respon`.`id_radica` = `ra`.`id_radica`)
                INNER JOIN `config_formaenvio` AS `forma_recibi` ON (`ra`.`id_forma_llegada` = `forma_recibi`.`id_formaenvio`)
                INNER JOIN `segu_usua` AS `usua_radi` ON (`ra`.`id_usua_regis` = `usua_radi`.`id_usua`)
                INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio` = `funcio_deta`.`id_funcio_deta`)
                INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`)
                INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                INNER JOIN `gene_funcionarios` AS `funcio_radi` ON (`usua_radi`.`id_funcio` = `funcio_radi`.`id_funcio`)
            WHERE (ra_respon.respon = 1) AND  ".$Condicional."
            ORDER BY `ra`.id_radica DESC";

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
		break;
	case 'CORRES_ENVIADA':
		
		break;
	case 'CORRES_INTERNA':
		
		break;
	default:
		echo "No hay acción para realizar."; 
		break;
}

$pdf->Output();
ob_end_flush();
?>