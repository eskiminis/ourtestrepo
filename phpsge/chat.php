<?php include("func.php");
include("head.php");


// template \\
$head="
<style>
	div.box{
		width:291px !important;width /**/:200px;
		height:190px !important;height /**/: 200px;
		overflow:auto;padding: 4px;
		border:1px solid #EEE;border-right:0 solid;
	} 

	div.box-inner{
		height: 200px;overflow:auto;
    	margin:25px 24px 0;padding-right:2px
	} 
</style>";
$head.="<script type='application/javascript' src='templates/js/chat-js.js'></script>";
$head.=" <script type='text/javascript' src='http://js.nicedit.com/nicEdit-latest.js'></script> <script type='text/javascript'>
//<![CDATA[
bkLib.onDomLoaded(function() {
	new nicEditor({buttonList : ['fontSize','bold','italic','underline','strikeThrough','forecolor','html']}).panelInstance('msg');
});
//]]>
</script>";

$body='';
$body.="<p><div class='box'>
    <div class='box-inner' id='chatlog'>";
//chat
$result=mysql_query("SELECT * FROM ".TB_PREFIX."cmsg ORDER BY `id` DESC");
 if ($result) {
	$i=0;
		while($riga=mysql_fetch_array($result)) {
			$body.= "<a href='profile.php?usr=".$riga['usrid']."' target='_blank'>".$riga['username']."</a> : ".$riga['msg']."<br>";
		}
	} 

$body.=" </div></div></p><p>&nbsp;</p>".$lang['mp'].": <label><p id='msg' class=' ' contenteditable='true' style='border: 2px solid #000'></p></label><label>&nbsp;&nbsp; <input type='button' value='".$lang['send']."' onclick=\"javascript: chat_sendm();\"></label>";

$secure="y";
$ate="off";
$blol="chat_rel();";
include("templates/".TEMPLATE."/body.php"); ?>