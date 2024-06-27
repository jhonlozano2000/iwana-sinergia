<?php
class RadicadoEnviadoTempResponsable{

    private $Accion;
    private $IdTemp;
    private $IdFuncio;
    private $FecHorAsigna;
    private $DescargoPlantilla;
    private $SubioPlantilla;
    private $Responsable;
    private $Aprobado;
    private $Editando;
    private $FecHorAprueba;

    public function __construct($Accion = null, $IdTemp = null, $IdFuncio = null, $FecHorAsigna = null, $DescargoPlantilla = null, $SubioPlantilla = null,
                                $Responsable = null, $Aprobado = null, $Editando = null, $FecHorAprueba = null){

        $this -> Accion            = $Accion;
        $this -> IdTemp            = $IdTemp;
        $this -> IdFuncio          = $IdFuncio;
        $this -> FecHorAsigna      = $FecHorAsigna;
        $this -> DescargoPlantilla = $DescargoPlantilla;
        $this -> SubioPlantilla    = $SubioPlantilla;
        $this -> Responsable       = $Responsable;
        $this -> Aprobado          = $Aprobado;
        $this -> FecHorAprueba     = $FecHorAprueba;
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

    public function get_Responsable(){
        return $this -> Responsable;
    }

    public function get_Aprobado(){
        return $this -> Aprobado;
    }

    public function get_Editando(){
        return $this -> Aprobado;
    }

    public function get_FecHorAprueba(){
        return $this -> FecHorAprueba;
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

    public function set_FecHorAsigna($FecHorAsigna){
        return $this -> FecHorAsigna = $FecHorAsigna;
    }

    public function set_DescargoPlantilla($DescargoPlantilla){
        return $this -> DescargoPlantilla = $DescargoPlantilla;
    }

    public function set_SubioPlantilla($SubioPlantilla){
        return $this -> SubioPlantilla = $SubioPlantilla;
    }

    public function set_Responsable($Responsable){
        return $this -> Responsable = $Responsable;
    }

    public function set_Aprobado($Aprobado){
        return $this -> Aprobado = $Aprobado;
    }

    public function set_Editando($Editando){
        return $this -> Editando = $Editando;
    }

    public function set_FecHorAprueba($FecHorAprueba){
        return $this -> FecHorAprueba = $FecHorAprueba;
    }

    public function Gestionar(){
        $conexion = new Conexion();

        try{
            if($this->Accion === 1){
                /******************************************************************************************/
                /* GUARDAR LA CORRESPONDENCIA SIN GENERAR EL RADICADO
                /******************************************************************************************/
                $Sql = 'INSERT INTO archivo_radica_enviados_temp_responsa(id_temp, id_funcio_deta, fechor_asignado, respon, aprobado, fechor_aprueba)
                        VALUES(:id_temp, :id_funcio_deta, :fechor_asignado, :respon, :aprobado, :fechor_aprueba)';

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $this->IdTemp, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_funcio_deta', $this->IdFuncio, PDO::PARAM_INT);
                $Instruc -> bindParam(':fechor_asignado', $this->FecHorAsigna, PDO::PARAM_STR);
                $Instruc -> bindParam(':respon', $this->Responsable, PDO::PARAM_INT);
                $Instruc -> bindParam(':aprobado', $this->Aprobado, PDO::PARAM_INT);
                $Instruc -> bindParam(':fechor_aprueba', $this->FecHorAprueba, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));

            }elseif($this->Accion === 2){
                /******************************************************************************************/
                /* MARCO COMO FIRMADO EL MENSAJE
                /******************************************************************************************/
                $Sql = 'UPDATE archivo_radica_enviados_temp_responsa
                        SET aprobado = :aprobado, fechor_firma = :fechor_firma
                        WHERE id_temp = :id_temp';

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':aprobado', $this->Aprobado, PDO::PARAM_INT);
                $Instruc -> bindParam(':fechor_firma', $this->FecHorFirma, PDO::PARAM_STR);
                $Instruc -> bindParam(':id_temp', $this->IdTemp, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($this->Accion == 'DESCARGO_PLANTILLA'){

                /************************************************************************************************************************/
                /*  MARCO QUE EL FUNCIONARIO DESCARGO LA PLANTILLA PARA INCICIAR EL PROCESOS DE APROBACION
                /************************************************************************************************************************/
                $Sql = "UPDATE archivo_radica_enviados_temp_responsa
                        SET descargo_plantilla = 1
                        WHERE id_temp = :id_temp AND id_funcio_deta = :id_funcio_deta";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $this->IdTemp, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_funcio_deta', $this->IdFuncio, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($this->Accion == 'QUITAR_APROBACION'){

                /************************************************************************************************************************/
                /*  MARCO QUE EL FUNCIONARIO DESCARGO LA PLANTILLA PARA INCICIAR EL PROCESOS DE APROBACION
                /************************************************************************************************************************/
                $Sql = "UPDATE archivo_radica_enviados_temp_responsa
                        SET aprobado = 0, fechor_aprueba = NULL
                        WHERE id_temp = :id_temp AND id_funcio_deta = :id_funcio_deta";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $this->IdTemp, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_funcio_deta', $this->IdFuncio, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($this->Accion == 'SUBIO_PLANTILLA'){

                /************************************************************************************************************************/
                /*  MARCO QUE EL FUNCIONARIO DESCARGO LA PLANTILLA PARA INCICIAR EL PROCESOS DE FIRMA
                /************************************************************************************************************************/
                $Sql = "UPDATE archivo_radica_enviados_temp_responsa
                        SET subio_plantilla = 1
                        WHERE id_temp = :id_temp AND id_funcio_deta = :id_funcio_deta";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $this->IdTemp, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_funcio_deta', $this->IdFuncio, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($this->Accion === 3){
                /******************************************************************************************/
                /* ELIMINO LOS RESPONSABLES
                /******************************************************************************************/
                $Sql = "DELETE FROM archivo_radica_enviados_temp_responsa
                        WHERE id_temp = :id_temp";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $this->IdTemp, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));

            }elseif($this->Accion === 'MARCO_EDITOR'){
                /******************************************************************************************/
                /* MARCO AL RESPONSABLE COMO EDITOR
                /******************************************************************************************/
                $Sql = "UPDATE archivo_radica_enviados_temp_responsa
                        SET editando = :editando
                        WHERE id_temp = :id_temp AND id_funcio_deta = :id_funcio_deta";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':editando', $this->Editando, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_funcio_deta', $this->IdFuncio, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_temp', $this->IdTemp, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));

            }elseif($this->Accion === 'ESTABLECER_RESPONSABLE'){
                /******************************************************************************************/
                /* MARCO EL RESPONSABLE DEL DOCUMENTOS
                /******************************************************************************************/
                $Sql = "UPDATE archivo_radica_enviados_temp_responsa
                        SET respon = 1
                        WHERE id_temp = :id_temp AND id_funcio_deta = :id_funcio_deta";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_funcio_deta', $this->IdFuncio, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_temp', $this->IdTemp, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));

            }elseif($this->Accion === 'APROBAR_DOCUMENTO'){
                /******************************************************************************************/
                /* MARCO EL RESPONSABLE DEL DOCUMENTOS
                /******************************************************************************************/
                $Sql = "UPDATE archivo_radica_enviados_temp_responsa
                        SET aprobado = 1, fechor_aprueba = :fechor_aprueba
                        WHERE id_temp = :id_temp AND id_funcio_deta = :id_funcio_deta";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':fechor_aprueba', $this->FecHorAprueba, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_temp', $this->IdTemp, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_funcio_deta', $this->IdFuncio, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }

            if($Instruc){
                return true;
            }else{
                return false;
            }
        }catch(PDOException $e){
            echo 'Ha surgido un error y no se puede ejecutar la consulta en Responsables Temp.'.$e->getMessage();
            exit;
        }
    }

    public static function Listar($Accion, $IdTemp, $IdFuncio){
        $conexion = new Conexion();

        try{
            if($Accion === 1){

                $Sql = "SELECT *
                        FROM archivo_radica_enviados_temp_responsa
                        WHERE id_temp = :id_temp";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $IdTemp, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));

            }elseif($Accion === 2){

                #*******************************************************************************************
                # LISTO LOS DATOS COMPLETOS DE LOS RESPONSABLES
                #*******************************************************************************************

                $Sql = "SELECT  `temp`.`id_temp`, `temp`.`existen_proyectores`, `temp_respon`.`id_funcio_deta`, `temp_respon`.`fechor_asignado`,
                            `temp_respon`.`respon`, `temp_respon`.`aprobado`, `temp_respon`.`fechor_aprueba`, `fun`.`nom_funcio`, `fun`.`ape_funcio`,
                            `fun`.`genero`, `depen`.`id_depen`, `depen`.`cod_depen`, `depen`.`cod_corres` AS `cod_corres_depen`, `depen`.`nom_depen`,
                            `ofi`.`cod_oficina`, `ofi`.`cod_corres` AS `cod_corres_ofi`, `ofi`.`nom_oficina`, `cargo`.`nom_cargo`,
                            `temp_respon`.`respon`, `temp_respon`.`aprobado`
                        FROM `archivo_radica_enviados_temp_responsa` AS `temp_respon`
                            INNER JOIN `archivo_radica_enviados_temp` AS `temp` ON (`temp_respon`.`id_temp` = `temp`.`id_temp`)
                            INNER JOIN `gene_funcionarios_deta` AS `dun_deta` ON (`temp_respon`.`id_funcio_deta` = `dun_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `fun` ON (`dun_deta`.`id_funcio` = `fun`.`id_funcio`)
                            INNER JOIN `areas_cargos` AS `cargo` ON (`dun_deta`.`id_cargo` = `cargo`.`id_cargo`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`dun_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                        WHERE (`temp`.`id_temp` = :id_temp)";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $IdTemp, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($Accion === 3){

                #*******************************************************************************************
                # LISTO LOS DATOS COMPLETOS DE LOS RESPONSABLES
                #*******************************************************************************************

                $Sql = "SELECT  `temp`.`id_temp`, `temp`.`existen_proyectores`, `temp_respon`.`id_funcio_deta`, `temp_respon`.`fechor_asignado`, `temp_respon`.`respon`,
                            `temp_respon`.`aprobado`, `temp_respon`.`fechor_aprueba`, `fun`.`nom_funcio`, `fun`.`ape_funcio`,`depen`.`id_depen`, `depen`.`cod_depen`,
                            `depen`.`cod_corres` AS `cod_corres_depen`, `depen`.`nom_depen`, `ofi`.`cod_oficina`, `ofi`.`cod_corres` AS `cod_corres_ofi`,
                            `ofi`.`nom_oficina`, `cargo`.`nom_cargo`
                        FROM `archivo_radica_enviados_temp_responsa` AS `temp_respon`
                            INNER JOIN `archivo_radica_enviados_temp` AS `temp` ON (`temp_respon`.`id_temp` = `temp`.`id_temp`)
                            INNER JOIN `gene_funcionarios_deta` AS `dun_deta` ON (`temp_respon`.`id_funcio_deta` = `dun_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `fun` ON (`dun_deta`.`id_funcio` = `fun`.`id_funcio`)
                            INNER JOIN `areas_cargos` AS `cargo` ON (`dun_deta`.`id_cargo` = `cargo`.`id_cargo`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`dun_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                        WHERE (`temp`.`id_temp` = :id_temp AND `temp_respon`.`respon` = 1)";

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
            }elseif($Accion === 2){
                $Sql = "SELECT *
                        FROM archivo_radica_enviados_temp_responsa
                        WHERE id_temp = :id_temp AND respon = 1";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $IdTemp, PDO::PARAM_INT);
            }elseif($Accion === 3){
                #*******************************************************************************************
                # SABER SI EL FUNCIONARIO ACTUAL ES EL RESPONSALBE
                #*******************************************************************************************
                $Sql = "SELECT *
                        FROM archivo_radica_enviados_temp_responsa
                        WHERE id_temp = :id_temp AND respon = 1 AND id_funcio_deta = :id_funcio_deta";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $IdTemp, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_funcio_deta', $IdFuncio, PDO::PARAM_INT);
            }elseif($Accion === 6){
                #*******************************************************************************************
                # SABER EL FUNCIONARIOQUE ESTA APROBANDO LA PLANTILLA
                #*******************************************************************************************
                $Sql = "SELECT *
                        FROM archivo_radica_enviados_temp_responsa
                        WHERE id_temp = :id_temp AND editando = 1";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $IdTemp, PDO::PARAM_INT);
            }elseif($Accion === 7){
                #*******************************************************************************************
                # SABER SI EL FUNCIONARIO ACTUAL ES RESPONSALBE
                #*******************************************************************************************
                $Sql = "SELECT *
                        FROM archivo_radica_enviados_temp_responsa
                        WHERE id_temp = :id_temp AND id_funcio_deta = :id_funcio_deta";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $IdTemp, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_funcio_deta', $IdFuncio, PDO::PARAM_INT);
            }elseif($Accion === 8){
                #*******************************************************************************************
                # SABER SI EL TEMP YA FUE APROBADO POR COMPLETO
                #*******************************************************************************************
                $Sql = "SELECT *
                        FROM archivo_radica_enviados_temp_responsa
                        WHERE id_temp = :id_temp AND aprobado = 0";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $IdTemp, PDO::PARAM_INT);
            }

            $Instruc -> execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            $Result = $Instruc->fetch();
            $conexion = null;

            if($Result){
                return new self("", $Result['id_temp'], $Result['id_funcio_deta'], $Result['fechor_asignado'], $Result['descargo_plantilla'],
                                $Result['subio_plantilla'], $Result['respon'], $Result['aprobado'], $Result['editando'], $Result['fechor_aprueba']);
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
