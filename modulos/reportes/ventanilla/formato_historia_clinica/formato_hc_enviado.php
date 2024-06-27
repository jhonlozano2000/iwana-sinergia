<?php
ob_start();
session_start();
require('../../../../config/lib/fpdf/fpdf.php');
include "../../../../config/class.Conexion.php";
include "../../../../config/funciones.php";
include "../../../../config/variable.php";
include "../../../../config/funciones_seguridad.php";
require_once '../../../clases/radicar/class.RadicaRecibido.php';
require_once '../../../clases/radicar/class.RadicaRecibidoResponsable.php';
require_once '../../../clases/radicar/class.RadicaRecibidoHC.php';
require_once '../../../clases/radicar/class.RadicaEnviado Final.php';
require_once '../../../clases/radicar/class.RadicaEnviadoResponsable.php';
require_once '../../../clases/general/class.GeneralTercero.php';
require_once '../../../clases/configuracion/class.ConfigMiEmpresa.php';
require_once '../../../clases/configuracion/class.ConfigOtras.php';
require_once '../../../clases/configuracion/class.ConfigParentesco.php';


class PDF extends FPDF{

	function Header(){
		$MiEmpresa = MiEmpresa::Buscar();
		$OtrasConfiguraciones = ConfigOtras::Buscar();
		
		if($MiEmpresa->get_Logo() != ""){
			$this->Image('../../../../archivos/otros/'.$MiEmpresa->get_Logo(), 13, 11, 30 , 13);
		}
        
		$this->SetFont('Arial','B',12);
		$this->Cell(40,7, '','LT',0,'C');
		$this->Cell(150,7,utf8_decode($OtrasConfiguraciones->get_HC_Titulo()),1, 'R','C');
		$this->Ln();
		$this->Cell(40,7, '','LR',0,'C');
		$this->Cell(150,7,  utf8_decode($OtrasConfiguraciones->get_HC_SubTitulo()),'R',0,'C');
		$this->SetFont('Arial','',9);
		$this->Ln();
		$this->Cell(67,5, utf8_decode('Código: '.$OtrasConfiguraciones->get_HC_Codigo()),1,0,'L');
		$this->Cell(60,5, utf8_decode('Versión: '.$OtrasConfiguraciones->get_HC_Version()),1,0,'L');
		$this->Cell(63,5, 'Pag '.$this->PageNo().'/{nb}',1,0,'L');
		$this->Ln();
		$this->SetFont('Arial','B',12);
		$this->Cell(190,7, utf8_decode($MiEmpresa->get_RazonSocial()),1,0,'C');
	}

	//Pie de página
	function Footer(){
		$MiEmpresa = MiEmpresa::Buscar();

		$this->Image('../../../../public/assets/img/logo.png', 5, 342, 18, 5);
    	$this->SetY(-13);
    	$this->SetFont('Arial','I',8);
    	$Direccion = "Dir.: ".$MiEmpresa->get_Dir().",  Tel: ".$MiEmpresa->get_Tel().",  Cel: ".$MiEmpresa->get_Cel().", E - Mail: ".$MiEmpresa->get_Email().", Web: ".$MiEmpresa->get_Web();
    	$this->Cell(190,4,$Direccion,0,0,'C');
    	$this->Ln();
    	$this->SetFont('Arial','I',7);
    	$this->Cell(8,4,'Generado Por.',0,0,'C');
    	$this->SetFont('Arial','I',6);
    	$this->Cell(190,10, 'Impreso por: '.$_SESSION['SesionFuncioNom']." ".$_SESSION['SesionFuncioApe'],0,0,'R');
	}

