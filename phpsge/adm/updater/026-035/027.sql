ALTER TABLE `%PREFIX%umsg` ADD `mtype` TINYINT( 1 ) NOT NULL DEFAULT '0' COMMENT '0 user to user msg - 2 battle report - 3 ally invitation';

UPDATE `%PREFIX%conf` SET `sge_ver` =  '028' WHERE CONVERT( `sge_ver` USING utf8 ) =  '027' LIMIT 1 ;