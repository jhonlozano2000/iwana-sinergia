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

		if ($this->accion == 'INSERTAR') {

			$sql = "INSERT INTO cali_procesos(id_depen, cod_proce, nom_proce)
							VALUES(:id_depen, :cod_proce, :nom_proce)";

			$Instruc = $conexion->prepare($sql);
			$Instruc->bindParam(':id_depen', $this->idDepen, PDO::PARAM_INT);
			$Instruc->bindParam(':cod_proce', $this->codProceso, PDO::PARAM_INT);
			$Instruc->bindParam(':nom_proce', $this->nomProceso, PDO::PARAM_INT);
		} elseif ($this->accion == 'EDITAR') {

			$sql = "UPDATE cali_procesos SET id_depen = :id_depen, cod_proce = :cod_proce, nom_proce = :nom_proce
						WHERE procesos_id = :procesos_id";

			$Instruc = $conexion->prepare($sql);
			$Instruc->bindParam(':id_depen', $this->idDepen, PDO::PARAM_INT);
			$Instruc->bindParam(':cod_proce', $this->codProceso, PDO::PARAM_STR);
			$Instruc->bindParam(':nom_proce', $this->nomProceso, PDO::PARAM_STR);
			$Instruc->bindParam(':procesos_id', $this->idProceso, PDO::PARAM_INT);
		} elseif ($this->accion == 'DELETE') {

			$sql = "DELETE FROM cali_procesos 
						WHERE procesos_id = :procesos_id";

			$Instruc = $conexion->prepare($sql);
			$Instruc->bindParam(':procesos_id', $this->idProceso, PDO::PARAM_INT);
		}

		$Instruc->execute() or die(print_r("Calidad->Procesos, Accion: " . $this->accion . " - " . $Instruc->errorInfo() . " - " . $sql, true));
		$conexion = null;
		echo 1;
	}


	public static function Listar($Accion, $idDepen, $codProceso, $nomProceso)
	{
		$conexion = new Conexion();

		try {

			if ($Accion == 1) {

				$Sql = "SELECT * FROM cali_procesos ORDER BY nom_proce";

				$Instruc = $conexion->prepare($Sql);
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

	public static function Buscar($accion, $idDepen, $codProceso, $nomProceso)
	{
		$conexion = new Conexion();

		try {

			if ($accion == 1) {
				$sql = "SELECT * FROM cali_procesos WHERE cod_proce = :cod_proce";
				$Instruc = $conexion->prepare($sql);
				$Instruc->bindParam(':cod_proce', $codProceso, PDO::PARAM_STR);
			}

			$Instruc->execute() or die(print_r("Calidad->Procesos, Buscar, Accion: " . $accion . " - " . $Instruc->errorInfo() . " - " . $sql, true));
			$Result = $Instruc->fetch();
			$conexion = null;

			if ($Result) {
				return new self("", $Result['procesos_id'], $Result['id_depen'], $Result['cod_proce'], $Result['nom_proce'], $Result['estado']);
			} else {
				return false;
			}
		} catch (PDOException $e) {
			echo 'Ha surgido un error y no se puede ejecutar la consulta.' . $e->getMessage();
			exit;
		}
	}
}
