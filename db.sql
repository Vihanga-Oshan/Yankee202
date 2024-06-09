-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.33 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for eshop
CREATE DATABASE IF NOT EXISTS `eshop` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `eshop`;

-- Dumping structure for table eshop.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `vcode` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.admin: ~1 rows (approximately)
INSERT INTO `admin` (`fname`, `lname`, `email`, `vcode`) VALUES
	('Vihanga', 'Oshan', 'Vihangaoshan132@gmail.com', '665ab667ba1a7');

-- Dumping structure for table eshop.brand
CREATE TABLE IF NOT EXISTS `brand` (
  `brand_id` int NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(50) DEFAULT NULL,
  `category_cat_id` int NOT NULL,
  PRIMARY KEY (`brand_id`),
  KEY `fk_brand_category1_idx` (`category_cat_id`),
  CONSTRAINT `fk_brand_category1` FOREIGN KEY (`category_cat_id`) REFERENCES `category` (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.brand: ~7 rows (approximately)
INSERT INTO `brand` (`brand_id`, `brand_name`, `category_cat_id`) VALUES
	(1, 'Msi', 2),
	(2, 'Asus', 2),
	(3, 'Xiomi', 1),
	(5, 'SAMSUNG', 1),
	(6, 'Google', 1),
	(7, 'Apple', 1),
	(8, 'ACEMAGIC', 2);

-- Dumping structure for table eshop.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int NOT NULL AUTO_INCREMENT,
  `cart_qty` int DEFAULT NULL,
  `user_email` varchar(100) NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`cart_id`),
  KEY `fk_cart_user1_idx` (`user_email`),
  KEY `fk_cart_product1_idx` (`product_id`),
  CONSTRAINT `fk_cart_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_cart_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.cart: ~1 rows (approximately)

-- Dumping structure for table eshop.category
CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(50) DEFAULT NULL,
  `img` text,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.category: ~5 rows (approximately)
INSERT INTO `category` (`cat_id`, `cat_name`, `img`) VALUES
	(1, 'Mobile Phones', 'resource/phone.png'),
	(2, 'Laptops', 'resource/laptop.png'),
	(3, 'HeadPhones', 'resource/headphone.png'),
	(4, 'Monitors', 'resource/monitor.png'),
	(5, 'Smart Watches', 'resource/watch.png');

-- Dumping structure for table eshop.chat
CREATE TABLE IF NOT EXISTS `chat` (
  `chat_id` int NOT NULL AUTO_INCREMENT,
  `content` text,
  `date_time` datetime DEFAULT NULL,
  `status` int DEFAULT NULL,
  `from` varchar(100) NOT NULL,
  `to` varchar(100) NOT NULL,
  PRIMARY KEY (`chat_id`),
  KEY `fk_chat_user1_idx` (`from`),
  KEY `fk_chat_user2_idx` (`to`),
  CONSTRAINT `fk_chat_user1` FOREIGN KEY (`from`) REFERENCES `user` (`email`),
  CONSTRAINT `fk_chat_user2` FOREIGN KEY (`to`) REFERENCES `user` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.chat: ~0 rows (approximately)

-- Dumping structure for table eshop.city
CREATE TABLE IF NOT EXISTS `city` (
  `city_id` int NOT NULL AUTO_INCREMENT,
  `city_name` varchar(20) DEFAULT NULL,
  `district_district_id` int NOT NULL,
  PRIMARY KEY (`city_id`),
  KEY `fk_city_district1_idx` (`district_district_id`),
  CONSTRAINT `fk_city_district1` FOREIGN KEY (`district_district_id`) REFERENCES `district` (`district_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.city: ~5 rows (approximately)
INSERT INTO `city` (`city_id`, `city_name`, `district_district_id`) VALUES
	(1, 'Malabe', 1),
	(2, 'Kaduwela', 1),
	(3, 'Kandy', 5),
	(4, 'Negambo', 2),
	(5, 'Katana', 2);

-- Dumping structure for table eshop.color
CREATE TABLE IF NOT EXISTS `color` (
  `color_id` int NOT NULL AUTO_INCREMENT,
  `clr_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`color_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.color: ~4 rows (approximately)
INSERT INTO `color` (`color_id`, `clr_name`) VALUES
	(1, 'Black'),
	(2, 'White'),
	(3, 'Green'),
	(4, 'Red');

-- Dumping structure for table eshop.condition
CREATE TABLE IF NOT EXISTS `condition` (
  `condition_id` int NOT NULL AUTO_INCREMENT,
  `condition_name` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`condition_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.condition: ~2 rows (approximately)
INSERT INTO `condition` (`condition_id`, `condition_name`) VALUES
	(1, 'Brand New'),
	(2, 'Used');

-- Dumping structure for table eshop.district
CREATE TABLE IF NOT EXISTS `district` (
  `district_id` int NOT NULL AUTO_INCREMENT,
  `district_name` varchar(20) DEFAULT NULL,
  `province_province_id` int NOT NULL,
  PRIMARY KEY (`district_id`),
  KEY `fk_district_province1_idx` (`province_province_id`),
  CONSTRAINT `fk_district_province1` FOREIGN KEY (`province_province_id`) REFERENCES `province` (`province_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.district: ~7 rows (approximately)
INSERT INTO `district` (`district_id`, `district_name`, `province_province_id`) VALUES
	(1, 'Colombo', 8),
	(2, 'Gampaha', 8),
	(3, 'Jaffna', 3),
	(4, 'Kaluthara', 8),
	(5, 'Kandy', 1),
	(6, 'Kegalle', 5),
	(7, 'Kilinochchi', 3);

-- Dumping structure for table eshop.feedback
CREATE TABLE IF NOT EXISTS `feedback` (
  `feed_id` int NOT NULL AUTO_INCREMENT,
  `type` int DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `feed` text,
  `user_email` varchar(100) NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`feed_id`),
  KEY `fk_feedback_user1_idx` (`user_email`),
  KEY `fk_feedback_product1_idx` (`product_id`),
  CONSTRAINT `fk_feedback_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_feedback_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.feedback: ~0 rows (approximately)

-- Dumping structure for table eshop.gender
CREATE TABLE IF NOT EXISTS `gender` (
  `id` int NOT NULL AUTO_INCREMENT,
  `gender_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.gender: ~2 rows (approximately)
INSERT INTO `gender` (`id`, `gender_name`) VALUES
	(1, 'Male'),
	(2, 'Female');

-- Dumping structure for table eshop.images
CREATE TABLE IF NOT EXISTS `images` (
  `path` varchar(100) NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`path`),
  KEY `fk_product_img_product1_idx` (`product_id`),
  CONSTRAINT `fk_product_img_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.images: ~4 rows (approximately)
INSERT INTO `images` (`path`, `product_id`) VALUES
	('resource/mobile_images/r.jpg', 1),
	('resource/mobile_images/1.jpg', 2),
	('resource/mobile_images/2.jpg', 3),
	('resource/laptops/1.jpg', 4);

-- Dumping structure for table eshop.invoice
CREATE TABLE IF NOT EXISTS `invoice` (
  `invoice_id` int NOT NULL AUTO_INCREMENT,
  `order_id` varchar(45) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `total` double DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  `user_email` varchar(100) NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`invoice_id`),
  KEY `fk_invoice_user1_idx` (`user_email`),
  KEY `fk_invoice_product1_idx` (`product_id`),
  CONSTRAINT `fk_invoice_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_invoice_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.invoice: ~0 rows (approximately)

-- Dumping structure for table eshop.model
CREATE TABLE IF NOT EXISTS `model` (
  `model_id` int NOT NULL AUTO_INCREMENT,
  `model_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`model_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.model: ~6 rows (approximately)
INSERT INTO `model` (`model_id`, `model_name`) VALUES
	(1, '12 pro'),
	(2, 'Aspire 3'),
	(3, '7 Pro'),
	(4, 'Galaxy A35'),
	(5, 'Pixel 8'),
	(6, 'AX15');

-- Dumping structure for table eshop.model_has_brand
CREATE TABLE IF NOT EXISTS `model_has_brand` (
  `model_model_id` int NOT NULL,
  `brand_brand_id` int NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `fk_model_has_brand_brand1_idx` (`brand_brand_id`),
  KEY `fk_model_has_brand_model1_idx` (`model_model_id`),
  CONSTRAINT `fk_model_has_brand_brand1` FOREIGN KEY (`brand_brand_id`) REFERENCES `brand` (`brand_id`),
  CONSTRAINT `fk_model_has_brand_model1` FOREIGN KEY (`model_model_id`) REFERENCES `model` (`model_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.model_has_brand: ~6 rows (approximately)
INSERT INTO `model_has_brand` (`model_model_id`, `brand_brand_id`, `id`) VALUES
	(1, 7, 1),
	(4, 1, 2),
	(5, 6, 3),
	(6, 8, 4),
	(1, 5, 8),
	(2, 5, 9),
	(4, 2, 16),
	(2, 2, 17);

-- Dumping structure for table eshop.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `price` double DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `description` text,
  `title` varchar(100) DEFAULT NULL,
  `datetime_added` datetime DEFAULT NULL,
  `delivery_fee_colombo` double DEFAULT NULL,
  `delivery_fee_other` double DEFAULT NULL,
  `category_cat_id` int NOT NULL,
  `condition_condition_id` int NOT NULL,
  `status_status_id` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `color_clr_id` int NOT NULL,
  `model_has_brand_id` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `fk_product_category1_idx` (`category_cat_id`),
  KEY `fk_product_condition1_idx` (`condition_condition_id`),
  KEY `fk_product_status1_idx` (`status_status_id`),
  KEY `fk_product_user1_idx` (`user_email`),
  KEY `fk_product_color1_idx` (`color_clr_id`),
  KEY `FK_product_model_has_brand` (`model_has_brand_id`) USING BTREE,
  CONSTRAINT `fk_product_category1` FOREIGN KEY (`category_cat_id`) REFERENCES `category` (`cat_id`),
  CONSTRAINT `fk_product_color1` FOREIGN KEY (`color_clr_id`) REFERENCES `color` (`color_id`),
  CONSTRAINT `fk_product_condition1` FOREIGN KEY (`condition_condition_id`) REFERENCES `condition` (`condition_id`),
  CONSTRAINT `fk_product_status1` FOREIGN KEY (`status_status_id`) REFERENCES `status` (`status_id`),
  CONSTRAINT `fk_product_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.product: ~4 rows (approximately)
INSERT INTO `product` (`id`, `price`, `qty`, `description`, `title`, `datetime_added`, `delivery_fee_colombo`, `delivery_fee_other`, `category_cat_id`, `condition_condition_id`, `status_status_id`, `user_email`, `color_clr_id`, `model_has_brand_id`) VALUES
	(1, 240000, 3, 'Apple iPhone 12 Pro, 512GB, Graphite - Unlocked', 'iPhone 12 Pro', '2024-05-31 14:20:56', 200, 400, 1, 1, 1, 'vihangaoshan132@gmail.com', 1, 1),
	(2, 150000, 2, 'SAMSUNG Galaxy A35 5G A Series Cell Phone, 128GB Unlocked Android Smartphone, AMOLED Display, Advanced Triple Camera System, Expandable Storage, Rugged Design, US Version, 2024, Awesome Lilac', 'Samsung Galaxy A35', '2024-05-31 14:23:30', 200, 400, 1, 1, 1, 'vihangaoshan132@gmail.com', 4, 4),
	(3, 120000, 4, 'Google Pixel 8 - Unlocked Android Smartphone with Advanced Pixel Camera, 24-Hour Battery, and Powerful Security - Hazel - 128 GB', 'Google Pixel 8', '2024-05-31 14:31:51', 200, 400, 1, 1, 1, 'vihangaoshan132@gmail.com', 2, 5),
	(4, 560000, 6, 'ACEMAGIC Laptop, 16GB DDR4 512GB SSD, Quad-Core N95 Processor, Windows 11 Laptop Computer, 15.6" IPS 1080P PC, Metal Shell, 180° Open Angle,WiFi, BT5.0, USB3.2, Type_C, Long Battery Life', 'ACEMAGIC Laptop', '2024-06-01 10:59:25', 400, 800, 2, 1, 1, 'vihangaoshan132@gmail.com', 1, 6);

-- Dumping structure for table eshop.profile_img
CREATE TABLE IF NOT EXISTS `profile_img` (
  `path` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`path`),
  KEY `fk_profile_img_user1_idx` (`user_email`),
  CONSTRAINT `fk_profile_img_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.profile_img: ~0 rows (approximately)
INSERT INTO `profile_img` (`path`, `user_email`) VALUES
	('resource/new_user.jpeg', 'vihangaoshan132@gmail.com');

-- Dumping structure for table eshop.province
CREATE TABLE IF NOT EXISTS `province` (
  `province_id` int NOT NULL AUTO_INCREMENT,
  `province_name` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`province_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.province: ~9 rows (approximately)
INSERT INTO `province` (`province_id`, `province_name`) VALUES
	(1, 'Central Province'),
	(2, 'North central Provice'),
	(3, 'Northern Province'),
	(4, 'North western Province'),
	(5, 'Sabaragamuwa Province'),
	(6, 'Southern Province'),
	(7, 'Uva Province'),
	(8, 'Western Province'),
	(9, 'Eastern Province');

-- Dumping structure for table eshop.status
CREATE TABLE IF NOT EXISTS `status` (
  `status_id` int NOT NULL AUTO_INCREMENT,
  `status_name` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.status: ~2 rows (approximately)
INSERT INTO `status` (`status_id`, `status_name`) VALUES
	(1, 'Available'),
	(2, 'Not Available');

-- Dumping structure for table eshop.user
CREATE TABLE IF NOT EXISTS `user` (
  `fname` varchar(45) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `joined_date` datetime NOT NULL,
  `verification_code` varchar(20) DEFAULT NULL,
  `status` int NOT NULL,
  `gender_id` int NOT NULL,
  PRIMARY KEY (`email`),
  KEY `fk_user_gender_idx` (`gender_id`),
  CONSTRAINT `fk_user_gender` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.user: ~0 rows (approximately)
INSERT INTO `user` (`fname`, `lname`, `email`, `password`, `mobile`, `joined_date`, `verification_code`, `status`, `gender_id`) VALUES
	('vihanga', 'oshan', 'vihangaoshan132@gmail.com', '123456789', '0704435388', '2024-05-29 00:53:28', NULL, 1, 1);

-- Dumping structure for table eshop.user_has_address
CREATE TABLE IF NOT EXISTS `user_has_address` (
  `user_email` varchar(100) NOT NULL,
  `city_id` int NOT NULL,
  `address_id` int NOT NULL AUTO_INCREMENT,
  `line1` varchar(45) DEFAULT NULL,
  `line2` varchar(45) DEFAULT NULL,
  `postal_code` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`address_id`),
  KEY `fk_user_has_city_user1_idx` (`user_email`),
  KEY `fk_user_has_city_city1_idx` (`city_id`) USING BTREE,
  CONSTRAINT `fk_user_has_city_city1` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`),
  CONSTRAINT `fk_user_has_city_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.user_has_address: ~0 rows (approximately)

-- Dumping structure for table eshop.watchlist
CREATE TABLE IF NOT EXISTS `watchlist` (
  `w_id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`w_id`),
  KEY `fk_watchlist_product1_idx` (`product_id`),
  KEY `fk_watchlist_user1_idx` (`user_email`),
  CONSTRAINT `fk_watchlist_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_watchlist_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.watchlist: ~4 rows (approximately)
INSERT INTO `watchlist` (`w_id`, `product_id`, `user_email`) VALUES
	(12, 4, 'vihangaoshan132@gmail.com'),
	(13, 3, 'vihangaoshan132@gmail.com');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
