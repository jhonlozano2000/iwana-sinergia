<?php
class Saludo
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
		$this->Acti = $Acti;
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

		if ($this->Accion == 'Insertar') {
			$Sql = "INSERT INTO config_saludo(saludo)
					VALUES('" . $this->Nombre . "')";
		}
		if ($this->Accion == 'Editar') {
			$Sql = "UPDATE config_saludo
					SET saludo = '" . $this->Nombre . "', acti = " . $this->Acti . "
					WHERE id_saludo = " . $this->Id;
		}
		if ($this->Accion == 'ACTIVAR_INACTIVAR') {
			$Sql = "UPDATE config_saludo SET acti = " . $this->Acti . "
					WHERE id_saludo = " . $this->Id;
		}
		if ($this->Accion == 'Eliminar') {
			$Sql = "DELETE FROM config_saludo WHERE id_saludo = " . $this->Id;
		}

		$Instruc = $conexion->prepare($Sql);
		$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
		$conexion = null;
		if ($Instruc) {
			return true;
		} else {
			return false;
		}
	}

	public static function Listar($Accion, $Id, $Nom)
	{
		$conexion = new Conexion();

		if ($Accion == 1) {
			$SqlBuscar = "SELECT * FROM config_saludo ORDER BY saludo";
		} elseif ($Accion == 2) {
			$SqlBuscar = "SELECT * FROM config_saludo WHERE id_saludo = " . $Id;
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
			$SqlBuscar = "SELECT * FROM config_saludo ORDER BY saludo";
		} elseif ($Accion == 2) {
			$SqlBuscar = "SELECT * FROM config_saludo WHERE id_saludo = " . $Id;
		}

		$Instruc = $conexion->prepare($SqlBuscar);
		$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $SqlBuscar, true));
		$Result = $Instruc->fetch();
		$conexion = null;
		if ($Result) {
			return new self("", $Result['id_saludo'], $Result['saludo'], $Result['acti']);
		} else {
			return false;
		}
	}
}
