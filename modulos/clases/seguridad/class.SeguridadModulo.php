<?php
class Modulo{
	
	private $Accion;
	private $Id;
	
	public function __construct($Accion = null, $Id = null){
		$this -> Accion = $Accion;
		$this -> Id = $Id;
	}
	
	public static function Listar($Accion, $Id){
		$conexion = new Conexion();
		$SqlBuscar = "CALL sp_Seguri_Modulos(".$Accion.", ".$Id.")";
		$InstrucBuscar = $conexion->prepare($SqlBuscar);
		$InstrucBuscar->execute() or die(print_r($InstrucBuscar->errorInfo()." - ".$SqlBuscar, true));
		$Result = $InstrucBuscar->fetchAll();
		$conexion = null;
		return $Result;
	}
	
	public static function Buscar($Accion, $Id) {
		$conexion = new Conexion();
		$SqlBuscar = "CALL sp_Seguri_Modulos(".$Accion.", ".$Id.")";
		$InstrucBuscar = $conexion->prepare($SqlBuscar);
		$InstrucBuscar->execute() or die(print_r($InstrucBuscar->errorInfo()." - ".$SqlBuscar, true));
		$Result = $InstrucBuscar->fetch();
		$conexion = null;
		if ($Result) {
			return new self($Result['id_modu'], $Result['modu_padre'], $Result['nom_modu'], $Result['menu'], $Result['boton'], 
				$Result['acti']);
		} else {
			return false; 
		}
	}  
}
?>