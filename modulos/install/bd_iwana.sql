-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 20-08-2024 a las 12:29:59
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `iwana_bd_new`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_digitales_trd`
--

CREATE TABLE `archivo_digitales_trd` (
  `id_digital` int NOT NULL,
  `id_depen` int NOT NULL,
  `id_oficina` int DEFAULT NULL,
  `id_serie` int NOT NULL,
  `id_subserie` int NOT NULL,
  `fechor_regis` datetime DEFAULT CURRENT_TIMESTAMP,
  `codigo` varchar(45) DEFAULT NULL,
  `titulo` varchar(45) DEFAULT NULL,
  `fec_ini` varchar(45) DEFAULT NULL,
  `fec_fin` varchar(45) DEFAULT NULL,
  `criterio1` varchar(45) DEFAULT NULL,
  `criterio2` varchar(45) DEFAULT NULL,
  `criterio3` varchar(45) DEFAULT NULL,
  `deposito` char(40) DEFAULT NULL,
  `caja` char(5) DEFAULT NULL,
  `carpeta` char(5) DEFAULT NULL,
  `folios` int DEFAULT '0',
  `acti` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_digitales_trd_detalle`
--

CREATE TABLE `archivo_digitales_trd_detalle` (
  `id_archivo` int NOT NULL,
  `id_digital` int NOT NULL,
  `id_tomo` int NOT NULL,
  `id_ruta` int NOT NULL,
  `id_tipodoc` int DEFAULT NULL,
  `archivo` varchar(255) DEFAULT NULL,
  `folios` int DEFAULT '0',
  `detalle` varchar(255) DEFAULT NULL,
  `fecha` char(20) DEFAULT NULL,
  `fec_registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `tipo` varchar(45) DEFAULT NULL COMMENT 'el tipo de archivo especifica si el archivo es subido como un todo o son archivos dela lista de checkeo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_digitales_trd_tomos`
--

CREATE TABLE `archivo_digitales_trd_tomos` (
  `id_tomo` int NOT NULL,
  `id_digital` int NOT NULL,
  `nom_tomo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_digitales_tvd`
--

CREATE TABLE `archivo_digitales_tvd` (
  `id_digital` int NOT NULL,
  `id_depen` int NOT NULL,
  `id_oficina` int DEFAULT NULL,
  `id_serie` int NOT NULL,
  `id_subserie` int NOT NULL,
  `fechor_regis` datetime DEFAULT CURRENT_TIMESTAMP,
  `codigo` varchar(45) DEFAULT NULL,
  `titulo` varchar(45) DEFAULT NULL,
  `fec_ini` varchar(45) DEFAULT NULL,
  `fec_fin` varchar(45) DEFAULT NULL,
  `criterio1` varchar(45) DEFAULT NULL,
  `criterio2` varchar(45) DEFAULT NULL,
  `criterio3` varchar(45) DEFAULT NULL,
  `deposito` char(40) DEFAULT NULL,
  `caja` char(5) DEFAULT NULL,
  `carpeta` char(5) DEFAULT NULL,
  `folios` int DEFAULT '0',
  `acti` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_digitales_tvd_detalle`
--

CREATE TABLE `archivo_digitales_tvd_detalle` (
  `id_archivo` int NOT NULL,
  `id_digital` int NOT NULL,
  `id_tomo` int NOT NULL,
  `id_ruta` int NOT NULL,
  `id_tipodoc` int DEFAULT NULL,
  `archivo` varchar(255) DEFAULT NULL,
  `folios` int DEFAULT '0',
  `detalle` varchar(255) DEFAULT NULL,
  `fecha` char(20) DEFAULT NULL,
  `fec_registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `tipo` varchar(45) DEFAULT NULL COMMENT 'el tipo de archivo especifica si el archivo es subido como un todo o son archivos dela lista de checkeo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_digitales_tvd_tomos`
--

CREATE TABLE `archivo_digitales_tvd_tomos` (
  `id_tomo` int NOT NULL,
  `id_digital` int NOT NULL,
  `nom_tomo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_radica_enviados`
--

CREATE TABLE `archivo_radica_enviados` (
  `id_radica` varchar(25) NOT NULL,
  `id_destina` int NOT NULL,
  `id_serie` int DEFAULT NULL COMMENT 'cuando la correspondencia va de lo interno a lo externo el id_remite se convierte en destinatario.\ncuando la correspondencia externa asia la interna el id_remite se convierte ne remitente.',
  `id_subserie` int DEFAULT NULL,
  `id_tipodoc` int NOT NULL,
  `id_usua_regis` int NOT NULL,
  `id_formaenvio` int NOT NULL,
  `id_tipo_respue` int NOT NULL DEFAULT '1',
  `id_ruta` int DEFAULT NULL,
  `fec_docu` date DEFAULT NULL,
  `fechor_radica` datetime NOT NULL,
  `asunto` text,
  `num_folio` int DEFAULT '0',
  `num_anexos` char(5) DEFAULT '0',
  `observa_anexo` varchar(255) DEFAULT NULL,
  `digital` tinyint(1) NOT NULL DEFAULT '0',
  `adjunto` tinyint(1) NOT NULL DEFAULT '0',
  `impri_rotu` tinyint(1) DEFAULT '0',
  `fechor_impri_rotu` datetime DEFAULT NULL,
  `usua_impri_rotu` int DEFAULT NULL,
  `impri_docu` tinyint(1) DEFAULT '0',
  `id_radica_repues` char(20) DEFAULT NULL,
  `enviado` tinyint(1) DEFAULT '0',
  `trasnferido` tinyint(1) DEFAULT '0' COMMENT 'Saber si el archivo fue transferido del temporal de la oficina al archivo de gestion de la dependencia a un expediente',
  `num_guia` char(50) DEFAULT NULL,
  `texto` text,
  `opcion_relacion` varchar(200) DEFAULT NULL,
  `opcion_titulo` varchar(200) DEFAULT NULL,
  `opcion_sub_titulo` varchar(200) DEFAULT NULL,
  `opcion_detalle1` varchar(200) DEFAULT NULL,
  `opcion_detalle2` varchar(200) DEFAULT NULL,
  `opcion_detalle3` varchar(200) DEFAULT NULL,
  `archivo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_radica_enviados_archivos`
--

CREATE TABLE `archivo_radica_enviados_archivos` (
  `id_archivo` int NOT NULL,
  `id_radica` varchar(25) NOT NULL,
  `nom_archivo` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_radica_enviados_proyector`
--

CREATE TABLE `archivo_radica_enviados_proyector` (
  `id_radica` varchar(25) NOT NULL,
  `id_funcio_deta` int NOT NULL,
  `fechor_asigna` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_radica_enviados_quienes_firman`
--

CREATE TABLE `archivo_radica_enviados_quienes_firman` (
  `id_radica` char(25) NOT NULL,
  `id_funcio_deta` int NOT NULL,
  `firma_principal` tinyint(1) DEFAULT '0' COMMENT 'Funcionario principla que firma la correspondencia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_radica_enviados_responsa`
--

CREATE TABLE `archivo_radica_enviados_responsa` (
  `id_radica` varchar(25) NOT NULL,
  `id_funcio_deta` int NOT NULL,
  `respon` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='Responsables de la correspondencia de entrada, salida y la correspondencia interna.';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_radica_enviados_respuestas`
--

CREATE TABLE `archivo_radica_enviados_respuestas` (
  `id_radica_enviado` varchar(25) NOT NULL,
  `id_radica_recivido` varchar(25) NOT NULL,
  `id_usua_regis` int NOT NULL,
  `fechor_regis` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='Relacion de los radicados enviados que son respuesta de los radicados recibidos';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_radica_enviados_temp`
--

CREATE TABLE `archivo_radica_enviados_temp` (
  `id_temp` int NOT NULL,
  `id_serie` int DEFAULT NULL,
  `id_subserie` int DEFAULT NULL,
  `id_tipodoc` int DEFAULT NULL,
  `id_usua_regis` int NOT NULL,
  `id_despedida` int DEFAULT NULL,
  `id_status` int DEFAULT NULL,
  `id_saludo` int DEFAULT NULL,
  `id_destina` int NOT NULL,
  `id_ruta` int DEFAULT NULL,
  `fechor_registro` datetime DEFAULT NULL,
  `asunto` text,
  `con_copia` varchar(300) DEFAULT NULL,
  `anexos` varchar(300) DEFAULT NULL,
  `adjunto` tinyint(1) DEFAULT '0',
  `terminado` tinyint(1) DEFAULT '0',
  `existen_proyectores` tinyint(1) DEFAULT '0' COMMENT 'Identificar si el documento tiene proyectores. ',
  `nom_archivo` char(255) DEFAULT NULL,
  `genera_plantilla` tinyint(1) DEFAULT '0' COMMENT 'Saber si ya se genero la plantilla',
  `plantilla_cargada` tinyint(1) DEFAULT '0',
  `radicado` tinyint(1) DEFAULT '0' COMMENT 'saber si el registro temporan ya se radico',
  `anulado` tinyint(1) DEFAULT '0',
  `id_funcio_deta_anula` int DEFAULT NULL,
  `fechor_anula` datetime DEFAULT NULL,
  `id_radicado` char(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_radica_enviados_temp_nota`
--

CREATE TABLE `archivo_radica_enviados_temp_nota` (
  `id_nota` int NOT NULL,
  `id_temp` int NOT NULL,
  `id_funcio_deta` int NOT NULL,
  `fechor_nota` datetime NOT NULL,
  `nota` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='versionamiento de los archivos de os radicados temporales';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_radica_enviados_temp_proyector`
--

CREATE TABLE `archivo_radica_enviados_temp_proyector` (
  `id_temp` int NOT NULL,
  `id_funcio_deta` int NOT NULL,
  `fechor_asigna` datetime DEFAULT NULL,
  `descargo_plantilla` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Saber si el funcionario descargo la plantilla',
  `subio_plantilla` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Saber si el funcionario subio la plantilla',
  `editando` tinyint(1) NOT NULL DEFAULT '0',
  `terminado` tinyint(1) NOT NULL DEFAULT '0',
  `fechor_termina` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_radica_enviados_temp_quienes_firman`
--

CREATE TABLE `archivo_radica_enviados_temp_quienes_firman` (
  `id_temp` int NOT NULL,
  `id_funcio_deta` int NOT NULL,
  `fechor_asignado` datetime NOT NULL,
  `descargo_plantilla` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Saber si el funcionario descargo la plantilla',
  `subio_plantilla` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Saber si el funcionario subio la plantilla',
  `firma_principal` tinyint(1) NOT NULL DEFAULT '0',
  `firmando` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'saber si el documento ya fue firmado por el documento',
  `fechor_firmado` datetime DEFAULT NULL,
  `firmado` tinyint(1) DEFAULT '0' COMMENT 'saber si el documento esta siendo firmado por el funcionario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='Responsables de la correspondencia de entrada, salida y la correspondencia interna.';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_radica_enviados_temp_radica_respuesta`
--

CREATE TABLE `archivo_radica_enviados_temp_radica_respuesta` (
  `id_temp` int NOT NULL,
  `id_radica` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_radica_enviados_temp_responsa`
--

CREATE TABLE `archivo_radica_enviados_temp_responsa` (
  `id_temp` int NOT NULL,
  `id_funcio_deta` int NOT NULL,
  `fechor_asignado` datetime NOT NULL,
  `descargo_plantilla` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Saber si el funcionario descargo la plantilla',
  `subio_plantilla` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Saber si el funcionario subio la plantilla',
  `respon` tinyint(1) NOT NULL DEFAULT '0',
  `aprobado` tinyint(1) NOT NULL DEFAULT '0',
  `fechor_aprueba` datetime DEFAULT NULL,
  `editando` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='Responsables de la correspondencia de entrada, salida y la correspondencia interna.';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_radica_enviados_temp_version`
--

CREATE TABLE `archivo_radica_enviados_temp_version` (
  `id_version` int NOT NULL,
  `id_temp` int NOT NULL,
  `nom_version` char(255) DEFAULT NULL,
  `id_funcio` int DEFAULT NULL,
  `tipo_funcio` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='versiones de las plantillas temporales';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_radica_interna`
--

CREATE TABLE `archivo_radica_interna` (
  `id_radica` char(30) NOT NULL,
  `id_serie` int DEFAULT NULL,
  `id_subserie` int DEFAULT NULL,
  `id_tipodoc` int DEFAULT NULL,
  `id_funcio_regis` int NOT NULL,
  `id_ruta` int DEFAULT NULL,
  `fechor_radica` datetime DEFAULT NULL,
  `fec_docu` date DEFAULT NULL,
  `fec_venci` date DEFAULT NULL,
  `asunto` char(250) DEFAULT NULL,
  `num_folio` int DEFAULT NULL,
  `num_anexos` int DEFAULT NULL,
  `observa_anexos` varchar(500) DEFAULT NULL,
  `texto` text,
  `adjunto` tinyint(1) NOT NULL DEFAULT '0',
  `requie_respuesta` tinyint(1) DEFAULT '0',
  `transferido` tinyint(1) NOT NULL DEFAULT '0',
  `tipo_documento` char(20) DEFAULT NULL COMMENT 'El tipo de documento se define por:\n\n* Apoyo: documento que va a pertenecer a la persona a la cual se le envía pero no va a tener clasificación documental, y se va a almacenar en el archivo de gestión de la oficina. y se guarda en carpeta documentos de Apoyo.\n\n*  Informativo: documento que solo van a poder visualizar las personas a las cual se les envía el documento pero que quedara almacenado en el archivo de gestión del propietario del documento este tipo de documento si requiere clasificación documental.\n\n*  Tramite: documento q va a tener clasificación documental y se crea una copia para cada destinatario y será almacenado en el archivo de gestión.\n',
  `radica_respuesta` char(30) DEFAULT NULL,
  `impri_rotu` tinyint(1) DEFAULT '0',
  `origen` char(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_radica_interna_adjuntos`
--

CREATE TABLE `archivo_radica_interna_adjuntos` (
  `id_archivo` int NOT NULL,
  `id_radica` char(30) NOT NULL,
  `nom_archivo` char(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_radica_interna_destinata`
--

CREATE TABLE `archivo_radica_interna_destinata` (
  `id_radica` char(30) NOT NULL,
  `id_funcio_deta` int NOT NULL,
  `fechor_leido` datetime DEFAULT NULL,
  `cc` tinyint(1) DEFAULT '0' COMMENT 'Con copia',
  `leido` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_radica_interna_proyectores`
--

CREATE TABLE `archivo_radica_interna_proyectores` (
  `id_radica` char(30) NOT NULL,
  `id_funcio_deta` int NOT NULL,
  `fechor_asigna` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_radica_interna_responsa`
--

CREATE TABLE `archivo_radica_interna_responsa` (
  `id_radica` char(30) NOT NULL,
  `id_funcio` int NOT NULL,
  `respon` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='Responsables de la correspondencia de entrada, salida y la correspondencia interna.';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_radica_recibidos`
--

CREATE TABLE `archivo_radica_recibidos` (
  `id_radica` varchar(25) NOT NULL,
  `id_serie` int DEFAULT NULL,
  `id_subserie` int DEFAULT NULL,
  `id_tipodoc` int DEFAULT NULL,
  `id_usua_regis` int DEFAULT NULL,
  `id_forma_llegada` int NOT NULL,
  `id_remite` int NOT NULL,
  `id_tipo_correspon` int DEFAULT NULL,
  `id_ruta` int DEFAULT NULL,
  `fechor_radica` datetime NOT NULL,
  `fec_docu` date DEFAULT NULL,
  `fec_venci` date DEFAULT NULL,
  `asunto` text,
  `num_anexos` int DEFAULT '0',
  `observa_anexo` varchar(255) DEFAULT NULL,
  `num_folio` int DEFAULT NULL,
  `requie_respues` tinyint(1) DEFAULT '0',
  `impri_rotu` tinyint(1) DEFAULT '0',
  `digital` tinyint(1) NOT NULL DEFAULT '0',
  `fechor_impri_rotu` datetime DEFAULT NULL,
  `usua_impri_rotu` int DEFAULT NULL,
  `radica_respuesta` char(20) DEFAULT NULL,
  `respondido` tinyint(1) DEFAULT '0',
  `transferido` tinyint(1) DEFAULT '0' COMMENT 'El documento ya fue enviado al archivo de gestion',
  `estado` char(10) DEFAULT NULL COMMENT 'son los estados del documeto, por ejemplo: documento en tramite, documento resulto.\\nT = Tramite\\nR = Resuelto\\nN = Ninguno\\nesto es solo para los documentos que requieren respuesta.',
  `proyector` tinyint(1) DEFAULT '0',
  `observa_radica` text,
  `autoriza` tinyint(1) DEFAULT '0',
  `opcion_relacion` varchar(45) DEFAULT NULL COMMENT 'dato para relacionar el nuevo radicado con el expediente',
  `opcion_titulo` varchar(100) DEFAULT NULL,
  `opcion_sub_titulo` varchar(200) DEFAULT NULL,
  `opcion_detalle1` varchar(75) DEFAULT NULL,
  `opcion_detalle2` varchar(75) DEFAULT NULL,
  `opcion_detalle3` varchar(75) DEFAULT NULL,
  `archivo` varchar(100) DEFAULT NULL,
  `pase` tinyint(1) DEFAULT '0' COMMENT 'Estaplecer si el radicado se le hizo un pase'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_radica_recibidos_grupos_colaborativo`
--

CREATE TABLE `archivo_radica_recibidos_grupos_colaborativo` (
  `id_crea_grupo` int NOT NULL,
  `id_radica` varchar(25) NOT NULL,
  `id_funcio_deta_asigno` int NOT NULL,
  `id_funcio_deta_asingnado` int NOT NULL,
  `fechor_asignado` datetime DEFAULT NULL,
  `fechor_realizado` datetime DEFAULT NULL,
  `observacion` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='Funcionario a los que se les asigna la ceacion de grupos colaborativos';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_radica_recibidos_hc`
--

CREATE TABLE `archivo_radica_recibidos_hc` (
  `id_radica` varchar(25) NOT NULL,
  `id_tercero_facul` int DEFAULT NULL,
  `id_paren_tercero` int DEFAULT NULL,
  `envio_email_tercero` tinyint(1) DEFAULT '0',
  `envio_email_paciente` tinyint(1) DEFAULT '0',
  `periodo_desde` date DEFAULT NULL,
  `periodo_hasta` date DEFAULT NULL,
  `servicio` char(70) DEFAULT NULL,
  `estado` char(30) DEFAULT NULL,
  `observa_entrega` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_radica_recibidos_pase`
--

CREATE TABLE `archivo_radica_recibidos_pase` (
  `id_pase` int NOT NULL,
  `id_radica` varchar(25) NOT NULL,
  `id_funcio_deta_origen` int NOT NULL,
  `fechor_pase` datetime DEFAULT NULL,
  `id_funcio_deta_destino` int NOT NULL,
  `fehor_acepta` datetime DEFAULT NULL COMMENT 'Fecha y hora en la cuan el funcionario origen cambia la clasificacion documental'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_radica_recibidos_pqrsf`
--

CREATE TABLE `archivo_radica_recibidos_pqrsf` (
  `id_pqr` int NOT NULL,
  `id_contacto` int NOT NULL,
  `id_radica` varchar(25) NOT NULL,
  `id_tipo_docu_afectado` int NOT NULL,
  `id_depar_afectado` int NOT NULL,
  `id_muni_afectado` int NOT NULL,
  `id_tipodocumental` int NOT NULL,
  `id_regimen` int NOT NULL,
  `num_docu_afectado` varchar(25) DEFAULT NULL,
  `nom_afectado` varchar(100) DEFAULT NULL,
  `dir_afectado` varchar(150) DEFAULT NULL,
  `tel_afectado` char(50) DEFAULT NULL,
  `movil_afectado` varchar(30) DEFAULT NULL,
  `detalle_solicitud` text,
  `fallo_judicial` char(2) DEFAULT NULL,
  `fechor_tramite` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_radica_recibidos_pqrsf_archivos`
--

CREATE TABLE `archivo_radica_recibidos_pqrsf_archivos` (
  `id_pqr_archivo` int NOT NULL,
  `id_pqr` int NOT NULL,
  `nom_archivo` varchar(255) NOT NULL,
  `nom_temp_archivo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_radica_recibidos_responsa`
--

CREATE TABLE `archivo_radica_recibidos_responsa` (
  `id_radica` varchar(25) NOT NULL,
  `id_funcio` int NOT NULL,
  `respon` tinyint(1) DEFAULT '0',
  `leido` tinyint(1) DEFAULT '0',
  `fechor_leido` datetime DEFAULT NULL,
  `elimina` tinyint(1) DEFAULT '0',
  `respuesta` tinyint(1) DEFAULT '0',
  `firma` tinyint(1) DEFAULT '0' COMMENT 'Para saber si el documento lo firma esta persona'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='Responsables de la correspondencia de entrada, salida y la correspondencia interna.';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_radica_recibido_compartidos`
--

CREATE TABLE `archivo_radica_recibido_compartidos` (
  `id_radica` varchar(25) NOT NULL,
  `id_funcio_deta_origen` int NOT NULL,
  `id_funcio_deta_destino` int NOT NULL,
  `fechor_compartido` datetime DEFAULT NULL,
  `fechor_leido` datetime DEFAULT NULL,
  `ver` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='Tabla para compartir la informacion del radicado';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_trd`
--

CREATE TABLE `archivo_trd` (
  `id_trd` int NOT NULL,
  `id_depen` int NOT NULL,
  `id_oficina` int DEFAULT NULL,
  `id_serie` int NOT NULL,
  `id_subserie` int NOT NULL,
  `ag` int NOT NULL,
  `ac` int NOT NULL,
  `ct` tinyint(1) NOT NULL DEFAULT '0',
  `e` tinyint(1) NOT NULL DEFAULT '0',
  `dm` tinyint(1) NOT NULL DEFAULT '0',
  `s` tinyint(1) NOT NULL DEFAULT '0',
  `observa` text,
  `acti` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_trd_series`
--

CREATE TABLE `archivo_trd_series` (
  `id_serie` int NOT NULL,
  `cod_serie` char(15) NOT NULL,
  `nom_serie` varchar(100) NOT NULL,
  `observa` text,
  `acti` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='Los diferentes tipos de series existentes en las tablas de retencion documental de la entidad';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_trd_subserie`
--

CREATE TABLE `archivo_trd_subserie` (
  `id_subserie` int NOT NULL,
  `cod_subserie` char(15) DEFAULT NULL,
  `nom_subserie` char(255) DEFAULT NULL,
  `acti` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_trd_subserie_docu`
--

CREATE TABLE `archivo_trd_subserie_docu` (
  `id_subserie` int NOT NULL,
  `id_tipodoc` int NOT NULL,
  `acti` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='Relaciono lo documentos que deben tener las subseries';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_trd_tipo_docu`
--

CREATE TABLE `archivo_trd_tipo_docu` (
  `id_tipodoc` int NOT NULL,
  `nom_tipodoc` char(255) NOT NULL,
  `plantilla` char(200) DEFAULT NULL,
  `observa` text,
  `acti` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='Los diferentes tipos de documentos existentes en las tablas de retencion documental de la entidad';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_tvd`
--

CREATE TABLE `archivo_tvd` (
  `id_tvd` int NOT NULL,
  `id_depen` int NOT NULL,
  `id_oficina` int DEFAULT NULL,
  `id_serie` int NOT NULL,
  `id_subserie` int NOT NULL,
  `ag` int NOT NULL,
  `ac` int NOT NULL,
  `ct` tinyint(1) NOT NULL DEFAULT '0',
  `e` tinyint(1) NOT NULL DEFAULT '0',
  `dm` tinyint(1) NOT NULL DEFAULT '0',
  `s` tinyint(1) NOT NULL DEFAULT '0',
  `observa` text,
  `acti` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_tvd_dependencias`
--

CREATE TABLE `archivo_tvd_dependencias` (
  `id_depen` int NOT NULL,
  `cod_depen` varchar(20) DEFAULT NULL,
  `cod_corres` varchar(20) DEFAULT NULL,
  `nom_depen` varchar(60) DEFAULT NULL,
  `observa` text,
  `acti` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_tvd_oficinas`
--

CREATE TABLE `archivo_tvd_oficinas` (
  `id_oficina` int NOT NULL,
  `id_depen` int NOT NULL,
  `cod_oficina` varchar(20) NOT NULL,
  `cod_corres` varchar(20) NOT NULL,
  `nom_oficina` varchar(200) NOT NULL,
  `observa` text,
  `acti` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_tvd_series`
--

CREATE TABLE `archivo_tvd_series` (
  `id_serie` int NOT NULL,
  `cod_serie` char(15) NOT NULL,
  `nom_serie` varchar(100) NOT NULL,
  `observa` text,
  `acti` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='Los diferentes tipos de series existentes en las tablas de retencion documental de la entidad';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_tvd_subserie`
--

CREATE TABLE `archivo_tvd_subserie` (
  `id_subserie` int NOT NULL,
  `cod_subserie` char(15) DEFAULT NULL,
  `nom_subserie` char(255) DEFAULT NULL,
  `acti` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_tvd_subserie_docu`
--

CREATE TABLE `archivo_tvd_subserie_docu` (
  `id_subserie` int NOT NULL,
  `id_tipodoc` int NOT NULL,
  `acti` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='Relaciono lo documentos que deben tener las subseries';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_tvd_tipo_docu`
--

CREATE TABLE `archivo_tvd_tipo_docu` (
  `id_tipodoc` int NOT NULL,
  `nom_tipodoc` char(255) NOT NULL,
  `plantilla` char(200) DEFAULT NULL,
  `observa` text,
  `acti` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='Los diferentes tipos de documentos existentes en las tablas de retencion documental de la entidad';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas_cargos`
--

CREATE TABLE `areas_cargos` (
  `id_cargo` int NOT NULL,
  `id_depen` int NOT NULL COMMENT 'Dependencia a la cual pertenece el cargo',
  `nom_cargo` varchar(50) NOT NULL,
  `observa` text,
  `acti` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='Configuración de los cargos relacionados a una las diferentes dependencias';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas_dependencias`
--

CREATE TABLE `areas_dependencias` (
  `id_depen` int NOT NULL,
  `cod_depen` varchar(20) DEFAULT NULL,
  `cod_corres` varchar(20) DEFAULT NULL,
  `nom_depen` varchar(60) DEFAULT NULL,
  `observa` text,
  `acti` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='Tabla para almacenar las diferentes dependencias de la institución';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas_expedientes`
--

CREATE TABLE `areas_expedientes` (
  `id_expe` int NOT NULL,
  `id_depen` int NOT NULL,
  `id_oficina` int DEFAULT NULL COMMENT 'oficina a la cual pertenece el expediente, Siempre y cuando la aplicación este configurada para ser utilizada con oficinas y sus respectivas dependencias',
  `id_serie` int NOT NULL,
  `id_subserie` int DEFAULT NULL COMMENT 'Sub serie a la cual pertenece el expetientes, Siempre y cuando la aplicación este configurada para ser utilizada con tablas de retención documental',
  `id_funcio_crea` int(11) UNSIGNED ZEROFILL NOT NULL,
  `nom_expe` char(100) DEFAULT NULL COMMENT 'Nombre dle expediente',
  `fechor_crea` datetime DEFAULT NULL COMMENT 'fecha y hora de creación del expediente',
  `jefe_depen` bit(1) DEFAULT b'0' COMMENT 'Si el expediente es cerado por un jefe de dependencia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='Tabla para almacenar los diferentes expedientes del archivo físico';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas_expedientes_deta`
--

CREATE TABLE `areas_expedientes_deta` (
  `id_expe` int NOT NULL,
  `id_funcio_agrega` int(11) UNSIGNED ZEROFILL NOT NULL,
  `id_tipodoc` int NOT NULL,
  `id_radica` char(20) DEFAULT NULL,
  `fechor_agrega` datetime DEFAULT NULL,
  `origen` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas_oficinas`
--

CREATE TABLE `areas_oficinas` (
  `id_oficina` int NOT NULL,
  `id_depen` int NOT NULL,
  `cod_oficina` varchar(20) NOT NULL,
  `cod_corres` varchar(20) NOT NULL,
  `nom_oficina` varchar(200) NOT NULL,
  `observa` text,
  `acti` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='Tabla para almacenar las diferentes oficinas de la institución';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cali_procedimientos`
--

CREATE TABLE `cali_procedimientos` (
  `procedimiento_id` int NOT NULL,
  `proceso_id` int NOT NULL COMMENT 'Proceso al cual pertenece el procedimientos',
  `cod_procedimiento` varchar(45) NOT NULL COMMENT 'Codigo del procedimiento',
  `nom_procedimiento` varchar(45) NOT NULL COMMENT 'Nombre del procedimientos',
  `estado` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Estado del archivo 1 - Activo 2 - Inactivo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='Procedimientos adoptados por la institucion y aprobados por calidad';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cali_procesos`
--

CREATE TABLE `cali_procesos` (
  `proceso_id` int NOT NULL,
  `id_depen` int NOT NULL COMMENT 'Id de la dependencia a la cual pertenece el proceso',
  `cod_proce` varchar(45) NOT NULL COMMENT 'Codigo del procesos',
  `nom_proce` varchar(45) NOT NULL COMMENT 'Nombre del procesos',
  `estado` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Estado del archivo 1 - Activo 2 - Inactivo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='Procesos adoptados por la institucion y aprobados por calidad';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cali_repositorio`
--

CREATE TABLE `cali_repositorio` (
  `archivo_id` int NOT NULL,
  `procedimiento_id` int NOT NULL COMMENT 'Proceso al cual pertenece al archivo',
  `tipo_docu_id` int NOT NULL COMMENT 'Tipo de documento de calidad',
  `id_ruta` int DEFAULT NULL COMMENT 'Ruta en la cual se almacena el archivo, la ruta se actualiza despues de que el archivo es enviado al servidor FTP',
  `fechor_cargue` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha y hora de cargue del archivo',
  `nom_archivo_original` varchar(150) DEFAULT NULL COMMENT 'Nombre original del archivo',
  `nom_archivo_unico` varchar(70) DEFAULT NULL COMMENT 'Nombre unico del archivo',
  `estado` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Estado del archivo 1 - Activo 2 - Inactivo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='Repositorio para el almacenamiento de los archivos aprobados por calidad y para que esten disponibles para que los funcionarios los puedan consultar';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cali_tipos_documentos`
--

CREATE TABLE `cali_tipos_documentos` (
  `tipo_docu_id` int NOT NULL,
  `nom_tipo_documento` varchar(100) NOT NULL COMMENT 'Nombre del tipo de documento de calidad',
  `estado` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Estado del archivo 1 - Activo 2 - Inactivo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='Tipos de documentos adoptados por la oficina de calidad Ejp: Guias, Manuales, Instrucctivos, Procedimientos etc.';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config_depar`
--

CREATE TABLE `config_depar` (
  `id_depar` int NOT NULL,
  `nom_depar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config_despedida`
--

CREATE TABLE `config_despedida` (
  `id_despedida` int NOT NULL,
  `despedida` char(200) DEFAULT NULL,
  `acti` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config_empresa`
--

CREATE TABLE `config_empresa` (
  `nit` varchar(20) NOT NULL,
  `razo_soci` varchar(100) DEFAULT NULL,
  `slogan` varchar(100) DEFAULT NULL,
  `id_depar` int DEFAULT NULL,
  `id_muni` int DEFAULT NULL,
  `dir` varchar(50) DEFAULT NULL,
  `tel` varchar(50) DEFAULT NULL,
  `fax` char(30) DEFAULT NULL,
  `cel` char(30) DEFAULT NULL,
  `email` char(200) DEFAULT NULL,
  `web` char(50) DEFAULT NULL,
  `logo` char(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config_formaenvio`
--

CREATE TABLE `config_formaenvio` (
  `id_formaenvio` int NOT NULL,
  `nom_formaenvi` varchar(50) NOT NULL,
  `observa` text,
  `requie_digital` tinyint(1) DEFAULT '0',
  `acti` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config_muni`
--

CREATE TABLE `config_muni` (
  `id_muni` int NOT NULL,
  `id_depar` int NOT NULL,
  `nom_muni` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config_origen_correspondencia`
--

CREATE TABLE `config_origen_correspondencia` (
  `id_origen` int NOT NULL,
  `nom_origen` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config_otras`
--

CREATE TABLE `config_otras` (
  `id` int NOT NULL,
  `corres_recibida_titulo` char(100) DEFAULT NULL COMMENT 'Titulo para la plantilla de las comunicaciones recibidas aprobado por calidad',
  `corres_recibida_subtitulo` char(100) DEFAULT NULL COMMENT 'Sub Titulo para la plantilla de las comunicaciones recibidas aprobado por calidad',
  `corres_recibida_codigo` char(30) DEFAULT NULL COMMENT 'Código para la plantilla de las comunicaciones recibidas aprobado por calidad',
  `corres_recibida_version` char(30) DEFAULT NULL COMMENT 'Versión para la plantilla de las comunicaciones recibidas aprobado por calidad',
  `corres_enviada_titulo` char(100) DEFAULT NULL COMMENT 'Titulo para la plantilla de las comunicaciones enviadas aprobado por calidad',
  `corres_enviada_subtitulo` char(100) DEFAULT NULL COMMENT 'Sub Titulo para la plantilla de las comunicaciones enviadas aprobado por calidad',
  `corres_enviada_codigo` char(30) DEFAULT NULL COMMENT 'Código para la plantilla de las comunicaciones enviadas aprobado por calidad',
  `corres_enviada_version` char(30) DEFAULT NULL COMMENT 'Versión para la plantilla de las comunicaciones enviadas aprobado por calidad',
  `corres_interna_titulo` varchar(45) DEFAULT NULL COMMENT 'Titulo para la plantilla de las comunicaciones internas aprobado por calidad',
  `corres_interna_subtitulo` varchar(45) DEFAULT NULL COMMENT 'Sub Titulo para la plantilla de las comunicaciones internas aprobado por calidad',
  `corres_interna_codigo` varchar(45) DEFAULT NULL COMMENT 'Código para la plantilla de las comunicaciones internas aprobado por calidad',
  `corres_interna_version` varchar(45) DEFAULT NULL COMMENT 'Versión para la plantilla de las comunicaciones internas aprobado por calidad',
  `planti_correspondencia` char(100) DEFAULT NULL COMMENT 'Almacena la ruta y el nombre de la plantiall de comunicaciones oficiales',
  `tipo_radica_recibida` char(1) DEFAULT NULL COMMENT 'Establece cual es el formato del número de radicado de las comunicaciones recibidas\n\n1. Radicado con fecha y consecutivo\n2. Radicado con codigo de dependencia fecha y consecutivo\n3. Radicado con codigo de dependencia y consecutivo',
  `tipo_radica_enviado` char(1) DEFAULT NULL COMMENT 'Establece cual es el formato del número de radicado de las comunicaciones enviadas\n\n1. Radicado con fecha y consecutivo\n2. Radicado con codigo de dependencia fecha y consecutivo\n3. Radicado con codigo de dependencia y consecutivo',
  `tipo_radica_interno` char(1) DEFAULT NULL COMMENT 'Establece cual es el formato del número de radicado de las comunicaciones internas\n\n1. Radicado con fecha y consecutivo\n2. Radicado con codigo de dependencia fecha y consecutivo\n3. Radicado con codigo de dependencia y consecutivo',
  `tipo_impre_torulo` tinyblob COMMENT 'Establece la forma de impresión del rotulo\n\n1 impresora térmica\n2 documento físico',
  `incluir_trd` bit(1) DEFAULT NULL,
  `incluir_oficina_trd` int DEFAULT NULL COMMENT 'La aplicación estará habilitada para incluir las oficinas cuando se estén configurando las tablas de retención documental\n\n1 no incluye oficinas\n2 si uncluye oficinas',
  `email_ventanilla_usuario` varchar(45) DEFAULT NULL COMMENT 'Configuración del email que se va a utilizar para el envió de las notificaciones',
  `email_ventanilla_contra` varchar(45) DEFAULT NULL COMMENT 'Configuración de la contraseña del email que se va a utilizar para el envió de las notificaciones',
  `mail_ventanilla_servidor` varchar(45) DEFAULT NULL COMMENT 'Configuración del servidor del email que se va a utilizar para el envió de las notificaciones\n\nSMPT o otros',
  `email_ventanilla_puerto` varchar(45) DEFAULT NULL COMMENT 'Configuración del puerto del email que se va a utilizar para el envió de las notificaciones\n',
  `email_ventanilla_autenti` varchar(5) DEFAULT NULL COMMENT 'Configuración del tipo de autenticacion del email que se va a utilizar para el envió de las notificaciones\nSSH o otro\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='Tabla para almacenar la configuración general de la aplicación';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config_otras_responsables_pqrsf`
--

CREATE TABLE `config_otras_responsables_pqrsf` (
  `id_funcio_deta` int NOT NULL,
  `id_depen` int NOT NULL,
  `id_serie` int NOT NULL,
  `id_subserie` int NOT NULL,
  `id_tipodoc` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config_rutas_archi_calidad`
--

CREATE TABLE `config_rutas_archi_calidad` (
  `id_ruta` int NOT NULL,
  `ip` varchar(100) NOT NULL,
  `ruta` varchar(200) NOT NULL COMMENT 'Ruta o carpeta para almacednar los archivos',
  `usua` char(45) NOT NULL COMMENT 'Usuario del servidor',
  `contra` char(45) NOT NULL COMMENT 'Contraseña del usuario',
  `observa` text COMMENT 'Observaciones si las hay',
  `acti` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Estado activo o inactivo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='Tabal para almacenar la configuración del servidor para los archivos de calidad';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config_rutas_archi_digitalizados`
--

CREATE TABLE `config_rutas_archi_digitalizados` (
  `id_ruta` int NOT NULL,
  `servidor` varchar(100) NOT NULL COMMENT 'Ip del servidor',
  `ruta` varchar(200) NOT NULL COMMENT 'Ruta o carpeta para almacenar los archivos',
  `usua` char(45) DEFAULT NULL COMMENT 'Usuario del servidor',
  `contra` char(45) DEFAULT NULL COMMENT 'Contraseña del usuario',
  `observa` text COMMENT 'Observaciones si las hay',
  `tipo` varchar(45) DEFAULT NULL COMMENT 'Establecer la ruta de almacenamiento para los expediente con TRD o TVD',
  `acti` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Estado activo o inactivo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='Tabal para almacenar la configuración del servidor para los espadientes del modulo de digitalizacion';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config_rutas_archi_gestion`
--

CREATE TABLE `config_rutas_archi_gestion` (
  `id_ruta` int NOT NULL,
  `id_depen` int NOT NULL,
  `ip` varchar(100) NOT NULL,
  `ruta` varchar(200) NOT NULL COMMENT 'Ruta o carpeta para almacenar los archivos',
  `usua` char(45) DEFAULT NULL COMMENT 'Usuario del servidor',
  `contra` char(45) DEFAULT NULL COMMENT 'Contraseña del usuario',
  `observa` text COMMENT 'Observaciones si las hay',
  `acti` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Estado activo o inactivo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='Tabal para almacenar la configuración del servidor para los archivos que se encuentran en gestion';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config_rutas_archi_temp`
--

CREATE TABLE `config_rutas_archi_temp` (
  `id_ruta` int NOT NULL,
  `ip` varchar(100) NOT NULL,
  `ruta` varchar(200) NOT NULL,
  `usua` char(45) DEFAULT NULL,
  `contra` char(45) DEFAULT NULL,
  `tipo_correspon` varchar(45) DEFAULT NULL COMMENT 'Tipo de correspondencia\n1. Correspondencia recibida\n2. Correspondencia enviada\n3. Correspondencia interna',
  `observa` text,
  `acti` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config_saludo`
--

CREATE TABLE `config_saludo` (
  `id_saludo` int NOT NULL,
  `saludo` char(200) DEFAULT NULL,
  `acti` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config_status`
--

CREATE TABLE `config_status` (
  `id_status` int NOT NULL,
  `status` varchar(45) DEFAULT NULL,
  `acti` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config_tipos_respuestas`
--

CREATE TABLE `config_tipos_respuestas` (
  `id_respue` int NOT NULL,
  `nom_respues` varchar(45) DEFAULT NULL,
  `acti` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config_tipo_correspondencia`
--

CREATE TABLE `config_tipo_correspondencia` (
  `id_tipo` int NOT NULL,
  `id_origen` int NOT NULL,
  `nom_tipo` varchar(45) DEFAULT NULL,
  `acti` tinyint(1) DEFAULT '1',
  `ver_radicar` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config_tipo_documento`
--

CREATE TABLE `config_tipo_documento` (
  `id_tipo` int NOT NULL,
  `cod_tipo` varchar(45) NOT NULL,
  `nom_tipo` char(100) NOT NULL,
  `acti` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gene_entidades`
--

CREATE TABLE `gene_entidades` (
  `id_enti` int NOT NULL,
  `nit` char(20) DEFAULT NULL,
  `razo_soci` char(50) DEFAULT NULL,
  `dir` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='Entidades que esta relacionadas directamente con la entidad principal. Eje. Temporales que administran la nomina de las personas que laboran en la entidad principal';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gene_funcionarios`
--

CREATE TABLE `gene_funcionarios` (
  `id_funcio` int NOT NULL,
  `id_muni` int DEFAULT NULL,
  `id_depar` int DEFAULT NULL,
  `jefe_dependencia` tinyint(1) DEFAULT NULL,
  `jefe_oficina` tinyint(1) DEFAULT NULL,
  `crea_expedien` tinyint(1) DEFAULT NULL,
  `puede_firmar` tinyint(1) DEFAULT NULL,
  `propie_princi` tinyint(1) DEFAULT NULL,
  `cod_funcio` varchar(15) DEFAULT NULL,
  `nom_funcio` varchar(30) DEFAULT NULL,
  `ape_funcio` varchar(30) DEFAULT NULL,
  `genero` char(1) DEFAULT NULL,
  `dir` varchar(50) DEFAULT NULL,
  `tel` varchar(15) DEFAULT NULL,
  `cel` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `observa` text,
  `firma` varchar(45) DEFAULT NULL,
  `foto` varchar(45) DEFAULT NULL,
  `acti` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gene_funcionarios_deta`
--

CREATE TABLE `gene_funcionarios_deta` (
  `id_funcio_deta` int NOT NULL,
  `id_funcio` int NOT NULL,
  `id_oficina` int DEFAULT NULL,
  `id_cargo` int DEFAULT NULL,
  `acti` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gene_funcionarios_digitales`
--

CREATE TABLE `gene_funcionarios_digitales` (
  `id_funcio_deta` int NOT NULL,
  `id_serie` int NOT NULL,
  `id_subserie` int NOT NULL,
  `id_depen` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gene_terceros_contac`
--

CREATE TABLE `gene_terceros_contac` (
  `id_tercero` int NOT NULL,
  `id_empre` int DEFAULT NULL,
  `id_depar` int DEFAULT NULL,
  `id_muni` int DEFAULT NULL,
  `id_grupo_etnico` int DEFAULT NULL,
  `id_condi_tercero` int DEFAULT NULL,
  `id_tipo_docu` int DEFAULT NULL,
  `num_docu` char(20) DEFAULT NULL,
  `nom_contac` varchar(70) DEFAULT NULL,
  `cargo` char(50) DEFAULT NULL,
  `dir` varchar(255) DEFAULT NULL,
  `tel` varchar(15) DEFAULT NULL,
  `cel` varchar(15) DEFAULT NULL,
  `fax` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `acti` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gene_terceros_empresas`
--

CREATE TABLE `gene_terceros_empresas` (
  `id_empre` int NOT NULL,
  `id_depar` int DEFAULT NULL,
  `id_muni` int DEFAULT NULL,
  `nit_empre` char(15) DEFAULT NULL,
  `razo_soci` char(60) DEFAULT NULL,
  `dir` char(255) DEFAULT NULL,
  `tel` char(20) DEFAULT NULL,
  `cel` char(20) DEFAULT NULL,
  `fax` char(20) DEFAULT NULL,
  `email` char(50) DEFAULT NULL,
  `web` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notifica_email_externa`
--

CREATE TABLE `notifica_email_externa` (
  `id_notifica` int NOT NULL,
  `id_usua_registra` int NOT NULL,
  `id_funcio_deta` int NOT NULL,
  `fechor_notifica` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `titulo` varchar(200) DEFAULT NULL,
  `notificacion` varchar(500) DEFAULT NULL,
  `id_radica` varchar(45) NOT NULL,
  `email` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notifica_externa`
--

CREATE TABLE `notifica_externa` (
  `id_notifica` int NOT NULL,
  `id_funcio_deta` int NOT NULL,
  `fechor_notifica` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechor_visto` datetime DEFAULT NULL,
  `titulo` varchar(200) DEFAULT NULL,
  `notificacion` varchar(500) DEFAULT NULL,
  `id_radica` varchar(45) NOT NULL,
  `prioridad` int DEFAULT NULL COMMENT '1 Baja color info\n2 Media color danger\n3 Alta '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notifica_interna`
--

CREATE TABLE `notifica_interna` (
  `id_notifica` int NOT NULL,
  `id_funcio_deta` int NOT NULL,
  `fechor_notifica` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechor_visto` datetime DEFAULT NULL,
  `titulo` varchar(200) DEFAULT NULL,
  `notificacion` varchar(500) DEFAULT NULL,
  `id_radica` varchar(45) NOT NULL,
  `prioridad` int NOT NULL DEFAULT '1' COMMENT '1. Baja color azul\n1. Media color amarillo ''radicados que estan prontos a vence''\n2. alta color rojo ''radicados que estan vencidos'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `segu_log`
--

CREATE TABLE `segu_log` (
  `id_usua` int NOT NULL,
  `modulo` varchar(70) DEFAULT NULL,
  `fechor_regis` datetime NOT NULL,
  `equipo` varchar(50) NOT NULL,
  `ip` varchar(12) DEFAULT NULL,
  `accion` char(20) NOT NULL COMMENT 'Agregar\nEditar\nEliminar\nImprimir\nAprobar\nDescargar\nSubir\nVisualizar',
  `detalle` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `segu_modu`
--

CREATE TABLE `segu_modu` (
  `id_modu` int NOT NULL,
  `nom_modu` varchar(50) NOT NULL,
  `menu` varchar(50) DEFAULT NULL,
  `boton` char(60) DEFAULT NULL,
  `link` varchar(300) DEFAULT NULL,
  `acti` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `segu_perfiles`
--

CREATE TABLE `segu_perfiles` (
  `id_perfil` int NOT NULL,
  `nom_perfil` varchar(30) DEFAULT NULL,
  `observa` text,
  `acti` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `segu_perfiles_deta`
--

CREATE TABLE `segu_perfiles_deta` (
  `id_perfil` int NOT NULL,
  `id_modu` int NOT NULL,
  `acti` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `segu_sesiones`
--

CREATE TABLE `segu_sesiones` (
  `id_sesion` int NOT NULL,
  `id_usua` int NOT NULL,
  `fechor_inicio` datetime DEFAULT CURRENT_TIMESTAMP,
  `fechor_fin` datetime NOT NULL,
  `acti` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `segu_usua`
--

CREATE TABLE `segu_usua` (
  `id_usua` int NOT NULL,
  `id_funcio` int NOT NULL,
  `login` varchar(30) NOT NULL,
  `contra` varchar(70) NOT NULL,
  `acti` tinyint(1) NOT NULL DEFAULT '1',
  `cambio_contra` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `segu_usuadeta`
--

CREATE TABLE `segu_usuadeta` (
  `id_perfil` int NOT NULL,
  `id_usua` int NOT NULL,
  `acti` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temp_adjuntos`
--

CREATE TABLE `temp_adjuntos` (
  `id_usua` int NOT NULL,
  `archivo` char(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Insert iniciales
--
/*Data for the table `config_depar` */

insert  into `config_depar`(`id_depar`,`nom_depar`) values 
(5,'Antioquia'),
(8,'Atlántico'),
(11,'Bogotá D.C'),
(13,'Bolívar'),
(15,'Boyacá'),
(17,'Caldas'),
(18,'Caquetá'),
(19,'Cauca'),
(20,'Cesar'),
(23,'Córdoba'),
(25,'Cundinamarca'),
(27,'Chocó'),
(41,'Huila'),
(44,'La Guajira'),
(47,'Magdalena'),
(50,'Meta'),
(52,'Nariño'),
(54,'Norte de Santander'),
(63,'Quindio'),
(66,'Risaralda'),
(68,'Santander'),
(70,'Sucre'),
(73,'Tolima'),
(76,'Valle del Cauca'),
(81,'Arauca'),
(85,'Casanare'),
(86,'Putumayo'),
(88,'Archipiélago de San Andrés, Providencia y Santa Catalina'),
(91,'Amazonas'),
(94,'Guainía'),
(95,'Guaviare'),
(97,'Vaupés'),
(99,'Vichada');

/*Data for the table `config_despedida` */

insert  into `config_despedida`(`id_despedida`,`despedida`,`acti`) values 
(1,'Gracias por la atención prestada,',0),
(2,'En espera de una pronta respuesta,',0);

/*Data for the table `config_empresa` */

insert  into `config_empresa`(`nit`,`razo_soci`,`slogan`,`id_depar`,`id_muni`,`dir`,`tel`,`fax`,`cel`,`email`,`web`,`logo`) values 
('890701033','HOSPITAL SAN RAFAEL DE EL ESPINAL TOLIMA E.S.E','',73,73268,'Calle 4 No. 6-29','2482818',NULL,NULL,NULL,'www.hsrespinal.gov.co','logo_empresa.png');

/*Data for the table `config_formaenvio` */

insert  into `config_formaenvio`(`id_formaenvio`,`nom_formaenvi`,`observa`,`requie_digital`,`acti`) values 
(1,'Mensajero',NULL,1,1),
(2,'Personal',NULL,1,1),
(3,'Correo Certificado',NULL,1,1),
(4,'Correo Electrónico',NULL,1,1),
(5,'Vía Fax',NULL,1,1),
(6,'Verbal',NULL,1,1),
(7,'Correo Tradicional',NULL,1,1),
(8,'Pagina Web',NULL,1,1),
(9,'Buzon',NULL,1,1),
(10,'Correo Electrónico Con Documento',NULL,1,1);

/*Data for the table `config_muni` */

insert  into `config_muni`(`id_muni`,`id_depar`,`nom_muni`) values 
(5001,5,'MEDELLÍN'),
(5002,5,'ABEJORRAL'),
(5004,5,'ABRIAQUÍ'),
(5021,5,'ALEJANDRÍA'),
(5030,5,'AMAGÁ'),
(5031,5,'AMALFI'),
(5034,5,'ANDES'),
(5036,5,'ANGELÓPOLIS'),
(5038,5,'ANGOSTURA'),
(5040,5,'ANORÍ'),
(5042,5,'SANTA FÉ DE ANTIOQUIA'),
(5044,5,'ANZÁ'),
(5045,5,'APARTADÓ'),
(5051,5,'ARBOLETES'),
(5055,5,'ARGELIA'),
(5059,5,'ARMENIA'),
(5079,5,'BARBOSA'),
(5086,5,'BELMIRA'),
(5088,5,'BELLO'),
(5091,5,'BETANIA'),
(5093,5,'BETULIA'),
(5101,5,'CIUDAD BOLÍVAR'),
(5107,5,'BRICEÑO'),
(5113,5,'BURITICÁ'),
(5120,5,'CÁCERES'),
(5125,5,'CAICEDO'),
(5129,5,'CALDAS'),
(5134,5,'CAMPAMENTO'),
(5138,5,'CAÑASGORDAS'),
(5142,5,'CARACOLÍ'),
(5145,5,'CARAMANTA'),
(5147,5,'CAREPA'),
(5148,5,'EL CARMEN DE VIBORAL'),
(5150,5,'CAROLINA'),
(5154,5,'CAUCASIA'),
(5172,5,'CHIGORODÓ'),
(5190,5,'CISNEROS'),
(5197,5,'COCORNÁ'),
(5206,5,'CONCEPCIÓN'),
(5209,5,'CONCORDIA'),
(5212,5,'COPACABANA'),
(5234,5,'DABEIBA'),
(5237,5,'DONMATÍAS'),
(5240,5,'EBÉJICO'),
(5250,5,'EL BAGRE'),
(5264,5,'ENTRERRÍOS'),
(5266,5,'ENVIGADO'),
(5282,5,'FREDONIA'),
(5284,5,'FRONTINO'),
(5306,5,'GIRALDO'),
(5308,5,'GIRARDOTA'),
(5310,5,'GÓMEZ PLATA'),
(5313,5,'GRANADA'),
(5315,5,'GUADALUPE'),
(5318,5,'GUARNE'),
(5321,5,'GUATAPÉ'),
(5347,5,'HELICONIA'),
(5353,5,'HISPANIA'),
(5360,5,'ITAGÜÍ'),
(5361,5,'ITUANGO'),
(5364,5,'JARDÍN'),
(5368,5,'JERICÓ'),
(5376,5,'LA CEJA'),
(5380,5,'LA ESTRELLA'),
(5390,5,'LA PINTADA'),
(5400,5,'LA UNIÓN'),
(5411,5,'LIBORINA'),
(5425,5,'MACEO'),
(5440,5,'MARINILLA'),
(5467,5,'MONTEBELLO'),
(5475,5,'MURINDÓ'),
(5480,5,'MUTATÁ'),
(5483,5,'NARIÑO'),
(5490,5,'NECOCLÍ'),
(5495,5,'NECHÍ'),
(5501,5,'OLAYA'),
(5541,5,'PEÑOL'),
(5543,5,'PEQUE'),
(5576,5,'PUEBLORRICO'),
(5579,5,'PUERTO BERRÍO'),
(5585,5,'PUERTO NARE'),
(5591,5,'PUERTO TRIUNFO'),
(5604,5,'REMEDIOS'),
(5607,5,'RETIRO'),
(5615,5,'RIONEGRO'),
(5628,5,'SABANALARGA'),
(5631,5,'SABANETA'),
(5642,5,'SALGAR'),
(5647,5,'SAN ANDRÉS DE CUERQUÍA'),
(5649,5,'SAN CARLOS'),
(5652,5,'SAN FRANCISCO'),
(5656,5,'SAN JERÓNIMO'),
(5658,5,'SAN JOSÉ DE LA MONTAÑA'),
(5659,5,'SAN JUAN DE URABÁ'),
(5660,5,'SAN LUIS'),
(5664,5,'SAN PEDRO DE LOS MILAGROS'),
(5665,5,'SAN PEDRO DE URABÁ'),
(5667,5,'SAN RAFAEL'),
(5670,5,'SAN ROQUE'),
(5674,5,'SAN VICENTE FERRER'),
(5679,5,'SANTA BÁRBARA'),
(5686,5,'SANTA ROSA DE OSOS'),
(5690,5,'SANTO DOMINGO'),
(5697,5,'EL SANTUARIO'),
(5736,5,'SEGOVIA'),
(5756,5,'SONSÓN'),
(5761,5,'SOPETRÁN'),
(5789,5,'TÁMESIS'),
(5790,5,'TARAZÁ'),
(5792,5,'TARSO'),
(5809,5,'TITIRIBÍ'),
(5819,5,'TOLEDO'),
(5837,5,'TURBO'),
(5842,5,'URAMITA'),
(5847,5,'URRAO'),
(5854,5,'VALDIVIA'),
(5856,5,'VALPARAÍSO'),
(5858,5,'VEGACHÍ'),
(5861,5,'VENECIA'),
(5873,5,'VIGÍA DEL FUERTE'),
(5885,5,'YALÍ'),
(5887,5,'YARUMAL'),
(5890,5,'YOLOMBÓ'),
(5893,5,'YONDÓ'),
(5895,5,'ZARAGOZA'),
(8001,8,'BARRANQUILLA'),
(8078,8,'BARANOA'),
(8137,8,'CAMPO DE LA CRUZ'),
(8141,8,'CANDELARIA'),
(8296,8,'GALAPA'),
(8372,8,'JUAN DE ACOSTA'),
(8421,8,'LURUACO'),
(8433,8,'MALAMBO'),
(8436,8,'MANATÍ'),
(8520,8,'PALMAR DE VARELA'),
(8549,8,'PIOJÓ'),
(8558,8,'POLONUEVO'),
(8560,8,'PONEDERA'),
(8573,8,'PUERTO COLOMBIA'),
(8606,8,'REPELÓN'),
(8634,8,'SABANAGRANDE'),
(8638,8,'SABANALARGA'),
(8675,8,'SANTA LUCÍA'),
(8685,8,'SANTO TOMÁS'),
(8758,8,'SOLEDAD'),
(8770,8,'SUAN'),
(8832,8,'TUBARÁ'),
(8849,8,'USIACURÍ'),
(11001,11,'BOGOTÁ, D.C.'),
(13001,13,'CARTAGENA DE INDIAS'),
(13006,13,'ACHÍ'),
(13030,13,'ALTOS DEL ROSARIO'),
(13042,13,'ARENAL'),
(13052,13,'ARJONA'),
(13062,13,'ARROYOHONDO'),
(13074,13,'BARRANCO DE LOBA'),
(13140,13,'CALAMAR'),
(13160,13,'CANTAGALLO'),
(13188,13,'CICUCO'),
(13212,13,'CÓRDOBA'),
(13222,13,'CLEMENCIA'),
(13244,13,'EL CARMEN DE BOLÍVAR'),
(13248,13,'EL GUAMO'),
(13268,13,'EL PEÑÓN'),
(13300,13,'HATILLO DE LOBA'),
(13430,13,'MAGANGUÉ'),
(13433,13,'MAHATES'),
(13440,13,'MARGARITA'),
(13442,13,'MARÍA LA BAJA'),
(13458,13,'MONTECRISTO'),
(13468,13,'MOMPÓS'),
(13473,13,'MORALES'),
(13490,13,'NOROSÍ'),
(13549,13,'PINILLOS'),
(13580,13,'REGIDOR'),
(13600,13,'RÍO VIEJO'),
(13620,13,'SAN CRISTÓBAL'),
(13647,13,'SAN ESTANISLAO'),
(13650,13,'SAN FERNANDO'),
(13654,13,'SAN JACINTO'),
(13655,13,'SAN JACINTO DEL CAUCA'),
(13657,13,'SAN JUAN NEPOMUCENO'),
(13667,13,'SAN MARTÍN DE LOBA'),
(13670,13,'SAN PABLO'),
(13673,13,'SANTA CATALINA'),
(13683,13,'SANTA ROSA'),
(13688,13,'SANTA ROSA DEL SUR'),
(13744,13,'SIMITÍ'),
(13760,13,'SOPLAVIENTO'),
(13780,13,'TALAIGUA NUEVO'),
(13810,13,'TIQUISIO'),
(13836,13,'TURBACO'),
(13838,13,'TURBANÁ'),
(13873,13,'VILLANUEVA'),
(13894,13,'ZAMBRANO'),
(15001,15,'TUNJA'),
(15022,15,'ALMEIDA'),
(15047,15,'AQUITANIA'),
(15051,15,'ARCABUCO'),
(15087,15,'BELÉN'),
(15090,15,'BERBEO'),
(15092,15,'BETÉITIVA'),
(15097,15,'BOAVITA'),
(15104,15,'BOYACÁ'),
(15106,15,'BRICEÑO'),
(15109,15,'BUENAVISTA'),
(15114,15,'BUSBANZÁ'),
(15131,15,'CALDAS'),
(15135,15,'CAMPOHERMOSO'),
(15162,15,'CERINZA'),
(15172,15,'CHINAVITA'),
(15176,15,'CHIQUINQUIRÁ'),
(15180,15,'CHISCAS'),
(15183,15,'CHITA'),
(15185,15,'CHITARAQUE'),
(15187,15,'CHIVATÁ'),
(15189,15,'CIÉNEGA'),
(15204,15,'CÓMBITA'),
(15212,15,'COPER'),
(15215,15,'CORRALES'),
(15218,15,'COVARACHÍA'),
(15223,15,'CUBARÁ'),
(15224,15,'CUCAITA'),
(15226,15,'CUÍTIVA'),
(15232,15,'CHÍQUIZA'),
(15236,15,'CHIVOR'),
(15238,15,'DUITAMA'),
(15244,15,'EL COCUY'),
(15248,15,'EL ESPINO'),
(15272,15,'FIRAVITOBA'),
(15276,15,'FLORESTA'),
(15293,15,'GACHANTIVÁ'),
(15296,15,'GÁMEZA'),
(15299,15,'GARAGOA'),
(15317,15,'GUACAMAYAS'),
(15322,15,'GUATEQUE'),
(15325,15,'GUAYATÁ'),
(15332,15,'GÜICÁN DE LA SIERRA'),
(15362,15,'IZA'),
(15367,15,'JENESANO'),
(15368,15,'JERICÓ'),
(15377,15,'LABRANZAGRANDE'),
(15380,15,'LA CAPILLA'),
(15401,15,'LA VICTORIA'),
(15403,15,'LA UVITA'),
(15407,15,'VILLA DE LEYVA'),
(15425,15,'MACANAL'),
(15442,15,'MARIPÍ'),
(15455,15,'MIRAFLORES'),
(15464,15,'MONGUA'),
(15466,15,'MONGUÍ'),
(15469,15,'MONIQUIRÁ'),
(15476,15,'MOTAVITA'),
(15480,15,'MUZO'),
(15491,15,'NOBSA'),
(15494,15,'NUEVO COLÓN'),
(15500,15,'OICATÁ'),
(15507,15,'OTANCHE'),
(15511,15,'PACHAVITA'),
(15514,15,'PÁEZ'),
(15516,15,'PAIPA'),
(15518,15,'PAJARITO'),
(15522,15,'PANQUEBA'),
(15531,15,'PAUNA'),
(15533,15,'PAYA'),
(15537,15,'PAZ DE RÍO'),
(15542,15,'PESCA'),
(15550,15,'PISBA'),
(15572,15,'PUERTO BOYACÁ'),
(15580,15,'QUÍPAMA'),
(15599,15,'RAMIRIQUÍ'),
(15600,15,'RÁQUIRA'),
(15621,15,'RONDÓN'),
(15632,15,'SABOYÁ'),
(15638,15,'SÁCHICA'),
(15646,15,'SAMACÁ'),
(15660,15,'SAN EDUARDO'),
(15664,15,'SAN JOSÉ DE PARE'),
(15667,15,'SAN LUIS DE GACENO'),
(15673,15,'SAN MATEO'),
(15676,15,'SAN MIGUEL DE SEMA'),
(15681,15,'SAN PABLO DE BORBUR'),
(15686,15,'SANTANA'),
(15690,15,'SANTA MARÍA'),
(15693,15,'SANTA ROSA DE VITERBO'),
(15696,15,'SANTA SOFÍA'),
(15720,15,'SATIVANORTE'),
(15723,15,'SATIVASUR'),
(15740,15,'SIACHOQUE'),
(15753,15,'SOATÁ'),
(15755,15,'SOCOTÁ'),
(15757,15,'SOCHA'),
(15759,15,'SOGAMOSO'),
(15761,15,'SOMONDOCO'),
(15762,15,'SORA'),
(15763,15,'SOTAQUIRÁ'),
(15764,15,'SORACÁ'),
(15774,15,'SUSACÓN'),
(15776,15,'SUTAMARCHÁN'),
(15778,15,'SUTATENZA'),
(15790,15,'TASCO'),
(15798,15,'TENZA'),
(15804,15,'TIBANÁ'),
(15806,15,'TIBASOSA'),
(15808,15,'TINJACÁ'),
(15810,15,'TIPACOQUE'),
(15814,15,'TOCA'),
(15816,15,'TOGÜÍ'),
(15820,15,'TÓPAGA'),
(15822,15,'TOTA'),
(15832,15,'TUNUNGUÁ'),
(15835,15,'TURMEQUÉ'),
(15837,15,'TUTA'),
(15839,15,'TUTAZÁ'),
(15842,15,'ÚMBITA'),
(15861,15,'VENTAQUEMADA'),
(15879,15,'VIRACACHÁ'),
(15897,15,'ZETAQUIRA'),
(17001,17,'MANIZALES'),
(17013,17,'AGUADAS'),
(17042,17,'ANSERMA'),
(17050,17,'ARANZAZU'),
(17088,17,'BELALCÁZAR'),
(17174,17,'CHINCHINÁ'),
(17272,17,'FILADELFIA'),
(17380,17,'LA DORADA'),
(17388,17,'LA MERCED'),
(17433,17,'MANZANARES'),
(17442,17,'MARMATO'),
(17444,17,'MARQUETALIA'),
(17446,17,'MARULANDA'),
(17486,17,'NEIRA'),
(17495,17,'NORCASIA'),
(17513,17,'PÁCORA'),
(17524,17,'PALESTINA'),
(17541,17,'PENSILVANIA'),
(17614,17,'RIOSUCIO'),
(17616,17,'RISARALDA'),
(17653,17,'SALAMINA'),
(17662,17,'SAMANÁ'),
(17665,17,'SAN JOSÉ'),
(17777,17,'SUPÍA'),
(17867,17,'VICTORIA'),
(17873,17,'VILLAMARÍA'),
(17877,17,'VITERBO'),
(18001,18,'FLORENCIA'),
(18029,18,'ALBANIA'),
(18094,18,'BELÉN DE LOS ANDAQUÍES'),
(18150,18,'CARTAGENA DEL CHAIRÁ'),
(18205,18,'CURILLO'),
(18247,18,'EL DONCELLO'),
(18256,18,'EL PAUJÍL'),
(18410,18,'LA MONTAÑITA'),
(18460,18,'MILÁN'),
(18479,18,'MORELIA'),
(18592,18,'PUERTO RICO'),
(18610,18,'SAN JOSÉ DEL FRAGUA'),
(18753,18,'SAN VICENTE DEL CAGUÁN'),
(18756,18,'SOLANO'),
(18785,18,'SOLITA'),
(18860,18,'VALPARAÍSO'),
(19001,19,'POPAYÁN'),
(19022,19,'ALMAGUER'),
(19050,19,'ARGELIA'),
(19075,19,'BALBOA'),
(19100,19,'BOLÍVAR'),
(19110,19,'BUENOS AIRES'),
(19130,19,'CAJIBÍO'),
(19137,19,'CALDONO'),
(19142,19,'CALOTO'),
(19212,19,'CORINTO'),
(19256,19,'EL TAMBO'),
(19290,19,'FLORENCIA'),
(19300,19,'GUACHENÉ'),
(19318,19,'GUAPÍ'),
(19355,19,'INZÁ'),
(19364,19,'JAMBALÓ'),
(19392,19,'LA SIERRA'),
(19397,19,'LA VEGA'),
(19418,19,'LÓPEZ DE MICAY'),
(19450,19,'MERCADERES'),
(19455,19,'MIRANDA'),
(19473,19,'MORALES'),
(19513,19,'PADILLA'),
(19517,19,'PÁEZ'),
(19532,19,'PATÍA'),
(19533,19,'PIAMONTE'),
(19548,19,'PIENDAMÓ'),
(19573,19,'PUERTO TEJADA'),
(19585,19,'PURACÉ'),
(19622,19,'ROSAS'),
(19693,19,'SAN SEBASTIÁN'),
(19698,19,'SANTANDER DE QUILICHAO'),
(19701,19,'SANTA ROSA'),
(19743,19,'SILVIA'),
(19760,19,'SOTARA'),
(19780,19,'SUÁREZ'),
(19785,19,'SUCRE'),
(19807,19,'TIMBÍO'),
(19809,19,'TIMBIQUÍ'),
(19821,19,'TORIBÍO'),
(19824,19,'TOTORÓ'),
(19845,19,'VILLA RICA'),
(20001,20,'VALLEDUPAR'),
(20011,20,'AGUACHICA'),
(20013,20,'AGUSTÍN CODAZZI'),
(20032,20,'ASTREA'),
(20045,20,'BECERRIL'),
(20060,20,'BOSCONIA'),
(20175,20,'CHIMICHAGUA'),
(20178,20,'CHIRIGUANÁ'),
(20228,20,'CURUMANÍ'),
(20238,20,'EL COPEY'),
(20250,20,'EL PASO'),
(20295,20,'GAMARRA'),
(20310,20,'GONZÁLEZ'),
(20383,20,'LA GLORIA'),
(20400,20,'LA JAGUA DE IBIRICO'),
(20443,20,'MANAURE BALCÓN DEL CESAR'),
(20517,20,'PAILITAS'),
(20550,20,'PELAYA'),
(20570,20,'PUEBLO BELLO'),
(20614,20,'RÍO DE ORO'),
(20621,20,'LA PAZ'),
(20710,20,'SAN ALBERTO'),
(20750,20,'SAN DIEGO'),
(20770,20,'SAN MARTÍN'),
(20787,20,'TAMALAMEQUE'),
(23001,23,'MONTERÍA'),
(23068,23,'AYAPEL'),
(23079,23,'BUENAVISTA'),
(23090,23,'CANALETE'),
(23162,23,'CERETÉ'),
(23168,23,'CHIMÁ'),
(23182,23,'CHINÚ'),
(23189,23,'CIÉNAGA DE ORO'),
(23300,23,'COTORRA'),
(23350,23,'LA APARTADA'),
(23417,23,'LORICA'),
(23419,23,'LOS CÓRDOBAS'),
(23464,23,'MOMIL'),
(23466,23,'MONTELÍBANO'),
(23500,23,'MOÑITOS'),
(23555,23,'PLANETA RICA'),
(23570,23,'PUEBLO NUEVO'),
(23574,23,'PUERTO ESCONDIDO'),
(23580,23,'PUERTO LIBERTADOR'),
(23586,23,'PURÍSIMA DE LA CONCEPCIÓN'),
(23660,23,'SAHAGÚN'),
(23670,23,'SAN ANDRÉS DE SOTAVENTO'),
(23672,23,'SAN ANTERO'),
(23675,23,'SAN BERNARDO DEL VIENTO'),
(23678,23,'SAN CARLOS'),
(23682,23,'SAN JOSÉ DE URÉ'),
(23686,23,'SAN PELAYO'),
(23807,23,'TIERRALTA'),
(23815,23,'TUCHÍN'),
(23855,23,'VALENCIA'),
(25001,25,'AGUA DE DIOS'),
(25019,25,'ALBÁN'),
(25035,25,'ANAPOIMA'),
(25040,25,'ANOLAIMA'),
(25053,25,'ARBELÁEZ'),
(25086,25,'BELTRÁN'),
(25095,25,'BITUIMA'),
(25099,25,'BOJACÁ'),
(25120,25,'CABRERA'),
(25123,25,'CACHIPAY'),
(25126,25,'CAJICÁ'),
(25148,25,'CAPARRAPÍ'),
(25151,25,'CÁQUEZA'),
(25154,25,'CARMEN DE CARUPA'),
(25168,25,'CHAGUANÍ'),
(25175,25,'CHÍA'),
(25178,25,'CHIPAQUE'),
(25181,25,'CHOACHÍ'),
(25183,25,'CHOCONTÁ'),
(25200,25,'COGUA'),
(25214,25,'COTA'),
(25224,25,'CUCUNUBÁ'),
(25245,25,'EL COLEGIO'),
(25258,25,'EL PEÑÓN'),
(25260,25,'EL ROSAL'),
(25269,25,'FACATATIVÁ'),
(25279,25,'FÓMEQUE'),
(25281,25,'FOSCA'),
(25286,25,'FUNZA'),
(25288,25,'FÚQUENE'),
(25290,25,'FUSAGASUGÁ'),
(25293,25,'GACHALÁ'),
(25295,25,'GACHANCIPÁ'),
(25297,25,'GACHETÁ'),
(25299,25,'GAMA'),
(25307,25,'GIRARDOT'),
(25312,25,'GRANADA'),
(25317,25,'GUACHETÁ'),
(25320,25,'GUADUAS'),
(25322,25,'GUASCA'),
(25324,25,'GUATAQUÍ'),
(25326,25,'GUATAVITA'),
(25328,25,'GUAYABAL DE SÍQUIMA'),
(25335,25,'GUAYABETAL'),
(25339,25,'GUTIÉRREZ'),
(25368,25,'JERUSALÉN'),
(25372,25,'JUNÍN'),
(25377,25,'LA CALERA'),
(25386,25,'LA MESA'),
(25394,25,'LA PALMA'),
(25398,25,'LA PEÑA'),
(25402,25,'LA VEGA'),
(25407,25,'LENGUAZAQUE'),
(25426,25,'MACHETÁ'),
(25430,25,'MADRID'),
(25436,25,'MANTA'),
(25438,25,'MEDINA'),
(25473,25,'MOSQUERA'),
(25483,25,'NARIÑO'),
(25486,25,'NEMOCÓN'),
(25488,25,'NILO'),
(25489,25,'NIMAIMA'),
(25491,25,'NOCAIMA'),
(25506,25,'VENECIA'),
(25513,25,'PACHO'),
(25518,25,'PAIME'),
(25524,25,'PANDI'),
(25530,25,'PARATEBUENO'),
(25535,25,'PASCA'),
(25572,25,'PUERTO SALGAR'),
(25580,25,'PULÍ'),
(25592,25,'QUEBRADANEGRA'),
(25594,25,'QUETAME'),
(25596,25,'QUIPILE'),
(25599,25,'APULO'),
(25612,25,'RICAURTE'),
(25645,25,'SAN ANTONIO DEL TEQUENDAMA'),
(25649,25,'SAN BERNARDO'),
(25653,25,'SAN CAYETANO'),
(25658,25,'SAN FRANCISCO'),
(25662,25,'SAN JUAN DE RIOSECO'),
(25718,25,'SASAIMA'),
(25736,25,'SESQUILÉ'),
(25740,25,'SIBATÉ'),
(25743,25,'SILVANIA'),
(25745,25,'SIMIJACA'),
(25754,25,'SOACHA'),
(25758,25,'SOPÓ'),
(25769,25,'SUBACHOQUE'),
(25772,25,'SUESCA'),
(25777,25,'SUPATÁ'),
(25779,25,'SUSA'),
(25781,25,'SUTATAUSA'),
(25785,25,'TABIO'),
(25793,25,'TAUSA'),
(25797,25,'TENA'),
(25799,25,'TENJO'),
(25805,25,'TIBACUY'),
(25807,25,'TIBIRITA'),
(25815,25,'TOCAIMA'),
(25817,25,'TOCANCIPÁ'),
(25823,25,'TOPAIPÍ'),
(25839,25,'UBALÁ'),
(25841,25,'UBAQUE'),
(25843,25,'VILLA DE SAN DIEGO DE UBATÉ'),
(25845,25,'UNE'),
(25851,25,'ÚTICA'),
(25862,25,'VERGARA'),
(25867,25,'VIANÍ'),
(25871,25,'VILLAGÓMEZ'),
(25873,25,'VILLAPINZÓN'),
(25875,25,'VILLETA'),
(25878,25,'VIOTÁ'),
(25885,25,'YACOPÍ'),
(25898,25,'ZIPACÓN'),
(25899,25,'ZIPAQUIRÁ'),
(27001,27,'QUIBDÓ'),
(27006,27,'ACANDÍ'),
(27025,27,'ALTO BAUDÓ'),
(27050,27,'ATRATO'),
(27073,27,'BAGADÓ'),
(27075,27,'BAHÍA SOLANO'),
(27077,27,'BAJO BAUDÓ'),
(27099,27,'BOJAYÁ'),
(27135,27,'EL CANTÓN DEL SAN PABLO'),
(27150,27,'CARMEN DEL DARIÉN'),
(27160,27,'CÉRTEGUI'),
(27205,27,'CONDOTO'),
(27245,27,'EL CARMEN DE ATRATO'),
(27250,27,'EL LITORAL DEL SAN JUAN'),
(27361,27,'ISTMINA'),
(27372,27,'JURADÓ'),
(27413,27,'LLORÓ'),
(27425,27,'MEDIO ATRATO'),
(27430,27,'MEDIO BAUDÓ'),
(27450,27,'MEDIO SAN JUAN'),
(27491,27,'NÓVITA'),
(27495,27,'NUQUÍ'),
(27580,27,'RÍO IRÓ'),
(27600,27,'RÍO QUITO'),
(27615,27,'RIOSUCIO'),
(27660,27,'SAN JOSÉ DEL PALMAR'),
(27745,27,'SIPÍ'),
(27787,27,'TADÓ'),
(27800,27,'UNGUÍA'),
(27810,27,'UNIÓN PANAMERICANA'),
(41001,41,'NEIVA'),
(41006,41,'ACEVEDO'),
(41013,41,'AGRADO'),
(41016,41,'AIPE'),
(41020,41,'ALGECIRAS'),
(41026,41,'ALTAMIRA'),
(41078,41,'BARAYA'),
(41132,41,'CAMPOALEGRE'),
(41206,41,'COLOMBIA'),
(41244,41,'ELÍAS'),
(41298,41,'GARZÓN'),
(41306,41,'GIGANTE'),
(41319,41,'GUADALUPE'),
(41349,41,'HOBO'),
(41357,41,'ÍQUIRA'),
(41359,41,'ISNOS'),
(41378,41,'LA ARGENTINA'),
(41396,41,'LA PLATA'),
(41483,41,'NÁTAGA'),
(41503,41,'OPORAPA'),
(41518,41,'PAICOL'),
(41524,41,'PALERMO'),
(41530,41,'PALESTINA'),
(41548,41,'PITAL'),
(41551,41,'PITALITO'),
(41615,41,'RIVERA'),
(41660,41,'SALADOBLANCO'),
(41668,41,'SAN AGUSTÍN'),
(41676,41,'SANTA MARÍA'),
(41770,41,'SUAZA'),
(41791,41,'TARQUI'),
(41797,41,'TESALIA'),
(41799,41,'TELLO'),
(41801,41,'TERUEL'),
(41807,41,'TIMANÁ'),
(41872,41,'VILLAVIEJA'),
(41885,41,'YAGUARÁ'),
(44001,44,'RIOHACHA'),
(44035,44,'ALBANIA'),
(44078,44,'BARRANCAS'),
(44090,44,'DIBULLA'),
(44098,44,'DISTRACCIÓN'),
(44110,44,'EL MOLINO'),
(44279,44,'FONSECA'),
(44378,44,'HATONUEVO'),
(44420,44,'LA JAGUA DEL PILAR'),
(44430,44,'MAICAO'),
(44560,44,'MANAURE'),
(44650,44,'SAN JUAN DEL CESAR'),
(44847,44,'URIBIA'),
(44855,44,'URUMITA'),
(44874,44,'VILLANUEVA'),
(47001,47,'SANTA MARTA'),
(47030,47,'ALGARROBO'),
(47053,47,'ARACATACA'),
(47058,47,'ARIGUANÍ'),
(47161,47,'CERRO DE SAN ANTONIO'),
(47170,47,'CHIVOLO'),
(47189,47,'CIÉNAGA'),
(47205,47,'CONCORDIA'),
(47245,47,'EL BANCO'),
(47258,47,'EL PIÑÓN'),
(47268,47,'EL RETÉN'),
(47288,47,'FUNDACIÓN'),
(47318,47,'GUAMAL'),
(47460,47,'NUEVA GRANADA'),
(47541,47,'PEDRAZA'),
(47545,47,'PIJIÑO DEL CARMEN'),
(47551,47,'PIVIJAY'),
(47555,47,'PLATO'),
(47570,47,'PUEBLOVIEJO'),
(47605,47,'REMOLINO'),
(47660,47,'SABANAS DE SAN ÁNGEL'),
(47675,47,'SALAMINA'),
(47692,47,'SAN SEBASTIÁN DE BUENAVISTA'),
(47703,47,'SAN ZENÓN'),
(47707,47,'SANTA ANA'),
(47720,47,'SANTA BÁRBARA DE PINTO'),
(47745,47,'SITIONUEVO'),
(47798,47,'TENERIFE'),
(47960,47,'ZAPAYÁN'),
(47980,47,'ZONA BANANERA'),
(50001,50,'VILLAVICENCIO'),
(50006,50,'ACACÍAS'),
(50110,50,'BARRANCA DE UPÍA'),
(50124,50,'CABUYARO'),
(50150,50,'CASTILLA LA NUEVA'),
(50223,50,'CUBARRAL'),
(50226,50,'CUMARAL'),
(50245,50,'EL CALVARIO'),
(50251,50,'EL CASTILLO'),
(50270,50,'EL DORADO'),
(50287,50,'FUENTE DE ORO'),
(50313,50,'GRANADA'),
(50318,50,'GUAMAL'),
(50325,50,'MAPIRIPÁN'),
(50330,50,'MESETAS'),
(50350,50,'LA MACARENA'),
(50370,50,'URIBE'),
(50400,50,'LEJANÍAS'),
(50450,50,'PUERTO CONCORDIA'),
(50568,50,'PUERTO GAITÁN'),
(50573,50,'PUERTO LÓPEZ'),
(50577,50,'PUERTO LLERAS'),
(50590,50,'PUERTO RICO'),
(50606,50,'RESTREPO'),
(50680,50,'SAN CARLOS DE GUAROA'),
(50683,50,'SAN JUAN DE ARAMA'),
(50686,50,'SAN JUANITO'),
(50689,50,'SAN MARTÍN'),
(50711,50,'VISTAHERMOSA'),
(52001,52,'PASTO'),
(52019,52,'ALBÁN'),
(52022,52,'ALDANA'),
(52036,52,'ANCUYÁ'),
(52051,52,'ARBOLEDA'),
(52079,52,'BARBACOAS'),
(52083,52,'BELÉN'),
(52110,52,'BUESACO'),
(52203,52,'COLÓN'),
(52207,52,'CONSACÁ'),
(52210,52,'CONTADERO'),
(52215,52,'CÓRDOBA'),
(52224,52,'CUASPÚD'),
(52227,52,'CUMBAL'),
(52233,52,'CUMBITARA'),
(52240,52,'CHACHAGÜÍ'),
(52250,52,'EL CHARCO'),
(52254,52,'EL PEÑOL'),
(52256,52,'EL ROSARIO'),
(52258,52,'EL TABLÓN DE GÓMEZ'),
(52260,52,'EL TAMBO'),
(52287,52,'FUNES'),
(52317,52,'GUACHUCAL'),
(52320,52,'GUAITARILLA'),
(52323,52,'GUALMATÁN'),
(52352,52,'ILES'),
(52354,52,'IMUÉS'),
(52356,52,'IPIALES'),
(52378,52,'LA CRUZ'),
(52381,52,'LA FLORIDA'),
(52385,52,'LA LLANADA'),
(52390,52,'LA TOLA'),
(52399,52,'LA UNIÓN'),
(52405,52,'LEIVA'),
(52411,52,'LINARES'),
(52418,52,'LOS ANDES'),
(52427,52,'MAGÜÍ'),
(52435,52,'MALLAMA'),
(52473,52,'MOSQUERA'),
(52480,52,'NARIÑO'),
(52490,52,'OLAYA HERRERA'),
(52506,52,'OSPINA'),
(52520,52,'FRANCISCO PIZARRO'),
(52540,52,'POLICARPA'),
(52560,52,'POTOSÍ'),
(52565,52,'PROVIDENCIA'),
(52573,52,'PUERRES'),
(52585,52,'PUPIALES'),
(52612,52,'RICAURTE'),
(52621,52,'ROBERTO PAYÁN'),
(52678,52,'SAMANIEGO'),
(52683,52,'SANDONÁ'),
(52685,52,'SAN BERNARDO'),
(52687,52,'SAN LORENZO'),
(52693,52,'SAN PABLO'),
(52694,52,'SAN PEDRO DE CARTAGO'),
(52696,52,'SANTA BÁRBARA'),
(52699,52,'SANTACRUZ'),
(52720,52,'SAPUYES'),
(52786,52,'TAMINANGO'),
(52788,52,'TANGUA'),
(52835,52,'SAN ANDRÉS DE TUMACO'),
(52838,52,'TÚQUERRES'),
(52885,52,'YACUANQUER'),
(54001,54,'CÚCUTA'),
(54003,54,'ÁBREGO'),
(54051,54,'ARBOLEDAS'),
(54099,54,'BOCHALEMA'),
(54109,54,'BUCARASICA'),
(54125,54,'CÁCOTA'),
(54128,54,'CÁCHIRA'),
(54172,54,'CHINÁCOTA'),
(54174,54,'CHITAGÁ'),
(54206,54,'CONVENCIÓN'),
(54223,54,'CUCUTILLA'),
(54239,54,'DURANIA'),
(54245,54,'EL CARMEN'),
(54250,54,'EL TARRA'),
(54261,54,'EL ZULIA'),
(54313,54,'GRAMALOTE'),
(54344,54,'HACARÍ'),
(54347,54,'HERRÁN'),
(54377,54,'LABATECA'),
(54385,54,'LA ESPERANZA'),
(54398,54,'LA PLAYA'),
(54405,54,'LOS PATIOS'),
(54418,54,'LOURDES'),
(54480,54,'MUTISCUA'),
(54498,54,'OCAÑA'),
(54518,54,'PAMPLONA'),
(54520,54,'PAMPLONITA'),
(54553,54,'PUERTO SANTANDER'),
(54599,54,'RAGONVALIA'),
(54660,54,'SALAZAR'),
(54670,54,'SAN CALIXTO'),
(54673,54,'SAN CAYETANO'),
(54680,54,'SANTIAGO'),
(54720,54,'SARDINATA'),
(54743,54,'SILOS'),
(54800,54,'TEORAMA'),
(54810,54,'TIBÚ'),
(54820,54,'TOLEDO'),
(54871,54,'VILLA CARO'),
(54874,54,'VILLA DEL ROSARIO'),
(63001,63,'ARMENIA'),
(63111,63,'BUENAVISTA'),
(63130,63,'CALARCÁ'),
(63190,63,'CIRCASIA'),
(63212,63,'CÓRDOBA'),
(63272,63,'FILANDIA'),
(63302,63,'GÉNOVA'),
(63401,63,'LA TEBAIDA'),
(63470,63,'MONTENEGRO'),
(63548,63,'PIJAO'),
(63594,63,'QUIMBAYA'),
(63690,63,'SALENTO'),
(66001,66,'PEREIRA'),
(66045,66,'APÍA'),
(66075,66,'BALBOA'),
(66088,66,'BELÉN DE UMBRÍA'),
(66170,66,'DOSQUEBRADAS'),
(66318,66,'GUÁTICA'),
(66383,66,'LA CELIA'),
(66400,66,'LA VIRGINIA'),
(66440,66,'MARSELLA'),
(66456,66,'MISTRATÓ'),
(66572,66,'PUEBLO RICO'),
(66594,66,'QUINCHÍA'),
(66682,66,'SANTA ROSA DE CABAL'),
(66687,66,'SANTUARIO'),
(68001,68,'BUCARAMANGA'),
(68013,68,'AGUADA'),
(68020,68,'ALBANIA'),
(68051,68,'ARATOCA'),
(68077,68,'BARBOSA'),
(68079,68,'BARICHARA'),
(68081,68,'BARRANCABERMEJA'),
(68092,68,'BETULIA'),
(68101,68,'BOLÍVAR'),
(68121,68,'CABRERA'),
(68132,68,'CALIFORNIA'),
(68147,68,'CAPITANEJO'),
(68152,68,'CARCASÍ'),
(68160,68,'CEPITÁ'),
(68162,68,'CERRITO'),
(68167,68,'CHARALÁ'),
(68169,68,'CHARTA'),
(68176,68,'CHIMA'),
(68179,68,'CHIPATÁ'),
(68190,68,'CIMITARRA'),
(68207,68,'CONCEPCIÓN'),
(68209,68,'CONFINES'),
(68211,68,'CONTRATACIÓN'),
(68217,68,'COROMORO'),
(68229,68,'CURITÍ'),
(68235,68,'EL CARMEN DE CHUCURÍ'),
(68245,68,'EL GUACAMAYO'),
(68250,68,'EL PEÑÓN'),
(68255,68,'EL PLAYÓN'),
(68264,68,'ENCINO'),
(68266,68,'ENCISO'),
(68271,68,'FLORIÁN'),
(68276,68,'FLORIDABLANCA'),
(68296,68,'GALÁN'),
(68298,68,'GÁMBITA'),
(68307,68,'GIRÓN'),
(68318,68,'GUACA'),
(68320,68,'GUADALUPE'),
(68322,68,'GUAPOTÁ'),
(68324,68,'GUAVATÁ'),
(68327,68,'GÜEPSA'),
(68344,68,'HATO'),
(68368,68,'JESÚS MARÍA'),
(68370,68,'JORDÁN'),
(68377,68,'LA BELLEZA'),
(68385,68,'LANDÁZURI'),
(68397,68,'LA PAZ'),
(68406,68,'LEBRIJA'),
(68418,68,'LOS SANTOS'),
(68425,68,'MACARAVITA'),
(68432,68,'MÁLAGA'),
(68444,68,'MATANZA'),
(68464,68,'MOGOTES'),
(68468,68,'MOLAGAVITA'),
(68498,68,'OCAMONTE'),
(68500,68,'OIBA'),
(68502,68,'ONZAGA'),
(68522,68,'PALMAR'),
(68524,68,'PALMAS DEL SOCORRO'),
(68533,68,'PÁRAMO'),
(68547,68,'PIEDECUESTA'),
(68549,68,'PINCHOTE'),
(68572,68,'PUENTE NACIONAL'),
(68573,68,'PUERTO PARRA'),
(68575,68,'PUERTO WILCHES'),
(68615,68,'RIONEGRO'),
(68655,68,'SABANA DE TORRES'),
(68669,68,'SAN ANDRÉS'),
(68673,68,'SAN BENITO'),
(68679,68,'SAN GIL'),
(68682,68,'SAN JOAQUÍN'),
(68684,68,'SAN JOSÉ DE MIRANDA'),
(68686,68,'SAN MIGUEL'),
(68689,68,'SAN VICENTE DE CHUCURÍ'),
(68705,68,'SANTA BÁRBARA'),
(68720,68,'SANTA HELENA DEL OPÓN'),
(68745,68,'SIMACOTA'),
(68755,68,'SOCORRO'),
(68770,68,'SUAITA'),
(68773,68,'SUCRE'),
(68780,68,'SURATÁ'),
(68820,68,'TONA'),
(68855,68,'VALLE DE SAN JOSÉ'),
(68861,68,'VÉLEZ'),
(68867,68,'VETAS'),
(68872,68,'VILLANUEVA'),
(68895,68,'ZAPATOCA'),
(70001,70,'SINCELEJO'),
(70110,70,'BUENAVISTA'),
(70124,70,'CAIMITO'),
(70204,70,'COLOSÓ'),
(70215,70,'COROZAL'),
(70221,70,'COVEÑAS'),
(70230,70,'CHALÁN'),
(70233,70,'EL ROBLE'),
(70235,70,'GALERAS'),
(70265,70,'GUARANDA'),
(70400,70,'LA UNIÓN'),
(70418,70,'LOS PALMITOS'),
(70429,70,'MAJAGUAL'),
(70473,70,'MORROA'),
(70508,70,'OVEJAS'),
(70523,70,'PALMITO'),
(70670,70,'SAMPUÉS'),
(70678,70,'SAN BENITO ABAD'),
(70702,70,'SAN JUAN DE BETULIA'),
(70708,70,'SAN MARCOS'),
(70713,70,'SAN ONOFRE'),
(70717,70,'SAN PEDRO'),
(70742,70,'SAN LUIS DE SINCÉ'),
(70771,70,'SUCRE'),
(70820,70,'SANTIAGO DE TOLÚ'),
(70823,70,'TOLÚ VIEJO'),
(73001,73,'IBAGUÉ'),
(73024,73,'ALPUJARRA'),
(73026,73,'ALVARADO'),
(73030,73,'AMBALEMA'),
(73043,73,'ANZOÁTEGUI'),
(73055,73,'ARMERO GUAYABAL'),
(73067,73,'ATACO'),
(73124,73,'CAJAMARCA'),
(73148,73,'CARMEN DE APICALÁ'),
(73152,73,'CASABIANCA'),
(73168,73,'CHAPARRAL'),
(73200,73,'COELLO'),
(73217,73,'COYAIMA'),
(73226,73,'CUNDAY'),
(73236,73,'DOLORES'),
(73268,73,'ESPINAL'),
(73270,73,'FALAN'),
(73275,73,'FLANDES'),
(73283,73,'FRESNO'),
(73319,73,'GUAMO'),
(73347,73,'HERVEO'),
(73349,73,'HONDA'),
(73352,73,'ICONONZO'),
(73408,73,'LÉRIDA'),
(73411,73,'LÍBANO'),
(73443,73,'SAN SEBASTIÁN DE MARIQUITA'),
(73449,73,'MELGAR'),
(73461,73,'MURILLO'),
(73483,73,'NATAGAIMA'),
(73504,73,'ORTEGA'),
(73520,73,'PALOCABILDO'),
(73547,73,'PIEDRAS'),
(73555,73,'PLANADAS'),
(73563,73,'PRADO'),
(73585,73,'PURIFICACIÓN'),
(73616,73,'RIOBLANCO'),
(73622,73,'RONCESVALLES'),
(73624,73,'ROVIRA'),
(73671,73,'SALDAÑA'),
(73675,73,'SAN ANTONIO'),
(73678,73,'SAN LUIS'),
(73686,73,'SANTA ISABEL'),
(73770,73,'SUÁREZ'),
(73854,73,'VALLE DE SAN JUAN'),
(73861,73,'VENADILLO'),
(73870,73,'VILLAHERMOSA'),
(73873,73,'VILLARRICA'),
(76001,76,'CALI'),
(76020,76,'ALCALÁ'),
(76036,76,'ANDALUCÍA'),
(76041,76,'ANSERMANUEVO'),
(76054,76,'ARGELIA'),
(76100,76,'BOLÍVAR'),
(76109,76,'BUENAVENTURA'),
(76111,76,'GUADALAJARA DE BUGA'),
(76113,76,'BUGALAGRANDE'),
(76122,76,'CAICEDONIA'),
(76126,76,'CALIMA'),
(76130,76,'CANDELARIA'),
(76147,76,'CARTAGO'),
(76233,76,'DAGUA'),
(76243,76,'EL ÁGUILA'),
(76246,76,'EL CAIRO'),
(76248,76,'EL CERRITO'),
(76250,76,'EL DOVIO'),
(76275,76,'FLORIDA'),
(76306,76,'GINEBRA'),
(76318,76,'GUACARÍ'),
(76364,76,'JAMUNDÍ'),
(76377,76,'LA CUMBRE'),
(76400,76,'LA UNIÓN'),
(76403,76,'LA VICTORIA'),
(76497,76,'OBANDO'),
(76520,76,'PALMIRA'),
(76563,76,'PRADERA'),
(76606,76,'RESTREPO'),
(76616,76,'RIOFRÍO'),
(76622,76,'ROLDANILLO'),
(76670,76,'SAN PEDRO'),
(76736,76,'SEVILLA'),
(76823,76,'TORO'),
(76828,76,'TRUJILLO'),
(76834,76,'TULUÁ'),
(76845,76,'ULLOA'),
(76863,76,'VERSALLES'),
(76869,76,'VIJES'),
(76890,76,'YOTOCO'),
(76892,76,'YUMBO'),
(76895,76,'ZARZAL'),
(81001,81,'ARAUCA'),
(81065,81,'ARAUQUITA'),
(81220,81,'CRAVO NORTE'),
(81300,81,'FORTUL'),
(81591,81,'PUERTO RONDÓN'),
(81736,81,'SARAVENA'),
(81794,81,'TAME'),
(85001,85,'YOPAL'),
(85010,85,'AGUAZUL'),
(85015,85,'CHÁMEZA'),
(85125,85,'HATO COROZAL'),
(85136,85,'LA SALINA'),
(85139,85,'MANÍ'),
(85162,85,'MONTERREY'),
(85225,85,'NUNCHÍA'),
(85230,85,'OROCUÉ'),
(85250,85,'PAZ DE ARIPORO'),
(85263,85,'PORE'),
(85279,85,'RECETOR'),
(85300,85,'SABANALARGA'),
(85315,85,'SÁCAMA'),
(85325,85,'SAN LUIS DE PALENQUE'),
(85400,85,'TÁMARA'),
(85410,85,'TAURAMENA'),
(85430,85,'TRINIDAD'),
(85440,85,'VILLANUEVA'),
(86001,86,'MOCOA'),
(86219,86,'COLÓN'),
(86320,86,'ORITO'),
(86568,86,'PUERTO ASÍS'),
(86569,86,'PUERTO CAICEDO'),
(86571,86,'PUERTO GUZMÁN'),
(86573,86,'PUERTO LEGUÍZAMO'),
(86749,86,'SIBUNDOY'),
(86755,86,'SAN FRANCISCO'),
(86757,86,'SAN MIGUEL'),
(86760,86,'SANTIAGO'),
(86865,86,'VALLE DEL GUAMUEZ'),
(86885,86,'VILLAGARZÓN'),
(88001,88,'SAN ANDRÉS'),
(88564,88,'PROVIDENCIA'),
(91001,91,'LETICIA'),
(91263,91,'EL ENCANTO'),
(91405,91,'LA CHORRERA'),
(91407,91,'LA PEDRERA'),
(91430,91,'LA VICTORIA'),
(91460,91,'MIRITÍ - PARANÁ'),
(91530,91,'PUERTO ALEGRÍA'),
(91536,91,'PUERTO ARICA'),
(91540,91,'PUERTO NARIÑO'),
(91669,91,'PUERTO SANTANDER'),
(91798,91,'TARAPACÁ'),
(94001,94,'INÍRIDA'),
(94343,94,'BARRANCO MINAS'),
(94663,94,'MAPIRIPANA'),
(94883,94,'SAN FELIPE'),
(94884,94,'PUERTO COLOMBIA'),
(94885,94,'LA GUADALUPE'),
(94886,94,'CACAHUAL'),
(94887,94,'PANA PANA'),
(94888,94,'MORICHAL'),
(95001,95,'SAN JOSÉ DEL GUAVIARE'),
(95015,95,'CALAMAR'),
(95025,95,'EL RETORNO'),
(95200,95,'MIRAFLORES'),
(97001,97,'MITÚ'),
(97161,97,'CARURÚ'),
(97511,97,'PACOA'),
(97666,97,'TARAIRA'),
(97777,97,'PAPUNAUA'),
(97889,97,'YAVARATÉ'),
(99001,99,'PUERTO CARREÑO'),
(99524,99,'LA PRIMAVERA'),
(99624,99,'SANTA ROSALÍA'),
(99773,99,'CUMARIBO');

/*Data for the table `config_origen_correspondencia` */

insert  into `config_origen_correspondencia`(`id_origen`,`nom_origen`) values 
(1,'Correspondencia recibida'),
(2,'Correspondencia enviada'),
(3,'Correspondencia interna'),
(4,'Plantillas'),
(5,'PQRSF');

/*Data for the table `config_saludo` */

insert  into `config_saludo`(`id_saludo`,`saludo`,`acti`) values 
(1,'Buenas tarde',1),
(2,'Buenos días',1),
(3,'Cordial saludo',1);

/*Data for the table `config_status` */

insert  into `config_status`(`id_status`,`status`,`acti`) values 
(1,'Doctor',0),
(2,'Doctora',0),
(3,'Señor',0),
(4,'Señora',0);

/*Data for the table `config_tipo_correspondencia` */

insert  into `config_tipo_correspondencia`(`id_tipo`,`id_origen`,`nom_tipo`,`acti`,`ver_radicar`) values 
(1,1,'Correspondencia recibida',1,NULL),
(2,2,'Correspondencia enviada',1,NULL),
(3,3,'Correspondencia interna',1,NULL),
(4,5,'Pregunta',1,NULL),
(5,5,'Queja',1,NULL),
(6,5,'Reclamo',1,NULL),
(7,5,'Solicitud',1,NULL),
(8,5,'Felicitaciones',1,NULL),
(9,1,'PQRSF – Oportunidad',1,NULL),
(10,1,'PQRSF - Servicio',1,NULL),
(11,1,'PQRSF – Calidez',1,NULL),
(12,1,'PQRSF - Información',1,NULL);

/*Data for the table `config_tipo_documento` */

insert  into `config_tipo_documento`(`id_tipo`,`cod_tipo`,`nom_tipo`,`acti`) values 
(1,'NI','Nit',1),
(2,'CC','Cedula',1),
(3,'CE','Cedula de Extranjeria',1),
(4,'RC','Registro Civil',1),
(5,'TI','Tarjeta de Identidad',1),
(7,'AS','Adulto Sin Identificacion',1),
(8,'MS','Menor Sin Identificacion',1),
(9,'NU','Numero Unico',1),
(10,'RU','Rut',1),
(11,'PA','PASAPORTE',1);

/*Data for the table `config_tipos_respuestas` */

insert  into `config_tipos_respuestas`(`id_respue`,`nom_respues`,`acti`) values 
(1,'NO APLICA',1),
(2,'APROBADO',1),
(3,'NEGADA',1),
(4,'SIN RESPUESTA',0),
(5,'TRASLADADA',1);

/*Data for the table `segu_modu` */

insert  into `segu_modu`(`id_modu`,`nom_modu`,`menu`,`boton`,`link`,`acti`) values 
(8,'General - Funcionarios','Men_Gene_Funcionarios','BtnFuncionarios',NULL,1),
(9,'General - Persona Natural','Men_Gene_Remite_Natural','BtnRemitentes',NULL,1),
(10,'General - Presona Juridica','Men_Gene_Remite_Juridi',NULL,NULL,1),
(12,'Radicar Correspondencia','Men_Venta_Unica_Radica','BtnRadicar',NULL,1),
(15,'Ofi. Archivo - Explorador de Series','Men_OfiArchi_Reten_Series',NULL,NULL,1),
(16,'Ofi. Archivo - Explorador Tipos de Series','Men_OfiArchi_Reten_TipoSeries',NULL,NULL,1),
(17,'Ofi. Archivo - Explorador de Subserie','Men_OfiArchi_Reten_SubSeries',NULL,NULL,1),
(18,'Ofi. Archivo - Explorador Tipos de Documentos','Men_OfiArchi_Reten_TipoDocumento',NULL,NULL,1),
(20,'Áreas - Dependencias','Men_Areas_Dependen',NULL,NULL,1),
(21,'Áreas - Oficinas','Men_Areas_Oficinas',NULL,NULL,1),
(22,'Áreas - Cargos','Men_Areas_Cargos',NULL,NULL,1),
(24,'Áreas - Expedientes','Men_Areas_Expedientes','BtnExpedientes',NULL,1),
(26,'Configuración - Rutas de Archivo de Gestión','Men_Config_RutasGestion',NULL,NULL,1),
(27,'Configuración - Rutas para archivos Temp','Men_Config_RutasTemp',NULL,NULL,1),
(29,'Configuración - Medios Fisicos','Men_Config_MedioFisico',NULL,NULL,1),
(30,'Configuración - Formas de Envio','Men_Config_FormaEnvio',NULL,NULL,1),
(31,'Configuración - Saludo','Men_Config_Saludo',NULL,NULL,1),
(32,'Configuración - Despedida','Men_Config_Depedida',NULL,NULL,1),
(33,'Configuración - Estatus','Men_Config_Estatus',NULL,NULL,1),
(35,'Seguridad - Explorador de Usuarios','Men_Seguri_Explora',NULL,NULL,1),
(36,'Seguridad - Explorador de Perfiles','Men_Seguri_Perfiles',NULL,NULL,1),
(38,'Ofi. Archivo - Retención Documental','Men_OfiArchi_TRD',NULL,NULL,1),
(40,'Mi Archivo - Bandeja De Correo','Men_Mi_Archivo_Bandeja','BtnBandeja',NULL,1),
(41,'Mi Archivo - Mi Disco','Men_Mi_Disco',NULL,NULL,1),
(43,'Reportes - Ventanilla Unica','Men_Reportes_Ventanilla',NULL,NULL,1),
(44,'Configuración - Otras configuraciones','Men_Config_Otras',NULL,NULL,1),
(46,'Ofi. Archivo - TRD','Men_OfiArchi_TRD_TRD',NULL,NULL,1),
(47,'Ofi. Archivo - Digitalización','Men_OfiArchi_Digitalizacion',NULL,NULL,1),
(48,'Configuración - Rutas para digitalización','Men_Config_RutasDigitalizacion',NULL,NULL,1),
(50,'Ofi. Archivo - Digitalizar','Men_OfiArchi_Digitalizar',NULL,NULL,1),
(51,'Reportes - Ofi. Archivo','Men_Reportes_Ofi_Archivo',NULL,NULL,1),
(52,'Mi Archivo - Acceso a archivo digitalizado','Men_Mi_Archivo_Digitalizados',NULL,NULL,1),
(55,'Calidad - Procesos','Men_Calidad_Procesos',NULL,NULL,1),
(56,'Calidad - Tipo de documentos','Men_Calidad_Tipos_Documentos',NULL,NULL,1),
(57,'Calidad - Gestionar Repositorio','Men_Caldiad_Gestionar_Repositorio',NULL,NULL,1),
(58,'Calidad - Procedimientos','Men_Calidad_Procedimientos',NULL,NULL,1),
(59,'Ofi. Archivo - Digitalizar TVD','Men_OfiArchi_Digitalizacion_TVD',NULL,NULL,1),
(60,'Ofi. Archivo - Configuración Organigrama TVD','Men_OfiArchi_Configuracion_Organigrama_TVD',NULL,NULL,1),
(61,'Configuración - Rutas para calidad','Men_Config_Calidad',NULL,NULL,1),
(62,'Calidad - Consultar Repositorio','Men_Calidad_Consulta_Repositorio',NULL,NULL,1);

/*Data for the table `segu_perfiles` */

insert  into `segu_perfiles`(`id_perfil`,`nom_perfil`,`observa`,`acti`) values 
(1,'RADICADOR','',1),
(2,'ADMINISTRADOR','',1),
(3,'MI ARCHIVO','',1),
(4,'REPORTES','',1),
(5,'Digitalizador','',1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archivo_digitales_trd`
--
ALTER TABLE `archivo_digitales_trd`
  ADD PRIMARY KEY (`id_digital`),
  ADD KEY `fk_archivo_digital_archivos_archivo_trd_series1_idx` (`id_serie`),
  ADD KEY `fk_archivo_digital_archivos_archivo_trd_subserie1_idx` (`id_subserie`),
  ADD KEY `fk_archivo_digital_areas_dependencias1_idx` (`id_depen`),
  ADD KEY `fk_archivo_digitales_areas_oficinas1_idx` (`id_oficina`);

--
-- Indices de la tabla `archivo_digitales_trd_detalle`
--
ALTER TABLE `archivo_digitales_trd_detalle`
  ADD PRIMARY KEY (`id_archivo`),
  ADD KEY `fk_archivo_digital_archivos_archivo_digital1_idx` (`id_digital`),
  ADD KEY `fk_archivo_digitales_detalle_archivo_trd_tipo_docu1_idx` (`id_tipodoc`),
  ADD KEY `fk_archivo_digitales_detalle_config_rutas_archi_digitalizad_idx` (`id_ruta`),
  ADD KEY `fk_archivo_digitales_detalle_TRD_archivo_digitales_tomos_TR_idx` (`id_tomo`);

--
-- Indices de la tabla `archivo_digitales_trd_tomos`
--
ALTER TABLE `archivo_digitales_trd_tomos`
  ADD PRIMARY KEY (`id_tomo`),
  ADD KEY `fk_archivo_digitales_tomos_TRD_archivo_digitales_TRD1_idx` (`id_digital`);

--
-- Indices de la tabla `archivo_digitales_tvd`
--
ALTER TABLE `archivo_digitales_tvd`
  ADD PRIMARY KEY (`id_digital`),
  ADD KEY `fk_archivo_digitales_tvd_areas_dependencias_tvd1_idx` (`id_depen`),
  ADD KEY `fk_archivo_digitales_tvd_areas_oficinas_tvd1_idx` (`id_oficina`),
  ADD KEY `fk_archivo_digitales_tvd_archivo_tvd_series1_idx` (`id_serie`),
  ADD KEY `fk_archivo_digitales_tvd_archivo_tvd_subserie1_idx` (`id_subserie`);

--
-- Indices de la tabla `archivo_digitales_tvd_detalle`
--
ALTER TABLE `archivo_digitales_tvd_detalle`
  ADD PRIMARY KEY (`id_archivo`),
  ADD KEY `fk_archivo_digital_archivos_archivo_digital1_idx` (`id_digital`),
  ADD KEY `fk_archivo_digitales_detalle_archivo_trd_tipo_docu1_idx` (`id_tipodoc`),
  ADD KEY `fk_archivo_digitales_detalle_config_rutas_archi_digitalizad_idx` (`id_ruta`),
  ADD KEY `fk_archivo_digitales_detalle_TRD_archivo_digitales_tomos_TR_idx` (`id_tomo`);

--
-- Indices de la tabla `archivo_digitales_tvd_tomos`
--
ALTER TABLE `archivo_digitales_tvd_tomos`
  ADD PRIMARY KEY (`id_tomo`),
  ADD KEY `fk_archivo_digitales_tomos_TRD_archivo_digitales_TRD1_idx` (`id_digital`);

--
-- Indices de la tabla `archivo_radica_enviados`
--
ALTER TABLE `archivo_radica_enviados`
  ADD PRIMARY KEY (`id_radica`),
  ADD KEY `fk_radica_externa_config_formaenvio1_idx` (`id_formaenvio`),
  ADD KEY `fk_radica_externa_serie` (`id_serie`),
  ADD KEY `fk_radica_externa_subserie` (`id_subserie`),
  ADD KEY `fk_radica_externa_usua_impri_rotulo_idx` (`usua_impri_rotu`),
  ADD KEY `fk_archivo_radica_externa_segu_usua1_idx` (`id_usua_regis`),
  ADD KEY `archivo_radica_enviados_fec_radica` (`fechor_radica`),
  ADD KEY `archivo_radica_enviados_digital` (`digital`),
  ADD KEY `fk_archivo_radica_enviados_config_tipos_respuestas1_idx` (`id_tipo_respue`),
  ADD KEY `fk_archivo_radica_enviados_archivo_trd_tipo_docu1_idx` (`id_tipodoc`),
  ADD KEY `fk_archivo_radica_enviados_gene_terceros_contac1_idx` (`id_destina`);
ALTER TABLE `archivo_radica_enviados` ADD FULLTEXT KEY `archivo_radica_enviados_asunto` (`asunto`);

--
-- Indices de la tabla `archivo_radica_enviados_archivos`
--
ALTER TABLE `archivo_radica_enviados_archivos`
  ADD PRIMARY KEY (`id_archivo`),
  ADD KEY `fk_archivo_radica_enviados_archivos_archivo_radica_enviados_idx` (`id_radica`);

--
-- Indices de la tabla `archivo_radica_enviados_proyector`
--
ALTER TABLE `archivo_radica_enviados_proyector`
  ADD KEY `fk_archivo_radica_salida_proyector_archivo_radica_salida1_idx` (`id_radica`),
  ADD KEY `fk_archivo_radica_salida_proyector_gene_funcionarios_deta1_idx` (`id_funcio_deta`);

--
-- Indices de la tabla `archivo_radica_enviados_quienes_firman`
--
ALTER TABLE `archivo_radica_enviados_quienes_firman`
  ADD KEY `id_radica` (`id_radica`),
  ADD KEY `id_funcio_deta` (`id_funcio_deta`);

--
-- Indices de la tabla `archivo_radica_enviados_responsa`
--
ALTER TABLE `archivo_radica_enviados_responsa`
  ADD KEY `fk_archivo_radica_salida_responsa_archivo_radica_salida1_idx` (`id_radica`),
  ADD KEY `fk_archivo_radica_salida_responsa_gene_funcionarios_deta1_idx` (`id_funcio_deta`);

--
-- Indices de la tabla `archivo_radica_enviados_respuestas`
--
ALTER TABLE `archivo_radica_enviados_respuestas`
  ADD KEY `fk_archivo_radica_enviados_respuestas_archivo_radica_enviad_idx` (`id_radica_enviado`),
  ADD KEY `fk_archivo_radica_enviados_respuestas_archivo_radica_recibi_idx` (`id_radica_recivido`),
  ADD KEY `fk_archivo_radica_enviados_respuestas_segu_usua1_idx` (`id_usua_regis`);

--
-- Indices de la tabla `archivo_radica_enviados_temp`
--
ALTER TABLE `archivo_radica_enviados_temp`
  ADD PRIMARY KEY (`id_temp`),
  ADD KEY `fk_archivo_radica_salida_temp_id_tipodoc_idx` (`id_tipodoc`),
  ADD KEY `fk_archivo_radica_salida_temp_archivo_trd_series1_idx` (`id_serie`),
  ADD KEY `fk_archivo_radica_salida_temp_archivo_trd_series_subserie1_idx` (`id_subserie`),
  ADD KEY `fk_archivo_radica_salida_temp_gene_funcionarios_deta1_idx` (`id_usua_regis`),
  ADD KEY `fk_archivo_radica_salida_temp_config_status1_idx` (`id_status`),
  ADD KEY `fk_archivo_radica_salida_temp_config_saludo1_idx` (`id_saludo`),
  ADD KEY `fk_archivo_radica_salida_temp_config_despedida1_idx` (`id_despedida`),
  ADD KEY `fk_archivo_radica_enviados_temp_config_rutas_archi_temp1_idx` (`id_ruta`),
  ADD KEY `fk_archivo_radica_enviados_temp_gene_funcionarios_deta2_idx` (`id_funcio_deta_anula`),
  ADD KEY `fk_archivo_radica_enviados_temp_gene_terceros_contac1_idx` (`id_destina`);

--
-- Indices de la tabla `archivo_radica_enviados_temp_nota`
--
ALTER TABLE `archivo_radica_enviados_temp_nota`
  ADD PRIMARY KEY (`id_nota`),
  ADD KEY `fk_archivo_radica_enviados_temp_archivo_radica_enviados_tem_idx` (`id_temp`),
  ADD KEY `fk_archivo_radica_enviados_temp_gene_funcionarios_deta1_idx` (`id_funcio_deta`);

--
-- Indices de la tabla `archivo_radica_enviados_temp_proyector`
--
ALTER TABLE `archivo_radica_enviados_temp_proyector`
  ADD KEY `fk_archivo_radica_salida_temp_proyector_gene_funcionarios_d_idx` (`id_funcio_deta`),
  ADD KEY `fk_archivo_radica_salida_temp_proyector_archivo_radica_sali_idx` (`id_temp`);

--
-- Indices de la tabla `archivo_radica_enviados_temp_quienes_firman`
--
ALTER TABLE `archivo_radica_enviados_temp_quienes_firman`
  ADD KEY `fk_archivo_radica_salida_temp_responsa_archivo_radica_salid_idx` (`id_temp`),
  ADD KEY `fk_archivo_radica_salida_temp_responsa_gene_funcionarios_de_idx` (`id_funcio_deta`);

--
-- Indices de la tabla `archivo_radica_enviados_temp_radica_respuesta`
--
ALTER TABLE `archivo_radica_enviados_temp_radica_respuesta`
  ADD KEY `fk_archivo_radica_enviados_temp_radica_respuesta_archivo_ra_idx` (`id_temp`);

--
-- Indices de la tabla `archivo_radica_enviados_temp_responsa`
--
ALTER TABLE `archivo_radica_enviados_temp_responsa`
  ADD KEY `fk_archivo_radica_salida_temp_responsa_archivo_radica_salid_idx` (`id_temp`),
  ADD KEY `fk_archivo_radica_salida_temp_responsa_gene_funcionarios_de_idx` (`id_funcio_deta`);

--
-- Indices de la tabla `archivo_radica_enviados_temp_version`
--
ALTER TABLE `archivo_radica_enviados_temp_version`
  ADD PRIMARY KEY (`id_version`),
  ADD KEY `fk_archivo_radica_enviados_temp_ver_archivo_radica_enviados_idx` (`id_temp`);

--
-- Indices de la tabla `archivo_radica_interna`
--
ALTER TABLE `archivo_radica_interna`
  ADD PRIMARY KEY (`id_radica`),
  ADD KEY `fk_archivo_radica_interna_serie_idx` (`id_serie`),
  ADD KEY `fk_archivo_radica_interna_sub_serie_idx` (`id_subserie`),
  ADD KEY `fk_archivo_radica_interna_tipo_documento_idx` (`id_tipodoc`),
  ADD KEY `fk_archivo_radica_interna_gene_funcionarios_deta1_idx` (`id_funcio_regis`),
  ADD KEY `archivo_radica_interna_fec_radica` (`fechor_radica`),
  ADD KEY `archivo_radica_interna_fec_venci` (`fec_venci`);
ALTER TABLE `archivo_radica_interna` ADD FULLTEXT KEY `archivo_radica_interna_full_textos` (`asunto`,`texto`);

--
-- Indices de la tabla `archivo_radica_interna_adjuntos`
--
ALTER TABLE `archivo_radica_interna_adjuntos`
  ADD PRIMARY KEY (`id_archivo`),
  ADD KEY `fk_archivo_radica_interna_adjuntos_archivo_radica_interna1_idx` (`id_radica`);

--
-- Indices de la tabla `archivo_radica_interna_destinata`
--
ALTER TABLE `archivo_radica_interna_destinata`
  ADD KEY `fk_archivo_radica_interna_destinata_gene_funcionarios_deta1_idx` (`id_funcio_deta`),
  ADD KEY `fk_archivo_radica_interna_destinata_archivo_radica_interna1_idx` (`id_radica`);

--
-- Indices de la tabla `archivo_radica_interna_proyectores`
--
ALTER TABLE `archivo_radica_interna_proyectores`
  ADD KEY `fk_archivo_radica_interna_proyectores_archivo_radica_intern_idx` (`id_radica`),
  ADD KEY `fk_archivo_radica_interna_proyectores_gene_funcionarios_det_idx` (`id_funcio_deta`);

--
-- Indices de la tabla `archivo_radica_interna_responsa`
--
ALTER TABLE `archivo_radica_interna_responsa`
  ADD KEY `fk_archivo_radica_entra_responsa_gene_funcionarios_deta1_idx1` (`id_funcio`),
  ADD KEY `fk_archivo_radica_interna_responsa_archivo_radica_interna1_idx` (`id_radica`);

--
-- Indices de la tabla `archivo_radica_recibidos`
--
ALTER TABLE `archivo_radica_recibidos`
  ADD PRIMARY KEY (`id_radica`),
  ADD KEY `fk_radica_externa_config_formaenvio1_idx` (`id_forma_llegada`),
  ADD KEY `fk_radica_externa_usua_impri_rotulo_idx` (`usua_impri_rotu`),
  ADD KEY `fk_archivo_radica_externa_segu_usua1_idx` (`id_usua_regis`),
  ADD KEY `fk_archivo_radica_entra_archivo_trd_tipo_docu1_idx` (`id_tipodoc`),
  ADD KEY `fk_archivo_radica_entra_archivo_trd_series1_idx` (`id_serie`),
  ADD KEY `fk_archivo_radica_entra_archivo_trd_subserie1_idx` (`id_subserie`),
  ADD KEY `archivo_radica_recibidos_fec_radica` (`fechor_radica`),
  ADD KEY `archivo_radica_recibidos_digital` (`digital`),
  ADD KEY `fk_archivo_radica_recibidos_gene_terceros_contac1_idx` (`id_remite`),
  ADD KEY `fk_archivo_radica_recibidos_config_tipo_correspondencia1_idx` (`id_tipo_correspon`),
  ADD KEY `fk_archivo_radica_recibidos_config_rutas_archi_gestion1_idx` (`id_ruta`);
ALTER TABLE `archivo_radica_recibidos` ADD FULLTEXT KEY `archivo_radica_recibidos_asunto` (`asunto`);

--
-- Indices de la tabla `archivo_radica_recibidos_grupos_colaborativo`
--
ALTER TABLE `archivo_radica_recibidos_grupos_colaborativo`
  ADD PRIMARY KEY (`id_crea_grupo`),
  ADD KEY `fk_archivo_radica_recibidos_grupo_colaborativo_archivo_radi_idx` (`id_radica`),
  ADD KEY `fk_archivo_radica_recibidos_grupo_colaborativo_gene_funcion_idx` (`id_funcio_deta_asingnado`),
  ADD KEY `fk_archivo_radica_recibidos_grupo_colaborativo_gene_funcion_idx1` (`id_funcio_deta_asigno`);

--
-- Indices de la tabla `archivo_radica_recibidos_hc`
--
ALTER TABLE `archivo_radica_recibidos_hc`
  ADD KEY `fk_archivo_radica_recibidos_hc_archivo_radica_recibidos1_idx` (`id_radica`),
  ADD KEY `fk_archivo_radica_recibidos_hc_gene_remitentes_contac1_idx` (`id_tercero_facul`);

--
-- Indices de la tabla `archivo_radica_recibidos_pase`
--
ALTER TABLE `archivo_radica_recibidos_pase`
  ADD PRIMARY KEY (`id_pase`),
  ADD KEY `fk_archivo_radica_recibidos_pase_gene_funcionarios_deta1_idx` (`id_funcio_deta_origen`),
  ADD KEY `fk_archivo_radica_recibidos_pase_gene_funcionarios_deta2_idx` (`id_funcio_deta_destino`),
  ADD KEY `fk_archivo_radica_recibidos_pase_archivo_radica_recibidos1_idx` (`id_radica`);

--
-- Indices de la tabla `archivo_radica_recibidos_pqrsf`
--
ALTER TABLE `archivo_radica_recibidos_pqrsf`
  ADD PRIMARY KEY (`id_pqr`),
  ADD KEY `fk_archivo_radica_pqr_archivo_radica_recibidos1_idx` (`id_radica`),
  ADD KEY `fk_archivo_radica_pqr_config_tipo_documento1_idx` (`id_tipo_docu_afectado`),
  ADD KEY `fk_archivo_radica_pqr_gene_terceros_contac1_idx` (`id_contacto`),
  ADD KEY `fk_archivo_radica_pqr_config_depar1_idx` (`id_depar_afectado`),
  ADD KEY `fk_archivo_radica_pqr_config_muni1_idx` (`id_muni_afectado`),
  ADD KEY `fk_archivo_radica_recibidos_pqrsf_config_tipo_correspondenc_idx` (`id_tipodocumental`);

--
-- Indices de la tabla `archivo_radica_recibidos_pqrsf_archivos`
--
ALTER TABLE `archivo_radica_recibidos_pqrsf_archivos`
  ADD PRIMARY KEY (`id_pqr_archivo`),
  ADD KEY `fk_archivo_radica_recibidos_pqrsf_archivos_archivo_radica_r_idx` (`id_pqr`);

--
-- Indices de la tabla `archivo_radica_recibidos_responsa`
--
ALTER TABLE `archivo_radica_recibidos_responsa`
  ADD KEY `fk_radica_exter_destina_radica_extrerna1_idx` (`id_radica`),
  ADD KEY `fk_archivo_radica_entra_responsa_gene_funcionarios_deta1_idx1` (`id_funcio`);

--
-- Indices de la tabla `archivo_radica_recibido_compartidos`
--
ALTER TABLE `archivo_radica_recibido_compartidos`
  ADD KEY `fk_archivo_radica_recibido_compartir_archivo_radica_recibid_idx` (`id_radica`),
  ADD KEY `fk_archivo_radica_recibido_compartir_gene_funcionarios_deta_idx` (`id_funcio_deta_origen`),
  ADD KEY `fk_archivo_radica_recibido_compartir_gene_funcionarios_deta_idx1` (`id_funcio_deta_destino`);

--
-- Indices de la tabla `archivo_trd`
--
ALTER TABLE `archivo_trd`
  ADD PRIMARY KEY (`id_trd`),
  ADD KEY `fk_archivo_trd_areas_dependencias1_idx963` (`id_depen`),
  ADD KEY `fk_archivo_trd_archivo_trd_series1_idx0245` (`id_serie`),
  ADD KEY `fk_archivo_trd_archivo_trd_subserie1_idx1458` (`id_subserie`),
  ADD KEY `fk_archivo_trd_areas_oficinas1_idx` (`id_oficina`);

--
-- Indices de la tabla `archivo_trd_series`
--
ALTER TABLE `archivo_trd_series`
  ADD PRIMARY KEY (`id_serie`),
  ADD KEY `IndexSerie` (`nom_serie`);

--
-- Indices de la tabla `archivo_trd_subserie`
--
ALTER TABLE `archivo_trd_subserie`
  ADD PRIMARY KEY (`id_subserie`);

--
-- Indices de la tabla `archivo_trd_subserie_docu`
--
ALTER TABLE `archivo_trd_subserie_docu`
  ADD KEY `fk_archivo_trd_subserie_docu_archivo_trd_tipo_docu1_idx` (`id_tipodoc`),
  ADD KEY `fk_archivo_trd_subserie_docu_archivo_trd_subserie1_idx` (`id_subserie`);

--
-- Indices de la tabla `archivo_trd_tipo_docu`
--
ALTER TABLE `archivo_trd_tipo_docu`
  ADD PRIMARY KEY (`id_tipodoc`),
  ADD UNIQUE KEY `PK__Rete_TipoDoc__0425A276` (`id_tipodoc`);

--
-- Indices de la tabla `archivo_tvd`
--
ALTER TABLE `archivo_tvd`
  ADD PRIMARY KEY (`id_tvd`),
  ADD KEY `fk_archivo_tvd_areas_dependencias_tvd1_idx` (`id_depen`),
  ADD KEY `fk_archivo_tvd_areas_oficinas_tvd1_idx` (`id_oficina`),
  ADD KEY `fk_archivo_tvd_archivo_tvd_series1_idx` (`id_serie`),
  ADD KEY `fk_archivo_tvd_archivo_tvd_subserie1_idx` (`id_subserie`);

--
-- Indices de la tabla `archivo_tvd_dependencias`
--
ALTER TABLE `archivo_tvd_dependencias`
  ADD PRIMARY KEY (`id_depen`);

--
-- Indices de la tabla `archivo_tvd_oficinas`
--
ALTER TABLE `archivo_tvd_oficinas`
  ADD PRIMARY KEY (`id_oficina`),
  ADD KEY `Config_Oficina_FKIndex1` (`id_depen`);

--
-- Indices de la tabla `archivo_tvd_series`
--
ALTER TABLE `archivo_tvd_series`
  ADD PRIMARY KEY (`id_serie`),
  ADD KEY `IndexSerie` (`nom_serie`);

--
-- Indices de la tabla `archivo_tvd_subserie`
--
ALTER TABLE `archivo_tvd_subserie`
  ADD PRIMARY KEY (`id_subserie`);

--
-- Indices de la tabla `archivo_tvd_subserie_docu`
--
ALTER TABLE `archivo_tvd_subserie_docu`
  ADD KEY `fk_archivo_trd_subserie_docu_archivo_trd_tipo_docu1_idx` (`id_tipodoc`),
  ADD KEY `fk_archivo_trd_subserie_docu_archivo_trd_subserie1_idx` (`id_subserie`);

--
-- Indices de la tabla `archivo_tvd_tipo_docu`
--
ALTER TABLE `archivo_tvd_tipo_docu`
  ADD PRIMARY KEY (`id_tipodoc`),
  ADD UNIQUE KEY `PK__Rete_TipoDoc__0425A276` (`id_tipodoc`);

--
-- Indices de la tabla `areas_cargos`
--
ALTER TABLE `areas_cargos`
  ADD PRIMARY KEY (`id_cargo`),
  ADD KEY `fk_areas_cargos_areas_dependencias1_idx` (`id_depen`);

--
-- Indices de la tabla `areas_dependencias`
--
ALTER TABLE `areas_dependencias`
  ADD PRIMARY KEY (`id_depen`);

--
-- Indices de la tabla `areas_expedientes`
--
ALTER TABLE `areas_expedientes`
  ADD PRIMARY KEY (`id_expe`),
  ADD KEY `fk_areas_expedientes_gene_funcionarios_deta1_idx` (`id_funcio_crea`),
  ADD KEY `fk_areas_expedientes_archivo_trd_series1_idx` (`id_serie`),
  ADD KEY `fk_areas_expedientes_areas_oficinas1_idx` (`id_oficina`),
  ADD KEY `fk_areas_expedientes_areas_dependencias1_idx` (`id_depen`),
  ADD KEY `fk_areas_expedientes_archivo_trd_subserie1_idx` (`id_subserie`);

--
-- Indices de la tabla `areas_expedientes_deta`
--
ALTER TABLE `areas_expedientes_deta`
  ADD KEY `fk_areas_expedientes_deta_areas_expedientes1_idx` (`id_expe`),
  ADD KEY `fk_areas_expedientes_deta_archivo_rete_tipodoc1_idx` (`id_tipodoc`),
  ADD KEY `fk_areas_expedientes_deta_gene_funcionarios_deta1_idx` (`id_funcio_agrega`);

--
-- Indices de la tabla `areas_oficinas`
--
ALTER TABLE `areas_oficinas`
  ADD PRIMARY KEY (`id_oficina`),
  ADD KEY `Config_Oficina_FKIndex1` (`id_depen`);

--
-- Indices de la tabla `cali_procedimientos`
--
ALTER TABLE `cali_procedimientos`
  ADD PRIMARY KEY (`procedimiento_id`),
  ADD KEY `fk_cali_procesos_cali_macro_procesos1_idx` (`proceso_id`);

--
-- Indices de la tabla `cali_procesos`
--
ALTER TABLE `cali_procesos`
  ADD PRIMARY KEY (`proceso_id`),
  ADD KEY `fk_cali_macro_procesos_areas_dependencias1_idx` (`id_depen`);

--
-- Indices de la tabla `cali_repositorio`
--
ALTER TABLE `cali_repositorio`
  ADD PRIMARY KEY (`archivo_id`),
  ADD KEY `fk_cali_repositoriio_cali_procedimientos1_idx` (`procedimiento_id`),
  ADD KEY `fk_cali_repositorio_cali_tipos_documentos1_idx` (`tipo_docu_id`),
  ADD KEY `fk_cali_repositorio_config_rutas_archi_calidad1_idx` (`id_ruta`);

--
-- Indices de la tabla `cali_tipos_documentos`
--
ALTER TABLE `cali_tipos_documentos`
  ADD PRIMARY KEY (`tipo_docu_id`);

--
-- Indices de la tabla `config_depar`
--
ALTER TABLE `config_depar`
  ADD PRIMARY KEY (`id_depar`);

--
-- Indices de la tabla `config_despedida`
--
ALTER TABLE `config_despedida`
  ADD PRIMARY KEY (`id_despedida`);

--
-- Indices de la tabla `config_empresa`
--
ALTER TABLE `config_empresa`
  ADD PRIMARY KEY (`nit`),
  ADD KEY `fk_config_empresa_config_depar1_idx` (`id_depar`),
  ADD KEY `fk_config_empresa_config_muni1_idx` (`id_muni`);

--
-- Indices de la tabla `config_formaenvio`
--
ALTER TABLE `config_formaenvio`
  ADD PRIMARY KEY (`id_formaenvio`);

--
-- Indices de la tabla `config_muni`
--
ALTER TABLE `config_muni`
  ADD PRIMARY KEY (`id_muni`),
  ADD KEY `id_depar` (`id_depar`);

--
-- Indices de la tabla `config_origen_correspondencia`
--
ALTER TABLE `config_origen_correspondencia`
  ADD PRIMARY KEY (`id_origen`);

--
-- Indices de la tabla `config_otras`
--
ALTER TABLE `config_otras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `config_otras_responsables_pqrsf`
--
ALTER TABLE `config_otras_responsables_pqrsf`
  ADD KEY `fk_config_otras_hc_responsables_gene_funcionarios_deta1_idx` (`id_funcio_deta`),
  ADD KEY `fk_config_otras_hc_responsables_areas_dependencias1_idx` (`id_depen`),
  ADD KEY `fk_config_otras_hc_responsables_archivo_trd_series1_idx` (`id_serie`),
  ADD KEY `fk_config_otras_hc_responsables_archivo_trd_subserie1_idx` (`id_subserie`),
  ADD KEY `fk_config_otras_hc_responsables_archivo_trd_tipo_docu1_idx` (`id_tipodoc`);

--
-- Indices de la tabla `config_rutas_archi_calidad`
--
ALTER TABLE `config_rutas_archi_calidad`
  ADD PRIMARY KEY (`id_ruta`);

--
-- Indices de la tabla `config_rutas_archi_digitalizados`
--
ALTER TABLE `config_rutas_archi_digitalizados`
  ADD PRIMARY KEY (`id_ruta`);

--
-- Indices de la tabla `config_rutas_archi_gestion`
--
ALTER TABLE `config_rutas_archi_gestion`
  ADD PRIMARY KEY (`id_ruta`),
  ADD KEY `fk_config_rutas_archivos_gesti_areas_dependencias1_idx` (`id_depen`);

--
-- Indices de la tabla `config_rutas_archi_temp`
--
ALTER TABLE `config_rutas_archi_temp`
  ADD PRIMARY KEY (`id_ruta`);

--
-- Indices de la tabla `config_saludo`
--
ALTER TABLE `config_saludo`
  ADD PRIMARY KEY (`id_saludo`);

--
-- Indices de la tabla `config_status`
--
ALTER TABLE `config_status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indices de la tabla `config_tipos_respuestas`
--
ALTER TABLE `config_tipos_respuestas`
  ADD PRIMARY KEY (`id_respue`);

--
-- Indices de la tabla `config_tipo_correspondencia`
--
ALTER TABLE `config_tipo_correspondencia`
  ADD PRIMARY KEY (`id_tipo`),
  ADD KEY `fk_config_tipo_correspondencia_config_tipos_origen1_idx` (`id_origen`);

--
-- Indices de la tabla `config_tipo_documento`
--
ALTER TABLE `config_tipo_documento`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `gene_entidades`
--
ALTER TABLE `gene_entidades`
  ADD PRIMARY KEY (`id_enti`);

--
-- Indices de la tabla `gene_funcionarios`
--
ALTER TABLE `gene_funcionarios`
  ADD PRIMARY KEY (`id_funcio`),
  ADD KEY `Admin_Funcionario_FKIndex2` (`id_depar`),
  ADD KEY `Admin_Funcionario_FKIndex3` (`id_muni`);

--
-- Indices de la tabla `gene_funcionarios_deta`
--
ALTER TABLE `gene_funcionarios_deta`
  ADD PRIMARY KEY (`id_funcio_deta`),
  ADD KEY `fk_table1_admin_funcionario1_idx` (`id_funcio`),
  ADD KEY `fk_table1_areas_oficinas1_idx` (`id_oficina`),
  ADD KEY `fk_admin_fincionario_deta_areas_cargos1_idx` (`id_cargo`);

--
-- Indices de la tabla `gene_funcionarios_digitales`
--
ALTER TABLE `gene_funcionarios_digitales`
  ADD KEY `fk_gene_funcionarios_digitales_gene_funcionarios_deta1_idx` (`id_funcio_deta`),
  ADD KEY `fk_gene_funcionarios_digitales_archivo_trd_series1_idx` (`id_serie`),
  ADD KEY `fk_gene_funcionarios_digitales_archivo_trd_subserie1_idx` (`id_subserie`),
  ADD KEY `fk_gene_funcionarios_digitales_areas_dependencias1_idx` (`id_depen`);

--
-- Indices de la tabla `gene_terceros_contac`
--
ALTER TABLE `gene_terceros_contac`
  ADD PRIMARY KEY (`id_tercero`),
  ADD KEY `fk_gene_terceros_contac_gene_terceros_empresas1_idx` (`id_empre`),
  ADD KEY `fk_gene_terceros_contac_config_depar1_idx` (`id_depar`),
  ADD KEY `fk_gene_terceros_contac_config_muni1_idx` (`id_muni`),
  ADD KEY `fk_gene_terceros_contac_config_tipo_documento1_idx` (`id_tipo_docu`);

--
-- Indices de la tabla `gene_terceros_empresas`
--
ALTER TABLE `gene_terceros_empresas`
  ADD PRIMARY KEY (`id_empre`),
  ADD KEY `fk_gene_remitentes_empresas_config_depar1_idx` (`id_depar`),
  ADD KEY `fk_gene_remitentes_empresas_config_muni1_idx` (`id_muni`);

--
-- Indices de la tabla `notifica_email_externa`
--
ALTER TABLE `notifica_email_externa`
  ADD PRIMARY KEY (`id_notifica`),
  ADD KEY `fk_notifica_externa_gene_funcionarios_deta1_idx` (`id_funcio_deta`),
  ADD KEY `fk_notifica_email_externa_segu_usua1_idx` (`id_usua_registra`);

--
-- Indices de la tabla `notifica_externa`
--
ALTER TABLE `notifica_externa`
  ADD PRIMARY KEY (`id_notifica`),
  ADD KEY `fk_notifica_externa_gene_funcionarios_deta1_idx` (`id_funcio_deta`);

--
-- Indices de la tabla `notifica_interna`
--
ALTER TABLE `notifica_interna`
  ADD PRIMARY KEY (`id_notifica`),
  ADD KEY `fk_notifica_interna_gene_funcionarios_deta1_idx` (`id_funcio_deta`);

--
-- Indices de la tabla `segu_log`
--
ALTER TABLE `segu_log`
  ADD KEY `id_usua` (`id_usua`);

--
-- Indices de la tabla `segu_modu`
--
ALTER TABLE `segu_modu`
  ADD PRIMARY KEY (`id_modu`),
  ADD UNIQUE KEY `PK__Segu_Modu__25DB9BFC` (`id_modu`);

--
-- Indices de la tabla `segu_perfiles`
--
ALTER TABLE `segu_perfiles`
  ADD PRIMARY KEY (`id_perfil`),
  ADD UNIQUE KEY `PK__Segu_Perfiles__23F3538A` (`id_perfil`);

--
-- Indices de la tabla `segu_perfiles_deta`
--
ALTER TABLE `segu_perfiles_deta`
  ADD KEY `fk_segu_perfiles_deta_segu_perfiles1_idx` (`id_perfil`),
  ADD KEY `fk_segu_perfiles_deta_segu_modu1_idx` (`id_modu`);

--
-- Indices de la tabla `segu_sesiones`
--
ALTER TABLE `segu_sesiones`
  ADD PRIMARY KEY (`id_sesion`),
  ADD KEY `fk_segu_sesiones_segu_usua1_idx` (`id_usua`);

--
-- Indices de la tabla `segu_usua`
--
ALTER TABLE `segu_usua`
  ADD PRIMARY KEY (`id_usua`),
  ADD KEY `fk_segu_usua_gene_funcionarios1_idx` (`id_funcio`);

--
-- Indices de la tabla `segu_usuadeta`
--
ALTER TABLE `segu_usuadeta`
  ADD KEY `FK__Segu_Usua__id_pe__324172E1` (`id_perfil`),
  ADD KEY `FK_Segu_UsuaDeta_Segu_Usua` (`id_usua`);

--
-- Indices de la tabla `temp_adjuntos`
--
ALTER TABLE `temp_adjuntos`
  ADD KEY `fk_temp_adjuntos_segu_usua1_idx` (`id_usua`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `archivo_digitales_trd`
--
ALTER TABLE `archivo_digitales_trd`
  MODIFY `id_digital` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `archivo_digitales_trd_detalle`
--
ALTER TABLE `archivo_digitales_trd_detalle`
  MODIFY `id_archivo` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `archivo_digitales_trd_tomos`
--
ALTER TABLE `archivo_digitales_trd_tomos`
  MODIFY `id_tomo` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `archivo_digitales_tvd`
--
ALTER TABLE `archivo_digitales_tvd`
  MODIFY `id_digital` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `archivo_digitales_tvd_detalle`
--
ALTER TABLE `archivo_digitales_tvd_detalle`
  MODIFY `id_archivo` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `archivo_digitales_tvd_tomos`
--
ALTER TABLE `archivo_digitales_tvd_tomos`
  MODIFY `id_tomo` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `archivo_radica_enviados_archivos`
--
ALTER TABLE `archivo_radica_enviados_archivos`
  MODIFY `id_archivo` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `archivo_radica_enviados_temp`
--
ALTER TABLE `archivo_radica_enviados_temp`
  MODIFY `id_temp` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `archivo_radica_enviados_temp_nota`
--
ALTER TABLE `archivo_radica_enviados_temp_nota`
  MODIFY `id_nota` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `archivo_radica_interna_adjuntos`
--
ALTER TABLE `archivo_radica_interna_adjuntos`
  MODIFY `id_archivo` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `archivo_radica_recibidos_grupos_colaborativo`
--
ALTER TABLE `archivo_radica_recibidos_grupos_colaborativo`
  MODIFY `id_crea_grupo` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `archivo_radica_recibidos_pase`
--
ALTER TABLE `archivo_radica_recibidos_pase`
  MODIFY `id_pase` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `archivo_radica_recibidos_pqrsf`
--
ALTER TABLE `archivo_radica_recibidos_pqrsf`
  MODIFY `id_pqr` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `archivo_radica_recibidos_pqrsf_archivos`
--
ALTER TABLE `archivo_radica_recibidos_pqrsf_archivos`
  MODIFY `id_pqr_archivo` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `archivo_trd`
--
ALTER TABLE `archivo_trd`
  MODIFY `id_trd` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `archivo_trd_series`
--
ALTER TABLE `archivo_trd_series`
  MODIFY `id_serie` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `archivo_trd_subserie`
--
ALTER TABLE `archivo_trd_subserie`
  MODIFY `id_subserie` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `archivo_trd_tipo_docu`
--
ALTER TABLE `archivo_trd_tipo_docu`
  MODIFY `id_tipodoc` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;

--
-- AUTO_INCREMENT de la tabla `archivo_tvd`
--
ALTER TABLE `archivo_tvd`
  MODIFY `id_tvd` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `archivo_tvd_dependencias`
--
ALTER TABLE `archivo_tvd_dependencias`
  MODIFY `id_depen` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `archivo_tvd_oficinas`
--
ALTER TABLE `archivo_tvd_oficinas`
  MODIFY `id_oficina` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `archivo_tvd_series`
--
ALTER TABLE `archivo_tvd_series`
  MODIFY `id_serie` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `archivo_tvd_subserie`
--
ALTER TABLE `archivo_tvd_subserie`
  MODIFY `id_subserie` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `archivo_tvd_tipo_docu`
--
ALTER TABLE `archivo_tvd_tipo_docu`
  MODIFY `id_tipodoc` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;

--
-- AUTO_INCREMENT de la tabla `areas_cargos`
--
ALTER TABLE `areas_cargos`
  MODIFY `id_cargo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `areas_dependencias`
--
ALTER TABLE `areas_dependencias`
  MODIFY `id_depen` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `areas_expedientes`
--
ALTER TABLE `areas_expedientes`
  MODIFY `id_expe` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `areas_oficinas`
--
ALTER TABLE `areas_oficinas`
  MODIFY `id_oficina` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `cali_procedimientos`
--
ALTER TABLE `cali_procedimientos`
  MODIFY `procedimiento_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cali_procesos`
--
ALTER TABLE `cali_procesos`
  MODIFY `proceso_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cali_repositorio`
--
ALTER TABLE `cali_repositorio`
  MODIFY `archivo_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cali_tipos_documentos`
--
ALTER TABLE `cali_tipos_documentos`
  MODIFY `tipo_docu_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `config_despedida`
--
ALTER TABLE `config_despedida`
  MODIFY `id_despedida` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `config_formaenvio`
--
ALTER TABLE `config_formaenvio`
  MODIFY `id_formaenvio` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `config_origen_correspondencia`
--
ALTER TABLE `config_origen_correspondencia`
  MODIFY `id_origen` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `config_otras`
--
ALTER TABLE `config_otras`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `config_rutas_archi_calidad`
--
ALTER TABLE `config_rutas_archi_calidad`
  MODIFY `id_ruta` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `config_rutas_archi_digitalizados`
--
ALTER TABLE `config_rutas_archi_digitalizados`
  MODIFY `id_ruta` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `config_rutas_archi_gestion`
--
ALTER TABLE `config_rutas_archi_gestion`
  MODIFY `id_ruta` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `config_rutas_archi_temp`
--
ALTER TABLE `config_rutas_archi_temp`
  MODIFY `id_ruta` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `config_saludo`
--
ALTER TABLE `config_saludo`
  MODIFY `id_saludo` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `config_status`
--
ALTER TABLE `config_status`
  MODIFY `id_status` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `config_tipos_respuestas`
--
ALTER TABLE `config_tipos_respuestas`
  MODIFY `id_respue` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `config_tipo_correspondencia`
--
ALTER TABLE `config_tipo_correspondencia`
  MODIFY `id_tipo` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `config_tipo_documento`
--
ALTER TABLE `config_tipo_documento`
  MODIFY `id_tipo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `gene_funcionarios`
--
ALTER TABLE `gene_funcionarios`
  MODIFY `id_funcio` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `gene_funcionarios_deta`
--
ALTER TABLE `gene_funcionarios_deta`
  MODIFY `id_funcio_deta` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gene_terceros_contac`
--
ALTER TABLE `gene_terceros_contac`
  MODIFY `id_tercero` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=298;

--
-- AUTO_INCREMENT de la tabla `gene_terceros_empresas`
--
ALTER TABLE `gene_terceros_empresas`
  MODIFY `id_empre` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notifica_email_externa`
--
ALTER TABLE `notifica_email_externa`
  MODIFY `id_notifica` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notifica_externa`
--
ALTER TABLE `notifica_externa`
  MODIFY `id_notifica` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notifica_interna`
--
ALTER TABLE `notifica_interna`
  MODIFY `id_notifica` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `segu_modu`
--
ALTER TABLE `segu_modu`
  MODIFY `id_modu` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `segu_perfiles`
--
ALTER TABLE `segu_perfiles`
  MODIFY `id_perfil` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `segu_sesiones`
--
ALTER TABLE `segu_sesiones`
  MODIFY `id_sesion` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `segu_usua`
--
ALTER TABLE `segu_usua`
  MODIFY `id_usua` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `archivo_digitales_trd`
--
ALTER TABLE `archivo_digitales_trd`
  ADD CONSTRAINT `fk_archivo_digital_archivos_archivo_trd_series1` FOREIGN KEY (`id_serie`) REFERENCES `archivo_trd_series` (`id_serie`),
  ADD CONSTRAINT `fk_archivo_digital_archivos_archivo_trd_subserie1` FOREIGN KEY (`id_subserie`) REFERENCES `archivo_trd_subserie` (`id_subserie`),
  ADD CONSTRAINT `fk_archivo_digital_areas_dependencias1` FOREIGN KEY (`id_depen`) REFERENCES `areas_dependencias` (`id_depen`),
  ADD CONSTRAINT `fk_archivo_digitales_areas_oficinas1` FOREIGN KEY (`id_oficina`) REFERENCES `areas_oficinas` (`id_oficina`);

--
-- Filtros para la tabla `archivo_digitales_trd_detalle`
--
ALTER TABLE `archivo_digitales_trd_detalle`
  ADD CONSTRAINT `fk_archivo_digital_archivos_archivo_digital1` FOREIGN KEY (`id_digital`) REFERENCES `archivo_digitales_trd` (`id_digital`),
  ADD CONSTRAINT `fk_archivo_digitales_detalle_archivo_trd_tipo_docu1` FOREIGN KEY (`id_tipodoc`) REFERENCES `archivo_trd_tipo_docu` (`id_tipodoc`),
  ADD CONSTRAINT `fk_archivo_digitales_detalle_config_rutas_archi_digitalizados1` FOREIGN KEY (`id_ruta`) REFERENCES `config_rutas_archi_digitalizados` (`id_ruta`),
  ADD CONSTRAINT `fk_archivo_digitales_detalle_TRD_archivo_digitales_tomos_TRD1` FOREIGN KEY (`id_tomo`) REFERENCES `archivo_digitales_trd_tomos` (`id_tomo`);

--
-- Filtros para la tabla `archivo_digitales_trd_tomos`
--
ALTER TABLE `archivo_digitales_trd_tomos`
  ADD CONSTRAINT `fk_archivo_digitales_tomos_TRD_archivo_digitales_TRD1` FOREIGN KEY (`id_digital`) REFERENCES `archivo_digitales_trd` (`id_digital`);

--
-- Filtros para la tabla `archivo_digitales_tvd`
--
ALTER TABLE `archivo_digitales_tvd`
  ADD CONSTRAINT `fk_archivo_digitales_tvd_archivo_tvd_series1` FOREIGN KEY (`id_serie`) REFERENCES `archivo_tvd_series` (`id_serie`),
  ADD CONSTRAINT `fk_archivo_digitales_tvd_archivo_tvd_subserie1` FOREIGN KEY (`id_subserie`) REFERENCES `archivo_tvd_subserie` (`id_subserie`),
  ADD CONSTRAINT `fk_archivo_digitales_tvd_areas_dependencias_tvd1` FOREIGN KEY (`id_depen`) REFERENCES `archivo_tvd_dependencias` (`id_depen`),
  ADD CONSTRAINT `fk_archivo_digitales_tvd_areas_oficinas_tvd1` FOREIGN KEY (`id_oficina`) REFERENCES `archivo_tvd_oficinas` (`id_oficina`);

--
-- Filtros para la tabla `archivo_digitales_tvd_detalle`
--
ALTER TABLE `archivo_digitales_tvd_detalle`
  ADD CONSTRAINT `fk_archivo_digital_archivos_archivo_digital10` FOREIGN KEY (`id_digital`) REFERENCES `archivo_digitales_tvd` (`id_digital`),
  ADD CONSTRAINT `fk_archivo_digitales_detalle_archivo_trd_tipo_docu10` FOREIGN KEY (`id_tipodoc`) REFERENCES `archivo_trd_tipo_docu` (`id_tipodoc`),
  ADD CONSTRAINT `fk_archivo_digitales_detalle_config_rutas_archi_digitalizados10` FOREIGN KEY (`id_ruta`) REFERENCES `config_rutas_archi_digitalizados` (`id_ruta`),
  ADD CONSTRAINT `fk_archivo_digitales_detalle_TRD_archivo_digitales_tomos_TRD10` FOREIGN KEY (`id_tomo`) REFERENCES `archivo_digitales_tvd_tomos` (`id_tomo`);

--
-- Filtros para la tabla `archivo_digitales_tvd_tomos`
--
ALTER TABLE `archivo_digitales_tvd_tomos`
  ADD CONSTRAINT `fk_archivo_digitales_tomos_TRD_archivo_digitales_TRD10` FOREIGN KEY (`id_digital`) REFERENCES `archivo_digitales_tvd` (`id_digital`);

--
-- Filtros para la tabla `archivo_radica_enviados`
--
ALTER TABLE `archivo_radica_enviados`
  ADD CONSTRAINT `fk_archivo_radica_enviados_archivo_trd_tipo_docu1` FOREIGN KEY (`id_tipodoc`) REFERENCES `archivo_trd_tipo_docu` (`id_tipodoc`),
  ADD CONSTRAINT `fk_archivo_radica_enviados_config_tipos_respuestas1` FOREIGN KEY (`id_tipo_respue`) REFERENCES `config_tipos_respuestas` (`id_respue`),
  ADD CONSTRAINT `fk_archivo_radica_enviados_gene_terceros_contac1` FOREIGN KEY (`id_destina`) REFERENCES `gene_terceros_contac` (`id_tercero`),
  ADD CONSTRAINT `fk_archivo_radica_externa_segu_usua10` FOREIGN KEY (`id_usua_regis`) REFERENCES `segu_usua` (`id_usua`),
  ADD CONSTRAINT `fk_radica_externa_config_formaenvio10` FOREIGN KEY (`id_formaenvio`) REFERENCES `config_formaenvio` (`id_formaenvio`),
  ADD CONSTRAINT `fk_radica_externa_rete_serie0` FOREIGN KEY (`id_serie`) REFERENCES `archivo_trd_series` (`id_serie`),
  ADD CONSTRAINT `fk_radica_externa_rete_subserie0` FOREIGN KEY (`id_subserie`) REFERENCES `archivo_trd_subserie` (`id_subserie`),
  ADD CONSTRAINT `fk_radica_externa_usua_impri_rotulo0` FOREIGN KEY (`usua_impri_rotu`) REFERENCES `segu_usua` (`id_usua`);

--
-- Filtros para la tabla `archivo_radica_enviados_archivos`
--
ALTER TABLE `archivo_radica_enviados_archivos`
  ADD CONSTRAINT `fk_archivo_radica_enviados_archivos_archivo_radica_enviados1` FOREIGN KEY (`id_radica`) REFERENCES `archivo_radica_enviados` (`id_radica`);

--
-- Filtros para la tabla `archivo_radica_enviados_proyector`
--
ALTER TABLE `archivo_radica_enviados_proyector`
  ADD CONSTRAINT `fk_archivo_radica_salida_proyector_archivo_radica_salida1` FOREIGN KEY (`id_radica`) REFERENCES `archivo_radica_enviados` (`id_radica`),
  ADD CONSTRAINT `fk_archivo_radica_salida_proyector_gene_funcionarios_deta1` FOREIGN KEY (`id_funcio_deta`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`);

--
-- Filtros para la tabla `archivo_radica_enviados_quienes_firman`
--
ALTER TABLE `archivo_radica_enviados_quienes_firman`
  ADD CONSTRAINT `archivo_radica_enviados_quien_firma_ibfk_0231` FOREIGN KEY (`id_radica`) REFERENCES `archivo_radica_enviados` (`id_radica`),
  ADD CONSTRAINT `archivo_radica_enviados_quien_firma_ibfk_8962` FOREIGN KEY (`id_funcio_deta`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`);

--
-- Filtros para la tabla `archivo_radica_enviados_responsa`
--
ALTER TABLE `archivo_radica_enviados_responsa`
  ADD CONSTRAINT `fk_archivo_radica_salida_responsa_gene_funcionarios_deta1` FOREIGN KEY (`id_funcio_deta`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`),
  ADD CONSTRAINT `fk_archivo_radica_salida_responsa_id_radica` FOREIGN KEY (`id_radica`) REFERENCES `archivo_radica_enviados` (`id_radica`);

--
-- Filtros para la tabla `archivo_radica_enviados_respuestas`
--
ALTER TABLE `archivo_radica_enviados_respuestas`
  ADD CONSTRAINT `fk_archivo_radica_enviados_respuestas_archivo_radica_enviados1` FOREIGN KEY (`id_radica_enviado`) REFERENCES `archivo_radica_enviados` (`id_radica`),
  ADD CONSTRAINT `fk_archivo_radica_enviados_respuestas_archivo_radica_recibidos1` FOREIGN KEY (`id_radica_recivido`) REFERENCES `archivo_radica_recibidos` (`id_radica`),
  ADD CONSTRAINT `fk_archivo_radica_enviados_respuestas_segu_usua1` FOREIGN KEY (`id_usua_regis`) REFERENCES `segu_usua` (`id_usua`);

--
-- Filtros para la tabla `archivo_radica_enviados_temp`
--
ALTER TABLE `archivo_radica_enviados_temp`
  ADD CONSTRAINT `fk_archivo_radica_enviados_temp_config_rutas_archi_temp1` FOREIGN KEY (`id_ruta`) REFERENCES `config_rutas_archi_temp` (`id_ruta`),
  ADD CONSTRAINT `fk_archivo_radica_enviados_temp_gene_funcionarios_deta2` FOREIGN KEY (`id_funcio_deta_anula`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`),
  ADD CONSTRAINT `fk_archivo_radica_enviados_temp_gene_terceros_contac1` FOREIGN KEY (`id_destina`) REFERENCES `gene_terceros_contac` (`id_tercero`),
  ADD CONSTRAINT `fk_archivo_radica_salida_temp_archivo_trd_series1` FOREIGN KEY (`id_serie`) REFERENCES `archivo_trd_series` (`id_serie`),
  ADD CONSTRAINT `fk_archivo_radica_salida_temp_archivo_trd_series_subserie1` FOREIGN KEY (`id_subserie`) REFERENCES `archivo_trd_subserie` (`id_subserie`),
  ADD CONSTRAINT `fk_archivo_radica_salida_temp_config_despedida1` FOREIGN KEY (`id_despedida`) REFERENCES `config_despedida` (`id_despedida`),
  ADD CONSTRAINT `fk_archivo_radica_salida_temp_config_saludo1` FOREIGN KEY (`id_saludo`) REFERENCES `config_saludo` (`id_saludo`),
  ADD CONSTRAINT `fk_archivo_radica_salida_temp_config_status1` FOREIGN KEY (`id_status`) REFERENCES `config_status` (`id_status`),
  ADD CONSTRAINT `fk_archivo_radica_salida_temp_gene_funcionarios_deta1` FOREIGN KEY (`id_usua_regis`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`),
  ADD CONSTRAINT `fk_archivo_radica_salida_temp_id_tipodoc` FOREIGN KEY (`id_tipodoc`) REFERENCES `archivo_trd_tipo_docu` (`id_tipodoc`);

--
-- Filtros para la tabla `archivo_radica_enviados_temp_nota`
--
ALTER TABLE `archivo_radica_enviados_temp_nota`
  ADD CONSTRAINT `fk_archivo_radica_enviados_temp_archivo_radica_enviados_temp1` FOREIGN KEY (`id_temp`) REFERENCES `archivo_radica_enviados_temp` (`id_temp`),
  ADD CONSTRAINT `fk_archivo_radica_enviados_temp_gene_funcionarios_deta1` FOREIGN KEY (`id_funcio_deta`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`);

--
-- Filtros para la tabla `archivo_radica_enviados_temp_proyector`
--
ALTER TABLE `archivo_radica_enviados_temp_proyector`
  ADD CONSTRAINT `fk_archivo_radica_salida_temp_proyector_archivo_radica_salida1` FOREIGN KEY (`id_temp`) REFERENCES `archivo_radica_enviados_temp` (`id_temp`),
  ADD CONSTRAINT `fk_archivo_radica_salida_temp_proyector_gene_funcionarios_deta1` FOREIGN KEY (`id_funcio_deta`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`);

--
-- Filtros para la tabla `archivo_radica_enviados_temp_quienes_firman`
--
ALTER TABLE `archivo_radica_enviados_temp_quienes_firman`
  ADD CONSTRAINT `fk_archivo_radica_salida_temp_responsa_archivo_radica_salida_10` FOREIGN KEY (`id_temp`) REFERENCES `archivo_radica_enviados_temp` (`id_temp`),
  ADD CONSTRAINT `fk_archivo_radica_salida_temp_responsa_gene_funcionarios_deta10` FOREIGN KEY (`id_funcio_deta`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`);

--
-- Filtros para la tabla `archivo_radica_enviados_temp_radica_respuesta`
--
ALTER TABLE `archivo_radica_enviados_temp_radica_respuesta`
  ADD CONSTRAINT `fk_archivo_radica_enviados_temp_radica_respuesta_archivo_radi1` FOREIGN KEY (`id_temp`) REFERENCES `archivo_radica_enviados_temp` (`id_temp`);

--
-- Filtros para la tabla `archivo_radica_enviados_temp_responsa`
--
ALTER TABLE `archivo_radica_enviados_temp_responsa`
  ADD CONSTRAINT `fk_archivo_radica_salida_temp_responsa_archivo_radica_salida_1` FOREIGN KEY (`id_temp`) REFERENCES `archivo_radica_enviados_temp` (`id_temp`),
  ADD CONSTRAINT `fk_archivo_radica_salida_temp_responsa_gene_funcionarios_deta1` FOREIGN KEY (`id_funcio_deta`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`);

--
-- Filtros para la tabla `archivo_radica_enviados_temp_version`
--
ALTER TABLE `archivo_radica_enviados_temp_version`
  ADD CONSTRAINT `fk_archivo_radica_enviados_temp_ver_archivo_radica_enviados_t1` FOREIGN KEY (`id_temp`) REFERENCES `archivo_radica_enviados_temp` (`id_temp`);

--
-- Filtros para la tabla `archivo_radica_interna`
--
ALTER TABLE `archivo_radica_interna`
  ADD CONSTRAINT `fk_archivo_radica_interna_gene_funcionarios_deta1` FOREIGN KEY (`id_funcio_regis`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`),
  ADD CONSTRAINT `fk_archivo_radica_interna_serie` FOREIGN KEY (`id_serie`) REFERENCES `archivo_trd_series` (`id_serie`),
  ADD CONSTRAINT `fk_archivo_radica_interna_sub_serie` FOREIGN KEY (`id_subserie`) REFERENCES `archivo_trd_subserie` (`id_subserie`),
  ADD CONSTRAINT `fk_archivo_radica_interna_tipo_documento` FOREIGN KEY (`id_tipodoc`) REFERENCES `archivo_trd_tipo_docu` (`id_tipodoc`);

--
-- Filtros para la tabla `archivo_radica_interna_adjuntos`
--
ALTER TABLE `archivo_radica_interna_adjuntos`
  ADD CONSTRAINT `fk_archivo_radica_interna_adjuntos_archivo_radica_interna1` FOREIGN KEY (`id_radica`) REFERENCES `archivo_radica_interna` (`id_radica`);

--
-- Filtros para la tabla `archivo_radica_interna_destinata`
--
ALTER TABLE `archivo_radica_interna_destinata`
  ADD CONSTRAINT `fk_archivo_radica_interna_destinata_archivo_radica_interna1` FOREIGN KEY (`id_radica`) REFERENCES `archivo_radica_interna` (`id_radica`),
  ADD CONSTRAINT `fk_archivo_radica_interna_destinata_gene_funcionarios_deta1` FOREIGN KEY (`id_funcio_deta`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`);

--
-- Filtros para la tabla `archivo_radica_interna_proyectores`
--
ALTER TABLE `archivo_radica_interna_proyectores`
  ADD CONSTRAINT `fk_archivo_radica_interna_proyectores_archivo_radica_interna1` FOREIGN KEY (`id_radica`) REFERENCES `archivo_radica_interna` (`id_radica`),
  ADD CONSTRAINT `fk_archivo_radica_interna_proyectores_gene_funcionarios_deta1` FOREIGN KEY (`id_funcio_deta`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`);

--
-- Filtros para la tabla `archivo_radica_interna_responsa`
--
ALTER TABLE `archivo_radica_interna_responsa`
  ADD CONSTRAINT `fk_archivo_radica_entra_responsa_gene_funcionarios_deta10` FOREIGN KEY (`id_funcio`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`),
  ADD CONSTRAINT `fk_archivo_radica_interna_responsa_archivo_radica_interna1` FOREIGN KEY (`id_radica`) REFERENCES `archivo_radica_interna` (`id_radica`);

--
-- Filtros para la tabla `archivo_radica_recibidos`
--
ALTER TABLE `archivo_radica_recibidos`
  ADD CONSTRAINT `fk_archivo_radica_entra_archivo_trd_series1` FOREIGN KEY (`id_serie`) REFERENCES `archivo_trd_series` (`id_serie`),
  ADD CONSTRAINT `fk_archivo_radica_entra_archivo_trd_subserie1` FOREIGN KEY (`id_subserie`) REFERENCES `archivo_trd_subserie` (`id_subserie`),
  ADD CONSTRAINT `fk_archivo_radica_entra_archivo_trd_tipo_docu1` FOREIGN KEY (`id_tipodoc`) REFERENCES `archivo_trd_tipo_docu` (`id_tipodoc`),
  ADD CONSTRAINT `fk_archivo_radica_externa_segu_usua1` FOREIGN KEY (`id_usua_regis`) REFERENCES `segu_usua` (`id_usua`),
  ADD CONSTRAINT `fk_archivo_radica_recibidos_config_rutas_archi_gestion1` FOREIGN KEY (`id_ruta`) REFERENCES `config_rutas_archi_gestion` (`id_ruta`),
  ADD CONSTRAINT `fk_archivo_radica_recibidos_config_tipo_correspondencia1` FOREIGN KEY (`id_tipo_correspon`) REFERENCES `config_tipo_correspondencia` (`id_tipo`),
  ADD CONSTRAINT `fk_archivo_radica_recibidos_gene_terceros_contac1` FOREIGN KEY (`id_remite`) REFERENCES `gene_terceros_contac` (`id_tercero`),
  ADD CONSTRAINT `fk_radica_externa_config_formaenvio1` FOREIGN KEY (`id_forma_llegada`) REFERENCES `config_formaenvio` (`id_formaenvio`),
  ADD CONSTRAINT `fk_radica_externa_usua_impri_rotulo` FOREIGN KEY (`usua_impri_rotu`) REFERENCES `segu_usua` (`id_usua`);

--
-- Filtros para la tabla `archivo_radica_recibidos_grupos_colaborativo`
--
ALTER TABLE `archivo_radica_recibidos_grupos_colaborativo`
  ADD CONSTRAINT `fk_archivo_radica_recibidos_grupo_colaborativo_archivo_radica1` FOREIGN KEY (`id_radica`) REFERENCES `archivo_radica_recibidos` (`id_radica`),
  ADD CONSTRAINT `fk_archivo_radica_recibidos_grupo_colaborativo_gene_funcionar1` FOREIGN KEY (`id_funcio_deta_asingnado`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`),
  ADD CONSTRAINT `fk_archivo_radica_recibidos_grupo_colaborativo_gene_funcionar2` FOREIGN KEY (`id_funcio_deta_asigno`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`);

--
-- Filtros para la tabla `archivo_radica_recibidos_hc`
--
ALTER TABLE `archivo_radica_recibidos_hc`
  ADD CONSTRAINT `fk_archivo_radica_recibidos_hc_archivo_radica_recibidos1` FOREIGN KEY (`id_radica`) REFERENCES `archivo_radica_recibidos` (`id_radica`);

--
-- Filtros para la tabla `archivo_radica_recibidos_pase`
--
ALTER TABLE `archivo_radica_recibidos_pase`
  ADD CONSTRAINT `fk_archivo_radica_recibidos_pase_archivo_radica_recibidos1` FOREIGN KEY (`id_radica`) REFERENCES `archivo_radica_recibidos` (`id_radica`),
  ADD CONSTRAINT `fk_archivo_radica_recibidos_pase_gene_funcionarios_deta1` FOREIGN KEY (`id_funcio_deta_origen`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`),
  ADD CONSTRAINT `fk_archivo_radica_recibidos_pase_gene_funcionarios_deta2` FOREIGN KEY (`id_funcio_deta_destino`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`);

--
-- Filtros para la tabla `archivo_radica_recibidos_pqrsf`
--
ALTER TABLE `archivo_radica_recibidos_pqrsf`
  ADD CONSTRAINT `fk_archivo_radica_pqr_archivo_radica_recibidos1` FOREIGN KEY (`id_radica`) REFERENCES `archivo_radica_recibidos` (`id_radica`),
  ADD CONSTRAINT `fk_archivo_radica_pqr_config_depar1` FOREIGN KEY (`id_depar_afectado`) REFERENCES `config_depar` (`id_depar`),
  ADD CONSTRAINT `fk_archivo_radica_pqr_config_muni1` FOREIGN KEY (`id_muni_afectado`) REFERENCES `config_muni` (`id_muni`),
  ADD CONSTRAINT `fk_archivo_radica_pqr_config_tipo_documento1` FOREIGN KEY (`id_tipo_docu_afectado`) REFERENCES `config_tipo_documento` (`id_tipo`),
  ADD CONSTRAINT `fk_archivo_radica_pqr_gene_terceros_contac1` FOREIGN KEY (`id_contacto`) REFERENCES `gene_terceros_contac` (`id_tercero`),
  ADD CONSTRAINT `fk_archivo_radica_recibidos_pqrsf_config_tipo_correspondencia1` FOREIGN KEY (`id_tipodocumental`) REFERENCES `config_tipo_correspondencia` (`id_tipo`);

--
-- Filtros para la tabla `archivo_radica_recibidos_pqrsf_archivos`
--
ALTER TABLE `archivo_radica_recibidos_pqrsf_archivos`
  ADD CONSTRAINT `fk_archivo_radica_recibidos_pqrsf_archivos_archivo_radica_rec1` FOREIGN KEY (`id_pqr`) REFERENCES `archivo_radica_recibidos_pqrsf` (`id_pqr`);

--
-- Filtros para la tabla `archivo_radica_recibidos_responsa`
--
ALTER TABLE `archivo_radica_recibidos_responsa`
  ADD CONSTRAINT `fk_archivo_radica_entra_responsa_gene_funcionarios_deta1` FOREIGN KEY (`id_funcio`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`),
  ADD CONSTRAINT `fk_id_radicado_respon` FOREIGN KEY (`id_radica`) REFERENCES `archivo_radica_recibidos` (`id_radica`);

--
-- Filtros para la tabla `archivo_radica_recibido_compartidos`
--
ALTER TABLE `archivo_radica_recibido_compartidos`
  ADD CONSTRAINT `fk_archivo_radica_recibido_compartir_archivo_radica_recibidos1` FOREIGN KEY (`id_radica`) REFERENCES `archivo_radica_recibidos` (`id_radica`),
  ADD CONSTRAINT `fk_archivo_radica_recibido_compartir_gene_funcionarios_deta1` FOREIGN KEY (`id_funcio_deta_origen`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`),
  ADD CONSTRAINT `fk_archivo_radica_recibido_compartir_gene_funcionarios_deta2` FOREIGN KEY (`id_funcio_deta_destino`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`);

--
-- Filtros para la tabla `archivo_trd`
--
ALTER TABLE `archivo_trd`
  ADD CONSTRAINT `fk_archivo_trd_archivo_trd_series2531` FOREIGN KEY (`id_serie`) REFERENCES `archivo_trd_series` (`id_serie`),
  ADD CONSTRAINT `fk_archivo_trd_archivo_trd_subserie00001` FOREIGN KEY (`id_subserie`) REFERENCES `archivo_trd_subserie` (`id_subserie`),
  ADD CONSTRAINT `fk_archivo_trd_areas_dependencias8951` FOREIGN KEY (`id_depen`) REFERENCES `areas_dependencias` (`id_depen`),
  ADD CONSTRAINT `fk_archivo_trd_areas_oficinas1` FOREIGN KEY (`id_oficina`) REFERENCES `areas_oficinas` (`id_oficina`);

--
-- Filtros para la tabla `archivo_trd_subserie_docu`
--
ALTER TABLE `archivo_trd_subserie_docu`
  ADD CONSTRAINT `fk_archivo_trd_subserie_docu_archivo_trd_subserie1` FOREIGN KEY (`id_subserie`) REFERENCES `archivo_trd_subserie` (`id_subserie`),
  ADD CONSTRAINT `fk_archivo_trd_subserie_docu_archivo_trd_tipo_docu1` FOREIGN KEY (`id_tipodoc`) REFERENCES `archivo_trd_tipo_docu` (`id_tipodoc`);

--
-- Filtros para la tabla `archivo_tvd`
--
ALTER TABLE `archivo_tvd`
  ADD CONSTRAINT `fk_archivo_tvd_archivo_tvd_series1` FOREIGN KEY (`id_serie`) REFERENCES `archivo_tvd_series` (`id_serie`),
  ADD CONSTRAINT `fk_archivo_tvd_archivo_tvd_subserie1` FOREIGN KEY (`id_subserie`) REFERENCES `archivo_tvd_subserie` (`id_subserie`),
  ADD CONSTRAINT `fk_archivo_tvd_areas_dependencias_tvd1` FOREIGN KEY (`id_depen`) REFERENCES `archivo_tvd_dependencias` (`id_depen`),
  ADD CONSTRAINT `fk_archivo_tvd_areas_oficinas_tvd1` FOREIGN KEY (`id_oficina`) REFERENCES `archivo_tvd_oficinas` (`id_oficina`);

--
-- Filtros para la tabla `archivo_tvd_oficinas`
--
ALTER TABLE `archivo_tvd_oficinas`
  ADD CONSTRAINT `fk_areas_oficinas_dependencia0` FOREIGN KEY (`id_depen`) REFERENCES `archivo_tvd_dependencias` (`id_depen`);

--
-- Filtros para la tabla `archivo_tvd_subserie_docu`
--
ALTER TABLE `archivo_tvd_subserie_docu`
  ADD CONSTRAINT `fk_archivo_trd_subserie_docu_archivo_trd_subserie10` FOREIGN KEY (`id_subserie`) REFERENCES `archivo_tvd_subserie` (`id_subserie`),
  ADD CONSTRAINT `fk_archivo_trd_subserie_docu_archivo_trd_tipo_docu10` FOREIGN KEY (`id_tipodoc`) REFERENCES `archivo_tvd_tipo_docu` (`id_tipodoc`);

--
-- Filtros para la tabla `areas_cargos`
--
ALTER TABLE `areas_cargos`
  ADD CONSTRAINT `fk_areas_cargos_id_depen` FOREIGN KEY (`id_depen`) REFERENCES `areas_dependencias` (`id_depen`);

--
-- Filtros para la tabla `areas_expedientes`
--
ALTER TABLE `areas_expedientes`
  ADD CONSTRAINT `fk_areas_expedientes_archivo_trd_series1` FOREIGN KEY (`id_serie`) REFERENCES `archivo_trd_series` (`id_serie`),
  ADD CONSTRAINT `fk_areas_expedientes_archivo_trd_subserie1` FOREIGN KEY (`id_subserie`) REFERENCES `archivo_trd_subserie` (`id_subserie`),
  ADD CONSTRAINT `fk_areas_expedientes_areas_dependencias1` FOREIGN KEY (`id_depen`) REFERENCES `areas_dependencias` (`id_depen`),
  ADD CONSTRAINT `fk_areas_expedientes_areas_oficinas1` FOREIGN KEY (`id_oficina`) REFERENCES `areas_oficinas` (`id_oficina`);

--
-- Filtros para la tabla `areas_expedientes_deta`
--
ALTER TABLE `areas_expedientes_deta`
  ADD CONSTRAINT `fk_areas_expedientes_deta_archivo_rete_tipodoc1` FOREIGN KEY (`id_tipodoc`) REFERENCES `archivo_trd_tipo_docu` (`id_tipodoc`),
  ADD CONSTRAINT `fk_areas_expedientes_deta_areas_expedientes1` FOREIGN KEY (`id_expe`) REFERENCES `areas_expedientes` (`id_expe`);

--
-- Filtros para la tabla `areas_oficinas`
--
ALTER TABLE `areas_oficinas`
  ADD CONSTRAINT `fk_areas_oficinas_dependencia` FOREIGN KEY (`id_depen`) REFERENCES `areas_dependencias` (`id_depen`);

--
-- Filtros para la tabla `cali_procedimientos`
--
ALTER TABLE `cali_procedimientos`
  ADD CONSTRAINT `fk_cali_procesos_cali_macro_procesos1` FOREIGN KEY (`proceso_id`) REFERENCES `cali_procesos` (`proceso_id`);

--
-- Filtros para la tabla `cali_procesos`
--
ALTER TABLE `cali_procesos`
  ADD CONSTRAINT `fk_cali_procesos_areas_dependencias1` FOREIGN KEY (`id_depen`) REFERENCES `areas_dependencias` (`id_depen`);

--
-- Filtros para la tabla `cali_repositorio`
--
ALTER TABLE `cali_repositorio`
  ADD CONSTRAINT `fk_cali_repositoriio_cali_procedimientos1` FOREIGN KEY (`procedimiento_id`) REFERENCES `cali_procedimientos` (`procedimiento_id`),
  ADD CONSTRAINT `fk_cali_repositorio_cali_tipos_documentos1` FOREIGN KEY (`tipo_docu_id`) REFERENCES `cali_tipos_documentos` (`tipo_docu_id`),
  ADD CONSTRAINT `fk_cali_repositorio_config_rutas_archi_calidad1` FOREIGN KEY (`id_ruta`) REFERENCES `config_rutas_archi_calidad` (`id_ruta`);

--
-- Filtros para la tabla `config_empresa`
--
ALTER TABLE `config_empresa`
  ADD CONSTRAINT `fk_config_empresa_config_depar1` FOREIGN KEY (`id_depar`) REFERENCES `config_depar` (`id_depar`),
  ADD CONSTRAINT `fk_config_empresa_config_muni1` FOREIGN KEY (`id_muni`) REFERENCES `config_muni` (`id_muni`);

--
-- Filtros para la tabla `config_muni`
--
ALTER TABLE `config_muni`
  ADD CONSTRAINT `config_muni_ibfk_1` FOREIGN KEY (`id_depar`) REFERENCES `config_depar` (`id_depar`);

--
-- Filtros para la tabla `config_otras_responsables_pqrsf`
--
ALTER TABLE `config_otras_responsables_pqrsf`
  ADD CONSTRAINT `fk_config_otras_hc_responsables_archivo_trd_series10` FOREIGN KEY (`id_serie`) REFERENCES `archivo_trd_series` (`id_serie`),
  ADD CONSTRAINT `fk_config_otras_hc_responsables_archivo_trd_subserie10` FOREIGN KEY (`id_subserie`) REFERENCES `archivo_trd_subserie` (`id_subserie`),
  ADD CONSTRAINT `fk_config_otras_hc_responsables_archivo_trd_tipo_docu10` FOREIGN KEY (`id_tipodoc`) REFERENCES `archivo_trd_tipo_docu` (`id_tipodoc`),
  ADD CONSTRAINT `fk_config_otras_hc_responsables_areas_dependencias10` FOREIGN KEY (`id_depen`) REFERENCES `areas_dependencias` (`id_depen`),
  ADD CONSTRAINT `fk_config_otras_hc_responsables_gene_funcionarios_deta10` FOREIGN KEY (`id_funcio_deta`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`);

--
-- Filtros para la tabla `config_rutas_archi_gestion`
--
ALTER TABLE `config_rutas_archi_gestion`
  ADD CONSTRAINT `fk_config_rutas_archi_gestion_id_depen` FOREIGN KEY (`id_depen`) REFERENCES `areas_dependencias` (`id_depen`);

--
-- Filtros para la tabla `config_tipo_correspondencia`
--
ALTER TABLE `config_tipo_correspondencia`
  ADD CONSTRAINT `fk_config_tipo_correspondencia_config_tipos_origen1` FOREIGN KEY (`id_origen`) REFERENCES `config_origen_correspondencia` (`id_origen`);

--
-- Filtros para la tabla `gene_funcionarios`
--
ALTER TABLE `gene_funcionarios`
  ADD CONSTRAINT `admin_funcionario_ibfk_2` FOREIGN KEY (`id_depar`) REFERENCES `config_depar` (`id_depar`),
  ADD CONSTRAINT `admin_funcionario_ibfk_3` FOREIGN KEY (`id_muni`) REFERENCES `config_muni` (`id_muni`);

--
-- Filtros para la tabla `gene_funcionarios_deta`
--
ALTER TABLE `gene_funcionarios_deta`
  ADD CONSTRAINT `gene_funcionarios_deta_cargo` FOREIGN KEY (`id_cargo`) REFERENCES `areas_cargos` (`id_cargo`),
  ADD CONSTRAINT `gene_funcionarios_deta_id_funcio` FOREIGN KEY (`id_funcio`) REFERENCES `gene_funcionarios` (`id_funcio`),
  ADD CONSTRAINT `gene_funcionarios_deta_oficina` FOREIGN KEY (`id_oficina`) REFERENCES `areas_oficinas` (`id_oficina`);

--
-- Filtros para la tabla `gene_funcionarios_digitales`
--
ALTER TABLE `gene_funcionarios_digitales`
  ADD CONSTRAINT `fk_gene_funcionarios_digitales_archivo_trd_series1` FOREIGN KEY (`id_serie`) REFERENCES `archivo_trd_series` (`id_serie`),
  ADD CONSTRAINT `fk_gene_funcionarios_digitales_archivo_trd_subserie1` FOREIGN KEY (`id_subserie`) REFERENCES `archivo_trd_subserie` (`id_subserie`),
  ADD CONSTRAINT `fk_gene_funcionarios_digitales_areas_dependencias1` FOREIGN KEY (`id_depen`) REFERENCES `areas_dependencias` (`id_depen`),
  ADD CONSTRAINT `fk_gene_funcionarios_digitales_gene_funcionarios_deta1` FOREIGN KEY (`id_funcio_deta`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`);

--
-- Filtros para la tabla `gene_terceros_contac`
--
ALTER TABLE `gene_terceros_contac`
  ADD CONSTRAINT `fk_gene_terceros_contac_config_depar1` FOREIGN KEY (`id_depar`) REFERENCES `config_depar` (`id_depar`),
  ADD CONSTRAINT `fk_gene_terceros_contac_config_muni1` FOREIGN KEY (`id_muni`) REFERENCES `config_muni` (`id_muni`),
  ADD CONSTRAINT `fk_gene_terceros_contac_config_tipo_documento1` FOREIGN KEY (`id_tipo_docu`) REFERENCES `config_tipo_documento` (`id_tipo`),
  ADD CONSTRAINT `fk_gene_terceros_contac_gene_terceros_empresas1` FOREIGN KEY (`id_empre`) REFERENCES `gene_terceros_empresas` (`id_empre`);

--
-- Filtros para la tabla `gene_terceros_empresas`
--
ALTER TABLE `gene_terceros_empresas`
  ADD CONSTRAINT `fk_gene_remitentes_empresas_config_depar1` FOREIGN KEY (`id_depar`) REFERENCES `config_depar` (`id_depar`),
  ADD CONSTRAINT `fk_gene_remitentes_empresas_config_muni1` FOREIGN KEY (`id_muni`) REFERENCES `config_muni` (`id_muni`);

--
-- Filtros para la tabla `notifica_email_externa`
--
ALTER TABLE `notifica_email_externa`
  ADD CONSTRAINT `fk_notifica_email_externa_segu_usua_1` FOREIGN KEY (`id_usua_registra`) REFERENCES `segu_usua` (`id_usua`),
  ADD CONSTRAINT `fk_notifica_externa_gene_funcionarios_deta_10` FOREIGN KEY (`id_funcio_deta`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`);

--
-- Filtros para la tabla `notifica_externa`
--
ALTER TABLE `notifica_externa`
  ADD CONSTRAINT `fk_notifica_externa_gene_funcionarios_deta1` FOREIGN KEY (`id_funcio_deta`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`);

--
-- Filtros para la tabla `notifica_interna`
--
ALTER TABLE `notifica_interna`
  ADD CONSTRAINT `fk_notifica_interna_gene_funcionarios_deta1` FOREIGN KEY (`id_funcio_deta`) REFERENCES `gene_funcionarios_deta` (`id_funcio_deta`);

--
-- Filtros para la tabla `segu_log`
--
ALTER TABLE `segu_log`
  ADD CONSTRAINT `fk_segu_log_Usua` FOREIGN KEY (`id_usua`) REFERENCES `segu_usua` (`id_usua`);

--
-- Filtros para la tabla `segu_perfiles_deta`
--
ALTER TABLE `segu_perfiles_deta`
  ADD CONSTRAINT `fk_segu_perfiles_deta_segu_modu1` FOREIGN KEY (`id_modu`) REFERENCES `segu_modu` (`id_modu`),
  ADD CONSTRAINT `fk_segu_perfiles_deta_segu_perfiles1` FOREIGN KEY (`id_perfil`) REFERENCES `segu_perfiles` (`id_perfil`);

--
-- Filtros para la tabla `segu_sesiones`
--
ALTER TABLE `segu_sesiones`
  ADD CONSTRAINT `fk_segu_sesiones_segu_usua1` FOREIGN KEY (`id_usua`) REFERENCES `segu_usua` (`id_usua`);

--
-- Filtros para la tabla `segu_usua`
--
ALTER TABLE `segu_usua`
  ADD CONSTRAINT `fk_segu_usua_gene_funcionarios1` FOREIGN KEY (`id_funcio`) REFERENCES `gene_funcionarios` (`id_funcio`);

--
-- Filtros para la tabla `segu_usuadeta`
--
ALTER TABLE `segu_usuadeta`
  ADD CONSTRAINT `segu_usuadeta_ibfk_1` FOREIGN KEY (`id_perfil`) REFERENCES `segu_perfiles` (`id_perfil`),
  ADD CONSTRAINT `segu_usuadeta_id_usua` FOREIGN KEY (`id_usua`) REFERENCES `segu_usua` (`id_usua`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
