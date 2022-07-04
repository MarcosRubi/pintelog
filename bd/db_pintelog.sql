/*
 Navicat Premium Data Transfer

 Source Server         : Local
 Source Server Type    : MySQL
 Source Server Version : 100424
 Source Host           : localhost:3306
 Source Schema         : db_pintelog

 Target Server Type    : MySQL
 Target Server Version : 100424
 File Encoding         : 65001

 Date: 04/07/2022 08:01:04
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_favorites
-- ----------------------------
DROP TABLE IF EXISTS `tbl_favorites`;
CREATE TABLE `tbl_favorites`  (
  `IDFavorite` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `IDPost` int(11) NOT NULL,
  `IDUserAddFavorite` int(11) NOT NULL,
  `Favorite` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`IDFavorite`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_favorites
-- ----------------------------
INSERT INTO `tbl_favorites` VALUES (14, 12, 5, 'N');
INSERT INTO `tbl_favorites` VALUES (15, 13, 5, 'N');
INSERT INTO `tbl_favorites` VALUES (16, 14, 5, 'N');

-- ----------------------------
-- Table structure for tbl_posts
-- ----------------------------
DROP TABLE IF EXISTS `tbl_posts`;
CREATE TABLE `tbl_posts`  (
  `IDPost` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `IDUser` int(11) NOT NULL,
  `ImgPostURL` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`IDPost`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_posts
-- ----------------------------
INSERT INTO `tbl_posts` VALUES (12, 5, 'images/post/post2207031101295.png');
INSERT INTO `tbl_posts` VALUES (13, 5, 'images/post/post2207031101335.png');
INSERT INTO `tbl_posts` VALUES (14, 5, 'images/post/post2207031101375.png');

-- ----------------------------
-- Table structure for tbl_users
-- ----------------------------
DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE `tbl_users`  (
  `IDUser` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Username` varchar(12) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PasswordUser` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ImgUserURL` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'images/profile/default.png',
  PRIMARY KEY (`IDUser`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_users
-- ----------------------------
INSERT INTO `tbl_users` VALUES (5, 'Daniel', 'Danielhernandez9980@gmail.com', '9c0479dfa3cea6e19ea2f2673e4d415e', 'images/profile/default.png');

-- ----------------------------
-- View structure for vta_allposts
-- ----------------------------
DROP VIEW IF EXISTS `vta_allposts`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vta_allposts` AS SELECT
	tbl_posts.IDPost, 
	tbl_posts.ImgPostURL, 
	tbl_users.Username, 
	tbl_users.ImgUserURL, 
	tbl_posts.IDUser
FROM
	tbl_posts
	INNER JOIN
	tbl_users
	ON 
		tbl_posts.IDUser = tbl_users.IDUser ;

SET FOREIGN_KEY_CHECKS = 1;
