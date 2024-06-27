<?php
class ArchivoProducDocumenTipoComponen{
	private $Accion;
	private $IdCompo;
	private $IdDocumen;
	private $NomCompo;
	private $Descripcion;
	private $Posicion;
	private $Acti;

	public function __construct($Accion = null, $IdCompo = null, $IdDocumen = null, $NomCompo = null, $Descripcion = null, $Posicion = null, $Acti = null){

		$this -> Accion        = $Accion;
		$this -> IdCompo     = $IdCompo;
		$this -> IdDocumen    = $IdDocumen;
		$this -> NomCompo   = $NomCompo;
		$this -> Descripcion   = $Descripcion;
		$this -> Posicion   = $Posicion;
		$this -> Acti          = $Acti;
	}

	public function get_IdCompo(){
		return $this -> IdCompo;
	}

	public function get_IdDocumen(){
		return $this -> IdDocumen;
	}

	public function get_NomCompo(){
		return $this -> NomCompo;
	}

	public function get_Descripcion(){
		return $this -> Descripcion;
	}

	public function get_Posicion(){
		return $this -> Posicion;
	}

	public function get_Acti(){
		return $this -> Acti;
	}

	public function set_Accion($Accion) {
		$this -> Accion = $Accion;
	}

	public function set_IdCompo($IdCompo) {
		$this -> IdCompo = $IdCompo;
	}

	public function set_IdDocumen($IdDocumen) {
		$this -> IdDocumen = $IdDocumen;
	}

	public function set_NomCompo($NomCompo){
		$this->NomCompo = $NomCompo;
	}

	public function set_Descripcion($Descripcion){
		$this -> Descripcion = $Descripcion;
	}

	public function set_Posicion($Posicion){
		$this -> Posicion = $Posicion;
	}

	public function set_Acti($Acti) {
		$this -> Acti = $Acti;
	}

	public function Gestionar(){
		$conexion = new Conexion();

		try{
			if($this->Accion == 'NUEVO_DOCUMENTO'){

				$Sql = "INSERT INTO `archivo_config_produ_docu_compo`(`id_documen`, `nom_compo`, `descripcion`, `posicion`)
						VALUES ('id_documen', 'nom_compo', 'descripcion', 'posicion')";

				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_documen', $this->IdDocumen, PDO::PARAM_INT);
				$Instruc -> bindParam(':nom_compo', $this->NomCompo, PDO::PARAM_STR);
				$Instruc -> bindParam(':descripcion', $this->Descripcion, PDO::PARAM_STR);
				$Instruc -> bindParam(':posicion', $this->Posicion, PDO::PARAM_INT);
			}

			$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			$this-> IdCompo = $conexion -> lastInsertId();
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

	public static function Listar($Accion, $IdCompo, $IdDocumen){
		$conexion = new Conexion();

		try{

			if($Accion == 1){
				/*********************************************************************************************
				* LISTO LOS COMPONENTES DE UN TIPOS DE DOCUMENTO
				*********************************************************************************************/
				$Sql = "SELECT `id_compo`, `id_documen`, `nom_compo`, `descripcion`, `posicion`, `acti`
						FROM `archivo_config_produ_docu_compo`";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));

			}elseif($Accion == 2){
				/*********************************************************************************************
				* LISTO LOS TIPOS DE DOCUMENTOS ACTIVOS
				*********************************************************************************************/
				$Sql = "SELECT `id_compo`, `id_documen`, `nom_compo`, `descripcion`, `posicion`, `num_filas`, `acti`
						FROM `archivo_config_produ_docu_compo`
						WHERE `id_documen` = :id_documen
						ORDER BY `posicion` ASC";

				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_documen', $IdDocumen, PDO::PARAM_INT);
				$Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
			}

			$Result = $Instruc->fetchAll();
			$conexion = null;
			return $Result;
		}catch(PDOException $e){
			echo 'Ha surgido un error y no se puede ejecutar la consulta.'.$e->getMessage();
			exit;
		}
	}

	public static function Buscar($Accion, $IdCompo, $IdDocumen) {
		$conexion = new Conexion();

		try{

			if($Accion == 1){
				$Sql = "SELECT `id_documen`,`nom_documen`,`NomCompo`,`acti`
						FROM `archivo_config_produ_docu_tipo`
						WHERE `id_documen` = 1;";

				$Instruc = $conexion->prepare($Sql);
			}

			$Instruc -> execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
			$Result = $Instruc->fetch();
			$conexion = null;

			if($Result){
				return new self("", $Result['id_compo'], $Result['id_documen'], $Result['nom_compo'], $Result['descripcion'], $Result['posicion'], $Result['acti']);
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