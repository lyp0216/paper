-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022 年 10 月 31 日 09:26
-- 伺服器版本： 10.4.24-MariaDB
-- PHP 版本： 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `topic`
--

-- --------------------------------------------------------

--
-- 資料表結構 `article`
--

CREATE TABLE `article` (
  `id` varchar(100) NOT NULL,
  `articleID` tinyint(100) NOT NULL,
  `writer` varchar(100) NOT NULL,
  `abstract` varchar(100) NOT NULL,
  `filee` longblob NOT NULL,
  `articlename` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `comments` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `invitationdate` varchar(100) NOT NULL,
  `deadline` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `assigning`
--

CREATE TABLE `assigning` (
  `articleID` tinyint(100) NOT NULL,
  `value` varchar(100) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `reply` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `selection`
--

CREATE TABLE `selection` (
  `articleID` tinyint(100) NOT NULL,
  `稿件評論狀態` varchar(100) NOT NULL,
  `是否符合主題？` varchar(100) NOT NULL,
  `論文是否具有參考價值` varchar(100) NOT NULL,
  `論文長度` varchar(100) NOT NULL,
  `論文內容的質量` varchar(100) NOT NULL,
  `實驗評估` varchar(100) NOT NULL,
  `技術正確性` varchar(100) NOT NULL,
  `論文獨創性` varchar(100) NOT NULL,
  `論文的完整度` varchar(100) NOT NULL,
  `論文插圖質量` varchar(100) NOT NULL,
  `參考文獻的充分性` varchar(100) NOT NULL,
  `評論結果` varchar(100) NOT NULL,
  `userid` tinyint(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `id` tinyint(100) NOT NULL,
  `pwd` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `tel` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`articleID`);

--
-- 資料表索引 `assigning`
--
ALTER TABLE `assigning`
  ADD PRIMARY KEY (`articleID`);

--
-- 資料表索引 `selection`
--
ALTER TABLE `selection`
  ADD PRIMARY KEY (`articleID`),
  ADD KEY `userid` (`userid`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `article`
--
ALTER TABLE `article`
  MODIFY `articleID` tinyint(100) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
