-- MySQL dump 10.13  Distrib 8.0.27, for macos11 (x86_64)
--
-- Host: 127.0.0.1    Database: familyfund
-- ------------------------------------------------------
-- Server version	5.5.5-10.6.5-MariaDB

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
-- Table structure for table `account_balances`
--

DROP TABLE IF EXISTS `account_balances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `account_balances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(3) DEFAULT NULL,
  `shares` decimal(19,4) DEFAULT NULL,
  `account_id` int(11) NOT NULL,
  `tran_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL,
  `active` varchar(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`),
  KEY `account_balances_accounts_id_fk` (`account_id`),
  KEY `account_balances_transactions_id_fk` (`tran_id`),
  CONSTRAINT `account_balances_accounts_id_fk` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`),
  CONSTRAINT `account_balances_transactions_id_fk` FOREIGN KEY (`tran_id`) REFERENCES `transactions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account_balances`
--

/*!40000 ALTER TABLE `account_balances` DISABLE KEYS */;
INSERT INTO `account_balances` VALUES (1,'OWN',2000.0000,1,2,'2021-12-29 03:04:47',NULL,'N'),(2,'OWN',2000.0000,2,3,'2021-12-29 03:13:56',NULL,'N'),(3,'OWN',2000.0000,3,4,'2021-12-29 03:14:07',NULL,'N'),(4,'OWN',2000.0000,4,5,'2021-12-29 03:14:16',NULL,'N'),(5,'OWN',5000.0000,5,6,'2021-12-29 03:14:33',NULL,'N'),(6,'OWN',2132.3050,1,7,'2021-12-29 03:15:32',NULL,'N'),(7,'OWN',2132.3050,2,8,'2021-12-29 03:16:17',NULL,'N'),(8,'OWN',2264.6100,1,9,'2021-12-29 03:16:46',NULL,'Y'),(9,'OWN',2264.6100,2,10,'2021-12-29 03:17:03',NULL,'Y'),(10,'BOR',100.0000,3,11,'2021-12-29 14:16:11',NULL,'N'),(11,'OWN',1900.0000,4,12,'2021-12-29 14:20:13',NULL,'Y'),(12,'OWN',1900.0000,3,11,'2021-12-29 14:20:42',NULL,'Y'),(13,'OWN',71.0000,6,13,'2021-12-29 14:28:30',NULL,'Y'),(14,'BOR',50.0000,3,14,'2021-12-29 14:30:22',NULL,'Y'),(15,'OWN',1950.0000,3,14,'2021-12-29 14:31:06',NULL,'Y');
/*!40000 ALTER TABLE `account_balances` ENABLE KEYS */;

--
-- Table structure for table `account_matching_rules`
--

DROP TABLE IF EXISTS `account_matching_rules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `account_matching_rules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `matching_id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `account_matching_rules_account_id_fk` (`account_id`),
  KEY `account_matching_rules_matching_rules_id_fk` (`matching_id`),
  CONSTRAINT `account_matching_rules_account_id_fk` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`),
  CONSTRAINT `account_matching_rules_matching_rules_id_fk` FOREIGN KEY (`matching_id`) REFERENCES `matching_rules` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account_matching_rules`
--

/*!40000 ALTER TABLE `account_matching_rules` DISABLE KEYS */;
INSERT INTO `account_matching_rules` VALUES (1,1,1,'2021-12-29 03:18:34',NULL),(2,2,1,'2021-12-29 03:18:42',NULL),(3,3,1,'2021-12-29 03:19:08',NULL),(4,4,1,'2021-12-29 03:19:08',NULL),(5,5,2,'2021-12-29 03:19:08',NULL);
/*!40000 ALTER TABLE `account_matching_rules` ENABLE KEYS */;

--
-- Table structure for table `account_trading_rules`
--

