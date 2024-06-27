<?php
class RadicadoRecibidoCompartir{
    //Atributos
    private $Accion;
    private $IdRadica;
    private $IdFuncioOrigen;
    private $IdFuncioDestino;
    private $FecHorCompartido;
    private $FecHorLeido;
    private $Ver;

    public function __construct($Accion = null, $IdRadica = null, $IdFuncioOrigen = null, $IdFuncioDestino = null, $FecHorCompartido = null, $FecHorLeido = null,
                                $Ver = null){
        $this -> Accion           = $Accion;
        $this -> IdRadica         = $IdRadica;
        $this -> IdFuncioOrigen   = $IdFuncioOrigen;
        $this -> IdFuncioDestino  = $IdFuncioDestino;
        $this -> FecHorCompartido = $FecHorCompartido;
        $this -> FecHorLeido      = $FecHorLeido;
        $this -> Ver              = $Ver;
    }

    public function get_IdRadica(){
        return $this -> IdRadica;
    }

    public function get_IdFuncioOrigen(){
        return $this -> IdFuncioOrigen;
    }

    public function get_IdFuncioDestino(){
        return $this -> IdFuncioDestino;
    }

    public function get_FecHorCompartido(){
        return $this -> FecHorCompartido;
    }

    public function get_FecHorLeido(){
        return $this -> FecHorLeido;
    }

    public function get_Ver(){
        return $this -> Ver;
    }

    // FUNCIONES PARA ENVIAR VALORES //
    public function set_Accion($Accion){
        return $this -> Accion = $Accion;
    }

    public function set_IdRadica($IdRadica){
        return $this -> IdRadica = $IdRadica;
    }

     public function set_IdFuncioOrigen($IdFuncioOrigen){
        return $this -> IdFuncioOrigen = $IdFuncioOrigen;
    }

    public function set_IdFuncioDestino($IdFuncioDestino){
        return $this -> IdFuncioDestino = $IdFuncioDestino;
    }

    public function set_FecHorCompartido($FecHorCompartido){
        return $this -> FecHorCompartido = $FecHorCompartido;
    }

    public function set_FecHorLeido($FecHorLeido){
        return $this -> FecHorLeido = $FecHorLeido;
    }

	public function set_Ver($Ver){
        return $this -> Ver = $Ver;
    }

    //Metodos
	public function Gestionar(){
        $conexion = new Conexion();

        try{

    		if($this->Accion == 'COMPARTIR_RADICADO'){
    			//GUARDAR LA CORRESPONDENCIA SIN GENERAR EL RADICADO
    			$Sql = 'INSERT INTO `archivo_radica_recibido_compartidos`(`id_radica`, `id_funcio_deta_origen`, `id_funcio_deta_destino`,
                            `fechor_compartido`)
                        VALUES (:id_radica, :id_funcio_deta_origen, :id_funcio_deta_destino, :fechor_compartido)';

                        //echo $this->IdRadica." - ".$this->IdFuncioOrigen." - ".$this->IdFuncioDestino." - ".$this->FecHorCompartido;
                        //exit();
                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
                $Instruc -> bindParam(':id_funcio_deta_origen', $this->IdFuncioOrigen, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_funcio_deta_destino', $this->IdFuncioDestino, PDO::PARAM_INT);
                $Instruc -> bindParam(':fechor_compartido', $this->FecHorCompartido, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($this->Accion == 'ELIMINAR_RADICADO'){
                $Sql = "DELETE FROM archivo_radica_recibido_compartidos
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
            echo 'Ha surgido un error y no se puede ejecutar la consulta, Compartir radicados ->'.$this->Accion." - ".$e->getMessage()." --- Id. Radica: ".$this->IdRadica;
            exit;
        }
    }

    public static function Listar($Accion, $IdRadicado, $IdFuncioDetaOrigen, $IdFuncioDetaDestino){
        $conexion = new Conexion();

        try{
           if($Accion == 1){
                /******************************************************************************************/
                /*  LISTO UN LOS COMPARTIDOS DEL FUNCIONARIO ORIGEN
                /******************************************************************************************/
                $Sql = "";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":id_radica", $IdRadicado, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($Accion == 3){
                /******************************************************************************************/
                /*  LISTO UN LOS COMPARTIDOS DEL FUNCIONARIO DESTINO
                /******************************************************************************************/
                $Sql = "";

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

    public static function Buscar($Accion, $IdRadicado, $IdFuncioDetaOrigen, $IdFuncioDetaDestino){
        $conexion = new Conexion();

        try{

            if($Accion == 1){
                /******************************************************************************************/
                /*  BUSCO SI UN FUNCIONARIO TIENE CORRESPONDENCIA
                /******************************************************************************************/
                $Sql = "";
                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_funcio_deta', $IdFuncioDeta, PDO::PARAM_INT);
            }

            $Instruc -> execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            $Result = $Instruc->fetch();
            $conexion = null;

            if($Result){
                return new self("", $Result['id_radica'], $Result['id_funcio_deta_origen'], $Result['id_funcio_deta_destino'], $Result['fechor_compartido'],
                                $Result['fechor_leido'], $Result['ver']);
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
