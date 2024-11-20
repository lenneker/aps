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
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tickets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `open_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `phone` varchar(11) NOT NULL,
  `category` enum('Desmatamento','Poluição do Ar','Poluição da Água','Poluição Sonora','Queimadas','Lixo e Resíduos','Erosão e Degradação do Solo','Outro') NOT NULL,
  `description` varchar(1500) DEFAULT NULL,
  `status` enum('Aberto','Concluído','Em Análise') DEFAULT 'Aberto',
  `resolution_justification` varchar(1500) DEFAULT NULL,
  `close_date` timestamp NULL DEFAULT NULL,
  `location` varchar(8) NOT NULL,
  `priority` enum('Normal','Urgente') NOT NULL DEFAULT 'Normal',
  `attendant` varchar(50) DEFAULT NULL,
  `logradouro` varchar(255) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `estado` varchar(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tickets`
--

LOCK TABLES `tickets` WRITE;
/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;
INSERT INTO `tickets` VALUES (1,4,'2024-11-07 00:25:15','11111111111','Desmatamento','sdsdsd','Concluído','sasaa','2024-11-09 23:13:26','00000000','Normal','User Teste','','','',''),(2,4,'2024-11-07 00:25:35','11111111111','Desmatamento','sdsdsd','Concluído','ok','2024-11-09 23:05:32','00000000','Normal','User Teste','','','',''),(3,4,'2024-11-07 00:55:42','11111111111','Desmatamento','teste','Concluído','','2024-11-07 00:56:02','00000000','Normal','Guilherme Gama','','','',''),(4,4,'2024-11-07 00:59:56','11111111111','Poluição do Ar','Poluição','Concluído','ok','2024-11-07 01:02:13','00000000','Normal','Guilherme Gama','','','',''),(5,35,'2024-11-09 23:06:44','54545454554','Poluição do Ar','gfgfgfgfgf','Concluído','Resolvido\r\n','2024-11-09 23:07:00','08080808','Normal','User Teste','','','',''),(6,35,'2024-11-09 23:08:24','54545454554','Poluição do Ar','ewewewew','Concluído','dsdsds','2024-11-09 23:08:36','08080808','Normal','User Teste','','','',''),(7,35,'2024-11-09 23:22:20','54545454554','Poluição do Ar','aaaaaaaaaaaaaaaa','Concluído','ok','2024-11-09 23:23:08','08080808','Normal','User Teste','','','',''),(8,35,'2024-11-10 16:36:54','54545454554','Poluição do Ar','dfdfddfdfdf','Concluído','Problema resolvido','2024-11-10 23:51:23','08080808','Normal','User Teste','','','',''),(9,35,'2024-11-10 16:37:01','54545454554','Poluição do Ar','dfdfdd','Concluído','ok','2024-11-10 16:37:28','08080808','Urgente','Guilherme Gama','','','',''),(10,35,'2024-11-10 16:37:10','54545454554','Poluição do Ar','fdfdf','Concluído','rererererer','2024-11-10 16:44:24','08080808','Normal','Guilherme Gama','','','',''),(11,35,'2024-11-10 20:45:34','54545454554','Desmatamento','VHGGH','Concluído','oK','2024-11-10 20:45:53','03040020','Normal','User Teste','','','',''),(12,35,'2024-11-10 20:57:58','54545454554','Desmatamento','teste','Concluído','1ASASA','2024-11-10 23:49:27','03040020','Normal','User Teste','','','',''),(13,35,'2024-11-10 21:00:12','54545454554','Desmatamento','32323232','Concluído','Feito','2024-11-10 23:47:33','03040020','Normal','User Teste','','','',''),(14,35,'2024-11-10 21:02:04','54545454554','Desmatamento','dadad','Concluído','Ok\r\n','2024-11-10 23:45:46','03040020','Normal','User Teste','','','',''),(15,35,'2024-11-10 21:31:25','54545454554','Poluição do Ar','sasa','Concluído','ok','2024-11-10 23:45:16','03040020','Normal','User Teste','Rua Azevedo Júnior','Brás','São Paulo','SP'),(16,35,'2024-11-10 21:56:40','54545454554','Poluição da Água','weeewewe','Concluído','Vamos análisar','2024-11-10 23:44:20','03040020','Normal','User Teste','Rua Azevedo Júnior','Brás','São Paulo','SP');
/*!40000 ALTER TABLE `tickets` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `update_close_date` BEFORE UPDATE ON `tickets` FOR EACH ROW BEGIN
    IF OLD.status IN ('Em Análise', 'Aberto') AND NEW.status = 'Concluído' THEN
        SET NEW.close_date = NOW();
    END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-19  8:04:25
