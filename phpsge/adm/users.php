<?php 
include("../config.php");
include ("../func.php");

session_start();
if ( $_SESSION['alog'] == "" ) {
header("Location: index.php?msg=login error"); }

$id=$_SESSION['aid'];
$nik=$_SESSION['anik'];
($_SESSION['lang']) ? include("../lang/".$_SESSION['lang'].".lng") : include("../lang/".LANG.".lng");

Conect();
//delete user
if($_GET['delu']){
	$scrcu=mysql_fetch_array( mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE `id` =".$_GET['delu']) );
	$dccu=mysql_query("SELECT * FROM `".TB_PREFIX."city` WHERE `owner` =".$_GET['delu']);
	while($riga=mysql_fetch_array($dccu)){
		//delete city
		mysql_query("DELETE FROM `".TB_PREFIX."city` WHERE `id` = ".$riga['id']." LIMIT 1;");
	}
	mysql_query("DELETE FROM `".TB_PREFIX."users` WHERE `id` = ".$_GET['delu']." LIMIT 1;");
}
//recupero users
$sris="SELECT * FROM ".TB_PREFIX."users";
$qris=mysql_query($sris);

//edit city
if($_POST['cid']){
	$resd=mysql_query("SELECT * FROM `".TB_PREFIX."resdata`");
	$resud="";
	while($riga=mysql_fetch_array($resd)){
		$resud.=",`res".$riga['id']."` = '".$_POST['res'.$riga['id']]."'";
	}
		mysql_query("UPDATE `".TB_PREFIX."city` SET `name` = '".$_POST['cn']."' ".$resud." WHERE `id` =".$_POST['cid']." LIMIT 1 ;");
}


$body="<div>
<p>".$lang['welcome'].", ".$nik."! &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; [<span id='theTime' style='position:absolute; left:413px; top:200px; font-family: arial; font-size: 9pt'></span>]</p>
</div>

<h2>&nbsp;</h2>

<h2>".$lang['search-city']."</h2>
<div>
<form method='post' action=''>
City name: <input type='text' name='scity' size='15'>
<input type='submit' value='".$lang['search-city']."'>
</form>
</div>";

if($_GET['cto']){ $uin=mysql_fetch_array( mysql_query("SELECT * FROM `".TB_PREFIX."users` WHERE `id` =".$_GET['cto']) );
	$body.="<h2>".$lang['citys-of']." ".$uin['username']."'a</h2>
	<div><table width='500' border='0' cellspacing='10' cellpadding='1'>";
	$qruc=mysql_query("SELECT * FROM `".TB_PREFIX."city` WHERE `owner` =".$_GET['cto']);
	while($riga=mysql_fetch_array($qruc)){
		$body.="<tr><td>".$riga['name']."</td><td><a href='?ced=".$riga['id']."'><img src='../img/icons/b_edit.png' border='0'></a></td></tr>";
	} $body.="</table></div>";
} 

if($_GET['ced']){ $cinf=mysql_fetch_array( mysql_query("SELECT * FROM `".TB_PREFIX."city` WHERE `id` =".$_GET['ced']) );
    $body.="<h2>".$lang['edit-city']."</h2>
    <div>
    <form method='post' action=''><input type='hidden' name='cid' value='".$cinf['id']."'>
    <table>";
    $resd=mysql_query("SELECT * FROM `".TB_PREFIX."resdata`");
    $resfc="";
    $resic="";
    while($riga=mysql_fetch_array($resd)){ 
        $resfc.="<td>Res".$riga['id']."</td>";
        $resic.="<td><input type='text' name='res".$riga['id']."' size='3' value='".$cinf['res'.$riga['id']]."'></td>";
    }

    $body.="<tr><td>".$lang['city-name']."</td>".$resfc."</tr>
    <tr><td><input type='text' name='cn' size='7' value='".$cinf['name']."'></td>".$resic."<td><input type='submit' value='".$lang['save']."'></tr>
    </table>
    </form>
    </div>";
}

$body.="<h2>".$lang['rplayer']."</h2>
<div><table width='500' border='0' cellspacing='10' cellpadding='1'>
<tr>
<td><span class='Stile4'>".$lang['name']."</span></td>
<td><span class='Stile4'>".$lang['points']."</span></td>
</tr>";
//mostra utenti

while ( $riga=mysql_fetch_array($qris) ) {
	$del="&nbsp;";
	$ban="&nbsp;";
	$a="";
	if($riga['rank']==0){$del="<a href='?delu=".$riga['id']."'><img src='../img/icons/x.png' border='0'></a>";
		$ban="<a href='?ban=".$riga['id']."'><img src='../img/icons/ban.png' border='0'></a>";	
	}else { $a="<span class='Stile4'>A</span>"; }
	
	$body.= "<tr><td>".$riga['username']." ".$a."</td><td>".$riga['points']."</td><td><a href='?cto=".$riga['id']."'><img src='../img/icons/b_edit.png' border='0'></a></td><td>".$ban."</td><td>".$del."</td></tr>";

}
$body.="</table> </div>";

include "../templates/sge5-future/admcp.php";
?>
