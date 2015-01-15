-- phpMyAdmin SQL Dump
-- version 3.5.3
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 01 月 15 日 15:22
-- 服务器版本: 5.5.19
-- PHP 版本: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `jfun`
--

-- --------------------------------------------------------

--
-- 表的结构 `m_haha`
--

CREATE TABLE IF NOT EXISTS `m_haha` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `m_new`
--

CREATE TABLE IF NOT EXISTS `m_new` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `m_newmodel`
--

CREATE TABLE IF NOT EXISTS `m_newmodel` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '名称',
  `no` varchar(100) NOT NULL,
  `memos` varchar(4000) NOT NULL,
  `dtime` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `m_test`
--

CREATE TABLE IF NOT EXISTS `m_test` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `no` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `m_test`
--

INSERT INTO `m_test` (`id`, `no`) VALUES
(1, '3'),
(2, '大大'),
(3, '测试'),
(4, '呵呵');

-- --------------------------------------------------------

--
-- 表的结构 `test`
--

CREATE TABLE IF NOT EXISTS `test` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `no` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `test`
--

INSERT INTO `test` (`id`, `no`) VALUES
(1, '3'),
(2, '3'),
(3, '3'),
(4, 'ä¸­');

-- --------------------------------------------------------

--
-- 表的结构 `v_view`
--

CREATE TABLE IF NOT EXISTS `v_view` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `templatename` varchar(100) NOT NULL COMMENT '模版名称',
  `template` text NOT NULL COMMENT '模版',
  PRIMARY KEY (`id`),
  UNIQUE KEY `templatename` (`templatename`),
  UNIQUE KEY `id` (`id`),
  KEY `templatename_2` (`templatename`),
  FULLTEXT KEY `templatename_3` (`templatename`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `v_view`
--

INSERT INTO `v_view` (`id`, `templatename`, `template`) VALUES
(1, 'index', '<input type="button" value="按钮"/>');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
