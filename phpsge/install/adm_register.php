<?php
$var= file_exists("../config.php");
if ($var==false) { header ("Location: err.php?msg=noconfig"); }
if ($_GET['lang']=="") { header ("Location: index.php"); }
$glang = $_GET['lang'];
include("../lang/".$glang.".lng");
include ("../func.php");
Conect();
$tusr=mysql_num_rows ( mysql_query ("SELECT * FROM ".TB_PREFIX."users") );
// if there aren't player you are installing phpsge and you are admin of the server
if ( $tusr > 0 ) { header("Location: err.php"); }
//recupero razzr
$sris="SELECT * FROM ".TB_PREFIX."races";
$qris=mysql_query($sris);

if ($_POST['do']=="y" and $tusr==0) { 
	register();
	//set admin rank
	mysql_query("UPDATE `".TB_PREFIX."users` SET `rank` = '3', `last_log` = NOW( ) WHERE `id` =1 LIMIT 1 ;");
	header("Location: ../index.php");
}

$body="<form action='' method='post'>
<input type='hidden' name='do' value='y'>
<p>".$lang['nik'].": 
  <label>
  &nbsp; <input type='text' name='rnik' id='rnik'>
  </label>
  <span class='Stile1'></span></p>
<p>".$lang['password'].":  
  <label> &nbsp;
  <input type='password' name='rpass' id='rpass'>
  </label>
</p>
<p>E-mail: 
  <label>
 &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; <input type='text' name='email' id='email'>
  </label>
</p>
<p>".$lang['city'].": 
  <input type='text' name='rcct' id='rnik2'>
</p>
</div>
<h2>".$lang['race']."</h2>
<div>
<br>
<table width='200' border='0' cellspacing='0' cellpadding='0'>";
//mostra razze
$i=1;
while ( $riga=mysql_fetch_array($qris) ) {
	if ($i==1){
	$body.= "<tr><td><div align='center'><input name='rac' type='radio' id='r1' value='1' checked></div></td><td><div align='center'> <img src='../".IRACE.$riga['img']."'></div></td><td><div align='center'></div></td><td><div align='center'> ".$riga['rname']."</div></td></tr>";
	}
	else {
	$body.= "<tr><td><div align='center'><input name='rac' type='radio' id='r1' value='".$i."'></div></td><td><div align='center'> <img src='../".IRACE.$riga['img']."'></div></td><td><div align='center'></div></td><td><div align='center'> ".$riga['rname']."</div></td></tr>";
	}
	$i = $i + 1;
}

$body.="</table>  </div>
<p align='center'>
  <label>
  <input type='submit' name='reg' id='reg' value=' ".$lang['register']." '>
  </label>
</p></form>
</div>";

$incmen="off";
include "../templates/sge5-future/admcp.php";
?>
