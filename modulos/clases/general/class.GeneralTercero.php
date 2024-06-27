<?php
class Tercero
{
	private $Accion;
	private $IdTercero;
	private $IdEmpresa;
	private $IdDepartamento;
	private $IdMunicipio;
	private $IdTipoDocu;
	private $NumDocu;
	private $NomContacto;
	private $Cargo;
	private $Dir;
	private $Tel;
	private $Cel;
	private $Fax;
	private $Email;
	private $Password;
	private $Acti;

	public function __construct(
		$Accion = null,
		$IdTercero = null,
		$IdEmpresa = null,
		$IdDepartamento = null,
		$IdMunicipio = null,
		$IdTipoDocu = null,
		$NumDocu = null,
		$NomContacto = null,
		$Cargo = null,
		$Dir = null,
		$Tel = null,
		$Cel = null,
		$Fax = null,
		$Email = null,
		$Password = null,
		$Acti = null
	) {

		$this->Accion         = $Accion;
		$this->IdTercero      = $IdTercero;
		$this->IdEmpresa      = $IdEmpresa;
		$this->IdDepartamento = $IdDepartamento;
		$this->IdMunicipio    = $IdMunicipio;
		$this->IdTipoDocu     = $IdTipoDocu;
		$this->NumDocu        = $NumDocu;
		$this->NomContacto    = $NomContacto;
		$this->Cargo          = $Cargo;
		$this->Dir            = $Dir;
		$this->Tel            = $Tel;
		$this->Cel            = $Cel;
		$this->Fax            = $Fax;
		$this->Email          = $Email;
		$this->Password       = $Password;
		$this->Acti           = $Acti;
	}

	public function getId_Remite()
	{
		return $this->IdTercero;
	}

	public function getId_Empresa()
	{
		return $this->IdEmpresa;
	}

	public function getId_Depar()
	{
		return $this->IdDepartamento;
	}

	public function getId_Muni()
	{
		return $this->IdMunicipio;
	}

	public function getId_TipoDocu()
	{
		return $this->IdTipoDocu;
	}

	public function getNum_Documetno()
	{
		return $this->NumDocu;
	}

	public function getNom_Contacto()
	{
		return $this->NomContacto;
	}

	public function get_Cargo()
	{
		return $this->Cargo;
	}

	public function get_Dir()
	{
		return $this->Dir;
	}

	public function get_Tel()
	{
		return $this->Tel;
	}

	public function get_Cel()
	{
		return $this->Cel;
	}

	public function get_Fax()
	{
		return $this->Fax;
	}

	public function get_Email()
	{
		return $this->Email;
	}

	public function get_Password()
	{
		return $this->Password;
	}

	public function get_Acti()
	{
		return $this->Acti;
	}

	/////////////////////////////////////
	public function set_Accion($Accion)
	{
		return $this->Accion = $Accion;
	}

	public function setId_Reite($IdTercero)
	{
		return $this->IdTercero = $IdTercero;
	}

	public function setId_Empresa($IdEmpresa)
	{
		return $this->IdEmpresa = $IdEmpresa;
	}

	public function setId_Depar($IdDepartamento)
	{
		return $this->IdDepartamento = $IdDepartamento;
	}

	public function setId_Muni($IdMunicipio)
	{
		return $this->IdMunicipio = $IdMunicipio;
	}

	public function setId_TipoDocu($IdTipoDocu)
	{
		return $this->IdTipoDocu = $IdTipoDocu;
	}

	public function setNum_Documetno($NumDocu)
	{
		return $this->NumDocu = $NumDocu;
	}

	public function setNom_Contacto($NomContacto)
	{
		return $this->NomContacto = $NomContacto;
	}

	public function set_Cargo($Cargo)
	{
		return $this->Cargo = $Cargo;
	}

	public function set_Dir($Dir)
	{
		return $this->Dir = $Dir;
	}

	public function set_Tel($Tel)
	{
		return $this->Tel = $Tel;
	}

	public function set_Cel($Cel)
	{
		return $this->Cel = $Cel;
	}

