<?php //phpSGE functions 052 by Aldrigo Raffaele
require "config.php";  //contains gama data (such as mysql data)
// configuration file (config.php) and phpSGE files version (used for db and config control)
global $confcver,$newver,$scriptver;
$confcver="053";
$newver="072";
$scriptver="063";
error_reporting(0); // change to error_reporting(E_ALL);


function Conect() {  //conection to de db (parameters define in config,php wich was included)
	mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
	mysql_select_db(SQL_DB);
}

function mtimetn(){  //time stamp now
	//data oggi
	$dt=date("j");
	$mt=date("n");
	$yt=date("y");
	//ore oggi
	$timenow=getdate();
	$hn=substr("0" . $timenow["hours"], -2);
	$mih=substr("0" . $timenow["minutes"], -2);
	$sn=substr("0" . $timenow["seconds"], -2);
	$mtimet=mktime($hn,$mih,$sn,$mt,$dt,$yt); //data e ora oggi pronto per le operazioni e per il db!

	return $mtimet;
}

//common functions
function cce_qunt(){ //cancella da units se uqnt=0
	$qr=mysql_query("SELECT id FROM `".TB_PREFIX."units` WHERE `uqnt` =0");
	while( $riga=mysql_fetch_array($qr) ) mysql_query("DELETE FROM `".TB_PREFIX."units` WHERE `id` = ".$riga['id']." LIMIT 1");
}

// login e registration in log-reg.php page!
include ("log-reg.php");

// un type record che serve nelle battaglie
class untb{
	public $id;
	public $id_unt;
	public $uqnt;
	public $uvel;
	public $atk;
	public $dif;	
};

