-- MySQL dump 10.13  Distrib 8.0.20, for Linux (x86_64)
--
-- Host: localhost    Database: sgga
-- ------------------------------------------------------
-- Server version	8.0.20-0ubuntu0.20.04.1

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
-- Table structure for table `aviarios`
--

DROP TABLE IF EXISTS `aviarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `aviarios` (
  `IdAviario` int NOT NULL,
  `IdPeriodo` int NOT NULL,
  `LoteId` int NOT NULL,
  `Aviario` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Femeas` int NOT NULL,
  `Machos` int NOT NULL,
  `DataAviario` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`IdAviario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aviarios`
--

LOCK TABLES `aviarios` WRITE;
/*!40000 ALTER TABLE `aviarios` DISABLE KEYS */;
INSERT INTO `aviarios` VALUES (1,1,1,'1',3156,32,'2019-09-12 03:00:00'),(2,1,1,'2',394,323,'2019-09-12 03:00:00'),(3,1,2,'1',525,123,'2019-09-12 03:00:00'),(4,1,2,'2',739,113,'2019-09-12 03:00:00');
/*!40000 ALTER TABLE `aviarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `TRG_EntradaAves_AI` AFTER INSERT ON `aviarios` FOR EACH ROW BEGIN
      CALL SP_AtualizaEstoqueAves (new.IdAviario, new.IdPeriodo, new.Aviario, new.LoteId, new.Femeas, new.Machos);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `TRG_EntradaAves_AU` AFTER UPDATE ON `aviarios` FOR EACH ROW BEGIN
      CALL SP_AtualizaEstoqueAves (new.IdAviario, new.IdPeriodo, new.Aviario, new.LoteId, new.Femeas - old.Femeas, new.Machos - old.Machos);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `TRG_EntradaAves_AD` AFTER DELETE ON `aviarios` FOR EACH ROW BEGIN
      CALL SP_AtualizaEstoqueAves (old.IdAviario, old.IdPeriodo, old.Aviario, old.LoteId, old.Femeas * -1, old.Machos * -1);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `backup`
--

DROP TABLE IF EXISTS `backup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `backup` (
  `IdBackup` int NOT NULL,
  `NomeBD` varchar(50) NOT NULL,
  `Usuario` varchar(50) NOT NULL,
  `Senha` varchar(50) NOT NULL,
  `Diretorio` varchar(50) NOT NULL,
  `Agendamento` time NOT NULL,
  `Unidade` varchar(5) NOT NULL,
  PRIMARY KEY (`IdBackup`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backup`
--

LOCK TABLES `backup` WRITE;
/*!40000 ALTER TABLE `backup` DISABLE KEYS */;
INSERT INTO `backup` VALUES (1,'sgga','root','16050912','backup','17:05:00','D');
/*!40000 ALTER TABLE `backup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `checklist`
--

DROP TABLE IF EXISTS `checklist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `checklist` (
  `IdChecklist` int NOT NULL,
  `IdPeriodo` int NOT NULL,
  `DataInicial` date NOT NULL,
  `Data` date NOT NULL,
  `Mes` int NOT NULL,
  `Percent` decimal(9,2) NOT NULL,
  PRIMARY KEY (`IdChecklist`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `checklist`
--

LOCK TABLES `checklist` WRITE;
/*!40000 ALTER TABLE `checklist` DISABLE KEYS */;
/*!40000 ALTER TABLE `checklist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coleta`
--

DROP TABLE IF EXISTS `coleta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coleta` (
  `IdColeta` int NOT NULL,
  `IdPeriodo` int NOT NULL,
  `NumColeta` int NOT NULL,
  `LoteId` int NOT NULL,
  `AviarioId` int NOT NULL,
  `DataColeta` date NOT NULL,
  `Hora` time NOT NULL,
  `LimposNinho` int NOT NULL,
  `SujosNinho` int NOT NULL,
  `OvosCamaIncubaveis` int NOT NULL,
  `DuasGemas` int NOT NULL,
  `Pequenos` int NOT NULL,
  `Trincados` int NOT NULL,
  `CascaFina` int NOT NULL,
  `Deformados` int NOT NULL,
  `Frios` int NOT NULL,
  `SujosNaoAproveitados` int NOT NULL,
  `EsmagadosQuebrados` int NOT NULL,
  `Descarte` int NOT NULL,
  `OvosDeCamaNaoIncubaveis` int NOT NULL,
  `TotalIncubaveis` int NOT NULL,
  `TotalIncubaveisBons` int NOT NULL,
  `TotalComerciais` int NOT NULL,
  `PosturaDia` int NOT NULL,
  PRIMARY KEY (`IdColeta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coleta`
--

LOCK TABLES `coleta` WRITE;
/*!40000 ALTER TABLE `coleta` DISABLE KEYS */;
INSERT INTO `coleta` VALUES (1,1,1,1,0,'2019-10-02','16:54:05',180,22,4,4,2,1,2,5,3,2,4,6,1,206,202,24,230),(2,1,2,1,1,'2019-10-02','16:55:26',10,2,2,2,2,2,2,2,2,2,2,4,2,14,12,18,32);
/*!40000 ALTER TABLE `coleta` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `TRG_EntradaOvos_OI` AFTER INSERT ON `coleta` FOR EACH ROW BEGIN
      CALL SP_AtualizaEstoqueOvos (new.IdColeta, new.LoteId, new.IdPeriodo, new.TotalIncubaveis, new.TotalComerciais - new.Descarte, new.PosturaDia - new.Descarte);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `TRG_EntradaOvos_OU` AFTER UPDATE ON `coleta` FOR EACH ROW BEGIN
      CALL SP_AtualizaEstoqueOvos (new.IdColeta, new.LoteId, new.IdPeriodo, new.TotalIncubaveis - old.TotalIncubaveis, new.TotalComerciais - old.TotalComerciais, new.PosturaDia - old.PosturaDia);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `TRG_EntradaOvos_OD` AFTER DELETE ON `coleta` FOR EACH ROW BEGIN
      CALL SP_AtualizaEstoqueOvos (old.IdColeta, old.LoteId, old.IdPeriodo, old.TotalIncubaveis * -1, old.TotalComerciais * -1 - old.Descarte * -1, old.PosturaDia * -1 - old.Descarte * -1);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `despesas`
--

DROP TABLE IF EXISTS `despesas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `despesas` (
  `IdDespesa` int NOT NULL,
  `IdPeriodo` int NOT NULL,
  `Descritivo` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Valor` decimal(9,2) NOT NULL,
  `Data` date NOT NULL,
  PRIMARY KEY (`IdDespesa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `despesas`
--

LOCK TABLES `despesas` WRITE;
/*!40000 ALTER TABLE `despesas` DISABLE KEYS */;
INSERT INTO `despesas` VALUES (1,1,'Agua',159.00,'2019-09-13');
/*!40000 ALTER TABLE `despesas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eclosao`
--

DROP TABLE IF EXISTS `eclosao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `eclosao` (
  `IdEclosao` int NOT NULL,
  `IdPeriodo` int NOT NULL,
  `DataInicial` date NOT NULL,
  `Data` date NOT NULL,
  `Semana` int NOT NULL,
  `Percent` decimal(9,2) NOT NULL,
  PRIMARY KEY (`IdEclosao`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eclosao`
--

LOCK TABLES `eclosao` WRITE;
/*!40000 ALTER TABLE `eclosao` DISABLE KEYS */;
/*!40000 ALTER TABLE `eclosao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email`
--

DROP TABLE IF EXISTS `email`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `email` (
  `IdEmail` int NOT NULL,
  `Smtp` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Porta` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Seguranca` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Usuario` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Senha` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Remetente` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `DestSemanal` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `DestColetas` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Assunto` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Mensagem` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Anexo` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`IdEmail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email`
--

LOCK TABLES `email` WRITE;
/*!40000 ALTER TABLE `email` DISABLE KEYS */;
INSERT INTO `email` VALUES (1,'smtp.gmail.com','587','tls','andersonbrasil72@gmail.com','16050912gb','Anderson','andersonbrasil@outlook.com, cezarandrigo@gmail.com','andersonbrasil@outlook.com, cezarandrigo@gmail.com','Relatórios','Você está recebendo os relatórios diário de coletas ou relatório semanal de mortalidades e peso.','C:\\Relatorios');
/*!40000 ALTER TABLE `email` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresa`
--

DROP TABLE IF EXISTS `empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `empresa` (
  `IdEmpresa` int NOT NULL,
  `Logotipo` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `RazaoSocial` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Endereco` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Localidade` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Localizacao` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Telefone` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`IdEmpresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tabela com dados da empresa';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresa`
--

LOCK TABLES `empresa` WRITE;
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
INSERT INTO `empresa` VALUES (1,'fa3b464b4d34158a050265f4b448f98f.jpg','Cezar Andrigo de Almeida','gfgfdgfdgfg','dfgfgdfg','gfdg','dfgfgdfg','(44)34423-4243');
/*!40000 ALTER TABLE `empresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `envio_ovos`
--

DROP TABLE IF EXISTS `envio_ovos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `envio_ovos` (
  `IdEnvio` int NOT NULL,
  `IdPeriodo` int NOT NULL,
  `Aviario` int NOT NULL,
  `Lote` int NOT NULL,
  `Incubaveis` int NOT NULL,
  `IncubaveisBons` int NOT NULL,
  `Comerciais` int NOT NULL,
  `Total` int NOT NULL,
  `DataEnvio` date NOT NULL,
  `HoraEnvio` time NOT NULL,
  PRIMARY KEY (`IdEnvio`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `envio_ovos`
--

LOCK TABLES `envio_ovos` WRITE;
/*!40000 ALTER TABLE `envio_ovos` DISABLE KEYS */;
INSERT INTO `envio_ovos` VALUES (1,1,0,1,180,0,28,208,'2019-10-02','17:14:20'),(2,1,0,1,20,0,2,44,'2019-10-02','17:21:59');
/*!40000 ALTER TABLE `envio_ovos` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `TRG_EnvioOvos_AI` AFTER INSERT ON `envio_ovos` FOR EACH ROW BEGIN
      CALL SP_AtualizaEstoqueOvos (new.IdEnvio, new.Lote, new.IdPeriodo, new.Incubaveis * -1, new.comerciais * -1, new.Total * -1);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `TRG_EnvioOvos_AU` AFTER UPDATE ON `envio_ovos` FOR EACH ROW BEGIN
      CALL SP_AtualizaEstoqueOvos (new.IdEnvio, new.Lote, new.IdPeriodo, old.Incubaveis - new.Incubaveis, old.Comerciais - new.Comerciais, old.Total - new.Total);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `TRG_EnvioOvos_AD` AFTER DELETE ON `envio_ovos` FOR EACH ROW BEGIN
      CALL SP_AtualizaEstoqueOvos (old.IdEnvio, old.Lote, old.IdPeriodo, old.Incubaveis, old.Comerciais, old.Total);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `estoque_aves`
--

DROP TABLE IF EXISTS `estoque_aves`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estoque_aves` (
  `IdEstoque` int NOT NULL,
  `IdPeriodo` int NOT NULL,
  `Lote` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Aviario` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Femeas` int NOT NULL,
  `Machos` int NOT NULL,
  `DataEstoque` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`IdEstoque`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estoque_aves`
--

LOCK TABLES `estoque_aves` WRITE;
/*!40000 ALTER TABLE `estoque_aves` DISABLE KEYS */;
INSERT INTO `estoque_aves` VALUES (1,1,'1','1',3156,23,'2019-09-13 02:11:40'),(2,1,'2','1',394,316,'2019-09-13 02:11:40'),(3,1,'2','1',525,123,'2019-09-13 02:24:51'),(4,1,'2','2',739,113,'2019-09-13 02:53:20');
/*!40000 ALTER TABLE `estoque_aves` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estoque_ovos`
--

DROP TABLE IF EXISTS `estoque_ovos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estoque_ovos` (
  `IdEstoque` int NOT NULL,
  `Lote` int NOT NULL,
  `IdPeriodo` int NOT NULL,
  `Incubaveis` int NOT NULL,
  `Comerciais` int NOT NULL,
  `Total` int NOT NULL,
  PRIMARY KEY (`IdEstoque`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estoque_ovos`
--

LOCK TABLES `estoque_ovos` WRITE;
/*!40000 ALTER TABLE `estoque_ovos` DISABLE KEYS */;
INSERT INTO `estoque_ovos` VALUES (1,1,1,0,0,0);
/*!40000 ALTER TABLE `estoque_ovos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fertilidade`
--

DROP TABLE IF EXISTS `fertilidade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fertilidade` (
  `IdFertilidade` int NOT NULL,
  `IdPeriodo` int NOT NULL,
  `DataInicial` date NOT NULL,
  `Data` date NOT NULL,
  `Semana` int NOT NULL,
  `Percent` decimal(9,2) NOT NULL,
  PRIMARY KEY (`IdFertilidade`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fertilidade`
--

LOCK TABLES `fertilidade` WRITE;
/*!40000 ALTER TABLE `fertilidade` DISABLE KEYS */;
/*!40000 ALTER TABLE `fertilidade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `financeiro`
--

DROP TABLE IF EXISTS `financeiro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `financeiro` (
  `IdFinanceiro` int NOT NULL,
  `ValorOvo` decimal(9,2) NOT NULL,
  `IdPeriodo` int NOT NULL,
  PRIMARY KEY (`IdFinanceiro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `financeiro`
--

LOCK TABLES `financeiro` WRITE;
/*!40000 ALTER TABLE `financeiro` DISABLE KEYS */;
INSERT INTO `financeiro` VALUES (1,0.00,1),(2,0.00,1),(3,0.00,1),(4,0.00,1);
/*!40000 ALTER TABLE `financeiro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lotes`
--

DROP TABLE IF EXISTS `lotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lotes` (
  `IdLote` int NOT NULL,
  `IdPeriodo` int NOT NULL,
  `Lote` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Femeas` int NOT NULL,
  `Machos` int NOT NULL,
  `Capitalizadas` int NOT NULL,
  `DataLote` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`IdLote`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lotes`
--

LOCK TABLES `lotes` WRITE;
/*!40000 ALTER TABLE `lotes` DISABLE KEYS */;
INSERT INTO `lotes` VALUES (1,1,'LT101',3550,355,3985,'2019-09-12 03:00:00'),(2,1,'LT23156',1264,236,1482,'2019-09-12 03:00:00');
/*!40000 ALTER TABLE `lotes` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `TRG_Lotes_LD` AFTER DELETE ON `lotes` FOR EACH ROW BEGIN
DELETE FROM estoque_aves where Lote = old.IdLote;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `mortalidade`
--

DROP TABLE IF EXISTS `mortalidade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mortalidade` (
  `IdMortalidade` int NOT NULL,
  `Mortalidade` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Descarte` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`IdMortalidade`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mortalidade`
--

LOCK TABLES `mortalidade` WRITE;
/*!40000 ALTER TABLE `mortalidade` DISABLE KEYS */;
INSERT INTO `mortalidade` VALUES (1,'Refugo, Machucado, Prolapso, Arranhado, Artrite,Descarte eliminada','Descarte abate,Erros sexo, Descarte laboratório,Papudas');
/*!40000 ALTER TABLE `mortalidade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `periodo`
--

DROP TABLE IF EXISTS `periodo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `periodo` (
  `IdPeriodo` int NOT NULL,
  `Ativo` tinyint(1) NOT NULL,
  `Ativacao` date NOT NULL,
  `Desativacao` date NOT NULL,
  PRIMARY KEY (`IdPeriodo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `periodo`
--

LOCK TABLES `periodo` WRITE;
/*!40000 ALTER TABLE `periodo` DISABLE KEYS */;
INSERT INTO `periodo` VALUES (1,1,'2019-09-12','0000-00-00');
/*!40000 ALTER TABLE `periodo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `peso`
--

DROP TABLE IF EXISTS `peso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `peso` (
  `IdPeso` int NOT NULL,
  `IdPeriodo` int NOT NULL,
  `Semana` int NOT NULL,
  `Femeas` decimal(9,3) NOT NULL,
  `Machos` decimal(9,3) NOT NULL,
  `DataPeso` date NOT NULL,
  PRIMARY KEY (`IdPeso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peso`
--

LOCK TABLES `peso` WRITE;
/*!40000 ALTER TABLE `peso` DISABLE KEYS */;
INSERT INTO `peso` VALUES (2,1,38,0.000,12.000,'2019-10-15'),(3,1,38,12.987,0.000,'2019-10-15');
/*!40000 ALTER TABLE `peso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producao`
--

DROP TABLE IF EXISTS `producao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `producao` (
  `IdProducao` int NOT NULL,
  `IdPeriodo` int NOT NULL,
  `DataInicio` date NOT NULL,
  `DataFim` date NOT NULL,
  `Semana` int NOT NULL,
  `Percent` decimal(9,2) NOT NULL,
  PRIMARY KEY (`IdProducao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producao`
--

LOCK TABLES `producao` WRITE;
/*!40000 ALTER TABLE `producao` DISABLE KEYS */;
INSERT INTO `producao` VALUES (1,1,'2020-05-25','2020-06-01',32,5.00),(2,1,'2020-06-01','2020-06-08',33,0.00),(3,1,'2020-06-08','2020-06-15',34,0.00),(4,1,'2020-06-15','2020-06-22',35,0.00),(5,1,'2020-06-22','2020-06-29',36,0.00),(6,1,'2020-06-29','2020-07-06',37,0.00),(7,1,'2020-07-06','2020-07-13',38,0.00),(8,1,'2020-07-13','2020-07-20',39,0.00),(9,1,'2020-07-20','2020-07-27',40,0.00),(10,1,'2020-07-27','2020-08-03',41,0.00),(11,1,'2020-08-03','2020-08-10',42,0.00),(12,1,'2020-08-10','2020-08-17',43,0.00),(13,1,'2020-08-17','2020-08-24',44,0.00),(14,1,'2020-08-24','2020-08-31',45,0.00),(15,1,'2020-08-31','2020-09-07',46,0.00),(16,1,'2020-09-07','2020-09-14',47,0.00),(17,1,'2020-09-14','2020-09-21',48,0.00),(18,1,'2020-09-21','2020-09-28',49,0.00),(19,1,'2020-09-28','2020-10-05',50,0.00),(20,1,'2020-10-05','2020-10-12',51,0.00),(21,1,'2020-10-12','2020-10-19',52,0.00),(22,1,'2020-10-19','2020-10-26',53,0.00),(23,1,'2020-10-26','2020-11-02',54,0.00),(24,1,'2020-11-02','2020-11-09',55,0.00),(25,1,'2020-11-09','2020-11-16',56,0.00);
/*!40000 ALTER TABLE `producao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `racao`
--

DROP TABLE IF EXISTS `racao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `racao` (
  `IdRacao` int NOT NULL,
  `IdPeriodo` int NOT NULL,
  `DataRacao` date NOT NULL,
  `HoraRacao` time NOT NULL,
  `Sexo` tinyint(1) NOT NULL,
  `Quantidade` int NOT NULL,
  `Nota` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`IdRacao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `racao`
--

LOCK TABLES `racao` WRITE;
/*!40000 ALTER TABLE `racao` DISABLE KEYS */;
INSERT INTO `racao` VALUES (1,1,'2019-09-12','23:38:11',1,236,'2641358');
/*!40000 ALTER TABLE `racao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `saida_aves`
--

DROP TABLE IF EXISTS `saida_aves`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `saida_aves` (
  `IdAve` int NOT NULL,
  `IdPeriodo` int NOT NULL,
  `Aviario` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Lote` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Femeas` int NOT NULL,
  `Machos` int NOT NULL,
  `Motivo` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `DataAve` date NOT NULL,
  PRIMARY KEY (`IdAve`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `saida_aves`
--

LOCK TABLES `saida_aves` WRITE;
/*!40000 ALTER TABLE `saida_aves` DISABLE KEYS */;
INSERT INTO `saida_aves` VALUES (1,1,'1','1',0,9,'descarte-abate','2019-10-15'),(2,1,'2','1',0,7,'descarte-abate','2019-10-14');
/*!40000 ALTER TABLE `saida_aves` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `TRG_SaidaAves_AI` AFTER INSERT ON `saida_aves` FOR EACH ROW BEGIN
      CALL SP_AtualizaEstoqueAves (new.Aviario, new.IdPeriodo, new.Lote, new.Aviario, new.Femeas * -1, new.Machos * -1);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `TRG_SaidaAves_AU` AFTER UPDATE ON `saida_aves` FOR EACH ROW BEGIN
      CALL SP_AtualizaEstoqueAves (new.Aviario, new.IdPeriodo, new.Lote, new.Aviario, old.Femeas - new.Femeas, old.Machos - new.Machos);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `TRG_SaidaAves_AD` AFTER DELETE ON `saida_aves` FOR EACH ROW BEGIN
      CALL SP_AtualizaEstoqueAves (old.Aviario, old.IdPeriodo, old.Lote, old.Aviario, old.Femeas, old.Machos);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `tarefas`
--

DROP TABLE IF EXISTS `tarefas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tarefas` (
  `IdTarefa` int NOT NULL,
  `IdPeriodo` int NOT NULL,
  `Inicio` datetime NOT NULL,
  `Previsao` datetime NOT NULL,
  `Fim` datetime NOT NULL,
  `Nome` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Descritivo` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Observacoes` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Situacao` tinyint(1) NOT NULL,
  PRIMARY KEY (`IdTarefa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tarefas`
--

LOCK TABLES `tarefas` WRITE;
/*!40000 ALTER TABLE `tarefas` DISABLE KEYS */;
INSERT INTO `tarefas` VALUES (1,1,'2020-05-22 11:22:48','2020-05-22 11:22:48','0000-00-00 00:00:00','tarefa','tarefa','',0);
/*!40000 ALTER TABLE `tarefas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `IdUsuario` int NOT NULL,
  `Nome` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Login` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Senha` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Funcao` tinyint(1) NOT NULL,
  `Fix` tinyint(1) NOT NULL,
  `Cadastro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`IdUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Administrador','admin','21232f297a57a5a743894a0e4a801fc3',1,1,'2019-08-04 00:00:00');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-05-28 17:08:01
