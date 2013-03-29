ALTER TABLE `%PREFIX%t_research`
  DROP `req_bud`,
  DROP `rb_lev`,
  DROP `req_res`,
  DROP `rr_lev`;

ALTER TABLE `%PREFIX%t_research` ADD `req_bud` INT( 5 ) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0 no requisite need',
ADD `rb_lev` INT( 5 ) UNSIGNED NOT NULL DEFAULT '0',
ADD `req_res` INT( 5 ) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0 no requisite need',
ADD `rr_lev` INT( 5 ) UNSIGNED NOT NULL DEFAULT '0',
ADD `gpoints` MEDIUMINT( 5 ) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'given points';

UPDATE `%PREFIX%conf` SET `sge_ver` =  '048' WHERE CONVERT( `sge_ver` USING utf8 ) =  '047' LIMIT 1 ;