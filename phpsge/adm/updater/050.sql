ALTER TABLE `%PREFIX%t_builds` ADD `time_mpl` double NOT NULL DEFAULT '0.5' COMMENT 'time moltiplier per level (max 1)' AFTER `time` ;
ALTER TABLE `%PREFIX%t_builds` ADD `res_mpl` double NOT NULL DEFAULT '0.5' COMMENT 'res moltiplier per level (max 1)' AFTER `desc` ;
ALTER TABLE `%PREFIX%t_builds` CHANGE `res_mpl` `res_mpl` DOUBLE UNSIGNED NOT NULL DEFAULT '0.5' COMMENT 'res moltiplier per level (max 1)',
CHANGE `time` `time` INT( 30 ) UNSIGNED NOT NULL DEFAULT '0',
CHANGE `time_mpl` `time_mpl` double UNSIGNED NOT NULL DEFAULT '0.5' COMMENT 'time moltiplier per level (max 1)';
ALTER TABLE `%PREFIX%conf` ADD `baru_tmdl` DOUBLE NOT NULL DEFAULT '0.25' COMMENT 'unit time divider per baraks level (max 1)' AFTER `rulers` ;
UPDATE `%PREFIX%conf` SET `sge_ver` =  '051' WHERE CONVERT( `sge_ver` USING utf8 ) =  '050' LIMIT 1 ;