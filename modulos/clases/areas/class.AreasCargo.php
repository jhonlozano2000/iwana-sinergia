<?php
class Cargo{
	private $Accion;
	private $IdDepen;
	private $NomCargo;
	private $Observa;
	private $Acti;
	
	public function __construct($IdCargo= null, $IdDepen = null, $NomCargo = null, $Observa = null, $Acti = null){
		$this -> IdCargo  = $IdCargo;
		$this -> IdDepen  = $IdDepen;
		$this -> NomCargo = $NomCargo;
		$this -> Observa  = $Observa;
		$this -> Acti     = $Acti;
	}

	public function getId_Cargo() {
		return $this -> IdCargo;
	}

	public function getId_Dependencia() {
		return $this -> IdDepen;
	}
	
	public function getNom_Cargo() {
		return $this -> NomCargo;
	}

	public function getObserva() {
		return $this -> Observa;
	}
	
	public function getActi() {
		return $this -> Acti;
	}
	
	public function setId_Cargo($IdCargo) {
		return $this -> IdCargo = $IdCargo;
	}

	public function setId_Dependencia($IdDepen) {
		return $this -> IdDepen = $IdDepen;
	}
	
	public function setNom_Cargo($NomCargo) {
		$this -> NomCargo = $NomCargo;
	}

	public function setObserva($descripcion) {
		$this-> Observa = $descripcion;
	}
	
	public function setActi($acti) {
		$this->Acti = $acti;
	}

