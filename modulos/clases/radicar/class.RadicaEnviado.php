<?php
class RadicadoEnviado
{
    //Atributos
    private $Accion;
    private $IdRadica;
    private $IdDestinatario;
    private $IdSerie;
    private $IdSubserie;
    private $IdTipoDoc;
    private $IdUsuaRegis;
    private $FormaEnvio;
    private $IdTipoRespues;
    private $IdRuta;
    private $FecRadica;
    private $FecDocu;
    private $Asunto;
    private $NumAnexos;
    private $NumFolios;
    private $ObservaAnexos;
    private $Digital;
    private $ImpriRotu;
    private $FecHorImpriRoru;
    private $UsuaImpriRotu;
    private $IdRadicaRespues;
    private $Enviado;
    private $Transferido;
    private $NumeroGuia;
    private $Texto;
    private $OpcionRelecion;
    private $OpcionTitulo;
    private $OpcionSubTitulo;
    private $OpcionDetalle1;
    private $OpcionDetalle2;
    private $OpcionDetalle3;
    private $NombreArchivo;
    private $Archivo;
    private $TipoCargueArchivo;

    public function __construct(
        $Accion = null,
        $IdRadica = null,
        $IdDestinatario = null,
        $IdSerie = null,
        $IdSubserie = null,
        $IdTipoDoc = null,
        $IdUsuaRegis = null,
        $FormaEnvio = null,
        $IdTipoRespues = null,
        $IdRuta = null,
        $FecRadica = null,
        $FecDocu = null,
        $Asunto = null,
        $NumAnexos = null,
        $NumFolios = null,
        $ObservaAnexos = null,
        $Digital = null,
        $ImpriRotu = null,
        $FecHorImpriRoru = null,
        $UsuaImpriRotu = null,
        $IdRadicaRespues = null,
        $Enviado = null,
        $Transferido = null,
        $NumeroGuia = null,
        $Texto = null,
        $OpcionRelecion = null,
        $OpcionTitulo = null,
        $OpcionSubTitulo = null,
        $OpcionDetalle1 = null,
        $OpcionDetalle2 = null,
        $OpcionDetalle3 = null,
        $NombreArchivo = null,
        $Archivo = null,
        $TipoCargueArchivo = null
    ) {

        $this->Accion          = $Accion;
        $this->IdRadica        = $IdRadica;
        $this->IdDestinatario  = $IdDestinatario;
        $this->IdSerie         = $IdSerie;
        $this->IdSubserie      = $IdSubserie;
        $this->IdTipoDoc       = $IdTipoDoc;
        $this->IdUsuaRegis     = $IdUsuaRegis;
        $this->FormaEnvio      = $FormaEnvio;
        $this->IdTipoRespues   = $IdTipoRespues;
        $this->IdRuta          = $IdRuta;
        $this->FecRadica       = $FecRadica;
        $this->FecDocu         = $FecDocu;
        $this->Asunto          = $Asunto;
        $this->NumAnexos       = $NumAnexos;
        $this->NumFolios       = $NumFolios;
        $this->ObservaAnexos    = $ObservaAnexos;
        $this->Digital         = $Digital;
        $this->ImpriRotu       = $ImpriRotu;
        $this->FecHorImpriRoru = $FecHorImpriRoru;
        $this->UsuaImpriRotu   = $UsuaImpriRotu;
        $this->IdRadicaRespues = $IdRadicaRespues;
        $this->Enviado         = $Enviado;
        $this->Transferido     = $Transferido;
        $this->NumeroGuia      = $NumeroGuia;
        $this->Texto           = $Texto;
        $this->OpcionRelecion  = $OpcionRelecion;
        $this->OpcionTitulo    = $OpcionTitulo;
        $this->OpcionSubTitulo = $OpcionSubTitulo;
        $this->OpcionDetalle1  = $OpcionDetalle1;
        $this->OpcionDetalle2  = $OpcionDetalle2;
        $this->OpcionDetalle3  = $OpcionDetalle3;
        $this->NombreArchivo = $NombreArchivo;
        $this->Archivo  = $Archivo;
        $this->TipoCargueArchivo = $TipoCargueArchivo;
    }

    public function get_IdRadica()
    {
        return $this->IdRadica;
    }

    public function get_IdDestinatario()
    {
        return $this->IdDestinatario;
    }

    public function get_IdSerie()
    {
        return $this->IdSerie;
    }

    public function get_IdSubserie()
    {
        return $this->IdSubserie;
    }

    public function get_IdTipoDoc()
    {
        return $this->IdTipoDoc;
    }

    public function get_IdUsuaRegis()
    {
        return $this->IdUsuaRegis;
    }

    public function get_FormaEnvio()
    {
        return $this->FormaEnvio;
    }

    public function get_TipoRespuesta()
    {
        return $this->IdTipoRespues;
    }

    public function get_IdRuta()
    {
        return $this->IdRuta;
    }

    public function get_FecRadica()
    {
        return $this->FecRadica;
    }

    public function get_FecDocu()
    {
        return $this->FecDocu;
    }

    public function get_Asunto()
    {
        return $this->Asunto;
    }

    public function get_NumAnexos()
    {
        return $this->NumAnexos;
    }

    public function get_NumFolios()
    {
        return $this->NumFolios;
    }

    public function get_ObservaAnexos()
    {
        return $this->ObservaAnexos;
    }

    public function get_Digital()
    {
        return $this->Digital;
    }

    public function get_ImpriRotu()
    {
        return $this->ImpriRotu;
    }

    public function get_FecHorImpriRoru()
    {
        return $this->FecHorImpriRoru;
    }

    public function get_UsuaImpriRotu()
    {
        return $this->UsuaImpriRotu;
    }

    public function get_IdRadicaRespues()
    {
        return $this->IdRadicaRespues;
    }

    public function get_Enviado()
    {
        return $this->IdRadicaRespues;
    }

    public function get_Transferido()
    {
        return $this->Transferido;
    }

    public function getNum_Guia()
    {
        return $this->NumeroGuia;
    }

    public function getNum_Texto()
    {
        return $this->Texto;
    }

    public function get_OpcionRelecion()
    {
        return $this->OpcionRelecion;
    }

    public function get_OpcionTitulo()
    {
        return $this->OpcionTitulo;
    }

    public function get_OpcionSubTitulo()
    {
        return $this->OpcionSubTitulo;
    }

    public function get_OpcionDetalle1()
    {
        return $this->OpcionDetalle1;
    }

    public function get_OpcionDetalle2()
    {
        return $this->OpcionDetalle2;
    }

    public function get_OpcionDetalle3()
    {
        return $this->OpcionDetalle3;
    }

    public function get_NombreArchivo()
    {
        return $this->NombreArchivo;
    }

    public function get_Archivo()
    {
        return $this->Archivo;
    }

    public function get_TipoCargueArchivo()
    {
        return $this->TipoCargueArchivo;
    }

    ///////////////////////////////////////////////////

    public function set_Accion($Accion)
    {
        return $this->Accion = $Accion;
    }

    public function set_IdRadica($IdRadica)
    {
        return $this->IdRadica = $IdRadica;
    }

    public function set_IdDestinatario($IdDestinatario)
    {
        return $this->IdDestinatario = $IdDestinatario;
    }

    public function set_IdSerie($IdSerie)
    {
        return $this->IdSerie = $IdSerie;
    }

    public function set_IdSubserie($IdSubserie)
    {
        return $this->IdSubserie = $IdSubserie;
    }

    public function set_IdTipoDoc($IdTipoDoc)
    {
        return $this->IdTipoDoc = $IdTipoDoc;
    }

    public function set_IdUsuaRegis($IdUsuaRegis)
    {
        return $this->IdUsuaRegis = $IdUsuaRegis;
    }

    public function set_FormaEnvio($FormaEnvio)
    {
        return $this->FormaEnvio = $FormaEnvio;
    }

    public function set_TipoRespuesta($IdTipoRespues)
    {
        return $this->IdTipoRespues = $IdTipoRespues;
    }

    public function set_IdRuta($IdRuta)
    {
        return $this->IdRuta = $IdRuta;
    }

    public function set_FecRadica($FecRadica)
    {
        return $this->FecRadica = $FecRadica;
    }

    public function set_FecDocu($FecDocu)
    {
        return $this->FecDocu = $FecDocu;
    }

    public function set_Asunto($Asunto)
    {
        return $this->Asunto = $Asunto;
    }

    public function set_NumAnexos($NumAnexos)
    {
        return $this->NumAnexos = $NumAnexos;
    }

    public function set_NumFolios($NumFolios)
    {
        return $this->NumFolios = $NumFolios;
    }

    public function set_ObservaAnexos($ObservaAnexos)
    {
        return $this->ObservaAnexos = $ObservaAnexos;
    }

    public function set_Digital($Digital)
    {
        return $this->Digital = $Digital;
    }

    public function set_ImpriRotu($ImpriRotu)
    {
        return $this->ImpriRotu = $ImpriRotu;
    }

    public function set_FecHorImpriRoru($FecHorImpriRoru)
    {
        return $this->FecHorImpriRoru = $FecHorImpriRoru;
    }

    public function set_UsuaImpriRotu($UsuaImpriRotu)
    {
        return $this->UsuaImpriRotu = $UsuaImpriRotu;
    }

    public function set_IdRadicaRespues($IdRadicaRespues)
    {
        return $this->IdRadicaRespues = $IdRadicaRespues;
    }

    public function set_Enviado($Enviado)
    {
        return $this->Enviado = $Enviado;
    }

    public function set_Transferido($Transferido)
    {
        return $this->Transferido = $Transferido;
    }

    public function setNum_Guia($NumeroGuia)
    {
        return $this->NumeroGuia = $NumeroGuia;
    }

    public function set_Texto($Texto)
    {
        return $this->Texto = $Texto;
    }

    public function set_OpcionRelecion($OpcionRelecion)
    {
        return $this->OpcionRelecion = $OpcionRelecion;
    }

    public function set_OpcionTitulo($OpcionTitulo)
    {
        return $this->OpcionTitulo = $OpcionTitulo;
    }

    public function set_OpcionSubTitulo($OpcionSubTitulo)
    {
        return $this->OpcionSubTitulo = $OpcionSubTitulo;
    }

    public function set_OpcionDetalle1($OpcionDetalle1)
    {
        return $this->OpcionDetalle1 = $OpcionDetalle1;
    }

    public function set_OpcionDetalle2($OpcionDetalle2)
    {
        return $this->OpcionDetalle2 = $OpcionDetalle2;
    }

    public function set_OpcionDetalle3($OpcionDetalle3)
    {
        return $this->OpcionDetalle3 = $OpcionDetalle3;
    }

