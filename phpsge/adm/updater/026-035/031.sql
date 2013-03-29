UPDATE `%PREFIX%conf` SET `sge_ver` =  '032' WHERE CONVERT( `sge_ver` USING utf8 ) =  '031' LIMIT 1 ;

ALTER TABLE `%PREFIX%users` DROP `fbuid`;