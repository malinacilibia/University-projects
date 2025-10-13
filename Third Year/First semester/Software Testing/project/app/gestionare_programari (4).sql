-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1:3306
-- Timp de generare: ian. 10, 2025 la 12:22 AM
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
-- Bază de date: `gestionare_programari`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `activitati`
--

DROP TABLE IF EXISTS `activitati`;
CREATE TABLE IF NOT EXISTS `activitati` (
  `cod` int NOT NULL AUTO_INCREMENT,
  `nume` varchar(20) NOT NULL,
  `nivel_dificultate` varchar(20) NOT NULL,
  `durata` varchar(20) NOT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=MyISAM AUTO_INCREMENT=136 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Eliminarea datelor din tabel `activitati`
--

INSERT INTO `activitati` (`cod`, `nume`, `nivel_dificultate`, `durata`) VALUES
(121, 'Curs de pian', 'avansat', '2 ore'),
(122, 'Curs de chitara', 'incepator', '2 ore'),
(123, 'Curs de canto', 'incepator', '2 ore'),
(124, 'Curs de baschet', 'incepator', '2 ore'),
(125, 'Curs de fotbal', 'incepator', '2 ore'),
(126, 'Curs de gimnastica', 'mediu', '2 ore'),
(127, 'Curs de inot', 'incepator', '2 ore'),
(128, 'Curs de pictura', 'incepator', '2 ore'),
(129, 'Curs de desen grafic', 'avansat', '2 ore'),
(130, 'Curs pictura sticla', 'avansat', '2 ore'),
(131, 'Curs de dansuri', 'incepator', '2 ore');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `angajati`
--

DROP TABLE IF EXISTS `angajati`;
CREATE TABLE IF NOT EXISTS `angajati` (
  `cod` int NOT NULL,
  `nume` varchar(20) NOT NULL,
  `prenume` varchar(30) NOT NULL,
  `salariu` int NOT NULL,
  `nr_telefon` varchar(10) NOT NULL,
  `experienta` int NOT NULL,
  `tip_agt` char(1) NOT NULL,
  `cod_ate2` int NOT NULL,
  `instrument` varchar(30) DEFAULT NULL,
  `echipament` varchar(30) DEFAULT NULL,
  `materiale` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`cod`),
  KEY `fk_cod_ate2` (`cod_ate2`)
) ;

--
-- Eliminarea datelor din tabel `angajati`
--

INSERT INTO `angajati` (`cod`, `nume`, `prenume`, `salariu`, `nr_telefon`, `experienta`, `tip_agt`, `cod_ate2`, `instrument`, `echipament`, `materiale`) VALUES
(22340, 'Chiriac', 'Adrian', 3500, '0723775907', 8, 'M', 121, 'pian', NULL, NULL),
(22341, 'Ciobanu', 'Cristina', 3000, '0726789554', 7, 'M', 122, 'chitara', NULL, NULL),
(22342, 'Constantin', 'Andrei', 2500, '0709975487', 5, 'M', 123, 'microfon', NULL, NULL),
(22343, 'Duma', 'Mariana', 3500, '0799876009', 8, 'S', 124, NULL, 'minge baschet', NULL),
(22344, 'Dumitru', 'Carmen', 4000, '0744387765', 10, 'S', 125, NULL, 'minge fotbal', NULL),
(22345, 'Iliescu', 'Cristian', 2500, '0799087669', 5, 'S', 126, NULL, 'saltea', NULL),
(22346, 'Lungu', 'Dorin', 3000, '0755480098', 6, 'S', 127, NULL, 'pluta', NULL),
(22347, 'Munteanu', 'Vlad', 4000, '0745443276', 10, 'D', 128, NULL, NULL, 'vopsea'),
(22348, 'Nistor', 'Sergiu', 4500, '0744118481', 15, 'D', 129, NULL, NULL, 'crioane'),
(22349, 'Stanescu', 'Radu', 2000, '0799865009', 2, 'D', 130, NULL, NULL, 'sticla'),
(22350, 'Stoica', 'Oana', 2500, '0799541125', 2, 'S', 131, NULL, 'costume', NULL);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `grupa_de_varsta`
--

