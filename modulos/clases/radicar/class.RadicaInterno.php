 <?php
    class RadicadoInterno
    {
        //Atributos
        private $Accion;
        private $IdRadica;
        private $IdSerie;
        private $IdSubserie;
        private $IdTipoDoc;
        private $IdFuncioRegis;
        private $IdRuta;
        private $FecRadica;
        private $FecDocu;
        private $FecVenci;
        private $Asunto;
        private $NumFolios;
        private $NumAnexos;
        private $ObservaAnexos;
        private $Texto;
        private $Adjunto;
        private $RequiRespuesta;
        private $Transferido;
        private $TipoDocumento;
        private $RadicaRespuesta;
        private $ImpriRotulo;
        private $Origen;

        public function __construct(
            $Accion = null,
            $IdRadica = null,
            $IdSerie = null,
            $IdSubserie = null,
            $IdTipoDoc = null,
            $IdFuncioRegis = null,
            $IdRuta = null,
            $FecRadica = null,
            $FecDocu = null,
            $FecVenci = null,
            $Asunto = null,
            $NumFolios = null,
            $NumAnexos = null,
            $ObservaAnexos = null,
            $Texto = null,
            $Adjunto = null,
            $RequiRespuesta = null,
            $Transferido = null,
            $TipoDocumento = null,
            $RadicaRespuesta = null,
            $ImpriRotulo = null,
            $Origen = null
        ) {

            $this->Accion          = $Accion;
            $this->IdRadica        = $IdRadica;
            $this->IdFuncioRegis   = $IdFuncioRegis;
            $this->IdSerie         = $IdSerie;
            $this->IdSubserie      = $IdSubserie;
            $this->IdTipoDoc       = $IdTipoDoc;
            $this->IdRuta          = $IdRuta;
            $this->FecRadica       = $FecRadica;
            $this->FecDocu         = $FecDocu;
            $this->FecVenci        = $FecVenci;
            $this->Asunto          = $Asunto;
            $this->NumFolios       = $NumFolios;
            $this->NumAnexos       = $NumAnexos;
            $this->ObservaAnexos   = $ObservaAnexos;
            $this->Texto           = $Texto;
            $this->Adjunto         = $Adjunto;
            $this->RequiRespuesta  = $RequiRespuesta;
            $this->Transferido     = $Transferido;
            $this->TipoDocumento   = $TipoDocumento;
            $this->RadicaRespuesta = $RadicaRespuesta;
            $this->ImpriRotulo     = $ImpriRotulo;
            $this->Origen          = $Origen;
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

        public function get_IdFuncioRegis()
        {
            return $this->IdFuncioRegis;
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

        public function get_FecVenci()
        {
            return $this->FecVenci;
        }

        public function get_Asunto()
        {
            return $this->Asunto;
        }

        public function get_NumFolios()
        {
            return $this->NumFolios;
        }

        public function get_NumAnexos()
        {
            return $this->NumAnexos;
        }

        public function get_ObservaAnexos()
        {
            return $this->ObservaAnexos;
        }

        public function get_Texto()
        {
            return $this->Texto;
        }

        public function get_Adjunto()
        {
            return $this->Adjunto;
        }

        public function get_RequiRespuesta()
        {
            return $this->RequiRespuesta;
        }

        public function get_Trasnferido()
        {
            return $this->Transferido;
        }

        public function get_TipoDocumento()
        {
            return $this->TipoDocumento;
        }

        public function get_RadicaRespuesta()
        {
            return $this->RadicaRespuesta;
        }

        public function get_ImpriRotulo()
        {
            return $this->ImpriRotulo;
        }

        public function get_Origen()
        {
            return $this->Origen;
        }

        // FUNCIONES PARA ENVIAR VALORES //
        public function set_Accion($Accion)
        {
            return $this->Accion = $Accion;
        }

        public function set_IdRadica($IdRadica)
        {
            return $this->IdRadica = $IdRadica;
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

        public function set_IdFuncioRegis($IdFuncioRegis)
        {
            return $this->IdFuncioRegis = $IdFuncioRegis;
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

        public function set_FecVenci($FecVenci)
        {
            return $this->FecVenci = $FecVenci;
        }

        public function set_Asunto($Asunto)
        {
            return $this->Asunto = $Asunto;
        }

        public function set_NumFolios($NumFolios)
        {
            return $this->NumFolios = $NumFolios;
        }

        public function set_NumAnexos($NumAnexos)
        {
            return $this->NumAnexos = $NumAnexos;
        }

        public function set_ObservaAnexos($ObservaAnexos)
        {
            return $this->ObservaAnexos = $ObservaAnexos;
        }

        public function set_Texto($Texto)
        {
            return $this->Texto = $Texto;
        }

        public function set_Adjunto($Adjunto)
        {
            return $this->Adjunto = $Adjunto;
        }

        public function set_RequiRespuesta($RequiRespuesta)
        {
            return $this->RequiRespuesta = $RequiRespuesta;
        }

        public function set_Trasferido($Transferido)
        {
            return $this->Transferido = $Transferido;
        }

        public function set_TipoDocumento($TipoDocumento)
        {
            return $this->TipoDocumento = $TipoDocumento;
        }

        public function set_RadicaRespuesta($RadicaRespuesta)
        {
            return $this->RadicaRespuesta = $RadicaRespuesta;
        }

        public function set_ImpriRotulo($ImpriRotulo)
        {
            return $this->ImpriRotulo = $ImpriRotulo;
        }

        public function set_Origen($Origen)
        {
            return $this->Origen = $Origen;
        }

        public function Gestionar()
        {
            $conexion = new Conexion();

            try {

                $ParamFecRadica = PDO::PARAM_STR;
                if (is_null($this->FecRadica) || $this->FecRadica == "") {
                    $ParamFecRadica =  \PDO::PARAM_NULL;
                }

                $ParamFecVenci = PDO::PARAM_STR;
                if (is_null($this->FecVenci) || $this->FecVenci == "") {
                    $ParamFecVenci =  \PDO::PARAM_NULL;
                }

                $ParamSerie = PDO::PARAM_INT;
                if ($this->IdSerie == "NULL") {
                    $ParamSerie =  \PDO::PARAM_NULL;
                }

                $ParamSubSerie = PDO::PARAM_INT;
                if ($this->IdSubserie == "NULL") {
                    $ParamSubSerie =  \PDO::PARAM_NULL;
                }

                if ($this->Accion === 'RADICAR_COMUNCACION') {
                    //ACTUALIZO LA CORRESPONDENCIA SIN GENERAR EL RADICADO
                    $Sql = 'INSERT INTO `archivo_radica_interna`(`id_radica`, `id_serie`, `id_subserie`, `id_tipodoc`, `id_funcio_regis`, `fechor_radica`,
                            `fec_docu`, `fec_venci`, `asunto`, `num_folio`, `num_anexos`, `observa_anexos`, `texto`, `requie_respuesta`, origen)
                        VALUES (:id_radica, :id_serie, :id_subserie, :id_tipodoc, :id_funcio_regis, :fechor_radica, :fec_docu, :fec_venci, :asunto,
                                :num_folio, :num_anexos, :observa_anexos, :texto, :requie_respuesta, :origen)';

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
                    $Instruc->bindParam(':id_serie', $this->IdSerie, $ParamSerie);
                    $Instruc->bindParam(':id_subserie', $this->IdSubserie, $ParamSubSerie);
                    $Instruc->bindParam(':id_tipodoc', $this->IdTipoDoc, PDO::PARAM_INT);
                    $Instruc->bindParam(':id_funcio_regis', $this->IdFuncioRegis, PDO::PARAM_INT);
                    $Instruc->bindParam(':fechor_radica', $this->FecRadica, PDO::PARAM_STR);
                    $Instruc->bindParam(':fec_docu', $this->FecDocu, PDO::PARAM_STR);
                    $Instruc->bindParam(':fec_venci', $this->FecVenci, $ParamFecVenci);
                    $Instruc->bindParam(':asunto', $this->Asunto, PDO::PARAM_STR);
                    $Instruc->bindParam(':num_folio', $this->NumFolios, PDO::PARAM_INT);
                    $Instruc->bindParam(':num_anexos', $this->NumAnexos, PDO::PARAM_INT);
                    $Instruc->bindParam(':observa_anexos', $this->ObservaAnexos, PDO::PARAM_STR);
                    $Instruc->bindParam(':texto', $this->Texto, PDO::PARAM_STR);
                    $Instruc->bindParam(':requie_respuesta', $this->RequiRespuesta, PDO::PARAM_INT);
                    $Instruc->bindParam(':origen', $this->Origen, PDO::PARAM_STR);
                } elseif ($this->Accion === 'EDITAR_RUTA') {
                    $Sql = "UPDATE archivo_radica_interna
                        SET `id_ruta` = :id_ruta, adjunto = :adjunto
                        WHERE `id_radica` = :id_radica";

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->bindParam(':id_ruta', $this->IdRuta, PDO::PARAM_INT);
                    $Instruc->bindParam(':adjunto', $this->Adjunto, PDO::PARAM_INT);
                    $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
                } elseif ($this->Accion === 'EDITAR_RUTA_ADJUNTO') {
                    $Sql = "UPDATE archivo_radica_interna
                        SET `id_ruta` = :id_ruta, `adjunto` = :adjunto
                        WHERE `id_radica` = :id_radica";

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->bindParam(':id_ruta', $this->IdRuta, PDO::PARAM_INT);
                    $Instruc->bindParam(':adjunto', $this->Adjunto, PDO::PARAM_INT);
                    $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
                } elseif ($this->Accion === 'IMPRIMIR_ROTULO') {
                    $Sql = "UPDATE archivo_radica_interna
                        SET impri_rotu = 1
                        WHERE id_radica = :id_radica";

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
                } elseif ($this->Accion === 'RESPONDER') {
                    $Sql = "UPDATE archivo_radica_interna
                        SET `radica_respuesta` = :radica_respuesta
                        WHERE `id_radica` = :id_radica";

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->bindParam(':radica_respuesta', $this->RadicaRespuesta, PDO::PARAM_STR);
                    $Instruc->bindParam(':id_radica', $this->IdRadica, PDO::PARAM_STR);
                }

                $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
                $this->IdRadica = $conexion->lastInsertId();
                $conexion = null;

                if ($Instruc) {
                    return true;
                } else {
                    return false;
                }
            } catch (PDOException $e) {
                echo 'Ha surgido un error y no se puede ejecutar la consulta, Ventanilla correspondencia interna' . $e->getMessage();
                exit;
            }
        }

        public static function Listar_Varios($Accion, $IdRadicado, $IdFuncio, $IdDepen, $IdOfi, $Criterio1, $Criterio2, $Criterio3)
        {
            $conexion = new Conexion();

            try {
                if ($Accion == 1) {
                    $Sql = "SELECT `radi`.`id_radica`, `radi`.`fec_docu`, `radi`.`num_folio`, `radi`.`num_anexos`, `radi`.`observa_anexos`, `radi`.`adjunto`, `radi`.`fechor_radica`, `radi`.`fec_venci`, `radi`.`requie_respuesta`,
                            `radi`.`radica_respuesta`, `radi`.`asunto`, `radi`.`texto`, `radi`.`impri_rotu`, `funcio_regis`.`nom_funcio` AS `nom_funcio_radi`,
                            `funcio_regis`.`ape_funcio` AS `ape_funcio_radi`, `funcio_depen`.`nom_depen` AS `nom_depen_radi`,
                            `funcio_ofi`.`nom_oficina` AS `nom_oficina_radi`, `respon`.`nom_funcio` AS `nom_funcio_respon`,
                            `respon`.`ape_funcio` AS `ape_funcio_respon`, `respon_depen`.`nom_depen` AS `nom_depen_respon`,
                            `respon_ofici`.`nom_oficina` AS `nom_oficina_respon`, `radi`.`transferido`, `serie`.`cod_serie`, `serie`.`nom_serie`,
                            `subserie`.`cod_subserie`, `subserie`.`nom_subserie`, `tip_docu`.`nom_tipodoc`, `radi`.`id_ruta`
                        FROM `archivo_radica_interna` AS `radi`
                            INNER JOIN `gene_funcionarios_deta` AS `fun_regis` ON (`radi`.`id_funcio_regis` = `fun_regis`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio_regis` ON (`fun_regis`.`id_funcio` = `funcio_regis`.`id_funcio`)
                            LEFT JOIN `areas_oficinas` AS `funcio_ofi` ON (`fun_regis`.`id_oficina` = `funcio_ofi`.`id_oficina`)
                            LEFT JOIN `areas_dependencias` AS `funcio_depen` ON (`funcio_ofi`.`id_depen` = `funcio_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_interna_responsa` AS `radi_respon` ON (`radi_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `respon_deta` ON (`radi_respon`.`id_funcio` = `respon_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `respon` ON (`respon_deta`.`id_funcio` = `respon`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `respon_ofici` ON (`respon_deta`.`id_oficina` = `respon_ofici`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `respon_depen` ON (`respon_ofici`.`id_depen` = `respon_depen`.`id_depen`)
                            LEFT JOIN `archivo_trd_series` AS `serie` ON (`radi`.`id_serie` = `serie`.`id_serie`)
                            LEFT JOIN `archivo_trd_subserie` AS `subserie` ON (`radi`.`id_subserie` = `subserie`.`id_subserie`)
                            LEFT JOIN `archivo_trd_tipo_docu` AS `tip_docu` ON (`radi`.`id_tipodoc` = `tip_docu`.`id_tipodoc`)
                        WHERE (`radi`.`id_radica` = :id_radica AND `radi_respon`.`respon` = 1)";

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->bindParam(":id_radica", $IdRadicado, PDO::PARAM_INT);
                    $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
                } elseif ($Accion == 2) {
                    /******************************************************************************************/
                    /*  GERAR RADICADO YYYYMMDD-#####
                    /******************************************************************************************/
                    $Sql = "SELECT CONCAT(DATE_FORMAT(NOW(),'%Y%m%d'),'-',LPAD(COUNT(id_radica)+1, 5, 0)) AS IdRadicado
                        FROM archivo_radica_interna WHERE YEAR(fechor_radica) = YEAR(NOW())";

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
                } elseif ($Accion == 3) {
                    /******************************************************************************************/
                    /*  GERAR RADICADO 'COD DEPEN.COD CORRES.YYYYMMMDD-#####'
                    /******************************************************************************************/
                    $Sql = "SELECT CONCAT((SELECT CONCAT(cod_depen, cod_corres)
                        FROM areas_dependencias
                        WHERE id_depen = :id_depen),'.',DATE_FORMAT(NOW(),'%Y%m%d'),'-',LPAD(COUNT(id_radica)+1, 5, 0)) AS IdRadicado
                        FROM archivo_radica_interna WHERE YEAR(fechor_radica) = YEAR(NOW())";

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
                        FROM archivo_radica_interna WHERE YEAR(fechor_radica) = YEAR(NOW())";

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->bindParam(":id_depen", $IdDepen, PDO::PARAM_INT);
                    $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
                } elseif ($Accion == 5) {
                    /******************************************************************************************/
                    /*  LISTO LOS RADICADOS QUE REQUIEREN DE RESPUESTA
                    /******************************************************************************************/
                } elseif ($Accion == 6) {
                    /******************************************************************************************/
                    /*  PLANILLA POR RANGO DE FECHAS
                    /******************************************************************************************/
                    $Sql = "SELECT `ra`.`id_radica`, `ra`.`fechor_radica`, `ra`.`asunto`, `ra`.`num_folio`, `ra`.`num_anexos`, `fun_respo`.`nom_funcio`,
                            `fun_respo`.`ape_funcio`, `depen_respo`.`nom_depen`, `ofi_respo`.`nom_oficina`
                        FROM `archivo_radica_interna_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_interna` AS `ra` ON (`ra_respon`.`id_radica` = `ra`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `fun_respo_deta` ON (`ra_respon`.`id_funcio` = `fun_respo_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `fun_respo` ON (`fun_respo_deta`.`id_funcio` = `fun_respo`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi_respo` ON (`fun_respo_deta`.`id_oficina` = `ofi_respo`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen_respo` ON (`ofi_respo`.`id_depen` = `depen_respo`.`id_depen`)
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
                    $Sql = "SELECT `ra`.`id_radica`, `ra`.`fechor_radica`, `ra`.`asunto`, `ra`.`num_folio`, `ra`.`num_anexos`, `fun_respo`.`nom_funcio`,
                            `fun_respo`.`ape_funcio`, `depen_respo`.`nom_depen`, `ofi_respo`.`nom_oficina`
                        FROM `archivo_radica_interna_responsa` AS `ra_respon`
                            INNER JOIN `archivo_radica_interna` AS `ra` ON (`ra_respon`.`id_radica` = `ra`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `fun_respo_deta` ON (`ra_respon`.`id_funcio` = `fun_respo_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `fun_respo` ON (`fun_respo_deta`.`id_funcio` = `fun_respo`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `ofi_respo` ON (`fun_respo_deta`.`id_oficina` = `ofi_respo`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `depen_respo` ON (`ofi_respo`.`id_depen` = `depen_respo`.`id_depen`)
                        WHERE (`ra`.`id_radica` BETWEEN :criterio1 AND :criterio2  AND `ra_respon`.`respon` = 1)
                        ORDER BY `ra`.`id_radica` ASC";

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->bindParam(":criterio1", $Criterio1, PDO::PARAM_STR);
                    $Instruc->bindParam(":criterio2", $Criterio2, PDO::PARAM_STR);
                    $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
                } elseif ($Accion == 8) {
                    /******************************************************************************************/
                    /*  LISTAR RADICADOS PARA ORGANIZAR EL ARCHIVO
                /******************************************************************************************/
                    $Sql = "SELECT DISTINCT
                            `archivo_radica_interna`.`id_radica`
                            , `archivo_radica_interna`.`fechor_radica`
                            , `archivo_radica_interna_adjuntos`.`nom_archivo`
                        FROM
                            `archivo_radica_interna_adjuntos`
                            INNER JOIN `archivo_radica_interna`
                                ON (`archivo_radica_interna_adjuntos`.`id_radica` = `archivo_radica_interna`.`id_radica`)
                        WHERE `archivo_radica_interna`.`adjunto` = 1;";

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
                }

                $Result = $Instruc->fetchAll();
                $conexion = null;
                return $Result;
            } catch (PDOException $e) {
                echo 'Ha surgido un error y no se puede ejecutar la consulta listar varios, Accion ' . $Accion . ' - ' . $e->getMessage();
                exit;
            }
        }

        public static function Listar_Correspondencia($Accion, $IdRadicado, $IdFuncioDeta, $IdDepen, $IdOfi, $Criterio1, $Criterio2, $Criterio3, $TipoCorrespondencia)
        {
            $conexion = new Conexion();

            $TipoFuncionario = "";

            try {
                if ($Accion == 1) {
                    /********************************************************************************************************************************/
                    /*  LISTO TODA LA CORRESPONDENCIA INTERNA ENVIADA DEL PROPIETARIO PRINCIPAL DE LA INSTITUCION
                /********************************************************************************************************************************/
                    $Sql = "SELECT `radi`.`id_radica`, `radi`.`adjunto`, `radi`.`fechor_radica`, `radi`.`fec_venci`, `radi`.`asunto`, `radi`.`texto`,
                            `radi`.`impri_rotu`, `funcio_regis`.`nom_funcio` AS `nom_funcio_radi`, `funcio_regis`.`ape_funcio` AS `ape_funcio_radi`,
                            `funcio_depen`.`nom_depen` AS `nom_depen_radi`, `funcio_ofi`.`nom_oficina` AS `nom_oficina_radi`,
                            `respon`.`nom_funcio` AS `nom_funcio_respon`, `respon`.`ape_funcio` AS `ape_funcio_respon`, `respon_depen`.`id_depen`,
                            `respon_depen`.`nom_depen` AS `nom_depen_respon`, `respon_ofici`.`nom_oficina` AS `nom_oficina_respon`, `radi`.`transferido`,
                            `radi`.`requie_respuesta`, `radi`.`radica_respuesta`
                        FROM `archivo_radica_interna` AS `radi`
                            INNER JOIN `gene_funcionarios_deta` AS `fun_regis` ON (`radi`.`id_funcio_regis` = `fun_regis`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio_regis` ON (`fun_regis`.`id_funcio` = `funcio_regis`.`id_funcio`)
                            LEFT JOIN `areas_oficinas` AS `funcio_ofi` ON (`fun_regis`.`id_oficina` = `funcio_ofi`.`id_oficina`)
                            LEFT JOIN `areas_dependencias` AS `funcio_depen` ON (`funcio_ofi`.`id_depen` = `funcio_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_interna_responsa` AS `radi_respon` ON (`radi_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `respon_deta` ON (`radi_respon`.`id_funcio` = `respon_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `respon` ON (`respon_deta`.`id_funcio` = `respon`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `respon_ofici` ON (`respon_deta`.`id_oficina` = `respon_ofici`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `respon_depen` ON (`respon_ofici`.`id_depen` = `respon_depen`.`id_depen`)
                        WHERE `radi_respon`.`respon` = 1 AND `radi`.`transferido` = 0
                        ORDER BY `radi`.`fechor_radica` DESC
                        LIMIT 0, 50";

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->bindParam(":Criterio1", $Criterio1, PDO::PARAM_INT);
                    $Instruc->bindParam(":Criterio2", $Criterio2, PDO::PARAM_INT);
                    $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
                } elseif ($Accion == 2) {
                    /********************************************************************************************************************************/
                    /*  LISTO LOS RADICADOS ENVIADOS DE UN FUNCIONARIO
                    /********************************************************************************************************************************/

                    if ($TipoCorrespondencia == "Recibidos") {
                        $TipoFuncionario = "`radi_destina`.`id_funcio_deta`";
                    } else {
                        $TipoFuncionario = "`radi_respon`.`id_funcio`";
                    }

                    $Sql = "SELECT `radi`.`id_radica`, `radi`.`adjunto`, `radi`.`fechor_radica`, `radi`.`fec_venci`, `radi`.`asunto`, `radi`.`texto`,
                            `funcio_regis`.`nom_funcio` AS `nom_funcio_regis`, `funcio_regis`.`ape_funcio` AS `ape_funcio_regis`,
                            `funcio_depen`.`nom_depen` AS `nom_depen_regis`, `funcio_ofi`.`nom_oficina` AS `nom_oficina_regis`,
                            `respon`.`nom_funcio` AS `nom_funcio_respon`, `respon`.`ape_funcio` AS `ape_funcio_respon`,
                            `respon_depen`.`nom_depen` AS `nom_depen_respon`, `respon_ofici`.`nom_oficina` AS `nom_oficina_respon`,
                            `destina`.`nom_funcio` AS `nom_funcio_destina`, `destina`.`ape_funcio` AS `ape_funcio_destina`,
                            `destina_depen`.`nom_depen` AS `nom_depen_destina`, `destina_ofi`.`nom_oficina` AS `nom_oficina_destina`,
                            `radi_destina`.`leido`, `radi_destina`.`fechor_leido`, `radi_destina`.`cc`, `radi_destina`.`id_funcio_deta`,
                            `radi_destina`.`leido`, `radi`.`transferido`, `radi`.`requie_respuesta`, `radi`.`radica_respuesta`
                        FROM `archivo_radica_interna` AS `radi`
                            INNER JOIN `gene_funcionarios_deta` AS `fun_regis` ON (`radi`.`id_funcio_regis` = `fun_regis`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio_regis` ON (`fun_regis`.`id_funcio` = `funcio_regis`.`id_funcio`)
                            LEFT JOIN `areas_oficinas` AS `funcio_ofi` ON (`fun_regis`.`id_oficina` = `funcio_ofi`.`id_oficina`)
                            LEFT JOIN `areas_dependencias` AS `funcio_depen` ON (`funcio_ofi`.`id_depen` = `funcio_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_interna_responsa` AS `radi_respon` ON (`radi_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `respon_deta` ON (`radi_respon`.`id_funcio` = `respon_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `respon` ON (`respon_deta`.`id_funcio` = `respon`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `respon_ofici` ON (`respon_deta`.`id_oficina` = `respon_ofici`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `respon_depen` ON (`respon_ofici`.`id_depen` = `respon_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_interna_destinata` AS `radi_destina` ON (`radi_destina`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `destina_deta` ON (`radi_destina`.`id_funcio_deta` = `destina_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `destina` ON (`destina_deta`.`id_funcio` = `destina`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `destina_ofi` ON (`destina_deta`.`id_oficina` = `destina_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `destina_depen` ON (`destina_ofi`.`id_depen` = `destina_depen`.`id_depen`)
                        WHERE (`radi_respon`.`respon` = 1 AND `radi`.`transferido` = 0 AND " . $TipoFuncionario . " = :id_funcio)
                        ORDER BY `radi`.`fechor_radica` DESC
                        LIMIT :Criterio1, :Criterio2";

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->bindParam(":id_funcio", $IdFuncioDeta, PDO::PARAM_INT);
                    $Instruc->bindParam(":Criterio1", $Criterio1, PDO::PARAM_INT);
                    $Instruc->bindParam(":Criterio2", $Criterio2, PDO::PARAM_INT);
                    $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
                } elseif ($Accion == 3) {
                    /********************************************************************************************************************************/
                    /*  LISTO LA CORRESPONDENCIA INTERNA DE UN FUNCIONARIO JEFE DE DEPENDENCIA
                /********************************************************************************************************************************/
                    if ($TipoCorrespondencia == "Destinatario") {
                        $TipoFuncionario = "`destina_ofi`.`id_depen`";
                    } else {
                        $TipoFuncionario = "`respon_depen`.`id_depen`";
                    }

                    $Sql = "SELECT `radi`.`id_radica`, `radi`.`adjunto`, `radi`.`fechor_radica`, `radi`.`fec_venci`, `radi`.`asunto`, `radi`.`texto`,
                            `funcio_regis`.`nom_funcio` AS `nom_funcio_regis`, `funcio_regis`.`ape_funcio` AS `ape_funcio_regis`,
                            `funcio_depen`.`nom_depen` AS `nom_depen_regis`, `funcio_ofi`.`nom_oficina` AS `nom_oficina_regis`,
                            `respon`.`nom_funcio` AS `nom_funcio_respon`, `respon`.`ape_funcio` AS `ape_funcio_respon`,
                            `respon_depen`.`nom_depen` AS `nom_depen_respon`, `respon_ofici`.`nom_oficina` AS `nom_oficina_respon`,
                            `destina`.`nom_funcio` AS `nom_funcio_destina`, `destina`.`ape_funcio` AS `ape_funcio_destina`,
                            `destina_depen`.`nom_depen` AS `nom_depen_destina`, `destina_ofi`.`nom_oficina` AS `nom_oficina_destina`,
                            `radi_destina`.`leido`, `radi_destina`.`fechor_leido`, `radi_destina`.`cc`, `radi_destina`.`id_funcio_deta`,
                            `radi_destina`.`leido`, `radi`.`transferido`, `radi`.`radica_respuesta`
                        FROM `archivo_radica_interna` AS `radi`
                            INNER JOIN `gene_funcionarios_deta` AS `fun_regis` ON (`radi`.`id_funcio_regis` = `fun_regis`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio_regis` ON (`fun_regis`.`id_funcio` = `funcio_regis`.`id_funcio`)
                            LEFT JOIN `areas_oficinas` AS `funcio_ofi` ON (`fun_regis`.`id_oficina` = `funcio_ofi`.`id_oficina`)
                            LEFT JOIN `areas_dependencias` AS `funcio_depen` ON (`funcio_ofi`.`id_depen` = `funcio_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_interna_responsa` AS `radi_respon` ON (`radi_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `respon_deta` ON (`radi_respon`.`id_funcio` = `respon_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `respon` ON (`respon_deta`.`id_funcio` = `respon`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `respon_ofici` ON (`respon_deta`.`id_oficina` = `respon_ofici`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `respon_depen` ON (`respon_ofici`.`id_depen` = `respon_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_interna_destinata` AS `radi_destina` ON (`radi_destina`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `destina_deta` ON (`radi_destina`.`id_funcio_deta` = `destina_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `destina` ON (`destina_deta`.`id_funcio` = `destina`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `destina_ofi` ON (`destina_deta`.`id_oficina` = `destina_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `destina_depen` ON (`destina_ofi`.`id_depen` = `destina_depen`.`id_depen`)
                        WHERE (`radi_respon`.`respon` = 1 AND `radi`.`transferido` = 0 AND " . $TipoFuncionario . " = :id_depen)
                        ORDER BY `radi`.`fechor_radica` DESC
                        LIMIT :Criterio1, :Criterio2";

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->bindParam(":id_depen", $IdDepen, PDO::PARAM_INT);
                    $Instruc->bindParam(":Criterio1", $Criterio1, PDO::PARAM_INT);
                    $Instruc->bindParam(":Criterio2", $Criterio2, PDO::PARAM_INT);
                    $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
                } elseif ($Accion == 4) {
                    /********************************************************************************************************************************/
                    /*  LISTO LA CORRESPONDENCIA INTERNA DE UN FUNCIONARIO JEFE DE OFICINA
                /********************************************************************************************************************************/
                    if ($TipoCorrespondencia == "Destinatario") {
                        $TipoFuncionario = "`destina_deta`.`id_oficina`";
                    } else {
                        $TipoFuncionario = "`respon_ofici`.`id_oficina`";
                    }

                    $Sql = "SELECT `radi`.`id_radica`, `radi`.`adjunto`, `radi`.`fechor_radica`, `radi`.`fec_venci`, `radi`.`asunto`, `radi`.`texto`,
                            `funcio_regis`.`nom_funcio` AS `nom_funcio_regis`, `funcio_regis`.`ape_funcio` AS `ape_funcio_regis`,
                            `funcio_depen`.`nom_depen` AS `nom_depen_regis`, `funcio_ofi`.`nom_oficina` AS `nom_oficina_regis`,
                            `respon`.`nom_funcio` AS `nom_funcio_respon`, `respon`.`ape_funcio` AS `ape_funcio_respon`,
                            `respon_depen`.`nom_depen` AS `nom_depen_respon`, `respon_ofici`.`nom_oficina` AS `nom_oficina_respon`,
                            `destina`.`nom_funcio` AS `nom_funcio_destina`, `destina`.`ape_funcio` AS `ape_funcio_destina`,
                            `destina_depen`.`nom_depen` AS `nom_depen_destina`, `destina_ofi`.`nom_oficina` AS `nom_oficina_destina`,
                            `radi_destina`.`leido`, `radi_destina`.`fechor_leido`, `radi_destina`.`cc`, `radi_destina`.`id_funcio_deta`,
                            `radi_destina`.`leido`, `radi`.`transferido`, `radi`.`radica_respuesta`
                        FROM `archivo_radica_interna` AS `radi`
                            INNER JOIN `gene_funcionarios_deta` AS `fun_regis` ON (`radi`.`id_funcio_regis` = `fun_regis`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio_regis` ON (`fun_regis`.`id_funcio` = `funcio_regis`.`id_funcio`)
                            LEFT JOIN `areas_oficinas` AS `funcio_ofi` ON (`fun_regis`.`id_oficina` = `funcio_ofi`.`id_oficina`)
                            LEFT JOIN `areas_dependencias` AS `funcio_depen` ON (`funcio_ofi`.`id_depen` = `funcio_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_interna_responsa` AS `radi_respon` ON (`radi_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `respon_deta` ON (`radi_respon`.`id_funcio` = `respon_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `respon` ON (`respon_deta`.`id_funcio` = `respon`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `respon_ofici` ON (`respon_deta`.`id_oficina` = `respon_ofici`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `respon_depen` ON (`respon_ofici`.`id_depen` = `respon_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_interna_destinata` AS `radi_destina` ON (`radi_destina`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `destina_deta` ON (`radi_destina`.`id_funcio_deta` = `destina_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `destina` ON (`destina_deta`.`id_funcio` = `destina`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `destina_ofi` ON (`destina_deta`.`id_oficina` = `destina_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `destina_depen` ON (`destina_ofi`.`id_depen` = `destina_depen`.`id_depen`)
                        WHERE `radi_respon`.`respon` = 1 AND `radi`.`transferido` = 0 AND `respon_ofici`.`id_oficina` = :id_oficina
                        ORDER BY `radi`.`fechor_radica` DESC
                        LIMIT :Criterio1, :Criterio2";

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->bindParam(":id_oficina", $IdOfi, PDO::PARAM_INT);
                    $Instruc->bindParam(":Criterio1", $Criterio1, PDO::PARAM_INT);
                    $Instruc->bindParam(":Criterio2", $Criterio2, PDO::PARAM_INT);
                    $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
                } elseif ($Accion == 5) {
                    /******************************************************************************************/
                    /*  FILTRO TODA LA CORRESPONDENCIA ENVIADA DEL PROPIETARIO PRINCIPAL DE LA INSTITUCION
                /******************************************************************************************/
                    $Sql = "SELECT `radi`.`id_radica`, `radi`.`adjunto`, `radi`.`fechor_radica`, `radi`.`fec_venci`, `radi`.`asunto`, `radi`.`texto`,
                            `funcio_regis`.`nom_funcio` AS `nom_funcio_regis`, `funcio_regis`.`ape_funcio` AS `ape_funcio_regis`,
                            `funcio_depen`.`nom_depen` AS `nom_depen_regis`, `funcio_ofi`.`nom_oficina` AS `nom_oficina_regis`,
                            `respon`.`nom_funcio` AS `nom_funcio_respon`, `respon`.`ape_funcio` AS `ape_funcio_respon`,
                            `respon_depen`.`nom_depen` AS `nom_depen_respon`, `respon_ofici`.`nom_oficina` AS `nom_oficina_respon`,
                            `destina`.`nom_funcio` AS `nom_funcio_destina`, `destina`.`ape_funcio` AS `ape_funcio_destina`,
                            `destina_depen`.`nom_depen` AS `nom_depen_destina`, `destina_ofi`.`nom_oficina` AS `nom_oficina_destina`,
                            `radi_destina`.`leido`, `radi_destina`.`fechor_leido`, `radi_destina`.`cc`, `radi_destina`.`id_funcio_deta`,
                            `radi_destina`.`leido`, `radi`.`transferido`, `radi`.`radica_respuesta`
                        FROM `archivo_radica_interna` AS `radi`
                            INNER JOIN `gene_funcionarios_deta` AS `fun_regis` ON (`radi`.`id_funcio_regis` = `fun_regis`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio_regis` ON (`fun_regis`.`id_funcio` = `funcio_regis`.`id_funcio`)
                            LEFT JOIN `areas_oficinas` AS `funcio_ofi` ON (`fun_regis`.`id_oficina` = `funcio_ofi`.`id_oficina`)
                            LEFT JOIN `areas_dependencias` AS `funcio_depen` ON (`funcio_ofi`.`id_depen` = `funcio_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_interna_responsa` AS `radi_respon` ON (`radi_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `respon_deta` ON (`radi_respon`.`id_funcio` = `respon_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `respon` ON (`respon_deta`.`id_funcio` = `respon`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `respon_ofici` ON (`respon_deta`.`id_oficina` = `respon_ofici`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `respon_depen` ON (`respon_ofici`.`id_depen` = `respon_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_interna_destinata` AS `radi_destina` ON (`radi_destina`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `destina_deta` ON (`radi_destina`.`id_funcio_deta` = `destina_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `destina` ON (`destina_deta`.`id_funcio` = `destina`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `destina_ofi` ON (`destina_deta`.`id_oficina` = `destina_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `destina_depen` ON (`destina_ofi`.`id_depen` = `destina_depen`.`id_depen`)
                        WHERE (`radi`.`transferido` = 0 AND `radi_respon`.`respon` = 1 " . self::Generar_Query_Correspondencia($Criterio3) . ")
                        ORDER BY `radi`.`fechor_radica` DESC
                        LIMIT ?, ?";

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->execute(array($Criterio1, $Criterio2))
                        or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
                } elseif ($Accion == 6) {
                    /******************************************************************************************/
                    /*  FILTRO LA CORRESPONDENCIA EXTERNA DE UN FUNCIONARIO
                /******************************************************************************************/
                    if ($TipoCorrespondencia == "Destinatario") {
                        $TipoFuncionario = "`radi_destina`.`id_funcio_deta`";
                    } else {
                        $TipoFuncionario = "`radi_respon`.`id_funcio`";
                    }

                    $Sql = "SELECT `radi`.`id_radica`, `radi`.`adjunto`, `radi`.`fechor_radica`, `radi`.`fec_venci`, `radi`.`asunto`, `radi`.`texto`,
                            `funcio_regis`.`nom_funcio` AS `nom_funcio_regis`, `funcio_regis`.`ape_funcio` AS `ape_funcio_regis`,
                            `funcio_depen`.`nom_depen` AS `nom_depen_regis`, `funcio_ofi`.`nom_oficina` AS `nom_oficina_regis`,
                            `respon`.`nom_funcio` AS `nom_funcio_respon`, `respon`.`ape_funcio` AS `ape_funcio_respon`,
                            `respon_depen`.`nom_depen` AS `nom_depen_respon`, `respon_ofici`.`nom_oficina` AS `nom_oficina_respon`,
                            `destina`.`nom_funcio` AS `nom_funcio_destina`, `destina`.`ape_funcio` AS `ape_funcio_destina`,
                            `destina_depen`.`nom_depen` AS `nom_depen_destina`, `destina_ofi`.`nom_oficina` AS `nom_oficina_destina`,
                            `radi_destina`.`leido`, `radi_destina`.`fechor_leido`, `radi_destina`.`cc`, `radi_destina`.`id_funcio_deta`,
                            `radi_destina`.`leido`, `radi`.`transferido`, `radi`.`radica_respuesta`
                        FROM `archivo_radica_interna` AS `radi`
                            INNER JOIN `gene_funcionarios_deta` AS `fun_regis` ON (`radi`.`id_funcio_regis` = `fun_regis`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio_regis` ON (`fun_regis`.`id_funcio` = `funcio_regis`.`id_funcio`)
                            LEFT JOIN `areas_oficinas` AS `funcio_ofi` ON (`fun_regis`.`id_oficina` = `funcio_ofi`.`id_oficina`)
                            LEFT JOIN `areas_dependencias` AS `funcio_depen` ON (`funcio_ofi`.`id_depen` = `funcio_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_interna_responsa` AS `radi_respon` ON (`radi_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `respon_deta` ON (`radi_respon`.`id_funcio` = `respon_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `respon` ON (`respon_deta`.`id_funcio` = `respon`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `respon_ofici` ON (`respon_deta`.`id_oficina` = `respon_ofici`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `respon_depen` ON (`respon_ofici`.`id_depen` = `respon_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_interna_destinata` AS `radi_destina` ON (`radi_destina`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `destina_deta` ON (`radi_destina`.`id_funcio_deta` = `destina_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `destina` ON (`destina_deta`.`id_funcio` = `destina`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `destina_ofi` ON (`destina_deta`.`id_oficina` = `destina_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `destina_depen` ON (`destina_ofi`.`id_depen` = `destina_depen`.`id_depen`)
                        WHERE (`radi`.`transferido` = 0 AND `radi_respon`.`respon` = 1 AND " . $TipoFuncionario . " = ?
                            " . self::Generar_Query_Correspondencia($Criterio3) . ")
                        ORDER BY `radi`.`fechor_radica` DESC
                        LIMIT ?, ?";

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->execute(array($IdFuncioDeta, $Criterio1, $Criterio2))
                        or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
                } elseif ($Accion == 7) {
                    /******************************************************************************************/
                    /*  FILTRO LA CORRESPONDENCIA EXTERNA DE UN FUNCIONARIO JEFE DE DEPENDENCIA
                /******************************************************************************************/
                    if ($TipoCorrespondencia == "Destinatario") {
                        $TipoFuncionario = "`destina_ofi`.`id_depen`";
                    } else {
                        $TipoFuncionario = "`respon_depen`.`id_depen`";
                    }

                    $Sql = "SELECT `radi`.`id_radica`, `radi`.`adjunto`, `radi`.`fechor_radica`, `radi`.`fec_venci`, `radi`.`asunto`, `radi`.`texto`,
                            `funcio_regis`.`nom_funcio` AS `nom_funcio_regis`, `funcio_regis`.`ape_funcio` AS `ape_funcio_regis`,
                            `funcio_depen`.`nom_depen` AS `nom_depen_regis`, `funcio_ofi`.`nom_oficina` AS `nom_oficina_regis`,
                            `respon`.`nom_funcio` AS `nom_funcio_respon`, `respon`.`ape_funcio` AS `ape_funcio_respon`,
                            `respon_depen`.`nom_depen` AS `nom_depen_respon`, `respon_ofici`.`nom_oficina` AS `nom_oficina_respon`,
                            `destina`.`nom_funcio` AS `nom_funcio_destina`, `destina`.`ape_funcio` AS `ape_funcio_destina`,
                            `destina_depen`.`nom_depen` AS `nom_depen_destina`, `destina_ofi`.`nom_oficina` AS `nom_oficina_destina`,
                            `radi_destina`.`leido`, `radi_destina`.`fechor_leido`, `radi_destina`.`cc`, `radi_destina`.`id_funcio_deta`,
                            `radi_destina`.`leido`, `radi`.`transferido`, `radi`.`radica_respuesta`
                        FROM `archivo_radica_interna` AS `radi`
                            INNER JOIN `gene_funcionarios_deta` AS `fun_regis` ON (`radi`.`id_funcio_regis` = `fun_regis`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio_regis` ON (`fun_regis`.`id_funcio` = `funcio_regis`.`id_funcio`)
                            LEFT JOIN `areas_oficinas` AS `funcio_ofi` ON (`fun_regis`.`id_oficina` = `funcio_ofi`.`id_oficina`)
                            LEFT JOIN `areas_dependencias` AS `funcio_depen` ON (`funcio_ofi`.`id_depen` = `funcio_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_interna_responsa` AS `radi_respon` ON (`radi_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `respon_deta` ON (`radi_respon`.`id_funcio` = `respon_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `respon` ON (`respon_deta`.`id_funcio` = `respon`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `respon_ofici` ON (`respon_deta`.`id_oficina` = `respon_ofici`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `respon_depen` ON (`respon_ofici`.`id_depen` = `respon_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_interna_destinata` AS `radi_destina` ON (`radi_destina`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `destina_deta` ON (`radi_destina`.`id_funcio_deta` = `destina_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `destina` ON (`destina_deta`.`id_funcio` = `destina`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `destina_ofi` ON (`destina_deta`.`id_oficina` = `destina_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `destina_depen` ON (`destina_ofi`.`id_depen` = `destina_depen`.`id_depen`)
                        WHERE (`radi_respon`.`respon` = 1 AND `radi`.`transferido` = 0 AND " . $TipoFuncionario . " = ? " . self::Generar_Query_Correspondencia($Criterio3) . ")
                        ORDER BY `radi`.`fechor_radica` DESC
                        LIMIT ?, ?";

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->execute(array($IdDepen, $Criterio1, $Criterio2))
                        or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
                } elseif ($Accion == 8) {
                    /******************************************************************************************/
                    /*  FILTRO LA CORRESPONDENCIA EXTERNA DE UN FUNCIONARIO JEFE DE OFICINA
                /******************************************************************************************/
                    if ($TipoCorrespondencia == "Destinatario") {
                        $TipoFuncionario = "`destina_deta`.`id_oficina`";
                    } else {
                        $TipoFuncionario = "`respon_ofici`.`id_oficina`";
                    }

                    $Sql = "SELECT `radi`.`id_radica`, `radi`.`adjunto`, `radi`.`fechor_radica`, `radi`.`fec_venci`, `radi`.`asunto`, `radi`.`texto`,
                            `funcio_regis`.`nom_funcio` AS `nom_funcio_regis`, `funcio_regis`.`ape_funcio` AS `ape_funcio_regis`,
                            `funcio_depen`.`nom_depen` AS `nom_depen_regis`, `funcio_ofi`.`nom_oficina` AS `nom_oficina_regis`,
                            `respon`.`nom_funcio` AS `nom_funcio_respon`, `respon`.`ape_funcio` AS `ape_funcio_respon`,
                            `respon_depen`.`nom_depen` AS `nom_depen_respon`, `respon_ofici`.`nom_oficina` AS `nom_oficina_respon`,
                            `destina`.`nom_funcio` AS `nom_funcio_destina`, `destina`.`ape_funcio` AS `ape_funcio_destina`,
                            `destina_depen`.`nom_depen` AS `nom_depen_destina`, `destina_ofi`.`nom_oficina` AS `nom_oficina_destina`,
                            `radi_destina`.`leido`, `radi_destina`.`fechor_leido`, `radi_destina`.`cc`, `radi_destina`.`id_funcio_deta`,
                            `radi_destina`.`leido`, `radi`.`transferido`, `radi`.`radica_respuesta`
                        FROM `archivo_radica_interna` AS `radi`
                            INNER JOIN `gene_funcionarios_deta` AS `fun_regis` ON (`radi`.`id_funcio_regis` = `fun_regis`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio_regis` ON (`fun_regis`.`id_funcio` = `funcio_regis`.`id_funcio`)
                            LEFT JOIN `areas_oficinas` AS `funcio_ofi` ON (`fun_regis`.`id_oficina` = `funcio_ofi`.`id_oficina`)
                            LEFT JOIN `areas_dependencias` AS `funcio_depen` ON (`funcio_ofi`.`id_depen` = `funcio_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_interna_responsa` AS `radi_respon` ON (`radi_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `respon_deta` ON (`radi_respon`.`id_funcio` = `respon_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `respon` ON (`respon_deta`.`id_funcio` = `respon`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `respon_ofici` ON (`respon_deta`.`id_oficina` = `respon_ofici`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `respon_depen` ON (`respon_ofici`.`id_depen` = `respon_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_interna_destinata` AS `radi_destina` ON (`radi_destina`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `destina_deta` ON (`radi_destina`.`id_funcio_deta` = `destina_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `destina` ON (`destina_deta`.`id_funcio` = `destina`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `destina_ofi` ON (`destina_deta`.`id_oficina` = `destina_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `destina_depen` ON (`destina_ofi`.`id_depen` = `destina_depen`.`id_depen`)
                        WHERE `radi_respon`.`respon` = 1 AND `radi`.`transferido` = 0 AND `respon_depen`.`id_depen` = ? AND `respon_ofici`.`id_oficina` = :id_oficina " . self::Generar_Query_Correspondencia($Criterio3) . "
                        ORDER BY `radi`.`fechor_radica` DESC
                        LIMIT ?, ?";

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->execute(array($IdDepen, $IdOfi, $Criterio1, $Criterio2))
                        or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
                }

                $Result = $Instruc->fetchAll();
                $conexion = null;
                return $Result;
            } catch (PDOException $e) {
                echo 'Ha surgido un error y no se puede ejecutar la consulta listar.' . $e->getMessage();
                exit;
            }
        }

        public static function TotalRegistros_Correspondencia($Accion, $IdRadicado, $IdFuncioDeta, $IdDepen, $IdOfi, $Criterio1, $Criterio2, $Criterio3, $TipoCorrespondencia)
        {
            $conexion = new Conexion();
            $conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $TipoFuncionario = "";

            try {
                if ($Accion == 1) {
                    /********************************************************************************************************************************/
                    /*  LISTO TODA LA CORRESPONDENCIA INTERNA DEL PROPIETARIO PRINCIPAL DE LA INSTITUCION
                /********************************************************************************************************************************/
                    $Sql = "SELECT `radi`.`id_radica`
                        FROM `archivo_radica_interna` AS `radi`
                            INNER JOIN `gene_funcionarios_deta` AS `fun_regis` ON (`radi`.`id_funcio_regis` = `fun_regis`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio_regis` ON (`fun_regis`.`id_funcio` = `funcio_regis`.`id_funcio`)
                            LEFT JOIN `areas_oficinas` AS `funcio_ofi` ON (`fun_regis`.`id_oficina` = `funcio_ofi`.`id_oficina`)
                            LEFT JOIN `areas_dependencias` AS `funcio_depen` ON (`funcio_ofi`.`id_depen` = `funcio_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_interna_responsa` AS `radi_respon` ON (`radi_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `respon_deta` ON (`radi_respon`.`id_funcio` = `respon_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `respon` ON (`respon_deta`.`id_funcio` = `respon`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `respon_ofici` ON (`respon_deta`.`id_oficina` = `respon_ofici`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `respon_depen` ON (`respon_ofici`.`id_depen` = `respon_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_interna_destinata` AS `radi_destina` ON (`radi_destina`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `destina_deta` ON (`radi_destina`.`id_funcio_deta` = `destina_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `destina` ON (`destina_deta`.`id_funcio` = `destina`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `destina_ofi` ON (`destina_deta`.`id_oficina` = `destina_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `destina_depen` ON (`destina_ofi`.`id_depen` = `destina_depen`.`id_depen`)
                        WHERE `radi_respon`.`respon` = 1 AND `radi`.`transferido` = 0";

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
                } elseif ($Accion == 2) {
                    /********************************************************************************************************************************/
                    /*  LISTO LOS RADICADOS ENVIADOS DE UN FUNCIONARIO
                /********************************************************************************************************************************/
                    if ($TipoCorrespondencia == "Destinatario") {
                        $TipoFuncionario = "`radi_destina`.`id_funcio_deta`";
                    } else {
                        $TipoFuncionario = "`radi_respon`.`id_funcio`";
                    }

                    $Sql = "SELECT `radi`.`id_radica`
                        FROM `archivo_radica_interna` AS `radi`
                            INNER JOIN `gene_funcionarios_deta` AS `fun_regis` ON (`radi`.`id_funcio_regis` = `fun_regis`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio_regis` ON (`fun_regis`.`id_funcio` = `funcio_regis`.`id_funcio`)
                            LEFT JOIN `areas_oficinas` AS `funcio_ofi` ON (`fun_regis`.`id_oficina` = `funcio_ofi`.`id_oficina`)
                            LEFT JOIN `areas_dependencias` AS `funcio_depen` ON (`funcio_ofi`.`id_depen` = `funcio_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_interna_responsa` AS `radi_respon` ON (`radi_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `respon_deta` ON (`radi_respon`.`id_funcio` = `respon_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `respon` ON (`respon_deta`.`id_funcio` = `respon`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `respon_ofici` ON (`respon_deta`.`id_oficina` = `respon_ofici`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `respon_depen` ON (`respon_ofici`.`id_depen` = `respon_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_interna_destinata` AS `radi_destina` ON (`radi_destina`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `destina_deta` ON (`radi_destina`.`id_funcio_deta` = `destina_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `destina` ON (`destina_deta`.`id_funcio` = `destina`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `destina_ofi` ON (`destina_deta`.`id_oficina` = `destina_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `destina_depen` ON (`destina_ofi`.`id_depen` = `destina_depen`.`id_depen`)
                        WHERE `radi_respon`.`respon` = 1 AND `radi`.`transferido` = 0 AND " . $TipoFuncionario . " = :id_funcio";

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->bindParam(":id_funcio", $IdFuncioDeta, PDO::PARAM_INT);
                    $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
                } elseif ($Accion == 3) {
                    /********************************************************************************************************************************/
                    /*  LISTO LA CORRESPONDENCIA INTERNA DE UN FUNCIONARIO JEFE DE DEPENDENCIA
                /********************************************************************************************************************************/
                    if ($TipoCorrespondencia == "Destinatario") {
                        $TipoFuncionario = "`destina_ofi`.`id_depen`";
                    } else {
                        $TipoFuncionario = "`respon_depen`.`id_depen`";
                    }

                    $Sql = "SELECT `radi`.`id_radica`
                        FROM `archivo_radica_interna` AS `radi`
                            INNER JOIN `gene_funcionarios_deta` AS `fun_regis` ON (`radi`.`id_funcio_regis` = `fun_regis`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio_regis` ON (`fun_regis`.`id_funcio` = `funcio_regis`.`id_funcio`)
                            LEFT JOIN `areas_oficinas` AS `funcio_ofi` ON (`fun_regis`.`id_oficina` = `funcio_ofi`.`id_oficina`)
                            LEFT JOIN `areas_dependencias` AS `funcio_depen` ON (`funcio_ofi`.`id_depen` = `funcio_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_interna_responsa` AS `radi_respon` ON (`radi_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `respon_deta` ON (`radi_respon`.`id_funcio` = `respon_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `respon` ON (`respon_deta`.`id_funcio` = `respon`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `respon_ofici` ON (`respon_deta`.`id_oficina` = `respon_ofici`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `respon_depen` ON (`respon_ofici`.`id_depen` = `respon_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_interna_destinata` AS `radi_destina` ON (`radi_destina`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `destina_deta` ON (`radi_destina`.`id_funcio_deta` = `destina_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `destina` ON (`destina_deta`.`id_funcio` = `destina`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `destina_ofi` ON (`destina_deta`.`id_oficina` = `destina_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `destina_depen` ON (`destina_ofi`.`id_depen` = `destina_depen`.`id_depen`)
                        WHERE `radi_respon`.`respon` = 1 AND `radi`.`transferido` = 0 AND " . $TipoFuncionario . " = :id_depen";

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->bindParam(":id_depen", $IdDepen, PDO::PARAM_INT);
                    $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
                } elseif ($Accion == 4) {
                    /********************************************************************************************************************************/
                    /*  LISTO LA CORRESPONDENCIA INTERNA DE UN FUNCIONARIO JEFE DE OFICINA
                /********************************************************************************************************************************/
                    if ($TipoCorrespondencia == "Destinatario") {
                        $TipoFuncionario = "`destina_deta`.`id_oficina`";
                    } else {
                        $TipoFuncionario = "`respon_ofici`.`id_oficina`";
                    }

                    $Sql = "SELECT `radi`.`id_radica`
                        FROM `archivo_radica_interna` AS `radi`
                            INNER JOIN `gene_funcionarios_deta` AS `fun_regis` ON (`radi`.`id_funcio_regis` = `fun_regis`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio_regis` ON (`fun_regis`.`id_funcio` = `funcio_regis`.`id_funcio`)
                            LEFT JOIN `areas_oficinas` AS `funcio_ofi` ON (`fun_regis`.`id_oficina` = `funcio_ofi`.`id_oficina`)
                            LEFT JOIN `areas_dependencias` AS `funcio_depen` ON (`funcio_ofi`.`id_depen` = `funcio_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_interna_responsa` AS `radi_respon` ON (`radi_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `respon_deta` ON (`radi_respon`.`id_funcio` = `respon_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `respon` ON (`respon_deta`.`id_funcio` = `respon`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `respon_ofici` ON (`respon_deta`.`id_oficina` = `respon_ofici`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `respon_depen` ON (`respon_ofici`.`id_depen` = `respon_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_interna_destinata` AS `radi_destina` ON (`radi_destina`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `destina_deta` ON (`radi_destina`.`id_funcio_deta` = `destina_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `destina` ON (`destina_deta`.`id_funcio` = `destina`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `destina_ofi` ON (`destina_deta`.`id_oficina` = `destina_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `destina_depen` ON (`destina_ofi`.`id_depen` = `destina_depen`.`id_depen`)
                        WHERE `radi_respon`.`respon` = 1 AND `radi`.`transferido` = 0 AND " . $TipoFuncionario . " = :id_oficina";

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->bindParam(":id_oficina", $IdOfi, PDO::PARAM_INT);
                    $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
                } elseif ($Accion == 5) {
                    /******************************************************************************************/
                    /*  FILTRO TODA LA CORRESPONDENCIA ENVIADA DEL PROPIETARIO PRINCIPAL DE LA INSTITUCION
                /******************************************************************************************/

                    $Sql = "SELECT `radi`.`id_radica`
                        FROM `archivo_radica_interna` AS `radi`
                            INNER JOIN `gene_funcionarios_deta` AS `fun_regis` ON (`radi`.`id_funcio_regis` = `fun_regis`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio_regis` ON (`fun_regis`.`id_funcio` = `funcio_regis`.`id_funcio`)
                            LEFT JOIN `areas_oficinas` AS `funcio_ofi` ON (`fun_regis`.`id_oficina` = `funcio_ofi`.`id_oficina`)
                            LEFT JOIN `areas_dependencias` AS `funcio_depen` ON (`funcio_ofi`.`id_depen` = `funcio_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_interna_responsa` AS `radi_respon` ON (`radi_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `respon_deta` ON (`radi_respon`.`id_funcio` = `respon_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `respon` ON (`respon_deta`.`id_funcio` = `respon`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `respon_ofici` ON (`respon_deta`.`id_oficina` = `respon_ofici`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `respon_depen` ON (`respon_ofici`.`id_depen` = `respon_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_interna_destinata` AS `radi_destina` ON (`radi_destina`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `destina_deta` ON (`radi_destina`.`id_funcio_deta` = `destina_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `destina` ON (`destina_deta`.`id_funcio` = `destina`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `destina_ofi` ON (`destina_deta`.`id_oficina` = `destina_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `destina_depen` ON (`destina_ofi`.`id_depen` = `destina_depen`.`id_depen`)
                        WHERE `radi_respon`.`respon` = 1 AND `radi`.`transferido` = 0 " . self::Generar_Query_Correspondencia($Criterio3);

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
                } elseif ($Accion == 6) {
                    /******************************************************************************************/
                    /*  FILTRO LA CORRESPONDENCIA EXTERNA DE UN FUNCIONARIO
                /******************************************************************************************/
                    if ($TipoCorrespondencia == "Destinatario") {
                        $TipoFuncionario = "`radi_destina`.`id_funcio_deta`";
                    } else {
                        $TipoFuncionario = "`radi_respon`.`id_funcio`";
                    }

                    $Sql = "SELECT `radi`.`id_radica`
                        FROM `archivo_radica_interna` AS `radi`
                            INNER JOIN `gene_funcionarios_deta` AS `fun_regis` ON (`radi`.`id_funcio_regis` = `fun_regis`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio_regis` ON (`fun_regis`.`id_funcio` = `funcio_regis`.`id_funcio`)
                            LEFT JOIN `areas_oficinas` AS `funcio_ofi` ON (`fun_regis`.`id_oficina` = `funcio_ofi`.`id_oficina`)
                            LEFT JOIN `areas_dependencias` AS `funcio_depen` ON (`funcio_ofi`.`id_depen` = `funcio_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_interna_responsa` AS `radi_respon` ON (`radi_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `respon_deta` ON (`radi_respon`.`id_funcio` = `respon_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `respon` ON (`respon_deta`.`id_funcio` = `respon`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `respon_ofici` ON (`respon_deta`.`id_oficina` = `respon_ofici`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `respon_depen` ON (`respon_ofici`.`id_depen` = `respon_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_interna_destinata` AS `radi_destina` ON (`radi_destina`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `destina_deta` ON (`radi_destina`.`id_funcio_deta` = `destina_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `destina` ON (`destina_deta`.`id_funcio` = `destina`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `destina_ofi` ON (`destina_deta`.`id_oficina` = `destina_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `destina_depen` ON (`destina_ofi`.`id_depen` = `destina_depen`.`id_depen`)
                        WHERE `radi_respon`.`respon` = 1 AND `radi`.`transferido` = 0 AND " . $TipoFuncionario . " = ?
                            " . self::Generar_Query_Correspondencia($Criterio3);

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->execute(array($IdFuncioDeta))
                        or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
                } elseif ($Accion == 7) {
                    /******************************************************************************************/
                    /*  FILTRO LA CORRESPONDENCIA EXTERNA DE UN FUNCIONARIO JEFE DE DEPENDENCIA
                /******************************************************************************************/
                    if ($TipoCorrespondencia == "Destinatario") {
                        $TipoFuncionario = "`destina_ofi`.`id_depen`";
                    } else {
                        $TipoFuncionario = "`respon_depen`.`id_depen`";
                    }

                    $Sql = "SELECT `radi`.`id_radica`
                        FROM `archivo_radica_interna` AS `radi`
                            INNER JOIN `gene_funcionarios_deta` AS `fun_regis` ON (`radi`.`id_funcio_regis` = `fun_regis`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio_regis` ON (`fun_regis`.`id_funcio` = `funcio_regis`.`id_funcio`)
                            LEFT JOIN `areas_oficinas` AS `funcio_ofi` ON (`fun_regis`.`id_oficina` = `funcio_ofi`.`id_oficina`)
                            LEFT JOIN `areas_dependencias` AS `funcio_depen` ON (`funcio_ofi`.`id_depen` = `funcio_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_interna_responsa` AS `radi_respon` ON (`radi_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `respon_deta` ON (`radi_respon`.`id_funcio` = `respon_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `respon` ON (`respon_deta`.`id_funcio` = `respon`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `respon_ofici` ON (`respon_deta`.`id_oficina` = `respon_ofici`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `respon_depen` ON (`respon_ofici`.`id_depen` = `respon_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_interna_destinata` AS `radi_destina` ON (`radi_destina`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `destina_deta` ON (`radi_destina`.`id_funcio_deta` = `destina_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `destina` ON (`destina_deta`.`id_funcio` = `destina`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `destina_ofi` ON (`destina_deta`.`id_oficina` = `destina_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `destina_depen` ON (`destina_ofi`.`id_depen` = `destina_depen`.`id_depen`)
                        WHERE (`radi_respon`.`respon` = 1 AND `radi`.`transferido` = 0 AND " . $TipoFuncionario . " = ? " . self::Generar_Query_Correspondencia($Criterio3) . ")";

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->execute(array($IdDepen))
                        or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
                } elseif ($Accion == 8) {
                    /******************************************************************************************/
                    /*  FILTRO LA CORRESPONDENCIA EXTERNA DE UN FUNCIONARIO JEFE DE OFICINA
                /******************************************************************************************/
                    if ($TipoCorrespondencia == "Destinatario") {
                        $TipoFuncionario = "`destina_deta`.`id_oficina`";
                    } else {
                        $TipoFuncionario = "`respon_ofici`.`id_oficina`";
                    }

                    $Sql = "SELECT `radi`.`id_radica`
                        FROM `archivo_radica_interna` AS `radi`
                            INNER JOIN `gene_funcionarios_deta` AS `fun_regis` ON (`radi`.`id_funcio_regis` = `fun_regis`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `funcio_regis` ON (`fun_regis`.`id_funcio` = `funcio_regis`.`id_funcio`)
                            LEFT JOIN `areas_oficinas` AS `funcio_ofi` ON (`fun_regis`.`id_oficina` = `funcio_ofi`.`id_oficina`)
                            LEFT JOIN `areas_dependencias` AS `funcio_depen` ON (`funcio_ofi`.`id_depen` = `funcio_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_interna_responsa` AS `radi_respon` ON (`radi_respon`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `respon_deta` ON (`radi_respon`.`id_funcio` = `respon_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `respon` ON (`respon_deta`.`id_funcio` = `respon`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `respon_ofici` ON (`respon_deta`.`id_oficina` = `respon_ofici`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `respon_depen` ON (`respon_ofici`.`id_depen` = `respon_depen`.`id_depen`)
                            INNER JOIN `archivo_radica_interna_destinata` AS `radi_destina` ON (`radi_destina`.`id_radica` = `radi`.`id_radica`)
                            INNER JOIN `gene_funcionarios_deta` AS `destina_deta` ON (`radi_destina`.`id_funcio_deta` = `destina_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `destina` ON (`destina_deta`.`id_funcio` = `destina`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `destina_ofi` ON (`destina_deta`.`id_oficina` = `destina_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `destina_depen` ON (`destina_ofi`.`id_depen` = `destina_depen`.`id_depen`)
                        WHERE `radi_respon`.`respon` = 1 AND `radi`.`transferido` = 0 AND " . $TipoFuncionario . " = ? AND `respon_ofici`.`id_oficina` = :id_oficina " . self::Generar_Query_Correspondencia($Criterio3);

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->execute(array($IdDepen, $IdOfi))
                        or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
                }

                $Result = $Instruc->rowCount();
                $conexion = null;
                return $Result;
            } catch (PDOException $e) {
                echo 'Ha surgido un error y no se puede ejecutar la consulta Total de registros.' . $e->getMessage();
                exit;
            }
        }

        public static function Buscar($Accion, $IdRadicado, $Funcio, $IdDepen, $IdOfi)
        {
            $conexion = new Conexion();

            try {
                if ($Accion == 1) {
                    $Sql = "SELECT *
                        FROM archivo_radica_interna
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
                        $Result['id_funcio_regis'],
                        $Result['id_ruta'],
                        $Result['fechor_radica'],
                        $Result['fec_docu'],
                        $Result['fec_venci'],
                        $Result['asunto'],
                        $Result['num_folio'],
                        $Result['num_anexos'],
                        $Result['observa_anexos'],
                        $Result['texto'],
                        $Result['adjunto'],
                        $Result['requie_respuesta'],
                        $Result['transferido'],
                        $Result['tipo_documento'],
                        $Result['radica_respuesta'],
                        $Result['impri_rotu'],
                        $Result['origen']
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

            try {
                /* TOTALES DE RADICADOS CON COINSEDENCIAS EN EL RADICADO */
                $SqlTotalIdRadica    = "SELECT COUNT(id_radica) AS 'Total' FROM `archivo_radica_interna` WHERE `transferido` = 0 AND `id_radica` LIKE ?";
                $InstrucTotaIdRadica = $conexion->prepare($SqlTotalIdRadica);
                $InstrucTotaIdRadica->execute(array('%' . $Criterio3 . '%')) or die(print_r($InstrucTotalAsunto->errorInfo() . " - " . $SqlTotalIdRadica, true));
                $ResultTotalIdRadica = $InstrucTotaIdRadica->fetch();
                $TotalIdRadica       = $ResultTotalIdRadica['Total'];

                /* TOTALES DE RADICADOS CON COINSEDENCIAS EN EL ASUNTO */
                $SqlTotalAsunto     = "SELECT COUNT(asunto) AS 'Total' FROM `archivo_radica_interna` WHERE `transferido` = 0 AND `asunto` LIKE ?";
                $InstrucTotalAsunto = $conexion->prepare($SqlTotalAsunto);
                $InstrucTotalAsunto->execute(array('%' . $Criterio3 . '%')) or die(print_r($InstrucTotalAsunto->errorInfo() . " - " . $SqlTotalAsunto, true));
                $ResultTotalAsunto  = $InstrucTotalAsunto->fetch();
                $TotalAsunto        = $ResultTotalAsunto['Total'];

                /* TOTALES DE RADICADOS CON COINSEDENCIAS CON LOS RESPONSABLES */
                $SqlTotalFuncionarios = "SELECT COUNT(`radi_respon`.`id_radica`)  AS `Total`
                                    FROM `archivo_radica_interna_responsa` AS `radi_respon`
                                        INNER JOIN `gene_funcionarios_deta` AS `funcio_deta` ON (`radi_respon`.`id_funcio` = `funcio_deta`.`id_funcio_deta`)
                                        INNER JOIN `archivo_radica_interna` AS `radi` ON (`radi_respon`.`id_radica` = `radi`.`id_radica`)
                                        INNER JOIN `gene_funcionarios` AS `funcio` ON (`funcio_deta`.`id_funcio` = `funcio`.`id_funcio`)
                                    WHERE (`radi`.`transferido` = 0 AND `radi_respon`.`respon` = 1 AND CONCAT(TRIM(`funcio`.`nom_funcio`), ' ', TRIM(`funcio`.`ape_funcio`)) LIKE ?)";
                $InstrucTotalFuncionarios = $conexion->prepare($SqlTotalFuncionarios);
                $InstrucTotalFuncionarios->execute(array('%' . $Criterio3 . '%')) or die(print_r($InstrucTotalAsunto->errorInfo() . " - " . $SqlTotalAsunto, true));
                $ResultTotalFuncionarios = $InstrucTotalFuncionarios->fetch();
                $TotalFuncionarios = $ResultTotalFuncionarios['Total'];

                /* TOTALES DE RADICADOS CON COINSEDENCIAS CON LOS DETINATARIOS */
                $SqlTotalDestina = "SELECT COUNT(`radi`.`id_radica`) AS `Total`
                                FROM `archivo_radica_interna_destinata` AS `radi_desti`
                                    INNER JOIN `archivo_radica_interna` AS `radi` ON (`radi_desti`.`id_radica` = `radi`.`id_radica`)
                                    INNER JOIN `gene_funcionarios_deta` AS `desti_deta` ON (`radi_desti`.`id_funcio_deta` = `desti_deta`.`id_funcio_deta`)
                                    INNER JOIN `gene_funcionarios` AS `desti` ON (`desti_deta`.`id_funcio` = `desti`.`id_funcio`)
                                WHERE (`radi`.`transferido` = 0 AND CONCAT(TRIM(`desti`.`nom_funcio`), ' ', TRIM(`desti`.`ape_funcio`)) LIKE ?)";
                $InstrucTotalDestina = $conexion->prepare($SqlTotalDestina);
                $InstrucTotalDestina->execute(array('%' . $Criterio3 . '%')) or die(print_r($SqlTotalContacto->errorInfo() . " - " . $SqlTotalContacto, true));
                $ResultTotalDestina = $InstrucTotalDestina->fetch();
                $TotalDestina = $ResultTotalDestina['Total'];

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
                        $Query .= " OR CONCAT(TRIM(`respon`.`nom_funcio`), ' ', TRIM(`respon`.`ape_funcio`)) LIKE '%" . $Criterio3 . "%'";
                    } else {
                        $Query .= " AND CONCAT(TRIM(`respon`.`nom_funcio`), ' ', TRIM(`respon`.`ape_funcio`)) LIKE '%" . $Criterio3 . "%'";
                    }
                }

                if ($TotalDestina > 0) {
                    if ($Query != "") {
                        $Query .= " OR CONCAT(TRIM(`destina`.`nom_funcio`), ' ', TRIM(`destina`.`ape_funcio`)) LIKE '%" . $Criterio3 . "%'";
                    } else {
                        $Query .= " AND CONCAT(TRIM(`destina`.`nom_funcio`), ' ', TRIM(`destina`.`ape_funcio`)) LIKE '%" . $Criterio3 . "%'";
                    }
                }

                return $Query;
            } catch (PDOException $e) {
                echo 'Ha surgido un error y no se puede ejecutar la consulta Contruir Query.' . $e->getMessage();
                exit;
            }
        }
    }
    ?>