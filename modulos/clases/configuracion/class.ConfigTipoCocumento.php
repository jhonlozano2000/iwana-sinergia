<?php
class TipoDocumento
{
    private $Accion;
    private $Id;
    private $CodTipo;
    private $NomTipo;
    private $Acti;

    public function __construct($Accion = null, $Id = null, $CodTipo = null, $NomTipo = null, $Acti = null)
    {
        $this->Accion  = $Accion;
        $this->Id      = $Id;
        $this->CodTipo = $CodTipo;
        $this->NomTipo = $NomTipo;
        $this->Acti    = $Acti;
    }

    public function get_Id()
    {
        return $this->Id;
    }

    public function get_CodTipo()
    {
        return $this->CodTipo;
    }

    public function get_NomTipo()
    {
        return $this->NomTipo;
    }

    public function get_Acti()
    {
        return $this->Acti;
    }

    public function set_Accion($Accion)
    {
        return $this->Accion = $Accion;
    }

    public function set_Id($Id)
    {
        return $this->Id = $Id;
    }

    public function set_CodTipo($CodTipo)
    {
        return $this->CodTipo = $CodTipo;
    }

    public function set_NomTipo($NomTipo)
    {
        return $this->NomTipo = $NomTipo;
    }

    public function set_Acti($Acti)
    {
        return $this->Acti = $Acti;
    }

    public function Gestionar()
    {
        $conexion = new Conexion();

        try {
            if ($this->Accion == 'INSERTAR') {
                $Sql = "INSERT INTO config_tipo_documento(cod_tipo, nom_tipo)
						VALUES('" . $this->CodTipo . "', '" . $this->NomTipo . "')";
            }
            if ($this->Accion == 'EDITAR') {
                $Sql = "UPDATE config_tipo_documento
						SET cod_tipo = '" . $this->CodTipo . "', nom_tipo = '" . $this->NomTipo . "'
						WHERE id_tipo = " . $this->Id;
            }
            if ($this->Accion == 'ELIMINAR') {
                $Sql = "DELETE FROM config_tipo_documento
						WHERE id_tipo = " . $this->Id;
            }
            if ($this->Accion == 'ACTIVAR_INACTIVAR') {
                $Sql = "UPDATE config_tipo_documento
						SET acti = '" . $this->Acti . "'
						WHERE id_tipo = " . $this->Id;
            }


            $Instruc = $conexion->prepare($Sql);
            $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
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

    public static function Listar($Accion, $Id, $Cod, $Nom)
    {
        $conexion = new Conexion();
        if ($Accion == 1) {
            $SqlBuscar = "SELECT *
						FROM config_tipo_documento
						ORDER BY nom_tipo";
        } elseif ($Accion == 2) {
            $SqlBuscar = "SELECT *
						FROM config_tipo_documento
						WHERE id_tipo = " . $Id;
        } elseif ($Accion == 3) {
            $SqlBuscar = "SELECT *
						FROM config_tipo_documento
						WHERE acti = 1";
        }

        $Instruc = $conexion->prepare($SqlBuscar);
        $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $SqlBuscar, true));
        $Result = $Instruc->fetchAll();
        $conexion = null;
        return $Result;
    }

    public static function Buscar($Accion, $Id, $cod, $Nom)
    {
        $conexion = new Conexion();
        if ($Accion == 1) {
            $SqlBuscar = "SELECT * FROM config_tipo_documento ORDER BY nom_tipo";
        } elseif ($Accion == 2) {
            $SqlBuscar = "SELECT * FROM config_tipo_documento WHERE id_tipo = " . $Id;
        }

        $Instruc = $conexion->prepare($SqlBuscar);
        $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $SqlBuscar, true));
        $Result = $Instruc->fetch();
        $conexion = null;
        if ($Result) {
            return new self("", $Result['id_tipo'], $Result['cod_tipo'], $Result['nom_tipo'], $Result['acti']);
        } else {
            return false;
        }
    }
}
