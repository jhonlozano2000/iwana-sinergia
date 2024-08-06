<?php
class Perfiles
{
	private $Accion;
	private $IdPerfil;
	private $NomPerfil;
	private $Observa;
	private $Acti;

	public function __construct($Accion = null, $IdPerfil = null, $NomPerfil = null, $Observa = null, $Acti = null)
	{
		$this->Accion    = $Accion;
		$this->IdPerfil  = $IdPerfil;
		$this->NomPerfil = $NomPerfil;
		$this->Observa   = $Observa;
		$this->Acti      = $Acti;
	}

	public function getAccion()
	{
		return $this->Accion;
	}

	public function getId_Perfil()
	{
		return $this->IdPerfil;
	}

	public function getNom_Perfil()
	{
		return $this->NomPerfil;
	}

	public function getObserva()
	{
		return $this->Observa;
	}

	public function getActi()
	{
		return $this->Acti;
	}

	public function setAccion($Accion)
	{
		return $this->Accion = $Accion;
	}

	public function setId_Perfil($IdPerfil)
	{
		return $this->IdPerfil = $IdPerfil;
	}

	public function setNom_Perfil($NomPerfil)
	{
		return $this->NomPerfil = $NomPerfil;
	}

	public function setObserva($Observa)
	{
		return $this->Observa = $Observa;
	}

	public function setActi($Acti)
	{
		return $this->Acti = $Acti;
	}

