<?php
class RadicadoRecibidoPase
{
    //Atributos
    private $Accion;
    private $IdPase;
    private $IdRadica;
    private $IdFuncioOrigen;
    private $FecHorPase;
    private $IdFuncioDestino;
    private $FecHorAcepta;

    public function __construct(
        $Accion = null,
        $IdPase = null,
        $IdRadica = null,
        $IdFuncioOrigen = null,
        $FecHorPase = null,
        $IdFuncioDestino = null,
        $FecHorAcepta = null
    ) {

        $this->Accion          = $Accion;
        $this->IdPase          = $IdPase;
        $this->IdRadica        = $IdRadica;
        $this->IdFuncioOrigen  = $IdFuncioOrigen;
        $this->FecHorPase      = $FecHorPase;
        $this->IdFuncioDestino = $IdFuncioDestino;
        $this->FecHorAcepta    = $FecHorAcepta;
    }

    public function get_IdPase()
    {
        return $this->IdPase;
    }

    public function get_IdRadica()
    {
        return $this->IdRadica;
    }

    public function get_IdFuncioOrigen()
    {
        return $this->IdFuncioOrigen;
    }

    public function get_FecHorPase()
    {
        return $this->FecHorPase;
    }

    public function get_IdFuncioDestino()
    {
        return $this->IdFuncioDestino;
    }

    public function get_FecHorAcepta()
    {
        return $this->FecHorAcepta;
    }

    // FUNCIONES PARA ENVIAR VALORES //
    public function set_Accion($Accion)
    {
        $this->Accion = $Accion;
    }

    public function set_IdPase($IdPase)
    {
        $this->IdPase = $IdPase;
    }

    public function set_IdRadica($IdRadica)
    {
        $this->IdRadica = $IdRadica;
    }

    public function set_IdFuncioOrigen($IdFuncioOrigen)
    {
        $this->IdFuncioOrigen = $IdFuncioOrigen;
    }

    public function set_FecHorPase($FecHorPase)
    {
        $this->FecHorPase = $FecHorPase;
    }

    public function set_IdFuncioDestino($IdFuncioDestino)
    {
        $this->IdFuncioDestino = $IdFuncioDestino;
    }

    public function set_FecHorAcepta($FecHorAcepta)
    {
        $this->FecHorAcepta = $FecHorAcepta;
    }

    //Metodos
    public function Gestionar()
    {
        $conexion = new Conexion();

        try {

            if ($this->Accion == 'PASAR') {
                //GUARDAR LA CORRESPONDENCIA SIN GENERAR EL RADICADO
                $Sql = 'INSERT INTO `archivo_radica_recibidos_pase`(`id_radica`, `id_funcio_deta_origen`, `fechor_pase`, `id_funcio_deta_destino`)
                        VALUES (:id_radica, :id_funcio_deta_origen, :fechor_pase, :id_funcio_deta_destino)';

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
                $Instruc->bindParam(':id_funcio_deta_origen', $this->IdFuncioOrigen, PDO::PARAM_INT);
                $Instruc->bindParam(':fechor_pase', $this->FecHorPase, PDO::PARAM_STR);
                $Instruc->bindParam(':id_funcio_deta_destino', $this->IdFuncioDestino, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            }

            if ($Instruc) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo 'Ha surgido un error y no se puede ejecutar la consulta.' . $e->getMessage();
            exit;
        }
    }

    public static function Listar($Accion, $IdPase, $IdRadica, $IdFuncioOrigen, $IdFuncioDestino)
    {
        $conexion = new Conexion();

        try {
            if ($Accion == 1) {
                /******************************************************************************************/
                /*  LISTO UN LOS FUNCIONARIOS DE UN RADICADO EN PARTICULAR
                /******************************************************************************************/
                $Sql = "SELECT `pase`.`id_pase`, `pase`.`id_radica`, `pase`.`fechor_pase`, `funcio_oprigen`.`nom_funcio` AS `nom_funcio_origen`, 
                            `funcio_oprigen`.`ape_funcio` AS `ape_funcio_origen`, `depen_origen`.`nom_depen` AS `nom_depen_origen`, 
                            `ofi_origen`.`nom_oficina` AS `nom_oficina_origen`, `pase`.`fehor_acepta`, `funcio_desti`.`nom_funcio` AS `nom_funcio_desti`, 
                            `funcio_desti`.`ape_funcio` AS `ape_funcio_desti`, `depen_desti`.`nom_depen` AS `nom_depen_desti`, 
                            `ofi_desti`.`nom_oficina` AS `nom_oficina_desti`
                        FROM `archivo_radica_recibidos_pase` AS `pase`
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta_origen` ON (`pase`.`id_funcio_deta_origen` = `funcio_deta_origen`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio_oprigen` ON (`funcio_deta_origen`.`id_funcio` = `funcio_oprigen`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi_origen` ON (`funcio_deta_origen`.`id_oficina` = `ofi_origen`.`id_oficina`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta_desti` ON (`funcio_deta_desti`.`id_funcio_deta` = `pase`.`id_funcio_deta_destino`)
                            INNER JOIN `gene_funcionarios` AS `funcio_desti` ON (`funcio_deta_desti`.`id_funcio` = `funcio_desti`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi_desti` ON (`funcio_deta_desti`.`id_oficina` = `ofi_desti`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen_origen` ON (`ofi_origen`.`id_depen` = `depen_origen`.`id_depen`)
                            INNER JOIN `areas_dependencias` AS `depen_desti` ON (`ofi_desti`.`id_depen` = `depen_desti`.`id_depen`)
                        WHERE (`pase`.`id_radica` = :id_radica)
                        ORDER BY `pase`.`id_radica` ASC";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":id_radica", $IdRadica, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            }

            $Result = $Instruc->fetchAll();
            $conexion = null;
            return $Result;
        } catch (PDOException $e) {
            echo 'Ha surgido un error y no se puede ejecutar la consulta.' . $e->getMessage();
            exit;
        }
    }

    public static function Buscar($Accion, $IdPase, $IdRadica, $IdFuncioOrigen, $IdFuncioDestino)
    {
        $conexion = new Conexion();

        try {

            if ($Accion == 1) {
                /******************************************************************************************/
                /*  BUSCO SI UN FUNCIONARIO TIENE CORRESPONDENCIA
                /******************************************************************************************/
                $Sql = "SELECT * FROM radica_pase";
                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':id_funcio_deta', $IdFuncioDeta, PDO::PARAM_INT);
            }

            $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            $Result = $Instruc->fetch();
            $conexion = null;

            if ($Result) {
                return new self(
                    "",
                    $Result['id_pase'],
                    $Result['id_radica'],
                    $Result['id_funcio_deta_origen'],
                    $Result['fechor_pase'],
                    $Result['id_funcio_deta_destino'],
                    $Result['fehor_acepta']
                );
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo 'Ha surgido un error y no se puede ejecutar la consulta.' . $e->getMessage();
            exit;
        }
    }
}
