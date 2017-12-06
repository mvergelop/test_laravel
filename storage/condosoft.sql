-- MySQL dump 10.13  Distrib 5.7.14, for Win64 (x86_64)
--
-- Host: localhost    Database: condosoft
-- ------------------------------------------------------
-- Server version	5.7.14

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `condosoft`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `condosoft` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `condosoft`;

--
-- Table structure for table `condominios`
--

DROP TABLE IF EXISTS `condominios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `condominios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `id_fiscal` varchar(100) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `administrador` varchar(100) DEFAULT NULL,
  `url` varchar(400) DEFAULT NULL,
  `tipo` varchar(2) DEFAULT NULL,
  `cant_inmuebles` int(11) DEFAULT NULL,
  `niveles` tinyint(4) DEFAULT NULL,
  `cant_niveles` int(11) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `periodo_inicial` int(11) DEFAULT NULL,
  `tipo_cuota_defecto` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `condominios`
--

LOCK TABLES `condominios` WRITE;
/*!40000 ALTER TABLE `condominios` DISABLE KEYS */;
INSERT INTO `condominios` VALUES (1,'Urb Valle Alto',NULL,'Urb Valle Alto Calle 95B-1 CASA 58A-180',NULL,NULL,'2',205,0,0,'2017-01-04','2017-01-04',2,NULL),(3,'Mall Delicias Plaza',NULL,'Av Delicias','Melvin Vergel','malldeliciasplaza','1',140,NULL,2,'2017-01-04','2017-01-16',2,'2'),(4,'Urb Valle Alto 23',NULL,'Urb Valle Alto Calle 95B-1 CASA 58A-180',NULL,'urbvallealto23','1',205,0,0,'2017-01-16','2017-01-16',2,'1');
/*!40000 ALTER TABLE `condominios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `config`
--

DROP TABLE IF EXISTS `config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `config` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `adjunto1` varchar(100) DEFAULT NULL,
  `adjunto2` varchar(100) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `config`
--

LOCK TABLES `config` WRITE;
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` VALUES (1,'C:\\wamp64\\www\\condosoft\\public/storage/condosoft.sql',NULL,'2017-02-13','2017-02-13');
/*!40000 ALTER TABLE `config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cuotas_inmuebles`
--

DROP TABLE IF EXISTS `cuotas_inmuebles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cuotas_inmuebles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_condominio` int(11) DEFAULT NULL,
  `aaaa` int(11) DEFAULT NULL,
  `mes` int(11) DEFAULT NULL,
  `id_inmueble` int(11) DEFAULT NULL,
  `ocupante` varchar(100) DEFAULT NULL,
  `monto` decimal(16,2) DEFAULT NULL,
  `fecha_doc` date DEFAULT NULL,
  `extra` tinyint(4) DEFAULT NULL,
  `tipo` varchar(1) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `id_periodo` int(11) DEFAULT NULL,
  `forma_pago` int(11) DEFAULT NULL,
  `anticipo` bit(1) DEFAULT NULL,
  `eti_extra` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=116 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cuotas_inmuebles`
--

LOCK TABLES `cuotas_inmuebles` WRITE;
/*!40000 ALTER TABLE `cuotas_inmuebles` DISABLE KEYS */;
INSERT INTO `cuotas_inmuebles` VALUES (1,1,2017,1,1,NULL,2000.00,'2017-01-04',0,NULL,'2017-01-04','2017-01-04',2,NULL,NULL,NULL),(2,1,2017,1,2,NULL,2000.00,'2017-01-04',0,NULL,'2017-01-04','2017-01-04',2,NULL,NULL,NULL),(3,1,2017,2,1,NULL,2000.00,'2017-01-04',0,NULL,'2017-01-04','2017-01-04',3,NULL,NULL,NULL),(4,1,2017,2,2,NULL,2000.00,'2017-01-04',0,NULL,'2017-01-04','2017-01-04',3,NULL,NULL,NULL),(5,3,2017,1,4,NULL,2000.00,'2017-01-04',0,NULL,'2017-01-04','2017-01-04',2,NULL,NULL,NULL),(6,3,2017,1,5,NULL,2000.00,'2017-01-04',0,NULL,'2017-01-04','2017-01-04',2,NULL,NULL,NULL),(7,3,2017,1,4,'Nestor Zambrano',-2000.00,'2017-01-04',0,NULL,'2017-01-04','2017-01-04',2,1,NULL,NULL),(8,3,0,0,4,'Nestor Zambrano',0.00,'2017-01-06',0,NULL,'2017-01-06','2017-01-30',0,1,NULL,NULL),(9,3,2017,1,5,'Melvin Vergel',-2000.00,'2017-01-06',0,NULL,'2017-01-06','2017-01-06',2,1,NULL,NULL),(10,3,0,0,5,'Melvin Vergel',0.00,'2017-01-16',0,NULL,'2017-01-09','2017-01-30',0,1,NULL,NULL),(11,3,0,0,5,'Melvin Vergel',-5700.00,'2017-01-09',0,NULL,'2017-01-09','2017-01-30',0,1,NULL,NULL),(12,3,0,0,5,'Melvin Vergel',-13000.00,'2017-01-03',0,NULL,'2017-01-09','2017-01-09',0,1,NULL,NULL),(29,3,2017,3,4,NULL,20000.00,'2017-01-29',0,NULL,'2017-01-29','2017-01-29',4,NULL,NULL,NULL),(28,3,2016,12,7,'Melvin Vergel',-1400.00,'2017-01-24',0,NULL,'2017-01-29','2017-01-29',1,1,NULL,NULL),(27,3,2017,2,6,NULL,0.00,'2017-01-15',0,NULL,'2017-01-15','2017-01-15',3,NULL,NULL,NULL),(26,3,2017,2,5,NULL,0.00,'2017-01-15',0,NULL,'2017-01-15','2017-01-15',3,NULL,NULL,NULL),(25,3,2017,2,4,NULL,288.00,'2017-01-15',0,NULL,'2017-01-15','2017-01-15',3,NULL,NULL,NULL),(30,3,2017,3,5,NULL,20000.00,'2017-01-29',0,NULL,'2017-01-29','2017-01-29',4,NULL,NULL,NULL),(31,3,2017,3,6,NULL,20000.00,'2017-01-29',0,NULL,'2017-01-29','2017-01-29',4,NULL,NULL,NULL),(32,3,2017,3,7,NULL,20000.00,'2017-01-29',0,NULL,'2017-01-29','2017-01-29',4,NULL,NULL,NULL),(60,3,2017,3,6,'Cell Store',-20000.00,'2017-01-29',0,NULL,'2017-01-30','2017-01-30',4,1,NULL,NULL),(61,3,0,0,6,'Cell Store',0.00,'2017-01-29',0,NULL,'2017-01-30','2017-01-30',0,1,NULL,NULL),(75,3,2017,4,4,NULL,4000.00,'2017-04-01',0,NULL,'2017-01-30','2017-01-30',7,NULL,NULL,NULL),(76,3,2017,4,5,NULL,4000.00,'2017-04-01',0,NULL,'2017-01-30','2017-01-30',7,NULL,NULL,NULL),(77,3,2017,4,5,NULL,-2300.00,'2017-01-16',0,NULL,'2017-01-30','2017-01-30',7,1,'',NULL),(78,3,2017,4,5,NULL,-6300.00,'2017-01-09',0,NULL,'2017-01-30','2017-01-30',7,1,'',NULL),(79,3,2017,4,6,NULL,4000.00,'2017-04-01',0,NULL,'2017-01-30','2017-01-30',7,NULL,NULL,NULL),(80,3,2017,4,6,NULL,-1000.00,'2017-01-29',0,NULL,'2017-01-30','2017-01-30',7,1,'',NULL),(81,3,2017,4,7,NULL,4000.00,'2017-04-01',0,NULL,'2017-01-30','2017-01-30',7,NULL,NULL,NULL),(82,3,2017,4,8,NULL,4000.00,'2017-04-01',0,NULL,'2017-01-30','2017-01-30',7,NULL,NULL,NULL),(83,3,2016,12,8,'Melvin Vergel',-1200.00,'2017-05-25',0,NULL,'2017-02-01','2017-02-01',1,1,NULL,NULL),(84,3,2017,3,5,'Melvin Vergel',-20.00,'2017-06-14',NULL,NULL,'2017-02-07','2017-02-07',4,1,NULL,NULL),(85,3,2017,3,5,'Melvin Vergel',-19.00,'2017-06-22',NULL,NULL,'2017-02-07','2017-02-07',4,1,NULL,NULL),(86,3,2017,4,8,'Melvin Vergel',-40.00,'2017-06-22',NULL,NULL,'2017-02-07','2017-02-07',7,1,NULL,NULL),(87,3,2017,3,5,'Melvin Vergel',-20.00,'2017-07-14',NULL,NULL,'2017-02-07','2017-02-07',4,1,NULL,NULL),(88,3,2017,3,5,'Melvin Vergel',-5.99,'2017-05-18',NULL,NULL,'2017-02-07','2017-02-07',4,1,NULL,NULL),(89,3,2017,3,5,'Melvin Vergel',-79.94,'2017-07-07',NULL,NULL,'2017-02-07','2017-02-07',4,1,NULL,NULL),(90,3,2017,4,8,'Melvin Vergel',-3960.00,'2017-06-15',NULL,NULL,'2017-02-07','2017-02-07',7,1,NULL,NULL),(114,3,2017,6,8,NULL,10000.00,'2017-06-01',1,NULL,'2017-02-08','2017-02-08',9,NULL,NULL,NULL),(113,3,2017,5,8,NULL,10000.00,'2017-05-01',1,NULL,'2017-02-08','2017-02-08',8,NULL,NULL,NULL),(112,3,2017,6,7,NULL,10000.00,'2017-06-01',1,NULL,'2017-02-08','2017-02-08',9,NULL,NULL,NULL),(111,3,2017,5,7,NULL,10000.00,'2017-05-01',1,NULL,'2017-02-08','2017-02-08',8,NULL,NULL,NULL),(110,3,2017,6,6,NULL,10000.00,'2017-06-01',1,NULL,'2017-02-08','2017-02-08',9,NULL,NULL,NULL),(109,3,2017,5,6,NULL,10000.00,'2017-05-01',1,NULL,'2017-02-08','2017-02-08',8,NULL,NULL,NULL),(108,3,2017,6,5,NULL,10000.00,'2017-06-01',1,NULL,'2017-02-08','2017-02-08',9,NULL,NULL,NULL),(107,3,2017,5,5,NULL,10000.00,'2017-05-01',1,NULL,'2017-02-08','2017-02-08',8,NULL,NULL,NULL),(106,3,2017,6,4,NULL,10000.00,'2017-06-01',1,NULL,'2017-02-08','2017-02-08',9,NULL,NULL,NULL),(105,3,2017,5,4,NULL,10000.00,'2017-05-01',1,NULL,'2017-02-08','2017-02-08',8,NULL,NULL,NULL),(115,3,2017,3,5,'Melvin Vergel',-20000.00,'2017-08-16',0,NULL,'2017-02-12','2017-02-12',4,1,NULL,NULL);
/*!40000 ALTER TABLE `cuotas_inmuebles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `cuotas_inmuebles_cob_w`
--

DROP TABLE IF EXISTS `cuotas_inmuebles_cob_w`;
/*!50001 DROP VIEW IF EXISTS `cuotas_inmuebles_cob_w`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `cuotas_inmuebles_cob_w` AS SELECT 
 1 AS `id`,
 1 AS `id_condominio`,
 1 AS `aaaa`,
 1 AS `mes`,
 1 AS `id_inmueble`,
 1 AS `ocupante`,
 1 AS `monto`,
 1 AS `fecha_doc`,
 1 AS `extra`,
 1 AS `tipo`,
 1 AS `created_at`,
 1 AS `updated_at`,
 1 AS `id_periodo`,
 1 AS `forma_pago`,
 1 AS `inmueble`,
 1 AS `periodo`,
 1 AS `periodo_cobrado`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `cuotas_inmuebles_temp`
--

DROP TABLE IF EXISTS `cuotas_inmuebles_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cuotas_inmuebles_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_condominio` int(11) DEFAULT NULL,
  `aaaa` int(11) DEFAULT NULL,
  `mes` int(11) DEFAULT NULL,
  `id_inmueble` int(11) DEFAULT NULL,
  `ocupante` varchar(100) DEFAULT NULL,
  `monto` decimal(16,2) DEFAULT NULL,
  `fecha_doc` date DEFAULT NULL,
  `extra` tinyint(4) DEFAULT NULL,
  `tipo` varchar(1) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `id_periodo` int(11) DEFAULT NULL,
  `forma_pago` int(11) DEFAULT NULL,
  `anticipo` bit(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cuotas_inmuebles_temp`
--

LOCK TABLES `cuotas_inmuebles_temp` WRITE;
/*!40000 ALTER TABLE `cuotas_inmuebles_temp` DISABLE KEYS */;
/*!40000 ALTER TABLE `cuotas_inmuebles_temp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `cuotas_inmuebles_temp_w`
--

DROP TABLE IF EXISTS `cuotas_inmuebles_temp_w`;
/*!50001 DROP VIEW IF EXISTS `cuotas_inmuebles_temp_w`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `cuotas_inmuebles_temp_w` AS SELECT 
 1 AS `id_condominio`,
 1 AS `aaaa`,
 1 AS `mes`,
 1 AS `periodo`,
 1 AS `id_periodo`,
 1 AS `eti_inmueble`,
 1 AS `monto`,
 1 AS `id`,
 1 AS `forma_cobro`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `cuotas_ordinarias`
--

DROP TABLE IF EXISTS `cuotas_ordinarias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cuotas_ordinarias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aaaa` int(11) DEFAULT NULL,
  `mes` int(11) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cuotas_ordinarias`
--

LOCK TABLES `cuotas_ordinarias` WRITE;
/*!40000 ALTER TABLE `cuotas_ordinarias` DISABLE KEYS */;
INSERT INTO `cuotas_ordinarias` VALUES (1,2016,12,NULL,NULL),(2,2017,1,NULL,NULL),(3,2017,2,NULL,NULL),(4,2017,3,NULL,NULL),(5,2016,11,NULL,NULL),(6,2016,10,NULL,NULL),(7,2017,4,NULL,NULL),(8,2017,5,NULL,NULL),(9,2017,6,NULL,NULL),(10,2017,7,NULL,NULL),(11,2017,8,NULL,NULL),(12,2017,9,NULL,NULL),(13,2017,10,NULL,NULL),(14,2017,11,NULL,NULL),(15,2017,12,NULL,NULL);
/*!40000 ALTER TABLE `cuotas_ordinarias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `cuotas_ordinarias_gen_w`
--

DROP TABLE IF EXISTS `cuotas_ordinarias_gen_w`;
/*!50001 DROP VIEW IF EXISTS `cuotas_ordinarias_gen_w`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `cuotas_ordinarias_gen_w` AS SELECT 
 1 AS `id`,
 1 AS `id_condominio`,
 1 AS `aaaa`,
 1 AS `mes`,
 1 AS `id_inmueble`,
 1 AS `ocupante`,
 1 AS `monto`,
 1 AS `fecha_doc`,
 1 AS `extra`,
 1 AS `tipo`,
 1 AS `created_at`,
 1 AS `updated_at`,
 1 AS `id_periodo`,
 1 AS `forma_pago`,
 1 AS `inmueble`,
 1 AS `periodo`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `cuotas_ordinarias_w`
--

DROP TABLE IF EXISTS `cuotas_ordinarias_w`;
/*!50001 DROP VIEW IF EXISTS `cuotas_ordinarias_w`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `cuotas_ordinarias_w` AS SELECT 
 1 AS `id`,
 1 AS `aaaa`,
 1 AS `mes`,
 1 AS `id_condominio`,
 1 AS `periodo`,
 1 AS `fecha_inicio`,
 1 AS `fecha_final`,
 1 AS `inicio_sigperiodo`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `emails`
--

DROP TABLE IF EXISTS `emails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plantilla` varchar(100) DEFAULT NULL,
  `asunto` varchar(100) DEFAULT NULL,
  `para` varchar(100) DEFAULT NULL,
  `cc` varchar(100) DEFAULT NULL,
  `cco` varchar(100) DEFAULT NULL,
  `tipo` varchar(5) DEFAULT NULL,
  `parms1` varchar(100) DEFAULT NULL,
  `parms2` varchar(100) DEFAULT NULL,
  `parms3` varchar(100) DEFAULT NULL,
  `parms4` varchar(100) DEFAULT NULL,
  `enviado` varchar(1) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emails`
--

LOCK TABLES `emails` WRITE;
/*!40000 ALTER TABLE `emails` DISABLE KEYS */;
INSERT INTO `emails` VALUES (1,NULL,NULL,NULL,NULL,NULL,'100','test454353',NULL,NULL,NULL,'1','2017-01-24','2017-01-24'),(2,NULL,NULL,NULL,NULL,NULL,'100','test65465',NULL,NULL,NULL,'1','2017-01-24','2017-01-24'),(3,NULL,NULL,NULL,NULL,NULL,'100','test45465677',NULL,NULL,NULL,'1','2017-01-24','2017-01-24'),(4,NULL,NULL,NULL,NULL,NULL,'100','5645654',NULL,NULL,NULL,'1','2017-01-24','2017-01-24'),(5,NULL,NULL,NULL,NULL,NULL,'100','fdfdsf',NULL,NULL,NULL,'1','2017-01-24','2017-01-25'),(6,NULL,NULL,NULL,NULL,NULL,'100','sadas',NULL,NULL,NULL,'1','2017-01-24','2017-01-25'),(8,NULL,NULL,NULL,NULL,NULL,'110','ccmall@gmail.com','2CnOr[N1VJi53IyUxDKR',NULL,NULL,'1','2017-02-07','2017-02-07');
/*!40000 ALTER TABLE `emails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faq`
--

DROP TABLE IF EXISTS `faq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `posicion` int(11) DEFAULT NULL,
  `pregunta` varchar(500) DEFAULT NULL,
  `respuesta` varchar(500) DEFAULT NULL,
  `mostrar` bit(1) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faq`
--

LOCK TABLES `faq` WRITE;
/*!40000 ALTER TABLE `faq` DISABLE KEYS */;
INSERT INTO `faq` VALUES (1,1,'Como Registrarce','Respuesta de como Registrace','','2017-01-23','2017-01-23'),(2,2,'Test','Test','','2017-01-23','2017-01-23');
/*!40000 ALTER TABLE `faq` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `formas_pago`
--

DROP TABLE IF EXISTS `formas_pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `formas_pago` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_condominio` int(11) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `saldo_inicial` decimal(16,2) DEFAULT NULL,
  `activo` tinyint(4) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formas_pago`
--

LOCK TABLES `formas_pago` WRITE;
/*!40000 ALTER TABLE `formas_pago` DISABLE KEYS */;
INSERT INTO `formas_pago` VALUES (1,3,'Banesco Cta Corriente 0041',0.00,1,'2017-01-04','2017-01-16'),(2,3,'',0.00,1,'2017-01-31','2017-01-31'),(3,3,'',0.00,1,'2017-01-31','2017-01-31'),(4,3,'melvin',14.00,1,'2017-01-31','2017-01-31'),(5,3,'test',12.00,1,'2017-01-31','2017-01-31'),(6,3,'test3',1234.00,1,'2017-01-31','2017-01-31');
/*!40000 ALTER TABLE `formas_pago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gastos`
--

DROP TABLE IF EXISTS `gastos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gastos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipogasto` int(11) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `activo` tinyint(4) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `id_condominio` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gastos`
--

LOCK TABLES `gastos` WRITE;
/*!40000 ALTER TABLE `gastos` DISABLE KEYS */;
INSERT INTO `gastos` VALUES (8,2,'',1,'2017-01-31','2017-01-31',0),(7,1,'CANTV',1,'2017-01-11','2017-01-11',0),(6,2,'Sueldos y Salarios',1,'2017-01-11','2017-01-31',3);
/*!40000 ALTER TABLE `gastos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gastos_mov`
--

DROP TABLE IF EXISTS `gastos_mov`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gastos_mov` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_condominio` int(11) DEFAULT NULL,
  `id_gasto` int(11) DEFAULT NULL,
  `des_gasto` varchar(100) DEFAULT NULL,
  `documento` varchar(100) DEFAULT NULL,
  `fecha_doc` date DEFAULT NULL,
  `id_proveedor` varchar(20) DEFAULT NULL,
  `des_proveedor` varchar(100) DEFAULT NULL,
  `monto` decimal(16,2) DEFAULT NULL,
  `observaciones` varchar(100) DEFAULT NULL,
  `id_formapago` int(11) DEFAULT NULL,
  `des_formapago` varchar(100) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `fecha_proceso` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gastos_mov`
--

LOCK TABLES `gastos_mov` WRITE;
/*!40000 ALTER TABLE `gastos_mov` DISABLE KEYS */;
INSERT INTO `gastos_mov` VALUES (1,3,2,'Electricidad','123','2017-01-11','19549009','Melvin Vergel',1000.00,NULL,NULL,NULL,'2017-01-06','2017-01-06',NULL),(2,3,2,'Electricidad','1234','2016-12-28','12000','1231',1200.00,NULL,NULL,NULL,'2017-01-06','2017-01-06',NULL),(3,3,1,'Sueldos y Salarios','1234','2017-01-09','12','12',123.00,NULL,NULL,NULL,'2017-01-09','2017-01-09','2016-12-31'),(4,3,6,'Sueldos y Salarios','123453','2017-01-18','123','123',12354.00,NULL,NULL,NULL,'2017-01-18','2017-01-18','2017-01-18');
/*!40000 ALTER TABLE `gastos_mov` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gastos_mov_temp`
--

DROP TABLE IF EXISTS `gastos_mov_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gastos_mov_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_condominio` int(11) DEFAULT NULL,
  `id_gasto` int(11) DEFAULT NULL,
  `des_gasto` varchar(100) DEFAULT NULL,
  `documento` varchar(100) DEFAULT NULL,
  `fecha_doc` date DEFAULT NULL,
  `id_proveedor` varchar(20) DEFAULT NULL,
  `des_proveedor` varchar(100) DEFAULT NULL,
  `monto` decimal(16,2) DEFAULT NULL,
  `observaciones` varchar(100) DEFAULT NULL,
  `id_formapago` int(11) DEFAULT NULL,
  `des_formapago` varchar(100) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `fecha_proceso` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gastos_mov_temp`
--

LOCK TABLES `gastos_mov_temp` WRITE;
/*!40000 ALTER TABLE `gastos_mov_temp` DISABLE KEYS */;
INSERT INTO `gastos_mov_temp` VALUES (15,3,6,'Sueldos y Salarios','1234','2017-02-08','1234','123',1234.00,NULL,NULL,NULL,'2017-02-08','2017-02-08','2017-05-19');
/*!40000 ALTER TABLE `gastos_mov_temp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `gastos_mov_w`
--

DROP TABLE IF EXISTS `gastos_mov_w`;
/*!50001 DROP VIEW IF EXISTS `gastos_mov_w`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `gastos_mov_w` AS SELECT 
 1 AS `id`,
 1 AS `id_condominio`,
 1 AS `id_gasto`,
 1 AS `des_gasto`,
 1 AS `documento`,
 1 AS `fecha_doc`,
 1 AS `id_proveedor`,
 1 AS `des_proveedor`,
 1 AS `monto`,
 1 AS `observaciones`,
 1 AS `id_formapago`,
 1 AS `des_formapago`,
 1 AS `created_at`,
 1 AS `updated_at`,
 1 AS `fecha_proceso`,
 1 AS `id_periodo`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `ingresos_adicionales`
--

DROP TABLE IF EXISTS `ingresos_adicionales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ingresos_adicionales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_condominio` int(11) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `activo` bit(1) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `referencia` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingresos_adicionales`
--

LOCK TABLES `ingresos_adicionales` WRITE;
/*!40000 ALTER TABLE `ingresos_adicionales` DISABLE KEYS */;
INSERT INTO `ingresos_adicionales` VALUES (1,0,'Alquiler Areas Comunes','','2017-01-17','2017-01-17',NULL),(2,3,'Intereses Bancarios','','2017-01-17','2017-01-17',NULL),(3,3,'Recaudacion para Compra de Agua','','2017-01-17','2017-01-17',NULL),(4,3,'Donaciones','','2017-01-17','2017-01-17',NULL),(5,3,'Otros Ingresos','','2017-01-17','2017-01-17',NULL),(8,3,'Alquiler Areas Comunes','','2017-01-31','2017-01-31',NULL);
/*!40000 ALTER TABLE `ingresos_adicionales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ingresos_adicionales_mov`
--

DROP TABLE IF EXISTS `ingresos_adicionales_mov`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ingresos_adicionales_mov` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_condominio` int(11) DEFAULT NULL,
  `id_ingreso` int(11) DEFAULT NULL,
  `fecha_proceso` date DEFAULT NULL,
  `monto` decimal(16,2) DEFAULT NULL,
  `id_formapago` int(11) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `referencia` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingresos_adicionales_mov`
--

LOCK TABLES `ingresos_adicionales_mov` WRITE;
/*!40000 ALTER TABLE `ingresos_adicionales_mov` DISABLE KEYS */;
INSERT INTO `ingresos_adicionales_mov` VALUES (1,3,3,'2017-05-25',NULL,1,'2017-02-08','2017-02-08','12354'),(2,3,3,'2017-05-25',NULL,1,'2017-02-08','2017-02-08','12354');
/*!40000 ALTER TABLE `ingresos_adicionales_mov` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ingresos_adicionales_mov_temp`
--

DROP TABLE IF EXISTS `ingresos_adicionales_mov_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ingresos_adicionales_mov_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_condominio` int(11) DEFAULT NULL,
  `id_ingreso` int(11) DEFAULT NULL,
  `fecha_proceso` date DEFAULT NULL,
  `monto` decimal(16,2) DEFAULT NULL,
  `id_formapago` int(11) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `referencia` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingresos_adicionales_mov_temp`
--

LOCK TABLES `ingresos_adicionales_mov_temp` WRITE;
/*!40000 ALTER TABLE `ingresos_adicionales_mov_temp` DISABLE KEYS */;
/*!40000 ALTER TABLE `ingresos_adicionales_mov_temp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inmuebles`
--

DROP TABLE IF EXISTS `inmuebles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inmuebles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_condominio` int(11) DEFAULT NULL,
  `identificador` varchar(100) DEFAULT NULL,
  `nivel` varchar(10) DEFAULT NULL,
  `ocupante` varchar(100) DEFAULT NULL,
  `id_legal` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `porc_cuota` decimal(16,4) DEFAULT NULL,
  `saldo_inicial` decimal(16,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inmuebles`
--

LOCK TABLES `inmuebles` WRITE;
/*!40000 ALTER TABLE `inmuebles` DISABLE KEYS */;
INSERT INTO `inmuebles` VALUES (1,1,'58A-180','0','Melvin Vergel','19549009','melvin.vergel@gmail.com','2017-01-04','2017-01-04',NULL,NULL),(2,1,'58A-200','0','Milanyela Pirela','11861363','milanyelap@yahoo.es','2017-01-04','2017-01-04',NULL,NULL),(3,1,'58A-220','0','Jhoan Morillo','23543199','jhoangmp@gmail.com','2017-01-04','2017-01-04',NULL,NULL),(4,3,'1','0','Jose','111111111','nestor@gmail.com','2017-01-04','2017-01-25',0.1200,0.00),(5,3,'2','0','Melvin Vergel','19549009','melvin.vergel@gmail.com','2017-01-04','2017-01-04',NULL,NULL),(6,3,'LC001','0','Cell Store','12343323','jose@gmail.com','2017-01-08','2017-01-08',NULL,NULL),(7,3,'lak07n','0','Melvin Vergel','19549009','melvin.vergel@gmail.com','2017-01-20','2017-01-20',0.0000,1400.00),(8,3,'abc001','0','Melvin Vergel','1954909','melvin.vergel@gmail.com','2017-01-29','2017-01-29',NULL,1200.00);
/*!40000 ALTER TABLE `inmuebles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `monto_cuota`
--

DROP TABLE IF EXISTS `monto_cuota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `monto_cuota` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_condominio` int(11) DEFAULT NULL,
  `monto` decimal(16,2) DEFAULT NULL,
  `extra` tinyint(1) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `monto_cuota`
--

LOCK TABLES `monto_cuota` WRITE;
/*!40000 ALTER TABLE `monto_cuota` DISABLE KEYS */;
/*!40000 ALTER TABLE `monto_cuota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `periodos_cerrados`
--

DROP TABLE IF EXISTS `periodos_cerrados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `periodos_cerrados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_periodo` int(11) DEFAULT NULL,
  `id_condominio` int(11) DEFAULT NULL,
  `aaaa` int(11) DEFAULT NULL,
  `mes` int(11) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_final` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `periodos_cerrados`
--

LOCK TABLES `periodos_cerrados` WRITE;
/*!40000 ALTER TABLE `periodos_cerrados` DISABLE KEYS */;
INSERT INTO `periodos_cerrados` VALUES (3,2,3,2017,1,'2017-01-01','2017-01-31','2017-01-04','2017-01-04'),(2,1,3,2016,12,'2016-12-01','2016-12-31','2017-01-04','2017-01-04'),(4,3,3,2017,2,'2017-02-01','2017-02-28','2017-01-11','2017-01-11'),(5,1,4,2016,12,'2016-12-01','2016-12-31','2017-01-16','2017-01-16'),(6,4,3,2017,3,'2017-03-01','2017-03-31','2017-01-29','2017-01-29'),(7,7,3,2017,4,'2017-04-01','2017-04-30','2017-02-03','2017-02-03'),(8,8,3,2017,5,'2017-05-01','2017-05-31','2017-02-12','2017-02-12'),(9,9,3,2017,6,'2017-06-01','2017-06-30','2017-02-12','2017-02-12'),(10,10,3,2017,7,'2017-07-01','2017-07-31','2017-02-12','2017-02-12'),(11,11,3,2017,8,'2017-08-01','2017-08-31','2017-02-12','2017-02-12');
/*!40000 ALTER TABLE `periodos_cerrados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `periodos_cerrados_w`
--

DROP TABLE IF EXISTS `periodos_cerrados_w`;
/*!50001 DROP VIEW IF EXISTS `periodos_cerrados_w`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `periodos_cerrados_w` AS SELECT 
 1 AS `id`,
 1 AS `id_periodo`,
 1 AS `id_condominio`,
 1 AS `aaaa`,
 1 AS `mes`,
 1 AS `fecha_inicio`,
 1 AS `fecha_final`,
 1 AS `created_at`,
 1 AS `updated_at`,
 1 AS `periodo`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `periodos_iniciales_w`
--

DROP TABLE IF EXISTS `periodos_iniciales_w`;
/*!50001 DROP VIEW IF EXISTS `periodos_iniciales_w`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `periodos_iniciales_w` AS SELECT 
 1 AS `id_condominio`,
 1 AS `id_periodo`,
 1 AS `periodo`,
 1 AS `aaaa`,
 1 AS `mes`,
 1 AS `fecha_inicio`,
 1 AS `fecha_final`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `periodos_w`
--

DROP TABLE IF EXISTS `periodos_w`;
/*!50001 DROP VIEW IF EXISTS `periodos_w`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `periodos_w` AS SELECT 
 1 AS `id`,
 1 AS `aaaa`,
 1 AS `mes`,
 1 AS `fecha_inicio`,
 1 AS `fecha_final`,
 1 AS `periodo`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `periodos_x_cerrar_w`
--

DROP TABLE IF EXISTS `periodos_x_cerrar_w`;
/*!50001 DROP VIEW IF EXISTS `periodos_x_cerrar_w`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `periodos_x_cerrar_w` AS SELECT 
 1 AS `id`,
 1 AS `id_condominio`,
 1 AS `aaaa`,
 1 AS `mes`,
 1 AS `fecha_inicio`,
 1 AS `fecha_final`,
 1 AS `periodo`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `saldos_cuotas_inmuebles_w`
--

DROP TABLE IF EXISTS `saldos_cuotas_inmuebles_w`;
/*!50001 DROP VIEW IF EXISTS `saldos_cuotas_inmuebles_w`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `saldos_cuotas_inmuebles_w` AS SELECT 
 1 AS `id_condominio`,
 1 AS `id_inmueble`,
 1 AS `aaaa`,
 1 AS `mes`,
 1 AS `id_periodo`,
 1 AS `monto`,
 1 AS `eti_periodo`,
 1 AS `extra`,
 1 AS `periodo`,
 1 AS `fecha_final`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `saldos_iniciales_w`
--

DROP TABLE IF EXISTS `saldos_iniciales_w`;
/*!50001 DROP VIEW IF EXISTS `saldos_iniciales_w`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `saldos_iniciales_w` AS SELECT 
 1 AS `id_condominio`,
 1 AS `id_inmueble`,
 1 AS `aaaa`,
 1 AS `mes`,
 1 AS `id_periodo`,
 1 AS `saldo_inicial`,
 1 AS `monto`,
 1 AS `eti_periodo`,
 1 AS `extra`,
 1 AS `periodo`,
 1 AS `fecha_final`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `sesiones`
--

DROP TABLE IF EXISTS `sesiones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sesiones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sesion_id` varchar(100) DEFAULT NULL,
  `id_condominio` int(11) DEFAULT NULL,
  `nombre_condominio` varchar(100) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=201 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sesiones`
--

LOCK TABLES `sesiones` WRITE;
/*!40000 ALTER TABLE `sesiones` DISABLE KEYS */;
INSERT INTO `sesiones` VALUES (1,'047f94b62cf8948240215f0e50417e6c9713c615',3,'Mall Delicias Plaza','2017-01-18','2017-01-18'),(2,'047f94b62cf8948240215f0e50417e6c9713c615',3,'Mall Delicias Plaza','2017-01-18','2017-01-18'),(3,'047f94b62cf8948240215f0e50417e6c9713c615',3,'Mall Delicias Plaza','2017-01-18','2017-01-18'),(4,'047f94b62cf8948240215f0e50417e6c9713c615',3,'Mall Delicias Plaza','2017-01-18','2017-01-18'),(5,'047f94b62cf8948240215f0e50417e6c9713c615',3,'Mall Delicias Plaza','2017-01-18','2017-01-18'),(6,'047f94b62cf8948240215f0e50417e6c9713c615',3,'Mall Delicias Plaza','2017-01-18','2017-01-18'),(7,'047f94b62cf8948240215f0e50417e6c9713c615',3,'Mall Delicias Plaza','2017-01-18','2017-01-18'),(8,'047f94b62cf8948240215f0e50417e6c9713c615',3,'Mall Delicias Plaza','2017-01-18','2017-01-18'),(9,'047f94b62cf8948240215f0e50417e6c9713c615',3,'Mall Delicias Plaza','2017-01-18','2017-01-18'),(10,'d338000cdbf686c5e1db057467da2daa8af4f56e',3,'Mall Delicias Plaza','2017-01-18','2017-01-18'),(11,'d338000cdbf686c5e1db057467da2daa8af4f56e',3,'Mall Delicias Plaza','2017-01-18','2017-01-18'),(12,'d338000cdbf686c5e1db057467da2daa8af4f56e',3,'Mall Delicias Plaza','2017-01-18','2017-01-18'),(13,'d338000cdbf686c5e1db057467da2daa8af4f56e',3,'Mall Delicias Plaza','2017-01-18','2017-01-18'),(14,'d338000cdbf686c5e1db057467da2daa8af4f56e',3,'Mall Delicias Plaza','2017-01-18','2017-01-18'),(15,'d338000cdbf686c5e1db057467da2daa8af4f56e',3,'Mall Delicias Plaza','2017-01-18','2017-01-18'),(16,'d338000cdbf686c5e1db057467da2daa8af4f56e',3,'Mall Delicias Plaza','2017-01-18','2017-01-18'),(17,'d338000cdbf686c5e1db057467da2daa8af4f56e',3,'Mall Delicias Plaza','2017-01-18','2017-01-18'),(18,'d338000cdbf686c5e1db057467da2daa8af4f56e',3,'Mall Delicias Plaza','2017-01-18','2017-01-18'),(19,'d338000cdbf686c5e1db057467da2daa8af4f56e',3,'Mall Delicias Plaza','2017-01-18','2017-01-18'),(20,'d338000cdbf686c5e1db057467da2daa8af4f56e',3,'Mall Delicias Plaza','2017-01-18','2017-01-18'),(21,'d338000cdbf686c5e1db057467da2daa8af4f56e',3,'Mall Delicias Plaza','2017-01-18','2017-01-18'),(22,'d338000cdbf686c5e1db057467da2daa8af4f56e',3,'Mall Delicias Plaza','2017-01-18','2017-01-18'),(23,'d338000cdbf686c5e1db057467da2daa8af4f56e',3,'Mall Delicias Plaza','2017-01-18','2017-01-18'),(24,'d338000cdbf686c5e1db057467da2daa8af4f56e',3,'Mall Delicias Plaza','2017-01-18','2017-01-18'),(25,'d338000cdbf686c5e1db057467da2daa8af4f56e',3,'Mall Delicias Plaza','2017-01-18','2017-01-18'),(26,'d338000cdbf686c5e1db057467da2daa8af4f56e',3,'Mall Delicias Plaza','2017-01-18','2017-01-18'),(27,'d338000cdbf686c5e1db057467da2daa8af4f56e',3,'Mall Delicias Plaza','2017-01-18','2017-01-18'),(28,'d338000cdbf686c5e1db057467da2daa8af4f56e',3,'Mall Delicias Plaza','2017-01-18','2017-01-18'),(29,'d338000cdbf686c5e1db057467da2daa8af4f56e',3,'Mall Delicias Plaza','2017-01-18','2017-01-18'),(30,'d338000cdbf686c5e1db057467da2daa8af4f56e',3,'Mall Delicias Plaza','2017-01-18','2017-01-18'),(31,'d338000cdbf686c5e1db057467da2daa8af4f56e',3,'Mall Delicias Plaza','2017-01-18','2017-01-18'),(32,'d338000cdbf686c5e1db057467da2daa8af4f56e',3,'Mall Delicias Plaza','2017-01-18','2017-01-18'),(33,'d338000cdbf686c5e1db057467da2daa8af4f56e',3,'Mall Delicias Plaza','2017-01-18','2017-01-18'),(34,'d338000cdbf686c5e1db057467da2daa8af4f56e',3,'Mall Delicias Plaza','2017-01-18','2017-01-18'),(35,'d338000cdbf686c5e1db057467da2daa8af4f56e',3,'Mall Delicias Plaza','2017-01-18','2017-01-18'),(36,'d338000cdbf686c5e1db057467da2daa8af4f56e',3,'Mall Delicias Plaza','2017-01-18','2017-01-18'),(37,'d338000cdbf686c5e1db057467da2daa8af4f56e',3,'Mall Delicias Plaza','2017-01-18','2017-01-18'),(38,'3c50e7027ef8f60f7f1e3e6d90757e6518fc10ba',3,'Mall Delicias Plaza','2017-01-24','2017-01-24'),(39,'3c50e7027ef8f60f7f1e3e6d90757e6518fc10ba',3,'Mall Delicias Plaza','2017-01-24','2017-01-24'),(40,'3c50e7027ef8f60f7f1e3e6d90757e6518fc10ba',3,'Mall Delicias Plaza','2017-01-24','2017-01-24'),(41,'3c50e7027ef8f60f7f1e3e6d90757e6518fc10ba',3,'Mall Delicias Plaza','2017-01-24','2017-01-24'),(42,'3c50e7027ef8f60f7f1e3e6d90757e6518fc10ba',3,'Mall Delicias Plaza','2017-01-24','2017-01-24'),(43,'3c50e7027ef8f60f7f1e3e6d90757e6518fc10ba',3,'Mall Delicias Plaza','2017-01-24','2017-01-24'),(44,'8db8fab60f96c18e8bd60aa881695dcbdabf5403',3,'Mall Delicias Plaza','2017-01-31','2017-01-31'),(45,'8db8fab60f96c18e8bd60aa881695dcbdabf5403',3,'Mall Delicias Plaza','2017-01-31','2017-01-31'),(46,'8db8fab60f96c18e8bd60aa881695dcbdabf5403',3,'Mall Delicias Plaza','2017-01-31','2017-01-31'),(47,'8db8fab60f96c18e8bd60aa881695dcbdabf5403',3,'Mall Delicias Plaza','2017-01-31','2017-01-31'),(48,'8db8fab60f96c18e8bd60aa881695dcbdabf5403',3,'Mall Delicias Plaza','2017-01-31','2017-01-31'),(49,'8db8fab60f96c18e8bd60aa881695dcbdabf5403',3,'Mall Delicias Plaza','2017-01-31','2017-01-31'),(50,'8db8fab60f96c18e8bd60aa881695dcbdabf5403',3,'Mall Delicias Plaza','2017-01-31','2017-01-31'),(51,'8db8fab60f96c18e8bd60aa881695dcbdabf5403',3,'Mall Delicias Plaza','2017-01-31','2017-01-31'),(52,'8db8fab60f96c18e8bd60aa881695dcbdabf5403',3,'Mall Delicias Plaza','2017-01-31','2017-01-31'),(53,'20e2668850a8046e9e6b0392d138580492321d52',3,'Mall Delicias Plaza','2017-02-05','2017-02-05'),(54,'20e2668850a8046e9e6b0392d138580492321d52',3,'Mall Delicias Plaza','2017-02-05','2017-02-05'),(69,'32edaff3724cd2db77d8c81b9e7be90ec4ef2412',3,'Mall Delicias Plaza','2017-02-05','2017-02-05'),(134,'9641eb717c352dd65b96e522bbc51085a75d9c91',3,'Mall Delicias Plaza','2017-02-10','2017-02-10'),(170,'d8c59c862f1d5ede814c9991a54d41537b922cc0',3,'Mall Delicias Plaza','2017-02-10','2017-02-10'),(179,'4749ec9b95f957224b0d2a7e071b4a91f84aff45',3,'Mall Delicias Plaza','2017-02-10','2017-02-10'),(200,'cf7e63be56f6209feae9bae8e474eb253aff849a',3,'Mall Delicias Plaza','2017-02-12','2017-02-12');
/*!40000 ALTER TABLE `sesiones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_gastos`
--

DROP TABLE IF EXISTS `tipo_gastos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_gastos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) DEFAULT NULL,
  `activo` tinyint(4) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_gastos`
--

LOCK TABLES `tipo_gastos` WRITE;
/*!40000 ALTER TABLE `tipo_gastos` DISABLE KEYS */;
INSERT INTO `tipo_gastos` VALUES (1,'Servicios Publicos',1,'2016-12-18','2017-01-13','1'),(2,'Laborales',1,'2016-12-18','2017-01-17','0');
/*!40000 ALTER TABLE `tipo_gastos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ultimos_periodoscerrados`
--

DROP TABLE IF EXISTS `ultimos_periodoscerrados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ultimos_periodoscerrados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_condominio` int(11) DEFAULT NULL,
  `id_periodo` int(11) DEFAULT NULL,
  `periodo` varchar(50) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_final` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ultimos_periodoscerrados`
--

LOCK TABLES `ultimos_periodoscerrados` WRITE;
/*!40000 ALTER TABLE `ultimos_periodoscerrados` DISABLE KEYS */;
INSERT INTO `ultimos_periodoscerrados` VALUES (72,3,4,'Mar-2017','2017-03-01','2017-03-31','2017-02-12','2017-02-12'),(48,4,1,'Dic-2016','2016-12-01','2016-12-31','2017-02-07','2017-02-07'),(71,3,7,'Abr-2017','2017-04-01','2017-04-30','2017-02-12','2017-02-12'),(70,3,8,'May-2017','2017-05-01','2017-05-31','2017-02-12','2017-02-12'),(69,3,9,'Jun-2017','2017-06-01','2017-06-30','2017-02-12','2017-02-12'),(68,3,10,'Jul-2017','2017-07-01','2017-07-31','2017-02-12','2017-02-12'),(67,3,11,'Ago-2017','2017-08-01','2017-08-31','2017-02-12','2017-02-12');
/*!40000 ALTER TABLE `ultimos_periodoscerrados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `login` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `activo` tinyint(4) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `remeber_token` varchar(100) DEFAULT NULL,
  `id_condominio` int(11) DEFAULT NULL,
  `url_condominio` varchar(50) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `tipo` varchar(1) DEFAULT NULL,
  `nombre_condominio` varchar(100) DEFAULT NULL,
  `tipo_licencia` varchar(1) DEFAULT NULL,
  `vencimiento` date DEFAULT NULL,
  `dias_licencia` int(11) DEFAULT NULL,
  `confirmation_code` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES ('Administrador','Administrador','administrador@netus.com.ve','$2y$10$LfftpdDCeIhYgOZoQW55D.fnnxq42te0UxanJimiQEFSqCkFxyRr6','2017-01-04','2017-01-24',1,1,NULL,NULL,NULL,'GWgdF0pogjtBWmItgUvmS43GduEyInt8FIHTt16GfgLHDIMvgeFLybrV8cU4','1',NULL,'1','2017-01-24',NULL,NULL),('vallealto','Condominio Valle Alto','condovallealto@hotmail.com','$2y$10$FjYqRqddFnUxCUX.mrqL5eUh9yR0H51mxL1Up1YUsPAvJX2TXdYAy','2017-01-04','2017-01-24',1,2,NULL,1,NULL,'4HkpbOT6WKYNiLyTGH57H2gQaZE5dupftQeh1ORe8utE7c4KrJSdE8sCKjDV','2','Urb Valle Alto','2','2017-01-24',NULL,NULL),('malldelicias','Mall Delicias Plaza','ccmall@gmail.com','$2y$10$wbctX0m3hz1RxHSap.nTLeCWCilj4DH3OcGdOsnKPZo0d0eeAsJpu','2017-01-04','2017-02-13',0,3,NULL,3,NULL,'hToLP6sRyhWSGYNCs0dvjKjLkTcpuZxrPiaJ37TKa7VyXxsom4LiX9uRu9EG','2','Mall Delicias Plaza','2',NULL,NULL,''),('sadas','dad','asd@gmail.com','$2y$10$5A8MTRhGyxMx9LUnfTAbtOZ6J8aF3VggG8H.JfEAFnzchj18.bbQa','2017-01-24','2017-01-24',1,39,NULL,NULL,NULL,NULL,'2',NULL,'1','0000-00-00',NULL,'OqI3rJhwDlANzofRWQKUc17BjsC5p9xn6SbdPTvM2gH0ukVXtL'),('fdfdsf','fdsfsd','dsdf@gmail.com','$2y$10$WGpF.eyJhRfg3x38FDG9JOp.gWVtYv9bafx5RJEfEn3qG6wXnH.Im','2017-01-24','2017-01-24',1,38,NULL,NULL,NULL,NULL,'2',NULL,'1','0000-00-00',NULL,'X6sQ4rliuap9A32hDnLOdSICP1t7x8fbVyM5KqJFRgzZHew0WN');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `usuarios_w`
--

DROP TABLE IF EXISTS `usuarios_w`;
/*!50001 DROP VIEW IF EXISTS `usuarios_w`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `usuarios_w` AS SELECT 
 1 AS `login`,
 1 AS `name`,
 1 AS `email`,
 1 AS `password`,
 1 AS `created_at`,
 1 AS `updated_at`,
 1 AS `activo`,
 1 AS `id`,
 1 AS `remeber_token`,
 1 AS `id_condominio`,
 1 AS `url_condominio`,
 1 AS `remember_token`,
 1 AS `tipo`,
 1 AS `nombre_condominio`,
 1 AS `tipo_licencia`,
 1 AS `vencimiento`,
 1 AS `dias_licencia`,
 1 AS `confirmation_code`*/;
