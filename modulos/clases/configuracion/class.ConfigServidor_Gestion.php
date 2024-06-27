<?php
class ServidorGestion{
	private $Accion;
	private $IdRutaRuta;
	private $IdDepen;
	private $Ip;
	private $Usua;
	private $Contra;
	private $Ruta;
	private $Observa;
	private $Acti;
	
	public function __construct($Accion = null, $IdRutaRuta = null, $IdDepen = null, $Ip = null, $Usua = null, $Contra = null, $Ruta = null, $Observa = null, $Acti = null){
		$this -> Accion  = $Accion;
		$this -> IdRuta  = $IdRutaRuta;
		$this -> IdDepen = $IdDepen;
		$this -> Ip      = $Ip;
		$this -> Usua    = $Usua;
		$this -> Contra  = $Contra;
		$this -> Ruta    = $Ruta;
		$this -> Observa = $Observa;
		$this -> Acti    = $Acti;
	}

	public function get_IdRuta(){
		return $this -> IdRuta;
	}

	public function get_IdDepen(){
		return $this -> IdDepen;
	}

	public function get_Ip(){
		return $this -> Ip;
	}

	public function get_Usua(){
		return $this -> Usua;
	}

	public function get_Contra(){
		return $this -> Contra;
	}

	public function get_Ruta(){
		return $this -> Ruta;
	}

	public function get_Observa(){
		return $this -> Observa;
	}

	public function get_Acti(){
		return $this -> Acti;
	}

	public function set_Accion($Accion){
		return $this -> Accion = $Accion;
	}

	public function set_IdRuta($IdRutaRuta){
		return $this -> IdRuta = $IdRutaRuta;
	}

	public function set_IdDepen($IdDepen){
		return $this -> IdDepen = $IdDepen;
	}
	
	public function set_Ip($Ip){
		return $this -> Ip = $Ip;
	}

	public function set_Usua($Usua){
		return $this -> Usua = $Usua;
	}

	public function set_Contra($Contra){
		return $this ->Contra = $Contra;
	}

	public function set_Ruta($Ruta){
		return $this -> Ruta = $Ruta;
	}

	public function set_Observa($Observa){
		return $this -> Observa = $Observa;
	}

	public function set_Acti($Acti){
		return $this -> Acti = $Acti;
	}

	public function Gestionar(){
		$conexion = new Conexion();
		
		try{
			if($this->Accion == 'INSERTAR'){
				$Sql = "INSERT INTO config_rutas_archi_gestion(id_depen, ip, ruta, usua, contra, acti) 
						VALUES(:id_depen, :ip, :ruta, :usua, :contra, 1)";

				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_depen', $this->IdDepen, PDO::PARAM_INT);
				$Instruc -> bindParam(':ip', $this->Ip, PDO::PARAM_STR);
				$Instruc -> bindParam(':ruta', $this->Ruta, PDO::PARAM_STR);
				$Instruc -> bindParam(':usua', $this->Usua, PDO::PARAM_STR);
				$Instruc -> bindParam(':contra', $this->Contra, PDO::PARAM_STR);
			}if($this->Accion == 'EDITAR'){
				$Sql = "UPDATE config_rutas_archi_gestion 
						SET ip = :ip, ruta = :ruta, usua = :usua, contra = :contra, acti = :acti 
						WHERE id_ruta = :id_ruta";
				
				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':ip', $this->Ip, PDO::PARAM_STR);
				$Instruc -> bindParam(':ruta', $this->Ruta, PDO::PARAM_STR);
				$Instruc -> bindParam(':usua', $this->Usua, PDO::PARAM_STR);
				$Instruc -> bindParam(':contra', $this->Contra, PDO::PARAM_STR);
				$Instruc -> bindParam(':acti', $this->Acti, PDO::PARAM_INT);
				$Instruc -> bindParam(':id_ruta', $this->IdRuta, PDO::PARAM_INT);

			}elseif($this->Accion == 'ELIMINAR'){
				$Sql = "DELETE FROM config_rutas_archi_gestion 
						WHERE id_ruta = :id_ruta";

				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_ruta', $this->IdRuta, PDO::PARAM_INT);
			}elseif($this->Accion == 'ACTIVAR'){
				$Sql = "UPDATE config_rutas_archi_gestion 
						SET  acti = :acti 
						WHERE id_ruta = :id_ruta";

				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':acti', $this->Acti, PDO::PARAM_INT);
				$Instruc -> bindParam(':id_ruta', $this->IdRuta, PDO::PARAM_INT);
			}

			$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			$this-> IdDigital = $conexion -> lastInsertId();
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

