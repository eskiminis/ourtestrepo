<?php include ("func.php");
include("head.php");

$catk=$sge->c_atk($sge->id_city);

if($_GET['tutend']){mysql_query("UPDATE `".TB_PREFIX."users` SET `last_log` = NOW( ) ,`tut` = '-1' WHERE `id` =".$sge->id." LIMIT 1 ;");}
// generating phpsge template \\

$secure="y";
include("templates/grepolo/city2.php");
?>