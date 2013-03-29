<?php
// fb login \\
if ($cookie) {
		$q = "SELECT * FROM ".TB_PREFIX."users where fbuid = '".$cookie['uid']."'";
		$result = mysql_query($q);
		$dbarray = mysql_fetch_array($result);
		if($dbarray['banned'] == 1) { header ("Location: index.php?err=ban"); }
		else {
			if(mysql_num_rows($result)>0) {
				$id=$dbarray['id'];
				session_start();
				$_SESSION['nik']=$dbarray['username'];
				$_SESSION['log']="y";
				$_SESSION['id']=$id;
				$_SESSION['lang']=$dbarray['lang'];
				if($dbarray['rank'] > 0) {
					$_SESSION['anik']=$dbarray['username'];
					$_SESSION['alog']="y";
					$_SESSION['aid']=$dbarray['id'];
					$_SESSION['lang']=$dbarray['lang'];
				}
				//registra sul db la nuova date
				$mtimet=mtimetn();
				mysql_query("UPDATE `users` SET `last_log` =  NOW( ) WHERE `id` =$id LIMIT 1 ;");
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
//login\\
?>