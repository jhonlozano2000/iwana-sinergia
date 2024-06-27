<?php
class PDF_MC_Table extends FPDF
{

	//Cabecera de página
	function Header(){
		$MiEmpresa = MiEmpresa::Buscar();

		if($MiEmpresa->get_Logo() != ""){
			$this->Image('../../../../archivos/otros/'.$MiEmpresa->get_Logo(), 5, 5, 20 , 13);
		}

		$this->SetFont('Arial','B',12);
		$this->Cell(280,6,$MiEmpresa->get_RazonSocial(),0,0,'C');
		$this->Ln();
		$this->Cell(280,6, 'Ventanilla -> Reporte indicadores correspondencia enviada por responsable.',0,0,'C');
		$this->SetFont('Arial','',10);
		$this->Ln(8);
        $this->SetXY(10, 30);
        $this->Cell(280,5, ">> Reporte generado desde la fecha ".utf8_decode(Fecha_Larga_Español(Convertir_Fecha_A_Mysql($_REQUEST['desde']))." hasta el día ".Fecha_Larga_Español(Convertir_Fecha_A_Mysql($_REQUEST['desde']))).".",0, 0, 'J');
        $this->Ln(8);
        $this->SetFont('Arial','B',10);
        $this->SetFillColor(0, 76, 156);//Fondo verde de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco
        
        $this->Cell(10,5, utf8_decode('TOT'),1, 0, 'C', true);
        $this->Cell(80,5, utf8_decode('RESPONSABLE'),1, 0, 'C', true);
        $this->Cell(80,5, utf8_decode('DEPENDENCIA'),1, 0, 'C', true);
        $this->Cell(80,5, utf8_decode('OFICINA'),1, 0, 'C', true);

        $this->Ln();
	}

	function Footer(){
		$MiEmpresa = MiEmpresa::Buscar();

		$this->SetY(-13);
		$this->SetFont('Arial','I',8);
		$Direccion = utf8_decode("Dir.: ".$MiEmpresa->get_Dir().", Tel: ".$MiEmpresa->get_Tel().", Cel: ".$MiEmpresa->get_Cel().", E - Mail: ".$MiEmpresa->get_Email().", Web: ".$MiEmpresa->get_Web());
		$this->Cell(1);
		$this->Image('../../../../public/assets/img/logoFirma.png', 5 , 200, 25 , 8);
		$this->Cell(280,5,$Direccion,0,0,'C');
		$this->Ln(3);
		$this->Cell(0,5,'Pag '.$this->PageNo().'/{nb}',0,0,'C');
		$this->Ln(3);
		$this->SetFont('Arial','I',7);
    	$this->Cell(0,3, 'Impreso por: '.$_SESSION['SesionFuncioNom']." ".$_SESSION['SesionFuncioApe'],0,0,'R');
    	$this->Ln();
    	$this->Cell(0,3, 'Fec. Hor. Impreso: '.Fecha_Hora_Actual(),0,0,'R');
	}

	var $widths;
	var $aligns;

	function SetWidths($w)
	{
	//Set the array of column widths
		$this->widths=$w;
	}

	function SetAligns($a)
	{
	//Set the array of column alignments
		$this->aligns=$a;
	}

	function Row($data)
	{
	//Calculate the height of the row
		$nb=0;
		for($i=0;$i<count($data);$i++)
			$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
		$h=5*$nb;
	//Issue a page break first if needed
		$this->CheckPageBreak($h);
	//Draw the cells of the row
		for($i=0;$i<count($data);$i++)
		{
			$w=$this->widths[$i];
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
		//Save the current position
			$x=$this->GetX();
			$y=$this->GetY();
		//Draw the border
			$this->Rect($x,$y,$w,$h);
		//Print the text
			$this->MultiCell($w,5,$data[$i],0,$a);
		//Put the position to the right of the cell
			$this->SetXY($x+$w,$y);
		}
	//Go to the next line
		$this->Ln($h);
	}

	function CheckPageBreak($h)
	{
	//If the height h would cause an overflow, add a new page immediately
		if($this->GetY()+$h>$this->PageBreakTrigger)
			$this->AddPage($this->CurOrientation);
	}

	function NbLines($w,$txt)
	{
	//Computes the number of lines a MultiCell of width w will take
		$cw=&$this->CurrentFont['cw'];
		if($w==0)
			$w=$this->w-$this->rMargin-$this->x;
		$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
		$s=str_replace("\r",'',$txt);
		$nb=strlen($s);
		if($nb>0 and $s[$nb-1]=="\n")
			$nb--;
		$sep=-1;
		$i=0;
		$j=0;
		$l=0;
		$nl=1;
		while($i<$nb)
		{
			$c=$s[$i];
			if($c=="\n")
			{
				$i++;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
				continue;
			}
			if($c==' ')
				$sep=$i;
			$l+=$cw[$c];
			if($l>$wmax)
			{
				if($sep==-1)
				{
					if($i==$j)
						$i++;
				}
				else
					$i=$sep+1;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
			}
			else
				$i++;
		}
		return $nl;
	}
}
?>
