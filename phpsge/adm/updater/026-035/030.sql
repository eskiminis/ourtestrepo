ALTER TABLE `%PREFIX%users` CHANGE `tut` `tut` TINYINT( 1 ) NOT NULL DEFAULT '1';

UPDATE `%PREFIX%conf` SET `sge_ver` =  '031' WHERE CONVERT( `sge_ver` USING utf8 ) =  '030' LIMIT 1 ;

INSERT INTO `%PREFIX%rulers` (`text`) VALUES ('your rulers here');