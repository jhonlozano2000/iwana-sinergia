<?php
class RadicadoRecibidoPQRSF
{
    private $Accion;
    private $idPqr;
    private $idContacto;
    private $IdRadica;
    private $idTipoDocuAfectado;
    private $idDeparAfectado;
    private $idMuniAfectado;
    private $idTipoDocumental;
    private $idRegimen;
    private $numDocuAfectado;
    private $nomAfectado;
    private $dirAfectado;
    private $telAfectado;
    private $movilAfectado;
    private $detalleSolicitud;
    private $falloJuducial;
    private $fecHorTramite;

    public function __construct(
        $Accion = null,
        $idPqr = null,
        $idContacto = null,
        $IdRadica = null,
        $idTipoDocuAfectado = null,
        $idDeparAfectado = null,
        $idMuniAfectado = null,
        $idTipoDocumental = null,
        $idRegimen = null,
        $numDocuAfectado = null,
        $nomAfectado = null,
        $dirAfectado = null,
        $telAfectado = null,
        $movilAfectado = null,
        $detalleSolicitud = null,
        $falloJuducial = null,
        $fecHorTramite = null
    ) {

        $this->Accion = $Accion;
        $this->idPqr = $idPqr;
        $this->idContacto = $idContacto;
        $this->IdRadica = $IdRadica;
        $this->idTipoDocuAfectado = $idTipoDocuAfectado;
        $this->idDeparAfectado = $idDeparAfectado;
        $this->idMuniAfectado = $idMuniAfectado;
        $this->idTipoDocumental = $idTipoDocumental;
        $this->idRegimen = $idRegimen;
        $this->numDocuAfectado = $numDocuAfectado;
        $this->nomAfectado = $nomAfectado;
        $this->dirAfectado = $dirAfectado;
        $this->telAfectado = $telAfectado;
        $this->movilAfectado = $movilAfectado;
        $this->detalleSolicitud = $detalleSolicitud;
        $this->falloJuducial = $falloJuducial;
        $this->fecHorTramite = $fecHorTramite;
    }

    public function get_Accion()
    {
        return $this->Accion;
    }

    public function get_idPqr()
    {
        return $this->idPqr;
    }

    public function get_idContacto()
    {
        return $this->idContacto;
    }

    public function get_IdRadica()
    {
        return $this->IdRadica;
    }

    public function get_idTipoDocuAfectado()
    {
        return $this->idTipoDocuAfectado;
    }

    public function get_idDeparAfectado()
    {
        return $this->idDeparAfectado;
    }

    public function get_idMuniAfectado()
    {
        return $this->idMuniAfectado;
    }

    public function get_idTipoDocumental()
    {
        return $this->idTipoDocumental;
    }

    public function get_idRegimen()
    {
        return $this->idRegimen;
    }

    public function get_numDocuAfectado()
    {
        return $this->numDocuAfectado;
    }

    public function get_nomAfectado()
    {
        return $this->nomAfectado;
    }

    public function get_dirAfectado()
    {
        return $this->dirAfectado;
    }

    public function get_telAfectado()
    {
        return $this->telAfectado;
    }

    public function get_movilAfectado()
    {
        return $this->movilAfectado;
    }

    public function get_detalleSolicitud()
    {
        return $this->detalleSolicitud;
    }

    public function get_falloJuducial()
    {
        return $this->falloJuducial;
    }

    public function get_fecHorTramite()
    {
        return $this->fecHorTramite;
    }


    public function set_Accion($Accion)
    {
        $this->Accion = $Accion;
    }

    public function set_idPqr($idPqr)
    {
        $this->idPqr = $idPqr;
    }

    public function set_idContacto($idContacto)
    {
        $this->idContacto = $idContacto;
    }

    public function set_IdRadica($IdRadica)
    {
        $this->IdRadica = $IdRadica;
    }

    public function set_idTipoDocuAfectado($idTipoDocuAfectado)
    {
        $this->idTipoDocuAfectado = $idTipoDocuAfectado;
    }

    public function set_idDeparAfectado($idDeparAfectado)
    {
        $this->idDeparAfectado = $idDeparAfectado;
    }

    public function set_idMuniAfectado($idMuniAfectado)
    {
        $this->idMuniAfectado = $idMuniAfectado;
    }

    public function set_idTipoDocumental($idTipoDocumental)
    {
        $this->idTipoDocumental = $idTipoDocumental;
    }

    public function set_idRegimen($idRegimen)
    {
        $this->idRegimen = $idRegimen;
    }

    public function set_numDocuAfectado($numDocuAfectado)
    {
        $this->numDocuAfectado = $numDocuAfectado;
    }

