ALTER TABLE `%PREFIX%users` CHANGE `points` `points` INT( 6 ) NULL DEFAULT '0';

ALTER TABLE `%PREFIX%ally` CHANGE `id` `id` INT( 5 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE `owner` `owner` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0',
CHANGE `points` `points` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0',
CHANGE `acess` `acess` TINYINT( 1 ) NOT NULL DEFAULT '0' COMMENT '0 user can join ally, 1 user can make request, 2 only admin sends request';

ALTER TABLE `%PREFIX%bque` CHANGE `id` `id` INT( 15 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE `city` `city` INT( 15 ) UNSIGNED NULL DEFAULT '0';

ALTER TABLE `%PREFIX%builds` CHANGE `id` `id` INT( 15 ) UNSIGNED NOT NULL ,
CHANGE `lev` `lev` INT( 5 ) UNSIGNED NOT NULL ,
CHANGE `planet` `planet` INT( 15 ) UNSIGNED NOT NULL;

ALTER TABLE `%PREFIX%city` CHANGE `id` `id` INT( 15 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE `owner` `owner` INT( 15 ) UNSIGNED NOT NULL;

ALTER TABLE `%PREFIX%market` CHANGE `id` `id` INT( 5 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE `owner` `owner` INT( 10 ) UNSIGNED NOT NULL ,
CHANGE `resoff` `resoff` SMALLINT( 1 ) UNSIGNED NOT NULL COMMENT 'id of the resource offered',
CHANGE `resoqnt` `resoqnt` INT( 15 ) UNSIGNED NOT NULL COMMENT 'quantity offered',
CHANGE `resreq` `resreq` SMALLINT( 1 ) UNSIGNED NOT NULL COMMENT 'res requested',
CHANGE `resrqnt` `resrqnt` INT( 15 ) UNSIGNED NOT NULL COMMENT 'quantity reqested';

ALTER TABLE `%PREFIX%races` CHANGE `id` `id` SMALLINT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `%PREFIX%resdata` CHANGE `id` `id` TINYINT( 1 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE `prod_rate` `prod_rate` DOUBLE UNSIGNED NOT NULL DEFAULT '1',
CHANGE `start` `start` INT( 6 ) UNSIGNED NOT NULL DEFAULT '300';

ALTER TABLE `%PREFIX%research` CHANGE `id_res` `id_res` INT( 5 ) UNSIGNED NOT NULL DEFAULT '0',
CHANGE `usr` `usr` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0',
CHANGE `lev` `lev` INT( 5 ) UNSIGNED NOT NULL DEFAULT '1';

ALTER TABLE `%PREFIX%resmov` CHANGE `id` `id` INT( 5 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE `to` `to` INT( 5 ) UNSIGNED NOT NULL ,
CHANGE `res_id` `res_id` SMALLINT( 1 ) UNSIGNED NOT NULL DEFAULT '1',
CHANGE `resqnt` `resqnt` INT( 15 ) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `%PREFIX%rque` CHANGE `id` `id` INT( 15 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE `usr` `usr` INT( 15 ) UNSIGNED NOT NULL ,
CHANGE `res_id` `res_id` INT( 10 ) UNSIGNED NOT NULL;

ALTER TABLE `%PREFIX%tutorial` CHANGE `id` `id` INT( 5 ) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `%PREFIX%t_builds` CHANGE `id` `id` INT( 15 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE `req_bud` `req_bud` INT( 5 ) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0 no requisite need',
CHANGE `rb_lev` `rb_lev` INT( 5 ) UNSIGNED NOT NULL DEFAULT '0',
CHANGE `req_res` `req_res` INT( 5 ) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0 no requisite need',
CHANGE `rr_lev` `rr_lev` INT( 5 ) UNSIGNED NOT NULL DEFAULT '0',
CHANGE `gpoints` `gpoints` MEDIUMINT( 5 ) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'given points';

ALTER TABLE `%PREFIX%t_research` CHANGE `id` `id` INT( 15 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE `arac` `arac` INT( 5 ) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0 = all races',
CHANGE `req_bud` `req_bud` INT( 5 ) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0 no requisite need',
CHANGE `rb_lev` `rb_lev` INT( 5 ) UNSIGNED NOT NULL DEFAULT '0',
CHANGE `req_res` `req_res` INT( 5 ) UNSIGNED NOT NULL DEFAULT '0',
CHANGE `rr_lev` `rr_lev` INT( 5 ) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `%PREFIX%t_unt` CHANGE `id` `id` INT( 15 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE `race` `race` INT( 5 ) UNSIGNED NOT NULL DEFAULT '1' COMMENT '0 all races',
CHANGE `atk` `atk` INT( 5 ) UNSIGNED NOT NULL DEFAULT '5',
CHANGE `dif` `dif` INT( 5 ) UNSIGNED NOT NULL DEFAULT '5',
CHANGE `vel` `vel` INT( 5 ) UNSIGNED NOT NULL DEFAULT '5',
CHANGE `req_bud` `req_bud` INT( 5 ) UNSIGNED NOT NULL ,
CHANGE `rb_lev` `rb_lev` INT( 5 ) UNSIGNED NOT NULL ,
CHANGE `req_res` `req_res` INT( 5 ) UNSIGNED NOT NULL ,
CHANGE `rr_lev` `rr_lev` INT( 5 ) UNSIGNED NOT NULL;

ALTER TABLE `%PREFIX%umsg` CHANGE `id` `id` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE `from` `from` INT( 15 ) UNSIGNED NOT NULL ,
CHANGE `to` `to` INT( 15 ) UNSIGNED NOT NULL ,
CHANGE `read` `read` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '0',
CHANGE `mtype` `mtype` TINYINT( 2 ) UNSIGNED NULL DEFAULT NULL COMMENT '1 msg | 2 repo | 3 ally invite',
CHANGE `aiid` `aiid` SMALLINT( 5 ) UNSIGNED NULL DEFAULT NULL COMMENT 'ally invite id';

ALTER TABLE `%PREFIX%units` CHANGE `id` `id` INT( 15 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE `id_unt` `id_unt` INT( 15 ) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'id unità',
CHANGE `uqnt` `uqnt` INT( 5 ) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'quante unità',
CHANGE `owner_id` `owner_id` INT( 30 ) UNSIGNED NOT NULL DEFAULT '0',
CHANGE `from` `from` INT( 15 ) UNSIGNED NULL DEFAULT NULL ,
CHANGE `to` `to` INT( 15 ) UNSIGNED NULL DEFAULT NULL ,
CHANGE `where` `where` INT( 15 ) UNSIGNED NULL DEFAULT NULL ,
CHANGE `action` `action` INT( 5 ) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0 unit in the city | 1 atack | 2 rinforce | 3 return';

ALTER TABLE `%PREFIX%uque` CHANGE `id` `id` INT( 15 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE `id_unt` `id_unt` INT( 15 ) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'id unità',
CHANGE `uqnt` `uqnt` INT( 5 ) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'quante unità',
CHANGE `planet` `planet` INT( 15 ) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `%PREFIX%users` CHANGE `id` `id` INT( 15 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE `race` `race` INT( 5 ) UNSIGNED NOT NULL DEFAULT '0',
CHANGE `capcity` `capcity` INT( 15 ) UNSIGNED NOT NULL ,
CHANGE `ally_id` `ally_id` INT( 15 ) UNSIGNED NOT NULL DEFAULT '0',
CHANGE `points` `points` INT( 6 ) UNSIGNED NULL DEFAULT '0',
CHANGE `rank` `rank` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'max is 3';

UPDATE `%PREFIX%conf` SET `sge_ver` =  '047' WHERE CONVERT( `sge_ver` USING utf8 ) =  '046' LIMIT 1 ;

REPAIR TABLE `%PREFIX%ally` , `%PREFIX%bque` , `%PREFIX%builds` , `%PREFIX%city` , `%PREFIX%cmsg` , `%PREFIX%conf` , `%PREFIX%market` , `%PREFIX%plugins` , `%PREFIX%races` , `%PREFIX%resdata` , `%PREFIX%research` , `%PREFIX%resmov` , `%PREFIX%rque` , `%PREFIX%tutorial` , `%PREFIX%t_builds` , `%PREFIX%t_research` , `%PREFIX%t_unt` , `%PREFIX%umsg` , `%PREFIX%units` , `%PREFIX%uque` , `%PREFIX%users`;
OPTIMIZE TABLE `%PREFIX%ally` , `%PREFIX%bque` , `%PREFIX%builds` , `%PREFIX%city` , `%PREFIX%cmsg` , `%PREFIX%conf` , `%PREFIX%market` , `%PREFIX%plugins` , `%PREFIX%races` , `%PREFIX%resdata` , `%PREFIX%research` , `%PREFIX%resmov` , `%PREFIX%rque` , `%PREFIX%tutorial` , `%PREFIX%t_builds` , `%PREFIX%t_research` , `%PREFIX%t_unt` , `%PREFIX%umsg` , `%PREFIX%units` , `%PREFIX%uque` , `%PREFIX%users`;