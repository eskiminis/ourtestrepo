<?php include("func.php");
Conect();
session_start();

if($_REQUEST['act']=="chat_rel"){
	$query=mysql_query("SELECT * FROM `".TB_PREFIX."cmsg` ORDER BY `id` DESC");	

	while($lsm=mysql_fetch_array($query)){
		echo "<a href='profile.php?usr=".$lsm['usrid']."' target='_blank'>".$lsm['username']."</a> : ".$lsm['msg']."<br>";
	}
}

if($_REQUEST['act']=="chat_sendm"){
	$msg=html_entity_decode( htmlentities($_REQUEST['msg']) );	
	mysql_query("INSERT INTO `".TB_PREFIX."cmsg` (`id` ,`username` ,`usrid` ,`msg` ,`sent_on`) VALUES (NULL , '".$_SESSION['nik']."', '".(int)$_SESSION['id']."', '".$msg."', CURRENT_TIMESTAMP);");
}
?>