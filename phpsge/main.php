<?php include ("func.php");
include("head.php");

// automatic updater \\
 // update controll \\
$old_ver=sge_ver();
if((int)$newver>(int)$old_ver){
	include("adm/updater/proc.php");
	updateDB($old_ver);
}
   // end updater \\

if($_GET['tutend']){mysql_query("UPDATE `".TB_PREFIX."users` SET `last_log` = NOW( ) ,`tut` = '-1' WHERE `id` =".$sge->id." LIMIT 1 ;");}

// units movements \\

$qmu_out=mysql_query("SELECT * FROM `".TB_PREFIX."units` WHERE `to` =$sge->id_city");
$etoid="0";
while( $rw=mysql_fetch_array($qmu_out) ){
	if( $rw['to'] != eval($etoid) ){
		$platk=new sge_main;
		$platk->id_city=$rw['to'];
		$platk->resources();
		$platk->act_unit($rw['owner_id'],$platk->id_city);
		$platk->act_research();
		$platk->returnunits($platk->id_city);
		$platk->c_atk($platk->id_city);
		
		$etoid.=" AND \$rw[\'to\']!=".$rw['to'];
	}
}

if( mysql_num_rows($qmu_out)>0 ) {
	$body="<p>".$lang['unit-movements']."<br><table border='1'><tr><td>".$lang['target']."</td><td>".$lang['time']."</td></tr>";
	
	$qmu_out=mysql_query("SELECT * FROM `".TB_PREFIX."units` WHERE `from` =$sge->id_city");
	$etoid="0";
	while( $rw=mysql_fetch_array($qmu_out) ){
		if( $rw['to'] != eval($etoid) ){
			$body.="<tr><td>".$rw['to']."</td><td>".$rw['time']."</tr>";	
			$etoid.=" AND \$rw[\'to\']!=".$rw['to'];
		}
	}
	
	$body.="</table></p>";
} else $body.="<p>No units movement</p>";
// generating phpsge template \\
$secure="y";

if($_GET['pg']) { include("templates/".TEMPLATE."/".$_GET['pg'].".php"); }
else { include("templates/".TEMPLATE."/main.php") ;}
?>
