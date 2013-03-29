<?php 
$var= file_exists("config.php");
if ($var==false) { header ("Location: ./install/index.php"); }

include ("func.php");
if (REG_PAGE!="register.php") { header("Location: ".REG_PAGE.""); }
Conect(); 
($_SESSION['lang']) ? require "./lang/".$_SESSION['lang'].".lng" : require "./lang/".LANG.".lng";
include("plugins/installed.php");

//recupero razzr
$sris="SELECT * FROM ".TB_PREFIX."races";
$qris=mysql_query($sris);

if ($_POST['act']=="reg") { register(); }

// template \\
$secure="y";
include("templates/".TEMPLATE."/register.php");
?>
