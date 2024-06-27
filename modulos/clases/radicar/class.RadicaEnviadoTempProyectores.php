<?php
class RadicadoEnviadoTempProyector{
//Atributos
    private $Accion;
    private $IdTemp;
    private $IdFuncio;
    private $FecHorAsigna;
    private $DescargoPlantilla;
    private $SubioPlantilla;
    private $Editando;
    private $Terminado;
    private $FecHorTermina;

    public function __construct($Accion = null, $IdTemp = null, $IdFuncio = null, $FecHorAsigna = null, $DescargoPlantilla = null, $SubioPlantilla = null,
                                $Editando = null, $Terminado = null, $FecHorTermina = null){

        $this -> Accion            = $Accion;
        $this -> IdTemp            = $IdTemp;
        $this -> IdFuncio          = $IdFuncio;
        $this -> FecHorAsigna      = $FecHorAsigna;
        $this -> DescargoPlantilla = $DescargoPlantilla;
        $this -> SubioPlantilla    = $SubioPlantilla;
        $this -> Editando          = $Editando;
        $this -> Terminado         = $Terminado;
        $this -> FecHorTermina     = $FecHorTermina;
    }

    public function get_IdTemp(){
        return $this -> IdTemp;
    }

    public function get_IdFuncio(){
        return $this -> IdFuncio;
    }

    public function get_FecHorAsigna(){
        return $this -> FecHorAsigna;
    }

    public function get_DescargoPlantilla(){
        return $this -> DescargoPlantilla;
    }

    public function get_SubioPlantilla(){
        return $this -> SubioPlantilla;
    }

    public function get_Editando(){
        return $this -> Editando;
    }

    public function get_Terminado(){
        return $this -> Terminado;
    }

    public function get_FecHorTermina(){
        return $this -> FecHorTermina;
    }

// FUNCIONES PARA ENVIAR VALORES //
    public function set_Accion($Accion){
        return $this -> Accion = $Accion;
    }

    public function set_IdTemp($IdTemp){
        return $this -> IdTemp = $IdTemp;
    }

    public function set_IdFuncio($IdFuncio){
        return $this -> IdFuncio = $IdFuncio;
    }

    public function set_FecHorAsigna($FecHorAsigna){
        return $this -> FecHorAsigna = $FecHorAsigna;
    }

    public function set_DescargoPlantilla($DescargoPlantilla){
        return $this -> DescargoPlantilla = $DescargoPlantilla;
    }

    public function set_SubioPlantilla($SubioPlantilla){
        return $this -> SubioPlantilla = $SubioPlantilla;
    }

    public function set_Editando($Editando){
        return $this -> Editando = $Editando;
    }

    public function set_Terminado($Terminado){
        return $this -> Terminado = $Terminado;
    }

    public function set_FecHorTermina($FecHorTermina){
        return $this -> FecHorTermina = $FecHorTermina;
    }

