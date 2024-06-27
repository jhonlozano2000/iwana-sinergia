<?php
class RadicadoEnviadoTempNota{

    private $Accion;
    private $IdTemp;
    private $IdFuncio;
    private $FecHorNota;
    private $Nota;
    
    public function __construct($Accion = null, $IdTemp = null, $IdFuncio = null, $FecHorNota = null, $Nota = null){
        $this -> Accion     = $Accion;
        $this -> IdTemp     = $IdTemp;
        $this -> IdFuncio   = $IdFuncio;
        $this -> FecHorNota = $FecHorNota;
        $this -> Nota       = $Nota;
    }

    public function get_IdTemp(){
        return $this -> IdTemp;
    }

    public function get_IdFuncio(){
        return $this -> IdFuncio;
    }

    public function get_FecHorNota(){
        return $this -> FecHorNota;
    }

    public function get_Nota(){
        return $this -> Nota;
    }

    public function set_Accion($Accion){
        return $this -> Accion = $Accion;
    }

    public function set_IdTemp($IdTemp){
        return $this -> IdTemp = $IdTemp;
    }

    public function set_IdFuncio($IdFuncio){
        return $this -> IdFuncio = $IdFuncio;
    }

    public function set_FecHorNota($FecHorNota){
        return $this -> FecHorNota = $FecHorNota;
    }

    public function set_Nota($Nota){
        return $this -> Nota = $Nota;
    }

    public function Gestionar(){
        $conexion = new Conexion();
        
        try{
            if($this->Accion === "GUARDAR_NOTA"){

                $Sql = 'INSERT INTO archivo_radica_enviados_temp_nota(id_temp, id_funcio_deta, fechor_nota, nota) 
                        VALUES(:id_temp, :id_funcio_deta, :fechor_nota, :nota)';

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $this->IdTemp, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_funcio_deta', $this->IdFuncio, PDO::PARAM_INT);
                $Instruc -> bindParam(':fechor_nota', $this->FecHorNota, PDO::PARAM_STR);
                $Instruc -> bindParam(':nota', $this->Nota, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }

            if($Instruc){
                return true;
            }else{
                return false;
            }
        }catch(PDOException $e){
            echo 'Ha surgido un error y no se puede ejecutar la consulta en Nota'.$e->getMessage();
            exit;
        }
    }

    public static function Listar($Accion, $IdTemp, $IdFuncio){
        $conexion = new Conexion();

        try{
            if($Accion === 1){

                $Sql = "SELECT `temp_nota`.`fechor_nota`, `temp_nota`.`nota`, `temp_nota`.`id_funcio_deta`, `funcio`.`nom_funcio`, 
                            `funcio`.`ape_funcio`
                        FROM `archivo_radica_enviados_temp_nota` AS `temp_nota`
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`temp_nota`.`id_funcio_deta` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`)
                        WHERE (`temp_nota`.`id_temp` = :id_temp)
                        ORDER BY `temp_nota`.`fechor_nota` DESC";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $IdTemp, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }
            
            $Result = $Instruc->fetchAll();
            $conexion = null;
            return $Result;
        }catch(PDOException $e){
            echo 'Ha surgido un error y no se puede ejecutar la consulta en Responsables Temp.'.$e->getMessage();
            exit;
        }
    }

    public static function Buscar($Accion, $IdTemp, $IdFuncio) {
        $conexion = new Conexion();
        
        try{
            if($Accion === 1){
                $Sql = "SELECT * 
                        FROM archivo_radica_enviados_temp_responsa 
                        WHERE id_temp = :id_temp";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $IdTemp, PDO::PARAM_INT);
            }

            $Instruc -> execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            $Result = $Instruc->fetch();
            $conexion = null;

            if($Result){
                return new self("", $Result['id_temp'], $Result['id_funcio_deta'], $Result['fechor_nota'], $Result['nota']);
            }else{
                return false;
            }
        }catch(PDOException $e){
            echo 'Ha surgido un error y no se puede ejecutar la consulta en Responsables Temp.'.$e->getMessage();
            exit;
        }
    }
}
?>
