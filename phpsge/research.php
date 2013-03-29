<?php include ("func.php");
include("head.php");
($_SESSION['lang']) ? include("./lang/".$_SESSION['lang']."/research.lng") : include("./lang/".LANG."/research.lng");

if($_GET['act']=="res"){
	$idres=(int)$_GET['rid'];
	$sge->que_research($idres);
}

//research

$arq=mysql_query("SELECT * FROM ".TB_PREFIX."t_research WHERE `arac` =0 or ".$race);

if($_GET['act']){ mysql_query("INSERT INTO `".TB_PREFIX."research` (`id_res` ,`usr` ,`lev`) VALUES ('".mysql_real_escape_string($_GET['rid'])."', '$sge->id', '1');"); }
//template

$body='';
//show res.

$qr=mysql_query("SELECT * FROM `".TB_PREFIX."builds` WHERE `planet` =$sge->id_city AND `func` = 'reslab'");
if( mysql_num_rows($qr)!=0 ){
	$body.="<table width='512' border='1' cellspacing='0' cellpadding='5'>";
	while ( $riga=mysql_fetch_array($arq) ) {
		$rradu=mysql_query("SELECT * FROM `".TB_PREFIX."research` WHERE usr =$sge->id and id_res =".$riga['id']." LIMIT 1;");
		if(mysql_num_rows($rradu)==0){$lev=0;} else{ $ftlr=mysql_fetch_array($rradu); $lev=$ftlr['lev']; }
	
		$resd=mysql_query("SELECT * FROM `".TB_PREFIX."resdata`");
		$resf="";
		while($fres=mysql_fetch_array($resd)) {$resf.=$fres['name'].": ".$riga['c_res'.$fres['id']]." ";}
		$resf.="";
	
		//resource control
		$trv=true;
		$resd=mysql_query("SELECT * FROM `".TB_PREFIX."resdata`");
		$aqres=mysql_fetch_array( mysql_query("SELECT * FROM ".TB_PREFIX."city WHERE id='$sge->id_city'") );
		while($fres=mysql_fetch_array($resd)){ 
	            // resource you have < resource than cost (if true)-> you can't build; fixed by raffa
			if($aqres['res'.$fres['id']]<$riga['c_res'.$fres['id']]) {$trv=false;}
		}
	
		if($trv==true){ 
			$build=false;
			if($riga['req_bud']=="0" and $riga['req_res']=="0") $build=true;
			else if($riga['req_res']=="0"){
				$crqbc=mysql_query("SELECT * FROM ".TB_PREFIX."builds WHERE `id` =".$riga['req_bud']." AND `lev` >=".$riga['rb_lev']." AND `planet` =$sge->id_city");
				if( mysql_num_rows($crqrs)!=0 ) $build=true;	
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
			
			if($build==true) $resb="<a href='?act=res&rid=".$riga['id']."'><b>".$lang['research']."</b></a>"; 
			else $resb=$lang['no_req'];
		}
		else { $resb="<span class='Stile3'>".$lang['no_req']."!</span>"; }
	
		$body.= "<tr><td><img src='./img/research/".$riga['img']."' /></td><td class='k'><div align='center'>".$riga['name']."<br />(".$lang['research_liv'].": ".$lev.") <br><span class='Stile1'>".$resf."</span><br /></div></td><td class='k'>".$resb."</td></tr>";
	} 

$body.="</table>";
} else $body.=$lang['no_research_lab'];

$secure="y";
include("templates/".TEMPLATE."/body.php");
?>
