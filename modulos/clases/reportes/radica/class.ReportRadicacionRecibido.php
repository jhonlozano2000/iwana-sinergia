<?php
class ReportRadicacionRecibido
{

    public static function Listar_Totales($FechaIni, $FechaFin, $IdTercero, $TipoTercer, $IdFuncionario, $IdDepen, $IdOficina, $IdSerie, $IdSubSerie, $IdTipoDoc)
    {
        $conexion = new Conexion();

        try {

            $Agrupar   = " GROUP BY  ";
            $Columanas = "SELECT COUNT(`ra`.`id_radica`) AS `total_id_radica`,  ";

            $Sql = "FROM `archivo_radica_recibidos_responsa` AS `ra_respon`
                        INNER JOIN `archivo_radica_recibidos` AS `ra` ON (`ra_respon`.`id_radica` = `ra`.`id_radica`)
                        INNER JOIN `archivo_trd_series` AS `serie` ON (`ra`.`id_serie` = `serie`.`id_serie`)
                        INNER JOIN `archivo_trd_subserie` AS `subserie` ON (`ra`.`id_subserie` = `subserie`.`id_subserie`)
                        INNER JOIN `archivo_trd_tipo_docu` AS `tipo_docu` ON (`ra`.`id_tipodoc` = `tipo_docu`.`id_tipodoc`)
                        INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio` = `funcio_deta`.`id_funcio_deta`)
                        INNER JOIN `gene_funcionarios` AS `funcio_respon` ON (`funcio_deta`.`id_funcio` = `funcio_respon`.`id_funcio`)
                        INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                        INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                    WHERE DATE(`ra`.`fechor_radica`) BETWEEN :fecha_ini AND :fecha_fin ";

            if ($IdFuncionario != "") {
                $Columanas .= "COUNT(`funcio_respon`.`id_funcio`) AS `total_id_funcio`, `funcio_respon`.`nom_funcio`, `funcio_respon`.`ape_funcio`,";
                $Sql       .= " AND `funcio_deta`.`id_funcio_deta` = :id_funcio_deta";
                $Agrupar   .= "`funcio_respon`.`id_funcio`, ";
            }

            if ($IdDepen != 0) {
                $Columanas .= "COUNT(`depen`.`id_depen`) AS `total_id_depen`, `depen`.`nom_depen`,";
                $Sql       .= " AND `depen`.`id_depen` = :id_depen";
                $Agrupar   .= "`depen`.`id_depen`, ";
            }

            if ($IdOficina != 0) {
                $Columanas .= " COUNT(`ofi`.`id_oficina`) AS `total_id_oficina`, `ofi`.`nom_oficina`,";
                $Sql       .= " AND `depen`.`id_depen` = :id_depen";
                $Agrupar   .= "`ofi`.`id_oficina`, ";
            }

            if ($IdSerie != 0) {
                $Columanas .= " COUNT(`serie`.`id_serie`) AS `total_id_serie`, `serie`.`cod_serie`, `serie`.`nom_serie`, ";
                $Sql       .= " AND `serie`.`id_serie` = :id_serie";
                $Agrupar   .= "`serie`.`id_serie`, ";
            }

            if ($IdSubSerie != 0) {
                $Columanas .= "COUNT(`subserie`.`id_subserie`) AS `total_id_subserie`, `subserie`.`cod_subserie`, `subserie`.`nom_subserie`, ";
                $Sql       .= " AND `subserie`.`id_subserie` = :id_subserie";
                $Agrupar   .= "`subserie`.`id_subserie`, ";
            }

            if ($IdTipoDoc != 0) {
                $Columanas .= "COUNT(`tipo_docu`.`id_tipodoc`) AS `total_id_tipodoc`, `tipo_docu`.`nom_tipodoc`";
                $Sql       .= " AND `tipo_docu`.`id_tipodoc` = :id_tipodoc";
                $Agrupar   .= "`tipo_docu`.`id_tipodoc`";
            }

            $Instruc = $conexion->prepare($Columanas . $Sql . $Agrupar);
            $Instruc->bindParam(":fecha_ini", $FechaIni, PDO::PARAM_STR);
            $Instruc->bindParam(":fecha_fin", $FechaFin, PDO::PARAM_STR);

            if ($IdTercero != "") {
                if ($TipoTercer == 'JURIDICO') {
                    $Instruc->bindParam(":id_tercero", $IdTercero, PDO::PARAM_INT);
                } elseif ($TipoTercer == 'NATURAL') {
                    $Instruc->bindParam(":id_tercero", $IdTercero, PDO::PARAM_INT);
                }
            }

            if ($IdFuncionario != "") {
                $Instruc->bindParam(":id_funcio_deta", $IdFuncionario, PDO::PARAM_INT);
            }

            if ($IdDepen != 0) {
                $Instruc->bindParam(":id_depen", $IdDepen, PDO::PARAM_INT);
            }

            if ($IdSerie != 0) {
                $Instruc->bindParam(":id_serie", $IdSerie, PDO::PARAM_INT);
            }

            if ($IdSubSerie != 0) {
                $Instruc->bindParam(":id_subserie", $IdSubSerie, PDO::PARAM_INT);
            }

            if ($IdTipoDoc != 0) {
                $Instruc->bindParam(":id_tipodoc", $IdTipoDoc, PDO::PARAM_INT);
            }

            $Instruc->execute() or die(print_r($FechaFin->errorInfo() . " - " . $Sql, true));
            $Result = $Instruc->fetchAll();
            $conexion = null;
            return $Result;
        } catch (PDOException $e) {
            echo 'Ha surgido un error y no se puede ejecutar la consulta, recibidos.' . $e->getMessage();
            exit;
        }
    }

    public static function Listar_Detallado($FechaIni, $FechaFin, $IdTercero, $TipoTercer, $IdFuncionario, $IdDepen, $IdSerie, $IdSubSerie, $IdTipoDoc)
    {
        $conexion = new Conexion();

        try {

            $Sql = "SELECT `ra`.`id_radica`, `ra`.`fechor_radica`, `ra`.`fechor_radica`, `ra`.`fec_docu`, `ra`.`fec_venci`, `ra`.`asunto`, `funcio_respon`.`nom_funcio`, 
                        `funcio_respon`.`ape_funcio`, `depen`.`nom_depen`, `ofi`.`nom_oficina`, `Terce`.`nom_contac`, `TerceEmpre`.`nit_empre`, `TerceEmpre`.`razo_soci`, 
                        `ra_respon`.`respon`, `serie`.`cod_serie`, `serie`.`nom_serie`, `subserie`.`cod_subserie`, `subserie`.`nom_subserie`, `tipo_docu`.`nom_tipodoc`, 
                        `archivo_radica_enviados`.`id_radica` AS `radica_respuesta`, `archivo_radica_enviados`.`fechor_radica` AS `fechor_radica_respuesta`, 
                        `archivo_radica_enviados`.`asunto` AS `asunto_respuesta`, `TerceEmpre`.`id_empre`
                    FROM `archivo_radica_recibidos` AS `ra`
                        INNER JOIN `gene_terceros_contac` AS `Terce`  ON (`ra`.`id_remite` = `Terce`.`id_tercero`)
                        INNER JOIN `archivo_radica_recibidos_responsa` AS `ra_respon` ON (`ra_respon`.`id_radica` = `ra`.`id_radica`)
                        INNER JOIN `archivo_trd_series` AS `serie` ON (`ra`.`id_serie` = `serie`.`id_serie`)
                        INNER JOIN `archivo_trd_subserie` AS `subserie` ON (`ra`.`id_subserie` = `subserie`.`id_subserie`)
                        INNER JOIN `archivo_trd_tipo_docu` AS `tipo_docu` ON (`ra`.`id_tipodoc` = `tipo_docu`.`id_tipodoc`)
                        LEFT JOIN `archivo_radica_enviados` ON (`ra`.`radica_respuesta` = `archivo_radica_enviados`.`id_radica`)
                        LEFT JOIN `gene_terceros_empresas` AS `TerceEmpre` ON (`Terce`.`id_empre` = `TerceEmpre`.`id_empre`)
                        INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio` = `funcio_deta`.`id_funcio_deta`)
                        INNER JOIN `gene_funcionarios` AS `funcio_respon` ON (`funcio_deta`.`id_funcio` = `funcio_respon`.`id_funcio`)
                        INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                        INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                    WHERE DATE(`ra`.`fechor_radica`) BETWEEN :fecha_ini AND :fecha_fin";

            if ($IdTercero != "") {
                if ($TipoTercer == 'JURIDICO') {
                    $Sql .= " AND `TerceEmpre`.`id_empre` = :id_tercero";
                } elseif ($TipoTercer == 'NATURAL') {
                    $Sql .= " AND `Terce`.`id_tercero` = :id_tercero";
                }
            }

            if ($IdFuncionario != "") {
                $Sql .= " AND `funcio_deta`.`id_funcio_deta` = :id_funcio_deta";
            }

            if ($IdDepen != 0) {
                $Sql .= " AND `depen`.`id_depen` = :id_depen";
            }

            if ($IdSerie != 0) {
                $Sql .= " AND `serie`.`id_serie` = :id_serie";
            }

            if ($IdSubSerie != 0) {
                $Sql .= " AND `subserie`.`id_subserie` = :id_subserie";
            }

            if ($IdTipoDoc != 0) {
                $Sql .= " AND `tipo_docu`.`id_tipodoc` = :id_tipodoc";
            }

            $Instruc = $conexion->prepare($Sql);
            $Instruc->bindParam(":fecha_ini", $FechaIni, PDO::PARAM_STR);
            $Instruc->bindParam(":fecha_fin", $FechaFin, PDO::PARAM_STR);

            if ($IdTercero != "") {
                if ($TipoTercer == 'JURIDICO') {
                    $Instruc->bindParam(":id_tercero", $IdTercero, PDO::PARAM_INT);
                } elseif ($TipoTercer == 'NATURAL') {
                    $Instruc->bindParam(":id_tercero", $IdTercero, PDO::PARAM_INT);
                }
            }

            if ($IdFuncionario != "") {
                $Instruc->bindParam(":id_funcio_deta", $IdFuncionario, PDO::PARAM_INT);
            }

            if ($IdDepen != 0) {
                $Instruc->bindParam(":id_depen", $IdDepen, PDO::PARAM_INT);
            }

            if ($IdSerie != 0) {
                $Instruc->bindParam(":id_serie", $IdSerie, PDO::PARAM_INT);
            }

            if ($IdSubSerie != 0) {
                $Instruc->bindParam(":id_subserie", $IdSubSerie, PDO::PARAM_INT);
            }

            if ($IdTipoDoc != 0) {
                $Instruc->bindParam(":id_tipodoc", $IdTipoDoc, PDO::PARAM_INT);
            }

            $Instruc->execute() or die(print_r($Sql->errorInfo() . " - " . $Sql, true));
            $Result = $Instruc->fetchAll(PDO::FETCH_ASSOC);
            $conexion = null;
            return $Result;
        } catch (PDOException $e) {
            echo 'Ha surgido un error y no se puede ejecutar la consulta, recibidos.' . $e->getMessage();
            exit;
        }
    }

    public static function Listar($Accion, $IdRadicado, $IdFuncioDeta, $IdDepen, $IdOfi, $Criterio1, $Criterio2, $Criterio3)
    {
        $conexion = new Conexion();

        try {

            if ($Accion == 1) {
                /******************************************************************************************/
                /*  LISTO TODAS LAS ALERTAS DE LA CORRESPONDENCIA RECIBIDA
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`, `radi`.`fechor_radica`, `radi`.`fec_docu`, `radi`.`fec_venci`, `radi`.`asunto`, `radi`.`impri_rotu`, `radi`.`digital`, 
                            `radi`.`requie_respues`, `funcio`.`nom_funcio`, `funcio`.`ape_funcio`, `ofi`.`nom_oficina`, `depen`.`nom_depen`, `terce_contac`.`nom_contac`, 
                            `terce_contac`.`cargo`, `terce_empre`.`nit_empre`, `terce_empre`.`razo_soci`, `funcio_radica`.`nom_funcio` AS `nom_funcio_radi`, 
                            `funcio_radica`.`ape_funcio` AS `ape_funcio_radi`, `radi`.`radica_respuesta`, `radi`.`id_forma_llegada`, `forma_llega`.`nom_formaenvi` AS `nom_forma_llega`, 
                            `forma_llega`.`requie_digital`
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
                        WHERE (`radi`.`requie_respues` = 1 AND `radi`.`respondido` = 0 AND `ra_respon`.`respon` = 1)
                        ORDER BY `radi`.`fechor_radica` DESC";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":Criterio1", $Criterio1, PDO::PARAM_INT);
                $Instruc->bindParam(":Criterio2", $Criterio2, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($Accion == 2) {
                /******************************************************************************************/
                /*  LISTO LOS RADIACOD A LOS QUE LES HACEN FALTA EL ARCHIVO DIGITAL
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`, `radi`.`fechor_radica`, `radi`.`fec_docu`, `radi`.`fec_venci`, `radi`.`asunto`, `radi`.`digital`, `funcio`.`nom_funcio`, 
                            `funcio`.`ape_funcio`, `depen`.`nom_depen`, `ofi`.`nom_oficina`, `terce_contac`.`nom_contac`, `terce_empre`.`nit_empre`, `terce_empre`.`razo_soci`, 
                            `funcio_deta`.`id_oficina`, `ra_respon`.`leido`, `radi`.`autoriza`, `radi`.`requie_respues`, `forma_recibi`.`nom_formaenvi`, `segu_usua`.`login`
                            , `funcio_radi`.`nom_funcio`, `funcio_radi`.`ape_funcio`
                        FROM `archivo_radica_recibidos_responsa` AS `ra_respon` 
                            INNER JOIN `archivo_radica_recibidos` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`) 
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio` = `funcio_deta`.`id_funcio_deta`) 
                            INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`) 
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`) 
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`) 
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_remite` = `terce_contac`.`id_tercero`) 
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`) 
                            INNER JOIN `config_formaenvio` AS `forma_recibi` ON (`radi`.`id_forma_llegada` = `forma_recibi`.`id_formaenvio`)
                            INNER JOIN `segu_usua` ON (`radi`.`id_usua_regis` = `segu_usua`.`id_usua`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radi` ON (`segu_usua`.`id_funcio` = `funcio_radi`.`id_funcio`)
                        WHERE (`radi`.`digital` = 0 AND `radi`.`transferido` = 0 AND `ra_respon`.`respon` = 1 AND `forma_recibi`.`requie_digital` = 1)
                        ORDER BY `radi`.`fechor_radica` DESC";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($Accion == 3) {
                /******************************************************************************************/
                /*  LISTO LOS RADIACOD QUE REQUIEREN RESPUESTA
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`, `radi`.`fechor_radica`, `radi`.`fec_docu`, `radi`.`fec_venci`, `radi`.`asunto`, `radi`.`digital`, `funcio`.`nom_funcio`, 
                            `funcio`.`ape_funcio`, `depen`.`nom_depen`, `ofi`.`nom_oficina`, `terce_contac`.`nom_contac`, `terce_empre`.`nit_empre`, `terce_empre`.`razo_soci`, 
                            `funcio_deta`.`id_oficina`, `ra_respon`.`leido`, `radi`.`autoriza`, `radi`.`requie_respues`
                        FROM `archivo_radica_recibidos_responsa` AS `ra_respon` 
                            INNER JOIN `archivo_radica_recibidos` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`) 
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio` = `funcio_deta`.`id_funcio_deta`) 
                            INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`) 
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`) 
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`) 
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_remite` = `terce_contac`.`id_tercero`) 
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`) 
                        WHERE (`radi`.`requie_respues` = 1 AND `radi`.`respondido` = 0 AND `ra_respon`.`respon` = 1)
                        ORDER BY `radi`.`fechor_radica` DESC";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($Accion == 4) {
                /******************************************************************************************/
                /*  LISTO LOS PARSF
                /******************************************************************************************/
                $Sql = "SELECT `ra`.`id_radica` AS `RADICADO DE ENTRADA`, DATE(`ra`.`fechor_radica`) AS `FECHA DE ENTRADA`, `terce_empre`.`razo_soci` AS `ENTIDAD`,
                            `terce_empre`.`nit_empre` AS `NIT`, `terce_empre`.`tel` AS `TELEFONO`, `depar_empre`.`nom_depar`, `muni_empre`.`nom_muni`,
                            `terce_contac`.`num_docu` AS `CEDULA`, `terce_contac`.`nom_contac` AS `CIUDADANO`, `terce_contac`.`tel` AS `TELEFONO`,
                            `depar_contac`.`nom_depar` AS `DEPARTAMENTO`, `muni_contac`.`nom_muni` AS `MUNICIPIO`, `funcio`.`cod_funcio` AS `CC FUNCIONARIO`,
                            `funcio`.`nom_funcio` AS `NOM. FUNCIONARIO`, `funcio`.`ape_funcio` AS `APE. FUNCIONARIO`, `ra`.`fec_docu` AS `FECHA DE DOCUMENTO`,
                            `ra`.`fec_venci` AS `FECHA DE VENCIMIENTO`, `ra`.`asunto` AS `ASUNTO`, `sub_serie`.`nom_subserie` AS `TIPO DE PQRSF(SUBSERIE)`,
                            `tipo_doc`.`nom_tipodoc` AS `TIPO DOCUMENTAL`, `config_formaenvio`.`nom_formaenvi` AS `CANAL DE COMUNICACIÓN`,
                            `ra_envia`.`id_radica` AS `RADICADO DE RESPUESTA`, DATE(`ra_envia`.`fechor_radica`) AS `FECHA DE RESPUESTA`,
                            `config_tipos_respuestas`.`nom_respues` AS `ESTADO(AROBADO-NEGADO-TRASLADO)`, `ra_envia`.`asunto`, `config_formaenvio_1`.`nom_formaenvi`
                        FROM `archivo_radica_recibidos` AS `ra`
                            INNER JOIN `archivo_trd_subserie` AS `sub_serie` ON (`ra`.`id_subserie` = `sub_serie`.`id_subserie`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`ra`.`id_remite` = `terce_contac`.`id_tercero`)
                            INNER JOIN `archivo_trd_tipo_docu` AS `tipo_doc` ON (`ra`.`id_tipodoc` = `tipo_doc`.`id_tipodoc`)
                            INNER JOIN `config_formaenvio` ON (`ra`.`id_forma_llegada` = `config_formaenvio`.`id_formaenvio`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            LEFT JOIN `config_depar` AS `depar_contac` ON (`terce_contac`.`id_depar` = `depar_contac`.`id_depar`)
                            LEFT JOIN `config_muni` AS `muni_contac` ON (`terce_contac`.`id_muni` = `muni_contac`.`id_muni`)
                            LEFT JOIN `config_depar` AS `depar_empre` ON (`terce_empre`.`id_depar` = `depar_empre`.`id_depar`)
                            LEFT JOIN `config_muni` AS `muni_empre` ON (`terce_empre`.`id_muni` = `muni_empre`.`id_muni`)
                            LEFT JOIN `archivo_radica_enviados` AS `ra_envia` ON (`ra_envia`.`id_radica` = `ra`.`radica_respuesta`)
                            LEFT JOIN `config_tipos_respuestas` ON (`ra_envia`.`id_tipo_respue` = `config_tipos_respuestas`.`id_respue`)
                            INNER JOIN `archivo_radica_recibidos_responsa` AS `ra_respon` ON (`ra_respon`.`id_radica` = `ra`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `fun_deta` ON (`ra_respon`.`id_funcio` = `fun_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio` ON (`fun_deta`.`id_funcio` = `funcio`.`id_funcio`)
                            LEFT JOIN `config_formaenvio` AS `config_formaenvio_1` ON (`ra_envia`.`id_formaenvio` = `config_formaenvio_1`.`id_formaenvio`)
                        WHERE (DATE(`ra`.`fechor_radica`) between :desde and :hasta
                            AND `sub_serie`.`id_subserie` in(123, 124, 125, 126, 132, 279, 284, 127, 128, 129, 130, 131, 283, 292, 291, 293)
                            AND `ra_respon`.`respon` = 1);";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":desde", $Criterio1, PDO::PARAM_STR);
                $Instruc->bindParam(":hasta", $Criterio2, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            }

            $Result = $Instruc->fetchAll(PDO::FETCH_ASSOC);
            $conexion = null;
            return $Result;
        } catch (PDOException $e) {
            echo 'Ha surgido un error y no se puede ejecutar la consulta listar alertas.' . $e->getMessage();
            exit;
        }
    }
}
