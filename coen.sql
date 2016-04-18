-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 04 apr 2016 om 10:06
-- Serverversie: 5.6.26
-- PHP-versie: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coen`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `jtbl_menus_pages`
--

CREATE TABLE IF NOT EXISTS `jtbl_menus_pages` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `jtbl_menus_pages`
--

INSERT INTO `jtbl_menus_pages` (`id`, `menu_id`, `page_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 5),
(5, 3, 6),
(6, 16, 5),
(7, 16, 6),
(8, 17, 7),
(9, 17, 8),
(10, 17, 9),
(11, 17, 13),
(12, 17, 14),
(13, 17, 19);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `menus`
--

INSERT INTO `menus` (`id`, `name`, `active`) VALUES
(3, 'Form', 1),
(4, 'Material', 1),
(5, 'Context', 1),
(15, 'Program', 1),
(16, 'Experience', 1),
(17, 'example', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` mediumtext NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1' COMMENT 'visible true/false',
  `thumbnail` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `pages`
--

INSERT INTO `pages` (`id`, `name`, `content`, `active`, `thumbnail`) VALUES
(1, 'The Non-place Bus Stop', 'The assignment was to design a bus stop. Before the assignment we had a discussion about the concept of a bus stop.\n\nFor this assignment Marjolein Frishert and I teamed up to design the bus stop. The bus stop we designed was inspired by the idea that a bus stop is a kind of non-place. The focus of your attention will be at your destination, not at the bus stop. We wanted to stimulate that mindset.\nThe inside of the bus stop is a mirroring sphere, distorting your sense of space because it does not offer reference points. It allows your mind to wander and be elsewhere. The entrance will point in the direction of the approach of the bus so this is all you can focus on. To emphasise the non-place the outside of the bus stop is made to look like a temporary construction site. This is a place in an in-between stage just like your trip is when you are at the bus stop. ', 1, 'asset/images/bus_stop_s.jpg'),
(2, 'The guilt-free shower ', '', 1, ''),
(3, 'Photoshop and Illustrator work ', '', 1, ''),
(4, 'test', '', 1, ''),
(6, 'bla4', '<p><img src="/platipus/coendekoning/asset/uploads/exception19.gif" alt="" /></p>\r\n<p>&nbsp;</p>\r\n<h1>Header</h1>', 1, ''),
(12, 'bla', '', 1, ''),
(13, 'abc', '<p>abc</p>', 1, ''),
(14, '1234', '<p>1234</p>', 1, ''),
(15, 'abcde', '', 1, ''),
(16, 'lalala', '', 1, ''),
(17, 'lalala2 phpmyadmin insert', '', 1, ''),
(18, 'blabla', '', 1, ''),
(19, 'example', '<h1>Heading 1</h1>\r\n<h2>Heading 2</h2>\r\n<h3>Heading 3</h3>\r\n<p>&nbsp;</p>\r\n<p><img src="/platipus/coendekoning/asset/uploads/200x200px.png" alt="" /></p>\r\n<h1>&nbsp;</h1>', 1, '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'coen', '835b5f951f68ee8822d7093d4d1ba46a');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `jtbl_menus_pages`
--
ALTER TABLE `jtbl_menus_pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menu_id` (`menu_id`,`page_id`);

--
-- Indexen voor tabel `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `name_2` (`name`);

--
-- Indexen voor tabel `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `jtbl_menus_pages`
--
ALTER TABLE `jtbl_menus_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT voor een tabel `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT voor een tabel `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
