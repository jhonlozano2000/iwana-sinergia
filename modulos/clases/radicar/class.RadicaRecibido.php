<?php
class RadicadoRecibido
{
    private $Accion;
    private $IdRadica;
    private $IdSerie;
    private $IdSubserie;
    private $IdTipoDoc;
    private $IdUsuaRegis;
    private $FormaLlegada;
    private $IdRemite;
    private $IdTipoCorrespon;
    private $IdRuta;
    private $FecRadica;
    private $FecDocu;
    private $FecVenciDocu;
    private $Asunto;
    private $NumAnexos;
    private $ObservaAnexos;
    private $NumFolios;
    private $RequieRespues;
    private $ImpriRotu;
    private $Digital;
    private $FecHorImpriRoru;
    private $UsuaImpriRotu;
    private $IdRadicaRespues;
    private $Respondido;
    private $Transferido;
    private $Estado;
    private $Proyector;
    private $ObservaRadica;
    private $Autoriza;
    private $OpcionRelecion;
    private $OpcionTitulo;
    private $OpcionSubTitulo;
    private $OpcionDetalle1;
    private $OpcionDetalle2;
    private $OpcionDetalle3;
    private $NombreArchivo;
    private $Archivo;

    public function __construct(
        $Accion = null,
        $IdRadica = null,
        $IdSerie = null,
        $IdSubserie = null,
        $IdTipoDoc = null,
        $IdUsuaRegis = null,
        $FormaLlegada = null,
        $IdRemite = null,
        $IdTipoCorrespon = null,
        $IdRuta = null,
        $FecRadica = null,
        $FecDocu = null,
        $FecVenciDocu = null,
        $Asunto = null,
        $NumAnexos = null,
        $ObservaAnexos = null,
        $NumFolios = null,
        $RequieRespues = null,
        $ImpriRotu = null,
        $Digital = null,
        $FecHorImpriRoru = null,
        $UsuaImpriRotu = null,
        $IdRadicaRespues = null,
        $Respondido = null,
        $Transferido = null,
        $Estado = null,
        $Proyector = null,
        $ObservaRadica = null,
        $Autoriza = null,
        $OpcionRelecion = null,
        $OpcionTitulo = null,
        $OpcionSubTitulo = null,
        $OpcionDetalle1 = null,
        $OpcionDetalle2 = null,
        $OpcionDetalle3 = null,
        $NombreArchivo = null,
        $Archivo = null
    ) {

        $this->Accion          = $Accion;
        $this->IdRadica        = $IdRadica;
        $this->IdSerie         = $IdSerie;
        $this->IdSubserie      = $IdSubserie;
        $this->IdTipoDoc       = $IdTipoDoc;
        $this->IdUsuaRegis     = $IdUsuaRegis;
        $this->FormaLlegada    = $FormaLlegada;
        $this->IdRemite        = $IdRemite;
        $this->IdTipoCorrespon = $IdTipoCorrespon;
        $this->IdRuta          = $IdRuta;
        $this->FecRadica       = $FecRadica;
        $this->FecDocu         = $FecDocu;
        $this->FecVenciDocu    = $FecVenciDocu;
        $this->Asunto          = $Asunto;
        $this->NumAnexos       = $NumAnexos;
        $this->ObservaAnexos    = $ObservaAnexos;
        $this->NumFolios       = $NumFolios;
        $this->RequieRespues   = $RequieRespues;
        $this->ImpriRotu       = $ImpriRotu;
        $this->Digital         = $Digital;
        $this->FecHorImpriRoru = $FecHorImpriRoru;
        $this->UsuaImpriRotu   = $UsuaImpriRotu;
        $this->IdRadicaRespues = $IdRadicaRespues;
        $this->Respondido      = $Respondido;
        $this->Transferido     = $Transferido;
        $this->Estado          = $Estado;
        $this->Proyector       = $Proyector;
        $this->ObservaRadica   = $ObservaRadica;
        $this->Autoriza        = $Autoriza;
        $this->OpcionRelecion  = $OpcionRelecion;
        $this->OpcionTitulo    = $OpcionTitulo;
        $this->OpcionSubTitulo = $OpcionSubTitulo;
        $this->OpcionDetalle1  = $OpcionDetalle1;
        $this->OpcionDetalle2  = $OpcionDetalle2;
        $this->OpcionDetalle3  = $OpcionDetalle3;
        $this->NombreArchivo   = $NombreArchivo;
        $this->Archivo         = $Archivo;
    }

