<?php
class RadicadoRecibidoGrupoColaborativo{
    //Atributos
    private $Accion;
    private $IdRadica;
    private $IdFuncioAsigno;
    private $IdFuncioAsignado;
    private $FecHorAsignado;
    private $FecHorRealizado;
    private $Observacion;

    public function __construct($Accion = null, $IdRadica = null, $IdFuncioAsigno = null, $IdFuncioAsignado = null, $FecHorAsignado = null, 
                                $FecHorRealizado = null, $Observacion = null){

        $this -> Accion           = $Accion;
        $this -> IdRadica         = $IdRadica;
        $this -> IdFuncioAsigno   = $IdFuncioAsigno;
        $this -> IdFuncioAsignado = $IdFuncioAsignado;
        $this -> FecHorAsignado   = $FecHorAsignado;
        $this -> FecHorRealizado  = $FecHorRealizado;
        $this -> Observacion      = $Observacion;
    }

    public function get_IdRadica(){
        return $this -> IdRadica;
    }
    
    public function get_IdFuncioAsigno(){
        return $this -> IdFuncioAsigno;
    }

    public function get_IdFuncioAsignado(){
        return $this -> IdFuncioAsignado;
    }

    public function get_FecHorAsignado(){
        return $this -> FecHorAsignado;
    }

    public function get_FecHorRealizado(){
        return $this -> FecHorRealizado;
    }

    public function get_Observacion(){
        return $this -> Observacion;
    }

    // FUNCIONES PARA ENVIAR VALORES //
    public function set_Accion($Accion){
        $this -> Accion = $Accion;
    }

    public function set_IdRadica($IdRadica){
        $this -> IdRadica = $IdRadica;
    }
    
    public function set_IdFuncioAsigno($IdFuncioAsigno){
        $this -> IdFuncioAsigno = $IdFuncioAsigno;
    }
    
    public function set_IdFuncioAsignado($IdFuncioAsignado){
        $this -> IdFuncioAsignado = $IdFuncioAsignado;
    }
    
    public function set_FecHorAsignado($FecHorAsignado){
        $this -> FecHorAsignado = $FecHorAsignado;
    }
    
    public function set_FecHorRealizado($FecHorRealizado){
        $this -> FecHorRealizado = $FecHorRealizado;
    }

    public function set_Observacion($Observacion){
        $this -> Observacion = $Observacion;
    }

    //Metodos
	public function Gestionar(){
        $conexion = new Conexion();
        
        try{
    			
    		if($this->Accion == 'ASIGNAR_FUNCIONARIO_PARA_CREAR_GRUPO_COLABORATIVO'){
    			//GUARDAR LA CORRESPONDENCIA SIN GENERAR EL RADICADO
    			$Sql = 'INSERT INTO `archivo_radica_recibidos_grupos_colaborativo`(`id_radica`,`id_funcio_deta_asigno`,`id_funcio_deta_asingnado`, 
                            `fechor_asignado`, `observacion`)
                        VALUES (:id_radica, :id_funcio_deta_asigno, :id_funcio_deta_asingnado, :fechor_asignado, :observacion);';
                        
                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
                $Instruc -> bindParam(':id_funcio_deta_asingnado', $this->IdFuncioAsignado, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_funcio_deta_asigno', $this->IdFuncioAsigno, PDO::PARAM_INT);
                $Instruc -> bindParam(':fechor_asignado', $this->FecHorAsignado, PDO::PARAM_INT);
                $Instruc -> bindParam(':observacion', $this->Observacion, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($this->Accion == 'CREAR_GRUPO_COLABORATIVO'){
                //GUARDAR LA CORRESPONDENCIA SIN GENERAR EL RADICADO
                $Sql = 'UPDATE `archivo_radica_recibidos_grupos_colaborativo` SET `fechor_realizado` = :fechor_realizado
                        WHERE `id_radica` = :id_radica AND `id_funcio_deta_asingnado` = :id_funcio_deta_asingnado';

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':fechor_realizado', $this->FecHorRealizado, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
                $Instruc -> bindParam(':id_funcio_deta_asingnado', $this->IdFuncioAsignado, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
    		}

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

    public static function Listar($Accion, $IdRadicado, $IdFuncioAsigno, $IdFuncioAsignado){
        $conexion = new Conexion();
        
        try{
           if($Accion == 1){
                /******************************************************************************************/
                /*  LISTO LOS FUNCIONARIOS DE UN RADICADO EN PARTICULAR
                /******************************************************************************************/
                $Sql = "SELECT * 
                        FROM archivo_radica_recibidos_grupos_colaborativo 
                        WHERE id_radica = :id_radica";

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

    public static function Buscar($Accion, $IdRadicado, $IdFuncioAsigno, $IdFuncioAsignado){
        $conexion = new Conexion();

        try{

            if($Accion == 1){
                /******************************************************************************************/
                /*  BUSCO SI UN FUNCIONARIO TIENE ASINGNADO LA CREACION DE GRUPOS COLABORATIVOS
                /******************************************************************************************/
                 $Sql = "SELECT * 
                        FROM archivo_radica_recibidos_grupos_colaborativo 
                        WHERE id_radica = :id_radica AND fechor_realizado IS NULL";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":id_radica", $IdRadicado, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }

            $Instruc -> execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            $Result = $Instruc->fetch();
            $conexion = null;
            
            if($Result){
                return new self("", $Result['id_radica'], $Result['id_funcio_deta_asigno'], $Result['id_funcio_deta_asingnado'], 
                    $Result['fechor_asignado'], $Result['fechor_realizado']);
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
