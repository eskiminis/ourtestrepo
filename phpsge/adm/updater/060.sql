ALTER TABLE  `conf` ADD  `rumax_ver` VARCHAR( 5 ) NOT NULL DEFAULT  '0651';
UPDATE `%PREFIX%conf` SET `sge_ver` =  '061' WHERE CONVERT( `sge_ver` USING utf8 ) =  '060' LIMIT 1 ;