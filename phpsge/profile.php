<?php include ("func.php");
include("head.php");
if($_SESSION['lang']){include("./lang/".$_SESSION['lang']."/profile.lng");}
else{include("./lang/".LANG."/profile.lng");}

if($_GET['plsinv']){
	$sge->snmsg($sge->id, $_GET['plsinv'], "ally invite", "you are invited!", $mtp=3, $aiid=$usrarray['ally_id']);
	$body="<a href='ally.php'>Back to ally</a>";	
}

// template \\
$body="";

if($_GET['snusr']){
	$suq=mysql_query("SELECT * FROM `".TB_PREFIX."users` WHERE `username` LIKE '%".mysql_real_escape_string($_GET['snusr'])."%'");
	
	$body.="<h2 class='news-title'><span class='news-date'></span>User founded</h2><div class='news-body'>";
	$body.="<table>";
	while( $riga=mysql_fetch_array($suq) ){
			$body.="<tr><td><a href='?usr=".$riga['id']."'>".$riga['username']."</a></td>";
			if($_GET['inv']) $body.="<td><a href='?plsinv=".$riga['id']."'><input type='button' value='invite'></a></td>";
			$body.="</tr>";
	}
	$body.="</table></div>";
}

if($_GET['usr']){
	$wusr=(int)$_GET['usr'];
	$u2p =mysql_fetch_array( mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE id='".$wusr."' LIMIT 1;") );
	
	// ally name
	if($u2p['ally_id']==0){$allyn="".$lang['profile_no_ally']."";}
	else{$aan=mysql_fetch_array( mysql_query("SELECT * FROM `".TB_PREFIX."ally` WHERE `id` =".$u2p['ally_id']) );
		$allyn=$aan['name'];
	}

	// city name
	if(!empty($u2p['username'])){
		 // ally name
		 $ncp2=mysql_fetch_array( mysql_query("SELECT * FROM `".TB_PREFIX."city` WHERE `id` =".$u2p['capcity']." LIMIT 1;") );
		 $qsur=mysql_fetch_array( mysql_query("SELECT `rname` , `img` FROM `".TB_PREFIX."races` WHERE `id` =".$u2p['race']." LIMIT 1;") );
	}
	
	$body.="<h2 class='news-title'><span class='news-date'></span>".$lang['profile_user']." ".$u2p['username']."</h2><div class='news-body'> <table width='192' border='0' cellspacing='3' cellpadding='3'> <tr><td width='99'>".$lang['profile_race'].": </td> <td width='100'>&nbsp;".$qsur['rname']."</td></tr><tr>  <td>".$lang['points'].":</td>  <td>&nbsp;".$u2p['points']."</td></tr><tr>  <td>".$lang['last_login'].":</td>  <td>&nbsp;".$u2p['last_log']."</td></tr><tr>  <td>".$lang['profile_ally'].":</td>  <td><a href='ally.php?showid=".$u2p['ally_id']."'>".$allyn."</a></td> </tr> <tr>   <td>".$lang['profile_capital'].":</td>   <td>".$ncp2['name']."</td> </tr> <tr>   <td><form name='form1' method='get' action='message.php'>     <div align='center'>     <input type='hidden' name='act' value='smsg'> <input type='hidden' name='ito' value='".$wusr."'>     <input type='submit' name='button' id='button' value='".$lang['profile_mp']."'>   </div>    <label></label>    </form>      </td>     <td>&nbsp;</td>    </tr>  </table></div>";
	
	//show user city(s)
	$body.="<h2 class='news-title'><span class='news-date'></span>City of ".$u2p['username']."</h2><div class='news-body'><table cellpadding='3' border='1'>";
	$qrsc=mysql_query("SELECT * FROM `".TB_PREFIX."city` WHERE `owner` =".$wusr);
	while( $riga=mysql_fetch_array($qrsc) ){
		$pos = "<a href='map.php?gal=".$riga['galaxy']."&sys=".$riga['system']."'>".$riga['galaxy']." ".$riga['system']." ".$riga['pos']."</a>";
		$body.="<tr><td>".$riga['name']."</td><td>".$pos."</td></tr>";	
	}
	$body.="</table></div>";
	
}

$secure="y";
include("templates/".TEMPLATE."/body.php");
?>
