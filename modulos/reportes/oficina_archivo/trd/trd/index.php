<?php
require('../../../../../config/lib/fpdf/fpdf.php');
require('mc_table_trd.php');
include "../../../../../config/class.Conexion.php";
include "../../../../../config/funciones.php";
require_once '../../../../clases/retencion/calss.TRD.php';
require_once '../../../../clases/configuracion/class.ConfigMiEmpresa.php';

$pdf=new PDF_MC_Table();
$pdf->AddPage('L', 'A4');
$pdf->SetFont('Arial','',10);
$pdf->AliasNbPages();

//set document properties
$pdf->SetAuthor('...::: Iwana :::...');
$pdf->SetTitle('TRD -> TRD');

//Establecemos los márgenes izquierda, arriba y derecha: 
$pdf->SetMargins(10, 7 , 5); 
//Establecemos el margen inferior: 
$pdf->SetAutoPageBreak(true, 15); 


$pdf->SetWidths(array(10, 60, 50, 60, 100));
$Regis=TRD::Listar(10, "", "", "", "");

foreach ($Regis as $Item){
   $ActiSerie = "No";
   if($fila['acti_serie'] = 1){
      $ActiSerie = "Si";
  }

$TipoDocu = TRD::Listar(11, "", "", "", $Item['id_subserie']);
  $pdf->Row(array($ActiSerie, utf8_decode($Item['nom_depen']), $Item['cod_serie'].".".utf8_decode($Item['nom_serie']), $Item['cod_subserie'].".".utf8_decode($Item['nom_subserie']), utf8_decode($Item['nom_tipodoc'])));
}

$pdf->Output();
?>