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
