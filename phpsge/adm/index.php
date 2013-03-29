<?php $var= file_exists("../config.php");
if ($var==false) { header ("Location: ../index.php"); }
session_start();

if($_GET['act']=="lout"){
	$_SESSION['alog']="";
	session_destroy();
	header("Location: ../main.php");
}	

if($_SESSION['alog']=="y"){ header("Location: main.php"); }
else{ header("Location: ../index.php?msg=You must login first and be admin!"); }

?>