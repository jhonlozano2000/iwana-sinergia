<?php
class FuncionarioAccesoDigital{
	private $Accion;
	private $IdFuncioDeta;
	private $IdDependencia;
	private $IdSerie;
	private $IdSubSerie;

	public function __construct($Accion = null, $IdFuncioDeta = null, $IdDependencia = null, $IdSerie = null, $IdSubSerie = null){
		$this -> Accion        = $Accion;
		$this -> IdFuncioDeta  = $IdFuncioDeta;
		$this -> IdDependencia = $IdDependencia;
		$this -> IdSerie       = $IdSerie;
		$this -> IdSubSerie    = $IdSubSerie;
	}

	public function getId_Funcio(){
		return $this -> IdFuncio;
	}

	public function getId_FuncioDeta(){
		return $this -> IdFuncioDeta;
	}

	public function getId_Dependencia(){
		return $this -> IdDependencia;
	}

	public function getId_Serie(){
		return $this -> IdSerie;
	}

	public function getId_SubSerie(){
		return $this -> IdSubSerie;
	}

	public function setAccion($Accion){
		return $this -> Accion = $Accion;
	}

	public function setId_FuncioDeta($IdFuncioDeta){
		return $this -> IdFuncioDeta = $IdFuncioDeta;
	}

	public function setId_Dependencia($IdDependencia){
		return $this -> IdDependencia = $IdDependencia;
	}

	public function setId_Serie($IdSerie){
		return $this -> IdSerie = $IdSerie;
	}

	public function setId_SubSerie($IdSubSerie){
		return $this -> IdSubSerie = $IdSubSerie;
	}

	public function Gestionar(){
		$conexion = new Conexion();
		$conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		try{
			if($this->Accion == 'INSERTAR'){
				$Sql = "INSERT INTO gene_funcionarios_digitales(id_funcio_deta, id_depen, id_serie, id_subserie)
						VALUES(:id_funcio_deta, :id_depen, :id_serie, :id_subserie)";

				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_funcio_deta', $this->IdFuncioDeta, PDO::PARAM_INT);
				$Instruc -> bindParam(':id_depen', $this->IdDependencia, PDO::PARAM_INT);
				$Instruc -> bindParam(':id_serie', $this->IdSerie, PDO::PARAM_INT);
				$Instruc -> bindParam(':id_subserie', $this->IdSubSerie, PDO::PARAM_INT);

			}elseif($this->Accion == 'ELIMINAR'){
				$Sql = "DELETE FROM gene_funcionarios_digitales WHERE id_funcio_deta = :id_funcio_deta";

				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_funcio_deta', $this->IdFuncioDeta, PDO::PARAM_INT);
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

	public static function Listar($Accion, $IdFuncioDeta, $IdDepen, $IdSerie, $IdSubSerie){
		$conexion = new Conexion();

		try{

			if($Accion == 1){
				/******************************************************************************************/
	            /*  LISTO POR FUNCIONARIO
	            /******************************************************************************************/
	            $Sql = "SELECT * FROM gene_funcionarios_digitales
	            		WHERE id_funcio_deta = :id_funcio_deta";
	            $Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_funcio_deta', $IdFuncioDeta, PDO::PARAM_INT);
				$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			}elseif($Accion == 2){
				/******************************************************************************************/
	            /* LISTO LAS DEPENDENCIAS HABILITADAS PARA QUE EL FUNCIONARIO PUEDA ACCEDER A LOS ARCHIVOS
	            /* DIGITALIZADOS
	            /******************************************************************************************/
	            $Sql = "SELECT DISTINCT `funcio_digi`.`id_funcio_deta`, `depen`.`id_depen`, `depen`.`nom_depen`
						FROM `gene_funcionarios_digitales` AS `funcio_digi`
						    INNER JOIN `areas_dependencias` AS `depen` ON (`funcio_digi`.`id_depen` = `depen`.`id_depen`)
						WHERE (`funcio_digi`.`id_funcio_deta` = :id_funcio_deta)";

	            $Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_funcio_deta', $IdFuncioDeta, PDO::PARAM_INT);
				$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			}elseif($Accion == 3){
				/******************************************************************************************/
	            /* LISTO LAS SERIES HABILITADAS PARA QUE EL FUNCIONARIO PUEDA ACCEDER A LOS ARCHIVOS
	            /* DIGITALIZADOS
	            /******************************************************************************************/
	            $Sql = "SELECT DISTINCT `funcio_digi`.`id_funcio_deta`, `funcio_digi`.`id_depen`, `serie`.`id_serie`, `serie`.`cod_serie`, `serie`.`nom_serie`
						FROM `gene_funcionarios_digitales` AS `funcio_digi`
						    INNER JOIN `archivo_trd_series` AS `serie` ON (`funcio_digi`.`id_serie` = `serie`.`id_serie`)
						WHERE (`funcio_digi`.`id_funcio_deta` = :id_funcio_deta AND `funcio_digi`.`id_depen` = :id_depen)";

	            $Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_funcio_deta', $IdFuncioDeta, PDO::PARAM_INT);
				$Instruc -> bindParam(':id_depen', $IdDepen, PDO::PARAM_INT);
				$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			}elseif($Accion == 4){
				/******************************************************************************************/
	            /* LISTO LAS SUBSERIES HABILITADAS PARA QUE EL FUNCIONARIO PUEDA ACCEDER A LOS ARCHIVOS
	            /* DIGITALIZADOS
	            /******************************************************************************************/
	            $Sql = "SELECT DISTINCT `funcio_digi`.`id_funcio_deta`, `funcio_digi`.`id_depen`, `serie`.`id_serie`, `serie`.`cod_serie`, `serie`.`nom_serie`, `subserie`.`id_subserie`,
	            			`subserie`.`cod_subserie`, `subserie`.`nom_subserie`
						FROM `gene_funcionarios_digitales` AS `funcio_digi`
						    INNER JOIN `archivo_trd_series` AS `serie` ON (`funcio_digi`.`id_serie` = `serie`.`id_serie`)
						    INNER JOIN `archivo_trd_subserie` AS `subserie` ON (`funcio_digi`.`id_subserie` = `subserie`.`id_subserie`)
						WHERE (`funcio_digi`.`id_funcio_deta` = :id_funcio_deta AND `funcio_digi`.`id_depen` = :id_depen AND `serie`.`id_serie` = :id_serie)";

	            $Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_funcio_deta', $IdFuncioDeta, PDO::PARAM_INT);
				$Instruc -> bindParam(':id_depen', $IdDepen, PDO::PARAM_INT);
				$Instruc -> bindParam(':id_serie', $IdSerie, PDO::PARAM_INT);
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

	public static function Buscar($Accion, $IdFuncioDeta, $IdSerie, $IdSubSerie){
		$conexion = new Conexion();
		$conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		try{

			if($Accion == 1){
				/******************************************************************************************/
	            /*  BUSCO EL DETALLE POR ID DEL FUNCIONARIO
	            /******************************************************************************************/
	            $Sql = "SELECT * FROM gene_funcionarios_digitales
	            		WHERE id_funcio_deta = :id_funcio_deta";
	            $Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_funcio_deta', $IdFuncioDeta, PDO::PARAM_INT);

			}

	        $Instruc -> execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
			$Result = $Instruc->fetch();
			$conexion = null;

			if($Result){
				return new self("", $Result['id_funcio_deta'], $Result['id_serie'], $Result['id_subserie']);
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