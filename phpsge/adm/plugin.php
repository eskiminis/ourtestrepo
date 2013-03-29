<?php 
include("../config.php");
include ("../func.php");

session_start();
if ( $_SESSION['alog'] == "" ) {
header("Location: index.php?msg=login error"); }

if($_POST['page']){ header("Location: ../../plugins/install/".$_POST['page']); }

$id=$_SESSION['aid'];
$nik=$_SESSION['anik'];

($_SESSION['lang']) ? include("../lang/".$_SESSION['lang'].".lng") : include("../lang/".LANG.".lng");

Conect();

if($_POST['plg']){
	$aplugs=mysql_fetch_array( mysql_query("SELECT * FROM `".TB_PREFIX."plugins` WHERE `name` = '".$_POST['plg']."' LIMIT 1 ;") );
	if($aplugs['active']==0) $set=1;
	else $set=0;
	mysql_query("UPDATE `".TB_PREFIX."plugins` SET `active` = '".$set."' WHERE CONVERT( `name` USING utf8 ) = '".$_POST['plg']."' LIMIT 1 ;");	
}

$plugs=mysql_query("SELECT * FROM `".TB_PREFIX."plugins`");
$dir = '../plugins/install';

$body="<h2>".$lang['plugin-manager']."</h2>
<div>
<p> <form method='post' action=''>
 to istall: <select name='page' onChange='this.form.submit()'>
<option>---</option>";
 
// Apertura...
$handle = opendir($dir);
 
// Lettura...
while (false !== ($files = readdir($handle))) {
    // Escludo gli elementi '.' e '..' e stampo il nome del file...
    if ($files != '.' && $files != '..'){
        $sel='';
		if($_GET['page']==$files){$sel='selected';}
		$body.= '<option '.$sel.'>'.$files.'</option>';
	}
}
 
// Chiusura...
closedir($handle); 
$body.="</select></form></div>
 <h2>installed:</h2><div><table width='350' border='0'>
 <tr><td>Plugin name</td><td>Active</td></tr>";
while ($riga=mysql_fetch_array($plugs)){
	if($riga['active']==1) { $actv="<span class='Stile1'>on</span>"; $sbt="Turn Off"; }
	else { $actv="<span class='Stile3'>off</span>"; $sbt="Turn On"; }
	$body.= "<form method='post' action=''> <input type='hidden' name='plg' value='".$riga['name']."'>";
	$body.= "<tr><td>".$riga['name']."</td><td>".$actv."</td><td><input type='submit' value='".$sbt."'></td></tr>";
	$body.= "</form>";	
} $body.="</table></div>";

include "../templates/sge5-future/admcp.php";
?>
