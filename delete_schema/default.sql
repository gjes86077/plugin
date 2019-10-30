-- --------------------------------------------------------
-- 主機:                           localhost
-- 伺服器版本:                        5.7.24 - MySQL Community Server (GPL)
-- 伺服器操作系統:                      Win64
-- HeidiSQL 版本:                  10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 傾印  表格 banner 結構
CREATE TABLE IF NOT EXISTS `banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(50) NOT NULL ,
  `sort` tinyint(4) NOT NULL DEFAULT '0',
  `lang` varchar(10) not null default 'zh-tw',
  PRIMARY KEY (`id`)
) COLLATE='utf8mb4_unicode_ci' ; 

-- 正在傾印表格  banner 的資料：~1 rows (約數)
/*!40000 ALTER TABLE `banner` DISABLE KEYS */;

/*!40000 ALTER TABLE `banner` ENABLE KEYS */;

-- 傾印  表格 contact 結構
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15)  NOT NULL,
  `email` varchar(50)  NOT NULL,
  `content` text  NOT NULL,
  `read` tinyint(4) NOT NULL DEFAULT '0',
  `crt_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) COLLATE='utf8mb4_unicode_ci' ; 

-- 正在傾印表格  contact 的資料：~1 rows (約數)
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;

-- 傾印  表格 inf 結構
CREATE TABLE IF NOT EXISTS `inf` (
  `id` tinyint(4) NOT NULL DEFAULT 0,
  `title` varchar(50) DEFAULT NULL,
  `keyword` text COMMENT 'SEO 關鍵字',
  `contact_description` text,
  `description` text COMMENT 'SEO 描述',
  `ga` text COMMENT 'GOOGLE 分析碼',
  PRIMARY KEY (`id`)
) COLLATE='utf8mb4_unicode_ci' ; 


/*!40000 ALTER TABLE `inf` ENABLE KEYS */;

-- 傾印  表格 user 結構
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(3) unsigned NOT NULL AUTO_INCREMENT COMMENT '編號',
  `account` varchar(30) NOT NULL COMMENT '帳號',
  `password` varchar(50) NOT NULL COMMENT '密碼 ( HASH )',
  `name` varchar(30) NOT NULL COMMENT '名稱',
  `rank` int(2) NOT NULL DEFAULT '2' COMMENT '帳號狀態',
  `is_open` int(1) NOT NULL DEFAULT '0' COMMENT '是否啟用',
  PRIMARY KEY (`id`) 
) COLLATE='utf8mb4_unicode_ci' ; 

-- 正在傾印表格  user 的資料：~2 rows (約數)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `account`, `password`, `name`, `rank`, `is_open`) VALUES
	(1, 'admin', 'd38199b248f774a4179daf84045dab7a728b75c1', '預設管理員帳號', 2, 0),
	(2, 'forest', 'cf432cca7b3998e9178cf8683021e0e4d3e4dd4b', '森德', 2, 0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