    //Metodos
    public function Gestionar(){
        $conexion = new Conexion();
        $conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try{
            if($this->Accion == 1){
                $Sql = 'INSERT INTO archivo_radica_enviados_temp_proyector(id_temp, id_funcio_deta, fechor_asigna)
                        VALUES(:id_temp, :id_funcio_deta, :fechor_asigna)';

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $this->IdTemp, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_funcio_deta', $this->IdFuncio, PDO::PARAM_INT);
                $Instruc -> bindParam(':fechor_asigna', $this->FecHorAsigna, PDO::PARAM_STR);

            }elseif($this->Accion == 2){

                /************************************************************************************************************************/
                /*  MARCO QUIEN ESTA EDITANDO LA PLANTILLA
                /************************************************************************************************************************/
                $Sql = "UPDATE archivo_radica_enviados_temp_proyector
                        SET editando = 1
                        WHERE id_temp = :id_temp AND id_funcio_deta = :id_funcio_deta";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $this->IdTemp, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_funcio_deta', $this->IdFuncio, PDO::PARAM_INT);
            }elseif($this->Accion == 'DESCARGO_PLANTILLA'){

                /************************************************************************************************************************/
                /*  MARCO QUE EL FUNCIONARIO DESCARGO LA PLANTILLA PARA INCICIAR EL PROCESOS DE PROYECCION
                /************************************************************************************************************************/
                $Sql = "UPDATE archivo_radica_enviados_temp_proyector
                        SET descargo_plantilla = 1
                        WHERE id_temp = :id_temp AND id_funcio_deta = :id_funcio_deta";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $this->IdTemp, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_funcio_deta', $this->IdFuncio, PDO::PARAM_INT);
            }elseif($this->Accion == 'SUBIO_PLANTILLA'){

                /************************************************************************************************************************/
                /*  MARCO QUE EL FUNCIONARIO DESCARGO LA PLANTILLA PARA INCICIAR EL PROCESOS DE FIRMA
                /************************************************************************************************************************/
                $Sql = "UPDATE archivo_radica_enviados_temp_proyector
                        SET subio_plantilla = 1
                        WHERE id_temp = :id_temp AND id_funcio_deta = :id_funcio_deta";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $this->IdTemp, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_funcio_deta', $this->IdFuncio, PDO::PARAM_INT);
            }elseif($this->Accion == 'PROYECTAR_DOCUMENTO'){
                $Sql = "UPDATE archivo_radica_enviados_temp_proyector
                        SET terminado = 1, fechor_termina = :fechor_termina
                        WHERE id_temp = :id_temp AND id_funcio_deta = :id_funcio_deta";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':fechor_termina', $this->FecHorTermina, PDO::PARAM_STR);
                $Instruc -> bindParam(':id_temp', $this->IdTemp, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_funcio_deta', $this->IdFuncio, PDO::PARAM_INT);

            }elseif($this->Accion == 4){
                $Sql = 'INSERT INTO archivo_radica_enviados_temp_proyector(id_temp, id_funcio_deta, fechor_asigna, fechor_termina)
                        VALUES(:id_temp, :id_funcio_deta, :fechor_asigna, :fechor_termina)';

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $this->IdTemp, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_funcio_deta', $this->IdFuncio, PDO::PARAM_INT);
                $Instruc -> bindParam(':fechor_asigna', $this->FecHorAsigna, PDO::PARAM_STR);
                $Instruc -> bindParam(':fechor_termina', $this->FecHorTermina, PDO::PARAM_STR);
            }elseif($this->Accion == 5){
                $Sql = "DELETE FROM archivo_radica_enviados_temp_proyector
                        WHERE id_temp = :id_temp";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $this->IdTemp, PDO::PARAM_INT);

             }elseif($this->Accion == 'QUITAR_EDITANDO'){
                /************************************************************************************************************************/
                /*  QUITO LA MARCA A QUIEN ESTA EDITANDO LA PLANTILLA
                /************************************************************************************************************************/
                $Sql = "UPDATE archivo_radica_enviados_temp_proyector
                        SET editando = 0, fechor_termina = :fechor_termina
                        WHERE id_temp = :id_temp AND id_funcio_deta = :id_funcio_deta";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':fechor_termina', $this->FecHorTermina, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_temp', $this->IdTemp, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_funcio_deta', $this->IdFuncio, PDO::PARAM_INT);
            }elseif($this->Accion == 'QUITO_TODOS_LOS_EDITORES'){
                /************************************************************************************************************************/
                /*  MARCO QUIEN ESTA EDITANDO LA PLANTILLA
                /************************************************************************************************************************/
                $Sql = "UPDATE archivo_radica_enviados_temp_proyector
                        SET editando = 0
                        WHERE id_temp = :id_temp";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $this->IdTemp, PDO::PARAM_INT);
            }

            $Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
            $this->IdTemp = $conexion -> lastInsertId();
            $conexion = null;

            if($Instruc){
                return true;
            }else{
                return false;
            }
        }catch(PDOException $e){
            echo 'Ha surgido un error y no se puede ejecutar la consulta en Radicado enviados Temp - Proyectores. '.$e->getMessage();
            exit;
        }
    }

    public static function Listar($Accion, $IdTemp, $IdFuncio, $IdDepen, $IdOfi, $Criterio1, $Criterio2, $Criterio3){
        $conexion = new Conexion();
        $conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try{
            if($Accion == 1){
                /******************************************************************************************/
                /*  LISTO LOS PROYECTORES
                /******************************************************************************************/
                $Sql = "SELECT temp.id_temp, temp.asunto, temp_proyec.id_funcio_deta, temp_proyec.fechor_asigna, temp_proyec.editando,
                                temp_proyec.fechor_termina, gene_funcionarios.cod_funcio, gene_funcionarios.nom_funcio, gene_funcionarios.ape_funcio,
                                gene_funcionarios.genero, areas_dependencias.id_depen, areas_dependencias.nom_depen, areas_oficinas.nom_oficina,
                                areas_cargos.nom_cargo, temp_proyec.fechor_termina, temp_proyec.editando, temp_proyec.terminado
                        FROM archivo_radica_enviados_temp_proyector AS temp_proyec
                            INNER JOIN archivo_radica_enviados_temp AS temp ON (temp_proyec.id_temp = temp.id_temp)
                            INNER JOIN gene_funcionarios_deta AS funcio ON (temp_proyec.id_funcio_deta = funcio.id_funcio_deta)
                            INNER JOIN gene_funcionarios ON (funcio.id_funcio = gene_funcionarios.id_funcio)
                            INNER JOIN areas_oficinas ON (funcio.id_oficina = areas_oficinas.id_oficina)
                            INNER JOIN areas_dependencias ON (areas_oficinas.id_depen = areas_dependencias.id_depen)
                            INNER JOIN areas_cargos ON (areas_cargos.id_cargo = funcio.id_cargo)
                        WHERE temp.id_temp = :id_temp";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $IdTemp, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }

            $Result = $Instruc->fetchAll();
            $conexion = null;
            return $Result;

        }catch(PDOException $e){
            echo 'Ha surgido un error y no se puede ejecutar la consulta en Proyectores Radicado enviados Temporales.'.$e->getMessage();
            exit;
        }
    }

    public static function Buscar($Accion, $IdTemp, $IdFuncio){
        $conexion = new Conexion();
        $conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try{
            if($Accion == 1){
                $Sql = "SELECT *
                        FROM archivo_radica_enviados_temp
                        WHERE id_temp = :id_temp";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $IdTemp, PDO::PARAM_INT);
            }elseif($Accion == 6){
                /******************************************************************************************/
                /*  SABER QUIEN ESTA PROYECTANDO LA PLANTILLA
                /******************************************************************************************/
                $Sql = "SELECT *
                        FROM archivo_radica_enviados_temp_proyector
                        WHERE id_temp = :id_temp AND editando = 1";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $IdTemp, PDO::PARAM_INT);
            }elseif($Accion == 7){
                /******************************************************************************************/
                /*  SABER SI LA PLANTILLA SE ESTA EDITANDO POR EL USUARIO ACTUAL
                /******************************************************************************************/
                $Sql = "SELECT *
                        FROM archivo_radica_enviados_temp_proyector
                        WHERE id_temp = :id_temp AND id_funcio_deta = :id_funcio_deta";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $IdTemp, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_funcio_deta', $IdFuncio, PDO::PARAM_INT);
            }elseif($Accion == 8){
                /******************************************************************************************/
                /*  SABER QUIEN ESTA PROYECTANDO LA PLANTILLA
                /******************************************************************************************/
                $Sql = "SELECT *
                        FROM archivo_radica_enviados_temp_proyector
                        WHERE id_temp = :id_temp AND terminado = 0";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $IdTemp, PDO::PARAM_INT);
            }

            $Instruc -> execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            $Result = $Instruc->fetch();
            $conexion = null;

            if($Result){
                return new self("", $Result['id_temp'], $Result['id_funcio_deta'], $Result['fechor_asigna'], $Result['descargo_plantilla'],
                                $Result['subio_plantilla'], $Result['editando'], $Result['terminado'], $Result['fechor_termina']);
            } else {
                return false;
            }
        }catch(PDOException $e){
            echo 'Ha surgido un error y no se puede ejecutar la consulta en Radicado enviados Temp.'.$e->getMessage();
            exit;
        }
    }
}
?>