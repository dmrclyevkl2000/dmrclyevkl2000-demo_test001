-- MySQL dump 10.17  Distrib 10.3.22-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: jmcms_kswt
-- ------------------------------------------------------
-- Server version	10.3.22-MariaDB-1ubuntu1

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
-- Table structure for table `content`
--

DROP TABLE IF EXISTS `content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content_file` varchar(255) DEFAULT NULL,
  `content_author` varchar(15) DEFAULT NULL,
  `content_type` varchar(63) DEFAULT NULL,
  `content_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `page_title` varchar(127) DEFAULT NULL,
  `page_desc` varchar(255) DEFAULT NULL,
  `page_keywords` varchar(255) DEFAULT NULL,
  `page_content` varchar(12255) DEFAULT NULL,
  `content_hlink` varchar(127) DEFAULT NULL,
  `page_img_large` varchar(63) DEFAULT NULL,
  `page_field1` varchar(127) DEFAULT NULL,
  `page_img_small` varchar(63) DEFAULT NULL,
  `page_field2` varchar(127) DEFAULT NULL,
  `page_img_extra` varchar(255) DEFAULT NULL,
  `page_field3` varchar(127) DEFAULT NULL,
  `published_status` varchar(15) DEFAULT NULL,
  `page_permalink` varchar(127) DEFAULT NULL,
  `theme_control` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1001 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `content`
--

LOCK TABLES `content` WRITE;
/*!40000 ALTER TABLE `content` DISABLE KEYS */;
INSERT INTO `content` VALUES (1,'','admin','article','2013-12-17 10:39:09','sample-article-page-title','sample article page description','keywords go here for sample article page keywords','<p>Coming Soon!</p>','','Untitled.png','test','','','','','pending','','v0.3beta'),(2,'test-video-test','admin','video','2013-10-07 22:42:45','sample-video-page-title','sample video page description','keywords go here for sample video page keywords','Sample Video Page Content is placed here. This is a spiffy example of a sample!',NULL,'Untitled.png',NULL,'',NULL,'VID-20110208-00002_1.flv',NULL,'deactivated','page2','v0.2beta'),(3,'test-video-test','admin','video','2013-12-03 16:06:35','sample-video-page-title','sample video page description','keywords go here for sample video page keywords','Sample Video Page Content is placed here. This is a spiffy example of a sample!',NULL,'fonz.png',NULL,'',NULL,'barsandtone.flv',NULL,'deactivated','page3','v0.3beta'),(4,'test-article-test','admin','article','2013-12-03 16:06:12','sample-article-page-title','sample article page description','keywords go here for sample article page keywords','Sample Article Page Content is placed here. This is a spiffy example of a sample!',NULL,'fonz.png',NULL,'',NULL,'',NULL,'deactivated','page4','v0.3beta'),(5,'test-video-test','admin','video','2013-12-03 16:06:47','sample-video-page-title','sample video page description','keywords go here for sample video page keywords','Sample Video Page Content is placed here. This is a spiffy example of a sample!',NULL,'fonz.png',NULL,'',NULL,'20051210-w50s.flv',NULL,'deactivated','page5','v0.3beta'),(6,'test-article-test','admin','article','2013-12-03 16:06:19','sample-article-page-title','sample article page description','keywords go here for sample article page keywords','Sample Article Page Content is placed here. This is a spiffy example of a sample!',NULL,'fonz.png',NULL,'',NULL,'',NULL,'deactivated','page6','v0.3beta'),(7,'test-article-test','admin','article','2013-12-03 16:06:26','sample-article-page-title','sample article page description','keywords go here for sample article page keywords','Sample Article Page Content is placed here. This is a spiffy example of a sample!',NULL,'fonz.png',NULL,'',NULL,'',NULL,'deactivated','page7','v0.3beta'),(8,'test-article-test','admin','article','2013-10-07 22:42:55','sample-article-page-title','sample article page description','keywords go here for sample article page keywords','Sample Article Page Content is placed here. This is a spiffy example of a sample!',NULL,'image-placeholder.png',NULL,'',NULL,'',NULL,'live','page8','v0.2beta'),(9,'test-article-test','admin','article','2013-10-22 11:08:15','sample-article-page-title','sample article page description','keywords go here for sample article page keywords','Sample Article Page Content is placed here. This is a spiffy example of a sample!',NULL,'Desert.jpg',NULL,'',NULL,'',NULL,'live','page9','v0.3beta'),(54,'','admin','distributor','2013-12-03 16:08:09','page title','page desc','page keywords','PAGE_CONTENT','hlink','asusrog.jpg','alt-tag','Koala.jpg','alt-tag-field2','','','deactivated','page10','v0.3beta'),(55,'','admin','distributor','2013-12-03 16:07:22','page title','page desc','page kw','CONTENT','hlink','asuslogo_555w_150h.jpg','alt-tag','asusrog.jpg','alt-tag-field2','','','deactivated','page11','v0.3beta'),(61,'','admin','distributor','2013-12-03 16:07:12','page title','desc','keyword','content','hlink','asusrog.jpg','alt-tag','ASUS_Wallpaper_by_randesigns.jpg','alt-tag-field2','','','deactivated','page12','v0.3beta'),(69,'','admin','distributor','2013-11-06 16:27:59','page title','desc','kw','page content d','http://www.justinmerrill.com','Penguins.jpg','alt-tag','Koala.jpg','alt-tag-field2','','','live','page13','v0.3beta'),(82,'','admin','distributor','2015-09-24 08:09:43','page title','test','test','Testing','http://fictionorpity.com','asusrog.jpg','alt-tag','asusrog.jpg','testing','','','deactivated','','v0.3beta'),(83,'','admin','distributor','2020-08-25 19:42:54','page title distributor-test','desc distributor-test-existing','distributor-test-existing','distributor-test-existing','','company_logo.jpg','alt-tag-distributor-test-existing','FaKePrEsiDEnT.png','','','','live','','v0.3beta'),(84,'','admin','distributor','2013-11-11 17:11:18','page title','desc','ww','test','','Tulips.jpg','alt-tag','Chrysanthemum.jpg','','','','pending','page16','v0.3beta'),(990,'','admin','distributor','2013-12-17 13:55:13','sample-article-page-title','test','test','Coming Soon! Coming Soon!','','41469_1560998754_4934_n[1].jpg','test','','','','','pending','','v0.3beta'),(991,'','admin','article','2013-12-17 13:57:07','sample-article-page-title','test','test','<p>Coming Soon!</p>','','41469_1560998754_4934_n[1].jpg','test','','','','','pending','','v0.3beta'),(992,'','admin','video','2013-12-17 14:10:40','Have You Seen Us On TV Yet?','K&S Wholesale Tile Television Commercial','K and S Wholesale Tile Television Commercial','Enjoy a Sneak Peek of our Television Commercial, coming soon the the Greater Tampa Bay Area! Regret Nothing! Just Say No To Rugs! Best Prices, Best Selection! Our Prices will FLOOR YOU!\r\n\r\nStop by our show room today, and get the best value on Tile and Flooring Products in Tampa Bay, Florida!','','41469_1560998754_4934_n[1].jpg','K&S Wholesale Tile Television Commercial','','','KS Tile 6F - YouTube1.mp4','','live','','v0.3beta'),(993,'','admin','article','2014-01-17 20:41:48','test','test','test','<p>test</p>\r\n<script>// <![CDATA[\r\nsetTimeout(function(){\r\n                                    //tinymce.activeEditor.setContent(\"some text\");\r\n                                    tinymce.activeEditor.setContent(\"<p>testing</p>\");                                    \r\n                                    }, 1000);\r\n// ]]></script>','','Desert.jpg','test','','','','','pending','','v0.3beta'),(994,'','admin','distributor','2014-01-17 21:42:58','erger','ewqrqw e','wqetqwet','TESTTTTT11111111EG EWG WERG WE G','','Desert.jpg','test','','','','','pending','','v0.3beta'),(995,'','admin','article','2014-01-17 21:40:29','erger','rest','etst','<p>testing</p>','','Jellyfish.jpg','test','','','','','pending','','v0.3beta'),(996,'','admin','article','2014-01-18 00:04:19','cbcb','wetrqw e','weq  fgtweq','<p>testing2134123412341241324</p>','','Koala.jpg','test','','','','','pending','','v0.3beta'),(997,'','admin','article','2015-09-24 21:03:57','testing123','vesrv e srvr vsevesv serv serv esrv serv sedrv sed sbsbsebsdebrvawervawe vaerv ar arv awe','gr gra gaerg rg srgargar gars garg argasgas gsad g g raaasrg sag dfg asdfgas asdg sdg asd gasd gasd gasdgasdg asdg asdg sad gsdg asdgasdg sad sdgsdgsadg asd gasdg sadg asdg sdag sadg asdg s dgsadgasd','<p>testing vsdv sadv sadv sadv sad vsadv sad vsdvsad vas dv</p>','','Favicon.png','just-testing','','','','','deactivated','','v0.3beta'),(999,'','admin','article','2020-08-25 03:15:26','article-test','article-test','article-test','<p>articletest</p>','','company_logo.jpg','article-test','','','','','live','','v0.3beta'),(1000,'','admin','article','2020-08-30 16:24:41','article-test-z','article-test-z','article-test-zarticle-test-z article-test-z article-test-z article-test-z','<p>article-test-zarticle-test-z&nbsp;article-test-z&nbsp; &nbsp;article-test-z</p>','','companylogo.png','article-test-z','','','','','pending','','v0.3beta');
/*!40000 ALTER TABLE `content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `username` varchar(31) NOT NULL,
  `password` varchar(127) NOT NULL,
  `email` varchar(63) NOT NULL,
  `fname` varchar(31) NOT NULL,
  `lname` varchar(31) NOT NULL,
  `position` varchar(31) DEFAULT NULL,
  `access_rights` varchar(15) NOT NULL,
  `first_login` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `password_expires` timestamp NULL DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `security_q` varchar(63) DEFAULT NULL,
  `security_a` varchar(63) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` VALUES (1,1,'admin_starter','$2y$10$HWa6P8Ou5R/1tzA9etoWvO6VyCFB4mOQctbbOnQdwhDSr.U7GLNhq','admin-starter@karakon.us','Admins','Tarter','Developer','admin','2013-11-08 05:37:11','2013-11-08 06:39:48','2023-12-31 23:59:59','1970-12-25','What was the name of your first pet?','Fluffy'),(2,2,'publisher-starter','p@$$w0rD','publisher-starter@karakon.us','Publishers','Tarter','Owner','publisher','2013-11-08 05:46:10','2013-11-08 05:46:10','2023-12-31 23:59:59','1970-12-25','What was the name of your first pet?','Rover'),(3,3,'editor-starter','p@$$w0rD','editor-starter@karakon.us','Editors','Tarter','Employee','editor','2013-11-08 05:52:28','2013-11-08 05:52:29','2023-12-31 23:59:59','1970-12-25','What was the name of your first pet?','Fido');
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-09-12 16:25:18
