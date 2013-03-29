<?php 
include("../config.php");
include ("../func.php");
Conect(); 
// inizialize login
session_start();
if ( $_SESSION['alog'] == "" ) { mysql_close(); header("Location: index.php?msg=login error"); }

$id=$_SESSION['aid'];
$nik=$_SESSION['anik'];

($_SESSION['lang']) ? include("../lang/".$_SESSION['lang'].".lng") : include("../lang/".LANG.".lng");

//add a build
if ($_POST['act']=="add") {
	// resources table fields
	$dfrtable="";
	$edtres="";
	$resd=mysql_query("SELECT * FROM `".TB_PREFIX."resdata`"); //fetch all resources
	while($fres=mysql_fetch_array($resd)){
		$dfrtable.=" c_res".$fres['id'].",";	
		$edtres.=" '".$_POST['cres'.$fres['id']]."',";
	}
	
	 mysql_query("INSERT INTO `".TB_PREFIX."t_builds` (`id`, `name`, `func`, `img`, `desc`,".$dfrtable." `time`, `req_bud`, `rb_lev`, `req_res`, `rr_lev`, `gpoints`) VALUES (NULL, '".$_POST['name']."', '".$_POST['func']."', '".$_POST['img']."', '".$_POST['desc']."',".$edtres." '".$_POST['time']."', '0', '0', '0', '0', '0');"); 
}

//delete bud
if($_GET['delbud']){
	mysql_query("DELETE FROM `".TB_PREFIX."t_builds` WHERE `id` = ".(int)$_GET['delbud']." LIMIT 1;");	
}

//edit build
if ($_POST['act']=="edt"){
	$dfrtable="";
	$resd=mysql_query("SELECT * FROM `".TB_PREFIX."resdata`"); //fetch all resources
	while($fres=mysql_fetch_array($resd)){
		$dfrtable.="c_res".$fres['id']." = '".$_POST['c_res'.$fres['id']]."',";	
	}
	
	mysql_query("UPDATE `".TB_PREFIX."t_builds` SET `name` = '".$_POST['bnam']."',".$dfrtable."`time` = '".$_POST['time']."',`req_bud` = '".$_POST['req_bud']."',`rb_lev` = '".$_POST['rb_lev']."' WHERE `id` =".$_POST['bid']." LIMIT 1 ;");	
}
//recupero build
$sris="SELECT * FROM ".TB_PREFIX."t_builds";
$qris=mysql_query($sris);
$nbud=mysql_num_rows($qris);
$budid=$nbud + 1;


$body="<h2>".$lang['buildings']."</h2>
<div><table width='100%' border='0' cellspacing='10' cellpadding='1'>";

//mostra builds
$i=1;
while ( $riga=mysql_fetch_array($qris) ) {
	
	// func field (beta)
	$ffield="<td>Func:<br><input type='text' name='func' value='".$riga['func']."' size='7'></td>";
	
	$cretf="";
	$resd=mysql_query("SELECT * FROM `".TB_PREFIX."resdata`"); // fetch resources
	while($fres=mysql_fetch_array($resd)){
		//generate text input for all resources
		$cretf.="<td>cost ".$fres['name'].":<br><input type='text' name='c_res".$fres['id']."' value='".$riga['c_res'.$fres['id']]."' size='3'></td>";	
	}
	
	$body.= "<form method='post' action=''><input type='hidden' name='act' value='edt'><input type='hidden' name='bid' value='".$riga['id']."'>";
	// print builds
	 //list of req builds - 0 none
	$sel="";
	if( $riga['req_bud']==0 ){ $sel="selected"; } 
	$orb="<option value='0' $sel >none</option>";
	
	$oqris=mysql_query($sris);
	while( $arbf=mysql_fetch_array($oqris) ) {
		$sel="";
		if( $riga['req_bud']==$arbf['id'] ){ $sel="selected"; } 
		$orb.="<option value='".$arbf['id']."' $sel >".$arbf['name']."</option>";
	}
	
	$body.= "<tr><td><div align='center'> <input type='text' name='bnam' value='".$riga['name']."' size='10'></div> <br><div align='center'> ".$riga['desc']."</div></td>".$ffield.$cretf."<td>Time: <input type='text' name='time' value='".$riga['time']."' size='3'><br><br>time_mpl: <input type='text' name='time_mpl' value='".$riga['time_mpl']."' size='3'></td><td>Reqs Bud:<br><select name='req_bud'>".$orb."</select><br><br>Level: <input type='text' value='".$riga['rb_lev']."' name='rb_lev' size='1'></td><td><div align='center'><input type='image' name='submit' src='../img/icons/b_edit.png' onclick='document.thisform.submit()'></div> <div align='center'><a href='?delbud=".$riga['id']."'><img src='../img/icons/x.png'></a></div></td></tr></form>";

	$i = $i + 1; 
} 

$body.="</table></div>
<h2>".$lang['add-building']."</h2>
<div>
  <form method='post' action=''>
  <input type='hidden' name='act' value='add'>
  Build Name: 
  <label>
  <input type='text' name='name' id='name' size='15'>
  </label> 
  &nbsp;&nbsp; ".$lang['description'].": 
  <label>
  <input type='text' name='desc' id='desc' size='15'>
  </label> 
  &nbsp;&nbsp;&nbsp;".$lang['img'].": 
  <label>
  <input type='text' name='img' id='img' size='15'>
  </label>";
    $resd=mysql_query("SELECT * FROM `".TB_PREFIX."resdata`");
	$crest="";
	while($fres=mysql_fetch_array($resd)){
	  $body.="<label>
	  Cost Res".$fres['id'].": <input name='c_res".$fres['id']."' type='text' size='3' value='0'>
	  </label>";
 	}
 $body.="<label>
 Time: <input type='text' name='time' id='desc' size='3' value='0'>
 </label>
 <label>
 Func: <input type='text' name='func' id='desc' size='15'>
 </label>
  <label>
  &nbsp;<input type='submit' name='add' id='add' value='".$lang['add-building']."'>
  </label></form>
</div>";

include "../templates/sge5-future/admcp.php";
?>
