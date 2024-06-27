<?php
class ServidorDigitalizacion
{
	private $Accion;
	private $IdRuta;
	private $Servidor;
	private $Usua;
	private $Contra;
	private $Ruta;
	private $Observa;
	private $Tipo;
	private $Acti;

	public function __construct(
		$Accion = null,
		$IdRuta = null,
		$Servidor = null,
		$Usua = null,
		$Contra = null,
		$Ruta = null,
		$Observa = null,
		$Tipo = null,
		$Acti = null
	) {

		$this->Accion   = $Accion;
		$this->IdRuta   = $IdRuta;
		$this->Servidor = $Servidor;
		$this->Usua     = $Usua;
		$this->Contra   = $Contra;
		$this->Ruta     = $Ruta;
		$this->Observa  = $Observa;
		$this->Tipo     = $Tipo;
		$this->Acti     = $Acti;
	}

	public function get_IdRuta()
	{
		return $this->IdRuta;
	}

	public function get_Servidor()
	{
		return $this->Servidor;
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

	public function get_Tipo()
	{
		return $this->Tipo;
	}

	public function set_Accion($Accion)
	{
		return $this->Accion = $Accion;
	}

	public function set_IdRuta($IdRuta)
	{
		return $this->IdRuta = $IdRuta;
	}

	public function set_Servidor($Servidor)
	{
		return $this->Servidor = $Servidor;
	}

	public function set_Usua($Usua)
	{
		return $this->Usua = $Usua;
	}

	public function set_Contra($Contra)
	{
		return $this->Contra = $Contra;
	}

	public function set_Ruta($Ruta)
	{
		return $this->Ruta = $Ruta;
	}

	public function set_Observa($Observa)
	{
		return $this->Observa = $Observa;
	}

	public function set_Tipo($Tipo)
	{
		return $this->Tipo = $Tipo;
	}

	public function set_Acti($Acti)
	{
		return $this->Acti = $Acti;
	}

	public function Gestionar()
	{
		$conexion = new Conexion();

		try {
			if ($this->Accion == 'INSERTAR') {
				$Sql = "INSERT INTO config_rutas_archi_digitalizados(servidor, ruta, usua, contra, tipo, acti) 
						VALUES(:servidor, :ruta, :usua, :contra, 1)";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':servidor', $this->Servidor, PDO::PARAM_STR);
				$Instruc->bindParam(':ruta', $this->Ruta, PDO::PARAM_STR);
				$Instruc->bindParam(':tipo', $this->Tipo, PDO::PARAM_STR);
				$Instruc->bindParam(':usua', $this->Usua, PDO::PARAM_STR);
				$Instruc->bindParam(':contra', $this->Contra, PDO::PARAM_STR);
			}
			if ($this->Accion == 'EDITAR') {
				$Sql = "UPDATE config_rutas_archi_digitalizados 
						SET servidor = :servidor, ruta = :ruta, usua = :usua, contra = :contra, tipo = :tipo, acti = :acti 
						WHERE id_ruta = :id_ruta";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':servidor', $this->Servidor, PDO::PARAM_STR);
				$Instruc->bindParam(':ruta', $this->Ruta, PDO::PARAM_STR);
				$Instruc->bindParam(':usua', $this->Usua, PDO::PARAM_STR);
				$Instruc->bindParam(':contra', $this->Contra, PDO::PARAM_STR);
				$Instruc->bindParam(':tipo', $this->Tipo, PDO::PARAM_STR);
				$Instruc->bindParam(':acti', $this->Acti, PDO::PARAM_INT);
				$Instruc->bindParam(':id_ruta', $this->IdRuta, PDO::PARAM_INT);
			} elseif ($this->Accion == 'ELIMINAR') {
				$Sql = "DELETE FROM config_rutas_archi_digitalizados 
						WHERE id_ruta = :id_ruta";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_ruta', $this->IdRuta, PDO::PARAM_INT);
			} elseif ($this->Accion == 'ACTIVAR') {
				$Sql = "UPDATE config_rutas_archi_digitalizados 
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

	public static function Listar($Accion, $IdRutaRuta, $Ruta)
	{
		$conexion = new Conexion();

		try {
			if ($Accion == 1) {
				/******************************************************************************************/
				/*  LISTO TODOS LOS REGISTROS
		        /******************************************************************************************/
				$Sql = "SELECT * FROM config_rutas_archi_digitalizados ORDER BY ruta ASC";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 2) {
				/******************************************************************************************/
				/*  LISTO UN REGISTROS
		        /******************************************************************************************/
				$Sql = "SELECT * FROM config_rutas_archi_digitalizados WHERE id_ruta = :id_ruta";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_ruta', $IdRuta, PDO::PARAM_INT);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			} elseif ($Accion == 3) {
				/******************************************************************************************/
				/*  BUSCO LA RUTA QUE ESTE ACTIVA DE UNA DEPENDENCIA
		        /******************************************************************************************/
				$Sql = "SELECT * FROM config_rutas_archi_digitalizados WHERE acti = 1";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			}


			$Instruc = $conexion->prepare($Sql);
			$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));

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
						FROM config_rutas_archi_digitalizados 
						ORDER BY ruta ASC";
				$Instruc = $conexion->prepare($Sql);
			} elseif ($Accion == 2) {
				/******************************************************************************************/
				/*  LISTO EL SERVIDOR PARA LOS ARCHIVOS DIGITALIZADOS CON TRD
		        /******************************************************************************************/
				$Sql = "SELECT * 
		        		FROM config_rutas_archi_digitalizados 
		        		WHERE id_ruta = :id_ruta AND tipo = 'TRD'";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_ruta', $IdRuta, PDO::PARAM_INT);
			} elseif ($Accion == 3) {
				/******************************************************************************************/
				/*  BUSCO LA RUTA QUE ESTE ACTIVA PARA LOS ARCHIVOS DIGITALIZADOS CON TRD
		        /******************************************************************************************/
				$Sql = "SELECT * 
		        		FROM config_rutas_archi_digitalizados 
		        		WHERE acti = 1 AND tipo = 'TRD'";
				$Instruc = $conexion->prepare($Sql);
			} elseif ($Accion == 4) {
				/******************************************************************************************/
				/*  LISTO EL SERVIDOR PARA LOS ARCHIVOS DIGITALIZADOS CON TvD
		        /******************************************************************************************/
				$Sql = "SELECT * 
		        		FROM config_rutas_archi_digitalizados 
		        		WHERE id_ruta = :id_ruta AND tipo = 'TVD'";
				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_ruta', $IdRuta, PDO::PARAM_INT);
			} elseif ($Accion == 5) {
				/******************************************************************************************/
				/*  BUSCO LA RUTA QUE ESTE ACTIVA PARA LOS ARCHIVOS DIGITALIZADOS CON TvD
		        /******************************************************************************************/
				$Sql = "SELECT * 
		        		FROM config_rutas_archi_digitalizados 
		        		WHERE acti = 1 AND tipo = 'TVD'";
				$Instruc = $conexion->prepare($Sql);
			}

			$Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
			$Result = $Instruc->fetch();
			$conexion = null;

			if ($Result) {
				return new self(
					"",
					$Result['id_ruta'],
					$Result['servidor'],
					$Result['usua'],
					$Result['contra'],
					$Result['ruta'],
					$Result['observa'],
					$Result['tipo'],
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
