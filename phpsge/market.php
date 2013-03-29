<?php include ("func.php");
include("head.php");
//make offer
if($_POST['resreq']){
	mysql_query("INSERT INTO ".TB_PREFIX."market VALUES (NULL , '$sge->id', '".mysql_real_escape_string($_POST['resoff'])."', '".mysql_real_escape_string($_POST['resoqnt'])."', '".mysql_real_escape_string($_POST['resreq'])."', '".mysql_real_escape_string($_POST['resrqnt'])."');");
	//ti toglie risorsa
	$restog=mysql_fetch_array( mysql_query("SELECT ".mysql_real_escape_string($_POST['resoff'])." FROM ".TB_PREFIX."city WHERE id = '$sge->id_city' LIMIT 1;") ); 
	mysql_query("UPDATE `".TB_PREFIX."city` SET `".mysql_real_escape_string($_POST['resoff'])."` = '".$restog[$_POST['resoff']]-$_POST['resoqnt']."' WHERE `id` =1 LIMIT 1 ;");
}

//acept offer
if($_GET['aoid']){
$qodt=mysql_query("SELECT * FROM `".TB_PREFIX."market` WHERE id = ".mysql_real_escape_string($_GET['aoid'])." LIMIT 1;");
	if(mysql_num_rows($qodt)>0){
		$aodt=mysql_fetch_array($qodt);
		// delete from market
		mysql_query("DELETE FROM `market` WHERE `id` = ".mysql_real_escape_string($_GET['aoid'])." LIMIT 1;"); 
		// fot you
		mysql_query("INSERT INTO ".TB_PREFIX."resmov VALUES (NULL , '$sge->id', '30', '".$aodt['resoff']."', '".$aodt['resoqnt']."');");
		//per l'offerente
		mysql_query("INSERT INTO ".TB_PREFIX."resmov VALUES (NULL , '".$aodt['owner']."', '30', '".$aodt['resreq']."', '".$aodt['resrqnt']."');");
		//ti toglie risorsa
		//... i must go, i will continue when i return
	}
}


$arq=mysql_query("SELECT * FROM `".TB_PREFIX."market`");

//template

//options res
$rescbr="";
$resd=mysql_query("SELECT * FROM `".TB_PREFIX."resdata`");
while($fres=mysql_fetch_array($resd)) {$rescbr.="<option value='".$fres['id']."'>".$fres['name']."</option>"; }

$body='';
//make offer
$body.="<form method='post' action=''><table cellpadding='5'><tr><td>".$lang['offer_res']."</td><td>".$lang['need_res']."</td></tr> <tr><td><select name='resoff'>".$rescbr."</select> <input name='resoqnt' type='number' min='0' size='3' value='0'></td><td><select name='resreq'>".$rescbr."</select> <input name='resrqnt' type='number' min='0' size='3' value='0'></td><td><input type='submit' value='".$lang['make']."'></td></tr> </table></form> <br>";

$body.="<table width='512' border='1' cellspacing='0' cellpadding='5'>";
//show offers.
if(mysql_num_rows($arq)>0){
	while ( $riga=mysql_fetch_array($arq) ) {
		$body.="<tr><td><div align='center'>".$riga['resoff']."<br>".$riga['resoqnt']."</div></td><td><div align='center'>".$riga['resreq']."<br>".$riga['resrqnt']."</div></td><td><a href='?aoid=".$riga['id']."'>".$lang['acept']."</a></td></tr>";
	} 
}
else{$body.="<tr><td>".$lang['no_offers']."</td></tr>";}

$body.="</table>";

$secure="y";
include("templates/".TEMPLATE."/body.php");
?>
