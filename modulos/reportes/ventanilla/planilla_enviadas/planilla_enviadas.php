<?php
ob_start();
session_start();
require('../../../../config/lib/fpdf/fpdf.php');
require('mc_table.php');
include "../../../../config/class.Conexion.php";
include "../../../../config/funciones.php";
include "../../../../config/variable.php";
include "../../../../config/funciones_seguridad.php";
require_once '../../../clases/radicar/class.RadicaEnviado.php';
require_once '../../../clases/radicar/class.RadicaEnviadoQuienFirma.php';
require_once '../../../clases/radicar/class.RadicaEnviadoProyectores.php';
require_once '../../../clases/configuracion/class.ConfigMiEmpresa.php';
require_once '../../../clases/configuracion/class.ConfigOtras.php';


$pdf = new PDF_MC_Table('L', 'mm', 'A4');
$pdf->AddPage('L', 'A4');
$pdf->SetFont('Arial', '', 10);
$pdf->AliasNbPages();

//set document properties
$pdf->SetAuthor('...::: Iwana :::...');
$pdf->SetTitle('Planilla correspondencia enviada');

//Establecemos los márgenes izquierda, arriba y derecha: 
$pdf->SetMargins(10, 7, 5);
//Establecemos el margen inferior: 
$pdf->SetAutoPageBreak(true, 15);

$pdf->SetWidths(array(30, 45, 65, 50, 35, 20, 35));

$Accion = "";
if ($_REQUEST['accion'] == "Fecha") {
	$Regis = RadicadoEnviado::Listar_Varios(6, "", "", "", "", "", Convertir_Fecha_A_Mysql($_REQUEST['FechaInicio']) . " " . $_REQUEST['HoraInicio'], Convertir_Fecha_A_Mysql($_REQUEST['FechaFin']) . " " . $_REQUEST['HoraFin'], "");
} elseif ($_REQUEST['accion'] == "Radicado") {
	$Regis = RadicadoEnviado::Listar_Varios(7, "", "", "", "", "", $_REQUEST['radicado_desde'], $_REQUEST['radicado_hasta'], "");
}

$i = 0;

foreach ($Regis as $Item) {
	$i = $i + 1;
	$Destinatario = "";
	$Remitente = "Firma: ";

	$QuienesFirman = RadicadoEnviadoQuienFirma::Listar(1, $Item['id_radica'], "");
	foreach ($QuienesFirman as $ItemQuienesFirman) {
		$Remitente = "Firma: " . $ItemQuienesFirman['nom_funcio'] . " " . $ItemQuienesFirman['ape_funcio'] . "\n";
	}

	$QuienesProyectan = "Proyectores: ";
	$Proyectores = RadicadoEnviadoProyector::Listar(1, $Item['id_radica'], "", "", "", "", "", "");
	foreach ($Proyectores as $ItemProyector) {
		$QuienesProyectan = $QuienesProyectan . $ItemProyector['nom_funcio'] . " " . $ItemProyector['ape_funcio']  . "\n";
	}

	/* if ($Item['nom_funcio_quien_firma'] != "") {
		$Remitente = "Firma: " . $Item['nom_funcio_quien_firma'] . " " . $Item['ape_funcio_quien_firma'];
	} else {
		$Remitente = "Firma: " . $Item['nom_funcio'] . " " . $Item['ape_funcio'];
	} */

	if ($Item['razo_soci'] != "") {
		$Destinatario = $Item['razo_soci'];
	} else {
		$Destinatario = $Item['nom_contac'];
	}

	$FoliosAnexos = "";
	if ($Item['num_anexos'] == "") {
		$FoliosAnexos = $Item['num_folio'] . "/---";
	} else {
		$FoliosAnexos = $Item['num_folio'] . "/" . $Item['num_anexos'];
	}

	$pdf->Row(array(
		$Item['id_radica'], substr($Item['asunto'], 0, 500), utf8_decode($Destinatario), utf8_decode($Remitente . "\n" . $QuienesProyectan), '', $FoliosAnexos,
		$Item['num_guia']
	));
}

$pdf->Output();
ob_end_flush();