DROP TABLE IF EXISTS `account_trading_rules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `account_trading_rules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `trading_rule_id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `account_trading_rules_accounts_id_fk` (`account_id`),
  KEY `account_trading_rules_trading_rules_id_fk` (`trading_rule_id`),
  CONSTRAINT `account_trading_rules_accounts_id_fk` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`),
  CONSTRAINT `account_trading_rules_trading_rules_id_fk` FOREIGN KEY (`trading_rule_id`) REFERENCES `trading_rules` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account_trading_rules`
--

/*!40000 ALTER TABLE `account_trading_rules` DISABLE KEYS */;
INSERT INTO `account_trading_rules` VALUES (1,1,1,'2021-12-29 03:19:28',NULL),(2,2,1,'2021-12-29 03:19:28',NULL),(3,3,1,'2021-12-29 03:19:28',NULL),(4,4,1,'2021-12-29 03:19:28',NULL),(5,5,1,'2021-12-29 03:19:28',NULL);
/*!40000 ALTER TABLE `account_trading_rules` ENABLE KEYS */;

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(15) NOT NULL,
  `nickname` varchar(15) DEFAULT NULL,
  `email_cc` varchar(1024) DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `fund_id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `accounts_users_id_fk` (`user_id`),
  KEY `accounts_fund_id_fk` (`fund_id`),
  CONSTRAINT `accounts_fund_id_fk` FOREIGN KEY (`fund_id`) REFERENCES `funds` (`id`),
  CONSTRAINT `accounts_users_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` VALUES (1,'','A',NULL,1,1,'2021-12-29 02:58:09',NULL),(2,'','A',NULL,2,1,'2021-12-29 02:58:18',NULL),(3,'',NULL,'X',3,1,'2021-12-29 03:00:11',NULL),(4,'',NULL,'X',4,1,'2021-12-29 03:00:20',NULL),(5,'',NULL,NULL,5,1,'2021-12-29 03:00:30',NULL),(6,'H',NULL,NULL,7,1,'2021-12-29 14:24:20',NULL);
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;

--
-- Table structure for table `asset_prices`
--

DROP TABLE IF EXISTS `asset_prices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `asset_prices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `asset_id` bigint(20) unsigned DEFAULT NULL,
  `price` decimal(13,2) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `asset_prices_assets_id_fk` (`asset_id`),
  CONSTRAINT `asset_prices_assets_id_fk` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asset_prices`
--

/*!40000 ALTER TABLE `asset_prices` DISABLE KEYS */;
INSERT INTO `asset_prices` VALUES (1,1,144.57,'2021-12-31 13:04:08'),(2,2,87.55,'2021-12-31 13:04:09'),(3,3,68.36,'2021-12-31 13:04:09'),(4,4,34.57,'2021-12-31 13:04:09'),(5,5,11.06,'2021-12-31 13:04:09'),(6,6,11.16,'2021-12-31 13:04:09'),(7,7,3792.43,'2021-12-31 13:04:09'),(8,8,48064.96,'2021-12-31 13:04:09'),(9,9,147.97,'2021-12-31 13:04:09'),(10,1,72.25,'2021-01-01 00:00:00'),(11,2,40.65,'2021-01-01 00:00:00'),(12,3,31.10,'2021-01-01 00:00:00'),(13,4,36.26,'2021-01-01 00:00:00'),(14,5,11.32,'2021-01-01 00:00:00'),(15,6,11.04,'2021-01-01 00:00:00'),(16,7,737.89,'2021-01-01 00:00:00'),(17,8,28990.08,'2021-01-01 00:00:00'),(18,9,124.42,'2021-01-01 00:00:00');
/*!40000 ALTER TABLE `asset_prices` ENABLE KEYS */;

--
-- Table structure for table `assets`
--

DROP TABLE IF EXISTS `assets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `assets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `type` varchar(3) NOT NULL,
  `source_feed` varchar(50) NOT NULL,
  `feed_id` varchar(128) NOT NULL,
  `last_price` decimal(19,2) NOT NULL,
  `last_price_date` date NOT NULL,
  `deactivated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assets`
--

/*!40000 ALTER TABLE `assets` DISABLE KEYS */;
INSERT INTO `assets` VALUES (1,'SPXL','STO','tws','SPXL',144.57,'2021-12-31',NULL,'2021-12-31 11:55:54','2021-12-31 10:05:12'),(2,'TECL','STO','tws','TECL',87.55,'2021-12-31',NULL,'2021-12-31 11:55:54','2021-12-31 10:05:12'),(3,'SOXL','STO','tws','SOXL',68.36,'2021-12-31',NULL,'2021-12-31 11:55:54','2021-12-31 10:05:12'),(4,'IAU','STO','tws','IAU',34.57,'2021-12-31',NULL,'2021-12-31 11:55:54','2021-12-31 10:05:12'),(5,'FTBFX','FND','tws','FTBFX',11.06,'2021-12-31',NULL,'2021-12-31 11:55:54','2021-12-31 10:05:12'),(6,'FIPDX','FND','tws','FIPDX',11.16,'2021-12-31',NULL,'2021-12-31 11:55:54','2021-12-31 10:05:12'),(7,'ETH','DC','tws','ETH',3792.43,'2021-12-31',NULL,'2021-12-31 11:55:54','2021-12-31 10:05:12'),(8,'BTC','DC','tws','BTC',48064.96,'2021-12-31',NULL,'2021-12-31 11:55:54','2021-12-31 10:05:12'),(9,'LTC','DC','tws','LTC',147.97,'2021-12-31',NULL,'2021-12-31 11:55:54','2021-12-31 10:05:12');
/*!40000 ALTER TABLE `assets` ENABLE KEYS */;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

--
-- Table structure for table `funds`
--

DROP TABLE IF EXISTS `funds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `funds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `goal` varchar(1024) DEFAULT NULL,
  `total_shares` decimal(20,4) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funds`