	public function set_Fax($Fax)
	{
		return $this->Fax = $Fax;
	}

	public function set_Email($Email)
	{
		return $this->Email = $Email;
	}

	public function set_Password($Password)
	{
		return $this->Password = $Password;
	}

	public function set_Acti($Acti)
	{
		return $this->Acti = $Acti;
	}

	public function Gestionar()
	{
		$conexion = new Conexion();

		try {

			$ParameEmpresa = PDO::PARAM_INT;
			if ($this->IdEmpresa == NULL) {
				$ParameEmpresa =  PDO::PARAM_NULL;
			}

			$ParameDepartamento = PDO::PARAM_INT;
			if ($this->IdDepartamento == NULL) {
				$ParameDepartamento =  PDO::PARAM_NULL;
			}

			$ParameMunicipio = PDO::PARAM_INT;
			if ($this->IdMunicipio == NULL) {
				$ParameMunicipio =  PDO::PARAM_NULL;
			}

			$ParameTipoDocu = PDO::PARAM_INT;
			if ($this->IdTipoDocu == NULL or $this->IdTipoDocu == "") {
				$ParameTipoDocu =  PDO::PARAM_NULL;
			}


			$ParameNumDocu = PDO::PARAM_INT;
			if ($this->NumDocu == NULL or $this->NumDocu == "") {
				$ParameNumDocu =  PDO::PARAM_NULL;
			}

			if ($this->Accion == 'NUEVO_TERCERO') {
				$Sql = "INSERT INTO gene_terceros_contac(id_empre, id_depar, id_muni, num_docu, nom_contac, dir, tel, cel, fax, email)
						VALUE(:id_empre, :id_depar, :id_muni, :num_docu, :nom_contac, :dir, :tel, :cel, :fax, :email)";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_empre', $this->IdEmpresa, $ParameEmpresa);
				$Instruc->bindParam(':id_depar', $this->IdDepartamento, $ParameDepartamento);
				$Instruc->bindParam(':id_muni', $this->IdMunicipio, $ParameMunicipio);
				$Instruc->bindParam(':num_docu', $this->NumDocu, $ParameNumDocu);
				$Instruc->bindParam(':nom_contac', $this->NomContacto, PDO::PARAM_STR);
				$Instruc->bindParam(':dir', $this->Dir, PDO::PARAM_STR);
				$Instruc->bindParam(':tel', $this->Tel, PDO::PARAM_STR);
				$Instruc->bindParam(':cel', $this->Cel, PDO::PARAM_STR);
				$Instruc->bindParam(':fax', $this->Fax, PDO::PARAM_STR);
				$Instruc->bindParam(':email', $this->Email, PDO::PARAM_STR);
			} elseif ($this->Accion == 'EDITAR_TERCERO') {
				$Sql = "UPDATE gene_terceros_contac
						SET id_empre = :id_empre, id_depar = :id_depar, id_muni = :id_muni, id_tipo_docu = :id_tipo_docu, num_docu = :num_docu, nom_contac = :nom_contac, dir = :dir,
							tel = :tel, cel = :cel, fax = :fax, email = :email
						WHERE id_tercero = :id_tercero";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_empre', $this->IdEmpresa, $ParameEmpresa);
				$Instruc->bindParam(':id_depar', $this->IdDepartamento, $ParameDepartamento);
				$Instruc->bindParam(':id_muni', $this->IdMunicipio, $ParameMunicipio);
				$Instruc->bindParam(':id_tipo_docu', $this->IdTipoDocu, $ParameTipoDocu);
				$Instruc->bindParam(':num_docu', $this->NumDocu, PDO::PARAM_STR);
				$Instruc->bindParam(':nom_contac', $this->NomContacto, PDO::PARAM_STR);
				$Instruc->bindParam(':dir', $this->Dir, PDO::PARAM_STR);
				$Instruc->bindParam(':tel', $this->Tel, PDO::PARAM_STR);
				$Instruc->bindParam(':cel', $this->Cel, PDO::PARAM_STR);
				$Instruc->bindParam(':fax', $this->Fax, PDO::PARAM_STR);
				$Instruc->bindParam(':email', $this->Email, PDO::PARAM_STR);
				$Instruc->bindParam(':id_tercero', $this->IdTercero, PDO::PARAM_INT);
			} elseif ($this->Accion == 'NUEVO_TERCERO_PQR') {
				$Sql = "INSERT INTO gene_terceros_contac(id_depar, id_muni, id_tipo_docu, num_docu, nom_contac, dir, tel, cel, email, password)
						VALUE(:id_depar, :id_muni, :id_tipo_docu, :num_docu, :nom_contac, :dir, :tel, :cel, :email, :password)";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_depar', $this->IdDepartamento, PDO::PARAM_INT);
				$Instruc->bindParam(':id_muni', $this->IdMunicipio, PDO::PARAM_INT);
				$Instruc->bindParam(':id_tipo_docu', $this->IdTipoDocu, PDO::PARAM_STR);
				$Instruc->bindParam(':num_docu', $this->NumDocu, PDO::PARAM_STR);
				$Instruc->bindParam(':nom_contac', $this->NomContacto, PDO::PARAM_STR);
				$Instruc->bindParam(':dir', $this->Dir, PDO::PARAM_STR);
				$Instruc->bindParam(':tel', $this->Tel, PDO::PARAM_STR);
				$Instruc->bindParam(':cel', $this->Cel, PDO::PARAM_STR);
				$Instruc->bindParam(':email', $this->Email, PDO::PARAM_STR);
				$Instruc->bindParam(':password', $this->Password, PDO::PARAM_STR);
			} elseif ($this->Accion == 'EDITAR_TERCERO_PQR') {
				$Sql = "UPDATE gene_terceros_contac
						SET id_depar = :id_depar, id_muni = :id_muni, id_tipo_docu = :id_tipo_docu, num_docu = :num_docu, nom_contac = :nom_contac, dir = :dir,
							tel = :tel, cel = :cel, fax = :fax, email = :email, password = :password
						WHERE id_tercero = :id_tercero";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_depar', $this->IdDepartamento, $ParameDepartamento);
				$Instruc->bindParam(':id_muni', $this->IdMunicipio, $ParameMunicipio);
				$Instruc->bindParam(':id_tipo_docu', $this->IdTipoDocu, PDO::PARAM_STR);
				$Instruc->bindParam(':num_docu', $this->NumDocu, PDO::PARAM_STR);
				$Instruc->bindParam(':nom_contac', $this->NomContacto, PDO::PARAM_STR);
				$Instruc->bindParam(':dir', $this->Dir, PDO::PARAM_STR);
				$Instruc->bindParam(':tel', $this->Tel, PDO::PARAM_STR);
				$Instruc->bindParam(':cel', $this->Cel, PDO::PARAM_STR);
				$Instruc->bindParam(':fax', $this->Fax, PDO::PARAM_STR);
				$Instruc->bindParam(':email', $this->Email, PDO::PARAM_STR);
				$Instruc->bindParam(':password', $this->Password, PDO::PARAM_STR);
				$Instruc->bindParam(':id_tercero', $this->IdTercero, PDO::PARAM_INT);
			}

			$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			$this->IdTercero = $conexion->lastInsertId();
			$conexion = null;

			if ($Instruc) {
				return true;
			} else {
				return false;
			}
		} catch (PDOException $e) {
			echo 'Ha surgido un error y no se puede ejecutar la consulta, Gestionar Contacto Tercero ->' . $this->Accion . " " . $e->getMessage();
			exit;
		}
	}

