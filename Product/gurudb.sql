-- phpMyAdmin SQL Dump
-- version 3.4.10
-- http://www.phpmyadmin.net
--
-- Host: 94.73.170.230
-- Generation Time: Mar 31, 2017 at 04:17 AM
-- Server version: 5.5.45
-- PHP Version: 5.2.6-1+lenny10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gurudb`
--

-- --------------------------------------------------------

--
-- Table structure for table `emailer`
--

CREATE TABLE IF NOT EXISTS `emailer` (
  `emailer_on_off` tinyint(1) NOT NULL DEFAULT '1',
  `emailer_expiration` tinyint(1) NOT NULL DEFAULT '1',
  `emailer_new_ingredients` tinyint(1) NOT NULL DEFAULT '1',
  `emailer_out_of_stock` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` int(50) NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `emailer`
--

INSERT INTO `emailer` (`emailer_on_off`, `emailer_expiration`, `emailer_new_ingredients`, `emailer_out_of_stock`, `user_id`) VALUES
(1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE IF NOT EXISTS `ingredients` (
  `ingredient_id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(50) NOT NULL,
  `ingredient_name` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `ingredient_brand` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `ingredient_amount` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `ingredient_amount_unit` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `ingredient_expiration_date` date NOT NULL,
  `ingredient_purchase_date` date NOT NULL,
  `ingredient_note` varchar(1000) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`ingredient_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=40 ;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`ingredient_id`, `user_id`, `ingredient_name`, `ingredient_brand`, `ingredient_amount`, `ingredient_amount_unit`, `ingredient_expiration_date`, `ingredient_purchase_date`, `ingredient_note`) VALUES
(3, 3, 'Armut', 'BİM', '5', 'Kilogram', '2017-02-28', '2017-02-15', ''),
(2, 3, 'Elma', 'BİM', '0', 'Kilogram', '2017-02-28', '2017-02-15', 'Elmaları gelecek hafta kullanacağız.'),
(21, 2, 'Yumurta', 'Yumega', '4', 'Kilogram', '2017-02-28', '2017-02-07', 'İki tanesini lütfen kullanmayın çarşamba günkü grup için gerekli.'),
(18, 3, 'Soğan', 'Real', '1', 'Piece', '2017-04-15', '2017-02-09', '3 tanesi çok sağlam değildi, önce onlar kullanılsın.'),
(19, 3, 'Süt', 'Pınar', '1', 'Liter', '2017-02-28', '2017-02-09', ''),
(13, 3, 'Tarçın', 'Bağdat', '40', 'Gram', '2016-03-03', '2014-04-04', ''),
(17, 1, 'Galeta Unu', 'Bağdat', '1000', 'Gram', '2017-05-27', '2017-02-01', ''),
(22, 2, 'Tereyağı', 'Pınar', '250', 'Gram', '2017-04-28', '2017-02-07', 'Bunu kullanmadan önce mümkünse yarım margarini kullanın.'),
(23, 2, 'Margarin', 'Sana', '125', 'Gram', '2017-03-15', '2017-01-17', 'Az miktarda var ama yeni paket alsanız bile lütfen önce bunu kullanın şayet uzun zamandır duruyor.'),
(24, 2, 'Un', 'Söke', '2', 'Kilogram', '2017-06-30', '2016-12-21', 'Kavanozlardaki un boşaldıkça lütfen kalan unu paketten kavanozlara boşaltın sonra güveleniyor.'),
(25, 1, 'Bitter Çikolata', 'Eti', '2400', 'Gram', '2017-05-27', '2016-12-20', ''),
(39, 1, 'Tomato', 'Tesco', '1', 'Kilogram', '2017-04-07', '2017-03-24', 'some note');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(50) NOT NULL AUTO_INCREMENT,
  `user_username` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `user_name` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `user_surname` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `user_password` varchar(50) COLLATE utf8_turkish_ci NOT NULL DEFAULT '5f4dcc3b5aa765d61d8327deb882cf99',
  `user_email` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `user_type` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=34 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_username`, `user_name`, `user_surname`, `user_password`, `user_email`, `user_type`) VALUES
(1, 'bsimsek', 'Barkın', 'Şimşek', 'c4ca4238a0b923820dcc509a6f75849b', 'bsimsek@tevitol.k12.tr', 'admin'),
(2, 'ebalci', 'Ekin', 'Balcı', '5f4dcc3b5aa765d61d8327deb882cf99', 'ebalci@tevitol.k12.tr', 'admin'),
(32, 'adminuser', 'Admin', 'User', '21232f297a57a5a743894a0e4a801fc3', 'adminuser@tevitol.k12.tr', 'admin'),
(6, 'mudursun', 'Mustafa Uğur', 'Dursun', '5f4dcc3b5aa765d61d8327deb882cf99', 'mudursun@tevitol.k12.tr', 'admin'),
(7, 'ouacarli', 'Onur Ulaş', 'Acarlı', '5f4dcc3b5aa765d61d8327deb882cf99', 'ouacarli@tevitol.k12.tr', 'normal'),
(8, 'dzyorgancioglu', 'Defne Zuhal ', 'Yorgancıoğlu', '5f4dcc3b5aa765d61d8327deb882cf99', 'dzyorgancioglu@tevitol.k12.tr', 'normal'),
(9, 'aaltaylar', 'Alara', 'Altaylar', '5f4dcc3b5aa765d61d8327deb882cf99', 'aaltaylar@tevitol.k12.tr', 'normal'),
(10, 'bvural', 'Bartu', 'Vural', '5f4dcc3b5aa765d61d8327deb882cf99', 'bvural@tevitol.k12.tr', 'normal'),
(11, 'bustuntas', 'Bengisu', 'Üstüntaş', '5f4dcc3b5aa765d61d8327deb882cf99', 'bustuntas@tevitol.k12.tr', 'normal'),
(12, 'imermutluoglu', 'İnci', 'Mermutluoğlu', '5f4dcc3b5aa765d61d8327deb882cf99', 'imermutluoglu@tevitol.k12.tr', 'normal'),
(13, 'nomuslu', 'Nisan Ödül', 'Muslu', '5f4dcc3b5aa765d61d8327deb882cf99', 'nomuslu@tevitol.k12.tr', 'normal'),
(14, 'yorak', 'Yiğitcan', 'Orak', '5f4dcc3b5aa765d61d8327deb882cf99', 'yorak@tevitol.k12.tr', 'normal'),
(15, 'heoz', 'Hatice Ece', 'Öz', '5f4dcc3b5aa765d61d8327deb882cf99', 'heoz@tevitol.k12.tr', 'normal'),
(16, 'haaltunsaray', 'Heval Ayşe', 'Altunsaray', '5f4dcc3b5aa765d61d8327deb882cf99', 'haaltunsaray@tevitol.k12.tr', 'normal'),
(17, 'isen', 'İlayda', 'Şen', '5f4dcc3b5aa765d61d8327deb882cf99', 'isen@tevitol.k12.tr', 'normal'),
(18, 'esyayla', 'Emine Sena', 'Yayla', '5f4dcc3b5aa765d61d8327deb882cf99', 'esyayla@tevitol.k12.tr', 'normal'),
(19, 'osbagci', 'Öykü Su', 'Bağcı', '5f4dcc3b5aa765d61d8327deb882cf99', 'osbagci@tevitol.k12.tr', 'normal'),
(33, 'normaluser', 'Normal', 'User', 'fea087517c26fadd409bd4b9dc642555', 'normaluser@tevitol.k12.tr', 'normal');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
