<?php 
include("../config.php");
include("../func.php");

session_start();
if ( $_SESSION['alog'] == "" ) { header("Location: index.php?msg=login error"); }

$id=$_SESSION['aid'];
$nik=$_SESSION['anik'];
($_SESSION['lang']) ? include("../lang/".$_SESSION['lang'].".lng") : include("../lang/".LANG.".lng");

Conect(); 
$acres=mysql_fetch_array(mysql_query ("SELECT * FROM ".TB_PREFIX."conf"));

if ($_POST['act']=="anew") { 
$news1=$_POST['freeRTE_content'];
mysql_query("UPDATE ".TB_PREFIX."conf SET news1 = '$news1' LIMIT 1"); }

if ($_POST['act']=="rledit") { 
$news1=$_POST['freeRTE_content'];
mysql_query("UPDATE ".TB_PREFIX."conf SET rulers = '$news1' LIMIT 1"); }

$acres=mysql_fetch_array(mysql_query ("SELECT * FROM ".TB_PREFIX."conf"));

//edit res
if($_POST['resid']){
	mysql_query("UPDATE `".TB_PREFIX."resdata` SET `name` = '".$_POST['nres']."',`prod_rate` = '".$_POST['prr']."',`start` = '".$_POST['start_res']."' WHERE `id` =".$_POST['resid']." LIMIT 1 ;");
}

//add res
if($_POST['act']=="addres"){
	
	$resanum=mysql_num_rows( mysql_query("SELECT * FROM `".TB_PREFIX."resdata`") );
	$resaddn=$resanum+1;
	
	mysql_query("INSERT INTO `".TB_PREFIX."resdata` (`id` ,`name` ,`prod_rate` ,`start`) VALUES ($resaddn , '".$_POST['resn']."', '".$_POST['prodrate']."', '".$_POST['start']."');");	
	
	mysql_query("ALTER TABLE `".TB_PREFIX."city` ADD `res".$resaddn."` DOUBLE NOT NULL DEFAULT '0' AFTER `res".$resanum."` ;");
	mysql_query("ALTER TABLE `".TB_PREFIX."t_builds` ADD `c_res".$resaddn."` INT( 10 ) NOT NULL DEFAULT '0' AFTER `c_res".$resanum."` ;");
	mysql_query("ALTER TABLE `".TB_PREFIX."t_unt` ADD `c_res".$resaddn."` INT( 10 ) NOT NULL DEFAULT '0' AFTER `c_res".$resanum."` ;");
	mysql_query("ALTER TABLE `".TB_PREFIX."t_research` ADD `c_res".$resaddn."` INT( 10 ) NOT NULL DEFAULT '0' AFTER `c_res".$resanum."` ;");
}

//delete res
if($_GET['act']=="delres"){
	mysql_query("DELETE FROM `".TB_PREFIX."resdata` WHERE `id` = ".$_GET['id']." LIMIT 1;");
	
	mysql_query("ALTER TABLE `".TB_PREFIX."city` DROP `res".$_GET['id']."`");
	mysql_query("ALTER TABLE `".TB_PREFIX."t_builds` DROP `c_res".$_GET['id']."`");
	mysql_query("ALTER TABLE `".TB_PREFIX."t_unt` DROP `c_res".$_GET['id']."`");
	mysql_query("ALTER TABLE `".TB_PREFIX."t_research` DROP `c_res".$_GET['id']."`");
}

// edit config
if($_POST['act']=="econf"){
	$fh = fopen("../config.php", 'w') or die("can't open file. set chmod to 777! you don't have rights on files");
	$text = file_get_contents("config.tpl");
	$text = preg_replace("'%SERVERNAME%'",$_POST['servern'],$text);
	$text = preg_replace("'%SDESC%'",$_POST['sdesc'],$text);
	$text = preg_replace("'%SMANDESC%'",$_POST['mandesc'],$text);
	$text = preg_replace("'%SSERVER%'",SQL_SERVER,$text);
	$text = preg_replace("'%SUSER%'",SQL_USER,$text);
	$text = preg_replace("'%SPASS%'",SQL_PASS,$text);
	$text = preg_replace("'%SDB%'",SQL_DB,$text);
	$text = preg_replace("'%PREFIX%'",TB_PREFIX,$text);
	$text = preg_replace("'%TEMP%'", $_POST['tpl'], $text);
	$text = preg_replace("'%CSS%'", $_POST['css'], $text);
	$text = preg_replace("'%MGS%'", MAG_E, $text);
	$text = preg_replace("'%MAP%'", MAP_SYS, $text);
	$text = preg_replace("'%CTS%'", CITY_SYS, $text);
	$text = preg_replace("'%LANG%'", $_POST['lang'], $text);
	fwrite($fh, $text);
	fclose($fh);
}

