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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `block_requests`
--

LOCK TABLES `block_requests` WRITE;
/*!40000 ALTER TABLE `block_requests` DISABLE KEYS */;
INSERT INTO `block_requests` VALUES (17,14,13);
/*!40000 ALTER TABLE `block_requests` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 trigger member_request after insert on block_requests
for each row 
begin
declare count int(10);
declare approved_count int(10);
set count =( select count(*) from users where block_id  = (select block_id from users where id = new.requester_id ) and status = 'confirmed');
set approved_count = (select count(*) from block_requests  group by requester_id having requester_id =  new.requester_id);
if(approved_count = count -1|| approved_count ='3') then
 update users  set status = 'confirmed' where  id = new.requester_id ;
	end if;
    end */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

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
INSERT INTO `blocks` VALUES (1,'34th Street Herald Square',1),(2,'Skyscraper Museum',2),(3,'Hudson Yards',3),(4,'Manhattan Community Board 4 ',3),(5,'Manhattan Community Board 5 ',3),(6,'Canal Street',4),(7,'Grand Street',5),(8,'Tompkins Square Park',6),(9,'East 7 th Street',6),(10,'East 23rd Street',7),(11,'East 16 th Street',10);
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `friend_requests`
--

LOCK TABLES `friend_requests` WRITE;
/*!40000 ALTER TABLE `friend_requests` DISABLE KEYS */;
INSERT INTO `friend_requests` VALUES (2,8,6,'accepted'),(3,7,6,'pending'),(4,9,6,'pending'),(5,6,10,'accepted'),(6,8,10,'pending'),(7,6,11,'accepted');
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `friends`
--

