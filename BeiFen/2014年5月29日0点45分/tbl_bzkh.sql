-- phpMyAdmin SQL Dump
-- version 3.5.4
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 05 月 28 日 16:47
-- 服务器版本: 5.5.31
-- PHP 版本: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `zuoheng`
--

-- --------------------------------------------------------

--
-- 表的结构 `tbl_bzkh`
--

CREATE TABLE IF NOT EXISTS `tbl_bzkh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `waccount` varchar(20) CHARACTER SET utf8 NOT NULL,
  `wapartment` int(11) NOT NULL,
  `raccount` varchar(20) CHARACTER SET utf8 NOT NULL,
  `rapartment` int(11) NOT NULL,
  `year` varchar(20) CHARACTER SET utf8 NOT NULL,
  `month` varchar(20) CHARACTER SET utf8 NOT NULL,
  `total` float NOT NULL DEFAULT '0',
  `DF1` float NOT NULL DEFAULT '0',
  `DF2` float NOT NULL DEFAULT '0',
  `DF3` float NOT NULL DEFAULT '0',
  `DF4` float NOT NULL DEFAULT '0',
  `DF5` float NOT NULL DEFAULT '0',
  `DF6` float NOT NULL DEFAULT '0',
  `DF7` float NOT NULL DEFAULT '0',
  `DF8` float NOT NULL DEFAULT '0',
  `DF9` float NOT NULL DEFAULT '0',
  `DF10` float NOT NULL DEFAULT '0',
  `DF11` float NOT NULL DEFAULT '0',
  `DF12` float NOT NULL DEFAULT '0',
  `DF13` float NOT NULL DEFAULT '0',
  `DF14` float NOT NULL DEFAULT '0',
  `DF15` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=246 ;

--
-- 转存表中的数据 `tbl_bzkh`
--

INSERT INTO `tbl_bzkh` (`id`, `waccount`, `wapartment`, `raccount`, `rapartment`, `year`, `month`, `total`, `DF1`, `DF2`, `DF3`, `DF4`, `DF5`, `DF6`, `DF7`, `DF8`, `DF9`, `DF10`, `DF11`, `DF12`, `DF13`, `DF14`, `DF15`) VALUES
(125, '2011052351', 12, '2012053239', 11, '2014', '4', 0, 8, 7, 7, 8, 8, 9, 6, 8, 8, 7, 8, 7, 9, 8, 8),
(126, '2011052351', 12, '2012052294', 11, '2014', '4', 0, 9, 8, 7, 8, 9, 8, 8, 8, 8, 9, 8, 8, 9, 8, 8),
(127, '2011052363', 12, '2012052180', 2, '2014', '4', 0, 9, 9, 8.8, 9, 9, 9, 9, 9, 9, 9, 9, 9, 8.8, 9, 9),
(128, '2011052363', 12, '2012052195', 2, '2014', '4', 0, 9, 9, 8.9, 9, 9, 9, 9, 8.7, 9, 8.7, 9, 9, 9, 8.7, 8.5),
(129, '2011052363', 12, '2012052339', 2, '2014', '4', 0, 9, 8.7, 8.5, 8, 8.5, 8.5, 8.7, 8.8, 9, 9, 9, 9, 8.5, 9, 9),
(130, '2011052363', 12, '2012052194', 8, '2014', '4', 0, 8, 8, 8, 8, 8, 8, 8, 8, 8.6, 8, 8.7, 9, 8.5, 8.5, 7),
(131, '2011052363', 12, '2012052206', 8, '2014', '4', 0, 8, 8, 8, 8.5, 9, 8.5, 8.5, 8.9, 8, 8, 9, 9, 8.8, 9, 8),
(132, '2011052418', 12, '2012052254', 5, '2014', '4', 0, 7, 8, 8, 7, 8, 8, 8, 9, 8, 7, 9, 9, 9, 8, 10),
(133, '2011052418', 12, '2012052377', 5, '2014', '4', 0, 8, 8, 8, 8, 8, 8, 8, 8, 8, 7, 9, 9, 9, 8, 10),
(135, '2011052418', 12, '2012052201', 3, '2014', '4', 0, 8, 8, 8, 8, 8, 8, 8, 9, 8, 8, 9, 9, 9, 9, 10),
(136, '2011052418', 12, '2012052331', 3, '2014', '4', 0, 9, 8, 8, 8, 8, 8, 8, 8, 8, 7, 9, 9, 9, 8, 10),
(137, '2011052418', 12, '2012052245', 3, '2014', '4', 0, 8, 8, 8, 7, 8, 8, 8, 8, 8, 7, 8, 9, 9, 8, 10),
(138, '2011052473', 12, '2012052282', 6, '2014', '4', 0, 8, 7, 8, 7, 7, 8, 7, 8, 8, 8, 9, 9, 8, 9, 9),
(139, '2011052473', 12, '2012053229', 6, '2014', '4', 0, 8, 7, 8, 7, 7, 8, 7, 8, 8, 8, 9, 9, 8, 9, 9),
(140, '2011052473', 12, '2012052264', 6, '2014', '4', 0, 8, 7, 8, 7, 7, 8, 7, 8, 8, 8, 9, 9, 8, 9, 9),
(141, '2011052473', 12, '2012052281', 6, '2014', '4', 0, 8, 7, 8, 7, 7, 8, 7, 8, 8, 8, 9, 9, 8, 9, 9),
(142, '2011052473', 12, '2012052364', 9, '2014', '4', 0, 8, 9, 8, 8, 8, 8, 7, 8, 8, 8, 9, 9, 8, 9, 9),
(143, '2011052473', 12, '2012052321', 9, '2014', '4', 0, 8, 9, 8, 8, 8, 8, 7, 8, 8, 8, 9, 9, 8, 9, 9),
(144, '2011052473', 12, '2012053203', 9, '2014', '4', 0, 8, 9, 8, 8, 8, 8, 7, 8, 8, 8, 9, 9, 8, 9, 9),
(145, '2011052449', 12, '2012052296', 10, '2014', '4', 0, 9, 8, 8, 9, 8, 9, 9, 8, 9, 8, 9, 9, 9, 9, 9),
(146, '2011052449', 12, '2012052348', 10, '2014', '4', 0, 7, 7, 8, 8, 8, 9, 8, 8, 9, 9, 9, 9, 9, 9, 9.5),
(147, '2011052449', 12, '2012052338', 10, '2014', '4', 0, 8, 7, 8, 9, 9, 8, 7, 8, 8, 8, 8, 9, 9, 9, 9),
(148, '2011052449', 12, '2012053245', 7, '2014', '4', 0, 8, 8, 9, 9, 8, 7, 8, 9, 8, 8, 8, 8, 9, 8, 9),
(149, '2011052449', 12, '2012052275', 7, '2014', '4', 0, 8, 8, 8, 8, 8, 8, 8, 8, 7, 7, 9, 9, 9, 8, 9),
(150, '2011052364', 12, '2012052358', 4, '2014', '4', 0, 8, 8, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 10),
(151, '2011052364', 12, '2012052306', 4, '2014', '4', 0, 8, 8, 7, 7, 7, 8, 8, 7, 8, 8, 7, 7, 8, 7, 10),
(152, '2011052364', 12, '2012052300', 4, '2014', '4', 0, 8, 8, 8, 7, 7, 7, 7, 7, 7, 7, 7, 8, 7, 7, 9),
(153, '2011052364', 12, '2012052297', 1, '2014', '4', 0, 7, 8, 9, 8, 9, 8, 7, 8, 7, 8, 8, 9, 7, 8, 9),
(154, '2011052364', 12, '2012052345', 1, '2014', '4', 0, 7, 8, 9, 8, 9, 7, 7, 7, 7, 8, 8, 9, 8, 7, 9),
(155, '2011052364', 12, '2012053187', 1, '2014', '4', 0, 7, 8, 9, 8, 9, 8, 8, 8, 8, 8, 8, 9, 8, 8, 9),
(216, '2011052351', 12, '2012053239', 11, '2014', '5', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(217, '2011052351', 12, '2012052294', 11, '2014', '5', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(218, '2011052363', 12, '2012052180', 2, '2014', '5', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(219, '2011052363', 12, '2012052195', 2, '2014', '5', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(220, '2011052363', 12, '2012052339', 2, '2014', '5', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(221, '2011052363', 12, '2012052194', 8, '2014', '5', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(222, '2011052363', 12, '2012052206', 8, '2014', '5', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(223, '2011052418', 12, '2012052201', 3, '2014', '5', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(224, '2011052418', 12, '2012052331', 3, '2014', '5', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(225, '2011052418', 12, '2012052245', 3, '2014', '5', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(226, '2011052418', 12, '2012052254', 5, '2014', '5', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(227, '2011052418', 12, '2012052377', 5, '2014', '5', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(228, '2011052473', 12, '2012052282', 6, '2014', '5', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(229, '2011052473', 12, '2012053229', 6, '2014', '5', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(230, '2011052473', 12, '2012052264', 6, '2014', '5', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(231, '2011052473', 12, '2012052281', 6, '2014', '5', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(232, '2011052473', 12, '2012052364', 9, '2014', '5', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(233, '2011052473', 12, '2012052321', 9, '2014', '5', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(234, '2011052473', 12, '2012053203', 9, '2014', '5', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(235, '2011052449', 12, '2012053245', 7, '2014', '5', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(236, '2011052449', 12, '2012052275', 7, '2014', '5', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(237, '2011052449', 12, '2012052296', 10, '2014', '5', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(238, '2011052449', 12, '2012052348', 10, '2014', '5', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(239, '2011052449', 12, '2012052338', 10, '2014', '5', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(240, '2011052364', 12, '2012052297', 1, '2014', '5', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(241, '2011052364', 12, '2012052345', 1, '2014', '5', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(242, '2011052364', 12, '2012053187', 1, '2014', '5', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(243, '2011052364', 12, '2012052358', 4, '2014', '5', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(244, '2011052364', 12, '2012052306', 4, '2014', '5', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(245, '2011052364', 12, '2012052300', 4, '2014', '5', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
