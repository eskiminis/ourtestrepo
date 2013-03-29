ALTER TABLE `%PREFIX%t_builds` CHANGE `time` `time` INT( 30 ) NOT NULL DEFAULT '0';

UPDATE `%PREFIX%conf` SET `sge_ver` =  '045' WHERE CONVERT( `sge_ver` USING utf8 ) =  '044' LIMIT 1 ;