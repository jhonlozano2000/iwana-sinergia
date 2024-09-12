<?php
class Usuario
{

	//Atributos
	private $Accion;
	private $IdUsua;
	private $IdFuncio;
	private $NumDocu;
	private $NomFuncio;
	private $ApeFuncio;
	private $Login;
	private $Contra;
	private $CambioContra;
	private $Acti;

	public function __construct(
		$Accion = null,
		$IdUsua = null,
		$IdFuncio = null,
		$NumDocu = null,
		$NomFuncio = null,
		$ApeFuncio = null,
		$Login = null,
		$Contra = null,
		$CambioContra = null,
		$Acti = null
	) {

		$this->Accion       = $Accion;
		$this->IdUsua       = $IdUsua;
		$this->IdFuncio      = $IdFuncio;
		$this->NumDocu      = $NumDocu;
		$this->NomFuncio    = $NomFuncio;
		$this->ApeFuncio    = $ApeFuncio;
		$this->Login        = $Login;
		$this->Contra       = $Contra;
		$this->CambioContra = $CambioContra;
		$this->Acti         = $Acti;
	}

	public function getId_Usua()
	{
		return $this->IdUsua;
	}

	public function getId_Funcio()
	{
		return $this->IdFuncio;
	}

	public function getNum_Docu()
	{
		return $this->NumDocu;
	}

	public function getNom_Funcio()
	{
		return $this->NomFuncio;
	}

	public function getApe_Funcio()
	{
		return $this->ApeFuncio;
	}

	public function getLogin()
	{
		return $this->Login;
	}

	public function getContra()
	{
		return $this->Contra;
	}

	public function getCambioContra()
	{
		return $this->CambioContra;
	}

	public function getActi()
	{
		return $this->Acti;
	}

	////////////////////////////
	public function setAccion($Accion)
	{
		$this->Accion = $Accion;
	}

	public function setId_Usua($IdUsua)
	{
		$this->IdUsua = $IdUsua;
	}

	public function setId_Funcio($IdFuncio)
	{
		$this->IdFuncio = $IdFuncio;
	}

	public function setLogin($Login)
	{
		$this->Login = $Login;
	}

	public function setContra($Contra)
	{
		$this->Contra = $Contra;
	}

	public function setCambioContra($CambioContra)
	{
		$this->CambioContra = $CambioContra;
	}

	public function setActi($Acti)
	{
		$this->Acti = $Acti;
	}

