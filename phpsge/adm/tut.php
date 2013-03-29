<?php 
include("../config.php");
include ("../func.php");

session_start();
if ( $_SESSION['alog'] == "" ) {
header("Location: index.php?msg=login error"); }

$id=$_SESSION['aid'];
$nik=$_SESSION['anik'];

($_SESSION['lang']) ? include("../lang/".$_SESSION['lang'].".lng") : include("../lang/".LANG.".lng");

Conect();

if($_POST['act']=="adtut"){
	$qrtut=mysql_query("SELECT * FROM `".TB_PREFIX."tutorial`");
	mysql_query("INSERT INTO `".TB_PREFIX."tutorial` (`id`, `tittle`, `body`, `next_tut`) VALUES (NULL, 'asd', 'aaaaa', '3');");	
}

$body.="<h2>".$lang['tutorial']."</h2>
<div><table width='65%' border='1' cellpadding='3' cellspacing='0'>
<tr><td><span class='Stile1'>ID</span></td><td><span class='Stile1'>Title</span></td><td><span class='Stile1'>Body</span></td><td><span class='Stile1'>Next tut</span></td><td><span class='Stile1'>Action</span></td></tr>";

	$qrtut=mysql_query("SELECT * FROM `".TB_PREFIX."tutorial`");
	while( $riga=mysql_fetch_array($qrtut) ){
		$body.= "<tr><td>".$riga['id']."</td><td>".$riga['tittle']."</td><td>".$riga['body']."</td><td>".$riga['next_tut']."</td><td><input type='image' name='submit' src='../img/icons/b_edit.png'></td></tr>";	
	}
	
$body.="</table>
</div>

<h2>Add Tutorrial</h2>
<div>
<form method='post' action=''> <input type='hidden' name='act' value='adtut'>
Tittle: <input type='text' name='ttit'>
<p>Body: 
   <textarea name='tbody' cols='70' rows='8'></textarea>
</p>
<br><input type='submit' value='Add'>
</form>
</div>";

include "../templates/sge5-future/admcp.php";
?>
