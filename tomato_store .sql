-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2021-03-26 10:51:26
-- サーバのバージョン： 10.4.17-MariaDB
-- PHP のバージョン: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `tomato_store`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'U'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `accounts`
--

INSERT INTO `accounts` (`account_id`, `username`, `password`, `status`) VALUES
(1, 'test', '$2y$10$wid3IoIohtVwk7jsIzk5eOGdQj1BUL7snN2n8HpMIPP0/t6Q1Kz3a', 'U'),
(2, 'test1', '$2y$10$3rBUsYea9horYkkpK7b4P.YeNQWP031gXNGHufn7YjsWpjNV9RrKK', 'A'),
(3, 'test0', '$2y$10$SODukSk3aqriyRtM9WppZ.ih1m7fxMJz2t8lJKPcvDq3bEvuV.juy', 'U'),
(4, 'test4', '$2y$10$4n2zAQ/qOc5xSTAWhZryIuO5hSuk7TgNeTkYvJXxCkbkZu6.drI02', 'U');

-- --------------------------------------------------------

--
-- テーブルの構造 `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `buy_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `item_id`, `buy_quantity`) VALUES
(4, 1, 1, 1),
(5, 1, 1, 2);

-- --------------------------------------------------------

--
-- テーブルの構造 `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(20) NOT NULL,
  `item_price` int(11) NOT NULL,
  `item_stocks` int(11) NOT NULL,
  `item_picture` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `item_price`, `item_stocks`, `item_picture`) VALUES
(1, 'ダイニングチェア「ロビン」', 30000, 92, 'room1-chair.png'),
(2, 'ソファ「ポーター」', 150000, 50, 'room1-sofa1.jpg'),
(3, 'ダイニングテーブル「ロビン」', 178000, 98, 'room1-desk.png'),
(4, 'ダイニングテーブル「シネマ３」', 48800, 97, 'room2-desk.jpg'),
(5, 'ソファ「CAS-D」', 99000, 55, 'room2-sofa.jpg'),
(6, 'サイドボード「フィル」', 159000, 60, 'room2-tana.png'),
(7, 'ベッドフレーム「アルディ」', 40500, 30, 'room3-bed.png'),
(8, 'ダイニングチェア「ライヴ」', 10100, 100, 'room3-chair.png'),
(9, 'デスク「ロダン」', 96900, 100, 'room3-desk.png'),
(10, 'シェルフ「アクト」', 74800, 50, 'room3-tana.png'),
(11, '昇降式テーブル「フィットAタイプ（五角形', 76100, 80, 'room4-desk.png'),
(12, 'コーナーソファ「アレッタ２」', 290000, 73, 'room4-sofa.jpg');

-- --------------------------------------------------------

--
-- テーブルの構造 `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `buy_quantity` int(11) NOT NULL,
  `date_orderd` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `item_id`, `buy_quantity`, `date_orderd`) VALUES
(24, 1, 1, 2, '2021-03-26 17:21:56'),
(25, 1, 1, 2, '2021-03-26 17:47:23'),
(26, 1, 1, 2, '2021-03-26 17:53:20'),
(27, 1, 1, 2, '2021-03-26 17:53:58'),
(28, 1, 4, 3, '2021-03-26 17:54:11'),
(29, 4, 1, 3, '2021-03-26 18:24:37'),
(30, 1, 3, 2, '2021-03-26 18:25:14');

-- --------------------------------------------------------

--
-- テーブルの構造 `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `payment_method` varchar(10) NOT NULL,
  `payment` int(11) NOT NULL,
  `changes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `user_id`, `order_id`, `total_price`, `payment_method`, `payment`, `changes`) VALUES
(1, 1, 24, 60000, 'card', 0, 0),
(2, 1, 25, 60000, 'card', 0, 0),
(3, 1, 26, 60000, 'card', 0, 0),
(4, 1, 27, 60000, 'card', 0, 0),
(5, 4, 29, 90000, 'card', 0, 0),
(6, 1, 30, 356000, 'card', 0, 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `address` varchar(50) NOT NULL,
  `email` varchar(20) NOT NULL,
  `account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `address`, `email`, `account_id`) VALUES
(1, 'test', 'test', 'test', 'test@text.com', 1),
(2, 'test1', 'test1', 'test1', 'test1@email.com', 2),
(3, 'test0', 'test0', 'test0', 'test1@email.com', 3),
(4, 'test4', 'test4', 'test4', 'test4@email.com', 4);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`);

--
-- テーブルのインデックス `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- テーブルのインデックス `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- テーブルのインデックス `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- テーブルのインデックス `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `order_id` (`order_id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- テーブルの AUTO_INCREMENT `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- テーブルの AUTO_INCREMENT `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- テーブルの AUTO_INCREMENT `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- テーブルの AUTO_INCREMENT `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