	public function Guardar() {
		$conexion = new Conexion();
		
		$sqlBuscarNom = "SELECT nom_cargo FROM areas_cargos
					WHERE nom_cargo = '".$this -> NomCargo."' AND id_depen = ".$this -> IdDepen;
		$InstrucBuscarNom = $conexion -> prepare($sqlBuscarNom);
		$InstrucBuscarNom -> execute() or die(print_r($InstrucBuscarNom->errorInfo()." - ".$sqlBuscarNom, true));
		$NumeroRegisNom = $InstrucBuscarNom -> rowCount();
		
		if($NumeroRegisNom == 1){
			echo "Ya existe un cargo con el nombre '".$this->NomCargo."'";
		}else{
			$Instruc = $conexion -> prepare("SET NAMES utf8");
        	$Instruc -> execute();
			$sqlInsert = "INSERT INTO areas_cargos (id_depen, nom_cargo, observa, acti)
							VALUES('".$this -> IdDepen."',
									'".trim($this -> NomCargo)."',
									'".trim($this -> Observa)."',
									".$this -> Acti.")";

			$Instruc = $conexion -> prepare("SET NAMES utf8");
			$Instruc -> execute();
			$Instruc = $conexion -> prepare($sqlInsert);
			$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$sqlInsert, true));
			$this-> IdCargo = $conexion -> lastInsertId();
			$conexion = null;
			echo 1;
		}
	}

	public function Modificar(){
		$conexion = new Conexion();
		$Instruc = $conexion -> prepare("SET NAMES utf8");
        $Instruc -> execute();
		$sqlModifica = "UPDATE areas_cargos SET
							id_depen = ".$this -> IdDepen.",
							nom_cargo = '".trim($this -> NomCargo)."',
							observa = '".trim($this -> Observa)."' ,
							acti = ".$this -> Acti."
						WHERE id_cargo = ".$this -> IdCargo;

		$Instruc = $conexion -> prepare("SET NAMES utf8");
		$Instruc -> execute();
		$Instruc = $conexion -> prepare($sqlModifica);
		$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$sqlModifica, true));
		$conexion = null;
		echo 1;
	}

	public function ActivarInactivar(){
		$conexion = new Conexion();
		$Instruc = $conexion -> prepare("SET NAMES utf8");
        $Instruc -> execute();
		$sqlModifica = "UPDATE areas_cargos SET
							acti = ".$this -> Acti."
						WHERE id_cargo = ".$this -> IdCargo;
		
		$Instruc = $conexion -> prepare("SET NAMES utf8");
		$Instruc -> execute();
		$Instruc = $conexion -> prepare($sqlModifica);
		$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$sqlModifica, true));
		$conexion = null;
		echo 1;
	}
		
	public function Eliminar(){
		$conexion = new Conexion();
		$SqlElimi = "DELETE FROM areas_cargos WHERE id_cargo = ".$this -> IdCargo;
		$InstrucElimi = $conexion -> prepare($SqlElimi);
		$InstrucElimi -> execute() or die(print_r($InstrucElimi -> errorInfo()." - ".$SqlElimi, true));
		$conexion = null;
		echo 1;
	}

	

	public static function Listar($Accion, $IdCargo, $IdDepen, $NomCargo) {
		$conexion = new Conexion();
		$conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		try{

			if($Accion == 1){

				$Sql = "SELECT areas_dependencias.id_depen, areas_dependencias.nom_depen, areas_cargos.id_cargo, areas_cargos.nom_cargo, 
							areas_cargos.acti, areas_cargos.observa
						FROM areas_cargos INNER JOIN areas_dependencias ON (areas_cargos.id_depen = areas_dependencias.id_depen)
						ORDER BY areas_dependencias.nom_depen, areas_cargos.nom_cargo ASC";
				$Instruc = $conexion->prepare($Sql);
				$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			}elseif($Accion == 2){
				/******************************************************************************************/
				/*	LISTO UN REGISTROS
				/******************************************************************************************/
				$Sql = "SELECT * FROM areas_cargos WHERE id_cargo = :id_cargo";
				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_cargo', $IdCargo, PDO::PARAM_INT);
				$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			}elseif($Accion == 3){
				/******************************************************************************************/
				/*	LISTO POR NOMBRE
				/******************************************************************************************/
				$Sql = "SELECT * FROM areas_cargos WHERE nom_cargo = :nom_cargo AND id_depen = :id_depen";
				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':nom_cargo', $NomCargo, PDO::PARAM_STR);
				$Instruc -> bindParam(':id_depen', $IdDepen, PDO::PARAM_INT);
				$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			}elseif($Accion == 4){
				/******************************************************************************************/
				/*	LISTO POR DEPENDENCIA
				/******************************************************************************************/
				$Sql = "SELECT * FROM areas_cargos WHERE id_depen = :id_depen and acti = 1";
				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_depen', $IdDepen, PDO::PARAM_INT);
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

	public static function Buscar($Accion, $IdCargo, $IdDepen, $NomCargo) {
		$conexion = new Conexion();
		$conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		try{

			if($Accion == 1){

				$Sql = "SELECT areas_dependencias.id_depen, areas_dependencias.nom_depen, areas_cargos.id_cargo, areas_cargos.nom_cargo, 
							areas_cargos.acti, areas_cargos.observa
						FROM areas_cargos INNER JOIN areas_dependencias ON (areas_cargos.id_depen = areas_dependencias.id_depen)
						ORDER BY areas_dependencias.nom_depen, areas_cargos.nom_cargo ASC";
				$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			}elseif($Accion == 2){
				/******************************************************************************************/
				/*	LISTO UN REGISTROS
				/******************************************************************************************/
				$Sql = "SELECT * FROM areas_cargos WHERE id_cargo = :id_cargo";
				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_cargo', $IdCargo, PDO::PARAM_INT);
				
			}elseif($Accion == 3){
				/******************************************************************************************/
				/*	LISTO POR NOMBRE
				/******************************************************************************************/
				$Sql = "SELECT * FROM areas_cargos WHERE nom_cargo = :nom_cargo AND id_depen = :id_depen";
				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':nom_cargo', $NomCargo, PDO::PARAM_STR);
				$Instruc -> bindParam(':id_depen', $IdDepen, PDO::PARAM_INT);
				
			}elseif($Accion == 4){
				/******************************************************************************************/
				/*	LISTO POR DEPENDENCIA
				/******************************************************************************************/
				$Sql = "SELECT * FROM areas_cargos WHERE id_depen = :id_depen";
				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_depen', $IdDepen, PDO::PARAM_INT);
				
			}

	        $Instruc -> execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
			$Result = $Instruc->fetch();
			$conexion = null;

			if($Result){
				return new self($Result['id_cargo'], $Result['id_depen'], $Result['nom_cargo'], $Result['observa'], $Result['acti']);
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