<?php
class TipoCorrespondencia
{
	private $Accion;
	private $Id;
	private $IdOrigen;
	private $NombreTipo;
	private $Acti;

	public function __construct($Accion = null, $Id = null, $IdOrigen = null, $NombreTipo = null, $Acti = null)
	{
		$this->Accion     = $Accion;
		$this->Id         = $Id;
		$this->IdOrigen   = $IdOrigen;
		$this->NombreTipo = $NombreTipo;
		$this->Acti       = $Acti;
	}

	public function get_Id()
	{
		return $this->Id;
	}

	public function get_IdOrigen()
	{
		return $this->IdOrigen;
	}

	public function get_NombreTipo()
	{
		return $this->NombreTipo;
	}

	public function get_Acti()
	{
		return $this->Acti;
	}

	public function set_Accion($Accion)
	{
		return $this->Accion = $Accion;
	}

	public function set_Id($Id)
	{
		return $this->Id = $Id;
	}

	public function set_IdOrigen($IdOrigen)
	{
		return $this->IdOrigen = $IdOrigen;
	}

	public function set_NombreTipo($NombreTipo)
	{
		return $this->NombreTipo = $NombreTipo;
	}

	public function set_Acti($Acti)
	{
		return $this->Acti = $Acti;
	}

	public function Gestionar()
	{
		$conexion = new Conexion();

		try {
			if ($this->Accion == 'Insertar') {
				$Sql = "INSERT INTO `config_tipo_correspondencia`(`id_origen`, `nom_tipo`, `acti`)
						VALUES (:id_origen, :nom_tipo, 1)";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_origen', $this->IdOrigen, PDO::PARAM_INT);
				$Instruc->bindParam(':nom_tipo', $this->NombreTipo, PDO::PARAM_STR);
			}
			if ($this->Accion == 'Editar') {
				$Sql = "UPDATE config_tipo_correspondencia
						SET nom_tipo = :nom_tipo, id_origen = :id_origen, acti = :acti
						WHERE id_tipo = :id_tipo";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':nom_tipo', $this->NombreTipo, PDO::PARAM_STR);
				$Instruc->bindParam(':id_origen', $this->IdOrigen, PDO::PARAM_INT);
				$Instruc->bindParam(':acti', $this->Acti, PDO::PARAM_INT);
				$Instruc->bindParam(':id_tipo', $this->Id, PDO::PARAM_INT);
			}
			if ($this->Accion == 'ACTIVAR_INACTIVAR') {
				$Sql = "UPDATE config_tipo_correspondencia
						SET acti = :acti
						WHERE id_tipo = :id_tipo";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':acti', $this->Acti, PDO::PARAM_INT);
				$Instruc->bindParam(':id_tipo', $this->Id, PDO::PARAM_INT);
			}
			if ($this->Accion == 'Eliminar') {
				$Sql = "DELETE
						FROM config_tipo_correspondencia
						WHERE id_tipo = :id_tipo";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_tipo', $this->Id, PDO::PARAM_INT);
			}
			if ($this->Accion == 'ACTIVAR_INACTIVAR') {
				$Sql = "UPDATE config_tipo_correspondencia
						SET acti = '" . $this->Acti . "'
						WHERE id_tipo = " . $this->Id;
			}

			$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			$conexion = null;

			if ($Instruc) {
				return true;
			} else {
				return false;
			}
		} catch (PDOException $e) {
			echo 'Ha surgido un error y no se puede ejecutar la consulta.' . $e->getMessage();
			exit;
		}
	}

	public static function Listar($Accion, $Id, $Nom, $Origen)
	{
		$conexion = new Conexion();

		if ($Accion == 1) {
			$Sql = "SELECT `tipo_corres`.`id_tipo`, `tipo_corres`.`id_origen`, `origen`.`nom_origen`, `tipo_corres`.`nom_tipo`,
						`tipo_corres`.`nom_tipo`, `tipo_corres`.`acti`
					FROM `config_tipo_correspondencia` AS `tipo_corres`
					    INNER JOIN `config_origen_correspondencia` AS `origen` ON (`tipo_corres`.`id_origen` = `origen`.`id_origen`)";
			$Instruc = $conexion->prepare($Sql);
		} elseif ($Accion == 2) {
			$Sql = "SELECT *
					FROM config_tipo_correspondencia
					WHERE id_tipo = " . $Id;

			$Instruc = $conexion->prepare($Sql);
		} elseif ($Accion == 3) {
			$Sql = "SELECT *
					FROM config_tipo_correspondencia
					WHERE acti = 1 AND id_origen = :id_origen";

			$Instruc = $conexion->prepare($Sql);
			$Instruc->bindParam(':id_origen', $Origen, PDO::PARAM_INT);
		}

		$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $SqlBuscar, true));
		$Result = $Instruc->fetchAll();
		$conexion = null;
		return $Result;
	}

	public static function Buscar($Accion, $Id, $IdOrigen, $Nom)
	{
		$conexion = new Conexion();

		if ($Accion == 1) {
			$Sql = "SELECT *
					FROM config_tipo_correspondencia
					WHERE nom_tipo = :nom_tipo AND id_origen = :id_origen";

			$Instruc = $conexion->prepare($Sql);
			$Instruc->bindParam(':nom_tipo', $Nom, PDO::PARAM_INT);
			$Instruc->bindParam(':id_origen', $IdOrigen, PDO::PARAM_INT);
		} elseif ($Accion == 2) {
			$Sql = "SELECT *
					FROM config_tipo_correspondencia
					WHERE id_tipo = :id_tipo";

			$Instruc = $conexion->prepare($Sql);
			$Instruc->bindParam(':id_tipo', $Id, PDO::PARAM_INT);
		}

		$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $SqlBuscar, true));
		$Result = $Instruc->fetch();
		$conexion = null;
		if ($Result) {
			return new self("", $Result['id_tipo'], $Result['id_origen'], $Result['nom_tipo'], $Result['acti']);
		} else {
			return false;
		}
	}
}
