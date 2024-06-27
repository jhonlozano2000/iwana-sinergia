<?php
class ArchivoConfiguracion{
	private $Accion;
	private $RutaLocalRecibidas;
	private $RutaLocalEnviadas;
	
	public function __construct($Accion = null, $RutaLocalRecibidas = null, $RutaLocalEnviadas = null){
		$this -> Accion             = $Accion;
		$this -> RutaLocalRecibidas = $RutaLocalRecibidas;
		$this -> RutaLocalEnviadas  = $RutaLocalEnviadas;
	}

	public function get_RutaLocalRecibidas(){
		return $this -> RutaLocalRecibidas;
	}

	public function get_RutaLocalEnviadas(){
		return $this -> RutaLocalEnviadas;
	}

	
	/////////////////////////////////////
	public function set_Accion($Accion){
		return $this -> Accion = $Accion;
	}

	public function set_RutaLocalRecibidas($RutaLocalRecibidas){
		return $this -> RutaLocalRecibidas = $RutaLocalRecibidas;
	}

	public function set_RutaLocalEnviadas($RutaLocalEnviadas){
		return $this -> RutaLocalEnviadas = $RutaLocalEnviadas;
	}

	public function Gestionar(){
		$conexion = new Conexion();
		$conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$ParamLocalRecibida = PDO::PARAM_INT;
        if (is_null($this->RutaLocalRecibidas) || $this->RutaLocalRecibidas == ""){
            $ParamLocalRecibida =  \PDO::PARAM_NULL;
        }

        $ParamLocalEnviada = PDO::PARAM_INT;
        if (is_null($this->RutaLocalEnviadas) || $this->RutaLocalEnviadas == ""){
            $ParamLocalEnviada =  \PDO::PARAM_NULL;
        }


		try{
			if($this->Accion == 0){
				$Sql = "INSERT INTO archivo_config(archivo_local_recibida, archivo_local_enviada) 
						VALUES(:archivo_local_recibida, :archivo_local_enviada)";

				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':archivo_local_recibida', $this->RutaLocalRecibidas, $ParamLocalRecibida);
				$Instruc -> bindParam(':archivo_local_enviada', $this->RutaLocalEnviadas, $ParamLocalEnviada);
			}elseif($this->Accion == 1){
				$Sql = "UPDATE archivo_config 
						SET archivo_local_recibida = :archivo_local_recibida, archivo_local_enviada = :archivo_local_enviada";

				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':archivo_local_recibida', $this->RutaLocalRecibidas, PDO::PARAM_STR);
				$Instruc -> bindParam(':archivo_local_enviada', $this->RutaLocalEnviadas, PDO::PARAM_STR);
			}
			
			$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			$conexion = null;	

			if($Instruc){
				return true;
			}else{
				return false;
			}
		}catch(PDOException $e){
			echo 'Ha surgido un error y no se puede ejecutar la consulta.'.$e->getMessage();
			exit;
		}
	}

	public static function Listar($Accion){
		$conexion = new Conexion();
		$conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		try{
			if($Accion == 1){
				$Sql = "SELECT * FROM archivo_config";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
			}

			$Instruc = $conexion->prepare($Sql);
			$Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
			
			$Result = $Instruc->fetchAll();
			$conexion = null;
			return $Result;
		}catch(PDOException $e){
			echo 'Ha surgido un error y no se puede ejecutar la consulta.'.$e->getMessage();
			exit;
		}
	}

	public static function Buscar() {
		$conexion = new Conexion();
		$conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		try{
			$Sql = "SELECT * FROM archivo_config";
			$Instruc = $conexion->prepare($Sql);
			$Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
			$Result = $Instruc->fetch();
			$conexion = null;
			
			if ($Result) {
				return new self("", $Result['archivo_local_recibida'], $Result['archivo_local_enviada']);
			} else {
				return false;
			}
		}catch(PDOException $e){
			echo 'Ha surgido un error y no se puede ejecutar la consulta.'.$e->getMessage();
			exit;
		}
	}
}
?>