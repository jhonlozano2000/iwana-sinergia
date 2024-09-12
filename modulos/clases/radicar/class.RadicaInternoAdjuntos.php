<?php
class RadicadoInternoAdjuntos
{
    //Atributos
    private $Accion;
    private $IdArchivo;
    private $IdRadica;
    private $NomArchivo;
    private $Archivo;

    public function __construct($Accion = null, $IdArchivo = null, $IdRadica = null, $NomArchivo = null, $Archivo = null)
    {
        $this->Accion    = $Accion;
        $this->IdArchivo = $IdArchivo;
        $this->IdRadica  = $IdRadica;
        $this->NomArchivo = $NomArchivo;
        $this->Archivo   = $Archivo;
    }

    public function get_IdArchivo()
    {
        return $this->IdArchivo;
    }

    public function get_IdRadica()
    {
        return $this->IdRadica;
    }

    public function get_NomArchivo()
    {
        return $this->NomArchivo;
    }

    public function get_Archivo()
    {
        return $this->Archivo;
    }

    // FUNCIONES PARA ENVIAR VALORES //
    public function set_Accion($Accion)
    {
        $this->Accion = $Accion;
    }

    public function set_IdArchivo($IdArchivo)
    {
        $this->IdArchivo = $IdArchivo;
    }

    public function set_IdRadica($IdRadica)
    {
        $this->IdRadica = $IdRadica;
    }

    public function set_NomArchivo($NomArchivo)
    {
        $this->NomArchivo = $NomArchivo;
    }

    public function set_Archivo($Archivo)
    {
        $this->Archivo = $Archivo;
    }

    //Metodos
    public function Gestionar()
    {
        $conexion = new Conexion();

        try {
            if ($this->Accion === 'INSERTAR_ARCHIVO') {
                $Sql = 'INSERT INTO archivo_radica_interna_adjuntos(id_radica, nom_archivo, archivo)
    					VALUES(:id_radica, :nom_archivo, :archivo)';

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
                $Instruc->bindParam(':nom_archivo', $this->NomArchivo, PDO::PARAM_STR);
                $Instruc->bindParam(':archivo', $this->Archivo, PDO::PARAM_STR);
            }

            $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            $conexion = null;
            if ($Instruc) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo 'Ha surgido un error y no se puede ejecutar la consulta, Gestionar -> ' . $this->Accion . ' - ' . $e->getMessage();
            exit;
        }
    }

    public static function Listar($Accion, $IdRadicado, $NomArchivo)
    {
        $conexion = new Conexion();

        try {
            if ($Accion == 1) {
                $Sql = "SELECT `radica`.`id_radica`, `radica`.`id_ruta`, `adjunto`.`nom_archivo`
                        FROM `archivo_radica_interna_adjuntos` AS `adjunto`
                            INNER JOIN `archivo_radica_interna` AS `radica` ON (`adjunto`.`id_radica` = `radica`.`id_radica`)
                        WHERE (`radica`.`id_radica` = :id_radica)";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":id_radica", $IdRadicado, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($Accion == 2) {
                $Sql = "SELECT * FROM archivo_radica_interna_adjuntos 
                        WHERE id_radica = :id_radica  AND nom_archivo = :nom_archivo";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":id_radica", $IdRadicado, PDO::PARAM_STR);
                $Instruc->bindParam(":nom_archivo", $IdRadicado, PDO::PARAM_STR);
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

    public static function Buscar($Accion, $IdRadicado, $Archivo)
    {
        $conexion = new Conexion();

        try {
            if ($Accion == 1) {
                $Sql = "SELECT * FROM archivo_radica_interna_adjuntos
                        WHERE id_radica = :id_radica";

                $Instruc->bindParam(":id_radica", $IdRadicado, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif (Accion == 2) {
                $Sql = "SELECT * FROM archivo_radica_interna_adjuntos
                        WHERE id_radica = :id_radica AND nom_archivo = :nom_archivo";

                $Instruc->bindParam(":id_radica", $IdRadicado, PDO::PARAM_str);
                $Instruc->bindParam(":nom_archivo", $Archivo, PDO::PARAM_str);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            }

            $Result = $InstrucBuscar->fetch();
            $conexion = null;

            if ($Result) {
                return new self("", $Result['id_archivo'], $Result['id_radica'], $Result['nom_archivo'], $Result['archivo']);
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo 'Ha surgido un error y no se puede ejecutar la consulta.' . $e->getMessage();
            exit;
        }
    }
}