//rulers
$arl=mysql_fetch_array(mysql_query("SELECT rulers FROM ".TB_PREFIX."conf LIMIT 1;"));

$body="<div>
<div>
<p>".$lang['welcome'].", ".$nik."! &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
</div>
<div class='art-block'>
                                <div class='art-block-body'>
                                  <div class='art-blockcontent'>
                                    <div class='art-blockcontent-tl'></div>
                                                <div class='art-blockcontent-tr'></div>
                                                <div class='art-blockcontent-bl'></div>
                                                <div class='art-blockcontent-br'></div>
                                                <div class='art-blockcontent-tc'></div>
                                                <div class='art-blockcontent-bc'></div>
                                                <div class='art-blockcontent-cl'></div>
                                                <div class='art-blockcontent-cr'></div>
                                                <div class='art-blockcontent-cc'></div>
                                                <div class='art-blockcontent-body'>
                                            <!-- block-content -->
<h2>Resources Editor 035 sys<a href='#' onClick='javascript:showHide(DES);'>".$lang['sh']."</a></h2><div id='DES' style='display:none'>
<div>";
$resd=mysql_query("SELECT * FROM `".TB_PREFIX."resdata`");
while($fres=mysql_fetch_array($resd)){
	
	$body.="<form name='form1' method='post' action=''>Resource ".$fres['id']." name: 
  <input type='hidden' name='act' value='edres'> <input type='hidden' name='resid' value='".$fres['id']."'>
  <input type='text' name='nres' id='nres' value='".$fres['name']."' size='15'>
  Rate Moltiplier per Level: 
  <label>
  <input type='text' name='prr' id='prr' value='".$fres['prod_rate']."' size='3'>
  </label>
  <label>
  &nbsp;start res".$fres['id'].":&nbsp;
  <input type='text' name='start_res' id='start_res' size='7' value='".$fres['start']."'>&nbsp;&nbsp;
  <input type='submit' value='OK'>&nbsp;&nbsp;";
  if($fres['id']!=1){ $body.="<a href='?act=delres&id=".$fres['id']."'><img src='../img/icons/x.png' border='0'></a>"; }
	$body.=" 
  </form>
  <br>";
 }
	$body.="<br><p><h2>Add new resources</h2><br>
<form name='addres' method='post' action=''><input type='hidden' name='act' value='addres'>
Res name: <input type'text' name='resn' size='15' value='res name'> Production rate: <input type='text' name='prodrate' size='3' value='1'> Strart res: <input type='text' name='start' size='5' value='100'> &nbsp;&nbsp;<input type='submit' value='Add'>
</form></p>
  </div></div><!-- /block-content -->
                                            
                                            		<div class='cleared'></div>
                                                </div>
                                  </div></div></div>

 <div class='art-block'>
                                <div class='art-block-body'>
                                  <div class='art-blockcontent'>
                                    <div class='art-blockcontent-tl'></div>
                                                <div class='art-blockcontent-tr'></div>
                                                <div class='art-blockcontent-bl'></div>
                                                <div class='art-blockcontent-br'></div>
                                                <div class='art-blockcontent-tc'></div>
                                                <div class='art-blockcontent-bc'></div>
                                                <div class='art-blockcontent-cl'></div>
                                                <div class='art-blockcontent-cr'></div>
                                                <div class='art-blockcontent-cc'></div>
                                                <div class='art-blockcontent-body'>
                                            <!-- block-content -->
											 <h2>Config Editor <a href='#' onClick='javascript:showHide(CFG);'>".$lang['sh']."</a></h2><div id='CFG' style='display:none'>
<div>
  <form method='post' action=''>
  <input type='hidden' name='act' value='econf'>
   <p> <label>
   Template: <select name='tpl'>";

  $dir = '../templates';
  $handle = opendir($dir);
  // Lettura...
while (false !== ($files = readdir($handle))) {
    // Escludo gli elementi '.' e '..' e stampo il nome del file...
    if ($files != '.' && $files != '..' && $files!='js'){
        $sel='';
		if("sge-easy"==$files){$sel='selected';}
		$body.= '<option '.$sel.'>'.$files.'</option>';
	}
}

   $body.="</select>
   
      Css: <select name='css' id='css'>";
  $dir = '../templates/'.TEMPLATE.'/css';

  $handle = opendir($dir);
  // Lettura...
