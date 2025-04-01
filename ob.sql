-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Мар 03 2019 г., 07:46
-- Версия сервера: 5.7.22-0ubuntu18.04.1
-- Версия PHP: 7.2.5-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `s102`
--

-- --------------------------------------------------------

--
-- Структура таблицы `accessdoc`
--

CREATE TABLE `accessdoc` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'ID записи',
  `roles` int(11) NOT NULL COMMENT 'Роль',
  `doc` int(11) NOT NULL COMMENT 'Документ',
  `read` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'чтение',
  `edit` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Редактирование',
  `delete` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Удаление'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `accessdoc`
--

INSERT INTO `accessdoc` (`id`, `roles`, `doc`, `read`, `edit`, `delete`) VALUES
(1, 1, 1, '1', '1', '1'),
(2, 1, 2, '1', '1', '1'),
(3, 1, 3, '1', '1', '1'),
(4, 1, 4, '1', '1', '1'),
(5, 1, 5, '1', '1', '1'),
(6, 1, 6, '1', '1', '1'),
(7, 1, 7, '1', '1', '1'),
(8, 1, 8, '1', '1', '1'),
(9, 2, 1, '1', '1', '0'),
(10, 2, 2, '1', '1', '0'),
(11, 2, 3, '1', '1', '0'),
(12, 2, 4, '1', '1', '0'),
(13, 2, 5, '1', '1', '0'),
(14, 2, 6, '1', '1', '0'),
(15, 2, 7, '1', '1', '0'),
(16, 2, 8, '1', '1', '0'),
(17, 3, 1, '1', '0', '0'),
(18, 3, 2, '1', '0', '0'),
(19, 3, 3, '1', '0', '0'),
(20, 3, 4, '1', '0', '0'),
(21, 3, 5, '1', '0', '0'),
(22, 3, 6, '1', '0', '0'),
(23, 3, 7, '1', '0', '0'),
(24, 3, 8, '1', '0', '0'),
(25, 4, 1, '1', '0', '0'),
(26, 4, 2, '1', '0', '0'),
(27, 4, 3, '1', '0', '0'),
(28, 4, 4, '1', '0', '0'),
(29, 4, 5, '1', '0', '0'),
(30, 4, 6, '1', '0', '0'),
(31, 4, 7, '1', '0', '0'),
(32, 4, 8, '1', '0', '0'),
(33, 5, 1, '1', '0', '0'),
(34, 5, 2, '1', '0', '0'),
(35, 5, 3, '1', '0', '0'),
(36, 5, 4, '1', '0', '0'),
(37, 5, 5, '1', '0', '0'),
(38, 5, 6, '1', '0', '0'),
(39, 5, 7, '1', '0', '0'),
(40, 5, 8, '1', '0', '0');

-- --------------------------------------------------------

--
-- Структура таблицы `addresses`
--

CREATE TABLE `addresses` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'ID адресса',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Название адресса'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `addresses`
--

INSERT INTO `addresses` (`id`, `name`) VALUES
(1, 'Не указан!');

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

CREATE TABLE `groups` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'ID товра',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Название группы'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`id`, `name`) VALUES
(1, '!Группа не заданна!');

-- --------------------------------------------------------

--
-- Структура таблицы `hiedits`
--

