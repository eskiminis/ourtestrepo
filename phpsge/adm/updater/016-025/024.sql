CREATE TABLE %PREFIX%research (
  id_res int(5) NOT NULL default '0',
  usr int(10) NOT NULL default '0',
  lev int(5) NOT NULL default '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS %PREFIX%t_research;

CREATE TABLE %PREFIX%t_research (
  id int(15) NOT NULL auto_increment,
  `name` varchar(25) NOT NULL,
  arac int(5) NOT NULL default '0' COMMENT '0 = all races',
  img varchar(30) NOT NULL default 'null.gif',
  c_res1 int(5) NOT NULL,
  c_res2 int(5) NOT NULL,
  PRIMARY KEY  (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

INSERT INTO %PREFIX%t_research VALUES(1, 'magic servant', 0, 'null.gif', 50, 100);
INSERT INTO `%PREFIX%t_builds` VALUES (NULL, 'Research Lab', 'reslab', 'null.gif', NULL, '100', '20', '50');

ALTER TABLE `%PREFIX%t_builds` ADD `req_bud` INT( 5 ) NOT NULL DEFAULT '0' COMMENT '0 no requisite need',
ADD `rb_lev` INT( 5 ) NOT NULL DEFAULT '0',
ADD `req_res` INT( 5 ) NOT NULL DEFAULT '0' COMMENT '0 no requisite need',
ADD `rr_lev` INT( 5 ) NOT NULL DEFAULT '0';

-- need for builds fix!
ALTER TABLE `%PREFIX%builds` CHANGE `id` `id` INT( 15 ) NOT NULL;
ALTER TABLE `%PREFIX%builds` DROP PRIMARY KEY;  
ALTER TABLE `%PREFIX%builds` DROP INDEX `func`  

UPDATE `%PREFIX%conf` SET `sge_ver` =  '025' WHERE CONVERT( `sge_ver` USING utf8 ) =  '024' LIMIT 1 ;