    public function set_nomAfectado($nomAfectado)
    {
        $this->nomAfectado = $nomAfectado;
    }

    public function set_dirAfectado($dirAfectado)
    {
        $this->dirAfectado = $dirAfectado;
    }

    public function set_telAfectado($telAfectado)
    {
        $this->telAfectado = $telAfectado;
    }

    public function set_movilAfectado($movilAfectado)
    {
        $this->movilAfectado = $movilAfectado;
    }

    public function set_detalleSolicitud($detalleSolicitud)
    {
        $this->detalleSolicitud = $detalleSolicitud;
    }

    public function set_falloJuducial($falloJuducial)
    {
        $this->falloJuducial = $falloJuducial;
    }

    public function set_fecHorTramite($fecHorTramite)
    {
        $this->fecHorTramite = $fecHorTramite;
    }

    public function Gestionar()
    {
        $conexion = new Conexion();

        try {
            if ($this->Accion == 'NUEVA_SOLICITUD') {
                $Sql = 'INSERT INTO `archivo_radica_recibidos_pqrsf`(`id_contacto`, `id_radica`, `id_tipo_docu_afectado`,
                            `id_depar_afectado`, `id_muni_afectado`, `id_tipodocumental`, `id_regimen`, `num_docu_afectado`,
                            `nom_afectado`, `dir_afectado`, `tel_afectado`, `movil_afectado`, `detalle_solicitud`, `fallo_judicial`)
                        VALUES (:id_contacto, :id_radica, :id_tipo_docu_afectado, :id_depar_afectado, :id_muni_afectado,
                            :id_tipodocumental, :id_regimen, :num_docu_afectado, :nom_afectado, :dir_afectado, :tel_afectado,
                            :movil_afectado, :detalle_solicitud, :fallo_judicial)';

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':id_contacto', $this->idContacto, PDO::PARAM_INT);
                $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
                $Instruc->bindParam(':id_tipo_docu_afectado', $this->idTipoDocuAfectado, PDO::PARAM_INT);
                $Instruc->bindParam(':id_depar_afectado', $this->idDeparAfectado, PDO::PARAM_INT);
                $Instruc->bindParam(':id_muni_afectado', $this->idMuniAfectado, PDO::PARAM_INT);
                $Instruc->bindParam(':id_tipodocumental', $this->idTipoDocumental, PDO::PARAM_INT);
                $Instruc->bindParam(':id_regimen', $this->idRegimen, PDO::PARAM_INT);
                $Instruc->bindParam(':num_docu_afectado', $this->numDocuAfectado, PDO::PARAM_STR);
                $Instruc->bindParam(':nom_afectado', $this->nomAfectado, PDO::PARAM_STR);
                $Instruc->bindParam(':dir_afectado', $this->dirAfectado, PDO::PARAM_STR);
                $Instruc->bindParam(':tel_afectado', $this->telAfectado, PDO::PARAM_STR);
                $Instruc->bindParam(':movil_afectado', $this->movilAfectado, PDO::PARAM_STR);
                $Instruc->bindParam(':detalle_solicitud', $this->detalleSolicitud, PDO::PARAM_STR);
                $Instruc->bindParam(':fallo_judicial', $this->falloJuducial, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($this->Accion == 'ESTABLECER_FECHA_TRAMITE') {
                $Sql = "UPDATE `archivo_radica_recibidos_pqrsf`
                        SET `fechor_tramite` = :fechor_tramite
                        WHERE `id_pqr` = :id_pqr";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':fechor_tramite', $this->fecHorTramite, PDO::PARAM_STR);
                $Instruc->bindParam(':id_pqr', $this->idPqr, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            }

            $this->idPqr = $conexion->lastInsertId();
            if ($Instruc) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo 'Ha surgido un error y no se puede ejecutar la consulta, PQR Online -> Gestionar, Accion ' . $this->Accion . $e->getMessage();
            exit;
        }
    }

    public static function Listar($request)
    {
        $conexion = new Conexion();

        try {

            if ($request['Accion'] == 1) {
                /******************************************************************************************/
                /*  LISTO LOS PQR PENDIENTES POR GESTIONAR
                /******************************************************************************************/
                $Sql = "SELECT `qpr`.`id_pqr`, `ra`.`id_radica`, `ra`.`fechor_radica`, `contac`.`num_docu`, `contac`.`nom_contac`, `depar_peticio`.`nom_depar` AS `depar_peticio`,
                            `muni_peticio`.`nom_muni` AS `muni_peticio`, `contac`.`dir` AS `dir_peticio`, `contac`.`tel` AS `tel_peticio`, `contac`.`cel` AS `cel_peticio`,
                            `qpr`.`num_docu_afectado`, `qpr`.`nom_afectado`, `depar_afecta`.`nom_depar` AS `depar_afectado`, `muni_afecta`.`nom_muni` AS `muni_afectado`,
                            `qpr`.`dir_afectado`, `qpr`.`tel_afectado`, `qpr`.`movil_afectado`, `qpr`.`detalle_solicitud`, `qpr`.`fallo_judicial`, `ra`.`id_serie`, `ra`.`id_subserie`,
                            `config_formaenvio`.`nom_formaenvi`, `regimen`.`nom_regimen` , `tipo_soli`.`nom_tipo` AS `tipo_solicitud`
                        FROM`archivo_radica_recibidos` AS `ra`
                            INNER JOIN `gene_terceros_contac` AS `contac` ON (`ra`.`id_remite` = `contac`.`id_tercero`)
                            INNER JOIN `config_formaenvio` ON (`ra`.`id_forma_llegada` = `config_formaenvio`.`id_formaenvio`)
                            INNER JOIN `config_depar` AS `depar_peticio` ON (`contac`.`id_depar` = `depar_peticio`.`id_depar`)
                            INNER JOIN `config_muni` AS `muni_peticio` ON (`contac`.`id_muni` = `muni_peticio`.`id_muni`)
                            INNER JOIN `archivo_radica_recibidos_pqrsf` AS `qpr`     ON (`qpr`.`id_radica` = `ra`.`id_radica`)
                            INNER JOIN `config_depar` AS `depar_afecta` ON (`qpr`.`id_depar_afectado` = `depar_afecta`.`id_depar`)
                            INNER JOIN `config_muni` AS `muni_afecta` ON (`qpr`.`id_muni_afectado` = `muni_afecta`.`id_muni`)
                            INNER JOIN `config_regimen` AS `regimen` ON (`qpr`.`id_regimen` = `regimen`.`id_regimen`)
                            INNER JOIN `config_tipo_correspondencia` AS `tipo_soli` ON (`qpr`.`id_tipodocumental` = `tipo_soli`.`id_tipo`)
                        WHERE (`ra`.`id_serie` IS NULL AND `ra`.`id_subserie` IS NULL);";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($request['Accion'] == 2) {

                /******************************************************************************************/
                /*  LISTO LOS PQR DE UN SUSUARIO DESDE EL MODULO QPR ONLINE
                /******************************************************************************************/
                $Sql = "SELECT `qpr`.`id_pqr`, `qpr`.`fechor_tramite`, `ra_reci`.`id_radica` AS `id_radica_recibido`, `ra_reci`.`fechor_radica` AS `fechor_radica_recibido`
                            , `ra_envia`.`id_radica` AS `id_radica_enviado`, `ra_envia`.`fechor_radica` AS `fechor_radica_enviado`
                        FROM `archivo_radica_recibidos_pqrsf` AS `qpr`
                            INNER JOIN `archivo_radica_recibidos` AS `ra_reci` ON (`qpr`.`id_radica` = `ra_reci`.`id_radica`)
                             LEFT JOIN `archivo_radica_enviados` AS `ra_envia` ON (`ra_envia`.`id_radica` = `ra_reci`.`radica_respuesta`)
                        WHERE (`qpr`.`id_contacto` = :id_contacto)
                        ORDER BY `ra_reci`.`fechor_radica` DESC;";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":id_contacto", $request['id_contacto'], PDO::PARAM_INT);
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
                /*  BUSCO UNA SOLICITUD PARA TRAMITAR
                /******************************************************************************************/
                $Sql = "SELECT *
                        FROM `archivo_radica_recibidos_pqrsf`
                        WHERE `id_pqr` = :id_pqr";
                $Instruc = $conexion->prepare($Sql);

                $Instruc->bindParam(':id_pqr', $request['idPqr'], PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            }

            $Result = $Instruc->fetch();
            $conexion = null;

            if ($Result) {
                return new self(
                    "",
                    $Result['id_pqr'],
                    $Result['id_contacto'],
                    $Result['id_radica'],
                    $Result['id_tipo_docu_afectado'],
                    $Result['id_depar_afectado'],
                    $Result['id_muni_afectado'],
                    $Result['id_tipodocumental'],
                    $Result['id_regimen'],
                    $Result['num_docu_afectado'],
                    $Result['nom_afectado'],
                    $Result['dir_afectado'],
                    $Result['tel_afectado'],
                    $Result['movil_afectado'],
                    $Result['detalle_solicitud'],
                    $Result['fallo_judicial']
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
