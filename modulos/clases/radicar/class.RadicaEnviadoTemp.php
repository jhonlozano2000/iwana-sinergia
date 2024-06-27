<?php
class RadicadoEnviadoTemp{

	//Atributos
	private $Accion;
    private $IdTemp;
	private $IdSerie;
	private $IdSubserie;
	private $IdTipoDoc;
	private $IdUsuaRegis;
    private $IdDestinatario;
    private $IdStatus;
    private $IdSaludo;
    private $IdDespedida;
    private $IdRuta;
	private $FecHorRegistro;
    private $Asunto;
    private $ConCopia;
    private $Anexos;
	private $Adjunto;
    private $Terminado;
    private $ExistenProyectores;
    private $NomArchivo;
    private $GeneraPlantilla;
    private $PlantillaCargada;
	
    public function __construct($Accion = null, $IdTemp = null, $IdSerie = null, $IdSubserie = null, $IdTipoDoc = null, $IdUsuaRegis = null, $IdDestinatario =null, $IdStatus = null, 
                                $IdSaludo = null, $IdDespedida = null, $IdRuta = null, $FecHorRegistro = null, $Asunto = null, $ConCopia = null, $Anexos = null, $Adjunto = null, 
                                $Terminado = null, $ExistenProyectores = null, $NomArchivo = null, $GeneraPlantilla =null, $PlantillaCargada = null){
        
        $this -> Accion             = $Accion;
        $this -> IdTemp             = $IdTemp;
        $this -> IdSerie            = $IdSerie;
        $this -> IdSubserie         = $IdSubserie;
        $this -> IdTipoDoc          = $IdTipoDoc;
        $this -> IdUsuaRegis        = $IdUsuaRegis;
        $this -> IdDestinatario     = $IdDestinatario;
        $this -> IdStatus           = $IdStatus;
        $this -> IdSaludo           = $IdSaludo;
        $this -> IdDespedida        = $IdDespedida;
        $this -> IdRuta             = $IdRuta;
        $this -> FecHorRegistro     = $FecHorRegistro;
        $this -> Asunto             = $Asunto;
        $this -> ConCopia           = $ConCopia;
        $this -> Anexos             = $Anexos;
        $this -> Adjunto            = $Adjunto;
        $this -> Terminado          = $Terminado;
        $this -> ExistenProyectores = $ExistenProyectores;
        $this -> NomArchivo         = $NomArchivo;
        $this -> GeneraPlantilla    = $GeneraPlantilla;
        $this -> PlantillaCargada   = $PlantillaCargada;
	}

	public function get_IdTemp(){
        return $this -> IdTemp;
    }

    public function get_IdSerie(){
        return $this -> IdSerie;
    }
    
    public function get_IdSubserie(){
        return $this -> IdSubserie;
    }
    
    public function get_IdTipoDoc(){
        return $this -> IdTipoDoc;
    }
    
    public function get_IdUsuaRegis(){
        return $this -> IdUsuaRegis;
    }

    public function get_IdDestinatario(){
        return $this -> IdDestinatario;
    }

    public function get_IdStatus(){
        return $this -> IdStatus;
    }

    public function get_IdSaludo(){
        return $this -> IdSaludo;
    }

    public function get_IdDespedida(){
        return $this -> IdDespedida;
    }

    public function get_IdRuta(){
        return $this -> IdRuta;
    }

    public function get_FecHorRegistro(){
        return $this -> FecHorRegistro;
    }

    public function get_Asunto(){
        return $this -> Asunto;
    }

    public function get_ConCopia(){
        return $this -> ConCopia;
    }

    public function get_Anexos(){
        return $this -> Anexos;
    }

    public function get_Adjunto(){
        return $this -> Adjunto;
    }

    public function get_Terminado(){
        return $this -> Terminado;
    }

    public function get_ExistenProyectores(){
        return $this -> ExistenProyectores;
    }

    public function get_NomArchivo(){
        return $this -> NomArchivo;
    }

    public function get_Genera_Plantilla(){
        return $this -> GeneraPlantilla;
    }

