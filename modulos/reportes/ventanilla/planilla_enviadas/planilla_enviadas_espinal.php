<?php
ob_start();
session_start();
require('../../../../config/lib/fpdf/fpdf.php');
require('mc_table_espinal.php');
include "../../../../config/class.Conexion.php";
include "../../../../config/funciones.php";
include "../../../../config/variable.php";
include "../../../../config/funciones_seguridad.php";
require_once '../../../clases/radicar/class.RadicaEnviado.php';
require_once '../../../clases/radicar/class.RadicaEnviadoProyectores.php';
require_once '../../../clases/configuracion/class.ConfigMiEmpresa.php';
require_once '../../../clases/configuracion/class.ConfigOtras.php';

$pdf=new PDF_MC_Table('L', 'mm', 'A4');
$pdf->AddPage('L', 'A4');
$pdf->SetFont('Arial','',10);
$pdf->AliasNbPages();

//set document properties
$pdf->SetAuthor('...::: Iwana :::...');
$pdf->SetTitle('Planilla correspondencia enviada');

//Establecemos los márgenes izquierda, arriba y derecha:
//$pdf->SetMargins(5, 7 , 5);
//Establecemos el margen inferior:
$pdf->SetAutoPageBreak(true, 15);

$pdf->SetWidths(array(7, 30, 40, 40, 40, 40, 25, 25, 35));

$Accion = "";
if($_REQUEST['accion'] == "Fecha"){
	$Regis=RadicadoEnviado::Listar_Varios(6, "", "", "", "", "", Convertir_Fecha_A_Mysql($_REQUEST['FechaInicio'])." ".$_REQUEST['HoraInicio'], Convertir_Fecha_A_Mysql($_REQUEST['FechaFin'])." ".$_REQUEST['HoraFin'], "");
}elseif($_REQUEST['accion'] == "Radicado"){
    $Regis=RadicadoEnviado::Listar_Varios(7, "", "", "", "", "", $_REQUEST['radicado_desde'], $_REQUEST['radicado_hasta'], "");
}

$k = 0;
foreach ($Regis as $Item){

	$k++;
	$Destinatario = "";
	$Remitente = "";
	$Responsable = "";
	$Responsable = $Item['nom_funcio']." ".$Item['ape_funcio'];

	if($Item['nom_funcio_quien_firma'] != ""){
		$Remitente = $Item['nom_funcio_quien_firma']." ".$Item['ape_funcio_quien_firma'];
	}else{
		$Remitente = $Item['nom_funcio']." ".$Item['ape_funcio'];
	}


	if($Item['razo_soci'] != ""){
		$Destinatario = $Item['razo_soci'];
	}else{
		$Destinatario = $Item['nom_contac'];
	}

	$Proyectores = RadicadoEnviadoProyector::Listar(1, $Item['id_radica'], "", "", "", "", "", "");
	$NomProyectores = "";
    foreach($Proyectores as $ItemProyectores):
        $NomProyectores = utf8_decode("* ".$ItemProyectores['nom_funcio']." ".$ItemProyectores['ape_funcio']);
    endforeach;

	$pdf->Row(array($k, $Item['id_radica'], utf8_decode($Item['asunto']), utf8_decode($Destinatario), utf8_decode($Responsable), $NomProyectores, $Item['num_guia'], $Item['nom_formaenvi'], ""));
}

$pdf->Output();
ob_end_flush();
?>