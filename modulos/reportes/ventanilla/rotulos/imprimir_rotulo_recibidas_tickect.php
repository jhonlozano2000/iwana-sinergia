<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
require("../../../../config/lib/fpdf/fpdf.php");
include "../../../../config/lib/qrcode/qrlib.php";
include "../../../../config/class.Conexion.php";
include "../../../../config/variable.php";
include "../../../../config/funciones_seguridad.php";
require_once '../../../clases/radicar/class.RadicaRecibido.php';
require_once '../../../clases/radicar/class.RadicaRecibidoResponsable.php';
require_once '../../../clases/configuracion/class.ConfigMiEmpresa.php';

$Radicado = RadicadoRecibido::Listar_Vario(1, $_REQUEST['id_radica'], "", "", 0, 0, 0, "", "", "");
$MiEmpresa = MiEmpresa::Buscar();

$Dependencia = "";
$FecHorRadicado = "";
$Tercero = "";
$Asunto = "";
$Responsable = "";

foreach ($Radicado as $Item) :

    $FecHorRadicado = $Item['fechor_radica'];

    if ($Item['razo_soci_remite'] != "") {
        $Tercero = 'Enti.: ' . $Item['razo_soci_remite'] . ", Contac.: " . $Item['nom_remite'];
    } else {
        $Tercero = $Item['nom_remite'];
    }
    $Asunto = $Item['asunto'];
endforeach;

$RegisResponsable = RadicadoRecibidoResponsable::Listar(1,  $_REQUEST['id_radica'], "");
foreach ($RegisResponsable as $ItemResponsa) {
    $Responsable = $ItemResponsa['nom_funcio'] . " " . $ItemResponsa['ape_funcio'];
    $Dependencia = substr($ItemResponsa['cod_corres'] . "." . $ItemResponsa['nom_depen'], 0, 20);
}

QRcode::png("Radicado: " . $_REQUEST['id_radica'] . "
Tip. Radicado: Entrada
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
$pdf->SetFont('Arial', 'B', 7);
$pdf->MultiCell(140, 7, utf8_decode($MiEmpresa->get_RazonSocial()), 0, 'C');
//$pdf->Cell(17, 10,'',0, 0, 'C');
//$pdf->Cell(140, 15,'HOSPITAL SAN RAFAEL E.S.E',0, 0, 'C');
$pdf->Image($_REQUEST['id_radica'] . '.png', 180, 1, 80, 70);
$pdf->Ln();

$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(140, 20, $_GET['id_radica'], 0, 0, 'C');
//$pdf->Cell(17, 23,'',0, 0, 'C');
//$pdf->Cell(140, 23, $_REQUEST['id_radica'], 0, 0, 'C');
$pdf->Ln();

$pdf->SetFont('Arial', '', 7);
$pdf->Cell(140, 8, 'Tip. Radicado: Entrada - Hora: ' . substr($FecHorRadicado, 11, 5), 0, 0, 'L');
//$pdf->Cell(17, 10,'',0, 0, 'C');
//$pdf->Cell(140, 10,'Hora: '.substr($FecHorRadicado, 11, 5),0, 0, 'L');
$pdf->Ln();

$pdf->Cell(140, 8, 'Dependencia: ' . $Dependencia, 0, 0, 'L');
//$pdf->Cell(17, 10,'',0, 0, 'C');
//$pdf->Cell(140, 10,'Dependencia: '.$Dependencia,0, 0, 'L');
$pdf->Ln();

$pdf->Cell(140, 8, 'Radicado Por: ' . $_SESSION['SesionFuncioNom'] . " " . substr($_SESSION['SesionFuncioApe'], 0, 1), 0, 0, 'L');
//$pdf->Cell(17, 10,'',0, 0, 'C');
//$pdf->Cell(140, 10,'Radicado Por: '.$_SESSION['SesionFuncioNom']." ".substr($_SESSION['SesionFuncioApe'], 0, 1),0, 0, 'L');

$pdf->Output();
unlink($_REQUEST['id_radica'] . '.png');
