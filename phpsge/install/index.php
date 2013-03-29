<?php $var= file_exists("../config.php");
if ($var==true) { header ("Location: err.php"); } 

if (!defined('PHP_VERSION_ID')) {
    $version = explode('.', PHP_VERSION);

    define('PHP_VERSION_ID', ($version[0] * 10000 + $version[1] * 100 + $version[2]));
}

$body="<div>
  <p>ATTENTION!<span class='Stile3'><strong> If you are on Linux you must set CHMOD to 777 or do <a href='http://sourceforge.net/apps/mediawiki/phpstrategygame/index.php?title=Manual_installation'>manual installiation (clik here)!</a></strong></span></p>
  <form method='get' action='install.php'>
    <label>
	<h3><br>Your PHP version: ".phpversion();
	if(PHP_VERSION_ID >= 50200){$body.="&nbsp; OK";}else{$body.="&nbsp; <span class='Stile3'>Not Supported! Update PHP (to: 5.2.0)!</span>";}
    $body.="</h3><br>
	<p>Language / язык</p>
    <select name='lang' id='lang'>
    	<option value='en' selected='selected'>English</option> 
		<option value='it' selected='selected'>Italiano</option>
        <option value='ru'>–усский</option>       
    </select>
    </label>
    <label><br />
    <br />
    If you press Ok you have read <a href='../credits.php'>credits</a> and you agree to that terms<br><br>
    <input type='submit' value=' >> Ok << ' />
    </label>
  </form>
  <p>&nbsp;  </p>
</div>";

$incmen="off";
include "../templates/sge5-future/admcp.php";
?>



