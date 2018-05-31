/*
Navicat MySQL Data Transfer

Source Server         : yadongtextile
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : yadongtextile

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2018-05-31 09:06:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for customerinfo
-- ----------------------------
DROP TABLE IF EXISTS `customerinfo`;
CREATE TABLE `customerinfo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) DEFAULT NULL,
  `telephone` varchar(32) DEFAULT NULL,
  `mobile` varchar(32) DEFAULT NULL,
  `fax` varchar(32) DEFAULT NULL,
  `email` varchar(32) DEFAULT '',
  `comp` varchar(80) DEFAULT NULL,
  `addr` varchar(80) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `clerkid` int(10) unsigned zerofill DEFAULT NULL,
  `uri` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;
