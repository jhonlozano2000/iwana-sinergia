<?php
class ArchivoProducDocu{
	private $Accion;
	private $IdDocu;
	private $IdFuncioCrea;
	private $IdTipoDocu;
	private $FecHorRegis;
	private $IdFuncioFirma;
	private $FecHorFirma;

	public function __construct($Accion == null, $IdDocu = null, $IdFuncioCrea = null, $IdTipoDocu = null, $FecHorRegis = null, $IdFuincioFirma = null, $FecHorFirma = null){
		$this->Accion = $Accion;
		$this->IdDocu = $IdDocu;
		$this->IdFuncioCrea = $IdFuncioCrea;
		$this->IdTipoDocu = $IdTipoDocu;
		$this->FecHorRegis = $FecHorRegis;
		$this->IdFuncioFirma = $IdFuncioFirma;
		$this->FecHorFirma = $FecHorFirma;
	}

	public function get_IdDocu(){
		return $this -> IdDocu;
	}

	public function get_IdFuncioCrea(){
		return $this -> IdFuncioCrea;
	}

	public function get_IdTipoDocu(){
		return $this -> IdTipoDocu;
	}

	public function get_FecHorRegis(){
		return $this -> FecHorRegis;
	}

	public function get_IdFuncioFirma(){
		return $this -> IdFuncioFirma;
	}

	public function get_FecHorFirma(){
		return $this -> FecHorFirma;
	}

	public function get_Accion($Accion)
		$this->Accion = $Accion;
	}

	public function get_IdDocu($IdDocu)
		$this->IdDocu = $IdDocu;
	}

	public function get_IdFuncioCrea($IdFuncioCrea)
		$this->IdFuncioCrea = $IdFuncioCrea;
	}

	public function get_IdTipoDocu($IdTipoDocu)
		$this->IdTipoDocu = $IdTipoDocu;
	}

	public function get_FecHorRegis($FecHorRegis)
		$this->FecHorRegis = $FecHorRegis;
	}

	public function get_IdFuncioFirma($IdFuncioFirma)
		$this->IdFuncioFirma = $IdFuncioFirma;
	}

	public function get_FecHorFirma($FecHorFirma)
		$this->FecHorFirma = $FecHorFirma;
	}

	public function Gestionar(){
		$conexion = new Conexion();

		try{
			if($this->Accion == 'NUEVO_DOCUMENTO'){
			}
		}catch(PDOException $e){
			echo 'Ha surgido un error y no se puede ejecutar la consulta.'.$e->getMessage();
			exit;
		}
	}

}
?>