    public function get_IdRadica()
    {
        return $this->IdRadica;
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

    public function get_FormaLlegada()
    {
        return $this->FormaLlegada;
    }

    public function get_IdRemite()
    {
        return $this->IdRemite;
    }

    public function IdTipoCorrespon()
    {
        return $this->IdTipoCorrespon;
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

    public function get_FecVenciDocu()
    {
        return $this->FecVenciDocu;
    }

    public function get_Asunto()
    {
        return $this->Asunto;
    }

    public function get_NumAnexos()
    {
        return $this->NumAnexos;
    }

    public function get_ObservaAnexos()
    {
        return $this->ObservaAnexos;
    }

    public function get_NumFolios()
    {
        return $this->NumFolios;
    }

    public function get_RequieRespues()
    {
        return $this->RequieRespues;
    }

    public function get_ImpriRotu()
    {
        return $this->ImpriRotu;
    }

    public function get_Digital()
    {
        return $this->Digital;
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

    public function get_Respondido()
    {
        return $this->Respondido;
    }

    public function get_Transferido()
    {
        return $this->Transferido;
    }

    public function get_Estado()
    {
        return $this->Estado;
    }

    public function get_Proyector()
    {
        return $this->Proyector;
    }

    public function get_ObservaRadica()
    {
        return $this->ObservaRadica;
    }

    public function get_Autoriza()
    {
        return $this->Autoriza;
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

    public function get_Archivo()
    {
        return $this->Archivo;
    }

    public function get_NombreArchivo()
    {
        return $this->NombreArchivo;
    }

    public function set_Accion($Accion)
    {
        $this->Accion = $Accion;
    }

    public function set_IdRadica($IdRadica)
    {
        $this->IdRadica = $IdRadica;
    }

    public function set_IdSerie($IdSerie)
    {
        $this->IdSerie = $IdSerie;
    }

    public function set_IdSubserie($IdSubserie)
    {
        $this->IdSubserie = $IdSubserie;
    }

    public function set_IdTipoDoc($IdTipoDoc)
    {
        $this->IdTipoDoc = $IdTipoDoc;
    }

    public function set_IdUsuaRegis($IdUsuaRegis)
    {
        $this->IdUsuaRegis = $IdUsuaRegis;
    }

    public function set_FormaLlegada($FormaLlegada)
    {
        $this->FormaLlegada = $FormaLlegada;
    }

    public function set_IdRemite($IdRemite)
    {
        $this->IdRemite = $IdRemite;
    }

    public function set_IdTipoCorrespon($IdTipoCorrespon)
    {
        $this->IdTipoCorrespon = $IdTipoCorrespon;
    }

    public function set_IdRuta($IdRuta)
    {
        $this->IdRuta = $IdRuta;
    }

    public function set_FecRadica($FecRadica)
    {
        $this->FecRadica = $FecRadica;
    }

    public function set_FecDocu($FecDocu)
    {
        $this->FecDocu = $FecDocu;
    }

    public function set_FecVenciDocu($FecVenciDocu)
    {
        $this->FecVenciDocu = $FecVenciDocu;
    }

    public function set_Asunto($Asunto)
    {
        $this->Asunto = $Asunto;
    }

    public function set_NumAnexos($NumAnexos)
    {
        $this->NumAnexos = $NumAnexos;
    }

    public function set_ObservaAnexos($ObservaAnexos)
    {
        $this->ObservaAnexos = $ObservaAnexos;
    }

    public function set_NumFolios($NumFolios)
    {
        $this->NumFolios = $NumFolios;
    }

    public function set_RequieRespues($RequieRespues)
    {
        $this->RequieRespues = $RequieRespues;
    }

    public function set_ImpriRotu($ImpriRotu)
    {
        $this->ImpriRotu = $ImpriRotu;
    }

    public function set_Digital($Digital)
    {
        $this->Digital = $Digital;
    }

    public function set_FecHorImpriRoru($FecHorImpriRoru)
    {
        $this->FecHorImpriRoru = $FecHorImpriRoru;
    }

    public function set_UsuaImpriRotu($UsuaImpriRotu)
    {
        $this->UsuaImpriRotu = $UsuaImpriRotu;
    }

    public function set_IdRadicaRespues($IdRadicaRespues)
    {
        $this->IdRadicaRespues = $IdRadicaRespues;
    }

    public function set_Respondido($Respondido)
    {
        $this->Respondido = $Respondido;
    }

    public function set_Transferido($Transferido)
    {
        $this->Transferido = $Transferido;
    }

    public function set_Estado($Estado)
    {
        $this->Estado = $Estado;
    }

    public function set_ObservaRadica($ObservaRadica)
    {
        $this->ObservaRadica = $ObservaRadica;
    }

    public function set_Autoriza($Autoriza)
    {
        $this->Autoriza = $Autoriza;
    }

    public function set_OpcionRelecion($OpcionRelecion)
    {
        $this->OpcionRelecion = $OpcionRelecion;
    }

    public function set_OpcionTitulo($OpcionTitulo)
    {
        $this->OpcionTitulo = $OpcionTitulo;
    }

    public function set_OpcionSubTitulo($OpcionSubTitulo)
    {
        $this->OpcionSubTitulo = $OpcionSubTitulo;
    }

    public function set_OpcionDetalle1($OpcionDetalle1)
    {
        $this->OpcionDetalle1 = $OpcionDetalle1;
    }

    public function set_OpcionDetalle2($OpcionDetalle2)
    {
        $this->OpcionDetalle2 = $OpcionDetalle2;
    }

    public function set_OpcionDetalle3($OpcionDetalle3)
    {
        $this->OpcionDetalle3 = $OpcionDetalle3;
    }

    public function set_NombreArchivo($NombreArchivo)
    {
        return $this->NombreArchivo = $NombreArchivo;
    }

    public function set_Archivo($Archivo)
    {
        $this->Archivo = $Archivo;
    }

    //Metodos
    public function Gestionar()
    {
        $conexion = new Conexion();

        $ParamIdUsuaRegis = PDO::PARAM_STR;
        if ($this->IdUsuaRegis == NULL) {
            $ParamIdUsuaRegis = PDO::PARAM_NULL;
        }

        $ParameFecVencimi = PDO::PARAM_STR;
        if ($this->FecVenciDocu == NULL) {
            $ParameFecVencimi = PDO::PARAM_NULL;
        }

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

        try {
            if ($this->Accion == 'GUARDAR_RADICADO') {
                $Sql = "INSERT INTO archivo_radica_recibidos(id_radica, id_serie, id_subserie, id_tipodoc, id_usua_regis,
                            id_forma_llegada, id_remite, id_tipo_correspon, id_ruta, fechor_radica, fec_docu, fec_venci, asunto, num_folio, num_anexos,
                            requie_respues, estado, autoriza, observa_anexo, `opcion_relacion`, `opcion_titulo`, `opcion_sub_titulo`,
                            `opcion_detalle1`, `opcion_detalle2`, `opcion_detalle3`)
                         VALUES(:id_radica, :id_serie, :id_subserie, :id_tipodoc, :id_usua_regis, :id_forma_llegada,
                            :id_remite, :id_tipo_correspon, :id_ruta, :fechor_radica, :fec_docu, :fec_venci, :asunto, :num_folio, :num_anexos, :requie_respues,
                            :estado, :autoriza, :observa_anexo, :opcion_relacion, :opcion_titulo, :opcion_sub_titulo, :opcion_detalle1,
                            :opcion_detalle2, :opcion_detalle3)";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
                $Instruc->bindParam(':id_serie', $this->IdSerie, $ParamSerie);
                $Instruc->bindParam(':id_subserie', $this->IdSubserie, $ParamSubSerie);
                $Instruc->bindParam(':id_tipodoc', $this->IdTipoDoc, PDO::PARAM_INT);
                $Instruc->bindParam(':id_usua_regis', $this->IdUsuaRegis, $ParamIdUsuaRegis);
                $Instruc->bindParam(':id_forma_llegada', $this->FormaLlegada, PDO::PARAM_INT);
                $Instruc->bindParam(':id_remite', $this->IdRemite, PDO::PARAM_INT);
                $Instruc->bindParam(':id_tipo_correspon', $this->IdTipoCorrespon, PDO::PARAM_INT);
                $Instruc->bindParam(':id_ruta', $this->IdRuta, PDO::PARAM_INT);
                $Instruc->bindParam(':fechor_radica', $this->FecRadica, PDO::PARAM_STR);
                $Instruc->bindParam(':fec_docu', $this->FecDocu, PDO::PARAM_STR);
                $Instruc->bindParam(':fec_venci', $this->FecVenciDocu, $ParameFecVencimi);
                $Instruc->bindParam(':asunto', $this->Asunto, PDO::PARAM_STR);
                $Instruc->bindParam(':num_folio', $this->NumFolios, PDO::PARAM_INT);
                $Instruc->bindParam(':num_anexos', $this->NumAnexos, PDO::PARAM_INT);
                $Instruc->bindParam(':requie_respues', $this->RequieRespues, PDO::PARAM_INT);
                $Instruc->bindParam(':estado', $this->Estado, PDO::PARAM_STR);
                $Instruc->bindParam(':autoriza', $this->Autoriza, PDO::PARAM_INT);
                $Instruc->bindParam(':observa_anexo', $this->ObservaAnexos, PDO::PARAM_INT);
                $Instruc->bindParam(':opcion_relacion', $this->OpcionRelecion, $ParameOpcionRelacion);
                $Instruc->bindParam(':opcion_titulo', $this->OpcionTitulo, $ParameOpcionTitulo);
                $Instruc->bindParam(':opcion_sub_titulo', $this->OpcionSubTitulo, $ParameOpcionSubTitulo);
                $Instruc->bindParam(':opcion_detalle1', $this->OpcionDetalle1, $ParameOpcionDetalle1);
                $Instruc->bindParam(':opcion_detalle2', $this->OpcionDetalle2, $ParameOpcionDetalle2);
                $Instruc->bindParam(':opcion_detalle3', $this->OpcionDetalle3, $ParameOpcionDetalle3);
            } elseif ($this->Accion == 2) {
                $Sql = "UPDATE archivo_radica_recibidos SET impri_rotu = 1, usua_impri_rotu = :usua_impri_rotu,
                            fechor_impri_rotu = :fechor_impri_rotu
                        WHERE id_radica = :id_radica";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':usua_impri_rotu', $this->UsuaImpriRotu, PDO::PARAM_INT);
                $Instruc->bindParam(':fechor_impri_rotu', $this->FecHorImpriRoru, PDO::PARAM_STR);
                $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
            } elseif ($this->Accion == 'ELIMINAR_RADICADO') {
                $Sql = "DELETE FROM archivo_radica_recibidos
                        WHERE id_radica = :id_radica";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
            } elseif ($this->Accion == 'ELIMINAR_DIGITAL') {
                $Sql = "UPDATE archivo_radica_recibidos
                        SET digital = 0, nombre_archivo = null, archivo = null
                        WHERE id_radica = :id_radica";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
            } elseif ($this->Accion == 3) {
                $Sql = "UPDATE archivo_radica_recibidos
                        SET adjunto = 1
                        WHERE id_radica = :id_radica";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
            } elseif ($this->Accion == 4) {
                /**
                 * Cargar archivo
                 */
                $Sql = "UPDATE archivo_radica_recibidos
                        SET digital = 1, nombre_archivo = :nombre_archivo, archivo = :archivo
                        WHERE id_radica = :id_radica";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':nombre_archivo', $this->NombreArchivo, PDO::PARAM_STR);
                $Instruc->bindParam(':archivo', $this->Archivo, PDO::PARAM_STR);
                $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
            } elseif ($this->Accion == 6) {
                $Sql = "UPDATE archivo_radica_recibidos
                        SET transferido = 1
                        WHERE id_radica = :id_radica";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
            } elseif ($this->Accion == 7) {
                $Sql = "UPDATE archivo_radica_recibidos
                        SET proyector = 1
                        WHERE id_radica = '" . $this->IdRadica . "'";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
            } elseif ($this->Accion == 8) {
                $Sql = "UPDATE archivo_radica_recibidos
                        SET radica_respuesta = :radica_respuesta, respondido = 1
                        WHERE id_radica = :id_radica";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':radica_respuesta', $this->IdRadicaRespues, PDO::PARAM_STR);
                $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
            } elseif ($this->Accion == 9) {
                $Sql = "UPDATE archivo_radica_recibidos
                        SET id_serie = :id_serie, id_subserie = :id_subserie, id_tipodoc = :id_tipodoc,
                            id_forma_llegada = :id_forma_llegada, id_remite = :id_remite, id_ruta = :id_ruta,
                            fec_docu = :fec_docu, fec_venci = :fec_venci, asunto = :asunto,
                            num_anexos = :num_anexos, num_folio = :num_folio, requie_respues = :requie_respues
                        WHERE id_radica = :id_radica";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':id_serie', $this->IdSerie, PDO::PARAM_INT);
                $Instruc->bindParam(':id_subserie', $this->IdSubserie, PDO::PARAM_INT);
                $Instruc->bindParam(':id_tipodoc', $this->IdTipoDoc, PDO::PARAM_INT);
                $Instruc->bindParam(':id_forma_llegada', $this->FormaLlegada, PDO::PARAM_INT);
                $Instruc->bindParam(':id_remite', $this->IdRemite, PDO::PARAM_INT);
                $Instruc->bindParam(':id_ruta', $this->IdRuta, PDO::PARAM_INT);
                $Instruc->bindParam(':fec_docu', $this->FecDocu, PDO::PARAM_STR);
                $Instruc->bindParam(':fec_venci', $this->FecVenciDocu, PDO::PARAM_STR);
                $Instruc->bindParam(':asunto', $this->Asunto, PDO::PARAM_STR);
                $Instruc->bindParam(':num_anexos', $this->NumAnexos, PDO::PARAM_INT);
                $Instruc->bindParam(':num_folio', $this->NumFolios, PDO::PARAM_STR);
                $Instruc->bindParam(':requie_respues', $this->RequieRespues, PDO::PARAM_INT);
                $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
            } elseif ($this->Accion == 'Desbloquear') {
                $Sql = "UPDATE archivo_radica_recibidos
                        SET autoriza = 1
                        WHERE id_radica = :id_radica";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
            } elseif ($this->Accion == 'EDITAR_ASUNTO') {
                $Sql = "UPDATE archivo_radica_recibidos
                        SET asunto = :asunto
                        WHERE id_radica = :id_radica";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':asunto', $this->Asunto, PDO::PARAM_STR);
                $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
            } elseif ($this->Accion == 'INSERTAR_SOLIC_HC') {
                $Sql = "INSERT INTO archivo_radica_recibidos(id_radica, id_serie, id_subserie, id_tipodoc, id_usua_regis, id_forma_llegada, id_remite,
                            fechor_radica, fec_docu, fec_venci, asunto, requie_respues, estado)
                        VALUES(:id_radica, :id_serie, :id_subserie, :id_tipodoc, :id_usua_regis, :id_forma_llegada, :id_remite,
                            :fechor_radica, :fec_docu, :fec_venci, :asunto, :requie_respues, :estado)";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
                $Instruc->bindParam(':id_serie', $this->IdSerie, PDO::PARAM_INT);
                $Instruc->bindParam(':id_subserie', $this->IdSubserie, PDO::PARAM_INT);
                $Instruc->bindParam(':id_tipodoc', $this->IdTipoDoc, PDO::PARAM_INT);
                $Instruc->bindParam(':id_usua_regis', $this->IdUsuaRegis, PDO::PARAM_INT);
                $Instruc->bindParam(':id_forma_llegada', $this->FormaLlegada, PDO::PARAM_INT);
                $Instruc->bindParam(':id_remite', $this->IdRemite, PDO::PARAM_INT);
                $Instruc->bindParam(':fechor_radica', $this->FecRadica, PDO::PARAM_STR);
                $Instruc->bindParam(':fec_docu', $this->FecDocu, PDO::PARAM_STR);
                $Instruc->bindParam(':fec_venci', $this->FecVenciDocu, PDO::PARAM_STR);
                $Instruc->bindParam(':asunto', $this->Asunto, PDO::PARAM_STR);
                $Instruc->bindParam(':requie_respues', $this->RequieRespues, PDO::PARAM_INT);
                $Instruc->bindParam(':estado', $this->Estado, PDO::PARAM_STR);
            } elseif ($this->Accion == 'PASAR') {
                $Sql = "UPDATE archivo_radica_recibidos
                        SET id_serie = null, id_subserie = null, id_tipodoc = null, pase = 1
                        WHERE id_radica = :id_radica";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
            } elseif ($this->Accion == 'ESTABLECER_CLASIFICACION') {
                $Sql = "UPDATE archivo_radica_recibidos
                        SET id_serie = :id_serie, id_subserie = :id_subserie, id_tipodoc = :id_tipodoc
                        WHERE id_radica = :id_radica";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':id_serie', $this->IdSerie, PDO::PARAM_INT);
                $Instruc->bindParam(':id_subserie', $this->IdSubserie, PDO::PARAM_INT);
                $Instruc->bindParam(':id_tipodoc', $this->IdTipoDoc, PDO::PARAM_INT);
                $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
            } elseif ($this->Accion == 'TERMINAR_PASE') {
                $Sql = "UPDATE archivo_radica_recibidos
                        SET pase = 0
                        WHERE id_radica = :id_radica";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
            } elseif ($this->Accion == 'REQUIERE_RESPUESTA') {
                $Sql = "UPDATE archivo_radica_recibidos
                        SET requie_respues = 1, fec_venci = :fec_venci
                        WHERE id_radica = :id_radica";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':fec_venci', $this->FecVenciDocu, PDO::PARAM_STR);
                $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
            } elseif ($this->Accion == 'QUITAR_REQUIERE_RESPUESTA') {
                $Sql = "UPDATE archivo_radica_recibidos
                        SET requie_respues = 0, fec_venci = NULL
                        WHERE id_radica = :id_radica";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
            } elseif ($this->Accion == 'ASIGNAR_PQR') {
                $Sql = "UPDATE archivo_radica_recibidos
                        SET id_serie = :id_serie, id_subserie = :id_subserie, id_tipodoc = :id_tipodoc, id_usua_regis = :id_usua_regis, id_tipo_correspon = :id_tipo_correspon
                        WHERE id_radica = :id_radica";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(':id_serie', $this->IdSerie, PDO::PARAM_INT);
                $Instruc->bindParam(':id_subserie', $this->IdSubserie, PDO::PARAM_INT);
                $Instruc->bindParam(':id_tipodoc', $this->IdTipoDoc, PDO::PARAM_INT);
                $Instruc->bindParam(':id_usua_regis', $this->IdUsuaRegis, PDO::PARAM_INT);
                $Instruc->bindParam(':id_tipo_correspon', $this->IdTipoCorrespon, PDO::PARAM_INT);
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
            echo 'Ha surgido un error y no se puede ejecutar la consulta, recibidos Radicar Recibidas.' . $e->getMessage();
            exit;
        }
    }

    public static function Listar_Vario($Accion, $IdRadicado, $IdFuncioDeta, $IdFuncio, $IdDepen, $IdOfi, $Criterio1, $Criterio2, $Criterio3)
    {
        $conexion = new Conexion();

        try {
            if ($Accion == 1) {
                /******************************************************************************************/
                /*  LISTO UN RADICADO EN PARTICULAR
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`, `radi`.`fechor_radica`, `radi`.`fec_docu`, `radi`.`fec_venci`, `radi`.`asunto`, `radi`.`num_anexos`,
                            `radi`.`observa_anexo`, `radi`.`num_folio`, `radi`.`impri_rotu`, `radi`.`requie_respues`, `radi`.`id_ruta`, `radi`.`digital`,
                            `serie`.`id_serie`, `serie`.`cod_serie`, `serie`.`nom_serie`, `subserie`.`id_subserie`, `subserie`.`cod_subserie`, `subserie`.`nom_subserie`,
                            `tipo_docu`.`id_tipodoc`, `tipo_docu`.`nom_tipodoc`, `funcio_regis`.`nom_funcio` AS `nom_funcio_regis`, `funcio_regis`.`ape_funcio` AS `ape_funcio_regis`,
                            `remite_contac`.`id_tercero`, `remite_contac`.`num_docu` AS `num_docu_remite`,
                            `remite_contac`.`nom_contac` AS `nom_remite`, `remite_empre`.`razo_soci` AS `razo_soci_remite`, `remite_contac`.`dir` AS `dir_remite`,
                            `remite_contac`.`tel` AS `tel_remite`, `remite_contac`.`cel` AS `cel_remite`, `remite_contac`.`fax` AS `fax_remite`, `remite_contac`.`email` AS `email_remite`, `remite_contac`.`cargo`,
                            `forma_llegada`.`nom_formaenvi` AS `nom_forma_llega`, `radi_respues`.`id_radica` AS `radica_respuesta`, `radi_respues`.`fec_docu` AS `fec_docu_respuesta`,
                            `radi_respues`.`fechor_radica` AS `fechor_radica_respuesta`, `radi_respues`.`asunto` AS `asunto_respuesta`, `radi`.`nombre_archivo`
                        FROM `archivo_radica_recibidos` AS `radi`
                            LEFT JOIN `archivo_trd_series` AS `serie` ON (`radi`.`id_serie` = `serie`.`id_serie`)
                            LEFT JOIN `archivo_trd_subserie` AS `subserie` ON (`radi`.`id_subserie` = `subserie`.`id_subserie`)
                            LEFT JOIN `archivo_trd_tipo_docu` AS `tipo_docu` ON (`radi`.`id_tipodoc` = `tipo_docu`.`id_tipodoc`)
                            LEFT JOIN `archivo_radica_enviados` AS `radi_respues` ON (`radi_respues`.`id_radica` = `radi`.`radica_respuesta`)
                            INNER JOIN `segu_usua` AS `usua_regis` ON (`radi`.`id_usua_regis` = `usua_regis`.`id_usua`)
                            INNER JOIN `gene_terceros_contac` AS `remite_contac` ON (`radi`.`id_remite` = `remite_contac`.`id_tercero`)
                            INNER JOIN `config_formaenvio` AS `forma_llegada` ON (`radi`.`id_forma_llegada` = `forma_llegada`.`id_formaenvio`)
                            LEFT JOIN `gene_terceros_empresas` AS `remite_empre` ON (`remite_contac`.`id_empre` = `remite_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios` AS `funcio_regis` ON (`usua_regis`.`id_funcio` = `funcio_regis`.`id_funcio`)
                        WHERE `radi`.`id_radica` = :id_radica";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":id_radica", $IdRadicado, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($Accion == 2) {
                /******************************************************************************************/
                /*  GERAR RADICADO YYYYMMDD-#####
                /******************************************************************************************/
                $Sql = "SELECT CONCAT(DATE_FORMAT(NOW(), '%Y%m%d'),'-',LPAD(COUNT(id_radica)+1, 5, 0)) AS IdRadicado
                        FROM archivo_radica_recibidos
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
                        FROM archivo_radica_recibidos WHERE YEAR(fechor_radica) = YEAR(NOW())";

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
                        FROM archivo_radica_recibidos WHERE YEAR(fechor_radica) = YEAR(NOW())";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":id_depen", $IdDepen, PDO::PARAM_INT);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($Accion == 5) {
                /******************************************************************************************/
                /*  LISTO LOS RADICADOS QUE REQUIEREN DE RESPUESTA
                /******************************************************************************************/
                $Sql = "SELECT `ra`.`id_radica`, `ra`.`asunto`, `ra`.`requie_respues`, `ra`.`respondido`, `ra`.`radica_respuesta`,
                            `respon`.`respon`, `tercero`.`nom_contac`, `tercero`.`cargo`, `empre`.`razo_soci`
                        FROM `archivo_radica_recibidos_responsa` AS `respon`
                            INNER JOIN `archivo_radica_recibidos` AS `ra` ON (`respon`.`id_radica` = `ra`.`id_radica`)
                            INNER JOIN `gene_terceros_contac` AS `tercero` ON (`ra`.`id_remite` = `tercero`.`id_tercero`)
                            LEFT JOIN `gene_terceros_empresas` AS `empre` ON (`tercero`.`id_empre` = `empre`.`id_empre`)
                        WHERE (`ra`.`requie_respues` = 1 AND `ra`.`respondido` = 0 AND `respon`.`respon` = 1 AND `ra`.`id_radica` LIKE ? OR `ra`.`asunto` LIKE ?)";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute(array('%' . $Criterio1 . '%', '%' . $Criterio1 . '%')) or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($Accion == 6) {
                /******************************************************************************************/
                /*  PLANILLA POR RANGO DE FECHAS
                /******************************************************************************************/
                $Sql = "SELECT `ra`.`id_radica`, DATE_FORMAT(`ra`.`fechor_radica`, '%H:%I:%S') as 'hor_llegada', `forma_envi`.`nom_formaenvi`,
                            `ra`.`asunto`, `depn`.`cod_depen`, `depn`.`cod_corres`, `fun`.`nom_funcio`, `fun`.`ape_funcio`, `ra`.`num_folio`,
                            `ra`.`num_anexos`, `ra`.`requie_respues`, `remite`.`nom_contac`, `remite_empre`.`razo_soci`, `ra`.`id_ruta`,
                            `respon_depen`.`nom_depen` as 'depen_respon', `respon_ofi`.`nom_oficina` as 'ofi_respon'
                        FROM `archivo_radica_recibidos_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_recibidos` AS `ra` ON (`ra_respon`.`id_radica` = `ra`.`id_radica`)
                            INNER JOIN `config_formaenvio` AS `forma_envi` ON (`ra`.`id_forma_llegada` = `forma_envi`.`id_formaenvio`)
                            INNER JOIN `gene_funcionarios_deta` AS `gene_funcio` ON (`ra_respon`.`id_funcio` = `gene_funcio`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `fun` ON (`gene_funcio`.`id_funcio` = `fun`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`gene_funcio`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depn` ON (`ofi`.`id_depen` = `depn`.`id_depen`)
                            INNER JOIN `gene_terceros_contac` AS `remite` ON (`ra`.`id_remite` = `remite`.`id_tercero`)
                            LEFT JOIN `gene_terceros_empresas` AS `remite_empre` ON (`remite`.`id_empre` = `remite_empre`.`id_empre`)
                            INNER JOIN `gene_funcionarios_deta` AS `respon_deta` ON (`ra_respon`.`id_funcio` = `respon_deta`.`id_funcio_deta`)
                            INNER JOIN `areas_cargos` AS `respon_cargo` ON (`respon_deta`.`id_cargo` = `respon_cargo`.`id_cargo`)
                            INNER JOIN `areas_oficinas` AS `respon_ofi` ON (`respon_deta`.`id_oficina` = `respon_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `respon_depen` ON (`respon_cargo`.`id_depen` = `respon_depen`.`id_depen`)
                        WHERE (`ra`.`fechor_radica` BETWEEN :criterio1 AND :criterio2  AND `ra_respon`.`respon` = 1)
                        ORDER BY `ra`.`id_radica` ASC";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":criterio1", $Criterio1, PDO::PARAM_STR);
                $Instruc->bindParam(":criterio2", $Criterio2, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($Accion == 7) {
                /******************************************************************************************/
                /*  PLANILLA POR RANGO DE RADICADOS
                /******************************************************************************************/
                $Sql = "SELECT `ra`.`id_radica`, DATE_FORMAT(`ra`.`fechor_radica`, '%H:%I:%S') as 'hor_llegada', `forma_envi`.`nom_formaenvi`,
                            `ra`.`asunto`, `depn`.`cod_depen`, `depn`.`cod_corres`, `fun`.`nom_funcio`, `fun`.`ape_funcio`, `ra`.`num_folio`, `ra`.`num_anexos`, `ra`.`requie_respues`, `remite`.`nom_contac`, `remite_empre`.`razo_soci`
                        FROM `archivo_radica_recibidos_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_recibidos` AS `ra` ON (`ra_respon`.`id_radica` = `ra`.`id_radica`)
                            INNER JOIN `config_formaenvio` AS `forma_envi` ON (`ra`.`id_forma_llegada` = `forma_envi`.`id_formaenvio`)
                            INNER JOIN `gene_funcionarios_deta` AS `gene_funcio` ON (`ra_respon`.`id_funcio` = `gene_funcio`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `fun` ON (`gene_funcio`.`id_funcio` = `fun`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`gene_funcio`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depn` ON (`ofi`.`id_depen` = `depn`.`id_depen`)
                            INNER JOIN `gene_terceros_contac` AS `remite` ON (`ra`.`id_remite` = `remite`.`id_tercero`)
                            LEFT JOIN `gene_terceros_empresas` AS `remite_empre` ON (`remite`.`id_empre` = `remite_empre`.`id_empre`)
                        WHERE (`ra`.`id_radica` BETWEEN :criterio1 AND :criterio2 AND `ra_respon`.`respon` = 1)
                        ORDER BY `ra`.`id_radica` ASC";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":criterio1", $Criterio1, PDO::PARAM_STR);
                $Instruc->bindParam(":criterio2", $Criterio2, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($Accion == 8) {
                /******************************************************************************************/
                /*  LISTO LOS RADICADOS MINIMOS Y MAXIMOS DE LA FECHA ACTUAL
                /******************************************************************************************/

                $Sql = "SELECT MIN(id_radica) AS 'RadicadoMin', MAX(id_radica) AS 'RadicadoMax'
                        FROM archivo_radica_recibidos
                        WHERE DATE(`fechor_radica`) = '2018-03-23'";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($Accion == 9) {
                /******************************************************************************************/
                /*  LISTO LOS RADICADOS PARA GENERAR BACKUPS
                /******************************************************************************************/
                $Sql = "SELECT `ra`.`id_radica`, `forma_envi`.`nom_formaenvi`, `ra`.`asunto`, `ra`.`fec_docu`,`ra`.`fec_venci`, `depn`.`cod_depen`,
                            `depn`.`cod_corres`, `fun`.`nom_funcio`,
                            `fun`.`ape_funcio`, `ra`.`num_folio`, `ra`.`requie_respues`, `remite`.`nom_contac`, `remite_empre`.`razo_soci`
                        FROM `archivo_radica_recibidos_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_recibidos` AS `ra` ON (`ra_respon`.`id_radica` = `ra`.`id_radica`)
                            INNER JOIN `config_formaenvio` AS `forma_envi` ON (`ra`.`id_forma_llegada` = `forma_envi`.`id_formaenvio`)
                            INNER JOIN `gene_funcionarios_deta` AS `gene_funcio` ON (`ra_respon`.`id_funcio` = `gene_funcio`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `fun` ON (`gene_funcio`.`id_funcio` = `fun`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`gene_funcio`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depn` ON (`ofi`.`id_depen` = `depn`.`id_depen`)
                            INNER JOIN `gene_terceros_contac` AS `remite` ON (`ra`.`id_remite` = `remite`.`id_tercero`)
                            LEFT JOIN `gene_terceros_empresas` AS `remite_empre` ON (`remite`.`id_empre` = `remite_empre`.`id_empre`)
                        WHERE (DATE(`ra`.`fechor_radica`) BETWEEN :criterio1 AND :criterio2 AND `ra_respon`.`respon` = 1
                            AND `ra`.`transferido` = 0 AND `ra`.`digital` = 1)
                        ORDER BY `ra`.`id_radica` DESC";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":criterio1", $Criterio1, PDO::PARAM_STR);
                $Instruc->bindParam(":criterio2", $Criterio2, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($Accion == 10) {
                /******************************************************************************************/
                /*  LISTO LOS RADIACOD QUE REQUIEREN RESPUESTA
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`, `radi`.`fechor_radica`, `radi`.`fec_docu`, `radi`.`fec_venci`, `radi`.`asunto`, `radi`.`digital`, `funcio`.`nom_funcio`,
                            `funcio`.`ape_funcio`, `depen`.`nom_depen`, `ofi`.`nom_oficina`, `terce_contac`.`nom_contac`, `terce_empre`.`nit_empre`, `terce_empre`.`razo_soci`,
                            `funcio_deta`.`id_oficina`, `ra_respon`.`leido`, `radi`.`autoriza`, `radi`.`requie_respues`
                        FROM `archivo_radica_recibidos_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_recibidos` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_remite` = `terce_contac`.`id_tercero`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                        WHERE (`radi`.`requie_respues` = 1 AND `radi`.`respondido` = 0 AND `radi`.`transferido` = 0 AND `ra_respon`.`respon` = 1)
                        ORDER BY `radi`.`fechor_radica` DESC";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            } elseif ($Accion == 11) {
                /******************************************************************************************/
                /*  LISTO LOS RADIACOD A LOS QUE LES HACEN FALTA EL ARCHIVO DIGITAL
                /******************************************************************************************/
                $Sql = "SELECT `radi`.`id_radica`, `radi`.`fechor_radica`, `radi`.`fec_docu`, `radi`.`fec_venci`, `radi`.`asunto`, `radi`.`digital`, `funcio`.`nom_funcio`,
                            `funcio`.`ape_funcio`, `depen`.`nom_depen`, `ofi`.`nom_oficina`, `terce_contac`.`nom_contac`, `terce_empre`.`nit_empre`, `terce_empre`.`razo_soci`,
                            `funcio_deta`.`id_oficina`, `ra_respon`.`leido`, `radi`.`autoriza`, `radi`.`requie_respues`, `forma_recibi`.`nom_formaenvi`, `segu_usua`.`login`
                            , `funcio_radi`.`nom_funcio`, `funcio_radi`.`ape_funcio`
                        FROM `archivo_radica_recibidos_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_recibidos` AS `radi` ON (`ra_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`ra_respon`.`id_funcio` = `funcio_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi` ON (`funcio_deta`.`id_oficina` = `ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen` ON (`ofi`.`id_depen` = `depen`.`id_depen`)
                            INNER JOIN `gene_terceros_contac` AS `terce_contac` ON (`radi`.`id_remite` = `terce_contac`.`id_tercero`)
                            LEFT JOIN `gene_terceros_empresas` AS `terce_empre` ON (`terce_contac`.`id_empre` = `terce_empre`.`id_empre`)
                            INNER JOIN `config_formaenvio` AS `forma_recibi` ON (`radi`.`id_forma_llegada` = `forma_recibi`.`id_formaenvio`)
                            INNER JOIN `segu_usua` ON (`radi`.`id_usua_regis` = `segu_usua`.`id_usua`)
                            INNER JOIN `gene_funcionarios` AS `funcio_radi` ON (`segu_usua`.`id_funcio` = `funcio_radi`.`id_funcio`)
                        WHERE (`radi`.`digital` = 0 AND `radi`.`transferido` = 0 AND `ra_respon`.`respon` = 1 AND `forma_recibi`.`requie_digital` = 1)
                        ORDER BY `radi`.`fechor_radica` DESC";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            }

            $Result = $Instruc->fetchAll();
            $conexion = null;
            return $Result;
        } catch (PDOException $e) {
            echo 'Ha surgido un error y no se puede ejecutar la consulta, recibidos listar.' . $e->getMessage();
            exit;
        }
    }

    public static function Buscar($Accion, $IdRadicado, $IdFuncioDeta, $IdFuncio, $IdDepen, $IdOfi)
    {
        $conexion = new Conexion();

        try {
            if ($Accion == 1) {
                $Sql = "SELECT *
                        FROM archivo_radica_recibidos
                        WHERE id_radica = :id_radica";

                $Instruc = $conexion->prepare($Sql);
                $Instruc->bindParam(":id_radica", $IdRadicado, PDO::PARAM_STR);
                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            }

            $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
            $Result = $Instruc->fetch();
            $conexion = null;

            if ($Result) {

                return new self(
                    "",
                    $Result['id_radica'],
                    $Result['id_serie'],
                    $Result['id_subserie'],
                    $Result['id_tipodoc'],
                    $Result['id_usua_regis'],
                    $Result['id_forma_llegada'],
                    $Result['id_remite'],
                    $Result['id_tipo_correspon'],
                    $Result['id_ruta'],
                    $Result['fechor_radica'],
                    $Result['fec_docu'],
                    $Result['fec_venci'],
                    $Result['asunto'],
                    $Result['num_anexos'],
                    $Result['observa_anexo'],
                    $Result['num_folio'],
                    $Result['requie_respues'],
                    $Result['impri_rotu'],
                    $Result['digital'],
                    $Result['fechor_impri_rotu'],
                    $Result['usua_impri_rotu'],
                    $Result['radica_respuesta'],
                    $Result['respondido'],
                    $Result['transferido'],
                    $Result['estado'],
                    $Result['proyector'],
                    $Result['observa_radica'],
                    $Result['autoriza'],
                    $Result['opcion_relacion'],
                    $Result['opcion_titulo'],
                    $Result['opcion_sub_titulo'],
                    $Result['opcion_detalle1'],
                    $Result['opcion_detalle2'],
                    $Result['opcion_detalle3'],
                    $Result['nombre_archivo'],
                    $Result['archivo']
                );
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo 'Ha surgido un error y no se puede ejecutar la consulta.' . $e->getMessage();
            exit;
        }
    }

    public static function Generar_Query_Correspondencia($Criterio3)
    {
        $conexion = new Conexion();

        /* TOTALES DE RADICADOS CON COINSEDENCIAS EN EL RADICADO */
        $SqlTotalIdRadica    = "SELECT COUNT(id_radica) AS 'Total' FROM `archivo_radica_recibidos` WHERE `transferido` = 0 AND `id_radica` LIKE ?";
        $InstrucTotaIdRadica = $conexion->prepare($SqlTotalIdRadica);
        $InstrucTotaIdRadica->execute(array('%' . $Criterio3 . '%')) or die(print_r($InstrucTotalAsunto->errorInfo() . " - " . $SqlTotalIdRadica, true));
        $ResultTotalIdRadica = $InstrucTotaIdRadica->fetch();
        $TotalIdRadica       = $ResultTotalIdRadica['Total'];

        /* TOTALES DE RADICADOS CON COINSEDENCIAS EN EL ASUNTO */
        $SqlTotalAsunto     = "SELECT COUNT(asunto) AS 'Total' FROM `archivo_radica_recibidos` WHERE `transferido` = 0 AND `asunto` LIKE ?";
        $InstrucTotalAsunto = $conexion->prepare($SqlTotalAsunto);
        $InstrucTotalAsunto->execute(array('%' . $Criterio3 . '%')) or die(print_r($InstrucTotalAsunto->errorInfo() . " - " . $SqlTotalAsunto, true));
        $ResultTotalAsunto  = $InstrucTotalAsunto->fetch();
        $TotalAsunto        = $ResultTotalAsunto['Total'];

        /* TOTALES DE RADICADOS CON COINSEDENCIAS CON LOS RESPONSABLES */
        $SqlTotalFuncionarios = "SELECT COUNT(`radi`.`id_radica`) AS `Total`
                                FROM `archivo_radica_recibidos_responsa` AS `radi_respon`
                                    INNER JOIN `archivo_radica_recibidos` AS `radi` ON (`radi_respon`.`id_radica` = `radi`.`id_radica`)
                                    INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`radi_respon`.`id_funcio` = `funcio_deta`.`id_funcio_deta`)
                                    INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`)
                                WHERE (`radi_respon`.`respon` = 1 AND `radi`.`transferido` = 0 AND CONCAT(TRIM(`funcio`.`nom_funcio`), ' ', TRIM(`funcio`.`ape_funcio`)) LIKE ?)";
        $InstrucTotalFuncionarios = $conexion->prepare($SqlTotalFuncionarios);
        $InstrucTotalFuncionarios->execute(array('%' . $Criterio3 . '%')) or die(print_r($InstrucTotalAsunto->errorInfo() . " - " . $SqlTotalAsunto, true));
        $ResultTotalFuncionarios = $InstrucTotalFuncionarios->fetch();
        $TotalFuncionarios = $ResultTotalFuncionarios['Total'];

        /* TOTALES DE RADICADOS CON COINSEDENCIAS CON LOS TERCEROS */
        $SqlTotalContacto = "SELECT COUNT(`radi`.`id_radica`) AS `Total`
                            FROM `archivo_radica_recibidos` AS `radi`
                                INNER JOIN `gene_terceros_contac` AS `contac` ON (`radi`.`id_remite` = `contac`.`id_tercero`)
                            WHERE (`radi`.`transferido` = 0 AND `contac`.`nom_contac` LIKE ?)";
        $InstrucTotalContactos = $conexion->prepare($SqlTotalContacto);
        $InstrucTotalContactos->execute(array('%' . $Criterio3 . '%')) or die(print_r($SqlTotalContacto->errorInfo() . " - " . $SqlTotalContacto, true));
        $ResultTotalContactos = $InstrucTotalContactos->fetch();
        $TotalContactos = $ResultTotalContactos['Total'];

        /* TOTALES DE RADICADOS CON COINSEDENCIAS CON LOS LAS EMPRESAS DE LOS TERCEROS */
        $SqlTotalEmpresas = "SELECT COUNT(`radi`.`id_radica`) AS `Total`
                            FROM `archivo_radica_recibidos` AS `radi`
                                INNER JOIN `gene_terceros_contac` AS `contac` ON (`radi`.`id_remite` = `contac`.`id_tercero`)
                                LEFT JOIN `gene_terceros_empresas` AS `empre` ON (`contac`.`id_empre` = `empre`.`id_empre`)
                            WHERE (`radi`.`transferido` = 0 AND `empre`.`razo_soci` LIKE ?)";
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
                $Query .= " OR CONCAT(TRIM(`funcio`.`nom_funcio`), ' ', TRIM(`funcio`.`ape_funcio`)) LIKE '%" . $Criterio3 . "%'";
            } else {
                $Query .= " AND CONCAT(TRIM(`funcio`.`nom_funcio`), ' ', TRIM(`funcio`.`ape_funcio`)) LIKE '%" . $Criterio3 . "%'";
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
    }
}
