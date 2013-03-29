<?php
//plugins to include
$plugs=mysql_query("SELECT * FROM `".TB_PREFIX."plugins` WHERE `active` =1");

while($riga=mysql_fetch_array($plugs)){
	define($riga['name'], $riga['active']);

	if($riga['active']=="1" and !$fpof){
		include("plugins/".$riga['file'].".php");
	}
}
?>