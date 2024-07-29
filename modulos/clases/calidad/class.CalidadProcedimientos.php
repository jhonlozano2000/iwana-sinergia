<?php
class Procedimiento
{
	private $accion;
	private $idProceso;
	private $idProcedimiento;
	private $codProcedimiento;
	private $nomProcedimiento;
	private $Acti;

	public function __construct($accion = null, $idProceso = null, $idProcedimiento = null, $codProcedimiento = null, $nomProcedimiento = null, $Acti = null)
	{
		$this->accion = $accion;
		$this->idProceso = $idProceso;
		$this->idProcedimiento = $idProcedimiento;
		$this->codProcedimiento = $codProcedimiento;
		$this->nomProcedimiento  = $nomProcedimiento;
		$this->Acti = $Acti;
	}

	public function getidProceso()
	{
		return $this->idProceso;
	}

	public function getidProcedimiento()
	{
		return $this->idProcedimiento;
	}

	public function getcodProcedimiento()
	{
		return $this->codProcedimiento;
	}

	public function getnomProcedimiento()
	{
		return $this->nomProcedimiento;
	}

	public function getActi()
	{
		return $this->Acti;
	}

	public function setAccion($accion)
	{
		return $this->accion = $accion;
	}

	public function setidProceso($idProceso)
	{
		return $this->idProceso = $idProceso;
	}

	public function setidProcedimiento($idProcedimiento)
	{
		return $this->idProcedimiento = $idProcedimiento;
	}

	public function setcodProcedimiento($codProcedimiento)
	{
		$this->codProcedimiento = $codProcedimiento;
	}

	public function setnomProcedimiento($nomProcedimiento)
	{
		$this->nomProcedimiento = $nomProcedimiento;
	}

	public function setActi($acti)
	{
		$this->Acti = $acti;
	}

	public function Gestionar()
	{
		$conexion = new Conexion();
		try {
			if ($this->accion == 'INSERTAR') {

				$sql = "INSERT INTO cali_procedimientos(procesos_id, cod_procedimiento, nom_procedimiento)
					VALUES(:procesos_id, :cod_procedimiento, :nom_procedimiento)";

				$Instruc = $conexion->prepare($sql);
				$Instruc->bindParam(':procesos_id', $this->idProcedimiento, PDO::PARAM_INT);
				$Instruc->bindParam(':cod_procedimiento', $this->codProcedimiento, PDO::PARAM_INT);
				$Instruc->bindParam(':nom_procedimiento', $this->nomProcedimiento, PDO::PARAM_INT);
			} elseif ($this->accion == 'EDITAR') {

				$sql = "UPDATE cali_procedimientos SET procesos_id = :procesos_id, cod_procedimiento = :cod_procedimiento, nom_procedimiento = :nom_procedimiento
						WHERE procesos_id = :procesos_id";

				$Instruc = $conexion->prepare($sql);
				$Instruc->bindParam(':procesos_id', $this->idProcedimiento, PDO::PARAM_INT);
				$Instruc->bindParam(':cod_procedimiento', $this->codProcedimiento, PDO::PARAM_STR);
				$Instruc->bindParam(':nom_procedimiento', $this->nomProcedimiento, PDO::PARAM_STR);
				$Instruc->bindParam(':procesos_id', $this->idProceso, PDO::PARAM_INT);
			} elseif ($this->accion == 'DELETE') {

				$sql = "DELETE FROM cali_procedimientos
						WHERE procesos_id = :procesos_id";

				$Instruc = $conexion->prepare($sql);
				$Instruc->bindParam(':procesos_id', $this->idProceso, PDO::PARAM_INT);
			}

			$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			$conexion = null;

			if ($Instruc) {
				return true;
			} else {
				return false;
			}
		} catch (PDOException $e) {
			echo "Ha surgido un error y no se puede ejecutar la consulta Calidad->Procesos, Accion: " . $this->accion . " - " . $Instruc->errorInfo() . " - " . $sql . $e->getMessage();
			exit;
		}
	}


	public static function Listar($Accion, $idProcedimiento, $codProcedimiento, $nomProcedimiento)
	{
		$conexion = new Conexion();

		try {

			if ($Accion == 1) {

				$Sql = "SELECT `areas_dependencias`.`nom_depen`, `cali_procesos`.`procesos_id`, `cali_procesos`.`cod_proce`, `cali_procesos`.`nom_proce`, `cali_procedimientos`.`procedimiento_id`, 
							`cali_procedimientos`.`cod_procedimiento`, `cali_procedimientos`.`nom_procedimiento`, `cali_procedimientos`.`estado` 
						FROM `cali_procesos`
						INNER JOIN `areas_dependencias` ON (`cali_procesos`.`id_depen` = `areas_dependencias`.`id_depen`)
						INNER JOIN `cali_procedimientos` ON (`cali_procedimientos`.`procesos_id` = `cali_procesos`.`procesos_id`)";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			}

			$Result = $Instruc->fetchAll();
			$conexion = null;
			return $Result;
		} catch (PDOException $e) {
			echo 'Ha surgido un error y no se puede ejecutar la consulta. Calidad->Procedimientos, Listar, Accion: ' . $Accion . $e->getMessage();
			exit;
		}
	}

	public static function Buscar($accion, $idProce, $codProcedimiento, $nomProcedimiento)
	{
		$conexion = new Conexion();

		try {

			if ($accion == 1) {
				$sql = "SELECT * FROM cali_procedimientos WHERE cod_procedimiento = :cod_procedimiento";
				$Instruc = $conexion->prepare($sql);
				$Instruc->bindParam(':cod_procedimiento', $codProcedimiento, PDO::PARAM_STR);
			} elseif ($accion == 2) {
				$sql = "SELECT * FROM cali_procedimientos WHERE nom_procedimiento = :nom_procedimiento";
				$Instruc = $conexion->prepare($sql);
				$Instruc->bindParam(':nom_procedimiento', $nomProcedimiento, PDO::PARAM_STR);
			} elseif ($accion == 3) {
				$sql = "SELECT * FROM cali_procedimientos WHERE procedimiento_id = :procedimiento_id";
				$Instruc = $conexion->prepare($sql);
				$Instruc->bindParam(':procedimiento_id', $idProce, PDO::PARAM_STR);
			}

			$Instruc->execute() or die(print_r("Calidad->Procesos, Buscar, Accion: " . $accion . " - " . $Instruc->errorInfo() . " - " . $sql, true));
			$Result = $Instruc->fetch();
			$conexion = null;

			if ($Result) {
				return new self("", $Result['procesos_id'], $Result['procedimiento_id'], $Result['cod_procedimiento'], $Result['nom_procedimiento'], $Result['estado']);
			} else {
				return false;
			}
		} catch (PDOException $e) {
			echo 'Ha surgido un error y no se puede ejecutar la consulta.' . $e->getMessage();
			exit;
		}
	}
}
