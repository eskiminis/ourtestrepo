 CREATE TABLE `%PREFIX%rulers` (
`text` TEXT NOT NULL
) ENGINE = MYISAM;

ALTER TABLE `%PREFIX%ally` CHANGE `desc` `desc` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;  

ALTER TABLE `%PREFIX%umsg` ADD `id` INT( 5 ) NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST ;

ALTER TABLE `%PREFIX%bque` CHANGE `func` `bud_id` INT( 10 ) NOT NULL;  

ALTER TABLE `%PREFIX%bque` DROP `lv`;

UPDATE `%PREFIX%conf` SET `sge_ver` =  '027' WHERE CONVERT( `sge_ver` USING utf8 ) =  '026' LIMIT 1 ;

UPDATE `%PREFIX%t_builds` SET `time` = '15' WHERE `id` =2 LIMIT 1 ;

UPDATE `%PREFIX%t_builds` SET `time` = '30' WHERE `id` =1 LIMIT 1 ;

UPDATE `%PREFIX%t_builds` SET `time` = '15' WHERE `id` =3 LIMIT 1 ;