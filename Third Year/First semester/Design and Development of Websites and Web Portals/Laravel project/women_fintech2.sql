-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1:3306
-- Timp de generare: dec. 15, 2024 la 07:57 PM
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
-- Bază de date: `women_fintech2`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_date` datetime NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Eliminarea datelor din tabel `events`
--

INSERT INTO `events` (`id`, `name`, `event_date`, `description`, `created_at`, `updated_at`) VALUES
(4, 'Women in Tech Conference 2024', '2024-12-28 02:05:00', 'O conferință dedicată femeilor din tehnologie, cu workshopuri și sesiuni inspiraționale despre tendințele în tehnologie.', '2024-12-11 21:04:25', '2024-12-11 21:04:25'),
(5, 'Leadership Workshop for Women', '2025-01-03 17:08:00', 'Un atelier practic pentru dezvoltarea abilităților de leadership și comunicare în mediul tehnologic.', '2024-12-11 21:04:49', '2024-12-11 21:04:49'),
(6, 'FinTech Innovation Summit', '2024-12-31 17:09:00', 'O zi întreagă de discuții despre inovațiile din domeniul FinTech, cu invitați speciali și prezentări captivante.', '2024-12-11 21:05:12', '2024-12-11 21:05:12'),
(7, 'Networking Brunch for Women Entrepreneurs', '2024-12-03 16:08:00', 'Un eveniment de networking unde femeile antreprenor pot împărtăși idei și construi relații profesionale.', '2024-12-11 21:05:36', '2024-12-11 21:05:36'),
(8, 'Career Growth in Tech', '2024-12-16 17:09:00', 'Sesiuni de mentorat și discuții despre cum să îți crești cariera în domeniul tehnologic.', '2024-12-11 21:06:06', '2024-12-11 21:06:06');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profession` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `members_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Eliminarea datelor din tabel `members`
--

INSERT INTO `members` (`id`, `name`, `email`, `profession`, `company`, `linkedin_url`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Malina Cilibia', 'malina.cilibia@gmail.com', 'Student', 'FSEGA', 'https://www.linkedin.com/in/malina-ioana-cilibia-4ab5bb1a9/', 'active', '2024-12-11 16:05:22', '2024-12-12 07:03:24'),
(3, 'Andreea Marcu', 'andreea.marcu@gmail.com', 'Elev', 'Liceu', 'https://www.linkedin.com/in/andreea-cosmina-marcu-26a3b12ba/', 'active', '2024-12-11 16:43:51', '2024-12-11 16:43:51'),
(4, 'Rusu Nicola', 'nicola.rusu@gmail.com', 'Mentor', 'Endava', 'https://www.linkedin.com/in/nicola-maria-rusu-4738812a9/', 'active', '2024-12-11 16:46:03', '2024-12-11 16:46:03'),
(6, 'Rebeca Filep', 'rebeca.filep@gmail.com', 'Student', 'FSEGA', 'https://www.linkedin.com/in/andreea-marcu-2988551b3/', 'inactive', '2024-12-11 16:57:29', '2024-12-11 16:57:29'),
(7, 'Alina Tofan', 'alina.tofan@gmail.com', 'Software Developer', 'Google', 'https://www.linkedin.com/in/elisa-custura-2a145664/', 'active', '2024-12-11 16:58:43', '2024-12-11 16:58:43'),
(8, 'Popa Andrei', 'andrei.popa@gmail.com', 'Product Manager', 'Amazon', 'https://www.linkedin.com/company/mind-bending-physics/posts/?feedView=all', 'active', '2024-12-11 16:59:46', '2024-12-11 16:59:46'),
(9, 'Cilibia Miruna', 'miruna.cilibia@gmail.com', 'Software Developer', 'Amazon', 'https://www.linkedin.com/company/honest-ai-engine/', 'active', '2024-12-11 17:00:42', '2024-12-11 17:00:42'),
(10, 'Maria Marc', 'maria.marc@gmail.com', 'Elev', 'Liceu', NULL, 'inactive', '2024-12-11 17:01:18', '2024-12-11 17:01:18'),
(11, 'Isac Alexia', 'isac.alexia@gmail.com', 'Mentor', 'Endava', NULL, 'inactive', '2024-12-11 17:02:58', '2024-12-11 17:02:58'),
(12, 'Paguba Oana', 'oana.paguba@gmail.com', 'Engineer', 'NTT data', 'https://www.linkedin.com/company/mind-bending-physics/', 'active', '2024-12-11 17:03:57', '2024-12-11 17:03:57'),
(13, 'Socaciu Alexia', 'socaciu.alexia@gmail.com', 'Analist', 'Amazon', NULL, 'inactive', '2024-12-11 17:04:38', '2024-12-11 17:04:38'),
(15, 'Adriana Toderascu', 'adriana.t@gmail.com', 'Elev', 'Liceu', 'https://www.linkedin.com/company/mind-bending-physics/posts/?feedView=all', 'inactive', '2024-12-11 19:14:10', '2024-12-11 19:14:10');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Eliminarea datelor din tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_12_11_163918_create_members_table', 1),
(6, '2024_12_11_163959_create_success_stories_table', 1),
(7, '2024_12_11_164018_create_events_table', 1);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `success_stories`
--

DROP TABLE IF EXISTS `success_stories`;
CREATE TABLE IF NOT EXISTS `success_stories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `story` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `success_stories_member_id_foreign` (`member_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Eliminarea datelor din tabel `success_stories`
--

INSERT INTO `success_stories` (`id`, `title`, `story`, `member_id`, `created_at`, `updated_at`) VALUES
(4, 'Transformarea unei idei în realitate', 'Întotdeauna am visat să creez o platformă care să ajute femeile din comunitățile vulnerabile să obțină acces la educația financiară. Nu știam însă de unde să încep. După ce m-am înscris în programul Women in FinTech, am primit sprijinul și resursele necesare pentru a-mi transforma ideea într-un proiect real. Cu ajutorul mentorilor și al colegelor din comunitate, am lansat o aplicație care oferă cursuri gratuite despre gestionarea banilor. Bucuria de a vedea cât de mulți oameni beneficiază de această platformă este de nedescris!', 3, '2024-12-11 19:01:41', '2024-12-11 19:01:41'),
(2, 'De la student la mentor în tehnologie financiară', 'Acum doi ani eram doar o studentă pasionată de tehnologie și cu dorința de a învăța cât mai multe despre lumea financiară. M-am înscris în comunitatea Women in FinTech pentru a descoperi noi oportunități și pentru a cunoaște persoane cu aceleași interese. Am participat la evenimentele organizate și am beneficiat de un mentorat care mi-a oferit direcții clare pentru cariera mea. Acum, sunt mentor în această comunitate și îi ajut pe alții să-și găsească drumul. Este incredibil cât de mult poate schimba o astfel de experiență viața cuiva!', 2, '2024-12-11 18:53:43', '2024-12-11 18:53:43'),
(3, 'Primul meu proiect în FinTech', 'Am fost mereu pasionată de rezolvarea problemelor, dar nu mi-am imaginat niciodată că pot combina această pasiune cu tehnologia. După ce am început să particip la evenimentele Women in FinTech, am învățat despre cum pot dezvolta soluții digitale pentru probleme financiare reale. Împreună cu o echipă de oameni talentați, am lansat primul meu proiect: o aplicație care ajută utilizatorii să-și gestioneze bugetul personal. Este o realizare de care sunt extrem de mândră și care a deschis multe uși pentru mine în industrie!', 2, '2024-12-11 18:54:12', '2024-12-11 18:54:12'),
(5, 'Primul meu internship în FinTech', 'Ca studentă la informatică, eram nesigură dacă îmi voi găsi un loc în industria FinTech, fiind un domeniu atât de competitiv. După ce am participat la evenimentele Women in FinTech, am reușit să intru în legătură cu profesioniști din industrie care m-au ghidat și mi-au oferit încredere. Prin intermediul comunității, am aplicat la un internship la o companie mare și am fost acceptată! Acum, învăț lucruri noi în fiecare zi și sunt pe drumul cel bun pentru a-mi construi o carieră în acest domeniu.', 4, '2024-12-11 19:02:48', '2024-12-11 19:02:48'),
(6, 'Cum mentoratul mi-a schimbat direcția', 'Înainte de a mă alătura Women in FinTech, lucram într-un domeniu care nu mă pasiona și simțeam că stagnez profesional. Participând la programul de mentorat, am învățat despre diverse cariere în FinTech și am descoperit o pasiune pentru analiza datelor. Cu sprijinul mentorului meu, am urmat cursuri online, am obținut certificări și am început să lucrez într-o poziție care mă motivează zilnic. Fără sprijinul acestei comunități, nu aș fi avut curajul să fac această schimbare majoră', 6, '2024-12-11 19:03:13', '2024-12-11 19:03:13');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
