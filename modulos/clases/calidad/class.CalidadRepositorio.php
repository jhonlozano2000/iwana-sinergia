<?php
class CalidadRepositorio
{
	private $accion;
	private $archivoId;
	private $procedimientoId;
	private $tipoDocuId;
	private $rutaId;
	private $fecHorRegistro;
	private $nomArchivoOriginal;
	private $nomArchivoUnico;
	private $estado;

	public function __construct($accion = null,  $archivoId = null, $procedimientoId = null, $tipoDocuId = null, $rutaId = null, $fecHorRegistro = null, $nomArchivoOriginal = null, $nomArchivoUnico = null, $estado = null)
	{
		$this->accion = $accion;
		$this->archivoId = $archivoId;
		$this->procedimientoId = $procedimientoId;
		$this->tipoDocuId = $tipoDocuId;
		$this->rutaId = $rutaId;
		$this->fecHorRegistro = $fecHorRegistro;
		$this->nomArchivoOriginal = $nomArchivoOriginal;
		$this->nomArchivoUnico = $nomArchivoUnico;
		$this->estado = $estado;
	}

	public function getArchivoId()
	{
		return $this->archivoId;
	}

	public function getProcesoId()
	{
		return $this->procedimientoId;
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

	public function getNomArchivoOriginal()
	{
		return $this->nomArchivoOriginal;
	}

	public function getNomArchivoUnico()
	{
		return $this->nomArchivoUnico;
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

	public function setProcesoId($procedimientoId)
	{
		return $this->procedimientoId = $procedimientoId;
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

	public function setNomArchivoOriginal($nomArchivo)
	{
		return $this->nomArchivoOriginal = $nomArchivo;
	}

	public function setNomArchivoUnico($nomArchivoUnico)
	{
		return $this->nomArchivoUnico = $nomArchivoUnico;
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

				$sql = "INSERT INTO cali_repositorio(procedimiento_id, tipo_docu_id, id_ruta, nom_archivo_original, nom_archivo_unico)
						VALUES(:procedimiento_id, :tipo_docu_id, :id_ruta, :nom_archivo_original, :nom_archivo_unico)";

				$Instruc = $conexion->prepare($sql);
				$Instruc->bindParam(':procedimiento_id', $this->procedimientoId, PDO::PARAM_INT);
				$Instruc->bindParam(':tipo_docu_id', $this->tipoDocuId, PDO::PARAM_INT);
				$Instruc->bindParam(':id_ruta', $this->rutaId, PDO::PARAM_INT);
				$Instruc->bindParam(':nom_archivo_original', $this->nomArchivoOriginal, PDO::PARAM_STR);
				$Instruc->bindParam(':nom_archivo_unico', $this->nomArchivoUnico, PDO::PARAM_STR);
			} elseif ($this->accion == 'EDITAR') {

				$sql = "UPDATE cali_repositorio
						SET procedimiento_id = :procedimiento_id, tipo_docu_id = :tipo_docu_id, estado = :estado
						WHERE archivo_id = :archivo_id";

				$Instruc = $conexion->prepare($sql);
				$Instruc->bindParam(':procedimiento_id', $this->archivoId, PDO::PARAM_INT);
				$Instruc->bindParam(':tipo_docu_id', $this->tipoDocuId, PDO::PARAM_INT);
				$Instruc->bindParam(':id_ruta', $this->rutaId, PDO::PARAM_INT);
				$Instruc->bindParam(':nom_archivo', $this->nomArchivoOriginal, PDO::PARAM_STR);
				$Instruc->bindParam(':nom_archivo_unico', $this->nomArchivoUnico, PDO::PARAM_STR);
				$Instruc->bindParam(':estado', $this->estado, PDO::PARAM_INT);
				$Instruc->bindParam(':archivo_id', $this->archivoId, PDO::PARAM_INT);
			} elseif ($this->accion == 'ACTUALIZAR_NOMBRES_ARCHIVOS') {

				$sql = "UPDATE cali_repositorio
						SET id_ruta = :id_ruta, nom_archivo_original = :nom_archivo_original, nom_archivo_unico = :nom_archivo_unico
						WHERE archivo_id = :archivo_id";

				$Instruc = $conexion->prepare($sql);
				$Instruc->bindParam(':id_ruta', $this->rutaId, PDO::PARAM_INT);
				$Instruc->bindParam(':nom_archivo_original', $this->nomArchivoOriginal, PDO::PARAM_STR);
				$Instruc->bindParam(':nom_archivo_unico', $this->nomArchivoUnico, PDO::PARAM_STR);
				$Instruc->bindParam(':archivo_id', $this->archivoId, PDO::PARAM_INT);
			} elseif ($this->accion == 'ELIMINAR') {

				$sql = "DELETE FROM cali_repositorio
						WHERE archivo_id = :archivo_id";

				$Instruc = $conexion->prepare($sql);
				$Instruc->bindParam(':archivo_id', $this->archivoId, PDO::PARAM_INT);
			}

			$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $sql, true));
			$this->archivoId = $conexion->lastInsertId();
			$conexion = null;

			if ($Instruc) {
				return true;
			} else {
				return false;
			}
		} catch (PDOException $e) {
			echo "Ha surgido un error y no se puede ejecutar la consulta Calidad->Repositorio, Accion: " . $this->accion . " - " . $Instruc->errorInfo() . " - " . $sql . $e->getMessage();
			exit;
		}
	}


	public static function Listar($Accion, $respositorioId, $procedimientoId, $procedimiId)
	{
		$conexion = new Conexion();

		try {

			if ($Accion == 1) {
				//Listo todo el repositorio
				$Sql = "SELECT `depen`.`nom_depen`, `proce`.`cod_proce`, `proce`.`nom_proce`, `procedi`.`cod_procedimiento`, `procedi`.`nom_procedimiento`, `tipo`.`nom_tipo_documento`,
							`repo`.`tipo_docu_id`, `repo`.`fechor_cargue`, `repo`.`nom_archivo_original`, `repo`.`nom_archivo_unico`, `repo`.`estado`
						FROM `cali_procedimientos` AS `procedi`
							INNER JOIN `cali_procesos` AS `proce` ON (`procedi`.`procedimiento_id` = `proce`.`procedimiento_id`)
							INNER JOIN `areas_dependencias` AS `depen`ON (`proce`.`id_depen` = `depen`.`id_depen`)
							INNER JOIN `cali_repositorio` AS `repo` ON (`repo`.`procedimiento_id` = `procedi`.`procedimiento_id`)
							INNER JOIN `cali_tipos_documentos` AS `tipo`ON (`repo`.`tipo_docu_id` = `tipo`.`tipo_docu_id`)";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 2) {
				//Listo los archivo por tipo de documento y proceso
				$Sql = "SELECT *
						FROM `cali_repositorio`
						WHERE `tipo_docu_id` = :tipo_docu_id AND `procedimiento_id` = :proceso_id
						ORDER BY `nom_archivo_original`";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':tipo_docu_id', $procedimiId, PDO::PARAM_INT);
				$Instruc->bindParam(':proceso_id', $procedimientoId, PDO::PARAM_INT);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			}

			$Result = $Instruc->fetchAll();
			$conexion = null;
			return $Result;
		} catch (PDOException $e) {
			echo 'Ha surgido un error y no se puede ejecutar la consulta. Calidad->Repositorios, Listar, Accion: ' . $Accion . " - " . $e->getMessage();
			exit;
		}
	}

	public static function Buscar($accion, $archivoId)
	{
		$conexion = new Conexion();

		try {

			if ($accion == 1) {
				// Buscar un archivo por id
				$sql = "SELECT *
						FROM cali_repositorio
						WHERE archivo_id = :archivo_id";

				$Instruc = $conexion->prepare($sql);
				$Instruc->bindParam(':archivo_id', $archivoId, PDO::PARAM_INT);
			}

			$Instruc->execute() or die(print_r("Calidad->Repositorio, Buscar, Accion: " . $accion . " - " . $Instruc->errorInfo() . " - " . $sql, true));
			$Result = $Instruc->fetch();
			$conexion = null;

			if ($Result) {
				return new self(
					"",
					$Result['archivo_id'],
					$Result['procedimiento_id'],
					$Result['tipo_docu_id'],
					$Result['id_ruta'],
					$Result['fechor_cargue'],
					$Result['nom_archivo_original'],
					$Result['nom_archivo_unico'],
					$Result['estado']
				);
			} else {
				return false;
			}
		} catch (PDOException $e) {
			echo 'Ha surgido un error y no se puede ejecutar la consulta.' . $e->getMessage();
			exit;
		}
	}
}
