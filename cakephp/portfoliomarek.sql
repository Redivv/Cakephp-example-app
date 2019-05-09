-- phpMyAdmin SQL Dump
-- version home.pl
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 07, 2019 at 08:07 PM
-- Server version: 5.7.24-27-log
-- PHP Version: 5.6.40

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `28008568_1`
--
CREATE DATABASE `28008568_1` DEFAULT CHARACTER SET latin2 COLLATE latin2_general_ci;
USE `28008568_1`;

-- --------------------------------------------------------

--
-- Table structure for table `folder_photos`
--

CREATE TABLE IF NOT EXISTS `folder_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `folder_id` int(11) NOT NULL,
  `photo_id` int(11) NOT NULL,
  `active` varchar(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `folder_photos`
--

INSERT INTO `folder_photos` (`id`, `folder_id`, `photo_id`, `active`) VALUES
(1, 9, 21, '1'),
(2, 9, 22, '1'),
(3, 9, 23, '1'),
(4, 9, 24, '1'),
(5, 9, 25, '1'),
(6, 9, 26, '1'),
(7, 9, 27, '1'),
(8, 9, 28, '1'),
(9, 9, 29, '1'),
(10, 9, 30, '1'),
(11, 9, 31, '1'),
(12, 9, 32, '1');

-- --------------------------------------------------------

--
-- Table structure for table `folders`
--

CREATE TABLE IF NOT EXISTS `folders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `gallery_id` int(11) NOT NULL,
  `thumbnail` varchar(250) NOT NULL,
  `active` varchar(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `folders`
--

INSERT INTO `folders` (`id`, `name`, `description`, `gallery_id`, `thumbnail`, `active`) VALUES
(1, 'Plener 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ornare cursus velit in interdum. In vel libero eget tellus imperdiet efficitur. Praesent tortor elit, dapibus id elit in, mattis suscipit quam.', 3, '1527533814866054864_596775530.jpg', '1'),
(2, 'Plener 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ornare cursus velit in interdum. In vel libero eget tellus imperdiet efficitur. Praesent tortor elit, dapibus id elit in, mattis suscipit quam.', 3, '1527533928776165872_723183350.jpg', '1'),
(3, 'Plener 3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ornare cursus velit in interdum. In vel libero eget tellus imperdiet efficitur. Praesent tortor elit, dapibus id elit in, mattis suscipit quam.', 3, '1527533940623260553_448232681.jpg', '1'),
(4, 'Plener 4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ornare cursus velit in interdum. In vel libero eget tellus imperdiet efficitur. Praesent tortor elit, dapibus id elit in, mattis suscipit quam.', 3, '1527533958137559579_952023811.jpg', '1'),
(5, 'KoÅ›ciÃ³Å‚ 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ornare cursus velit in interdum. In vel libero eget tellus imperdiet efficitur. Praesent tortor elit, dapibus id elit in, mattis suscipit quam.', 2, '1527534236160500862_333675923.jpg', '1'),
(6, 'KoÅ›ciÃ³Å‚ 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ornare cursus velit in interdum. In vel libero eget tellus imperdiet efficitur. Praesent tortor elit, dapibus id elit in, mattis suscipit quam.', 2, '1527534250657112347_788650500.jpg', '1'),
(7, 'KoÅ›ciÃ³Å‚ 3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ornare cursus velit in interdum. In vel libero eget tellus imperdiet efficitur. Praesent tortor elit, dapibus id elit in, mattis suscipit quam.', 2, '1527534316202856018_540972781.jpg', '1'),
(8, 'KoÅ›ciÃ³Å‚ 4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ornare cursus velit in interdum. In vel libero eget tellus imperdiet efficitur. Praesent tortor elit, dapibus id elit in, mattis suscipit quam.', 2, '1527534333174576109_183591459.jpg', '1'),
(9, 'Wesele 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ornare cursus velit in interdum. In vel libero eget tellus imperdiet efficitur. Praesent tortor elit, dapibus id elit in, mattis suscipit quam.', 1, '1527534621886073322_966912154.jpg', '1'),
(10, 'Wesele 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ornare cursus velit in interdum. In vel libero eget tellus imperdiet efficitur. Praesent tortor elit, dapibus id elit in, mattis suscipit quam.', 1, '1527534633553994338_184331921.jpg', '1'),
(11, 'Wesele 3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ornare cursus velit in interdum. In vel libero eget tellus imperdiet efficitur. Praesent tortor elit, dapibus id elit in, mattis suscipit quam.', 1, '1527534663991562317_77899548.jpg', '1'),
(12, 'Wesele 4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ornare cursus velit in interdum. In vel libero eget tellus imperdiet efficitur. Praesent tortor elit, dapibus id elit in, mattis suscipit quam.', 1, '1527534679505112217_58787990.jpg', '1');

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE IF NOT EXISTS `galleries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) CHARACTER SET latin1 NOT NULL,
  `active` varchar(1) CHARACTER SET latin1 NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `name`, `active`) VALUES
(1, 'Wesele', '1'),
(2, 'KoÅ›ciÃ³Å‚', '1'),
(3, 'Plener', '1');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hash` text NOT NULL,
  `ext` varchar(10) NOT NULL,
  `size` int(11) NOT NULL,
  `org` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `hash`, `ext`, `size`, `org`) VALUES
