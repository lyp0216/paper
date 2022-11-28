-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-10-27 13:34:42
-- 伺服器版本： 10.4.22-MariaDB
-- PHP 版本： 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫: `labweb`
--

-- --------------------------------------------------------

--
-- 資料表結構 `article`
--

CREATE TABLE `article` (
  `articlename` varchar(20) NOT NULL,
  `category` varchar(20) NOT NULL,
  `summary` varchar(100) NOT NULL,
  `comments` varchar(100) NOT NULL,
  `state` varchar(10) NOT NULL,
  `articleID` tinyint(20) NOT NULL,
  `deadline` datetime DEFAULT NULL,
  `userId` char(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `article`
--

INSERT INTO `article` (`articlename`, `category`, `summary`, `comments`, `state`, `articleID`, `deadline`, `userId`) VALUES
('測試文章1', '測試', '無摘要', '', '審稿中', 1, '2022-10-20 00:00:00', '12345678'),
('測試文章2', '測試', '無', '', '分派中', 2, '2022-10-20 22:00:00', '12345678'),
('測試文章3', '測試', '無', '', '尚未分派', 3, '2022-10-20 22:00:00', '12345678'),
('測試文章4', '測試', '無摘要', '', '審稿中', 4, '2022-10-20 22:00:00', '12345678'),
('測試文章5', '測試', '無', '', '尚未分派', 5, '2022-10-20 22:00:00', '12345678'),
('test6', 'test', 'test summary', 'test comments', '已審稿', 6, '2022-10-23 10:55:49', '12345678');

-- --------------------------------------------------------

--
-- 資料表結構 `assigning`
--

CREATE TABLE `assigning` (
  `articleID` tinyint(20) NOT NULL,
  `value` char(10) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `reply` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `assigning`
--

INSERT INTO `assigning` (`articleID`, `value`, `mail`, `reply`) VALUES
(1, 'csd2ZJ2SCQ', 'chen0081110921@gmail.com', 'agree'),
(1, 'FNmJsfhZb9', 'chen885186@gmail.com', 'reject'),
(2, 'bgTbXfjS4m', 'chen885186@gmail.com', 'unreply'),
(3, 'mh5OPza9Qk', 'chen885186@gmail.com', 'reject'),
(4, 'bvpVVtZPpS', 'chen885186@gmail.com', 'agree');

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `id` varchar(50) NOT NULL,
  `pwd` char(10) NOT NULL,
  `name` varchar(10) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `identity` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `user`
--

INSERT INTO `user` (`id`, `pwd`, `name`, `mail`, `identity`) VALUES
('12345678', '1234567890', 'tester', 'test@mail.com', 'user'),
('chen0081110921', 'Cah0cBGoFK', '', 'chen0081110921@gmail.com', 'reviewer'),
('chen885186', 'dVOa8IEeWt', '', 'chen885186@gmail.com', 'reviewer');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`articleID`),
  ADD KEY `userId` (`userId`);

--
-- 資料表索引 `assigning`
--
ALTER TABLE `assigning`
  ADD PRIMARY KEY (`articleID`,`value`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
