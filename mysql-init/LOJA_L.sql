-- MySQL dump 10.13  Distrib 8.3.0, for macos14.2 (arm64)
--
-- Host: localhost    Database: LOJA_L
-- ------------------------------------------------------
-- Server version	8.3.0

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
-- Table structure for table `orderItens`
--

DROP TABLE IF EXISTS `orderItens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orderItens` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_ID` int NOT NULL,
  `order_ID` int NOT NULL,
  `item_Quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_ID` (`order_ID`),
  KEY `product_ID` (`product_ID`),
  CONSTRAINT `orderitens_ibfk_1` FOREIGN KEY (`order_ID`) REFERENCES `orders` (`orderID`),
  CONSTRAINT `orderitens_ibfk_2` FOREIGN KEY (`product_ID`) REFERENCES `product` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderItens`
--

LOCK TABLES `orderItens` WRITE;
/*!40000 ALTER TABLE `orderItens` DISABLE KEYS */;
INSERT INTO `orderItens` VALUES (1,3,3,2,123.12),(2,2,3,1,13.00);
/*!40000 ALTER TABLE `orderItens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `orderID` int NOT NULL AUTO_INCREMENT,
  `userID` int NOT NULL,
  `totalPrice` decimal(10,2) DEFAULT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`orderID`),
  KEY `userID` (`userID`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,13,259.24,'2024-07-24 16:23:44'),(2,13,259.24,'2024-07-24 16:23:44'),(3,13,259.24,'2024-07-24 16:23:44');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sku` varchar(5) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `price` decimal(5,2) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `image2` varchar(100) DEFAULT NULL,
  `image3` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `sku` (`sku`),
  UNIQUE KEY `id_2` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'001','iPhone 13','Description 1',10.00,'image1',NULL,NULL),(2,'002','Samsung Galaxy S21','Description 2',20.00,'image2',NULL,NULL),(3,'003','Google Pixel 6','Description 3',30.00,'image3',NULL,NULL),(4,'004','OnePlus 9','Description 4',40.00,'image4',NULL,NULL),(5,'005','Sony Xperia 5 II','Description 5',50.00,'image5',NULL,NULL),(6,'006','Xiaomi Mi 11','Description 6',60.00,'image6',NULL,NULL),(7,'007','Oppo Find X3 Pro','Description 7',70.00,'image7',NULL,NULL),(8,'008','Huawei P40 Pro','Description 8',80.00,'image8',NULL,NULL),(9,'009','Motorola Edge Plus','Description 9',90.00,'image9',NULL,NULL),(10,'010','Asus ROG Phone 5','Description 10',100.00,'image10',NULL,NULL),(11,'011','Nokia 8.3 5G','Description 11',110.00,'image11',NULL,NULL),(12,'012','LG Wing','Description 12',120.00,'image12',NULL,NULL),(13,'013','Realme GT','Description 13',130.00,'image13',NULL,NULL),(14,'014','Vivo X60 Pro+','Description 14',140.00,'image14',NULL,NULL),(15,'015','ZTE Axon 30 Ultra','Description 15',150.00,'image15',NULL,NULL),(16,'016','Lenovo Legion Phone Duel','Description 16',160.00,'image16',NULL,NULL),(17,'017','Microsoft Surface Duo','Description 17',170.00,'image17',NULL,NULL),(18,'018','TCL 20 Pro 5G','Description 18',180.00,'image18',NULL,NULL),(19,'019','Fairphone 4','Description 19',190.00,'image19',NULL,NULL),(20,'020','Poco F3','Description 20',200.00,'image20',NULL,NULL);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (11,'Samuel','samuelprado','$2y$10$krN.P51ybszoFGyJonBzV.to40iUaZ1veOm/Gj8ZVhiaJCpsXDgEm'),(13,'joao','joaoruffino','$2y$10$ooLmfQxdEoK2i6mS1Xv/u.D9MMSDVCJTESM77dIjBR3qY3H1YuFey'),(14,'Pedro Marques','pclemonini-00@hotmail.com','$2y$10$8MFUQfqVvJvpimUdpbpqjuAA/BFu8wwYuP8jUCAV9d5k/RaePONSe');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-01 10:22:16
