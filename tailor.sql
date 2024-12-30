-- MySQL dump 10.13  Distrib 8.0.33, for Linux (x86_64)
--
-- Host: localhost    Database: tailor
-- ------------------------------------------------------
-- Server version	8.0.33

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
-- Table structure for table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `addresses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `state_id` bigint unsigned NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `addresses_user_id_foreign` (`user_id`),
  KEY `addresses_state_id_foreign` (`state_id`),
  CONSTRAINT `addresses_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addresses`
--

LOCK TABLES `addresses` WRITE;
/*!40000 ALTER TABLE `addresses` DISABLE KEYS */;
/*!40000 ALTER TABLE `addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `artist_availables`
--

DROP TABLE IF EXISTS `artist_availables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `artist_availables` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `store_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `dated` datetime NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `artist_availables_store_id_foreign` (`store_id`),
  KEY `artist_availables_product_id_foreign` (`product_id`),
  CONSTRAINT `artist_availables_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `artist_availables_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artist_availables`
--

LOCK TABLES `artist_availables` WRITE;
/*!40000 ALTER TABLE `artist_availables` DISABLE KEYS */;
/*!40000 ALTER TABLE `artist_availables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attachments`
--

DROP TABLE IF EXISTS `attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attachments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `message_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attachments_message_id_foreign` (`message_id`),
  CONSTRAINT `attachments_message_id_foreign` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attachments`
--

LOCK TABLES `attachments` WRITE;
/*!40000 ALTER TABLE `attachments` DISABLE KEYS */;
/*!40000 ALTER TABLE `attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banks`
--

DROP TABLE IF EXISTS `banks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `banks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recepient` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `banks_store_id_foreign` (`store_id`),
  CONSTRAINT `banks_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banks`
--

