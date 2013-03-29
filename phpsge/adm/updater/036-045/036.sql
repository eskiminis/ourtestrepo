UPDATE `%PREFIX%conf` SET `sge_ver` =  '037' WHERE CONVERT( `sge_ver` USING utf8 ) =  '036' LIMIT 1 ;

ALTER TABLE `%PREFIX%map` CHANGE `type` `type` VARCHAR( 10 ) NOT NULL DEFAULT '0';