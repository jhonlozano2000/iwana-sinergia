<?php
class RadicadoRecibidoResponsable
{
    //Atributos
    private $Accion;
    private $IdRadica;
    private $IdFuncio;
    private $Respon;
    private $Leido;
    private $FecHorLeido;
    private $Elimina;
    private $Respuesta;
    private $Firma;

    public function __construct(
        $Accion = null,
        $IdRadica = null,
        $IdFuncio = null,
        $Respon = null,
        $Leido = null,
        $FecHorLeido = null,
        $Elimina = null,
        $Respuesta = null,
        $Firma = null
    ) {
        $this->Accion      = $Accion;
        $this->IdRadica    = $IdRadica;
        $this->IdFuncio    = $IdFuncio;
        $this->Respon      = $Respon;
        $this->Leido       = $Leido;
        $this->FecHorLeido = $FecHorLeido;
        $this->Elimina     = $Elimina;
        $this->Respuesta   = $Respuesta;
        $this->Firma       = $Firma;
    }

    public function get_IdRadica()
    {
        return $this->IdRadica;
    }

    public function get_IdFuncio()
    {
        return $this->IdFuncio;
    }

    public function get_Respon()
    {
        return $this->Respon;
    }

    public function get_Leido()
    {
        return $this->Leido;
    }

    public function get_FecHorLeido()
    {
        return $this->FecHorLeido;
    }

    public function get_Elimina()
    {
        return $this->Elimina;
    }

    public function get_Respuesta()
    {
        return $this->Respuesta;
    }

    public function get_Firma()
    {
        return $this->Firma;
    }

    // FUNCIONES PARA ENVIAR VALORES //
    public function set_Accion($Accion)
    {
        $this->Accion = $Accion;
    }

    public function set_IdRadica($IdRadica)
    {
        $this->IdRadica = $IdRadica;
    }

    public function set_IdFuncio($IdFuncio)
    {
        $this->IdFuncio = $IdFuncio;
    }

    public function set_Respon($Respon)
    {
        $this->Respon = $Respon;
    }

    public function set_Leido($Leido)
    {
        $this->Leido = $Leido;
    }

    public function set_FecHorLeido($FecHorLeido)
    {
        $this->FecHorLeido = $FecHorLeido;
    }

    public function set_Elimina($Elimina)
    {
        $this->Elimina = $Elimina;
    }

    public function set_Respuesta($Respuesta)
    {
        $this->Respuesta = $Respuesta;
    }

    public function set_Firma($Firma)
    {
        $this->Firma = $Firma;
    }

