ALTER TABLE `%PREFIX%t_research` ADD `req_bud` INT( 5 ) NOT NULL DEFAULT '0' COMMENT '0 no requisite need' AFTER `img` ,
ADD `rb_lev` INT( 5 ) NOT NULL DEFAULT '0' AFTER `req_bud` ,
ADD `req_res` INT( 5 ) NOT NULL DEFAULT '0' AFTER `rb_lev` ,
ADD `rr_lev` INT( 5 ) NOT NULL DEFAULT '0' AFTER `req_res` ;

ALTER TABLE `%PREFIX%ally` ADD `acess` SMALLINT( 1 ) NOT NULL DEFAULT '0' COMMENT '0 user can join ally, 1 user can make request, 2 only admin sends request';

UPDATE `%PREFIX%conf` SET `sge_ver` =  '026' WHERE CONVERT( `sge_ver` USING utf8 ) =  '025' LIMIT 1 ;


UPDATE `%PREFIX%t_builds` SET `req_bud` = '3',
`rb_lev` = '1' WHERE `id` =1 LIMIT 1 ;

UPDATE `%PREFIX%t_builds` SET `req_bud` = '2',
`rb_lev` = '1' WHERE `id` =3 LIMIT 1 ;

UPDATE `%PREFIX%t_builds` SET `req_bud` = '3',
`rb_lev` = '1' WHERE `id` =4 LIMIT 1 ;