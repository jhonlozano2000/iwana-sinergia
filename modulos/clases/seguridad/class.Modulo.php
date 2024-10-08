<?php

class Modulo
{

	private $Accion;
	private $Id;

	public function __construct($Accion = null, $Id = null)
	{
		$this->Accion = $Accion;
		$this->Id     = $Id;
	}

	public static function Listar($Accion, $Id)
	{
		$conexion = new Conexion();

		try {
			if ($Accion == 1) {
				//Listo todos los permisos
				$Sql = "SELECT *
						FROM segu_modu
						ORDER BY nom_modu";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			}

			$Result = $Instruc->fetchAll();
			$conexion = null;
			return $Result;
		} catch (PDOException $e) {
			echo 'Ha surgido un error y no se puede ejecutar la consulta.' . $e->getMessage();
			exit;
		}
	}

	public static function Buscar($Accion, $Id)
	{
		$conexion = new Conexion();

		try {
			if ($Accion == 1) {
				$Sql = "SELECT * FROM segu_modu ORDER BY nom_modu";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			}

			$Result = $InstrucBuscar->fetch();
			$conexion = null;
			if ($Result) {
				return new self(
					$Result['id_modu'],
					$Result['nom_modu'],
					$Result['menu'],
					$Result['boton'],
					$Result['acti']
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
