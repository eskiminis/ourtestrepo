ALTER TABLE `%PREFIX%ally` ADD `desc` TEXT NULL AFTER `name` ;

UPDATE `%PREFIX%conf` SET `sge_ver` =  '021' WHERE CONVERT( `sge_ver` USING utf8 ) =  '020' LIMIT 1 ;