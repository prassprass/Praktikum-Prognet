/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.1.32-MariaDB : Database - db_prognet_tnt
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_progent_tnt` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_prognet_tnt`;

/*Table structure for table `tbl_admin` */

DROP TABLE IF EXISTS `tbl_admin`;

CREATE TABLE `tbl_admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_admin` */

insert  into `tbl_admin`(`id_admin`,`username`,`password`) values 
(1,'admin','admin');

/*Table structure for table `tbl_booking` */

DROP TABLE IF EXISTS `tbl_booking`;

CREATE TABLE `tbl_booking` (
  `id_booking` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `banyak_traveler` int(11) DEFAULT NULL,
  `tgl_booking` date DEFAULT NULL,
  `id_paket` int(11) DEFAULT NULL,
  `tgl_traveling` date DEFAULT NULL,
  `permintaan_spesial` varchar(100) DEFAULT NULL,
  `biaya_traveling` int(11) DEFAULT NULL,
  `biaya_tambahan` int(11) DEFAULT NULL,
  `ket_biaya_tambahan` varchar(100) DEFAULT NULL,
  `status_pembayaran` tinyint(1) DEFAULT NULL,
  `status_cancle` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_booking`),
  KEY `id_paket` (`id_paket`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `tbl_booking_ibfk_1` FOREIGN KEY (`id_paket`) REFERENCES `tbl_paket` (`id_paket`),
  CONSTRAINT `tbl_booking_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_booking` */

insert  into `tbl_booking`(`id_booking`,`id_user`,`banyak_traveler`,`tgl_booking`,`id_paket`,`tgl_traveling`,`permintaan_spesial`,`biaya_traveling`,`biaya_tambahan`,`ket_biaya_tambahan`,`status_pembayaran`,`status_cancle`) values 
(27,1,2,'2018-05-07',7,'2018-05-24','',2400000,0,'Tidak ada Tambahan Bosss, Siap berangkat',1,0),
(28,2,1,'2018-05-08',2,'2019-03-15','',780000,NULL,NULL,0,1),
(29,1,15,'2018-05-09',2,'2018-05-17','',11700000,NULL,NULL,0,1),
(30,4,2,'2018-05-16',9,'2018-05-28','spesial',4400000,10000,'Biaya Parkir UFO',0,0),
(32,1,1,'2018-05-17',1,'2018-05-31','jemput di Bandara jam 2 pagi',3400000,NULL,NULL,1,0),
(33,1,2,'2018-05-17',1,'2018-07-27','',6800000,NULL,NULL,-1,0),
(34,1,2,'2018-05-17',8,'2019-03-21','',18200000,NULL,NULL,0,0);

/*Table structure for table `tbl_det_foto_paket` */

DROP TABLE IF EXISTS `tbl_det_foto_paket`;

CREATE TABLE `tbl_det_foto_paket` (
  `id_det_foto_paket` int(11) NOT NULL AUTO_INCREMENT,
  `id_paket` int(11) DEFAULT NULL,
  `det_foto_paket` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_det_foto_paket`),
  KEY `id_paket` (`id_paket`),
  CONSTRAINT `tbl_det_foto_paket_ibfk_1` FOREIGN KEY (`id_paket`) REFERENCES `tbl_paket` (`id_paket`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_det_foto_paket` */

/*Table structure for table `tbl_det_paket_hotel` */

DROP TABLE IF EXISTS `tbl_det_paket_hotel`;

CREATE TABLE `tbl_det_paket_hotel` (
  `id_det_hotel` int(11) NOT NULL AUTO_INCREMENT,
  `id_paket` int(11) DEFAULT NULL,
  `id_hotel` int(11) DEFAULT NULL,
  `banyak_malam_hotel` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_det_hotel`),
  KEY `id_paket` (`id_paket`),
  KEY `id_hotel` (`id_hotel`),
  CONSTRAINT `tbl_det_paket_hotel_ibfk_1` FOREIGN KEY (`id_paket`) REFERENCES `tbl_paket` (`id_paket`),
  CONSTRAINT `tbl_det_paket_hotel_ibfk_2` FOREIGN KEY (`id_hotel`) REFERENCES `tbl_hotel` (`id_hotel`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_det_paket_hotel` */

insert  into `tbl_det_paket_hotel`(`id_det_hotel`,`id_paket`,`id_hotel`,`banyak_malam_hotel`) values 
(17,7,5,2),
(24,8,5,2),
(31,9,5,3),
(38,9,22,1),
(40,1,22,2),
(41,2,30,1),
(42,10,17,0),
(43,11,7,0);

/*Table structure for table `tbl_det_paket_wisata` */

DROP TABLE IF EXISTS `tbl_det_paket_wisata`;

CREATE TABLE `tbl_det_paket_wisata` (
  `id_det_wisata` int(11) NOT NULL AUTO_INCREMENT,
  `id_paket` int(11) DEFAULT NULL,
  `id_wisata` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_det_wisata`),
  KEY `id_paket` (`id_paket`),
  KEY `id_wisata` (`id_wisata`),
  CONSTRAINT `tbl_det_paket_wisata_ibfk_1` FOREIGN KEY (`id_paket`) REFERENCES `tbl_paket` (`id_paket`),
  CONSTRAINT `tbl_det_paket_wisata_ibfk_2` FOREIGN KEY (`id_wisata`) REFERENCES `tbl_wisata` (`id_wisata`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_det_paket_wisata` */

insert  into `tbl_det_paket_wisata`(`id_det_wisata`,`id_paket`,`id_wisata`) values 
(11,8,2),
(12,8,12),
(16,2,15),
(23,9,2),
(24,8,15),
(27,9,15),
(30,9,16),
(31,1,12),
(32,2,17),
(33,7,2),
(34,10,17),
(35,11,18);

/*Table structure for table `tbl_hotel` */

DROP TABLE IF EXISTS `tbl_hotel`;

CREATE TABLE `tbl_hotel` (
  `id_hotel` int(11) NOT NULL AUTO_INCREMENT,
  `nama_hotel` varchar(100) DEFAULT NULL,
  `alamat_hotel` varchar(255) DEFAULT NULL,
  `tlpn_hotel` varchar(12) DEFAULT NULL,
  `biaya_permalam` int(11) DEFAULT NULL,
  `status_aktif` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_hotel`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_hotel` */

insert  into `tbl_hotel`(`id_hotel`,`nama_hotel`,`alamat_hotel`,`tlpn_hotel`,`biaya_permalam`,`status_aktif`) values 
(5,'Nyuh Bengkok Tree House','Sental kangin, Desa Ped, Kec. Nusa Penida','089516644259',250000,1),
(6,'Hotel Tjamphuhan','Jl. Raya Campuan, Sayan, Ubud, Kabupaten Gianyar, Bali 80571','(0361) 97536',1400000,1),
(7,'Ayana Resort','Jalan raya Seminyak no.109B','(0361)215698',2500000,1),
(17,'The Somayan Bungalows','Desa Batu Lapan, Suana, Nusapenida, Kabupaten Klungkung, Bali ','0813532212',412000,1),
(22,'Bali Paragon Resort','Jl. Raya Kampus Unud, Jimbaran, Bali, Kabupaten Badung, Bali 80361','(0361) 47252',641000,1),
(23,'33','33','33',2220000,0),
(28,'test','test','test',111,0),
(29,'33','33','333',333,0),
(30,'The Cave Hotel','Batur Tengah, Kintamani, Kabupaten Bangli, Bali 80652','081337787816',800000,1);

/*Table structure for table `tbl_jenis_wisata` */

DROP TABLE IF EXISTS `tbl_jenis_wisata`;

CREATE TABLE `tbl_jenis_wisata` (
  `id_jenis_wisata` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_wisata` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_jenis_wisata`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_jenis_wisata` */

insert  into `tbl_jenis_wisata`(`id_jenis_wisata`,`jenis_wisata`) values 
(1,'Water Sport'),
(2,'Kebun Raya'),
(3,'Air Terjun'),
(4,'Pantai'),
(5,'Hiking'),
(6,'Wisata Laut'),
(7,'aa');

/*Table structure for table `tbl_moment` */

DROP TABLE IF EXISTS `tbl_moment`;

CREATE TABLE `tbl_moment` (
  `id_moment` int(11) NOT NULL AUTO_INCREMENT,
  `judul_moment` varchar(30) DEFAULT NULL,
  `lokasi_moment` varchar(100) DEFAULT NULL,
  `tanggal_moment` date DEFAULT NULL,
  `deskripsi_moment` varchar(200) DEFAULT NULL,
  `foto_moment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_moment`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_moment` */

insert  into `tbl_moment`(`id_moment`,`judul_moment`,`lokasi_moment`,`tanggal_moment`,`deskripsi_moment`,`foto_moment`) values 
(1,'Kecerian','Bali, indonesia','2018-04-24','Serunya hari ini','selfie.jpg'),
(2,'Long Night','Kubutambahan, Singaraja, Bali','2017-10-03','So live a life u will remember ','IMG_3850.jpg'),
(3,'Istirahat perjalanan','Pasar Baturiti, Tabanan','2018-04-25','bermain tik tak tu, minum coklat panas, bermain permain pazel, menghitung bintang bermain tik tak tu, minum coklat panas, bermain permain pazel, menghitung bintang bermain tik tak tu, minum coklat pan','IMG_3860.JPG');

/*Table structure for table `tbl_paket` */

DROP TABLE IF EXISTS `tbl_paket`;

CREATE TABLE `tbl_paket` (
  `id_paket` int(11) NOT NULL AUTO_INCREMENT,
  `nama_paket` varchar(50) DEFAULT NULL,
  `banyak_hari` int(11) DEFAULT NULL,
  `banyak_malam` int(11) DEFAULT NULL,
  `harga_paket` int(11) DEFAULT NULL,
  `deskripsi_paket` varchar(255) DEFAULT NULL,
  `foto_paket` varchar(100) DEFAULT NULL,
  `status_aktif_paket` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_paket`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_paket` */

insert  into `tbl_paket`(`id_paket`,`nama_paket`,`banyak_hari`,`banyak_malam`,`harga_paket`,`deskripsi_paket`,`foto_paket`,`status_aktif_paket`) values 
(1,'Paket Lama Dijalan',3,2,1998000,'Paket lama dijalan merupakan paket yang diperuntukan untuk wisatawan yang suka menikmati perjalanan, oleh karena itu kami siapan paket wisata dimana objek wisatanya sangat jauh dari hotel.','paket11.jpg',1),
(2,'Paket Bangli Nikmat',2,1,1342500,'Wisatawan dapat menimati indahnya kabupaten Bangli dimana wisatawan dapat mendaki Gunung Batur dan berendam di pemandian air panas','paket21.jpg',1),
(7,'Paket Kusuka Nusa',3,2,795000,'Paket Kusuka Nusa merupakan paket wisata di pulau Nusa Penida dimana wisatawan dapat menikmati keindahan Pantai di Nusa Penisa dan bermalam di Nusa Penida juga','Paket_3.jpg',1),
(8,'d',4,2,900000,'d','Desert.jpg',0),
(9,'e',5,4,2236500,'e','Koala.jpg',0),
(10,'Paket Hangat Hangat',1,2,112500,'Paket ini merupakan paket wisata menginap di salah satu hotel di Bangli dan mandi di pemandian air pana Toya Devasya dan menikmati pemandangan Gunung Batur','paket_41.jpg',1),
(11,'Paket Buang Uang',1,1,12000,'Paket Buang Uang merupakan paket yang dikhususkan kepada para Sultan yang ingin menghabiskan uang di Bali dengan berbelanja di Mall Bali Galeria','paket_5.jpg',1);

/*Table structure for table `tbl_pembayaran` */

DROP TABLE IF EXISTS `tbl_pembayaran`;

CREATE TABLE `tbl_pembayaran` (
  `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT,
  `id_booking` int(11) DEFAULT NULL,
  `atas_nama_pengirim` varchar(30) DEFAULT NULL,
  `bukti_transaksi` varchar(100) DEFAULT NULL,
  `tgl_upload_bukti` date DEFAULT NULL,
  `status_valid` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_pembayaran`),
  KEY `id_booking` (`id_booking`),
  CONSTRAINT `tbl_pembayaran_ibfk_1` FOREIGN KEY (`id_booking`) REFERENCES `tbl_booking` (`id_booking`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pembayaran` */

insert  into `tbl_pembayaran`(`id_pembayaran`,`id_booking`,`atas_nama_pengirim`,`bukti_transaksi`,`tgl_upload_bukti`,`status_valid`) values 
(20,27,'I PUTU KRISNA ARYNASTA','ijasah.jpg','2018-05-08',1),
(22,32,'IGA Made Gates Syn','timeline_20170705_193650.jpg','2018-05-17',1),
(23,34,'I PUTU KRISNA ARYNASTA','bvn.jpg','2018-05-17',0);

/*Table structure for table `tbl_user` */

DROP TABLE IF EXISTS `tbl_user`;

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(30) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `nama_user` varchar(50) DEFAULT NULL,
  `no_indentitas` char(16) DEFAULT NULL,
  `tlpn_user` char(12) DEFAULT NULL,
  `alamat_user` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_user` */

insert  into `tbl_user`(`id_user`,`email`,`password`,`nama_user`,`no_indentitas`,`tlpn_user`,`alamat_user`) values 
(1,'krisnaarinasta@gmail.com','123','Krisna Arynasta','1142588935481','089999999999','Bali'),
(2,'a@a','123','Mader Paker',NULL,NULL,NULL),
(3,'jon@gmail.com','123','Jon Tor','289465482','0284851','St. James 122, SIngapore'),
(4,'Devajayantha@gmail.com','deva110398','devajayantha','000000000000','000000000000','jalan jalan'),
(5,'b@b','123','BnB','91118979871117','89682891','B aja');

/*Table structure for table `tbl_wisata` */

DROP TABLE IF EXISTS `tbl_wisata`;

CREATE TABLE `tbl_wisata` (
  `id_wisata` int(11) NOT NULL AUTO_INCREMENT,
  `nama_tempat_wisata` varchar(100) DEFAULT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  `id_jenis_wisata` int(11) DEFAULT NULL,
  `frame_peta` text,
  `harga_tiket` int(11) DEFAULT NULL,
  `deskripsi_wisata` text,
  `foto_wisata` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_wisata`),
  KEY `id_jenis_wisata` (`id_jenis_wisata`),
  CONSTRAINT `tbl_wisata_ibfk_1` FOREIGN KEY (`id_jenis_wisata`) REFERENCES `tbl_jenis_wisata` (`id_jenis_wisata`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_wisata` */

insert  into `tbl_wisata`(`id_wisata`,`nama_tempat_wisata`,`lokasi`,`id_jenis_wisata`,`frame_peta`,`harga_tiket`,`deskripsi_wisata`,`foto_wisata`) values 
(2,'Pantai Kelingking','Bunga Mekar, Nusapenida, Klungkung, Bali 80771',1,'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3943.3539992467113!2d115.46970921429097!3d-8.75272419371281!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd24720896fe13d%3A0x5c98f1789c611dd2!2sKelingking+Beach!5e0!3m2!1sid!2sid!4v1522852348554',30000,'Pantai terpencil berpasir putih dengan air biru, dikelilingi tanjung & tebing curam.\r\n','kelingking-beach.jpg'),
(12,'Monkey Forest','Jl. Monkey Forest, Ubud, Kabupaten Gianyar, Bali 80571',2,'22dgasjdasdgajsgdsajgdjhasgjazzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz22dgasjdasdgajsgdsajgdjhasgjazzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz22dgasjdasdgajsgdsajgdjhasgjazzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz22dgasjdasdgajsgdsajgdjhasgjazzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz22dgasjdasdgajsgdsajgdjhasgjazzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz22dgasjdasdgajsgdsajgdjhasgjazzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz22dgasjdasdgajsgdsajgdjhasgjazzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz22dgasjdasdgajsgdsajgdjhasgjazzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz',50000,'Objek wisata Monkey Forest yang merupakan kawasan wisata yang objeknya adalah kera-kera dengan sejumlah pola perilaku kehidupannya dengan dukungan alam berupa kawasan hutan yang alami dengan penuh suasana religius, yang terletak di Desa Pakraman Padangtegal, Kelurahan Ubud, Gianyar.','Monkey-Forest-Ubud-Bali-Feature.jpg'),
(14,'Pantai Pandawa','Desa Kutuh,Kuta,Badung, Bali',4,'1',10000,'Pantai Pandawa adalah salah satu kawasan wisata di area Kuta selatan, Kabupaten Badung, Bali. Pantai ini terletak di balik perbukitan dan sering disebut sebagai Pantai Rahasia (Secret Beach). Di sekitar pantai ini terdapat dua tebing yang sangat besar yang pada salah satu sisinya dipahat lima patung Pandawa dan Kunti. Keenam patung tersebut secarara berurutan (dari posisi tertinggi) diberi penejasan nama Dewi Kunti, Dharma Wangsa, Bima, Arjuna, Nakula, dan Sadewa.\r\n\r\nSelain untuk tujuan wisata dan olahraga air, pantai ini juga dimanfaatkan untuk budidaya rumput laut karena kontur pantai yang landai dan ombak yang tidak sampai ke garis pantai. Cukup banyak wisatawan yang melakukan paralayang dari Bukit Timbis hingga ke Pantai Pandawa.','20150106_124646.jpg'),
(15,'Gunung Batur','Kintamani, Kabupaten Bangli, <br>\r\nBali, Indonesia.',5,'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31589.02243484518!2d115.35998476890678!3d-8.240129370503558!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd1f403c8e8ee3f%3A0xd38045afa18670b4!2sGn.+Batur!5e0!3m2!1sid!2sid!4v1523190096794',20000,'Wisata petualangan bagi wisatawan pecinta alam adalah mendaki Gunung Batur. Gunung Batur Bali memiliki ketinggian 1.717 meter mdpl, dan merupakan salah satu gunung berapi yang masih aktif di Bali. Trekking ini akan menjadi pelengkap liburan di pulau Bali. Melakukan pendakian menuju puncak Gunung Batur, bisa dilakukan pada pagi hari dan sore hari dengan tujuan menyaksikan keindahan sunrise ataupun sunset, tapi yang waktu yang pupoler mendaki Gunung Batur adalah pada saat pagi hari untuk menyaksikan keindahan sunrise. Mendaki gunung ini sangat menyenangkan, sangat cocok bagi pemula, karena hanya butuh waktu sekitar 2 jam menuju ke puncak, lebih cepat dibandingkan jika mendaki Gunung Agung karena butuh waktu 4 jam ke puncak 2 dan 6 jam ke puncak tertinggi.','20170627_170628_0441_0.jpg'),
(16,'Kebun Raya Bedugul','Jl. Kebun Raya, Candikuning, Baturiti, Kabupaten Tabanan, Bali 82191',2,'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31589.02243484518!2d115.35998476890678!3d-8.240129370503558!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd1f403c8e8ee3f%3A0xd38045afa18670b4!2sGn.+Batur!5e0!3m2!1sid!2sid!4v1523190096794',50000,'Kebun Raya Bali adalah sebuah kebun botani besar yang terletak di wilayah Kabupaten Tabanan, Bali, Indonesia. Kebun ini merupakan kebun raya pertama yang didirikan oleh putra bangsa Indonesia. Pengelolaannya dilakukan oleh Lembaga Ilmu Pengetahuan Indonesia (LIPI) dan secara struktur organisasi berada di bawah pembinaan Pusat Konservasi Tumbuhan Kebun Raya Bogor. Kebun ini didirikan pada 15 Juli 1959. Pada awalnya Kebun Raya Eka Karya Bali hanya diperuntukkan bagi tetumbuhan runjung. Seiring dengan perkembangan dan perubahan status serta luas kawasannya, kebun yang berada pada ketinggian 1.250–1.450 m dpl ini kini menjadi kawasan konservasi ex-situ bagi tumbuhan pegunungan tropika Kawasan Timur Indonesia. Luas kawasan Kebun Raya semula hanya 50 ha, tetapi saat ini luas kebun raya menjadi 157,5 ha.','6-3.jpg'),
(17,'Toya Devasya','Batur Tengah, Kintamani, Kabupaten Bangli, Bali',1,'aasdasdadsa',75000,'Toya Devasya di Toya Bungkah ini memberikan anda kesempatan yang lebih leluasa dan nyaman untuk merasakan terapi alam air panas, tempatnya nyaman dan bersih, dari kolam pemandian anda bisa menyaksikan keindahan danau Batur, dan bersantai melepaskan penat. Menikmati wisata atau liburan akhir pekan bersama keluarga ataupun anak-anak maka Toya Devasya ini menjadi tempat ideal, memberikan anak-anak keleluasaan bermain air dengan terapi air panas alam serta merasa lebih dekat dengan alam. Di Toya Devasya ada 1 buah kolam renang besar dan 4 kolam kecil, juga area bermain untuk anak-anak, berikut dilengkapi dengan beberapa buah pancuran air panas.','kolam-air-panas-toya-devasya-kintamani-bali.jpg'),
(18,'Mall Bali Galeria','Jalan By Pass Ngurah Rai, Simpang Dewa Ruci, Kuta, Kabupaten Badung, Bali 80361',2,'33',8000,'Mal Bali Galeria adalah kompleks perbelanjaan besar berlokasi di Simpang Bundaran Dewa Ruci di Kuta. Pusat hiburan dan belanja yang luas menawarkan konsep \'mal keluarga, dengan slogan ‘enjoy, play, eat, shop’. Berbagai outlet dan acara membuatnya menjadi tujuan favorit di antara penduduk setempat dan pengunjung.','Mall-Bali-Galeria1.jpg');

/* Trigger structure for table `tbl_pembayaran` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `valid_pembayaran` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `valid_pembayaran` AFTER UPDATE ON `tbl_pembayaran` FOR EACH ROW BEGIN
	if(new.status_valid=1)then
		update tbl_booking set status_pembayaran=1 where id_booking=new.id_booking;
	end if;	
    END */$$


DELIMITER ;

/*!50106 set global event_scheduler = 1*/;

/* Event structure for event `Pembatalan_auto` */

/*!50106 DROP EVENT IF EXISTS `Pembatalan_auto`*/;

DELIMITER $$

/*!50106 CREATE DEFINER=`root`@`localhost` EVENT `Pembatalan_auto` ON SCHEDULE EVERY 1 SECOND STARTS '2018-05-21 10:59:57' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
	   	UPDATE tbl_booking SET status_cancle=1
		WHERE tgl_traveling <= NOW() + INTERVAL 1 DAY AND status_pembayaran = 0 AND status_cancle=0;
	END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
