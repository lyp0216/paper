-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-10-29 08:51:36
-- 伺服器版本： 10.4.20-MariaDB
-- PHP 版本： 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫: `reviewer`
--

-- --------------------------------------------------------

--
-- 資料表結構 `conductpage`
--

CREATE TABLE `conductpage` (
  `id` varchar(20) NOT NULL,
  `articlename` varchar(30) NOT NULL,
  `invitationdate` date NOT NULL,
  `deadline` date NOT NULL,
  `state` varchar(30) NOT NULL,
  `contributorname` varchar(30) NOT NULL,
  `category` varchar(50) NOT NULL,
  `summary` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `conductpage`
--

INSERT INTO `conductpage` (`id`, `articlename`, `invitationdate`, `deadline`, `state`, `contributorname`, `category`, `summary`) VALUES
('1', '測試', '2022-10-28', '2022-10-28', '待評閱', '測試員', '測試', '測試'),
('2', '測試', '2022-10-28', '2022-10-28', '待評閱', '測試員', '測試', '測試'),
('3', '測試', '2022-10-28', '2022-10-28', '待評閱', '測試員', '測試', '測試');

-- --------------------------------------------------------

--
-- 資料表結構 `finishpage`
--

CREATE TABLE `finishpage` (
  `id` int(20) NOT NULL,
  `articlename` varchar(30) NOT NULL,
  `invitationdate` date NOT NULL,
  `deadline` date NOT NULL,
  `state` varchar(30) NOT NULL,
  `contributorname` varchar(30) NOT NULL,
  `category` varchar(50) NOT NULL,
  `summary` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `finishpage`
--

INSERT INTO `finishpage` (`id`, `articlename`, `invitationdate`, `deadline`, `state`, `contributorname`, `category`, `summary`) VALUES
(1, '測試', '2022-10-28', '2022-10-28', '待評閱', '測試員', '測試', '測試'),
(2, '測試', '2022-10-28', '2022-10-28', '待評閱', '測試員', '測試', '測試'),
(3, '測試', '2022-10-28', '2022-10-28', '待評閱', '測試員', '測試', '測試');

-- --------------------------------------------------------

--
-- 資料表結構 `revisepage`
--

CREATE TABLE `revisepage` (
  `id` varchar(20) NOT NULL,
  `articlename` varchar(30) NOT NULL,
  `invitationdate` date NOT NULL,
  `deadline` date NOT NULL,
  `state` varchar(30) NOT NULL,
  `contributorname` varchar(30) NOT NULL,
  `category` varchar(50) NOT NULL,
  `summary` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `revisepage`
--

INSERT INTO `revisepage` (`id`, `articlename`, `invitationdate`, `deadline`, `state`, `contributorname`, `category`, `summary`) VALUES
('1', '測試', '2022-10-28', '2022-10-28', '待評閱', '測試員', '測試', '測試'),
('2', '測試', '2022-10-28', '2022-10-28', '待評閱', '測試員', '測試', '測試'),
('3', '測試', '2022-10-28', '2022-10-28', '待評閱', '測試員', '測試', '測試');

-- --------------------------------------------------------

--
-- 資料表結構 `selection`
--

CREATE TABLE `selection` (
  `id` varchar(20) NOT NULL,
  `稿件評論狀態` varchar(50) NOT NULL,
  `是否符合主題？` varchar(50) NOT NULL,
  `論文是否具有參考價值` varchar(50) NOT NULL,
  `論文長度` varchar(50) NOT NULL,
  `論文內容的質量` varchar(50) NOT NULL,
  `實驗評估` varchar(50) NOT NULL,
  `技術正確性` varchar(50) NOT NULL,
  `論文獨創性` varchar(50) NOT NULL,
  `論文的完整度` varchar(50) NOT NULL,
  `論文插圖質量` varchar(50) NOT NULL,
  `參考文獻的充分性` varchar(50) NOT NULL,
  `評論結果` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `waitpage`
--

CREATE TABLE `waitpage` (
  `id` varchar(20) NOT NULL,
  `articlename` varchar(30) NOT NULL,
  `invitationdate` date NOT NULL,
  `deadline` date NOT NULL,
  `state` varchar(50) NOT NULL,
  `contributorname` varchar(20) NOT NULL,
  `category` varchar(20) NOT NULL,
  `summary` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `waitpage`
--

INSERT INTO `waitpage` (`id`, `articlename`, `invitationdate`, `deadline`, `state`, `contributorname`, `category`, `summary`) VALUES
('1', '測試', '2022-10-28', '2022-10-28', '待評閱', '測試員', '測試', '測試'),
('2', '測試', '2022-10-28', '2022-10-28', '待評閱', '測試員', '測試', '測試'),
('3', '測試', '2022-10-28', '2022-10-28', '待評閱', '測試員', '測試', '測試');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `conductpage`
--
ALTER TABLE `conductpage`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `finishpage`
--
ALTER TABLE `finishpage`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `revisepage`
--
ALTER TABLE `revisepage`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `selection`
--
ALTER TABLE `selection`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `waitpage`
--
ALTER TABLE `waitpage`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
