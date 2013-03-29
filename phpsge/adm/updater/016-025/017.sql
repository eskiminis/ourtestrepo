UPDATE `%PREFIX%conf` SET `sge_ver` =  '018' WHERE CONVERT( `sge_ver` USING utf8 ) =  '017' LIMIT 1 ;

UPDATE `%PREFIX%t_builds` SET `img` =  'mine.gif' WHERE `id` =2 LIMIT 1 ;

UPDATE `%PREFIX%t_builds` SET `img` =  'node.gif' WHERE `id` =3 LIMIT 1 ;