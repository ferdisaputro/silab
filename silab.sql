/*!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.8-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: silab
-- ------------------------------------------------------
-- Server version	10.11.8-MariaDB-0ubuntu0.24.04.1

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
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
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
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2019_12_14_000001_create_personal_access_tokens_table',1),
(5,'2022_04_12_045912_add_googleid_avatar_role_to_users_table',1),
(6,'2022_04_14_023042_create_permission_tables',2),
(8,'2022_04_14_055432_create_staff_table',3),
(10,'2022_04_20_033342_tabel_jurusan_prodi_m_k_semester',4),
(11,'2022_05_24_040544_pengajuan',5),
(12,'2022_05_31_065909_add_column_tahun_ajaran',6),
(13,'2022_07_03_021650_detail_usulan_kebutuhan',7),
(14,'2022_07_03_024144_add_fk_detail_usulan_kebutuhan',8),
(15,'2022_08_20_054022_table_frm005',9),
(16,'2022_08_20_092747_table_frm001',10),
(17,'2022_08_20_121028_add_kode_table_frm005',11),
(19,'2022_08_20_125811_modif_staff',12);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES
(1,'App\\Models\\User',1),
(1,'App\\Models\\User',96),
(1,'App\\Models\\User',97),
(1,'App\\Models\\User',112),
(2,'App\\Models\\User',4),
(2,'App\\Models\\User',5),
(2,'App\\Models\\User',6),
(2,'App\\Models\\User',7),
(2,'App\\Models\\User',8),
(2,'App\\Models\\User',9),
(2,'App\\Models\\User',10),
(2,'App\\Models\\User',12),
(2,'App\\Models\\User',13),
(2,'App\\Models\\User',14),
(2,'App\\Models\\User',15),
(2,'App\\Models\\User',16),
(2,'App\\Models\\User',17),
(2,'App\\Models\\User',18),
(2,'App\\Models\\User',19),
(2,'App\\Models\\User',20),
(2,'App\\Models\\User',21),
(2,'App\\Models\\User',22),
(2,'App\\Models\\User',23),
(2,'App\\Models\\User',24),
(2,'App\\Models\\User',25),
(2,'App\\Models\\User',26),
(2,'App\\Models\\User',28),
(2,'App\\Models\\User',29),
(2,'App\\Models\\User',30),
(2,'App\\Models\\User',31),
(2,'App\\Models\\User',32),
(2,'App\\Models\\User',33),
(2,'App\\Models\\User',34),
(2,'App\\Models\\User',35),
(2,'App\\Models\\User',36),
(2,'App\\Models\\User',37),
(2,'App\\Models\\User',38),
(2,'App\\Models\\User',39),
(2,'App\\Models\\User',40),
(2,'App\\Models\\User',41),
(2,'App\\Models\\User',42),
(2,'App\\Models\\User',43),
(2,'App\\Models\\User',44),
(2,'App\\Models\\User',45),
(2,'App\\Models\\User',46),
(2,'App\\Models\\User',47),
(2,'App\\Models\\User',48),
(2,'App\\Models\\User',49),
(2,'App\\Models\\User',50),
(2,'App\\Models\\User',51),
(2,'App\\Models\\User',52),
(2,'App\\Models\\User',53),
(2,'App\\Models\\User',54),
(2,'App\\Models\\User',55),
(2,'App\\Models\\User',56),
(2,'App\\Models\\User',57),
(2,'App\\Models\\User',58),
(2,'App\\Models\\User',59),
(2,'App\\Models\\User',60),
(2,'App\\Models\\User',61),
(2,'App\\Models\\User',62),
(2,'App\\Models\\User',63),
(2,'App\\Models\\User',64),
(2,'App\\Models\\User',65),
(2,'App\\Models\\User',66),
(2,'App\\Models\\User',67),
(2,'App\\Models\\User',68),
(2,'App\\Models\\User',69),
(2,'App\\Models\\User',70),
(2,'App\\Models\\User',71),
(2,'App\\Models\\User',72),
(2,'App\\Models\\User',73),
(2,'App\\Models\\User',74),
(2,'App\\Models\\User',75),
(2,'App\\Models\\User',76),
(2,'App\\Models\\User',77),
(2,'App\\Models\\User',78),
(2,'App\\Models\\User',79),
(2,'App\\Models\\User',80),
(2,'App\\Models\\User',81),
(2,'App\\Models\\User',82),
(2,'App\\Models\\User',83),
(2,'App\\Models\\User',84),
(2,'App\\Models\\User',85),
(2,'App\\Models\\User',86),
(2,'App\\Models\\User',87),
(2,'App\\Models\\User',88),
(4,'App\\Models\\User',91),
(4,'App\\Models\\User',92),
(4,'App\\Models\\User',95),
(4,'App\\Models\\User',98),
(4,'App\\Models\\User',99),
(4,'App\\Models\\User',100),
(4,'App\\Models\\User',101),
(4,'App\\Models\\User',102),
(4,'App\\Models\\User',103),
(4,'App\\Models\\User',104),
(4,'App\\Models\\User',105),
(4,'App\\Models\\User',106),
(4,'App\\Models\\User',107),
(4,'App\\Models\\User',108),
(4,'App\\Models\\User',109),
(4,'App\\Models\\User',110),
(4,'App\\Models\\User',111),
(4,'App\\Models\\User',113),
(4,'App\\Models\\User',114),
(4,'App\\Models\\User',115),
(4,'App\\Models\\User',116),
(4,'App\\Models\\User',117),
(4,'App\\Models\\User',118),
(4,'App\\Models\\User',119),
(4,'App\\Models\\User',120),
(5,'App\\Models\\User',89),
(6,'App\\Models\\User',11),
(7,'App\\Models\\User',27);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES
('appredo@polije.ac.id','$2y$10$64JsJJ/2.6yh0jWteL5foevjM2SQ1Zya3YCQz1KkijvopbFXrZCm.','2022-10-10 07:07:34');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES
(1,'staff-list','web','2022-04-18 05:21:55','2022-04-18 05:51:25'),
(2,'staff-create','web','2022-04-18 05:21:55','2022-04-18 05:50:39'),
(3,'staff-edit','web','2022-04-18 05:21:55','2022-04-18 05:21:55'),
(4,'staff-delete','web','2022-04-18 05:21:55','2022-04-18 05:21:55'),
(7,'jurusan-list','web','2022-04-25 01:42:33','2022-04-25 01:42:33'),
(8,'jurusan-create','web','2022-04-25 01:42:33','2022-04-25 01:42:33'),
(9,'jurusan-edit','web','2022-04-25 01:42:33','2022-04-25 01:42:33'),
(10,'jurusan-delete','web','2022-04-25 01:42:33','2022-04-25 01:42:33'),
(11,'all-staff-list','web','2022-04-26 04:05:53','2022-04-26 04:05:53'),
(12,'set-staff-role','web','2022-04-26 04:05:53','2022-04-26 04:05:53'),
(13,'matakuliah-list','web','2022-04-26 05:29:08','2022-04-26 05:29:08'),
(14,'matakuliah-create','web','2022-04-26 05:29:08','2022-04-26 05:29:08'),
(15,'matakuliah-edit','web','2022-04-26 05:29:08','2022-04-26 05:29:08'),
(16,'matakuliah-delete','web','2022-04-26 05:29:08','2022-04-26 05:29:08'),
(17,'prodi-list','web','2022-05-01 09:19:01','2022-05-01 09:19:01'),
(18,'prodi-create','web','2022-05-01 09:19:01','2022-05-01 09:19:01'),
(19,'prodi-edit','web','2022-05-01 09:19:01','2022-05-01 09:19:01'),
(20,'prodi-delete','web','2022-05-01 09:19:02','2022-05-01 09:19:02'),
(21,'semester-list','web','2022-05-10 04:23:37','2022-05-10 04:23:37'),
(22,'semester-create','web','2022-05-10 04:23:37','2022-05-10 04:23:37'),
(23,'semester-edit','web','2022-05-10 04:23:37','2022-05-10 04:23:37'),
(24,'semester-delete','web','2022-05-10 04:23:37','2022-05-10 04:23:37'),
(25,'setmatakuliah-list','web','2022-05-12 02:55:57','2022-05-12 02:55:57'),
(26,'setmatakuliah-create','web','2022-05-12 02:55:57','2022-05-12 02:55:57'),
(27,'setpengampu-list','web','2022-05-12 05:35:57','2022-05-12 05:35:57'),
(28,'setpengampu-create','web','2022-05-12 05:35:57','2022-05-12 05:35:57'),
(29,'permission-list','web','2022-05-13 07:54:48','2022-05-13 07:54:48'),
(30,'permission-create','web','2022-05-13 07:54:48','2022-05-13 07:54:48'),
(31,'permission-edit','web','2022-05-13 07:54:48','2022-05-13 07:54:48'),
(32,'permission-delete','web','2022-05-13 07:54:48','2022-05-13 07:54:48'),
(33,'role-list','web','2022-05-13 07:54:48','2022-05-13 07:54:48'),
(34,'role-create','web','2022-05-13 07:54:48','2022-05-13 07:54:48'),
(35,'role-edit','web','2022-05-13 07:54:48','2022-05-13 07:54:48'),
(36,'role-delete','web','2022-05-13 07:54:48','2022-05-13 07:54:48'),
(37,'pengajuan-alat-bahan-list','web','2022-05-17 11:18:33','2022-06-17 05:47:18'),
(38,'tahunajaran-list','web','2022-05-31 04:00:18','2022-05-31 04:00:18'),
(39,'tahunajaran-create','web','2022-05-31 04:00:18','2022-05-31 04:00:18'),
(40,'tahunajaran-edit','web','2022-05-31 04:00:18','2022-05-31 04:00:18'),
(41,'tahunajaran-delete','web','2022-05-31 04:00:18','2022-05-31 04:00:18'),
(42,'minggu-list','web','2022-06-01 08:20:55','2022-06-01 08:20:55'),
(43,'minggu-create','web','2022-06-01 08:20:55','2022-06-01 08:20:55'),
(44,'minggu-edit','web','2022-06-01 08:20:56','2022-06-01 08:20:56'),
(45,'minggu-delete','web','2022-06-01 08:20:56','2022-06-01 08:20:56'),
(46,'pengajuan-alat-bahan-create','web','2022-06-17 03:24:14','2022-06-17 03:24:14'),
(47,'pengajuan-alat-bahan-edit','web','2022-06-17 03:24:14','2022-06-17 03:24:14'),
(48,'pengajuan-alat-bahan-delete','web','2022-06-17 03:24:15','2022-06-17 03:24:15'),
(49,'satuan-list','web','2022-06-20 04:20:01','2022-06-20 04:20:01'),
(50,'satuan-create','web','2022-06-20 04:20:01','2022-06-20 04:20:01'),
(51,'satuan-edit','web','2022-06-20 04:20:01','2022-06-20 04:20:01'),
(52,'satuan-delete','web','2022-06-20 04:20:01','2022-06-20 04:20:01'),
(53,'barang-list','web','2022-06-22 02:54:26','2022-06-22 02:54:26'),
(54,'barang-create','web','2022-06-22 02:54:26','2022-06-22 02:54:26'),
(55,'barang-edit','web','2022-06-22 02:54:26','2022-06-22 02:54:26'),
(56,'barang-delete','web','2022-06-22 02:54:26','2022-06-22 02:54:26'),
(57,'review-pangajuan-alat-edit','web','2022-08-11 15:13:58','2022-08-11 15:22:52'),
(58,'review-pangajuan-alat-cetak','web','2022-08-11 15:14:41','2022-08-11 15:14:41'),
(59,'review-pangajuan-alat-list','web','2022-08-11 15:21:28','2022-08-11 15:21:28'),
(61,'review-pangajuan-alat-show','web','2022-08-17 18:05:57','2022-08-17 18:05:57'),
(62,'penggantian-praktek-create','web','2022-08-19 09:03:55','2022-08-19 09:03:55'),
(63,'lab-list','web','2022-08-20 17:14:04','2022-08-20 17:14:04'),
(64,'lab-edit','web','2022-08-20 17:14:05','2022-08-20 17:14:05'),
(65,'lab-create','web','2022-08-20 17:14:05','2022-08-20 17:14:05'),
(66,'lab-delete','web','2022-08-20 17:14:05','2022-08-20 17:14:05'),
(67,'memberlab-create','web','2022-08-20 19:20:42','2022-08-20 19:20:42'),
(68,'deliver-pangajuan-alat-list','web','2022-08-21 14:43:42','2022-08-21 14:43:42'),
(69,'stok-in-pengadaan-list','web','2022-08-22 17:02:36','2022-08-22 17:04:01'),
(70,'stok-in-pengadaan-edit','web','2022-08-22 17:49:39','2022-08-22 17:49:39'),
(71,'inventaris-bahan-list','web','2022-08-23 19:08:01','2022-08-23 19:08:01'),
(72,'inventaris-bahan-cetak','web','2022-08-23 19:08:24','2022-08-23 19:08:24'),
(73,'inventaris-kartu-stok','web','2022-08-23 19:09:03','2022-08-23 19:09:03'),
(75,'penggantian-praktek-list','web','2022-08-24 05:21:57','2022-09-12 09:43:51'),
(76,'kesiapan-praktek-list','web','2022-08-25 12:55:35','2022-08-25 12:55:35'),
(77,'kesiapan-praktek-create','web','2022-08-25 12:55:37','2022-08-25 12:55:37'),
(78,'kesiapan-praktek-edit','web','2022-08-25 12:55:39','2022-08-25 12:55:39'),
(79,'kesiapan-praktek-delete','web','2022-08-25 12:55:41','2022-08-25 12:55:41'),
(80,'bonalat-list','web','2022-08-27 18:31:06','2022-08-27 18:31:09'),
(81,'bonalat-edit','web','2022-08-27 18:31:19','2022-08-27 18:31:20'),
(82,'bonalat-create','web','2022-08-27 18:31:37','2022-08-27 18:31:37'),
(83,'bonalat-delete','web','2022-08-27 18:31:51','2022-08-27 18:31:51'),
(84,'inventaris-alat-list','web','2022-08-28 19:18:33','2022-08-28 19:18:34'),
(85,'inventaris-alat-create','web','2022-08-28 19:18:49','2022-08-28 19:18:50'),
(86,'inventaris-alat-edit','web','2022-08-28 19:19:03','2022-08-28 19:19:04'),
(87,'inventaris-alat-delete','web','2022-08-28 19:19:19','2022-08-28 19:19:20'),
(88,'penggantian-praktek-delete','web','2022-09-12 09:47:07','2022-09-12 09:47:07'),
(89,'penggantian-praktek-edit','web','2022-09-12 09:47:07','2022-09-12 09:47:07'),
(94,'kehilangan-list','web','2022-09-13 06:22:16','2022-09-13 06:22:16'),
(95,'kehilangan-create','web','2022-09-13 06:22:19','2022-09-13 06:22:19'),
(96,'kehilangan-edit','web','2022-09-13 06:22:20','2022-09-13 06:22:20'),
(97,'kehilangan-delete','web','2022-09-13 06:22:22','2022-09-13 06:22:22'),
(98,'serma-list','web','2022-09-14 14:07:20','2022-09-14 14:07:20'),
(99,'serma-edit','web','2022-09-14 14:07:21','2022-09-14 14:07:21'),
(100,'serma-create','web','2022-09-14 14:07:21','2022-09-14 14:07:21'),
(101,'serma-delete','web','2022-09-14 14:07:21','2022-09-14 14:07:21'),
(102,'ijinLBS-list','web','2022-09-20 08:46:33','2022-09-20 08:46:33'),
(103,'ijinLBS-create','web','2022-09-20 08:46:44','2022-09-20 08:46:44'),
(104,'ijinLBS-edit','web','2022-09-20 08:46:52','2022-09-20 08:46:52'),
(105,'ijinLBS-delete','web','2022-09-20 08:47:00','2022-09-20 08:47:01'),
(106,'inventaris-bahan-create','web','2022-10-02 15:58:23','2022-10-02 15:58:23'),
(107,'inventaris-bahan-edit','web','2022-10-02 15:58:25','2022-10-02 15:58:25'),
(108,'dashboard-all-lab','web','2022-10-09 11:31:27','2022-10-09 11:31:27'),
(109,'dashboard-lab','web','2022-10-10 01:52:08','2022-10-10 01:52:08');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
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

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES
(1,1),
(2,1),
(3,1),
(3,2),
(3,4),
(3,6),
(3,7),
(4,1),
(7,1),
(8,1),
(9,1),
(10,1),
(11,1),
(12,1),
(13,1),
(14,1),
(15,1),
(16,1),
(17,1),
(18,1),
(19,1),
(20,1),
(21,1),
(22,1),
(23,1),
(24,1),
(25,1),
(25,2),
(26,1),
(27,1),
(27,2),
(28,1),
(29,1),
(30,1),
(31,1),
(32,1),
(33,1),
(34,1),
(35,1),
(36,1),
(37,1),
(37,2),
(37,6),
(37,7),
(38,1),
(39,1),
(40,1),
(41,1),
(42,1),
(43,1),
(44,1),
(45,1),
(46,1),
(46,2),
(46,6),
(46,7),
(47,1),
(47,2),
(47,6),
(47,7),
(48,1),
(48,6),
(48,7),
(49,1),
(50,1),
(51,1),
(52,1),
(53,1),
(54,1),
(55,1),
(56,1),
(57,1),
(57,3),
(57,5),
(58,1),
(58,3),
(58,5),
(59,1),
(59,3),
(59,5),
(61,1),
(61,3),
(61,5),
(62,1),
(62,4),
(62,5),
(63,1),
(64,1),
(65,1),
(66,1),
(67,1),
(68,1),
(68,3),
(68,5),
(69,1),
(69,4),
(69,5),
(69,7),
(70,1),
(70,4),
(70,5),
(70,7),
(71,1),
(71,4),
(71,5),
(71,7),
(72,1),
(72,4),
(72,5),
(72,7),
(73,1),
(73,4),
(73,5),
(73,7),
(75,1),
(75,4),
(75,5),
(75,7),
(76,1),
(76,4),
(76,5),
(76,7),
(77,1),
(77,4),
(77,5),
(77,7),
(78,1),
(78,4),
(78,5),
(78,7),
(79,1),
(79,4),
(79,5),
(79,7),
(80,1),
(80,4),
(80,5),
(80,7),
(81,1),
(81,4),
(81,5),
(81,7),
(82,1),
(82,4),
(82,5),
(82,7),
(83,1),
(83,4),
(83,5),
(83,7),
(84,1),
(84,4),
(84,5),
(84,7),
(85,1),
(85,4),
(85,5),
(85,7),
(86,1),
(86,4),
(86,5),
(86,7),
(87,1),
(87,4),
(87,5),
(87,7),
(88,1),
(88,4),
(88,5),
(88,7),
(89,1),
(89,4),
(89,5),
(89,7),
(94,1),
(94,4),
(94,5),
(94,7),
(95,1),
(95,4),
(95,5),
(95,7),
(96,1),
(96,4),
(96,5),
(96,7),
(97,1),
(97,4),
(97,5),
(97,7),
(98,1),
(98,4),
(98,5),
(98,7),
(99,1),
(99,4),
(99,5),
(99,7),
(100,1),
(100,4),
(100,5),
(100,7),
(101,1),
(101,4),
(101,5),
(101,7),
(102,1),
(102,4),
(102,5),
(102,7),
(103,1),
(103,4),
(103,5),
(103,7),
(104,1),
(104,4),
(104,5),
(104,7),
(105,1),
(105,4),
(105,5),
(105,7),
(106,1),
(106,4),
(106,5),
(106,7),
(107,1),
(107,4),
(107,5),
(107,7),
(108,1),
(108,6),
(109,1),
(109,6),
(109,7);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES
(1,'Administrator','web','2022-04-17 16:05:58','2022-04-17 16:05:58'),
(2,'Koordinator Matakuliah','web','2022-05-13 02:35:01','2022-05-13 02:35:01'),
(3,'Tim Pengadaan','web','2022-08-11 15:16:27','2022-08-11 15:16:27'),
(4,'Teknisi','web','2022-08-19 09:02:51','2022-08-19 09:02:51'),
(5,'Teknisi & Tim Pengadaan','web','2022-09-30 09:14:57','2022-09-30 09:14:57'),
(6,'Manajemen Jurusan','web','2022-10-10 01:40:30','2022-10-10 03:13:46'),
(7,'Kepala Laboratorium','web','2022-10-10 02:02:30','2022-10-10 02:02:30');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `td_bon_alat_detail`
--

DROP TABLE IF EXISTS `td_bon_alat_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `td_bon_alat_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(32) DEFAULT NULL,
  `jumlah` int(10) unsigned NOT NULL,
  `tr_bon_alat_id` int(10) unsigned NOT NULL,
  `tr_barang_laboratorium_id` int(10) unsigned NOT NULL,
  `tr_kartu_stok_id` int(10) unsigned DEFAULT NULL,
  `tr_kartu_stok_id_kembali` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jumlah_kembali` smallint(5) unsigned DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `status` tinyint(3) unsigned DEFAULT NULL COMMENT '0 = > Tidak Lengkap, 1 =>lengkap',
  PRIMARY KEY (`id`),
  KEY `td_bon_alat_detail_tr_bon_alat_id_foreign` (`tr_bon_alat_id`),
  KEY `td_bon_alat_detail_tr_barang_laboratorium_id_foreign` (`tr_barang_laboratorium_id`),
  KEY `td_bon_alat_detail_tr_kartu_stok_id_foreign` (`tr_kartu_stok_id`),
  CONSTRAINT `td_bon_alat_detail_tr_barang_laboratorium_id_foreign` FOREIGN KEY (`tr_barang_laboratorium_id`) REFERENCES `tr_barang_laboratorium` (`id`) ON DELETE CASCADE,
  CONSTRAINT `td_bon_alat_detail_tr_bon_alat_id_foreign` FOREIGN KEY (`tr_bon_alat_id`) REFERENCES `tr_bon_alat` (`id`) ON DELETE CASCADE,
  CONSTRAINT `td_bon_alat_detail_tr_kartu_stok_id_foreign` FOREIGN KEY (`tr_kartu_stok_id`) REFERENCES `tr_kartu_stok` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `td_bon_alat_detail`
--

LOCK TABLES `td_bon_alat_detail` WRITE;
/*!40000 ALTER TABLE `td_bon_alat_detail` DISABLE KEYS */;
INSERT INTO `td_bon_alat_detail` VALUES
(34,NULL,4,22,64,297,NULL,'2022-10-18 06:38:58','2022-10-18 06:38:58',NULL,NULL,NULL),
(35,NULL,2,22,65,298,NULL,'2022-10-18 06:38:58','2022-10-18 06:38:58',NULL,NULL,NULL),
(36,NULL,1,23,42,299,300,'2022-10-18 06:39:31','2022-10-18 07:02:20',1,'',1),
(38,NULL,1,25,71,309,310,'2022-11-15 08:14:55','2022-11-15 08:21:58',1,'',1),
(41,NULL,1,28,71,321,328,'2022-11-24 09:45:16','2022-11-24 12:11:02',1,'-',1),
(42,NULL,1,29,71,329,330,'2022-11-24 12:15:03','2022-11-24 12:16:00',1,'-',1),
(43,NULL,12,30,80,367,369,'2024-06-13 02:44:01','2024-06-13 02:45:09',12,'dah dikembalikan',1),
(44,NULL,12,30,84,368,370,'2024-06-13 02:44:01','2024-06-13 02:45:09',12,'dah dikembalikan',1),
(45,NULL,13,31,80,371,NULL,'2024-06-13 02:47:04','2024-06-13 02:47:04',NULL,'pinjam dulu seratus',NULL);
/*!40000 ALTER TABLE `td_bon_alat_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `td_hasil_praktek`
--

DROP TABLE IF EXISTS `td_hasil_praktek`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `td_hasil_praktek` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(32) DEFAULT NULL,
  `jumlah` int(255) unsigned NOT NULL,
  `tr_barang_laboratorium_id` int(255) unsigned NOT NULL,
  `tr_serma_hasil_sisa_praktek_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tr_kartu_stok_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `td_hasil_praktek_tr_serma_hasil_sisa_praktek_id_foreign` (`tr_serma_hasil_sisa_praktek_id`),
  CONSTRAINT `td_hasil_praktek_tr_serma_hasil_sisa_praktek_id_foreign` FOREIGN KEY (`tr_serma_hasil_sisa_praktek_id`) REFERENCES `tr_serma_hasil_sisa_praktek` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `td_hasil_praktek`
--

LOCK TABLES `td_hasil_praktek` WRITE;
/*!40000 ALTER TABLE `td_hasil_praktek` DISABLE KEYS */;
INSERT INTO `td_hasil_praktek` VALUES
(2,NULL,1,72,4,'2022-11-24 03:45:11','2022-11-24 03:45:11',318),
(3,NULL,5,72,5,'2022-11-24 11:45:40','2022-11-24 11:45:40',327),
(4,NULL,12,86,6,'2024-06-13 02:52:37','2024-06-13 02:52:37',375);
/*!40000 ALTER TABLE `td_hasil_praktek` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `td_hilang_rusak_detail`
--

DROP TABLE IF EXISTS `td_hilang_rusak_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `td_hilang_rusak_detail` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(32) DEFAULT NULL,
  `tr_barang_laboratorium_id` int(10) unsigned NOT NULL,
  `tr_hilang_rusak_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `jumlah_hilang_rusak` int(10) unsigned NOT NULL,
  `status` tinyint(3) unsigned DEFAULT 0,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `td_hilang_rusak_detail_tr_barang_laboratorium_id_foreign` (`tr_barang_laboratorium_id`),
  KEY `td_hilang_rusak_detail_tr_hilang_rusak_id_foreign` (`tr_hilang_rusak_id`),
  CONSTRAINT `td_hilang_rusak_detail_tr_barang_laboratorium_id_foreign` FOREIGN KEY (`tr_barang_laboratorium_id`) REFERENCES `tr_barang_laboratorium` (`id`) ON DELETE CASCADE,
  CONSTRAINT `td_hilang_rusak_detail_tr_hilang_rusak_id_foreign` FOREIGN KEY (`tr_hilang_rusak_id`) REFERENCES `tr_hilang_rusak` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `td_hilang_rusak_detail`
--

LOCK TABLES `td_hilang_rusak_detail` WRITE;
/*!40000 ALTER TABLE `td_hilang_rusak_detail` DISABLE KEYS */;
INSERT INTO `td_hilang_rusak_detail` VALUES
(1,NULL,71,1,'2022-11-21 04:26:26',1,1,'2022-11-21 04:29:29'),
(3,NULL,71,3,'2022-11-24 11:35:07',1,1,'2022-11-24 11:36:22'),
(4,NULL,80,5,'2024-06-13 02:49:37',1000,1,'2024-06-13 02:49:51');
/*!40000 ALTER TABLE `td_hilang_rusak_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `td_ijin_penggunaan_lbs_detail`
--

DROP TABLE IF EXISTS `td_ijin_penggunaan_lbs_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `td_ijin_penggunaan_lbs_detail` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(32) DEFAULT NULL,
  `jumlah` int(10) unsigned NOT NULL,
  `tr_ijin_penggunaan_lbs_id` int(10) unsigned NOT NULL,
  `tr_barang_laboratorium_id` int(10) unsigned NOT NULL,
  `tr_kartu_stok_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `td_satuan_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `td_ijin_penggunaan_lbs_detail_tr_ijin_penggunaan_lbs_id_foreign` (`tr_ijin_penggunaan_lbs_id`),
  KEY `td_ijin_penggunaan_lbs_detail_tr_barang_laboratorium_id_foreign` (`tr_barang_laboratorium_id`),
  KEY `td_ijin_penggunaan_lbs_detail_tr_kartu_stok_id_foreign` (`tr_kartu_stok_id`),
  CONSTRAINT `td_ijin_penggunaan_lbs_detail_tr_barang_laboratorium_id_foreign` FOREIGN KEY (`tr_barang_laboratorium_id`) REFERENCES `tr_barang_laboratorium` (`id`) ON DELETE CASCADE,
  CONSTRAINT `td_ijin_penggunaan_lbs_detail_tr_ijin_penggunaan_lbs_id_foreign` FOREIGN KEY (`tr_ijin_penggunaan_lbs_id`) REFERENCES `tr_ijin_penggunaan_lbs` (`id`) ON DELETE CASCADE,
  CONSTRAINT `td_ijin_penggunaan_lbs_detail_tr_kartu_stok_id_foreign` FOREIGN KEY (`tr_kartu_stok_id`) REFERENCES `tr_kartu_stok` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `td_ijin_penggunaan_lbs_detail`
--

LOCK TABLES `td_ijin_penggunaan_lbs_detail` WRITE;
/*!40000 ALTER TABLE `td_ijin_penggunaan_lbs_detail` DISABLE KEYS */;
INSERT INTO `td_ijin_penggunaan_lbs_detail` VALUES
(1,NULL,1,1,73,332,'2023-03-09 01:27:02','2023-03-09 01:27:02',NULL,75),
(2,NULL,24000,3,74,376,'2024-06-13 02:55:00','2024-06-13 02:55:00','pinjam dulu seratus',21);
/*!40000 ALTER TABLE `td_ijin_penggunaan_lbs_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `td_kesiapan_praktek_detail`
--

DROP TABLE IF EXISTS `td_kesiapan_praktek_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `td_kesiapan_praktek_detail` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tr_barang_laboratorium_id` int(10) unsigned NOT NULL,
  `tr_kesiapan_praktek_id` int(10) unsigned NOT NULL,
  `jumlah` int(10) unsigned DEFAULT 0,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kode` varchar(32) DEFAULT NULL,
  `tr_kartu_stok_id` int(10) unsigned DEFAULT NULL,
  `td_satuan_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `td_kesiapan_praktek_detail_tr_barang_laboratorium_id_foreign` (`tr_barang_laboratorium_id`),
  KEY `td_kesiapan_praktek_detail_tr_kesiapan_praktek_id_foreign` (`tr_kesiapan_praktek_id`),
  CONSTRAINT `td_kesiapan_praktek_detail_tr_barang_laboratorium_id_foreign` FOREIGN KEY (`tr_barang_laboratorium_id`) REFERENCES `tr_barang_laboratorium` (`id`) ON DELETE CASCADE,
  CONSTRAINT `td_kesiapan_praktek_detail_tr_kesiapan_praktek_id_foreign` FOREIGN KEY (`tr_kesiapan_praktek_id`) REFERENCES `tr_kesiapan_praktek` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `td_kesiapan_praktek_detail`
--

LOCK TABLES `td_kesiapan_praktek_detail` WRITE;
/*!40000 ALTER TABLE `td_kesiapan_praktek_detail` DISABLE KEYS */;
INSERT INTO `td_kesiapan_praktek_detail` VALUES
(10,67,7,10,'siap','2024-06-13 02:41:47','2024-06-13 02:41:47',NULL,365,73),
(11,74,7,500,'siap','2024-06-13 02:41:47','2024-06-13 02:41:47',NULL,366,21);
/*!40000 ALTER TABLE `td_kesiapan_praktek_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `td_satuan`
--

DROP TABLE IF EXISTS `td_satuan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `td_satuan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `qty` int(10) unsigned DEFAULT NULL,
  `tm_satuan_id` smallint(5) unsigned DEFAULT NULL,
  `tm_barang_id` int(10) unsigned DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `td_satuan_user_id_foreign` (`user_id`),
  KEY `td_satuan_tm_satuan_id_foreign` (`tm_satuan_id`),
  KEY `td_satuan_tm_barang_id_foreign` (`tm_barang_id`),
  CONSTRAINT `td_satuan_tm_barang_id_foreign` FOREIGN KEY (`tm_barang_id`) REFERENCES `tm_barang` (`id`) ON DELETE SET NULL,
  CONSTRAINT `td_satuan_tm_satuan_id_foreign` FOREIGN KEY (`tm_satuan_id`) REFERENCES `tm_satuan` (`id`) ON DELETE SET NULL,
  CONSTRAINT `td_satuan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `td_satuan`
--

LOCK TABLES `td_satuan` WRITE;
/*!40000 ALTER TABLE `td_satuan` DISABLE KEYS */;
INSERT INTO `td_satuan` VALUES
(1,500,2,1,1,'2022-06-30 15:28:01','2022-08-19 07:59:33'),
(2,2500,3,1,1,'2022-06-30 15:28:01','2022-06-30 15:28:01'),
(7,500,2,2,1,'2022-07-02 04:35:02','2022-07-02 04:35:02'),
(11,500,2,3,1,'2022-07-02 04:50:28','2022-07-02 04:57:50'),
(12,500,2,4,1,'2022-07-02 04:54:16','2022-07-02 04:54:16'),
(13,2500,3,4,1,'2022-07-02 04:54:16','2022-07-02 04:55:13'),
(14,1345,2,NULL,1,'2022-07-02 04:58:46','2022-07-02 04:58:46'),
(15,24000,3,NULL,1,'2022-07-02 04:58:46','2022-07-02 04:58:46'),
(16,12,5,12,1,'2022-07-02 14:25:53','2022-07-02 14:25:53'),
(17,12,5,13,1,'2022-07-02 14:26:42','2022-07-02 14:26:42'),
(18,12,5,14,1,'2022-07-02 14:29:45','2022-07-02 14:29:45'),
(19,12,5,15,1,'2022-07-02 14:31:13','2022-07-02 14:31:13'),
(20,12,4,NULL,1,'2022-07-10 22:32:03','2022-07-10 22:32:03'),
(21,1,2,1,1,'2022-08-08 02:33:28','2022-08-08 02:33:28'),
(22,1,2,2,1,'2022-08-08 02:33:53','2022-08-08 02:33:53'),
(23,1,2,3,1,'2022-08-08 02:34:07','2022-08-08 02:34:07'),
(24,1,4,7,1,'2022-08-08 02:34:29','2022-08-08 02:34:29'),
(25,1,4,8,1,'2022-08-08 02:34:44','2022-08-08 02:34:44'),
(26,1,4,9,1,'2022-08-08 02:34:59','2022-08-08 02:34:59'),
(27,1,4,11,1,'2022-08-08 02:35:39','2022-08-08 02:35:39'),
(28,1,4,10,1,'2022-08-08 02:35:47','2022-08-08 02:35:47'),
(29,1,4,12,1,'2022-08-08 02:35:55','2022-08-08 02:35:55'),
(30,1,4,13,1,'2022-08-08 02:36:12','2022-08-08 02:36:12'),
(31,1,4,14,1,'2022-08-08 02:36:22','2022-08-08 02:36:22'),
(32,1,4,15,1,'2022-08-08 02:36:29','2022-08-08 02:36:29'),
(33,1,1,16,1,'2022-08-08 02:36:36','2022-08-08 02:36:36'),
(34,1,6,18,1,'2022-08-28 07:08:41','2022-08-28 07:08:41'),
(35,1,6,19,1,'2022-08-28 07:10:02','2022-08-28 07:10:02'),
(36,1,6,20,1,'2022-08-28 07:14:36','2022-08-28 07:14:36'),
(37,1,6,21,1,'2022-08-28 07:15:41','2022-08-28 07:15:41'),
(38,1,6,22,1,'2022-08-28 07:16:11','2022-08-28 07:16:11'),
(39,1,6,23,1,'2022-08-28 07:16:43','2022-08-28 07:16:43'),
(40,1,6,24,1,'2022-08-28 07:18:11','2022-08-28 07:18:11'),
(41,1,6,25,1,'2022-08-28 07:20:11','2022-08-28 07:20:11'),
(42,2500,3,2,1,'2022-08-28 08:00:20','2022-08-28 08:00:20'),
(44,100,5,32,96,'2022-10-04 01:58:21','2022-10-04 01:58:21'),
(45,1,4,33,96,'2022-10-04 03:26:46','2022-10-04 03:26:46'),
(46,1,4,34,96,'2022-10-04 03:31:06','2022-10-04 03:31:06'),
(47,300,3,36,96,'2022-10-10 03:28:09','2022-10-10 03:28:09'),
(48,1,8,36,96,'2022-10-10 03:28:09','2022-10-10 03:44:36'),
(49,300,3,37,96,'2022-10-10 03:28:43','2022-10-10 03:28:43'),
(50,1,8,37,96,'2022-10-10 03:28:43','2022-10-10 03:51:07'),
(51,50,3,38,96,'2022-10-10 03:29:48','2022-10-10 03:29:48'),
(52,1,4,38,96,'2022-10-10 03:29:48','2022-10-10 03:29:48'),
(53,10,3,39,96,'2022-10-10 03:30:45','2022-10-10 03:30:45'),
(54,1,4,39,96,'2022-10-10 03:30:45','2022-10-10 03:30:45'),
(55,1000,3,40,96,'2022-10-10 03:31:39','2022-10-10 03:31:39'),
(56,100,4,40,96,'2022-10-10 03:31:39','2022-10-10 03:31:39'),
(57,1,6,40,96,'2022-10-10 03:31:39','2022-10-10 03:31:39'),
(58,100,3,41,96,'2022-10-10 03:32:07','2022-10-10 03:32:07'),
(59,1,4,41,96,'2022-10-10 03:32:07','2022-10-10 03:32:07'),
(60,1,1,42,96,'2022-10-10 03:32:48','2022-10-10 03:32:48'),
(61,100,3,42,96,'2022-10-10 03:32:48','2022-10-10 03:32:48'),
(62,1,4,43,96,'2022-10-10 03:33:21','2022-10-10 03:33:21'),
(63,1,4,44,96,'2022-10-10 03:33:48','2022-10-10 03:33:48'),
(64,1,4,45,96,'2022-10-10 03:34:25','2022-10-10 03:34:25'),
(65,1,4,46,96,'2022-10-10 03:34:59','2022-10-10 03:34:59'),
(66,1,4,47,96,'2022-10-10 03:35:37','2022-10-10 03:35:37'),
(67,1,4,48,96,'2022-10-10 03:36:14','2022-10-10 03:36:14'),
(68,1,4,49,96,'2022-10-10 03:37:00','2022-10-10 03:37:00'),
(69,1,6,35,97,'2022-10-10 04:49:06','2022-10-10 04:49:06'),
(70,1,6,28,97,'2022-10-10 04:49:25','2022-10-10 04:49:25'),
(71,1,6,51,1,'2022-10-18 06:20:27','2022-10-18 06:20:27'),
(72,1,6,52,1,'2022-10-18 06:23:22','2022-10-18 06:23:22'),
(73,1,5,55,96,'2022-11-14 01:45:22','2022-11-14 01:45:22'),
(74,100,9,55,96,'2022-11-14 01:45:58','2022-11-14 01:45:58'),
(75,1,6,59,1,NULL,NULL),
(76,500,2,60,1,'2023-10-31 02:02:21','2023-10-31 02:02:21'),
(77,2500,3,60,1,'2023-10-31 02:02:21','2023-10-31 02:02:21');
/*!40000 ALTER TABLE `td_satuan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `td_sisa_praktek`
--

DROP TABLE IF EXISTS `td_sisa_praktek`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `td_sisa_praktek` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(32) DEFAULT NULL,
  `jumlah` int(10) unsigned NOT NULL,
  `tr_barang_laboratorium_id` int(10) unsigned NOT NULL,
  `tr_kartu_stok_id` int(10) unsigned DEFAULT NULL,
  `tr_serma_hasil_sisa_praktek_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `td_satuan_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `td_sisa_praktek_tr_barang_laboratorium_id_foreign` (`tr_barang_laboratorium_id`),
  KEY `td_sisa_praktek_tr_serma_hasil_sisa_praktek_id_foreign` (`tr_serma_hasil_sisa_praktek_id`),
  KEY `td_sisa_praktek_tr_kartu_stok_id_foreign` (`tr_kartu_stok_id`),
  CONSTRAINT `td_sisa_praktek_tr_barang_laboratorium_id_foreign` FOREIGN KEY (`tr_barang_laboratorium_id`) REFERENCES `tr_barang_laboratorium` (`id`) ON DELETE CASCADE,
  CONSTRAINT `td_sisa_praktek_tr_kartu_stok_id_foreign` FOREIGN KEY (`tr_kartu_stok_id`) REFERENCES `tr_kartu_stok` (`id`) ON DELETE CASCADE,
  CONSTRAINT `td_sisa_praktek_tr_serma_hasil_sisa_praktek_id_foreign` FOREIGN KEY (`tr_serma_hasil_sisa_praktek_id`) REFERENCES `tr_serma_hasil_sisa_praktek` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `td_sisa_praktek`
--

LOCK TABLES `td_sisa_praktek` WRITE;
/*!40000 ALTER TABLE `td_sisa_praktek` DISABLE KEYS */;
INSERT INTO `td_sisa_praktek` VALUES
(2,NULL,10,68,317,4,'2022-11-24 03:45:11','2022-11-24 03:45:11',22),
(3,NULL,5,68,326,5,'2022-11-24 11:45:39','2022-11-24 11:45:39',22),
(4,NULL,123,67,374,6,'2024-06-13 02:52:37','2024-06-13 02:52:37',73);
/*!40000 ALTER TABLE `td_sisa_praktek` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tm_barang`
--

DROP TABLE IF EXISTS `tm_barang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tm_barang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(64) NOT NULL,
  `spesifikasi` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `tm_satuan_id` smallint(5) unsigned DEFAULT NULL,
  `tm_jenis_barang_id` tinyint(3) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `qty` int(10) unsigned DEFAULT NULL,
  `kode_barang` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tm_barang_user_id_foreign` (`user_id`),
  KEY `tm_barang_tm_satuan_id_foreign` (`tm_satuan_id`),
  KEY `tm_barang_tm_jenis_barang_id_foreign` (`tm_jenis_barang_id`),
  CONSTRAINT `tm_barang_tm_jenis_barang_id_foreign` FOREIGN KEY (`tm_jenis_barang_id`) REFERENCES `tm_jenis_barang` (`id`) ON DELETE SET NULL,
  CONSTRAINT `tm_barang_tm_satuan_id_foreign` FOREIGN KEY (`tm_satuan_id`) REFERENCES `tm_satuan` (`id`) ON DELETE SET NULL,
  CONSTRAINT `tm_barang_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tm_barang`
--

LOCK TABLES `tm_barang` WRITE;
/*!40000 ALTER TABLE `tm_barang` DISABLE KEYS */;
INSERT INTO `tm_barang` VALUES
(1,'Kertas HVS A4 80Gr',NULL,NULL,1,2,2,'2022-06-30 15:28:01','2024-06-13 02:55:00',505,NULL),
(2,'Kertas HVS A4 70Gr',NULL,NULL,1,2,2,'2022-07-02 04:35:02','2024-03-07 02:30:31',0,NULL),
(3,'Kertas HVS F4 70Gr',NULL,NULL,1,2,2,'2022-07-02 04:40:20','2024-03-07 02:30:38',0,NULL),
(4,'Kertas HVS F4 80Gr',NULL,NULL,1,2,2,'2022-07-02 04:54:16','2024-03-07 02:30:59',0,NULL),
(7,'Sticky Note 653 (39mm X 51mm)','',NULL,1,4,2,'2022-07-02 14:10:15','2024-03-07 02:30:51',0,NULL),
(8,'Sticky Note 654 (76mm X 77mm)','',NULL,1,4,2,'2022-07-02 14:11:06','2024-06-13 02:39:29',12,NULL),
(9,'Sticky Note 655 (77mm X 127mm)','',NULL,1,4,2,'2022-07-02 14:11:54','2022-07-02 14:11:54',0,NULL),
(10,'Sticky Note 656 (77mm X 51mm)','',NULL,1,4,2,'2022-07-02 14:12:49','2022-10-03 23:36:11',0,NULL),
(11,'Sticky Note 657 (77mm X 102mm)','',NULL,1,4,2,'2022-07-02 14:19:28','2022-07-02 14:19:28',0,NULL),
(12,'Snowman White Board BG (hitam)','',NULL,1,4,2,'2022-07-02 14:25:52','2022-10-06 01:08:48',0,NULL),
(13,'Snowman White Board BG (Biru)','',NULL,1,4,2,'2022-07-02 14:26:41','2022-07-02 14:28:38',0,NULL),
(14,'Snowman White Board BG (Hijau)','',NULL,1,4,2,'2022-07-02 14:29:45','2022-07-02 14:30:16',0,NULL),
(15,'Snowman White Board BG (Merah)','',NULL,1,4,2,'2022-07-02 14:31:12','2022-07-02 14:31:12',0,NULL),
(16,'Kertas Manila Putih A1','',NULL,1,1,2,'2022-07-02 14:36:09','2024-06-13 06:01:55',100,NULL),
(18,'PC - Asus All in one PC - A4310',NULL,NULL,1,6,1,'2022-08-28 07:08:41','2022-10-10 02:13:45',0,NULL),
(19,'Switch hub - Ubiquiti',NULL,NULL,1,6,1,'2022-08-28 07:10:02','2022-09-22 10:46:22',0,NULL),
(20,'Switch hub - D Link',NULL,NULL,1,6,1,'2022-08-28 07:14:36','2022-09-13 15:54:24',0,NULL),
(21,'Printer Laser Jet M125 A',NULL,NULL,1,6,1,'2022-08-28 07:15:41','2022-09-28 07:37:54',0,NULL),
(22,'Printer Epson L3150',NULL,NULL,1,6,1,'2022-08-28 07:16:11','2022-10-07 06:58:25',0,NULL),
(23,'Vacum Cleaner maximus 1000w',NULL,NULL,1,6,1,'2022-08-28 07:16:43','2022-10-07 06:58:25',0,NULL),
(24,'Barcode Scanner Argox AS-8000URB',NULL,NULL,1,6,1,'2022-08-28 07:18:11','2022-09-13 15:54:19',0,NULL),
(25,'Finger Print premier Series',NULL,NULL,1,6,1,'2022-08-28 07:20:11','2022-10-07 06:58:25',0,NULL),
(26,'Raspberry Pi 3b',NULL,NULL,91,6,1,'2022-08-29 20:06:18','2022-10-12 09:20:56',0,NULL),
(28,'Converter VGA to HDMI',NULL,NULL,91,6,1,'2022-08-29 20:10:39','2024-03-07 02:34:45',0,NULL),
(29,'Proyektor Dell Wide',NULL,NULL,91,6,1,'2022-09-14 18:21:17','2022-10-07 06:54:28',0,NULL),
(30,'Lampu Flip Flop','bagus',NULL,91,6,3,'2022-09-14 19:06:04','2022-09-18 17:25:37',0,NULL),
(31,'molen cokelat','terbuat dari cokelat belgia, lembut tiap gigitan',NULL,91,5,3,'2022-09-15 03:42:08','2024-06-13 02:52:37',36,NULL),
(32,'Voting Dot',NULL,NULL,96,5,2,'2022-10-04 01:57:56','2022-10-04 01:58:26',0,NULL),
(33,'masking Tape',NULL,NULL,96,4,2,'2022-10-04 03:26:46','2022-10-04 03:26:59',0,NULL),
(34,'Gunting','6 Inch',NULL,96,4,1,'2022-10-04 03:31:06','2022-10-04 12:17:18',0,NULL),
(35,'AVO Meter Sanwa CD 800a',NULL,NULL,1,6,1,'2022-10-04 09:24:34','2022-10-18 06:19:07',0,NULL),
(36,'Kabel UTP CAT6',NULL,NULL,96,8,2,'2022-10-10 03:28:09','2022-10-10 03:49:22',0,NULL),
(37,'Kebel UTP CAT 5e',NULL,NULL,96,8,2,'2022-10-10 03:28:43','2022-10-10 03:52:44',0,NULL),
(38,'RJ45 CAT 5','CAT 5',NULL,96,4,2,'2022-10-10 03:29:48','2022-10-10 03:29:48',0,NULL),
(39,'Fast Connector SC',NULL,NULL,96,4,2,'2022-10-10 03:30:45','2022-10-10 03:30:55',0,NULL),
(40,'Drop Core','Meter',NULL,96,6,2,'2022-10-10 03:31:39','2022-10-10 03:31:39',0,NULL),
(41,'LAN TESTER',NULL,NULL,96,4,1,'2022-10-10 03:32:07','2022-10-10 03:32:07',0,NULL),
(42,'PCB POLOS 10x20',NULL,NULL,96,1,2,'2022-10-10 03:32:48','2022-10-10 03:32:48',0,NULL),
(43,'WeMos D1 Mini',NULL,NULL,96,4,2,'2022-10-10 03:33:21','2022-10-10 03:33:21',0,NULL),
(44,'Arduino UNO',NULL,NULL,96,4,2,'2022-10-10 03:33:48','2022-10-10 03:33:48',0,NULL),
(45,'Humidity Sensor',NULL,NULL,96,4,2,'2022-10-10 03:34:25','2022-10-10 03:34:25',0,NULL),
(46,'Range Finder',NULL,NULL,96,4,2,'2022-10-10 03:34:59','2022-10-10 03:34:59',0,NULL),
(47,'AVO Meter Analog',NULL,NULL,96,4,2,'2022-10-10 03:35:37','2022-10-10 03:35:37',0,NULL),
(48,'ESP8266-1',NULL,NULL,96,4,2,'2022-10-10 03:36:14','2022-10-10 03:36:14',0,NULL),
(49,'Node MCU v3',NULL,NULL,96,4,2,'2022-10-10 03:37:00','2022-10-10 03:37:00',0,NULL),
(50,'Splacer','Fusi splacer',NULL,96,4,1,'2022-10-10 03:48:33','2022-10-10 03:48:49',0,NULL),
(51,'Monitor Dell B0-110',NULL,NULL,1,6,1,'2022-10-18 06:20:27','2022-10-18 06:38:58',0,NULL),
(52,'VGA to HDMI',NULL,NULL,1,6,1,'2022-10-18 06:23:22','2024-03-07 02:38:48',4,NULL),
(53,'Kabel VGA 1 Meter',NULL,NULL,1,6,1,'2022-10-18 06:35:16','2022-10-18 06:38:58',0,NULL),
(54,'Kabel HDMI 1 Meter',NULL,NULL,1,6,1,'2022-10-18 06:36:52','2024-03-07 02:34:38',0,NULL),
(55,'Folio Bergaris',NULL,NULL,96,5,2,'2022-11-14 01:45:22','2024-06-13 02:52:37',143,NULL),
(56,'Modul Line Followers','Modul praktikum mikrokontroller',NULL,95,6,3,'2022-11-21 08:11:16','2024-03-07 02:39:44',8,NULL),
(57,'DS18B20 Temperature sensor','sensor suhu air',NULL,98,6,1,'2022-11-22 07:05:18','2022-11-22 07:05:18',NULL,NULL),
(58,'LCD modul 2x16',NULL,NULL,98,4,1,'2022-11-22 07:05:44','2022-11-22 07:05:44',NULL,NULL),
(59,'PC Acer Verton borrow RSI','Core i7\nRAM 16 GB\nSSD',NULL,1,6,1,'2023-03-09 01:17:40','2023-03-09 01:27:02',0,NULL),
(60,'Kertas HVS A4 75Gr',NULL,NULL,1,2,2,'2023-10-31 02:02:21','2023-10-31 02:04:29',8500,NULL),
(61,'Komputer','Dell',NULL,100,6,1,'2024-03-14 01:49:30','2024-03-14 01:49:30',NULL,NULL),
(62,'Komputer Al In One','Hp',NULL,100,6,1,'2024-03-14 01:50:08','2024-03-14 01:50:08',NULL,NULL),
(63,'Soldering','Okachi 40 W',NULL,100,7,1,'2024-03-14 01:51:27','2024-03-14 02:00:16',1,NULL),
(64,'Desolderng ( Sedot Timah)','Desoldering Pump',NULL,100,7,1,'2024-03-14 01:57:10','2024-03-14 01:57:42',4,NULL),
(65,'Desoldering Pump ( Sedot Timah )','Denko DS -3',NULL,100,6,1,'2024-03-14 01:59:41','2024-03-14 01:59:41',NULL,NULL),
(66,'Barcode Scanner','13',NULL,95,4,1,'2024-06-11 08:03:13','2024-06-11 08:03:13',NULL,NULL),
(67,'Barcode Scanner 2D','13',NULL,95,4,1,'2024-06-11 08:04:37','2024-06-13 02:49:51',1000,NULL),
(68,'barcode Scanner 1D','5',NULL,95,4,1,'2024-06-11 08:05:19','2024-06-11 08:05:32',5,NULL),
(69,'portable Printer Thermal','18',NULL,95,4,1,'2024-06-11 08:06:58','2024-06-11 08:07:11',18,NULL),
(70,'RFID Reader','12',NULL,95,4,1,'2024-06-11 08:07:41','2024-06-13 02:45:09',12,NULL),
(71,'RFID (Card)','3',NULL,95,4,1,'2024-06-11 08:08:02','2024-06-11 08:08:13',3,NULL),
(72,'tv','samsung',NULL,1,2,2,'2024-06-13 08:29:01','2024-06-13 08:29:01',NULL,NULL);
/*!40000 ALTER TABLE `tm_barang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tm_jenis_barang`
--

DROP TABLE IF EXISTS `tm_jenis_barang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tm_jenis_barang` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `jenis_barang` varchar(32) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tm_jenis_barang`
--

LOCK TABLES `tm_jenis_barang` WRITE;
/*!40000 ALTER TABLE `tm_jenis_barang` DISABLE KEYS */;
INSERT INTO `tm_jenis_barang` VALUES
(1,'Alat','2022-06-20 15:02:30','2022-06-20 15:02:30'),
(2,'Bahan','2022-06-20 15:02:43','2022-06-20 15:02:43'),
(3,'Hasil Praktek',NULL,NULL);
/*!40000 ALTER TABLE `tm_jenis_barang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tm_jurusan`
--

DROP TABLE IF EXISTS `tm_jurusan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tm_jurusan` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(8) DEFAULT NULL,
  `jurusan` varchar(64) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tm_jurusan_user_id_foreign` (`user_id`),
  CONSTRAINT `tm_jurusan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tm_jurusan`
--

LOCK TABLES `tm_jurusan` WRITE;
/*!40000 ALTER TABLE `tm_jurusan` DISABLE KEYS */;
INSERT INTO `tm_jurusan` VALUES
(5,'PL17.3.2','Jurusan Teknologi Pertanian',1,'2022-05-10 04:00:45','2022-05-10 04:00:45'),
(6,'PL17.3.3','Jurusan Peternakan',1,'2022-05-10 04:03:21','2022-05-10 04:03:21'),
(7,'PL17.3.4','Jurusan Manajemen Agribisnis',1,'2022-05-10 04:05:11','2022-05-10 04:05:11'),
(8,'PL17.3.5','Jurusan Teknologi Informasi',1,'2022-05-10 04:05:41','2022-05-10 04:05:41'),
(9,'PL17.3.6','Jurusan Bahasa Komunikasi Dan Pariwisata',1,'2022-05-10 04:18:43','2022-05-10 04:18:43'),
(10,'PL17.3.7','Jurusan Kesehatan',1,'2022-05-10 04:19:08','2022-05-10 04:19:08'),
(11,'PL17.3.8','Jurusan Teknik',1,'2022-05-10 04:19:31','2022-05-10 04:19:31');
/*!40000 ALTER TABLE `tm_jurusan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tm_laboratorium`
--

DROP TABLE IF EXISTS `tm_laboratorium`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tm_laboratorium` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(32) NOT NULL,
  `laboratorium` varchar(64) NOT NULL,
  `tm_jurusan_id` tinyint(3) unsigned NOT NULL,
  `is_aktif` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `singkatan` varchar(255) DEFAULT NULL,
  `warna` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tm_laboratorium_tm_jurusan_id_foreign` (`tm_jurusan_id`),
  CONSTRAINT `tm_laboratorium_tm_jurusan_id_foreign` FOREIGN KEY (`tm_jurusan_id`) REFERENCES `tm_jurusan` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tm_laboratorium`
--

LOCK TABLES `tm_laboratorium` WRITE;
/*!40000 ALTER TABLE `tm_laboratorium` DISABLE KEYS */;
INSERT INTO `tm_laboratorium` VALUES
(1,'PL17.3.5.04','Rekayasa Perangkat Lunak',8,1,'2022-08-20 17:35:42','2022-09-30 08:19:35','RPL','#2B908F'),
(3,'PL17.3.5.06','Multimedia Cerdas',8,1,'2022-08-20 17:45:51','2022-09-30 08:19:56','MMC','#F9A3A4'),
(5,'PL17.3.5.01','Komputasi Dan Sistem Informasi',8,1,'2022-09-30 08:24:34','2022-09-30 08:27:56','KSI','#90EE7E'),
(6,'PL17.3.5.02','Sistem Komputer Dan Kontrol',8,1,'2022-09-30 08:25:13','2022-09-30 08:25:13','SKK','#FA4443'),
(7,'PL17.3.5.03','Arsitektur Dan Jaringan Komputer',8,1,'2022-09-30 08:26:45','2022-09-30 08:26:45','AJK','#69D2E7'),
(8,'PL17.3.5.05','Rekayasa Sistem Informasi',8,1,'2022-09-30 08:28:45','2022-09-30 08:28:45','RSI','	#008FFB'),
(9,'PL17.3.5.04','Rekayasa Perangkat Lunak - BWS',8,1,'2023-07-27 08:47:39','2023-07-27 08:47:55',NULL,NULL),
(10,'PL17.3.5.03','Administrasi Jaringan Komputer - BWS',8,1,'2023-07-27 08:48:57','2023-07-27 08:49:16',NULL,NULL),
(11,'PL17.3.5.05','Rekayasa Sistem Informasi - SDA',8,1,'2024-03-07 01:44:32','2024-03-07 01:44:32',NULL,NULL),
(12,'PL17.3.5.02','Sistem Komputer Dan Kontrol - SDA',8,1,'2024-03-07 01:58:04','2024-03-07 01:58:04',NULL,NULL),
(14,'PL17.3.5.06','Multimedia Cerdas - NJK',8,1,'2024-03-07 02:05:39','2024-03-07 02:05:39',NULL,NULL),
(15,'PL17.3.5.01','Komputasi Dan Sistem Informasi - NJK',8,1,'2024-03-07 02:07:57','2024-03-07 02:08:18',NULL,NULL);
/*!40000 ALTER TABLE `tm_laboratorium` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tm_matakuliah`
--

DROP TABLE IF EXISTS `tm_matakuliah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tm_matakuliah` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(12) DEFAULT NULL,
  `matakuliah` varchar(64) NOT NULL,
  `is_aktif` tinyint(1) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tm_matakuliah_user_id_foreign` (`user_id`),
  CONSTRAINT `tm_matakuliah_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=175 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tm_matakuliah`
--

LOCK TABLES `tm_matakuliah` WRITE;
/*!40000 ALTER TABLE `tm_matakuliah` DISABLE KEYS */;
INSERT INTO `tm_matakuliah` VALUES
(2,'MIF120701','Bahasa Indonesia',1,1,'2022-05-11 08:53:23','2022-10-04 06:52:57'),
(3,'MIF120702','Kewarganegaraan',1,1,'2022-05-11 08:53:23','2022-10-04 06:53:00'),
(4,'MIF120703','Intermediate English',1,1,'2022-05-11 08:53:23','2022-05-11 08:53:23'),
(5,'MIF120704','Pemrograman Berorientasi Objek',1,1,'2022-05-11 08:53:23','2022-05-11 08:53:23'),
(6,'MIF120705','Desain Web',1,1,'2022-05-11 08:53:23','2022-05-11 08:53:23'),
(7,'MIF120706','Analisis Dan Desain Sistem Informasi',1,1,'2022-05-11 08:53:23','2022-05-11 08:53:23'),
(8,'MIF120707','Workshop Pengembangan Aplikasi',1,1,'2022-05-11 08:53:23','2022-05-11 08:53:23'),
(9,'MIF120708','Workshop Manajemen Basisdata',1,1,'2022-05-11 08:53:23','2022-05-11 08:53:23'),
(10,'MIF120703','Praktik Intermediate English',1,1,'2022-05-11 08:53:24','2022-05-11 08:53:24'),
(11,'MIF140701','Teknik Penulisan Ilmiah',1,1,'2022-05-11 08:55:51','2022-05-11 08:55:51'),
(12,'MIF140702','Data Mining',1,1,'2022-05-11 08:55:51','2022-05-11 08:55:51'),
(13,'MIF140703','Pemrograman Mobile',1,1,'2022-05-11 08:55:51','2022-05-11 08:55:51'),
(14,'MIF140704','Interpersonal Skill',1,1,'2022-05-11 08:55:51','2022-05-11 08:55:51'),
(15,'MIF140705','Agroinformatika',1,1,'2022-05-11 08:55:51','2022-05-11 08:55:51'),
(16,'MIF140706','Customer Relationship Management',1,1,'2022-05-11 08:55:51','2022-05-11 08:55:51'),
(17,'MIF140707','Workshop Progressive Web Apps',1,1,'2022-05-11 08:55:51','2022-05-11 08:55:51'),
(18,'MIF140708','Workshop Basisdata Lanjut',1,1,'2022-05-11 08:55:51','2022-05-11 08:55:51'),
(19,'MIF160701','Bisnis Jasa Informatika',1,1,'2022-05-11 08:56:43','2022-05-11 08:56:43'),
(20,'MIF160702','Manajemen Proyek Sistem Informasi',1,1,'2022-05-11 08:56:43','2022-05-11 08:56:43'),
(21,'MIF160703','Tugas Akhir',1,1,'2022-05-11 08:56:43','2022-05-11 08:56:43'),
(22,'MIF110701','Agama',1,1,'2022-05-11 09:04:32','2022-05-11 09:04:32'),
(23,'MIF110702','Pancasila',1,1,'2022-05-11 09:04:32','2022-05-11 09:04:32'),
(24,'MIF110703','Basic English',1,1,'2022-05-11 09:04:32','2022-05-11 09:04:32'),
(25,'MIF110704','Algoritma Pemrograman',1,1,'2022-05-11 09:04:32','2022-05-11 09:04:32'),
(26,'MIF110705','Dasar Manajemen',1,1,'2022-05-11 09:04:32','2022-05-11 09:04:32'),
(27,'MIF110706','Basis Data',1,1,'2022-05-11 09:04:32','2022-05-11 09:04:32'),
(28,'MIF110707','Statistika Terapan',1,1,'2022-05-11 09:04:32','2022-05-11 09:04:32'),
(29,'MIF110708','Workshop Basis Data Relational',1,1,'2022-05-11 09:04:32','2022-05-11 09:04:32'),
(30,'MIF110709','Workshop Pemrograman Dasar',1,1,'2022-05-11 09:04:32','2022-05-11 09:04:32'),
(31,'MIF110703','Praktik Basic English',1,1,'2022-05-11 09:04:32','2022-05-11 09:04:32'),
(32,'MIF130701','Kewirausahaan',1,1,'2022-05-11 09:07:45','2022-05-11 09:07:45'),
(33,'MIF130702','Sistem Informasi Geografis',1,1,'2022-05-11 09:07:45','2022-05-11 09:07:45'),
(34,'MIF130703','Manajemen Operasional',1,1,'2022-05-11 09:07:45','2022-05-11 09:07:45'),
(35,'MIF130704','Kecerdasan Bisnis Terapan',1,1,'2022-05-11 09:07:45','2022-05-11 09:07:45'),
(36,'MIF130705','Komunikasi Visual',1,1,'2022-05-11 09:07:45','2022-05-11 09:07:45'),
(37,'MIF130706','Literasi Digital',1,1,'2022-05-11 09:07:45','2022-05-11 09:07:45'),
(38,'MIF130707','Workshop Sistem Informasi',1,1,'2022-05-11 09:07:45','2022-05-11 09:07:45'),
(39,'MIF130708','Workshop Visualisasi Data',1,1,'2022-05-11 09:07:45','2022-05-11 09:07:45'),
(40,'MIF150701','Magang',1,1,'2022-05-11 09:08:08','2022-05-11 09:08:08'),
(41,'TKK150701','Magang',1,1,'2022-05-11 09:08:36','2022-05-11 09:08:36'),
(42,'TKK130701','Sistem Pertanian Digital',1,1,'2022-05-11 09:10:23','2022-05-11 09:10:23'),
(43,'TKK130702','Manajemen Basis Data',1,1,'2022-05-11 09:10:23','2022-05-11 09:10:23'),
(44,'TKK130703','Routing Dan Switching',1,1,'2022-05-11 09:10:23','2022-05-11 09:10:23'),
(45,'TKK130704','Keamanan Jaringan',1,1,'2022-05-11 09:10:23','2022-05-11 09:10:23'),
(46,'TKK130705','Mikrokomputer',1,1,'2022-05-11 09:10:23','2022-05-11 09:10:23'),
(47,'TKK130706','Workshop Sistem Tertanam',1,1,'2022-05-11 09:10:23','2022-05-11 09:10:23'),
(48,'TKK130707','Workshop Jaringan Wan',1,1,'2022-05-11 09:10:23','2022-05-11 09:10:23'),
(49,'TKK130708','Workshop Aplikasi Mobile',1,1,'2022-05-11 09:10:23','2022-05-11 09:10:23'),
(50,'TKK110701','Agama',1,1,'2022-05-11 09:13:12','2022-05-11 09:13:12'),
(51,'TKK110702','Pancasila',1,1,'2022-05-11 09:13:12','2022-05-11 09:13:12'),
(52,'TKK110703','Basic English',1,1,'2022-05-11 09:13:12','2022-05-11 09:13:12'),
(53,'TKK110704','Literasi Digital',1,1,'2022-05-11 09:13:12','2022-05-11 09:13:12'),
(54,'TKK110705','Logika Dan Algoritma Pemrograman',1,1,'2022-05-11 09:13:12','2022-05-11 09:13:12'),
(55,'TKK110706','Sistem Operasi',1,1,'2022-05-11 09:13:12','2022-05-11 09:13:12'),
(56,'TKK110707','Workshop Administrasi Sistem',1,1,'2022-05-11 09:13:12','2022-05-11 09:13:12'),
(57,'TKK110708','Workshop Pemrograman Dasar',1,1,'2022-05-11 09:13:12','2022-05-11 09:13:12'),
(58,'TKK110703','Praktik Basic English',1,1,'2022-05-11 09:13:12','2022-05-11 09:13:12'),
(59,'TKK120701','Bahasa Indonesia',1,1,'2022-05-11 09:18:39','2022-05-11 09:18:39'),
(60,'TKK120702','Kewarganegaraan',1,1,'2022-05-11 09:18:39','2022-05-11 09:18:39'),
(61,'TKK120703','Intermediate English',1,1,'2022-05-11 09:18:39','2022-05-11 09:18:39'),
(62,'TKK120704','Sistem Kontrol Elektronik',1,1,'2022-05-11 09:18:39','2022-05-11 09:18:39'),
(63,'TKK120705','Jaringan Komputer',1,1,'2022-05-11 09:18:39','2022-05-11 09:18:39'),
(64,'TKK120706','Workshop Infrastruktur Jaringan Komputer',1,1,'2022-05-11 09:18:39','2022-05-11 09:18:39'),
(65,'TKK120707','Workshop Pemrograman Web',1,1,'2022-05-11 09:18:39','2022-05-11 09:18:39'),
(66,'TKK120708','Workshop Elektronika Terapan',1,1,'2022-05-11 09:18:39','2022-05-11 09:18:39'),
(67,'TKK120703','Praktik Intermediate English',1,1,'2022-05-11 09:18:39','2022-05-11 09:18:39'),
(68,'TKK140701','Teknik Penulisan Ilmiah',1,1,'2022-05-11 09:21:13','2022-05-11 09:21:13'),
(69,'TKK140702','Interpersonal Skill',1,1,'2022-05-11 09:21:13','2022-05-11 09:21:13'),
(70,'TKK140703','Komputasi Awan',1,1,'2022-05-11 09:21:13','2022-05-11 09:21:13'),
(71,'TKK140704','Jaringan Berbasis Software',1,1,'2022-05-11 09:21:13','2022-05-11 09:21:13'),
(72,'TKK140705','Sistem Otomasi',1,1,'2022-05-11 09:21:13','2022-05-11 09:21:13'),
(73,'TKK140706','Internet Of Things',1,1,'2022-05-11 09:21:13','2022-05-11 09:21:13'),
(74,'TKK140707','Workshop Komputasi Awan',1,1,'2022-05-11 09:21:13','2022-05-11 09:21:13'),
(75,'TKK140708','Workshop Sistem Komputer Kontrol',1,1,'2022-05-11 09:21:13','2022-05-11 09:21:13'),
(76,'TKK160701','Kewirausahaan',1,1,'2022-05-11 09:22:20','2022-05-11 09:22:20'),
(77,'TKK160702','Tugas Akhir',1,1,'2022-05-11 09:22:20','2022-05-11 09:22:20'),
(78,'TIF120701','Bahasa Indonesia',1,1,'2022-05-11 09:25:14','2022-05-11 09:25:14'),
(79,'TIF120702','Kewarganegaraan',1,1,'2022-05-11 09:25:14','2022-05-11 09:25:14'),
(80,'TIF120703','Intermediate English',1,1,'2022-05-11 09:25:14','2022-05-11 09:25:14'),
(81,'TIF120704','Interaksi Manusia Dan Komputer',1,1,'2022-05-11 09:25:14','2022-05-11 09:25:14'),
(82,'TIF120705','Sistem Aplikasi Berbasis Obyek',1,1,'2022-05-11 09:25:14','2022-05-11 09:25:14'),
(83,'TIF120706','Perencanaan Proyek Perangkat Lunak',1,1,'2022-05-11 09:25:14','2022-05-11 09:25:14'),
(84,'TIF120707','Workshop Sistem Informasi Berbasis Desktop',1,1,'2022-05-11 09:25:14','2022-05-11 09:25:14'),
(85,'TIF120708','Workshop Manajemen Proyek',1,1,'2022-05-11 09:25:14','2022-05-11 09:25:14'),
(86,'TIF120703','Praktik Intermediate English',1,1,'2022-05-11 09:25:14','2022-05-11 09:25:14'),
(87,'TIF140701','Literasi Digital',1,1,'2022-05-11 09:27:07','2022-05-11 09:27:07'),
(88,'TIF140702','Kewirausahaan',1,1,'2022-05-11 09:27:07','2022-05-11 09:27:07'),
(89,'TIF140703','Manajemen Kualitas Perangkat Lunak',1,1,'2022-05-11 09:27:07','2022-05-11 09:27:07'),
(90,'TIF140704','Perawatan Perangkat Lunak',1,1,'2022-05-11 09:27:07','2022-05-11 09:27:07'),
(91,'TIF140705','Pengujian Perangkat Lunak',1,1,'2022-05-11 09:27:07','2022-05-11 09:27:07'),
(92,'TIF140706','Workshop Sistem Informasi Web Framework',1,1,'2022-05-11 09:27:07','2022-05-11 09:27:07'),
(93,'TIF140707','Workshop Mobile Applications Framework',1,1,'2022-05-11 09:27:07','2022-05-11 09:27:07'),
(94,'TIF130701','Interpersonal Skill',1,1,'2022-05-11 09:29:27','2022-05-11 09:29:27'),
(95,'TIF160701','Teknik Penulisan Ilmiah',1,1,'2022-05-11 09:29:27','2022-05-11 09:29:27'),
(96,'TIF160703','Tren Teknologi',1,1,'2022-05-11 09:29:27','2022-05-11 09:29:27'),
(97,'TIF160704','Data Warehouse',1,1,'2022-05-11 09:29:27','2022-05-11 09:29:27'),
(98,'TIF160705','Workshop Developer Operational',1,1,'2022-05-11 09:29:27','2022-05-11 09:29:27'),
(99,'TIF160706','Workshop Tata Kelola Teknologi Informasi',1,1,'2022-05-11 09:29:27','2022-05-11 09:29:27'),
(100,'TIF160707','Workshop Proyek Sistem Informasi',1,1,'2022-05-11 09:29:27','2022-05-11 09:29:27'),
(102,'TIF140701','Literasi Digital',1,1,'2022-05-11 09:34:33','2022-05-11 09:34:33'),
(103,'TIF180701','Skripsi',1,1,'2022-05-11 09:34:33','2022-05-11 09:34:33'),
(104,'TIF170701','Magang',1,1,'2022-05-11 09:37:09','2022-05-11 09:37:09'),
(105,'TIF150701','Aplikasi Sistem Tertanam',1,1,'2022-05-11 09:39:20','2022-05-11 09:39:20'),
(106,'TIF150702','Sistem Cerdas',1,1,'2022-05-11 09:39:20','2022-05-11 09:39:20'),
(107,'TIF150703','Agroinformatika',1,1,'2022-05-11 09:39:20','2022-05-11 09:39:20'),
(108,'TIF150704','Multimedia Permainan',1,1,'2022-05-11 09:39:20','2022-05-11 09:39:20'),
(109,'TIF150705','Workshop Pengolahan Citra Dan Vision',1,1,'2022-05-11 09:39:20','2022-05-11 09:39:20'),
(110,'TIF150706','Workshop Sistem Tertanam',1,1,'2022-05-11 09:39:20','2022-05-11 09:39:20'),
(111,'TIF150707','Workshop Sistem Cerdas',1,1,'2022-05-11 09:39:20','2022-05-11 09:39:20'),
(112,'TKK10701','Agama',1,1,'2022-09-02 16:06:25','2022-09-03 03:51:19'),
(113,'TKK10702','Pancasila',1,1,'2022-09-03 04:22:14','2022-09-03 04:22:14'),
(114,'TKK10703','Basic English',1,1,'2022-09-03 04:25:10','2022-09-03 04:25:10'),
(115,'TKK10706','Sistem Operasi',1,1,'2022-09-03 04:25:42','2022-09-03 04:25:42'),
(116,'TKK10705','Logika Dan Algoritma Pemrograman',1,1,'2022-09-03 04:26:14','2022-09-03 04:26:14'),
(117,'TKK10704','Literasi Digital',1,1,'2022-09-03 04:27:24','2022-09-03 04:27:24'),
(118,'TKK10707','Workshop Administrasi Sistem',1,1,'2022-09-03 04:28:28','2022-09-03 04:28:28'),
(119,'TKK10708','Workshop Pemrograman Dasar',1,1,'2022-09-03 04:31:05','2022-09-03 04:31:05'),
(120,'TKK3601','Sistem Pertanian Digital',1,1,'2022-09-03 10:55:18','2022-09-03 10:55:18'),
(121,'TKK3602','Manajemen Basis Data',1,1,'2022-09-03 10:55:18','2022-09-03 10:55:18'),
(122,'TKK3603','Routing Dan Switching',1,1,'2022-09-03 10:55:19','2022-09-03 10:55:19'),
(123,'TKK3604','Keamanan Jaringan',1,1,'2022-09-03 10:55:19','2022-09-03 10:55:19'),
(125,'TKK3606','Workshop Sistem Tertanam',1,1,'2022-09-03 10:55:20','2022-09-03 10:55:20'),
(126,'TKK3605','Mikrokomputer',1,1,'2022-09-03 12:01:21','2022-09-03 12:01:21'),
(128,'TKK3607','Workshop Jaringan WAN',1,1,'2022-09-03 12:01:21','2022-09-03 12:01:21'),
(129,'TKK3608','Workshop Aplikasi Mobile',1,1,'2022-09-03 12:01:22','2022-09-03 12:01:22'),
(130,'TKK5601','Praktek Kerja Lapang',1,1,'2022-09-03 12:03:50','2022-09-03 12:03:50'),
(131,'TIF10701','Agama',1,1,'2022-09-04 01:42:31','2022-09-04 01:42:31'),
(132,'TIF10702','Pancasila',1,1,'2022-09-04 01:42:31','2022-09-04 01:42:31'),
(133,'TIF10703','Basic English',1,1,'2022-09-04 01:42:31','2022-09-04 01:42:31'),
(134,'TIF10704','Logika Dan Algoritma',1,1,'2022-09-04 01:42:31','2022-09-04 01:42:31'),
(135,'TIF10705','Konsep Basis Data',1,1,'2022-09-04 01:42:31','2022-09-04 01:42:31'),
(136,'TIF10706','Pemrograman Dasar',1,1,'2022-09-04 01:42:31','2022-09-04 01:42:31'),
(137,'TIF10707','Workshop Pengembangan Perangkat Lunak',1,1,'2022-09-04 01:42:31','2022-09-04 01:42:31'),
(138,'TIF10708','Workshop Basis Data',1,1,'2022-09-04 01:42:31','2022-09-04 01:42:31'),
(139,'TIF130702','Matematika Diskrit',1,1,'2022-09-04 01:42:31','2022-09-04 01:42:31'),
(140,'TIF130703','Konsep Jaringan Komputer',1,1,'2022-09-04 01:42:31','2022-09-04 01:42:31'),
(141,'TIF30704','Struktur Data',1,1,'2022-09-04 01:42:31','2022-09-04 01:42:31'),
(142,'TIF30705','Workshop Kualitas Perangkat Lunak',1,1,'2022-09-04 01:42:31','2022-09-04 01:42:31'),
(143,'TIF30706','Workshop Sistem Informasi Berbasis Web',1,1,'2022-09-04 01:42:31','2022-09-04 01:42:31'),
(144,'TIF30707','Workshop Mobile Applications',1,1,'2022-09-04 01:42:31','2022-09-04 01:42:31'),
(145,'TIF50701','Aplikasi Sistem Tertanam',1,1,'2022-09-04 01:42:31','2022-09-04 01:42:31'),
(146,'TIF50702','Sistem Cerdas',1,1,'2022-09-04 01:42:31','2022-09-04 01:42:31'),
(147,'TIF50703','Agroinformatika',1,1,'2022-09-04 01:42:31','2022-09-04 01:42:31'),
(148,'TIF50704','Multimedia Permainan',1,1,'2022-09-04 01:42:32','2022-09-04 01:42:32'),
(149,'TIF50705','Workshop Pengolahan Citra Dan Vision',1,1,'2022-09-04 01:42:32','2022-09-04 01:42:32'),
(150,'TIF50706','Workshop Sistem Tertanam',1,1,'2022-09-04 01:42:32','2022-09-04 01:42:32'),
(151,'TIF50707','Workshop Sistem Cerdas',1,1,'2022-09-04 01:42:32','2022-09-04 01:42:32'),
(152,'TIF70701','Magang',1,1,'2022-09-04 01:42:32','2022-09-04 01:42:32'),
(153,'TIF7601','Magang',1,1,'2022-09-04 01:42:33','2022-09-04 01:42:33'),
(161,'BID1601','Pancasila',1,1,'2022-09-04 01:47:22','2022-09-04 01:47:22'),
(162,'BID1602','Agama',1,1,'2022-09-04 01:47:22','2022-09-04 01:47:22'),
(163,'BID1603','Basic English',1,1,'2022-09-04 01:47:22','2022-09-04 01:47:22'),
(164,'BID1605','Algoritma Dan Pemrograman Dasar',1,1,'2022-09-04 01:47:22','2022-09-04 01:47:22'),
(165,'BID1606','Konsep Basis Data',1,1,'2022-09-04 01:47:22','2022-09-04 01:47:22'),
(166,'BID1607','Pengantar Bisnis',1,1,'2022-09-04 01:47:22','2022-09-04 01:47:22'),
(167,'BID1608','Dasar-Dasar Manajemen',1,1,'2022-09-04 01:47:22','2022-09-04 01:47:22'),
(168,'BID1604','Literasi Digital',1,1,'2022-09-04 01:47:22','2022-09-04 01:47:22'),
(169,'BID1609','Wokshop Sistem Informasi Manajemen',1,1,'2022-09-04 01:47:22','2022-09-04 01:47:22'),
(170,'PK09321','Jerman',0,97,'2022-10-04 06:53:36','2022-10-04 06:53:56'),
(171,'TEST','ASDFADF',1,1,'2022-10-06 04:23:16','2022-10-06 04:23:16'),
(173,'BSD1609','Workshop Sistem Informasi Manajemen',1,1,'2022-10-10 07:33:11','2022-10-10 07:33:11'),
(174,'BSD1603','Praktice Basic English',1,1,'2022-10-10 07:33:11','2022-10-10 07:33:11');
/*!40000 ALTER TABLE `tm_matakuliah` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tm_minggu`
--

DROP TABLE IF EXISTS `tm_minggu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tm_minggu` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `minggu_ke` tinyint(3) unsigned NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `tm_tahun_ajaran_id` tinyint(3) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tm_minggu_tm_tahun_ajaran_id_foreign` (`tm_tahun_ajaran_id`),
  CONSTRAINT `tm_minggu_tm_tahun_ajaran_id_foreign` FOREIGN KEY (`tm_tahun_ajaran_id`) REFERENCES `tm_tahun_ajaran` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tm_minggu`
--

LOCK TABLES `tm_minggu` WRITE;
/*!40000 ALTER TABLE `tm_minggu` DISABLE KEYS */;
INSERT INTO `tm_minggu` VALUES
(21,1,'2022-09-05','2022-09-10',5,'2022-09-02 14:51:21','2022-09-02 14:51:21',NULL),
(22,2,'2022-09-12','2022-09-17',5,'2022-09-02 14:56:57','2022-09-02 14:56:57',NULL),
(23,3,'2022-09-19','2022-09-24',5,'2022-09-02 14:58:11','2022-09-02 14:58:11',NULL),
(24,4,'2022-09-26','2022-10-01',5,'2022-09-02 15:30:03','2022-09-02 15:30:03',NULL),
(25,5,'2022-10-03','2022-10-08',5,'2022-09-02 15:32:31','2022-09-02 15:32:31',NULL),
(26,6,'2022-10-10','2022-10-15',5,'2022-09-02 15:32:59','2022-09-02 15:32:59',NULL),
(27,7,'2022-10-17','2022-10-22',5,'2022-09-02 15:33:22','2022-09-02 15:33:22',NULL),
(28,8,'2022-10-24','2022-10-29',5,'2022-09-02 15:34:09','2022-09-02 15:34:09','UJIAN TENGAH SEMESTER'),
(29,9,'2022-10-31','2022-11-05',5,'2022-09-02 15:34:41','2022-09-02 15:34:41',NULL),
(30,10,'2022-11-07','2022-11-12',5,'2022-09-02 15:35:44','2022-09-02 15:35:44',NULL),
(31,11,'2022-11-14','2022-11-19',5,'2022-09-02 15:36:38','2022-09-02 15:36:38',NULL),
(32,12,'2022-11-21','2022-11-26',5,'2022-09-02 15:39:43','2022-09-02 15:39:43',NULL),
(33,13,'2022-11-28','2022-12-03',5,'2022-09-02 15:44:12','2022-09-02 15:44:12',NULL),
(34,14,'2022-12-05','2022-12-10',5,'2022-09-02 15:45:36','2022-09-02 15:45:36',NULL),
(35,15,'2022-12-12','2022-12-17',5,'2022-09-02 15:46:21','2022-09-02 15:46:21',NULL),
(36,16,'2022-12-19','2022-12-24',5,'2022-09-02 15:49:21','2022-09-02 15:50:24','UJIAN AKHIR SEMESTER'),
(37,1,'2024-06-10','2024-06-14',6,'2024-06-13 02:23:56','2024-06-13 02:23:56','Minggu 1');
/*!40000 ALTER TABLE `tm_minggu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tm_program_studi`
--

DROP TABLE IF EXISTS `tm_program_studi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tm_program_studi` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(12) DEFAULT NULL,
  `program_studi` varchar(64) NOT NULL,
  `tm_jurusan_id` tinyint(3) unsigned NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tm_program_studi_tm_jurusan_id_foreign` (`tm_jurusan_id`),
  KEY `tm_program_studi_user_id_foreign` (`user_id`),
  CONSTRAINT `tm_program_studi_tm_jurusan_id_foreign` FOREIGN KEY (`tm_jurusan_id`) REFERENCES `tm_jurusan` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tm_program_studi_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tm_program_studi`
--

LOCK TABLES `tm_program_studi` WRITE;
/*!40000 ALTER TABLE `tm_program_studi` DISABLE KEYS */;
INSERT INTO `tm_program_studi` VALUES
(3,'PL17.3.5.1','Manajemen Informatika',8,1,'2022-05-10 04:20:48','2022-05-10 04:20:48'),
(4,'PL17.3.5.2','Teknik Komputer',8,1,'2022-05-10 04:21:06','2022-05-10 04:21:06'),
(5,'PL17.3.5.3','Teknik Informatika',8,1,'2022-05-10 04:21:49','2022-05-10 04:21:49'),
(8,'PL17.3.5.4','Teknik Komputer WXIT',8,1,'2022-09-03 12:07:38','2022-09-03 12:07:38'),
(9,'PL17.3.5.5','Manajemen Informatika - Internasional',8,1,'2022-09-03 12:09:32','2022-09-03 12:09:32'),
(10,'PL17.3.5.6','Teknik Informatika - Internasional',8,1,'2022-09-03 12:10:17','2022-09-03 12:10:17'),
(11,'PL17.3.5.7','Teknik Informatika - Bondowoso',8,1,'2022-09-03 12:11:20','2022-09-03 12:11:20'),
(12,'PL17.3.5.8','Teknik Informatika - PSDKU Nganjuk',8,1,'2022-09-03 12:12:27','2022-09-03 12:12:27'),
(13,'PL17.3.5.9','Teknik Informatika - PSDKU Sidoarjo',8,1,'2022-09-03 12:13:14','2022-09-03 12:13:14'),
(14,'PL17.3.5.10','Teknik Informatika - Program Lintas Jenjang (PLJ)',8,1,'2022-09-03 12:14:07','2022-09-03 12:14:07'),
(15,'PL17.3.5.11','Bisnis Digital',8,1,'2022-09-03 12:15:38','2022-09-03 12:15:38');
/*!40000 ALTER TABLE `tm_program_studi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tm_satuan`
--

DROP TABLE IF EXISTS `tm_satuan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tm_satuan` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `satuan` varchar(64) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tm_satuan_user_id_foreign` (`user_id`),
  CONSTRAINT `tm_satuan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tm_satuan`
--

LOCK TABLES `tm_satuan` WRITE;
/*!40000 ALTER TABLE `tm_satuan` DISABLE KEYS */;
INSERT INTO `tm_satuan` VALUES
(1,'Lembar',1,'2024-03-08 00:00:00','2024-03-08 00:00:00'),
(2,'Rim',1,'2022-06-20 07:50:48','2022-06-20 07:50:48'),
(3,'Dus',1,'2022-06-30 14:48:25','2022-06-30 14:48:25'),
(4,'pcs',1,'2022-07-02 14:07:49','2022-07-02 14:07:49'),
(5,'pack',1,'2022-07-02 14:08:18','2022-07-02 14:08:18'),
(6,'unit',1,'2022-08-28 07:04:22','2022-08-28 07:04:22'),
(7,'buah',1,'2022-08-28 07:04:35','2022-08-28 07:04:35'),
(8,'Meter',96,'2022-10-10 03:43:39','2022-10-10 03:43:39'),
(9,'Bendel',96,'2022-11-14 01:45:34','2022-11-14 01:45:34');
/*!40000 ALTER TABLE `tm_satuan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tm_semester`
--

DROP TABLE IF EXISTS `tm_semester`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tm_semester` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `semester` tinyint(3) unsigned NOT NULL,
  `is_genap` tinyint(1) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tm_tahun_ajaran_id` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tm_semester_user_id_foreign` (`user_id`),
  KEY `tm_semester_tm_tahun_ajaran_id_foreign` (`tm_tahun_ajaran_id`),
  CONSTRAINT `tm_semester_tm_tahun_ajaran_id_foreign` FOREIGN KEY (`tm_tahun_ajaran_id`) REFERENCES `tm_tahun_ajaran` (`id`) ON DELETE SET NULL,
  CONSTRAINT `tm_semester_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tm_semester`
--

LOCK TABLES `tm_semester` WRITE;
/*!40000 ALTER TABLE `tm_semester` DISABLE KEYS */;
INSERT INTO `tm_semester` VALUES
(1,18,1,1,'2022-05-10 08:48:20','2022-10-06 02:29:42',4),
(2,2,1,1,'2022-05-10 08:48:42','2022-05-10 08:48:42',4),
(3,3,0,1,'2022-05-10 08:48:52','2022-05-10 08:48:52',3),
(4,4,1,1,'2022-05-10 08:49:01','2022-05-10 08:49:01',4),
(5,5,0,1,'2022-05-10 08:49:11','2022-05-10 08:49:11',3),
(6,6,1,1,'2022-05-10 08:49:21','2022-05-10 08:49:21',4),
(7,7,0,1,'2022-05-10 08:49:31','2022-05-10 08:49:31',3),
(8,8,1,1,'2022-05-10 08:49:44','2022-05-10 08:49:44',4),
(9,1,0,1,'2022-05-11 08:38:18','2022-05-11 08:38:18',5),
(10,2,1,1,'2022-05-11 08:38:27','2022-05-11 08:38:27',6),
(11,3,0,1,'2022-05-11 08:38:36','2022-05-11 08:38:36',5),
(12,4,1,1,'2022-07-02 15:14:22','2022-07-02 15:14:22',6),
(13,5,0,1,'2022-05-11 08:38:57','2022-05-11 08:38:57',5),
(14,6,1,1,'2022-05-11 08:39:13','2022-05-11 08:39:13',6),
(15,7,0,1,'2022-05-11 08:39:29','2022-05-11 08:39:29',5),
(16,8,1,1,'2022-05-11 08:39:56','2022-05-31 08:06:46',6),
(17,1,0,1,'2024-06-13 06:15:57','2024-06-13 06:15:57',7);
/*!40000 ALTER TABLE `tm_semester` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tm_staff`
--

DROP TABLE IF EXISTS `tm_staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tm_staff` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(32) DEFAULT NULL,
  `nama` varchar(64) NOT NULL,
  `email` varchar(64) DEFAULT NULL,
  `no_hp` varchar(32) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `is_aktif` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tm_status_kepegawaian_id` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tm_staff_tm_status_kepegawaian_id_foreign` (`tm_status_kepegawaian_id`),
  CONSTRAINT `tm_staff_tm_status_kepegawaian_id_foreign` FOREIGN KEY (`tm_status_kepegawaian_id`) REFERENCES `tm_status_kepegawaian` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tm_staff`
--

LOCK TABLES `tm_staff` WRITE;
/*!40000 ALTER TABLE `tm_staff` DISABLE KEYS */;
INSERT INTO `tm_staff` VALUES
(1,'198911092013041001','Novianto Hadi Raharjo','novianto_hadi@polije.ac.id','08980403048','h71ppH5t20221006142152.jpg',1,'2022-04-20 11:39:14','2022-10-06 14:21:52',3),
(4,NULL,'Alwan Abdurahman','alwan_abdurahman@gmail.com',NULL,NULL,1,'2021-07-08 10:42:25','2021-07-08 10:46:00',1),
(5,NULL,'Luluk Cahyo Wiyono','luluk_cahyo_wiyono@gmail.com',NULL,NULL,1,'2021-07-08 10:43:24','2021-07-08 10:46:18',1),
(6,'198807022019031010','Husin','husin@gmail.com',NULL,'6X4lNfWs20210719021041.png',1,'2021-07-08 10:47:01','2021-07-19 02:10:41',1),
(7,NULL,'Intan Sulistyaningrum Sakkinah','intan_sulistyaningrum_sakkinah@gmail.com',NULL,'5QYqMiAn20210719022755.png',1,'2021-07-08 10:58:25','2021-07-19 02:27:55',1),
(8,'198106152006041002','Syamsul Arifin','syamsul_arifin@polije.ac.id',NULL,'2uNfVhzW20210719020707.png',1,'2021-07-08 11:00:05','2021-08-13 14:53:30',1),
(9,'197709292005011003','Didit Rahmat Hartadi','didit_rahmat_hartadi@gmail.com',NULL,'EfHffpHt20210719020908.png',1,'2021-07-08 11:01:37','2021-07-19 02:09:08',1),
(10,NULL,'Nanik Anita Mukhlisoh','nanik_anita_mukhlisoh@gmail.com',NULL,'vymahzc120210719022733.png',1,'2021-07-08 11:03:08','2021-07-19 02:27:33',1),
(11,'198302032006041003','Hendra Yufit Riskiawan','hendrayufit@polije.ac.id',NULL,'VXCUZWhW20210719015928.png',1,'2021-07-08 11:03:50','2022-10-10 01:45:46',1),
(12,NULL,'Mukhamad Angga Gumilang','mukhamad_angga_gumilang@gmail.com',NULL,'Sb8Nbt8a20210719022608.png',1,'2021-07-08 11:05:43','2021-07-19 02:26:08',1),
(13,'197808192005012001','Ika Widiastuti','ika_widiastuti@gmail.com',NULL,'XxeK4Hav20210719020736.png',1,'2021-07-08 11:07:00','2021-07-19 02:07:36',1),
(14,NULL,'Ratih Ayuninghemi','ratih_ayuninghemi@gmail.com',NULL,'ZfQZ5M4820210719022145.png',1,'2021-07-08 11:07:59','2021-07-19 02:21:45',1),
(15,'197306172018051001','Ely Mulyadi','ely_mulyadi@gmail.com',NULL,'GYQz2NuO20210719020503.png',1,'2021-07-08 11:08:54','2021-07-19 02:05:03',1),
(16,NULL,'Bakhtiyar Hadi Prakoso','bakhtiyar_hadi_prakoso@gmail.com',NULL,NULL,1,'2021-07-08 11:10:34','2021-07-08 11:10:34',1),
(17,NULL,'Choirul Huda','choirul_huda@gmail.com',NULL,'IJvQnjri20210719023112.png',1,'2021-07-08 11:11:26','2021-07-19 02:31:12',1),
(18,NULL,'Surateno','surateno@gmail.com',NULL,'m4TKxLtG20210719021217.jpg',1,'2021-07-08 11:12:16','2021-07-19 02:12:17',1),
(19,NULL,'Dia Bitari Mei Yuana','dia_bitari@polije.ac.id',NULL,'VDTugQk720210719023028.png',1,'2021-07-11 05:51:07','2021-07-19 02:30:28',1),
(20,'199104292019031011','Faisal Lutfi Afriansyah','faisal_lutfi@polije.ac.id',NULL,'SYjG2pTW20210719020527.png',1,'2021-07-11 05:52:02','2021-07-19 02:05:27',1),
(21,'198903292019031007','Taufiq Rizaldi','taufiq_rizaldi@polije.ac.id',NULL,'zGPsamBP20210719021026.png',1,'2021-07-11 05:52:49','2021-07-19 02:10:26',1),
(22,NULL,'Arvita Agus Kurniasari','arvita_agus@polije.ac.id',NULL,'hCHgy6Dh20210719022825.png',1,'2021-07-11 05:53:32','2021-07-19 02:28:25',1),
(23,NULL,'I GEDE WIRYAWAN','i_gede_wiryawan@polije.ac.id',NULL,'tDxdJtKQ20210719022526.png',1,'2021-07-11 05:54:55','2021-07-19 02:25:26',1),
(24,'198804042020122013','Pramuditha Shinta Dewi Puspitasari','pramuditha_shinta@polije.ac.id',NULL,'6y2CYu2220210719021145.png',1,'2021-07-11 05:56:05','2021-07-19 02:11:45',1),
(25,NULL,'MUHAMMAD YUNUS','muhammad_yunus@polije.ac.id',NULL,NULL,1,'2021-07-11 05:56:43','2021-07-11 05:56:43',1),
(26,'198005172008121002','Dwi Putro Sarwo Setyohadi','dwi_putro@polije.ac.id',NULL,'0vjWJlXw20210719020840.png',1,'2021-07-11 05:57:32','2021-07-19 02:08:40',1),
(27,'198301092018031001','Hermawan Arief P','hermawan_arief@polije.ac.id',NULL,'KbcHjmwC20210719021010.png',1,'2021-07-11 05:58:20','2021-07-19 02:10:10',1),
(28,NULL,'Lukie Perdanasari','lukie_perdanasari@polije.ac.id',NULL,'Jl076awv20210719022810.png',1,'2021-07-11 05:59:10','2021-07-19 02:28:10',1),
(29,'197104082001121003','Wahyu Kurnia Dewanto','wahyu_kurnia@polije.ac.id',NULL,'DpyoRB2420210719015831.jpg',1,'2021-07-11 06:09:05','2021-07-19 01:58:31',1),
(30,NULL,'Moch.Munih Dian W','moch.munih_dian@polije.ac.id',NULL,'0dqNAJRW20210719022021.png',1,'2021-07-11 06:09:41','2021-07-19 02:20:21',1),
(31,NULL,'Agus Hariyanto','agus_hariyanto@polije.ac.id',NULL,'qP7YKjSi20210719021239.png',1,'2021-07-11 06:11:58','2021-07-19 02:12:39',1),
(32,NULL,'Denny Wijanarko','denny_wijanarko@polije.ac.id',NULL,'dnEkUU9720210719021455.png',1,'2021-07-11 06:12:28','2021-07-19 02:14:55',1),
(33,'19700929 200312 1 001','Yogiswara','yogiswara@polije.ac.id',NULL,'nRl44FyN20210719021533.png',1,'2021-07-11 06:13:15','2022-11-24 09:55:05',1),
(34,NULL,'Bekti Maryuni Susanto','bekti_maryuni@polije.ac.id',NULL,'w1Nq6Ya520210719021651.png',1,'2021-07-11 06:14:11','2021-07-19 02:16:51',1),
(35,NULL,'Putri Santika','putri_santika@polije.ac.id',NULL,NULL,1,'2021-07-11 06:14:43','2021-07-11 06:14:43',1),
(36,'19780816 200501 1 002','Beni Widiawan','beni_widiawan@polije.ac.id',NULL,'6WAZDznS20210719021513.png',1,'2021-07-11 06:16:55','2022-11-24 11:46:36',1),
(37,NULL,'Agus Purwadi','agus_purwadi@polije.ac.id',NULL,'URbuiSJV20210719021635.png',1,'2021-07-11 06:17:24','2021-07-19 02:16:35',1),
(38,NULL,'Syamsiar Kautsar','syamsiar_kautsar@polije.ac.id',NULL,NULL,1,'2021-07-11 06:18:00','2021-07-11 06:18:00',1),
(39,NULL,'Victor Phoa','victor_phoa@polije.ac.id',NULL,'nr8U8ECG20210719021710.png',1,'2021-07-11 06:18:47','2021-07-19 02:17:10',1),
(40,'19701128 200312 1 001','Hariyono Rakhmad','hariyono_rakhmad@polije.ac.id',NULL,'KoE5Iss120210719021437.png',1,'2021-07-11 06:19:17','2022-11-24 09:55:21',1),
(41,NULL,'Shabrina Choirunnisa','shabrina_choirunnisa@polije.ac.id',NULL,'RnC0rUjh20210719022850.png',1,'2021-07-11 06:25:54','2021-07-19 02:28:50',1),
(42,NULL,'Lalitya Nindita Sahenda','lalitya_nindita@polije.ac.id',NULL,'BFmdWXv320210719021732.png',1,'2021-07-11 06:26:38','2021-07-19 02:17:32',1),
(43,NULL,'Zainul Hakim','zainul_hakim@polije.ac.id',NULL,NULL,1,'2021-07-11 06:32:28','2021-07-11 06:32:28',1),
(44,NULL,'R. Agus Sariono','r_agus_sariono@polije.ac.id',NULL,NULL,1,'2021-07-11 06:33:03','2021-07-11 06:33:03',1),
(45,NULL,'GULLIT TORNADO TAUFAN','gullit_tornado@polije.ac.id',NULL,NULL,1,'2021-07-11 06:33:43','2021-07-11 06:33:43',1),
(46,NULL,'Ghanesya Hari Murti','ghanesya_hari@polije.ac.id',NULL,NULL,1,'2021-07-11 06:34:18','2021-07-11 06:34:18',1),
(47,NULL,'Adi Heru Utomo','adi_heru@polije.ac.id',NULL,'HhuNd4Dy20210719021939.png',1,'2021-07-11 06:35:20','2021-07-19 02:19:39',1),
(48,NULL,'Zilvanhisna Emka Fitri','zilvanhisna_emka@polije.ac.id',NULL,'cahHS1ga20210719022433.png',1,'2021-07-11 06:36:01','2021-07-19 02:24:33',1),
(49,NULL,'Aji Seto Arifianto','aji_seto@polije.ac.id',NULL,'zuIxbsSU20210719020311.jpg',1,'2021-07-11 06:36:52','2021-07-19 02:03:11',1),
(50,NULL,'Denny Trias Utomo','denny_trias@polije.ac.id',NULL,'Dw5ZaVgM20210719023006.png',1,'2021-07-11 06:37:41','2021-07-19 02:30:06',1),
(51,NULL,'Prawidya Destarianto','prawidya_destarianto@polije.ac.id',NULL,'tKHS4dSD20210719021955.jpg',1,'2021-07-11 06:38:14','2021-07-19 02:19:55',1),
(52,'19920528 201803 2 001','Bety Etikasari','bety_etikasari@polije.ac.id',NULL,'qNjtb0SF20210711071927.png',1,'2021-07-11 06:38:52','2022-11-17 06:00:13',1),
(53,NULL,'Nugroho Setyo Wibowo','nugroho_setyo@polije.ac.id',NULL,'Yq9qF6nt20210719021918.jpg',1,'2021-07-11 06:39:25','2021-07-19 02:19:18',1),
(54,NULL,'Lukman Hakim','lukman_hakim@polije.ac.id',NULL,'WF9MWFbX20210719023055.png',1,'2021-07-11 06:40:18','2021-07-19 02:30:55',1),
(55,NULL,'Rizki Febrian Pramudita','rizki_febrian@polije.ac.id',NULL,NULL,1,'2021-07-11 06:44:04','2021-07-11 06:44:04',1),
(56,NULL,'Elly Antika','elly_antika@polije.ac.id',NULL,'uG8sXp3w20210719022201.png',1,'2021-07-11 06:44:34','2021-07-19 02:22:01',1),
(57,NULL,'Mudafiq Riyan Pratama','mudafiq_riyan@polije.ac.id',NULL,NULL,1,'2021-07-11 06:45:12','2021-07-11 06:45:12',1),
(58,NULL,'Ery Setiyawan Jullev Atmaji','ery_setiyawan@polije.ac.id',NULL,'Dc5jVTi420210719022456.png',1,'2021-07-11 06:45:45','2021-07-19 02:24:56',1),
(59,'19911211 201803 1 001','Khafidurrohman Agustianto','khafidurrohman_agustianto@polije.ac.id',NULL,'yW1kJsNR20210719022355.png',1,'2021-07-11 06:46:40','2022-11-24 09:13:33',1),
(60,NULL,'Trismayanti Dwi Puspitasari','trismayanti_dwi@polije.ac.id',NULL,'wibnrr1c20210719022416.png',1,'2021-07-11 06:47:13','2022-10-04 07:53:29',1),
(61,NULL,'Andri Permana Wicaksono','andri_permana@polije.ac.id',NULL,NULL,1,'2021-07-11 06:47:53','2021-07-11 06:47:53',1),
(62,NULL,'Jumiatun','jumiatun@polije.ac.id',NULL,NULL,1,'2021-07-11 06:53:54','2021-07-11 06:53:54',1),
(63,NULL,'I Putu Dody Lesmana','dody@polije.ac.id',NULL,'GiuND4QQ20210719022226.png',1,'2021-07-11 06:57:14','2022-10-10 07:29:50',1),
(64,NULL,'Adriadi Novawan','adriadi_novawan@polije.ac.id',NULL,NULL,1,'2021-07-11 07:04:10','2021-07-11 07:04:10',1),
(65,NULL,'Ahmad Basri Saifur Rahman','ahmad_basri@polije.ac.id',NULL,NULL,1,'2021-07-11 07:08:51','2021-07-11 07:08:51',1),
(66,NULL,'Degita Danur Suharsono','degita_danur@polije.ac.id',NULL,NULL,1,'2021-07-11 07:09:24','2021-07-11 07:09:24',1),
(67,NULL,'Alfi Hidayatu Miqawati','alfi_hidayatu@polije.ac.id',NULL,NULL,1,'2021-07-11 07:10:00','2021-07-11 07:10:00',1),
(68,NULL,'Renata Kenanga Rinda','renata_kenanga@polije.ac.id',NULL,NULL,1,'2021-07-15 21:44:09','2021-07-15 21:44:09',1),
(69,NULL,'Enik Rukiati','enik_rukiati@polije.ac.id',NULL,NULL,1,'2021-07-15 21:53:06','2021-07-15 21:53:06',1),
(70,NULL,'Vigo Dewangga','vigo_dewangga@polije.ac.id',NULL,NULL,1,'2022-01-26 21:55:12','2022-01-26 21:55:12',1),
(71,NULL,'Geri Barnas Saputra','geri_barnas@polije.ac.id',NULL,NULL,1,'2022-01-26 21:56:17','2022-01-26 21:56:17',1),
(72,NULL,'Sunoko Setyawan','sunoko_setyawan@polije.ac.id',NULL,NULL,1,'2022-01-27 10:10:18','2022-01-27 10:10:18',1),
(73,NULL,'Estin Roso Pristiwaningsih','estin_roso@polije.ac.id',NULL,NULL,1,'2022-01-27 10:11:26','2022-01-27 10:11:26',1),
(74,NULL,'Rhama Wisnu Wardhana','rhama_wisnu@polije.ac.id',NULL,NULL,1,'2022-01-27 12:37:04','2022-01-27 12:37:04',1),
(75,NULL,'Dyah Aju Hermawati','dyah_ajuh@polije.ac.id',NULL,NULL,1,'2022-01-27 12:42:21','2022-01-27 12:42:21',1),
(76,NULL,'Ruqoyah Yulia Hasanah Dhomiri','ruqoyah_yuliah@polije.ac.id',NULL,NULL,1,'2022-01-27 12:43:02','2022-01-27 12:43:02',1),
(77,NULL,'Adi Sucipto','adi_sucipto@polije.ac.id',NULL,NULL,1,'2022-01-27 12:52:06','2022-01-27 12:52:06',1),
(78,NULL,'Sholihah Ayu Wulandari','sholihah_ayuw@polije.ac.id',NULL,NULL,1,'2022-01-27 12:53:58','2022-01-27 12:53:58',1),
(79,NULL,'Ikrima Halimatus Sa\'diyah','ikrima_halimatuss@polije.ac.id',NULL,NULL,1,'2022-01-27 12:55:03','2022-01-27 12:55:03',1),
(80,NULL,'Suwardi (LB)','suwardilb@polije.ac.id',NULL,NULL,1,'2022-01-27 12:57:39','2022-01-27 12:57:39',1),
(81,NULL,'Wajihudin','wajihudin@polije.ac.id',NULL,NULL,1,'2022-01-27 12:58:10','2022-01-27 12:58:10',1),
(82,NULL,'Suyik Binarkaheni','suyik_binarkaheni@polije.ac.id',NULL,NULL,1,'2022-01-27 12:59:06','2022-01-27 12:59:06',1),
(83,NULL,'Mochammad Rifki Ulil Albaab','mrifki_ulil_albaab@polije.ac.id',NULL,NULL,1,'2022-01-27 13:00:05','2022-01-27 13:00:05',1),
(84,NULL,'Suparto (Kampus Bondowoso)','suparto_bws@polije.ac.id',NULL,NULL,1,'2022-01-27 13:05:03','2022-01-27 13:05:03',1),
(85,NULL,'Suyitno','suyitno@polije.ac.id',NULL,NULL,1,'2022-01-27 13:08:19','2022-01-27 13:08:19',1),
(86,NULL,'Asmunir','asmunir@polije.ac.id',NULL,NULL,1,'2022-01-27 13:08:50','2022-01-27 13:08:50',1),
(87,NULL,'Asep Samsudin','asep_samsudin@polije.ac.id',NULL,NULL,1,'2022-01-27 13:10:56','2022-01-27 13:10:56',1),
(88,NULL,'Ratri Handayani','ratri_handayani@polije.ac.id',NULL,NULL,1,'2022-01-27 15:37:22','2022-01-27 15:37:22',1),
(89,NULL,'Moch. Rif\'an Eko Utomo','rifan@polije.ac.id','089657422001',NULL,1,'2022-07-10 21:54:11','2024-03-07 02:23:57',3),
(91,NULL,'Yunita Dwi P','yunita@polije.ac.id',NULL,'sGu1tPGf20220819090724.png',1,'2022-08-19 09:01:49','2022-08-20 13:57:54',3),
(92,NULL,'Egy','egy@polije.ac.id',NULL,NULL,1,'2022-08-22 18:38:12','2022-08-22 18:38:12',3),
(93,NULL,'Muhammad Hafidh Firmansyah','hafid_firmansyah@polije.ac.id',NULL,NULL,1,'2022-09-04 05:24:56','2022-09-04 05:24:56',1),
(94,NULL,'Yeni Arista Herdina Safitri','yeni_arista@polije.ac.id',NULL,NULL,0,'2022-09-26 07:48:13','2024-03-07 00:43:05',3),
(95,'199007062022032007','Ariyana','ariyana@polije.ac.id','085233003162','bEWP9daz20221023062950.jpg',1,'2022-09-26 07:49:49','2022-10-23 06:29:50',3),
(96,'199104132015101001','Appredo Probo Anugro','appredo@polije.ac.id',NULL,NULL,1,'2022-09-30 07:26:19','2022-09-30 07:26:19',3),
(97,NULL,'Cahyana Ahmad Pahlevi','cahyanapahlevi@gmail.com',NULL,NULL,0,'2022-09-30 07:46:49','2024-03-07 00:43:13',3),
(98,NULL,'Teguh Erliyan','teguh-e@polije.ac.id','081292926460',NULL,1,'2022-10-12 09:14:12','2022-10-12 09:14:12',3),
(99,'T19880109201709201','Istik Lailiah, S.Kom','istik@polije.ac.id',NULL,NULL,1,'2023-07-27 08:52:17','2023-07-27 08:52:17',3),
(100,'T19890122201709101','Muhammad Syafiq, S.Kom','msyafiq@polije.ac.id',NULL,NULL,1,'2023-07-27 08:53:11','2023-07-27 08:53:11',3),
(101,'T19911018201504101','Wahyu Dwi Permadi','wahyu_dp@polije.ac.id',NULL,NULL,1,'2023-10-30 09:20:24','2023-10-30 09:20:24',3),
(102,'199606092022031008','Riyadlus Sholihin','riyadlus_sholihin@polije.ac.id',NULL,NULL,1,'2023-10-30 09:21:30','2023-10-30 09:21:30',3),
(103,NULL,'Raihana Ariba Nurlaili','rere_jti@polije.ac.id',NULL,NULL,1,'2023-10-30 09:22:23','2023-10-30 09:22:23',3),
(104,'197612072008121001','Agus Santoso','agus_san@polije.ac.id',NULL,NULL,1,'2023-10-30 09:23:40','2023-10-30 09:23:40',3),
(105,'T19900702201603101','David Juli Ariyadi','david_juli@polije.ac.id','085258605369','8ZqUlvGk20240314075639.png',1,'2023-10-30 09:26:05','2024-03-14 07:56:39',3),
(106,NULL,'Ratna Dwi Kristina Sari','ratna_dks@polije.ac.id',NULL,NULL,1,'2023-10-30 09:27:25','2023-10-30 09:27:25',3),
(107,NULL,'Fitria \'Aziati','fitriaaziati999@gmail.com',NULL,NULL,1,'2023-10-30 09:28:47','2023-10-30 09:28:47',3),
(108,NULL,'Daniel Pugoh Wicaksono','daniel_pw@polije.ac.id',NULL,NULL,1,'2023-10-30 09:29:43','2023-10-30 09:29:43',3),
(109,NULL,'Riska Virliana Maharanti','riskavmh@gmail.com',NULL,NULL,1,'2023-10-30 09:30:36','2023-10-30 09:30:36',3),
(110,NULL,'Evan Hendra Lukito','evan_hl@polije.ac.id',NULL,NULL,1,'2023-10-30 09:31:45','2023-10-30 09:31:45',3),
(111,NULL,'Fajriansyah Decky Setiawan','fajriansyah_ds@gmail.com',NULL,NULL,1,'2023-10-30 09:32:29','2023-10-30 09:32:29',3),
(112,NULL,'Achmad Dinofaldi Firmansyah','bangik@polije.ac.id','081252367128',NULL,1,'2024-03-07 00:44:55','2024-10-05 01:54:45',3),
(113,NULL,'Bunga Prasetya Dwi Ulul Azmi','bunga@polije.ac.id','083111693588',NULL,1,'2024-03-07 00:46:44','2024-03-07 00:46:44',3),
(114,NULL,'Iphang Rere Admaja','iphang@polije.ac.id','083111529303',NULL,1,'2024-03-07 00:49:09','2024-03-07 00:49:09',3),
(115,NULL,'Shinta Destira Ayu','shinta_destira@polije.ac.id','085335102750',NULL,1,'2024-03-07 00:50:02','2024-03-07 00:53:15',3),
(116,NULL,'Yudi Sanjaya','yudi_sanjaya@polije.ac.id',NULL,NULL,1,'2024-03-07 01:33:36','2024-03-07 01:33:36',3),
(117,NULL,'Rahadian Teguh Nugroho','rahadian_teguh@polije.ac.id',NULL,NULL,1,'2024-03-07 01:52:05','2024-03-07 01:52:05',3),
(118,NULL,'Wahyu Putra Tri Mariono','wahyu_putra@polije.ac.id',NULL,NULL,1,'2024-03-07 01:52:33','2024-03-07 01:52:49',3),
(119,NULL,'Zayd Al Munshif','zayd@polije.ac.id',NULL,NULL,1,'2024-03-07 01:55:02','2024-03-07 01:55:02',3),
(120,NULL,'Achmad Syaifulloh','ach_syaifulloh@polije.ac.id',NULL,NULL,1,'2024-03-07 01:55:54','2024-03-07 01:55:54',3);
/*!40000 ALTER TABLE `tm_staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tm_status_kepegawaian`
--

DROP TABLE IF EXISTS `tm_status_kepegawaian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tm_status_kepegawaian` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `status_kepegawaian` varchar(32) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tm_status_kepegawaian`
--

LOCK TABLES `tm_status_kepegawaian` WRITE;
/*!40000 ALTER TABLE `tm_status_kepegawaian` DISABLE KEYS */;
INSERT INTO `tm_status_kepegawaian` VALUES
(1,'Dosen','2022-08-20 20:23:01','2022-08-20 20:23:01'),
(2,'Administrasi','2022-08-20 20:23:12','2022-08-20 20:23:13'),
(3,'Teknisi','2022-08-20 20:23:21','2022-08-20 20:23:21');
/*!40000 ALTER TABLE `tm_status_kepegawaian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tm_tahun_ajaran`
--

DROP TABLE IF EXISTS `tm_tahun_ajaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tm_tahun_ajaran` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `tahun_ajaran` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_genap` tinyint(3) unsigned DEFAULT NULL,
  `is_aktif` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tm_tahun_ajaran`
--

LOCK TABLES `tm_tahun_ajaran` WRITE;
/*!40000 ALTER TABLE `tm_tahun_ajaran` DISABLE KEYS */;
INSERT INTO `tm_tahun_ajaran` VALUES
(3,'2020/2021','2022-07-03 07:39:03','2022-10-04 06:03:37',0,0),
(4,'2020/2021','2022-05-31 04:33:26','2022-10-04 06:11:43',1,0),
(5,'2022/2023','2022-05-31 04:33:38','2022-10-04 06:12:24',0,0),
(6,'2022/2023','2022-07-03 07:42:45','2024-06-13 02:27:15',1,0),
(7,'2024/2025','2024-06-13 06:14:16','2024-06-13 06:14:18',0,1);
/*!40000 ALTER TABLE `tm_tahun_ajaran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tr_barang_laboratorium`
--

DROP TABLE IF EXISTS `tr_barang_laboratorium`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tr_barang_laboratorium` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `stok` int(10) unsigned NOT NULL,
  `tm_laboratorium_id` smallint(5) unsigned NOT NULL,
  `tm_barang_id` int(10) unsigned NOT NULL,
  `is_aktif` tinyint(1) unsigned NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kode` varchar(32) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tr_barang_laboratorium_tm_laboratorium_id_foreign` (`tm_laboratorium_id`),
  KEY `tr_barang_laboratorium_tm_barang_id_foreign` (`tm_barang_id`),
  CONSTRAINT `tr_barang_laboratorium_tm_barang_id_foreign` FOREIGN KEY (`tm_barang_id`) REFERENCES `tm_barang` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tr_barang_laboratorium_tm_laboratorium_id_foreign` FOREIGN KEY (`tm_laboratorium_id`) REFERENCES `tm_laboratorium` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tr_barang_laboratorium`
--

LOCK TABLES `tr_barang_laboratorium` WRITE;
/*!40000 ALTER TABLE `tr_barang_laboratorium` DISABLE KEYS */;
INSERT INTO `tr_barang_laboratorium` VALUES
(24,0,1,2,1,'2022-09-04 11:42:22','2022-10-10 04:10:03',NULL,NULL),
(25,0,1,12,1,'2022-09-04 11:42:22','2022-10-06 01:08:48',NULL,NULL),
(26,0,1,8,1,'2022-09-04 11:42:22','2022-09-27 07:28:58',NULL,NULL),
(27,0,3,1,1,'2022-09-04 14:55:48','2022-09-04 14:59:09',NULL,NULL),
(28,0,3,8,1,'2022-09-04 14:55:50','2022-09-04 14:55:50',NULL,NULL),
(29,0,3,12,1,'2022-09-04 14:55:51','2022-09-18 04:45:06',NULL,NULL),
(30,0,3,2,1,'2022-09-04 14:57:28','2022-09-18 04:45:06',NULL,NULL),
(33,0,1,18,1,'2022-09-04 15:35:45','2022-10-10 02:13:45',NULL,NULL),
(34,0,1,19,1,'2022-09-04 15:36:20','2022-09-22 10:46:22',NULL,NULL),
(35,0,1,20,1,'2022-09-04 15:36:35','2022-09-13 15:54:24',NULL,NULL),
(36,0,1,21,1,'2022-09-04 15:36:48','2022-09-28 07:37:54',NULL,NULL),
(37,0,1,22,1,'2022-09-04 15:37:05','2022-10-07 06:58:25',NULL,NULL),
(38,0,1,23,1,'2022-09-04 15:37:18','2022-10-07 06:58:25',NULL,NULL),
(39,0,1,24,1,'2022-09-04 16:39:48','2022-09-13 15:54:20',NULL,NULL),
(40,0,1,25,1,'2022-09-04 16:40:01','2022-10-07 06:58:25',NULL,NULL),
(41,0,1,26,1,'2022-09-04 16:40:15','2022-09-13 15:54:21',NULL,NULL),
(42,0,1,28,1,'2022-09-04 16:40:46','2024-03-07 02:34:45',NULL,NULL),
(43,0,3,28,1,'2022-09-07 23:27:09','2022-09-07 23:27:09',NULL,NULL),
(44,0,3,21,1,'2022-09-07 23:27:29','2022-09-07 23:27:29',NULL,NULL),
(45,0,1,29,0,'2022-09-15 01:59:40','2022-10-07 06:54:28',NULL,NULL),
(46,0,1,30,1,'2022-09-15 02:20:04','2022-09-18 17:25:37',NULL,NULL),
(47,0,1,31,1,'2022-09-15 03:42:36','2022-09-18 16:34:11',NULL,NULL),
(48,0,1,1,1,'2022-10-03 23:00:29','2022-10-03 23:25:02',NULL,NULL),
(49,0,1,3,1,'2022-10-03 23:02:29','2022-10-03 23:20:21',NULL,NULL),
(50,0,1,10,1,'2022-10-03 23:35:54','2022-10-03 23:36:11',NULL,NULL),
(51,0,1,4,1,'2022-10-04 06:03:46','2022-10-04 06:03:46',NULL,NULL),
(52,0,1,7,1,'2022-10-04 06:03:53','2022-10-04 06:03:53',NULL,NULL),
(53,0,5,3,1,'2022-10-04 09:15:05','2022-10-10 04:51:42',NULL,NULL),
(54,0,5,35,1,'2022-10-04 09:24:50','2022-10-10 05:02:10',NULL,NULL),
(55,0,5,2,1,'2022-10-04 11:54:17','2022-10-10 04:40:56',NULL,NULL),
(56,0,5,34,0,'2022-10-04 12:17:04','2022-10-04 12:17:26',NULL,NULL),
(57,0,5,31,1,'2022-10-05 03:16:11','2022-10-05 03:32:22',NULL,NULL),
(58,0,7,50,1,'2022-10-10 03:48:49','2022-10-10 03:48:49',NULL,NULL),
(59,0,7,36,1,'2022-10-10 03:49:22','2022-10-10 03:49:22',NULL,NULL),
(60,0,7,37,1,'2022-10-10 03:52:44','2022-10-10 03:52:44',NULL,NULL),
(61,0,5,7,1,'2022-10-10 04:44:13','2022-10-10 04:51:42',NULL,NULL),
(62,0,5,28,1,'2022-10-10 04:45:31','2022-10-10 04:45:31',NULL,NULL),
(63,0,6,26,1,'2022-10-12 09:19:50','2022-10-12 09:20:56',NULL,NULL),
(64,0,1,53,1,'2022-10-18 06:36:13','2022-10-18 06:38:58',NULL,NULL),
(65,0,1,51,1,'2022-10-18 06:37:12','2022-10-18 06:38:58',NULL,NULL),
(66,0,1,54,1,'2022-10-18 06:37:43','2024-03-07 02:34:38',NULL,NULL),
(67,143,8,55,1,'2022-11-14 01:47:16','2024-06-13 02:52:37',NULL,NULL),
(68,0,8,2,1,'2022-11-14 01:47:42','2024-03-07 02:30:31',NULL,NULL),
(69,0,8,3,1,'2022-11-14 01:47:53','2024-03-07 02:30:38',NULL,NULL),
(70,0,8,7,1,'2022-11-14 01:48:16','2024-03-07 02:30:51',NULL,NULL),
(71,4,8,52,0,'2022-11-15 08:08:47','2024-03-07 02:38:48',NULL,NULL),
(72,8,8,56,1,'2022-11-21 08:13:11','2024-03-07 02:39:44',NULL,NULL),
(73,0,1,59,1,'2023-03-09 01:19:12','2023-03-09 01:27:02',NULL,NULL),
(74,500,8,1,1,'2023-10-30 09:44:04','2024-06-13 02:55:00',NULL,NULL),
(75,8500,8,60,1,'2023-10-31 02:04:29','2023-10-31 02:04:29',NULL,NULL),
(76,0,8,4,1,'2023-10-31 02:06:36','2024-03-07 02:30:59',NULL,NULL),
(77,4,10,64,1,'2024-03-14 01:57:42','2024-03-14 01:57:42',NULL,NULL),
(78,1,10,63,1,'2024-03-14 02:00:15','2024-03-14 02:00:15',NULL,NULL),
(79,5,10,1,1,'2024-03-14 02:03:37','2024-03-14 02:03:37',NULL,NULL),
(80,1000,8,67,1,'2024-06-11 08:04:48','2024-06-13 02:49:51',NULL,NULL),
(81,5,8,68,0,'2024-06-11 08:05:32','2024-06-11 08:20:31',NULL,NULL),
(82,18,8,69,1,'2024-06-11 08:07:11','2024-06-11 08:07:11',NULL,NULL),
(83,3,8,71,0,'2024-06-11 08:08:13','2024-06-11 08:18:08',NULL,NULL),
(84,12,8,70,1,'2024-06-11 08:08:25','2024-06-13 02:45:09',NULL,NULL),
(85,12,8,8,1,'2024-06-13 02:39:29','2024-06-13 02:39:29',NULL,NULL),
(86,36,8,31,1,'2024-06-13 02:52:15','2024-06-13 02:52:37',NULL,NULL),
(87,100,8,16,1,'2024-06-13 06:01:55','2024-06-13 06:01:55',NULL,NULL);
/*!40000 ALTER TABLE `tr_barang_laboratorium` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tr_bon_alat`
--

DROP TABLE IF EXISTS `tr_bon_alat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tr_bon_alat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(32) DEFAULT NULL,
  `is_pegawai` tinyint(1) DEFAULT NULL,
  `tm_staff_id` int(10) unsigned DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `nim` varchar(255) DEFAULT NULL,
  `golongan_kelompok` varchar(255) DEFAULT NULL,
  `tm_laboratorium_id` smallint(5) unsigned DEFAULT NULL,
  `tanggal_pinjam` datetime DEFAULT NULL,
  `tr_member_laboratorium_id_pinjam` smallint(5) unsigned DEFAULT NULL,
  `tanggal_kembali` datetime DEFAULT NULL,
  `kembali_is_pegawai` tinyint(3) unsigned DEFAULT NULL,
  `kembali_nama` varchar(64) DEFAULT NULL,
  `kembali_nim` varchar(15) DEFAULT NULL,
  `kembali_golongan_kelompok` varchar(64) DEFAULT NULL,
  `tr_member_laboratorium_id_kembali` smallint(5) unsigned DEFAULT NULL,
  `status` tinyint(3) unsigned DEFAULT NULL COMMENT '1. Sedang Dipinjam, 2. Kembali',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kembali_tm_staff_id` int(10) unsigned DEFAULT NULL,
  `tm_staff_id_pembimbing` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tr_bon_alat_tm_staff_id_foreign` (`tm_staff_id`),
  KEY `tr_bon_alat_tr_member_laboratorium_id_pinjam_foreign` (`tr_member_laboratorium_id_pinjam`),
  KEY `tr_bon_alat_tr_member_laboratorium_id_kembali_foreign` (`tr_member_laboratorium_id_kembali`),
  KEY `tr_bon_alat_tr_laboratorium_id_foreign` (`tm_laboratorium_id`),
  CONSTRAINT `tr_bon_alat_tm_staff_id_foreign` FOREIGN KEY (`tm_staff_id`) REFERENCES `tm_staff` (`id`) ON DELETE SET NULL,
  CONSTRAINT `tr_bon_alat_tr_laboratorium_id_foreign` FOREIGN KEY (`tm_laboratorium_id`) REFERENCES `tm_laboratorium` (`id`) ON DELETE SET NULL,
  CONSTRAINT `tr_bon_alat_tr_member_laboratorium_id_kembali_foreign` FOREIGN KEY (`tr_member_laboratorium_id_kembali`) REFERENCES `tr_member_laboratorium` (`id`) ON DELETE SET NULL,
  CONSTRAINT `tr_bon_alat_tr_member_laboratorium_id_pinjam_foreign` FOREIGN KEY (`tr_member_laboratorium_id_pinjam`) REFERENCES `tr_member_laboratorium` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tr_bon_alat`
--

LOCK TABLES `tr_bon_alat` WRITE;
/*!40000 ALTER TABLE `tr_bon_alat` DISABLE KEYS */;
INSERT INTO `tr_bon_alat` VALUES
(22,'t7QEcKLA20221018063858',1,98,NULL,NULL,NULL,1,'2022-10-04 09:11:23',23,NULL,NULL,NULL,NULL,NULL,NULL,1,'2022-10-18 06:38:58','2022-10-18 06:38:58',NULL,NULL),
(23,'jOj91zxM20221018063931',1,92,NULL,NULL,NULL,1,'2022-10-18 08:01:01',23,'2022-10-18 14:00:00',1,NULL,NULL,NULL,23,2,'2022-10-18 06:39:31','2022-10-18 07:02:20',94,NULL),
(25,'iBwHujYJ20221115081455',0,NULL,'Perina Bella','E3208079','A',8,'2022-11-15 00:00:00',21,'2022-11-15 00:00:00',NULL,'Perina Bella','E3208079','A',21,2,'2022-11-15 08:14:55','2022-11-15 08:21:58',NULL,52),
(28,'cKiuUBS420221124094516',1,21,NULL,NULL,NULL,8,'2022-11-24 00:00:00',21,'2022-11-25 15:00:00',1,NULL,NULL,NULL,21,2,'2022-11-24 09:45:16','2022-11-24 12:11:02',27,NULL),
(29,'lQI6yFrl20221124121503',0,NULL,'Kartika Adi','E41202128','A',8,'2022-11-23 13:00:00',21,'2022-11-24 16:20:00',NULL,'Perina Bella','E3208079','A',21,2,'2022-11-24 12:15:03','2022-11-24 12:16:00',NULL,27),
(30,'N89a1Iil20240613024401',1,112,NULL,NULL,NULL,8,'2024-06-13 10:00:00',21,'2024-06-13 23:00:00',1,NULL,NULL,NULL,21,2,'2024-06-13 02:44:01','2024-06-13 02:45:09',112,NULL),
(31,'rd3rnBLH20240613024704',0,NULL,'bangik','E41191882','Inter',8,'2024-06-13 00:00:00',21,NULL,NULL,NULL,NULL,NULL,NULL,1,'2024-06-13 02:47:04','2024-06-13 02:47:04',NULL,112);
/*!40000 ALTER TABLE `tr_bon_alat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tr_hilang_rusak`
--

DROP TABLE IF EXISTS `tr_hilang_rusak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tr_hilang_rusak` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(32) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nim` varchar(255) NOT NULL,
  `golongan_kelompok` varchar(255) NOT NULL,
  `tanggal_sanggup` date NOT NULL,
  `tr_member_laboratorium_id` smallint(5) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(3) unsigned DEFAULT NULL,
  `tm_laboratorium_id` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tr_hilang_rusak_tr_member_laboratorium_id_foreign` (`tr_member_laboratorium_id`),
  KEY `tr_hilang_rusak_tr_laboratorium_id_foreign` (`tm_laboratorium_id`),
  CONSTRAINT `tr_hilang_rusak_tr_laboratorium_id_foreign` FOREIGN KEY (`tm_laboratorium_id`) REFERENCES `tm_laboratorium` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tr_hilang_rusak_tr_member_laboratorium_id_foreign` FOREIGN KEY (`tr_member_laboratorium_id`) REFERENCES `tr_member_laboratorium` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tr_hilang_rusak`
--

LOCK TABLES `tr_hilang_rusak` WRITE;
/*!40000 ALTER TABLE `tr_hilang_rusak` DISABLE KEYS */;
INSERT INTO `tr_hilang_rusak` VALUES
(1,'LUXvc0ir20221121042626','Perina Bella','E3208079','a','2022-11-21',21,'2022-11-21 04:26:26','2022-11-21 04:29:29',1,8),
(3,'T18iZ0xT20221124113507','Kartika Adi','E41202128','A','2022-11-30',21,'2022-11-24 11:35:07','2022-11-24 11:36:22',1,8),
(4,'dkA52IJ520240613024914','bangik','E41191882','inter','2024-06-13',21,'2024-06-13 02:49:14','2024-06-13 02:49:14',0,8),
(5,'xCx9FlRo20240613024937','bangik','E41191882','inter','2024-06-13',21,'2024-06-13 02:49:37','2024-06-13 02:49:51',1,8);
/*!40000 ALTER TABLE `tr_hilang_rusak` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tr_ijin_penggunaan_lbs`
--

DROP TABLE IF EXISTS `tr_ijin_penggunaan_lbs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tr_ijin_penggunaan_lbs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(32) DEFAULT NULL,
  `is_pegawai` tinyint(1) NOT NULL,
  `tm_staff_id` int(10) unsigned DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `nim` varchar(255) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `tm_staff_id_pembimbing` int(10) unsigned DEFAULT NULL,
  `tm_program_studi_id` smallint(5) unsigned DEFAULT NULL,
  `tr_member_laboratorium_id` smallint(5) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(3) unsigned DEFAULT NULL,
  `tm_laboratorium_id` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tr_ijin_penggunaan_lbs_tm_staff_id_foreign` (`tm_staff_id`),
  KEY `tr_ijin_penggunaan_lbs_tm_staff_id_pembimbing_foreign` (`tm_staff_id_pembimbing`),
  KEY `tr_ijin_penggunaan_lbs_tm_program_studi_id_foreign` (`tm_program_studi_id`),
  KEY `tr_ijin_penggunaan_lbs_tr_member_laboratorium_id_foreign` (`tr_member_laboratorium_id`),
  KEY `tr_ijin_penggunaan_lbs_tm_laboratorium_id_foreign` (`tm_laboratorium_id`),
  CONSTRAINT `tr_ijin_penggunaan_lbs_tm_laboratorium_id_foreign` FOREIGN KEY (`tm_laboratorium_id`) REFERENCES `tm_laboratorium` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tr_ijin_penggunaan_lbs_tm_program_studi_id_foreign` FOREIGN KEY (`tm_program_studi_id`) REFERENCES `tm_program_studi` (`id`) ON DELETE SET NULL,
  CONSTRAINT `tr_ijin_penggunaan_lbs_tm_staff_id_foreign` FOREIGN KEY (`tm_staff_id`) REFERENCES `tm_staff` (`id`) ON DELETE SET NULL,
  CONSTRAINT `tr_ijin_penggunaan_lbs_tm_staff_id_pembimbing_foreign` FOREIGN KEY (`tm_staff_id_pembimbing`) REFERENCES `tm_staff` (`id`) ON DELETE SET NULL,
  CONSTRAINT `tr_ijin_penggunaan_lbs_tr_member_laboratorium_id_foreign` FOREIGN KEY (`tr_member_laboratorium_id`) REFERENCES `tr_member_laboratorium` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tr_ijin_penggunaan_lbs`
--

LOCK TABLES `tr_ijin_penggunaan_lbs` WRITE;
/*!40000 ALTER TABLE `tr_ijin_penggunaan_lbs` DISABLE KEYS */;
INSERT INTO `tr_ijin_penggunaan_lbs` VALUES
(1,'lQOLwWE720230309012702',0,NULL,'Diella Aula Ivana Putri','E31201056','2023-03-07','2023-06-08',20,3,NULL,'2023-03-09 01:27:02','2023-03-09 01:27:02',1,1),
(2,'POnMWCfA20240613025344',1,112,NULL,NULL,'2024-06-13','2024-10-24',NULL,NULL,NULL,'2024-06-13 02:53:44','2024-06-13 02:53:44',1,8),
(3,'xNtV6VWg20240613025500',0,NULL,'bangik','E41191882','2024-06-13','2024-06-13',112,5,NULL,'2024-06-13 02:55:00','2024-06-13 02:55:00',1,8);
/*!40000 ALTER TABLE `tr_ijin_penggunaan_lbs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tr_kajur`
--

DROP TABLE IF EXISTS `tr_kajur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tr_kajur` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `tm_jurusan_id` tinyint(3) unsigned NOT NULL,
  `tm_staff_id` int(10) unsigned NOT NULL,
  `is_aktif` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tr_kajur_tm_jurusan_id_foreign` (`tm_jurusan_id`),
  KEY `tr_kajur_tm_staff_id_foreign` (`tm_staff_id`),
  CONSTRAINT `tr_kajur_tm_jurusan_id_foreign` FOREIGN KEY (`tm_jurusan_id`) REFERENCES `tm_jurusan` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tr_kajur_tm_staff_id_foreign` FOREIGN KEY (`tm_staff_id`) REFERENCES `tm_staff` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tr_kajur`
--

LOCK TABLES `tr_kajur` WRITE;
/*!40000 ALTER TABLE `tr_kajur` DISABLE KEYS */;
INSERT INTO `tr_kajur` VALUES
(1,8,11,1,'2022-08-20 20:56:28','2022-08-20 20:56:28');
/*!40000 ALTER TABLE `tr_kajur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tr_kaprodi`
--

DROP TABLE IF EXISTS `tr_kaprodi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tr_kaprodi` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `tm_program_studi_id` smallint(5) unsigned NOT NULL,
  `tm_staff_id` int(10) unsigned NOT NULL,
  `is_aktif` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tr_kaprodi_tm_program_studi_id_foreign` (`tm_program_studi_id`),
  KEY `tr_kaprodi_tm_staff_id_foreign` (`tm_staff_id`),
  CONSTRAINT `tr_kaprodi_tm_program_studi_id_foreign` FOREIGN KEY (`tm_program_studi_id`) REFERENCES `tm_program_studi` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tr_kaprodi_tm_staff_id_foreign` FOREIGN KEY (`tm_staff_id`) REFERENCES `tm_staff` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tr_kaprodi`
--

LOCK TABLES `tr_kaprodi` WRITE;
/*!40000 ALTER TABLE `tr_kaprodi` DISABLE KEYS */;
INSERT INTO `tr_kaprodi` VALUES
(1,3,21,0,'2022-08-20 22:04:44','2022-08-21 06:57:28'),
(3,3,27,0,'2022-08-21 06:57:28','2022-08-21 07:07:15'),
(5,3,21,0,'2022-08-21 07:07:15','2022-08-21 07:40:56'),
(6,4,33,1,'2022-08-21 07:07:41','2022-08-21 07:07:41'),
(7,3,13,0,'2022-08-21 07:40:57','2022-09-03 12:05:54'),
(8,5,60,1,'2022-08-21 07:41:10','2022-08-21 07:41:10'),
(9,3,21,0,'2022-09-03 12:05:54','2022-10-04 04:41:56'),
(10,8,33,1,'2022-09-03 12:07:39','2022-09-03 12:07:39'),
(11,9,21,1,'2022-09-03 12:09:33','2022-09-03 12:09:33'),
(12,10,60,1,'2022-09-03 12:10:18','2022-09-03 12:10:18'),
(13,11,60,1,'2022-09-03 12:11:21','2022-09-03 12:11:21'),
(14,12,60,1,'2022-09-03 12:12:28','2022-09-03 12:12:28'),
(15,13,50,1,'2022-09-03 12:13:15','2022-09-03 12:13:15'),
(16,14,60,1,'2022-09-03 12:14:08','2022-09-03 12:14:08'),
(17,15,10,1,'2022-09-03 12:15:39','2022-09-03 12:15:39'),
(18,3,21,1,'2022-10-04 04:41:56','2022-10-04 04:41:56');
/*!40000 ALTER TABLE `tr_kaprodi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tr_kartu_stok`
--

DROP TABLE IF EXISTS `tr_kartu_stok`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tr_kartu_stok` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tr_barang_laboratorium_id` int(10) unsigned NOT NULL,
  `is_stok_in` tinyint(1) NOT NULL,
  `qty` int(10) unsigned NOT NULL DEFAULT 0,
  `stok` int(10) unsigned NOT NULL,
  `tr_member_laboratorium_id` smallint(5) unsigned DEFAULT NULL,
  `tr_usulan_kebutuhan_detail_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kode` varchar(32) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `keterangan_sys` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tr_kartu_stok_tr_member_laboratorium_id_foreign` (`tr_member_laboratorium_id`),
  KEY `tr_kartu_stok_tr_barang_laboratorium_id_foreign` (`tr_barang_laboratorium_id`),
  KEY `tr_kartu_stok_tr_usulan_kebutuhan_detail_id_foreign` (`tr_usulan_kebutuhan_detail_id`),
  CONSTRAINT `tr_kartu_stok_tr_barang_laboratorium_id_foreign` FOREIGN KEY (`tr_barang_laboratorium_id`) REFERENCES `tr_barang_laboratorium` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tr_kartu_stok_tr_member_laboratorium_id_foreign` FOREIGN KEY (`tr_member_laboratorium_id`) REFERENCES `tr_member_laboratorium` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tr_kartu_stok_tr_usulan_kebutuhan_detail_id_foreign` FOREIGN KEY (`tr_usulan_kebutuhan_detail_id`) REFERENCES `tr_usulan_kebutuhan_detail` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=378 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tr_kartu_stok`
--

LOCK TABLES `tr_kartu_stok` WRITE;
/*!40000 ALTER TABLE `tr_kartu_stok` DISABLE KEYS */;
INSERT INTO `tr_kartu_stok` VALUES
(293,42,1,3,3,23,NULL,'2022-10-18 06:34:12','2022-10-18 06:34:12',NULL,NULL,NULL),
(294,64,1,4,4,23,NULL,'2022-10-18 06:36:13','2022-10-18 06:36:13',NULL,NULL,NULL),
(295,65,1,2,2,23,NULL,'2022-10-18 06:37:12','2022-10-18 06:37:12',NULL,NULL,NULL),
(296,66,1,2,2,23,NULL,'2022-10-18 06:37:43','2022-10-18 06:37:43',NULL,NULL,NULL),
(297,64,0,4,0,23,NULL,'2022-10-18 06:38:58','2022-10-18 06:38:58',NULL,NULL,NULL),
(298,65,0,2,0,23,NULL,'2022-10-18 06:38:58','2022-10-18 06:38:58',NULL,NULL,NULL),
(299,42,0,1,2,23,NULL,'2022-10-18 06:39:31','2022-10-18 06:39:31',NULL,NULL,NULL),
(300,42,1,1,3,23,NULL,'2022-10-18 07:02:20','2022-10-18 07:02:20',NULL,'23#36#bon alat - kembali',NULL),
(301,67,1,200,200,21,NULL,'2022-11-14 01:47:16','2022-11-14 01:47:16',NULL,NULL,NULL),
(302,68,1,2500,2500,21,NULL,'2022-11-14 01:47:42','2022-11-14 01:47:42',NULL,NULL,NULL),
(303,69,1,2500,2500,21,NULL,'2022-11-14 01:47:53','2022-11-14 01:47:53',NULL,NULL,NULL),
(304,70,1,10,10,21,NULL,'2022-11-14 01:48:16','2022-11-14 01:48:16',NULL,NULL,NULL),
(305,67,0,50,150,21,NULL,'2022-11-14 01:51:42','2022-11-14 01:51:42',NULL,NULL,NULL),
(306,70,0,2,8,21,NULL,'2022-11-14 01:51:42','2022-11-14 01:51:42',NULL,NULL,NULL),
(307,71,1,2,2,21,NULL,'2022-11-15 08:08:47','2022-11-15 08:08:47',NULL,NULL,NULL),
(308,71,0,1,1,21,NULL,'2022-11-15 08:10:45','2022-11-15 08:10:45',NULL,NULL,NULL),
(309,71,0,1,0,21,NULL,'2022-11-15 08:14:55','2022-11-15 08:14:55',NULL,NULL,NULL),
(310,71,1,1,1,21,NULL,'2022-11-15 08:21:58','2022-11-15 08:21:58',NULL,'25#38#bon alat - kembali',NULL),
(311,71,0,1,0,21,NULL,'2022-11-21 01:47:25','2022-11-21 01:47:25',NULL,NULL,NULL),
(312,71,1,1,1,21,NULL,'2022-11-21 01:49:02','2022-11-21 01:49:02',NULL,'311# was deleted',NULL),
(313,71,1,1,2,21,NULL,'2022-11-21 04:29:29','2022-11-21 04:29:29',NULL,NULL,NULL),
(314,72,1,2,2,21,NULL,'2022-11-21 08:13:11','2022-11-21 08:13:11',NULL,NULL,NULL),
(315,72,1,3,5,21,NULL,'2022-11-21 08:14:41','2024-03-07 02:39:44',NULL,'Serah Terima Hasil Praktek Dihapus, Stok Out id 346',NULL),
(316,67,1,2,152,21,NULL,'2022-11-21 08:15:55','2024-03-07 02:39:44',NULL,'Serah Terima Bahan Praktek Dihapus, Stok Out id 345',NULL),
(317,68,1,10,2510,21,NULL,'2022-11-24 03:45:11','2022-11-24 03:45:11',NULL,NULL,NULL),
(318,72,1,1,6,21,NULL,'2022-11-24 03:45:11','2022-11-24 03:45:11',NULL,NULL,NULL),
(319,71,0,1,1,21,NULL,'2022-11-24 09:16:55','2022-11-24 09:16:55',NULL,NULL,NULL),
(320,71,1,1,2,21,NULL,'2022-11-24 09:32:27','2022-11-24 09:32:27',NULL,'319# was deleted',NULL),
(321,71,0,1,1,21,NULL,'2022-11-24 09:45:16','2022-11-24 09:45:16',NULL,NULL,NULL),
(322,71,0,1,0,21,NULL,'2022-11-24 11:02:41','2022-11-24 11:03:33',NULL,'Barang Untuk Ijin Penggunaan LBS Dihapus, Stok Out in 323',NULL),
(323,71,1,1,1,21,NULL,'2022-11-24 11:03:33','2022-11-24 11:03:33',NULL,NULL,NULL),
(324,71,0,1,0,21,NULL,'2022-11-24 11:11:43','2024-03-07 02:38:38',NULL,'Barang Untuk Ijin Penggunaan LBS Dihapus, Stok Out in 343',NULL),
(325,71,1,1,1,21,NULL,'2022-11-24 11:36:22','2022-11-24 11:36:22',NULL,NULL,NULL),
(326,68,1,5,2515,21,NULL,'2022-11-24 11:45:39','2022-11-24 11:45:39',NULL,NULL,NULL),
(327,72,1,5,11,21,NULL,'2022-11-24 11:45:40','2022-11-24 11:45:40',NULL,NULL,NULL),
(328,71,1,1,2,21,NULL,'2022-11-24 12:11:02','2022-11-24 12:11:02',NULL,'28#41#bon alat - kembali',NULL),
(329,71,0,1,1,21,NULL,'2022-11-24 12:15:03','2022-11-24 12:15:03',NULL,NULL,NULL),
(330,71,1,1,2,21,NULL,'2022-11-24 12:16:00','2022-11-24 12:16:00',NULL,'29#42#bon alat - kembali',NULL),
(331,73,1,1,1,23,NULL,'2023-03-09 01:19:12','2023-03-09 01:19:12',NULL,NULL,NULL),
(332,73,0,1,0,23,NULL,'2023-03-09 01:27:02','2023-03-09 01:27:02',NULL,NULL,NULL),
(333,74,1,0,0,44,NULL,'2023-10-30 09:44:04','2023-10-30 09:44:04',NULL,NULL,NULL),
(334,75,1,8500,8500,44,NULL,'2023-10-31 02:04:29','2023-10-31 02:04:29',NULL,NULL,NULL),
(335,76,1,3500,3500,44,NULL,'2023-10-31 02:06:36','2023-10-31 02:06:36',NULL,NULL,NULL),
(336,67,0,112,40,44,NULL,'2023-11-16 00:51:42','2023-11-16 00:51:42',NULL,NULL,'Perubahan Stok Oleh Novianto Hadi Raharjo'),
(337,68,0,2515,0,21,NULL,'2024-03-07 02:30:31','2024-03-07 02:30:31',NULL,NULL,'Perubahan Stok Oleh Ariyana'),
(338,69,0,2500,0,21,NULL,'2024-03-07 02:30:38','2024-03-07 02:30:38',NULL,NULL,'Perubahan Stok Oleh Ariyana'),
(339,70,0,8,0,21,NULL,'2024-03-07 02:30:51','2024-03-07 02:30:51',NULL,NULL,'Perubahan Stok Oleh Ariyana'),
(340,76,0,3500,0,21,NULL,'2024-03-07 02:30:59','2024-03-07 02:30:59',NULL,NULL,'Perubahan Stok Oleh Ariyana'),
(341,66,0,2,0,51,NULL,'2024-03-07 02:34:38','2024-03-07 02:34:38',NULL,NULL,NULL),
(342,42,0,3,0,51,NULL,'2024-03-07 02:34:45','2024-03-07 02:34:45',NULL,NULL,NULL),
(343,71,1,1,3,21,NULL,'2024-03-07 02:38:38','2024-03-07 02:38:38',NULL,NULL,NULL),
(344,71,1,1,4,21,NULL,'2024-03-07 02:38:48','2024-03-07 02:38:48',NULL,'308# was deleted',NULL),
(345,67,0,2,38,21,NULL,'2024-03-07 02:39:44','2024-03-07 02:39:44',NULL,NULL,NULL),
(346,72,0,3,8,21,NULL,'2024-03-07 02:39:44','2024-03-07 02:39:44',NULL,NULL,NULL),
(347,77,1,4,4,35,NULL,'2024-03-14 01:57:42','2024-03-14 01:57:42',NULL,NULL,NULL),
(348,78,1,1,1,35,NULL,'2024-03-14 02:00:16','2024-03-14 02:00:16',NULL,NULL,NULL),
(349,78,0,0,1,35,NULL,'2024-03-14 02:00:34','2024-03-14 02:00:34',NULL,NULL,NULL),
(350,79,1,5,5,35,NULL,'2024-03-14 02:03:37','2024-03-14 02:03:37',NULL,NULL,NULL),
(351,67,0,8,30,21,NULL,'2024-06-11 07:23:11','2024-06-11 07:23:11',NULL,NULL,'Perubahan Stok Oleh Ariyana'),
(352,67,1,8,38,21,NULL,'2024-06-11 07:23:33','2024-06-11 07:23:33',NULL,NULL,'Perubahan Stok Oleh Ariyana'),
(353,67,0,8,30,21,NULL,'2024-06-11 07:25:35','2024-06-11 07:25:35',NULL,NULL,'Perubahan Stok Oleh Ariyana'),
(354,67,0,0,30,21,NULL,'2024-06-11 07:28:38','2024-06-11 07:28:38',NULL,NULL,'Perubahan Stok Oleh Ariyana'),
(355,80,1,13,13,21,NULL,'2024-06-11 08:04:48','2024-06-11 08:04:48',NULL,NULL,NULL),
(356,81,1,5,5,21,NULL,'2024-06-11 08:05:32','2024-06-11 08:05:32',NULL,NULL,NULL),
(357,82,1,18,18,21,NULL,'2024-06-11 08:07:11','2024-06-11 08:07:11',NULL,NULL,NULL),
(358,83,1,3,3,21,NULL,'2024-06-11 08:08:13','2024-06-11 08:08:13',NULL,NULL,NULL),
(359,84,1,12,12,21,NULL,'2024-06-11 08:08:25','2024-06-11 08:08:25',NULL,NULL,NULL),
(360,84,0,0,12,21,NULL,'2024-06-11 08:16:11','2024-06-11 08:16:11',NULL,NULL,NULL),
(361,84,0,2,10,21,NULL,'2024-06-11 08:16:47','2024-06-11 08:16:47',NULL,NULL,NULL),
(362,84,1,2,12,21,NULL,'2024-06-11 08:16:52','2024-06-11 08:16:52',NULL,NULL,NULL),
(363,74,1,25000,25000,21,20,'2024-06-13 02:37:49','2024-06-13 02:37:49',NULL,NULL,NULL),
(364,85,1,12,12,21,NULL,'2024-06-13 02:39:29','2024-06-13 02:39:29',NULL,NULL,NULL),
(365,67,0,10,20,21,NULL,'2024-06-13 02:41:47','2024-06-13 02:41:47',NULL,NULL,NULL),
(366,74,0,500,24500,21,NULL,'2024-06-13 02:41:47','2024-06-13 02:41:47',NULL,NULL,NULL),
(367,80,0,12,1,21,NULL,'2024-06-13 02:44:01','2024-06-13 02:44:01',NULL,NULL,NULL),
(368,84,0,12,0,21,NULL,'2024-06-13 02:44:01','2024-06-13 02:44:01',NULL,NULL,NULL),
(369,80,1,12,13,21,NULL,'2024-06-13 02:45:09','2024-06-13 02:45:09',NULL,'30#43#bon alat - kembali',NULL),
(370,84,1,12,12,21,NULL,'2024-06-13 02:45:09','2024-06-13 02:45:09',NULL,'30#44#bon alat - kembali',NULL),
(371,80,0,13,0,21,NULL,'2024-06-13 02:47:04','2024-06-13 02:47:04',NULL,NULL,NULL),
(372,80,1,1000,1000,21,NULL,'2024-06-13 02:49:51','2024-06-13 02:49:51',NULL,NULL,NULL),
(373,86,1,24,24,21,NULL,'2024-06-13 02:52:15','2024-06-13 02:52:15',NULL,NULL,NULL),
(374,67,1,123,143,21,NULL,'2024-06-13 02:52:37','2024-06-13 02:52:37',NULL,NULL,NULL),
(375,86,1,12,36,21,NULL,'2024-06-13 02:52:37','2024-06-13 02:52:37',NULL,NULL,NULL),
(376,74,0,24000,500,21,NULL,'2024-06-13 02:55:00','2024-06-13 02:55:00',NULL,NULL,NULL),
(377,87,1,100,100,21,21,'2024-06-13 06:01:55','2024-06-13 06:01:55',NULL,NULL,NULL);
/*!40000 ALTER TABLE `tr_kartu_stok` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tr_kesiapan_praktek`
--

DROP TABLE IF EXISTS `tr_kesiapan_praktek`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tr_kesiapan_praktek` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(32) NOT NULL,
  `tr_matakuliah_dosen_id` int(10) unsigned DEFAULT NULL,
  `tr_matakuliah_semester_prodi_id` int(10) unsigned DEFAULT NULL,
  `tm_staff_id` int(10) unsigned DEFAULT NULL,
  `rekomendasi` tinyint(3) unsigned DEFAULT NULL COMMENT '1=>Siapkan dan Lanjutkan, 2=>Dimodifikasi, 3=>Diganti Acara Praktek yang Lain, 4=>Ditunda',
  `tr_member_laboratorium_id` smallint(6) unsigned DEFAULT NULL,
  `tm_minggu_id` smallint(6) unsigned DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tm_laboratorium_id` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tr_kesiapan_praktek_tr_matakuliah_dosen_id_foreign` (`tr_matakuliah_dosen_id`),
  KEY `tr_kesiapan_praktek_tm_staff_id_foreign` (`tm_staff_id`),
  KEY `tr_matakuliah_semester_prodi_id` (`tr_matakuliah_semester_prodi_id`),
  KEY `tr_kesiapan_praktek_tr_member_laboratorium_id` (`tr_member_laboratorium_id`),
  KEY `tr_kesiapan_praktek_tm_minggu_id_foreign` (`tm_minggu_id`),
  KEY `tr_kesiapan_praktek_tr_laboratorium_id_foreign` (`tm_laboratorium_id`),
  CONSTRAINT `tr_kesiapan_praktek_tm_minggu_id_foreign` FOREIGN KEY (`tm_minggu_id`) REFERENCES `tm_minggu` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tr_kesiapan_praktek_tm_staff_id_foreign` FOREIGN KEY (`tm_staff_id`) REFERENCES `tm_staff` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tr_kesiapan_praktek_tr_laboratorium_id_foreign` FOREIGN KEY (`tm_laboratorium_id`) REFERENCES `tm_laboratorium` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tr_kesiapan_praktek_tr_matakuliah_dosen_id_foreign` FOREIGN KEY (`tr_matakuliah_dosen_id`) REFERENCES `tr_matakuliah_dosen` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tr_kesiapan_praktek_tr_member_laboratorium_id` FOREIGN KEY (`tr_member_laboratorium_id`) REFERENCES `tr_member_laboratorium` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tr_kesiapan_praktek`
--

LOCK TABLES `tr_kesiapan_praktek` WRITE;
/*!40000 ALTER TABLE `tr_kesiapan_praktek` DISABLE KEYS */;
INSERT INTO `tr_kesiapan_praktek` VALUES
(7,'A5Ee8VkO20240613024147',155,197,NULL,1,21,37,'2024-06-13','2024-06-13 02:41:47','2024-06-13 02:41:47',8);
/*!40000 ALTER TABLE `tr_kesiapan_praktek` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tr_matakuliah_dosen`
--

DROP TABLE IF EXISTS `tr_matakuliah_dosen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tr_matakuliah_dosen` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tr_matakuliah_semester_prodi_id` int(10) unsigned DEFAULT NULL,
  `tm_staff_id` int(10) unsigned DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tr_matakuliah_dosen_tr_matakuliah_semester_prodi_id_foreign` (`tr_matakuliah_semester_prodi_id`),
  KEY `tr_matakuliah_dosen_tm_staff_id_foreign` (`tm_staff_id`),
  KEY `tr_matakuliah_dosen_user_id_foreign` (`user_id`),
  CONSTRAINT `tr_matakuliah_dosen_tm_staff_id_foreign` FOREIGN KEY (`tm_staff_id`) REFERENCES `tm_staff` (`id`) ON DELETE SET NULL,
  CONSTRAINT `tr_matakuliah_dosen_tr_matakuliah_semester_prodi_id_foreign` FOREIGN KEY (`tr_matakuliah_semester_prodi_id`) REFERENCES `tr_matakuliah_semester_prodi` (`id`) ON DELETE SET NULL,
  CONSTRAINT `tr_matakuliah_dosen_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=156 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tr_matakuliah_dosen`
--

LOCK TABLES `tr_matakuliah_dosen` WRITE;
/*!40000 ALTER TABLE `tr_matakuliah_dosen` DISABLE KEYS */;
INSERT INTO `tr_matakuliah_dosen` VALUES
(11,1,43,NULL,'2022-05-13 02:48:36','2022-05-13 02:48:36'),
(12,2,4,NULL,'2022-05-13 02:48:36','2022-05-13 02:48:36'),
(13,3,68,NULL,'2022-05-13 02:48:36','2022-05-13 02:48:36'),
(14,4,13,NULL,'2022-05-13 02:48:36','2022-05-13 02:48:36'),
(15,5,29,NULL,'2022-05-13 02:48:36','2022-05-13 02:48:36'),
(16,6,11,NULL,'2022-05-13 02:48:36','2022-05-13 02:48:36'),
(17,7,6,NULL,'2022-05-13 02:48:36','2022-05-13 02:48:36'),
(18,8,8,NULL,'2022-05-13 02:48:36','2022-05-13 02:48:36'),
(19,9,20,NULL,'2022-05-13 02:48:36','2022-05-13 02:48:36'),
(20,10,68,NULL,'2022-05-13 02:48:36','2022-05-13 02:48:36'),
(21,12,5,NULL,'2022-05-13 03:35:37','2022-05-13 03:35:37'),
(22,13,70,NULL,'2022-05-13 03:41:01','2022-05-13 03:41:01'),
(23,14,8,NULL,'2022-05-13 03:42:48','2022-05-13 03:42:48'),
(24,22,45,NULL,'2022-09-04 04:25:30','2022-09-04 04:25:30'),
(27,23,31,NULL,'2022-09-04 04:25:30','2022-09-04 04:25:30'),
(29,24,39,NULL,'2022-09-04 04:25:30','2022-09-04 04:25:30'),
(32,25,40,NULL,'2022-09-04 04:25:31','2022-09-04 04:25:31'),
(33,26,31,NULL,'2022-09-04 04:25:31','2022-09-04 04:25:31'),
(37,27,42,NULL,'2022-09-04 04:25:31','2022-09-04 04:25:31'),
(38,28,33,NULL,'2022-09-04 05:12:26','2022-09-04 05:12:26'),
(40,30,18,NULL,'2022-09-04 05:12:26','2022-09-04 05:12:26'),
(41,31,34,NULL,'2022-09-04 05:12:26','2022-09-04 05:12:26'),
(42,32,36,NULL,'2022-09-04 05:12:26','2022-09-04 05:12:26'),
(43,33,36,NULL,'2022-09-04 05:12:26','2022-09-04 05:12:26'),
(44,34,34,NULL,'2022-09-04 05:12:26','2022-09-04 05:12:26'),
(45,35,33,NULL,'2022-09-04 05:12:26','2022-09-04 05:12:26'),
(46,40,64,NULL,'2022-09-04 05:13:42','2022-09-04 05:13:42'),
(47,41,31,NULL,'2022-09-04 05:13:42','2022-09-04 05:13:42'),
(48,42,39,NULL,'2022-09-04 05:13:42','2022-09-04 05:13:42'),
(49,43,37,NULL,'2022-09-04 05:13:42','2022-09-04 05:13:42'),
(50,44,34,NULL,'2022-09-04 05:13:42','2022-09-04 05:13:42'),
(51,45,42,NULL,'2022-09-04 05:13:43','2022-09-04 05:13:43'),
(52,48,68,NULL,'2022-09-04 05:15:09','2022-09-04 05:15:09'),
(53,49,20,NULL,'2022-09-04 05:15:09','2022-09-04 05:15:09'),
(54,50,29,NULL,'2022-09-04 05:15:09','2022-09-04 05:15:09'),
(55,51,8,NULL,'2022-09-04 05:15:09','2022-09-04 05:15:09'),
(56,52,6,NULL,'2022-09-04 05:15:09','2022-09-04 05:15:09'),
(57,53,8,NULL,'2022-09-04 05:15:09','2022-09-04 05:15:09'),
(58,54,24,NULL,'2022-09-04 05:15:09','2022-09-04 05:15:09'),
(59,55,68,NULL,'2022-09-04 05:15:09','2022-09-04 05:15:09'),
(60,56,15,NULL,'2022-09-04 05:16:40','2022-09-04 05:16:40'),
(61,57,26,NULL,'2022-09-04 05:16:40','2022-09-04 05:16:40'),
(62,58,15,NULL,'2022-09-04 05:16:40','2022-09-04 05:16:40'),
(63,59,24,NULL,'2022-09-04 05:16:40','2022-09-04 05:16:40'),
(64,60,20,NULL,'2022-09-04 05:16:40','2022-09-04 05:16:40'),
(65,61,9,NULL,'2022-09-04 05:16:40','2022-09-04 05:16:40'),
(66,62,21,NULL,'2022-09-04 05:16:40','2022-09-04 05:16:40'),
(67,63,27,NULL,'2022-09-04 05:16:40','2022-09-04 05:16:40'),
(68,67,67,NULL,'2022-09-04 05:18:12','2022-09-04 05:18:12'),
(69,68,20,NULL,'2022-09-04 05:18:13','2022-09-04 05:18:13'),
(70,69,9,NULL,'2022-09-04 05:18:13','2022-09-04 05:18:13'),
(71,70,11,NULL,'2022-09-04 05:18:13','2022-09-04 05:18:13'),
(72,71,6,NULL,'2022-09-04 05:18:13','2022-09-04 05:18:13'),
(73,72,8,NULL,'2022-09-04 05:18:13','2022-09-04 05:18:13'),
(74,73,24,NULL,'2022-09-04 05:18:13','2022-09-04 05:18:13'),
(75,74,67,NULL,'2022-09-04 05:18:13','2022-09-04 05:18:13'),
(76,75,15,NULL,'2022-09-04 05:20:50','2022-09-04 05:20:50'),
(77,76,26,NULL,'2022-09-04 05:20:50','2022-09-04 05:20:50'),
(78,77,15,NULL,'2022-09-04 05:20:50','2022-09-04 05:20:50'),
(79,78,24,NULL,'2022-09-04 05:20:50','2022-09-04 05:20:50'),
(80,79,20,NULL,'2022-09-04 05:20:50','2022-09-04 05:20:50'),
(81,80,29,NULL,'2022-09-04 05:20:50','2022-09-04 05:20:50'),
(82,81,21,NULL,'2022-09-04 05:20:50','2022-09-04 05:20:50'),
(83,82,27,NULL,'2022-09-04 05:20:50','2022-09-04 05:20:50'),
(84,85,45,NULL,'2022-09-04 05:21:58','2022-09-04 05:21:58'),
(85,86,14,NULL,'2022-09-04 05:21:59','2022-09-04 05:21:59'),
(86,87,51,NULL,'2022-09-04 05:21:59','2022-09-04 05:21:59'),
(87,88,49,NULL,'2022-09-04 05:21:59','2022-09-04 05:21:59'),
(88,89,60,NULL,'2022-09-04 05:21:59','2022-09-04 05:21:59'),
(89,90,52,NULL,'2022-09-04 05:21:59','2022-09-04 05:21:59'),
(90,91,33,NULL,'2022-09-04 05:23:25','2022-09-04 05:23:25'),
(91,93,53,NULL,'2022-09-04 05:23:25','2022-09-04 05:23:25'),
(92,94,30,NULL,'2022-09-04 05:23:25','2022-09-04 05:23:25'),
(93,95,12,NULL,'2022-09-04 05:23:25','2022-09-04 05:23:25'),
(94,96,59,NULL,'2022-09-04 05:23:26','2022-09-04 05:23:26'),
(95,97,58,NULL,'2022-09-04 05:23:26','2022-09-04 05:23:26'),
(96,92,93,NULL,'2022-09-04 05:25:30','2022-09-04 05:25:30'),
(97,98,56,NULL,'2022-09-04 05:27:21','2022-09-04 05:27:21'),
(98,99,60,NULL,'2022-09-04 05:27:21','2022-09-04 05:27:21'),
(99,100,47,NULL,'2022-09-04 05:27:21','2022-09-04 05:27:21'),
(100,101,21,NULL,'2022-09-04 05:27:21','2022-09-04 05:27:21'),
(101,102,48,NULL,'2022-09-04 05:27:21','2022-09-04 05:27:21'),
(102,103,23,NULL,'2022-09-04 05:27:21','2022-09-04 05:27:21'),
(103,104,49,NULL,'2022-09-04 05:27:21','2022-09-04 05:27:21'),
(104,108,45,NULL,'2022-09-04 05:29:11','2022-09-04 05:29:11'),
(105,109,14,NULL,'2022-09-04 05:29:11','2022-09-04 05:29:11'),
(106,110,51,NULL,'2022-09-04 05:29:11','2022-09-04 05:29:11'),
(107,111,49,NULL,'2022-09-04 05:29:12','2022-09-04 05:29:12'),
(108,112,60,NULL,'2022-09-04 05:29:13','2022-09-04 05:29:13'),
(109,113,52,NULL,'2022-09-04 05:29:13','2022-09-04 05:29:13'),
(110,114,33,NULL,'2022-09-04 05:32:39','2022-09-04 05:32:39'),
(111,115,93,NULL,'2022-09-04 05:32:39','2022-09-04 05:32:39'),
(112,116,53,NULL,'2022-09-04 05:32:39','2022-09-04 05:32:39'),
(113,117,30,NULL,'2022-09-04 05:32:39','2022-09-04 05:32:39'),
(114,118,12,NULL,'2022-09-04 05:32:39','2022-09-04 05:32:39'),
(115,119,59,NULL,'2022-09-04 05:32:39','2022-09-04 05:32:39'),
(116,120,58,NULL,'2022-09-04 05:32:39','2022-09-04 05:32:39'),
(117,121,23,NULL,'2022-09-04 05:33:53','2022-09-04 05:33:53'),
(118,122,60,NULL,'2022-09-04 05:33:53','2022-09-04 05:33:53'),
(119,123,47,NULL,'2022-09-04 05:33:54','2022-09-04 05:33:54'),
(120,124,21,NULL,'2022-09-04 05:33:54','2022-09-04 05:33:54'),
(121,125,48,NULL,'2022-09-04 05:33:54','2022-09-04 05:33:54'),
(122,126,23,NULL,'2022-09-04 05:33:54','2022-09-04 05:33:54'),
(123,127,49,NULL,'2022-09-04 05:33:54','2022-09-04 05:33:54'),
(124,130,67,NULL,'2022-09-04 05:44:23','2022-09-04 05:44:23'),
(125,131,14,NULL,'2022-09-04 05:44:23','2022-09-04 05:44:23'),
(126,132,51,NULL,'2022-09-04 05:44:23','2022-09-04 05:44:23'),
(127,133,49,NULL,'2022-09-04 05:44:24','2022-09-04 05:44:24'),
(128,134,60,NULL,'2022-09-04 05:44:24','2022-09-04 05:44:24'),
(129,135,52,NULL,'2022-09-04 05:44:24','2022-09-04 05:44:24'),
(130,136,33,NULL,'2022-09-04 05:45:43','2022-09-04 05:45:43'),
(131,137,93,NULL,'2022-09-04 05:45:43','2022-09-04 05:45:43'),
(132,138,53,NULL,'2022-09-04 05:45:43','2022-09-04 05:45:43'),
(133,139,30,NULL,'2022-09-04 05:45:43','2022-09-04 05:45:43'),
(134,140,12,NULL,'2022-09-04 05:45:43','2022-09-04 05:45:43'),
(135,141,59,NULL,'2022-09-04 05:45:43','2022-09-04 05:45:43'),
(136,142,58,NULL,'2022-09-04 05:45:43','2022-09-04 05:45:43'),
(137,143,56,NULL,'2022-09-04 05:47:08','2022-09-04 05:47:08'),
(138,144,60,NULL,'2022-09-04 05:47:08','2022-09-04 05:47:08'),
(139,145,47,NULL,'2022-09-04 05:47:08','2022-09-04 05:47:08'),
(140,146,21,NULL,'2022-09-04 05:47:08','2022-09-04 05:47:08'),
(141,147,48,NULL,'2022-09-04 05:47:08','2022-09-04 05:47:08'),
(142,148,23,NULL,'2022-09-04 05:47:08','2022-09-04 05:47:08'),
(143,149,49,NULL,'2022-09-04 05:47:08','2022-09-04 05:47:08'),
(144,181,14,NULL,'2022-09-04 05:49:29','2022-09-04 05:49:29'),
(145,182,12,NULL,'2022-09-04 05:49:29','2022-09-04 05:49:29'),
(146,183,59,NULL,'2022-09-04 05:49:29','2022-09-04 05:49:29'),
(147,184,23,NULL,'2022-09-04 05:49:29','2022-09-04 05:49:29'),
(148,185,58,NULL,'2022-09-04 05:49:29','2022-09-04 05:49:29'),
(149,186,49,NULL,'2022-09-04 05:49:29','2022-09-04 05:49:29'),
(150,187,60,NULL,'2022-09-04 05:49:30','2022-09-04 05:49:30'),
(151,29,8,NULL,'2022-10-10 03:05:24','2022-10-10 03:05:24'),
(153,195,63,NULL,'2022-10-10 07:40:17','2022-10-10 07:40:17'),
(154,196,67,NULL,'2022-10-10 07:40:17','2022-10-10 07:40:17'),
(155,197,22,NULL,'2024-06-13 02:14:59','2024-06-13 02:14:59');
/*!40000 ALTER TABLE `tr_matakuliah_dosen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tr_matakuliah_semester_prodi`
--

DROP TABLE IF EXISTS `tr_matakuliah_semester_prodi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tr_matakuliah_semester_prodi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tm_program_studi_id` smallint(5) unsigned DEFAULT NULL,
  `tm_semester_id` smallint(5) unsigned DEFAULT NULL,
  `tm_matakuliah_id` smallint(5) unsigned DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jumlah_golongan` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tr_matakuliah_semester_prodi_tm_matakuliah_id_foreign` (`tm_matakuliah_id`),
  KEY `tr_matakuliah_semester_prodi_tm_program_studi_id_foreign` (`tm_program_studi_id`),
  KEY `tr_matakuliah_semester_prodi_tm_semester_id_foreign` (`tm_semester_id`),
  KEY `tr_matakuliah_semester_prodi_user_id_foreign` (`user_id`),
  CONSTRAINT `tr_matakuliah_semester_prodi_tm_matakuliah_id_foreign` FOREIGN KEY (`tm_matakuliah_id`) REFERENCES `tm_matakuliah` (`id`) ON DELETE SET NULL,
  CONSTRAINT `tr_matakuliah_semester_prodi_tm_program_studi_id_foreign` FOREIGN KEY (`tm_program_studi_id`) REFERENCES `tm_program_studi` (`id`) ON DELETE SET NULL,
  CONSTRAINT `tr_matakuliah_semester_prodi_tm_semester_id_foreign` FOREIGN KEY (`tm_semester_id`) REFERENCES `tm_semester` (`id`) ON DELETE SET NULL,
  CONSTRAINT `tr_matakuliah_semester_prodi_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=199 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tr_matakuliah_semester_prodi`
--

LOCK TABLES `tr_matakuliah_semester_prodi` WRITE;
/*!40000 ALTER TABLE `tr_matakuliah_semester_prodi` DISABLE KEYS */;
INSERT INTO `tr_matakuliah_semester_prodi` VALUES
(1,3,1,22,1,'2022-05-12 03:32:05','2022-05-12 03:32:05',0),
(2,3,1,23,1,'2022-05-12 03:32:05','2022-05-12 03:32:05',0),
(3,3,1,24,1,'2022-05-12 03:32:05','2022-05-12 03:32:05',0),
(4,3,1,25,1,'2022-05-12 03:32:05','2022-05-12 03:32:05',0),
(5,3,1,26,1,'2022-05-12 03:32:05','2022-05-12 03:32:05',0),
(6,3,1,27,1,'2022-05-12 03:32:05','2022-05-12 03:32:05',0),
(7,3,1,28,1,'2022-05-12 03:32:05','2022-05-12 03:32:05',0),
(8,3,1,29,1,'2022-05-12 03:32:05','2022-05-12 03:32:05',0),
(9,3,1,30,1,'2022-05-12 03:32:05','2022-05-12 03:32:05',0),
(10,3,1,31,1,'2022-05-12 03:32:05','2022-05-12 03:32:05',0),
(11,3,10,2,1,'2022-05-12 03:35:29','2022-05-12 03:35:29',3),
(12,3,10,3,1,'2022-05-12 03:35:29','2022-05-12 03:35:29',3),
(13,3,10,4,1,'2022-05-12 03:35:29','2022-05-12 03:35:29',3),
(14,3,10,5,1,'2022-05-12 03:35:29','2022-05-12 03:35:29',3),
(15,3,10,6,1,'2022-05-12 03:35:29','2022-05-12 03:35:29',3),
(16,3,10,7,1,'2022-05-12 03:35:29','2022-05-12 03:35:29',3),
(17,3,10,8,1,'2022-05-12 03:35:29','2022-05-12 03:35:29',3),
(18,3,10,9,1,'2022-05-12 03:35:29','2022-05-12 03:35:29',3),
(19,3,10,10,1,'2022-05-12 03:35:29','2022-05-12 03:35:29',3),
(20,4,9,112,1,'2022-09-03 12:59:44','2022-09-03 12:59:44',4),
(21,4,9,113,1,'2022-09-03 12:59:44','2022-09-03 12:59:44',4),
(22,4,9,114,1,'2022-09-03 12:59:45','2022-09-03 12:59:45',4),
(23,4,9,115,1,'2022-09-03 12:59:45','2022-09-03 12:59:45',4),
(24,4,9,116,1,'2022-09-03 12:59:45','2022-09-03 12:59:45',4),
(25,4,9,117,1,'2022-09-03 12:59:45','2022-09-03 12:59:45',4),
(26,4,9,118,1,'2022-09-03 12:59:46','2022-09-03 12:59:46',4),
(27,4,9,119,1,'2022-09-03 12:59:46','2022-09-03 12:59:46',4),
(28,4,11,120,1,'2022-09-03 13:01:43','2022-09-03 13:01:43',4),
(29,4,11,121,1,'2022-09-03 13:01:43','2022-09-03 13:01:43',4),
(30,4,11,122,1,'2022-09-03 13:01:44','2022-09-03 13:01:44',4),
(31,4,11,123,1,'2022-09-03 13:01:44','2022-09-03 13:01:44',4),
(32,4,11,125,1,'2022-09-03 13:01:44','2022-09-03 13:01:44',4),
(33,4,11,126,1,'2022-09-03 13:01:45','2022-09-03 13:01:45',4),
(34,4,11,128,1,'2022-09-03 13:01:45','2022-09-03 13:01:45',4),
(35,4,11,129,1,'2022-09-03 13:01:45','2022-09-03 13:01:45',4),
(36,4,13,130,1,'2022-09-03 13:19:04','2022-09-03 13:19:04',4),
(37,4,13,2,1,'2022-09-03 13:21:32','2022-09-03 13:21:32',4),
(38,8,9,112,1,'2022-09-04 00:34:36','2022-09-04 00:34:36',1),
(39,8,9,113,1,'2022-09-04 00:34:36','2022-09-04 00:34:36',1),
(40,8,9,114,1,'2022-09-04 00:34:36','2022-09-04 00:34:36',1),
(41,8,9,115,1,'2022-09-04 00:34:36','2022-09-04 00:34:36',1),
(42,8,9,116,1,'2022-09-04 00:34:36','2022-09-04 00:34:36',1),
(43,8,9,117,1,'2022-09-04 00:34:36','2022-09-04 00:34:36',1),
(44,8,9,118,1,'2022-09-04 00:34:36','2022-09-04 00:34:36',1),
(45,8,9,119,1,'2022-09-04 00:34:37','2022-09-04 00:34:37',1),
(46,3,9,22,1,'2022-09-04 00:42:18','2022-09-04 00:42:18',4),
(47,3,9,23,1,'2022-09-04 00:42:18','2022-09-04 00:42:18',4),
(48,3,9,24,1,'2022-09-04 00:42:18','2022-09-04 00:42:18',4),
(49,3,9,25,1,'2022-09-04 00:42:18','2022-09-04 00:42:18',4),
(50,3,9,26,1,'2022-09-04 00:42:18','2022-09-04 00:42:18',4),
(51,3,9,27,1,'2022-09-04 00:42:18','2022-09-04 00:42:18',4),
(52,3,9,28,1,'2022-09-04 00:42:18','2022-09-04 00:42:18',4),
(53,3,9,29,1,'2022-09-04 00:42:18','2022-09-04 00:42:18',4),
(54,3,9,30,1,'2022-09-04 00:42:18','2022-09-04 00:42:18',4),
(55,3,9,31,1,'2022-09-04 00:42:18','2022-09-04 00:42:18',4),
(56,3,11,32,1,'2022-09-04 00:44:51','2022-09-04 00:44:51',3),
(57,3,11,33,1,'2022-09-04 00:44:51','2022-09-04 00:44:51',3),
(58,3,11,34,1,'2022-09-04 00:44:51','2022-09-04 00:44:51',3),
(59,3,11,35,1,'2022-09-04 00:44:51','2022-09-04 00:44:51',3),
(60,3,11,36,1,'2022-09-04 00:44:51','2022-09-04 00:44:51',3),
(61,3,11,37,1,'2022-09-04 00:44:51','2022-09-04 00:44:51',3),
(62,3,11,38,1,'2022-09-04 00:44:51','2022-09-04 00:44:51',3),
(63,3,11,39,1,'2022-09-04 00:44:51','2022-09-04 00:44:51',3),
(64,3,13,40,1,'2022-09-04 00:47:49','2022-09-04 00:47:49',3),
(65,9,9,22,1,'2022-09-04 01:01:25','2022-09-04 01:01:25',1),
(66,9,9,23,1,'2022-09-04 01:01:25','2022-09-04 01:01:25',1),
(67,9,9,24,1,'2022-09-04 01:01:25','2022-09-04 01:01:25',1),
(68,9,9,25,1,'2022-09-04 01:01:25','2022-09-04 01:01:25',1),
(69,9,9,26,1,'2022-09-04 01:01:26','2022-09-04 01:01:26',1),
(70,9,9,27,1,'2022-09-04 01:01:26','2022-09-04 01:01:26',1),
(71,9,9,28,1,'2022-09-04 01:01:26','2022-09-04 01:01:26',1),
(72,9,9,29,1,'2022-09-04 01:01:26','2022-09-04 01:01:26',1),
(73,9,9,30,1,'2022-09-04 01:01:26','2022-09-04 01:01:26',1),
(74,9,9,31,1,'2022-09-04 01:01:26','2022-09-04 01:01:26',1),
(75,9,11,32,1,'2022-09-04 01:02:53','2022-09-04 01:02:53',1),
(76,9,11,33,1,'2022-09-04 01:02:53','2022-09-04 01:02:53',1),
(77,9,11,34,1,'2022-09-04 01:02:53','2022-09-04 01:02:53',1),
(78,9,11,35,1,'2022-09-04 01:02:53','2022-09-04 01:02:53',1),
(79,9,11,36,1,'2022-09-04 01:02:53','2022-09-04 01:02:53',1),
(80,9,11,37,1,'2022-09-04 01:02:53','2022-09-04 01:02:53',1),
(81,9,11,38,1,'2022-09-04 01:02:53','2022-09-04 01:02:53',1),
(82,9,11,39,1,'2022-09-04 01:02:53','2022-09-04 01:02:53',1),
(83,5,9,131,1,'2022-09-04 01:54:29','2022-09-04 01:54:29',5),
(84,5,9,132,1,'2022-09-04 01:54:29','2022-09-04 01:54:29',5),
(85,5,9,133,1,'2022-09-04 01:54:29','2022-09-04 01:54:29',5),
(86,5,9,134,1,'2022-09-04 01:54:29','2022-09-04 01:54:29',5),
(87,5,9,135,1,'2022-09-04 01:54:30','2022-09-04 01:54:30',5),
(88,5,9,136,1,'2022-09-04 01:54:30','2022-09-04 01:54:30',5),
(89,5,9,137,1,'2022-09-04 01:54:30','2022-09-04 01:54:30',5),
(90,5,9,138,1,'2022-09-04 01:54:30','2022-09-04 01:54:30',5),
(91,5,11,94,1,'2022-09-04 01:55:37','2022-09-04 01:55:37',5),
(92,5,11,139,1,'2022-09-04 01:55:37','2022-09-04 01:55:37',5),
(93,5,11,140,1,'2022-09-04 01:55:37','2022-09-04 01:55:37',5),
(94,5,11,141,1,'2022-09-04 01:55:38','2022-09-04 01:55:38',5),
(95,5,11,142,1,'2022-09-04 01:55:38','2022-09-04 01:55:38',5),
(96,5,11,143,1,'2022-09-04 01:55:38','2022-09-04 01:55:38',5),
(97,5,11,144,1,'2022-09-04 01:55:38','2022-09-04 01:55:38',5),
(98,5,13,145,1,'2022-09-04 03:16:20','2022-09-04 03:16:20',5),
(99,5,13,146,1,'2022-09-04 03:16:20','2022-09-04 03:16:20',5),
(100,5,13,147,1,'2022-09-04 03:16:20','2022-09-04 03:16:20',5),
(101,5,13,148,1,'2022-09-04 03:16:20','2022-09-04 03:16:20',5),
(102,5,13,149,1,'2022-09-04 03:16:20','2022-09-04 03:16:20',5),
(103,5,13,150,1,'2022-09-04 03:16:20','2022-09-04 03:16:20',5),
(104,5,13,151,1,'2022-09-04 03:16:20','2022-09-04 03:16:20',5),
(105,5,15,152,1,'2022-09-04 03:18:06','2022-09-04 03:18:06',4),
(106,10,9,131,1,'2022-09-04 03:19:41','2022-09-04 03:19:41',1),
(107,10,9,132,1,'2022-09-04 03:19:41','2022-09-04 03:19:41',1),
(108,10,9,133,1,'2022-09-04 03:19:41','2022-09-04 03:19:41',1),
(109,10,9,134,1,'2022-09-04 03:19:41','2022-09-04 03:19:41',1),
(110,10,9,135,1,'2022-09-04 03:19:41','2022-09-04 03:19:41',1),
(111,10,9,136,1,'2022-09-04 03:19:41','2022-09-04 03:19:41',1),
(112,10,9,137,1,'2022-09-04 03:19:41','2022-09-04 03:19:41',1),
(113,10,9,138,1,'2022-09-04 03:19:41','2022-09-04 03:19:41',1),
(114,10,11,94,1,'2022-09-04 03:21:35','2022-09-04 03:21:35',1),
(115,10,11,139,1,'2022-09-04 03:21:35','2022-09-04 03:21:35',1),
(116,10,11,140,1,'2022-09-04 03:21:35','2022-09-04 03:21:35',1),
(117,10,11,141,1,'2022-09-04 03:21:35','2022-09-04 03:21:35',1),
(118,10,11,142,1,'2022-09-04 03:21:35','2022-09-04 03:21:35',1),
(119,10,11,143,1,'2022-09-04 03:21:35','2022-09-04 03:21:35',1),
(120,10,11,144,1,'2022-09-04 03:21:35','2022-09-04 03:21:35',1),
(121,10,13,145,1,'2022-09-04 03:22:42','2022-09-04 03:22:42',1),
(122,10,13,146,1,'2022-09-04 03:22:42','2022-09-04 03:22:42',1),
(123,10,13,147,1,'2022-09-04 03:22:42','2022-09-04 03:22:42',1),
(124,10,13,148,1,'2022-09-04 03:22:42','2022-09-04 03:22:42',1),
(125,10,13,149,1,'2022-09-04 03:22:42','2022-09-04 03:22:42',1),
(126,10,13,150,1,'2022-09-04 03:22:42','2022-09-04 03:22:42',1),
(127,10,13,151,1,'2022-09-04 03:22:42','2022-09-04 03:22:42',1),
(128,11,9,131,1,'2022-09-04 03:30:58','2022-09-04 03:30:58',1),
(129,11,9,132,1,'2022-09-04 03:30:58','2022-09-04 03:30:58',1),
(130,11,9,133,1,'2022-09-04 03:30:58','2022-09-04 03:30:58',1),
(131,11,9,134,1,'2022-09-04 03:30:58','2022-09-04 03:30:58',1),
(132,11,9,135,1,'2022-09-04 03:30:58','2022-09-04 03:30:58',1),
(133,11,9,136,1,'2022-09-04 03:30:58','2022-09-04 03:30:58',1),
(134,11,9,137,1,'2022-09-04 03:30:58','2022-09-04 03:30:58',1),
(135,11,9,138,1,'2022-09-04 03:30:58','2022-09-04 03:30:58',1),
(136,11,11,94,1,'2022-09-04 03:34:52','2022-09-04 03:34:52',2),
(137,11,11,139,1,'2022-09-04 03:34:52','2022-09-04 03:34:52',2),
(138,11,11,140,1,'2022-09-04 03:34:52','2022-09-04 03:34:52',2),
(139,11,11,141,1,'2022-09-04 03:34:52','2022-09-04 03:34:52',2),
(140,11,11,142,1,'2022-09-04 03:34:53','2022-09-04 03:34:53',2),
(141,11,11,143,1,'2022-09-04 03:34:53','2022-09-04 03:34:53',2),
(142,11,11,144,1,'2022-09-04 03:34:53','2022-09-04 03:34:53',2),
(143,11,13,145,1,'2022-09-04 03:36:46','2022-09-04 03:36:46',2),
(144,11,13,146,1,'2022-09-04 03:36:46','2022-09-04 03:36:46',2),
(145,11,13,147,1,'2022-09-04 03:36:46','2022-09-04 03:36:46',2),
(146,11,13,148,1,'2022-09-04 03:36:46','2022-09-04 03:36:46',2),
(147,11,13,149,1,'2022-09-04 03:36:46','2022-09-04 03:36:46',2),
(148,11,13,150,1,'2022-09-04 03:36:46','2022-09-04 03:36:46',2),
(149,11,13,151,1,'2022-09-04 03:36:46','2022-09-04 03:36:46',2),
(150,11,15,153,1,'2022-09-04 03:37:35','2022-09-04 03:37:35',2),
(151,12,9,131,1,'2022-09-04 03:43:11','2022-09-04 03:43:11',1),
(152,12,9,132,1,'2022-09-04 03:43:11','2022-09-04 03:43:11',1),
(153,12,9,133,1,'2022-09-04 03:43:11','2022-09-04 03:43:11',1),
(154,12,9,134,1,'2022-09-04 03:43:11','2022-09-04 03:43:11',1),
(155,12,9,135,1,'2022-09-04 03:43:11','2022-09-04 03:43:11',1),
(156,12,9,136,1,'2022-09-04 03:43:11','2022-09-04 03:43:11',1),
(157,12,9,137,1,'2022-09-04 03:43:11','2022-09-04 03:43:11',1),
(158,12,9,138,1,'2022-09-04 03:43:12','2022-09-04 03:43:12',1),
(159,12,11,94,1,'2022-09-04 03:43:53','2022-09-04 03:43:53',1),
(160,12,11,139,1,'2022-09-04 03:43:53','2022-09-04 03:43:53',1),
(161,12,11,140,1,'2022-09-04 03:43:53','2022-09-04 03:43:53',1),
(162,12,11,141,1,'2022-09-04 03:43:53','2022-09-04 03:43:53',1),
(163,12,11,142,1,'2022-09-04 03:43:53','2022-09-04 03:43:53',1),
(164,12,11,143,1,'2022-09-04 03:43:53','2022-09-04 03:43:53',1),
(165,12,11,144,1,'2022-09-04 03:43:53','2022-09-04 03:43:53',1),
(166,13,9,131,1,'2022-09-04 03:52:04','2022-09-04 03:52:04',1),
(167,13,9,132,1,'2022-09-04 03:52:04','2022-09-04 03:52:04',1),
(168,13,9,133,1,'2022-09-04 03:52:04','2022-09-04 03:52:04',1),
(169,13,9,134,1,'2022-09-04 03:52:04','2022-09-04 03:52:04',1),
(170,13,9,135,1,'2022-09-04 03:52:04','2022-09-04 03:52:04',1),
(171,13,9,136,1,'2022-09-04 03:52:04','2022-09-04 03:52:04',1),
(172,13,9,137,1,'2022-09-04 03:52:04','2022-09-04 03:52:04',1),
(173,13,9,138,1,'2022-09-04 03:52:04','2022-09-04 03:52:04',1),
(174,13,11,94,1,'2022-09-04 03:52:59','2022-09-04 03:52:59',1),
(175,13,11,139,1,'2022-09-04 03:52:59','2022-09-04 03:52:59',1),
(176,13,11,140,1,'2022-09-04 03:52:59','2022-09-04 03:52:59',1),
(177,13,11,141,1,'2022-09-04 03:52:59','2022-09-04 03:52:59',1),
(178,13,11,142,1,'2022-09-04 03:52:59','2022-09-04 03:52:59',1),
(179,13,11,143,1,'2022-09-04 03:52:59','2022-09-04 03:52:59',1),
(180,13,11,144,1,'2022-09-04 03:52:59','2022-09-04 03:52:59',1),
(181,14,9,83,1,'2022-09-04 04:12:19','2022-09-04 04:12:19',1),
(182,14,9,91,1,'2022-09-04 04:12:19','2022-09-04 04:12:19',1),
(183,14,9,92,1,'2022-09-04 04:12:19','2022-09-04 04:12:19',1),
(184,14,9,93,1,'2022-09-04 04:12:19','2022-09-04 04:12:19',1),
(185,14,9,95,1,'2022-09-04 04:12:19','2022-09-04 04:12:19',1),
(186,14,9,108,1,'2022-09-04 04:12:20','2022-09-04 04:12:20',1),
(187,14,9,111,1,'2022-09-04 04:12:20','2022-09-04 04:12:20',1),
(195,15,9,173,1,'2022-10-10 07:39:18','2022-10-10 07:39:18',1),
(196,15,9,174,1,'2022-10-10 07:39:18','2022-10-10 07:39:18',1),
(197,5,10,98,1,'2024-06-13 02:12:34','2024-06-13 02:12:34',5),
(198,5,10,98,1,'2024-06-13 02:12:34','2024-06-13 02:12:34',5);
/*!40000 ALTER TABLE `tr_matakuliah_semester_prodi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tr_member_laboratorium`
--

DROP TABLE IF EXISTS `tr_member_laboratorium`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tr_member_laboratorium` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `tm_laboratorium_id` smallint(5) unsigned NOT NULL,
  `tm_staff_id` int(10) unsigned NOT NULL,
  `is_kalab` tinyint(1) NOT NULL DEFAULT 0,
  `is_aktif` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kode` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tr_member_laboratorium_tm_laboratorium_id_foreign` (`tm_laboratorium_id`),
  KEY `tr_member_laboratorium_tm_staff_id_foreign` (`tm_staff_id`),
  CONSTRAINT `tr_member_laboratorium_tm_laboratorium_id_foreign` FOREIGN KEY (`tm_laboratorium_id`) REFERENCES `tm_laboratorium` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tr_member_laboratorium_tm_staff_id_foreign` FOREIGN KEY (`tm_staff_id`) REFERENCES `tm_staff` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tr_member_laboratorium`
--

LOCK TABLES `tr_member_laboratorium` WRITE;
/*!40000 ALTER TABLE `tr_member_laboratorium` DISABLE KEYS */;
INSERT INTO `tr_member_laboratorium` VALUES
(1,3,49,1,0,'2022-08-20 17:45:51','2022-09-30 08:19:56',NULL),
(2,1,49,1,0,'2022-08-20 18:48:24','2022-08-20 18:48:47',NULL),
(3,1,8,1,0,'2022-08-20 18:48:47','2022-08-20 18:53:09',NULL),
(4,1,8,1,0,'2022-08-20 18:53:09','2022-09-30 08:19:35',NULL),
(9,1,1,0,0,'2022-08-20 20:10:05','2022-08-20 20:11:00',NULL),
(10,1,1,0,0,'2022-08-20 20:10:23','2022-08-20 20:10:35',NULL),
(11,1,91,0,0,'2022-08-22 18:36:14','2023-10-30 09:14:04',NULL),
(12,3,92,0,1,'2022-08-22 18:41:32','2022-08-22 18:41:32',NULL),
(13,1,27,1,0,'2022-09-30 08:19:35','2023-07-27 08:45:13',NULL),
(14,3,49,1,1,'2022-09-30 08:19:56','2022-09-30 08:19:56',NULL),
(15,5,59,1,0,'2022-09-30 08:24:34','2022-09-30 08:27:56',NULL),
(16,6,34,1,0,'2022-09-30 08:25:13','2022-09-30 08:29:08',NULL),
(17,7,34,1,0,'2022-09-30 08:26:45','2023-07-27 08:46:14',NULL),
(18,5,59,1,1,'2022-09-30 08:27:56','2022-09-30 08:27:56',NULL),
(19,8,52,1,0,'2022-09-30 08:28:45','2023-07-27 08:46:35',NULL),
(20,6,36,1,0,'2022-09-30 08:29:08','2023-07-27 08:45:39',NULL),
(21,8,95,0,1,'2022-09-30 08:32:19','2022-09-30 08:32:19',NULL),
(22,8,89,0,0,'2022-09-30 08:55:52','2023-10-30 09:13:34',NULL),
(23,1,1,0,0,'2022-10-03 07:39:27','2023-10-30 09:14:00',NULL),
(24,5,97,0,0,'2022-10-03 09:50:56','2023-10-30 09:33:58',NULL),
(25,7,96,0,1,'2022-10-04 02:47:43','2022-10-04 02:47:43',NULL),
(26,6,98,0,1,'2022-10-12 09:16:00','2022-10-12 09:16:00',NULL),
(27,1,20,1,1,'2023-07-27 08:45:13','2023-07-27 08:45:13',NULL),
(28,6,33,1,1,'2023-07-27 08:45:39','2023-07-27 08:45:39',NULL),
(29,7,8,1,1,'2023-07-27 08:46:14','2023-07-27 08:46:14',NULL),
(30,8,51,1,1,'2023-07-27 08:46:35','2023-07-27 08:46:35',NULL),
(31,9,20,1,0,'2023-07-27 08:47:39','2023-07-27 08:47:55',NULL),
(32,9,20,1,1,'2023-07-27 08:47:55','2023-07-27 08:47:55',NULL),
(33,10,8,1,0,'2023-07-27 08:48:57','2023-07-27 08:49:16',NULL),
(34,10,8,1,1,'2023-07-27 08:49:16','2023-07-27 08:49:16',NULL),
(35,10,100,0,1,'2023-07-27 08:54:03','2023-07-27 08:54:03',NULL),
(36,9,99,0,1,'2023-07-27 08:54:28','2023-07-27 08:54:28',NULL),
(37,1,109,0,1,'2023-10-30 09:32:50','2023-10-30 09:32:50',NULL),
(38,1,101,0,1,'2023-10-30 09:33:00','2023-10-30 09:33:00',NULL),
(39,1,89,0,1,'2023-10-30 09:33:16','2023-10-30 09:33:16',NULL),
(40,6,108,0,1,'2023-10-30 09:34:18','2023-10-30 09:34:18',NULL),
(41,7,102,0,1,'2023-10-30 09:36:46','2023-10-30 09:36:46',NULL),
(42,7,103,0,1,'2023-10-30 09:36:55','2023-10-30 09:36:55',NULL),
(43,8,106,0,0,'2023-10-30 09:37:18','2023-10-30 09:38:30',NULL),
(44,8,1,0,1,'2023-10-30 09:37:27','2023-10-30 09:37:27',NULL),
(45,5,104,0,1,'2023-10-30 09:37:57','2023-10-30 09:37:57',NULL),
(46,5,110,0,1,'2023-10-30 09:38:13','2023-10-30 09:38:13',NULL),
(47,8,107,0,1,'2023-10-30 09:38:42','2023-10-30 09:38:42',NULL),
(48,5,106,0,1,'2023-10-30 09:38:59','2023-10-30 09:38:59',NULL),
(49,3,105,0,1,'2023-10-30 09:39:17','2023-10-30 09:39:17',NULL),
(50,3,111,0,1,'2023-10-30 09:39:24','2023-10-30 09:39:24',NULL),
(51,1,116,0,1,'2024-03-07 01:34:12','2024-03-07 01:34:12',NULL),
(52,6,113,0,1,'2024-03-07 01:35:08','2024-03-07 01:35:08',NULL),
(53,8,112,0,1,'2024-03-07 01:35:46','2024-03-07 01:35:46',NULL),
(54,9,114,0,1,'2024-03-07 01:41:34','2024-03-07 01:41:34',NULL),
(55,10,115,0,1,'2024-03-07 01:42:10','2024-03-07 01:42:10',NULL),
(56,11,51,1,1,'2024-03-07 01:44:32','2024-03-07 01:44:32',NULL),
(57,12,33,1,1,'2024-03-07 01:58:04','2024-03-07 01:58:04',NULL),
(58,12,120,0,1,'2024-03-07 01:58:18','2024-03-07 01:58:18',NULL),
(60,14,49,1,1,'2024-03-07 02:05:39','2024-03-07 02:05:39',NULL),
(61,14,118,0,1,'2024-03-07 02:06:25','2024-03-07 02:06:25',NULL),
(62,15,59,1,0,'2024-03-07 02:07:57','2024-03-07 02:08:19',NULL),
(63,15,59,1,1,'2024-03-07 02:08:19','2024-03-07 02:08:19',NULL),
(64,15,118,0,0,'2024-03-07 02:12:48','2024-03-07 02:13:14',NULL),
(65,15,117,0,1,'2024-03-07 02:13:23','2024-03-07 02:13:23',NULL);
/*!40000 ALTER TABLE `tr_member_laboratorium` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tr_penggantian_praktek`
--

DROP TABLE IF EXISTS `tr_penggantian_praktek`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tr_penggantian_praktek` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `jadwal_asli` datetime NOT NULL,
  `jadwal_ganti` datetime NOT NULL,
  `acara_praktek` varchar(255) NOT NULL,
  `tr_kaprodi_id` smallint(5) unsigned NOT NULL,
  `tr_member_laboratorium_id` smallint(5) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kode` varchar(32) DEFAULT NULL,
  `tr_matakuliah_semester_prodi_id` int(11) unsigned DEFAULT NULL,
  `tm_staff_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tr_penggantian_praktek_tr_kaprodi_id_foreign` (`tr_kaprodi_id`),
  KEY `tr_penggantian_praktek_tr_member_laboratorium_id_foreign` (`tr_member_laboratorium_id`),
  KEY `tr_penggantian_praktek_tr_matakuliah_semester_prodi_id_foreign` (`tr_matakuliah_semester_prodi_id`),
  KEY `tr_penggantian_praktek_tm_staff_id_foreign` (`tm_staff_id`),
  CONSTRAINT `tr_penggantian_praktek_tm_staff_id_foreign` FOREIGN KEY (`tm_staff_id`) REFERENCES `tm_staff` (`id`),
  CONSTRAINT `tr_penggantian_praktek_tr_kaprodi_id_foreign` FOREIGN KEY (`tr_kaprodi_id`) REFERENCES `tr_kaprodi` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tr_penggantian_praktek_tr_matakuliah_semester_prodi_id_foreign` FOREIGN KEY (`tr_matakuliah_semester_prodi_id`) REFERENCES `tr_matakuliah_semester_prodi` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tr_penggantian_praktek_tr_member_laboratorium_id_foreign` FOREIGN KEY (`tr_member_laboratorium_id`) REFERENCES `tr_member_laboratorium` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tr_penggantian_praktek`
--

LOCK TABLES `tr_penggantian_praktek` WRITE;
/*!40000 ALTER TABLE `tr_penggantian_praktek` DISABLE KEYS */;
INSERT INTO `tr_penggantian_praktek` VALUES
(3,'2024-06-13 00:00:00','2024-06-13 23:00:00','rahasia',8,21,'2024-06-13 02:48:13','2024-06-13 02:48:13',NULL,197,22);
/*!40000 ALTER TABLE `tr_penggantian_praktek` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tr_serma_hasil_sisa_praktek`
--

DROP TABLE IF EXISTS `tr_serma_hasil_sisa_praktek`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tr_serma_hasil_sisa_praktek` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(32) NOT NULL,
  `tr_matakuliah_dosen_id` int(10) unsigned DEFAULT NULL,
  `tr_member_laboratorium_id` smallint(5) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tm_minggu_id` smallint(5) unsigned DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `acara_praktek` text DEFAULT NULL,
  `tm_laboratorium_id` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tr_serma_hasil_sisa_praktek_tr_matakuliah_dosen_id_foreign` (`tr_matakuliah_dosen_id`),
  KEY `tr_serma_hasil_sisa_praktek_tr_member_laboratorium_id_foreign` (`tr_member_laboratorium_id`),
  KEY `tr_serma_hasil_sisa_praktek_tm_minggu_id_foreign` (`tm_minggu_id`),
  KEY `tr_serma_hasil_sisa_praktek_tr_laboratorium_id_foreign` (`tm_laboratorium_id`),
  CONSTRAINT `tr_serma_hasil_sisa_praktek_tm_minggu_id_foreign` FOREIGN KEY (`tm_minggu_id`) REFERENCES `tm_minggu` (`id`) ON DELETE SET NULL,
  CONSTRAINT `tr_serma_hasil_sisa_praktek_tr_laboratorium_id_foreign` FOREIGN KEY (`tm_laboratorium_id`) REFERENCES `tm_laboratorium` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tr_serma_hasil_sisa_praktek_tr_matakuliah_dosen_id_foreign` FOREIGN KEY (`tr_matakuliah_dosen_id`) REFERENCES `tr_matakuliah_dosen` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tr_serma_hasil_sisa_praktek_tr_member_laboratorium_id_foreign` FOREIGN KEY (`tr_member_laboratorium_id`) REFERENCES `tr_member_laboratorium` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tr_serma_hasil_sisa_praktek`
--

LOCK TABLES `tr_serma_hasil_sisa_praktek` WRITE;
/*!40000 ALTER TABLE `tr_serma_hasil_sisa_praktek` DISABLE KEYS */;
INSERT INTO `tr_serma_hasil_sisa_praktek` VALUES
(4,'STXbkHZTzV20221124034511',32,21,'2022-11-24 03:45:11','2022-11-24 03:45:11',33,'2022-11-28','asdw',8),
(5,'ST71jObAc420221124114539',43,21,'2022-11-24 11:45:39','2022-11-24 11:45:39',32,'2022-11-25','Pengenalan Line Follower',8),
(6,'STi2DUbXyl20240613025237',155,21,'2024-06-13 02:52:37','2024-06-13 02:52:37',37,'2024-06-13','devops',8);
/*!40000 ALTER TABLE `tr_serma_hasil_sisa_praktek` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tr_usulan_kebutuhan`
--

DROP TABLE IF EXISTS `tr_usulan_kebutuhan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tr_usulan_kebutuhan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(32) DEFAULT NULL,
  `acara_praktek` varchar(255) NOT NULL,
  `jml_kel` tinyint(3) unsigned NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `status` tinyint(3) unsigned NOT NULL COMMENT '1 => pengajuan, 2 =>review tim bahan, 3 => cetak tim bahan, 4 => acc, 5=>deliver, 6 =>selesai ',
  `tm_minggu_id` smallint(5) unsigned DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `tr_matakuliah_dosen_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tanggal` date NOT NULL,
  `jml_gol` tinyint(4) NOT NULL,
  `tm_laboratorium_id` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tr_usulan_kebutuhan_user_id_foreign` (`user_id`),
  KEY `tr_usulan_kebutuhan_tr_matakuliah_dosen_id_foreign` (`tr_matakuliah_dosen_id`),
  KEY `tr_usulan_kebutuhan_tm_laboratorium_id_foreign` (`tm_laboratorium_id`),
  KEY `tr_usulan_kebutuhan_tm_minggu_id_foreign` (`tm_minggu_id`),
  CONSTRAINT `tr_usulan_kebutuhan_tm_laboratorium_id_foreign` FOREIGN KEY (`tm_laboratorium_id`) REFERENCES `tm_laboratorium` (`id`) ON DELETE SET NULL,
  CONSTRAINT `tr_usulan_kebutuhan_tm_minggu_id_foreign` FOREIGN KEY (`tm_minggu_id`) REFERENCES `tm_minggu` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tr_usulan_kebutuhan_tr_matakuliah_dosen_id_foreign` FOREIGN KEY (`tr_matakuliah_dosen_id`) REFERENCES `tr_matakuliah_dosen` (`id`) ON DELETE SET NULL,
  CONSTRAINT `tr_usulan_kebutuhan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tr_usulan_kebutuhan`
--

LOCK TABLES `tr_usulan_kebutuhan` WRITE;
/*!40000 ALTER TABLE `tr_usulan_kebutuhan` DISABLE KEYS */;
INSERT INTO `tr_usulan_kebutuhan` VALUES
(22,'21N75UOu20221017091115','makan',5,NULL,4,27,60,88,'2022-10-17 09:11:15','2022-10-17 09:13:09','2022-10-17',5,NULL),
(23,'WKhWk17o20240613022844','Praktikum devops',4,NULL,6,37,22,155,'2024-06-13 02:28:44','2024-06-13 02:37:49','2024-06-13',5,8),
(24,'9h8FKsW020240613055154','kelompok',4,NULL,6,37,22,155,'2024-06-13 05:51:54','2024-06-13 06:01:55','2024-06-14',5,8);
/*!40000 ALTER TABLE `tr_usulan_kebutuhan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tr_usulan_kebutuhan_detail`
--

DROP TABLE IF EXISTS `tr_usulan_kebutuhan_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tr_usulan_kebutuhan_detail` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `keb_kel` tinyint(3) unsigned NOT NULL,
  `total_keb` int(10) unsigned NOT NULL,
  `keb_acc` int(10) unsigned DEFAULT NULL,
  `tm_barang_id` int(10) unsigned DEFAULT NULL,
  `td_satuan_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tr_usulan_kebutuhan_id` bigint(20) unsigned NOT NULL,
  `keterangan` varchar(128) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tr_usulan_kebutuhan_detail_tm_barang_id_foreign` (`tm_barang_id`),
  KEY `tr_usulan_kebutuhan_detail_td_satuan_id_foreign` (`td_satuan_id`),
  KEY `tr_usulan_kebutuhan_detail_tr_usulan_kebutuhan_id_foreign` (`tr_usulan_kebutuhan_id`),
  CONSTRAINT `tr_usulan_kebutuhan_detail_td_satuan_id_foreign` FOREIGN KEY (`td_satuan_id`) REFERENCES `td_satuan` (`id`) ON DELETE SET NULL,
  CONSTRAINT `tr_usulan_kebutuhan_detail_tm_barang_id_foreign` FOREIGN KEY (`tm_barang_id`) REFERENCES `tm_barang` (`id`) ON DELETE SET NULL,
  CONSTRAINT `tr_usulan_kebutuhan_detail_tr_usulan_kebutuhan_id_foreign` FOREIGN KEY (`tr_usulan_kebutuhan_id`) REFERENCES `tr_usulan_kebutuhan` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tr_usulan_kebutuhan_detail`
--

LOCK TABLES `tr_usulan_kebutuhan_detail` WRITE;
/*!40000 ALTER TABLE `tr_usulan_kebutuhan_detail` DISABLE KEYS */;
INSERT INTO `tr_usulan_kebutuhan_detail` VALUES
(19,10,250,NULL,3,23,'2022-10-17 09:11:15','2022-10-17 09:22:23',22,'',NULL,NULL),
(20,4,80,50,1,1,'2024-06-13 02:28:44','2024-06-13 02:37:49',23,'bahan kertas praktikum',1,NULL),
(21,5,100,100,16,33,'2024-06-13 05:51:54','2024-06-13 06:01:55',24,'tiap kelompok',1,NULL);
/*!40000 ALTER TABLE `tr_usulan_kebutuhan_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `google_id` text DEFAULT NULL,
  `avatar` text DEFAULT NULL,
  `role` int(10) unsigned DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_aktif` tinyint(3) unsigned NOT NULL,
  `tm_staff_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,'Novianto Hadi Raharjo','novianto_hadi@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S','111653895186654901674','https://lh3.googleusercontent.com/a/AATXAJyzTyyE0oNgCt9JJiv_gO6CSoMbMO-kw7z6hmPW=s96-c',NULL,NULL,'2022-04-14 02:03:40','2022-09-30 09:12:53',1,1),
(3,'test','test@gmail.com',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,'2022-04-26 05:13:45','2022-04-26 05:13:45',1,2),
(4,'Alwan Abdurahman','alwan_abdurahman@gmail.com',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,4),
(5,'Luluk Cahyo Wiyono','luluk_cahyo_wiyono@gmail.com',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,5),
(6,'Husin','husin@gmail.com',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,'2024-06-13 02:19:41',1,6),
(7,'Intan Sulistyaningrum Sakkinah','intan_sulistyaningrum_sakkinah@gmail.com',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,7),
(8,'Syamsul Arifin','syamsul_arifin@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,8),
(9,'Didit Rahmat Hartadi','didit_rahmat_hartadi@gmail.com',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,9),
(10,'Nanik Anita Mukhlisoh','nanik_anita_mukhlisoh@gmail.com',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,10),
(11,'Hendra Yufit Riskiawan','hendrayufit@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,'2024-06-19 03:43:48',1,11),
(12,'Mukhamad Angga Gumilang','mukhamad_angga_gumilang@gmail.com',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,12),
(13,'Ika Widiastuti','ika_widiastuti@gmail.com',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,13),
(14,'Ratih Ayuninghemi','ratih_ayuninghemi@gmail.com',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,14),
(15,'Ely Mulyadi','ely_mulyadi@gmail.com',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,15),
(16,'Bakhtiyar Hadi Prakoso','bakhtiyar_hadi_prakoso@gmail.com',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,16),
(17,'Choirul Huda','choirul_huda@gmail.com',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,17),
(18,'Surateno','surateno@gmail.com',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,18),
(19,'Dia Bitari Mei Yuana','dia_bitari@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,19),
(20,'Faisal Lutfi Afriansyah','faisal_lutfi@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,20),
(21,'Taufiq Rizaldi','taufiq_rizaldi@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,21),
(22,'Arvita Agus Kurniasari','arvita_agus@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,'2024-06-13 05:44:37',1,22),
(23,'I GEDE WIRYAWAN','i_gede_wiryawan@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,23),
(24,'Pramuditha Shinta Dewi Puspitasari','pramuditha_shinta@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,24),
(25,'MUHAMMAD YUNUS','muhammad_yunus@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,25),
(26,'Dwi Putro Sarwo Setyohadi','dwi_putro@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,26),
(27,'Hermawan Arief P','hermawan_arief@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,27),
(28,'Lukie Perdanasari','lukie_perdanasari@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,28),
(29,'Wahyu Kurnia Dewanto','wahyu_kurnia@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,29),
(30,'Moch.Munih Dian W','moch.munih_dian@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,30),
(31,'Agus Hariyanto','agus_hariyanto@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,31),
(32,'Denny Wijanarko','denny_wijanarko@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,32),
(33,'Yogiswara','yogiswara@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,33),
(34,'Bekti Maryuni Susanto','bekti_maryuni@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,34),
(35,'Putri Santika','putri_santika@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,35),
(36,'Beni Widiawan','beni_widiawan@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,36),
(37,'Agus Purwadi','agus_purwadi@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,37),
(38,'Syamsiar Kautsar','syamsiar_kautsar@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,38),
(39,'Victor Phoa','victor_phoa@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,39),
(40,'Hariyono Rakhmad','hariyono_rakhmad@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,40),
(41,'Shabrina Choirunnisa','shabrina_choirunnisa@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,41),
(42,'Lalitya Nindita Sahenda','lalitya_nindita@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,42),
(43,'Zainul Hakim','zainul_hakim@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,43),
(44,'R. Agus Sariono','r_agus_sariono@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,44),
(45,'GULLIT TORNADO TAUFAN','gullit_tornado@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,45),
(46,'Ghanesya Hari Murti','ghanesya_hari@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,46),
(47,'Adi Heru Utomo','adi_heru@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,47),
(48,'Zilvanhisna Emka Fitri','zilvanhisna_emka@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,48),
(49,'Aji Seto Arifianto','aji_seto@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,49),
(50,'Denny Trias Utomo','denny_trias@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,50),
(51,'Prawidya Destarianto','prawidya_destarianto@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,51),
(52,'Bety Etikasari','bety_etikasari@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,52),
(53,'Nugroho Setyo Wibowo','nugroho_setyo@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,53),
(54,'Lukman Hakim','lukman_hakim@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,54),
(55,'Rizki Febrian Pramudita','rizki_febrian@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,55),
(56,'Elly Antika','elly_antika@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,56),
(57,'Mudafiq Riyan Pratama','mudafiq_riyan@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,57),
(58,'Ery Setiyawan Jullev Atmaji','ery_setiyawan@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,58),
(59,'Khafidurrohman Agustianto','khafidurrohman_agustianto@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,59),
(60,'Trismayanti Dwi Puspitasari','trismayanti_dwi@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,'2022-10-04 07:53:29',1,60),
(61,'Andri Permana Wicaksono','andri_permana@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,61),
(62,'Jumiatun','jumiatun@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,62),
(63,'I Putu Dody Lesmana','dody@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,'2022-10-10 07:29:50',1,63),
(64,'Adriadi Novawan','adriadi_novawan@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,64),
(65,'Ahmad Basri Saifur Rahman','ahmad_basri@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,65),
(66,'Degita Danur Suharsono','degita_danur@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,66),
(67,'Alfi Hidayatu Miqawati','alfi_hidayatu@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,67),
(68,'Renata Kenanga Rinda','renata_kenanga@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,68),
(69,'Enik Rukiati','enik_rukiati@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,69),
(70,'Vigo Dewangga','vigo_dewangga@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,70),
(71,'Geri Barnas Saputra','geri_barnas@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,71),
(72,'Sunoko Setyawan','sunoko_setyawan@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,72),
(73,'Estin Roso Pristiwaningsih','estin_roso@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,73),
(74,'Rhama Wisnu Wardhana','rhama_wisnu@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,74),
(75,'Dyah Aju Hermawati','dyah_ajuh@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,75),
(76,'Ruqoyah Yulia Hasanah Dhomiri','ruqoyah_yuliah@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,76),
(77,'Adi Sucipto','adi_sucipto@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,77),
(78,'Sholihah Ayu Wulandari','sholihah_ayuw@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,78),
(79,'Ikrima Halimatus Sa\'diyah','ikrima_halimatuss@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,79),
(80,'Suwardi (LB)','suwardilb@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,80),
(81,'Wajihudin','wajihudin@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,81),
(82,'Suyik Binarkaheni','suyik_binarkaheni@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,82),
(83,'Mochammad Rifki Ulil Albaab','mrifki_ulil_albaab@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,83),
(84,'Suparto (Kampus Bondowoso)','suparto_bws@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,84),
(85,'Suyitno','suyitno@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,85),
(86,'Asmunir','asmunir@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,86),
(87,'Asep Samsudin','asep_samsudin@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,87),
(88,'Ratri Handayani','ratri_handayani@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,NULL,NULL,1,88),
(89,'Moch. Rif\'an Eko Utomo','rifan@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,'2022-07-10 21:54:12','2024-03-07 02:23:57',1,89),
(91,'Yunita Dwi P','yunita@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,'2022-08-19 09:01:49','2022-08-19 09:01:49',1,91),
(92,'Egy','egy@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,'2022-08-22 18:38:12','2022-08-22 18:38:12',1,92),
(93,'Muhammad Hafidh Firmansyah','hafid_firmansyah@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,'2022-09-04 05:24:56','2022-09-04 05:24:56',1,93),
(94,'Yeni Arista Herdina Safitri','yeni_arista@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,'2022-09-26 07:48:13','2022-09-26 07:48:13',1,94),
(95,'Ariyana','ariyana@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,'2022-09-26 07:49:49','2022-09-26 07:49:49',1,95),
(96,'Appredo Probo Anugro','appredo@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,'2022-09-30 07:26:19','2022-09-30 07:26:19',1,96),
(97,'Cahyana Ahmad Pahlevi','cahyanapahlevi@gmail.com',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,'2022-09-30 07:46:50','2022-09-30 07:46:50',1,97),
(98,'Teguh Erliyan','teguh-e@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,'2022-10-12 09:14:12','2022-10-12 09:14:12',1,98),
(99,'Istik Lailiah, S.Kom','istik@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,'2023-07-27 08:52:17','2023-07-27 08:52:17',1,99),
(100,'Muhammad Syafiq, S.Kom','msyafiq@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,'2023-07-27 08:53:11','2023-07-27 08:53:11',1,100),
(101,'Wahyu Dwi Permadi','wahyu_dp@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,'2023-10-30 09:20:24','2023-10-30 09:20:24',1,101),
(102,'Riyadlus Sholihin','riyadlus_sholihin@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,'2023-10-30 09:21:30','2023-10-30 09:21:30',1,102),
(103,'Raihana Ariba Nurlaili','rere_jti@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,'2023-10-30 09:22:23','2023-10-30 09:22:23',1,103),
(104,'Agus Santoso','agus_san@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,'2023-10-30 09:23:40','2023-10-30 09:23:40',1,104),
(105,'David Juli Ariyadi','david_juli@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,'2023-10-30 09:26:05','2024-03-14 07:56:39',1,105),
(106,'Ratna Dwi Kristina Sari','ratna_dks@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,'2023-10-30 09:27:25','2023-10-30 09:27:25',1,106),
(107,'Fitria \'Aziati','fitriaaziati999@gmail.com',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,'2023-10-30 09:28:47','2023-10-30 09:28:47',1,107),
(108,'Daniel Pugoh Wicaksono','daniel_pw@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,'2023-10-30 09:29:43','2023-10-30 09:29:43',1,108),
(109,'Riska Virliana Maharanti','riskavmh@gmail.com',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,'2023-10-30 09:30:37','2023-10-30 09:30:37',1,109),
(110,'Evan Hendra Lukito','evan_hl@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,'2023-10-30 09:31:45','2023-10-30 09:31:45',1,110),
(111,'Fajriansyah Decky Setiawan','fajriansyah_ds@gmail.com',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,'2023-10-30 09:32:29','2023-10-30 09:32:29',1,111),
(112,'Achmad Dinofaldi Firmansyah','bangik@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,'2024-03-07 00:44:55','2024-10-05 01:54:45',1,112),
(113,'Bunga Prasetya Dwi Ulul Azmi','bunga@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,'2024-03-07 00:46:44','2024-03-07 00:46:44',1,113),
(114,'Iphang Rere Admaja','iphang@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,'2024-03-07 00:49:09','2024-03-07 00:49:09',1,114),
(115,'Shinta Destira Ayu','shinta_destira@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,'2024-03-07 00:50:02','2024-03-07 00:53:15',1,115),
(116,'Yudi Sanjaya','yudi_sanjaya@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,'2024-03-07 01:33:36','2024-03-07 01:33:36',1,116),
(117,'Rahadian Teguh Nugroho','rahadian_teguh@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,'2024-03-07 01:52:05','2024-03-07 01:52:05',1,117),
(118,'Wahyu Putra Tri Mariono','wahyu_putra@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,'2024-03-07 01:52:33','2024-03-07 01:52:33',1,118),
(119,'Zayd Al Munshif','zayd@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,'2024-03-07 01:55:02','2024-03-07 01:55:02',1,119),
(120,'Achmad Syaifulloh','ach_syaifulloh@polije.ac.id',NULL,'$2y$10$QZ13DczOYaoI69lKXxnvP.f9gY9JNdHqL8DTLPnLx5hyCAdo2cW3S',NULL,NULL,NULL,NULL,'2024-03-07 01:55:54','2024-03-07 01:55:54',1,120);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `vExistMK`
--

DROP TABLE IF EXISTS `vExistMK`;
/*!50001 DROP VIEW IF EXISTS `vExistMK`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vExistMK` AS SELECT
 1 AS `tm_tahun_ajaran_id`,
  1 AS `tahun_ajaran`,
  1 AS `is_genap`,
  1 AS `is_aktif`,
  1 AS `tm_semester_id`,
  1 AS `semester`,
  1 AS `tr_matakuliah_semester_prodi_id`,
  1 AS `tm_program_studi_id`,
  1 AS `tm_matakuliah_id`,
  1 AS `matakuliah`,
  1 AS `kode`,
  1 AS `jumlah_golongan`,
  1 AS `tr_matakuliah_dosen_id`,
  1 AS `tm_staff_id`,
  1 AS `nama` */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vNotExistMK`
--

DROP TABLE IF EXISTS `vNotExistMK`;
/*!50001 DROP VIEW IF EXISTS `vNotExistMK`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vNotExistMK` AS SELECT
 1 AS `tm_tahun_ajaran_id`,
  1 AS `tahun_ajaran`,
  1 AS `is_genap`,
  1 AS `is_aktif`,
  1 AS `tm_semester_id`,
  1 AS `semester`,
  1 AS `tr_matakuliah_semester_prodi_id`,
  1 AS `tm_program_studi_id`,
  1 AS `tm_matakuliah_id`,
  1 AS `matakuliah`,
  1 AS `kode`,
  1 AS `jumlah_golongan`,
  1 AS `tr_matakuliah_dosen_id`,
  1 AS `tm_staff_id`,
  1 AS `nama` */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_barang_laboratorium`
--

DROP TABLE IF EXISTS `v_barang_laboratorium`;
/*!50001 DROP VIEW IF EXISTS `v_barang_laboratorium`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `v_barang_laboratorium` AS SELECT
 1 AS `id`,
  1 AS `tm_laboratorium_id`,
  1 AS `stok`,
  1 AS `kode`,
  1 AS `laboratorium`,
  1 AS `tm_jurusan_id`,
  1 AS `tm_barang_id`,
  1 AS `nama_barang`,
  1 AS `spesifikasi`,
  1 AS `keterangan`,
  1 AS `tm_satuan_id`,
  1 AS `satuan`,
  1 AS `tm_jenis_barang_id`,
  1 AS `jenis_barang`,
  1 AS `kode_barang`,
  1 AS `is_aktif_lab` */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_serma`
