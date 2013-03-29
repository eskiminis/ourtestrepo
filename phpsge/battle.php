<?php include ("func.php");
include("head.php");
//SHOW UNITS
$gcuu=mysql_query("SELECT * FROM ".TB_PREFIX."units WHERE owner_id='$sge->id'");

// atak
if($_POST['act']=="atk"){
	while ( $riga=mysql_fetch_array($gcuu) ) {
		$su=mysql_fetch_array(mysql_query("SELECT * FROM ".TB_PREFIX."units WHERE id_unt='".(int)$_POST['unt']."' LIMIT 1;"));
		$aftunt=$su['uqnt']-$_POST['qnt'];
		mysql_query("UPDATE `".TB_PREFIX."units` SET `uqnt` =  '".$aftunt."' WHERE `id_unt` =".(int)$_POST['unt']." AND where='$sge->id_city' LIMIT 1 ;");
		$timeend=mtimetn()+30;
		//mysql_query("INSERT INTO `".TB_PREFIX."units` (`id`, `id_unt`, `uqnt`, `owner_id`, `from`, `to`, `where`, `time`, `action`) VALUES (NULL, '".$_POST['unt']."', '".$_POST['qnt']."', '$sge->id', '$sge->id_city', '".$_POST['dp']."', NULL, '$timeend', '1');");
		mysql_query("UPDATE `".TB_PREFIX."units` SET `from` = '$sge->id_city',`to` = '".(int)$_POST['dp']."',`where` = NULL ,`time` = '$timeend',`action` = '1' WHERE `id` =".$su['id']." LIMIT 1 ;");
	}
	cce_qunt();
}

//colonizator
if($_POST['c']){
	mysql_query("INSERT INTO `".TB_PREFIX."city` (`id`, `owner`, `name`, `res1`, `res2`, `res3`, `last_update`, `galaxy`, `system`, `pos`, `img`) VALUES (NULL, ".$sge->id.", 'Your city', 100, 100, 50, ".mtimetn().", ".$_POST['gal'].", ".$_POST['sys'].", ".$_POST['pos'].", 'null.gif');");	
}


// template \\
if( !isset($_GET['colnize']) ){
	$body=$lang['attack']."<br>";
	//if there are units
	if(mysql_num_rows($gcuu)>0){
		
		$body.="<form method='post' action=''><input type='hidden' name='dp' value='".$_GET['p']."'> <input type='hidden' name='act' value='atk'><table width='300' border='0' cellspacing='0' cellpadding='1'>";
	
		while ( $riga=mysql_fetch_array($gcuu) ) {
	
			$anul=mysql_fetch_array( mysql_query("SELECT * FROM ".TB_PREFIX."t_unt WHERE id='".$riga['id_unt']."' LIMIT 1;") );
			$ncu=$riga['uqnt'];
			if($ncu=="") {$ncu=0;}
	
					$body.= "<tr><td>".$anul['name']." (".$ncu.")</td> <td><input type='hidden' name='unt' value='".$riga['id_unt']."'><input type='number' min='0' max='".$ncu."' name='qnt' value='0'></td></tr>";
		} 
	
		$body.="</table><br><input type='submit' value='".$lang['attack']."'></form>";
	
	}
	else{$body.="<p><span class='Stile3'>No units :( <br>Train some in the barraks</span></p>";}
} 
else {
	$body.="<form method='post' action=''>";	
	$aqrcolunt = mysql_fetch_array( mysql_query("SELECT id FROM ".TB_PREFIX."t_unt WHERE type='column'") );
	$numcolunt = mysql_fetch_array( mysql_query("SELECT uqnt FROM `units` WHERE `id_unt` =".$aqrcolunt['id']) );
	$body.= "<p>Aviable colonizer units ".$numcolunt['uqnt']."</p>";
	$body.="<br><input type='hidden' name='pos' value='".$_GET['colnize']."'>
	<input type='hidden' name='gal' value='".$_GET['gal']."'>
	<input type='hidden' name='sys' value='".$_GET['sys']."'>
	<input type='submit' name='c' id='c' value='".$lang['colonize']."'></form>";
}

$secure="y";
include("templates/".TEMPLATE."/body.php");
?>
