-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 15 2020 г., 10:25
-- Версия сервера: 5.6.43
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `forumdb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `uuid` int(11) NOT NULL,
  `material` int(11) NOT NULL,
  `module` int(11) NOT NULL,
  `added` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `activecom` int(11) NOT NULL,
  `himm` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datehim` datetime NOT NULL,
  `texthim` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `uuid`, `material`, `module`, `added`, `text`, `date`, `activecom`, `himm`, `datehim`, `texthim`) VALUES
(64, 0, 1, 1, 'AmidX', 'Привіт усім!!!', '2019-11-11 02:32:09', 0, '', '0000-00-00 00:00:00', ''),
(65, 0, 1, 1, 'AmidX', 'dr', '2019-11-11 02:50:59', 0, '', '0000-00-00 00:00:00', ''),
(66, 0, 1, 1, 'AmidX', 'Здоров!!!', '2019-11-11 02:51:27', 0, '', '0000-00-00 00:00:00', ''),
(68, 0, 1, 1, 'AmidX', 'Неа', '2019-11-11 02:55:23', 0, '', '0000-00-00 00:00:00', ''),
(70, 0, 1, 1, 'AmidX', 'dd66777666', '2019-11-11 03:08:47', 0, '', '0000-00-00 00:00:00', ''),
(75, 0, 1, 1, 'AmidX', 'Я не розумію', '2019-11-11 03:50:06', 0, '', '0000-00-00 00:00:00', ''),
(83, 0, 1, 2, 'AmidX', 'Привіт', '2019-11-11 04:28:37', 0, '0', '0000-00-00 00:00:00', '0'),
(84, 83, 1, 2, 'AmidX', 'Це я відповів', '2019-11-11 04:28:51', 1, 'AmidX', '2019-11-11 04:28:37', 'Привіт'),
(85, 72, 1, 1, 'NoobMaster', 'Топ2456', '2019-11-11 04:31:05', 1, 'AmidX', '2019-11-11 03:20:27', 'Кекк'),
(86, 75, 1, 1, 'AmidX', 'Хай', '2019-11-11 08:15:40', 1, 'AmidX', '2019-11-11 03:50:06', ''),
(87, 83, 1, 2, 'NoobMaster', 'Ghbdsn', '2019-11-11 08:38:03', 1, 'AmidX', '2019-11-11 04:28:37', 'Привіт'),
(88, 0, 1, 1, 'NoobMaster', 'rtr', '2019-11-11 13:02:15', 0, '0', '0000-00-00 00:00:00', '0'),
(89, 88, 1, 1, 'NoobMaster', 'Я', '2019-11-11 13:02:25', 1, 'NoobMaster', '2019-11-11 13:02:15', 'rtr'),
(90, 89, 1, 1, 'NoobMaster', 'Привіт!', '2019-11-11 15:56:06', 1, 'NoobMaster', '2019-11-11 13:02:25', 'Я');

-- --------------------------------------------------------

--
-- Структура таблицы `dialog`
--

CREATE TABLE `dialog` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `send` int(11) NOT NULL,
  `recive` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `dialog`
--

