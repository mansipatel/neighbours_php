-- MySQL dump 10.13  Distrib 5.5.44, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: neighbours
-- ------------------------------------------------------
-- Server version	5.5.44-0ubuntu0.14.04.1

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
-- Table structure for table `block_requests`
--

DROP TABLE IF EXISTS `block_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `block_requests` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `requester_id` int(11) unsigned NOT NULL,
  `approver_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `block_requests_ibfk_1` (`requester_id`),
  KEY `FK_block_req_app` (`approver_id`),
  CONSTRAINT `FK_block_req_app` FOREIGN KEY (`approver_id`) REFERENCES `users` (`id`),
  CONSTRAINT `block_requests_ibfk_1` FOREIGN KEY (`requester_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `block_requests`
--

LOCK TABLES `block_requests` WRITE;
/*!40000 ALTER TABLE `block_requests` DISABLE KEYS */;
INSERT INTO `block_requests` VALUES (10,9,NULL),(11,6,NULL);
/*!40000 ALTER TABLE `block_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blocks`
--

DROP TABLE IF EXISTS `blocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blocks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `block_address` varchar(255) NOT NULL,
  `hood_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hood_id` (`hood_id`),
  CONSTRAINT `blocks_ibfk_1` FOREIGN KEY (`hood_id`) REFERENCES `neighbourhoods` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blocks`
--

LOCK TABLES `blocks` WRITE;
/*!40000 ALTER TABLE `blocks` DISABLE KEYS */;
INSERT INTO `blocks` VALUES (1,'34th Street Herald Square',1),(2,'Skyscraper Museum',2),(3,'Hudson Yards',3),(4,'Manhattan Community Board 4 ',3),(5,'Manhattan Community Board 5 ',3),(6,'Canal Street',4),(7,'Grand Street',5),(8,'Tompkins Square Park',6),(9,'East 7 th Street',6),(10,'East 23rd Street',7),(11,'East 16 th Street',7);
/*!40000 ALTER TABLE `blocks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `friend_requests`
--

DROP TABLE IF EXISTS `friend_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `friend_requests` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `sender_id` int(11) unsigned DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `sender_id` (`sender_id`),
  CONSTRAINT `friend_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `friend_requests_ibfk_2` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `friend_requests`
--

LOCK TABLES `friend_requests` WRITE;
/*!40000 ALTER TABLE `friend_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `friend_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `friends`
--

DROP TABLE IF EXISTS `friends`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `friends` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `friend_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `friend_id` (`friend_id`),
  CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`friend_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `friends`
--

LOCK TABLES `friends` WRITE;
/*!40000 ALTER TABLE `friends` DISABLE KEYS */;
/*!40000 ALTER TABLE `friends` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message_recipients`
--

DROP TABLE IF EXISTS `message_recipients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message_recipients` (
  `id` bigint(8) unsigned NOT NULL AUTO_INCREMENT,
  `msg_id` bigint(8) unsigned NOT NULL,
  `recipient_id` int(11) unsigned NOT NULL,
  `recipient_type` enum('hood','block','custom') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `msg_id` (`msg_id`),
  KEY `recipient_id` (`recipient_id`),
  CONSTRAINT `message_recipients_ibfk_1` FOREIGN KEY (`msg_id`) REFERENCES `messages` (`id`),
  CONSTRAINT `message_recipients_ibfk_2` FOREIGN KEY (`recipient_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message_recipients`
--

LOCK TABLES `message_recipients` WRITE;
/*!40000 ALTER TABLE `message_recipients` DISABLE KEYS */;
INSERT INTO `message_recipients` VALUES (8,5,6,'block'),(9,6,7,'hood');
/*!40000 ALTER TABLE `message_recipients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` bigint(8) unsigned NOT NULL AUTO_INCREMENT,
  `msg_text` text NOT NULL,
  `msg_by` int(11) unsigned NOT NULL,
  `msg_time` datetime NOT NULL,
  `msg_title` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `msg_by` (`msg_by`),
  CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`msg_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (5,'Hello Everyone..A warm good morning to all of you',6,'2015-11-23 08:17:00','Good Morning again'),(6,'Hey guys , there has been a  car theft in our neighbourhood.Please be aware.',7,'2015-11-23 09:30:23','Car Theft'),(7,'Hey guys , there was an fire outbreak in our neighbourhood.Hope there are no casualties.',8,'2015-11-23 12:17:34','Fire'),(8,'Hello...there were keys found on Houston Street next to the Old navy outlet.',9,'2015-11-23 14:51:51','Lost Keys');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `neighbourhoods`
--

DROP TABLE IF EXISTS `neighbourhoods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `neighbourhoods` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `hood_address` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `hood_description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `neighbourhoods`
--

LOCK TABLES `neighbourhoods` WRITE;
/*!40000 ALTER TABLE `neighbourhoods` DISABLE KEYS */;
INSERT INTO `neighbourhoods` VALUES (1,'6th Ave and 44th St','New York','NY','10001',NULL),(2,'Battery Place','New York','NY','10001',NULL),(3,'Chelsea','New York','NY','10001',NULL),(4,'Lower East Side','New York','NY','10002',NULL),(5,'LoDel','New York','NY','10002',NULL),(6,'East Village','New York','NY','10003',NULL),(7,'Stuyvesant Park','New York','NY','10010',NULL),(8,'Theatre District','New York','NY','10020',NULL),(9,'Midtown West','New York','NY','10020',NULL),(10,'Newport','Jersey City','NJ','07310',NULL),(11,'Pavonia','Jersey City','NJ','07310',NULL),(12,'West Slope','Jersey City','NJ','07307',NULL),(13,'Jersey City Heights','Jersey City','NJ','07307',NULL),(14,'Wall Street West','Jersey City','NJ','07311',NULL),(15,'West Journal Square','Jersey City','NJ','07306',NULL),(16,'Grove Street','Jersey City','NJ','07302',NULL),(17,'Bergen Country','Jersey City','NJ','07303',NULL),(18,'Park Ridge','Jersey City','NJ','07656',NULL),(19,'Claremont','Jersey City','NJ','07304',NULL),(20,'Lafayette','Jersey City','NJ','07304',NULL);
/*!40000 ALTER TABLE `neighbourhoods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `neighbours`
--

DROP TABLE IF EXISTS `neighbours`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `neighbours` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `neighbour_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `neighbour_id` (`neighbour_id`),
  CONSTRAINT `neighbours_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `neighbours_ibfk_2` FOREIGN KEY (`neighbour_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `neighbours`
--

LOCK TABLES `neighbours` WRITE;
/*!40000 ALTER TABLE `neighbours` DISABLE KEYS */;
INSERT INTO `neighbours` VALUES (1,6,7),(2,8,11),(3,10,12),(4,10,13);
/*!40000 ALTER TABLE `neighbours` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profiles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `profile_desc` text,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profiles`
--

LOCK TABLES `profiles` WRITE;
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
INSERT INTO `profiles` VALUES (1,13,'Hi, My name is Curtis Hays  and I reside in Lodel  neighbourhood since 5 years.I wish to join Houston Street bock since my house is on Houston Street.I am alawyer by profession.I love to make friends and I love NYC'),(2,12,'Hi, My name is Zoe Blevins  and I reside in Lodel  neighbourhood since 5 years.I wish to join Houston Street bock since my house is on Houston Street.I am a programmer by profession.I love to make friends and I love NYC');
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `threads`
--

DROP TABLE IF EXISTS `threads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `threads` (
  `id` bigint(8) unsigned NOT NULL AUTO_INCREMENT,
  `msg_id` bigint(8) unsigned NOT NULL,
  `thread_time` datetime NOT NULL,
  `thread_by` int(11) unsigned NOT NULL,
  `thread_text` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `msg_id` (`msg_id`),
  KEY `thread_by` (`thread_by`),
  CONSTRAINT `threads_ibfk_1` FOREIGN KEY (`msg_id`) REFERENCES `messages` (`id`),
  CONSTRAINT `threads_ibfk_2` FOREIGN KEY (`thread_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `threads`
--

LOCK TABLES `threads` WRITE;
/*!40000 ALTER TABLE `threads` DISABLE KEYS */;
INSERT INTO `threads` VALUES (1,5,'2015-11-23 15:41:15',8,'I recently lost my keys.Can you send me apic of those keys so i know If they are mine or not.');
/*!40000 ALTER TABLE `threads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(64) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `creation_date` datetime NOT NULL,
  `last_login_time` datetime NOT NULL,
  `hood_id` int(11) unsigned NOT NULL,
  `block_id` int(11) unsigned NOT NULL,
  `phone_num` varchar(20) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hood_id` (`hood_id`),
  KEY `block_id` (`block_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`hood_id`) REFERENCES `neighbourhoods` (`id`),
  CONSTRAINT `users_ibfk_2` FOREIGN KEY (`block_id`) REFERENCES `blocks` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (6,'adm','avani09@gmail.com','Xera123','Avani','Shah','2015-10-10 00:00:00','2015-11-10 00:00:00',2,2,'2011234563',NULL),(7,'mpatel','mpatel08@yahoo.com','UYBn678','Mansi','Patel','2014-10-15 00:00:00','2015-11-17 00:00:00',2,2,'7321234567',NULL),(8,'psekar','ppriyas@gmail.com','hello178','Priya','Sekar','2015-08-13 00:00:00','2015-11-19 00:00:00',3,3,'6178909876',NULL),(9,'cshah','chirag25@gmail.com','TRGy56q','Chirag','Shah','2014-09-10 00:00:00','2015-11-20 00:00:00',4,6,'9187680935',NULL),(10,'mjoe','mark_joe@gmail.com','treAAq','Mark','Jose','2014-12-25 00:00:00','2015-11-12 00:00:00',4,7,'7180982345',NULL),(11,'spatel','sp@mailinator.com','bfjasdfksf','Shivam','Patel','2014-10-15 00:00:00','2015-11-20 00:00:00',3,3,'4586321568',NULL),(12,'zblevins','zoe@mailinator.com','fsafdas@455fds','Zoe','Blevins','2014-10-15 00:00:00','2015-11-12 00:00:00',4,6,'5896321458',NULL),(13,'chays','curtis@mailinator','fdasfa(493489fdsfask','Curtis','Hays','2014-10-15 00:00:00','2015-11-12 00:00:00',4,7,'8652134568',NULL);
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

-- Dump completed on 2015-12-25  1:09:10
