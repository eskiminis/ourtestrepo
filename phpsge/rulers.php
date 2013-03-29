<?php include ("func.php");
($_SESSION['lang']) ? include("./lang/".$_SESSION['lang'].".lng") : include("./lang/".LANG.".lng");
Conect();
include("plugins/installed.php");
// generating phpsge template \\
$rulers=mysql_fetch_array(mysql_query("SELECT rulers FROM ".TB_PREFIX."conf LIMIT 1;"));
$body=$rulers['rulers'];

$secure="y";
include("templates/".TEMPLATE."/rulers.php");
?>
