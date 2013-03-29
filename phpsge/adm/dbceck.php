<?php 
include("../config.php");
include ("../func.php");

session_start();
/*  you can see dbceck whitout login
if ( $_SESSION['alog'] == "" ) {
header("Location: index.php?msg=login error"); }
*/

$id=$_SESSION['aid'];
$nik=$_SESSION['anik'];

($_SESSION['lang']) ? include("../lang/".$_SESSION['lang'].".lng") : include("../lang/".LANG.".lng");

Conect();

//tables                       //columns
$tb[]="ally";                   $cl[]="`id`,`name`,`desc`,`owner`,`points`,`acess`";
$tb[]="ally_pact";				$cl[]="`ally1` , `ally2` , `type` , `status`";
$tb[]="bque";				    $cl[]="`id`,`city`,`bud_id`,`end`";
$tb[]="builds";			    	$cl[]="`id`,`lev`,`planet`,`func`";

// res for city (new res sys)
$rstfd="";
$crstfc="";
$resd=mysql_query("SELECT * FROM `".TB_PREFIX."resdata`");
while($fres=mysql_fetch_array($resd)){
	$rstfd.="res".$fres['id'].",";
	$crstfc.=",c_res".$fres['id'];
}
// city table depends on map sys
if(MAP_SYS==1){	
	$tb[]="city";					$cl[]="`id`,`owner`,`name`,".$rstfd."`last_update`,`galaxy`,`system`,`pos`,`img`";
}
else if(MAP_SYS==2){
	$tb[]="city";					$cl[]="`id`,`owner`,`name`,".$rstfd."`last_update`";
}

$tb[]="cmsg";					$cl[]="`id` , `username` , `usrid` , `msg` , `sent_on`";
$tb[]="conf";					$cl[]="`news1` , `rulers` , `baru_tmdl` , `sge_ver`";
$tb[]="market";					$cl[]="id, owner, resoff, resoqnt, resreq, resrqnt";
$tb[]="plugins";				$cl[]="name, file, active";
$tb[]="races";					$cl[]="`id`,`rname`,`rdesc`,`img`";
$tb[]="resdata";				$cl[]="`id`, `name`, `prod_rate`, `start`";
$tb[]="research";				$cl[]="`id_res`,`usr`,`lev`";
$tb[]="resmov";					$cl[]="`id`, `to`, `end`, `res_id`, `resqnt`";
$tb[]="rque";					$cl[]="`id` , `usr` , `res_id` , `end`";
$tb[]="tutorial";				$cl[]="`id`,`tittle`,`body`,`next_tut`";
$tb[]="t_builds";				$cl[]="`id`,`name`,`func`,`img`,`desc`,`res_mpl`".$crstfc.",`time`,`time_mpl`,`req_bud`,`rb_lev`,`req_res`,`rr_lev`";
$tb[]="t_research";				$cl[]="`id`,`name`,`arac`,`img`".$crstfc;
$tb[]="t_unt";					$cl[]="`id`,`name`,`race`,`img`,`atk`,`dif`,`vel`".$crstfc.",`etime`,`desc`";
$tb[]="umsg";					$cl[]="`id`,`from`,`to`,`mtit`,`text`,`read`";
$tb[]="units";					$cl[]="`id`,`id_unt`,`uqnt`,`owner_id`,`from`,`to`,`where`,`time`,`action`";
$tb[]="uque";					$cl[]="`id`,`id_unt`,`uqnt`,`planet`,`end`";
$tb[]="users";					$cl[]="`id`,`username`,`password`,`race`,`capcity`,`ally_id`,`email`,`timestamp_reg`,`points`,`rank`,`active`,`banned`,`last_log`,`tut`,`lang`";
$tb[]="warn";					$cl[]="`id` , `text`";

$numtable=23;
if(MAP_SYS!=1){
	$tb[]="map"; 			$cl[]="`x` , `y` , `type` , `city`";
	$numtable=$numtable+1;
}

for($i=0;$i!=$numtable;$i++){
	if( mysql_query("SELECT ".$cl[$i]." FROM ".TB_PREFIX.$tb[$i]) ){$tbr[$i]="Ok"; $tbc[$i]="#006600";}else{$tbr[$i]=$lang['Broken']; $tbc[$i]="#CC0000";}
}	


$body="<strong>phpSGE files version: <span class='Stile3'>".$newver."</span><br>
	phpSGE db version: <span class='Stile3'>".sge_ver()."</span><br>
    Database: <span class='Stile1'>".SQL_DB."</span><br><br>
    Conf version requided: <span class='Stile3'>".$confcver."</span><br>
    Actual Conf version: <span class='Stile3'>".conf_ver."</span><br></strong>
  <table width='419' border='1' cellspacing='0'>
    <tr bgcolor='#000000'>
      <td width='121'><strong>".$lang['Table']."</strong></td>
      <td width='63'><strong>".$lang['Status']."</strong></td>
    </tr>";
	
	for($i=0;$i!=$numtable;$i++){
      $body.= "<tr><td><strong>".$tb[$i]."</strong></td>";
      $body.= "<td  bgcolor='".$tbc[$i]."'>".$tbr[$i]."</td></tr>";
	  }

  $body.="</table><p>&nbsp;</p><p>Numers of tables in the db: <b>".$numtable."</b></p>";
  
  include "../templates/sge5-future/admcp.php";
?>