--

/*!40000 ALTER TABLE `funds` DISABLE KEYS */;
INSERT INTO `funds` VALUES (1,'Family Fund','To create generational wealth',25529.2200,'2021-12-28 23:38:52',NULL);
/*!40000 ALTER TABLE `funds` ENABLE KEYS */;

--
-- Table structure for table `matching_rules`
--

DROP TABLE IF EXISTS `matching_rules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `matching_rules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `dollar_range_start` decimal(13,2) DEFAULT 0.00,
  `dollar_range_end` decimal(13,2) DEFAULT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `match_percent` decimal(5,2) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matching_rules`
--

/*!40000 ALTER TABLE `matching_rules` DISABLE KEYS */;
INSERT INTO `matching_rules` VALUES (1,'100% up to $200',0.00,200.00,'2021-01-01','2022-01-01',100.00,'2020-01-01 00:12:00',NULL),(2,'100% up to $500',0.00,500.00,'2021-01-01','2022-01-01',100.00,'2020-01-01 00:00:00',NULL),(3,'100% up to $500',0.00,500.00,'2022-01-01','2023-01-01',100.00,'2020-01-01 00:00:00',NULL),(4,'100% up to $200',0.00,200.00,'2022-01-01','2023-01-01',100.00,'2022-01-01 00:00:00',NULL);
/*!40000 ALTER TABLE `matching_rules` ENABLE KEYS */;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

--
-- Table structure for table `portfolio_assets`
--

DROP TABLE IF EXISTS `portfolio_assets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `portfolio_assets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `portfolio_id` bigint(20) unsigned NOT NULL,
  `asset_id` bigint(20) unsigned NOT NULL,
  `shares` decimal(21,8) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `portfolio_assets_assets_id_fk` (`asset_id`),
  KEY `portfolio_assets_portfolios_id_fk` (`portfolio_id`),
  CONSTRAINT `portfolio_assets_assets_id_fk` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`),
  CONSTRAINT `portfolio_assets_portfolios_id_fk` FOREIGN KEY (`portfolio_id`) REFERENCES `portfolios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `portfolio_assets`
--

/*!40000 ALTER TABLE `portfolio_assets` DISABLE KEYS */;
INSERT INTO `portfolio_assets` VALUES (1,1,1,32.00000000,'2021-12-31 13:10:50',NULL),(2,1,2,53.00000000,'2021-12-31 13:10:50',NULL),(3,1,3,65.00000000,'2021-12-31 13:10:50',NULL),(4,1,4,91.00000000,'2021-12-31 13:10:50',NULL),(5,1,5,138.71400000,'2021-12-31 13:10:50',NULL),(6,1,6,532.59600000,'2021-12-31 13:10:50',NULL),(7,1,7,0.36046314,'2021-12-31 13:10:50',NULL),(8,1,8,0.01836910,'2021-12-31 13:10:50',NULL),(9,1,9,3.74535299,'2021-12-31 13:10:50',NULL);
/*!40000 ALTER TABLE `portfolio_assets` ENABLE KEYS */;

--
-- Table structure for table `portfolios`
--

DROP TABLE IF EXISTS `portfolios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `portfolios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fund_id` int(11) NOT NULL,
  `last_total` decimal(13,2) NOT NULL,
  `last_total_date` datetime NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `portfolios_fund_id_fk` (`fund_id`),
  CONSTRAINT `portfolios_fund_id_fk` FOREIGN KEY (`fund_id`) REFERENCES `funds` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `portfolios`
--

/*!40000 ALTER TABLE `portfolios` DISABLE KEYS */;
INSERT INTO `portfolios` VALUES (1,1,100.00,'2021-12-31 08:51:32','2021-12-31 11:51:37',NULL);
/*!40000 ALTER TABLE `portfolios` ENABLE KEYS */;

