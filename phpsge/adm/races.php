<?php 
include("../config.php");
include ("../func.php");
session_start();
if ( $_SESSION['alog'] == "" ) {
header("Location: index.php?msg=login error"); }

Conect(); 

$id=$_SESSION['aid'];
$nik=$_SESSION['anik'];

($_SESSION['lang']) ? include("../lang/".$_SESSION['lang'].".lng") : include("../lang/".LANG.".lng");

// add race
if ($_POST['act']=="add") { 
	$sris="SELECT * FROM ".TB_PREFIX."races";
	$qris=mysql_query($sris);
	$nraz=mysql_num_rows($qris);
	$razid=$nraz + 1;
	$rname=$_POST['rname'];
	$rdesc=$_POST['rdesc'];
	$rimg=$_POST['rimg'];
	mysql_query("INSERT INTO `".TB_PREFIX."races` (`id` ,`rname` ,`rdesc` ,`img`) VALUES ($razid , '$rname', '$rdesc', '$rimg');"); 
}

//edit race
if($_POST['mrid']){
	mysql_query("UPDATE `".TB_PREFIX."races` SET `rname` = '".$_POST['rnam']."' WHERE `id` =".$_POST['mrid']." LIMIT 1 ;");
}

//delete race
if($_GET['act']=="delrac"){
	mysql_query("DELETE FROM `".TB_PREFIX."races` WHERE `id` = ".$_GET['id']." LIMIT 1");	
}

//recupero razzr
$sris="SELECT * FROM ".TB_PREFIX."races";
$qris=mysql_query($sris);
$nraz=mysql_num_rows($qris);
$razid=$nraz + 1;

$sris="SELECT * FROM ".TB_PREFIX."races";
$qris=mysql_query($sris);


$body="<h2>".$lang['races']."</h2>
<div> <table width='410' border='0' cellspacing='10' cellpadding='0'>";
//mostra razze
$i=1;
while ( $riga=mysql_fetch_array($qris) ) {
	$ixdel="";
	if($riga['id']!=1){ $ixdel="<a href='?act=delrac&id=".$riga['id']."'><img src='../img/icons/x.png' border='0'></a>"; }

	$body.= "<form method='post' action=''><input type='hidden' name='mrid' value='".$riga['id']."'><tr><td><div align='center'> <img src='../".IRACE.$riga['img']."'></div></td><td><div align='center'></div></td><td><div align='center'>".$lang['name'].":<br> <input type='text' name='rnam' value='".$riga['rname']."' size='10'></div></td><td>".$lang['description'].":<br>".$riga['rdesc']."</td><td><div align='center'><input type='image' name='submit' src='../img/icons/b_edit.png' onclick='document.thisform.submit()'></div></td><td><div align='center'>".$ixdel."</div></td></tr></form>";


$i = $i + 1;
}
$body.="</table>  </div>
<h2>".$lang['add']." ".$lang['race']."</h2>
<div>
  <form method='post' action='races.php'>
  <input type='hidden' name='act' value='add'>
  ".$lang['name'].": 
  <label>
  <input type='text' name='rname' id='rname' size='15'>
  </label> 
  &nbsp;&nbsp;&nbsp;".$lang['description'].": 
  <label>
  <input type='text' name='rdesc' id='rdesc' size='15'>
  </label> 
  &nbsp;&nbsp;&nbsp;".$lang['img']." src: ../".IRACE."
  <label>
  <input type='text' name='rimg' id='rimg' size='15'>
  </label>
  <label>
  &nbsp;<input type='submit' name='radd' id='radd' value='".$lang['add'].$lang['race']."'>
  </label></form>
</div>";

include "../templates/sge5-future/admcp.php";
?>