INSERT INTO `dialog` (`id`, `status`, `send`, `recive`) VALUES
(1, 1, 2, 1),
(2, 0, 3, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `forum`
--

CREATE TABLE `forum` (
  `id` int(11) NOT NULL,
  `name` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `cat` int(11) NOT NULL,
  `read` int(11) NOT NULL,
  `added` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `idforum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `forum`
--

INSERT INTO `forum` (`id`, `name`, `cat`, `read`, `added`, `text`, `date`, `active`, `idforum`) VALUES
(1, 'Про відеомонтаж та відеозйомки', 1, 1240, 'FangFoom', '   В мене виникла проблема - після скачування фільму з платного сайту, записавши в DVD форматі ДВДюк скот пише, що не може прочитати. На телевізорі про коди пише. Поможіть будь-ласка, в мене просто нема дійсно часу шукати в Інтернеті, чесно, приїду поставлю магар. марка Sony DVP-NS 575P', '2019-11-08 08:14:47', 1, 1),
(2, 'Програма iMovie', 2, 5, 'NoobMaster', 'Підкажіть а де і хто може навчити працювати в програмах iMovie і далі в Final Cut Pro, може де студенти тусуються, молоді та початківці, шукаю синові в команду на канал YouTube<br>\r\nЄ проект - створення ігрової кімнати геймера з нуля, написаний перший сценарій, але що то не йде маза :-D Зняти і змонтувати все є, а ось часу сидіти монтувати немає :-) Так що хелп ми або ласкаво просимо до нашого куреня: hi :<br>\r\nps .: сильно не сваріть якщо я &quot;з ногами заліз нема на той стіл&quot;))', '2019-11-11 14:41:28', 1, 3),
(3, 'Робота у Sony Vegas', 2, 2, 'AmidX', 'професійний відеоредактор для нелінійного монтажу (NLE), що спочатку виходив під ліцензією компанії Sonic Foundry, пізніше Sony, а на сьогодні права належать Magix.<br>\r\n<br>\r\nВід початку програма була розроблена як аудіоредактор, але згодом, з версії 2.0, перетворилася на відео-аудіоредактор для нелінійного монтажу. Особливостями програми Vegas є: підтримка багатодоріжкового відео і аудіо редагування в режимі реального часу, необмежена кількість доріжок, можливість використання різних за роздільною здатністю відеопослідовностей (секвенцій), інструменти для складних ефектів і композитинга, підтримка 24-біт / 192 кГц звуку і технологій VST та DirectX для плаґінів, а також мікшування звуку в режимі Dolby Digital Surround. До 10 версії Vegas Pro працював під управлінням Windows 7, Windows 8 і Windows 10. З 11 версії припинена підтримка Windows XP, а починаючи з 12 версії  програма виходить лише для 64-бітних ОС. З 13 версії  припинено підтримку Windows Vista. 24 травня 2016 року компанія Sony оголосила про продаж Вегас (і великої частину своєї лінії «Creative Software») холдинговій компанії MAGIX, яка буде продовжувати надавати підтримку і розробку даного програмного забезпечення.', '2019-11-11 15:12:22', 1, 2),
(4, 'Про adobe premiere pro', 3, 4, 'Lycoris', 'Adobe Premiere Pro — професійна програма нелінійного відеомонтажу компанії Adobe Systems. Нащадок програми Adobe Premiere (остання версія 6.5). Першу версію програми («Adobe Premiere» 7) презентували 21 серпня 2003 року для систем на основі ОС Windows. Вже у третій версії програма стала доступною і для операційних систем Mac OS X. Перші дві версії випустили окремими продуктами, лише третю у складі пакету Adobe Creative Suite 3. П&#039;ята версія, яка є складовою пакету Adobe Creative Suite 5, підтримує лише 64-бітні операційні системи, хоча четверта також підтримувала і 32-бітні.', '2019-11-11 15:23:07', 1, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `loads`
--

CREATE TABLE `loads` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `cat` int(11) NOT NULL,
  `read` int(11) NOT NULL,
  `download` int(11) NOT NULL,
  `added` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `active` int(11) NOT NULL,
  `dimg` int(11) NOT NULL,
  `dfile` int(11) NOT NULL,
  `dvideo` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `rateusers` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `iduser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `loads`
--

INSERT INTO `loads` (`id`, `name`, `cat`, `read`, `download`, `added`, `text`, `date`, `active`, `dimg`, `dfile`, `dvideo`, `rate`, `rateusers`, `iduser`) VALUES
(1, 'Робота студентів П-418', 1, 24, 0, 'FangFoom', 'Сага нескінченності', '2019-11-08 12:25:19', 1, 1, 1, 1, 1, ',2', 1),
(2, 'Месники', 1, 44, 0, 'AmidX', 'Даний проект був змонтований на програмі iMovie', '2019-11-08 12:28:54', 1, 1, 1, 1, 1, ',3', 2),
(3, 'Пригоди', 1, 13, 0, 'Lycoris', '7 листопада в актовій залі БКПЕП зібралися студенти та викладачі спеціальностей економічного напрямку, щоб в наполегливій конкурсній боротьбі визначити кращого студента в майбутній професії бухгалтера, фінансиста та економіста.', '2019-11-11 15:21:49', 1, 1, 1, 1, 0, '', 4),
(4, 'Природа', 1, 7, 0, 'Libovsky', 'апавпвіпвіпвіп', '2019-11-11 16:00:14', 1, 1, 1, 1, 1, ',5', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `did` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `message`
--

INSERT INTO `message` (`id`, `did`, `user`, `text`, `date`) VALUES
(1, 1, 1, 'Привіт!', '2019-11-08 18:38:19'),
(2, 1, 2, 'Привіт =/', '2019-11-08 18:41:45'),
(3, 2, 2, 'Привіт! До тебе звертається адміністратор!', '2019-11-10 23:27:11'),
(4, 2, 3, 'Доброго дня', '2019-11-11 07:39:21'),
(5, 2, 3, 'ВК', '2019-11-11 09:35:01'),
(6, 2, 3, 'Привіт', '2019-11-11 09:36:42'),
(7, 2, 3, 'Подай мені!!!!!!', '2019-11-11 10:26:56'),
(8, 2, 3, 'ііккк', '2019-11-11 10:28:34'),
(9, 2, 3, 'gg', '2019-11-11 10:30:58'),
(10, 2, 3, 'gfdddg', '2019-11-12 12:26:10'),
(11, 2, 3, 'Ти тут ?', '2019-11-13 01:33:06');

-- --------------------------------------------------------

--
-- Структура таблицы `notice`
--

CREATE TABLE `notice` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `notice`
--

INSERT INTO `notice` (`id`, `uid`, `status`, `date`, `text`) VALUES
(1, 5, 0, '2019-11-11 14:11:59', 'Привіт');

-- --------------------------------------------------------

--
-- Структура таблицы `ucomments`
--

CREATE TABLE `ucomments` (
  `id_uc` int(11) NOT NULL,
  `uidd` int(11) NOT NULL,
  `him` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dateu` datetime NOT NULL,
  `textu` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(10) NOT NULL,
  `regdate` datetime NOT NULL,
  `email` varchar(50) NOT NULL,
  `country` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `group` int(11) NOT NULL,
  `avatar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `name`, `regdate`, `email`, `country`, `active`, `group`, `avatar`) VALUES
(1, 'FangFoom', 'a128b2ebacf0d2825877755c10803176', 'Iхорка', '2019-10-28 01:35:59', 'floranskiyamid@gmail.com', 0, 1, 0, 0),
(2, 'AmidX', '84fcf4a7671e042681a2f1813c1a0d7b', 'Діма', '2019-11-08 12:21:50', 'balamutdmitro0@gmail.com', 0, 1, 2, 1),
(3, 'NoobMaster', '1c45868615b07c9061cfc1b6fdefd845', 'Олексій', '2019-11-08 12:54:11', '', 0, 1, 1, 1),
(4, 'Lycoris', 'ee22e178ad0ceca2e153a2cd76c71766', 'Julia', '2019-11-10 00:53:12', 'balamutdmitro0@gmail.com', 0, 1, 0, 0),
(5, 'Libovsky', '1dad1bb605a487fed9e233c47c419b47', 'Валік', '2019-11-10 01:47:01', 'balamutdmitro0@gmail.com', 0, 1, 0, 0),
(6, 'Cap', '1dccfd91de47e8420053782022c68185', 'Влад', '2019-11-10 02:17:15', 'balamutdmitro0@gmail.com', 0, 1, -1, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `dialog`
--
ALTER TABLE `dialog`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idforum` (`idforum`);

--
-- Индексы таблицы `loads`
--
ALTER TABLE `loads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iduser` (`iduser`);

--
-- Индексы таблицы `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `did` (`did`);

--
-- Индексы таблицы `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`),
  ADD KEY `uid` (`uid`);

--
-- Индексы таблицы `ucomments`
--
ALTER TABLE `ucomments`
  ADD PRIMARY KEY (`id_uc`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT для таблицы `dialog`
--
ALTER TABLE `dialog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `forum`
--
ALTER TABLE `forum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `loads`
--
ALTER TABLE `loads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `notice`
--
ALTER TABLE `notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `ucomments`
--
ALTER TABLE `ucomments`
  MODIFY `id_uc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `forum`
--
ALTER TABLE `forum`
  ADD CONSTRAINT `forum_ibfk_1` FOREIGN KEY (`idforum`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `loads`
--
ALTER TABLE `loads`
  ADD CONSTRAINT `loads_ibfk_1` FOREIGN KEY (`iduser`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`did`) REFERENCES `dialog` (`id`);

--
-- Ограничения внешнего ключа таблицы `notice`
--
ALTER TABLE `notice`
  ADD CONSTRAINT `notice_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