    public function set_NombreArchivo($NombreArchivo)
    {
        return $this->NombreArchivo = $NombreArchivo;
    }
    public function set_Archivo($Archivo)
    {
        return $this->Archivo = $Archivo;
    }

    public function set_TipoCargueArchivo($TipoCargueArchivo)
    {
        return $this->TipoCargueArchivo = $TipoCargueArchivo;
    }

    //Metodos
    public function Gestionar()
    {
        $conexion = new Conexion();

        $ParamSerie = PDO::PARAM_INT;
        if ($this->IdSerie == "NULL") {
            $ParamSerie =  \PDO::PARAM_NULL;
        }

        $ParamSubSerie = PDO::PARAM_INT;
        if ($this->IdSubserie == "NULL") {
            $ParamSubSerie =  \PDO::PARAM_NULL;
        }

        $ParameOpcionRelacion = PDO::PARAM_STR;
        if ($this->OpcionRelecion == NULL or $this->OpcionRelecion === '') {
            $ParameOpcionRelacion = PDO::PARAM_NULL;
        }

        $ParameOpcionTitulo = PDO::PARAM_STR;
        if ($this->OpcionTitulo == NULL) {
            $ParameOpcionTitulo = PDO::PARAM_NULL;
        }

        $ParameOpcionSubTitulo = PDO::PARAM_STR;
        if ($this->OpcionSubTitulo == NULL) {
            $ParameOpcionSubTitulo = PDO::PARAM_NULL;
        }

        $ParameOpcionDetalle1 = PDO::PARAM_STR;
        if ($this->OpcionDetalle1 == NULL) {
            $ParameOpcionDetalle1 = PDO::PARAM_NULL;
        }

        $ParameOpcionDetalle2 = PDO::PARAM_STR;
        if ($this->OpcionDetalle2 == NULL) {
            $ParameOpcionDetalle2 = PDO::PARAM_NULL;
        }

        $ParameOpcionDetalle3 = PDO::PARAM_STR;
        if ($this->OpcionDetalle3 == NULL) {
            $ParameOpcionDetalle3 = PDO::PARAM_NULL;
        }

        $ParameIdRuta = PDO::PARAM_INT;
        if ($this->IdRuta == NULL) {
            $ParameIdRuta = PDO::PARAM_NULL;
        }

        try {
            if ($this->Accion == 'GUARDAR_RADICADO') {

                $Sql = "INSERT INTO archivo_radica_enviados(id_radica, id_usua_regis, id_formaenvio, id_tipo_respue, id_destina, id_serie, id_subserie, id_tipodoc,
                            fec_docu, fechor_radica, asunto, num_folio, num_anexos, observa_anexo, num_guia, texto, `opcion_relacion`,
                            `opcion_titulo`, `opcion_sub_titulo`, `opcion_detalle1`, `opcion_detalle2`, `opcion_detalle3`)
                       VALUES(:id_radica, :id_usua_regis, :id_formaenvio, :id_tipo_respue, :id_destina, :id_serie, :id_subserie, :id_tipodoc,
                            :fec_docu, :fechor_radica, :asunto, :num_folio, :num_anexos, :observa_anexo, :num_guia, :texto, :opcion_relacion,
                            :opcion_titulo, :opcion_sub_titulo, :opcion_detalle1, :opcion_detalle2, :opcion_detalle3)";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
                $Instruc->bindParam(':id_usua_regis', $this->IdUsuaRegis, PDO::PARAM_INT);
                $Instruc->bindParam(':id_destina', $this->IdDestinatario, PDO::PARAM_INT);
                $Instruc->bindParam(':id_formaenvio', $this->FormaEnvio, PDO::PARAM_INT);
                $Instruc->bindParam(':id_tipo_respue', $this->IdTipoRespues, PDO::PARAM_INT);
                $Instruc->bindParam(':id_serie', $this->IdSerie, $ParamSerie);
                $Instruc->bindParam(':id_subserie', $this->IdSubserie, $ParamSubSerie);
                $Instruc->bindParam(':id_tipodoc', $this->IdTipoDoc, PDO::PARAM_INT);
                $Instruc->bindParam(':fec_docu', $this->FecDocu, PDO::PARAM_STR);
                $Instruc->bindParam(':fechor_radica', $this->FecRadica, PDO::PARAM_STR);
                $Instruc->bindParam(':asunto', $this->Asunto, PDO::PARAM_STR);
                $Instruc->bindParam(':num_folio', $this->NumFolios, PDO::PARAM_INT);
                $Instruc->bindParam(':num_anexos', $this->NumAnexos, PDO::PARAM_INT);
                $Instruc->bindParam(':observa_anexo', $this->ObservaAnexos, PDO::PARAM_STR);
                $Instruc->bindParam(':num_guia', $this->NumeroGuia, PDO::PARAM_STR);
                $Instruc->bindParam(':texto', $this->Texto, PDO::PARAM_STR);
                $Instruc->bindParam(':opcion_relacion', $this->OpcionRelecion, $ParameOpcionRelacion);
                $Instruc->bindParam(':opcion_titulo', $this->OpcionTitulo, $ParameOpcionTitulo);
                $Instruc->bindParam(':opcion_sub_titulo', $this->OpcionSubTitulo, $ParameOpcionSubTitulo);
                $Instruc->bindParam(':opcion_detalle1', $this->OpcionDetalle1, $ParameOpcionDetalle1);
                $Instruc->bindParam(':opcion_detalle2', $this->OpcionDetalle2, $ParameOpcionDetalle2);
                $Instruc->bindParam(':opcion_detalle3', $this->OpcionDetalle3, $ParameOpcionDetalle3);
            } elseif ($this->Accion == 2) {
                $Sql = "UPDATE archivo_radica_enviados
                        SET impri_rotu = 1, usua_impri_rotu = :usua_impri_rotu, fechor_impri_rotu = :fechor_impri_rotu
                        WHERE id_radica = :id_radica";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':usua_impri_rotu', $this->UsuaImpriRotu, PDO::PARAM_INT);
                $Instruc->bindParam(':fechor_impri_rotu', $this->FecHorImpriRoru, PDO::PARAM_STR);
                $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
            } elseif ($this->Accion == 3) {
                $Sql = "UPDATE archivo_radica_enviados
                        SET adjunto = 1
                        WHERE id_radica = :id_radica";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
            } elseif ($this->Accion == 4) {
                //Cargar archivo
                $Sql = "UPDATE archivo_radica_enviados
                        SET nombre_archivo = :nombre_archivo, digital = 1, archivo = :archivo, tipo_cargue_archivos = :tipo_cargue_archivos
                        WHERE id_radica = :id_radica";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':nombre_archivo', $this->NombreArchivo, PDO::PARAM_STR);
                $Instruc->bindParam(':archivo', $this->Archivo, PDO::PARAM_STR);
                $Instruc->bindParam(':tipo_cargue_archivos', $this->TipoCargueArchivo, PDO::PARAM_INT);
                $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
            } elseif ($this->Accion === 'ELIMINAR_DIGITAL') {
                //Cargar archivo
                $Sql = "UPDATE archivo_radica_enviados
                        SET id_ruta = :id_ruta, nombre_archivo = null, digital = 1, archivo = null
                        WHERE id_radica = :id_radica";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':id_ruta', $this->IdRuta, $ParameIdRuta);
                $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
            } elseif ($this->Accion == 5) {
                $Sql = "UPDATE archivo_radica_enviados
                        SET id_ruta = :id_ruta
                        WHERE id_radica = :id_radica";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':id_ruta', $this->IdRuta, PDO::PARAM_INT);
                $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
            } elseif ($this->Accion == 6) {
                $Sql = "UPDATE archivo_radica_enviados
                        SET transferido = 1
                        WHERE id_radica = :id_radica";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
            } elseif ($this->Accion == 'ELIMINAR_RADICADO') {
                $Sql = "DELETE FROM archivo_radica_enviados
                        WHERE id_radica = :id_radica";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
            }

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

    public static function Listar_Varios($Accion, $IdRadicado, $IdFuncioDeta, $IdFuncio, $IdDepen, $IdOfi, $Criterio1, $Criterio2, $Criterio3)
    {

        $conexion = new Conexion();

        try {
            if ($Accion == 1) {
                /******************************************************************************************/
                /*  LISTO UN RADICADO EN PARTICULAR
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`, `FunRegis`.`cod_funcio` AS `cod_funcio_regis`, `FunRegis`.`nom_funcio` AS `nom_funcio_regis`,
                            `FunRegis`.`ape_funcio` AS `ape_funcio_regis`, `FormaEnvi`.`nom_formaenvi`, `DestinaEmpre`.`nit_empre`, `DestinaEmpre`.`razo_soci`,
                            `DestinaContac`.`num_docu`, `DestinaContac`.`nom_contac`, `DestinaContac`.`cargo`, `DeparEmpre`.`nom_depar` AS `nom_depar_empre`,
                            `MuniEmpre`.`nom_muni` AS `nom_muni_empre`, `DeparContac`.`nom_depar` AS `nom_depar_remite`, `MuniContac`.`nom_muni` AS `nom_muni_remite`,
                            `DestinaContac`.`dir` AS `dir_destina`, `DestinaContac`.`tel` AS `tel_destina`, `DestinaContac`.`cel` AS `cel_destina`, `DestinaContac`.`fax` AS `fax_destina`, `DestinaContac`.`cargo`,
                            `DestinaContac`.`email` AS `email_destina`, `Serie`.`cod_serie`, `Serie`.`nom_serie`, `SubSerie`.`cod_subserie`, `SubSerie`.`nom_subserie`,
                            `TipDoc`.`nom_tipodoc`, `radi`.`id_ruta`, `radi`.`fec_docu`, `radi`.`fechor_radica`, `radi`.`asunto`, `radi`.`num_anexos`,
                            `radi`.`num_folio`, `radi`.`digital`, `radi`.`adjunto`, `radi`.`impri_rotu`, `radi`.`enviado`,
                            `radi`.`trasnferido`, `radi`.`num_guia`, `re_recibido`.`radica_respuesta`, `radi`.`archivo`, `radi`.`tipo_cargue_archivos`
                        FROM`archivo_radica_enviados` AS `radi`
                            INNER JOIN `config_formaenvio` AS `FormaEnvi` ON (`radi`.`id_formaenvio` = `FormaEnvi`.`id_formaenvio`)
                            LEFT JOIN `archivo_trd_series` AS `Serie` ON (`Serie`.`id_serie` = `radi`.`id_serie`)
                            LEFT JOIN `archivo_trd_subserie` AS `SubSerie` ON (`SubSerie`.`id_subserie` = `radi`.`id_subserie`)
                            INNER JOIN `archivo_trd_tipo_docu` AS `TipDoc` ON (`radi`.`id_tipodoc` = `TipDoc`.`id_tipodoc`)
                            INNER JOIN `gene_terceros_contac` AS `DestinaContac` ON (`radi`.`id_destina` = `DestinaContac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `UsuaRegis` ON (`radi`.`id_usua_regis` = `UsuaRegis`.`id_usua`)
                            LEFT JOIN `archivo_radica_recibidos` AS `re_recibido` ON (`radi`.`id_radica` = `re_recibido`.`radica_respuesta`)
                            LEFT JOIN `gene_terceros_empresas` AS `DestinaEmpre` ON (`DestinaContac`.`id_empre` = `DestinaEmpre`.`id_empre`)
                            LEFT JOIN `config_depar` AS `DeparContac` ON (`DestinaContac`.`id_depar` = `DeparContac`.`id_depar`)
                            LEFT JOIN `config_muni` AS `MuniContac` ON (`DestinaContac`.`id_muni` = `MuniContac`.`id_muni`)
                            LEFT JOIN `config_depar` AS `DeparEmpre` ON (`DestinaEmpre`.`id_depar` = `DeparEmpre`.`id_depar`)
                            LEFT JOIN `config_muni` AS `MuniEmpre` ON (`DestinaEmpre`.`id_muni` = `MuniEmpre`.`id_muni`)
                            INNER JOIN `gene_funcionarios` AS `FunRegis` ON (`FunRegis`.`id_funcio` = `UsuaRegis`.`id_funcio`)
                        INNER JOIN `archivo_radica_enviados_responsa` AS `RaRespon` ON (`RaRespon`.`id_radica` = `radi`.`id_radica`)
                        WHERE `radi`.`id_radica` = :id_radica AND `RaRespon`.`respon` = 1";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":id_radica", $IdRadicado, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($Accion == 2) {

                /******************************************************************************************/
                /*   GERAR RADICADO YYYYMMDD-#####
                /******************************************************************************************/
                $Sql = "SELECT CONCAT(DATE_FORMAT(NOW(), '%Y%m%d'),'-', LPAD(COUNT(id_radica)+1, 5, 0)) AS IdRadicado
                        FROM archivo_radica_enviados
                        WHERE YEAR(fechor_radica) = YEAR(NOW())";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($Accion == 3) {

                /******************************************************************************************/
                /*  GERAR RADICADO 'COD DEPEN.COD CORRES.YYYYMMMDD-#####'
                /******************************************************************************************/
                $Sql = "SELECT CONCAT((SELECT CONCAT(cod_depen, cod_corres)
                                        FROM areas_dependencias
                                        WHERE id_depen = :id_depen),'.',DATE_FORMAT(NOW(),'%Y%m%d'),'-',LPAD(COUNT(id_radica)+1, 5, 0)) AS IdRadicado
                        FROM archivo_radica_enviados
                        WHERE YEAR(fechor_radica) = YEAR(NOW())";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":id_depen", $IdDepen, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($Accion == 4) {

                /******************************************************************************************/
                /*  GERAR RADICADO 'COD DEPEN.COD CORRES-#####'
                /******************************************************************************************/
                $Sql = "SELECT CONCAT((SELECT CONCAT(cod_depen, cod_corres)
                        FROM areas_dependencias
                        WHERE id_depen = :id_depen),'-',LPAD(COUNT(id_radica)+1, 5, 0)) AS IdRadicado
                        FROM archivo_radica_enviados
                        WHERE YEAR(fechor_radica) = YEAR(NOW())";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":id_depen", $IdDepen, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($Accion == 6) {

