 <?php
class Serie{
	private $Accion;
	private $IdSerie;
	private $CodSerie;
	private $NomSerie;
	private $Observa;
	private $Acti;
	
	public function __construct($Accion=null, $IdSerie = null, $CodSerie = null, $NomSerie = null, $Observa = null, $Acti = null ){
		$this -> Accion   = $Accion;
		$this -> IdSerie  = $IdSerie;
		$this -> CodSerie = $CodSerie;
		$this -> NomSerie = $NomSerie;
		$this -> Observa  = $Observa;
		$this -> Acti     = $Acti;
	}
	
	public function getId_Serie() {
        return $this-> IdSerie;
    }

    public function getCod_Serie() {
        return $this-> CodSerie;
    }

    public function getNom_Serie() {
        return $this-> NomSerie;
    }

    public function getObserva() {
        return $this-> Observa;
    }
	
	 public function getActi() {
        return $this-> Acti;
    }

    public function setAccion($Accion) {
        $this->Accion = $Accion;
    }

    public function setId_Serie($IdSerie) {
        $this->IdSerie = $IdSerie;
    }

    public function setCod_Serie($CodSerie) {
        $this->CodSerie = $CodSerie;
    }

    public function setNom_Serie($NomSerie) {
        $this->NomSerie = $NomSerie;
    }

    public function setObserva($Observa) {
        $this->Observa = $Observa;
    }
	
	public function setActi($acti) {
        $this->Acti = $acti;
    }

	public function Gestionar(){
		$conexion = new Conexion();
        $conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try{
			if($this->Accion == 'Insertar'){
				$Sql = "INSERT INTO archivo_trd_series(cod_serie, nom_serie, observa, acti) 
						VALUES(:cod_serie, :nom_serie, :observa, 1)";

				$Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':cod_serie', $this->CodSerie, PDO::PARAM_STR);
                $Instruc -> bindParam(':nom_serie', $this->NomSerie, PDO::PARAM_STR);
                $Instruc -> bindParam(':observa', $this->Observa, PDO::PARAM_STR);

			}if($this->Accion == 'EDITAR'){
				$Sql = "UPDATE archivo_trd_series 
							SET cod_serie = :cod_serie, nom_serie = :nom_serie, observa = :observa, acti = :acti
						WHERE id_serie = :id_serie";

				$Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':cod_serie', $this->CodSerie, PDO::PARAM_STR);
                $Instruc -> bindParam(':nom_serie', $this->NomSerie, PDO::PARAM_STR);
                $Instruc -> bindParam(':observa', $this->Observa, PDO::PARAM_STR);
                $Instruc -> bindParam(':acti', $this->Acti, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_serie', $this->IdSerie, PDO::PARAM_INT);

			}if($this->Accion == 'ELIMINAR'){
				$Sql = "DELETE FROM archivo_trd_series WHERE id_serie = :id_serie";
				$Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_serie', $this->IdSerie, PDO::PARAM_INT);

			}if($this->Accion == 'ACTIVAR'){
				$Sql = "UPDATE archivo_trd_series 
							SET acti = :acti 
						WHERE id_serie = :id_serie";

				$Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':acti', $this->Acti, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_serie', $this->IdSerie, PDO::PARAM_INT);
			}
		
			$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
            $this-> IdSerie = $conexion -> lastInsertId();
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

   	public static function Listar($Accion, $IdSerie, $Cod, $Nom) {
		$conexion = new Conexion();
		$conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$Sql = "SELECT * FROM archivo_trd_series ";

		try{

			if($Accion == 1){

				$Sql.="ORDER BY 2, 3";
				$Instruc = $conexion->prepare($Sql);
				$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			}elseif($Accion == 2){
				/******************************************************************************************/
				/*	LISTO UN REGISTROS
				/******************************************************************************************/
				$Sql.="WHERE cod_serie = :cod_serie";
				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':cod_serie', $Cod, PDO::PARAM_STR);
				$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			}elseif($Accion == 3){
				/******************************************************************************************/
				/*	LISTO POR NOMBRE
				/******************************************************************************************/
				$Sql.="WHERE nom_serie = :nom_serie";
				$Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':nom_serie', $Nom, PDO::PARAM_STR);
				$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			}elseif($Accion == 4){
				/******************************************************************************************/
				/*	LISTO LAS SERIES ACTIVAS
				/******************************************************************************************/
				$Sql.="WHERE acti = 1
						ORDER BY nom_serie ASC, cod_serie";
				$Instruc = $conexion->prepare($Sql);
				$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
			}elseif($Accion == 5){
		       	/******************************************************************************************/
		        /*  LISTO TODOS LOS REGISTROS POR ID
		        /******************************************************************************************/
		        $Sql.="WHERE id_serie = ".$IdSerie;
		        $Instruc = $conexion->prepare($Sql);
				$Instruc -> bindParam(':id_serie', $IdSerie, PDO::PARAM_INT);
				$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
		    }elseif($Accion == 6){
		        /******************************************************************************************/
		        /*  LISTO TODOS TODAS LAS SERIES CON SUS SUBSERIES
		        /******************************************************************************************/
		        $Sql = "SELECT archivo_trd_series.cod_serie, archivo_trd_series.nom_serie, archivo_trd_series.acti AS acti_serie
			                , archivo_trd_subserie.cod_subserie, archivo_trd_subserie.nom_subserie, archivo_trd_subserie.acti as acti_subserie
			            FROM archivo_trd
			                INNER JOIN archivo_trd_series ON (archivo_trd.id_serie = archivo_trd_series.id_serie)
			                INNER JOIN archivo_trd_subserie ON (archivo_trd.id_subserie = archivo_trd_subserie.id_subserie)
			        	ORDER BY archivo_trd_series.cod_serie ASC, archivo_trd_series.nom_serie ASC, archivo_trd_subserie.cod_subserie ASC, 
			        		archivo_trd_subserie.nom_subserie ASC";
		        $Instruc = $conexion->prepare($Sql);
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

	 public static function Buscar($Accion, $IdSerie, $Cod, $Nom){
	 	$conexion = new Conexion();
        $conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    	try{

            if($Accion == 1){
                /******************************************************************************************/
                /*  SABER SY UNA TRD YA SE ENCUENTRA CONFIGURADA
                /******************************************************************************************/
                
                $Sql = "SELECT *
                        FROM `archivo_trd_series`
                        WHERE (`id_serie` = :id_serie)";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_serie', $IdSerie, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($Accion == 2){
                /******************************************************************************************/
                /*  SABER SY UNA TRD YA SE ENCUENTRA CONFIGURADA
                /******************************************************************************************/
                
                $Sql = "SELECT *
                        FROM `archivo_trd_series`
                        WHERE (`nom_serie` = :nom_serie AND `cod_serie` = :cod_serie)";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':nom_serie', $Nom, PDO::PARAM_STR);
                $Instruc -> bindParam(':cod_serie', $Cod, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }

            
            $Result = $Instruc->fetch();
            $conexion = null;
        
	        if ($Result) {
	            return new self("", $Result['id_serie'], $Result['cod_serie'], $Result['nom_serie'], $Result['observa'], $Result['acti']);
	        } else {
	            return false;
	        }
	     }catch(PDOException $e){
            echo 'Ha surgido un error y no se puede ejecutar la consulta.'.$e->getMessage();
            exit;
        }
    }
}
?>