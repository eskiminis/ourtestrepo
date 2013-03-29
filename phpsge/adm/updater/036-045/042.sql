ALTER TABLE `%PREFIX%plugins` ADD UNIQUE (`name`,`file`);
UPDATE `%PREFIX%conf` SET `sge_ver` =  '043' WHERE CONVERT( `sge_ver` USING utf8 ) =  '042' LIMIT 1 ;