LOCK TABLES `banks` WRITE;
/*!40000 ALTER TABLE `banks` DISABLE KEYS */;
/*!40000 ALTER TABLE `banks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `color_id` bigint unsigned DEFAULT NULL,
  `size_id` bigint unsigned DEFAULT NULL,
  `location_id` bigint unsigned DEFAULT NULL,
  `drawing_id` bigint unsigned DEFAULT NULL,
  `fabric_id` bigint unsigned DEFAULT NULL,
  `units` int NOT NULL DEFAULT '1',
  `note` text COLLATE utf8mb4_unicode_ci,
  `top_length` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shoulder_length` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `neck_length` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `arm_width` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `arm_length` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `belly_length` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `waist_length` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bottom_length` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thigh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ankle_width` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `available_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `carts_user_id_foreign` (`user_id`),
  KEY `carts_product_id_foreign` (`product_id`),
  KEY `carts_color_id_foreign` (`color_id`),
  KEY `carts_size_id_foreign` (`size_id`),
  KEY `carts_location_id_foreign` (`location_id`),
  KEY `carts_drawing_id_foreign` (`drawing_id`),
  KEY `carts_fabric_id_foreign` (`fabric_id`),
  KEY `carts_available_id_foreign` (`available_id`),
  CONSTRAINT `carts_available_id_foreign` FOREIGN KEY (`available_id`) REFERENCES `artist_availables` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `carts_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `product_colors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `carts_drawing_id_foreign` FOREIGN KEY (`drawing_id`) REFERENCES `product_drawings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `carts_fabric_id_foreign` FOREIGN KEY (`fabric_id`) REFERENCES `product_fabrics` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `carts_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `product_locations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `carts_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `product_sizes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carts`
--

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Designers','Designers','2024-12-14 16:53:42','2024-12-14 16:53:42'),(2,'Styles','Styles','2024-12-14 16:53:42','2024-12-14 16:53:42'),(3,'Shoes','Shoes','2024-12-14 16:53:42','2024-12-14 16:53:42'),(4,'Fabrics','Fabrics','2024-12-14 16:53:43','2024-12-14 16:53:43'),(5,'Make-Up','Make Up','2024-12-14 16:53:43','2024-12-14 16:53:43'),(6,'Accessories','Accessories','2024-12-14 16:53:43','2024-12-14 16:53:43'),(7,'Multipurpose','All categories','2024-12-14 16:53:43','2024-12-14 16:53:43');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coverages`
--

DROP TABLE IF EXISTS `coverages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coverages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `area` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fee` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `coverages_product_id_foreign` (`product_id`),
  CONSTRAINT `coverages_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coverages`
--

LOCK TABLES `coverages` WRITE;
/*!40000 ALTER TABLE `coverages` DISABLE KEYS */;
/*!40000 ALTER TABLE `coverages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_likes`
--

DROP TABLE IF EXISTS `event_likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event_likes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `event_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_likes_event_id_foreign` (`event_id`),
  KEY `event_likes_user_id_foreign` (`user_id`),
  CONSTRAINT `event_likes_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `event_likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_likes`
--

LOCK TABLES `event_likes` WRITE;
/*!40000 ALTER TABLE `event_likes` DISABLE KEYS */;
/*!40000 ALTER TABLE `event_likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_media`
--

DROP TABLE IF EXISTS `event_media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event_media` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `event_id` bigint unsigned NOT NULL,
  `url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_media_event_id_foreign` (`event_id`),
  CONSTRAINT `event_media_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_media`
--

LOCK TABLES `event_media` WRITE;
/*!40000 ALTER TABLE `event_media` DISABLE KEYS */;
/*!40000 ALTER TABLE `event_media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_registers`
--

DROP TABLE IF EXISTS `event_registers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event_registers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `event_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_registers_event_id_foreign` (`event_id`),
  KEY `event_registers_user_id_foreign` (`user_id`),
  CONSTRAINT `event_registers_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `event_registers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_registers`
--

LOCK TABLES `event_registers` WRITE;
/*!40000 ALTER TABLE `event_registers` DISABLE KEYS */;
/*!40000 ALTER TABLE `event_registers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_types`
--

DROP TABLE IF EXISTS `event_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_types`
--

LOCK TABLES `event_types` WRITE;
/*!40000 ALTER TABLE `event_types` DISABLE KEYS */;
INSERT INTO `event_types` VALUES (1,'Pre-Recorded','This is a pre-recorded event','2024-12-14 16:53:59','2024-12-14 16:53:59'),(2,'Live','This is a Live event','2024-12-14 16:54:00','2024-12-14 16:54:00');
/*!40000 ALTER TABLE `event_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `events` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_type` bigint unsigned NOT NULL,
  `dated` date NOT NULL,
  `timed` time NOT NULL,
  `venue` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `events_store_id_foreign` (`store_id`),
  KEY `events_event_type_foreign` (`event_type`),
  CONSTRAINT `events_event_type_foreign` FOREIGN KEY (`event_type`) REFERENCES `event_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `events_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,'Mr. Theo Lynch','Voluptatem numquam sint accusantium minima optio. Sed vero atque velit. Voluptatibus earum voluptatem dolores veniam ducimus dolorem est qui. Qui numquam inventore repellat ea harum.','9db97681-b503-4156-852f-e8c2edff3f99',1,'1997-10-16','12:03:49',NULL,'2024-12-14 16:54:00','2024-12-14 16:54:00'),(2,'Billie Lowe','Corporis ut esse facere et sed incidunt in. Nesciunt qui eos sit quia enim tenetur.','9db97681-b503-4156-852f-e8c2edff3f99',1,'1984-07-11','05:18:33',NULL,'2024-12-14 16:54:00','2024-12-14 16:54:00'),(3,'Ryann Lynch','Est odit quia natus. In laudantium minima excepturi non facere voluptate. Architecto doloribus beatae quo qui quia quaerat tenetur debitis.','9db97681-b503-4156-852f-e8c2edff3f99',1,'1992-06-17','11:48:14',NULL,'2024-12-14 16:54:00','2024-12-14 16:54:00'),(4,'Lura Medhurst','Quia est aut dolorem id temporibus alias. Odio quia sit consectetur numquam ut est. Aut id eos ut optio non cumque omnis.','9db97681-b503-4156-852f-e8c2edff3f99',1,'1993-04-13','22:07:41',NULL,'2024-12-14 16:54:01','2024-12-14 16:54:01'),(5,'Athena Botsford','Et rem quia architecto ut. Eum aut aliquam sed quidem. Ea minus accusantium ut quasi. Quod voluptatem impedit aut.','9db97681-b503-4156-852f-e8c2edff3f99',1,'1981-08-20','18:43:15',NULL,'2024-12-14 16:54:01','2024-12-14 16:54:01'),(6,'Marquise Lynch','Repellendus a dignissimos qui consequuntur in. Aut quasi porro qui recusandae harum voluptate amet. Non eligendi voluptatem sed.','9db97681-b503-4156-852f-e8c2edff3f99',1,'1998-07-09','00:40:56',NULL,'2024-12-14 16:54:01','2024-12-14 16:54:01'),(7,'Birdie Beatty','Velit et voluptates impedit voluptas. Necessitatibus aut sed et consequatur. Voluptatum quo ratione in consequatur.','9db97681-b503-4156-852f-e8c2edff3f99',1,'1985-08-14','19:59:48',NULL,'2024-12-14 16:54:01','2024-12-14 16:54:01'),(8,'Mr. Kennith Heaney','Ut ipsam delectus fuga ipsum. Dolorem nemo nam dolorem facere. Voluptate molestias doloremque commodi nisi rerum quia.','9db97681-b503-4156-852f-e8c2edff3f99',1,'1985-01-22','17:16:05',NULL,'2024-12-14 16:54:01','2024-12-14 16:54:01'),(9,'Darby Kihn','Aliquid qui dolores velit culpa. Sint quibusdam nulla esse omnis suscipit quaerat tempore. Et nulla ea alias eaque.','9db97681-b503-4156-852f-e8c2edff3f99',1,'2002-10-27','17:48:56',NULL,'2024-12-14 16:54:01','2024-12-14 16:54:01'),(10,'Dr. Helga Hoppe','Debitis quis at enim vel molestiae voluptatem eum sed. Tempora hic provident qui eaque ipsam et quia. Delectus accusantium veniam esse. Quia omnis magnam voluptates neque.','9db97681-b503-4156-852f-e8c2edff3f99',1,'2001-02-02','15:55:34',NULL,'2024-12-14 16:54:02','2024-12-14 16:54:02');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `follows`
--

DROP TABLE IF EXISTS `follows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `follows` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `store_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `follows_store_id_foreign` (`store_id`),
  KEY `follows_user_id_foreign` (`user_id`),
  CONSTRAINT `follows_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `follows_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `follows`
--

LOCK TABLES `follows` WRITE;
/*!40000 ALTER TABLE `follows` DISABLE KEYS */;
/*!40000 ALTER TABLE `follows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gallerycomments`
--

DROP TABLE IF EXISTS `gallerycomments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gallerycomments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `store_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gallerycomments_user_id_foreign` (`user_id`),
  KEY `gallerycomments_store_id_foreign` (`store_id`),
  CONSTRAINT `gallerycomments_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `gallerycomments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallerycomments`
--

LOCK TABLES `gallerycomments` WRITE;
/*!40000 ALTER TABLE `gallerycomments` DISABLE KEYS */;
/*!40000 ALTER TABLE `gallerycomments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gallerylikes`
--

DROP TABLE IF EXISTS `gallerylikes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gallerylikes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `like` tinyint(1) NOT NULL DEFAULT '1',
  `store_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gallerylikes_user_id_foreign` (`user_id`),
  KEY `gallerylikes_store_id_foreign` (`store_id`),
  CONSTRAINT `gallerylikes_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `gallerylikes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallerylikes`
--

LOCK TABLES `gallerylikes` WRITE;
/*!40000 ALTER TABLE `gallerylikes` DISABLE KEYS */;
/*!40000 ALTER TABLE `gallerylikes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `galleryratings`
--

DROP TABLE IF EXISTS `galleryratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `galleryratings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `rating` double(8,2) DEFAULT NULL,
  `store_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `galleryratings_user_id_foreign` (`user_id`),
  KEY `galleryratings_store_id_foreign` (`store_id`),
  CONSTRAINT `galleryratings_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `galleryratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galleryratings`
--

LOCK TABLES `galleryratings` WRITE;
/*!40000 ALTER TABLE `galleryratings` DISABLE KEYS */;
/*!40000 ALTER TABLE `galleryratings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logistic_destinations`
--

DROP TABLE IF EXISTS `logistic_destinations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `logistic_destinations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `logistic_id` bigint unsigned NOT NULL,
  `state_id` bigint unsigned NOT NULL,
  `area` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `logistic_destinations_logistic_id_foreign` (`logistic_id`),
  KEY `logistic_destinations_state_id_foreign` (`state_id`),
  CONSTRAINT `logistic_destinations_logistic_id_foreign` FOREIGN KEY (`logistic_id`) REFERENCES `logistics` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `logistic_destinations_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logistic_destinations`
--

LOCK TABLES `logistic_destinations` WRITE;
/*!40000 ALTER TABLE `logistic_destinations` DISABLE KEYS */;
/*!40000 ALTER TABLE `logistic_destinations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logistics`
--

DROP TABLE IF EXISTS `logistics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `logistics` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logistics`
--

LOCK TABLES `logistics` WRITE;
/*!40000 ALTER TABLE `logistics` DISABLE KEYS */;
/*!40000 ALTER TABLE `logistics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `media` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `product_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `media_product_id_foreign` (`product_id`),
  CONSTRAINT `media_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sender_id` bigint unsigned NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci,
  `recepient_id` bigint unsigned NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `read` tinyint(1) NOT NULL DEFAULT '0',
  `starred` tinyint(1) NOT NULL DEFAULT '0',
  `muted` tinyint(1) NOT NULL DEFAULT '0',
  `archived` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `messages_sender_id_foreign` (`sender_id`),
  KEY `messages_recepient_id_foreign` (`recepient_id`),
  CONSTRAINT `messages_recepient_id_foreign` FOREIGN KEY (`recepient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,10,'Quia dicta maxime blanditiis nemo libero. Sit est molestiae repudiandae doloribus est incidunt. Et sed totam distinctio est sapiente.',10,NULL,0,0,0,0,'2024-12-14 16:53:57','2024-12-14 16:53:57'),(2,10,'Voluptas ducimus enim eveniet et. Qui excepturi ullam et quo esse vel odio. Corporis autem magni sed repellendus similique.',10,NULL,0,0,0,0,'2024-12-14 16:53:57','2024-12-14 16:53:57'),(3,10,'Dolore atque laboriosam dolor magni suscipit quaerat harum. Doloribus et dignissimos qui earum blanditiis aut dolor ut. Et recusandae quam et hic eos corporis suscipit.',10,NULL,0,0,0,0,'2024-12-14 16:53:57','2024-12-14 16:53:57'),(4,10,'Dolor optio fuga temporibus dolorem. Maiores assumenda dolores odit quas nesciunt necessitatibus ad itaque. Autem blanditiis ipsam sunt rem reprehenderit.',10,NULL,0,0,0,0,'2024-12-14 16:53:57','2024-12-14 16:53:57'),(5,10,'Aperiam veritatis accusamus nulla et id dicta minus hic. Veniam ut temporibus voluptatibus. Eos ipsa qui beatae facere expedita voluptas. Aut qui doloribus alias excepturi.',10,NULL,0,0,0,0,'2024-12-14 16:53:58','2024-12-14 16:53:58'),(6,10,'Occaecati unde voluptas eaque aut explicabo corporis tempora ullam. Est commodi sint pariatur aspernatur et. Nihil consectetur sed itaque debitis ut accusamus velit nihil.',10,NULL,0,0,0,0,'2024-12-14 16:53:58','2024-12-14 16:53:58'),(7,10,'Et doloremque incidunt quaerat vero ducimus quidem beatae quam. Cum minus ut corrupti dolorem. Pariatur facere repudiandae ea.',10,NULL,0,0,0,0,'2024-12-14 16:53:58','2024-12-14 16:53:58'),(8,10,'Atque placeat quo illo reiciendis. Dolore molestiae rerum eligendi sapiente sequi est aut. Officia aliquid minima explicabo amet quibusdam in.',10,NULL,0,0,0,0,'2024-12-14 16:53:58','2024-12-14 16:53:58'),(9,10,'In et quod ex et praesentium maiores. Sunt reiciendis esse commodi officia in. Tenetur quia rerum odit est. Aut quia non qui rerum et asperiores.',10,NULL,0,0,0,0,'2024-12-14 16:53:58','2024-12-14 16:53:58'),(10,10,'Nisi nostrum eum ducimus est. Quibusdam possimus dolorum dicta quia. Non temporibus rerum et doloremque eos.',10,NULL,0,0,0,0,'2024-12-14 16:53:59','2024-12-14 16:53:59');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2013_01_06_175208_create_states_table',1),(2,'2013_01_07_173845_create_usertypes_table',1),(3,'2014_10_12_000000_create_users_table',1),(4,'2014_10_12_100000_create_password_resets_table',1),(5,'2019_08_19_000000_create_failed_jobs_table',1),(6,'2019_12_14_000001_create_personal_access_tokens_table',1),(7,'2023_01_05_151359_create_logistics_table',1),(8,'2023_01_07_183044_create_categories_table',1),(9,'2023_01_07_183045_create_product_categories_table',1),(10,'2023_01_07_183425_create_stores_table',1),(11,'2023_01_07_184551_create_transactions_table',1),(12,'2023_01_07_184640_create_products_table',1),(13,'2023_01_07_184644_create_medias_table',1),(14,'2023_04_15_192256_create_plans_table',1),(15,'2023_04_15_204301_create_subscriptions_table',1),(16,'2023_04_15_205207_create_messages_table',1),(17,'2023_05_01_165318_create_productlikes_table',1),(18,'2023_05_01_165553_create_storelikes_table',1),(19,'2023_05_01_165631_create_gallerylikes_table',1),(20,'2023_05_01_165701_create_productcomments_table',1),(21,'2023_05_01_165722_create_storecomments_table',1),(22,'2023_05_01_165740_create_gallerycomments_table',1),(23,'2023_05_01_165813_create_productratings_table',1),(24,'2023_05_01_170523_create_storeratings_table',1),(25,'2023_05_01_170547_create_galleryratings_table',1),(26,'2023_05_02_051604_create_attachments_table',1),(27,'2023_06_12_142050_create_storevideos_table',1),(28,'2023_07_05_112814_create_event_types_table',1),(29,'2023_07_05_113600_create_events_table',1),(30,'2023_07_05_113811_create_event_registers_table',1),(31,'2023_07_08_101223_create_event_media_table',1),(32,'2023_07_27_090234_create_product_colors_table',1),(33,'2023_07_27_090308_create_product_fabrics_table',1),(34,'2023_07_27_090327_create_product_drawings_table',1),(35,'2023_08_18_100642_create_product_sizes_table',1),(36,'2023_08_18_100751_create_product_locations_table',1),(37,'2023_09_04_094218_create_follows_table',1),(38,'2023_09_18_160124_create_stories_table',1),(39,'2023_12_03_100539_create_artist_availables_table',1),(40,'2023_12_07_104659_create_banks_table',1),(41,'2023_12_07_121524_create_transfers_table',1),(42,'2023_12_20_090931_create_logistic_destinations_table',1),(43,'2024_01_07_184650_create_orders_table',1),(44,'2024_02_27_214724_create_tags_table',1),(45,'2024_02_27_214920_create_event_likes_table',1),(46,'2024_02_27_215201_create_product_tags_table',1),(47,'2024_04_04_120940_create_report_stores_table',1),(48,'2024_04_04_121418_create_report_products_table',1),(49,'2024_04_04_121838_create_report_videos_table',1),(50,'2024_10_31_134357_create_carts_table',1),(51,'2024_11_11_203930_create_runway_products_table',1),(52,'2024_12_03_095801_create_addresses_table',1),(53,'2024_12_04_151616_create_coverages_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `units` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double(8,2) DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `size` bigint unsigned DEFAULT NULL,
  `colour` bigint unsigned DEFAULT NULL,
  `drawing` bigint unsigned DEFAULT NULL,
  `fabric` bigint unsigned DEFAULT NULL,
  `location` bigint unsigned DEFAULT NULL,
  `logistic_id` bigint unsigned DEFAULT NULL,
  `top_length` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shoulder_length` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `neck_length` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `arm_width` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `arm_length` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `belly_length` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `waist_length` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bottom_length` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thigh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ankle_width` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Order placed',
  `settled` tinyint(1) NOT NULL DEFAULT '0',
  `latitude` double(8,2) DEFAULT NULL,
  `longitude` double(8,2) DEFAULT NULL,
  `transaction_id` bigint unsigned NOT NULL,
  `delivery_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `available_id` bigint unsigned DEFAULT NULL,
  `area_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_product_id_foreign` (`product_id`),
  KEY `orders_size_foreign` (`size`),
  KEY `orders_colour_foreign` (`colour`),
  KEY `orders_drawing_foreign` (`drawing`),
  KEY `orders_fabric_foreign` (`fabric`),
  KEY `orders_location_foreign` (`location`),
  KEY `orders_logistic_id_foreign` (`logistic_id`),
  KEY `orders_transaction_id_foreign` (`transaction_id`),
  KEY `orders_available_id_foreign` (`available_id`),
  KEY `orders_area_id_foreign` (`area_id`),
  CONSTRAINT `orders_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `logistic_destinations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `orders_available_id_foreign` FOREIGN KEY (`available_id`) REFERENCES `artist_availables` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `orders_colour_foreign` FOREIGN KEY (`colour`) REFERENCES `product_colors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `orders_drawing_foreign` FOREIGN KEY (`drawing`) REFERENCES `product_drawings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `orders_fabric_foreign` FOREIGN KEY (`fabric`) REFERENCES `product_fabrics` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `orders_location_foreign` FOREIGN KEY (`location`) REFERENCES `product_locations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `orders_logistic_id_foreign` FOREIGN KEY (`logistic_id`) REFERENCES `logistics` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `orders_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `orders_size_foreign` FOREIGN KEY (`size`) REFERENCES `product_sizes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `orders_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

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
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
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

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plans`
--

DROP TABLE IF EXISTS `plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `plans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plans`
--

LOCK TABLES `plans` WRITE;
/*!40000 ALTER TABLE `plans` DISABLE KEYS */;
INSERT INTO `plans` VALUES (1,'Basic','Maximum of 10 products, 10 pictures per product, 10 Runway videos and 10 videos per story in your store at a time. Store outlook customization is unavailable to the subscription. Sketch and comment boxes for the designer and shoe sections are also unavailable for this plan.',0.00,'2024-12-14 16:53:59','2024-12-14 16:53:59'),(2,'Gold','A maximium 50 products, 20 pictures per product, 20 Runway videos and 20 videos per story can be uploaded by the vendor. This plan has limited outlook customization features with an increased probability of appearing at the top of the gallery. The comments box is available for this plan but the sketch box is unavailable. Pop up suggestions is not available for this plan.',3000.00,'2024-12-14 16:53:59','2024-12-14 16:53:59'),(3,'Platinum','This plan has unlimited access to all features with vendors on this plan having a higher probability of appearing at the top of the general gallery as well as its section gallery. Stores on this plan with a 5 star rating have a higher probability of appearing at the top of the stores.',6000.00,'2024-12-14 16:53:59','2024-12-14 16:53:59');
/*!40000 ALTER TABLE `plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_categories`
--

DROP TABLE IF EXISTS `product_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_categories`
--

LOCK TABLES `product_categories` WRITE;
/*!40000 ALTER TABLE `product_categories` DISABLE KEYS */;
INSERT INTO `product_categories` VALUES (1,'Men','Men\'s wears','2024-12-14 16:53:43','2024-12-14 16:53:43'),(2,'Women','Women\'s wears','2024-12-14 16:53:43','2024-12-14 16:53:43'),(3,'Kids','Kids\' wears','2024-12-14 16:53:44','2024-12-14 16:53:44'),(4,'All','All wears','2024-12-14 16:53:44','2024-12-14 16:53:44');
/*!40000 ALTER TABLE `product_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_colors`
--

DROP TABLE IF EXISTS `product_colors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_colors` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#000000',
  `url` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_colors_product_id_foreign` (`product_id`),
  CONSTRAINT `product_colors_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_colors`
--

LOCK TABLES `product_colors` WRITE;
/*!40000 ALTER TABLE `product_colors` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_colors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_drawings`
--

DROP TABLE IF EXISTS `product_drawings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_drawings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `url` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_drawings_product_id_foreign` (`product_id`),
  CONSTRAINT `product_drawings_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_drawings`
--

LOCK TABLES `product_drawings` WRITE;
/*!40000 ALTER TABLE `product_drawings` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_drawings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_fabrics`
--

DROP TABLE IF EXISTS `product_fabrics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_fabrics` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_fabrics_product_id_foreign` (`product_id`),
  CONSTRAINT `product_fabrics_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_fabrics`
--

LOCK TABLES `product_fabrics` WRITE;
/*!40000 ALTER TABLE `product_fabrics` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_fabrics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_locations`
--

DROP TABLE IF EXISTS `product_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_locations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_locations_product_id_foreign` (`product_id`),
  CONSTRAINT `product_locations_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_locations`
--

LOCK TABLES `product_locations` WRITE;
/*!40000 ALTER TABLE `product_locations` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_sizes`
--

DROP TABLE IF EXISTS `product_sizes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_sizes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_sizes_product_id_foreign` (`product_id`),
  CONSTRAINT `product_sizes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_sizes`
--

LOCK TABLES `product_sizes` WRITE;
/*!40000 ALTER TABLE `product_sizes` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_sizes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_tags`
--

DROP TABLE IF EXISTS `product_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_tags` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tag_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_tags_tag_id_foreign` (`tag_id`),
  KEY `product_tags_product_id_foreign` (`product_id`),
  CONSTRAINT `product_tags_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_tags_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_tags`
--

LOCK TABLES `product_tags` WRITE;
/*!40000 ALTER TABLE `product_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productcomments`
--

DROP TABLE IF EXISTS `productcomments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productcomments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `product_id` bigint unsigned NOT NULL,
  `parent_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `productcomments_user_id_foreign` (`user_id`),
  KEY `productcomments_product_id_foreign` (`product_id`),
  CONSTRAINT `productcomments_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `productcomments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productcomments`
--

LOCK TABLES `productcomments` WRITE;
/*!40000 ALTER TABLE `productcomments` DISABLE KEYS */;
INSERT INTO `productcomments` VALUES (1,1,'Doloremque debitis est ut officiis. Fugiat voluptatem eveniet nesciunt ullam hic voluptate. Earum numquam occaecati eius dolores et atque. Quia nobis minima architecto aperiam non aut.',1,NULL,'2024-12-14 16:54:02','2024-12-14 16:54:02'),(2,1,'Ducimus necessitatibus eum corporis veritatis. Aut est illum voluptates ut commodi pariatur voluptas. Sint sint sunt architecto quo optio. Consectetur velit et et reiciendis.',1,NULL,'2024-12-14 16:54:02','2024-12-14 16:54:02'),(3,1,'Similique ea repellat recusandae sit unde eos. Numquam aut accusamus ut qui magni. Quos autem sint eveniet libero eligendi atque. Veniam nisi harum earum dolores nostrum qui.',1,NULL,'2024-12-14 16:54:02','2024-12-14 16:54:02'),(4,1,'Vitae vitae sed error fugit deleniti. Modi fugiat itaque aspernatur et nisi.',1,NULL,'2024-12-14 16:54:02','2024-12-14 16:54:02'),(5,1,'Et suscipit architecto assumenda eum veniam sunt tenetur. Dolorem recusandae veniam et quisquam occaecati eum. Repudiandae omnis aut aut dolor. Dolores ut optio exercitationem eum sed.',1,NULL,'2024-12-14 16:54:03','2024-12-14 16:54:03'),(6,1,'Neque laudantium dolores non quam tenetur dolorem. Vitae ab nihil aliquid illo vel aut cupiditate. Sed possimus voluptas occaecati qui vel distinctio.',1,NULL,'2024-12-14 16:54:03','2024-12-14 16:54:03'),(7,1,'Ducimus aliquid est aut. Doloremque qui et id quia ex omnis. Cupiditate deserunt autem numquam ut consequatur. Voluptatem blanditiis recusandae aut qui rem illo impedit.',1,NULL,'2024-12-14 16:54:03','2024-12-14 16:54:03'),(8,1,'Nihil dolore qui culpa similique quisquam quo. Voluptas expedita cum corporis. Veniam sint ut occaecati optio eius incidunt vitae. Dolorem iure officia dolor consequatur laudantium placeat.',1,NULL,'2024-12-14 16:54:03','2024-12-14 16:54:03'),(9,1,'In et totam earum quia. Et libero est harum saepe autem. Molestiae accusantium minima deleniti enim. Velit aliquid quae quisquam similique.',1,NULL,'2024-12-14 16:54:03','2024-12-14 16:54:03'),(10,1,'Nam aut aspernatur dolor. Iste incidunt unde qui rem sint maiores. Et nisi ad amet molestiae.',1,NULL,'2024-12-14 16:54:03','2024-12-14 16:54:03');
/*!40000 ALTER TABLE `productcomments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productlikes`
--

DROP TABLE IF EXISTS `productlikes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productlikes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `like` tinyint(1) NOT NULL DEFAULT '1',
  `product_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `productlikes_user_id_foreign` (`user_id`),
  KEY `productlikes_product_id_foreign` (`product_id`),
  CONSTRAINT `productlikes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `productlikes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productlikes`
--

LOCK TABLES `productlikes` WRITE;
/*!40000 ALTER TABLE `productlikes` DISABLE KEYS */;
/*!40000 ALTER TABLE `productlikes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productratings`
--

DROP TABLE IF EXISTS `productratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productratings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `rating` double(8,2) DEFAULT NULL,
  `product_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `productratings_user_id_foreign` (`user_id`),
  KEY `productratings_product_id_foreign` (`product_id`),
  CONSTRAINT `productratings_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `productratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productratings`
--

LOCK TABLES `productratings` WRITE;
/*!40000 ALTER TABLE `productratings` DISABLE KEYS */;
/*!40000 ALTER TABLE `productratings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `old_price` double(8,2) DEFAULT NULL,
  `price` double(8,2) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `units` int DEFAULT NULL,
  `category_id` bigint unsigned DEFAULT NULL,
  `store_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_category_id` bigint unsigned DEFAULT NULL,
  `state_id` bigint unsigned DEFAULT NULL,
  `bespoke` tinyint(1) NOT NULL DEFAULT '0',
  `size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fabric` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` double(8,2) DEFAULT NULL,
  `offer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `made_in_nigeria` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_store_id_foreign` (`store_id`),
  KEY `products_product_category_id_foreign` (`product_category_id`),
  KEY `products_state_id_foreign` (`state_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `products_product_category_id_foreign` FOREIGN KEY (`product_category_id`) REFERENCES `product_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `products_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `products_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,748246.44,817370.54,'Kassandra Moore','Architecto enim quae quisquam impedit et ipsam accusamus. Omnis ut qui et nisi quia ullam. Cumque doloremque quia aut et ullam temporibus eos. Quis ut dolores repellat voluptas dolor similique autem.',9,1,'9db97681-b503-4156-852f-e8c2edff3f99',1,NULL,0,NULL,NULL,NULL,NULL,0,'2024-12-14 16:53:50','2024-12-14 16:53:50'),(2,217193.46,57677.12,'Verona Towne','Quae nam possimus tempora fuga hic. Magnam at maxime aut tempora. Molestiae accusamus rerum ut est ducimus.',68,1,'9db97681-b503-4156-852f-e8c2edff3f99',1,NULL,0,NULL,NULL,NULL,NULL,0,'2024-12-14 16:53:51','2024-12-14 16:53:51'),(3,193838.62,627971.42,'Joanne Crona','Natus quasi saepe cupiditate ipsam laboriosam aut et. Sunt rerum similique pariatur voluptas atque qui facilis. Velit aliquam aut aut corrupti qui placeat. Dolores dolor eius recusandae ab.',17512,1,'9db97681-b503-4156-852f-e8c2edff3f99',1,NULL,0,NULL,NULL,NULL,NULL,0,'2024-12-14 16:53:51','2024-12-14 16:53:51'),(4,392064.53,699255.35,'Brandy Bogisich','Ut aperiam corrupti libero quis deleniti. Beatae voluptates beatae cupiditate. Cumque ut explicabo incidunt saepe et dolorem.',5,1,'9db97681-b503-4156-852f-e8c2edff3f99',1,NULL,0,NULL,NULL,NULL,NULL,0,'2024-12-14 16:53:51','2024-12-14 16:53:51'),(5,115816.61,715953.44,'Dock Stark','Assumenda repudiandae atque dolore aliquam optio illum. Provident reprehenderit adipisci debitis odio. Nihil quia assumenda aperiam.',25628971,1,'9db97681-b503-4156-852f-e8c2edff3f99',1,NULL,0,NULL,NULL,NULL,NULL,0,'2024-12-14 16:53:52','2024-12-14 16:53:52'),(6,178779.19,595611.83,'Mr. Friedrich Feeney','Tenetur voluptatem ut atque aperiam nam fugit. Placeat qui aut maiores excepturi est quasi facere. Et aut magni dolor. Libero quia incidunt eligendi corporis dolores aperiam.',901403,1,'9db97681-b503-4156-852f-e8c2edff3f99',1,NULL,0,NULL,NULL,NULL,NULL,0,'2024-12-14 16:53:52','2024-12-14 16:53:52'),(7,20070.84,397294.71,'Janet Kris','Placeat quo adipisci omnis blanditiis labore cum sit ab. Iste expedita velit dignissimos ut. Fugiat eos cumque iusto tempora autem sequi modi.',107242669,1,'9db97681-b503-4156-852f-e8c2edff3f99',1,NULL,0,NULL,NULL,NULL,NULL,0,'2024-12-14 16:53:52','2024-12-14 16:53:52'),(8,718697.22,836304.61,'Willis Eichmann','Quia numquam similique maiores quas. Assumenda eos accusamus temporibus natus.',25340128,1,'9db97681-b503-4156-852f-e8c2edff3f99',1,NULL,0,NULL,NULL,NULL,NULL,0,'2024-12-14 16:53:52','2024-12-14 16:53:52'),(9,696432.92,253829.26,'Berneice Lang','Aut ut nihil ad porro at. Quidem aut maiores soluta praesentium corporis et. Suscipit suscipit sit sunt doloribus illo enim autem.',965,1,'9db97681-b503-4156-852f-e8c2edff3f99',1,NULL,0,NULL,NULL,NULL,NULL,0,'2024-12-14 16:53:53','2024-12-14 16:53:53'),(10,204449.56,789469.55,'Haylee Beier','Aut et velit iusto necessitatibus quasi. Iste quas est sunt qui necessitatibus quibusdam asperiores adipisci. Et minima consectetur aut dolores.',16665796,1,'9db97681-b503-4156-852f-e8c2edff3f99',1,NULL,0,NULL,NULL,NULL,NULL,0,'2024-12-14 16:53:53','2024-12-14 16:53:53'),(11,330166.74,95446.05,'Prof. Orion Stiedemann','Est delectus molestiae doloremque. Suscipit hic odit dolore sunt est vitae. Autem animi earum ut omnis et aut omnis autem.',85317599,1,'9db97681-b503-4156-852f-e8c2edff3f99',1,NULL,0,NULL,NULL,NULL,NULL,0,'2024-12-14 16:53:53','2024-12-14 16:53:53'),(12,434391.55,395214.78,'Vito Feest','A sint assumenda quidem et. Ut nemo voluptatem optio fugit rem veniam et. Maiores perferendis veniam necessitatibus quisquam tempora qui doloremque. Laudantium cupiditate aut ea nobis illum rem.',55,1,'9db97681-b503-4156-852f-e8c2edff3f99',1,NULL,0,NULL,NULL,NULL,NULL,0,'2024-12-14 16:53:54','2024-12-14 16:53:54'),(13,367227.33,210704.38,'Beaulah Weissnat','Qui aut est totam animi laboriosam. Commodi consequuntur pariatur autem ipsum. Fugit placeat error ad atque perferendis sit.',66,1,'9db97681-b503-4156-852f-e8c2edff3f99',1,NULL,0,NULL,NULL,NULL,NULL,0,'2024-12-14 16:53:54','2024-12-14 16:53:54'),(14,553913.66,882929.93,'Omari Tromp','Illum cupiditate corrupti dolorem et corrupti. Non animi rem doloremque repellat tempora porro quam. Labore dignissimos repellat et consequatur iusto quis.',192,1,'9db97681-b503-4156-852f-e8c2edff3f99',1,NULL,0,NULL,NULL,NULL,NULL,0,'2024-12-14 16:53:54','2024-12-14 16:53:54'),(15,105948.62,133238.11,'Joannie Dach','Velit nemo vero placeat. Ut consequatur quia dolor deleniti libero omnis. Sequi deserunt quod doloremque quo labore quis cupiditate.',85854319,1,'9db97681-b503-4156-852f-e8c2edff3f99',1,NULL,0,NULL,NULL,NULL,NULL,0,'2024-12-14 16:53:55','2024-12-14 16:53:55'),(16,362092.63,436775.01,'Giovanni Ritchie','Placeat aliquam aut occaecati atque. Qui amet sint provident laboriosam. Non error voluptatem cum ut. Voluptatibus inventore et a facere ut sapiente officia impedit.',1848,1,'9db97681-b503-4156-852f-e8c2edff3f99',1,NULL,0,NULL,NULL,NULL,NULL,0,'2024-12-14 16:53:55','2024-12-14 16:53:55'),(17,626129.88,151069.99,'Shakira Wintheiser','Et qui quam repellat dicta dignissimos impedit blanditiis illo. Id rem autem quam voluptatum optio sunt. Doloremque ratione temporibus incidunt. Et nemo et laborum qui ullam.',8696334,1,'9db97681-b503-4156-852f-e8c2edff3f99',1,NULL,0,NULL,NULL,NULL,NULL,0,'2024-12-14 16:53:55','2024-12-14 16:53:55'),(18,799690.36,884415.99,'Crystel West','Asperiores itaque quasi nobis ex quis perspiciatis officia officiis. Laudantium minus id ex magni ullam. Ut possimus sit est consequatur deserunt tempore.',79,1,'9db97681-b503-4156-852f-e8c2edff3f99',1,NULL,0,NULL,NULL,NULL,NULL,0,'2024-12-14 16:53:55','2024-12-14 16:53:55'),(19,473821.24,890900.23,'Dr. Kitty O\'Hara','Ut voluptas similique quisquam assumenda dolore blanditiis. Illum aliquid neque architecto sit ut pariatur magni. Vero quia asperiores dolor. Quis animi aut doloremque. Qui similique cum corporis.',561803,1,'9db97681-b503-4156-852f-e8c2edff3f99',1,NULL,0,NULL,NULL,NULL,NULL,0,'2024-12-14 16:53:56','2024-12-14 16:53:56'),(20,415309.07,779672.62,'Ena Goldner','Sint labore vitae quam ut. Deleniti aut ipsam ad ratione voluptates nesciunt nostrum dicta. A et in est qui porro illum. Repellendus et eligendi expedita placeat.',406470,1,'9db97681-b503-4156-852f-e8c2edff3f99',1,NULL,0,NULL,NULL,NULL,NULL,0,'2024-12-14 16:53:56','2024-12-14 16:53:56');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `report_products`
--

DROP TABLE IF EXISTS `report_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `report_products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report_products`
--

LOCK TABLES `report_products` WRITE;
/*!40000 ALTER TABLE `report_products` DISABLE KEYS */;
/*!40000 ALTER TABLE `report_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `report_stores`
--

DROP TABLE IF EXISTS `report_stores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `report_stores` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report_stores`
--

LOCK TABLES `report_stores` WRITE;
/*!40000 ALTER TABLE `report_stores` DISABLE KEYS */;
/*!40000 ALTER TABLE `report_stores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `report_videos`
--

DROP TABLE IF EXISTS `report_videos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `report_videos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report_videos`
--

LOCK TABLES `report_videos` WRITE;
/*!40000 ALTER TABLE `report_videos` DISABLE KEYS */;
/*!40000 ALTER TABLE `report_videos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `runway_products`
--

DROP TABLE IF EXISTS `runway_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `runway_products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `runway_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `runway_products_runway_id_foreign` (`runway_id`),
  KEY `runway_products_product_id_foreign` (`product_id`),
  CONSTRAINT `runway_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `runway_products_runway_id_foreign` FOREIGN KEY (`runway_id`) REFERENCES `storevideos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `runway_products`
--

LOCK TABLES `runway_products` WRITE;
/*!40000 ALTER TABLE `runway_products` DISABLE KEYS */;
/*!40000 ALTER TABLE `runway_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `states` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `states`
--

LOCK TABLES `states` WRITE;
/*!40000 ALTER TABLE `states` DISABLE KEYS */;
INSERT INTO `states` VALUES (1,'Abia','2024-12-14 16:53:32','2024-12-14 16:53:32'),(2,'Adamawa','2024-12-14 16:53:33','2024-12-14 16:53:33'),(3,'Akwa Ibom','2024-12-14 16:53:33','2024-12-14 16:53:33'),(4,'Anambra','2024-12-14 16:53:33','2024-12-14 16:53:33'),(5,'Bauchi','2024-12-14 16:53:33','2024-12-14 16:53:33'),(6,'Bayelsa','2024-12-14 16:53:33','2024-12-14 16:53:33'),(7,'Benue','2024-12-14 16:53:33','2024-12-14 16:53:33'),(8,'Borno','2024-12-14 16:53:34','2024-12-14 16:53:34'),(9,'Cross River','2024-12-14 16:53:34','2024-12-14 16:53:34'),(10,'Delta','2024-12-14 16:53:35','2024-12-14 16:53:35'),(11,'Ebonyi','2024-12-14 16:53:35','2024-12-14 16:53:35'),(12,'Edo','2024-12-14 16:53:35','2024-12-14 16:53:35'),(13,'Ekiti','2024-12-14 16:53:35','2024-12-14 16:53:35'),(14,'Enugu','2024-12-14 16:53:35','2024-12-14 16:53:35'),(15,'Federal Capital Terrirtory (Abuja)','2024-12-14 16:53:35','2024-12-14 16:53:35'),(16,'Gombe','2024-12-14 16:53:36','2024-12-14 16:53:36'),(17,'Imo','2024-12-14 16:53:36','2024-12-14 16:53:36'),(18,'Jigawa','2024-12-14 16:53:36','2024-12-14 16:53:36'),(19,'Kaduna','2024-12-14 16:53:36','2024-12-14 16:53:36'),(20,'Kano','2024-12-14 16:53:36','2024-12-14 16:53:36'),(21,'Katsina','2024-12-14 16:53:36','2024-12-14 16:53:36'),(22,'Kebbi','2024-12-14 16:53:37','2024-12-14 16:53:37'),(23,'Kogi','2024-12-14 16:53:37','2024-12-14 16:53:37'),(24,'Kwara','2024-12-14 16:53:37','2024-12-14 16:53:37'),(25,'Lagos','2024-12-14 16:53:37','2024-12-14 16:53:37'),(26,'Nasarawa','2024-12-14 16:53:37','2024-12-14 16:53:37'),(27,'Niger','2024-12-14 16:53:37','2024-12-14 16:53:37'),(28,'Ogun','2024-12-14 16:53:37','2024-12-14 16:53:37'),(29,'Ondo','2024-12-14 16:53:38','2024-12-14 16:53:38'),(30,'Osun','2024-12-14 16:53:38','2024-12-14 16:53:38'),(31,'Oyo','2024-12-14 16:53:38','2024-12-14 16:53:38'),(32,'Plateau','2024-12-14 16:53:38','2024-12-14 16:53:38'),(33,'Rivers','2024-12-14 16:53:38','2024-12-14 16:53:38'),(34,'Sokoto','2024-12-14 16:53:38','2024-12-14 16:53:38'),(35,'Taraba','2024-12-14 16:53:39','2024-12-14 16:53:39'),(36,'Yobe','2024-12-14 16:53:39','2024-12-14 16:53:39'),(37,'Zamfara','2024-12-14 16:53:39','2024-12-14 16:53:39');
/*!40000 ALTER TABLE `states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `storecomments`
--

DROP TABLE IF EXISTS `storecomments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `storecomments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `store_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `storecomments_user_id_foreign` (`user_id`),
  KEY `storecomments_store_id_foreign` (`store_id`),
  CONSTRAINT `storecomments_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `storecomments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `storecomments`
--

LOCK TABLES `storecomments` WRITE;
/*!40000 ALTER TABLE `storecomments` DISABLE KEYS */;
/*!40000 ALTER TABLE `storecomments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `storelikes`
--

DROP TABLE IF EXISTS `storelikes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `storelikes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `like` tinyint(1) NOT NULL DEFAULT '1',
  `store_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `storelikes_user_id_foreign` (`user_id`),
  KEY `storelikes_store_id_foreign` (`store_id`),
  CONSTRAINT `storelikes_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `storelikes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `storelikes`
--

LOCK TABLES `storelikes` WRITE;
/*!40000 ALTER TABLE `storelikes` DISABLE KEYS */;
/*!40000 ALTER TABLE `storelikes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `storeratings`
--

DROP TABLE IF EXISTS `storeratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `storeratings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `rating` double(8,2) DEFAULT NULL,
  `store_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `storeratings_user_id_foreign` (`user_id`),
  KEY `storeratings_store_id_foreign` (`store_id`),
  CONSTRAINT `storeratings_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `storeratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `storeratings`
--

LOCK TABLES `storeratings` WRITE;
/*!40000 ALTER TABLE `storeratings` DISABLE KEYS */;
/*!40000 ALTER TABLE `storeratings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stores`
--

DROP TABLE IF EXISTS `stores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stores` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hash` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `user_id` bigint unsigned NOT NULL,
  `logo` text COLLATE utf8mb4_unicode_ci,
  `primary_media` text COLLATE utf8mb4_unicode_ci,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` bigint unsigned DEFAULT NULL,
  `product_category_id` bigint unsigned DEFAULT NULL,
  `rating` int DEFAULT NULL,
  `background_image` text COLLATE utf8mb4_unicode_ci,
  `sound` text COLLATE utf8mb4_unicode_ci,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `volume` int NOT NULL DEFAULT '100',
  `views` int NOT NULL DEFAULT '0',
  `animation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance` double(8,2) NOT NULL DEFAULT '0.00',
  `state_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stores_user_id_foreign` (`user_id`),
  KEY `stores_category_id_foreign` (`category_id`),
  KEY `stores_product_category_id_foreign` (`product_category_id`),
  KEY `stores_state_id_foreign` (`state_id`),
  CONSTRAINT `stores_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `stores_product_category_id_foreign` FOREIGN KEY (`product_category_id`) REFERENCES `product_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `stores_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `stores_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stores`
--

LOCK TABLES `stores` WRITE;
/*!40000 ALTER TABLE `stores` DISABLE KEYS */;
INSERT INTO `stores` VALUES ('9db97681-b503-4156-852f-e8c2edff3f99','$2y$10$JQ6yC5Q5cdZ0ygUSrh5RiufbHxIeryKVV.1fsMMPA.SZNQquKNZvm','Prof. Lucious Hand Sr.','rstroman@yahoo.com','4414 Carlos Forest\nGeorgianamouth, WV 08425-1027','(208) 242-6972','Et nam veritatis est similique dolore inventore. Qui nobis omnis eum et dicta ullam. Voluptas omnis aspernatur voluptatem rerum quod quos velit. Possimus quam dolorem similique eveniet fugiat et.',1,NULL,NULL,NULL,NULL,1,4,NULL,NULL,NULL,NULL,100,0,NULL,0.00,1,'2024-12-14 16:53:47','2024-12-14 16:53:47'),('9db97682-4b2d-4e74-b282-02339b3165e2','$2y$10$lYGCmpbT9ADjlvR5ncbyRe3L1naGP0XEwNCrhjNGOiHxtftyPvJe','Mrs. Michele D\'Amore','weldon31@kuhlman.net','7358 Donna Unions Apt. 848\nCartwrightview, KS 22893','(470) 309-4289','Sapiente officia dolores debitis. Rerum quia fugit quibusdam ea iusto magnam temporibus labore. Vel autem dolorum aut animi voluptas. Ut architecto adipisci cumque iste id numquam.',1,NULL,NULL,NULL,NULL,1,4,NULL,NULL,NULL,NULL,100,0,NULL,0.00,1,'2024-12-14 16:53:47','2024-12-14 16:53:47'),('9db97682-db70-402d-a98b-f4525afd192e','$2y$10$ggploU0rpGj.wpse5yLokOP5LUGmzg.ic99FRlUdPqAjkOUFWsi','Dr. Willis Nolan','lnicolas@hickle.com','40892 Jany Parkways\nEast Warrentown, WV 73123-5929','+1.830.793.5448','Nostrum aperiam debitis qui dicta nisi. Excepturi nihil quo est. Neque ex error rerum vel velit.',1,NULL,NULL,NULL,NULL,1,4,NULL,NULL,NULL,NULL,100,0,NULL,0.00,1,'2024-12-14 16:53:47','2024-12-14 16:53:47'),('9db97683-4d81-4cf8-bf40-f047388409ab','$2y$10$UNRnuoA1TgOhXDYQ2mSLfu6sgGicbJEYAiQNsRztIn6pswzo62dOC','Jazmyn Stoltenberg','zula48@yahoo.com','771 Emiliano Unions Apt. 342\nRafaelabury, AZ 49240-3315','(872) 789-6525','Quas est nihil modi sed nihil quas. Occaecati excepturi aspernatur facere provident quod quibusdam. Blanditiis eligendi ea quaerat est iste voluptatum facilis.',1,NULL,NULL,NULL,NULL,1,4,NULL,NULL,NULL,NULL,100,0,NULL,0.00,1,'2024-12-14 16:53:48','2024-12-14 16:53:48'),('9db97683-b1b8-4166-bac1-1df6419e3140','$2y$10$K.13NnloRj87ec81BHOH2epeT3Co6dB5C0sSKlKpbjHAfcpYLCV1a','Prof. Mark Breitenberg','gsmith@gmail.com','1030 Boyle Stream\nLake Antonefurt, WA 18091-5338','(319) 241-1574','Vitae in vel distinctio ut maxime illo rerum. Quia laudantium sit et sit laudantium officia.',1,NULL,NULL,NULL,NULL,1,4,NULL,NULL,NULL,NULL,100,0,NULL,0.00,1,'2024-12-14 16:53:48','2024-12-14 16:53:48'),('9db97684-2b81-4f75-80cc-e79db2d7ce00','$2y$10$A9fTqWDtjVS3HFvbgKpDqe4gnNYCMFETpvwFCWGOgLplHByJh2','Eunice Fadel','kub.garfield@hotmail.com','23201 Halvorson Green Suite 480\nSouth Waylon, LA 55901-4304','+1.251.344.6980','Rerum necessitatibus numquam nostrum facilis velit qui nihil culpa. Dolores cum dicta molestias sapiente temporibus tenetur. Sed laboriosam id vel culpa est aut. Quia ut modi aperiam voluptates et.',1,NULL,NULL,NULL,NULL,1,4,NULL,NULL,NULL,NULL,100,0,NULL,0.00,1,'2024-12-14 16:53:48','2024-12-14 16:53:48'),('9db97684-8713-43b3-92d1-077ee8d746da','$2y$10$i2lAx5KkVWq223WYZsoCPerOMc28XGys5ex8XCHg3nfB2DHKxmBNC','Edwin Cremin','cleora44@hotmail.com','33495 Rogahn Station\nSouth Bryceberg, IL 21756-1051','+1.816.818.6082','Harum et voluptatem quia vel numquam et deleniti. Consequatur facere magnam quidem tempora rerum sit. Provident quo non fugiat quasi quod. Suscipit ut possimus neque explicabo consequatur omnis ut.',1,NULL,NULL,NULL,NULL,1,4,NULL,NULL,NULL,NULL,100,0,NULL,0.00,1,'2024-12-14 16:53:49','2024-12-14 16:53:49'),('9db97685-16dd-484a-a788-946ebcab8b44','$2y$10$gBLF70zhqvAgQ3dTJXGImOqXGlmh04nGjH4sXYxCbfQYXzCGDxM6K','Prof. Vernon Barrows','lysanne14@moen.com','1226 Ferry Drive Apt. 682\nNorth Eddie, KS 57449','+1-786-706-9883','Cupiditate ex dolores illo quidem quaerat id consectetur. Accusamus maiores enim sed. Error quod architecto similique voluptatem magnam non aut. Aut error qui voluptatem soluta.',1,NULL,NULL,NULL,NULL,1,4,NULL,NULL,NULL,NULL,100,0,NULL,0.00,1,'2024-12-14 16:53:49','2024-12-14 16:53:49'),('9db97685-8d1e-4013-bfde-885d98798fc2','$2y$10$Qpq8I32AwpWcXQVAMJDIoO9JpeavtIVH.wykphkqoXpZfUW7wewem','Mrs. Elta Spencer III','reagan.cormier@hotmail.com','822 Loren Villages Suite 773\nBraxtonhaven, WA 18944-9095','540-723-3473','Quae voluptas ullam distinctio neque quia nam occaecati. Eaque necessitatibus veniam qui qui maiores. Porro repellendus et commodi ut consequatur laudantium occaecati.',1,NULL,NULL,NULL,NULL,1,4,NULL,NULL,NULL,NULL,100,0,NULL,0.00,1,'2024-12-14 16:53:49','2024-12-14 16:53:49'),('9db97685-f942-4a84-8a45-8bb4936f26e3','$2y$10$GyTGApKVhvxiHTO2NpwkkOmtTjmeTmDvcKt702uplcF07Hi5YDB6O','Grace Howell','katheryn.murazik@hotmail.com','93131 Ivory Dale\nNew Loma, WY 88858','832-885-4312','Esse corporis nam beatae repellendus. Praesentium facere accusantium qui perspiciatis ut. Qui dolor velit vel eum omnis qui.',1,NULL,NULL,NULL,NULL,1,4,NULL,NULL,NULL,NULL,100,0,NULL,0.00,1,'2024-12-14 16:53:50','2024-12-14 16:53:50');
/*!40000 ALTER TABLE `stores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `storevideos`
--

DROP TABLE IF EXISTS `storevideos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `storevideos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `store_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `storevideos_store_id_foreign` (`store_id`),
  CONSTRAINT `storevideos_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `storevideos`
--

LOCK TABLES `storevideos` WRITE;
/*!40000 ALTER TABLE `storevideos` DISABLE KEYS */;
/*!40000 ALTER TABLE `storevideos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stories`
--

DROP TABLE IF EXISTS `stories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `store_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stories_store_id_foreign` (`store_id`),
  CONSTRAINT `stories_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stories`
--

LOCK TABLES `stories` WRITE;
/*!40000 ALTER TABLE `stories` DISABLE KEYS */;
/*!40000 ALTER TABLE `stories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscriptions`
--

DROP TABLE IF EXISTS `subscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subscriptions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `store_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tx_ref` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `plan_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subscriptions_store_id_foreign` (`store_id`),
  KEY `subscriptions_plan_id_foreign` (`plan_id`),
  CONSTRAINT `subscriptions_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `subscriptions_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscriptions`
--

LOCK TABLES `subscriptions` WRITE;
/*!40000 ALTER TABLE `subscriptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `subscriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tags` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tx_ref` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Order placed',
  `amount` double(8,2) NOT NULL DEFAULT '0.00',
  `settled` tinyint(1) NOT NULL DEFAULT '0',
  `delivery_address` text COLLATE utf8mb4_unicode_ci,
  `pickup_address` text COLLATE utf8mb4_unicode_ci,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transactions_user_id_foreign` (`user_id`),
  CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (1,'917.807.0298','+1 (458) 265-2296','Successful',0.00,0,NULL,NULL,1,'2024-12-14 16:53:56','2024-12-14 16:53:56'),(2,'+1 (470) 704-6744','1-847-459-2011','Successful',0.00,0,NULL,NULL,1,'2024-12-14 16:53:56','2024-12-14 16:53:56'),(3,'302-217-5602','+1 (614) 463-0482','Successful',0.00,0,NULL,NULL,1,'2024-12-14 16:53:56','2024-12-14 16:53:56'),(4,'+1 (914) 834-3548','(970) 314-2492','Successful',0.00,0,NULL,NULL,1,'2024-12-14 16:53:56','2024-12-14 16:53:56'),(5,'1-870-299-3953','+1-351-252-8760','Successful',0.00,0,NULL,NULL,1,'2024-12-14 16:53:57','2024-12-14 16:53:57');
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transfers`
--

DROP TABLE IF EXISTS `transfers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transfers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'nuban',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transfers_store_id_foreign` (`store_id`),
  CONSTRAINT `transfers_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transfers`
--

LOCK TABLES `transfers` WRITE;
/*!40000 ALTER TABLE `transfers` DISABLE KEYS */;
/*!40000 ALTER TABLE `transfers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `onames` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `usertype_id` bigint unsigned NOT NULL,
  `profilePic` text COLLATE utf8mb4_unicode_ci,
  `isVendor` tinyint(1) DEFAULT NULL,
  `isAdmin` tinyint(1) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isLogged` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state_id` bigint unsigned DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_usertype_id_foreign` (`usertype_id`),
  KEY `users_state_id_foreign` (`state_id`),
  CONSTRAINT `users_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `users_usertype_id_foreign` FOREIGN KEY (`usertype_id`) REFERENCES `usertypes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Prof. Zion Bode','Randall Ryan','Isaias Williamson','mina.larkin@example.net','1999-02-25','+1.385.799.6023','138 Schinner Garden Apt. 613\nWalterview, MO 16473',1,NULL,NULL,NULL,'2024-12-14 16:53:40','$2y$10$BGmCMgaoAzx41lWcOwet2esVFgsJa1ObY5hK8Zn9vBiM.9SZIUNI.',NULL,0,1,NULL,NULL,NULL,'bHALRQpIph','2024-12-14 16:53:40','2024-12-14 16:53:40'),(2,'Dr. Vesta Botsford','Dr. Violette Bechtelar','Dr. Chloe Kohler','florence.mitchell@example.com','1977-07-13','+1 (352) 235-3808','62234 Kelton Landing Suite 830\nLake Geraldfurt, IL 56818-5442',1,NULL,NULL,NULL,'2024-12-14 16:53:40','$2y$10$BGmCMgaoAzx41lWcOwet2esVFgsJa1ObY5hK8Zn9vBiM.9SZIUNI.',NULL,0,1,NULL,NULL,NULL,'Wcb2qmRBUp','2024-12-14 16:53:40','2024-12-14 16:53:40'),(3,'Samson Bode','Dr. Lucienne Morar II','Vincent Pollich','gusikowski.darrin@example.com','1975-07-13','803-933-8127','607 Kaci Track\nWest Zoila, MS 97823',1,NULL,NULL,NULL,'2024-12-14 16:53:40','$2y$10$BGmCMgaoAzx41lWcOwet2esVFgsJa1ObY5hK8Zn9vBiM.9SZIUNI.',NULL,0,1,NULL,NULL,NULL,'brGBc2hJUo','2024-12-14 16:53:41','2024-12-14 16:53:41'),(4,'Mr. Devan Homenick V','Prof. Cale Lebsack Sr.','Prof. Malvina Farrell II','natasha35@example.net','2020-02-01','601-571-3939','705 Matilda Divide Apt. 550\nKuphalbury, GA 32934',1,NULL,NULL,NULL,'2024-12-14 16:53:40','$2y$10$BGmCMgaoAzx41lWcOwet2esVFgsJa1ObY5hK8Zn9vBiM.9SZIUNI.',NULL,0,1,NULL,NULL,NULL,'LNDDYn90pr','2024-12-14 16:53:41','2024-12-14 16:53:41'),(5,'Dr. Jewell Reilly','Cristian Welch','Lucius Terry','ybode@example.com','1979-07-07','+1.678.618.6655','912 Moriah Road Suite 918\nWest Matildeberg, KY 05574-8098',1,NULL,NULL,NULL,'2024-12-14 16:53:40','$2y$10$BGmCMgaoAzx41lWcOwet2esVFgsJa1ObY5hK8Zn9vBiM.9SZIUNI.',NULL,0,1,NULL,NULL,NULL,'vCw6IQAIJb','2024-12-14 16:53:41','2024-12-14 16:53:41'),(6,'Kyleigh Hettinger III','Dr. Gaetano Satterfield','Mr. Sigurd Schowalter II','hunter37@example.net','1998-10-31','(908) 921-6071','27983 Houston Branch\nBlandamouth, WV 28903-8477',1,NULL,NULL,NULL,'2024-12-14 16:53:40','$2y$10$BGmCMgaoAzx41lWcOwet2esVFgsJa1ObY5hK8Zn9vBiM.9SZIUNI.',NULL,0,1,NULL,NULL,NULL,'rIdGXSW3FN','2024-12-14 16:53:41','2024-12-14 16:53:41'),(7,'Joany Brakus','Luella Schaefer','Mr. Geovanny Bailey','dickens.berneice@example.com','2009-02-18','580.776.0437','192 Herman Expressway Suite 674\nWest Joany, MD 52983-5491',1,NULL,NULL,NULL,'2024-12-14 16:53:40','$2y$10$BGmCMgaoAzx41lWcOwet2esVFgsJa1ObY5hK8Zn9vBiM.9SZIUNI.',NULL,0,1,NULL,NULL,NULL,'OtlIDv3Y76','2024-12-14 16:53:41','2024-12-14 16:53:41'),(8,'Wilburn Moen','Susana Boyer III','Stone Klocko DDS','herzog.malvina@example.net','2004-09-07','347-432-5341','8428 Quinten Locks\nRueckerberg, HI 12787',1,NULL,NULL,NULL,'2024-12-14 16:53:40','$2y$10$BGmCMgaoAzx41lWcOwet2esVFgsJa1ObY5hK8Zn9vBiM.9SZIUNI.',NULL,0,1,NULL,NULL,NULL,'3NlvXANvkh','2024-12-14 16:53:41','2024-12-14 16:53:41'),(9,'Ahmed Okuneva','Marques Kunde','Marcus Ortiz','emery.larkin@example.net','1982-10-17','1-862-696-5027','20018 Walsh Park Suite 217\nChadberg, HI 88723',1,NULL,NULL,NULL,'2024-12-14 16:53:40','$2y$10$BGmCMgaoAzx41lWcOwet2esVFgsJa1ObY5hK8Zn9vBiM.9SZIUNI.',NULL,0,1,NULL,NULL,NULL,'LFaabEhS7n','2024-12-14 16:53:42','2024-12-14 16:53:42'),(10,'Prof. Davonte Hodkiewicz','Dr. Jairo Gutmann Jr.','Emil Satterfield','miller.ephraim@example.org','1995-05-16','(714) 690-5785','61046 Alanis Cliffs Apt. 998\nPort Laurenmouth, KS 36418',1,NULL,NULL,NULL,'2024-12-14 16:53:40','$2y$10$BGmCMgaoAzx41lWcOwet2esVFgsJa1ObY5hK8Zn9vBiM.9SZIUNI.',NULL,0,1,NULL,NULL,NULL,'wZnXnbBcS5','2024-12-14 16:53:42','2024-12-14 16:53:42');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usertypes`
--

DROP TABLE IF EXISTS `usertypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usertypes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usertypes`
--

LOCK TABLES `usertypes` WRITE;
/*!40000 ALTER TABLE `usertypes` DISABLE KEYS */;
INSERT INTO `usertypes` VALUES (1,'Customer','Default Customer','2024-12-14 16:53:39','2024-12-14 16:53:39'),(2,'Vendor Administrator','Vendor - Manager of a store','2024-12-14 16:53:39','2024-12-14 16:53:39'),(3,'Vendor','Vendor - Owner and manager of a store','2024-12-14 16:53:39','2024-12-14 16:53:39'),(4,'Administrator','Entire application administrator','2024-12-14 16:53:40','2024-12-14 16:53:40');
/*!40000 ALTER TABLE `usertypes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-14 18:55:01
