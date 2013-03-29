CREATE TABLE %PREFIX%ally (
  id int(5) unsigned NOT NULL auto_increment,
  `name` varchar(25) collate utf8_unicode_ci NOT NULL,
  `desc` longtext collate utf8_unicode_ci NOT NULL,
  owner int(10) unsigned NOT NULL default '0',
  points int(10) unsigned NOT NULL default '0',
  acess tinyint(1) NOT NULL default '0' COMMENT '0 user can join ally, 1 user can make request, 2 only admin sends request',
  PRIMARY KEY  (id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE %PREFIX%ally_pact (
  ally1 int(5) NOT NULL,
  ally2 int(5) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '0 WAR, 1 NAP, 2 ALLY',
  `status` tinyint(1) NOT NULL COMMENT '0 waiting, 1 confirmed'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE %PREFIX%bque (
  id int(15) unsigned NOT NULL auto_increment,
  city int(15) unsigned default '0',
  bud_id int(10) NOT NULL,
  `end` int(20) default '0',
  PRIMARY KEY  (id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE %PREFIX%builds (
  id int(15) unsigned NOT NULL,
  lev int(5) unsigned NOT NULL,
  planet int(15) unsigned NOT NULL,
  func varchar(15) collate utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE %PREFIX%city (
  id int(15) unsigned NOT NULL auto_increment,
  owner int(15) unsigned NOT NULL,
  `name` varchar(30) collate utf8_unicode_ci NOT NULL,
  pop smallint(3) NOT NULL default '100',
  res1 double NOT NULL default '0',
  res2 double NOT NULL default '0',
  res3 double NOT NULL default '0',
  last_update int(20) NOT NULL,
  galaxy int(15) NOT NULL default '0',
  system int(15) NOT NULL default '0',
  pos int(15) NOT NULL default '0',
  img varchar(50) collate utf8_unicode_ci NOT NULL default 'null.gif',
  PRIMARY KEY  (id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE %PREFIX%cmsg (
  id int(10) unsigned NOT NULL auto_increment,
  username varchar(255) collate utf8_unicode_ci default NULL,
  usrid int(10) unsigned NOT NULL default '0',
  msg longtext collate utf8_unicode_ci NOT NULL,
  sent_on timestamp NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE %PREFIX%conf (
  news1 longtext collate utf8_unicode_ci,
  rulers longtext collate utf8_unicode_ci,
  baru_tmdl double NOT NULL default '0.25' COMMENT 'unit time divider per baraks level (max 1)',
  sge_ver varchar(5) collate utf8_unicode_ci NOT NULL default '0701',
  UNIQUE KEY sge_ver (sge_ver)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE %PREFIX%market (
  id int(5) unsigned NOT NULL auto_increment,
  owner int(10) unsigned NOT NULL,
  resoff smallint(1) unsigned NOT NULL COMMENT 'id of the offered resource',
  resoqnt int(15) unsigned NOT NULL COMMENT 'quantity offered',
  resreq smallint(1) unsigned NOT NULL COMMENT 'res requested',
  resrqnt int(15) unsigned NOT NULL COMMENT 'quantity reqested',
  KEY id (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE %PREFIX%plugins (
  `name` varchar(20) collate utf8_unicode_ci NOT NULL,
  `file` varchar(11) collate utf8_unicode_ci NOT NULL COMMENT '.php',
  active tinyint(1) NOT NULL default '0' COMMENT '0-no; 1-yes',
  `group` varchar(15) collate utf8_unicode_ci default NULL,
  UNIQUE KEY `name` (`name`,`file`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE %PREFIX%races (
  id smallint(10) unsigned NOT NULL auto_increment,
  rname varchar(30) collate utf8_unicode_ci NOT NULL default 'x',
  rdesc longtext collate utf8_unicode_ci NOT NULL,
  img varchar(30) collate utf8_unicode_ci NOT NULL default 'null.gif',
  PRIMARY KEY  (id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE %PREFIX%resdata (
  id tinyint(1) unsigned NOT NULL auto_increment,
  `name` varchar(30) collate utf8_unicode_ci NOT NULL,
  prod_rate double unsigned NOT NULL default '1',
  `start` int(6) unsigned NOT NULL default '300',
  ico varchar(15) collate utf8_unicode_ci default NULL COMMENT 'res ico',
  PRIMARY KEY  (id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE %PREFIX%research (
  id_res int(5) unsigned NOT NULL default '0',
  usr int(10) unsigned NOT NULL default '0',
  lev int(5) unsigned NOT NULL default '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE %PREFIX%resmov (
  id int(5) unsigned NOT NULL auto_increment,
  `to` int(5) unsigned NOT NULL,
  `end` int(10) NOT NULL default '0',
  res_id smallint(1) unsigned NOT NULL default '1',
  resqnt int(15) unsigned NOT NULL default '0',
  KEY id (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE %PREFIX%rque (
  id int(15) unsigned NOT NULL auto_increment,
  usr int(15) unsigned NOT NULL,
  res_id int(10) unsigned NOT NULL,
  `end` int(20) NOT NULL,
  PRIMARY KEY  (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE %PREFIX%tutorial (
  id int(5) unsigned NOT NULL auto_increment,
  tittle text collate utf8_unicode_ci NOT NULL,
  body text collate utf8_unicode_ci NOT NULL,
  next_tut int(10) NOT NULL default '2',
  PRIMARY KEY  (id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE %PREFIX%t_builds (
  id int(15) unsigned NOT NULL auto_increment,
  arac int(5) unsigned NOT NULL default '1',
  `name` varchar(30) collate utf8_unicode_ci NOT NULL default 'Baraks',
  func varchar(35) collate utf8_unicode_ci NOT NULL default 'barraks',
  img varchar(30) collate utf8_unicode_ci NOT NULL default 'null.gif',
  `desc` longtext collate utf8_unicode_ci,
  pop_req smallint(3) NOT NULL default '0' COMMENT 'pop requested',
  pop_mpl double NOT NULL default '0' COMMENT 'pop moltiplier per level',
  res_mpl double unsigned NOT NULL default '0.5' COMMENT 'res moltiplier per level (max 1)',
  c_res1 int(10) NOT NULL default '0',
  c_res2 int(10) NOT NULL default '0',
  c_res3 int(10) NOT NULL default '0',
  `time` int(30) unsigned NOT NULL default '0',
  time_mpl double unsigned NOT NULL default '0.5' COMMENT 'time moltiplier per level (max 1)',
  req_bud int(5) unsigned NOT NULL default '0' COMMENT '0-no requisite need',
  rb_lev int(5) unsigned NOT NULL default '0',
  req_res int(5) unsigned NOT NULL default '0' COMMENT '0-no requisite need',
  rr_lev int(5) unsigned NOT NULL default '0',
  gpoints mediumint(5) unsigned NOT NULL default '0' COMMENT 'given points',
  maxlev int(3) NOT NULL default '0' COMMENT '0-no max level',
  PRIMARY KEY  (id),
  UNIQUE KEY func (func)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE %PREFIX%t_research (
  id int(15) unsigned NOT NULL auto_increment,
  `name` varchar(25) collate utf8_unicode_ci NOT NULL,
  `desc` longtext collate utf8_unicode_ci default NULL,
  arac int(5) unsigned NOT NULL default '0' COMMENT '0-all races',
  img varchar(30) collate utf8_unicode_ci NOT NULL default 'null.gif',
  c_res1 int(5) NOT NULL,
  c_res2 int(5) NOT NULL,
  c_res3 int(10) NOT NULL default '0',
  `time` int(32) NOT NULL default '0',
  req_bud int(5) unsigned NOT NULL default '0' COMMENT '0-no requisite need',
  rb_lev int(5) unsigned NOT NULL default '0',
  req_res int(5) unsigned NOT NULL default '0' COMMENT '0-no requisite need',
  rr_lev int(5) unsigned NOT NULL default '0',
  gpoints mediumint(5) unsigned NOT NULL default '0' COMMENT 'given points',
  PRIMARY KEY  (id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE %PREFIX%t_unt (
  id int(15) unsigned NOT NULL auto_increment,
  `name` varchar(15) collate utf8_unicode_ci NOT NULL,
  race int(5) unsigned NOT NULL default '1' COMMENT '0-all races',
  img varchar(30) collate utf8_unicode_ci NOT NULL default 'null.gif',
  atk int(5) unsigned NOT NULL default '5',
  dif int(5) unsigned NOT NULL default '5',
  vel int(5) unsigned NOT NULL default '5',
  res_car_cap int(10) NOT NULL default '10' COMMENT 'max quantity of carryable resource (is random resource)',
  pop_req smallint(3) NOT NULL default '0' COMMENT 'pop requested',
  c_res1 int(5) NOT NULL default '0',
  c_res2 int(5) NOT NULL default '0',
  c_res3 int(10) NOT NULL default '0',
  etime int(10) NOT NULL,
  `desc` text collate utf8_unicode_ci NOT NULL,
  `type` varchar(15) collate utf8_unicode_ci default NULL COMMENT 'type of unit: archer etc.',
  req_bud int(5) unsigned NOT NULL,
  rb_lev int(5) unsigned NOT NULL,
  req_res int(5) unsigned NOT NULL,
  rr_lev int(5) unsigned NOT NULL,
  PRIMARY KEY  (id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE %PREFIX%umsg (
  id int(10) unsigned NOT NULL auto_increment,
  `from` int(15) unsigned NOT NULL,
  `to` int(15) unsigned NOT NULL,
  mtit varchar(15) collate utf8_unicode_ci default NULL,
  `text` longtext collate utf8_unicode_ci NOT NULL,
  `read` tinyint(1) unsigned NOT NULL default '0',
  mtype tinyint(2) unsigned NOT NULL COMMENT '0 sys msg | 1 msg | 2 repo | 3 ally invite',
  aiid smallint(5) unsigned default NULL COMMENT 'ally invite id',
  PRIMARY KEY  (id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE %PREFIX%units (
  id int(15) unsigned NOT NULL auto_increment,
  id_unt int(15) unsigned NOT NULL default '0' COMMENT 'unit id',
  uqnt int(5) unsigned NOT NULL default '0' COMMENT 'unit quante',
  owner_id int(30) unsigned NOT NULL default '0',
  `from` int(15) unsigned default NULL,
  `to` int(15) unsigned default NULL,
  `where` int(15) unsigned default NULL,
  `time` int(35) default '0',
  `action` int(5) unsigned NOT NULL default '0' COMMENT '0 unit in the city | 1 atack | 2 rinforce | 3 return',
  PRIMARY KEY  (id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE %PREFIX%uque (
  id int(15) unsigned NOT NULL auto_increment,
  id_unt int(15) unsigned NOT NULL default '0' COMMENT 'id unità',
  uqnt int(5) unsigned NOT NULL default '0' COMMENT 'quante unità',
  planet int(15) unsigned NOT NULL default '0',
  `end` int(15) NOT NULL default '0',
  KEY id (id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE %PREFIX%users (
  id int(15) unsigned NOT NULL auto_increment,
  username varchar(20) collate utf8_unicode_ci NOT NULL,
  `password` varchar(32) collate utf8_unicode_ci NOT NULL default '0',
  race int(5) unsigned NOT NULL default '0',
  capcity int(15) unsigned NOT NULL,
  ally_id int(15) unsigned NOT NULL default '0',
  email varchar(30) collate utf8_unicode_ci NOT NULL,
  timestamp_reg int(11) NOT NULL,
  points int(6) unsigned default '0',
  rank tinyint(1) unsigned NOT NULL default '0' COMMENT 'max is 3',
  active tinyint(1) default NULL,
  banned tinyint(1) NOT NULL default '0',
  last_log timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  tut tinyint(1) NOT NULL default '1',
  lang varchar(2) collate utf8_unicode_ci NOT NULL default 'en' COMMENT 'laguage',
  ip varchar(35) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE %PREFIX%warn (
  id int(5) NOT NULL auto_increment,
  `text` text collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `%PREFIX%conf` VALUES ('Your news are here, you can edit them in the admin cp', 'Your rules here!', 0.25, '072');

INSERT INTO `%PREFIX%plugins` VALUES ('fbplug', 'facebook', 0, NULL),('fblog', 'fb/fb-log', 0, NULL);

INSERT INTO `%PREFIX%races` VALUES (1, 'People', 'May be add some description? :)', 'achon.jpg');

INSERT INTO `%PREFIX%resdata` VALUES (1, 'Gold', 5, 500, 'gold.png'),(2, 'Mana', 1, 500, 'mana.png'),(3, 'Power', 2, 510, 'power.png');

INSERT INTO `%PREFIX%tutorial` VALUES (1, 'Welcome', 'Welcome to phpSGE! This is the tutorrial', 2);

INSERT INTO `%PREFIX%t_builds` VALUES (2,1, 'Gold Mine', 'res1', 'mine.gif', 'Gold mine', 0, 0, 0.25, 50, 0, 0, 15, 0.25, 0, 0, 0, 0, 10, 0),(1,1, 'Baraks', 'barraks', 'barraks.gif', 'Baraks', 0, 0, 0.25, 70, 0, 0, 30, 0.25, 3, 1, 0, 0, 15, 0),(3,1, 'Mana node', 'res2', 'node.gif', 'mana pool', 0, 0, 0.25, 50, 0, 0, 15, 0.25, 2, 1, 0, 0, 10, 0),(4,1, 'Research Lab', 'reslab', '31.gif', NULL, 0, 0, 0.25, 60, 30, 0, 55, 0.25, 3, 2, 0, 0, 15, 0);

INSERT INTO `%PREFIX%t_research` VALUES (1, 'Test research', NULL, 0, 'null.gif', 50, 100, 0, 15, 0, 0, 0, 0, 0);

INSERT INTO `%PREFIX%t_unt` VALUES (1, 'Milita', 0, 'milita.gif', 5, 5, 5, 10, 1, 0, 0, 0, 20, 'A simple soldier', NULL, 0, 0, 0, 0),(2, 'Drago', 1, 'rdragus.gif', 55, 55, 30, 10, 1, 900, 600, 0, 300, 'the powerful dragon! wow!', NULL, 0, 0, 0, 0),(3, 'Carvan', 0, 'pioner.gif', 0, 100, 7, 0, 100, 1000, 700, 200, 150, 'Colonizator Carvan, you can build a new city', 'column', 0, 0, 0, 0);
