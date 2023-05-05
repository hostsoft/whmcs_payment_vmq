
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
-- Table structure for table `pay_order`
--

DROP TABLE IF EXISTS `pay_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pay_order` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `close_date` bigint(20) NOT NULL,
  `create_date` bigint(20) NOT NULL,
  `is_auto` int(11) NOT NULL,
  `notify_url` varchar(255) DEFAULT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `param` varchar(255) DEFAULT NULL,
  `pay_date` bigint(20) NOT NULL,
  `pay_id` varchar(255) DEFAULT NULL,
  `pay_url` varchar(255) DEFAULT NULL,
  `price` double NOT NULL,
  `really_price` double NOT NULL,
  `return_url` varchar(255) DEFAULT NULL,
  `state` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pay_qrcode`
--

DROP TABLE IF EXISTS `pay_qrcode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pay_qrcode` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `pay_url` varchar(255) DEFAULT NULL,
  `price` double NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pay_qrcode`
--

LOCK TABLES `pay_qrcode` WRITE;
/*!40000 ALTER TABLE `pay_qrcode` DISABLE KEYS */;
/*!40000 ALTER TABLE `pay_qrcode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setting`
--

DROP TABLE IF EXISTS `setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setting` (
  `vkey` varchar(255) NOT NULL,
  `vvalue` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`vkey`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setting`
--

LOCK TABLES `setting` WRITE;
/*!40000 ALTER TABLE `setting` DISABLE KEYS */;
INSERT INTO `setting` VALUES ('user','admin'),('pass','admin'),('notifyUrl','https://whmcs8.demo.net/modules/gateways/callback/wanyivmq.php'),('returnUrl','https://whmcs8.demo.net/clientarea.php'),('key','b563ec797026d0cf2c501f4fcc6fe4c8'),('lastheart',''),('lastpay',''),('jkstate',''),('close','5'),('payQf','1'),('wxpay',''),('zfbpay','');
/*!40000 ALTER TABLE `setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tmp_price`
--

DROP TABLE IF EXISTS `tmp_price`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tmp_price` (
  `price` varchar(255) NOT NULL,
  `oid` varchar(255) NOT NULL,
  PRIMARY KEY (`price`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tmp_price`
--

LOCK TABLES `tmp_price` WRITE;
/*!40000 ALTER TABLE `tmp_price` DISABLE KEYS */;
/*!40000 ALTER TABLE `tmp_price` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'vmq_db'
--

--
-- Dumping routines for database 'vmq_db'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-05-05  3:49:44
