-- phpMyAdmin SQL Dump
-- version 3.5.4
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 06 月 08 日 10:39
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
-- 表的结构 `tbl_bzzp`
--

CREATE TABLE IF NOT EXISTS `tbl_bzzp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `waccount` varchar(20) CHARACTER SET utf8 NOT NULL,
  `wapartment` int(11) NOT NULL,
  `year` varchar(20) CHARACTER SET utf8 NOT NULL,
  `month` varchar(20) CHARACTER SET utf8 NOT NULL,
  `zptext` text CHARACTER SET utf8 NOT NULL,
  `total` float NOT NULL DEFAULT '0',
  `DF1` float NOT NULL DEFAULT '0',
  `DF2` int(11) NOT NULL DEFAULT '0',
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
  `DF16` float NOT NULL DEFAULT '0',
  `DF17` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=246 ;

--
-- 转存表中的数据 `tbl_bzzp`
--

INSERT INTO `tbl_bzzp` (`id`, `waccount`, `wapartment`, `year`, `month`, `zptext`, `total`, `DF1`, `DF2`, `DF3`, `DF4`, `DF5`, `DF6`, `DF7`, `DF8`, `DF9`, `DF10`, `DF11`, `DF12`, `DF13`, `DF14`, `DF15`, `DF16`, `DF17`) VALUES
(125, '2012052297', 1, '2014', '4', '本月我们更新了关于物资借用的很多制度和A307的管理制度，严格要求了文档的撰写，整理了发票和小票，准备进行报销。', 144, 8, 8, 8, 8, 9, 9, 9, 9, 8, 8, 8, 9, 9, 8, 9, 9, 8),
(126, '2012052345', 1, '2014', '4', '我这个月的工作还算可以，和部门的人相处的更好了，越来越觉得和大家在一起真的很开心。', 158, 8, 9, 10, 9, 10, 9, 9, 10, 9, 9, 9, 10, 10, 9, 9, 10, 9),
(127, '2012053187', 1, '2014', '4', '秘书处本月的工作可能相较于3月份是较多的，整个四月学院举办的活动也比较多，所以秘书处在帮助其他部门举办活动时也遇到了较多的问题。不过秘书处会努力，改善好现在的环境，让轮值部长多成长一些。', 141.5, 8, 8, 9, 9, 9, 8, 8, 8, 8, 8, 8, 9, 8, 8, 9.5, 8, 8),
(128, '2012052358', 4, '2014', '4', '部门关系融洽', 160, 10, 8, 10, 9, 10, 8, 9, 10, 9, 9, 9, 10, 9, 10, 10, 10, 10),
(129, '2012052306', 4, '2014', '4', '我这学期好像在工作上没帮上什么忙- -但是觉得不是感情影响的...只是在组织部门活动方面感觉还好，但是孩子们第二学期明显成长了，当部长还是挺多的变化的', 120, 6, 8, 8, 7, 5, 7, 7, 8, 7, 7, 7, 7, 6, 7, 8, 8, 7),
(130, '2012052300', 4, '2014', '4', '这个月主要在00和毡哥度蜜月期间负责跟进密室逃脱的工作,忙一点不过还好..负责活动的轮值部长都很用心..', 138, 7, 7, 8, 7, 9, 8, 8, 9, 7, 8, 9, 9, 9, 9, 8, 9, 7),
(131, '2012052180', 2, '2014', '4', '这个月有头脑风暴之夺宝奇兵的活动，因为我一向主管内务，所以接手办活动的工作略显笨拙，很多细节我是没有预料到的，只能靠现场的应变和调度来解决。希望以后我能多多锻炼自己的活动的能力而不是单单只是管内务。', 140, 9, 7, 9, 9, 8, 8, 9, 7, 7, 9, 8, 7, 7, 9, 9, 9, 9),
(132, '2012052195', 2, '2014', '4', '可能4月的活动比较大型，所以还是无法做到完全交给干事，所以比较累，另外觉得遇到的问题就是在部门合作方面，许多活动是两个部门合作的，其实有时比一个部门办还麻烦aaa', 131, 8, 8, 8, 8, 9, 8, 7, 7, 7, 8, 8, 8, 7, 7, 8, 8, 7),
(133, '2012052339', 2, '2014', '4', '空', 119, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7),
(134, '2012052194', 8, '2014', '4', '这个月举办了教室逃脱活动，虽然和信编合作出现问题，但是活动还是很顺利地举办了下来~', 149, 9, 9, 9, 9, 10, 9, 8.5, 8.5, 8, 8.5, 9, 9, 8.5, 8, 9, 8.5, 8.5),
(135, '2012052206', 8, '2014', '4', '团务工作方面还是井井有条的，不过部门内部的确也存在一些矛盾，接下来趁着以后的工作比较少，尝试多举办一些部门活动的增加部门感情。', 147, 8, 8, 9, 8, 9, 8, 8, 9, 9, 9, 9, 9, 10, 9, 9, 8, 8),
(136, '2012052201', 3, '2014', '4', '这个月我们部门完成了头脑风暴这个大活动，通过这个活动发现了很多细节上的问题。但是我看到了我们部门的凝聚力还是有的，这让我感到很欣慰。', 157, 9, 9, 10, 9, 10, 9, 9, 9, 9, 8, 10, 9, 10, 10, 8, 10, 9),
(137, '2012052331', 3, '2014', '4', '有收获，也有不足；沟通问题真的很重要', 152, 9, 9, 9, 9, 8, 9, 9, 9, 8, 9, 9, 10, 9, 9, 9, 9, 9),
(138, '2012052245', 3, '2014', '4', '上月工作有时没有克制自己。以后会注意。', 139, 8, 8, 8, 8, 8, 8, 9, 8, 9, 8, 8, 8, 6, 8, 9, 9, 9),
(139, '2012052254', 5, '2014', '4', '在轮值部长的安排和培训方面做得比较满意，达到了预期效果，但前期有点过于放松。', 142, 8, 8, 8, 8, 8, 9, 9, 8, 7, 8, 9, 8, 8, 9, 9, 9, 9),
(140, '2012052377', 5, '2014', '4', '热情积极，关心干事，时常与干事聊天，了解并帮助解决生活工作学习上问题，不过，本学期的部门工作放松了一些，虽然给了干事更大的发挥与成长空间，但同时也存在一些问题，需不断改进。', 150, 9, 8, 10, 9, 8, 9, 9, 10, 8, 10, 8, 9, 9, 8, 9, 9, 8),
(142, '2012052296', 10, '2014', '4', '空', 147, 9, 9, 9, 9, 9, 8, 8, 9, 9, 8, 8, 9, 8, 9, 9, 8, 9),
(143, '2012052348', 10, '2014', '4', '这个月办了一个活动，出现很多问题。有干事的，亦有部长级的。学到很多，关于为人处世的小tips。恩，继续努力，相信会有更大的收获。解决问题其实就是在学习。', 135, 7, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8),
(144, '2012052338', 10, '2014', '4', '空', 139.5, 7, 8, 8, 8, 9, 9.5, 8.5, 7, 8, 9, 8, 8, 7.5, 9, 8, 8, 9),
(145, '2012052282', 6, '2014', '4', '没能及时发现一些部门内部矛盾问题。组织的活动没能吸引更多人参加。与其他部长分工后，参与过多其他部长应做部分。', 129, 8, 7, 8, 8, 8, 8, 8, 7, 8, 7, 7, 8, 8, 7, 8, 7, 7),
(146, '2012053229', 6, '2014', '4', '本周工作正常进行，不过院内羽毛球赛将再次推迟，是趋待解决的问题。代理部长制度继续进行，能够发现问题，并及时解决是比较大的收获。', 132, 7, 8, 9, 7, 8, 6, 7, 8, 9, 8, 9, 8, 7, 7, 8, 8, 8),
(147, '2012052264', 6, '2014', '4', '认真工作，尽心与干事交流，开始物色下一年的部长人选', 130, 7, 7, 8, 8, 7, 8, 7, 9, 7, 7, 8, 8, 8, 7, 8, 8, 8),
(148, '2012052281', 6, '2014', '4', '由于这学期有代部，所以有了惰性，放手式地让干事去管理部门的事情，也没有及时和他们沟通询问情况进展，导致发生了些矛盾，这是非常严重的问题，以后一定要改进，更好地改进内部建设。', 139, 8, 8, 9, 8, 9, 7, 8, 8, 8, 8, 8, 9, 9, 9, 7, 8, 8),
(149, '2012052364', 9, '2014', '4', '文娱部全身心投入拉拉队的训练与比赛中，与此同时，我在努力增强部门凝聚力，因为下学期都会比较散漫。总体来说，四月份刚开始的时候有点散漫，但后来经过整顿好很多了。', 167, 9, 9, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 9, 10),
(150, '2012052321', 9, '2014', '4', '和部门其他人相处甚好', 136, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8),
(151, '2012053203', 9, '2014', '4', '空', 153, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9),
(152, '2012053245', 7, '2014', '4', '本月KSC与学术部共同举办了APP创意的比赛，期间出现的问题较多，在办程序设计时我会把这些当做教训。', 144, 8, 8, 10, 9, 7, 8, 9, 9, 8, 9, 7, 8, 10, 8, 9, 9, 8),
(153, '2012052275', 7, '2014', '4', '最近比较累……', 134, 8, 9, 8, 8, 8, 8, 9, 8, 8, 7, 8, 8, 7, 7, 7, 8, 8),
(154, '2012053239', 11, '2014', '4', '部门干事的能力都非常强，部门很团结，超乎想象和预期', 145, 8, 8, 9, 9, 8, 9, 9, 9, 9, 8, 8, 8, 9, 8, 8, 9, 9),
(155, '2012052294', 11, '2014', '4', '上一个月一直都是在排练心理剧，轮值部长发挥了很大的作用，结果也很令人满意，我本人的工作主要是起督导的作用。', 144, 8, 8, 9, 8, 9, 8, 8, 9, 8, 9, 9, 9, 9, 8, 8, 9, 8),
(216, '2012052297', 1, '2014', '5', '本月工作略多，但还是可以完成，正在积极完成报账。', 144, 9, 8, 9, 8, 8, 9, 8, 9, 8, 8, 9, 8, 9, 8, 8, 9, 9),
(217, '2012052345', 1, '2014', '5', '这个月的工作主要是促进部门之间的感情，貌似大家的热情并不是很大，下个月是最后的一个月，我希望尽力组织一些活动。', 163, 9, 9, 10, 10, 10, 10, 9, 9, 9, 9, 10, 10, 10, 10, 10, 10, 9),
(218, '2012053187', 1, '2014', '5', '秘书处作为一个内务部门，其实更应该创新，这是到后来才开始觉得的，因为人是活的，制度是死的，在不断的发现问题及完善中才能把制度更加好的运用在学生会的管理上，所以我觉得我们这一年的工作做得不够，希望在这个尾巴上，我们能够有一些突破~', 151, 9, 9, 9, 9, 9, 9, 9, 8, 9, 9, 9, 9, 9, 8, 9, 9, 9),
(219, '2012052358', 4, '2014', '5', '本月工作状态良好，临近换届，与干事的交流、同事之间的交流增加更多，感情继续巩固，对部门也多了很多不舍。关于留任，则是将尽量公正客观的相关信息毫无保留的告诉干事们，去留自由。', 154, 8, 9, 8, 9, 9, 10, 9, 9, 8, 9, 10, 8, 10, 9, 9, 10, 10),
(220, '2012052306', 4, '2014', '5', '这个月的状态，工作上...坐等退任，部门内部建设方面，积极引导干事留任，注意她们的情绪。。尽量帮助她们，为她们指引。。', 136, 6, 9, 8, 8, 8, 8, 9, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8),
(221, '2012052300', 4, '2014', '5', '差不多完了。。感觉还好', 143, 8, 8, 9, 8, 9, 9, 8, 9, 8, 8, 8, 8, 9, 9, 8, 9, 8),
(222, '2012052180', 2, '2014', '5', '任期快结束了，现有的工作就剩总结大会了。一直以来都是因为喜欢而去努力，善始善终吧，把总结大会办妥。', 142, 8, 8, 9, 8, 7, 9, 9, 9, 7, 8, 9, 8, 7, 8, 9, 10, 9),
(223, '2012052195', 2, '2014', '5', '办了活动感觉对活动这方面还是不太擅长，过程中出了挺多问题的，不过更了解了一个活动怎样才能办的比较好', 134.5, 9, 7, 8, 7, 8, 7.5, 7, 8, 9, 7, 8, 9, 7, 8, 8, 9, 8),
(224, '2012052339', 2, '2014', '5', '.', 119, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7),
(225, '2012052194', 8, '2014', '5', '这个月总体工作不多，但是干事情绪普遍不高，较难带动。', 140, 8, 8, 8, 8, 9, 9, 9, 8, 8, 8, 9, 8, 8, 8, 8, 8, 8),
(226, '2012052206', 8, '2014', '5', '空', 135, 8, 8, 8, 7, 8, 8, 8, 7, 8, 8, 8, 8, 8, 9, 8, 8, 8),
(227, '2012052201', 3, '2014', '5', '这个月部门任务比较轻，所以内部组织了一些活动联络部门感情。', 163, 8, 9, 10, 10, 9, 10, 10, 9, 10, 9, 10, 10, 9, 10, 10, 10, 10),
(228, '2012052331', 3, '2014', '5', '这个月基本没什么工作，和大家出去玩了一次，很开心，和几个干事聊了下留任的事。', 148, 8, 8, 9, 8, 9, 9, 8, 9, 9, 9, 9, 9, 9, 9, 9, 9, 8),
(229, '2012052245', 3, '2014', '5', '上月工作挺少的。收获嘛，当了一年部长，收获确实还是有的，嗯，挺开心。', 145, 9, 8, 9, 8, 9, 8, 9, 8, 9, 8, 9, 8, 9, 8, 9, 8, 9),
(230, '2012052254', 5, '2014', '5', '本月事情不多，主要就是毕业生交流会和准备换届事宜。大部分工作下放到负责人和轮值部长，但一直有紧密地跟进和监督部门工作。', 139, 8, 9, 9, 8, 8, 8, 9, 9, 8, 8, 7, 8, 9, 7, 8, 8, 8),
(231, '2012052377', 5, '2014', '5', '热情，有归属感，关心干事学习生活工作，不过，不尽完美，有些缺陷发现了，还未能完全改变。', 149, 8, 8, 9, 9, 9, 8, 8, 10, 9, 10, 9, 8, 9, 9, 9, 9, 8),
(232, '2012052296', 10, '2014', '5', '空', 147, 9, 8, 8, 9, 9, 8, 8, 9, 9, 9, 8, 9, 9, 8, 9, 9, 9),
(233, '2012052348', 10, '2014', '5', '留任的事的确抱歉，干事的事基本处理好。活动还剩最后一个，加加油，会过去的。', 136, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8),
(234, '2012052338', 10, '2014', '5', '空', 116, 6, 6, 7, 6, 7, 7, 7, 6, 6, 7, 6, 8, 7, 9, 8, 7, 6),
(235, '2012052282', 6, '2014', '5', '没有考虑全活动可能遇到的突发情况', 122, 7, 7, 9, 7, 9, 6, 6, 7, 7, 7, 7, 7, 7, 8, 8, 7, 6),
(236, '2012053229', 6, '2014', '5', '着手换届。', 136, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8),
(237, '2012052264', 6, '2014', '5', '无', 131, 8, 8, 8, 7, 7, 8, 7, 8, 8, 8, 8, 7, 7, 8, 8, 8, 8),
(238, '2012052281', 6, '2014', '5', '这个月主要是留任的问题，我们都把每个干事叫出来聊聊，效果应该还好。', 139, 7, 8, 9, 8, 9, 7, 8, 9, 8, 8, 8, 9, 9, 8, 8, 8, 8),
(239, '2012052364', 9, '2014', '5', '在拉拉队的训练和比赛中积极努力认真做好自己的事情。拉拉队的表现中，能很好地体现每一个人的性格，可以看到继承人的身影。一年的部长级工作快结束了，觉得和干事们相处得挺好，今年的文娱也比去年好，无论是成绩还是部门活跃性，干事的能力等各方面。而且做了部服以后感觉部门更团结了。', 168, 10, 10, 9, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 9, 10),
(240, '2012052321', 9, '2014', '5', '空', 153, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9),
(241, '2012053203', 9, '2014', '5', '空', 117, 7, 7, 7, 7, 7, 7, 6, 7, 6, 7, 7, 7, 6, 7, 8, 7, 7),
(242, '2012053245', 7, '2014', '5', '学生会工作快结束了，部门的凝聚力没有达到预期，甚至存在部门内部小矛盾，怪我没有传播足够的正能量给他们。', 134, 8, 8, 9, 6, 10, 8, 9, 8, 7, 9, 9, 10, 10, 0, 9, 7, 7),
(243, '2012052275', 7, '2014', '5', '事情比较多，感觉有时会处理别的事情比较多，部门活动大多交给他们去处理了……', 138, 8, 8, 9, 8, 8, 8, 8, 8, 8, 8, 8, 8, 9, 7, 9, 8, 8),
(244, '2012053239', 11, '2014', '5', '五月份心理剧大赛第五三等奖不尽人意', 153, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9),
(245, '2012052294', 11, '2014', '5', '这一年当部长收获了很多，让我成长了很多，解决问题的能力有了很大的提升，也发现了自身的不足。', 148, 8, 9, 9, 8, 9, 9, 8, 9, 8, 9, 9, 9, 9, 9, 9, 9, 8);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
