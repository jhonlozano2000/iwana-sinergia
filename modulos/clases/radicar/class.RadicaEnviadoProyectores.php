<?php
class RadicadoEnviadoProyector
{
    //Atributos
    private $Accion;
    private $IdRadicado;
    private $IdFuncio;
    private $FecHorAsigna;

    public function __construct($Accion = null, $IdRadicado = null, $IdFuncio = null, $FecHorAsigna = null)
    {
        $this->Accion        = $Accion;
        $this->IdRadicado         = $IdRadicado;
        $this->IdFuncio      = $IdFuncio;
        $this->FecHorAsigna  = $FecHorAsigna;
    }

    public function get_IdRadica()
    {
        return $this->IdRadicado;
    }

    public function get_IdFuncio()
    {
        return $this->IdFuncio;
    }

    public function get_FecHorAsigna()
    {
        return $this->FecHorAsigna;
    }


    // FUNCIONES PARA ENVIAR VALORES //
    public function set_Accion($Accion)
    {
        return $this->Accion = $Accion;
    }

    public function set_IdRadica($IdRadicado)
    {
        return $this->IdRadicado = $IdRadicado;
    }

    public function set_IdFuncio($IdFuncio)
    {
        return $this->IdFuncio = $IdFuncio;
    }

    public function set_FecHorAsigna($FecHorAsigna)
    {
        return $this->FecHorAsigna = $FecHorAsigna;
    }

    //Metodos
    public function Gestionar()
    {
        $conexion = new Conexion();
        $conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try {
            if ($this->Accion == 'NUEVO_PROYECTOR') {
                $Sql = 'INSERT INTO archivo_radica_enviados_proyector(id_radica, id_funcio_deta, fechor_asigna)
                        VALUES(:id_radica, :id_funcio_deta, :fechor_asigna)';

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':id_radica', $this->IdRadicado, PDO::PARAM_INT);
                $Instruc->bindParam(':id_funcio_deta', $this->IdFuncio, PDO::PARAM_INT);
                $Instruc->bindParam(':fechor_asigna', $this->FecHorAsigna, PDO::PARAM_STR);
            } elseif ($this->Accion == 'ELIMINAR_PROYECTORES') {
                $Sql = "DELETE 
                        FROM archivo_radica_enviados_proyector 
                        WHERE id_radica = :id_radica";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
            }

            $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            $this->IdTemp = $conexion->lastInsertId();
            $conexion = null;

            if ($Instruc) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo 'Ha surgido un error y no se puede ejecutar la consulta en Radicado enviados Proyectores. ' . $e->getMessage();
            exit;
        }
    }

    public static function Listar($Accion, $IdRadica, $IdFuncio, $IdDepen, $IdOfi, $Criterio1, $Criterio2, $Criterio3)
    {
        $conexion = new Conexion();

        try {
            if ($Accion == 1) {
                /******************************************************************************************/
                /*  LISTO LOS PROYECTORES DE UN RADICADO
                /******************************************************************************************/
                $Sql = "SELECT `radi_proyec`.`id_radica`, `proyec`.`nom_funcio`, `proyec`.`ape_funcio`, `ofi`.`nom_oficina`, `depn`.`nom_depen`
                        FROM `archivo_radica_enviados_proyector` AS `radi_proyec`
                            INNER JOIN `gene_funcionarios_deta` AS `proyec_deta` ON (`radi_proyec`.`id_funcio_deta` = `proyec_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `proyec` ON (`proyec_deta`.`id_funcio` = `proyec`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`proyec_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depn` ON (`ofi`.`id_depen` = `depn`.`id_depen`)
                        WHERE (`radi_proyec`.`id_radica` = :id_radica)";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':id_radica', $IdRadica, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            }

            $Result = $Instruc->fetchAll();
            $conexion = null;
            return $Result;
        } catch (PDOException $e) {
            echo 'Ha surgido un error y no se puede ejecutar la consulta en Proyectores Radicado enviados Temp.' . $e->getMessage();
            exit;
        }
    }

    public static function Buscar($Accion, $IdTemp, $IdFuncio)
    {
        $conexion = new Conexion();
        $conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try {
            if ($Accion == 1) {
                $Sql = "SELECT * 
                        FROM archivo_radica_enviados_proyector 
                        WHERE id_radica = :id_radica";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':id_radica', $IdTemp, PDO::PARAM_INT);
            } elseif ($Accion == 2) {
                $Sql = "SELECT * 
                        FROM archivo_radica_enviados_proyector 
                        WHERE id_funcio_deta = :id_funcio_deta";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':id_funcio_deta', $IdFuncio, PDO::PARAM_STR);
            }

            $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            $Result = $Instruc->fetch();
            $conexion = null;

            if ($Result) {
                return new self("", $Result['id_radica'], $Result['id_funcio_deta'], $Result['fechor_asigna']);
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo 'Ha surgido un error y no se puede ejecutar la consulta en Radicado enviados Temp.' . $e->getMessage();
            exit;
        }
    }
}
