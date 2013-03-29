UPDATE `%PREFIX%t_builds` SET `c_res1` =  '50' WHERE `id` =2 LIMIT 1 ;

INSERT INTO `%PREFIX%t_builds` (`id`, `name`, `func`, `img`, `desc`, `c_res1`, `c_res2`, `time`) VALUES (NULL, 'mana pool', 'res2', 'null.gif', 'mana pool', '50', '0', '');

UPDATE `%PREFIX%t_builds` SET `c_res1` =  '70' WHERE `t_builds`.`id` =1 LIMIT 1 ;

ALTER TABLE `%PREFIX%conf` ADD `start_res1` INT( 5 ) NOT NULL DEFAULT '100' AFTER `prr2` ,
ADD `start_res2` INT( 5 ) NOT NULL DEFAULT '100' AFTER `start_res1` ;

UPDATE `%PREFIX%t_unt` SET `img` =  'milita.gif' WHERE `id` =1 LIMIT 1 ;

UPDATE `%PREFIX%conf` SET `sge_ver` =  '013' WHERE CONVERT( `sge_ver` USING utf8 ) =  '012' LIMIT 1 ;