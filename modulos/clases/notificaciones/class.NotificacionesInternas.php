<?php
class NotificacionInterna{
	private $Accion;
	private $IdNotifica;
	private $IdUsua;
	private $IdModulo;
	private $FecHorNotifica;
	private $FecHorVisto;
	private $Titulo;
	private $Notificacion;
	private $IdRadica;
	private $Prioridad;

	public function __construct($IdNotifica= null, $IdUsua = null, $IdModulo = null, $FecHorNotifica = null, $FecHorVisto = null, $Titulo = null, $Notificacion = null, $IdRadica = null, $Prioridad = null){

		$this -> IdNotifica     = $IdNotifica;
		$this -> IdUsua         = $IdUsua;
		$this -> IdModulo       = $IdModulo;
		$this -> FecHorNotifica = $FecHorNotifica;
		$this -> FecHorVisto    = $FecHorVisto;
		$this -> Titulo         = $Titulo;
		$this -> Notificacion   = $Notificacion;
		$this -> IdRadica       = $Notificacion;
		$this -> Prioridad      = $Prioridad;
	}

	public function getId_Notifica() {
		return $this -> IdNotifica;
	}

	public function getId_FuncioDeta() {
		return $this -> IdUsua;
	}

	public function getId_Modulo() {
		return $this -> IdModulo;
	}

	public function get_FecHorNotifica() {
		return $this -> FecHorNotifica;
	}

	public function get_FecHorVisto() {
		return $this -> FecHorVisto;
	}

	public function get_Titulo() {
		return $this -> Titulo;
	}

	public function get_Notificacion() {
		return $this -> Notificacion;
	}

	public function get_IdRadica() {
		return $this -> IdRadica;
	}

	public function get_Priorida() {
		return $this -> Prioridad;
	}


	public function setId_IdNotifica($IdNotifica) {
		$this -> IdNotifica = $IdNotifica;
	}

	public function setId_FuncioDeta($IdUsua) {
		$this -> IdUsua = $IdUsua;
	}

	public function setId_IdModulo($IdModulo) {
		$this -> IdModulo = $IdModulo;
	}

	public function set_FecHorNotifica($FecHorNotifica) {
		$this -> FecHorNotifica = $FecHorNotifica;
	}

	public function set_FecHorVisto($FecHorVisto) {
		$this-> FecHorVisto = $FecHorVisto;
	}

	public function set_Titulo($Titulo) {
		$this -> Titulo = $Titulo;
	}

	public function set_Notificacion($Notificacion) {
		$this -> Notificacion = $Notificacion;
	}

	public function set_IdRadica($IdRadica) {
		return $this -> IdRadica = $IdRadica;
	}

	public function set_Priorida($Prioridad) {
		return $this -> Prioridad = $Prioridad;
	}

	public function Guardar() {
		$conexion = new Conexion();

		try{

			if($this->Accion == "INSERTAR_NOTIFICACION"){
				$Sql = "INSERT INTO `notifica_interna`(`id_funcio_deta`, `id_modu`, `titulo`, `notificacion`, `id_radica`, `prioridad`)
						VALUES (:id_usua, :id_modu, :titulo, :notificacion, :id_radica, :prioridad);";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_usua', $this->IdUsua, PDO::PARAM_INT);
				$Instruc->bindParam(':id_modu', $this->IdModulo, PDO::PARAM_INT);
				$Instruc->bindParam(':titulo', $this->Titulo, PDO::PARAM_STR);
				$Instruc->bindParam(':notificacion', $this->Notificacion, PDO::PARAM_STR);
				$Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
				$Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_INT);
			}

		}catch(PDOException $e){
			echo 'Ha surgido un error y no se puede ejecutar la consulta.'.$e->getMessage();
			exit;
		}
	}

	public static function Listar($Accion, $IdNotifica, $IdFuncio, $IdModulo) {
		$conexion = new Conexion();

		try{

			if($Accion == 1){

				$Sql = "SELECT `notifica_interna`.*
						FROM `notifica_interna`
						WHERE (`notifica_interna`.`id_funcio_deta` = :id_usua)
						ORDER BY fechor_notifica DESC
						limit 0, 50;";

				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_usua', $IdFuncio, PDO::PARAM_INT);
				$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
				$Result = $Instruc->fetchAll();
			}

			
			$conexion = null;
			return $Result;
		}catch(PDOException $e){
			echo 'Ha surgido un error y no se puede ejecutar la consulta Notificacion - Listar -> '.$Accion." - ".$e->getMessage();
			exit;
		}
	}

	public static function Buscar($Accion, $IdNotifica, $IdModulo, $FecHorNotifica) {
		$conexion = new Conexion();

		try{

			if($Accion == 1){

				$Sql = "";
				$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			}

	        $Instruc -> execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
			$Result = $Instruc->fetch();
			$conexion = null;

			if($Result){
				return new self("", $Result['id_notifica'], $Result['id_funcio_deta'], $Result['id_modu'], $Result['fechor_notifica'], $Result['fechor_visto'], $Result['titulo'], $Result['notificacion'], 
							$Result['id_radica'], $Result['prioridad']);
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