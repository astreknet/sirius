-- MariaDB dump 10.19  Distrib 10.9.3-MariaDB, for osx10.18 (arm64)
--
-- Host: localhost    Database: lsn
-- ------------------------------------------------------
-- Server version	10.9.3-MariaDB

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
-- Table structure for table `accident`
--

DROP TABLE IF EXISTS `accident`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accident` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trip_id` int(10) unsigned NOT NULL,
  `datetime` datetime NOT NULL,
  `place` varchar(150) NOT NULL,
  `description` varchar(300) NOT NULL,
  `customer_erp_link` varchar(9) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_address` varchar(150) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `sm_reg_n` varchar(27) DEFAULT NULL,
  `sm_model` varchar(30) DEFAULT NULL,
  `waiver` tinyint(1) DEFAULT 0,
  `total_euro` decimal(8,2) DEFAULT NULL,
  `total_paid` decimal(8,2) DEFAULT NULL,
  `injury` varchar(300) DEFAULT NULL,
  `first_aid_by_staff` tinyint(1) DEFAULT 0,
  `hospital_offer` tinyint(1) DEFAULT 0,
  `hospital_visit` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `fk_accident_trip` (`trip_id`),
  CONSTRAINT `fk_accident_trip` FOREIGN KEY (`trip_id`) REFERENCES `trip` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accident`
--

