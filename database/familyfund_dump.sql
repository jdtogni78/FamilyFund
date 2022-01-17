DROP TABLE IF EXISTS `accounts`;
DROP TABLE IF EXISTS `transactions`;
DROP TABLE IF EXISTS `account_balances`;
DROP TABLE IF EXISTS `account_matching_rules`;
DROP TABLE IF EXISTS `account_trading_rules`;
DROP TABLE IF EXISTS `accounts`;
DROP TABLE IF EXISTS `asset_change_logs`;
DROP TABLE IF EXISTS `asset_prices`;
DROP TABLE IF EXISTS `assets`;
DROP TABLE IF EXISTS `failed_jobs`;
DROP TABLE IF EXISTS `funds`;
DROP TABLE IF EXISTS `matching_rules`;
DROP TABLE IF EXISTS `migrations`;
DROP TABLE IF EXISTS `password_resets`;
DROP TABLE IF EXISTS `personal_access_tokens`;
DROP TABLE IF EXISTS `portfolio_assets`;
DROP TABLE IF EXISTS `portfolios`;
DROP TABLE IF EXISTS `trading_rules`;
DROP TABLE IF EXISTS `transactions`;

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
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shares` decimal(19,4) NOT NULL,
  `account_id` bigint(20) unsigned DEFAULT NULL,
  `transaction_id` bigint(20) unsigned NOT NULL,
  `start_dt` date NOT NULL DEFAULT curdate(),
  `end_dt` date NOT NULL DEFAULT '9999-12-31',
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `account_balances_account_id_foreign` (`account_id`),
  KEY `account_balances_transaction_id_foreign` (`transaction_id`),
  CONSTRAINT `account_balances_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`),
  CONSTRAINT `account_balances_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account_balances`
--

/*!40000 ALTER TABLE `account_balances` DISABLE KEYS */;
INSERT INTO `account_balances` VALUES (1,'OWN',2000.0000,1,2,'2021-01-01','2021-07-01','2022-01-16 18:09:13','2021-03-31 00:00:00'),
(2,'OWN',2000.0000,2,3,'2021-01-01','2021-07-01','2022-01-16 18:09:13','2021-03-31 00:00:00'),
(3,'OWN',2000.0000,3,4,'2021-01-01','2021-06-01','2022-01-16 18:09:13','2021-05-31 00:00:00'),
(4,'OWN',2000.0000,4,5,'2021-01-01','2021-07-01','2022-01-16 18:09:13','2021-06-30 00:00:00'),
(5,'OWN',5000.0000,5,6,'2021-01-01','9999-12-31','2022-01-16 18:09:13','2022-01-07 21:44:19'),
(6,'OWN',2132.3049,1,7,'2021-07-01','2021-07-01','2022-01-16 23:53:29','2021-03-31 00:00:00'),
(7,'OWN',2132.3049,2,8,'2021-07-01','2021-07-01','2022-01-16 23:55:28','2021-03-31 00:00:00'),
(8,'OWN',2264.6098,1,9,'2021-07-01','9999-12-31','2022-01-16 23:53:57','2022-01-07 21:44:19'),
(9,'OWN',2264.6098,2,10,'2021-07-01','9999-12-31','2022-01-16 23:55:28','2022-01-07 21:44:19'),
(10,'BOR',100.0000,3,11,'2021-06-01','2022-01-05','2022-01-16 18:15:02','2021-12-28 00:00:00'),
(11,'OWN',1899.9899,3,11,'2021-06-01','2022-01-05','2022-01-16 23:58:16','2022-01-07 21:44:19'),
(12,'OWN',1900.0040,4,12,'2021-07-01','9999-12-31','2022-01-17 00:03:20','2022-01-07 21:44:19'),
(13,'OWN',71.0000,6,13,'2021-12-29','9999-12-31','2021-12-28 00:00:00','2022-01-07 21:44:19'),
(14,'BOR',49.9989,3,14,'2022-01-05','9999-12-31','2022-01-17 00:02:53','2021-12-28 00:00:00'),
(15,'OWN',1949.9910,3,14,'2022-01-05','9999-12-31','2022-01-17 00:03:04','2022-01-07 21:44:19'),
(16,'OWN',2000.0000,7,46,'2021-01-01','2021-07-01','2022-01-16 17:56:19','2022-01-09 02:18:39'),
(17,'OWN',2000.0000,8,47,'2021-01-01','2021-07-01','2022-01-16 17:56:19','2022-01-09 02:18:39'),
(18,'OWN',2000.0000,9,48,'2021-01-01','2022-01-09','2022-01-16 17:56:19','2022-01-09 02:18:39'),
(19,'OWN',2000.0000,10,49,'2021-01-01','2022-01-09','2022-01-16 17:56:19','2022-01-09 02:18:39'),
(20,'OWN',5000.0000,11,50,'2021-01-01','9999-12-31','2022-01-16 17:56:19','2022-01-09 02:18:39'),
(21,'OWN',2135.1649,7,42,'2021-07-01','2021-07-01','2022-01-17 00:05:13','2021-07-01 00:00:00'),
(22,'OWN',2135.1649,8,43,'2021-07-01','2021-07-01','2022-01-17 00:07:19','2021-07-01 00:00:00'),
(23,'OWN',2270.3298,7,44,'2021-07-01','2022-01-09','2022-01-17 00:05:34','2021-07-01 00:00:00'),
(24,'OWN',2270.3298,8,45,'2021-07-01','2022-01-09','2022-01-17 00:07:19','2021-07-01 00:00:00'),
(25,'OWN',2000.0000,12,15,'2021-01-01','2022-01-09','2022-01-15 00:12:40','2022-01-09 02:27:07'),
(26,'OWN',2148.2636,12,16,'2022-01-09','2022-01-09','2022-01-17 00:09:30','2022-01-09 02:45:19'),
(27,'OWN',2296.5272,12,17,'2022-01-09','2022-01-09','2022-01-17 00:09:30','2022-01-09 02:45:19'),
(28,'OWN',3408.5042,12,18,'2022-01-09','2022-01-09','2022-01-17 00:09:42','2022-01-09 02:45:19'),
(29,'OWN',3556.7678,12,19,'2022-01-09','9999-12-31','2022-01-17 00:09:55','2022-01-09 02:45:19'),
(30,'OWN',2307.3957,7,20,'2022-01-09','2022-01-09','2022-01-17 00:06:11','2022-01-09 02:45:19'),
(31,'OWN',2344.4616,7,21,'2022-01-09','2022-01-09','2022-01-17 00:06:20','2022-01-09 02:45:19'),
(32,'OWN',2455.6593,7,22,'2022-01-09','2022-01-09','2022-01-17 00:06:39','2022-01-09 02:45:19'),
(33,'OWN',2566.8570,7,23,'2022-01-09','9999-12-31','2022-01-17 00:06:49','2022-01-09 02:45:19'),
(34,'OWN',2307.3957,8,24,'2022-01-09','2022-01-09','2022-01-17 00:07:19','2022-01-09 02:45:19'),
(35,'OWN',2344.4616,8,25,'2022-01-09','2022-01-09','2022-01-17 00:07:19','2022-01-09 02:45:19'),
(36,'OWN',2455.6593,8,26,'2022-01-09','2022-01-09','2022-01-17 00:07:19','2022-01-09 02:45:19'),
(37,'OWN',2566.8570,8,27,'2022-01-09','9999-12-31','2022-01-17 00:07:19','2022-01-09 02:45:19'),
(38,'OWN',2148.2636,10,28,'2022-01-09','2022-01-09','2022-01-17 00:08:59','2022-01-09 02:45:19'),
(39,'OWN',2296.5272,10,29,'2022-01-09','9999-12-31','2022-01-17 00:08:59','2022-01-09 02:45:19'),
(40,'OWN',2148.2636,9,30,'2022-01-09','2022-01-09','2022-01-17 00:08:01','2022-01-09 02:45:19'),
(41,'OWN',2296.5272,9,31,'2022-01-09','2022-01-09','2022-01-17 00:08:18','2022-01-09 02:45:19'),
(42,'OWN',2370.6590,9,32,'2022-01-09','2022-01-09','2022-01-17 00:08:26','2022-01-09 02:45:19'),
(43,'OWN',2444.7908,9,33,'2022-01-09','9999-12-31','2022-01-17 00:08:37','2022-01-09 02:45:19'),
(44,'OWN',25000.0000,13,34,'2021-01-01','9999-12-31','2022-01-16 09:08:33','2022-01-11 17:49:41'),
(45,'OWN',25000.0000,14,35,'2021-01-01','2021-07-01','2022-01-16 02:41:57','2022-01-11 17:49:41'),
(46,'OWN',25540.6597,14,36,'2021-07-01','9999-12-31','2022-01-17 00:10:14','2022-01-12 02:28:21');
/*!40000 ALTER TABLE `account_balances` ENABLE KEYS */;

--
-- Table structure for table `account_matching_rules`
--

DROP TABLE IF EXISTS `account_matching_rules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `account_matching_rules` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `account_id` bigint(20) unsigned NOT NULL,
  `matching_rule_id` bigint(20) unsigned NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `account_matching_rules_account_id_foreign` (`account_id`),
  KEY `account_matching_rules_matching_rule_id_foreign` (`matching_rule_id`),
  CONSTRAINT `account_matching_rules_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`),
  CONSTRAINT `account_matching_rules_matching_rule_id_foreign` FOREIGN KEY (`matching_rule_id`) REFERENCES `matching_rules` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account_matching_rules`
--

/*!40000 ALTER TABLE `account_matching_rules` DISABLE KEYS */;
INSERT INTO `account_matching_rules` VALUES (1,1,1,'2021-12-29 03:18:34','2022-01-07 21:44:19',NULL),
(2,2,1,'2021-12-29 03:18:42','2022-01-07 21:44:19',NULL),
(3,3,1,'2021-12-29 03:19:08','2022-01-07 21:44:19',NULL),
(4,4,1,'2021-12-29 03:19:08','2022-01-07 21:44:19',NULL),
(5,5,2,'2021-12-29 03:19:08','2022-01-07 21:44:19',NULL),
(6,7,1,NULL,'2022-01-12 05:27:30',NULL),
(7,8,1,NULL,'2022-01-12 05:27:30',NULL),
(8,9,1,NULL,'2022-01-12 05:27:30',NULL),
(9,10,1,NULL,'2022-01-12 05:27:30',NULL),
(10,11,2,NULL,'2022-01-12 05:27:30',NULL),
(11,12,1,NULL,'2022-01-12 05:27:30',NULL),
(12,7,4,NULL,'2022-01-12 05:27:52',NULL),
(13,8,4,NULL,'2022-01-12 05:27:52',NULL),
(14,9,4,NULL,'2022-01-12 05:27:52',NULL),
(15,10,4,NULL,'2022-01-12 05:27:52',NULL),
(16,11,3,NULL,'2022-01-12 05:27:52',NULL),
(17,12,4,NULL,'2022-01-12 05:27:52',NULL);
/*!40000 ALTER TABLE `account_matching_rules` ENABLE KEYS */;

--
-- Table structure for table `account_trading_rules`
--

DROP TABLE IF EXISTS `account_trading_rules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `account_trading_rules` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `account_id` bigint(20) unsigned NOT NULL,
  `trading_rule_id` bigint(20) unsigned NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `account_trading_rules_account_id_foreign` (`account_id`),
  KEY `account_trading_rules_trading_rule_id_foreign` (`trading_rule_id`),
  CONSTRAINT `account_trading_rules_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`),
  CONSTRAINT `account_trading_rules_trading_rule_id_foreign` FOREIGN KEY (`trading_rule_id`) REFERENCES `trading_rules` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account_trading_rules`
--

/*!40000 ALTER TABLE `account_trading_rules` DISABLE KEYS */;
INSERT INTO `account_trading_rules` VALUES (1,1,1,'2021-12-29 03:19:28','2022-01-07 21:44:19',NULL),
(2,2,2,'2022-01-12 05:47:54','2022-01-07 21:44:19',NULL),
(3,3,3,'2022-01-12 05:47:54','2022-01-07 21:44:19',NULL),
(4,4,1,'2021-12-29 03:19:28','2022-01-07 21:44:19',NULL),
(5,5,1,'2021-12-29 03:19:28','2022-01-07 21:44:19',NULL);
/*!40000 ALTER TABLE `account_trading_rules` ENABLE KEYS */;

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `accounts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nickname` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_cc` varchar(1024) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `fund_id` bigint(20) unsigned NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `accounts_user_id_foreign` (`user_id`),
  KEY `accounts_fund_id_foreign` (`fund_id`),
  CONSTRAINT `accounts_fund_id_foreign` FOREIGN KEY (`fund_id`) REFERENCES `funds` (`id`),
  CONSTRAINT `accounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` VALUES (1,'','A',NULL,1,1,'2021-12-29 02:58:09','2022-01-07 21:44:19',NULL),
