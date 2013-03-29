<?php
$var= file_exists("config.php");
if ($var==false) { header ("Location: ./install/index.php"); }

session_start();
( $_SESSION['log'] == "" ) ? header("Location: index.php") : '';
$sge=new sge_main();

$sge->id=$_SESSION['id'];
$sge->username=$_SESSION['nik'];

Conect();
// User Language System - do not change!
($_SESSION['lang']) ? include("./lang/".$_SESSION['lang'].".lng") : include("./lang/".LANG.".lng");
// End User Language System
$uq = "SELECT * FROM ".TB_PREFIX."users WHERE id='$sge->id' LIMIT 1;";
$usrarray = mysql_fetch_array( mysql_query($uq) );
if ( mysql_num_rows( mysql_query($uq) )==0 ) { header("Location: index.php?msg=login error"); }

$rank=$usrarray['rank'];
$race=$usrarray['race'];

($_SESSION['ccity']) ? $sge->id_city=$_SESSION['ccity'] : $sge->id_city=$usrarray['capcity'] && $_SESSION['ccity']=$usrarray['capcity']; 

// resurces, units, research, ataks
$sge->resources();
$sge->act_unit($_SESSION['id'], $sge->id_city);
$sge->act_research();

$sge->returnunits($sge->id_city);
$sge->c_atk($sge->id_city);

$aqres=mysql_fetch_array( mysql_query("SELECT * FROM ".TB_PREFIX."city WHERE id='$sge->id_city' LIMIT 1;") );

switch(MAP_SYS){
	case 1:
		$gal=$aqres['galaxy'];
		$sys=$aqres['system'];
	break;
	
	case 2:
		$gpos=mysql_fetch_array( mysql_query("SELECT * FROM `".TB_PREFIX."map` WHERE `city` =$sge->id_city LIMIT 1;") );
		$x=$gpos['x'];
		$y=$gpos['y'];
	break;
}

// nome città
$cucn=$aqres['name'];

$nmsg=mysql_num_rows( mysql_query("SELECT * FROM `".TB_PREFIX."umsg` WHERE `to` =$sge->id AND `read` =0") );

?>

