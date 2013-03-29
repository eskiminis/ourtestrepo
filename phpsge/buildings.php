<?php include ("func.php");
include("head.php");
//recupero builds

$qris=mysql_query("SELECT * FROM ".TB_PREFIX."t_builds");
$body="";
if ($_GET['bid']) {
	$bid=(int)$_GET['bid'];
 	$abud=$sge->que_build($bid, $sge->id_city);
	if($abud==false){$body.="<div class='warn'>".$lang['no-resources']."</div><br>";}
}
$eqbc=$sge->act_build($sge->id_city);
// template \\

switch(CITY_SYS){

	case 1:
	
		$head=file_get_contents("templates/js/buildings.js");
		if($eqbc){
			$body.="<table width='600' cellpadding='1'>";
			$bqs=mysql_query("SELECT * FROM ".TB_PREFIX."bque WHERE `city` ='".$sge->id_city."'");
			
			while( $rab=mysql_fetch_array($bqs) ){	
				$rtimr=$rab['end']-mtimetn();
				$cqbk=mysql_fetch_array( mysql_query("SELECT `name`, `func` FROM `".TB_PREFIX."t_builds` WHERE `id` =".$rab['bud_id']) );
			
				$budinf=mysql_fetch_array( mysql_query("SELECT * FROM `".TB_PREFIX."builds` WHERE `planet` =".$sge->id_city." AND `func` = '".$cqbk['func']."' LIMIT 1;") );
			
				$body.= "<tr><td>".$cqbk['name']." (Liv: ".($budinf['lev']+1).")</td><td class='k'>		<div id='blc' class='z'>".$rtimr."<br>		<a href='buildings.php?listid=1&amp;cmd=cancel&amp;planet=1'>Interrompere</a></div>		<script language='JavaScript'>			pp = '".$rtimr."';";
				$body.=			"pk = '1';";
				$body.=			"pm = 'cancel';";
				$body.=		"pl = '1';";
				$body.=			"t();";
				$body.=	"</script></td></tr>";
			}
			$body.="</table>";
		}
		
		//show builds
		$body.="<table width='600' border='1' cellspacing='0' cellpadding='1'>";
		while ( $riga=mysql_fetch_array($qris) ) {
			//build levels
			$ffunc=$riga['func'];
			$reqs="";
			$plac=mysql_fetch_array( mysql_query("SELECT * FROM ".TB_PREFIX."builds WHERE id =".$riga['id']." AND planet='$sge->id_city' AND func='$ffunc'") );
			$lev=$plac['lev'];
			if ($lev=="") { $lev=0; }
		
			//i have resources?
			if($sge->ct_res_bud($riga['id'])==true){
				// if no requisite
				$build=false;
				if($riga['req_bud']=="0" and $riga['req_res']=="0") $build=true;
				else if($riga['req_res']=="0"){
					$crqbc=mysql_query("SELECT * FROM ".TB_PREFIX."builds WHERE `id` =".$riga['req_bud']." AND `lev` >=".$riga['rb_lev']." AND `planet` =$sge->id_city");
					if( mysql_num_rows($crqbc)!=0 ) $build=true;
				}
				else if($riga['req_bud']=="0"){
					$crqrs=mysql_query("SELECT * FROM ".TB_PREFIX."research WHERE `id_res` =".$riga['req_res']." AND `lev` >=".$riga['rr_lev']." AND `usr` =$sge->id");
					if( mysql_num_rows($crqrs)!=0 ) $build=true;		
				}
				else{
					$crqbc=mysql_query("SELECT * FROM ".TB_PREFIX."builds WHERE `id` =".$riga['req_bud']." AND `lev` >=".$riga['rb_lev']." AND `planet` =$sge->id_city");		
					$crqrs=mysql_query("SELECT * FROM ".TB_PREFIX."research WHERE `id_res` =".$riga['req_res']." AND `lev` >=".$riga['rr_lev']." AND `usr` =$sge->id");
					if( (mysql_num_rows($crqbc)!=0) and (mysql_num_rows($crqrs)!=0) ) $build=true;
				}
					
				if($build==true){$ctb="<a href='buildings.php?bid=".$riga['id']."'><b>".$lang['build']."</b></a>";}
				else {$ctb=""; 
					$rbnam=mysql_fetch_array( mysql_query("SELECT name FROM ".TB_PREFIX."t_builds WHERE	id =".$riga['req_bud']." LIMIT 1;") );
					$reqs="<br><span class='Stile3'>".$lang['require']." : ".$rbnam['name']." x".$riga['rb_lev']."</span>";
				}
			}
			else {$ctb="<div align='center'><span class='Stile3'>".$lang['no-resources']."</span></div>";}
			
			$rescbr="";
			$resd=mysql_query("SELECT * FROM `".TB_PREFIX."resdata`");
			while($fres=mysql_fetch_array($resd)) {$rescbr.=$fres['name']." : ".(int)($riga['c_res'.$fres['id']]+$riga['c_res'.$fres['id']]*$lev*$riga['res_mpl'])." "; }
			
			if(POP_E=="1"){$rescbr.=$lang['pop']." : ".$riga['pop_req'];}
			$body.="<tr><td class='l'><div align='center'> <img src='".IBUD.$riga['img']."'></div></td><td class='k'><div align='center'> ".$riga['name']." x".$lev."</div><span class='Stile1'>".$rescbr."</span><br>".$lang['time']." : ".(int)($riga['time'] + $riga['time'] * $lev * $riga['time_mpl'])." ".$lang['time_s']."".$reqs."</td><td class='k'><div align='center'> ".$riga['desc']."</div></td><td class='k'>".$ctb."</td></tr>";
		
		} 
		
		$body.="</table>";
		
		$secure="y";
		include("templates/".TEMPLATE."/body.php");

	break; //end case 1;
//case 2
case 2:
	include("templates/".TEMPLATE."/buildings.php");
break;

}
?>
