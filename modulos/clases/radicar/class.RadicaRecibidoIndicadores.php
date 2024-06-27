<?php
class RadicadoRecibidoIndicadores{
    
    public static function Listar($Accion, $IdRadicado, $IdFuncioDeta, $IdFuncio, $IdDepen, $IdOfi, $Criterio1, $Criterio2, $Criterio3){
        $conexion = new Conexion();
                
        try{
           if($Accion == 'TOTAL_POR_DIGITAL'){
                
                $Sql = "SELECT COUNT(`radi`.`id_radica`) AS 'Total'
                        FROM `archivo_radica_recibidos` AS `radi`
                            INNER JOIN `config_formaenvio` AS `forma_recibi` ON (`radi`.`id_forma_llegada` = `forma_recibi`.`id_formaenvio`)
                        WHERE (`forma_recibi`.`requie_digital` = 1 AND `radi`.`digital` = 0)";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($Accion == 'TOTAL_RADICADOS'){
                 $Sql = "SELECT COUNT(`radi`.`id_radica`) AS 'Total'
                        FROM `archivo_radica_recibidos` AS `radi`";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($Accion == 'TOTAL_POR_RESPONDE'){
                 $Sql = "SELECT COUNT(`id_radica`) AS 'Total'
                        FROM `archivo_radica_recibidos` AS `radi`
                        WHERE (`requie_respues` = 1 AND `respondido` = 0)";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }
            
            $Result = $Instruc->fetch();
            $conexion = null;
            return $Result;
        }catch(PDOException $e){
            echo 'Ha surgido un error y no se puede ejecutar la consulta, recibidos listar.'.$e->getMessage();
            exit;
        }
    } 
}
?>