	function Datos_Solicitud(){

		$RadicadoRecibidoHC = RadicadoRecibidoHC::Buscar(1, $_REQUEST['id_radica_recibido'], "");
		$RadicadoRecibido   = RadicadoRecibido::Buscar(1, $_REQUEST['id_radica_recibido'], "", "", "", "");
		$Paciente           = Tercero::Buscar(2, $RadicadoRecibido->get_IdRemite(), "", "", "", "", "", "");
		$CorreoPaciente     = "";
		
		if($RadicadoRecibidoHC->get_EnvioEmailPacien() === 1){
			$CorreoPaciente = $Paciente->get_Email();
		}
		
		$this->Ln(10);
		$this->SetFillColor(0, 76, 156);//Fondo azul de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco
        $this->SetFont('Arial','B',12);
		$this->Cell(190, 7, 'DATOS DE LA SOLICITUD', 'BLR', 0,'C', true);
		$this->SetFont('Arial','',12);
		$this->Ln();
		$this->SetTextColor(028, 028, 028); //Letra color negro	
		$this->SetFont('Arial','',11);
		$this->Cell(90, 6, 'Paciente: '.$Paciente->getNom_Contacto(), 'BL', 0,'L');
		$this->Cell(50, 6, 'Documento: '.$Paciente->getNum_Documetno(), 'BLR', 0,'L');
		//$this->Cell(50, 6, '', 'R', 0,'L');
		$this->SetFont('Arial','B',17);
		$this->Cell(50, 6, 'Radicado: ', 'R', 0,'C');
		$this->SetFont('Arial','',12);
		$this->Ln();
		$this->Cell(90, 6, utf8_decode('Periodo de Atención: '.$RadicadoRecibidoHC->get_PeriodoDesde()." - ".$RadicadoRecibidoHC->get_PeriodoHasta()), 'BL', 0,'L');
		$this->Cell(50, 6, ' Servicio: '.$RadicadoRecibidoHC->get_Servicio(), 'BLR', 0,'L');
		$this->SetFont('Arial','B',17);
		$this->Cell(50, 6, $_REQUEST['id_radica_recibido'], 'BLR', 0,'C');
		$this->SetFont('Arial','',12);
		$this->Cell(50, 6, '', 'R', 0,'L');
		$this->Ln();
		$this->Cell(90, 6, utf8_decode('Direción: '.$Paciente->get_Dir()), 'BL', 0,'L');
		$this->Cell(50, 6, ' Tel.: '.$Paciente->get_Tel(), 'BLR', 0,'L');
		$this->Cell(50, 6, '', 'BR', 0,'L');
		$this->Ln();
		$this->MultiCell(190, 6, utf8_decode('Motivo de la consulta: '.$RadicadoRecibido->get_Asunto()), 'BLR', 'J', false);
		$this->MultiCell(190, 6, utf8_decode('Anexos: '.$RadicadoRecibido->get_ObservaAneos()), 'BLR', 'J', false);
		$this->Cell(190, 6, utf8_decode('Autorizo enviar al siguiente correo: '.$CorreoPaciente), 'BLR', 0,'L');
	}

	function Terceros_Facultados(){

		$RadicadoRecibidoHC = RadicadoRecibidoHC::Buscar(1, $_REQUEST['id_radica_recibido'], "");

		$ParentescoTercero = "";
		$CorreoTercero = "";
		$TerceroNombre = "";
		$RadicadoEnviadoObservaciones = "";

		if($RadicadoRecibidoHC){
			
			$RadicadoEnviado  = RadicadoEnviado::Buscar(1, $_REQUEST['id_radica_enviado'], "");
			$TerceroFacultado = Tercero::Buscar(2, $RadicadoRecibidoHC->get_IdTercero(), "", "", "", "", "", "");
			$Parentesco       = Parentesco::Buscar(1, $RadicadoRecibidoHC->get_IdParenTercero(), "");
			
			if($RadicadoRecibidoHC->get_IdParenTercero() != ""){
				$ParentescoTercero            = $Parentesco->get_NomParen();
			}
			$RadicadoEnviadoObservaciones = $RadicadoEnviado->get_ObservaAneos();

			if($RadicadoRecibidoHC->get_EnvioEmailTercer() === 1){
				
				$TerceroFacultado = Tercero::Listar(2, $RadicadoRecibidoHC->get_IdTercero(), "", "", "", "", "", "");
				
				foreach ($TerceroFacultado as $Item) {

					if($Item['razo_soci'] != ""){
						$TerceroNombre = $Item['razo_soci']." - ".$Item['nom_contac'];
					}else{
						$TerceroNombre = $Item['nom_contac'];
					}
					
					if($Item['email_remite'] != ""){
						$CorreoTercero = $Item['email_remite'];		
					}else{
						$CorreoTercero = $Item['email_empre'];	
					}
				}
			}
		}

		$this->Ln();
		$this->SetFillColor(0, 76, 156);//Fondo verde de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco
        $this->SetFont('Arial','B',12);
        $this->Cell(190, 7, 'Diligenciar solo para solicitudes de terceros facultados ', 'BLR', 0,'L', true);
        $this->SetFont('Arial','',12);
		$this->Ln();
		$this->SetTextColor(028, 028, 028); //Letra color blanco
		$this->Cell(120, 6, 'Solicitante: '.utf8_decode($TerceroNombre), 'BL', 0,'L');
		$this->Cell(70, 6, 'Parentesco: '.$ParentescoTercero, 'BLR', 0,'L');
		$this->Ln();
		$this->MultiCell(190, 6, utf8_decode('Anexos: '.$RadicadoEnviadoObservaciones), 'BLR', 'J', false);
		$this->Cell(190, 6, utf8_decode('Autorizo enviar al siguiente correo: '.$CorreoTercero), 'BLR', 0,'L');
	}

