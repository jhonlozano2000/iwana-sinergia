<?php
session_start();
include "../../../../../config/class.Conexion.php";
include "../../../../../config/funciones.php";
include "../../../../../config/variable.php";
require('../../../../../config/lib/fpdf/fpdf.php');
include "../../../../../config/funciones_seguridad.php";
include_once "../../../../clases/reportes/radica/class.ReportRadicacionEnviadoIndicadores.php";
require_once '../../../../clases/configuracion/class.ConfigMiEmpresa.php';
require('mc_table_enviado_terceros.php');

$FecDesde = isset($_REQUEST['desde']) ? Convertir_Fecha_A_Mysql($_REQUEST['desde']) : null;
$FecHasta = isset($_REQUEST['hasta']) ? Convertir_Fecha_A_Mysql($_REQUEST['hasta']) : null;
$IdDepen  = isset($_REQUEST['id_depen']) ? $_REQUEST['id_depen'] : null;

$pdf=new PDF_MC_Table('L', 'mm', 'A4');

//set document properties
$pdf->SetAuthor('...::: Iwana :::...');
$pdf->SetTitle('Ventanilla -> Reporte indicadores correspondencia enviada por tercer.');

$pdf->AddPage();
$pdf->SetFont('Arial','',8);
$pdf->AliasNbPages();

$pdf->SetWidths(array(10, 30, 80, 80));

$Regis = ReportRadicacionEnviadoIndicadores::Listar("VER_TERCEROS",$FecDesde, $FecHasta, $IdDepen);
foreach($Regis as $Item){
	$i=0;

	$pdf->Row(array($Item['Total'], $Item['num_docu'], utf8_decode($Item['nom_contac']), utf8_decode($Item['razo_soci'])));
}

$pdf->Output();
?>