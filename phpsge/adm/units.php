<?php 
include("../config.php");
include ("../func.php");

session_start();
if ( $_SESSION['alog'] == "" ) {
header("Location: index.php?msg=login error"); }

$id=$_SESSION['aid'];
$nik=$_SESSION['anik'];
($_SESSION['lang']) ? include("../lang/".$_SESSION['lang'].".lng") : include("../lang/".LANG.".lng");

Conect(); 
$news=mysql_fetch_array(mysql_query ("SELECT news1 FROM ".TB_PREFIX."conf"));
if ($_POST['act']=="anew") { $news1=$_POST['news1'];
	mysql_query("UPDATE ".TB_PREFIX."conf SET news1 = '$news1' LIMIT 1"); 
}

// resurces table fields
	$dfrtable="";
	$resd=mysql_query("SELECT * FROM `".TB_PREFIX."resdata`");
	while($fres=mysql_fetch_array($resd)){
		$dfrtable.=" c_res".$fres['id'].",";	
	}

//recupero unt
$sris="SELECT * FROM ".TB_PREFIX."t_unt";
$qris=mysql_query($sris);

$nunt=mysql_num_rows($qris);
$untid=$nunt + 1;

if ($_POST['act']=="add") {
	$uname=$_POST['uname'];
	$urac=$_POST['rac'];
	$img=$_POST['img'];
	$atk=$_POST['atk'];
	$diff=$_POST['diff'];
	$vel=$_POST['vel'];
	$resd=mysql_query("SELECT * FROM `".TB_PREFIX."resdata`");
	$crest="";
	while($fres=mysql_fetch_array($resd)){
		$crest.=" '".$_POST['c_res'.$fres['id']]."',";
	}
	$etime=$_POST['etime'];
	$desc=$_POST['desc'];

	mysql_query("INSERT INTO `".TB_PREFIX."t_unt` (`id`, `name`, `race`, `img`, `atk`, `dif`, `vel`, ".$dfrtable." `etime`, `desc`) VALUES ($untid, '$uname', '$urac', '$img', '$atk', '$diff', '$vel',".$crest." '$etime', '$desc');");
}

//modify untit --< post
if($_POST['uid']){
	$resd=mysql_query("SELECT * FROM `".TB_PREFIX."resdata`");
	$crest="";
	while($fres=mysql_fetch_array($resd)){
		$crest.=" c_res".$fres['id']." = '".$_POST['c_res'.$fres['id']]."',";
	}
	
	mysql_query("UPDATE `".TB_PREFIX."t_unt` SET `name` = '".$_POST['nam']."', `race` = '".$_POST['rac']."', `atk` = '".$_POST['atk']."', `dif` = '".$_POST['dif']."', `vel` = '".$_POST['vel']."',".$crest." `etime` = '".$_POST['etime']."', `req_bud` = '".$_POST['reqbud']."', `rb_lev` = '".$_POST['budlev']."' WHERE `id` =".$_POST['uid']." LIMIT 1 ;");
}
//xxxxxxxxxxxxxxxxxxxxxxxxxxxx\\
$sris="SELECT * FROM ".TB_PREFIX."t_unt";
$qris=mysql_query($sris);

//__________________________________
	$tbrf="";
	$resd=mysql_query("SELECT * FROM `".TB_PREFIX."resdata`");
	while($fres=mysql_fetch_array($resd)){
		$tbrf.="<td>".$lang['rescm']." ".$fres['name']."</td>";
	}