	function Datos_Entrega(){

		$RadicadoEnviado = RadicadoEnviado::Buscar(2, $_REQUEST['id_radica_enviado']);
		$RadicadoRecibidoHC = RadicadoRecibidoHC::Buscar(1, $_REQUEST['id_radica_recibido'], "");
		$RadicadoRecibidoResponsable = RadicadoRecibidoResponsable::Listar(1, $_REQUEST['id_radica_recibido'], "");
		$QuienAtiende = "";
		foreach ($RadicadoRecibidoResponsable as $Item) {
			$QuienAtiende = $Item['nom_funcio']." ".$Item['ape_funcio'];
		}

		$this->Ln();
		$this->SetFont('Arial','B',12);
		$this->SetFillColor(0, 76, 156);//Fondo azul de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco
		$this->Cell(190, 7, 'DATOS DE LA ENTREGA', 'BLR', 0,'C', true);
		$this->Ln();
		$this->SetTextColor(028, 028, 028); //Letra color negro	
		$this->SetFont('Arial','',11);
		$this->Cell(150, 6, 'Quien Atiende la solicitud: '.$QuienAtiende, 'BL', 0,'L');
		$this->Cell(40, 6, 'Estado: '.$RadicadoRecibidoHC->get_Estado(), 'BLR', 0,'L');
		$this->Ln();
		$this->MultiCell(190, 6, utf8_decode('Observaciones: '.$RadicadoEnviado->get_Asunto()), 'BLR', 'J');
		$this->Cell(40, 6, 'Medio de entrega: ', 'L', 0,'L');
		$this->Cell(20, 6, 'Fisico: ', 0, 0,'L');
		$this->Cell(30, 6, 'No. Folios: ', 0, 0,'L');
		$this->Cell(50, 6, 'Valor: ', 'R', 0,'L');
		//$this->Cell(50, 6, '', 'R', 0,'L');
		$this->SetFont('Arial','B',17);
		$this->Cell(50, 6, 'Radicado: ', 'R', 0,'C');
		$this->SetFont('Arial','',12);
		$this->Ln();
		$this->Cell(30, 6, 'Digital: ', 'LB', 0,'L');
		$this->Cell(30, 6, 'Correo e: ', 'B', 0,'L');
		$this->Cell(20, 6, 'CD: ', 'B', 0,'L');
		$this->Cell(60, 6, 'No. Folios: ', 'BR', 0,'L');
		$this->SetFont('Arial','B',17);
		$this->Cell(50, 6, $_REQUEST['id_radica_enviado'], 'RB', 0,'C');
		$this->SetFont('Arial','',12);
		$this->Cell(50, 6, '', 'R', 0,'L');
		$this->Ln();
		$this->Cell(120, 6, 'Nombre: ', 'LR', 0,'L');
		$this->Cell(70, 6, 'Firma: ', 'BR', 0,'L');
		$this->Ln();
		$this->Cell(120, 6, '', 'LBR', 0,'L');
		$this->Cell(70, 6, '# Documento: ', 'BR', 0,'L');
		$this->Ln();
		$this->Cell(190, 6, 'Entrega: '.$_SESSION['SesionFuncioNom']." ".$_SESSION['SesionFuncioApe'], 'LBR', 0,'L');
	}
}

//Creación del objeto de la clase heredada
$pdf=new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);

$pdf->SetAuthor('...::: Iwana :::...');
$pdf->SetTitle(utf8_decode('Solicitudes de historias clínicas ').$_REQUEST['id_radica_enviado']);

$pdf->Datos_Solicitud();
$pdf->Terceros_Facultados();
$pdf->Datos_Entrega();

$pdf->Output();
ob_end_flush();
?>