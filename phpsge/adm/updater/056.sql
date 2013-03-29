ALTER TABLE `%PREFIX%t_unt` ADD `res_car_cap` INT( 10 ) NOT NULL DEFAULT '10' COMMENT 'max quantity of carryable resource (is random resource)' AFTER `vel` ;

ALTER TABLE `%PREFIX%cmsg` DROP `color`;

ALTER TABLE `%PREFIX%cmsg` CHANGE `msg` `msg` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;

UPDATE `%PREFIX%conf` SET `sge_ver` =  '057' WHERE CONVERT( `sge_ver` USING utf8 ) =  '056' LIMIT 1 ;