$body="<table width='100%' border='0' cellspacing='1' cellpadding='1'>
<tr><td>".$lang['nam']."</td><td>".$lang['rac']."</td><td>".$lang['atk']."</td><td>".$lang['dif']."</td><td>".$lang['vel']."</td>".$tbrf."<td>".$lang['time']." (Sec)</td><td>Req</td></tr>";
//mostra unt
// -----
$i=1;
while ( $riga=mysql_fetch_array($qris) ) {

	$option="<option value='0'>".$lang['all-races']."</option>";
	if($riga['race']=="0"){$option="<option value='0' selected>".$lang['all-races']."</option>";}
	
	$qfr=mysql_query("SELECT * FROM `".TB_PREFIX."races`");
	while ($rrac=mysql_fetch_array($qfr) ) { 
		$sel="";
		if($riga['race']==$rrac['id']){$sel="selected";}
		$option.="<option value='".$rrac['id']."' ".$sel.">".$rrac['rname']."</option>";
	}

	$rfid="";
	$resd=mysql_query("SELECT * FROM `".TB_PREFIX."resdata`");
	while($fres=mysql_fetch_array($resd)){
		$rfid.="<td><input type='number' name='c_res".$resd['id']."' value='".$riga['c_res'.$fres['id']]."' min='0' size='1'></td>";
	}
	
	// print builds
	 //list of req builds - 0 none
	$sel="";
	if( $riga['req_bud']==0 ){ $sel="selected"; } 
	$orb="<option value='0' $sel >---</option>";
	
	$oqris=mysql_query("SELECT * FROM ".TB_PREFIX."t_builds");
	while( $arbf=mysql_fetch_array($oqris) ) {
		$sel="";
		if( $riga['req_bud']==$arbf['id'] ){ $sel="selected"; } 
		$orb.="<option value='".$arbf['id']."' $sel >".$arbf['name']."</option>";
	}
	
	$body.= "<form method='post' action=''><input type='hidden' name='uid' value='".$riga['id']."'><tr><td><div align='center'> <input typu='text' name='nam' value='".$riga['name']."' size='10'></div></td><td><select name='rac'>".$option."</select></td><td><input type='number' min='0' name='atk' value='".$riga['atk']."' size='1'></td><td><input type='number' min='0' name='dif' value='".$riga['dif']."' size='1'></td><td><input type='number' min='0' name='vel' value='".$riga['vel']."' size='1'></td>".$rfid."<td><input type='number' min='0' name='etime' value='".$riga['etime']."' size='5'></td><td>Req Bud: <br><select name='reqbud'>".$orb."</select><br><input type='number' min='0' name='budlev' size='3' value='".$riga['rb_lev']."'></td><td><div align='center'><input type='image' name='submit' src='../img/icons/b_edit.png' onclick='document.thisform.submit()'></div><div align='center'><img src='../img/icons/x.png'></div></td></tr></form>";

	$i = $i + 1;
} 

// add new unit (html)
$option="<option value='0'>".$lang['all-races']."</option>";
$qfr=mysql_query("SELECT * FROM `".TB_PREFIX."races`");
while ($rrac=mysql_fetch_array($qfr) ) { 
	$option.="<option value='".$rrac['id']."'>".$rrac['rname']."</option>";
}

$body.="</table>  </div>
<h2>".$lang['add']." unit</h2>
<div> 
  <form method='post' action=''>
    <label><input type='hidden' name='act' value='add'>
      ".$lang['name'].": <input type='text' name='uname' id='uname' size='15'>
      </label>
  ".$lang['race'].": 
  <label>
  <select name='rac' id='rac'>".$option."</select>
  </label>
  ".$lang['img'].": 
  <label>
  <input type='text' name='img' id='img' size='11'>
  </label>
  att/diff: 
  <label>
  <input type='text' name='atk' id='atk' size='3'>
  </label>
  / 
  <label>
  <input type='text' name='diff' id='diff' size='3'>
  </label>
  <label>
  Velocity: <input name='vel' type='text' size='3'>
  </label>";
  $resd=mysql_query("SELECT * FROM `".TB_PREFIX."resdata`");
	$crest="";
	while($fres=mysql_fetch_array($resd)){
	  $body.="<label>
	  ".$fres['name'].": <input name='c_res".$fres['id']."' type='text' size='3'>
	  </label>";
	}
  $body.="<label>
  Time (sec) <input name='etime' type='text' size='5'>
  </label>
  <label>
  Desc: <input name='desc' type='text' size='10'>
  </label>
  <label>
  <br><br><div align='center'><input type='submit' name='button' id='button' value='".$lang['add']."' size='20'></div>
  </label>
  </form>";
  
  include "../templates/sge5-future/admcp.php";
?>
