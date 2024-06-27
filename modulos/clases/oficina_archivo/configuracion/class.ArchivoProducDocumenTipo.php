<?php
class ArchivoProducDocumenTipo{
	private $Accion;
	private $IdDocumen;
	private $NomDocumen;
	private $Descripcion;
	private $Acti;

	public function __construct($Accion = null, $IdDocumen = null, $NomDocumen = null, $Descripcion = null, $Acti = null){

		$this -> Accion        = $Accion;
		$this -> IdDocumen     = $IdDocumen;
		$this -> NomDocumen = $NomDocumen;
		$this -> Descripcion     = $Descripcion;
		$this -> Acti          = $Acti;
	}

	public function get_IdDocumen(){
		return $this -> IdDocumen;
	}

	public function get_NomDocumen(){
		return $this -> NomDocumen;
	}

	public function get_Descripcion(){
		return $this -> Descripcion;
	}

	public function get_Acti(){
		return $this -> Acti;
	}


	public function set_Accion($Accion) {
		$this -> Accion = $Accion;
	}

	public function set_IdDocumen($IdDocumen) {
		$this -> IdDocumen = $IdDocumen;
	}

	public function set_NomDocumen($NomDocumen) {
		$this -> NomDocumen = $NomDocumen;
	}

	public function set_Descripcion($Descripcion){
		$this -> Descripcion = $Descripcion;
	}

	public function set_Acti($Acti) {
		$this -> Acti = $Acti;
	}

	public function Gestionar(){
		$conexion = new Conexion();

		$ParameIfOficina = PDO::PARAM_STR;
        if($this->Descripcion == NULL){
            $ParameIfOficina = PDO::PARAM_NULL;
        }


		try{
			if($this->Accion == 'NUEVO_DOCUMENTO'){

				$Sql = "INSERT INTO archivo_digitales(nom_documen, descripcion)
						VALUES(:nom_documen, :descripcion)";

				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':nom_documen', $this->NomDocumen, PDO::PARAM_STR);
				$Instruc -> bindParam(':descripcion', $this->Descripcion, PDO::PARAM_STR);
			}

			$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			$this-> IdDocumen = $conexion -> lastInsertId();
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

	public static function Listar($Accion, $IdDocumen, $NomDocumen){
		$conexion = new Conexion();

		try{

			if($Accion == 1){
				/*********************************************************************************************
				* LISTO LOS TIPOS DE DOCUMENTOS ACTIVOS
				*********************************************************************************************/
				$Sql = "SELECT `id_documen`,`nom_documen`,`descripcion`,`acti`
						FROM `archivo_config_produ_docu_tipo`";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));

			}elseif($Accion == 2){
				/*********************************************************************************************
				* LISTO LOS TIPOS DE DOCUMENTOS ACTIVOS
				*********************************************************************************************/
				$Sql = "SELECT `id_documen`,`nom_documen`,`descripcion`,`acti`
						FROM `archivo_config_produ_docu_tipo`
						WHERE `acti` = 1";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
			}elseif($Accion == 3){
				#*********************************************************************************************
				# LISTO LOS EXPEDIENTES DE UNA SERIE Y SUBSERIE
				#*********************************************************************************************
				$Sql = "";

	            $Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':nom_documen', $IdDepen, PDO::PARAM_INT);
			}

			$Result = $Instruc->fetchAll();
			$conexion = null;
			return $Result;
		}catch(PDOException $e){
			echo 'Ha surgido un error y no se puede ejecutar la consulta.'.$e->getMessage();
			exit;
		}
	}

	public static function Buscar($Accion, $IdDocumen, $NomDocumen) {
		$conexion = new Conexion();

		try{

			if($Accion == 1){
				$Sql = "SELECT `id_documen`,`nom_documen`,`descripcion`,`acti`
						FROM `archivo_config_produ_docu_tipo`
						WHERE `id_documen` = 1;";

				$Instruc = $conexion->prepare($Sql);
			}

			$Instruc -> execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
			$Result = $Instruc->fetch();
			$conexion = null;

			if($Result){
				return new self("", $Result['id_documen'], $Result['nom_documen'], $Result['descripcion'], $Result['acti']);
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