(2,'','A',NULL,2,1,'2021-12-29 02:58:18','2022-01-07 21:44:19',NULL),
(3,'',NULL,'X',3,1,'2021-12-29 03:00:11','2022-01-07 21:44:19',NULL),
(4,'',NULL,'X',4,1,'2021-12-29 03:00:20','2022-01-07 21:44:19',NULL),
(5,'',NULL,NULL,5,1,'2021-12-29 03:00:30','2022-01-07 21:44:19',NULL),
(6,'H',NULL,NULL,7,1,'2021-12-29 14:24:20','2022-01-07 21:44:19',NULL),
(7,'A1','LT',NULL,1,2,'2022-01-09 02:37:23','2022-01-09 02:17:28',NULL),
(8,'A2','GT',NULL,2,2,'2022-01-09 02:37:23','2022-01-09 02:17:28',NULL),
(9,'B1','GG',NULL,3,2,'2022-01-09 02:37:23','2022-01-09 02:17:28',NULL),
(10,'B2','PG',NULL,4,2,'2022-01-09 02:37:23','2022-01-09 02:17:28',NULL),
(11,'C1','NB',NULL,5,2,'2022-01-09 02:37:23','2022-01-09 02:17:28',NULL),
(12,'S1','VT',NULL,8,2,'2022-01-09 02:37:23','2022-01-09 02:24:10',NULL),
(13,'F1','F1',NULL,NULL,1,NULL,'2022-01-11 17:43:38',NULL),
(14,'F2','F2',NULL,NULL,2,NULL,'2022-01-11 17:43:38',NULL);
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;

