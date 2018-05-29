-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 29 Maj 2018, 12:20
-- Wersja serwera: 10.1.26-MariaDB
-- Wersja PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `marek`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `folders`
--

CREATE TABLE `folders` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `gallery_id` int(11) NOT NULL,
  `thumbnail` varchar(250) NOT NULL,
  `active` varchar(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `folders`
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
-- Struktura tabeli dla tabeli `folder_photos`
--

CREATE TABLE `folder_photos` (
  `id` int(11) NOT NULL,
  `folder_id` int(11) NOT NULL,
  `photo_id` int(11) NOT NULL,
  `active` varchar(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `folder_photos`
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
-- Struktura tabeli dla tabeli `galleries`
--

CREATE TABLE `galleries` (
  `id` int(11) NOT NULL,
  `name` varchar(250) CHARACTER SET latin1 NOT NULL,
  `active` varchar(1) CHARACTER SET latin1 NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `galleries`
--

INSERT INTO `galleries` (`id`, `name`, `active`) VALUES
(1, 'Wesele', '1'),
(2, 'KoÅ›ciÃ³Å‚', '1'),
(3, 'Plener', '1');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `hash` text NOT NULL,
  `ext` varchar(10) NOT NULL,
  `size` int(11) NOT NULL,
  `org` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `photos`
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
(42, '1527537116795511886_518995638', 'jpg', 186149, 'plener4.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`) VALUES
(1, 'text about 1', 'My name is Marek Sztajgli'),
(2, 'text about 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam in tellus erat. Maecenas et molestie arcu. Proin in fringilla nisl. Suspendisse vitae aliquet nulla.'),
(3, 'text about 3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam in tellus erat. Maecenas et molestie arcu. Proin in fringilla nisl. Suspendisse vitae aliquet nulla. Donec volutpat odio dui, non tincidunt lacus finibus maximus. Praesent et dignissim augue, id mollis sem. In tincidunt placerat felis, et finibus diam luctus non.'),
(4, 'text about 4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam in tellus erat. Maecenas et molestie arcu. Proin in fringilla nisl. Suspendisse vitae aliquet nulla. Donec volutpat odio dui, non tincidunt lacus finibus maximus. Praesent et dignissim augue, id mollis sem. In tincidunt placerat felis, et finibus diam luctus non.'),
(5, 'text kontakt', 'kontakt'),
(6, 'visible_tel', 'on'),
(7, 'visible_mail', 'on'),
(8, 'menu option 1', 'Marek Sztajgli'),
(9, 'menu option 2', 'o mnie'),
(10, 'menu option 3', 'galeria'),
(11, 'menu option 4', 'polecam'),
(12, 'menu option 5', 'kontakt');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `sliders`
--

INSERT INTO `sliders` (`id`, `name`) VALUES
(1, 'about'),
(2, 'about'),
(3, 'index');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `slider_photos`
--

CREATE TABLE `slider_photos` (
  `id` int(11) NOT NULL,
  `photo_id` int(11) NOT NULL,
  `slider_id` int(11) NOT NULL,
  `active` varchar(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `slider_photos`
--

INSERT INTO `slider_photos` (`id`, `photo_id`, `slider_id`, `active`) VALUES
(1, 1, 3, '1'),
(2, 4, 3, '1'),
(3, 5, 3, '1'),
(4, 6, 3, '1'),
(5, 33, 1, '1'),
(6, 34, 1, '1'),
(7, 35, 1, '1'),
(8, 36, 1, '1'),
(9, 37, 1, '1'),
(10, 38, 1, '1'),
(11, 39, 2, '1'),
(12, 40, 2, '1'),
(13, 41, 2, '1'),
(14, 42, 2, '1');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(1, 'mareksz@gmail.com', '7e49f1438b52346a02e6acfc3c5c5a118b8297e0');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `folders`
--
ALTER TABLE `folders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `folder_photos`
--
ALTER TABLE `folder_photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider_photos`
--
ALTER TABLE `slider_photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `folders`
--
ALTER TABLE `folders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT dla tabeli `folder_photos`
--
ALTER TABLE `folder_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT dla tabeli `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT dla tabeli `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT dla tabeli `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `slider_photos`
--
ALTER TABLE `slider_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
