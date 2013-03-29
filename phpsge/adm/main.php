<?php 
require("../config.php");
require("../func.php");

session_start();
if ( $_SESSION['alog'] == "" ) { header("Location: index.php?msg=login error"); }
($_SESSION['lang']) ? include("../lang/".$_SESSION['lang'].".lng") : include("../lang/".LANG.".lng");
$id=$_SESSION['aid'];
$nik=$_SESSION['anik'];
Conect();
if ($_POST['act']=="cclean"){mysql_query("TRUNCATE TABLE  ".TB_PREFIX."cmsg");}

if($_POST['act']=="sqlqr"){$query=mysql_query($_POST['sqlqr']);}

$abdr=mysql_fetch_array( mysql_query("SELECT `baru_tmdl` FROM `".TB_PREFIX."conf` LIMIT 1;") );
$baru_tmdl=$abdr['baru_tmdl']; 
//___________
$body="<table width='70%' cellpadding='1' cellspacing='1' border='0'> <tr><td> <h2>".$lang['fast-commands']."</h2>
                                                        <div>
                                                          <form name='clean_chat' method='post' action=''>
                                                          <input type='hidden' name='act' value='cclean'>
                                                              <input type='submit' name='button' id='button' value='".$lang['clear-chat']."'>
                                                          </form>
                                                          phpSGE v<span class='Stile3'>".sge_ver()."</span><br>
                                                          PHP v<span class='Stile1'>".phpversion()."</span>
                                                          <br>
                                                          </div>
                                                         </td>
                                                         <td>
															  <h2>Game Data</h2>
															  <div>
															  <span class='Stile1'>".mysql_num_rows( mysql_query("SELECT id FROM `".TB_PREFIX."resdata`") )."</span> ".$lang['resources']."<br>
															  <span class='Stile1'>".mysql_num_rows( mysql_query("SELECT id FROM `".TB_PREFIX."races`") )."</span> ".$lang['races']."<br>
															  <span class='Stile1'>".mysql_num_rows( mysql_query("SELECT id FROM `".TB_PREFIX."t_unt`") )."</span> ".$lang['units']."<br>
															  <span class='Stile1'>".mysql_num_rows( mysql_query("SELECT id FROM `".TB_PREFIX."t_research`") )."</span> ".$lang['research']."<br>
															  
															  </div>
                                                          </td>
                                                          <td>
																 <h2><span></span>".$lang['info']."</h2>
															  <div>
															  ".$lang['language']." <span class='Stile1'>".LANG."</span> <br>
															  Map System <span class='Stile1'>".MAP_SYS."</span> <br>
															  City system <span class='Stile1'>".CITY_SYS."</span> <br>
															  Magazine Engine <span class='Stile1'>".MAG_E."</span> <br>
															  
															  </div>
                                                          </td>
														  <td> <h2>Rates</h2>
														  	 <div>
															 	Baracks time divider per level: <span class='Stile1'>".$baru_tmdl."</span> 
															 </div>
														  </td>
                                                          </tr></table>
                                                        
                                                            <h2>".$lang['advanced-sql-commands']."</h2>
                                                          <form method='post' action=''><input type='hidden' name='act' value='sqlqr'>
                                                         ".$lang['insert-sql-query'].": <br>
                                                          <textarea name='sqlqr' cols='45' rows='5'></textarea><br><br>
                                                          <input type='submit' value=' Execute Query '>
                                                          </form><br>";

$qrwarns=mysql_query("SELECT * FROM `".TB_PREFIX."warn`");	
if( mysql_num_rows($qrwarns) >0 ){											  
	$body.="<table border='1'>";
	while( $wm=mysql_fetch_array($qrwarns) ) {
		$body.="<tr><td>".$wm['text']."</td></tr>";	
	}
} else $body.="<p>No Warns</p>";

include "../templates/sge5-future/admcp.php";
?>
