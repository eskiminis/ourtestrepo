CREATE TABLE `%PREFIX%ally_pact` (
`ally1` INT( 5 ) NOT NULL ,
`ally2` INT( 5 ) NOT NULL ,
`type` TINYINT( 1 ) NOT NULL COMMENT '0 WAR, 1 NAP, 2 ALLY'
) ENGINE = MYISAM;
ALTER TABLE `%PREFIX%ally_pact` ADD `status` BOOL NOT NULL COMMENT '0 waiting, 1 confermed';
UPDATE `%PREFIX%conf` SET `sge_ver` =  '052' WHERE CONVERT( `sge_ver` USING utf8 ) =  '051' LIMIT 1 ;