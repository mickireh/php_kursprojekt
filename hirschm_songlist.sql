-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 19. Jan 2020 um 17:22
-- Server-Version: 10.3.16-MariaDB
-- PHP-Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `hirschm_songlist`
--
CREATE DATABASE IF NOT EXISTS `hirschm_songlist` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `hirschm_songlist`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bands`
--

CREATE TABLE `bands` (
  `id` int(10) UNSIGNED NOT NULL,
  `band` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `bands`
--

INSERT INTO `bands` (`id`, `band`) VALUES
(1, 'SOAD'),
(2, 'Slipknot'),
(3, 'Mr. Big'),
(4, 'In Flames'),
(5, 'Metallica'),
(6, 'Stone Sour '),
(7, 'Schandmaul'),
(8, 'Godsmack'),
(9, 'Mudvanye'),
(10, 'Live'),
(11, 'Tool'),
(12, 'Faun'),
(13, 'Crash Test Dummies'),
(14, 'Kansas'),
(16, 'test'),
(17, 'Led Zeppelin');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `topic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `contacts`
--

INSERT INTO `contacts` (`id`, `lastname`, `firstname`, `email`, `message`, `topic`, `created_at`) VALUES
(1, 'reh', 'micki', 'micki@reh.de', 'asddd', 'keineauswahl', '2020-01-10 10:26:59'),
(2, '&lt;script&gt;alert();&lt;/script&gt;', '&lt;script&gt;alert();&lt;/script&gt;', '1@2.de', '<script>alert();</script>', 'keineauswahl', '2020-01-10 10:27:45'),
(3, '&lt;script&gt;alert();&lt;/script&gt;', '&lt;script&gt;alert();&lt;/script&gt;', '1@2.de', 'sdfsd', 'keineauswahl', '2020-01-10 10:38:42'),
(4, '&lt;script&gt;alert();&lt;/script&gt;', 'micki', 'micki@reh.de', 'dfgdfgdfgf', 'Bosse', '2020-01-10 10:39:40'),
(5, '<script>alert();</script>', 'micki', '1@2.de', '<script>alert();</script>', 'keineauswahl', '2020-01-10 10:47:34'),
(6, '<script>alert();</script>', '<script>alert();</script>', 'micki@reh.de', 'serwerewre', 'music', '2020-01-10 12:01:00'),
(7, '<script>alert();</script>', 'micki', '1@2.de', 'dfgdfgdfgdfg', 'keineauswahl', '2020-01-10 16:51:27'),
(8, 'Reh', 'mivki', '111@1.de', 'sdfgsdfsf', 'Bosse', '2020-01-16 08:32:30'),
(9, 'Reh', 'mivki', '111@1.de', 'Hallo', 'keineauswahl', '2020-01-16 08:35:46'),
(10, 'Reh', 'Thomas', 'bla@blub.bli', 'test', 'keineauswahl', '2020-01-17 20:25:16'),
(11, '<script>alert();</script>', 'micki', '1@2.de', 'werwerwer', 'keineauswahl', '2020-01-17 20:26:21'),
(12, 'Reh', 'micki', 'micki@reh.de', 'hallo', 'keineauswahl', '2020-01-19 09:28:34'),
(13, 'Reh', 'micki', 'micki@reh.de', 'hi', 'keineauswahl', '2020-01-19 09:29:17'),
(14, 'Reh', 'micki', '1@2.de', 'hi', 'music', '2020-01-19 09:30:04'),
(15, 'Reh', 'micki', '1@2.de', 'bdbggfffsgb', 'keineauswahl', '2020-01-19 14:05:24');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `images`
--

CREATE TABLE `images` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `images`
--

INSERT INTO `images` (`id`, `image`, `text`) VALUES
(1, 'IMAG1900.jpg', 'Mein Revier'),
(2, 'IMAG1828.jpg', 'Nette Höhle'),
(3, 'IMAG1935.jpg', 'Spezielle Schlafposition'),
(4, 'IMAG1970.jpg', 'Räkeln auf dem Tisch'),
(5, 'IMAG2275.jpg', 'Aha.. und wo ist mein Essen?'),
(6, 'IMAG2464.jpg', 'Nach 3 Jahren Leckerlies knuddel ich auch mal...'),
(7, 'IMAG2336.jpg', 'Gibt\'s Essen? ...sonst lass mich!'),
(8, 'IMAG2473.jpg', 'Menschen bekommen Paket mit Box für mich.'),
(9, 'IMAG2395.jpg', 'Schlafbild Nr. 346'),
(10, 'IMAG2385.jpg', 'Zzzzzzzz'),
(11, 'IMAG1990.jpg', 'Bosse und Wolfi'),
(12, 'IMAG1930.jpg', 'Revier überwachen ist harte Arbeit!'),
(13, 'IMAG1875.jpg', 'Hi :-)'),
(14, 'IMAG1845.jpg', 'Ich mag wenn mein Mensch spielt'),
(15, 'IMAG2465.jpg', 'oh man...'),
(16, 'IMAG2451.jpg', 'Entspannen auf dem Tisch');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `likes`
--

