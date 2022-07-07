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

 Date: 07/07/2022 11:32:19
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
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tbl_posts
-- ----------------------------
DROP TABLE IF EXISTS `tbl_posts`;
CREATE TABLE `tbl_posts`  (
  `IDPost` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `IDUser` int(11) NOT NULL,
  `ImgPostURL` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`IDPost`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

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
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

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
