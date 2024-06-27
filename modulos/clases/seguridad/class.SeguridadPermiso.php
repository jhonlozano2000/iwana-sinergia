<?php
class Permiso
{
    private $Accion;
    private $idUsua;
    private $idPerfil;
    private $nomPerfil;
    private $moduPadre;
    private $nomModu;
    private $menu;

    public function __construct($Accion = null, $idUsua = null, $idPerfil = null, $nomPerfil = null, $moduPadre = null, $nomModu = null, $menu = null)
    {
        $this->Accion = $Accion;
        $this->idUsua = $idUsua;
        $this->idPerfil = $idPerfil;
        $this->nomPerfil = $nomPerfil;
        $this->moduPadre = $moduPadre;
        $this->nomModu = $nomModu;
        $this->menu = $menu;
    }

    public function getAccion()
    {
        return $this->Accion;
    }

    public function get_idUsua()
    {
        return $this->idUsua;
    }

    public function get_idPerfil()
    {
        return $this->idPerfil;
    }

    public function get_nomPerfil()
    {
        return $this->nomPerfil;
    }

    public function get_moduPadre()
    {
        return $this->moduPadre;
    }

    public function get_nomModu()
    {
        return $this->nomModu;
    }

    public function get_menu()
    {
        return $this->menu;
    }



    public function setAccion($Accion)
    {
        $this->Accion = $Accion;
    }

    public function set_idUsua($idUsua)
    {
        $this->idUsua = $idUsua;
    }

    public function set_idPerfil($idPerfil)
    {
        $this->idPerfil = $idPerfil;
    }

    public function set_nomPerfil($nomPerfil)
    {
        $this->nomPerfil = $nomPerfil;
    }

    public function set_moduPadre($moduPadre)
    {
        $this->moduPadre = $moduPadre;
    }

    public function set_nomModu($nomModu)
    {
        $this->nomModu = $nomModu;
    }

    public function set_menu($menu)
    {
        $this->menu = $menu;
    }






    public static function Listar($Accion, $idUsua, $idPerfil, $nomPerfil, $nomModu, $menu)
    {
        $conexion = new Conexion();

        try {

            if ($Accion = 1) {
                $Sql = "SELECT `segu_modu`.`menu`
                        FROM `segu_usuadeta`
                            INNER JOIN `segu_perfiles` ON (`segu_usuadeta`.`id_perfil` = `segu_perfiles`.`id_perfil`)
                            INNER JOIN `segu_perfiles_deta` ON (`segu_perfiles_deta`.`id_perfil` = `segu_perfiles`.`id_perfil`)
                            INNER JOIN `segu_modu` ON (`segu_perfiles_deta`.`id_modu` = `segu_modu`.`id_modu`)
                        WHERE (`segu_usuadeta`.`id_usua` = :id_usua);";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":id_usua", $idUsua, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            }

            $Result = $Instruc->fetchAll();
            $conexion = null;
            return $Result;
        } catch (PDOException $e) {
            echo 'Ha surgido un error y no se puede ejecutar la consulta, Listar Permisos.' . $e->getMessage();
            exit;
        }
    }

    public static function Buscar($Accion, $idUsua, $idPerfil, $nomPerfil, $nomModu, $menu)
    {
        $conexion = new Conexion();

        try {
            if ($Accion == 1) {
                /******************************************************************************************/
                /*	LISTO PERMISOS DE UN USUARIO
				/******************************************************************************************/
                $Sql = "SELECT `segu_usuadeta`.`id_usua`, `segu_perfiles`.`id_perfil`, `segu_perfiles`.`nom_perfil`, 
                            `segu_modu`.`modu_padre`, `segu_modu`.`nom_modu`, `segu_modu`.`menu`
                        FROM `segu_usuadeta`
                            INNER JOIN `segu_perfiles` ON (`segu_usuadeta`.`id_perfil` = `segu_perfiles`.`id_perfil`)
                            INNER JOIN `segu_perfiles_deta` ON (`segu_perfiles_deta`.`id_perfil` = `segu_perfiles`.`id_perfil`)
                            INNER JOIN `segu_modu` ON (`segu_perfiles_deta`.`id_modu` = `segu_modu`.`id_modu`)
                        WHERE (`segu_usuadeta`.`id_usua` = :id_usua);";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":id_usua", $idUsua, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
                $Result = $Instruc->fetchAll();
                if ($Result) {
                    return $Result;
                }
            } elseif ($Accion == 2) {
                /******************************************************************************************/
                /*	BUSCO UN PERMISOS DE UN USUARIO
				/******************************************************************************************/
                $Sql = "SELECT `segu_usuadeta`.`id_usua`, `segu_perfiles`.`id_perfil`, `segu_perfiles`.`nom_perfil`, 
                            `segu_modu`.`modu_padre`, `segu_modu`.`nom_modu`, `segu_modu`.`menu`
                        FROM `segu_usuadeta`
                            INNER JOIN `segu_perfiles` ON (`segu_usuadeta`.`id_perfil` = `segu_perfiles`.`id_perfil`)
                            INNER JOIN `segu_perfiles_deta` ON (`segu_perfiles_deta`.`id_perfil` = `segu_perfiles`.`id_perfil`)
                            INNER JOIN `segu_modu` ON (`segu_perfiles_deta`.`id_modu` = `segu_modu`.`id_modu`)
                        WHERE (`segu_usuadeta`.`id_usua` = :id_usua AND `segu_modu`.`menu` = :menu);";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":id_usua", $idUsua, PDO::PARAM_INT);
                $Instruc->bindParam(":menu", $menu, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));

                $Result = $Instruc->fetch();
                $conexion = null;
                if ($Result) {
                    return new self("", $Result['id_usua'], $Result['id_perfil'], $Result['nom_perfil'], $Result['modu_padre'], $Result['nom_modu'], $Result['menu']);
                } else {
                    return false;
                }
            }
        } catch (PDOException $e) {
            echo 'Ha surgido un error y no se puede ejecutar la consulta.' . $e->getMessage();
            exit;
        }
    }
}
