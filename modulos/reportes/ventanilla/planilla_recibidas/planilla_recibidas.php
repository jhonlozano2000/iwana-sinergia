<?php
ob_start();
session_start();
require('../../../../config/lib/fpdf/fpdf.php');
require('mc_table.php');
include "../../../../config/class.Conexion.php";
include "../../../../config/funciones.php";
include "../../../../config/variable.php";
include "../../../../config/funciones_seguridad.php";
require_once '../../../clases/radicar/class.RadicaRecibido.php';
require_once '../../../clases/configuracion/class.ConfigMiEmpresa.php';
require_once '../../../clases/configuracion/class.ConfigOtras.php';

$pdf=new PDF_MC_Table('L', 'mm', 'A4');
$pdf->AddPage('L', 'A4');
$pdf->SetFont('Arial','',10);
$pdf->AliasNbPages();

//set document properties
$pdf->SetAuthor('...::: Iwana :::...');
$pdf->SetTitle('Planilla correspondencia recibida');

//Establecemos los márgenes izquierda, arriba y derecha: 
$pdf->SetMargins(10, 7 , 5); 
//Establecemos el margen inferior: 
$pdf->SetAutoPageBreak(true, 15); 

$pdf->SetWidths(array(30, 30, 55, 40, 40, 20, 30, 35));

$Accion = "";
if($_REQUEST['accion'] == "Fecha"){
    $Regis=RadicadoRecibido::Listar_Vario(6, "", "", "", "", "", Convertir_Fecha_A_Mysql($_REQUEST['FechaInicio'])." ".$_REQUEST['HoraInicio'], Convertir_Fecha_A_Mysql($_REQUEST['FechaFin'])." ".$_REQUEST['HoraFin'], "");
}elseif($_REQUEST['accion'] == "Radicado"){
    $Regis=RadicadoRecibido::Listar_Vario(7, "", "", "", "", "", $_REQUEST['radicado_desde'], $_REQUEST['radicado_hasta'], "");
}

$i = 0;
foreach ($Regis as $Item){
	$i=$i+1;
	$Remite = "";
	if($Item['razo_soci'] != ""){
        $Remite = $Item['razo_soci'];
    }else{
        $Remite = $Item['nom_contac'];
    }

    $pdf->Row(array($Item['id_radica'], $Item['hor_llegada'], utf8_decode($Item['asunto']), utf8_decode($Item['nom_funcio']." ".$Item['ape_funcio']), $Remite, $Item['num_folio']."/".$Item['num_anexos'], '', ''));
}

$pdf->Output();
ob_end_flush();
?>