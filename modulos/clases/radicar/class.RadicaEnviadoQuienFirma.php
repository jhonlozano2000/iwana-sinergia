<?php
class RadicadoEnviadoQuienFirma{
    //Atributos
    private $Accion;
    private $IdRadica;
    private $IdFuncio;
    private $Princi;
   
    public function __construct($Accion = null, $IdRadica = null, $IdFuncio = null, $Princi = null){
        $this -> Accion   = $Accion;
        $this -> IdRadica = $IdRadica;
        $this -> IdFuncio = $IdFuncio;
        $this -> Princi   = $Princi;
    }

    public function get_IdRadica(){
        return $this -> IdRadica;
    }
    
    public function get_IdFuncio(){
        return $this -> IdFuncio;
    }

    public function get_Princi(){
        return $this -> Princi;
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

    public function set_Princi($Princi){
        return $this -> Princi = $Princi;
    }
    
    //Metodos
    public function Gestionar(){
        $conexion = new Conexion();
    
        try{
            
            if($this->Accion == 'INSERTAR_QUIEN_FIRMA'){
                $Sql = 'INSERT INTO archivo_radica_enviados_quienes_firman(id_radica, id_funcio_deta) 
                        VALUES(:id_radica, :id_funcio_deta)';
                
                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
                $Instruc -> bindParam(':id_funcio_deta', $this->IdFuncio, PDO::PARAM_INT);
            }elseif($this->Accion == 2){
                $Sql = "DELETE 
                        FROM archivo_radica_enviados_quienes_firman 
                        WHERE id_radica = :id_radica";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
            }elseif($this->Accion == 'ESTABLECER_FIRMA_PRINCIPAL'){
                /***********************************************************************************************
                * ESTABLECER EL FUNCIONARIO PRINCIPAL QUE FIRMA LA CORRESPONDENCIA
                /***********************************************************************************************/
                $Sql = "UPDATE archivo_radica_enviados_quienes_firman 
                        SET firma_principal = 1 
                        WHERE id_radica = :id_radica AND id_funcio_deta = :id_funcio_deta";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
                $Instruc -> bindParam(':id_funcio_deta', $this->IdFuncio, PDO::PARAM_STR);
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
    
    public static function Listar($Accion, $IdRadicado, $Funcio){
        $conexion = new Conexion();
        
        try{
           if($Accion == 1){
                /******************************************************************************************/
                /*  LISTO UN LOS FUNCIONARIOS DE UN RADICADO EN PARTICULAR
                /******************************************************************************************/
                $Sql = "SELECT `ra_quien_firma`.`id_radica`, `ra_quien_firma`.`firma_principal`, `funcio_deta`.`id_funcio_deta`, `funcio`.`id_funcio`, 
                            `funcio`.`cod_funcio`, `funcio`.`nom_funcio`, `funcio`.`ape_funcio`, `depen`.`nom_depen`, `ofi`.`nom_oficina`
                        FROM  `archivo_radica_enviados_quienes_firman` AS `ra_quien_firma`
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_quien_firma`.`id_funcio_deta` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                        WHERE (`ra_quien_firma`.`id_radica` = :id_radica)";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":id_radica", $IdRadicado, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($Accion == 2){
                /******************************************************************************************/
                /*  LISTO EL FUNCIONARIO PRINCIPAL QUE FIRMA
                /******************************************************************************************/
                $Sql = "SELECT `ra_quien_firma`.`id_radica`, `ra_quien_firma`.`firma_principal`, `funcio_deta`.`id_funcio_deta`, `funcio`.`id_funcio`, 
                            `funcio`.`cod_funcio`, `funcio`.`nom_funcio`, `funcio`.`ape_funcio`, `depen`.`nom_depen`, `ofi`.`nom_oficina`
                        FROM  `archivo_radica_enviados_quienes_firman` AS `ra_quien_firma`
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_quien_firma`.`id_funcio_deta` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                        WHERE (`ra_quien_firma`.`id_radica` = :id_radica AND `ra_quien_firma`.`princi` = 1)";

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
        $conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try{
            if($Accion == 1){
                $Sql = "SELECT * 
                        FROM archivo_radica_enviados_quienes_firman 
                        WHERE id_radica = :id_radica";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_radica', $IdRadica, PDO::PARAM_STR);
                
            }elseif($Accion == 2){
                $Sql = "SELECT * 
                        FROM archivo_radica_enviados_quienes_firman 
                        WHERE id_funcio_deta = :id_funcio_deta";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_funcio_deta', $IdFuncio, PDO::PARAM_STR);
            }
            
            $Instruc -> execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            $Result = $Instruc->fetch();
            $conexion = null;
            
            if ($Result) {
                return new self($Result['id_radica'], $Result['id_funcio_deta']);
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
