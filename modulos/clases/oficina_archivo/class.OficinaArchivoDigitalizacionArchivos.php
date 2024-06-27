<?php
class DigitalizacionArchivos{
	private $Accion;
	private $IdArchivo;
	private $IdRuta;
	private $IdDigital;
	private $IdTipoDocu;
	private $Archivo;
	private $Folios;
	private $Detalle;
	private $Fecha;
	private $FechaRegistro;
	private $Tipo;

	public function __construct($Accion = null, $IdArchivo = null, $IdRuta = null, $IdDigital = null, $IdTipoDocu = null,  $Archivo = null, $Folios = null,
								$Detalle = null, $Fecha = null, $FechaRegistro = null, $Tipo = null){

		$this -> Accion        = $Accion;
		$this -> IdArchivo     = $IdArchivo;
		$this -> IdRuta        = $IdRuta;
		$this -> IdDigital     = $IdDigital;
		$this -> IdTipoDocu    = $IdTipoDocu;
		$this -> Archivo       = $Archivo;
		$this -> Folios        = $Folios;
		$this -> Detalle       = $Detalle;
		$this -> Fecha         = $Fecha;
		$this -> FechaRegistro = $FechaRegistro;
		$this -> Tipo          = $Tipo;
	}

	public function get_IdArchivo(){
		return $this -> IdArchivo;
	}

	public function get_IdRuta(){
		return $this -> IdRuta;
	}

	public function get_IdDigital(){
		return $this -> IdDigital;
	}

	public function get_IdTipoDocu(){
		return $this -> IdTipoDocu;
	}

	public function get_Archivo(){
		return $this -> Archivo;
	}

	public function get_Folios(){
		return $this -> Folios;
	}

	public function get_Detalle(){
		return $this -> IdForma;
	}

	public function get_Fecha(){
		return $this -> Fecha;
	}

	public function get_FechaRegistro(){
		return $this -> FechaRegistro;
	}

	public function get_Tipo(){
		return $this -> Tipo;
	}


	public function set_Accion($Accion) {
		$this -> Accion = $Accion;
	}

	public function set_IdArchivo($IdArchivo) {
		$this -> IdArchivo = $IdArchivo;
	}

	public function set_IdRuta($IdRuta) {
		$this -> IdRuta = $IdRuta;
	}

	public function set_IdDigital($IdDigital) {
		$this -> IdDigital = $IdDigital;
	}

	public function set_IdTipoDocu($IdTipoDocu){
		$this -> IdTipoDocu = $IdTipoDocu;
	}

	public function set_Archivo($Archivo) {
		$this -> Archivo = $Archivo;
	}

	public function set_Folios($Folios) {
		$this -> Folios = $Folios;
	}

	public function set_Detalle($Detalle) {
		$this -> Detalle = $Detalle;
	}

	public function set_Fecha($Fecha) {
		$this -> Fecha = $Fecha;
	}

	public function set_FechaRegistro($FechaRegistro) {
		$this -> FechaRegistro = $FechaRegistro;
	}

	public function set_Tipo($Tipo) {
		$this -> Tipo = $Tipo;
	}

