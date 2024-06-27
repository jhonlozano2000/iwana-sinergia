<?php
class TRD{
    private $Accion;
	private $IdTRD;
	private $IdDependencia;
    private $IdOficina;
    private $IdSerie;
    private $IdSubSerie;
    private $ag;
    private $ac;
    private $ct;
    private $e;
    private $dm;
    private $s;
    private $Observa;
    private $Acti;

    public function __construct($Accion=null, $IdTRD = null, $IdDependencia = null, $IdOficina =null, $IdSerie = null, $IdSubSerie = null, $ag = null,
                                $ac = null, $ct = null, $e = null, $dm = null, $s = null, $Observa = null, $Acti = null){
        $this -> Accion        = $Accion;
        $this -> IdTRD         = $IdTRD;
        $this -> IdDependencia = $IdDependencia;
        $this -> IdOficina     = $IdOficina;
        $this -> IdSerie       = $IdSerie;
        $this -> IdSubSerie    = $IdSubSerie;
        $this -> ag            = $ag;
        $this -> ac            = $ac;
        $this -> ct            = $ct;
        $this -> e             = $e;
        $this -> dm            = $dm;
        $this -> s             = $s;
        $this -> Observa       = $Observa;
        $this -> Acti          = $Acti;
	}

    public function get_IdTRD(){
        return $this-> IdTRD;
    }

    public function get_IdDependencia(){
        return $this-> IdDependencia;
    }

    public function get_IdOficina(){
        return $this-> IdOficina;
    }

    public function get_IdSerie(){
        return $this-> IdSerie;
    }

    public function get_IdSubSerie(){
        return $this-> IdSubSerie;
    }

    public function get_ag(){
        return $this-> ag;
    }

    public function get_ac(){
        return $this-> ac;
    }

    public function get_ct(){
        return $this-> ct;
    }

    public function get_e(){
        return $this-> e;
    }

    public function get_dm(){
        return $this-> dm;
    }

    public function get_s(){
        return $this-> s;
    }

     public function get_Observa(){
        return $this-> Observa;
    }

     public function get_Acti(){
        return $this-> Acti;
    }

    ////////////////////////////////////////////
    public function setAccion($Accion){
        $this->Accion = $Accion;
    }

    public function set_IdTRD($IdTRD){
        return $this-> IdTRD = $IdTRD;
    }

    public function set_IdDependencia($IdDependencia){
        return $this-> IdDependencia = $IdDependencia;
    }

    public function set_IdOficina($IdOficina){
        return $this-> IdOficina = $IdOficina;
    }

    public function set_IdSerie($IdSerie){
        return $this-> IdSerie = $IdSerie;
    }

    public function set_IdSubSerie($IdSubSerie){
        return $this-> IdSubSerie = $IdSubSerie;
    }

    public function set_ag($ag){
        return $this-> ag = $ag;
    }

    public function set_ac($ac){
        return $this-> ac = $ac;
    }

    public function set_ct($ct){
        return $this-> ct = $ct;
    }

    public function set_e($e){
        return $this-> e = $e;
    }

    public function set_dm($dm){
        return $this-> dm = $dm;
    }

    public function set_s($s){
        return $this-> s = $s;
    }

     public function set_Observa($Observa){
        return $this-> Observa = $Observa;
    }

     public function set_Acti($Acti){
        return $this-> Acti = $Acti;
    }

