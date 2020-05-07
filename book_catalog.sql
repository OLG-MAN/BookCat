-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 07 2020 г., 18:21
-- Версия сервера: 10.4.11-MariaDB
-- Версия PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `book_catalog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `author`
--

CREATE TABLE `author` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `second_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `author`
--

INSERT INTO `author` (`id`, `first_name`, `second_name`, `slug`) VALUES
(110, 'Numquam.', 'Sapiente.', 'sapiente'),
(111, 'Maiores ut.', 'Enim culpa.', 'enim-culpa'),
(112, 'Et vel.', 'Aut earum.', 'aut-earum'),
(113, 'Sit veniam.', 'Sint quia.', 'sint-quia'),
(114, 'Quidem.', 'Voluptatem.', 'voluptatem'),
(115, 'Quod quia.', 'Autem.', 'autem'),
(116, 'Culpa ad.', 'Officiis et.', 'officiis-et'),
(117, 'Facere non.', 'Sit eaque.', 'sit-eaque'),
(118, 'Fugiat.', 'Consequatur.', 'consequatur'),
(119, 'Et.', 'Incidunt et.', 'incidunt-et'),
(120, 'Nihil.', 'Labore aut.', 'labore-aut'),
(121, 'Non omnis.', 'Omnis.', 'omnis'),
(122, 'Non minus.', 'Rerum magni.', 'rerum-magni'),
(123, 'Itaque.', 'Et sunt.', 'et-sunt'),
(124, 'Ea aperiam.', 'Ut suscipit.', 'ut-suscipit'),
(125, 'Quisquam.', 'Asperiores.', 'asperiores'),
(126, 'Ullam.', 'Quaerat.', 'quaerat'),
(127, 'Ad quidem.', 'Temporibus.', 'temporibus'),
(128, 'Enim id.', 'Nostrum.', 'nostrum');

-- --------------------------------------------------------

--
-- Структура таблицы `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `author_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `book`
--

INSERT INTO `book` (`id`, `author_id`, `title`, `description`, `slug`, `created_at`, `image`) VALUES
(149, 118, 'Ea enim quo.ed', 'Eum deleniti iddn.', 'ea-enim-quo-ed', '1983-10-16 15:12:46', '10335609-0-5eb411aa66f43.jpeg'),
(150, 116, 'Rerum.', 'Aut voluptatem.', 'rerum', '1975-08-21 04:43:47', 'img284-51-5eb4073ce6803.jpeg'),
(151, 114, 'Qui.', 'Aut eos consectetur.', 'qui', '2002-02-15 10:22:16', '37690-56624-5eb412226e886.jpeg'),
(152, 130, 'Alias natus.', 'Quia rerum fugit.', 'alias-natus', '1997-01-08 21:51:01', 'img-0285-1-2-5eb4123dd7d42.jpeg'),
(153, 115, 'Magnam modi.', 'Aut sint.', 'magnam-modi', '1989-02-17 23:20:58', 'labkovskiy-5eb412b9b8cfc.jpeg'),
(154, 120, 'Amet quo.', 'Ratione dolorem non.', 'amet-quo', '1997-05-02 22:21:50', 'img330-3-14-5eb413134e96f.jpeg'),
(155, 112, 'Velit rem.', 'Illo quos aut neque.', 'velit-rem', '2013-01-28 03:12:20', 'img335-8-5eb412e838370.jpeg'),
(156, 113, 'Deleniti.', 'Repellendus numquam.', 'deleniti', '2015-08-28 16:34:49', 'cover-image-1-5eb41395e79a5.jpeg'),
(157, 123, 'Officia.', 'Architecto officia.', 'officia', '1979-04-10 05:31:38', 'https://picsum.photos/140/210'),
(158, 119, 'Magnam.', 'Rerum vel a labore.', 'magnam', '2004-03-26 16:26:40', 'https://picsum.photos/140/210'),
(159, 125, 'Et aut.', 'Ipsa velit sunt.', 'et-aut', '1981-06-03 12:31:48', 'https://picsum.photos/140/210'),
(160, 121, 'Culpa quas.', 'Dolorum placeat sit.', 'culpa-quas', '1972-09-19 15:26:57', 'https://picsum.photos/140/210'),
(161, 127, 'Eaque iusto.', 'Illum temporibus.', 'eaque-iusto', '2011-12-14 23:00:31', 'https://picsum.photos/140/210'),
(162, 126, 'Dolorum.', 'Dolorum deserunt id.', 'dolorum', '1981-07-05 20:43:09', 'https://picsum.photos/140/210'),
(163, 111, 'Animi.', 'Est occaecati.', 'animi', '2001-02-20 01:33:44', 'https://picsum.photos/140/210'),
(164, 124, 'Esse soluta.', 'Sint omnis.', 'esse-soluta', '2011-02-03 00:16:39', 'https://picsum.photos/140/210'),
(165, 110, 'Sunt vero.', 'Debitis pariatur.', 'sunt-vero', '2001-07-02 14:26:47', 'https://picsum.photos/140/210'),
(166, 128, 'Ducimus aut.', 'Praesentium.', 'ducimus-aut', '1974-12-25 19:18:56', 'img-0285-1-2-5eb4147b15cb3.jpeg'),
(167, 129, 'Voluptas.', 'Asperiores est quos.', 'voluptas', '2019-07-12 09:00:36', 'img651-cr-3-5eb413688a667.png'),
(168, 120, 'Title of Book', 'Some Descripiton of book', 'title-of-book', '2020-05-07 14:41:23', '39268-59503-5eb401f38aeec.jpeg');

-- --------------------------------------------------------

--
-- Структура таблицы `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20200505111105', '2020-05-05 11:12:34'),
('20200507064630', '2020-05-07 06:47:05'),
('20200507115752', '2020-05-07 11:58:06');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_BDAFD8C8A9D1C132` (`first_name`),
  ADD UNIQUE KEY `UNIQ_BDAFD8C8DA64C6A8` (`second_name`);

--
-- Индексы таблицы `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `author`
--
ALTER TABLE `author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT для таблицы `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