class sge_main {
var $username;
var $id_city;
var $id;

public function resources() { //new (post)035 res sys
	//require $id_city
	$drs=mysql_query("SELECT * FROM ".TB_PREFIX."city WHERE id ='$this->id_city' LIMIT 1;");
	$adr=mysql_fetch_array($drs);
	//data e ora
	$ktimer=$adr['last_update'];  //data e ora sul db pronto per le operazioni!
	$mtimet=mtimetn(); //data e ora oggi pronto per le operazioni e per il db!
	$diffd=($mtimet-$ktimer)/3600;

	$resd=mysql_query("SELECT * FROM `".TB_PREFIX."resdata`");
	while($riga=mysql_fetch_array($resd)){
	
		//resource quantity
		$resid=$riga['id'];
		$qres1=$adr['res'.$resid];
	
		//build level
		$abbl_r1=mysql_fetch_array( mysql_query("SELECT * FROM ".TB_PREFIX."builds WHERE planet ='$this->id_city' AND func ='res".$resid."'") );
		//distribuzione risorse
		$res1_ora=$riga['prod_rate']*$abbl_r1['lev'];
		$up_res1_tot=$qres1+($res1_ora*$diffd);
		
		if(MAG_E=="1"){	 // if magazine engine enabled (1)
			$qmag=mysql_query("SELECT * FROM ".TB_PREFIX."builds WHERE planet ='$this->id_city' AND func ='mag_e'");
			
			if(mysql_num_rows($qmag)>0){ //yes magazine
				$amag=mysql_fetch_array($qmag);
				$mag_lv=$amag['lev'];
			}
			else{ $mag_lv=0; }
			
			$r_max=$mag_lv*100+MG_max_cap;
			if ($up_res1_tot > $r_max) { $up_res1_tot=$r_max; }
		}
		
		mysql_query("UPDATE ".TB_PREFIX."city SET `res".$resid."` =  '$up_res1_tot' WHERE `id` ='$this->id_city' LIMIT 1 ");
	}
	
	mysql_query("UPDATE ".TB_PREFIX."city SET `last_update` ='$mtimet' WHERE `id` ='$this->id_city' LIMIT 1;");
}

function addpoints($num){
	$cup=mysql_fetch_array( mysql_query("SELECT `points` FROM `".TB_PREFIX."users` WHERE `id` =".$this->id." LIMIT 1;") );
	$tpt=$cup['points']+(int)$num;
	mysql_query("UPDATE `".TB_PREFIX."users` SET `points` = '$tpt',`last_log` = NOW( ) WHERE `id` =".$this->id." LIMIT 1 ;");
}

// buildings functions
function que_build($bid, $id_city, $field=NULL) {  //053 sys - by raffa
	
	$qcb=mysql_query("SELECT * FROM ".TB_PREFIX."t_builds WHERE id ='".(int)$bid."' LIMIT 1;");
	$acb=mysql_fetch_array($qcb);
	
	$bic=mysql_query("SELECT lev FROM `".TB_PREFIX."builds` WHERE `planet` =$this->id_city AND `func` = '".$acb['func']."' LIMIT 1;");
	if( mysql_num_rows($bic)!=0 ){
		$cblev=mysql_fetch_array($bic);
		$timend= mtimetn()+ $acb['time'] + ( $acb['time'] * $cblev['lev'] * $acb['time_mpl'] );
		$resmolt= $cblev['lev'] * $acb['res_mpl'];
	}
	else { $timend=mtimetn()+$acb['time']; $resmolt=0;} // level=0 because no builded
	
	//controllo sule risorse
	$trv=true;
	$resd=mysql_query("SELECT * FROM `".TB_PREFIX."resdata`");
	$aqres=mysql_fetch_array( mysql_query("SELECT * FROM ".TB_PREFIX."city WHERE id='$this->id_city' LIMIT 1;") );
	while($riga=mysql_fetch_array($resd)){ 
		if( $aqres['res'.$riga['id']] < ($acb['c_res'.$riga['id']]+$acb['c_res'.$riga['id']]*$resmolt) ) {$trv=false;}
	}
	
	if(POP_E=="1"){ if( $aqres['pop'] < $acb['pop_req'] ) $trv=false; }
	
	if($trv==true){
		$qadf=""; $qaf="";
		if(CITY_SYS==2){$qadf=" ,`field`"; $qaf=", '".$field."'";}
		
		mysql_query("INSERT INTO `".TB_PREFIX."bque` (`id` ,`city` ,`bud_id` ,`end`".$qadf.") VALUES (NULL , '$this->id_city', '".(int)$bid."', '$timend'".$qaf.");");
		$resd=mysql_query("SELECT * FROM `".TB_PREFIX."resdata`");
		while($riga=mysql_fetch_array($resd)){ 
			$up_res1_tot=$aqres['res'.$riga['id']]-$acb['c_res'.$riga['id']];
			mysql_query("UPDATE ".TB_PREFIX."city SET res".$riga['id']." ='$up_res1_tot' WHERE id =$this->id_city LIMIT 1");
		}
		if(POP_E=="1"){
			 $updpop=$aqres['pop']-$acb['pop_req'];
			 mysql_query("UPDATE `".TB_PREFIX."city` SET `pop` = '$updpop' WHERE `id` =$this->id_city LIMIT 1 ;");
		}
		//add points
		$this->addpoints($acb['gpoints']);
		return true;
	}
	else { return false; }
}

function act_build($id_city) {
	//search if there in a build in the que - return the resting time
	$bqs=mysql_query("SELECT * FROM ".TB_PREFIX."bque WHERE `city` ='".(int)$id_city."' LIMIT 1;");
	while( $rab=mysql_fetch_array($bqs) ){
		
		$rtimr=$rab['end']-mtimetn();
		if($rtimr<=0){
			//build
			$qcb=mysql_query("SELECT * FROM ".TB_PREFIX."t_builds WHERE `id` ='".$rab['bud_id']."' LIMIT 1;");
			$acb=mysql_fetch_array($qcb);
				//level control!
			$QLC=mysql_query("SELECT * FROM ".TB_PREFIX."builds WHERE id ='".$rab['bud_id']."' AND planet='$id_city'");
			// verifica sul livello 0 - se non c'è costruzisce livello 1
			if(mysql_num_rows($QLC)==0) {
				
				$qadf=""; $qaf="";
				if(CITY_SYS==2){$qadf=" ,`field`"; $qaf=", '".$rab['field']."'";}
				mysql_query("INSERT INTO ".TB_PREFIX."builds ( id, lev, planet, func".$qadf." ) VALUES ( '".$rab['bud_id']."', '1', '".(int)$id_city."', '".$acb['func']."'".$qaf." )");
			}  //altrimenti aumenta il livello
			else { 
				$alcb=mysql_fetch_array($QLC);
				$lcb=$alcb['lev']+1;
		
				mysql_query("UPDATE `".TB_PREFIX."builds` SET `lev` =  '$lcb' WHERE `id` ='".$rab['bud_id']."' AND planet='$id_city' LIMIT 1");
			}
			mysql_query("DELETE FROM `".TB_PREFIX."bque` WHERE `id` ='".$rab['id']."' LIMIT 1;");
		}
		else { return $rab; }//return array
	}		
}

// research function
function que_research($idres){ //non completo, deve accodare la ricerca, per ora la completa direttamente senza far aspettare il tempo!

	$resd=mysql_query("SELECT * FROM `".TB_PREFIX."resdata`");
	$aqres=mysql_fetch_array( mysql_query("SELECT * FROM ".TB_PREFIX."city WHERE id='$this->id_city'") );
	
	$qcb=mysql_query("SELECT * FROM ".TB_PREFIX."t_research WHERE id ='".(int)$idres."' LIMIT 1;");
	$acb=mysql_fetch_array($qcb);
	
	$timend=mtimetn()+$acb['time'];
	
	$trv=true;
	while($riga=mysql_fetch_array($resd)){ 
		if($aqres['res'.$riga['id']]<$acb['c_res'.$riga['id']]) {$trv=false;}
	}
	
	if($trv==true){
		mysql_query("INSERT INTO `".TB_PREFIX."rque` (`id` ,`usr` ,`res_id` ,`end`) VALUES (NULL , '$this->id', '".(int)$idres."', '$timend');");
		$this->addpoints($acb['gpoints']);
	
		$resd=mysql_query("SELECT * FROM `".TB_PREFIX."resdata`");
		while($riga=mysql_fetch_array($resd)){ 
			$up_res1_tot=$aqres['res'.$riga['id']]-$acb['c_res'.$riga['id']];
			mysql_query("UPDATE ".TB_PREFIX."city SET res".$riga['id']." ='$up_res1_tot' WHERE id =$this->id_city LIMIT 1");
		}
	}
	else return false;
	
}

function act_research(){
	$rqr=mysql_query("SELECT * FROM `".TB_PREFIX."rque` WHERE `usr` =".$this->id);
	while( $qaqr=mysql_fetch_array($rqr) ){
		$rtimr=$qaqr['end']-mtimetn();
		if($rtimr<=0){
			$qcb=mysql_query("SELECT * FROM ".TB_PREFIX."t_research WHERE id ='".$qaqr['res_id']."' LIMIT 1;");
			$acb=mysql_fetch_array($qcb);
	
			if(mysql_num_rows($rqr)==0) { mysql_query("INSERT INTO `".TB_PREFIX."research` (`id_res` ,`usr` ,`lev`) VALUES ('".$qaqr['res_id']."', '".$this->id."', '1');"); }
			else { 
				$ari=mysql_fetch_array( mysql_query("SELECT * FROM `".TB_PREFIX."research` WHERE `id_res` =".$qaqr['res_id']." AND `usr` =".$this->id." LIMIT 1;") );
				$rnlv=$ari['lev']+1;
				mysql_query("UPDATE `".TB_PREFIX."research` SET `lev` = '".$rnlv."' WHERE `id_res` =".$qaqr['res_id']." AND `usr` =".$this->id." LIMIT 1;");
			}
			mysql_query("DELETE FROM `".TB_PREFIX."rque` WHERE `id` = ".$qaqr['id']." LIMIT 1;");
		}
		else return $qaqr;
	}
	
}

// units functions --- fixed for the new res sys (035->039) by raffa 
function que_unit($id_unt, $uqnt, $id_city) {
	
		if($uqnt > $this->ct_max_unt($id_unt) ){ $uqnt=(int)$this->ct_max_unt($id_unt); }
		
		$rut=mysql_fetch_array( mysql_query("SELECT * FROM ".TB_PREFIX."t_unt WHERE id='".(int)$id_unt."'") );
		
		$trv=true;
		$resd=mysql_query("SELECT * FROM `".TB_PREFIX."resdata`");
		$aqres=mysql_fetch_array( mysql_query("SELECT * FROM ".TB_PREFIX."city WHERE id='$id_city'") );
		while($riga=mysql_fetch_array($resd)){ 
			if($aqres['res'.$riga['id']]<$rut['c_res'.$riga['id']]) {$trv=false;}
		}
		
		if ($trv==true) {
			$barlev=mysql_fetch_array( mysql_query("SELECT lev FROM `".TB_PREFIX."builds` WHERE `planet` =$id_city AND `func` = 'barraks' LIMIT 1;") );
			$tn=mtimetn();
			$bar_tmdl=mysql_fetch_array( mysql_query("SELECT `baru_tmdl` FROM `".TB_PREFIX."conf` LIMIT 1;") );
			$timeend= $tn + ( $rut['etime']*$uqnt ) / ( ($barlev['lev']-1)*$bar_tmdl['baru_tmdl'] +1 );
			mysql_query("INSERT INTO `".TB_PREFIX."uque` (`id`, `id_unt`, `uqnt`, `planet`, `end`) VALUES (NULL, '$id_unt', '$uqnt', '$id_city', '$timeend');");
			
			$resd=mysql_query("SELECT * FROM `".TB_PREFIX."resdata`");
			while($riga=mysql_fetch_array($resd)){ 
				$up_res1_tot=$aqres['res'.$riga['id']]-($rut['c_res'.$riga['id']]*$uqnt);
				mysql_query("UPDATE ".TB_PREFIX."city SET res".$riga['id']." ='$up_res1_tot' WHERE id =$id_city LIMIT 1");
			}
			
			if(POP_E=="1") { 
				$updpop=$aqres['pop']-$rut['pop_req'];
				mysql_query("UPDATE ".TB_PREFIX."city SET `pop` = '$updpop' WHERE id =$id_city LIMIT 1"); 
			}
			
			return true;		  
		}
			
		else { return false; }

}

function act_unit($idow, $id_city) {
	$uqsq=mysql_query("SELECT * FROM ".TB_PREFIX."uque WHERE planet='".(int)$id_city."'");
	while( $ruq=mysql_fetch_array($uqsq) ){

		$uid=$ruq['id_unt'];
		$uqt=$ruq['uqnt'];

		// time !
		$rtimr=$ruq['end']-mtimetn();
		if($rtimr>0) {return $ruq;}
		else {
			//control if unt already exist - search owner, specific unit, action=0 means that unit is the city
			$uucex=mysql_query("SELECT * FROM ".TB_PREFIX."units WHERE owner_id=".(int)$idow." AND id_unt=".(int)$uid."");
			if(mysql_num_rows($uucex)==0){
				mysql_query("INSERT INTO `".TB_PREFIX."units` (`id` ,`id_unt` ,`uqnt` ,`owner_id` ,`from` ,`to` ,`where` ,`time` ,`action`)VALUES (NULL , '$uid', '$uqt', '$idow', NULL , NULL , '$id_city', '0', '0')");	
				mysql_query("DELETE FROM `".TB_PREFIX."uque` WHERE `id` = ".$ruq['id']." LIMIT 1"); 
			}
			//only for units - because thath unit can already exist...
			else {
				$aucx=mysql_fetch_array($uucex);
				$uqtot=$uqt+$aucx['uqnt'];
				mysql_query("UPDATE `".TB_PREFIX."units` SET `uqnt` =  '".$uqtot."' WHERE `id` =".$aucx['id'] ." LIMIT 1 ;");
				mysql_query("DELETE FROM `".TB_PREFIX."uque` WHERE `id` = ".$ruq['id']." LIMIT 1"); 
			}
		}	
	}
}

//atack to suffer. $id_city is your city (in this case)!
function c_atk($id_city) {
		//search ataking units
	$qratkunt=mysql_query("SELECT * FROM `".TB_PREFIX."units` WHERE `to` =$id_city AND `time` <=".mtimetn()." AND `action` =1");
	// there are units in $id_city???
	if( mysql_num_rows($qratkunt) > 0 ){
		//your units (or supports)
		$quyrunt=mysql_query("SELECT *  FROM `".TB_PREFIX."units` WHERE `where` = $id_city");
		if( mysql_num_rows($quyrunt) > 0 ){
			//battle begin
			 // create an array of your units
			$i=0;
			while( $ayru=mysql_fetch_array($quyrunt) ){
				
				$ayu[$i]=new untb;
				$ayu[$i]->id=$ayru['id'];
				$ayu[$i]->id_unt=$ayru['id_unt'];
				$ayu[$i]->uqnt=$ayu['uqnt'];
				
				//get units data from t_unt
				$velq=mysql_fetch_array( mysql_query("SELECT * FROM `".TB_PREFIX."t_unt` WHERE `id` =".$ayu[$i]->id) );
				$ayu[$i]->uvel=(int)$velq['vel'];
				$ayu[$i]->atk=(int)$velq['atk'];
				if($ayu[$i]->dif!=0) $ayu[$i]->dif=(int)$velq['dif'];
				else $ayu[$i]->dif=1;
				
				$i++;
			}
			//ordino ayu per velocità
			//step 1.1: search the fastest units
			$sav=new untb;
			for($i=0;$i <  sizeof($ayu);$i++){
				$vel=$ayu[$i]->uvel;
				for($j=$i;$j <= sizeof($ayu);$j++){
					if(	$ayu[$j]->uvel > $vel ){
						$vel=$ayu[$j]->uvel;
						$k=$j;
					}
				}
				$sav=$ayu[$i];
				$ayu[$i]=$ayu[$k];
				$ayu[$k]=$sav;
			}
			
			$i=0;
			while( $aatu=mysql_fetch_array($qratkunt) ){
				$aat[$i]=new untb;
				$aat[$i]->id=$aatu['id'];
				$aat[$i]->id_unt=$aatu['id_unt'];
				$aat[$i]->uqnt=$aatu['uqnt'];	
				
				//get vel
				$velq=mysql_fetch_array( mysql_query("SELECT `vel` FROM `".TB_PREFIX."t_unt` WHERE `id` =".$aat[$i]->id) );
				$aat[$i]->uvel=(int)$velq['vel'];
				$aat[$i]->atk=(int)$velq['atk'];
				if($aat[$i]->dif!=0) $aat[$i]->dif=(int)$velq['dif'];
				else $aat[$i]->dif=1;
				
				$i++;
			}
			//ordino aat per velocità
			//step 1.2: search the fastest units
			$sav=new untb;
			for($i=0;$i <  sizeof($aat);$i++){
				$vel=$aat[$i]->uvel;
				for($j=$i;$j <= sizeof($aat);$j++){
					if(	$aat[$j]->uvel > $vel ){
						$vel=$aat[$j]->uvel;
						$k=$j;
					}
				}
				$sav=$aat[$i];
				$aat[$i]=$aat[$k];
				$aat[$k]=$sav;
			}

			// duello
			$lenayu=sizeof($ayu); $yi=0;
			$lenaat=sizeof($aat); $ai=0;
			while( ($lenayu != $yi) and ($lenaat != $ai) ){
				$savayu=$ayu[$yi]->uqnt;
				$ayu[$yi]->uqnt = (int) ($ayu[$yi]->uqnt * $ayu[$yi]->dif - $aat[$ai]->uqnt * $aat[$ai]->atk)/$ayu[$yi]->dif;
				$aat[$ai]->uqnt = (int) ($aat[$ai]->uqnt * $aat[$ai]->dif - $savayu * $ayu[$yi]->atk)/$aat[$ai]->dif;
				
				if( $ayu[$yi]->uqnt<=0 ) {$ayu[$yi]->uqnt=0; $yi++;}
				if( $aat[$ai]->uqnt<=0 ) {$aat[$ai]->uqnt=0; $ai++;}
			}
			
			// update units
			//your untis
			$q= mysql_query("SELECT * FROM `".TB_PREFIX."units` WHERE `id` =".$ayu[$i]->id." LIMIT 1;");
			while( $qr=mysql_fetch_array($q) ){ 
				mysql_query("UPDATE `".TB_PREFIX."units` SET `uqnt` = '".$ayu[$i]->uqnt."' WHERE `id` =".$ayu[$i]->uqnt." LIMIT 1 ;");
			}
			
			$q= mysql_query("SELECT * FROM `".TB_PREFIX."units` WHERE `id` =".$aat[$i]->id." LIMIT 1;");
			while( $qr=mysql_fetch_array($q) ){ 
				mysql_query("UPDATE `".TB_PREFIX."units` SET `uqnt` = '".$aat[$i]->uqnt."',`from` = ".$qr['to']." ,`to` = ".$qr['from']." ,`where` = NULL,`time` = ".( mtimetn() +20 )." ,`action` = '0' WHERE `id` =".$aat[$i]->uqnt." LIMIT 1 ;");
			}
			// clear units where uqnt=0
			cce_qunt();
		}
		else {
			//there are no units so enemy win
			while( $riga=mysql_fetch_array($qratkunt) ){
				if( $riga['time']<= mtimetn() ) mysql_query("UPDATE `".TB_PREFIX."units` SET `from` = ".$riga['to']." ,`to` = ".$riga['from']." ,`where` = NULL ,`time` = 0 ,`action` = '0' WHERE `id` =".$riga['id']." LIMIT 1;");
			}
		}
	}
}

//reinforces
function returnunits($id_city){
	$q=mysql_query("SELECT * FROM `".TB_PREFIX."units` WHERE `to` =1 AND `action` =0");	
	while( $riga=mysql_fetch_array($q) ){
		if( $riga['time'] <= mtimetn() ) mysql_query("UPDATE `units` SET `from` = NULL, `to` = NULL, `where` = '".$riga['to']."' WHERE `id` =".$riga['id']." LIMIT 1 ;");
	}
}

//resource controls\\
// units
// $uid is unit id, return the number of $uid that you can maximum build
function ct_max_unt($uid){
	$qcb=mysql_query("SELECT * FROM `".TB_PREFIX."t_unt` WHERE `id` =".(int)$uid." LIMIT 1;");
	$acb=mysql_fetch_array($qcb);
	
	$maxunt=0; $i=1;
	
	$resd=mysql_query("SELECT * FROM `".TB_PREFIX."resdata`");
	$aqres=mysql_fetch_array( mysql_query("SELECT * FROM ".TB_PREFIX."city WHERE id='$this->id_city'") );
	while($riga=mysql_fetch_array($resd)){ 
		if( $acb['c_res'.$riga['id']] != 0 ){
			$mtv=(int)$aqres['res'.$riga['id']] / $acb['c_res'.$riga['id']] ;
			if($i==1){ $maxunt=(int)$mtv; $i++;}
			else if( (int)$mtv < $maxunt ){ $maxunt=(int)$mtv; }
		}
	}
	
	if(POP_E=="1") {
		if( $maxunt > $aqres['pop'] ) $maxunt=$aqres['pop'];
	}
	
	return $maxunt;
		
}

//buildings, is a build buildible? (resource control for a build)
function ct_res_bud($bid){
	$qcb=mysql_query("SELECT * FROM ".TB_PREFIX."t_builds WHERE id ='".(int)$bid."' LIMIT 1;");
	$acb=mysql_fetch_array($qcb);
	//recupero della tua build
	$ybi=mysql_query("SELECT lev FROM `".TB_PREFIX."builds` WHERE `planet` =".$this->id_city." AND `func` = '".$acb['func']."' LIMIT 1;");
	if( mysql_num_rows($ybi)!=0 ){
		$cblev=mysql_fetch_array($ybi);
		$resmolt= $cblev['lev'] * $acb['res_mpl'];
	}
	else $resmolt=0; // level=0 because no builded
	//controllo sule risorse
	$trv=true;
	$resd=mysql_query("SELECT * FROM `".TB_PREFIX."resdata`");
	$aqres=mysql_fetch_array( mysql_query("SELECT * FROM ".TB_PREFIX."city WHERE id='".$this->id_city."' LIMIT 1;") );
	while($riga=mysql_fetch_array($resd)){ 
		if( $aqres['res'.$riga['id']] < ($acb['c_res'.$riga['id']]+$acb['c_res'.$riga['id']]*$resmolt) ) {$trv=false;}
	}
	return $trv;	
}

// send message 
function snmsg($from, $to, $mtit, $msg, $mtp=1, $aiid=NULL){
	$mtit=mysql_real_escape_string($mtit);
	$msg=mysql_real_escape_string($msg);
	mysql_query("INSERT INTO `".TB_PREFIX."umsg` (`id` ,`from` ,`to` ,`mtit` ,`text` ,`read` ,`mtype` ,`aiid`) VALUES (NULL , '$from', '$to', '$mtit', '$msg', '0', '$mtp', '$aiid');");	
	return true;
}

// class sge_main end \\
};

function bud_func(){ //show buildings func
	$bf=array();
	$bf[0]="none";
	
	$qr=mysql_query("SELECT * FROM `".TB_PREFIX."resdata`");
	while( $riga=mysql_fetch_array($qr) ){
		$bf[]="res".$riga['id'];	
	}
	
	$bf[]="barraks";
	$bf[]="reslab";
	
	if(MAG_E==1){ $bf[]="mag_e"; }	
	if(POP_E==1){ $bf[]="pop_e"; }
}

function sge_ver() {  //return php Sge DB version (useful for update the db!)
	$svqr=mysql_query("SELECT sge_ver FROM ".TB_PREFIX."conf");
	$vvc=mysql_fetch_array($svqr);
	if($svqr){return $vvc['sge_ver'];}
	else{ return false; }
}
function rumax_ver(){ //return phpSGE RuMAX DB version
	$rumax_get_sql=mysql_query("SELECT rumax_ver FROM ".TB_PREFIX."conf");
	$rumax_vvc=mysql_fetch_array($rumax_get_sql);
	echo "<b>RuMAX v<span class='Stile1'>".$rumax_vvc['rumax_ver']."</span></b>";
}
?>
