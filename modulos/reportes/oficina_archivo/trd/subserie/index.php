<?php
require('../../../../../config/lib/fpdf/fpdf.php');
require('mc_table_subserie.php');
include "../../../../../config/class.Conexion.php";
include "../../../../../config/funciones.php";
require_once '../../../../clases/retencion/class.TRDSubSerie.php';
require_once '../../../../clases/configuracion/class.ConfigMiEmpresa.php';

$pdf=new PDF_MC_Table();
$pdf->AddPage();
$pdf->SetFont('Arial','',11);
$pdf->AliasNbPages();

//set document properties
$pdf->SetAuthor('...::: Iwana :::...');
$pdf->SetTitle('TRD -> SubSeries');

//Establecemos los márgenes izquierda, arriba y derecha: 
$pdf->SetMargins(10, 7 , 5); 
//Establecemos el margen inferior: 
$pdf->SetAutoPageBreak(true, 15); 

$pdf->SetWidths(array(10, 100, 10, 70));
$Regis=SubSerie::Listar(5, "", "", "", "");

foreach ($Regis as $Item){
	$ActiSubSerie = "No";
	if($fila['acti_subserie'] = 1){
		$ActiSubSerie = "Si";
	}

	$ActiDocu = "No";
	if($fila['acti_docu'] = 1){
		$ActiDocu = "Si";
	}

	$pdf->Row(array($ActiSubSerie, $Item['cod_subserie'].".".utf8_decode($Item['nom_subserie']), $ActiDocu, utf8_decode($Item['nom_tipodoc'])));
}

$pdf->Output();
?>