	public static function Listar($Accion, $IdRutaRutaRuta, $IdRutaRutaDepen, $Ruta){
		$conexion = new Conexion();
		
		try{

			if($Accion == 1){
		        /******************************************************************************************/
		        /*  LISTO TODOS LOS REGISTROS
		        /******************************************************************************************/
		        $Sql = "SELECT r.*, d.nom_depen 
			            FROM config_rutas_archi_gestion r
			                INNER JOIN areas_dependencias d ON r.id_depen = d.id_depen 
                		ORDER BY r.ruta ASC";
                
                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));

		    }elseif($Accion == 2){
		        /******************************************************************************************/
		        /*  LISTO UN REGISTROS
		        /******************************************************************************************/
		        $Sql = "SELECT r.*, d.nom_depen 
			            FROM config_rutas_archi_gestion r
			                INNER JOIN areas_dependencias d ON r.id_depen = d.id_depen 
			            WHERE r.id_ruta = :id_ruta";

			    $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":id_ruta", $IdRuta, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));

		    }elseif($Accion == 3){
		        /******************************************************************************************/
		        /*  BUSCO LA RUTA QUE ESTE ACTIVA DE UNA DEPENDENCIA
		        /******************************************************************************************/
		        $Sql = "SELECT r.*, d.nom_depen 
			            FROM config_rutas_archi_gestion r
			                INNER JOIN areas_dependencias d ON r.id_depen = d.id_depen 
			            WHERE r.acti = 1 AND  d.id_depen = :id_depen";

			    $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":id_depen", $IdDepen, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));

		    }elseif($Accion == 4){
		        /******************************************************************************************/
		        /*  LISTO LA RUTA DE ALMACENAMIENTO DE UNA DEPENDENCIA
		        /******************************************************************************************/
		        $Sql = "SELECT r.*, d.nom_depen 
			            FROM config_rutas_archi_gestion r
			                INNER JOIN areas_dependencias d ON r.id_depen = d.id_depen 
			            WHERE r.acti = 1 AND  d.id_depen = :id_depe AND r.ruta = :ruta";
			    
			    $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":id_depen", $IdDepen, PDO::PARAM_STR);
                $Instruc -> bindParam(":id_ruta", $IdRuta, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));

		    }elseif($Accion == 5){
		        /******************************************************************************************/
		        /*  LISTO LA RUTA DE ALMACENAMIENTO DE UNA DEPENDENCIA
		        /******************************************************************************************/
		        $Sql = "SELECT r.*, d.nom_depen 
			            FROM config_rutas_archi_gestion r
			                INNER JOIN areas_dependencias d ON r.id_depen = d.id_depen 
			            WHERE r.acti = 1 AND r.ruta = :ruta";

			    $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":id_ruta", $IdRuta, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
		    }

		
			$Result = $Instruc->fetchAll();
			$conexion = null;
			return $Result;
		}catch(PDOException $e){
			echo 'Ha surgido un error y no se puede ejecutar la consulta.'.$e->getMessage();
			exit;
		}
	}
	
	public static function Buscar($Accion, $IdRuta, $IdDepen, $Ruta){
		$conexion = new Conexion();
		
		try{

			if($Accion == 1){
		        /******************************************************************************************/
		        /*  LISTO TODOS LOS REGISTROS
		        /******************************************************************************************/
		        $Sql = "SELECT r.*, d.nom_depen 
			            FROM config_rutas_archi_gestion r
			                INNER JOIN areas_dependencias d ON r.id_depen = d.id_depen 
                		ORDER BY r.ruta ASC";
                
                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));

		    }elseif($Accion == 2){
		        /******************************************************************************************/
		        /*  LISTO UN REGISTROS
		        /******************************************************************************************/
		        $Sql = "SELECT *
			            FROM config_rutas_archi_gestion 
			            WHERE id_ruta = :id_ruta";

			    $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":id_ruta", $IdRuta, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));

		    }elseif($Accion == 3){
		        /******************************************************************************************/
		        /*  BUSCO LA RUTA QUE ESTE ACTIVA DE UNA DEPENDENCIA
		        /******************************************************************************************/
		        $Sql = "SELECT *
			            FROM config_rutas_archi_gestion
			            WHERE acti = 1 AND  id_depen = :id_depen";

			    $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":id_depen", $IdDepen, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));

		    }elseif($Accion == 4){
		        /******************************************************************************************/
		        /*  LISTO LA RUTA DE ALMACENAMIENTO DE UNA DEPENDENCIA
		        /******************************************************************************************/
		        $Sql = "SELECT * 
			            FROM config_rutas_archi_gestion
			            WHERE acti = 1 AND id_depen = :id_depe AND ruta = :ruta";
			    
			    $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":id_depen", $IdDepen, PDO::PARAM_STR);
                $Instruc -> bindParam(":id_ruta", $IdRuta, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));

		    }elseif($Accion == 5){
		        /******************************************************************************************/
		        /*  LISTO LA RUTA DE ALMACENAMIENTO DE UNA DEPENDENCIA
		        /******************************************************************************************/
		        $Sql = "SELECT *
			            FROM config_rutas_archi_gestion
			            WHERE acti = 1 AND ruta = :ruta";

			    $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":id_ruta", $IdRuta, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
		    }

			$Result = $Instruc->fetch();
			$conexion = null;

			if ($Result){
				return new self("", $Result['id_ruta'], $Result['id_depen'], $Result['ip'], $Result['usua'], $Result['contra'], $Result['ruta'],
							$Result['observa'], $Result['acti']);
			} else{
				return false;
			}
		}catch(PDOException $e){
			echo 'Ha surgido un error y no se puede ejecutar la consulta.'.$e->getMessage();
			exit;
		}
	}
}
