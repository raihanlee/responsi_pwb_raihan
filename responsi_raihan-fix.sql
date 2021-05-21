/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.4.14-MariaDB : Database - responsi_pwb_raihan
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `detail_pesanan` */

DROP TABLE IF EXISTS `detail_pesanan`;

CREATE TABLE `detail_pesanan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pesanan_id` int(11) NOT NULL,
  `bayar` int(11) NOT NULL,
  `tanggal_dibuat` date NOT NULL,
  `tanggal_diubah` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_pesanan_fk0` (`pesanan_id`),
  CONSTRAINT `detail_pesanan_fk0` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanan` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

/*Data for the table `detail_pesanan` */

insert  into `detail_pesanan`(`id`,`pesanan_id`,`bayar`,`tanggal_dibuat`,`tanggal_diubah`) values 
(7,14,30000,'2021-05-21','2021-05-21'),
(8,13,15000,'2021-05-21','2021-05-21'),
(9,6,26000,'2021-05-21','2021-05-21'),
(10,15,13000,'2021-05-21','2021-05-21');

/*Table structure for table `level` */

DROP TABLE IF EXISTS `level`;

CREATE TABLE `level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keterangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `level` */

insert  into `level`(`id`,`keterangan`) values 
(1,'admin'),
(2,'pembeli');

/*Table structure for table `makanan` */

DROP TABLE IF EXISTS `makanan`;

CREATE TABLE `makanan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

/*Data for the table `makanan` */

insert  into `makanan`(`id`,`nama`,`harga`,`gambar`) values 
(10,'Mie Ayam',13000,'1579229757_Untitled-1.png'),
(11,'Bakso',12000,'250187304_bg.jpeg'),
(12,'Nasi Goreng',15000,'591199205_iphone_6s_plus_power_button (1).jpg'),
(13,'Mie Goreng',15000,'1903754568_gsmarena_006.jpg');

/*Table structure for table `pengguna` */

DROP TABLE IF EXISTS `pengguna`;

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level_id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pengguna_fk0` (`level_id`),
  CONSTRAINT `pengguna_fk0` FOREIGN KEY (`level_id`) REFERENCES `level` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pengguna` */

insert  into `pengguna`(`id`,`level_id`,`nama`,`username`,`password`,`alamat`) values 
(1,1,'Admin','admin','admin','jl. admin'),
(2,2,'Raihan','raihan','raihan','jl. rajawali');

/*Table structure for table `pesanan` */

DROP TABLE IF EXISTS `pesanan`;

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `makanan_id` int(11) NOT NULL,
  `pengguna_id` int(11) NOT NULL,
  `jumlah_beli` int(11) NOT NULL,
  `tanggal_dibuat` date NOT NULL,
  `tanggal_diubah` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pesanan_fk0` (`makanan_id`),
  KEY `pesanan_fk1` (`pengguna_id`),
  CONSTRAINT `pesanan_fk0` FOREIGN KEY (`makanan_id`) REFERENCES `makanan` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pesanan_fk1` FOREIGN KEY (`pengguna_id`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pesanan` */

insert  into `pesanan`(`id`,`makanan_id`,`pengguna_id`,`jumlah_beli`,`tanggal_dibuat`,`tanggal_diubah`) values 
(6,10,2,2,'2021-05-20','2021-05-20'),
(13,13,2,1,'2021-05-21','2021-05-21'),
(14,12,2,2,'2021-05-21','2021-05-21'),
(15,10,2,1,'2021-05-21','2021-05-21'),
(16,12,2,2,'2021-05-21','2021-05-21'),
(17,11,2,500,'2021-05-21','2021-05-21');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
