CREATE TABLE %PREFIX%plugins (
  `name` varchar(20) NOT NULL,
  `file` varchar(11) NOT NULL COMMENT '.php',
  active tinyint(1) NOT NULL default '0' COMMENT '0 no - 1 yes'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO %PREFIX%plugins VALUES ('fbplug', 'facebook', 0);

UPDATE `%PREFIX%conf` SET `sge_ver` =  '033' WHERE CONVERT( `sge_ver` USING utf8 ) =  '032' LIMIT 1 ;

ALTER TABLE `%PREFIX%t_unt` CHANGE `race` `race` INT( 5 ) NOT NULL DEFAULT '1' COMMENT '0 all races'; 