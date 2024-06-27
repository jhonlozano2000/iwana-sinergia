<?php
class RadicadoRecibidoListarPendientes{
    private $Accion;
    private $Buscar;
    private $IdRadica;
    private $IdFuncioDeta;
    private $IdDepen;
    private $IdOfi;
    private $IdTercero;
    private $Asunto;
    private $QueContenga;
    private $Limite1;
    private $Limite2;
    private $Criterio1;
    
    public function __construct($Accion = null,  $Buscar = null, $IdRadica = null, $IdFuncioDeta = null, $IdTercero = null, $Asunto = null, 
                                $QueContenga = null, $IdDepen = null, $IdOfi = null, $Limite1 = null, $Limite2 = null, $Criterio1 = null){

        $this -> Accion       = $Accion;
        $this -> Buscar       = $Buscar;
        $this -> IdRadica     = $IdRadica;
        $this -> IdTercero    = $IdTercero;
        $this -> IdFuncioDeta = $IdFuncioDeta;
        $this -> Asunto       = $Asunto;
        $this -> QueContenga  = $QueContenga;
        $this -> IdDepen      = $IdDepen;
        $this -> IdOfi        = $IdOfi;
        $this -> Limite1      = $Limite1;
        $this -> Limite2      = $Limite2;
        $this -> Criterio1    = $Criterio1;
    }

    public function get_Accion() {
        return $this -> Accion;
    }
    
    public function get_Buscar() {
        return $this -> Buscar;
    }

    public function get_IdRadica() {
        return $this -> IdRadica;
    }

    public function get_IdTercero() {
        return $this -> IdTercero;
    }

    public function get_IdFuncioDeta() {
        return $this -> IdFuncioDeta;
    }

    public function get_Asunto() {
        return $this -> Asunto;
    }

    public function get_QueContenga() {
        return $this -> QueContenga;
    }

    public function get_IdDepen() {
        return $this -> IdDepen;
    }

    public function get_IdOfi() {
        return $this -> IdOfi;
    }

    public function get_Limite1() {
        return $this -> Limite1;
    }

    public function get_Limite2() {
        return $this -> Limite2;
    }

    public function set_Accion($Accion) {
        $this -> Accion = $Accion;
    }

    public function set_Buscar($Buscar){
        $this -> Buscar = $Buscar;
    }

    public function set_IdRadica($IdRadica) {
        $this -> IdRadica = $IdRadica;
    }

    public function set_IdTercero($IdTercero){
        $this -> IdTercero = $IdTercero;
    }

    public function set_IdFuncioDeta($IdFuncioDeta) {
        $this -> IdFuncioDeta = $IdFuncioDeta;
    }

    public function set_Asunto($Asunto){
        $this -> Asunto = $Asunto;
    }

    public function set_QueContenga($QueContenga){
        $this -> QueContenga = $QueContenga;
    }

    public function set_IdDepen($IdDepen) {
        $this -> IdDepen = $IdDepen;
    }

    public function set_IdOfi($IdOfi) {
        $this -> IdOfi = $IdOfi;
    }

    public function set_Limite1($Limite1) {
        $this -> Limite1 = $Limite1;
    }

