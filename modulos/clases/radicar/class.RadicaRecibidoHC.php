<?php
class RadicadoRecibidoHC{
    //Atributos
    private $Accion;
    private $IdRadica;
    private $IdTercero;
    private $IdParenTercero;
    private $EnvioEmailTercer;
    private $EnvioEmailPacien;
    private $PeriodoDesde;
    private $PeriodoHasta;
    private $Servicio;
    private $Estado;
    private $Observa;

    public function __construct($Accion = null, $IdRadica = null, $IdTercero = null, $IdParenTercero = null, $EnvioEmailTercer = null, 
                                $EnvioEmailPacien = null, $PeriodoDesde = null, $PeriodoHasta = null, $Servicio = null, $Estado = null, $Observa = null){
        $this -> Accion           = $Accion;
        $this -> IdRadica         = $IdRadica;
        $this -> IdTercero        = $IdTercero;
        $this -> IdParenTercero   = $IdParenTercero;
        $this -> EnvioEmailTercer = $EnvioEmailTercer;
        $this -> EnvioEmailPacien = $EnvioEmailPacien;
        $this -> PeriodoDesde     = $PeriodoDesde;
        $this -> PeriodoHasta     = $PeriodoHasta;
        $this -> Servicio         = $Servicio;
        $this -> Estado           = $Estado;
        $this -> Observa          = $Observa;
    }

    public function get_IdRadica(){
        return $this -> IdRadica;
    }
    
    public function get_IdTercero(){
        return $this -> IdTercero;
    }

    public function get_IdParenTercero(){
        return $this -> IdParenTercero;
    }

    public function get_EnvioEmailTercer(){
        return $this -> EnvioEmailTercer;
    }

    public function get_EnvioEmailPacien(){
        return $this -> EnvioEmailPacien;
    }

    public function get_PeriodoDesde(){
        return $this -> PeriodoDesde;
    }

    public function get_PeriodoHasta(){
        return $this -> PeriodoHasta;
    }

    public function get_Servicio(){
        return $this -> Servicio;
    }

    public function get_Estado(){
        return $this -> Estado;
    }

    public function get_Observa(){
        return $this -> Observa;
    }

    // FUNCIONES PARA ENVIAR VALORES //
    public function set_Accion($Accion){
        return $this -> Accion = $Accion;
    }

    public function set_IdRadica($IdRadica){
        return $this -> IdRadica = $IdRadica;
    }
    
     public function set_IdTercero($IdTercero){
        return $this -> IdTercero = $IdTercero;
    }
    
    public function set_IdParenTercero($IdParenTercero){
        return $this -> IdParenTercero = $IdParenTercero;
    }
    
    public function set_EnvioEmailTercer($EnvioEmailTercer){
        return $this -> EnvioEmailTercer = $EnvioEmailTercer;
    }
    
    public function set_EnvioEmailPacien($EnvioEmailPacien){
        return $this -> EnvioEmailPacien = $EnvioEmailPacien;
    }
	
	public function set_PeriodoDesde($PeriodoDesde){
        return $this -> PeriodoDesde = $PeriodoDesde;
    }

    public function set_PeriodoHasta($PeriodoHasta){
        return $this -> PeriodoHasta = $PeriodoHasta;
    }

    public function set_Servicio($Servicio){
        return $this -> Servicio = $Servicio;
    }

    public function set_Estado($Estado){
        return $this -> Estado = $Estado;
    }

    public function set_Observa($Observa){
        return $this -> Observa = $Observa;
    }
    
