<?php
class RadicadoEnviadoTempQuienFirma{
    //Atributos
    private $Accion;
    private $IdTemp;
    private $IdFuncio;
    private $FirmaPrinci;
    private $FecHorAsignado;
    private $DescargoPlantilla;
    private $SubioPlantilla;
    private $Firmando;
    private $FecHorFirma;
    private $Firmado;

    public function __construct($Accion = null, $IdTemp = null, $IdFuncio = null, $FirmaPrinci = null, $FecHorAsignado = null, $DescargoPlantilla = null,
                                $SubioPlantilla = null, $Firmando = null, $FecHorFirma = null, $Firmado = null){

        $this -> Accion            = $Accion;
        $this -> IdTemp            = $IdTemp;
        $this -> IdFuncio          = $IdFuncio;
        $this -> FirmaPrinci       = $FirmaPrinci;
        $this -> FecHorAsignado    = $FecHorAsignado;
        $this -> DescargoPlantilla = $DescargoPlantilla;
        $this -> SubioPlantilla    = $SubioPlantilla;
        $this -> Firmando          = $Firmando;
        $this -> FecHorFirma       = $FecHorFirma;
        $this -> Firmado           = $Firmado;
    }

    public function get_IdTemp(){
        return $this -> IdTemp;
    }

    public function get_IdFuncio(){
        return $this -> IdFuncio;
    }

    public function get_FirmaPrinci(){
        return $this -> FirmaPrinci;
    }

    public function get_FecHorAsignado(){
        return $this -> FecHorAsignado;
    }

    public function get_DescargoPlantilla(){
        return $this -> DescargoPlantilla;
    }

    public function get_SubioPlantilla(){
        return $this -> SubioPlantilla;
    }

    public function get_Firmando(){
        return $this -> Firmando;
    }

    public function get_FecHorFirma(){
        return $this -> FecHorFirma;
    }

