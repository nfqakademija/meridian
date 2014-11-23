-- MySQL dump 10.13  Distrib 5.5.40, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: meridian
-- ------------------------------------------------------
-- Server version	5.5.40-0ubuntu0.14.04.1-log

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
-- Table structure for table `Answer`
--

DROP TABLE IF EXISTS `Answer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `answer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Answer`
--

LOCK TABLES `Answer` WRITE;
/*!40000 ALTER TABLE `Answer` DISABLE KEYS */;
INSERT INTO `Answer` VALUES (1,'4','no','no'),(2,'Kaunas','no','no'),(3,'TAIP','no','no'),(4,'TESTAS','TEST','TSTSD'),(5,'t1','t','t'),(6,'t1','t','t'),(7,'t1','t','t'),(8,'t1','t','t'),(9,'t1','t','t'),(10,'t1','t','t'),(11,'t1','t','t'),(12,'t1','t','t'),(13,'t1','t','t'),(14,'t1','t','t'),(15,'t1','t','t'),(16,'t1','t','t'),(17,'t1','t','t'),(18,'t1','t','t'),(19,'t1','t','t'),(20,'t1','t','t'),(21,'a2','a2','a2'),(22,'t3','t3','t3');
/*!40000 ALTER TABLE `Answer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Expo`
--

DROP TABLE IF EXISTS `Expo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Expo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Expo`
--

LOCK TABLES `Expo` WRITE;
/*!40000 ALTER TABLE `Expo` DISABLE KEYS */;
INSERT INTO `Expo` VALUES (1,'Kauno bienalė parodoje „Laiko drobulė“ pristato naująją lietuvių tekstilės kolekciją','Kauno paveikslų galerija, K. Donelaičio g. 16, Kaunas','2014 m. lapkričio 14 d. – 2015 m. sausio 11 d.','http://www.muziejai.lt/Tarnybos/Reng_infon.asp?txtKodas=11978&txtVieta=0&txtPobud=0'),(2,'Paulinos Pukytės paroda „Mergaitės ir berniukai“','Marijos ir Jurgio Šlapelių namas-muziejus, Pilies g. 40, Vilnius','2014 m. lapkričio 14 d. 17 val.  – gruodžio 2 d. 17 val. ','http://www.muziejai.lt/Tarnybos/Reng_infon.asp?txtKodas=11984&txtVieta=0&txtPobud=0'),(3,'Paroda „Algis Kasparavičus. Ex Oriente Lux“','Antano Mončio namai-muziejus, S. Daukanto g. 16, Palanga','2014 m. lapkričio 8 d. – gruodžio 11 d.','http://www.muziejai.lt/Tarnybos/Reng_infon.asp?txtKodas=11962&txtVieta=0&txtPobud=0'),(4,'Antano Gudaičio (1904–1989) piešinių ir estampų paroda „Žmonės žiūri į žvaigždes“, skirta  dailininko 110-osioms gimimo metinėms','A. Žmuidzinavičiaus kūrinių ir rinkinių muziejus, V. Putvinskio g. 64, Kaunas','2014 m. lapkričio 7 d. – gruodžio 7 d.','http://www.muziejai.lt/Tarnybos/Reng_infon.asp?txtKodas=11970&txtVieta=0&txtPobud=0'),(5,'Agnės Juškaitės tapybos paroda iš ciklo „Menas senuosiuose Lietuvos dvaruose“','Ryšių istorijos muziejus, Rotušės a. 19, Kaunas','2014 m. lapkričio 6 d. 18 val.  – gruodžio 8 d.','http://www.muziejai.lt/Tarnybos/Reng_infon.asp?txtKodas=11974&txtVieta=0&txtPobud=0'),(6,'Fotografijų paroda „Iš nežinios į nežinią: Antrojo pasaulinio karo atbėgėliai Lietuvoje“ ','Nacionalinis M. K. Čiurlionio dailės muziejus, V. Putvinskio g. 55, Kaunas','2014 m. lapkričio 6 d. – 2015 m. sausio 18 d.','http://www.muziejai.lt/Tarnybos/Reng_infon.asp?txtKodas=11969&txtVieta=0&txtPobud=0'),(7,'Paroda „Būti ar nebūti“ Viljamo Šekspyro 450-osioms gimimo metinėms ir Teatro metams paminėti','Lietuvos teatro, muzikos ir kino muziejus, Vilniaus g. 41, Vilnius','2014 m. lapkričio 6 d. – 2015 m. sausio 19 d.','http://www.muziejai.lt/Tarnybos/Reng_infon.asp?txtKodas=11966&txtVieta=0&txtPobud=0'),(8,'Alionos Bondarenko fotografijos paroda „Gyvenimas – akimirka“','Lietuvos teatro, muzikos ir kino muziejus, Vilniaus g. 41, Vilnius','2014 m. spalio 29 d. 18 val.  – 2015 m. sausio 17 d. 16 val. ','http://www.muziejai.lt/Tarnybos/Reng_infon.asp?txtKodas=11940&txtVieta=0&txtPobud=0'),(9,'Paroda „Viva Verdi“','Lietuvos teatro, muzikos ir kino muziejus, Vilniaus g. 41, Vilnius','2013 m. gruodžio 18 d. 17 val.  – 2014 m. lapkričio 25 d. 18 val. ','http://www.muziejai.lt/Tarnybos/Reng_infon.asp?txtKodas=10962&txtVieta=0&txtPobud=0'),(10,'Paroda „Lietuvių duona. Su savo kepalėliu visur stalą rasi“ ','Povilo Stulgos lietuvių tautinės muzikos instrumentų muziejus, L. Zamenhofo g. 12, Kaunas','2014 m. lapkričio 5 d. 15 val.  – lapkričio 29 d. 17 val. ','http://www.muziejai.lt/Tarnybos/Reng_infon.asp?txtKodas=11971&txtVieta=0&txtPobud=0'),(11,'Paroda „Žvilgsnis į Prahą per slaptosios policijos objektyvą“','Tuskulėnų rimties parko memorialinis kompleksas, Žirmūnų g. 1F, Vilnius','2014 m. lapkričio 5 d. 16 val.  – gruodžio 31 d.','http://www.muziejai.lt/Tarnybos/Reng_infon.asp?txtKodas=11956&txtVieta=0&txtPobud=0'),(12,'Vytenio Jako tapybos paroda „ant juodo“ ','Kauno pilis, Pilies g. 17, Kaunas','2014 m. lapkričio 5 d. – lapkričio 29 d.','http://www.muziejai.lt/Tarnybos/Reng_infon.asp?txtKodas=11954&txtVieta=0&txtPobud=0'),(13,'Paroda „Mikalojus Povilas Vilutis“','Vilniaus dailės akademijos muziejus, Maironio g. 6, VilniusRenginio vieta:  VDA parodų salės „Titanikas“','2014 m. spalio 30 d. 18 val.  – lapkričio 29 d. 18 val. ','http://www.muziejai.lt/Tarnybos/Reng_infon.asp?txtKodas=11976&txtVieta=0&txtPobud=0'),(14,'VI-osios Lietuvos tekstilės meno bienalės paroda „TEXTILĖ X” ','Janinos Monkutės-Marks muziejus-galerija, J. Basanavičiaus g. 45, Kėdainiai','2014 m. spalio 24 d. 17 val.  – lapkričio 30 d. 15 val. ','http://www.muziejai.lt/Tarnybos/Reng_infon.asp?txtKodas=11923&txtVieta=0&txtPobud=0'),(15,'Norberto Stankevičiaus fotografijų paroda „Kristijonas Donelaitis ir Mažosios Lietuvos kultūrinis palikimas“','Mažosios Lietuvos istorijos muziejus, Didžioji Vandens g. 6, Klaipėda','2014 m. spalio 24 d. 16 val.  – lapkričio 22 d.','http://www.muziejai.lt/Tarnybos/Reng_infon.asp?txtKodas=11929&txtVieta=0&txtPobud=0'),(16,'Paroda „Telesforas Valius (1914–1977). Grafika“','LDM Vytauto Kasiulio dailės muziejus , A. Goštauto g. 1, Vilnius','2014 m. spalio 16 d. – 2015 m. sausio 18 d.','http://www.muziejai.lt/Tarnybos/Reng_infon.asp?txtKodas=11906&txtVieta=0&txtPobud=0'),(17,'Akvilinos Kripaitytės autorinė keramikos ir tapybos kūrinių paroda','A. ir P. Galaunių namai, Vydūno al. 2, Kaunas','2014 m. rugsėjo 26 d. – lapkričio 28 d.','http://www.muziejai.lt/Tarnybos/Reng_infon.asp?txtKodas=11859&txtVieta=0&txtPobud=0'),(18,'Paroda „Gyvename viltimi: Prezidentas Antanas Smetona egzilyje“','Istorinė LR Prezidentūra, Vilniaus g. 33, Kaunas','2014 m. rugpjūčio 7 d. – 2015 m. vasario 22 d.','http://www.muziejai.lt/Tarnybos/Reng_infon.asp?txtKodas=11727&txtVieta=0&txtPobud=0'),(19,'Paroda „Užtrauksim naują giesmę broliai“, skirta Dainų šventės 90-mečiui paminėti','M. ir K. Petrauskų lietuvių muzikos muziejus, K. Petrausko g. 31, Kaunas','2014 m. liepos 11 d. 15 val.  – 2015 m. liepos 11 d.','http://www.muziejai.lt/Tarnybos/Reng_infon.asp?txtKodas=11655&txtVieta=0&txtPobud=0'),(20,'Paroda „Laiko spiralė“','LDM Laikrodžių muziejus, Liepų g. 12, Klaipėda','2014 m. birželio 12 d. 17 val.  – 2015 m. kovo 1 d.','http://www.muziejai.lt/Tarnybos/Reng_infon.asp?txtKodas=11504&txtVieta=0&txtPobud=0'),(21,'Paroda „Neatskleista Vytauto Igno kūrybos esatis“, skirta 90-osioms menininko gimimo metinėms',' Kauno arkivyskupijos muziejuje (Valančiaus g. 6, II aukštas) ','2014 m. gegužės 21 d. – 2015 m. gegužės 1 d.','http://www.muziejai.lt/Tarnybos/Reng_infon.asp?txtKodas=11485&txtVieta=0&txtPobud=0'),(22,'Ilgalaikė paroda „Šviesos link...“','Kauno miesto muziejus, M. Valančiaus g. 6, Kaunas','2014 m. gegužės 17 d. 15 val.  – 2015 m. birželio 5 d.','http://www.muziejai.lt/Tarnybos/Reng_infon.asp?txtKodas=11451&txtVieta=0&txtPobud=0'),(23,'Paroda „Miesto gatvė“','Kauno miesto muziejus, M. Valančiaus g. 6, Kaunas','Nuo 2013 m. rugsėjo 1 d.','http://www.muziejai.lt/Tarnybos/Reng_infon.asp?txtKodas=10608&txtVieta=0&txtPobud=0'),(24,'Paroda „Senųjų ikonų paslaptys. Andrejaus Balyko ikonų kolekcija: pagrobta, grąžinta, papildyta“  ','LDM Radvilų rūmų muziejus, Vilniaus g. 24, Vilnius','2014 m. balandžio 29 d. – 2015 m. balandžio 26 d.','http://www.muziejai.lt/Tarnybos/Reng_infon.asp?txtKodas=11388&txtVieta=0&txtPobud=0'),(25,'Paroda „Kristijonui Donelaičiui – 300“','Maironio lietuvių literatūros muziejus, Rotušės a. 13, Kaunas','2014 m. sausio 14 d. – gruodžio 31 d.','http://www.muziejai.lt/Tarnybos/Reng_infon.asp?txtKodas=11006&txtVieta=0&txtPobud=0'),(26,'Maironio jubiliejui skirta paroda „...palieku visą mano judomąjį turtą...“','Maironio lietuvių literatūros muziejus, Rotušės a. 13, Kaunas','Nuo 2012 m. spalio 22 d.','http://www.muziejai.lt/Tarnybos/Reng_infon.asp?txtKodas=9339&txtVieta=0&txtPobud=0'),(27,'Kilnojamoji paroda „Klaipėdos krašto sukilimui – 90“','Vytauto Didžiojo karo muziejus, K. Donelaičio g. 64, Kaunas','2013 m. sausio 11 d. 10 val.  – 2014 m. gruodžio 22 d.','http://www.muziejai.lt/Tarnybos/Reng_infon.asp?txtKodas=9623&txtVieta=0&txtPobud=0'),(28,'Ekspozicija „Diplomatijos tarnyba 1918–1940m.“','LNM Naujasis arsenalas, Arsenalo g. 1, Vilnius','Nuo 2012 m. kovo 1 d.','http://www.muziejai.lt/Tarnybos/Reng_infon.asp?txtKodas=8199&txtVieta=0&txtPobud=0');
/*!40000 ALTER TABLE `Expo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Game`
--

DROP TABLE IF EXISTS `Game`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Game`
--

