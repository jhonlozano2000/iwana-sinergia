<?php
class RadicadoEnviadoResponsable{
    //Atributos
    private $Accion;
    private $IdRadica;
    private $IdFuncio;
    private $Respon;
   
    public function __construct($Accion = null, $IdRadica = null, $IdFuncio = null, $Respon = null){
        $this -> Accion      = $Accion;
        $this -> IdRadica    = $IdRadica;
        $this -> IdFuncio    = $IdFuncio;
        $this -> Respon      = $Respon;
    }

    public function get_IdRadica(){
        return $this -> IdRadica;
    }
    
    public function get_IdFuncio(){
        return $this -> IdFuncio;
    }

    public function get_Respon(){
        return $this -> Respon;
    }

    // FUNCIONES PARA ENVIAR VALORES //
    public function set_Accion($Accion){
        return $this -> Accion = $Accion;
    }

    public function set_IdRadica($IdRadica){
        return $this -> IdRadica = $IdRadica;
    }
    
     public function set_IdFuncio($IdFuncio){
        return $this -> IdFuncio = $IdFuncio;
    }
    
    public function set_Respon($Respon){
        return $this -> Respon = $Respon;
    }
    
    //Metodos
	public function Gestionar(){
        $conexion = new Conexion();
        
        try{
			
    		if($this->Accion == 1){
    			//GUARDAR LA CORRESPONDENCIA SIN GENERAR EL RADICADO
    			$Sql = 'INSERT INTO archivo_radica_enviados_responsa(id_radica, id_funcio_deta, respon) 
    					VALUES(:id_radica, :id_funcio_deta, :respon)';
                
                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
                $Instruc -> bindParam(':id_funcio_deta', $this->IdFuncio, PDO::PARAM_INT);
                $Instruc -> bindParam(':respon', $this->Respon, PDO::PARAM_INT);
            }elseif($this->Accion == 2){
    			//ELIMINO LOS RESPONSABLES
    			$Sql = "DELETE 
                        FROM archivo_radica_enviados_responsa 
                        WHERE id_radica = :id_radica";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
            }elseif($this->Accion == 3){
                //ESTABLEZCO ES RESPONSABLE
                $Sql = "UPDATE archivo_radica_enviados_responsa 
                        SET respon = 1 
                        WHERE id_radica = :id_radica AND id_funcio_deta = :id_funcio_deta";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
                $Instruc -> bindParam(':id_funcio_deta', $this->IdFuncio, PDO::PARAM_INT);
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
	
	public static function Listar($Accion, $IdRadicado, $Funcio, $IdDepen, $IdOfi){
        $conexion = new Conexion();
        
        try{
           if($Accion == 1){
                /******************************************************************************************/
                /*  LISTO UN LOS FUNCIONARIOS DE UN RADICADO EN PARTICULAR
                /******************************************************************************************/
                $Sql = "SELECT `r`.`id_radica`, `gene_funcionarios`.`cod_funcio`, `gene_funcionarios`.`nom_funcio`, `gene_funcionarios`.`ape_funcio`, 
                            `areas_dependencias`.`cod_depen`, `areas_dependencias`.`cod_corres` AS `cod_corres_depen`, `areas_dependencias`.`nom_depen`, 
                            `areas_oficinas`.`cod_oficina`, `areas_oficinas`.`cod_corres` AS `cod_corres_ofi`, `areas_oficinas`.`nom_oficina`, `areas_cargos`.`nom_cargo`, `r`.`respon`
                        FROM `gene_funcionarios_deta` AS `fd`
                            INNER JOIN `gene_funcionarios` ON (`fd`.`id_funcio` = `gene_funcionarios`.`id_funcio`)
                            INNER JOIN `areas_oficinas` ON (`fd`.`id_oficina` = `areas_oficinas`.`id_oficina`)
                            INNER JOIN `areas_cargos` ON (`fd`.`id_cargo` = `areas_cargos`.`id_cargo`)
                            INNER JOIN `areas_dependencias` ON (`areas_oficinas`.`id_depen` = `areas_dependencias`.`id_depen`)
                            INNER JOIN `archivo_radica_enviados_responsa` AS `r` ON (`r`.`id_funcio_deta` = `fd`.`id_funcio_deta`) 
                         WHERE `r`.`id_radica` = :id_radica";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":id_radica", $IdRadicado, PDO::PARAM_STR);
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

    public static function Buscar($Accion, $IdRadica, $IdFuncio) {
		$conexion = new Conexion();
        
        try{
            if($Accion == 1){
                $Sql = "SELECT * 
                        FROM archivo_radica_enviados_responsa 
                        WHERE id_radica = :id_radica";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_radica', $IdRadica, PDO::PARAM_STR);
                
            }elseif($Accion == 2){
                $Sql = "SELECT * 
                        FROM archivo_radica_enviados_responsa 
                        WHERE id_funcio_deta = :id_funcio_deta";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_funcio_deta', $IdFuncio, PDO::PARAM_STR);
            }
    		
            $Instruc -> execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            $Result = $Instruc->fetch();
            $conexion = null;
    		
            if ($Result) {
    			return new self($Result['id_radica'], $Result['id_funcio_deta'], $Result['respon']);
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