    public function get_Firmado(){
        return $this -> Firmado;
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

    public function set_FirmaPrinci($FirmaPrinci){
        return $this -> FirmaPrinci = $FirmaPrinci;
    }

    public function set_FecHorAsignado($FecHorAsignado){
        return $this -> FecHorAsignado = $FecHorAsignado;
    }

    public function set_DescargoPlantilla($DescargoPlantilla){
        return $this -> DescargoPlantilla = $DescargoPlantilla;
    }

    public function set_SubioPlantilla($SubioPlantilla){
        return $this -> SubioPlantilla = $SubioPlantilla;
    }

    public function set_Firmando($Firmando){
        return $this -> Firmando = $Firmando;
    }

    public function set_FecHorFirma($FecHorFirma){
        return $this -> FecHorFirma = $FecHorFirma;
    }

    public function set_Firmado($Firmado){
        return $this -> Firmado = $Firmado;
    }

    //Metodos
	public function Gestionar(){
        $conexion = new Conexion();

        try{

    		if($this->Accion == 'ESTABLECER_QUIEN_FIRMA'){
    			$Sql = 'INSERT INTO `archivo_radica_enviados_temp_quienes_firman`(`id_temp`, `id_funcio_deta`, `fechor_asignado`)
                        VALUES (:id_temp, :id_funcio_deta, :fechor_asignado)';

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $this->IdTemp, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_funcio_deta', $this->IdFuncio, PDO::PARAM_INT);
                $Instruc -> bindParam(':fechor_asignado', $this->FecHorAsignado, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));

    		}elseif($this->Accion == 2){
    			$Sql = "DELETE FROM archivo_radica_enviados_temp_quienes_firman
                        WHERE id_temp = ".$this->IdTemp;

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $this->IdTemp, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($this->Accion == 'DESCARGO_PLANTILLA'){

                /************************************************************************************************************************/
                /*  MARCO QUE EL FUNCIONARIO DESCARGO LA PLANTILLA PARA INCICIAR EL PROCESOS DE FIRMA
                /************************************************************************************************************************/
                $Sql = "UPDATE archivo_radica_enviados_temp_quienes_firman
                        SET descargo_plantilla = 1
                        WHERE id_temp = :id_temp AND id_funcio_deta = :id_funcio_deta";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $this->IdTemp, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_funcio_deta', $this->IdFuncio, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($this->Accion == 'SUBIO_PLANTILLA'){

                /************************************************************************************************************************/
                /*  MARCO QUE EL FUNCIONARIO DESCARGO LA PLANTILLA PARA INCICIAR EL PROCESOS DE FIRMA
                /************************************************************************************************************************/
                $Sql = "UPDATE archivo_radica_enviados_temp_quienes_firman
                        SET subio_plantilla = 1
                        WHERE id_temp = :id_temp AND id_funcio_deta = :id_funcio_deta";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $this->IdTemp, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_funcio_deta', $this->IdFuncio, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($this->Accion == 'ESTABLECER_FIRMA_PRINCIPAL'){
                /***********************************************************************************************
                * ESTABLECER EL FUNCIONARIO FirmaPrinciPAL QUE FIRMA LA CORRESPONDENCIA
                /***********************************************************************************************/
                $Sql = "UPDATE archivo_radica_enviados_temp_quienes_firman
                        SET firma_principal = 1
                        WHERE id_temp = :id_temp AND id_funcio_deta = :id_funcio_deta";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $this->IdTemp, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_funcio_deta', $this->IdFuncio, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($this->Accion == 'ESTABLECER_QUIEN_ESTA_FIRMANDO'){
                /***********************************************************************************************
                * ESTABLECER EL FUNCIONARIO FirmaPrinciPAL QUE FIRMA LA CORRESPONDENCIA
                /***********************************************************************************************/
                $Sql = "UPDATE archivo_radica_enviados_temp_quienes_firman
                        SET firmando = 1
                        WHERE id_temp = :id_temp AND id_funcio_deta = :id_funcio_deta";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $this->IdTemp, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_funcio_deta', $this->IdFuncio, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($this->Accion == 'QUITAR_QUIEN_ESTA_FIRMANDO'){
                /***********************************************************************************************
                * ESTABLECER EL FUNCIONARIO FirmaPrinciPAL QUE FIRMA LA CORRESPONDENCIA
                /***********************************************************************************************/
                $Sql = "UPDATE archivo_radica_enviados_temp_quienes_firman
                        SET firmando = 0
                        WHERE id_temp = :id_temp AND id_funcio_deta = :id_funcio_deta";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $this->IdTemp, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_funcio_deta', $this->IdFuncio, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($this->Accion == 'QUITAR_FIRMA'){
                /***********************************************************************************************
                * ESTABLECER EL FUNCIONARIO FirmaPrinciPAL QUE FIRMA LA CORRESPONDENCIA
                /***********************************************************************************************/
                $Sql = "UPDATE archivo_radica_enviados_temp_quienes_firman
                        SET firmado = 0
                        WHERE id_temp = :id_temp AND id_funcio_deta = :id_funcio_deta";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $this->IdTemp, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_funcio_deta', $this->IdFuncio, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($this->Accion == 'FIRMAR_DOCUMENTO'){
                /***********************************************************************************************
                * FORMAR LA CORRESPONDENCIA
                /***********************************************************************************************/
                $Sql = "UPDATE archivo_radica_enviados_temp_quienes_firman
                        SET firmado = 1, fechor_firmado = :fechor_firmado
                        WHERE id_temp = :id_temp AND id_funcio_deta = :id_funcio_deta";
                        //echo $this->FecHorFirma."--".$this->IdTemp."--".$this->IdFuncio;
                        //exit();
                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':fechor_firmado', $this->FecHorFirma, PDO::PARAM_STR);
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
            echo 'Ha surgido un error y no se puede ejecutar la consulta, Enviado temp quien firma.'.$e->getMessage();
            exit;
        }
    }

	public static function Listar($Accion, $IdTempdo, $Funcio){
        $conexion = new Conexion();

        try{
           if($Accion == 1){
                /******************************************************************************************/
                /*  LISTO LOS FUNCIONARIOS QUE FIRMAN DE UN RADICADO EN PARTICULAR
                /******************************************************************************************/
                $Sql = "SELECT `ra_quien_firma`.`id_temp`, `funcio_deta`.`id_funcio_deta`, `funcio`.`id_funcio`, `funcio`.`cod_funcio`,
                            `funcio`.`nom_funcio`, `funcio`.`ape_funcio`, `depen`.`nom_depen`, `ofi`.`nom_oficina`, `ra_quien_firma`.`firma_principal`,
                            `cargo`.`nom_cargo`, `ra_quien_firma`.`firmado`, `ra_quien_firma`.`firma_principal`, `ra_quien_firma`.`fechor_firmado`
                        FROM  `archivo_radica_enviados_temp_quienes_firman` AS `ra_quien_firma`
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_quien_firma`.`id_funcio_deta` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            INNER JOIN `areas_cargos` AS `cargo` ON (`funcio_deta`.`id_cargo` = `cargo`.`id_cargo`)
                        WHERE (`ra_quien_firma`.`id_temp` = :id_temp)";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":id_temp", $IdTempdo, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($Accion == 2){
                /******************************************************************************************/
                /*  LISTO EL FUNCIONARIO FirmaPrinciPAL QUE FIRMA
                /******************************************************************************************/
                $Sql = "SELECT `ra_quien_firma`.`id_temp`, `funcio_deta`.`id_funcio_deta`, `funcio`.`id_funcio`, `funcio`.`cod_funcio`,
                            `funcio`.`nom_funcio`, `funcio`.`ape_funcio`, `depen`.`nom_depen`, `ofi`.`nom_oficina`, `ra_quien_firma`.`firmado`, `ra_quien_firma`.`firma_principal`
                        FROM  `archivo_radica_enviados_temp_quienes_firman` AS `ra_quien_firma`
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_quien_firma`.`id_funcio_deta` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                        WHERE (`ra_quien_firma`.`id_temp` = :id_temp AND `ra_quien_firma`.`firma_principal` = 1)";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":id_temp", $IdTemp, PDO::PARAM_STR);
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

    public static function Buscar($Accion, $IdTemp, $IdFuncio) {
		$conexion = new Conexion();
        $conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try{
            if($Accion == 1){
                $Sql = "SELECT *
                        FROM archivo_radica_enviados_temp_quienes_firman
                        WHERE id_temp = :id_temp";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $IdTemp, PDO::PARAM_INT);

            }elseif($Accion == 2){
                $Sql = "SELECT *
                        FROM archivo_radica_enviados_temp_quienes_firman
                        WHERE id_funcio_deta = :id_funcio_deta";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_funcio_deta', $IdFuncio, PDO::PARAM_INT);
            }elseif($Accion == 6){
                /******************************************************************************************/
                /*  SABER QUIEN ESTA FIRMANDO LA PLANTILLA
                /******************************************************************************************/
                $Sql = "SELECT *
                        FROM archivo_radica_enviados_temp_quienes_firman
                        WHERE id_temp = :id_temp AND firmando = 1";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $IdTemp, PDO::PARAM_INT);
            }elseif($Accion == 7){
                /******************************************************************************************/
                /*  SABER SI EL FUNCIONARIO ACTUAL ES QUIEN FIRMA
                /******************************************************************************************/
                $Sql = "SELECT *
                        FROM archivo_radica_enviados_temp_quienes_firman
                        WHERE id_temp = :id_temp AND id_funcio_deta = :id_funcio_deta";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $IdTemp, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_funcio_deta', $IdFuncio, PDO::PARAM_INT);
            }

            $Instruc -> execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            $Result = $Instruc->fetch();
            $conexion = null;

            if($Result){
    			return new self("", $Result['id_temp'], $Result['id_funcio_deta'], $Result['firma_principal'], $Result['fechor_asignado'],
                                $Result['descargo_plantilla'], $Result['subio_plantilla'], $Result['firmando'], $Result['fechor_firmado'],
                                $Result['firmado']);
    		}else{
    			return false;
    		}
        }catch(PDOException $e){
            echo 'Ha surgido un error y no se puede ejecutar la consulta, Buscar Quien firma temporal.'.$e->getMessage();
            exit;
        }
	}
}
?>
