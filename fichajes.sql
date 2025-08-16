-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: fichajes
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresas`
--

DROP TABLE IF EXISTS `empresas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `empresas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `razon_social` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cif` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ccc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activa` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `empresas_razon_social_unique` (`razon_social`),
  UNIQUE KEY `empresas_cif_unique` (`cif`),
  UNIQUE KEY `empresas_user_id_unique` (`user_id`),
  CONSTRAINT `empresas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresas`
--

LOCK TABLES `empresas` WRITE;
/*!40000 ALTER TABLE `empresas` DISABLE KEYS */;
INSERT INTO `empresas` VALUES (1,'Russel, Koelpin and Metz','Y5432543Y','626 Sammy Expressway','21281891165',1,1,'2025-07-21 09:56:11','2025-07-29 06:18:28'),(2,'Hackett LLC','C6988393','9244 Sauer Plaza Apt. 754','46582315088',1,2,'2025-07-21 09:56:11','2025-08-06 16:29:51'),(3,'Hand, Stanton and Hane','P7832625','2914 Gaylord Glens','12538924754',0,3,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(4,'Gorczany-Kihn','G3216876','361 Quitzon Well','16008432039',0,4,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(5,'Klein-Leannon','K8817923','7806 Turcotte Lakes','29152120523',0,5,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(6,'Fay-Schowalter','X3542892','643 Walter Mission Suite 909','61660595609',0,6,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(7,'Kling-Marquardt','S6970047','52826 Kohler Squares Apt. 896','79917836838',0,7,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(8,'Ondricka, King and Gulgowski','T1518944','925 Bahringer Roads Apt. 234','48207216414',0,8,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(9,'Moore-Emmerich','H6053112','79594 Reichert Street Apt. 699','02501546521',0,9,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(10,'Rohan Inc','M7517985','764 Kaylie Walks','94333193718',0,10,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(11,'Beahan and Sons','C2797247','221 Jackson Summit','87972167765',0,11,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(12,'Thompson, Feil and Zieme','Q8575209','923 Dicki Flat Apt. 852','01678948131',0,12,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(13,'Jaskolski, Mayert and Abernathy','G1695054','1122 Danial Junction Apt. 751','47869976772',0,13,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(14,'O\'Reilly Ltd','X2271914','1307 West Viaduct Apt. 694','07145188871',0,14,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(15,'Goldner-Cummings','Q1041586','99596 Grimes Crescent','51524698917',0,15,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(16,'Rippin-Gerlach','L4443130','56090 Emmerich Circle Apt. 816','69160541736',0,16,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(17,'Mraz Ltd','X4710212','8730 Willa Fort Apt. 646','91831862832',0,17,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(18,'Heaney-Waelchi','C2338508','10526 Metz Fort Apt. 865','48090918628',0,18,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(19,'Marquardt-Hoeger','I4683891','4917 Bechtelar Square','40111463770',0,19,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(20,'Ruecker and Sons','L4569881','3952 Loraine Roads Suite 899','04607303631',0,20,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(21,'Hermann-Marks','V7083225','97339 Jarvis Canyon Apt. 872','18929685104',0,21,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(22,'Rogahn Ltd','Z0757185','518 Greenfelder Mountain Suite 804','54981555551',0,22,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(23,'Waelchi, Jakubowski and Collier','U3442598','9132 Auer Crossroad','17291200770',0,23,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(24,'Wolff, Sporer and Monahan','M2675956','281 Annamae Springs','30689176574',0,24,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(25,'Zieme-Ebert','D3056855','7966 Kayley Mountains','67302476934',0,25,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(26,'Wiza-Heller','C9755843','375 Amina Cliffs Suite 943','15258983889',0,26,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(27,'Schinner-McClure','I2627890','8419 Pfannerstill Neck','05466311963',0,27,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(28,'Kunde, Schmitt and Kertzmann','P2635846','7265 Leffler Overpass','54268231338',0,28,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(29,'Jacobs-Schaefer','R0482628','7339 Richmond Harbors','34179477775',0,29,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(30,'Schiller PLC','D5680037','730 Johns Roads Apt. 647','45234017257',0,30,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(31,'Williamson, Bashirian and Stokes','I8401766','65210 Hoeger Corner','46943663042',0,31,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(32,'Toy-Davis','D2567790','734 Marvin Drives Apt. 229','26314347288',0,32,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(33,'Murray Inc','G0321011','37801 Mallie Squares','54104017603',0,33,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(34,'Miller Ltd','W2159489','508 Ben Overpass','74491277081',0,34,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(35,'McDermott and Sons','F5269099','8613 Connelly Grove Suite 597','03126698403',0,35,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(36,'Block, Waters and Harvey','F1418084','153 Tracy Drives Suite 497','76460759336',0,36,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(37,'Boyer, Koss and Kub','I5371168','94109 Ezekiel Island Apt. 836','04027943973',0,37,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(38,'Schowalter, Kuhlman and Metz','S5480091','679 Deckow Inlet','99446775206',0,38,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(39,'Skiles, Mitchell and Keebler','M9191132','30502 Karson Heights','97537837280',0,39,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(40,'Wolff PLC','U2560231','97509 Rubye Forest Suite 346','14780368634',0,40,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(41,'Watsica PLC','S8957977','82055 Carroll Spurs Apt. 249','83437845237',0,41,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(42,'Hegmann Inc','K1254629','90431 Henri Streets Suite 714','71047553680',0,42,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(43,'Gislason Group','S0330207','3338 Mona Stravenue','76843966650',0,43,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(44,'Reinger, Steuber and McLaughlin','Y9821559','57728 Cristian Corners Apt. 978','86085354903',0,44,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(45,'Reilly-Doyle','J5176890','4182 Alan Locks','89390957042',0,45,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(46,'Toy Inc','D7099943','1623 Alessandro Circle Suite 014','17698190211',0,46,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(47,'Mraz LLC','A9126068','420 Barrows Junction Suite 569','87830762486',0,47,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(48,'Rempel Ltd','T9860878','39771 Vince Green','67903425653',0,48,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(49,'Halvorson-Lind','X3591047','3815 Carter Camp','41330657746',0,49,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(50,'Sawayn LLC','Q3308420','88653 Jast Forges Apt. 599','59119072982',0,50,'2025-07-21 09:56:11','2025-07-21 09:56:11'),(51,'Ferran Enterprises S.L.','F12341211','Calle Tirant lo Blanch 4','12073795218',1,52,'2025-07-21 09:57:52','2025-07-21 09:57:52'),(52,'Jaume Enterprises S.L.','J12341234','Calle Tirant lo Blanch 4','12341234124',1,62,'2025-07-22 08:14:23','2025-07-22 08:14:23'),(53,'Manolo S.L.','M12341233','Calle Mijares 7','12344312123',1,78,'2025-07-29 06:20:35','2025-07-29 06:20:35');
/*!40000 ALTER TABLE `empresas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fichajes`
--

DROP TABLE IF EXISTS `fichajes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fichajes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `trabajador_id` bigint unsigned NOT NULL,
  `empresa_id` bigint unsigned NOT NULL,
  `fecha` date NOT NULL,
  `hora_entrada` timestamp NULL DEFAULT NULL,
  `hora_salida` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fichajes_trabajador_id_foreign` (`trabajador_id`),
  KEY `fichajes_empresa_id_fecha_index` (`empresa_id`,`fecha`),
  KEY `fichajes_fecha_index` (`fecha`),
  CONSTRAINT `fichajes_empresa_id_foreign` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fichajes_trabajador_id_foreign` FOREIGN KEY (`trabajador_id`) REFERENCES `trabajadores` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fichajes`
--

LOCK TABLES `fichajes` WRITE;
/*!40000 ALTER TABLE `fichajes` DISABLE KEYS */;
INSERT INTO `fichajes` VALUES (7,35,51,'2011-07-25','2011-07-25 06:34:00','2011-07-25 12:34:00','2025-07-24 12:54:06','2025-07-24 12:54:06'),(8,35,51,'2023-06-03','2023-06-03 07:19:00','2023-06-03 14:38:00','2025-07-24 12:54:06','2025-07-24 12:54:06'),(9,35,51,'1980-06-17','1980-06-17 04:51:00','1980-06-17 13:19:00','2025-07-24 12:54:06','2025-07-24 12:54:06'),(10,35,51,'1973-06-20','1973-06-20 08:36:00','1973-06-20 17:46:00','2025-07-24 12:54:06','2025-07-24 12:54:06'),(11,35,51,'1984-04-18','1984-04-18 04:14:00','1984-04-18 14:43:00','2025-07-24 13:11:25','2025-07-24 13:11:25'),(20,35,51,'2025-07-27','2025-07-27 09:48:25','2025-07-27 09:48:31','2025-07-27 09:48:25','2025-07-27 09:48:31'),(21,35,51,'2025-07-27','2025-07-27 11:53:35','2025-07-27 11:55:13','2025-07-27 11:53:35','2025-07-27 11:55:13'),(22,35,51,'2025-07-27','2025-07-27 11:55:21','2025-07-27 12:01:36','2025-07-27 11:55:21','2025-07-27 12:01:36'),(23,35,51,'2025-07-27','2025-07-27 12:06:02','2025-07-27 12:14:06','2025-07-27 12:06:02','2025-07-27 12:14:06'),(24,35,51,'2025-07-27','2025-07-27 12:20:17','2025-07-27 12:20:25','2025-07-27 12:20:17','2025-07-27 12:20:25'),(25,35,51,'2025-07-27','2025-07-27 12:23:36','2025-07-27 12:23:52','2025-07-27 12:23:36','2025-07-27 12:23:52'),(26,21,52,'2025-07-27','2025-07-27 12:28:22','2025-07-27 12:28:48','2025-07-27 12:28:22','2025-07-27 12:28:48'),(27,21,52,'2025-07-27','2025-07-27 12:28:57','2025-07-27 12:29:18','2025-07-27 12:28:57','2025-07-27 12:29:18'),(28,35,51,'2025-07-28','2025-07-28 05:54:20','2025-07-28 05:54:35','2025-07-28 05:54:20','2025-07-28 05:54:35'),(29,35,51,'2025-07-28','2025-07-28 05:54:56','2025-07-28 05:57:50','2025-07-28 05:54:56','2025-07-28 05:57:50'),(30,35,51,'2025-07-29','2025-07-29 06:26:00','2025-07-29 06:26:42','2025-07-29 06:26:00','2025-07-29 06:26:42'),(31,35,51,'2025-08-01','2025-08-01 13:02:40','2025-08-01 13:02:56','2025-08-01 13:02:40','2025-08-01 13:02:56'),(32,35,51,'2025-08-01','2025-08-01 13:12:30','2025-08-01 13:12:36','2025-08-01 13:12:30','2025-08-01 13:12:36'),(33,35,51,'2025-08-01','2025-08-01 13:12:49','2025-08-01 13:13:06','2025-08-01 13:12:49','2025-08-01 13:13:06'),(34,35,51,'2025-08-01','2025-08-01 13:14:47','2025-08-01 13:16:39','2025-08-01 13:14:47','2025-08-01 13:16:39'),(35,35,51,'2025-08-06','2025-08-06 11:32:19','2025-08-06 11:32:27','2025-08-06 11:32:19','2025-08-06 11:32:27'),(36,35,51,'2025-08-06','2025-08-06 16:45:14','2025-08-06 16:45:38','2025-08-06 16:45:14','2025-08-06 16:45:38'),(37,35,51,'2025-08-07','2025-08-07 10:15:08','2025-08-07 10:15:16','2025-08-07 10:15:08','2025-08-07 10:15:16'),(38,37,51,'2025-08-07','2025-08-07 17:34:25','2025-08-07 17:38:01','2025-08-07 17:34:25','2025-08-07 17:38:01'),(39,35,51,'2025-08-05','2025-08-05 18:38:00','2025-08-05 18:39:00','2025-08-09 16:03:14','2025-08-09 16:03:14'),(40,35,51,'2025-08-09','2025-08-09 06:00:00','2025-08-09 14:00:00','2025-08-09 16:05:33','2025-08-09 16:08:34'),(41,21,52,'2025-08-09','2025-08-09 06:00:00','2025-08-09 14:00:00','2025-08-09 16:10:59','2025-08-09 17:17:36'),(42,21,52,'2025-08-08','2025-08-08 12:11:00','2025-08-08 14:12:00','2025-08-09 17:16:42','2025-08-09 17:16:42');
/*!40000 ALTER TABLE `fichajes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `incidencias`
--

