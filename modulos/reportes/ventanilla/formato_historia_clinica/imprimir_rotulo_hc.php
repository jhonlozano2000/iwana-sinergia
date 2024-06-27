<?php
ob_start();
session_start();
require("../../../../config/lib/fpdf/fpdf.php");
include "../../../../config/lib/qrcode/qrlib.php";
include "../../../../config/class.Conexion.php";
include "../../../../config/variable.php";
include "../../../../config/funciones_seguridad.php";
require_once '../../../clases/radicar/class.RadicaRecibido.php';
require_once '../../../clases/radicar/class.RadicaRecibidoHC.php';
require_once '../../../clases/radicar/class.RadicaRecibidoResponsable.php';
require_once "../../../clases/configuracion/class.ConfigMiEmpresa.php";
require_once '../../../clases/general/class.GeneralTercero.php';
require_once '../../../clases/retencion/class.TRDSubSerie.php';

$Radicado         = RadicadoRecibido::Buscar(1, $_REQUEST['id_radica'], "", "", 0, 0, 0, "", "", "");
$RadicadoHC       = RadicadoRecibidoHC::Buscar(1, $_REQUEST['id_radica'], "", "", 0, 0, 0, "", "", "");
$Paciente         = Tercero::Buscar(2, $Radicado->get_IdRemite(), "", "", "", "", "");
$TerceroFacultado = Tercero::Buscar(2, $RadicadoHC->get_IdTercero(), "", "", "", "", "");
$DatosMiEmpresa   = MiEmpresa::Buscar();
$SubSerie         = SubSerie::Buscar(1, $Radicado->get_IdSubserie(), "", "", "");

$Dependencia    = "";
$FecHorRadicado = $Radicado->get_FecRadica();
$Tercero        = $TerceroFacultado->getNom_Contacto();
$Asunto         = "";
$Responsable    = "";
$Servicio       = $RadicadoHC->get_Servicio();
$Paciente       = $Paciente->getNom_Contacto();
$Documento      = $SubSerie->getSubSerie();

$RegisResponsable = RadicadoRecibidoResponsable::Listar(1,  $_REQUEST['id_radica'], "");
foreach($RegisResponsable as $ItemResponsa) {
    $Responsable = $ItemResponsa['nom_funcio']." ".$ItemResponsa['ape_funcio'];  
    $Dependencia = substr($ItemResponsa['cod_corres'].".".$ItemResponsa['nom_depen'], 0, 20);
}

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
$pdf->SetFont('Arial','B',7);
$pdf->Cell(140, 10,utf8_decode(substr($DatosMiEmpresa->get_RazonSocial(), 0, 26)), 1, 0, 'C');
$pdf->Cell(17, 10,'', 1, 0, 'C');
$pdf->SetFont('Arial','',7);
$pdf->Cell(140, 10, utf8_decode(substr('Rem: '.$Paciente, 0, 32)), 1, 0, 'J');
$pdf->Ln();
if(strlen($DatosMiEmpresa->get_RazonSocial()) >= 26){
	$pdf->SetFont('Arial','B',7);
    $pdf->Cell(140, 10,utf8_decode(substr($DatosMiEmpresa->get_RazonSocial(), 26, strlen($DatosMiEmpresa->get_RazonSocial()))), 1, 0, 'C');
    $pdf->Cell(17, 10,'', 1, 0, 'C');
    //$pdf->Cell(140, 10,utf8_decode(substr($DatosMiEmpresa->get_RazonSocial(), 26, strlen($DatosMiEmpresa->get_RazonSocial()))), 1, 0, 'C');
    //$pdf->Ln();
}

$pdf->SetFont('Arial','',7);
$pdf->Cell(140, 9, utf8_decode(substr('Ter: '.$Tercero, 0, 32)), 1, 0, 'J');
$pdf->Ln();

$pdf->SetFont('Arial', 'B',17);
$pdf->Cell(140, 20, $_GET['id_radica'], 1, 0, 'C');
$pdf->Cell(17, 25,'', 1, 0, 'C');
$pdf->SetFont('Arial','',7);
//$pdf->Cell(140, 9, utf8_decode($Documento), 1, 0, 'J');
$pdf->MultiCell(140, 8, utf8_decode($Documento), 'BLR', 'J', false);

$pdf->Ln();

$pdf->SetFont('Arial', '',7);
$pdf->Cell(140, 9, 'Tip. Radicado: Entrada - Hora: '.substr($FecHorRadicado, 11, 5),0, 0, 'L');
$pdf->Cell(17, 9,'',0, 0, 'C');
$pdf->Cell(140, 9,'Radicado Por: '.$_SESSION['SesionFuncioNom']." ".substr($_SESSION['SesionFuncioApe'], 0, 1),0, 0, 'L');
$pdf->Ln();

$pdf->Cell(140, 9,'Dependencia: '.utf8_decode($Dependencia),0, 0, 'L');
$pdf->Cell(17, 9,'',0, 0, 'C');
$pdf->Cell(140, 9,'',0, 0, 'L');
$pdf->Ln();



$pdf->Output();
ob_end_flush();
?>