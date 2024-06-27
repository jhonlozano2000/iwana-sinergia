<?php
class DependenciaTVD{
	private $Accion;
	private $_Id;
	private $_Cod_Depen;
	private $_Cod_Corres;
	private $_Nom_Depen;
	private $_Observa;
	private $_Acti;
		
	public function __construct($Accion = null, $Id=null,$Cod_Depen=null ,$Cod_Corres=null , $Nom_Depen = null, $Observa = null, $Acti = null ){
		$this -> Accion      = $Accion;
		$this -> _Id         = $Id;
		$this -> _Cod_Depen  = $Cod_Depen;
		$this -> _Cod_Corres = $Cod_Corres;
		$this -> _Nom_Depen  = $Nom_Depen;
		$this -> _Observa    = $Observa;
		$this -> _Acti       = $Acti;
	}
	
	public function getId() {
		return $this ->  _Id;
	}
	public function getCod_Dependencia() {
		return $this ->  _Cod_Depen;
	}
	
	public function getCod_Correspondencia() {
		return $this ->  _Cod_Corres;
	}
	
	public function getNom_Dependencia() {
		return $this ->  _Nom_Depen;
	}

	public function getObserva() {
		return $this -> _Observa;
	}
	
	public function getActi() {
		return $this -> _Acti;
	}
	
	public function setAccion($Accion) {
		return $this -> Accion = $Accion;
	}

	public function set_Id($Id) {
		return $this -> _Id = $Id;
	}

	public function setCod_Dependencia($Cod_Depen) {
		return $this -> _Cod_Depen = $Cod_Depen;
	}
	
	public function setCod_Correspondencia($Cod_Corres) {
		return $this -> _Cod_Corres = $Cod_Corres;
	}
	
	public function setNom_Dependencia($Nom_Depen) {
		$this -> _Nom_Depen = $Nom_Depen;
	}

	public function setObserva($descripcion) {
		$this->_Observa = $descripcion;
	}
	
	public function setActi($acti) {
		$this->_Acti = $acti;
	}

	public function Gestionar() {
		$conexion = new Conexion();
        
        try{
	 		if($this->Accion == 'INSERTAR'){
				$Sql = "INSERT INTO archivo_tvd_dependencias(cod_depen, cod_corres, nom_depen, observa, acti)
						VALUES(:Cod_Depen, :Cod_Corres, :Nom_Depen, :Observa, 1)";

				$Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':Cod_Depen', $this->_Cod_Depen, PDO::PARAM_STR);
                $Instruc -> bindParam(':Cod_Corres', $this->_Cod_Corres, PDO::PARAM_STR);
                $Instruc -> bindParam(':Nom_Depen', $this->_Nom_Depen, PDO::PARAM_STR);
                $Instruc -> bindParam(':Observa', $this->_Observa, PDO::PARAM_STR);
			
			}elseif($this->Accion == 'EDITAR'){
				$Sql = "UPDATE archivo_tvd_dependencias 
						SET cod_depen = :Cod_Depen, cod_corres = :Cod_Corres, nom_depen = :Nom_Depen, observa = :Observa, acti = :Acti
						WHERE id_depen = :id_depen";

				$Instruc = $conexion->prepare($Sql);
	            $Instruc -> bindParam(':Cod_Depen', $this->_Cod_Depen, PDO::PARAM_STR);
	            $Instruc -> bindParam(':Cod_Corres', $this->_Cod_Corres, PDO::PARAM_STR);
	            $Instruc -> bindParam(':Nom_Depen', $this->_Nom_Depen, PDO::PARAM_STR);
	            $Instruc -> bindParam(':Observa', $this->_Observa, PDO::PARAM_STR);
	            $Instruc -> bindParam(':Acti', $this->_Acti, PDO::PARAM_INT);
	            $Instruc -> bindParam(':id_depen', $this->_Id, PDO::PARAM_INT);
			}elseif($this->Accion == 'ELIMINAR'){
				$Sql = "DELETE 
						FROM  archivo_tvd_dependencias
						WHERE id_depen = :id_depen";

				$Instruc = $conexion->prepare($Sql);
	            $Instruc -> bindParam(':id_depen', $this->_Id, PDO::PARAM_INT);
	        }elseif($this->Accion == 'ACTIVAR_INACTIVAR'){
				$Sql = "UPDATE archivo_tvd_dependencias 
						SET cod_depen = :Cod_Depen, cod_corres = :Cod_Corres, nom_depen = :Nom_Depen, observa = :Observa, acti = :Acti
						WHERE id_depen = :id_depen";

				$Instruc = $conexion->prepare($Sql);
	            $Instruc -> bindParam(':Cod_Depen', $this->_Cod_Depen, PDO::PARAM_STR);
	            $Instruc -> bindParam(':Cod_Corres', $this->_Cod_Corres, PDO::PARAM_STR);
	            $Instruc -> bindParam(':Nom_Depen', $this->_Nom_Depen, PDO::PARAM_STR);
	            $Instruc -> bindParam(':Observa', $this->_Observa, PDO::PARAM_STR);
	            $Instruc -> bindParam(':Acti', $this->_Acti, PDO::PARAM_INT);
	            $Instruc -> bindParam(':id_depen', $this->_Id, PDO::PARAM_INT);
			}

			$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
            $this-> _Id = $conexion -> lastInsertId();
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

	public static function Listar($Accion, $Id, $Nom, $CodDepen, $CodCorre){
 		$conexion = new Conexion();
	
		try{

			if($Accion == 1){
				/******************************************************************************************/
		        /*  LISTO TODOS LOS REGISTROS
		        /******************************************************************************************/
				$Sql = "SELECT * FROM archivo_tvd_dependencias ORDER BY nom_depen ASC";
				$Instruc = $conexion->prepare($Sql);
				$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			}elseif($Accion == 2){
				/******************************************************************************************/
				/*	LISTO UN REGISTROS
				/******************************************************************************************/
				$Sql = "SELECT * FROM archivo_tvd_dependencias WHERE id_depen = :id_depen";
				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_depen', $Id, PDO::PARAM_INT);
				$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			}elseif($Accion == 3){
				/******************************************************************************************/
				/*	LISTO POR NOMBRE
				/******************************************************************************************/
				$Sql = "SELECT * FROM archivo_tvd_dependencias WHERE nom_depen = :nom_depen";
				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':nom_depen', $Nom, PDO::PARAM_STR);
				$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			}elseif($Accion == 4){
				/******************************************************************************************/
				/*	LISTO POR CODIGO DE LA DEPENDENCIA
				/******************************************************************************************/
				$Sql = "SELECT * FROM archivo_tvd_dependencias WHERE cod_depen = :cod_depen";
				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':cod_depen', $CodDepen, PDO::PARAM_STR);
				$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			}elseif($Accion == 5){
				/******************************************************************************************/
				/*	LISTO POR CODIGO DE LA DEPENDENCIA
				/******************************************************************************************/
				$Sql = "SELECT * FROM archivo_tvd_dependencias WHERE cod_corres = :cod_corres";
				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':cod_depen', $CodCorre, PDO::PARAM_STR);
				$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			}elseif($Accion == 6){
				/******************************************************************************************/
				/*	LISTO LAS DEPENDENCIA ACTIVAS
				/******************************************************************************************/
				$Sql = "SELECT * FROM archivo_tvd_dependencias WHERE acti = 1";
				$Instruc = $conexion->prepare($Sql);
				$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			}

