-- MySQL dump 10.13  Distrib 5.6.12, for osx10.7 (x86_64)
--
-- Host: localhost    Database: zf2int_base
-- ------------------------------------------------------
-- Server version	5.6.12

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
-- Table structure for table `acploacl_privileges`
--

DROP TABLE IF EXISTS `acploacl_privileges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acploacl_privileges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `resource_id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_acploacl_privileges_acploacl_roles1` (`role_id`),
  KEY `fk_acploacl_privileges_acploacl_resources1` (`resource_id`),
  CONSTRAINT `fk_acploacl_privileges_acploacl_resources1` FOREIGN KEY (`resource_id`) REFERENCES `acploacl_resources` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_acploacl_privileges_acploacl_roles1` FOREIGN KEY (`role_id`) REFERENCES `acploacl_roles` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acploacl_privileges`
--

LOCK TABLES `acploacl_privileges` WRITE;
/*!40000 ALTER TABLE `acploacl_privileges` DISABLE KEYS */;
INSERT INTO `acploacl_privileges` VALUES (1,1,1,'Visualizar','2013-07-09 23:32:43','2013-07-09 23:32:43'),(2,3,1,'Novo / Editar','2013-07-09 23:32:43','2013-07-09 23:32:43'),(3,4,1,'Excluir','2013-07-09 23:32:43','2013-07-09 23:32:43');
/*!40000 ALTER TABLE `acploacl_privileges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acploacl_resources`
--

DROP TABLE IF EXISTS `acploacl_resources`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acploacl_resources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acploacl_resources`
--

LOCK TABLES `acploacl_resources` WRITE;
/*!40000 ALTER TABLE `acploacl_resources` DISABLE KEYS */;
INSERT INTO `acploacl_resources` VALUES (1,'Posts','2013-07-09 23:32:43','2013-07-09 23:32:43'),(2,'PÃ¡ginas','2013-07-09 23:32:43','2013-07-09 23:32:43');
/*!40000 ALTER TABLE `acploacl_resources` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acploacl_roles`
--

DROP TABLE IF EXISTS `acploacl_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acploacl_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `nome` varchar(45) NOT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_acploacl_roles_acploacl_roles` (`parent_id`),
  CONSTRAINT `fk_acploacl_roles_acploacl_roles` FOREIGN KEY (`parent_id`) REFERENCES `acploacl_roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acploacl_roles`
--

LOCK TABLES `acploacl_roles` WRITE;
/*!40000 ALTER TABLE `acploacl_roles` DISABLE KEYS */;
INSERT INTO `acploacl_roles` VALUES (1,NULL,'Visitante',NULL,'2013-07-09 23:32:43','2013-07-09 23:32:43'),(2,1,'Registrado',NULL,'2013-07-09 23:32:43','2013-07-09 23:32:43'),(3,2,'Redator',NULL,'2013-07-09 23:32:43','2013-07-09 23:32:43'),(4,NULL,'Admin',1,'2013-07-09 23:32:43','2013-07-09 23:32:43');
/*!40000 ALTER TABLE `acploacl_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acplouser_users`
--

DROP TABLE IF EXISTS `acplouser_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acplouser_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `activation_key` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acplouser_users`
--

LOCK TABLES `acplouser_users` WRITE;
/*!40000 ALTER TABLE `acplouser_users` DISABLE KEYS */;
INSERT INTO `acplouser_users` VALUES (1,'Wesley','wesley.teste@schoolofnet.com','nKfBB7Hr','4Bv+d6hrdf8=',1,'74dfc521068bc252377895e1134ad296','2013-07-09 23:34:46','2013-07-09 23:34:45'),(2,'Admin','admin.teste@schoolofnet.com','sr5ARqzs','GSgEYwNtIhA=',1,'472eb460ea7cbfa3b9b144798db4fc37','2013-07-09 23:34:46','2013-07-09 23:34:46');
/*!40000 ALTER TABLE `acplouser_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-01-02 19:05:55