LOCK TABLES `friends` WRITE;
/*!40000 ALTER TABLE `friends` DISABLE KEYS */;
INSERT INTO `friends` VALUES (1,8,6),(2,6,8),(3,6,7),(4,7,6),(5,6,11),(6,11,6),(7,6,10),(8,10,6);
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
  `recipient_type` enum('N','B','C') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `msg_id` (`msg_id`),
  KEY `recipient_id` (`recipient_id`),
  CONSTRAINT `message_recipients_ibfk_1` FOREIGN KEY (`msg_id`) REFERENCES `messages` (`id`),
  CONSTRAINT `message_recipients_ibfk_2` FOREIGN KEY (`recipient_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message_recipients`
--

LOCK TABLES `message_recipients` WRITE;
/*!40000 ALTER TABLE `message_recipients` DISABLE KEYS */;
INSERT INTO `message_recipients` VALUES (8,5,6,''),(9,6,7,''),(13,5,7,'B'),(14,5,7,'B'),(15,5,7,'B'),(16,5,7,'B');
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (5,'Hello Everyone..A warm good morning to all of you',6,'2015-11-23 08:17:00','Good Morning again'),(6,'Hey guys , there has been a  car theft in our neighbourhood.Please be aware.',7,'2015-11-23 09:30:23','Car Theft'),(7,'Hey guys , there was an fire outbreak in our neighbourhood.Hope there are no casualties.',8,'2015-11-23 12:17:34','Fire'),(8,'Hello...there were keys found on Houston Street next to the Old navy outlet.',9,'2015-11-23 14:51:51','Lost Keys'),(12,'Christmas Deals',13,'2015-12-25 00:15:11','Christmas Deals'),(16,'A man was shot by a thief trying to extort money from him near Clinton Street Baking Company',13,'2015-12-25 00:42:26','Murder');
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
INSERT INTO `neighbourhoods` VALUES (1,'6th Ave and 44th St','New York','NY','10001',NULL),(2,'Battery Place','New York','NY','10006',NULL),(3,'Chelsea','New York','NY','10007',NULL),(4,'Lower East Side','New York','NY','10008',NULL),(5,'LoDel','New York','NY','10009',NULL),(6,'East Village','New York','NY','10003',NULL),(7,'Stuyvesant Park','New York','NY','10010',NULL),(8,'Theatre District','New York','NY','10020',NULL),(9,'Midtown West','New York','NY','10021',NULL),(10,'Newport','Jersey City','NJ','07310',NULL),(11,'Pavonia','Jersey City','NJ','07311',NULL),(12,'West Slope','Jersey City','NJ','07307',NULL),(13,'Jersey City Heights','Jersey City','NJ','07308',NULL),(14,'Wall Street West','Jersey City','NJ','07309',NULL),(15,'West Journal Square','Jersey City','NJ','07306',NULL),(16,'Grove Street','Jersey City','NJ','07302',NULL),(17,'Bergen Country','Jersey City','NJ','07303',NULL),(18,'Park Ridge','Jersey City','NJ','07656',NULL),(19,'Claremont','Jersey City','NJ','07304',NULL),(20,'Lafayette','Jersey City','NJ','07305','');
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
  `path` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profiles`
--

LOCK TABLES `profiles` WRITE;
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
INSERT INTO `profiles` VALUES (1,13,'Hi, My name is Curtis Hays  and I reside in Lodel  neighbourhood since 5 years.I wish to join Houston Street bock since my house is on Houston Street.I am alawyer by profession.I love to make friends and I love NYC',NULL),(2,12,'Hi, My name is Zoe Blevins  and I reside in Lodel  neighbourhood since 5 years.I wish to join Houston Street bock since my house is on Houston Street.I am a programmer by profession.I love to make friends and I love NYC',NULL),(7,7,'Thsi is super awesome',NULL),(8,6,'This is about me',NULL);
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
  `zip` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `hood_id` (`hood_id`),
  KEY `block_id` (`block_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`hood_id`) REFERENCES `neighbourhoods` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (6,'adm','avani09@gmail.com','Xera123','Avani','Shah','2015-10-10 00:00:00','2015-11-10 00:00:00',2,2,'2011234563','confirmed',NULL),(7,'mpatel','mpatel08@yahoo.com','UYBn678','Mansi','Patel','2014-10-15 00:00:00','2015-11-17 00:00:00',2,2,'7321234567','confirmed',NULL),(8,'psekar','ppriyas@gmail.com','hello178','Priya','Sekar','2015-08-13 00:00:00','2015-11-19 00:00:00',3,3,'6178909876','confirmed',NULL),(9,'cshah','chirag25@gmail.com','TRGy56q','Chirag','Shah','2014-09-10 00:00:00','2015-11-20 00:00:00',4,6,'9187680935','confirmed',NULL),(10,'mjoe','mark_joe@gmail.com','treAAq','Mark','Jose','2014-12-25 00:00:00','2015-11-12 00:00:00',4,7,'7180982345','confirmed',NULL),(11,'spatel','sp@mailinator.com','bfjasdfksf','Shivam','Patel','2014-10-15 00:00:00','2015-11-20 00:00:00',3,3,'4586321568','confirmed',NULL),(12,'zblevins','zoe@mailinator.com','fsafdas@455fds','Zoe','Blevins','2014-10-15 00:00:00','2015-11-12 00:00:00',4,6,'5896321458','pending',NULL),(13,'chays','curtis@mailinator','fdasfa(493489fdsfask','Curtis','Hays','2014-10-15 00:00:00','2015-11-12 00:00:00',4,7,'8652134568','confirmed',NULL),(14,'hulk','danielm@gmail.com','DMMd','Daniel','Mugglin','2015-12-23 17:41:36','2015-11-18 00:00:00',4,7,'7134322356','confirmed',NULL),(35,'mp3950@nyu.edu','mp3950@nyu.edu','pass','Mansi','Patel','2015-12-25 05:43:05','2015-12-25 05:43:05',10,11,NULL,'pending','7310'),(37,'kalidas','kalidas@mailinator.com','password','Kalidas','sddds','2015-12-25 08:30:53','2015-12-25 08:30:53',10,11,NULL,'pending','7310');
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

-- Dump completed on 2015-12-25 11:56:52
