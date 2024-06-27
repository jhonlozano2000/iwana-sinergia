<?php
class RadicadoInternoDestinatario{
    //Atributos
    private $Accion;
    private $IdRadica;
    private $IdFuncio;
    private $Leido;
    private $FecHorLeido;
    private $cc;

    public function __construct($Accion = null, $IdRadica = null, $IdFuncio = null, $Leido = null, $FecHorLeido = null, $cc = null){
        $this -> Accion = $Accion;
        $this -> IdRadica = $IdRadica;
        $this -> IdFuncio = $IdFuncio;
        $this -> Leido = $Leido;
        $this -> FecHorLeido = $FecHorLeido;
        $this -> cc = $cc;
    }

    public function get_IdRadica(){
        return $this -> IdRadica;
    }
    
    public function get_IdFuncio(){
        return $this -> IdFuncio;
    }

    public function get_Leido(){
        return $this -> Leido;
    }

    public function get_FecHorLeido(){
        return $this -> FecHorLeido;
    }

    public function get_cc(){
        return $this -> cc;
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
    
    public function set_Leido($Leido){
        return $this -> Leido = $Leido;
    }
    
    public function set_FecHorLeido($FecHorLeido){
        return $this -> FecHorLeido = $FecHorLeido;
    }
    
    public function set_cc($cc){
        return $this -> cc = $cc;
    }
    
    //Metodos
	public function Gestionar(){
        $conexion = new Conexion();
        
        try{
    		if($this->Accion == 1){
    			//GUARDAR LA CORRESPONDENCIA SIN GENERAR EL RADICADO
    			$Sql = 'INSERT INTO archivo_radica_interna_destinata(id_radica, id_funcio_deta, cc) 
    					VALUES(:id_radica, :id_funcio_deta, :cc)';

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
                $Instruc -> bindParam(':id_funcio_deta', $this->IdFuncio, PDO::PARAM_INT);
                $Instruc -> bindParam(':cc', $this->cc, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
    		}elseif($this->Accion == 'MARCAR_LEIDO'){
    			//MARCO COMO LEIDO EL MENSAJE 
    			$Sql = "UPDATE archivo_radica_interna_destinata 
                        SET leido = 1, fechor_leido = :fechor_leido 
    				    WHERE id_radica = :id_radica AND id_funcio_deta = :id_funcio_deta";
                
                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':fechor_leido', $this->FecHorLeido, PDO::PARAM_STR);
                $Instruc -> bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
                $Instruc -> bindParam(':id_funcio_deta', $this->IdFuncio, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
    		}elseif($this->Accion == 3){
    			//ELIMINO LOS DESTINATARIOS
    			$Sql = "DELETE FROM archivo_radica_interna_destinata 
                        WHERE id_radica = :id_radica";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
    		}

    		if($Instruc){
                return true;
            }else{
                return false;
            }
        }catch(PDOException $e){
            echo 'Ha surgido un error y no se puede ejecutar la consulta, Correspondencia interna destinatarios. '.$this->Accion." - ".$e->getMessage();
            exit;
        }
    }

    public static function Listar($Accion, $IdRadicado, $IdFuncioDeta){
        $conexion = new Conexion();
        
        try{
            if($Accion == 1){
                //LISTO LOS DESTINATARIOS
                $Sql = "SELECT `ra_desti`.`fechor_leido`, `ra_desti`.`leido`, `ra_desti`.`cc`, `funcio`.`nom_funcio`, `funcio`.`ape_funcio`, 
                            `depen`.`nom_depen`, `ofi`.`nom_oficina`, `cargo`.`nom_cargo`
                        FROM `archivo_radica_interna_destinata` AS `ra_desti`
                            INNER JOIN `gene_funcionarios_deta` AS `fun_deta` ON (`ra_desti`.`id_funcio_deta` = `fun_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio` ON (`fun_deta`.`id_funcio` = `funcio`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`fun_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_cargos` AS `cargo` ON (`fun_deta`.`id_cargo` = `cargo`.`id_cargo`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                        WHERE (`ra_desti`.`id_radica` = :id_radica )";

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
	
	public static function Buscar($Accion, $IdRadicado, $IdFuncioDeta) {
        $conexion = new Conexion();
        $conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try{
            if($Accion == 1){
                /******************************************************************************************/
                /*  BUSCO SI UN FUNCIONARIO TIENE CORRESPONDENCIA
                /******************************************************************************************/
                $Sql = "SELECT * 
                        FROM archivo_radica_interna_destinata 
                        WHERE id_funcio_deta = :id_funcio_deta";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":id_funcio_deta", $IdFuncioDeta, PDO::PARAM_INT);
            }

            $Instruc -> execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            $Result = $Instruc->fetch();
            $conexion = null;

            if ($Result) {
                return new self($Result['id_radica'], $Result['id_funcio_deta'], $Result['leido'], $Result['fechor_leido'], $Result['cc']);
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
