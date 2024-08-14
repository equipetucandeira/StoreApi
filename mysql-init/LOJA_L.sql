-- MySQL dump 10.13  Distrib 9.0.1, for Linux (x86_64)
--
-- Host: localhost    database: myapp_db
-- ------------------------------------------------------
-- server version	9.0.1

/*!40101 set @old_character_set_client=@@character_set_client */;
/*!40101 set @old_character_set_results=@@character_set_results */;
/*!40101 set @old_collation_connection=@@collation_connection */;
/*!50503 set names utf8mb4 */;
/*!40103 set @old_time_zone=@@time_zone */;
/*!40103 set time_zone='+00:00' */;
/*!40014 set @old_unique_checks=@@unique_checks, unique_checks=0 */;
/*!40014 set @old_foreign_key_checks=@@foreign_key_checks, foreign_key_checks=0 */;
/*!40101 set @old_sql_mode=@@sql_mode, sql_mode='no_auto_value_on_zero' */;
/*!40111 set @old_sql_notes=@@sql_notes, sql_notes=0 */;

--
-- table structure for table `orderitens`
--

drop table if exists `orderitens`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!50503 set character_set_client = utf8mb4 */;
create table `orderitens` (
  `id` int not null auto_increment,
  `product_id` int not null,
  `order_id` int not null,
  `item_quantity` int not null,
  `price` decimal(10,2) not null,
  primary key (`id`),
  key `order_id` (`order_id`),
  key `product_id` (`product_id`),
  constraint `orderitens_ibfk_1` foreign key (`order_id`) references `orders` (`orderid`),
  constraint `orderitens_ibfk_2` foreign key (`product_id`) references `product` (`id`)
) engine=innodb auto_increment=21 default charset=utf8mb4 collate=utf8mb4_0900_ai_ci;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- dumping data for table `orderitens`
--

lock tables `orderitens` write;
/*!40000 alter table `orderitens` disable keys */;
insert into `orderitens` values (1,3,3,2,123.12),(2,2,3,1,13.00),(3,3,4,2,123.12),(4,3,5,2,123.12),(5,1,6,1,10.00),(6,1,7,1,10.00),(7,1,8,1,10.00),(8,1,9,1,10.00),(9,1,10,1,10.00),(10,1,11,1,10.00),(11,1,12,1,10.00),(12,1,13,1,10.00);
/*!40000 alter table `orderitens` enable keys */;
unlock tables;

--
-- table structure for table `orders`
--

drop table if exists `orders`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!50503 set character_set_client = utf8mb4 */;
create table `orders` (
  `orderid` int not null auto_increment,
  `userid` int not null,
  `totalprice` decimal(10,2) default null,
  `date` timestamp null default current_timestamp,
  primary key (`orderid`),
  key `userid` (`userid`),
  constraint `orders_ibfk_1` foreign key (`userid`) references `user` (`id`)
) engine=innodb auto_increment=19 default charset=utf8mb4 collate=utf8mb4_0900_ai_ci;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- dumping data for table `orders`
--

lock tables `orders` write;
/*!40000 alter table `orders` disable keys */;
insert into `orders` values (1,13,259.24,'2024-07-24 16:23:44'),(2,13,259.24,'2024-07-24 16:23:44'),(3,13,259.24,'2024-07-24 16:23:44'),(4,21,259.24,'2024-07-24 13:23:44'),(5,21,259.24,'2024-07-24 11:23:44'),(6,21,30.00,'2024-07-24 11:23:44'),(7,21,30.00,'2024-07-24 13:23:44'),(8,21,10.00,'2024-08-10 20:44:15'),(9,21,30.00,'2024-08-10 20:51:30'),(10,21,30.00,'2024-08-10 20:53:28'),(11,21,30.00,'2024-08-10 21:02:16'),(12,21,30.00,'2024-08-10 21:02:50'),(13,21,10.00,'2024-08-10 21:03:48');
/*!40000 alter table `orders` enable keys */;
unlock tables;

--
-- table structure for table `product`
--

drop table if exists `product`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!50503 set character_set_client = utf8mb4 */;
create table `product` (
  `id` int not null auto_increment,
  `sku` varchar(5) not null,
  `name` varchar(50) default null,
  `description` varchar(200) default null,
  `price` decimal(10,2) default null,
  `image` varchar(40) default null,
  `image2` varchar(40) default null,
  `image3` varchar(40) default null,
  primary key (`id`),
  unique key `id` (`id`),
  unique key `sku` (`sku`),
  unique key `id_2` (`id`)
) engine=innodb auto_increment=46 default charset=utf8mb4 collate=utf8mb4_0900_ai_ci;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- dumping data for table `product`
--

