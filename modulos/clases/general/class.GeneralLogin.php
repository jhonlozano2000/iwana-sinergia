<?php
class GeneralLogin
{
    private $IdTercero;
    private $IdDepartamento;
    private $IdMunicipio;
    private $NumDocu;
    private $NomContacto;
    private $Dir;
    private $Tel;
    private $Cel;
    private $Email;
    private $Password;

    public function __construct(
        $IdTercero = null,
        $IdDepartamento = null,
        $IdMunicipio = null,
        $NumDocu = null,
        $NomContacto = null,
        $Dir = null,
        $Tel = null,
        $Cel = null,
        $Email = null,
        $Password = null
    ) {

        $this->IdTercero      = $IdTercero;
        $this->IdDepartamento = $IdDepartamento;
        $this->IdMunicipio    = $IdMunicipio;
        $this->NumDocu        = $NumDocu;
        $this->NomContacto    = $NomContacto;
        $this->Dir            = $Dir;
        $this->Tel            = $Tel;
        $this->Cel            = $Cel;
        $this->Email          = $Email;
        $this->Password      = $Password;
    }

    public function getId_Remite()
    {
        return $this->IdTercero;
    }

    public function getId_Depar()
    {
        return $this->IdDepartamento;
    }

    public function getId_Muni()
    {
        return $this->IdMunicipio;
    }

    public function getNum_Documetno()
    {
        return $this->NumDocu;
    }

    public function getNom_Contacto()
    {
        return $this->NomContacto;
    }

    public function get_Dir()
    {
        return $this->Dir;
    }

    public function get_Tel()
    {
        return $this->Tel;
    }

    public function get_Cel()
    {
        return $this->Cel;
    }

    public function get_Email()
    {
        return $this->Email;
    }

    public function get_Password()
    {
        return $this->Password;
    }

    /////////////////////////////////////
    public function setId_Reite($IdTercero)
    {
        return $this->IdTercero = $IdTercero;
    }

    public function setId_Depar($IdDepartamento)
    {
        return $this->IdDepartamento = $IdDepartamento;
    }

    public function setId_Muni($IdMunicipio)
    {
        return $this->IdMunicipio = $IdMunicipio;
    }

    public function setNum_Documetno($NumDocu)
    {
        return $this->NumDocu = $NumDocu;
    }

    public function setNom_Contacto($NomContacto)
    {
        return $this->NomContacto = $NomContacto;
    }

    public function set_Dir($Dir)
    {
        return $this->Dir = $Dir;
    }

    public function set_Tel($Tel)
    {
        return $this->Tel = $Tel;
    }

    public function set_Cel($Cel)
    {
        return $this->Cel = $Cel;
    }

    public function set_Email($Email)
    {
        return $this->Email = $Email;
    }

    public function set_Password($Password)
    {
        return $this->Password = $Password;
    }

    public static function Buscar($Accion, $IdTercero, $Email, $Password)
    {
        $conexion = new Conexion();

        try {

            if ($Accion == 1) {
                /******************************************************************************************/
                /*  BUCAR EL TERCERO
                /******************************************************************************************/

                $Sql = "SELECT *
                		FROM gene_terceros_contac
                		WHERE email = :email";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':email', $Email, PDO::PARAM_INT);
            }

            $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            $Result = $Instruc->fetch();
            $conexion = null;

            if ($Result) {
                return new self($Result['id_tercero'], $Result['id_depar'], $Result['id_muni'], $Result['num_docu'], $Result['nom_contac'], $Result['dir'], $Result['tel'], $Result['cel'], $Result['email'], $Result['password']);
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo 'Ha surgido un error y no se puede ejecutar la consulta.' . $e->getMessage();
            exit;
        }
    }
}
