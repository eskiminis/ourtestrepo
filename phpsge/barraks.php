<?php
include ("func.php");
include("head.php");
($_SESSION['lang']) ? include "./lang/".$_SESSION['lang']."/barraks.lng" : include "./lang/".LANG."/barraks.lng";

//recupero unt
$sris="SELECT * FROM ".TB_PREFIX."t_unt WHERE race=".$race." OR race='0'";
$qris=mysql_query($sris);

if ($_POST['act']=="aunt") { $sge->que_unit($_POST['itunt'], $_POST['qunt'], $sge->id_city); }

$qcuunt=$sge->act_unit($sge->id, $sge->id_city);

//barraks level
$plac=mysql_query("SELECT * FROM ".TB_PREFIX."builds WHERE planet='$sge->id_city' AND func='barraks' LIMIT 1;");
// template \\
$head=file_get_contents("templates/js/barraks.js");
//mostra unt
if(mysql_num_rows($plac)==1){
	$body='';
	
	$body.="<script language='JavaScript'>	</script>";

if($qcuunt!=false){
	$rtimr=$qcuunt['end']-mtimetn();
	$qfu=mysql_query("SELECT * FROM ".TB_PREFIX."t_unt WHERE id=".$qcuunt['id_unt'].";");
	$body.="<table width='600' cellpadding='1'>";
	while( $qunf=mysql_fetch_array($qfu) ){
		$body.= "<tr><td>".$qunf['name']." (".$qcuunt['uqnt'].")</td><td class='k'>		<div id='blc' class='z'>".$rtimr."<br>		<a href='barraks.php?listid=1&amp;cmd=cancel&amp;planet=1'>".$lang['barraks_cancel']."</a></div>		<script language='JavaScript'>			pp = '".$rtimr."';";
		$body.=			"pk = '1';";
		$body.=			"pm = 'cancel';";
		$body.=			"pl = '1';";
		$body.=			"t();";
		$body.=		"</script></td></tr>";
	}
}

$body.="</table>";
$body.="<table width='80%' border='1' cellspacing='0' cellpadding='1'>";

while ( $riga=mysql_fetch_array($qris) ) {

		$anul=mysql_fetch_array( mysql_query("SELECT * FROM ".TB_PREFIX."units WHERE id_unt='".$riga['id']."' AND owner_id='$sge->id' AND `where` = $sge->id_city") );
		$ncu=$anul['uqnt'];
		if($ncu=="") {$ncu=0;}
		
		$body.= "<form action='' method='post'><input type='hidden' name='act' value='aunt'> <input type='hidden' name='itunt' value='".$riga['id']."'>";
		
		//---------
		$train=false;
		
		if($riga['req_bud']=="0" and $riga['req_res']=="0"){
			$train=true;
		}
		else if($riga['req_bud']!="0"){ $vqsrq=mysql_query("SELECT * FROM `".TB_PREFIX."builds` WHERE `id` =".$riga['req_bud']." AND `lev` =".$riga['rb_lev']." AND `planet` ='$sge->id_city'");
			if( mysql_num_rows($vqsrq)>0 )$train=true;
		}
		else if($riga['req_res']!="0"){
			$vqsrq=mysql_query("SELECT * FROM ".TB_PREFIX."research WHERE `id_res` =".$riga['req_res']." AND `lev` >=".$riga['rr_lev']." AND `usr` =$sge->id");
			if( mysql_num_rows($vqsrq)>0 )$train=true;	
		}
		else{
			$crqbc=mysql_query("SELECT * FROM ".TB_PREFIX."builds WHERE `id` =".$riga['req_bud']." AND `lev` >=".$riga['rb_lev']." AND `planet` =$sge->id_city");		
			$crqrs=mysql_query("SELECT * FROM ".TB_PREFIX."research WHERE `id_res` =".$riga['req_res']." AND `lev` >=".$riga['rr_lev']." AND `usr` =$sge->id");
			if( (mysql_num_rows($crqbc)!=0) and (mysql_num_rows($crqrs)!=0) ) $train=true;
		}
		
		if($train!=true) { 
			$maxunt=0; 
			$trainb=$lang['requisite']; 
		}
		else {
			$maxunt=$sge->ct_max_unt($riga['id']);
			$trainb="<input name='qunt' id='qunt".$riga['id']."' type='number' min='0' size='3' value='0' onchange=\"maxuq('qunt".$riga['id']."',".$maxunt.");\"><br><br><input type='submit' value='".$lang['barraks_train']."'><br><br><span class='Stile1'>".$lang['max_units'].": ".$maxunt."</span>";
		}
		
		//-----------
		$rescbr="";
		$resd=mysql_query("SELECT * FROM `".TB_PREFIX."resdata`");
		while($fres=mysql_fetch_array($resd)) {$rescbr.=$fres['name']." : ".$riga['c_res'.$fres['id']]." "; }
		
		if(POP_E=="1"){ $rescbr.=$lang['pop']." : ".$riga['pop_req']; }
		
		$barlev=mysql_fetch_array( mysql_query("SELECT lev FROM `".TB_PREFIX."builds` WHERE `planet` =$sge->id_city AND `func` = 'barraks' LIMIT 1;") );
		$bar_tmdl=mysql_fetch_array( mysql_query("SELECT `baru_tmdl` FROM `".TB_PREFIX."conf` LIMIT 1;") );
		$timeend= $riga['etime'] / ( ($barlev['lev']-1)*$bar_tmdl['baru_tmdl'] +1 );
		
		$body.="<tr><td class='l'><div align='center'> <img src='".IUNT.$riga['img']."'></div></td><td class='l'><div align='center'> ".$riga['name']." (".$ncu.")<br> <span class='Stile1'>(".$rescbr.")</span><br><br>".$lang['barraks_time'].": ".(int)$timeend." Sec</div></td><td class='l'><div align='center'> ".$riga['desc']."<br><br><img src='img/icons/attack.jpg'> ".$riga['atk']." <img src='img/icons/defense.jpg'> ".$riga['dif']." <img src='img/icons/move_walk.jpg'> ".$riga['vel']."</div></td><td class='k'>".$trainb."</td></tr></form>";
	}
}
else { $body=$lang['barranks_need']; }
$body.="</table>";

$secure="y";
include("templates/".TEMPLATE."/body.php");
?>
