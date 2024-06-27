<?php
class Status{
	private $Accion;
	private $Id;
	private $Nombre;
	private $Acti;

	public function __construct($Accion = null, $Id = null, $Nombre = null, $Acti = null){
		$this -> Accion = $Accion;
		$this -> Id     = $Id;
		$this -> Nombre = $Nombre;
	}

	public function get_Id() {
		return $this -> Id;
	}

	public function get_Nombre() {
		return $this -> Nombre;
	}

	public function get_Acti() {
		return $this -> Acti;
	}

	public function set_Accion($Accion) {
		return $this -> Accion = $Accion;
	}

	public function set_Id($Id) {
		return $this -> Id = $Id;
	}
	
	public function set_Nombre($Nombre) {
		return $this -> Nombre = $Nombre;
	}

	public function set_Acti($Acti) {
		return $this -> Acti = $Acti;
	}

	public function Gestionar(){
		if($this->Accion == 'Insertar'){
			$Sql = "INSERT INTO config_status(status) 
					VALUES('".$this->Nombre."')";
		}if($this->Accion == 'Editar'){
			$Sql = "UPDATE config_status 
					SET status = '".$this->Nombre."', acti = ".$this->Acti."
					WHERE id_status = ".$this->Id;
		}if($this->Accion == 'ACTIVAR_INACTIVAR'){
			$Sql = "UPDATE config_status 
					SET acti = ".$this->Acti."
					WHERE id_status = ".$this->Id;
		}if($this->Accion == 'Eliminar'){
			$Sql = "DELETE 
					FROM config_status 
					WHERE id_status = ".$this->Id;
		}

		$conexion = new Conexion();
		$Instruc = $conexion -> prepare($Sql);
		$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
		$conexion = null;	
		
		if($Instruc){
			return true;
		}else{
			return false;
		}
	}
	
	public static function Listar($Accion, $Id, $Nom){
		$conexion = new Conexion();

		if($Accion == 1){
			$SqlBuscar = "SELECT * FROM config_status ORDER BY status";
		}elseif($Accion == 2){
			$SqlBuscar = "SELECT * FROM config_status WHERE id_status = ".$Id;
		}

		$Instruc = $conexion->prepare($SqlBuscar);
		$Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$SqlBuscar, true));
		$Result = $Instruc->fetchAll();
		$conexion = null;
		return $Result;
	}
	
	public static function Buscar($Accion, $Id, $Nom) {
		$conexion = new Conexion();

		if($Accion == 1){
			$SqlBuscar = "SELECT * FROM config_status ORDER BY status";
		}elseif($Accion == 2){
			$SqlBuscar = "SELECT * FROM config_status WHERE id_status = ".$Id;
		}

		$Instruc = $conexion->prepare($SqlBuscar);
		$Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$SqlBuscar, true));
		$Result = $Instruc->fetch();
		$conexion = null;
		if ($Result) {
			return new self("", $Result['id_status'], $Result['status'], $Result['acti']);
		} else {
			return false;
		}
	}
}
?>