	public function Gestionar()
	{
		$conexion = new Conexion();

		try {

			if ($this->Accion == 'INSERTAR') {
				$Sql = "INSERT INTO segu_usua(id_funcio, login, contra, cambio_contra)
						VALUES(:id_funcio, :login, :contra, :cambio_contra)";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_funcio', $this->IdFuncio, PDO::PARAM_INT);
				$Instruc->bindParam(':login', $this->Login, PDO::PARAM_STR);
				$Instruc->bindParam(':contra', $this->Contra, PDO::PARAM_STR);
				$Instruc->bindParam(':cambio_contra', $this->CambioContra, PDO::PARAM_STR);
			} elseif ($this->Accion == 'EDITAR') {
				if ($this->Contra != '') {
					$Sql = "UPDATE segu_usua
						SET contra = :contra, acti = :acti, cambio_contra = :cambio_contra
						WHERE id_usua = :id_usua";

					$Instruc = $conexion->prepare($Sql);
					$Instruc->bindParam(':contra', $this->Contra, PDO::PARAM_STR);
					$Instruc->bindParam(':acti', $this->Acti, PDO::PARAM_INT);
					$Instruc->bindParam(':cambio_contra', $this->CambioContra, PDO::PARAM_STR);
					$Instruc->bindParam(':id_usua', $this->IdUsua, PDO::PARAM_INT);
				} else {

					$Sql = "UPDATE segu_usua
						SET acti = :acti, cambio_contra = :cambio_contra
						WHERE id_usua = :id_usua";

					$Instruc = $conexion->prepare($Sql);
					$Instruc->bindParam(':acti', $this->Acti, PDO::PARAM_INT);
					$Instruc->bindParam(':cambio_contra', $this->CambioContra, PDO::PARAM_STR);
					$Instruc->bindParam(':id_usua', $this->IdUsua, PDO::PARAM_INT);
				}
			} elseif ($this->Accion == 'Eliminar') {
				$Sql = "DELETE FROM segu_usua
						WHERE id_usua = :id_usua";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_usua', $this->IdUsua, PDO::PARAM_INT);
			} elseif ($this->Accion == 'ACTUALIZA_CONTRA') {
				$Sql = "UPDATE segu_usua
						SET contra = :contra, cambio_contra = :cambio_contra
						WHERE id_usua = :id_usua";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':contra', $this->Contra, PDO::PARAM_STR);
				$Instruc->bindParam(':cambio_contra', $this->CambioContra, PDO::PARAM_STR);
				$Instruc->bindParam(':id_usua', $this->IdUsua, PDO::PARAM_INT);
			} elseif ($this->Accion == 'ACTIVAR') {
				$Sql = "UPDATE segu_usua
						SET acti = :acti
						WHERE id_usua = :id_usua";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':acti', $this->Acti, PDO::PARAM_INT);
				$Instruc->bindParam(':id_usua', $this->IdUsua, PDO::PARAM_INT);
			}

			$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			$this->IdUsua = $conexion->lastInsertId();
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

	/******************************************************************************************/
	/*
	/*	LISTAR
	/*
	/******************************************************************************************/
	public static function Listar($Accion, $IdUsua, $Login, $Contra, $Nom, $Ape, $IdModuPadre, $IdPerfil)
	{
		$conexion = new Conexion();

		if ($Accion == 1) {
			/******************************************************************************************/
			/*	LISTO UN REGISTROS POR ID DE USUARIO
			/******************************************************************************************/
			$Sql = "SELECT DISTINCT Usua.id_usua, Funcio.id_funcio, Funcio.cod_funcio, Funcio.nom_funcio, Funcio.ape_funcio, 
						Usua.login, Usua.contra, Usua.cambio_contra, Usua.acti AS usua_acti
					FROM segu_usua AS Usua INNER JOIN gene_funcionarios AS Funcio 
	        			ON (Usua.id_funcio = Funcio.id_funcio) 
	        		WHERE Usua.id_usua = :id_usua";

			$Instruc = $conexion->prepare($Sql);
			$Instruc->bindParam(':id_usua', $IdUsua, PDO::PARAM_INT);
			$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			$Result = $Instruc->fetchAll();
		} elseif ($Accion == 2) {
			/******************************************************************************************/
			/*	LISTO UN REGISTROS POR ID FUNCIONARIO
			/******************************************************************************************/
			$Sql = "SELECT DISTINCT Usua.id_usua, Funcio.id_funcio, Funcio.cod_funcio, Funcio.nom_funcio, Funcio.ape_funcio, 
						Usua.login, Usua.contra, Usua.cambio_contra, Usua.acti AS usua_acti
					FROM segu_usua AS Usua INNER JOIN gene_funcionarios AS Funcio 
	        			ON (Usua.id_funcio = Funcio.id_funcio) 
	        		WHERE Funcio.id_funcio = :id_funcio";

			$Instruc = $conexion->prepare($Sql);
			$Instruc->bindParam(':id_funcio', $IdUsua, PDO::PARAM_INT);
			$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			$Result = $Instruc->fetchAll();
		} elseif ($Accion == 3) {
			/******************************************************************************************/
			/*	LISTO POR LOGIN
			/******************************************************************************************/
			$Sql = "SELECT DISTINCT Usua.id_usua, Funcio.id_funcio, Funcio.cod_funcio, Funcio.nom_funcio, Funcio.ape_funcio, 
						Usua.login, Usua.contra, Usua.cambio_contra, Usua.acti AS usua_acti
					FROM segu_usua AS Usua INNER JOIN gene_funcionarios AS Funcio 
	        			ON (Usua.id_funcio = Funcio.id_funcio) 
	        		WHERE Usua.login = :login AND Usua.acti = 1";

			$Instruc = $conexion->prepare($Sql);
			$Instruc->bindParam(':login', $Login, PDO::PARAM_STR);
			$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			$Result = $Instruc->fetchAll();
		} elseif ($Accion == 4) {
			/******************************************************************************************/
			/*	FILTRO PARA TODOS LOS USUARIOS
			/******************************************************************************************/
			$Sql = "SELECT DISTINCT Usua.id_usua, Funcio.id_funcio, Funcio.cod_funcio, Funcio.nom_funcio, Funcio.ape_funcio, 
						Usua.login, Usua.contra, Usua.cambio_contra, Usua.acti AS usua_acti
					FROM segu_usua AS Usua INNER JOIN gene_funcionarios AS Funcio 
	        			ON (Usua.id_funcio = Funcio.id_funcio) 
	        		ORDER BY Usua.login, Funcio.nom_funcio, Funcio.ape_funcio ASC";

			$Instruc = $conexion->prepare($Sql);
			$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			$Result = $Instruc->fetchAll();
		} elseif ($Accion == 6) {
			/******************************************************************************************/
			/*	LISTO POR LOGIN Y CONTRASEÑA
			/******************************************************************************************/
			$Sql = "SELECT Usua.id_usua, Usua.login, Usua.contra, Usua.acti AS usua_acti, Usua.cambio_contra, FuncioDeta.id_funcio_deta, Funcio.id_funcio,
						Funcio.cod_funcio, Funcio.nom_funcio, Funcio.ape_funcio, Funcio.jefe_dependencia, Funcio.jefe_oficina, Funcio.propie_princi,
						Funcio.crea_expedien, Funcio.puede_firmar, Funcio.genero, Depen.id_depen, Depen.cod_depen, Depen.cod_corres, Depen.nom_depen,
						ofi.id_oficina, ofi.cod_corres, ofi.cod_oficina, ofi.nom_oficina, Cargos.id_cargo, Cargos.nom_cargo, Funcio.firma, Funcio.foto
					FROM segu_usua AS Usua
						LEFT JOIN gene_funcionarios AS Funcio ON (Usua.id_funcio = Funcio.id_funcio)
						LEFT JOIN gene_funcionarios_deta AS FuncioDeta ON (FuncioDeta.id_funcio = Funcio.id_funcio)
						LEFT JOIN areas_oficinas AS ofi ON (FuncioDeta.id_oficina = ofi.id_oficina)
						LEFT JOIN areas_cargos AS Cargos ON (FuncioDeta.id_cargo = Cargos.id_cargo)
						LEFT JOIN areas_dependencias AS Depen ON (ofi.id_depen = Depen.id_depen)
					WHERE Usua.login = :login AND FuncioDeta.acti = 1";

			$Instruc = $conexion->prepare($Sql);
			$Instruc->bindParam(':login', $Login, PDO::PARAM_STR);
			$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			$Result = $Instruc->fetchAll();
		} elseif ($Accion == 8) {
			/******************************************************************************************/
			/*	LISTO LOS PERFILES DE UN USUARIO
			/******************************************************************************************/
			$Sql = "SELECT DISTINCT segu_modu.menu
					FROM segu_usuadeta
					    INNER JOIN segu_usua AS Usua ON (segu_usuadeta.id_usua = Usua.id_usua)
					    LEFT JOIN gene_funcionarios AS Funcio ON (Usua.id_funcio = Funcio.id_funcio)
					    INNER JOIN segu_perfiles ON (segu_usuadeta.id_perfil = segu_perfiles.id_perfil)
					    INNER JOIN segu_perfiles_deta ON (segu_perfiles_deta.id_perfil = segu_perfiles.id_perfil)
					    INNER JOIN segu_modu ON (segu_perfiles_deta.id_modu = segu_modu.id_modu)
					    LEFT JOIN gene_funcionarios_deta AS FuncioDeta ON (FuncioDeta.id_funcio = Funcio.id_funcio)
					    LEFT JOIN areas_oficinas AS ofi ON (FuncioDeta.id_oficina = ofi.id_oficina)
					    LEFT JOIN areas_cargos AS Cargos ON (FuncioDeta.id_cargo = Cargos.id_cargo)
					    LEFT JOIN areas_dependencias AS Depen ON (ofi.id_depen = Depen.id_depen)
					WHERE Usua.id_usua = :id_usua AND segu_modu.acti = 1";

			$Instruc = $conexion->prepare($Sql);
			$Instruc->bindParam(':id_usua', $IdUsua, PDO::PARAM_INT);
			$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			$Result = $Instruc->fetchAll(PDO::FETCH_COLUMN, 0);
		} elseif ($Accion == 9) {
			/******************************************************************************************/
			/*	LISTO LOS PERFILES DE UN USUARIO
			/******************************************************************************************/
			$Sql = "SELECT Usua.id_usua, Usua.login, Usua.contra, Usua.acti AS usua_acti, Usua.cambio_contra, FuncioDeta.id_funcio_deta, 
					Funcio.id_funcio, Funcio.cod_funcio, Funcio.nom_funcio, Funcio.ape_funcio, Funcio.jefe_dependencia, Funcio.jefe_oficina, 
					Funcio.propie_princi, Funcio.crea_expedien, Funcio.puede_firmar, Funcio.genero, Depen.id_depen, Depen.cod_depen, 
					Depen.cod_corres, Depen.nom_depen, ofi.id_oficina, ofi.cod_corres, ofi.cod_oficina, ofi.nom_oficina, Cargos.id_cargo, 
					Cargos.nom_cargo, segu_perfiles.id_perfil, segu_perfiles.nom_perfil, segu_perfiles.acti AS perfil_acti, 
					segu_perfiles_deta.acti AS acti_perfil, segu_modu.id_modu, segu_modu.modu_padre, segu_modu.nom_modu, segu_modu.menu, 
					segu_modu.boton, segu_modu.acti AS acti_menu
				FROM segu_usuadeta
				    INNER JOIN segu_usua AS Usua ON (segu_usuadeta.id_usua = Usua.id_usua)
				    LEFT JOIN gene_funcionarios AS Funcio ON (Usua.id_funcio = Funcio.id_funcio)
				    INNER JOIN segu_perfiles ON (segu_usuadeta.id_perfil = segu_perfiles.id_perfil)
				    INNER JOIN segu_perfiles_deta ON (segu_perfiles_deta.id_perfil = segu_perfiles.id_perfil)
				    INNER JOIN segu_modu ON (segu_perfiles_deta.id_modu = segu_modu.id_modu)
				    LEFT JOIN gene_funcionarios_deta AS FuncioDeta ON (FuncioDeta.id_funcio = Funcio.id_funcio)
				    LEFT JOIN areas_oficinas AS ofi ON (FuncioDeta.id_oficina = ofi.id_oficina)
				    LEFT JOIN areas_cargos AS Cargos ON (FuncioDeta.id_cargo = Cargos.id_cargo)
				    LEFT JOIN areas_dependencias AS Depen ON (ofi.id_depen = Depen.id_depen) 
				WHERE Usua.id_usua = :id_usua AND  segu_perfiles.id_perfil = :id_perfil";

			$Instruc = $conexion->prepare($Sql);
			$Instruc->bindParam(':id_usua', $IdUsua, PDO::PARAM_INT);
			$Instruc->bindParam(':id_perfil', $IdPerfil, PDO::PARAM_INT);
			$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			$Result = $Instruc->fetchAll();
		} elseif ($Accion == 10) {
			/******************************************************************************************/
			/*	LISTO TODOS LOS USUARIOS DEL SISTEMA ESPECIFICADO SI INICIARON SESION
			/*  ESTE LISTADO ES PARA EL CHAT
			/******************************************************************************************/
			$Sql = "SELECT `usua`.`id_usua`, `funcio`.`nom_funcio`, `funcio`.`ape_funcio`, `funcio`.`foto`, `funcio`.`genero`
				    , CASE WHEN (SELECT id_sesion FROM segu_sesiones WHERE id_usua = `usua`.`id_usua`) IS NOT NULL THEN 1 ELSE 0 END AS 'sesion_activa'
				FROM `segu_usua` AS `usua`
				    INNER JOIN `gene_funcionarios` AS `funcio` ON (`usua`.`id_funcio` = `funcio`.`id_funcio`)
				WHERE (`usua`.`acti` = 1 AND `funcio`.`acti` = 1 AND `usua`.`id_usua` <> :id_usua)";

			$Instruc = $conexion->prepare($Sql);
			$Instruc->bindParam(':id_usua', $IdUsua, PDO::PARAM_INT);
			$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			$Result = $Instruc->fetchAll();
		}



		$conexion = null;
		return $Result;
	}

	/******************************************************************************************/
	/*
	/*	BUSCAR
	/*
	/******************************************************************************************/
	public static function Buscar($Accion, $IdUsua, $Login, $Contra, $Nom, $Ape, $IdModuPadre, $IdPerfil)
	{
		$conexion = new Conexion();

		try {
			if ($Accion == 1) {
				/******************************************************************************************/
				/*	LISTO UN REGISTROS
				/******************************************************************************************/
				$Sql = "SELECT DISTINCT Usua.id_usua, Funcio.id_funcio, Funcio.cod_funcio, Funcio.nom_funcio, Funcio.ape_funcio, 
							Usua.login, Usua.contra, Usua.cambio_contra, Usua.acti AS usua_acti
					FROM segu_usua AS Usua INNER JOIN gene_funcionarios AS Funcio 
	        			ON (Usua.id_funcio = Funcio.id_funcio) 
	        		WHERE Usua.id_usua = :id_usua";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_usua', $IdUsua, PDO::PARAM_INT);
			} elseif ($Accion == 2) {
				/******************************************************************************************/
				/*	LISTO UN REGISTROS POR ID FUNCIONARIO
				/******************************************************************************************/
				$Sql = "SELECT DISTINCT Usua.id_usua, Funcio.id_funcio, Funcio.cod_funcio, Funcio.nom_funcio, Funcio.ape_funcio, 
							Usua.login, Usua.contra, Usua.cambio_contra, Usua.acti AS usua_acti
						FROM segu_usua AS Usua INNER JOIN gene_funcionarios AS Funcio 
		        			ON (Usua.id_funcio = Funcio.id_funcio) 
		        		WHERE Funcio.id_funcio = :id_funcio";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_funcio', $IdUsua, PDO::PARAM_STR);
			} elseif ($Accion == 3) {
				/******************************************************************************************/
				/*	LISTO POR LOGIN
				/******************************************************************************************/
				$Sql = "SELECT DISTINCT Usua.id_usua, Funcio.id_funcio, Funcio.cod_funcio, Funcio.nom_funcio, Funcio.ape_funcio, 
							Usua.login, Usua.contra, Usua.cambio_contra, Usua.acti AS usua_acti
						FROM segu_usua AS Usua INNER JOIN gene_funcionarios AS Funcio 
		        			ON (Usua.id_funcio = Funcio.id_funcio) 
		        		WHERE Usua.login = :login";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':login', $Login, PDO::PARAM_STR);
			} elseif ($Accion == 9) {
				/******************************************************************************************/
				/*	LISTO LOS PERFILES DE UN USUARIO
				/******************************************************************************************/
				$Sql = "SELECT Usua.id_usua, Usua.login, Usua.contra, Usua.acti AS usua_acti, Usua.cambio_contra, FuncioDeta.id_funcio_deta, 
						Funcio.id_funcio, Funcio.cod_funcio, Funcio.nom_funcio, Funcio.ape_funcio, Funcio.jefe_dependencia, Funcio.jefe_oficina, 
						Funcio.propie_princi, Funcio.crea_expedien, Funcio.puede_firmar, Funcio.genero, Depen.id_depen, Depen.cod_depen, 
						Depen.cod_corres, Depen.nom_depen, ofi.id_oficina, ofi.cod_corres, ofi.cod_oficina, ofi.nom_oficina, Cargos.id_cargo, 
						Cargos.nom_cargo, segu_perfiles.id_perfil, segu_perfiles.nom_perfil, segu_perfiles.acti AS perfil_acti, 
						segu_perfiles_deta.acti AS acti_perfil, segu_modu.id_modu, segu_modu.modu_padre, segu_modu.nom_modu, segu_modu.menu, 
						segu_modu.boton, segu_modu.acti AS acti_menu
					FROM segu_usuadeta
					    INNER JOIN segu_usua AS Usua ON (segu_usuadeta.id_usua = Usua.id_usua)
					    LEFT JOIN gene_funcionarios AS Funcio ON (Usua.id_funcio = Funcio.id_funcio)
					    INNER JOIN segu_perfiles ON (segu_usuadeta.id_perfil = segu_perfiles.id_perfil)
					    INNER JOIN segu_perfiles_deta ON (segu_perfiles_deta.id_perfil = segu_perfiles.id_perfil)
					    INNER JOIN segu_modu ON (segu_perfiles_deta.id_modu = segu_modu.id_modu)
					    LEFT JOIN gene_funcionarios_deta AS FuncioDeta ON (FuncioDeta.id_funcio = Funcio.id_funcio)
					    LEFT JOIN areas_oficinas AS ofi ON (FuncioDeta.id_oficina = ofi.id_oficina)
					    LEFT JOIN areas_cargos AS Cargos ON (FuncioDeta.id_cargo = Cargos.id_cargo)
					    LEFT JOIN areas_dependencias AS Depen ON (ofi.id_depen = Depen.id_depen) 
					WHERE Usua.id_usua = :id_usua AND  segu_perfiles.id_perfil = :id_perfil";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_usua', $IdUsua, PDO::PARAM_INT);
				$Instruc->bindParam(':id_perfil', $IdPerfil, PDO::PARAM_INT);
			}

			$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			$Result = $Instruc->fetch();
			$conexion = null;

			if ($Result) {
				return new self(
					"",
					$Result['id_usua'],
					$Result['id_funcio'],
					$Result['cod_funcio'],
					$Result['nom_funcio'],
					$Result['ape_funcio'],
					$Result['login'],
					$Result['contra'],
					$Result['cambio_contra'],
					$Result['usua_acti']
				);
			} else {
				return false;
			}
		} catch (PDOException $e) {
			echo 'Ha surgido un error y no se puede ejecutar la consulta.' . $e->getMessage();
			exit;
		}
	}


	public static function Gestionar_Perfiles($Accion, $IdUsua, $IdPerfil)
	{
		$conexion = new Conexion();

		if ($Accion == 1) {
			$Sql = "DELETE FROM segu_usuadeta WHERE id_usua = :id_usua";
			$Instruc = $conexion->prepare($Sql);
			$Instruc->bindParam(':id_usua', $IdUsua, PDO::PARAM_INT);
		} elseif ($Accion == 2) {
			$Sql = "INSERT INTO segu_usuadeta(id_perfil, id_usua, acti) 
					VALUES(:id_perfil, :id_usua, 1)";
			$Instruc = $conexion->prepare($Sql);
			$Instruc->bindParam(':id_perfil', $IdPerfil, PDO::PARAM_INT);
			$Instruc->bindParam(':id_usua', $IdUsua, PDO::PARAM_INT);
		}

		$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
		$Result = $Instruc->fetchAll();
		$conexion = null;
		return $Result;
	}
}
