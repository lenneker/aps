-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: localhost    Database: une_chamados
-- ------------------------------------------------------
-- Server version	8.0.39

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `creation_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_type` enum('normal','admin') NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `last_updater` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Guilherme','','Gama','2024-07-26 19:42:20','2024-11-07 00:55:21','admin','root','$2y$10$UnD6IbxR4ijaiSIdOm6wDeLZp0V4QV5gtQmZR.UJDMiKbSN2lWWYK',NULL,NULL),(4,'User',NULL,'Teste','2024-11-01 17:13:40','2024-11-09 22:42:22','admin','g.kneip@outlook.com','$2y$10$UnD6IbxR4ijaiSIdOm6wDeLZp0V4QV5gtQmZR.UJDMiKbSN2lWWYK','Guilherme Gama',NULL),(35,'Leny','','Nascimento','2024-11-07 00:10:44','2024-11-09 23:08:01','normal','guiikneip@outlook.com','$2y$10$UnD6IbxR4ijaiSIdOm6wDeLZp0V4QV5gtQmZR.UJDMiKbSN2lWWYK','Guilherme Gama',NULL),(36,'Guilherme','Santos','Gama','2024-11-10 23:11:58','2024-11-11 00:09:04','normal','qwqwq','$2y$10$SrZVxvHWqqJQ6sCER7Lw7etk2XjOBPwmvUDm2GNnfW3cLYJQpoDRO','User Teste',NULL),(38,'Guilherme','Santos','Gama','2024-11-11 00:09:24','2024-11-11 00:12:06','normal','1213','$2y$10$5ZFF.j/135b7m1ZsfkffY.Zu.jXC6V.KstoO5//bkv.IoyhmqWTz2','User Teste',NULL),(40,'Guilherme','Santos','Gama','2024-11-11 00:12:12','2024-11-11 00:12:12','normal','guikneip@outlook.com.br','$2y$10$cqW8UOjVfMu3WkDI7uU.V.UGB3z7E5X0Wi64VHZbKvGd0Nu1TR1pu','User Teste',NULL);
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

-- Dump completed on 2024-11-19  8:04:25