CREATE TABLE `hiedits` (
  `historys` int(10) UNSIGNED DEFAULT NULL COMMENT 'ID записи',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'название поля',
  `old` text COLLATE utf8mb4_unicode_ci COMMENT 'Было значение',
  `new` text COLLATE utf8mb4_unicode_ci COMMENT 'стало'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `historys`
--

CREATE TABLE `historys` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'ID записи',
  `id_doc` int(11) NOT NULL COMMENT 'ID документа',
  `typedoc` int(10) UNSIGNED NOT NULL COMMENT 'Тип документа',
  `typeedit` int(10) UNSIGNED NOT NULL COMMENT 'Вид правки',
  `user` int(11) NOT NULL COMMENT 'ID Пользователя',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Время правки документа'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `inventorys`
--

CREATE TABLE `inventorys` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'ID инвентаризационный номер',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Название инвентарной еденици',
  `text` text COLLATE utf8mb4_unicode_ci COMMENT 'Описание инвентаря',
  `peoples` int(10) UNSIGNED NOT NULL COMMENT 'ID сотрудника',
  `groups` int(10) UNSIGNED NOT NULL COMMENT 'ID группы',
  `points` int(10) UNSIGNED NOT NULL COMMENT 'ID места',
  `state` int(10) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'ID состояния',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `mailwork`
--

CREATE TABLE `mailwork` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'ID статуса',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Название ящика',
  `pass` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Пароль'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `mailwork`
--

INSERT INTO `mailwork` (`id`, `name`, `pass`) VALUES
(1, 'Нет!', ''),
(2, 'admin@OfficeBook.com', 'pass'),
(3, 'info@OfficeBook.com', 'pass');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2017_05_02_000001_create_office_table', 1),
(2, '2017_06_16_000002_create_users_roles_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `peoples`
--

CREATE TABLE `peoples` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'ID сотрудника',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Имя сотрудника',
  `surname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Фамилия сотрудника',
  `status` int(10) UNSIGNED NOT NULL COMMENT 'Статус сотрудника',
  `position` int(10) UNSIGNED NOT NULL COMMENT 'ID должности',
  `addresses` int(10) UNSIGNED NOT NULL COMMENT 'ID адресса',
  `mailwork` int(10) UNSIGNED NOT NULL COMMENT 'ID рабочей почты',
  `mailpersonal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Личная полчта',
  `telwork` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Рабочий телефон',
  `telpersonal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Личный телефон',
  `birthday` date DEFAULT NULL COMMENT 'День рождения',
  `text` text COLLATE utf8mb4_unicode_ci COMMENT 'Дополнительная информация',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `points`
--

CREATE TABLE `points` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'ID места',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Название места'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `points`
--

INSERT INTO `points` (`id`, `name`) VALUES
(1, '!Место не определенно!');

-- --------------------------------------------------------

--
-- Структура таблицы `positions`
--

CREATE TABLE `positions` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'ID должности',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Название должности'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `positions`
--

INSERT INTO `positions` (`id`, `name`) VALUES
(1, '!Не задано!');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Root'),
(2, 'Системный администратор'),
(3, 'Кадровик'),
(4, 'Бухгалтер'),
(5, 'Кладовщик');

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'ID записи',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Название',
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Данные'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `name`, `data`) VALUES
(1, 'Включить доступ по выбрвным IP, 0 - открыто всем!', '0'),
(2, 'Название организации', 'ООО OfficeBook'),
(3, 'Описание организации', 'Офисная книга'),
(4, 'E-mail администратора', 'admin@mycompany.com'),
(5, 'Отображать в разделе Office Имущество', '1'),
(6, 'Отображать в разделе Office Контакты', '1'),
(7, 'Отображать в разделе Office Должность', '0'),
(8, 'Отображать в разделе Office Телифон и E-mail рабочий', '0'),
(9, 'Отображать в разделе Office Адресс', '0');

-- --------------------------------------------------------

--
-- Структура таблицы `state`
--

CREATE TABLE `state` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'ID состояния',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Название состояния'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `state`
--

INSERT INTO `state` (`id`, `name`) VALUES
(1, '!Не используется!'),
(2, 'Используется'),
(3, 'Списан');

-- --------------------------------------------------------

--
-- Структура таблицы `status`
--

CREATE TABLE `status` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'ID статуса',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Название статуса'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'Сотрудники'),
(2, 'Уволены'),
(3, 'Подрядчики');

-- --------------------------------------------------------

--
-- Структура таблицы `typedoc`
--

CREATE TABLE `typedoc` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'ID записи',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Название документа',
  `link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Линк документа'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `typedoc`
--

INSERT INTO `typedoc` (`id`, `name`, `link`) VALUES
(1, 'Пользователи', 'user'),
(2, 'Люди', 'people'),
(3, 'Имущество', 'inventory'),
(4, 'Группы имущества', 'group'),
(5, 'Места хранения', 'point'),
(6, 'Адресса', 'point'),
(7, 'Должности', 'point'),
(8, 'Почта рабочая', 'point');

-- --------------------------------------------------------

--
-- Структура таблицы `typeedit`
--

CREATE TABLE `typeedit` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'ID записи',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Название праки'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `typeedit`
--

INSERT INTO `typeedit` (`id`, `name`) VALUES
(1, 'создан'),
(2, 'внесены правки'),
(3, 'удален'),
(4, 'востановлен');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peoples` int(10) UNSIGNED DEFAULT NULL COMMENT 'ID сотрудника',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apanel` enum('','checked') COLLATE utf8mb4_unicode_ci NOT NULL,
  `history` enum('','checked') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `peoples`, `email`, `password`, `apanel`, `history`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Администратор', NULL, 'admin@mydomen.com', '$2y$10$KnHAyEjNTq95oX6OxJ5XIOK5kyxITsCuBotIDCV0qCHw3QhQUNBPS', 'checked', 'checked', NULL, '2019-02-25 11:37:42', '2019-02-25 11:37:42');

-- --------------------------------------------------------

--
-- Структура таблицы `users_roles`
--

CREATE TABLE `users_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users_roles`
--

INSERT INTO `users_roles` (`id`, `user_id`, `role_id`) VALUES
(1, 1, 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `accessdoc`
--
ALTER TABLE `accessdoc`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `hiedits`
--
ALTER TABLE `hiedits`
  ADD KEY `hiedits_historys_foreign` (`historys`);

--
-- Индексы таблицы `historys`
--
ALTER TABLE `historys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `historys_typedoc_foreign` (`typedoc`),
  ADD KEY `historys_typeedit_foreign` (`typeedit`);

--
-- Индексы таблицы `inventorys`
--
ALTER TABLE `inventorys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventorys_peoples_foreign` (`peoples`),
  ADD KEY `inventorys_groups_foreign` (`groups`),
  ADD KEY `inventorys_points_foreign` (`points`),
  ADD KEY `inventorys_state_foreign` (`state`);

--
-- Индексы таблицы `mailwork`
--
ALTER TABLE `mailwork`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `peoples`
--
ALTER TABLE `peoples`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peoples_status_foreign` (`status`),
  ADD KEY `peoples_position_foreign` (`position`),
  ADD KEY `peoples_addresses_foreign` (`addresses`),
  ADD KEY `peoples_mailwork_foreign` (`mailwork`);

--
-- Индексы таблицы `points`
--
ALTER TABLE `points`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `typedoc`
--
ALTER TABLE `typedoc`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `typeedit`
--
ALTER TABLE `typeedit`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_peoples_foreign` (`peoples`);

--
-- Индексы таблицы `users_roles`
--
ALTER TABLE `users_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_roles_user_id_foreign` (`user_id`),
  ADD KEY `users_roles_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `accessdoc`
--
ALTER TABLE `accessdoc`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID записи', AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT для таблицы `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID адресса', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID товра', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `historys`
--
ALTER TABLE `historys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID записи';

--
-- AUTO_INCREMENT для таблицы `inventorys`
--
ALTER TABLE `inventorys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID инвентаризационный номер';

--
-- AUTO_INCREMENT для таблицы `mailwork`
--
ALTER TABLE `mailwork`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID статуса', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `peoples`
--
ALTER TABLE `peoples`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID сотрудника';

--
-- AUTO_INCREMENT для таблицы `points`
--
ALTER TABLE `points`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID места', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID должности', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID записи', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `state`
--
ALTER TABLE `state`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID состояния', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `status`
--
ALTER TABLE `status`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID статуса', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `typedoc`
--
ALTER TABLE `typedoc`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID записи', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `typeedit`
--
ALTER TABLE `typeedit`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID записи', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `users_roles`
--
ALTER TABLE `users_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `hiedits`
--
ALTER TABLE `hiedits`
  ADD CONSTRAINT `hiedits_historys_foreign` FOREIGN KEY (`historys`) REFERENCES `historys` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `historys`
--
ALTER TABLE `historys`
  ADD CONSTRAINT `historys_typedoc_foreign` FOREIGN KEY (`typedoc`) REFERENCES `typedoc` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `historys_typeedit_foreign` FOREIGN KEY (`typeedit`) REFERENCES `typeedit` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `inventorys`
--
ALTER TABLE `inventorys`
  ADD CONSTRAINT `inventorys_groups_foreign` FOREIGN KEY (`groups`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `inventorys_peoples_foreign` FOREIGN KEY (`peoples`) REFERENCES `peoples` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `inventorys_points_foreign` FOREIGN KEY (`points`) REFERENCES `points` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `inventorys_state_foreign` FOREIGN KEY (`state`) REFERENCES `state` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `peoples`
--
ALTER TABLE `peoples`
  ADD CONSTRAINT `peoples_addresses_foreign` FOREIGN KEY (`addresses`) REFERENCES `addresses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `peoples_mailwork_foreign` FOREIGN KEY (`mailwork`) REFERENCES `mailwork` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `peoples_position_foreign` FOREIGN KEY (`position`) REFERENCES `positions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `peoples_status_foreign` FOREIGN KEY (`status`) REFERENCES `status` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_peoples_foreign` FOREIGN KEY (`peoples`) REFERENCES `peoples` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users_roles`
--
ALTER TABLE `users_roles`
  ADD CONSTRAINT `users_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
