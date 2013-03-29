 CREATE TABLE `%PREFIX%uque` (
`id` INT( 20 ) NOT NULL AUTO_INCREMENT ,
`planet` INT( 15 ) NOT NULL DEFAULT '0',
`end` VARCHAR( 15 ) NOT NULL DEFAULT '0',
PRIMARY KEY ( `id` ) ,
INDEX ( `id` )
) ENGINE = MYISAM; 

ALTER TABLE `%PREFIX%t_unt` CHANGE `cost_oro` `cres1` INT( 5 ) NOT NULL DEFAULT '3';

UPDATE `%PREFIX%conf` SET `sge_ver` =  '009' WHERE CONVERT( `sge_ver` USING utf8 ) =  '008' LIMIT 1 ;
