<?php
session_start();
require('../../../../config/lib/fpdf/fpdf.php');
include "../../../../config/lib/qrcode/qrlib.php";
include "../../../../config/class.Conexion.php";
require_once '../../../clases/radicar/class.RadicaInterno.php';
require_once '../../../clases/radicar/class.RadicaInternoDestinatario.php';
require_once '../../../clases/configuracion/class.ConfigMiEmpresa.php';

$Radicado = RadicadoInterno::Listar_Varios(1, $_REQUEST['id_radica'], "", "", 0, 0, 0, "", "", "");
$MiEmpresa = MiEmpresa::Buscar();

$Dependencia    = "";
$FecHorRadicado = "";
$Responsable    = "";
$Asunto         = "";
$Destinatarios  = "";
$UsuaRadica     = "";

foreach($Radicado as $Item):
	$Responsable    = $Item['nom_funcio_respon']." ".$Item['ape_funcio_respon'];
	$Asunto         = $Item['asunto'];
	$Dependencia    = $Item['nom_depen_respon'];
	$FecHorRadicado = $Item['fechor_radica'];
	$UsuaRadica     = $Item['nom_funcio_radi']." ".substr($Item['ape_funcio_radi'], 0, 1);
	$NumFolios      = $Item['num_folio'];
	$NumAnexos      = $Item['num_anexos'];
	$ObservaAnexos = $Item['observa_anexos'];
endforeach;

$Destinatario = RadicadoInternoDestinatario::Listar(1, $_REQUEST['id_radica'], "");
foreach($Destinatario as $Item){
	$Destinatarios.= $Item['nom_funcio']." ".$Item['ape_funcio']."<br>";
}

QRcode::png("Radicado: ".$_REQUEST['id_radica']."
Tip. Radicado: Interno
Hora: ".substr($FecHorRadicado, 11, 5)."
Responsable: ".$Responsable."
Destinatarios: ".$Destinatarios."
Asunto: ".substr($Asunto, 0, 80), $_REQUEST['id_radica'].'.png');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',6);
//set document properties
$pdf->SetAuthor('...::: Iwana :::...');
$pdf->SetTitle('Imprimir rotulo: '.$_REQUEST['id_radica']);

$pdf->SetFont('Arial','B',7);
$pdf->SetXY(160, 2);
$pdf->MultiCell(50, 2, utf8_decode($MiEmpresa->get_RazonSocial()), 0, 'C');
$pdf->Ln();

$pdf->SetXY(160, 6);
$pdf->Image($_REQUEST['id_radica'].'.png', 138 , 1, 23 , 23);
$pdf->SetFont('Arial', 'B',10);
$pdf->Cell(50, 5, $_GET['id_radica'], 0, 0, 'J');
$pdf->Ln();

$pdf->SetFont('Arial', '',6);

$pdf->SetXY(160, 8);
$pdf->Cell(50, 7, 'Tip. Radicado: Interno - Hora: '.substr($FecHorRadicado, 11, 5),0, 0, 'L');
$pdf->Ln();

$pdf->SetXY(160, 10);
$pdf->Cell(140, 8,'Dependencia: '.$Dependencia,0, 0, 'L');
$pdf->Ln();

$pdf->SetXY(160, 12);
$pdf->Cell(50, 7,'# Folios: '.$NumFolios,0, 0, 'L');
$pdf->Ln();

$pdf->SetXY(160, 14);
$pdf->MultiCell(50, 7, "Obser Anex: ".utf8_decode($ObservaAnexos), 0, 'J');
$pdf->Ln();

$pdf->SetXY(160, 16);
$pdf->Cell(140, 8,'Radicado Por: '.$UsuaRadica,0, 0, 'L');
$pdf->Ln();

$pdf->Output();
unlink($_REQUEST['id_radica'].'.png');
?>