    public function get_Plantilla_Cargada(){
        return $this -> PlantillaCargada;
    }

    ///////////////////////////////////////////////////

    public function set_Accion($Accion){
        return $this -> Accion = $Accion;
    }

    public function set_IdTemp($IdTemp){
        return $this -> IdTemp = $IdTemp;
    }

    public function set_IdSerie($IdSerie){
        return $this -> IdSerie = $IdSerie;
    }
    
    public function set_IdSubserie($IdSubserie){
        return $this -> IdSubserie = $IdSubserie;
    }
    
    public function set_IdTipoDoc($IdTipoDoc){
        return $this -> IdTipoDoc = $IdTipoDoc;
    }

    public function set_IdUsuaRegis($IdUsuaRegis){
        return $this -> IdUsuaRegis = $IdUsuaRegis;
    }

    public function set_IdDestinatario($IdDestinatario){
        return $this -> IdDestinatario = $IdDestinatario;
    }

    public function set_IdStatus($IdStatus){
        return $this -> IdStatus = $IdStatus;
    }

    public function set_IdSaludo($IdSaludo){
        return $this -> IdSaludo = $IdSaludo;
    }

    public function set_IdDespedida($IdDespedida){
        return $this -> IdDespedida = $IdDespedida;
    }

    public function set_IdRuta($IdRuta){
        return $this -> IdRuta = $IdRuta;
    }

    public function set_FecHorRegistro($FecHorRegistro){
        return $this -> FecHorRegistro = $FecHorRegistro;
    }

    public function set_Asunto($Asunto){
        return $this -> Asunto = $Asunto;
    }

    public function set_ConCopia($ConCopia){
        return $this -> ConCopia = $ConCopia;
    }

    public function set_Anexos($Anexos){
        return $this -> Anexos = $Anexos;
    }

    public function set_Adjunto($Adjunto){
        return $this -> Adjunto = $Adjunto;
    }

    public function set_Terminado($Terminado){
        return $this -> Terminado = $Terminado;
    }

    public function set_Existe_Proyectores($ExistenProyectores){
        return $this -> ExistenProyectores = $ExistenProyectores;
    }

    public function set_NomArchivo($NomArchivo){
        return $this -> NomArchivo = $NomArchivo;
    }

    public function set_Genera_Plantilla($GeneraPlantilla){
        return $this -> GeneraPlantilla = $GeneraPlantilla;
    }

    public function set_Plantilla_Cargada($PlantillaCargada){
        return $this -> PlantillaCargada = $PlantillaCargada;
    }

