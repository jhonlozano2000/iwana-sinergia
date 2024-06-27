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
require('mc_table.php');

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
		

		$Regis = ReportRadicacionRecibido::Listar_Detallado($FecDesde, $FecHasta, $IdTercero, $TipoTercer, $IdFuncionario, $IdDepen, $IdSerie, $IdSubSerie, $IdTipoDoc);
		foreach($Regis as $Item){
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