/*
SQLyog Enterprise v13.1.1 (32 bit)
MySQL - 10.4.10-MariaDB : Database - laravel_spp
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`laravel_spp` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `laravel_spp`;

/*Table structure for table `expenses` */

DROP TABLE IF EXISTS `expenses`;

CREATE TABLE `expenses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sumber` enum('Sekolah','Yayasan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `expenses` */

insert  into `expenses`(`id`,`title`,`description`,`sumber`,`foto`,`nominal`,`created_at`,`updated_at`) values 
(3,'Beli Gedung','Beli','Yayasan','3aa7619c-8d0b-11ea-9aa2-025b510638641588488995_photo6102464760688781872.jpg',5000000000,'2020-05-03 13:56:35','2020-05-03 13:56:35'),
(4,'Beli PC','PC','Sekolah','7f5e9c42-8d0b-11ea-ba14-025b510638641588489110_photo6102464760688781872.jpg',50000000,'2020-05-03 13:58:30','2020-05-03 13:58:30');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `financing_categories` */

DROP TABLE IF EXISTS `financing_categories`;

CREATE TABLE `financing_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `besaran` int(11) NOT NULL,
  `jenis` enum('Bayar per Bulan','Sekali Bayar') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `financing_categories` */

insert  into `financing_categories`(`id`,`nama`,`besaran`,`jenis`,`created_at`,`updated_at`) values 
(27,'SPP',220000,'Bayar per Bulan','2020-05-03 05:09:14','2020-05-03 05:09:14'),
(28,'Praktikum / Semester',375000,'Sekali Bayar','2020-05-03 05:10:25','2020-05-03 05:10:25'),
(29,'Prakerin',350000,'Sekali Bayar','2020-05-03 05:11:20','2020-05-03 05:11:20'),
(30,'KUNJIN',900000,'Sekali Bayar','2020-05-03 05:11:50','2020-05-03 05:11:50'),
(31,'UAS / UKK',75000,'Sekali Bayar','2020-05-03 05:12:18','2020-05-03 05:12:18'),
(32,'Perpisahan',20000,'Sekali Bayar','2020-05-03 05:12:50','2020-05-03 05:12:50'),
(33,'PPDB',1950000,'Sekali Bayar','2020-05-03 05:14:37','2020-05-03 05:14:37');

/*Table structure for table `financing_category_resets` */

DROP TABLE IF EXISTS `financing_category_resets`;

CREATE TABLE `financing_category_resets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `financing_category_id` int(11) NOT NULL,
  `besaran` int(11) NOT NULL,
  `jenis` enum('Bayar per Bulan','Sekali Bayar') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `financing_category_resets` */

insert  into `financing_category_resets`(`id`,`financing_category_id`,`besaran`,`jenis`,`created_at`,`updated_at`) values 
(27,27,220000,'Bayar per Bulan','2020-05-03 05:09:14','2020-05-03 05:09:14'),
(28,28,375000,'Sekali Bayar','2020-05-03 05:10:25','2020-05-03 05:10:25'),
(29,29,350000,'Sekali Bayar','2020-05-03 05:11:20','2020-05-03 05:11:20'),
(30,30,900000,'Sekali Bayar','2020-05-03 05:11:50','2020-05-03 05:11:50'),
(31,31,75000,'Sekali Bayar','2020-05-03 05:12:18','2020-05-03 05:12:18'),
(32,32,20000,'Sekali Bayar','2020-05-03 05:12:50','2020-05-03 05:12:50'),
(33,33,1950000,'Sekali Bayar','2020-05-03 05:14:37','2020-05-03 05:14:37');

/*Table structure for table `majors` */

DROP TABLE IF EXISTS `majors`;

CREATE TABLE `majors` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `majors` */

insert  into `majors`(`id`,`nama`,`created_at`,`updated_at`) values 
(2,'Administrasi Perkantoran','2020-05-03 04:59:00','2020-05-03 04:59:00'),
(3,'Manajemen Multimedia','2020-05-03 04:59:45','2020-05-03 04:59:45'),
(4,'Keperawatan','2020-05-03 04:59:57','2020-05-03 04:59:57');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(57,'2020_04_29_021914_create_payment_periode_students_table',1),
(69,'2014_10_12_000000_create_users_table',2),
(70,'2014_10_12_100000_create_password_resets_table',2),
(71,'2019_08_19_000000_create_failed_jobs_table',2),
(72,'2020_04_27_173918_create_majors_table',2),
(73,'2020_04_27_174728_create_expenses_table',2),
(74,'2020_04_27_175215_create_financing_categories_table',2),
(75,'2020_04_27_175612_create_students_table',2),
(76,'2020_04_27_181412_create_payments_table',2),
(77,'2020_04_27_190943_create_financing_category_resets_table',2),
(78,'2020_04_27_192039_create_payment_details_table',2),
(80,'2020_04_29_021555_create_payment_periodes_table',3),
(81,'2020_04_29_021914_create_payment_periode_details_table',3),
(84,'2020_05_01_231037_create_pencatatans_table',4);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `payment_details` */

DROP TABLE IF EXISTS `payment_details`;

CREATE TABLE `payment_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tgl_dibayar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `status` enum('Lunas','Nunggak','Waiting') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `payment_details` */

insert  into `payment_details`(`id`,`tgl_dibayar`,`payment_id`,`user_id`,`nominal`,`status`,`created_at`,`updated_at`) values 
(15,'2020-05-03',169,1,375000,'Lunas','2020-05-03 12:44:34','2020-05-03 12:44:34'),
(16,'2020/05/03',176,1,350000,'Lunas','2020-05-03 12:46:45','2020-05-03 12:46:45'),
(17,'2020-05-03',170,1,375000,'Lunas','2020-05-03 13:59:27','2020-05-03 13:59:27');

/*Table structure for table `payment_periode_details` */

DROP TABLE IF EXISTS `payment_periode_details`;

CREATE TABLE `payment_periode_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `payment_periode_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` enum('Lunas','Nunggak','Waiting') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `payment_periode_details` */

insert  into `payment_periode_details`(`id`,`payment_periode_id`,`payment_id`,`user_id`,`status`,`created_at`,`updated_at`) values 
(93,39,162,1,'Lunas','2020-05-03 05:18:06','2020-05-03 05:21:00'),
(94,41,162,1,'Lunas','2020-05-03 05:18:21','2020-05-03 05:21:11'),
(95,42,162,1,'Lunas','2020-05-03 05:18:35','2020-05-03 05:21:24'),
(96,43,162,1,'Lunas','2020-05-03 05:18:49','2020-05-03 05:21:35'),
(97,44,162,1,'Lunas','2020-05-03 05:19:01','2020-05-03 05:21:46'),
(98,45,162,1,'Lunas','2020-05-03 05:19:15','2020-05-03 05:21:57'),
(99,46,162,1,'Lunas','2020-05-03 05:19:27','2020-05-03 05:22:08'),
(100,39,163,1,'Lunas','2020-05-03 05:19:58','2020-05-03 05:26:32'),
(101,41,163,1,'Lunas','2020-05-03 05:22:58','2020-05-03 05:26:20'),
(102,42,163,0,'Nunggak','2020-05-03 05:25:01','2020-05-03 12:29:59'),
(103,43,163,0,'Nunggak','2020-05-03 05:25:12','2020-05-03 12:30:13'),
(104,44,163,0,'Nunggak','2020-05-03 05:25:31','2020-05-03 12:30:24'),
(105,45,163,0,'Nunggak','2020-05-03 05:25:49','2020-05-03 12:30:37'),
(106,46,163,0,'Nunggak','2020-05-03 05:25:59','2020-05-03 12:30:51'),
(107,39,164,0,'Waiting','2020-05-03 12:31:28','2020-05-03 12:31:28'),
(108,41,164,1,'Lunas','2020-05-03 12:32:30','2020-05-03 12:33:58'),
(109,42,164,1,'Lunas','2020-05-03 12:32:44','2020-05-03 12:34:10'),
(110,43,164,1,'Lunas','2020-05-03 12:32:56','2020-05-03 12:34:24'),
(111,44,164,1,'Lunas','2020-05-03 12:33:09','2020-05-03 12:34:40'),
(112,45,164,0,'Nunggak','2020-05-03 12:33:20','2020-05-03 12:34:59'),
(113,46,164,0,'Waiting','2020-05-03 12:33:34','2020-05-03 12:33:34'),
(114,39,165,0,'Waiting','2020-05-03 12:39:11','2020-05-03 12:39:11'),
(115,41,165,0,'Nunggak','2020-05-03 12:40:25','2020-05-03 12:41:35'),
(116,42,165,1,'Lunas','2020-05-03 12:40:34','2020-05-03 12:41:49'),
(117,43,165,0,'Nunggak','2020-05-03 12:40:43','2020-05-03 12:42:09'),
(118,44,165,1,'Lunas','2020-05-03 12:40:53','2020-05-03 12:42:34'),
(119,45,165,1,'Lunas','2020-05-03 12:41:03','2020-05-03 12:42:52'),
(120,46,165,1,'Lunas','2020-05-03 12:41:12','2020-05-03 12:43:05'),
(121,47,162,0,'Waiting','2020-05-03 22:14:56','2020-05-03 22:14:56'),
(122,47,163,0,'Waiting','2020-05-03 22:14:56','2020-05-03 22:14:56'),
(123,47,164,0,'Waiting','2020-05-03 22:14:56','2020-05-03 22:14:56'),
(124,47,165,0,'Waiting','2020-05-03 22:14:56','2020-05-03 22:14:56'),
(125,47,166,0,'Waiting','2020-05-03 22:14:56','2020-05-03 22:14:56'),
(126,47,167,0,'Waiting','2020-05-03 22:14:56','2020-05-03 22:14:56'),
(127,47,168,0,'Waiting','2020-05-03 22:14:56','2020-05-03 22:14:56');

/*Table structure for table `payment_periodes` */

DROP TABLE IF EXISTS `payment_periodes`;

CREATE TABLE `payment_periodes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `financing_category_id` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `payment_periodes` */

insert  into `payment_periodes`(`id`,`financing_category_id`,`bulan`,`tahun`,`nominal`,`created_at`,`updated_at`) values 
(39,27,7,2019,220000,'2020-05-03 05:15:16','2020-05-03 05:15:16'),
(41,27,8,2019,220000,'2020-05-03 05:15:54','2020-05-03 05:15:54'),
(42,27,9,2019,220000,'2020-05-03 05:16:07','2020-05-03 05:16:07'),
(43,27,10,2019,220000,'2020-05-03 05:16:23','2020-05-03 05:16:23'),
(44,27,11,2019,220000,'2020-05-03 05:16:38','2020-05-03 05:16:38'),
(45,27,12,2019,220000,'2020-05-03 05:17:01','2020-05-03 05:17:01'),
(46,27,1,2020,220000,'2020-05-03 05:17:12','2020-05-03 05:17:12'),
(47,27,5,2020,220000,'2020-05-03 22:14:56','2020-05-03 22:14:56');

/*Table structure for table `payments` */

DROP TABLE IF EXISTS `payments`;

CREATE TABLE `payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `financing_category_id` int(11) NOT NULL,
  `jenis_pembayaran` enum('Tunai','Cicilan','Waiting') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=211 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `payments` */

insert  into `payments`(`id`,`student_id`,`financing_category_id`,`jenis_pembayaran`,`created_at`,`updated_at`) values 
(162,9,27,'Waiting','2020-05-03 05:09:14','2020-05-03 05:09:14'),
(163,10,27,'Waiting','2020-05-03 05:09:14','2020-05-03 05:09:14'),
(164,11,27,'Waiting','2020-05-03 05:09:14','2020-05-03 05:09:14'),
(165,12,27,'Waiting','2020-05-03 05:09:14','2020-05-03 05:09:14'),
(166,13,27,'Waiting','2020-05-03 05:09:14','2020-05-03 05:09:14'),
(167,14,27,'Waiting','2020-05-03 05:09:14','2020-05-03 05:09:14'),
(168,15,27,'Waiting','2020-05-03 05:09:14','2020-05-03 05:09:14'),
(169,9,28,'Tunai','2020-05-03 05:10:25','2020-05-03 12:44:34'),
(170,10,28,'Tunai','2020-05-03 05:10:25','2020-05-03 13:59:27'),
(171,11,28,'Waiting','2020-05-03 05:10:25','2020-05-03 05:10:25'),
(172,12,28,'Waiting','2020-05-03 05:10:25','2020-05-03 05:10:25'),
(173,13,28,'Waiting','2020-05-03 05:10:25','2020-05-03 05:10:25'),
(174,14,28,'Waiting','2020-05-03 05:10:25','2020-05-03 05:10:25'),
(175,15,28,'Waiting','2020-05-03 05:10:25','2020-05-03 05:10:25'),
(176,9,29,'Cicilan','2020-05-03 05:11:20','2020-05-03 12:46:30'),
(177,10,29,'Waiting','2020-05-03 05:11:20','2020-05-03 05:11:20'),
(178,11,29,'Waiting','2020-05-03 05:11:20','2020-05-03 05:11:20'),
(179,12,29,'Waiting','2020-05-03 05:11:20','2020-05-03 05:11:20'),
(180,13,29,'Waiting','2020-05-03 05:11:20','2020-05-03 05:11:20'),
(181,14,29,'Waiting','2020-05-03 05:11:20','2020-05-03 05:11:20'),
(182,15,29,'Waiting','2020-05-03 05:11:20','2020-05-03 05:11:20'),
(183,9,30,'Waiting','2020-05-03 05:11:50','2020-05-03 05:11:50'),
(184,10,30,'Waiting','2020-05-03 05:11:50','2020-05-03 05:11:50'),
(185,11,30,'Waiting','2020-05-03 05:11:50','2020-05-03 05:11:50'),
(186,12,30,'Waiting','2020-05-03 05:11:50','2020-05-03 05:11:50'),
(187,13,30,'Waiting','2020-05-03 05:11:50','2020-05-03 05:11:50'),
(188,14,30,'Waiting','2020-05-03 05:11:50','2020-05-03 05:11:50'),
(189,15,30,'Waiting','2020-05-03 05:11:50','2020-05-03 05:11:50'),
(190,9,31,'Waiting','2020-05-03 05:12:18','2020-05-03 05:12:18'),
(191,10,31,'Waiting','2020-05-03 05:12:18','2020-05-03 05:12:18'),
(192,11,31,'Waiting','2020-05-03 05:12:18','2020-05-03 05:12:18'),
(193,12,31,'Waiting','2020-05-03 05:12:18','2020-05-03 05:12:18'),
(194,13,31,'Waiting','2020-05-03 05:12:18','2020-05-03 05:12:18'),
(195,14,31,'Waiting','2020-05-03 05:12:18','2020-05-03 05:12:18'),
(196,15,31,'Waiting','2020-05-03 05:12:18','2020-05-03 05:12:18'),
(197,9,32,'Waiting','2020-05-03 05:12:50','2020-05-03 05:12:50'),
(198,10,32,'Waiting','2020-05-03 05:12:50','2020-05-03 05:12:50'),
(199,11,32,'Waiting','2020-05-03 05:12:50','2020-05-03 05:12:50'),
(200,12,32,'Waiting','2020-05-03 05:12:50','2020-05-03 05:12:50'),
(201,13,32,'Waiting','2020-05-03 05:12:50','2020-05-03 05:12:50'),
(202,14,32,'Waiting','2020-05-03 05:12:50','2020-05-03 05:12:50'),
(203,15,32,'Waiting','2020-05-03 05:12:50','2020-05-03 05:12:50'),
(204,9,33,'Waiting','2020-05-03 05:14:37','2020-05-03 05:14:37'),
(205,10,33,'Waiting','2020-05-03 05:14:37','2020-05-03 05:14:37'),
(206,11,33,'Waiting','2020-05-03 05:14:37','2020-05-03 05:14:37'),
(207,12,33,'Waiting','2020-05-03 05:14:37','2020-05-03 05:14:37'),
(208,13,33,'Waiting','2020-05-03 05:14:37','2020-05-03 05:14:37'),
(209,14,33,'Waiting','2020-05-03 05:14:37','2020-05-03 05:14:37'),
(210,15,33,'Waiting','2020-05-03 05:14:37','2020-05-03 05:14:37');

/*Table structure for table `pencatatans` */

DROP TABLE IF EXISTS `pencatatans`;

CREATE TABLE `pencatatans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `debit` bigint(20) NOT NULL,
  `kredit` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pencatatans` */

insert  into `pencatatans`(`id`,`description`,`debit`,`kredit`,`created_at`,`updated_at`) values 
(1,'Pembelian Beli Gedung oleh Yayasan',0,0,'2020-05-03 13:56:35','2020-05-03 13:56:35'),
(2,'Pembelian Beli PC oleh Sekolah',0,50000000,'2020-05-03 13:58:30','2020-05-03 13:58:30'),
(3,'Pembayaran Praktikum / Semester dari Nita Oktaviani kelas X ( Administrasi Perkantoran ) diterima oleh Muhammad Nurfaadil',375000,0,'2020-05-03 13:59:27','2020-05-03 13:59:27');

/*Table structure for table `students` */

DROP TABLE IF EXISTS `students`;

CREATE TABLE `students` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nis` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` enum('X','XI','XII') COLLATE utf8mb4_unicode_ci NOT NULL,
  `major_id` int(11) NOT NULL,
  `phone` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_masuk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `students` */

insert  into `students`(`id`,`nis`,`nama`,`jenis_kelamin`,`kelas`,`major_id`,`phone`,`email`,`tgl_masuk`,`created_at`,`updated_at`) values 
(9,'20200502001','Aulia Anisa','P','XI',2,'088888888888','siswa@baabulkamil.com','2019-01-07','2020-05-03 05:03:16','2020-05-03 05:04:33'),
(10,'20200502002','Nita Oktaviani','P','X',2,'088888888888','siswa@baabulkamil.com','2019-01-07','2020-05-03 05:05:13','2020-05-03 05:05:13'),
(11,'20200502003','Reski Maharani','P','X',2,'088888888888','siswa@baabulkamil.com','2018-12-31','2020-05-03 05:05:54','2020-05-03 05:05:54'),
(12,'20200502004','Riska Melani','P','X',2,'088888888888','siswa@baabulkamil.com','2019-01-07','2020-05-03 05:06:36','2020-05-03 05:06:36'),
(13,'20200502005','Sinta Herdiyanti','P','X',2,'088888888888','siswa@baabulkamil.com','2019-01-07','2020-05-03 05:07:19','2020-05-03 05:07:19'),
(14,'20200502006','Sri Suryani','P','X',2,'088888888888','siswa@baabulkamil.com','2019-01-07','2020-05-03 05:07:53','2020-05-03 05:07:53'),
(15,'20200502007','Tiwi','P','X',2,'088888888888','siswa@baabulkamil.com','2019-01-07','2020-05-03 05:08:30','2020-05-03 05:08:30');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('Sekolah','Yayasan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`username`,`email`,`email_verified_at`,`password`,`role`,`remember_token`,`created_at`,`updated_at`) values 
(1,'Muhammad Nurfaadil','robi','robi@support.com',NULL,'$2y$10$9OB49v7rKN9N3yzumXcttuwZrm0MB0hoE1ydk43EoBljG5RpBZa2O','Sekolah',NULL,'2020-05-01 23:08:07','2020-05-03 02:05:26');

/* Function  structure for function  `getAkumulasiPerBulan` */

/*!50003 DROP FUNCTION IF EXISTS `getAkumulasiPerBulan` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `getAkumulasiPerBulan`(id int) RETURNS int(11)
BEGIN
    declare v int;
    SELECT SUM(pd.`nominal`) into v FROM payment_periode_details ppd
JOIN payment_periodes pd ON ppd.`payment_periode_id`=pd.id
WHERE payment_id=id;
return v;
    END */$$
DELIMITER ;

/* Function  structure for function  `getBesaranBiayaKategoriPembiayaan` */

/*!50003 DROP FUNCTION IF EXISTS `getBesaranBiayaKategoriPembiayaan` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `getBesaranBiayaKategoriPembiayaan`(param int) RETURNS int(11)
BEGIN
	SET @val='';
	select besaran into @val from financing_categories
	where id=param;
	return @val;
    END */$$
DELIMITER ;

/* Function  structure for function  `getBesaranBiayaTerbayar` */

/*!50003 DROP FUNCTION IF EXISTS `getBesaranBiayaTerbayar` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `getBesaranBiayaTerbayar`(id_siswa int, id_kategori int) RETURNS int(11)
BEGIN
	set @val='';
	select sum(nominal) into @val from payment_details pd
	join payments p on p.id = pd.payment_id
	join students s on s.id = p.student_id
	where
	s.id = id_siswa and
	p.financing_category_id = id_kategori;
	return @val;
    END */$$
DELIMITER ;

/* Function  structure for function  `getBulanTidakTerbayar` */

/*!50003 DROP FUNCTION IF EXISTS `getBulanTidakTerbayar` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `getBulanTidakTerbayar`(payment_id int) RETURNS int(11)
BEGIN
    declare v int default 0;
	SELECT COUNT(*) into v FROM payment_periode_details ppd
WHERE ppd.payment_id = payment_id AND STATUS != "Lunas";
	return v;
    END */$$
DELIMITER ;

/* Function  structure for function  `getCountBulananTidakTerbayar` */

/*!50003 DROP FUNCTION IF EXISTS `getCountBulananTidakTerbayar` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `getCountBulananTidakTerbayar`(id int) RETURNS int(11)
BEGIN
	declare v int;
	SELECT COUNT(*) into v FROM payment_periode_details ppd WHERE STATUS="Nunggak" AND payment_id=id;
	return v;
    END */$$
DELIMITER ;

/* Function  structure for function  `getCountDetailBulanan` */

/*!50003 DROP FUNCTION IF EXISTS `getCountDetailBulanan` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `getCountDetailBulanan`(pay_id int) RETURNS int(11)
BEGIN
    declare v int;
    SELECT COUNT(*) into v FROM payment_periode_details
WHERE payment_id=pay_id;
	return v;
    END */$$
DELIMITER ;

/* Function  structure for function  `getCountWaiting` */

/*!50003 DROP FUNCTION IF EXISTS `getCountWaiting` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `getCountWaiting`(pay_id int) RETURNS int(11)
BEGIN
    declare v int;
    SELECT COUNT(STATUS) into v FROM payment_periode_details
WHERE STATUS = "Waiting" AND payment_id=pay_id;
return v;
    END */$$
DELIMITER ;

/* Function  structure for function  `getJumlahNunggak` */

/*!50003 DROP FUNCTION IF EXISTS `getJumlahNunggak` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `getJumlahNunggak`() RETURNS int(11)
BEGIN
    declare v,s int;
    SELECT COUNT(*) into v FROM students s
JOIN payments p ON p.`student_id`=s.`id`
JOIN `payment_details` pd ON pd.`payment_id`=p.`id`
WHERE pd.`status`="Nunggak";

SELECT COUNT(*) into s FROM students s
JOIN payments p ON p.`student_id`=s.`id`
JOIN `payment_periode_details` ppd ON ppd.`payment_id`=p.`id`
WHERE ppd.`status`="Nunggak";

	return v+s;
    END */$$
DELIMITER ;

/* Function  structure for function  `getJumlahPeriodePembayaran` */

/*!50003 DROP FUNCTION IF EXISTS `getJumlahPeriodePembayaran` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `getJumlahPeriodePembayaran`(id int) RETURNS int(11)
BEGIN
    set @val='';
    select count(*) into @val FROM payment_periodes WHERE financing_category_id=id;
return @val;
    END */$$
DELIMITER ;

/* Function  structure for function  `getJumlahPeriodeTerbayar` */

/*!50003 DROP FUNCTION IF EXISTS `getJumlahPeriodeTerbayar` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `getJumlahPeriodeTerbayar`(id_siswa int, id_kategori int) RETURNS int(11)
BEGIN
    set @v='';
	SELECT COUNT(*) into @v FROM payment_periodes ps
    JOIN payment_periode_students pps ON pps.`payment_periode_id`=ps.`id`
    JOIN students s ON s.`id` = pps.`student_id`    
    WHERE ps.financing_category_id=id_kategori
    AND s.`id`=id_siswa;
    return @v;
    END */$$
DELIMITER ;

/* Function  structure for function  `getJumlahSiswa` */

/*!50003 DROP FUNCTION IF EXISTS `getJumlahSiswa` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `getJumlahSiswa`() RETURNS int(11)
BEGIN
    declare v int;
    SELECT COUNT(*) into v FROM students;
    return v;

    END */$$
DELIMITER ;

/* Function  structure for function  `getNominalPembayaranBulanan` */

/*!50003 DROP FUNCTION IF EXISTS `getNominalPembayaranBulanan` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `getNominalPembayaranBulanan`(id int) RETURNS int(11)
BEGIN
    set @v='';
    SELECT SUM(nominal) into @v FROM payment_periodes ps 
WHERE ps.`financing_category_id`=id;
return @v;

    END */$$
DELIMITER ;

/* Function  structure for function  `getNominalSekaliBayarTerbayar` */

/*!50003 DROP FUNCTION IF EXISTS `getNominalSekaliBayarTerbayar` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `getNominalSekaliBayarTerbayar`(id_siswa int, id_kategori int) RETURNS int(11)
BEGIN
	declare v int default 0;
	SELECT SUM(nominal) into v FROM payment_details pd
JOIN payments p ON p.`id`=pd.`payment_id`
WHERE p.`financing_category_id`=id_kategori
AND p.`student_id`=id_siswa;
return v;
    END */$$
DELIMITER ;

/* Function  structure for function  `getNominalTerbayar` */

/*!50003 DROP FUNCTION IF EXISTS `getNominalTerbayar` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `getNominalTerbayar`(id_pay int, id_kategori int) RETURNS int(11)
BEGIN
	declare v, s, c int;
	SELECT COUNT(STATUS) into v FROM payment_periode_details
	WHERE STATUS = "Lunas" AND payment_id=id_pay;
	select besaran into s from financing_categories
	where id = id_kategori;
	return v*s;
return @v;
    END */$$
DELIMITER ;

/* Function  structure for function  `getNominalTerbayarBulanan` */

/*!50003 DROP FUNCTION IF EXISTS `getNominalTerbayarBulanan` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `getNominalTerbayarBulanan`(id_pay int) RETURNS int(11)
BEGIN
	declare v int;
	SELECT SUM(nominal) into v FROM payment_periodes pp
JOIN payment_periode_details ppd ON ppd.`payment_periode_id`=pp.`id`
WHERE STATUS = "Lunas" and ppd.`payment_id`=id_pay;
	return v;
return @v;
    END */$$
DELIMITER ;

/* Function  structure for function  `paid_once` */

/*!50003 DROP FUNCTION IF EXISTS `paid_once` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `paid_once`(id int) RETURNS int(11)
BEGIN
	declare v int;
	SELECT SUM(nominal) into v FROM payment_details WHERE payment_id=id;
	return v;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `getPenghitunganPerBulan` */

/*!50003 DROP PROCEDURE IF EXISTS  `getPenghitunganPerBulan` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `getPenghitunganPerBulan`(id_siswa int, id_kategori int)
BEGIN
		SELECT `getJumlahPeriodeTerbayar`(id_siswa,id_kategori) AS terbayar, 
		`getJumlahPeriodePembayaran`(id_kategori) AS total, 
		`getNominalPembayaran`(id_kategori) AS nominalPembayaran, 
		`getNominalTerbayar`(id_siswa,id_kategori) AS nominalTerbayar;
	END */$$
DELIMITER ;

/* Procedure structure for procedure `pilihKategori` */

/*!50003 DROP PROCEDURE IF EXISTS  `pilihKategori` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `pilihKategori`(id int)
BEGIN
		SELECT fc.*, p.`jenis_pembayaran` FROM financing_categories fc
LEFT OUTER JOIN payments p ON p.`financing_category_id`=fc.`id` 
WHERE p.student_id IS NULL OR p.`student_id`=id
ORDER BY fc.id;

	END */$$
DELIMITER ;

/*Table structure for table `dashboard_view` */

DROP TABLE IF EXISTS `dashboard_view`;

/*!50001 DROP VIEW IF EXISTS `dashboard_view` */;
/*!50001 DROP TABLE IF EXISTS `dashboard_view` */;

/*!50001 CREATE TABLE  `dashboard_view`(
 `pemasukan` decimal(41,0) ,
 `pengeluaran` decimal(41,0) ,
 `siswa` int(11) ,
 `nunggak` int(11) 
)*/;

/*Table structure for table `payment_views` */

DROP TABLE IF EXISTS `payment_views`;

/*!50001 DROP VIEW IF EXISTS `payment_views` */;
/*!50001 DROP TABLE IF EXISTS `payment_views` */;

/*!50001 CREATE TABLE  `payment_views`(
 `idSiswa` bigint(20) unsigned ,
 `idPembayaran` bigint(20) unsigned ,
 `idDetail` bigint(20) unsigned ,
 `idKategori` bigint(20) unsigned ,
 `nis` varchar(15) ,
 `nama` varchar(255) ,
 `kelas` enum('X','XI','XII') ,
 `jurusan` varchar(255) ,
 `penerima` varchar(255) ,
 `status` enum('Lunas','Nunggak','Waiting') ,
 `kategori` varchar(255) ,
 `jenis_kategori_pembayaran` enum('Bayar per Bulan','Sekali Bayar') ,
 `jenis_pembayaran` enum('Tunai','Cicilan','Waiting') ,
 `biaya` int(11) ,
 `terbayar` int(11) ,
 `nominal` int(11) 
)*/;

/*Table structure for table `view_detail_once` */

DROP TABLE IF EXISTS `view_detail_once`;

/*!50001 DROP VIEW IF EXISTS `view_detail_once` */;
/*!50001 DROP TABLE IF EXISTS `view_detail_once` */;

/*!50001 CREATE TABLE  `view_detail_once`(
 `id` bigint(20) unsigned ,
 `nis` varchar(15) ,
 `nama` varchar(255) ,
 `jenis_kelamin` enum('L','P') ,
 `kelas` enum('X','XI','XII') ,
 `major_id` int(11) ,
 `phone` varchar(14) ,
 `email` varchar(255) ,
 `tgl_masuk` varchar(255) ,
 `created_at` timestamp ,
 `updated_at` timestamp ,
 `akumulasi` int(11) ,
 `financing_nama` varchar(255) ,
 `terbayar` int(11) ,
 `financing_id` bigint(20) unsigned ,
 `payment_id` bigint(20) unsigned ,
 `jenis_pembayaran` enum('Tunai','Cicilan','Waiting') 
)*/;

/*Table structure for table `view_detail_once_2` */

DROP TABLE IF EXISTS `view_detail_once_2`;

/*!50001 DROP VIEW IF EXISTS `view_detail_once_2` */;
/*!50001 DROP TABLE IF EXISTS `view_detail_once_2` */;

/*!50001 CREATE TABLE  `view_detail_once_2`(
 `id` bigint(20) unsigned ,
 `nis` varchar(15) ,
 `nama` varchar(255) ,
 `jenis_kelamin` enum('L','P') ,
 `kelas` enum('X','XI','XII') ,
 `major_id` int(11) ,
 `phone` varchar(14) ,
 `email` varchar(255) ,
 `tgl_masuk` varchar(255) ,
 `created_at` timestamp ,
 `updated_at` timestamp ,
 `akumulasi` int(11) ,
 `financing_nama` varchar(255) ,
 `terbayar` int(11) ,
 `financing_id` bigint(20) unsigned ,
 `payment_id` bigint(20) unsigned ,
 `jenis_pembayaran` enum('Tunai','Cicilan','Waiting') 
)*/;

/*View structure for view dashboard_view */

/*!50001 DROP TABLE IF EXISTS `dashboard_view` */;
/*!50001 DROP VIEW IF EXISTS `dashboard_view` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dashboard_view` AS select sum(`pencatatans`.`debit`) AS `pemasukan`,sum(`pencatatans`.`kredit`) AS `pengeluaran`,`getJumlahSiswa`() AS `siswa`,`getJumlahNunggak`() AS `nunggak` from `pencatatans` */;

/*View structure for view payment_views */

/*!50001 DROP TABLE IF EXISTS `payment_views` */;
/*!50001 DROP VIEW IF EXISTS `payment_views` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payment_views` AS select `s`.`id` AS `idSiswa`,`p`.`id` AS `idPembayaran`,`pd`.`id` AS `idDetail`,`fc`.`id` AS `idKategori`,`s`.`nis` AS `nis`,`s`.`nama` AS `nama`,`s`.`kelas` AS `kelas`,`m`.`nama` AS `jurusan`,`u`.`name` AS `penerima`,`pd`.`status` AS `status`,`fc`.`nama` AS `kategori`,`fc`.`jenis` AS `jenis_kategori_pembayaran`,`p`.`jenis_pembayaran` AS `jenis_pembayaran`,`getBesaranBiayaKategoriPembiayaan`(`p`.`financing_category_id`) AS `biaya`,`getBesaranBiayaTerbayar`(`s`.`id`,`p`.`financing_category_id`) AS `terbayar`,`pd`.`nominal` AS `nominal` from (((((`payment_details` `pd` join `payments` `p` on(`pd`.`payment_id` = `p`.`id`)) join `students` `s` on(`s`.`id` = `p`.`student_id`)) join `majors` `m` on(`m`.`id` = `s`.`major_id`)) join `users` `u` on(`u`.`id` = `pd`.`user_id`)) join `financing_categories` `fc` on(`p`.`financing_category_id` = `fc`.`id`)) */;

/*View structure for view view_detail_once */

/*!50001 DROP TABLE IF EXISTS `view_detail_once` */;
/*!50001 DROP VIEW IF EXISTS `view_detail_once` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_detail_once` AS select `s`.`id` AS `id`,`s`.`nis` AS `nis`,`s`.`nama` AS `nama`,`s`.`jenis_kelamin` AS `jenis_kelamin`,`s`.`kelas` AS `kelas`,`s`.`major_id` AS `major_id`,`s`.`phone` AS `phone`,`s`.`email` AS `email`,`s`.`tgl_masuk` AS `tgl_masuk`,`s`.`created_at` AS `created_at`,`s`.`updated_at` AS `updated_at`,`fc`.`besaran` AS `akumulasi`,`fc`.`nama` AS `financing_nama`,`paid_once`(`p`.`id`) AS `terbayar`,`fc`.`id` AS `financing_id`,`p`.`id` AS `payment_id`,`p`.`jenis_pembayaran` AS `jenis_pembayaran` from (((`students` `s` left join `payments` `p` on(`s`.`id` = `p`.`student_id`)) left join `financing_categories` `fc` on(`fc`.`id` = `p`.`financing_category_id`)) left join `payment_details` `pd` on(`pd`.`payment_id` = `p`.`id`)) group by `s`.`id` */;

/*View structure for view view_detail_once_2 */

/*!50001 DROP TABLE IF EXISTS `view_detail_once_2` */;
/*!50001 DROP VIEW IF EXISTS `view_detail_once_2` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_detail_once_2` AS select `s`.`id` AS `id`,`s`.`nis` AS `nis`,`s`.`nama` AS `nama`,`s`.`jenis_kelamin` AS `jenis_kelamin`,`s`.`kelas` AS `kelas`,`s`.`major_id` AS `major_id`,`s`.`phone` AS `phone`,`s`.`email` AS `email`,`s`.`tgl_masuk` AS `tgl_masuk`,`s`.`created_at` AS `created_at`,`s`.`updated_at` AS `updated_at`,`fc`.`besaran` AS `akumulasi`,`fc`.`nama` AS `financing_nama`,`paid_once`(`p`.`id`) AS `terbayar`,`fc`.`id` AS `financing_id`,`p`.`id` AS `payment_id`,`p`.`jenis_pembayaran` AS `jenis_pembayaran` from (((`students` `s` left join `payments` `p` on(`s`.`id` = `p`.`student_id`)) left join `financing_categories` `fc` on(`fc`.`id` = `p`.`financing_category_id`)) left join `payment_details` `pd` on(`pd`.`payment_id` = `p`.`id`)) group by `s`.`id` */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
