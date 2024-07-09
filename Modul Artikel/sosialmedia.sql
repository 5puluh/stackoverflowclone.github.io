/*
 Navicat Premium Data Transfer

 Source Server         : localmysql
 Source Server Type    : MySQL
 Source Server Version : 80030
 Source Host           : localhost:3306
 Source Schema         : sosialmedia

 Target Server Type    : MySQL
 Target Server Version : 80030
 File Encoding         : 65001

 Date: 05/10/2022 20:28:24
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for artikel
-- ----------------------------
DROP TABLE IF EXISTS `artikel`;
CREATE TABLE `artikel` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kategori` int DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `isi` text,
  `like` int NOT NULL DEFAULT '0',
  `comment` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `ringkasan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of artikel
-- ----------------------------
BEGIN;
INSERT INTO `artikel` VALUES (7, 1, 'ricomarten', 'asdasl;saldkpo a;lsmd;alskdpo lkasmdalksdmp laksmdlaksmd', 4, 1, '2022-10-05 07:59:09', NULL, ' Php is the best');
INSERT INTO `artikel` VALUES (8, 5, 'ricomarten', 'zxczxczx \r\n asdasdasdasda sdasdasasdsadasdasdasdasdasdasd asdasdasasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdassa asdasd asdasdas sadasdasdasdasda asdasdasdasas asdasdas\r\n\r\n asdasdasdasda sdasdasasdsadasdasdasdasdasdasd asdasdasasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdassa asdasd asdasdas sadasdasdasdasda asdasdasdasas asdasdas\r\n\r\n asdasdasdasda sdasdasasdsadasdasdasdasdasdasd asdasdasasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdassa asdasd asdasdas sadasdasdasdasda asdasdasdasas asdasdas', 3, 2, '2022-10-05 08:09:39', NULL, ' asdasdasdasda sdasdasasdsadasdasdasdasdasdasd asdasdasasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdassa asdasd asdasdas sadasdasdasdasda asdasdasdasas asdasdas');
INSERT INTO `artikel` VALUES (9, 3, 'ricomarten', ' Saya sangant suka javascript\' Saya sangant suka javascript\r\n Saya sangant suka javascript\r\n Saya sangant suka javascript\r\n Saya sangant suka javascript\r\n Saya sangant suka javascript\r\n Saya sangant suka javascript', 5, 1, '2022-10-05 08:19:53', NULL, ' Saya sangant suka javascript');
INSERT INTO `artikel` VALUES (10, 3, 'ricomarten', ' Javascript is not java\r\n Javascript is not java\r\n Javascript is not java\r\n Javascript is not java\r\n Javascript is not java\r\n Javascript is not java\r\n Javascript is not java\r\n Javascript is not java\r\n Javascript is not java\r\n Javascript is not java', 1, 0, '2022-10-05 08:33:16', NULL, ' Javascript is not java');
INSERT INTO `artikel` VALUES (11, 4, 'ricomarten', ' Java Super Ribet\r\n Java Super Ribet\r\n Java Super Ribet\r\n Java Super Ribet', 1, 0, '2022-10-05 12:07:02', NULL, ' Java Super Ribet');
COMMIT;

-- ----------------------------
-- Table structure for comment
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_artikel` int DEFAULT NULL,
  `comment` text,
  `jml_like` int NOT NULL DEFAULT '0',
  `jml_comment` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `artikel_id` (`id_artikel`),
  CONSTRAINT `artikel_id` FOREIGN KEY (`id_artikel`) REFERENCES `artikel` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of comment
-- ----------------------------
BEGIN;
INSERT INTO `comment` VALUES (4, 9, 'Hhahaha', 0, 0, '2022-10-05 12:28:55', NULL, 'user');
INSERT INTO `comment` VALUES (5, 7, 'Javascript is the best', 0, 0, '2022-10-05 12:29:20', NULL, 'user');
INSERT INTO `comment` VALUES (6, 8, 'oooooo', 0, 0, '2022-10-05 12:29:30', NULL, 'user');
INSERT INTO `comment` VALUES (7, 8, 'apasih', 0, 0, '2022-10-05 12:42:51', NULL, 'ricomarten');
COMMIT;

-- ----------------------------
-- Table structure for kategori
-- ----------------------------
DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kategori` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of kategori
-- ----------------------------
BEGIN;
INSERT INTO `kategori` VALUES (1, 'PHP');
INSERT INTO `kategori` VALUES (2, 'C');
INSERT INTO `kategori` VALUES (3, 'Javascript');
INSERT INTO `kategori` VALUES (4, 'Java');
INSERT INTO `kategori` VALUES (5, 'Python');
INSERT INTO `kategori` VALUES (6, 'Ruby');
COMMIT;

-- ----------------------------
-- Table structure for level_user
-- ----------------------------
DROP TABLE IF EXISTS `level_user`;
CREATE TABLE `level_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `level` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of level_user
-- ----------------------------
BEGIN;
INSERT INTO `level_user` VALUES (1, 'Admin');
INSERT INTO `level_user` VALUES (2, 'User');
COMMIT;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `level_user` int DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
BEGIN;
INSERT INTO `user` VALUES ('ricomarten', 'ricomarten@gmail.com', 'Rico Martenstyaro', NULL, 1, '81dc9bdb52d04dc20036dbd8313ed055');
INSERT INTO `user` VALUES ('user', 'user@email.com', 'user', NULL, 2, '81dc9bdb52d04dc20036dbd8313ed055');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
