<?php
class Funcionario
{
	private $Accion;
	private $IdFuncio;
	private $CodFuncio;
	private $NomFuncio;
	private $ApeFuncio;
	private $Genero;
	private $PropiePrinci;
	private $JefeDependenci;
	private $JefeOficina;
	private $CreaExpediente;
	private $PuedeFirmar;
	private $IdDepen;
	private $IdOfi;
	private $IdCargo;
	private $IdDepar;
	private $IdMuni;
	private $Dir;
	private $Tel;
	private $Cel;
	private $Email;
	private $Observa;
	private $Firma;
	private $Foto;
	private $Acti;

	public function __construct(
		$Accion = null,
		$IdFuncio = null,
		$CodFuncio = null,
		$NomFuncio = null,
		$ApeFuncio = null,
		$Genero = null,
		$PropiePrinci = null,
		$JefeDependenci = null,
		$JefeOficina = null,
		$CreaExpediente = null,
		$PuedeFirmar = null,
		$IdDepen = null,
		$IdOfi = null,
		$IdCargo = null,
		$IdMuni = null,
		$IdDepar = null,
		$Dir = null,
		$Tel = null,
		$Cel = null,
		$Email = null,
		$Observa = null,
		$Firma = null,
		$Foto = null,
		$Acti = null
	) {

		$this->Accion         = $Accion;
		$this->IdFuncio       = $IdFuncio;
		$this->CodFuncio      = $CodFuncio;
		$this->NomFuncio      = $NomFuncio;
		$this->ApeFuncio      = $ApeFuncio;
		$this->Genero         = $Genero;
		$this->PropiePrinci   = $PropiePrinci;
		$this->JefeDependenci = $JefeDependenci;
		$this->JefeOficina    = $JefeOficina;
		$this->CreaExpediente = $CreaExpediente;
		$this->PuedeFirmar    = $PuedeFirmar;
		$this->IdDepen        = $IdDepen;
		$this->IdOfi          = $IdOfi;
		$this->IdCargo        = $IdCargo;
		$this->IdDepar        = $IdDepar;
		$this->IdMuni         = $IdMuni;
		$this->Dir            = $Dir;
		$this->Tel            = $Tel;
		$this->Cel            = $Cel;
		$this->Email          = $Email;
		$this->Observa        = $Observa;
		$this->Firma          = $Firma;
		$this->Foto           = $Foto;
		$this->Acti           = $Acti;
	}

	public function getId_Funcio()
	{
		return $this->IdFuncio;
	}

	public function getCod_Funcio()
	{
		return $this->CodFuncio;
	}

	public function getNom_Funcio()
	{
		return $this->NomFuncio;
	}

	public function getApe_Funcio()
	{
		return $this->ApeFuncio;
	}

	public function getGenero()
	{
		return $this->Genero;
	}

	public function getPropiePrinci()
	{
		return $this->PropiePrinci;
	}

	public function getJefeDependenci()
	{
		return $this->JefeDependenci;
	}

	public function getJefeOficina()
	{
		return $this->JefeOficina;
	}

	public function getCreaExpediente()
	{
		return $this->CreaExpediente;
	}

	public function getPuedeFirmar()
	{
		return $this->PuedeFirmar;
	}

	public function getId_Depen()
	{
		return $this->IdDepen;
	}

	public function getId_Ofi()
	{
		return $this->IdOfi;
	}

	public function getId_Cargo()
	{
		return $this->IdCargo;
	}

	public function getId_Depar()
	{
		return $this->IdDepar;
	}

	public function getId_Muni()
	{
		return $this->IdMuni;
	}

	public function getDir()
	{
		return $this->Dir;
	}

	public function getTel()
	{
		return $this->Tel;
	}

	public function getCel()
	{
		return $this->Cel;
	}

	public function getEmail()
	{
		return $this->Email;
	}

	public function getObserva()
	{
		return $this->Observa;
	}

	public function getFirma()
	{
		return $this->Firma;
	}

	public function getFoto()
	{
		return $this->Foto;
	}

	public function getActi()
	{
		return $this->Acti;
	}

	public function setAccion($Accion)
	{
		return $this->Accion = $Accion;
	}

	public function setId_Funcio($IdFuncio)
	{
		return $this->IdFuncio = $IdFuncio;
	}

	public function setCod_Funcio($CodFuncio)
	{
		return $this->CodFuncio = $CodFuncio;
	}

	public function setNom_Funcio($NomFuncio)
	{
		return $this->NomFuncio = $NomFuncio;
	}

