-- sql for map system 1 --

ALTER TABLE `%PREFIX%city` ADD `galaxy` INT( 15 ) NOT NULL DEFAULT '0',
ADD `system` INT( 15 ) NOT NULL DEFAULT '0',
ADD `pos` INT( 15 ) NOT NULL DEFAULT '0',
ADD `img` VARCHAR( 35 ) NOT NULL DEFAULT 'null.gif';



