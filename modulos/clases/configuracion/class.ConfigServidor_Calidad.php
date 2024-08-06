<?php
class ServidorCalidad
{
	private $Accion;
	private $IdRuta;
	private $Ip;
	private $Usua;
	private $Contra;
	private $Ruta;
	private $Observa;
	private $Acti;

	public function __construct(
		$Accion = null,
		$IdRuta = null,
		$Ip = null,
		$Usua = null,
		$Contra = null,
		$Ruta = null,
		$Observa = null,
		$Acti = null
	) {
		$this->Accion        = $Accion;
		$this->IdRuta        = $IdRuta;
		$this->Ip            = $Ip;
		$this->Usua          = $Usua;
		$this->Contra        = $Contra;
		$this->Ruta          = $Ruta;
		$this->Observa       = $Observa;
		$this->Acti          = $Acti;
	}

	public function get_IdRuta()
	{
		return $this->IdRuta;
	}

	public function get_Ip()
	{
		return $this->Ip;
	}

	public function get_Usua()
	{
		return $this->Usua;
	}

	public function get_Contra()
	{
		return $this->Contra;
	}

	public function get_Ruta()
	{
		return $this->Ruta;
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

	public function set_IdRuta($IdRuta)
	{
		$this->IdRuta = $IdRuta;
	}

	public function set_Ip($Ip)
	{
		$this->Ip = $Ip;
	}

	public function set_Usua($Usua)
	{
		$this->Usua = $Usua;
	}

	public function set_Contra($Contra)
	{
		$this->Contra = $Contra;
	}

	public function set_Ruta($Ruta)
	{
		$this->Ruta = $Ruta;
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
				$Sql = "INSERT INTO config_rutas_archi_calidad(ip, ruta, usua, contra, observa) 
						VALUES(:ip, :ruta, :usua, :contra, :observa)";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':ip', $this->Ip, PDO::PARAM_STR);
				$Instruc->bindParam(':ruta', $this->Ruta, PDO::PARAM_STR);
				$Instruc->bindParam(':usua', $this->Usua, PDO::PARAM_STR);
				$Instruc->bindParam(':contra', $this->Contra, PDO::PARAM_STR);
				$Instruc->bindParam(':observa', $this->Observa, PDO::PARAM_STR);
			} elseif ($this->Accion == 'EDITAR') {
				$Sql = "UPDATE config_rutas_archi_calidad
						SET ip = :ip, ruta = :ruta, usua = :usua, contra = :contra, observa = :observa, acti = :acti
						WHERE id_ruta = :id_ruta";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':ip', $this->Ip, PDO::PARAM_STR);
				$Instruc->bindParam(':ruta', $this->Ruta, PDO::PARAM_STR);
				$Instruc->bindParam(':usua', $this->Usua, PDO::PARAM_STR);
				$Instruc->bindParam(':contra', $this->Contra, PDO::PARAM_STR);
				$Instruc->bindParam(':observa', $this->Observa, PDO::PARAM_STR);
				$Instruc->bindParam(':acti', $this->Acti, PDO::PARAM_INT);
				$Instruc->bindParam(':id_ruta', $this->IdRuta, PDO::PARAM_INT);
			} elseif ($this->Accion == 'ELIMINAR') {
				$Sql = "DELETE FROM config_rutas_archi_calidad
						WHERE id_ruta = :id_ruta";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_ruta', $this->IdRuta, PDO::PARAM_INT);
			} elseif ($this->Accion == 'ACTIVAR') {
				$Sql = "UPDATE config_rutas_archi_calidad
						SET  acti = :acti
						WHERE id_ruta = :id_ruta";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':acti', $this->Acti, PDO::PARAM_INT);
				$Instruc->bindParam(':id_ruta', $this->IdRuta, PDO::PARAM_INT);
			}

			$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			$this->IdDigital = $conexion->lastInsertId();
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

	public static function Listar($Accion, $IdRuta, $Ruta, $TipoCorrespon)
	{
		$conexion = new Conexion();

		try {
			if ($Accion == 1) {
				/******************************************************************************************/
				/*  LISTO TODOS LOS REGISTROS
		        /******************************************************************************************/
				$Sql = "SELECT *
		        		FROM config_rutas_archi_calidad
		        		ORDER BY ruta ASC";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 2) {
				/******************************************************************************************/
				/*  LISTO UN REGISTROS
		        /******************************************************************************************/
				$Sql = "SELECT *
		        		FROM config_rutas_archi_calidad
		        		WHERE id_ruta = :id_ruta";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(":id_ruta", $IdRuta, PDO::PARAM_STR);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 3) {
				/******************************************************************************************/
				/*  BUSCO LA RUTA QUE ESTE ACTIVA DE UNA DEPENDENCIA
		        /******************************************************************************************/
				$Sql = "SELECT *
		        		FROM config_rutas_archi_calidad
		        		WHERE acti = 1";
				$Instruc = $conexion->prepare($Sql);
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

	public static function Buscar($Accion, $IdRuta, $Ruta)
	{
		$conexion = new Conexion();

		try {

			if ($Accion == 1) {
				/******************************************************************************************/
				/*  LISTO TODOS LOS REGISTROS
		        /******************************************************************************************/
				$Sql = "SELECT *
						FROM config_rutas_archi_calidad
						ORDER BY ruta ASC";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 2) {
				/******************************************************************************************/
				/*  LISTO UN REGISTROS
		        /******************************************************************************************/
				$Sql = "SELECT * FROM config_rutas_archi_calidad WHERE id_ruta = :id_ruta";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(":id_ruta", $IdRuta, PDO::PARAM_STR);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 3) {
				/******************************************************************************************/
				/*  BUSCO LA RUTA QUE ESTE ACTIVA
		        /******************************************************************************************/
				$Sql = "SELECT * FROM config_rutas_archi_calidad WHERE acti = 1";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 4) {
				/******************************************************************************************/
				/*  BUSCO UNA RUTA
		        /******************************************************************************************/
				$Sql = "SELECT *
		        		FROM config_rutas_archi_calidad
		        		WHERE ruta = :ruta";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(":ruta", $Ruta, PDO::PARAM_STR);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			}

			$Result = $Instruc->fetch();
			$conexion = null;

			if ($Result) {
				return new self(
					"",
					$Result['id_ruta'],
					$Result['ip'],
					$Result['usua'],
					$Result['contra'],
					$Result['ruta'],
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
