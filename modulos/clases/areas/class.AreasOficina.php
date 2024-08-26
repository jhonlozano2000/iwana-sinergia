<?php
class Oficina
{
	private $Accion;
	private $IdOficina;
	private $IdDepen;
	private $CodOficina;
	private $CodCorres;
	private $NomOficina;
	private $Observa;
	private $Acti;

	public function __construct(
		$Accion = null,
		$IdOficina = null,
		$IdDepen = null,
		$CodOficina = null,
		$CodCorres = null,
		$NomOficina = null,
		$Observa = null,
		$Acti = null
	) {
		$this->Accion     = $Accion;
		$this->IdOficina  = $IdOficina;
		$this->IdDepen    = $IdDepen;
		$this->CodOficina = $CodOficina;
		$this->CodCorres  = $CodCorres;
		$this->NomOficina = $NomOficina;
		$this->Observa    = $Observa;
		$this->Acti       = $Acti;
	}

	public function getId_Oficina()
	{
		return $this->IdOficina;
	}

	public function getId_Dependencia()
	{
		return $this->IdDepen;
	}

	public function getCod_Oficina()
	{
		return $this->CodOficina;
	}

	public function getCod_Correspondencia()
	{
		return $this->CodCorres;
	}

	public function getNom_Oficina()
	{
		return $this->NomOficina;
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

	public function setId_Oficina($IdOficina)
	{
		return $this->IdOficina = $IdOficina;
	}

	public function setId_Dependencia($IdDepen)
	{
		return $this->IdDepen = $IdDepen;
	}

	public function setCod_Oficina($CodOficina)
	{
		return $this->CodOficina = $CodOficina;
	}

	public function setCod_Correspondencia($CodCorres)
	{
		return $this->CodCorres = $CodCorres;
	}

	public function setNom_Oficina($NomOficina)
	{
		$this->NomOficina = $NomOficina;
	}

	public function setObserva($descripcion)
	{
		$this->Observa = $descripcion;
	}

	public function setActi($acti)
	{
		$this->Acti = $acti;
	}

	public function Guardar()
	{
		$conexion = new Conexion();

		$sqlBuscarCodOfi = "SELECT cod_oficina
							FROM areas_oficinas
							WHERE cod_oficina = '" . $this->CodOficina . "'";
		$InstrucBuscarCodOfi = $conexion->prepare($sqlBuscarCodOfi);
		$InstrucBuscarCodOfi->execute() or die(print_r($InstrucBuscarCodOfi->errorInfo() . " - " . $sqlBuscarCodOfi, true));
		$NumeroRegisCodOfi = $InstrucBuscarCodOfi->rowCount();

		$sqlBuscarCodCorres = "SELECT cod_corres
								FROM areas_oficinas
								WHERE cod_corres = '" . $this->CodCorres . "'";
		$InstrucBuscarCodCorres = $conexion->prepare($sqlBuscarCodCorres);
		$InstrucBuscarCodCorres->execute() or die(print_r($InstrucBuscarCodCorres->errorInfo() . " - " . $sqlBuscarCodCorres, true));
		$NumeroRegisCodCorres = $InstrucBuscarCodCorres->rowCount();

		$sqlBuscarNom = "SELECT nom_oficina
						FROM areas_oficinas
						WHERE nom_oficina = '" . $this->NomOficina . "'";
		$InstrucBuscarNom = $conexion->prepare($sqlBuscarNom);
		$InstrucBuscarNom->execute() or die(print_r($InstrucBuscarNom->errorInfo() . " - " . $sqlBuscarNom, true));
		$NumeroRegisNom = $InstrucBuscarNom->rowCount();

		if ($NumeroRegisCodOfi == 1) {
			echo "El código de la Ofidencia ya se encuentra registrado en el sistema.";
		} elseif ($NumeroRegisCodCorres == 1) {
			echo "El código de la Ofidencia ya se encuentra registrado en el sistema.";
		} elseif ($NumeroRegisNom == 1) {
			echo "Ya existe una oficina con el nombre '" . $this->NomOficina . "'";
		} else {

			$Sql = "INSERT INTO areas_oficinas (id_depen, cod_oficina, cod_corres, nom_oficina, observa, acti)
						VALUES('" . $this->IdDepen . "',
								'" . $this->CodOficina . "',
								'" . $this->CodCorres . "',
								'" . $this->NomOficina . "',
								'" . $this->Observa . "',
								1)";

			$Instruc = $conexion->prepare($Sql);
			$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			$this->IdOficina = $conexion->lastInsertId();
			$conexion = null;
			echo 1;
		}
	}

	public function Modificar()
	{
		$conexion = new Conexion();

		$sqlModifica = "UPDATE areas_oficinas SET
							id_depen = " . $this->IdDepen . ",
							cod_oficina = '" . $this->CodOficina . "',
							cod_corres = '" . $this->CodCorres . "',
							nom_oficina = '" . $this->NomOficina . "',
							observa = '" . $this->Observa . "' ,
							acti = " . $this->Acti . "
						WHERE id_oficina = " . $this->IdOficina;

		$Instruc = $conexion->prepare($sqlModifica);
		$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $sqlModifica, true));
		$conexion = null;
		echo 1;
	}

	public function ActivaInactiva()
	{
		$conexion = new Conexion();

		$sqlModifica = "UPDATE areas_oficinas 
						SET acti = " . $this->Acti . "
						WHERE id_oficina = " . $this->IdOficina;

		$Instruc = $conexion->prepare($sqlModifica);
		$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $sqlModifica, true));
		$conexion = null;
		echo 1;
	}

	public function Eliminar()
	{
		$conexion = new Conexion();
		$SqlElimi = "DELETE FROM areas_oficinas 
					WHERE id_oficina = " . $this->IdOficina;
		$InstrucElimi = $conexion->prepare($SqlElimi);
		$InstrucElimi->execute() or die(print_r($InstrucElimi->errorInfo() . " - " . $SqlElimi, true));
		$conexion = null;
		echo 1;
	}

	public static function Listar($Accion, $IdOficina, $IdDepen, $CodOficina, $CodCorres, $NomOficina)
	{
		$conexion = new Conexion();

		$Sql = "SELECT areas_dependencias.id_depen, areas_dependencias.cod_depen, areas_dependencias.cod_corres AS 'cod_corres_depen', 
					areas_dependencias.nom_depen, areas_oficinas.id_oficina, areas_oficinas.cod_oficina, areas_oficinas.cod_corres, 
					areas_oficinas.nom_oficina, areas_oficinas.observa, areas_oficinas.acti
				FROM areas_oficinas
				    INNER JOIN areas_dependencias ON (areas_oficinas.id_depen = areas_dependencias.id_depen) ";

		try {

			if ($Accion == 1) {
				$Sql .= "ORDER BY areas_dependencias.nom_depen, areas_oficinas.cod_corres, areas_oficinas.nom_oficina ASC";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 2) {
				/******************************************************************************************/
				/*	LISTO UN REGISTROS
				/******************************************************************************************/
				$Sql = "SELECT * FROM areas_oficinas WHERE id_oficina = :id_oficina";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_oficina', $IdOficina, PDO::PARAM_INT);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 3) {
				/******************************************************************************************/
				/*	LISTO POR NOMBRE
				/******************************************************************************************/
				$Sql = "SELECT * FROM areas_oficinas WHERE nom_oficina = :nom_oficina AND id_depen = :id_depen";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':nom_oficina', $NomOficina, PDO::PARAM_STR);
				$Instruc->bindParam(':id_depen', $IdDepen, PDO::PARAM_INT);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 4) {
				/******************************************************************************************/
				/*	LISTO POR CODIGO DE LE OFICINA
				/******************************************************************************************/
				$Sql = "SELECT * FROM areas_oficinas WHERE cod_oficina = :cod_oficina";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':cod_oficina', $CodOficina, PDO::PARAM_STR);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 5) {
				/******************************************************************************************/
				/*	LISTO POR CODIGO DE CORRESPONENCIA
				/******************************************************************************************/
				$Sql = "SELECT * FROM areas_oficinas WHERE cod_corres = :cod_corres";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':cod_corres', $CodCorres, PDO::PARAM_STR);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 6) {
				/******************************************************************************************/
				/*
				/*	LISTO EL ULTIMO ID INSERTADO
				/*
				/******************************************************************************************/
				$Sql = "";
			} elseif ($Accion == 7) {
				/******************************************************************************************/
				/*	LISTO LA CANTIDAD DE DOCUMENTOS QUE TIENE UNA OFICINA
				/******************************************************************************************/
				$Sql = "SELECT * FROM areas_oficinas_estan WHERE id_oficina = :id_oficina";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_oficina', $IdOficina, PDO::PARAM_INT);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 8) {
				/******************************************************************************************/
				/*
				/*	LISTO LAS OFICINAS DE UNA DEPENDENCIA
				/*
				/******************************************************************************************/
				$Sql = "SELECT * FROM areas_oficinas WHERE id_depen = :id_depen ORDER BY nom_oficina, cod_corres";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_depen', $IdDepen, PDO::PARAM_INT);
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

	public static function Buscar($Accion, $IdOficina, $IdDepen, $CodOficina, $CodCorres, $NomOficina)
	{
		$conexion = new Conexion();

		try {

			$Sql = "SELECT fd.id_funcio_deta, fd.acti, Funcio.*, Depen.id_depen, Depen.cod_depen, Depen.cod_corres AS cod_corres_depen, 
						Depen.nom_depen, Ofi.id_oficina, Ofi.cod_oficina, Ofi.cod_corres AS cod_corres_ofi, Ofi.nom_oficina, 
						Cargo.id_cargo, Cargo.nom_cargo, fd.acti AS acti_cargo, Depar.nom_depar, Muni.nom_muni
	                FROM areas_cargos AS Cargo 
	                    INNER JOIN areas_dependencias AS Depen ON (Cargo.id_depen = Depen.id_depen) 
	                    INNER JOIN gene_funcionarios_deta AS fd ON (fd.id_cargo = Cargo.id_cargo) 
	                    INNER JOIN areas_oficinas AS Ofi ON (fd.id_oficina = Ofi.id_oficina) 
	                    INNER JOIN gene_funcionarios AS Funcio ON (fd.id_funcio = Funcio.id_funcio) 
	                    INNER JOIN config_depar AS Depar ON (Funcio.id_depar = Depar.id_depar) 
	                    INNER JOIN config_muni AS Muni ON (Funcio.id_muni = Muni.id_muni) ";

			if ($Accion == 1) {
				$Sql .= "ORDER BY areas_dependencias.nom_depen, areas_oficinas.cod_corres, areas_oficinas.nom_oficina ASC";
				$Instruc = $conexion->prepare($Sql);
			} elseif ($Accion == 2) {
				/******************************************************************************************/
				/*	LISTO UN REGISTROS
				/******************************************************************************************/
				$Sql = "SELECT * 
						FROM areas_oficinas 
						WHERE id_oficina = :id_oficina";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_oficina', $IdOficina, PDO::PARAM_INT);
			} elseif ($Accion == 3) {
				/******************************************************************************************/
				/*	LISTO POR NOMBRE
				/******************************************************************************************/
				$Sql = "SELECT * FROM areas_oficinas 
						WHERE nom_oficina = :nom_oficina AND id_depen = :id_depen";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':nom_oficina', $NomOficina, PDO::PARAM_STR);
				$Instruc->bindParam(':id_depen', $IdDepen, PDO::PARAM_INT);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 4) {
				/******************************************************************************************/
				/*	LISTO POR CODIGO DE LE OFICINA
				/******************************************************************************************/
				$Sql = "SELECT * FROM areas_oficinas 
						WHERE cod_oficina = :cod_oficina";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':cod_oficina', $CodOficina, PDO::PARAM_STR);
			} elseif ($Accion == 5) {
				/******************************************************************************************/
				/*	LISTO POR CODIGO DE CORRESPONENCIA
				/******************************************************************************************/
				$Sql = "SELECT * FROM areas_oficinas 
						WHERE cod_corres = :cod_corres";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':cod_corres', $CodCorres, PDO::PARAM_STR);
			} elseif ($Accion == 6) {
				/******************************************************************************************/
				/*
				/*	LISTO EL ULTIMO ID INSERTADO
				/*
				/******************************************************************************************/
				$Sql = "";
			} elseif ($Accion == 7) {
				/******************************************************************************************/
				/*	LISTO LA CANTIDAD DE DOCUMENTOS QUE TIENE UNA OFICINA
				/******************************************************************************************/
				$Sql = "SELECT * FROM areas_oficinas_estan 
						WHERE id_oficina = :id_oficina";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_oficina', $IdOficina, PDO::PARAM_INT);
			} elseif ($Accion == 8) {
				/******************************************************************************************/
				/*
				/*	LISTO LAS OFICINAS DE UNA DEPENDENCIA
				/*
				/******************************************************************************************/
				$Sql = "SELECT * FROM areas_oficinas 
						WHERE id_depen = :id_depen";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_depen', $IdDepen, PDO::PARAM_INT);
			}

			$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			$Result = $Instruc->fetch();
			$conexion = null;

			if ($Result) {
				return new self(
					"",
					$Result['id_oficina'],
					$Result['id_depen'],
					$Result['cod_oficina'],
					$Result['cod_corres'],
					$Result['nom_oficina'],
					$Result['observa'],
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