LOCK TABLES `accident` WRITE;
/*!40000 ALTER TABLE `accident` DISABLE KEYS */;
INSERT INTO `accident` VALUES
(1,18,'2022-03-02 13:15:00','kljhkgj','\'lk;jh','22','lhkj','\';ljk','jhgjkg','','',0,0.00,0.00,'',NULL,0,0),
(2,11,'2022-02-27 23:30:00','carracuca','carrraculandia','59164','jose','alvarez juncal','hugo@astrek.net','333, 999','rangeri',0,900.00,150.00,'no sabra',NULL,0,0),
(3,13,'2022-03-02 09:00:00','palopää','hit a tree','64913','louise','armstrong','hast@protonmail.com','332','rangeri',0,1200.00,150.00,'',0,0,0),
(4,18,'2022-03-02 13:15:00','siitio nuevo','hostia como campana','64913','jjose','alvarez','jjuncal@mataordetorh.com','rt-456, ww-432','',1,1500.00,150.00,'',0,0,0);
/*!40000 ALTER TABLE `accident` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feedback` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `subject` varchar(150) NOT NULL,
  `text` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
INSERT INTO `feedback` VALUES
(1,'2019-12-27 13:10:49','Safariraportti koska reittisuunnitelma jäi tekemättä...','FIT Fishing experience by snowmobile 27.12.2019\r\n\r\n1907859 Paul Monks oli maksanut lapsista aikuisen hinnan jotta ne voisi olla kelkassa matkustajina. Klubilla näin että 10v poika oli aika pienikokoinen, joten &quot;varoitin&quot; isää että se ei välttämättä onnistu, ja niinhän siinä kävi kuin kokeiltiin kelkassa, liian lyhyt. Poika ei halunnut olla yksin reessä, joten isä tuli myös rekeen.\r\n\r\n1902804 Family ROCHE, 5henk perhe jotka omasta mielestään olivat maksaneet sinkkulisät tilaessaan safarin. Meillä ei merkintää asiasta missään. Suostuivat ajamaan kaksi päällä, kun ei ollut kelkkoja/oppaita tarpeeksi. Frontin kanssa sopivat että lähettävät jotain todisteita sinkkuostoksista, jos löytyy.\r\n\r\nPaluumatka Tirrolammelta oli todella hidas koska yhtä asiakasta en saanut millään ajamaan 10-15km/h enempää, vaikka reitti oli oikein hyvässä kunnossa. Vauhti herätti vähän närkästystä muissa asiakkaissa.\r\n\r\nBjörn Wadenström 27.12.2019'),
(2,'2020-01-10 08:05:59','Raportti: 1906489 Devis Finlande / Tarandro Scandinavie','&quot;Day as Lappish 4-5h&quot;\r\n\r\n- Aikataulu hyvä, riitti rauhalliseen ja mukavaan toimintaan päivän aikana.\r\n- Lumikenkiä rittävästi jotta löytyi kaikille sopiva koko.\r\n- Short ski:t liian vähän ja osa rikki.\r\n- Osa sauvoista lyhyitä kävelysauvoja, umpisessa mahdoton yhtälö.\r\n\r\nKotaniemessä yksi asiakkaista lennätti pienoiskopteria, joka katosi. Katoamispaikka oli kuulemma tiedossa, joten yksi opas ja ryhmä asiakkaita lähti lumikengillä etsimään sitä, mutta ei löytynyt.\r\n\r\nVarusteongelmien takia jouduin lähtemään yksin hiihtämään koko ryhmän kanssa. Normaali tapani &quot;kokeilkaa vapaasti vain omia reittejä, kunhan näette minut&quot; ei toiminut, levisivät kuin jokisen eväät metsään, kun piti odottaa viimeisiä joilla oli vaikeuksia pysyä pystyssä. Yksi vielä pyllähti märkään kohtaan, kahden paxin ja yhden oppaan avulla saatiin ylös(vanhahko kankea herrasmies), takapuoli vähän märkänä.\r\n\r\n&quot;10&quot; Björn Wadenström'),
(3,'2020-02-06 13:29:48','Agamantours , David(10)','One snowmobile had some technical problem in the last few hundred meter down to lanssi( probably the driving belt snapped). Me(David) and Maria took the to clients back to lanssi on our guide snowmobile and finished the safari.'),
(4,'2020-02-21 15:54:28','opaskokous','Kävisitkö läpi tuntitakuut ja tasoitusjaksoasiat, jonkin verran oppaat kyselleet minulta, mutta olen aika heikosti ekspertti. Vappu'),
(5,'2020-02-22 09:48:54','Ehdotus kelkkaopetukseen ei-englantia puhuville','Postilaatikko tai sen tyyppinen paikka Lanssin valotolppaan missä säilytettäisiin eri kielisiä ajo-opetus ohjeita.\r\n\r\n-Björkka-'),
(6,'2020-03-04 12:30:48','snowshoe 4th March','2 clients (1917205) were decided to walk back after 15 mins to the town because one of them could not handle the physical part of the excursion. I let them keep the  snowshoes until 12 ( when the excursion ended).'),
(7,'2020-03-08 14:18:36','Wilderness safari by SM (Ivalo) No Show','Wilderness safari by SM (Ivalo) 2010400 1 pax No Show');
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `guide`
--

DROP TABLE IF EXISTS `guide`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `guide` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `surname` varchar(45) NOT NULL,
  `phone` varchar(18) NOT NULL,
  `password` char(64) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `guide`
--

LOCK TABLES `guide` WRITE;
/*!40000 ALTER TABLE `guide` DISABLE KEYS */;
INSERT INTO `guide` VALUES
(2,'Petteri','Hyväri','+358401209384','02da7e3ac7db533cbd025f741b467a4901e6889248783785e6e63f4a447b0be5',1),
(3,'Hugo','Sastre','+358440270975','02da7e3ac7db533cbd025f741b467a4901e6889248783785e6e63f4a447b0be5',1),
(5,'Petri','Valo','+358401271979','02da7e3ac7db533cbd025f741b467a4901e6889248783785e6e63f4a447b0be5',1),
(11,'Kimmo','Keskitalo','0408333697','446bd701f9c891b0a91e891089f55499c72001a3b9654f59aee150275b585305',0),
(12,'Aaro-Juhana','Fofonoff','0451202903','96927ce099889004f80e170b9dbe30bfcda14c7316a2aae4142320a2d75ffd61',0),
(13,'Tytti','Alastalo','0504915081','23a6da602ab9f110a8213d7253e6f09c9b7a633a803fc795f7486ae45ba6ef42',0),
(16,'Petri','Kola','0503021866','c6762a76b42d19029fe31a130edd0f08ea6958d781ac6551cb40635fe8f2d6af',0),
(17,'Vappu','Brännare','0407779905','372400c954a44f5e578ea28123d230874ccbe4ef78f6b1199a260dee4fce1573',0),
(18,'Aimo','Koistinen','0407739142','52d5471b5b15614d1d37192e12f67bb9817fa484ce041de03c880b6d37fbf31d',0),
(20,'Sameli','Autio','0451318079','ba70f9774b3cfecb3db23ab24660fc4e46f978fe6c2e1fa9b626192c0c192b0a',0),
(21,'Maxime','Lecomte','+33787590340','be15a1f970ae0411a22ace8af442d2d0b13985211362578b4898584de7c0dbcb',0),
(23,'Mathilde','Lombard','0622205782','2e975f6fd7dfaf0d4c05c44f574acf51b41d6ef5a0786d78f07441b0a0e725cf',0),
(26,'Vilma','Karttunen','0504676971','3603465832040f429ad8cec31186657c46da9cd84c34c16705641f50081d4549',0),
(27,'Mika','Suomalainen','0503605460','e89001e1099e262e896f32402db2f862268284e019a935c3d9d40af5039517bc',0),
(28,'Jouko','Jalonen','+358405737876','311c87c867001715779bd5ab72916b5f8732adbbd40bb243c4a60b00bcbe1161',0),
(31,'David','Kelemeny','0465596045','0e8ab345b55fac180b7fa9927a3d4e2081c5b1f970574fa32fb457fe036296e2',0),
(32,'Björn','Wadenström','0400856946','2fcc487b66f0f87bea83fe892c29199d2e45a7294b941293108c75132bc6cdd8',0),
(35,'Alberto','Mayor','+34644435365','6c3120094202d16f181694cf09cd20d131f27740b2abb734d046026515868a75',0),
(36,'Rei','Miyabe','+81 9066082644','42f4a14580a2f310f8f3df31c2ee23fccae91358c24a0c75db02e225c1346079',0),
(37,'Juha','Valtonen','0401209441','b1b7af1c31483ddabe9abb5dc76872917720de9b32c2d7ad0d48386dc9194fe7',0),
(38,'Paula','Kemppainen','0503678324','bc65a186bbe02d45cbd53d0264d814200ff3c882c9fca130f5334a537ec6b089',0),
(42,'Aimo','Koistinen','0407739142','1fdf9af5b25a55c41c65b1e03653406fef0224d2afc052ad7d76e9d8256f4bec',0),
(45,'Aleksi','Eskola','0445855679','e37efb6aec2fa641086609439885ee8e05646574f60d922a54b87dab3ca18483',0),
(46,'Esa','Matilainen','0400425946','cbe12fe983900b581f54ca5a848e7c34999b5507e3cd71853c5297249773c752',0),
(47,'Javier','Salas','+34 633329841','b2714bb35b46514f0cfcf47e18770c49e0cf2aa403cc6a6619258b15f7bee607',0),
(48,'Sagueva','Gomez','+479061502','1761b7f6cee3533038f3354ccb6beeecd38619ecd9cc81f15d85b412b7e028cf',0),
(49,'Ari','Pyykkö','0405656200','a4ec407fdc889abc85da3da2b92ecbaeaf8fde685bd7acd59c9c11bc04f6ddb9',0),
(50,'Maria','Murias','+3580405411591','d50668776afd8a2c02f2e9fe59a180864e67270de78bec73d72fac8470c9ce9f',0),
(51,'juha','valtonen','0401209441','46322a4efabfb4210c05770abe24369da9740a9fc9e2156373d42a6e0adcb1f0',0),
(52,'jarkko','vornanen','+358443218811','fb90579817fe7957104e2f2b9fbe42ba4cb24fe62fc3b4dd899d11ed3a812793',0),
(53,'Aimo','Koistinen','0407739142','fb72852fb89f7d90c5d42fce3ab25d877f69210c518aa23189523e6b39b597eb',0),
(54,'ael','miravalle','+33637300472','ea0aae3122f10275c72d1400708da3ff0c04ca90a3ab5d4d9382c6eaa5b3cd62',0),
(55,'Remi','Salien','0032473359000','2930a060c902c021f816e7a76e34b7311c78c5711fdcc761e5456fb857afbd10',0),
(56,'Lorena','Moriero','0041796805626','5baaceebe5574dcd10f72252fb3b08cba146934f71b45cba4e9aeffe11d73606',0),
(57,'pascal','clemot','0033610784179','bdd2ab17f2c8b14985c19484b3c68acff2654b93e4d3c01afaa4c6779ffa6e82',0);
/*!40000 ALTER TABLE `guide` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `near_miss`
--

DROP TABLE IF EXISTS `near_miss`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `near_miss` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trip_id` int(10) unsigned NOT NULL,
  `datetime` datetime NOT NULL,
  `place` varchar(150) NOT NULL,
  `description` varchar(300) DEFAULT NULL,
  `guide_involved` tinyint(1) DEFAULT 0,
  `customer_involved` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `fk_nearmiss_trip` (`trip_id`),
  CONSTRAINT `fk_nearmiss_trip` FOREIGN KEY (`trip_id`) REFERENCES `trip` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `near_miss`
--

LOCK TABLES `near_miss` WRITE;
/*!40000 ALTER TABLE `near_miss` DISABLE KEYS */;
INSERT INTO `near_miss` VALUES
(1,9,'2022-02-27 20:00:00','carra','cuca',NULL,NULL),
(2,12,'2022-02-28 16:00:00','kaunispää','too windy',0,NULL),
(3,18,'2022-03-02 13:15:00','hostaia terrible','lo dicho',1,NULL);
/*!40000 ALTER TABLE `near_miss` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phone_book`
--

DROP TABLE IF EXISTS `phone_book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phone_book` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `dept` enum('front','guide','huolto','puku','sales','xmas_guide') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phone_book`
--

LOCK TABLES `phone_book` WRITE;
/*!40000 ALTER TABLE `phone_book` DISABLE KEYS */;
INSERT INTO `phone_book` VALUES
(1,'Janne','Antola','+358404866712','janne.antola@laplandsafaris.fi','huolto'),
(2,'Vappu','Brännare','+358401283918','vappu.brannare@laplandsafaris.fi','guide'),
(3,'Hugo','Sastre','+358440270975','hugo.sastre@laplandsafaris.fi','guide'),
(4,'Anne','Kangas','+358406706746','anne.kangas@laplandsafaris.fi','front'),
(5,'Heidi','Suuripää','+358401209086','heidi.suuripaa@laplandsafaris.fi','sales'),
(6,'Tea','Martikainen','+358401976526','tea.martikainen@laplandsafaris.fi','sales'),
(7,'Bruce','Wernerus','+33684902771','wernerusbruce@gmail.com','guide'),
(8,'Hugo','Briere','+33695096763','hugbri.pro@gmail.com','guide'),
(9,'Maarit','Mäkelä','+358405481066','maaritjmakela@hotmail.com','guide'),
(10,'Balazs','Kajor','+36203491414','kajorb@gmail.com','guide'),
(11,'Björn','Wadenström','+358400856946','bjorn.wadenstrom@gmail.com','guide'),
(12,'Paula','Mäkiprosi','+358503452948','fd.north@laplandsafaris.fi','front'),
(13,'Front Desk','Duty Manager','+358408343716','fd.north@laplandsafaris.fi','front'),
(14,'Front Desk','Front Desk','+358400174766','saariselka@laplandsafaris.fi','front'),
(16,'Ari','Pyykkö','+358405656200','kuijuli62@gmail.com','guide'),
(17,'Vilma','Karttunen','+358401976580','varuste@laplandsafaris.fi','puku'),
(18,'Ria','Siiriäinen','+358465897055','riaacs@gmail.com','front'),
(19,'Katri','Heinonen','+358445416563','kahei89@gmail.com','front'),
(20,'Tapani','Ritala','+358401651984','','huolto'),
(21,'Juha','Valtonen','+358401209441','juha.valtonen@laplandsafaris.fi','front'),
(22,'Mathilde','Lombard','+33622205782','lombard_mathilde@hotmail.com','guide');
/*!40000 ALTER TABLE `phone_book` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `route`
--

DROP TABLE IF EXISTS `route`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `route` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `guide_id` smallint(5) unsigned NOT NULL,
  `safari_id` smallint(5) unsigned NOT NULL,
  `erp_n` varchar(7) NOT NULL,
  `date` datetime NOT NULL,
  `route` varchar(150) NOT NULL,
  `route_real` varchar(150) DEFAULT NULL,
  `missed_customer` mediumtext DEFAULT NULL,
  `schedule_issue` varchar(300) DEFAULT NULL,
  `gear_amount_issue` varchar(300) DEFAULT NULL,
  `near_miss` mediumtext DEFAULT NULL,
  `accident` mediumtext DEFAULT NULL,
  `finished` tinyint(1) NOT NULL DEFAULT 0,
  KEY `id` (`id`),
  KEY `safari_id` (`safari_id`),
  KEY `guide_id` (`guide_id`),
  CONSTRAINT `route_ibfk_1` FOREIGN KEY (`safari_id`) REFERENCES `safari` (`id`),
  CONSTRAINT `route_ibfk_2` FOREIGN KEY (`guide_id`) REFERENCES `guide` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=267 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `route`
--

LOCK TABLES `route` WRITE;
/*!40000 ALTER TABLE `route` DISABLE KEYS */;
INSERT INTO `route` VALUES
(1,46,12,'1906705','2019-11-19 09:00:00','lanssi-neste-kaunisniemen kautta-porotila-takaisin pitemmän lenkin kautta, jos on aikaa.','lamssi-neste-kaunisniemen ohi-porotila-kaunisniemen ohi-neste-lanssi','ryhmästä vain 4 ajokortti.','','','kelkka jumiin ennen porofarmia ylämäen alussa','',1),
(2,48,20,'1906077','2019-11-21 22:30:00','saariselka-kami by coach.','','39+1','theya were late 15 minutes.','','wew offered hot chololate but they  refused priorizing the auroras view.','',1),
(3,48,20,'1906074','2019-11-22 20:00:00','Saariselka-Kami-Saariselka','Saariselka-kami-Kaunispa-Saariselka','59+2','They were 10 min late.\r\nThey signed inside the bus to get some extra time.\r\n\r\nOne of the tour leader (&quot;Alexi&quot;) didn\'t count on us for the itinerary/fire place/and the explaining.','','we offered hot chocolate and alcoholic drinks wich they didn\'t ttake','',1),
(4,31,2,'1910449','2019-11-25 13:00:00','saariselkä-kaunispää-urupää-keskitie-karvamarketti-museotie-kaunisniemi-saariselkä','','','','','','',1),
(5,13,20,'1902660','2019-11-26 19:00:00','Mondays safari: Kaunispää, Kuttura, office','','Asiakkaat tulivat ilman Ryhmänjohtajia haahuillen toimistolle, koska TL oli toivottanut majoituksillaan jo hyvät yöt jne.. Kaikki meni ok.','','','','',1),
(6,13,24,'1907283','2019-11-26 15:30:00','Kolmikantajärvi','','Noin 1 tunnin myöhässä.','Ohjelma pidettiin entisellään ja paluuaikaa venytettiin tunnilla.','','','',1),
(7,13,7,'1907982','2019-11-27 10:00:00','Metallisillalta puiston puolelle ja Iisakkipolkua seuraillen pieni lenkki Aurorapolulle.','','','','','','',1),
(8,47,7,'1907502','2019-11-28 10:00:00','start point-national park- after first bridge left and make a big loop deep snow- come back','','','','','','',1),
(9,50,7,'1910468','2019-11-30 20:00:00','snow shoes walking national park 2km loop, starting from the brige','','','','','','',1),
(10,46,16,'1910371','2019-12-01 19:00:00','Aurorapolun ympäristö.','','1910371 Kin Chung Wai - no show. Nouto 18:40 Star Arctic. Odotettu klo 18:55 asti. Toisia asiakkaita viedessä edellä mainittu asiakas tuli hotellin ovelle kysymään miksi heitä ei haettu lumikenkäilemään. Asiakkaan papereissa luki noutoaika klo 19:00. Ari oli paikalla 18:35 - 18:55. Ari neuvoi asiakkaita ottamaan yhteyttä Lapin Safareihin. Asiakas sanoi olleen paikalla 18:50.','10 minuuttia etuajassa takaisin asiakkaiden toiveesta.','','','',1),
(11,45,20,'1905605','2019-12-01 20:00:00','Kaunispää-Koppelo-Inari-Ukonjärvi','','','','','','',1),
(12,21,20,'1908396','2019-12-01 20:00:00','Dinner at kammi - ukonjarvi - back','','','','','','',1),
(13,13,4,'1912096','2019-12-02 13:00:00','Aluksi harjoitteluladulla. Sen jälkeen valaistulle ladulle kohti Savottakahvilaa. Mehutauko puolessa välin ja suunta takaisin.','','','','','','',1),
(14,13,21,'1912477','2019-12-03 00:00:00','Kaunisniemi 1  pohjoisen kautta. Tauon jälkeen magneettimäen juurelle ja takaisin lanssiin.','Kaunispää 1 pohjoisen kautta ja samaa reittiä takaisin.','','','','','',1),
(15,21,10,'1903416','2019-12-03 09:00:00','lanssi - kaunispaa - palopaa - tirrolampi - palopaa - kaunispaa - kaunisniemi ? - lanssi','','','3 h late due to many tip over in the deep snow and also a real real real slow driver','','plenty of tipped over snowmobiles','',1),
(16,31,2,'1902613','2019-12-03 09:30:00','Saariselka-kaunispaa-urupaa-keskireitti-karvamarketti-museotie-magnettimaki-kaunisniemi-saariselka','no route','did not show up','','','','',1),
(17,31,2,'1912342','2019-12-03 13:00:00','Saariselkä-Kaunispää-urupää-keskireitti-karvamarketti-Länsipuoli-museotie-Magnettimäki-Kaunisniemi-Saariselkä','Saariselkää-Kaunispää-Kaunisniemi-Saariselkä','','','','After road crossing clients drove off from the track into the deep snow and flipped on the side and &quot;trapped&quot; their leg under the machine. But because of the deep snow no injuries happened and no damage on the snowmobile.','',1),
(18,32,3,'1911285','2019-12-03 11:00:00','Lanssi - Laanilan reitti - Kakslauttasen reitti - Länsipuoli - Keskireitti - Lanssi','Lopussa keskireitiltä Palopään kautta','Ensin todella innoissaan ja iloisia, kolarin jälkeen kelkan osien hinnoittelusta iso keskustelu, eikä iloisia enää...','Venyi kolarin takia','','','Pehmeään lumeen ajon takia peräänajo, isohkot kelkkavauriot, ei henkilövahinkoja. Onnettomuusraportti täytetty.',1),
(19,31,21,'1911521','2019-12-03 17:00:00','saariselkää-kaunisniemi-magnettimäki-saariselkää','','','','','','',1),
(20,51,17,'1905162','2019-12-04 19:00:00','neste-kaunisniemi-lumiaita-karvamarket-pukinpuro-sähkölinja-neste-lanssi','neste-kaunisniemi-lumiaita-karvamarket-pukinpuro-sähkölinja-neste-lanssi','paska keli ali jäähtynyttä vettä+pistävä tuuli. kohta on liposta','','','','',1),
(21,51,24,'1909868','2019-12-05 10:00:00','lanssi-neste-kaunisniemi-kelikamera-sähkölinja-neste-lanssi','lanssi-neste-sähkölinja-kaunispään risteys ja takaisin sama polku','','','','','',1),
(22,12,3,'1907558','2019-12-05 11:00:00','lanssi kaunispää urupää keskireitti karvamarketti länsireitti tuuliaita kaunisniemi lanssi','','','','','','',1),
(23,51,19,'1910468','2019-12-05 19:00:00','lanssi-neste-sähkölinja-kelikamera-kaunisniemi1-laanila-neste-lanssi','lanssi-neste-sähkölinja-kelikamera-kaunisniemi-laanila-neste-lanssi','','','','one tipover in laanioja and one lady driving off the track near by laanila tunel.','',1),
(24,32,2,'1911463','2019-12-06 13:00:00','Lanssi - Kaunispää - Palopää - Kaunispää - Urupää tai Kaunisniemen kautta - Lanssi','Lopussa Kaunispää - pukinpuro- Lanssi','Happy','','','','',1),
(25,23,21,'1913356','2019-12-06 17:00:00','SOUTH TO KUUSIPA, BACK LONG WAY VIA NORTH','VIA NORTH to kaunispaa, kuusipaa. back via south','','on time','','','',1),
(26,51,17,'1909199','2019-12-06 19:00:00','lanssi-neste-kaunisniemi-lumiaita-karvamarket-urupää-pukinpuro-sähkölinja-neste-lanssi','lanssi-neste-kaunisniemi-lumiaita-karvamarket-urupää-pukinpuro-sähkölinja-neste-lanssi','','','','','',1),
(27,51,11,'1903607','2019-12-07 09:00:00','lanssi-neste-urupää-kotaniemi-karvamarket-lumiaita-sähkölinja-neste-lanssi','lanssi-neste-urupää-kotaniemi-palopää-kaunispää-sähkölinja-neste-lanssi','','','','','',1),
(28,51,19,'1913541','2019-12-07 19:00:00','lanssi-neste-sähkölinja-kelikamera-kaunisniemi1-urupää-kaunispää-neste-lanssi','lanssi-neste-sähkölinja-kelikamera-kaunisniemi-sama latu takaisin','','','','','',1),
(29,31,24,'1903554','2019-12-08 11:00:00','Saariselkä-Neste tunnel-Kakslauttasen reitti-Laanila-Laanilan Reitti-Neste-Kaunisniemi-Saariselkä','Saariselkä-Neste tunnel-Kakslauttasen reitti-Laanila-Laanilan Reitti-Neste-Kaunisniemi-Kaunispää-Saariselkä','','','','','',1),
(30,51,3,'1909635','2019-12-08 12:00:00','lanssi-neste-laanila-urupää-karvamarket-onninkeino-neste-lanssi','lanssi-neste-laanila-urupää-karvamarket-neste-lanssi','','','','','',1),
(31,3,22,'1913777','2019-12-08 17:00:00','lanssi - urupää - palopää -kauniapää - lanssi','','','','','','',1),
(32,21,3,'1914274','2019-12-09 11:00:00','lanssi - lanila - kakslauttanen - lanila - maybe urupa if time','','','','','','',1),
(33,13,17,'1910494','2019-12-09 19:00:00','Magneettimäki - Karvamarketti - Urupää - Pukinpuro - Lanssi','','','','','','',1),
(34,32,7,'1901346','2019-12-11 10:00:00','Klubi - Lähtöpaikka - &quot;kierros metsässä&quot;- Lähtöpaikka - Klubi','','','','','','',1),
(35,47,17,'1906992','2019-12-11 18:30:00','south - kaunisniemi loop - up to number 4 crossing - pukinpuro, stop- come back same way','','','','','','',1),
(36,31,3,'1902656','2019-12-12 11:00:00','Saariselkä-Urupää-Keskireitti-Kolmikantajärvi-Moitakuru-Palopää-Kaunispää-Kaunisniemi-Laanila-Saariselkä','Saariselkä-Urupää-Keskireitti-Kolmikantajärvi-Moitakuru-Palopää-Kaunispää-Kaunisniemi-Saariselkä','','Started 30 mins earlier but the excursion was 3 hrs as it suppose to be.','','','',1),
(37,21,2,'1906992','2019-12-12 13:00:00','lanssi - kaunispaa - urupaa - E4 - west road - magnetimakki - back to lanssi','','','','','one deep snow driver, not much','',1),
(38,31,21,'1911585','2019-12-12 19:30:00','Saariselkä-Kaunispää-Magnettimäki-Uusipaika-Saariselkä','','','','','Driver tipped over and trapped under the snowmobile between Magnettimäki and Kaunisniemi, hurt her leg a bit but nothing serious. We offered to take her to the hospital but she said it is fine.','',1),
(39,21,19,'1902494','2019-12-12 19:00:00','lanssi - kaunispaa - urupaa - middle road - E4 - magnetimaki - break in kuusipaa - back to lanssi','','','','','','',1),
(40,46,10,'1906817','2019-12-13 09:00:00','lanssi - kaunispää - keskireitti - kotaniemi - länsipuoli - kaunispää - lanssi','lanssi - kaunispää - kuukkelinlammen reitti - kotaniemi - keskireitti - kaunispää - lanssi','','','','','',1),
(41,32,21,'1914988','2019-12-13 17:00:00','Lanssi - Kaunisniemen ympäri Kuusipään kautta - Urupää/Kaunispää vaihtoehdot aikataulun mukaan - Lanssi','Lopussa Uurupäälle kääntymään','','','','','',1),
(42,31,2,'1908684','2019-12-14 13:00:00','Saariselkä-Kaunispää-Keskireitti-Karvamarketti-Länsipuoli-Museotie-Magnettimäki-Kaunisniemi-Saariselkä','Saariselkä-Kaunispää-Keskireitti-Karvamarketti-Länsipuoli-Museotie-Magnettimäki-Kuusipää-Kaunisniemi-Saariselkä','','','','','',1),
(43,13,24,'1901049','2019-12-15 13:00:00','Lanssista Nesteen tunnelin kautta Uulelle ja samaa reittiä takasin.','','','','','Yksi reitiltä ulosajo oli tapahtunut Aleksin letkassa lanssin ja Suopunkitien risteyksen välillä.\r\n\r\nAleksin mukaan Aimo ja David oli tämän nähneet ja tilanteen hoitaneet. Matkustajan ollut nainen siirtyi rekeen. Molemmilla kaikki ok, ei kysyttäessä tarvetta lääkärikäynnille.','',1),
(44,32,7,'1902746','2019-12-16 10:00:00','Klubi - Hiihto lähtöpaikka - Kierros UKK:ssa ja takaisin.','','','','','','',1),
(45,13,19,'1905941','2019-12-16 19:00:00','Kaunispää - Pukinpuron laavu - Urupää - Sähkölinjojen kautta lanssiin.','Kaunispää - Magneettimäki - Karvamarketti - Urupää - Pukinpuro - Lanssi','','','','','',1),
(46,31,21,'1911558','2019-12-16 19:30:00','Saariselkä-Urupää-Keskireitti-Karvamarketti-Länsipuoli-Museotie-Magnettimäki-Kaunisniemi-Saariselkä','','','','','client drove into the deep snow and tipped over. No personal injury and no damage on the machine','',1),
(47,46,4,'1902755','2019-12-17 10:00:00','Harjotuslatu/laanilan suuntaan ja takaisin.','','','','','','',1),
(48,46,17,'1917058','2019-12-18 20:00:00','lanssi/neste/kaunisniemi/kuusipää/magneettimäki/karvamarketti/urupää/kaunispää/neste/lanssi','lanssi/neste/kaunisniemi/kuusipää/magneettimäki/karvamarketti/keskitie/pukinpuro/kaunispää/neste/lanssi','','','','','',1),
(49,52,10,'1900598','2019-12-19 09:00:00','lanssi-kaunispää-kuukelilammen reitti-tirrolampi-lanssi','','','','','','',1),
(50,12,2,'1916813','2019-12-19 13:00:00','lanssi kaunispää palopää kaunispää lanssi','','','','','','',1),
(51,52,19,'1909761','2019-12-20 19:30:00','lanssi-kaunispää-kuusipää-laanila-lanssi','lanssi-kuusipää-lanssi','','','','','',1),
(52,23,21,'1916871','2019-12-20 20:00:00','KUUSIPAA VIA SOUTH, URUPAA, KAUNISPAA','KUUSIPAA VIA SOUTH, BACK VIA NORTH','Family Scott Adams (2/2/09) didn\'t join, they went on NLA instead in  Tytti\'s group','','','one customer took the wrong tunnel after lansi and went to the deep snow.','',1),
(53,52,11,'1911596','2019-12-21 09:00:00','lanssi-kaunispää-kuukkelilammen reitti-kotaniemi-keskireitti-lanssi','','','','','','asiakas meni lumikenkäilyn aikana jäästä läpi aivan rannan tuntumassa. toinen jalka jumittui jään alle, joten jouduin rikkomaan jäätä että jalka saatiin takaisin ylös. eipä muttia kuin nuotion ääreen ja lämmittelemään. soitin sitten että voisiko joku tuoda kuivat kengät asiakaalle. sanoivat että olivat edellisenä iltana harjoitelleet avanto uintia, joten tilanne meni huumorilla läpi. tapahtuma paikka kotaniemi',1),
(54,46,4,'1917937','2019-12-21 13:00:00','harjoituslatu - Laanilan suuntaan ja takaisin','','','','','','',1),
(55,13,19,'1903542','2019-12-21 19:00:00','Kaunispää - Magneettimäki - Kaunisniemi - Lanssi','Kaunisniemen ympäri.','','','','Yksi reitiltä ulosajo. Ari kirjoittanut tästä raportin.','',1),
(56,3,21,'1918498','2019-12-22 19:30:00','lanssi - kaunispää - palopää','','','','','','',1),
(57,13,19,'1901340','2019-12-23 19:00:00','Kaunispää - Kuusipää - Lanssi','','','','','','',1),
(58,21,2,'1917947','2019-12-23 21:00:00','lanssi - kaunispaa - palopaa and back','to magnetimakki and back via kaunisniemi','','','','','',1),
(59,52,10,'1902792','2019-12-24 09:00:00','lanssi-kaunispää-tirrolampi-lanssi','','','','','','',1),
(60,46,4,'1902874','2019-12-24 10:00:00','Harjoituslatu/ Laanilan suuntaan ja takaisin.','','','15mins late','','','',1),
(61,46,4,'1918860','2019-12-24 14:00:00','Harjoituslatu/Laanilan suuntaan ja takaisin','','Zentjes &amp; Kerkhofs: sukset seuraavan päivän iltaan asti kompensaationa väärästä safariajasta.','','','','',1),
(62,46,16,'1904164','2019-12-24 19:00:00','aurorapolun ympäristö','','','','','','',1),
(63,50,20,'0000000','2019-12-24 23:30:00','inari','','custumer order 1919141 no show \r\nname: Han Lin Wang 2 adults','','','','',1),
(64,52,11,'1910468','2019-12-25 09:00:00','lanssi-kaunispää-kuukkelin reitti-kolmikantajärvi-ivalonreitti-länsipuoli-laanila-lanssi','ajoin kakslauttasen kautta','','','','','',1),
(65,51,3,'1919300','2019-12-25 11:00:00','lanssi-kakslauttanen-kuusipää-karvamarket-kiinan reitti-palopää-kaunispää-neste-lanssi','lanssi-kakslauttanen-karvamarket-kiinan reitti-urupää-palopää-kaunispää-neste-lanssi','','','','','',1),
(66,13,17,'1904068','2019-12-25 19:00:00','Lanssi - Magneettimäki - Karvamarketti - Urupää - Pukinpuron mökki - Lanssi','','','','','','',1),
(67,46,4,'1901324','2019-12-26 10:00:00','Harjoituslatu/Laanilan suuntaan','Harjoituslatu/tunneli/kummituskämppä','Osallistujia 16.\r\nAlessandro Scarpa oli kipeänä. Muu perhe osallistui.','','','','',1),
(68,46,4,'1906857','2019-12-26 13:30:00','Harjoituslatu/Laanilan suuntaan.','harjoituslatu/aloitusmäki','','oikea aikataulu: 13:45 - 15:45.','','','',1),
(69,13,2,'1908228','2019-12-27 10:00:00','Kaunispään ympäri.','','','','','','',1),
(70,21,24,'1907082','2019-12-27 10:30:00','lanssi - laanila via tunnel - lunch in laanila - back the same way','','','','','','',1),
(71,46,16,'1902829','2019-12-27 19:00:00','Aurorapolun ympäristö.','','','','','','',1),
(72,13,16,'1903397','2019-12-27 19:00:00','Vanhan sillan kautta UKK-puistoon, polkua pitkin ylös, Ristikurulle mahdollisesti umpista, Aurora polun kautta takaisin Saariselälle','','','','','','',1),
(73,32,5,'1902571','2020-01-02 13:00:00','Klubi - pyöräreitti Laanilaan - Kiilopään reittiä vähän matkaa jos huollettu - Hirvaspirtillä kääntymässä - kylän läpi - Klubi','Ei käyty Hirvaspirtillä','Väsyneitä mutta iloisia','30min aikaisemmin takaisin, asiakkaille riitti.','Yhdellä pyörällä taas vaihteisto-ongelmia, huoltoon.','','',1),
(74,21,3,'1907522','2020-01-02 11:00:00','lanssi - kaunisniemi t cross - lanilaa - kakslauttanen - lanilla - maybe top kaunispaa if time - back to lanssi','','','','','','',1),
(75,11,1,'2000224','2020-01-03 09:00:00','Lanssi-Kaunispää-Lanssi','Lanssi-Sähkölinja-Lanssi','','','','','',1),
(76,52,10,'1908284','2020-01-03 14:30:00','lanssi-tirrolampi-lanssi','','','','','','asiakas ajoi reitiltä ulos ja kaatui kelkalla. vaimo jäi kelkan alle jumiin. takana tullut kelkkailija seirasi edellä ajavaa ja ajoi maassa makaavan naisen yli. Nainen loukkasi rytäkässä olkapäänsä ja valitti käsivartta. toimistolle tultaessa kysyttiin vielä haluaako ambulanssin paikalle mutta kieltäytyi.',1),
(77,46,16,'1905074','2020-01-03 19:00:00','Aurorapolun ympäristö','','','','','','',1),
(78,52,11,'1917464','2020-01-04 09:00:00','lanssi-kaunispää-kotaniemi-ivalon reitti-urupää-laanila- lanssi','','','','','','',1),
(79,32,2,'1910095','2020-01-04 09:30:00','Lanssi - Kaunispää - Palopää - Kaunispää/Urupää/Pukinpuro -yhdistelmä aikataulun mukaan - Lanssi','täysin eri reitti aikatauluongelmien takia:\r\nKaunisniemen ympäri - Uurupää - Kaunispää Lanssi','lennolle lähtevälle perheelle järjestettiin autokyyti kaunispäältä toimistolle.','Hankalan perheen takia lähtö viivästyi. Paluu venytettiin niin paljon kuin oppaiden seuraavat safarit antoi myöten.','','','',1),
(80,51,1,'1907060','2020-01-04 09:00:00','lanssi-neste-kaunispää-sähkölinja-neste-lanssi','lanssi-neste-kaunispää-sähkölinja-neste-lanssi','','','','','',1),
(81,13,2,'2000171','2020-01-04 13:00:00','Kaunisniemi via south - Urupää - Kaunispää - Lanssi','','','','','','',1),
(82,13,16,'2000791','2020-01-05 19:00:00','From oold bridge to UKK park, after uphill via deep snow towards to Ristikuru. From there to Aurora hut and back to office.','','','','','','',1),
(83,11,24,'1905405','2020-01-06 08:30:00','Lanssi-Sähkölinja-Kaunispää-Palopää-Kuukkelilampi-Länsipuoli-4-tie-kaunispää-Lanssi','Kuukkelilampi-Kartano-Keskireitti-Palopää-Kaunispää-Sähkölinja-Lanssi','Asiakkaat tulivat tunnin myöhässä joten heidät tuotiin autolla huskeille. Kelkoilla tultiin takasin toimistolle','','','','',1),
(84,13,7,'1904812','2020-01-06 10:00:00','Via old bridge to UKK-park, after uphill towards to Ristikuru, from there down to metal bridge and back to office.','','','','','','',1),
(85,31,3,'1906548','2020-01-06 11:00:00','Saariselkä-Kaunispää-Museotie-Karvamarketti-Around kolmikantajärvi-Moitakuru-Palopää-Kaunisniemi-Laanila-Saariselkää','aariselkä-Kaunispää-Museotie-Karvamarketti-Around kolmikantajärvi-Moitakuru-Palopää-Kaunisniemi-Laanila-Kakslauttanen-Laanila-Saariselkä','','','','','',1),
(86,32,12,'1902566','2020-01-06 13:00:00','Lanssi - Uule - Lanssi','Menomatka via north Kaunisniemen ympäri','','Yksi pariskunta, ajaneet aikaisemmin, eli paljon aikaa. Takaisin klubilla jo 15:20 asiakkaiden pyynnöstä, ei halunneet ajaa enempää.','','','',1),
(87,46,17,'1905164','2020-01-06 19:00:00','lanssi/neste/kaunsipää/4 tien ylitys/magnettimäki/karvamarketti/keskitie/urupää/pukinpuro/kaunispään vierestä/lanssi','lanssi/neste/kaunispää/urupää/keskitie/karvamarketti/lansipuoli/magneettimäki/pukinpuro/neste/lanssi','','15 minutes late: good auroras and road crossing.','','','',1),
(88,31,2,'1903341','2020-01-07 09:30:00','saariselkä-keskireitti-karvamarketti-museotie-magnettimäki-saariselkä','Saariselkä-Kaunispää-Magnettimäki-Kuusipää-Kaunisniemi-Saariselkä','','','','','',1),
(89,11,1,'2000745','2020-01-07 09:00:00','Lanssi-Kaunispää-Lanssi','Lanssi-Kaunispää-4-tie-Kaunisniemi-Neste-Lanssi','','','','','',1),
(90,13,5,'1907878','2020-01-07 13:00:00','Laanila - Piispanoja - Saariselkä','Piispanojan + länsipuolen fatbike reitti.\r\n\r\nReitit hyvässä kunnossa.','','','','','',1),
(91,11,2,'2000949','2020-01-07 13:00:00','Lanssi-Sähkölinja-Urupää-Joiku-Palopää-Kaunispää-Lanssi','','','','','','',1),
(92,17,1,'1920473','2020-01-07 17:00:00','Lanssi - around Kaunispää - Lanssi','harjoitus','','','','','',1),
(93,21,1,'1920473','2020-01-08 09:00:00','lanssi - kaunispaa - back','','','','','','',1),
(94,53,3,'2001014','2020-01-08 11:00:00','Lanss-Laanila-T-risteys-Kaunispää- Karvamarket-Kaunispää-Lanssi','Lanssi-Laanila-Magneettimäki-Karvamarket-Palopää-Kaunispää-Lanssi','','','','','',1),
(95,46,3,'2001190','2020-01-09 11:00:00','lanssi/kaunispää/kuukkelilammen reitti/karvamarketti/länsipuoli/kaunisniemi/neste/lanssi','lanssi/kaunispää/kuukkelinlampi/karvamarketti/lansipuoli/kaunisniemi/laanilan alikulku/neste/lanssi','','','','','',1),
(96,13,24,'1905164','2020-01-09 13:00:00','Snowmobile safari to reindeer farm.\r\n\r\nLyhyttä reittiä Uulelle ja Kaunisniemi kiertäen takasin.','Lyhyt reitti mennen ja tullen.','','','','Kaksi reitiltä ulosajoa, ennen ylämäkeä josta noustaan Uulen tilalle sähkölinjojen alla.\r\n\r\nMennessä asiakas oli ajanut umpisen kautta pysyen pinnalla ja päästen takasin reitille, mutta seuraavaksi tullut seurasi samoja jälkiä ja tippasi kelkan kanssa melkein kyljelleen.\r\n\r\nToinen asiakkaista sanoi, että polveen hiukan sattui, mutta ehdottomasti ei halunnut lääkäriin. Kertoi, että polvi ollut ennestään kipeä ja operaatio siihen tulossa.\r\n\r\nTakasin tullessa toiset asiakkaat ajoivat reitiltä samoille jäljille, mutta ei kaatumisia, kelkka- eikä henkilövahinkoja.','',1),
(97,31,10,'1916899','2020-01-10 13:30:00','Saariselkä-Kaunispää-Palopää-Tirrolampi(Same way back)','','','','','Client(Departure number same as the client number) drove close to a tree which has a ditch on the bottom and tipped over. No personal injury(doctor/hospital offered). The kill switch button popped out from its holder but it did not effect the function of it. The holder temporally fixed for the safari, so the client was able to safely finish the excursion with the same machine.','',1),
(98,11,2,'1903490','2020-01-11 09:30:00','Lanssi-Sähkölinja-Urupää-Palopää-Kaunispää-Lanssi','lanssi-sähkölinja-urupää-palopää-kaunispää-4-tie-kaunisniemi-neste-lanssi','','','','','',1),
(99,53,12,'2001334','2020-01-11 13:00:00','Lanssi-Tristeys-Uule-Tristeys-Lanssi.','','','','','','',1),
(100,11,2,'1913073','2020-01-11 13:00:00','Lanssi-Sähkölinja-Urupää-Palopää-Kaunispää-Lanssi','Lanssi-Sähkölinja-Urupää-Palopää-Kaunispää-4-tie-kaunisniemi-Neste-Lanssi','','','','','',1),
(101,13,24,'2001507','2020-01-11 20:00:00','Excursion to Aurora Borealis Camp by bus.\r\n\r\nMinibussilla Kammille, Kaunispään kautta takaisin.','','','','','','',1),
(102,11,24,'1920789','2020-01-13 09:30:00','Lanssi-Sähkölinja-4-tie-Länsipuoli-Karvamarketti-Kotaniemi-Kartano-Karvamarketti-Keskireitti-Urupää-Sähkölinja-Lanssi','','','','','','',1),
(103,13,24,'1901661','2020-01-13 20:00:00','Excursion to Aurora Borealis Camp:\r\n\r\nToimistolta autolla Kammille, paluu Kaunispään kautta takaisin toimistolle.','','','','','','',1),
(104,52,10,'1908708','2020-01-14 09:00:00','lanssi-kaunispää-kotaniemi-ivalon reitti-urupää-lanssi','','','','','','',1),
(105,47,2,'2002057','2020-01-14 09:00:00','north- kaunispa- palopää- back','','','','','','',1),
(106,46,4,'2002102','2020-01-14 10:00:00','Harjoituslatu - Laanilan suuntaan','','2002102 - varaukselta toinen luovutti tunnin jälkeen.','','','','',1),
(107,31,2,'1907097','2020-01-14 13:00:00','Saariselkä-urupää-Keskireitti-Karvamarketti-Museotie-magnettimäki-Kaunisniemi-Saariselkä','Saariselkä-urupää-Keskireitti-Karvamarketti-Museotie-magnettimäki-Kaunispää-Saariselkä','','','','','',1),
(108,46,5,'1919855','2020-01-14 13:00:00','Klubi/Laanila/Piispanoja/Aurorapolku','','','Lopetus 15:30. Asiakkaat väsyneitä.','','','',1),
(109,11,24,'1908428','2020-01-15 08:30:00','Lanssi-Kaunispää-Palopää-Kuukkelilampi-Moitakuru-Kartano-Karvamarketti-Länsipuoli-4-tie-Sähkölinja-Lanssi','Lanssi-Kaunispää-Palopää-Kuukkelilampi-Palopää-Kaunispää-Lanssi','','','','','',1),
(110,32,20,'1908428','2020-01-15 20:00:00','Toimisto - 4t kohti Inaria + ympäristö ja takaisin.','','','','','','',1),
(111,52,24,'1920161','2020-01-16 16:30:00','lanssi-kaunispää-kotaniemi-urupää-lanssi','','','','','','asiakkaat ajoivat tunnelille tultaessa hiihtoladulle noin kilometrin verran ennekuin saatiin kiinni',1),
(112,13,3,'1913214','2020-01-17 09:00:00','Länsipuolta Karvamarketille, Itäpuolta Palopään kautta Saariselälle.','','','','','','',1),
(113,13,16,'1908708','2020-01-17 19:00:00','UKK -puistoon vanhalta sillalta ylös polkuja pitkin, metsän läpi Ristikurulle, metallisillalta takaisin.','','','','','','',1),
(114,46,17,'1919807','2020-01-17 19:00:00','lanssi/4tien ylitys/magneettimäki/länsipuoli/karvamarketti/keskireitti/urupää/Pukinpuro/lanssi','lanssi/kaunispään suora/urupää/4tien ylitys/magneettimäki/kaunisniemi/neste/lanssi','','','','','',1),
(115,13,3,'1913214','2020-01-18 09:00:00','Kiilopää - Kakslauttanen - Kaunisniemi - Kaunispää','','','','','','',1),
(116,52,3,'1913214','2020-01-18 13:30:00','lanssi-magneettimäki-lentokentä reitti-ivalinreitti-urupää-lanssi','','','','','','asiakas kaatoi oman kelkkansa ja särki tuulilasin. ei henkilövahinkoja',1),
(117,13,19,'1910784','2020-01-18 19:00:00','Kaunispää - Palopää - Tirro - Kaunispää - Lanssi','','','','','','',1),
(118,31,2,'2002920','2020-01-19 13:00:00','Saariselkää-Kaunispää-Kaunisniemi-Laanila-Saariselkä','Saariselkää-Kaunisniemi-Laanila-Saariselkä','','','','Client drove into the small stream at Laanioja, tipped over. No personal injury or damage on the snowmobile. We offered doctor/hospitak 3 times. The client each time refused to get any medical help.','',1),
(119,46,17,'2001601','2020-01-20 19:00:00','lanssi/urupää/keskitie/karvamarketti/magneettimäki/4 tien ylitys/pukinpuro/lanssi','','','','','','',1),
(120,31,19,'2003173','2020-01-20 19:00:00','Saariselkä-Keskireitti-Karvamarketti-Museotie-Magnettimäki-Kaunisniemi 1- Saariselkä','','','','','','',1),
(121,52,10,'1904631','2020-01-21 09:00:00','lanssi-tirrolampi-kolmikanta järvi-ivalonreitti-urupää-lanssi','','','','','','',1),
(122,11,2,'1920046','2020-01-21 09:30:00','Lanssi-Kaunispää-Palopää-Kaunispää-Lanssi','Lanssi-Sähkölinja-Urupää-Palopää-Kaunispää-4-tie-Kaunisniemi-Neste-Lanssi','','','','','',1),
(123,13,4,'1919883','2020-01-21 10:00:00','Kummituskämpän suuntaan ja sieltä Iisakkipäätä kohti, puolivälissä aikaa kääntö takasin.','','','','','','',1),
(124,13,16,'1903920','2020-01-21 19:00:00','Vanhaa siltaa pitkin UKK-puistoon, Iisakkipolkua myötäillen Ristikurulle, sieltä metallisillalle ja takisin toimistolle.','','','','','','',1),
(125,46,20,'1914980','2020-01-21 20:00:00','Kaunispää/Koppelo/Ukonjärvi/Saariselkä','','','19:45 - 22:30. Asiakkaiden toiveesta 15 minuuttia aikaisemmin takaisin Saariselälle.','','','',1),
(126,52,11,'1903920','2020-01-22 09:00:00','lanssi-palopää-kotaniemi-ivalonreitti-urupää-laanila-lanssi','','','','','','',1),
(127,21,24,'2000530','2020-01-22 09:30:00','TT ice fishing\r\nlanssi - east road - kotaniemi - middle road back - lanssi','','','','','tip over near by the top of palopaa, customer slipped and tipped over','',1),
(128,26,20,'0000000','2020-01-22 20:00:00','saariselkä-ukonjärvi-saariselkä kelin mukaan katotaan enemmän','saariselkä-koppelo-saariselkä\r\n\r\nwe saw northern lights','','','','','',1),
(129,11,24,'1914570','2020-01-23 09:00:00','Lanssi-Kaunispää-Palopää-Moitakuru-Keskireitti-Ivalojoki-Kultahippu-Ivalojoki-Lentokentänreitti-urupää-Kaunisniemi-Lanssi','','','','','','',1),
(130,28,12,'1903517','2020-01-23 11:00:00','lanssi-neste-uule-kaunisniemi-sähkölinja-lanssi','','','','','','',1),
(131,31,3,'2003690','2020-01-23 11:00:00','Saariselkä-Magnettimäki-Museotie-Karvamarketti-Around Kolmikantajärvi-Moitakuru-Palopää-Kaunispää-Kaunisniemi-Laanila-Saariselkä','','','','','','',1),
(132,28,19,'1904036','2020-01-23 19:00:00','lanssi-sähkölinja-länsi reitti-karvamarketti-keskireitti-pukinpuro-sähkölinja-lanssi','','','','','','',1),
(133,52,10,'1919864','2020-01-24 09:00:00','lanssi-kaunispää-kotamniemi-ivalonreitti-urupää-lanssi','','','','','','',1),
(134,13,3,'2003384','2020-01-24 11:00:00','Kiilopäälle länsipuolta, Sariselälle itäpuolta, 4-tien yli Urupäälle, Palopään kautta lanssiin.','Kiilopään lenkki ja Kaunispään kautta lanssiin.','','','','','',1),
(135,45,16,'1904631','2020-01-24 19:00:00','Dividing the group into three different groups. Ski tracks-&gt;UKK bridge-&gt;Aurora cabin-&gt;ski tracks.','','','','','','',1),
(136,3,12,'2003502','2020-01-25 13:00:00','lanssi - neste - uule - and back','','','','','','',1),
(137,52,11,'2003206','2020-01-25 16:00:00','lanssi-kaunispää-kotaniemi-ivalonreitti-länsipuoli-laanila-lanssi','','','','','','asiakas ajoi lumipenkkaan saavuttaessa kartanolle. hän lensi kelkan kyydistä suoraan kovalle pihatien pohjalle ja loukkasi polvensa. ambulanssi kävi tarkastamassa loukkaantuneen ja päättivät lähettää hänet terveyskeskukseen. pariskunnan safari päättyi siihen.',1),
(138,45,19,'2004069','2020-01-25 19:00:00','lanssi-urupää-karvamarketti-magneettimäki-kaunisniemi(sausage break)-neste/kaunispää depending on time-lanssi','','','','','','',1),
(139,32,1,'1911060','2020-01-26 13:00:00','Kaunispään suuntaan niin pitkälle kuin pääsee, ja takaisin.','S-market kyltillehän me päästiin...','','','','Peini reittimerkkikosketus käännyttäessä, ei vaurioita.','',1),
(140,11,24,'1912127','2020-01-27 08:30:00','Lanssi-Kaunispää-Palopää-Husky farmi-Moitakuru-Kartano-Karvamarketti-Keskireitti-Urupää-Lanssi','','','','','','',1),
(141,32,7,'1910328','2020-01-27 10:00:00','Kansallispuisto','','','','','','',1),
(142,28,10,'2002351','2020-01-27 10:30:00','lanssi-sähkölinja-kaunispää-palopää-kotaniemi-kammi-karvamarket-länsireitti-sähkölinja-lanssi','','cold -28 celsius','','','','',1),
(143,13,12,'1907764','2020-01-27 13:00:00','Nesteen tunnelin kautta Uulelle ja samaa reittiä takasin.','','','','','','',1),
(144,45,19,'1908426','2020-01-27 19:00:00','lanssi-kaunispää-palopää-urupää-kaunisniemi-lanssi','','','','','','',1),
(145,53,10,'1910108','2020-01-28 09:00:00','Lanssi-Palopää-Tirrolampi-Palopää-Lanssi','','','','','','',1),
(146,32,4,'1907764','2020-01-28 09:30:00','Latua eestaas','','','','','','',1),
(147,13,2,'1903620','2020-01-28 09:30:00','Urupää - Palopää - Kaunispää - Lanssi','','','','','','',1),
(148,11,2,'1910178','2020-01-28 13:00:00','Lanssi-Kaunispää-Palopää-Kaunispää-4-tie-Kaunisniemi-Neste-Lanssi','','','','','','',1),
(149,11,11,'2003028','2020-01-29 09:00:00','Lanssi-Neste-Kaunisniemi-4-tie-Urupää-Joiku-Tirrolampi-Moitakuru-Kartano-Karvamarketti-Länsipuoli-Lanssi','','','','','','',1),
(150,32,17,'1914722','2020-01-29 19:00:00','Lanssi - Kaunisniemen ympäri Uurupäälle - Pukinpuro -  Kaunispää - Lanssi','','','','','','',1),
(151,11,24,'1908426','2020-01-30 13:00:00','Lanssi-Neste-UUle-Neste-Lanssi','Lanssi-Neste-Uule-Kaunisniemi-4-tie-Kaunispää-Lanssi','','','','','',1),
(152,11,10,'1918083','2020-01-31 09:00:00','Lanssi-Kaunispää-Palopää-Moitakuru-Kotaniemi-Keskireitti-Urupää-Lanssi','','','','','','',1),
(153,13,5,'2000702','2020-01-31 13:00:00','Laanila Savottakahvila + Länsipuolen fatbike reitti.','Laanila - Viskitie - Saariselkä','','','','','Toinen asiakkaista kaatui pyörällä kaksi kertaa, mutta vakuutti olevansa kunnossa eikä satuttanut itseään.',1),
(154,45,3,'1911175','2020-02-01 11:00:00','lanssi-neste-kuttura-kakslauttanen-neste-kuusipää-karvamarketti-moitakuru-palopää-urupää-kaunispää-lanssi','','','','','','',1),
(155,52,10,'2004142','2020-02-02 10:30:00','lanssi-kaunispää-palopää-kotaniemi-ivalonreitti-keskireitti-urupää-lanssi','','','','','','',1),
(156,45,16,'1914387','2020-02-02 20:00:00','Ski tracks-beginning of ukk-aurora cabin-ski tracks','','','','','','',1),
(157,50,20,'2002772','2020-02-02 23:00:00','inari','','2002772 jin ran no show','','','','',1),
(158,13,7,'2002245','2020-02-03 10:00:00','UKK-puistoon vanhan sillan kautta Ristikurulle ja uuden sillan kautta takasin.','','','','','','',1),
(159,53,3,'2004339','2020-02-03 11:00:00','Lanssi-Laanila-T-risteys-Kaunispää-Palopää-Lanssi','','','','','','',1),
(160,11,24,'1903243','2020-02-03 13:00:00','Lanssi-Neste-Uule-Neste-Lanssi','Lanssi-Neste-Uule-Kaunisniemi-4-tie-Kaunispää-Lanssi','','','','','',1),
(161,11,17,'1913373','2020-02-03 19:00:00','Lanssi-Neste-Kaunisniemi-4-tie-Urupää-Pukinpuro-Kaunispää-Lanssi','','','','','','',1),
(162,52,10,'1906234','2020-02-04 09:00:00','lanssi-kaunispää-tirronlampi/kotaniemi-ivalonreiti-keskireitti-urupää-lanssi','','','','','','',1),
(163,53,2,'1903250','2020-02-04 09:30:00','Lanssi.Kaunispää-Palopää-Nelostie-T-risteys-Lanssi','','','','','','',1),
(164,17,3,'2005441','2020-02-04 09:00:00','Lanssi - Laanila- Kakslauttanen - Kuttura - Kaunisniemi - Maybe airport route - Kaunispää - Lanssi','','','we came back a little bit late (10 min) because one of the machines broke after Kaunisniemi and only went slowly forward, making &quot;explosive&quot; sounds.','','Yksi kelkka kaatui kyljelleen tienylityksessa, kun penkki sortui kelkan toiselta puolelta. Asiakas sai &quot;saatettua&quot; kelkan kyljelleen, joten kelkalle tai asiakkaalle ei käynyt kuinkaan.','',1),
(165,53,3,'2005610','2020-02-04 14:00:00','Lanssi-Kakslauttanen-T-risteys-Nelostie-Lanssi','Lanssi-Laanila-T-risteys-Kaunisniemi-Urupää-Palopää-Kaunispää-Lanssi','','','','','',1),
(166,32,16,'1906178','2020-02-04 20:00:00','Kansallispuisto','','','','','','',1),
(167,11,11,'1910506','2020-02-05 09:00:00','Lanssi-Neste-Kaunisniemi--4-tie-Urupää-Joiku-Palopää-Tirro-Moitakuru-Kartano-Keskireitti-Urupää-Kaunispää-Lanssi','Lanssi-Kaunispää-Palopää-Tirro-Moitakuru-Kartano-Keskireitti-Urupää-4-tie-Kaunisniemi-Neste-Lanssi','','','','','',1),
(168,17,7,'1906234','2020-02-05 10:00:00','UKKpuistossa lyhyt kierros','','One of the customers (mr Lemstra) started to feel dizzy towards the end of the safari. We took breaks every 50-100 meters and walked slowly back to the village. At the office we took a little 15 min break before going back to Kiilopää.','','','','',1),
(169,52,10,'2004117','2020-02-05 09:30:00','lanssi-kaunispää-urupää-kotaniemi-ivalonreitti-keskireitti-urupää-lanssi','','','','','','',1),
(170,32,24,'1914387','2020-02-05 13:00:00','Short skis\r\n\r\nUrupään p-paikka - Urupään rinnettä itään - alas Pukinpurolle - Pukinpuron - P-paikka','','','','','','',1),
(171,32,17,'1905876','2020-02-05 19:00:00','Lanssi - Kaunisniemi via south - Urupää - Pukinpuro - Lanssi','Myös takaisin Kaunisniemen ympäri','','Oltiin jo 21:40 toimistolla koska asiakkaat palelivat ja taivas oli pimeä.','','','',1),
(172,13,20,'1906103','2020-02-05 20:00:00','Kuttura','','','','','','',1),
(173,11,2,'1905876','2020-02-06 09:30:00','Lanssi-Urupää-Joiku-Palopää-Kaunispää-Lanssi','','','','','','',1),
(174,11,2,'1903171','2020-02-06 13:00:00','Lanssi-Urupää-Joiku-Palopää-Kaunispää-Lanssi','Lanssi-Urupää-Joiku-Palopää-Kaunispää-Kaunisniemi-Neste-Lanssi','','','','','',1),
(175,32,19,'1903250','2020-02-06 19:00:00','Lanssi - kaunisniemi via south - Magneettimäki  - Pukinpuro - Lanssi','','','25mins myöhässä takaisin revontulien takia','','','',1),
(176,11,10,'1906632','2020-02-07 09:00:00','Lanssi-Kaunispää-Palopää-Moitakuru-Kotaniemi-Keskireitti-Urupää-Lanssi','Lanssi-Neste-Kaunisniemi-4-tie-Urupää-Joiku-Palopää-tirro-Kaunispää-Lanssi','','','','','',1),
(177,52,10,'2004136','2020-02-07 09:30:00','lanssi-kaunispää-palopää-kotaniemi-keskireitti-urupää-lanssi','','','','','','',1),
(178,31,24,'2005595','2020-02-07 09:00:00','Saariselkä-Laanila-Kakslauttanen-Laanila-Saariselkä','','','','','','',1),
(179,31,2,'2006033','2020-02-07 13:00:00','Saariselkä-Urupää-Keskireitti-Karvamarketti-Museotie-Magnettimäki-Saariselkä','','','','','','',1),
(180,46,17,'2005026','2020-02-07 19:00:00','lanssi/kaunisniemi/magneettimäki/karvamarketti/keskireitti/urupää/pukinpuro/lanssi','lanssi/kaunispään rinne/urupää/4 tienylitys/magneettimäki/kaunisniemi/neste/lanssi','','','','','',1),
(181,13,24,'2006116','2020-02-08 08:30:00','Palopään kautta Eräsetille, Huskyjen jälkeen Kolmikantajärvi kiertäen Urupään kautta takasin toimistolle.','','','','','','',1),
(182,32,11,'1906925','2020-02-08 09:00:00','Lanssi - Kaunispää - Tirrolampi - Kartano - Keskireitti - Lanssi','','','','','','',1),
(183,46,2,'1901938','2020-02-08 13:00:00','lanssi/kaunispään rinne/urupää/palopää/kaunispää/lanssi','lanssi/kaunispään rinne/urupää/palopää/kaunispää/4 tien ylitys/kaunisniemi/neste/lanssi','1906465 BOEHNEMANN / NO SHOW','','','','',1),
(184,46,19,'2006422','2020-02-08 19:00:00','lanssi/kaunispää/urupää/keskitie/karvamarketti/länsipuoli/kaunisniemi/neste/lanssi','','','','','','',1),
(185,32,24,'2002621','2020-02-09 08:30:00','Lanssi - kaunisp. - Palop. - Husky - ja takaisin','','Perhe/ystävä ryhmä joka &quot;sekoili&quot; keskenään ja oli hidas joka käänteessä.\r\n\r\nKun myöhäisen lähdön lisäksi kaksi kelkkaa karkasi hiihtoladulle totesin että huskeille ei ennetä ajoissa, joten kokosin ryhmän kasaan ja kerroin tilanteen.\r\n\r\nPuhelin soittorumbassa kun päätettiin jatkosuunnitelmista oli mukana Heidi K, Operaattori ja Urho. (Huskyfarmille syömään ja tarhakierros)','HC:ltä lähtö 08.20\r\nKlubilta lähtö n.09:05. (PT:n vaatetuksen takia jouduttiin improvisoimaan valmistelut Rentaliin, suurin syy myöhästelyyn tyhmässä, pieni osasyy Klubin ruuhka.\r\nLanssista lähtö 09:30\r\nSaapuminen Huskyfarmille 10:10\r\nPaluu farmilta 12:20\r\nLanssissa nopea ryhmä n.14:00, hidas 14:15','','Lähdössä toisen ryhmän kaksi viimeistä väärään tunneliin ja n.kilometrin verran hiihtolatua pitkin, joka päätyi ulosajoon hitaassa vauhdissa. Pehmeään lumeen kyljelleen jyrkässä paikassa(huonolla tuurilla olisi kelkka voinut pyöriä päälle), ei henkilö- eikä kalustovahinkoja. Kuvia Operaattorin Telegramille.\r\n\r\nKoko matkan aikana kolme kelkkaa reitin ulkopuolelle pehmeeseen, sekä kaksi ulkopuolelle kyljelleen, ei henkilö- eikä kalustovahinkoja.\r\n\r\nHuskyfarmin ura huonohkossa kunnossa, varsinkin tällaiselle ryhmälle.','',1),
(186,53,10,'2005253','2020-02-09 10:30:00','Lanssi-Kaunispää-Palopää-Kartano-Karvamarket-T-risetys-Laanila-Lanssi.','Lanssi-urupää-Kolmikanta-Kartano-Nelostie-T-risteys-Neste-Lanssi','','','','','1 kelkka kaatui. Tuulilasin suoja rikkoutui.\r\nRaportin teki Matilde.\r\nEi henkilövahinkoja.',1),
(187,46,20,'1909085','2020-02-09 20:30:00','saariselkä/koppelo/ukonjärvi/saariselkä','','','20:15 - 23:15','','','',1),
(188,11,10,'1909123','2020-02-10 09:00:00','Lanssi-Kaunispää-Palopää-Moitakuru-Kotaniemi-Keskireitti-Urupää-Kaunispää-Lanssi','Lanssi-Kaunispää-Palopää-Moitakuru-Kotaniemi-Karvamarketti-Länsipuoli-Hangasoja-Laanila-Neste-Lanssi','','','','','',1),
(189,13,7,'2006283','2020-02-10 10:00:00','Puistoon vanhalta sillalta, mäki ylös ja kurulle, uudelta sillalta takaisin.','','','','','','',1),
(190,52,3,'2000704','2020-02-10 11:00:00','lanssi-magneettimäki-lentokentän reitti- ivalon reitti-keskireitti-urupää-lanssi','','','','','','',1),
(191,53,2,'1909046','2020-02-10 13:00:00','Lanssi-Kaunispää-Nelostie-T-risteys-Laanila-Neste-Lanssi','','','','','','',1),
(192,46,17,'1912405','2020-02-10 19:00:00','lanssi/keskireitti/urupää/karvamarketti/länsireitti/4 tien ylitys/pukinpuro/lanssi','lanssi/keskireitti/urupää/karvamarketti/länsireitti/magneettimäki/kaunisniemi/neste/lanssi','','','','','',1),
(193,53,10,'2005252','2020-02-11 09:30:00','Lanssi-Kaunispää-Urupää-Sähkölijna-Kolmikanta-Kartano-Nelostie-T-risteys-Neste-Lanssi','','','','','','',1),
(194,13,5,'2006429','2020-02-11 13:00:00','Viskitien lenkki teitä pitkin.','','','','','','',1),
(195,46,2,'1907929','2020-02-11 13:00:00','lanssi/kaunispään rinne/urupää/palopää/kaunispää/4 tien ylitys/kaunisniemi/neste/lanssi','lanssi/kaunispään rinne/urupää/palopää/kaunispää/lanssi','','','','','',1),
(196,46,16,'1901664','2020-02-11 20:00:00','Aurorapolun ympäristö.','','','','','','',1),
(197,11,24,'2006598','2020-02-12 08:30:00','Lanssi-Kaunispää-Palopää-Kuukkelilampi-Moitakuru-Kartano-Keskireitti-Urupää-Lanssi','','','','','','',1),
(198,32,7,'2006496','2020-02-12 10:00:00','UKK:ta ristin rastin','','','','','','',1),
(199,17,2,'1908425','2020-02-13 09:30:00','lanssi - laaanila - kaunisniemi - urupää -palopää - kaunispää -lanssi','','Group Marc Enrich was playing the whole safari and I mentioned about this several times but they didn\'t follow the rules. Customers complained that it was boring and too slow because they do motorbike racing. :P','Group of 4 Marc Enrich didn\'t show up in Kiilopää, I waited for 15 minutes (until 9:10) and left without them. They showed up in klubi and told me that they had taken their own car. For this reason we started about 10 min late (the other customers from Kiilopää still had to get dressed).','','','',1),
(200,11,24,'2006124','2020-02-13 13:00:00','Lanssi-Neste-Uule-Neste-Lanssi','lanssi-neste-uule-kaunisniemi-4-tie-sähkölinja-lanssi','','','','','',1),
(201,13,24,'1906695','2020-02-13 20:00:00','ABC: Bussilla kammille ja takaisin.','','','','','','',1),
(202,32,7,'1905419','2020-02-14 10:00:00','UKK:ta ristin rastin','','','','','','',1),
(203,52,10,'2005249','2020-02-14 09:30:00','lanssi-länsireitti-karvamarketti-kotaniemi-moitakuru-palopää-lanssi','','','','','','',1),
(204,23,3,'2007036','2020-02-14 09:00:00','2H FRENCH DRIVERS DREAM : LAANILA LOOP, west road to north, paalopaa and back','LAANILA, KUUSIPAA, URUPAA, KAUNISPAA','','','','','',1),
(205,11,3,'2006699','2020-02-14 11:00:00','Lanssi-Sähkölinja-Länsipuoli-Karvamarketti-Ivalojoki-Lentokentänreitti-Magneetti,äki-Urupää-Lanssi','','','','','','',1),
(206,11,1,'1904828','2020-02-14 15:00:00','Lanssi-Kaunispää-Lanssi','','','','','','',1),
(207,32,16,'1903388','2020-02-14 20:00:00','Eiköhän taas käydä siellä kansallispuistossa.','','','','','','',1),
(208,45,1,'2007413','2020-02-15 14:00:00','lanssi-urupää-(palopää)-kaunispää-lanssi','','','','','','',1),
(209,47,19,'1919381','2020-02-15 18:00:00','middle road-west road-pukinpuro-back','','','','','','',1),
(210,13,24,'2002000','2020-02-15 20:00:00','ABC: Klo 20 lähtö Kammille ja klo 22:25 lähtö Kammilta takaisin.','','','','teatterin kaiuttimen laturi reistailee. Liittimet tms herkät, ei meinaa asettua lataamaan.','','',1),
(211,31,24,'2002116','2020-02-16 13:30:00','Saariselka-Kaunisniemi-Saariselka','','','','','Client drove off from the official track and tipped over in the deep snow.No personal injuries or damage on the snowmobile. We offered doctor and hospital, but the clients said they are completly fine.','',1),
(212,46,1,'2001141','2020-02-17 09:00:00','lanssi/s-marketin kyltti/kaunispää/s-market/lanssi','','2006270 Has &amp; Samson maksoivat solo supplimentin','','','','',1),
(213,46,19,'2001122','2020-02-17 19:00:00','lanssi/s-market kyltti/kaunispää/palopää/urupää/4 tien ylitys/kaunisniemi/neste/lanssi','lanssi/smarket kyltti/kaunispää/urupää/4 tien ylitys/kaunisniemi/neste/lanssi','','19:00 - 22:30','','','',1),
(214,47,5,'2002896','2020-02-18 13:00:00','laanila path and fat bike  track red back to saariselka','same','after the middle point, slow drivers','25 min late','','','',1),
(215,17,11,'1909484','2020-02-19 09:00:00','lanssi - urupää - palopää - kenkäily siellä - moitakuru - pilkki Kotaniemi - lounas Kartano - takaisin','','','','','','',1),
(216,11,24,'1906894','2020-02-19 10:00:00','Lanssi-Kaaunispää-Palopää-Tirro-Palopää-kaunispää-4-tie-Kaunisniemi-Neste-Lanssi','Lanssi-Kaunispää-Palopää-Tirro-Palopää-Kaunispää-Lanssi','','','','','',1),
(217,32,24,'1916367','2020-02-19 13:00:00','Lumiaita - Urupää - Pukinpuro - Pukinpuron p-paikka','','','','','','',1),
(218,45,19,'2001173','2020-02-20 19:00:00','lanssi-urupää-korvamarketti-magneettimäki-pukinpuro-lanssi',NULL,NULL,NULL,NULL,NULL,NULL,0),
(219,3,4,'2008181','2020-02-21 09:00:00','ski trak -&gt; laanila and back','','','','','','',1),
(220,32,1,'2008184','2020-02-21 09:00:00','Lanssi - niin pitkälle kuin pääsee Kaunispäälle - ja takaisin','Käännyttiin ennen 4t ylitystä','','','','YHden asiakkaan ajolinjoja piti korjata kolme kertaa, oppaan ajamana, matkan aikana koska oli menossa pöpelikköön','',1),
(221,11,3,'1909484','2020-02-21 11:00:00','Lanssi-Neste-Laanila-Kaunisniemi-Länsipuoli-Karvamarketti-Keskireitti-Urupää-Lanssi','Lanssi-Neste-Laanila-Kakslauttanen-Kuttura-Kaunisniemi-Länsipuoli-Karvamarketti-Moitakuru-Palopää-Kaunispää-Kaunisniemi-Neste-Lanssi','','','','','',1),
(222,32,24,'2007123','2020-02-21 13:00:00','Short Skis\r\n\r\nLumiaita - Uurupään yli/ympäri, reitti tuulesta riippuen- Pukinpuro - Pukinpuron p-paikka','','','','','','',1),
(223,32,16,'1905335','2020-02-21 20:00:00','UKK','','','','','','',1),
(224,3,19,'1905505','2020-02-21 20:00:00','lanssi - laanila - kusipää - pukinpuro - sahkolinea - lanssi','','','','','','',1),
(225,17,13,'2007266','2020-02-22 08:30:00','husky safari 5 h\r\n\r\nlanssi - palopää - kuukkelilampi - kartano - keskireitti - laanila - lanssi','','','','','one machine tipped over on the route from the official track to the husky kennel. No damage to machine or person.','',1),
(226,32,4,'1907772','2020-02-22 10:00:00','Latua etelään','','Kaikki halusivat jatkaa ominpäin Laanilaan mehutauon jälkeen.','','','','',1),
(227,11,17,'2005123','2020-02-24 19:00:00','Lnassi-Neste-Kaunisniemi-Kaunispää-Urupää-Pukinpuro-Lanssi','','','','','','',1),
(228,11,2,'2007560','2020-02-25 09:30:00','Lanssi-Kaunispää-Palopää-Kaunispää-4-tie-Kaunisniemi-Neste-Lanssi','','','','','','',1),
(229,32,1,'2007897','2020-02-25 09:00:00','Kaunispään suuntaan niin pitkälle kuin pääsee','','','','','','',1),
(230,51,1,'1908428','2020-02-26 09:00:00','lanssi-neste-sähkölinja-kaunispää-sama latu takaisin','lanssi-neste-sähkölinja-kaunispää-urupään risteys-sähkölinja-neste-lanssi','','','','','',1),
(231,51,3,'1917684','2020-02-26 11:00:00','lanssi-neste-kakslauttanen-urupää-palopää-karvamarket-kaunispää-lanssi','lanssi-neste-sähkölinja-urupää-palopää-karvamerket-kaunisniemi-neste-lanssi','','we where 10min early in lanssi.','','','',1),
(232,32,24,'1903308','2020-02-26 13:00:00','Short Skis:\r\n\r\nLumiaita - Urupää- Pukinpuro - Pukinpuron p-paikka','','','','','','',1),
(233,11,17,'2005004','2020-02-26 19:00:00','Lanssi-Neste-Kaunisniemi-Magneettimäki-4-tie-Kaunispää-Urupää-Pukinpuro-Lanssi','','','','','','',1),
(234,32,17,'1900623','2020-02-26 19:00:00','Lanssi-Kaunispää-Pukinpuro-Kaunisniemi-Lanssi','','','','','','',1),
(235,11,24,'2007052','2020-02-27 10:30:00','Lanssi-Neste-Kaunisniemi-4-tie-Kaunispää-Palopää-Tirro-Moitakuru-Kammi-Karvamarketti-Keskireitti-Urupää-Lanssi','','','','','','',1),
(236,31,2,'1906189','2020-02-27 13:00:00','saariselka-kaunispaa-palopaa-kaunispaa-saariselka',NULL,NULL,NULL,NULL,NULL,NULL,0),
(237,32,19,'1904722','2020-02-27 19:00:00','Lanssi-Kaunispää-Palopää-Tirrolampi-ja takaisin','','','N.30min myöhässä ison ryhmän ja revontulien takia','Huonolla kelillä vaikea löytää hyvää tulipaikkaa noin isolle ryhmälle','','',1),
(238,3,24,'0000000','2020-02-28 13:00:00','short skis pukinpuro - urupää',NULL,NULL,NULL,NULL,NULL,NULL,0),
(239,32,5,'1903241','2020-02-29 13:00:00','Klubi-Laanila-Fatreitti Piispanojan kautta-Klubi','','','','','','',1),
(240,32,19,'1909865','2020-02-29 19:00:00','Lanssi-tulipaikka-Lanssi','Lanssi-kaunisniemen ympäri via south-pukinpuro-Lanssi','Pari paxia halusivat sinkut lanssissa (&quot;ei tiennyt että perushinta on kaksi kelkalla&quot;)\r\n\r\nOtettiin lisäkelkka, yhteystiedot Fronttiin, tulevat maksamaan sinkku suplementit.\r\n\r\n2007128 Pedro Julio Mejia-Garagorry','','Väärä kelkkamäärä Lanssissa','','Kelkka kaatui pukinpurolla, ISO mies kuskina, pieni kallistuma ja melkein pysähdyksissä nurin.\r\nPolvi jumissa ohjaustangon ja maan välissä.',1),
(241,46,20,'2002900','2020-03-01 20:00:00','saariselkä/kaunispää/koppelo/nellim/saariselkä','saariselkä/ivalo/nellim/paasjoensilta\r\n/saariselkä','2007128 Daniel Marquez Colmenares  pax 2, NO SHOW, odotettu 20:06 asti.','20:10 - 23:30','','','',1),
(242,46,24,'2008671','2020-03-02 08:30:00','SM to husky farm 5 H\r\n\r\nlanssi/kaunispää/kuukkelinlampi, kartano/keskireitti/länsitie/kaunisniemi/neste/lanssi','lanssi/kaunispää/palopää/husky farm/kolmikantajärvi/keskitie/urupää/4tienylitys/kaunisniemi/neste/lanssi','','','','','',1),
(243,11,24,'2007092','2020-03-02 09:30:00','Lanssi-Urupää-Keskireitti-Karvamarketti-Kotaniemi-Kartano-Moitakuru-Palopää-Kaunispää-Lanssi','Lanssi-Urupää-Keskireitti-Karvamarketti-Kotaniemi-Kartano-Moitakuru-Kaunispää-4-tie-Kaunisniemi-Neste-Lanssi','','','','','',1),
(244,46,3,'1904461','2020-03-03 11:00:00','lanssi/kaunispää/palopää/kolmikantajärvi/karvamarketti/länsitie/kaunisniemi/laanila/neste/lanssi','lanssi/kaunispää/urupää/palopää/kaunispää/4 tien ylitys/kaunisniemi/meste/lanssi','','','','','',1),
(245,32,24,'1915113','2020-03-04 08:30:00','SM to Husky:\r\n\r\nLanssi - Huskyfarm - Lanssi','','Suuri kielimuuri Italialaispariskunnan kanssa, eikä loppujen lopuksi onnistunut kelkan ajokaan. Ennen ensimmäistä tienylitystä käytiin hakee reki niille, oikein tyytyväisiä ratkaisuun.','Vähän myöhässä Huskyfarmilla, ja niiden tiukan aikataulun takia me hoidettiin lounastarjoilun. Ei ongelmaa mutta vähän vähemmän koirainfoa kuin yleensä, ilmeisesti.','','Koko ura pääreitiltä farmille yhtä isoa &quot;near miss:iä&quot;, käsittämättömän huonossa kunnossa. (= Yksi kelkan jälki hurjilla kallistuksilla)','',1),
(246,21,10,'2007103','2020-03-04 10:30:00','PT ice fishing\r\n\r\nlanssi - kaunisniemi - palopaa - tirrolampi - lunch in kammi - back west raod - lanssi','','','','','3 times tipped over, no damages','',1),
(247,46,3,'2005473','2020-03-04 11:00:00','lanssi/kaunispää/palopää/kuukkelinlammenreitti/kolmikantajärvi/lansitie/magneettimäki/kaunisniemi/laanila/neste/lanssi','lanssi/kaunispää/palopää/kuukkelinlammenreitti/kolmikantajärvi/länsitie/magneettimäki/kaunisniemi/kuusipää/laanila/neste/lanssi','','','','','',1),
(248,46,20,'2008776','2020-03-04 20:00:00','saariselkä/koppelo/karhunpesä/saariselkä','saariselkä/magneettimäki/kartano/koppelo/saariselkä','','19:45 - 22:45','','','',1),
(249,32,4,'2001714','2020-03-05 10:00:00','Latua Laanilan suuntaan','','','Peruutus allekirjoittaneelle, puolet asiakkaista jäi pois.','','','',1),
(250,32,16,'1906083','2020-03-06 20:00:00','UKK','','','','','','',1),
(251,13,19,'1905760','2020-03-06 21:00:00','Kaunisniemen ympäri eteläkautta, Urupäälle, Pukinpurolle, lanssiin.','','','','','','',1),
(252,11,24,'2007051','2020-03-07 09:30:00','Lanssi-Kaunispää-Palopää-Kuukkelilampi-Moitakuru-Karvamarketti-Keskireitti-Urupää-Lanssi','','','','','','',1),
(253,13,11,'1911284','2020-03-07 09:00:00','Palopää - Moitakuru - Kotaniemi - Kartano - Urupää - Lanssi','','','','','','',1),
(254,21,3,'2010296','2020-03-07 09:00:00','lanssi - lanilaa - kakslauttanen - kiilopaa - lanilaa - maybe urupaa and back lanssi',NULL,NULL,NULL,NULL,NULL,NULL,0),
(255,32,3,'2007097','2020-03-07 11:00:00','Lanssi-Laanilan reitti-Kakslauttsenreitti-länsireitti-kuukkelilammenreitti-Lanssi','','','','','','',1),
(256,46,16,'1907517','2020-03-08 20:00:00','aurorapolun ympäristö.','','','','','','',1),
(257,13,17,'2010412','2020-03-09 19:00:00','Kaunispää - Urupää - Pukinpuro - Kaunisniemi - Lanssi','','','Mehut unohtu matkasta, mutta oli cookieta sen sijaan. Asiakkaat ei valittaneet.','','','',1),
(258,13,11,'1920480','2020-03-11 09:00:00','Keskireittiä Kotaniemeen, itäreittä Kartanon kautta pois.','','','','','','',1),
(259,32,24,'2010564','2020-03-11 13:00:00','Short Skis:\r\n\r\nPpuro p-paikka - Urupää - Ppuro - p-paikka','','','','','','',1),
(260,32,19,'2005591','2020-03-11 19:00:00','Lanssi-Urupää-Palopää-Tirrolampi-Palopää-Kaunispää-Lanssi',NULL,NULL,NULL,NULL,NULL,NULL,0),
(261,13,24,'2010912','2020-03-12 08:30:00','Kelkkahusky: Palopään kautta suoraan huskeille ja sieltä suoraan takaisin.','','','','','','',1),
(262,46,4,'1920480','2020-03-12 10:00:00','harjoituslatu/laanilan suuntaan ja takaisin','','','','','','',1),
(263,46,24,'2007192','2020-03-16 13:00:00','snow fun by short skiis / urupää/pukinpuro','','','13:00 - 16:45','','','',1),
(264,11,19,'1916966','2020-03-16 19:00:00','Lanssi-Kaunispää-Palopää-Joiku-Urupää-Pukinpuro-Kaunisniemi-Laanila-neste-Lanssi','Lanssi-Kaunispää-Palopää-Joiku-Urupää-Pukinpuro-Kaunisniemi-Neste-Lanssi','','','','','',1),
(265,13,2,'2003521','2020-03-18 13:00:00','Urupää - Palopää - Kaunispää','','','','','','',1),
(266,46,4,'2011169','2020-03-19 10:00:00','harjoituslatu/laanilan suuntaan','','','','','','',1);
/*!40000 ALTER TABLE `route` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `safari`
--

DROP TABLE IF EXISTS `safari`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `safari` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `length` smallint(6) NOT NULL,
  `weekday` char(7) NOT NULL,
  `description` mediumtext NOT NULL,
  `time` time NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `safari`
--

LOCK TABLES `safari` WRITE;
/*!40000 ALTER TABLE `safari` DISABLE KEYS */;
INSERT INTO `safari` VALUES
(1,'introduction to snowmobiling',60,'1010100','Would you like to try snowmobiling for the first time, but are not sure if you are up to it? Then this is the safari for you! Lapland Safaris guide will teach you how to handle the snowmobile and you will make a short drive to get used to the machine. We use specially adjusted snowmobiles making the driving easier and safer for first timers. And after this, you are ready for longer safaris!','09:00:00',1),
(2,'scenic safari',150,'0101010','This snowmobile safari is to enjoy the beautiful nature of Fell Lapland and having no rush with driving. Route climbs up the fells all the way to the top, where opens a beautiful landscape. Remember your camera as we will have plenty of pauses to take pictures! Warm berry juice served','09:30:00',1),
(3,'rider\'s dream',180,'1010100','Snowmobile safari for you who would like to find the real touch for driving. This safari lets you to discover varying route profiles, giving you a good sense on how to handle the machine. You will manage the snowmobile without a passenger, which gives you extra feeling of freedom. Along the way, you will experience some stunning sceneries over vast wilderness. Hot berry juice offered during the safari. NOTE: suitable only for people over 18 years with a valid driving license, as all participants will be driving an own snowmobile.','11:30:00',1),
(4,'cross country skiing trip',120,'0101010','Fasten the skis, lean on the ski poles and glide along the tracks through the pure whiteness. If you are a first timer on skis, there will be an introduction on the basic techniques of skiing. A stop is made to have a cup of warm berry juice. The price includes the equipment rental until 17:00, so you can go skiing on your own time and pace afterwards. NOTE: This safari is suitable for children of 12 years or older.','10:00:00',1),
(5,'snow biking adventure',180,'0101010','Come and join us on a guided snow adventure with fatbikes! After receiving your helmet, bike, and instructions on how to handle the bike, the adventure is ready to start and take you through snowy landscapes of Saariselkä. During the adventure you will enjoy the silence of the tranquil forests and nature around you. A break will be held for you to stop for a rest, fry sausages, and to enjoy some hot berry juice around an open fire. NOTE:  This excursion is suitable for children of 12 years or older and requires basic knowledge of riding a bike.','13:00:00',1),
(6,'forest skiing experience',180,'1010100','Join for short ski trip through the snow-covered forests and windswept fell areas! Short skis, also called short skis are easy-to-use, off-track forest skis that combine the best features of snowshoes and skis and do not require previous experience in skiing. You will be provided with all the equipment required for skiing. After a short (5 -10 min) transportation by car the journey will start into the white silence by short skis. The guide leads you to nearby creek where it’s time to enjoy a snack by the campfire and admire the pure nature that surrounds you. Returning back to Saariselkä by short skis. NOTE: This safari is suitable for children of 12 years or older.','13:00:00',1),
(7,'white silence on snowshoes',120,'1010100','Let’s go wandering to the fells. This showshoe adventure will take you through the picturesque snowy wilderness. During the trip, you will get to walk both on marked tracks and in the deep snow. You might even find some tracks made by rabbits, foxes and willow grouses if you are lucky! There will be breaks to take photos and enjoy warm berry juice on the way. NOTE: This safari is suitable for children of 12 years or older.','10:00:00',1),
(8,'snowmobile safari to a reindeer farm',180,'1001010','Visit a local reindeer farm by snowmobile. At the farm, the Sámi host will welcome you and introduce you to the reindeer husbandry and Lapland’s indigenous culture that evolves around the reindeer. During the visit, you will learn how to throw ‘suopunki’, the Lappish lasso used to catch a reindeer, and to ride the reindeer sleigh. Before returning, you will have a coffee break and learn more about Lappish culture and reindeer.','13:00:00',1),
(9,'snowmobile safari to a husky farm',300,'1010010','This safari will take for a husky sledding experience by snowmobiles. At the husky farm, located North to Saariselkä, you will meet the husky dogs, get the instructions on how to handle the dogs, and enjoy a lovely (approx.) 25 min ride on a sledge pulled by huskies. Two people share a sledge and the drivers can be swapped during the ride. After the safari, you will have a warm juice in a kota and hear more about the life at the farm. During the safari lunch is served on a route. Driving back to Saariselkä by snowmobile.','08:30:00',1),
(10,'fishing experience by snowmobile',240,'0100100','The trail on this snowmobile safari takes you to north of Saariselkä to a remote lake. Drill a hole through the ice and try your fishing skills. The catch may even be the jewel of Lapland\'s crystal waters, the Arctic char. You will enjoy a snack by the campfire and have the opportunity to fry the fresh fish you just caught.','09:00:00',1),
(11,'snowmobile safari in the heart of the nature',360,'0010000','Enjoy the great outdoors on this wilderness snowmobile safari to the heart of nature. The trail traverses rugged fells and narrow valleys before coming to the first stop, where you have the chance to try ice fishing and snowshoe walking. You will then continue onwards through the forest – perhaps coming across a herd of reindeer searching for their favourite food, moss and lichen, buried under as much as one metre of snow. Keep your eyes open also for other forest animals searching for food! The weather in Lapland can change quickly – ranging from cold, blizzard conditions to sunshine over crisp and fresh snow – the snowmobile trail we follow may change accordingly. A delicious Lappish style lunch will be served during the day. NOTE: This safari is suitable only for adults and children 15 years and over and requires good physical condition.','09:00:00',1),
(12,'reindeer safari',120,'1111111','This safari introduces you to the Northern transport – reindeer sleigh. In the old days the only means of winter transportation for the people of Lapland was on sleighs pulled by reindeer. Often, there could be as many as 25 - 30 reindeer in a long raito caravan. You will experience this traditional, peaceful way of moving through snowscapes where the only sound you will hear is the light ringing of reindeer bells. Warm drink will be served by the fire.','10:00:00',1),
(13,'husky safari 10Km',180,'1111111','Wintertime safari with a team of huskies. The barking of enthusiastic dogs will welcome you to the farm. Before departing on your journey, you will be given instructions on how to control the sleds, which you will ride in pairs. You may swap places at the halfway point. The head musher will talk about the life and training of these Arctic animals and you will also have the chance to take some great photos. Warm drink will be served by a campfire. Transfers to the husky farm by bus.','12:30:00',1),
(14,'husky safari 20Km',300,'1010010','Wintertime safari with a team of huskies. The barking of enthusiastic dogs will welcome you to the farm. Before departing on your journey, you will be given instructions on how to control the sleds, which you will ride in pairs. You may swap places at the halfway point. The head musher will talk about the life and training of these Arctic animals and you will also have the chance to take some great photos. Warm drink will be served by a campfire. Transfers to the husky farm by bus.','10:30:00',1),
(15,'evening safari by reindeer',120,'0110100','Sit back in a sleigh pulled by a reindeer and start your journey into the quiet night forest. With some luck you might even see the Northern Lights dancing in the sky! Enjoy the warmth of campfire while sipping warm drink, listen to the sound of the forest and fire, and realise how silent and light Arctic darkness is.','19:00:00',1),
(16,'aurora hunting on snowshoes',120,'0100101','Capture the true feeling of a winter night in the northern woods. Your guide will take you to learn the wintry way of travelling with snowshoes. While walking on the snow, you will experience how the milky light of the moon and stars cast enchanting shadows through the snowfields. Have a break and enjoy some warm berry juice while the only sound you hear is the sough of the forest and fells. If you are lucky, you may even see the Northern Lights. NOTE: This safari is suitable for children of 12 years or older.','20:00:00',1),
(17,'aurora borealis snowmobile sleigh ride',180,'1000100','During this leisurely safari you can just sit back and enjoy the view and ride! Your guide will take you to the fell district to see the beautiful fell scenery with open view to the northern sky. Your journey will head towards a beautiful wilderness cabin where you can enjoy warm berry juice while admiring the nature. If we are lucky and the sky is clear, the moon, stars and even the Northern lights may appear!','20:00:00',1),
(18,'excursion to aurora borealis camp by bus',180,'1000010','This excursion takes you into the northern evening app. 20 km away from the city lights with good view to the northern sky. At the camp you will find the Aurora Borealis theatre build inside a snow igloo presenting a film about the myths and facts of this natural phenomenon along with spectacular photos of the Northern lights. Learn about the Lappish way of living from the stories on an illuminated path outside. Enjoy the delicious traditional reindeer burgers in the wooden Kammi cabin by the open fire. You will also have time to roam around the camp and take pictures. With a little luck the sky is clear and the moon, stars and even the Northern Lights may show up. After the evening, you will be provided with a diploma for Searching the Northern Lights.','20:00:00',1),
(19,'search of the northern lights by snowmobile',180,'1001010','This evening safari takes you in the search of the Northern Lights and to experience the exoticism of an Arctic night. Leaving illuminated city behind, the dark wilderness soon envelopes you. The snow, glittering under the moonlight, paints the scenery with magical shine. Your guide leads the snowmobiles towards the best spots to admire the Northern skies and seek for Northern Lights. With a little luck you are able to witness the sky dancing in the green shades of the Northern Lights. In the lightness of the Arctic night a stop is made to enjoy hot sausages and drinks by the open fire and share stories on the Arctic way of life.','20:00:00',1),
(20,'search of the northern lights by coach',180,'0011001','This safari will take you chasing Aurora Borealis by minibus. The guide will lead you to the best possible spots to observe the phenomena of Arctic sky. With a little luck, if the sky is clear, the moon, the stars and even the Northern lights will show up. On the way the guide will tell you stories about life in Lapland and the Northern lights.','20:00:00',1),
(21,'tui optional',180,'1111111','any optional for TUI','20:00:00',1),
(22,'travelkids optional',180,'1111111','any optional for travelkids','00:00:00',1),
(23,'santas lapland optinal',180,'1111111','any optional for santas lapland','00:00:00',1),
(24,'other optional',180,'1111111','taylor made safari','00:00:00',1);
/*!40000 ALTER TABLE `safari` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trip`
--

DROP TABLE IF EXISTS `trip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trip` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `safari_id` smallint(5) unsigned NOT NULL,
  `erp_link` varchar(9) NOT NULL,
  `date` datetime NOT NULL,
  `route` varchar(150) NOT NULL,
  `remarks` varchar(300) DEFAULT NULL,
  `done` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `fk_trip_user` (`user_id`),
  KEY `fk_trip_safari` (`safari_id`),
  CONSTRAINT `fk_trip_safari` FOREIGN KEY (`safari_id`) REFERENCES `safari` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_trip_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trip`
--

LOCK TABLES `trip` WRITE;
/*!40000 ALTER TABLE `trip` DISABLE KEYS */;
INSERT INTO `trip` VALUES
(9,1,16,'73712','2022-02-27 19:45:00','office - kekkonen - aurora cabin - el culo - back',NULL,1),
(11,1,1,'60533','2022-02-27 22:15:00','lanssi - urupää - kaunispää - back',NULL,1),
(12,1,3,'86140','2022-02-28 16:00:00','lanssi - sahkolinia - urupää - joikunkota - palopää - kaunispää',NULL,1),
(13,1,10,'83032','2022-03-02 09:00:00','lanssi - urupää - karvamarketti - tirolamppi - moitakuru - palopää - kaunispää - lanssi',NULL,1),
(14,1,5,'84485','2022-03-02 09:15:00','office - panino - tp - o&#039;poro - office','This sux!',1),
(15,1,2,'84485','2022-03-02 10:15:00','yes route, but crazy','no more remarks. I&#039;m feed up',1),
(16,1,13,'59568','2022-03-02 13:45:00','aeioøoö å ñ o\'porro. Esta parte es nüevå o\'porro','There\'s nöt müch to añadir o\'porro',1),
(17,1,9,'59568','2022-03-02 14:15:00','nono',NULL,1),
(18,1,16,'59568','2022-03-02 13:15:00','lapland - rollo - tampere - turku - never coming back',NULL,1);
/*!40000 ALTER TABLE `trip` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mail` varchar(45) NOT NULL,
  `password` char(64) DEFAULT NULL,
  `name` varchar(18) DEFAULT NULL,
  `surname` varchar(18) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT 0,
  `active` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uname` (`mail`),
  UNIQUE KEY `mail` (`mail`),
  UNIQUE KEY `mail_2` (`mail`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES
(1,'hugo.sastre@laplandsafaris.fi','6b6bf838063e554f031da357336f5be30a04f8786926be4e4a3e0c417215abf2','Hugo','Sastre',1,1),
(2,'fofonoffaaro@gmail.com',NULL,'Aaro','Fofonoff',0,1),
(3,'marta_833@hotmail.com',NULL,'Marta','Ruiz',0,1),
(4,'bjorn.wadenstrom@gmail.com',NULL,'Björn','Wadenström',0,1),
(5,'wernerusbruce@gmail.com',NULL,'Bruce','Wernerus',0,1),
(6,'davekelemeny@googlemail.com',NULL,'David','Kelemeny',0,1),
(7,'matilainen.esa@gmail.com',NULL,'Esa','Matilainen',0,1),
(8,'hugbri.pro@gmail.com',NULL,'Hugo','Brière',0,1),
(9,'janne.antola@laplandsafaris.fi',NULL,'Janne','Antola',0,1),
(10,'javiersalasgonz97@gmail.com',NULL,'Javier','Salas',0,1),
(11,'lt.plaa@gmail.com',NULL,'Jouko','Jalonen',0,1),
(12,'winterrosw@hotmail.com',NULL,'Roswitha','Wintermans',0,1),
(13,'kipez_@hotmail.com',NULL,'Kimmo','Keskitalo',0,1),
(14,'sebu.parot@gmail.com',NULL,'Sébastien','Parot',0,1),
(23,'lombard_mathilde@hotmail.com',NULL,'Mathilde','Lombard',0,1),
(24,'maxm.lecomte@gmail.com',NULL,'Maxime','Lecomte',0,1),
(25,'suomalainen.mika@gmail.com',NULL,'Mika','Suomalainen',0,1),
(26,'carloscrespogomis@gmail.com',NULL,'Carlos','Crespo',0,1),
(27,'lea.poirier@outlook.fr',NULL,'Léa','Poirier',0,1),
(28,'tytti.alastalo@gmail.com',NULL,'Tytti','Alastalo',0,1),
(29,'vappu.brannare@laplandsafaris.fi',NULL,'Vappu','Brännare',0,1),
(30,'vilma.karttunen@gmail.com',NULL,'Vilma','Karttunen',0,1),
(31,'juhavaltonen1981@gmail.com',NULL,'Juha','Valtonen',0,1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xmas_feedback`
--

DROP TABLE IF EXISTS `xmas_feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xmas_feedback` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `subject` varchar(150) NOT NULL,
  `text` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xmas_feedback`
--

LOCK TABLES `xmas_feedback` WRITE;
/*!40000 ALTER TABLE `xmas_feedback` DISABLE KEYS */;
/*!40000 ALTER TABLE `xmas_feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xmas_guide`
--

DROP TABLE IF EXISTS `xmas_guide`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xmas_guide` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  `surname` varchar(15) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `en` tinyint(3) unsigned NOT NULL DEFAULT 1,
  `sp` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `fr` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `jp` tinyint(3) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xmas_guide`
--

LOCK TABLES `xmas_guide` WRITE;
/*!40000 ALTER TABLE `xmas_guide` DISABLE KEYS */;
INSERT INTO `xmas_guide` VALUES
(1,'name','surname','phone',0,0,0,0),
(2,'Pavla','Hartigova','',1,1,2,0),
(3,'marta','zavaglia','+39 3481189267',1,0,0,0),
(4,'larab','hakim','0770163066',0,0,2,0),
(5,'Katie','Sutton','+447964573431',2,0,0,0),
(6,'Helene','Jouen','+33629731274',1,0,2,0),
(7,'Petr','Ourednicek','+420777197917',1,0,0,0),
(8,'kaity','stavropoulou','6949284517',1,0,0,0),
(9,'Ruben','Carmona Benitez','¨+34692540393',1,2,0,0),
(10,'Sara','G. Ibañez','+34690062721',1,2,0,0),
(11,'rowanne','hess','0033647448937',1,0,2,0),
(12,'madars','jubulis','',1,0,0,0),
(13,'Patrycja','Poniatowska','+48883174609',1,0,0,0),
(14,'aidan','powell','0449428964',2,0,0,0),
(15,'Jack','McDaid','+447366112333',2,0,0,0),
(16,'Antoni','Munoz Casas','+34611053040',1,2,0,1),
(17,'Alex','Rämänen','0403523544',1,0,0,0),
(18,'Baeke','Miguel','+32476398966',1,0,1,0),
(19,'martin','hansen','0409775673',1,0,0,0),
(20,'Pentti','Poikela','+35845191521',1,0,0,0),
(21,'William','Hamer','07487556172',2,0,0,0),
(22,'Bruce','Wernerus','+33684902771',2,0,2,0),
(23,'Maike','Drozinski','+491627795494',1,0,0,0),
(24,'Emma','Hoseason','+447450260267',2,0,0,0),
(25,'Jay','McPherson','07787005535',2,0,0,0),
(26,'Willoughby','Matthews','+447583197552',2,0,0,0),
(27,'santeri','loukonen','0449721084',1,0,0,0),
(28,'Anna','Leppänen','+358400626039',1,0,0,0),
(29,'ALEXANDER','STEFFEN','0452359744',2,0,0,0),
(30,'Eve','Osborne','+447402722081',2,0,0,0),
(31,'Victoria','Jolliffe','447851798752',2,0,0,0),
(32,'Noora','Henriksson','+358408245839',1,0,0,0),
(33,'Nathan','Thorpe','07446147142',2,0,0,0),
(34,'Chris','Sital Singh','00447956446401',2,0,0,0),
(35,'lisa','mciver','07308328906',2,0,0,0),
(36,'Klara','Svobodova','+420733310358',1,0,0,0),
(37,'iben','hall','',2,0,0,0),
(38,'marti','roses garriga','+34696283171',1,2,1,0),
(39,'jaume','olive masdeu','679887050',1,2,0,0),
(40,'emmi','sakari','0417026089',1,0,0,0),
(41,'Barbora','Pollakova','00436505330993',1,0,0,0),
(42,'Ana','Cunha','+351926599212',1,1,0,0),
(43,'Eluna','Verink','+31628738148',1,0,0,0),
(44,'goulard','eymeric','+33613207699',1,0,2,0),
(45,'Taneli','Ahtikallio','+358509182859',1,1,1,0),
(46,'Cosmin','Mirea','+40723347374',1,0,0,0),
(47,'Marine','Vergnais','+33618266071',1,0,2,0),
(48,'luis','pastor','+34640306604',1,2,0,0),
(49,'Sami','Saarinen','0505936121',0,0,0,0),
(50,'larab','hakim','',1,0,2,0),
(51,'vlasman','sandra','41 76 2149882',0,0,0,0),
(52,'Anita','Török','+36203885052',1,0,0,0),
(55,'Fredy','Conza','+358408100511',1,2,0,0),
(56,'Lucie','Galacova','+420604125085',1,0,0,0),
(57,'Petr','Skalka','+420734371159',1,0,0,0),
(59,'guillem','colomer','+34669315732',2,2,1,0),
(60,'jere','reponen','+358400735283',2,0,0,0),
(61,'Miriam','Renner','004915757114721',1,0,0,0),
(62,'Aidan','Banks-Broome','00447375663134',2,0,0,0),
(63,'Anna','Potoniec','+48530520616',1,0,0,0),
(64,'peet','van rietschoten','00436802430145',2,0,0,0),
(65,'Tino','Puttonen','0449716090',1,0,0,0),
(66,'Alejandro','Sanchez Comas','',1,2,0,0),
(67,'Dan','Hart','+447760927199',2,0,0,0);
/*!40000 ALTER TABLE `xmas_guide` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-11-26 11:24:24
