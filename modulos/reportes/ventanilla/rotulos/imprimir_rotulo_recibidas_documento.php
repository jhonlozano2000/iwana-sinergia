<?php
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

foreach($Radicado as $Item):

    $FecHorRadicado = $Item['fechor_radica'];

    if($Item['razo_soci_remite'] != ""){
        $Tercero = $Item['razo_soci_remite'].", Contac.: ".$Item['nom_remite'];
    }else{
        $Tercero = $Item['nom_remite'];
    }

    $UsuaRadica    = $Item['nom_funcio_regis']." ".substr($Item['ape_funcio_regis'], 0, 1);
    $Asunto        = $Item['asunto'];
    $NumFolios     = $Item['num_folio'];
    $NumAnexos     = $Item['num_anexos'];
    $ObservaAnexos = $Item['observa_anexo'];
endforeach;

$RegisResponsable = RadicadoRecibidoResponsable::Listar(1, $_REQUEST['id_radica'], "");
foreach($RegisResponsable as $ItemResponsa) {
    $Responsable = $ItemResponsa['nom_funcio']." ".$ItemResponsa['ape_funcio'];
    $Dependencia = substr($ItemResponsa['cod_corres'].".".$ItemResponsa['nom_depen'], 0, 20);
    $Oficina = substr($ItemResponsa['cod_oficina'].".".$ItemResponsa['nom_oficina'], 0, 20);
}

QRcode::png("Radicado: ".$_REQUEST['id_radica']."
Tip. Radicado: Entrada
Hora: ".substr($FecHorRadicado, 11, 5)."
Tercero: ".$Tercero."
Asunto: ".substr($Asunto, 0, 80), $_REQUEST['id_radica'].'.png', QR_ECLEVEL_L, 2);

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',6);
//set document properties
$pdf->SetAuthor('...::: Iwana :::...');
$pdf->SetTitle('Imprimir rotulo: '.$_REQUEST['id_radica']);

$pdf->SetFont('Arial','B',7);
$pdf->SetXY(160, 39);
$pdf->MultiCell(50, 2, $MiEmpresa->get_RazonSocial(), 0, 'C');
$pdf->Ln();

$pdf->SetXY(160, 41);
$pdf->Image($_REQUEST['id_radica'].'.png', 138 , 37, 23 , 23);
$pdf->SetFont('Arial', 'B',10);
$pdf->Cell(50, 5, $_GET['id_radica'], 0, 0, 'J');
$pdf->Ln();

$pdf->SetFont('Arial', '',6);

$pdf->SetXY(160, 44);
$pdf->Cell(50, 7,'Tip. Radicado: Entrada - Hora: '.substr($FecHorRadicado, 11, 5),0, 0, 'J');
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
$pdf->Cell(50, 7,"Obser Anex: ".$ObservaAnexos,0, 0, 'L');
$pdf->Ln();

$pdf->SetXY(160, 54);
$pdf->Cell(50, 7,'Radicado Por: '.$UsuaRadica,0, 0, 'L');

$pdf->Output();
unlink($_REQUEST['id_radica'].'.png');
?>
