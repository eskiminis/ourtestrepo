ALTER TABLE `%PREFIX%bque` ADD `func` VARCHAR( 15 ) NOT NULL AFTER `city` ;

ALTER TABLE `%PREFIX%umsg` ADD `mtit` VARCHAR( 15 ) NULL AFTER `to` ;  

ALTER TABLE `%PREFIX%bque` CHANGE `constr` `constr` VARCHAR( 15 ) NOT NULL;

ALTER TABLE `%PREFIX%builds` CHANGE `id` `id` INT( 15 ) NOT NULL AUTO_INCREMENT;

ALTER TABLE `%PREFIX%builds` ADD UNIQUE (`func`);

ALTER TABLE `%PREFIX%uque` ADD `id_unt` INT( 15 ) NOT NULL DEFAULT '0' COMMENT 'id unità' AFTER `id` ,
ADD `%PREFIX%uqnt` INT( 5 ) NOT NULL DEFAULT '0' COMMENT 'quante unità' AFTER `id_unt` ;

ALTER TABLE `%PREFIX%units` ADD `id_unt` INT( 15 ) NOT NULL DEFAULT '0' COMMENT 'id unità' AFTER `id` ,
ADD `%PREFIX%uqnt` INT( 5 ) NOT NULL DEFAULT '0' COMMENT 'quante unità' AFTER `id_unt` ;

UPDATE `%PREFIX%conf` SET `sge_ver` =  '015' WHERE CONVERT( `sge_ver` USING utf8 ) =  '014' LIMIT 1 ;
