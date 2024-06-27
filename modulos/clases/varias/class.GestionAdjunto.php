<?php
class GestionAdjunto{
//Atributos
    private $Accion;
    private $IdFuncio;
    private $Archivo;
    
    public function __construct($Accion = null, $IdFuncio = null, $Archivo = null){

        $this -> Accion   = $Accion;
        $this -> IdRadica = $IdFuncio;
        $this -> Archivo  = $Archivo;
    }

    public function get_IdFuncio(){
        return $this -> IdFuncio;
    }
    
    public function get_Archivo(){
        return $this -> Archivo;
    }

    // FUNCIONES PARA ENVIAR VALORES //
    public function set_Accion($Accion){
        return $this -> Accion = $Accion;
    }

    public function set_IdFuncio($IdFuncio){
        return $this -> IdFuncio = $IdFuncio;
    }

    public function set_Archivo($Archivo){
        return $this -> Archivo = $Archivo;
    }

    public function Gestionar(){
        
        if($this->Accion == 'INSERTAR'){
           $Sql = 'INSERT INTO temp_adjuntos(id_usua, archivo) 
                    VALUES('.$this->IdFuncio.',"'.$this->Archivo.'")';
        }elseif($this->Accion == 'ELIMINAR'){
            $Sql = "DELETE 
                    FROM temp_adjuntos 
                    WHERE id_usua = ".$this->IdFuncio;
        }elseif($this->Accion == 'ELIMINAR_ARCHIVO'){
            $Sql = "DELETE 
                    FROM temp_adjuntos 
                    WHERE id_usua = ".$this->IdFuncio." AND archivo = '".$this->Archivo."'";
        }

        $conexion = new Conexion();
        $Instruc = $conexion -> prepare($Sql);
        $Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
        $conexion = null;
        if($Instruc){
            return true;
        }else{
            return false;
        }
    }

    public static function Listar($Accion, $IdFuncio, $Archivo){
        $conexion = new Conexion();
        
        if($Accion = 1){
            $Sql = "SELECT * 
                    FROM temp_adjuntos 
                    WHERE id_usua = ".$IdFuncio;
        }

        $Instruc = $conexion->prepare($Sql);
        $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
        $Result = $Instruc->fetchAll();
        $conexion = null;
        return $Result;
    }

    public static function Buscar($Accion, $IdFuncio, $Archivo){
        $conexion = new Conexion();
        
        if($Accion = 1){
            $Sql = "SELECT * 
                    FROM temp_adjuntos 
                    WHERE id_usua = ".$IdFuncio." AND archivo = '".$Archivo."'";
        }
        
        $Instruc = $conexion->prepare($Sql);
        $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
        $Result = $Instruc->fetch();
        $conexion = null;
        if ($Result){
            return new self("", $Result['id_usua'], $Result['archivo']  );
        } else {
            return false;
        }
    }
}
?>