	public function setApe_Funcio($ApeFuncio)
	{
		return $this->ApeFuncio = $ApeFuncio;
	}

	public function setGenero($Genero)
	{
		return $this->Genero = $Genero;
	}

	public function setPropiePrinci($PropiePrinci)
	{
		return $this->PropiePrinci = $PropiePrinci;
	}

	public function setJefeDependenci($JefeDependenci)
	{
		return $this->JefeDependenci = $JefeDependenci;
	}

	public function setJefeOficina($JefeOficina)
	{
		return $this->JefeOficina = $JefeOficina;
	}

	public function setCreaExpediente($CreaExpediente)
	{
		return $this->CreaExpediente = $CreaExpediente;
	}

	public function setPuedeFirmar($PuedeFirmar)
	{
		return $this->PuedeFirmar = $PuedeFirmar;
	}

	public function setId_Depen($IdDepen)
	{
		return $this->IdDepen = $IdDepen;
	}

	public function setId_Ofi($IdOfi)
	{
		return $this->IdOfi = $IdOfi;
	}

	public function setId_Cargo($IdCargo)
	{
		return $this->IdCargo = $IdCargo;
	}

	public function setId_Depar($IdDepar)
	{
		return $this->IdDepar = $IdDepar;
	}

	public function setId_Muni($IdMuni)
	{
		return $this->IdMuni = $IdMuni;
	}

	public function setDir($Dir)
	{
		return $this->Dir = $Dir;
	}

	public function setTel($Tel)
	{
		return $this->Tel = $Tel;
	}

	public function setCel($Cel)
	{
		return $this->Cel = $Cel;
	}

	public function setEmail($Email)
	{
		return $this->Email = $Email;
	}

	public function setObserva($Observa)
	{
		return $this->Observa = $Observa;
	}

	public function setFirma($Firma)
	{
		return $this->Firma = $Firma;
	}

