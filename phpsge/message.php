<?php include ("func.php");
include("head.php");

//messages
$mtp="";
if($_GET['mtp']){$mtp.=" AND `mtype` =3";}
$amsg=mysql_query("SELECT * FROM `".TB_PREFIX."umsg` WHERE `to` =$sge->id".$mtp);
$nmsg=mysql_num_rows($amsg);

if($_POST['act']=="snmsg") {
	$from=$sge->id;
	$to=(int)$_POST['ito'];
	$mtit=$_POST['mtit'];
	$msg=$_POST['freeRTE_content'];
	$mtp=1;
	$sge->snmsg($from, $to, $mtit, $msg, $mtp);
}

// template \\
$body="";
 //send msg 
if($_GET['act']=="smsg") {
	$ito=$_GET['ito'];
	$gnto=mysql_fetch_array( mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE id=$ito LIMIT 1;") );
	$nto=$gnto['username'];
	// intialize text editor
	$body.= "<h2 class='news-title'><span class='news-date'></span>".$lang['send']."</h2>";
		$body.= "<form method='post' action=''> <input type='hidden' name='act' value='snmsg'> <input type='hidden' name='ito' value='$ito'>";
		$body.= "<div class='news-body'><p>".$lang['to'].": <input name='to' type='text' value='$nto' size='25' disabled> ".$lang['title'].": <input name='mtit' type='text' size='15'></p>";
		$body.= "<script src='http://js.nicedit.com/nicEdit-latest.js' type='text/javascript'></script>
<script type='text/javascript'>bkLib.onDomLoaded(nicEditors.allTextAreas);</script>";
		$body.="<textarea name='freeRTE_content' id='textarea' cols='45' rows='5'></textarea>";
		$body.= "<p><input type='submit' value='".$lang['send']."'></p></form></div>";
} 

$body.="<table width='50%' border='0' cellspacing='1' cellpadding='1'><tr><td><a href='message.php'>".$lang['all']."</a></td><td><a href='message.php?mtp=2'>".$lang['reports']."</a></td><td><a href='message.php?mtp=3'>".$lang['ally_inv']."</a></td></tr></table>";
$body.="<h2 class='news-title'><span class='news-date'></span>".$lang['your_messages']."</h2><div class='news-body'><table width='300' border='1' cellspacing='0' cellpadding='0'>";
//mostra msg
if ($nmsg=="0") { $body.=$lang['no_msgs']; }
else {
	while ( $riga=mysql_fetch_array($amsg) ) {
		$aiab="";
		if($riga['mtype']==3) $aiab="<br><a href='ally.php?aia=".$riga['aiid']."&invid=".$riga['id']."'> <input type='button' value='".$lang['acept']."'></a>";
		$fua=mysql_fetch_array(mysql_query("SELECT username FROM ".TB_PREFIX."users WHERE `id` =".$riga['from']." LIMIT 1;")); 	
		$body.= "<tr><td><div align='center'> ".$lang['from'].": ".$fua['username']."</div></td><td><div align='center'> ".$riga['mtit']."</td></tr> <tr><td colspan='2'><div align='center'>".$riga['text'].$aiab."</div></td></tr>";
	mysql_query("UPDATE `umsg` SET `read` = '1' WHERE `id` =".$riga['id']." LIMIT 1 ;");
 	}  
}

$body.="</table></div>";

$secure="y";
include("templates/".TEMPLATE."/body.php");	

?>
