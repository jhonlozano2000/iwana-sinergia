<?php
class FormaEnvio{
	private $Accion;
	private $IdForma;
	private $NomForma;
	private $Observa;
	private $Acti;
	
	public function __construct($Accion = null, $IdForma = null, $NomForma = null, $Observa = null, $Acti = null){
		$this -> Accion   = $Accion;
		$this -> IdForma  = $IdForma;
		$this -> NomForma = $NomForma;
		$this -> Observa  = $Observa;
		$this -> Acti     = $Acti;
	}

	public function get_IdForma() {
		return $this -> IdForma;
	}

	public function get_NomForma() {
		return $this -> NomForma;
	}

	public function get_Observa() {
		return $this -> Observa;
	}

	public function get_Acti() {
		return $this -> Acti;
	}

	public function set_Accion($Accion) {
		return $this -> Accion = $Accion;
	}

	public function set_IdForma($IdForma) {
		return $this -> IdForma = $IdForma;
	}
	
	public function set_NomForma($NomForma) {
		return $this -> NomForma = $NomForma;
	}

	public function set_Observa($Observa) {
		return $this -> Observa = $Observa;
	}

	public function set_Acti($Acti) {
		return $this -> Acti = $Acti;
	}


	public function Gestionar(){
		$conexion = new Conexion();

		if($this->Accion == 'Insertar'){
			$Sql = "INSERT INTO config_formaenvio(nom_formaenvi, observa, acti) 
					VALUES('".$this->NomForma."', '".$this->Observa."', 1)";
		}if($this->Accion == 'Editar'){
			$Sql = "UPDATE config_formaenvio 
					SET nom_formaenvi = '".$this->NomForma."', observa = '".$this->Observa."', acti = ".$this->Acti." 
					WHERE id_formaenvio = ".$this->IdForma;
		}if($this->Accion == 'ACTIVAR_INACTIVAR'){
			$Sql = "UPDATE config_formaenvio 
					SET acti = ".$this->Acti."
					WHERE id_formaenvio = ".$this->IdForma;
		}if($this->Accion == 'Eliminar'){
			$Sql = "DELETE 
					FROM config_formaenvio 
					WHERE id_formaenvio = ".$this->IdForma;
		}

		$Instruc = $conexion -> prepare($Sql);
		$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
		$conexion = null;	

		if($Instruc){
			return true;
		}else{
			return false;
		}
	}
	
	public static function Listar($Accion, $Id){
		$conexion = new Conexion();
		
		if($Accion == 1){
			$SqlBuscar = "SELECT * FROM config_formaenvio ORDER BY nom_formaenvi";
		}elseif($Accion == 2){
			$SqlBuscar = "SELECT * FROM config_formaenvio WHERE id_formaenvio = ".$Id;
		}

		$Instruc = $conexion->prepare($SqlBuscar);
		$Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$SqlBuscar, true));
		$Result = $Instruc->fetchAll();
		$conexion = null;
		return $Result;
	}
	
	public static function Buscar($Accion, $Id) {
		$conexion = new Conexion();
		
		if($Accion == 1){
			$SqlBuscar = "SELECT * FROM config_formaenvio WHERE id_formaenvio = ".$Id;
		}

		$Instruc = $conexion->prepare($SqlBuscar);
		$Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$SqlBuscar, true));
		$Result = $Instruc->fetch();
		$conexion = null;
		if ($Result) {
			return new self("", $Result['id_formaenvio'], $Result['nom_formaenvi'], $Result['observa'], $Result['acti']);
		} else {
			return false;
		}
	}
}
?>