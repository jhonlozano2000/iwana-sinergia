<?php
class NotificacionExterna
{
	private $Accion;
	private $IdNotifica;
	private $FuncioDeta;
	private $FecHorNotifica;
	private $FecHorVisto;
	private $Titulo;
	private $Notificacion;
	private $IdRadica;
	private $Prioridad;

	public function __construct($Accion = null, $IdNotifica = null, $FuncioDeta = null, $FecHorNotifica = null, $FecHorVisto = null, $Titulo = null, $Notificacion = null, $IdRadica = null, $Prioridad = null)
	{

		$this->Accion         = $Accion;
		$this->IdNotifica     = $IdNotifica;
		$this->FuncioDeta     = $FuncioDeta;
		$this->FecHorNotifica = $FecHorNotifica;
		$this->FecHorVisto    = $FecHorVisto;
		$this->Titulo         = $Titulo;
		$this->Notificacion   = $Notificacion;
		$this->IdRadica       = $Notificacion;
		$this->Prioridad      = $Prioridad;
	}

	public function getId_Notifica()
	{
		return $this->IdNotifica;
	}

	public function getId_FuncioDeta()
	{
		return $this->FuncioDeta;
	}

	public function get_FecHorNotifica()
	{
		return $this->FecHorNotifica;
	}

	public function get_FecHorVisto()
	{
		return $this->FecHorVisto;
	}

	public function get_Titulo()
	{
		return $this->Titulo;
	}

	public function get_Notificacion()
	{
		return $this->Notificacion;
	}

	public function get_IdRadica()
	{
		return $this->IdRadica;
	}

	public function get_Priorida()
	{
		return $this->Prioridad;
	}

	public function setAccion($Accion)
	{
		$this->Accion = $Accion;
	}

	public function setId_IdNotifica($IdNotifica)
	{
		$this->IdNotifica = $IdNotifica;
	}

	public function setId_FuncioDeta($FuncioDeta)
	{
		$this->FuncioDeta = $FuncioDeta;
	}

	public function set_FecHorNotifica($FecHorNotifica)
	{
		$this->FecHorNotifica = $FecHorNotifica;
	}

	public function set_FecHorVisto($FecHorVisto)
	{
		$this->FecHorVisto = $FecHorVisto;
	}

	public function set_Titulo($Titulo)
	{
		$this->Titulo = $Titulo;
	}

	public function set_Notificacion($Notificacion)
	{
		$this->Notificacion = $Notificacion;
	}

	public function set_IdRadica($IdRadica)
	{
		return $this->IdRadica = $IdRadica;
	}

	public function set_Priorida($Prioridad)
	{
		return $this->Prioridad = $Prioridad;
	}

	public function Gestionar()
	{
		$conexion = new Conexion();

		try {

			if ($this->Accion == "INSERTAR_NOTIFICACION") {
				$Sql = "INSERT INTO `notifica_externa`(`id_funcio_deta`, `titulo`, `notificacion`, `id_radica`, `prioridad`)
						VALUES (:id_funcio_deta, :titulo, :notificacion, :id_radica, :prioridad);";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_funcio_deta', $this->FuncioDeta, PDO::PARAM_INT);
				$Instruc->bindParam(':titulo', $this->Titulo, PDO::PARAM_STR);
				$Instruc->bindParam(':notificacion', $this->Notificacion, PDO::PARAM_STR);
				$Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
				$Instruc->bindParam(':prioridad', $this->Prioridad, PDO::PARAM_INT);
			} elseif ($this->Accion == "VER_NOTIFICACION") {
				$Sql = "UPDATE `notifica_externa` SET `fechor_visto` = :fechor_visto
						WHERE `id_funcio_deta` = :id_funcio_deta AND `fechor_visto` IS NULL";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':fechor_visto', $this->FecHorVisto, PDO::PARAM_STR);
				$Instruc->bindParam(':id_funcio_deta', $this->FuncioDeta, PDO::PARAM_INT);
			}

			$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			$conexion = null;

			if ($Instruc) {
				return true;
			} else {
				return false;
			}
		} catch (PDOException $e) {
			echo 'Ha surgido un error y no se puede ejecutar la consulta Notificaicones Externaas, ' . $this->Accion . " - " . $e->getMessage();
			exit;
		}
	}

	public static function Listar($Accion, $IdNotifica, $IdFuncio, $IdModulo)
	{
		$conexion = new Conexion();

		try {

			if ($Accion == 1) {

				$Sql = "SELECT `notifica_externa`.*
						FROM `notifica_externa`
						WHERE (`id_funcio_deta` = :id_funcio_deta AND `fechor_visto` IS NULL)
						ORDER BY fechor_notifica DESC
						limit 0, 50;";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_funcio_deta', $IdFuncio, PDO::PARAM_INT);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
				$Result = $Instruc->fetchAll();
			}


			$conexion = null;
			return $Result;
		} catch (PDOException $e) {
			echo 'Ha surgido un error y no se puede ejecutar la consulta Notificacion - Listar -> ' . $Accion . " - " . $e->getMessage();
			exit;
		}
	}

	public static function Buscar($Accion, $IdNotifica, $IdModulo, $FecHorNotifica)
	{
		$conexion = new Conexion();

		try {

			if ($Accion == 1) {

				$Sql = "";
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			}

			$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			$Result = $Instruc->fetch();
			$conexion = null;

			if ($Result) {
				return new self(
					"",
					$Result['id_notifica'],
					$Result['id_funcio_deta'],
					$Result['id_modu'],
					$Result['fechor_notifica'],
					$Result['fechor_visto'],
					$Result['titulo'],
					$Result['notificacion'],
					$Result['id_radica'],
					$Result['prioridad']
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
