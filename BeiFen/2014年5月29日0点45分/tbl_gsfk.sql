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
-- 表的结构 `tbl_gsfk`
--

CREATE TABLE IF NOT EXISTS `tbl_gsfk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` varchar(20) NOT NULL,
  `month` varchar(20) NOT NULL,
  `account` varchar(20) NOT NULL,
  `total` float NOT NULL,
  `rank` int(11) NOT NULL,
  `yxgs` float NOT NULL DEFAULT '0',
  `zpdf` float NOT NULL,
  `bzpjdf` float NOT NULL,
  `cqdf` float NOT NULL,
  `wddf` float NOT NULL,
  `tydf` float NOT NULL,
  `fkdf` float NOT NULL,
  `qtdf` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=611 ;

--
-- 转存表中的数据 `tbl_gsfk`
--

INSERT INTO `tbl_gsfk` (`id`, `year`, `month`, `account`, `total`, `rank`, `yxgs`, `zpdf`, `bzpjdf`, `cqdf`, `wddf`, `tydf`, `fkdf`, `qtdf`) VALUES
(123, '2014', '4', '2013053073', 7.00786, 8, 0, 1.865, 4.14286, 1, 0, 0, 0, 0),
(124, '2014', '4', '2013053193', 7.24881, 6, 0, 1.71667, 4.23214, 0.9, 0.4, 0, 0, 0),
(125, '2014', '4', '2013053064', 7.475, 3, 0, 1.6, 4.375, 1, 0.2, 0.3, 0, 0),
(126, '2014', '4', '2013053068', 7.28452, 5, 0, 1.7, 4.18452, 1, 0.4, 0, 0, 0),
(127, '2014', '4', '2013053176', 7.03571, 7, 0, 1.63333, 4.20238, 1, 0.2, 0, 0, 0),
(128, '2014', '4', '2013053089', 6.68571, 10, 0, 1.65, 4.03571, 0.9, 0.1, 0, 0, 0),
(129, '2014', '4', '2013053106', 7.69405, 1, 1, 1.78333, 4.41071, 1, 0.2, 0.3, 0, 0),
(130, '2014', '4', '2013053091', 7.50238, 2, 0, 1.91667, 4.28571, 1, 0, 0.3, 0, 0),
(131, '2014', '4', '2013052949', 7.42333, 4, 0, 1.79, 4.13333, 1, 0.4, 0.1, 0, 0),
(132, '2014', '4', '2013053122', 6.97857, 9, 0, 1.6, 4.17857, 1, 0.2, 0, 0, 0),
(133, '2014', '4', '2013052952', 7.57738, 1, 1, 1.81667, 4.16071, 1, 0.4, 0.1, 0.1, 0),
(134, '2014', '4', '2013053166', 7.26071, 2, 0, 1.7, 4.16071, 0.9, 0.2, 0.3, 0, 0),
(135, '2014', '4', '2013053149', 6.85833, 7, 0, 1.71667, 4.04167, 1, 0, 0.1, 0, 0),
(136, '2014', '4', '2013053136', 6.92024, 6, 0, 1.65, 3.97024, 1, 0.3, 0, 0, 0),
(137, '2014', '4', '2013053195', 6.58095, 9, 0, 1.6, 3.88095, 0.9, 0.2, 0, 0, 0),
(138, '2014', '4', '2013053235', 6.18452, 12, 0, 1.53333, 3.85119, 0.8, 0, 0, 0, 0),
(139, '2014', '4', '2013053054', 6.78571, 8, 0, 1.73333, 3.95238, 0.8, 0.3, 0, 0, 0),
(140, '2014', '4', '2013053035', 7.09524, 3, 0, 1.88333, 4.0119, 0.8, 0.2, 0.2, 0, 0),
(141, '2014', '4', '2013053053', 7.00357, 5, 0, 1.85, 4.05357, 0.8, 0.2, 0.1, 0, 0),
(142, '2014', '4', '2013053013', 7.09048, 4, 0, 1.71667, 3.77381, 1, 0.5, 0.1, 0, 0),
(143, '2014', '4', '2013053098', 6.29881, 11, 0, 1.4, 3.89881, 1, 0, 0, 0, 0),
(144, '2014', '4', '2013052960', 6.57619, 10, 0, 1.68333, 3.89286, 0.8, 0.2, 0, 0, 0),
(145, '2014', '4', '2013053175', 6.30714, 10, 0, 1.6, 3.60714, 1, 0.1, 0, 0, 0),
(146, '2014', '4', '2013053188', 7.65714, 1, 0, 1.86667, 4.19048, 1, 0.3, 0.3, 0, 0),
(147, '2014', '4', '2013053189', 6.45476, 9, 0, 1.6, 3.65476, 1, 0.2, 0, 0, 0),
(148, '2014', '4', '2013053062', 6.63214, 6, 0, 1.91667, 3.81548, 0.9, 0, 0, 0, 0),
(149, '2014', '4', '2013053092', 6.775, 4, 0, 1.68333, 3.79167, 1, 0.2, 0.1, 0, 0),
(150, '2014', '4', '2013053219', 6.52619, 7, 0, 1.48333, 3.64286, 1, 0.3, 0.1, 0, 0),
(151, '2014', '4', '2013053162', 6.46429, 8, 0, 1.6, 3.46429, 1, 0.3, 0.1, 0, 0),
(152, '2014', '4', '2013053146', 6.1381, 11, 0, 1.66667, 3.57143, 0.9, 0, 0, 0, 0),
(153, '2014', '4', '2013053015', 6.77857, 3, 0, 1.71667, 3.7619, 1, 0.2, 0.1, 0, 0),
(154, '2014', '4', '2013053241', 6.85833, 2, 0, 1.60833, 3.75, 1, 0.3, 0.2, 0, 0),
(155, '2014', '4', '2013053207', 6.73929, 5, 0, 1.56667, 3.67262, 1, 0.4, 0.1, 0, 0),
(156, '2014', '4', '2013053017', 7.17262, 2, 0, 1.88333, 4.08929, 1, 0.2, 0, 0, 0),
(157, '2014', '4', '2013053228', 7.13214, 3, 0, 1.6, 4.23214, 1, 0.1, 0.2, 0, 0),
(158, '2014', '4', '2013053107', 6.96429, 7, 0, 1.55, 4.21429, 1, 0, 0.2, 0, 0),
(159, '2014', '4', '2013053245', 6.57976, 8, 0, 1.60833, 4.07143, 0.8, 0.1, 0, 0, 0),
(160, '2014', '4', '2013053072', 7.47262, 1, 1, 1.83333, 4.33929, 1, 0, 0.3, 0, 0),
(161, '2014', '4', '2013053143', 5.9131, 10, 0, 1.41667, 3.69643, 0.6, 0.2, 0, 0, 0),
(162, '2014', '4', '2013053215', 6.99762, 6, 0, 1.43333, 4.46429, 0.8, 0.2, 0.1, 0, 0),
(163, '2014', '4', '2013053206', 6.54643, 9, 0, 1.6, 3.94643, 0.9, 0, 0.1, 0, 0),
(164, '2014', '4', '2013053087', 7.0631, 4, 0, 1.51667, 4.44643, 1, 0.1, 0, 0, 0),
(165, '2014', '4', '2013053002', 7.02143, 5, 0, 1.8, 4.32143, 0.7, 0.1, 0.1, 0, 0),
(166, '2014', '4', '2013053101', 7.08929, 13, 0, 1.65, 4.33929, 1, 0.1, 0, 0, 0),
(167, '2014', '4', '2013052974', 7.32024, 8, 0, 1.75, 4.47024, 1, 0.1, 0, 0, 0),
(168, '2014', '4', '2013053004', 7.17619, 10, 0, 1.6, 4.47619, 1, 0.1, 0, 0, 0),
(169, '2014', '4', '2013052977', 7.03214, 14, 0, 1.65, 4.48214, 0.9, 0, 0, 0, 0),
(170, '2014', '4', '2013053187', 7.3381, 7, 0, 1.73333, 4.40476, 1, 0.1, 0.1, 0, 0),
(171, '2014', '4', '2013052958', 7.35714, 6, 0, 1.71667, 4.44048, 1, 0.1, 0, 0.1, 0),
(172, '2014', '4', '2013053007', 7.44452, 4, 0, 1.81, 4.43452, 1, 0.1, 0.1, 0, 0),
(173, '2014', '4', '2013053218', 8.43214, 1, 1, 1.7, 4.73214, 1, 0.2, 0.8, 0, 0),
(174, '2014', '4', '2013053005', 7.17381, 11, 0, 1.8, 4.27381, 1, 0.1, 0, 0, 0),
(175, '2014', '4', '2013053067', 7.13333, 12, 0, 1.58333, 4.25, 1, 0.1, 0.2, 0, 0),
(176, '2014', '4', '2013053042', 6.98095, 15, 0, 1.76667, 4.21429, 1, 0, 0, 0, 0),
(177, '2014', '4', '2013053249', 7.3131, 9, 0, 1.73333, 4.27976, 1, 0.3, 0, 0, 0),
(178, '2014', '4', '2013052987', 7.72381, 3, 0, 1.71667, 4.60714, 1, 0.1, 0.3, 0, 0),
(179, '2014', '4', '2013052966', 7.86786, 2, 0, 2, 4.76786, 1, 0.1, 0, 0, 0),
(180, '2014', '4', '2013053071', 7.3819, 5, 0, 1.68667, 4.59524, 1, 0.1, 0, 0, 0),
(181, '2014', '4', '2013053167', 5.18095, 8, 0, 0.0166667, 3.96429, 1, 0.1, 0.1, 0, 0),
(182, '2014', '4', '2013053145', 6.33929, 3, 0, 1.65, 3.58929, 1, 0, 0.1, 0, 0),
(183, '2014', '4', '2013053202', 5.35357, 7, 0, 0, 4.05357, 1, 0.2, 0.1, 0, 0),
(184, '2014', '4', '2013053065', 6.86905, 1, 1, 1.63333, 4.03571, 1, 0.1, 0.1, 0, 0),
(185, '2014', '4', '2013053038', 6.83452, 2, 0, 1.61667, 4.01786, 1, 0, 0.2, 0, 0),
(186, '2014', '4', '2013053034', 6.14524, 5, 0, 1.61667, 3.42857, 1, 0.1, 0, 0, 0),
(187, '2014', '4', '2013052983', 6.02738, 6, 0, 1.51667, 3.41071, 0.7, 0.2, 0.2, 0, 0),
(188, '2014', '4', '2013053024', 6.16667, 4, 0, 1.66667, 3.5, 0.8, 0.2, 0, 0, 0),
(189, '2014', '4', '2013053117', 5.72143, 6, 0, 1.9, 2.82143, 1, 0, 0, 0, 0),
(190, '2014', '4', '2013053111', 5.8119, 4, 0, 1.75, 2.7619, 1, 0.2, 0.1, 0, 0),
(191, '2014', '4', '2013053047', 5.8381, 3, 0, 1.6, 2.7381, 1, 0.4, 0.1, 0, 0),
(192, '2014', '4', '2013053099', 5.88452, 2, 0, 1.73333, 2.85119, 1, 0, 0.3, 0, 0),
(193, '2014', '4', '2013053240', 5.67738, 7, 0, 1.55, 2.82738, 1, 0.2, 0.1, 0, 0),
(194, '2014', '4', '2013053025', 6.09048, 1, 0, 1.89167, 2.89881, 1, 0, 0.3, 0, 0),
(195, '2014', '4', '2013053211', 5.66357, 8, 0, 1.60167, 2.7619, 1, 0.2, 0.1, 0, 0),
(196, '2014', '4', '2013053223', 5.72976, 5, 0, 1.89167, 2.7381, 1, 0.1, 0, 0, 0),
(197, '2014', '4', '2013053082', 5.65357, 9, 0, 1.71667, 2.6369, 1, 0.3, 0, 0, 0),
(198, '2014', '4', '2013053119', 5.42976, 10, 0, 1.8, 2.52976, 1, 0.1, 0, 0, 0),
(199, '2014', '4', '2013052982', 5.37738, 11, 0, 1.53333, 2.74405, 1, 0, 0.1, 0, 0),
(200, '2014', '4', '2013053139', 6.87917, 3, 0, 1.96667, 3.8125, 1, 0, 0.1, 0, 0),
(201, '2014', '4', '2013053095', 6.94702, 2, 0, 1.86667, 3.58036, 1, 0.2, 0.3, 0, 0),
(202, '2014', '4', '2013053123', 6.81012, 4, 0, 1.83333, 3.77679, 1, 0.1, 0.1, 0, 0),
(203, '2014', '4', '2013053037', 6.61369, 7, 0, 1.78333, 3.83036, 1, 0, 0, 0, 0),
(204, '2014', '4', '2013053213', 6.15893, 13, 0, 1.45, 3.50893, 1, 0, 0.2, 0, 0),
(205, '2014', '4', '2013053088', 7.08036, 1, 1, 1.65, 3.83036, 1, 0.2, 0.4, 0, 0),
(206, '2014', '4', '2013052950', 6.53393, 8, 0, 1.8, 3.63393, 1, 0.1, 0, 0, 0),
(207, '2014', '4', '2013053093', 6.43333, 11, 0, 1.58333, 3.75, 1, 0, 0.1, 0, 0),
(208, '2014', '4', '2013052970', 6.53095, 9, 0, 1.71667, 3.71429, 1, 0.1, 0, 0, 0),
(209, '2014', '4', '2013053134', 5.92024, 15, 0, 1.26667, 3.55357, 1, 0.1, 0, 0, 0),
(210, '2014', '4', '2013053157', 6.5125, 10, 0, 1.6, 3.8125, 1, 0, 0.1, 0, 0),
(211, '2014', '4', '2013055027', 6.15476, 14, 0, 1.48333, 3.57143, 1, 0.1, 0, 0, 0),
(212, '2014', '4', '2013053171', 6.32381, 12, 0, 1.61667, 3.60714, 1, 0.1, 0, 0, 0),
(213, '2014', '4', '2013052393', 6.80298, 5, 0, 1.68333, 3.91964, 1, 0.2, 0, 0, 0),
(214, '2014', '4', '2013053178', 6.68512, 6, 0, 1.78333, 3.90179, 1, 0, 0, 0, 0),
(215, '2014', '4', '2013053127', 5.47857, 9, 0, 1.71667, 2.7619, 1, 0, 0, 0, 0),
(216, '2014', '4', '2013053151', 5.38095, 10, 0, 1.48333, 2.79762, 1, 0.1, 0, 0, 0),
(217, '2014', '4', '2013053028', 5.93333, 3, 0, 2, 2.83333, 1, 0, 0.1, 0, 0),
(218, '2014', '4', '2013053110', 5.19762, 12, 0, 1.56667, 2.63095, 1, 0, 0, 0, 0),
(219, '2014', '4', '2013053232', 5.81667, 5, 0, 1.86667, 2.75, 1, 0.2, 0, 0, 0),
(220, '2014', '4', '2013053179', 5.5619, 7, 0, 1.8, 2.7619, 1, 0, 0, 0, 0),
(221, '2014', '4', '2013057131', 5.26429, 11, 0, 1.46667, 2.79762, 1, 0, 0, 0, 0),
(222, '2014', '4', '2013053010', 5.69762, 6, 0, 1.8, 2.79762, 0.8, 0.3, 0, 0, 0),
(223, '2014', '4', '2013053194', 6.10714, 2, 0, 1.75, 2.85714, 1, 0, 0.5, 0, 0),
(224, '2014', '4', '2013052986', 5.82857, 4, 0, 1.96667, 2.7619, 1, 0.1, 0, 0, 0),
(225, '2014', '4', '2013053059', 5.47857, 8, 0, 1.61667, 2.7619, 1, 0.1, 0, 0, 0),
(226, '2014', '4', '2013053238', 6.24048, 1, 1, 1.78333, 2.85714, 1, 0.1, 0.5, 0, 0),
(227, '2014', '4', '2013052990', 7.08929, 3, 0, 1.55, 4.33929, 1, 0, 0.2, 0, 0),
(228, '2014', '4', '2013053220', 6.78929, 5, 0, 1.4, 4.08929, 1, 0.1, 0.2, 0, 0),
(229, '2014', '4', '2013052991', 4.37143, 10, 0, 0, 3.57143, 0.8, 0, 0, 0, 0),
(230, '2014', '4', '2013053026', 6.5, 9, 0, 1.65, 3.75, 1, 0.1, 0, 0, 0),
(231, '2014', '4', '2013052992', 7.19167, 1, 1, 1.51667, 4.375, 1, 0.2, 0.1, 0, 0),
(232, '2014', '4', '2013053181', 7.03571, 4, 0, 1.65, 4.28571, 1, 0.1, 0, 0, 0),
(233, '2014', '4', '2013053158', 7.15714, 2, 0, 1.5, 4.35714, 1, 0.3, 0, 0, 0),
(234, '2014', '4', '2013053125', 6.5869, 8, 0, 1.63333, 4.05357, 0.9, 0, 0, 0, 0),
(235, '2014', '4', '2013053020', 6.67619, 6, 0, 1.68333, 3.89286, 1, 0.1, 0, 0, 0),
(236, '2014', '4', '2013053174', 6.85, 3, 0, 1.55, 4, 1, 0.3, 0, 0, 0),
(237, '2014', '4', '2013052297', 6.61786, 7, 0, 1.4, 4.01786, 1, 0.2, 0, 0, 0),
(238, '2014', '4', '2013053008', 6.7, 5, 0, 1.55, 4.25, 0.8, 0, 0.1, 0, 0),
(239, '2014', '4', '2013052993', 6.62619, 6, 0, 1.68333, 4.14286, 0.6, 0.1, 0.1, 0, 0),
(240, '2014', '4', '2013053155', 6.82381, 4, 0, 1.61667, 4.10714, 1, 0.1, 0, 0, 0),
(241, '2014', '4', '2013053160', 7.55, 1, 1, 1.7, 4.25, 1, 0.1, 0.5, 0, 0),
(242, '2014', '4', '2013053165', 6.88571, 2, 0, 1.65, 4.03571, 1, 0.1, 0, 0.1, 0),
(243, '2014', '4', '2013053057', 3.76071, 12, 0, 0.0166667, 2.74405, 1, 0, 0, 0, 0),
(244, '2014', '4', '2013053094', 6.62262, 7, 0, 1.78333, 3.83929, 1, 0, 0, 0, 0),
(610, '2014', '5', '2013053094', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(609, '2014', '5', '2013053057', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(608, '2014', '5', '2013053165', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(607, '2014', '5', '2013053160', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(606, '2014', '5', '2013053155', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(605, '2014', '5', '2013052993', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(604, '2014', '5', '2013053008', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(603, '2014', '5', '2013052297', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(602, '2014', '5', '2013053174', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(601, '2014', '5', '2013053020', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(600, '2014', '5', '2013053125', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(599, '2014', '5', '2013053158', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(598, '2014', '5', '2013053181', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(597, '2014', '5', '2013052992', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(596, '2014', '5', '2013053026', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(595, '2014', '5', '2013052991', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(594, '2014', '5', '2013053220', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(593, '2014', '5', '2013052990', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(592, '2014', '5', '2013053238', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(591, '2014', '5', '2013053059', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(590, '2014', '5', '2013052986', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(589, '2014', '5', '2013053194', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(588, '2014', '5', '2013053010', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(587, '2014', '5', '2013057131', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(586, '2014', '5', '2013053179', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(585, '2014', '5', '2013053232', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(584, '2014', '5', '2013053110', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(583, '2014', '5', '2013053028', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(582, '2014', '5', '2013053151', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(581, '2014', '5', '2013053127', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(580, '2014', '5', '2013053178', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(579, '2014', '5', '2013052393', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(578, '2014', '5', '2013053171', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(577, '2014', '5', '2013055027', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(576, '2014', '5', '2013053157', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(575, '2014', '5', '2013053134', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(574, '2014', '5', '2013052970', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(573, '2014', '5', '2013053093', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(572, '2014', '5', '2013052950', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(571, '2014', '5', '2013053088', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(570, '2014', '5', '2013053213', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(569, '2014', '5', '2013053037', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(568, '2014', '5', '2013053123', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(567, '2014', '5', '2013053095', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(566, '2014', '5', '2013053139', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(565, '2014', '5', '2013052982', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(564, '2014', '5', '2013053119', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(563, '2014', '5', '2013053082', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(562, '2014', '5', '2013053223', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(561, '2014', '5', '2013053211', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(560, '2014', '5', '2013053025', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(559, '2014', '5', '2013053240', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(558, '2014', '5', '2013053099', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(557, '2014', '5', '2013053047', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(556, '2014', '5', '2013053111', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(555, '2014', '5', '2013053117', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(554, '2014', '5', '2013053024', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(553, '2014', '5', '2013052983', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(552, '2014', '5', '2013053034', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(551, '2014', '5', '2013053038', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(550, '2014', '5', '2013053065', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(549, '2014', '5', '2013053202', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(548, '2014', '5', '2013053145', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(547, '2014', '5', '2013053167', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(546, '2014', '5', '2013053071', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(545, '2014', '5', '2013052966', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(544, '2014', '5', '2013052987', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(543, '2014', '5', '2013053249', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(542, '2014', '5', '2013053042', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(541, '2014', '5', '2013053067', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(540, '2014', '5', '2013053005', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(539, '2014', '5', '2013053218', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(538, '2014', '5', '2013053007', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(537, '2014', '5', '2013052958', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(536, '2014', '5', '2013053187', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(535, '2014', '5', '2013052977', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(534, '2014', '5', '2013053004', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(533, '2014', '5', '2013052974', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(532, '2014', '5', '2013053101', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(531, '2014', '5', '2013053002', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(530, '2014', '5', '2013053087', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(529, '2014', '5', '2013053206', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(528, '2014', '5', '2013053215', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(527, '2014', '5', '2013053143', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(526, '2014', '5', '2013053072', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(525, '2014', '5', '2013053245', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(524, '2014', '5', '2013053107', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(523, '2014', '5', '2013053228', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(522, '2014', '5', '2013053017', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(521, '2014', '5', '2013053207', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(520, '2014', '5', '2013053241', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(519, '2014', '5', '2013053015', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(518, '2014', '5', '2013053146', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(517, '2014', '5', '2013053162', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(516, '2014', '5', '2013053219', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(515, '2014', '5', '2013053092', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(514, '2014', '5', '2013053062', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(513, '2014', '5', '2013053189', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(512, '2014', '5', '2013053188', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(511, '2014', '5', '2013053175', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(510, '2014', '5', '2013052960', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(509, '2014', '5', '2013053098', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(508, '2014', '5', '2013053013', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(507, '2014', '5', '2013053053', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(506, '2014', '5', '2013053035', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(505, '2014', '5', '2013053054', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(504, '2014', '5', '2013053235', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(503, '2014', '5', '2013053195', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(502, '2014', '5', '2013053136', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(501, '2014', '5', '2013053149', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(500, '2014', '5', '2013053166', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(499, '2014', '5', '2013052952', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(498, '2014', '5', '2013053122', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(497, '2014', '5', '2013052949', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(496, '2014', '5', '2013053091', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(495, '2014', '5', '2013053106', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(494, '2014', '5', '2013053089', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(493, '2014', '5', '2013053176', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(492, '2014', '5', '2013053068', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(491, '2014', '5', '2013053064', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(490, '2014', '5', '2013053193', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(489, '2014', '5', '2013053073', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