CREATE TABLE `likes` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `image_id` int(10) UNSIGNED NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `image_id`, `updated_at`) VALUES
(6, 2, 5, '2020-01-07 13:48:38'),
(10, 2, 4, '2020-01-07 14:56:19'),
(11, 2, 2, '2020-01-07 14:56:26'),
(14, 2, 6, '2020-01-07 15:06:05'),
(15, 1, 6, '2020-01-07 15:17:51'),
(21, 1, 9, '2020-01-07 16:26:28'),
(29, 1, 4, '2020-01-09 17:01:50'),
(31, 2, 11, '2020-01-10 09:10:26'),
(33, 1, 13, '2020-01-10 14:07:22'),
(35, 2, 3, '2020-01-13 10:20:41'),
(39, 1, 1, '2020-01-16 10:46:13'),
(40, 3, 13, '2020-01-19 10:22:47'),
(41, 3, 7, '2020-01-19 12:14:23'),
(42, 3, 14, '2020-01-19 12:14:27'),
(43, 2, 13, '2020-01-19 13:51:56');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `songs`
--

CREATE TABLE `songs` (
  `id` int(10) UNSIGNED NOT NULL,
  `song` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `band_id` int(10) UNSIGNED NOT NULL,
  `tabs` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `songs`
--

INSERT INTO `songs` (`id`, `song`, `band_id`, `tabs`, `file`) VALUES
(1, 'BYOB', 1, 'https://www.songsterr.com/a/wsa/system-of-a-down-byob-tab-s6699t0', 'byob.txt'),
(2, 'Toxicity', 1, 'https://www.songsterr.com/a/wsa/system-of-a-down-toxicity-tab-s21961t1', 'toxicity.txt'),
(3, 'People = Shit', 2, 'https://www.songsterr.com/a/wsa/slipknot-people-shit-tab-s14043t1', 'peopleequalshit.txt'),
(5, 'To be with you', 3, 'https://www.songsterr.com/a/wsa/mr-big-to-be-with-you-tab-s13304t1', 'tobewithyou.txt'),
(6, 'Moonshield', 4, 'https://www.songsterr.com/a/wsa/in-flames-moonshield-tab-s9987t0', 'moonshield.txt'),
(7, 'Dead Eternity', 4, 'https://www.songsterr.com/a/wsa/in-flames-dead-eternity-tab-s10009t0', 'deadeternity.txt'),
(8, 'The Hive', 4, 'https://tabs.ultimate-guitar.com/tab/in-flames/the-hive-guitar-pro-221994', 'thehive.txt'),
(9, 'One', 5, 'https://www.songsterr.com/a/wsa/metallica-one-tab-s444t1', 'one.txt'),
(10, 'Through Glass', 6, 'https://www.songsterr.com/a/wsa/stone-sour-through-glass-tab-s35622t0', 'throughglass.txt'),
(11, 'Sonnenstrahl', 7, 'https://chords-and-tabs.net/song/name/schandmaul-sonnenstrahl', 'sonnenstrahl.txt'),
(12, 'Voodoo', 8, 'https://www.songsterr.com/a/wsa/godsmack-voodoo-tab-s29621t1', 'voodoo.txt'),
(13, 'Happy', 9, 'https://www.songsterr.com/a/wsa/mudvayne-happy-tab-s13654t0', 'happy.txt'),
(14, 'Freaks', 10, 'https://tabs.ultimate-guitar.com/tab/live/freaks-tabs-73716', 'freaks.txt'),
(15, 'Forget to Remember', 9, 'https://www.songsterr.com/a/wsa/mudvayne-forget-to-remember-bass-tab-s13082t3', 'forgettoremember.txt'),
(17, 'Blaue Stunde', 12, 'NA', 'blauestunde.txt'),
(18, 'Schism', 11, 'https://www.songsterr.com/a/wsa/tool-schism-tab-s6700t1', 'schism.txt'),
(19, 'Mmm mmm mmm mmm', 13, 'https://www.songsterr.com/a/wsa/crash-test-dummies-mmm-mmm-mmm-mmm-tab-s32699t0', 'mmmmmm.txt'),
(20, 'Not Falling', 9, 'https://www.songsterr.com/a/wsa/mudvayne-not-falling-bass-tab-s13438t1', 'notfalling.txt'),
(21, 'Jotun', 4, 'https://www.songsterr.com/a/wsa/in-flames-jotun-tab-s9568t1', 'jotun.txt'),
(24, 'Clayman', 4, 'https://www.songsterr.com/a/wsa/in-flames-clayman-tab-s10007t2', 'clayman.txt'),
(25, 'Roulette', 1, 'https://www.songsterr.com/a/wsa/system-of-a-down-roulette-tab-s19255t0', 'roulette.txt'),
(26, 'Carry on my wayward son', 14, 'https://www.songsterr.com/a/wsa/kansas-carry-on-wayward-son-tab-s11053t2', 'carryonmywaywardson.txt'),
(29, 'test', 16, 'NA', 'test.txt'),
(30, 'Stairway to Heaven', 17, 'https://www.songsterr.com/a/wsa/led-zeppelin-stairway-to-heaven-tab-s27t1', 'stairwaytoheaven.txt'),
(31, 'Hesitate', 6, 'https://www.songsterr.com/a/wsa/stone-sour-hesitate-tab-s80033t1', 'hesitate.txt'),
(32, 'Snuff', 2, 'https://www.songsterr.com/a/wsa/slipknot-snuff-tab-s35673t1', 'snuff.txt'),
(33, 'Colony', 4, 'https://www.songsterr.com/a/wsa/in-flames-colony-tab-s9858t0', 'colony.txt'),
(34, 'Der Hofnarr', 7, 'https://www.songsterr.com/a/wsa/schandmaul-der-hofnarr-chords-s244568', 'derhofnarr.txt'),
(35, 'Dialogue with the stars', 4, 'https://www.songsterr.com/a/wsa/in-flames-dialogue-with-the-stars-tab-s38315t0', 'dialoguewiththestars.txt'),
(36, 'Acoustic Medley', 4, 'https://www.songsterr.com/a/wsa/in-flames-acoustic-medley-tab-s105t0', 'acousticmedley.txt'),
(37, 'And Justice for all', 5, 'https://www.songsterr.com/a/wsa/metallica-and-justice-for-all-tab-s12102t1', 'andjusticeforall.txt'),
(38, 'Welcome Home (Sanitarium)', 5, 'https://www.songsterr.com/a/wsa/metallica-welcome-home-sanitarium-tab-s585t2', 'welcomehome(sanitarium).txt'),
(39, 'Fade to Black', 5, 'https://www.songsterr.com/a/wsa/metallica-fade-to-black-tab-s20t1', 'fadetoblack.txt');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `uid` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`uid`, `name`, `email`, `password`) VALUES
(1, 'admin', '1@2.de', '$2y$10$ZhGIN2PMGFbl2OddUCq1qeNNpK8jrHEUbhS9.8NA2WGCsFIztLW52'),
(2, 'micki', 'micki@reh.de', '$2y$10$yVBOC3TVzEeyG4JP.6YjBuwHX8AMPrg6Y6JzyFmMzLtQeugOWLjnK'),
(3, 'Benutzer1', '2@2.de', '$2y$10$Ei4IpKjVJE0UJaUuBCDexegSqgDGPPdM.yJK.u5sYT5OqmdQMU3I.');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `bands`
--
ALTER TABLE `bands`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `image_id` (`image_id`);

--
-- Indizes für die Tabelle `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `band_id` (`band_id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `bands`
--
ALTER TABLE `bands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT für Tabelle `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT für Tabelle `images`
--
ALTER TABLE `images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT für Tabelle `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT für Tabelle `songs`
--
ALTER TABLE `songs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`uid`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`);

--
-- Constraints der Tabelle `songs`
--
ALTER TABLE `songs`
  ADD CONSTRAINT `songs_ibfk_1` FOREIGN KEY (`band_id`) REFERENCES `bands` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
