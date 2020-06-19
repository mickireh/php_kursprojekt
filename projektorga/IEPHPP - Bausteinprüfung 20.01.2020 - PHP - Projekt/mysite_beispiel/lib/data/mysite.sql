-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 11. Apr 2019 um 14:35
-- Server-Version: 10.1.37-MariaDB
-- PHP-Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `mysite`
--
CREATE DATABASE IF NOT EXISTS `mysite` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `mysite`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `content_index`
--

CREATE TABLE IF NOT EXISTS `content_index` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `headline` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subheadline` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `content_index`
--

INSERT INTO `content_index` (`id`, `headline`, `subheadline`, `img`, `text`) VALUES
(1, 'Wikileaks-Gründer Julian Assange in London festgenommen', 'Julian Assange wurde in der Botschaft Ecuadors festgenommen. Vorher hatte ihm das südamerikanische Land seinen Asylstatus aberkannt.', '', 'Londons Polizei hat am Donnerstagvormittag Julian Assange verhaftet. Damit sei ein Haftbefehl aus dem Jahr 2012 gegen den Wikileaks-Gründer durchgesetzt worden, teilte die Polizeibehörde mit. Die Polizisten seien in die Botschaft Ecuadors eingeladen worden, wo sich Assange seit dem Juli 2012 aufhielt.\r\n\r\nAssange befindet sich nach Auskunft der Polizei in einer Polizeistation und soll so schnell wie möglich dem Haftrichter vorgeführt werden. Ihm wird vorgeworfen, am 29. Juni 2012 einen Haftbefehl des Bezirksgerichtes Westminister ignoriert zu haben.\r\n\r\nWie die Metropolitan Police in einer ersten Stellungnahme mitteilt, wurde sie vom ecuadorianischen Botschafter \"eingeladen\", die Botschaftsräume zu betreten und Assange festzunehmen. Zuvor hatte Ecuador das Assange gewährte politische Asyl aufgehoben. Eine Stellungnahme Ecuadors steht noch aus.'),
(2, 'Event Horizon Telescope: Was der erste direkte Nachweis eines Schwarzen Lochs bedeutet', 'Mit dem Event Horizon Telescope ist historisches gelungen: Der erste direkte Nachweis eines Schwarzen Lochs. Eine Erklärung der Hintergründe.', '', 'Am Mittwoch war ein historischer Tag für die Astrophysik: Zum ersten Mal hat die Menschheit die Silhouette eines Schwarzen Lochs erblickt! Natürlich waren sich die Astrophysiker schon lange ziemlich sicher, dass es Schwarze Löcher geben müsse, aber Naturwissenschaften müssen sich stets mit der Wirklichkeit abgleichen, sie sind empirisch. Nur so kann zwischen verschiedenen Modellen das richtige ausgewählt werden. Es spiele keine Rolle, wie schön eine Theorie sei und wie klug ihr Erfinder, hat der große Physiker Richard Feynman einst angemerkt – wenn die Theorie nicht mit den Beobachtungen übereinstimmt, dann ist sie falsch.');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`username`, `password`, `date`) VALUES
('jonsnow', 'iknownothing', '0000-00-00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
