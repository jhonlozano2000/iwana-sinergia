<?php
class RadicadoInternoAdjuntos
{
    //Atributos
    private $Accion;
    private $IdArchivo;
    private $IdRadica;
    private $NombreArchivo;
    private $Archivo;

    public function __construct($Accion = null, $IdArchivo = null, $IdRadica = null, $NombreArchivo = null, $Archivo = null)
    {
        $this->Accion    = $Accion;
        $this->IdArchivo = $IdArchivo;
        $this->IdRadica  = $IdRadica;
        $this->NombreArchivo = $NombreArchivo;
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

    public function get_NombreArchivo()
    {
        return $this->NombreArchivo;
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

    public function set_NombreArchivo($NombreArchivo)
    {
        $this->NombreArchivo = $NombreArchivo;
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
                $Sql = 'INSERT INTO archivo_radica_interna_adjuntos(id_radica, nombre_archivo, archivo)
    					VALUES(:id_radica, :nombre_archivo, :archivo)';

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
                $Instruc->bindParam(':nombre_archivo', $this->NombreArchivo, PDO::PARAM_STR);
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

    public static function Listar($Accion, $IdRadicado, $NombreArchivo)
    {
        $conexion = new Conexion();

        try {
            if ($Accion == 1) {
                $Sql = "SELECT `radi`.`id_radica`, `radi`.`tipo_cargue_archivos`, `radi`.`nombre_archivo` AS `nombre_archivo_radica`, `radi`.`archivo` AS `archivo_radica`
                            , `adjuntos`.`id_archivo`, `adjuntos`.`nombre_archivo` AS `nombre_archivo_adjunto`, `adjuntos`.`archivo` AS `archivo_adjunto`,  `adjuntos`.`id_archivo`, `radi`.`id_ruta`
                        FROM `archivo_radica_interna_adjuntos` AS `adjuntos`
                            INNER JOIN `archivo_radica_interna` AS `radi` ON (`adjuntos`.`id_radica` = `radi`.`id_radica`)
                        WHERE (`radi`.`id_radica` = :id_radica)";

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
            if ($Accion === 1) {
                $Sql = "SELECT * FROM archivo_radica_interna_adjuntos
                        WHERE id_radica = :id_radica";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":id_radica", $IdRadicado, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($Accion === 2) {
                $Sql = "SELECT * FROM archivo_radica_interna_adjuntos
                        WHERE id_radica = :id_radica AND nom_archivo = :nom_archivo";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":id_radica", $IdRadicado, PDO::PARAM_STR);
                $Instruc->bindParam(":nom_archivo", $Archivo, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($Accion === 3) {
                $Sql = "SELECT * FROM archivo_radica_interna_adjuntos
                        WHERE id_archivo = :id_archivo";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":id_archivo", $Archivo, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            }

            $Result = $Instruc->fetch();
            $conexion = null;

            if ($Result) {
                return new self("", $Result['id_archivo'], $Result['id_radica'], $Result['nombre_archivo'], $Result['archivo']);
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo 'Ha surgido un error y no se puede ejecutar la consulta.' . $e->getMessage();
            exit;
        }
    }
}
