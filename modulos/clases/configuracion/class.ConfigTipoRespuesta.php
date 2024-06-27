<?php
class TipoRespuesta
{
	private $Accion;
	private $Id;
	private $Nombre;
	private $Acti;

	public function __construct($Accion = null, $Id = null, $Nombre = null, $Acti = null)
	{
		$this->Accion = $Accion;
		$this->Id     = $Id;
		$this->Nombre = $Nombre;
		$this->Acti   = $Acti;
	}

	public function get_Id()
	{
		return $this->Id;
	}

	public function get_Nombre()
	{
		return $this->Nombre;
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

	public function set_Nombre($Nombre)
	{
		return $this->Nombre = $Nombre;
	}

	public function set_Acti($Acti)
	{
		return $this->Acti = $Acti;
	}

	public function Gestionar()
	{
		$conexion = new Conexion();

		try {
			if ($this->Accion == 'INSERTAR') {
				$Sql = "INSERT INTO config_tipos_respuestas(nom_respues)
						VALUES('" . $this->Nombre . "')";
			}
			if ($this->Accion == 'EDITAR') {
				$Sql = "UPDATE config_tipos_respuestas
						SET nom_respues = '" . $this->Nombre . "'
						WHERE id_respue = " . $this->Id;
			}
			if ($this->Accion == 'ELIMINAR') {
				$Sql = "DELETE FROM config_tipos_respuestas
						WHERE id_respue = " . $this->Id;
			}
			if ($this->Accion == 'ACTIVAR_INACTIVAR') {
				$Sql = "UPDATE config_tipos_respuestas
						SET acti = '" . $this->Acti . "'
						WHERE id_respue = " . $this->Id;
			}

			$Instruc = $conexion->prepare($Sql);
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

	public static function Listar($Accion, $Id, $Nom)
	{
		$conexion = new Conexion();

		if ($Accion == 1) {
			$SqlBuscar = "SELECT *
						FROM config_tipos_respuestas
						ORDER BY nom_respues";
		} elseif ($Accion == 2) {
			$SqlBuscar = "SELECT *
						FROM config_tipos_respuestas
						WHERE id_respue = " . $Id;
		} elseif ($Accion == 3) {
			$SqlBuscar = "SELECT *
						FROM config_tipos_respuestas
						WHERE acti = 1";
		}

		$Instruc = $conexion->prepare($SqlBuscar);
		$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $SqlBuscar, true));
		$Result = $Instruc->fetchAll();
		$conexion = null;
		return $Result;
	}

	public static function Buscar($Accion, $Id, $Nom)
	{
		$conexion = new Conexion();
		if ($Accion == 1) {
			$SqlBuscar = "SELECT * FROM config_tipos_respuestas ORDER BY nom_respues";
		} elseif ($Accion == 2) {
			$SqlBuscar = "SELECT * FROM config_tipos_respuestas WHERE id_respue = " . $Id;
		}

		$Instruc = $conexion->prepare($SqlBuscar);
		$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $SqlBuscar, true));
		$Result = $Instruc->fetch();
		$conexion = null;
		if ($Result) {
			return new self("", $Result['id_respue'], $Result['nom_respues'], $Result['acti']);
		} else {
			return false;
		}
	}
}
