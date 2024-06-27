<?php
class Departamento
{
	private $Accion;
	private $IdDepar;
	private $NomDepar;

	public function __construct($Accion = null, $IdDepar = null, $NomDepar = null)
	{
		$this->Accion  = $Accion;
		$this->IdDepar = $IdDepar;
		$this->NomDepar  = $NomDepar;
	}

	public function get_IdDepar()
	{
		return $this->IdDepar;
	}

	public function get_NomDepar()
	{
		return $this->NomDepar;
	}

	public function set_Accion($Accion)
	{
		return $this->Accion = $Accion;
	}

	public function set_IdDepar($IdDepar)
	{
		return $this->IdDepar = $IdDepar;
	}

	public function set_NomDepar($NomDepar)
	{
		return $this->NomDepar = $NomDepar;
	}

	public static function Listar()
	{
		$conexion = new Conexion();

		$SqlBuscar = "SELECT * FROM config_depar ORDER BY nom_depar";
		$Instruc = $conexion->prepare($SqlBuscar);
		$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $SqlBuscar, true));
		$Result = $Instruc->fetchAll();
		$conexion = null;
		return $Result;
	}

	public static function Buscar($Accion, $IdDepar)
	{
		$conexion = new Conexion();
		if ($Accion == 1) {
			$SqlBuscar = "SELECT * FROM config_depar WHERE id_depar = " . $IdDepar;
		}

		$Instruc = $conexion->prepare($SqlBuscar);
		$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $SqlBuscar, true));
		$Result = $Instruc->fetch();
		$conexion = null;

		if ($Result) {
			return new self("", $Result['id_depar'], $Result['nom_depar']);
		} else {
			return false;
		}
	}
}
