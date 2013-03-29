ALTER TABLE `%PREFIX%t_research` ADD `time` INT( 32 ) NOT NULL DEFAULT '0';

CREATE TABLE `%PREFIX%rque` (
  `id` INT( 25 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  `usr` INT( 25 ) NOT NULL ,
  `res_id` INT( 10 ) NOT NULL ,
  `end` INT( 20 ) NOT NULL
) ENGINE = MYISAM;

UPDATE `%PREFIX%conf` SET `sge_ver` =  '044' WHERE CONVERT( `sge_ver` USING utf8 ) =  '043' LIMIT 1 ;