lock tables `product` write;
/*!40000 alter table `product` disable keys */;
insert into `product` (`sku`, `name`, `description`, `price`, `image`, `image2`, `image3`) values
('p001', 'samsung galaxy s21', 'smartphone samsung galaxy s21 com 128gb de armazenamento', 799.99, '/public/images/s21_1.jpg', '/public/images/s21_2.jpg', '/public/images/s21_3.jpg'),
('p002', 'apple iphone 13', 'apple iphone 13 com 128gb de armazenamento', 899.99, '/public/images/iphone13_1.jpg', '/public/images/iphone13_2.jpg', '/public/images/iphone13_3.jpg'),
('p003', 'xiaomi mi 11', 'xiaomi mi 11 com 256gb de armazenamento', 699.99, '/public/images/mi11_1.jpg', '/public/images/mi11_2.jpg', null),
('p004', 'google pixel 6', 'google pixel 6 com 128gb de armazenamento', 799.99, '/public/images/pixel6_1.jpg', '/public/images/pixel6_2.jpg', '/public/images/pixel6_3.jpg'),
('p005', 'oneplus 9', 'oneplus 9 com 128gb de armazenamento', 729.99, '/public/images/oneplus9_1.jpg', null, null),
('P006', 'Sony Xperia 1 III', 'Sony Xperia 1 III com 256GB de armazenamento', 949.99, '/public/images/xperia1_1.jpg', null, null),
('P007', 'Huawei P50 Pro', 'Huawei P50 Pro com 256GB de armazenamento', 879.99, '/public/images/p50pro_1.jpg', '/public/images/p50pro_2.jpg', '/public/images/p50pro_3.jpg'),
('P008', 'Oppo Find X3 Pro', 'Oppo Find X3 Pro com 256GB de armazenamento', 849.99, '/public/images/findx3_1.jpg', '/public/images/findx3_2.jpg', '/public/images/findx3_3.jpg'),
('P009', 'Motorola Edge 20 Pro', 'Motorola Edge 20 Pro com 128GB de armazenamento', 699.99, '/public/images/edge20pro_1.jpg', '/public/images/edge20pro_2.jpg', '/public/images/edge20pro_3.jpg'),
('P010', 'Realme GT', 'Realme GT com 128GB de armazenamento', 599.99, '/public/images/realmegt_1.jpg', '/public/images/realmegt_2.jpg', '/public/images/realmegt_3.jpg'),
('P011', 'Asus ROG Phone 5', 'Asus ROG Phone 5 com 256GB de armazenamento', 999.99, '/public/images/rogphone5_1.jpg', '/public/images/rogphone5_2.jpg', '/public/images/rogphone5_3.jpg'),
('P012', 'Vivo X70 Pro+', 'Vivo X70 Pro+ com 256GB de armazenamento', 899.99, '/public/images/x70pro_1.jpg', null, null),
('P013', 'Nokia X20', 'Nokia X20 com 128GB de armazenamento', 499.99, '/public/images/nokiax20_1.jpg', '/public/images/nokiax20_2.jpg', '/public/images/nokiax20_3.jpg'),
('P014', 'ZTE Axon 30 Ultra', 'ZTE Axon 30 Ultra com 256GB de armazenamento', 749.99, '/public/images/axon30_1.jpg', '/public/images/axon30_2.jpg', '/public/images/axon30_3.jpg'),
('P015', 'Lenovo Legion Phone Duel 2', 'Lenovo Legion Phone Duel 2 com 512GB de armazenamento', 1099.99, '/public/images/legionduel2_1.jpg', '/public/images/legionduel2_2.jpg', null),
('P016', 'Alcatel 1S', 'Alcatel 1S com 32GB de armazenamento', 199.99, '/public/images/alcatel1s_1.jpg', '/public/images/alcatel1s_2.jpg', null),
('P017', 'Tecno Phantom X', 'Tecno Phantom X com 256GB de armazenamento', 649.99, '/public/images/phantomx_1.jpg', null,null),
('P018', 'Apple iPhone 15 Pro', 'Apple iPhone 15 Pro com 256GB de armazenamento', 1099.99, '/public/images/iphone15pro_1.jpg', '/public/images/iphone15pro_2.jpg', '/public/images/iphone15pro_3.jpg'),
('P019', 'Samsung Galaxy S24', 'Samsung Galaxy S24 com 256GB de armazenamento', 1199.99, '/public/images/s24_1.jpg', '/public/images/s24_2.jpg', '/public/images/s24_3.jpg'),
('P020', 'Apple iPhone 14', 'Apple iPhone 14 com 128GB de armazenamento', 999.99, '/public/images/iphone14_1.jpg', '/public/images/iphone14_2.jpg', '/public/images/iphone14_3.jpg');/*!40000 ALTER TABLE `product` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','admin@gmail.com','$2y$10$b9UJAF03samw7xPk2vMG.O/0An1dyWQY3EnOzSOEc4N/f7pveHzzK'),(2,'Samuel','samuelprado','$2y$10$krN.P51ybszoFGyJonBzV.to40iUaZ1veOm/Gj8ZVhiaJCpsXDgEm'),(13,'joao','joaoruffino','$2y$10$ooLmfQxdEoK2i6mS1Xv/u.D9MMSDVCJTESM77dIjBR3qY3H1YuFey'),(14,'Pedro Marques','pclemonini-00@hotmail.com','$2y$10$8MFUQfqVvJvpimUdpbpqjuAA/BFu8wwYuP8jUCAV9d5k/RaePONSe'),(21,'Joao Ruffino','ruffino.joaoo@gmail.com','$2y$10$vMxM2EbdAA2Fx/ynPQC.Z.6QyjJaOftU8oX/aHOmU.ZHQL16BKvg.');
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

-- Dump completed on 2024-08-13 22:18:50
