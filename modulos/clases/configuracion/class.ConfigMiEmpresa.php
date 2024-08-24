<?php
class MiEmpresa
{
	private $Accion;
	private $Nit;
	private $RazonSocial;
	private $Slogan;
	private $IdDepartamento;
	private $IdMunicipio;
	private $Dir;
	private $Tel;
	private $Cel;
	private $Email;
	private $Web;
	private $Logo;

	public function __construct(
		$Accion = null,
		$Nit = null,
		$RazonSocial = null,
		$Slogan = null,
		$IdDepartamento = null,
		$IdMunicipio = null,
		$Dir = null,
		$Tel = null,
		$Cel = null,
		$Email = null,
		$Web = null,
		$Logo = null
	) {

		$this->Accion         = $Accion;
		$this->Nit            = $Nit;
		$this->RazonSocial    = $RazonSocial;
		$this->Slogan         = $Slogan;
		$this->IdDepartamento = $IdDepartamento;
		$this->IdMunicipio    = $IdMunicipio;
		$this->Dir            = $Dir;
		$this->Tel            = $Tel;
		$this->Cel            = $Cel;
		$this->Email          = $Email;
		$this->Web            = $Web;
		$this->Logo            = $Logo;
	}

	public function getId_Depar()
	{
		return $this->IdDepartamento;
	}

	public function getId_Muni()
	{
		return $this->IdMunicipio;
	}

	public function get_Nit()
	{
		return $this->Nit;
	}

	public function get_RazonSocial()
	{
		return $this->RazonSocial;
	}

	public function get_Slogan()
	{
		return $this->Slogan;
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

	public function get_Email()
	{
		return $this->Email;
	}

	public function get_Web()
	{
		return $this->Web;
	}

	public function get_Logo()
	{
		return $this->Logo;
	}

	/////////////////////////////////////
	public function set_Accion($Accion)
	{
		return $this->Accion = $Accion;
	}

	public function setId_Depar($IdDepartamento)
	{
		return $this->IdDepartamento = $IdDepartamento;
	}

	public function setId_Muni($IdMunicipio)
	{
		return $this->IdMunicipio = $IdMunicipio;
	}

	public function set_Nit($Nit)
	{
		return $this->Nit = $Nit;
	}

	public function set_RazonSocial($RazonSocial)
	{
		return $this->RazonSocial = $RazonSocial;
	}

	public function set_Slogan($Slogan)
	{
		return $this->Slogan = $Slogan;
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

	public function set_Email($Email)
	{
		return $this->Email = $Email;
	}

	public function set_Web($Web)
	{
		return $this->Web = $Web;
	}

	public function set_Logo($Logo)
	{
		return $this->Logo = $Logo;
	}

	public function Gestionar()
	{
		try {
			$conexion = new Conexion();

			if ($this->Accion == 0) {

				$Sql = "INSERT INTO config_empresa(id_depar, id_muni, nit, razo_soci, slogan, dir, tel, cel, email, web)
						VALUES(:id_depar, :id_muni, :nit, :razo_soci, :slogan, :dir, :tel, :cel, :email, :web)";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_depar', $this->IdDepartamento, PDO::PARAM_INT);
				$Instruc->bindParam(':id_muni', $this->IdMunicipio, PDO::PARAM_INT);
				$Instruc->bindParam(':nit', $this->Nit, PDO::PARAM_STR);
				$Instruc->bindParam(':razo_soci', $this->RazonSocial, PDO::PARAM_STR);
				$Instruc->bindParam(':slogan', $this->Slogan, PDO::PARAM_STR);
				$Instruc->bindParam(':dir', $this->Dir, PDO::PARAM_STR);
				$Instruc->bindParam(':tel', $this->Tel, PDO::PARAM_STR);
				$Instruc->bindParam(':cel', $this->Cel, PDO::PARAM_STR);
				$Instruc->bindParam(':email', $this->Email, PDO::PARAM_STR);
				$Instruc->bindParam(':web', $this->Web, PDO::PARAM_STR);
			} elseif ($this->Accion == 1) {

				$Sql = "UPDATE config_empresa
						SET nit=:nit, razo_soci = :razo_soci, slogan = :slogan, dir = :dir, tel = :tel, cel = :cel, email = :email, web = :web, id_depar = :id_depar, id_muni = :id_muni";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':nit', $this->Nit, PDO::PARAM_STR);
				$Instruc->bindParam(':razo_soci', $this->RazonSocial, PDO::PARAM_STR);
				$Instruc->bindParam(':slogan', $this->Slogan, PDO::PARAM_STR);
				$Instruc->bindParam(':dir', $this->Dir, PDO::PARAM_STR);
				$Instruc->bindParam(':tel', $this->Tel, PDO::PARAM_STR);
				$Instruc->bindParam(':cel', $this->Cel, PDO::PARAM_STR);
				$Instruc->bindParam(':email', $this->Email, PDO::PARAM_STR);
				$Instruc->bindParam(':web', $this->Web, PDO::PARAM_STR);
				$Instruc->bindParam(':id_depar', $this->IdDepartamento, PDO::PARAM_INT);
				$Instruc->bindParam(':id_muni',  $this->IdMunicipio, PDO::PARAM_INT);
			} elseif ($this->Accion === 2) {
				$Sql = "UPDATE config_empresa SET logo = '" . $this->Logo . "'";

				$Instruc = $conexion->prepare($Sql);
			}

			$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			$conexion = null;

			if ($Instruc) {
				return true;
			} else {
				return false;
			}
		} catch (PDOException $e) {
			echo 'Ha surgido un error y no se puede ejecutar la consulta. Configuración Mi Empresa, Gestionar, Accion ' . $this->Accion . " - " . $Sql . " - " . $e->getMessage();
			exit;
		}
	}

	public static function Listar()
	{
		$conexion = new Conexion();
		$SqlBuscar = "SELECT config_empresa.*, config_depar.nom_depar, config_muni.nom_muni
					  FROM config_empresa
					    INNER JOIN config_depar ON (config_empresa.id_depar = config_depar.id_depar)
					    INNER JOIN config_muni ON (config_empresa.id_muni = config_muni.id_muni) ";

		$Instruc = $conexion->prepare($SqlBuscar);
		$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $SqlBuscar, true));
		$Result = $Instruc->fetchAll();
		$conexion = null;
		return $Result;
	}

	public static function Buscar()
	{
		$conexion = new Conexion();
		$SqlBuscar = "SELECT * FROM config_empresa";

		$Instruc = $conexion->prepare($SqlBuscar);
		$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $SqlBuscar, true));
		$Result = $Instruc->fetch();
		$conexion = null;
		if ($Result) {
			return new self(
				"",
				$Result['nit'],
				$Result['razo_soci'],
				$Result['slogan'],
				$Result['id_depar'],
				$Result['id_muni'],
				$Result['dir'],
				$Result['tel'],
				$Result['cel'],
				$Result['email'],
				$Result['web'],
				$Result['logo']
			);
		} else {
			return false;
		}
	}
}
