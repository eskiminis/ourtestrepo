-- sql for map city sys2 --

ALTER TABLE `%PREFIX%bque` ADD `field` TINYINT( 2 ) NOT NULL ;
ALTER TABLE `%PREFIX%builds` ADD `field` TINYINT( 2 ) NOT NULL ;

ALTER TABLE `%PREFIX%t_builds` DROP INDEX `func`;