    //Metodos
	public function Gestionar(){
        $conexion = new Conexion();
        $conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try{

            if($this->IdTercero === ""){
                $this->IdTercero = "NULL";
            }

    		if($this->Accion === "GUARDAR"){
    			
    			$Sql = 'INSERT INTO archivo_radica_recibidos_hc(id_radica, id_tercero_facul, id_paren_tercero, envio_email_tercero, envio_email_paciente, 
                            periodo_desde, periodo_hasta, servicio)
    					VALUES(:id_radica, :id_tercero_facul, :id_paren_tercero, :envio_email_tercero, :envio_email_paciente, 
                            :periodo_desde, :periodo_hasta, :servicio)';

                $Tercero = PDO::PARAM_INT;
                if (is_null($this->IdTercero) || $this->IdTercero == "NULL")
                    $Tercero = \PDO::PARAM_NULL;

                $ParentescoTercero = PDO::PARAM_INT;
                if (is_null($this->IdParenTercero) || $this->IdParenTercero == "NULL")
                    $ParentescoTercero = \PDO::PARAM_NULL; 

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
                $Instruc -> bindParam(':id_tercero_facul', $this->IdTercero, $Tercero);
                $Instruc -> bindParam(':id_paren_tercero', $this->IdParenTercero, $ParentescoTercero);
                $Instruc -> bindParam(':envio_email_tercero', $this->EnvioEmailTercer, PDO::PARAM_INT);
                $Instruc -> bindParam(':envio_email_paciente', $this->EnvioEmailPacien, PDO::PARAM_INT);
                $Instruc -> bindParam(':periodo_desde', $this->PeriodoDesde, PDO::PARAM_STR);
                $Instruc -> bindParam(':periodo_hasta', $this->PeriodoHasta, PDO::PARAM_STR);
                $Instruc -> bindParam(':servicio', $this->Servicio, PDO::PARAM_STR);

    		}elseif($this->Accion === "TRAMITAR"){
    			
    			$Sql = 'UPDATE `archivo_radica_recibidos_hc` 
                        SET `estado` = :estado
    					WHERE `id_radica` = :id_radica';

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':estado', $this->Estado, PDO::PARAM_STR);
                $Instruc -> bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
                
    		}elseif($this->Accion === "ENTREGAR"){
                
                $Sql = 'UPDATE `archivo_radica_recibidos_hc` 
                        SET `observa_entrega` = `:observa_entrega`
                        WHERE `id_radica` = `:id_radica`';

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(':observa_entrega', $this->Observa, PDO::PARAM_STR);
                $Instruc -> bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
            }

    		$Instruc -> execute() or die(print_r($Instruc -> errorInfo()." - ".$Sql, true));
            #$this-> IdDigital = $conexion -> lastInsertId();
            $conexion = null;   

            if($Instruc){
                return true;
            }else{
                return false;
            }
         }catch(PDOException $e){
            echo 'Ha surgido un error y no se puede ejecutar la consulta, Solicitud HC. '.$Sql." - ".$e->getMessage();
            exit;
        }
    }

    public static function Listar($Accion, $IdRadicado, $IdTerceroDeta){
        $conexion = new Conexion();
        $conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try{
           if($Accion == 1){
                /******************************************************************************************/
                /*  LISTO UN LOS FUNCIONARIOS DE UN RADICADO EN PARTICULAR
                /******************************************************************************************/
                $Sql = "SELECT `ra_hc`.`id_radica`, `ra_hc`.`id_tercero_facul`, `terce`.`nom_contac`, `remite`.`razo_soci`, `paren`.`nom_paren`, 
                            `ra_hc`.`envio_email_tercero`, `ra_hc`.`envio_email_paciente`, `ra_hc`.`PeriodoDesde`, `ra_hc`.`sericio`, `ra_hc`.`estado`, 
                            `ra_hc`.`observa_entrega`
                        FROM `archivo_radica_recibidos_hc` AS `ra_hc`
                            INNER JOIN `gene_terceros_contac` AS `terce` ON (`ra_hc`.`id_tercero_facul` = `terce`.`id_tercero`)
                            LEFT JOIN `gene_terceros_empresas` AS `remite` ON (`terce`.`id_empre` = `remite`.`id_empre`)
                            INNER JOIN `config_parentesco` AS `paren` ON (`ra_hc`.`id_paren_tercero` = `paren`.`id_paren`)
                        WHERE `ra_hc`.`id_radica` = :id_radica";

                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":id_radica", $IdRadicado, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            }
            
            $Result = $Instruc->fetchAll();
            $conexion = null;
            return $Result;
        }catch(PDOException $e){
            echo 'Ha surgido un error y no se puede ejecutar la consulta, Solicitud HC.'.$e->getMessage();
            exit;
        }
    }

    public static function Buscar($Accion, $IdRadicado, $IdTerceroDeta){
        $conexion = new Conexion();
        $conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try{
           if($Accion === 1){
                $Sql = "SELECT * FROM archivo_radica_recibidos_hc WHERE id_radica = :id_radica";
                $Instruc = $conexion->prepare($Sql);
                $Instruc -> bindParam(":id_radica", $IdRadicado, PDO::PARAM_STR);
            }

            $Instruc -> execute() or die(print_r($Instruc->errorInfo()." - ".$Sql, true));
            $Result = $Instruc->fetch();
            $conexion = null;

            if($Result){
                return new self("", $Result['id_radica'], $Result['id_tercero_facul'], $Result['id_paren_tercero'], $Result['envio_email_tercero'],
                    $Result['envio_email_paciente'], $Result['periodo_desde'], $Result['periodo_hasta'], $Result['servicio'], 
                    $Result['estado'], $Result['observa_entrega']);
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
