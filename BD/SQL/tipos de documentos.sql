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

/*Table structure for table `config_tipo_documento` */

DROP TABLE IF EXISTS `config_tipo_documento`;

CREATE TABLE `config_tipo_documento` (
  `id_tipo` int NOT NULL AUTO_INCREMENT,
  `cod_tipo` varchar(45) NOT NULL,
  `nom_tipo` char(100) NOT NULL,
  `acti` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;

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

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
