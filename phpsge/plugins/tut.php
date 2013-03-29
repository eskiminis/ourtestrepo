<?php
Conect();

// now tut can't be 0, -1 means disabled
if($usrarray['tut']==0){mysql_query("UPDATE `".TB_PREFIX."users` SET `last_log` = NOW( ) ,`tut` = '1' WHERE `id` =".$sge->id." LIMIT 1 ;");}

$tta=mysql_fetch_array( mysql_query("SELECT * FROM `".TB_PREFIX."tutorial` WHERE `id` =".$usrarray['tut']." LIMIT 1;") );
$tit=$tta['tittle'];
$body=$tta['body'];
?>
<!--[if IE]>

<meta http-equiv="Page-Enter" content="blendTrans(duration=0.05)" />

<meta http-equiv="Page-Exit" content="blendTrans(duration=0.05)" />

<![endif]-->
<script type="text/javascript">
var ServerTime = new Date();
    ServerTime.setFullYear(2010, 10-1, 17);
    ServerTime.setHours(12, 10, 33, 0);

</script>

<script type="text/javascript" src="plugins/tut/illyriad_jh49min.js">
</script>


</head>
<style type="text/css">
<!--
.Stile1 {color: #000000}
-->
</style>

<div style="visibility: hidden; position: absolute; overflow: hidden; padding: 0px; width: 0px; left: 0px; top: 0px;" id="WzTtDiV"></div>



<table class="tn">
<tbody><tr>
<td style="white-space: nowrap; width: 56px;">
<div style="text-align: center; background-color: white; border: 1px solid black; font-weight: bold; cursor: pointer;" onClick="$('#tutorialPopup').fadeIn(function(){$('#tutorialMiddle').slideDown(function(){$('#tutorialCurStep').slideDown();});})"><br>Show Tutorial</div></td></tr>
</tbody></table>

<div class="ui-draggable Stile1" id="tutorialPopup" style="position: absolute; top: 44px; left: 323px; width: 560px; overflow: hidden; z-index: 1000;">


<div style="width: 560px; height: 80px; cursor: move; text-align: center; background-image: url(&quot;http://img13.illyriad.co.uk/img/backgrounds/tutorial_top_560w.png&quot;);" title="Drag to move tutorial window"><img id="tutorialText" style="margin: 17px auto auto;" src="plugins/tut/tutorial.png"></div>
<div id="tutorialMiddle" style="width: 560px; background-image: url(&quot;http://img13.illyriad.co.uk/img/backgrounds/tutorial_middle_560w.png&quot;);">
<div style="padding-left: 40px; padding-right: 40px; font-size: 9pt;"><!-- Current Page Descriptions -->

<fieldset><legend><?=$tit;?></legend>
<?=$body;?>
</fieldset>



<div><table style="width: 100%;"><tbody><tr><td style="text-align: left;"><a href="main.php?tutend=1"><input class="buttonsmall" value="End Tutorial" type="submit"></a></td><td style="text-align: right;"><input style="margin-left: auto; margin-right: 0px;" class="buttonsmall" value="Hide" onClick="$('#tutorialMiddle').slideUp(function(){$('#tutorialPopup').fadeOut();})" type="submit"></td></tr></tbody></table></div>
</div>
</div>
<div style="width: 560px; height: 80px; background-image: url(&quot;/img/backgrounds/tutorial_bottom_560w.png&quot;);"></div>
</div>

<script type="text/javascript">
  $("#tutorialPopup").draggable();
</script>

<style type="text/css">
   .ui-dialog {background-color:white;word-wrap:break-word;}
   .ui-dialog-titlebar {}
   .ui-dialog-title {font-size:8pt}
   .ui-dialog td {font-size:8pt}
   .ui-button-text  {font-size:8pt}
   .ui-dialog-buttonpane .ui-button-text-only {margin:3px !important;padding:3px !important;}
</style>
