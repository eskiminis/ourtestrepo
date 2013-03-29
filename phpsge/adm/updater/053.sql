ALTER TABLE `%PREFIX%users` ADD `ip` VARCHAR( 35 ) NOT NULL ;
ALTER TABLE `%PREFIX%umsg` CHANGE `mtype` `mtype` TINYINT( 2 ) UNSIGNED NOT NULL COMMENT '0 sys msg | 1 msg | 2 repo | 3 ally invite';
CREATE TABLE `%PREFIX%warn` (
`id` INT( 5 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`text` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE = MYISAM;
UPDATE `%PREFIX%conf` SET `sge_ver` =  '054' WHERE CONVERT( `sge_ver` USING utf8 ) =  '053' LIMIT 1 ;