<?php
class RadicadoEnviadoListarBandeja
{
    private $Accion;
    private $IdFuncioSesion;
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

    public function __construct(
        $Accion = null,
        $IdFuncioSesion = null,
        $Buscar = null,
        $IdRadica = null,
        $IdFuncioDeta = null,
        $IdTercero = null,
        $Asunto = null,
        $QueContenga = null,
        $IdDepen = null,
        $IdOfi = null,
        $Limite1 = null,
        $Limite2 = null,
        $Criterio1 = null
    ) {

        $this->Accion         = $Accion;
        $this->IdFuncioSesion = $IdFuncioSesion;
        $this->Buscar         = $Buscar;
        $this->IdRadica       = $IdRadica;
        $this->IdTercero      = $IdTercero;
        $this->IdFuncioDeta   = $IdFuncioDeta;
        $this->Asunto         = $Asunto;
        $this->QueContenga    = $QueContenga;
        $this->IdDepen        = $IdDepen;
        $this->IdOfi          = $IdOfi;
        $this->Limite1        = $Limite1;
        $this->Limite2        = $Limite2;
        $this->Criterio1      = $Criterio1;
    }

    public function get_Accion()
    {
        return $this->Accion;
    }

    public function get_IdFuncioSesion()
    {
        return $this->IdFuncioSesion;
    }

    public function get_Buscar()
    {
        return $this->Buscar;
    }

    public function get_IdRadica()
    {
        return $this->IdRadica;
    }

    public function get_IdTercero()
    {
        return $this->IdTercero;
    }

    public function get_IdFuncioDeta()
    {
        return $this->IdFuncioDeta;
    }

    public function get_Asunto()
    {
        return $this->Asunto;
    }

    public function get_QueContenga()
    {
        return $this->QueContenga;
    }

    public function get_IdDepen()
    {
        return $this->IdDepen;
    }

    public function get_IdOfi()
    {
        return $this->IdOfi;
    }

    public function get_Limite1()
    {
        return $this->Limite1;
    }

    public function get_Limite2()
    {
        return $this->Limite2;
    }

    public function set_Accion($Accion)
    {
        $this->Accion = $Accion;
    }

    public function set_IdFuncioSesion($IdFuncioSesion)
    {
        $this->IdFuncioSesion = $IdFuncioSesion;
    }

    public function set_Buscar($Buscar)
    {
        $this->Buscar = $Buscar;
    }

    public function set_IdRadica($IdRadica)
    {
        $this->IdRadica = $IdRadica;
    }

    public function set_IdTercero($IdTercero)
    {
        $this->IdTercero = $IdTercero;
    }

    public function set_IdFuncioDeta($IdFuncioDeta)
    {
        $this->IdFuncioDeta = $IdFuncioDeta;
    }

    public function set_Asunto($Asunto)
    {
        $this->Asunto = $Asunto;
    }

    public function set_QueContenga($QueContenga)
    {
        $this->QueContenga = $QueContenga;
    }

    public function set_IdDepen($IdDepen)
    {
        $this->IdDepen = $IdDepen;
    }

    public function set_IdOfi($IdOfi)
    {
        $this->IdOfi = $IdOfi;
    }

    public function set_Limite1($Limite1)
    {
        $this->Limite1 = $Limite1;
    }

    public function set_Limite2($Limite2)
    {
        $this->Limite2 = $Limite2;
    }