DROP TABLE IF EXISTS `incidencias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `incidencias` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `trabajador_id` bigint unsigned NOT NULL,
  `empresa_id` bigint unsigned NOT NULL,
  `fichaje_id` bigint unsigned DEFAULT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtipo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_inicio` datetime DEFAULT NULL,
  `fecha_fin` datetime DEFAULT NULL,
  `observacion` text COLLATE utf8mb4_unicode_ci,
  `estado` enum('pendiente','aprobada','rechazada') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pendiente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `incidencias_trabajador_id_foreign` (`trabajador_id`),
  KEY `incidencias_empresa_id_foreign` (`empresa_id`),
  KEY `incidencias_fichaje_id_foreign` (`fichaje_id`),
  CONSTRAINT `incidencias_empresa_id_foreign` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `incidencias_fichaje_id_foreign` FOREIGN KEY (`fichaje_id`) REFERENCES `fichajes` (`id`) ON DELETE SET NULL,
  CONSTRAINT `incidencias_trabajador_id_foreign` FOREIGN KEY (`trabajador_id`) REFERENCES `trabajadores` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `incidencias`
--

LOCK TABLES `incidencias` WRITE;
/*!40000 ALTER TABLE `incidencias` DISABLE KEYS */;
INSERT INTO `incidencias` VALUES (1,35,51,NULL,'fichaje','fichaje_olvidado','2025-08-05 20:38:00','2025-08-05 20:39:00',NULL,'aprobada','2025-08-05 18:38:40','2025-08-09 16:03:14'),(2,35,51,31,'fichaje','correccion_fichaje','2025-08-01 20:53:00','2025-08-05 20:53:00','asdf','aprobada','2025-08-05 18:53:52','2025-08-09 16:00:38'),(3,35,51,35,'fichaje','correccion_fichaje','2025-08-06 13:32:00','2025-08-06 18:32:00','Me he equivocado','aprobada','2025-08-06 11:32:48','2025-08-09 16:05:16'),(4,35,51,NULL,'fichaje','fichaje_olvidado','2025-08-07 17:02:00','2025-08-07 17:04:00','hola','pendiente','2025-08-06 15:02:52','2025-08-06 15:02:52'),(5,35,51,35,'fichaje','correccion_fichaje','2025-08-06 17:04:00','2025-08-06 20:03:00','correcion fichaje','aprobada','2025-08-06 15:03:20','2025-08-09 15:59:35'),(6,35,51,NULL,'ausencia','paternidad_maternidad','2025-08-11 08:00:00','2026-02-09 17:04:00','Soy padre','pendiente','2025-08-06 15:04:48','2025-08-06 15:04:48'),(7,35,51,NULL,'fichaje','fichaje_olvidado','2025-07-31 06:31:00','2025-07-31 18:30:00','Probando banner','aprobada','2025-08-06 16:23:07','2025-08-09 15:54:01'),(8,35,51,NULL,'fichaje','fichaje_olvidado','2025-08-06 09:30:00','2025-08-06 17:30:00','Probando incidencia','pendiente','2025-08-06 16:23:46','2025-08-06 16:23:46'),(9,35,51,NULL,'vacaciones',NULL,'2025-08-06 00:00:00','2025-08-08 00:00:00','Probando vacaciones','pendiente','2025-08-06 16:24:56','2025-08-06 16:24:56'),(10,35,51,NULL,'ausencia','cita_medica','2025-08-10 12:20:00','2025-08-10 15:20:00','Tengo médico','aprobada','2025-08-09 10:20:13','2025-08-09 16:05:00'),(11,35,51,NULL,'fichaje','fichaje_olvidado','2025-08-09 16:54:00','2025-08-11 16:54:00','Hola','pendiente','2025-08-09 14:54:51','2025-08-09 14:54:51'),(12,35,51,40,'fichaje','correccion_fichaje','2025-08-09 08:00:00','2025-08-09 16:00:00','He fichado mal disculpa las molestias jefe.','aprobada','2025-08-09 16:06:38','2025-08-09 16:08:34'),(13,21,52,NULL,'fichaje','fichaje_olvidado','2025-08-08 14:11:00','2025-08-08 16:12:00','asdf','aprobada','2025-08-09 16:12:15','2025-08-09 17:16:42'),(14,21,52,41,'fichaje','correccion_fichaje','2025-08-09 08:00:00','2025-08-09 16:00:00',NULL,'aprobada','2025-08-09 17:14:49','2025-08-09 17:17:36');
/*!40000 ALTER TABLE `incidencias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_06_30_142948_create_empresas_table',1),(5,'2025_06_30_143016_create_trabajadores_table',1),(6,'2025_07_21_151046_add_deleted_at_to_users_table',2),(7,'2025_07_22_152043_create_fichajes_table',3),(8,'2025_07_24_144710_add_pausa_inicio_and_pausa_fin_to_fichajes_table',4),(9,'2025_07_27_115017_create_pausas_table',5),(10,'2025_07_27_134244_create_pausas_table',6),(11,'2025_08_04_134331_create_incidencias_table',7);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pausas`
--

DROP TABLE IF EXISTS `pausas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pausas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `fichaje_id` bigint unsigned NOT NULL,
  `inicio` timestamp NOT NULL,
  `fin` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pausas_fichaje_id_foreign` (`fichaje_id`),
  CONSTRAINT `pausas_fichaje_id_foreign` FOREIGN KEY (`fichaje_id`) REFERENCES `fichajes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pausas`
--

LOCK TABLES `pausas` WRITE;
/*!40000 ALTER TABLE `pausas` DISABLE KEYS */;
INSERT INTO `pausas` VALUES (1,21,'2025-07-27 11:53:43','2025-07-27 11:53:50','2025-07-27 11:53:43','2025-07-27 11:53:50'),(2,21,'2025-07-27 11:55:00','2025-07-27 11:55:06','2025-07-27 11:55:00','2025-07-27 11:55:06'),(3,22,'2025-07-27 11:55:28','2025-07-27 11:55:34','2025-07-27 11:55:28','2025-07-27 11:55:34'),(4,23,'2025-07-27 12:06:11','2025-07-27 12:07:03','2025-07-27 12:06:11','2025-07-27 12:07:03'),(5,23,'2025-07-27 12:08:15','2025-07-27 12:09:38','2025-07-27 12:08:15','2025-07-27 12:09:38'),(6,23,'2025-07-27 12:09:52','2025-07-27 12:10:02','2025-07-27 12:09:52','2025-07-27 12:10:02'),(7,25,'2025-07-27 12:23:43','2025-07-27 12:23:49','2025-07-27 12:23:43','2025-07-27 12:23:49'),(8,26,'2025-07-27 12:28:31','2025-07-27 12:28:39','2025-07-27 12:28:31','2025-07-27 12:28:39'),(9,27,'2025-07-27 12:29:00','2025-07-27 12:29:03','2025-07-27 12:29:00','2025-07-27 12:29:03'),(10,27,'2025-07-27 12:29:05','2025-07-27 12:29:09','2025-07-27 12:29:05','2025-07-27 12:29:09'),(11,27,'2025-07-27 12:29:12','2025-07-27 12:29:15','2025-07-27 12:29:12','2025-07-27 12:29:15'),(12,29,'2025-07-28 05:57:37','2025-07-28 05:57:40','2025-07-28 05:57:37','2025-07-28 05:57:40'),(13,30,'2025-07-29 06:26:20','2025-07-29 06:26:31','2025-07-29 06:26:20','2025-07-29 06:26:31'),(14,31,'2025-08-01 13:02:49','2025-08-01 13:02:53','2025-08-01 13:02:49','2025-08-01 13:02:53'),(15,32,'2025-08-01 13:12:33','2025-08-01 13:12:34','2025-08-01 13:12:33','2025-08-01 13:12:34'),(16,33,'2025-08-01 13:13:03','2025-08-01 13:13:04','2025-08-01 13:13:03','2025-08-01 13:13:04'),(17,34,'2025-08-01 13:16:27','2025-08-01 13:16:32','2025-08-01 13:16:27','2025-08-01 13:16:32'),(18,35,'2025-08-06 11:32:23','2025-08-06 11:32:24','2025-08-06 11:32:23','2025-08-06 11:32:24'),(19,36,'2025-08-06 16:45:19','2025-08-06 16:45:22','2025-08-06 16:45:19','2025-08-06 16:45:22'),(20,36,'2025-08-06 16:45:31','2025-08-06 16:45:34','2025-08-06 16:45:31','2025-08-06 16:45:34'),(21,37,'2025-08-07 10:15:12','2025-08-07 10:15:14','2025-08-07 10:15:12','2025-08-07 10:15:14'),(22,38,'2025-08-07 17:36:42','2025-08-07 17:36:43','2025-08-07 17:36:42','2025-08-07 17:36:43'),(23,38,'2025-08-07 17:36:44','2025-08-07 17:37:56','2025-08-07 17:36:44','2025-08-07 17:37:56'),(24,40,'2025-08-09 16:05:38','2025-08-09 16:05:42','2025-08-09 16:05:38','2025-08-09 16:05:42'),(25,41,'2025-08-09 16:11:03','2025-08-09 16:11:04','2025-08-09 16:11:03','2025-08-09 16:11:04');
/*!40000 ALTER TABLE `pausas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('hR2Ptm5EvvNKEGZozFb5YD5dI25auTFR1TwWgjhi',63,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZUFtSGVuRm44Rld0NEx2clNEeGtaUnNSNERyczUwZTM1dmszdFVweSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly9maWNoYWplcy50ZXN0L3Byb2ZpbGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo2Mzt9',1755257878),('lym0FJ1qRR6qGn4Ent72ZQ1sFAdRoW52ap9Xjw59',52,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNEIyd09kcGNROHNUTk5MWGoybmRRRlhDTUxxMVlhbHBSS2VscThFTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9maWNoYWplcy50ZXN0L2VtcHJlc2EvZmljaGFqZXMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo1Mjt9',1755256170),('SFrQy6vGuYDz3lxDQrseGFaHVAoJ9DsgYTldji01',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUFowSDdFNTVqU2E1T1I5bkszRVVzUnNVVTM5UFNqWGJnVUZaUzZFayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly9maWNoYWplcy50ZXN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1755255930),('TlgGcTXnVGOB2FrL1wz1Xv6UdRlTunLlQGvSBgxm',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMnBRZzlNU0xLaGVvM3ZIb0V5OEx0blZ2SWllSFZzMDkyMUpsa0s1dCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyODoiaHR0cDovL2ZpY2hhamVzLnRlc3QvcHJvZmlsZSI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI2OiJodHRwOi8vZmljaGFqZXMudGVzdC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1755290078);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trabajadores`
--

DROP TABLE IF EXISTS `trabajadores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trabajadores` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `empresa_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `horas` int DEFAULT NULL,
  `nif` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `trabajadores_email_unique` (`email`),
  UNIQUE KEY `unique_empresa_nif` (`empresa_id`,`nif`),
  KEY `trabajadores_user_id_foreign` (`user_id`),
  CONSTRAINT `trabajadores_empresa_id_foreign` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `trabajadores_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trabajadores`
--

LOCK TABLES `trabajadores` WRITE;
/*!40000 ALTER TABLE `trabajadores` DISABLE KEYS */;
INSERT INTO `trabajadores` VALUES (12,51,54,'Jaume Moraleda','jaume@microvalencia.com',20,'23838224J','$2y$12$fEyfSyrfMSe8yjOlRKCZ2OxLFwwFLPh9tVXM6Ff/a.AbBTcvXZcZm','2025-07-21 10:03:38','2025-07-22 08:07:20','2025-07-22 08:07:20'),(13,51,NULL,'Vidal Pfannerstill Jr.','herbert44@example.org',40,'74758411S','1234','2025-07-21 10:06:01','2025-07-21 10:06:01',NULL),(14,1,55,'Diana Howe','hkub@example.net',40,'39126628J','$2y$12$YVbUa1QUZZDCN1GiQBme..TqiCiYngGguJPuB9qZ7qy/ZV.467zKW','2025-07-21 10:08:44','2025-07-21 10:08:44',NULL),(15,1,56,'Freddie Macejkovic','abshire.ashtyn@example.org',40,'66735735Q','$2y$12$6vs6eGWRcZF.Z9Z/RK9N6OpQERDfKK5.lx6Y/GiQ4NICsHkEyMGP.','2025-07-21 10:09:02','2025-07-21 10:09:02',NULL),(16,1,57,'Orland Murphy II','istokes@example.org',40,'43244139R','1234','2025-07-21 10:09:08','2025-07-21 10:09:08',NULL),(20,51,61,'Ferran Moraleda','ferry@gmail.com',20,'23938224F','1234','2025-07-22 08:06:59','2025-07-22 09:33:16','2025-07-22 09:33:16'),(21,52,63,'Lucía Sánchez Melego','lucia@jaume.com',20,'22334455L','1234','2025-07-22 08:15:09','2025-07-22 08:15:09',NULL),(24,51,66,'Joan Moraleda Martínez','joan@microvalencia.com',20,'12341234F','1234','2025-07-22 08:24:55','2025-07-22 08:25:08','2025-07-22 08:25:08'),(25,52,67,'Joan Moraleda Martínez','joan@jaumeempresa.com',20,'12341234F','1234','2025-07-22 08:25:38','2025-07-22 08:25:56','2025-07-22 08:25:56'),(35,51,77,'Ferran Moraleda Mulío','ferran@ferranenterprise.com',20,'23938224M','1234','2025-07-22 09:35:53','2025-07-22 09:35:53',NULL),(36,53,79,'Ferran Moraleda','empleado@manolo.com',20,'23874544M','1234','2025-07-29 06:22:44','2025-07-29 06:23:07','2025-07-29 06:23:07'),(37,51,80,'Lourdes Mulio Fliquete','lourdes@ferranenterprise.com',40,'44556677L','1234','2025-08-07 17:34:06','2025-08-07 17:34:06',NULL),(38,51,81,'Inma','inma@ferranenterprise.com',20,'32567847I','1234','2025-08-15 11:09:05','2025-08-15 11:09:05',NULL);
/*!40000 ALTER TABLE `trabajadores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perfil` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'trabajador',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Miss Katelynn McGlynn','carmine.prohaska@example.net','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','Pyty2jBXpi','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(2,'Dr. Deonte Rempel','nbogisich@example.com','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','Rcalr2c0yP','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(3,'Rowland Hickle PhD','ellsworth.okeefe@example.net','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','0SzSJ04lag','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(4,'Mr. Armani Willms','gottlieb.enoch@example.net','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','gktsbssL85','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(5,'Leo King','sandra.dare@example.org','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','VZK5N2sgqE','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(6,'Timmy Aufderhar','stephanie12@example.com','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','hu99txgMWG','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(7,'Hyman Rodriguez','lfay@example.org','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','hrEwOzCa2F','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(8,'Prof. Herman Adams','vdietrich@example.net','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','LXM3xVxSUR','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(9,'Dr. Chelsey Brakus II','kali.wiegand@example.com','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','BUBbnDuAkS','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(10,'Mr. Jalon Hermiston','cremin.letitia@example.net','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','eb7iAZqXAk','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(11,'Ottis Spencer','paucek.cloyd@example.org','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','eiH88qmGW1','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(12,'Leonora Hartmann Jr.','rosetta.terry@example.net','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','HgA8xH0SkL','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(13,'Audrey Lehner','hodkiewicz.regan@example.com','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','COgpWyKICH','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(14,'Mrs. Skyla Rau','darrel.olson@example.org','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','fk6uWoFngh','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(15,'Dr. Allen Deckow DDS','kokuneva@example.com','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','cHUIHMl8Yc','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(16,'Lina Hintz','benedict.hudson@example.net','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','pOqCROal2R','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(17,'Prof. Steve Eichmann','anolan@example.com','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','4C0QbU3gVn','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(18,'Lora Heidenreich DDS','nboyer@example.org','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','jsPCfuePtw','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(19,'Zack Kris','annabel24@example.com','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','Otku9pMLTf','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(20,'Kaleb Ondricka','olson.howell@example.net','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','XHUpkqYg0l','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(21,'Deja Reynolds','kailyn77@example.org','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','NfMhFfHyZn','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(22,'Lenny Okuneva','nitzsche.kellen@example.com','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','WQkbzP6f6n','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(23,'Mrs. Bonita Jaskolski','yvonrueden@example.com','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','VbWcYrWghJ','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(24,'Prof. Willie Parisian','xturcotte@example.net','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','XaGITWgFDU','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(25,'Dorian Greenholt','torphy.otis@example.net','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','zALWF42lQV','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(26,'Dr. Jefferey Medhurst PhD','destin69@example.org','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','SRljrz7FqF','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(27,'Davon Flatley','stark.alfonso@example.org','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','OYb85jAmgX','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(28,'Dr. Nat McLaughlin','clare24@example.net','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','wVnH9iPw7t','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(29,'Braulio Schmidt','zieme.lottie@example.org','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','9sdv1mULeV','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(30,'Alda McDermott III','alvera46@example.com','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','TSLwdLcGjd','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(31,'Elyssa Abbott','ludie45@example.com','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','UOy2xR9KAS','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(32,'Tyler Donnelly V','cgoyette@example.com','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','YzayFRriXC','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(33,'Alberta Lockman','pwalker@example.net','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','ytlOLinoTn','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(34,'Mrs. Eulah Davis','nbrown@example.net','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','e2QLlIeUWe','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(35,'Miss Deanna Marquardt','alva.senger@example.net','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','ImmiMs9wnM','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(36,'Catharine Kunze','fhaag@example.org','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','rcReYPmvho','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(37,'Terence Labadie I','inikolaus@example.com','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','BdLxrLbhoA','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(38,'Genevieve Wuckert DDS','casper.creola@example.net','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','baLoag1Hxb','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(39,'Rigoberto Nitzsche V','kaycee.jenkins@example.net','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','bA48yqUhAu','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(40,'Tomasa Torphy','kip.casper@example.com','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','oRv2JWTVNA','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(41,'Filiberto Hoeger','hilma14@example.net','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','6McORkYJng','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(42,'Theresa Toy','nitzsche.rhea@example.org','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','UyqdWKLSgF','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(43,'Mr. Claud Kemmer','ursula96@example.org','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','5vkSOJEJS1','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(44,'Laron Farrell','carolanne.berge@example.com','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','9xRXh6FTh4','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(45,'Dereck Hickle','swaniawski.kaylin@example.com','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','y8njgj02LF','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(46,'Bernhard Shields','gibson.hobart@example.net','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','MWcbLFEVB6','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(47,'Alba Sauer Jr.','geoffrey.ledner@example.net','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','WNXblXaIXB','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(48,'Aubree Price','hhudson@example.net','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','BiCvLKN5YA','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(49,'Horacio Flatley','xthiel@example.com','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','ATgPotM7jq','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(50,'Valentina Pfeffer','zola.towne@example.net','2025-07-21 09:56:11','$2y$12$6v3EzH7rltKFAstu7VAu5uXc0MMXOyfmzukAuv1xx89x9zXxPBpYS','empresa','9IxDfmclBC','2025-07-21 09:56:11','2025-07-21 09:56:11',NULL),(51,'admin','admin@admin.com',NULL,'$2y$12$85mzvf405xr4R2.rHd9ZSeNvlYdrV1pbHb2nvNYHT62RLWL3PTko.','admin',NULL,'2025-07-21 09:57:36','2025-07-21 09:57:36',NULL),(52,'Ferran Enterprises S.L.','ferran@microvalencia.com',NULL,'$2y$12$2fcx6xqnkgnf37KUCO3tf.Ygkmf5vrkYWvbJ7etD.MqnCmX.aoRGC','empresa',NULL,'2025-07-21 09:57:52','2025-07-21 09:57:52',NULL),(54,'Jaume Moraleda','jaume@microvalencia.com',NULL,'$2y$12$Uv2hhxoGhU/XRIdzqDUEWOBZsNNiU4DOWjAjAGpm6r7IAEvLYpvYK','trabajador',NULL,'2025-07-21 10:03:38','2025-07-22 08:07:20','2025-07-22 08:07:20'),(55,'Diana Howe','hkub@example.net','2025-07-21 10:08:44','$2y$12$YVbUa1QUZZDCN1GiQBme..TqiCiYngGguJPuB9qZ7qy/ZV.467zKW','trabajador','avFh5Qvw9C','2025-07-21 10:08:44','2025-07-21 10:08:44',NULL),(56,'Freddie Macejkovic','abshire.ashtyn@example.org','2025-07-21 10:09:02','$2y$12$6vs6eGWRcZF.Z9Z/RK9N6OpQERDfKK5.lx6Y/GiQ4NICsHkEyMGP.','trabajador','LFqXIzrPEs','2025-07-21 10:09:02','2025-07-21 10:09:02',NULL),(57,'Orland Murphy II','istokes@example.org','2025-07-21 10:09:08','$2y$12$9AqkpQJ7UvHOFCCvOCFp5.6eXQODU9HgcBHTZWU6kmjZdmB7Un0Ui','trabajador','DnC0lLbEoZ','2025-07-21 10:09:08','2025-07-21 10:09:08',NULL),(61,'Ferran Moraleda','ferry@gmail.com',NULL,'$2y$12$nPGDgXGwma.8sR8o5NejluBR5uhBdTgk2aK4ENcjMzpbsJyi1yS.2','trabajador',NULL,'2025-07-22 08:06:59','2025-07-22 09:33:16','2025-07-22 09:33:16'),(62,'Jaume Enterprises S.L.','jaumeempresa@microvalencia.com',NULL,'$2y$12$MIwufQeukEcuLVxXBNDOOucZ50HRHyZqqvqD9w/WtMcDUU9k5ZW.i','empresa',NULL,'2025-07-22 08:14:23','2025-07-22 08:14:23',NULL),(63,'Lucía Sánchez Melego','lucia@jaume.com',NULL,'$2y$12$NKfyk56aLOacwP1U0QB8LeLGS0WWI5uYVamJDUINmDGnFM87n76MG','trabajador',NULL,'2025-07-22 08:15:09','2025-07-22 08:15:09',NULL),(66,'Joan Moraleda Martínez','joan@microvalencia.com',NULL,'$2y$12$uKbVv/Zk5BHZLL103mFonu1G.fbLuQLeolr1FbV4eMGFHkK3ZUAb6','trabajador',NULL,'2025-07-22 08:24:55','2025-07-22 08:25:08','2025-07-22 08:25:08'),(67,'Joan Moraleda Martínez','joan@jaumeempresa.com',NULL,'$2y$12$.sABUm3ERjhaedwJvqpEt.BDQU2FufMdw8cpjO4m3omfhJmuw0/LG','trabajador',NULL,'2025-07-22 08:25:38','2025-07-22 08:25:56','2025-07-22 08:25:56'),(77,'Ferran Moraleda Mulío','ferran@ferranenterprise.com',NULL,'$2y$12$PbhkypuvJ45/yKgFFmKgr.0HG905IE.ufvbegrluJ1LDXMeNG3gtO','trabajador','xgyUUuMGtjxjqbikkTUzlRulwdzJUhw8FHnifqYKci40p73jptHpa0f91Tgt','2025-07-22 09:35:53','2025-07-22 09:35:53',NULL),(78,'Manolo S.L.','manolo@sl.com',NULL,'$2y$12$tdPb9TAD41356AqmSaeLU./Va4N/uyhDM09vU2HuBqXUHnO.kKI3a','empresa',NULL,'2025-07-29 06:20:35','2025-07-29 06:20:35',NULL),(79,'Ferran Moraleda','empleado@manolo.com',NULL,'$2y$12$lD2t0h93b/E7Va9MU2fgSOztGp2cp8CxT83F9q.m8rskR6.2CHsiS','trabajador',NULL,'2025-07-29 06:22:44','2025-07-29 06:23:07','2025-07-29 06:23:07'),(80,'Lourdes Mulio Fliquete','lourdes@ferranenterprise.com',NULL,'$2y$12$aZxYg8Qouc2mwLkRxStvO.owRI.oeQzGXG.tzin8wW5A2hmKvi7sK','trabajador',NULL,'2025-08-07 17:34:06','2025-08-07 17:34:06',NULL),(81,'Inma','inma@ferranenterprise.com',NULL,'$2y$12$GYN8opU4ZEcH2Jfm9EjaduN4N9hTaDfBK5PlspOpnk2cCw9.BzIb2','trabajador',NULL,'2025-08-15 11:09:05','2025-08-15 11:09:05',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-08-16 13:02:20
