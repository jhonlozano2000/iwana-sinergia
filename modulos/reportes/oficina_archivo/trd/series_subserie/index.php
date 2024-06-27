<?php
require('../../../../../config/lib/fpdf/fpdf.php');
require('mc_table_subserie.php');
include "../../../../../config/class.Conexion.php";
include "../../../../../config/funciones.php";
require_once '../../../../clases/retencion/class.TRDSerie.php';
require_once '../../../../clases/configuracion/class.ConfigMiEmpresa.php';

$pdf=new PDF_MC_Table();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);
$pdf->AliasNbPages();

//set document properties
$pdf->SetAuthor('...::: Iwana :::...');
$pdf->SetTitle('TRD -> Series y Subseries');

//Establecemos los márgenes izquierda, arriba y derecha: 
$pdf->SetMargins(10, 7 , 5); 
//Establecemos el margen inferior: 
$pdf->SetAutoPageBreak(true, 15); 


$pdf->SetWidths(array(10,70,10,100));
$Regis=Serie::Listar(6, "", "", "");

foreach ($Regis as $Item){
   $ActiSerie = "No";
   if($fila['acti_serie'] = 1){
      $ActiSerie = "Si";
  }

  $ActiSubSerie = "No";
  if($fila['acti_subserie'] = 1){
      $ActiSubSerie = "Si";
  }

  $pdf->Row(array($ActiSerie, $Item['cod_serie'].".".utf8_decode($Item['nom_serie']), $ActiSubSerie, $Item['cod_subserie'].".".utf8_decode($Item['nom_subserie'])));
}

$pdf->Output();
?>