	public function Gestionar()
	{
		$conexion = new Conexion();

		try {

			if ($this->Accion == 'INSERTAR') {
				$Sql = "INSERT INTO segu_perfiles(nom_perfil, observa, acti)
							VALUES(:nom_perfil, :observa, 1)";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':nom_perfil', $this->NomPerfil, PDO::PARAM_STR);
				$Instruc->bindParam(':observa', $this->Observa, PDO::PARAM_STR);
			} elseif ($this->Accion == 'EDITAR') {
				$Sql = "UPDATE segu_perfiles SET nom_perfil = :nom_perfil,
								observa = :observa,	acti = :acti
						WHERE id_perfil = :id_perfil";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':nom_perfil', $this->NomPerfil, PDO::PARAM_STR);
				$Instruc->bindParam(':observa', $this->Observa, PDO::PARAM_STR);
				$Instruc->bindParam(':acti', $this->Acti, PDO::PARAM_INT);
				$Instruc->bindParam(':id_perfil', $this->IdPerfil, PDO::PARAM_INT);
			} elseif ($this->Accion == 'ELIMINAR') {
				$Sql = "DELETE FROM segu_perfiles WHERE id_perfil = :id_perfil";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_perfil', $this->IdPerfil, PDO::PARAM_INT);
			} elseif ($this->Accion == 'ACTIVAR') {
				$Sql = "UPDATE segu_perfiles SET acti = :acti WHERE id_perfil = :id_perfil";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':acti', $this->Acti, PDO::PARAM_INT);
				$Instruc->bindParam(':id_perfil', $this->IdPerfil, PDO::PARAM_INT);
			}

			$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			$this->IdPerfil = $conexion->lastInsertId();
			$conexion = null;

			if ($Instruc) {
				return true;
			} else {
				return false;
			}
		} catch (PDOException $e) {
			echo 'Ha surgido un error y no se puede ejecutar la consulta, Seguridad->Detalle Perfiles, Accion: ' . $this->Accion . " - " . $e->getMessage();
			exit;
		}
	}

	public static function Gestionar_Detalle($Accion, $IdModulo, $IdPerfil, $Acti)
	{
		$conexion = new Conexion();

		try {
			if ($Accion == 1) {
				$Sql = "INSERT INTO segu_perfiles_deta(id_perfil, id_modu, acti)
						VALUES(:id_perfil, :id_modu, :acti)";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_perfil', $IdPerfil, PDO::PARAM_INT);
				$Instruc->bindParam(':id_modu', $IdModulo, PDO::PARAM_INT);
				$Instruc->bindParam(':acti', $Acti, PDO::PARAM_INT);
			} elseif ($Accion == 2) {
				$Sql = "UPDATE segu_perfiles_deta
						SET acti = :acti
						WHERE id_perfil = :id_perfil AND id_modu = :id_modu";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':acti', $Acti, PDO::PARAM_INT);
				$Instruc->bindParam(':id_perfil', $IdPerfil, PDO::PARAM_INT);
				$Instruc->bindParam(':id_modu', $IdModulo, PDO::PARAM_INT);
			} elseif ($Accion == 3) {
				$Sql = "UPDATE segu_perfiles_deta
						SET acti = 0 WHERE id_perfil = " . $IdPerfil;
				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_perfil', $IdPerfil, PDO::PARAM_INT);
			} elseif ($Accion == 4) {
				$Sql = "DELETE
						FROM segu_perfiles_deta
						WHERE id_perfil = :id_perfil";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_perfil', $IdPerfil, PDO::PARAM_INT);
			}

			$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			$conexion = null;

			if ($Instruc) {
				return true;
			} else {
				return false;
			}
		} catch (PDOException $e) {
			echo 'Ha surgido un error y no se puede ejecutar la consulta, Detalle del perfil.' . $e->getMessage();
			exit;
		}
	}


	public static function Listar($Accion, $IdPerfil, $NomPerfil, $IdMOdulo)
	{
		$conexion = new Conexion();

		try {

			$Sql = "SELECT p.id_perfil, p.nom_perfil, p.observa, p.acti AS acti_perfil, m.id_modu, m.modu_padre, m.nom_modu, m.menu,
						m.boton, m.acti AS acti_modulo
					FROM segu_perfiles_deta AS pd
					    INNER JOIN segu_perfiles AS p ON (pd.id_perfil = p.id_perfil)
					    INNER JOIN segu_modu AS m ON (pd.id_modu = m.id_modu) ";

			if ($Accion == 1) {
				/******************************************************************************************/
				/*	LISTO UN REGISTROS
				/******************************************************************************************/
				$Sql = "SELECT * FROM segu_perfiles
						WHERE  id_perfil = :id_perfil";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(":id_perfil", $IdPerfil, PDO::PARAM_STR);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 2) {
				/******************************************************************************************/
				/*	LISTO TODOS LOS PERFILES
				/******************************************************************************************/
				$Sql = "SELECT * FROM segu_perfiles ORDER BY nom_perfil ASC";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 3) {
				/******************************************************************************************/
				/*	LISTO LOS PRIVILEGIOS DE UN PERFIL
				/******************************************************************************************/
				$Sql .= "WHERE m.id_modu = :id_modu ORDER BY m.nom_modu";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(":id_modu", $IdMOdulo, PDO::PARAM_STR);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 4) {
			} elseif ($Accion == 5) {
				/******************************************************************************************/
				/*	LISTO UN PERFIL POR NOMBRE
				/******************************************************************************************/
				$Sql .= "WHERE m.nom_perfil = :nom_perfil";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(":nom_perfil", $NomPerfil, PDO::PARAM_STR);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 6) {
				/******************************************************************************************/
				/*	LISTO LOS MODULOS HIJOS DE UN MODULO
				/*	Esto es para cuando se carga el arpol del menu
				/******************************************************************************************/
				$Sql .= "WHERE m.modu_padre = :modu_padre";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(":modu_padre", $IdPerfil, PDO::PARAM_STR);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 7) {
				/******************************************************************************************/
				/*	LISTO EL DETALLE DE UN PERFIL
				/******************************************************************************************/
				$Sql = "SELECT * FROM segu_perfiles_deta
						WHERE id_perfil = :id_perfil";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(":id_perfil", $IdPerfil, PDO::PARAM_INT);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			}

			$Result = $Instruc->fetchAll();
			$conexion = null;
			return $Result;
		} catch (PDOException $e) {
			echo 'Ha surgido un error y no se puede ejecutar la consulta, Listar Perfiles.' . $e->getMessage();
			exit;
		}
	}

	public static function Buscar($Accion, $IdPerfil, $NomPerfil, $IdMOdulo)
	{
		$conexion = new Conexion();

		try {

			$Sql = "SELECT p.id_perfil, p.nom_perfil, p.observa, p.acti AS acti_perfil, m.id_modu, m.modu_padre, m.nom_modu, m.menu, 
						m.boton, m.acti AS acti_modulo
					FROM segu_perfiles_deta AS pd
					    INNER JOIN segu_perfiles AS p ON (pd.id_perfil = p.id_perfil)
					    INNER JOIN segu_modu AS m ON (pd.id_modu = m.id_modu) ";

			if ($Accion == 1) {
				/******************************************************************************************/
				/*	LISTO UN REGISTROS
				/******************************************************************************************/
				$Sql = "SELECT * FROM segu_perfiles
						WHERE  id_perfil = :id_perfil";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(":id_perfil", $IdPerfil, PDO::PARAM_STR);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 2) {
				/******************************************************************************************/
				/*	LISTO UN REGISTROS
				/******************************************************************************************/
				$Sql = "SELECT * FROM segu_perfiles
						WHERE  nom_perfil = :nom_perfil";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(":nom_perfil", $NomPerfil, PDO::PARAM_STR);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			}

			$Result = $Instruc->fetch();
			$conexion = null;
			if ($Result) {
				return new self("", $Result['id_perfil'], $Result['nom_perfil'], $Result['observa'], $Result['acti']);
			} else {
				return false;
			}
		} catch (PDOException $e) {
			echo 'Ha surgido un error y no se puede ejecutar la consulta.' . $e->getMessage();
			exit;
		}
	}
}
