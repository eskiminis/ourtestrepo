 CREATE TABLE `%PREFIX%t_research` (
`id` INT( 15 ) NOT NULL AUTO_INCREMENT ,
`name` VARCHAR( 25 ) NOT NULL ,
`c_res1` INT( 5 ) NOT NULL ,
`c_res2` INT( 5 ) NOT NULL ,
PRIMARY KEY ( `id` )
) ENGINE = MYISAM; 



CREATE TABLE `%PREFIX%tutorial` (
`id` INT( 10 ) NOT NULL AUTO_INCREMENT ,
`tittle` TEXT NOT NULL ,
`body` TEXT NOT NULL ,
`next_tut` INT( 10 ) NOT NULL DEFAULT '2',
PRIMARY KEY ( `id` )
) ENGINE = MYISAM;

INSERT INTO `%PREFIX%tutorial` (`id`, `tittle`, `body`, `next_tut`) VALUES (1, 'Welcome', 'Welcome to phpsge! this is the tutorrial', 2);

ALTER TABLE `%PREFIX%users` ADD `tut` BOOL NOT NULL DEFAULT '0';

ALTER TABLE `%PREFIX%ally` ADD `points` INT( 25 ) NOT NULL DEFAULT '0';

ALTER TABLE `%PREFIX%t_research` ADD `img` VARCHAR( 30 ) NOT NULL AFTER `name`;

INSERT INTO `%PREFIX%t_research` (`id`, `name`, `img`, `c_res1`, `c_res2`) VALUES (1, 'magic servant', 'null.gif', 50, 100);

 ALTER TABLE `%PREFIX%t_research` CHANGE `img` `img` VARCHAR( 30 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'null.gif'; 

UPDATE `%PREFIX%conf` SET `sge_ver` =  '016' WHERE CONVERT( `sge_ver` USING utf8 ) =  '015' LIMIT 1 ;