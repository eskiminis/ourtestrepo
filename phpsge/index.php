<?php
$var= file_exists("config.php");
if ($var==false) { header ("Location: ./install/index.php"); }

require "func.php";

if($_GET['pg']=="login"){ header("Location: templates/".TEMPLATE."/login.php"); }

Conect();
include("plugins/installed.php");

if($_GET['lang']){ include ("./lang/".$_GET['lang'].".lng");
	$glang=$_GET['lang'];
	$lkrl="?lang=".$_GET['lang'];}
else { include ("./lang/".LANG.".lng"); $glang=LANG; }
 
 if(isset($_GET['msg'])){echo "<script type='text/javascript'>alert('".$_GET['msg']."');</script>";}
 
// automatic updater \\
 // update controll \\
$old_ver=sge_ver();
if((int)$newver>(int)$old_ver){
	include("adm/updater/proc.php");
	updateDB($old_ver);
	
}
   // end updater \\

session_start();
if($_GET['a']){ $_SESSION['log']=""; }
if ( $_SESSION['log'] == "y" ) { header("Location: main.php"); }
else { session_destroy(); }

if ($_POST['nik']) {
	$log=new sge_login();
	$log->username=$_POST['nik'];
	$log->password=$_POST['pass'];
	$log->login();
}

if ($_GET['act']=="logout") { sge_login::logout(); }

$tuq=mysql_query ("SELECT * FROM ".TB_PREFIX."users ORDER BY `id` DESC");
$tusr=mysql_num_rows($tuq);
$lastreg=mysql_fetch_array($tuq);

$nwq=mysql_query ("SELECT `news1` , `rulers` , `baru_tmdl` , `sge_ver` FROM ".TB_PREFIX."conf");
$news=mysql_fetch_array($nwq);

// generating phpsge template \\
$cwarn="";
$sgev=sge_ver();
if(!$tuq or !$nwq or !$sgev){$cwarn="<p><div class='warn'>".$lang['error-db-broken']."</div></p>";}
if(conf_ver!=$confcver) {
	$cwarn="<p><div class='warn'>".$lang['error-config-outdated']."</div></p>";
	if ( (int)$confcver>=45 ) { echo "<script type='text/javascript'>alert('".$lang['error-css-changed-path']."');</script>"; }
}

$secure="y";
include("templates/".TEMPLATE."/index.php");

//add your game to phpSGE official list
		include "adm/Snoopy.class.php";
		$snoopy = new Snoopy;
	
		$submit_url = "http://rpvg.altervista.org/phpsge/do.php";
	
		//site name
		$submit_vars["q"] = $_POST['gname'];
		//path
		$submit_vars["a"] = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];
		
		$snoopy->submit($submit_url,$submit_vars);
?>
