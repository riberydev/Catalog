CREATE DATABASE  IF NOT EXISTS `catalog`;
USE `catalog`;
DROP TABLE IF EXISTS `tb_make`;
CREATE TABLE `tb_make` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
LOCK TABLES `tb_make` WRITE;
INSERT INTO `tb_make` VALUES (1,'Audi',1);
UNLOCK TABLES;