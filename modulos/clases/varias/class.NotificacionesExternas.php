<?php
class NotificacionesExternas{
	private $Accion;
	private $IdNotifica;
	private $IdFuncioDeta;
	private $IdModulo;
	private $FecHorNotifica;
	private $FecHorVisto;
	private $Titulo;
	private $Notificacion;

	public function __construct($IdNotifica= null, $IdFuncioDeta = null, $IdModulo = null, $FecHorNotifica = null, $FecHorVisto = null, $Titulo = null,
								$Notificacion = null){

		$this -> IdNotifica     = $IdNotifica;
		$this -> IdFuncioDeta   = $IdFuncioDeta;
		$this -> IdModulo       = $IdModulo;
		$this -> FecHorNotifica = $FecHorNotifica;
		$this -> FecHorVisto    = $FecHorVisto;
		$this -> Titulo         = $Titulo;
		$this -> Notificacion   = $Notificacion;
	}

	public function getId_Notifica() {
		return $this -> IdNotifica;
	}

	public function getId_FuncioDeta() {
		return $this -> IdFuncioDeta;
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


	public function setId_IdNotifica($IdNotifica) {
		$this -> IdNotifica = $IdNotifica;
	}

	public function setId_FuncioDeta($IdFuncioDeta) {
		$this -> IdFuncioDeta = $IdFuncioDeta;
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

	public function Guardar() {
		$conexion = new Conexion();


		}
	}

	public static function Listar($Accion, $IdNotifica, $IdFuncioDeta, $IdModulo) {
		$conexion = new Conexion();

		try{

			if($Accion == 1){

				$Sql = "SELECT `notifica`.`id_notifica`, `notifica`.`id_funcio_deta`, `notifica`.`id_modu`, `notifica`.`fechor_notifica`,
							`notifica`.`fechor_visto`, `notifica`.`titulo`, `notifica`.`notificacion`, `modu`.`link`
						FROM `notifica_externa` AS `notifica`
						    INNER JOIN `segu_modu` AS `modu` ON (`notifica`.`id_modu` = `modu`.`id_modu`)
						WHERE (`notifica`.`id_funcio_deta` = :id_funcio_deta)";

				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_funcio_deta', $IdFuncioDeta, PDO::PARAM_INT);
				$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			}

			$Result = $Instruc->fetchAll();
			$conexion = null;
			return $Result;
		}catch(PDOException $e){
			echo 'Ha surgido un error y no se puede ejecutar la consulta.'.$e->getMessage();
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
				return new self($Result['id_notifica'], $Result['id_funcio_deta'], $Result['id_modu'], $Result['fechor_notifica'], $Result['fechor_visto'], $Result['titulo'], $Result['notificacion']);
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