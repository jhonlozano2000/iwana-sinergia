<?php
class RadicadoRecibidoListarPendienteTramitar{
    private $Accion;
    private $IdRadica;
    private $IdFuncioDeta;
    private $IdDepen;
    private $IdOfi;
    private $Criterio1;
    private $Criterio2;
    private $Criterio3;
    
    public function __construct($Accion = null, $IdRadica = null, $IdFuncioDeta = null, $IdDepen = null, $IdOfi = null, $Criterio1 = null, 
                                $Criterio2 = null, $Criterio3 = null){

        $this -> Accion       = $Accion;
        $this -> IdRadica     = $IdRadica;
        $this -> IdFuncioDeta = $IdFuncioDeta;
        $this -> IdDepen      = $IdDepen;
        $this -> IdOfi        = $IdOfi;
        $this -> Criterio1    = $Criterio1;
        $this -> Criterio2    = $Criterio2;
        $this -> Criterio3    = $Criterio3;
    }

    public function get_Accion() {
        return $this -> Accion;
    }

    public function get_IdRadica() {
        return $this -> IdRadica;
    }

    public function get_IdFuncioDeta() {
        return $this -> IdFuncioDeta;
    }

    public function get_IdDepen() {
        return $this -> IdDepen;
    }

    public function get_IdOfi() {
        return $this -> IdOfi;
    }

    public function get_Criterio1() {
        return $this -> Criterio1;
    }

    public function get_Criterio2() {
        return $this -> Criterio2;
    }

    public function get_Criterio3() {
        return $this -> Criterio3;
    }

    public function set_Accion($Accion) {
        return $this -> Accion = $Accion;
    }

    public function set_IdRadica($IdRadica) {
        return $this -> IdRadica = $IdRadica;
    }

    public function set_IdFuncioDeta($IdFuncioDeta) {
        return $this -> IdFuncioDeta = $IdFuncioDeta;
    }

    public function set_IdDepen($IdDepen) {
        return $this -> IdDepen = $IdDepen;
    }

    public function set_IdOfi($IdOfi) {
        return $this -> IdOfi = $IdOfi;
    }

    public function set_Criterio1($Criterio1) {
        return $this -> Criterio1 = $Criterio1;
    }

    public function set_Criterio2($Criterio2) {
        return $this -> Criterio2 = $Criterio2;
    }

    public function set_Criterio3($Criterio3) {
        return $this -> Criterio3 = $Criterio3;
    }

