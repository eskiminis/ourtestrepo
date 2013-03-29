DROP TABLE IF EXISTS %PREFIX%resdata;
CREATE TABLE %PREFIX%resdata (
  id tinyint(1) NOT NULL auto_increment,
  `name` varchar(15) NOT NULL,
  prod_rate tinyint(3) NOT NULL default '1',
  `start` tinyint(3) NOT NULL default '100',
  PRIMARY KEY  (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

INSERT INTO %PREFIX%resdata VALUES (1, 'gold', 5, 100),(2, 'mana', 1, 100);

ALTER TABLE `%PREFIX%conf` DROP `res1`,DROP `prr1`,DROP `res2`,DROP `prr2`,DROP `start_res1`,DROP `start_res2`;

UPDATE `%PREFIX%conf` SET `sge_ver` =  '035' WHERE CONVERT( `sge_ver` USING utf8 ) =  '034' LIMIT 1 ;