<?php
require('../../../../../config/lib/fpdf/fpdf.php');
require('mc_table_subserie.php');
include "../../../../../config/class.Conexion.php";
include "../../../../../config/funciones.php";
require_once '../../../../clases/retencion/class.TRDSerie.php';
require_once '../../../../clases/configuracion/class.ConfigMiEmpresa.php';

$pdf=new PDF_MC_Table();
$pdf->AddPage();
$pdf->SetFont('Arial','',11);
$pdf->AliasNbPages();

//set document properties
$pdf->SetAuthor('...::: Iwana :::...');
$pdf->SetTitle('TRD -> Series');

//Establecemos los márgenes izquierda, arriba y derecha: 
$pdf->SetMargins(10, 7 , 5); 
//Establecemos el margen inferior: 
$pdf->SetAutoPageBreak(true, 15); 


$pdf->SetWidths(array(10,100, 80));
$Regis=Serie::Listar(1, "", "", "");

foreach ($Regis as $Item){
	$ActiSerie = "No";
	if($fila['acti'] = 1){
		$ActiSerie = "Si";
	}

	$pdf->Row(array($ActiSerie, $Item['cod_serie'].".".utf8_decode($Item['nom_serie']), utf8_decode($Item['observa'])));
}

$pdf->Output();
?>