	public static function Listar($Accion, $IdTercero, $IdEmpresa, $Nit, $RazoSoci, $NumDocu, $NomContacto)
	{
		$conexion = new Conexion();

		$Sql = "SELECT Empre.id_empre, EmpreDepar.id_depar AS id_depar_empre, EmpreDepar.nom_depar AS nom_depar_empre,
                        EmpreMuni.id_muni AS id_muni_empre, EmpreMuni.nom_muni AS nom_muni_empre, Empre.nit_empre, Empre.razo_soci,
                        Empre.dir AS dir_empre, Empre.tel AS tel_empre, Empre.cel AS cel_empre, Empre.fax AS fax_empre, Empre.email AS email_empre,
                        Contac.id_tercero, ContacDepar.id_depar AS id_depar_remite, ContacDepar.nom_depar AS nom_depar_remite,
                        ContacMuni.id_muni AS id_muni_remite, ContacMuni.nom_muni AS nom_muni_remite, Contac.num_docu,
                        Contac.nom_contac, Contac.cargo, Contac.dir AS dir_remite, Contac.tel AS tel_remite, Contac.cel AS cel_remite,
                        Contac.fax AS fax_remite, Contac.email AS email_remite, Contac.acti AS acti_remite
                FROM gene_terceros_contac AS Contac
                    LEFT JOIN gene_terceros_empresas AS Empre ON (Contac.id_empre = Empre.id_empre)
                    LEFT JOIN config_muni AS EmpreMuni ON (Empre.id_muni = EmpreMuni.id_muni)
                    LEFT JOIN config_depar AS EmpreDepar ON (Empre.id_depar = EmpreDepar.id_depar)
                    LEFT JOIN config_depar AS ContacDepar ON (Contac.id_depar = ContacDepar.id_depar)
                    LEFT JOIN config_muni AS ContacMuni ON (Contac.id_muni = ContacMuni.id_muni) ";

		try {
			if ($Accion == 1) {
				$Sql .= "WHERE Contac.id_empre IS NULL
                        ORDER BY nom_contac ASC";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 2) {
				/******************************************************************************************/
				/*  LISTO LAS SOLICITUDES DE HISOTIRA CLINICA PENDIENTES POR RADICAR
                /******************************************************************************************/

				$Sql .= "WHERE Contac.id_tercero = :id_tercero";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_tercero', $IdTercero, PDO::PARAM_INT);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 3) {
				/******************************************************************************************/
				/*
	            /*  LISTO POR NOMBRE
	            /*
	            /******************************************************************************************/
				$Sql .= "WHERE Contac.nom_contac = :nom_contac AND Contac.id_empre IS NULL";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':nom_contac', $NomContacto, PDO::PARAM_STR);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 4) {
				/******************************************************************************************/
				/*
	            /*  LISTO POR CÓDIGO O NUMERO DE DOCUMENTO DE UN TERCERO NATURAL
	            /*
	            /******************************************************************************************/
				$Sql .= "WHERE Contac.num_docu = :num_docu AND Contac.id_empre IS NULL";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':num_docu', $NumDocu, PDO::PARAM_STR);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 5) {
				/******************************************************************************************/
				/*
	            /*  LISTO POR NUMERO DE DOCUMENTO O POR NOMBRE
	            /*
	            /******************************************************************************************/
				$Sql = "SELECT gene_terceros_contac.id_tercero, gene_terceros_contac.num_docu, gene_terceros_contac.nom_contac
	                        , gene_terceros_contac.dir AS 'dir_remite', config_depar.nom_depar AS 'nom_depar_remite', config_muni.nom_muni AS 'nom_muni_remite'
	                        , gene_terceros_contac.tel AS 'tel_remite', gene_terceros_contac.cel AS 'cel_remite'
	                    FROM
	                        gene_terceros_contac
	                        LEFT JOIN config_muni ON (gene_terceros_contac.id_muni = config_muni.id_muni)
	                        LEFT JOIN config_depar ON (gene_terceros_contac.id_depar = config_depar.id_depar)
	           			WHERE (gene_terceros_contac.num_docu LIKE ? OR gene_terceros_contac.nom_contac LIKE ?)";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->execute(array('%' . $NomContacto . '%', '%' . $NomContacto . '%')) or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 6) {
				/******************************************************************************************/
				/*
	            /*  BUSCO UN CONTACTO POR EMPRESA, UN CONTACTO JURIDICO
	            /*
	            /******************************************************************************************/
				$Sql .= "WHERE Empre.id_empre = :id_empre AND Contac.nom_contac = :nom_contac AND Contac.id_empre IS NOT NULL";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_empre', $IdEmpresa, PDO::PARAM_INT);
				$Instruc->bindParam(':nom_contac', $NomContacto, PDO::PARAM_STR);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 7) {
				/******************************************************************************************/
				/*
	            /*  BUSCO UN UNA EMPRESA POR ID
	            /*
	            /******************************************************************************************/
				$Sql .= "WHERE Empre.id_empre = :id_empre AND Contac.id_empre IS NOT NULL";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_empre', $IdEmpresa, PDO::PARAM_INT);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 8) {
				/******************************************************************************************/
				/*
	            /*  BUSCO UN UNA EMPRESA POR NIT
	            /*
	            /******************************************************************************************/
				$Sql .= "WHERE Empre.nit_empre = :nit_empre AND Contac.id_empre IS NOT NULL";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':nit_empre', $Nit, PDO::PARAM_STR);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 9) {
				/******************************************************************************************/
				/*
	            /*  BUSCO UN UNA EMPRESA POR RAZON SOCIAL
	            /*
	            /******************************************************************************************/
				$Sql .= "WHERE Empre.razo_soci = :razo_soci AND Contac.id_empre IS NOT NULL";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':razo_soci', $RazoSoci, PDO::PARAM_STR);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 10) {
				/******************************************************************************************/
				/*
	            /*  LISTO LAS EMPRESAS DE LOS CONTACTOS
	            /*
	            /******************************************************************************************/
				$Sql = "SELECT DISTINCT id_empre, razo_soci
	                    FROM gene_terceros_empresas
	                    ORDER BY razo_soci";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 11) {
				/******************************************************************************************/
				/*
	            /*  LISTO LOS CONTACTOS DE UNA EMPRESA
	            /*
	            /******************************************************************************************/
				$Sql = "WHERE Empre.id_empre = :id_empre AND Empre.id_empre IS NOT NULL
	                    ORDER BY razo_soci, nom_contac ASC";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_empre', $IdEmpresa, PDO::PARAM_INT);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 12) {
				/******************************************************************************************/
				/*
	            /*  LISTO LOS TERCEROS
	            /*
	            /******************************************************************************************/
				$Sql = "SELECT `contac`.`id_tercero`, `contac`.`id_depar` AS `id_depar_contac`, `depar_contac`.`nom_depar` AS `nom_depar_contac`, `contac`.`id_muni` AS `id_muni_contac`, `muni_contac`.`nom_muni` AS `nom_muni_contac`, 
	            			`contac`.`num_docu`, `contac`.`nom_contac`, `contac`.`cargo`, `contac`.`dir` AS `dir_contac`, `contac`.`tel` AS `tel_contac`, `contac`.`cel` AS `cel_contac`, `contac`.`fax` AS `fax_contac`, 
	            			`contac`.`email` AS `email_contac`, `contac`.`acti` AS `acti_contac`, `empre`.`id_empre`, `depar_empre`.`id_depar` AS `id_depar_empre`, `depar_empre`.`nom_depar` AS `nom_depar_empre`, 
	            			`muni_empre`.`id_muni` AS `id_muni_empre`, `muni_empre`.`nom_muni` AS `nom_muni_empre`, `empre`.`nit_empre`, `empre`.`razo_soci` AS `razo_soci`, `empre`.`dir` AS `dir_empre`, `empre`.`tel` AS `tel_empre`, 
	            			`empre`.`cel` AS `cel_empre`, `empre`.`fax` AS `fax_empre`, `empre`.`email` AS `email_empre`, `empre`.`web` AS `web_empre`
						FROM `gene_terceros_contac` AS `contac`
						    LEFT JOIN `gene_terceros_empresas` AS `empre` ON (`contac`.`id_empre` = `empre`.`id_empre`)
						    LEFT JOIN `config_muni` AS `muni_contac` ON (`contac`.`id_muni` = `muni_contac`.`id_muni`)
						    LEFT JOIN `config_depar` AS `depar_contac` ON (`contac`.`id_depar` = `depar_contac`.`id_depar`)
						    LEFT JOIN `config_depar` AS `depar_empre` ON (`empre`.`id_depar` = `depar_empre`.`id_depar`)
						    LEFT JOIN `config_muni` AS `muni_empre` ON (`empre`.`id_muni` = `muni_empre`.`id_muni`)
						WHERE (`contac`.`num_docu` LIKE ? OR `contac`.`nom_contac` LIKE ? OR `empre`.`nit_empre` LIKE ? OR `empre`.`razo_soci` LIKE ?)";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->execute(array('%' . $NomContacto . '%', '%' . $NomContacto . '%', '%' . $NomContacto . '%', '%' . $NomContacto . '%')) or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 13) {
				/******************************************************************************************/
				/*
	            /*  LISTO LOS TERCEROS NATURALES
	            /*
	            /******************************************************************************************/
				$Sql = "SELECT gene_terceros_contac.id_tercero, gene_terceros_contac.num_docu, gene_terceros_contac.nom_contac
	                        , gene_terceros_contac.dir AS 'dir_remite', config_depar.nom_depar AS 'nom_depar_remite', config_muni.nom_muni AS 'nom_muni_remite'
	                        , gene_terceros_contac.tel AS 'tel_remite', gene_terceros_contac.cel AS 'cel_remite'
	                    FROM
	                        gene_terceros_contac
	                        LEFT JOIN config_muni ON (gene_terceros_contac.id_muni = config_muni.id_muni)
	                        LEFT JOIN config_depar ON (gene_terceros_contac.id_depar = config_depar.id_depar)
	           			WHERE (gene_terceros_contac.num_docu LIKE ? OR gene_terceros_contac.nom_contac LIKE ?) AND gene_terceros_contac.id_empre IS NULL";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->execute(array('%' . $NomContacto . '%', '%' . $NomContacto . '%')) or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 14) {
				/******************************************************************************************/
				/*
	            /*  LISTO LOS TERCEROS JURIDICOS POR EMPRESA QUE ESTEN ACTIVOS
	            /*
	            /******************************************************************************************/
				$Sql = "SELECT `terce`.`id_empre`, `terce`.`nit_empre`, `terce`.`razo_soci`, `terce`.`dir`, `terce`.`tel`, `terce`.`cel`,
	            			`depar`.`nom_depar`, `muni`.`nom_muni`
						FROM `gene_terceros_empresas` AS `terce`
						    INNER JOIN `config_depar` AS `depar` ON (`terce`.`id_depar` = `depar`.`id_depar`)
						    INNER JOIN `config_muni` AS `muni` ON (`terce`.`id_muni` = `muni`.`id_muni`)
	                    WHERE (`terce`.`razo_soci` LIKE ?)";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->execute(array('%' . $NomContacto . '%')) or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			}

			$Result = $Instruc->fetchAll();
			$conexion = null;
			return $Result;
		} catch (PDOException $e) {
			echo 'Ha surgido un error y no se puede ejecutar la consulta.' . $e->getMessage();
			exit;
		}
	}

	public static function Buscar($Accion, $IdTercero, $IdEmpresa, $Nit, $RazoSoci, $NumDocu, $NomContacto)
	{
		$conexion = new Conexion();

		try {

			if ($Accion == 2) {
				/******************************************************************************************/
				/*  LISTO LAS SOLICITUDES DE HISOTIRA CLINICA PENDIENTES POR RADICAR
                /******************************************************************************************/

				$Sql = "SELECT *
                		FROM gene_terceros_contac
                		WHERE id_tercero = :id_tercero";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_tercero', $IdTercero, PDO::PARAM_INT);
			} elseif ($Accion == 3) {
				/******************************************************************************************/
				/*  LISTO POR NOMBRE
	            /******************************************************************************************/
				$Sql = "SELECT *
                		FROM gene_terceros_contac
	            		WHERE nom_contac = :nom_contac AND id_empre IS NULL";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':nom_contac', $NomContacto, PDO::PARAM_STR);
			} elseif ($Accion == 4) {
				/******************************************************************************************/
				/*  LISTO POR CÓDIGO O NUMERO DE DOCUMENTO DE UN TERCERO NATURAL
	            /******************************************************************************************/
				$Sql = "SELECT *
	            		FROM gene_terceros_contac
	            		WHERE num_docu = :num_docu AND id_empre IS NULL";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':num_docu', $NumDocu, PDO::PARAM_STR);
			} elseif ($Accion == 5) {
				/******************************************************************************************/
				/*  LISTO POR NUMERO DE DOCUMENTO O POR NOMBRE
	            /******************************************************************************************/
				$Sql = "SELECT *
	                    FROM gene_terceros_contac
	           			WHERE (num_docu LIKE ? OR nom_contac LIKE ?)";

				$Instruc = $conexion->prepare($Sql);
			} elseif ($Accion == 6) {
				/******************************************************************************************/
				/*  BUSCO UN CONTACTO POR EMPRESA, UN CONTACTO JURIDICO
	            /******************************************************************************************/
				$Sql = "SELECT *
	                    FROM gene_terceros_contac
	                    WHERE id_empre = :id_empre AND nom_contac = :nom_contac AND id_empre IS NOT NULL";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_empre', $IdEmpresa, PDO::PARAM_INT);
				$Instruc->bindParam(':nom_contac', $NomContacto, PDO::PARAM_STR);
			} elseif ($Accion == 7) {
				/******************************************************************************************/
				/*  BUSCO UN UNA EMPRESA POR ID
	            /******************************************************************************************/
				$Sql = "SELECT *
	                    FROM gene_terceros_contac
	                    WHERE id_empre = :id_empre AND id_empre IS NOT NULL";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_empre', $IdEmpresa, PDO::PARAM_INT);
			} elseif ($Accion == 13) {
				/******************************************************************************************/
				/*  LISTO LOS TERCEROS NATURALES
	            /******************************************************************************************/
				$Sql = "SELECT *
	                    FROM gene_terceros_contac
	           			WHERE (num_docu LIKE ? OR nom_contac LIKE ?) AND id_empre IS NULL";

				$Instruc = $conexion->prepare($Sql);
			} elseif ($Accion == 14) {
				/******************************************************************************************/
				/*  BUSCO SI EXISTE UN CONTACTO DE UNA EMPRESA EN UN TERCERO JURIDICO
	            /******************************************************************************************/
				$Sql = "SELECT *
                		FROM gene_terceros_contac
	            		WHERE nom_contac = :nom_contac AND id_empre = :id_empre AND cargo = :cargo ";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':nom_contac', $NomContacto, PDO::PARAM_STR);
				$Instruc->bindParam(':id_empre', $IdEmpresa, PDO::PARAM_INT);
				$Instruc->bindParam(':cargo', $Nit, PDO::PARAM_STR);
			} elseif ($Accion == 15) {
				/******************************************************************************************/
				/*  BUSCO SI EXISTE UN CONTACTO DE UN EMAIL
	            /******************************************************************************************/
				$Sql = "SELECT *
                		FROM gene_terceros_contac
	            		WHERE email = :email";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':email', $RazoSoci, PDO::PARAM_STR);
			}

			$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			$Result = $Instruc->fetch();
			$conexion = null;

			if ($Result) {
				return new self(
					"",
					$Result['id_tercero'],
					$Result['id_empre'],
					$Result['id_depar'],
					$Result['id_muni'],
					$Result['id_tipo_docu'],
					$Result['num_docu'],
					$Result['nom_contac'],
					$Result['cargo'],
					$Result['dir'],
					$Result['tel'],
					$Result['cel'],
					$Result['fax'],
					$Result['email'],
					$Result['password'],
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