SET character_set_client = @saved_cs_client;

--
-- Current Database: `condosoft`
--

USE `condosoft`;

--
-- Final view structure for view `cuotas_inmuebles_cob_w`
--

/*!50001 DROP VIEW IF EXISTS `cuotas_inmuebles_cob_w`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = latin1 */;
/*!50001 SET character_set_results     = latin1 */;
/*!50001 SET collation_connection      = latin1_swedish_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `cuotas_inmuebles_cob_w` AS select `cuotas_inmuebles`.`id` AS `id`,`cuotas_inmuebles`.`id_condominio` AS `id_condominio`,`cuotas_inmuebles`.`aaaa` AS `aaaa`,`cuotas_inmuebles`.`mes` AS `mes`,`cuotas_inmuebles`.`id_inmueble` AS `id_inmueble`,`cuotas_inmuebles`.`ocupante` AS `ocupante`,`cuotas_inmuebles`.`monto` AS `monto`,`cuotas_inmuebles`.`fecha_doc` AS `fecha_doc`,`cuotas_inmuebles`.`extra` AS `extra`,`cuotas_inmuebles`.`tipo` AS `tipo`,`cuotas_inmuebles`.`created_at` AS `created_at`,`cuotas_inmuebles`.`updated_at` AS `updated_at`,`c`.`id` AS `id_periodo`,`cuotas_inmuebles`.`forma_pago` AS `forma_pago`,`inmuebles`.`identificador` AS `inmueble`,`c`.`periodo` AS `periodo`,(case when (`cuotas_inmuebles`.`id_periodo` = 0) then 'Anticipo' else `d`.`periodo` end) AS `periodo_cobrado` from (((`cuotas_inmuebles` join `inmuebles` on((`inmuebles`.`id` = `cuotas_inmuebles`.`id_inmueble`))) left join `periodos_w` `c` on(((`c`.`fecha_inicio` <= `cuotas_inmuebles`.`fecha_doc`) and (`c`.`fecha_final` >= `cuotas_inmuebles`.`fecha_doc`)))) left join `periodos_w` `d` on((`cuotas_inmuebles`.`id_periodo` = `d`.`id`))) where (`cuotas_inmuebles`.`monto` <= 0) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `cuotas_inmuebles_temp_w`
--

/*!50001 DROP VIEW IF EXISTS `cuotas_inmuebles_temp_w`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = latin1 */;
/*!50001 SET character_set_results     = latin1 */;
/*!50001 SET collation_connection      = latin1_swedish_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `cuotas_inmuebles_temp_w` AS select `a`.`id_condominio` AS `id_condominio`,`a`.`aaaa` AS `aaaa`,`a`.`mes` AS `mes`,(case when (`a`.`id_periodo` = 0) then 'Anticipo' else concat(`F_Mes`(`a`.`mes`),'-',cast(`a`.`aaaa` as char charset latin1)) end) AS `periodo`,`a`.`id_periodo` AS `id_periodo`,concat(`b`.`identificador`,' - ',`a`.`ocupante`) AS `eti_inmueble`,(`a`.`monto` * -(1)) AS `monto`,`a`.`id` AS `id`,`d`.`descripcion` AS `forma_cobro` from ((`cuotas_inmuebles_temp` `a` join `formas_pago` `d` on(((`d`.`id` = `a`.`forma_pago`) and (`d`.`id_condominio` = `a`.`id_condominio`)))) join `inmuebles` `b` on(((`b`.`id` = `a`.`id_inmueble`) and (`b`.`id_condominio` = `a`.`id_condominio`)))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `cuotas_ordinarias_gen_w`
--

/*!50001 DROP VIEW IF EXISTS `cuotas_ordinarias_gen_w`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = latin1 */;
/*!50001 SET character_set_results     = latin1 */;
/*!50001 SET collation_connection      = latin1_swedish_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `cuotas_ordinarias_gen_w` AS select `cuotas_inmuebles`.`id` AS `id`,`cuotas_inmuebles`.`id_condominio` AS `id_condominio`,`cuotas_inmuebles`.`aaaa` AS `aaaa`,`cuotas_inmuebles`.`mes` AS `mes`,`cuotas_inmuebles`.`id_inmueble` AS `id_inmueble`,`cuotas_inmuebles`.`ocupante` AS `ocupante`,`cuotas_inmuebles`.`monto` AS `monto`,`cuotas_inmuebles`.`fecha_doc` AS `fecha_doc`,`cuotas_inmuebles`.`extra` AS `extra`,`cuotas_inmuebles`.`tipo` AS `tipo`,`cuotas_inmuebles`.`created_at` AS `created_at`,`cuotas_inmuebles`.`updated_at` AS `updated_at`,`cuotas_inmuebles`.`id_periodo` AS `id_periodo`,`cuotas_inmuebles`.`forma_pago` AS `forma_pago`,`inmuebles`.`identificador` AS `inmueble`,concat(`F_Mes`(`cuotas_inmuebles`.`mes`),'-',cast(`cuotas_inmuebles`.`aaaa` as char(4) charset latin1)) AS `periodo` from (`cuotas_inmuebles` join `inmuebles` on((`inmuebles`.`id` = `cuotas_inmuebles`.`id_inmueble`))) where ((`cuotas_inmuebles`.`monto` >= 0) and (`cuotas_inmuebles`.`extra` = 0)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `cuotas_ordinarias_w`
--

/*!50001 DROP VIEW IF EXISTS `cuotas_ordinarias_w`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = latin1 */;
/*!50001 SET character_set_results     = latin1 */;
/*!50001 SET collation_connection      = latin1_swedish_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `cuotas_ordinarias_w` AS select `a`.`id` AS `id`,`a`.`aaaa` AS `aaaa`,`a`.`mes` AS `mes`,`b`.`id` AS `id_condominio`,concat(`F_Mes`(`a`.`mes`),'-',cast(`a`.`aaaa` as char(4) charset latin1)) AS `periodo`,cast(concat(cast(`a`.`aaaa` as char charset latin1),lpad(`a`.`mes`,2,'0'),'01') as date) AS `fecha_inicio`,last_day(cast(concat(cast(`a`.`aaaa` as char charset latin1),lpad(`a`.`mes`,2,'0'),'01') as date)) AS `fecha_final`,(last_day(cast(concat(cast(`a`.`aaaa` as char charset latin1),lpad(`a`.`mes`,2,'0'),'01') as date)) + interval 1 day) AS `inicio_sigperiodo` from (`cuotas_ordinarias` `a` join `condominios` `b`) where ((not(`a`.`id` in (select `c`.`id_periodo` from `cuotas_inmuebles` `c` where ((`c`.`id_condominio` = `b`.`id`) and (`c`.`extra` = 0))))) and (cast(concat(cast(`a`.`aaaa` as char charset latin1),lpad(`a`.`mes`,2,'0'),'01') as date) >= (select `d`.`fecha_inicio` from `periodos_w` `d` where (`d`.`id` = (select `x`.`periodo_inicial` from `condominios` `x` where (`x`.`id` = `b`.`id`)))))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `gastos_mov_w`
--

/*!50001 DROP VIEW IF EXISTS `gastos_mov_w`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = latin1 */;
/*!50001 SET character_set_results     = latin1 */;
/*!50001 SET collation_connection      = latin1_swedish_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `gastos_mov_w` AS select `a`.`id` AS `id`,`a`.`id_condominio` AS `id_condominio`,`a`.`id_gasto` AS `id_gasto`,`a`.`des_gasto` AS `des_gasto`,`a`.`documento` AS `documento`,`a`.`fecha_doc` AS `fecha_doc`,`a`.`id_proveedor` AS `id_proveedor`,`a`.`des_proveedor` AS `des_proveedor`,`a`.`monto` AS `monto`,`a`.`observaciones` AS `observaciones`,`a`.`id_formapago` AS `id_formapago`,`a`.`des_formapago` AS `des_formapago`,`a`.`created_at` AS `created_at`,`a`.`updated_at` AS `updated_at`,`a`.`fecha_proceso` AS `fecha_proceso`,`b`.`id` AS `id_periodo` from (`gastos_mov` `a` left join `periodos_w` `b` on(((`b`.`fecha_inicio` <= `a`.`fecha_proceso`) and (`b`.`fecha_final` >= `a`.`fecha_proceso`)))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `periodos_cerrados_w`
--

/*!50001 DROP VIEW IF EXISTS `periodos_cerrados_w`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = latin1 */;
/*!50001 SET character_set_results     = latin1 */;
/*!50001 SET collation_connection      = latin1_swedish_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `periodos_cerrados_w` AS select `periodos_cerrados`.`id` AS `id`,`periodos_cerrados`.`id_periodo` AS `id_periodo`,`periodos_cerrados`.`id_condominio` AS `id_condominio`,`periodos_cerrados`.`aaaa` AS `aaaa`,`periodos_cerrados`.`mes` AS `mes`,`periodos_cerrados`.`fecha_inicio` AS `fecha_inicio`,`periodos_cerrados`.`fecha_final` AS `fecha_final`,`periodos_cerrados`.`created_at` AS `created_at`,`periodos_cerrados`.`updated_at` AS `updated_at`,concat(`F_Mes`(`periodos_cerrados`.`mes`),'-',cast(`periodos_cerrados`.`aaaa` as char(4) charset latin1)) AS `periodo` from `periodos_cerrados` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `periodos_iniciales_w`
--

/*!50001 DROP VIEW IF EXISTS `periodos_iniciales_w`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = latin1 */;
/*!50001 SET character_set_results     = latin1 */;
/*!50001 SET collation_connection      = latin1_swedish_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `periodos_iniciales_w` AS select `a`.`id` AS `id_condominio`,`c`.`id` AS `id_periodo`,`c`.`periodo` AS `periodo`,`c`.`aaaa` AS `aaaa`,`c`.`mes` AS `mes`,`c`.`fecha_inicio` AS `fecha_inicio`,`c`.`fecha_final` AS `fecha_final` from ((`condominios` `a` left join `periodos_w` `b` on((`b`.`id` = `a`.`periodo_inicial`))) left join `periodos_w` `c` on((`c`.`fecha_final` = (`b`.`fecha_inicio` - interval 1 day)))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `periodos_w`
--

/*!50001 DROP VIEW IF EXISTS `periodos_w`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = latin1 */;
/*!50001 SET character_set_results     = latin1 */;
/*!50001 SET collation_connection      = latin1_swedish_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `periodos_w` AS select `a`.`id` AS `id`,`a`.`aaaa` AS `aaaa`,`a`.`mes` AS `mes`,cast(concat(cast(`a`.`aaaa` as char charset latin1),lpad(`a`.`mes`,2,'0'),'01') as date) AS `fecha_inicio`,last_day(cast(concat(cast(`a`.`aaaa` as char charset latin1),lpad(`a`.`mes`,2,'0'),'01') as date)) AS `fecha_final`,concat(`F_Mes`(`a`.`mes`),'-',cast(`a`.`aaaa` as char(4) charset latin1)) AS `periodo` from `cuotas_ordinarias` `a` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `periodos_x_cerrar_w`
--

/*!50001 DROP VIEW IF EXISTS `periodos_x_cerrar_w`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = latin1 */;
/*!50001 SET character_set_results     = latin1 */;
/*!50001 SET collation_connection      = latin1_swedish_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `periodos_x_cerrar_w` AS select `a`.`id` AS `id`,`b`.`id` AS `id_condominio`,`a`.`aaaa` AS `aaaa`,`a`.`mes` AS `mes`,cast(concat(cast(`a`.`aaaa` as char charset latin1),lpad(`a`.`mes`,2,'0'),'01') as date) AS `fecha_inicio`,last_day(cast(concat(cast(`a`.`aaaa` as char charset latin1),lpad(`a`.`mes`,2,'0'),'01') as date)) AS `fecha_final`,concat(`F_Mes`(`a`.`mes`),'-',cast(`a`.`aaaa` as char(4) charset latin1)) AS `periodo` from ((`cuotas_ordinarias` `a` join `condominios` `b`) left join `periodos_cerrados` `c` on(((`c`.`id_periodo` = `a`.`id`) and (`c`.`id_condominio` = `b`.`id`)))) where (isnull(`c`.`id`) and (cast(concat(cast(`a`.`aaaa` as char charset latin1),lpad(`a`.`mes`,2,'0'),'01') as date) >= (select `z`.`fecha_inicio` from `periodos_w` `z` where (`z`.`id` = (select `x`.`periodo_inicial` from `condominios` `x` where (`x`.`id` = `b`.`id`)))))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `saldos_cuotas_inmuebles_w`
--

/*!50001 DROP VIEW IF EXISTS `saldos_cuotas_inmuebles_w`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = latin1 */;
/*!50001 SET character_set_results     = latin1 */;
/*!50001 SET collation_connection      = latin1_swedish_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `saldos_cuotas_inmuebles_w` AS select `a`.`id_condominio` AS `id_condominio`,`a`.`id_inmueble` AS `id_inmueble`,`a`.`aaaa` AS `aaaa`,`a`.`mes` AS `mes`,`a`.`id_periodo` AS `id_periodo`,(ifnull(sum(`a`.`monto`),0) + ifnull(sum(`b`.`monto`),0)) AS `monto`,concat((case when (`a`.`extra` = 1) then 'Extra - ' else '' end),`F_Mes`(`a`.`mes`),'-',cast(`a`.`aaaa` as char(4) charset latin1),' (',cast((ifnull(sum(`a`.`monto`),0) + ifnull(sum(`b`.`monto`),0)) as char charset latin1),')') AS `eti_periodo`,`a`.`extra` AS `extra`,`x`.`periodo` AS `periodo`,`x`.`fecha_final` AS `fecha_final` from ((`cuotas_inmuebles` `a` left join `cuotas_inmuebles_temp` `b` on(((`a`.`id_condominio` = `b`.`id_condominio`) and (`a`.`id_inmueble` = `b`.`id_inmueble`) and (`a`.`aaaa` = `b`.`aaaa`) and (`a`.`mes` = `b`.`mes`) and (`a`.`id_periodo` = `b`.`id_periodo`) and (`a`.`extra` = `b`.`extra`)))) join `periodos_w` `x` on((`x`.`id` = `a`.`id_periodo`))) group by `a`.`id_condominio`,`a`.`id_inmueble`,`a`.`aaaa`,`a`.`mes`,`a`.`id_periodo`,`a`.`extra`,`x`.`periodo`,`x`.`fecha_final` having ((ifnull(sum(`a`.`monto`),0) + ifnull(sum(`b`.`monto`),0)) > 0) union select `a`.`id_condominio` AS `id_condominio`,`a`.`id` AS `id_inmueble`,`c`.`aaaa` AS `aaaa`,`c`.`mes` AS `mes`,`c`.`id_periodo` AS `id_periodo`,(ifnull(`a`.`saldo_inicial`,0) + (ifnull(sum(`d`.`monto`),0) + ifnull(sum(`e`.`monto`),0))) AS `monto`,concat('Saldo Inicial ',`c`.`periodo`,' (',cast((ifnull(`a`.`saldo_inicial`,0) + (ifnull(sum(`d`.`monto`),0) + ifnull(sum(`e`.`monto`),0))) as char charset latin1),')') AS `eti_periodo`,0 AS `extra`,`c`.`periodo` AS `periodo`,`c`.`fecha_final` AS `fecha_final` from (((`inmuebles` `a` join `periodos_iniciales_w` `c` on((`c`.`id_condominio` = `a`.`id_condominio`))) left join `cuotas_inmuebles` `d` on(((`d`.`id_condominio` = `a`.`id_condominio`) and (`d`.`id_inmueble` = `a`.`id`) and (`d`.`id_periodo` = `c`.`id_periodo`)))) left join `cuotas_inmuebles_temp` `e` on(((`e`.`id_condominio` = `a`.`id_condominio`) and (`e`.`id_inmueble` = `a`.`id`) and (`e`.`id_periodo` = `c`.`id_periodo`)))) group by `a`.`id_condominio`,`a`.`id`,`c`.`aaaa`,`c`.`mes`,`c`.`periodo`,`c`.`id_periodo`,`c`.`periodo`,`c`.`fecha_final` having (((ifnull(sum(`a`.`saldo_inicial`),0) + ifnull(sum(`d`.`monto`),0)) + ifnull(sum(`e`.`monto`),0)) > 0) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `saldos_iniciales_w`
--

/*!50001 DROP VIEW IF EXISTS `saldos_iniciales_w`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = latin1 */;
/*!50001 SET character_set_results     = latin1 */;
/*!50001 SET collation_connection      = latin1_swedish_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `saldos_iniciales_w` AS select `a`.`id_condominio` AS `id_condominio`,`a`.`id` AS `id_inmueble`,`c`.`aaaa` AS `aaaa`,`c`.`mes` AS `mes`,`c`.`id_periodo` AS `id_periodo`,ifnull(`a`.`saldo_inicial`,0) AS `saldo_inicial`,(ifnull(`a`.`saldo_inicial`,0) + (ifnull(sum(`d`.`monto`),0) + ifnull(sum(`e`.`monto`),0))) AS `monto`,concat('Saldo Inicial ',`c`.`periodo`,' (',cast((ifnull(`a`.`saldo_inicial`,0) + (ifnull(sum(`d`.`monto`),0) + ifnull(sum(`e`.`monto`),0))) as char charset latin1),')') AS `eti_periodo`,0 AS `extra`,`c`.`periodo` AS `periodo`,`c`.`fecha_final` AS `fecha_final` from (((`inmuebles` `a` join `periodos_iniciales_w` `c` on((`c`.`id_condominio` = `a`.`id_condominio`))) left join `cuotas_inmuebles` `d` on(((`d`.`id_condominio` = `a`.`id_condominio`) and (`d`.`id_inmueble` = `a`.`id`) and (`d`.`id_periodo` = `c`.`id_periodo`)))) left join `cuotas_inmuebles_temp` `e` on(((`e`.`id_condominio` = `a`.`id_condominio`) and (`e`.`id_inmueble` = `a`.`id`) and (`e`.`id_periodo` = `c`.`id_periodo`)))) group by `a`.`id_condominio`,`a`.`id`,`c`.`aaaa`,`c`.`mes`,`c`.`periodo`,`c`.`id_periodo`,`c`.`periodo`,`c`.`fecha_final` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `usuarios_w`
--

/*!50001 DROP VIEW IF EXISTS `usuarios_w`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = latin1 */;
/*!50001 SET character_set_results     = latin1 */;
/*!50001 SET collation_connection      = latin1_swedish_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `usuarios_w` AS select `usuarios`.`login` AS `login`,`usuarios`.`name` AS `name`,`usuarios`.`email` AS `email`,`usuarios`.`password` AS `password`,`usuarios`.`created_at` AS `created_at`,`usuarios`.`updated_at` AS `updated_at`,`usuarios`.`activo` AS `activo`,`usuarios`.`id` AS `id`,`usuarios`.`remeber_token` AS `remeber_token`,`usuarios`.`id_condominio` AS `id_condominio`,`usuarios`.`url_condominio` AS `url_condominio`,`usuarios`.`remember_token` AS `remember_token`,`usuarios`.`tipo` AS `tipo`,`usuarios`.`nombre_condominio` AS `nombre_condominio`,`usuarios`.`tipo_licencia` AS `tipo_licencia`,`usuarios`.`vencimiento` AS `vencimiento`,timestampdiff(DAY,curdate(),`usuarios`.`vencimiento`) AS `dias_licencia`,`usuarios`.`confirmation_code` AS `confirmation_code` from `usuarios` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-02-13 18:21:00