--
-- Table structure for table `trading_rules`
--

DROP TABLE IF EXISTS `trading_rules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trading_rules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `max_sale_increase_pcnt` decimal(5,2) DEFAULT NULL,
  `min_fund_performance_pcnt` decimal(5,2) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trading_rules`
--

/*!40000 ALTER TABLE `trading_rules` DISABLE KEYS */;
INSERT INTO `trading_rules` VALUES (1,'3%',3.00,NULL,'2021-12-29 03:18:09',NULL);
/*!40000 ALTER TABLE `trading_rules` ENABLE KEYS */;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source` varchar(3) DEFAULT NULL,
  `type` varchar(3) DEFAULT NULL,
  `shares` decimal(19,4) DEFAULT NULL,
  `account_id` int(11) NOT NULL,
  `matching_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transactions_account_id_fk` (`account_id`),
  KEY `transactions_matching_id_fk` (`matching_id`),
  CONSTRAINT `transactions_account_id_fk` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`),
  CONSTRAINT `transactions_matching_id_fk` FOREIGN KEY (`matching_id`) REFERENCES `matching_rules` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (2,'SPO','PUR',2000.0000,1,NULL,'2020-12-29 03:06:38',NULL),(3,'SPO','PUR',2000.0000,2,NULL,'2020-12-29 03:06:55',NULL),(4,'SPO','PUR',2000.0000,3,NULL,'2020-12-29 03:07:05',NULL),(5,'SPO','PUR',2000.0000,4,NULL,'2020-12-29 03:07:14',NULL),(6,'SPO','PUR',5000.0000,5,NULL,'2020-12-29 03:07:26',NULL),(7,'DIR','PUR',132.3050,1,NULL,'2021-12-29 03:09:43',NULL),(8,'DIR','PUR',132.3050,2,NULL,'2021-12-29 03:10:21',NULL),(9,'MAT','PUR',132.3050,1,1,'2021-12-29 03:10:21',NULL),(10,'MAT','PUR',132.3050,2,1,'2021-12-29 03:10:35',NULL),(11,'DIR','BOR',100.0000,3,NULL,'2021-12-29 14:17:19',NULL),(12,'DIR','SAL',100.0000,4,NULL,'2021-12-29 14:19:33',NULL),(13,'SPO','PUR',71.0000,6,NULL,'2021-12-29 14:27:55',NULL),(14,'DIR','REP',50.0000,3,NULL,'2021-12-29 14:30:01',NULL);
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'NieceA1','niecea1@familyfund.com',NULL,'$2y$10$0Izqs4fkkhLTlqpH0J8Kg.tYqAPCT0MsGLbfElHnvWEv9ZwNwFM5u',NULL,'2021-12-31 11:26:15','2021-12-31 11:26:15'),(2,'NieceA2','niecea2@familyfund.com',NULL,'$2y$10$I8XWYlnpDsJSXvZcXCD0/uGtuwaiCBpc32a8r91Gxm/HQQhSso9Zu',NULL,'2021-12-31 11:26:15','2021-12-31 11:26:15'),(3,'NieceB1','nieceb1@familyfund.com',NULL,'$2y$10$TqTqP9KS37cu/4eLwyDkieQc3qhpACBHAjx/kP0UbreS0D7redAbS',NULL,'2021-12-31 11:26:15','2021-12-31 11:26:15'),(4,'NieceB2','nieceb2@familyfund.com',NULL,'$2y$10$6/YMhjhMLaXTdgIatYY2eOfMi5tGlHM1W3bVEpZR.olZb6ioSWaMy',NULL,'2021-12-31 11:26:16','2021-12-31 11:26:16'),(5,'NephewC1','nephewc1@familyfund.com',NULL,'$2y$10$X.dHjYYldFId4Nj0j3Uf0OTbvyprEiOKjVd2KRFc2KfUEMwqkuuaW',NULL,'2021-12-31 11:26:16','2021-12-31 11:26:16'),(6,'Admin1','admin1@familyfund.com',NULL,'$2y$10$2bHnNO3bCShADCbwiezrTezCcCf1R0KWrpYhtcBbFiaE3xhq1Ki66',NULL,'2021-12-31 11:26:16','2021-12-31 11:26:16'),(7,'Org1','org1@familyfund.com',NULL,'$2y$10$TumucOzMRLEJXfpHHA8eeuzvwJUrQONEzyPgZidLVuvoCOmGIKaJq',NULL,'2021-12-31 11:26:16','2021-12-31 11:26:16');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-12-31 10:34:04
