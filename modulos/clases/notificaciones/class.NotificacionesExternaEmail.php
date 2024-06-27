<?php
class NotificacionExternaEmail{
	private $Accion;
	private $IdNotifica;
	private $IdFuncioRegistra;
	private $FuncioDeta;
	private $FecHorNotifica;
	private $Titulo;
	private $Notificacion;
	private $IdRadica;
	private $Email;

	public function __construct($Accion = null, $IdNotifica= null, $IdFuncioRegistra = null, $FuncioDeta = null, $FecHorNotifica = null, $Titulo = null, $Notificacion = null, $IdRadica = null, $Email = null){

		$this -> Accion           = $Accion;
		$this -> IdNotifica       = $IdNotifica;
		$this -> IdFuncioRegistra = $IdFuncioRegistra;
		$this -> FuncioDeta       = $FuncioDeta;
		$this -> FecHorNotifica   = $FecHorNotifica;
		$this -> Titulo           = $Titulo;
		$this -> Notificacion     = $Notificacion;
		$this -> IdRadica         = $Notificacion;
		$this -> Email            = $Email;
	}

	public function getId_Notifica() {
		return $this -> IdNotifica;
	}

	public function get_IdFuncioRegistra() {
		return $this -> IdFuncioRegistra;
	}

	public function getId_FuncioDeta() {
		return $this -> FuncioDeta;
	}

	public function get_FecHorNotifica() {
		return $this -> FecHorNotifica;
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
		return $this -> Email;
	}

	public function setAccion($Accion) {
		$this -> Accion = $Accion;
	}

	public function setId_IdNotifica($IdNotifica) {
		$this -> IdNotifica = $IdNotifica;
	}

	public function set_IdFuncioRegistra($IdFuncioRegistra) {
		$this-> IdFuncioRegistra = $IdFuncioRegistra;
	}

	public function setId_FuncioDeta($FuncioDeta) {
		$this -> FuncioDeta = $FuncioDeta;
	}

	public function set_FecHorNotifica($FecHorNotifica) {
		$this -> FecHorNotifica = $FecHorNotifica;
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

	public function set_Email($Email) {
		return $this -> Email = $Email;
	}

	public function Gestionar() {
		$conexion = new Conexion();

		try{

			if($this->Accion == "INSERTAR_NOTIFICACION"){
				$Sql = "INSERT INTO `notifical_externa_email`(`id_usua_registra`, `id_funcio_deta`, `titulo`, `notificacion`, `id_radica`, `email`)
						VALUES (:id_usua_registra, :id_funcio_deta, :titulo, :notificacion, :id_radica, :email);";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->bindParam(':id_usua_registra', $this->IdFuncioRegistra, PDO::PARAM_INT);
				$Instruc->bindParam(':id_funcio_deta', $this->FuncioDeta, PDO::PARAM_INT);
				$Instruc->bindParam(':titulo', $this->Titulo, PDO::PARAM_STR);
				$Instruc->bindParam(':notificacion', $this->Notificacion, PDO::PARAM_STR);
				$Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
				$Instruc->bindParam(':email', $this->Email, PDO::PARAM_INT);
			}

			$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			$conexion = null;

			if($Instruc){
				return true;
			}else{
				return false;
			}
		}catch(PDOException $e){
			echo 'Ha surgido un error y no se puede ejecutar la consulta Notificaicones Externaas, '.$this->Accion." - ".$e->getMessage();
			exit;
		}
	}

	public static function Listar($Accion, $IdNotifica, $IdFuncio, $IdRadica) {
		$conexion = new Conexion();

		try{

			if($Accion == 1){

				$Sql = "SELECT `notifical_externa_email`.*
						FROM `notifical_externa_email`
						WHERE (`id_funcio_deta` = :id_funcio_deta AND `fechor_visto` IS NULL)
						ORDER BY fechor_notifica DESC
						limit 0, 50;";

				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_funcio_deta', $IdFuncio, PDO::PARAM_INT);
				$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
				$Result = $Instruc->fetchAll();
			}elseif($Accion == 2){

				$Sql = "SELECT `notifical_externa_email`.*
						FROM `notifical_externa_email`
						WHERE (`id_radica` = :id_radica)";

				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_radica', $IdRadica, PDO::PARAM_INT);
				$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
				$Result = $Instruc->fetchAll();
			}

			
			$conexion = null;
			return $Result;
		}catch(PDOException $e){
			echo 'Ha surgido un error y no se puede ejecutar la consulta Notificacion Externa por Email- Listar -> '.$Accion." - ".$e->getMessage();
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
				return new self("", $Result['id_notifica'], $Result['id_usua_registra'], $Result['id_funcio_deta'], $Result['fechor_notifica'], $Result['titulo'], $Result['notificacion'], $Result['id_radica'], $Result['email']);
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