/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50626
Source Host           : localhost:3306
Source Database       : seckill

Target Server Type    : MYSQL
Target Server Version : 50626
File Encoding         : 65001

Date: 2015-08-25 14:54:55
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for goods
-- ----------------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mgr_name` varchar(255) NOT NULL,
  `gd_name` varchar(255) NOT NULL,
  `gd_pic` varchar(255) DEFAULT NULL,
  `gd_sum` int(255) NOT NULL,
  `gd_remain` int(255) NOT NULL,
  `time` int(11) NOT NULL,
  `being` int(3) NOT NULL COMMENT '删除,0为删除,1为存在',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goods
-- ----------------------------
INSERT INTO `goods` VALUES ('94', 'skila', '梨子', null, '9', '0', '1440443616', '1');
INSERT INTO `goods` VALUES ('95', 'skila', '苹果', null, '10', '-1', '1440443697', '1');

-- ----------------------------
-- Table structure for manage
-- ----------------------------
DROP TABLE IF EXISTS `manage`;
CREATE TABLE `manage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mgr_name` varchar(50) NOT NULL,
  `mgr_psw` varchar(255) NOT NULL,
  `mgr_salt` varchar(225) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of manage
-- ----------------------------
INSERT INTO `manage` VALUES ('16', 'skila', 'c1e9ede36757c11fbdc4b7c1dd380118', '4177');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `user_psw` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL COMMENT '登陆,盐',
  `user_status` int(3) NOT NULL COMMENT '状态,0不在线 ,1在线',
  `user_gain` varchar(255) DEFAULT NULL COMMENT '用户秒杀到的商品,目前设定是一个用户只能秒杀一次',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('2', 'skila', '81a99ba705d662ff702d1258297a206b', '17328', '1', '94');
