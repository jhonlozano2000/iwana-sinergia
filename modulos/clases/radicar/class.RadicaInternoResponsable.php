<?php
class RadicadoInternoResponsable{
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
    			$Sql = 'INSERT INTO archivo_radica_interna_responsa(id_radica, id_funcio, respon) 
    					VALUES(:id_radica, :id_funcio, :respon)';

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
                $Instruc -> bindParam(':id_funcio', $this->IdFuncio, PDO::PARAM_INT);
                $Instruc -> bindParam(':respon', $this->Respon, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
                
            }elseif($this->Accion == 'ESTABLECER_RESPONSALE'){
                //GUARDAR LA CORRESPONDENCIA SIN GENERAR EL RADICADO
                $Sql = 'UPDATE archivo_radica_interna_responsa SET respon = 1
                        WHERE id_radica = :id_radica AND id_funcio = :id_funcio';

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
                $Instruc -> bindParam(':id_funcio', $this->IdFuncio, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }

    		$Result = $Instruc->fetchAll();
            $conexion = null;
            return $Result;
         }catch(PDOException $e){
            echo 'Ha surgido un error y no se puede ejecutar la consulta, resposables correspondencia interna.'.$e->getMessage();
            exit;
        }
    }

    public static function Listar($Accion, $IdRadicado, $IdFuncioDeta){
        $conexion = new Conexion();
        
        try{
           if($Accion == 1){
                /******************************************************************************************/
                /*  LISTO UN LOS FUNCIONARIOS DE UN RADICADO EN PARTICULAR
                /******************************************************************************************/
                $Sql = "SELECT `fun_deta`.`id_funcio_deta`, `funcio`.`id_funcio`, `funcio`.`cod_funcio`, `funcio`.`nom_funcio`, `funcio`.`ape_funcio`, 
                            `depen`.`id_depen` AS `id_depen`, `depen`.`cod_depen` AS `cod_depen`, `depen`.`cod_corres` AS `cod_corres_depen`, 
                            `depen`.`nom_depen`, `ofi`.`id_oficina`, `ofi`.`nom_oficina`, `cargo`.`id_cargo`, `cargo`.`nom_cargo`, `ra`.`respon`
                        FROM `gene_funcionarios_deta` AS `fun_deta`
                            INNER JOIN `gene_funcionarios` AS `funcio` ON (`fun_deta`.`id_funcio` = `funcio`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`fun_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_cargos` AS `cargo` ON (`fun_deta`.`id_cargo` = `cargo`.`id_cargo`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            INNER JOIN `archivo_radica_interna_responsa` AS `ra` ON (`ra`.`id_funcio` = `fun_deta`.`id_funcio_deta`)
                        WHERE (`ra`.`id_radica` = :id_radica);";

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

    public static function Buscar($Accion, $IdRadicado, $IdFuncioDeta){
        $conexion = new Conexion();
        
        try{

            if($Accion == 1){
                /******************************************************************************************/
                /*  BUSCO SI UN FUNCIONARIO TIENE CORRESPONDENCIA
                /******************************************************************************************/
                $Sql = "SELECT * 
                        FROM archivo_radica_interna_responsa 
                        WHERE id_funcio = :id_funcio_deta";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_funcio_deta', $IdFuncioDeta, PDO::PARAM_INT);
            }elseif($Accion == 2){
                /******************************************************************************************/
                /*  BUSCO EL FUNCIONARIO RESPONSABLE DE LA CORRESPONDENCIA
                /******************************************************************************************/
                $Sql = "SELECT * 
                        FROM archivo_radica_interna_responsa 
                        WHERE id_radica = :id_radica AND respon = 1";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_radica', $IdRadicado, PDO::PARAM_STR);
            }

            $Instruc -> execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            $Result = $Instruc->fetch();
            $conexion = null;
            
            if($Result){
                return new self("", $Result['id_radica'], $Result['id_funcio'], $Result['respon']);
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
