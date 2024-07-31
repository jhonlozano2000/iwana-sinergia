<?php
class CalidadRepositorio
{
	private $accion;
	private $archivoId;
	private $procesoId;
	private $tipoDocuId;
	private $rutaId;
	private $fecHorRegistro;
	private $nomArchivo;
	private $estado;

	public function __construct($accion = null,  $archivoId = null, $procesoId = null, $tipoDocuId = null, $rutaId = null, $fecHorRegistro = null, $nomArchivo = null, $estado = null)
	{
		$this->accion = $accion;
		$this->archivoId = $archivoId;
		$this->procesoId = $procesoId;
		$this->tipoDocuId = $tipoDocuId;
		$this->rutaId = $rutaId;
		$this->fecHorRegistro = $fecHorRegistro;
		$this->nomArchivo = $nomArchivo;
		$this->estado = $estado;
	}

	public function getArchivoId()
	{
		return $this->archivoId;
	}

	public function getProcesoId()
	{
		return $this->procesoId;
	}

	public function getTipoDocuId()
	{
		return $this->tipoDocuId;
	}

	public function getRutaId()
	{
		return $this->rutaId;
	}
	public function getFecHorRegistro()
	{
		return $this->fecHorRegistro;
	}

	public function getNomArchivo()
	{
		return $this->nomArchivo;
	}

	public function getEstado()
	{
		return $this->estado;
	}

	public function setAccion($accion)
	{
		return $this->accion = $accion;
	}

	public function setArchivoId($archivoId)
	{
		return $this->archivoId = $archivoId;
	}

	public function setProcesoId($procesoId)
	{
		return $this->procesoId = $procesoId;
	}

	public function seTtipoDocuId($tipoDocuId)
	{
		$this->tipoDocuId = $tipoDocuId;
	}

	public function setRutaId($rutaId)
	{
		$this->rutaId = $rutaId;
	}

	public function setFecHorRegistro($fecHorRegistro)
	{
		return $this->fecHorRegistro = $fecHorRegistro;
	}

	public function setNomArchivo($nomArchivo)
	{
		return $this->nomArchivo = $nomArchivo;
	}

	public function setEstado($estado)
	{
		return $this->estado = $estado;
	}

	public function Gestionar()
	{
		$conexion = new Conexion();
		try {
			if ($this->accion == 'INSERTAR') {

				$sql = "INSERT INTO cali_repositorio(procesos_id, tipo_docu_id, id_ruta, nom_archivo)
						VALUES(:procesos_id, :tipo_docu_id, :id_ruta, :nom_archivo)";

				$Instruc = $conexion->prepare($sql);
				$Instruc->bindParam(':procesos_id', $this->archivoId, PDO::PARAM_INT);
				$Instruc->bindParam(':tipo_docu_id', $this->tipoDocuId, PDO::PARAM_INT);
				$Instruc->bindParam(':id_ruta', $this->rutaId, PDO::PARAM_INT);
				$Instruc->bindParam(':nom_archivo', $this->nomArchivo, PDO::PARAM_STR);
			} elseif ($this->accion == 'EDITAR') {

				$sql = "UPDATE cali_repositorio
						SET procesos_id = :procesos_id, tipo_docu_id = :tipo_docu_id, id_ruta = :id_ruta, nom_archivo = :nom_archivo, estado = :estado
						WHERE archivo_id = :archivo_id";

				$Instruc = $conexion->prepare($sql);
				$Instruc->bindParam(':procesos_id', $this->archivoId, PDO::PARAM_INT);
				$Instruc->bindParam(':tipo_docu_id', $this->tipoDocuId, PDO::PARAM_INT);
				$Instruc->bindParam(':id_ruta', $this->rutaId, PDO::PARAM_INT);
				$Instruc->bindParam(':nom_archivo', $this->nomArchivo, PDO::PARAM_STR);
				$Instruc->bindParam(':estado', $this->estado, PDO::PARAM_INT);
			} elseif ($this->accion == 'ELIMINAR') {

				$sql = "DELETE FROM cali_repositorio
						WHERE archivo_id = :archivo_id";

				$Instruc = $conexion->prepare($sql);
				$Instruc->bindParam(':archivo_id', $this->procesoId, PDO::PARAM_INT);
			}

			$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			$conexion = null;

			if ($Instruc) {
				return true;
			} else {
				return false;
			}
		} catch (PDOException $e) {
			echo "Ha surgido un error y no se puede ejecutar la consulta Calidad->Procedimientos, Accion: " . $this->accion . " - " . $Instruc->errorInfo() . " - " . $sql . $e->getMessage();
			exit;
		}
	}