LOCK TABLES `Game` WRITE;
/*!40000 ALTER TABLE `Game` DISABLE KEYS */;
INSERT INTO `Game` VALUES (1,'Demo Game','','',''),(2,'Second Game',NULL,NULL,'0'),(3,'Trecias',NULL,NULL,'0'),(4,'Ketvirtas','nera','cia bus ketvirtas zaidimas','0');
/*!40000 ALTER TABLE `Game` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `GameQuestion`
--

DROP TABLE IF EXISTS `GameQuestion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GameQuestion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gameId` int(11) NOT NULL,
  `questionId` int(11) NOT NULL,
  `positionInGame` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B63A6EB2EC55B7A4` (`gameId`),
  KEY `IDX_B63A6EB24B476EBA` (`questionId`),
  CONSTRAINT `FK_B63A6EB24B476EBA` FOREIGN KEY (`questionId`) REFERENCES `Question` (`id`),
  CONSTRAINT `FK_B63A6EB2EC55B7A4` FOREIGN KEY (`gameId`) REFERENCES `Game` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GameQuestion`
--

LOCK TABLES `GameQuestion` WRITE;
/*!40000 ALTER TABLE `GameQuestion` DISABLE KEYS */;
INSERT INTO `GameQuestion` VALUES (1,2,1,1),(2,2,2,2),(5,2,3,3),(6,2,4,4),(7,2,5,5),(8,2,6,6),(9,2,7,7),(10,2,8,8),(11,2,9,9),(12,2,10,10),(13,3,11,1),(14,3,12,2),(15,3,13,3),(16,3,14,4),(17,3,22,5),(18,3,21,6),(19,3,19,7),(20,3,18,8),(21,3,17,9),(22,3,16,10),(23,4,22,1),(24,4,21,2),(25,4,19,3),(26,4,18,4),(27,4,17,5),(28,4,16,6);
/*!40000 ALTER TABLE `GameQuestion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Question`
--

DROP TABLE IF EXISTS `Question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `answerId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_4F812B185447E146` (`answerId`),
  CONSTRAINT `FK_4F812B185447E146` FOREIGN KEY (`answerId`) REFERENCES `Answer` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Question`
--

LOCK TABLES `Question` WRITE;
/*!40000 ALTER TABLE `Question` DISABLE KEYS */;
INSERT INTO `Question` VALUES (1,'Kiek kojų turi šuo?','no','aprašymas',1),(2,'Lietuvos Laikinoji sostinė?','no','aprašymas',2),(3,'Ar tu pasiruošęs rimtiems IŠŠŪKIAMS?!!!','no','aprašymas',3),(4,'testas','JBJ','test',4),(5,'t1','t','t',5),(6,'t1','t','t',6),(7,'t1','t','t',7),(8,'t1','t','t',8),(9,'t1','t','t',9),(10,'t1','t','t',10),(11,'t1','t','t',11),(12,'t1','t','t',12),(13,'t1','t','t',13),(14,'t1','t','t',14),(15,'t1','t','t',15),(16,'t1','t','t',16),(17,'t1','t','t',17),(18,'t1','t','t',18),(19,'t1121654165165','knaskldn','tttt',19),(21,'t2','t2','t2',21),(22,'t3','t3','t3',22);
/*!40000 ALTER TABLE `Question` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fos_user`
--

DROP TABLE IF EXISTS `fos_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `lastEdited` datetime NOT NULL,
  `scores` int(11) DEFAULT '0',
  `level` int(11) DEFAULT '1',
  `gameId` int(11) DEFAULT '2',
  `profilePicturePath` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `positionInGame` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`),
  KEY `IDX_957A6479EC55B7A4` (`gameId`),
  CONSTRAINT `FK_957A6479EC55B7A4` FOREIGN KEY (`gameId`) REFERENCES `Game` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fos_user`
--

LOCK TABLES `fos_user` WRITE;
/*!40000 ALTER TABLE `fos_user` DISABLE KEYS */;
INSERT INTO `fos_user` VALUES (1,'darius','darius','aaaaa@yahoo.com','aaaaa@yahoo.com',1,'foc35caco2048o0c00gg8w00c04o4gk','kOVFoLVfE0qjf8ZwXGnZ+4oBhgc80E1urkpE2AFMQA9mtVfT9i9g/G7lu0dNMB9AjRlafSskLYTUrz64f/By7Q==','2014-11-22 13:41:52',0,0,NULL,'BW-DADe5Z2bkwx3Q7GB6-u15rxY0qeQOtGmeb5kJJlI',NULL,'a:1:{i:0;s:10:\"ROLE_ADMIN\";}',0,NULL,'2014-11-22 13:41:52',1,1,2,NULL,1),(2,'aaa','aaa','aaa@yahoo.com','aaa@yahoo.com',1,'plsbz4qvhs040cgk84g88o8088wog08','+b5gyPpY6pljTZxUyOT/del84bg/xcTlHW+UISYD6NGbzz/U09vVMAM40i3f0hIC7PMOd3Au5Tb7wGgtxqS+Sg==','2014-11-21 23:46:41',0,0,NULL,'_7IgCkTSrsOIKg1oSICa26-FMqqJXpyVdVtAUwYt1BQ',NULL,'a:0:{}',0,NULL,'2014-11-21 23:46:41',18,3,4,NULL,7),(3,'bbb','bbb','bbb@yahoo.com','bbb@yahoo.com',1,'j7fbom41kls8s4w0k04kog4wscw4wg8','rCUXDc5oZ7oK3q3l3lfVbz2j+MvChN9mRxkwP5gNiDxCb4bMEeaYSUGosNPgiCIFWZd5KRLggkW2+oiN65Wwww==','2014-11-21 23:18:54',0,0,NULL,'KI_GrQYo1stZhgbG0d3PFU4qZgUbvT20fe8UsM2ctwE',NULL,'a:0:{}',0,NULL,'2014-11-21 23:18:54',110,3,NULL,'36dc7636b00c3ca19ca2449ada500fb3.jpeg',1),(4,'ccc','ccc','ccc@yahoo.com','ccc@yahoo.com',1,'owc5r4arajkg80gccgk8o48ocos4sc0','nT0qE2w42muUxLjsqeXTeiflTS+//7m1bsfx/MFtyXvGUi4vDy3L//V6izPWyYFr4hZkwaY5Qxs5vpfXFsn5CA==','2014-11-22 13:52:18',0,0,NULL,'ThKdr6ECoP6pKiTd_vBUATPrbax1sVgoU0fh3s_3OjU',NULL,'a:0:{}',0,NULL,'2014-11-22 13:52:18',4,2,3,'bce567879fa64c86e7e07cf8f4e606d3.png',1),(5,'ddd','ddd','ddd@yahoo.com','ddd@yahoo.com',1,'cxjephoo50gk4os8ocsgsoc8s0w8kws','5xLePcVb7FLN2NB4Y8po4l0Ppo1JN1rTbgx6Xh3gn07XjpHn4A3LsAEHIWlnScnRvcrLTuNp4QH/cea/jpZH2Q==',NULL,0,0,NULL,'e9r_l9n6qdOiwADe14phV-6x862ozCzWw9FNv1v4tWQ',NULL,'a:0:{}',0,NULL,'2014-11-16 14:32:16',5,1,2,NULL,1);
/*!40000 ALTER TABLE `fos_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-11-22 13:57:46