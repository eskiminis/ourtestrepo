ALTER TABLE `%PREFIX%users` CHANGE `rank` `rank` TINYINT( 1 ) NOT NULL DEFAULT '0' COMMENT 'max is 3';
DROP TABLE `%PREFIX%rulers`;
ALTER TABLE `%PREFIX%conf` ADD `rulers` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL AFTER `news1`;
UPDATE `%PREFIX%conf` SET `sge_ver` =  '041' WHERE CONVERT( `sge_ver` USING utf8 ) =  '040' LIMIT 1 ;