	public static function Listar($Accion, $respositorioId, $procesoId, $procedimiId)
	{
		$conexion = new Conexion();

		try {

			if ($Accion == 1) {
				//Listo todo el repositorio
				$Sql = "SELECT `depen`.`nom_depen`, `proce`.`cod_proce`, `proce`.`nom_proce`, `procedi`.`cod_procedimiento`, `procedi`.`nom_procedimiento`, `tipo`.`nom_tipo_documento`, 
							`repo`.`tipo_docu_id`, `repo`.`fechor_cargue`, `repo`.`nom_archivo`, `repo`.`estado`
						FROM `cali_procedimientos` AS `procedi`
							INNER JOIN `cali_procesos` AS `proce` ON (`procedi`.`procesos_id` = `proce`.`procesos_id`)
							INNER JOIN `areas_dependencias` AS `depen`ON (`proce`.`id_depen` = `depen`.`id_depen`)
							INNER JOIN `cali_repositorio` AS `repo` ON (`repo`.`procesos_id` = `procedi`.`procedimiento_id`)
							INNER JOIN `cali_tipos_documentos` AS `tipo`ON (`repo`.`tipo_docu_id` = `tipo`.`tipo_docu_id`)";

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

	public static function Buscar($accion, $idProce, $procesoId, $tipoDocuId, $rutaId)
	{
		$conexion = new Conexion();

		try {

			if ($accion == 1) {
				// Buscar procedimientos por código
				$sql = "SELECT *
						FROM cali_procedimientos
						WHERE procesos_id = :procesos_id AND tipo_docu_id = :tipo_docu_id";

				$Instruc = $conexion->prepare($sql);
				$Instruc->bindParam(':procesos_id', $idProce, PDO::PARAM_INT);
				$Instruc->bindParam(':tipo_docu_id', $tipoDocuId, PDO::PARAM_STR);
			} elseif ($accion == 2) {
				// Buscar procedimientos por nombre
				$sql = "SELECT *
						FROM cali_procedimientos
						WHERE procesos_id = :procesos_id AND nom_procedimiento = :nom_procedimiento";

				$Instruc = $conexion->prepare($sql);
				$Instruc->bindParam(':procesos_id', $idProce, PDO::PARAM_INT);
				$Instruc->bindParam(':nom_procedimiento', $rutaId, PDO::PARAM_STR);
			} elseif ($accion == 3) {
				// Buscar procedimientos por id con su respectivo proceso y dependencia
				$sql = "SELECT
    `depn`.`id_depen`
    , `proce`.`procesos_id`
    , `procedi`.`archivo_id`
    , `procedi`.`cod_procedimiento`
    , `procedi`.`nom_procedimiento`
    , `procedi`.`estado`
FROM
    `iwana_sinergia`.`cali_procesos` AS `proce`
    INNER JOIN `iwana_sinergia`.`areas_dependencias` AS `depn`
        ON (`proce`.`id_depen` = `depn`.`id_depen`)
    INNER JOIN `iwana_sinergia`.`cali_procedimientos` AS `procedi`
        ON (`procedi`.`procesos_id` = `proce`.`procesos_id`)
						WHERE `procedi`.`archivo_id` = :archivo_id";

				$Instruc = $conexion->prepare($sql);
				$Instruc->bindParam(':archivo_id', $procesoId, PDO::PARAM_STR);
			}

			$Instruc->execute() or die(print_r("Calidad->Procesos, Buscar, Accion: " . $accion . " - " . $Instruc->errorInfo() . " - " . $sql, true));
			$Result = $Instruc->fetch();
			$conexion = null;

			if ($Result) {
				return new self("", $Result['archivo_id'], $Result['procesos_id'], $Result['tipo_docu_id'], $Result['id_ruta']);
			} else {
				return false;
			}
		} catch (PDOException $e) {
			echo 'Ha surgido un error y no se puede ejecutar la consulta.' . $e->getMessage();
			exit;
		}
	}
}
