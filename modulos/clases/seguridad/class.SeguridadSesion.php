<?php
class Log{
	
	private $Accion;
	private $IdSesion;
	private $IdUsua;
	private $FecHorInicio;
	private $FecHorFin;
	private $Acti;
	
	public function __construct($Accion = null, $IdSesion = null, $IdUsua = null, $FecHorInicio = null, $FecHorFin = null, $Acti = null){

		$this -> Accion       = $Accion;
		$this -> IdSesion     = $IdSesion;
		$this -> IdUsua       = $IdUsua;
		$this -> FecHorInicio = $FecHorInicio;
		$this -> FecHorFin    = $FecHorFin;
		$this -> Acti         = $Acti;
	}

	public function get_IdSesion(){
		return $this->IdSesion;
	}

	public function get_IdUsua(){
		return $this->IdUsua;
	}

	public function get_FecHorInicio(){
		return $this->FecHorInicio;
	}

	public function get_FecHorFin(){
		return $this->FecHorFin;
	}

	public function get_Acti(){
		return $this->Acti;
	}

	public function set_Accion($Accion){
		$this->Accion = $Accion;
	}

	public function set_IdSesion($IdSesion){
		$this->IdSesion = $IdSesion;
	}

	public function set_IdUsua($IdUsua){
		$this->IdUsua = $IdUsua;
	}

	public function set_FecHorInicio($FecHorInicio){
		$this->FecHorInicio = $FecHorInicio;
	}

	public function set_FecHorFin($FecHorFin){
		$this->FecHorFin = $FecHorFin;
	}

	public function set_Acti($Acti){
		$this->Acti = $Acti;
	}

	public function Gestionar(){
		$conexion = new Conexion();

		try{
			if($this->Accion == 'INSERTAR_REGISTRO'){
				
				$Sql = "INSERT INTO `segu_log`(`id_usua`, `IdUsua`, `fechor_regis`, `FecHorFin`, `Acti`, `accion`, `detalle`)
						VALUES(:id_usua, :IdUsua, :fechor_regis, :FecHorFin, :Acti, :accion, :detalle);";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_usua', $this->IdSesion, PDO::PARAM_INT);
				$Instruc->bindParam(':IdUsua', $this->IdUsua, PDO::PARAM_STR);
				$Instruc->bindParam(':fechor_regis', $this->FecHorInicio, PDO::PARAM_STR);
				$Instruc->bindParam(':FecHorFin', $this->FecHorFin, PDO::PARAM_STR);
				$Instruc->bindParam(':Acti', $this->Acti, PDO::PARAM_STR);
				$Instruc->bindParam(':accion', $this->AccionUsuario, PDO::PARAM_STR);
				$Instruc->bindParam(':detalle', $this->Detalle, PDO::PARAM_STR);
			}

			$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
        	$conexion = null;   

	        if($Instruc){
	            return true;
	        }else{
	            return false;
	        }
        }catch(PDOException $e){
            echo 'Ha surgido un error y no se puede ejecutar la consulta, recibidos Radicar Recibidas.'.$e->getMessage();
            exit;
        }
	}
		
	public static function Listar($Accion, $Id){
		$conexion = new Conexion();
		
		try{
			if($Accion == 1){
				$Sql = "SELECT * 
						FROM segu_modu 
						WHERE modu_padre = :modu_padre 
						ORDER BY modu_padre, nom_modu";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':modu_padre', $Id, PDO::PARAM_INT);
				$Instruc->execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			}elseif($Accion == 2){
				$Sql = "SELECT * 
						FROM segu_modu 
						WHERE modu_padre = :modu_padre 
						ORDER BY modu_padre, nom_modu";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':modu_padre', $Id, PDO::PARAM_INT);
				$Instruc->execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			}

			$Result = $Instruc->fetchAll();
			$conexion = null;
			return $Result;
		}catch(PDOException $e){
			echo 'Ha surgido un error y no se puede ejecutar la consulta.'.$e->getMessage();
			exit;
		}
	}
		
	public static function Buscar($Accion, $Id) {
        $conexion = new Conexion();
		
		try{
			if($Accion == 1){
				$Sql = "SELECT * 
						FROM segu_modu 
						WHERE modu_padre = :modu_padre 
						ORDER BY modu_padre, nom_modu";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':modu_padre', $Id, PDO::PARAM_INT);
				$Instruc->execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			}elseif($Accion == 2){
				$Sql = "SELECT * 
						FROM segu_modu 
						WHERE modu_padre = :modu_padre 
						ORDER BY modu_padre, nom_modu";
				
				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':modu_padre', $Id, PDO::PARAM_INT);
				$Instruc->execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			}

	        $Result = $InstrucBuscar->fetch();
	        $conexion = null;
	        if ($Result) {
	            return new self($Result['id_modu'], $Result['modu_padre'], $Result['nom_modu'], $Result['menu'], $Result['boton'], 
	            				$Result['acti']);
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