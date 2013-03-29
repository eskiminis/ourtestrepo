<?php 
// invite ally (spaghetti code)
if($_POST['act']=="ainv"){
	$player=$_POST['player'];	
	header("Location: profile.php?snusr=".$player."&inv=1");
}

include ("func.php");
include("head.php");

//ally
if( $usrarray['ally_id']!="0" ){
	$qrcu=mysql_query("SELECT * FROM ".TB_PREFIX."ally WHERE id='".$usrarray['ally_id']."' LIMIT 1;");
	if( mysql_num_rows($qrcu)==0 ) mysql_query("UPDATE `".TB_PREFIX."users` SET `ally_id` = '0', `last_log` = NOW( ) WHERE `id` =".$sge->id." LIMIT 1 ;");
	else $racu=mysql_fetch_array($qrcu);
}

//acept invite
if( $_GET['aia'] and $_GET['invid'] ){
	$vae=mysql_query("SELECT `id` FROM `".TB_PREFIX."ally` WHERE `id` =".(int)$_GET['aia']." LIMIT 1;");
	$mst=mysql_query("SELECT `id` FROM `".TB_PREFIX."umsg` WHERE `id` = ".(int)$_GET['invid']." AND `mtype` = 3 AND `aiid` = ".(int)$_GET['aia']." LIMIT 1;");
	if( (mysql_num_rows($vae)!=0) and (mysql_num_rows($mst)!=0) ){
		mysql_query("UPDATE `".TB_PREFIX."users` SET `ally_id` =  '".(int)$_GET['aia']."',`last_log` = NOW( ) WHERE `id` =".$sge->id." LIMIT 1 ;");
		echo "<META HTTP-EQUIV='refresh' CONTENT='0;URL=ally.php'>";	
	} else echo "ally don't exist!";
}

// join ally
if( $_GET['aj'] ){ 
	$qr=mysql_query("SELECT * FROM `".TB_PREFIX."ally` WHERE `id` =".(int)$_GET['aj']." LIMIT 1;");
	if( mysql_num_rows($qr) >0 ){
		$aqr=mysql_fetch_array($qr);
		if($aqr['acess']=="0") mysql_query("UPDATE `".TB_PREFIX."users` SET `ally_id` =  '".(int)$_GET['aj']."',`last_log` = NOW( ) WHERE `id` =".$sge->id." LIMIT 1 ;");
	}
	echo "<META HTTP-EQUIV='refresh' CONTENT='0;URL=ally.php'>";
}

//left ally
if($_GET['al']=="left"){
	mysql_query("UPDATE `".TB_PREFIX."users` SET `ally_id` = '0', `last_log` = NOW( ) WHERE `id` =$sge->id LIMIT 1 ;");	
	echo "<META HTTP-EQUIV='refresh' CONTENT='0;URL=ally.php'>";	
}

// expell
if( $_GET['expel'] and ($racu['owner']==$sge->id) ){
	mysql_query("UPDATE `".TB_PREFIX."users` SET `ally_id` = '0', `last_log` = NOW( ) WHERE `id` =".(int)$_GET['expel']." AND `ally_id` = '".$usrarray['ally_id']."' LIMIT 1 ;");
}

//this create the ally
if($_POST['act']=="cally" and $usrarray['ally_id']==0) {
	$aname=$_POST['aname'];
	mysql_query("INSERT INTO `".TB_PREFIX."ally` (`id` ,`name` ,`owner`)VALUES (NULL , '".mysql_real_escape_string($aname)."', '$sge->id');");
	
	$aqid=mysql_fetch_array( mysql_query("SELECT * FROM  ".TB_PREFIX."ally WHERE name='".mysql_real_escape_string($aname)."' LIMIT 1;") );
	$aaid=$aqid['id'];
	
	mysql_query("UPDATE `".TB_PREFIX."users` SET `ally_id` =  '".$aaid."',`last_log` = NOW( ) WHERE `id` =".$sge->id." LIMIT 1 ;");
	echo "<META HTTP-EQUIV='refresh' CONTENT='0;URL=ally.php'>";
}
	
// search ally
if($_GET['act']=="jally") {
	$aname=mysql_real_escape_string($_GET['aname']);
	$aually=mysql_query("SELECT * FROM `".TB_PREFIX."ally` WHERE `name` LIKE '%".$aname."%'");
	$salist=true;
}

