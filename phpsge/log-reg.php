<?php //log-reg
class sge_login {
var $username;
var $password;
var $id;

function login() { //now more secure for the sql injection
		
		$this->password = strip_tags($this->password);
		$this->username = strip_tags($this->username);

		$q = "SELECT * FROM ".TB_PREFIX."users where username = '".mysql_real_escape_string($this->username)."' AND password = '".md5($this->password)."' LIMIT 1;";
		$result = mysql_query($q);
		$dbarray = mysql_fetch_array($result);
		if($dbarray['banned'] == 1) { header ("Location: index.php?msg=You are banned!"); }
		else {
			if( mysql_num_rows($result) >0 ) {
				$id=$dbarray['id'];
				session_start();
				$_SESSION['nik']=$dbarray['username'];
				$_SESSION['log']="y";
				$_SESSION['id']=$id;
				$this->id=$id;
				$_SESSION['ccity']=$dbarray['capcity'];
				$_SESSION['lang']=$dbarray['lang'];
				if($dbarray['rank'] > 0) {
					$_SESSION['anik']=$dbarray['username'];
					$_SESSION['alog']="y";
					$_SESSION['aid']=$dbarray['id'];
					$_SESSION['lang']=$dbarray['lang'];
				}
				//registra sul db la nuova date
				$mtimet=mtimetn();
				mysql_query("UPDATE `".TB_PREFIX."users` SET `last_log` =  NOW( ) ,`ip` = '".$_SERVER['REMOTE_ADDR']."' WHERE `id` =$id LIMIT 1 ;");
				
				//ip control
				$ipqr=mysql_query("SELECT `id` , `username` , `active` , `banned` , `last_log` , `ip` FROM `".TB_PREFIX."users` WHERE `ip` = '".$_SERVER['REMOTE_ADDR']."'");
				if( mysql_num_rows($ipqr) >0 ){
					$warntxt="Two users have the same ip!<br><table border='1'><tr><td>Username</td><td>Last log</td></tr>";
					while( $riga=mysql_fetch_array($ipqr) ){
						$warntxt.="<tr><td>".$riga['username']."</td><td>".$riga['last_log']."</td></tr>";		
					}
					$warntxt.="</table>";
					mysql_query("INSERT INTO `".TB_PREFIX."warn` (`id` ,`text`) VALUES (NULL , '$warntxt');");	
				}
				
				mysql_close();
				//logged sucess
				switch(CITY_SYS){
					case 1: //ogame
						header("Location: main.php");
					break;
					
					case 2: //travian
						header("Location: ../../main.php");
					break;
					
					case 3: //flash
						return true;
					break;
				}
			}
			else {
				switch(CITY_SYS){
					case 1:
						header("Location: index.php?err=log");
					break;
					
					case 2:
						header("Location: login.php?err=log");
					break;
					
					case 3:
						return false;
					break;
				}
			}
		}
}

function logout() {
	session_start();
	$_SESSION['log']="";
	session_destroy();
	mysql_close();
}

//class end
}

