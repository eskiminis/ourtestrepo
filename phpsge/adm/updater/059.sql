ALTER TABLE `%PREFIX%cmsg` ADD `usrid` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0' AFTER `username` ;
UPDATE `%PREFIX%conf` SET `sge_ver` =  '060' WHERE CONVERT( `sge_ver` USING utf8 ) =  '059' LIMIT 1 ;