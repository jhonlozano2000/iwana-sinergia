 <?php
	class SubSerieDetalle
	{
		private $Accion;
		private $IdSubSerie;
		private $IdTipoDocumento;
		private $Acti;

		public function __construct($Accion = null, $IdSubSerie = null, $IdTipoDocumento = null, $Acti = null)
		{
			$this->Accion          = $Accion;
			$this->IdSubSerie      = $IdSubSerie;
			$this->IdTipoDocumento = $IdTipoDocumento;
			$this->Acti            = $Acti;
		}

		public function getId_SubSerie()
		{
			return $this->IdSubSerie;
		}

		public function getId_TipoDocumento()
		{
			return $this->IdTipoDocumento;
		}

		public function getActi()
		{
			return $this->Acti;
		}

		public function setAccion($Accion)
		{
			$this->Accion = $Accion;
		}

		public function setId_SubSerie($IdSubSerie)
		{
			$this->IdSubSerie = $IdSubSerie;
		}

		public function setId_TipoDocument($IdTipoDocumento)
		{
			$this->IdTipoDocumento = $IdTipoDocumento;
		}

		public function setActi($Acti)
		{
			$this->Acti = $Acti;
		}

		public function Gestionar()
		{
			$conexion = new Conexion();

			try {

				if ($this->Accion == 1) {
					$Sql = "INSERT INTO archivo_trd_subserie_docu(id_subserie, id_tipodoc, acti)
						VALUES(:id_subserie, :id_tipodoc, 1)";

					$Instruc = $conexion->prepare($Sql);
					$Instruc->bindParam(':id_subserie', $this->IdSubSerie, PDO::PARAM_INT);
					$Instruc->bindParam(':id_tipodoc', $this->IdTipoDocumento, PDO::PARAM_INT);
				}
				if ($this->Accion == 2) {
					$Sql = "UPDATE archivo_trd_subserie_docu
	 					SET acti = :acti
	 					WHERE id_subserie = :id_subserie AND id_tipodoc = :id_tipodoc";

					$Instruc = $conexion->prepare($Sql);
					$Instruc->bindParam(':acti', $this->Acti, PDO::PARAM_INT);
					$Instruc->bindParam(':id_subserie', $this->IdSubSerie, PDO::PARAM_INT);
					$Instruc->bindParam(':id_tipodoc', $this->IdTipoDocumento, PDO::PARAM_INT);
				}
				if ($this->Accion == 3) {
					$Sql = "DELETE FROM archivo_trd_subserie_docu
	 					WHERE id_subserie = :id_subserie
		 					AND `id_tipodoc` NOT IN(SELECT `id_tipodoc` FROM archivo_radica_recibidos)
							AND `id_tipodoc` NOT IN(SELECT `id_tipodoc` FROM archivo_radica_enviados)
							AND `id_tipodoc` NOT IN(SELECT `id_tipodoc` FROM archivo_radica_enviados_temp)";

					$Instruc = $conexion->prepare($Sql);
					$Instruc->bindParam(':id_subserie', $this->IdSubSerie, PDO::PARAM_INT);
				}
				if ($this->Accion == 4) {
					$Sql = "UPDATE archivo_trd_subserie_docu
	 					SET acti = :acti
	 					WHERE id_subserie = :id_subserie";

					$Instruc = $conexion->prepare($Sql);
					$Instruc->bindParam(':acti', $this->Acti, PDO::PARAM_INT);
					$Instruc->bindParam(':id_subserie', $this->IdSubSerie, PDO::PARAM_INT);
				}

				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
				//$this->IdSubSerie = $conexion -> lastInsertId();
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

		public static function Buscar($Accion, $IdSubSerie, $IdDocu)
		{
			$conexion = new Conexion();

			try {
				if ($Accion == 1) {
					$Sql = "SELECT *
						FROM archivo_trd_subserie_docu
						WHERE id_subserie = :id_subserie AND id_tipodoc = :id_tipodoc";

					$Instruc = $conexion->prepare($Sql);
					$Instruc->bindParam(':id_subserie', $IdSubSerie, PDO::PARAM_INT);
					$Instruc->bindParam(':id_tipodoc', $IdDocu, PDO::PARAM_INT);
					$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
				}

				$Result = $Instruc->fetch();
				$conexion = null;

				if ($Result) {
					return new self("", $Result['id_subserie'], $Result['id_tipodoc'], $Result['acti']);
				} else {
					return false;
				}
			} catch (PDOException $e) {
				echo 'Ha surgido un error y no se puede ejecutar la consulta.' . $e->getMessage();
				exit;
			}
		}

		public static function Listar($Accion, $IdSubSerie, $IdDocu)
		{
			$conexion = new Conexion();
			$SqlListar = Generar_Sql_TRD_Subseries($Accion, $IdSubSerie, $IdDocu);
			$InstrucListar = $conexion->prepare($SqlListar);
			$InstrucListar->execute() or die(printr($InstrucListar->errorInfo() . " - " . $SqlListar, true));
			$Registros = $InstrucListar->fetchAll();
			$conexion = null;
			return $Registros;
		}
	}
	?>