//ally edit
if($_POST['freeRTE_content'] and $usrarray['ally_id']!=0){
	if($racu['owner']==$sge->id){
		mysql_query("UPDATE `".TB_PREFIX."ally` SET `desc` = '".mysql_real_escape_string($_POST['freeRTE_content'])."' WHERE `id` =".$usrarray['ally_id']." LIMIT 1 ;");
	}
	else{ echo $lang['ally_no_admin']; }
}

// template \\
$body='';
if($usrarray['ally_id']==0){
	if($salist==true){ // list of allys
		while ( $riga=mysql_fetch_array($aually) ) { $body.= $riga['name']." <a href='?aj=".$riga['id']."'>".$lang['join']."</a><br>"; }
	}
	else { // if no ally
		$body.="<h2 class='news-title'><span class='news-date'></span>".$lang['ally-name']."</h2>
<div class='news-body'>  <p>".$lang['not-in-ally']."</p><form method='post' action=''> <input type='hidden' name='act' value='cally'><label>".$lang['ally-name'].":<input type='text' name='aname' id='aname' size='20'></label><label>&nbsp;&nbsp; <input type='submit' value='".$lang['create']."'></label></form></div>"; 
		$body.= "<h2 class='news-title'>".$lang['ally_search']."</h2><div class='news-body'><br><p>".$lang['ally_join']."<form method='get' action=''> <input type='hidden' name='act' value='jally'> ".$lang['ally-name'].": <input type='text' name='aname' id='aname' size='20'> <input type='submit' value='".$lang['ally_search']."'></form></div>"; 
	}
}
else { // if you are in an ally
	//if the owner
	if($racu['owner']==$sge->id){ $mnal=" <a href='?al=adm'><input type='button' value='".$lang['manage']."'></a> <a href='?al=invite'><input type='button' value='".$lang['invite']."'></a> <a href='?al=pact'><input type='button' value='".$lang['pact']."'></a>"; }
	$mnal.=" <a href='?al=left'><input type='submit' value='".$lang['left']."'></a>";
	$body.= "<h2 class='news-title'><span class='news-date'></span>".$lang['ally'].": ".$racu['name']."".$mnal."</h2><div class='news-body'>";
	if($racu['owner']==$sge->id and $_GET['al']=="adm"){//if edit ally
		$body.= "<form method='post' action='ally.php'>";
		$body.= "<script src='http://js.nicedit.com/nicEdit-latest.js' type='text/javascript'></script>
<script type='text/javascript'>bkLib.onDomLoaded(nicEditors.allTextAreas);</script>";
		$body.="<textarea name='freeRTE_content' id='textarea' cols='45' rows='5'></textarea>";
		$body.= "<br><input type='submit' value='".$lang['save']."'></form>";
	}
	else if($_GET['al']=="invite"){
		$body.="<form method='post' action='ally.php'> <input type='hidden' name='act' value='ainv'>";
		$body.=$lang['name'].": <input type='text' name='player'> <input type='submit' value='".$lang['invite']."'>";
		$body.="</form>";
	}
	else if($_GET['al']=="pact"){
		$body.="<form method='post' action='ally.php'> <input type='hidden' name='act' value='apt'>";
		$body.="".$lang['ally'].": <input type='text' name='Ally'> <input type='submit' value='".$lang['pact_choose']."'>";
		$body.="</form>";	
	}
	else{
		//ally page (is desc, desc=HTML)
		$body.= "<table cellspacing='3' cellpadding='3' width='80%'><tr><td>".$racu['desc']."</td>";
		
		$members="";
		$mqr=mysql_query("SELECT `id` , `username` , `race` , `capcity` , `points` , `last_log` FROM `".TB_PREFIX."users` WHERE `ally_id` =".$usrarray['ally_id']);
		while( $mr=mysql_fetch_array($mqr) ) {
			$members.="<a href='profile.php?usr=".$mr['id']."'>".$mr['username']."</a>";
			//if you are the owner you can expell
			if($racu['owner']==$sge->id){ $members.=" <a href='?expel=".$mr['id']."'><img src='img/icons/x.png'></a>"; }
			$members.="<br>";
		}
		
		$body.="<td><h2>".$lang['members']."</h2><br> ".$members."</td>";
		$body.="</tr></table>";
	}
} 

$body.="</div>";

$secure="y";
include("templates/".TEMPLATE."/body.php");
?>
