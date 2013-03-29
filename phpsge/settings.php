<?php include ("func.php");
include("head.php");
if($_GET['lang']){
	$clang=mysql_real_escape_string($_GET['lang']);
	mysql_query("UPDATE `".TB_PREFIX."users` SET `last_log` = NOW( ) ,`lang` = '".$clang."' WHERE `id` =$sge->id LIMIT 1 ;"); 	
	$_SESSION['lang']=$clang;
}

// generating phpsge template \\

if($_GET['lang']) $glang=$_GET['lang'];
else $glang=$usrarray['lang'];

$slang="";
$dir = './lang';
  $handle = opendir($dir);
  // Lettura...
while (false !== ($files = readdir($handle))) {
    // Escludo gli elementi '.' e '..' e stampo il nome del file...
    if ($files != '.' && $files != '..'){
        $sel='';
		if($glang==$files){$sel='selected';}
		$slang.='<option '.$sel.'>'.substr($files,0,-4).'</option>';
														
	}
}

$body.="<h2 class='news-title'><span class='news-date'></span>".$lang['settings']."</h2><div class='news-body'><p>".$lang['username'].": ".$sge->username."</p><p>E-mail: ".$usrarray['email']."</p><form method='get' action=''><p>".$lang['language'].": <select name='lang' onChange='this.form.submit()'>".$slang."</select></form></p><p>&nbsp;</p><p>".$lang['holiday'].": <!-- <a href='?act=vac'> --><a href='#'><input type='button' name='vac' value='".$lang['go_on_holiday']."'></a></p><p><!-- <a href='?act=del'> --><a href='#'><input type='button' name='del' value='".$lang['delete_account']."'></a></p></div>";

$secure="y";
include("templates/".TEMPLATE."/body.php");
?>