	public function Gestionar(){
		$conexion = new Conexion();

		$ParameFecha = PDO::PARAM_STR;
		if($this->Fecha == ""){
            $ParameFecha = PDO::PARAM_NULL;
        }

        $ParameTipoDocumental = PDO::PARAM_STR;
        if($this->IdTipoDocu == ''){
            $ParameTipoDocumental = PDO::PARAM_NULL;
        }

		try{
			if($this->Accion == 'INSERTAR_ARCHIVO'){
				$Sql = "INSERT INTO archivo_digitales_detalle(id_digital, id_ruta, id_tipodoc, archivo, folios, detalle, fecha, tipo)
						VALUES(:id_digital, :id_ruta, :id_tipodoc, :archivo, :folios, :detalle, :fecha, :tipo)";

				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_digital', $this->IdDigital, PDO::PARAM_INT);
				$Instruc -> bindParam(':id_ruta', $this->IdRuta, PDO::PARAM_INT);
				$Instruc -> bindParam(':id_tipodoc', $this->IdTipoDocu, $ParameTipoDocumental);
				$Instruc -> bindParam(':archivo', $this->Archivo, PDO::PARAM_STR);
				$Instruc -> bindParam(':folios', $this->Folios, PDO::PARAM_STR);
				$Instruc -> bindParam(':detalle', $this->Detalle, PDO::PARAM_STR);
				$Instruc -> bindParam(':fecha', $this->Fecha, $ParameFecha);
				$Instruc -> bindParam(':tipo', $this->Tipo, PDO::PARAM_STR);

			}elseif($this->Accion == 'ACTUALIZAR_ARCHIVO'){
				$Sql = "UPDATE archivo_digitales_detalle SET archivo = :archivo, folios = :folios, detalle = :detalle, fecha = :fecha, tipo = :tipo
						WHERE id_archivo = :id_archivo";

				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_archivo', $this->IdArchivo, PDO::PARAM_INT);
				$Instruc -> bindParam(':archivo', $this->Archivo, PDO::PARAM_STR);
				$Instruc -> bindParam(':folios', $this->Folios, PDO::PARAM_STR);
				$Instruc -> bindParam(':detalle', $this->Detalle, PDO::PARAM_STR);
				$Instruc -> bindParam(':fecha', $this->Fecha, $ParameFecha);
				$Instruc -> bindParam(':tipo', $this->Tipo, PDO::PARAM_STR);
			}elseif($this->Accion == 'ELIMINAR_ARCHIVO'){
				$Sql = "DELETE FROM archivo_digitales_detalle
						WHERE id_archivo = :id_archivo";

				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_archivo', $this->IdArchivo, PDO::PARAM_INT);
			}

			$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			$this-> IdArchivo = $conexion->lastInsertId();
			$conexion = null;

			if($Instruc){
				return true;
			}else{
				return false;
			}
		}catch(PDOException $e){
			echo 'Ha surgido un error y no se puede ejecutar la consulta.'.$e->getMessage();
			exit;
		}
	}

	public static function Listar($Accion, $IdArchivo, $IdDigital, $Archivo, $IdTipoDocu){
		$conexion = new Conexion();

		try{

			if($Accion == 1){
				/*********************************************************************************************
				* LISTO LOS ARCHIVOS DE SE CARGARON COMO LISTA DE CHEKECO
				*********************************************************************************************/
				$Sql = "SELECT *
						FROM archivo_digitales_detalle
						WHERE id_digital = :id_digital AND id_tipodoc = :id_tipodoc AND tipo = 'Lista de Checkeo'";
				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_digital', $IdArchivo, PDO::PARAM_INT);
				$Instruc -> bindParam(':id_tipodoc', $IdTipoDocu, PDO::PARAM_INT);
			}elseif($Accion == 2){
				/*********************************************************************************************
				* LISTO LOS ARCHIVOS QUE SE CARGARON COMO UN TODO
				*********************************************************************************************/
				$Sql = "SELECT *
						FROM archivo_digitales_detalle
						WHERE id_digital = :id_digital AND tipo = 'Como Un Todo'";
				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_digital', $IdArchivo, PDO::PARAM_INT);
			}

			$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			$Result = $Instruc->fetchAll();
			$conexion = null;
			return $Result;
		}catch(PDOException $e){
			echo 'Ha surgido un error y no se puede ejecutar la consulta.'.$e->getMessage();
			exit;
		}
	}

	public static function Buscar($Accion, $IdArchivo, $IdDigital, $Archivo, $IdTipoDocu) {
		$conexion = new Conexion();

		try{

			if($Accion == 1){
				$Sql = "SELECT * FROM archivo_digitales_detalle
						WHERE id_archivo = :Detalle AND id_depen = :id_depen AND id_serie = :id_serie AND id_subserie = :id_subserie";

				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_archivo', $Detalle, PDO::PARAM_STR);
			}

			$Instruc -> execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
			$Result = $Instruc->fetch();
			$conexion = null;

			if($Result){
				return new self("", $Result['id_archivo'], $Result['id_ruta'], $Result['id_digital'], $Result['id_tipodoc'], $Result['archivo'], $Result['folios'],
					$Result['detalle'], $Result['fecha'], $Result['fec_registro'], $Result['tipo']);
			}else{
				return false;
			}
		}catch(PDOException $e){
			echo 'Ha surgido un error y no se puede ejecutar la consulta.'.$e->getMessage();
			exit;
		}
	}
}
?>