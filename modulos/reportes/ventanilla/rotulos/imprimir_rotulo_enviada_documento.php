<?php
session_start();
require("../../../../config/lib/fpdf/fpdf.php");
include "../../../../config/lib/qrcode/qrlib.php";
include "../../../../config/class.Conexion.php";
include "../../../../config/variable.php";
include "../../../../config/funciones_seguridad.php";
require_once '../../../clases/radicar/class.RadicaEnviado.php';
require_once '../../../clases/configuracion/class.ConfigMiEmpresa.php';

$Radicado = RadicadoEnviado::Listar_Varios(12, $_REQUEST['id_radica'], "", "", 0, 0, 0, "", "", "");
$MiEmpresa = MiEmpresa::Buscar();

$Dependencia = "";
$FecHorRadicado = "";
$Tercero = "";
$Asunto = "";
$Responsable = "";
$Oficina = "";

foreach($Radicado as $Item):
    $Dependencia = substr($Item['cod_corres'].".".$Item['nom_depen'], 0, 20);
    $Oficina = substr($Item['cod_oficina'].".".$Item['nom_oficina'], 0, 20);
    $FecHorRadicado = $Item['fechor_radica'];

    if($Item['razo_soci'] != ""){
        $Tercero = 'Enti.: '.$Item['razo_soci']." -  Contac.: ".$Item['nom_contac'];
    }else{
        $Tercero = $Item['nom_contac'];
    }

    $Asunto        = $Item['asunto'];
    $Responsable   = $Item['nom_funcio']." ".$Item['ape_funcio'];
    $UsuaRadica    = $Item['nom_funcio_radica']." ".substr($Item['ape_funcio_radica'], 0, 1);
    $NumFolios     = $Item['num_folio'];
    if($Item['num_anexos'] != ""){
        $NumAnexos     = $Item['num_anexos'];
    }else{
        $NumAnexos     = "---";
    }

    if($Item['observa_anexo'] != ""){
        $ObservaAnexos = $Item['observa_anexo'];
    }else{
        $ObservaAnexos = "-----------";
    }

endforeach;

QRcode::png("Radicado: ".$_REQUEST['id_radica']."
Tip. Radicado: Salida
Hora: ".substr($FecHorRadicado, 11, 5)."
Tercero: ".$Tercero."
Asunto: ".substr($Asunto, 0, 80), $_REQUEST['id_radica'].'.png')."
Responsable: ".$Responsable;

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',6);
//set document properties
$pdf->SetAuthor('...::: Iwana :::...');
$pdf->SetTitle('Imprimir rotulo: '.$_REQUEST['id_radica']);

$pdf->SetFont('Arial','B',7);
$pdf->SetXY(160, 39);
$pdf->MultiCell(50, 2, utf8_decode($MiEmpresa->get_RazonSocial()), 0, 'C');
$pdf->Ln();

$pdf->SetXY(160, 41);
$pdf->Image($_REQUEST['id_radica'].'.png', 138 , 37, 23 , 23);
$pdf->SetFont('Arial', 'B',10);
$pdf->Cell(50, 5, $_GET['id_radica'], 0, 0, 'J');
$pdf->Ln();

$pdf->SetFont('Arial', '',6);

$pdf->SetXY(160, 44);
$pdf->Cell(50, 7,'Tip. Radicado: Enviada - Hora: '.substr($FecHorRadicado, 11, 5),0, 0, 'J');
$pdf->Ln();

$pdf->SetXY(160, 46);
$pdf->Cell(50, 7,'Dependencia: '.utf8_decode($Dependencia),0, 0, 'L');
$pdf->Ln();

$pdf->SetXY(160, 48);
$pdf->Cell(50, 7,'Oficina: '.utf8_decode($Oficina),0, 0, 'L');
$pdf->Ln();

$pdf->SetXY(160, 50);
$pdf->Cell(50, 7,'# Folios: '.$NumFolios,0, 0, 'L');
$pdf->Ln();

$pdf->SetXY(160, 52);
$pdf->MultiCell(50, 7, "Obser Anex: ".utf8_decode($ObservaAnexos), 0, 'J');
$pdf->Ln();

$pdf->SetXY(160, 54);
$pdf->Cell(50, 7,'Radicado Por: '.$UsuaRadica,0, 0, 'L');

$pdf->Output();
unlink($_REQUEST['id_radica'].'.png');
?>
