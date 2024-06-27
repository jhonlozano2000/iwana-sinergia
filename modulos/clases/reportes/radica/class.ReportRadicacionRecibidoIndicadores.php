<?php
class ReportRadicacionRecibidoIndicadores{
    
    public static function Listar($Accion, $FechaIni, $FechaFin, $IdDepen){
        $conexion = new Conexion();

        try{

            if($Accion == "VER_TERCEROS"){

                $Dependencia = "";
                if($IdDepen != 0){
                    $Dependencia = " AND `cargo`.`id_depen` =  :id_depen";
                }
                
                $Sql = "SELECT COUNT(`radi`.`id_radica`) AS `Total`, `contac`.`num_docu`, `contac`.`nom_contac`, `empre`.`razo_soci`
                        FROM
                            `archivo_radica_recibidos` AS `radi`
                            INNER JOIN `gene_terceros_contac` AS `contac` ON (`radi`.`id_remite` = `contac`.`id_tercero`)
                            LEFT JOIN `gene_terceros_empresas` AS `empre` ON (`contac`.`id_empre` = `empre`.`id_empre`)
                            INNER JOIN `archivo_radica_recibidos_responsa` AS `radi_respon` ON (`radi_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `respon_deta` ON (`radi_respon`.`id_funcio` = `respon_deta`.`id_funcio_deta`)
                            INNER JOIN `areas_cargos` AS `cargo` ON (`respon_deta`.`id_cargo` = `cargo`.`id_cargo`)
                        WHERE (`radi`.`fechor_radica` BETWEEN :fecha_ini AND :fecha_fin AND `radi_respon`.`respon` = 1 ".$Dependencia.")
                        GROUP BY `contac`.`nom_contac`, `empre`.`razo_soci`
                        ORDER BY 1 DESC";
                            
                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":fecha_ini", $FechaIni, PDO::PARAM_STR);
                $Instruc -> bindParam(":fecha_fin", $FechaFin, PDO::PARAM_STR);
                if($IdDepen != 0){
                    $Instruc -> bindParam(":id_depen", $IdDepen, PDO::PARAM_INT);
                }
            }elseif($Accion == "VER_RESPONSABLE"){
                
                $Dependencia = "";
                if($IdDepen != 0){
                    $Dependencia = " AND `depen`.`id_depen` =  :id_depen";
                }

                $Sql = "SELECT COUNT(`radi`.`id_radica`) AS `Total`, `respon`.`nom_funcio`, `respon`.`ape_funcio`, `depen`.`nom_depen`, `ofi`.`nom_oficina`
                        FROM `archivo_radica_recibidos_responsa` AS `radi_respon`
                            INNER JOIN `archivo_radica_recibidos` AS `radi` ON (`radi_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `respon_deta` ON (`radi_respon`.`id_funcio` = `respon_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `respon` ON (`respon_deta`.`id_funcio` = `respon`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`respon_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                        WHERE (`radi`.`fechor_radica` BETWEEN :fecha_ini AND :fecha_fin AND `radi_respon`.`respon` = 1 ".$Dependencia.")
                        GROUP BY `respon`.`nom_funcio`, `respon`.`ape_funcio`, `depen`.`nom_depen`, `ofi`.`nom_oficina`
                        ORDER BY 4, 5 ASC";
                            
                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":fecha_ini", $FechaIni, PDO::PARAM_STR);
                $Instruc -> bindParam(":fecha_fin", $FechaFin, PDO::PARAM_STR);
                if($IdDepen != 0){
                    $Instruc -> bindParam(":id_depen", $IdDepen, PDO::PARAM_INT);
                }
            }elseif($Accion == "VER_DEPENDENCIA_OFICINA"){
                
                $Dependencia = "";
                if($IdDepen != 0){
                    $Dependencia = " AND `depen`.`id_depen` =  :id_depen";
                }

                $Sql = "SELECT COUNT(`radi`.`id_radica`) AS `Total`, `depen`.`nom_depen`, `ofi`.`nom_oficina`
                        FROM `archivo_radica_recibidos_responsa` AS `radi_respon`
                            INNER JOIN `archivo_radica_recibidos` AS `radi` ON (`radi_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `respon_deta` ON (`radi_respon`.`id_funcio` = `respon_deta`.`id_funcio_deta`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`respon_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                        WHERE (`radi`.`fechor_radica` BETWEEN :fecha_ini AND :fecha_fin AND `radi_respon`.`respon` = 1 ".$Dependencia.")
                        GROUP BY `depen`.`nom_depen`, `ofi`.`nom_oficina`
                        ORDER BY 2, 3 ASC";
                            
                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":fecha_ini", $FechaIni, PDO::PARAM_STR);
                $Instruc -> bindParam(":fecha_fin", $FechaFin, PDO::PARAM_STR);
                if($IdDepen != 0){
                    $Instruc -> bindParam(":id_depen", $IdDepen, PDO::PARAM_INT);
                }
            }elseif($Accion == "VER_SERIE"){
                
                $Dependencia = "";
                if($IdDepen != 0){
                    $Dependencia = " AND `depen`.`id_depen` =  :id_depen";
                }

                $Sql = "SELECT COUNT(`radi`.`id_radica`) AS `Total`, `serie`.`nom_serie`
                        FROM `archivo_radica_recibidos_responsa` AS `radi_respon`
                            INNER JOIN `archivo_radica_recibidos` AS `radi` ON (`radi_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `respon_deta` ON (`radi_respon`.`id_funcio` = `respon_deta`.`id_funcio_deta`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`respon_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            INNER JOIN `archivo_trd_series` AS `serie` ON (`radi`.`id_serie` = `serie`.`id_serie`)
                        WHERE (`radi`.`fechor_radica` BETWEEN :fecha_ini AND :fecha_fin AND `radi_respon`.`respon` = 1 ".$Dependencia.")
                        GROUP BY `serie`.`nom_serie`
                        ORDER BY 2 DESC";
                            
                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":fecha_ini", $FechaIni, PDO::PARAM_STR);
                $Instruc -> bindParam(":fecha_fin", $FechaFin, PDO::PARAM_STR);
                if($IdDepen != 0){
                    $Instruc -> bindParam(":id_depen", $IdDepen, PDO::PARAM_INT);
                }
            }elseif($Accion == "VER_SUB_SERIE"){
                
                $Dependencia = "";
                if($IdDepen != 0){
                    $Dependencia = " AND `depen`.`id_depen` =  :id_depen";
                }

                $Sql = "SELECT COUNT(`radi`.`id_radica`) AS `Total`, `sub_serie`.`nom_subserie`
                        FROM `archivo_radica_recibidos_responsa` AS `radi_respon`
                            INNER JOIN `archivo_radica_recibidos` AS `radi` ON (`radi_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `respon_deta` ON (`radi_respon`.`id_funcio` = `respon_deta`.`id_funcio_deta`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`respon_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            INNER JOIN `archivo_trd_subserie` AS `sub_serie` ON (`radi`.`id_subserie` = `sub_serie`.`id_subserie`)
                        WHERE (`radi`.`fechor_radica` BETWEEN :fecha_ini AND :fecha_fin AND `radi_respon`.`respon` = 1 ".$Dependencia.")
                        GROUP BY `sub_serie`.`nom_subserie`
                        ORDER BY `Total` DESC";
                            
                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":fecha_ini", $FechaIni, PDO::PARAM_STR);
                $Instruc -> bindParam(":fecha_fin", $FechaFin, PDO::PARAM_STR);
                if($IdDepen != 0){
                    $Instruc -> bindParam(":id_depen", $IdDepen, PDO::PARAM_INT);
                }
             }elseif($Accion == "VER_TIPO_DOCUMENTO"){
                
                $Dependencia = "";
                if($IdDepen != 0){
                    $Dependencia = " AND `depen`.`id_depen` =  :id_depen";
                }

                $Sql = "SELECT COUNT(`radi`.`id_radica`) AS `Total`, `tipo_doc`.`nom_tipodoc`
                        FROM`archivo_radica_recibidos_responsa` AS `radi_respon`
                            INNER JOIN `archivo_radica_recibidos` AS `radi` ON (`radi_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `respon_deta` ON (`radi_respon`.`id_funcio` = `respon_deta`.`id_funcio_deta`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`respon_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            INNER JOIN `archivo_trd_tipo_docu` AS `tipo_doc` ON (`radi`.`id_tipodoc` = `tipo_doc`.`id_tipodoc`)
                        WHERE (`radi`.`fechor_radica` BETWEEN :fecha_ini AND :fecha_fin AND `radi_respon`.`respon` = 1 ".$Dependencia.")
                        GROUP BY `tipo_doc`.`nom_tipodoc`
                        ORDER BY 2 DESC";
                            
                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":fecha_ini", $FechaIni, PDO::PARAM_STR);
                $Instruc -> bindParam(":fecha_fin", $FechaFin, PDO::PARAM_STR);
                if($IdDepen != 0){
                    $Instruc -> bindParam(":id_depen", $IdDepen, PDO::PARAM_INT);
                }
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
}
?>