<?php 
include("../config.php");
include ("../func.php");
Conect(); 
session_start();
if ( $_SESSION['alog'] == "" ) {
header("Location: index.php?msg=login error"); }

$id=$_SESSION['aid'];
$nik=$_SESSION['anik'];
($_SESSION['lang']) ? include("../lang/".$_SESSION['lang'].".lng") : include("../lang/".LANG.".lng");

if ($_POST['act']=="add") { 

	$dfrtable="";
	$crptb="";
	$resd=mysql_query("SELECT * FROM `".TB_PREFIX."resdata`"); //fetch all resources
	while($fres=mysql_fetch_array($resd)){
		$dfrtable.="`c_res".$fres['id']."`, ";	
		$crptb.=", ".$_POST['c_res'.$fres['id']];
	}

	mysql_query("INSERT INTO `t_research` (`id`, `name`, `desc`, `arac`, `img`, ".$dfrtable." `time`, `req_bud`, `rb_lev`, `req_res`, `rr_lev`, `gpoints`) VALUES (NULL, '".$_POST['rname']."', '".$_POST['rdesc']."', 0, '".$_POST['rimg']."'".$crptb.", ".$_POST['time'].", 0, 0, 0, 0, 5);"); 
}


$sris="SELECT * FROM ".TB_PREFIX."t_research";
$qris=mysql_query($sris);

$body="<h2>".$lang['researches']."</h2>
<div> <table width='50%' border='0' cellspacing='10' cellpadding='0'>";
//mostra razze
$i=1;
while ( $riga=mysql_fetch_array($qris) ) {

	$cretf="";
	$resd=mysql_query("SELECT * FROM `".TB_PREFIX."resdata`"); // fetch resources
	while($fres=mysql_fetch_array($resd)){
		//generate text input for all resources
		$cretf.="<td>".$fres['name'].":<br><input type='number' min='0' name='c_res".$fres['id']."' value='".$riga['c_res'.$fres['id']]."' size='3'></td>";	
	}

	$body.= "<tr><td><div align='center'> <img src='../".IRSC.$riga['img']."'></div></td><td><div align='center'></div></td><td><div align='center'> <input type='text' name='rnam' value='".$riga['name']."' size='13'></div></td>".$cretf."<td><div align='center'><img src='../img/icons/b_edit.png'></div></td><td><div align='center'><img src='../img/icons/x.png'></div></td></tr>";


$i = $i + 1;
}
$body.="</table>  </div>
<h2>".$lang['add']." ".$lang['researches']."</h2>
<div>
  <form method='post' action='researches.php'>
  <input type='hidden' name='act' value='add'>
  Name: 
  <label>
  <input type='text' name='rname' id='rname' size='15'>
  </label> 
  &nbsp;&nbsp;&nbsp;".$lang['description'].": 
  <label>
  <input type='text' name='rdesc' id='rdesc' size='15'>
  </label> ";

  $resd=mysql_query("SELECT * FROM `".TB_PREFIX."resdata`"); // fetch resources
	while($fres=mysql_fetch_array($resd)){
		//generate text input for all resources
		$body.= " cost ".$fres['name'].": <input type='text' name='c_res".$fres['id']."' value='0' size='3'>";	
	}

  $body.="&nbsp;&nbsp;&nbsp;".$lang['img']." src: ../".IRSC."
  <label>
  <input type='text' name='rimg' id='rimg' size='15'>
  </label>
  
  Time: <input type='text' name='time' size='3' value='0'>
  
  <label>
  &nbsp;<input type='submit' name='radd' id='radd' value='".$lang['add']."'>
  </label></form>
</div>";

include "../templates/sge5-future/admcp.php";
?>
