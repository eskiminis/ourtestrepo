insert  into `%PREFIX%t_builds`(`id`,`name`,`func`,`img`,`desc`,`c_res1`,`time`) values (2,'gold mine','res1','null.gif','gold mine',0,0),(1,'barraks','barraks','null.gif','barracks',0,0);


DROP TABLE IF EXISTS `%PREFIX%t_unt`;

CREATE TABLE `%PREFIX%t_unt` (
  `id` int(15) NOT NULL auto_increment,
  `name` varchar(10) NOT NULL,
  `race` int(5) NOT NULL default '1',
  `img` varchar(30) NOT NULL default 'null.gif',
  `atk` int(5) NOT NULL default '5',
  `dif` int(5) NOT NULL default '5',
  `vel` int(5) NOT NULL default '5',
  `cres1` int(5) NOT NULL default '3',
  `etime` int(10) NOT NULL,
  `desc` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dump dei dati per la tabella `t_unt`
--

INSERT INTO `%PREFIX%t_unt` (`id`, `name`, `race`, `img`, `atk`, `dif`, `vel`, `cres1`, `etime`, `desc`) VALUES
(1, 'milita', 1, 'null.gif', 5, 5, 5, 5, 0, 'a simple soldier');

UPDATE `%PREFIX%conf` SET `sge_ver` =  '010' WHERE CONVERT( `sge_ver` USING utf8 ) =  '009' LIMIT 1 ;