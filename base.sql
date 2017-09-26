
DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `post` text NOT NULL,
  `autor` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=161 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (156,'ROCK IN RIO 2017','','Quinta-feira (21) foi o primeiro dia dominado pelo rock no festival, com Aerosmith no fim da noite. Def Leppard, Fall Out Boy e Scalene também se apresentaram.','Just','2017-09-22 09:00:42','2017-09-22 09:00:42'),(157,'FUTEBOL','','Clube francês tem planejamento estabelecido para abertura de novas unidades, estuda programa de sócio-torcedor, amistoso anual e uma casa temática no país','Just','2017-09-22 09:01:24','2017-09-22 09:01:24'),(160,'MUNDO','','Coreia do Norte diz que pode testar bomba de hidrogênio no Pacífico; Trump chama Kim Jung-un de louco','Just','2017-09-22 09:02:05','2017-09-22 09:02:05');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` char(100) DEFAULT NULL,
  `email` char(100) DEFAULT NULL,
  `user` char(100) NOT NULL DEFAULT '',
  `pass` char(100) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nome` (`nome`),
  KEY `user` (`user`),
  KEY `pass` (`pass`)
) ENGINE=MyISAM AUTO_INCREMENT=77679582 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (77679581,'calado','calado@teste.com','admin','admin','2017-09-20 15:25:55');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
