-- MySQL dump 10.16  Distrib 10.1.34-MariaDB, for Win32 (AMD64)
--
-- Host: 127.0.0.1    Database: sena
-- ------------------------------------------------------
-- Server version	10.1.34-MariaDB

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
-- Table structure for table `cargosempresa`
--

DROP TABLE IF EXISTS `cargosempresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cargosempresa` (
  `IdCargoEmpresa` int(11) NOT NULL AUTO_INCREMENT,
  `NombreCargo` varchar(500) NOT NULL,
  `RutaImagen` varchar(500) DEFAULT NULL,
  `DescripcionCorta` varchar(500) DEFAULT NULL,
  `Estado` int(11) NOT NULL DEFAULT '1',
  `IdEmpresa` int(11) NOT NULL,
  PRIMARY KEY (`IdCargoEmpresa`),
  KEY `fk_CargosEmpresa_Empresas1_idx` (`IdEmpresa`),
  CONSTRAINT `fk_CargosEmpresa_Empresas1` FOREIGN KEY (`IdEmpresa`) REFERENCES `empresas` (`IdEmpresa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cargosempresa`
--

LOCK TABLES `cargosempresa` WRITE;
/*!40000 ALTER TABLE `cargosempresa` DISABLE KEYS */;
INSERT INTO `cargosempresa` VALUES (1,'Desarrollador Junior',NULL,'Programa y encuentra soluciones a la hora de programar aplicaciones.',1,1),(2,'Tecnico soldadura',NULL,'Posee técnicas en soldadura y busca soluciones de acuerdo a la necesidad',1,3),(3,'Diseñador grafico',NULL,'Maneja Adobe Ilustrator y Photoshop, ademas crea diseños con dreamviewer',1,2),(4,'Contador Publico',NULL,'Maneja toda la contabilidad financiera de las empresas',1,5),(5,'Asesor de ventas',NULL,'Se encarga de la venta y asesoramiento de los productos de la empresa.',1,4);
/*!40000 ALTER TABLE `cargosempresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoriacursoscortos`
--

DROP TABLE IF EXISTS `categoriacursoscortos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoriacursoscortos` (
  `IdCategoriaCursoCorto` int(11) NOT NULL AUTO_INCREMENT,
  `NombreCursoCorto` varchar(500) NOT NULL,
  `Estado` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`IdCategoriaCursoCorto`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoriacursoscortos`
--

LOCK TABLES `categoriacursoscortos` WRITE;
/*!40000 ALTER TABLE `categoriacursoscortos` DISABLE KEYS */;
INSERT INTO `categoriacursoscortos` VALUES (1,'Desarrollo de software',1),(2,'Ingles',1),(3,'Contabilidad y finanzas',1),(4,'Servicio al cliente',1),(5,'Metalmecanica',1),(6,'Diseño gráfico',1);
/*!40000 ALTER TABLE `categoriacursoscortos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoriasempresa`
--

DROP TABLE IF EXISTS `categoriasempresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoriasempresa` (
  `IdCategoriaEmpresa` int(11) NOT NULL,
  `NombreCategoriaEmpresa` varchar(500) NOT NULL,
  `Estado` int(11) NOT NULL DEFAULT '1',
  `RutaIcono` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`IdCategoriaEmpresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoriasempresa`
--

LOCK TABLES `categoriasempresa` WRITE;
/*!40000 ALTER TABLE `categoriasempresa` DISABLE KEYS */;
INSERT INTO `categoriasempresa` VALUES (1,'Desarrollo Software',1,NULL),(2,'CallCenter',1,NULL),(3,'Finanzas',1,NULL),(4,'Super Mercado',1,NULL),(5,'Metalmecanica',1,NULL);
/*!40000 ALTER TABLE `categoriasempresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ciudades`
--

DROP TABLE IF EXISTS `ciudades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ciudades` (
  `IdCiudad` int(11) NOT NULL AUTO_INCREMENT,
  `NombreCiudad` varchar(500) NOT NULL,
  `Estado` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`IdCiudad`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ciudades`
--

LOCK TABLES `ciudades` WRITE;
/*!40000 ALTER TABLE `ciudades` DISABLE KEYS */;
INSERT INTO `ciudades` VALUES (1,'Barranquilla',1),(2,'Santa Marta',1),(3,'Cartagena',1),(4,'Medellin',1),(5,'Bogota',1);
/*!40000 ALTER TABLE `ciudades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cursoscortocargo`
--

DROP TABLE IF EXISTS `cursoscortocargo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cursoscortocargo` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `IdCursoCorto` int(11) NOT NULL,
  `IdCargoEmpresa` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_CursosCortosSena_has_CargosEmpresa_CargosEmpresa1_idx` (`IdCargoEmpresa`),
  KEY `fk_CursosCortosSena_has_CargosEmpresa_CursosCortosSena1_idx` (`IdCursoCorto`),
  CONSTRAINT `fk_CursosCortosSena_has_CargosEmpresa_CargosEmpresa1` FOREIGN KEY (`IdCargoEmpresa`) REFERENCES `cargosempresa` (`IdCargoEmpresa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_CursosCortosSena_has_CargosEmpresa_CursosCortosSena1` FOREIGN KEY (`IdCursoCorto`) REFERENCES `cursoscortossena` (`IdCursoCortoSena`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cursoscortocargo`
--

LOCK TABLES `cursoscortocargo` WRITE;
/*!40000 ALTER TABLE `cursoscortocargo` DISABLE KEYS */;
INSERT INTO `cursoscortocargo` VALUES (6,1,1),(7,2,1),(8,3,5),(9,4,4),(10,5,2),(11,6,3);
/*!40000 ALTER TABLE `cursoscortocargo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cursoscortossena`
--

DROP TABLE IF EXISTS `cursoscortossena`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cursoscortossena` (
  `IdCursoCortoSena` int(11) NOT NULL AUTO_INCREMENT,
  `NombreCursoCorto` varchar(500) NOT NULL,
  `DescripcionCorta` varchar(500) DEFAULT NULL,
  `RutaImagen` varchar(500) DEFAULT NULL,
  `Estado` int(11) NOT NULL DEFAULT '1',
  `NoHoras` int(11) DEFAULT NULL,
  `Categoria` int(11) NOT NULL,
  PRIMARY KEY (`IdCursoCortoSena`),
  KEY `fk_CursosCortosSena_CategoriaCursosCortos1_idx` (`Categoria`),
  CONSTRAINT `fk_CursosCortosSena_CategoriaCursosCortos1` FOREIGN KEY (`Categoria`) REFERENCES `categoriacursoscortos` (`IdCategoriaCursoCorto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cursoscortossena`
--

LOCK TABLES `cursoscortossena` WRITE;
/*!40000 ALTER TABLE `cursoscortossena` DISABLE KEYS */;
INSERT INTO `cursoscortossena` VALUES (1,'Desarrollo con Node.js','Aprende desde lo básico hasta a realizar aplicaciones profesiones con Node.js',NULL,1,20,1),(2,'Fundamentos Javascript','Aprende a realizar páginas dinámicas con animaciones con este curso',NULL,1,48,1),(3,'Cómo vender mejor','Aprende todo lo necesario para vender y seducir a tus clientes',NULL,1,5,4),(4,'Finanzas internacionales','Con este curso aprenderás todo lo necesario para aumentar tus finanzas',NULL,1,10,3),(5,'Seguridad en soldadura','Con este curso aprenderás a soldar de manera profesional con las últimas técnicas y todas las normas de seguridad actuales',NULL,1,24,5),(6,'Adobe Ilustrator y photoshop','Aprende a manejar Adobe Ilustrator y Photoshop de manera profesional',NULL,1,60,6);
/*!40000 ALTER TABLE `cursoscortossena` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresas`
--

DROP TABLE IF EXISTS `empresas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empresas` (
  `IdEmpresa` int(11) NOT NULL AUTO_INCREMENT,
  `NombreEmpresa` varchar(500) NOT NULL,
  `RutaImagen` varchar(500) DEFAULT NULL,
  `DescripcionCorta` varchar(500) DEFAULT NULL,
  `IdCiudad` int(11) NOT NULL,
  `IdCategoria` int(11) NOT NULL,
  `Estado` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`IdEmpresa`),
  KEY `fk_Empresas_Ciudades_idx` (`IdCiudad`),
  KEY `fk_Empresas_CategoriasEmpresa1_idx` (`IdCategoria`),
  CONSTRAINT `fk_Empresas_CategoriasEmpresa1` FOREIGN KEY (`IdCategoria`) REFERENCES `categoriasempresa` (`IdCategoriaEmpresa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Empresas_Ciudades` FOREIGN KEY (`IdCiudad`) REFERENCES `ciudades` (`IdCiudad`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresas`
--

LOCK TABLES `empresas` WRITE;
/*!40000 ALTER TABLE `empresas` DISABLE KEYS */;
INSERT INTO `empresas` VALUES (1,'Fundacion IDI',NULL,NULL,1,1,1),(2,'SAO',NULL,NULL,1,4,1),(3,'ASESCO',NULL,NULL,1,5,1),(4,'Exito',NULL,NULL,4,4,1),(5,'Banco Bogota',NULL,NULL,5,3,1);
/*!40000 ALTER TABLE `empresas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hojarutacursoscortousuario`
--

DROP TABLE IF EXISTS `hojarutacursoscortousuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hojarutacursoscortousuario` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `Usuarios_IdUsuario` int(11) NOT NULL,
  `CursosCortosSena_IdCursoCortoSena` int(11) NOT NULL,
  `FechaRegistro` datetime NOT NULL,
  `EstadoFinalizado` int(11) NOT NULL,
  `RutaCertificado` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Usuarios_has_CursosCortosSena_CursosCortosSena1_idx` (`CursosCortosSena_IdCursoCortoSena`),
  KEY `fk_Usuarios_has_CursosCortosSena_Usuarios1_idx` (`Usuarios_IdUsuario`),
  CONSTRAINT `fk_Usuarios_has_CursosCortosSena_CursosCortosSena1` FOREIGN KEY (`CursosCortosSena_IdCursoCortoSena`) REFERENCES `cursoscortossena` (`IdCursoCortoSena`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuarios_has_CursosCortosSena_Usuarios1` FOREIGN KEY (`Usuarios_IdUsuario`) REFERENCES `usuarios` (`IdUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hojarutacursoscortousuario`
--

LOCK TABLES `hojarutacursoscortousuario` WRITE;
/*!40000 ALTER TABLE `hojarutacursoscortousuario` DISABLE KEYS */;
INSERT INTO `hojarutacursoscortousuario` VALUES (4,2,5,'2018-06-18 10:15:33',1,NULL),(5,3,2,'2018-08-30 21:15:55',1,NULL),(6,4,4,'2018-06-25 19:55:30',1,NULL),(7,6,3,'2017-10-05 01:15:20',1,NULL),(11,1,1,'2018-08-30 21:15:55',0,NULL),(14,1,4,'2018-11-02 06:55:11',0,NULL);
/*!40000 ALTER TABLE `hojarutacursoscortousuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `listadeseoscargousuario`
--

DROP TABLE IF EXISTS `listadeseoscargousuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `listadeseoscargousuario` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `IdUsuario` int(11) NOT NULL,
  `IdCargoEmpresa` int(11) NOT NULL,
  `FechaHoraRegistro` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Usuarios_has_CargosEmpresa_CargosEmpresa1_idx` (`IdCargoEmpresa`),
  KEY `fk_Usuarios_has_CargosEmpresa_Usuarios1_idx` (`IdUsuario`),
  CONSTRAINT `fk_Usuarios_has_CargosEmpresa_CargosEmpresa1` FOREIGN KEY (`IdCargoEmpresa`) REFERENCES `cargosempresa` (`IdCargoEmpresa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuarios_has_CargosEmpresa_Usuarios1` FOREIGN KEY (`IdUsuario`) REFERENCES `usuarios` (`IdUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `listadeseoscargousuario`
--

LOCK TABLES `listadeseoscargousuario` WRITE;
/*!40000 ALTER TABLE `listadeseoscargousuario` DISABLE KEYS */;
INSERT INTO `listadeseoscargousuario` VALUES (1,1,1,'2017-09-02 23:55:11'),(2,1,3,'2017-09-02 23:55:11'),(3,2,2,'2017-12-30 05:16:22'),(4,3,1,'2018-07-03 09:11:55'),(5,4,4,'2018-05-05 15:33:11'),(6,6,5,'2017-09-02 23:55:11');
/*!40000 ALTER TABLE `listadeseoscargousuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `IdUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `NombreCompleto` varchar(500) NOT NULL,
  `Correo` varchar(500) NOT NULL,
  `Identificacion` int(11) NOT NULL,
  `Clave` varchar(500) NOT NULL,
  `Estado` int(11) NOT NULL DEFAULT '1',
  `FechaHoraRegistro` datetime NOT NULL,
  `FechaHoraUltimoIngreso` datetime DEFAULT NULL,
  `Celular` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`IdUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Rafael Luckert','rluckert1@cuc.edu.co',1103166295,'rafael1998',1,'2017-01-09 11:05:10','2018-10-04 20:15:10','3007836737'),(2,'Kevin De Alba','kdealba@hotmail.com',1103590126,'1515aaa',1,'2016-12-12 10:10:02','2017-09-05 16:15:10','3004374545'),(3,'Daniel Vergara','danielvsuarez01@gmail.com',1103118284,'senapass',1,'2016-12-06 09:12:55','2018-10-20 06:25:20','3004371636'),(4,'Robinson De La Cruz','rdelacru10@cuc.edu.co',110358545,'holamundo',1,'2017-02-20 19:12:10','2018-10-20 09:10:20','3057777852'),(5,'Laura Rodriguez','lauri27@yahoo.com',120251551,'laumejorok',1,'2018-09-30 19:12:10','2018-10-01 09:10:20','305252852'),(6,'Ana Brochero','bochero10@gmail.com',130125810,'5555688',1,'2016-01-28 19:12:10','2018-09-01 09:10:20','300255252');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-11-02  1:27:31
