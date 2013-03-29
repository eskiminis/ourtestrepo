 CREATE TABLE `%PREFIX%market` (
`id` INT( 5 ) NOT NULL DEFAULT '1',
`status` SMALLINT( 1 ) NOT NULL DEFAULT '0' COMMENT '0 open - 1 acepted',
`owner` INT( 5 ) NOT NULL ,
`acpter` INT( 5 ) NULL ,
`end` INT( 15 ) NULL COMMENT 'end',
`resoff` SMALLINT( 1 ) NOT NULL COMMENT 'id of the resource offered',
`resoqnt` INT( 15 ) NOT NULL COMMENT 'quantity offered',
`resreq` SMALLINT( 1 ) NOT NULL COMMENT 'res requested',
`resrqnt` VARCHAR( 15 ) NOT NULL COMMENT 'quantity reqested'
) ENGINE = MYISAM ;

ALTER TABLE `%PREFIX%market` ADD INDEX ( `id` );
ALTER TABLE `%PREFIX%market` CHANGE `id` `id` INT( 5 ) NOT NULL AUTO_INCREMENT;

ALTER TABLE `%PREFIX%market`
  DROP `status`,
  DROP `acpter`,
  DROP `end`;

CREATE TABLE `%PREFIX%resmov` (
`id` INT( 5 ) NOT NULL AUTO_INCREMENT ,
`to` INT( 5 ) NOT NULL ,
`end` INT( 10 ) NOT NULL DEFAULT '0',
`res_id` SMALLINT( 1 ) NOT NULL DEFAULT '1',
`resqnt` INT( 15 ) NOT NULL DEFAULT '0',
PRIMARY KEY ( `id` ) ,
INDEX ( `id` )
) ENGINE = MYISAM;

UPDATE `%PREFIX%conf` SET `sge_ver` =  '029' WHERE CONVERT( `sge_ver` USING utf8 ) =  '028' LIMIT 1 ;