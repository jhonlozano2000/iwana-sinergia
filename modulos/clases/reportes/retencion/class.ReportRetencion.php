<?php
class ReportRretencion{
    
    public static function Listar($Accion, $Criterio1, $Criterio2, $Criterio3){
        $conexion = new Conexion();

        try{
           
           if($Accion == 1){
                /******************************************************************************************/
                /*  LISTO LOS RADIACOD A LOS QUE LES HACEN FALTA EL ARCHIVO DIGITAL
                /******************************************************************************************/
                $Sql = "SELECT * 
                        FROM archivo_trd_series 
                        ORDER BY 2, 3";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($Accion == 2){
                /******************************************************************************************/
                /*  LISTO LOS RADIACOD A LOS QUE LES HACEN FALTA EL ARCHIVO DIGITAL
                /******************************************************************************************/
                $Sql = "SELECT archivo_trd_subserie.id_subserie, archivo_trd_subserie.cod_subserie, archivo_trd_subserie.nom_subserie
                            , archivo_trd_subserie.acti AS acti_subserie, archivo_trd_tipo_docu.nom_tipodoc, archivo_trd_subserie_docu.acti AS acti_docu
                        FROM archivo_trd_subserie_docu
                            INNER JOIN archivo_trd_subserie ON (archivo_trd_subserie_docu.id_subserie = archivo_trd_subserie.id_subserie)
                            INNER JOIN archivo_trd_tipo_docu ON (archivo_trd_subserie_docu.id_tipodoc = archivo_trd_tipo_docu.id_tipodoc) 
                        ORDER BY archivo_trd_subserie.cod_subserie, archivo_trd_subserie.nom_subserie DESC";

                $Instruc = $conexion->prepare($Sql);
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