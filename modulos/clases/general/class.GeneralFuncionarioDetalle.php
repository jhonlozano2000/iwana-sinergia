<?php
class FuncionarioDetalle{
	private $Accion;
	private $IdFuncio;
	private $IdFuncioDeta;
	private $IdOfi;
	private $IdCargo;
	private $Acti;

	public function __construct($Accion = null, $IdFuncio = null, $IdFuncioDeta = null, $IdOfi = null, $IdCargo = null, $Acti = null){

		$this -> Accion         = $Accion;
		$this -> IdFuncio       = $IdFuncio;
		$this -> IdFuncioDeta      = $IdFuncioDeta;
		$this -> IdOfi          = $IdOfi;
		$this -> IdCargo        = $IdCargo;
		$this -> Acti           = $Acti;
	}

	public function getId_Funcio(){
		return $this -> IdFuncio;
	}

	public function getId_FuncioDeta(){
		return $this -> IdFuncioDeta;
	}

	public function getId_Ofi(){
		return $this -> IdOfi;
	}

	public function getId_Cargo(){
		return $this -> IdCargo;
	}

	public function getActi(){
		return $this -> Acti;
	}

	public function setAccion($Accion){
		return $this -> Accion = $Accion;
	}

	public function setId_Funcio($IdFuncio){
		return $this -> IdFuncio = $IdFuncio;
	}

	public function setId_FuncioDeta($IdFuncioDeta){
		return $this -> IdFuncioDeta = $IdFuncioDeta;
	}

	public function setId_Ofi($IdOfi){
		return $this -> IdOfi = $IdOfi;
	}

	public function setId_Cargo($IdCargo){
		return $this -> IdCargo = $IdCargo;
	}

	public function setActi($Acti){
		return $this -> Acti = $Acti;
	}


