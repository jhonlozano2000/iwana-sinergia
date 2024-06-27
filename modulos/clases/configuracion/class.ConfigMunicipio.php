 <?php
	class Municipio
	{
		private $Accion;
		private $IdDepar;
		private $IdMuni;
		private $NomMuni;

		public function __construct($Accion = null, $IdDepar = null, $IdMuni = null, $NomMuni = null)
		{
			$this->Accion  = $Accion;
			$this->IdDepar = $IdDepar;
			$this->IdMuni  = $IdMuni;
			$this->NomMuni = $NomMuni;
		}

		public function get_IdDepar()
		{
			return $this->IdDepar;
		}

		public function get_IdMuni()
		{
			return $this->IdMuni;
		}

		public function get_NomMuni()
		{
			return $this->NomMuni;
		}

		public function set_Accion($Accion)
		{
			return $this->Accion = $Accion;
		}

		public function set_IdDepar($IdDepar)
		{
			return $this->IdDepar = $IdDepar;
		}

		public function set_IdMuni($IdMuni)
		{
			return $this->IdMuni = $IdMuni;
		}

		public function set_NomMuni($NomMuni)
		{
			return $this->NomMuni = $NomMuni;
		}

		public static function Listar($Accion, $IdDepar)
		{
			$conexion = new Conexion();
			if ($Accion == 1) {
				$Sql = "SELECT * 
					FROM config_muni 
					WHERE id_depar = " . $IdDepar . " ORDER BY nom_muni";
			}

			$Instruc = $conexion->prepare($Sql);
			$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			$Result = $Instruc->fetchAll();
			$conexion = null;
			return $Result;
		}

		public static function Buscar($Accion, $IdDepar)
		{
			$conexion = new Conexion();
			if ($Accion == 1) {
				$SqlBuscar = "SELECT * FROM config_muni WHERE id_depar = " . $IdDepar;
			} elseif ($Accion == 2) {
				$SqlBuscar = "SELECT * FROM config_muni WHERE id_muni = " . $IdDepar;
			}

			$Instruc = $conexion->prepare($SqlBuscar);
			$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $SqlBuscar, true));
			$Result = $Instruc->fetch();
			$conexion = null;
			if ($Result) {
				return new self("", $Result['id_muni'], $Result['id_depar'], $Result['nom_muni']);
			} else {
				return false;
			}
		}
	}
	?>