function register() {
	$fbid=$_POST['fbid'];
	$nik=strip_tags($_POST['rnik']);
	$pass=md5($_POST['rpass']);
	$mail=$_POST['email'];
	$race=$_POST['rac'];
	$ncity=$_POST['rcct'];
	$lang=$_POST['lang'];
		
	if($_POST['fbid']){ $pass="0"; $mail="0"; }
	if (!$_POST['fbid'] and $nik=="" or $pass=="") { echo "Registration  is not valid! go back and fill all the form!"; }
	else {
		if($ncity=="") $ncity="City of ".mysql_real_escape_string($nik);
	

	Conect(); 
	//verifica se esiste un nome uguale
	$veryf="SELECT * FROM ".TB_PREFIX."users WHERE username='".mysql_real_escape_string($nik)."'";
	$q_ver=mysql_query($veryf);
	$ck_ver=mysql_num_rows($q_ver);
	//genera l'id utente
	$qnu="SELECT id FROM ".TB_PREFIX."users ORDER BY `id` DESC";
	$qns=mysql_query($qnu);
	$nur=mysql_num_rows($qns);
	
	if($nur>0){
		$aliu=mysql_fetch_array($qns);
		$id=$aliu['id']+1;
	}
	else{$id=$nur+1;}
	
	//e l'id della città
	$qcd="SELECT id FROM ".TB_PREFIX."city ORDER BY `id` DESC";
	$sqd=mysql_query($qcd);
	$ncd=mysql_num_rows($sqd);
	
	if($ncd>0){
		$alic=mysql_fetch_array($sqd);
		$cidr=$alic['id']+1;}
	else{$cidr=$ncd+1;}

	$mtimet=mtimetn();

	if ($ck_ver==1) { echo "username or password already exist(s)!"; }
	else {
	$reg="INSERT INTO `".TB_PREFIX."users` (`id`, `username`, `password`, `race`, `capcity`, `email`, `timestamp_reg`, `tut`, `lang`) VALUES ($id, '".mysql_real_escape_string($nik)."', '$pass', '$race', '$cidr', '$mail', '$mtimet', '-1', '$lang')";
	$q_reg=mysql_query($reg);
	
	if($_POST['fbid']){ mysql_query("UPDATE `".TB_PREFIX."users` SET `last_log` = NOW( ) ,`fbuid` = '$fbid' WHERE `id` =$id LIMIT 1 ;"); } 

	
	$dfrtable="";
	$startres="";
	$resd=mysql_query("SELECT * FROM `".TB_PREFIX."resdata`");
	while($fres=mysql_fetch_array($resd)){
		$dfrtable.=" res".$fres['id'].",";	
		$startres.=" '".$fres['start']."',";
	}
	
	// map sys registration begin \\
	switch(MAP_SYS){
	case 1:
		//ogame sys
		//generate coords for map sys 1
		do{
			$galaxy=mt_rand(0,100);
			$system=mt_rand(0,100);
			$pos=mt_rand(1,15);	
	
			$pvc=mysql_num_rows( mysql_query("SELECT * FROM ".TB_PREFIX."city WHERE galaxy='$galaxy' AND system='$sistem' AND pos='$pos'") );
	
		} while ($pvc!=0);
	
	
		$cin="INSERT INTO ".TB_PREFIX."city (id, owner, name,".$dfrtable." last_update, galaxy, system, pos) VALUES ($cidr, '$id', '".mysql_real_escape_string($ncity)."',".$startres." '$mtimet', '$galaxy', '$system', '$pos')"; 
		mysql_query($cin);
	break;
	case 2: 
		//travian sys
		//generate x,y
		do{
			$x=mt_rand(0,500);
			$y=mt_rand(0,500);
			
			$pvc=mysql_num_rows( mysql_query("SELECT * FROM `".TB_PREFIX."map` WHERE `x` =$x AND `y` =$y") );
		}while($pvc!=0);
		mysql_query("INSERT INTO `".TB_PREFIX."map` (`x`, `y`, `type`, `city`) VALUES ('$x', '$y', 'v1', '$cidr');");
		
		$cin="INSERT INTO ".TB_PREFIX."city (id, owner, name,".$dfrtable." last_update) VALUES ($cidr, '$id', '".mysql_real_escape_string($ncity)."', ".$startres." '$mtimet')";
		mysql_query($cin);
	break;
	case 3:
		//ikariam/grepolis sys
		//generate isle and isle position!
		$numisl=mysql_num_rows( mysql_query("SELECT * FROM `".TB_PREFIX."isle`") );
		
		$ipd[1]="a";
		$ipd[2]="b";
		$ipd[3]="c";
		$ipd[4]="d";
		do{
			$islid=mt_rand(1,$numisl);
			$islpos=mt_rand(1,4);
			$vsplic=mysql_fetch_array( mysql_query("SELECT * FROM `".TB_PREFIX."isle` WHERE `id` =".$islid) );
			$sicp=$vsplic['pos_'.$ipd[$islpos]];	
		}while($sicp!=0);	
		
		$cin="INSERT INTO ".TB_PREFIX."city (id, owner, name,".$dfrtable." last_update) VALUES ($cidr, '$id', '".mysql_real_escape_string($ncity)."',".$startres." '$mtimet')";
		mysql_query($cin);
		
		$isi="UPDATE `".TB_PREFIX."isle` SET `pos_".$islpos."` = '$cidr' WHERE `id` =".$islid." LIMIT 1 ;";
		mysql_query($isi);	
	break;		
	}
	
	header("Location: index.php"); }

	} 

}