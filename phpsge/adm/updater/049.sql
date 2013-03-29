ALTER TABLE `%PREFIX%users` CHANGE `active` `active` TINYINT( 1 ) NULL DEFAULT NULL;
UPDATE `%PREFIX%conf` SET `sge_ver` =  '050' WHERE CONVERT( `sge_ver` USING utf8 ) =  '049' LIMIT 1 ;