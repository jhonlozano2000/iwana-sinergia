<?php
session_start();
require('../../../../config/lib/fpdf/fpdf.php');
include "../../../../config/lib/qrcode/qrlib.php";
include "../../../../config/class.Conexion.php";
require_once '../../../clases/radicar/class.RadicaEnviado.php';
require_once '../../../clases/configuracion/class.ConfigMiEmpresa.php';

$Radicado = RadicadoEnviado::Listar_Varios(12, $_REQUEST['id_radica'], "", "", "", "", "", "", "");
$MiEmpresa = MiEmpresa::Buscar();

$Dependencia = "";
$FecHorRadicado = "";
$Tercero = "";
$Asunto = "";
$Responsable = "";

foreach ($Radicado as $Item) :
    $Dependencia    = substr($Item['cod_corres'] . "." . $Item['nom_depen'], 0, 20);
    $FecHorRadicado = $Item['fechor_radica'];

    if ($Item['razo_soci'] != "") {
        $Tercero = 'Enti.: ' . $Item['razo_soci'] . " -  Contac.: " . $Item['nom_contac'];
    } else {
        $Tercero = $Item['nom_contac'];
    }

    $Asunto       = $Item['asunto'];
    $Responsable  = $Item['nom_funcio'] . " " . $Item['ape_funcio'];
    $UsuaraRadica = $Item['nom_funcio_radica'] . " " . substr($Item['ape_funcio_radica'], 0, 1);
    $NumFolios    = $Item['num_folio'];
    $NumAnexos    = $Item['num_anexos'];
endforeach;

QRcode::png("Radicado: " . $_REQUEST['id_radica'] . "
Tip. Radicado: Salida
Hora: " . substr($FecHorRadicado, 11, 5) . "
Tercero: " . $Tercero . "
Asunto: " . substr($Asunto, 0, 80), $_REQUEST['id_radica'] . '.png') . "
Responsable: " . $Responsable;

$pdf = new FPDF('P', 'pt', 'rotulo');
$pdf->AddPage('P', 'rotulo');

//set document properties
$pdf->SetAuthor('...::: Iwana :::...');
$pdf->SetTitle('Imprimir rotulo: ' . $_REQUEST['id_radica']);

#Establecemos los márgenes izquierda, arriba y derecha:
$pdf->SetMargins(1, 1, 1);
#Establecemos el margen inferior:
$pdf->SetAutoPageBreak(true, 1);

$pdf->SetX(1);
$pdf->sety(1);
$pdf->SetFont('Arial', 'B', 8);
$pdf->MultiCell(140, 7, utf8_decode($MiEmpresa->get_RazonSocial()), 0, 'C');
//$pdf->Cell(17, 15,'',0, 0, 'C');
//$pdf->Cell(140, 15,'HOSPITAL SAN RAFAEL E.S.E',0, 0, 'C');
$pdf->Image($_REQUEST['id_radica'] . '.png', 180, 1, 80, 70);
$pdf->Ln(1);
$pdf->SetFont('Arial', 'B', 17);
$pdf->Cell(140, 20, $_REQUEST['id_radica'], 0, 0, 'C');
//$pdf->Cell(17, 23,'',0, 0, 'C');
//$pdf->Cell(140, 23, $_REQUEST['id_radica'], 0, 0, 'C');
$pdf->Ln();
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(140, 8, 'Tip. Radicado: Salida - Hora: ' . substr($FecHorRadicado, 11, 5), 0, 0, 'L');
//$pdf->Cell(17, 10,'',0, 0, 'C');
//$pdf->Cell(140, 10,'Hora: '.substr($FecHorRadicado, 11, 5),0, 0, 'L');
$pdf->Ln();
$pdf->Cell(140, 8, 'Dependencia: ' . $Dependencia, 0, 0, 'L');
//$pdf->Cell(17, 10,'',0, 0, 'C');
//$pdf->Cell(140, 10,'Dependencia: '.$Dependencia,0, 0, 'L');
$pdf->Ln();
$pdf->Cell(140, 8, '# Folios: ' . $NumFolios . " - # Anexos: " . $NumAnexos, 0, 0, 'L');
$pdf->Ln();
$pdf->Cell(140, 8, 'Radicado Por: ' . $UsuaraRadica, 0, 0, 'L');

$pdf->Output();
unlink($_REQUEST['id_radica'] . '.png');
