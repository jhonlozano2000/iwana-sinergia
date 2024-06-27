<?php
class SeguridadMostrarBuscar{
	
	//Atributos
	private $Rutas;
		
	public function __construct($Rutas = null){

		$this -> Rutas       = $Rutas;
	}
	
	public function getRutas(){
		return $this-> Rutas;
	}

	////////////////////////////
	public function setRutas($Rutas){
		$this-> Rutas = $Rutas;
	}

	public static function Buscar($Ruta) {
		$conexion = new Conexion();
		$conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		try{
			
			$Sql = "SELECT * FROM segu_mostar_buscar
					WHERE ruta = :ruta";

    		$Instruc = $conexion->prepare($Sql);
			$Instruc -> bindParam(':ruta', $Ruta, PDO::PARAM_INT);
			$Instruc -> execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
			$Result = $Instruc->fetch();
			$conexion = null;

			if($Result){
				return new self($Result['ruta']);
			}else{
				return false; 
			}
		}catch(PDOException $e){
			echo 'Ha surgido un error y no se puede ejecutar la consulta.'.$e->getMessage();
			exit;
		}
	}
}
?>