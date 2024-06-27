 <?php
 class SubSerieTVD{
 	private $Accion;
 	private $IdSubSerie;
 	private $CodSubSerie;
 	private $SubSerie;
 	private $Acti;

 	public function __construct($Accion=null, $IdSubSerie=null, $CodSubSerie=null, $SubSerie=null, $Acti=null){
		$this -> Accion      = $Accion;
		$this -> IdSubSerie  = $IdSubSerie;
		$this -> CodSubSerie = $CodSubSerie;
		$this -> SubSerie    = $SubSerie;
		$this -> Acti        = $Acti;
	}

 	public function getId_SubSerie(){
 		return $this-> IdSubSerie;
 	}

 	public function getCod_SubSerie(){
 		return $this-> CodSubSerie;
 	}

 	public function getSubSerie(){
 		return $this-> SubSerie;
 	}

 	public function getActi(){
 		return $this-> Acti;
 	}

 	public function setAccion($Accion){
 		$this->Accion = $Accion;
 	}

 	public function setId_SubSerie($IdSubSerie){
 		$this->IdSubSerie = $IdSubSerie;
 	}

 	public function setCod_SubSerie($CodSubSerie){
 		$this->CodSubSerie = $CodSubSerie;
 	}

 	public function setSubSerie($SubSerie){
 		$this->SubSerie = $SubSerie;

 	}
 	public function set_Acti($acti){
 		$this->Acti = $acti;
 	}

 	public function Gestionar(){
 		$conexion = new Conexion();
        
        try{
	 		if($this->Accion == 'INSERTAR'){
	 			$Sql = "INSERT INTO archivo_tvd_subserie(cod_subserie, nom_subserie, acti) 
	 					VALUES(:cod_subserie, :nom_subserie, 1)";

	 			$Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':cod_subserie', $this->CodSubSerie, PDO::PARAM_STR);
                $Instruc -> bindParam(':nom_subserie', $this->SubSerie, PDO::PARAM_STR);

	 		}if($this->Accion == 'EDITAR'){
	 			
	 			$Sql = "UPDATE archivo_tvd_subserie SET cod_subserie = :cod_subserie, nom_subserie = :nom_subserie, 
			 				acti = :acti
			 			WHERE id_subserie = :id_subserie";

			 	$Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':cod_subserie', $this->CodSubSerie, PDO::PARAM_STR);
                $Instruc -> bindParam(':nom_subserie', $this->SubSerie, PDO::PARAM_STR);
                $Instruc -> bindParam(':acti', $this->Acti, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_subserie', $this->IdSubSerie, PDO::PARAM_INT);

	 		}if($this->Accion == 'ELIMINAR'){
	 			$Sql = "DELETE FROM archivo_tvd_subserie 
	 			WHERE id_subserie = :id_subserie";

	 			$Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_subserie', $this->IdSubSerie, PDO::PARAM_INT);
	 		}

 			$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
            $this->IdSubSerie = $conexion -> lastInsertId();
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

 	public static function Listar($Accion, $IdSubSerie, $IdDocu, $Cod, $Nom){
 		$conexion = new Conexion();
		
		$Sql = "SELECT * FROM archivo_tvd_subserie ";

		try{

			if($Accion == 1){
				/******************************************************************************************/
		        /*  LISTO TODOS LOS REGISTROS
		        /******************************************************************************************/
				$Sql.="ORDER BY cod_subserie, nom_subserie";
				$Instruc = $conexion->prepare($Sql);
				$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			}elseif($Accion == 2){
				/******************************************************************************************/
				/*	LISTO TODAS LAS SUBSERIES ACTIVAS
				/******************************************************************************************/
				$Sql.="WHERE acti = 1";
				$Instruc = $conexion->prepare($Sql);
				$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			}elseif($Accion == 3){
				/******************************************************************************************/
				/*	BUSCO SUBSERIE POR ID
				/******************************************************************************************/
				$Sql.="WHERE id_subserie = :id_subserie";
				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_subserie', $IdSubSerie, PDO::PARAM_INT);
				$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			}elseif($Accion == 4){
				/******************************************************************************************/
				/*	LISTO TODAS LAS SUBSERIES ACTIVAS
				/******************************************************************************************/
				$Sql.="WHERE acti = 1
						ORDER BY nom_subserie ASC, cod_subserie";
				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':nom_subserie', $Nom, PDO::PARAM_STR);
				$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			}elseif($Accion == 5){
		       	/******************************************************************************************/
		        /*  LISTO TODOS LOS REGISTROS POR ID
		        /******************************************************************************************/
		        $Sql = "SELECT archivo_tvd_subserie.id_subserie, archivo_tvd_subserie.cod_subserie, archivo_tvd_subserie.nom_subserie
                			, archivo_tvd_subserie.acti AS acti_subserie, archivo_tvd_tipo_docu.nom_tipodoc, archivo_tvd_subserie_docu.acti AS acti_docu
			            FROM archivo_tvd_subserie_docu
			                INNER JOIN archivo_tvd_subserie ON (archivo_tvd_subserie_docu.id_subserie = archivo_tvd_subserie.id_subserie)
			                INNER JOIN archivo_tvd_tipo_docu ON (archivo_tvd_subserie_docu.id_tipodoc = archivo_tvd_tipo_docu.id_tipodoc) 
			            ORDER BY archivo_tvd_subserie.cod_subserie, archivo_tvd_subserie.nom_subserie DESC";
		        $Instruc = $conexion->prepare($Sql);
				$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
		    }elseif($Accion == 6){
		        /******************************************************************************************/
		        /*  LISTO LOS DOCUMENTOS DE UNA SUBSERIE
		        /******************************************************************************************/
		        $Sql = "SELECT archivo_tvd_tipo_docu.id_tipodoc, archivo_tvd_subserie_docu.acti, archivo_tvd_tipo_docu.nom_tipodoc
		                FROM archivo_tvd_subserie_docu
		                    INNER JOIN archivo_tvd_tipo_docu ON (archivo_tvd_subserie_docu.id_tipodoc = archivo_tvd_tipo_docu.id_tipodoc) 
		                WHERE archivo_tvd_subserie_docu.id_subserie = :id_subserie";
		        $Instruc = $conexion->prepare($Sql);
		        $Instruc -> bindParam(':id_subserie', $IdSubSerie, PDO::PARAM_INT);
				$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
		    }elseif($Accion == 7){
		        /******************************************************************************************/
		        /*  BUSCO UN DOCUMENTO DE UNA SUBSERIE
		        /******************************************************************************************/
		        $Sql = "SELECT *
		                FROM archivo_tvd_subserie_docu 
		                WHERE id_subserie = :id_subserie AND id_tipodoc = :id_tipodoc";
		        $Instruc = $conexion->prepare($Sql);
		        $Instruc -> bindParam(':id_subserie', $IdSubSerie, PDO::PARAM_INT);
		        $Instruc -> bindParam(':id_tipodoc', $IdDocu, PDO::PARAM_INT);
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

 	public static function Buscar($Accion, $IdSubSerie, $Cod, $Nom) {
		$conexion = new Conexion();
        
    	try{

            if($Accion == 1){
                /******************************************************************************************/
                /*  SABER SY UNA TRD YA SE ENCUENTRA CONFIGURADA
                /******************************************************************************************/
                
                $Sql = "SELECT *
                        FROM `archivo_tvd_subserie`
                        WHERE (`id_subserie` = :id_subserie)";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_subserie', $IdSubSerie, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($Accion == 2){
                /******************************************************************************************/
                /*  BUSCO POR NOMBRE
                /******************************************************************************************/
                
                $Sql = "SELECT *
                        FROM `archivo_tvd_subserie`
                        WHERE (`nom_subserie` = :nom_subserie AND `cod_subserie` = :cod_subserie)";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':nom_subserie', $Nom, PDO::PARAM_INT);
                $Instruc -> bindParam(':cod_subserie', $Cod, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }

            $Result = $Instruc->fetch();
            $conexion = null;

			if($Result){
				return new self("", $Result['id_subserie'], $Result['cod_subserie'], $Result['nom_subserie'], $Result['acti']);
			}else{
				return false;
			}
		 }catch(PDOException $e){
            echo 'Ha surgido un error y no se puede ejecutar la consulta.'.$e->getMessage();
            exit;
        }
	}
 }
 ?>                                                                                                                                                                                                                                                                                                                                                                                                                             