--
-- Table structure for table `asset_change_logs`
--

DROP TABLE IF EXISTS `asset_change_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `asset_change_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asset_id` bigint(20) unsigned NOT NULL,
  `field` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `datetime` timestamp NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `asset_change_logs_asset_id_foreign` (`asset_id`),
  CONSTRAINT `asset_change_logs_asset_id_foreign` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asset_change_logs`
--

/*!40000 ALTER TABLE `asset_change_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `asset_change_logs` ENABLE KEYS */;

--
-- Table structure for table `asset_prices`
--

DROP TABLE IF EXISTS `asset_prices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `asset_prices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `asset_id` bigint(20) unsigned NOT NULL,
  `price` decimal(13,2) NOT NULL,
  `start_dt` date NOT NULL DEFAULT curdate(),
  `end_dt` date NOT NULL DEFAULT '9999-12-31',
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `asset_prices_asset_id_foreign` (`asset_id`),
  CONSTRAINT `asset_prices_asset_id_foreign` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asset_prices`
--

/*!40000 ALTER TABLE `asset_prices` DISABLE KEYS */;
INSERT INTO `asset_prices` VALUES (1,1,144.57,'2021-12-31','2022-01-09','2022-01-09 01:37:41','2022-01-07 21:44:19'),
(2,2,87.55,'2021-12-31','2022-01-09','2022-01-09 01:37:41','2022-01-07 21:44:19'),
(3,3,68.36,'2021-12-31','2022-01-09','2022-01-09 01:37:41','2022-01-07 21:44:19'),
(4,4,34.57,'2021-12-31','2022-01-09','2022-01-09 01:37:41','2022-01-07 21:44:19'),
(5,5,11.06,'2021-12-31','2022-01-09','2022-01-09 01:37:41','2022-01-07 21:44:19'),
(6,6,11.16,'2021-12-31','2022-01-09','2022-01-09 01:37:41','2022-01-07 21:44:19'),
(7,7,3792.43,'2021-12-31','2022-01-09','2022-01-09 01:37:41','2022-01-07 21:44:19'),
(8,8,48064.96,'2021-12-31','2022-01-09','2022-01-09 01:37:41','2022-01-07 21:44:19'),
(9,9,147.97,'2021-12-31','2022-01-09','2022-01-09 01:37:41','2022-01-07 21:44:19'),
(10,1,72.25,'2021-01-01','2021-12-31','2022-01-09 01:37:41','2022-01-07 21:44:19'),
(11,2,40.65,'2021-01-01','2021-12-31','2022-01-09 01:37:41','2022-01-07 21:44:19'),
(12,3,31.10,'2021-01-01','2021-12-31','2022-01-09 01:37:41','2022-01-07 21:44:19'),
(13,4,36.26,'2021-01-01','2021-12-31','2022-01-09 01:37:41','2022-01-07 21:44:19'),
(14,5,11.32,'2021-01-01','2021-12-31','2022-01-09 01:37:41','2022-01-07 21:44:19'),
(15,6,11.04,'2021-01-01','2021-12-31','2022-01-09 01:37:41','2022-01-07 21:44:19'),
(16,7,737.89,'2021-01-01','2021-12-31','2022-01-09 01:37:41','2022-01-07 21:44:19'),
(17,8,28990.08,'2021-01-01','2021-12-31','2022-01-09 01:37:41','2022-01-07 21:44:19'),
(18,9,124.42,'2021-01-01','2021-12-31','2022-01-09 01:37:41','2022-01-07 21:44:19'),
(19,11,0.81,'2021-12-31','2022-01-09','2022-01-09 01:50:23','2022-01-07 21:44:19'),
(20,12,0.27,'2021-12-31','2022-01-09','2022-01-09 01:50:23','2022-01-07 21:44:19'),
(21,13,428.51,'2021-12-31','2022-01-09','2022-01-09 01:50:23','2022-01-07 21:44:19'),
(22,11,0.32,'2021-01-01','2021-12-31','2022-01-16 08:46:33','2022-01-07 21:44:19'),
(23,12,0.13,'2021-01-01','2021-12-31','2022-01-16 08:47:04','2022-01-07 21:44:19'),
(24,13,430.20,'2021-01-09','2022-01-09','2022-01-09 01:37:41','2022-01-07 21:44:19'),
(25,10,1.00,'1970-01-01','9999-12-31',NULL,'2022-01-07 21:44:19'),
(26,1,135.37,'2022-01-09','9999-12-31','2022-01-09 01:56:20','2022-01-09 01:34:07'),
(27,3,59.74,'2022-01-09','9999-12-31','2022-01-09 01:56:20','2022-01-09 01:34:07'),
(28,2,74.49,'2022-01-09','9999-12-31','2022-01-09 01:56:20','2022-01-09 01:34:07'),
(29,4,34.15,'2022-01-09','9999-12-31','2022-01-09 01:56:20','2022-01-09 01:34:07'),
(30,5,10.94,'2022-01-09','9999-12-31',NULL,'2022-01-09 01:34:07'),
(31,6,10.91,'2022-01-09','9999-12-31','2022-01-09 01:56:20','2022-01-09 01:34:07'),
(32,7,3202.70,'2022-01-09','2022-01-09','2022-01-09 01:50:23','2022-01-09 01:34:07'),
(33,8,41818.15,'2022-01-09','2022-01-09','2022-01-09 01:50:23','2022-01-09 01:34:07'),
(34,9,132.81,'2022-01-09','2022-01-09','2022-01-09 01:50:23','2022-01-09 01:34:07'),
(35,7,3103.49,'2022-01-09','9999-12-31',NULL,'2022-01-09 01:53:24'),
(36,8,41685.39,'2022-01-09','9999-12-31',NULL,'2022-01-09 01:53:25'),
(37,9,129.65,'2022-01-09','9999-12-31',NULL,'2022-01-09 01:53:25'),
(38,11,0.75,'2022-01-09','9999-12-31',NULL,'2022-01-09 01:53:25'),
(39,12,0.26,'2022-01-09','9999-12-31',NULL,'2022-01-09 01:53:25'),
(40,13,375.38,'2022-01-09','9999-12-31',NULL,'2022-01-09 01:53:25');
/*!40000 ALTER TABLE `asset_prices` ENABLE KEYS */;

--
-- Table structure for table `assets`
--

DROP TABLE IF EXISTS `assets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `assets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source_feed` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `feed_id` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assets`
--

/*!40000 ALTER TABLE `assets` DISABLE KEYS */;
INSERT INTO `assets` VALUES (1,'SPXL','STO','tws','SPXL','2021-12-31 10:05:12','2021-12-31 11:55:54',NULL),
(2,'TECL','STO','tws','TECL','2021-12-31 10:05:12','2021-12-31 11:55:54',NULL),
(3,'SOXL','STO','tws','SOXL','2021-12-31 10:05:12','2021-12-31 11:55:54',NULL),
(4,'IAU','STO','tws','IAU','2021-12-31 10:05:12','2021-12-31 11:55:54',NULL),
(5,'FTBFX','FND','tws','FTBFX','2021-12-31 10:05:12','2021-12-31 11:55:54',NULL),
(6,'FIPDX','FND','tws','FIPDX','2021-12-31 10:05:12','2021-12-31 11:55:54',NULL),
(7,'ETH','DC','tws','ETH','2021-12-31 10:05:12','2021-12-31 11:55:54',NULL),
(8,'BTC','DC','tws','BTC','2021-12-31 10:05:12','2021-12-31 11:55:54',NULL),
(9,'LTC','DC','tws','LTC','2021-12-31 10:05:12','2021-12-31 11:55:54',NULL),
(10,'CASH','CSH','tws','CASH',NULL,'2021-12-31 18:37:03',NULL),
(11,'XRP','DC','CoinBase','XRP',NULL,'2021-12-31 22:29:53',NULL),
(12,'XLM','DC','CoinBase','XLM',NULL,'2021-12-31 22:29:53',NULL),
(13,'BCH','DC','CoinBase','BCH',NULL,'2021-12-31 22:29:53',NULL);
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
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `goal` varchar(1024) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=165 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funds`
--

