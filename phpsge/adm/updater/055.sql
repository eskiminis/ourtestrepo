ALTER TABLE `%PREFIX%conf` ADD UNIQUE (`sge_ver`);

UPDATE `%PREFIX%t_builds` SET `res_mpl` = '0.25',`time_mpl` = '0.25' WHERE `time_mpl` >= '0.5';

UPDATE `%PREFIX%t_unt` SET `c_res1` = '25',`c_res2` = '3' WHERE `id` =1 LIMIT 1 ;

UPDATE `%PREFIX%conf` SET `sge_ver` =  '056' WHERE CONVERT( `sge_ver` USING utf8 ) =  '055' LIMIT 1 ;