<?php
class RadicadoInternoIndicadores{
    
    public static function Listar($Accion, $IdRadicado, $IdFuncioDeta, $IdFuncio, $IdDepen, $IdOfi, $Criterio1, $Criterio2, $Criterio3){
        $conexion = new Conexion();
                
        try{
           if($Accion == 'TOTAL_POR_RESPONDE'){
                
                $Sql = "SELECT COUNT(`id_radica`) AS 'Total'
                        FROM `archivo_radica_interna` AS `radi`
                        WHERE (`requie_respuesta` IS NULL)";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($Accion == 'TOTAL_RADICADOS'){
                $Sql = "SELECT COUNT(`id_radica`) AS 'Total'
                        FROM `archivo_radica_interna` AS `radi`";

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