<?php
class ReportRadicacionInternoIndicadores{
    
    public static function Listar($Accion, $FechaIni, $FechaFin, $IdDepen){
        $conexion = new Conexion();

        try{

            if($Accion == "VER_DESTINATARIOS"){

                $Dependencia = "";
                if($IdDepen != 0){
                    $Dependencia = " AND `depen_desti`.`id_depen` =  :id_depen";
                }
                
                $Sql = "SELECT COUNT(`radi`.`id_radica`) AS `Total`, `desti`.`nom_funcio`, `desti`.`ape_funcio`, 
                            `depen_desti`.`nom_depen`, `ofi_desti`.`nom_oficina`
                        FROM `archivo_radica_interna_destinata` AS `radi_desti`
                            INNER JOIN `archivo_radica_interna` AS `radi` ON (`radi_desti`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `desti_deta` ON (`radi_desti`.`id_funcio_deta` = `desti_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `desti` ON (`desti_deta`.`id_funcio` = `desti`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi_desti` ON (`desti_deta`.`id_oficina` = `ofi_desti`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen_desti` ON (`ofi_desti`.`id_depen` = `depen_desti`.`id_depen`)
                        WHERE (`radi`.`fechor_radica` BETWEEN :fecha_ini AND :fecha_fin ".$Dependencia.")
                        GROUP BY `desti`.`nom_funcio`, `desti`.`ape_funcio`, `depen_desti`.`nom_depen`, `ofi_desti`.`nom_oficina`
                        ORDER BY `depen_desti`.`nom_depen` ASC, `ofi_desti`.`nom_oficina` ASC;";
                            
                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":fecha_ini", $FechaIni, PDO::PARAM_STR);
                $Instruc -> bindParam(":fecha_fin", $FechaFin, PDO::PARAM_STR);
                if($IdDepen != 0){
                    $Instruc -> bindParam(":id_depen", $IdDepen, PDO::PARAM_INT);
                }
            }elseif($Accion == "VER_RESPONSABLE"){
                
                $Dependencia = "";
                if($IdDepen != 0){
                    $Dependencia = " AND `ofi_respon`.`id_depen` =  :id_depen";
                }
                
                $Sql = "SELECT COUNT(`radi`.`id_radica`) AS `Total`, `radi`.`fechor_radica`, `respon`.`nom_funcio`, `respon`.`ape_funcio`, 
                            `depen_respon`.`nom_depen`, `ofi_respon`.`nom_oficina`
                        FROM `archivo_radica_interna_responsa` AS `radi_respon`
                            INNER JOIN `archivo_radica_interna` AS `radi` ON (`radi_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `respon_deta` ON (`radi_respon`.`id_funcio` = `respon_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `respon` ON (`respon_deta`.`id_funcio` = `respon`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi_respon` ON (`respon_deta`.`id_oficina` = `ofi_respon`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen_respon` ON (`ofi_respon`.`id_depen` = `depen_respon`.`id_depen`)
                        WHERE (`radi`.`fechor_radica` BETWEEN :fecha_ini AND :fecha_fin AND `radi_respon`.`respon` = 1 ".$Dependencia.")
                        GROUP BY `respon`.`nom_funcio`, `respon`.`ape_funcio`, `depen_respon`.`nom_depen`, `ofi_respon`.`nom_oficina`
                        ORDER BY `depen_respon`.`nom_depen` ASC, `ofi_respon`.`nom_oficina` ASC;";
                            
                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":fecha_ini", $FechaIni, PDO::PARAM_STR);
                $Instruc -> bindParam(":fecha_fin", $FechaFin, PDO::PARAM_STR);
                if($IdDepen != 0){
                    $Instruc -> bindParam(":id_depen", $IdDepen, PDO::PARAM_INT);
                }
            }elseif($Accion == "VER_DEPENDENCIA_OFICINA"){
                
                 $Dependencia = "";
                if($IdDepen != 0){
                    $Dependencia = " AND `ofi_respon`.`id_depen` =  :id_depen";
                }
                
                $Sql = "SELECT COUNT(`radi`.`id_radica`) AS `Total`, `depen_respon`.`nom_depen`, `ofi_respon`.`nom_oficina`
                        FROM `archivo_radica_interna_responsa` AS `radi_respon`
                            INNER JOIN `archivo_radica_interna` AS `radi` ON (`radi_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `respon_deta` ON (`radi_respon`.`id_funcio` = `respon_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `respon` ON (`respon_deta`.`id_funcio` = `respon`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi_respon` ON (`respon_deta`.`id_oficina` = `ofi_respon`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen_respon` ON (`ofi_respon`.`id_depen` = `depen_respon`.`id_depen`)
                        WHERE (`radi`.`fechor_radica` BETWEEN :fecha_ini AND :fecha_fin AND `radi_respon`.`respon` = 1 ".$Dependencia.")
                        GROUP BY `respon`.`nom_funcio`, `respon`.`ape_funcio`, `depen_respon`.`nom_depen`, `ofi_respon`.`nom_oficina`
                        ORDER BY `depen_respon`.`nom_depen` ASC, `ofi_respon`.`nom_oficina` ASC;";
                            
                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":fecha_ini", $FechaIni, PDO::PARAM_STR);
                $Instruc -> bindParam(":fecha_fin", $FechaFin, PDO::PARAM_STR);
                if($IdDepen != 0){
                    $Instruc -> bindParam(":id_depen", $IdDepen, PDO::PARAM_INT);
                }
            }elseif($Accion == "VER_SERIE"){
                
                $Dependencia = "";
                if($IdDepen != 0){
                    $Dependencia = " AND `ofi_desti`.`id_depen =  :id_depen";
                }

                $Sql = "SELECT COUNT(`radi`.`id_radica`) AS `Total`, `archivo_trd_series`.`nom_serie`
                        FROM `archivo_radica_interna_destinata` AS `radi_desti`
                            INNER JOIN `archivo_radica_interna` AS `radi` ON (`radi_desti`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `desti_deta` ON (`radi_desti`.`id_funcio_deta` = `desti_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `desti` ON (`desti_deta`.`id_funcio` = `desti`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi_desti` ON (`desti_deta`.`id_oficina` = `ofi_desti`.`id_oficina`)
                            INNER JOIN `archivo_trd_series` ON (`radi`.`id_serie` = `archivo_trd_series`.`id_serie`)
                        WHERE (`radi`.`fechor_radica` BETWEEN :fecha_ini AND :fecha_fin)
                        GROUP BY `archivo_trd_series`.`nom_serie`
                        ORDER BY `Total` DESC";
                            
                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":fecha_ini", $FechaIni, PDO::PARAM_STR);
                $Instruc -> bindParam(":fecha_fin", $FechaFin, PDO::PARAM_STR);
                if($IdDepen != 0){
                    $Instruc -> bindParam(":id_depen", $IdDepen, PDO::PARAM_INT);
                }
            }elseif($Accion == "VER_SUB_SERIE"){
                
                $Dependencia = "";
                if($IdDepen != 0){
                    $Dependencia = " AND `ofi_desti`.`id_depen` =  :id_depen";
                }

                $Sql = "SELECT COUNT(`radi`.`id_radica`) AS `Total`, `subserie`.`nom_subserie`
                        FROM `archivo_radica_interna_destinata` AS `radi_desti`
                            INNER JOIN `archivo_radica_interna` AS `radi` ON (`radi_desti`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `desti_deta` ON (`radi_desti`.`id_funcio_deta` = `desti_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `desti` ON (`desti_deta`.`id_funcio` = `desti`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi_desti` ON (`desti_deta`.`id_oficina` = `ofi_desti`.`id_oficina`)
                            INNER JOIN `archivo_trd_subserie` AS `subserie` ON (`radi`.`id_subserie` = `subserie`.`id_subserie`)
                        WHERE (`radi`.`fechor_radica` BETWEEN :fecha_ini AND :fecha_fin)
                        GROUP BY `subserie`.`nom_subserie`
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
                    $Dependencia = " AND `ofi_desti`.`id_depen` =  :id_depen";
                }

                $Sql = "SELECT COUNT(`radi`.`id_radica`) AS `Total`, `tip_docu`.`nom_tipodoc`
                        FROM `archivo_radica_interna_destinata` AS `radi_desti`
                            INNER JOIN `archivo_radica_interna` AS `radi` ON (`radi_desti`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `desti_deta` ON (`radi_desti`.`id_funcio_deta` = `desti_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `desti` ON (`desti_deta`.`id_funcio` = `desti`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi_desti` ON (`desti_deta`.`id_oficina` = `ofi_desti`.`id_oficina`)
                            INNER JOIN `archivo_trd_tipo_docu` AS `tip_docu` ON (`radi`.`id_tipodoc` = `tip_docu`.`id_tipodoc`)
                        WHERE (`radi`.`fechor_radica` BETWEEN :fecha_ini AND :fecha_fin)
                        GROUP BY `tip_docu`.`nom_tipodoc`
                        ORDER BY `Total` DESC";
                            
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