<?php
class RadicadoEnviadoTempListarBandeja{
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
                /*  LISTO TODA LA CORRESPONDENCIA TEMPORAL DE LA INSTITUCION
                /******************************************************************************************/
               $Sql = "SELECT 'Por Firmar' AS 'Pendiente', `temp`.`id_temp`, `temp`.`fechor_registro`, `temp`.`id_ruta`, `temp`.`asunto`,
                            `usua_regis`.`nom_funcio`, `usua_regis`.`ape_funcio`, `usua_regis_depen`.`id_depen`, `usua_regis_depen`.`nom_depen`,
                            `usua_regis_ofi`.`nom_oficina`, `temp`.`genera_plantilla`, `temp`.`plantilla_cargada`, `temp`.`nom_archivo`,
                            `quien_firma`.`firmado` AS 'estado_gestion', `quien_firma`.`descargo_plantilla`, `quien_firma`.`subio_plantilla`,
                            `temp`.`radicado`, `temp`.`terminado`, `contac`.`nom_contac`, `contac_empre`.`razo_soci`
                        FROM `archivo_radica_enviados_temp_quienes_firman` AS `quien_firma`
                            INNER JOIN `archivo_radica_enviados_temp` AS `temp` ON (`quien_firma`.`id_temp` = `temp`.`id_temp`)
                            INNER JOIN `gene_funcionarios_deta` AS `usua_regis_deta` ON (`temp`.`id_usua_regis` = `usua_regis_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `usua_regis` ON (`usua_regis_deta`.`id_funcio` = `usua_regis`.`id_funcio`)
                            INNER JOIN `areas_cargos` AS `usua_cargo_depen` ON (`usua_regis_deta`.`id_cargo` = `usua_cargo_depen`.`id_cargo`)
                            INNER JOIN `areas_oficinas` AS `usua_regis_ofi` ON (`usua_regis_deta`.`id_oficina` = `usua_regis_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `usua_regis_depen` ON (`usua_cargo_depen`.`id_depen` = `usua_regis_depen`.`id_depen`)
                            INNER JOIN `gene_terceros_contac` AS `contac` ON (`temp`.`id_destina` = `contac`.`id_tercero`)
                            LEFT JOIN `gene_terceros_empresas` AS `contac_empre` ON (`contac`.`id_empre` = `contac_empre`.`id_empre`)
                        WHERE (`temp`.`radicado` = 0 AND `temp`.`anulado` = 0)
                        UNION
                        SELECT 'Por Aprobar' AS 'Pendiente', `temp`.`id_temp`, `temp`.`fechor_registro`, `temp`.`id_ruta`, `temp`.`asunto`,
                            `usua_regis`.`nom_funcio`, `usua_regis`.`ape_funcio`, `usua_regis_depen`.`id_depen`, `usua_regis_depen`.`nom_depen`,
                            `usua_regis_ofi`.`nom_oficina`, `temp`.`genera_plantilla`, `temp`.`plantilla_cargada`, `temp`.`nom_archivo`,
                            `respon`.`aprobado` AS 'estado_gestion', `respon`.`descargo_plantilla`, `respon`.`subio_plantilla`, `temp`.`radicado`,
                            `temp`.`terminado`, `contac`.`nom_contac`, `contac_empre`.`razo_soci`
                        FROM `archivo_radica_enviados_temp` AS `temp`
                            INNER JOIN `gene_funcionarios_deta` AS `usua_regis_deta` ON (`temp`.`id_usua_regis` = `usua_regis_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `usua_regis` ON (`usua_regis_deta`.`id_funcio` = `usua_regis`.`id_funcio`)
                            INNER JOIN `areas_cargos` AS `usua_cargo_depen` ON (`usua_regis_deta`.`id_cargo` = `usua_cargo_depen`.`id_cargo`)
                            INNER JOIN `areas_oficinas` AS `usua_regis_ofi` ON (`usua_regis_deta`.`id_oficina` = `usua_regis_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `usua_regis_depen` ON (`usua_cargo_depen`.`id_depen` = `usua_regis_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_enviados_temp_responsa` AS `respon`  ON (`respon`.`id_temp` = `temp`.`id_temp`)
                            INNER JOIN `gene_terceros_contac` AS `contac` ON (`temp`.`id_destina` = `contac`.`id_tercero`)
                            LEFT JOIN `gene_terceros_empresas` AS `contac_empre` ON (`contac`.`id_empre` = `contac_empre`.`id_empre`)
                        WHERE (`temp`.`radicado` = 0 AND `temp`.`anulado` = 0)
                        UNION
                        SELECT 'Por Proyectar' AS 'Pendiente', `temp`.`id_temp`, `temp`.`fechor_registro`, `temp`.`id_ruta`, `temp`.`asunto`,
                            `usua_regis`.`nom_funcio`, `usua_regis`.`ape_funcio`, `usua_regis_depen`.`id_depen`, `usua_regis_depen`.`nom_depen`,
                            `usua_regis_ofi`.`nom_oficina`, `temp`.`genera_plantilla`, `temp`.`plantilla_cargada`, `temp`.`nom_archivo`,
                            `temp_proyec`.`terminado` AS 'estado_gestion', `temp_proyec`.`descargo_plantilla`, `temp_proyec`.`subio_plantilla`,
                            `temp`.`radicado`, `temp`.`terminado`, `contac`.`nom_contac`, `contac_empre`.`razo_soci`
                        FROM `archivo_radica_enviados_temp` AS `temp`
                            INNER JOIN `gene_funcionarios_deta` AS `usua_regis_deta` ON (`temp`.`id_usua_regis` = `usua_regis_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `usua_regis` ON (`usua_regis_deta`.`id_funcio` = `usua_regis`.`id_funcio`)
                            INNER JOIN `areas_cargos` AS `usua_cargo_depen` ON (`usua_regis_deta`.`id_cargo` = `usua_cargo_depen`.`id_cargo`)
                            INNER JOIN `areas_oficinas` AS `usua_regis_ofi` ON (`usua_regis_deta`.`id_oficina` = `usua_regis_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `usua_regis_depen` ON (`usua_cargo_depen`.`id_depen` = `usua_regis_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_enviados_temp_proyector` AS `temp_proyec` ON (`temp_proyec`.`id_temp` = `temp`.`id_temp`)
                            INNER JOIN `gene_terceros_contac` AS `contac` ON (`temp`.`id_destina` = `contac`.`id_tercero`)
                            LEFT JOIN `gene_terceros_empresas` AS `contac_empre` ON (`contac`.`id_empre` = `contac_empre`.`id_empre`)
                        WHERE (`temp`.`radicado` = 0 AND `temp`.`anulado` = 0)
                        ORDER BY `radicado`, `id_temp` ASC
                        LIMIT :Criterio1, :Criterio2";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":Criterio1", $this->Criterio1, PDO::PARAM_INT);
                $Instruc -> bindParam(":Criterio2", $this->Criterio2, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($this->Accion == 2){
                /******************************************************************************************/
                /*  LISTO LA CORRESPONDENCIA TEMPORAL DE UN FUNCIONARIO
                /******************************************************************************************/
                $Sql = "SELECT 'Por Firmar' AS 'Pendiente', `temp`.`id_temp`, `temp`.`fechor_registro`, `temp`.`id_ruta`, `temp`.`asunto`,
                            `usua_regis`.`nom_funcio`, `usua_regis`.`ape_funcio`, `usua_regis_depen`.`id_depen`, `usua_regis_depen`.`nom_depen`,
                            `usua_regis_ofi`.`nom_oficina`, `temp`.`genera_plantilla`, `temp`.`plantilla_cargada`, `temp`.`nom_archivo`,
                            `quien_firma`.`firmado` AS 'estado_gestion', `quien_firma`.`descargo_plantilla`, `quien_firma`.`subio_plantilla`,
                            `temp`.`radicado`, `temp`.`terminado`, `contac`.`nom_contac`, `contac_empre`.`razo_soci`
                        FROM `archivo_radica_enviados_temp_quienes_firman` AS `quien_firma`
                            INNER JOIN `archivo_radica_enviados_temp` AS `temp` ON (`quien_firma`.`id_temp` = `temp`.`id_temp`)
                            INNER JOIN `gene_funcionarios_deta` AS `usua_regis_deta` ON (`temp`.`id_usua_regis` = `usua_regis_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `usua_regis` ON (`usua_regis_deta`.`id_funcio` = `usua_regis`.`id_funcio`)
                            INNER JOIN `areas_cargos` AS `usua_cargo_depen` ON (`usua_regis_deta`.`id_cargo` = `usua_cargo_depen`.`id_cargo`)
                            INNER JOIN `areas_oficinas` AS `usua_regis_ofi` ON (`usua_regis_deta`.`id_oficina` = `usua_regis_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `usua_regis_depen` ON (`usua_cargo_depen`.`id_depen` = `usua_regis_depen`.`id_depen`)
                            INNER JOIN `gene_terceros_contac` AS `contac` ON (`temp`.`id_destina` = `contac`.`id_tercero`)
                            LEFT JOIN `gene_terceros_empresas` AS `contac_empre` ON (`contac`.`id_empre` = `contac_empre`.`id_empre`)
                        WHERE (`temp`.`anulado` = 0 AND `temp`.`radicado` = 0 AND `quien_firma`.`id_funcio_deta` = :id_funcio_quien_firma)
                        UNION
                        SELECT 'Por Aprobar' AS 'Pendiente', `temp`.`id_temp`, `temp`.`fechor_registro`, `temp`.`id_ruta`, `temp`.`asunto`,
                            `usua_regis`.`nom_funcio`, `usua_regis`.`ape_funcio`, `usua_regis_depen`.`id_depen`, `usua_regis_depen`.`nom_depen`,
                            `usua_regis_ofi`.`nom_oficina`, `temp`.`genera_plantilla`, `temp`.`plantilla_cargada`, `temp`.`nom_archivo`,
                            `respon`.`aprobado` AS 'estado_gestion', `respon`.`descargo_plantilla`, `respon`.`subio_plantilla`, `temp`.`radicado`,
                            `temp`.`terminado`, `contac`.`nom_contac`, `contac_empre`.`razo_soci`
                        FROM `archivo_radica_enviados_temp` AS `temp`
                            INNER JOIN `gene_funcionarios_deta` AS `usua_regis_deta` ON (`temp`.`id_usua_regis` = `usua_regis_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `usua_regis` ON (`usua_regis_deta`.`id_funcio` = `usua_regis`.`id_funcio`)
                            INNER JOIN `areas_cargos` AS `usua_cargo_depen` ON (`usua_regis_deta`.`id_cargo` = `usua_cargo_depen`.`id_cargo`)
                            INNER JOIN `areas_oficinas` AS `usua_regis_ofi` ON (`usua_regis_deta`.`id_oficina` = `usua_regis_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `usua_regis_depen` ON (`usua_cargo_depen`.`id_depen` = `usua_regis_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_enviados_temp_responsa` AS `respon`  ON (`respon`.`id_temp` = `temp`.`id_temp`)
                            INNER JOIN `gene_terceros_contac` AS `contac` ON (`temp`.`id_destina` = `contac`.`id_tercero`)
                            LEFT JOIN `gene_terceros_empresas` AS `contac_empre` ON (`contac`.`id_empre` = `contac_empre`.`id_empre`)
                        WHERE (`temp`.`anulado` = 0 AND `temp`.`radicado` = 0 AND `respon`.`id_funcio_deta` = :id_funcio_deta_respon)
                        UNION
                        SELECT 'Por Proyectar' AS 'Pendiente', `temp`.`id_temp`, `temp`.`fechor_registro`, `temp`.`id_ruta`, `temp`.`asunto`,
                            `usua_regis`.`nom_funcio`, `usua_regis`.`ape_funcio`, `usua_regis_depen`.`id_depen`, `usua_regis_depen`.`nom_depen`,
                            `usua_regis_ofi`.`nom_oficina`, `temp`.`genera_plantilla`, `temp`.`plantilla_cargada`, `temp`.`nom_archivo`,
                            `temp_proyec`.`terminado` AS 'estado_gestion', `temp_proyec`.`descargo_plantilla`, `temp_proyec`.`subio_plantilla`,
                            `temp`.`radicado`, `temp`.`terminado`, `contac`.`nom_contac`, `contac_empre`.`razo_soci`
                        FROM `archivo_radica_enviados_temp` AS `temp`
                            INNER JOIN `gene_funcionarios_deta` AS `usua_regis_deta` ON (`temp`.`id_usua_regis` = `usua_regis_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `usua_regis` ON (`usua_regis_deta`.`id_funcio` = `usua_regis`.`id_funcio`)
                            INNER JOIN `areas_cargos` AS `usua_cargo_depen` ON (`usua_regis_deta`.`id_cargo` = `usua_cargo_depen`.`id_cargo`)
                            INNER JOIN `areas_oficinas` AS `usua_regis_ofi` ON (`usua_regis_deta`.`id_oficina` = `usua_regis_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `usua_regis_depen` ON (`usua_cargo_depen`.`id_depen` = `usua_regis_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_enviados_temp_proyector` AS `temp_proyec` ON (`temp_proyec`.`id_temp` = `temp`.`id_temp`)
                            INNER JOIN `gene_terceros_contac` AS `contac` ON (`temp`.`id_destina` = `contac`.`id_tercero`)
                            LEFT JOIN `gene_terceros_empresas` AS `contac_empre` ON (`contac`.`id_empre` = `contac_empre`.`id_empre`)
                        WHERE (`temp`.`anulado` = 0 AND `temp`.`radicado` = 0 AND `temp_proyec`.`id_funcio_deta` = :id_funcio_deta_proyec)
                        ORDER BY `radicado`, `id_temp` ASC
                        LIMIT :Criterio1, :Criterio2";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_funcio_quien_firma', $this->IdFuncioDeta, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_funcio_deta_respon', $this->IdFuncioDeta, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_funcio_deta_proyec', $this->IdFuncioDeta, PDO::PARAM_INT);
                $Instruc -> bindParam(":Criterio1", $this->Criterio1, PDO::PARAM_INT);
                $Instruc -> bindParam(":Criterio2", $this->Criterio2, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($this->Accion == 3){
                /******************************************************************************************/
                /*  LISTO LA CORRESPONDENCIA TEMPORAL DE UN FUNCIONARIO JEFE DE DEPENDENCIA
                /******************************************************************************************/
                $Sql = "SELECT 'Por Firmar' AS 'Pendiente', `temp`.`id_temp`, `temp`.`fechor_registro`, `temp`.`id_ruta`, `temp`.`asunto`,
                            `usua_regis`.`nom_funcio`, `usua_regis`.`ape_funcio`, `usua_regis_depen`.`id_depen`, `usua_regis_depen`.`nom_depen`,
                            `usua_regis_ofi`.`nom_oficina`, `temp`.`genera_plantilla`, `temp`.`plantilla_cargada`, `temp`.`nom_archivo`,
                            `temp_quien_firma`.`firmando` AS 'estado_gestion', `temp_quien_firma`.`descargo_plantilla`,
                            `temp_quien_firma`.`subio_plantilla`, `temp`.`radicado`, `temp`.`terminado`, `quien_firma_cargo`.`id_depen`,
                            `contac`.`nom_contac`, `contac_empre`.`razo_soci`
                        FROM `archivo_radica_enviados_temp_quienes_firman` AS `temp_quien_firma`
                            INNER JOIN `archivo_radica_enviados_temp` AS `temp` ON (`temp_quien_firma`.`id_temp` = `temp`.`id_temp`)
                            INNER JOIN `gene_funcionarios_deta` AS `usua_regis_deta` ON (`temp`.`id_usua_regis` = `usua_regis_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios_deta` AS `quien_firma_deta` ON (`temp_quien_firma`.`id_funcio_deta` = `quien_firma_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `usua_regis` ON (`usua_regis_deta`.`id_funcio` = `usua_regis`.`id_funcio`)
                            INNER JOIN `areas_cargos` AS `usua_cargo_depen` ON (`usua_regis_deta`.`id_cargo` = `usua_cargo_depen`.`id_cargo`)
                            INNER JOIN `areas_oficinas` AS `usua_regis_ofi` ON (`usua_regis_deta`.`id_oficina` = `usua_regis_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `usua_regis_depen` ON (`usua_cargo_depen`.`id_depen` = `usua_regis_depen`.`id_depen`)
                            INNER JOIN `areas_cargos` AS `quien_firma_cargo` ON (`quien_firma_deta`.`id_cargo` = `quien_firma_cargo`.`id_cargo`)
                            INNER JOIN `gene_terceros_contac` AS `contac` ON (`temp`.`id_destina` = `contac`.`id_tercero`)
                            LEFT JOIN `gene_terceros_empresas` AS `contac_empre` ON (`contac`.`id_empre` = `contac_empre`.`id_empre`)
                        WHERE (`temp`.`anulado` = 0 AND `temp`.`radicado` = 0 AND `quien_firma_cargo`.`id_depen` = :id_depen_quien_firma)
                        UNION
                        SELECT 'Por Aprobar' AS 'Pendiente', `temp`.`id_temp`, `temp`.`fechor_registro`, `temp`.`id_ruta`, `temp`.`asunto`,
                            `usua_regis`.`nom_funcio`, `usua_regis`.`ape_funcio`, `usua_regis_depen`.`id_depen`, `usua_regis_depen`.`nom_depen`,
                            `usua_regis_ofi`.`nom_oficina`, `temp`.`genera_plantilla`, `temp`.`plantilla_cargada`, `temp`.`nom_archivo`,
                            `tempo_respon`.`aprobado` AS 'estado_gestion', `tempo_respon`.`descargo_plantilla`, `tempo_respon`.`subio_plantilla`,
                            `temp`.`radicado`, `temp`.`terminado`, `respon_cargo`.`id_depen`, `contac`.`nom_contac`, `contac_empre`.`razo_soci`
                        FROM `archivo_radica_enviados_temp` AS `temp`
                            INNER JOIN `gene_funcionarios_deta` AS `usua_regis_deta` ON (`temp`.`id_usua_regis` = `usua_regis_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `usua_regis` ON (`usua_regis_deta`.`id_funcio` = `usua_regis`.`id_funcio`)
                            INNER JOIN `areas_cargos` AS `usua_cargo_depen` ON (`usua_regis_deta`.`id_cargo` = `usua_cargo_depen`.`id_cargo`)
                            INNER JOIN `areas_oficinas` AS `usua_regis_ofi` ON (`usua_regis_deta`.`id_oficina` = `usua_regis_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `usua_regis_depen` ON (`usua_cargo_depen`.`id_depen` = `usua_regis_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_enviados_temp_responsa` AS `tempo_respon` ON (`tempo_respon`.`id_temp` = `temp`.`id_temp`)
                            INNER JOIN `gene_funcionarios_deta` AS `respon_deta` ON (`tempo_respon`.`id_funcio_deta` = `respon_deta`.`id_funcio_deta`)
                            INNER JOIN `areas_cargos` AS `respon_cargo` ON (`respon_deta`.`id_cargo` = `respon_cargo`.`id_cargo`)
                            INNER JOIN `gene_terceros_contac` AS `contac` ON (`temp`.`id_destina` = `contac`.`id_tercero`)
                            LEFT JOIN `gene_terceros_empresas` AS `contac_empre` ON (`contac`.`id_empre` = `contac_empre`.`id_empre`)
                        WHERE (`temp`.`anulado` = 0 AND `temp`.`radicado` = 0 AND `respon_cargo`.`id_depen` = :id_depen_respon)
                        UNION
                        SELECT 'Por Proyectar' AS 'Pendiente', `temp`.`id_temp`, `temp`.`fechor_registro`, `temp`.`id_ruta`, `temp`.`asunto`,
                            `usua_regis`.`nom_funcio`, `usua_regis`.`ape_funcio`, `usua_regis_depen`.`id_depen`, `usua_regis_depen`.`nom_depen`,
                            `usua_regis_ofi`.`id_depen`, `usua_regis_ofi`.`nom_oficina`, `temp`.`genera_plantilla`, `temp`.`plantilla_cargada`,
                            `temp`.`nom_archivo`, `temp_proyec`.`terminado` AS 'estado_gestion', `temp_proyec`.`descargo_plantilla`,
                            `temp_proyec`.`subio_plantilla`, `temp`.`radicado`, `temp`.`terminado`, `proyec_cargo`.`id_depen`, `contac`.`nom_contac`,
                            `contac_empre`.`razo_soci`
                        FROM `archivo_radica_enviados_temp` AS `temp`
                            INNER JOIN `gene_funcionarios_deta` AS `usua_regis_deta` ON (`temp`.`id_usua_regis` = `usua_regis_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `usua_regis` ON (`usua_regis_deta`.`id_funcio` = `usua_regis`.`id_funcio`)
                            INNER JOIN `areas_cargos` AS `usua_cargo_depen` ON (`usua_regis_deta`.`id_cargo` = `usua_cargo_depen`.`id_cargo`)
                            INNER JOIN `areas_oficinas` AS `usua_regis_ofi` ON (`usua_regis_deta`.`id_oficina` = `usua_regis_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `usua_regis_depen` ON (`usua_cargo_depen`.`id_depen` = `usua_regis_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_enviados_temp_proyector` AS `temp_proyec` ON (`temp_proyec`.`id_temp` = `temp`.`id_temp`)
                            INNER JOIN `gene_funcionarios_deta` AS `proyec_deta` ON (`temp_proyec`.`id_funcio_deta` = `proyec_deta`.`id_funcio_deta`)
                            INNER JOIN `areas_cargos` AS `proyec_cargo` ON (`proyec_deta`.`id_cargo` = `proyec_cargo`.`id_cargo`)
                            INNER JOIN `gene_terceros_contac` AS `contac` ON (`temp`.`id_destina` = `contac`.`id_tercero`)
                            LEFT JOIN `gene_terceros_empresas` AS `contac_empre` ON (`contac`.`id_empre` = `contac_empre`.`id_empre`)
                        WHERE (`temp`.`anulado` = 0 AND `temp`.`radicado` = 0 AND `proyec_cargo`.`id_depen` = :id_depen_proyec)
                        ORDER BY `radicado`, `id_temp` ASC
                        LIMIT :Criterio1, :Criterio2";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_depen_quien_firma', $this->IdDepen, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_depen_respon', $this->IdDepen, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_depen_proyec', $this->IdDepen, PDO::PARAM_INT);
                $Instruc -> bindParam(":Criterio1", $this->Criterio1, PDO::PARAM_INT);
                $Instruc -> bindParam(":Criterio2", $this->Criterio2, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($this->Accion == 4){
                /******************************************************************************************/
                /*  LISTO LA CORRESPONDENCIA EXTERNA DE UN FUNCIONARIO JEFE DE OFICINA
                /******************************************************************************************/
                $Sql = "SELECT 'Por Firmar' AS 'Pendiente', `temp`.`id_temp`, `temp`.`fechor_registro`, `temp`.`id_ruta`, `temp`.`asunto`,
                            `usua_regis`.`nom_funcio`, `usua_regis`.`ape_funcio`, `usua_regis_depen`.`id_depen`, `usua_regis_depen`.`nom_depen`,
                            `usua_regis_ofi`.`nom_oficina`, `temp`.`genera_plantilla`, `temp`.`plantilla_cargada`, `temp`.`nom_archivo`,
                            `temp_quien_firma`.`firmando` AS 'estado_gestion', `temp_quien_firma`.`descargo_plantilla`,
                            `temp_quien_firma`.`subio_plantilla`, `temp`.`radicado`, `temp`.`terminado`, `quien_firma_cargo`.`id_depen`, `contac`.`nom_contac`,
                            `contac_empre`.`razo_soci`
                        FROM `archivo_radica_enviados_temp_quienes_firman` AS `temp_quien_firma`
                            INNER JOIN `archivo_radica_enviados_temp` AS `temp` ON (`temp_quien_firma`.`id_temp` = `temp`.`id_temp`)
                            INNER JOIN `gene_funcionarios_deta` AS `usua_regis_deta` ON (`temp`.`id_usua_regis` = `usua_regis_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios_deta` AS `quien_firma_deta` ON (`temp_quien_firma`.`id_funcio_deta` = `quien_firma_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `usua_regis` ON (`usua_regis_deta`.`id_funcio` = `usua_regis`.`id_funcio`)
                            INNER JOIN `areas_cargos` AS `usua_cargo_depen` ON (`usua_regis_deta`.`id_cargo` = `usua_cargo_depen`.`id_cargo`)
                            INNER JOIN `areas_oficinas` AS `usua_regis_ofi` ON (`usua_regis_deta`.`id_oficina` = `usua_regis_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `usua_regis_depen` ON (`usua_cargo_depen`.`id_depen` = `usua_regis_depen`.`id_depen`)
                            INNER JOIN `areas_cargos` AS `quien_firma_cargo` ON (`quien_firma_deta`.`id_cargo` = `quien_firma_cargo`.`id_cargo`)
                            INNER JOIN `gene_terceros_contac` AS `contac` ON (`temp`.`id_destina` = `contac`.`id_tercero`)
                            LEFT JOIN `gene_terceros_empresas` AS `contac_empre` ON (`contac`.`id_empre` = `contac_empre`.`id_empre`)
                        WHERE (`temp`.`anulado` = 0 AND `temp`.`radicado` = 0 AND `quien_firma_cargo`.`id_depen` = :id_depen_quien_firma
                            AND `temp_quien_firma`.`id_oficina` = :id_oficina_quien_firma)
                        UNION
                        SELECT 'Por Aprobar' AS 'Pendiente', `temp`.`id_temp`, `temp`.`fechor_registro`, `temp`.`id_ruta`, `temp`.`asunto`,
                            `usua_regis`.`nom_funcio`, `usua_regis`.`ape_funcio`, `usua_regis_depen`.`id_depen`, `usua_regis_depen`.`nom_depen`,
                            `usua_regis_ofi`.`nom_oficina`, `temp`.`genera_plantilla`, `temp`.`plantilla_cargada`, `temp`.`nom_archivo`,
                            `tempo_respon`.`aprobado` AS 'estado_gestion', `tempo_respon`.`descargo_plantilla`, `tempo_respon`.`subio_plantilla`,
                            `temp`.`radicado`, `temp`.`terminado`, `respon_cargo`.`id_depen`, `contac`.`nom_contac`, `contac_empre`.`razo_soci`
                        FROM `archivo_radica_enviados_temp` AS `temp`
                            INNER JOIN `gene_funcionarios_deta` AS `usua_regis_deta` ON (`temp`.`id_usua_regis` = `usua_regis_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `usua_regis` ON (`usua_regis_deta`.`id_funcio` = `usua_regis`.`id_funcio`)
                            INNER JOIN `areas_cargos` AS `usua_cargo_depen` ON (`usua_regis_deta`.`id_cargo` = `usua_cargo_depen`.`id_cargo`)
                            INNER JOIN `areas_oficinas` AS `usua_regis_ofi` ON (`usua_regis_deta`.`id_oficina` = `usua_regis_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `usua_regis_depen` ON (`usua_cargo_depen`.`id_depen` = `usua_regis_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_enviados_temp_responsa` AS `tempo_respon` ON (`tempo_respon`.`id_temp` = `temp`.`id_temp`)
                            INNER JOIN `gene_funcionarios_deta` AS `respon_deta` ON (`tempo_respon`.`id_funcio_deta` = `respon_deta`.`id_funcio_deta`)
                            INNER JOIN `areas_cargos` AS `respon_cargo` ON (`respon_deta`.`id_cargo` = `respon_cargo`.`id_cargo`)
                            INNER JOIN `gene_terceros_contac` AS `contac` ON (`temp`.`id_destina` = `contac`.`id_tercero`)
                            LEFT JOIN `gene_terceros_empresas` AS `contac_empre` ON (`contac`.`id_empre` = `contac_empre`.`id_empre`)
                        WHERE (`temp`.`anulado` = 0 AND `temp`.`radicado` = 0 AND `respon_cargo`.`id_depen` = :id_depen_respon AND `respon_deta`.`id_oficina` = :id_oficina_respon)
                        UNION
                        SELECT 'Por Proyectar' AS 'Pendiente', `temp`.`id_temp`, `temp`.`fechor_registro`, `temp`.`id_ruta`, `temp`.`asunto`,
                            `usua_regis`.`nom_funcio`, `usua_regis`.`ape_funcio`, `usua_regis_depen`.`id_depen`, `usua_regis_depen`.`nom_depen`,
                            `usua_regis_ofi`.`id_depen`, `usua_regis_ofi`.`nom_oficina`, `temp`.`genera_plantilla`, `temp`.`plantilla_cargada`,
                            `temp`.`nom_archivo`, `temp_proyec`.`terminado` AS 'estado_gestion', `temp_proyec`.`descargo_plantilla`,
                            `temp_proyec`.`subio_plantilla`, `temp`.`radicado`, `temp`.`terminado`, `proyec_cargo`.`id_depen`, `contac`.`nom_contac`,
                            `contac_empre`.`razo_soci`
                        FROM `archivo_radica_enviados_temp` AS `temp`
                            INNER JOIN `gene_funcionarios_deta` AS `usua_regis_deta` ON (`temp`.`id_usua_regis` = `usua_regis_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `usua_regis` ON (`usua_regis_deta`.`id_funcio` = `usua_regis`.`id_funcio`)
                            INNER JOIN `areas_cargos` AS `usua_cargo_depen` ON (`usua_regis_deta`.`id_cargo` = `usua_cargo_depen`.`id_cargo`)
                            INNER JOIN `areas_oficinas` AS `usua_regis_ofi` ON (`usua_regis_deta`.`id_oficina` = `usua_regis_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `usua_regis_depen` ON (`usua_cargo_depen`.`id_depen` = `usua_regis_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_enviados_temp_proyector` AS `temp_proyec` ON (`temp_proyec`.`id_temp` = `temp`.`id_temp`)
                            INNER JOIN `gene_funcionarios_deta` AS `proyec_deta` ON (`temp_proyec`.`id_funcio_deta` = `proyec_deta`.`id_funcio_deta`)
                            INNER JOIN `areas_cargos` AS `proyec_cargo` ON (`proyec_deta`.`id_cargo` = `proyec_cargo`.`id_cargo`)
                            INNER JOIN `gene_terceros_contac` AS `contac` ON (`temp`.`id_destina` = `contac`.`id_tercero`)
                            LEFT JOIN `gene_terceros_empresas` AS `contac_empre` ON (`contac`.`id_empre` = `contac_empre`.`id_empre`)
                        WHERE (`temp`.`anulado` = 0 AND `temp`.`radicado` = 0 AND `proyec_cargo`.`id_depen` = :id_depen_proyec AND `proyec_deta`.`id_oficina` = :id_oficina_proyec)
                        ORDER BY `radicado`, `id_temp` ASC
                        LIMIT :Criterio1, :Criterio2";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_depen_quien_firma', $this->IdDepen, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_oficina_quien_firma', $this->IdOfi, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_depen_respon', $this->IdDepen, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_oficina_respon', $this->IdOfi, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_depen_proyec', $this->IdDepen, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_oficina_proyec', $this->IdOfi, PDO::PARAM_INT);
                $Instruc -> bindParam(":Criterio1", $this->Criterio1, PDO::PARAM_INT);
                $Instruc -> bindParam(":Criterio2", $this->Criterio2, PDO::PARAM_INT);
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

    public function TotalRegistros_Listar(){
        $conexion = new Conexion();

        try{
            if($this->Accion == 1){
                /******************************************************************************************/
                /*  LISTO TODA LA CORRESPONDENCIA TEMPORAL DE LA INSTITUCION
                /******************************************************************************************/
               $Sql = "SELECT 'Por Firmar' AS 'Pendiente', `temp`.`id_temp`, `temp`.`fechor_registro`, `temp`.`id_ruta`, `temp`.`asunto`,
                            `usua_regis`.`nom_funcio`, `usua_regis`.`ape_funcio`, `usua_regis_depen`.`id_depen`, `usua_regis_depen`.`nom_depen`,
                            `usua_regis_ofi`.`nom_oficina`, `temp`.`genera_plantilla`, `temp`.`plantilla_cargada`, `temp`.`nom_archivo`,
                            `quien_firma`.`firmado` AS 'estado_gestion', `quien_firma`.`descargo_plantilla`, `quien_firma`.`subio_plantilla`,
                            `temp`.`radicado`, `temp`.`terminado`
                        FROM `archivo_radica_enviados_temp_quienes_firman` AS `quien_firma`
                            INNER JOIN `archivo_radica_enviados_temp` AS `temp` ON (`quien_firma`.`id_temp` = `temp`.`id_temp`)
                            INNER JOIN `gene_funcionarios_deta` AS `usua_regis_deta` ON (`temp`.`id_usua_regis` = `usua_regis_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `usua_regis` ON (`usua_regis_deta`.`id_funcio` = `usua_regis`.`id_funcio`)
                            INNER JOIN `areas_cargos` AS `usua_cargo_depen` ON (`usua_regis_deta`.`id_cargo` = `usua_cargo_depen`.`id_cargo`)
                            INNER JOIN `areas_oficinas` AS `usua_regis_ofi` ON (`usua_regis_deta`.`id_oficina` = `usua_regis_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `usua_regis_depen` ON (`usua_cargo_depen`.`id_depen` = `usua_regis_depen`.`id_depen`)
                        WHERE (`temp`.`radicado` = 0 AND `temp`.`anulado` = 0)
                        UNION
                        SELECT 'Por Aprobar' AS 'Pendiente', `temp`.`id_temp`, `temp`.`fechor_registro`, `temp`.`id_ruta`, `temp`.`asunto`,
                            `usua_regis`.`nom_funcio`, `usua_regis`.`ape_funcio`, `usua_regis_depen`.`id_depen`, `usua_regis_depen`.`nom_depen`,
                            `usua_regis_ofi`.`nom_oficina`, `temp`.`genera_plantilla`, `temp`.`plantilla_cargada`, `temp`.`nom_archivo`,
                            `respon`.`aprobado` AS 'estado_gestion', `respon`.`descargo_plantilla`, `respon`.`subio_plantilla`, `temp`.`radicado`,
                            `temp`.`terminado`
                        FROM `archivo_radica_enviados_temp` AS `temp`
                            INNER JOIN `gene_funcionarios_deta` AS `usua_regis_deta` ON (`temp`.`id_usua_regis` = `usua_regis_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `usua_regis` ON (`usua_regis_deta`.`id_funcio` = `usua_regis`.`id_funcio`)
                            INNER JOIN `areas_cargos` AS `usua_cargo_depen` ON (`usua_regis_deta`.`id_cargo` = `usua_cargo_depen`.`id_cargo`)
                            INNER JOIN `areas_oficinas` AS `usua_regis_ofi` ON (`usua_regis_deta`.`id_oficina` = `usua_regis_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `usua_regis_depen` ON (`usua_cargo_depen`.`id_depen` = `usua_regis_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_enviados_temp_responsa` AS `respon`  ON (`respon`.`id_temp` = `temp`.`id_temp`)
                        WHERE (`temp`.`radicado` = 0 AND `temp`.`anulado` = 0)
                        UNION
                        SELECT 'Por Proyectar' AS 'Pendiente', `temp`.`id_temp`, `temp`.`fechor_registro`, `temp`.`id_ruta`, `temp`.`asunto`,
                            `usua_regis`.`nom_funcio`, `usua_regis`.`ape_funcio`, `usua_regis_depen`.`id_depen`, `usua_regis_depen`.`nom_depen`,
                            `usua_regis_ofi`.`nom_oficina`, `temp`.`genera_plantilla`, `temp`.`plantilla_cargada`, `temp`.`nom_archivo`,
                            `temp_proyec`.`terminado` AS 'estado_gestion', `temp_proyec`.`descargo_plantilla`, `temp_proyec`.`subio_plantilla`,
                            `temp`.`radicado`, `temp`.`terminado`
                        FROM `archivo_radica_enviados_temp` AS `temp`
                            INNER JOIN `gene_funcionarios_deta` AS `usua_regis_deta` ON (`temp`.`id_usua_regis` = `usua_regis_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `usua_regis` ON (`usua_regis_deta`.`id_funcio` = `usua_regis`.`id_funcio`)
                            INNER JOIN `areas_cargos` AS `usua_cargo_depen` ON (`usua_regis_deta`.`id_cargo` = `usua_cargo_depen`.`id_cargo`)
                            INNER JOIN `areas_oficinas` AS `usua_regis_ofi` ON (`usua_regis_deta`.`id_oficina` = `usua_regis_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `usua_regis_depen` ON (`usua_cargo_depen`.`id_depen` = `usua_regis_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_enviados_temp_proyector` AS `temp_proyec` ON (`temp_proyec`.`id_temp` = `temp`.`id_temp`)
                        WHERE (`temp`.`radicado` = 0 AND `temp`.`anulado` = 0)";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($this->Accion == 2){
                /******************************************************************************************/
                /*  LISTO LA CORRESPONDENCIA TEMPORAL DE UN FUNCIONARIO
                /******************************************************************************************/
                $Sql = "SELECT 'Por Firmar' AS 'Pendiente', `temp`.`id_temp`, `temp`.`fechor_registro`, `temp`.`id_ruta`, `temp`.`asunto`,
                            `usua_regis`.`nom_funcio`, `usua_regis`.`ape_funcio`, `usua_regis_depen`.`id_depen`, `usua_regis_depen`.`nom_depen`,
                            `usua_regis_ofi`.`nom_oficina`, `temp`.`genera_plantilla`, `temp`.`plantilla_cargada`, `temp`.`nom_archivo`,
                            `quien_firma`.`firmado` AS 'estado_gestion', `quien_firma`.`descargo_plantilla`, `quien_firma`.`subio_plantilla`,
                            `temp`.`radicado`, `temp`.`terminado`
                        FROM `archivo_radica_enviados_temp_quienes_firman` AS `quien_firma`
                            INNER JOIN `archivo_radica_enviados_temp` AS `temp` ON (`quien_firma`.`id_temp` = `temp`.`id_temp`)
                            INNER JOIN `gene_funcionarios_deta` AS `usua_regis_deta` ON (`temp`.`id_usua_regis` = `usua_regis_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `usua_regis` ON (`usua_regis_deta`.`id_funcio` = `usua_regis`.`id_funcio`)
                            INNER JOIN `areas_cargos` AS `usua_cargo_depen` ON (`usua_regis_deta`.`id_cargo` = `usua_cargo_depen`.`id_cargo`)
                            INNER JOIN `areas_oficinas` AS `usua_regis_ofi` ON (`usua_regis_deta`.`id_oficina` = `usua_regis_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `usua_regis_depen` ON (`usua_cargo_depen`.`id_depen` = `usua_regis_depen`.`id_depen`)
                        WHERE (`temp`.`anulado` = 0 AND `temp`.`radicado` = 0 AND `quien_firma`.`id_funcio_deta` = :id_funcio_quien_firma)
                        UNION
                        SELECT 'Por Aprobar' AS 'Pendiente', `temp`.`id_temp`, `temp`.`fechor_registro`, `temp`.`id_ruta`, `temp`.`asunto`,
                            `usua_regis`.`nom_funcio`, `usua_regis`.`ape_funcio`, `usua_regis_depen`.`id_depen`, `usua_regis_depen`.`nom_depen`,
                            `usua_regis_ofi`.`nom_oficina`, `temp`.`genera_plantilla`, `temp`.`plantilla_cargada`, `temp`.`nom_archivo`,
                            `respon`.`aprobado` AS 'estado_gestion', `respon`.`descargo_plantilla`, `respon`.`subio_plantilla`, `temp`.`radicado`,
                            `temp`.`terminado`
                        FROM `archivo_radica_enviados_temp` AS `temp`
                            INNER JOIN `gene_funcionarios_deta` AS `usua_regis_deta` ON (`temp`.`id_usua_regis` = `usua_regis_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `usua_regis` ON (`usua_regis_deta`.`id_funcio` = `usua_regis`.`id_funcio`)
                            INNER JOIN `areas_cargos` AS `usua_cargo_depen` ON (`usua_regis_deta`.`id_cargo` = `usua_cargo_depen`.`id_cargo`)
                            INNER JOIN `areas_oficinas` AS `usua_regis_ofi` ON (`usua_regis_deta`.`id_oficina` = `usua_regis_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `usua_regis_depen` ON (`usua_cargo_depen`.`id_depen` = `usua_regis_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_enviados_temp_responsa` AS `respon`  ON (`respon`.`id_temp` = `temp`.`id_temp`)
                        WHERE (`temp`.`anulado` = 0 AND `temp`.`radicado` = 0 AND `respon`.`id_funcio_deta` = :id_funcio_deta_respon)
                        UNION
                        SELECT 'Por Proyectar' AS 'Pendiente', `temp`.`id_temp`, `temp`.`fechor_registro`, `temp`.`id_ruta`, `temp`.`asunto`,
                            `usua_regis`.`nom_funcio`, `usua_regis`.`ape_funcio`, `usua_regis_depen`.`id_depen`, `usua_regis_depen`.`nom_depen`,
                            `usua_regis_ofi`.`nom_oficina`, `temp`.`genera_plantilla`, `temp`.`plantilla_cargada`, `temp`.`nom_archivo`,
                            `temp_proyec`.`terminado` AS 'estado_gestion', `temp_proyec`.`descargo_plantilla`, `temp_proyec`.`subio_plantilla`,
                            `temp`.`radicado`, `temp`.`terminado`
                        FROM `archivo_radica_enviados_temp` AS `temp`
                            INNER JOIN `gene_funcionarios_deta` AS `usua_regis_deta` ON (`temp`.`id_usua_regis` = `usua_regis_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `usua_regis` ON (`usua_regis_deta`.`id_funcio` = `usua_regis`.`id_funcio`)
                            INNER JOIN `areas_cargos` AS `usua_cargo_depen` ON (`usua_regis_deta`.`id_cargo` = `usua_cargo_depen`.`id_cargo`)
                            INNER JOIN `areas_oficinas` AS `usua_regis_ofi` ON (`usua_regis_deta`.`id_oficina` = `usua_regis_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `usua_regis_depen` ON (`usua_cargo_depen`.`id_depen` = `usua_regis_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_enviados_temp_proyector` AS `temp_proyec` ON (`temp_proyec`.`id_temp` = `temp`.`id_temp`)
                        WHERE (`temp`.`anulado` = 0 AND `temp`.`radicado` = 0 AND `temp_proyec`.`id_funcio_deta` = :id_funcio_deta_proyec)
                        ORDER BY `id_temp`";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_funcio_quien_firma', $this->IdFuncioDeta, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_funcio_deta_respon', $this->IdFuncioDeta, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_funcio_deta_proyec', $this->IdFuncioDeta, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($this->Accion == 3){
                /******************************************************************************************/
                /*  LISTO LA CORRESPONDENCIA TEMPORAL DE UN FUNCIONARIO JEFE DE DEPENDENCIA
                /******************************************************************************************/
                $Sql = "SELECT 'Por Firmar' AS 'Pendiente', `temp`.`id_temp`, `temp`.`fechor_registro`, `temp`.`id_ruta`, `temp`.`asunto`,
                            `usua_regis`.`nom_funcio`, `usua_regis`.`ape_funcio`, `usua_regis_depen`.`id_depen`, `usua_regis_depen`.`nom_depen`,
                            `usua_regis_ofi`.`nom_oficina`, `temp`.`genera_plantilla`, `temp`.`plantilla_cargada`, `temp`.`nom_archivo`,
                            `temp_quien_firma`.`firmando` AS 'estado_gestion', `temp_quien_firma`.`descargo_plantilla`,
                            `temp_quien_firma`.`subio_plantilla`, `temp`.`radicado`, `temp`.`terminado`, `quien_firma_cargo`.`id_depen`
                        FROM `archivo_radica_enviados_temp_quienes_firman` AS `temp_quien_firma`
                            INNER JOIN `archivo_radica_enviados_temp` AS `temp` ON (`temp_quien_firma`.`id_temp` = `temp`.`id_temp`)
                            INNER JOIN `gene_funcionarios_deta` AS `usua_regis_deta` ON (`temp`.`id_usua_regis` = `usua_regis_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios_deta` AS `quien_firma_deta` ON (`temp_quien_firma`.`id_funcio_deta` = `quien_firma_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `usua_regis` ON (`usua_regis_deta`.`id_funcio` = `usua_regis`.`id_funcio`)
                            INNER JOIN `areas_cargos` AS `usua_cargo_depen` ON (`usua_regis_deta`.`id_cargo` = `usua_cargo_depen`.`id_cargo`)
                            INNER JOIN `areas_oficinas` AS `usua_regis_ofi` ON (`usua_regis_deta`.`id_oficina` = `usua_regis_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `usua_regis_depen` ON (`usua_cargo_depen`.`id_depen` = `usua_regis_depen`.`id_depen`)
                            INNER JOIN `areas_cargos` AS `quien_firma_cargo` ON (`quien_firma_deta`.`id_cargo` = `quien_firma_cargo`.`id_cargo`)
                        WHERE (`temp`.`anulado` = 0 AND `temp`.`radicado` = 0 AND `quien_firma_cargo`.`id_depen` = :id_depen_quien_firma)
                        UNION
                        SELECT 'Por Aprobar' AS 'Pendiente', `temp`.`id_temp`, `temp`.`fechor_registro`, `temp`.`id_ruta`, `temp`.`asunto`,
                            `usua_regis`.`nom_funcio`, `usua_regis`.`ape_funcio`, `usua_regis_depen`.`id_depen`, `usua_regis_depen`.`nom_depen`,
                            `usua_regis_ofi`.`nom_oficina`, `temp`.`genera_plantilla`, `temp`.`plantilla_cargada`, `temp`.`nom_archivo`,
                            `tempo_respon`.`aprobado` AS 'estado_gestion', `tempo_respon`.`descargo_plantilla`, `tempo_respon`.`subio_plantilla`,
                            `temp`.`radicado`, `temp`.`terminado`, `respon_cargo`.`id_depen`
                        FROM `archivo_radica_enviados_temp` AS `temp`
                            INNER JOIN `gene_funcionarios_deta` AS `usua_regis_deta` ON (`temp`.`id_usua_regis` = `usua_regis_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `usua_regis` ON (`usua_regis_deta`.`id_funcio` = `usua_regis`.`id_funcio`)
                            INNER JOIN `areas_cargos` AS `usua_cargo_depen` ON (`usua_regis_deta`.`id_cargo` = `usua_cargo_depen`.`id_cargo`)
                            INNER JOIN `areas_oficinas` AS `usua_regis_ofi` ON (`usua_regis_deta`.`id_oficina` = `usua_regis_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `usua_regis_depen` ON (`usua_cargo_depen`.`id_depen` = `usua_regis_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_enviados_temp_responsa` AS `tempo_respon` ON (`tempo_respon`.`id_temp` = `temp`.`id_temp`)
                            INNER JOIN `gene_funcionarios_deta` AS `respon_deta` ON (`tempo_respon`.`id_funcio_deta` = `respon_deta`.`id_funcio_deta`)
                            INNER JOIN `areas_cargos` AS `respon_cargo` ON (`respon_deta`.`id_cargo` = `respon_cargo`.`id_cargo`)
                        WHERE (`temp`.`anulado` = 0 AND `temp`.`radicado` = 0 AND `respon_cargo`.`id_depen` = :id_depen_respon)
                        UNION
                        SELECT 'Por Proyectar' AS 'Pendiente', `temp`.`id_temp`, `temp`.`fechor_registro`, `temp`.`id_ruta`, `temp`.`asunto`,
                            `usua_regis`.`nom_funcio`, `usua_regis`.`ape_funcio`, `usua_regis_depen`.`id_depen`, `usua_regis_depen`.`nom_depen`,
                            `usua_regis_ofi`.`id_depen`, `usua_regis_ofi`.`nom_oficina`, `temp`.`genera_plantilla`, `temp`.`plantilla_cargada`,
                            `temp`.`nom_archivo`, `temp_proyec`.`terminado` AS 'estado_gestion', `temp_proyec`.`descargo_plantilla`,
                            `temp_proyec`.`subio_plantilla`, `temp`.`radicado`, `temp`.`terminado`, `proyec_cargo`.`id_depen`
                        FROM `archivo_radica_enviados_temp` AS `temp`
                            INNER JOIN `gene_funcionarios_deta` AS `usua_regis_deta` ON (`temp`.`id_usua_regis` = `usua_regis_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `usua_regis` ON (`usua_regis_deta`.`id_funcio` = `usua_regis`.`id_funcio`)
                            INNER JOIN `areas_cargos` AS `usua_cargo_depen` ON (`usua_regis_deta`.`id_cargo` = `usua_cargo_depen`.`id_cargo`)
                            INNER JOIN `areas_oficinas` AS `usua_regis_ofi` ON (`usua_regis_deta`.`id_oficina` = `usua_regis_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `usua_regis_depen` ON (`usua_cargo_depen`.`id_depen` = `usua_regis_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_enviados_temp_proyector` AS `temp_proyec` ON (`temp_proyec`.`id_temp` = `temp`.`id_temp`)
                            INNER JOIN `gene_funcionarios_deta` AS `proyec_deta` ON (`temp_proyec`.`id_funcio_deta` = `proyec_deta`.`id_funcio_deta`)
                            INNER JOIN `areas_cargos` AS `proyec_cargo` ON (`proyec_deta`.`id_cargo` = `proyec_cargo`.`id_cargo`)
                        WHERE (`temp`.`anulado` = 0 AND `temp`.`radicado` = 0 AND `proyec_cargo`.`id_depen` = :id_depen_proyec)
                        ORDER BY `id_temp`";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_depen_quien_firma', $this->IdDepen, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_depen_respon', $this->IdDepen, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_depen_proyec', $this->IdDepen, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($this->Accion == 4){
                /******************************************************************************************/
                /*  LISTO LA CORRESPONDENCIA EXTERNA DE UN FUNCIONARIO JEFE DE OFICINA
                /******************************************************************************************/
                $Sql = "SELECT 'Por Firmar' AS 'Pendiente', `temp`.`id_temp`, `temp`.`fechor_registro`, `temp`.`id_ruta`, `temp`.`asunto`,
                            `usua_regis`.`nom_funcio`, `usua_regis`.`ape_funcio`, `usua_regis_depen`.`id_depen`, `usua_regis_depen`.`nom_depen`,
                            `usua_regis_ofi`.`nom_oficina`, `temp`.`genera_plantilla`, `temp`.`plantilla_cargada`, `temp`.`nom_archivo`,
                            `temp_quien_firma`.`firmando` AS 'estado_gestion', `temp_quien_firma`.`descargo_plantilla`,
                            `temp_quien_firma`.`subio_plantilla`, `temp`.`radicado`, `temp`.`terminado`, `quien_firma_cargo`.`id_depen`
                        FROM `archivo_radica_enviados_temp_quienes_firman` AS `temp_quien_firma`
                            INNER JOIN `archivo_radica_enviados_temp` AS `temp` ON (`temp_quien_firma`.`id_temp` = `temp`.`id_temp`)
                            INNER JOIN `gene_funcionarios_deta` AS `usua_regis_deta` ON (`temp`.`id_usua_regis` = `usua_regis_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios_deta` AS `quien_firma_deta` ON (`temp_quien_firma`.`id_funcio_deta` = `quien_firma_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `usua_regis` ON (`usua_regis_deta`.`id_funcio` = `usua_regis`.`id_funcio`)
                            INNER JOIN `areas_cargos` AS `usua_cargo_depen` ON (`usua_regis_deta`.`id_cargo` = `usua_cargo_depen`.`id_cargo`)
                            INNER JOIN `areas_oficinas` AS `usua_regis_ofi` ON (`usua_regis_deta`.`id_oficina` = `usua_regis_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `usua_regis_depen` ON (`usua_cargo_depen`.`id_depen` = `usua_regis_depen`.`id_depen`)
                            INNER JOIN `areas_cargos` AS `quien_firma_cargo` ON (`quien_firma_deta`.`id_cargo` = `quien_firma_cargo`.`id_cargo`)
                        WHERE (`temp`.`anulado` = 0 AND `temp`.`radicado` = 0 AND `quien_firma_cargo`.`id_depen` = :id_depen_quien_firma
                            AND `temp_quien_firma`.`id_oficina` = :id_oficina_quien_firma)
                        UNION
                        SELECT 'Por Aprobar' AS 'Pendiente', `temp`.`id_temp`, `temp`.`fechor_registro`, `temp`.`id_ruta`, `temp`.`asunto`,
                            `usua_regis`.`nom_funcio`, `usua_regis`.`ape_funcio`, `usua_regis_depen`.`id_depen`, `usua_regis_depen`.`nom_depen`,
                            `usua_regis_ofi`.`nom_oficina`, `temp`.`genera_plantilla`, `temp`.`plantilla_cargada`, `temp`.`nom_archivo`,
                            `tempo_respon`.`aprobado` AS 'estado_gestion', `tempo_respon`.`descargo_plantilla`, `tempo_respon`.`subio_plantilla`,
                            `temp`.`radicado`, `temp`.`terminado`, `respon_cargo`.`id_depen`
                        FROM `archivo_radica_enviados_temp` AS `temp`
                            INNER JOIN `gene_funcionarios_deta` AS `usua_regis_deta` ON (`temp`.`id_usua_regis` = `usua_regis_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `usua_regis` ON (`usua_regis_deta`.`id_funcio` = `usua_regis`.`id_funcio`)
                            INNER JOIN `areas_cargos` AS `usua_cargo_depen` ON (`usua_regis_deta`.`id_cargo` = `usua_cargo_depen`.`id_cargo`)
                            INNER JOIN `areas_oficinas` AS `usua_regis_ofi` ON (`usua_regis_deta`.`id_oficina` = `usua_regis_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `usua_regis_depen` ON (`usua_cargo_depen`.`id_depen` = `usua_regis_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_enviados_temp_responsa` AS `tempo_respon` ON (`tempo_respon`.`id_temp` = `temp`.`id_temp`)
                            INNER JOIN `gene_funcionarios_deta` AS `respon_deta` ON (`tempo_respon`.`id_funcio_deta` = `respon_deta`.`id_funcio_deta`)
                            INNER JOIN `areas_cargos` AS `respon_cargo` ON (`respon_deta`.`id_cargo` = `respon_cargo`.`id_cargo`)
                        WHERE (`temp`.`anulado` = 0 AND `temp`.`radicado` = 0 AND `respon_cargo`.`id_depen` = :id_depen_respon
                                AND `respon_deta`.`id_oficina` = :id_oficina_respon)
                        UNION
                        SELECT 'Por Proyectar' AS 'Pendiente', `temp`.`id_temp`, `temp`.`fechor_registro`, `temp`.`id_ruta`, `temp`.`asunto`, `usua_regis`.`nom_funcio`,
                            `usua_regis`.`ape_funcio`, `usua_regis_depen`.`id_depen`, `usua_regis_depen`.`nom_depen`, `usua_regis_ofi`.`id_depen`,
                            `usua_regis_ofi`.`nom_oficina`, `temp`.`genera_plantilla`, `temp`.`plantilla_cargada`, `temp`.`nom_archivo`,
                            `temp_proyec`.`terminado` AS 'estado_gestion', `temp_proyec`.`descargo_plantilla`, `temp_proyec`.`subio_plantilla`,
                            `temp`.`radicado`, `temp`.`terminado`, `proyec_cargo`.`id_depen`
                        FROM `archivo_radica_enviados_temp` AS `temp`
                            INNER JOIN `gene_funcionarios_deta` AS `usua_regis_deta` ON (`temp`.`id_usua_regis` = `usua_regis_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `usua_regis` ON (`usua_regis_deta`.`id_funcio` = `usua_regis`.`id_funcio`)
                            INNER JOIN `areas_cargos` AS `usua_cargo_depen` ON (`usua_regis_deta`.`id_cargo` = `usua_cargo_depen`.`id_cargo`)
                            INNER JOIN `areas_oficinas` AS `usua_regis_ofi` ON (`usua_regis_deta`.`id_oficina` = `usua_regis_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `usua_regis_depen` ON (`usua_cargo_depen`.`id_depen` = `usua_regis_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_enviados_temp_proyector` AS `temp_proyec` ON (`temp_proyec`.`id_temp` = `temp`.`id_temp`)
                            INNER JOIN `gene_funcionarios_deta` AS `proyec_deta` ON (`temp_proyec`.`id_funcio_deta` = `proyec_deta`.`id_funcio_deta`)
                            INNER JOIN `areas_cargos` AS `proyec_cargo` ON (`proyec_deta`.`id_cargo` = `proyec_cargo`.`id_cargo`)
                        WHERE (`temp`.`anulado` = 0 AND `temp`.`radicado` = 0 AND `proyec_cargo`.`id_depen` = :id_depen_proyec
                                AND `proyec_deta`.`id_oficina` = :id_oficina_proyec)
                        ORDER BY `id_temp`";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_depen_quien_firma', $this->IdDepen, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_oficina_quien_firma', $this->IdOfi, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_depen_respon', $this->IdDepen, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_oficina_respon', $this->IdOfi, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_depen_proyec', $this->IdDepen, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_oficina_proyec', $this->IdOfi, PDO::PARAM_INT);
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
}
?>