--

DROP TABLE IF EXISTS `v_serma`;
/*!50001 DROP VIEW IF EXISTS `v_serma`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `v_serma` AS SELECT
 1 AS `id`,
  1 AS `kode`,
  1 AS `tr_matakuliah_dosen_id`,
  1 AS `tr_matakuliah_semester_prodi_id`,
  1 AS `pengampu`,
  1 AS `tr_member_laboratorium_id`,
  1 AS `tm_laboratorium_id` */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vkartu_stok`
--

DROP TABLE IF EXISTS `vkartu_stok`;
/*!50001 DROP VIEW IF EXISTS `vkartu_stok`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vkartu_stok` AS SELECT
 1 AS `id`,
  1 AS `tr_barang_laboratorium_id`,
  1 AS `tm_barang_id`,
  1 AS `stok`,
  1 AS `is_aktif`,
  1 AS `is_stok_in`,
  1 AS `qty_kartu_stok`,
  1 AS `stok_kartu_stok`,
  1 AS `tr_member_laboratorium_id`,
  1 AS `tr_usulan_kebutuhan_detail_id` */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vpenggantian_praktek`
--

DROP TABLE IF EXISTS `vpenggantian_praktek`;
/*!50001 DROP VIEW IF EXISTS `vpenggantian_praktek`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vpenggantian_praktek` AS SELECT
 1 AS `id`,
  1 AS `jadwal_asli`,
  1 AS `jadwal_ganti`,
  1 AS `acara_praktek`,
  1 AS `tr_kaprodi_id`,
  1 AS `tr_member_laboratorium_id`,
  1 AS `tm_laboratorium_id`,
  1 AS `staff_laboratorium`,
  1 AS `created_at`,
  1 AS `updated_at`,
  1 AS `kode`,
  1 AS `tr_matakuliah_semester_prodi_id`,
  1 AS `tm_staff_id` */;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `vExistMK`