                /******************************************************************************************/
                /*  PLANILLA POR FECHAS
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`, `radi`.`asunto`, `radi`.`num_folio`, `radi`.`num_anexos`, `remite`.`nom_contac`,
                            `empre_remite`.`razo_soci`, `radi`.`num_guia`, `config_formaenvio`.`nom_formaenvi`, `quien_firma`.`nom_funcio` AS 'nom_funcio_quien_firma',
                            `quien_firma`.`ape_funcio` AS 'ape_funcio_quien_firma',  `depen_quien_firma`.`cod_depen` AS 'cod_depen_quien_firma',
                            `depen_quien_firma`.`cod_corres` AS 'cod_corres_quien_firma', `depen_quien_firma`.`nom_depen` AS 'nom_depen_quien_firma',
                            `respon`.`nom_funcio`, `respon`.`ape_funcio`, `depen`.`cod_depen`, `depen`.`cod_corres`, `depen`.`nom_depen`
                        FROM`archivo_radica_enviados` AS `radi`
                            INNER JOIN `gene_terceros_contac` AS `remite` ON (`radi`.`id_destina` = `remite`.`id_tercero`)
                            LEFT JOIN `gene_terceros_empresas` AS `empre_remite` ON (`remite`.`id_empre` = `empre_remite`.`id_empre`)
                            INNER JOIN `archivo_radica_enviados_responsa` ON (`archivo_radica_enviados_responsa`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `config_formaenvio` ON (`radi`.`id_formaenvio` = `config_formaenvio`.`id_formaenvio`)
                            INNER JOIN `archivo_radica_enviados_responsa` AS `ra_respon` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `respob_deta` ON (`ra_respon`.`id_funcio_deta` = `respob_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `respon` ON (`respob_deta`.`id_funcio` = `respon`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`respob_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            LEFT JOIN `archivo_radica_enviados_quienes_firman` AS `ra_quien_firma` ON (`radi`.`id_radica` = `ra_quien_firma`.`id_radica`)
                            LEFT JOIN `gene_funcionarios_deta` AS `quien_firma_deta` ON (`ra_quien_firma`.`id_funcio_deta` = `quien_firma_deta`.`id_funcio_deta`)
                            LEFT JOIN `gene_funcionarios` AS `quien_firma` ON (`quien_firma_deta`.`id_funcio` = `quien_firma`.`id_funcio`)
                            LEFT JOIN `areas_oficinas` AS `ofi_quien_firma` ON (`quien_firma_deta`.`id_oficina` = `ofi_quien_firma`.`id_oficina`)
                            LEFT JOIN `areas_dependencias` AS `depen_quien_firma` ON (`ofi_quien_firma`.`id_depen` = `depen_quien_firma`.`id_depen`)
                        WHERE (DATE(`radi`.`fechor_radica`) BETWEEN :criterio1 AND :criterio2 AND `archivo_radica_enviados_responsa`.`respon` = 1)
                        ORDER BY `radi`.`id_radica` ASC";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":criterio1", $Criterio1, PDO::PARAM_STR);
                $Instruc->bindParam(":criterio2", $Criterio2, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($Accion == 7) {

                /******************************************************************************************/
                /*  PLANILLA POR RANGO DE RADICADOS
                /******************************************************************************************/
                $Sql = "SELECT DISTINCT `radi`.`id_radica`, `radi`.`asunto`, `radi`.`num_folio`, `radi`.`num_anexos`, `remite`.`nom_contac`,
                            `empre_remite`.`razo_soci`, `radi`.`num_guia`, `config_formaenvio`.`nom_formaenvi`, `quien_firma`.`nom_funcio` AS 'nom_funcio_quien_firma',
                            `quien_firma`.`ape_funcio` AS 'ape_funcio_quien_firma',  `depen_quien_firma`.`cod_depen` AS 'cod_depen_quien_firma',
                            `depen_quien_firma`.`cod_corres` AS 'cod_corres_quien_firma', `depen_quien_firma`.`nom_depen` AS 'nom_depen_quien_firma',
                            `respon`.`nom_funcio`, `respon`.`ape_funcio`, `depen`.`cod_depen`, `depen`.`cod_corres`, `depen`.`nom_depen`
                        FROM`archivo_radica_enviados` AS `radi`
                            INNER JOIN `gene_terceros_contac` AS `remite` ON (`radi`.`id_destina` = `remite`.`id_tercero`)
                            LEFT JOIN `gene_terceros_empresas` AS `empre_remite` ON (`remite`.`id_empre` = `empre_remite`.`id_empre`)
                            INNER JOIN `archivo_radica_enviados_responsa` ON (`archivo_radica_enviados_responsa`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `config_formaenvio` ON (`radi`.`id_formaenvio` = `config_formaenvio`.`id_formaenvio`)
                            INNER JOIN `archivo_radica_enviados_responsa` AS `ra_respon` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `respob_deta` ON (`ra_respon`.`id_funcio_deta` = `respob_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `respon` ON (`respob_deta`.`id_funcio` = `respon`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`respob_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            LEFT JOIN `archivo_radica_enviados_quienes_firman` AS `ra_quien_firma` ON (`radi`.`id_radica` = `ra_quien_firma`.`id_radica`)
                            LEFT JOIN `gene_funcionarios_deta` AS `quien_firma_deta` ON (`ra_quien_firma`.`id_funcio_deta` = `quien_firma_deta`.`id_funcio_deta`)
                            LEFT JOIN `gene_funcionarios` AS `quien_firma` ON (`quien_firma_deta`.`id_funcio` = `quien_firma`.`id_funcio`)
                            LEFT JOIN `areas_oficinas` AS `ofi_quien_firma` ON (`quien_firma_deta`.`id_oficina` = `ofi_quien_firma`.`id_oficina`)
                            LEFT JOIN `areas_dependencias` AS `depen_quien_firma` ON (`ofi_quien_firma`.`id_depen` = `depen_quien_firma`.`id_depen`)
                        WHERE (`radi`.`id_radica` BETWEEN :criterio1 AND :criterio2 AND `archivo_radica_enviados_responsa`.`respon` = 1)
                        ORDER BY `radi`.`id_radica` ASC";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":criterio1", $Criterio1, PDO::PARAM_STR);
                $Instruc->bindParam(":criterio2", $Criterio2, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($Accion == 8) {
                /******************************************************************************************/
                /*  LISTO LOS RADICADOS MINIMOS Y MAXIMOS DE LA FECHA ACTUAL
                /******************************************************************************************/

                $Sql = "SELECT MIN(id_radica) AS 'RadicadoMin', MAX(id_radica) AS 'RadicadoMax'
                        FROM archivo_radica_enviados
                        WHERE DATE(`fechor_radica`) = '2018-03-23'";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($Accion == 9) {
                /******************************************************************************************/
                /*  LISTO LOS RADICADOS PARA GENERAR EL BACKUP
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`, `radi`.`asunto`, `radi`.`num_folio`, `remite`.`nom_contac`, `empre_remite`.`razo_soci`, `radi`.`num_guia`,
                            `config_formaenvio`.`nom_formaenvi`, `respon`.`nom_funcio`, `respon`.`ape_funcio`, `depen`.`cod_depen`,
                            `depen`.`cod_corres`, `depen`.`nom_depen`
                        FROM`archivo_radica_enviados` AS `radi`
                            INNER JOIN `gene_terceros_contac` AS `remite` ON (`radi`.`id_destina` = `remite`.`id_tercero`)
                            LEFT JOIN `gene_terceros_empresas` AS `empre_remite` ON (`remite`.`id_empre` = `empre_remite`.`id_empre`)
                            INNER JOIN `archivo_radica_enviados_responsa` ON (`archivo_radica_enviados_responsa`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `config_formaenvio` ON (`radi`.`id_formaenvio` = `config_formaenvio`.`id_formaenvio`)
                            INNER JOIN `archivo_radica_enviados_responsa` AS `ra_respon` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `respob_deta` ON (`ra_respon`.`id_funcio_deta` = `respob_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `respon` ON (`respob_deta`.`id_funcio` = `respon`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`respob_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                        WHERE (DATE(`radi`.`fechor_radica`) BETWEEN :criterio1 AND :criterio2 AND `archivo_radica_enviados_responsa`.`respon` = 1 AND `radi`.`id_ruta` = :criterio3)
                        ORDER BY `radi`.`id_radica` DESC";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":criterio1", $Criterio1, PDO::PARAM_STR);
                $Instruc->bindParam(":criterio2", $Criterio2, PDO::PARAM_STR);
                $Instruc->bindParam(":criterio3", $Criterio3, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($Accion == 11) {
                /******************************************************************************************/
                /*  LISTO LOS RADIACOD A LOS QUE LES HACEN FALTA EL ARCHIVO DIGITAL
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`, `radi`.`asunto`, `radi`.`fec_docu`, `radi`.`fechor_radica`, `radi`.`digital`, `radi`.`impri_rotu`,
                            `fun`.`nom_funcio`, `fun`.`ape_funcio`, `areas_dependencias`.`id_depen`, `areas_dependencias`.`nom_depen`,
                            `areas_oficinas`.`nom_oficina`, `terce_contac`.`nom_contac`, `terce_empre`.`razo_soci`, `funcio_radi`.`nom_funcio` AS `nom_funcio_radi`,
                            `funcio_radi`.`ape_funcio` AS `ape_funcio_radi`, `config_formaenvio`.`id_formaenvio`, `config_formaenvio`.`nom_formaenvi`,
                            `config_formaenvio`.`requie_digital`, `radi`.`impri_rotu`
                        FROM `archivo_radica_enviados_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_enviados` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_destina` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radi` ON (`radi`.`id_usua_regis` = `usua_radi`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio_deta` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `fun` ON (`funcio_deta`.`id_funcio` = `fun`.`id_funcio`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radi` ON (`usua_radi`.`id_funcio` = `funcio_radi`.`id_funcio`)
                            INNER JOIN `areas_oficinas` ON (`funcio_deta`.`id_oficina` = `areas_oficinas`.`id_oficina`)
                            INNER JOIN `areas_dependencias` ON (`areas_oficinas`.`id_depen` = `areas_dependencias`.`id_depen`)
                            INNER JOIN `config_formaenvio` ON (`radi`.`id_formaenvio` = `config_formaenvio`.`id_formaenvio`)
                        WHERE (`ra_respon`.`respon` = 1 AND `config_formaenvio`.`requie_digital` = 1 and `radi`.`digital`  = 0
                            or `radi`.`impri_rotu`  = 0)
                        ORDER BY `radi`.`fechor_radica` DESC";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($Accion == 12) {

                $Sql = "SELECT `radi`.`id_radica`, `radi`.`fechor_radica`, `radi`.`asunto`, `radi`.`num_folio`, `radi`.`num_anexos`, `radi`.`observa_anexo`,
                            `desti`.`nom_contac`, `desti_empre`.`razo_soci`, `funcio`.`nom_funcio`, `funcio`.`ape_funcio`, `depen`.`nom_depen`,
                            `depen`.`cod_corres`, `funcio_radica`.`nom_funcio` AS `nom_funcio_radica`, `funcio_radica`.`ape_funcio` AS `ape_funcio_radica`,
                            `ofi`.`cod_oficina`, `ofi`.`nom_oficina`
                        FROM `archivo_radica_enviados` AS `radi`
                            INNER JOIN `gene_terceros_contac` AS `desti` ON (`radi`.`id_destina` = `desti`.`id_tercero`)
                            INNER JOIN `archivo_radica_enviados_responsa` AS `ra_respon` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `segu_usua` AS `usua_regis` ON (`radi`.`id_usua_regis` = `usua_regis`.`id_usua`)
                            LEFT JOIN `gene_terceros_empresas` AS `desti_empre` ON (`desti_empre`.`id_empre` = `desti`.`id_empre`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio_deta` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio`.`id_funcio` = `funcio_deta`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`ofi`.`id_oficina` = `funcio_deta`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radica` ON (`funcio_radica`.`id_funcio` = `usua_regis`.`id_funcio`)
                    WHERE (`radi`.`id_radica` = :id_radica);";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":id_radica", $IdRadicado, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            }

            $Result = $Instruc->fetchAll();
            $conexion = null;
            return $Result;
        } catch (PDOException $e) {
            echo 'Ha surgido un error y no se puede ejecutar la consulta, Correspondencia enviada -> Listar Varios, Accion: .' . $Accion . " - " . $e->getMessage();
            exit;
        }
    }

    public static function Listar_Correspondencia($Accion, $IdRadicado, $IdFuncioDeta, $IdFuncio, $IdDepen, $IdOfi, $Criterio1, $Criterio2, $Criterio3)
    {
        $conexion = new Conexion();

        try {
            if ($Accion == 1) {
                /******************************************************************************************/
                /*  LISTO TODA LA CORRESPONDENCIA ENVIDA DE LA INSTITUCION
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`, `radi`.`asunto`, `radi`.`fec_docu`, `radi`.`fechor_radica`, `radi`.`digital`, `radi`.`impri_rotu`, `fun`.`nom_funcio`, `fun`.`ape_funcio`, `areas_dependencias`.`id_depen`, `areas_dependencias`.`nom_depen`, `areas_oficinas`.`nom_oficina`, `terce_contac`.`nom_contac`, `terce_empre`.`razo_soci`, `funcio_radi`.`nom_funcio` AS `nom_funcio_radi`, `funcio_radi`.`ape_funcio` AS `ape_funcio_radi`, `config_formaenvio`.`id_formaenvio`, `config_formaenvio`.`nom_formaenvi`, `config_formaenvio`.`requie_digital`, `radi`.`impri_rotu`
                        FROM `archivo_radica_enviados_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_enviados` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_destina` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radi` ON (`radi`.`id_usua_regis` = `usua_radi`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio_deta` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `fun` ON (`funcio_deta`.`id_funcio` = `fun`.`id_funcio`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radi` ON (`usua_radi`.`id_funcio` = `funcio_radi`.`id_funcio`)
                            INNER JOIN `areas_oficinas` ON (`funcio_deta`.`id_oficina` = `areas_oficinas`.`id_oficina`)
                            INNER JOIN `areas_dependencias` ON (`areas_oficinas`.`id_depen` = `areas_dependencias`.`id_depen`)
                            INNER JOIN `config_formaenvio` ON (`radi`.`id_formaenvio` = `config_formaenvio`.`id_formaenvio`)
                        ORDER BY `radi`.`fechor_radica` DESC
                        LIMIT :Criterio1, :Criterio2";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":Criterio1", $Criterio1, PDO::PARAM_STR);
                $Instruc->bindParam(":Criterio2", $Criterio2, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($Accion == 2) {
                /******************************************************************************************/
                /*  LISTO LOS RADICADOS ENVIADOS DE UN FUNCIONARIO
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`, `radi`.`fechor_radica`, `radi`.`asunto`, `radi`.`digital`, `funcio_deta`.`id_funcio_deta`,
                            `funcio`.`nom_funcio`, `funcio`.`ape_funcio`, `depen`.`nom_depen`, `ofi`.`nom_oficina`, `desti_contact`.`num_docu`, `desti_contact`.`nom_contac`,
                            `desti_empre`.`nit_empre`, `desti_empre`.`razo_soci`
                        FROM `archivo_radica_enviados` AS `radi`
                            INNER JOIN `gene_terceros_contac` AS `desti_contact` ON (`radi`.`id_destina` = `desti_contact`.`id_tercero`)
                            LEFT JOIN `gene_terceros_empresas` AS `desti_empre` ON (`desti_contact`.`id_empre` = `desti_empre`.`id_empre`)
                            INNER JOIN `archivo_radica_enviados_responsa` AS `ra_respon` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio_deta` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                        WHERE (`ra_respon`.`respon` = 1 AND `radi`.`trasnferido` = 0 AND `ra_respon`.`id_funcio_deta` = :id_funcio_deta)
                        ORDER BY `radi`.`fechor_radica` DESC
                        LIMIT :Criterio1, :Criterio2";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":id_funcio_deta", $IdFuncioDeta, PDO::PARAM_STR);
                $Instruc->bindParam(":Criterio1", $Criterio1, PDO::PARAM_STR);
                $Instruc->bindParam(":Criterio2", $Criterio2, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($Accion == 3) {
                /******************************************************************************************/
                /*  LISTO LA CORRESPONDENCIA RECIBIDA DE UN FUNCIONARIO JEFE DE UNA DEPENDENCIA
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`, `radi`.`asunto`, `radi`.`fec_docu`, `radi`.`fechor_radica`, `radi`.`digital`, `radi`.`impri_rotu`, `fun`.`nom_funcio`, `fun`.`ape_funcio`,
                            `depen`.`nom_depen`, `ofi`.`nom_oficina`, `desti`.`nom_contac`, `desti_empre`.`razo_soci`
                        FROM `archivo_radica_enviados_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_enviados` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `desti` ON (`radi`.`id_destina` = `desti`.`id_tercero`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio_deta` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `fun` ON (`funcio_deta`.`id_funcio` = `fun`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            LEFT JOIN `gene_terceros_empresas` AS `desti_empre` ON (`desti`.`id_empre` = `desti_empre`.`id_empre`)
                        WHERE `ra_respon`.`respon` = 1 AND `radi`.`trasnferido` = 0 AND `ofi`.`id_depen` = :id_depen
                        ORDER BY `radi`.`id_radica` DESC
                        LIMIT :Criterio1, :Criterio2";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":id_depen", $IdDepen, PDO::PARAM_INT);
                $Instruc->bindParam(":Criterio1", $Criterio1, PDO::PARAM_STR);
                $Instruc->bindParam(":Criterio2", $Criterio2, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($Accion == 4) {
                /******************************************************************************************/
                /*  LISTO LOS RADICADOS ENVIADOS DE UN JEFE DE OFICINA
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`, `radi`.`asunto`, `radi`.`fec_docu`, `radi`.`fechor_radica`, `radi`.`digital`, `radi`.`impri_rotu`, `fun`.`nom_funcio`, `fun`.`ape_funcio`,
                            `depen`.`nom_depen`, `ofi`.`nom_oficina`, `desti`.`nom_contac`, `desti_empre`.`razo_soci`
                        FROM `archivo_radica_enviados_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_enviados` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `desti` ON (`radi`.`id_destina` = `desti`.`id_tercero`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio_deta` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `fun` ON (`funcio_deta`.`id_funcio` = `fun`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            LEFT JOIN `gene_terceros_empresas` AS `desti_empre` ON (`desti`.`id_empre` = `desti_empre`.`id_empre`)
                        WHERE `respon`.`respon` = 1 AND `radi`.`trasnferido` = 0 AND `depen`.`id_depen` = :id_depen AND `funcio_deta`.`id_oficina` = :id_oficina
                        ORDER BY `radi`.`id_radica` DESC
                        LIMIT :Criterio1, :Criterio2";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":id_depen", $IdFuncioDeta, PDO::PARAM_STR);
                $Instruc->bindParam(":id_oficina", $IdFuncioDeta, PDO::PARAM_STR);
                $Instruc->bindParam(":Criterio1", $Criterio1, PDO::PARAM_STR);
                $Instruc->bindParam(":Criterio2", $Criterio2, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($Accion == 5) {
                /******************************************************************************************/
                /*  FILTRO TODA LA CORRESPONDENCIA ENVIDA DE LA INSTITUCION
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`, `radi`.`asunto`, `radi`.`fec_docu`, `radi`.`fechor_radica`, `radi`.`digital`, `radi`.`impri_rotu`,
                            `fun`.`nom_funcio`, `fun`.`ape_funcio`, `areas_dependencias`.`id_depen`, `areas_dependencias`.`nom_depen`,
                            `areas_oficinas`.`nom_oficina`, `terce_contac`.`nom_contac`, `terce_empre`.`razo_soci`, `funcio_radi`.`nom_funcio` AS `nom_funcio_radi`,
                            `funcio_radi`.`ape_funcio` AS `ape_funcio_radi`, `config_formaenvio`.`id_formaenvio`, `config_formaenvio`.`nom_formaenvi`,
                            `config_formaenvio`.`requie_digital`, `radi`.`impri_rotu`
                        FROM `archivo_radica_enviados_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_enviados` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_destina` = `terce_contac`.`id_tercero`)
                            INNER JOIN `segu_usua` AS `usua_radi` ON (`radi`.`id_usua_regis` = `usua_radi`.`id_usua`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio_deta` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `fun` ON (`funcio_deta`.`id_funcio` = `fun`.`id_funcio`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radi` ON (`usua_radi`.`id_funcio` = `funcio_radi`.`id_funcio`)
                            INNER JOIN `areas_oficinas` ON (`funcio_deta`.`id_oficina` = `areas_oficinas`.`id_oficina`)
                            INNER JOIN `areas_dependencias` ON (`areas_oficinas`.`id_depen` = `areas_dependencias`.`id_depen`)
                            INNER JOIN `config_formaenvio` ON (`radi`.`id_formaenvio` = `config_formaenvio`.`id_formaenvio`)
                        WHERE (`ra_respon`.`respon` = 1 AND `radi`.`trasnferido` = 0 " . self::Generar_Query_Correspondencia($Criterio3) . ")
                        ORDER BY `radi`.`fechor_radica` DESC
                        LIMIT :Criterio1, :Criterio2";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":Criterio1", $Criterio1, PDO::PARAM_STR);
                $Instruc->bindParam(":Criterio2", $Criterio2, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($Accion == 6) {
                /******************************************************************************************/
                /*  FILTRO LA CORRESPONDENCIA INTERNA DE UN FUNCIONARIO
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`, `radi`.`asunto`, `radi`.`fec_docu`, `radi`.`fechor_radica`, `radi`.`digital`, `radi`.`impri_rotu`, `fun`.`nom_funcio`,
                            `fun`.`ape_funcio`, `depen`.`nom_depen`, `ofi`.`nom_oficina`, `terce_contac`.`nom_contac`, `terce_empre`.`razo_soci`
                        FROM `archivo_radica_enviados_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_enviados` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_destina` = `terce_contac`.`id_tercero`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio_deta` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `fun` ON (`funcio_deta`.`id_funcio` = `fun`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                        WHERE (`radi`.`trasnferido` = 0 AND `ra_respon`.`respon` = 1 AND `ra_respon`.`id_funcio_deta` = ?
                            " . self::Generar_Query_Correspondencia($Criterio3) . ")
                        ORDER BY `radi`.`fechor_radica` DESC
                        LIMIT ?, ?";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute(array($IdFuncioDeta, $Criterio1, $Criterio2))
                    or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            }

            $Result = $Instruc->fetchAll();
            $conexion = null;
            return $Result;
        } catch (PDOException $e) {
            echo 'Ha surgido un error y no se puede ejecutar la consulta, Correspondencia enviada -> Listar Correspodnencia, Accion: .' . $Accion . " - " . $e->getMessage();
            exit;
        }
    }

    public static function TotalRegistros_Correspondencia($Accion, $IdRadicado, $IdFuncioDeta, $IdFuncio, $IdDepen, $IdOfi, $Criterio1, $Criterio2, $Criterio3)
    {
        $conexion = new Conexion();

        try {
            if ($Accion == 1) {
                $Sql = "SELECT `RaSali`.`id_radica`
                        FROM `archivo_radica_enviados_responsa` AS `RaRespon`
                            INNER JOIN `archivo_radica_enviados` AS `RaSali` ON (`RaRespon`.`id_radica` = `RaSali`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `DestinaContac` ON (`RaSali`.`id_destina` = `DestinaContac`.`id_tercero`)
                            INNER JOIN `gene_funcionarios_deta` AS `ResponDeta` ON (`RaRespon`.`id_funcio_deta` = `ResponDeta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `Respon` ON (`ResponDeta`.`id_funcio` = `Respon`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `Ofi` ON (`ResponDeta`.`id_oficina` = `Ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `Depen` ON (`Ofi`.`id_depen` = `Depen`.`id_depen`)
                            LEFT JOIN `gene_terceros_empresas` AS `DestinaEmpre` ON (`DestinaContac`.`id_empre` = `DestinaEmpre`.`id_empre`)
                        WHERE `RaRespon`.`respon` = 1";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($Accion == 2) {

                /******************************************************************************************/
                /*  LISTO LOS RADICADOS ENVIADOS DE UN FUNCIONARIO
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`
                        FROM `archivo_radica_enviados_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_enviados` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `desti` ON (`radi`.`id_destina` = `desti`.`id_tercero`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio_deta` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `fun` ON (`funcio_deta`.`id_funcio` = `fun`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            LEFT JOIN `gene_terceros_empresas` AS `desti_empre` ON (`desti`.`id_empre` = `desti_empre`.`id_empre`)
                        WHERE `ra_respon`.`respon` = 1 AND `radi`.`trasnferido` = 0 AND `funcio_deta`.`id_funcio_deta` = :id_funcio_deta";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":id_funcio_deta", $IdFuncioDeta, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($Accion == 3) {
                /******************************************************************************************/
                /*  LISTO LA CORRESPONDENCIA RECIBIDA DE UN FUNCIONARIO JEFE DE UNA DEPENDENCIA
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`
                        FROM `archivo_radica_enviados_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_enviados` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `desti` ON (`radi`.`id_destina` = `desti`.`id_tercero`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio_deta` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `fun` ON (`funcio_deta`.`id_funcio` = `fun`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            LEFT JOIN `gene_terceros_empresas` AS `desti_empre` ON (`desti`.`id_empre` = `desti_empre`.`id_empre`)
                        WHERE `ra_respon`.`respon` = 1 AND `radi`.`trasnferido` = 0 AND `ofi`.`id_depen` = :id_depen";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":id_depen", $IdDepen, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($Accion == 4) {
                /******************************************************************************************/
                /*  LISTO LOS RADICADOS ENVIADOS DE UN JEFE DE OFICINA
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`
                        FROM `archivo_radica_enviados_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_enviados` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `desti` ON (`radi`.`id_destina` = `desti`.`id_tercero`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio_deta` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `fun` ON (`funcio_deta`.`id_funcio` = `fun`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            LEFT JOIN `gene_terceros_empresas` AS `desti_empre` ON (`desti`.`id_empre` = `desti_empre`.`id_empre`)
                        WHERE `ra_respon`.`respon` = 1 AND `radi`.`trasnferido` = 0 AND `depen`.`id_depen` = :id_depen AND `funcio_deta`.`id_oficina` = :id_oficina";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":id_depen", $IdDepen, PDO::PARAM_INT);
                $Instruc->bindParam(":id_oficina", $IdOfi, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($Accion == 5) {
                /******************************************************************************************/
                /*  FILTRO TODA LA CORRESPONDENCIA ENVIDA DE LA INSTITUCION
                /******************************************************************************************/

                $Sql = "SELECT `radi`.`id_radica`
                        FROM `archivo_radica_enviados_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_enviados` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `desti` ON (`radi`.`id_destina` = `desti`.`id_tercero`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio_deta` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `fun` ON (`funcio_deta`.`id_funcio` = `fun`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            LEFT JOIN `gene_terceros_empresas` AS `desti_empre` ON (`desti`.`id_empre` = `desti_empre`.`id_empre`)
                        WHERE (`ra_respon`.`respon` = 1 AND `radi`.`trasnferido` = 0 " . self::Generar_Query_Correspondencia($Criterio3) . ")";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($Accion == 6) {
                /******************************************************************************************/
                /*  FILTRO LA CORRESPONDENCIA RECIBIDA DE UN FUNCIONARIO
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`
                        FROM `archivo_radica_enviados` AS `radi`
                            INNER JOIN `gene_terceros_contac` AS `desti_contact` ON (`radi`.`id_destina` = `desti_contact`.`id_tercero`)
                            LEFT JOIN `archivo_radica_recibidos` AS `re_recibido` ON (`radi`.`id_radica` = `re_recibido`.`radica_respuesta`)
                            LEFT JOIN `gene_terceros_empresas` AS `desti_empre` ON (`desti_contact`.`id_empre` = `desti_empre`.`id_empre`)
                            INNER JOIN `archivo_radica_enviados_responsa` AS `ra_respon` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio_deta` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                        WHERE (`ra_respon`.`respon` = 1 AND `radi`.`trasnferido` = 0 AND `ra_respon`.`id_funcio_deta` = ? " . self::Generar_Query_Correspondencia($Criterio3) . ")";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute(array($IdFuncioDeta)) or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            }

            $Result = $Instruc->rowCount();
            $conexion = null;
            return $Result;
        } catch (PDOException $e) {
            echo 'Ha surgido un error y no se puede ejecutar la consulta, Correspondencia enviada -> Total registros correspondencia, Accion: .' . $Accion . " - " . $e->getMessage();
            exit;
        }
    }

    public static function Listar_HC($Accion, $IdRadicado, $IdFuncioDeta, $IdFuncio, $IdDepen, $IdOfi, $Criterio1, $Criterio2, $Criterio3)
    {
        $conexion = new Conexion();

        try {
            if ($Accion == 1) {

                /******************************************************************************************/
                /*  LISTO LOS RADICADOS DE HISTORIA CLINICA ENVIADOS
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`, `radi`.`fec_docu`, `radi`.`asunto`, `radi`.`digital`, `radi`.`impri_rotu`, `depen`.`nom_depen`, `ofi`.`nom_oficina`, `cargo`.`nom_cargo`,
                            `pacien`.`num_docu` AS `num_docu_pacien`, `pacien`.`nom_contac` AS `nom_pacien`, `fun`.`nom_funcio`, `fun`.`ape_funcio`, `depen`.`nom_depen`,
                            `ofi`.`nom_oficina`, `cargo`.`nom_cargo`, `ra_recibi`.`radica_respuesta`, `tercer`.`num_docu` AS `num_docu_tercer`,
                            `tercer`.`nom_contac` AS `nom_contac_terce`, `empre_terce`.`razo_soci` AS `razo_soci_terce`
                        FROM `archivo_radica_enviados_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_enviados` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `pacien` ON (`radi`.`id_destina` = `pacien`.`id_tercero`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_Deta` ON (`ra_respon`.`id_funcio_deta` = `funcio_Deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `fun` ON (`funcio_Deta`.`id_funcio` = `fun`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_Deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_cargos` AS `cargo` ON (`funcio_Deta`.`id_cargo` = `cargo`.`id_cargo`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            INNER JOIN `config_otras_responsables_hc` ON (`config_otras_responsables_hc`.`id_subserie` = `radi`.`id_subserie`)
                                AND (`config_otras_responsables_hc`.`id_tipodoc` = `radi`.`id_tipodoc`)
                                AND (`config_otras_responsables_hc`.`id_serie` = `radi`.`id_serie`)
                            INNER JOIN `archivo_radica_recibidos` AS `ra_recibi` ON (`radi`.`id_radica` = `ra_recibi`.`radica_respuesta`)
                                AND (`config_otras_responsables_hc`.`id_funcio_deta` = `funcio_Deta`.`id_funcio_deta`)
                                AND (`config_otras_responsables_hc`.`id_depen` = `depen`.`id_depen`)
                            INNER JOIN `archivo_radica_recibidos_hc` ON (`archivo_radica_recibidos_hc`.`id_radica` = `ra_recibi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `tercer` ON (`archivo_radica_recibidos_hc`.`id_tercero_facul` = `tercer`.`id_tercero`)
                            LEFT JOIN `gene_terceros_empresas` AS `empre_terce` ON (`tercer`.`id_empre` = `empre_terce`.`id_empre`)
                        WHERE (`ra_respon`.`respon` = 1)";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":criterio1", $Criterio1, PDO::PARAM_STR);
                $Instruc->bindParam(":criterio2", $Criterio2, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($Accion == 2) {
                /******************************************************************************************/
                /*  BUSQUEDA PARA HC ENVIADAS
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`, `radi`.`fec_docu`, `radi`.`asunto`, `radi`.`digital`, `radi`.`impri_rotu`, `depen`.`nom_depen`, `ofi`.`nom_oficina`, `cargo`.`nom_cargo`,
                            `pacien`.`num_docu` AS `num_docu_pacien`, `pacien`.`nom_contac` AS `nom_pacien`, `fun`.`nom_funcio`, `fun`.`ape_funcio`, `depen`.`nom_depen`,
                            `ofi`.`nom_oficina`, `cargo`.`nom_cargo`, `ra_recibi`.`radica_respuesta`, `tercer`.`num_docu` AS `num_docu_tercer`,
                            `tercer`.`nom_contac` AS `nom_contac_terce`, `empre_terce`.`razo_soci` AS `razo_soci_terce`
                        FROM `archivo_radica_enviados_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_enviados` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `pacien` ON (`radi`.`id_destina` = `pacien`.`id_tercero`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_Deta` ON (`ra_respon`.`id_funcio_deta` = `funcio_Deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `fun` ON (`funcio_Deta`.`id_funcio` = `fun`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_Deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_cargos` AS `cargo` ON (`funcio_Deta`.`id_cargo` = `cargo`.`id_cargo`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            INNER JOIN `config_otras_responsables_hc` ON (`config_otras_responsables_hc`.`id_subserie` = `radi`.`id_subserie`)
                                AND (`config_otras_responsables_hc`.`id_tipodoc` = `radi`.`id_tipodoc`)
                                AND (`config_otras_responsables_hc`.`id_serie` = `radi`.`id_serie`)
                            INNER JOIN `archivo_radica_recibidos` AS `ra_recibi` ON (`radi`.`id_radica` = `ra_recibi`.`radica_respuesta`)
                                AND (`config_otras_responsables_hc`.`id_funcio_deta` = `funcio_Deta`.`id_funcio_deta`)
                                AND (`config_otras_responsables_hc`.`id_depen` = `depen`.`id_depen`)
                            INNER JOIN `archivo_radica_recibidos_hc` ON (`archivo_radica_recibidos_hc`.`id_radica` = `ra_recibi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `tercer` ON (`archivo_radica_recibidos_hc`.`id_tercero_facul` = `tercer`.`id_tercero`)
                            LEFT JOIN `gene_terceros_empresas` AS `empre_terce` ON (`tercer`.`id_empre` = `empre_terce`.`id_empre`)
                        WHERE (`radi`.`respon` = 1
                                AND `radi`.`id_radica` LIKE ?
                                OR `radi`.`asunto` LIKE ?
                                OR CONCAT(`fun`.`nom_funcio`+' '+ `fun`.`ape_funcio` LIKE ?
                                OR `pacien`.`nom_contac` LIKE ?
                                OR `tercer`.`nom_contac` LIKE ?
                                OR `empre_terce`.`razo_soci` LIKE ?
                                OR `DestinaEmpre`.`razo_soci` LIKE ?
                                OR `DestinaContac`.`nom_contac` LIKE ?)
                        ORDER BY `radi`.`fechor_radica` DESC
                        LIMIT ?, ?";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute(array('%' . $Criterio3 . '%', '%' . $Criterio3 . '%', '%' . $Criterio3 . '%', '%' . $Criterio3 . '%', '%' . $Criterio3 . '%', '%' . $Criterio3 . '%', '%' . $Criterio3 . '%', '%' . $Criterio3 . '%', $Criterio1, $Criterio2))
                    or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            }

            $Result = $Instruc->fetchAll();
            $conexion = null;
            return $Result;
        } catch (PDOException $e) {
            echo 'Ha surgido un error y no se puede ejecutar la consulta, Correspondencia enviada -> Listar HC, Accion: .' . $Accion . " - " . $e->getMessage();
            exit;
        }
    }

    public static function TotalRegistros_HC($Accion, $IdRadicado, $IdFuncioDeta, $IdFuncio, $IdDepen, $IdOfi, $Criterio1, $Criterio2, $Criterio3)
    {
        $conexion = new Conexion();

        try {
            if ($Accion == 1) {
                $Sql = "SELECT `RaSali`.`id_radica`
                        FROM `archivo_radica_enviados_responsa` AS `RaRespon`
                            INNER JOIN `archivo_radica_enviados` AS `RaSali` ON (`RaRespon`.`id_radica` = `RaSali`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `DestinaContac` ON (`RaSali`.`id_destina` = `DestinaContac`.`id_tercero`)
                            INNER JOIN `gene_funcionarios_deta` AS `ResponDeta` ON (`RaRespon`.`id_funcio_deta` = `ResponDeta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `Respon` ON (`ResponDeta`.`id_funcio` = `Respon`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `Ofi` ON (`ResponDeta`.`id_oficina` = `Ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `Depen` ON (`Ofi`.`id_depen` = `Depen`.`id_depen`)
                            LEFT JOIN `gene_terceros_empresas` AS `DestinaEmpre` ON (`DestinaContac`.`id_empre` = `DestinaEmpre`.`id_empre`)
                        WHERE `RaRespon`.`respon` = 1";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($Accion == 5) {
                /******************************************************************************************/
                /*  FILTRO TODA LA CORRESPONDENCIA ENVIDA DE LA INSTITUCION
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`, `radi`.`fechor_radica`, `radi`.`fec_docu`, `radi`.`digital`, `radi`.`asunto`
                            , `desti`.`nom_contac`, `desti_empre`.`razo_soci`, `fun`.`nom_funcio`, `fun`.`ape_funcio`
                            , `depen`.`cod_corres`, `depen`.`nom_depen`, `ofi`.`nom_oficina`, `radi`.`impri_rotu`
                        FROM `archivo_radica_enviados_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_enviados` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `desti` ON (`radi`.`id_destina` = `desti`.`id_tercero`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio_deta` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `fun` ON (`funcio_deta`.`id_funcio` = `fun`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            LEFT JOIN `gene_terceros_empresas` AS `desti_empre` ON (`desti`.`id_empre` = `desti_empre`.`id_empre`)
                            INNER JOIN `archivo_trd_series` AS `serie` ON (`radi`.`id_serie` = `serie`.`id_serie`)
                        WHERE (`ra_respon`.`respon` = 1 AND `radi`.`trasnferido` = 0)
                            AND `radi`.`id_radica` IN(SELECT `ra_fil`.`id_radica`
                                                FROM `archivo_radica_enviados_responsa` AS `respon_fil`
                                                    INNER JOIN `archivo_radica_enviados` AS `ra_fil` ON (`respon_fil`.`id_radica` = `ra_fil`.`id_radica`)
                                                    INNER JOIN `gene_funcionarios_deta` AS `funcio_deta_fil` ON (`respon_fil`.`id_funcio_deta` = `funcio_deta_fil`.`id_funcio_deta`)
                                                    INNER JOIN `gene_funcionarios` AS `funcio_fil` ON (`funcio_deta_fil`.`id_funcio` = `funcio_fil`.`id_funcio`)
                                                    INNER JOIN `gene_terceros_contac` AS `contac_fil` ON (`ra_fil`.`id_destina` = `contac_fil`.`id_tercero`)
                                                    LEFT JOIN `gene_terceros_empresas` AS `empre_fil` ON (`contac_fil`.`id_empre` = `empre_fil`.`id_empre`)
                                                WHERE (MATCH(`ra_fil`.`asunto`) AGAINST(?)
                                                    OR CONCAT(`funcio_fil`.`nom_funcio`, ' ',`funcio_fil`.`ape_funcio`) LIKE ?
                                                    OR `contac_fil`.`num_docu` LIKE ?
                                                    OR `contac_fil`.`nom_contac` LIKE ?
                                                    OR `empre_fil`.`razo_soci` LIKE ?))";
                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute(array('%' . $Criterio3 . '%', '%' . $Criterio3 . '%', '%' . $Criterio3 . '%', '%' . $Criterio3 . '%', '%' . $Criterio3 . '%'))
                    or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($Accion == 9) {

                /******************************************************************************************/
                /*  PLANILLA POR FECHAS
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`, `radi`.`asunto`, `radi`.`num_folio`, `remite`.`nom_contac`, `empre_remite`.`razo_soci`, `radi`.`num_guia`,
                            `config_formaenvio`.`nom_formaenvi`, `respon`.`nom_funcio`, `respon`.`ape_funcio`, `depen`.`cod_depen`,
                            `depen`.`cod_corres`, `depen`.`nom_depen`
                        FROM`archivo_radica_enviados` AS `radi`
                            INNER JOIN `gene_terceros_contac` AS `remite` ON (`radi`.`id_destina` = `remite`.`id_tercero`)
                            LEFT JOIN `gene_terceros_empresas` AS `empre_remite` ON (`remite`.`id_empre` = `empre_remite`.`id_empre`)
                            INNER JOIN `archivo_radica_enviados_responsa` ON (`archivo_radica_enviados_responsa`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `config_formaenvio` ON (`radi`.`id_formaenvio` = `config_formaenvio`.`id_formaenvio`)
                            INNER JOIN `archivo_radica_enviados_responsa` AS `ra_respon` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `respob_deta` ON (`ra_respon`.`id_funcio_deta` = `respob_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `respon` ON (`respob_deta`.`id_funcio` = `respon`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`respob_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                        WHERE (`radi`.`fechor_radica` BETWEEN :criterio1 AND :criterio2 AND `archivo_radica_enviados_responsa`.`respon` = 1)
                        ORDER BY `radi`.`id_radica` DESC";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":criterio1", $Criterio1, PDO::PARAM_STR);
                $Instruc->bindParam(":criterio2", $Criterio2, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($Accion == 13) {

                /******************************************************************************************/
                /*  LISTO LOS RADICADOS DE HISTORIA CLINICA ENVIADOS
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`
                        FROM `archivo_radica_enviados_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_enviados` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `remi` ON (`radi`.`id_destina` = `remi`.`id_tercero`)
                            INNER JOIN `archivo_radica_recibidos` AS `ra_recibi` ON (`radi`.`id_radica` = `ra_recibi`.`radica_respuesta`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_Deta` ON (`ra_respon`.`id_funcio_deta` = `funcio_Deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `fun` ON (`funcio_Deta`.`id_funcio` = `fun`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_Deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_cargos` AS `cargo` ON (`funcio_Deta`.`id_cargo` = `cargo`.`id_cargo`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            LEFT JOIN `gene_terceros_empresas` AS `remi_empre` ON (`remi`.`id_empre` = `remi_empre`.`id_empre`)
                            INNER JOIN `config_otras_responsables_hc` ON (`config_otras_responsables_hc`.`id_tipodoc` = `radi`.`id_tipodoc`)
                                AND (`config_otras_responsables_hc`.`id_serie` = `radi`.`id_serie`)
                                AND (`config_otras_responsables_hc`.`id_subserie` = `radi`.`id_subserie`)
                                AND (`config_otras_responsables_hc`.`id_funcio_deta` = `funcio_Deta`.`id_funcio_deta`)
                                AND (`config_otras_responsables_hc`.`id_depen` = `depen`.`id_depen`)
                            INNER JOIN `archivo_radica_recibidos_hc` ON (`archivo_radica_recibidos_hc`.`id_radica` = `ra_recibi`.`id_radica`)";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($Accion == 18) {
                /******************************************************************************************/
                /*  LISTO LA CORRESPONDENCIA EXTERNA DE UN FUNCIONARIO NORMA
                /******************************************************************************************/
            } elseif ($Accion == 19) {
                /******************************************************************************************/
                /*  LISTO LA CORRESPONDENCIA EXTERNA DE UN FUNCIONARIO NORMA
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`, `radi`.`fechor_radica`, `radi`.`asunto`, `radi`.`digital`, `funcio_deta`.`id_funcio_deta`, `funcio`.`nom_funcio`,
                            `funcio`.`ape_funcio`, `depen`.`nom_depen`, `ofi`.`nom_oficina`, `DestinaContac`.`num_docu`, `DestinaContac`.`nom_contac`, `DestinaEmpre`.`nit_empre`,
                            `DestinaEmpre`.`razo_soci`, `re_recibido`.`id_radica` AS `id_radica_respues`, `radi`.`trasnferido`
                        FROM `archivo_radica_enviados` AS `radi`
                            INNER JOIN `gene_terceros_contac` AS `DestinaContac` ON (`radi`.`id_destina` = `DestinaContac`.`id_tercero`)
                            LEFT JOIN `archivo_radica_recibidos` AS `re_recibido` ON (`radi`.`id_radica` = `re_recibido`.`radica_respuesta`)
                            LEFT JOIN `gene_terceros_empresas` AS `DestinaEmpre` ON (`DestinaContac`.`id_empre` = `DestinaEmpre`.`id_empre`)
                            INNER JOIN `archivo_radica_enviados_responsa` AS `respon` ON (`respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`respon`.`id_funcio_deta` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                        WHERE `respon`.`respon` = 1 AND `radi`.`trasnferido` = 0 AND `funcio_deta`.`id_funcio_deta` = :id_funcio_deta";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":id_funcio_deta", $IdFuncioDeta, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($Accion == 20) {
                /******************************************************************************************/
                /*  LISTO LA CORRESPONDENCIA EXTERNA DEL PROPIETARIO PRINCIPAL DE LA INSTITUCION
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`, `radi`.`fechor_radica`, `radi`.`asunto`, `radi`.`digital`, `funcio_deta`.`id_funcio_deta`, `funcio`.`nom_funcio`,
                            `funcio`.`ape_funcio`, `depen`.`nom_depen`, `ofi`.`nom_oficina`, `DestinaContac`.`num_docu`, `DestinaContac`.`nom_contac`, `DestinaEmpre`.`nit_empre`,
                            `DestinaEmpre`.`razo_soci`, `re_recibido`.`id_radica` AS `id_radica_respues`
                        FROM `archivo_radica_enviados` AS `radi`
                            INNER JOIN `gene_terceros_contac` AS `DestinaContac` ON (`radi`.`id_destina` = `DestinaContac`.`id_tercero`)
                            LEFT JOIN `archivo_radica_recibidos` AS `re_recibido` ON (`radi`.`id_radica` = `re_recibido`.`radica_respuesta`)
                            LEFT JOIN `gene_terceros_empresas` AS `DestinaEmpre` ON (`DestinaContac`.`id_empre` = `DestinaEmpre`.`id_empre`)
                            INNER JOIN `archivo_radica_enviados_responsa` AS `respon` ON (`respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`respon`.`id_funcio_deta` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                        WHERE (`respon`.`respon` = 1)";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($Accion == 21) {
                /******************************************************************************************/
                /*  LISTO LA CORRESPONDENCIA EXTERNA DE UN FUNCIONARIO JEFE DE UNA DEPENDENCIA
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`, `radi`.`fechor_radica`, `radi`.`asunto`, `radi`.`digital`, `funcio_deta`.`id_funcio_deta`, `funcio`.`nom_funcio`,
                            `funcio`.`ape_funcio`, `depen`.`nom_depen`, `ofi`.`nom_oficina`, `DestinaContac`.`num_docu`, `DestinaContac`.`nom_contac`, `DestinaEmpre`.`nit_empre`,
                            `DestinaEmpre`.`razo_soci`, `re_recibido`.`id_radica` AS `id_radica_respues`, `radi`.`trasnferido`
                        FROM `archivo_radica_enviados` AS `radi`
                            INNER JOIN `gene_terceros_contac` AS `DestinaContac` ON (`radi`.`id_destina` = `DestinaContac`.`id_tercero`)
                            LEFT JOIN `archivo_radica_recibidos` AS `re_recibido` ON (`radi`.`id_radica` = `re_recibido`.`radica_respuesta`)
                            LEFT JOIN `gene_terceros_empresas` AS `DestinaEmpre` ON (`DestinaContac`.`id_empre` = `DestinaEmpre`.`id_empre`)
                            INNER JOIN `archivo_radica_enviados_responsa` AS `respon` ON (`respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`respon`.`id_funcio_deta` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                        WHERE `respon`.`respon` = 1 AND `radi`.`trasnferido` = 0 AND `ofi`.`id_depen` = :id_depen";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":id_depen", $IdDepen, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($Accion == 18) {
            } elseif ($Accion == 23) {
                /******************************************************************************************/
                /*  LISTO LAS SOLICITUDES DE HISTORIAS CLINICAS DE UN FUNCIONARIO
                /******************************************************************************************/
            } elseif ($Accion == 28) {
                /******************************************************************************************/
                /*  LISTO LOS RADICADOS PENDIENTES POR ADJUNTAR EL DIGITAL
                /******************************************************************************************/
                $Sql = "SELECT `RaSali`.`id_radica`, `RaSali`.`digital`, `RaSali`.`impri_rotu`, `RaSali`.`fec_docu`, `RaSali`.`asunto`, `Respon`.`nom_funcio`,
                            `Respon`.`ape_funcio`, `Depen`.`nom_depen`, `Ofi`.`nom_oficina`, `DestinaContac`.`nom_contac`, `DestinaContac`.`cargo`,
                            `DestinaEmpre`.`razo_soci`, `Depen`.`id_depen`
                        FROM `archivo_radica_enviados_responsa` AS `RaRespon`
                            INNER JOIN `archivo_radica_enviados` AS `RaSali` ON (`RaRespon`.`id_radica` = `RaSali`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `DestinaContac` ON (`RaSali`.`id_destina` = `DestinaContac`.`id_tercero`)
                            INNER JOIN `gene_funcionarios_deta` AS `ResponDeta` ON (`RaRespon`.`id_funcio_deta` = `ResponDeta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `Respon` ON (`ResponDeta`.`id_funcio` = `Respon`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `Ofi` ON (`ResponDeta`.`id_oficina` = `Ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `Depen` ON (`Ofi`.`id_depen` = `Depen`.`id_depen`)
                            LEFT JOIN `gene_terceros_empresas` AS `DestinaEmpre` ON (`DestinaContac`.`id_empre` = `DestinaEmpre`.`id_empre`)
                        WHERE `RaRespon`.`respon` = 1 AND `RaSali`.`digital` = 0
                        ORDER BY `RaSali`.`fechor_radica` DESC";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($Accion == 31) {
                $Sql = "SELECT `RaSali`.`id_radica`
                        FROM `archivo_radica_enviados_responsa` AS `RaRespon`
                            INNER JOIN `archivo_radica_enviados` AS `RaSali` ON (`RaRespon`.`id_radica` = `RaSali`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `DestinaContac` ON (`RaSali`.`id_destina` = `DestinaContac`.`id_tercero`)
                            INNER JOIN `gene_funcionarios_deta` AS `ResponDeta` ON (`RaRespon`.`id_funcio_deta` = `ResponDeta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `Respon` ON (`ResponDeta`.`id_funcio` = `Respon`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `Ofi` ON (`ResponDeta`.`id_oficina` = `Ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `Depen` ON (`Ofi`.`id_depen` = `Depen`.`id_depen`)
                            LEFT JOIN `gene_terceros_empresas` AS `DestinaEmpre` ON (`DestinaContac`.`id_empre` = `DestinaEmpre`.`id_empre`)
                        WHERE (`RaRespon`.`respon` = 1
                                AND `RaSali`.`id_radica` LIKE ?
                                OR `RaSali`.`asunto` LIKE ?
                                OR CONCAT(`Respon`.`nom_funcio`+' '+`Respon`.`ape_funcio`) LIKE ?
                                OR `DestinaEmpre`.`razo_soci` LIKE ?
                                OR `DestinaContac`.`nom_contac` LIKE ?)";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute(array('%' . $Criterio3 . '%', '%' . $Criterio3 . '%', '%' . $Criterio3 . '%', '%' . $Criterio3 . '%', '%' . $Criterio3 . '%'))
                    or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            }

            $Result = $Instruc->rowCount();
            $conexion = null;
            return $Result;
        } catch (PDOException $e) {
            echo 'Ha surgido un error y no se puede ejecutar la consulta, Correspondencia enviada ->Total registro HC, Accion: .' . $Accion . " - " . $e->getMessage();
            exit;
        }
    }

    public static function Buscar($Id, $IdRadicado)
    {
        $conexion = new Conexion();

        try {

            $Sql = "SELECT * FROM archivo_radica_enviados WHERE id_radica = :id_radica";
            $Instruc = $conexion->prepare($Sql);
            $Instruc->bindParam(":id_radica", $IdRadicado, PDO::PARAM_INT);
            $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            $Result = $Instruc->fetch();
            $conexion = null;

            if ($Result) {

                return new self(
                    "",
                    $Result['id_radica'],
                    $Result['id_destina'],
                    $Result['id_serie'],
                    $Result['id_subserie'],
                    $Result['id_tipodoc'],
                    $Result['id_usua_regis'],
                    $Result['id_formaenvio'],
                    $Result['id_tipo_respue'],
                    $Result['id_ruta'],
                    $Result['fechor_radica'],
                    $Result['fec_docu'],
                    $Result['asunto'],
                    $Result['num_anexos'],
                    $Result['num_folio'],
                    $Result['observa_anexo'],
                    $Result['digital'],
                    $Result['impri_rotu'],
                    $Result['fechor_impri_rotu'],
                    $Result['usua_impri_rotu'],
                    $Result['id_radica_repues'],
                    $Result['enviado'],
                    $Result['trasnferido'],
                    $Result['num_guia'],
                    $Result['texto'],
                    $Result['opcion_relacion'],
                    $Result['opcion_titulo'],
                    $Result['opcion_sub_titulo'],
                    $Result['opcion_detalle1'],
                    $Result['opcion_detalle2'],
                    $Result['opcion_detalle3'],
                    $Result['nombre_archivo'],
                    $Result['archivo'],
                    $Result['tipo_cargue_archivos'],
                );
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo 'Ha surgido un error y no se puede ejecutar la consulta.' . $e->getMessage();
            exit;
        }
    }

    /************************************************************************************************************************/
    /* QUENERAR QUERY
    /************************************************************************************************************************/
    public static function Generar_Query_Correspondencia($Criterio3)
    {
        try {
            $conexion = new Conexion();

            /* TOTALES DE RADICADOS CON COINSEDENCIAS EN EL RADICADO */
            $SqlTotalIdRadica       = "SELECT COUNT(id_radica) AS 'Total' FROM `archivo_radica_enviados` WHERE `trasnferido` = 0 AND `id_radica` LIKE ?";
            $InstrucTotaIdRadica = $conexion->prepare($SqlTotalIdRadica);
            $InstrucTotaIdRadica->execute(array('%' . $Criterio3 . '%')) or die(print_r($InstrucTotalAsunto->errorInfo() . " - " . $SqlTotalIdRadica, true));
            $ResultTotalIdRadica = $InstrucTotaIdRadica->fetch();
            $TotalIdRadica = $ResultTotalIdRadica['Total'];

            /* TOTALES DE RADICADOS CON COINSEDENCIAS EN EL ASUNTO */
            $SqlTotalAsunto       = "SELECT COUNT(id_radica) AS 'Total' FROM `archivo_radica_enviados` WHERE `trasnferido` = 0 AND `asunto` LIKE ?";
            $InstrucTotalAsunto = $conexion->prepare($SqlTotalAsunto);
            $InstrucTotalAsunto->execute(array('%' . $Criterio3 . '%')) or die(print_r($InstrucTotalAsunto->errorInfo() . " - " . $SqlTotalAsunto, true));
            $ResultTotalAsunto = $InstrucTotalAsunto->fetch();
            $TotalAsunto = $ResultTotalAsunto['Total'];

            /* TOTALES DE RADICADOS CON COINSEDENCIAS CON LOS RESPONSABLES */
            $SqlTotalFuncionarios = "SELECT COUNT(`radi`.`id_radica`) AS 'Total'
                                    FROM `archivo_radica_enviados_responsa` AS `ra_respon`
                                        INNER JOIN `archivo_radica_enviados` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                                        INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio_deta` = `funcio_deta`.`id_funcio_deta`)
                                        INNER JOIN `gene_funcionarios` AS `fun` ON (`funcio_deta`.`id_funcio` = `fun`.`id_funcio`)
                                    WHERE (`ra_respon`.`respon` = 1 AND `radi`.`trasnferido` = 0 AND CONCAT(`fun`.`nom_funcio`, ' ', `fun`.`ape_funcio`) LIKE ?)";

            $InstrucTotalFuncionarios = $conexion->prepare($SqlTotalFuncionarios);
            $InstrucTotalFuncionarios->execute(array('%' . $Criterio3 . '%')) or die(print_r($InstrucTotalAsunto->errorInfo() . " - " . $SqlTotalAsunto, true));
            $ResultTotalFuncionarios = $InstrucTotalFuncionarios->fetch();
            $TotalFuncionarios = $ResultTotalFuncionarios['Total'];

            /* TOTALES DE RADICADOS CON COINSEDENCIAS CON LOS TERCEROS */
            $SqlTotalContacto = "SELECT COUNT(`radi`.`id_radica`) AS 'Total'
                                FROM `archivo_radica_enviados_responsa` AS `ra_respon`
                                    INNER JOIN `archivo_radica_enviados` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                                    INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_destina` = `terce_contac`.`id_tercero`)
                                WHERE (`ra_respon`.`respon` = 1 AND `radi`.`trasnferido` = 0 AND `terce_contac`.`nom_contac` LIKE ?)";
            $InstrucTotalContactos = $conexion->prepare($SqlTotalContacto);
            $InstrucTotalContactos->execute(array('%' . $Criterio3 . '%')) or die(print_r($SqlTotalContacto->errorInfo() . " - " . $SqlTotalContacto, true));
            $ResultTotalContactos = $InstrucTotalContactos->fetch();
            $TotalContactos = $ResultTotalContactos['Total'];

            /* TOTALES DE RADICADOS CON COINSEDENCIAS CON LOS LAS EMPRESAS DE LOS TERCEROS */
            $SqlTotalEmpresas = "SELECT COUNT(`radi`.`id_radica`) AS 'Total'
                                FROM `archivo_radica_enviados_responsa` AS `ra_respon`
                                    INNER JOIN `archivo_radica_enviados` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                                    INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_destina` = `terce_contac`.`id_tercero`)
                                    LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                                WHERE (`ra_respon`.`respon` = 1 AND `radi`.`trasnferido` = 0 AND `terce_contac`.`nom_contac` LIKE ?)";
            $InstrucTotalEmpresas = $conexion->prepare($SqlTotalEmpresas);
            $InstrucTotalEmpresas->execute(array('%' . $Criterio3 . '%')) or die(print_r($SqlTotalEmpresas->errorInfo() . " - " . $SqlTotalEmpresas, true));
            $ResultTotalEmpresas = $InstrucTotalEmpresas->fetch();
            $TotalEmpresas = $ResultTotalEmpresas['Total'];

            $Query = "";
            if ($TotalIdRadica > 0) {
                $Query .= "AND `radi`.`id_radica` LIKE '%" . $Criterio3 . "%'";
            }

            if ($TotalAsunto > 0 and $Query != "") {
                if ($Query != "") {
                    $Query .= " OR `radi`.`asunto` LIKE '%" . $Criterio3 . "%'";
                } else {
                    $Query .= " AND `radi`.`asunto` LIKE '%" . $Criterio3 . "%'";
                }
            }

            if ($TotalFuncionarios > 0) {
                if ($Query != "") {
                    $Query .= " OR CONCAT(TRIM(`fun`.`nom_funcio`), ' ', TRIM(`fun`.`ape_funcio`)) LIKE '%" . $Criterio3 . "%'";
                } else {
                    $Query .= " AND CONCAT(TRIM(`fun`.`nom_funcio`), ' ', TRIM(`fun`.`ape_funcio`)) LIKE '%" . $Criterio3 . "%'";
                }
            }

            if ($TotalContactos > 0) {
                if ($Query != "") {
                    $Query .= " OR `terce_contac`.`nom_contac` LIKE '%" . $Criterio3 . "%'";
                } else {
                    $Query .= " AND `terce_contac`.`nom_contac` LIKE '%" . $Criterio3 . "%'";
                }
            }

            if ($TotalEmpresas > 0) {
                if ($Query != "") {
                    $Query .= " OR `terce_empre`.`razo_soci` LIKE '%" . $Criterio3 . "%'";
                } else {
                    $Query .= " AND `terce_empre`.`razo_soci` LIKE '%" . $Criterio3 . "%'";
                }
            }

            return $Query;
        } catch (PDOException $e) {
            echo 'Ha surgido un error y no se puede ejecutar la consulta, Query recibidos.' . $e->getMessage();
            exit;
        }
    }
}
