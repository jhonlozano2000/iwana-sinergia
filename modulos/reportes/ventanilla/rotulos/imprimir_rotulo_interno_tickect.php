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

foreach ($Radicado as $Item):
	$Responsable    = $Item['nom_funcio_respon']." ".$Item['ape_funcio_respon'];
	$Asunto         = $Item['asunto'];
	$Dependencia    = $Item['nom_depen_respon'];
	$FecHorRadicado = $Item['fechor_radica'];
	$UsuaRadica     = $Item['nom_funcio_radi']." ".substr($Item['ape_funcio_radi'], 0, 1);
	$NumFolios      = $Item['num_folio'];
	$NumAnexos      = $Item['num_anexos'];
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

$pdf = new FPDF('P','pt', 'rotulo');
$pdf->AddPage('P', 'rotulo');

//set document properties
$pdf->SetAuthor('...::: Iwana :::...');
$pdf->SetTitle('Imprimir rotulo: '.$_REQUEST['id_radica']);

#Establecemos los márgenes izquierda, arriba y derecha:
$pdf->SetMargins(1, 1, 1);
#Establecemos el margen inferior:
$pdf->SetAutoPageBreak(true, 1);

$pdf->SetX(1);
$pdf->sety(1);
$pdf->SetFont('Arial','B',8);
$pdf->MultiCell(140, 7, utf8_decode($MiEmpresa->get_RazonSocial()), 0, 'C');
//$pdf->Cell(17, 15,'',0, 0, 'C');
//$pdf->Cell(140, 15,'HOSPITAL SAN RAFAEL E.S.E',0, 0, 'C');
$pdf->Image($_REQUEST['id_radica'].'.png', 180 ,1, 80 , 70);
$pdf->Ln(1);
$pdf->SetFont('Arial', 'B',17);
$pdf->Cell(140, 20, $_REQUEST['id_radica'], 0, 0, 'C');
//$pdf->Cell(17, 23,'',0, 0, 'C');
//$pdf->Cell(140, 23, $_REQUEST['id_radica'], 0, 0, 'C');
$pdf->Ln();
$pdf->SetFont('Arial', '',7);
$pdf->Cell(140, 8, 'Tip. Radicado: Interno - Hora: '.substr($FecHorRadicado, 11, 5),0, 0, 'L');
//$pdf->Cell(17, 10,'',0, 0, 'C');
//$pdf->Cell(140, 10,'Hora: '.substr($FecHorRadicado, 11, 5),0, 0, 'L');
$pdf->Ln();
$pdf->Cell(140, 8,'Dependencia: '.$Dependencia,0, 0, 'L');
//$pdf->Cell(17, 10,'',0, 0, 'C');
//$pdf->Cell(140, 10,'Dependencia: '.$Dependencia,0, 0, 'L');
$pdf->Ln();
$pdf->Cell(140, 8, '# Folios: '.$NumFolios." - # Anexos: ".$NumAnexos,0, 0, 'L');
$pdf->Ln();
//$pdf->Cell(17, 10,'',0, 0, 'L');
$pdf->Cell(140, 10,'Radicado Por: '.$UsuaRadica,0, 0, 'L');

$pdf->Output();
unlink($_REQUEST['id_radica'].'.png');
?>