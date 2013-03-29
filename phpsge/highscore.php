<?php include("func.php");
include("head.php");
//recupero users
$sris="SELECT * FROM ".TB_PREFIX."users ORDER BY `points` DESC";
$qris=mysql_query($sris);
// template \\
$body='';
$body.="<h2 class='news-title'><span class='news-date'></span>".$lang['highscore']."</h2><div class='news-body'><table width='300' border='0' cellspacing='10' cellpadding='1'><tr><td><span class='Stile4'>".$lang['position']."</span></td><td><span class='Stile4'>".$lang['username']."</span></td><td><span class='Stile4'>".$lang['points']."</span></td></tr>";

 //mostra utenti
$i=1;
while ( $riga=mysql_fetch_array($qris) ) {
	
	$body.= "<tr><td>".$i."</td><td><a href='profile.php?usr=".$riga['id']."'>".$riga['username']."</a></td><td>".$riga['points']."</td></tr>";
$i++;
}

$body.="</table></div>";

$secure="y";
include("templates/".TEMPLATE."/body.php");
?>
