<?php
class ReportRadicacionEnviado{
    
    public static function Listar_Totales($Accion, $FechaIni, $FechaFin, $LimitIni, $LimitFin, $Criterio1, $Criterio2, $Criterio3){
        $conexion = new Conexion();
        $conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try{
            if($Accion = 1){
                /******************************************************************************************/
                /*  TOTAL POR DEPENDENCIAS
                /******************************************************************************************/
                $Dependencia = "";
                if($Criterio1 != 0){
                    $Dependencia = " AND `areas_dependencias`.`id_depen` = ".$Criterio1;
                }
               
                $Sql = "SELECT COUNT(`archivo_radica_recibidos`.`id_radica`) AS `Total`, `areas_dependencias`.`nom_depen`
                        FROM `archivo_radica_recibidos_responsa`
                            INNER JOIN `archivo_radica_recibidos` ON (`archivo_radica_recibidos_responsa`.`id_radica` = `archivo_radica_recibidos`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` ON (`archivo_radica_recibidos_responsa`.`id_funcio` = `gene_funcionarios_deta`.`id_funcio_deta`)
                            INNER JOIN `areas_oficinas` ON (`gene_funcionarios_deta`.`id_oficina` = `areas_oficinas`.`id_oficina`)
                            INNER JOIN `areas_dependencias` ON (`areas_oficinas`.`id_depen` = `areas_dependencias`.`id_depen`)
                        WHERE (`archivo_radica_recibidos_responsa`.`respon` = 1 ".$Dependencia.") AND DATE(`archivo_radica_recibidos`.`fechor_radica`) BETWEEN :fecha_ini AND :fecha_fin
                        GROUP BY `areas_dependencias`.`nom_depen`
                        ORDER BY `Total` DESC";

                if($LimitIni != "" and $LimitFin != ""){
                    $Sql.="LIMIT ".$LimitIni.", ".$LimitFin;
                }

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":fecha_ini", $FechaIni, PDO::PARAM_STR);
                $Instruc -> bindParam(":fecha_fin", $FechaFin, PDO::PARAM_STR);
            }elseif($Accion = 2){
                /******************************************************************************************/
                /*  TOTAL FUNCIONARIO
                /******************************************************************************************/
                $Sql = "SELECT COUNT(`archivo_radica_recibidos`.`id_radica`) AS `Total`, `areas_dependencias`.`nom_depen`
                            , `areas_oficinas`.`nom_oficina`, `gene_funcionarios`.`nom_funcio`, `gene_funcionarios`.`ape_funcio`
                        FROM
                            `archivo_radica_recibidos_responsa`
                            INNER JOIN `archivo_radica_recibidos` ON (`archivo_radica_recibidos_responsa`.`id_radica` = `archivo_radica_recibidos`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` ON (`archivo_radica_recibidos_responsa`.`id_funcio` = `gene_funcionarios_deta`.`id_funcio_deta`)
                            INNER JOIN `areas_oficinas` ON (`gene_funcionarios_deta`.`id_oficina` = `areas_oficinas`.`id_oficina`)
                            INNER JOIN `areas_dependencias` ON (`areas_oficinas`.`id_depen` = `areas_dependencias`.`id_depen`)
                            INNER JOIN `gene_funcionarios` ON (`gene_funcionarios_deta`.`id_funcio` = `gene_funcionarios`.`id_funcio`)
                        WHERE (`archivo_radica_recibidos_responsa`.`respon` = 1 AND `archivo_radica_recibidos`.`fechor_radica` BETWEEN :fecha_ini AND :fecha_fin)
                        GROUP BY `areas_dependencias`.`nom_depen`, `areas_oficinas`.`nom_oficina`
                        ORDER BY `Total` DESC 
                        LIMIT 10";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":fecha_ini", $FechaIni, PDO::PARAM_STR);
                $Instruc -> bindParam(":fecha_fin", $FechaFin, PDO::PARAM_STR);
            }elseif($Accion = 3){
                /******************************************************************************************/
                /*  TOTAL POR SERIES
                /******************************************************************************************/
                $Sql = "SELECT COUNT(`archivo_radica_recibidos`.`id_radica`) AS `Total`, `areas_dependencias`.`nom_depen`, `areas_dependencias`.`nom_depen`
                            , `archivo_trd_series`.`nom_serie`
                        FROM `archivo_radica_recibidos_responsa`
                            INNER JOIN `archivo_radica_recibidos` ON (`archivo_radica_recibidos_responsa`.`id_radica` = `archivo_radica_recibidos`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` ON (`archivo_radica_recibidos_responsa`.`id_funcio` = `gene_funcionarios_deta`.`id_funcio_deta`)
                            INNER JOIN `areas_oficinas` ON (`gene_funcionarios_deta`.`id_oficina` = `areas_oficinas`.`id_oficina`)
                            INNER JOIN `areas_dependencias` ON (`areas_oficinas`.`id_depen` = `areas_dependencias`.`id_depen`)
                            INNER JOIN `archivo_trd_series` ON (`archivo_radica_recibidos`.`id_serie` = `archivo_trd_series`.`id_serie`)
                        WHERE (`archivo_radica_recibidos_responsa`.`respon` = 1 AND `archivo_radica_recibidos`.`fechor_radica` BETWEEN :fecha_ini AND :fecha_fin)
                        GROUP BY `areas_dependencias`.`nom_depen`
                        ORDER BY `Total` DESC
                        LIMIT 10";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":fecha_ini", $FechaIni, PDO::PARAM_STR);
                $Instruc -> bindParam(":fecha_fin", $FechaFin, PDO::PARAM_STR);
            }elseif($Accion = 3){
                /******************************************************************************************/
                /*  TOTAL POR SUBSERIES
                /******************************************************************************************/
                $Sql = "SELECT COUNT(`archivo_radica_recibidos`.`id_radica`) AS `Total`, `areas_dependencias`.`nom_depen`, `areas_dependencias`.`nom_depen`
                            , `archivo_trd_subserie`.`nom_subserie`
                        FROM `archivo_radica_recibidos_responsa`
                            INNER JOIN `archivo_radica_recibidos` ON (`archivo_radica_recibidos_responsa`.`id_radica` = `archivo_radica_recibidos`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` ON (`archivo_radica_recibidos_responsa`.`id_funcio` = `gene_funcionarios_deta`.`id_funcio_deta`)
                            INNER JOIN `areas_oficinas` ON (`gene_funcionarios_deta`.`id_oficina` = `areas_oficinas`.`id_oficina`)
                            INNER JOIN `areas_dependencias` ON (`areas_oficinas`.`id_depen` = `areas_dependencias`.`id_depen`)
                            INNER JOIN `archivo_trd_subserie` ON (`archivo_radica_recibidos`.`id_subserie` = `archivo_trd_subserie`.`id_subserie`)
                        WHERE (`archivo_radica_recibidos_responsa`.`respon` = 1 AND `archivo_radica_recibidos`.`fechor_radica` BETWEEN '2018-01-01' AND '2018-03-31')
                        GROUP BY `areas_dependencias`.`nom_depen`
                        ORDER BY `Total` DESC
                        LIMIT 10";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":fecha_ini", $FechaIni, PDO::PARAM_STR);
                $Instruc -> bindParam(":fecha_fin", $FechaFin, PDO::PARAM_STR);
            }

            $Instruc->execute() or die(print_r($FechaFin->errorInfo()." - ".$Sql, true));
            $Result = $Instruc->fetchAll();
            $conexion = null;
            return $Result;
        }catch(PDOException $e){
            echo 'Ha surgido un error y no se puede ejecutar la consulta, recibidos.'.$e->getMessage();
            exit;
        }
    }

    public static function Listar_Detallado($Accion, $FechaIni, $FechaFin, $LimitIni, $LimitFin, $Criterio1, $Criterio2, $Criterio3){
        $conexion = new Conexion();
        $conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try{
            if($Accion = 1){
                /******************************************************************************************/
                /*  COMUNICACIONES RECIBIDAS PENDIENTES DE ADJUNTAR DIGITAL
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`, `radi`.`asunto`, `for_envi`.`nom_formaenvi` AS `Forma Recibido`, `terce`.`nom_contac`
                            , `empre`.`razo_soci`, `usua`.`login`, `usua`.`id_usua`, `usua`.`id_funcio`
                        FROM `archivo_radica_recibidos` AS `radi`
                            INNER JOIN `config_formaenvio` AS `for_envi`ON (`radi`.`id_forma_llegada` = `for_envi`.`id_formaenvio`)
                            INNER JOIN `gene_terceros_contac` AS `terce` ON (`radi`.`id_remite` = `terce`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua` ON (`radi`.`id_usua_regis` = `usua`.`id_usua`)
                            LEFT JOIN `gene_terceros_empresas` AS `empre` ON (`terce`.`id_empre` = `empre`.`id_empre`)
                        WHERE (`radi`.`digital` = 0 AND `for_envi`.`id_formaenvio` <> 8 AND `for_envi`.`id_formaenvio` <> 4)
                        ORDER BY `radi`.`id_radica` DESC";
                
                $Instruc = $conexion->prepare($Sql);
            }

            $Instruc->execute() or die(print_r($FechaFin->errorInfo()." - ".$Sql, true));
            $Result = $Instruc->fetchAll();
            $conexion = null;
            return $Result;
        }catch(PDOException $e){
            echo 'Ha surgido un error y no se puede ejecutar la consulta, recibidos.'.$e->getMessage();
            exit;
        }
    }

    public static function Listar($Accion, $IdRadicado, $IdFuncioDeta, $IdDepen, $IdOfi, $Criterio1, $Criterio2, $Criterio3){
        $conexion = new Conexion();

        try{
           
           if($Accion == 1){
                /******************************************************************************************/
                /*  LISTO LOS RADIACOD A LOS QUE LES HACEN FALTA EL ARCHIVO DIGITAL
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`, `radi`.`asunto`, `terce_contac`.`nom_contac`, `terce_empre`.`razo_soci`, `config_formaenvio`.`nom_formaenvi`, `segu_usua`.`login`, 
                            `funcio_radi`.`nom_funcio`, `funcio_radi`.`ape_funcio`
                        FROM `archivo_radica_enviados_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_enviados` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_destina` = `terce_contac`.`id_tercero`)
                            INNER JOIN `config_formaenvio` ON (`radi`.`id_formaenvio` = `config_formaenvio`.`id_formaenvio`)
                            INNER JOIN `segu_usua` ON (`radi`.`id_usua_regis` = `segu_usua`.`id_usua`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radi` ON (`segu_usua`.`id_funcio` = `funcio_radi`.`id_funcio`)
                        WHERE (`ra_respon`.`respon` = 1 AND `config_formaenvio`.`requie_digital` = 1)
                        ORDER BY `radi`.`fechor_radica` DESC";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":Criterio1", $Criterio1, PDO::PARAM_INT);
                $Instruc -> bindParam(":Criterio2", $Criterio2, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }

            $Result = $Instruc->fetchAll(PDO::FETCH_ASSOC);
            $conexion = null;
            return $Result;
        }catch(PDOException $e){
            echo 'Ha surgido un error y no se puede ejecutar la consulta listar alertas.'.$e->getMessage();
            exit;
        }
    }
}
?>