--

/*!50001 DROP VIEW IF EXISTS `vExistMK`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`silab`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vExistMK` AS select `a`.`id` AS `tm_tahun_ajaran_id`,`a`.`tahun_ajaran` AS `tahun_ajaran`,`a`.`is_genap` AS `is_genap`,`a`.`is_aktif` AS `is_aktif`,`b`.`id` AS `tm_semester_id`,`b`.`semester` AS `semester`,`c`.`id` AS `tr_matakuliah_semester_prodi_id`,`c`.`tm_program_studi_id` AS `tm_program_studi_id`,`c`.`tm_matakuliah_id` AS `tm_matakuliah_id`,`e`.`matakuliah` AS `matakuliah`,`e`.`kode` AS `kode`,`c`.`jumlah_golongan` AS `jumlah_golongan`,`d`.`id` AS `tr_matakuliah_dosen_id`,`d`.`tm_staff_id` AS `tm_staff_id`,`f`.`nama` AS `nama` from (((((`tm_tahun_ajaran` `a` join `tm_semester` `b`) join `tr_matakuliah_semester_prodi` `c`) join `tr_matakuliah_dosen` `d`) join `tm_matakuliah` `e`) join `tm_staff` `f`) where `a`.`id` = `b`.`tm_tahun_ajaran_id` and `b`.`id` = `c`.`tm_semester_id` and `c`.`id` = `d`.`tr_matakuliah_semester_prodi_id` and `a`.`is_aktif` = 1 and `c`.`tm_matakuliah_id` = `e`.`id` and `d`.`tm_staff_id` = `f`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vNotExistMK`
--

/*!50001 DROP VIEW IF EXISTS `vNotExistMK`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`silab`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vNotExistMK` AS select `a`.`id` AS `tm_tahun_ajaran_id`,`a`.`tahun_ajaran` AS `tahun_ajaran`,`a`.`is_genap` AS `is_genap`,`a`.`is_aktif` AS `is_aktif`,`b`.`id` AS `tm_semester_id`,`b`.`semester` AS `semester`,`c`.`id` AS `tr_matakuliah_semester_prodi_id`,`c`.`tm_program_studi_id` AS `tm_program_studi_id`,`c`.`tm_matakuliah_id` AS `tm_matakuliah_id`,`e`.`matakuliah` AS `matakuliah`,`e`.`kode` AS `kode`,`c`.`jumlah_golongan` AS `jumlah_golongan`,`d`.`id` AS `tr_matakuliah_dosen_id`,`d`.`tm_staff_id` AS `tm_staff_id`,`f`.`nama` AS `nama` from (((((`tm_tahun_ajaran` `a` join `tm_semester` `b`) join `tr_matakuliah_semester_prodi` `c`) join `tr_matakuliah_dosen` `d`) join `tm_matakuliah` `e`) join `tm_staff` `f`) where `a`.`id` = `b`.`tm_tahun_ajaran_id` and `b`.`id` = `c`.`tm_semester_id` and `c`.`id` = `d`.`tr_matakuliah_semester_prodi_id` and `a`.`is_aktif` = 0 and `c`.`tm_matakuliah_id` = `e`.`id` and `d`.`tm_staff_id` = `f`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_barang_laboratorium`
--

/*!50001 DROP VIEW IF EXISTS `v_barang_laboratorium`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`silab`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_barang_laboratorium` AS select `a`.`id` AS `id`,`a`.`tm_laboratorium_id` AS `tm_laboratorium_id`,`a`.`stok` AS `stok`,`b`.`kode` AS `kode`,`b`.`laboratorium` AS `laboratorium`,`b`.`tm_jurusan_id` AS `tm_jurusan_id`,`a`.`tm_barang_id` AS `tm_barang_id`,`c`.`nama_barang` AS `nama_barang`,`c`.`spesifikasi` AS `spesifikasi`,`a`.`keterangan` AS `keterangan`,`c`.`tm_satuan_id` AS `tm_satuan_id`,`e`.`satuan` AS `satuan`,`c`.`tm_jenis_barang_id` AS `tm_jenis_barang_id`,`d`.`jenis_barang` AS `jenis_barang`,`c`.`kode_barang` AS `kode_barang`,`a`.`is_aktif` AS `is_aktif_lab` from ((((`tr_barang_laboratorium` `a` join `tm_laboratorium` `b`) join `tm_barang` `c`) join `tm_jenis_barang` `d`) join `tm_satuan` `e`) where `a`.`tm_laboratorium_id` = `b`.`id` and `a`.`tm_barang_id` = `c`.`id` and `c`.`tm_jenis_barang_id` = `d`.`id` and `c`.`tm_satuan_id` = `e`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_serma`
--

/*!50001 DROP VIEW IF EXISTS `v_serma`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_serma` AS select `a`.`id` AS `id`,`a`.`kode` AS `kode`,`a`.`tr_matakuliah_dosen_id` AS `tr_matakuliah_dosen_id`,`d`.`tr_matakuliah_semester_prodi_id` AS `tr_matakuliah_semester_prodi_id`,`d`.`tm_staff_id` AS `pengampu`,`a`.`tr_member_laboratorium_id` AS `tr_member_laboratorium_id`,`b`.`tm_laboratorium_id` AS `tm_laboratorium_id` from ((`tr_serma_hasil_sisa_praktek` `a` join `tr_member_laboratorium` `b`) join `tr_matakuliah_dosen` `d`) where `a`.`tr_member_laboratorium_id` = `b`.`id` and `a`.`tr_matakuliah_dosen_id` = `d`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vkartu_stok`
--

/*!50001 DROP VIEW IF EXISTS `vkartu_stok`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`silab`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vkartu_stok` AS select `a`.`id` AS `id`,`a`.`tr_barang_laboratorium_id` AS `tr_barang_laboratorium_id`,`b`.`tm_barang_id` AS `tm_barang_id`,`b`.`stok` AS `stok`,`b`.`is_aktif` AS `is_aktif`,`a`.`is_stok_in` AS `is_stok_in`,`a`.`qty` AS `qty_kartu_stok`,`a`.`stok` AS `stok_kartu_stok`,`a`.`tr_member_laboratorium_id` AS `tr_member_laboratorium_id`,`a`.`tr_usulan_kebutuhan_detail_id` AS `tr_usulan_kebutuhan_detail_id` from (`tr_kartu_stok` `a` join `tr_barang_laboratorium` `b`) where `a`.`tr_barang_laboratorium_id` = `b`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vpenggantian_praktek`
--

/*!50001 DROP VIEW IF EXISTS `vpenggantian_praktek`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`silab`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vpenggantian_praktek` AS select `a`.`id` AS `id`,`a`.`jadwal_asli` AS `jadwal_asli`,`a`.`jadwal_ganti` AS `jadwal_ganti`,`a`.`acara_praktek` AS `acara_praktek`,`a`.`tr_kaprodi_id` AS `tr_kaprodi_id`,`a`.`tr_member_laboratorium_id` AS `tr_member_laboratorium_id`,`b`.`tm_laboratorium_id` AS `tm_laboratorium_id`,`b`.`tm_staff_id` AS `staff_laboratorium`,`a`.`created_at` AS `created_at`,`a`.`updated_at` AS `updated_at`,`a`.`kode` AS `kode`,`a`.`tr_matakuliah_semester_prodi_id` AS `tr_matakuliah_semester_prodi_id`,`a`.`tm_staff_id` AS `tm_staff_id` from (`tr_penggantian_praktek` `a` join `tr_member_laboratorium` `b`) where `a`.`tr_member_laboratorium_id` = `b`.`id` and `b`.`is_aktif` = 1 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-05 16:30:48