(1, '1527527796815185232_730846455', 'jpg', 629151, 'mountains_landscape_hd_4k-2560x1600.jpg'),
(2, '1527527823906345127_696284811', 'png', 3532945, 'mountain_landscape_background_by_suedseeengel-dcbr094.png'),
(3, '1527528793844394772_971953699', 'png', 184081, 'glowna.png'),
(4, '1527528935688656120_485860467', 'jpg', 3007832, 'mountains-3840x2160-rocks-4k-8k-6143.jpg'),
(5, '1527528948448925635_441625524', 'jpg', 492570, 'mountain-wallpaper-ipad-unique-mountain-stream-ac29dc2a4-4k-hd-desktop-wallpaper-for-4k-ultra-hd-tv-of-mountain-wallpaper-ipad.jpg'),
(6, '1527528959837373261_202703416', 'jpg', 493055, 'orig.jpg'),
(7, '1527533814866054864_596775530', 'jpg', 392767, 'plener1.jpg'),
(8, '1527533880879448808_116533542', 'jpg', 143646, 'plener2.jpg'),
(9, '1527533899837155674_90960628', 'jpg', 392767, 'plener1.jpg'),
(10, '1527533928776165872_723183350', 'jpg', 143646, 'plener2.jpg'),
(11, '1527533940623260553_448232681', 'jpg', 274058, 'plener3.jpg'),
(12, '1527533958137559579_952023811', 'jpg', 186149, 'plener4.jpg'),
(13, '1527534236160500862_333675923', 'jpg', 627465, 'kosciol1.jpg'),
(14, '1527534250657112347_788650500', 'jpg', 308212, 'kosciol2.jpg'),
(15, '1527534316202856018_540972781', 'jpg', 420322, 'kosciol3.jpg'),
(16, '1527534333174576109_183591459', 'jpg', 462646, 'kosciol4.jpg'),
(17, '1527534621886073322_966912154', 'jpg', 187233, 'wesele1.jpg'),
(18, '1527534633553994338_184331921', 'jpg', 131963, 'wesele2.jpg'),
(19, '1527534663991562317_77899548', 'jpg', 630826, 'wesele3.jpg'),
(20, '1527534679505112217_58787990', 'jpg', 109138, 'wesele4.jpg'),
(21, '1527536783911097967_789943787', 'jpg', 627465, 'kosciol1.jpg'),
(22, '1527536783399925059_363164709', 'jpg', 308212, 'kosciol2.jpg'),
(23, '1527536783578814075_105327838', 'jpg', 420322, 'kosciol3.jpg'),
(24, '1527536783226146350_538697845', 'jpg', 462646, 'kosciol4.jpg'),
(25, '1527536783702179062_165577469', 'jpg', 392767, 'plener1.jpg'),
(26, '1527536783106891166_225986401', 'jpg', 143646, 'plener2.jpg'),
(27, '1527536783450549296_232442012', 'jpg', 274058, 'plener3.jpg'),
(28, '1527536783142935740_839361010', 'jpg', 186149, 'plener4.jpg'),
(29, '15275367836467672_641070408', 'jpg', 187233, 'wesele1.jpg'),
(30, '1527536783564378775_641508570', 'jpg', 131963, 'wesele2.jpg'),
(31, '1527536783873215867_421402746', 'jpg', 630826, 'wesele3.jpg'),
(32, '1527536783855225798_164283624', 'jpg', 109138, 'wesele4.jpg'),
(33, '1527536999686369047_455781001', 'jpg', 420322, 'kosciol3.jpg'),
(34, '1527537009859933015_288366622', 'jpg', 627465, 'kosciol1.jpg'),
(35, '1527537020344496575_507077078', 'jpg', 131963, 'wesele2.jpg'),
(36, '1527537030511920713_27107603', 'jpg', 143646, 'plener2.jpg'),
(37, '1527537039831405670_50197965', 'jpg', 392767, 'plener1.jpg'),
(38, '1527537060669986560_807012400', 'jpg', 274058, 'plener3.jpg'),
(39, '1527537076746337127_314392680', 'jpg', 308212, 'kosciol2.jpg'),
(40, '1527537096375001865_608592607', 'jpg', 630826, 'wesele3.jpg'),
(41, '15275371079215893_440432412', 'jpg', 308212, 'kosciol2.jpg'),
(42, '1527537116795511886_518995638', 'jpg', 186149, 'plener4.jpg'),
(43, '1527620048791308788_877708326', 'jpg', 5120560, 'IMG_5866.jpg'),
(44, '1527620215409639588_298933651', 'jpg', 9383520, 'IMG_1365.jpg'),
(45, '153077592368242418_955440729', 'jpg', 9383520, 'IMG_1365.jpg'),
(46, '1532416946775989094_113015730', 'jpg', 14786931, 'IMG_1365.jpg'),
(47, '1532417308394152457_489564626', 'jpg', 6114458, 'IMG_5866.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`) VALUES
(1, 'Text about 1', 'Na poczÄ…tek mam na imiÄ™ Marek.'),
(2, 'Text about 2', '&nbsp &nbsp Witam na mojej stronie, zawodowo nie zajmujÄ™ siÄ™ fotografiÄ…, to moje hobby i pasja zarazem â€¦ choÄ‡ fotografiÄ… zainteresowaÅ‚em siÄ™ jeszcze w szkole podstawowej, ciemnia , klasyczna fotografia ,  pojawiajÄ…cy siÄ™ obraz  srebrowy, to byÅ‚a wciÄ…gajÄ…ca magia :)  \r\n<br>\r\nDziÅ› jest duÅ¼o proÅ›ciej i niby Å‚atwiej boâ€¦  niby bo fotografia cyfrowa powoduje Å¼e czÄ™sto nie szanujemy ujÄ™Ä‡.'),
(3, 'Text about 3', 'Dlatego staram siÄ™ myÅ›leÄ‡ tak jakbym nadal miaÅ‚ analogowy film z limitem  zdjÄ™Ä‡, to zmusza do zastanowienia nad kaÅ¼dym ujÄ™ciem. \r\n<br>\r\nPodczas reportaÅ¼u  staram siÄ™ byÄ‡ na ile to moÅ¼liwe niewidocznym, co innego w sesjach indywidualnych, tu robiÄ™ wszystko aby sesja byÅ‚a miÅ‚ym wspomnieniem , bo jednak dla wielu osÃ³b obcowanie z obiektywem nie jest naturalne.'),
(4, 'Text about 4', 'Zapraszam serdecznie do wspÃ³Å‚pracy.'),
(5, 'Text contact', 'Zapraszam do kontaktu mailowego bÄ…dÅº telefonicznego.'),
(6, 'visible_tel', 'on'),
(7, 'visible_mail', 'on'),
(8, 'menu option 1', 'Marek Sztajgli'),
(9, 'menu option 2', 'o mnie'),
(10, 'menu option 3', 'galeria'),
(11, 'menu option 4', 'polecam'),
(12, 'menu option 5', 'kontakt'),
(13, '', '514299040'),
(14, '', 'marszta@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `slider_photos`
--

CREATE TABLE IF NOT EXISTS `slider_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_id` int(11) NOT NULL,
  `slider_id` int(11) NOT NULL,
  `active` varchar(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `slider_photos`
--

INSERT INTO `slider_photos` (`id`, `photo_id`, `slider_id`, `active`) VALUES
(1, 43, 1, '0'),
(2, 44, 1, '0'),
(3, 5, 1, '0'),
(4, 6, 1, '0'),
(5, 33, 1, '1'),
(6, 34, 1, '1'),
(7, 35, 1, '1'),
(8, 36, 1, '1'),
(9, 37, 1, '1'),
(10, 38, 1, '1'),
(11, 39, 2, '1'),
(12, 40, 2, '1'),
(13, 41, 2, '1'),
(14, 42, 2, '1'),
(15, 46, 3, '1'),
(16, 47, 3, '1');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE IF NOT EXISTS `sliders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `name`) VALUES
(1, 'about'),
(2, 'about'),
(3, 'index');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(250) NOT NULL,
  `password` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(1, 'mareksz@gmail.com', '7e49f1438b52346a02e6acfc3c5c5a118b8297e0');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