DROP TABLE IF EXISTS `grupa_de_varsta`;
CREATE TABLE IF NOT EXISTS `grupa_de_varsta` (
  `grupa` int NOT NULL,
  `varsta_min` int NOT NULL,
  `varsta_max` int NOT NULL,
  PRIMARY KEY (`grupa`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Eliminarea datelor din tabel `grupa_de_varsta`
--

INSERT INTO `grupa_de_varsta` (`grupa`, `varsta_min`, `varsta_max`) VALUES
(1, 3, 7),
(2, 7, 11),
(3, 12, 15),
(4, 16, 18);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `participanti`
--

DROP TABLE IF EXISTS `participanti`;
CREATE TABLE IF NOT EXISTS `participanti` (
  `nume` varchar(20) NOT NULL,
  `prenume` varchar(30) NOT NULL,
  `data_nast` date NOT NULL,
  `strada` varchar(30) NOT NULL,
  `nr` int NOT NULL,
  `ap` int DEFAULT NULL,
  `nr_tel` varchar(10) NOT NULL,
  `grupa_gvd` int NOT NULL,
  `cod` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`cod`),
  KEY `fk_grupa_gvd` (`grupa_gvd`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Eliminarea datelor din tabel `participanti`
--

INSERT INTO `participanti` (`nume`, `prenume`, `data_nast`, `strada`, `nr`, `ap`, `nr_tel`, `grupa_gvd`, `cod`) VALUES
('Georgescu', 'Ioana', '2011-10-01', 'Aleea Pacii', 44, NULL, '0742490866', 3, 2),
('Neagu', 'Sofia', '2013-11-22', 'Bulevardul Pacii', 3, NULL, '0712985430', 2, 3),
('Nistor', 'Carla', '2012-06-22', 'Intrarea Florilor', 67, NULL, '0767783466', 3, 4),
('Petrescu', 'Andrei', '2006-01-09', 'Calea Victoriei', 34, 44, '0799066745', 4, 5),
('Popa', 'Bogdan', '2013-12-25', 'Drumul Soarelui', 22, NULL, '0722347119', 2, 6),
('Preda', 'Ana', '2013-03-06', 'Splaiul Independentei', 45, NULL, '0722669235', 4, 7),
('Stan', 'Alexia', '2007-09-18', 'Piata Unirii', 6, 5, '0712123455', 4, 8),
('Stanciu', 'Eric', '2021-03-15', 'Aleea Frunzelor', 33, NULL, '0767009890', 1, 9),
('Ungureanu', 'Victor', '2006-10-02', 'Mihai Viteazu', 10, 18, '0743435660', 4, 10);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `plati`
--

DROP TABLE IF EXISTS `plati`;
CREATE TABLE IF NOT EXISTS `plati` (
  `numar` int NOT NULL,
  `data_plata` date NOT NULL,
  `suma` int NOT NULL,
  `banca` varchar(50) DEFAULT NULL,
  `tip_pta` char(1) NOT NULL,
  `cod_ppt` int DEFAULT NULL,
  PRIMARY KEY (`numar`),
  KEY `fk_cod_ppt` (`cod_ppt`)
) ;

--
-- Eliminarea datelor din tabel `plati`
--

INSERT INTO `plati` (`numar`, `data_plata`, `suma`, `banca`, `tip_pta`, `cod_ppt`) VALUES
(100, '2024-02-12', 100, NULL, 'N', 33531),
(101, '2024-01-03', 400, NULL, 'N', NULL),
(102, '2024-04-25', 300, 'Banca Transilvania', 'C', NULL),
(103, '2024-02-15', 400, 'BRD', 'C', NULL),
(104, '2024-02-29', 250, NULL, 'N', NULL),
(105, '2024-01-05', 150, NULL, 'N', NULL),
(106, '2024-05-02', 300, NULL, 'N', NULL),
(107, '2024-03-19', 500, 'BRD', 'C', NULL),
(108, '2024-02-20', 200, NULL, 'N', NULL),
(109, '2024-01-01', 500, NULL, 'N', NULL);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `programari`
--

DROP TABLE IF EXISTS `programari`;
CREATE TABLE IF NOT EXISTS `programari` (
  `numar` int NOT NULL AUTO_INCREMENT,
  `data_programare` date NOT NULL,
  `ora_start` decimal(3,1) NOT NULL,
  `ora_final` decimal(3,1) NOT NULL,
  `tip_pta` char(1) NOT NULL,
  `cod_ptt2` int NOT NULL,
  `cod_ate` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`numar`),
  KEY `fk_cod_ptt2` (`cod_ptt2`),
  KEY `fk_cod_ate` (`cod_ate`),
  KEY `fk_user_programari` (`user_id`)
) ;

--
-- Eliminarea datelor din tabel `programari`
--

INSERT INTO `programari` (`numar`, `data_programare`, `ora_start`, `ora_final`, `tip_pta`, `cod_ptt2`, `cod_ate`, `user_id`) VALUES
(1, '2024-04-11', 10.0, 12.0, 'N', 33536, 121, 0),
(2, '2024-04-11', 12.0, 14.0, 'N', 33536, 121, 0),
(3, '2024-04-11', 15.0, 17.0, 'N', 33536, 121, 0),
(4, '2024-04-12', 9.0, 11.0, 'N', 33536, 122, 0),
(5, '2024-04-12', 12.0, 14.0, 'N', 33536, 121, 0),
(6, '2024-04-15', 15.0, 17.0, 'N', 33536, 121, 0),
(7, '2024-04-15', 17.0, 19.0, 'N', 33536, 121, 0),
(8, '2024-04-19', 9.0, 11.0, 'N', 33536, 121, 0),
(9, '2024-04-19', 10.0, 12.0, 'N', 33536, 121, 0),
(10, '2024-04-19', 17.0, 19.0, 'N', 33536, 121, 0),
(11, '2025-01-01', 22.0, 22.0, '', 0, 0, 4),
(12, '2025-01-22', 23.0, 23.0, '', 0, 0, 4),
(13, '2024-12-30', 23.0, 23.0, '', 0, 125, 4),
(14, '2025-01-07', 12.0, 23.0, '', 0, 127, 5),
(16, '2025-01-27', 14.0, 14.0, '', 0, 128, 5),
(17, '2025-01-24', 18.0, 20.0, '', 0, 127, 6),
(18, '2025-01-26', 17.0, 19.0, '', 0, 124, 6),
(19, '2025-01-26', 16.0, 18.0, '', 0, 131, 6),
(20, '2025-01-20', 17.0, 19.0, '', 0, 128, 7),
(21, '2025-01-09', 5.0, 7.0, '', 0, 121, 7),
(22, '2025-01-22', 15.0, 18.0, '', 0, 126, 5),
(23, '2025-01-12', 19.0, 21.0, '', 0, 130, 5),
(24, '2025-01-05', 18.0, 23.0, '', 0, 129, 4),
(25, '2025-01-20', 5.0, 16.0, '', 0, 127, 4),
(26, '2025-01-27', 17.0, 19.0, '', 0, 131, 4);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `tarife`
--

DROP TABLE IF EXISTS `tarife`;
CREATE TABLE IF NOT EXISTS `tarife` (
  `nr_sedinte` int NOT NULL,
  `pret` int NOT NULL,
  `grupa_gvd2` int NOT NULL,
  PRIMARY KEY (`nr_sedinte`),
  KEY `fk_grupa_gvd2` (`grupa_gvd2`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Eliminarea datelor din tabel `tarife`
--

INSERT INTO `tarife` (`nr_sedinte`, `pret`, `grupa_gvd2`) VALUES
(1, 100, 1),
(2, 200, 1),
(3, 150, 2),
(4, 300, 2),
(5, 200, 3),
(6, 400, 3),
(7, 250, 4),
(8, 500, 4);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('profesor','elev') NOT NULL,
  `email` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT 'default.png',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Eliminarea datelor din tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `email`, `avatar`) VALUES
(3, 'malinacilibia', '$2y$10$BMvt8vE/J0HLdGNxdtHNqOWgErn6uTJcH9ygriQfQzW.dxXWXqWGe', 'profesor', 'malina.cilibia@gmail.com', 'uploads/avatars/female-avatar-portrait-of-a-cute-brunette-woman-illustration-of-a-female-character-in-a-modern-color-style-vector.jpg'),
(4, 'nicolarusu', '$2y$10$xxPG6pZJ0gCS.Di7ZJl38ux5iTxYxoQa9Q7a3qgxoRKTdZOS469Sq', 'elev', 'nicola.rusu@gmail.com', 'uploads/avatars/beautiful-blonde-woman-with-makeup-avatar-for-a-beauty-salon-illustration-in-the-cartoon-style-vector.jpg'),
(5, 'andreeamarcu', '$2y$10$YiC3sb.D.t2CTAEbYzZFxecyCpFeOlfMwlV7LeLYnIQxPdeZlvzAO', 'elev', 'andreea.marcu@gmail.com', 'uploads/avatars/a-girl-s-face-with-a-beautiful-smile-a-female-avatar-for-a-website-and-social-network-vector.jpg'),
(6, 'alexiasocaciu', '$2y$10$/odsXQ/P9gunuLkDU//RVuMli0v7P2IgCeAms/5w0jAsx0Qvqzve2', 'elev', 'alexiasocaciu@gmail.com', 'uploads/avatars/beautiful-girl-with-blue-hair-avatar-of-woman-for-social-network-vector.jpg'),
(7, 'rebecafilep', '$2y$10$/tMXcz2P166MNPoQ7FdDqORxcnyqOiDEy/a4Km/.ofy/DTp0j/R8W', 'elev', 'rebecafilep@gmail.com', 'uploads/avatars/unnamed.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