/*!40000 ALTER TABLE `funds` DISABLE KEYS */;
INSERT INTO `funds` VALUES (1,'IB Fund','To create generational wealth','2021-12-28 23:38:52','2022-01-07 21:44:19',NULL),
(2,'Fidelity Fund','Something','2022-01-09 02:14:45','2022-01-07 21:44:19',NULL);
/*!40000 ALTER TABLE `funds` ENABLE KEYS */;

--
-- Table structure for table `matching_rules`
--

DROP TABLE IF EXISTS `matching_rules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `matching_rules` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dollar_range_start` decimal(13,2) DEFAULT 0.00,
  `dollar_range_end` decimal(13,2) DEFAULT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `match_percent` decimal(5,2) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matching_rules`
--

/*!40000 ALTER TABLE `matching_rules` DISABLE KEYS */;
INSERT INTO `matching_rules` VALUES (1,'100% up to $200',0.00,200.00,'2021-01-01','2022-01-01',100.00,'2020-01-01 00:12:00','2022-01-07 21:44:19'),
(2,'100% up to $500',0.00,500.00,'2021-01-01','2022-01-01',100.00,'2020-01-01 00:00:00','2022-01-07 21:44:19'),
(3,'100% up to $500',0.00,500.00,'2022-01-01','2023-01-01',100.00,'2020-01-01 00:00:00','2022-01-07 21:44:19'),
(4,'100% up to $200',0.00,200.00,'2022-01-01','2023-01-01',100.00,'2022-01-01 00:00:00','2022-01-07 21:44:19');
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2019_12_14_000001_create_personal_access_tokens_table',1),
(5,'2021_12_22_154221_create_asset_change_logs_table',1),
(6,'2022_01_07_130430_create_account_balances_table',1),
(7,'2022_01_07_130434_create_account_matching_rules_table',1),
(8,'2022_01_07_130437_create_account_trading_rules_table',1),
(9,'2022_01_07_130439_create_accounts_table',1),
(10,'2022_01_07_130441_create_asset_prices_table',1),
(11,'2022_01_07_130443_create_assets_table',1),
(12,'2022_01_07_130445_create_funds_table',1),
(13,'2022_01_07_130447_create_matching_rules_table',1),
(14,'2022_01_07_130449_create_portfolio_assets_table',1),
(15,'2022_01_07_130451_create_portfolios_table',1),
(16,'2022_01_07_130452_create_trading_rules_table',1),
(17,'2022_01_07_130454_create_transactions_table',1);
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
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
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
  `start_dt` date NOT NULL DEFAULT curdate(),
  `end_dt` date NOT NULL DEFAULT '9999-12-31',
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `portfolio_assets_portfolio_id_foreign` (`portfolio_id`),
  KEY `portfolio_assets_asset_id_foreign` (`asset_id`),
  CONSTRAINT `portfolio_assets_asset_id_foreign` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`),
  CONSTRAINT `portfolio_assets_portfolio_id_foreign` FOREIGN KEY (`portfolio_id`) REFERENCES `portfolios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `portfolio_assets`
--

/*!40000 ALTER TABLE `portfolio_assets` DISABLE KEYS */;
INSERT INTO `portfolio_assets` VALUES (1,1,1,32.00000000,'2021-01-01','9999-12-31','2022-01-04 14:56:59','2022-01-07 21:44:19'),
(2,1,2,53.00000000,'2021-01-01','9999-12-31','2022-01-04 14:56:59','2022-01-07 21:44:19'),
(3,1,3,65.00000000,'2021-01-01','9999-12-31','2022-01-04 14:56:59','2022-01-07 21:44:19'),
(4,1,4,91.00000000,'2021-01-01','9999-12-31','2022-01-04 14:56:59','2022-01-07 21:44:19'),
(5,1,5,138.71400000,'2021-01-01','9999-12-31','2022-01-04 14:56:59','2022-01-07 21:44:19'),
(6,1,6,532.59600000,'2021-01-01','9999-12-31','2022-01-04 14:56:59','2022-01-07 21:44:19'),
(7,1,7,0.36046314,'2021-01-01','9999-12-31','2022-01-04 14:56:59','2022-01-07 21:44:19'),
(8,1,8,0.01836910,'2021-01-01','9999-12-31','2022-01-04 14:56:59','2022-01-07 21:44:19'),
(9,1,9,3.74535299,'2021-01-01','9999-12-31','2022-01-04 14:56:59','2022-01-07 21:44:19'),
(10,1,10,3948.00000000,'2021-03-01','2021-07-01','2022-01-16 19:53:05','2022-01-07 21:44:19'),
(11,2,1,67.62800000,'2021-01-01','9999-12-31','2022-01-04 14:56:59','2022-01-07 21:44:19'),
(12,2,2,40.42000000,'2021-01-01','9999-12-31','2022-01-04 14:56:59','2022-01-07 21:44:19'),
(13,2,3,54.58000000,'2021-01-01','9999-12-31','2022-01-04 14:56:59','2022-01-07 21:44:19'),
(14,2,4,94.00000000,'2021-01-01','9999-12-31','2022-01-04 14:56:59','2022-01-07 21:44:19'),
(15,2,5,0.00000000,'2021-01-01','9999-12-31','2022-01-04 14:56:59','2022-01-07 21:44:19'),
(16,2,6,598.55600000,'2021-01-01','9999-12-31','2022-01-04 14:56:59','2022-01-07 21:44:19'),
(17,2,7,0.40050685,'2021-01-01','9999-12-31','2022-01-04 14:56:59','2022-01-07 21:44:19'),
(18,2,8,0.01752356,'2021-01-01','9999-12-31','2022-01-04 14:56:59','2022-01-07 21:44:19'),
(19,2,9,1.76610087,'2021-01-01','9999-12-31','2022-01-04 14:56:59','2022-01-07 21:44:19'),
(21,2,11,885.16959200,'2021-01-01','9999-12-31','2022-01-04 14:56:59','2022-01-07 21:44:19'),
(22,2,12,911.52779760,'2021-01-01','9999-12-31','2022-01-04 14:56:59','2022-01-07 21:44:19'),
(23,2,13,0.00000000,'2021-01-01','9999-12-31','2022-01-09 01:45:38','2022-01-07 21:44:19'),
(24,1,10,6497.78670000,'2021-01-01','2021-03-01','2022-01-16 20:56:22','2022-01-16 19:48:01'),
(25,1,10,9841.40703609,'2021-07-01','2022-01-09','2022-01-16 20:39:12','2022-01-16 19:53:05'),
(26,1,10,9484.00461704,'2022-01-09','9999-12-31',NULL,'2022-01-16 20:03:42'),
(27,2,10,3948.00000000,'2021-03-01','2021-07-01',NULL,'2022-01-16 20:20:06'),
(28,2,10,5331.83720070,'2021-01-01','2021-03-01','2022-01-16 20:58:02','2022-01-16 20:20:06'),
(29,2,10,8675.45720080,'2021-07-01','2022-01-09','2022-01-16 21:10:55','2022-01-16 20:20:06'),
(30,2,10,6182.78184414,'2022-01-09','9999-12-31','2022-01-16 21:01:31','2022-01-16 20:20:06');
/*!40000 ALTER TABLE `portfolio_assets` ENABLE KEYS */;

--
-- Table structure for table `portfolios`
--

DROP TABLE IF EXISTS `portfolios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `portfolios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fund_id` bigint(20) unsigned NOT NULL,
  `code` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `portfolios_fund_id_foreign` (`fund_id`),
  CONSTRAINT `portfolios_fund_id_foreign` FOREIGN KEY (`fund_id`) REFERENCES `funds` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `portfolios`
