<?php
class Proceso
{
	private $accion;
	private $idProceso;
	private $idDepen;
	private $codProceso;
	private $nomProceso;
	private $Acti;

	public function __construct($accion = null, $idProceso = null, $idDepen = null, $codProceso = null, $nomProceso = null, $Acti = null)
	{
		$this->accion = $accion;
		$this->idProceso = $idProceso;
		$this->idDepen = $idDepen;
		$this->codProceso = $codProceso;
		$this->nomProceso  = $nomProceso;
		$this->Acti = $Acti;
	}

	public function getidProceso()
	{
		return $this->idProceso;
	}

	public function getidDepen()
	{
		return $this->idDepen;
	}

	public function getcodProceso()
	{
		return $this->codProceso;
	}

	public function getnomProceso()
	{
		return $this->nomProceso;
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

	public function setidDepen($idDepen)
	{
		return $this->idDepen = $idDepen;
	}

	public function setcodProceso($codProceso)
	{
		$this->codProceso = $codProceso;
	}

	public function setnomProceso($nomProceso)
	{
		$this->nomProceso = $nomProceso;
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

				$sql = "INSERT INTO cali_procesos(id_depen, cod_proce, nom_proce)
						VALUES(:id_depen, :cod_proce, :nom_proce)";

				$Instruc = $conexion->prepare($sql);
				$Instruc->bindParam(':id_depen', $this->idDepen, PDO::PARAM_INT);
				$Instruc->bindParam(':cod_proce', $this->codProceso, PDO::PARAM_STR);
				$Instruc->bindParam(':nom_proce', $this->nomProceso, PDO::PARAM_STR);
			} elseif ($this->accion == 'EDITAR') {

				$sql = "UPDATE cali_procesos 
						SET id_depen = :id_depen, cod_proce = :cod_proce, nom_proce = :nom_proce
						WHERE proceso_id = :proceso_id";

				$Instruc = $conexion->prepare($sql);
				$Instruc->bindParam(':id_depen', $this->idDepen, PDO::PARAM_INT);
				$Instruc->bindParam(':cod_proce', $this->codProceso, PDO::PARAM_STR);
				$Instruc->bindParam(':nom_proce', $this->nomProceso, PDO::PARAM_STR);
				$Instruc->bindParam(':proceso_id', $this->idProceso, PDO::PARAM_INT);
			} elseif ($this->accion == 'ELIMINAR') {

				$sql = "DELETE FROM cali_procesos
						WHERE proceso_id = :proceso_id";

				$Instruc = $conexion->prepare($sql);
				$Instruc->bindParam(':proceso_id', $this->idProceso, PDO::PARAM_INT);
			} elseif ($this->accion == 'ACTIVAR_INACTIVAR') {

				$sql = "UPDATE cali_procesos
						SET estado = :estado
						WHERE proceso_id = :proceso_id";

				$Instruc = $conexion->prepare($sql);
				$Instruc->bindParam(':estado', $this->Acti, PDO::PARAM_INT);
				$Instruc->bindParam(':proceso_id', $this->idProceso, PDO::PARAM_INT);
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


	public static function Listar($Accion, $idDepen, $codProceso, $nomProceso)
	{
		$conexion = new Conexion();

		try {

			if ($Accion == 1) {
				/**
				 * Listo los procesos con la dependencia respectiva
				 */
				$Sql = "SELECT `cali_procesos`.`proceso_id`, `areas_dependencias`.`cod_depen`, `areas_dependencias`.`nom_depen`, `cali_procesos`.`cod_proce`,
							`cali_procesos`.`nom_proce`, `cali_procesos`.`estado`
						FROM `cali_procesos`
							INNER JOIN `areas_dependencias` ON (`cali_procesos`.`id_depen` = `areas_dependencias`.`id_depen`)";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 2) {
				/**
				 * Listo los procesos activos por dependencia
				 */
				$Sql = "SELECT *
						FROM `cali_procesos`
						WHERE (`cali_procesos`.`id_depen` = :id_depen AND `cali_procesos`.`estado` = 1)";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_depen', $idDepen, PDO::PARAM_INT);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			}

			$Result = $Instruc->fetchAll();
			$conexion = null;
			return $Result;
		} catch (PDOException $e) {
			echo 'Ha surgido un error y no se puede ejecutar la consulta. Calidad->Procesos, Listar, Accion: ' . $Accion . $e->getMessage();
			exit;
		}
	}

	public static function Buscar($accion, $idProce, $codProceso, $nomProceso)
	{
		$conexion = new Conexion();

		try {

			if ($accion == 1) {
				// Buscar procedimientos por código
				$sql = "SELECT *
						FROM cali_procesos
						WHERE cod_proce = :cod_proce";

				$Instruc = $conexion->prepare($sql);
				$Instruc->bindParam(':cod_proce', $codProceso, PDO::PARAM_STR);
			} elseif ($accion == 2) {
				// Buscar procedimientos por nombre
				$sql = "SELECT *
						FROM cali_procesos
						WHERE nom_proce = :nom_proce";

				$Instruc = $conexion->prepare($sql);
				$Instruc->bindParam(':nom_proce', $nomProceso, PDO::PARAM_STR);
			} elseif ($accion == 3) {
				// Buscar procedimientos por id
				$sql = "SELECT *
						FROM cali_procesos
						WHERE proceso_id = :proceso_id";

				$Instruc = $conexion->prepare($sql);
				$Instruc->bindParam(':proceso_id', $idProce, PDO::PARAM_INT);
			}

			$Instruc->execute() or die(print_r("Calidad->Procesos, Buscar, Accion: " . $accion . " - " . $Instruc->errorInfo() . " - " . $sql, true));
			$Result = $Instruc->fetch();
			$conexion = null;

			if ($Result) {
				return new self("", $Result['proceso_id'], $Result['id_depen'], $Result['cod_proce'], $Result['nom_proce'], $Result['estado']);
			} else {
				return false;
			}
		} catch (PDOException $e) {
			echo 'Ha surgido un error y no se puede ejecutar la consulta.' . $e->getMessage();
			exit;
		}
	}
}
