<?php
class DigitalizacioTRDTomo{
	private $Accion;
	private $IdTomo;
	private $IdDigital;
	private $NomTomo;

	public function __construct($Accion = null, $IdTomo = null, $IdDigital = null, $NomTomo = null){

		$this -> Accion    = $Accion;
		$this -> IdTomo    = $IdTomo;
		$this -> IdDigital = $IdDigital;
		$this -> NomTomo   = $NomTomo;
	}

	public function get_IdTomo(){
		return $this -> IdTomo;
	}

	public function get_IdDigital(){
		return $this -> IdDigital;
	}

	public function get_NomTomo(){
		return $this -> NomTomo;
	}


	public function set_Accion($Accion) {
		$this -> Accion = $Accion;
	}

	public function set_IdTomo($IdTomo) {
		$this -> IdTomo = $IdTomo;
	}

	public function set_IdDigital($IdDigital) {
		$this -> IdDigital = $IdDigital;
	}

	public function set_NomTomo($NomTomo){
		$this -> NomTomo = $NomTomo;
	}

	public function Gestionar(){
		$conexion = new Conexion();

		try{
			if($this->Accion == 'INSERTAR_TOMO'){
				$Sql = "INSERT INTO `archivo_digitales_trd_tomos`(`id_digital`, `nom_tomo`)
						VALUES (:id_digital, :nom_tomo);";

				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_digital', $this->IdDigital, PDO::PARAM_INT);
				$Instruc -> bindParam(':nom_tomo', $this->NomTomo, PDO::PARAM_STR);
				

			}elseif($this->Accion == 'ACTUALIZAR_TOMO'){
				$Sql = "UPDATE archivo_digitales_trd_tomos SET id_digital = :id_digital, nom_tomo = :nom_tomo
						WHERE id_tomo = :id_tomo";

				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_digital', $this->IdDigital, PDO::PARAM_INT);
				$Instruc -> bindParam(':nom_tomo', $this->NomTomo, PDO::PARAM_STR);
				$Instruc -> bindParam(':id_tomo', $this->IdTomo, PDO::PARAM_INT);
			}

			$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			$this-> IdTomo = $conexion->lastInsertId();
			$conexion = null;

			if($Instruc){
				return true;
			}else{
				return false;
			}
		}catch(PDOException $e){
			echo 'Ha surgido un error y no se puede ejecutar la consulta - Tomo, '.$this->Accion." - ".$e->getMessage();
			exit;
		}
	}

	public static function Listar($Accion, $IdTomo, $IdDigital, $NomTomo){
		$conexion = new Conexion();

		try{

			if($Accion == 1){
				/*********************************************************************************************
				* LISTO EL TOTAL DE TOMOS
				*********************************************************************************************/
				$Sql = "SELECT COUNT(id_tomo) AS 'TotalTomos' 
						FROM archivo_digitales_trd_tomos
						WHERE id_digital = :id_digital";
				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_digital', $IdDigital, PDO::PARAM_INT);
				$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
				$Result = $Instruc->fetch();

			}elseif($Accion == 2){
				/*********************************************************************************************
				* LISTO LOS TOMOS DE UN EXPEDIENTE
				*********************************************************************************************/
				$Sql = "SELECT *
						FROM archivo_digitales_trd_tomos
						WHERE id_digital = :id_digital";
				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_digital', $IdDigital, PDO::PARAM_INT);
				$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
				$Result = $Instruc->fetchAll();
			}

			
			$conexion = null;
			return $Result;
		}catch(PDOException $e){
			echo 'Ha surgido un error y no se puede ejecutar la consulta.'.$e->getMessage();
			exit;
		}
	}

	public static function Buscar($Accion, $IdTomo, $IdDigital, $NomTomo) {
		$conexion = new Conexion();

		try{

			if($Accion == 1){
				$Sql = "SELECT * FROM archivo_digitales_trd_tomos
						WHERE id_tomo = :id_tomo";

				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_tomo', $IdTomo, PDO::PARAM_INT);
			}

			$Instruc -> execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
			$Result = $Instruc->fetch();
			$conexion = null;

			if($Result){
				return new self("", $Result['id_tomo'], $Result['id_digital'], $Result['nom_tomo']);
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