--

/*!40000 ALTER TABLE `portfolios` DISABLE KEYS */;
INSERT INTO `portfolios` VALUES (1,1,'FFFidelity','2021-12-31 08:51:32','2021-12-31 11:51:37',NULL),
(2,2,'FFIB','2021-12-31 19:54:41','2021-12-31 22:54:44',NULL);
/*!40000 ALTER TABLE `portfolios` ENABLE KEYS */;

--
-- Table structure for table `trading_rules`
--

DROP TABLE IF EXISTS `trading_rules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trading_rules` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_sale_increase_pcnt` decimal(5,2) DEFAULT NULL,
  `min_fund_performance_pcnt` decimal(5,2) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trading_rules`
--

/*!40000 ALTER TABLE `trading_rules` DISABLE KEYS */;
INSERT INTO `trading_rules` VALUES (1,'3%',3.00,NULL,'2021-12-29 03:18:09','2022-01-07 21:44:19',NULL),
(2,'min perf 3%',NULL,3.00,NULL,'2022-01-12 05:47:35',NULL),
(3,'3%-3%',3.00,3.00,NULL,'2022-01-12 05:47:35',NULL);
/*!40000 ALTER TABLE `trading_rules` ENABLE KEYS */;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `source` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` decimal(13,2) NOT NULL,
  `shares` decimal(19,4) NOT NULL,
  `account_id` bigint(20) unsigned NOT NULL,
  `matching_rule_id` bigint(20) unsigned DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transactions_account_id_foreign` (`account_id`),
  KEY `transactions_matching_rule_id_foreign` (`matching_rule_id`),
  CONSTRAINT `transactions_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`),
  CONSTRAINT `transactions_matching_rule_id_foreign` FOREIGN KEY (`matching_rule_id`) REFERENCES `matching_rules` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (2,'SPO','PUR',2000.00,2000.0000,1,NULL,'2022-01-15 05:59:14','2021-01-01 00:00:00',NULL),