			$Result = $Instruc->fetchAll();
			$conexion = null;
			return $Result;
		}catch(PDOException $e){
			echo 'Ha surgido un error y no se puede ejecutar la consulta.'.$e->getMessage();
			exit;
		}
 	}
	
	public static function Buscar($Accion, $Id, $Nom, $CodDepen, $CodCorre) {
		$conexion = new Conexion();
        
    	try{

            if($Accion == 1){
				/******************************************************************************************/
		        /*  LISTO TODOS LOS REGISTROS
		        /******************************************************************************************/
				$Sql = "SELECT * FROM archivo_tvd_dependencias ORDER BY nom_depen ASC";
				$Instruc = $conexion->prepare($Sql);
				$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			}elseif($Accion == 2){
				/******************************************************************************************/
				/*	LISTO UN REGISTROS
				/******************************************************************************************/
				$Sql = "SELECT * FROM archivo_tvd_dependencias WHERE id_depen = :id_depen";
				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_depen', $Id, PDO::PARAM_INT);
				$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			}elseif($Accion == 3){
				/******************************************************************************************/
				/*	LISTO POR NOMBRE
				/******************************************************************************************/
				$Sql = "SELECT * FROM archivo_tvd_dependencias WHERE nom_depen = :nom_depen";
				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':nom_depen', $Nom, PDO::PARAM_STR);
				$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			}elseif($Accion == 4){
				/******************************************************************************************/
				/*	LISTO POR CODIGO DE LA DEPENDENCIA
				/******************************************************************************************/
				$Sql = "SELECT * FROM archivo_tvd_dependencias WHERE cod_depen = :cod_depen";
				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':cod_depen', $CodDepen, PDO::PARAM_STR);
				$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			}elseif($Accion == 5){
				/******************************************************************************************/
				/*	LISTO POR CODIGO DE LA DEPENDENCIA
				/******************************************************************************************/
				$Sql = "SELECT * FROM archivo_tvd_dependencias WHERE cod_corres = :cod_corres";
				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':cod_depen', $CodCorre, PDO::PARAM_STR);
				$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			}

            $Result = $Instruc->fetch();
            $conexion = null;

			if($Result){
				return new self("", $Result['id_depen'], $Result['cod_depen'], $Result['cod_corres'], $Result['nom_depen'], $Result['observa'], $Result['acti']);
			}else{
				return false;
			}
		 }catch(PDOException $e){
            echo 'Ha surgido un error y no se puede ejecutar la consulta.'.$e->getMessage();
            exit;
        }
	}

	
}
?>                                                                                                                                                                                           