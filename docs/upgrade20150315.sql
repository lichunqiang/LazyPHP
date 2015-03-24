-- ----------------------------
-- Table structure for `skill_article`
-- ----------------------------
DROP TABLE IF EXISTS `skill_article`;
CREATE TABLE `skill_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` date NOT NULL,
  `updated_at` date DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `status` smallint(1) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10000 DEFAULT CHARSET=utf8;

ALTER TABLE `mugenauthors`
ADD COLUMN `address_status`  smallint(1) NOT NULL DEFAULT 0 AFTER `address`;


-- ----------------------------
-- Table structure for `characters`
-- ----------------------------
DROP TABLE IF EXISTS `characters`;
CREATE TABLE `characters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` smallint(1) NOT NULL DEFAULT 0 COMMENT '该人物状态',
  `name` varchar(255) NOT NULL,
  `name_roman` varchar(100) NOT NULL DEFAULT '',
  `magic_changed` smallint(1) NOT NULL DEFAULT 0 COMMENT '是否魔改 0否 1是',
  `belong_game` varchar(100) NOT NULL DEFAULT '' COMMENT '所属游戏',
  `belong_anime` varchar(200) NOT NULL DEFAULT '' COMMENT '所属动漫',
  `keywords` varchar(255) NOT NULL DEFAULT '' COMMENT '关键字',
  `thumbnail` varchar(300) NOT NULL DEFAULT '' COMMENT '缩略图',
  `completion_status` smallint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY (`name`),
  KEY (`name_roman`),
  KEY (`keywords`)
) ENGINE=MyISAM AUTO_INCREMENT=10000 DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for `characters_author`
-- ----------------------------
DROP TABLE IF EXISTS `characters_author`;
CREATE TABLE `characters_author` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `characters_id` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` smallint(1) NOT NULL DEFAULT 0 COMMENT '该作者状态',
  `name` varchar(255) NOT NULL,
  `mugen_version` smallint(2) NOT NULL DEFAULT 0,
  `download_url` varchar(255) NOT NULL DEFAULT '',
  `strength_highest` smallint(2) NOT NULL DEFAULT 0,
  `strength_lowest` smallint(2) NOT NULL DEFAULT 0,
  `remark` text,
  PRIMARY KEY (`id`),
  KEY (`name`),
  KEY (`mugen_version`),
  KEY (`strength_highest`),
  KEY (`strength_lowest`)
) ENGINE=MyISAM AUTO_INCREMENT=10000 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `ftg_name_source`
-- ----------------------------
DROP TABLE IF EXISTS `ftg_name_source`;
CREATE TABLE `ftg_name_source` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `origin` varchar(255) NOT NULL DEFAULT '',
  `correct` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY (`origin`)
) ENGINE=MyISAM AUTO_INCREMENT=10000 DEFAULT CHARSET=utf8;