    //Metodos
    public function Gestionar(){
        $conexion = new Conexion();
        
        $ParamSerie = PDO::PARAM_INT;
        if ($this->IdSerie == "NULL"){
            $ParamSerie =  \PDO::PARAM_NULL;
        }

        $ParamSubSerie = PDO::PARAM_INT;
        if($this->IdSubserie == "NULL"){
            $ParamSubSerie =  \PDO::PARAM_NULL;
        }

        $ParamStatus = PDO::PARAM_INT;
        if (is_null($this->IdStatus) || $this->IdStatus == "NULL"){
            $ParamStatus =  \PDO::PARAM_NULL;
        }

        $ParamSaludo = PDO::PARAM_INT;
        if (is_null($this->IdSaludo) || $this->IdSaludo == "NULL"){
            $ParamSaludo = \PDO::PARAM_NULL;
        }

        $ParamDespedida = PDO::PARAM_INT;
        if (is_null($this->IdDespedida) || $this->IdDespedida == "NULL"){
            $ParamDespedida = \PDO::PARAM_NULL;
        }
 
        try{
            if($this->Accion == 'GENERAR_PLANTILLA'){
                $Sql = "UPDATE archivo_radica_enviados_temp 
                        SET genera_plantilla = 1 
                        WHERE id_temp = :id_temp";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $this->IdTemp, PDO::PARAM_INT);

            }elseif($this->Accion == 'EDITAR' && $this->IdTemp){
                $Sql = "UPDATE archivo_radica_enviados_temp 
                        SET id_serie = :id_serie, id_subserie = :id_subserie, id_tipodoc = :id_tipodoc, id_status = :id_status, id_saludo = :id_saludo, id_despedida = :id_despedida, 
                            asunto = :asunto, existen_proyectores = :existen_proyectores 
                        WHERE id_temp = :id_temp";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_serie', $this->IdSerie, $ParamSerie);
                $Instruc -> bindParam(':id_subserie', $this->IdSubserie, $ParamSubSerie);
                $Instruc -> bindParam(':id_tipodoc', $this->IdTipoDoc, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_status', $this->IdStatus, $ParamStatus);
                $Instruc -> bindParam(':id_saludo', $this->IdSaludo, $ParamSaludo);
                $Instruc -> bindParam(':id_despedida', $this->IdDespedida, $ParamDespedida);
                $Instruc -> bindParam(':asunto', $this->Asunto, PDO::PARAM_STR);
                $Instruc -> bindParam(':existen_proyectores', $this->ExistenProyectores, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_temp', $this->IdTemp, PDO::PARAM_INT);

            }elseif($this->Accion === 'GUARDAR'){
                $Sql = "INSERT INTO archivo_radica_enviados_temp(id_destina, id_serie, id_subserie, id_tipodoc, id_usua_regis, id_status, 
                            id_saludo, id_despedida, fechor_registro, asunto, con_copia, anexos, adjunto, terminado, existen_proyectores, genera_plantilla, plantilla_cargada)
                        VALUES(:id_destina, :id_serie, :id_subserie, :id_tipodoc, :id_usua_regis, :id_status, 
                            :id_saludo, :id_despedida, :fechor_registro, :asunto, :con_copia, :anexos, :adjunto, :terminado, :existen_proyectores, :genera_plantilla, 0)";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_destina', $this->IdDestinatario, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_serie', $this->IdSerie, $ParamSerie);
                $Instruc -> bindParam(':id_subserie', $this->IdSubserie, $ParamSubSerie);
                $Instruc -> bindParam(':id_usua_regis', $this->IdUsuaRegis, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_tipodoc', $this->IdTipoDoc, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_status', $this->IdStatus, $ParamStatus);
                $Instruc -> bindParam(':id_saludo', $this->IdSaludo, $ParamSaludo);
                $Instruc -> bindParam(':id_despedida', $this->IdDespedida, PDO::PARAM_INT);
                $Instruc -> bindParam(':fechor_registro', $this->FecHorRegistro, PDO::PARAM_STR);
                $Instruc -> bindParam(':asunto', $this->Asunto, PDO::PARAM_STR);
                $Instruc -> bindParam(':con_copia', $this->ConCopia, PDO::PARAM_STR);
                $Instruc -> bindParam(':anexos', $this->Anexos, PDO::PARAM_STR);
                $Instruc -> bindParam(':adjunto', $this->Adjunto, PDO::PARAM_INT);
                $Instruc -> bindParam(':terminado', $this->Terminado, PDO::PARAM_INT);
                $Instruc -> bindParam(':existen_proyectores', $this->ExistenProyectores, PDO::PARAM_INT);
                $Instruc -> bindParam(':genera_plantilla', $this->GeneraPlantilla, PDO::PARAM_INT);

             }elseif($this->Accion === 'GUARDAR_SOLICITUD_HISTORIA_CLINICA'){
                $Sql = "INSERT INTO archivo_radica_enviados_temp(id_destina, id_serie, id_subserie, id_tipodoc, id_usua_regis, 
                            asunto, adjunto, terminado, existen_proyectores, genera_plantilla)
                        VALUES(:id_destina, :id_serie, :id_subserie, :id_tipodoc, :id_usua_regis, 
                            :asunto, :adjunto, :terminado, :existen_proyectores, :genera_plantilla)";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_destina', $this->IdDestinatario, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_serie', $this->IdSerie, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_subserie', $this->IdSubserie, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_usua_regis', $this->IdUsuaRegis, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_tipodoc', $this->IdTipoDoc, PDO::PARAM_INT);
                $Instruc -> bindParam(':asunto', $this->Asunto, PDO::PARAM_STR);
                $Instruc -> bindParam(':adjunto', $this->Adjunto, PDO::PARAM_INT);
                $Instruc -> bindParam(':terminado', $this->Terminado, PDO::PARAM_INT);
                $Instruc -> bindParam(':existen_proyectores', $this->ExistenProyectores, PDO::PARAM_INT);
                $Instruc -> bindParam(':genera_plantilla', $this->GeneraPlantilla, PDO::PARAM_INT);

            }elseif($this->Accion === 'EDITAR'){
                $Sql = "UPDATE archivo_radica_enviados_temp SET id_destina = :id_destina, id_serie = :id_serie, 
                            id_subserie = :id_subserie, id_tipodoc = :id_tipodoc, id_status = :id_status, 
                            id_saludo = :id_saludo, id_despedida = :id_despedida, asunto = :asunto, 
                            existen_proyectores = :existen_proyectores, genera_plantilla = :genera_plantilla
                        WHERE id_temp = :id_temp";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_destina', $this->IdDestinatario, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_serie', $this->IdSerie, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_subserie', $this->IdSubserie, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_tipodoc', $this->IdTipoDoc, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_status', $this->IdStatus, $ParamStatus);
                $Instruc -> bindParam(':id_saludo', $this->IdSaludo, $ParamSaludo);
                $Instruc -> bindParam(':id_despedida', $this->IdDespedida, $ParamDespedida);
                $Instruc -> bindParam(':asunto', $this->Asunto, PDO::PARAM_STR);
                $Instruc -> bindParam(':existen_proyectores', $this->ExistenProyectores, PDO::PARAM_INT);
                $Instruc -> bindParam(':genera_plantilla', $this->GeneraPlantilla, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_temp', $this->IdTemp, PDO::PARAM_INT);

             }elseif($this->Accion === 'RADICAR_TEMP'){
                $Sql = "UPDATE archivo_radica_enviados_temp 
                        SET radicado = 1
                        WHERE id_temp = :id_temp";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $this->IdTemp, PDO::PARAM_INT);
            }elseif($this->Accion === 'ACTUALIZA_NOM_ARCHIVO'){

                $Sql = "UPDATE archivo_radica_enviados_temp 
                        SET nom_archivo = :nom_archivo, id_ruta = :id_ruta
                        WHERE id_temp = :id_temp";
                        
                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':nom_archivo', $this->NomArchivo, PDO::PARAM_STR);
                $Instruc -> bindParam(':id_ruta', $this->IdRuta, PDO::PARAM_STR);
                $Instruc -> bindParam(':id_temp', $this->IdTemp, PDO::PARAM_INT);
            }elseif($this->Accion === 'CARGUE_PLANTILLA'){

                $Sql = "UPDATE archivo_radica_enviados_temp SET plantilla_cargada = :plantilla_cargada
                        WHERE id_temp = :id_temp";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':plantilla_cargada', $this->PlantillaCargada, PDO::PARAM_STR);
                $Instruc -> bindParam(':id_temp', $this->IdTemp, PDO::PARAM_INT);
            }elseif($this->Accion === 'TERMINAR_TEMP'){
                
                $Sql = "UPDATE archivo_radica_enviados_temp
                        SET terminado = 1
                        WHERE id_temp = :id_temp";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $this->IdTemp, PDO::PARAM_INT);
            }elseif($this->Accion === 'ELIMINA_TEMP'){
                $Sql = "DELETE FROM archivo_radica_enviados_temp
                        WHERE id_temp = :id_temp";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $this->IdTemp, PDO::PARAM_INT);
            }elseif($this->Accion === 'ANULAR_TEMP'){
                
                $Sql = "UPDATE archivo_radica_enviados_temp
                        SET anulado = 1, id_funcio_deta_anula = :id_funcio_deta_anula, fechor_anula = :fechor_anula
                        WHERE id_temp = :id_temp";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $this->IdTemp, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_funcio_deta_anula', $this->IdUsuaRegis, PDO::PARAM_INT);
                $Instruc -> bindParam(':fechor_anula', $this->FecHorRegistro, PDO::PARAM_INT);
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
            echo 'Ha surgido un error y no se puede ejecutar la consulta en Radicado enviados Temp en Generar - '.$this->Accion.". ".$e->getMessage();
            exit;
        }
    }

    public static function Listar_Varios($Accion, $IdTemp, $IdFuncioDeta, $IdFuncio, $IdDepen, $IdOfi, $Criterio1, $Criterio2, $Criterio3){
        $conexion = new Conexion();

        try{
            if($Accion == 1){
                /******************************************************************************************/
                /*  LISTO LOS DATOS DE UN TEMPORAL
                /******************************************************************************************/
                $Sql = "SELECT `Temp`.`id_temp`, `Temp`.`id_temp`, `Temp`.`fechor_registro`, `Temp`.`asunto`, `Temp`.`con_copia`, `Temp`.`anexos`, `Temp`.`adjunto`, `Temp`.`terminado`, 
                            `Temp`.`existen_proyectores`, `Temp`.`nom_archivo`, `Temp`.`genera_plantilla`, `Temp`.`plantilla_cargada`, `Temp`.`radicado`, `serie`.`cod_serie`, 
                            `serie`.`nom_serie`, `sub_serie`.`cod_subserie`, `sub_serie`.`nom_subserie`, `tip_docu`.`nom_tipodoc`, `funcio_firma`.`cod_funcio` AS `cod_funcio_firma`, 
                            `funcio_firma`.`nom_funcio` AS `nom_funcio_firma`, `funcio_firma`.`ape_funcio`, `funcio_firma`.`genero`, `ofi_firma`.`cod_oficina` AS `cod_oficina_firma`, 
                            `ofi_firma`.`cod_corres` AS `cod_corres_firma`, `ofi_firma`.`nom_oficina` AS `nom_oficina_firma`, `depen_firma`.`cod_depen` AS `cod_depen_firma`, 
                            `depen_firma`.`cod_corres` AS `cod_corres_firma`, `depen_firma`.`nom_depen` AS `nom_depen_firma`, `saludo`.`saludo`, `status`.`status`, `despedida`.`despedida`, 
                            `contac`.`num_docu`, `contac`.`nom_contac`, `contac`.`dir` AS `dir_contac`, `contac`.`tel`, `contac`.`cel`, `contac`.`cargo`, 
                            `depar_contac`.`nom_depar` AS `nom_depar_contac`, `muni_contac`.`nom_muni` AS `nom_muni_contac`, `empre`.`nit_empre`, `empre`.`razo_soci`, 
                            `empre`.`dir` AS `dir_empre`, `empre`.`tel`, `empre`.`cel`, `depar_empre`.`nom_depar` AS `nom_depar_empre`, `muni_empre`.`nom_muni` AS `nom_muni_empre`, 
                            `funcio_respon`.`cod_funcio` AS `cod_funcio_respon`, `funcio_respon`.`nom_funcio` AS `nom_funcio_respon`, `funcio_respon`.`ape_funcio` AS `ape_funcio_respon`, 
                            `ofi_respon`.`cod_oficina` AS `cod_oficina_respon`, `ofi_respon`.`cod_corres` AS `cod_corres_respon`, `ofi_respon`.`nom_oficina` AS `nom_oficina_respon`, 
                            `depen_respon`.`cod_depen` AS `cod_depen_respon`, `depen_respon`.`cod_corres` AS `cod_corres_respon`, `depen_respon`.`nom_depen` AS `nom_depen_respon`
                    FROM`archivo_radica_enviados_temp_quienes_firman` AS `temp_funcio_firma`
                        INNER JOIN `archivo_radica_enviados_temp` AS `Temp` ON (`temp_funcio_firma`.`id_temp` = `Temp`.`id_temp`)
                        INNER JOIN `gene_funcionarios_deta` AS `funcio_firma_deta` ON (`temp_funcio_firma`.`id_funcio_deta` = `funcio_firma_deta`.`id_funcio_deta`)
                        LEFT JOIN `archivo_trd_series` AS `serie` ON (`Temp`.`id_serie` = `serie`.`id_serie`)
                        LEFT JOIN `archivo_trd_subserie` AS `sub_serie` ON (`Temp`.`id_subserie` = `sub_serie`.`id_subserie`)
                        LEFT JOIN `archivo_trd_tipo_docu` AS `tip_docu` ON (`Temp`.`id_tipodoc` = `tip_docu`.`id_tipodoc`)
                        LEFT JOIN `config_saludo` AS `saludo` ON (`Temp`.`id_saludo` = `saludo`.`id_saludo`)
                        LEFT JOIN `config_status` AS `status` ON (`Temp`.`id_status` = `status`.`id_status`)
                        LEFT JOIN `config_despedida` AS `despedida` ON (`Temp`.`id_despedida` = `despedida`.`id_despedida`)
                        INNER JOIN `areas_oficinas` AS `ofi_firma` ON (`funcio_firma_deta`.`id_oficina` = `ofi_firma`.`id_oficina`)
                        INNER JOIN `gene_funcionarios` AS `funcio_firma` ON (`funcio_firma_deta`.`id_funcio` = `funcio_firma`.`id_funcio`)
                        INNER JOIN `areas_dependencias` AS `depen_firma` ON (`ofi_firma`.`id_depen` = `depen_firma`.`id_depen`)
                        INNER JOIN `gene_terceros_contac` AS `contac` ON (`contac`.`id_tercero` = `Temp`.`id_destina`)
                        LEFT JOIN `gene_terceros_empresas` AS `empre` ON (`contac`.`id_empre` = `empre`.`id_empre`)
                        LEFT JOIN `config_muni` AS `muni_contac` ON (`contac`.`id_muni` = `muni_contac`.`id_muni`)
                        LEFT JOIN `config_depar` AS `depar_contac` ON (`contac`.`id_depar` = `depar_contac`.`id_depar`)
                        LEFT JOIN `config_muni` AS `muni_empre` ON (`empre`.`id_muni` = `muni_empre`.`id_muni`)
                        LEFT JOIN `config_depar` AS `depar_empre` ON (`empre`.`id_depar` = `depar_empre`.`id_depar`)
                        INNER JOIN `archivo_radica_enviados_temp_responsa` AS `temp_funcio_respon` ON (`temp_funcio_respon`.`id_temp` = `Temp`.`id_temp`)
                        INNER JOIN `gene_funcionarios_deta` AS `funcio_respon_deta` ON (`temp_funcio_respon`.`id_funcio_deta` = `funcio_respon_deta`.`id_funcio_deta`)
                        INNER JOIN `gene_funcionarios` AS `funcio_respon` ON (`funcio_respon_deta`.`id_funcio` = `funcio_respon`.`id_funcio`)
                        INNER JOIN `areas_oficinas` AS `ofi_respon` ON (`funcio_respon_deta`.`id_oficina` = `ofi_respon`.`id_oficina`)
                        INNER JOIN `areas_dependencias` AS `depen_respon` ON (`ofi_respon`.`id_depen` = `depen_respon`.`id_depen`)
                    WHERE (`Temp`.`id_temp` = :id_temp)";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $IdTemp, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($Accion == 2){
                    /******************************************************************************************/
                    /*  LISTO LOS PENDIENTES POR RADICAR PARA VENTANILLA
                    /******************************************************************************************/
                    $Sql = "SELECT temp.id_temp, temp.asunto, temp.fechor_registro, usua_regis.nom_funcio AS nom_funcio_propie, usua_regis.ape_funcio AS ape_funcio_propie, 
                                usua_regis_depen.nom_depen AS nom_depen_propie, usua_regis_ofi.nom_oficina AS nom_oficina_propie, 
                                respon_temp.id_funcio_deta AS id_funcio_deta_temp, respon_temp.aprobado, temp.terminado, 
                                respon.cod_funcio AS cod_funcio_respon, respon.nom_funcio AS nom_funcio, respon.ape_funcio AS ape_funcio, 
                                depen_respon.nom_depen AS nom_depen, ofi_respon.nom_oficina AS nom_oficina, gene_terceros_contac.nom_contac, 
                                gene_terceros_contac.cargo, gene_terceros_empresas.razo_soci, temp.nom_archivo
                            FROM archivo_radica_enviados_temp AS temp 
                                INNER JOIN gene_funcionarios_deta AS usua_regis_deta ON (temp.id_usua_regis = usua_regis_deta.id_funcio_deta)
                                INNER JOIN gene_funcionarios AS usua_regis ON (usua_regis_deta.id_funcio = usua_regis.id_funcio)
                                INNER JOIN areas_oficinas AS usua_regis_ofi ON (usua_regis_deta.id_oficina = usua_regis_ofi.id_oficina)
                                INNER JOIN areas_dependencias AS usua_regis_depen ON (usua_regis_ofi.id_depen = usua_regis_depen.id_depen)
                                LEFT JOIN archivo_radica_enviados_temp_responsa AS respon_temp  ON (respon_temp.id_temp = temp.id_temp)
                                LEFT JOIN gene_funcionarios_deta AS respon_deta ON (respon_temp.id_funcio_deta = respon_deta.id_funcio_deta)
                                LEFT JOIN gene_funcionarios AS respon ON (respon_deta.id_funcio = respon.id_funcio)
                                LEFT JOIN areas_oficinas AS ofi_respon ON (respon_deta.id_oficina = ofi_respon.id_oficina)
                                LEFT JOIN areas_dependencias AS depen_respon ON (ofi_respon.id_depen = depen_respon.id_depen)
                                INNER JOIN gene_terceros_contac  ON (temp.id_destina = gene_terceros_contac.id_tercero)
                                LEFT JOIN gene_terceros_empresas  ON (gene_terceros_contac.id_empre = gene_terceros_empresas.id_empre) 
                            WHERE (temp.terminado = 1 AND temp.radicado = 0 AND temp.anulado = 0) 
                            ORDER BY temp.id_temp";

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($Accion == 'RADICADOS_ASOCIADOS'){
                /******************************************************************************************/
                /*  LISTO LOS PENDIENTES POR RADICAR PARA VENTANILLA
                /******************************************************************************************/
                $Sql = "SELECT `radi_reci`.`id_radica`, `radi_reci`.`asunto`
                        FROM `archivo_radica_recibidos` AS `radi_reci`
                            INNER JOIN `archivo_radica_enviados_temp_radica_respuesta` AS `temp` ON (`radi_reci`.`id_radica` = `temp`.`id_radica`)
                        WHERE (`temp`.`id_temp` = :id_temp)";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $IdTemp, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }

            $Result = $Instruc->fetchAll();
            $conexion = null;
            return $Result;

        }catch(PDOException $e){
            echo 'Ha surgido un error y no se puede ejecutar la consulta en Radicado enviados Temp en Listar.'.$e->getMessage();
            exit;
        } 
    }

    public static function TotalVarios($Accion, $IdRadicado, $IdFuncioDeta, $IdFuncio, $IdDepen, $IdOfi, $Criterio1, $Criterio2, $Criterio3){
        $conexion = new Conexion();
        
        try{
            if($Accion == 2){
                /******************************************************************************************/
                /*  LISTO LOS PENDIENTES POR RADICAR PARA VENTANILLA
                /******************************************************************************************/
                $Sql = "SELECT temp.id_temp
                        FROM archivo_radica_enviados_temp AS temp 
                            INNER JOIN gene_funcionarios_deta AS usua_regis_deta ON (temp.id_usua_regis = usua_regis_deta.id_funcio_deta)
                            INNER JOIN gene_funcionarios AS usua_regis ON (usua_regis_deta.id_funcio = usua_regis.id_funcio)
                            INNER JOIN areas_oficinas AS usua_regis_ofi ON (usua_regis_deta.id_oficina = usua_regis_ofi.id_oficina)
                            INNER JOIN areas_dependencias AS usua_regis_depen ON (usua_regis_ofi.id_depen = usua_regis_depen.id_depen)
                            LEFT JOIN archivo_radica_enviados_temp_responsa AS respon_temp  ON (respon_temp.id_temp = temp.id_temp)
                            LEFT JOIN gene_funcionarios_deta AS respon_deta ON (respon_temp.id_funcio_deta = respon_deta.id_funcio_deta)
                            LEFT JOIN gene_funcionarios AS respon ON (respon_deta.id_funcio = respon.id_funcio)
                            LEFT JOIN areas_oficinas AS ofi_respon ON (respon_deta.id_oficina = ofi_respon.id_oficina)
                            LEFT JOIN areas_dependencias AS depen_respon ON (ofi_respon.id_depen = depen_respon.id_depen)
                            INNER JOIN gene_terceros_contac  ON (temp.id_destina = gene_terceros_contac.id_tercero)
                            LEFT JOIN gene_terceros_empresas  ON (gene_terceros_contac.id_empre = gene_terceros_empresas.id_empre) 
                        WHERE (temp.terminado = 1 AND temp.radicado = 0)";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }

            $Result = $Instruc->rowCount();
            $conexion = null;
            return $Result;
        }catch(PDOException $e){
            echo 'Ha surgido un error y no se puede ejecutar la consulta, Totales Tempo.'.$e->getMessage();
            exit;
        }
    }

    public static function Buscar($Accion, $IdTemp, $IdFuncio){
        $conexion = new Conexion();
        
        try{
            if($Accion == 1){
                $Sql = "SELECT * 
                        FROM archivo_radica_enviados_temp 
                        WHERE id_temp = :id_temp";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $IdTemp, PDO::PARAM_INT);

            }elseif($Accion == 9){
                //SABER SI YA SE GENERO LA PLANTILLA
                $Sql = "SELECT * 
                        FROM archivo_radica_enviados_temp 
                        WHERE id_temp = ".$IdTemp." AND genera_plantilla = 1";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $IdTemp, PDO::PARAM_INT);

            }elseif($Accion == 10){
                //SABER SI YA SE GENERO LA PLANTILLA
                $Sql = "SELECT * 
                        FROM archivo_radica_enviados_temp 
                        WHERE id_temp = ".$IdTemp." AND plantilla_cargada = 1";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $IdTemp, PDO::PARAM_INT);
            }elseif($Accion == 11){
                $Sql = "SELECT `ra`.*
                        FROM `archivo_radica_enviados_temp_proyector` AS `proyec`
                            INNER JOIN `archivo_radica_enviados_temp` AS `ra` ON (`proyec`.`id_temp` = `ra`.`id_temp`)
                            INNER JOIN `archivo_radica_enviados_temp_quienes_firman` AS `firma` ON (`firma`.`id_temp` = `ra`.`id_temp`)
                            INNER JOIN `archivo_radica_enviados_temp_responsa` AS `respon` ON (`respon`.`id_temp` = `ra`.`id_temp`)
                        WHERE (`ra`.`id_temp` = :id_temp AND `firma`.`firmado` = 0);";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_temp', $IdTemp, PDO::PARAM_INT);
            }

            $Instruc -> execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            $Result = $Instruc->fetch();
            $conexion = null;
            
            if($Result){
                return new self("", $Result['id_temp'], $Result['id_serie'], $Result['id_subserie'], $Result['id_tipodoc'], $Result['id_usua_regis'], 
                                $Result['id_destina'], $Result['id_status'], $Result['id_saludo'], $Result['id_despedida'], $Result['id_ruta'], $Result['fechor_registro'], 
                                $Result['asunto'], $Result['con_copia'], $Result['anexos'], $Result['adjunto'], $Result['terminado'], $Result['existen_proyectores'], 
                                $Result['nom_archivo'], $Result['genera_plantilla'], $Result['plantilla_cargada']);
            } else {
                return false;
            }
        }catch(PDOException $e){
            echo 'Ha surgido un error y no se puede ejecutar la consulta en Radicado enviados Temp en Buscar.'.$e->getMessage();
            exit;
        }
    }
}
?>