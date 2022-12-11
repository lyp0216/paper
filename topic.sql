-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-12-11 15:08:19
-- 伺服器版本： 10.4.25-MariaDB
-- PHP 版本： 8.1.10

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
  `id` int(100) NOT NULL,
  `articleID` tinyint(100) NOT NULL,
  `writer` varchar(100) NOT NULL,
  `abstract` varchar(100) NOT NULL,
  `fileName` varchar(100) NOT NULL,
  `articlename` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `comments` varchar(100) NOT NULL,
  `state` int(11) NOT NULL,
  `invitationdate` varchar(100) NOT NULL,
  `deadline` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `article`
--

INSERT INTO `article` (`id`, `articleID`, `writer`, `abstract`, `fileName`, `articlename`, `category`, `comments`, `state`, `invitationdate`, `deadline`) VALUES
(1001, 111, 'Wang, Xiao-Ming', 'This is abstract.', '', '深度學習訓練', '教育類', '', 4, '', '2022-12-24 12:00:00');

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

--
-- 傾印資料表的資料 `assigning`
--

INSERT INTO `assigning` (`articleID`, `value`, `mail`, `reply`) VALUES
(111, 'OaJajozlBL', 'chen885186@gmail.com', '1');

-- --------------------------------------------------------

--
-- 資料表結構 `selection`
--

CREATE TABLE `selection` (
  `articleID` tinyint(100) NOT NULL,
  `Manuscript Review Status` varchar(100) DEFAULT NULL,
  `Does it fit the theme?` varchar(100) DEFAULT NULL,
  `Does the paper have reference value` varchar(100) DEFAULT NULL,
  `Essay length` varchar(100) DEFAULT NULL,
  `The quality of the content of the paper` varchar(100) DEFAULT NULL,
  `Experimental evaluation` varchar(100) DEFAULT NULL,
  `technical correctness` varchar(100) DEFAULT NULL,
  `The originality of the paper` varchar(100) DEFAULT NULL,
  `the completeness of the thesis` varchar(100) DEFAULT NULL,
  `Paper illustration quality` varchar(100) DEFAULT NULL,
  `sufficiency of references` varchar(100) DEFAULT NULL,
  `Comment result` varchar(100) DEFAULT NULL,
  `Notes to the author` text DEFAULT NULL,
  `userid` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `selection`
--

INSERT INTO `selection` (`articleID`, `Manuscript Review Status`, `Does it fit the theme?`, `Does the paper have reference value`, `Essay length`, `The quality of the content of the paper`, `Experimental evaluation`, `technical correctness`, `The originality of the paper`, `the completeness of the thesis`, `Paper illustration quality`, `sufficiency of references`, `Comment result`, `Notes to the author`, `userid`) VALUES
(111, '37', '3', '7', '12', '15', '18', '21', '24', '27', '30', '33', '37', '					\r\n', 1001);

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `id` int(100) NOT NULL,
  `pwd` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `tel` varchar(100) NOT NULL,
  `identity` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `user`
--

INSERT INTO `user` (`id`, `pwd`, `name`, `mail`, `tel`, `identity`) VALUES
(1001, 'asd123', 'Wang Xiao Ming', 'chen0081110921@gmail.com', '0912345678', '1'),
(1003, 'R7BW9ijdApzQ', '', 'chen885186@gmail.com', '', '2');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`articleID`),
  ADD KEY `id` (`id`);

--
-- 資料表索引 `assigning`
--
ALTER TABLE `assigning`
  ADD PRIMARY KEY (`articleID`,`value`),
  ADD KEY `articleID` (`articleID`);

--
-- 資料表索引 `selection`
--
ALTER TABLE `selection`
  ADD PRIMARY KEY (`articleID`,`userid`),
  ADD KEY `userid` (`userid`),
  ADD KEY `articleID` (`articleID`);

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
  MODIFY `articleID` tinyint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user`
--
ALTER TABLE `user`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1007;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`id`) REFERENCES `user` (`id`);

--
-- 資料表的限制式 `assigning`
--
ALTER TABLE `assigning`
  ADD CONSTRAINT `assigning_ibfk_1` FOREIGN KEY (`articleID`) REFERENCES `article` (`articleID`);

--
-- 資料表的限制式 `selection`
--
ALTER TABLE `selection`
  ADD CONSTRAINT `selection_ibfk_1` FOREIGN KEY (`articleID`) REFERENCES `article` (`articleID`),
  ADD CONSTRAINT `selection_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