    public function Gestionar(){
        $conexion = new Conexion();

        try{
            $ParameIdOficina = PDO::PARAM_INT;
            if($this->IdOficina == NULL){
                $ParameIdOficina =  PDO::PARAM_NULL;
            }

            if($this->Accion == 'INSERTAR'){

                $Sql = "INSERT INTO `archivo_trd`(`id_depen`, `id_oficina`, `id_serie`,`id_subserie`,`ag`,`ac`,`ct`,`e`,`dm`,`s`,`observa`,`acti`)
                        VALUES (:id_depen, :id_oficina, :id_serie, :id_subserie, :ag, :ac, :ct, :e, :dm, :s, :observa, 1)";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_depen', $this->IdDependencia, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_oficina', $this->IdOficina, $ParameIdOficina);
                $Instruc -> bindParam(':id_serie', $this->IdSerie, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_subserie', $this->IdSubSerie, PDO::PARAM_INT);
                $Instruc -> bindParam(':ag', $this->ag, PDO::PARAM_INT);
                $Instruc -> bindParam(':ac', $this->ac, PDO::PARAM_INT);
                $Instruc -> bindParam(':ct', $this->ct, PDO::PARAM_INT);
                $Instruc -> bindParam(':e', $this->e, PDO::PARAM_INT);
                $Instruc -> bindParam(':dm', $this->dm, PDO::PARAM_INT);
                $Instruc -> bindParam(':s', $this->s, PDO::PARAM_INT);
                $Instruc -> bindParam(':observa', $this->Observa, PDO::PARAM_STR);

            }if($this->Accion == 'EDITAR'){
                $Sql = "UPDATE `archivo_trd`
                        SET `id_trd` = :id_trd, `id_depen` = :id_depen, `id_serie` = :id_serie, `id_subserie` = :id_subserie, `ag` = :ag,
                          `ac` = :ac, `ct` = :ct, `e` = :e, `dm` = :dm, `s` = :s, `observa` = :observa, `acti` = :acti
                        WHERE `id_trd` = :id_trd";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_depen', $this->IdDependencia, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_serie', $this->IdSerie, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_subserie', $this->IdSubSerie, PDO::PARAM_INT);
                $Instruc -> bindParam(':ag', $this->ag, PDO::PARAM_INT);
                $Instruc -> bindParam(':ac', $this->ac, PDO::PARAM_INT);
                $Instruc -> bindParam(':ct', $this->ct, PDO::PARAM_STR);
                $Instruc -> bindParam(':e', $this->e, PDO::PARAM_STR);
                $Instruc -> bindParam(':dm', $this->dm, PDO::PARAM_STR);
                $Instruc -> bindParam(':s', $this->s, PDO::PARAM_STR);
                $Instruc -> bindParam(':observa', $this->Observa, PDO::PARAM_STR);
                $Instruc -> bindParam(':acti', $this->Acti, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_trd', $this->IdTRD, PDO::PARAM_INT);

            }if($this->Accion == 'ACTIVAR_TRD'){
                $Sql = "UPDATE `archivo_trd`
                        SET `acti` = :acti
                        WHERE `id_trd` = :id_trd";
                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':acti', $this->Acti, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_trd', $this->IdTRD, PDO::PARAM_INT);
            }if($this->Accion == 'GESTIONAR_RETENCION_AG'){
                $Sql = "UPDATE `archivo_trd`
                        SET `ag` = :ag
                        WHERE `id_trd` = :id_trd";
                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':ag', $this->ag, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_trd', $this->IdTRD, PDO::PARAM_INT);
            }if($this->Accion == 'GESTIONAR_RETENCION_AC'){
                $Sql = "UPDATE `archivo_trd`
                        SET `ac` = :ac
                        WHERE `id_trd` = :id_trd";
                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':ac', $this->ac, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_trd', $this->IdTRD, PDO::PARAM_INT);
            }if($this->Accion == 'GESTIONAR_DISPO_FINAL_CT'){
                $Sql = "UPDATE `archivo_trd`
                        SET `ct` = :ct
                        WHERE `id_trd` = :id_trd";
                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':ct', $this->ct, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_trd', $this->IdTRD, PDO::PARAM_INT);
            }if($this->Accion == 'GESTIONAR_DISPO_FINAL_E'){
                $Sql = "UPDATE `archivo_trd`
                        SET `e` = :e
                        WHERE `id_trd` = :id_trd";
                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':e', $this->e, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_trd', $this->IdTRD, PDO::PARAM_INT);
            }if($this->Accion == 'GESTIONAR_DISPO_FINAL_DM'){
                $Sql = "UPDATE `archivo_trd`
                        SET `dm` = :dm
                        WHERE `id_trd` = :id_trd";
                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':dm', $this->dm, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_trd', $this->IdTRD, PDO::PARAM_INT);
            }if($this->Accion == 'GESTIONAR_DISPO_FINAL_S'){
                $Sql = "UPDATE `archivo_trd`
                        SET `s` = :s
                        WHERE `id_trd` = :id_trd";
                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':s', $this->s, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_trd', $this->IdTRD, PDO::PARAM_INT);
            }

            $Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
            $this-> IdDigital = $conexion -> lastInsertId();
            $conexion = null;

            if($Instruc){
                return true;
            }else{
                return false;
            }

        }catch(PDOException $e){
            echo 'Ha surgido un error y no se puede ejecutar la consulta.'.$e->getMessage();
            exit;
        }
    }

    public static function Listar($Accion, $Id, $IdDepen, $IdSerie, $IdSubSerie){
        $conexion = new Conexion();

        try{

            $Sql = "SELECT TRD.id_trd, Depen.id_depen, Depen.cod_depen, Depen.cod_corres, Depen.nom_depen, Seri.id_serie, Seri.cod_serie,
                        Seri.nom_serie, Seri.acti AS acti_serie, TRD.ag, TRD.ac, TRD.ct, TRD.e, TRD.dm, TRD.s, TRD.observa, TRD.acti AS acti_trd,
                        Sub.id_subserie, Sub.cod_subserie, Sub.nom_subserie, Sub.acti AS acti_sub, SubDeta.acti AS acti_doc_deta, TipDoc.id_tipodoc,
                        TipDoc.nom_tipodoc, TipDoc.plantilla, TipDoc.acti AS acti_doc
                    FROM archivo_trd AS TRD
                        INNER JOIN areas_dependencias AS Depen ON (TRD.id_depen = Depen.id_depen)
                        INNER JOIN archivo_trd_series AS Seri ON (TRD.id_serie = Seri.id_serie)
                        INNER JOIN archivo_trd_subserie AS Sub ON (TRD.id_subserie = Sub.id_subserie)
                        LEFT JOIN archivo_trd_subserie_docu AS SubDeta ON (SubDeta.id_subserie = Sub.id_subserie)
                        LEFT JOIN archivo_trd_tipo_docu AS TipDoc ON (SubDeta.id_tipodoc = TipDoc.id_tipodoc) ";

            if($Accion == 1){
                /******************************************************************************************/
                /*  LISTO TODOS LOS REGISTROS
                /******************************************************************************************/
                $Sql = "SELECT DISTINCT archivo_trd.id_trd, areas_dependencias.id_depen, areas_dependencias.cod_depen, areas_dependencias.cod_corres,
                            areas_dependencias.nom_depen, archivo_trd_series.id_serie, archivo_trd_series.cod_serie, archivo_trd_series.nom_serie,
                            archivo_trd_series.acti AS acti_serie, archivo_trd_subserie.id_subserie, archivo_trd_subserie.cod_subserie,
                            archivo_trd_subserie.nom_subserie, archivo_trd_subserie.acti AS acti_subserie, archivo_trd.ag, archivo_trd.ac,
                            archivo_trd.ct, archivo_trd.e, archivo_trd.dm, archivo_trd.s, archivo_trd.observa, archivo_trd.acti AS acti_trd
                        FROM archivo_trd
                            INNER JOIN areas_dependencias ON (archivo_trd.id_depen = areas_dependencias.id_depen)
                            INNER JOIN archivo_trd_series ON (archivo_trd.id_serie = archivo_trd_series.id_serie)
                            INNER JOIN archivo_trd_subserie ON (archivo_trd.id_subserie = archivo_trd_subserie.id_subserie)
                        ORDER BY areas_dependencias.nom_depen ASC";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($Accion == 2){
                /******************************************************************************************/
                /*  LISTO UN REGISTROS
                /******************************************************************************************/

                $Sql.="WHERE TRD.id_trd = :id_trd";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_trd', $Id, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($Accion == 3){
                /******************************************************************************************/
                /*  LISTO LAS SUBSERIES POR DEPENDENCIA Y POR SERIE
                /******************************************************************************************/
                $Sql = "SELECT DISTINCT Sub.id_subserie, TRD.acti, Sub.cod_subserie, Sub.nom_subserie, TRD.acti, TRD.ag, TRD.ac, TRD.ct, TRD.e, TRD.dm, TRD.s
                        FROM archivo_trd AS TRD
                            INNER JOIN areas_dependencias AS Depen ON (TRD.id_depen = Depen.id_depen)
                            INNER JOIN archivo_trd_series AS Seri ON (TRD.id_serie = Seri.id_serie)
                            INNER JOIN archivo_trd_subserie AS Sub ON (TRD.id_subserie = Sub.id_subserie)
                            LEFT JOIN archivo_trd_subserie_docu AS SubDeta ON (SubDeta.id_subserie = Sub.id_subserie)
                            LEFT JOIN archivo_trd_tipo_docu AS TipDoc ON (SubDeta.id_tipodoc = TipDoc.id_tipodoc)
                        WHERE Depen.id_depen = :id_depen AND TRD.id_serie = :id_serie";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_depen', $IdDepen, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_serie', $IdSerie, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));

            }elseif($Accion == 4){
                /******************************************************************************************/
                /*  LISTO LA TRD POR DEPENDNECIA, SERIE Y SUBSERIR
                /******************************************************************************************/
                $Sql.="WHERE Depen.id_depen = :id_depen AND TRD.d_serie = :d_serie AND TRD.id_subserie = :id_subserie";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_depen', $IdDepen, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_serie', $IdSerie, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_subserie', $IdSubSerie, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));

            }elseif($Accion == 5){
                /******************************************************************************************/
                /*  LISTO LA TRD POR DEPENDENCIA
                /******************************************************************************************/
                $Sql = "SELECT `archivo_trd`.`id_trd`, `areas_dependencias`.`cod_depen`, `archivo_trd_series`.`id_serie`, `archivo_trd_series`.`cod_serie`, `archivo_trd_series`.`nom_serie`,
                            `archivo_trd_subserie`.`id_subserie`, `archivo_trd_subserie`.`cod_subserie`, `archivo_trd_subserie`.`nom_subserie`, `archivo_trd`.`ag`,
                            `archivo_trd`.`ac`, `archivo_trd`.`ct`, `archivo_trd`.`e`, `archivo_trd`.`dm`, `archivo_trd`.`s`, `archivo_trd`.`observa`, `archivo_trd`.`acti`
                        FROM `archivo_trd`
                            INNER JOIN `archivo_trd_series` ON (`archivo_trd`.`id_serie` = `archivo_trd_series`.`id_serie`)
                            INNER JOIN `archivo_trd_subserie` ON (`archivo_trd`.`id_subserie` = `archivo_trd_subserie`.`id_subserie`)
                            INNER JOIN `areas_dependencias` ON (`archivo_trd`.`id_depen` = `areas_dependencias`.`id_depen`)
                        WHERE (`archivo_trd`.`id_depen` = :id_depen)
                        ORDER BY `archivo_trd_series`.`nom_serie`, `archivo_trd_subserie`.`nom_subserie` ASC";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_depen', $IdDepen, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));

            }elseif($Accion == 6){

                /******************************************************************************************/
                /*  LISTO LA SERIES ACTIVAS POR DEPENDENCIA
                /******************************************************************************************/
                $Sql = "SELECT DISTINCT Seri.id_serie, Seri.cod_serie, Seri.nom_serie
                        FROM archivo_trd AS TRD
                            INNER JOIN areas_dependencias AS Depen ON (TRD.id_depen = Depen.id_depen)
                            INNER JOIN archivo_trd_series AS Seri ON (TRD.id_serie = Seri.id_serie)
                            INNER JOIN archivo_trd_subserie AS Sub ON (TRD.id_subserie = Sub.id_subserie)
                            LEFT JOIN archivo_trd_subserie_docu AS SubDeta ON (SubDeta.id_subserie = Sub.id_subserie)
                            LEFT JOIN archivo_trd_tipo_docu AS TipDoc ON (SubDeta.id_tipodoc = TipDoc.id_tipodoc)
                        WHERE TRD.id_depen = :id_depen AND TRD.acti = 1 AND Seri.acti = 1";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_depen', $IdDepen, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($Accion == 7){
                /******************************************************************************************/
                /*  LISTO LOS TIPOS DOCUMENTALES ACTIVOS DE UNA SUBSERIE POR MEDIO DE UNA TRD
                /******************************************************************************************/
                $Sql = "SELECT DISTINCT `tipo_docu`.`id_tipodoc`, `tipo_docu`.`nom_tipodoc`, `trd`.`id_subserie`
                        FROM `archivo_trd` AS `trd`
                            INNER JOIN `archivo_trd_subserie` AS `sub_serie` ON (`trd`.`id_subserie` = `sub_serie`.`id_subserie`)
                            INNER JOIN `archivo_trd_subserie_docu` AS `sub_serie_deta` ON (`sub_serie_deta`.`id_subserie` = `sub_serie`.`id_subserie`)
                            INNER JOIN `archivo_trd_tipo_docu` AS `tipo_docu` ON (`sub_serie_deta`.`id_tipodoc` = `tipo_docu`.`id_tipodoc`)
                        WHERE (`trd`.`id_depen` = :id_depen AND `trd`.`id_serie` = :id_serie AND `trd`.`id_subserie` = :id_subserie
                            AND `sub_serie`.`acti` = 1 AND `sub_serie_deta`.`acti` = 1 AND `tipo_docu`.`acti` = 1)";


                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_depen', $IdDepen, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_serie', $IdSerie, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_subserie', $IdSubSerie, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($Accion == 8){
                /******************************************************************************************/
                /*  LISTO LOS TIPOS DOCUMENTALES ACTIVOS DE UNA SUBSERIE
                /******************************************************************************************/
                $Sql.="SELECT *
                        FROM archivo_trd_subserie
                        WHERE acti = 1
                        ORDER BY nom_subserie";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));

            }elseif($Accion == 9){
                /******************************************************************************************/
                /*  LISTO LAS SUBSERIES ACTIVAS DE UNA SERIE POR MEDIO DE UNA TRD
                /******************************************************************************************/
                $Sql = "SELECT DISTINCT `archivo_trd_subserie`.`id_subserie`, `archivo_trd_subserie`.`cod_subserie`, `archivo_trd_subserie`.`nom_subserie`
                        FROM `archivo_trd`
                            INNER JOIN `archivo_trd_subserie` ON (`archivo_trd`.`id_subserie` = `archivo_trd_subserie`.`id_subserie`)
                        WHERE (`archivo_trd_subserie`.`acti` = 1 AND `archivo_trd`.`acti` = 1 AND `archivo_trd`.`id_depen` = :id_depen
                            AND `archivo_trd`.`id_serie` = :id_serie)";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_depen', $IdDepen, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_serie', $IdSerie, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));

            }elseif($Accion == 10){
                /******************************************************************************************/
                /*  LISTO TODOS LOS REGISTROS
                /******************************************************************************************/
                $Sql = "SELECT TRD.id_trd, Depen.id_depen, Depen.cod_depen, Depen.cod_corres, Depen.nom_depen, Seri.id_serie, Seri.cod_serie,
                        Seri.nom_serie, Seri.acti AS acti_serie, TRD.ag, TRD.ac, TRD.ct, TRD.e, TRD.dm, TRD.s, TRD.observa, TRD.acti AS acti_trd,
                        Sub.id_subserie, Sub.cod_subserie, Sub.nom_subserie, Sub.acti AS acti_sub, SubDeta.acti AS acti_doc_deta, TipDoc.id_tipodoc,
                        TipDoc.nom_tipodoc, TipDoc.plantilla, TipDoc.acti AS acti_doc
                    FROM archivo_trd AS TRD
                        INNER JOIN areas_dependencias AS Depen ON (TRD.id_depen = Depen.id_depen)
                        INNER JOIN archivo_trd_series AS Seri ON (TRD.id_serie = Seri.id_serie)
                        INNER JOIN archivo_trd_subserie AS Sub ON (TRD.id_subserie = Sub.id_subserie)
                        LEFT JOIN archivo_trd_subserie_docu AS SubDeta ON (SubDeta.id_subserie = Sub.id_subserie)
                        LEFT JOIN archivo_trd_tipo_docu AS TipDoc ON (SubDeta.id_tipodoc = TipDoc.id_tipodoc)
                        ORDER BY Depen.cod_depen ASC,  Depen.nom_depen";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($Accion == 11){
                /******************************************************************************************/
                /*  LISTO LOS TIPOS DOCUMENTALES ACTIVOS DE UNA SUBSERIE
                /******************************************************************************************/
                $Sql = "SELECT DISTINCT TipDoc.id_tipodoc, TipDoc.nom_tipodoc
                        FROM archivo_trd AS TRD
                            INNER JOIN areas_dependencias AS Depen ON (TRD.id_depen = Depen.id_depen)
                            INNER JOIN archivo_trd_series AS Seri ON (TRD.id_serie = Seri.id_serie)
                            INNER JOIN archivo_trd_subserie AS Sub ON (TRD.id_subserie = Sub.id_subserie)
                            LEFT JOIN archivo_trd_subserie_docu AS SubDeta ON (SubDeta.id_subserie = Sub.id_subserie)
                            LEFT JOIN archivo_trd_tipo_docu AS TipDoc ON (SubDeta.id_tipodoc = TipDoc.id_tipodoc)
                        WHERE Sub.id_subserie = :id_subserie";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_subserie', $IdSubSerie, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($Accion == 12){
                /******************************************************************************************/
                /*  LISTO LA TRD POR DEPENDENCIA Y OFICINA
                /******************************************************************************************/
                 $Sql = "SELECT `archivo_trd`.`id_trd`, `areas_dependencias`.`cod_depen`, `areas_oficinas`.`cod_oficina`, `archivo_trd_series`.`id_serie`,
                            `archivo_trd_series`.`cod_serie`, `archivo_trd_series`.`nom_serie`, `archivo_trd_subserie`.`id_subserie`,
                            `archivo_trd_subserie`.`cod_subserie`, `archivo_trd_subserie`.`nom_subserie`, `archivo_trd`.`ag`, `archivo_trd`.`ac`,
                            `archivo_trd`.`ct`, `archivo_trd`.`e`, `archivo_trd`.`dm`, `archivo_trd`.`s`, `archivo_trd`.`observa`, `archivo_trd`.`acti`
                        FROM `archivo_trd`
                            INNER JOIN `archivo_trd_series` ON (`archivo_trd`.`id_serie` = `archivo_trd_series`.`id_serie`)
                            INNER JOIN `archivo_trd_subserie` ON (`archivo_trd`.`id_subserie` = `archivo_trd_subserie`.`id_subserie`)
                            INNER JOIN `areas_dependencias` ON (`archivo_trd`.`id_depen` = `areas_dependencias`.`id_depen`)
                            LEFT JOIN `areas_oficinas` ON (`archivo_trd`.`id_oficina` = `areas_oficinas`.`id_oficina`)
                        WHERE (`archivo_trd`.`id_depen` = :id_depen AND `archivo_trd`.`id_oficina` = :id_oficina)
                        ORDER BY `archivo_trd_series`.`nom_serie`, `archivo_trd_subserie`.`nom_subserie` ASC";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_depen', $IdDepen, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_oficina', $IdSerie, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($Accion == 13){

                /******************************************************************************************/
                /*  LISTO LA TRD POR DEPENDENCIA Y OFICINA
                /******************************************************************************************/

                $Oficina = "";
                if($IdSerie != ""){
                    $Oficina = "AND `archivo_trd`.`id_oficina` = :id_oficina";
                }else{
                    $Oficina = "";
                }

                $Sql = "SELECT DISTINCT `archivo_trd_series`.`id_serie`, `archivo_trd_series`.`cod_serie`, `archivo_trd_series`.`nom_serie`
                        FROM `archivo_trd`
                            INNER JOIN `archivo_trd_series` ON (`archivo_trd`.`id_serie` = `archivo_trd_series`.`id_serie`)
                            INNER JOIN `archivo_trd_subserie` ON (`archivo_trd`.`id_subserie` = `archivo_trd_subserie`.`id_subserie`)
                            INNER JOIN `areas_dependencias` ON (`archivo_trd`.`id_depen` = `areas_dependencias`.`id_depen`)
                            LEFT JOIN `areas_oficinas` ON (`archivo_trd`.`id_oficina` = `areas_oficinas`.`id_oficina`)
                        WHERE (`archivo_trd`.`id_depen` = :id_depen ". $Oficina.")
                        ORDER BY `archivo_trd_series`.`nom_serie` ASC";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_depen', $IdDepen, PDO::PARAM_INT);
                if($IdSerie != ""){
                    $Instruc -> bindParam(':id_oficina', $IdSerie, PDO::PARAM_INT);
                }
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($Accion == 14){
                /******************************************************************************************/
                /*  LISTO LAS SUBSERIES ACTIVAS DE UNA SERIE POR MEDIO DE UNA TRD POR DEPENDENCIA Y OFICINA
                /******************************************************************************************/
                $Sql = "SELECT DISTINCT `archivo_trd_subserie`.`id_subserie`, `archivo_trd_subserie`.`cod_subserie`, `archivo_trd_subserie`.`nom_subserie`
                        FROM `archivo_trd`
                            INNER JOIN `archivo_trd_subserie` ON (`archivo_trd`.`id_subserie` = `archivo_trd_subserie`.`id_subserie`)
                        WHERE (`archivo_trd_subserie`.`acti` = 1 AND `archivo_trd`.`acti` = 1 AND `archivo_trd`.`id_depen` = :id_depen
                            AND `archivo_trd`.`id_oficina` = :id_oficina AND `archivo_trd`.`id_serie` = :id_serie)";
                            //echo $IdDepen."-".$IdSubSerie."-".$IdSerie;
                            //exit();
                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_depen', $IdDepen, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_oficina', $IdSubSerie, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_serie', $IdSerie, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }

            $Result = $Instruc->fetchAll();
            $conexion = null;
            return $Result;
        }catch(PDOException $e){
            echo 'Ha surgido un error y no se puede ejecutar la consulta TRD - '.$Accion." - ".$e->getMessage();
            exit;
        }
    }

    public static function Buscar($Accion, $Id, $IdDepen, $IdSerie, $IdSubSerie) {
        $conexion = new Conexion();
        $conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try{

            if($Accion == 1){
                /******************************************************************************************/
                /*  SABER SY UNA TRD YA SE ENCUENTRA CONFIGURADA POR DEPENDENCIA
                /******************************************************************************************/

                $Sql = "SELECT *
                        FROM `archivo_trd`
                        WHERE (`id_depen` = :id_depen AND `id_serie` = :id_serie AND `id_subserie` = :id_subserie)";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_depen', $IdDepen, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_serie', $IdSerie, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_subserie', $IdSubSerie, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }elseif($Accion == 2){
                /******************************************************************************************/
                /*  SABER SY UNA TRD YA SE ENCUENTRA CONFIGURADA POR DEPENDENCIA Y OFICINA
                /******************************************************************************************/

                $Sql = "SELECT *
                        FROM `archivo_trd`
                        WHERE (`id_depen` = :id_depen AND `id_oficina` = :id_oficina AND `id_serie` = :id_serie AND `id_subserie` = :id_subserie)";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_depen', $IdDepen, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_oficina', $Id, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_serie', $IdSerie, PDO::PARAM_INT);
                $Instruc -> bindParam(':id_subserie', $IdSubSerie, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }


            $Result = $Instruc->fetch();
            $conexion = null;

            if($Result){
                return new self("", $Result['id_trd'], $Result['id_depen'], $Result['id_serie'],  $Result['id_subserie'], $Result['ag'],
                                $Result['ac'], $Result['ct'], $Result['e'], $Result['dm'], $Result['s'], $Result['observa']);
            }else{
                return false;
            }
        }catch(PDOException $e){
            echo 'Ha surgido un error y no se puede ejecutar la consulta.'.$e->getMessage();
            exit;
        }
    }
}
?>