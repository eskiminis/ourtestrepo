<script type="text/javascript">
var aqres = new Array();  //array risorse appena lo script è lanciato
var apres = new Array();  //array rate di produzione oraria
	<?php //crea aqres e apres
	$resd=mysql_query("SELECT * FROM `".TB_PREFIX."resdata`");
	$nres=mysql_num_rows($resd);
	$aqres=mysql_fetch_array( mysql_query("SELECT * FROM ".TB_PREFIX."city WHERE id='$sge->id_city' LIMIT 1;") );
	while($riga=mysql_fetch_array($resd)){ 
		$budlev=mysql_fetch_array( mysql_query("SELECT lev FROM `builds` WHERE `planet` =$sge->id_city AND `func` = 'res".$riga['id']."' LIMIT 1;") );?> 
		aqres[<?=$riga['id'];?>] = <?=$aqres['res'.$riga['id']];?>;
		apres[<?=$riga['id'];?>] = <?=($riga['prod_rate']*$budlev['lev']);?>;
	<?php } ?>
// tempo quando lo script è lanciato	
var vtsl=new Date();
var tsl=vtsl.getTime();

function updres(){
	var vtmn=new Date();
	var tmn=vtmn.getTime();
	for ( var j=1; j<=<?=$nres;?>; j++ ){
		var tml=(tmn-tsl)/3600; //time left (diffd)	
		var upres= parseInt(aqres[j]+(apres[j]/3600)*tml);
		var span="res"+j;
		document.getElementById(span).innerHTML=upres;
	}
	setTimeout("updres();",6000);
}
</script>
<?php //new res sys fully integrated! 
if($secure!="y") {echo "<meta http-equiv='Refresh' content='0; url=../../index.php'> ";}

$r_max = "";
if(MAG_E=="1"){
	$qmag=mysql_query("SELECT * FROM ".TB_PREFIX."builds WHERE planet ='$sge->id_city' AND func ='mag_e'");
	if(mysql_num_rows($qmag)>0){ //yes magazine
			$amag=mysql_fetch_array($qmag);
			$mag_lv=$amag['lev'];
	}
	else{ $mag_lv=0; }
	$r_max=$mag_lv*100+MG_max_cap;
	$r_max=" / ".$r_max;
}

//your citys
$qytc=mysql_query("SELECT * FROM `".TB_PREFIX."city` WHERE `owner` =".$sge->id);
$eytc="";
while( $riga=mysql_fetch_array($qytc) ){
	$sel="";
	if($sge->id_city==$riga['id']) $sel="selected";
	$eytc.="<option value='".$riga['id']."' ".$sel.">".$riga['name']."</option>";	
}
?> <blockquote>
<table border="0" width="100%"><tr><td>
ID: <?php echo $sge->username; ?></td><td><table border="0"><tr>
<?php 
$resd=mysql_query("SELECT * FROM `".TB_PREFIX."resdata`");
$nres=mysql_num_rows($resd);
$aqres=mysql_fetch_array( mysql_query("SELECT * FROM ".TB_PREFIX."city WHERE id='$sge->id_city'") );
while($riga=mysql_fetch_array($resd)){ 
	$abbl_r=mysql_fetch_array( mysql_query("SELECT * FROM ".TB_PREFIX."builds WHERE planet ='$sge->id_city' AND func ='res".$riga['id']."'") );
	$res_ora[$riga['id']]=$riga['prod_rate']*$abbl_r['lev'];
	echo "<td>".$riga['name']." : <span id='res".$riga['id']."'>".(int)$aqres['res'.$riga['id']]."</span>".$r_max."</td>"; 
}

if(POP_E=="1"){ echo "<td> ".$lang['pop']." :".$aqres['pop']; }
?>
<tr></table></td><td>
<select name="city" onchange="this.form.submit()"><?=$eytc;?></select> &nbsp;&nbsp;&nbsp;<a href="message.php">PM(<?php echo $nmsg; ?>)</a> &nbsp;&nbsp;&nbsp; <span id="theTime" style="position:static font-family: arial; font-size: 9pt"></span> <?php if($usrarray['tut']>=0){ include("plugins/tut.php");} ?>
</td></tr></table>
 </blockquote>