    public function set_Limite2($Limite2) {
        $this -> Limite2 = $Limite2;
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
                            `forma_llega`.`requie_digital`, `radi`.`autoriza`
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
                        WHERE (`radi`.`transferido` = 0 AND `ra_respon`.`respon` = 1 AND `radi`.`digital` = 0 OR `radi`.`impri_rotu` = 0)
                        ORDER BY `radi`.`id_radica` DESC, `radi`.`fechor_radica` ASC 
                        LIMIT :Limite1, :Limite2";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":Limite1", $this->Limite1, PDO::PARAM_INT);
                $Instruc -> bindParam(":Limite2", $this->Limite2, PDO::PARAM_INT);
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
                            `forma_llega`.`requie_digital`, `radi`.`autoriza`
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
                        WHERE (`radi`.`transferido` = 0 AND `radi`.`autoriza` = 1 AND `ra_respon`.`respon` = 1 AND `ra_respon`.`id_funcio` = :id_funcio  AND `radi`.`digital` = 0 OR `radi`.`impri_rotu` = 0)
                        ORDER BY `radi`.`fechor_radica` DESC
                        LIMIT :Limite1, :Limite2";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":id_funcio", $this->IdFuncioDeta, PDO::PARAM_INT);
                $Instruc -> bindParam(":Limite1", $this->Limite1, PDO::PARAM_INT);
                $Instruc -> bindParam(":Limite2", $this->Limite2, PDO::PARAM_INT);
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
                            `forma_llega`.`requie_digital`, `radi`.`autoriza`
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
                            AND `radi`.`digital` = 0 OR `radi`.`impri_rotu` = 0)
                        ORDER BY `radi`.`fechor_radica` DESC
                        LIMIT :Limite1, :Limite2";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":id_depen", $this->IdDepen, PDO::PARAM_INT);
                $Instruc -> bindParam(":Limite1", $this->Limite1, PDO::PARAM_INT);
                $Instruc -> bindParam(":Limite2", $this->Limite2, PDO::PARAM_INT);
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
                            `forma_llega`.`requie_digital`, `radi`.`autoriza`
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
                            AND `funcio_deta`.`id_oficina` = :id_oficina AND `radi`.`digital` = 0 OR `radi`.`impri_rotu` = 0)
                        ORDER BY `radi`.`fechor_radica` DESC
                        LIMIT :Limite1, :Limite2";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":id_depen", $this->IdDepen, PDO::PARAM_INT);
                $Instruc -> bindParam(":id_oficina", $this->IdOfi, PDO::PARAM_INT);
                $Instruc -> bindParam(":Limite1", $this->Limite1, PDO::PARAM_INT);
                $Instruc -> bindParam(":Limite2", $this->Limite2, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($Accion == 9){
                /******************************************************************************************/
                /*  LISTO LOS PENDIENTES DE TODA LA CORRESPONDENCIA REIBIDA DE LA INSTITUCION
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`, `radi`.`fechor_radica`, `radi`.`fec_docu`, `radi`.`fec_venci`, `radi`.`asunto`, `radi`.`impri_rotu`, 
                            `radi`.`digital`, `radi`.`requie_respues`, `funcio`.`nom_funcio`, `funcio`.`ape_funcio`, `ofi`.`nom_oficina`, 
                            `depen`.`nom_depen`, `terce_contac`.`nom_contac`, `terce_contac`.`cargo`, `terce_empre`.`nit_empre`, `terce_empre`.`razo_soci`, 
                            `funcio_radica`.`nom_funcio` AS `nom_funcio_radi`, `funcio_radica`.`ape_funcio` AS `ape_funcio_radi`, 
                            `radi`.`radica_respuesta`, `radi`.`id_forma_llegada`, `forma_llega`.`nom_formaenvi` AS `nom_forma_llega`, 
                            `forma_llega`.`requie_digital`, `radi`.`autoriza`
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
                        WHERE (`radi`.`transferido` = 0 AND `ra_respon`.`respon` = 1 AND `radi`.`digital` = 0 OR `radi`.`impri_rotu` = 0)
                        ORDER BY `radi`.`fechor_radica` DESC 
                        LIMIT :Limite1, :Limite2";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":Limite1", $Limite1, PDO::PARAM_INT);
                $Instruc -> bindParam(":Limite2", $Limite2, PDO::PARAM_INT);
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
                            `radi`.`digital`, `radi`.`requie_respues`, `funcio`.`nom_funcio`, `funcio`.`ape_funcio`, `ofi`.`nom_oficina`, 
                            `depen`.`nom_depen`, `terce_contac`.`nom_contac`, `terce_contac`.`cargo`, `terce_empre`.`nit_empre`, `terce_empre`.`razo_soci`, 
                            `funcio_radica`.`nom_funcio` AS `nom_funcio_radi`, `funcio_radica`.`ape_funcio` AS `ape_funcio_radi`, 
                            `radi`.`radica_respuesta`, `radi`.`id_forma_llegada`, `forma_llega`.`nom_formaenvi` AS `nom_forma_llega`, 
                            `forma_llega`.`requie_digital`, `radi`.`autoriza`
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
                        WHERE (`radi`.`transferido` = 0 AND `ra_respon`.`respon` = 1  AND `radi`.`digital` = 0 OR `radi`.`impri_rotu` = 0 ".self::Generar_Query_Correspondencia($this->Buscar, $this->IdRadica, $this->IdTercero, $this->IdFuncioDeta, $this->Asunto, $this->QueContenga, $this->IdDepen, $this->IdOfi).")
                        ORDER BY `radi`.`fechor_radica` DESC
                        LIMIT :Limite1, :Limite2";
                        
                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":Limite1", $this->Limite1, PDO::PARAM_INT);
                $Instruc -> bindParam(":Limite2", $this->Limite2, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($this->Accion == 6){
                /******************************************************************************************/
                /*  FILTRO LA CORRESPONDENCIA EXTERNA DE UN FUNCIONARIO
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`, `radi`.`fechor_radica`, `radi`.`fec_docu`, `radi`.`fec_venci`, `radi`.`asunto`, `radi`.`impri_rotu`, 
                            `radi`.`digital`, `radi`.`requie_respues`, `funcio`.`nom_funcio`, `funcio`.`ape_funcio`, `ofi`.`nom_oficina`, 
                            `depen`.`nom_depen`, `terce_contac`.`nom_contac`, `terce_contac`.`cargo`, `terce_empre`.`nit_empre`, `terce_empre`.`razo_soci`, 
                            `funcio_radica`.`nom_funcio` AS `nom_funcio_radi`, `funcio_radica`.`ape_funcio` AS `ape_funcio_radi`, 
                            `radi`.`radica_respuesta`, `radi`.`id_forma_llegada`, `forma_llega`.`nom_formaenvi` AS `nom_forma_llega`, 
                            `forma_llega`.`requie_digital`, `radi`.`autoriza`
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
                        WHERE (`radi`.`transferido` = 0 AND `radi`.`autoriza` = 1 AND `ra_respon`.`respon` = 1 AND `ra_respon`.`id_funcio` = :id_funcio  AND `radi`.`digital` = 0 OR `radi`.`impri_rotu` = 0 ".self::Generar_Query_Correspondencia($this->Buscar, $this->IdRadica, $this->IdTercero, $this->IdFuncioDeta, $this->Asunto, $this->QueContenga, $this->IdDepen, $this->IdOfi).")
                        ORDER BY `radi`.`fechor_radica` DESC
                        LIMIT :Limite1, :Limite2";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":id_funcio", $this->IdFuncioDeta, PDO::PARAM_INT);
                $Instruc -> bindParam(":Limite1", $this->Limite1, PDO::PARAM_INT);
                $Instruc -> bindParam(":Limite2", $this->Limite2, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($this->Accion == 7){
                /******************************************************************************************/
                /*  FILTRO LA CORRESPONDENCIA EXTERNA DE UN FUNCIONARIO JEFE DE DEPENDENCIA
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`, `radi`.`fechor_radica`, `radi`.`fec_docu`, `radi`.`fec_venci`, `radi`.`asunto`, `radi`.`impri_rotu`, 
                            `radi`.`digital`, `radi`.`requie_respues`, `funcio`.`nom_funcio`, `funcio`.`ape_funcio`, `ofi`.`nom_oficina`, 
                            `depen`.`nom_depen`, `terce_contac`.`nom_contac`, `terce_contac`.`cargo`, `terce_empre`.`nit_empre`, `terce_empre`.`razo_soci`, 
                            `funcio_radica`.`nom_funcio` AS `nom_funcio_radi`, `funcio_radica`.`ape_funcio` AS `ape_funcio_radi`, 
                            `radi`.`radica_respuesta`, `radi`.`id_forma_llegada`, `forma_llega`.`nom_formaenvi` AS `nom_forma_llega`, 
                            `forma_llega`.`requie_digital`, `radi`.`autoriza`
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
                            AND `radi`.`digital` = 0 OR `radi`.`impri_rotu` = 0 ".self::Generar_Query_Correspondencia($this->Buscar, $this->IdRadica, $this->IdTercero, $this->IdFuncioDeta, $this->Asunto, $this->QueContenga, $this->IdDepen, $this->IdOfi).")
                        ORDER BY `radi`.`fechor_radica` DESC
                        LIMIT :Limite1, :Limite2";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":id_depen", $this->IdDepen, PDO::PARAM_INT);
                $Instruc -> bindParam(":Limite1", $this->Limite1, PDO::PARAM_INT);
                $Instruc -> bindParam(":Limite2", $this->Limite2, PDO::PARAM_INT);
                $Instruc->execute(array($this->IdDepen)) or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($this->Accion == 8){
                /******************************************************************************************/
                /*  FILTRO LA CORRESPONDENCIA EXTERNA DE UN FUNCIONARIO JEFE DE OFICINA
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`, `radi`.`fechor_radica`, `radi`.`fec_docu`, `radi`.`fec_venci`, `radi`.`asunto`, `radi`.`impri_rotu`, 
                            `radi`.`digital`, `radi`.`requie_respues`, `funcio`.`nom_funcio`, `funcio`.`ape_funcio`, `ofi`.`nom_oficina`, 
                            `depen`.`nom_depen`, `terce_contac`.`nom_contac`, `terce_contac`.`cargo`, `terce_empre`.`nit_empre`, `terce_empre`.`razo_soci`, 
                            `funcio_radica`.`nom_funcio` AS `nom_funcio_radi`, `funcio_radica`.`ape_funcio` AS `ape_funcio_radi`, 
                            `radi`.`radica_respuesta`, `radi`.`id_forma_llegada`, `forma_llega`.`nom_formaenvi` AS `nom_forma_llega`, 
                            `forma_llega`.`requie_digital`, `radi`.`autoriza`
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
                            AND `funcio_deta`.`id_oficina` = :id_oficina  AND `radi`.`digital` = 0 OR `radi`.`impri_rotu` = 0 ".self::Generar_Query_Correspondencia($this->Buscar, $this->IdRadica, $this->IdTercero, $this->IdFuncioDeta, $this->Asunto, $this->QueContenga, $this->IdDepen, $this->IdOfi).")
                        ORDER BY `radi`.`fechor_radica` DESC
                        LIMIT :Limite1, :Limite2";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":id_depen", $this->IdDepen, PDO::PARAM_INT);
                $Instruc -> bindParam(":id_oficina", $this->IdOfi, PDO::PARAM_INT);
                $Instruc -> bindParam(":Limite1", $this->Limite1, PDO::PARAM_INT);
                $Instruc -> bindParam(":Limite2", $this->Limite2, PDO::PARAM_INT);
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
                        WHERE (`radi`.`transferido` = 0 AND `ra_respon`.`respon` = 1 AND `radi`.`digital` = 0 OR `radi`.`impri_rotu` = 0)";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($this->Accion == 2){
                /******************************************************************************************/
                /*  LISTO LA CORRESPONDENCIA EXTERNA DE UN FUNCIONARIO
                /******************************************************************************************/
                $Sql = "SELECT DISTINCT `radi`.`id_radica`
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
                        WHERE (`radi`.`transferido` = 0 AND `radi`.`autoriza` = 1 AND `ra_respon`.`respon` = 1 AND `ra_respon`.`id_funcio` = :id_funcio  AND `radi`.`digital` = 0 OR `radi`.`impri_rotu` = 0)";

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
                        WHERE (`radi`.`transferido` = 0 AND `radi`.`autoriza` = 1 AND `ra_respon`.`respon` = 1 AND `depen`.`id_depen` = :id_depen AND `radi`.`digital` = 0 OR `radi`.`impri_rotu` = 0)";

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
                        WHERE (`radi`.`transferido` = 0 AND `radi`.`autoriza` = 1 AND `ra_respon`.`respon` = 1 AND `depen`.`id_depen` = :id_depen 
                            AND `funcio_deta`.`id_oficina` = :id_oficina AND `radi`.`digital` = 0 OR `radi`.`impri_rotu` = 0)";

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
                        WHERE (`radi`.`transferido` = 0 AND `radi`.`autoriza` = 1 AND `ra_respon`.`respon` = 1 AND `depen`.`id_depen` = :id_depen 
                            AND `funcio_deta`.`id_oficina` = :id_oficina AND `radi`.`digital` = 0 OR `radi`.`impri_rotu` = 0)";

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
                        WHERE (`radi`.`transferido` = 0 AND `ra_respon`.`respon` = 1  AND `radi`.`digital` = 0 OR `radi`.`impri_rotu` = 0 ".self::Generar_Query_Correspondencia($this->Buscar, $this->IdRadica, $this->IdTercero, $this->IdFuncioDeta, $this->Asunto, $this->QueContenga, $this->IdDepen, $this->IdOfi).")";

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
                        WHERE (`radi`.`transferido` = 0 AND `radi`.`autoriza` = 1 AND `ra_respon`.`respon` = 1  AND `radi`.`digital` = 0 OR `radi`.`impri_rotu` = 0 AND `ra_respon`.`id_funcio` = ? 
                            ".self::Generar_Query_Correspondencia($this->Buscar, $this->IdRadica, $this->IdTercero, $this->IdFuncioDeta, $this->Asunto, $this->QueContenga, $this->IdDepen, $this->IdOfi).")";

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
                        WHERE (`radi`.`transferido` = 0 AND `radi`.`autoriza` = 1 AND `ra_respon`.`respon` = 1  AND `radi`.`digital` = 0 OR `radi`.`impri_rotu` = 0 AND `depen`.`id_depen` = ?
                            ".self::Generar_Query_Correspondencia($this->Buscar, $this->IdRadica, $this->IdTercero, $this->IdFuncioDeta, $this->Asunto, $this->QueContenga, $this->IdDepen, $this->IdOfi).")";

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
                        WHERE (`radi`.`transferido` = 0 AND `radi`.`autoriza` = 1 AND `ra_respon`.`respon` = 1  AND `radi`.`digital` = 0 OR `radi`.`impri_rotu` = 0 AND `depen`.`id_depen` = ? 
                            AND `funcio_deta`.`id_oficina` = ? OR".self::Generar_Query_Correspondencia($this->Buscar, $this->IdRadica, $this->IdTercero, $this->IdFuncioDeta, $this->Asunto, $this->QueContenga, $this->IdDepen, $this->IdOfi).")";

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
                        WHERE (`radi`.`transferido` = 0 AND `ra_respon`.`respon` = 1 AND `radi`.`digital` = 0 OR `radi`.`impri_rotu` = 0)";

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
                        WHERE (`radi`.`transferido` = 0 AND `radi`.`autoriza` = 1 AND `ra_respon`.`respon` = 1  AND `radi`.`digital` = 0 OR `radi`.`impri_rotu` = 0 AND `ra_respon`.`id_funcio` = :id_funcio)";
                
                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":id_funcio", $this->IdFuncioDeta);
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
                        WHERE (`radi`.`transferido` = 0 AND `radi`.`autoriza` = 1 AND `ra_respon`.`respon` = 1 AND  AND `radi`.`digital` = 0 OR `radi`.`impri_rotu` = 0 `depen`.`id_depen` = :id_depen)";

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
                        WHERE (`radi`.`transferido` = 0 AND `radi`.`autoriza` = 1 AND `ra_respon`.`respon` = 1 AND `depen`.`id_depen` = :id_depen 
                            AND `funcio_deta`.`id_oficina` = :id_oficina AND `radi`.`digital` = 0 OR `radi`.`impri_rotu` = 0)";

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
                        WHERE (`radi`.`transferido` = 0 AND `ra_respon`.`respon` = 1 AND `radi`.`digital` = 0 OR `radi`.`impri_rotu` = 0 ".self::Generar_Query_Correspondencia($this->Buscar, $this->IdRadica, $this->IdTercero, $this->IdFuncioDeta, $this->Asunto, $this->QueContenga, $this->IdDepen, $this->IdOfi).")";

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
                        WHERE (`radi`.`transferido` = 0 AND `radi`.`autoriza` = 1 AND `ra_respon`.`respon` = 1  AND `radi`.`digital` = 0 OR `radi`.`impri_rotu` = 0 AND `ra_respon`.`id_funcio` = ? 
                            ".self::Generar_Query_Correspondencia($this->Buscar, $this->IdRadica, $this->IdTercero, $this->IdFuncioDeta, $this->Asunto, $this->QueContenga, $this->IdDepen, $this->IdOfi).")";

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
                        WHERE (`radi`.`transferido` = 0 AND `radi`.`autoriza` = 1 AND `ra_respon`.`respon` = 1  AND `radi`.`digital` = 0 OR `radi`.`impri_rotu` = 0 AND `depen`.`id_depen` = ?
                            ".self::Generar_Query_Correspondencia($this->Buscar, $this->IdRadica, $this->IdTercero, $this->IdFuncioDeta, $this->Asunto, $this->QueContenga, $this->IdDepen, $this->IdOfi).")";

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
                        WHERE (`radi`.`transferido` = 0 AND `radi`.`autoriza` = 1 AND `ra_respon`.`respon` = 1  AND `radi`.`digital` = 0 OR `radi`.`impri_rotu` = 0 AND `depen`.`id_depen` = ? AND `funcio_deta`.`id_oficina` = ? OR".self::Generar_Query_Correspondencia($this->Buscar, $this->IdRadica, $this->IdTercero, $this->IdFuncioDeta, $this->Asunto, $this->QueContenga, $this->IdDepen, $this->IdOfi).")";

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
    
    public static function Generar_Query_Correspondencia($Buscar, $IdRadica, $IdTercero, $IdFuncio, $Asunto, $QueContenga, $IdDepen, $IdOfi){
        $conexion = new Conexion();
        
        $Query = "";
        
        if($Buscar != "" and $IdRadica == "" and $IdTercero == "" and $IdFuncio == "" and $Asunto == "" and $QueContenga == "" and $IdDepen == "" and $IdOfi == ""){

            $Query = "AND `radi`.`id_radica` LIKE '%".$Buscar."%' 
                    OR `terce_contac`.`nom_contac` LIKE '%".$Buscar."%' 
                    OR `terce_empre`.`razo_soci` LIKE '%".$Buscar."%' 
                    OR CONCAT(TRIM(`funcio`.`nom_funcio`), ' ', TRIM(`funcio`.`ape_funcio`)) LIKE '%".$Buscar."%' 
                    OR `radi`.`asunto` LIKE '%".$Buscar."%'";
        }else{
            if($IdRadica != ""){
                $Query.="`radi`.`id_radica` LIKE '%".$IdRadica."%'";
            }

            if($IdTercero != ""){
                if($Query == ""){
                    $Query.=" `terce_contac`.`id_tercero` = ".$IdTercero;
                }else{
                    $Query.=" AND `terce_contac`.`id_tercero` = ".$IdTercero;
                }
            }
    
            if($IdFuncio != ""){
                if($Query == ""){
                    $Query.=" `funcio_deta`.`id_funcio_deta` = ".$IdFuncio;
                }else{
                    $Query.=" AND `funcio_deta`.`id_funcio_deta` = ".$IdFuncio;
                }
            }

            if($Asunto != ""){
                if($Query == ""){
                    $Query.=" `radi`.`asunto` LIKE '%".$Asunto."%'";
                }else{
                    $Query.=" AND `radi`.`asunto` LIKE '%".$Asunto."%'";
                }
            }

            if($QueContenga != ""){
                if($Query == ""){
                    $Query.=" `radi`.`que_contenga` LIKE '%".$QueContenga."%'";
                }else{
                    $Query.=" AND `radi`.`que_contenga` LIKE '%".$QueContenga."%'";
                }
            }

            if($IdDepen != ""){
                if($Query == ""){
                    $Query.=" `depen`.`id_depen` = ".$IdDepen;
                }else{
                    $Query.=" AND `depen`.`id_depen` = ".$IdDepen;
                }
            }

            if($IdOfi != ""){
                if($Query == ""){
                    $Query.=" `funcio_deta`.`id_oficina` = ".$IdOfi;
                }else{
                    $Query.=" AND `funcio_deta`.`id_oficina` = ".$IdOfi;
                }
            }
        }

        return $Query;
        exit();
    }
}
?>