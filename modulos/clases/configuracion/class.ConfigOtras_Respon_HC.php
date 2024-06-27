<?php
class ConfigOtrasResponsableHC{
	private $Accion;
	private $IdDepen;
	private $IdFuncioDeta;
	private $IdSerie;
	private $IdSubSerie;
	private $TipoDocumen;
	
	public function __construct($Accion = null, $IdDepen = null, $IdFuncioDeta = null, $IdSerie = null, $IdSubSerie = null, $TipoDocumen = null){
		$this -> Accion       = $Accion;
		$this -> IdDepen      = $IdDepen;
		$this -> IdFuncioDeta = $IdFuncioDeta;
		$this -> IdSerie      = $IdSerie;
		$this -> IdSubSerie  = $IdSubSerie;
		$this -> TipoDocumen  = $TipoDocumen;
	}

	public function get_IdDepen(){
		return $this -> IdDepen;
	}

	public function get_IdFuncioDeta(){
		return $this -> IdFuncioDeta;
	}

	public function get_IdSerie(){
		return $this -> IdSerie;
	}

	public function get_IdSubSerie(){
		return $this -> IdSubSerie;
	}

	public function get_TipoDocumen(){
		return $this -> TipoDocumen;
	}

	/////////////////////////////////////
	public function set_Accion($Accion){
		return $this -> Accion = $Accion;
	}

	public function set_IdDepen($IdDepen){
		return $this -> IdDepen = $IdDepen;
	}

	public function set_IdFuncioDeta($IdFuncioDeta){
		return $this -> IdFuncioDeta = $IdFuncioDeta;
	}

	public function set_IdSerie($IdSerie){
		return $this -> IdSerie = $IdSerie;
	}

	public function set_IdSubSerie($IdSubSerie){
		return $this -> IdSubSerie = $IdSubSerie;
	}

	public function set_TipoDocumen($TipoDocumen){
		return $this -> TipoDocumen = $TipoDocumen;
	}

	public function Gestionar(){
		$conexion = new Conexion();
		$conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		try{
			if($this->Accion == 'INSERTAR_RESPONSABLE'){
				$Sql = "INSERT INTO config_otras_responsables_hc(id_funcio_deta, id_depen, id_serie, id_subserie, id_tipodoc) 
						VALUES(:id_funcio_deta, :id_depen, :id_serie, :id_subserie, :id_tipodoc)";
				
				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_funcio_deta', $this->IdFuncioDeta, PDO::PARAM_INT);
				$Instruc -> bindParam(':id_depen', $this->IdDepen, PDO::PARAM_INT);
				$Instruc -> bindParam(':id_serie', $this->IdSerie, PDO::PARAM_STR);
				$Instruc -> bindParam(':id_subserie', $this->IdSubSerie, PDO::PARAM_STR);
				$Instruc -> bindParam(':id_tipodoc', $this->TipoDocumen, PDO::PARAM_STR);
			}elseif($this->Accion == 'ELIMINAR_RESPONSABLE'){
				$Sql = "DELETE FROM config_otras_responsables_hc WHERE id_funcio_deta= :id_funcio_deta";
				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_funcio_deta', $this->IdFuncioDeta, PDO::PARAM_INT);
			}

			$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
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

	public static function Listar($Accion, $IdFuncio){
		$conexion = new Conexion();
		$conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		try{
			if($Accion === 1){
				$Sql = "SELECT respon.id_funcio_deta, depen.nom_depen, serie.nom_serie, subserie.nom_subserie, documen.nom_tipodoc, 
							funcio.nom_funcio, funcio.ape_funcio
						FROM config_otras_responsables_hc AS respon
							INNER JOIN gene_funcionarios_deta AS duncio_deta ON (respon.id_funcio_deta = duncio_deta.id_funcio_deta)
							INNER JOIN gene_funcionarios AS funcio ON (duncio_deta.id_funcio = funcio.id_funcio)
							INNER JOIN areas_dependencias AS depen ON (respon.id_depen = depen.id_depen)
							INNER JOIN archivo_trd_series AS serie ON (respon.id_serie = serie.id_serie)
							INNER JOIN archivo_trd_subserie AS subserie ON (respon.id_subserie = subserie.id_subserie)
							INNER JOIN archivo_trd_tipo_docu AS documen ON (respon.id_tipodoc = documen.id_tipodoc)";

				$Instruc = $conexion->prepare($Sql);
				$Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));

			}elseif($Accion === 2){
				$Sql = "SELECT respon.id_funcio_deta, depen.nom_depen, serie.nom_serie, subserie.nom_subserie, documen.nom_tipodoc, 
							funcio.nom_funcio, funcio.ape_funcio
						FROM config_otras_responsables_hc AS respon
							INNER JOIN gene_funcionarios_deta AS duncio_deta ON (respon.id_funcio_deta = duncio_deta.id_funcio_deta)
							INNER JOIN gene_funcionarios AS funcio ON (duncio_deta.id_funcio = funcio.id_funcio)
							INNER JOIN areas_dependencias AS depen ON (respon.id_depen = depen.id_depen)
							INNER JOIN archivo_trd_series AS serie ON (respon.id_serie = serie.id_serie)
							INNER JOIN archivo_trd_subserie AS subserie ON (respon.id_subserie = subserie.id_subserie)
							INNER JOIN archivo_trd_tipo_docu AS documen ON (respon.id_tipodoc = documen.id_tipodoc) 
						WHERE respon.id_funcio_deta = :id_funcio_deta";

				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_funcio_deta', $IdFuncio, PDO::PARAM_INT);
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

	public static function Buscar($Accion, $IdFuncioDeta) {
		$conexion = new Conexion();
		$conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		try{
			if($Accion == 1){
				$Sql = "SELECT * FROM config_otras_responsables_hc WHERE id_funcio_deta = :id_funcio_deta";

				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_funcio_deta', $IdFuncioDeta, PDO::PARAM_INT);
			}

			$Instruc -> execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
			$Result = $Instruc->fetch();
			$conexion = null;

			if($Result){
				return new self("", $Result['id_funcio_deta'], $Result['id_depen'], $Result['id_serie'], $Result['id_subserie'], $Result['id_tipodoc']);
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