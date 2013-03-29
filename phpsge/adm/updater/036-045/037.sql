ALTER TABLE `%PREFIX%umsg` ADD `aiid` SMALLINT( 5 ) NULL COMMENT 'ally invite id';
ALTER TABLE `%PREFIX%umsg` CHANGE `mtype` `mtype` TINYINT( 2 ) NULL DEFAULT NULL COMMENT '1 msg | 2 repo | 3 ally invite';
UPDATE `%PREFIX%conf` SET `sge_ver` =  '038' WHERE CONVERT( `sge_ver` USING utf8 ) =  '037' LIMIT 1 ;