    //Metodos
    public function Gestionar()
    {
        $conexion = new Conexion();

        try {

            if ($this->Accion == 1) {
                //GUARDAR LA CORRESPONDENCIA SIN GENERAR EL RADICADO
                $Sql = 'INSERT INTO archivo_radica_recibidos_responsa(id_radica, id_funcio, respon, leido, fechor_leido, elimina, respuesta, firma)
    					VALUES(:id_radica, :id_funcio, 0, 0, NULL, 0, 0, 0)';

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
                $Instruc->bindParam(':id_funcio', $this->IdFuncio, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($this->Accion == 2) {
                //MARCO COMO FIRMADO EL MENSAJE
                $Sql = 'UPDATE archivo_radica_recibidos_responsa
                        SET firma = :firma, fechor_firma = :fechor_firma
    					WHERE id_radica = :id_radica';

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':firma', $this->Firma, PDO::PARAM_INT);
                $Instruc->bindParam(':fechor_firma', $this->FecHorFirma, PDO::PARAM_STR);
                $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($this->Accion == 3) {
                //ELIMINO LOS DESTINATARIOS
                $Sql = "DELETE FROM archivo_radica_recibidos_responsa
                        WHERE id_radica = " . $this->IdRadica;

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($this->Accion == 'ELIMINAR_RADICADO') {
                $Sql = "DELETE FROM archivo_radica_recibidos_responsa
                        WHERE id_radica = :id_radica";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($this->Accion == 4) {
                //ESTABLEZCO ES RESPONSABLE
                $Sql = "UPDATE archivo_radica_recibidos_responsa
                        SET respon = 1
                        WHERE id_radica = :id_radica AND id_funcio = :id_funcio";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
                $Instruc->bindParam(':id_funcio', $this->IdFuncio, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($this->Accion == 5) {
                //ESTABLEZCO EL RESPONSABLE PARA LAS SOLICITUDES DE HC
                $Sql = 'INSERT INTO archivo_radica_recibidos_responsa(id_radica, id_funcio, respon, leido, fechor_leido, elimina, respuesta, firma)
                        VALUES(:id_radica, :id_funcio, 1, 0, NULL, 0, 0, 0)';

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
                $Instruc->bindParam(':id_funcio', $this->IdFuncio, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($this->Accion == 'MARCAR_LEIDO') {
                //MARCO COMO FIRMADO EL MENSAJE
                $Sql = 'UPDATE archivo_radica_recibidos_responsa
                        SET leido = :leido
                        WHERE id_radica = :id_radica AND id_funcio = :id_funcio';

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':leido', $this->Leido, PDO::PARAM_INT);
                $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
                $Instruc->bindParam(':id_funcio', $this->IdFuncio, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($this->Accion == 'PASAR') {
                //MARCO COMO FIRMADO EL MENSAJE
                $Sql = 'UPDATE archivo_radica_recibidos_responsa
                        SET id_funcio = :id_funcio
                        WHERE id_radica = :id_radica AND respon = 1';

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':id_funcio', $this->IdFuncio, PDO::PARAM_INT);
                $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
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

    public static function Listar($Accion, $IdRadicado, $IdFuncioDeta)
    {
        $conexion = new Conexion();

        try {
            if ($Accion == 1) {
                /******************************************************************************************/
                /*  LISTO UN LOS FUNCIONARIOS DE UN RADICADO EN PARTICULAR
                /******************************************************************************************/
                $Sql = "SELECT r.id_radica, gene_funcionarios.nom_funcio, gene_funcionarios.ape_funcio, areas_dependencias.cod_corres,
                            areas_dependencias.nom_depen, areas_cargos.nom_cargo, r.respon, r.leido, r.elimina, r.respuesta, r.firma,
                            areas_oficinas.`cod_oficina`, areas_oficinas.`nom_oficina`
                        FROM gene_funcionarios_deta AS fd
                            INNER JOIN gene_funcionarios ON (fd.id_funcio = gene_funcionarios.id_funcio)
                            INNER JOIN areas_oficinas ON (fd.id_oficina = areas_oficinas.id_oficina)
                            INNER JOIN areas_cargos ON (fd.id_cargo = areas_cargos.id_cargo)
                            INNER JOIN areas_dependencias ON (areas_oficinas.id_depen = areas_dependencias.id_depen)
                            INNER JOIN archivo_radica_recibidos_responsa AS r ON (r.id_funcio = fd.id_funcio_deta)
                        WHERE r.id_radica = :id_radica";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":id_radica", $IdRadicado, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($Accion == 2) {
                /******************************************************************************************/
                /*  LISTO UN LOS FUNCIONARIOS DE UN RADICADO EN PARTICULAR
                /******************************************************************************************/
                $Sql = "SELECT `fun_deta`.`id_funcio_deta`, `funcio`.`id_funcio`, `funcio`.`cod_funcio`, `funcio`.`nom_funcio`, `funcio`.`ape_funcio`,
                            `depen`.`id_depen` AS `id_depen`, `depen`.`cod_depen` AS `cod_depen`, `depen`.`cod_corres` AS `cod_corres_depen`, `depen`.`nom_depen`,
                            `ofi`.`id_oficina`, `ofi`.`nom_oficina`, `cargo`.`id_cargo`, `cargo`.`nom_cargo`, `ra`.`respon`
                        FROM `gene_funcionarios_deta` AS `fun_deta`
                            INNER JOIN `gene_funcionarios` AS `funcio` ON (`fun_deta`.`id_funcio` = `funcio`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`fun_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_cargos` AS `cargo` ON (`fun_deta`.`id_cargo` = `cargo`.`id_cargo`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            INNER JOIN `archivo_radica_recibidos_responsa` AS `ra` ON (`ra`.`id_funcio` = `fun_deta`.`id_funcio_deta`)
                        WHERE (`ra`.`id_radica` = :id_radica);";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":id_radica", $IdRadicado, PDO::PARAM_STR);
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

    public static function Buscar($Accion, $IdRadicado, $IdFuncioDeta)
    {
        $conexion = new Conexion();

        try {

            if ($Accion == 1) {
                /******************************************************************************************/
                /*  BUSCO SI UN FUNCIONARIO TIENE CORRESPONDENCIA
                /******************************************************************************************/
                $Sql = "SELECT * 
                        FROM archivo_radica_recibidos_responsa
                        WHERE id_funcio = :id_funcio_deta";
                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':id_funcio_deta', $IdFuncioDeta, PDO::PARAM_INT);
            } elseif ($Accion == 2) {
                /******************************************************************************************/
                /*  BUSCO SI UN FUNCIONARIO TIENE CORRESPONDENCIA
                /******************************************************************************************/
                $Sql = "SELECT * 
                        FROM archivo_radica_recibidos_responsa
                        WHERE id_funcio_deta = :id_funcio_deta";
                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':id_funcio_deta', $IdFuncioDeta, PDO::PARAM_INT);
            } elseif ($Accion == 3) {
                /******************************************************************************************/
                /*  BUSCO UN FUNCIONARIO POR ID DE RADICADO
                /******************************************************************************************/
                $Sql = "SELECT * 
                        FROM archivo_radica_recibidos_responsa
                        WHERE id_radica = :id_radica AND respon = 1";
                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':id_radica', $IdRadicado, PDO::PARAM_INT);
            }

            $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            $Result = $Instruc->fetch();
            $conexion = null;

            if ($Result) {
                return new self("", $Result['id_radica'], $Result['id_funcio'], $Result['respon'], $Result['leido'], $Result['fechor_leido'], $Result['elimina'], $Result['respuesta'], $Result['firma']);
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo 'Ha surgido un error y no se puede ejecutar la consulta.' . $e->getMessage();
            exit;
        }
    }
}