while (false !== ($files = readdir($handle))) {
    // Escludo gli elementi '.' e '..' e stampo il nome del file...
    if ($files != '.' && $files != '..'){
        $sel='';
		if(CSS==TEMPLATE."/css/".$files){$sel='selected';}
		$body.= '<option '.$sel.'>'.$files.'</option>';
	}
}
    $body.="</select></label>
    <label>
      Language: <select name='lang' id='lang'>";

  $dir = '../lang';
  $handle = opendir($dir);
  // Lettura...
while (false !== ($files = readdir($handle))) {
    // Escludo gli elementi '.' e '..' e stampo il nome del file...
    if ($files != '.' && $files != '..'){
        $sel='';
		if(LANG==$files){$sel='selected';}
		$body.= '<option '.$sel.'>'.$files.'</option>';
	}
}

    $body.="</select>
    </p>
      </label>
      <p> Server name: <input type='text' name='servern' value='".SERVER_NAME."' size='35'> </p>
      <p> Subtittle: <input type='text' name='sdesc' value='".SUB_DESC."' size='35'> </p>
      <p> Main description: <input type='text' name='mandesc' value='".MAIN_DESC."' size='35'> </p>
    <p>
      <label>
      <input type='submit' name='button' id='button' value=' >> Edit << '>
      </label>
    </p>
  </form>
  </div></div><!-- /block-content -->
                                            
                                            		<div class='cleared'></div>
                                                </div>
                                  </div></div></div>

<div class='art-block'>
                                <div class='art-block-body'>
                                  <div class='art-blockcontent'>
                                    <div class='art-blockcontent-tl'></div>
                                                <div class='art-blockcontent-tr'></div>
                                                <div class='art-blockcontent-bl'></div>
                                                <div class='art-blockcontent-br'></div>
                                                <div class='art-blockcontent-tc'></div>
                                                <div class='art-blockcontent-bc'></div>
                                                <div class='art-blockcontent-cl'></div>
                                                <div class='art-blockcontent-cr'></div>
                                                <div class='art-blockcontent-cc'></div>
                                                <div class='art-blockcontent-body'>
                                            <!-- block-content --><h2>News Editor <a href='";
	if($_GET['act']!="newsedit"){$body.= "?act=newsedit'>".$lang['sh']."<!-- /block-content -->
                                            
                                            		<div class='cleared'></div>
                                                </div>
                                  </div>";}else{$body.= "xconfig.php'>".$lang['sh'];} $body.="</a></h2>";
		if($_GET['act']=="newsedit"){
			$body.="<div>
			<form method='post' action='xconfig.php'>
			<input type='hidden' name='act' value='anew'>
			<textarea name='freeRTE_content' id='textarea' cols='70' rows='8'>".$acres['news1']."</textarea>
			<br><input type='submit' value='Save'>
			</form>";
		}  

	$body.="			</div><!-- /block-content --></div>
                                            
                                            		<div class='cleared'></div>
                                                </div>
                                  </div></div>
						<div class='art-block'>
                                <div class='art-block-body'>
                                  <div class='art-blockcontent'>
                                    <div class='art-blockcontent-tl'></div>
                                                <div class='art-blockcontent-tr'></div>
                                                <div class='art-blockcontent-bl'></div>
                                                <div class='art-blockcontent-br'></div>
                                                <div class='art-blockcontent-tc'></div>
                                                <div class='art-blockcontent-bc'></div>
                                                <div class='art-blockcontent-cl'></div>
                                                <div class='art-blockcontent-cr'></div>
                                                <div class='art-blockcontent-cc'></div>
                                                <div class='art-blockcontent-body'>
                                            <!-- block-content --><h2>Rulers Editor <a href='";
	if($_GET['act']!="ruledit"){$body.= "?act=rulsedit'>".$lang['sh']."<!-- /block-content -->
                                            
                                            		<div class='cleared'></div>
                                                </div>
                                  </div>";}else{$body.= "xconfig.php'>".$lang['sh'];}
	$body.="</a></h2>";
		if($_GET['act']=="rulsedit"){
		$body.="<div class='news-body'>
		<form method='post' action='xconfig.php'>
		<input type='hidden' name='act' value='rledit'>
		<textarea name='freeRTE_content' id='textarea' cols='70' rows='8'>".$acres['rulers']."</textarea>
		<br><input type='submit' value='Save'>
		</form>
		</div><!-- /block-content -->
                                            
                                            		<div class='cleared'></div>
                                                </div>
                                  </div></div></div>";
	}

	$body.="<p align='center'>&nbsp;</p></div>";
	
include "../templates/".TEMPLATE."/admcp.php"; 
?>