(3,'SPO','PUR',2000.00,2000.0000,2,NULL,'2022-01-15 05:59:14','2021-01-01 00:00:00',NULL),
(4,'SPO','PUR',2000.00,2000.0000,3,NULL,'2022-01-15 05:59:14','2021-01-01 00:00:00',NULL),
(5,'SPO','PUR',2000.00,2000.0000,4,NULL,'2022-01-15 05:59:14','2021-01-01 00:00:00',NULL),
(6,'SPO','PUR',5000.00,5000.0000,5,NULL,'2022-01-15 05:59:14','2021-01-01 00:00:00',NULL),
(7,'DIR','PUR',150.00,132.3049,1,NULL,'2022-01-16 20:40:22','2021-07-01 00:00:00',NULL),
(8,'DIR','PUR',150.00,132.3049,2,NULL,'2022-01-16 20:40:22','2021-07-01 00:00:00',NULL),
(9,'MAT','PUR',150.00,132.3049,1,1,'2022-01-16 20:40:22','2021-07-01 00:00:00',NULL),
(10,'MAT','PUR',150.00,132.3049,2,1,'2022-01-16 20:40:22','2021-07-01 00:00:00',NULL),
(11,'DIR','BOR',89.81,100.0101,3,NULL,'2022-01-16 20:48:38','2021-06-01 00:00:00',NULL),
(12,'DIR','SAL',113.37,99.9960,4,NULL,'2022-01-16 20:48:51','2021-07-01 00:00:00',NULL),
(13,'SPO','PUR',80.50,71.0036,6,NULL,'2022-01-16 20:49:03','2021-12-29 00:00:00',NULL),
(14,'DIR','REP',73.96,50.0011,3,NULL,'2022-01-16 20:49:12','2022-01-05 00:00:00',NULL),
(15,'SPO','PUR',2000.00,2000.0000,12,NULL,'2022-01-15 05:59:14','2021-01-01 00:00:00',NULL),
(16,'DIR','PUR',200.00,148.2636,12,NULL,'2022-01-16 21:14:20','2022-01-09 02:35:00',NULL),
(17,'MAT','PUR',200.00,148.2636,12,1,'2022-01-16 21:14:20','2022-01-09 02:35:00',NULL),
(18,'DIR','PUR',1500.00,1111.9770,12,NULL,'2022-01-16 21:14:53','2022-01-09 02:35:00',NULL),
(19,'MAT','PUR',200.00,148.2636,12,4,'2022-01-16 21:15:11','2022-01-09 02:35:00',NULL),
(20,'DIR','PUR',50.00,37.0659,7,NULL,'2022-01-16 21:15:39','2022-01-09 02:35:00',NULL),
(21,'MAT','PUR',50.00,37.0659,7,1,'2022-01-16 21:15:39','2022-01-09 02:35:00',NULL),
(22,'DIR','PUR',150.00,111.1977,7,NULL,'2022-01-16 21:16:06','2022-01-09 02:35:00',NULL),
(23,'MAT','PUR',150.00,111.1977,7,4,'2022-01-16 21:16:06','2022-01-09 02:35:00',NULL),
(24,'DIR','PUR',50.00,37.0659,8,NULL,'2022-01-16 21:15:39','2022-01-09 02:35:00',NULL),
(25,'MAT','PUR',50.00,37.0659,8,1,'2022-01-16 21:15:39','2022-01-09 02:35:00',NULL),
(26,'DIR','PUR',150.00,111.1977,8,NULL,'2022-01-16 21:16:06','2022-01-09 02:35:00',NULL),
(27,'MAT','PUR',150.00,111.1977,8,4,'2022-01-16 21:16:06','2022-01-09 02:35:00',NULL),
(28,'DIR','PUR',200.00,148.2636,10,NULL,'2022-01-16 21:16:23','2022-01-09 02:37:45',NULL),
(29,'MAT','PUR',200.00,148.2636,10,1,'2022-01-16 21:16:23','2022-01-09 02:37:45',NULL),
(30,'DIR','PUR',200.00,148.2636,9,NULL,'2022-01-16 21:16:23','2022-01-09 02:37:45',NULL),
(31,'MAT','PUR',200.00,148.2636,9,1,'2022-01-16 21:16:23','2022-01-09 02:37:45',NULL),
(32,'DIR','PUR',100.00,74.1318,9,NULL,'2022-01-16 21:16:41','2022-01-09 02:37:45',NULL),
(33,'MAT','PUR',100.00,74.1318,9,4,'2022-01-16 21:16:41','2022-01-09 02:37:45',NULL),
(34,'SPO','PUR',25000.00,25000.0003,13,NULL,'2022-01-16 21:04:21','2021-01-01 00:00:00',NULL),
(35,'SPO','PUR',25000.00,25000.0000,14,NULL,'2022-01-12 02:26:55','2021-01-01 00:00:00',NULL),
(36,'SPO','PUR',600.00,540.6597,14,NULL,'2022-01-16 21:16:58','2021-07-01 00:00:00',NULL),
(42,'DIR','PUR',150.00,135.1649,7,NULL,'2022-01-16 21:17:22','2021-07-01 00:00:00',NULL),
(43,'DIR','PUR',150.00,135.1649,8,NULL,'2022-01-16 21:17:22','2021-07-01 00:00:00',NULL),
(44,'MAT','PUR',150.00,135.1649,7,1,'2022-01-16 21:17:22','2021-07-01 00:00:00',NULL),
(45,'MAT','PUR',150.00,135.1649,8,1,'2022-01-16 21:17:22','2021-07-01 00:00:00',NULL),
(46,'SPO','PUR',2000.00,2000.0000,7,NULL,'2022-01-15 05:59:14','2021-01-01 00:00:00',NULL),
(47,'SPO','PUR',2000.00,2000.0000,8,NULL,'2022-01-15 05:59:14','2021-01-01 00:00:00',NULL),
(48,'SPO','PUR',2000.00,2000.0000,9,NULL,'2022-01-15 05:59:14','2021-01-01 00:00:00',NULL),
(49,'SPO','PUR',2000.00,2000.0000,10,NULL,'2022-01-15 05:59:14','2021-01-01 00:00:00',NULL),
(50,'SPO','PUR',5000.00,5000.0000,11,NULL,'2022-01-15 05:59:14','2021-01-01 00:00:00',NULL);
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
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'NieceA1','niecea1@familyfund.com',NULL,'$2y$10$0Izqs4fkkhLTlqpH0J8Kg.tYqAPCT0MsGLbfElHnvWEv9ZwNwFM5u',NULL,'2021-12-31 11:26:15','2021-12-31 11:26:15'),
(2,'NieceA2','niecea2@familyfund.com',NULL,'$2y$10$I8XWYlnpDsJSXvZcXCD0/uGtuwaiCBpc32a8r91Gxm/HQQhSso9Zu',NULL,'2021-12-31 11:26:15','2021-12-31 11:26:15'),
(3,'NieceB1','nieceb1@familyfund.com',NULL,'$2y$10$TqTqP9KS37cu/4eLwyDkieQc3qhpACBHAjx/kP0UbreS0D7redAbS',NULL,'2021-12-31 11:26:15','2021-12-31 11:26:15'),
(4,'NieceB2','nieceb2@familyfund.com',NULL,'$2y$10$6/YMhjhMLaXTdgIatYY2eOfMi5tGlHM1W3bVEpZR.olZb6ioSWaMy',NULL,'2021-12-31 11:26:16','2021-12-31 11:26:16'),
(5,'NephewC1','nephewc1@familyfund.com',NULL,'$2y$10$X.dHjYYldFId4Nj0j3Uf0OTbvyprEiOKjVd2KRFc2KfUEMwqkuuaW',NULL,'2021-12-31 11:26:16','2021-12-31 11:26:16'),
(6,'Admin1','admin1@familyfund.com',NULL,'$2y$10$2bHnNO3bCShADCbwiezrTezCcCf1R0KWrpYhtcBbFiaE3xhq1Ki66',NULL,'2021-12-31 11:26:16','2021-12-31 11:26:16'),
(7,'Org1','org1@familyfund.com',NULL,'$2y$10$TumucOzMRLEJXfpHHA8eeuzvwJUrQONEzyPgZidLVuvoCOmGIKaJq',NULL,'2021-12-31 11:26:16','2021-12-31 11:26:16'),
(8,'Sister2','sister2@familyfund.com',NULL,'$2y$10$TumucOzMRLEJXfpHHA8eeuzvwJUrQONEzyPgZidLVuvoCOmGIKaJq',NULL,NULL,'2022-01-09 02:23:37');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-01-16 16:53:14
