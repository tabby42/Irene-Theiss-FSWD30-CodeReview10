-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 10. Feb 2018 um 16:28
-- Server-Version: 10.1.30-MariaDB
-- PHP-Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `cr10_irene_theiss_biglibrary`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `author`
--

CREATE TABLE `author` (
  `id` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(55) NOT NULL,
  `lastname` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `author`
--

INSERT INTO `author` (`id`, `firstname`, `lastname`) VALUES
(1, 'Randall', 'Munroe'),
(2, 'Tana', 'French'),
(3, 'Art', 'Spiegelman'),
(4, 'George', 'Lucas'),
(5, 'Kazuo', 'Koike'),
(6, 'Billy', 'Wilder'),
(7, 'Keith', 'Jarrett'),
(8, 'Bad', 'Religion'),
(9, 'Jost', 'Hochuli'),
(10, 'Fiona', 'Apple');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `city`
--

CREATE TABLE `city` (
  `id` int(10) UNSIGNED NOT NULL,
  `zipcode` varchar(16) NOT NULL,
  `city_name` varchar(55) NOT NULL,
  `fk_country_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `city`
--

INSERT INTO `city` (`id`, `zipcode`, `city_name`, `fk_country_id`) VALUES
(1, '98672', 'New York', 1),
(2, '12345', 'Munich', 2),
(3, '6754', 'London', 3),
(4, '97222', 'Milwaukee', 1),
(5, '8268', 'Salenstein', 4);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `country`
--

CREATE TABLE `country` (
  `id` int(10) UNSIGNED NOT NULL,
  `country_code` varchar(8) NOT NULL,
  `country_name` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `country`
--

INSERT INTO `country` (`id`, `country_code`, `country_name`) VALUES
(1, 'USA', 'United Staes of America'),
(2, 'D', 'Germany'),
(3, 'UK', 'United Kingdom'),
(4, 'CH', 'Switzerland');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `genre`
--

CREATE TABLE `genre` (
  `id` int(10) UNSIGNED NOT NULL,
  `genre_name` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `genre`
--

INSERT INTO `genre` (`id`, `genre_name`) VALUES
(1, 'Fiction'),
(2, 'Non-Fiction'),
(3, 'Comics'),
(4, 'Jazz'),
(5, 'Punk'),
(6, 'Science Fiction'),
(7, 'Comedy'),
(8, 'Alternative');

-- --------------------------------------------------------

--
-- Stellvertreter-Struktur des Views `getmedia`
-- (Siehe unten für die tatsächliche Ansicht)
--
CREATE TABLE `getmedia` (
`id` int(10) unsigned
,`title` varchar(255)
,`image_url` varchar(255)
,`isbn` varchar(55)
,`short_description` varchar(1000)
,`DATE_FORMAT(publish_date, '%d.%m.%Y')` varchar(10)
,`mediatype` enum('Book','DVD','CD')
,`CONCAT(author.firstname, ' ', author.lastname)` varchar(111)
,`genre_name` varchar(55)
,`pub_name` varchar(55)
,`reserved` enum('true','false')
);

-- --------------------------------------------------------

--
-- Stellvertreter-Struktur des Views `getrentedmedia`
-- (Siehe unten für die tatsächliche Ansicht)
--
CREATE TABLE `getrentedmedia` (
`id` int(10) unsigned
,`title` varchar(255)
,`CONCAT(author.firstname, ' ', author.lastname)` varchar(111)
,`DATE_FORMAT(rental_date, '%d.%m.%Y')` varchar(10)
,`return_date` varchar(10)
);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `media`
--

CREATE TABLE `media` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `fk_author_id` int(10) UNSIGNED NOT NULL,
  `isbn` varchar(55) DEFAULT NULL,
  `short_description` varchar(1000) DEFAULT NULL,
  `publish_date` date NOT NULL,
  `fk_publisher_id` int(10) UNSIGNED NOT NULL,
  `mediatype` enum('Book','DVD','CD') NOT NULL,
  `fk_genre_id` int(10) UNSIGNED NOT NULL,
  `reserved` enum('true','false') NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `media`
--

INSERT INTO `media` (`id`, `title`, `image_url`, `fk_author_id`, `isbn`, `short_description`, `publish_date`, `fk_publisher_id`, `mediatype`, `fk_genre_id`, `reserved`) VALUES
(1, 'What if', 'img/whatif.jpg', 1, '12345678', 'From the creator of the wildly popular xkcd.com, hilarious and informative answers to important questions you probably never thought to ask.', '2015-09-24', 1, 'Book', 2, 'false'),
(2, 'The Trespasser', 'img/trespasser.jpg', 2, '12345678', 'Dublin detective Antoinette Conway returns in French’s absorbing tale of a murder that looks like a lovers’ tiff.', '2017-11-01', 2, 'Book', 1, 'false'),
(3, 'Maus', 'img/maus.jpg', 3, '12345678', 'The Pulitzer Prize-winning Maus tells the story of Vladek Spiegelman, a Jewish survivor of Hitler\'s Europe, and his son, a cartoonist coming to terms with his father\'s story. Maus approaches the unspeakable through the diminutive.', '1986-01-01', 3, 'Book', 3, 'false'),
(4, 'Lady Snowblood', 'img/snowblood.jpg', 5, '12345678', 'A story of pure vengeance, Lady Snowblood tells the tale of a daughter born of a singular purpose, to avenge the death of her family at the hands of a gang of thugs, a purpose woven into her soul from the time of her gestation. ', '2005-03-12', 6, 'Book', 3, 'false'),
(5, 'The Last Jedi', 'img/lastjedi.jpg', 4, NULL, 'With the destruction of the Republic, the evil First Order reigns. Now, Supreme Leader Snoke looks to crush what\'s left of the Resistance and cement his grip on the galaxy.', '2017-12-01', 4, 'DVD', 6, 'false'),
(6, 'Some like it hot', 'img/somelike.jpg', 6, NULL, 'When two male musicians witness a mob hit, they flee the state in an all-female band disguised as women, but further complications set in.', '1959-09-17', 4, 'DVD', 7, 'false'),
(7, 'Stranger than Fiction', 'img/stranger.jpg', 8, NULL, 'With sales continuing 24 years after its release, Stranger Than Fiction is one of Bad Religion\'s most successful albums.', '1994-06-19', 5, 'CD', 5, 'false'),
(8, 'Radiance', 'img/radiance.jpg', 7, NULL, 'Radiance is not just a return to form; it\'s an instant classic of solo improvisation that is destined to rank highly among Jarrett\'s strongest work. ', '2006-08-10', 5, 'CD', 4, 'false'),
(9, 'Das Detail in der Typographie', 'img/typo.jpg', 9, '78754578', 'Der Schweizer Typograf und Buchgestalter Jost Hochuli gibt in dieser Broschüre eine knapp gefasste, informative Einführung in die Mikro- oder Detailtypografie. Es geht um die grundlegenden Einheiten: Buchstabe, Buchstabenabstand, Wort, Wortabstand, Zeile, Zeilenabstand, Kolumne. ', '1994-11-01', 7, 'Book', 2, 'true'),
(10, 'The Idler Wheel Is Wiser Than The Driver Of The Screw', 'img/idler.jpeg', 10, NULL, 'Musically, Idler Wheel confirms Apple’s preference for piano-driven arrangements and for a contralto and belting style of singing to emphasize the emotion in her lyrics. Many of the traits that were developing in her earlier albums come into full bloom here. ', '2012-06-19', 5, 'CD', 8, 'true');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `publisher`
--

CREATE TABLE `publisher` (
  `id` int(10) UNSIGNED NOT NULL,
  `pub_name` varchar(55) NOT NULL,
  `size` enum('small','medium','big') NOT NULL,
  `address` varchar(255) NOT NULL,
  `fk_city_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `publisher`
--

INSERT INTO `publisher` (`id`, `pub_name`, `size`, `address`, `fk_city_id`) VALUES
(1, 'John Murray', 'medium', 'Somestreet 45', 3),
(2, 'Hodder', 'small', 'Differentstreet 45', 3),
(3, 'Penguin', 'big', 'Anotherstreet 123', 3),
(4, 'Ashton Productions', 'big', 'Hauptstraße 77', 2),
(5, 'ECM', 'big', 'Some Avenue 453', 1),
(6, 'Dark Horse', 'small', '10956 SE Main Street', 4),
(7, 'Niggli Verlag', 'small', 'Arenenbergstrasse 2', 5);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(55) NOT NULL,
  `lastname` varchar(55) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `pwd`, `email`) VALUES
(1, 'Test', 'Tester', '$2y$10$41UCfabFdgaYz4h0dEWeO.tuOefScad84vUeXcDH5FjvfNWNEjmau', 'test@gmx.at');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_media`
--

CREATE TABLE `user_media` (
  `id` int(10) UNSIGNED NOT NULL,
  `fk_user_id` int(10) UNSIGNED NOT NULL,
  `fk_media_id` int(10) UNSIGNED NOT NULL,
  `rental_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `user_media`
--

INSERT INTO `user_media` (`id`, `fk_user_id`, `fk_media_id`, `rental_date`) VALUES
(1, 1, 9, '2018-01-31'),
(2, 1, 10, '2018-02-09');

-- --------------------------------------------------------

--
-- Struktur des Views `getmedia`
--
DROP TABLE IF EXISTS `getmedia`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `getmedia`  AS  select `media`.`id` AS `id`,`media`.`title` AS `title`,`media`.`image_url` AS `image_url`,`media`.`isbn` AS `isbn`,`media`.`short_description` AS `short_description`,date_format(`media`.`publish_date`,'%d.%m.%Y') AS `DATE_FORMAT(publish_date, '%d.%m.%Y')`,`media`.`mediatype` AS `mediatype`,concat(`author`.`firstname`,' ',`author`.`lastname`) AS `CONCAT(author.firstname, ' ', author.lastname)`,`genre`.`genre_name` AS `genre_name`,`publisher`.`pub_name` AS `pub_name`,`media`.`reserved` AS `reserved` from (((`media` join `author` on((`media`.`fk_author_id` = `author`.`id`))) join `genre` on((`media`.`fk_genre_id` = `genre`.`id`))) join `publisher` on((`media`.`fk_publisher_id` = `publisher`.`id`))) order by `media`.`title` ;

-- --------------------------------------------------------

--
-- Struktur des Views `getrentedmedia`
--
DROP TABLE IF EXISTS `getrentedmedia`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `getrentedmedia`  AS  select `user`.`id` AS `id`,`media`.`title` AS `title`,concat(`author`.`firstname`,' ',`author`.`lastname`) AS `CONCAT(author.firstname, ' ', author.lastname)`,date_format(`user_media`.`rental_date`,'%d.%m.%Y') AS `DATE_FORMAT(rental_date, '%d.%m.%Y')`,date_format((`user_media`.`rental_date` + interval 2 week),'%d.%m.%Y') AS `return_date` from (((`user` join `user_media` on((`user`.`id` = `user_media`.`fk_user_id`))) join `media` on((`user_media`.`fk_media_id` = `media`.`id`))) join `author` on((`media`.`fk_author_id` = `author`.`id`))) order by `media`.`title` ;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_city_country` (`fk_country_id`);

--
-- Indizes für die Tabelle `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_media_author` (`fk_author_id`),
  ADD KEY `fk_media_publisher` (`fk_publisher_id`),
  ADD KEY `fk_media_genre` (`fk_genre_id`);

--
-- Indizes für die Tabelle `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_publisher_city` (`fk_city_id`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `user_media`
--
ALTER TABLE `user_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_media__user` (`fk_user_id`),
  ADD KEY `fk_user_media__media` (`fk_media_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `author`
--
ALTER TABLE `author`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT für Tabelle `city`
--
ALTER TABLE `city`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `country`
--
ALTER TABLE `country`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT für Tabelle `media`
--
ALTER TABLE `media`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT für Tabelle `publisher`
--
ALTER TABLE `publisher`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `user_media`
--
ALTER TABLE `user_media`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `fk_city_country` FOREIGN KEY (`fk_country_id`) REFERENCES `country` (`id`);

--
-- Constraints der Tabelle `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `fk_media_author` FOREIGN KEY (`fk_author_id`) REFERENCES `author` (`id`),
  ADD CONSTRAINT `fk_media_genre` FOREIGN KEY (`fk_genre_id`) REFERENCES `genre` (`id`),
  ADD CONSTRAINT `fk_media_publisher` FOREIGN KEY (`fk_publisher_id`) REFERENCES `publisher` (`id`);

--
-- Constraints der Tabelle `publisher`
--
ALTER TABLE `publisher`
  ADD CONSTRAINT `fk_publisher_city` FOREIGN KEY (`fk_city_id`) REFERENCES `city` (`id`);

--
-- Constraints der Tabelle `user_media`
--
ALTER TABLE `user_media`
  ADD CONSTRAINT `fk_user_media__media` FOREIGN KEY (`fk_media_id`) REFERENCES `media` (`id`),
  ADD CONSTRAINT `fk_user_media__user` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
