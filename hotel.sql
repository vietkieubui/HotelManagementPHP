-- MariaDB dump 10.18  Distrib 10.4.17-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: hotelmanagement
-- ------------------------------------------------------
-- Server version	10.4.17-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bill`
--

DROP TABLE IF EXISTS `bill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bill` (
  `billID` int(11) NOT NULL AUTO_INCREMENT,
  `registerID` int(15) NOT NULL,
  `paymentDate` date NOT NULL,
  `staff` varchar(15) NOT NULL,
  `roomcharge` float NOT NULL,
  `servicecharge` float NOT NULL,
  `subTotal` float NOT NULL,
  `vat` float NOT NULL,
  `total` float NOT NULL,
  `profit` int(11) NOT NULL,
  PRIMARY KEY (`billID`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bill`
--

LOCK TABLES `bill` WRITE;
/*!40000 ALTER TABLE `bill` DISABLE KEYS */;
INSERT INTO `bill` VALUES (32,42,'2021-07-08','admin',3000000,1150000,4150000,415000,4565000,913000),(33,43,'2021-07-13','admin',13300000,2800000,16100000,1610000,17710000,3542000),(34,44,'2021-07-09','admin',4000000,750000,4750000,475000,5225000,1045000),(35,45,'2021-07-05','admin',4000000,1600000,5600000,560000,6160000,1232000),(36,46,'2021-07-05','admin',2000000,450000,2450000,245000,2695000,539000),(38,48,'2021-07-08','admin',500000,0,500000,50000,550000,110000),(39,49,'2021-07-09','admin',1000000,600000,1600000,160000,1760000,352000),(40,50,'2021-07-12','kieu',3000000,1450000,4450000,445000,4895000,979000),(41,51,'2021-07-12','kieu',1000000,300000,1300000,130000,1430000,286000),(42,52,'2021-07-12','kieu',3000000,0,3000000,300000,3300000,660000),(43,53,'2021-07-12','kieu',2800000,800000,3600000,360000,3960000,792000),(44,54,'2021-07-12','kieu',500000,0,500000,50000,550000,110000),(45,55,'2021-07-12','kieu',1100000,0,1100000,110000,1210000,242000),(46,56,'0000-00-00','',0,0,0,0,0,0),(47,57,'0000-00-00','',0,0,0,0,0,0),(48,58,'2021-07-13','admin',3000000,600000,3600000,360000,3960000,792000);
/*!40000 ALTER TABLE `bill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `customerID` int(11) NOT NULL AUTO_INCREMENT,
  `customerName` text NOT NULL,
  `idCard` varchar(20) NOT NULL,
  `gender` text NOT NULL,
  `address` text NOT NULL,
  `phoneNumber` varchar(15) NOT NULL,
  `nationality` text NOT NULL,
  `email` text DEFAULT NULL,
  `note` text DEFAULT NULL,
  PRIMARY KEY (`customerID`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (27,'Đặng Tuấn Anh','857923099','male','Hà Nội','0604773705','Vietnamese','',''),(28,'Đoàn Hoàng Sơn','757420053','male','Cao Bằng','0174826938','Vietnamese','',''),(30,'Lê Khánh Vy','639088618','female','Cần Thơ','0148058648','Vietnamese','',''),(31,'Hoàng Nhật Mai','439682028','female','Hà Tĩnh','0732816820','Vietnamese','',''),(32,'Bùi Khánh Ngọc','392655257','male','Hưng Yên','0988280697','Vietnamese','',''),(33,'Vũ Đức Huy','891358363','male','Hà Giang','0279082455','Vietnamese','',''),(34,'Nguyễn Quang Hùng','417936833','male','Phú Thọ','0798724289','Vietnamese','',''),(35,'Nguyễn Thị Tùng Chi	','689412646','female','Hà Nội','0883516046','Vietnamese','',''),(36,'Nguyễn Yến Nhi','670429121','female','Nam Định','0685650759','Vietnamese','',''),(37,'Hoàng Đức Thành','643876282','male','Nghệ An','0549973780','Vietnamese','',''),(38,'Phạm Gia Huy','144578096','male','Hà Nội','0627064927','Vietnamese','',''),(39,'Trần Đức Nam','361194843','male','Quảng Ninh','0517432639','Vietnamese','',''),(40,'Nguyễn Thúy Quỳnh','108506432','female','Quảng Bình','0164923247','Vietnamese','',''),(41,'Phạm Hoàng Bách','430596902','male','Lào Cai','0776482774','Vietnamese','',''),(42,'Bùi Quỳnh Anh','389065507','female','Lâm Đồng','0331797274','Vietnamese','',''),(43,'Nguyễn Thị Hồng Dung ','846246280','female','Nghệ An','0619277847','Vietnamese','',''),(44,'Nguyễn Thị Hồng ','930452438','female','Ninh Thuận','0621071493','Vietnamese','',''),(45,'Nguyễn Thị Nhung ','232606658','female','Bạc Liêu','0632928191','Vietnamese','',''),(46,'Huỳnh Chiêu Hoàng ','608494464','female','Tuyên Quang','0639933363','Vietnamese','',''),(47,'Nguyễn Thanh Nhã ','799749926','male','Trà Vinh','0830906586','Vietnamese','',''),(48,'Nguyễn Minh Thành ','478664790','male','Lâm Đồng','0211808547','Vietnamese','',''),(49,'Lâm A Bển ','734800244','male','Cao Bằng','0408162659','Vietnamese','',''),(50,'Phan Thị Loan ','472922945','female','Nam Định','0981732411','Vietnamese','',''),(51,'Đỗ Văn Thọ ','145012774','male','Hà Tĩnh','0175716446','Vietnamese','',''),(52,'Đỗ Ngọc Anh ','852968682','male','Sơn La','0947940640','Vietnamese','',''),(53,'Nguyễn Thị Kim Dung ','206303144','female','Bình Phước','0667411455','Vietnamese','',''),(54,'Nguyễn Thị Nhường ','521275416','female','Bến Tre','0692912828','Vietnamese','',''),(55,'Trần Đình Nghĩa ','931511604','male','Sơn La','0332437256','Vietnamese','',''),(56,'Phùng Mỹ Mỹ ','502638752','female','Bắc Kạn','0487966618','Vietnamese','',''),(57,'Trần Thị Thu Hằng ','137176029','female','Cà Mau','0761676787','Vietnamese','',''),(58,'Đặng Thị Khuyên ','160855489','female','Hậu Giang','0576037475','Vietnamese','',''),(59,'Trần Ngọc Thắng ','284329743','male','Quảng Ngãi','0515582340','Vietnamese','',''),(60,'Ngô Thị Phượng ','326815047','female','Hà Giang','0196311520','Vietnamese','',''),(61,'Dương Tuấn Anh ','680658423','male','Bình Dương','0125837596','Vietnamese','',''),(62,'Đinh Thái Học ','968646884','male','Nghệ An','0887191770','Vietnamese','',''),(63,'Phan Thị Mỹ Hà ','865344777','female','Lào Cai','0472228632','Vietnamese','',''),(64,'Nguyễn Đoàn Quân ','170619014','male','Nghệ An','0162416204','Vietnamese','',''),(65,'Nguyễn Thảo ','112386236','female','Nam Định','0632671394','Vietnamese','',''),(66,'Thái Ngọc Bích Nga ','703498315','female','Hải Dương','0609032063','Vietnamese','',''),(67,'Lê Văn Hồng ','237522262','male','Sóc Trăng','0996975923','Vietnamese','',''),(68,'Đào Văn Chi ','196660664','male','Bà Rịa Vũng Tàu','0998825708','Vietnamese','',''),(69,'Lê Ngọc Ngân ','567915968','female','Bạc Liêu','0452593178','Vietnamese','',''),(70,'Nguyễn Thị Nước ','512893687','female','Bến Tre','0547664494','Vietnamese','',''),(71,'Nguyễn Văn Khá ','977004394','male','Kon Tum','0538056204','Vietnamese','',''),(72,'Trần Thị Thu Thảo ','567752459','female','Lai Châu','0117430405','Vietnamese','',''),(73,'Lê Văn Dẩu ','841615370','male','Bình Phước','0219234211','Vietnamese','',''),(74,'Khuất Hữu Hiệu ','114669165','male','Nam Định','0857627635','Vietnamese','',''),(75,'Nguyễn Thị Yên ','556120171','female','Hà Giang','0758780679','Vietnamese','',''),(76,'Đặng Minh Nhật ','969084570','male','Quảng Ninh','0803991376','Vietnamese','',''),(77,'Nguyễn Hữu Thắng','846296710','male','Hà Nội','0850206716','Vietnamese','',''),(79,'Nguyễn Thị Vân Anh','123321123','female','Hà Nội','0123456789','Vietnamese','',NULL),(80,'Bùi Việt Kiều','001200022346','male','Hà Nội','0123456789','Vietnamese','',NULL);
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(20) NOT NULL,
  `pass` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` VALUES (2,'admin','1'),(6,'kieu','1');
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prebook`
--

DROP TABLE IF EXISTS `prebook`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prebook` (
  `customerID` text NOT NULL,
  `phoneNumber` varchar(15) NOT NULL,
  `type` text NOT NULL,
  `bedding` text NOT NULL,
  `numroom` int(11) NOT NULL,
  `checkIn` date NOT NULL,
  `checkOut` date NOT NULL,
  `note` text DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prebook`
--

LOCK TABLES `prebook` WRITE;
/*!40000 ALTER TABLE `prebook` DISABLE KEYS */;
INSERT INTO `prebook` VALUES ('27','','Normal Room','Single',2,'2021-07-07','2021-07-10','no','checked'),('28','0123456','Normal Room','Single',1,'2021-07-08','2021-07-10','','checked'),('78','0123456','Normal Room','Single',1,'2021-07-07','2021-07-10','','checked'),('27','0123456','Normal Room','Single',2,'2021-07-08','2021-07-12','',NULL),('27','0123456','Normal Room','Single',1,'2021-07-08','2021-07-09','','checked'),('79','0123456789','Normal Room','Single',3,'2021-07-09','2021-07-14','','checked'),('80','0123456789','Normal Room','Single',2,'2021-07-13','2021-07-16','','checked');
/*!40000 ALTER TABLE `prebook` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registrationform`
--

DROP TABLE IF EXISTS `registrationform`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registrationform` (
  `registerID` int(11) NOT NULL AUTO_INCREMENT,
  `customerID` int(11) NOT NULL,
  `checkIn` date NOT NULL,
  `checkOut` date NOT NULL,
  `days` int(11) NOT NULL,
  `amountOfPeople` int(11) NOT NULL,
  `prepay` int(11) NOT NULL,
  `note` text DEFAULT NULL,
  PRIMARY KEY (`registerID`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registrationform`
--

LOCK TABLES `registrationform` WRITE;
/*!40000 ALTER TABLE `registrationform` DISABLE KEYS */;
INSERT INTO `registrationform` VALUES (42,27,'2021-07-05','2021-07-08',3,1,0,'paid'),(43,36,'2021-07-06','2021-07-13',7,10,500000,'paid'),(44,30,'2021-07-05','2021-07-09',4,5,200000,'paid'),(45,77,'2021-07-05','2021-07-09',4,5,500000,'paid'),(46,31,'2021-07-05','2021-07-07',2,5,200000,'paid'),(48,27,'2021-07-07','2021-07-07',1,1,0,'paid'),(49,30,'2021-07-08','2021-07-10',2,1,0,'paid'),(50,33,'2021-07-09','2021-07-12',3,2,200000,'paid'),(51,53,'2021-07-09','2021-07-11',2,1,0,'paid'),(52,54,'2021-07-12','2021-07-15',3,3,300000,'paid'),(53,30,'2021-07-12','2021-07-14',2,8,0,'paid'),(54,33,'2021-07-12','2021-07-13',1,1,0,'paid'),(55,39,'2021-07-12','2021-07-13',1,3,0,'paid'),(56,28,'2021-07-12','2021-07-12',1,1,0,''),(57,38,'2021-07-12','2021-07-12',1,1,0,''),(58,27,'2021-07-13','2021-07-16',3,5,500000,'paid');
/*!40000 ALTER TABLE `registrationform` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `room`
--

DROP TABLE IF EXISTS `room`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `room` (
  `roomID` int(100) NOT NULL,
  `type` text NOT NULL,
  `bedding` text NOT NULL,
  `price` float NOT NULL,
  `status` text NOT NULL,
  `note` text DEFAULT NULL,
  PRIMARY KEY (`roomID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room`
--

LOCK TABLES `room` WRITE;
/*!40000 ALTER TABLE `room` DISABLE KEYS */;
INSERT INTO `room` VALUES (101,'Normal Room','Single',500000,'using',''),(102,'Normal Room','Single',500000,'using',''),(103,'Normal Room','Single',500000,'ready',''),(104,'Normal Room','Single',500000,'ready',''),(105,'Normal Room','Single',500000,'ready',''),(106,'Normal Room','Single',500000,'ready',''),(107,'Normal Room','Double',700000,'ready',''),(108,'Normal Room','Double',700000,'ready',''),(109,'Normal Room','Double',700000,'ready',''),(110,'Normal Room','Double',700000,'ready',''),(111,'Normal Room','Double',700000,'ready',''),(112,'Normal Room','Double',700000,'ready',''),(113,'VIP Room','Single',900000,'ready',''),(114,'VIP Room','Single',900000,'ready',''),(115,'VIP Room','Single',900000,'ready',''),(116,'VIP Room','Single',900000,'ready',''),(117,'VIP Room','Double',1100000,'ready',''),(118,'VIP Room','Double',1100000,'ready',''),(119,'VIP Room','Double',1100000,'ready',''),(120,'VIP Room','Double',1100000,'ready',''),(201,'Normal Room','Single',500000,'ready',''),(202,'Normal Room','Single',500000,'ready',''),(203,'Normal Room','Single',500000,'ready',''),(204,'Normal Room','Single',500000,'ready',''),(205,'Normal Room','Single',500000,'ready',''),(206,'Normal Room','Single',500000,'ready',''),(207,'Normal Room','Double',700000,'ready',''),(208,'Normal Room','Double',700000,'ready',''),(209,'Normal Room','Double',700000,'ready',''),(210,'Normal Room','Double',700000,'ready',''),(211,'Normal Room','Double',700000,'ready',''),(212,'Normal Room','Double',700000,'ready',''),(213,'VIP Room','Single',900000,'ready',''),(214,'VIP Room','Single',900000,'ready',''),(215,'VIP Room','Single',900000,'ready',''),(216,'VIP Room','Single',900000,'ready',''),(217,'VIP Room','Double',1100000,'ready',''),(218,'VIP Room','Double',1100000,'ready',''),(219,'VIP Room','Double',1100000,'ready',''),(220,'VIP Room','Double',1100000,'ready',''),(301,'Normal Room','Single',500000,'ready',''),(302,'Normal Room','Single',500000,'ready',''),(303,'Normal Room','Single',500000,'ready',''),(304,'Normal Room','Single',500000,'ready',''),(305,'Normal Room','Single',500000,'ready',''),(306,'Normal Room','Single',500000,'ready',''),(307,'Normal Room','Double',700000,'ready',''),(308,'Normal Room','Double',700000,'ready',''),(309,'Normal Room','Double',700000,'ready',''),(310,'Normal Room','Double',700000,'ready',''),(311,'Normal Room','Double',700000,'ready',''),(312,'Normal Room','Double',700000,'ready',''),(313,'VIP Room','Single',900000,'ready',''),(314,'VIP Room','Single',900000,'ready',''),(315,'VIP Room','Single',900000,'ready',''),(316,'VIP Room','Single',900000,'ready',''),(317,'VIP Room','Double',1100000,'ready',''),(318,'VIP Room','Double',1100000,'ready',''),(319,'VIP Room','Double',1100000,'ready',''),(320,'VIP Room','Double',1100000,'ready',''),(401,'Normal Room','Single',500000,'ready',''),(402,'Normal Room','Single',500000,'ready',''),(403,'Normal Room','Single',500000,'ready',''),(404,'Normal Room','Single',500000,'ready',''),(405,'Normal Room','Single',500000,'ready',''),(406,'Normal Room','Single',500000,'ready',''),(407,'Normal Room','Double',700000,'ready',''),(408,'Normal Room','Double',700000,'ready',''),(409,'Normal Room','Double',700000,'ready',''),(410,'Normal Room','Double',700000,'ready',''),(411,'Normal Room','Double',700000,'ready',''),(412,'Normal Room','Double',700000,'ready',''),(413,'VIP Room','Single',900000,'ready',''),(414,'VIP Room','Single',900000,'ready',''),(415,'VIP Room','Single',900000,'ready',''),(416,'VIP Room','Single',900000,'ready',''),(417,'VIP Room','Double',1100000,'ready',''),(418,'VIP Room','Double',1100000,'ready',''),(419,'VIP Room','Double',1100000,'ready',''),(420,'VIP Room','Double',1100000,'ready',''),(501,'Normal Room','Single',500000,'ready',''),(502,'Normal Room','Single',500000,'ready',''),(503,'Normal Room','Single',500000,'ready',''),(504,'Normal Room','Single',500000,'ready',''),(505,'Normal Room','Single',500000,'ready',''),(506,'Normal Room','Single',500000,'ready',''),(507,'Normal Room','Double',700000,'ready',''),(508,'Normal Room','Double',700000,'ready',''),(509,'Normal Room','Double',700000,'ready',''),(510,'Normal Room','Double',700000,'ready',''),(511,'Normal Room','Double',700000,'ready',''),(512,'Normal Room','Double',700000,'ready',''),(513,'VIP Room','Single',900000,'ready',''),(514,'VIP Room','Single',900000,'ready',''),(515,'VIP Room','Single',900000,'ready',''),(516,'VIP Room','Single',900000,'ready',''),(517,'VIP Room','Double',1100000,'ready',''),(518,'VIP Room','Double',1100000,'ready',''),(519,'VIP Room','Double',1100000,'ready',''),(520,'VIP Room','Double',1100000,'ready','');
/*!40000 ALTER TABLE `room` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roomregistration`
--

DROP TABLE IF EXISTS `roomregistration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roomregistration` (
  `registerID` int(15) NOT NULL,
  `roomID` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roomregistration`
--

LOCK TABLES `roomregistration` WRITE;
/*!40000 ALTER TABLE `roomregistration` DISABLE KEYS */;
INSERT INTO `roomregistration` VALUES (42,'102'),(43,'106'),(43,'107'),(43,'108'),(44,'103'),(45,'105'),(46,'102'),(48,'101'),(49,'101'),(50,'101'),(50,'102'),(51,'103'),(52,'104'),(52,'105'),(53,'107'),(53,'108'),(54,'101'),(55,'117'),(56,'101'),(57,'102'),(58,'103'),(58,'104');
/*!40000 ALTER TABLE `roomregistration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service`
--

DROP TABLE IF EXISTS `service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service` (
  `serviceID` int(11) NOT NULL AUTO_INCREMENT,
  `serviceName` text NOT NULL,
  `price` float NOT NULL,
  `note` text DEFAULT NULL,
  PRIMARY KEY (`serviceID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service`
--

LOCK TABLES `service` WRITE;
/*!40000 ALTER TABLE `service` DISABLE KEYS */;
INSERT INTO `service` VALUES (5,'Airport pick-up 4',200000,''),(6,'Airport pick-up 7 ',300000,''),(7,'Airport pick-up 16',500000,''),(8,'Airport drop-off 4',200000,''),(9,'Airport drop-off 7',300000,''),(10,'Airport drop-off 16',500000,''),(11,'Breakfast',50000,''),(12,'Lunch',100000,''),(13,'Dinner',150000,'');
/*!40000 ALTER TABLE `service` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `serviceregistration`
--

DROP TABLE IF EXISTS `serviceregistration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `serviceregistration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registerID` int(11) NOT NULL,
  `serviceID` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `total` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `serviceregistration`
--

LOCK TABLES `serviceregistration` WRITE;
/*!40000 ALTER TABLE `serviceregistration` DISABLE KEYS */;
INSERT INTO `serviceregistration` VALUES (1,42,5,2,400000),(2,42,11,3,150000),(3,42,12,3,300000),(4,42,13,2,300000),(5,43,11,7,350000),(6,43,7,1,500000),(7,43,10,1,500000),(8,43,12,7,700000),(9,43,13,5,750000),(10,44,11,5,250000),(11,44,12,5,500000),(12,45,5,1,200000),(13,45,8,1,200000),(14,45,11,5,250000),(15,45,12,5,500000),(16,45,13,3,450000),(17,46,5,1,200000),(18,46,11,5,250000),(22,49,5,3,600000),(23,50,5,2,400000),(24,50,11,5,250000),(25,50,5,2,400000),(26,50,8,2,400000),(27,51,6,1,0),(28,51,9,1,300000),(29,53,5,2,400000),(30,53,8,2,400000),(32,56,5,3,600000),(33,58,5,3,600000);
/*!40000 ALTER TABLE `serviceregistration` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-07-13 11:21:16
