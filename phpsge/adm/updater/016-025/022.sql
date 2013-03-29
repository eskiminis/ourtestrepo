ALTER TABLE `%PREFIX%units` CHANGE `action` `action` INT( 5 ) NOT NULL DEFAULT '0' COMMENT '0 unit in the city | 1 atack | 2 rinforce | 3 return'; 
ALTER TABLE `%PREFIX%t_builds` ADD UNIQUE (`func`) ;
ALTER TABLE `%PREFIX%t_unt` CHANGE `name` `name` VARCHAR( 15 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
ALTER TABLE `%PREFIX%users` DROP `sessid`;  
ALTER TABLE `%PREFIX%users` ADD `lang` VARCHAR( 3 ) NOT NULL DEFAULT 'en' COMMENT 'laguage';

UPDATE `%PREFIX%conf` SET `sge_ver` =  '023' WHERE CONVERT( `sge_ver` USING utf8 ) =  '022' LIMIT 1 ;