    public function Listar()
    {
        $conexion = new Conexion();

        try {
            if ($this->Accion == 1) {
                /******************************************************************************************/
                /*  LISTO TODA LA CORRESPONDENCIA ENVIDA DE LA INSTITUCION
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`, `radi`.`asunto`, `radi`.`fec_docu`, `radi`.`fechor_radica`, `radi`.`digital`, `radi`.`id_ruta`, `radi`.`impri_rotu`,
                            `fun`.`nom_funcio`, `fun`.`ape_funcio`, `areas_dependencias`.`id_depen`, `areas_dependencias`.`nom_depen`,
                            `areas_oficinas`.`nom_oficina`, `terce_contac`.`nom_contac`, `terce_empre`.`razo_soci`, `funcio_radi`.`nom_funcio` AS `nom_funcio_radi`,
                            `funcio_radi`.`ape_funcio` AS `ape_funcio_radi`, `config_formaenvio`.`id_formaenvio`, `config_formaenvio`.`nom_formaenvi`,
                            `config_formaenvio`.`requie_digital`, `radi`.`impri_rotu`
                        FROM `archivo_radica_enviados_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_enviados` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_destina` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radi` ON (`radi`.`id_usua_regis` = `usua_radi`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio_deta` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `fun` ON (`funcio_deta`.`id_funcio` = `fun`.`id_funcio`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radi` ON (`usua_radi`.`id_funcio` = `funcio_radi`.`id_funcio`)
                            INNER JOIN `areas_oficinas` ON (`funcio_deta`.`id_oficina` = `areas_oficinas`.`id_oficina`)
                            INNER JOIN `areas_dependencias` ON (`areas_oficinas`.`id_depen` = `areas_dependencias`.`id_depen`)
                            INNER JOIN `config_formaenvio` ON (`radi`.`id_formaenvio` = `config_formaenvio`.`id_formaenvio`)
                        ORDER BY `radi`.`fechor_radica` DESC
                        LIMIT :Limite1, :Limite2";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":Limite1", $this->Limite1, PDO::PARAM_INT);
                $Instruc->bindParam(":Limite2", $this->Limite2, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($this->Accion == 2) {
                /******************************************************************************************/
                /*  LISTO LOS RADICADOS ENVIADOS DE UN FUNCIONARIO
                /******************************************************************************************/
                $Sql = "SELECT 'Firma' AS 'tipo_radicado', `radi`.`id_radica`, `radi`.`asunto`, `radi`.`fec_docu`, `radi`.`fechor_radica`, `radi`.`digital`,
                            `radi`.`impri_rotu`, `fun`.`nom_funcio`, `fun`.`ape_funcio`, `areas_dependencias`.`id_depen`, `areas_dependencias`.`nom_depen`,
                            `areas_oficinas`.`nom_oficina`, `terce_contac`.`nom_contac`, `terce_empre`.`razo_soci`, `funcio_radi`.`nom_funcio` AS `nom_funcio_radi`,
                            `funcio_radi`.`ape_funcio` AS `ape_funcio_radi`, `config_formaenvio`.`id_formaenvio`, `config_formaenvio`.`nom_formaenvi`,
                            `config_formaenvio`.`requie_digital`, `radi`.`impri_rotu`
                        FROM `archivo_radica_enviados_quienes_firman` AS `ra_firma`
                            INNER JOIN `archivo_radica_enviados` AS `radi` ON (`ra_firma`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_destina` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radi` ON (`radi`.`id_usua_regis` = `usua_radi`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_firma`.`id_funcio_deta` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `fun` ON (`funcio_deta`.`id_funcio` = `fun`.`id_funcio`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radi` ON (`usua_radi`.`id_funcio` = `funcio_radi`.`id_funcio`)
                            INNER JOIN `areas_oficinas` ON (`funcio_deta`.`id_oficina` = `areas_oficinas`.`id_oficina`)
                            INNER JOIN `areas_dependencias` ON (`areas_oficinas`.`id_depen` = `areas_dependencias`.`id_depen`)
                            INNER JOIN `config_formaenvio` ON (`radi`.`id_formaenvio` = `config_formaenvio`.`id_formaenvio`)
                        WHERE (`ra_firma`.`firma_principal` = 1 AND `radi`.`trasnferido` = 0 AND `ra_firma`.`id_funcio_deta` = :id_funcio_deta_firma)
                        UNION
                        SELECT 'Responsable' as 'tipo_radicado', `radi`.`id_radica`, `radi`.`asunto`, `radi`.`fec_docu`, `radi`.`fechor_radica`, `radi`.`digital`,
                            `radi`.`impri_rotu`, `fun`.`nom_funcio`, `fun`.`ape_funcio`, `areas_dependencias`.`id_depen`, `areas_dependencias`.`nom_depen`,
                            `areas_oficinas`.`nom_oficina`, `terce_contac`.`nom_contac`, `terce_empre`.`razo_soci`, `funcio_radi`.`nom_funcio` AS `nom_funcio_radi`,
                            `funcio_radi`.`ape_funcio` AS `ape_funcio_radi`, `config_formaenvio`.`id_formaenvio`, `config_formaenvio`.`nom_formaenvi`,
                            `config_formaenvio`.`requie_digital`, `radi`.`impri_rotu`
                        FROM `archivo_radica_enviados_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_enviados` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_destina` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radi` ON (`radi`.`id_usua_regis` = `usua_radi`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio_deta` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `fun` ON (`funcio_deta`.`id_funcio` = `fun`.`id_funcio`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radi` ON (`usua_radi`.`id_funcio` = `funcio_radi`.`id_funcio`)
                            INNER JOIN `areas_oficinas` ON (`funcio_deta`.`id_oficina` = `areas_oficinas`.`id_oficina`)
                            INNER JOIN `areas_dependencias` ON (`areas_oficinas`.`id_depen` = `areas_dependencias`.`id_depen`)
                            INNER JOIN `config_formaenvio` ON (`radi`.`id_formaenvio` = `config_formaenvio`.`id_formaenvio`)
                        WHERE (`ra_respon`.`respon` = 1 AND `radi`.`trasnferido` = 0 AND `ra_respon`.`id_funcio_deta` = :id_funcio_deta_respon)
                        ORDER BY `fechor_radica` DESC
                        LIMIT :Limite1, :Limite2";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":id_funcio_deta_firma", $this->IdFuncioSesion, PDO::PARAM_INT);
                $Instruc->bindParam(":id_funcio_deta_respon", $this->IdFuncioSesion, PDO::PARAM_INT);
                $Instruc->bindParam(":Limite1", $this->Limite1, PDO::PARAM_INT);
                $Instruc->bindParam(":Limite2", $this->Limite2, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($this->Accion == 3) {
                /******************************************************************************************/
                /*  LISTO LA CORRESPONDENCIA RECIBIDA DE UN FUNCIONARIO JEFE DE UNA DEPENDENCIA
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`, `radi`.`asunto`, `radi`.`fec_docu`, `radi`.`fechor_radica`, `radi`.`digital`, `radi`.`impri_rotu`,
                            `fun`.`nom_funcio`, `fun`.`ape_funcio`, `areas_dependencias`.`id_depen`, `areas_dependencias`.`nom_depen`,
                            `areas_oficinas`.`nom_oficina`, `terce_contac`.`nom_contac`, `terce_empre`.`razo_soci`, `funcio_radi`.`nom_funcio` AS `nom_funcio_radi`,
                            `funcio_radi`.`ape_funcio` AS `ape_funcio_radi`, `config_formaenvio`.`id_formaenvio`, `config_formaenvio`.`nom_formaenvi`,
                            `config_formaenvio`.`requie_digital`, `radi`.`impri_rotu`
                        FROM `archivo_radica_enviados_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_enviados` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_destina` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radi` ON (`radi`.`id_usua_regis` = `usua_radi`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio_deta` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `fun` ON (`funcio_deta`.`id_funcio` = `fun`.`id_funcio`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radi` ON (`usua_radi`.`id_funcio` = `funcio_radi`.`id_funcio`)
                            INNER JOIN `areas_oficinas` ON (`funcio_deta`.`id_oficina` = `areas_oficinas`.`id_oficina`)
                            INNER JOIN `areas_dependencias` ON (`areas_oficinas`.`id_depen` = `areas_dependencias`.`id_depen`)
                            INNER JOIN `config_formaenvio` ON (`radi`.`id_formaenvio` = `config_formaenvio`.`id_formaenvio`)
                            LEFT JOIN `gene_terceros_empresas` AS `desti_empre` ON (`desti`.`id_empre` = `desti_empre`.`id_empre`)
                        WHERE `ra_respon`.`respon` = 1 AND `radi`.`trasnferido` = 0 AND `ofi`.`id_depen` = :id_depen
                        ORDER BY `radi`.`id_radica` DESC
                        LIMIT :Limite1, :Limite2";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":id_depen", $IdDepen, PDO::PARAM_INT);
                $Instruc->bindParam(":Limite1", $this->Limite1, PDO::PARAM_INT);
                $Instruc->bindParam(":Limite2", $this->Limite2, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($this->Accion == 4) {
                /******************************************************************************************/
                /*  LISTO LOS RADICADOS ENVIADOS DE UN JEFE DE OFICINA
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`, `radi`.`asunto`, `radi`.`fec_docu`, `radi`.`fechor_radica`, `radi`.`digital`, `radi`.`impri_rotu`,
                            `fun`.`nom_funcio`, `fun`.`ape_funcio`, `areas_dependencias`.`id_depen`, `areas_dependencias`.`nom_depen`,
                            `areas_oficinas`.`nom_oficina`, `terce_contac`.`nom_contac`, `terce_empre`.`razo_soci`, `funcio_radi`.`nom_funcio` AS `nom_funcio_radi`,
                            `funcio_radi`.`ape_funcio` AS `ape_funcio_radi`, `config_formaenvio`.`id_formaenvio`, `config_formaenvio`.`nom_formaenvi`,
                            `config_formaenvio`.`requie_digital`, `radi`.`impri_rotu`
                        FROM `archivo_radica_enviados_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_enviados` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_destina` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radi` ON (`radi`.`id_usua_regis` = `usua_radi`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio_deta` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `fun` ON (`funcio_deta`.`id_funcio` = `fun`.`id_funcio`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radi` ON (`usua_radi`.`id_funcio` = `funcio_radi`.`id_funcio`)
                            INNER JOIN `areas_oficinas` ON (`funcio_deta`.`id_oficina` = `areas_oficinas`.`id_oficina`)
                            INNER JOIN `areas_dependencias` ON (`areas_oficinas`.`id_depen` = `areas_dependencias`.`id_depen`)
                            INNER JOIN `config_formaenvio` ON (`radi`.`id_formaenvio` = `config_formaenvio`.`id_formaenvio`)
                        WHERE `respon`.`respon` = 1 AND `radi`.`trasnferido` = 0 AND `depen`.`id_depen` = :id_depen AND `funcio_deta`.`id_oficina` = :id_oficina
                        ORDER BY `radi`.`id_radica` DESC
                        LIMIT :Limite1, :Limite2";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":id_depen", $this->IdDepen, PDO::PARAM_INT);
                $Instruc->bindParam(":id_oficina", $IdOfi, PDO::PARAM_INT);
                $Instruc->bindParam(":Limite1", $this->Limite1, PDO::PARAM_INT);
                $Instruc->bindParam(":Limite2", $this->Limite2, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            }

            $Result = $Instruc->fetchAll();
            $conexion = null;
            return $Result;
        } catch (PDOException $e) {
            echo 'Ha surgido un error y no se puede ejecutar la consulta, Correspondencia enviada -> Listar Bandeja, Accion: .' . $this->Accion . " - " . $e->getMessage();
            exit;
        }
    }

    public function TotalRegistros_Listar()
    {
        $conexion = new Conexion();

        try {
            if ($this->Accion == 1) {
                $Sql = "SELECT `radi`.`id_radica`
                        FROM `archivo_radica_enviados_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_enviados` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_destina` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radi` ON (`radi`.`id_usua_regis` = `usua_radi`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio_deta` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `fun` ON (`funcio_deta`.`id_funcio` = `fun`.`id_funcio`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radi` ON (`usua_radi`.`id_funcio` = `funcio_radi`.`id_funcio`)
                            INNER JOIN `areas_oficinas` ON (`funcio_deta`.`id_oficina` = `areas_oficinas`.`id_oficina`)
                            INNER JOIN `areas_dependencias` ON (`areas_oficinas`.`id_depen` = `areas_dependencias`.`id_depen`)
                            INNER JOIN `config_formaenvio` ON (`radi`.`id_formaenvio` = `config_formaenvio`.`id_formaenvio`)
                        WHERE `ra_respon`.`respon` = 1";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($this->Accion == 2) {

                /******************************************************************************************/
                /*  LISTO LOS RADICADOS ENVIADOS DE UN FUNCIONARIO
                /******************************************************************************************/
                $Sql = "SELECT 'Firma' AS 'tipo_radicado', `radi`.`id_radica`, `radi`.`asunto`, `radi`.`fec_docu`, `radi`.`fechor_radica`, `radi`.`digital`,
                            `radi`.`impri_rotu`, `fun`.`nom_funcio`, `fun`.`ape_funcio`, `areas_dependencias`.`id_depen`, `areas_dependencias`.`nom_depen`,
                            `areas_oficinas`.`nom_oficina`, `terce_contac`.`nom_contac`, `terce_empre`.`razo_soci`, `funcio_radi`.`nom_funcio` AS `nom_funcio_radi`,
                            `funcio_radi`.`ape_funcio` AS `ape_funcio_radi`, `config_formaenvio`.`id_formaenvio`, `config_formaenvio`.`nom_formaenvi`,
                            `config_formaenvio`.`requie_digital`, `radi`.`impri_rotu`
                        FROM `archivo_radica_enviados_quienes_firman` AS `ra_firma`
                            INNER JOIN `archivo_radica_enviados` AS `radi` ON (`ra_firma`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_destina` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radi` ON (`radi`.`id_usua_regis` = `usua_radi`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_firma`.`id_funcio_deta` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `fun` ON (`funcio_deta`.`id_funcio` = `fun`.`id_funcio`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radi` ON (`usua_radi`.`id_funcio` = `funcio_radi`.`id_funcio`)
                            INNER JOIN `areas_oficinas` ON (`funcio_deta`.`id_oficina` = `areas_oficinas`.`id_oficina`)
                            INNER JOIN `areas_dependencias` ON (`areas_oficinas`.`id_depen` = `areas_dependencias`.`id_depen`)
                            INNER JOIN `config_formaenvio` ON (`radi`.`id_formaenvio` = `config_formaenvio`.`id_formaenvio`)
                        WHERE (`ra_firma`.`firma_principal` = 1 AND `radi`.`trasnferido` = 0 AND `ra_firma`.`id_funcio_deta` = :id_funcio_deta_firma)
                        UNION
                        SELECT 'Responsable' as 'tipo_radicado', `radi`.`id_radica`, `radi`.`asunto`, `radi`.`fec_docu`, `radi`.`fechor_radica`, `radi`.`digital`,
                            `radi`.`impri_rotu`, `fun`.`nom_funcio`, `fun`.`ape_funcio`, `areas_dependencias`.`id_depen`, `areas_dependencias`.`nom_depen`,
                            `areas_oficinas`.`nom_oficina`, `terce_contac`.`nom_contac`, `terce_empre`.`razo_soci`, `funcio_radi`.`nom_funcio` AS `nom_funcio_radi`,
                            `funcio_radi`.`ape_funcio` AS `ape_funcio_radi`, `config_formaenvio`.`id_formaenvio`, `config_formaenvio`.`nom_formaenvi`,
                            `config_formaenvio`.`requie_digital`, `radi`.`impri_rotu`
                        FROM `archivo_radica_enviados_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_enviados` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_destina` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radi` ON (`radi`.`id_usua_regis` = `usua_radi`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio_deta` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `fun` ON (`funcio_deta`.`id_funcio` = `fun`.`id_funcio`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radi` ON (`usua_radi`.`id_funcio` = `funcio_radi`.`id_funcio`)
                            INNER JOIN `areas_oficinas` ON (`funcio_deta`.`id_oficina` = `areas_oficinas`.`id_oficina`)
                            INNER JOIN `areas_dependencias` ON (`areas_oficinas`.`id_depen` = `areas_dependencias`.`id_depen`)
                            INNER JOIN `config_formaenvio` ON (`radi`.`id_formaenvio` = `config_formaenvio`.`id_formaenvio`)
                        WHERE (`ra_respon`.`respon` = 1 AND `radi`.`trasnferido` = 0 AND `ra_respon`.`id_funcio_deta` = :id_funcio_deta_respon)";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":id_funcio_deta_firma", $this->IdFuncioSesion, PDO::PARAM_INT);
                $Instruc->bindParam(":id_funcio_deta_respon", $this->IdFuncioSesion, PDO::PARAM_INT);

                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($this->Accion == 3) {
                /******************************************************************************************/
                /*  LISTO LA CORRESPONDENCIA RECIBIDA DE UN FUNCIONARIO JEFE DE UNA DEPENDENCIA
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`
                        FROM `archivo_radica_enviados_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_enviados` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_destina` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radi` ON (`radi`.`id_usua_regis` = `usua_radi`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio_deta` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `fun` ON (`funcio_deta`.`id_funcio` = `fun`.`id_funcio`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radi` ON (`usua_radi`.`id_funcio` = `funcio_radi`.`id_funcio`)
                            INNER JOIN `areas_oficinas` ON (`funcio_deta`.`id_oficina` = `areas_oficinas`.`id_oficina`)
                            INNER JOIN `areas_dependencias` ON (`areas_oficinas`.`id_depen` = `areas_dependencias`.`id_depen`)
                            INNER JOIN `config_formaenvio` ON (`radi`.`id_formaenvio` = `config_formaenvio`.`id_formaenvio`)
                            LEFT JOIN `gene_terceros_empresas` AS `desti_empre` ON (`desti`.`id_empre` = `desti_empre`.`id_empre`)
                        WHERE `ra_respon`.`respon` = 1 AND `radi`.`trasnferido` = 0 AND `ofi`.`id_depen` = :id_depen";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":id_depen", $IdDepen, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($this->Accion == 4) {
                /******************************************************************************************/
                /*  LISTO LOS RADICADOS ENVIADOS DE UN JEFE DE OFICINA
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`
                        FROM `archivo_radica_enviados_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_enviados` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_destina` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radi` ON (`radi`.`id_usua_regis` = `usua_radi`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio_deta` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `fun` ON (`funcio_deta`.`id_funcio` = `fun`.`id_funcio`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radi` ON (`usua_radi`.`id_funcio` = `funcio_radi`.`id_funcio`)
                            INNER JOIN `areas_oficinas` ON (`funcio_deta`.`id_oficina` = `areas_oficinas`.`id_oficina`)
                            INNER JOIN `areas_dependencias` ON (`areas_oficinas`.`id_depen` = `areas_dependencias`.`id_depen`)
                            INNER JOIN `config_formaenvio` ON (`radi`.`id_formaenvio` = `config_formaenvio`.`id_formaenvio`)
                        WHERE `respon`.`respon` = 1 AND `radi`.`trasnferido` = 0 AND `depen`.`id_depen` = :id_depen AND `funcio_deta`.`id_oficina` = :id_oficina";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":id_depen", $this->IdDepen, PDO::PARAM_INT);
                $Instruc->bindParam(":id_oficina", $IdOfi, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            }

            $Result = $Instruc->rowCount();
            $conexion = null;
            return $Result;
        } catch (PDOException $e) {
            echo 'Ha surgido un error y no se puede ejecutar la consulta, total recibidos.' . $e->getMessage();
            exit;
        }
    }

    public function Filtro()
    {
        $conexion = new Conexion();

        try {
            if ($this->Accion == 5) {
                /******************************************************************************************/
                /*  FILTRO TODA LA CORRESPONDENCIA ENVIDA DE LA INSTITUCION
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`, `radi`.`asunto`, `radi`.`fec_docu`, `radi`.`fechor_radica`, `radi`.`digital`, `radi`.`id_ruta`,
                            `radi`.`impri_rotu`, `fun`.`nom_funcio`, `fun`.`ape_funcio`, `areas_dependencias`.`id_depen`,
                            `areas_dependencias`.`nom_depen`, `areas_oficinas`.`nom_oficina`, `terce_contac`.`nom_contac`, `terce_empre`.`razo_soci`,
                            `funcio_radi`.`nom_funcio` AS `nom_funcio_radi`, `funcio_radi`.`ape_funcio` AS `ape_funcio_radi`,
                            `config_formaenvio`.`id_formaenvio`, `config_formaenvio`.`nom_formaenvi`, `config_formaenvio`.`requie_digital`,
                            `radi`.`impri_rotu`
                        FROM `archivo_radica_enviados_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_enviados` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_destina` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radi` ON (`radi`.`id_usua_regis` = `usua_radi`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio_deta` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `fun` ON (`funcio_deta`.`id_funcio` = `fun`.`id_funcio`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radi` ON (`usua_radi`.`id_funcio` = `funcio_radi`.`id_funcio`)
                            INNER JOIN `areas_oficinas` ON (`funcio_deta`.`id_oficina` = `areas_oficinas`.`id_oficina`)
                            INNER JOIN `areas_dependencias` ON (`areas_oficinas`.`id_depen` = `areas_dependencias`.`id_depen`)
                            INNER JOIN `config_formaenvio` ON (`radi`.`id_formaenvio` = `config_formaenvio`.`id_formaenvio`)
                        WHERE (`ra_respon`.`respon` = 1 AND `radi`.`trasnferido` = 0 " . self::Generar_Query_Correspondencia($this->Buscar, $this->IdRadica, $this->IdTercero, $this->IdFuncioDeta, $this->Asunto, $this->QueContenga, $this->IdDepen, $this->IdOfi) . ")
                        ORDER BY `radi`.`fechor_radica` DESC
                        LIMIT :Limite1, :Limite2";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":Limite1", $this->Limite1, PDO::PARAM_INT);
                $Instruc->bindParam(":Limite2", $this->Limite2, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($this->Accion == 6) {
                /******************************************************************************************/
                /*  FILTRO LA CORRESPONDENCIA INTERNA DE UN FUNCIONARIO
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`, `radi`.`asunto`, `radi`.`fec_docu`, `radi`.`fechor_radica`, `radi`.`digital`, `radi`.`impri_rotu`,
                            `fun`.`nom_funcio`, `fun`.`ape_funcio`, `areas_dependencias`.`id_depen`, `areas_dependencias`.`nom_depen`,
                            `areas_oficinas`.`nom_oficina`, `terce_contac`.`nom_contac`, `terce_empre`.`razo_soci`, `funcio_radi`.`nom_funcio` AS `nom_funcio_radi`,
                            `funcio_radi`.`ape_funcio` AS `ape_funcio_radi`, `config_formaenvio`.`id_formaenvio`, `config_formaenvio`.`nom_formaenvi`,
                            `config_formaenvio`.`requie_digital`, `radi`.`impri_rotu`
                        FROM `archivo_radica_enviados_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_enviados` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_destina` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radi` ON (`radi`.`id_usua_regis` = `usua_radi`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio_deta` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `fun` ON (`funcio_deta`.`id_funcio` = `fun`.`id_funcio`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radi` ON (`usua_radi`.`id_funcio` = `funcio_radi`.`id_funcio`)
                            INNER JOIN `areas_oficinas` ON (`funcio_deta`.`id_oficina` = `areas_oficinas`.`id_oficina`)
                            INNER JOIN `areas_dependencias` ON (`areas_oficinas`.`id_depen` = `areas_dependencias`.`id_depen`)
                            INNER JOIN `config_formaenvio` ON (`radi`.`id_formaenvio` = `config_formaenvio`.`id_formaenvio`)
                        WHERE (`radi`.`trasnferido` = 0 AND `ra_respon`.`respon` = 1 AND `ra_respon`.`id_funcio_deta` = :id_funcio_deta
                            " . self::Generar_Query_Correspondencia($this->Buscar, $this->IdRadica, $this->IdTercero, $this->IdFuncioDeta, $this->Asunto, $this->QueContenga, $this->IdDepen, $this->IdOfi) . ")
                        ORDER BY `radi`.`fechor_radica` DESC
                        LIMIT :Limite1, :Limite2";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":id_funcio_deta", $this->IdFuncioSesion, PDO::PARAM_INT);
                $Instruc->bindParam(":Limite1", $this->Limite1, PDO::PARAM_INT);
                $Instruc->bindParam(":Limite2", $this->Limite2, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($this->Accion == 7) {
                /******************************************************************************************/
                /*  FILTRO LA CORRESPONDENCIA EXTERNA DE UN FUNCIONARIO JEFE DE DEPENDENCIA
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`, `radi`.`asunto`, `radi`.`fec_docu`, `radi`.`fechor_radica`, `radi`.`digital`, `radi`.`impri_rotu`,
                            `fun`.`nom_funcio`, `fun`.`ape_funcio`, `areas_dependencias`.`id_depen`, `areas_dependencias`.`nom_depen`,
                            `areas_oficinas`.`nom_oficina`, `terce_contac`.`nom_contac`, `terce_empre`.`razo_soci`, `funcio_radi`.`nom_funcio` AS `nom_funcio_radi`,
                            `funcio_radi`.`ape_funcio` AS `ape_funcio_radi`, `config_formaenvio`.`id_formaenvio`, `config_formaenvio`.`nom_formaenvi`,
                            `config_formaenvio`.`requie_digital`, `radi`.`impri_rotu`
                        FROM `archivo_radica_enviados_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_enviados` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_destina` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radi` ON (`radi`.`id_usua_regis` = `usua_radi`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio_deta` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `fun` ON (`funcio_deta`.`id_funcio` = `fun`.`id_funcio`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radi` ON (`usua_radi`.`id_funcio` = `funcio_radi`.`id_funcio`)
                            INNER JOIN `areas_oficinas` ON (`funcio_deta`.`id_oficina` = `areas_oficinas`.`id_oficina`)
                            INNER JOIN `areas_dependencias` ON (`areas_oficinas`.`id_depen` = `areas_dependencias`.`id_depen`)
                            INNER JOIN `config_formaenvio` ON (`radi`.`id_formaenvio` = `config_formaenvio`.`id_formaenvio`)
                        WHERE (`radi`.`trasnferido` = 0 AND `ra_respon`.`respon` = 1 AND `areas_dependencias`.`id_depen` = :id_depen
                            " . self::Generar_Query_Correspondencia($this->Buscar, $this->IdRadica, $this->IdTercero, $this->IdFuncioDeta, $this->Asunto, $this->QueContenga, $this->IdDepen, $this->IdOfi) . ")
                        ORDER BY `radi`.`fechor_radica` DESC
                        LIMIT :Limite1, :Limite2";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":id_depen", $this->IdDepen, PDO::PARAM_INT);
                $Instruc->bindParam(":Limite1", $this->Limite1, PDO::PARAM_INT);
                $Instruc->bindParam(":Limite2", $this->Limite2, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($this->Accion == 8) {
                /******************************************************************************************/
                /*  FILTRO LA CORRESPONDENCIA EXTERNA DE UN FUNCIONARIO JEFE DE OFICINA
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`, `radi`.`asunto`, `radi`.`fec_docu`, `radi`.`fechor_radica`, `radi`.`digital`, `radi`.`impri_rotu`,
                            `fun`.`nom_funcio`, `fun`.`ape_funcio`, `areas_dependencias`.`id_depen`, `areas_dependencias`.`nom_depen`,
                            `areas_oficinas`.`nom_oficina`, `terce_contac`.`nom_contac`, `terce_empre`.`razo_soci`, `funcio_radi`.`nom_funcio` AS `nom_funcio_radi`,
                            `funcio_radi`.`ape_funcio` AS `ape_funcio_radi`, `config_formaenvio`.`id_formaenvio`, `config_formaenvio`.`nom_formaenvi`,
                            `config_formaenvio`.`requie_digital`, `radi`.`impri_rotu`
                        FROM `archivo_radica_enviados_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_enviados` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_destina` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radi` ON (`radi`.`id_usua_regis` = `usua_radi`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio_deta` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `fun` ON (`funcio_deta`.`id_funcio` = `fun`.`id_funcio`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radi` ON (`usua_radi`.`id_funcio` = `funcio_radi`.`id_funcio`)
                            INNER JOIN `areas_oficinas` ON (`funcio_deta`.`id_oficina` = `areas_oficinas`.`id_oficina`)
                            INNER JOIN `areas_dependencias` ON (`areas_oficinas`.`id_depen` = `areas_dependencias`.`id_depen`)
                            INNER JOIN `config_formaenvio` ON (`radi`.`id_formaenvio` = `config_formaenvio`.`id_formaenvio`)
                        WHERE (`radi`.`trasnferido` = 0 AND `ra_respon`.`respon` = 1 AND `areas_dependencias`.`id_depen` = :id_depen
                            AND `funcio_deta`.`id_oficina` = :id_oficina
                            " . self::Generar_Query_Correspondencia($this->Buscar, $this->IdRadica, $this->IdTercero, $this->IdFuncioDeta, $this->Asunto, $this->QueContenga, $this->IdDepen, $this->IdOfi) . ")
                        ORDER BY `radi`.`fechor_radica` DESC
                        LIMIT :Limite1, :Limite2";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":id_depen", $this->IdDepen, PDO::PARAM_INT);
                $Instruc->bindParam(":id_oficina", $this->IdOfi, PDO::PARAM_INT);
                $Instruc->bindParam(":Limite1", $this->Limite1, PDO::PARAM_INT);
                $Instruc->bindParam(":Limite2", $this->Limite2, PDO::PARAM_INT);
                $Instruc->execute(array($this->IdDepen, $this->IdOfi)) or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            }

            $Result = $Instruc->fetchAll();
            $conexion = null;
            return $Result;
        } catch (PDOException $e) {
            echo 'Ha surgido un error y no se puede ejecutar la consulta, Correspondencia enviada -> Listar bandeja -> Filtro, Accion: .' . $this->Accion . " - " . $e->getMessage();
            exit;
        }
    }

    public function TotalRegistros_Filtro()
    {
        $conexion = new Conexion();

        try {
            if ($this->Accion == 5) {
                /******************************************************************************************/
                /*  FILTRO TODA LA CORRESPONDENCIA ENVIDA DE LA INSTITUCION
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`
                        FROM `archivo_radica_enviados_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_enviados` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_destina` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radi` ON (`radi`.`id_usua_regis` = `usua_radi`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio_deta` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `fun` ON (`funcio_deta`.`id_funcio` = `fun`.`id_funcio`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radi` ON (`usua_radi`.`id_funcio` = `funcio_radi`.`id_funcio`)
                            INNER JOIN `areas_oficinas` ON (`funcio_deta`.`id_oficina` = `areas_oficinas`.`id_oficina`)
                            INNER JOIN `areas_dependencias` ON (`areas_oficinas`.`id_depen` = `areas_dependencias`.`id_depen`)
                            INNER JOIN `config_formaenvio` ON (`radi`.`id_formaenvio` = `config_formaenvio`.`id_formaenvio`)
                        WHERE (`ra_respon`.`respon` = 1 AND `radi`.`trasnferido` = 0 " . self::Generar_Query_Correspondencia($this->Buscar, $this->IdRadica, $this->IdTercero, $this->IdFuncioDeta, $this->Asunto, $this->QueContenga, $this->IdDepen, $this->IdOfi) . ")";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($this->Accion == 6) {
                /******************************************************************************************/
                /*  FILTRO LA CORRESPONDENCIA INTERNA DE UN FUNCIONARIO
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`
                        FROM `archivo_radica_enviados_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_enviados` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_destina` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radi` ON (`radi`.`id_usua_regis` = `usua_radi`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio_deta` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `fun` ON (`funcio_deta`.`id_funcio` = `fun`.`id_funcio`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radi` ON (`usua_radi`.`id_funcio` = `funcio_radi`.`id_funcio`)
                            INNER JOIN `areas_oficinas` ON (`funcio_deta`.`id_oficina` = `areas_oficinas`.`id_oficina`)
                            INNER JOIN `areas_dependencias` ON (`areas_oficinas`.`id_depen` = `areas_dependencias`.`id_depen`)
                            INNER JOIN `config_formaenvio` ON (`radi`.`id_formaenvio` = `config_formaenvio`.`id_formaenvio`)
                        WHERE (`radi`.`trasnferido` = 0 AND `ra_respon`.`respon` = 1 AND `ra_respon`.`id_funcio_deta` = :id_funcio_deta
                            " . self::Generar_Query_Correspondencia($this->Buscar, $this->IdRadica, $this->IdTercero, $this->IdFuncioDeta, $this->Asunto, $this->QueContenga, $this->IdDepen, $this->IdOfi) . ")";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":id_funcio_deta", $this->IdFuncioSesion, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($this->Accion == 7) {
                /******************************************************************************************/
                /*  FILTRO LA CORRESPONDENCIA EXTERNA DE UN FUNCIONARIO JEFE DE DEPENDENCIA
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`
                        FROM `archivo_radica_enviados_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_enviados` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_destina` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radi` ON (`radi`.`id_usua_regis` = `usua_radi`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio_deta` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `fun` ON (`funcio_deta`.`id_funcio` = `fun`.`id_funcio`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radi` ON (`usua_radi`.`id_funcio` = `funcio_radi`.`id_funcio`)
                            INNER JOIN `areas_oficinas` ON (`funcio_deta`.`id_oficina` = `areas_oficinas`.`id_oficina`)
                            INNER JOIN `areas_dependencias` ON (`areas_oficinas`.`id_depen` = `areas_dependencias`.`id_depen`)
                            INNER JOIN `config_formaenvio` ON (`radi`.`id_formaenvio` = `config_formaenvio`.`id_formaenvio`)
                        WHERE (`radi`.`trasnferido` = 0 AND `ra_respon`.`respon` = 1 AND `areas_dependencias`.`id_depen` = :id_depen
                            " . self::Generar_Query_Correspondencia($this->Buscar, $this->IdRadica, $this->IdTercero, $this->IdFuncioDeta, $this->Asunto, $this->QueContenga, $this->IdDepen, $this->IdOfi) . ")";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":id_depen", $this->IdDepen, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($this->Accion == 8) {
                /******************************************************************************************/
                /*  FILTRO LA CORRESPONDENCIA EXTERNA DE UN FUNCIONARIO JEFE DE OFICINA
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`
                        FROM `archivo_radica_enviados_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_enviados` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_destina` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radi` ON (`radi`.`id_usua_regis` = `usua_radi`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio_deta` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `fun` ON (`funcio_deta`.`id_funcio` = `fun`.`id_funcio`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radi` ON (`usua_radi`.`id_funcio` = `funcio_radi`.`id_funcio`)
                            INNER JOIN `areas_oficinas` ON (`funcio_deta`.`id_oficina` = `areas_oficinas`.`id_oficina`)
                            INNER JOIN `areas_dependencias` ON (`areas_oficinas`.`id_depen` = `areas_dependencias`.`id_depen`)
                            INNER JOIN `config_formaenvio` ON (`radi`.`id_formaenvio` = `config_formaenvio`.`id_formaenvio`)
                        WHERE (`radi`.`trasnferido` = 0 AND `ra_respon`.`respon` = 1 AND `areas_dependencias`.`id_depen` = ? AND
                            `funcio_deta`.`id_oficina` = :id_oficina
                            " . self::Generar_Query_Correspondencia($this->Buscar, $this->IdRadica, $this->IdTercero, $this->IdFuncioDeta, $this->Asunto, $this->QueContenga, $this->IdDepen, $this->IdOfi) . ")";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":id_depen", $this->IdDepen, PDO::PARAM_INT);
                $Instruc->bindParam(":id_oficina", $this->IdOfi, PDO::PARAM_INT);
                $Instruc->execute(array($this->IdDepen, $this->IdOfi)) or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            }

            $Result = $Instruc->rowCount();
            $conexion = null;
            return $Result;
        } catch (PDOException $e) {
            echo 'Ha surgido un error y no se puede ejecutar la consulta, enviada listar.' . $e->getMessage();
            exit;
        }
    }

    /************************************************************************************************************************/
    /* QUENERAR QUERY
    /************************************************************************************************************************/
    public static function Generar_Query_Correspondencia($Buscar, $IdRadica, $IdTercero, $IdFuncio, $Asunto, $QueContenga, $IdDepen, $IdOfi)
    {
        $conexion = new Conexion();

        $Query = "";

        if ($Buscar != "" and $IdRadica == "" and $IdTercero == "" and $IdFuncio == "" and $Asunto == "" and $QueContenga == "" and $IdDepen == "" and $IdOfi == "") {

            $Query = "AND `radi`.`id_radica` LIKE '%" . $Buscar . "%'
                    OR `terce_contac`.`nom_contac` LIKE '%" . $Buscar . "%'
                    OR `terce_empre`.`razo_soci` LIKE '%" . $Buscar . "%'
                    OR CONCAT(TRIM(`fun`.`nom_funcio`), ' ', TRIM(`fun`.`ape_funcio`)) LIKE '%" . $Buscar . "%'
                    OR `radi`.`asunto` LIKE '%" . $Buscar . "%'";
        } else {
            if ($IdRadica != "") {
                $Query .= " AND `radi`.`id_radica` LIKE '%" . $IdRadica . "%'";
            }

            if ($IdTercero != "") {
                $Query .= " AND `terce_contac`.`id_empre` = " . $IdTercero;
            }

            if ($IdFuncio != "") {
                $Query .= " AND `funcio_deta`.`id_funcio_deta` = " . $IdFuncio;
            }

            if ($Asunto != "") {
                $Query .= " AND `radi`.`asunto` LIKE '%" . $Asunto . "%'";
            }

            if ($QueContenga != "") {
                $Query .= " AND `radi`.`que_contenga` LIKE '%" . $QueContenga . "%'";
            }

            if ($IdDepen != "") {
                $Query .= " AND `depen`.`id_depen` = " . $IdDepen;
            }

            if ($IdOfi != "") {
                $Query .= " AND `funcio_deta`.`id_oficina` = " . $IdOfi;
            }
        }
        //echo $Query;
        return $Query;
        exit();
    }
}
