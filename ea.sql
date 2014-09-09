/*
Navicat MySQL Data Transfer

Source Server         : mysql
Source Server Version : 50524
Source Host           : localhost:3306
Source Database       : ea

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2014-08-20 18:07:02
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `ea_auth_group`
-- ----------------------------
DROP TABLE IF EXISTS `ea_auth_group`;
CREATE TABLE `ea_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` char(80) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ea_auth_group
-- ----------------------------

-- ----------------------------
-- Table structure for `ea_auth_group_access`
-- ----------------------------
DROP TABLE IF EXISTS `ea_auth_group_access`;
CREATE TABLE `ea_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ea_auth_group_access
-- ----------------------------

-- ----------------------------
-- Table structure for `ea_auth_rule`
-- ----------------------------
DROP TABLE IF EXISTS `ea_auth_rule`;
CREATE TABLE `ea_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ea_auth_rule
-- ----------------------------

-- ----------------------------
-- Table structure for `ea_user`
-- ----------------------------
DROP TABLE IF EXISTS `ea_user`;
CREATE TABLE `ea_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET utf8 NOT NULL,
  `nickname` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `password` char(32) CHARACTER SET utf8 NOT NULL,
  `email` varchar(20) CHARACTER SET utf8 NOT NULL,
  `sex` enum('男','女') CHARACTER SET utf8 NOT NULL DEFAULT '男',
  `create_time` int(10) unsigned NOT NULL,
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `login_time` int(10) unsigned NOT NULL DEFAULT '0',
  `login_ip` int(4) unsigned NOT NULL DEFAULT '0',
  `login_times` int(10) unsigned NOT NULL DEFAULT '1',
  `status` enum('正常','禁用') CHARACTER SET utf8 NOT NULL DEFAULT '正常',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`) USING BTREE,
  UNIQUE KEY `email` (`email`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ea_user
-- ----------------------------
INSERT INTO `ea_user` VALUES ('83', '1', '1', 'c4ca4238a0b923820dcc509a6f75849b', '1@qq.com', '男', '1406946819', '0', '0', '0', '1', '正常');
INSERT INTO `ea_user` VALUES ('84', '2', '2', 'c81e728d9d4c2f636f067f89cc14862c', '2@qq.com', '男', '1406946869', '0', '0', '0', '1', '正常');
INSERT INTO `ea_user` VALUES ('85', '3', '3', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '3@qq.com', '男', '1406946894', '0', '0', '0', '1', '正常');
INSERT INTO `ea_user` VALUES ('86', '12', '123', '202cb962ac59075b964b07152d234b70', '22@qq.com', '男', '1406951347', '0', '0', '0', '1', '正常');

-- ----------------------------
-- Table structure for `wx_access_token`
-- ----------------------------
DROP TABLE IF EXISTS `wx_access_token`;
CREATE TABLE `wx_access_token` (
  `user_id` int(11) NOT NULL,
  `access_token` varchar(512) NOT NULL,
  `end_time` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_access_token
-- ----------------------------
INSERT INTO `wx_access_token` VALUES ('85', 'A8kvcyt5RlDMtLqjyYdzghCsrCL02SdJicu0K-CziM9n_NwIKG8Y8-zNnblG75p_wn1tSViLp7om501BoFMu6w', '0');
INSERT INTO `wx_access_token` VALUES ('83', 'zkAYlfMPDXDS_tooLd5a9v0B4p4LbAKh1QEgMRJKkj0aFkdCmCooYVw_B99Z2f4iUojYMmp2vzDY8BN6CupmrQ', '1408532900');

-- ----------------------------
-- Table structure for `wx_api`
-- ----------------------------
DROP TABLE IF EXISTS `wx_api`;
CREATE TABLE `wx_api` (
  `user_id` int(11) NOT NULL,
  `url` char(36) NOT NULL COMMENT 'URL',
  `token` char(13) NOT NULL COMMENT 'Token',
  `name` varchar(30) NOT NULL COMMENT '公众号名称',
  `original_id` varchar(20) NOT NULL COMMENT '原始ID',
  `wx_username` varchar(30) NOT NULL COMMENT '微信号',
  `app_id` varchar(50) NOT NULL COMMENT '服务号app_id',
  `app_secret` varchar(100) NOT NULL COMMENT '服务号app_secret',
  `head_img` varchar(100) NOT NULL COMMENT '头像地址',
  `bind_url` varchar(100) NOT NULL,
  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_api
-- ----------------------------
INSERT INTO `wx_api` VALUES ('83', '677c37ed-19ed-11e4-9d21-bc5ff4176c78', '53dc4e032be58', '黑曼巴(测试)', 'gh_b7d0880bcac0', 'wx1024514854', 'wx413945a96ee78396', '8d24f96eedb940712fb639f801e20e84', 'wx_upload/83/getheadimg.jpeg', '');
INSERT INTO `wx_api` VALUES ('85', '941fdfbe-19ed-11e4-9d21-bc5ff4176c78', '53dc4e4e1d2c8', '新阳', '', '', 'wx4de36a76c336a445', '71a335fe5cd939f26c6cbffa9adc5e9b', '', '');
INSERT INTO `wx_api` VALUES ('86', 'ef2a9c8c-19f7-11e4-9d21-bc5ff4176c78', '53dc5fb3d5726', '', '', '', '', '', '', '');

-- ----------------------------
-- Table structure for `wx_group`
-- ----------------------------
DROP TABLE IF EXISTS `wx_group`;
CREATE TABLE `wx_group` (
  `group_id` int(4) NOT NULL AUTO_INCREMENT,
  `groupname` varchar(50) NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_group
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_menu`
-- ----------------------------
DROP TABLE IF EXISTS `wx_menu`;
CREATE TABLE `wx_menu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` enum('click','view') NOT NULL,
  `name` varchar(21) NOT NULL,
  `url` varchar(200) DEFAULT NULL,
  `key` varchar(10) DEFAULT NULL,
  `sort` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_menu
-- ----------------------------
INSERT INTO `wx_menu` VALUES ('1', '0', '83', 'view', '微视界', 'http://www.baidu.com', null, '3');
INSERT INTO `wx_menu` VALUES ('2', '0', '83', 'click', '微服务', '', 'SERVER', '2');
INSERT INTO `wx_menu` VALUES ('4', '2', '83', 'click', '在线咨询', null, 'ONLINE', '1');
INSERT INTO `wx_menu` VALUES ('5', '2', '83', 'view', '人工客服', 'http://www.google.com', null, '2');

-- ----------------------------
-- Table structure for `wx_user`
-- ----------------------------
DROP TABLE IF EXISTS `wx_user`;
CREATE TABLE `wx_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `group_id` int(4) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_user
-- ----------------------------