    public function Listar(){
        $conexion = new Conexion();
        
        try{
           
            if($this->Accion == 1){
                /******************************************************************************************/
                /*  LISTO TODA LA CORRESPONDENCIA REIBIDA DE LA INSTITUCION
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`, `radi`.`fechor_radica`, `radi`.`fec_docu`, `radi`.`fec_venci`, `radi`.`asunto`, `radi`.`impri_rotu`, 
                            `radi`.`digital`, `radi`.`requie_respues`, `funcio`.`nom_funcio`, `funcio`.`ape_funcio`, `ofi`.`nom_oficina`, 
                            `depen`.`nom_depen`, `terce_contac`.`nom_contac`, `terce_contac`.`cargo`, `terce_empre`.`nit_empre`, `terce_empre`.`razo_soci`, 
                            `funcio_radica`.`nom_funcio` AS `nom_funcio_radi`, `funcio_radica`.`ape_funcio` AS `ape_funcio_radi`, 
                            `radi`.`radica_respuesta`, `radi`.`id_forma_llegada`, `forma_llega`.`nom_formaenvi` AS `nom_forma_llega`, 
                            `forma_llega`.`requie_digital`, `radi`.`autoriza`, `radi`.`pase`
                        FROM `archivo_radica_recibidos_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_recibidos` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_remite` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radica` ON (`radi`.`id_usua_regis` = `usua_radica`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radica` ON (`usua_radica`.`id_funcio` = `funcio_radica`.`id_funcio`)
                            INNER JOIN `config_formaenvio` AS `forma_llega` ON (`radi`.`id_forma_llegada` = `forma_llega`.`id_formaenvio`)
                        WHERE (`radi`.`transferido` = 0 AND `ra_respon`.`respon` = 1 AND `radi`.`requie_respues` = 1 and `radi`.`respondido` = 0)
                        ORDER BY `radi`.`id_radica` DESC, `radi`.`fechor_radica` ASC 
                        LIMIT 0, 50";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($this->Accion == 2){
                /******************************************************************************************/
                /*  LISTO LA CORRESPONDENCIA RECIBIDA DE UN FUNCIONARIO
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`, `radi`.`fechor_radica`, `radi`.`fec_docu`, `radi`.`fec_venci`, `radi`.`asunto`, `radi`.`impri_rotu`, 
                            `radi`.`digital`, `radi`.`requie_respues`, `funcio`.`nom_funcio`, `funcio`.`ape_funcio`, `ofi`.`nom_oficina`, 
                            `depen`.`nom_depen`, `terce_contac`.`nom_contac`, `terce_contac`.`cargo`, `terce_empre`.`nit_empre`, `terce_empre`.`razo_soci`, 
                            `funcio_radica`.`nom_funcio` AS `nom_funcio_radi`, `funcio_radica`.`ape_funcio` AS `ape_funcio_radi`, 
                            `radi`.`radica_respuesta`, `radi`.`id_forma_llegada`, `forma_llega`.`nom_formaenvi` AS `nom_forma_llega`, 
                            `forma_llega`.`requie_digital`, `radi`.`autoriza`, `radi`.`pase`
                        FROM `archivo_radica_recibidos_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_recibidos` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_remite` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radica` ON (`radi`.`id_usua_regis` = `usua_radica`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radica` ON (`usua_radica`.`id_funcio` = `funcio_radica`.`id_funcio`)
                            INNER JOIN `config_formaenvio` AS `forma_llega` ON (`radi`.`id_forma_llegada` = `forma_llega`.`id_formaenvio`)
                        WHERE (`radi`.`transferido` = 0 AND `radi`.`autoriza` = 1 AND `ra_respon`.`respon` = 1 AND `ra_respon`.`id_funcio` = :id_funcio 
                            AND `radi`.`requie_respues` = 1 and `radi`.`respondido` = 0)
                        ORDER BY `radi`.`fechor_radica` DESC
                        LIMIT 0, 50";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":id_funcio", $this->IdFuncioDeta, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($this->Accion == 3){
                /******************************************************************************************/
                /*  LISTO LA CORRESPONDENCIA RECIBIDA DE UN FUNCIONARIO JEFE DE DEPENDENCIA
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`, `radi`.`fechor_radica`, `radi`.`fec_docu`, `radi`.`fec_venci`, `radi`.`asunto`, `radi`.`impri_rotu`, 
                            `radi`.`digital`, `radi`.`requie_respues`, `funcio`.`nom_funcio`, `funcio`.`ape_funcio`, `ofi`.`nom_oficina`, 
                            `depen`.`nom_depen`, `terce_contac`.`nom_contac`, `terce_contac`.`cargo`, `terce_empre`.`nit_empre`, `terce_empre`.`razo_soci`, 
                            `funcio_radica`.`nom_funcio` AS `nom_funcio_radi`, `funcio_radica`.`ape_funcio` AS `ape_funcio_radi`, 
                            `radi`.`radica_respuesta`, `radi`.`id_forma_llegada`, `forma_llega`.`nom_formaenvi` AS `nom_forma_llega`, 
                            `forma_llega`.`requie_digital`, `radi`.`autoriza`, `radi`.`pase`
                        FROM `archivo_radica_recibidos_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_recibidos` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_remite` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radica` ON (`radi`.`id_usua_regis` = `usua_radica`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radica` ON (`usua_radica`.`id_funcio` = `funcio_radica`.`id_funcio`)
                            INNER JOIN `config_formaenvio` AS `forma_llega` ON (`radi`.`id_forma_llegada` = `forma_llega`.`id_formaenvio`)
                        WHERE (`radi`.`transferido` = 0 AND `radi`.`autoriza` = 1 AND `ra_respon`.`respon` = 1 AND `depen`.`id_depen` = :id_depen 
                            AND `radi`.`requie_respues` = 1 and `radi`.`respondido` = 0)
                        ORDER BY `radi`.`fechor_radica` DESC
                        LIMIT 0, 50";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":id_depen", $this->IdDepen, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($this->Accion == 4){
                /******************************************************************************************/
                /*  LISTO LA CORRESPONDENCIA EXTERNA DE UN FUNCIONARIO JEFE DE OFICINA
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`, `radi`.`fechor_radica`, `radi`.`fec_docu`, `radi`.`fec_venci`, `radi`.`asunto`, `radi`.`impri_rotu`, 
                            `radi`.`digital`, `radi`.`requie_respues`, `funcio`.`nom_funcio`, `funcio`.`ape_funcio`, `ofi`.`nom_oficina`, 
                            `depen`.`nom_depen`, `terce_contac`.`nom_contac`, `terce_contac`.`cargo`, `terce_empre`.`nit_empre`, `terce_empre`.`razo_soci`, 
                            `funcio_radica`.`nom_funcio` AS `nom_funcio_radi`, `funcio_radica`.`ape_funcio` AS `ape_funcio_radi`, 
                            `radi`.`radica_respuesta`, `radi`.`id_forma_llegada`, `forma_llega`.`nom_formaenvi` AS `nom_forma_llega`, 
                            `forma_llega`.`requie_digital`, `radi`.`autoriza`, `radi`.`pase`
                        FROM `archivo_radica_recibidos_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_recibidos` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_remite` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radica` ON (`radi`.`id_usua_regis` = `usua_radica`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radica` ON (`usua_radica`.`id_funcio` = `funcio_radica`.`id_funcio`)
                            INNER JOIN `config_formaenvio` AS `forma_llega` ON (`radi`.`id_forma_llegada` = `forma_llega`.`id_formaenvio`)
                        WHERE (`radi`.`transferido` = 0 AND `radi`.`autoriza` = 1 AND `ra_respon`.`respon` = 1 AND `depen`.`id_depen` = :id_depen 
                            AND `radi`.`requie_respues` = 1 and `radi`.`respondido` = 0 AND `funcio_deta`.`id_oficina` = :id_oficina)
                        ORDER BY `radi`.`fechor_radica` DESC
                        LIMIT 0, 50";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":id_depen", $this->IdDepen, PDO::PARAM_INT);
                $Instruc -> bindParam(":id_oficina", $this->IdOfi, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }

            $Result = $Instruc->fetchAll();
            $conexion = null;
            return $Result;
        }catch(PDOException $e){
            echo 'Ha surgido un error y no se puede ejecutar la consulta listar.'.$e->getMessage();
            exit;
        }
    }

    public function Filtro(){
        $conexion = new Conexion();
        
        try{
           
            if($this->Accion == 5){
                /******************************************************************************************/
                /*  FILTRO TODA LA CORRESPONDENCIA EXTERNA DEL PROPIETARIO PRINCIPAL DE LA INSTITUCION
                /******************************************************************************************/

                $Sql = "SELECT `radi`.`id_radica`, `radi`.`fechor_radica`, `radi`.`fec_docu`, `radi`.`fec_venci`, `radi`.`asunto`, `radi`.`impri_rotu`, 
                            `radi`.`digital`, `radi`.`requie_respues`, `funcio`.`nom_funcio`, `funcio`.`ape_funcio`, `ofi`.`nom_oficina`, `depen`.`nom_depen`, 
                            `terce_contac`.`nom_contac`, `terce_contac`.`cargo`, `terce_empre`.`nit_empre`, `terce_empre`.`razo_soci`, 
                            `funcio_radica`.`nom_funcio` AS `nom_funcio_radi`, `funcio_radica`.`ape_funcio` AS `ape_funcio_radi`, `radi`.`radica_respuesta`, 
                            `radi`.`id_forma_llegada`, `forma_llega`.`nom_formaenvi` AS `nom_forma_llega`, `forma_llega`.`requie_digital`, `radi`.`autoriza`
                        FROM `archivo_radica_recibidos_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_recibidos` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_remite` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radica` ON (`radi`.`id_usua_regis` = `usua_radica`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radica` ON (`usua_radica`.`id_funcio` = `funcio_radica`.`id_funcio`)
                            INNER JOIN `config_formaenvio` AS `forma_llega` ON (`radi`.`id_forma_llegada` = `forma_llega`.`id_formaenvio`)
                        WHERE (`radi`.`transferido` = 0 AND `ra_respon`.`respon` = 1  AND `radi`.`requie_respues` = 1 and `radi`.`respondido` = 0 
                            ".self::Generar_Query_Correspondencia($this->Criterio3).")
                        ORDER BY `radi`.`fechor_radica` DESC
                        LIMIT 0, 50";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($this->Accion == 6){
                /******************************************************************************************/
                /*  FILTRO LA CORRESPONDENCIA EXTERNA DE UN FUNCIONARIO
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`, `radi`.`fechor_radica`, `radi`.`fec_docu`, `radi`.`fec_venci`, `radi`.`asunto`, `radi`.`impri_rotu`, 
                            `radi`.`digital`, `radi`.`requie_respues`, `funcio`.`nom_funcio`, `funcio`.`ape_funcio`, `ofi`.`nom_oficina`, `depen`.`nom_depen`, 
                            `terce_contac`.`nom_contac`, `terce_contac`.`cargo`, `terce_empre`.`nit_empre`, `terce_empre`.`razo_soci`, 
                            `funcio_radica`.`nom_funcio` AS `nom_funcio_radi`, `funcio_radica`.`ape_funcio` AS `ape_funcio_radi`, `radi`.`radica_respuesta`, 
                            `radi`.`id_forma_llegada`, `forma_llega`.`nom_formaenvi` AS `nom_forma_llega`, `forma_llega`.`requie_digital`, `radi`.`autoriza`
                        FROM `archivo_radica_recibidos_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_recibidos` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_remite` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radica` ON (`radi`.`id_usua_regis` = `usua_radica`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radica` ON (`usua_radica`.`id_funcio` = `funcio_radica`.`id_funcio`)
                            INNER JOIN `config_formaenvio` AS `forma_llega` ON (`radi`.`id_forma_llegada` = `forma_llega`.`id_formaenvio`)
                        WHERE (`radi`.`transferido` = 0 AND `radi`.`autoriza` = 1 AND `ra_respon`.`respon` = 1 AND `radi`.`requie_respues` = 1 AND 
                            `radi`.`respondido` = 0 AND `ra_respon`.`id_funcio` = ? ".self::Generar_Query_Correspondencia($this->Criterio3).")
                        ORDER BY `radi`.`fechor_radica` DESC
                        LIMIT 0, 50";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute(array($this->IdFuncioDeta)) or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($this->Accion == 7){
                /******************************************************************************************/
                /*  FILTRO LA CORRESPONDENCIA EXTERNA DE UN FUNCIONARIO JEFE DE DEPENDENCIA
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`, `radi`.`fechor_radica`, `radi`.`fec_docu`, `radi`.`fec_venci`, `radi`.`asunto`, `radi`.`impri_rotu`, 
                            `radi`.`digital`, `radi`.`requie_respues`, `funcio`.`nom_funcio`, `funcio`.`ape_funcio`, `ofi`.`nom_oficina`, `depen`.`nom_depen`, 
                            `terce_contac`.`nom_contac`, `terce_contac`.`cargo`, `terce_empre`.`nit_empre`, `terce_empre`.`razo_soci`, 
                            `funcio_radica`.`nom_funcio` AS `nom_funcio_radi`, `funcio_radica`.`ape_funcio` AS `ape_funcio_radi`, `radi`.`radica_respuesta`, 
                            `radi`.`id_forma_llegada`, `forma_llega`.`nom_formaenvi` AS `nom_forma_llega`, `forma_llega`.`requie_digital`, `radi`.`autoriza`
                        FROM `archivo_radica_recibidos_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_recibidos` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_remite` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radica` ON (`radi`.`id_usua_regis` = `usua_radica`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radica` ON (`usua_radica`.`id_funcio` = `funcio_radica`.`id_funcio`)
                            INNER JOIN `config_formaenvio` AS `forma_llega` ON (`radi`.`id_forma_llegada` = `forma_llega`.`id_formaenvio`)
                        WHERE (`radi`.`transferido` = 0 AND `radi`.`autoriza` = 1 AND `ra_respon`.`respon` = 1 AND `radi`.`requie_respues` = 1 AND 
                            `radi`.`respondido` = 0  AND `depen`.`id_depen` = ? ".self::Generar_Query_Correspondencia($this->Criterio3).")
                        ORDER BY `radi`.`fechor_radica` DESC
                        LIMIT 0, 50";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute(array($this->IdDepen)) or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($this->Accion == 8){
                /******************************************************************************************/
                /*  FILTRO LA CORRESPONDENCIA EXTERNA DE UN FUNCIONARIO JEFE DE OFICINA
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`, `radi`.`fechor_radica`, `radi`.`fec_docu`, `radi`.`fec_venci`, `radi`.`asunto`, `radi`.`impri_rotu`, 
                            `radi`.`digital`, `radi`.`requie_respues`, `funcio`.`nom_funcio`, `funcio`.`ape_funcio`, `ofi`.`nom_oficina`, `depen`.`nom_depen`, 
                            `terce_contac`.`nom_contac`, `terce_contac`.`cargo`, `terce_empre`.`nit_empre`, `terce_empre`.`razo_soci`, 
                            `funcio_radica`.`nom_funcio` AS `nom_funcio_radi`, `funcio_radica`.`ape_funcio` AS `ape_funcio_radi`, `radi`.`radica_respuesta`, 
                            `radi`.`id_forma_llegada`, `forma_llega`.`nom_formaenvi` AS `nom_forma_llega`, `forma_llega`.`requie_digital`, `radi`.`autoriza`
                        FROM `archivo_radica_recibidos_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_recibidos` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_remite` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radica` ON (`radi`.`id_usua_regis` = `usua_radica`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radica` ON (`usua_radica`.`id_funcio` = `funcio_radica`.`id_funcio`)
                            INNER JOIN `config_formaenvio` AS `forma_llega` ON (`radi`.`id_forma_llegada` = `forma_llega`.`id_formaenvio`)
                        WHERE (`radi`.`transferido` = 0 AND `radi`.`autoriza` = 1 AND `ra_respon`.`respon` = 1 AND `radi`.`requie_respues` = 1 
                            AND `radi`.`respondido` = 0 AND `depen`.`id_depen` = ? AND `funcio_deta`.`id_oficina` = ? 
                            ".self::Generar_Query_Correspondencia($this->Criterio3).")
                        ORDER BY `radi`.`fechor_radica` DESC
                        LIMIT 0, 50";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute(array($this->IdDepen, $this->IdOfi)) or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }

            $Result = $Instruc->fetchAll();
            $conexion = null;
            return $Result;
        }catch(PDOException $e){
            echo 'Ha surgido un error y no se puede ejecutar la consulta listar.'.$e->getMessage();
            exit;
        }
    }

    public function TotalRegistros_Listar(){
        $conexion = new Conexion();

        try{
            if($this->Accion == 1){
                /******************************************************************************************/
                /*  LISTO TODA LA CORRESPONDENCIA EXTERNA DEL PROPIETARIO PRINCIPAL DE LA INSTITUCION
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`
                        FROM `archivo_radica_recibidos_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_recibidos` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_remite` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radica` ON (`radi`.`id_usua_regis` = `usua_radica`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radica` ON (`usua_radica`.`id_funcio` = `funcio_radica`.`id_funcio`)
                            INNER JOIN `config_formaenvio` AS `forma_llega` ON (`radi`.`id_forma_llegada` = `forma_llega`.`id_formaenvio`)
                        WHERE (`radi`.`transferido` = 0 AND `ra_respon`.`respon` = 1 AND `radi`.`requie_respues` = 1 AND `radi`.`respondido` = 0 )";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($this->Accion == 2){
                /******************************************************************************************/
                /*  LISTO LA CORRESPONDENCIA EXTERNA DE UN FUNCIONARIO
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`
                        FROM `archivo_radica_recibidos_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_recibidos` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_remite` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radica` ON (`radi`.`id_usua_regis` = `usua_radica`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radica` ON (`usua_radica`.`id_funcio` = `funcio_radica`.`id_funcio`)
                            INNER JOIN `config_formaenvio` AS `forma_llega` ON (`radi`.`id_forma_llegada` = `forma_llega`.`id_formaenvio`) 
                        WHERE (`radi`.`transferido` = 0 AND `radi`.`autoriza` = 1 AND `ra_respon`.`respon` = 1 AND `radi`.`requie_respues` = 1 
                            AND `radi`.`respondido` = 0 AND `ra_respon`.`id_funcio` = :id_funcio)";
                
                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":id_funcio", $this->IdFuncioDeta, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($this->Accion == 3){
                /******************************************************************************************/
                /*  LISTO LA CORRESPONDENCIA EXTERNA DE UN FUNCIONARIO JEFE DE DEPENDENCIA
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`
                        FROM `archivo_radica_recibidos_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_recibidos` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_remite` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radica` ON (`radi`.`id_usua_regis` = `usua_radica`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radica` ON (`usua_radica`.`id_funcio` = `funcio_radica`.`id_funcio`)
                            INNER JOIN `config_formaenvio` AS `forma_llega` ON (`radi`.`id_forma_llegada` = `forma_llega`.`id_formaenvio`) 
                        WHERE (`radi`.`transferido` = 0 AND `radi`.`autoriza` = 1 AND `ra_respon`.`respon` = 1 AND `radi`.`requie_respues` = 1 
                            AND `radi`.`respondido` = 0 AND `depen`.`id_depen` = :id_depen)";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":id_depen", $this->IdDepen, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($this->Accion == 4){
                /******************************************************************************************/
                /*  LISTO LA CORRESPONDENCIA EXTERNA DE UN FUNCIONARIO JEFE DE OFICINA
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`
                        FROM `archivo_radica_recibidos_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_recibidos` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_remite` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radica` ON (`radi`.`id_usua_regis` = `usua_radica`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radica` ON (`usua_radica`.`id_funcio` = `funcio_radica`.`id_funcio`)
                            INNER JOIN `config_formaenvio` AS `forma_llega` ON (`radi`.`id_forma_llegada` = `forma_llega`.`id_formaenvio`) 
                        WHERE (`radi`.`transferido` = 0 AND `radi`.`autoriza` = 1 AND `ra_respon`.`respon` = 1 AND `radi`.`requie_respues` = 1 
                            AND `radi`.`respondido` = 0 AND `depen`.`id_depen` = :id_depen AND `funcio_deta`.`id_oficina` = :id_oficina)";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":id_depen", $this->IdDepen, PDO::PARAM_INT);
                $Instruc -> bindParam(":id_oficina", $this->IdOfi, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($this->Accion == 4){
                /******************************************************************************************/
                /*  LISTO LA CORRESPONDENCIA EXTERNA DE UN FUNCIONARIO JEFE DE OFICINA
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`
                        FROM `archivo_radica_recibidos_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_recibidos` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_remite` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radica` ON (`radi`.`id_usua_regis` = `usua_radica`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radica` ON (`usua_radica`.`id_funcio` = `funcio_radica`.`id_funcio`)
                            INNER JOIN `config_formaenvio` AS `forma_llega` ON (`radi`.`id_forma_llegada` = `forma_llega`.`id_formaenvio`) 
                        WHERE (`radi`.`transferido` = 0 AND `radi`.`autoriza` = 1 AND `ra_respon`.`respon` = 1 AND `radi`.`requie_respues` = 1 
                            AND `radi`.`respondido` = 0 AND `depen`.`id_depen` = :id_depen AND `funcio_deta`.`id_oficina` = :id_oficina)";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":id_depen", $this->IdDepen, PDO::PARAM_INT);
                $Instruc -> bindParam(":id_oficina", $this->IdOfi, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($this->Accion == 5){
                /******************************************************************************************/
                /*  FILTRO TODA LA CORRESPONDENCIA EXTERNA DEL PROPIETARIO PRINCIPAL DE LA INSTITUCION
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`
                        FROM `archivo_radica_recibidos_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_recibidos` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_remite` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radica` ON (`radi`.`id_usua_regis` = `usua_radica`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radica` ON (`usua_radica`.`id_funcio` = `funcio_radica`.`id_funcio`)
                            INNER JOIN `config_formaenvio` AS `forma_llega` ON (`radi`.`id_forma_llegada` = `forma_llega`.`id_formaenvio`) 
                        WHERE (`radi`.`transferido` = 0 AND `ra_respon`.`respon` = 1 AND `radi`.`requie_respues` = 1 AND `radi`.`respondido` = 0 
                            ".self::Generar_Query_Correspondencia($this->Criterio3).")";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($this->Accion == 6){
                /******************************************************************************************/
                /*  FILTRO LA CORRESPONDENCIA EXTERNA DE UN FUNCIONARIO
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`
                        FROM `archivo_radica_recibidos_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_recibidos` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_remite` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radica` ON (`radi`.`id_usua_regis` = `usua_radica`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radica` ON (`usua_radica`.`id_funcio` = `funcio_radica`.`id_funcio`)
                            INNER JOIN `config_formaenvio` AS `forma_llega` ON (`radi`.`id_forma_llegada` = `forma_llega`.`id_formaenvio`) 
                        WHERE (`radi`.`transferido` = 0 AND `radi`.`autoriza` = 1 AND `ra_respon`.`respon` = 1 AND `radi`.`requie_respues` = 1 
                            AND `radi`.`respondido` = 0 AND `ra_respon`.`id_funcio` = ? ".self::Generar_Query_Correspondencia($this->Criterio3).")";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute(array($this->IdFuncioDeta)) or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($this->Accion == 7){
                /******************************************************************************************/
                /*  FILTRO LA CORRESPONDENCIA EXTERNA DE UN FUNCIONARIO JEFE DE DEPENDENCIA
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`
                        FROM `archivo_radica_recibidos_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_recibidos` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_remite` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radica` ON (`radi`.`id_usua_regis` = `usua_radica`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radica` ON (`usua_radica`.`id_funcio` = `funcio_radica`.`id_funcio`)
                            INNER JOIN `config_formaenvio` AS `forma_llega` ON (`radi`.`id_forma_llegada` = `forma_llega`.`id_formaenvio`) 
                        WHERE (`radi`.`transferido` = 0 AND `radi`.`autoriza` = 1 AND `ra_respon`.`respon` = 1 AND `radi`.`requie_respues` = 1 
                            AND `radi`.`respondido` = 0 AND `depen`.`id_depen` = ? ".self::Generar_Query_Correspondencia($this->Criterio3).")";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute(array($this->IdDepen)) or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($this->Accion == 8){
                /******************************************************************************************/
                /*  FILTRO LA CORRESPONDENCIA EXTERNA DE UN FUNCIONARIO JEFE DE OFICINA
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`
                        FROM `archivo_radica_recibidos_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_recibidos` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_remite` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radica` ON (`radi`.`id_usua_regis` = `usua_radica`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radica` ON (`usua_radica`.`id_funcio` = `funcio_radica`.`id_funcio`)
                            INNER JOIN `config_formaenvio` AS `forma_llega` ON (`radi`.`id_forma_llegada` = `forma_llega`.`id_formaenvio`) 
                        WHERE (`radi`.`transferido` = 0 AND `radi`.`autoriza` = 1 AND `ra_respon`.`respon` = 1 AND `radi`.`requie_respues` = 1 
                            AND `radi`.`respondido` = 0 AND `depen`.`id_depen` = ? AND `funcio_deta`.`id_oficina` = ? 
                            ".self::Generar_Query_Correspondencia($this->Criterio3).")";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute(array($this->IdDepen, $this->IdOfi)) or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }

            $Result = $Instruc->rowCount();
            $conexion = null;
            return $Result;
        }catch(PDOException $e){
            echo 'Ha surgido un error y no se puede ejecutar la consulta, recibidos.'.$e->getMessage();
            exit;
        }
    }

    public function TotalRegistros_Filtro(){
        $conexion = new Conexion();

        try{
            if($this->Accion == 1){
                /******************************************************************************************/
                /*  LISTO TODA LA CORRESPONDENCIA EXTERNA DEL PROPIETARIO PRINCIPAL DE LA INSTITUCION
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`
                        FROM `archivo_radica_recibidos_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_recibidos` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_remite` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radica` ON (`radi`.`id_usua_regis` = `usua_radica`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radica` ON (`usua_radica`.`id_funcio` = `funcio_radica`.`id_funcio`)
                            INNER JOIN `config_formaenvio` AS `forma_llega` ON (`radi`.`id_forma_llegada` = `forma_llega`.`id_formaenvio`) 
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)  
                        WHERE (`radi`.`transferido` = 0 AND `ra_respon`.`respon` = 1 AND `radi`.`requie_respues` = 1 AND `radi`.`respondido` = 0)";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($this->Accion == 2){
                /******************************************************************************************/
                /*  LISTO LA CORRESPONDENCIA EXTERNA DE UN FUNCIONARIO
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`
                        FROM `archivo_radica_recibidos_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_recibidos` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_remite` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radica` ON (`radi`.`id_usua_regis` = `usua_radica`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radica` ON (`usua_radica`.`id_funcio` = `funcio_radica`.`id_funcio`)
                            INNER JOIN `config_formaenvio` AS `forma_llega` ON (`radi`.`id_forma_llegada` = `forma_llega`.`id_formaenvio`) 
                        WHERE (`radi`.`transferido` = 0 AND `radi`.`autoriza` = 1 AND `ra_respon`.`respon` = 1 AND `radi`.`requie_respues` = 1 
                            AND `radi`.`respondido` = 0 AND `ra_respon`.`id_funcio` = :id_funcio)";
                
                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":id_funcio", $this->Criterio3, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($this->Accion == 3){
                /******************************************************************************************/
                /*  LISTO LA CORRESPONDENCIA EXTERNA DE UN FUNCIONARIO JEFE DE DEPENDENCIA
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`
                        FROM `archivo_radica_recibidos_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_recibidos` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_remite` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radica` ON (`radi`.`id_usua_regis` = `usua_radica`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radica` ON (`usua_radica`.`id_funcio` = `funcio_radica`.`id_funcio`)
                            INNER JOIN `config_formaenvio` AS `forma_llega` ON (`radi`.`id_forma_llegada` = `forma_llega`.`id_formaenvio`) 
                        WHERE (`radi`.`transferido` = 0 AND `radi`.`autoriza` = 1 AND `ra_respon`.`respon` = 1 AND `radi`.`requie_respues` = 1 
                            AND `radi`.`respondido` = 0 AND `depen`.`id_depen` = :id_depen)";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":id_depen", $this->IdDepen, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($this->Accion == 4){
                /******************************************************************************************/
                /*  LISTO LA CORRESPONDENCIA EXTERNA DE UN FUNCIONARIO JEFE DE OFICINA
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`
                        FROM `archivo_radica_recibidos_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_recibidos` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_remite` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radica` ON (`radi`.`id_usua_regis` = `usua_radica`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radica` ON (`usua_radica`.`id_funcio` = `funcio_radica`.`id_funcio`)
                            INNER JOIN `config_formaenvio` AS `forma_llega` ON (`radi`.`id_forma_llegada` = `forma_llega`.`id_formaenvio`) 
                        WHERE (`radi`.`transferido` = 0 AND `radi`.`autoriza` = 1 AND `ra_respon`.`respon` = 1 AND `radi`.`requie_respues` = 1 
                            AND `radi`.`respondido` = 0 AND `depen`.`id_depen` = :id_depen AND `funcio_deta`.`id_oficina` = :id_oficina)";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":id_depen", $this->IdDepen, PDO::PARAM_INT);
                $Instruc -> bindParam(":id_oficina", $this->IdOfi, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($this->Accion == 5){
                /******************************************************************************************/
                /*  FILTRO TODA LA CORRESPONDENCIA EXTERNA DEL PROPIETARIO PRINCIPAL DE LA INSTITUCION
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`
                        FROM `archivo_radica_recibidos_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_recibidos` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_remite` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radica` ON (`radi`.`id_usua_regis` = `usua_radica`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radica` ON (`usua_radica`.`id_funcio` = `funcio_radica`.`id_funcio`)
                            INNER JOIN `config_formaenvio` AS `forma_llega` ON (`radi`.`id_forma_llegada` = `forma_llega`.`id_formaenvio`) 
                        WHERE (`radi`.`transferido` = 0 AND `ra_respon`.`respon` = 1 AND `radi`.`requie_respues` = 1 AND `radi`.`respondido` = 0 
                            ".self::Generar_Query_Correspondencia($this->Criterio3).")";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($this->Accion == 6){
                /******************************************************************************************/
                /*  FILTRO LA CORRESPONDENCIA EXTERNA DE UN FUNCIONARIO
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`
                        FROM `archivo_radica_recibidos_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_recibidos` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_remite` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radica` ON (`radi`.`id_usua_regis` = `usua_radica`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radica` ON (`usua_radica`.`id_funcio` = `funcio_radica`.`id_funcio`)
                            INNER JOIN `config_formaenvio` AS `forma_llega` ON (`radi`.`id_forma_llegada` = `forma_llega`.`id_formaenvio`) 
                        WHERE (`radi`.`transferido` = 0 AND `radi`.`autoriza` = 1 AND `ra_respon`.`respon` = 1 AND `radi`.`requie_respues` = 1 
                            AND `radi`.`respondido` = 0 AND `ra_respon`.`id_funcio` = ? ".self::Generar_Query_Correspondencia($this->Criterio3).")";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute(array($this->IdFuncioDeta)) or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($this->Accion == 7){
                /******************************************************************************************/
                /*  FILTRO LA CORRESPONDENCIA EXTERNA DE UN FUNCIONARIO JEFE DE DEPENDENCIA
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`
                        FROM `archivo_radica_recibidos_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_recibidos` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_remite` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radica` ON (`radi`.`id_usua_regis` = `usua_radica`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radica` ON (`usua_radica`.`id_funcio` = `funcio_radica`.`id_funcio`)
                            INNER JOIN `config_formaenvio` AS `forma_llega` ON (`radi`.`id_forma_llegada` = `forma_llega`.`id_formaenvio`) 
                        WHERE (`radi`.`transferido` = 0 AND `radi`.`autoriza` = 1 AND `ra_respon`.`respon` = 1 AND `radi`.`requie_respues` = 1 
                            AND `radi`.`respondido` = 0 AND `depen`.`id_depen` = ? ".self::Generar_Query_Correspondencia($this->Criterio3).")";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute(array($this->IdDepen)) 
                        or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($this->Accion == 8){
                /******************************************************************************************/
                /*  FILTRO LA CORRESPONDENCIA EXTERNA DE UN FUNCIONARIO JEFE DE OFICINA
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`
                        FROM `archivo_radica_recibidos_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_recibidos` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_remite` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radica` ON (`radi`.`id_usua_regis` = `usua_radica`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radica` ON (`usua_radica`.`id_funcio` = `funcio_radica`.`id_funcio`)
                            INNER JOIN `config_formaenvio` AS `forma_llega` ON (`radi`.`id_forma_llegada` = `forma_llega`.`id_formaenvio`) 
                        WHERE (`radi`.`transferido` = 0 AND `radi`.`autoriza` = 1 AND `ra_respon`.`respon` = 1 AND `radi`.`requie_respues` = 1 
                            AND `radi`.`respondido` = 0 AND `depen`.`id_depen` = ? AND `funcio_deta`.`id_oficina` = ? 
                            ".self::Generar_Query_Correspondencia($this->Criterio3).")";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute(array($this->IdDepen, $this->IdOfi)) or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }

            $Result = $Instruc->rowCount();
            $conexion = null;
            return $Result;
        }catch(PDOException $e){
            echo 'Ha surgido un error y no se puede ejecutar la consulta, recibidos.'.$e->getMessage();
            exit;
        }
    }
    
    public static function Generar_Query_Correspondencia($Criterio){
        $conexion = new Conexion();

        /* TOTALES DE RADICADOS CON COINSEDENCIAS EN EL RADICADO */
        $SqlTotalIdRadica    = "SELECT COUNT(id_radica) AS 'Total' FROM `archivo_radica_recibidos` WHERE `transferido` = 0 AND `id_radica` LIKE ?";
        $InstrucTotaIdRadica = $conexion->prepare($SqlTotalIdRadica);
        $InstrucTotaIdRadica->execute(array('%'.$Criterio.'%')) or die(print_r($InstrucTotalAsunto->errorInfo()." - ".$SqlTotalIdRadica, true));
        $ResultTotalIdRadica = $InstrucTotaIdRadica->fetch();
        $TotalIdRadica       = $ResultTotalIdRadica['Total'];

        /* TOTALES DE RADICADOS CON COINSEDENCIAS EN EL ASUNTO */
        $SqlTotalAsunto     = "SELECT COUNT(asunto) AS 'Total' FROM `archivo_radica_recibidos` WHERE `transferido` = 0 AND `asunto` LIKE ?";
        $InstrucTotalAsunto = $conexion->prepare($SqlTotalAsunto);
        $InstrucTotalAsunto->execute(array('%'.$Criterio.'%')) or die(print_r($InstrucTotalAsunto->errorInfo()." - ".$SqlTotalAsunto, true));
        $ResultTotalAsunto  = $InstrucTotalAsunto->fetch();
        $TotalAsunto        = $ResultTotalAsunto['Total'];

        /* TOTALES DE RADICADOS CON COINSEDENCIAS CON LOS RESPONSABLES */
        $SqlTotalFuncionarios = "SELECT COUNT(`radi`.`id_radica`) AS `Total`
                                FROM `archivo_radica_recibidos_responsa` AS `radi_respon`
                                    INNER JOIN `archivo_radica_recibidos` AS `radi` ON (`radi_respon`.`id_radica` = `radi`.`id_radica`)
                                    INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`radi_respon`.`id_funcio` = `funcio_deta`.`id_funcio_deta`)
                                    INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`)
                                WHERE (`radi_respon`.`respon` = 1 AND `radi`.`transferido` = 0 AND CONCAT(TRIM(`funcio`.`nom_funcio`), ' ', TRIM(`funcio`.`ape_funcio`)) LIKE ?)";
        $InstrucTotalFuncionarios = $conexion->prepare($SqlTotalFuncionarios);
        $InstrucTotalFuncionarios->execute(array('%'.$Criterio.'%')) or die(print_r($InstrucTotalAsunto->errorInfo()." - ".$SqlTotalAsunto, true));
        $ResultTotalFuncionarios = $InstrucTotalFuncionarios->fetch();
        $TotalFuncionarios = $ResultTotalFuncionarios['Total'];

        /* TOTALES DE RADICADOS CON COINSEDENCIAS CON LOS TERCEROS */
        $SqlTotalContacto = "SELECT COUNT(`radi`.`id_radica`) AS `Total`
                            FROM `archivo_radica_recibidos` AS `radi`
                                INNER JOIN `gene_terceros_contac` AS `contac` ON (`radi`.`id_remite` = `contac`.`id_tercero`)
                            WHERE (`radi`.`transferido` = 0 AND `contac`.`nom_contac` LIKE ?)";
        $InstrucTotalContactos = $conexion->prepare($SqlTotalContacto);
        $InstrucTotalContactos->execute(array('%'.$Criterio.'%')) or die(print_r($SqlTotalContacto->errorInfo()." - ".$SqlTotalContacto, true));
        $ResultTotalContactos = $InstrucTotalContactos->fetch();
        $TotalContactos = $ResultTotalContactos['Total'];

        /* TOTALES DE RADICADOS CON COINSEDENCIAS CON LOS LAS EMPRESAS DE LOS TERCEROS */
        $SqlTotalEmpresas = "SELECT COUNT(`radi`.`id_radica`) AS `Total`
                            FROM `archivo_radica_recibidos` AS `radi`
                                INNER JOIN `gene_terceros_contac` AS `contac` ON (`radi`.`id_remite` = `contac`.`id_tercero`)
                                LEFT JOIN `gene_terceros_empresas` AS `empre` ON (`contac`.`id_empre` = `empre`.`id_empre`)
                            WHERE (`radi`.`transferido` = 0 AND `empre`.`razo_soci` LIKE ?)";
        $InstrucTotalEmpresas = $conexion->prepare($SqlTotalEmpresas);
        $InstrucTotalEmpresas->execute(array('%'.$Criterio.'%')) or die(print_r($SqlTotalEmpresas->errorInfo()." - ".$SqlTotalEmpresas, true));
        $ResultTotalEmpresas = $InstrucTotalEmpresas->fetch();
        $TotalEmpresas = $ResultTotalEmpresas['Total'];

        $Query = "";
        if($TotalIdRadica > 0){
            $Query.="AND `radi`.`id_radica` LIKE '%".$Criterio."%'";
        }

        if($TotalAsunto > 0){
            if($Query != ""){
                $Query.=" OR `radi`.`asunto` LIKE '%".$Criterio."%'";
            }else{
                $Query.=" AND `radi`.`asunto` LIKE '%".$Criterio."%'";
            }
        }

        if($TotalFuncionarios > 0){
            if($Query != ""){
                $Query.=" OR CONCAT(TRIM(`funcio`.`nom_funcio`), ' ', TRIM(`funcio`.`ape_funcio`)) LIKE '%".$Criterio."%'";
            }else{
                $Query.=" AND CONCAT(TRIM(`funcio`.`nom_funcio`), ' ', TRIM(`funcio`.`ape_funcio`)) LIKE '%".$Criterio."%'";                  
            }
        }

        if($TotalContactos > 0){
            if($Query != ""){
                $Query.=" OR `terce_contac`.`nom_contac` LIKE '%".$Criterio."%'";
            }else{
                $Query.=" AND `terce_contac`.`nom_contac` LIKE '%".$Criterio."%'";
            }
        }

        if($TotalEmpresas > 0){
            if($Query != ""){
                $Query.=" OR `terce_empre`.`razo_soci` LIKE '%".$Criterio."%'";
            }else{
                $Query.=" AND `terce_empre`.`razo_soci` LIKE '%".$Criterio."%'";
            }
        }

        return $Query;
    }
}
?>