<?php
class RadicadoEnviadoArchivoAdicional
{
    //Atributos
    private $Accion;
    private $IdRadica;
    private $IdArchivo;
    private $NomArchivo;
    private $Archivo;

    public function __construct($Accion = null, $IdArchivo = null, $IdRadica = null, $NomArchivo = null, $Archivo = null)
    {
        $this->Accion     = $Accion;
        $this->IdArchivo  = $IdArchivo;
        $this->IdRadica   = $IdRadica;
        $this->NomArchivo = $NomArchivo;
        $this->Archivo  = $Archivo;
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
        return $this->Archivo = $Archivo;
    }

    //Metodos
    public function Gestionar()
    {
        $conexion = new Conexion();

        try {

            if ($this->Accion == 'INSERTAR_ARCHIVO') {
                $Sql = 'INSERT INTO archivo_radica_enviados_archivos(id_radica, nom_archivo, archivo)
                        VALUES(:id_radica, :nom_archivo, :archivo)';

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
                $Instruc->bindParam(':nom_archivo', $this->NomArchivo, PDO::PARAM_STR);
                $Instruc->bindParam(':archivo', $this->Archivo, PDO::PARAM_STR);
            } elseif ($this->Accion == 'ELIMINAR_ARCHIVOS') {
                $Sql = "DELETE
                        FROM archivo_radica_enviados_archivos
                        WHERE id_radica = :id_radica";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
            }

            $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            $this->IdArchivo = $conexion->lastInsertId();
            $conexion = null;

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

    public static function Listar($Accion, $IdRadicado, $IdArchivo, $NomArchivo)
    {
        $conexion = new Conexion();

        try {
            if ($Accion == 1) {
                /******************************************************************************************/
                /*  LISTO LOS ARCHIVOS DE UN RADICADO
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`, `radi`.`id_ruta`, `radi_archi`.`id_archivo`, `radi_archi`.`nom_archivo`, `radi_archi`.`nom_archivo`
                        FROM `archivo_radica_enviados_archivos` AS `radi_archi`
                            INNER JOIN `archivo_radica_enviados` AS `radi` ON (`radi_archi`.`id_radica` = `radi`.`id_radica`)
                        WHERE (`radi`.`id_radica` = :id_radica)";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":id_radica", $IdRadicado, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            }

            $Result = $Instruc->fetchAll();
            $conexion = null;
            return $Result;
        } catch (PDOException $e) {
            echo 'Ha surgido un error y no se puede ejecutar la consulta, Adjuntos Radicados Enviados -> Listar.' . $e->getMessage();
            exit;
        }
    }

    public static function Buscar($Accion, $IdRadicado, $IdArchivo, $NomArchivo)
    {
        $conexion = new Conexion();

        try {
            if ($Accion == 1) {
                /**
                 * Busco los archivos adjuntos por radicado
                 */
                $Sql = "SELECT *
                        FROM archivo_radica_enviados_archivos
                        WHERE id_radica = :id_radica";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':id_radica', $IdRadica, PDO::PARAM_STR);
            } elseif ($Accion == 2) {
                /**
                 * Busco los archivos adjuntos por Id
                 */
                $Sql = "SELECT *
                        FROM archivo_radica_enviados_archivos
                        WHERE id_archivo = :id_archivo";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':id_archivo', $IdArchivo, PDO::PARAM_STR);
            }

            $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            $Result = $Instruc->fetch();
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
