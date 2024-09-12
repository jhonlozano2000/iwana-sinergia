DROP TABLE IF EXISTS `archivo_digitales_trd`;

CREATE TABLE `archivo_digitales_trd` (
  `id_digital` INT NOT NULL AUTO_INCREMENT,
  `id_depen` INT NOT NULL,
  `id_oficina` INT DEFAULT NULL,
  `id_serie` INT NOT NULL,
  `id_subserie` INT NOT NULL,
  `fechor_regis` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `codigo` VARCHAR(45) DEFAULT NULL,
  `titulo` VARCHAR(45) DEFAULT NULL,
  `fec_ini` VARCHAR(45) DEFAULT NULL,
  `fec_fin` VARCHAR(45) DEFAULT NULL,
  `criterio1` VARCHAR(45) DEFAULT NULL,
  `criterio2` VARCHAR(45) DEFAULT NULL,
  `criterio3` VARCHAR(45) DEFAULT NULL,
  `deposito` CHAR(40) DEFAULT NULL,
  `caja` CHAR(5) DEFAULT NULL,
  `carpeta` CHAR(5) DEFAULT NULL,
  `folios` INT DEFAULT '0',
  `acti` TINYINT(1) DEFAULT '1',
  PRIMARY KEY (`id_digital`),
  KEY `fk_archivo_digital_archivos_archivo_trd_series1_idx` (`id_serie`),
  KEY `fk_archivo_digital_archivos_archivo_trd_subserie1_idx` (`id_subserie`),
  KEY `fk_archivo_digital_areas_dependencias1_idx` (`id_depen`),
  KEY `fk_archivo_digitales_areas_oficinas1_idx` (`id_oficina`),
  CONSTRAINT `fk_archivo_digital_archivos_archivo_trd_series1` FOREIGN KEY (`id_serie`) REFERENCES `archivo_trd_series` (`id_serie`),
  CONSTRAINT `fk_archivo_digital_archivos_archivo_trd_subserie1` FOREIGN KEY (`id_subserie`) REFERENCES `archivo_trd_subserie` (`id_subserie`),
  CONSTRAINT `fk_archivo_digital_areas_dependencias1` FOREIGN KEY (`id_depen`) REFERENCES `areas_dependencias` (`id_depen`),
  CONSTRAINT `fk_archivo_digitales_areas_oficinas1` FOREIGN KEY (`id_oficina`) REFERENCES `areas_oficinas` (`id_oficina`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `archivo_digitales_trd_detalle` */

DROP TABLE IF EXISTS `archivo_digitales_trd_detalle`;

CREATE TABLE `archivo_digitales_trd_detalle` (
  `id_archivo` INT NOT NULL AUTO_INCREMENT,
  `id_digital` INT NOT NULL,
  `id_tomo` INT NOT NULL,
  `id_ruta` INT NOT NULL,
  `id_tipodoc` INT DEFAULT NULL,
  `archivo` VARCHAR(255) DEFAULT NULL,
  `folios` INT DEFAULT '0',
  `detalle` VARCHAR(255) DEFAULT NULL,
  `fecha` CHAR(20) DEFAULT NULL,
  `fec_registro` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `tipo` VARCHAR(45) DEFAULT NULL COMMENT 'el tipo de archivo especifica si el archivo es subido como un todo o son archivos dela lista de checkeo',
  PRIMARY KEY (`id_archivo`),
  KEY `fk_archivo_digital_archivos_archivo_digital1_idx` (`id_digital`),
  KEY `fk_archivo_digitales_detalle_archivo_trd_tipo_docu1_idx` (`id_tipodoc`),
  KEY `fk_archivo_digitales_detalle_config_rutas_archi_digitalizad_idx` (`id_ruta`),
  KEY `fk_archivo_digitales_detalle_TRD_archivo_digitales_tomos_TR_idx` (`id_tomo`),
  CONSTRAINT `fk_archivo_digital_archivos_archivo_digital1` FOREIGN KEY (`id_digital`) REFERENCES `archivo_digitales_trd` (`id_digital`),
  CONSTRAINT `fk_archivo_digitales_detalle_archivo_trd_tipo_docu1` FOREIGN KEY (`id_tipodoc`) REFERENCES `archivo_trd_tipo_docu` (`id_tipodoc`),
  CONSTRAINT `fk_archivo_digitales_detalle_config_rutas_archi_digitalizados1` FOREIGN KEY (`id_ruta`) REFERENCES `config_rutas_archi_digitalizados` (`id_ruta`),
  CONSTRAINT `fk_archivo_digitales_detalle_TRD_archivo_digitales_tomos_TRD1` FOREIGN KEY (`id_tomo`) REFERENCES `archivo_digitales_trd_tomos` (`id_tomo`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `archivo_digitales_trd_tomos` */

DROP TABLE IF EXISTS `archivo_digitales_trd_tomos`;

CREATE TABLE `archivo_digitales_trd_tomos` (
  `id_tomo` INT NOT NULL AUTO_INCREMENT,
  `id_digital` INT NOT NULL,
  `nom_tomo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_tomo`),
  KEY `fk_archivo_digitales_tomos_TRD_archivo_digitales_TRD1_idx` (`id_digital`),
  CONSTRAINT `fk_archivo_digitales_tomos_TRD_archivo_digitales_TRD1` FOREIGN KEY (`id_digital`) REFERENCES `archivo_digitales_trd` (`id_digital`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `archivo_digitales_tvd` */

DROP TABLE IF EXISTS `archivo_digitales_tvd`;

CREATE TABLE `archivo_digitales_tvd` (
  `id_digital` INT NOT NULL AUTO_INCREMENT,
  `id_depen` INT NOT NULL,
  `id_oficina` INT DEFAULT NULL,
  `id_serie` INT NOT NULL,
  `id_subserie` INT NOT NULL,
  `fechor_regis` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `codigo` VARCHAR(45) DEFAULT NULL,
  `titulo` VARCHAR(45) DEFAULT NULL,
  `fec_ini` VARCHAR(45) DEFAULT NULL,
  `fec_fin` VARCHAR(45) DEFAULT NULL,
  `criterio1` VARCHAR(45) DEFAULT NULL,
  `criterio2` VARCHAR(45) DEFAULT NULL,
  `criterio3` VARCHAR(45) DEFAULT NULL,
  `deposito` CHAR(40) DEFAULT NULL,
  `caja` CHAR(5) DEFAULT NULL,
  `carpeta` CHAR(5) DEFAULT NULL,
  `folios` INT DEFAULT '0',
  `acti` TINYINT(1) DEFAULT '1',
  PRIMARY KEY (`id_digital`),
  KEY `fk_archivo_digitales_tvd_areas_dependencias_tvd1_idx` (`id_depen`),
  KEY `fk_archivo_digitales_tvd_areas_oficinas_tvd1_idx` (`id_oficina`),
  KEY `fk_archivo_digitales_tvd_archivo_tvd_series1_idx` (`id_serie`),
  KEY `fk_archivo_digitales_tvd_archivo_tvd_subserie1_idx` (`id_subserie`),
  CONSTRAINT `fk_archivo_digitales_tvd_archivo_tvd_series1` FOREIGN KEY (`id_serie`) REFERENCES `archivo_tvd_series` (`id_serie`),
  CONSTRAINT `fk_archivo_digitales_tvd_archivo_tvd_subserie1` FOREIGN KEY (`id_subserie`) REFERENCES `archivo_tvd_subserie` (`id_subserie`),
  CONSTRAINT `fk_archivo_digitales_tvd_areas_dependencias_tvd1` FOREIGN KEY (`id_depen`) REFERENCES `archivo_tvd_dependencias` (`id_depen`),
  CONSTRAINT `fk_archivo_digitales_tvd_areas_oficinas_tvd1` FOREIGN KEY (`id_oficina`) REFERENCES `archivo_tvd_oficinas` (`id_oficina`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `archivo_digitales_tvd_detalle` */

DROP TABLE IF EXISTS `archivo_digitales_tvd_detalle`;

CREATE TABLE `archivo_digitales_tvd_detalle` (
  `id_archivo` INT NOT NULL AUTO_INCREMENT,
  `id_digital` INT NOT NULL,
  `id_tomo` INT NOT NULL,
  `id_ruta` INT NOT NULL,
  `id_tipodoc` INT DEFAULT NULL,
  `archivo` VARCHAR(255) DEFAULT NULL,
  `folios` INT DEFAULT '0',
  `detalle` VARCHAR(255) DEFAULT NULL,
  `fecha` CHAR(20) DEFAULT NULL,
  `fec_registro` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `tipo` VARCHAR(45) DEFAULT NULL COMMENT 'el tipo de archivo especifica si el archivo es subido como un todo o son archivos dela lista de checkeo',
  PRIMARY KEY (`id_archivo`),
  KEY `fk_archivo_digital_archivos_archivo_digital1_idx` (`id_digital`),
  KEY `fk_archivo_digitales_detalle_archivo_trd_tipo_docu1_idx` (`id_tipodoc`),
  KEY `fk_archivo_digitales_detalle_config_rutas_archi_digitalizad_idx` (`id_ruta`),
  KEY `fk_archivo_digitales_detalle_TRD_archivo_digitales_tomos_TR_idx` (`id_tomo`),
  CONSTRAINT `fk_archivo_digital_archivos_archivo_digital10` FOREIGN KEY (`id_digital`) REFERENCES `archivo_digitales_tvd` (`id_digital`),
  CONSTRAINT `fk_archivo_digitales_detalle_archivo_trd_tipo_docu10` FOREIGN KEY (`id_tipodoc`) REFERENCES `archivo_trd_tipo_docu` (`id_tipodoc`),
  CONSTRAINT `fk_archivo_digitales_detalle_config_rutas_archi_digitalizados10` FOREIGN KEY (`id_ruta`) REFERENCES `config_rutas_archi_digitalizados` (`id_ruta`),
  CONSTRAINT `fk_archivo_digitales_detalle_TRD_archivo_digitales_tomos_TRD10` FOREIGN KEY (`id_tomo`) REFERENCES `archivo_digitales_tvd_tomos` (`id_tomo`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `archivo_digitales_tvd_tomos` */

DROP TABLE IF EXISTS `archivo_digitales_tvd_tomos`;

CREATE TABLE `archivo_digitales_tvd_tomos` (
  `id_tomo` INT NOT NULL AUTO_INCREMENT,
  `id_digital` INT NOT NULL,
  `nom_tomo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_tomo`),
  KEY `fk_archivo_digitales_tomos_TRD_archivo_digitales_TRD1_idx` (`id_digital`),
  CONSTRAINT `fk_archivo_digitales_tomos_TRD_archivo_digitales_TRD10` FOREIGN KEY (`id_digital`) REFERENCES `archivo_digitales_tvd` (`id_digital`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `archivo_radica_enviados` */

DROP TABLE IF EXISTS `archivo_radica_enviados`;

CREATE TABLE `archivo_radica_enviados` (
  `id_radica` VARCHAR(25) NOT NULL,
  `id_destina` INT NOT NULL,
  `id_serie` INT DEFAULT NULL COMMENT 'cuando la correspondencia va de lo interno a lo externo el id_remite se convierte en destinatario.\ncuando la correspondencia externa asia la interna el id_remite se convierte ne remitente.',
  `id_subserie` INT DEFAULT NULL,
  `id_tipodoc` INT NOT NULL,
  `id_usua_regis` INT NOT NULL,
  `id_formaenvio` INT NOT NULL,
  `id_tipo_respue` INT NOT NULL DEFAULT '1',
  `id_ruta` INT DEFAULT NULL,
  `fec_docu` DATE DEFAULT NULL,
  `fechor_radica` DATETIME NOT NULL,
  `asunto` TEXT,
  `num_folio` INT DEFAULT '0',
  `num_anexos` CHAR(5) DEFAULT '0',
  `observa_anexo` VARCHAR(255) DEFAULT NULL,
  `digital` TINYINT(1) NOT NULL DEFAULT '0',
  `adjunto` TINYINT(1) NOT NULL DEFAULT '0',
  `impri_rotu` TINYINT(1) DEFAULT '0',
  `fechor_impri_rotu` DATETIME DEFAULT NULL,
  `usua_impri_rotu` INT DEFAULT NULL,
  `impri_docu` TINYINT(1) DEFAULT '0',
  `id_radica_repues` CHAR(20) DEFAULT NULL,
  `enviado` TINYINT(1) DEFAULT '0',
  `trasnferido` TINYINT(1) DEFAULT '0' COMMENT 'Saber si el archivo fue transferido del temporal de la oficina al archivo de gestion de la dependencia a un expediente',
  `num_guia` CHAR(50) DEFAULT NULL,
  `texto` TEXT,
  `opcion_relacion` VARCHAR(200) DEFAULT NULL,
  `opcion_titulo` VARCHAR(200) DEFAULT NULL,
  `opcion_sub_titulo` VARCHAR(200) DEFAULT NULL,
  `opcion_detalle1` VARCHAR(200) DEFAULT NULL,
  `opcion_detalle2` VARCHAR(200) DEFAULT NULL,
  `opcion_detalle3` VARCHAR(200) DEFAULT NULL,
  `archivo` VARCHAR(100) DEFAULT NULL,
  PRIMARY KEY (`id_radica`),
  KEY `fk_radica_externa_config_formaenvio1_idx` (`id_formaenvio`),
  KEY `fk_radica_externa_serie` (`id_serie`),
  KEY `fk_radica_externa_subserie` (`id_subserie`),
  KEY `fk_radica_externa_usua_impri_rotulo_idx` (`usua_impri_rotu`),
  KEY `fk_archivo_radica_externa_segu_usua1_idx` (`id_usua_regis`),
  KEY `archivo_radica_enviados_fec_radica` (`fechor_radica`),
  KEY `archivo_radica_enviados_digital` (`digital`),
  KEY `fk_archivo_radica_enviados_config_tipos_respuestas1_idx` (`id_tipo_respue`),
  KEY `fk_archivo_radica_enviados_archivo_trd_tipo_docu1_idx` (`id_tipodoc`),
  KEY `fk_archivo_radica_enviados_gene_terceros_contac1_idx` (`id_destina`),
  FULLTEXT KEY `archivo_radica_enviados_asunto` (`asunto`),
  CONSTRAINT `fk_archivo_radica_enviados_archivo_trd_tipo_docu1` FOREIGN KEY (`id_tipodoc`) REFERENCES `archivo_trd_tipo_docu` (`id_tipodoc`),
  CONSTRAINT `fk_archivo_radica_enviados_config_tipos_respuestas1` FOREIGN KEY (`id_tipo_respue`) REFERENCES `config_tipos_respuestas` (`id_respue`),
  CONSTRAINT `fk_archivo_radica_enviados_gene_terceros_contac1` FOREIGN KEY (`id_destina`) REFERENCES `gene_terceros_contac` (`id_tercero`),
  CONSTRAINT `fk_archivo_radica_externa_segu_usua10` FOREIGN KEY (`id_usua_regis`) REFERENCES `segu_usua` (`id_usua`),
  CONSTRAINT `fk_radica_externa_config_formaenvio10` FOREIGN KEY (`id_formaenvio`) REFERENCES `config_formaenvio` (`id_formaenvio`),
  CONSTRAINT `fk_radica_externa_rete_serie0` FOREIGN KEY (`id_serie`) REFERENCES `archivo_trd_series` (`id_serie`),
  CONSTRAINT `fk_radica_externa_rete_subserie0` FOREIGN KEY (`id_subserie`) REFERENCES `archivo_trd_subserie` (`id_subserie`),
  CONSTRAINT `fk_radica_externa_usua_impri_rotulo0` FOREIGN KEY (`usua_impri_rotu`) REFERENCES `segu_usua` (`id_usua`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `archivo_radica_enviados_archivos` */

DROP TABLE IF EXISTS `archivo_radica_enviados_archivos`;

CREATE TABLE `archivo_radica_enviados_archivos` (
  `id_archivo` INT NOT NULL AUTO_INCREMENT,
  `id_radica` VARCHAR(25) NOT NULL,
  `nom_archivo` VARCHAR(300) DEFAULT NULL,
  PRIMARY KEY (`id_archivo`),
  KEY `fk_archivo_radica_enviados_archivos_archivo_radica_enviados_idx` (`id_radica`),
  CONSTRAINT `fk_archivo_radica_enviados_archivos_archivo_radica_enviados1` FOREIGN KEY (`id_radica`) REFERENCES `archivo_radica_enviados` (`id_radica`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `archivo_radica_enviados_proyector` */

DROP TABLE IF EXISTS `archivo_radica_enviados_proyector`;

CREATE TABLE `archivo_radica_enviados_proyector` (
  `id_radica` VARCHAR(25) NOT NULL,
  `id_funcio_deta` INT NOT NULL,
  `fechor_asigna` DATETIME NOT NULL,
  KEY `fk_archivo_radica_salida_proyector_archivo_radica_salida1_idx` (`id_radica`),
  KEY `fk_archivo_radica_salida_proyector_gene_funcionarios_deta1_idx` (`id_funcio_deta`),
  CONSTRAINT `fk_archivo_radica_salida_proyector_archivo_radica_salida1` FOREIGN KEY (`id_radica`) REFERENCES `archivo_radica_enviados` (`id_radica`),
  CONSTRAINT `fk_archivo_radica_salida_proyector_gene_funcionarios_deta1` FOREIGN KEY (`id_funcio_deta`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `archivo_radica_enviados_quienes_firman` */

DROP TABLE IF EXISTS `archivo_radica_enviados_quienes_firman`;

CREATE TABLE `archivo_radica_enviados_quienes_firman` (
  `id_radica` CHAR(25) NOT NULL,
  `id_funcio_deta` INT NOT NULL,
  `firma_principal` TINYINT(1) DEFAULT '0' COMMENT 'Funcionario principla que firma la correspondencia',
  KEY `id_radica` (`id_radica`),
  KEY `id_funcio_deta` (`id_funcio_deta`),
  CONSTRAINT `archivo_radica_enviados_quien_firma_ibfk_0231` FOREIGN KEY (`id_radica`) REFERENCES `archivo_radica_enviados` (`id_radica`),
  CONSTRAINT `archivo_radica_enviados_quien_firma_ibfk_8962` FOREIGN KEY (`id_funcio_deta`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `archivo_radica_enviados_responsa` */

DROP TABLE IF EXISTS `archivo_radica_enviados_responsa`;

CREATE TABLE `archivo_radica_enviados_responsa` (
  `id_radica` VARCHAR(25) NOT NULL,
  `id_funcio_deta` INT NOT NULL,
  `respon` TINYINT(1) DEFAULT '0',
  KEY `fk_archivo_radica_salida_responsa_archivo_radica_salida1_idx` (`id_radica`),
  KEY `fk_archivo_radica_salida_responsa_gene_funcionarios_deta1_idx` (`id_funcio_deta`),
  CONSTRAINT `fk_archivo_radica_salida_responsa_gene_funcionarios_deta1` FOREIGN KEY (`id_funcio_deta`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`),
  CONSTRAINT `fk_archivo_radica_salida_responsa_id_radica` FOREIGN KEY (`id_radica`) REFERENCES `archivo_radica_enviados` (`id_radica`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3 COMMENT='Responsables de la correspondencia de entrada, salida y la correspondencia interna.';

/*Table structure for table `archivo_radica_enviados_respuestas` */

DROP TABLE IF EXISTS `archivo_radica_enviados_respuestas`;

CREATE TABLE `archivo_radica_enviados_respuestas` (
  `id_radica_enviado` VARCHAR(25) NOT NULL,
  `id_radica_recivido` VARCHAR(25) NOT NULL,
  `id_usua_regis` INT NOT NULL,
  `fechor_regis` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `fk_archivo_radica_enviados_respuestas_archivo_radica_enviad_idx` (`id_radica_enviado`),
  KEY `fk_archivo_radica_enviados_respuestas_archivo_radica_recibi_idx` (`id_radica_recivido`),
  KEY `fk_archivo_radica_enviados_respuestas_segu_usua1_idx` (`id_usua_regis`),
  CONSTRAINT `fk_archivo_radica_enviados_respuestas_archivo_radica_enviados1` FOREIGN KEY (`id_radica_enviado`) REFERENCES `archivo_radica_enviados` (`id_radica`),
  CONSTRAINT `fk_archivo_radica_enviados_respuestas_archivo_radica_recibidos1` FOREIGN KEY (`id_radica_recivido`) REFERENCES `archivo_radica_recibidos` (`id_radica`),
  CONSTRAINT `fk_archivo_radica_enviados_respuestas_segu_usua1` FOREIGN KEY (`id_usua_regis`) REFERENCES `segu_usua` (`id_usua`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3 COMMENT='Relacion de los radicados enviados que son respuesta de los radicados recibidos';

/*Table structure for table `archivo_radica_enviados_temp` */

DROP TABLE IF EXISTS `archivo_radica_enviados_temp`;

CREATE TABLE `archivo_radica_enviados_temp` (
  `id_temp` INT NOT NULL AUTO_INCREMENT,
  `id_serie` INT DEFAULT NULL,
  `id_subserie` INT DEFAULT NULL,
  `id_tipodoc` INT DEFAULT NULL,
  `id_usua_regis` INT NOT NULL,
  `id_despedida` INT DEFAULT NULL,
  `id_status` INT DEFAULT NULL,
  `id_saludo` INT DEFAULT NULL,
  `id_destina` INT NOT NULL,
  `id_ruta` INT DEFAULT NULL,
  `fechor_registro` DATETIME DEFAULT NULL,
  `asunto` TEXT,
  `con_copia` VARCHAR(300) DEFAULT NULL,
  `anexos` VARCHAR(300) DEFAULT NULL,
  `adjunto` TINYINT(1) DEFAULT '0',
  `terminado` TINYINT(1) DEFAULT '0',
  `existen_proyectores` TINYINT(1) DEFAULT '0' COMMENT 'Identificar si el documento tiene proyectores. ',
  `nom_archivo` CHAR(255) DEFAULT NULL,
  `genera_plantilla` TINYINT(1) DEFAULT '0' COMMENT 'Saber si ya se genero la plantilla',
  `plantilla_cargada` TINYINT(1) DEFAULT '0',
  `radicado` TINYINT(1) DEFAULT '0' COMMENT 'saber si el registro temporan ya se radico',
  `anulado` TINYINT(1) DEFAULT '0',
  `id_funcio_deta_anula` INT DEFAULT NULL,
  `fechor_anula` DATETIME DEFAULT NULL,
  `id_radicado` CHAR(25) DEFAULT NULL,
  PRIMARY KEY (`id_temp`),
  KEY `fk_archivo_radica_salida_temp_id_tipodoc_idx` (`id_tipodoc`),
  KEY `fk_archivo_radica_salida_temp_archivo_trd_series1_idx` (`id_serie`),
  KEY `fk_archivo_radica_salida_temp_archivo_trd_series_subserie1_idx` (`id_subserie`),
  KEY `fk_archivo_radica_salida_temp_gene_funcionarios_deta1_idx` (`id_usua_regis`),
  KEY `fk_archivo_radica_salida_temp_config_status1_idx` (`id_status`),
  KEY `fk_archivo_radica_salida_temp_config_saludo1_idx` (`id_saludo`),
  KEY `fk_archivo_radica_salida_temp_config_despedida1_idx` (`id_despedida`),
  KEY `fk_archivo_radica_enviados_temp_config_rutas_archi_temp1_idx` (`id_ruta`),
  KEY `fk_archivo_radica_enviados_temp_gene_funcionarios_deta2_idx` (`id_funcio_deta_anula`),
  KEY `fk_archivo_radica_enviados_temp_gene_terceros_contac1_idx` (`id_destina`),
  CONSTRAINT `fk_archivo_radica_enviados_temp_config_rutas_archi_temp1` FOREIGN KEY (`id_ruta`) REFERENCES `config_rutas_archi_temp` (`id_ruta`),
  CONSTRAINT `fk_archivo_radica_enviados_temp_gene_funcionarios_deta2` FOREIGN KEY (`id_funcio_deta_anula`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`),
  CONSTRAINT `fk_archivo_radica_enviados_temp_gene_terceros_contac1` FOREIGN KEY (`id_destina`) REFERENCES `gene_terceros_contac` (`id_tercero`),
  CONSTRAINT `fk_archivo_radica_salida_temp_archivo_trd_series1` FOREIGN KEY (`id_serie`) REFERENCES `archivo_trd_series` (`id_serie`),
  CONSTRAINT `fk_archivo_radica_salida_temp_archivo_trd_series_subserie1` FOREIGN KEY (`id_subserie`) REFERENCES `archivo_trd_subserie` (`id_subserie`),
  CONSTRAINT `fk_archivo_radica_salida_temp_config_despedida1` FOREIGN KEY (`id_despedida`) REFERENCES `config_despedida` (`id_despedida`),
  CONSTRAINT `fk_archivo_radica_salida_temp_config_saludo1` FOREIGN KEY (`id_saludo`) REFERENCES `config_saludo` (`id_saludo`),
  CONSTRAINT `fk_archivo_radica_salida_temp_config_status1` FOREIGN KEY (`id_status`) REFERENCES `config_status` (`id_status`),
  CONSTRAINT `fk_archivo_radica_salida_temp_gene_funcionarios_deta1` FOREIGN KEY (`id_usua_regis`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`),
  CONSTRAINT `fk_archivo_radica_salida_temp_id_tipodoc` FOREIGN KEY (`id_tipodoc`) REFERENCES `archivo_trd_tipo_docu` (`id_tipodoc`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `archivo_radica_enviados_temp_nota` */

DROP TABLE IF EXISTS `archivo_radica_enviados_temp_nota`;

CREATE TABLE `archivo_radica_enviados_temp_nota` (
  `id_nota` INT NOT NULL AUTO_INCREMENT,
  `id_temp` INT NOT NULL,
  `id_funcio_deta` INT NOT NULL,
  `fechor_nota` DATETIME NOT NULL,
  `nota` TEXT NOT NULL,
  PRIMARY KEY (`id_nota`),
  KEY `fk_archivo_radica_enviados_temp_archivo_radica_enviados_tem_idx` (`id_temp`),
  KEY `fk_archivo_radica_enviados_temp_gene_funcionarios_deta1_idx` (`id_funcio_deta`),
  CONSTRAINT `fk_archivo_radica_enviados_temp_archivo_radica_enviados_temp1` FOREIGN KEY (`id_temp`) REFERENCES `archivo_radica_enviados_temp` (`id_temp`),
  CONSTRAINT `fk_archivo_radica_enviados_temp_gene_funcionarios_deta1` FOREIGN KEY (`id_funcio_deta`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3 COMMENT='versionamiento de los archivos de os radicados temporales';

/*Table structure for table `archivo_radica_enviados_temp_proyector` */

DROP TABLE IF EXISTS `archivo_radica_enviados_temp_proyector`;

CREATE TABLE `archivo_radica_enviados_temp_proyector` (
  `id_temp` INT NOT NULL,
  `id_funcio_deta` INT NOT NULL,
  `fechor_asigna` DATETIME DEFAULT NULL,
  `descargo_plantilla` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'Saber si el funcionario descargo la plantilla',
  `subio_plantilla` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'Saber si el funcionario subio la plantilla',
  `editando` TINYINT(1) NOT NULL DEFAULT '0',
  `terminado` TINYINT(1) NOT NULL DEFAULT '0',
  `fechor_termina` DATETIME DEFAULT NULL,
  KEY `fk_archivo_radica_salida_temp_proyector_gene_funcionarios_d_idx` (`id_funcio_deta`),
  KEY `fk_archivo_radica_salida_temp_proyector_archivo_radica_sali_idx` (`id_temp`),
  CONSTRAINT `fk_archivo_radica_salida_temp_proyector_archivo_radica_salida1` FOREIGN KEY (`id_temp`) REFERENCES `archivo_radica_enviados_temp` (`id_temp`),
  CONSTRAINT `fk_archivo_radica_salida_temp_proyector_gene_funcionarios_deta1` FOREIGN KEY (`id_funcio_deta`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `archivo_radica_enviados_temp_quienes_firman` */

DROP TABLE IF EXISTS `archivo_radica_enviados_temp_quienes_firman`;

CREATE TABLE `archivo_radica_enviados_temp_quienes_firman` (
  `id_temp` INT NOT NULL,
  `id_funcio_deta` INT NOT NULL,
  `fechor_asignado` DATETIME NOT NULL,
  `descargo_plantilla` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'Saber si el funcionario descargo la plantilla',
  `subio_plantilla` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'Saber si el funcionario subio la plantilla',
  `firma_principal` TINYINT(1) NOT NULL DEFAULT '0',
  `firmando` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'saber si el documento ya fue firmado por el documento',
  `fechor_firmado` DATETIME DEFAULT NULL,
  `firmado` TINYINT(1) DEFAULT '0' COMMENT 'saber si el documento esta siendo firmado por el funcionario',
  KEY `fk_archivo_radica_salida_temp_responsa_archivo_radica_salid_idx` (`id_temp`),
  KEY `fk_archivo_radica_salida_temp_responsa_gene_funcionarios_de_idx` (`id_funcio_deta`),
  CONSTRAINT `fk_archivo_radica_salida_temp_responsa_archivo_radica_salida_10` FOREIGN KEY (`id_temp`) REFERENCES `archivo_radica_enviados_temp` (`id_temp`),
  CONSTRAINT `fk_archivo_radica_salida_temp_responsa_gene_funcionarios_deta10` FOREIGN KEY (`id_funcio_deta`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3 COMMENT='Responsables de la correspondencia de entrada, salida y la correspondencia interna.';

/*Table structure for table `archivo_radica_enviados_temp_radica_respuesta` */

DROP TABLE IF EXISTS `archivo_radica_enviados_temp_radica_respuesta`;

CREATE TABLE `archivo_radica_enviados_temp_radica_respuesta` (
  `id_temp` INT NOT NULL,
  `id_radica` CHAR(20) DEFAULT NULL,
  KEY `fk_archivo_radica_enviados_temp_radica_respuesta_archivo_ra_idx` (`id_temp`),
  CONSTRAINT `fk_archivo_radica_enviados_temp_radica_respuesta_archivo_radi1` FOREIGN KEY (`id_temp`) REFERENCES `archivo_radica_enviados_temp` (`id_temp`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `archivo_radica_enviados_temp_responsa` */

DROP TABLE IF EXISTS `archivo_radica_enviados_temp_responsa`;

CREATE TABLE `archivo_radica_enviados_temp_responsa` (
  `id_temp` INT NOT NULL,
  `id_funcio_deta` INT NOT NULL,
  `fechor_asignado` DATETIME NOT NULL,
  `descargo_plantilla` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'Saber si el funcionario descargo la plantilla',
  `subio_plantilla` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'Saber si el funcionario subio la plantilla',
  `respon` TINYINT(1) NOT NULL DEFAULT '0',
  `aprobado` TINYINT(1) NOT NULL DEFAULT '0',
  `fechor_aprueba` DATETIME DEFAULT NULL,
  `editando` TINYINT(1) DEFAULT '0',
  KEY `fk_archivo_radica_salida_temp_responsa_archivo_radica_salid_idx` (`id_temp`),
  KEY `fk_archivo_radica_salida_temp_responsa_gene_funcionarios_de_idx` (`id_funcio_deta`),
  CONSTRAINT `fk_archivo_radica_salida_temp_responsa_archivo_radica_salida_1` FOREIGN KEY (`id_temp`) REFERENCES `archivo_radica_enviados_temp` (`id_temp`),
  CONSTRAINT `fk_archivo_radica_salida_temp_responsa_gene_funcionarios_deta1` FOREIGN KEY (`id_funcio_deta`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3 COMMENT='Responsables de la correspondencia de entrada, salida y la correspondencia interna.';

/*Table structure for table `archivo_radica_enviados_temp_version` */

DROP TABLE IF EXISTS `archivo_radica_enviados_temp_version`;

CREATE TABLE `archivo_radica_enviados_temp_version` (
  `id_version` INT NOT NULL,
  `id_temp` INT NOT NULL,
  `nom_version` CHAR(255) DEFAULT NULL,
  `id_funcio` INT DEFAULT NULL,
  `tipo_funcio` CHAR(20) DEFAULT NULL,
  PRIMARY KEY (`id_version`),
  KEY `fk_archivo_radica_enviados_temp_ver_archivo_radica_enviados_idx` (`id_temp`),
  CONSTRAINT `fk_archivo_radica_enviados_temp_ver_archivo_radica_enviados_t1` FOREIGN KEY (`id_temp`) REFERENCES `archivo_radica_enviados_temp` (`id_temp`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3 COMMENT='versiones de las plantillas temporales';

/*Table structure for table `archivo_radica_interna` */

DROP TABLE IF EXISTS `archivo_radica_interna`;

CREATE TABLE `archivo_radica_interna` (
  `id_radica` CHAR(30) NOT NULL,
  `id_serie` INT DEFAULT NULL,
  `id_subserie` INT DEFAULT NULL,
  `id_tipodoc` INT DEFAULT NULL,
  `id_funcio_regis` INT NOT NULL,
  `id_ruta` INT DEFAULT NULL,
  `fechor_radica` DATETIME DEFAULT NULL,
  `fec_docu` DATE DEFAULT NULL,
  `fec_venci` DATE DEFAULT NULL,
  `asunto` CHAR(250) DEFAULT NULL,
  `num_folio` INT DEFAULT NULL,
  `num_anexos` INT DEFAULT NULL,
  `observa_anexos` VARCHAR(500) DEFAULT NULL,
  `texto` TEXT,
  `adjunto` TINYINT(1) NOT NULL DEFAULT '0',
  `requie_respuesta` TINYINT(1) DEFAULT '0',
  `transferido` TINYINT(1) NOT NULL DEFAULT '0',
  `tipo_documento` CHAR(20) DEFAULT NULL COMMENT 'El tipo de documento se define por:\n\n* Apoyo: documento que va a pertenecer a la persona a la cual se le envía pero no va a tener clasificación documental, y se va a almacenar en el archivo de gestión de la oficina. y se guarda en carpeta documentos de Apoyo.\n\n*  Informativo: documento que solo van a poder visualizar las personas a las cual se les envía el documento pero que quedara almacenado en el archivo de gestión del propietario del documento este tipo de documento si requiere clasificación documental.\n\n*  Tramite: documento q va a tener clasificación documental y se crea una copia para cada destinatario y será almacenado en el archivo de gestión.\n',
  `radica_respuesta` CHAR(30) DEFAULT NULL,
  `impri_rotu` TINYINT(1) DEFAULT '0',
  `origen` CHAR(30) DEFAULT NULL,
  PRIMARY KEY (`id_radica`),
  KEY `fk_archivo_radica_interna_serie_idx` (`id_serie`),
  KEY `fk_archivo_radica_interna_sub_serie_idx` (`id_subserie`),
  KEY `fk_archivo_radica_interna_tipo_documento_idx` (`id_tipodoc`),
  KEY `fk_archivo_radica_interna_gene_funcionarios_deta1_idx` (`id_funcio_regis`),
  KEY `archivo_radica_interna_fec_radica` (`fechor_radica`),
  KEY `archivo_radica_interna_fec_venci` (`fec_venci`),
  FULLTEXT KEY `archivo_radica_interna_full_textos` (`asunto`,`texto`),
  CONSTRAINT `fk_archivo_radica_interna_gene_funcionarios_deta1` FOREIGN KEY (`id_funcio_regis`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`),
  CONSTRAINT `fk_archivo_radica_interna_serie` FOREIGN KEY (`id_serie`) REFERENCES `archivo_trd_series` (`id_serie`),
  CONSTRAINT `fk_archivo_radica_interna_sub_serie` FOREIGN KEY (`id_subserie`) REFERENCES `archivo_trd_subserie` (`id_subserie`),
  CONSTRAINT `fk_archivo_radica_interna_tipo_documento` FOREIGN KEY (`id_tipodoc`) REFERENCES `archivo_trd_tipo_docu` (`id_tipodoc`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `archivo_radica_interna_adjuntos` */

DROP TABLE IF EXISTS `archivo_radica_interna_adjuntos`;

CREATE TABLE `archivo_radica_interna_adjuntos` (
  `id_archivo` INT NOT NULL AUTO_INCREMENT,
  `id_radica` CHAR(30) NOT NULL,
  `nom_archivo` CHAR(150) DEFAULT NULL,
  PRIMARY KEY (`id_archivo`),
  KEY `fk_archivo_radica_interna_adjuntos_archivo_radica_interna1_idx` (`id_radica`),
  CONSTRAINT `fk_archivo_radica_interna_adjuntos_archivo_radica_interna1` FOREIGN KEY (`id_radica`) REFERENCES `archivo_radica_interna` (`id_radica`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `archivo_radica_interna_destinata` */

DROP TABLE IF EXISTS `archivo_radica_interna_destinata`;

CREATE TABLE `archivo_radica_interna_destinata` (
  `id_radica` CHAR(30) NOT NULL,
  `id_funcio_deta` INT NOT NULL,
  `fechor_leido` DATETIME DEFAULT NULL,
  `cc` TINYINT(1) DEFAULT '0' COMMENT 'Con copia',
  `leido` TINYINT(1) DEFAULT '0',
  KEY `fk_archivo_radica_interna_destinata_gene_funcionarios_deta1_idx` (`id_funcio_deta`),
  KEY `fk_archivo_radica_interna_destinata_archivo_radica_interna1_idx` (`id_radica`),
  CONSTRAINT `fk_archivo_radica_interna_destinata_archivo_radica_interna1` FOREIGN KEY (`id_radica`) REFERENCES `archivo_radica_interna` (`id_radica`),
  CONSTRAINT `fk_archivo_radica_interna_destinata_gene_funcionarios_deta1` FOREIGN KEY (`id_funcio_deta`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `archivo_radica_interna_proyectores` */

DROP TABLE IF EXISTS `archivo_radica_interna_proyectores`;

CREATE TABLE `archivo_radica_interna_proyectores` (
  `id_radica` CHAR(30) NOT NULL,
  `id_funcio_deta` INT NOT NULL,
  `fechor_asigna` DATETIME DEFAULT NULL,
  KEY `fk_archivo_radica_interna_proyectores_archivo_radica_intern_idx` (`id_radica`),
  KEY `fk_archivo_radica_interna_proyectores_gene_funcionarios_det_idx` (`id_funcio_deta`),
  CONSTRAINT `fk_archivo_radica_interna_proyectores_archivo_radica_interna1` FOREIGN KEY (`id_radica`) REFERENCES `archivo_radica_interna` (`id_radica`),
  CONSTRAINT `fk_archivo_radica_interna_proyectores_gene_funcionarios_deta1` FOREIGN KEY (`id_funcio_deta`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `archivo_radica_interna_responsa` */

DROP TABLE IF EXISTS `archivo_radica_interna_responsa`;

CREATE TABLE `archivo_radica_interna_responsa` (
  `id_radica` CHAR(30) NOT NULL,
  `id_funcio` INT NOT NULL,
  `respon` TINYINT(1) DEFAULT '0',
  KEY `fk_archivo_radica_entra_responsa_gene_funcionarios_deta1_idx1` (`id_funcio`),
  KEY `fk_archivo_radica_interna_responsa_archivo_radica_interna1_idx` (`id_radica`),
  CONSTRAINT `fk_archivo_radica_entra_responsa_gene_funcionarios_deta10` FOREIGN KEY (`id_funcio`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`),
  CONSTRAINT `fk_archivo_radica_interna_responsa_archivo_radica_interna1` FOREIGN KEY (`id_radica`) REFERENCES `archivo_radica_interna` (`id_radica`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3 COMMENT='Responsables de la correspondencia de entrada, salida y la correspondencia interna.';

/*Table structure for table `archivo_radica_recibido_compartidos` */

DROP TABLE IF EXISTS `archivo_radica_recibido_compartidos`;

CREATE TABLE `archivo_radica_recibido_compartidos` (
  `id_radica` VARCHAR(25) NOT NULL,
  `id_funcio_deta_origen` INT NOT NULL,
  `id_funcio_deta_destino` INT NOT NULL,
  `fechor_compartido` DATETIME DEFAULT NULL,
  `fechor_leido` DATETIME DEFAULT NULL,
  `ver` TINYINT(1) DEFAULT '1',
  KEY `fk_archivo_radica_recibido_compartir_archivo_radica_recibid_idx` (`id_radica`),
  KEY `fk_archivo_radica_recibido_compartir_gene_funcionarios_deta_idx` (`id_funcio_deta_origen`),
  KEY `fk_archivo_radica_recibido_compartir_gene_funcionarios_deta_idx1` (`id_funcio_deta_destino`),
  CONSTRAINT `fk_archivo_radica_recibido_compartir_archivo_radica_recibidos1` FOREIGN KEY (`id_radica`) REFERENCES `archivo_radica_recibidos` (`id_radica`),
  CONSTRAINT `fk_archivo_radica_recibido_compartir_gene_funcionarios_deta1` FOREIGN KEY (`id_funcio_deta_origen`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`),
  CONSTRAINT `fk_archivo_radica_recibido_compartir_gene_funcionarios_deta2` FOREIGN KEY (`id_funcio_deta_destino`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3 COMMENT='Tabla para compartir la informacion del radicado';

/*Table structure for table `archivo_radica_recibidos` */

DROP TABLE IF EXISTS `archivo_radica_recibidos`;

CREATE TABLE `archivo_radica_recibidos` (
  `id_radica` VARCHAR(25) NOT NULL,
  `id_serie` INT DEFAULT NULL,
  `id_subserie` INT DEFAULT NULL,
  `id_tipodoc` INT DEFAULT NULL,
  `id_usua_regis` INT DEFAULT NULL,
  `id_forma_llegada` INT NOT NULL,
  `id_remite` INT NOT NULL,
  `id_tipo_correspon` INT DEFAULT NULL,
  `id_ruta` INT DEFAULT NULL,
  `fechor_radica` DATETIME NOT NULL,
  `fec_docu` DATE DEFAULT NULL,
  `fec_venci` DATE DEFAULT NULL,
  `asunto` TEXT,
  `num_anexos` INT DEFAULT '0',
  `observa_anexo` VARCHAR(255) DEFAULT NULL,
  `num_folio` INT DEFAULT NULL,
  `requie_respues` TINYINT(1) DEFAULT '0',
  `impri_rotu` TINYINT(1) DEFAULT '0',
  `digital` TINYINT(1) NOT NULL DEFAULT '0',
  `fechor_impri_rotu` DATETIME DEFAULT NULL,
  `usua_impri_rotu` INT DEFAULT NULL,
  `radica_respuesta` CHAR(20) DEFAULT NULL,
  `respondido` TINYINT(1) DEFAULT '0',
  `transferido` TINYINT(1) DEFAULT '0' COMMENT 'El documento ya fue enviado al archivo de gestion',
  `estado` CHAR(10) DEFAULT NULL COMMENT 'son los estados del documeto, por ejemplo: documento en tramite, documento resulto.\\nT = Tramite\\nR = Resuelto\\nN = Ninguno\\nesto es solo para los documentos que requieren respuesta.',
  `proyector` TINYINT(1) DEFAULT '0',
  `observa_radica` TEXT,
  `autoriza` TINYINT(1) DEFAULT '0',
  `opcion_relacion` VARCHAR(45) DEFAULT NULL COMMENT 'dato para relacionar el nuevo radicado con el expediente',
  `opcion_titulo` VARCHAR(100) DEFAULT NULL,
  `opcion_sub_titulo` VARCHAR(200) DEFAULT NULL,
  `opcion_detalle1` VARCHAR(75) DEFAULT NULL,
  `opcion_detalle2` VARCHAR(75) DEFAULT NULL,
  `opcion_detalle3` VARCHAR(75) DEFAULT NULL,
  `archivo` VARCHAR(100) DEFAULT NULL,
  `pase` TINYINT(1) DEFAULT '0' COMMENT 'Estaplecer si el radicado se le hizo un pase',
  PRIMARY KEY (`id_radica`),
  KEY `fk_radica_externa_config_formaenvio1_idx` (`id_forma_llegada`),
  KEY `fk_radica_externa_usua_impri_rotulo_idx` (`usua_impri_rotu`),
  KEY `fk_archivo_radica_externa_segu_usua1_idx` (`id_usua_regis`),
  KEY `fk_archivo_radica_entra_archivo_trd_tipo_docu1_idx` (`id_tipodoc`),
  KEY `fk_archivo_radica_entra_archivo_trd_series1_idx` (`id_serie`),
  KEY `fk_archivo_radica_entra_archivo_trd_subserie1_idx` (`id_subserie`),
  KEY `archivo_radica_recibidos_fec_radica` (`fechor_radica`),
  KEY `archivo_radica_recibidos_digital` (`digital`),
  KEY `fk_archivo_radica_recibidos_gene_terceros_contac1_idx` (`id_remite`),
  KEY `fk_archivo_radica_recibidos_config_tipo_correspondencia1_idx` (`id_tipo_correspon`),
  KEY `fk_archivo_radica_recibidos_config_rutas_archi_gestion1_idx` (`id_ruta`),
  FULLTEXT KEY `archivo_radica_recibidos_asunto` (`asunto`),
  CONSTRAINT `fk_archivo_radica_entra_archivo_trd_series1` FOREIGN KEY (`id_serie`) REFERENCES `archivo_trd_series` (`id_serie`),
  CONSTRAINT `fk_archivo_radica_entra_archivo_trd_subserie1` FOREIGN KEY (`id_subserie`) REFERENCES `archivo_trd_subserie` (`id_subserie`),
  CONSTRAINT `fk_archivo_radica_entra_archivo_trd_tipo_docu1` FOREIGN KEY (`id_tipodoc`) REFERENCES `archivo_trd_tipo_docu` (`id_tipodoc`),
  CONSTRAINT `fk_archivo_radica_externa_segu_usua1` FOREIGN KEY (`id_usua_regis`) REFERENCES `segu_usua` (`id_usua`),
  CONSTRAINT `fk_archivo_radica_recibidos_config_rutas_archi_gestion1` FOREIGN KEY (`id_ruta`) REFERENCES `config_rutas_archi_gestion` (`id_ruta`),
  CONSTRAINT `fk_archivo_radica_recibidos_config_tipo_correspondencia1` FOREIGN KEY (`id_tipo_correspon`) REFERENCES `config_tipo_correspondencia` (`id_tipo`),
  CONSTRAINT `fk_archivo_radica_recibidos_gene_terceros_contac1` FOREIGN KEY (`id_remite`) REFERENCES `gene_terceros_contac` (`id_tercero`),
  CONSTRAINT `fk_radica_externa_config_formaenvio1` FOREIGN KEY (`id_forma_llegada`) REFERENCES `config_formaenvio` (`id_formaenvio`),
  CONSTRAINT `fk_radica_externa_usua_impri_rotulo` FOREIGN KEY (`usua_impri_rotu`) REFERENCES `segu_usua` (`id_usua`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `archivo_radica_recibidos_grupos_colaborativo` */

DROP TABLE IF EXISTS `archivo_radica_recibidos_grupos_colaborativo`;

CREATE TABLE `archivo_radica_recibidos_grupos_colaborativo` (
  `id_crea_grupo` INT NOT NULL AUTO_INCREMENT,
  `id_radica` VARCHAR(25) NOT NULL,
  `id_funcio_deta_asigno` INT NOT NULL,
  `id_funcio_deta_asingnado` INT NOT NULL,
  `fechor_asignado` DATETIME DEFAULT NULL,
  `fechor_realizado` DATETIME DEFAULT NULL,
  `observacion` TEXT,
  PRIMARY KEY (`id_crea_grupo`),
  KEY `fk_archivo_radica_recibidos_grupo_colaborativo_archivo_radi_idx` (`id_radica`),
  KEY `fk_archivo_radica_recibidos_grupo_colaborativo_gene_funcion_idx` (`id_funcio_deta_asingnado`),
  KEY `fk_archivo_radica_recibidos_grupo_colaborativo_gene_funcion_idx1` (`id_funcio_deta_asigno`),
  CONSTRAINT `fk_archivo_radica_recibidos_grupo_colaborativo_archivo_radica1` FOREIGN KEY (`id_radica`) REFERENCES `archivo_radica_recibidos` (`id_radica`),
  CONSTRAINT `fk_archivo_radica_recibidos_grupo_colaborativo_gene_funcionar1` FOREIGN KEY (`id_funcio_deta_asingnado`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`),
  CONSTRAINT `fk_archivo_radica_recibidos_grupo_colaborativo_gene_funcionar2` FOREIGN KEY (`id_funcio_deta_asigno`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3 COMMENT='Funcionario a los que se les asigna la ceacion de grupos colaborativos';

/*Table structure for table `archivo_radica_recibidos_hc` */

DROP TABLE IF EXISTS `archivo_radica_recibidos_hc`;

CREATE TABLE `archivo_radica_recibidos_hc` (
  `id_radica` VARCHAR(25) NOT NULL,
  `id_tercero_facul` INT DEFAULT NULL,
  `id_paren_tercero` INT DEFAULT NULL,
  `envio_email_tercero` TINYINT(1) DEFAULT '0',
  `envio_email_paciente` TINYINT(1) DEFAULT '0',
  `periodo_desde` DATE DEFAULT NULL,
  `periodo_hasta` DATE DEFAULT NULL,
  `servicio` CHAR(70) DEFAULT NULL,
  `estado` CHAR(30) DEFAULT NULL,
  `observa_entrega` TEXT,
  KEY `fk_archivo_radica_recibidos_hc_archivo_radica_recibidos1_idx` (`id_radica`),
  KEY `fk_archivo_radica_recibidos_hc_gene_remitentes_contac1_idx` (`id_tercero_facul`),
  CONSTRAINT `fk_archivo_radica_recibidos_hc_archivo_radica_recibidos1` FOREIGN KEY (`id_radica`) REFERENCES `archivo_radica_recibidos` (`id_radica`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `archivo_radica_recibidos_pase` */

DROP TABLE IF EXISTS `archivo_radica_recibidos_pase`;

CREATE TABLE `archivo_radica_recibidos_pase` (
  `id_pase` INT NOT NULL AUTO_INCREMENT,
  `id_radica` VARCHAR(25) NOT NULL,
  `id_funcio_deta_origen` INT NOT NULL,
  `fechor_pase` DATETIME DEFAULT NULL,
  `id_funcio_deta_destino` INT NOT NULL,
  `fehor_acepta` DATETIME DEFAULT NULL COMMENT 'Fecha y hora en la cuan el funcionario origen cambia la clasificacion documental',
  PRIMARY KEY (`id_pase`),
  KEY `fk_archivo_radica_recibidos_pase_gene_funcionarios_deta1_idx` (`id_funcio_deta_origen`),
  KEY `fk_archivo_radica_recibidos_pase_gene_funcionarios_deta2_idx` (`id_funcio_deta_destino`),
  KEY `fk_archivo_radica_recibidos_pase_archivo_radica_recibidos1_idx` (`id_radica`),
  CONSTRAINT `fk_archivo_radica_recibidos_pase_archivo_radica_recibidos1` FOREIGN KEY (`id_radica`) REFERENCES `archivo_radica_recibidos` (`id_radica`),
  CONSTRAINT `fk_archivo_radica_recibidos_pase_gene_funcionarios_deta1` FOREIGN KEY (`id_funcio_deta_origen`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`),
  CONSTRAINT `fk_archivo_radica_recibidos_pase_gene_funcionarios_deta2` FOREIGN KEY (`id_funcio_deta_destino`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `archivo_radica_recibidos_pqrsf` */

DROP TABLE IF EXISTS `archivo_radica_recibidos_pqrsf`;

CREATE TABLE `archivo_radica_recibidos_pqrsf` (
  `id_pqr` INT NOT NULL AUTO_INCREMENT,
  `id_contacto` INT NOT NULL,
  `id_radica` VARCHAR(25) NOT NULL,
  `id_tipo_docu_afectado` INT NOT NULL,
  `id_depar_afectado` INT NOT NULL,
  `id_muni_afectado` INT NOT NULL,
  `id_tipodocumental` INT NOT NULL,
  `id_regimen` INT NOT NULL,
  `num_docu_afectado` VARCHAR(25) DEFAULT NULL,
  `nom_afectado` VARCHAR(100) DEFAULT NULL,
  `dir_afectado` VARCHAR(150) DEFAULT NULL,
  `tel_afectado` CHAR(50) DEFAULT NULL,
  `movil_afectado` VARCHAR(30) DEFAULT NULL,
  `detalle_solicitud` TEXT,
  `fallo_judicial` CHAR(2) DEFAULT NULL,
  `fechor_tramite` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id_pqr`),
  KEY `fk_archivo_radica_pqr_archivo_radica_recibidos1_idx` (`id_radica`),
  KEY `fk_archivo_radica_pqr_config_tipo_documento1_idx` (`id_tipo_docu_afectado`),
  KEY `fk_archivo_radica_pqr_gene_terceros_contac1_idx` (`id_contacto`),
  KEY `fk_archivo_radica_pqr_config_depar1_idx` (`id_depar_afectado`),
  KEY `fk_archivo_radica_pqr_config_muni1_idx` (`id_muni_afectado`),
  KEY `fk_archivo_radica_recibidos_pqrsf_config_tipo_correspondenc_idx` (`id_tipodocumental`),
  CONSTRAINT `fk_archivo_radica_pqr_archivo_radica_recibidos1` FOREIGN KEY (`id_radica`) REFERENCES `archivo_radica_recibidos` (`id_radica`),
  CONSTRAINT `fk_archivo_radica_pqr_config_depar1` FOREIGN KEY (`id_depar_afectado`) REFERENCES `config_depar` (`id_depar`),
  CONSTRAINT `fk_archivo_radica_pqr_config_muni1` FOREIGN KEY (`id_muni_afectado`) REFERENCES `config_muni` (`id_muni`),
  CONSTRAINT `fk_archivo_radica_pqr_config_tipo_documento1` FOREIGN KEY (`id_tipo_docu_afectado`) REFERENCES `config_tipo_documento` (`id_tipo`),
  CONSTRAINT `fk_archivo_radica_pqr_gene_terceros_contac1` FOREIGN KEY (`id_contacto`) REFERENCES `gene_terceros_contac` (`id_tercero`),
  CONSTRAINT `fk_archivo_radica_recibidos_pqrsf_config_tipo_correspondencia1` FOREIGN KEY (`id_tipodocumental`) REFERENCES `config_tipo_correspondencia` (`id_tipo`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `archivo_radica_recibidos_pqrsf_archivos` */

DROP TABLE IF EXISTS `archivo_radica_recibidos_pqrsf_archivos`;

CREATE TABLE `archivo_radica_recibidos_pqrsf_archivos` (
  `id_pqr_archivo` INT NOT NULL AUTO_INCREMENT,
  `id_pqr` INT NOT NULL,
  `nom_archivo` VARCHAR(255) NOT NULL,
  `nom_temp_archivo` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id_pqr_archivo`),
  KEY `fk_archivo_radica_recibidos_pqrsf_archivos_archivo_radica_r_idx` (`id_pqr`),
  CONSTRAINT `fk_archivo_radica_recibidos_pqrsf_archivos_archivo_radica_rec1` FOREIGN KEY (`id_pqr`) REFERENCES `archivo_radica_recibidos_pqrsf` (`id_pqr`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `archivo_radica_recibidos_responsa` */

DROP TABLE IF EXISTS `archivo_radica_recibidos_responsa`;

CREATE TABLE `archivo_radica_recibidos_responsa` (
  `id_radica` VARCHAR(25) NOT NULL,
  `id_funcio` INT NOT NULL,
  `respon` TINYINT(1) DEFAULT '0',
  `leido` TINYINT(1) DEFAULT '0',
  `fechor_leido` DATETIME DEFAULT NULL,
  `elimina` TINYINT(1) DEFAULT '0',
  `respuesta` TINYINT(1) DEFAULT '0',
  `firma` TINYINT(1) DEFAULT '0' COMMENT 'Para saber si el documento lo firma esta persona',
  KEY `fk_radica_exter_destina_radica_extrerna1_idx` (`id_radica`),
  KEY `fk_archivo_radica_entra_responsa_gene_funcionarios_deta1_idx1` (`id_funcio`),
  CONSTRAINT `fk_archivo_radica_entra_responsa_gene_funcionarios_deta1` FOREIGN KEY (`id_funcio`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`),
  CONSTRAINT `fk_id_radicado_respon` FOREIGN KEY (`id_radica`) REFERENCES `archivo_radica_recibidos` (`id_radica`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3 COMMENT='Responsables de la correspondencia de entrada, salida y la correspondencia interna.';

/*Table structure for table `archivo_trd` */

DROP TABLE IF EXISTS `archivo_trd`;

CREATE TABLE `archivo_trd` (
  `id_trd` INT NOT NULL AUTO_INCREMENT,
  `id_depen` INT NOT NULL,
  `id_oficina` INT DEFAULT NULL,
  `id_serie` INT NOT NULL,
  `id_subserie` INT NOT NULL,
  `ag` INT NOT NULL,
  `ac` INT NOT NULL,
  `ct` TINYINT(1) NOT NULL DEFAULT '0',
  `e` TINYINT(1) NOT NULL DEFAULT '0',
  `dm` TINYINT(1) NOT NULL DEFAULT '0',
  `s` TINYINT(1) NOT NULL DEFAULT '0',
  `observa` TEXT,
  `acti` TINYINT(1) DEFAULT '1',
  PRIMARY KEY (`id_trd`),
  KEY `fk_archivo_trd_areas_dependencias1_idx963` (`id_depen`),
  KEY `fk_archivo_trd_archivo_trd_series1_idx0245` (`id_serie`),
  KEY `fk_archivo_trd_archivo_trd_subserie1_idx1458` (`id_subserie`),
  KEY `fk_archivo_trd_areas_oficinas1_idx` (`id_oficina`),
  CONSTRAINT `fk_archivo_trd_archivo_trd_series2531` FOREIGN KEY (`id_serie`) REFERENCES `archivo_trd_series` (`id_serie`),
  CONSTRAINT `fk_archivo_trd_archivo_trd_subserie00001` FOREIGN KEY (`id_subserie`) REFERENCES `archivo_trd_subserie` (`id_subserie`),
  CONSTRAINT `fk_archivo_trd_areas_dependencias8951` FOREIGN KEY (`id_depen`) REFERENCES `areas_dependencias` (`id_depen`),
  CONSTRAINT `fk_archivo_trd_areas_oficinas1` FOREIGN KEY (`id_oficina`) REFERENCES `areas_oficinas` (`id_oficina`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `archivo_trd_series` */

DROP TABLE IF EXISTS `archivo_trd_series`;

CREATE TABLE `archivo_trd_series` (
  `id_serie` INT NOT NULL AUTO_INCREMENT,
  `cod_serie` CHAR(15) NOT NULL,
  `nom_serie` VARCHAR(100) NOT NULL,
  `observa` TEXT,
  `acti` TINYINT(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_serie`),
  KEY `IndexSerie` (`nom_serie`)
) ENGINE=INNODB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb3 COMMENT='Los diferentes tipos de series existentes en las tablas de retencion documental de la entidad';

/*Table structure for table `archivo_trd_subserie` */

DROP TABLE IF EXISTS `archivo_trd_subserie`;

CREATE TABLE `archivo_trd_subserie` (
  `id_subserie` INT NOT NULL AUTO_INCREMENT,
  `cod_subserie` CHAR(15) DEFAULT NULL,
  `nom_subserie` CHAR(255) DEFAULT NULL,
  `acti` TINYINT(1) DEFAULT '1',
  PRIMARY KEY (`id_subserie`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `archivo_trd_subserie_docu` */

DROP TABLE IF EXISTS `archivo_trd_subserie_docu`;

CREATE TABLE `archivo_trd_subserie_docu` (
  `id_subserie` INT NOT NULL,
  `id_tipodoc` INT NOT NULL,
  `acti` TINYINT(1) DEFAULT '1',
  KEY `fk_archivo_trd_subserie_docu_archivo_trd_tipo_docu1_idx` (`id_tipodoc`),
  KEY `fk_archivo_trd_subserie_docu_archivo_trd_subserie1_idx` (`id_subserie`),
  CONSTRAINT `fk_archivo_trd_subserie_docu_archivo_trd_subserie1` FOREIGN KEY (`id_subserie`) REFERENCES `archivo_trd_subserie` (`id_subserie`),
  CONSTRAINT `fk_archivo_trd_subserie_docu_archivo_trd_tipo_docu1` FOREIGN KEY (`id_tipodoc`) REFERENCES `archivo_trd_tipo_docu` (`id_tipodoc`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3 COMMENT='Relaciono lo documentos que deben tener las subseries';

/*Table structure for table `archivo_trd_tipo_docu` */

DROP TABLE IF EXISTS `archivo_trd_tipo_docu`;

CREATE TABLE `archivo_trd_tipo_docu` (
  `id_tipodoc` INT NOT NULL AUTO_INCREMENT,
  `nom_tipodoc` CHAR(255) NOT NULL,
  `plantilla` CHAR(200) DEFAULT NULL,
  `observa` TEXT,
  `acti` TINYINT(1) DEFAULT '1',
  PRIMARY KEY (`id_tipodoc`),
  UNIQUE KEY `PK__Rete_TipoDoc__0425A276` (`id_tipodoc`)
) ENGINE=INNODB AUTO_INCREMENT=229 DEFAULT CHARSET=utf8mb3 COMMENT='Los diferentes tipos de documentos existentes en las tablas de retencion documental de la entidad';

/*Table structure for table `archivo_tvd` */

DROP TABLE IF EXISTS `archivo_tvd`;

CREATE TABLE `archivo_tvd` (
  `id_tvd` INT NOT NULL AUTO_INCREMENT,
  `id_depen` INT NOT NULL,
  `id_oficina` INT DEFAULT NULL,
  `id_serie` INT NOT NULL,
  `id_subserie` INT NOT NULL,
  `ag` INT NOT NULL,
  `ac` INT NOT NULL,
  `ct` TINYINT(1) NOT NULL DEFAULT '0',
  `e` TINYINT(1) NOT NULL DEFAULT '0',
  `dm` TINYINT(1) NOT NULL DEFAULT '0',
  `s` TINYINT(1) NOT NULL DEFAULT '0',
  `observa` TEXT,
  `acti` TINYINT(1) DEFAULT '1',
  PRIMARY KEY (`id_tvd`),
  KEY `fk_archivo_tvd_areas_dependencias_tvd1_idx` (`id_depen`),
  KEY `fk_archivo_tvd_areas_oficinas_tvd1_idx` (`id_oficina`),
  KEY `fk_archivo_tvd_archivo_tvd_series1_idx` (`id_serie`),
  KEY `fk_archivo_tvd_archivo_tvd_subserie1_idx` (`id_subserie`),
  CONSTRAINT `fk_archivo_tvd_archivo_tvd_series1` FOREIGN KEY (`id_serie`) REFERENCES `archivo_tvd_series` (`id_serie`),
  CONSTRAINT `fk_archivo_tvd_archivo_tvd_subserie1` FOREIGN KEY (`id_subserie`) REFERENCES `archivo_tvd_subserie` (`id_subserie`),
  CONSTRAINT `fk_archivo_tvd_areas_dependencias_tvd1` FOREIGN KEY (`id_depen`) REFERENCES `archivo_tvd_dependencias` (`id_depen`),
  CONSTRAINT `fk_archivo_tvd_areas_oficinas_tvd1` FOREIGN KEY (`id_oficina`) REFERENCES `archivo_tvd_oficinas` (`id_oficina`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `archivo_tvd_dependencias` */

DROP TABLE IF EXISTS `archivo_tvd_dependencias`;

CREATE TABLE `archivo_tvd_dependencias` (
  `id_depen` INT NOT NULL AUTO_INCREMENT,
  `cod_depen` VARCHAR(20) DEFAULT NULL,
  `cod_corres` VARCHAR(20) DEFAULT NULL,
  `nom_depen` VARCHAR(60) DEFAULT NULL,
  `observa` TEXT,
  `acti` TINYINT(1) DEFAULT '1',
  PRIMARY KEY (`id_depen`)
) ENGINE=INNODB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;

/*Table structure for table `archivo_tvd_oficinas` */

DROP TABLE IF EXISTS `archivo_tvd_oficinas`;

CREATE TABLE `archivo_tvd_oficinas` (
  `id_oficina` INT NOT NULL AUTO_INCREMENT,
  `id_depen` INT NOT NULL,
  `cod_oficina` VARCHAR(20) NOT NULL,
  `cod_corres` VARCHAR(20) NOT NULL,
  `nom_oficina` VARCHAR(200) NOT NULL,
  `observa` TEXT,
  `acti` TINYINT(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_oficina`),
  KEY `Config_Oficina_FKIndex1` (`id_depen`),
  CONSTRAINT `fk_areas_oficinas_dependencia0` FOREIGN KEY (`id_depen`) REFERENCES `archivo_tvd_dependencias` (`id_depen`)
) ENGINE=INNODB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb3;

/*Table structure for table `archivo_tvd_series` */

DROP TABLE IF EXISTS `archivo_tvd_series`;

CREATE TABLE `archivo_tvd_series` (
  `id_serie` INT NOT NULL AUTO_INCREMENT,
  `cod_serie` CHAR(15) NOT NULL,
  `nom_serie` VARCHAR(100) NOT NULL,
  `observa` TEXT,
  `acti` TINYINT(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_serie`),
  KEY `IndexSerie` (`nom_serie`)
) ENGINE=INNODB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb3 COMMENT='Los diferentes tipos de series existentes en las tablas de retencion documental de la entidad';

/*Table structure for table `archivo_tvd_subserie` */

DROP TABLE IF EXISTS `archivo_tvd_subserie`;

CREATE TABLE `archivo_tvd_subserie` (
  `id_subserie` INT NOT NULL AUTO_INCREMENT,
  `cod_subserie` CHAR(15) DEFAULT NULL,
  `nom_subserie` CHAR(255) DEFAULT NULL,
  `acti` TINYINT(1) DEFAULT '1',
  PRIMARY KEY (`id_subserie`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `archivo_tvd_subserie_docu` */

DROP TABLE IF EXISTS `archivo_tvd_subserie_docu`;

CREATE TABLE `archivo_tvd_subserie_docu` (
  `id_subserie` INT NOT NULL,
  `id_tipodoc` INT NOT NULL,
  `acti` TINYINT(1) DEFAULT '1',
  KEY `fk_archivo_trd_subserie_docu_archivo_trd_tipo_docu1_idx` (`id_tipodoc`),
  KEY `fk_archivo_trd_subserie_docu_archivo_trd_subserie1_idx` (`id_subserie`),
  CONSTRAINT `fk_archivo_trd_subserie_docu_archivo_trd_subserie10` FOREIGN KEY (`id_subserie`) REFERENCES `archivo_tvd_subserie` (`id_subserie`),
  CONSTRAINT `fk_archivo_trd_subserie_docu_archivo_trd_tipo_docu10` FOREIGN KEY (`id_tipodoc`) REFERENCES `archivo_tvd_tipo_docu` (`id_tipodoc`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3 COMMENT='Relaciono lo documentos que deben tener las subseries';

/*Table structure for table `archivo_tvd_tipo_docu` */

DROP TABLE IF EXISTS `archivo_tvd_tipo_docu`;

CREATE TABLE `archivo_tvd_tipo_docu` (
  `id_tipodoc` INT NOT NULL AUTO_INCREMENT,
  `nom_tipodoc` CHAR(255) NOT NULL,
  `plantilla` CHAR(200) DEFAULT NULL,
  `observa` TEXT,
  `acti` TINYINT(1) DEFAULT '1',
  PRIMARY KEY (`id_tipodoc`),
  UNIQUE KEY `PK__Rete_TipoDoc__0425A276` (`id_tipodoc`)
) ENGINE=INNODB AUTO_INCREMENT=229 DEFAULT CHARSET=utf8mb3 COMMENT='Los diferentes tipos de documentos existentes en las tablas de retencion documental de la entidad';

/*Table structure for table `areas_cargos` */

DROP TABLE IF EXISTS `areas_cargos`;

CREATE TABLE `areas_cargos` (
  `id_cargo` INT NOT NULL AUTO_INCREMENT,
  `id_depen` INT NOT NULL COMMENT 'Dependencia a la cual pertenece el cargo',
  `nom_cargo` VARCHAR(50) NOT NULL,
  `observa` TEXT,
  `acti` TINYINT(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_cargo`),
  KEY `fk_areas_cargos_areas_dependencias1_idx` (`id_depen`),
  CONSTRAINT `fk_areas_cargos_id_depen` FOREIGN KEY (`id_depen`) REFERENCES `areas_dependencias` (`id_depen`)
) ENGINE=INNODB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb3 COMMENT='Configuración de los cargos relacionados a una las diferentes dependencias';

/*Table structure for table `areas_dependencias` */

DROP TABLE IF EXISTS `areas_dependencias`;

CREATE TABLE `areas_dependencias` (
  `id_depen` INT NOT NULL AUTO_INCREMENT,
  `cod_depen` VARCHAR(20) DEFAULT NULL,
  `cod_corres` VARCHAR(20) DEFAULT NULL,
  `nom_depen` VARCHAR(60) DEFAULT NULL,
  `observa` TEXT,
  `acti` TINYINT(1) DEFAULT '1',
  PRIMARY KEY (`id_depen`)
) ENGINE=INNODB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3 COMMENT='Tabla para almacenar las diferentes dependencias de la institución';

/*Table structure for table `areas_expedientes` */

DROP TABLE IF EXISTS `areas_expedientes`;

CREATE TABLE `areas_expedientes` (
  `id_expe` INT NOT NULL AUTO_INCREMENT,
  `id_depen` INT NOT NULL,
  `id_oficina` INT DEFAULT NULL COMMENT 'oficina a la cual pertenece el expediente, Siempre y cuando la aplicación este configurada para ser utilizada con oficinas y sus respectivas dependencias',
  `id_serie` INT NOT NULL,
  `id_subserie` INT DEFAULT NULL COMMENT 'Sub serie a la cual pertenece el expetientes, Siempre y cuando la aplicación este configurada para ser utilizada con tablas de retención documental',
  `id_funcio_crea` INT(11) UNSIGNED ZEROFILL NOT NULL,
  `nom_expe` CHAR(100) DEFAULT NULL COMMENT 'Nombre dle expediente',
  `fechor_crea` DATETIME DEFAULT NULL COMMENT 'fecha y hora de creación del expediente',
  `jefe_depen` BIT(1) DEFAULT b'0' COMMENT 'Si el expediente es cerado por un jefe de dependencia',
  PRIMARY KEY (`id_expe`),
  KEY `fk_areas_expedientes_gene_funcionarios_deta1_idx` (`id_funcio_crea`),
  KEY `fk_areas_expedientes_archivo_trd_series1_idx` (`id_serie`),
  KEY `fk_areas_expedientes_areas_oficinas1_idx` (`id_oficina`),
  KEY `fk_areas_expedientes_areas_dependencias1_idx` (`id_depen`),
  KEY `fk_areas_expedientes_archivo_trd_subserie1_idx` (`id_subserie`),
  CONSTRAINT `fk_areas_expedientes_archivo_trd_series1` FOREIGN KEY (`id_serie`) REFERENCES `archivo_trd_series` (`id_serie`),
  CONSTRAINT `fk_areas_expedientes_archivo_trd_subserie1` FOREIGN KEY (`id_subserie`) REFERENCES `archivo_trd_subserie` (`id_subserie`),
  CONSTRAINT `fk_areas_expedientes_areas_dependencias1` FOREIGN KEY (`id_depen`) REFERENCES `areas_dependencias` (`id_depen`),
  CONSTRAINT `fk_areas_expedientes_areas_oficinas1` FOREIGN KEY (`id_oficina`) REFERENCES `areas_oficinas` (`id_oficina`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3 COMMENT='Tabla para almacenar los diferentes expedientes del archivo físico';

/*Table structure for table `areas_expedientes_deta` */

DROP TABLE IF EXISTS `areas_expedientes_deta`;

CREATE TABLE `areas_expedientes_deta` (
  `id_expe` INT NOT NULL,
  `id_funcio_agrega` INT(11) UNSIGNED ZEROFILL NOT NULL,
  `id_tipodoc` INT NOT NULL,
  `id_radica` CHAR(20) DEFAULT NULL,
  `fechor_agrega` DATETIME DEFAULT NULL,
  `origen` CHAR(10) DEFAULT NULL,
  KEY `fk_areas_expedientes_deta_areas_expedientes1_idx` (`id_expe`),
  KEY `fk_areas_expedientes_deta_archivo_rete_tipodoc1_idx` (`id_tipodoc`),
  KEY `fk_areas_expedientes_deta_gene_funcionarios_deta1_idx` (`id_funcio_agrega`),
  CONSTRAINT `fk_areas_expedientes_deta_archivo_rete_tipodoc1` FOREIGN KEY (`id_tipodoc`) REFERENCES `archivo_trd_tipo_docu` (`id_tipodoc`),
  CONSTRAINT `fk_areas_expedientes_deta_areas_expedientes1` FOREIGN KEY (`id_expe`) REFERENCES `areas_expedientes` (`id_expe`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `areas_oficinas` */

DROP TABLE IF EXISTS `areas_oficinas`;

CREATE TABLE `areas_oficinas` (
  `id_oficina` INT NOT NULL AUTO_INCREMENT,
  `id_depen` INT NOT NULL,
  `cod_oficina` VARCHAR(20) NOT NULL,
  `cod_corres` VARCHAR(20) NOT NULL,
  `nom_oficina` VARCHAR(200) NOT NULL,
  `observa` TEXT,
  `acti` TINYINT(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_oficina`),
  KEY `Config_Oficina_FKIndex1` (`id_depen`),
  CONSTRAINT `fk_areas_oficinas_dependencia` FOREIGN KEY (`id_depen`) REFERENCES `areas_dependencias` (`id_depen`)
) ENGINE=INNODB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb3 COMMENT='Tabla para almacenar las diferentes oficinas de la institución';

/*Table structure for table `cali_procedimientos` */

DROP TABLE IF EXISTS `cali_procedimientos`;

CREATE TABLE `cali_procedimientos` (
  `procedimiento_id` INT NOT NULL AUTO_INCREMENT,
  `proceso_id` INT NOT NULL COMMENT 'Proceso al cual pertenece el procedimientos',
  `cod_procedimiento` VARCHAR(45) NOT NULL COMMENT 'Codigo del procedimiento',
  `nom_procedimiento` VARCHAR(45) NOT NULL COMMENT 'Nombre del procedimientos',
  `estado` TINYINT(1) NOT NULL DEFAULT '1' COMMENT 'Estado del archivo 1 - Activo 2 - Inactivo',
  PRIMARY KEY (`procedimiento_id`),
  KEY `fk_cali_procesos_cali_macro_procesos1_idx` (`proceso_id`),
  CONSTRAINT `fk_cali_procesos_cali_macro_procesos1` FOREIGN KEY (`proceso_id`) REFERENCES `cali_procesos` (`proceso_id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3 COMMENT='Procedimientos adoptados por la institucion y aprobados por calidad';

/*Table structure for table `cali_procesos` */

DROP TABLE IF EXISTS `cali_procesos`;

CREATE TABLE `cali_procesos` (
  `proceso_id` INT NOT NULL AUTO_INCREMENT,
  `id_depen` INT NOT NULL COMMENT 'Id de la dependencia a la cual pertenece el proceso',
  `cod_proce` VARCHAR(45) NOT NULL COMMENT 'Codigo del procesos',
  `nom_proce` VARCHAR(45) NOT NULL COMMENT 'Nombre del procesos',
  `estado` TINYINT(1) NOT NULL DEFAULT '1' COMMENT 'Estado del archivo 1 - Activo 2 - Inactivo',
  PRIMARY KEY (`proceso_id`),
  KEY `fk_cali_macro_procesos_areas_dependencias1_idx` (`id_depen`),
  CONSTRAINT `fk_cali_procesos_areas_dependencias1` FOREIGN KEY (`id_depen`) REFERENCES `areas_dependencias` (`id_depen`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3 COMMENT='Procesos adoptados por la institucion y aprobados por calidad';

/*Table structure for table `cali_repositorio` */

DROP TABLE IF EXISTS `cali_repositorio`;

CREATE TABLE `cali_repositorio` (
  `archivo_id` INT NOT NULL AUTO_INCREMENT,
  `procedimiento_id` INT NOT NULL COMMENT 'Proceso al cual pertenece al archivo',
  `tipo_docu_id` INT NOT NULL COMMENT 'Tipo de documento de calidad',
  `id_ruta` INT DEFAULT NULL COMMENT 'Ruta en la cual se almacena el archivo, la ruta se actualiza despues de que el archivo es enviado al servidor FTP',
  `fechor_cargue` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha y hora de cargue del archivo',
  `nom_archivo_original` VARCHAR(150) DEFAULT NULL COMMENT 'Nombre original del archivo',
  `nom_archivo_unico` VARCHAR(70) DEFAULT NULL COMMENT 'Nombre unico del archivo',
  `estado` TINYINT(1) NOT NULL DEFAULT '1' COMMENT 'Estado del archivo 1 - Activo 2 - Inactivo',
  PRIMARY KEY (`archivo_id`),
  KEY `fk_cali_repositoriio_cali_procedimientos1_idx` (`procedimiento_id`),
  KEY `fk_cali_repositorio_cali_tipos_documentos1_idx` (`tipo_docu_id`),
  KEY `fk_cali_repositorio_config_rutas_archi_calidad1_idx` (`id_ruta`),
  CONSTRAINT `fk_cali_repositoriio_cali_procedimientos1` FOREIGN KEY (`procedimiento_id`) REFERENCES `cali_procedimientos` (`procedimiento_id`),
  CONSTRAINT `fk_cali_repositorio_cali_tipos_documentos1` FOREIGN KEY (`tipo_docu_id`) REFERENCES `cali_tipos_documentos` (`tipo_docu_id`),
  CONSTRAINT `fk_cali_repositorio_config_rutas_archi_calidad1` FOREIGN KEY (`id_ruta`) REFERENCES `config_rutas_archi_calidad` (`id_ruta`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3 COMMENT='Repositorio para el almacenamiento de los archivos aprobados por calidad y para que esten disponibles para que los funcionarios los puedan consultar';

/*Table structure for table `cali_tipos_documentos` */

DROP TABLE IF EXISTS `cali_tipos_documentos`;

CREATE TABLE `cali_tipos_documentos` (
  `tipo_docu_id` INT NOT NULL AUTO_INCREMENT,
  `nom_tipo_documento` VARCHAR(100) NOT NULL COMMENT 'Nombre del tipo de documento de calidad',
  `estado` TINYINT(1) NOT NULL DEFAULT '1' COMMENT 'Estado del archivo 1 - Activo 2 - Inactivo',
  PRIMARY KEY (`tipo_docu_id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3 COMMENT='Tipos de documentos adoptados por la oficina de calidad Ejp: Guias, Manuales, Instrucctivos, Procedimientos etc.';

/*Table structure for table `config_depar` */

DROP TABLE IF EXISTS `config_depar`;

CREATE TABLE `config_depar` (
  `id_depar` INT NOT NULL,
  `nom_depar` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id_depar`)
) ENGINE=INNODB DEFAULT CHARSET=latin1;

/*Table structure for table `config_despedida` */

DROP TABLE IF EXISTS `config_despedida`;

CREATE TABLE `config_despedida` (
  `id_despedida` INT NOT NULL AUTO_INCREMENT,
  `despedida` CHAR(200) DEFAULT NULL,
  `acti` TINYINT(1) DEFAULT '0',
  PRIMARY KEY (`id_despedida`)
) ENGINE=INNODB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

/*Table structure for table `config_empresa` */

DROP TABLE IF EXISTS `config_empresa`;

CREATE TABLE `config_empresa` (
  `nit` VARCHAR(20) NOT NULL,
  `razo_soci` VARCHAR(100) DEFAULT NULL,
  `slogan` VARCHAR(100) DEFAULT NULL,
  `id_depar` INT DEFAULT NULL,
  `id_muni` INT DEFAULT NULL,
  `dir` VARCHAR(50) DEFAULT NULL,
  `tel` VARCHAR(50) DEFAULT NULL,
  `fax` CHAR(30) DEFAULT NULL,
  `cel` CHAR(30) DEFAULT NULL,
  `email` CHAR(200) DEFAULT NULL,
  `web` CHAR(50) DEFAULT NULL,
  `logo` CHAR(100) DEFAULT NULL,
  PRIMARY KEY (`nit`),
  KEY `fk_config_empresa_config_depar1_idx` (`id_depar`),
  KEY `fk_config_empresa_config_muni1_idx` (`id_muni`),
  CONSTRAINT `fk_config_empresa_config_depar1` FOREIGN KEY (`id_depar`) REFERENCES `config_depar` (`id_depar`),
  CONSTRAINT `fk_config_empresa_config_muni1` FOREIGN KEY (`id_muni`) REFERENCES `config_muni` (`id_muni`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `config_formaenvio` */

DROP TABLE IF EXISTS `config_formaenvio`;

CREATE TABLE `config_formaenvio` (
  `id_formaenvio` INT NOT NULL AUTO_INCREMENT,
  `nom_formaenvi` VARCHAR(50) NOT NULL,
  `observa` TEXT,
  `requie_digital` TINYINT(1) DEFAULT '0',
  `acti` TINYINT(1) DEFAULT '1',
  PRIMARY KEY (`id_formaenvio`)
) ENGINE=INNODB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

/*Table structure for table `config_muni` */

DROP TABLE IF EXISTS `config_muni`;

CREATE TABLE `config_muni` (
  `id_muni` INT NOT NULL,
  `id_depar` INT NOT NULL,
  `nom_muni` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id_muni`),
  KEY `id_depar` (`id_depar`),
  CONSTRAINT `config_muni_ibfk_1` FOREIGN KEY (`id_depar`) REFERENCES `config_depar` (`id_depar`)
) ENGINE=INNODB DEFAULT CHARSET=latin1;

/*Table structure for table `config_origen_correspondencia` */

DROP TABLE IF EXISTS `config_origen_correspondencia`;

CREATE TABLE `config_origen_correspondencia` (
  `id_origen` INT NOT NULL AUTO_INCREMENT,
  `nom_origen` VARCHAR(45) DEFAULT NULL,
  PRIMARY KEY (`id_origen`)
) ENGINE=INNODB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

/*Table structure for table `config_otras` */

DROP TABLE IF EXISTS `config_otras`;

CREATE TABLE `config_otras` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `corres_recibida_titulo` CHAR(100) DEFAULT NULL COMMENT 'Titulo para la plantilla de las comunicaciones recibidas aprobado por calidad',
  `corres_recibida_subtitulo` CHAR(100) DEFAULT NULL COMMENT 'Sub Titulo para la plantilla de las comunicaciones recibidas aprobado por calidad',
  `corres_recibida_codigo` CHAR(30) DEFAULT NULL COMMENT 'Código para la plantilla de las comunicaciones recibidas aprobado por calidad',
  `corres_recibida_version` CHAR(30) DEFAULT NULL COMMENT 'Versión para la plantilla de las comunicaciones recibidas aprobado por calidad',
  `corres_enviada_titulo` CHAR(100) DEFAULT NULL COMMENT 'Titulo para la plantilla de las comunicaciones enviadas aprobado por calidad',
  `corres_enviada_subtitulo` CHAR(100) DEFAULT NULL COMMENT 'Sub Titulo para la plantilla de las comunicaciones enviadas aprobado por calidad',
  `corres_enviada_codigo` CHAR(30) DEFAULT NULL COMMENT 'Código para la plantilla de las comunicaciones enviadas aprobado por calidad',
  `corres_enviada_version` CHAR(30) DEFAULT NULL COMMENT 'Versión para la plantilla de las comunicaciones enviadas aprobado por calidad',
  `corres_interna_titulo` VARCHAR(45) DEFAULT NULL COMMENT 'Titulo para la plantilla de las comunicaciones internas aprobado por calidad',
  `corres_interna_subtitulo` VARCHAR(45) DEFAULT NULL COMMENT 'Sub Titulo para la plantilla de las comunicaciones internas aprobado por calidad',
  `corres_interna_codigo` VARCHAR(45) DEFAULT NULL COMMENT 'Código para la plantilla de las comunicaciones internas aprobado por calidad',
  `corres_interna_version` VARCHAR(45) DEFAULT NULL COMMENT 'Versión para la plantilla de las comunicaciones internas aprobado por calidad',
  `planti_correspondencia` CHAR(100) DEFAULT NULL COMMENT 'Almacena la ruta y el nombre de la plantiall de comunicaciones oficiales',
  `tipo_radica_recibida` CHAR(1) DEFAULT NULL COMMENT 'Establece cual es el formato del número de radicado de las comunicaciones recibidas\n\n1. Radicado con fecha y consecutivo\n2. Radicado con codigo de dependencia fecha y consecutivo\n3. Radicado con codigo de dependencia y consecutivo',
  `tipo_radica_enviado` CHAR(1) DEFAULT NULL COMMENT 'Establece cual es el formato del número de radicado de las comunicaciones enviadas\n\n1. Radicado con fecha y consecutivo\n2. Radicado con codigo de dependencia fecha y consecutivo\n3. Radicado con codigo de dependencia y consecutivo',
  `tipo_radica_interno` CHAR(1) DEFAULT NULL COMMENT 'Establece cual es el formato del número de radicado de las comunicaciones internas\n\n1. Radicado con fecha y consecutivo\n2. Radicado con codigo de dependencia fecha y consecutivo\n3. Radicado con codigo de dependencia y consecutivo',
  `tipo_impre_torulo` TINYBLOB COMMENT 'Establece la forma de impresión del rotulo\n\n1 impresora térmica\n2 documento físico',
  `incluir_trd` BIT(1) DEFAULT NULL,
  `incluir_oficina_trd` INT DEFAULT NULL COMMENT 'La aplicación estará habilitada para incluir las oficinas cuando se estén configurando las tablas de retención documental\n\n1 no incluye oficinas\n2 si uncluye oficinas',
  `email_ventanilla_usuario` VARCHAR(45) DEFAULT NULL COMMENT 'Configuración del email que se va a utilizar para el envió de las notificaciones',
  `email_ventanilla_contra` VARCHAR(45) DEFAULT NULL COMMENT 'Configuración de la contraseña del email que se va a utilizar para el envió de las notificaciones',
  `mail_ventanilla_servidor` VARCHAR(45) DEFAULT NULL COMMENT 'Configuración del servidor del email que se va a utilizar para el envió de las notificaciones\n\nSMPT o otros',
  `email_ventanilla_puerto` VARCHAR(45) DEFAULT NULL COMMENT 'Configuración del puerto del email que se va a utilizar para el envió de las notificaciones\n',
  `email_ventanilla_autenti` VARCHAR(5) DEFAULT NULL COMMENT 'Configuración del tipo de autenticacion del email que se va a utilizar para el envió de las notificaciones\nSSH o otro\n',
  PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COMMENT='Tabla para almacenar la configuración general de la aplicación';

/*Table structure for table `config_otras_responsables_pqrsf` */

DROP TABLE IF EXISTS `config_otras_responsables_pqrsf`;

CREATE TABLE `config_otras_responsables_pqrsf` (
  `id_funcio_deta` INT NOT NULL,
  `id_depen` INT NOT NULL,
  `id_serie` INT NOT NULL,
  `id_subserie` INT NOT NULL,
  `id_tipodoc` INT NOT NULL,
  KEY `fk_config_otras_hc_responsables_gene_funcionarios_deta1_idx` (`id_funcio_deta`),
  KEY `fk_config_otras_hc_responsables_areas_dependencias1_idx` (`id_depen`),
  KEY `fk_config_otras_hc_responsables_archivo_trd_series1_idx` (`id_serie`),
  KEY `fk_config_otras_hc_responsables_archivo_trd_subserie1_idx` (`id_subserie`),
  KEY `fk_config_otras_hc_responsables_archivo_trd_tipo_docu1_idx` (`id_tipodoc`),
  CONSTRAINT `fk_config_otras_hc_responsables_archivo_trd_series10` FOREIGN KEY (`id_serie`) REFERENCES `archivo_trd_series` (`id_serie`),
  CONSTRAINT `fk_config_otras_hc_responsables_archivo_trd_subserie10` FOREIGN KEY (`id_subserie`) REFERENCES `archivo_trd_subserie` (`id_subserie`),
  CONSTRAINT `fk_config_otras_hc_responsables_archivo_trd_tipo_docu10` FOREIGN KEY (`id_tipodoc`) REFERENCES `archivo_trd_tipo_docu` (`id_tipodoc`),
  CONSTRAINT `fk_config_otras_hc_responsables_areas_dependencias10` FOREIGN KEY (`id_depen`) REFERENCES `areas_dependencias` (`id_depen`),
  CONSTRAINT `fk_config_otras_hc_responsables_gene_funcionarios_deta10` FOREIGN KEY (`id_funcio_deta`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `config_rutas_archi_calidad` */

DROP TABLE IF EXISTS `config_rutas_archi_calidad`;

CREATE TABLE `config_rutas_archi_calidad` (
  `id_ruta` INT NOT NULL AUTO_INCREMENT,
  `ip` VARCHAR(100) NOT NULL,
  `ruta` VARCHAR(200) NOT NULL COMMENT 'Ruta o carpeta para almacednar los archivos',
  `usua` CHAR(45) NOT NULL COMMENT 'Usuario del servidor',
  `contra` CHAR(45) NOT NULL COMMENT 'Contraseña del usuario',
  `observa` TEXT COMMENT 'Observaciones si las hay',
  `acti` TINYINT(1) NOT NULL DEFAULT '1' COMMENT 'Estado activo o inactivo',
  PRIMARY KEY (`id_ruta`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3 COMMENT='Tabal para almacenar la configuración del servidor para los archivos de calidad';

/*Table structure for table `config_rutas_archi_digitalizados` */

DROP TABLE IF EXISTS `config_rutas_archi_digitalizados`;

CREATE TABLE `config_rutas_archi_digitalizados` (
  `id_ruta` INT NOT NULL AUTO_INCREMENT,
  `servidor` VARCHAR(100) NOT NULL COMMENT 'Ip del servidor',
  `ruta` VARCHAR(200) NOT NULL COMMENT 'Ruta o carpeta para almacenar los archivos',
  `usua` CHAR(45) DEFAULT NULL COMMENT 'Usuario del servidor',
  `contra` CHAR(45) DEFAULT NULL COMMENT 'Contraseña del usuario',
  `observa` TEXT COMMENT 'Observaciones si las hay',
  `tipo` VARCHAR(45) DEFAULT NULL COMMENT 'Establecer la ruta de almacenamiento para los expediente con TRD o TVD',
  `acti` TINYINT(1) NOT NULL DEFAULT '1' COMMENT 'Estado activo o inactivo',
  PRIMARY KEY (`id_ruta`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3 COMMENT='Tabal para almacenar la configuración del servidor para los espadientes del modulo de digitalizacion';

/*Table structure for table `config_rutas_archi_gestion` */

DROP TABLE IF EXISTS `config_rutas_archi_gestion`;

CREATE TABLE `config_rutas_archi_gestion` (
  `id_ruta` INT NOT NULL AUTO_INCREMENT,
  `id_depen` INT NOT NULL,
  `ip` VARCHAR(100) NOT NULL,
  `ruta` VARCHAR(200) NOT NULL COMMENT 'Ruta o carpeta para almacenar los archivos',
  `usua` CHAR(45) DEFAULT NULL COMMENT 'Usuario del servidor',
  `contra` CHAR(45) DEFAULT NULL COMMENT 'Contraseña del usuario',
  `observa` TEXT COMMENT 'Observaciones si las hay',
  `acti` TINYINT(1) NOT NULL DEFAULT '1' COMMENT 'Estado activo o inactivo',
  PRIMARY KEY (`id_ruta`),
  KEY `fk_config_rutas_archivos_gesti_areas_dependencias1_idx` (`id_depen`),
  CONSTRAINT `fk_config_rutas_archi_gestion_id_depen` FOREIGN KEY (`id_depen`) REFERENCES `areas_dependencias` (`id_depen`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3 COMMENT='Tabal para almacenar la configuración del servidor para los archivos que se encuentran en gestion';

/*Table structure for table `config_rutas_archi_temp` */

DROP TABLE IF EXISTS `config_rutas_archi_temp`;

CREATE TABLE `config_rutas_archi_temp` (
  `id_ruta` INT NOT NULL AUTO_INCREMENT,
  `ip` VARCHAR(100) NOT NULL,
  `ruta` VARCHAR(200) NOT NULL,
  `usua` CHAR(45) DEFAULT NULL,
  `contra` CHAR(45) DEFAULT NULL,
  `tipo_correspon` VARCHAR(45) DEFAULT NULL COMMENT 'Tipo de correspondencia\n1. Correspondencia recibida\n2. Correspondencia enviada\n3. Correspondencia interna',
  `observa` TEXT,
  `acti` TINYINT(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_ruta`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `config_saludo` */

DROP TABLE IF EXISTS `config_saludo`;

CREATE TABLE `config_saludo` (
  `id_saludo` INT NOT NULL AUTO_INCREMENT,
  `saludo` CHAR(200) DEFAULT NULL,
  `acti` TINYINT(1) DEFAULT '1',
  PRIMARY KEY (`id_saludo`)
) ENGINE=INNODB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

/*Table structure for table `config_status` */

DROP TABLE IF EXISTS `config_status`;

CREATE TABLE `config_status` (
  `id_status` INT NOT NULL AUTO_INCREMENT,
  `status` VARCHAR(45) DEFAULT NULL,
  `acti` TINYINT(1) DEFAULT '0',
  PRIMARY KEY (`id_status`)
) ENGINE=INNODB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

/*Table structure for table `config_tipo_correspondencia` */

DROP TABLE IF EXISTS `config_tipo_correspondencia`;

CREATE TABLE `config_tipo_correspondencia` (
  `id_tipo` INT NOT NULL AUTO_INCREMENT,
  `id_origen` INT NOT NULL,
  `nom_tipo` VARCHAR(45) DEFAULT NULL,
  `acti` TINYINT(1) DEFAULT '1',
  `ver_radicar` TINYINT(1) DEFAULT NULL,
  PRIMARY KEY (`id_tipo`),
  KEY `fk_config_tipo_correspondencia_config_tipos_origen1_idx` (`id_origen`),
  CONSTRAINT `fk_config_tipo_correspondencia_config_tipos_origen1` FOREIGN KEY (`id_origen`) REFERENCES `config_origen_correspondencia` (`id_origen`)
) ENGINE=INNODB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

/*Table structure for table `config_tipo_documento` */

DROP TABLE IF EXISTS `config_tipo_documento`;

CREATE TABLE `config_tipo_documento` (
  `id_tipo` INT NOT NULL AUTO_INCREMENT,
  `cod_tipo` VARCHAR(45) NOT NULL,
  `nom_tipo` CHAR(100) NOT NULL,
  `acti` TINYINT(1) DEFAULT '1',
  PRIMARY KEY (`id_tipo`)
) ENGINE=INNODB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;

/*Table structure for table `config_tipos_respuestas` */

DROP TABLE IF EXISTS `config_tipos_respuestas`;

CREATE TABLE `config_tipos_respuestas` (
  `id_respue` INT NOT NULL AUTO_INCREMENT,
  `nom_respues` VARCHAR(45) DEFAULT NULL,
  `acti` TINYINT(1) DEFAULT '1',
  PRIMARY KEY (`id_respue`)
) ENGINE=INNODB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

/*Table structure for table `gene_entidades` */

DROP TABLE IF EXISTS `gene_entidades`;

CREATE TABLE `gene_entidades` (
  `id_enti` INT NOT NULL,
  `nit` CHAR(20) DEFAULT NULL,
  `razo_soci` CHAR(50) DEFAULT NULL,
  `dir` CHAR(50) DEFAULT NULL,
  PRIMARY KEY (`id_enti`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3 COMMENT='Entidades que esta relacionadas directamente con la entidad principal. Eje. Temporales que administran la nomina de las personas que laboran en la entidad principal';

/*Table structure for table `gene_funcionarios` */

DROP TABLE IF EXISTS `gene_funcionarios`;

CREATE TABLE `gene_funcionarios` (
  `id_funcio` INT NOT NULL AUTO_INCREMENT,
  `id_muni` INT DEFAULT NULL,
  `id_depar` INT DEFAULT NULL,
  `jefe_dependencia` TINYINT(1) DEFAULT NULL,
  `jefe_oficina` TINYINT(1) DEFAULT NULL,
  `crea_expedien` TINYINT(1) DEFAULT NULL,
  `puede_firmar` TINYINT(1) DEFAULT NULL,
  `propie_princi` TINYINT(1) DEFAULT NULL,
  `cod_funcio` VARCHAR(15) DEFAULT NULL,
  `nom_funcio` VARCHAR(30) DEFAULT NULL,
  `ape_funcio` VARCHAR(30) DEFAULT NULL,
  `genero` CHAR(1) DEFAULT NULL,
  `dir` VARCHAR(50) DEFAULT NULL,
  `tel` VARCHAR(15) DEFAULT NULL,
  `cel` VARCHAR(15) DEFAULT NULL,
  `email` VARCHAR(50) DEFAULT NULL,
  `observa` TEXT,
  `firma` VARCHAR(45) DEFAULT NULL,
  `foto` VARCHAR(45) DEFAULT NULL,
  `acti` TINYINT(1) DEFAULT '1',
  PRIMARY KEY (`id_funcio`),
  KEY `Admin_Funcionario_FKIndex2` (`id_depar`),
  KEY `Admin_Funcionario_FKIndex3` (`id_muni`),
  CONSTRAINT `admin_funcionario_ibfk_2` FOREIGN KEY (`id_depar`) REFERENCES `config_depar` (`id_depar`),
  CONSTRAINT `admin_funcionario_ibfk_3` FOREIGN KEY (`id_muni`) REFERENCES `config_muni` (`id_muni`)
) ENGINE=INNODB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb3;

/*Table structure for table `gene_funcionarios_deta` */

DROP TABLE IF EXISTS `gene_funcionarios_deta`;

CREATE TABLE `gene_funcionarios_deta` (
  `id_funcio_deta` INT NOT NULL AUTO_INCREMENT,
  `id_funcio` INT NOT NULL,
  `id_oficina` INT DEFAULT NULL,
  `id_cargo` INT DEFAULT NULL,
  `acti` TINYINT(1) DEFAULT '1',
  PRIMARY KEY (`id_funcio_deta`),
  KEY `fk_table1_admin_funcionario1_idx` (`id_funcio`),
  KEY `fk_table1_areas_oficinas1_idx` (`id_oficina`),
  KEY `fk_admin_fincionario_deta_areas_cargos1_idx` (`id_cargo`),
  CONSTRAINT `gene_funcionarios_deta_cargo` FOREIGN KEY (`id_cargo`) REFERENCES `areas_cargos` (`id_cargo`),
  CONSTRAINT `gene_funcionarios_deta_id_funcio` FOREIGN KEY (`id_funcio`) REFERENCES `gene_funcionarios` (`id_funcio`),
  CONSTRAINT `gene_funcionarios_deta_oficina` FOREIGN KEY (`id_oficina`) REFERENCES `areas_oficinas` (`id_oficina`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `gene_funcionarios_digitales` */

DROP TABLE IF EXISTS `gene_funcionarios_digitales`;

CREATE TABLE `gene_funcionarios_digitales` (
  `id_funcio_deta` INT NOT NULL,
  `id_serie` INT NOT NULL,
  `id_subserie` INT NOT NULL,
  `id_depen` INT NOT NULL,
  KEY `fk_gene_funcionarios_digitales_gene_funcionarios_deta1_idx` (`id_funcio_deta`),
  KEY `fk_gene_funcionarios_digitales_archivo_trd_series1_idx` (`id_serie`),
  KEY `fk_gene_funcionarios_digitales_archivo_trd_subserie1_idx` (`id_subserie`),
  KEY `fk_gene_funcionarios_digitales_areas_dependencias1_idx` (`id_depen`),
  CONSTRAINT `fk_gene_funcionarios_digitales_archivo_trd_series1` FOREIGN KEY (`id_serie`) REFERENCES `archivo_trd_series` (`id_serie`),
  CONSTRAINT `fk_gene_funcionarios_digitales_archivo_trd_subserie1` FOREIGN KEY (`id_subserie`) REFERENCES `archivo_trd_subserie` (`id_subserie`),
  CONSTRAINT `fk_gene_funcionarios_digitales_areas_dependencias1` FOREIGN KEY (`id_depen`) REFERENCES `areas_dependencias` (`id_depen`),
  CONSTRAINT `fk_gene_funcionarios_digitales_gene_funcionarios_deta1` FOREIGN KEY (`id_funcio_deta`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `gene_terceros_contac` */

DROP TABLE IF EXISTS `gene_terceros_contac`;

CREATE TABLE `gene_terceros_contac` (
  `id_tercero` INT NOT NULL AUTO_INCREMENT,
  `id_empre` INT DEFAULT NULL,
  `id_depar` INT DEFAULT NULL,
  `id_muni` INT DEFAULT NULL,
  `id_grupo_etnico` INT DEFAULT NULL,
  `id_condi_tercero` INT DEFAULT NULL,
  `id_tipo_docu` INT DEFAULT NULL,
  `num_docu` CHAR(20) DEFAULT NULL,
  `nom_contac` VARCHAR(70) DEFAULT NULL,
  `cargo` CHAR(50) DEFAULT NULL,
  `dir` VARCHAR(255) DEFAULT NULL,
  `tel` VARCHAR(15) DEFAULT NULL,
  `cel` VARCHAR(15) DEFAULT NULL,
  `fax` VARCHAR(15) DEFAULT NULL,
  `email` VARCHAR(50) DEFAULT NULL,
  `password` VARCHAR(150) DEFAULT NULL,
  `acti` TINYINT(1) DEFAULT '1',
  PRIMARY KEY (`id_tercero`),
  KEY `fk_gene_terceros_contac_gene_terceros_empresas1_idx` (`id_empre`),
  KEY `fk_gene_terceros_contac_config_depar1_idx` (`id_depar`),
  KEY `fk_gene_terceros_contac_config_muni1_idx` (`id_muni`),
  KEY `fk_gene_terceros_contac_config_tipo_documento1_idx` (`id_tipo_docu`),
  CONSTRAINT `fk_gene_terceros_contac_config_depar1` FOREIGN KEY (`id_depar`) REFERENCES `config_depar` (`id_depar`),
  CONSTRAINT `fk_gene_terceros_contac_config_muni1` FOREIGN KEY (`id_muni`) REFERENCES `config_muni` (`id_muni`),
  CONSTRAINT `fk_gene_terceros_contac_config_tipo_documento1` FOREIGN KEY (`id_tipo_docu`) REFERENCES `config_tipo_documento` (`id_tipo`),
  CONSTRAINT `fk_gene_terceros_contac_gene_terceros_empresas1` FOREIGN KEY (`id_empre`) REFERENCES `gene_terceros_empresas` (`id_empre`)
) ENGINE=INNODB AUTO_INCREMENT=298 DEFAULT CHARSET=utf8mb3;

/*Table structure for table `gene_terceros_empresas` */

DROP TABLE IF EXISTS `gene_terceros_empresas`;

CREATE TABLE `gene_terceros_empresas` (
  `id_empre` INT NOT NULL AUTO_INCREMENT,
  `id_depar` INT DEFAULT NULL,
  `id_muni` INT DEFAULT NULL,
  `nit_empre` CHAR(15) DEFAULT NULL,
  `razo_soci` CHAR(60) DEFAULT NULL,
  `dir` CHAR(255) DEFAULT NULL,
  `tel` CHAR(20) DEFAULT NULL,
  `cel` CHAR(20) DEFAULT NULL,
  `fax` CHAR(20) DEFAULT NULL,
  `email` CHAR(50) DEFAULT NULL,
  `web` CHAR(50) DEFAULT NULL,
  PRIMARY KEY (`id_empre`),
  KEY `fk_gene_remitentes_empresas_config_depar1_idx` (`id_depar`),
  KEY `fk_gene_remitentes_empresas_config_muni1_idx` (`id_muni`),
  CONSTRAINT `fk_gene_remitentes_empresas_config_depar1` FOREIGN KEY (`id_depar`) REFERENCES `config_depar` (`id_depar`),
  CONSTRAINT `fk_gene_remitentes_empresas_config_muni1` FOREIGN KEY (`id_muni`) REFERENCES `config_muni` (`id_muni`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `notifica_email_externa` */

DROP TABLE IF EXISTS `notifica_email_externa`;

CREATE TABLE `notifica_email_externa` (
  `id_notifica` INT NOT NULL AUTO_INCREMENT,
  `id_usua_registra` INT NOT NULL,
  `id_funcio_deta` INT NOT NULL,
  `fechor_notifica` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `titulo` VARCHAR(200) DEFAULT NULL,
  `notificacion` VARCHAR(500) DEFAULT NULL,
  `id_radica` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) DEFAULT NULL,
  PRIMARY KEY (`id_notifica`),
  KEY `fk_notifica_externa_gene_funcionarios_deta1_idx` (`id_funcio_deta`),
  KEY `fk_notifica_email_externa_segu_usua1_idx` (`id_usua_registra`),
  CONSTRAINT `fk_notifica_email_externa_segu_usua_1` FOREIGN KEY (`id_usua_registra`) REFERENCES `segu_usua` (`id_usua`),
  CONSTRAINT `fk_notifica_externa_gene_funcionarios_deta_10` FOREIGN KEY (`id_funcio_deta`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `notifica_externa` */

DROP TABLE IF EXISTS `notifica_externa`;

CREATE TABLE `notifica_externa` (
  `id_notifica` INT NOT NULL AUTO_INCREMENT,
  `id_funcio_deta` INT NOT NULL,
  `fechor_notifica` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechor_visto` DATETIME DEFAULT NULL,
  `titulo` VARCHAR(200) DEFAULT NULL,
  `notificacion` VARCHAR(500) DEFAULT NULL,
  `id_radica` VARCHAR(45) NOT NULL,
  `prioridad` INT DEFAULT NULL COMMENT '1 Baja color info\n2 Media color danger\n3 Alta ',
  PRIMARY KEY (`id_notifica`),
  KEY `fk_notifica_externa_gene_funcionarios_deta1_idx` (`id_funcio_deta`),
  CONSTRAINT `fk_notifica_externa_gene_funcionarios_deta1` FOREIGN KEY (`id_funcio_deta`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `notifica_interna` */

DROP TABLE IF EXISTS `notifica_interna`;

CREATE TABLE `notifica_interna` (
  `id_notifica` INT NOT NULL AUTO_INCREMENT,
  `id_funcio_deta` INT NOT NULL,
  `fechor_notifica` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechor_visto` DATETIME DEFAULT NULL,
  `titulo` VARCHAR(200) DEFAULT NULL,
  `notificacion` VARCHAR(500) DEFAULT NULL,
  `id_radica` VARCHAR(45) NOT NULL,
  `prioridad` INT NOT NULL DEFAULT '1' COMMENT '1. Baja color azul\n1. Media color amarillo ''radicados que estan prontos a vence''\n2. alta color rojo ''radicados que estan vencidos''',
  PRIMARY KEY (`id_notifica`),
  KEY `fk_notifica_interna_gene_funcionarios_deta1_idx` (`id_funcio_deta`),
  CONSTRAINT `fk_notifica_interna_gene_funcionarios_deta1` FOREIGN KEY (`id_funcio_deta`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `segu_log` */

DROP TABLE IF EXISTS `segu_log`;

CREATE TABLE `segu_log` (
  `id_usua` INT NOT NULL,
  `modulo` VARCHAR(70) DEFAULT NULL,
  `fechor_regis` DATETIME NOT NULL,
  `equipo` VARCHAR(50) NOT NULL,
  `ip` VARCHAR(12) DEFAULT NULL,
  `accion` CHAR(20) NOT NULL COMMENT 'Agregar\nEditar\nEliminar\nImprimir\nAprobar\nDescargar\nSubir\nVisualizar',
  `detalle` VARCHAR(300) DEFAULT NULL,
  KEY `id_usua` (`id_usua`),
  CONSTRAINT `fk_segu_log_Usua` FOREIGN KEY (`id_usua`) REFERENCES `segu_usua` (`id_usua`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `segu_modu` */

DROP TABLE IF EXISTS `segu_modu`;

CREATE TABLE `segu_modu` (
  `id_modu` INT NOT NULL AUTO_INCREMENT,
  `nom_modu` VARCHAR(50) NOT NULL,
  `menu` VARCHAR(50) DEFAULT NULL,
  `boton` CHAR(60) DEFAULT NULL,
  `link` VARCHAR(300) DEFAULT NULL,
  `acti` TINYINT(1) DEFAULT '1',
  PRIMARY KEY (`id_modu`),
  UNIQUE KEY `PK__Segu_Modu__25DB9BFC` (`id_modu`)
) ENGINE=INNODB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb3;

/*Table structure for table `segu_perfiles` */

DROP TABLE IF EXISTS `segu_perfiles`;

CREATE TABLE `segu_perfiles` (
  `id_perfil` INT NOT NULL AUTO_INCREMENT,
  `nom_perfil` VARCHAR(30) DEFAULT NULL,
  `observa` TEXT,
  `acti` TINYINT(1) DEFAULT NULL,
  PRIMARY KEY (`id_perfil`),
  UNIQUE KEY `PK__Segu_Perfiles__23F3538A` (`id_perfil`)
) ENGINE=INNODB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb3;

/*Table structure for table `segu_perfiles_deta` */

DROP TABLE IF EXISTS `segu_perfiles_deta`;

CREATE TABLE `segu_perfiles_deta` (
  `id_perfil` INT NOT NULL,
  `id_modu` INT NOT NULL,
  `acti` TINYINT(1) DEFAULT NULL,
  KEY `fk_segu_perfiles_deta_segu_perfiles1_idx` (`id_perfil`),
  KEY `fk_segu_perfiles_deta_segu_modu1_idx` (`id_modu`),
  CONSTRAINT `fk_segu_perfiles_deta_segu_modu1` FOREIGN KEY (`id_modu`) REFERENCES `segu_modu` (`id_modu`),
  CONSTRAINT `fk_segu_perfiles_deta_segu_perfiles1` FOREIGN KEY (`id_perfil`) REFERENCES `segu_perfiles` (`id_perfil`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `segu_sesiones` */

DROP TABLE IF EXISTS `segu_sesiones`;

CREATE TABLE `segu_sesiones` (
  `id_sesion` INT NOT NULL AUTO_INCREMENT,
  `id_usua` INT NOT NULL,
  `fechor_inicio` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `fechor_fin` DATETIME NOT NULL,
  `acti` TINYINT(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_sesion`),
  KEY `fk_segu_sesiones_segu_usua1_idx` (`id_usua`),
  CONSTRAINT `fk_segu_sesiones_segu_usua1` FOREIGN KEY (`id_usua`) REFERENCES `segu_usua` (`id_usua`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `segu_usua` */

DROP TABLE IF EXISTS `segu_usua`;

CREATE TABLE `segu_usua` (
  `id_usua` INT NOT NULL AUTO_INCREMENT,
  `id_funcio` INT NOT NULL,
  `login` VARCHAR(30) NOT NULL,
  `contra` VARCHAR(70) NOT NULL,
  `acti` TINYINT(1) NOT NULL DEFAULT '1',
  `cambio_contra` TINYINT(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_usua`),
  KEY `fk_segu_usua_gene_funcionarios1_idx` (`id_funcio`),
  CONSTRAINT `fk_segu_usua_gene_funcionarios1` FOREIGN KEY (`id_funcio`) REFERENCES `gene_funcionarios` (`id_funcio`)
) ENGINE=INNODB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

/*Table structure for table `segu_usuadeta` */

DROP TABLE IF EXISTS `segu_usuadeta`;

CREATE TABLE `segu_usuadeta` (
  `id_perfil` INT NOT NULL,
  `id_usua` INT NOT NULL,
  `acti` TINYINT(1) NOT NULL,
  KEY `FK__Segu_Usua__id_pe__324172E1` (`id_perfil`),
  KEY `FK_Segu_UsuaDeta_Segu_Usua` (`id_usua`),
  CONSTRAINT `segu_usuadeta_ibfk_1` FOREIGN KEY (`id_perfil`) REFERENCES `segu_perfiles` (`id_perfil`),
  CONSTRAINT `segu_usuadeta_id_usua` FOREIGN KEY (`id_usua`) REFERENCES `segu_usua` (`id_usua`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `temp_adjuntos` */

DROP TABLE IF EXISTS `temp_adjuntos`;

CREATE TABLE `temp_adjuntos` (
  `id_usua` INT NOT NULL,
  `archivo` CHAR(150) DEFAULT NULL,
  KEY `fk_temp_adjuntos_segu_usua1_idx` (`id_usua`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3;
