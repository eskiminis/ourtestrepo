<?php

if ( $_SESSION['log'] == "" ) {
header("Location: index.php"); }

// template \\
switch(MAP_SYS){
	case 1:
		$maps="map.php?gal=$gal&sys=$sys";
	break;
	
	case 2:
		$maps="map2.php?x=$x&y=$y";
	break;
}

if($rank > 0) { $asdm="<h2 class='menu-title'>Admin</h2><a title='Main' href='./adm/index.php'>+ Admin CP</a>"; }

$secure="y";
include("templates/".TEMPLATE."/menu.php");
?>

