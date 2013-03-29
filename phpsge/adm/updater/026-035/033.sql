ALTER TABLE `%PREFIX%t_unt` ADD `type` VARCHAR( 15 ) NULL COMMENT 'type of unit: archer etc.',
ADD `req_bud` INT( 5 ) NOT NULL ,
ADD `rb_lev` INT( 5 ) NOT NULL ,
ADD `req_res` INT( 5 ) NOT NULL ,
ADD `rr_lev` INT( 5 ) NOT NULL ;

ALTER TABLE `%PREFIX%umsg` ADD `mtype` VARCHAR( 15 ) NULL COMMENT 'message type: report, msg, allyi';

UPDATE `%PREFIX%conf` SET `sge_ver` =  '034' WHERE CONVERT( `sge_ver` USING utf8 ) =  '033' LIMIT 1 ;