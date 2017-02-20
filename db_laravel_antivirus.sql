CREATE DATABASE  IF NOT EXISTS `db_laravel_antivirus` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_laravel_antivirus`;
-- MySQL dump 10.13  Distrib 5.6.13, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: db_laravel_antivirus
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
-- Table structure for table `tbl_antivirus_pc`
--

DROP TABLE IF EXISTS `tbl_antivirus_pc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_antivirus_pc` (
  `apc_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `apc_serial_antiv` varchar(36) NOT NULL,
  `apc_serial_pc` varchar(36) NOT NULL,
  `apc_data_registo` date NOT NULL,
  `apc_validade` int(11) NOT NULL,
  `apc_data_vencimento` date DEFAULT NULL,
  `apc_marca_antiv` int(11) NOT NULL,
  `apc_responsavel_registo` int(11) NOT NULL,
  `apc_data_registo_no_sistema` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `apc_ultima_actualizacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`apc_codigo`),
  KEY `FK_SERIAL_PC_idx` (`apc_serial_pc`),
  KEY `FK_MARCA_ANTIV_idx` (`apc_marca_antiv`),
  KEY `FK_RESPONSAVEL_REGISTO_idx` (`apc_responsavel_registo`),
  CONSTRAINT `FK-SERIAL_PC` FOREIGN KEY (`apc_serial_pc`) REFERENCES `tbl_usuario_computador` (`uc_serial`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_MARCA_ANTIV` FOREIGN KEY (`apc_marca_antiv`) REFERENCES `tbl_marca_antiv` (`mar_ant_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_RESPONSAVEL_REGISTO` FOREIGN KEY (`apc_responsavel_registo`) REFERENCES `tbl_usuario_sistema` (`us_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_antivirus_pc`
--

LOCK TABLES `tbl_antivirus_pc` WRITE;
/*!40000 ALTER TABLE `tbl_antivirus_pc` DISABLE KEYS */;
INSERT INTO `tbl_antivirus_pc` VALUES (29,'AAAAA-BBBBB-CCCCC-DDDDD-EEEEE','DERT45DN8Y','2016-01-21',365,'2017-01-20',6,18,'2017-02-19 15:46:57','2017-02-19 15:46:57'),(30,'VVVVV-TTTTT-AAAAA-GGGGG-XXXXX','EWQ65GTRO9','2016-03-19',365,'2017-03-19',6,18,'2017-02-19 15:48:36','2017-02-19 15:48:36'),(31,'KKKK-LLLLLL-HHHHH-BBBBB-DDDDD','H35PG89JHQE','2016-04-21',365,'2017-04-21',6,18,'2017-02-19 15:49:37','2017-02-19 15:49:37'),(32,'CCCCC-OOOO-PPPPP-RRRRR-DDDDD','VFT89KJ56F','2017-02-19',365,'2018-02-19',6,17,'2017-02-19 15:51:10','2017-02-19 15:51:10'),(33,'XDFCV-OUYH6-97HNF-FDT6G-563HN','EWQ65GTRO9','2017-02-19',365,'2018-02-19',6,17,'2017-02-19 15:54:17','2017-02-19 15:54:17'),(34,'XXD3L-OJG7B-95YT3-OKB43-JGYN5','VFT89KJ56F','2016-10-19',365,'2017-10-19',8,17,'2017-02-19 15:54:17','2017-02-19 15:54:17');
/*!40000 ALTER TABLE `tbl_antivirus_pc` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `tr_insere_data_vencimento` BEFORE INSERT ON `tbl_antivirus_pc`
 FOR EACH ROW BEGIN
	SET NEW.apc_data_vencimento = DATE_ADD(NEW.apc_data_registo, INTERVAL NEW.apc_validade DAY);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `tr_actualiza_data_vencimento` BEFORE UPDATE ON `tbl_antivirus_pc`
 FOR EACH ROW BEGIN
	SET NEW.apc_data_vencimento = DATE_ADD(NEW.apc_data_registo, INTERVAL NEW.apc_validade DAY);

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `tbl_cargo`
--

DROP TABLE IF EXISTS `tbl_cargo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_cargo` (
  `carg_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `carg_nome` varchar(70) NOT NULL,
  PRIMARY KEY (`carg_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_cargo`
--

LOCK TABLES `tbl_cargo` WRITE;
/*!40000 ALTER TABLE `tbl_cargo` DISABLE KEYS */;
INSERT INTO `tbl_cargo` VALUES (5,'Director'),(6,'Chefe do DES');
/*!40000 ALTER TABLE `tbl_cargo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_dias_remanescentes`
--

DROP TABLE IF EXISTS `tbl_dias_remanescentes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_dias_remanescentes` (
  `dr_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `dr_nome` int(25) NOT NULL,
  PRIMARY KEY (`dr_codigo`),
  UNIQUE KEY `dr_codigo_UNIQUE` (`dr_codigo`)
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_dias_remanescentes`
--

LOCK TABLES `tbl_dias_remanescentes` WRITE;
/*!40000 ALTER TABLE `tbl_dias_remanescentes` DISABLE KEYS */;
INSERT INTO `tbl_dias_remanescentes` VALUES (57,30),(54,60),(56,90);
/*!40000 ALTER TABLE `tbl_dias_remanescentes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_marca_antiv`
--

DROP TABLE IF EXISTS `tbl_marca_antiv`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_marca_antiv` (
  `mar_ant_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `mar_ant_nome` varchar(60) NOT NULL,
  PRIMARY KEY (`mar_ant_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_marca_antiv`
--

LOCK TABLES `tbl_marca_antiv` WRITE;
/*!40000 ALTER TABLE `tbl_marca_antiv` DISABLE KEYS */;
INSERT INTO `tbl_marca_antiv` VALUES (6,'Kaspersky'),(8,'Norton');
/*!40000 ALTER TABLE `tbl_marca_antiv` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_tipo_usuario`
--

DROP TABLE IF EXISTS `tbl_tipo_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_tipo_usuario` (
  `tpu_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `tpu_nome` varchar(50) NOT NULL,
  PRIMARY KEY (`tpu_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tipo_usuario`
--

LOCK TABLES `tbl_tipo_usuario` WRITE;
/*!40000 ALTER TABLE `tbl_tipo_usuario` DISABLE KEYS */;
INSERT INTO `tbl_tipo_usuario` VALUES (4,'Usuario Comum'),(5,'Administrador');
/*!40000 ALTER TABLE `tbl_tipo_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_usuario_computador`
--

DROP TABLE IF EXISTS `tbl_usuario_computador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_usuario_computador` (
  `uc_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `uc_serial` varchar(36) NOT NULL,
  `uc_nome` varchar(50) DEFAULT NULL,
  `uc_apelido` varchar(50) DEFAULT NULL,
  `uc_data_registo` date NOT NULL,
  PRIMARY KEY (`uc_codigo`),
  KEY `uc_serial` (`uc_serial`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_usuario_computador`
--

LOCK TABLES `tbl_usuario_computador` WRITE;
/*!40000 ALTER TABLE `tbl_usuario_computador` DISABLE KEYS */;
INSERT INTO `tbl_usuario_computador` VALUES (35,'H35PG89JHQE','Osorio Cassiano','Malache','2017-02-13'),(36,'EWQ65GTRO9','Cazanca','Mapi','2016-12-20'),(37,'DERT45DN8Y','Salme','Lucas','2016-12-22'),(38,'VFT89KJ56F','Reley','Guta','2016-12-22');
/*!40000 ALTER TABLE `tbl_usuario_computador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_usuario_sistema`
--

DROP TABLE IF EXISTS `tbl_usuario_sistema`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_usuario_sistema` (
  `us_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `us_apelido` varchar(45) DEFAULT NULL,
  `us_cargo` int(11) DEFAULT NULL,
  `us_tipo` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`us_codigo`),
  KEY `FK_CARGO_idx` (`us_cargo`),
  KEY `FK_TIPO_USUARIO_idx` (`us_tipo`),
  CONSTRAINT `FK_CARGO` FOREIGN KEY (`us_cargo`) REFERENCES `tbl_cargo` (`carg_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_TIPO_USUARIO` FOREIGN KEY (`us_tipo`) REFERENCES `tbl_tipo_usuario` (`tpu_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_usuario_sistema`
--

LOCK TABLES `tbl_usuario_sistema` WRITE;
/*!40000 ALTER TABLE `tbl_usuario_sistema` DISABLE KEYS */;
INSERT INTO `tbl_usuario_sistema` VALUES (17,'Osorio Cassiano','Malache',5,5,'osoriocassiano@gmail.com','admin','$2y$10$DWiLhjKfFq.SKdElzYKKguDakOYvvk28HUm.QbQrzTE.QR77kkfGC','GwD22inTNYyuFrO0I4lfKJdxdY91B19FMVaOu2LWncp1td4XFILaICi2J1AH'),(18,'Carla da Izilda','Faduco',6,4,'carlafaduco@gmail.com','carlafaduco','$2y$10$f6RH3kqQU.u4ckiDj/Txxe/1c3eckRyWn37xrQ1.EhfpegD9Wdr0W','bG3YFXFTZB4R4igkpysyzkKaKKgimKRRCUrx8DK7IscN492wkX6bgTpPcEsd');
/*!40000 ALTER TABLE `tbl_usuario_sistema` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-02-19 23:20:31
