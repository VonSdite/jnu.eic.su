-- phpMyAdmin SQL Dump
-- version 3.5.4
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 05 月 28 日 16:48
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
-- 表的结构 `tbl_resource`
--

CREATE TABLE IF NOT EXISTS `tbl_resource` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` varchar(20) NOT NULL,
  `month` varchar(20) NOT NULL,
  `account` varchar(20) NOT NULL,
  `code` varchar(20) NOT NULL,
  `assess` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=269 ;

--
-- 转存表中的数据 `tbl_resource`
--

INSERT INTO `tbl_resource` (`id`, `year`, `month`, `account`, `code`, `assess`) VALUES
(99, '2014', '4', '2012052297', '', '3'),
(100, '2014', '4', '2012052297', '', '3'),
(101, '2014', '4', '2013053193', '', '3'),
(102, '2014', '4', '2013053193', '', '3'),
(103, '2014', '4', '2013053193', '', '3'),
(104, '2014', '4', '2013053193', '', '3'),
(105, '2014', '4', '2013053122', '', '3'),
(106, '2014', '4', '2013053122', '', '3'),
(107, '2014', '4', '2013053068', '', '3'),
(108, '2014', '4', '2013053068', '', '3'),
(109, '2014', '4', '2013053068', '', '3'),
(110, '2014', '4', '2013053068', '', '3'),
(111, '2014', '4', '2013053176', '', '3'),
(112, '2014', '4', '2013053176', '', '3'),
(113, '2014', '4', '2013053064', '', '3'),
(114, '2014', '4', '2013053064', '', '3'),
(115, '2014', '4', '2013053089', '', '3'),
(116, '2014', '4', '2013053106', '', '3'),
(117, '2014', '4', '2013053106', '', '3'),
(118, '2014', '4', '2013052949', '', '3'),
(119, '2014', '4', '2013052949', '', '3'),
(120, '2014', '4', '2013052949', '', '3'),
(121, '2014', '4', '2013052949', '', '3'),
(122, '2014', '4', '2012052339', '', '3'),
(123, '2014', '4', '2013053175', '', '3'),
(124, '2014', '4', '2013053188', '', '3'),
(125, '2014', '4', '2013053188', '', '3'),
(126, '2014', '4', '2013053188', '', '3'),
(127, '2014', '4', '2013053189', '', '3'),
(128, '2014', '4', '2013053189', '', '3'),
(129, '2014', '4', '2013053092', '', '3'),
(130, '2014', '4', '2013053092', '', '3'),
(131, '2014', '4', '2013053219', '', '3'),
(132, '2014', '4', '2013053219', '', '3'),
(133, '2014', '4', '2013053219', '', '3'),
(134, '2014', '4', '2013053162', '', '3'),
(135, '2014', '4', '2013053162', '', '3'),
(136, '2014', '4', '2013053162', '', '3'),
(137, '2014', '4', '2013053015', '', '3'),
(138, '2014', '4', '2013053015', '', '3'),
(139, '2014', '4', '2013053207', '', '3'),
(140, '2014', '4', '2013053207', '', '3'),
(141, '2014', '4', '2013053207', '', '3'),
(142, '2014', '4', '2013053207', '', '3'),
(143, '2014', '4', '2013053241', '', '3'),
(144, '2014', '4', '2013053241', '', '3'),
(145, '2014', '4', '2013053241', '', '3'),
(146, '2014', '4', '2012052201', '', '3'),
(147, '2014', '4', '2012052245', '', '3'),
(148, '2014', '4', '2013053101', '', '3'),
(149, '2014', '4', '2013052974', '', '3'),
(150, '2014', '4', '2013053004', '', '3'),
(151, '2014', '4', '2013053187', '', '3'),
(152, '2014', '4', '2013052958', '', '3'),
(153, '2014', '4', '2013053007', '', '3'),
(154, '2014', '4', '2013053218', '', '3'),
(155, '2014', '4', '2013053218', '', '3'),
(156, '2014', '4', '2013053005', '', '3'),
(157, '2014', '4', '2013053067', '', '3'),
(158, '2014', '4', '2013053249', '', '3'),
(159, '2014', '4', '2013053249', '', '3'),
(160, '2014', '4', '2013053249', '', '3'),
(161, '2014', '4', '2013052987', '', '3'),
(162, '2014', '4', '2013052966', '', '3'),
(163, '2014', '4', '2013053071', '', '3'),
(164, '2014', '4', '2013052952', '', '3'),
(165, '2014', '4', '2013052952', '', '3'),
(166, '2014', '4', '2013052952', '', '3'),
(167, '2014', '4', '2013052952', '', '3'),
(168, '2014', '4', '2013053166', '', '3'),
(169, '2014', '4', '2013053166', '', '3'),
(170, '2014', '4', '2013053136', '', '3'),
(171, '2014', '4', '2013053136', '', '3'),
(172, '2014', '4', '2013053136', '', '3'),
(173, '2014', '4', '2013053195', '', '3'),
(174, '2014', '4', '2013053195', '', '3'),
(175, '2014', '4', '2013053054', '', '3'),
(176, '2014', '4', '2013053054', '', '3'),
(177, '2014', '4', '2013053054', '', '3'),
(178, '2014', '4', '2013053035', '', '3'),
(179, '2014', '4', '2013053035', '', '3'),
(180, '2014', '4', '2013053053', '', '3'),
(181, '2014', '4', '2013053053', '', '3'),
(182, '2014', '4', '2013053013', '', '3'),
(183, '2014', '4', '2013053013', '', '3'),
(184, '2014', '4', '2013053013', '', '3'),
(185, '2014', '4', '2013053013', '', '3'),
(186, '2014', '4', '2013053013', '', '3'),
(187, '2014', '4', '2013052960', '', '3'),
(188, '2014', '4', '2013052960', '', '3'),
(189, '2014', '4', '2012052377', '', '3'),
(190, '2014', '4', '2013053167', '', '3'),
(191, '2014', '4', '2013053202', '', '3'),
(192, '2014', '4', '2013053202', '', '3'),
(193, '2014', '4', '2013053065', '', '3'),
(194, '2014', '4', '2013053034', '', '3'),
(195, '2014', '4', '2013052983', '', '3'),
(196, '2014', '4', '2013052983', '', '3'),
(197, '2014', '4', '2013053024', '', '3'),
(198, '2014', '4', '2013053024', '', '3'),
(199, '2014', '4', '2013052950', '', '3'),
(200, '2014', '4', '2013053123', '', '3'),
(201, '2014', '4', '2013053088', '', '3'),
(202, '2014', '4', '2013053088', '', '3'),
(203, '2014', '4', '2013055027', '', '3'),
(204, '2014', '4', '2013052970', '', '3'),
(205, '2014', '4', '2013052393', '', '3'),
(206, '2014', '4', '2013052393', '', '3'),
(207, '2014', '4', '2013053134', '', '3'),
(208, '2014', '4', '2013053095', '', '3'),
(209, '2014', '4', '2013053095', '', '3'),
(210, '2014', '4', '2013053171', '', '3'),
(211, '2014', '4', '2012052275', '', '3'),
(212, '2014', '4', '2012052275', '', '3'),
(213, '2014', '4', '2013053220', '', '3'),
(214, '2014', '4', '2013053026', '', '3'),
(215, '2014', '4', '2013052992', '', '3'),
(216, '2014', '4', '2013052992', '', '3'),
(217, '2014', '4', '2013053181', '', '3'),
(218, '2014', '4', '2013053158', '', '3'),
(219, '2014', '4', '2013053158', '', '3'),
(220, '2014', '4', '2013053158', '', '3'),
(221, '2014', '4', '2013053020', '', '3'),
(222, '2014', '4', '2012052194', '', '3'),
(223, '2014', '4', '2013053017', '', '3'),
(224, '2014', '4', '2013053017', '', '3'),
(225, '2014', '4', '2013053228', '', '3'),
(226, '2014', '4', '2013053245', '', '3'),
(227, '2014', '4', '2013053143', '', '3'),
(228, '2014', '4', '2013053143', '', '3'),
(229, '2014', '4', '2013053215', '', '3'),
(230, '2014', '4', '2013053215', '', '3'),
(231, '2014', '4', '2013053087', '', '3'),
(232, '2014', '4', '2013053002', '', '3'),
(233, '2014', '4', '2012052364', '', '3'),
(234, '2014', '4', '2013053151', '', '3'),
(235, '2014', '4', '2013053232', '', '3'),
(236, '2014', '4', '2013053232', '', '3'),
(237, '2014', '4', '2013053010', '', '3'),
(238, '2014', '4', '2013053010', '', '3'),
(239, '2014', '4', '2013053010', '', '3'),
(240, '2014', '4', '2013052986', '', '3'),
(241, '2014', '4', '2013053238', '', '3'),
(242, '2014', '4', '2013053059', '', '3'),
(243, '2014', '4', '2012052338', '', '3'),
(244, '2014', '4', '2013053111', '', '3'),
(245, '2014', '4', '2013053111', '', '3'),
(246, '2014', '4', '2013053047', '', '3'),
(247, '2014', '4', '2013053047', '', '3'),
(248, '2014', '4', '2013053240', '', '3'),
(249, '2014', '4', '2013053240', '', '3'),
(250, '2014', '4', '2013053211', '', '3'),
(251, '2014', '4', '2013053211', '', '3'),
(252, '2014', '4', '2013053223', '', '3'),
(253, '2014', '4', '2013053082', '', '3'),
(254, '2014', '4', '2013053082', '', '3'),
(255, '2014', '4', '2013053082', '', '3'),
(256, '2014', '4', '2013053119', '', '3'),
(257, '2014', '4', '2013053047', '', '3'),
(258, '2014', '4', '2013053047', '', '3'),
(259, '2014', '4', '2012052294', '', '3'),
(260, '2014', '4', '2013053174', '', '3'),
(261, '2014', '4', '2013053174', '', '3'),
(262, '2014', '4', '2013053174', '', '3'),
(263, '2014', '4', '2013052297', '', '3'),
(264, '2014', '4', '2013052297', '', '3'),
(265, '2014', '4', '2013052993', '', '3'),
(266, '2014', '4', '2013053155', '', '3'),
(267, '2014', '4', '2013053160', '', '3'),
(268, '2014', '4', '2013053165', '', '3');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
