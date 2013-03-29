<?php
include("../../func.php");
Conect();

mysql_query("ALERT TABLE `".TB_PREFIX."users` ADD `fbuid` INT( 11 ) NULL COMMENT 'facebook id for phpsge facebook plugin';");

mysql_query("INSERT INTO `".TB_PREFIX."plugins` (`name`, `file`, `active`) VALUES ('fbplug', 'facebook', 0);");

header("Location: ../../adm/plugin.php");
?>