-- sql for map system 2. --

CREATE TABLE %PREFIX%map (
  x int(10) unsigned NOT NULL default '0',
  y int(10) unsigned NOT NULL default '0',
  `type` varchar(10) NOT NULL default '0',
  city int(10) unsigned NOT NULL default '0',
  UNIQUE KEY Index_1 (x,y,city)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;





