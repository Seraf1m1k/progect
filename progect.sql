-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3666
-- Время создания: Апр 25 2025 г., 17:20
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `progect`
--

-- --------------------------------------------------------

--
-- Структура таблицы `basket`
--

CREATE TABLE `basket` (
  `id` int NOT NULL,
  `basketUserID` int NOT NULL,
  `basketProductID` int NOT NULL,
  `countProduct` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`, `img`) VALUES
(1, 'Обувь', 'https://i.pinimg.com/736x/0a/9e/e9/0a9ee98bc57b4e317f9590895e1ae4cf.jpg'),
(2, 'Одежда', 'https://i.pinimg.com/736x/0a/9e/e9/0a9ee98bc57b4e317f9590895e1ae4cf.jpg'),
(3, 'Электроника', 'https://i.pinimg.com/736x/0a/9e/e9/0a9ee98bc57b4e317f9590895e1ae4cf.jpg'),
(4, 'Игрушки', 'https://i.pinimg.com/736x/0a/9e/e9/0a9ee98bc57b4e317f9590895e1ae4cf.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `favourites`
--

CREATE TABLE `favourites` (
  `id` int NOT NULL,
  `favouritesUserID` int NOT NULL,
  `favouritesProductID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `dateStart` datetime NOT NULL,
  `dateEnd` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `price` int NOT NULL,
  `ordersUserID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `dateStart`, `dateEnd`, `status`, `price`, `ordersUserID`) VALUES
(1, '2025-04-25 16:49:26', '2025-04-26', 'Доставлен', 1000, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `nameProduct` varchar(255) NOT NULL,
  `priceProduct` int NOT NULL,
  `categoryProductID` int NOT NULL,
  `descriptionProduct` text,
  `descriptionProduct2` text,
  `imageProduct` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `nameProduct`, `priceProduct`, `categoryProductID`, `descriptionProduct`, `descriptionProduct2`, `imageProduct`) VALUES
(5, 'Название 1', 1000, 3, 'Описание', 'Хар-ки', 'https://i.pinimg.com/736x/88/2a/bb/882abb64ad91a07510188b8686b40058.jpg'),
(6, 'Название 12222222', 1000, 1, 'Описание', 'Хар-ки', 'https://i.pinimg.com/736x/88/2a/bb/882abb64ad91a07510188b8686b40058.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` int NOT NULL,
  `reviewsProductID` int NOT NULL,
  `reviewsUserID` int NOT NULL,
  `reviewsText` text NOT NULL,
  `reviewsStars` int NOT NULL,
  `reviewsDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `reviewsProductID`, `reviewsUserID`, `reviewsText`, `reviewsStars`, `reviewsDate`) VALUES
(1, 5, 3, 'Текст комента', 5, '2025-04-08 00:00:00'),
(2, 5, 3, '222', 5, '2025-04-23 00:00:00'),
(3, 5, 1, '22', 5, '2025-04-23 00:00:00'),
(4, 5, 1, '22', 1, '2025-04-23 00:00:00'),
(5, 5, 1, 'Сосаь', 4, '2025-04-23 00:00:00'),
(6, 5, 1, '123!', 3, '2025-04-23 16:41:42'),
(7, 5, 1, '23!', 4, '2025-04-23 16:44:49'),
(8, 5, 1, '23!', 4, '2025-04-23 16:44:49'),
(9, 5, 1, '23', 0, '2025-04-23 16:45:28'),
(10, 5, 1, '235455!', 0, '2025-04-23 16:45:35'),
(11, 6, 1, 'ТЕст1', 4, '2025-04-25 16:29:28'),
(12, 6, 1, '12', 2, '2025-04-25 16:30:37'),
(13, 6, 1, '12', 4, '2025-04-25 16:31:29'),
(14, 6, 1, '1212', 5, '2025-04-25 16:32:07');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `admin` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `phone_number`, `name`, `address`, `admin`) VALUES
(1, 'admin@admin.ru', '123', '12345', 'admin', '12321', '1'),
(3, 'sdsddssd', 'dssddssdsdsd', NULL, 'dssdsddssd', 'sddssdsdsd', '0');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `basketProductID` (`basketProductID`),
  ADD KEY `basketUserID` (`basketUserID`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favouritesProductID` (`favouritesProductID`),
  ADD KEY `favouritesUserID` (`favouritesUserID`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ordersUserID` (`ordersUserID`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoryProductID` (`categoryProductID`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviewsUserID` (`reviewsUserID`),
  ADD KEY `reviewsProductID` (`reviewsProductID`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `basket`
--
ALTER TABLE `basket`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `favourites`
--
ALTER TABLE `favourites`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `basket`
--
ALTER TABLE `basket`
  ADD CONSTRAINT `basket_ibfk_1` FOREIGN KEY (`basketProductID`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `basket_ibfk_2` FOREIGN KEY (`basketUserID`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `favourites`
--
ALTER TABLE `favourites`
  ADD CONSTRAINT `favourites_ibfk_1` FOREIGN KEY (`favouritesProductID`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `favourites_ibfk_2` FOREIGN KEY (`favouritesUserID`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`ordersUserID`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`categoryProductID`) REFERENCES `category` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`reviewsUserID`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`reviewsProductID`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
