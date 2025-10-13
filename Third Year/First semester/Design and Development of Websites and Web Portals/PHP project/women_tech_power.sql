-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1:3306
-- Timp de generare: dec. 01, 2024 la 10:32 AM
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
-- Bază de date: `women_tech_power`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `applications`
--

DROP TABLE IF EXISTS `applications`;
CREATE TABLE IF NOT EXISTS `applications` (
  `id` int NOT NULL,
  `job_id` int NOT NULL,
  `applicant_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `applicant_email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `applied_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `applicant_first_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `applicant_last_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `previous_experience` text COLLATE utf8mb4_general_ci NOT NULL,
  `recommendation` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `applications`
--

INSERT INTO `applications` (`id`, `job_id`, `applicant_name`, `applicant_email`, `applied_at`, `applicant_first_name`, `applicant_last_name`, `previous_experience`, `recommendation`) VALUES
(0, 0, 'malina', 'malina.cilibia@gmail.com', '2024-11-19 22:18:38', '', '', '', ''),
(0, 0, 'malina', 'malina.cilibia@gmail.com', '2024-11-19 22:24:36', '', '', '', ''),
(0, 0, 'malina', 'malina.cilibia@gmail.com', '2024-11-19 22:49:19', '', '', '', ''),
(0, 2, '', 'malina.cilibia@gmail.com', '2024-11-22 21:29:52', 'Malina', 'Cilibia', 'Nu am experienta', 'Sunt pasionata de informatica'),
(0, 5, '', 'malina.cilibia@gmail.com', '2024-11-23 13:43:32', 'Malina', 'Cilibia', '-', '-\r\n'),
(0, 4, '', 'alina.popa@gmail.com', '2024-11-29 17:41:21', 'alina', 'popa', 'facultate\r\n', 'j'),
(0, 1, '', 'malina.cilibia@gmail.com', '2024-11-29 17:45:48', 'Malina', 'Cilibia', 'ss', 'ss'),
(0, 1, '', 'malina.cilibia@gmail.com', '2024-12-01 10:12:13', 'Malina', 'Cilibia', 's', 's');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Eliminarea datelor din tabel `events`
--

INSERT INTO `events` (`id`, `name`, `type`, `date`) VALUES
(1, 'Online Workshop', 'Online', '2024-12-01'),
(2, 'Community Meetup', 'Offline', '2024-12-10'),
(3, 'Web Development Bootcamp', 'Online', '2024-12-15'),
(4, 'Networking Event', 'Offline', '2024-12-20');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `eventsfeedback`
--

DROP TABLE IF EXISTS `eventsfeedback`;
CREATE TABLE IF NOT EXISTS `eventsfeedback` (
  `id` int NOT NULL AUTO_INCREMENT,
  `event_id` int NOT NULL,
  `rating` int NOT NULL,
  `comments` text,
  PRIMARY KEY (`id`),
  KEY `event_id` (`event_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Eliminarea datelor din tabel `eventsfeedback`
--

INSERT INTO `eventsfeedback` (`id`, `event_id`, `rating`, `comments`) VALUES
(1, 2, 5, 'Excelent!'),
(2, 4, 4, 'Un eveniment foarte bine organizat'),
(3, 1, 1, 'i'),
(4, 3, 5, 'Mi-a placut\r\n');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int NOT NULL,
  `mentor_name` varchar(255) NOT NULL,
  `mentee_name` varchar(255) NOT NULL,
  `rating` int DEFAULT NULL,
  `comments` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ;

--
-- Eliminarea datelor din tabel `feedback`
--

INSERT INTO `feedback` (`id`, `mentor_name`, `mentee_name`, `rating`, `comments`, `created_at`) VALUES
(0, 'Andreea Marcu', 'Nicola Rusu', 1, 'xd', '2024-11-19 20:49:19'),
(0, 'Andreea Marcu', 'Nicola Rusu', 5, 'Excelent!', '2024-11-19 21:13:14'),
(0, 'Andreea Marcu', 'Nicola Rusu', 5, 'Excelent!', '2024-11-19 21:15:46'),
(0, 'Andreea Marcu', 'Nicola Rusu', 5, 'Excelent!', '2024-11-19 21:16:06'),
(0, 'Andreea Marcu', 'Nicola Rusu', 5, 'Super', '2024-11-19 21:30:31');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `company` varchar(150) NOT NULL,
  `location` varchar(150) DEFAULT NULL,
  `experience_level` varchar(50) DEFAULT NULL,
  `description` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Eliminarea datelor din tabel `jobs`
--

INSERT INTO `jobs` (`id`, `title`, `company`, `location`, `experience_level`, `description`, `created_at`) VALUES
(1, 'Software Engineer', 'TechCorp', 'Remote', 'Entry-Level', 'Căutăm un inginer software talentat care să se alăture echipei noastre dinamice. Responsabilitățile includ dezvoltarea, testarea și întreținerea aplicațiilor software pentru clienții noștri. Vei lucra într-un mediu colaborativ, utilizând tehnologii de ultimă generație pentru a crea soluții inovatoare. Dacă ai o pasiune pentru programare, atenție la detalii și dorința de a contribui la proiecte interesante, te încurajăm să aplici. Experiența cu limbaje precum Java, Python sau C# reprezintă un avantaj.', '2024-11-19 19:20:25'),
(2, 'Data Analyst', 'DataSolutions', 'Hybrid', 'Mid-Level', 'Căutăm un analist de date cu experiență în utilizarea instrumentelor pentru analiza datelor mari (Big Data). Rolul presupune colectarea, procesarea și interpretarea datelor complexe pentru a furniza rapoarte valoroase și a susține deciziile strategice ale companiei. Candidatul ideal este o persoană analitică, cu atenție la detalii și abilități excelente de comunicare. Experiența cu software-uri precum Tableau, Power BI sau limbaje de programare precum SQL, R sau Python este apreciată. Dacă îți place să transformi datele în informații utile, te așteptăm să aplici.', '2024-11-19 19:20:25'),
(3, 'Project Manager', 'InnovateX', 'Office', 'Senior-Level', 'Avem nevoie de un manager de proiect cu experiență de peste 5 ani, capabil să gestioneze proiecte complexe de la început până la finalizare. Vei fi responsabil de coordonarea echipelor, monitorizarea progresului și asigurarea respectării termenelor și bugetelor stabilite. Compania noastră caută un lider organizat, cu abilități excelente de comunicare și rezolvare a problemelor. Cunoașterea metodologiilor Agile sau Waterfall reprezintă un plus. Dacă îți dorești să contribui la succesul unor proiecte inovatoare, te invităm să aplici.', '2024-11-19 19:20:25'),
(4, 'Software Developer', 'Tech Corp', 'Remote', 'Mid-Level', 'TechCorp caută un dezvoltator software talentat pentru a se alătura echipei sale tehnice. Responsabilitățile includ scrierea codului curat și eficient, colaborarea cu echipa pentru implementarea cerințelor și rezolvarea problemelor tehnice. Candidatul ideal este pasionat de tehnologie și are experiență în lucrul cu limbaje precum JavaScript, Java sau .NET. Dacă vrei să contribui la proiecte interesante și să înveți dintr-un mediu profesionist, aplică acum!', '2024-11-19 19:20:25'),
(5, 'Project Manager', 'InnovateX', 'Hybrid', 'Senior-Level', 'Căutăm un manager de proiect experimentat care să gestioneze inițiativele noastre strategice. Vei lucra îndeaproape cu echipe multidisciplinare pentru a defini obiectivele proiectului, a planifica resursele și a menține relațiile cu clienții. Este necesară o experiență solidă în managementul proiectelor, cu un accent pe livrarea calității și respectarea termenelor limită. Experiența în utilizarea instrumentelor de management, precum Jira sau MS Project, este apreciată. Dacă ești o persoană proactivă, orientată spre rezultate, așteptăm aplicația ta!', '2024-11-19 19:20:25');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `match`
--

DROP TABLE IF EXISTS `match`;
CREATE TABLE IF NOT EXISTS `match` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mentee_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Eliminarea datelor din tabel `match`
--

INSERT INTO `match` (`id`, `mentee_name`, `created_at`) VALUES
(1, 'Nicola Rusu', '2024-11-19 20:52:11'),
(2, 'Nicola Rusu', '2024-11-19 20:54:14'),
(3, 'Nicola Rusu', '2024-11-19 20:56:50'),
(4, 'Nicola Rusu', '2024-11-19 21:19:23'),
(5, 'Nicola Rusu', '2024-11-19 21:19:42'),
(6, 'Nicola Rusu', '2024-11-19 21:31:00'),
(7, 'Nicola Rusu', '2024-11-22 21:36:21'),
(8, 'Nicola Rusu', '2024-11-23 13:43:00'),
(9, 'Nicola Rusu', '2024-12-01 10:11:19');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `mentors`
--

DROP TABLE IF EXISTS `mentors`;
CREATE TABLE IF NOT EXISTS `mentors` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `expertise` varchar(255) NOT NULL,
  `years_of_experience` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Eliminarea datelor din tabel `mentors`
--

INSERT INTO `mentors` (`id`, `name`, `expertise`, `years_of_experience`, `created_at`) VALUES
(1, 'Andreea Marcu', 'Software Development', 8, '2024-11-19 20:56:09'),
(2, 'Cristina Popescu', 'Cybersecurity', 5, '2024-11-19 20:56:09'),
(3, 'Ioana Ionescu', 'Data Science', 7, '2024-11-19 20:56:09');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `mentorship_program`
--

DROP TABLE IF EXISTS `mentorship_program`;
CREATE TABLE IF NOT EXISTS `mentorship_program` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mentor_id` int NOT NULL,
  `mentee_id` int NOT NULL,
  `status` enum('pending','active','completed','cancelled') DEFAULT 'pending',
  `notes` text,
  PRIMARY KEY (`id`),
  KEY `mentor_id` (`mentor_id`),
  KEY `mentee_id` (`mentee_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `progress`
--

DROP TABLE IF EXISTS `progress`;
CREATE TABLE IF NOT EXISTS `progress` (
  `id` int NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL,
  `objectives_met` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Eliminarea datelor din tabel `progress`
--

INSERT INTO `progress` (`id`, `description`, `status`, `objectives_met`, `created_at`) VALUES
(0, 'dd', 'dd', 'dd', '2024-11-19 20:50:46'),
(0, 'ccc', 'ccc', 'cc', '2024-11-19 20:58:05'),
(0, 'dd', 'dd', 'dd', '2024-11-19 21:17:45'),
(0, 'ccc', 'dd', 'dd', '2024-11-19 21:30:38'),
(0, 'ccc', 'dd', 'dd', '2024-11-19 21:30:55'),
(0, 'dd', 'dd', 'dd', '2024-11-22 21:36:14'),
(0, 'dd', 'ccc', 'dd', '2024-12-01 10:11:10');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `registrations`
--

DROP TABLE IF EXISTS `registrations`;
CREATE TABLE IF NOT EXISTS `registrations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `event_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `event_id` (`event_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Eliminarea datelor din tabel `registrations`
--

INSERT INTO `registrations` (`id`, `name`, `email`, `event_id`) VALUES
(1, 'Rusu Nicola', 'nicola.rusu@gmail.com', 2),
(2, 'cilibia malina', 'malina.cilibia@gmail.com', 3),
(3, 'cilibia malina', 'malina.cilibia@gmail.com', 2),
(4, 'Rusu Nicola', 'malina.cilibia@gmail.com', 3),
(5, 'Rusu Nicola', 'malina.cilibia@gmail.com', 3),
(6, 'Rusu Nicola', 'malina.cilibia@gmail.com', 3);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `resources`
--

DROP TABLE IF EXISTS `resources`;
CREATE TABLE IF NOT EXISTS `resources` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text,
  `type` varchar(50) DEFAULT NULL,
  `content` text,
  `date` date NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Eliminarea datelor din tabel `resources`
--

INSERT INTO `resources` (`id`, `title`, `description`, `type`, `content`, `date`, `url`, `image_url`) VALUES
(1, 'Microsoft Power Women in Tech Award', 'According to Accenture, only 21% of women believe the technology industry is a place they can thrive in. So, we’re searching for female tech leaders at our partner organizations who can inspire other women to go further in technology.\n\nOur winners will be role models who have forged an extraordinary professional path leveraging or developing tech innovations and are actively contributing to the promotion of women and girls in STEM careers in their country.', 'Articol', 'Detailed content for Microsoft Power Women in Tech Award.', '2024-01-15', 'https://pulse.microsoft.com/en/transform-en/na/fa3-microsoft-power-women-in-tech-award-power-success-spark-inspiration/', 'images/default.jpg'),
(2, 'How Microsoft Learn supports Women in Tech', 'The Global Knowledge 2020 IT Skills and Salary Report found that 86% of women in IT positions hold at least one certification.1 Being certified can help establish a path for advancement in tech roles and can be critical for success in a competitive field. In this edition of our #ProudToBeCertified blog series, we’ll dive into how certifications have helped two women on very different career paths.', 'Articol', 'Detailed content for Microsoft Learn support.', '2024-02-10', 'https://techcommunity.microsoft.com/blog/microsoftlearnblog/how-microsoft-learn-advance-women-in-tech/2038068', 'images/default.jpg'),
(3, 'Microsoft Power Women Awards 2024', 'The Microsoft Power Women Awards are part of Microsoft’s ongoing commitment to inspire a new generation and invest in female tech talent.\n\nWomen make up almost half (49%) of total employment across non-STEM occupations, but just 29% of all tech-related roles.1 For high-level leadership positions such as VP and C-suite, representation drops to 17.8% and 12.4%, respectively. We believe that if we are not unleashing the full potential of female tech talent, then our businesses are missing out. We want to change this statistics, which is why we’re shining a spotlight on talented tech professionals from across Europe.', 'Articol', 'Content for Microsoft Power Women Awards 2024.', '2024-03-05', 'https://pulse.microsoft.com/en/transform-en/na/fa1-amplifying-ambition-to-spark-inspiration-microsoft-power-women-awards-2024/', 'images/default.jpg'),
(4, 'Top Programs for Women in Tech', 'Women in tech refers to women’s involvement in the technology field. In the past, most tech jobs were held by men, and women faced barriers to entering and advancing in the industry. However, there is a growing recognition of the importance of diversity in tech, and efforts are being made to support and empower women in this field.', 'Articol', 'Content for top programs for women in tech.', '2024-04-20', 'https://www.geeksforgeeks.org/top-programs-for-women-in-tech/', 'images/default.jpg'),
(5, 'Guides and Tutorials - Women in Tech Network', 'Empowering Women in Tech to Reach Their Goals and Thrive\n\nAt WomenTech, we are committed to providing resources and guidance for women in tech, from beginners to experienced professionals. Our website provides users with a variety of How-To Guides, Tutorials, Tips & Tricks related to the world of technology. These articles have been written by industry experts who can offer insight into the latest trends in the field of technology, advice on mentorship, building your personal brand, finding job opportunities, how to be successful in a tech career, and tips on acquiring the right skills for the job. Additionally, our website provides comprehensive tutorials on specific topics such as coding and web development. We also offer a community platform where users can ask questions, receive feedback, and share experiences with fellow women in tech.', 'Articol', 'Content for guides and tutorials.', '2024-05-10', 'https://www.womentech.net/blog/guides-tutorials-advice', 'images/default.jpg'),
(6, 'Technology Needs Women! | Mona Badie | TEDxAirlie\n', 'A video resource related to technology for women in tech.', 'Video', 'Video content for Video 1.', '2024-06-15', 'https://www.youtube.com/watch?v=DthKXHDF7aU', 'images/video1.jpg'),
(7, 'Recruiting women for science, technology, engineering and maths: Sheryl Sorby at TEDxFulbrightDublin\n', 'Another video resource focused on tech innovations.', 'Video', 'Video content for Video 2.', '2024-06-20', 'https://www.youtube.com/watch?v=cJZIhl28HFI', 'images/video2.png'),
(8, 'Inspiring the next generation of female engineers | Debbie Sterling | TEDxPSU\n', 'A third video resource for women in tech.', 'Video', 'Video content for Video 3.', '2024-07-01', 'https://www.youtube.com/watch?v=FEeTLopLkEo', 'images/video3.jpg'),
(9, 'Podcast 1', 'How To Become A Powerful Woman, Build Self-Worth & Set Boundaries!', 'Podcast', 'Podcast content for Podcast 1.', '2024-08-01', 'https://www.youtube.com/watch?v=7aJWN1VJnxs', 'images/default.jpg'),
(10, 'Podcast 2', 'How to Become Your Highest Self: Essential Glow-Up Tips with Jaz Turner', 'Podcast', 'Podcast content for Podcast 2.', '2024-08-10', 'https://www.youtube.com/watch?v=uFP3ZmQ8_oA&t=96s', 'images/default.jpg'),
(11, 'Podcast 3', 'Oprah Winfrey\'s Speech NO ONE Wants To Hear - One Of The Most Inspiring Speeches | Motivation', 'Podcast', 'Podcast content for Podcast 3.', '2024-08-15', 'https://www.youtube.com/watch?v=xnzJTre0TMg', 'images/default.jpg'),
(12, 'Embodying Women\'s Work', 'Autor: Caroline Gatrell', 'Downloadable', 'Content of eBook 1.', '2024-09-01', 'https://books.google.ro/books?hl=ro&lr=&id=CuNEBgAAQBAJ&oi=fnd&pg=PP1&dq=powerful+women+ebooks&ots=pBeJLnXykL&sig=ZqT3rQLjCbD6yi7bKxihqE8oxNU&redir_esc=y#v=onepage&q=powerful%20women%20ebooks&f=false', 'images/default.jpg'),
(13, 'Study, Power and the University', 'Autor: Sarah J. Mann', 'Downloadable', 'Content of eBook 2.', '2024-09-10', 'https://books.google.ro/books?hl=ro&lr=&id=M-REBgAAQBAJ&oi=fnd&pg=PP1&dq=powerful+women+ebooks&ots=KMYmfPxMDI&sig=tXSIxCKDdmbfD3GLo9aGgVQbJ0w&redir_esc=y#v=onepage&q=powerful%20women%20ebooks&f=false', 'images/default.jpg'),
(14, 'Quality and Power in Higher Education', 'Autor: The Society for Research into Higher Education', 'Downloadable', 'Content of eBook 3.', '2024-09-15', 'https://books.google.ro/books?hl=ro&lr=&id=I0Im8qd3THQC&oi=fnd&pg=PP1&dq=powerful+women+ebooks&ots=Psw4Wnap2_&sig=9ne4urmrpPrIPuE7phptI3eP1xs&redir_esc=y#v=onepage&q=powerful%20women%20ebooks&f=false', 'images/default.jpg');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mentor_name` varchar(255) NOT NULL,
  `mentee_name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `subject` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Eliminarea datelor din tabel `sessions`
--

INSERT INTO `sessions` (`id`, `mentor_name`, `mentee_name`, `date`, `time`, `subject`, `created_at`) VALUES
(1, 'Andreea Marcu', 'Nicola Rusu', '2024-11-09', '22:45:00', 'Informatica', '2024-11-19 20:45:18'),
(2, 'Andreea Marcu', 'Nicola Rusu', '2024-11-08', '22:48:00', 'Informatica', '2024-11-19 20:45:26'),
(3, 'Andreea Marcu', 'Nicola Rusu', '2024-10-30', '11:13:00', 'Informatica', '2024-11-19 21:12:47'),
(4, 'Andreea Marcu', 'Nicola Rusu', '2024-11-01', '23:27:00', 'Informatica', '2024-11-19 21:26:12'),
(5, 'Andreea Marcu', 'Nicola Rusu', '2024-11-09', '23:34:00', 'Informatica', '2024-11-19 21:30:19'),
(6, 'malina', 'Nicola Rusu', '2024-11-11', '23:37:00', 'Informatica', '2024-11-19 21:31:16'),
(7, 'Andreea Marcu', 'Nicola Rusu', '2024-11-01', '00:36:00', 'Informatica', '2024-11-22 21:36:02'),
(8, 'Andreea Marcu', 'Nicola Rusu', '2024-11-01', '23:22:00', 'Informatica', '2024-11-29 17:18:55'),
(9, 'Andreea Marcu', 'Nicola Rusu', '2024-12-10', '15:13:00', 'Informatica', '2024-12-01 10:11:00');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('member','mentor','admin') DEFAULT 'member',
  `profile_details` json DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Eliminarea datelor din tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `profile_details`) VALUES
(1, 'Malina Cilibia', 'malina.cilibia@gmail.com', '$2y$10$rPuDg3ZCIOPYSGJcpMoSvuWW7/tKJUMMaDAwRlvJ/d1QuR46jdFly', 'admin', '{\"managed_projects\": \"Tech Women Leadership Summit: Organizare și coordonare a unui eveniment anual pentru promovarea femeilor în tehnologie, cu peste 500 de participanți.\\r\\nDigital Skills Bootcamp: Lansare și implementare a unui program de formare digitală pentru tineri profesioniști.\\r\\nMentorship Program: Dezvoltare și gestionare a unei platforme de mentorat care conectează mentorii cu mentee.\\r\\n\", \"role_description\": \"Ca admin, Malina este responsabilă de gestionarea operațiunilor zilnice, coordonarea echipei și asigurarea respectării standardelor organizaționale. Contribuie la strategia organizațională prin planificarea și implementarea de inițiative cheie, precum și prin supravegherea rezultatelor proiectelor.\", \"community_contributions\": \"Workshops și Training-uri: Organizarea a peste 20 de sesiuni de training dedicate femeilor interesate să intre în industria tech.\\r\\nNetworking Events: Crearea de oportunități de networking pentru profesioniști și studenți în domeniul IT.\\r\\nBlog Contributions: Publicarea regulată de articole pe teme precum leadership, echitate de gen și inovații tehnologice.\"}'),
(3, 'Nicola Rusu', 'nicola.rusu@gmail.com', '$2y$10$XZaUkr.dTl100hatAvuxke8bbXyP0J3u/Q78oadkpBajXeKRFl/IC', 'member', '{\"projects\": \"Platforma EduTech:\\r\\n\\r\\nO platformă online pentru conectarea profesorilor și elevilor în medii de învățare interactive.\\r\\nTehnologii utilizate: Laravel, Vue.js, PostgreSQL.\\r\\nAplicație de Management Financiar:\\r\\n\\r\\nAplicație care ajută utilizatorii să-și monitorizeze cheltuielile și să planifice economiile.\\r\\nFuncționalități: analiză în timp real, export de rapoarte.\\r\\nTehnologii: Python, Django, SQLite.\\r\\nProiect Open Source - Securitate Cibernetică:\\r\\n\\r\\nDezvoltarea unui instrument care identifică vulnerabilitățile din aplicațiile web.\\r\\nDisponibil pe GitHub pentru comunitatea open source.\", \"education\": \"Studenta la Facultatea de Stiinte Economice si Gestiunea Afacerilor\", \"interests\": \"Dezvoltare Web: Crearea aplicațiilor web moderne și interactive folosind tehnologii precum React și Vue.js.\\r\\nInteligență Artificială: Explorarea algoritmilor de învățare automată pentru soluții complexe.\\r\\nSecuritate Cibernetică: Implementarea de protocoale pentru protecția datelor și prevenirea atacurilor.\\r\\nBlockchain: Studii despre tehnologia blockchain și aplicabilitatea acesteia în finanțe.\"}'),
(2, 'Andreea Marcu', 'andreea.marcu@gmail.com', '$2y$10$7f5N.QPOMqybg4MYvYP6ke7yK9ZKt2rtgdNdMTerTXsLH0tpiaKbK', 'mentor', '{\"skills\": \"Python, SQL, Management de proiect, Leadership, Dezvoltare aplicații web și mobile, Optimizare baze de date\\r\\n\", \"experience\": \"Am lucrat timp de 7 ani ca software developer, dezvoltând aplicații web și mobile pentru companii din domeniul tehnologiei financiare. În ultimii 3 ani, am fost mentor pentru echipe de juniori, ajutându-i să își dezvolte abilitățile tehnice și să gestioneze proiecte complexe.\\r\\n\", \"availability\": \"Sunt disponibilă pentru sesiuni de mentorat Marți și Joi, între orele 17:00 și 19:00.\\r\\n\"}');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
