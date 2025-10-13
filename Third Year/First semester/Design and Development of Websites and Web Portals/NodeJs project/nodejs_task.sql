-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1:3306
-- Timp de generare: ian. 08, 2025 la 10:06 PM
-- Versiune server: 8.3.0
-- Versiune PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `nodejs_task`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `id_task` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` enum('in progress','complete') DEFAULT 'in progress',
  `priority` enum('Low','Medium','High') DEFAULT 'Low',
  PRIMARY KEY (`id_task`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Eliminarea datelor din tabel `tasks`
--

INSERT INTO `tasks` (`id_task`, `title`, `description`, `status`, `priority`) VALUES
(12, 'Pregătirea agendei pentru ședință', 'Redactează agenda pentru următoarea ședință de echipă, incluzând punctele de discuție și alocările de timp.', 'complete', 'High'),
(13, 'Actualizarea conținutului site-ului', 'Revizuiește secțiunea \"Despre noi\" a site-ului companiei pentru a reflecta realizările și evenimentele recente.', 'in progress', 'Medium'),
(14, 'Trimiterea raportului lunar', ' Compilează și trimite raportul financiar și operațional pentru lună către echipa de management.', 'complete', 'High'),
(15, 'Organizarea consumabilelor de birou', 'Fă un inventar al consumabilelor de birou și comandă articolele care sunt pe cale să se termine.', 'in progress', 'Low'),
(16, 'Planificarea unei activități de team-building', 'Cercetează și planifică o activitate captivantă de team-building pentru luna următoare pentru a îmbunătăți moralul și colaborarea.', 'in progress', 'Low'),
(17, 'Planificarea unei campanii de marketing', 'Elaborează un plan pentru lansarea unei campanii de marketing online, incluzând strategii pentru rețelele sociale și bugetul necesar.', 'complete', 'Medium');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