	public function Gestionar(){
		$conexion = new Conexion();

		try{
			if($this->Accion == 'INSERTAR'){
				$Sql = "INSERT INTO gene_funcionarios_deta(id_funcio, id_oficina, id_cargo, acti)
						VALUES(:id_funcio, :id_oficina, :id_cargo, 1)";

				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_funcio', $this->IdFuncio, PDO::PARAM_INT);
				$Instruc -> bindParam(':id_oficina', $this->IdOfi, PDO::PARAM_INT);
				$Instruc -> bindParam(':id_cargo', $this->IdCargo, PDO::PARAM_INT);

			}elseif($this->Accion == 'INACTIVAR'){
				$Sql = "UPDATE gene_funcionarios_deta
						SET acti = 0
						WHERE id_funcio = :id_funcio";

				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_funcio', $this->IdFuncio, PDO::PARAM_INT);

			}elseif($this->Accion == 'ACTIVAR'){
				$Sql = "UPDATE gene_funcionarios_deta SET acti = 1
						WHERE id_funcio = :id_funcio AND id_oficina = :id_oficina AND id_cargo = :id_cargo";

				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_funcio', $this->IdFuncio, PDO::PARAM_INT);
				$Instruc -> bindParam(':id_oficina', $this->IdOfi, PDO::PARAM_INT);
				$Instruc -> bindParam(':id_cargo', $this->IdCargo, PDO::PARAM_INT);
			}elseif($this->Accion == 'ELIMINAR'){
				$Sql = "DELETE FROM gene_funcionarios_deta WHERE id_funcio_deta = :id_funcio_deta";

				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_funcio_deta', $this->IdFuncioDeta, PDO::PARAM_INT);
			}elseif($this->Accion == 'ACTIVAR_INACTIVAR'){
				$Sql = "UPDATE gene_funcionarios_deta
						SET acti = :acti
						WHERE id_funcio_deta = :id_funcio_deta";

				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':acti', $this->Acti, PDO::PARAM_INT);
				$Instruc -> bindParam(':id_funcio_deta', $this->IdFuncioDeta, PDO::PARAM_INT);
			}elseif($this->Accion == 'ELIMINAR_BASURA'){
	            /******************************************************************************************/
	            /*  ELIMINO UN DETALLE DE UN FUNCIONARIO
	            /******************************************************************************************/
	            $Sql = "DELETE FROM `gene_funcionarios_deta`
						WHERE `id_funcio_deta` = :id_funcio_deta";

	            $Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_funcio_deta', $this->IdFuncioDeta, PDO::PARAM_INT);
				$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
				$Instruc = $conexion->prepare($Sql);
			}

			$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			$this-> IdFuncioDeta = $conexion -> lastInsertId();
			$conexion = null;

			if($Instruc){
				return true;
			}else{
				return false;
			}

		}catch(PDOException $e){
			echo 'Ha surgido un error y no se puede ejecutar la consulta, Detalle del funcionario ->'.$this->Accion." - ".$this->IdFuncioDeta." - ".$e->getMessage();
			exit;
		}
	}

	public static function Listar($Accion, $IdFuncio, $IdFuncioDeta, $IdOficina, $IdCargo){
		$conexion = new Conexion();

		try{

			if($Accion == 1){
				/******************************************************************************************/
	            /*  BUSCO EL DETALLE POR ID DEL FUNCIONARIO
	            /******************************************************************************************/
	            $Sql = "SELECT * FROM gene_funcionarios_deta
	            		WHERE id_funcio_deta = :id_funcio_deta";

	            $Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_funcio_deta', $IdFuncioDeta, PDO::PARAM_INT);
				$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			}elseif($Accion == 2){
				/******************************************************************************************/
	            /*  BUSCO EL DETALLE POR ID DEL FUNCIONARIO
	            /******************************************************************************************/
	            $Sql = "SELECT * FROM gene_funcionarios_deta
	            		WHERE id_funcio = :id_funcio";

	            $Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_funcio', $IdFuncio, PDO::PARAM_INT);
				$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			}elseif($Accion == 3){
	            /******************************************************************************************/
	            /*  BUSCO LA OFICINA Y CARGO DE UN FUNCIONARIO
	            /******************************************************************************************/
	            $Sql = "SELECT * FROM gene_funcionarios_deta
	            		WHERE id_funcio = :id_funcio AND id_oficina = :id_oficina AND id_cargo = :id_cargo";

	            $Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_funcio', $IdFuncio, PDO::PARAM_INT);
				$Instruc -> bindParam(':id_oficina', $IdOfi, PDO::PARAM_INT);
				$Instruc -> bindParam(':id_cargo', $IdCargo, PDO::PARAM_INT);
				$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			}elseif($Accion == 4){
	            /******************************************************************************************/
	            /*  LISTO LA DEPENDENCIA Y OFICINA ACTIVA DE UN FUNCIONARIO
	            /******************************************************************************************/
	            $Sql = "SELECT `funcio`.`id_funcio_deta`, `funcio`.`id_funcio`, `ofi`.`id_oficina`, `ofi`.`cod_oficina`,
							`ofi`.`cod_corres`, `ofi`.`nom_oficina`, `depen`.`id_depen`, `depen`.`nom_depen`
						FROM `areas_oficinas` AS `ofi`
						    INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
						    INNER JOIN `gene_funcionarios_deta` AS `funcio` ON (`funcio`.`id_oficina` = `ofi`.`id_oficina`)
						WHERE (`funcio`.`id_funcio` = :id_funcio AND `funcio`.`acti` = 1)";

	            $Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_funcio', $IdFuncio, PDO::PARAM_INT);
				$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			}elseif($Accion == 5){
	            /******************************************************************************************/
	            /*  LISTO EL DETALLE DE UN FUNCIONARIO
	            /******************************************************************************************/
	            $Sql = "SELECT `funcio`.`id_funcio`, `funcio_deta`.`id_funcio_deta`
						FROM `gene_funcionarios_deta` AS `funcio_deta`
						INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`)
						WHERE `funcio`.`id_funcio` = :id_funcio";

	            $Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_funcio', $IdFuncio, PDO::PARAM_INT);
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

	public static function Buscar($Accion, $IdFuncio, $IdFuncioDeta, $IdOficina, $IdCargo){
		$conexion = new Conexion();

		try{

			if($Accion == 1){
				/******************************************************************************************/
	            /*  BUSCO EL DETALLE POR ID DEL FUNCIONARIO
	            /******************************************************************************************/
	            $Sql = "SELECT * FROM gene_funcionarios_deta
	            		WHERE id_funcio_deta = :id_funcio_deta";
	            $Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_funcio_deta', $IdFuncioDeta, PDO::PARAM_INT);

			}elseif($Accion == 2){
				/******************************************************************************************/
	            /*  BUSCO EL DETALLE POR ID DEL FUNCIONARIO
	            /******************************************************************************************/
	            $Sql = "SELECT * FROM gene_funcionarios_deta
	            		WHERE id_funcio = :id_funcio";

	            $Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_funcio', $IdFuncio, PDO::PARAM_INT);

			}elseif($Accion == 3){
	            /******************************************************************************************/
	            /*  BUSCO LA OFICINA Y CARGO DE UN FUNCIONARIO
	            /******************************************************************************************/
	            $Sql = "SELECT * FROM gene_funcionarios_deta
	            		WHERE id_funcio = :id_funcio AND id_oficina = :id_oficina AND id_cargo = :id_cargo";

	            $Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_funcio', $IdFuncio, PDO::PARAM_INT);
				$Instruc -> bindParam(':id_oficina', $IdOficina, PDO::PARAM_INT);
				$Instruc -> bindParam(':id_cargo', $IdCargo, PDO::PARAM_INT);
	        }

	        $Instruc -> execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
			$Result = $Instruc->fetch();
			$conexion = null;

			if($Result){
				return new self("", $Result['id_funcio_deta'], $Result['id_funcio'], $Result['id_funcio'], $Result['id_oficina'], $Result['id_cargo']);
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