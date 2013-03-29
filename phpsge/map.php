<?php //sver=051 
include ("func.php");
include("head.php");

//recupero planet
$galaxy=(int)$_GET['gal'];
$system=(int)$_GET['sys'];

$gal=$galaxy;
$sys=$system;

// tempalte \\
$body='';
$body.="<form action='' method='get'><h2 class='news-title'>World Map</h2><div class='news-body'>  <table width='75%' border='0' cellspacing='0' cellpadding='10'>    <tr>      <td width='42'>Galaxy</td>      <td width='40'>Sistem</td>      <td width='24'>&nbsp;</td>      <td width='111'>cerca utente</td>    </tr>    <tr>      <td>    <a href='?gal=".($gal-1)."&sys=".$sys."'><input type='button' value='&larr;' /></a><input type='text' name='gal' id='gal' value='".$galaxy."' size='3'><a href='?gal=".($gal+1)."&sys=".$sys."'><input type='button' value='&rarr;' /></a>   </td>      <td>         <a href='?gal=".$gal."&sys=".($sys-1)."'><input type='button' value='&larr;' /></a><input type='text' name='sys' id='sys' value='".$system."' size='3'><a href='?gal=".$gal."&sys=".($sys+1)."'><input type='button' value='&rarr;' /></a>      </td>    </tr>    <tr><td colspan='2'><div align='center'><input type='submit' value='Visualize'></div></td></form>   	<td>&nbsp;</td>        <form method='get' action='profile.php'>        <td><input type='text' name='snusr'></td></form>    </tr>  </table>   <p>&nbsp;</p>  <table width='600' border='1' cellspacing='0' cellpadding='5'>    <tr>      <td width='61'><div align='center'>Postion</div></td>      <td width='62'>Planet</td>      <td width='98'>Name</td>      <td width='99'>Player</td>      <td width='88'>Ally</td>      <td width='93'>Actions</td>    </tr>";
 //mostra pianeti
	$i=1;
while ( $i!=16 ) { 

	$sris="SELECT * FROM ".TB_PREFIX."city WHERE galaxy='".$galaxy."' AND system='".$system."' AND `pos` = ".$i;
	$qris=mysql_query($sris);

	if( mysql_num_rows($qris)==1 ){
		$riga=mysql_fetch_array($qris);
		$mcuid=$riga['owner'];
		$auin=mysql_fetch_array( mysql_query("SELECT username,ally_id,rank FROM ".TB_PREFIX."users WHERE id='$mcuid'") );
		$cun=$auin['username'];
		$aacu=$auin['ally_id'];
	
		$qan=mysql_fetch_array( mysql_query("SELECT name FROM ".TB_PREFIX."ally WHERE id='$aacu'") );
		if( $qan ) $uan="<a href='ally.php?showid=".$aacu."'>".$qan['name']."</a>";
		else $uan="None";
	
		$ra="";
		if($auin['rank']>0){$ra="<span class='Stile1'>[A]</span>";}
		if($auin['rank']!=3 and $mcuid!=$sge->id and ($auin['ally_id']!=$usrarray['ally_id'] or $auin['ally_id']=="0") ) $atkb="<a href='battle.php?p=".$riga['id']."'><img src='img/icons/attack.jpg' border='0'></a>";
		else $atkb="&nbsp;";
		
		$body.= "<tr><td><div align='center'>".$i."</div></td><td>&nbsp;</td><td>".$riga['name']."</td><td>".$ra." <a href='profile.php?usr=".$mcuid."'>".$cun." <img src='img/icons/m.jpg' border='0'></a></td><td>".$uan."</td><td>".$atkb."</td></tr>";
	}
	else {$body.= "<tr><td><div align='center'>".$i."</div></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td><a href='battle.php?colnize=$i&gal=$gal&sys=$sys'><img src='img/icons/colonize.png' title='colonize'></a></td></tr>";}
	
	$i++;
}

$body.="  </table></div>";

$secure="y";
include("templates/".TEMPLATE."/body.php");

?>