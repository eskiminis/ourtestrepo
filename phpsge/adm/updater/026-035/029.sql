UPDATE `%PREFIX%conf` SET `sge_ver` =  '030' WHERE CONVERT( `sge_ver` USING utf8 ) =  '029' LIMIT 1 ;

ALTER TABLE `%PREFIX%t_builds` ADD `gpoints` MEDIUMINT( 5 ) NOT NULL DEFAULT '0' COMMENT 'given points';

ALTER TABLE `%PREFIX%city` DROP `wref`; 

UPDATE `%PREFIX%t_builds` SET `gpoints` = '10' WHERE `id` =2 LIMIT 1 ;

UPDATE `%PREFIX%t_builds` SET `gpoints` = '15' WHERE `id` =1 LIMIT 1 ;

UPDATE `%PREFIX%t_builds` SET `gpoints` = '10' WHERE `id` =3 LIMIT 1 ;

UPDATE `%PREFIX%t_builds` SET `gpoints` = '25' WHERE `id` =4 LIMIT 1 ;