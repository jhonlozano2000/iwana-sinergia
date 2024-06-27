<?php
class TipoDocumento
{
	private $Accion;
	private $Id;
	private $NomTipoDocumento;
	private $Observa;
	private $Acti;

	public function __construct($Accion = null, $Id = null, $NomTipoDocumento = null, $Observa = null, $Acti = null)
	{
		$this->Accion           = $Accion;
		$this->Id               = $Id;
		$this->NomTipoDocumento = $NomTipoDocumento;
		$this->Observa          = $Observa;
		$this->Acti             = $Acti;
	}

	public function get_Id()
	{
		return $this->Id;
	}

	public function getNom_TipoDocumento()
	{
		return $this->NomTipoDocumento;
	}

	public function get_Observa()
	{
		return $this->Observa;
	}

	public function get_Acti()
	{
		return $this->Acti;
	}

	public function set_Accion($Accion)
	{
		$this->Accion = $Accion;
	}

	public function set_Id($Id)
	{
		$this->Id = $Id;
	}

	public function setNom_TipoDocumento($NomTipoDocumento)
	{
		$this->NomTipoDocumento = $NomTipoDocumento;
	}

	public function set_Observa($Observa)
	{
		$this->Observa = $Observa;
	}

	public function set_Acti($Acti)
	{
		$this->Acti = $Acti;
	}

	public function Gestionar()
	{
		$conexion = new Conexion();

		try {
			if ($this->Accion == 'INSERTAR') {
				$Sql = "INSERT INTO archivo_trd_tipo_docu (nom_tipodoc, observa, acti)
						VALUES(:nom_tipodoc, :observa, 1)";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':nom_tipodoc', $this->NomTipoDocumento, PDO::PARAM_STR);
				$Instruc->bindParam(':observa', $this->Observa, PDO::PARAM_STR);
			} elseif ($this->Accion == 'EDITAR') {
				$Sql = "UPDATE archivo_trd_tipo_docu
						SET nom_tipodoc = :nom_tipodoc, observa = :observa,	acti = :acti
						WHERE id_tipodoc = :id_tipodoc";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':nom_tipodoc', $this->NomTipoDocumento, PDO::PARAM_STR);
				$Instruc->bindParam(':observa', $this->Observa, PDO::PARAM_STR);
				$Instruc->bindParam(':acti', $this->Acti, PDO::PARAM_INT);
				$Instruc->bindParam(':id_tipodoc', $this->Id, PDO::PARAM_STR);
			} elseif ($this->Accion == 'ELIMINAR') {
				$Sql = "DELETE FROM archivo_trd_tipo_docu WHERE id_tipodoc = :id_tipodoc";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_tipodoc', $this->Id, PDO::PARAM_STR);
			}
			if ($this->Accion == 'ACTIVAR') {
				$Sql = "UPDATE archivo_trd_tipo_docu
							SET acti = :acti
						WHERE id_tipodoc = :id_tipodoc";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':acti', $this->Acti, PDO::PARAM_INT);
				$Instruc->bindParam(':id_tipodoc', $this->Id, PDO::PARAM_STR);
			}

			$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			$this->Id = $conexion->lastInsertId();
			$conexion = null;

			if ($Instruc) {
				return true;
			} else {
				return false;
			}
		} catch (PDOException $e) {
			echo 'Ha surgido un error y no se puede ejecutar la consulta, Tipos documentales -> Acción: ' . $this->Accion . " - " . $e->getMessage();
			exit;
		}
	}

	public static function Listar($Accion, $Id, $Nom)
	{
		$conexion = new Conexion();

		try {
			if ($Accion == 1) {
				/******************************************************************************************/
				/*  LISTO TODOS LOS REGISTROS
		        /******************************************************************************************/
				$Sql = "SELECT *
						FROM archivo_trd_tipo_docu
						ORDER BY 2";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 2) {
				/******************************************************************************************/
				/*  LISTO TODOS LOS REGISTROS ACTIVOS
		        /******************************************************************************************/
				$Sql = "SELECT *
						FROM archivo_trd_tipo_docu
						WHERE acti = 1
						ORDER BY 2";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			}

			$Result = $Instruc->fetchAll();
			$conexion = null;
			return $Result;
		} catch (PDOException $e) {
			echo 'Ha surgido un error y no se puede ejecutar la consulta, Tipos documentales -> Acción: ' . $Accion . ' - ' . $e->getMessage();
			exit;
		}
	}

	public static function Buscar($Accion, $Id, $Nom)
	{
		$conexion = new Conexion();

		try {
			if ($Accion == 1) {
				$Sql = "SELECT * FROM archivo_trd_tipo_docu WHERE id_tipodoc = " . $Id;
				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_tipodoc', $Id, PDO::PARAM_INT);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 2) {
				$Sql = "SELECT * FROM archivo_trd_tipo_docu WHERE nom_tipodoc = :nom_tipodoc";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':nom_tipodoc', $Nom, PDO::PARAM_INT);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			}

			$Result = $Instruc->fetch();
			$conexion = null;

			if ($Result) {
				return new self("", $Result['id_tipodoc'], $Result['nom_tipodoc'], $Result['observa'], $Result['acti']);
			} else {
				return false;
			}
		} catch (PDOException $e) {
			echo 'Ha surgido un error y no se puede ejecutar la consulta, Tipos documentales -> Acción: ' . $Accion . ' - ' . $e->getMessage();
			exit;
		}
	}
}
