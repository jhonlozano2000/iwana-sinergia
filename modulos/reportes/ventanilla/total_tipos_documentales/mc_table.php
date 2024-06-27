<?php
ob_start();
class PDF_MC_Table extends FPDF
{

	//Cabecera de página
	function Header()
	{
		$MiEmpresa = MiEmpresa::Buscar();
		$OtrasConfiguraciones = ConfigOtras::Buscar();

		if($MiEmpresa->get_Logo() != ""){
			$this->Image('../../../../archivos/otros/'.$MiEmpresa->get_Logo(), 13, 11, 30 , 13);
		}
        
		$this->SetFont('Arial','B',12);
		$this->Cell(40,7, '','LT',0,'C');
		$this->Cell(240,7,utf8_decode($OtrasConfiguraciones->get_CoresReciTitulo()),1, 'R','C');
		$this->Ln();
		$this->Cell(40,7, '','LR',0,'C');
		$this->Cell(240,7,  utf8_decode($OtrasConfiguraciones->get_CoresReciSubTitulo()),'R',0,'C');
		$this->SetFont('Arial','',9);
		$this->Ln();
		$this->Cell(100,5, utf8_decode('Código: '.$OtrasConfiguraciones->get_CoresReciCodigo()),1,0,'L');
		$this->Cell(100,5, utf8_decode('Versión: '.$OtrasConfiguraciones->get_CoresReciVersion()),1,0,'L');
		$this->Cell(80,5, 'Pag '.$this->PageNo().'/{nb}',1,0,'L');
		$this->Ln();
		$this->SetFont('Arial','B',12);
		$this->Cell(280,7, utf8_decode($MiEmpresa->get_RazonSocial()),1, 'R','C');
		$this->Ln(10);
		$this->SetFont('Arial','B',10);
        $this->SetFillColor(0, 76, 156);//Fondo verde de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco
        $this->Cell(30,5, utf8_decode('# Radicado'),1, 0 , 'C', true);
        $this->Cell(30,5, utf8_decode('Llegada'),1, 0 , 'C', true);
        $this->Cell(75,5, utf8_decode('Asunto'),1, 0 , 'C', true);
        $this->Cell(40,5, utf8_decode('Responsable'),1, 0 , 'C', true);
        $this->Cell(40,5, utf8_decode('Remitente'),1, 0 , 'C', true);
        $this->Cell(10,5, utf8_decode('# F'),1, 0 , 'C', true);
        $this->Cell(20,5, utf8_decode('Nombres'),1, 0 , 'C', true);
        $this->Cell(35,5, utf8_decode('Firma'),1, 0 , 'C', true);
        $this->Ln();
    }

    function Footer(){
    	$MiEmpresa = MiEmpresa::Buscar();

    	$this->SetY(-13);
    	$this->SetFont('Arial','I',8);
    	$Direccion = utf8_decode("Dir.: ".$MiEmpresa->get_Dir().",  Tel: ".$MiEmpresa->get_Tel().",  Cel: ".$MiEmpresa->get_Cel().", E - Mail: ".$MiEmpresa->get_Email().", Web: ".$MiEmpresa->get_Web());
    	$this->Cell(1);
    	$this->Image('../../../../public/assets/img/logo.png', 5, 200, 18, 5);
    	$this->Cell(8,4,'Generado Por.',0,0,'C');
    	$this->Cell(220,10,$Direccion,0,0,'C');
    	$this->SetFont('Arial','I',7);
    	$this->Cell(50,10, 'Impreso por: '.utf8_decode($_SESSION['SesionFuncioNom']." ".$_SESSION['SesionFuncioApe']),0,0,'R');
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
ob_end_flush();
?>
