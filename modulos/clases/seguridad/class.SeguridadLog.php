<?php
class Log{
	
	private $Accion;
	private $IdUsuario;
	private $Modulo;
	private $FecHorRegistro;
	private $Equipo;
	private $IP;
	private $AccionUsuario;
	private $Detalle;
	
	public function __construct($Accion = null, $IdUsuario = null, $Modulo = null, $FecHorRegistro = null, $Equipo = null, $IP = null, 
							$AccionUsuario = null, $Detalle = null){

		$this -> Accion         = $Accion;
		$this -> IdUsuario      = $IdUsuario;
		$this -> Modulo         = $Modulo;
		$this -> FecHorRegistro = $FecHorRegistro;
		$this -> Equipo         = $Equipo;
		$this -> IP             = $IP;
		$this -> AccionUsuario  = $AccionUsuario;
		$this -> Detalle        = $Detalle;
	}

	public function get_IdUsuario(){
		return $this->IdUsuario;
	}

	public function get_Modulo(){
		return $this->Modulo;
	}

	public function get_FecHorRegistro(){
		return $this->FecHorRegistro;
	}

	public function get_Equipo(){
		return $this->Equipo;
	}

	public function get_IP(){
		return $this->IP;
	}

	public function get_AccionUsuario(){
		return $this->AccionUsuario;
	}

	public function get_Detalle(){
		return $this->Detalle;
	}

	public function set_Accion($Accion){
		$this->Accion = $Accion;
	}

	public function set_IdUsuario($IdUsuario){
		$this->IdUsuario = $IdUsuario;
	}

	public function set_Modulo($Modulo){
		$this->Modulo = $Modulo;
	}

	public function set_FecHorRegistro($FecHorRegistro){
		$this->FecHorRegistro = $FecHorRegistro;
	}

	public function set_Equipo($Equipo){
		$this->Equipo = $Equipo;
	}

	public function set_IP($IP){
		$this->IP = $IP;
	}

	public function set_AccionUsuario($AccionUsuario){
		$this->AccionUsuario = $AccionUsuario;
	}

	public function set_Detalle($Detalle){
		$this->Detalle = $Detalle;
	}

	public function Gestionar(){
		$conexion = new Conexion();

		try{
			if($this->Accion == 'INSERTAR_REGISTRO'){
				
				$Sql = "INSERT INTO `segu_log`(`id_usua`, `modulo`, `fechor_regis`, `equipo`, `ip`, `accion`, `detalle`)
						VALUES(:id_usua, :modulo, :fechor_regis, :equipo, :ip, :accion, :detalle);";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_usua', $this->IdUsuario, PDO::PARAM_INT);
				$Instruc->bindParam(':modulo', $this->Modulo, PDO::PARAM_STR);
				$Instruc->bindParam(':fechor_regis', $this->FecHorRegistro, PDO::PARAM_STR);
				$Instruc->bindParam(':equipo', $this->Equipo, PDO::PARAM_STR);
				$Instruc->bindParam(':ip', $this->IP, PDO::PARAM_STR);
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