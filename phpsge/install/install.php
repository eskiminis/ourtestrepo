<?php $var= file_exists("../config.php");
if ($var==true) { header ("Location: err.php"); }
if ($_GET['lang']=="") { header ("Location: index.php"); }
$glang = $_GET['lang'];
include("../lang/".$glang.".lng");

$cctpl="sge5-future";

$body="<h2>".$lang['mysql']."</h2><form method='post' action='do.php'>
<div> 

  <p>".$lang['server'].": 
    <input type='hidden' name='lang' value='".$glang."'>
    <input type='text' name='sserver' id='sserver' size='15'>
  (".$lang['usl'].": localhost)</p>
  <p>".$lang['user'].":&nbsp;
      <input type='text' name='suser' size='15'>
  (".$lang['usl'].": &quot;root&quot;)</p>
  <p>".$lang['password'].": 
    <label>
    <input type='password' name='spass' id='spass' size='15'>
    </label>
  </p>
  <p>".$lang['db'].":
    <label>
      <input type='text' name='sdb' id='sdb' size='15'>
      <br> ".$lang['make_db']." <input name='ccdb' type='checkbox' checked>
      </label>
  </p>
  <p>".$lang['prefix'].": 
    <label>
    <input type='text' name='prefix' id='prefix' size='13'>
    </label>
  </p>
</div>
<h2>".$lang['gam_conf']."</h2>
<div>
  <p>".$lang['gam_nam'].": 
    <label>
    <input type='text' name='gname' id='gname'>
    </label>
  </p>
  <p>".$lang['desc1'].": 
    <label>
    <input type='text' name='gdesc' id='gdesc'>
    </label>
  </p>
  <p>".$lang['desc2'].": 
    <label>
    <input type='text' name='mandesc' id='mandesc'>
    </label>
  </p>
  <p>".$lang['template'].":<select name='templ'>";

  $dir = '../templates';
  $handle = opendir($dir);
  // Lettura...
while (false !== ($files = readdir($handle))) {
    // Escludo gli elementi '.' e '..' e stampo il nome del file...
    if ($files != '.' && $files != '..' && $files!='js'){
        $sel='';
		if($cctpl==$files){$sel='selected';}
		$body.= '<option '.$sel.'>'.$files.'</option>';
	}
}

  $body.="</select> </p>
  <p>".$lang['css'].": 
    <label>
    <select name='css' id='css'>";
$dir = '../templates/sge5-future/css';
$handle = opendir($dir);
while (false !== ($files = readdir($handle))) {
	if ($files != '.' && $files != '..'){
		$body.='<option value="'.$files.'">'.$files.'</option>';
	}
}  
    $body.="</select>
    </label>
  </p>
  <p>".$lang['city_sys'].":
  	<label>
    <select name='cts'>
    <option value='1' selected>".$lang['city_sys_1']."</option>
    <option value='2'>".$lang['city_sys_2']."</option>
    </select>
    </label>
  </p>
  <p>".$lang['map_sys'].": 
    <select name='map' id='map'>
      <option value='1'>".$lang['map_sys_1']."</option>
      <option value='2'>".$lang['map_sys_2']."</option>
	  <option value='3'>".$lang['map_sys_3']."</option>
    </select>
  </p>
  <p>".$lang['mag_e'].": <select name='mge'> 
    <option value='0' selected>OFF</option>
    <option value='1'>ON</option>
    </select>".$lang['mag_e_att']."
    </p>
	
	<p> ".$lang['pop_e'].": <select name='pope'> 
    <option value='0' selected>OFF</option>
    <option value='1'>ON</option>
    </select> ".$lang['pop_e_att']."
    </p>
</div>
<p>
  <label>
  <input type='submit' name='install' id='install' value=' >> ".$lang['install']." << '></form>
  </label>
</p>
</div>";

$incmen="off";
include "../templates/sge5-future/admcp.php";
?> 
