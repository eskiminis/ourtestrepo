<?php include ("../func.php");

session_start();
if ( $_SESSION['alog'] == "" ) {
header("Location: index.php?msg=login error"); }

$id=$_SESSION['aid'];
$nik=$_SESSION['anik'];

($_SESSION['lang']) ? include("../lang/".$_SESSION['lang'].".lng") : include("../lang/".LANG.".lng");

Conect();

//editor
// Nome della cartella...
$dir = '..';

$page=$_GET['page'];
$reader = file_get_contents($dir."/".$page);



?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?php echo SERVER_NAME ?></title>

<LINK REL="shortcut icon" HREF="../img/favico.ico">
<link href="../templates/sge-easy/css/core.css" rel="stylesheet" type="text/css">

<script src="../scripts/styleswitcher.js" type="text/javascript"></script>
<script src="../time.js" type="text/javascript"></script>

<style type="text/css">
body
{
font : 10px Verdana, Tahoma, Helvetica, sans-serif;
}
.Stile1 {
	color: #b1ed61;
	font-weight: bold;
}
</style>
</head>

<body>

<div id="header">
<div class="title"><?php echo $lang['admin-cp-of']; ?> <?php echo SERVER_NAME ?></div>
</div>
<div class="bar-r"><?php echo SUB_DESC ?></div>

<?php include ("menu.php"); ?>

<div id="middle">
<div class="content">
<div class="intro">
<p><?php echo $lang['welcome']; ?>, <?php echo $nik; ?>! &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; [<span id="theTime" style="position:absolute; left:413px; top:200px; font-family: arial; font-size: 9pt"></span>]</p>
</div>
<h2 id="news">&nbsp;</h2>
<?php if($_POST['act']=="sqlqr" and $query!=false){ echo "<div class='news-body'><div class='sucess'>query executed!</div></div>"; } else if($_POST['act']=="sqlqr" and $query==false){ echo "<div class='news-body'><div class='warn'>there is an error in your query!</div></div>"; } ?>
<h2 class="news-title"><span class="news-date"></span><?php echo $lang['advanced-editor']; ?></h2>
<div class="news-body">
<form method="get" action="">
<p><?php echo $lang['yae']; ?>: <select name="page" onChange="this.form.submit()">
<option>---</option>
<?php 
 
// Apertura...
$handle = opendir($dir);
 
// Lettura...
while (false !== ($files = readdir($handle))) {
    // Escludo gli elementi '.' e '..' e stampo il nome del file...
    if ($files != '.' && $files != '..'){
        $sel='';
		if($_GET['page']==$files){$sel='selected';}
		echo '<option '.$sel.'>'.substr($files,0,-4).'</option>';
	}
}
 
// Chiusura...
closedir($handle); ?></select>
</form>
  <form method="post" action="aeditor.php">
    <label>
    <p><textarea name="page" id="page" cols="150" rows="35"><?php echo $reader; ?></textarea></p>
    </label>
    <p><input type="submit" value="Save"></p>
  </form>
  </div>

<p align="center">&nbsp;</p></div>
<?php
$secure="y"; 
include("footer.php"); ?>
</body>
</html>
