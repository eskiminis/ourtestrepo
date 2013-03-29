ALTER TABLE `%PREFIX%city` ADD `res2` DOUBLE NOT NULL DEFAULT '0' AFTER `res1` ;

ALTER TABLE `%PREFIX%conf` ADD `res2` VARCHAR( 10 ) NOT NULL AFTER `prr1` ,
ADD `prr2` INT( 10 ) NOT NULL DEFAULT '0' AFTER `res2` ;

UPDATE `%PREFIX%conf` SET `res2` =  'mana' LIMIT 1 ;


ALTER TABLE `%PREFIX%conf` CHANGE `sge_ver` `sge_ver` VARCHAR( 5 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '011' 
UPDATE `%PREFIX%conf` SET `sge_ver` =  '011' WHERE CONVERT( `sge_ver` USING utf8 ) =  '010' LIMIT 1 ;