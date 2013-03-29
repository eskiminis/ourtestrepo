<?php 
include("func.php");
($_SESSION['lang']) ? include("./lang/".$_SESSION['lang'].".lng") : include("./lang/".LANG.".lng");
Conect(); 
$body="phpSGE coded by Aldrigo Raffaele 'Raffa50'<br>
DO NOT MODIFY THE FOOTER. DO NOT DELETE ALDRIGO RAFFAELE'S NAME<br>
Give the rights of your work also to Aldrigo Raffaele and phpSGE DevTeam.<br>
phpSGE is under license and your work can be cancelled.<br>
phpSGE is 100% free and you can't make money whit it.<br><br>
You can edit phpSGE code<br><br>
If you made a mod it's a donatin, and you can't claim phpSGE as your (and you can't make a similar project)<br>
You also agree with this rulers: <a href='https://sourceforge.net/apps/phpbb/phpstrategygame/viewtopic.php?f=3&t=15'>https://sourceforge.net/apps/phpbb/phpstrategygame/viewtopic.php?f=3&t=15</a> <br>
<br>
<h3>Thanks To:</h3>
<b>Core</b>:<br>
Nikita Kushnir 'AgManiX' <br><br>
<b>Testing</b>:<br />
Dmitriy Zvozdeckiy 'ENDima'
<br /><br />
<b>Skins</b>:<br>
Pasquale Iovine <br><br /><br /><br /><br />";
include("templates/".TEMPLATE."/rulers.php");
?>