	public function setFoto($Foto)
	{
		return $this->Foto = $Foto;
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
				$Sql = "INSERT INTO gene_funcionarios(id_muni, id_depar, jefe_dependencia, jefe_oficina, crea_expedien, puede_firmar, propie_princi, cod_funcio, 
									nom_funcio, ape_funcio, genero, dir, tel, cel, email) 
						VALUES(:id_muni, :id_depar, :jefe_dependencia, :jefe_oficina, :crea_expedien, :puede_firmar, :propie_princi, :cod_funcio, 
									:nom_funcio, :ape_funcio, :genero, :dir, :tel, :cel, :email)";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_muni', $this->IdMuni, PDO::PARAM_INT);
				$Instruc->bindParam(':id_depar', $this->IdDepar, PDO::PARAM_INT);
				$Instruc->bindParam(':jefe_dependencia', $this->JefeDependenci, PDO::PARAM_INT);
				$Instruc->bindParam(':jefe_oficina', $this->JefeOficina, PDO::PARAM_INT);
				$Instruc->bindParam(':crea_expedien', $this->CreaExpediente, PDO::PARAM_INT);
				$Instruc->bindParam(':puede_firmar', $this->PuedeFirmar, PDO::PARAM_INT);
				$Instruc->bindParam(':propie_princi', $this->PropiePrinci, PDO::PARAM_INT);
				$Instruc->bindParam(':cod_funcio', $this->CodFuncio, PDO::PARAM_STR);
				$Instruc->bindParam(':nom_funcio', $this->NomFuncio, PDO::PARAM_STR);
				$Instruc->bindParam(':ape_funcio', $this->ApeFuncio, PDO::PARAM_STR);
				$Instruc->bindParam(':genero', $this->Genero, PDO::PARAM_STR);
				$Instruc->bindParam(':dir', $this->Dir, PDO::PARAM_STR);
				$Instruc->bindParam(':tel', $this->Tel, PDO::PARAM_STR);
				$Instruc->bindParam(':cel', $this->Cel, PDO::PARAM_STR);
				$Instruc->bindParam(':email', $this->Email, PDO::PARAM_STR);
			} elseif ($this->Accion == 'EDITAR') {
				$Sql = "UPDATE gene_funcionarios SET id_muni = :id_muni, id_depar = :id_depar, jefe_dependencia = :jefe_dependencia,
							jefe_oficina = :jefe_oficina, crea_expedien = :crea_expedien, puede_firmar = :puede_firmar, propie_princi = :propie_princi, 
							cod_funcio = :cod_funcio, nom_funcio = :nom_funcio, ape_funcio = :ape_funcio,  genero = :genero, dir = :dir, tel = :tel, 
							cel = :cel, email = :email, acti = :acti
						WHERE id_funcio = :id_funcio";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_muni', $this->IdMuni, PDO::PARAM_INT);
				$Instruc->bindParam(':id_depar', $this->IdDepar, PDO::PARAM_INT);
				$Instruc->bindParam(':jefe_dependencia', $this->JefeDependenci, PDO::PARAM_INT);
				$Instruc->bindParam(':jefe_oficina', $this->JefeOficina, PDO::PARAM_INT);
				$Instruc->bindParam(':crea_expedien', $this->CreaExpediente, PDO::PARAM_INT);
				$Instruc->bindParam(':puede_firmar', $this->PuedeFirmar, PDO::PARAM_INT);
				$Instruc->bindParam(':propie_princi', $this->PropiePrinci, PDO::PARAM_INT);
				$Instruc->bindParam(':cod_funcio', $this->CodFuncio, PDO::PARAM_STR);
				$Instruc->bindParam(':nom_funcio', $this->NomFuncio, PDO::PARAM_STR);
				$Instruc->bindParam(':ape_funcio', $this->ApeFuncio, PDO::PARAM_STR);
				$Instruc->bindParam(':genero', $this->Genero, PDO::PARAM_STR);
				$Instruc->bindParam(':dir', $this->Dir, PDO::PARAM_STR);
				$Instruc->bindParam(':tel', $this->Tel, PDO::PARAM_STR);
				$Instruc->bindParam(':cel', $this->Cel, PDO::PARAM_STR);
				$Instruc->bindParam(':email', $this->Email, PDO::PARAM_STR);
				$Instruc->bindParam(':acti', $this->Acti, PDO::PARAM_STR);
				$Instruc->bindParam(':id_funcio', $this->IdFuncio, PDO::PARAM_INT);
			} elseif ($this->Accion == 'ACTUALIZAR_PERFIL') {
				$Sql = "UPDATE gene_funcionarios SET id_muni = :id_muni, id_depar = :id_depar, cod_funcio = :cod_funcio, nom_funcio = :nom_funcio, ape_funcio = :ape_funcio,  genero = :genero, dir = :dir, tel = :tel, 
							cel = :cel, email = :email
						WHERE id_funcio = :id_funcio";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_muni', $this->IdMuni, PDO::PARAM_INT);
				$Instruc->bindParam(':id_depar', $this->IdDepar, PDO::PARAM_INT);
				$Instruc->bindParam(':cod_funcio', $this->CodFuncio, PDO::PARAM_STR);
				$Instruc->bindParam(':nom_funcio', $this->NomFuncio, PDO::PARAM_STR);
				$Instruc->bindParam(':ape_funcio', $this->ApeFuncio, PDO::PARAM_STR);
				$Instruc->bindParam(':genero', $this->Genero, PDO::PARAM_STR);
				$Instruc->bindParam(':dir', $this->Dir, PDO::PARAM_STR);
				$Instruc->bindParam(':tel', $this->Tel, PDO::PARAM_STR);
				$Instruc->bindParam(':cel', $this->Cel, PDO::PARAM_STR);
				$Instruc->bindParam(':email', $this->Email, PDO::PARAM_STR);
				$Instruc->bindParam(':id_funcio', $this->IdFuncio, PDO::PARAM_INT);
			} elseif ($this->Accion == 'ELIMINAR') {
				$Sql = "DELETE FROM gene_funcionarios 
						WHERE id_funcio = :id_funcio";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_funcio', $this->IdFuncio, PDO::PARAM_INT);
			} elseif ($this->Accion == 'ACTIVAR_INACTIVAR') {
				$Sql = "UPDATE gene_funcionarios 
						SET acti = :acti
						WHERE id_funcio = :id_funcio";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':acti', $this->Acti, PDO::PARAM_INT);
				$Instruc->bindParam(':id_funcio', $this->IdFuncio, PDO::PARAM_INT);
			} elseif ($this->Accion == 'ACTUALIZAR_IMAGEN_PERFIL') {
				$Sql = "UPDATE gene_funcionarios 
						SET foto = :foto
						WHERE id_funcio = :id_funcio";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':foto', $this->Foto, PDO::PARAM_STR);
				$Instruc->bindParam(':id_funcio', $this->IdFuncio, PDO::PARAM_INT);
			} elseif ($this->Accion == 'ACTUALIZAR_IMAGEN_FIRMA') {
				$Sql = "UPDATE gene_funcionarios 
						SET firma = :firma
						WHERE id_funcio = :id_funcio";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':firma', $this->Firma, PDO::PARAM_STR);
				$Instruc->bindParam(':id_funcio', $this->IdFuncio, PDO::PARAM_INT);
			}

			$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			$this->IdFuncio = $conexion->lastInsertId();
			$conexion = null;

			if ($Instruc) {
				return true;
			} else {
				return false;
			}
		} catch (PDOException $e) {
			echo 'Ha surgido un error y no se puede ejecutar la consulta, Gestionar Funcionarios.' . $e->getMessage();
			exit;
		}
	}

	public static function Listar($Accion, $IdFuncio, $CodFuncio, $NomFuncio, $ApeFuncio, $IdDepen, $IdOfi, $IdCargo)
	{
		$conexion = new Conexion();

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
		try {

			if ($Accion == 1) {
				$Sql .= "ORDER BY Depen.nom_depen, Funcio.nom_funcio, Funcio.ape_funcio ASC";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 2) {
				/******************************************************************************************/
				/*  LISTO UN POR ID DEL DETALLE DEL FUNCIONARIO
	            /******************************************************************************************/
				$Sql .= "WHERE fd.id_funcio_deta = :id_funcio_deta";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_funcio_deta', $IdFuncio, PDO::PARAM_INT);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 3) {
				/******************************************************************************************/
				/*  LISTO POR NOMBRE
	            /******************************************************************************************/
				$Sql .= "WHERE Funcio.nom_funcio = ? AND Funcio.ape_funcio = ?";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->execute(array('%' . $NomFuncio . '%', '%' . $ApeFuncio . '%')) or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 4) {
				/******************************************************************************************/
				/*  LISTO POR CÓDIGO O CEDULA
	            /******************************************************************************************/
				$Sql .= "WHERE Funcio.cod_funcio = :cod_funcio";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':cod_funcio', $CodFuncio, PDO::PARAM_STR);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 5) {
				/******************************************************************************************/
				/*  SABER SI EL FUNCIONARIO ACTUAL ES EL JEFE DE AREA EN UNA DEPENDENCIA
	            /******************************************************************************************/
				$Sql .= "WHERE Funcio.jefe_dependencia = 1 OR Funcio.jefe_oficina = 1 AND Funcio.id_depen = :id_depen AND Funcio.id_funcio <> :id_funcio";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_depen', $IdDepen, PDO::PARAM_INT);
				$Instruc->bindParam(':id_funcio', $IdFuncio, PDO::PARAM_INT);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 6) {
				/******************************************************************************************/
				/*  Lista todos los empleados activos de la entidad con la dependencia Y el cargo perteneciente
	            /*  esto es para cuando se va a enviar correspondencia entre dependencias
	            /******************************************************************************************/
				$Sql .= "WHERE fd.acti = 1 AND Funcio.acti = 1
	                    ORDER BY Depen.nom_depen, Funcio.nom_funcio, Funcio.ape_funcio ASC";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 9) {
				/******************************************************************************************/
				/*  BUSCO LA OFICINA Y CARGO DE UN FUNCIONARIO
	            /******************************************************************************************/
				$Sql .= "WHERE Funcio.id_funcio = :id_funcio AND fd.id_oficina = :id_oficina AND fd.id_cargo = :id_cargo";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_funcio', $IdFuncio, PDO::PARAM_INT);
				$Instruc->bindParam(':id_oficina', $IdOfi, PDO::PARAM_INT);
				$Instruc->bindParam(':id_cargo', $IdCargo, PDO::PARAM_INT);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 10) {
				/******************************************************************************************/
				/*  SABER SI UN FUNCIONARIO YA TIENE FIRMA
	            /******************************************************************************************/
				$Sql .= "WHERE id_funcio = :id_funcio AND firma IS NULL;";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_funcio', $IdFuncio, PDO::PARAM_INT);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 12) {
				/******************************************************************************************/
				/*  LISTO LOS FUNCIONARIOS QUE PUEDEN FIRMAR
	            /******************************************************************************************/
				$Sql .= "WHERE Funcio.id_funcio IN(SELECT id_funcio FROM gene_funcionarios WHERE acti = 1 AND puede_firmar = 1 OR jefe_dependencia = 1)
	                        AND fd.acti = 1
	                    ORDER BY Depen.nom_depen, Funcio.nom_funcio, Funcio.ape_funcio ASC";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 13) {
				/******************************************************************************************/
				/*  LISTO EL PROPIETARIO PRINCIPAL DE LA INSTITUCION
	            /******************************************************************************************/
				$Sql .= "WHERE Funcio.acti = 1 AND Funcio.propie_princi = 1 
	                    ORDER BY Depen.nom_depen, Funcio.nom_funcio, Funcio.ape_funcio ASC";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 15) {
				/******************************************************************************************/
				/*  LISTO UN FUNCIONARIO POR ID
	            /******************************************************************************************/
				$Sql .= "WHERE Funcio.id_funcio = :id_funcio";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_funcio', $IdFuncio, PDO::PARAM_INT);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 16) {
				/******************************************************************************************/
				/*  SABER SI EXISTE UN FUNCIONARIO PRINCIPAL DE TODA LA ENTIDAD
	            /******************************************************************************************/
				$Query = "WHERE Funcio.propie_princi = 1";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 17) {
				/******************************************************************************************/
				/*  LISTO LOS FUNCIONARIOS ACTIVOS DE UNA DEPENDENCIA
	            /******************************************************************************************/
				$Sql .= "WHERE Depen.id_depen = :id_depen AND fd.acti = 1";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_depen', $IdDepen, PDO::PARAM_INT);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 18) {

				/******************************************************************************************/
				/*  LISTO LOS LOS DATOS DEL FUNCIONARIO QUE TENGA ACTIVO EL CARGO
	            /******************************************************************************************/
				$Sql = "SELECT `funcio_deta`.`id_funcio_deta`, `funcio_deta`.`id_funcio`
						    , cod_funcio, nom_funcio, ape_funcio, `depen`.`id_depen`
						    , `depen`.`cod_depen`, `depen`.`cod_corres`, `depen`.`nom_depen`
						FROM `gene_funcionarios_deta` AS `funcio_deta`
						    INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`)
						    INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
						    INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
						WHERE (`funcio_deta`.`id_funcio_deta` = :id_funcio_deta AND `funcio_deta`.`acti` = 1)";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_funcio_deta', $IdFuncio, PDO::PARAM_INT);
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

	public static function Buscar($Accion, $IdFuncio, $CodFuncio, $NomFuncio, $ApeFuncio, $IdDepen, $IdOfi, $IdCargo)
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
				$Sql .= "ORDER BY Depen.nom_depen, Funcio.nom_funcio, Funcio.ape_funcio ASC";
				$Instruc = $conexion->prepare($Sql);
			} elseif ($Accion == 2) {
				/******************************************************************************************/
				/*
	            /*  LISTO UN REGISTROS
	            /*
	            /******************************************************************************************/
				$Sql .= "WHERE fd.id_funcio_deta = :id_funcio_deta";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_funcio_deta', $IdFuncio, PDO::PARAM_INT);
			} elseif ($Accion == 3) {
				/******************************************************************************************/
				/*
	            /*  LISTO POR NOMBRE
	            /*
	            /******************************************************************************************/
				$Sql .= "WHERE Funcio.nom_funcio = :nom_funcio AND Funcio.ape_funcio = :ape_funcio";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':nom_funcio', $NomFuncio, PDO::PARAM_STR);
				$Instruc->bindParam(':ape_funcio', $ApeFuncio, PDO::PARAM_STR);
			} elseif ($Accion == 4) {
				/******************************************************************************************/
				/*
	            /*  LISTO POR CÓDIGO O CEDULA
	            /*
	            /******************************************************************************************/
				$Sql .= "WHERE Funcio.cod_funcio = :cod_funcio";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':cod_funcio', $CodFuncio, PDO::PARAM_STR);
			} elseif ($Accion == 5) {
				/******************************************************************************************/
				/*
	            /*  SABER SI EL FUNCIONARIO ACTUAL ES EL JEFE DE AREA EN UNA DEPENDENCIA
	            /*
	            /******************************************************************************************/
				$Sql .= "WHERE Funcio.jefe_dependencia = 1 OR Funcio.jefe_oficina = 1 AND Depen.id_depen = :id_depen AND Funcio.id_funcio <> :id_funcio";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_depen', $IdDepen, PDO::PARAM_INT);
				$Instruc->bindParam(':id_funcio', $IdFuncio, PDO::PARAM_INT);
			} elseif ($Accion == 6) {
				/******************************************************************************************/
				/*
	            /*  Lista todos los empleados activos de la entidad con la dependencia Y el cargo perteneciente
	            /*  esto es para cuando se va a enviar correspondencia entre dependencias
	            /*
	            /******************************************************************************************/
				$Sql .= "WHERE fd.acti = 1
	                    ORDER BY Depen.nom_depen, Funcio.nom_funcio, Funcio.ape_funcio ASC";
				$Instruc = $conexion->prepare($Sql);
			} elseif ($Accion == 7) {
				/******************************************************************************************/
				/*	 BUSCO SI EXISTE UN FUNCIONARIO JEFE DE OFICINA DIFERENTA AL USUARIO ACTUA
	            /******************************************************************************************/
				$Sql .= "WHERE Funcio.jefe_oficina = 1 AND Funcio.id_funcio <> :id_funcio";
				echo $IdFuncio;
				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_funcio', $IdFuncio, PDO::PARAM_INT);
			} elseif ($Accion == 9) {
				/******************************************************************************************/
				/*
	            /*  BUSCO LA OFICINA Y CARGO DE UN FUNCIONARIO
	            /*
	            /******************************************************************************************/
				$Sql .= "WHERE Funcio.id_funcio = :id_funcio AND fd.id_oficina = :id_oficina AND fd.id_cargo = :id_cargo";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_funcio', $IdFuncio, PDO::PARAM_INT);
				$Instruc->bindParam(':id_oficina', $IdOfi, PDO::PARAM_INT);
				$Instruc->bindParam(':id_cargo', $IdCargo, PDO::PARAM_INT);
			} elseif ($Accion == 10) {
				/******************************************************************************************/
				/*
	            /*  SABER SI UN FUNCIONARIO YA TIENE FIRMA
	            /*
	            /******************************************************************************************/
				$Sql .= "WHERE id_funcio = p_Id AND firma IS NULL;";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_funcio', $IdFuncio, PDO::PARAM_INT);
			} elseif ($Accion == 12) {
				/******************************************************************************************/
				/*
	            /*  LISTO LOS FUNCIONARIOS QUE PUEDEN FIRMAR
	            /*
	            /******************************************************************************************/
				$Sql .= "WHERE Funcio.id_funcio IN(SELECT id_funcio FROM gene_funcionarios WHERE acti = 1 AND puede_firmar = 1 OR jefe_dependencia = 1)
	                        AND fd.acti = 1
	                    ORDER BY Depen.nom_depen, Funcio.nom_funcio, Funcio.ape_funcio ASC";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_funcio', $IdFuncio, PDO::PARAM_INT);
			} elseif ($Accion == 13) {
				/******************************************************************************************/
				/*  BUSCO SI EXISTE FUNCIONARIO PRINCIPAL DE LA INSTITUCION
	            /******************************************************************************************/
				$Sql .= "WHERE Funcio.acti = 1 AND Funcio.propie_princi = 1 
	                    ORDER BY Depen.nom_depen, Funcio.nom_funcio, Funcio.ape_funcio ASC";
				$Instruc = $conexion->prepare($Sql);
			} elseif ($Accion == 15) {
				/******************************************************************************************/
				/*  LISTO UN FUNCIONARIO POR ID
	            /******************************************************************************************/
				$Sql .= "WHERE Funcio.id_funcio = :id_funcio";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_funcio', $IdFuncio, PDO::PARAM_INT);
			} elseif ($Accion == 16) {
				/******************************************************************************************/
				/*  SABER SI EXISTE UN FUNCIONARIO PRINCIPAL DE TODA LA ENTIDAD
	            /******************************************************************************************/
				$Sql .= "WHERE Funcio.propie_princi = 1";
				$Instruc = $conexion->prepare($Sql);
			}

			$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			$Result = $Instruc->fetch();
			$conexion = null;

			if ($Result) {
				return new self(
					"",
					$Result['id_funcio'],
					$Result['cod_funcio'],
					$Result['nom_funcio'],
					$Result['ape_funcio'],
					$Result['genero'],
					$Result['propie_princi'],
					$Result['jefe_dependencia'],
					$Result['jefe_oficina'],
					$Result['crea_expedien'],
					$Result['puede_firmar'],
					$Result['id_depen'],
					$Result['id_oficina'],
					$Result['id_cargo'],
					$Result['id_muni'],
					$Result['id_depar'],
					$Result['dir'],
					$Result['tel'],
					$Result['cel'],
					$Result['email'],
					$Result['observa'],
					$Result['firma'],
					$Result['foto'],
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
