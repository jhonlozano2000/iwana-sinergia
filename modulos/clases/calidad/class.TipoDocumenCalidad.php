<?php
class TipoDocumentoCalidad
{
	private $accion;
	private $tipoDocuId;
	private $nomTipoDocu;
	private $estado;

	public function __construct($accion = null, $tipoDocuId = null, $nomTipoDocu = null, $estado = null)
	{
		$this->accion = $accion;
		$this->tipoDocuId = $tipoDocuId;
		$this->nomTipoDocu = $nomTipoDocu;
		$this->estado = $estado;
	}

	public function getTipoDocuId()
	{
		return $this->tipoDocuId;
	}

	public function getnomTipoDocu()
	{
		return $this->nomTipoDocu;
	}

	public function getEstado()
	{
		return $this->estado;
	}

	public function setAccion($accion)
	{
		return $this->accion = $accion;
	}

	public function setTipoDocuId($tipoDocuId)
	{
		return $this->tipoDocuId = $tipoDocuId;
	}

	public function setNomTipoDocu($nomTipoDocu)
	{
		return $this->nomTipoDocu = $nomTipoDocu;
	}

	public function setEstado($estado)
	{
		$this->estado = $estado;
	}

	public function Gestionar()
	{
		$conexion = new Conexion();

		try {
			if ($this->accion == 'INSERTAR') {

				$sql = "INSERT INTO cali_tipos_documentos(nom_tipo_documento)
						VALUES(:nom_tipo_documento)";

				$Instruc = $conexion->prepare($sql);
				$Instruc->bindParam(':nom_tipo_documento', $this->nomTipoDocu, PDO::PARAM_STR);
			} elseif ($this->accion == 'EDITAR') {

				$sql = "UPDATE cali_tipos_documentos
						SET nom_tipo_documento = :nom_tipo_documento, estado = :estado
						WHERE tipo_docu_id = :tipo_docu_id";

				$Instruc = $conexion->prepare($sql);
				$Instruc->bindParam(':nom_tipo_documento', $this->nomTipoDocu, PDO::PARAM_STR);
				$Instruc->bindParam(':estado', $this->estado, PDO::PARAM_INT);
				$Instruc->bindParam(':tipo_docu_id', $this->tipoDocuId, PDO::PARAM_INT);
			} elseif ($this->accion == 'ELIMINAR') {

				$sql = "DELETE
						FROM cali_tipos_documentos
						WHERE tipo_docu_id = :tipo_docu_id";

				$Instruc = $conexion->prepare($sql);
				$Instruc->bindParam(':tipo_docu_id', $this->tipoDocuId, PDO::PARAM_INT);
			} elseif ($this->accion == 'ACTIVAR_INACTIVAR') {

				$sql = "UPDATE cali_tipos_documentos
						SET estado = :estado
						WHERE tipo_docu_id = :tipo_docu_id";

				$Instruc = $conexion->prepare($sql);
				$Instruc->bindParam(':estado', $this->estado, PDO::PARAM_INT);
				$Instruc->bindParam(':tipo_docu_id', $this->tipoDocuId, PDO::PARAM_INT);
			}

			$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			$conexion = null;

			if ($Instruc) {
				return true;
			} else {
				return false;
			}
		} catch (PDOException $e) {
			echo "Ha surgido un error y no se puede ejecutar la consulta Calidad->Tipos de documentos, Accion: " . $this->accion . " - " . $Instruc->errorInfo() . " - " . $sql . $e->getMessage();
			exit;
		}
	}


	public static function Listar($Accion, $idTipoDocu)
	{
		$conexion = new Conexion();

		try {

			if ($Accion == 1) {
				/**
				 * Listo los todos los tipos de documentos
				 */
				$Sql = "SELECT *
						FROM `cali_tipos_documentos`
						ORDER BY nom_tipo_documento";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 2) {
				/**
				 * Listo los el tipo de documento por Id
				 */
				$Sql = "SELECT *
						FROM `cali_tipos_documentos`
						WHERE (`tipo_docu_id` = :tipo_docu_id)";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':tipo_docu_id', $idTipoDocu, PDO::PARAM_INT);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 3) {
				/**
				 * Listo los el tipo de documento activos
				 */
				$Sql = "SELECT *
						FROM `cali_tipos_documentos`
						WHERE (`estado` = 1)
						ORDER BY 2";

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

	public static function Buscar($accion, $idTipoDocu, $nomTipoDocu)
	{
		$conexion = new Conexion();

		try {

			if ($accion == 1) {
				// Buscar el tipo de documento por id
				$sql = "SELECT *
						FROM cali_tipos_documentos
						WHERE tipo_docu_id = :tipo_docu_id";

				$Instruc = $conexion->prepare($sql);
				$Instruc->bindParam(':tipo_docu_id', $idTipoDocu, PDO::PARAM_STR);
			} elseif ($accion == 2) {
				// Buscar el tipo de documento por nombre
				$sql = "SELECT *
						FROM cali_tipos_documentos
						WHERE nom_tipo_documento = :nom_tipo_documento";

				$Instruc = $conexion->prepare($sql);
				$Instruc->bindParam(':nom_tipo_documento', $nomTipoDocu, PDO::PARAM_STR);
			}

			$Instruc->execute() or die(print_r("Calidad->Tipos de documentos, Buscar, Accion: " . $accion . " - " . $Instruc->errorInfo() . " - " . $sql, true));
			$Result = $Instruc->fetch();
			$conexion = null;

			if ($Result) {
				return new self("", $Result['tipo_docu_id'], $Result['nom_tipo_documento'], $Result['estado']);
			} else {
				return false;
			}
		} catch (PDOException $e) {
			echo 'Ha surgido un error y no se puede ejecutar la consulta.' . $e->getMessage();
			exit;
		}
	}
}
