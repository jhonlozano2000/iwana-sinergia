<?php
class RadicadoRecibidoPQRSFAdjunto
{
    private $Accion;
    private $idPqr;
    private $nomArchivo;
    private $nomTempArchivo;

    public function __construct(
        $Accion = null,
        $idPqr = null,
        $nomArchivo = null,
        $nomTempArchivo = null
    ) {

        $this->Accion = $Accion;
        $this->idPqr = $idPqr;
        $this->nomArchivo = $nomArchivo;
        $this->nomTempArchivo = $nomTempArchivo;
    }

    public function get_Accion()
    {
        return $this->Accion;
    }

    public function get_idPqr()
    {
        return $this->idPqr;
    }

    public function get_nomArchivo()
    {
        return $this->nomArchivo;
    }

    public function get_nomTempArchivo()
    {
        return $this->nomTempArchivo;
    }


    public function set_Accion($Accion)
    {
        $this->Accion = $Accion;
    }

    public function set_idPqr($idPqr)
    {
        $this->idPqr = $idPqr;
    }

    public function set_nomArchivo($nomArchivo)
    {
        $this->nomArchivo = $nomArchivo;
    }

    public function set_nomTempArchivo($nomTempArchivo)
    {
        $this->nomTempArchivo = $nomTempArchivo;
    }



    public function Gestionar()
    {
        $conexion = new Conexion();

        try {
            if ($this->Accion == 'INSERTAR') {
                $Sql = 'INSERT INTO `archivo_radica_recibidos_pqrsf_archivos`(`id_pqr`, `nom_archivo`, `nom_temp_archivo`)
                        VALUES (:id_pqr, :nom_archivo, :nom_temp_archivo)';

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':id_pqr', $this->idPqr, PDO::PARAM_INT);
                $Instruc->bindParam(':nom_archivo', $this->nomArchivo, PDO::PARAM_STR);
                $Instruc->bindParam(':nom_temp_archivo', $this->nomTempArchivo, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            }

            $this->idPqr = $conexion->lastInsertId();
            if ($Instruc) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo 'Ha surgido un error y no se puede ejecutar la consulta, PQR Online -> Cargar adjunto, Accion ' . $this->Accion . $e->getMessage();
            exit;
        }
    }

    public static function Listar($request)
    {
        $conexion = new Conexion();

        try {

            if ($request['Accion'] == 1) {
                /******************************************************************************************/
                /*  LISTO LOS ARCHIVOS DE UNA SOLICITUD
                /******************************************************************************************/
                $Sql = "SELECT *
                        FROM`archivo_radica_recibidos_pqrsf_archivos`
                        WHERE (`id_pqr` = :id_pqr);";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":id_pqr", $request['id_pqr'], PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            }

            $Result = $Instruc->fetchAll();
            $conexion = null;
            return $Result;
        } catch (PDOException $e) {
            echo 'Ha surgido un error y no se puede ejecutar la consulta listar.' . $e->getMessage();
            exit;
        }
    }

    public static function BuscarPQRSF($request)
    {
        $conexion = new Conexion();

        try {
            if ($request['Accion'] == 1) {
                /******************************************************************************************/
                /*  BUSCO LOS ARCHIVOS DE UNA SOLICITUD
                /******************************************************************************************/
                $Sql = "SELECT *
                        FROM`archivo_radica_recibidos_pqrsf_archivos`
                        WHERE (`id_pqr` = :id_pqr);";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":id_pqr", $request['id_pqr'], PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            }

            $Result = $Instruc->fetch();
            $conexion = null;

            if ($Result) {
                return new self("", $Result['id_pqr_archivo'], $Result['id_pqr'], $Result['nom_archivo'], $Result['nom_temp_archivo']);
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo 'Ha surgido un error y no se puede ejecutar la consulta.' . $e->getMessage();
            exit;
        }
    }
}
