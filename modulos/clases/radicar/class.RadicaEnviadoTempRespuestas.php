<?php
class RadicaEnviadoTempRespuestas{

    private $Accion;
    private $IdTemp;
    private $IdRadica;

    public function __construct($Accion = null, $IdTemp = null, $IdRadica = null){
        $this -> Accion   = $Accion;
        $this -> IdTemp   = $IdTemp;
        $this -> IdRadica = $IdRadica;
    }

    public function get_IdTemp(){
        return $this -> IdTemp;
    }

    public function get_IdRadica(){
        return $this -> IdRadica;
    }

    public function set_Accion($Accion){
        return $this -> Accion = $Accion;
    }

    public function set_IdTemp($IdTemp){
        return $this -> IdTemp = $IdTemp;
    }

    public function set_IdRadica($IdRadica){
        return $this -> IdRadica = $IdRadica;
    }

     public function Gestionar(){
        $conexion = new Conexion();
        $conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        try{
            if($this->Accion === 1){
                $Sql = "INSERT INTO archivo_radica_enviados_temp_radica_respuesta(id_temp, id_radica) 
                        VALUES(:id_temp, :id_radica)";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $this->IdTemp, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
            }elseif($this->Accion === 2){
                $Sql = "DELETE FROM archivo_radica_enviados_temp_radica_respuesta
                        WHERE id_temp = :id_temp";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $this->IdTemp, PDO::PARAM_INT);
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

    public static function Listar($Accion, $IdTemp, $IdRadica){
        $conexion = new Conexion();
        $conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try{

           if($Accion === 1){
                $Sql = "SELECT * FROM archivo_radica_enviados_temp_radica_respuesta
                        WHERE id_temp = :id_temp";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $IdTemp, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($Accion === 2){
                 $Sql = "SELECT * FROM archivo_radica_enviados_temp_radica_respuesta
                        WHERE id_radica = :id_radica";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_radica', $IdRadica, PDO::PARAM_INT);
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

    public static function Buscar($Accion, $IdTemp, $IdRadica) {
        $conexion = new Conexion();
        $conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try{
            if($Accion === 1){
                $Sql = "SELECT * FROM archivo_radica_enviados_temp_radica_respuesta
                        WHERE id_temp = :id_temp";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $IdTemp, PDO::PARAM_INT);
            }elseif($Accion === 2){
                 $Sql = "SELECT * FROM archivo_radica_enviados_temp_radica_respuesta
                        WHERE id_radica = :id_radica";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_radica', $IdRadica, PDO::PARAM_INT);
            }

            $Instruc -> execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            $Result = $Instruc->fetch();
            $conexion = null;

            if($Result){
                return new self("", $Result['id_temp'], $Result['id_radica']);
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
