ALTER TABLE `%PREFIX%resdata` CHANGE `prod_rate` `prod_rate` DOUBLE NOT NULL DEFAULT '1';

ALTER TABLE `%PREFIX%resdata` CHANGE `start` `start` TINYINT( 6 ) NOT NULL DEFAULT '100';

UPDATE `%PREFIX%conf` SET `sge_ver` =  '036' WHERE CONVERT( `sge_ver` USING utf8 ) =  '035' LIMIT 1 ;