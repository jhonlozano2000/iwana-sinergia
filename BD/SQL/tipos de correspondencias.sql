/*
SQLyog Professional v13.1.1 (64 bit)
MySQL - 8.0.30 : Database - iwana_espinal
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`iwana_espinal` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `iwana_espinal`;

/*Table structure for table `config_tipo_correspondencia` */

DROP TABLE IF EXISTS `config_tipo_correspondencia`;

CREATE TABLE `config_tipo_correspondencia` (
  `id_tipo` int NOT NULL AUTO_INCREMENT,
  `id_origen` int NOT NULL,
  `nom_tipo` varchar(45) DEFAULT NULL,
  `acti` tinyint(1) DEFAULT '1',
  `ver_radicar` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_tipo`),
  KEY `fk_config_tipo_correspondencia_config_tipos_origen1_idx` (`id_origen`),
  CONSTRAINT `fk_config_tipo_correspondencia_config_tipos_origen1` FOREIGN KEY (`id_origen`) REFERENCES `config_origen_correspondencia` (`id_origen`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

/*Data for the table `config_tipo_correspondencia` */

insert  into `config_tipo_correspondencia`(`id_tipo`,`id_origen`,`nom_tipo`,`acti`,`ver_radicar`) values 
(1,1,'Correspondencia recibida',1,NULL),
(2,2,'Correspondencia enviada',1,NULL),
(3,3,'Correspondencia interna',1,NULL),
(4,5,'Pregunta',1,NULL),
(5,5,'Queja',1,NULL),
(6,5,'Reclamo',1,NULL),
(7,5,'Solicitud',1,NULL),
(8,5,'Felicitaciones',1,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
