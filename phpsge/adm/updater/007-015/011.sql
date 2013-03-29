ALTER TABLE `%PREFIX%t_builds` ADD `c_res2` INT( 10 ) NOT NULL AFTER `c_res1` ;

ALTER TABLE `%PREFIX%t_builds` CHANGE `desc` `desc` TINYTEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ,
CHANGE `c_res1` `c_res1` INT( 10 ) NOT NULL DEFAULT '0',
CHANGE `c_res2` `c_res2` INT( 10 ) NOT NULL DEFAULT '0' ;

ALTER TABLE `%PREFIX%t_unt` CHANGE `cres1` `c_res1` INT( 5 ) NOT NULL DEFAULT '0';

ALTER TABLE `%PREFIX%t_unt` ADD `c_res2` INT( 5 ) NOT NULL DEFAULT '0' AFTER `c_res1` ;

ALTER TABLE `%PREFIX%users` ADD `points` INT( 15 ) NULL DEFAULT '0' AFTER `timestamp` ;

UPDATE `%PREFIX%t_builds` SET `img` =  'barraks.gif' WHERE `id` =1 LIMIT 1 ;

UPDATE `%PREFIX%conf` SET `sge_ver` =  '012' WHERE CONVERT( `sge_ver` USING utf8 ) =  '011' LIMIT 1 ;