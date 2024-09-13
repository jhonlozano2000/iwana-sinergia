 <?php
    class RadicadoInternoListarBandeja
    {
        private $Accion;
        private $IdFuncioSesion;
        private $Buscar;
        private $IdRadica;
        private $Asunto;
        private $QueContenga;
        private $IdDepen;
        private $IdOfi;
        private $Limite1;
        private $Limite2;
        private $OrigenCorrespondencia;
        private $Criterio1;

        public function __construct(
            $Accion = null,
            $IdFuncioSesion = null,
            $Buscar = null,
            $IdRadica = null,
            $Asunto = null,
            $QueContenga = null,
            $IdDepen = null,
            $IdOfi = null,
            $Limite1 = null,
            $Limite2 = null,
            $OrigenCorrespondencia = null,
            $Criterio1 = null
        ) {

            $this->Accion         = $Accion;
            $this->IdFuncioSesion = $IdFuncioSesion;
            $this->Buscar         = $Buscar;
            $this->IdRadica       = $IdRadica;
            $this->Asunto         = $Asunto;
            $this->QueContenga    = $QueContenga;
            $this->IdDepen        = $IdDepen;
            $this->IdOfi          = $IdOfi;
            $this->Limite1        = $Limite1;
            $this->Limite2        = $Limite2;
            $this->OrigenCorrespondencia = $OrigenCorrespondencia;
            $this->Criterio1      = $Criterio1;
        }

        public function get_Accion()
        {
            return $this->Accion;
        }

        public function get_IdFuncioSesion()
        {
            return $this->IdFuncioSesion;
        }

        public function get_Buscar()
        {
            return $this->Buscar;
        }

        public function get_IdRadica()
        {
            return $this->IdRadica;
        }

        public function get_Asunto()
        {
            return $this->Asunto;
        }

        public function get_QueContenga()
        {
            return $this->QueContenga;
        }

        public function get_IdDepen()
        {
            return $this->IdDepen;
        }

        public function get_IdOfi()
        {
            return $this->IdOfi;
        }

        public function get_Limite1()
        {
            return $this->Limite1;
        }

        public function get_Limite2()
        {
            return $this->Limite2;
        }

        public function set_Accion($Accion)
        {
            $this->Accion = $Accion;
        }

        public function set_IdFuncioSesion($IdFuncioSesion)
        {
            $this->IdFuncioSesion = $IdFuncioSesion;
        }

        public function set_Buscar($Buscar)
        {
            $this->Buscar = $Buscar;
        }

        public function set_IdRadica($IdRadica)
        {
            $this->IdRadica = $IdRadica;
        }

        public function set_Asunto($Asunto)
        {
            $this->Asunto = $Asunto;
        }

        public function set_QueContenga($QueContenga)
        {
            $this->QueContenga = $QueContenga;
        }

        public function set_IdDepen($IdDepen)
        {
            $this->IdDepen = $IdDepen;
        }

        public function set_IdOfi($IdOfi)
        {
            $this->IdOfi = $IdOfi;
        }

        public function set_Limite1($Limite1)
        {
            $this->Limite1 = $Limite1;
        }

        public function set_Limite2($Limite2)
        {
            $this->Limite2 = $Limite2;
        }

        public function set_OrigenCorrespondencia($OrigenCorrespondencia)
        {
            $this->OrigenCorrespondencia = $OrigenCorrespondencia;
        }

        public function Listar()
        {
            $conexion = new Conexion();
            $TipoFuncionario = "";

            if ($this->OrigenCorrespondencia == "ENVIADA") {
                $TipoFuncionario = "`radi_respon`.`id_funcio`";
            } elseif ($this->OrigenCorrespondencia == "RECIBIDA") {
                $TipoFuncionario = "`radi_destina`.`id_funcio_deta`";
            }

            try {
                if ($this->Accion == 1) {
                    /********************************************************************************************************************************/
                    /*  LISTO TODA LA CORRESPONDENCIA INTERNA ENVIADA DEL PROPIETARIO PRINCIPAL DE LA INSTITUCION
                /********************************************************************************************************************************/
                    $Sql = "SELECT `radi`.`id_radica`, `radi`.`adjunto`, `radi`.`fechor_radica`, `radi`.`fec_venci`, `radi`.`asunto`,
                            `radi`.`texto`, `funcio_regis`.`nom_funcio` AS `nom_funcio_radi`, `funcio_regis`.`ape_funcio` AS `ape_funcio_radi`,
                            `funcio_depen`.`nom_depen` AS `nom_depen_regis`, `funcio_ofi`.`nom_oficina` AS `nom_oficina_regis`,
                            `respon`.`nom_funcio` AS `nom_funcio_respon`, `respon`.`ape_funcio` AS `ape_funcio_respon`,
                            `respon_depen`.`nom_depen` AS `nom_depen_respon`, `respon_ofici`.`nom_oficina` AS `nom_oficina_respon`,
                            `destina`.`nom_funcio` AS `nom_funcio_destina`, `destina`.`ape_funcio` AS `ape_funcio_destina`,
                            `destina_depen`.`nom_depen` AS `nom_depen_destina`, `destina_ofi`.`nom_oficina` AS `nom_oficina_destina`,
                            `radi_destina`.`leido`, `radi_destina`.`fechor_leido`, `radi_destina`.`cc`, `radi_destina`.`id_funcio_deta`,
                            `radi_destina`.`leido`, `radi`.`transferido`, `radi`.`requie_respuesta`, `funcio_regis`.`nom_funcio` AS 'nom_funcio_regis',
                             `funcio_regis`.`nom_funcio` AS 'ape_funcio_regis', `radi`.`impri_rotu`, `radi`.`radica_respuesta`, `radi`.`nombre_archivo`
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
                            INNER JOIN `gene_funcionarios_deta` AS `destina_deta` ON (`radi_respon`.`id_funcio` = `destina_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `destina` ON (`respon_deta`.`id_funcio` = `destina`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `destina_ofi` ON (`respon_deta`.`id_oficina` = `destina_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `destina_depen` ON (`respon_ofici`.`id_depen` = `destina_depen`.`id_depen`)
                        WHERE `radi_respon`.`respon` = 1 AND `radi`.`transferido` = 0
                        ORDER BY `radi`.`fechor_radica` DESC
                        LIMIT :Limite1, :Limite2";

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->bindParam(":Limite1", $this->Limite1, PDO::PARAM_INT);
                    $Instruc->bindParam(":Limite2", $this->Limite2, PDO::PARAM_INT);
                    $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
                } elseif ($this->Accion == 2) {
                    /********************************************************************************************************************************/
                    /*  LISTO LOS RADICADOS ENVIADOS DE UN FUNCIONARIO
                    /********************************************************************************************************************************/
                    $Sql = "SELECT `radi`.`id_radica`, `radi`.`adjunto`, `radi`.`fechor_radica`, `radi`.`fec_venci`, `radi`.`asunto`,
                            `radi`.`texto`, `funcio_regis`.`nom_funcio` AS `nom_funcio_radi`, `funcio_regis`.`ape_funcio` AS `ape_funcio_radi`,
                            `funcio_depen`.`nom_depen` AS `nom_depen_regis`, `funcio_ofi`.`nom_oficina` AS `nom_oficina_regis`,
                            `respon`.`nom_funcio` AS `nom_funcio_respon`, `respon`.`ape_funcio` AS `ape_funcio_respon`,
                            `respon_depen`.`nom_depen` AS `nom_depen_respon`, `respon_ofici`.`nom_oficina` AS `nom_oficina_respon`,
                            `destina`.`nom_funcio` AS `nom_funcio_destina`, `destina`.`ape_funcio` AS `ape_funcio_destina`,
                            `destina_depen`.`nom_depen` AS `nom_depen_destina`, `destina_ofi`.`nom_oficina` AS `nom_oficina_destina`,
                            `radi_destina`.`leido`, `radi_destina`.`fechor_leido`, `radi_destina`.`cc`, `radi_destina`.`id_funcio_deta`,
                            `radi_destina`.`leido`, `radi`.`transferido`, `radi`.`requie_respuesta`, `funcio_regis`.`nom_funcio` AS 'nom_funcio_regis',
                             `funcio_regis`.`nom_funcio` AS 'ape_funcio_regis', `radi`.`impri_rotu`, `radi`.`radica_respuesta`, `radi`.`nombre_archivo`
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
                            INNER JOIN `gene_funcionarios_deta` AS `destina_deta` ON (`radi_respon`.`id_funcio` = `destina_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `destina` ON (`respon_deta`.`id_funcio` = `destina`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `destina_ofi` ON (`respon_deta`.`id_oficina` = `destina_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `destina_depen` ON (`respon_ofici`.`id_depen` = `destina_depen`.`id_depen`)
                        WHERE (`radi_respon`.`respon` = 1 AND `radi`.`transferido` = 0 AND " . $TipoFuncionario . " = :id_funcio)
                        ORDER BY `radi`.`fechor_radica` DESC
                        LIMIT :Limite1, :Limite2";

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->bindParam(":id_funcio", $this->IdFuncioSesion, PDO::PARAM_INT);
                    $Instruc->bindParam(":Limite1", $this->Limite1, PDO::PARAM_INT);
                    $Instruc->bindParam(":Limite2", $this->Limite2, PDO::PARAM_INT);
                    $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
                } elseif ($this->Accion == 3) {
                    /********************************************************************************************************************************/
                    /*  LISTO LA CORRESPONDENCIA INTERNA DE UN FUNCIONARIO JEFE DE DEPENDENCIA
                /********************************************************************************************************************************/
                    $Sql = "SELECT `radi`.`id_radica`, `radi`.`adjunto`, `radi`.`fechor_radica`, `radi`.`fec_venci`, `radi`.`asunto`,
                            `radi`.`texto`, `funcio_regis`.`nom_funcio` AS `nom_funcio_radi`, `funcio_regis`.`ape_funcio` AS `ape_funcio_radi`,
                            `funcio_depen`.`nom_depen` AS `nom_depen_regis`, `funcio_ofi`.`nom_oficina` AS `nom_oficina_regis`,
                            `respon`.`nom_funcio` AS `nom_funcio_respon`, `respon`.`ape_funcio` AS `ape_funcio_respon`,
                            `respon_depen`.`nom_depen` AS `nom_depen_respon`, `respon_ofici`.`nom_oficina` AS `nom_oficina_respon`,
                            `destina`.`nom_funcio` AS `nom_funcio_destina`, `destina`.`ape_funcio` AS `ape_funcio_destina`,
                            `destina_depen`.`nom_depen` AS `nom_depen_destina`, `destina_ofi`.`nom_oficina` AS `nom_oficina_destina`,
                            `radi_destina`.`leido`, `radi_destina`.`fechor_leido`, `radi_destina`.`cc`, `radi_destina`.`id_funcio_deta`,
                            `radi_destina`.`leido`, `radi`.`transferido`, `radi`.`requie_respuesta`, `funcio_regis`.`nom_funcio` AS 'nom_funcio_regis',
                             `funcio_regis`.`nom_funcio` AS 'ape_funcio_regis', `radi`.`impri_rotu`, `radi`.`radica_respuesta`, `radi`.`nombre_archivo`
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
                            INNER JOIN `gene_funcionarios_deta` AS `destina_deta` ON (`radi_respon`.`id_funcio` = `destina_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `destina` ON (`respon_deta`.`id_funcio` = `destina`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `destina_ofi` ON (`respon_deta`.`id_oficina` = `destina_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `destina_depen` ON (`respon_ofici`.`id_depen` = `destina_depen`.`id_depen`)
                        WHERE (`radi_respon`.`respon` = 1 AND `radi`.`transferido` = 0 AND `respon_depen`.`id_depen` = :id_depen)
                        ORDER BY `radi`.`fechor_radica` DESC
                        LIMIT :Limite1, :Limite2";

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->bindParam(":id_depen", $this->IdDepen, PDO::PARAM_INT);
                    $Instruc->bindParam(":Limite1", $this->Limite1, PDO::PARAM_INT);
                    $Instruc->bindParam(":Limite2", $this->Limite2, PDO::PARAM_INT);
                    $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
                } elseif ($this->Accion == 4) {
                    /********************************************************************************************************************************/
                    /*  LISTO LA CORRESPONDENCIA INTERNA DE UN FUNCIONARIO JEFE DE OFICINA
                /********************************************************************************************************************************/
                    $Sql = "SELECT `radi`.`id_radica`, `radi`.`adjunto`, `radi`.`fechor_radica`, `radi`.`fec_venci`, `radi`.`asunto`,
                            `radi`.`texto`, `funcio_regis`.`nom_funcio` AS `nom_funcio_radi`, `funcio_regis`.`ape_funcio` AS `ape_funcio_radi`,
                            `funcio_depen`.`nom_depen` AS `nom_depen_regis`, `funcio_ofi`.`nom_oficina` AS `nom_oficina_regis`,
                            `respon`.`nom_funcio` AS `nom_funcio_respon`, `respon`.`ape_funcio` AS `ape_funcio_respon`,
                            `respon_depen`.`nom_depen` AS `nom_depen_respon`, `respon_ofici`.`nom_oficina` AS `nom_oficina_respon`,
                            `destina`.`nom_funcio` AS `nom_funcio_destina`, `destina`.`ape_funcio` AS `ape_funcio_destina`,
                            `destina_depen`.`nom_depen` AS `nom_depen_destina`, `destina_ofi`.`nom_oficina` AS `nom_oficina_destina`,
                            `radi_destina`.`leido`, `radi_destina`.`fechor_leido`, `radi_destina`.`cc`, `radi_destina`.`id_funcio_deta`,
                            `radi_destina`.`leido`, `radi`.`transferido`, `radi`.`requie_respuesta`, `funcio_regis`.`nom_funcio` AS 'nom_funcio_regis',
                             `funcio_regis`.`nom_funcio` AS 'ape_funcio_regis', `radi`.`impri_rotu`, `radi`.`radica_respuesta`, `radi`.`nombre_archivo`
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
                            INNER JOIN `gene_funcionarios_deta` AS `destina_deta` ON (`radi_respon`.`id_funcio` = `destina_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `destina` ON (`respon_deta`.`id_funcio` = `destina`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `destina_ofi` ON (`respon_deta`.`id_oficina` = `destina_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `destina_depen` ON (`respon_ofici`.`id_depen` = `destina_depen`.`id_depen`)
                        WHERE `radi_respon`.`respon` = 1 AND `radi`.`transferido` = 0 AND `respon_ofici`.`id_oficina` = :id_oficina
                        ORDER BY `radi`.`fechor_radica` DESC
                        LIMIT :Limite1, :Limite2";

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->bindParam(":id_oficina", $this->IdOfi, PDO::PARAM_INT);
                    $Instruc->bindParam(":Limite1", $this->Limite1, PDO::PARAM_INT);
                    $Instruc->bindParam(":Limite2", $this->Limite2, PDO::PARAM_INT);
                    $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
                } elseif ($this->Accion == 5) {
                    /******************************************************************************************/
                    /*  FILTRO TODA LA CORRESPONDENCIA ENVIADA DEL PROPIETARIO PRINCIPAL DE LA INSTITUCION
                    /******************************************************************************************/
                    $Sql = "SELECT `radi`.`id_radica`, `radi`.`adjunto`, `radi`.`fechor_radica`, `radi`.`fec_venci`, `radi`.`asunto`,
                            `radi`.`texto`, `funcio_regis`.`nom_funcio` AS `nom_funcio_radi`, `funcio_regis`.`ape_funcio` AS `ape_funcio_radi`,
                            `funcio_depen`.`nom_depen` AS `nom_depen_regis`, `funcio_ofi`.`nom_oficina` AS `nom_oficina_regis`,
                            `respon`.`nom_funcio` AS `nom_funcio_respon`, `respon`.`ape_funcio` AS `ape_funcio_respon`,
                            `respon_depen`.`nom_depen` AS `nom_depen_respon`, `respon_ofici`.`nom_oficina` AS `nom_oficina_respon`,
                            `destina`.`nom_funcio` AS `nom_funcio_destina`, `destina`.`ape_funcio` AS `ape_funcio_destina`,
                            `destina_depen`.`nom_depen` AS `nom_depen_destina`, `destina_ofi`.`nom_oficina` AS `nom_oficina_destina`,
                            `radi_destina`.`leido`, `radi_destina`.`fechor_leido`, `radi_destina`.`cc`, `radi_destina`.`id_funcio_deta`,
                            `radi_destina`.`leido`, `radi`.`transferido`, `radi`.`requie_respuesta`, `funcio_regis`.`nom_funcio` AS 'nom_funcio_regis',
                             `funcio_regis`.`nom_funcio` AS 'ape_funcio_regis', `radi`.`impri_rotu`, `radi`.`radica_respuesta`, `radi`.`nombre_archivo`
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
                            INNER JOIN `gene_funcionarios_deta` AS `destina_deta` ON (`radi_respon`.`id_funcio` = `destina_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `destina` ON (`respon_deta`.`id_funcio` = `destina`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `destina_ofi` ON (`respon_deta`.`id_oficina` = `destina_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `destina_depen` ON (`respon_ofici`.`id_depen` = `destina_depen`.`id_depen`)
                        WHERE (`radi`.`transferido` = 0 AND `radi_respon`.`respon` = 1)
                        ORDER BY `radi`.`fechor_radica` DESC
                        LIMIT :Limite1, :Limite2";

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->bindParam(":Limite1", $this->Limite1, PDO::PARAM_INT);
                    $Instruc->bindParam(":Limite2", $this->Limite2, PDO::PARAM_INT);
                    $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
                } elseif ($this->Accion == 6) {
                    /******************************************************************************************/
                    /*  FILTRO LA INTERNA EXTERNA DE UN FUNCIONARIO
                /******************************************************************************************/
                    $Sql = "SELECT `radi`.`id_radica`, `radi`.`adjunto`, `radi`.`fechor_radica`, `radi`.`fec_venci`, `radi`.`asunto`,
                            `radi`.`texto`, `funcio_regis`.`nom_funcio` AS `nom_funcio_radi`, `funcio_regis`.`ape_funcio` AS `ape_funcio_radi`,
                            `funcio_depen`.`nom_depen` AS `nom_depen_regis`, `funcio_ofi`.`nom_oficina` AS `nom_oficina_regis`,
                            `respon`.`nom_funcio` AS `nom_funcio_respon`, `respon`.`ape_funcio` AS `ape_funcio_respon`,
                            `respon_depen`.`nom_depen` AS `nom_depen_respon`, `respon_ofici`.`nom_oficina` AS `nom_oficina_respon`,
                            `destina`.`nom_funcio` AS `nom_funcio_destina`, `destina`.`ape_funcio` AS `ape_funcio_destina`,
                            `destina_depen`.`nom_depen` AS `nom_depen_destina`, `destina_ofi`.`nom_oficina` AS `nom_oficina_destina`,
                            `radi_destina`.`leido`, `radi_destina`.`fechor_leido`, `radi_destina`.`cc`, `radi_destina`.`id_funcio_deta`,
                            `radi_destina`.`leido`, `radi`.`transferido`, `radi`.`requie_respuesta`, `funcio_regis`.`nom_funcio` AS 'nom_funcio_regis',
                             `funcio_regis`.`nom_funcio` AS 'ape_funcio_regis', `radi`.`impri_rotu`, `radi`.`radica_respuesta`, `radi`.`nombre_archivo`
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
                            INNER JOIN `gene_funcionarios_deta` AS `destina_deta` ON (`radi_respon`.`id_funcio` = `destina_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `destina` ON (`respon_deta`.`id_funcio` = `destina`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `destina_ofi` ON (`respon_deta`.`id_oficina` = `destina_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `destina_depen` ON (`respon_ofici`.`id_depen` = `destina_depen`.`id_depen`)
                        WHERE (`radi`.`transferido` = 0 AND `radi_respon`.`respon` = 1 AND " . $TipoFuncionario . " = id_funcio_deta
                            " . self::Generar_Query_Correspondencia($this->Buscar, "", "", "", "", "", "", "") . ")
                        ORDER BY `radi`.`fechor_radica` DESC
                        LIMIT :Limite1, :Limite2";

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->bindParam(":id_funcio_deta", $this->IdFuncioSesion, PDO::PARAM_INT);
                    $Instruc->bindParam(":Limite1", $this->Limite1, PDO::PARAM_INT);
                    $Instruc->bindParam(":Limite2", $this->Limite2, PDO::PARAM_INT);
                    $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
                } elseif ($this->Accion == 7) {
                    /******************************************************************************************/
                    /*  FILTRO LA CORRESPONDENCIA EXTERNA DE UN FUNCIONARIO JEFE DE DEPENDENCIA
                /******************************************************************************************/
                    $Sql = "SELECT `radi`.`id_radica`, `radi`.`adjunto`, `radi`.`fechor_radica`, `radi`.`fec_venci`, `radi`.`asunto`,
                            `radi`.`texto`, `funcio_regis`.`nom_funcio` AS `nom_funcio_radi`, `funcio_regis`.`ape_funcio` AS `ape_funcio_radi`,
                            `funcio_depen`.`nom_depen` AS `nom_depen_regis`, `funcio_ofi`.`nom_oficina` AS `nom_oficina_regis`,
                            `respon`.`nom_funcio` AS `nom_funcio_respon`, `respon`.`ape_funcio` AS `ape_funcio_respon`,
                            `respon_depen`.`nom_depen` AS `nom_depen_respon`, `respon_ofici`.`nom_oficina` AS `nom_oficina_respon`,
                            `destina`.`nom_funcio` AS `nom_funcio_destina`, `destina`.`ape_funcio` AS `ape_funcio_destina`,
                            `destina_depen`.`nom_depen` AS `nom_depen_destina`, `destina_ofi`.`nom_oficina` AS `nom_oficina_destina`,
                            `radi_destina`.`leido`, `radi_destina`.`fechor_leido`, `radi_destina`.`cc`, `radi_destina`.`id_funcio_deta`,
                            `radi_destina`.`leido`, `radi`.`transferido`, `radi`.`requie_respuesta`, `funcio_regis`.`nom_funcio` AS 'nom_funcio_regis',
                             `funcio_regis`.`nom_funcio` AS 'ape_funcio_regis', `radi`.`impri_rotu`, `radi`.`radica_respuesta`, `radi`.`nombre_archivo`
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
                            INNER JOIN `gene_funcionarios_deta` AS `destina_deta` ON (`radi_respon`.`id_funcio` = `destina_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `destina` ON (`respon_deta`.`id_funcio` = `destina`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `destina_ofi` ON (`respon_deta`.`id_oficina` = `destina_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `destina_depen` ON (`respon_ofici`.`id_depen` = `destina_depen`.`id_depen`)
                        WHERE (`radi_respon`.`respon` = 1 AND `radi`.`transferido` = 0 AND " . $TipoFuncionario . " = ? " . self::Generar_Query_Correspondencia($this->Buscar, "", "", "", "", "", "", "") . ")
                        ORDER BY `radi`.`fechor_radica` DESC
                        LIMIT :Limite1, :Limite2";

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->bindParam(":Limite1", $this->Limite1, PDO::PARAM_INT);
                    $Instruc->bindParam(":Limite2", $this->Limite2, PDO::PARAM_INT);
                    $Instruc->execute(array($this->IdDepen)) or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
                } elseif ($this->Accion == 8) {
                    /******************************************************************************************/
                    /*  FILTRO LA CORRESPONDENCIA EXTERNA DE UN FUNCIONARIO JEFE DE OFICINA
                /******************************************************************************************/
                    $Sql = "SELECT `radi`.`id_radica`, `radi`.`adjunto`, `radi`.`fechor_radica`, `radi`.`fec_venci`, `radi`.`asunto`,
                            `radi`.`texto`, `funcio_regis`.`nom_funcio` AS `nom_funcio_radi`, `funcio_regis`.`ape_funcio` AS `ape_funcio_radi`,
                            `funcio_depen`.`nom_depen` AS `nom_depen_regis`, `funcio_ofi`.`nom_oficina` AS `nom_oficina_regis`,
                            `respon`.`nom_funcio` AS `nom_funcio_respon`, `respon`.`ape_funcio` AS `ape_funcio_respon`,
                            `respon_depen`.`nom_depen` AS `nom_depen_respon`, `respon_ofici`.`nom_oficina` AS `nom_oficina_respon`,
                            `destina`.`nom_funcio` AS `nom_funcio_destina`, `destina`.`ape_funcio` AS `ape_funcio_destina`,
                            `destina_depen`.`nom_depen` AS `nom_depen_destina`, `destina_ofi`.`nom_oficina` AS `nom_oficina_destina`,
                            `radi_destina`.`leido`, `radi_destina`.`fechor_leido`, `radi_destina`.`cc`, `radi_destina`.`id_funcio_deta`,
                            `radi_destina`.`leido`, `radi`.`transferido`, `radi`.`requie_respuesta`, `funcio_regis`.`nom_funcio` AS 'nom_funcio_regis',
                             `funcio_regis`.`nom_funcio` AS 'ape_funcio_regis', `radi`.`impri_rotu`, `radi`.`radica_respuesta`, `radi`.`nombre_archivo`
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
                            INNER JOIN `gene_funcionarios_deta` AS `destina_deta` ON (`radi_respon`.`id_funcio` = `destina_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `destina` ON (`respon_deta`.`id_funcio` = `destina`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `destina_ofi` ON (`respon_deta`.`id_oficina` = `destina_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `destina_depen` ON (`respon_ofici`.`id_depen` = `destina_depen`.`id_depen`)
                        WHERE `radi_respon`.`respon` = 1 AND `radi`.`transferido` = 0 AND `respon_depen`.`id_depen` = :id_depen AND `respon_ofici`.`id_oficina` = :id_oficina " . self::Generar_Query_Correspondencia($this->Buscar, "", "", "", "", "", "", "") . "
                        ORDER BY `radi`.`fechor_radica` DESC
                        LIMIT :Limite1, :Limite2";

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->bindParam(":id_depen", $this->IdDepen, PDO::PARAM_INT);
                    $Instruc->bindParam(":id_oficina", $this->IdOfi, PDO::PARAM_INT);
                    $Instruc->bindParam(":Limite1", $this->Limite1, PDO::PARAM_INT);
                    $Instruc->bindParam(":Limite2", $this->Limite2, PDO::PARAM_INT);
                    $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
                }

                $Result = $Instruc->fetchAll();
                $conexion = null;
                return $Result;
            } catch (PDOException $e) {
                echo 'Ha surgido un error y no se puede ejecutar la instrucción, Correspondencia Interna Recibida -> Accion: ' . $this->Accion . ". " . $e->getMessage();
                exit;
            }
        }

        public function TotalRegistros_Listar()
        {
            $conexion = new Conexion();

            $TipoFuncionario = "";

            if ($this->OrigenCorrespondencia == "ENVIADA") {
                $TipoFuncionario = "`radi_respon`.`id_funcio`";
            } elseif ($this->OrigenCorrespondencia == "RECIBIDA") {
                $TipoFuncionario = "`radi_destina`.`id_funcio_deta`";
            }

            try {
                if ($this->Accion == 1) {
                    /********************************************************************************************************************************/
                    /*  LISTO TODA LA CORRESPONDENCIA INTERNA DEL PROPIETARIO PRINCIPAL DE LA INSTITUCION
                /********************************************************************************************************************************/
                    $Sql = "SELECT `radi`.`id_radica` as 'Total'
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
                            INNER JOIN `gene_funcionarios_deta` AS `destina_deta` ON (`radi_respon`.`id_funcio` = `destina_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `destina` ON (`respon_deta`.`id_funcio` = `destina`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `destina_ofi` ON (`respon_deta`.`id_oficina` = `destina_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `destina_depen` ON (`respon_ofici`.`id_depen` = `destina_depen`.`id_depen`)
                        WHERE `radi_respon`.`respon` = 1 AND `radi`.`transferido` = 0";

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
                } elseif ($this->Accion == 2) {
                    /********************************************************************************************************************************/
                    /*  LISTO LOS RADICADOS ENVIADOS DE UN FUNCIONARIO
                /********************************************************************************************************************************/
                    $Sql = "SELECT `radi`.`id_radica` as 'Total'
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
                            INNER JOIN `gene_funcionarios_deta` AS `destina_deta` ON (`radi_respon`.`id_funcio` = `destina_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `destina` ON (`respon_deta`.`id_funcio` = `destina`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `destina_ofi` ON (`respon_deta`.`id_oficina` = `destina_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `destina_depen` ON (`respon_ofici`.`id_depen` = `destina_depen`.`id_depen`)
                        WHERE (`radi_respon`.`respon` = 1 AND `radi`.`transferido` = 0 AND " . $TipoFuncionario . " = :id_funcio)";

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->bindParam(":id_funcio", $this->IdFuncioSesion, PDO::PARAM_INT);
                    $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
                } elseif ($this->Accion == 3) {
                    /********************************************************************************************************************************/
                    /*  LISTO LA CORRESPONDENCIA INTERNA DE UN FUNCIONARIO JEFE DE DEPENDENCIA
                /********************************************************************************************************************************/
                    $Sql = "SELECT `radi`.`id_radica` as 'Total'
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
                            INNER JOIN `gene_funcionarios_deta` AS `destina_deta` ON (`radi_respon`.`id_funcio` = `destina_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `destina` ON (`respon_deta`.`id_funcio` = `destina`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `destina_ofi` ON (`respon_deta`.`id_oficina` = `destina_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `destina_depen` ON (`respon_ofici`.`id_depen` = `destina_depen`.`id_depen`)
                        WHERE `radi_respon`.`respon` = 1 AND `radi`.`transferido` = 0 AND " . $TipoFuncionario . " = :id_depen";

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->bindParam(":id_depen", $this->IdDepen, PDO::PARAM_INT);
                    $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
                } elseif ($this->Accion == 4) {
                    /********************************************************************************************************************************/
                    /*  LISTO LA CORRESPONDENCIA INTERNA DE UN FUNCIONARIO JEFE DE OFICINA
                /********************************************************************************************************************************/
                    $Sql = "SELECT `radi`.`id_radica` as 'Total'
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
                            INNER JOIN `gene_funcionarios_deta` AS `destina_deta` ON (`radi_respon`.`id_funcio` = `destina_deta`.`id_funcio_deta`)
                            INNER JOIN `gene_funcionarios` AS `destina` ON (`respon_deta`.`id_funcio` = `destina`.`id_funcio`)
                            INNER JOIN `areas_oficinas` AS `destina_ofi` ON (`respon_deta`.`id_oficina` = `destina_ofi`.`id_oficina`)
                            INNER JOIN `areas_dependencias` AS `destina_depen` ON (`respon_ofici`.`id_depen` = `destina_depen`.`id_depen`)
                        WHERE `radi_respon`.`respon` = 1 AND `radi`.`transferido` = 0 AND " . $TipoFuncionario . " = :id_oficina";

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->bindParam(":id_oficina", $this->IdOfi, PDO::PARAM_INT);
                    $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
                }

                $Result = $Instruc->rowCount();
                $conexion = null;
                return $Result;
            } catch (PDOException $e) {
                echo 'Ha surgido un error y no se puede ejecutar la consulta Total de registros.' . $e->getMessage();
                exit;
            }
        }

        public function Filtro()
        {
            $conexion = new Conexion();
            $TipoFuncionario = "";

            if ($this->OrigenCorrespondencia == "ENVIADA") {
                $TipoFuncionario = "`radi_respon`.`id_funcio`";
            } elseif ($this->OrigenCorrespondencia == "RECIBIDA") {
                $TipoFuncionario = "`radi_destina`.`id_funcio_deta`";
            }

            try {
                if ($this->Accion == 5) {
                    /******************************************************************************************/
                    /*  FILTRO TODA LA CORRESPONDENCIA INTERNA DEL PROPIETARIO PRINCIPAL DE LA INSTITUCION
                /******************************************************************************************/
                    $Sql = "SELECT `radi`.`id_radica`, `radi`.`adjunto`, `radi`.`fechor_radica`, `radi`.`fec_venci`, `radi`.`asunto`,
                            `radi`.`texto`, `funcio_regis`.`nom_funcio` AS `nom_funcio_radi`, `funcio_regis`.`ape_funcio` AS `ape_funcio_radi`,
                            `funcio_depen`.`nom_depen` AS `nom_depen_regis`, `funcio_ofi`.`nom_oficina` AS `nom_oficina_regis`,
                            `respon`.`nom_funcio` AS `nom_funcio_respon`, `respon`.`ape_funcio` AS `ape_funcio_respon`,
                            `respon_depen`.`nom_depen` AS `nom_depen_respon`, `respon_ofici`.`nom_oficina` AS `nom_oficina_respon`,
                            `destina`.`nom_funcio` AS `nom_funcio_destina`, `destina`.`ape_funcio` AS `ape_funcio_destina`,
                            `destina_depen`.`nom_depen` AS `nom_depen_destina`, `destina_ofi`.`nom_oficina` AS `nom_oficina_destina`,
                            `radi_destina`.`leido`, `radi_destina`.`fechor_leido`, `radi_destina`.`cc`, `radi_destina`.`id_funcio_deta`,
                            `radi_destina`.`leido`, `radi`.`transferido`, `radi`.`requie_respuesta`, `funcio_regis`.`nom_funcio` AS 'nom_funcio_regis',
                             `funcio_regis`.`nom_funcio` AS 'ape_funcio_regis', `radi`.`impri_rotu`
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
                        WHERE (`radi`.`transferido` = 0 AND `radi_respon`.`respon` = 1 " . self::Generar_Query_Correspondencia($this->Buscar, $this->IdRadica, $this->IdTercero, $this->IdFuncioDeta, $this->Asunto, $this->QueContenga, $this->IdDepen, $this->IdOfi) . ")
                        LIMIT :Limite1, :Limite2";

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->bindParam(":Limite1", $this->Limite1, PDO::PARAM_INT);
                    $Instruc->bindParam(":Limite2", $this->Limite2, PDO::PARAM_INT);
                    $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
                } elseif ($this->Accion == 6) {

                    /******************************************************************************************/
                    /*  FILTRO LA INTERNA EXTERNA DE UN FUNCIONARIO
                /******************************************************************************************/
                    $Sql = "SELECT `radi`.`id_radica`, `radi`.`adjunto`, `radi`.`fechor_radica`, `radi`.`fec_venci`, `radi`.`asunto`,
                            `radi`.`texto`, `funcio_regis`.`nom_funcio` AS `nom_funcio_radi`, `funcio_regis`.`ape_funcio` AS `ape_funcio_radi`,
                            `funcio_depen`.`nom_depen` AS `nom_depen_regis`, `funcio_ofi`.`nom_oficina` AS `nom_oficina_regis`,
                            `respon`.`nom_funcio` AS `nom_funcio_respon`, `respon`.`ape_funcio` AS `ape_funcio_respon`,
                            `respon_depen`.`nom_depen` AS `nom_depen_respon`, `respon_ofici`.`nom_oficina` AS `nom_oficina_respon`,
                            `destina`.`nom_funcio` AS `nom_funcio_destina`, `destina`.`ape_funcio` AS `ape_funcio_destina`,
                            `destina_depen`.`nom_depen` AS `nom_depen_destina`, `destina_ofi`.`nom_oficina` AS `nom_oficina_destina`,
                            `radi_destina`.`leido`, `radi_destina`.`fechor_leido`, `radi_destina`.`cc`, `radi_destina`.`id_funcio_deta`,
                            `radi_destina`.`leido`, `radi`.`transferido`, `radi`.`requie_respuesta`, `funcio_regis`.`nom_funcio` AS 'nom_funcio_regis',
                             `funcio_regis`.`nom_funcio` AS 'ape_funcio_regis', `radi`.`impri_rotu`
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
                        WHERE (`radi`.`transferido` = 0 AND `radi_respon`.`respon` = 1 AND " . $TipoFuncionario . " = :id_funcio_deta
                            " . self::Generar_Query_Correspondencia($this->Buscar, $this->IdRadica, $this->IdTercero, $this->IdFuncioDeta, $this->Asunto, $this->QueContenga, $this->IdDepen, $this->IdOfi) . ")
                        LIMIT :Limite1, :Limite2";

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->bindParam(":id_funcio_deta", $this->IdFuncioSesion, PDO::PARAM_INT);
                    $Instruc->bindParam(":Limite1", $this->Limite1, PDO::PARAM_INT);
                    $Instruc->bindParam(":Limite2", $this->Limite2, PDO::PARAM_INT);
                    $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
                } elseif ($this->Accion == 7) {
                    /******************************************************************************************/
                    /*  FILTRO LA CORRESPONDENCIA EXTERNA DE UN FUNCIONARIO JEFE DE DEPENDENCIA
                /******************************************************************************************/
                    $Sql = "SELECT `radi`.`id_radica`, `radi`.`adjunto`, `radi`.`fechor_radica`, `radi`.`fec_venci`, `radi`.`asunto`,
                            `radi`.`texto`, `funcio_regis`.`nom_funcio` AS `nom_funcio_radi`, `funcio_regis`.`ape_funcio` AS `ape_funcio_radi`,
                            `funcio_depen`.`nom_depen` AS `nom_depen_regis`, `funcio_ofi`.`nom_oficina` AS `nom_oficina_regis`,
                            `respon`.`nom_funcio` AS `nom_funcio_respon`, `respon`.`ape_funcio` AS `ape_funcio_respon`,
                            `respon_depen`.`nom_depen` AS `nom_depen_respon`, `respon_ofici`.`nom_oficina` AS `nom_oficina_respon`,
                            `destina`.`nom_funcio` AS `nom_funcio_destina`, `destina`.`ape_funcio` AS `ape_funcio_destina`,
                            `destina_depen`.`nom_depen` AS `nom_depen_destina`, `destina_ofi`.`nom_oficina` AS `nom_oficina_destina`,
                            `radi_destina`.`leido`, `radi_destina`.`fechor_leido`, `radi_destina`.`cc`, `radi_destina`.`id_funcio_deta`,
                            `radi_destina`.`leido`, `radi`.`transferido`, `radi`.`requie_respuesta`, `funcio_regis`.`nom_funcio` AS 'nom_funcio_regis',
                             `funcio_regis`.`nom_funcio` AS 'ape_funcio_regis', `radi`.`impri_rotu`
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
                        WHERE (`radi_respon`.`respon` = 1 AND `radi`.`transferido` = 0 AND " . $TipoFuncionario . " = :id_funcio_deta AND `destina_depen`.`id_depen` = :id_depen " . self::Generar_Query_Correspondencia($this->Buscar, $this->IdRadica, $this->IdTercero, $this->IdFuncioDeta, $this->Asunto, $this->QueContenga, $this->IdDepen, $this->IdOfi) . ")
                        ORDER BY `radi`.`fechor_radica` DESC
                        LIMIT :Limite1, :Limite2";

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->bindParam(":id_funcio_deta", $this->IdFuncioSesion, PDO::PARAM_INT);
                    $Instruc->bindParam(":id_depen", $this->IdDepen, PDO::PARAM_INT);
                    $Instruc->bindParam(":Limite1", $this->Limite1, PDO::PARAM_INT);
                    $Instruc->bindParam(":Limite2", $this->Limite2, PDO::PARAM_INT);
                    $Instruc->execute(array($this->IdDepen)) or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
                } elseif ($this->Accion == 8) {
                    /******************************************************************************************/
                    /*  FILTRO LA CORRESPONDENCIA EXTERNA DE UN FUNCIONARIO JEFE DE OFICINA
                /******************************************************************************************/
                    $Sql = "SELECT `radi`.`id_radica`, `radi`.`adjunto`, `radi`.`fechor_radica`, `radi`.`fec_venci`, `radi`.`asunto`,
                            `radi`.`texto`, `funcio_regis`.`nom_funcio` AS `nom_funcio_radi`, `funcio_regis`.`ape_funcio` AS `ape_funcio_radi`,
                            `funcio_depen`.`nom_depen` AS `nom_depen_regis`, `funcio_ofi`.`nom_oficina` AS `nom_oficina_regis`,
                            `respon`.`nom_funcio` AS `nom_funcio_respon`, `respon`.`ape_funcio` AS `ape_funcio_respon`,
                            `respon_depen`.`nom_depen` AS `nom_depen_respon`, `respon_ofici`.`nom_oficina` AS `nom_oficina_respon`,
                            `destina`.`nom_funcio` AS `nom_funcio_destina`, `destina`.`ape_funcio` AS `ape_funcio_destina`,
                            `destina_depen`.`nom_depen` AS `nom_depen_destina`, `destina_ofi`.`nom_oficina` AS `nom_oficina_destina`,
                            `radi_destina`.`leido`, `radi_destina`.`fechor_leido`, `radi_destina`.`cc`, `radi_destina`.`id_funcio_deta`,
                            `radi_destina`.`leido`, `radi`.`transferido`, `radi`.`requie_respuesta`, `funcio_regis`.`nom_funcio` AS 'nom_funcio_regis',
                             `funcio_regis`.`nom_funcio` AS 'ape_funcio_regis', `radi`.`impri_rotu`
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
                        WHERE `radi_respon`.`respon` = 1 AND `radi`.`transferido` = 0 AND `respon_depen`.`id_depen` = :id_depen AND `respon_ofici`.`id_oficina` = :id_oficina " . self::Generar_Query_Correspondencia($this->Buscar, $this->IdRadica, $this->IdTercero, $this->IdFuncioDeta, $this->Asunto, $this->QueContenga, $this->IdDepen, $this->IdOfi) . "
                        ORDER BY `radi`.`fechor_radica` DESC
                        LIMIT :Limite1, :Limite2";

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->bindParam(":id_depen", $this->IdDepen, PDO::PARAM_INT);
                    $Instruc->bindParam(":id_oficina", $this->IdOfi, PDO::PARAM_INT);
                    $Instruc->bindParam(":Limite1", $this->Limite1, PDO::PARAM_INT);
                    $Instruc->bindParam(":Limite2", $this->Limite2, PDO::PARAM_INT);
                    $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
                }

                $Result = $Instruc->fetchAll();
                $conexion = null;
                return $Result;
            } catch (PDOException $e) {
                echo 'Ha surgido un error y no se puede ejecutar la instrucción, Correspondencia Interna Recibida -> Accion: ' . $this->Accion . ". " . $e->getMessage();
                exit;
            }
        }

        public function TotalRegistros_Filtro()
        {
            $conexion = new Conexion();

            $TipoFuncionario = "";

            if ($this->OrigenCorrespondencia == "ENVIADA") {
                $TipoFuncionario = "`radi_respon`.`id_funcio`";
            } elseif ($this->OrigenCorrespondencia == "RECIBIDA") {
                $TipoFuncionario = "`radi_destina`.`id_funcio_deta`";
            }

            try {
                if ($this->Accion == 5) {
                    /******************************************************************************************/
                    /*  FILTRO TODA LA CORRESPONDENCIA ENVIADA DEL PROPIETARIO PRINCIPAL DE LA INSTITUCION
                /******************************************************************************************/

                    $Sql = "SELECT `radi`.`id_radica` as 'Total'
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
                        WHERE `radi_respon`.`respon` = 1 AND `radi`.`transferido` = 0 " . self::Generar_Query_Correspondencia($this->Buscar, $this->IdRadica, $this->IdTercero, $this->IdFuncioDeta, $this->Asunto, $this->QueContenga, $this->IdDepen, $this->IdOfi);

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
                } elseif ($this->Accion == 6) {
                    /******************************************************************************************/
                    /*  FILTRO LA CORRESPONDENCIA EXTERNA DE UN FUNCIONARIO
                /******************************************************************************************/
                    $Sql = "SELECT `radi`.`id_radica` as 'Total'
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
                        WHERE `radi_respon`.`respon` = 1 AND `radi`.`transferido` = 0 AND " . $TipoFuncionario . " = :id_funcio_deta
                            " . self::Generar_Query_Correspondencia($this->Buscar, $this->IdRadica, $this->IdTercero, $this->IdFuncioDeta, $this->Asunto, $this->QueContenga, $this->IdDepen, $this->IdOfi);

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->bindParam(":id_funcio_deta", $this->IdFuncioSesion, PDO::PARAM_INT);
                    $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
                } elseif ($this->Accion == 7) {
                    /******************************************************************************************/
                    /*  FILTRO LA CORRESPONDENCIA EXTERNA DE UN FUNCIONARIO JEFE DE DEPENDENCIA
                /******************************************************************************************/
                    $Sql = "SELECT `radi`.`id_radica` as 'Total'
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
                        WHERE (`radi_respon`.`respon` = 1 AND `radi`.`transferido` = 0 AND " . $TipoFuncionario . " = :id_funcio_deta AND `destina_depen`.`id_depen` = :id_depen " . self::Generar_Query_Correspondencia($this->Buscar, $this->IdRadica, $this->IdTercero, $this->IdFuncioDeta, $this->Asunto, $this->QueContenga, $this->IdDepen, $this->IdOfi) . ")";

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->bindParam(":id_funcio_deta", $this->IdFuncioSesion, PDO::PARAM_INT);
                    $Instruc->bindParam(":id_depen", $this->IdDepen, PDO::PARAM_INT);
                    $Instruc->execute() or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
                } elseif ($this->Accion == 8) {
                    /******************************************************************************************/
                    /*  FILTRO LA CORRESPONDENCIA EXTERNA DE UN FUNCIONARIO JEFE DE OFICINA
                /******************************************************************************************/
                    $Sql = "SELECT `radi`.`id_radica` as 'Total'
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
                        WHERE `radi_respon`.`respon` = 1 AND `radi`.`transferido` = 0 AND " . $TipoFuncionario . " = :id_funcio_deta AND `respon_ofici`.`id_oficina` = :id_oficina " . self::Generar_Query_Correspondencia($this->Buscar, $this->IdRadica, $this->IdTercero, $this->IdFuncioDeta, $this->Asunto, $this->QueContenga, $this->IdDepen, $this->IdOfi);

                    $Instruc = $conexion->prepare($Sql);
                    $Instruc->bindParam(":id_funcio_deta", $this->IdFuncioSesion, PDO::PARAM_INT);
                    $Instruc->bindParam(":id_oficina", $this->IdOfi, PDO::PARAM_INT);
                    $Instruc->execute(array($this->IdDepen, $this->IdOfi)) or die(print_r($Instruc->errorInfo() . " - " . $Sql, true));
                }

                $Result = $Instruc->rowCount();
                $conexion = null;
                return $Result;
            } catch (PDOException $e) {
                echo 'Ha surgido un error y no se puede ejecutar la consulta Total de registros.' . $e->getMessage();
                exit;
            }
        }

        public static function Generar_Query_Correspondencia($Buscar, $IdRadica, $IdTercero, $IdFuncio, $Asunto, $QueContenga, $IdDepen, $IdOfi)
        {
            $conexion = new Conexion();

            $Query = "";

            if (
                $Buscar != "" and $IdRadica == "" and $IdTercero == "" and $IdFuncio == "" and $Asunto == "" and $QueContenga == "" and $IdDepen == ""
                and $IdOfi == ""
            ) {

                $Query = "AND `radi`.`id_radica` LIKE '%" . $Buscar . "%'
                    OR `terce_contac`.`nom_contac` LIKE '%" . $Buscar . "%'
                    OR `terce_empre`.`razo_soci` LIKE '%" . $Buscar . "%'
                    OR CONCAT(TRIM(`funcio`.`nom_funcio`), ' ', TRIM(`funcio`.`ape_funcio`)) LIKE '%" . $Buscar . "%'
                    OR `radi`.`asunto` LIKE '%" . $Buscar . "%'";
            } else {

                if ($IdRadica != "") {
                    $Query .= " AND `radi`.`id_radica` LIKE '%" . $IdRadica . "%'";
                }

                if ($IdTercero != "") {
                    $Query .= " AND `terce_contac`.`id_empre` = " . $IdTercero;
                }

                if ($IdFuncio != "") {
                    $Query .= " AND `funcio_deta`.`id_funcio_deta` = " . $IdFuncio;
                }

                if ($Asunto != "") {
                    $Query .= " AND `radi`.`asunto` LIKE '%" . $Asunto . "%'";
                }

                if ($QueContenga != "") {
                    $Query .= " AND `radi`.`que_contenga` LIKE '%" . $QueContenga . "%'";
                }

                if ($IdDepen != "") {
                    $Query .= " AND `depen`.`id_depen` = " . $IdDepen;
                }

                if ($IdOfi != "") {
                    $Query .= " AND `funcio_deta`.`id_oficina` = " . $IdOfi;
                }
            }

            return $Query;
            exit();
        }
    }
    ?>